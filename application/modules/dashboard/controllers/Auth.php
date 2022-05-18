<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array(
            'auth_model', 'Setting_model', 'home_model'
        ));

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');

        $this->load->helper('captcha');
    }

    public function index() {
        if ($this->session->userdata('isLogIn'))
            redirect('dashboard/home');
        $data['title'] = display('login');
        $checkout = $this->input->post('checkout', TRUE);
        $remember_me = $this->input->post("rememberme", TRUE);
        if ($remember_me == 1) {
            $email_cookie = array(
                'name' => 'email',
                'value' => $this->input->post('email', TRUE),
                'expire' => '86500',
            );
            $this->input->set_cookie($email_cookie);
            $pass_cookie = array(
                'name' => 'password',
                'value' => $this->input->post('password', TRUE),
                'expire' => '86500',
            );
            // dd($pass_cookie);
            $this->input->set_cookie($pass_cookie);
        }
        #-------------------------------------#
        $this->form_validation->set_rules('email', display('email'), 'required|max_length[100]|trim');
        $this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5|trim');

        #-------------------------------------#
        $data['user'] = (object) $userData = array(
            'email' => $this->input->post('email', TRUE),
            'password' => $this->input->post('password', TRUE),
        );
        #-------------------------------------#
        if ($this->form_validation->run()) {
            $user = $this->auth_model->checkUser($userData);
            if ($user->num_rows() > 0) {
                $checkPermission = $this->auth_model->userPermission2($user->row()->log_id);
                
                if ($checkPermission != NULL) {
                    $permission = array();
                    $permission1 = array();
                    if (!empty($checkPermission)) {
                        foreach ($checkPermission as $value) {
                            $permission[$value->module] = array(
                                'create' => $value->create,
                                'read' => $value->read,
                                'update' => $value->update,
                                'delete' => $value->delete
                            );

                            $permission1[$value->menu_title] = array(
                                'create' => $value->create,
                                'read' => $value->read,
                                'update' => $value->update,
                                'delete' => $value->delete
                            );
                        }
                    }
                }

                if($user->row()->user_types == 4 || $user->row()->user_types == 5){
                    // dd($user->row()->user_types);
                    $this->session->set_flashdata('exception', "You are not a valid user!");
                    redirect('dashboard/auth/index');
                }else{                    
                    if ($user->row()->status == 0) {
                        $this->session->set_flashdata('exception', display('please_wait_for_admin_approval'));
                        redirect('dashboard/auth/index');
                    }else {
                        $sData = array(
                            'isLogIn' => true,
                            'isAdmin' => (($user->row()->is_admin == 1) ? true : false),
                            'is_admin' => $user->row()->is_admin,
                            'user_type' => $user->row()->user_types,
                            'log_id' => $user->row()->log_id,
                            'user_id' => $user->row()->log_id,
                            'created_by' => $user->row()->created_by,
                            'client_id' => (!empty($row->client_id) ? "$row->client_id" : ""),
                            'fullname' => $user->row()->name,
                            'email' => $user->row()->email,
                            'image' => (!empty($user->row()->image) ? $user->row()->image : $user->row()->picture),
                            'last_login' => $user->row()->last_login,
                            'last_logout' => $user->row()->last_logout,
                            'ip_address' => $user->row()->ip_address,
                            'permission' => json_encode((!empty($permission) ? $permission : '')),
                            'label_permission' => json_encode((!empty($permission1) ? $permission1 : '')),
                            'session_id' => session_id(),
                        );
                            // dd($sData);
                        //store date to session 
                        $this->session->set_userdata($sData);
                        //update database status
                        $this->last_login();
                        $user_type = $this->session->userdata('user_type');
                        $log_id = $this->session->userdata('log_id');
                    
                        //welcome message
                        $this->session->set_flashdata('message', display('welcome_back') . ' ' . $user->row()->name);
                        if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 2) {
                            if ($checkout) {
                                redirect('checkout');
                            } else {
                                redirect('dashboard/home');
                            }
                        } elseif ($this->session->userdata('user_type') == 4) {
                            $loginfo = get_enterpriseinfo($log_id);                        
                            // $instituteinfo = get_enterpriseinfo($loginfo->institute_id);
                            redirect(base_url());
                        } elseif ($this->session->userdata('user_type') == 5){
                            redirect(base_url('frontend/Instructor/instructor_dashboard'));
                        } elseif ($this->session->userdata('user_type') == 3){
                            redirect('dashboard/home');
                        }
                    }
                }
            } else {
                $this->session->set_flashdata('exception', display('incorrect_email_or_password'));
                redirect('dashboard/auth/index');
            }
        } else {
            echo Modules::run('template/login', $data);
        }
    }

