<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'module_permission_model',
            'module_model',
            'role_model'
        ));
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        $this->user_id = $this->session->userdata('user_id');

        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }

    public function get_rolepermissionform() {
        $data['title'] = display('add_role');
        $data['modules'] = $this->db->select('*')->from('sec_menu_item')->group_by('module')->get()->result();
        $this->load->view('role/_create_system_role', $data);
    }

    public function save_create() {
        /* ----------------------------------- */
        $this->form_validation->set_rules('role_name', display('role_name'), 'required|max_length[100]|is_unique[sec_role_tbl.role_name]');
        $rolename = $this->input->post('role_name', true);
        if ($this->form_validation->run() == TRUE) {
            $rolData = array(
                'role_name' => $this->input->post('role_name', true),
                'role_description' => $this->input->post('role_description', true),
                'create_by' => $this->session->userdata('id'),
                'date_time' => $this->createdtime,
                'enterprise_id' => get_enterpriseid(),
            );
            $this->db->insert('sec_role_tbl', $rolData);
            $role_id = $this->db->insert_id();

            /* ----------------------------------- */
            $module = $this->input->post('module', true);
            $menu_id = $this->input->post('menu_id', true);
            $create = $this->input->post('create', true);
            $read = $this->input->post('read', true);
            $update = $this->input->post('edit', true);
            $delete = $this->input->post('delete', true);
           
            $new_array = array();
            for ($m = 0; $m < sizeof($module); $m++) {
                for ($i = 0; $i < sizeof($menu_id[$m]); $i++) {
                    for ($j = 0; $j < sizeof($menu_id[$m][$i]); $j++) {
                        $dataStore = array(
                            'role_id' => $role_id,
                            'menu_id' => $menu_id[$m][$i][$j],
                            'can_create' => (!empty($create[$m][$i][$j]) ? $create[$m][$i][$j] : 0),
                            'can_edit' => (!empty($update[$m][$i][$j]) ? $update[$m][$i][$j] : 0),
                            'can_access' => (!empty($read[$m][$i][$j]) ? $read[$m][$i][$j] : 0),
                            'can_delete' => (!empty($delete[$m][$i][$j]) ? $delete[$m][$i][$j] : 0),
                            'createby' => $this->session->userdata('id'),
                            'createdate' => $this->createdtime,
                            'enterprise_id' => get_enterpriseid(),
                        );

                        array_push($new_array, $dataStore);
                    }
                }
            }
            activitiylog_save($rolename." Role Insert By ", "Insert", $this->user_id, $this->createdtime);


            if ($this->role_model->create($new_array)) {
                $this->session->set_flashdata('message', display('module_permission_added_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            $this->session->set_flashdata('message', display('save_successfully'));
            redirect(enterpriseinfo()->shortname .'/settings/62');
        } else {
            $this->session->set_flashdata('exception', display('already_exists'));
            redirect(enterpriseinfo()->shortname .'/settings/62');
        }
    }

    public function role_list() {
        $data['title'] = display('role_list');
        $data['module'] = "dashboard";
        // $data['role_list'] = $this->db->select('*')->from('sec_role_tbl')->get()->result();
        $data['role_list'] = get_rolepermission();
        $this->load->view('role/_role_list', $data);
    }

    public function role_editform() {
        $data['title'] = display('role_edit');
        $id = $this->input->post('role_id', true);
        $data['modules'] = $this->db->select('*')->from('sec_menu_item')->group_by('module')->get()->result();
        $data['roleData'] = $this->db->select('*')
        ->from('sec_role_tbl')
        ->where('role_id', $id)
        ->get()->row();
        
        $data['roleAcc'] = $this->db->select('sec_role_permission.*,sec_menu_item.menu_title')
        ->from('sec_role_permission')
        ->join('sec_menu_item', 'sec_menu_item.menu_id=sec_role_permission.menu_id')
        ->where('role_id', $id)
        ->get()->result();
        
        // $data['module'] = "dashboard";
        // $data['page'] = "role/edit_role";
        // echo Modules::run('template/layout', $data);
        $this->load->view('role/edit_role', $data);
    }

    public function save_update() {
        /* ----------------------------------- */
        $this->form_validation->set_rules('role_name', display('role_name'), 'required|max_length[100]');
        $role_id = $this->input->post('role_id', true);
        $rolename = $this->input->post('role_name', true);

        if ($this->form_validation->run() == TRUE) {

            $rolData = array(
                'role_name' => $this->input->post('role_name', true),
                'role_description' => $this->input->post('role_description', true),
                'enterprise_id' => get_enterpriseid(),
            );
            $this->db->where('role_id', $role_id)->update('sec_role_tbl', $rolData);
            activitiylog_save($rolename." Role Update By ", "Update", $this->user_id, $this->createdtime);


            /* ----------------------------------- */
            $module = $this->input->post('module', true);
            $menu_id = $this->input->post('menu_id', true);
            $create = $this->input->post('create', true);
            $read = $this->input->post('read', true);
            $update = $this->input->post('edit', true);
            $delete = $this->input->post('delete', true);

            $new_array = array();
            for ($m = 0; $m < sizeof($module); $m++) {
                for ($i = 0; $i < sizeof($menu_id[$m]); $i++) {
                    for ($j = 0; $j < sizeof($menu_id[$m][$i]); $j++) {
                        $dataStore = array(
                            'role_id' => $role_id,
                            'menu_id' => $menu_id[$m][$i][$j],
                            'can_create' => (!empty($create[$m][$i][$j]) ? $create[$m][$i][$j] : 0),
                            'can_edit' => (!empty($update[$m][$i][$j]) ? $update[$m][$i][$j] : 0),
                            'can_access' => (!empty($read[$m][$i][$j]) ? $read[$m][$i][$j] : 0),
                            'can_delete' => (!empty($delete[$m][$i][$j]) ? $delete[$m][$i][$j] : 0),
                            'createby' => $this->session->userdata('id'),
                            'createdate' => $this->createdtime,
                            'enterprise_id' => get_enterpriseid(),
                        );

                        array_push($new_array, $dataStore);
                    }
                }
            }

            if ($this->role_model->create($new_array)) {
                $this->session->set_flashdata('message', display('module_permission_added_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            $this->session->set_flashdata('message', display('update_successfully'));
            redirect(enterpriseinfo()->shortname .'/settings/63');
        } else {
            $this->session->set_flashdata('exception', "Empty field not allow");
            redirect(enterpriseinfo()->shortname .'/settings/63');
        }
    }

    public function delete_role() {
        $id = $this->input->post('menu_id', true);
        $delete = $this->db->where('role_id', $id)->delete('sec_role_tbl');
        $delete = $this->db->where('role_id', $id)->delete('sec_role_permission');
        activitiylog_save($id." Role Delete By ", "Delete", $this->user_id, $this->createdtime);

        if ($delete) {
            echo display('delete_successfully');
        } else {
            echo display('please_try_again');
        }
    }

    public function assign_role_to_user_list() {
        $data['title'] = display('user_access_role');
        $this->db->select('a.*, b.*');
        $this->db->from('sec_user_access_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id=a.fk_user_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->group_by('a.fk_user_id');
        $data['assign_user'] = $this->db->get()->result();
        //  echo $this->db->last_query();
        $this->load->view('role/user_access_role', $data);
    }

    // ======== its for user role check ==========
    public function user_role_check() {
        $user_id = $this->input->post('user_id', true);
        $check_user_role = $this->db->select('*')->from('sec_user_access_tbl a')
                        ->join('sec_role_tbl b', 'b.role_id = a.fk_role_id', 'left')
                        ->where('a.fk_user_id', $user_id)->get()->result();
        if (empty($check_user_role)) {
            $notFound = array(array('role_name' => 'Not Found'));
            echo json_encode($notFound);
        } else {
            echo json_encode($check_user_role);
        }
    }

    public function assign_role_to_user() {
        $data['title'] = "Assign Role To User";
        $data['role'] = $this->db->select('role_name,role_id')->from('sec_role_tbl')->where('enterprise_id', get_enterpriseid())->get()->result();
        $data['user'] = $this->db->select('*')->from('loginfo_tbl')->where('enterprise_id', get_enterpriseid())->where('is_admin!=', 1)->get()->result();

        
        $this->load->view('role/_assign_role_to_user', $data);
    }

    public function save_role_access() {
        $new_array = array();
        $role_id = $this->input->post('role_id', true);
        $user_id = $this->input->post('user_id', true);
        $emp_id = $this->input->post('emp_id', true);

        $this->db->where('fk_user_id', $user_id)->delete('sec_user_access_tbl');

        for ($i = 0; $i < count($role_id); $i++) {
            $user_role = array(
                'fk_user_id' => $user_id,
                'fk_role_id' => $role_id[$i],
                'enterprise_id' => get_enterpriseid(),
            );
            $this->db->insert('sec_user_access_tbl', $user_role);
        }
        activitiylog_save($role_id." User Role Access By ", "Insert", $this->user_id, $this->createdtime);

        $this->session->set_flashdata('message', display('save_successfully'));
        redirect(enterpriseinfo()->shortname .'/settings/64');
    }

    public function edit_access_role() {
        $id = $this->input->post('user_id', true);
        $data['title'] = display('edit');
        $data['role'] = $this->db->select('role_name,role_id')->from('sec_role_tbl')->where('enterprise_id', get_enterpriseid())->get()->result();
        $data['user'] = $this->db->select('*')->from('loginfo_tbl')->where('enterprise_id', get_enterpriseid())->where('is_admin!=', 1)->get()->result();
        $data['editdatainfo'] = $this->db->select('*')->from('sec_user_access_tbl')->where('fk_user_id', $id)->get()->row();
        $data['assigned_roled'] = $this->db->where('fk_user_id', $data['editdatainfo']->fk_user_id)->get('sec_user_access_tbl')->result();

        $this->load->view('role/edit_role_access', $data);
    }

    public function update_access_role() {
        $new_array = array();
        $role_id = $this->input->post('role', true);
        $user_id = $this->input->post('user_id', true);

        $this->db->where('fk_user_id', $user_id)->delete('sec_user_access_tbl');

        for ($i = 0; $i < count($role_id); $i++) {
            $user_role = array(
                'fk_user_id' => $user_id,
                'fk_role_id' => $role_id[$i],
                'enterprise_id' => get_enterpriseid(),
            );
            $this->db->insert('sec_user_access_tbl', $user_role);
        }
        $this->session->set_flashdata('message', display('update_successfully'));
        redirect(enterpriseinfo()->shortname .'/settings/65');
    }

    public function delete_access_role() {
        $user_id = $this->input->post("user_id", true);
        $this->db->where('fk_user_id', $user_id)->delete('sec_user_access_tbl');
        echo display('delete_successfully');
    }

}
