<?php

defined('BASEPATH') OR exit('No direct script access allowed');

#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Leadacademy Project
# Developed by : Md. Shahab uddin
#------------------------------------

class Enterprise extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('Category_model');
        $this->load->model('Enterprise_model');

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');

        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname . '/login');

        // date_default_timezone_set('Asia/Dhaka');
    }

    function create_subdomain($subDomain = 'saifurs', $cPanelUser = 'ggibdcom', $cPanelPass = 'ab12Dh3O9r', $rootDomain = 'ggibd.com') {
    // function create_subdomain($subDomain = 'saifurs', $cPanelUser = 'soft6bdtask', $cPanelPass = 'HYYJU7786FRThyuIOLK!', $rootDomain = 'soft6.bdtask.com') {
        // $buildRequest = "/frontend/x3/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain;
        // $buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=public_html/" . $subDomain."&go=Create";
        

        $buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=" . $subDomain . '.' . $rootDomain . "&go=Create";
        // https://host.hostnavy.net:2083/cpsess7867012565/frontend/paper_lantern/subdomain/index.html
        
        $openSocket = fsockopen('localhost', 2082);
        
        // $openSocket = @fsockopen('ggibd.com', 2082);
        // dd($openSocket);
        if (!$openSocket) {
            return "Socket error";
            exit();
        }

        $authString = $cPanelUser . ":" . $cPanelPass;
        // dd($authString);
        $authPass = base64_encode($authString);
        $buildHeaders = "GET " . $buildRequest . "\r\n";
        $buildHeaders .= "HTTPS/1.0\r\n";
        $buildHeaders .= "Host:localhost\r\n";
        $buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
        $buildHeaders .= "\r\n";

        // echo $buildHeaders;die();

        fputs($openSocket, $buildHeaders);
        while (!feof($openSocket)) {
            fgets($openSocket, 128);
        }
        fclose($openSocket);

        $newDomain = "http://" . $subDomain . "." . $rootDomain . "/";
        echo $newDomain;

        //  return "Created subdomain $newDomain";
    }