//    ================= its for login process ==========
    public function login_process() {
        $data['title'] = display('login');
        $checkout = $this->input->post('checkout', TRUE);
        $type = $this->input->post('type', TRUE);

        $remember_me = $this->input->post("rememberme", TRUE);
        if ($remember_me == 1) {
            $email_cookie = array(
                'name' => 'email',
                'value' => $this->input->post('email', TRUE),
                'expire' => '86500',
            );
            $this->input->set_cookie($email_cookie);
            $pass_cookie = array(
                'name' => 'password',
                'value' => $this->input->post('password', TRUE),
                'expire' => '86500',
            );
            $this->input->set_cookie($pass_cookie);
        }

        $data['user'] = (object) $userData = array(
            'email' => $this->input->post('email', TRUE),
            'password' => $this->input->post('password', TRUE),
            'type' => $this->input->post('type', TRUE),
        );
        $checkallUser = $this->auth_model->checkallUser($userData);
        // dd($user->row());

        if ($checkallUser->num_rows() > 0) {
            $user = $this->auth_model->checkUser($userData);

            $subscription_id = '';
            if($user->row()->user_types == 4){
                $get_studentlastsubcriptionid = $this->db->select('subscription_id')
                                                ->from('invoice_tbl')
                                                ->where('customer_id', $user->row()->log_id)
                                                ->where('is_subscription', 1)
                                                ->order_by('id', 'desc')
                                                ->get()->row();
            $subscription_id = $get_studentlastsubcriptionid->subscription_id;
            }
             

            $checkPermission = $this->auth_model->userPermission2($user->row()->log_id);
            if ($checkPermission != NULL) {
                $permission = array();
                $permission1 = array();
                if (!empty($checkPermission)) {
                    foreach ($checkPermission as $value) {
                        $permission[$value->module] = array(
                            'create' => $value->create,
                            'read' => $value->read,
                            'update' => $value->update,
                            'delete' => $value->delete
                        );

                        $permission1[$value->menu_title] = array(
                            'create' => $value->create,
                            'read' => $value->read,
                            'update' => $value->update,
                            'delete' => $value->delete
                        );
                    }
                }
            }
            // d($user->row()->status . '   dd d d');
            if(empty($user->row())){
                echo 'nodata';
                exit();
            }elseif ($user->row()->status === 0) {
                echo '0';
                exit();
            } else {
                //welcome message
                if ($user->row()->user_types == 5) {
                    echo 'facultylogin';
                }elseif ($user->row()->user_types == 1 || $user->row()->user_types == 2) {
                    echo 'adminlogin';
                    exit();
                }elseif($user->row()->user_types == 4) {
                    echo 'loginok';
                }

                $sData = array(
                    'isLogIn' => true,
                    'isAdmin' => (($user->row()->is_admin == 1) ? true : false),
                    'is_admin' => $user->row()->is_admin,
                    'user_type' => $user->row()->user_types,
                    'log_id' => $user->row()->log_id,
                    'user_id' => $user->row()->log_id,
                    'created_by' => $user->row()->created_by,
                    'client_id' => (!empty($row->client_id) ? "$row->client_id" : ""),
                    'fullname' => $user->row()->name,
                    'email' => $user->row()->email,
                    'image' => (!empty($user->row()->image) ? $user->row()->image : $user->row()->picture),
                    'subscription_id' => $subscription_id,
                    'last_login' => $user->row()->last_login,
                    'last_logout' => $user->row()->last_logout,
                    'ip_address' => $user->row()->ip_address,
                    'permission' => json_encode((!empty($permission) ? $permission : '')),
                    'label_permission' => json_encode((!empty($permission1) ? $permission1 : '')),
                    'session_id' => session_id(),
                    'enterprise_id' =>  $user->row()->enterprise_id,
                );
                $this->session->set_userdata($sData);
                //update database status
                $this->last_login();
            }
        } else {
            echo 'invalidAccess';
        }
    }

