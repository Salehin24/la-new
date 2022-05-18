<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'template_model'
        ));
    }

    public function layout($data) {
        $id = $this->session->userdata('id');
        $data['get_enterpriseinfo'] = get_enterpriseinfo(get_enterpriseid());
        // $data['notifications'] = $this->template_model->notifications($id);
        // $data['quick_messages'] = $this->template_model->messages($id);
        // dd(get_enterpriseid());
        $data['setting'] = $this->template_model->setting();
        $this->load->view('layout', $data);
    }

    public function login($data) {

        $data['setting'] = $this->template_model->setting();
        $this->load->view('login', $data);
    }

//    =============== its for frontend layout ============
    public function frontend_layout($data) {
        $enterprise_id = $this->session->userdata('enterprise_id');
        $data['enterprise_id'] = (!empty($enterprise_id) ? $enterprise_id : '1');
        $data['enterprise_info'] = get_enterpriseinfo($data['enterprise_id']);
        $data['enterprise_shortname'] = (!empty($data['enterprise_info']->shortname) ? $data['enterprise_info']->shortname : 'admin');

        $this->load->view('frontend/themes/default/layout', $data);
    }
//    =============== its for frontend student layout ============
    public function frontend_studentlayout($data) {
        $enterprise_id = $this->session->userdata('enterprise_id');
        $data['enterprise_id'] = (!empty($enterprise_id) ? $enterprise_id : '1');
        $data['enterprise_info'] = get_enterpriseinfo($data['enterprise_id']);
        $data['enterprise_shortname'] = (!empty($data['enterprise_info']->shortname) ? $data['enterprise_info']->shortname : 'admin');

        $this->load->view('frontend/themes/default/students/student_layout', $data);
    }
//    =============== its for frontend instructor layout ============
    public function frontend_instructorlayout($data) {
        $enterprise_id = $this->session->userdata('enterprise_id');
        $data['enterprise_id'] = (!empty($enterprise_id) ? $enterprise_id : '1');
        $data['enterprise_info'] = get_enterpriseinfo($data['enterprise_id']);
        $data['enterprise_shortname'] = (!empty($data['enterprise_info']->shortname) ? $data['enterprise_info']->shortname : 'admin');

        $this->load->view('frontend/themes/default/instructors/instructor_layout', $data);
    }

}
