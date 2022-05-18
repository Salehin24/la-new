<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InstructorLayout extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		 $this->load->model(array(
            'Frontend_model', 'dashboard/Course_model', 'dashboard/Faculty_model', 'dashboard/Faculty_model', 'dashboard/Faculty_model', 'dashboard/Setting_model','Instructor_model'
        ));
	}
 
	public function layout($data)
    {
    	$enterprise_id = $this->session->userdata('enterprise_id');
        $enterpriseid = (!empty($enterprise_id) ? $enterprise_id : '1');
    	$data['transfarentmenu'] = '';
    	$data['enterprise_id'] = (!empty($enterprise_id) ? $enterprise_id : '1');
        $data['enterprise_info'] = get_enterpriseinfo($data['enterprise_id']);
        $data['enterprise_shortname'] = (!empty($data['enterprise_info']->shortname) ? $data['enterprise_info']->shortname : 'admin');
    	$this->session->set_userdata('enterprise_id', $enterpriseid);
        $data['get_testimonials'] = $this->Frontend_model->get_testimonials($enterpriseid);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterpriseid);
        $data['company_list'] = $this->Setting_model->company_list($enterpriseid);
        $data['featuredin_list'] = $this->Frontend_model->featuredin_list($enterpriseid);
        $data['get_category'] = $this->Frontend_model->get_category($enterpriseid);
        $data['get_popularcartegory'] = $this->Frontend_model->popular_category($enterpriseid);
        $data['get_sliderdata'] = $this->Frontend_model->get_sliderdata($enterpriseid);
        $data['get_popularcourse'] = $this->Frontend_model->popular_course(4, '', $enterpriseid);
        $data['instructors_data'] = $this->Instructor_model->instructor_info();
		$this->load->view('themes/default/instructor/layout', $data);
    
	}
}