//    ============== its for forgot-password-send ===========
    public function forgot_password_send() {
        $enterprise_id = $this->input->post('enterprise_id', true);
        $email = $this->input->post('email', TRUE);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $checkEmail = $this->auth_model->checkEmail($email);
        $data['get_mail_config'] = $this->db->select('*')->from('mail_config_tbl')->where('enterprise_id', $enterprise_id)->get()->row();
        
        if (!empty($checkEmail)) {
            $log_id = $checkEmail->log_id;
            $random_key = ("RK" . date('y') . strtoupper($this->randstrGen(2, 4)));
            // $random_array = array(
            //     'password' => md5($random_key),
            // );
            // $this->db->where('log_id', $log_id);
            // $this->db->update('loginfo_tbl', $random_array);
            $this->auth_model->sendLink($log_id, $email, $data, $random_key);
            echo "Please check your mail!";
        } else {
            echo "Invalid your mail!";
        }
    }

    //    ========= its for randomly key generate ==========
    function randstrGen($mode = null, $len = null) {
        $result = "";
        if ($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif ($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif ($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif ($mode == 4):
            $chars = "0123456789";
        endif;
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function logout() {
        //update database status
        $log_id = $this->session->userdata('user_id');
        // dd($log_id);
        $lastlogout_data = array(
            'last_logout' => $this->createdtime,
        );
        $this->db->where('log_id', $log_id)->update('loginfo_tbl', $lastlogout_data);
        activitiylog_save("Logout time $this->createdtime", "Logout", $log_id, $this->createdtime);
        //destroy session
        $this->session->sess_destroy();
        redirect('/');
    }

    public function last_login() {
        $log_id = $this->session->userdata('log_id');
        $lastlogout_data = array(
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'last_login' => $this->createdtime,
        );
        $this->db->where('log_id', $log_id)->update('loginfo_tbl', $lastlogout_data);
        activitiylog_save("Login time $this->createdtime", "Login", $log_id, $this->createdtime);
    }

    public function changepassword_form() {
        $data['title'] = "Change Password";
        $id = $this->session->userdata('user_id');
        $data['user'] = $this->home_model->profile($id);

        $data['module'] = "dashboard";
        $data['page'] = "home/changepassword_form";
        echo Modules::run('template/layout', $data);
    }

    public function password_update() {
        $user_id = $this->input->post('user_id', TRUE);
        $current_password = $this->input->post('current_password', TRUE);
        $new_password = $this->input->post('new_password', TRUE);
        $retype_password = $this->input->post('retype_password', TRUE);
        $current_password_check = $this->auth_model->user_password_check($user_id, $current_password);

        if (!$current_password_check) {
            echo '0';
        } else {
            $passwordchange_data = array(
                'password' => md5($new_password),
            );
            $this->db->where('log_id', $user_id)->update('loginfo_tbl', $passwordchange_data);
            echo display('updated_successfully');
        }
    }

    public function password_reset(){
        $newpassword = $this->input->post('newpassword', true);
        $log_id = $this->input->post('log_id', True);

        if($newpassword){
            $passwordchange_data = array(
                'password' => md5($newpassword),
            );
            $this->db->where('log_id', $log_id)->update('loginfo_tbl', $passwordchange_data);
            echo "Password Reset successfully!";
        }

    }

}