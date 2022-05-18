<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor extends MX_Controller {

    public $pusher;
    private $user_id = "";
    private $sessionid;

    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array(
            'Frontend_model', 'Instructor_model', 'dashboard/Course_model',  'dashboard/Faculty_model', 'dashboard/Setting_model'
        ));
        $this->load->library('cart');
        $this->load->library('generators');
        $this->user_id              = $this->session->userdata('user_id');
        $this->sessionid            = $this->session->userdata('session_id');
        $this->segmentone           = $this->uri->segment(1);
        $this->segmenttwo           = $this->uri->segment(2);
        $enterprise_id              = $this->session->userdata('enterprise_id');

        $enterpriseid               = (!empty($enterprise_id) ? $enterprise_id : '1');
        
        $this->enterprise_info      = get_enterpriseinfo($enterpriseid);
        $this->enterprise_shortname = (!empty($this->enterprise_info->shortname) ? $this->enterprise_info->shortname : 'admin');
        // $pusher_config              = $this->Setting_model->pusher_config($enterpriseid);
        // $pusher_data = array(
        //     'api_id'     => (!empty($pusher_config->api_id) ? $pusher_config->api_id : ''),
        //     'api_key'    => (!empty($pusher_config->api_key) ? $pusher_config->api_key : ''),
        //     'secret_key' => (!empty($pusher_config->secret_key) ? $pusher_config->secret_key : ''),
        //     'cluster'    => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
        // );
        // $this->session->set_userdata($pusher_data);
        // $options = array(
        //     'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
        //     'useTLS'  => true
        // );
        //       if ($pusher_config) {
        //            $this->pusher = new Pusher\Pusher(
        //             $pusher_config->api_key, $pusher_config->secret_key, $pusher_config->api_id, $options
        //         );
        // }
        date_default_timezone_set('Asia/Dhaka');
    }


    public function instructor_dashboard(){
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }

        
        // die();
        $instructor_id                        = $this->session->userdata('user_id');
        $current_month                        = date('m');
        $current_day                          = date('Y-m-d',strtotime("-1 days"));
        $blank_param                          = '';
        $enterprise_id                        = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['title']                        = 'instructor';
        $data['module']                       = "frontend";
        $data['total_earning']                = $this->Instructor_model->monthly_earnings($instructor_id,0,'');
        $data['monthly_sales_earning']        = $this->Instructor_model->monthly_earnings($instructor_id,0,$current_month);
        $instructor_earnings                  = '';
        $month_sl = (date('m'));
        $total = 10;
        for ($i=1; $i <= $month_sl; $i++) {
        $total += 1;
                $earnings = $this->Instructor_model->instructor_earnings_chartdata($instructor_id,$i);
                if (!empty($earnings)) {
                    $instructor_earnings.=($earnings?$earnings:0).",";
                        }else{
                $instructor_earnings.="0,";
                }
        }
        $allpreviousmonths = '';
        for($i=1; $i<= $month_sl; $i++){ 
            $month = date('M', mktime(0, 0, 0, $i, 10)); 
            $allpreviousmonths.= $month . ", "; 
        }

        $data['total_subcription_earning']    = $this->Instructor_model->monthly_earnings($instructor_id,1,'');
        // $data['monthly_subc_earning']         = $this->Instructor_model->monthly_earnings($instructor_id,1,$current_month);
        $data['monthly_subc_earning']         = $this->Instructor_model->daily_earnings($instructor_id,1,$current_day);
        $data['total_students']               = $this->Instructor_model->total_student($instructor_id,$blank_param);
        $data['instructor_rating']            = $this->Instructor_model->instructor_rating($instructor_id);
        $data['instructor_earningschartdata'] = $instructor_earnings;
        $data['allpreviousmonths'] = $allpreviousmonths;
        $data['course_list']                  = $this->Instructor_model->dashboardcourse_list($instructor_id);
        $data['new_students']                 = $this->Instructor_model->total_student($instructor_id,$current_month);
        $data['total_courses']                = $this->Instructor_model->total_courses($instructor_id,$blank_param);
        $data['new_courses']                  = $this->Instructor_model->total_courses($instructor_id,$current_month);
        $data['offer_courses']                = $this->Instructor_model->get_offerscourses($instructor_id,$enterprise_id);
        $data['live_event']                   = $this->Instructor_model->live_event($instructor_id);
        $data['pending_docusin']              = $this->Instructor_model->pending_docusin($instructor_id);
        $data['get_pendingagreements']              = $this->Instructor_model->get_pendingagreements($instructor_id);
        $data['project_pending']              = $this->Instructor_model->pending_projects($instructor_id,$enterprise_id);
        $data['sticky_notes']                 = $this->Instructor_model->instructor_sticky_notes($instructor_id);
        $data['page']                         = "themes/default/instructor/dashboard";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function yearmonthinstructor_earninggraph(){
        $data = array();
        $enterprise_id = $this->input->post('enterprise_id');
        $year_id = $this->input->post('year_id');
        $month_id = $this->input->post('month_id');
        $instructor_id = $this->input->post('user_id');

        // d($year_id); dd($month_id);
        if($month_id == '01'){
            $yearmonth_data = 'Jan';
        }elseif($month_id == '02'){
            $yearmonth_data = 'Feb';
        }elseif($month_id == '03'){
            $yearmonth_data = 'Mar';
        }elseif($month_id == '04'){
            $yearmonth_data = 'Apr';
        }elseif($month_id == '05'){
            $yearmonth_data = 'May';
        }elseif($month_id == '06'){
            $yearmonth_data = 'Jun';
        }elseif($month_id == '07'){
            $yearmonth_data = 'Jul';
        }elseif($month_id == '08'){
            $yearmonth_data = 'Aug';
        }elseif($month_id == '09'){
            $yearmonth_data = 'Sep';
        }elseif($month_id == '10'){
            $yearmonth_data = 'Oct';
        }elseif($month_id == '11'){
            $yearmonth_data = 'Nov';
        }elseif($month_id == '12'){
            $yearmonth_data = 'Dec';
        }

        $instructor_earnings = '';
        // $total = 10;
        // for ($i=1; $i <= 12; $i++) {
        //     $total += 1;
        //     $earnings = $this->Instructor_model->yearmontinstructor_earnings_chartdata($instructor_id,$i);
        //     if (!empty($earnings)) {
        //         $instructor_earnings.= ($earnings ? $earnings:0).",";
        //         }else{
        //     $instructor_earnings.="0,";
        //     }
        // } 
        $data['yearmonthinstructor_earningschartdata'] = '';
        $data['yearmonth_data'] = '';
        if($year_id && $month_id){
            $earnings = $this->Instructor_model->yearmontinstructor_earnings_chartdata($instructor_id, $year_id, $month_id);
            $data['yearmonth_data'] = $yearmonth_data;
            $data['yearmonthinstructor_earningschartdata'] = $earnings.',';
        }elseif($year_id){
            $total = 10;
            for ($i=1; $i <= 12; $i++) {
                $total += 1;
                $earnings = $this->Instructor_model->yearmontinstructor_earnings_chartdata($instructor_id, $year_id, $i);
                if (!empty($earnings)) {
                        $instructor_earnings.= ($earnings ? $earnings:0).",";
                    }else{
                        $instructor_earnings.="0,";
                    }
            } 
            $data['yearmonth_data'] = "Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec";
            $data['yearmonthinstructor_earningschartdata'] = ($instructor_earnings);
        }elseif($month_id){
            $earnings = $this->Instructor_model->yearmontinstructor_earnings_chartdata($instructor_id, $year_id, $month_id);
            $data['yearmonth_data'] = $yearmonth_data;
            $data['yearmonthinstructor_earningschartdata'] = $earnings.',';
        }

        $this->load->view('frontend/themes/default/instructor/yearmonthinstructor_earninggraph', $data);
    }
   

    public function instructor_profile()
    { 
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $enterprise_id                        = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['title']                        = 'instructor Profile';
        $instructor_id                        = $this->session->userdata('user_id');
        $data['instructor_info']              = $this->Instructor_model->instructor_info();
        $data['instructor_profi']             = $this->Instructor_model->get_instructorproficiency($instructor_id);
        $data['get_userexperience']           = $this->Instructor_model->get_userexperience($instructor_id);
        $data['get_usereducation']            = $this->Instructor_model->get_usereducation($instructor_id);
        $data['course_list']                  = $this->Instructor_model->allcourse_list($instructor_id);
        $data['social_links']                 = $this->Instructor_model->social_links($instructor_id);        
        $data['get_featuredprojectportfolio'] = $this->Instructor_model->get_featuredprojectportfolio($enterprise_id, $this->user_id);
        $data['certificates']                 = $this->Instructor_model->allcertificates($instructor_id);
        $data['instructor_name']              = $this->session->userdata('fullname');
        $data['module']                       = "frontend";
        $data['page']                         = "themes/default/instructor/instructor_profile";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
    public function instructor_profile_show($instructor_id){ 
        $enterprise_id                        = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['title']                        = 'Instructor Profile';
        $data['instructor_info']              = get_instructorinfo($instructor_id);
        $data['instructor_profi']             = $this->Instructor_model->get_instructorproficiency($instructor_id);
        $data['get_userexperience']           = $this->Instructor_model->get_userexperience($instructor_id);
        $data['get_usereducation']            = $this->Instructor_model->get_usereducation($instructor_id);
        $data['course_list']                  = $this->Instructor_model->allcourse_list($instructor_id);
        $data['social_links']                 = $this->Instructor_model->social_links($instructor_id);        
        $data['get_featuredprojectportfolio'] = $this->Instructor_model->get_featuredprojectportfolio($enterprise_id, $instructor_id);
        $data['certificates']                 = $this->Instructor_model->allcertificates($instructor_id);
        $data['instructor_name']              = $this->session->userdata('fullname');
        $data['instructor_id']                = $instructor_id;
        $data['module']                       = "frontend";
        $data['page']                         = "themes/default/instructor/instructor_profile_show";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function instructor_profile_edit()
    {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $enterprise_id              = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $instructor_id              = $this->session->userdata('user_id');
        $data['title']              = 'instructor Profile Edit';
        $data['instructor_info']    = $this->Instructor_model->instructor_info();
        $data['instructor_profi']   = $this->Instructor_model->get_instructorproficiency($instructor_id);
        $data['get_userexperience'] = $this->Instructor_model->get_userexperience($instructor_id);
        $data['get_usereducation']  = $this->Instructor_model->get_usereducation($instructor_id);
        $data['course_list']        = $this->Instructor_model->allcourse_list($instructor_id);
        $data['certificates']       = $this->Instructor_model->allcertificates($instructor_id);
        $data['instructor_name']    = $this->session->userdata('fullname');
        $data['get_featuredproject']= $this->Instructor_model->get_featuredproject($enterprise_id, $this->user_id);
        $data['module']             = "frontend";
        $data['page']               = "themes/default/instructor/instructor_profile_edit";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
     // ================ its for type_wise_instructor_project_load ==============
     public function type_wise_instructor_project_load(){
        $type                         = $this->input->post('type', True);
        $data['mode']                 = $this->input->post('mode', TRUE);
        $instructor_id                = $this->input->post('instructor_id', TRUE);
        $enterprise_id                = $this->input->post('enterprise_id', TRUE);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', TRUE);
        if($this->user_id){
            $instructor_id = $this->user_id;
        }else{
            $instructor_id = $instructor_id;
        }
        $data['get_typewisproject']   = $this->Instructor_model->get_typewisproject($type, $enterprise_id, $instructor_id);
        $this->load->view('frontend/themes/default/instructor/get_typewisproject', $data);
    }
     // ================ its for type_wise_instructor_project_load ==============
     public function type_wise_instructor_project_public(){
        $type                         = $this->input->post('type', True);
        $data['mode']                 = $this->input->post('mode', TRUE);
        $instructor_id                = $this->input->post('instructor_id', TRUE);
        $enterprise_id                = $this->input->post('enterprise_id', TRUE);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', TRUE);
       
        $data['get_typewisproject']   = $this->Instructor_model->get_typewisproject($type, $enterprise_id, $instructor_id);
        $this->load->view('frontend/themes/default/instructor/get_typewisproject', $data);
    }

    public function instructor_project_add()
    {   $instructor_id              = $this->session->userdata('user_id');
        $data['title']              = 'Add Project';
        $data['instructor_info']    = $this->Instructor_model->instructor_info();
        $data['instructor_name']    = $this->session->userdata('fullname');
        $enterprise_id              = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_courses']        = $this->Frontend_model->get_courses($enterprise_id, $instructor_id);
        
        $data['module']             = "frontend";
        $data['page']               = "themes/default/instructor/instructor_project_add";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
    public function instructor_project_save(){
        $enterprise_id                  = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $project_id                     = time();
        $user_id                        = $this->user_id;
        $title                          = $this->input->post('title', TRUE);
        $projecttype                    = $this->input->post('projecttype', TRUE);
        $projectsave = $this->input->post('projectsave');
        $projectpublish = $this->input->post('projectpublish');
        if($projectsave == 'Save Draft'){
            $publish_status = 0;
            $is_visibility = 0;
            $project_status = 4; // 4=not submit for instructor review 
        }
        if($projectpublish == 'Publish'){
            $publish_status = 1;
            $is_visibility = 1;
            $project_status = 4; // 4=not submit for instructor review 
        }
        // $publish_status                 = $this->input->post('publish_status', TRUE);
        // $visibilityonportfolio          = $this->input->post('visibilityonportfolio', TRUE);
        // $visibilityonportfolio          = (!empty($visibilityonportfolio) ? $visibilityonportfolio : 0);
        $publishdate                    = $this->input->post('publishdate', TRUE);
        $publishdate                    = date('Y-m-d', strtotime($publishdate));
        $skills                         = $this->input->post('skills', TRUE);
        $software_used                  = $this->input->post('software_used', TRUE);
        $tags                           = $this->input->post('tags', TRUE);
        $course_id                      = $this->input->post('course_id', TRUE);
        $section_id                     = $this->input->post('section_id', TRUE);
        $lesson_id                      = $this->input->post('lesson_id', TRUE);
        $client_name = $this->input->post('client_name', TRUE);
        $clientproject_year = $this->input->post('clientproject_year', TRUE);
        $clientwebsite_url = $this->input->post('clientwebsite_url', TRUE);
        $project_topic = $this->input->post('project_topic', TRUE);
        $personal_projectyear = $this->input->post('personal_projectyear', TRUE);
        $personal_websiteurl = $this->input->post('personal_websiteurl', TRUE);
        $coursetype = $this->input->post('coursetype', TRUE);
        // $getfeatured                    = $this->input->post('getfeatured', TRUE);
        // $getfeatured                    = (!empty($getfeatured) ? $getfeatured : 0);
        $coverpic                       = $this->fileupload->do_upload(
            'assets/uploads/projects/', 'coverpic', 'gif|jpg|png|jpeg|svg'
        );

         // if logo is uploaded then resize the logo
         if ($coverpic !== false && $coverpic != null) {
            $this->fileupload->do_resize(
                    $coverpic, 280, 192
            );
        }
        
        $content_sl                     = $this->input->post('content_sl', TRUE);
        $contentimg_sl                  = $this->input->post('contentimg_sl', TRUE);
        $contentvideo_sl                = $this->input->post('contentvideo_sl', TRUE);
        $content                        = $this->input->post('content', TRUE);
        $content_img                    = (@$_FILES['content_img']?@$_FILES['content_img']['name']:'noimg');
        $content_video                  = $this->input->post('content_video', TRUE);
        $content_file                   = $this->input->post('content_file', TRUE);
        
// ============ its for multiple content ==================
        if($content){
            for($i=0; $i<count($content); $i++){
                $contents = $content[$i];
                $contentdata     = array(
                    'project_id' => $project_id,
                    'type'       => 1,
                    'content_sl' => $content_sl[$i],
                    'value'      => $contents,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
        
        // ================== its for multiple content image =============
         if($content_img != 'noimg'){            
        $filesCount = count($_FILES['content_img']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['pictures']['name']     = $_FILES['content_img']['name'][$i];
            $_FILES['pictures']['type']     = $_FILES['content_img']['type'][$i];
            $_FILES['pictures']['tmp_name'] = $_FILES['content_img']['tmp_name'][$i];
            $_FILES['pictures']['error']    = $_FILES['content_img']['error'][$i];
            $_FILES['pictures']['size']     = $_FILES['content_img']['size'][$i];

            // configure for upload 
            $config = array(
                'upload_path'     => "assets/uploads/projects/",
                'allowed_types'   => "gif|jpg|png|jpeg|pdf",
                'overwrite'       => TRUE,
                'encrypt_name'    => TRUE,
                'max_size'        => '0',
            );
            $image_data = array();

// autoload the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('pictures')) {
                $image_data              = $this->upload->data();
                $image_name              = 'assets/uploads/projects/' . $image_data['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image']  = $image_data['full_path']; //get original image
                $config['maintain_ratio']= TRUE;
                $config['height'] = 656;
                $config['width'] = 1050;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->translate_errors();
                }

                $productpictureinfo[$i]['project_id'] = $project_id;
                $productpictureinfo[$i]['value']      = $image_name;
                $productpictureinfo[$i]['type']       = '2'; // content image or file
                $productpictureinfo[$i]['content_sl'] = $contentimg_sl[$i];
            }
        }
        if (!empty($productpictureinfo)) {
            $insert = $this->db->insert_batch('project_details_tbl', $productpictureinfo);
        }
    }
        // =================== close ===============

        // ============ its for multiple contentvideo ==================
        if($content_video){
            for($i=0; $i<count($content_video); $i++){
                $contentvideo = $content_video[$i];
                $contentdata = array(
                    'project_id' => $project_id,
                    'type'       => 3,
                    'content_sl' => $contentvideo_sl[$i],
                    'value'      => $contentvideo,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
       

        $projectsave    = $this->input->post('projectsave', TRUE);
        $projectpublish = $this->input->post('projectpublish', TRUE);

        $projectdata = array(
            'project_id'       => $project_id,
            'user_id'          => $user_id,
            'title'            => $title,
            'project_type'     => $projecttype,
            'publishdate'      => $publishdate, 
            'skills'           => $skills,
            'software_used'    => $software_used,
            'tags'             => $tags,
            'is_visibility'    => $is_visibility,
            'publish_status' => $publish_status, 
            'project_status' => $project_status, 
            'course_id'        => $course_id,
            'section_id'       => $section_id,
            'lesson_id'        => $lesson_id,
            'enterprise_id'    => $enterprise_id,
            'coursetype' => $coursetype,
            'client_name' => $client_name,
            'clientproject_year' => $clientproject_year,
            'clientwebsite_url' => $clientwebsite_url,
            'project_topic' => $project_topic,
            'personal_projectyear' => $personal_projectyear,
            'personal_websiteurl' => $personal_websiteurl,
            'coverpic'         => $coverpic,
            // 'getfeatured'      => $getfeatured,
            'type'             => 2, 
            'created_by'       => $this->user_id,
            'created_date'     => date('Y-m-d H:i:s'),
        );
        // dd($projectdata);
        $this->db->insert('project_tbl', $projectdata);
        $this->session->set_flashdata('success', "<div class='alert alert-success'>Project added successfully!</div>");
        redirect($this->enterprise_shortname . '/instructor-project-add');

    }
    
    public function instructor_project_edit($project_id) {
        $data['transfarentmenu']           = '1';
       $instructor_id              = $this->session->userdata('user_id');
        $enterprise_id                     = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting']            = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_projecteditdata']       = $this->Frontend_model->get_projecteditdata($project_id);
        $data['get_projectdetails']        = $this->Frontend_model->get_projectdetails($project_id);
        $data['get_courses']               = $this->Frontend_model->get_courses($enterprise_id, $instructor_id);
        $course_id                         = $data['get_projecteditdata']->course_id;
        $section_id                        = $data['get_projecteditdata']->section_id;
        $lesson_id                         = $data['get_projecteditdata']->lesson_id;
        $data['get_sectionbycourse']       = $this->Frontend_model->get_sectionbycourse($course_id, $enterprise_id);
        $data['get_lessonbycoursesection'] = $this->Frontend_model->get_lessonbycoursesection($course_id, $section_id, $enterprise_id);
        $data['get_projectdetailsmax_sl']  = $this->Frontend_model->get_projectdetailsmax_sl($project_id);
        $data['module']                    = "frontend";
        $data['page']                      = "themes/default/instructor/instructor_project_edit";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function instructor_project_update(){
        $enterprise_id               = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $project_id                  = $this->input->post('project_id', TRUE);
        $user_id                     = $this->user_id;
        $title                       = $this->input->post('title', TRUE);
        $projecttype                 = $this->input->post('projecttype', TRUE);
        
        $projectsave = $this->input->post('projectsave');
        $projectpublish = $this->input->post('projectpublish');

        if($projectsave == 'Save Draft'){
            $publish_status = 0;
            $is_visibility = 0;
            $project_status = 4; // 4=not submit for instructor review 
        }
        if($projectpublish == 'Publish'){
            $publish_status = 1;
            $is_visibility = 1;
            $project_status = 4; // 4=not submit for instructor review 
        }

        // $publish_status              = $this->input->post('publish_status', TRUE);
        // $visibilityonportfolio       = $this->input->post('visibilityonportfolio', TRUE);
        // $visibilityonportfolio       = (!empty($visibilityonportfolio) ? $visibilityonportfolio : 0);
        $publishdate                 = $this->input->post('publishdate', TRUE);
        $publishdate                 = date('Y-m-d', strtotime($publishdate));
        $skills                      = $this->input->post('skills', TRUE);
        $software_used               = $this->input->post('software_used', TRUE);
        $tags                        = $this->input->post('tags', TRUE);
        $course_id                   = $this->input->post('course_id', TRUE);
        $section_id                  = $this->input->post('section_id', TRUE);
        $lesson_id                   = $this->input->post('lesson_id', TRUE);
        $client_name = $this->input->post('client_name', TRUE);
        $clientproject_year = $this->input->post('clientproject_year', TRUE);
        $clientwebsite_url = $this->input->post('clientwebsite_url', TRUE);
        $project_topic = $this->input->post('project_topic', TRUE);
        $personal_projectyear = $this->input->post('personal_projectyear', TRUE);
        $personal_websiteurl = $this->input->post('personal_websiteurl', TRUE);
        $coursetype = $this->input->post('coursetype', TRUE);
        // $getfeatured                 = $this->input->post('getfeatured', TRUE);
        // $getfeatured                 = (!empty($getfeatured) ? $getfeatured : 0);
        $old_coverpic                = $this->input->post('old_coverpic', True);
        $coverpic                    = $this->fileupload->update_doupload(
                $project_id, 'assets/uploads/projects/', 'coverpic', 'gif|jpg|png|jpeg|pdf'
        );
        
        $content_sl                  = $this->input->post('content_sl', TRUE);
        $contentimg_sl               = $this->input->post('contentimg_sl', TRUE);
        $contentvideo_sl             = $this->input->post('contentvideo_sl', TRUE);
        $content                     = $this->input->post('content', TRUE);
        $content_img                 = (@$_FILES['content_img']?@$_FILES['content_img']['name']:'noimg');
        $content_video               = $this->input->post('content_video', TRUE);
        $content_file                = $this->input->post('content_file', TRUE);
        
// ============ its for multiple content ==================
        if($content){
            for($i=0; $i<count($content); $i++){
                $contents = $content[$i];
                $contentdata = array(
                    'project_id' => $project_id,
                    'type'       => 1,
                    'content_sl' => $content_sl[$i],
                    'value'      => $contents,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
        
        // ================== its for multiple content image =============
         if($content_img != 'noimg'){            
        $filesCount = count($_FILES['content_img']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['pictures']['name']     = $_FILES['content_img']['name'][$i];
            $_FILES['pictures']['type']     = $_FILES['content_img']['type'][$i];
            $_FILES['pictures']['tmp_name'] = $_FILES['content_img']['tmp_name'][$i];
            $_FILES['pictures']['error']    = $_FILES['content_img']['error'][$i];
            $_FILES['pictures']['size']     = $_FILES['content_img']['size'][$i];

            // configure for upload 
            $config = array(
                'upload_path'     => "assets/uploads/projects/",
                'allowed_types'   => "gif|jpg|png|jpeg|pdf",
                'overwrite'       => TRUE,
                'encrypt_name'    => TRUE,
                'max_size'        => '0',
            );
            $image_data = array();

// autoload the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('pictures')) {
                $image_data               = $this->upload->data();
                $image_name               = 'assets/uploads/projects/' . $image_data['file_name'];
                $config['image_library']  = 'gd2';
                $config['source_image']   = $image_data['full_path']; //get original image
                $config['maintain_ratio'] = TRUE;
                $config['height'] = 656; //763;
                $config['width'] = 1050; //470;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->translate_errors();
                }

                $productpictureinfo[$i]['project_id'] = $project_id;
                $productpictureinfo[$i]['value']      = $image_name;
                $productpictureinfo[$i]['type']       = '2';
                $productpictureinfo[$i]['content_sl'] = $contentimg_sl[$i];
            }
        }
        if (!empty($productpictureinfo)) {
            $insert = $this->db->insert_batch('project_details_tbl', $productpictureinfo);
        }
    }
        // =================== close ===============

        // ============ its for multiple contentvideo ==================
        if($content_video){
            for($i=0; $i<count($content_video); $i++){
                $contentvideo = $content_video[$i];
                $contentdata = array(
                    'project_id' => $project_id,
                    'type'       => 3, // content video link
                    'content_sl' => $contentvideo_sl[$i],
                    'value'      => $contentvideo,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
       

        $projectsave = $this->input->post('projectsave', TRUE);
        $projectpublish = $this->input->post('projectpublish', TRUE);

        $projectdata = array(
            'user_id'           => $user_id,
            'title'             => $title,
            'project_type'      => $projecttype,
            'publishdate'       => $publishdate, 
            'skills'            => $skills,
            'software_used'     => $software_used,
            'tags'              => $tags,
            'is_visibility'     => $is_visibility,
            'publish_status' => $publish_status, 
            'project_status' => $project_status,
            'course_id'         => $course_id,
            'section_id'        => $section_id,
            'lesson_id'         => $lesson_id,
            'coursetype' => $coursetype,
            'client_name' => $client_name,
            'clientproject_year' => $clientproject_year,
            'clientwebsite_url' => $clientwebsite_url,
            'project_topic' => $project_topic,
            'personal_projectyear' => $personal_projectyear,
            'personal_websiteurl' => $personal_websiteurl,
            'enterprise_id'     => $enterprise_id,
            'coverpic'          => (!empty($coverpic) ? $coverpic : $old_coverpic),
            // 'getfeatured'       => $getfeatured,
            'type'              => 2,
            'updated_by'        => $this->user_id,
            'updated_date'      => date('Y-m-d H:i:s'),
        );
        $this->db->where('project_id', $project_id)->update('project_tbl', $projectdata);
        $this->session->set_flashdata('success', "<div class='alert alert-success'>Project updated successfully!</div>");
        redirect($this->enterprise_shortname . '/instructor-profile-edit');
    }

     // ============ its for instructor_project_view =================
     public function instructor_project_view($project_id){
        $data['transfarentmenu']          = '1';
        $enterprise_id                    = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting']           = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_instructorinfo']       = get_instructorinfo($this->user_id);
        $data['get_projectsingledata']    = $this->Instructor_model->get_projectsingledata($project_id);
        $data['get_singleprojectdetails'] = $this->Instructor_model->get_singleprojectdetails($project_id);
        $data['get_likeunlikestatus'] = $this->Frontend_model->get_likeunlikestatus($project_id, $this->user_id, $enterprise_id);

        $data['projectlikecount'] = get_projectlikecount($project_id, $enterprise_id);
        $data['projectcommentcount'] = get_projectcommentcount($project_id, $enterprise_id);
        $data['projectviewcount'] = get_projectviewcount($project_id, $enterprise_id);

        $data['module']                   = "frontend";
        $data['page']                     = "themes/default/instructor/instructor_project_view";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

 

     // ============ its for instructor_project_review =================
     public function instructor_project_review($project_id){
        $data['transfarentmenu']          = '1';
        $enterprise_id                    = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting']           = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_projectsingledata']    = $this->Instructor_model->get_projectsingledata($project_id);
        $data['get_singleprojectdetails'] = $this->Instructor_model->get_singleprojectdetails($project_id);
        $data['get_studentinfo']          = get_studentinfo(($data['get_projectsingledata']->created_by));
        $data['module']                   = "frontend";
        $data['page']                     = "themes/default/instructor/instructor_project_review";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
    public function instructor_project_review_submit(){
        $enterprise_id             = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id                   = $this->input->post('user_id', true);
        $project_status            = $this->input->post('project_status', true);
        $comment                   = $this->input->post('comment', true);
        $project_id                = $this->input->post('project_id', true);
        $chapter_source            = $this->input->post('chapter_source', true);
        $lesson_source             = $this->input->post('lesson_source', true);
        $student_id                = $this->input->post('student_id', true);
        $reviewdata = array(
            'chapter_source' => $chapter_source,
            'lesson_source'  => $lesson_source,
            'project_status' => $project_status,
            'is_visibility' => (($project_status == 1) ? 1 : 0),
            'comment'        => $comment,
        );
      
       if($project_status==1){
            $data_nofi=array(
                'notification_id'  =>$project_id,
                'student_id'       =>$student_id,
                'notification_type'=>6,
                'type'             =>1,
                'created_date'     =>date('Y-m-d H:i:s'),
                'isNotify'         =>1,
                'enterprise_id'    =>$enterprise_id,
            ); 
            $this->db->insert('notifications_tbl', $data_nofi);
       }
       if($project_status==2){
        $data_nofi=array(
            'notification_id'  =>$project_id,
            'student_id'       =>$student_id,
            'notification_type'=>6,
            'type'             =>2,
            'created_date'     =>date('Y-m-d H:i:s'),
            'isNotify'         =>1,
            'enterprise_id'    =>$enterprise_id,
        ); 
        $this->db->insert('notifications_tbl', $data_nofi);
       }
        $this->db->where('project_id', $project_id)->update('project_tbl', $reviewdata);
        echo "Review submited successfully!";
    }

    public function instructor_project_delete(){
        $project_id = $this->input->post('project_id', TRUE);
        $singledata = $this->db->select('*')->from('project_tbl')->where('project_id', $project_id)->get()->row();
        if($project_id){
            if ($project_id && (!empty($singledata->coverpic))) {
                $img_path = FCPATH . $singledata->coverpic;
                unlink($img_path);
            }
            $this->db->where('project_id', $project_id)->delete('project_tbl');
            $this->db->where('project_id', $project_id)->delete('project_details_tbl');
            echo 'Deleted successfully!';
        }
    }

      public function courses(){   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $instructor_id             = $this->session->userdata('user_id');
        $blank_param               = ''; 
        $data['title']             = 'instructor Courses';
        $enterprise_id             = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['course_list']       = $this->Instructor_model->course_list($instructor_id);
        $data['total_course']      = $this->Instructor_model->total_instructor_course($instructor_id,$blank_param);
        $data['active_course']     = $this->Instructor_model->total_instructor_course($instructor_id,1);
        $data['pending_course' ]   = $this->Instructor_model->total_instructor_pendingcourse($instructor_id,2);
        $data['draf_course']       = $this->Instructor_model->total_instructor_draftcourse($instructor_id);
        $data['get_reviewproject'] = $this->Instructor_model->get_reviewproject($instructor_id, $enterprise_id);
        // dd($data['pending_course']);
        $data['module']            = "frontend";
        $data['page']              = "themes/default/instructor/instructor_courses";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
      public function single_instructor_courses($instructor_id){  
        // $instructor_id             = $this->session->userdata('user_id');
        $blank_param               = '';
        $data['title']             = 'Instructor Courses';
        $data['instructor_info']   = get_instructorinfo($instructor_id);
        $enterprise_id             = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['course_list']       = $this->Instructor_model->allcourse_list($instructor_id);
        $data['instructor_name']              = $this->session->userdata('fullname');
        $data['instructor_id']                = $instructor_id;
        
        $data['module']            = "frontend";
        $data['page']              = "themes/default/instructor/single_instructor_courses";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
      public function single_instructor_activities($instructor_id){  
        $data['title']               = 'Instructor Activities';
        $data['instructor_info']     = get_instructorinfo($instructor_id);
        $enterprise_id               = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_featuredproject'] = $this->Instructor_model->get_featuredproject($enterprise_id, $instructor_id);
        $data['get_forumlist']       = $this->Instructor_model->get_forumlist($enterprise_id);
        $data['instructor_name']              = $this->session->userdata('fullname');
        $data['instructor_id']                = $instructor_id;
        
        $data['module']              = "frontend";
        $data['page']                = "themes/default/instructor/single_instructor_activities";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function courseload_withprojectsummary(){
        $course_id                          = $this->input->post('course_id', True);
        $data['enterprise_shortname']       = $this->enterprise_shortname;
        $data['get_courseinfo']             = $this->Instructor_model->get_courseinfo($course_id);
        $data['reviewpending_projectcount'] = $this->Instructor_model->reviewpending_projectcount($course_id);
        $data['get_reviewpendingproject']   = $this->Instructor_model->get_reviewpendingproject($course_id);
        $this->load->view('frontend/themes/default/instructor/loadcourse_withprojectsummary', $data);
    }

    // public function course_agreement_submit(){
    //     $courseid = $this->input->post('course_id', TRUE);
        
    //     //apps_logo upload
    //     $submit_agreement = $this->fileupload->do_resumeupload(
    //         'assets/uploads/docusin/', 'submit_agreement','gif|jpg|png|jpeg|ico|pdf|svg'
    //     );
    //     $docusigndata = array(
    //         'submit_agreement'        => (!empty($submit_agreement) ? $submit_agreement : $this->input->post('old_docusign', true)),
    //     );
    //     // dd($docusigndata);
    //     $this->db->where('course_id', $courseid)->update('course_tbl', $docusigndata);
    //     // echo 'Resume updated successfully!';
        
    //     $upload = 'err'; 
    //     if(!empty($_FILES['submit_agreement'])){ 
            
    //         // File upload configuration 
    //         $targetDir = "assets/uploads/"; 
    //         $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif', 'svg'); 
            
    //         $fileName = basename($_FILES['submit_agreement']['name']); 
    //         $targetFilePath = $targetDir.$fileName; 
            
    //         // Check whether file type is valid 
    //         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    //         if(in_array($fileType, $allowTypes)){ 
    //             // Upload file to the server 
    //             $upload = 'ok'; 
    //             // if(move_uploaded_file($_FILES['resume']['tmp_name'], $targetFilePath)){ 
    //             //     $upload = 'ok'; 
    //             // } 
    //         } 
    //     } 
    //     echo $upload; 
    // }

     
public function signedagreementupload(){
    $course_id    = $this->input->post('course_id');
    // $status    = $this->input->post('status');
    // $oldfile      = $this->input->post('old_downloadable');
    $files        = $this->input->post('signedagreement');
    $total        = $this->input->post('totalfile');
    $file_id        = $this->input->post('file_id');

    // $docusign = $this->fileupload->do_resumeupload(
    //     'assets/uploads/downloadfile/', 'downloadable_file','*'
    // );
    

    $config = array(
        'upload_path' => "assets/uploads/downloadfile/",
        'allowed_types' => "*",
        'overwrite' => TRUE,
        'encrypt_name' => false,
        'maintain_ratio' => true,
        'remove_spaces' => true,
        'file_ext_tolower' => true,
        'file_name' => date('dHis').'-f-'.str_replace(" ","-",$_FILES['signedagreement']['name']),
    );
        $image_data = array();
    // autoload the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('signedagreement');
            $image_data = $this->upload->data();
            // $image_name = 'assets/uploads/downloadfile/' . $image_data['file_name'];
            $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['signedagreement']['name']); //$image_data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $image_data['full_path']; //get original image
            $config['maintain_ratio'] = TRUE;
            $config['height'] = 800;
            $config['width'] = 800;
            $this->load->library('image_lib', $config);
            $this->image_lib->clear();
            $this->image_lib->initialize($config);

    $submit_agreementdata = array(
        // 'course_id'    => $course_id,
        // 'files'        => (!empty($docusign) ? $docusign : $this->input->post('old_downloadable', true)),
        'submit_agreement'        => $image_name,
        'agreement_status'   => 3,
    );
    
    $this->db->where('course_id', $course_id)->update('course_tbl', $submit_agreementdata);
   
//     if($status=="delete"){

//         $this->db->where('course_id', $course_id)->where('id', $file_id)->delete('course_resource_tbl');
//         $this->db->insert('course_resource_tbl', $docusigndata); 
         
//     }else{
          
//         if($file_id){
//             $this->db->where('course_id', $course_id)->where('id', $file_id)->delete('course_resource_tbl');
//             $this->db->insert('course_resource_tbl', $docusigndata);
//         }else{
//             $this->db->insert('course_resource_tbl', $docusigndata);
//         }

// }
  
}

    public function course_form()
    {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['title']          = 'instructor Course Add';
        $data['module']         = "frontend";
        $data['faculty_id']     = $this->session->userdata('user_id');
        $data['category_list']  = $this->Instructor_model->category_list($enterprise_id);
        $data['related_courses']= $this->Instructor_model->related_courselist($enterprise_id);
        $data['docusin_link']   = $this->Instructor_model->docusin_link($enterprise_id);
        $data['get_languages'] = get_languages();
        $data['page']           = "themes/default/instructor/add_course";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function activities()
    {   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $instructor_id             = $this->session->userdata('user_id');
        $data['title']               = 'instructor Courses';
        $enterprise_id               = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_featuredproject'] = $this->Instructor_model->get_featuredproject($enterprise_id, $this->user_id);
        $data['get_forumlist']       = $this->Instructor_model->get_forumlist($enterprise_id, $instructor_id);
        // dd($data['get_forumlist']);
        $data['module']              = "frontend";
        $data['page']                = "themes/default/instructor/instructor_activities";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function earnings(){   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $instructor_id          = $this->session->userdata('user_id');
        $current_month          = date('m');
        $data['title']          = 'instructor Courses';
        $data['module']         = "frontend";
        $data['course_earning'] = $this->Instructor_model->instructor_course_earnings($instructor_id,$current_month);
        $data['current_balance']= $this->Instructor_model->instructor_current_balance($instructor_id);
        $data['life_time_earn'] = $this->Instructor_model->instructor_course_earnings($instructor_id,'');
        $data['instructor_totalpayment'] = $this->Instructor_model->instructor_payment($instructor_id,'');
        $data['chart_alldays']  = $this->Instructor_model->chart_current_monthall_days();
        $data['earns_chartdata']= $this->Instructor_model->earnings_chartdata($instructor_id);
        $data['withdrawearnings_months']= $this->Instructor_model->withdrawearnings_months($instructor_id);
        // d($data['earns_chartdata']);
        // dd($data['withdrawearnings_months']);
        $data['get_userbkashinfo']= $this->Instructor_model->get_usermobilebankinginfo($instructor_id, 1);
        $data['get_usernagadinfo']= $this->Instructor_model->get_usermobilebankinginfo($instructor_id, 2);
        $data['get_userbankinginfo']= $this->Instructor_model->get_userbankinginfo($instructor_id, 4);
        $data['get_userpaymentinfo']= $this->Instructor_model->get_userpaymentinfo($instructor_id);
        $data['get_userThismonthwithdrawamount']= $this->Instructor_model->get_userThismonthwithdrawamount($instructor_id, $current_month);

        if($data['get_userpaymentinfo']){
            $data['paymentmethodstatus'] = '1';
        }else{
            $data['paymentmethodstatus'] = '0';
        }
        
        $data['get_withdrawrequest'] = $this->Instructor_model->get_withdrawrequest($instructor_id);


        $data['page']           = "themes/default/instructor/instructor_earnings";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function user_paymentmethodsave(){
        $user_id = $this->input->post('user_id');
        $enterprise_id = $this->input->post('enterprise_id');        
        $bkash = $this->input->post('bkash');
        $nagad = $this->input->post('nagad');
        $bkashnumber = $this->input->post('bkashnumber');
        $nagadNumber = $this->input->post('nagadNumber');
        if(($bkash == 1) && ($nagad == 1)){
            $check_userpaymentmethod = $this->Instructor_model->check_userpaymentmethod($user_id, $bkash, $nagad);
            if($check_userpaymentmethod){
                echo '12';
                exit();
            }else{
                $bkashdata = array(
                    'user_id' => $user_id,
                    'enterprise_id' => $enterprise_id,
                    'payment_type' => 1,
                    'bank_name' => 'Bkash',
                    'account_number' => $bkashnumber,
                    'branch_name' => '',
                    'account_name' => '',
                    'mobile_no' => $bkashnumber,
                    'status' => 1,
                    'created_by' => $this->user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('instructor_paymentmethods_tbl', $bkashdata);
                $nagaddata = array(
                    'user_id' => $user_id,
                    'enterprise_id' => $enterprise_id,
                    'payment_type' => 2,
                    'bank_name' => 'Nagad',
                    'account_number' => $nagadNumber,
                    'branch_name' => '',
                    'account_name' => '',
                    'mobile_no' => $nagadNumber,
                    'status' => 1,
                    'created_by' => $this->user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('instructor_paymentmethods_tbl', $nagaddata);
                echo 'ok';
            }            
        }elseif(($bkash == 1)){
            $check_userpaymentmethod = $this->Instructor_model->check_userpaymentmethod($user_id, 1, '');
            if($check_userpaymentmethod){
                $bkashdata = array(
                    'account_number' => $bkashnumber,
                    'mobile_no' => $bkashnumber,
                );
                $this->db->where('id', $check_userpaymentmethod->id)->update('instructor_paymentmethods_tbl', $bkashdata);
                // echo '1';
                // exit();
                echo 'ok';
            }else{
            $bkashdata = array(
                'user_id' => $user_id,
                'enterprise_id' => $enterprise_id,
                'payment_type' => 1,
                'bank_name' => 'Bkash',
                'account_number' => $bkashnumber,
                'branch_name' => '',
                'account_name' => '',
                'mobile_no' => $bkashnumber,
                'status' => 1,
                'created_by' => $this->user_id,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('instructor_paymentmethods_tbl', $bkashdata);
            echo 'ok';
        }
        }elseif(($nagad == 1)){
            $check_userpaymentmethod = $this->Instructor_model->check_userpaymentmethod($user_id, '', 2);
            // d($check_userpaymentmethod);
            if($check_userpaymentmethod){

                $nagaddata = array(
                    'account_number' => $nagadNumber,
                    'mobile_no' => $nagadNumber,
                );
                $this->db->where('id', $check_userpaymentmethod->id)->update('instructor_paymentmethods_tbl', $bkashdata);
                // echo '2';
                // exit();
            }else{
            $nagaddata = array(
                'user_id' => $user_id,
                'enterprise_id' => $enterprise_id,
                'payment_type' => 2,
                'bank_name' => 'Nagad',
                'account_number' => $nagadNumber,
                'branch_name' => '',
                'account_name' => '',
                'mobile_no' => $nagadNumber,
                'status' => 1,
                'created_by' => $this->user_id,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('instructor_paymentmethods_tbl', $nagaddata);
            echo 'ok';
            }
        }

    }
    public function user_bankpaymentmethodsave(){
        $user_id = $this->input->post('user_id');
        $enterprise_id = $this->input->post('enterprise_id');  
        $payment_type = $this->input->post('payment_type');  
        $bank_name = $this->input->post('bank_name');  
        $branch_name = $this->input->post('branch_name');  
        $account_name = $this->input->post('account_name');  
        $account_number = $this->input->post('account_number');  
        $mobile_no = $this->input->post('mobile_no');  
        
        $bankdata = array(
            'user_id' => $user_id,
            'enterprise_id' => $enterprise_id,
            'payment_type' => $payment_type,
            'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'account_name' => $account_name,
            'account_number' => $account_number,
            'mobile_no' => $mobile_no,
            'status' => 1,
            'created_by' => $this->user_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('instructor_paymentmethods_tbl', $bankdata);
        echo 1;
    }

    public function remove_mobilebanking(){
        $id = $this->input->post('id');
        $check_userpaymentmethod = $this->Instructor_model->get_paymentmethodin_withdrawrequest($id);
        if($check_userpaymentmethod){
            echo 0;
        }else{
            $this->db->where('id', $id)->delete('instructor_paymentmethods_tbl');
            echo 1;
        }
    }

    public function withdraw_submit(){
        $request_id = $this->generators->withdrawrequestnumber_generator();
        $user_id = $this->input->post('user_id');
        $enterprise_id = $this->input->post('enterprise_id');  
        $payment_id = $this->input->post('payment_id');  
        $amount = $this->input->post('amount');  
        
        $withdrawdata = array(
            'request_id' => $request_id,
            'user_id' => $user_id,
            'payment_id' => $payment_id,
            'date' => date('Y-m-d'),
            'amount' => $amount,
            'status' => 4, // 4=pending
            'remarks' => '',
            'paid_by' => '',
            'payment_date' => '',
            'enterprise_id' => $enterprise_id,
            'created_by' => $this->user_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        // dd($withdrawdata);
        $saved_withdraw = $this->db->insert('payment_withdrawrequst_tbl', $withdrawdata);
        if($saved_withdraw){
            echo 1;
        }        
    }

    public function withdraw_filter(){
        $data['user_id'] = $this->input->post('user_id');
        $data['enterprise_id'] = $this->input->post('enterprise_id');
        $data['days'] = $this->input->post('days');
        $data['monthyear'] = $this->input->post('monthyear');
        $data['type'] = $this->input->post('type');
        $data['get_withdrawfilterdata'] = $this->Instructor_model->get_withdrawfilterdata($data);

        $this->load->view('frontend/themes/default/instructor/load_withdrawdata', $data);
    }


    // $this->db->where('student_id',$instructor_id)->where('enterprise_id',$enterprise_id)->count_all('notifications_tbl')


    public function notifications(){   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $enterprise_id      = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $instructor_id      = $this->session->userdata('user_id');
        $config["base_url"] = base_url($this->enterprise_shortname.'/instructor-notifications/');
        $config["total_rows"] = $this->db->where('student_id',$instructor_id)->where('enterprise_id',$enterprise_id)->count_all_results('notifications_tbl');
        // dd($config["total_rows"]);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["allnotification"] = $this->db->select("*")->from("notifications_tbl")->where('student_id',$instructor_id)
                                            ->where('enterprise_id',$enterprise_id)->order_by("id", "desc")
                                            ->limit($config["per_page"], $page)
                                            ->get()->result();
                                            
                                            // $this->Forum_model->forum_category_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['title']  = 'instructor Notifications';
        $data['module'] = "frontend";
        $data['page']   = "themes/default/instructor/instructor_notifications";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function account_settings()
    {   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['title']  = 'instructor Account settings';;
        $data['module'] = "frontend";
        $data['page']   = "themes/default/instructor/account_settings";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function instructor_notification_settings()
    {   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['title']  = 'instructor notification Settings';
        $data['check_settingnotification'] = $this->Instructor_model->check_settingnotification($this->user_id);

        $data['module'] = "frontend";
        $data['page']   = "themes/default/instructor/notification_settings";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }
    public function save_setting_notification(){
        $user_id               = $this->session->userdata('user_id', TRUE);
        $courses_site          = $this->input->post('courses_site', TRUE);
        $courses_email         = $this->input->post('courses_email', TRUE);
        $courses_sms           = $this->input->post('courses_sms', TRUE);
        $offerupdates_site     = $this->input->post('offerupdates_site', TRUE);
        $offerupdates_email    = $this->input->post('offerupdates_email', TRUE);
        $offerupdates_sms      = $this->input->post('offerupdates_sms', TRUE);
        $blog_site             = $this->input->post('blog_site', TRUE);
        $blog_email            = $this->input->post('blog_email', TRUE);
        $blog_sms              = $this->input->post('blog_sms', TRUE);
        $events_site           = $this->input->post('events_site', TRUE);
        $events_email          = $this->input->post('events_email', TRUE);
        $events_sms            = $this->input->post('events_sms', TRUE);
        $community_site        = $this->input->post('community_site', TRUE);
        $community_email       = $this->input->post('community_email', TRUE);
        $community_sms         = $this->input->post('community_sms', TRUE);
        $soundnoti_site        = $this->input->post('soundnoti_site', TRUE);
        $soundnoti_email       = $this->input->post('soundnoti_email', TRUE);
        $soundnoti_sms         = $this->input->post('soundnoti_sms', TRUE);

        $check_settingnotification = $this->Instructor_model->check_settingnotification($user_id);

        $notificationdata = array(
            'user_id'           => (!empty($user_id) ? $user_id : ''),
            'courses_site'      => (!empty($courses_site) ? $courses_site : '0'),
            'courses_email'     => (!empty($courses_email) ? $courses_email : '0'),
            'courses_sms'       => (!empty($courses_sms) ? $courses_sms : '0'),
            'offerupdates_site' => (!empty($offerupdates_site) ? $offerupdates_site : '0'),
            'offerupdates_email'=> (!empty($offerupdates_email) ? $offerupdates_email : '0'),
            'offerupdates_sms'  => (!empty($offerupdates_sms) ? $offerupdates_sms : '0'),
            'blog_site'         => (!empty($blog_site) ? $blog_site : '0'),
            'blog_email'        => (!empty($blog_email) ? $blog_email : '0'),
            'blog_sms'          => (!empty($blog_sms) ? $blog_sms : '0'),
            'events_site'       => (!empty($events_site) ? $events_site : '0'),
            'events_email'      => (!empty($events_email) ? $events_email : '0'),
            'events_sms'        => (!empty($events_sms) ? $events_sms : '0'),
            'community_site'    => (!empty($community_site) ? $community_site : '0'),
            'community_email'   => (!empty($community_email) ? $community_email : '0'),
            'community_sms'     => (!empty($community_sms) ? $community_sms : '0'),
            'soundnoti_site'    => (!empty($soundnoti_site) ? $soundnoti_site : '0'),
            'soundnoti_email'   => (!empty($soundnoti_email) ? $soundnoti_email : '0'),
            'soundnoti_sms'     => (!empty($soundnoti_sms) ? $soundnoti_sms : '0'),
            'type'              => 2,
            'created_by'        => $user_id,
            'created_date'      => date('Y-m-d H:i:s'),
            'updated_by'        => $user_id,
            'updated_date'      => date('Y-m-d H:i:s'),
        );
        if($check_settingnotification){
            $this->db->where('user_id', $user_id)->update('notification_config_tbl', $notificationdata);
            $this->session->set_flashdata('success', "<div class='alert alert-success'>Updated successfully!</div>");
        }else{
            $this->db->insert('notification_config_tbl', $notificationdata);
            $this->session->set_flashdata('success', "<div class='alert alert-success'>Added successfully!</div>");
        }
        
        redirect($this->enterprise_shortname.'/instructor-notification-settings');
    }

    public function instructor_affiliation_setting()
    {   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['title']  = 'instructor Affiliations';
        $data['module'] = "frontend";
        $data['page']   = "themes/default/instructor/affiliations_settings";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function instructor_payment_setting()
    {   
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['title']      = 'instructor Payment settign';
        $data['module']     = "frontend";
        $data['page']       = "themes/default/instructor/instructor_payment_setting";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function change_password()
    {
        $user_id                = $this->input->post('user_id', TRUE);
        $current_password       = $this->input->post('current_password', TRUE);
        $new_password           = $this->input->post('new_password', TRUE);
        $retype_password        = $this->input->post('retype_password', TRUE);
        $check_current_password = $this->Instructor_model->check_current_password($user_id,$current_password);
        if($check_current_password == 0){
         $result['status']      = 0;
         $result['message']     = 'Invalid Current Password';
        }else{
        if($new_password != $retype_password){
         $result['status']      = 0;
         $result['message']     = 'New Password and Retype Password Did not Match';
        }else{
         $data = array(
            'log_id'   => $user_id,
            'password' => md5($new_password),
         );
         $change_password = $this->Instructor_model->update_instructor($data);
         $result['status']  = 1;
         $result['message'] = 'Password changed Successfully';
        }

        }

        echo json_encode($result);
        exit;

    }

    public function instructor_language_change()
    {
        $user_id            = $this->input->post('user_id', TRUE);
        $language           = $this->input->post('language', TRUE);
        $change_language    = $this->Instructor_model->change_language($user_id,$language);
        if($change_language){
         $result['status']  = 1;
         $result['message'] = 'Successfully Updated';
        }else{
        $result['status']   = 0;
         $result['message'] = 'Failed';  
        }

        echo json_encode($result);
        exit();
    }


     public function instructor_sticky_note_save(){
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $user_id       = $this->input->post('user_id', TRUE);
        $title         = $this->input->post('title', TRUE);
        $description   = $this->input->post('description', TRUE);
      
        $check_stickynote = $this->Frontend_model->check_stickynote($user_id, $title);
        if($check_stickynote){
            echo 'This note already exists';
        }else{
            $stickydata = array(
                'course_id'     => '',
                'student_id'    => $user_id,
                'title'         => $title,
                'notes'         => $description,
                'status'        => 1,
                'type'          => 3,
                'enterprise_id' => $enterprise_id,
                'created_by'    => $enterprise_id,
                'created_date'  => date('Y-m-d H:i:s'),
                'updated_by'    => $enterprise_id,
                'updated_date'  => date('Y-m-d H:i:s'),
            );
            $this->db->insert('notes_tbl', $stickydata);
            echo 'Added successfully';
        }
    }

    public function instructorsticky_note_delete(){
        $id = $this->input->post('id', TRUE);
        if($id){
            $this->db->where('id', $id)->delete('notes_tbl');
        }
        echo "Deleted successfully!";
    }

    // ============= its for resume_upload ==============
    public function resume_upload(){
        $user_id       = $this->input->post('user_id', TRUE);
        $is_resumeshow = $this->input->post('is_resumeshow', TRUE);
        //apps_logo upload
        $resume = $this->fileupload->do_resumeupload(
            'assets/uploads/faculty/', 'resume','gif|jpg|png|jpeg|ico|pdf'
        );
        $resumedata = array(
            'is_resumeshow' => $is_resumeshow,
            'resume'        => (!empty($resume) ? $resume : $this->input->post('old_resume', true)),
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $resumedata);
        echo 'Resume updated successfully!';
    }

    public function instructor_fileupload_progressbar_check(){
        $user_id       = $this->input->post('user_id', TRUE);
        $is_resumeshow = $this->input->post('is_resumeshow', TRUE);

        //apps_logo upload
        $resume = $this->fileupload->do_resumeupload(
            'assets/uploads/faculty/', 'resume','gif|jpg|png|jpeg|ico|pdf|doc|docx'
        );
        $resumedata = array(
            'is_resumeshow' => $is_resumeshow,
            'resume'        => (!empty($resume) ? $resume : $this->input->post('old_resume', true)),
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $resumedata);
        // echo 'Resume updated successfully!';


        $upload = 'err'; 
        if(!empty($_FILES['resume'])){ 
            
            // File upload configuration 
            $targetDir = "assets/uploads/"; 
            $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
            
            $fileName = basename($_FILES['resume']['name']); 
            $targetFilePath = $targetDir.$fileName; 
            
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to the server 
                $upload = 'ok'; 
                // if(move_uploaded_file($_FILES['resume']['tmp_name'], $targetFilePath)){ 
                //     $upload = 'ok'; 
                // } 
            } 
        } 
        echo $upload; 
    }


     public function instructor_profile_update(){
        $user_id         = $this->input->post('user_id', TRUE);
        $is_profileshow  = $this->input->post('is_profileshow', TRUE);
        $instructorName  = $this->input->post('instructorName', TRUE);
        $designation     = $this->input->post('designation', TRUE);
        $website         = $this->input->post('website', TRUE);

        $logdata = array(
            'name' => $instructorName,
        );
        $this->db->where('log_id', $user_id)->update('loginfo_tbl', $logdata);

        $profiledata = array(
            'is_profileshow'    => $is_profileshow,
            'name'              => $instructorName,
            'designation'       => $designation,
            'website'           => $website,
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $profiledata);
        echo 'Instructor updated successfully!';
    }

       // ============= its for instructor_resume_upload_delete ==============
       public function instructor_resume_upload_delete(){
        $user_id = $this->input->post('user_id', TRUE);
        $picture_unlink = $this->db->select('*')->from('faculty_tbl')->where('faculty_id',$user_id)->get()->row();
       if (@$picture_unlink->resume) {
           $img_path = $picture_unlink->resume;
           unlink($img_path);
       }
       $resumedata = array(
         'resume'        => '',
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $resumedata);
        echo 'Resume deleted successfully!';
    }

        // ============== its for biography_update =============
    public function biography_update(){

         $user_id          = $this->input->post('user_id', TRUE);
         $is_biographyshow = $this->input->post('is_biographyshow', TRUE);

         $biography = $this->input->post('notes', TRUE);
            $biographydata = array(
                'is_biographyshow'    => $is_biographyshow,
                'biography'           => $biography,
            );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $biographydata);
        echo 'Biography updated successfully!';
    }

       public function instructor_skills_update(){
        $user_id      = $this->input->post('user_id', TRUE);
        $is_skillshow = $this->input->post('is_skillshow', TRUE);
        $skillsSelect = $this->input->post('skillsSelect', TRUE);
        
        $skilksdata = array(
            'is_skillshow' => $is_skillshow,
            'skills' => $skillsSelect,
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $skilksdata);
        echo 'Skills updated successfully!';
    }

    // ===========its for proficiency_update ==============
      public function proficiency_update(){
        $user_id            = $this->input->post('user_id', TRUE);
        $is_proficiencyshow = $this->input->post('is_proficiencyshow', TRUE);
        $proficiency        = $this->input->post('proficiencySelect', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', true);
       
        
        $proficiencydata = array(
            'is_proficiencyshow' => $is_proficiencyshow,
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $proficiencydata);

        $proficiency_exists = $this->db->where('title', $proficiency)->where('enterprise_id', $enterprise_id)->get('proficiency_tbl')->row();
        if(empty($proficiency_exists)){
            $proficiency_data = array(
                'proficiency_id' => time(),
                'title' => $proficiency,
                'status' => 1,
                'enterprise_id' => $enterprise_id,
                'created_by' => $enterprise_id,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('proficiency_tbl', $proficiency_data);            
        }

        $studentproficiency = array(
            'user_id' => $user_id,
            'proficiency' => $proficiency
        );
        if(!empty($proficiency)){
            $this->db->insert('user_proficiency_tbl', $studentproficiency);
        }

        
        echo 'Proficiency updated successfully!';
}
    // ===========its for instructor_featureshow_update ==============
      public function instructor_featureshow_update(){
        $user_id            = $this->input->post('user_id', TRUE);
        $is_featureshow = $this->input->post('is_featureshow', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', true);
       
        
        $featuredata = array(
            'is_featureshow' => $is_featureshow,
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $featuredata);    

        echo 'Updated successfully!';
}

 // ============= its for experience_save ===============
    public function experience_save(){
        $enterprise_id     = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id           = $this->session->userdata('user_id');
        $is_experienceshow = $this->input->post('is_experienceshow', TRUE);
        $is_experienceshow = (($is_experienceshow) ? '1' : '0');
        $companyname       = $this->input->post('companyname', TRUE);
        $cityname          = $this->input->post('cityname', TRUE);
        $title             = $this->input->post('title', TRUE);
        $country           = $this->input->post('country', TRUE);
        $frommonth         = $this->input->post('frommonth', TRUE);
        $fromyear          = $this->input->post('fromyear', TRUE);
        $tomonth           = $this->input->post('tomonth', TRUE);
        $toyear            = $this->input->post('toyear', TRUE);
        $hdn_nowworking    = $this->input->post('hdn_nowworking', TRUE);
        
        $facultydata = array(
            'is_experienceshow' => $is_experienceshow,
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $facultydata);

        for ($i = 0, $j = 1; $i < count($companyname); $i++, $j++) {
            $experiencedata = array(
                'user_id'       => $user_id,
                'companyname'   => $companyname[$i],
                'title'         => $title[$i],
                'city'          => $cityname[$i],
                'country'       => $country[$i],
                'frommonth'     => $frommonth[$i],
                'fromyear'      => $fromyear[$i],
                'tomonth'       => $tomonth[$i],
                'toyear'        => $toyear[$i],
                'is_now'        => (($hdn_nowworking[$i] == '') ? 0 : $hdn_nowworking[$i]),
                'status'        => 1,
                'enterprise_id' => $enterprise_id,
                'created_by'    => $this->user_id,
                'created_date'  => date('Y-m-d H:i:s'),
            );

            if(!empty($companyname[$i])){
            $this->db->insert('experience_tbl', $experiencedata);
            }
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'>Experience added successfully!</div>");
        redirect($this->enterprise_shortname . '/instructor-profile-edit');
    }


        // ============= its for experience_edit =============
    public function experience_edit(){
        $id = $this->input->post('id', TRUE);
        $data['get_experienceedit'] = $this->Frontend_model->get_experienceedit($id);
        $this->load->view('frontend/themes/default/instructor/experience_edit', $data);
    }

    // ============== its for experience_update =================== 
    public function experience_update(){
        $id            = $this->input->post('id', TRUE);
        $user_id       = $this->input->post('user_id', TRUE);
        $companyname   = $this->input->post('companyname', TRUE);
        $title         = $this->input->post('title', TRUE);
        $city          = $this->input->post('city', TRUE);
        $country       = $this->input->post('country', TRUE);
        $frommonth     = $this->input->post('frommonth', TRUE);
        $fromyear      = $this->input->post('fromyear', TRUE);
        $tomonth       = $this->input->post('tomonth', TRUE);
        $toyear        = $this->input->post('toyear', TRUE);
        $is_now        = $this->input->post('is_now', TRUE);

        $experiencedata = array(
            'companyname'  => $companyname,
            'title'        => $title,
            'city'         => $city,
            'country'      => $country,
            'frommonth'    => $frommonth,
            'fromyear'     => $fromyear,
            'tomonth'      => $tomonth,
            'toyear'       => $toyear,
            'is_now'       => $is_now,
            'updated_by'   => $this->user_id,
            'updated_date' => date('Y-m-d H:i:s'),
        );

        $this->db->where('id', $id)->update('experience_tbl', $experiencedata);
        echo 'Updated successfully!';
    }


     // ================= its for education_save ===============
    public function education_save(){
        $enterprise_id    = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id          = $this->session->userdata('user_id');
        $is_educationshow = $this->input->post('is_educationshow', TRUE);
        $is_educationshow = (($is_educationshow) ? '1' : '0');
        $institutename    = $this->input->post('institutename', TRUE);
        $degreename       = $this->input->post('degreename', TRUE);
        $passing_year     = $this->input->post('passing_year', TRUE);

        $facultydata = array(
            'is_educationshow' => $is_educationshow,
        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $facultydata);

        for ($i = 0, $j = 1; $i < count($institutename); $i++, $j++) {

            $educationdata = array(
                'log_id'        => $user_id,
                'institutename' => $institutename[$i],
                'degree'        => $degreename[$i],
                'passing_year'  => $passing_year[$i],
                'enterprise_id' => $enterprise_id,
                'created_by'    => $this->user_id,
                'created_date'  => date('Y-m-d H:i:s'),
            );
            if(!empty($institutename[$i])){
            $this->db->insert('education_tbl', $educationdata);
            }
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'>Education added successfully!</div>");
        redirect($this->enterprise_shortname . '/instructor-profile-edit');
    }

     // ============= its for education_edit =============
     public function education_edit_data(){
        $id = $this->input->post('id', TRUE);
        $data['get_educationedit'] = $this->Frontend_model->get_educationedit($id);
        $this->load->view('frontend/themes/default/instructor/education_edit', $data);
    }

    // ================= its for education_update =================
    public function education_update(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id       = $this->session->userdata('user_id');
        $id            = $this->input->post('id', TRUE);
        $institutename = $this->input->post('institutename', TRUE);
        $degree        = $this->input->post('degree', TRUE);
        $passing_year  = $this->input->post('passing_year', TRUE);
            $educationdata = array(
                'institutename' => $institutename,
                'degree'        => $degree,
                'passing_year'  => $passing_year,
                'updated_by'    => $this->user_id,
                'updated_date'  => date('Y-m-d H:i:s'),
            );
            $this->db->where('id', $id)->update('education_tbl', $educationdata);
        
        echo 'Updated successfully!';
    }

    public function contact_save()
    {
        $user_id        = $this->input->post('user_id');
        $contact_text   = $this->input->post('contact_text', TRUE);
        $public_email   = $this->input->post('public_email', TRUE);
        $is_contactshow = $this->input->post('is_contactshow', TRUE);

         $facultydata = array(
            'contact_text'   => $contact_text,
            'public_email'   => $public_email,
            'is_contactshow' => $is_contactshow

        );
        $this->db->where('faculty_id', $user_id)->update('faculty_tbl', $facultydata);
          echo 'Contact updated successfully!';
    }

    public function social_link_add()
    {  
        $mode = $this->input->post('mode', true);
        $id                  = $this->input->post('social_link_id');
        $user_id             = $this->input->post('user_id');
        $social_link_type    = $this->input->post('social_link_type', TRUE);
        $social_link         = $this->input->post('social_link', TRUE);
        $checkexistslinktype = '';
        if($mode != 'edit'){
            $checkexistslinktype = $this->db->where('user_id', $user_id)->where('link_type', $social_link_type)->get('social_links')->row();
        }
// dd($checkexistslinktype);
        if($checkexistslinktype){
            echo 'Already exist the social type';
        }else{
            $sociallinks = array(
                'user_id'   => $user_id,
                'link_type' => $social_link_type,
                'link'      => $social_link
    
            );
             if(empty($id)){
            $this->db->insert('social_links',$sociallinks);
            echo 'Successfully Saved'; 
             }else{
              $this->db->where('id', $id)->update('social_links', $sociallinks);
              echo 'Updated successfully!';   
             }
        }
         
       
    }

    public function social_link_ajaxlist()
    {
       $user_id            = $this->input->post('user_id');
       $social_links       = $this->Instructor_model->social_links($user_id);
       $html ='';
       if($social_links){
        $sl = 1;
        foreach($social_links as $links){
            if($links->link_type == 1){
                $link = '<i class="fab fa-facebook"></i>';
               }elseif($links->link_type == 2){
                $link = '<i class="fab fa-twitter"></i>';
               }elseif($links->link_type == 3){
                $link = '<i class="fab fa-linkedin"></i>';
               }elseif($links->link_type == 4){
                 $link = '<i class="fab fa-instagram"></i>';
               }elseif($links->link_type == 5){
                  $link = '<i class="fab fa-github"></i>';
               }elseif($links->link_type == 6){
                  $link = '<i class="fab fa-youtube"></i>';
               }elseif($links->link_type == 7){
                  $link = '<i class="fab fa-vimeo"></i>';
               }elseif($links->link_type == 8){
                  $link = '<i class="fas fa-globe"></i>';
               }
            $html .='<div class="list-group-item p-0 border-0"><div class="input-group mb-3">
                      <input type="hidden" id="social_link_type_'.$sl.'" value="'.$links->link_type.'">
                      <span class="input-group-text px-2 px-sm-3">
                       <i class="fas fa-arrows-alt handle"></i>
                        </span>
                        <span class="input-group-text px-2 px-sm-3">'.$link.'</span>
                                        <input type="text" id="social_link_'.$sl.'" class="form-control form-control-lg" value="'.$links->link.'">
                                        <input type="hidden" id="social_link_id_'.$sl.'" value="'.$links->id.'">
                                        <button class="input-group-text px-2" onclick="social_update('.$sl.', '."'edit'".')"><i class="fas fa-save"></i></button>
                                        <button class="input-group-text px-2" onclick="delete_social_link('.$links->id.')"><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>';
                                $sl++;
        }
       }

       echo $html;
    }

    public function social_link_delete()
    {
         $id = $this->input->post('id', TRUE);
        if($id){
            $this->db->where('id', $id)->delete('social_links');
        }
        echo "Successfully Deleted ";
    }

     // =========== its for instructor_profile_picture_update ==================
    public function instructor_profile_picture_update(){
        $user_id       = $this->session->userdata('user_id');
        $enterprise_id = $this->input->post('enterprise_id', TRUE);

        $image = $this->fileupload->do_upload(
            'assets/uploads/faculty/',
            'profilepic', 'jpg|jpeg|png|gif|svg'
          );
      
          // if image is uploaded then resize the image
          if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
              $image, 
              120,
              120
            );
          }
          //if image is not uploaded
          if ($image === false) {
            echo "<h5>Failed</h5>Invalid Image Format";
                  exit;
          }
        //   echo $image;
        $checkprofilepic = $this->db->where('from_id', $user_id)->get('picture_tbl')->row();
         
          $pictureInfo = array(
              'from_id'      => $user_id,
              'picture'      => $image,
              'picture_type' => 'Instructor Profile',
              'status'       => 1,
              'created_by'   => $user_id,
              'created_date' => date('Y-m-d H:i:s'),
              'updated_by'   =>$user_id,
              'updated_date' => date('Y-m-d H:i:s'),
          );
          if($checkprofilepic){
            $this->db->where('from_id', $user_id)->update('picture_tbl', $pictureInfo);
        }else{
            $this->db->insert('picture_tbl', $pictureInfo);
        }
          echo "Profile picture uploaded successfully!";
    }
    // =========== its for instructor_cover_picture_update ==================
    public function instructor_cover_picture_update(){
        $user_id = $this->session->userdata('user_id');
        $enterprise_id = $this->input->post('enterprise_id', TRUE);

        $image = $this->fileupload->do_upload(
            'assets/uploads/faculty/',
            'coverpicture', 'jpg|jpeg|png|gif|svg'
          );
      
          // if image is uploaded then resize the image
          if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
              $image, 
              1904,
              428
            );
          }
          //if image is not uploaded
          if ($image === false) {
            echo "<h5>Failed</h5>Invalid Image Format";
                  exit;
          }
        //   echo $image;
          $coverphotoinfo = array(
              'coverpicture' => $image,
          );
          $this->db->where('faculty_id', $user_id)->Update('faculty_tbl', $coverphotoinfo);
          echo "Cover photo uploaded successfully!";
    }

    public function get_subcategory()
    {
        $category_id  = $this->input->post('category_id');
        $sub_category = $this->Instructor_model->get_subcategory($category_id);

        if($sub_category){
         $option = '<option value="">Select Sub Category</option>'; 
         foreach($sub_category as $catgegory){
          $option .= '<option value="'.$catgegory->category_id.'">'.$catgegory->name.'</option>';  
         }  
        }else{
         $option = '<option value="">No Sub Category Found</option>';    
        }

        echo $option;
    }

    public function save_course()
    { 
       
       $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);

        $course_id        = "CO" . date('d') . $this->generators->generator(5);
        $old_course_id    = $this->input->post('course_id', true);
        $name             = $this->input->post('courseTitle', true);
        $slug             = str_replace(" ", "-", strtolower($name));
        $slug             = rtrim($slug, "-");
        $faculty_id       = $this->input->post('faculty_id', true);
        $summary          = $this->input->post('aboutCourse', true);
        $category_id      = $this->input->post('category_id', true);
        $parent_category  = $this->input->post('courseCatagory');
        $category         = ($parent_category?$parent_category:$category_id);
        $course_level     = $this->input->post('course_level', true);
        $course_type      = '';
        $language         = $this->input->post('language', true);
        $related_courseid = $this->input->post('related_course', true);
        $related_courseid = (!empty($related_courseid) ? $related_courseid : 0);

        $related_resources= $this->input->post('relatedResources', true);
        $courses          = explode(',',$related_courseid[0]);
        $rtc              = ($related_courseid != [""]?json_encode($courses):'');
        $requirements     = $this->input->post('requirements', true);
        $benifits         = $this->input->post('benifits', true);
        $thumbnail        = $this->input->post('image', true);
        $mini_thumbnail   = $this->input->post('mini_thumbnail', true);
        $passing_grade = $this->input->post('passing_grade', true);
        // print_r($passing_grade);
        // exit;
        $meta_keyword     = $name;
        $meta_description = $summary;
      //image upload
       
        $url = $this->input->post('url', true);
        $this->load->library('Videoupload');
         $videolink = $this->videoupload->do_upload(
                'assets/uploads/course/', 'video_trailer'
        );
         $video    = $videolink;
         $old_video = $this->input->post('old_video', true);

        $this->load->library('Videoupload');
          $image = $this->videoupload->do_upload(
                'assets/uploads/course/', 'thumbnail'
        );
        if ($image !== false && $image != null) {
            $this->videoupload->do_resize(
                 $image,1903,476
            );
        }

       $thumimage = $image;
       $old_thumbnail = $this->input->post('old_thumbnail', true);

         $this->load->library('Videoupload');
          $minthum = $this->videoupload->do_upload(
                'assets/uploads/course/', 'mini_thumbnail'
        );  
        if ($minthum !== false && $minthum != null) {
            $this->videoupload->do_resize(
                 $minthum,398,224
            );
        }
        $mnth = $minthum;
        $old_minithum = $this->input->post('old_minithum', true);
        $mnth = ($minthum?$minthum:$old_minithum);
      
           $this->load->library('Videoupload');
          $hoverimage = $this->videoupload->do_upload(
                'assets/uploads/course/', 'thumbnail_hover'
        ); 
        if ($hoverimage !== false && $hoverimage != null) {
            $this->videoupload->do_resize(
                 $hoverimage,312,345
            );
        }
        $old_hover_thum = $this->input->post('old_hover_thum', true);


        $course_data = array(
            'course_id'         => ($old_course_id?$old_course_id:$course_id),
            'name'              => $name,
            'faculty_id'        => $faculty_id,
            'description'       => $summary,
            'category_id'       => ($category_id?$category_id:$parent_category),
            'subcategory_id'    => $category_id,
            'course_level'      => $course_level,
            'language'          => $language,
            'requirements'      => json_encode($requirements),
            'benifits '         => json_encode($benifits),
            'related_courseid'  => (json_encode($related_courseid) != '[""]'?$rtc:0),
            'course_provider'   => 2,
            'course_material'   => $this->input->post('courseContents', true),
            'course_result'     =>'',//$this->input->post('courseResult', true),
            'career_outcomes'   => json_encode($this->input->post('skillsGainByStudent', true)),
            'skillsgain'        => json_encode($this->input->post('skillsgain', true)),
            'course_isfor'      =>'',//$this->input->post('course_isfor', true),
            'related_resource'  => json_encode($related_resources),
            'cover_thumbnail'   => ($thumimage?$thumimage:$old_thumbnail),
            'hover_thumbnail'   => ($hoverimage?$hoverimage:$old_hover_thum),
            'url'               => $url,
            'syllabus'          => '',
            'meta_keyword'      => $meta_keyword,
            'meta_description'  => $meta_description,
            'slug'              => $slug,
            'passing_grade'     => $passing_grade,
            'status'            => 2,
            'enterprise_id'     => $enterprise_id,
            'created_date'      => date('Y-m-d H:i:s'),
            'updated_date'      => date('Y-m-d H:i:s'),
            'updated_by'        => $faculty_id,
            'created_by'        => $faculty_id,
        );
      if($old_course_id == ''){  
    $this->db->insert('course_tbl', $course_data);
     }else{
        $this->db->where('course_id', $old_course_id)
               ->update('course_tbl', $course_data);
        $this->db->where('from_id', $old_course_id)->delete('picture_tbl');        
     }
           
            if($mnth){
            $picture_data = array(
                'from_id'      => ($old_course_id?$old_course_id:$course_id),
                'picture'      => $mnth,
                'picture_type' => 'course',
                'status'       => 1,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by'   => $faculty_id,
            );


            $this->db->insert('picture_tbl', $picture_data);
        }
        
        echo ($old_course_id?$old_course_id:$course_id);
    }

    public function add_chapter()
    {
        $section_id   = "SE" . date('d') . $this->generators->generator(5);
        $old_sec_id   = $this->input->post('chapter_id');
        $course_id    = $this->input->post('course_id');
        $section_name = $this->input->post('chapter_name');
        $user_id      = $this->session->userdata('user_id');
         
       $section_data = array(
        'section_id'   => ($old_sec_id?$old_sec_id:$section_id),
        'section_name' => $section_name,
        'course_id'    => $course_id,
        'enterprise_id'=> get_enterpriseid(),
        'created_by'   => $user_id,

       );
      
      if($old_sec_id){
       $this->db->where('section_id', $old_sec_id)
               ->update('section_tbl', $section_data);
       $result['message']    = 'successfully Updated';
       $result['chapter_id'] = $old_sec_id;
      }else{
        $this->db->insert('section_tbl',$section_data);
        $result['message']    = 'successfully Saved';
        $result['chapter_id'] = $section_id;
      }

      echo json_encode($result);

    }

    public function add_lesson()
    {
        $lesson_id       = "LE" . date('d') . $this->generators->generator(5);
        $old_lesson_id   = $this->input->post('lesson_id');
        $chapter_id      = $this->input->post('chapter_id');
        $course_id       = $this->input->post('course_id');
        $lesson_name     = $this->input->post('lesson_name');
        $user_id         = $this->session->userdata('user_id');
        $lesson_desc     = $this->input->post('lesson_desc');
        $lesson_type     = $this->input->post('lesson_type', true);
        $lesson_provider = $this->input->post('lesson_provider', true);
        $attachment      = $this->input->post('attachment', TRUE);
        $provider_url    = $this->input->post('provider_url', true);
        $duration        = $this->input->post('duration', true);
        $summary         = $this->input->post('summary', true);
        $is_preview      = $this->input->post('is_preview', true);
        $is_preview      = (($is_preview) ? "$is_preview" : "0");
        $old_attactment  = $this->input->post('old_attachment');
        $lesson_order    = $this->input->post('lesson_order');
        $is_savelesson = ($old_lesson_id?0:$this->input->post('is_savelesson'));



            if ($provider_url) {
                $duration = $duration;
            } else {
                $duration = "00:00:00";
            }
 
          
            if($old_lesson_id){
                if($lesson_type !=3){
                $image = $this->fileupload->update_doupload(
                    $old_lesson_id, 'assets/uploads/lesson/', 'attachment', '*'
                );
               }else{
                   

                    // multiple image upload
                    if(!empty($_FILES['attachment']['name'])){
                    $countfiles = count($_FILES['attachment']['name']);

                    
                            if($old_lesson_id){            
                                $this->db->where('from_id',$old_lesson_id)->delete('picture_tbl');
                            }
                            
                    

                    //echo $countfiles; 

                    $attimage=[];
                    for ($i = 0; $i < $countfiles; $i++) {

                        $_FILES['attachmentf']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['attachment']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
                        $_FILES['attachmentf']['type']     = $_FILES['attachment']['type'][$i];
                        $_FILES['attachmentf']['tmp_name'] = $_FILES['attachment']['tmp_name'][$i];
                        $_FILES['attachmentf']['error']    = $_FILES['attachment']['error'][$i];
                        $_FILES['attachmentf']['size']     = $_FILES['attachment']['size'][$i];
                        $config = array(
                            'upload_path' => "assets/uploads/lesson/",
                            'allowed_types' => "*",
                            'overwrite' => TRUE,
                            'encrypt_name' => false,
                            'max_size' => '1000',
                            'remove_spaces' => true,
                            'file_ext_tolower' => true,
                            'file_name' => date('dHis').'-f-'.str_replace(" ","-",$_FILES['attachment']['name'][$i]),
                        );
                        
                        // if($old_lesson_id || $lesson_id){        
                        //     $picture_lesson_id = (($lesson_id) ? $lesson_id :  $old_lesson_id);             
                        //     $this->db->where('from_id',$picture_lesson_id)->delete('picture_tbl');
                        //  }
                         
                        $image_data = array();
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('attachmentf')) {
                            $image_data = $this->upload->data();
                            $image_name = 'assets/uploads/lesson/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['attachment']['name'][$i]);
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $image_data['full_path']; //get original image
                            $config['maintain_ratio'] = TRUE;
                            $config['height'] = 800;
                            $config['width'] = 800;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->clear();
                            $this->image_lib->initialize($config);
                            $attimage[$i]['files']     = $image_name;
                            $picture_data = array(
                                'from_id' => ($old_lesson_id?$old_lesson_id:$lesson_id),
                                'picture' => $image_name,
                                'picture_type' => 'lesson',
                                'status' => 1,
                                'created_date' =>date('Y-m-d H:i:s'),
                                'created_by' => $user_id,
                            );
                            $this->db->insert('picture_tbl', $picture_data);
                        }

                    }
                   }

               }
            }else{
                if($lesson_type !=3){
                    $this->load->library('Videoupload');
                    // $image = $this->videoupload->do_upload(
                    //         'assets/uploads/lesson/', 'attachment'
                    // );
                    $image = $this->videoupload->do_resumeupload(
                            'assets/uploads/lesson/', 'attachment'
                    );
                    
                }else{

                    // multiple image upload
                    if(!empty($_FILES['attachment']['name'])){
                    $countfiles = count($_FILES['attachment']['name']);

                    if($old_lesson_id){            
                        $this->db->where('from_id',$old_lesson_id)->delete('picture_tbl');
                    }

                    $attimage=[];
                    for ($i = 0; $i < $countfiles; $i++) {
 
                        $_FILES['attachmentf']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['attachment']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
                        $_FILES['attachmentf']['type']     = $_FILES['attachment']['type'][$i];
                        $_FILES['attachmentf']['tmp_name'] = $_FILES['attachment']['tmp_name'][$i];
                        $_FILES['attachmentf']['error']    = $_FILES['attachment']['error'][$i];
                        $_FILES['attachmentf']['size']     = $_FILES['attachment']['size'][$i];
                        $config = array(
                            'upload_path' => "assets/uploads/lesson/",
                            'allowed_types' => "*",
                            'overwrite' => TRUE,
                            'encrypt_name' => false,
                            'max_size' => '1000',
                            'remove_spaces' => true,
                            'file_ext_tolower' => true,
                            'file_name' => date('dHis').'-f-'.str_replace(" ","-",$_FILES['attachment']['name'][$i]),
                        );
                        
                        // if($lesson_id){
                        //     $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $lesson_id)->get()->row();
                        // }

                        // if($old_lesson_id || $lesson_id){        
                        //     $picture_lesson_id = (($lesson_id) ? $lesson_id :  $old_lesson_id);             
                        //     $this->db->where('from_id',$picture_lesson_id)->delete('picture_tbl');
                        //  }

                        $image_data = array();
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('attachmentf')) {
                            $image_data = $this->upload->data();
                            $image_name = 'assets/uploads/lesson/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['attachment']['name'][$i]);
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $image_data['full_path']; //get original image
                            $config['maintain_ratio'] = TRUE;
                            $config['height'] = 800;
                            $config['width'] = 800;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->clear();
                            $this->image_lib->initialize($config);
                            $attimage[$i]['files']     = $image_name;
                          
                            $picture_data = array(
                                'from_id'      => ($old_lesson_id?$old_lesson_id:$lesson_id),
                                'picture'      => $image_name,
                                'picture_type' => 'lesson',
                                'status'       => 1,
                                'created_date' => date('Y-m-d H:i:s'),
                                'created_by'   => $user_id,
                            );
                            $this->db->insert('picture_tbl', $picture_data);
                        }
 
                    }
                   }

                }

            }
           
            $lesson_data = array(
                'lesson_id'       => ($old_lesson_id?$old_lesson_id:$lesson_id),
                'course_id'       => $course_id,
                'lesson_name'     => $lesson_name,
                'section_id'      => $chapter_id,
                'lesson_type'     => $lesson_type,
                'lesson_provider' => $lesson_provider,
                'provider_url'    => ($provider_url?$provider_url:NUll),
                'duration'        => $duration,
                'summary'         => '',
                'description'     => $lesson_desc,
                'is_preview'      => $is_preview,
                'lesson_order'      => $lesson_order,
                'enterprise_id'   => get_enterpriseid(),
                'created_date'    => date('Y-m-d H:i:s'),
                'created_by'      => $user_id,
            );
            // dd($lesson_data);
            if($old_lesson_id){
                        $this->db->where('lesson_id', $old_lesson_id)
                    ->update('lesson_tbl', $lesson_data);
                    activitiylog_save($lesson_name . " Lesson Updated By", "Update", $user_id, date('Y-m-d H:i:s'));
                  if($lesson_type !=3){
            
                    $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $old_lesson_id)->get()->row();
                    if ($image) {
                        if ($check_image) {
                            $picture_data = array(
                                'from_id'      => ($old_lesson_id?$old_lesson_id:$lesson_id),
                                'picture'      => $image,
                                'picture_type' => 'lesson',
                                'status'       => 1,
                                'created_date' => date('Y-m-d H:i:s'),
                                'created_by'   => $user_id,
                            );
                            $this->db->where('from_id', $old_lesson_id)
                            ->update('picture_tbl', $picture_data);
                            
                        }else{
                            $picture_data = array(
                                'from_id' => ($old_lesson_id?$old_lesson_id:$lesson_id),
                                'picture' => $image,
                                'picture_type' => 'lesson',
                                'status' => 1,
                                'created_date' =>date('Y-m-d H:i:s'),
                                'created_by' => $user_id,
                            );
                            $this->db->insert('picture_tbl', $picture_data);  
                            
                     } 
                    
                    }

                }
                activitiylog_save($lesson_name . " Lesson Updated By", "Update", $user_id, date('Y-m-d H:i:s'));
            $result['message']    = 'successfully Updated';
            $result['lesson_id']  = $old_lesson_id;
        }else{
          $this->db->insert('lesson_tbl',$lesson_data);
          activitiylog_save($lesson_name . " Lesson Insert By", "Insert", $user_id, date('Y-m-d H:i:s'));
            //picture upload
            if($lesson_type !=3){
            if ($image) {
                $picture_data = array(
                    'from_id'      => ($old_lesson_id?$old_lesson_id:$lesson_id),
                    'picture'      => ($image?$image:$old_attactment),
                    'picture_type' => 'lesson',
                    'status'       => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by'   => $user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
                activitiylog_save($lesson_name . " Lesson Insert By", "Insert", $user_id, date('Y-m-d H:i:s'));
            }
        }
        $result['message']    = 'successfully Saved';
        $result['lesson_id']  = ($old_lesson_id?$old_lesson_id:$lesson_id);
      }

      $oldfile        = $this->input->post('olddownloadable_file_lesson');
      $dfiles          = $this->input->post('downloadable_file_lesson');

    
      $content_img = (@$_FILES['downloadable_file_lesson']?@$_FILES['downloadable_file_lesson']['name']:'noimg');
      $totalfile       = $this->input->post('totalfile');
      $filesCount = $totalfile;
    //   d($filesCount);
      
     for ($i = 0; $i < $filesCount; $i++) {
         if(!empty(@$_FILES['downloadable_file_lesson']['name'])){
         $uploadfile = (@$_FILES['downloadable_file_lesson']?count(@$_FILES['downloadable_file_lesson']['name']):0);
         if($uploadfile > $i){ 
         $_FILES['downloadfilelesson']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['downloadable_file_lesson']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
         $_FILES['downloadfilelesson']['type']     = $_FILES['downloadable_file_lesson']['type'][$i];
         $_FILES['downloadfilelesson']['tmp_name'] = $_FILES['downloadable_file_lesson']['tmp_name'][$i];
         $_FILES['downloadfilelesson']['error']    = $_FILES['downloadable_file_lesson']['error'][$i];
         $_FILES['downloadfilelesson']['size']     = $_FILES['downloadable_file_lesson']['size'][$i];

         // configure for upload 
         $config = array(
             'upload_path' => "assets/uploads/downloadfile/",
             'allowed_types' => "*",
             'overwrite' => TRUE,
             'encrypt_name' => false,
             'max_size' => '1000',
         );
         $image_data = array();

// autoload the upload library
         $this->load->library('upload', $config);
         $this->upload->initialize($config);
         if ($this->upload->do_upload('downloadfilelesson')) {
             $image_data = $this->upload->data();
             // $image_name = 'assets/uploads/downloadfile/' . $image_data['file_name'];
             $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['downloadable_file_lesson']['name'][$i]); //$image_data['file_name'];
             $config['image_library'] = 'gd2';
             $config['source_image'] = $image_data['full_path']; //get original image
             $config['maintain_ratio'] = TRUE;
             $config['height'] = 800;
             $config['width'] = 800;
             $this->load->library('image_lib', $config);
             $this->image_lib->clear();
             $this->image_lib->initialize($config);
             $filecontent[$i]['course_id'] = $course_id;
             $filecontent[$i]['lesson_id'] = ($old_lesson_id?$old_lesson_id:$lesson_id);
             $filecontent[$i]['chapter_id']=$chapter_id;
             $filecontent[$i]['files']     = $image_name;
             $filecontent[$i]['created_by'] = $this->session->userdata('user_id'); 
        //    d($filecontent);
         }
        }
     }

     }

     if (!empty($filecontent)) {
       
        //  if($is_savelesson == 1){  
        //     //  echo $is_savelesson. 'ddd';
            $resource_lesson_id = ($old_lesson_id?$old_lesson_id:$lesson_id);
        //     // echo $course_id.' c '. $resource_lesson_id; 
        //     $this->db->where('lesson_id' ,$resource_lesson_id)->delete('course_resource_tbl');
        //  }
         $checkoldlesson=$this->db->select('*')->from('course_resource_tbl')->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->get()->result();
         $resourse_id=[];
            if($checkoldlesson){
                 $this->db->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->delete('course_resource_tbl');
                 $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
                 $check=$this->db->select('*')->from('course_resource_tbl')->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->order_by('id','desc')->get()->result();
            
                for($ss=0; $ss<count($filecontent); $ss++){
                  $resourse_id[$ss] =$check[$ss]->id;
                }
            }else{ 
                
                $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
                // last inserted file id get from here 
                $check=$this->db->select('*')->from('course_resource_tbl')->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->order_by('id','desc')->get()->result();
                for($ss=0; $ss<count($filecontent); $ss++){
                  $resourse_id[$ss] =$check[$ss]->id;
                }
            }
            $resoursort=[];
            asort($resourse_id);
            $k=0;
            foreach($resourse_id as $value){
                $resoursort[$k]=$value;
                $k++;
            }
            $result['resourse_id']    = $resoursort;
    }

     
     $oldtotalfile       = $this->input->post('oldtotalfile');
     if(!empty($oldfile)){ 
         $of = 0;
     for ($i = 0; $i < $oldtotalfile; $i++) {
            $oldfilecontent[$i]['course_id']  = $course_id;
            $oldfilecontent[$i]['lesson_id']  = ($old_lesson_id?$old_lesson_id:$lesson_id);
            $oldfilecontent[$i]['chapter_id'] =$chapter_id;
            $oldfilecontent[$i]['files']      = @$oldfile[$of];
            $oldfilecontent[$i]['created_by'] = $this->session->userdata('user_id'); 
            // d($oldfilecontent);
            $of++;
           }
     }
  

     if (!empty($oldfilecontent)) {

       if(empty($filecontent) && $oldfilecontent){
        $resource_lesson_id = ($old_lesson_id?$old_lesson_id:$lesson_id);
        $this->db->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->delete('course_resource_tbl');
        $insert = $this->db->insert_batch('course_resource_tbl', $oldfilecontent);
       }else{
        $insert = $this->db->insert_batch('course_resource_tbl', $oldfilecontent);
       }
        //  if($is_savelesson == 1){  
        //     //  echo $is_savelesson. 'ddd';
            // $resource_lesson_id = ($old_lesson_id?$old_lesson_id:$lesson_id);
        //     // echo $course_id.' c '. $resource_lesson_id; 
        //     $this->db->where('lesson_id' ,$resource_lesson_id)->delete('course_resource_tbl');
        //  }
        //  $checkoldlesson=$this->db->select('*')->from('course_resource_tbl')->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->get()->result();
        //  if($checkoldlesson){
                //  $this->db->where('course_id', $course_id)->where('lesson_id',$resource_lesson_id)->delete('course_resource_tbl');
                //  $insert = $this->db->insert_batch('course_resource_tbl', $oldfilecontent);
            //  }else{              
            //     $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
            // }
    }
                
                
                // d($filecontent);   
      echo json_encode($result);
    }

    public function delete_lesson()
    {
        $lesson_id = $this->input->post('lesson_id');
         $this->db->where('lesson_id', $lesson_id)->delete('lesson_tbl');
            echo 'Successfully Deleted';
    }
    public function instructor_delete_lesson_resourses()
    {
        $resources_id = $this->input->post('resources_id');
         $this->db->where('id', $resources_id)->delete('course_resource_tbl');
            echo 'Successfully Deleted';
    }

    public function instructor_delete_lesson_multifile(){
        $multiple_id = $this->input->post('multiple_id');
         $this->db->where('id', $multiple_id)->delete('picture_tbl');
            echo 'Successfully Deleted';
    }
    public function add_quiz()
    {
        $enterprise_id                        = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $quiz_name     = $this->input->post('quiz_name',true);
        $old_quiz_id   = $this->input->post('quiz_id');
        $quiz_id       = ($old_quiz_id?$old_quiz_id:"EX" . date('d') . $this->generators->generator(5));
        $course_id     = $this->input->post('course_id');
        $chapter_id    = $this->input->post('chapter_id');
        $pass_mark     = $this->input->post('pass_score',true);
        $duration      = $this->input->post('quiz_duration',true);
        // $enterprise_id = get_enterpriseid();
        $create_by     = $this->session->userdata('user_id');
        $create_date   = date('Y-m-d H:i:s');
        $question      = $this->input->post('question');
        $old_ques_id   = $this->input->post('question_id');
        $question_type = $this->input->post('question_type');
        $question_mark = $this->input->post('question_mark');
        $correct_ans_ex= $this->input->post('correctansexp');
        $shortanswer   = $this->input->post('shortanswer');
        $quiz_order   = $this->input->post('quiz_order');
        $q_id          = [];
        // d($shortanswer);
        $quiz_data = array(
            'exam_id'         => ($old_quiz_id?$old_quiz_id:$quiz_id),
            'name'            => ($quiz_name?$quiz_name:''),
            'pass_mark'       => ($pass_mark?$pass_mark:0),
            'duration'        => ($duration?$duration:''),
            'enterprise_id'   => $enterprise_id,
            'status'          => 1,
            'created_by'      => ($create_by?$create_by:''),
        );
        if($old_quiz_id){
        $this->db->where('exam_id', $old_quiz_id)
                 ->update('exam_tbl', $quiz_data);
        }else{
         $this->db->insert('exam_tbl',$quiz_data);   
        }
        

          for ($i = 0; $i < count($question); $i++) {
            $old_ques  = ($old_ques_id?$old_ques_id[$i]:'');
            $que_id    = ($old_ques?$old_ques:"QST" . date('d') . $this->generators->generator(5));
            $ques_name = $question[$i];
            $ques_type = $question_type[$i];
            $ques_mark = $question_mark[$i];
            $short_ans = ($shortanswer[$i]?$shortanswer[$i]:'');

            $ans_exp   = $correct_ans_ex[$i];
            $question_data = array(
              'question_id'             => $que_id,
              'name'                    => $ques_name,
              'exam_id'                 => ($old_quiz_id?$old_quiz_id:$quiz_id),
              'question_type'           => $ques_type,
              'question_mark'           => $ques_mark,
              'shortanswer'             => $short_ans,
              'correct_ans_explanation' => $ans_exp,
              'status'                  => 1,
              'enterprise_id'           => $enterprise_id,
              'created_by'              => ($create_by?$create_by:''),
              'created_date'              => date('Y-m-d H:i:s'),
            );

            // d($question_data);
            if($old_ques){
             $this->db->where('question_id', $old_ques)
               ->update('question_tbl', $question_data);
            }else{
            $this->db->insert('question_tbl',$question_data);    
            }
            
            array_push($q_id,($que_id?$que_id:''));
            $option_param = $i + 1;
            $ques_name    = trim($ques_name);
            $ques_name    = str_replace(" ","_",$ques_name);
            $opt_name     = 'question_option'.$option_param;
            $ansoption    = 'question_option_ans'.$option_param;
            $options      = $this->input->post($opt_name);
            $isanswer     = $this->input->post($ansoption);

          
            if($ques_type != '3'){
              $this->db->where('question_id', $que_id)->delete('question_option_tbl');   
             for ($j = 0; $j < count($options); $j++) {
               $ques_option = $options[$j];
               $ans = $isanswer[$j];
              $option_data = array(
                'option_id'    => "OPT" . date('d') . $this->generators->generator(4),
                'question_id'  => $que_id,
                'option_type'  => 0,
                'option_name'  => $ques_option,
                'is_answer'    => $ans
              );

              $this->db->insert('question_option_tbl',$option_data);
             }

              }
          }


        $quiz_id = ($old_quiz_id?$old_quiz_id:$quiz_id);
        $checkExistsdata = $this->db->where('course_id', $course_id)
                                    ->where('exam_id',$quiz_id)
                                    ->get('assign_courseexam_tbl')
                                    ->num_rows();

        $assigndata = array(
            'course_id'     => $course_id,
            'lesson_id'     => '',
            'section_id'    => $chapter_id,
            'exam_id'       => $quiz_id,
            'enterprise_id' =>$enterprise_id,
            'status'        => 1,
            'quiz_order'    => $quiz_order,
            'created_by'    => ($create_by?$create_by:''),
        );

          if ($checkExistsdata > 0) {
            $this->db->where('exam_id', $old_quiz_id)->update('assign_courseexam_tbl', $assigndata);
            
        } else {
            if (empty($checkExistsdata)) {
                $this->db->insert('assign_courseexam_tbl', $assigndata);
               
            }
        }

        $result['message']     = 'Success';
        $result['quiz_id']     = ($old_quiz_id?$old_quiz_id:$quiz_id);
        $result['question_id'] = $q_id;
        echo json_encode($result);
    }

    public function delet_question()
    {
        $question_id = $this->input->post('question_id');
         $this->db->where('question_id', $question_id)->delete('question_option_tbl');
         $this->db->where('question_id', $question_id)->delete('question_tbl');
            echo 'Successfully Deleted';
    }

    public function delet_quiz()
    {
          $quiz_id = $this->input->post('quiz_id');
          $this->db->where('exam_id', $quiz_id)->delete('assign_courseexam_tbl');
          $this->db->where('exam_id', $quiz_id)->delete('question_tbl');
          $this->db->where('exam_id', $quiz_id)->delete('exam_tbl');
            echo 'Successfully Deleted';
    }

    public function get_course_chapterlist()
    {
        $course_id = $this->input->post('course_id');
        $serial    = $this->input->post('serial');
        $chapter_id    = $this->input->post('chapter_id');
        
        $pro_no    = $this->input->post('project_no');
        $course_chapters = $this->Instructor_model->get_course_chapters($course_id);
        
        // $chapterlist = '';
        // $chapterlist .= '<label for="chapters" class="col-2">Select Chapter</label><div class="col-4"><select name="project_chapter'.$serial.$pro_no.'" id="project_chapter_'.$serial.'_'.$pro_no.'" class="form-control">';
        // if($course_chapters){
        //  $chapterlist .= '<option value="">Select Chapter</option>'; 
        // foreach($course_chapters as $chapters){
        // $chapterlist .= '<option value="'.$chapters->section_id.'">'.$chapters->section_name.'</option>'; 
        //  }
        // }else{
        //   $chapterlist .= '<option value="">No Chapter Found</option>';  
        // }
        // $chapterlist .= '</select></div>';
         $chapterlist = "<input type='hidden' value='$chapter_id'>";
        echo $chapterlist;

    }

    public function save_project_assignment()
    {
      
        $course_id          = $this->input->post('course_id',true);
        $chapter_id         = $this->input->post('project_chapter',true);
        $project_title      = $this->input->post('project_title',true);
        $project_category   = $this->input->post('project_category',true);
        $projectDescription = $this->input->post('projectDescription',true);
        $passScroe          = $this->input->post('passScroe',true);
        $projectmarkes      = $this->input->post('projectmarkes',true);
        $projectTips        = $this->input->post('projectTips',true);
        $projectreference   = $this->input->post('projectreference',true);
        $distribute_title   = $this->input->post('distribute_title',true);
        $distribute_mark    = $this->input->post('distribute_mark',true);
        $old_assign_id      = $this->input->post('assign_id',true);
        $project_order      = $this->input->post('project_order',true);

        $create_by          = $this->session->userdata('user_id');
        $assignment_id      = "PAS" . date('d') . $this->generators->generator(5);

        $assigndata = array(
            'assignment_id'     => ($old_assign_id?$old_assign_id:$assignment_id),
            'course_id'         => $course_id,
            'chapter_id'        => $chapter_id,
            'title'             => $project_title,
            'description'       => $projectDescription,
            'category'          => $project_category,
            'pass_score'        => $passScroe,
            'project_mark'      => $projectmarkes,
            'tips'              => $projectTips,
            'project_reference' => $projectreference,
            'project_order'     => $project_order,
            'enterprise_id'     => get_enterpriseid(),
            'create_by'         => $create_by
        );

    //    d( $assigndata);
        if($old_assign_id){

           $this->db->where('course_id', $course_id)->where('assignment_id', $old_assign_id)->update('project_assingment',$assigndata);
        //    $this->db->where('course_id', $course_id)->delete('project_assingment');
           $this->db->where('assignment_id', $old_assign_id)->delete('project_mark_details');

        //    $this->db->insert('project_assingment',$assigndata);
           $result['message']   = 'Successfully Updated';
           $result['assign_id'] = $old_assign_id;
        }else{
            $this->db->insert('project_assingment',$assigndata);
           $result['message']   = 'Successfully Saved';
           $result['assign_id'] = $assignment_id;
        }

        for ($i = 0; $i < count($distribute_title); $i++) {
            $d_title = $distribute_title[$i];
            $marks   = $distribute_mark[$i];

            $marksdata = array(
                'assignment_id' => ($old_assign_id?$old_assign_id:$assignment_id),
                'markes_title'  => $d_title,
                'marks'         => $marks,
                'status'        => 1
            );

            $this->db->insert('project_mark_details',$marksdata);
        }

        echo json_encode($result);
    }

    public function assigned_project_delete()
    {
        $assign_id = $this->input->post('project_id');
         $this->db->where('assignment_id', $assign_id)->delete('project_mark_details');
         $this->db->where('assignment_id', $assign_id)->delete('project_assingment');
         echo 'Successfully Deleted';
    }

    public function course_pricing_save()
    {
        $course_id        = $this->input->post('course_id');
        $course_price     = $this->input->post('course_price');
        $course_types     = $this->input->post('course_types');
        $course_old_price = $this->input->post('course_old_price');
        $course_discount  = $this->input->post('course_discount');
        $discount_type    = $this->input->post('discount_type');
        $is_offer         = $this->input->post('is_offer');
        $offer_price      = $this->input->post('offer_price');
        $offer_courses    = $this->input->post('offer_course');
        $all_offer_course = ($offer_courses?explode(',', $offer_courses):'');
       
        
        $pricedata = array(
            'course_id'         => $course_id,
            'course_type'       => json_encode($course_types),
            'price'             => $course_price,
            'oldprice'          => ($course_old_price?$course_old_price : NULL),
            'is_discount'       => ($course_discount?1:2),
            'discount'          => ($course_discount ? $course_discount : NULL),
            'discount_type'     => $discount_type,
            'is_offer'          => ($is_offer?$is_offer:0),
            'offer_courseprice' => ($offer_price?$offer_price:'')
        );

       $this->db->where('course_id', $course_id)->update('course_tbl', $pricedata);
       if($is_offer == 1){
        $this->db->where('course_id', $course_id)->delete('course_offers_tbl');
        if($all_offer_course){
            foreach($all_offer_course as $offercours){
                $offer_coursedata = array(
                    'course_id'      => $course_id,
                    'course_offerid' => $offercours,
                    'created_by'     => $this->session->userdata('user_id'),
                    'created_date'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('course_offers_tbl',$offer_coursedata);
            }
        }
       }
       echo 'successfully Saved'; 
    }


    public function course_edit($course_id)
    {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        //subcategory_id
        $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['title']          = 'instructor Course Add';
        $data['module']         = "frontend";
        $coursedata             = $this->Instructor_model->course_info($course_id);
        $parent_cat             = $this->Instructor_model->get_parentgory($coursedata->subcategory_id);
        $data['faculty_id']     = $this->session->userdata('user_id');
        $data['category_list']  = $this->Instructor_model->category_list($enterprise_id);
        $data['docusin_link']   = $this->Instructor_model->docusin_link($enterprise_id);
        $data['sub_categories'] = $this->Instructor_model->get_subcategory(($parent_cat?$parent_cat:$coursedata->category_id));
        $data['parent_category']= $parent_cat;
        $data['course_miniimg'] = $this->Instructor_model->course_image($course_id);
        $data['chapter_list']   = $this->Instructor_model->course_chapter_list($course_id);
        $data['offer_courses']  = $this->Instructor_model->offer_course_list($course_id);
        $data['course_info']    = $coursedata;
        $data['downloadables']  = $this->Instructor_model->downloadablefiles($course_id);
        $data['related_courses']= $this->Instructor_model->related_courselist($enterprise_id);
        $data['get_languages'] = get_languages();
        $data['page']           = "themes/default/instructor/edit_course";
        echo Modules::run("frontend/InstructorLayout/layout", $data);
    }

    public function course_preview()
    {
        $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $course_id              = $this->input->post('course_id');
        $coursedata             = $this->Instructor_model->course_info($course_id);
        $data['faculty_id']     = $this->session->userdata('user_id');
        $data['category_list']  = $this->Instructor_model->category_list($enterprise_id);
        $data['sub_categories'] = $this->Instructor_model->get_subcategory($coursedata->category_id);
        $data['course_miniimg'] = $this->Instructor_model->course_image($course_id);
        $data['chapter_list']   = $this->Instructor_model->course_chapter_list($course_id);
        $data['offer_courses']  = $this->Instructor_model->offer_course_list($course_id);
        $data['course_info']    = $coursedata;
        $this->load->view('themes/default/instructor/course_preview', $data);
    }

    public function save_instructor_earnings(){
        date_default_timezone_set('Asia/Dhaka');
       $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);

       $students           = $this->Instructor_model->student_records($enterprise_id);
       $subs_setting       = $this->Instructor_model->subscribtion_setting($enterprise_id); 
       $max_percentage     = ($subs_setting?$subs_setting->max_percentage:'');
       $max_payable        = ($subs_setting?$subs_setting->max_payable:'');
       $cronjob_time = (($subs_setting->cronjob_time  == '00:00:00') ? '15:59' : $subs_setting->cronjob_time); 
       $cronjob_time = date('H:i', strtotime($cronjob_time));
    //    dd($cronjob_time);
    //    dd($subs_setting);
       if($students){
            if(date('H:i') == '23:59'){
                $this->db->where('date', date('Y-m-d'))->where('is_subscription', 1)->delete('instructor_ledger_tbl');
            }
            if(date('H:i') == $cronjob_time){
                $this->db->where('date', date('Y-m-d'))->where('is_subscription', 1)->delete('instructor_ledger_tbl');
            }
        foreach($students as $student){
         $student_seentime = $this->Instructor_model->student_total_seentime($student->student_id,$student->date, $enterprise_id);
         $paydata          = $this->Instructor_model->instructor_paymentdata($student->student_id,$student->date, $enterprise_id);
         $seentime_minutes =  ($student_seentime?$student_seentime/60:0);
         $actual_rate      = (($max_percentage?$max_percentage:0)/($seentime_minutes == 0?1:$seentime_minutes));
         $per_min_val      = ($max_payable?$max_payable:0)/($max_percentage?$max_percentage:1);
        //  d('a');
         if($paydata){
            foreach($paydata as $payments){
      
                $minutes        = ($payments?$payments->total_time/60:0);
              
                $pay_percentage = $actual_rate * $minutes;
             
                $tk             = $pay_percentage * $per_min_val;
               $actual_tk      = ($payments?$minutes:0) * $per_min_val;
               
 // d("Ac R ".$actual_rate);
               // d("M ".$minutes);
               // d("Pay Perca ".$pay_percentage);
               // d("Per Min ".$per_min_val);
               // d("Ac Tk ".$actual_tk);
               // d("Tk ".$tk);
               
               $instructor_ledger = array(
                'transaction_id' => date('Ymdhis'),
                'user_id'        => $payments->faculty_id,
                'course_id'      => $payments->course_id,
                'date'           => $payments->date,
                'description'    => 'subscribed viewed data',
                'is_subscription'=> 1,
                'subscription_id'=> '',
                'duration'       => ($payments?$payments->total_time:0),
                'share_percent'  => $pay_percentage,
                'credit'         => ($tk < $actual_tk?$tk:$actual_tk),
                'debit'          => 0,
                'status'         => 1,
                'enterprise_id ' => $enterprise_id ,
                'created_date' => date('Y-m-d H:i:s'),
               );
            //    echo 's';
            //   dd($instructor_ledger);
                // if(date('H:i') == '15:59'){
                if(date('H:i') == $cronjob_time){
                    // d($instructor_ledger);
                    $this->db->insert('instructor_ledger_tbl',$instructor_ledger);
                }
                if(date('H:i') == '23:59'){
                    $this->db->insert('instructor_ledger_tbl',$instructor_ledger);
                }
            }
         }
        
        }
       }

      
    }


public function course_terms_condition()
{
    $terms             = $this->input->post('terms');
    $old_course_id     = $this->input->post('course_id', true);
    $sale_benefits     = $this->input->post('sale_benefits');
    $subscribe_benfits = $this->input->post('subscribe_benfits');
    $course_id         = "CO" . date('d') . $this->generators->generator(5);

    $course_data = array(
        'course_id'             => ($old_course_id?$old_course_id:$course_id),
        'is_termsagree'         => $terms,
        'sales_benefits'        => $sale_benefits,
        'subscription_benefits' => $subscribe_benfits,
        'is_draft'              => 1,
    );

    if($old_course_id){
     $this->db->where('course_id', $old_course_id)
               ->update('course_tbl', $course_data);
    }else{
        $this->db->insert('course_tbl',$course_data);
    }

    echo ($old_course_id?$old_course_id:$course_id);
}

public function delete_chapter()
{
         $chapter_id = $this->input->post('chapter_id');
         $this->db->where('section_id', $chapter_id)->delete('section_tbl');
         echo 'Successfully Deleted';
}

public function course_docusin_add()
{
    //    $this->load->library('Videoupload');
    //       $docusin = $this->videoupload->do_upload(
    //             'assets/uploads/docusin/', 'docusin'
    //     );

    //    $dsin                   = $docusin; 
    //    $welcome_message        = $this->input->post('welcomeMessage');
    //    $congratulationsMessage = $this->input->post('congratulationsMessage');
       $course_id              = $this->input->post('course_id');
    //    $old_docusin            = $this->input->post('old_docusin');

       $docusin_info = array(
        'course_id'          => $course_id,
        'is_draft'           => 0
       ); 
         $this->db->where('course_id', $course_id)
               ->update('course_tbl', $docusin_info);

          
               echo 'Successfully Saved';   
}

public function instructor_course_videoupload(){
    $this->load->library('Vimeovideoupload');
    $file_name= $_FILES["video_file"]["tmp_name"];
    $video_response=$this->vimeovideoupload->video_upload($file_name);
    print_r($video_response);
    exit;
}

public function instructor_new_certificate()
{
    $data['faculty_id']                 = $this->session->userdata('user_id');
    $data['enterprise_shortname']       = $this->enterprise_shortname;
    $this->load->view('themes/default/instructor/instructor_certificate', $data);
}

public function instructor_save_certificate()
{
    $this->load->library('Fileupload');
    $certificate = $this->fileupload->do_upload(
            'assets/uploads/faculty/',
            'certificate', 'jpg|jpeg|png|gif|pdf'
          );
      
          // if image is uploaded then resize the image
          if ($certificate !== false && $certificate != null) {
            $this->fileupload->do_resize(
              $certificate, 
              500,
              300
            );
          } 

    $this->load->library('Fileupload');
    $organization_logo = $this->fileupload->do_upload(
            'assets/uploads/faculty/',
            'organization_logo', 'jpg|jpeg|png|gif'
          );

    $certificatedata = array(
        'user_id'           => $this->input->post('faculty_id'),
        'certificatename'   => $this->input->post('certificatename'),
        'institute_logo'    => ($organization_logo?$organization_logo:''), 
        'year'              => $this->input->post('pyear'),
        'certificate'       => ($certificate?$certificate:''),
        'status'            => 1,
        'enterprise_id'     => get_enterpriseid(),
        'created_by'        => $this->session->userdata('user_id')
    );

$this->db->insert('faculty_certificate_tbl',$certificatedata);
$certificate_id = $this->db->insert_id();
  $logo = base_url($organization_logo);
  if(!empty($organization_logo)){
    $img='<img src="'.$logo.'" style="height:70px;width:70px;margin:0px;padding:0px;" class="rounded-circle">';
    }
  $certificatelink = base_url($certificate);
    $content = '<div class="col-md-6" id="certificate_content_'.$certificate_id.'">
                       
                        <div class="card mb-3">
                            <div class="card-body p-4">
                                <div
                                    class="text-center text-md-start d-sm-flex align-items-sm-center justify-content-sm-between mb-3">
                                    <h5 class="text-capitalize mb-0">Successfully Completed</h5>
                               

                                  <a href="'.($certificate?$certificatelink:'javascript:void(0)').'" class="'.($certificate?'btn btn-dark-cerulean btn-sm mt-2 mt-sm-0 text-nowrap':'').'" download> '.($certificate?'Download':'').'</a>         
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="text-center">
                                        '.$img.'
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="text-capitalize mb-1">'.$certificatedata['certificatename'].'</h5>
                                        <div class="fw-medium text-muted">'.$certificatedata['year'].'</div>
                                    </div>
                                </div>
                                <div class="move_handler">
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_certificate('.$certificate_id.')"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                      
                    </div>';
                    echo $content;

   

}

public function instructor_certificate_delete()
{
    $certificate_id = $this->input->post('certificate_id');
    $this->db->where('id', $certificate_id)->delete('faculty_certificate_tbl');
         echo 'Successfully Deleted';
}

public function instructor_certificate_showhide()
{
    $is_show    = $this->input->post('is_show');
    $faculty_id = $this->input->post('faculty_id');
    $data = array(
        'is_certificateshow' => $is_show,
    );

    $this->db->where('faculty_id', $faculty_id)->update('faculty_tbl', $data);
   if($is_show == 1){
 echo 'Successfully checked Show';
   }else{
 echo 'Successfully unchecked Show';
   }

}

public function instructor_faq(){   
    if (!$this->sessionid) {
  redirect($this->enterprise_shortname);
}
  $instructor_id             = $this->session->userdata('user_id');
  $blank_param               = '';
  $data['title']             = 'Instructor FAQ';
  $enterprise_id             = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
  $data['get_faqlist']       = $this->Instructor_model->get_faqlist($instructor_id);
  $data['get_courselist']       = $this->Instructor_model->get_courselist($instructor_id);

  $data['module']            = "frontend";
  $data['page']              = "themes/default/instructor/instructor_faq";
  echo Modules::run("frontend/InstructorLayout/layout", $data);
}

public function instructor_faqeditform() {
    $data['title'] = 'FAQ Information Update';
    $faqid = $this->input->post('id', True);
    $instructor_id            = $this->session->userdata('user_id');
    $data['get_courselist']   = $this->Instructor_model->get_courselist($instructor_id);
    $data['faqeditdata']      = $this->Course_model->faqeditdata($faqid);

    $this->load->view('frontend/themes/default/instructor/instructor_faqeditform', $data);
}

public function course_faq_delete() {
    $id = $this->input->post('id', True);
    if ($id) {
        $this->db->where('id', $id)->delete('faq_tbl');
    }
    echo display('deleted_successfully');
}

public function delete_video()
{

    $id = $this->input->post('video_id');
    $uri = '/videos/'.$id;
    $vimeo =  new \Vimeo\Vimeo('570835589bb5e8ab3f5849b780609400667a923b', 'bpiL7rJehliRw8ojSE0R8cI5OT0sCb2DvXXBu+yIibQSYAlJnRGH+eZb6EqhTqpPZxr/zGb59NcFEwg3MJjUGil3K7zAlHpyC2cJn+xryyfq0Pn1SMnxedOZzMtw86My', '55ec784a6777dadcfd09f7fa0f5b9765');
  
$d_data = $vimeo->request($uri, array(), 'DELETE');
if($d_data){
    echo 'successfully deleted';
}else{
    echo 'failed';
}
}

public function instructor_save_downloadablefiles()
{
    $course_id    = $this->input->post('course_id');
    $oldfile      = $this->input->post('old_downloadable');
    $files        = $this->input->post('downloadable_file');
    $total        = $this->input->post('totalfile');
   
    $this->db->where('course_id', $course_id)->delete('course_resource_tbl');
    $content_img = (@$_FILES['downloadable_file']?@$_FILES['downloadable_file']['name']:'noimg');
  
         $filesCount = $total;
         $of = 0;
        for ($i = 0; $i < $filesCount; $i++) {
            
            $uploadfile = (@$_FILES['downloadable_file']?count(@$_FILES['downloadable_file']['name']):0);
            if($uploadfile > $i){ 
            $_FILES['downloadfile']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['downloadable_file']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
            $_FILES['downloadfile']['type']     = $_FILES['downloadable_file']['type'][$i];
            $_FILES['downloadfile']['tmp_name'] = $_FILES['downloadable_file']['tmp_name'][$i];
            $_FILES['downloadfile']['error']    = $_FILES['downloadable_file']['error'][$i];
            $_FILES['downloadfile']['size']     = $_FILES['downloadable_file']['size'][$i];

            // configure for upload 
            $config = array(
                'upload_path' => "assets/uploads/downloadfile/",
                'allowed_types' => "*",
                'overwrite' => TRUE,
                'encrypt_name' => false,
                'max_size' => '1000',
            );
            $image_data = array();

// autoload the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('downloadfile')) {
                $image_data = $this->upload->data();
                // $image_name = 'assets/uploads/downloadfile/' . $image_data['file_name'];
                $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['downloadable_file']['name'][$i]); //$image_data['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path']; //get original image
                $config['maintain_ratio'] = TRUE;
                $config['height'] = 800;
                $config['width'] = 800;
//                $config['quality'] = 50;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                // if (!$this->image_lib->resize()) {
                //     echo $this->image_lib->translate_errors();
                // }

                $filecontent[$i]['course_id'] = $course_id;
                $filecontent[$i]['files'] = $image_name;
                $filecontent[$i]['created_by'] = $this->session->userdata('user_id'); 
            }
        }else{

             $filecontent[$i]['course_id']  = $course_id;
             $filecontent[$i]['files']      = $oldfile[$of];
             $filecontent[$i]['created_by'] = $this->session->userdata('user_id'); 
             $of++;
        }
        }
    
         if (!empty($filecontent)) {
            $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
        }
        

        $count_down=$this->db->select("*")->from("course_resource_tbl")->where('course_id',$course_id)->get()->num_rows();

        echo "(".$count_down.")";
        //echo 'Uploaded Successfully';
        exit;
}



public function course_download_upload(){
    $course_id    = $this->input->post('course_id');
    $status    = $this->input->post('status');
    $oldfile      = $this->input->post('old_downloadable');
    $files        = $this->input->post('downloadable_file');
    $total        = $this->input->post('totalfile');
    $file_id        = $this->input->post('file_id');
    $last_record_id        = $this->input->post('last_record_id');

    // $docusign = $this->fileupload->do_resumeupload(
    //     'assets/uploads/downloadfile/', 'downloadable_file','*'
    // );

        if(!empty($_FILES['downloadable_file']['name'])){
        $config = array(
            'upload_path' => "assets/uploads/downloadfile/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'encrypt_name' => false,
            'maintain_ratio' => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true,
            'file_name' => date('dHis').'-f-'.str_replace(" ","-",@$_FILES['downloadable_file']['name']),
        );
        $image_data = array();
    // autoload the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('downloadable_file');
        $image_data = $this->upload->data();
        // $image_name = 'assets/uploads/downloadfile/' . $image_data['file_name'];
        $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",@$_FILES['downloadable_file']['name']); //$image_data['file_name'];
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path']; //get original image
        $config['maintain_ratio'] = TRUE;
        $config['height'] = 800;
        $config['width'] = 800;
        $this->load->library('image_lib', $config);
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
    }
    $docusigndata = array(
        'course_id'    => $course_id,
        // 'files'        => (!empty($docusign) ? $docusign : $this->input->post('old_downloadable', true)),
        'files'        => (!empty($image_name)?$image_name:''),
        'created_by'   => $this->session->userdata('user_id'),
    );
  
//    d($docusigndata);
    if($status=="delete"){
        $this->db->where('course_id', $course_id)->where('id', $file_id)->delete('course_resource_tbl');
        // $this->db->insert('course_resource_tbl', $docusigndata); 
         
    }else{
   
        if($file_id){
            // $this->db->where('course_id', $course_id)->where('id', $file_id)->delete('course_resource_tbl');
            // $this->db->insert('course_resource_tbl', $docusigndata);
            $this->db->where('course_id', $course_id)->where('id', $file_id)->update('course_resource_tbl', $docusigndata);
        }else{
        if($last_record_id){
            // $this->db->where('course_id', $course_id)->where('id', $last_record_id)->update('course_resource_tbl', $docusigndata);
            $this->db->where('course_id', $course_id)->where('id', $last_record_id)->delete('course_resource_tbl');
            $this->db->insert('course_resource_tbl', $docusigndata);
        }else{
            $this->db->insert('course_resource_tbl', $docusigndata);
        }
           
        }
   

}

$result['last_record_id']    = $this->db->insert_id(); //(($last_record_id) ? $last_record_id : $this->db->insert_id());
    echo json_encode($result);
    // echo 'Resume updated successfully!';
    
    // $upload = 'err'; 
    // if(!empty($_FILES['downloadable_file'])){ 
        
    //     // File upload configuration 
    //     $targetDir = "assets/uploads/"; 
    //     $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif','zip'); 
        
    //     $fileName = basename($_FILES['downloadable_file']['name']); 
    //     $targetFilePath = $targetDir.$fileName; 
        
    //     // Check whether file type is valid 
    //     $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    //     if(in_array($fileType, $allowTypes)){ 
    //         // Upload file to the server 
    //         $upload = 'ok'; 
    //         // if(move_uploaded_file($_FILES['resume']['tmp_name'], $targetFilePath)){ 
    //         //     $upload = 'ok'; 
    //         // } 
    //     } 
    // } 
    // echo $upload; 
}






}