// =================its for subdomain delete   ====================
    // frontend/paper_lantern/subdomain/dodeldomain.html?domain=saifurs.ggibd.com

    public function index() {
        $data['title'] = display('enterprise');
        $data['get_rolepermission'] = get_rolepermission();

        $data['module'] = "dashboard";
        $data['page'] = "enterprise/add_enterprise";
        echo modules::run('template/layout', $data);
    }

    public function enterprise_save() {
        $enterpriseid = $this->input->post('enterpriseid', TRUE);
        $enterprise_id = "ENT" . date('d') . $this->generators->generator(6);
        if ($enterpriseid) {
            $enterprise_id = $enterpriseid;
            $password = $this->input->post('old_pass', TRUE);
        } else {
            $enterprise_id = $enterprise_id;
            $password = md5($this->input->post('password', TRUE));
        }


        $name = $this->input->post('name', TRUE);
        $mobile = $this->input->post('mobile', TRUE);
        $dateofbirth = $this->input->post('dateofbirth', TRUE);
        $email = $this->input->post('email', TRUE);
        $username = $this->input->post('username', TRUE);
        $student_capacity = $this->input->post('student_capacity', TRUE);
        $instructor_capacity = $this->input->post('instructor_capacity', TRUE);
        $role_id = $this->input->post('role_id', TRUE);
        $role_id = explode(',', $role_id);
        $short_name = $str = str_replace(" ", "-", $name);
        $shortname = rtrim($short_name, '-');

        $loginfo_data = array(
            'log_id' => $enterprise_id,
            'name' => $name,
            'shortname' => strtolower($shortname),
            'mobile' => $mobile,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'user_types' => 2,
            'is_admin' => 2,
            'enterprise_id' => get_userid(),
            'last_login' => '',
            'last_logout' => '',
            'ip_address' => '',
            'status' => 1,
            'created_by' => $this->user_id,
            'created_at' => $this->createdtime,
        );

        if ($enterpriseid) {
            $this->db->where('log_id', $enterpriseid)->update('loginfo_tbl', $loginfo_data);
            activitiylog_save($name . " Updated Enterprise Data Loginfo By ", "Update", $this->user_id, $this->createdtime);
        } else {
            $this->db->insert('loginfo_tbl', $loginfo_data);
            activitiylog_save($name . " Add Enterprise Data Loginfo By", "Insert", $this->user_id, $this->createdtime);
        }

        $enterpriseinfo = array(
            'enterprise_id' => $enterprise_id,
            'name' => $name,
            'mobile_no' => $mobile,
            'date_of_birth' => $dateofbirth,
            'email' => $email,
            'status' => 1,
            'student_capacity' => $student_capacity,
            'faculty_capacity' => $instructor_capacity,
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );

        if ($enterpriseid) {
            $this->db->where('enterprise_id', $enterpriseid)->update('enterprise_tbl', $enterpriseinfo);
            activitiylog_save("Updated Enterprise By ", "Insert", $this->user_id, $this->createdtime);
        } else {
            $this->db->insert('enterprise_tbl', $enterpriseinfo);
            activitiylog_save($name . " Add Enterprise By ", "Insert", $this->user_id, $this->createdtime);
        }

        //        ============ its for user access role assign ========
        if ($role_id) {
            $this->db->where('fk_user_id', $enterprise_id)->delete('sec_user_access_tbl');
            for ($i = 0; $i < count($role_id); $i++) {
                $user_role = array(
                    'fk_user_id' => $enterprise_id,
                    'fk_role_id' => $role_id[$i],
                    'enterprise_id' => get_userid(),
                );
                $this->db->insert('sec_user_access_tbl', $user_role);
            }
            activitiylog_save($name . " Enterprise User Role Access ", "Insert", $this->user_id, $this->createdtime);
        }
        if ($enterpriseid) {
            echo display('updated_successfully');
        } else {
            echo display('added_successfully');
        }
    }

    public function enterprise_list() {
        $data['title'] = display('enterprise_list');
        $data['total_enterprisecount'] = $this->total_enterprisecount();




        $data['module'] = "dashboard";
        $data['page'] = "enterprise/enterprise_list";
        echo modules::run('template/layout', $data);
    }

    public function get_enterpriselist() {
        $postData = $_POST;

        $search = (object) array(
        );
        // Get data
        $data = $this->getenterpriselist($postData, $search);
        echo json_encode($data);
    }

    public function total_enterprisecount($search = null, $searchQuery = null) {
        $this->db->select('a.*, b.username');
        $this->db->from('enterprise_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getenterpriselist($postData = null, $searchs = null) {
        $response = array();
        ## Read value
        $draw = @$postData['draw'];
        $start = @$postData['start'];
        $rowperpage = @$postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        $testColumn="$columnName";
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (a.name like '%" . $searchValue . "%')
                            or a.mobile_no like '%" . $searchValue . "%'
                            or b.username like '%" . $searchValue . "%'
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_enterprisecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*, b.username, b.status logstatus');
        $this->db->from('enterprise_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        // $this->db->order_by('a.id', 'desc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $as_login = $editbtn = $deletebtn = '';

            $i = 1;
            $as_login = '<a class="" href="' . base_url(enterpriseinfo()->shortname . '/' . 'login-as-enterprise/' . $record->enterprise_id) . '" data-toggle="tooltip" title="Login as a Institute"><i class="fa fa-sign-in-alt btn btn-success btn-sm"> </i> </a>';
            if ($record->logstatus == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="enterpriseinactive(' . "'" . $record->enterprise_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"> </i> </a>';
            } elseif ($record->logstatus == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="enterpriseactive(' . "'" . $record->enterprise_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }
            // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn = '<a href="javascript:void(0)" onclick="enterprise_edit(' . "'" . $record->enterprise_id . "'" . ')" data-toggle="tooltip" title="Edit" class="fa fa-edit btn btn-info-soft btn-sm"></a>';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
            $deletebtn = '<a href="javascript:void(0)" onclick="enterprise_delete(' . "'" . $record->enterprise_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
            $action = $as_login . ' ' . $statusbtn . ' ' . $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "name" => $record->name,
                "mobile_no" => $record->mobile_no,
                "username" => $record->username,
                "student_capacity" => $record->student_capacity,
                "faculty_capacity" => $record->faculty_capacity,
                "action" => $action,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        return $response;
    }

    public function enterprise_editform() {
        $data['title'] = display('interprise_info');
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $data['get_enterpriseeditdata'] = $this->Enterprise_model->get_enterpriseeditdata($enterprise_id);
        $data['get_rolepermission'] = get_rolepermission();
        $data['get_assignedrole'] = get_assignedrole($enterprise_id);


        // return view('App\Modules\Dashboard\Views\cms\activities_editform', $data);
        $this->load->view('enterprise/enterprise_editform', $data);
    }

    //    ============ its for enterprise inactive =============
    public function enterprise_inactive() {
        $enterprise_id = $this->input->post('enterprise_id', true);
        $data = array(
            'status' => 0,
        );
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->update('enterprise_tbl', $data);

        $logdata = array(
            'status' => 0,
        );
        $this->db->where('log_id', $student_id);
        $this->db->update('loginfo_tbl', $logdata);
        activitiylog_save("Student Log Inactive By", "Inactive", $this->user_id, $this->createdtime);
        echo display('inactive_successfully');
    }

//    ================== its for enterprise active ============
    public function enterprise_active() {
        $enterprise_id = $this->input->post('enterprise_id', true);
        $data = array(
            'status' => 1,
        );
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->update('enterprise_tbl', $data);
        
        $logdata = array(
            'status' => 1,
        );
        $this->db->where('log_id', $enterprise_id);
        $this->db->update('loginfo_tbl', $logdata);
        activitiylog_save("Enterprise Log Active By", "Active", $this->user_id, $this->createdtime);
        echo display('active_successfully');
    }

    public function enterprise_delete() {
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        // $checkcategorytable_byinstitute = $this->Institute_model->checkotherstablebyinstitute($enterprise_id, 'category_tbl');
        // $checkcoursetable_byinstitute = $this->Institute_model->checkotherstablebyinstitute($enterprise_id, 'course_tbl');
        // $checkchaptertable_byinstitute = $this->Institute_model->checkotherstablebyinstitute($enterprise_id, 'chapter_tbl');
        // $checkpackagetable_byinstitute = $this->Institute_model->checkotherstablebyinstitute($enterprise_id, 'package_tbl');
        // $checkquestiontable_byinstitute = $this->Institute_model->checkotherstablebyinstitute($enterprise_id, 'question_tbl');
        //
            // if ($checkcategorytable_byinstitute || $checkcoursetable_byinstitute || $checkchaptertable_byinstitute || $checkpackagetable_byinstitute || $checkquestiontable_byinstitute) {
        //     echo 0;
        // } else {
        //     $this->db->where('log_id', $enterprise_id)->delete('loginfo_tbl');
        //     $this->db->where('enterprise_id', $enterprise_id)->delete('instituteinfo_tbl');
        echo 1;
        // }
    }

    public function login_as_enterprise($enterprise_id) {
        $get_enterprisedata = $this->Enterprise_model->get_enterprisedata($enterprise_id);

        $data['user'] = (object) $userData = array(
            'email' => $get_enterprisedata->username,
            'password' => $get_enterprisedata->password,
        );
        $user = $this->Enterprise_model->checkUser($userData);


        if ($user->num_rows() > 0) {
            $checkPermission = $this->Enterprise_model->userPermission2($user->row()->log_id);

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

            if ($user->row()->status == 0) {
                echo 0;
                exit();
            } else {
                $sData = array(
                    'isLogIn' => true,
                    'isAdmin' => (($user->row()->is_admin == 1) ? true : false),
                    'is_admin' => $user->row()->is_admin,
                    'user_type' => $user->row()->user_types,
                    'log_id' => $user->row()->log_id,
                    'user_id' => $user->row()->log_id,
                    'created_by' => $user->row()->created_by,
                    'institute_id' => $user->row()->enterprise_id,
                    'fullname' => $user->row()->name,
                    'email' => $user->row()->email,
                    'image' => (!empty($user->row()->image) ? $user->row()->image : $user->row()->picture),
                    'last_login' => $user->row()->last_login,
                    'last_logout' => $user->row()->last_logout,
                    'ip_address' => $user->row()->ip_address,
                    'permission' => json_encode((!empty($permission) ? $permission : '')),
                    'label_permission' => json_encode((!empty($permission1) ? $permission1 : '')),
                    'temp_login' => 1,
                    'session_id' => session_id(),
                );

                $this->session->set_userdata($sData);
                //update database status
                $this->last_login();
                //welcome message
                //                if ($user->row()->user_types == 3) {
                //                    echo 'facultylogin';
                //                } else
                $this->session->set_flashdata('message', display('welcome_back') . ' ' . $user->row()->name);
                if ($user->row()->user_types == 1 || $user->row()->user_types == 2 || $user->row()->user_types == 3 || $user->row()->user_types == 5) {
                    redirect(enterpriseinfo()->shortname . '/dashboard');
                }
            }
        }
    }

    public function last_login() {
        $log_id = $this->session->userdata('log_id');
        $lastlogout_data = array(
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'last_login' => $this->createdtime,
        );
        $this->db->where('log_id', $log_id)->update('loginfo_tbl', $lastlogout_data);
        activitiylog_save("Enterprise Login By ", "Login", $this->user_id, $this->createdtime);
    }

}
