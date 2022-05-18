<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_setup extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'module_permission_model',
            'module_model'
        ));

        $this->user_id = $this->session->userdata('log_id');
        $this->user_type = $this->session->userdata('user_type');
        if (!$this->session->userdata('session_id'))
            redirect('login');
    }

    public function index() {
        $data['p_menu'] = $this->db->select('menu_id,menu_title')->get('sec_menu_item')->result();
        $data['title'] = display('menu_permission_form');
        
        $this->load->view('menupermission/permission_set', $data);
    }

    public function menu_save() {

        $setData = array(
            'menu_title' => $this->input->post('menu_title', true),
            'page_url' => $this->input->post('page_url', true),
            'module' => $this->input->post('module', true),
            'ordering' => $this->input->post('ordering', true),
            'icon' => $this->input->post('icon', true),
            'parent_menu' => $this->input->post('parent_menu', true),
            'is_homesetting' => $this->input->post('is_homesetting', true),
            'is_settings' => $this->input->post('is_settings', true),
            'is_role' => $this->input->post('is_role', true),
            'is_report' => ($this->input->post('is_report', true) ? 1 : 0),
            'status' => 1,
            'enterprise_id' => get_enterpriseid(),
            'createdate' => date('Y-m-d'),
            'createby' => $this->session->userdata('log_id'),
        );
        $this->db->insert('sec_menu_item', $setData);
        echo display('save_successfully');
    }

    public function menu_item_list() {
        $data['title'] = display('menu_permission_list');

        $this->load->view('menupermission/permission_set_list', $data);
    }

//    ============== its for menu_list ============
    public function menu_list() {
        $list = $this->module_permission_model->get_menudata();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rowdata) {
            $parentmenu = $this->db->select('*')->where('menu_id', $rowdata->parent_menu)->get('sec_menu_item')->row();

            $no++;
            $row = array();
            $update = '';
            $delete = '';
            $status = '';
            $status = $rowdata->status;
            
            if ($status == 1) {
                $activeinactive = "<a href='javascript:void(0)' onclick='menuinactive(" . $rowdata->menu_id . ")'  data-toggle='tooltip' data-placement='top' title='Disapprove' class='btn btn-sm btn-success active-inactive-cls'><i class='fa fa-check' aria-hidden='true'></i></a>";

            }
            if ($status == 0) {
                $activeinactive = "<a href='javascript:void(0)' onclick='menuactive(" . $rowdata->menu_id . ")' data-toggle='tooltip' data-placement='top' title='Approve' class='btn btn-sm btn-warning active-inactive-cls'><i class='fa fa-times' aria-hidden='true'></i></a>";
         
            }


            $update = '<a href="javascript:void(0)" onclick="menueditinfo(' . $rowdata->menu_id . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil"></i></a>';

            $delete = '<a href="javascript:void(0)"  onclick="menudelete(' . $rowdata->menu_id . ')" class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';

            $row[] = $no;
            $row[] = $rowdata->menu_title;
            $row[] = $rowdata->page_url;
            $row[] = $rowdata->module;
            $row[] = (!empty($parentmenu->menu_title) ? $parentmenu->menu_title : '');

            $row[] = $activeinactive . $update . $delete;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->module_permission_model->count_allmenu(),
            "recordsFiltered" => $this->module_permission_model->count_filtermenu(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function menu_edit() {
        $id = $this->input->post('menu_id', true);
        $data['p_menu'] = $this->db->select('menu_id,menu_title')->get('sec_menu_item')->result();
        $data['title'] = display('module_permission_list');
        $data['menu_item'] = $this->db->select('*')->where('menu_id', $id)->get('sec_menu_item')->row();

        $this->load->view('menupermission/edit', $data);
    }

    public function menu_update() {
        $setData = array(
            'menu_title' => $this->input->post('menu_title', true),
            'page_url' => $this->input->post('page_url', true),
            'module' => $this->input->post('module', true),
            'ordering' => $this->input->post('ordering', true),
            'icon' => $this->input->post('icon', true),
            'is_homesetting' => $this->input->post('is_homesetting', true),
            'is_settings' => $this->input->post('is_settings', true),
            'is_role' => $this->input->post('is_role', true),
            'parent_menu' => $this->input->post('parent_menu', true),
            'enterprise_id' => get_enterpriseid(),
        );
        $menu_id = $this->input->post('menu_id', true);
        $this->db->where('menu_id', $menu_id)->update('sec_menu_item', $setData);
        echo display('menu_updated_successfully');
    }

    public function pasination($limit, $tbl, $url) {
        $total_rows = $this->db->select('*')
                ->from($tbl)
                ->get()
                ->num_rows();
        $config["base_url"] = base_url($url);
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $limit;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        // integrate bootstrap pagination
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        return $config;
    }

    public function menu_delete() {
        $id = $this->input->post('menu_id', true);
        $this->db->where('menu_id', $id)->delete('sec_menu_item');
        echo display('delete_successfully');
    }

//    ================== its for menu_inactive ============
    public function menu_inactive() {
        $menu_id = $this->input->post('menu_id', true);
        $data = array(
            'status' => 0,
        );
        $this->db->where('menu_id', $menu_id);
        $this->db->update('sec_menu_item', $data);
        echo display('inactive_successfully');
    }

//    ================== its for menu_active ============
    public function menu_active() {
        $menu_id = $this->input->post('menu_id', true);
        $data = array(
            'status' => 1,
        );
        $this->db->where('menu_id', $menu_id);
        $this->db->update('sec_menu_item', $data);
        echo display('active_successfully');
    }

    public function icon_load() {
        $data['title'] = display('all_icon');

        $this->load->view('menupermission/icon_load', $data);
    }

}
