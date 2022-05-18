<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Frontend extends MX_Controller {

    public $pusher;
    private $user_id = "";
    private $sessionid;

    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model(array(
            'Frontend_model', 'dashboard/Course_model', 'dashboard/Faculty_model', 'dashboard/Faculty_model', 'dashboard/Faculty_model', 'dashboard/Setting_model'
        ));
        // Load facebook oauth library 
        $this->load->library('facebook'); 
        $this->load->library('cart');
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->sessionid = $this->session->userdata('session_id');
        $this->segmentone = $this->uri->segment(1);
        $this->segmenttwo = $this->uri->segment(2);
        $enterprise_id = $this->session->userdata('enterprise_id');
        $enterpriseid = (!empty($enterprise_id) ? $enterprise_id : '1');
        $this->enterprise_info = get_enterpriseinfo($enterpriseid);
        $this->enterprise_shortname = (!empty($this->enterprise_info->shortname) ? $this->enterprise_info->shortname : 'admin');
        // $pusher_config = $this->Setting_model->pusher_config($enterpriseid);
        // dd($enterpriseid);
        // $pusher_data = array(
        //     'api_id' => (!empty($pusher_config->api_id) ? $pusher_config->api_id : ''),
        //     'api_key' => (!empty($pusher_config->api_key) ? $pusher_config->api_key : ''),
        //     'secret_key' => (!empty($pusher_config->secret_key) ? $pusher_config->secret_key : ''),
        //     'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
        // );
        // $this->session->set_userdata($pusher_data);
        // $options = array(
        //     'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
        //     'useTLS' => true
        // );
        // if ($pusher_config) {
        //     $this->pusher = new Pusher\Pusher(
        //             $pusher_config->api_key, $pusher_config->secret_key, $pusher_config->api_id, $options
        //     );
        // }
        date_default_timezone_set('Asia/Dhaka');
    }

    public function websiteload($enterprise_shortname) {
        // dd($enterprise_shortname);
        if ($enterprise_shortname == 'login') {
            redirect('dashboard/auth/index');
        }

        $data['title'] = '';
        $data['transfarentmenu'] = 1;
        $enterpriseid = enterpriseid_byshortname($enterprise_shortname);
        // d($enterprise_shortname);d('d');
        // dd($enterpriseid);
        $this->session->set_userdata('enterprise_id', $enterpriseid);
        // $data['active_theme'] = get_activethemes();
        // $data['setting'] = get_appsettings($enterpriseid);
        $data['get_testimonials'] = $this->Frontend_model->get_testimonials($enterpriseid);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterpriseid);
        $data['company_list'] = $this->Setting_model->company_list($enterpriseid);
        $data['featuredin_list'] = $this->Frontend_model->featuredin_list($enterpriseid);
        $data['get_category'] = $this->Frontend_model->get_category($enterpriseid);
        $data['get_popularcartegory'] = $this->Frontend_model->popular_category($enterpriseid);
        $data['get_sliderdata'] = $this->Frontend_model->get_sliderdata($enterpriseid);
        $data['get_popularcourse'] = $this->Frontend_model->popular_course(8, '', $enterpriseid);

        //    dd($enterpriseid);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/index";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function index() {
        // $enterprise_id = 1;
        $data['transfarentmenu'] = 1;
//        $this->output->cache(1);
        // $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $enterprise_id = (!empty('admin') ? enterpriseid_byshortname('admin') : 1);
        $this->session->set_userdata('enterprise_id', $enterprise_id);
        // d($this->enterprise_shortname);
        // dd($enterprise_id);
        $data['get_testimonials'] = $this->Frontend_model->get_testimonials($enterprise_id);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['company_list'] = $this->Setting_model->company_list($enterprise_id);
        $data['featuredin_list'] = $this->Frontend_model->featuredin_list($enterprise_id);
        $data['get_category'] = $this->Frontend_model->get_category($enterprise_id);
        $data['get_popularcartegory'] = $this->Frontend_model->popular_category($enterprise_id);
        $data['get_sliderdata'] = $this->Frontend_model->get_sliderdata($enterprise_id);
        $data['get_popularcourse'] = $this->Frontend_model->popular_course(8, '', $enterprise_id);
        // dd($data['get_popularcourse']);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/index";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function get_explorecourse() {
        $type = $this->input->post('type', true);
        $id   = $this->input->post('id', true);
        $data['type']=$type;
        $data['category_id']=$id;
        $enterprise_id = $this->input->post('enterprise_id', true);
        $data['enterprise_id'] = $this->input->post('enterprise_id', true);
        $data['get_explorecourse'] = $this->Frontend_model->get_explorecourse($type, $id, $enterprise_id);
        $data['get_explorecourse_count'] = $this->Frontend_model->excourse_count($type, $id, $enterprise_id);

        // $enterprise_id = enterpriseid_byshortname($segmentone);
        $enterprise_info = get_enterpriseinfo($enterprise_id);
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        $data['enterprise_shortname'] = (!empty($enterprise_info->shortname) ? $enterprise_info->shortname : 'admin');


        $this->load->view('themes/default/get_explorecourse', $data);
    }

    // alamin change 16/7/21
    public function get_explorecourse_load_more() {
        $lastid = $this->input->post('lastid');
        $course_type = $this->input->post('course_type');
        $category_id = $this->input->post('category_id');
        $data['enterprise_id'] = $this->input->post('enterprise_id', true);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $data['category_id'] = $category_id;
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['transfarentmenu'] = '';
        // $data['module'] = "frontend";
        // $data['page'] = "themes/default/course_load_more";
        $data['get_explorecourse'] = $this->Frontend_model->get_explorecourse_load_more($category_id, $lastid, $course_type, $enterprise_id);
        $data['get_explorecourse_count'] = $this->Frontend_model->excourse_count($course_type,$category_id, $enterprise_id);
        $this->load->view('themes/default/get_explorecourse', $data);
    }

    // public function category_course(){
    //     $data['transfarentmenu'] = '';
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/category_course";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
    public function category_course($category_id) {
        $data['transfarentmenu'] = '';

        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_popularcourse'] = $this->Frontend_model->popular_course(6, '', $enterprise_id);
        $data['free_courses'] = $this->Frontend_model->free_courses(6, '', $enterprise_id);
        $data['gov_courses'] = $this->Frontend_model->gov_courses(6, '', $enterprise_id);
        $data['category_courses'] = $this->Frontend_model->category_course($category_id, $enterprise_id);
        $data['category_info'] = $this->db->select('*')->from('category_tbl')->where('category_id', $category_id)->get()->row();
        $data['categorycourse_count'] = $this->Frontend_model->categorycourse_count($category_id, $enterprise_id);
        // dd($data['categorycourse_count']);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/category_course";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function locad_more_course() {
        $lastid = $this->input->post('lastid');
        $category_id = $this->input->post('category_id');
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['enterprise_id']=$enterprise_id;
        $data['category_id'] = $category_id;
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        $data['transfarentmenu'] = '';
        $data['module'] = "frontend";
        $data['page'] = "themes/default/course_load_more";
        $data['get_load_data'] = $this->Frontend_model->load_more_course($lastid, $category_id, $enterprise_id);
        $this->load->view('themes/default/course_load_more', $data);
    }

    //========all course================ 
    public function allcourse($param = null){
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_popularcourse'] = $this->Frontend_model->popular_course(6, '', $enterprise_id);
        $data['free_courses'] = $this->Frontend_model->free_courses(6, '', $enterprise_id);
        $data['gov_courses'] = $this->Frontend_model->gov_courses(6, '', $enterprise_id);
        $data['category_courses'] =$this->Frontend_model->all_course($enterprise_id);
        $data['categorycourse_count'] = $this->Frontend_model->allcourse_count($enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/all_course";
        echo Modules::run("template/frontend_layout", $data);
    }
     //========all course== more============== 
    public function load_more_allcourse(){
        $lastid = $this->input->post('lastid');
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['enterprise_id']=$enterprise_id;
        // $data['category_id'] = $category_id;
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        $data['transfarentmenu'] = '';
        $data['module'] = "frontend";
        // $data['page'] = "themes/default/course_load_more";
        $data['get_load_data'] = $this->Frontend_model->load_more_allcourse($lastid,$enterprise_id);
        $this->load->view('themes/default/more_allcourse', $data);
    }
    // ======allcourse loadmore
    public function course_details($course_id, $param = null) {
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $student_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $data['course_wise_lesson'] = $this->Course_model->course_wise_lesson($course_id);
        $data['get_coursedetails'] = $this->Frontend_model->get_coursedetails($course_id, $enterprise_id);
        $data['coursesaved_checked'] = $this->Frontend_model->coursesaved_checked($student_id, $course_id);
        $faculty_id = $data['get_coursedetails']->faculty_id;
        
        $data['total_student'] = $this->Frontend_model->total_student_courseDetails($enterprise_id,$faculty_id);
        $data['instructor_rating'] = $this->Frontend_model->instructor_rating_courseDetails($enterprise_id,$faculty_id);
        $data['get_facultycourse'] = $this->Frontend_model->get_facultycourse(8, '', $enterprise_id, $faculty_id, $course_id);
        $data['get_faqs'] = $this->Frontend_model->course_get_faqs(8, '', $enterprise_id,$course_id);
        $data['check_course_purchase'] = $this->Course_model->check_course_purchase($student_id, $course_id);
        $data['check_course_subscription'] = $this->Course_model->check_course_subscription($student_id, $course_id);
        $data['get_interestedcourse'] = $this->Frontend_model->get_interestedcourse(8, '', $enterprise_id, $course_id);
        $data['get_coursequiz'] = $this->Frontend_model->get_coursequiz($course_id);
        // $data['check_coursequiz'] = $this->Frontend_model->check_coursequiz($student_id, $course_id);
        $data['get_totalcoursetime'] = $this->Frontend_model->get_totalcoursetime($course_id);
        
        $purchase_courseid = (!empty($data['check_course_purchase']->product_id) ? $data['check_course_purchase']->product_id : '');
        $subscription_courseid = (!empty($data['check_course_subscription']->course_id) ? $data['check_course_subscription']->course_id : '');
       
        $data['rating_review'] = $this->Frontend_model->rating_review($course_id,$enterprise_id);
        $data['rating_review_byid'] = $this->Frontend_model->rating_review_byId($course_id,$enterprise_id,$student_id);
        $url = $data['get_coursedetails']->url;
        if(!empty($url)){
            $data['get_youtubevimeovideoapi'] = get_youtubevimeovideoapi($data['get_appseeting']->youtube_api_key, $data['get_appseeting']->vimeo_api_key, $url);
        }
        
        $data['check_followinginstructor'] = $this->Frontend_model->check_followinginstructor($student_id, $faculty_id, $enterprise_id);
        $data['get_assignmentprojectlist'] = $this->Frontend_model->get_assignmentprojectlist($course_id, $enterprise_id);

        // =================== passed exam completed status start
        if($param == 1){
           $questionexam_id = $this->session->userdata('questionexam_id');
           if($questionexam_id){
                $donestatusdata = array(
                    'is_done' => 1,
                );
                $this->db->where('questionexam_id', $questionexam_id)->update('question_exam_tbl', $donestatusdata);
           }           
        $this->session->unset_userdata('questionexam_id');
        }
        // =================== passed exam completed status close

        
        $data['module'] = "frontend";
        $data['get_usermappingcertificate'] = $this->Frontend_model->get_usermappingcertificate($student_id);
        $data['get_courseexams'] = $this->Frontend_model->get_courseexams($course_id);  
        

        if ($user_type == 4 && ($course_id == $purchase_courseid) || $user_type == 4 && ($course_id == $subscription_courseid) ) {
            $lesson_id = get_studentinfo($student_id)->last_lesson;
            $data['get_coursenotes'] = $this->Frontend_model->get_coursenotes($student_id, $course_id, $lesson_id);
            $check_lastcourseactivity = $this->Frontend_model->check_lastcourseactivity($student_id,$course_id);
            $data['page'] = "themes/default/course_details_afterlogin";
        } else {
            $data['page'] = "themes/default/course_details";
        }
        echo Modules::run("template/frontend_layout", $data);
    }


    // ============= its for student_follow_instructor ==================
    public function student_follow_instructor(){
        $user_id = $this->input->post('user_id', TRUE);
        $faculty_id = $this->input->post('faculty_id', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        
        $followdata = array(
            'student_id' => $user_id,
            'follower_id' => $faculty_id,
            'enterprise_id' => $enterprise_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('following_tbl', $followdata);
        echo "Following successfully done!";
    }

    public function student_unfollow_instructor(){
        $id = $this->input->post('id', TRUE);
        if($id){
            $this->db->where('id', $id)->delete('following_tbl');
            echo "Unfollowing successfully done!";
        }else{
            echo 'Invalid';
        }
    }

    // course details project load more 
    public function locad_more_project() {
        $lastid = $this->input->post('lastid');
        $course_id = $this->input->post('course_id');
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['enterprise_id']=$enterprise_id;
        //  $data['category_id'] = $category_id;
        $data['transfarentmenu'] = '';
        $data['module'] = "frontend";
        // $data['page'] = "themes/default/project_load_more";
        $data['get_load_data'] = $this->Frontend_model->project_load_more($lastid,$course_id,$enterprise_id);

        $this->load->view('themes/default/project_load_more', $data);
    }



    // =============== its for show quizform ================
    public function show_quizform($course_id = null, $exam_id = null){
 
        $student_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        if($user_type != 4){
            redirect(base_url());
        }
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

        $data['course_wise_lesson'] = $this->Course_model->course_wise_lesson($course_id);
        $data['get_coursedetails'] = $this->Frontend_model->get_coursedetails($course_id, $enterprise_id);

        // $data['get_coursequiz'] = $this->Frontend_model->get_coursequiz($course_id);
        // dd($data['get_coursequiz']);
        $get_courseexam = $this->Frontend_model->get_courseexam($course_id, $enterprise_id);

        $data['get_examwisequestion'] = get_examwisequestion($exam_id, $enterprise_id);
        $qst_count = $marks = 0;
            foreach ($data['get_examwisequestion'] as $single) {
                $qst_count += 1;
                $marks += $single->question_mark;
            }
            $data['qst_count'] = $qst_count;
            $data['marks'] = $marks;
        // dd($data['qst_count']);
        $questionexam_id = $this->session->userdata('questionexam_id');
        $data['get_examresultinfo'] = array();
        if($questionexam_id){
            $data['get_examresultinfo'] = $this->Frontend_model->get_examresultinfo($questionexam_id);  
        }
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/show_quizform";
        // $data['page'] = "themes/default/quiz";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function exam_submit(){
        $enterprise_shortname = $this->input->post('enterprise_shortname', TRUE);
        $enterprise_id = $this->input->post('enterprise_id');
        $questionexam_id = "QE" . date('d') . $this->generators->generator(7);
        $course_id = $this->input->post('course_id', TRUE);
        $student_id = $this->input->post('student_id', TRUE);
        $exam_id = $this->input->post('exam_id', TRUE);
        $full_duration = $this->input->post('full_duration', TRUE);
        $duration = $this->input->post('duration', TRUE);
        $question_id = $this->input->post('question_id', TRUE);
        $question_type = $this->input->post('question_type', TRUE);
        $instant_result = $this->input->post('instant_result', TRUE);
        $shortanswer = $this->input->post('shortanswer', TRUE);
        $totalquestion = $this->input->post('total_question', TRUE);
        $fullmarks = $this->input->post('fullmarks', TRUE);
        $packagetype = $this->input->post('packagetype', TRUE);
        $confirmation_message = $this->input->post('confirmation_message');
        $examstarttime = $this->input->post('examstarttime');
        $examendtime = date('Y-m-d H:i:s');
        // dd(timecounter($examendtime, $examstarttime));
        
        if($student_id && $course_id && $exam_id){
            $this->db->where('student_id', $student_id)
                    ->where('course_id', $course_id)
                    ->where('exam_id', $exam_id)
                    ->delete('question_exam_tbl');
        }
        
        // d($examstarttime);
        // dd($examendtime);
        if ($packagetype == 1) {
            $is_result = 1;
        } elseif ($packagetype == 2) {
            $is_result = 0;
        }

        // $get_packageinfo = $this->Frontend_model->get_packageinfo($course_id);

//        dd($get_packageinfo->instant_result);
//        $opt_name = 'q_' . $question_id . "_option_id";
//        $option_id = $this->input->post($opt_name);
        $exam_set = array();
        $ttl_answered = 0;
        $mcq_answered = 0;
        $shortqst_answered = 0;
        for ($i = 0, $n = count($question_id); $i < $n; $i++) {
            $questionids = $question_id[$i];
            $shortanswers = @$shortanswer[$i];
            $questiontypes = $question_type[$i];
            $opt_id = 'q_' . $questionids . "_option_id";
            $option_id = $this->input->post($opt_id);
            $option_arr = isset($option_id) && is_array($option_id) ? $option_id : [];
            $optionid = @implode(',', $option_arr);
//            if($optionid || $shortanswers){
//               
//              $dddd =  count($questionids);
//            }
            if (!empty($optionid) || !empty($shortanswers)) {
                $ttl_answered++;
            }
            if (!empty($optionid)) {
                $mcq_answered++;
            }
            if (!empty($shortanswers)) {
                $shortqst_answered++;
            }
//            d($optionid);
//            d($shortanswers);
//            d($i);
//            if ($optionid != '' || $shortanswers != '') {
            $exam_set[] = array(
                'question_id' => $questionids,
                'given_ans' => $optionid,
                'shortanswers' => $shortanswers,
                'question_type' => $questiontypes);
//            }
        }
        
        $count_ansquestionid = '';
        if (!empty($exam_set)) {
            $count_ansquestionid = count($exam_set);
        }

        $examdata = array(
            'questionexam_id' => $questionexam_id,
            'exam_id' => $exam_id,
            'student_id' => $student_id,
            'course_id' => $course_id,
            'duration' => timecounter($examendtime, $examstarttime),
//            'duration' => timediff(),
            'total_question' => $totalquestion,
            'mcq_answered' => $mcq_answered,
            'shortqst_answered' => $shortqst_answered,
            'total_answered' => $ttl_answered, //$count_ansquestionid,
            'marks' => $fullmarks,
            'exam_set' => json_encode($exam_set),
            'examstarttime' => $examstarttime,
            'examendtime' => $examendtime,
            'enterprise_id' => $enterprise_id,
            'is_done' => 0,
            'is_result' => $is_result,
        );
        // dd($examdata);
        if (!empty($examdata)) {
            $this->db->insert('question_exam_tbl', $examdata);
        }

        $examsubmitsession_data = array(
            'course_id' => $course_id,
            'exam_id' => $exam_id,
            'questionexam_id' => $questionexam_id,
        );
        $this->session->set_userdata($examsubmitsession_data);

    //     $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong></strong> Exam submitted successfully, Please see your results bellow!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>');
//        redirect($institute_shortname . '/result-summary/' . $course_id);
        $this->session->set_userdata('confirmation_message', $confirmation_message);
        // if ($get_packageinfo->instant_result == 1) {
        //     redirect($institute_shortname . '/result-summary/' . $questionexam_id . '/1');
        // } else {
        //     redirect($institute_shortname . '/student-exam-list/' . $course_id . '/1');
        // }
        // redirect($enterprise_shortname . '/student-activity/'.$questionexam_id);
        redirect($enterprise_shortname . '/show-quizform/'.$course_id. '/'. $exam_id. '/'.$questionexam_id);
        // redirect($_SERVER['HTTP_REFERER']);
        // redirect($enterprise_shortname . '/exam-result/' . $questionexam_id);
    }

    // public function exam_result($questionexam_id){
    //     echo $questionexam_id;
    // }

    // public function get_studentexamshow(){
    //     $data['transfarentmenu'] = '';
    //     $student_id = $this->input->post('student_id', TRUE);
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $questionexam_id = $this->input->post('exam_id', TRUE);
    //     $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
    //     $data['enterprise_id'] = $enterprise_id;
    //     $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

    //     // $data['course_wise_lesson'] = $this->Course_model->course_wise_lesson($course_id);
    //     $data['get_coursedetails'] = $this->Frontend_model->get_coursedetails($course_id, $enterprise_id);
    //     $get_courseexam = $this->Frontend_model->get_courseexam($course_id, $enterprise_id);
    //     $data['get_examwisequestion'] = get_examwisequestion($get_courseexam->exam_id, $enterprise_id);
    //     dd($data['get_examwisequestion']);
    //     $data['get_resultsummary'] = $this->Frontend_model->get_examinfo($questionexam_id);
    //     $data['exam_set'] = json_decode($data['get_resultsummary']->exam_set);

    //     $qst_count = $marks = $givennotans = $givenmcqqstcount = 0;
    //     $givenoption_array = array();
        
    //     foreach ($data['exam_set'] as $single) {
    //         $question_info = $this->Frontend_model->get_questionedit($single->question_id);
    //         $qst_count += 1;
    //         $marks += $question_info->question_mark;

    //         if ($single->given_ans == NULL && $single->shortanswers == '') {
    //             $givennotans += 1;
    //         }

    //         if ($single->given_ans) {
    //             $givenmcqqstcount += 1;
    //         }

    //         $givenoption_array[] = $single->given_ans;
    //         $givenoption_array[] = $single->question_type;
    //     }
        


    //     $data['givenoption_array'] = $givenoption_array;

    //     $this->load->view("themes/default/show_exampaper", $data);
    // }

    public function course_notesave() {
        $notesid = $this->input->post('noteid', TRUE);
        $student_id = $this->input->post('student_id', True);
        $course_id = $this->input->post('course_id', True);
        $lesson_id = $this->input->post('lesson_id', True);
        $notes = $this->input->post('notes', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', True);
        $checknotes = $this->Frontend_model->checkexistsnote($student_id, $course_id, $notes);

        if ($notesid) {
            $notesdata = array(
                'student_id' => $student_id,
                'course_id' => $course_id,
                'lesson_id' => $lesson_id,
                'notes' => $notes,
                'enterprise_id' => $enterprise_id,
                'status' => 1,
                'updated_by' => $enterprise_id,
                'updated_date' => date('Y-m-d H:i:s'),
            );
            $this->db->where('id', $notesid)->update('notes_tbl', $notesdata);
            echo display('updated_successfully');
        } else {
            $notesdata = array(
                'student_id' => $student_id,
                'course_id' => $course_id,
                'lesson_id' => $lesson_id,
                'notes' => $notes,
                'type' =>1,
                'enterprise_id' => $enterprise_id,
                'status' => 1,
                'created_by' => $enterprise_id,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('notes_tbl', $notesdata);
            echo display('added_successfully');
        }
    }

    public function noteedit_form() {
        $id = $this->input->post('id', True);
        $data['noteeditdata'] = $this->Frontend_model->noteeditdata($id);

        $this->load->view('frontend/themes/default/noteedit', $data);
    }
  

    public function get_noteslist() {
        $student_id = $this->input->post('student_id', TRUE);
        $course_id = $this->input->post('course_id', True);
        $lesson_id = $this->input->post('lesson_id', True);
        $data['get_coursenotes'] = $this->Frontend_model->get_coursenotes($student_id, $course_id, $lesson_id);

        $this->load->view('frontend/themes/default/get_noteslist', $data);
    }
    public function get_notecount() {
        $student_id = $this->input->post('student_id', TRUE);
        $course_id = $this->input->post('course_id', True);
        $lesson_id = $this->input->post('lesson_id', True);

        $data['get_coursenotes'] = $this->Frontend_model->get_coursenotes($student_id, $course_id, $lesson_id);

        $notecount = count($data['get_coursenotes']);
        echo '<span class="mb-2 d-block mb-sm-0 notecount-area">
                '.$notecount.' Notes taken
            </span>
            ';
    }

    public function get_allnoteslist() {
        $student_id = $this->input->post('student_id', TRUE);
        $course_id = $this->input->post('course_id', True);
        $data['get_coursenotes'] = $this->Frontend_model->get_allnoteslist($student_id, $course_id);

        $this->load->view('frontend/themes/default/get_noteslist', $data);
    }

    public function get_allnotecount() {
        $student_id = $this->input->post('student_id', TRUE);
        $course_id = $this->input->post('course_id', True);

        $data['get_coursenotes'] = $this->Frontend_model->get_allnoteslist($student_id, $course_id);

        $notecount = count($data['get_coursenotes']);
        // dd($notecount);
        echo '<span class="mb-2 d-block mb-sm-0 notecount-area">
                '.$notecount.' Notes taken
            </span>
            ';
    }

    public function note_delete() {
        $notesid = $this->input->post('id', TRUE);
        if ($notesid) {
            $this->db->where('id', $notesid)->delete('notes_tbl');
            echo display('deleted_successfully');
        }
    }

    public function claim_certificate_form() {
        $data['course_id'] = $this->input->post('course_id', True);
        $data['student_id'] = $this->input->post('student_id', True);
        $data['get_templates'] = $this->Frontend_model->get_templates($type = 'certificate');

        $this->load->view('frontend/themes/default/claim_certificate_form', $data);
    }
    // ============== its for assign_student_course_certificate =====================
    public function assign_student_course_certificate(){
        $user_id = $this->input->post('user_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $certificate_id = $this->input->post('certificate_id', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);

        $check_existscertificate_assign = $this->Frontend_model->check_existscertificate_assign($user_id, $course_id, $certificate_id);
        $checkcertificatedata = $this->db->order_by('id', 'desc')->get('certificate_mapping_tbl')->row();
        if($check_existscertificate_assign){
            echo "Already this certificate assigned you!";
            exit();
        }
        if(empty($checkcertificatedata)){
            $ordering = 0;
        }else{
            $ordering = $checkcertificatedata->ordering+1;
        }
        
        $mappingdata = array(
            'user_id' => $user_id,
            'course_id' => $course_id,
            'certificate_id' => $certificate_id,
            'enterprise_id' => $enterprise_id,
            'ordering' => $ordering,
            'created_by' => $user_id,
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('certificate_mapping_tbl', $mappingdata);
        // complete status enable in invoice table 
        $complete_status=array(
            'complete_status'=>"1"
        );
        $this->db->where('customer_id',$user_id)->where('product_id',$course_id)->update('invoice_details',$complete_status);
        echo "Certificate claim is done!";
    }

    public function show_course_preview() {
        $data['title'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['enterprise_id'] = $enterprise_id;
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $course_id = $this->input->post('course_id', True);
        $data['course_id']=$course_id;
        $lesson_id = $this->input->post('lesson_id', True);
        $data['get_lessoninfo'] = get_lessoninfo($lesson_id);
        $data['get_coursedetails'] = $this->Frontend_model->get_coursedetails($course_id, $enterprise_id);
        $url = $data['get_lessoninfo']->provider_url; //'https://www.youtube.com/watch?v=GoSwEBp7e9s'; //'https://vimeo.com/117275538';
        if ($data['get_lessoninfo']->lesson_type == 1) {
            $data['get_youtubevimeovideoapi'] = get_youtubevimeovideoapi($data['get_appseeting']->youtube_api_key, $data['get_appseeting']->vimeo_api_key, $url);
        }
//        dd($get_youtubevimeovideoapi['embed_video']);

        $this->load->view('frontend/themes/default/course_preview', $data);
    }

    public function load_course_content() {
        $data['title'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id = $this->session->userdata('user_id');
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $course_id = $this->input->post('course_id', True);
        $lesson_id = $this->input->post('lesson_id', True);
        $data['enterprise_id'] = $enterprise_id;
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', True);
        $data['get_lessoninfo'] = get_lessoninfo($lesson_id);
        $lastactivedata = array(
            'last_lesson' => $lesson_id,
        );
         $this->db->where('student_id',$user_id)->update('students_tbl', $lastactivedata);
//        $data['get_coursedetails'] = $this->Frontend_model->get_coursedetails($course_id, $enterprise_id);
        $url = $data['get_lessoninfo']->provider_url;
        if ($data['get_lessoninfo']->lesson_type == 1) {
            $data['get_youtubevimeovideoapi'] = get_youtubevimeovideoapi($data['get_appseeting']->youtube_api_key, $data['get_appseeting']->vimeo_api_key, $url);
        }
//        dd($get_youtubevimeovideoapi['embed_video']);

        $this->load->view('frontend/themes/default/load_course_content', $data);
    }


    public function course_lesson_wise_information(){
        $course_id = $this->input->post('course_id', True);
        $lesson_id = $this->input->post('lesson_id', True);
        $enterprise_id = $this->input->post('enterprise_id', True);

        $lesson_description = $this->db->select("*")->from('lesson_tbl')->where('lesson_id',$lesson_id)->get()->row();
        $lesson_materials = $this->db->select('*')
                            ->from('course_resource_tbl')
                            ->where('course_id',$course_id)
                            ->where('lesson_id',$lesson_id)
                            ->get()->result();

        $lessonAlldata = array(
            'lesson_description' => $lesson_description,
            'lesson_materials' => $lesson_materials,
        );                    
        echo json_encode($lessonAlldata);
    }

//    ========= its for get coursesave ===========
    public function get_coursesave() {
        $status = $this->input->post('status', TRUE);
        $student_id = $this->input->post('student_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);

        
        $checksaveddata = $this->Frontend_model->coursesaved_checked($student_id, $course_id);


        $savedata = array(
            'status' => $status,
            'course_id' => $course_id,
            'student_id' => $student_id,
        );
        //        dd($savedata);
        if ($status == 0) {
            $this->db->where('student_id', $student_id)->where('course_id', $course_id)
                    ->delete('coursesave_tbl');
        } else {
            $this->db->insert('coursesave_tbl', $savedata);
        }
        if ($status == 1) {
            $coursestatus='<a href="javascript:void(0)"   onclick="get_coursesave(0,'."'$course_id'".')"> <i    class="bookmark-icon fa-bookmark fas  " style="cursor: pointer;font-size: 30px;"></i><div>Save</div></a>';
            // echo 'Saved successfully!';
            echo $coursestatus;
            // exit();
        } else {
            $courseunsave='<a href="javascript:void(0)"   onclick="get_coursesave(1,'."'$course_id'".')"><i   class="far fa-bookmark " style="cursor: pointer;font-size: 30px;"></i><div>Save</div></a>';
            // echo 'Unsaved successfully!';
            // exit();
            echo $courseunsave;
        }
    }
    public function get_coursesavelandigpage() {
        $status = $this->input->post('status', TRUE);
        $student_id = $this->input->post('student_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);

        
        $checksaveddata = $this->Frontend_model->coursesaved_checked($student_id, $course_id);


        $savedata = array(
            'status' => $status,
            'course_id' => $course_id,
            'student_id' => $student_id,
        );
        //        dd($savedata);
        if ($status == 0) {
            $this->db->where('student_id', $student_id)->where('course_id', $course_id)
                    ->delete('coursesave_tbl');
        } else {
            $this->db->insert('coursesave_tbl', $savedata);
        }
        if ($status == 1) {
            $image=base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png');
            
            $coursestatus='<img  onclick="get_coursesaveloop(0,'."'$course_id'".')" src="'.$image.'" class="img-fluid ms-auto " alt="" style="cursor: pointer;">';
            // $coursestatus=' <i  onclick="get_coursesaveloop(0,'."'$course_id'".')"  class="fa-bookmark far text-dark-cerulean text-end ms-auto fs-5" style="cursor: pointer;    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));"></i>';
            // echo 'Saved successfully!';
            echo $coursestatus;
            // exit();
        } else {

            $img=base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); 
            $courseunsave='<img onclick="get_coursesaveloop(1, '."'$course_id'".')" src="'.$img.'" class="img-fluid ms-auto " alt="" style="cursor: pointer;">';

            // $courseunsave='<i onclick="get_coursesaveloop(1, '."'$course_id'".')"  class="far fa-bookmark ms-auto fs-5" style="cursor: pointer;    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));"></i>';
            // echo 'Unsaved successfully!';
            // exit();
            echo $courseunsave;
        }
    }

    public function otp_checkform() {
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        // $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/otp_checkform";
        echo Modules::run("template/frontend_layout", $data);
    }
    public function student_signup() {
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/student_signup";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function instructor_signup() {
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/instructor_signup";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function enterprise_signup() {
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/enterprise_signup";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function ins_signin() {
        $segment2 = $this->uri->segment(2);
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $get_socialauthconfigdata = $this->Frontend_model->get_socialauthconfigdata($enterprise_id, $type = 1); // 1 for google
    //    dd($get_socialauthconfigdata);

        
         
        $data['module'] = "frontend";       
        $data['page'] = "themes/default/instructor_signin";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function signin() {
        $segment2 = $this->uri->segment(2);
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $get_socialauthconfigdata = $this->Frontend_model->get_socialauthconfigdata($enterprise_id, $type = 1); // 1 for google
    //    dd($get_socialauthconfigdata);

        // ========== its  for google login start ============
        $loginbuttonlink = '';
        if($get_socialauthconfigdata){
            include_once "vendor/autoload.php";
            $google_client = new Google_Client();            
            $google_client->setClientId((!empty($get_socialauthconfigdata->appid_clientid) ? $get_socialauthconfigdata->appid_clientid : '')); //Define your ClientID
            $google_client->setClientSecret((!empty($get_socialauthconfigdata->secret_key) ? $get_socialauthconfigdata->secret_key : '')); //Define your Client Secret Key
            $google_client->setRedirectUri((!empty($get_socialauthconfigdata->redirect_url) ? $get_socialauthconfigdata->redirect_url : '')); //Define your Redirect Uri
            $google_client->addScope('email');
            $google_client->addScope('profile');
        
            if(isset($_GET["code"])){
                $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                    
                if(!isset($token["error"])){
                    $google_client->setAccessToken($token['access_token']);
                    $this->session->set_userdata('access_token', $token['access_token']);
                    $google_service = new Google_Service_Oauth2($google_client);
                    $data = $google_service->userinfo->get();
                    // ============== its for go to signin by google ====================
                    $this->signinbygoogle($data);
                    $this->session->set_userdata('user_data', $user_data);
                }
            }
            $loginbuttonlink = $google_client->createAuthUrl();
        }
        
            $login_button = '<a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="'.$loginbuttonlink.'"><i
                                class="fab fa-google me-1"></i>Sign in with Google</a>';
            $data['googlelogin_button'] = $login_button;
            // ========== its  for google login close ============

            // ================its for facebook login start ===================
            // Facebook authentication url 
         
            // Authenticate user with facebook 
            if($this->facebook->is_authenticated()){ 
                $this->signinbyfacebook();
                // Facebook logout URL 
                $data['logoutURL'] = $this->facebook->logout_url(); 
            }else{ 
                // Facebook authentication url 
                $data['authURL'] =  $this->facebook->login_url(); 
            } 
            // ================ its for facebook login close ===================
         
        $data['module'] = "frontend";
        if($segment2 == 'signin'){
            $data['page'] = "themes/default/learner_signin";
        }elseif($segment2 == 'learner-signin'){
            $data['page'] = "themes/default/learner_signin";
        }elseif($segment2 == 'ins-signin'){
            $data['page'] = "themes/default/instructor_signin";
        }
        echo Modules::run("template/frontend_layout", $data);
    }

    public function signinbygoogle($data){
        // dd($data);
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $current_datetime = date('Y-m-d H:i:s');
                // dd($data['email']);
                $Is_already_registerdata = $this->Frontend_model->Is_already_register($data['email']);
                $log_id = "ST" . date('d') . $this->generators->generator(6);
                
                if($Is_already_registerdata){
                $data['log_id'] = $Is_already_registerdata->log_id;
                //update data
                $user_data = array(
                'name' => $data['given_name']." " .$data['family_name'],
                'shortname' => '',
                'mobile' => '',
                'email' => $data['email'],
                'username' => $data['email'],
                'last_login' => $current_datetime,
                'last_logout' => $current_datetime,
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'status' => '1',
                'enterprise_id' => $enterprise_id,
                'updated_by' => $enterprise_id,
                'updated_at' => $current_datetime,
                );
                // dd($user_data);
                $this->db->where('log_id', $Is_already_registerdata->log_id)->update('loginfo_tbl', $user_data);
                $studentinfo = array(
                    'name' => $data['given_name']." " .$data['family_name'],
                    'email' => $data['email'],
                    'enterprise_id'=>$enterprise_id,
                    'status' => '1',
                );
                $this->db->where('student_id', $Is_already_registerdata->log_id)->update('students_tbl', $studentinfo);
                // $studentpictureinfo = array(
                //     'picture' => $data['picture'],
                //     'picture_type' => 'students',
                //     'updated_by' => $enterprise_id,
                //     'updated_date' => $current_datetime,
                // );
                // $this->db->where('from_id', $Is_already_registerdata->log_id)->update('picture_tbl', $studentpictureinfo);
                $this->getloginsession($data);
                redirect($this->enterprise_shortname.'/student-dashboard');
                }else{
                    $data['log_id'] = $log_id;
                //insert data
                $user_data = array(
                // 'profile_picture' => $data['picture'],
                'log_id' => $log_id, //$data['id'],
                'name' => $data['given_name']." " .$data['family_name'],
                'shortname' => '',
                'mobile' => '',
                'email' => $data['email'],
                'username' => $data['email'],
                'password' => '',
                'user_types' => '4',
                'is_admin' => '4',
                'last_login' => $current_datetime,
                'last_logout' => $current_datetime,
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'status' => '1',
                'enterprise_id' => $enterprise_id,
                'created_by' => $enterprise_id,
                'created_at' => $current_datetime,
                );
                // dd($user_data);
                $this->db->insert('loginfo_tbl', $user_data);
                $studentinfo = array(
                    'student_id' => $log_id, //$data['id'],
                    'name' => $data['given_name']." " .$data['family_name'],
                    'email' => $data['email'],
                    'enterprise_id'=>$enterprise_id,
                    'status' => '1',
                );
                $this->db->insert('students_tbl', $studentinfo);
                // $studentpictureinfo = array(
                //     'from_id' => $log_id,
                //     'picture' => $data['picture'],
                //     'picture_type' => 'students',
                //     'created_by' => $enterprise_id,
                //     'created_date' => $current_datetime,
                // );
                // $this->db->insert('picture_tbl', $studentpictureinfo);
                $this->getloginsession($data);
                redirect($this->enterprise_shortname.'/student-dashboard');
                }
    }

    public function signinbyfacebook(){
        
         // Get user info from facebook 
         $fbUser = $this->facebook->request('get', '/me?fields=id,first_name, last_name, name, email, link, gender, about, age_range, birthday, cover, education, hometown, languages, relationship_status, religion, photos, picture'); 
        //  d($fbUser);
        // dd($fbUser);
             // Preparing data for database insertion 
                // $userData['oauth_provider'] = 'facebook'; 
                // $userData['oauth_uid']    = !empty($fbUser['id'])?$fbUser['id']:'';; 
                // $userData['first_name']    = !empty($fbUser['first_name'])?$fbUser['first_name']:''; 
                // $userData['last_name']    = !empty($fbUser['last_name'])?$fbUser['last_name']:''; 
                // $userData['email']        = !empty($fbUser['email'])?$fbUser['email']:''; 
                // $userData['gender']        = !empty($fbUser['gender'])?$fbUser['gender']:''; 
                // $userData['picture']    = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:''; 
                // $userData['link']        = !empty($fbUser['link'])?$fbUser['link']:'https://www.facebook.com/'; 
                 
                // Insert or update user data to the database 
            
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $current_datetime = date('Y-m-d H:i:s');
                $Is_already_registerdata = $this->Frontend_model->Is_already_register($fbUser['email']);
                $log_id = "ST" . date('d') . $this->generators->generator(6);
                                
                if($Is_already_registerdata){

                    $fbUser['log_id'] = $Is_already_registerdata->log_id;
                //update data
                $user_data = array(
                    'name' => $fbUser['name'],
                    'shortname' => '',
                    'mobile' => '',
                    'email' => $fbUser['email'],
                    'username' => $fbUser['email'],
                    'last_login' => $current_datetime,
                    'last_logout' => $current_datetime,
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'status' => '1',
                    'enterprise_id' => $enterprise_id,
                    'updated_by' => $enterprise_id,
                    'updated_at' => $current_datetime,
                );
                // dd($user_data);
                $this->db->where('log_id', $Is_already_registerdata->log_id)->update('loginfo_tbl', $user_data);
                $studentinfo = array(
                    'name' => $fbUser['name'],
                    'email' => $fbUser['email'],
                    'enterprise_id'=>$enterprise_id,
                    'status' => '1',
                );
                $this->db->where('student_id', $Is_already_registerdata->log_id)->update('students_tbl', $studentinfo);
                $this->getloginsession($fbUser);
                redirect($this->enterprise_shortname.'/student-dashboard');
                }else{
               
                    $fbUser['log_id'] = $log_id;
                //  dd($fbUser);
                //insert data
                $user_data = array(
                    'log_id' => $log_id, //$data['id'],
                    'name' => $fbUser['name'],
                    'shortname' => '',
                    'mobile' => '',
                    'email' => $fbUser['email'],
                    'username' => $fbUser['email'],
                    'password' => '',
                    'user_types' => '4',
                    'is_admin' => '4',
                    'last_login' => $current_datetime,
                    'last_logout' => $current_datetime,
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'status' => '1',
                    'enterprise_id' => $enterprise_id,
                    'created_by' => $enterprise_id,
                    'created_at' => $current_datetime,
                );
                // dd($user_data);
                $this->db->insert('loginfo_tbl', $user_data);
               
                $studentinfo = array(
                    'student_id' => $log_id, //$data['id'],
                    'name' => $fbUser['name'],
                    'email' => $fbUser['email'],
                    'enterprise_id'=>$enterprise_id,
                    'status' => '1',
                );
                
                $this->db->insert('students_tbl', $studentinfo);
                $this->getloginsession($fbUser);
                redirect($this->enterprise_shortname.'/student-dashboard');
                }
    }
    public function getloginsession($data){
        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.log_id', $data['log_id']);
        $checkuser = $this->db->get()->row();

        $subscription_id = '';
        if($checkuser->user_types == 4){
            $get_studentlastsubcriptionid = $this->db->select('subscription_id')
                                            ->from('invoice_tbl')
                                            ->where('customer_id', $checkuser->log_id)
                                            ->where('is_subscription', 1)
                                            ->order_by('id', 'desc')
                                            ->get()->row();
        $subscription_id = $get_studentlastsubcriptionid->subscription_id;
        }

        // dd($checkuser);
        $sData = array(
            'isLogIn' => true,
            'isAdmin' => (($checkuser->is_admin == 1) ? true : false),
            'is_admin' => $checkuser->is_admin,
            'user_type' => $checkuser->user_types,
            'log_id' => $checkuser->log_id,
            'user_id' => $checkuser->log_id,
            'created_by' => $checkuser->created_by,
            'fullname' => $checkuser->name,
            'email' => $checkuser->email,
            'image' => (!empty($checkuser->image) ? $checkuser->image : $checkuser->picture),
            'subscription_id' => $subscription_id,
            'last_login' => $checkuser->last_login,
            'last_logout' => $checkuser->last_logout,
            'ip_address' => $checkuser->ip_address,
            'session_id' => session_id(),
        );
        $this->session->set_userdata($sData);
    }

    //    ==============its for checkout_unique_mailcheck=============
    public function checkout_unique_mailcheck() {
        $email = $this->input->post('email', TRUE);
        $get_mailcheck = $this->Frontend_model->get_mailcheck($email);
        if (@$get_mailcheck->email != '') {
            echo 1;
            exit();
        }
    }

//    ============= its for register-save =============
    public function register_save() {
        $name = $this->input->post('name', TRUE);
        $mobile = $this->input->post('mobile', TRUE);
        $utype = $this->input->post('utype', TRUE);
        $email = $this->input->post('email', TRUE);
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $agree_toterms = $this->input->post('agree_toterms', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        if ($utype == 2) {
            $short_name = $str = str_replace(" ", "-", $name);
            $shortname = rtrim($short_name, '-');
        } else {
            $shortname = '';
        }

    //    if ($utype == 4) {
    //        $status = 1;
    //    } elseif ($utype == 5) {
    //        $status = 0;
    //    }
        $status = 0;
       
//        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        // $pusher_config = $this->Setting_model->pusher_config($enterprise_id);

        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        if ($this->form_validation->run() == FALSE) {
            echo "not_valid_email";
            exit();
        }
        
        $get_mobilenocheck = $this->Frontend_model->get_mobilenocheck($mobile, $utype, $enterprise_id);
        $get_mailcheck = $this->Frontend_model->get_mailcheck($email, $enterprise_id);
        $get_usernamecheck = $this->Frontend_model->get_usernamecheck($username, $enterprise_id);
        // dd($get_mobilenocheck);
        if($get_mobilenocheck){
            echo 'mobileexists';
            exit();
        }
        // dd($get_mobilenocheck);
        // dd($get_usernamecheck);
        if ($get_mailcheck) {
            echo 'mailexists';
            exit();
        } elseif ($get_usernamecheck) {
            echo 'usernameexists';
            exit();
        }
        // ============ its for register data  ===========
        if ($utype == 4) {
            $log_id = "ST" . date('d') . $this->generators->generator(6);
            $student_data = array(
                'student_id' => $log_id,
                'name' => $name,
                'mobile' => $mobile,
                'address' => '',
                'email' => $email,
                'status ' => $status,
                'agree_toterms' => $agree_toterms,
                'enterprise_id' => $enterprise_id,
                'created_by' => 1,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('students_tbl', $student_data);
            // echo display('registration_successfully');
        } elseif ($utype == 5) {
            $log_id = "F" . date('d') . $this->generators->generator(6);
            $faculty_data = array(
                'faculty_id' => $log_id,
                'name' => $name,
                'mobile' => $mobile,
                'email' => $email,
                'birthday' => '',
                'address' => '',
                'status' => $status,
                'agree_toterms' => $agree_toterms,
                'enterprise_id' => $enterprise_id,
                'created_by' => 1,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('faculty_tbl', $faculty_data);
            //        ============ its for user access role assign ========
            //            $user_access_info = array(
            //                'fk_user_id' => $log_id,
            //                'fk_role_id' => 2,
            //            );
            //            $this->db->insert('sec_user_access_tbl', $user_access_info);

            // $get_pendingfaculty = $this->db->select('count(id) as total_pending')->from('faculty_tbl')->where('status', 0)->get()->row();
            // $data['count'] = $get_pendingfaculty->total_pending;
            // $data['message'] = 'faculty-registration';
            // if ($pusher_config) {
            //     $this->pusher->trigger('my-channel', 'my-event', $data);
            // }

            // echo display('request_send_pls_waitfor_confirmation');
        } elseif ($utype == 2) {
            $log_id = "E" . date('d') . $this->generators->generator(6);
            $enterprise_data = array(
                'enterprise_id' => $log_id,
                'name' => $name,
                'mobile_no' => $mobile,
                'email' => $email,
                'date_of_birth' => '',
                'address' => '',
                'status' => $status,
                'agree_toterms' => $agree_toterms,
                'created_by' => 1,
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('enterprise_tbl', $enterprise_data);
            //        ============ its for user access role assign ========
//            $user_access_info = array(
//                'fk_user_id' => $log_id,
//                'fk_role_id' => 2,
//            );
//            $this->db->insert('sec_user_access_tbl', $user_access_info);

            // $get_pendingenterprise = $this->db->select('count(id) as total_enterprisepending')->from('enterprise_tbl')->where('status', 0)->get()->row();
            // $data['count'] = $get_pendingenterprise->total_enterprisepending;
            // $data['message'] = 'enterprise-registration';
            // if ($pusher_config) {
            //     $this->pusher->trigger('my-channel', 'my-event', $data);
            // }
            echo display('request_send_pls_waitfor_confirmation');
        }
        $randomkey = rand(1, 10000);
        $loginfo_data = array(
            'log_id' => $log_id,
            'name' => $name,
            'shortname' => strtolower($shortname),
            'mobile' => $mobile,
            'email' => $email,
            'username' => $username,
            'password' => md5($password),
            'user_types' => $utype,
            'is_admin' => $utype,
            'last_login' => '',
            'last_logout' => '',
            'ip_address' => '',
            'status' => $status,
            'random_key' => $randomkey,
            'enterprise_id' => $enterprise_id,
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('loginfo_tbl', $loginfo_data);
        
    if ($utype == 5 || $utype == 4) {
        if($utype == 4){
            $data['message'] = "প্রিয়  " .$name ." , আপনার  OTP ".$randomkey."। আপনি সফলভাবে রেজিস্ট্রেশন সম্পন্ন করেছেন, ধন্যবাদ। ";
        }elseif($utype == 5){
            $data['message'] = "প্রিয়  " .$name ." , আপনার  OTP ".$randomkey."। আপনি সফলভাবে রেজিস্ট্রেশন সম্পন্ন করেছেন! দয়া করে এডমিন অনুমোদনের জন্য অপেক্ষা করুন। ধন্যবাদ।";
        }
        $data['log_id'] = $log_id;
        $data['type'] = $utype;
        // $this->smsgateway->send_bdtasksmsgatway($data);
        // $this->smsgateway->send_alphasms($data);
        $this->smsgateway->send_elitbuzzsms($data);
        
        
        $get_mail_config = $this->db->select('*')->from('mail_config_tbl')->where('enterprise_id', $enterprise_id)->get()->row();;
        // $this->registrationsendemail($get_mail_config, $log_id);
        if($utype == 4){
            $type = 1;
        }elseif($utype == 5){
            $type = 2;
        }
        $notificationdata = array(
            'user_id' => $log_id,
            'courses_site' => 1,
            'courses_email' => 1,
            'courses_sms' => 1,
            'offerupdates_site' => 1,
            'offerupdates_email' => 1,
            'offerupdates_sms' => 1,
            'blog_site' => 1,
            'blog_email' => 1,
            'blog_sms' => 1,
            'events_site' => 1,
            'events_email' => 1,
            'events_sms' => 1,
            'community_site' => 1,
            'community_email' => 1,
            'community_sms' => 1,
            'soundnoti_site' => 1,
            'soundnoti_email' => 1,
            'soundnoti_sms' => 1,
            'type' => $type,
            'created_by' => $log_id,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_by' => $log_id,
            'updated_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('notification_config_tbl', $notificationdata);

    }
    $this->session->set_userdata('otp_user_id', $log_id);
    echo $log_id;

    //     if ($utype == 4) {
    //         $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
    //         $this->db->from('loginfo_tbl a');
    //         $this->db->join('user b', 'b.log_id = a.log_id', 'left');
    //         $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
    //         $this->db->where('a.log_id', $log_id);
    //         $checkUserInfo = $this->db->get()->row();
    //         $sData = array(
    //             'isLogIn' => true,
    //             'isAdmin' => $checkUserInfo->is_admin,
    //             'is_admin' => $checkUserInfo->is_admin,
    //             'user_type' => $checkUserInfo->user_types,
    //             'log_id' => $checkUserInfo->log_id,
    //             'user_id' => $checkUserInfo->log_id,
    //             'fullname' => $checkUserInfo->name,
    //             'email' => $checkUserInfo->email,
    //             'enterprise_id' => $checkUserInfo->enterprise_id,
    //             'image' => (!empty($checkUserInfo->image) ? $checkUserInfo->image : $checkUserInfo->picture),
    //             'session_id' => session_id(),
    //         );
    //         $this->session->set_userdata($sData);
    //     }
    }

    public function otpsubmit(){
        $log_id = $this->input->post('log_id', true);
        $otp = $this->input->post('otp', true);
        $get_userinfo = get_userinfo($log_id);
        $utype = $get_userinfo->user_types;
        $name = $get_userinfo->name;
        $enterprise_id = $get_userinfo->enterprise_id;
        $otpsend_minute = date('i', strtotime($get_userinfo->created_at));
        $otp_minuteadd = date('i', strtotime($get_userinfo->created_at .'+ 1 minute'));
        $now_minute = date('i');
        // d($log_id);
        // dd($get_userinfo);
        // d($otp_minuteadd);
        // if($now_minute > $otp_minuteadd){
        //     echo 'expire';
        // }else{
            // d($otp);
            // dd($get_userinfo->random_key);
            if($get_userinfo->random_key == $otp){
            
                if ($utype == 4 || $utype == 5) {
                  $otpdata = array(
                      'status' => 1,
                  );
                  $this->db->where('log_id', $log_id)->update('loginfo_tbl', $otpdata);
                  $this->db->where('faculty_id', $log_id)->update('faculty_tbl', $otpdata);
                  $this->db->where('student_id', $log_id)->update('students_tbl', $otpdata);
            
                        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
                        $this->db->from('loginfo_tbl a');
                        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
                        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
                        $this->db->where('a.log_id', $log_id);
                        $checkUserInfo = $this->db->get()->row();
                        $sData = array(
                            'isLogIn' => true,
                            'isAdmin' => $checkUserInfo->is_admin,
                            'is_admin' => $checkUserInfo->is_admin,
                            'user_type' => $checkUserInfo->user_types,
                            'log_id' => $checkUserInfo->log_id,
                            'user_id' => $checkUserInfo->log_id,
                            'fullname' => $checkUserInfo->name,
                            'email' => $checkUserInfo->email,
                            'enterprise_id' => $checkUserInfo->enterprise_id,
                            'image' => (!empty($checkUserInfo->image) ? $checkUserInfo->image : $checkUserInfo->picture),
                            'session_id' => session_id(),
                        );
                        $this->session->set_userdata($sData);
                    }
                  echo '1';
                  $this->session->unset_userdata('otp_user_id');
                }else{
                    echo "0";
                }
        // }
        
      
    }

    public function resendotp(){
        $log_id = $this->input->post('log_id', true);
        $get_userinfo = get_userinfo($log_id);
        $utype = $get_userinfo->user_types;
        $name = $get_userinfo->name;
        $randomkey = $get_userinfo->random_key; //rand(1, 10000)
        
           
        $data['message'] = "প্রিয়  " .$name ." আপনার নতুন OTP ".$randomkey." ";
           
        $data['log_id'] = $log_id;
        $data['type'] = $utype;
        // $this->smsgateway->send_bdtasksmsgatway($data);
        // $this->smsgateway->send_alphasms($data);
        $this->smsgateway->send_elitbuzzsms($data);


        $resend_data = array(
            'random_key' => $randomkey,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('log_id', $log_id)->update('loginfo_tbl', $resend_data);
        echo "Resend successfully!";
    }

    public function registrationsendemail($get_mail_config, $log_id) {
       
        $config = Array(
            'protocol' => $get_mail_config->protocol, //'smtp',
            'smtp_host' => $get_mail_config->smtp_host, //'ssl://smtp.gmail.com',
            'smtp_port' => $get_mail_config->smtp_port, //465,
            'smtp_user' => $get_mail_config->smtp_user, //'', // change it to yours
            'smtp_pass' => $get_mail_config->smtp_pass, // '', // change it to yours
            'mailtype' => $get_mail_config->mailtype, //'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_crypto'=>'tls'
        );

        $data['author_info'] = get_userinfo($log_id); //$this->Faculty_model->faculty_info($faculty_id);
        $name = $data['author_info']->name;
        $email = $data['author_info']->email;
        
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user'], "Instructor Registration");
        $this->email->to($email);
        $this->email->subject("Instructor Registration");
        $this->email->message("Dear <strong>$name</strong> ,<br>You have registered successfully, Please wait for Admin Approval." . "<br><br>"
                . "<br>" . "Please visit <a href='https://lead.academy/'> lead.academy</a>"
                . "<br> Thank You");
        $send_data = $this->email->send();
    }

    //    ========== its for subscribe_submit =============
    public function subscriber_save() {
        $email = $this->input->post('email', TRUE);
        // $is_receive = $this->input->post('is_receive', TRUE);
        // $enterprise_id  = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $enterprise_id = $this->input->post('enterprise_id');
        
        $check_subscribe = $this->db->select('*')->from('subscribes_tbl')->where('mail', $email)->get()->row();
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            echo "not_valid_email";
            exit();
        }
        if ($check_subscribe) {
            echo "error";
        } else {
            $subscribe_data = array(
                'mail' => $email,
                'is_receive' => '1',
                'enterprise_id' => $enterprise_id,
            );

            $this->db->insert('subscribes_tbl', $subscribe_data);
            $get_mail_config = $this->db->select('*')->from('mail_config_tbl')->where('enterprise_id', $enterprise_id)->get()->row();;
        $this->subscribersendemail($get_mail_config, $email);
            echo "success";
        }
    }

    public function subscribersendemail($get_mail_config, $email) {
       
        $config = Array(
            'protocol' => $get_mail_config->protocol, //'smtp',
            'smtp_host' => $get_mail_config->smtp_host, //'ssl://smtp.gmail.com',
            'smtp_port' => $get_mail_config->smtp_port, //465,
            'smtp_user' => $get_mail_config->smtp_user, //'', // change it to yours
            'smtp_pass' => $get_mail_config->smtp_pass, // '', // change it to yours
            'mailtype' => $get_mail_config->mailtype, //'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_crypto'=>'tls'
        );

        // $data['author_info'] = get_userinfo($log_id);
        $name = " Member ";
        
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user'], "Lead-academy Subscribed");
        $this->email->to($email);
        $this->email->subject("Lead-academy Subscribed");
        $this->email->message("Dear <strong>$name</strong> ,<br>You have subscribed successfully, " . "<br><br>"
                . "<br>" . "Please visit <a href='https://lead.academy/'> lead.academy</a>"
                . "<br> Thank You");
        $send_data = $this->email->send();
    }

    // alamin dev 28/8
    public function student_dashboard() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $user_id                = $this->session->userdata('user_id');
        $data['enterprise_id']  =$enterprise_id;

        $data['courses_overviews']=$this->Frontend_model->studentCourseOverview($user_id,$enterprise_id);
                        
        $data['save_courses']=$this->db->select('a.*,b.*,d.name as instructor_name,b.name as course_name,c.name as category_name,e.picture,f.name enterprise_name')
                           ->from('coursesave_tbl a')
                           ->join('course_tbl b','b.course_id=a.course_id')
                           ->join('category_tbl c','c.category_id=b.category_id')
                           ->join('faculty_tbl d','d.faculty_id=b.faculty_id')
                           ->join('picture_tbl e', 'e.from_id = a.course_id', 'left')
                           ->join('loginfo_tbl f', 'f.log_id = b.enterprise_id', 'left')
                           ->where('b.enterprise_id', $enterprise_id)
                           ->where('a.student_id',$user_id)
                           ->where('b.status',1)
                           ->get()->result();
                      
        $data['topic_of_tnterests']=$this->db->select('a.category_id,a.name category_name,b.picture')
        ->from('category_tbl a')
        ->join('picture_tbl b', 'b.from_id = a.category_id', 'left')
        ->where('a.enterprise_id', $enterprise_id)
        ->where('a.status',1)
        ->get()->result();

        $data['checksubscription_day_left']=$this->db->select('b.*,a.id as id,a.date,a.expeiredate,a.customer_id,a.invoice_id,a.subscription_id,b.duration')
        ->from('invoice_tbl a')
        ->join('subscription_tbl b','b.subscription_id=a.subscription_id','left')
        ->where('a.customer_id',$user_id)
        ->where('a.is_subscription',1)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.status',1)
        ->order_by('a.id','desc')
        ->get()->row();
        $data['get_offerscourses'] = $this->Frontend_model->get_offerscourses($enterprise_id);
        $data['upcoming_liveevents'] = $this->Frontend_model->upcoming_liveevents($enterprise_id);
        $data['get_followereinstructor'] = $this->Frontend_model->get_followereinstructor($user_id, $enterprise_id);        
        // $data['check_followinginstructor'] = $this->Frontend_model->check_followinginstructor($student_id, $faculty_id, $enterprise_id);
        
        // dd($topic_of_tnterests);
        // $months = '';
        // $salesamount = '';
        // $salesorder = '';
        // $year = date('Y');
        // $numbery = date('y');
        // $prevyear = $numbery - 1;
        // $prevyearformat = $year - 1;
        // $syear = '';
        // $syearformat = '';
        // for ($k = 1; $k < 13; $k++) {
        //     $month = date('m', strtotime("+$k month"));
        //     $gety = date('y', strtotime("+$k month"));
        //     if ($gety == $numbery) {
        //         $syear = $prevyear;
        //         $syearformat = $prevyearformat;
        //     } else {
        //         $syear = $numbery;
        //         $syearformat = $year;
        //     }

        //     $monthly = $this->monthlysaleamount($syearformat, $month, $this->user_id);

        //     $salesamount .= $monthly . ', ';

        //     $months .="'"."" . date('M-' . $syear, strtotime("+$k month")) ."'". ",";
        // }
        //  print_r($salesamount);

            $list  = '';
            $month = date('m');
            $year  = date('Y');

            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $month, $d, $year);          
                if (date('m', $time)==$month)       
                    $list.= "'"."" . date('Y-m-d', $time) ."'". ",";
            }
        $data['sutdent_chart'] = array(
             'time' =>  $this->monthlysaleamount($enterprise_id,$this->user_id),
            // 'totalFacultyearning' => $totalFacultyearning,
            // 'revenue' => $revenue,
            // 'lastYearMonthss' => trim($months, ', '),
            'dateName' => trim($list, ', '),
            // 'monthly_time_count' => $salesamount
        );
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_dashboard";
        echo Modules::run("template/frontend_studentlayout", $data);
    }
    // time spent dashboard
    public function get_time_spent_filter(){
        $type=$this->input->post('type');
        // if($type==1){
            $data['student_time_filter']=array(
                'user_id'=> $this->input->post('user_id'),
                'enterprise_id' => $this->input->post('enterprise_id'),
                'enterprise_shortname' => $this->input->post('enterprise_shortname'),
                'type' => $type,
            );
            $this->load->view('themes/default/students/timespent_chart_filter', $data);
        // }
    }
    // chart date wise data count 
    public function monthlysaleamount($enterprise_id,$user_id) {
        $list  = '';
        $month = date('m');
        $year  = date('Y');
        $totalTime=0;
        $return_time = '';
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                $date=date('Y-m-d', $time).',';

                $wherequery="YEAR(a.date)='$year' AND month(a.date)='$month' GROUP BY YEAR(a.date), MONTH(a.date)";
                $query=$this->db->select('sum(a.real_time) as todaywatchtime,b.name,count(b.course_id),c.name as instructor_name')
                            ->from('daily_watch_time_tbl a')
                            ->join('course_tbl  b', 'b.course_id = a.course_id', 'left')
                            ->join('faculty_tbl  c', 'c.faculty_id = b.faculty_id', 'left')
                             ->where('a.date',$date)
                            // ->where($wherequery, NULL, FALSE)
                            ->where('a.student_id',$user_id)
                            // ->group_by('a.course_id')
                            // ->order_by('a.course_id','DESC')
                            // ->limit('5')
                            ->get();
                            
                                $result = $query->row();
                                $totalTime +=($result?$result->todaywatchtime:0);
                            $return_time.= "'"."" . ($result?$result->todaywatchtime:0) ."'". ",";
        }
        

        return $return_time;
    }

    
    // student dashboard course overview  see all data method 
    public function courses_overviews(){
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $user_id                = $this->session->userdata('user_id');
        $data['enterprise_id']  =$enterprise_id;

        $this->load->library('pagination');

        #pagination starts
        $config["base_url"]       = base_url($this->enterprise_shortname.'/student-courses-overviews'); 
        $config["total_rows"]     = $this->db->select('customer_id')->from('invoice_details')->where('customer_id',$user_id)->group_by('product_id')->where('status',1)->get()->num_rows(); 
        $config["per_page"]       = 20;
        $config["uri_segment"]    = 3; 
        $config["num_links"]      = 5;  
        /* This Application Must Be Used With BootStrap 4 * */
        $config['full_tag_open']  = "<ul class='pagination mt-4'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open']   = '<li class="page-item">';
        $config['num_tag_close']  = '</li>';
        $config['cur_tag_open']   = "<li class='disabled page-item'><li class='page-item active'><a href='#' class='page-link'>";
        $config['cur_tag_close']  = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']  = "<li class='page-item'>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open']  = "<li class='page-item'>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li class='page-item'><a class='page-link'>";
        $config['first_tagl_close'] = "</a></li>";
        $config['attributes'] = array('class' => 'page-link');
        $config['last_tag_open']  = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>"; 
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['courses_overviews_see_more'] =$this->Frontend_model->CourseOverviewPagination($user_id,$enterprise_id,$config["per_page"], $page) ;     
        $data["links"] = $this->pagination->create_links();
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_dashboard_overview_seeall";
        echo Modules::run("template/frontend_studentlayout", $data);




    }

    public function student_progress_sort_filtering(){

        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id          = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $user_id                = $this->session->userdata('user_id');
        $data['enterprise_id']  =$enterprise_id;

        // $this->load->library('pagination');
          $data['enterprise_shortname']=$this->enterprise_shortname;
        // #pagination starts
        // $config["base_url"]       = base_url($this->enterprise_shortname.'/student-courses-overviews'); 
        // $config["total_rows"]     = $this->db->select('customer_id')->from('invoice_details')->where('customer_id',$user_id)->group_by('product_id')->where('status',1)->get()->num_rows(); 
        // $config["per_page"]       = 100;
        // $config["uri_segment"]    = 3; 
        // $config["num_links"]      = 5;  
        // /* This Application Must Be Used With BootStrap 4 * */
        // $config['full_tag_open']  = "<ul class='pagination mt-4'>";
        // $config['full_tag_close'] = "</ul>";
        // $config['num_tag_open']   = '<li class="page-item">';
        // $config['num_tag_close']  = '</li>';
        // $config['cur_tag_open']   = "<li class='disabled page-item'><li class='page-item active'><a href='#' class='page-link'>";
        // $config['cur_tag_close']  = "<span class='sr-only'></span></a></li>";
        // $config['next_tag_open']  = "<li class='page-item'>";
        // $config['next_tag_close'] = "</li>";
        // $config['prev_tag_open']  = "<li class='page-item'>";
        // $config['prev_tagl_close'] = "</li>";
        // $config['first_tag_open'] = "<li class='page-item'><a class='page-link'>";
        // $config['first_tagl_close'] = "</a></li>";
        // $config['attributes'] = array('class' => 'page-link');
        // $config['last_tag_open']  = "<li class='page-item'>";
        // $config['last_tagl_close'] = "</li>"; 
        // /* ends of bootstrap */
        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['courses_overviews'] =$this->Frontend_model->CourseOverviewPagination($user_id,$enterprise_id) ;    
        
        
        $data["links"] = $this->pagination->create_links();
        $this->load->view('frontend/themes/default/students/student_dashboard_progress_filtering', $data);

    }


    public function student_profile_dashboard() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_studentinfo'] = get_studentinfo($this->user_id);
        $data['get_studentproficiency'] = $this->Frontend_model->get_studentproficiency($this->user_id);
        $data['get_userexperience'] = $this->Frontend_model->get_userexperience($this->user_id);
        $data['get_usereducation'] = $this->Frontend_model->get_usereducation($this->user_id);
        $data['get_usermappingcertificate'] = $this->Frontend_model->get_usermappingcertificate($this->user_id);
        // dd($data['get_studentinfo']);
        $data['courses_complete_course']=$this->Frontend_model->studentCompleteCourseOverview($this->user_id,$enterprise_id);
        $data['get_featuredprojectportfolio'] = $this->Frontend_model->get_featuredprojectportfolio($enterprise_id, $this->user_id);
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_profile_dashboard";
        echo Modules::run("template/frontend_studentlayout", $data);
    }
    public function student_profile_show($student_id) {
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_studentinfo'] = get_studentinfo($student_id);
        $data['get_studentproficiency'] = $this->Frontend_model->get_studentproficiency($student_id);
        $data['get_userexperience'] = $this->Frontend_model->get_userexperience($student_id);
        $data['get_usereducation'] = $this->Frontend_model->get_usereducation($student_id);
        $data['get_usermappingcertificate'] = $this->Frontend_model->get_usermappingcertificate($student_id);
        $data['student_id'] = $student_id;
        $data['courses_complete_course']=$this->Frontend_model->studentCompleteCourseOverview($student_id, $enterprise_id);
        $data['get_featuredprojectportfolio'] = $this->Frontend_model->get_featuredprojectportfolio($enterprise_id, $student_id);
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_profile_show";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    public function download_certificate($id){
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $templatesInfo = $this->Frontend_model->templatesInfo($id);
        $name = $this->session->userdata('fullname');
        $email = $this->session->userdata('email');
       
        $data['template'] = $this->smsgateway->certificatetemplate([
            'name' => $name,
            'certificate_name' => $templatesInfo->title,
            'summary' => '', //$templatesInfo->summary,
            'date' => date('d F Y', strtotime($templatesInfo->created_date)),
            'message' => $templatesInfo->template_body,
        ]);
    //    dd($data['template']);


        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/download_certificate";
        echo Modules::run("template/frontend_studentlayout", $data);
    }
    public function certificateshow_update(){
          $user_id = $this->input->post('user_id', TRUE);
            $is_certificateshow = $this->input->post('is_certificateshow', TRUE);
            $logdata = array(
                'is_certificateshow' => $is_certificateshow,
            );
        $this->db->where('student_id', $user_id)->update('students_tbl', $logdata);
        echo "Update SuccessFully";
    }

    // =========== its for student_profile_picture_update ==================
    public function student_profile_picture_update(){
        $user_id = $this->user_id;
        $enterprise_id = $this->input->post('enterprise_id', TRUE);

        $image = $this->fileupload->do_upload(
            'assets/uploads/students/',
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
              'from_id' => $user_id,
              'picture' => $image,
              'picture_type' => 'Student Profile',
              'status' => 1,
              'created_by' => $enterprise_id,
              'created_date' => date('Y-m-d H:i:s'),
              'updated_by' => $enterprise_id,
              'updated_date' => date('Y-m-d H:i:s'),
          );
          if($checkprofilepic){
            $this->db->where('from_id', $user_id)->update('picture_tbl', $pictureInfo);
        }else{
            $this->db->insert('picture_tbl', $pictureInfo);
        }
          echo "Profile picture uploaded successfully!";
    }
    // =========== its for student_cover_picture_update ==================
    public function student_cover_picture_update(){
        $user_id = $this->user_id;
        $enterprise_id = $this->input->post('enterprise_id', TRUE);

        $image = $this->fileupload->do_upload(
            'assets/uploads/students/',
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
          $this->db->where('student_id', $user_id)->Update('students_tbl', $coverphotoinfo);
          echo "Cover photo uploaded successfully!";
    }

    public function student_profile_edit() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $user_id = $this->session->userdata('user_id');
        
        $data['get_studentinfo'] = get_studentinfo($user_id);
        $data['get_studentproficiency'] = $this->Frontend_model->get_studentproficiency($user_id);
        $data['get_userexperience'] = $this->Frontend_model->get_userexperience($user_id);
        $data['get_usereducation'] = $this->Frontend_model->get_usereducation($user_id);
        $data['get_usermappingcertificate'] = $this->Frontend_model->get_usermappingcertificate($this->user_id);
        $data['courses_complete_course'] = $this->Frontend_model->studentCompleteCourseOverview($user_id,$enterprise_id);
        $data['get_featuredproject'] = $this->Frontend_model->get_featuredproject($enterprise_id, $this->user_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_profile_edit";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    // ============= its for resume_upload ==============
    public function resume_upload(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_resumeshow = $this->input->post('is_resumeshow', TRUE);
        // dd($is_resumeshow);
        //apps_logo upload
        $resume = $this->fileupload->do_resumeupload(
            'assets/uploads/students/', 'resume','gif|jpg|png|jpeg|ico|pdf'
        );
        $resumedata = array(
            'is_resumeshow' => $is_resumeshow,
            'resume'        => (!empty($resume) ? $resume : $this->input->post('old_resume', true)),
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $resumedata);
        echo 'Resume updated successfully!';
    }

    
    public function fileupload_progressbar_check(){
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

    public function student_fileupload_progressbar_check(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_resumeshow = $this->input->post('is_resumeshow', TRUE);
       
        //apps_logo upload
        $resume = $this->fileupload->do_resumeupload(
            'assets/uploads/students/', 'resume','gif|jpg|png|jpeg|ico|pdf'
        );
        $resumedata = array(
            'is_resumeshow' => $is_resumeshow,
            'resume'        => (!empty($resume) ? $resume : $this->input->post('old_resume', true)),
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $resumedata);
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

    // ============= its for resume_upload_delete ==============
    public function resume_upload_delete(){
        $user_id = $this->input->post('user_id', TRUE);
        $picture_unlink = $this->db->select('*')->from('students_tbl')->where('student_id',$user_id)->get()->row();
       if (@$picture_unlink->resume) {
           $img_path = $picture_unlink->resume;
           unlink($img_path);
       }
       $resumedata = array(
         'resume'        => '',
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $resumedata);
        echo 'Resume deleted successfully!';
    }

    // ================== its for profile_update ===============
    public function profile_update(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_profileshow = $this->input->post('is_profileshow', TRUE);
        $studentName = $this->input->post('studentName', TRUE);
        $designation = $this->input->post('designation', TRUE);
        $website = $this->input->post('website', TRUE);

        $logdata = array(
            'name' => $studentName,
        );
        $this->db->where('log_id', $user_id)->update('loginfo_tbl', $logdata);

        $profiledata = array(
            'is_profileshow'    => $is_profileshow,
            'name'              => $studentName,
            'designation'       => $designation,
            'website'           => $website,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $profiledata);
        echo 'Profile updated successfully!';
    }


    // ============== its for biography_update =============
    public function biography_update(){

         $user_id = $this->input->post('user_id', TRUE);
         $is_biographyshow = $this->input->post('is_biographyshow', TRUE);

         $biography = $this->input->post('notes', TRUE);
            $biographydata = array(
                'is_biographyshow'    => $is_biographyshow,
                'biography'              => $biography,
            );
        $this->db->where('student_id', $user_id)->update('students_tbl', $biographydata);
        echo 'Biography updated successfully!';
    }

    // ============= its for skills_update =============
    public function skills_update(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_skillshow = $this->input->post('is_skillshow', TRUE);
        $skillsSelect = $this->input->post('skillsSelect', TRUE);
        
        $skilksdata = array(
            'is_skillshow' => $is_skillshow,
            'skills' => $skillsSelect,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $skilksdata);
        echo 'Skills updated successfully!';
    }

    
//    ============= its for autocomplete_proficiency_search =========
public function autocomplete_proficiency_search() {
    $query = $this->input->post('query', TRUE);
    $enterprise_id = $this->input->post('enterprise_id', TRUE);
    $results = $this->db->select('a.*')->from('proficiency_tbl a')->like('a.title', $query)->where('status', '1')->where('enterprise_id', $enterprise_id)->limit(100)->get()->result();
    echo json_encode($results);
}
// ===========its for proficiency_update ==============
public function proficiency_update(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_proficiencyshow = $this->input->post('is_proficiencyshow', TRUE);
        $proficiency = $this->input->post('proficiencySelect', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', true);
        // dd($enterprise_id);
        
        $proficiencydata = array(
            'is_proficiencyshow' => $is_proficiencyshow,
        );
        
        $this->db->where('student_id', $user_id)->update('students_tbl', $proficiencydata);
       
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

    // ============= its for student_proficiency_delete ==============
    public function student_proficiency_delete(){
        $id = $this->input->post('id', TRUE);
        if($id){
            $this->db->where('id', $id)->delete('user_proficiency_tbl');
            echo 'Deleted successfully!';
        }
    }

        // ===========its for student_featureshow_update ==============
        public function student_featureshow_update(){
            $user_id    = $this->input->post('user_id', TRUE);
            $is_featureshow = $this->input->post('is_featureshow', TRUE);
            $enterprise_id = $this->input->post('enterprise_id', true);
           
            
            $featuredata = array(
                'is_featureshow' => $is_featureshow,
            );
            $this->db->where('student_id', $user_id)->update('students_tbl', $featuredata);    
    
            echo 'Updated successfully!';
    }

    // ============= its for experience_save ===============
    public function experience_save(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id = $this->session->userdata('user_id');
        $is_experienceshow = $this->input->post('is_experienceshow', TRUE);
        $is_experienceshow = (($is_experienceshow) ? '1' : '0');
        $companyname = $this->input->post('companyname', TRUE);
        $cityname = $this->input->post('cityname', TRUE);
        $title = $this->input->post('title', TRUE);
        $country = $this->input->post('country', TRUE);
        $frommonth = $this->input->post('frommonth', TRUE);
        $fromyear = $this->input->post('fromyear', TRUE);
        $tomonth = $this->input->post('tomonth', TRUE);
        $toyear = $this->input->post('toyear', TRUE);
        // $nowworking = $this->input->post('nowworking', TRUE);
        $hdn_nowworking = $this->input->post('hdn_nowworking', TRUE);
        // d($frommonth);
        // d($fromyear);
        // d($tomonth);
        //  dd($toyear);
        
        $studentdata = array(
            'is_experienceshow' => $is_experienceshow,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $studentdata);

        for ($i = 0, $j = 1; $i < count($companyname); $i++, $j++) {
            // $question_id = "QST" . date('d') . $this->generators->generator(5);

            $experiencedata = array(
                'user_id' => $user_id,
                'companyname' => $companyname[$i],
                'title' => $title[$i],
                'city' => $cityname[$i],
                'country' => $country[$i],
                'frommonth' => $frommonth[$i],
                'fromyear' => $fromyear[$i],
                'tomonth' => $tomonth[$i],
                'toyear' => $toyear[$i],
                'is_now' => (($hdn_nowworking[$i] == '') ? 0 : $hdn_nowworking[$i]),
                'status' => 1,
                'enterprise_id' => $enterprise_id,
                'created_by' => $this->user_id,
                'created_date' => date('Y-m-d H:i:s'),
            );

            if(!empty($companyname[$i])){
                $this->db->insert('experience_tbl', $experiencedata);
            }
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'>Experience added successfully!</div>");
        redirect($this->enterprise_shortname . '/student-profile-edit');
    }

    // ============= its for experience_edit =============
    public function experience_edit(){
        $id = $this->input->post('id', TRUE);
        $data['get_experienceedit'] = $this->Frontend_model->get_experienceedit($id);

        $this->load->view('frontend/themes/default/students/experience_edit', $data);
    }
   

    // ============== its for experience_update =================== 
    public function experience_update(){
        $id = $this->input->post('id', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $companyname = $this->input->post('companyname', TRUE);
        $title = $this->input->post('title', TRUE);
        $city = $this->input->post('city', TRUE);
        $country = $this->input->post('country', TRUE);
        $frommonth = $this->input->post('frommonth', TRUE);
        $fromyear = $this->input->post('fromyear', TRUE);
        $tomonth = $this->input->post('tomonth', TRUE);
        $toyear = $this->input->post('toyear', TRUE);
        $is_now = $this->input->post('is_now', TRUE);

        $experiencedata = array(
            'companyname' => $companyname,
            'title' => $title,
            'city' => $city,
            'country' => $country,
            'frommonth' => $frommonth,
            'fromyear' => $fromyear,
            'tomonth' => (($is_now != 1) ? $tomonth : ''),
            'toyear' => (($is_now != 1) ? $toyear : ''),
            'is_now' => $is_now,
            'updated_by' => $this->user_id,
            'updated_date' => date('Y-m-d H:i:s'),
        );

        // d($questiondata);
        $this->db->where('id', $id)->update('experience_tbl', $experiencedata);
        echo 'Updated successfully!';
    }
    
    // ============= its for student_proficiency_delete ==============
    public function student_experience_delete(){
        $id = $this->input->post('id', TRUE);
        if($id){
            $this->db->where('id', $id)->delete('experience_tbl');
            echo 'Deleted successfully!';
        }
    }

    // ================= its for education_save ===============
    public function education_save(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id = $this->session->userdata('user_id');
        $is_educationshow = $this->input->post('is_educationshow', TRUE);
        $is_educationshow = (($is_educationshow) ? '1' : '0');

        $institutename = $this->input->post('institutename', TRUE);
        $degreename = $this->input->post('degreename', TRUE);
        $passing_year = $this->input->post('passing_year', TRUE);

        
        $studentdata = array(
            'is_educationshow' => $is_educationshow,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $studentdata);

        for ($i = 0, $j = 1; $i < count($institutename); $i++, $j++) {

            $educationdata = array(
                'log_id' => $user_id,
                'institutename' => $institutename[$i],
                'degree' => $degreename[$i],
                'passing_year' => $passing_year[$i],
                'enterprise_id' => $enterprise_id,
                'created_by' => $this->user_id,
                'created_date' => date('Y-m-d H:i:s'),
            );
            if(!empty($institutename[$i])){
            $this->db->insert('education_tbl', $educationdata);
            }
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'>Education added successfully!</div>");
        redirect($this->enterprise_shortname . '/student-profile-edit');
    }

     // ============= its for education_edit =============
     public function education_edit(){
        $id = $this->input->post('id', TRUE);
        $data['get_educationedit'] = $this->Frontend_model->get_educationedit($id);

        $this->load->view('frontend/themes/default/students/education_edit', $data);
    }

    // ================= its for education_update =================
    public function education_update(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id = $this->session->userdata('user_id');
        $id = $this->input->post('id', TRUE);
        // $is_educationshow = $this->input->post('is_educationshow', TRUE);
        // $is_educationshow = (($is_educationshow) ? '1' : '0');

        $institutename = $this->input->post('institutename', TRUE);
        $degree = $this->input->post('degree', TRUE);
        $passing_year = $this->input->post('passing_year', TRUE);

        
        // $studentdata = array(
        //     'is_educationshow' => $is_educationshow,
        // );
        // $this->db->where('student_id', $user_id)->update('students_tbl', $studentdata);

        

            $educationdata = array(
                'institutename' => $institutename,
                'degree' => $degree,
                'passing_year' => $passing_year,
                'updated_by' => $this->user_id,
                'updated_date' => date('Y-m-d H:i:s'),
            );
            // dd($educationdata);
            $this->db->where('id', $id)->update('education_tbl', $educationdata);
        
        echo 'Updated successfully!';
        // $this->session->set_flashdata('success', "<div class='alert alert-success'>Education added successfully!</div>");
        // redirect($this->enterprise_shortname . '/student-profile-edit');
    }

    // ============= its for student_education_delete ==============
    public function student_education_delete(){
        $id = $this->input->post('id', TRUE);
        if($id){
            $this->db->where('id', $id)->delete('education_tbl');
            echo 'Deleted successfully!';
        }
    }
    // ================= its for hiringinfo_update ==============
    public function hiringinfo_update(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_hiringshow = $this->input->post('is_hiringshow', TRUE);
        $hiringtitle = $this->input->post('hiringtitle', TRUE);
        $hiringtype = $this->input->post('hiringtype', TRUE);

        $hiringdata = array(
            'is_hiringshow' => $is_hiringshow,
            'hiring_title' => $hiringtitle,
            'hiring_type' => $hiringtype,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $hiringdata);
        echo 'Hiring info updated successfully!';
    }
    // ================= its for contact_update ==============
    public function contact_update(){
        $user_id = $this->input->post('user_id', TRUE);
        $is_contactshow = $this->input->post('is_contactshow', TRUE);
        $is_contacttitle = $this->input->post('is_contacttitle', TRUE);
        $contacttitle = $this->input->post('contacttitle', TRUE);
        $public_email = $this->input->post('public_email', TRUE);
        

        $hiringdata = array(
            'is_contactshow' => $is_contactshow,
            'is_contacttitle' => $is_contacttitle,
            'contacttitle' => $contacttitle,
            'public_email' => $public_email,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $hiringdata);
        echo 'Contact info updated successfully!';
    }

    public function getvideoiframe_load(){
        $link = $this->input->post('link');
        // $pieces = explode("/",$link);
        // if(@$pieces[2] =='www.youtube.com'){
        //     $youtubeid =  youtube_id($link);
        //     echo '<iframe width="100%" class="me-3" height="400" src="https://www.youtube.com/embed/'.$youtubeid.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        // }
        // // echo youtube_thumbs($youtubeid);
        

     
        if(videoType($link) == 'vimeo'){
          $vimeo_id = vimeo_id($link);
            echo '<iframe id="player1" src="https://player.vimeo.com/video/'.$vimeo_id.'" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }elseif(videoType($link) == 'youtube'){ 
            $youtubeid =  youtube_id($link);
            echo '<iframe width="100%" class="me-3" height="400" src="https://www.youtube.com/embed/'.$youtubeid.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }else{
           echo 1;
        }
   



    }

    public function student_project_add() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        // $data['get_courses'] = $this->Frontend_model->get_courses($enterprise_id);
        $data['get_courses'] = $this->Frontend_model->mycourse($this->user_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_project_add";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    public function get_coursepicture(){
        $course_id = $this->input->post('course_id');
        $thumbnail = base_url(get_picturebyid($course_id)->picture);
        echo '<img src="'.$thumbnail.'" class="img-fluid">';
    }
    //    ============ its for get_sectionbycourse ==========
   public function get_sectionbycourse() {
    $course_id = $this->input->post('course_id', TRUE);
    $enterprise_id = $this->input->post('enterprise_id', TRUE);
    $get_sectionbycourse = $this->Frontend_model->get_sectionbycourse($course_id, $enterprise_id);

    echo "<option value=''>-- select one --</option>";
    foreach ($get_sectionbycourse as $value) {
        echo "<option value='$value->section_id'>$value->section_name</option>";
        }
    }
    //    ============ its for get-assignmentchapterbycourse ==========
   public function get_assignmentchapterbycourse() {
    $course_id = $this->input->post('course_id', TRUE);
    $enterprise_id = $this->input->post('enterprise_id', TRUE);
    $get_sectionbycourse = $this->Frontend_model->get_assignmentchapterbycourse($course_id, $enterprise_id);

    echo "<select class='input-box px-2' aria-label='Default select example'
    id='section_id' name='section_id' onchange='get_assignmentbychapter(this.value)'>";
    echo "<option value=''>-- select one --</option>";
    foreach ($get_sectionbycourse as $value) {
        echo "<option value='$value->section_id'>$value->section_name</option>";
        }
    echo "</select>";
    // echo "<option value=''>-- select one --</option>";
    // foreach ($get_sectionbycourse as $value) {
    //     echo "<option value='$value->section_id'>$value->section_name</option>";
    //     }
    }

    public function get_assignmentcheckbycourse(){
        $assignment_id = $this->input->post('assignment_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $this->db->select('*');
        $this->db->from('project_tbl a');
        $this->db->where('a.assignment_id', $assignment_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get()->num_rows();
        // echo $query. ' ';
        if($query >= 1){
            echo 1;
        }else{
            echo 0;
        }
    }

    //    ============ its for get_assignmentbychapter ==========
   public function get_assignmentbychapter() {
    $course_id = $this->input->post('course_id', TRUE);
    $chapter_id = $this->input->post('chapter_id', TRUE);
    $category = $this->input->post('category', TRUE);
    $enterprise_id = $this->input->post('enterprise_id', TRUE);
    $get_assignmentbychapter = $this->Frontend_model->get_assignmentbychapter($chapter_id, $category, $course_id, $enterprise_id);

    echo "<option value=''>-- select one --</option>";
    foreach ($get_assignmentbychapter as $value) {
        echo "<option value='$value->assignment_id'>$value->title</option>";
        }
    }
    //    ============ its for get_lessonbycourse ==========
   public function get_lessonbycoursesection() {
    $course_id = $this->input->post('course_id', TRUE);
    $section_id = $this->input->post('section_id', TRUE);
    $enterprise_id = $this->input->post('enterprise_id', TRUE);
    $get_lessonbycoursesection = $this->Frontend_model->get_lessonbycoursesection($course_id, $section_id, $enterprise_id);
    
    echo "<option value=''>-- select one --</option>";
    foreach ($get_lessonbycoursesection as $value) {
        echo "<option value='$value->lesson_id'>$value->lesson_name</option>";
        }
    }
    // ================= its for student_project_save ===================
    public function student_project_save(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $project_id = time();
        $assignment_id = $this->input->post('assignment_id', True);
        $user_id = $this->user_id;
        $title = $this->input->post('title', TRUE);
        $projecttype = $this->input->post('projecttype', TRUE);
        // $publish_status = $this->input->post('publish_status', TRUE);
        // $visibilityonportfolio = $this->input->post('visibilityonportfolio', TRUE);
        $projectsave = $this->input->post('projectsave');
        $projectpublish = $this->input->post('projectpublish');
        $projectsubmit = $this->input->post('projectsubmit');
        if($projectsave == 'Save Draft'){
            $publish_status = 0;
            $is_visibility = 0;
            $project_status = 4; // 4=not submit for instructor review 
            $submit_status = 0;
        }
        if($projectpublish == 'Publish'){
            $publish_status = 1;
            $is_visibility = 1;
            $project_status = 4; // 4=not submit for instructor review 
            $submit_status = 0;
        }
        if($projectsubmit == 'Submit Course Project for Instructor Review'){
            $project_status = 0;
            $publish_status = 1;
            $is_visibility = 0;
            $submit_status = 1;
        }
           
        // $visibilityonportfolio = (!empty($visibilityonportfolio) ? $visibilityonportfolio : 0);
        $publishdate = $this->input->post('publishdate', TRUE);
        $publishdate = date('Y-m-d', strtotime($publishdate));
        $skills = $this->input->post('skills', TRUE);
        $software_used = $this->input->post('software_used', TRUE);
        $tags = $this->input->post('tags', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $section_id = $this->input->post('section_id', TRUE);
        $lesson_id = $this->input->post('lesson_id', TRUE);
        $client_name = $this->input->post('client_name', TRUE);
        $clientproject_year = $this->input->post('clientproject_year', TRUE);
        $clientwebsite_url = $this->input->post('clientwebsite_url', TRUE);
        $project_topic = $this->input->post('project_topic', TRUE);
        $personal_projectyear = $this->input->post('personal_projectyear', TRUE);
        $personal_websiteurl = $this->input->post('personal_websiteurl', TRUE);
        $coursetype = $this->input->post('coursetype', TRUE);
        // dd($visibilityonportfolio);
        $coverpic = $this->fileupload->do_upload(
            'assets/uploads/projects/', 'coverpic', 'gif|jpg|png|jpeg|svg'
        );

           // if logo is uploaded then resize the logo
           if ($coverpic !== false && $coverpic != null) {
                    $this->fileupload->do_resize(
                            $coverpic, 280, 192
                    );
                }
        
        $content_sl = $this->input->post('content_sl', TRUE);
        $contentimg_sl = $this->input->post('contentimg_sl', TRUE);
        $contentvideo_sl = $this->input->post('contentvideo_sl', TRUE);
        $content = $this->input->post('content', TRUE);
        $content_img = (@$_FILES['content_img']?@$_FILES['content_img']['name']:'noimg');
        $content_video = $this->input->post('content_video', TRUE);
        $content_file = $this->input->post('content_file', TRUE);
        
// ============ its for multiple content ==================
        if($content){
            for($i=0; $i<count($content); $i++){
                $contents = $content[$i];
                $contentdata = array(
                    'project_id' => $project_id,
                    'type' => 1, // content text
                    'content_sl' => $content_sl[$i],
                    'value' => $contents,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
        
        // ================== its for multiple content image =============
        if($content_img != 'noimg'){          
        $filesCount = count($_FILES['content_img']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['pictures']['name'] = $_FILES['content_img']['name'][$i];
            $_FILES['pictures']['type'] = $_FILES['content_img']['type'][$i];
            $_FILES['pictures']['tmp_name'] = $_FILES['content_img']['tmp_name'][$i];
            $_FILES['pictures']['error'] = $_FILES['content_img']['error'][$i];
            $_FILES['pictures']['size'] = $_FILES['content_img']['size'][$i];

            // configure for upload 
            $config = array(
                'upload_path' => "assets/uploads/projects/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'encrypt_name' => TRUE,
                'max_size' => '0',
            );
            $image_data = array();

// autoload the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('pictures')) {
                $image_data = $this->upload->data();
                $image_name = 'assets/uploads/projects/' . $image_data['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path']; //get original image
                $config['maintain_ratio'] = TRUE;
                $config['height'] = 656;
                $config['width'] = 1050;
//                $config['quality'] = 50;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->translate_errors();
                }

                $productpictureinfo[$i]['project_id'] = $project_id;
                $productpictureinfo[$i]['value'] = $image_name;
                $productpictureinfo[$i]['type'] = '2'; // content image or file
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
                    'type' => 3, // content video link
                    'content_sl' => $contentvideo_sl[$i],
                    'value' => $contentvideo,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
       

        // $projectsave = $this->input->post('projectsave', TRUE);
        // $projectpublish = $this->input->post('projectpublish', TRUE);

        $projectdata = array(
            'project_id' => $project_id,
            'assignment_id' => $assignment_id,
            'user_id' => $user_id,
            'title' => $title,
            'project_type' => $projecttype,
            'publishdate' => $publishdate, 
            'skills' => $skills,
            'software_used' => $software_used,
            'tags' => $tags,
            'is_visibility' => $is_visibility,
            'publish_status' => $publish_status, 
            'project_status' => $project_status, 
            'submit_status' => $submit_status, 
            'course_id' => $course_id,
            'section_id' => $section_id,
            'lesson_id' => $lesson_id,
            'enterprise_id' => $enterprise_id,
            'coverpic' => $coverpic,
            'coursetype' => $coursetype,
            'client_name' => $client_name,
            'clientproject_year' => $clientproject_year,
            'clientwebsite_url' => $clientwebsite_url,
            'project_topic' => $project_topic,
            'personal_projectyear' => $personal_projectyear,
            'personal_websiteurl' => $personal_websiteurl,
            'type' => 1, // for student
            'chapter_source' => '',
            'lesson_source' => '',
            'created_by' => $this->user_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        // dd($projectdata);
        $this->db->insert('project_tbl', $projectdata);
        $this->session->set_flashdata('success', "<div class='alert alert-success'>Project added successfully!</div>");
        redirect($this->enterprise_shortname . '/student-add-project');
    }


    public function student_project_edit($project_id) {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_projecteditdata'] = $this->Frontend_model->get_projecteditdata($project_id);
        $data['get_projectdetails'] = $this->Frontend_model->get_projectdetails($project_id);
        // $data['get_courses'] = $this->Frontend_model->get_courses($enterprise_id);
        $data['get_courses'] = $this->Frontend_model->mycourse($this->user_id);
        $course_id = $data['get_projecteditdata']->course_id;
        $section_id = $data['get_projecteditdata']->section_id;
        $lesson_id = $data['get_projecteditdata']->lesson_id;

        $data['get_sectionbycourse'] = $this->Frontend_model->get_assignmentchapterbycourse($course_id, $enterprise_id);
        $data['get_lessonbycoursesection'] = $this->Frontend_model->get_lessonbycoursesection($course_id, $section_id, $enterprise_id);
        $data['get_projectdetailsmax_sl'] = $this->Frontend_model->get_projectdetailsmax_sl($project_id);
        $category = $data['get_projecteditdata']->coursetype;
        $data['assignmentid'] = $data['get_projecteditdata']->assignment_id;

        // if($category == 1){
            $data['get_assignmentbychapter'] = $this->Frontend_model->get_assignmentbychapter($section_id, $category, $course_id, $enterprise_id);
        // }elseif($category == 2){
        //     $get_assignmentbychapter = $this->Frontend_model->get_assignmentbychapter($section_id, $category, $course_id, $enterprise_id);
        // }
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_project_edit";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    public function student_project_update(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $project_id = $this->input->post('project_id', TRUE);        
        $assignment_id = $this->input->post('assignment_id', True);
        $user_id = $this->user_id;
        $title = $this->input->post('title', TRUE);
        $projecttype = $this->input->post('projecttype', TRUE);
        // $publish_status = $this->input->post('publish_status', TRUE);
        // $visibilityonportfolio = $this->input->post('visibilityonportfolio', TRUE);
        // $visibilityonportfolio = (!empty($visibilityonportfolio) ? $visibilityonportfolio : 0);

        $projectsave = $this->input->post('projectsave');
        $projectpublish = $this->input->post('projectpublish');
        $resubmit = $this->input->post('projectsubmit');
        // dd($resubmit);

        if($projectsave == 'Save Draft'){
            $publish_status = 0;
            $is_visibility = 0;
            $project_status = 4; // 4=not submit for instructor review 
            $submit_status = 0;
        }
        if($projectpublish == 'Publish'){
            $publish_status = 1;
            $is_visibility = 1;
            $project_status = 4; // 4=not submit for instructor review 
            $submit_status = 0;
        }
        if($resubmit == 'Update & Resubmit'){
            $project_status = 0;
            $publish_status = 1;
            $is_visibility = 0;
            $submit_status = 1;
        }
        // dd($submit_status);
        $publishdate = $this->input->post('publishdate', TRUE);
        $publishdate = date('Y-m-d', strtotime($publishdate));
        $skills = $this->input->post('skills', TRUE);
        $software_used = $this->input->post('software_used', TRUE);
        $tags = $this->input->post('tags', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $section_id = $this->input->post('section_id', TRUE);
        $lesson_id = $this->input->post('lesson_id', TRUE);
        $coursetype = $this->input->post('coursetype', TRUE);
        $client_name = $this->input->post('client_name', TRUE);
        $clientproject_year = $this->input->post('clientproject_year', TRUE);
        $clientwebsite_url = $this->input->post('clientwebsite_url', TRUE);
        $project_topic = $this->input->post('project_topic', TRUE);
        $personal_projectyear = $this->input->post('personal_projectyear', TRUE);
        $personal_websiteurl = $this->input->post('personal_websiteurl', TRUE);
        // $getfeatured = $this->input->post('getfeatured', TRUE);
        // $getfeatured = (!empty($getfeatured) ? $getfeatured : 0);
               
        // $coverpic = $this->fileupload->do_upload(
        //     'assets/uploads/projects/', 'coverpic', 'gif|jpg|png|jpeg'
        // );
        $old_coverpic = $this->input->post('old_coverpic', True);
        $coverpic = $this->fileupload->update_doupload(
                $project_id, 'assets/uploads/projects/', 'coverpic', 'gif|jpg|png|jpeg|pdf'
        );

             // if logo is uploaded then resize the logo
             if ($coverpic !== false && $coverpic != null) {
                $this->fileupload->do_resize(
                        $coverpic, 280, 192
                );
            }
        
        $content_sl = $this->input->post('content_sl', TRUE);
        $contentimg_sl = $this->input->post('contentimg_sl', TRUE);
        $contentvideo_sl = $this->input->post('contentvideo_sl', TRUE);
        $content = $this->input->post('content', TRUE);
        $content_img = (@$_FILES['content_img']?@$_FILES['content_img']['name']:'noimg');
        $content_video = $this->input->post('content_video', TRUE);
        $content_file = $this->input->post('content_file', TRUE);
        // echo 's';
        // dd($_FILES['content_img']['name']);
// ============ its for multiple content ==================
        if($content){
            for($i=0; $i<count($content); $i++){
                $contents = $content[$i];
                $contentdata = array(
                    'project_id' => $project_id,
                    'type' => 1, // content text
                    'content_sl' => $content_sl[$i],
                    'value' => $contents,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
        
        // ================== its for multiple content image =============
         if($content_img != 'noimg'){            
        $filesCount = count($_FILES['content_img']['name']);
        // d('d');
        // dd($filesCount);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['pictures']['name'] = $_FILES['content_img']['name'][$i];
            $_FILES['pictures']['type'] = $_FILES['content_img']['type'][$i];
            $_FILES['pictures']['tmp_name'] = $_FILES['content_img']['tmp_name'][$i];
            $_FILES['pictures']['error'] = $_FILES['content_img']['error'][$i];
            $_FILES['pictures']['size'] = $_FILES['content_img']['size'][$i];

            // configure for upload 
            $config = array(
                'upload_path' => "assets/uploads/projects/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'encrypt_name' => TRUE,
                'max_size' => '0',
            );
            $image_data = array();

// autoload the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('pictures')) {
                $image_data = $this->upload->data();
                $image_name = 'assets/uploads/projects/' . $image_data['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path']; //get original image
                // $config['maintain_ratio'] = TRUE;
                $config['height'] = 656; //763;
                $config['width'] = 1050; //470;
//                $config['quality'] = 50;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->translate_errors();
                }

                $productpictureinfo[$i]['project_id'] = $project_id;
                $productpictureinfo[$i]['value'] = $image_name;
                $productpictureinfo[$i]['type'] = '2'; // content image or file
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
                    'type' => 3, // content video link
                    'content_sl' => $contentvideo_sl[$i],
                    'value' => $contentvideo,
                );
                $this->db->insert('project_details_tbl', $contentdata);
            }
        }
        // =============== close ===================
       

        // $projectsave = $this->input->post('projectsave', TRUE);
        // $projectpublish = $this->input->post('projectpublish', TRUE);

        $projectdata = array(
            'assignment_id' => $assignment_id,
            'user_id' => $user_id,
            'title' => $title,
            'project_type' => $projecttype,
            'publishdate' => $publishdate, 
            'skills' => $skills,
            'software_used' => $software_used,
            'tags' => $tags,
            'is_visibility' => $is_visibility,
            'publish_status' => $publish_status, 
            'project_status' => $project_status,
            'submit_status' => $submit_status,
            'course_id' => $course_id,
            'section_id' => $section_id,
            'lesson_id' => $lesson_id,
            'enterprise_id' => $enterprise_id,
            'coverpic' => (!empty($coverpic) ? $coverpic : $old_coverpic), //$coverpic,
            'coursetype' => $coursetype,
            'client_name' => $client_name,
            'clientproject_year' => $clientproject_year,
            'clientwebsite_url' => $clientwebsite_url,
            'project_topic' => $project_topic,
            'personal_projectyear' => $personal_projectyear,
            'personal_websiteurl' => $personal_websiteurl,
            // 'getfeatured' => $getfeatured,
            'type' => 1, // for student
            'updated_by' => $this->user_id,
            'updated_date' => date('Y-m-d H:i:s'),
        );
        // dd($projectdata);
        $this->db->where('project_id', $project_id)->update('project_tbl', $projectdata);
        $this->session->set_flashdata('success', "<div class='alert alert-success'>Project updated successfully!</div>");
        redirect($this->enterprise_shortname . '/student-profile-edit');
    }

    public function project_details_delete(){
        $id = $this->input->post('id', TRUE);
        $singledata = $this->db->select('*')->from('project_details_tbl')->where('id', $id)->get()->row();
        if($id){
            if($singledata->type == 2){
                $img_path = FCPATH . $singledata->value;
                unlink($img_path);
            }
            $this->db->where('id', $id)->delete('project_details_tbl');
            echo 'Deleted successfully!';
        }
    }

    // ================ its for type_wise_project_load ==============
    public function type_wise_project_load(){
        $type = $this->input->post('type', True);
        $data['type'] = $this->input->post('type', True);
        $mode = $this->input->post('mode', True);
        $data['mode'] = $mode;
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', TRUE);
        $data['get_typewisproject'] = $this->Frontend_model->get_typewisproject($type, $enterprise_id, $this->user_id, $mode);

        $this->load->view('frontend/themes/default/students/get_typewisproject', $data);
    }

    // ================ its for type_wise_project_load ==============
    public function type_wise_project_load_public(){
        $student_id = $this->input->post('student_id', True);
        $type = $this->input->post('type', True);
        $mode = $this->input->post('mode', True);
        $data['mode'] = $mode;
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', TRUE);
        $data['get_typewisproject'] = $this->Frontend_model->get_typewisproject($type, $enterprise_id, $student_id, $mode);

        $this->load->view('frontend/themes/default/students/get_typewisproject', $data);
    }
    // =========== its for student_project_delete ===============
    public function student_project_delete(){
        $project_id = $this->input->post('project_id', TRUE);
        $singledata = $this->db->select('*')->from('project_tbl')->where('project_id', $project_id)->get()->row();
        if($project_id){
            // if($singledata->coverpic){
            if ($project_id && (!empty($singledata->coverpic))) {
                $img_path = FCPATH . $singledata->coverpic;
                unlink($img_path);
            }
            $this->db->where('project_id', $project_id)->delete('project_tbl');
            echo 'Deleted successfully!';
        }
    }
    // ============ its for student_project_view =================
    public function student_project_view($project_id){
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
       
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_projectsingledata'] = $this->Frontend_model->get_projectsingledata($project_id);
        $data['get_singleprojectdetails'] = $this->Frontend_model->get_singleprojectdetails($project_id);
        // dd($data['get_projectsingledata']);
        $data['get_studentinfo'] = get_studentinfo($data['get_projectsingledata']->created_by);
        $data['get_likeunlikestatus'] = $this->Frontend_model->get_likeunlikestatus($project_id, $this->user_id, $enterprise_id);
        $totalrow=$this->db->select('viewcount')
        ->from('project_tbl')
        ->where('project_id', $project_id)       
        ->get()->row();
        
       $viewcount = $totalrow->viewcount+1;
        // $viewcount = $data['get_projectsingledata']->viewcount;
        // d($viewcount);
        $viewcountdata = array(
            'viewcount' => $viewcount,
        );
        // print_r($viewcountdata);
        $this->db->where('project_id', $project_id)->update('project_tbl', $viewcountdata);
  
        // d($viewcountdata);

        $data['projectlikecount'] = get_projectlikecount($project_id, $enterprise_id);
        $data['projectcommentcount'] = get_projectcommentcount($project_id, $enterprise_id);
        $data['projectviewcount'] = get_projectviewcount($project_id, $enterprise_id);
                        // print_r($data['projectviewcount']);die();
        // dd($data['projectviewcount']->viewcount);
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_project_view";
      
        if($this->session->userdata('user_type') == 5){
            echo Modules::run("frontend/InstructorLayout/layout", $data);
           }elseif($this->session->userdata('user_type') == 4){
            echo Modules::run("template/frontend_studentlayout", $data);
           }
           
    }

    // ============ its for student_project_publicview =================
    public function student_project_publicview($project_id){
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_projectsingledata'] = $this->Frontend_model->get_projectsingledata($project_id);
        $data['get_singleprojectdetails'] = $this->Frontend_model->get_singleprojectdetails($project_id);
        // dd($data['get_projectsingledata']);
        $data['get_studentinfo'] = get_studentinfo($data['get_projectsingledata']->created_by);
        
        $data['student_id'] = $data['get_studentinfo']->student_id;
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_project_view";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    public function comment_save(){
        $comment_id = "C" . date('d') . $this->generators->generator(5);
        $user_id = $this->input->post('user_id', true);
        $enterprise_id = $this->input->post('enterprise_id', true);
        $project_id = $this->input->post('project_id', true);
        $comments = $this->input->post('comments', true);
        $user_type = $this->input->post('user_type', true);
        $enterprise_id = $this->input->post('enterprise_id', true);

        $commentsdata = array(
            'comment_id' => $comment_id,
            'user_id' => $user_id,
            'enterprise_id' => $enterprise_id,
            'project_id' => $project_id,
            'comments' => $comments,
            'user_type' => $user_type,
            'status' => 1,
            'enterprise_id' => $enterprise_id,
            'created_by' => $enterprise_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        // d($commentsdata);
        $this->db->insert('comments_tbl', $commentsdata);
        echo "submit successfully!";
    }

    public function loadcomments(){
        $enterprise_id = $this->input->post('enterprise_id');
        $project_id = $this->input->post('project_id');
        $get_projectcomments = $this->Frontend_model->get_projectcomments($project_id);
        
        foreach($get_projectcomments as $comment){
            if($comment->user_type == 4){
                $type = "Studnet";
            }elseif($comment->user_type == 5){
                $type = "Instructor";
            }
            $comments = $comment->comments;
            $user = get_userinfo($comment->user_id)->name;
            $picture = get_userinfo($comment->user_id)->picture;
            // $created_date = trim(datetimeagoformate($comment->created_date)). 'ssssssssssssssss';
           ?>
<div class="d-block py-5 border-bottom">
    <div class="d-flex align-items-center mb-3">
        <div class="img-user width_55p">
            <img src="<?php echo base_url($picture);?>" class="rounded-circle img-fluid" alt="<?php echo $user;?>">
        </div>
        <div class="ms-3">
            <h6 class="mb-1"><?php echo $user;?><span
                    class="bg-dark-cerulean text-white px-3 ms-2 rounded"><?php echo $type;?></span></h6>
            <div><?php  datetimeagoformate($comment->created_date);?></div>
        </div>
    </div>
    <p class="mb-0"><?php echo $comments;?></p>
</div>
<?php 

       }
       
    }

    public function likeunlikethisproject(){
        $user_id = $this->input->post('user_id');
        $project_id = $this->input->post('project_id');
        $enterprise_id = $this->input->post('enterprise_id');
        $status = $this->input->post('status');
        $checklikestatus = $this->Frontend_model->get_likeunlikestatus($project_id, $this->user_id, $enterprise_id);
        
        // if($checklikestatus){
        //     $status = 0;
        // }else{
        //     $status = 1;
        // }
        $likesdata = array(
            'user_id' => $user_id,
            'project_id' => $project_id,
            'likestatus' => $status,
            'created_date' => date('Y-m-d H:i:s'),
            'enterprise_id' => $enterprise_id,
        );

        // d($likesdata);
        if($checklikestatus){
            if($status == 0){
                echo '<button class="btn btn-dark-cerulean w-75" onclick="likeunlikethisproject('.$project_id.', 1)" ><i class="fas fa-thumbs-up me-2"></i>I like this project</button>';
            }else{
                echo '<button class="btn btn-danger w-75" onclick="likeunlikethisproject('.$project_id.', 0)" ><i class="fas fa-thumbs-down me-2"></i>I Unlike this project</button>';
            }
            $this->db->where('user_id', $user_id)->where('project_id', $project_id)->update('likes_tbl', $likesdata);
            
        }else{
            $this->db->insert('likes_tbl', $likesdata);
            echo '<button class="btn btn-danger w-75" onclick="likeunlikethisproject('.$project_id.', 0)" ><i class="fas fa-thumbs-down me-2"></i>I Unlike this project</button>';
        }
    }
    
    public function student_activity($parram = null) {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $user_id = $this->session->userdata('user_id');
        $data['lastactivitycourse'] = $this->Frontend_model->lastactivitycourse($user_id);
        if($data['lastactivitycourse']){
            $data['course_wise_sectioncount'] = $this->Course_model->course_wise_sectioncount($data['lastactivitycourse']->course_id);
            $data['course_wise_lessoncount'] = $this->Course_model->course_wise_lessoncount($data['lastactivitycourse']->course_id);
        }
        $data['get_studentstickynotes'] = $this->Frontend_model->get_studentstickynotes($user_id);
        
        //--==============Total time Spent==============---------
        $data['TodayTotalTimeSpent']= $this->Frontend_model->TodayTotalTimeSpent($user_id,$enterprise_id);           
        //--=============today indivisual course  time Spent==================--  
         $data['todayTimeSpent']= $this->Frontend_model->todayTimeSpent($user_id,$enterprise_id);   
         if($data['lastactivitycourse']){
        // course lesson complete counting 
        $data['completelesson'] = $this->db->where('course_id', $data['lastactivitycourse']->course_id)->where('student_id', $user_id)->where('is_complete',1)->get('watch_time_tbl')->result();
        // total lesson count
        $data['totalLesson']=$this->db->select('*')->from('lesson_tbl')->where('course_id',$data['lastactivitycourse']->course_id)->where('enterprise_id',$enterprise_id)->get()->result();
        // Total chapter 
        $data['total_chapter_count']=$this->db->select('*')->from('section_tbl')->where('course_id',$data['lastactivitycourse']->course_id)->where('enterprise_id',$enterprise_id)->get()->result();
        // chapter complete 
        $data['chapter_complete']=completedChapter($data['lastactivitycourse']->course_id,$enterprise_id,$user_id);
         }
     
        // purchase course
        $data['purchase_course']=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id, d.picture,e.name instructor_name')
                                  ->from('invoice_details a')
                                  ->join('course_tbl c','c.course_id=a.product_id')
                                  ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
                                  ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
                                //   ->join('invoice_tbl f', 'f.invoice_id = a.invoice_id', 'left') //new line add
                                  ->where('a.customer_id',$user_id)
                                  ->where('a.is_subscription',0)//new line add
                                  ->where('a.enterprise_id',$enterprise_id)
                                  ->where('a.status',1)
                                  ->get()->result();

         // subscription status check
  
        $data['subscription_status']=$this->db->select('a.*')
                                  ->from('invoice_tbl a')
                                  ->where('a.is_subscription',1)
                                  ->where('a.customer_id',$user_id)                         
                                  ->where('a.enterprise_id',$enterprise_id)
                                  ->where('a.status',1)
                                  ->order_by('id',"desc")
                                  ->get()->row();
        //  course_subscription
        $data['subscription_courses']=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id,c.course_id,d.picture,e.name instructor_name')
        ->from('invoice_details a')
        ->join('course_tbl c','c.course_id=a.product_id')
        ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
        ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
        ->where('a.customer_id',$user_id)
        ->where('a.is_subscription',1)//new line add
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.status',1)
        ->group_by('a.product_id')
        ->get()->result();                             
        // $data['subscription_courses']=$this->db->select('a.subscription_id,a.is_subscription,a.enterprise_id,b.course_id,b.subscription_id,c.name as course_name,c.faculty_id')
        // ->from('invoice_tbl a')
        // ->join('subscription_course_tbl b', 'b.subscription_id = a.subscription_id', 'left')
        // ->join('course_tbl c', 'c.course_id = b.course_id', 'left')
        // ->where('a.is_subscription',1)
        // ->where('a.status', 1)
        // ->where('a.customer_id',$user_id)
        // ->where('a.enterprise_id', $enterprise_id)
        // ->order_by('a.id', 'desc')
        // ->group_by('c.course_id')
        // ->get()->result();    
        
        $data['checksubscription_day_left']=$this->db->select('b.*,a.id as id,a.date,a.expeiredate,a.customer_id,a.invoice_id,a.subscription_id,b.duration')
        ->from('invoice_tbl a')
        ->join('subscription_tbl b','b.subscription_id=a.subscription_id','left')
        ->where('a.customer_id',$user_id)
        ->where('a.is_subscription',1)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.status',1)
        ->order_by('a.id','desc')
        ->get()->row();
        $data['get_allcourseexams'] = $this->Frontend_model->get_allcourseexams($user_id);     
        $data['get_featuredproject'] = $this->Frontend_model->get_featuredproject($enterprise_id, $this->user_id);                 

        if($parram){
            $data['get_examresultinfo'] = $this->Frontend_model->get_examresultinfo($parram);     
            // d($data['get_examresultinfo']);
        }else{
            $data['get_examresultinfo'] = '';
        }
                           
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_activity";
        echo Modules::run("template/frontend_studentlayout", $data);
    }
    public function sticky_note_save(){
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $title = $this->input->post('title', TRUE);
        $description = $this->input->post('description', TRUE);

        $check_stickynote = $this->Frontend_model->check_stickynote($user_id, $title);
        if($check_stickynote){
            echo 'This note already exists';
        }else{
            $stickydata = array(
                'course_id' => '',
                'student_id' => $user_id,
                'title' => $title,
                'notes' => $description,
                'status' => 1,
                'type' => 2,
                'enterprise_id' => $enterprise_id,
                'created_by' => $enterprise_id,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_by' => $enterprise_id,
                'updated_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('notes_tbl', $stickydata);
            echo 'Added successfully';
        }
    }
    public function stickynoteedit_form() {
        $id = $this->input->post('id', True);
        $note = $this->Frontend_model->stickynoteenoteeditdata($id);
        $noteeditdata= json_encode($note );
        echo $noteeditdata;
        // $this->load->view('frontend/themes/default/noteedit', $data);
    }
    // =========== its for sticky_note_update =============
    public function sticky_note_update(){
        $id = $this->input->post('id', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $title = $this->input->post('title', TRUE);
        $description = $this->input->post('description', TRUE);
        
        $stickydata = array(
            'title' => $title,
            'notes' => $description,
            'updated_by' => $enterprise_id,
            'updated_date' => date('Y-m-d H:i:s'),
        );
        // dd($stickydata);
        $this->db->where('id', $id)->update('notes_tbl', $stickydata);
        echo 'Updated successfully';

    }

    // =============== its for student sticky_note_delete =============
    public function sticky_note_delete(){
        $id = $this->input->post('id', TRUE);
        // $title = $this->input->post('title', TRUE);;
        if($id){
            $this->db->where('id', $id)->where('type',2)->delete('notes_tbl');
        }
        echo "Deleted successfully!";
    }
    // student activity purchase course type wise show
    public function student_course_status_wise_show(){
         $enterprise_id                = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
         $student_id                   =$this->input->post('student_id');
         $data['type']                 =$this->input->post('type');
         $data['enroller_type']        =$this->input->post('enroller_type');
         $data['user_id']              =$student_id;
         $data['enterprise_id']        =$enterprise_id;
         $data['enterprise_shortname'] =$this->enterprise_shortname;
          // purchase course
        $data['purchase_course_complete']=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id, d.picture,e.name instructor_name')
                                  ->from('invoice_details a')
                                  ->join('course_tbl c','c.course_id=a.product_id')
                                  ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
                                  ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
                                //   ->join('invoice_tbl f', 'f.invoice_id = a.invoice_id', 'left') //new line add
                                  ->where('a.customer_id',$student_id)
                                  ->where('a.is_subscription', 0)//new line add
                                  ->where('a.enterprise_id',$enterprise_id)
                                  ->where('a.status',1)
                                  ->where('a.complete_status',1)
                                  ->get()->result();
        $data['purchase_course_incomplete']=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id, d.picture,e.name instructor_name')
                                  ->from('invoice_details a')
                                  ->join('course_tbl c','c.course_id=a.product_id')
                                  ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
                                  ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
                                //   ->join('invoice_tbl f', 'f.invoice_id = a.invoice_id', 'left') //new line add
                                  ->where('a.customer_id',$student_id)
                                  ->where('a.is_subscription', 0)//new line add
                                  ->where('a.enterprise_id',$enterprise_id)
                                  ->where('a.status',1)
                                  ->where('a.complete_status',0)
                                  ->get()->result();

         // subscription status check
         $data['subscription_status']=$this->db->select('a.customer_id,a.enterprise_id')
         ->from('invoice_tbl a')
         ->where('a.is_subscription',1)
         ->where('a.customer_id',$student_id)
         ->where('a.enterprise_id',$enterprise_id)
         ->where('a.status',1)
         ->get()->row();
         $data['subscription_course_complete']=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id,c.course_id,d.picture,e.name instructor_name')
         ->from('invoice_details a')
         ->join('course_tbl c','c.course_id=a.product_id')
         ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
         ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
         ->where('a.customer_id',$student_id)
         ->where('a.is_subscription',1)//new line add
         ->where('a.enterprise_id',$enterprise_id)
         ->where('a.status',1)
         ->where('a.complete_status',1)
         ->group_by('a.product_id')
         ->get()->result();
         $data['subscription_course_incomplete']=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id,c.course_id,d.picture,e.name instructor_name')
         ->from('invoice_details a')
         ->join('course_tbl c','c.course_id=a.product_id')
         ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
         ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
         ->where('a.customer_id',$student_id)
         ->where('a.is_subscription',1)//new line add
         ->where('a.enterprise_id',$enterprise_id)
         ->where('a.status',1)
         ->where('a.complete_status',0)
         ->group_by('a.product_id')
         ->get()->result();
        //  $data['subscription_courses']=$this->db->select('a.subscription_id,a.is_subscription,a.enterprise_id,b.course_id,b.subscription_id,c.name as course_name,c.faculty_id')
        // ->from('invoice_tbl a')
        // ->join('subscription_course_tbl b', 'b.subscription_id = a.subscription_id', 'left')
        // ->join('course_tbl c', 'c.course_id = b.course_id', 'left')
        // ->where('a.is_subscription',1)
        // ->where('a.status', 1)
        // ->where('a.customer_id',$student_id)
        // ->where('a.enterprise_id', $enterprise_id)
        // ->order_by('a.id', 'desc')
        // ->group_by('c.course_id')
        // ->get()->result();


        
        

         $this->load->view('frontend/themes/default/students/completeIncomplete', $data);

    }

    // ============ its for exam_donestatus ===============
    public function exam_donestatus(){
        $questionexam_id = $this->input->post('questionexam_id', TRUE);
        $donestatusdata = array(
            'is_done' => 1,
        );
        $this->db->where('questionexam_id', $questionexam_id)->update('question_exam_tbl', $donestatusdata);
        echo 'This exam completed successfully';
    }

    // ============= its for get_passfailquiz ===========
    public function get_passfailquiz(){
        $user_id = $this->session->userdata('user_id');
        $type = $this->input->post('type', TRUE);
        $data['enterprise_shortname'] = $this->enterprise_shortname;
        if($type == 2){
            // $data['get_allcourseexams'] = $this->Frontend_model->get_allincompleteexam($user_id); 
            $data['get_allcourseexams'] = $this->Frontend_model->get_allcourseexams($user_id);  
            $this->load->view('frontend/themes/default/students/loadincompletequiz', $data);
        }else{            
            $data['get_allcourseexams'] = $this->Frontend_model->get_allcourseexamstypewise($user_id, $type); 
            $this->load->view('frontend/themes/default/students/loadpassfailquiz', $data);
        }
    }

    public function student_notification() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        // $data['allnotification']=$this->db->select("*")->from("notifications_tbl")->where('student_id',$user_id)->where('enterprise_id',$enterprise_id)->order_by("id", "desc")->limit(20)->get()->result();
        $user_id = $this->user_id;
        $config["base_url"] = base_url($this->enterprise_shortname.'/student-notification/');
        // $config["total_rows"] = $this->db->where('student_id',$user_id)->count_all('notifications_tbl');
        $config["total_rows"] = $this->db->where('student_id',$user_id)->where('enterprise_id',$enterprise_id)->count_all_results('notifications_tbl');
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
        $data["allnotification"] = $this->db->select("*")->from("notifications_tbl")->where('student_id',$user_id)
                                            ->where('enterprise_id',$enterprise_id)->order_by("id", "desc")
                                            ->limit($config["per_page"], $page)
                                            ->get()->result();
                                            
                                            // $this->Forum_model->forum_category_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;



        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_notification";
        echo Modules::run("template/frontend_studentlayout", $data);
    }
    
    public function student_settings_account() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $user_id = $this->session->userdata('user_id');
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_settings_account";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    //    ======== its for student_password_update =========
    public function student_password_update() {
        $user_id = $this->input->post('user_id', TRUE);
        $current_password = $this->input->post('current_password', TRUE);
        $new_password = $this->input->post('new_password', TRUE);
        $retype_password = $this->input->post('retype_password', TRUE);
        $current_password_check = $this->Frontend_model->user_password_check($user_id, $current_password);
        if (!$current_password_check) {
            echo 0;
        } else {
            $passwordchange_data = array(
                'password' => md5($new_password),
            );
            $this->db->where('log_id', $user_id)->update('loginfo_tbl', $passwordchange_data);
            echo 1;
        }
    }

    
    // student_settings_affiliation
    public function student_settings_affiliation() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_settings_affiliation";
        echo Modules::run("template/frontend_studentlayout", $data);
    }
    // ========== its for language-update =============
    public function language_update(){
        $user_id = $this->input->post('user_id', TRUE);
        $language = $this->input->post('language', TRUE);
        $languagedata = array(
            'language' => $language,
        );
        $this->db->where('student_id', $user_id)->update('students_tbl', $languagedata);
        echo display('updated_successfully');
    }
   

    public function student_settings_notification() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $user_id = $this->session->userdata('user_id');
        $data['check_settingnotification'] = $this->Frontend_model->check_settingnotification($user_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_settings_notification";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    public function save_setting_notification(){
        $user_id = $this->session->userdata('user_id', TRUE);
        $courses_site = $this->input->post('courses_site', TRUE);
        $courses_email = $this->input->post('courses_email', TRUE);
        $courses_sms = $this->input->post('courses_sms', TRUE);
        $offerupdates_site = $this->input->post('offerupdates_site', TRUE);
        $offerupdates_email = $this->input->post('offerupdates_email', TRUE);
        $offerupdates_sms = $this->input->post('offerupdates_sms', TRUE);
        $blog_site = $this->input->post('blog_site', TRUE);
        $blog_email = $this->input->post('blog_email', TRUE);
        $blog_sms = $this->input->post('blog_sms', TRUE);
        $events_site = $this->input->post('events_site', TRUE);
        $events_email = $this->input->post('events_email', TRUE);
        $events_sms = $this->input->post('events_sms', TRUE);
        $community_site = $this->input->post('community_site', TRUE);
        $community_email = $this->input->post('community_email', TRUE);
        $community_sms = $this->input->post('community_sms', TRUE);
        $soundnoti_site = $this->input->post('soundnoti_site', TRUE);
        $soundnoti_email = $this->input->post('soundnoti_email', TRUE);
        $soundnoti_sms = $this->input->post('soundnoti_sms', TRUE);

        $check_settingnotification = $this->Frontend_model->check_settingnotification($user_id);

        $notificationdata = array(
            'user_id' => (!empty($user_id) ? $user_id : ''),
            'courses_site' => (!empty($courses_site) ? $courses_site : '0'),
            'courses_email' => (!empty($courses_email) ? $courses_email : '0'),
            'courses_sms' => (!empty($courses_sms) ? $courses_sms : '0'),
            'offerupdates_site' => (!empty($offerupdates_site) ? $offerupdates_site : '0'),
            'offerupdates_email' => (!empty($offerupdates_email) ? $offerupdates_email : '0'),
            'offerupdates_sms' => (!empty($offerupdates_sms) ? $offerupdates_sms : '0'),
            'blog_site' => (!empty($blog_site) ? $blog_site : '0'),
            'blog_email' => (!empty($blog_email) ? $blog_email : '0'),
            'blog_sms' => (!empty($blog_sms) ? $blog_sms : '0'),
            'events_site' => (!empty($events_site) ? $events_site : '0'),
            'events_email' => (!empty($events_email) ? $events_email : '0'),
            'events_sms' => (!empty($events_sms) ? $events_sms : '0'),
            'community_site' => (!empty($community_site) ? $community_site : '0'),
            'community_email' => (!empty($community_email) ? $community_email : '0'),
            'community_sms' => (!empty($community_sms) ? $community_sms : '0'),
            'soundnoti_site' => (!empty($soundnoti_site) ? $soundnoti_site : '0'),
            'soundnoti_email' => (!empty($soundnoti_email) ? $soundnoti_email : '0'),
            'soundnoti_sms' => (!empty($soundnoti_sms) ? $soundnoti_sms : '0'),
            'type' => 1,
            'created_by' => $user_id,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_by' => $user_id,
            'updated_date' => date('Y-m-d H:i:s'),
        );
        // dd($notificationdata);
        if($check_settingnotification){
            $this->db->where('user_id', $user_id)->update('notification_config_tbl', $notificationdata);
            $this->session->set_flashdata('success', "<div class='alert alert-success'>Updated successfully!</div>");
        }else{
            $this->db->insert('notification_config_tbl', $notificationdata);
            $this->session->set_flashdata('success', "<div class='alert alert-success'>Added successfully!</div>");
        }
        
        redirect($this->enterprise_shortname.'/student-settings-notification');
    }
    public function student_settings_payments() {
        if (!$this->sessionid) {
            redirect($this->enterprise_shortname);
        }
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_settings_payments";
        echo Modules::run("template/frontend_studentlayout", $data);
    }

    // public function course_quick_view() {
    //     $course_id = $this->input->post('course_id');
    //     $data['single_courseinfo'] = $this->Frontend_model->single_courseinfo($course_id);
    //     $data['course_wise_lesson'] = $this->Course_model->course_wise_lesson($course_id);
    //     $data['course_wise_lessoncount'] = $this->Course_model->course_wise_lessoncount($course_id);
    //     $getcourse_rating = $this->Frontend_model->getcourse_rating($course_id);
    //     $total_rating = @$getcourse_rating->total_rating;
    //     $total_person = @$getcourse_rating->total_person;
    //     if ($total_rating > 0) {
    //         $data['average_rating'] = ceil($total_rating / $total_person);
    //     } else {
    //         $data['average_rating'] = 0;
    //     }
    //     $this->load->view('themes/default/coursequick_view', $data);
    // }
//============= its for category course ================
    // public function category_course($category_id) {
    //     $data['title'] = display('category_course');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['category_course'] = $this->Frontend_model->category_course($category_id);
    //     $data['category_info'] = $this->db->select('*')->from('category_tbl')->where('category_id', $category_id)->get()->row();
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/category_course";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ============ its for about ===========
    public function about() {
        $data['title'] = display('about');
        $data['transfarentmenu'] = '';
        $enterprise_id = 1;
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_aboutinfo'] = $this->Frontend_model->get_aboutinfo($enterprise_id);
        if($data['get_aboutinfo']->about_id){
            $data['get_aboutchoosedata'] = $this->Frontend_model->get_aboutchoosedata($data['get_aboutinfo']->about_id);
            $data['get_aboutservicedata'] = $this->Frontend_model->get_aboutservicedata($data['get_aboutinfo']->about_id);
        }
        $data['company_list'] = $this->Setting_model->company_list($enterprise_id);
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/about";
        echo Modules::run("template/frontend_layout", $data);
    }

//    ============ its for privacy_policy ===========
    public function privacy_policy() {
        $data['title'] = display('privacy_policy');
        $data['transfarentmenu'] = '';
        $enterprise_id = 1;
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_privacypolicy'] = $this->Setting_model->get_privacypolicy($enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/privacy_policy";
        echo Modules::run("template/frontend_layout", $data);
    }

//    ============ its for refund_policy ===========
    public function refund_policy() {
        $data['title'] = 'Refund Policy';
        $data['transfarentmenu'] = '';
        $enterprise_id = 1;
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_refundpolicy'] = $this->Setting_model->get_refundpolicy($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/refund_policy";
        echo Modules::run("template/frontend_layout", $data);
    }

//    ============ its for terms_condition ===========
    public function terms_condition() {
        $data['title'] = "Terms & Condition";
        $data['transfarentmenu'] = '';
        $enterprise_id = 1;
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_termscondition'] = $this->Setting_model->get_termscondition($enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/terms_condition";
        echo Modules::run("template/frontend_layout", $data);
    }

//============== its for add_to_cart ===========
    public function add_to_cart() {
        $this->load->library('cart');
        $course_id = $this->input->post('course_id', TRUE);
        $coursename = $this->input->post('coursename', TRUE);
        $slug = $this->input->post('slug', TRUE);
        $qty = $this->input->post('qty', TRUE);
        $price = $this->input->post('price', TRUE);
        $old_price = $this->input->post('old_price', TRUE);
        $picture = $this->input->post('picture', TRUE);
        $course_type = $this->input->post('is_course_type', TRUE);
        $cartinfo = array(
            'id' => $course_id,
            'name' => $coursename,
            'slug' => $slug,
            'qty' => $qty,
            'price' => $price,
            'old_price' => $old_price,
            'picture' => $picture,
            'is_course_type' =>$course_type,
        );
        $this->cart->insert($cartinfo);
        // echo 'Course added to cart';
 
?>
<li class="nav-item dropdown dmenu dropdown-cart">
    <a class="nav-link dropdown-toggle" href="#" id="cart" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i data-feather="shopping-cart" class="navbar-icon shopping-cart"></i>
        <span
            class="badge"><?php if (!empty($this->cart->contents())) { echo count($this->cart->contents());}else{ echo "0";}?></span>
    </a>
    <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn" aria-labelledby="cart">
        <div class="notifications-scroll">
            <div class="shopping-cart-header d-flex align-items-center justify-content-between">
                <div class="position-relative">
                    <i data-feather="shopping-cart" class="shopping-cart"></i><span
                        class='badge badge-success'><?php if (!empty($this->cart->contents())) { echo count($this->cart->contents());}else{ echo "0";}?></span>
                </div>

                <div class="shopping-cart-total">
                    <span class="text-muted">Total:</span>
                    <span class="main-color-text">BDT <?php echo html_escape($this->cart->total()); ?></span>
                </div>
            </div>
            <?php 
        $carts = $this->cart->contents();
        if ($carts) {
            $i = 1;
            foreach ($carts as $item) {
                
            $picture = $item["picture"];
            echo form_hidden($i . '[rowid]', $item['rowid']);
        ?>
            <div class="media dropdown-course-grid" id="">
                <!-- <a href="<?php echo base_url($this->enterprise_shortname.'/course-details/'. html_escape($item['id'])); ?>"> -->
                <img src="<?php echo base_url(html_escape(($picture) ? "$picture" : "application/modules/frontend/views/themes/default/assets/defaul-course.png")); ?>"
                    width="30%" class="me-3" alt="...">
                <!-- </a> -->
                <div class="media-body">
                    <a
                        href="<?php echo base_url($this->enterprise_shortname.'/course-details/'. html_escape($item['id'])); ?>">
                        <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1 text-dark">
                            <?php echo html_escape($item['name']); ?></h5>
                    </a>
                    <div class="course-pricing d-flex align-items-center font-weight-bold">
                        <div class="price-original fs-12 text-dark m-sm-1">BDT
                            <?php echo html_escape($item['price']); ?></div>
                        <div class="price-discount text-danger  fs-12">
                            <?php if($item['old_price']){?>
                            <del><?php echo html_escape($item['old_price']); ?></del>
                            <?php }?>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-sm"
                        onclick="cart_delete('<?php echo $i; ?>', '<?php echo html_escape($item['rowid']); ?>')"><i
                            class="fas fa-trash-alt"></i></button>
                    <div class="btn  btn-sm"></div>
                </div>
            </div>
            <?php $i++;}}else{?>
            <p class="emptycart_msg emptycart_msg w-75 text-center mx-auto mt-3">Your cart is empty</p>
            <?php }?>
        </div>
        <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
            <a href="<?php echo base_url($this->enterprise_shortname.'/cart'); ?>"
                class="btn btn-dark-cerulean d-block">Go to cart</a>
        </div>
    </div>
</li>
<?php 

    }

//    ============ its for cart info ===========
    public function cart() {
//        dd(count($this->cart->contents()));
        $data['title'] = display('cart');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
//        $data['setting'] = $this->Setting_model->read();
        $data['active_theme'] = get_activethemes(); //$this->Frontend_model->active_theme();
//        $data['courses'] = $this->Frontend_model->courses(8, '');
        $data['module'] = "frontend";
        $data['page'] = "themes/default/cart";
        echo Modules::run("template/frontend_layout", $data);
    }

//    =========== its for  update_cart ==========
    public function update_cart() {
        $qty = $this->input->post('qty', TRUE);
        $rowid = $this->input->post('rowid', TRUE);
        $this->cart->update(array('rowid' => $rowid, 'qty' => $qty));
        echo display('cart_updated_successfully');
    }

//    =========== its for cart delete ==========
    public function cart_delete() {
        $qty = $this->input->post('qty', TRUE);
        $rowid = $this->input->post('rowid', TRUE);
        $this->cart->update(array('rowid' => $rowid, 'qty' => $qty));
        echo display('deleted_successfully');
    }

//    ===============its for login form ===========
    public function student_signinform() {

        $this->load->view('frontend/themes/default/signinform');
    }
//    ============= its for student register form =============
    // public function student_register_form() {
    //     $this->load->view('frontend/themes/default/student_register');
    // }
//    ============= its for faculty register form =============
    // public function faculty_register_form() {
    //     $this->load->view('frontend/themes/default/faculty_register');
    // }
//    ========== its for testPusher ===========
    // public function testPusher() {
    //     $data['message'] = '5';
    //     $this->pusher->trigger('my-channel', 'my-event', $data);
    // }
//    ============ its for checkout info ===========
     public function checkout() {
        $data['transfarentmenu'] = '';
         $session_id = $this->session->userdata('session_id');
         $subscription_id = $this->session->userdata('subscription_id');
        //  if($subscription_id){
        //     redirect($this->enterprise_shortname .'/subscription-checkout/'.$subscription_id);
        //  }
         if (!$this->cart->contents()) {
            redirect($this->enterprise_shortname .'/cart');
        }
        
         $data['title'] = display('checkout');
         $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
//        $data['setting'] = $this->Setting_model->read();
        $data['active_theme'] = get_activethemes(); //$this->Frontend_model->active_theme();
//         $data['setting'] = $this->Setting_model->read();
//         $data['active_theme'] = $this->Frontend_model->active_theme();
         $data['get_countries'] = $this->Frontend_model->get_countries();
//         $data['popular_course'] = $this->Frontend_model->popular_course(8, '');
         $data['get_paymentgateway'] = $this->Frontend_model->get_paymentgateway();
         $data['module'] = "frontend";
         $data['page'] = "themes/default/checkout";
         echo Modules::run("template/frontend_layout", $data);
     }
//    ============ its for subscription checkout info ===========
     public function subscription_checkout($subscription_id) {
        $data['transfarentmenu'] = '';
         $session_id = $this->session->userdata('session_id');
        
         $subscriptiondata = array(
             'subscription_id' => $subscription_id,
         );
         $this->session->set_userdata($subscriptiondata);
         
         $data['title'] = display('checkout');
         $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['active_theme'] = get_activethemes();
         $data['get_countries'] = $this->Frontend_model->get_countries();
         $data['get_paymentgateway'] = $this->Frontend_model->get_paymentgateway();

         $data['module'] = "frontend";
         $data['page'] = "themes/default/subscription_checkout";
         echo Modules::run("template/frontend_layout", $data);
     }
//========= its for order confirm =========
     public function confirm_order() {
         $user_id = $this->session->userdata('user_id');
         $user_type = $this->session->userdata('user_type');
         $session_id = $this->session->userdata('session_id');
         if ($user_type == '4' && $session_id) {
             $log_id = $user_id;
         } else {
             $log_id = "ST" . time();
         }
         $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
         $is_createAccount = (($this->input->post('account_status', TRUE) == 1) ? true : 0);
         $name = $this->input->post('name', TRUE);
         $mobile = $this->input->post('mobile', TRUE);
         $address = $this->input->post('address', TRUE);
         $email = $this->input->post('email', TRUE);
         $country_id = $this->input->post('country_id', TRUE);
         $city = $this->input->post('city', TRUE);
         $state = $this->input->post('state', TRUE);
         $zip = $this->input->post('zipcode', TRUE);
         $create_account = $is_createAccount;
         $is_different = $this->input->post('is_different', TRUE);
         $password = $this->input->post('password', TRUE);
         $description = '';
         $shipp_name = $this->input->post('shipping_name', TRUE);
         $shipp_email = $this->input->post('shipping_email', TRUE);
         $shipp_mobile = $this->input->post('shipping_mobile', TRUE);
         $shipp_address = $this->input->post('shipping_address', TRUE);
         $shipp_country_id = $this->input->post('shipping_country_id', TRUE);
         $shipp_city = $this->input->post('shipping_city', TRUE);
         $shipp_state = $this->input->post('shipping_state', TRUE);
         $shipp_zip = $this->input->post('shipping_zipcode', TRUE);
         $invoice_id = "INV" . $this->generators->generator(7);
         $invoice_details_id = "INVD" . $this->generators->generator(8);
         $shipping_method = 0;
         $payment_method = $this->input->post('payment_method', TRUE);
         $subtotal = $this->input->post('subtotal', TRUE);
         $shipping_rate = $this->input->post('shipping_rate', TRUE);
         $grandtotal = $this->input->post('grandtotal', TRUE);
         $get_mailcheck = $this->Frontend_model->get_mailcheck($email);
         $get_usernamecheck = $this->Frontend_model->get_usernamecheck($email);
         $coupon_amnt = $this->session->userdata('coupon_amnt');
 //        ======== its start for session data =========
         $session_cart_info = array(
             'log_id' => $log_id,
             'invoice_id' => $invoice_id,
             'invoice_details_id' => $invoice_details_id,
             'name' => $name,
             'mobile' => $mobile,
             'address' => $address,
             'email' => $email,
             'country' => $country_id,
             'city' => $city,
             'state' => $state,
             'zip' => $zip,
             'password' => $password,
             'create_account' => $create_account,
             'is_different' => $is_different,
             'shipping_method' => $shipping_method,
             'payment_method' => $payment_method,
             'description' => $description,
             'shipp_name' => $shipp_name,
             'shipp_email' => $shipp_email,
             'shipp_mobile' => $shipp_mobile,
             'shipp_address' => $shipp_address,
             'shipp_country' => $shipp_country_id,
             'shipp_city' => $shipp_city,
             'shipp_state' => $shipp_state,
             'shipp_zip' => $shipp_zip,
             'total_amount' => $grandtotal,
             'enterprise_id' => $enterprise_id,
             'session_id' => (($session_id) ? $session_id : session_id()),
         );

         $this->session->set_userdata($session_cart_info);
         if ($create_account == 1 || $create_account == 0) {
             $session_cart_info2 = array(
                 'user_id' => $log_id,
                 'user_type' => '4',
             );
             $this->session->set_userdata($session_cart_info2);
         }
 //        ========= its close for session data ==========
         if ($user_type == '4' && $this->session->userdata('session_id')) {
             $loginfo_data = array(
                 'is_admin' => '4',
                 'user_types' => '4',
                 'updated_at' => date('Y-m-d H:i:s'),
             );
             $this->db->where('log_id', $log_id);
             $this->db->update('loginfo_tbl', $loginfo_data);
             $register_data = array(
                 'name' => $name,
                 'mobile' => $mobile,
                 'address' => $address,
                 'email' => $email,
                 'country' => $country_id,
                 'city' => $city,
                 'state' => $state,
                 'zipcode' => $zip,
                 'updated_date' => date('Y-m-d H:i:s'),
             );
             $this->db->where('student_id', $log_id);
             $this->db->update('students_tbl', $register_data);
             if ($payment_method == 1) {
                 $this->order_save($session_cart_info);
                 $this->load->model('sslcommerz/sslcommerz_model');
                 $this->sslcommerz_model->payment_by_sslcommerz($session_cart_info,$this->enterprise_shortname);
             } elseif ($payment_method == 2) {
                 $this->order_save($session_cart_info);
                 $this->paypal_payment($log_id, $invoice_id, $grandtotal, $session_cart_info);
             } elseif ($payment_method == 3) {
                 $this->order_save($session_cart_info);
                 redirect('frontend/payeer/gotopayeer');
             } elseif ($payment_method == 5) {
                 $this->order_save($session_cart_info);
                 redirect('frontend/stripe/gotoStripe');
             } elseif ($payment_method == 6) {
                 $this->order_save($session_cart_info);
                 redirect('frontend/payu/gotoPayu');
             } elseif ($payment_method == 7) {
                 $this->order_save($session_cart_info);
                 redirect('square/square/gotoSquare');
             } elseif ($payment_method == 9) {
                 $this->order_save($session_cart_info);
                 redirect('paystack/paystack/gotopaystack');
             }
         } else {
             if ($create_account == 1) {
                 $loginfo_data = array(
                     'log_id' => $log_id,
                     'name' => $name,
                     'mobile' => $mobile,
                     'email' => $email,
                     'username' => $email,
                     'password' => md5($password),
                     'is_admin' => '4',
                     'user_types' => '4',
                     'status' => 1,
                     'created_at' => date('Y-m-d H:i:s'),
                 );
                 $this->db->insert('loginfo_tbl', $loginfo_data);
                 $register_data = array(
                     'student_id' => $log_id,
                     'name' => $name,
                     'mobile' => $mobile,
                     'address' => $address,
                     'email' => $email,
                     'country' => $country_id,
                     'city' => $city,
                     'state' => $state,
                     'zipcode' => $zip,
                     'status' => 1,
                     'created_date' => date('Y-m-d H:i:s'),
                 );
                 $this->db->insert('students_tbl', $register_data);
                 if ($payment_method == 1) {
                     $this->order_save($session_cart_info);
                     $this->load->model('sslcommerz/sslcommerz_model');
                     $this->sslcommerz_model->payment_by_sslcommerz($session_cart_info,$this->enterprise_shortname);
                 } elseif ($payment_method == 2) {
                     $this->order_save($session_cart_info);
                     $this->paypal_payment($log_id, $invoice_id, $grandtotal, $session_cart_info);
                 } elseif ($payment_method == 3) {
                     $this->order_save($session_cart_info);
                     redirect('frontend/payeer/gotopayeer');
                 } elseif ($payment_method == 5) {
                     $this->order_save($session_cart_info);
                     redirect('frontend/stripe/gotoStripe');
                 } elseif ($payment_method == 6) {
                     $this->order_save($session_cart_info);
                     redirect('frontend/payu/gotoPayu');
                 } elseif ($payment_method == 7) {
                     $this->order_save($session_cart_info);
                     redirect('square/square/gotoSquare');
                 } elseif ($payment_method == 9) {
                     $this->order_save($session_cart_info);
                     redirect('paystack/paystack/gotopaystack');
                 }
             } else {
                 $loginfo_data = array(
                     'log_id' => $log_id,
                     'name' => $name,
                     'mobile' => $mobile,
                     'email' => $email,
                     'username' => $email,
                     'password' => md5('123456'),
                     'is_admin' => '4',
                     'user_types' => '4',
                     'status' => 1,
                     'created_at' => date('Y-m-d H:i:s'),
                 );
                 $this->db->insert('loginfo_tbl', $loginfo_data);
                 $register_data = array(
                     'student_id' => $log_id,
                     'name' => $name,
                     'mobile' => $mobile,
                     'address' => $address,
                     'email' => $email,
                     'country' => $country_id,
                     'city' => $city,
                     'state' => $state,
                     'zipcode' => $zip,
                     'status' => 1,
                     'created_date' => date('Y-m-d H:i:s'),
                 );
                 $this->db->insert('students_tbl', $register_data);
                 if ($payment_method == 1) {
                     $this->order_save($session_cart_info);
                     $this->load->model('sslcommerz/sslcommerz_model');
                     $this->sslcommerz_model->payment_by_sslcommerz($session_cart_info);
                 } elseif ($payment_method == 2) {
                     $this->order_save($session_cart_info);
                     $this->paypal_payment($log_id, $invoice_id, $grandtotal, $session_cart_info);
                 } elseif ($payment_method == 3) {
                     $this->order_save($session_cart_info);
                     redirect('frontend/payeer/gotopayeer');
                 } elseif ($payment_method == 5) {
                     $this->order_save($session_cart_info);
                     redirect('frontend/stripe/gotoStripe');
                 } elseif ($payment_method == 6) {
                     $this->order_save($session_cart_info);
                     redirect('frontend/payu/gotoPayu');
                 } elseif ($payment_method == 7) {
                     $this->order_save($session_cart_info);
                     redirect('square/square/gotoSquare');
                 } elseif ($payment_method == 9) {
                     $this->order_save($session_cart_info);
                     redirect('paystack/paystack/gotopaystack');
                 }
             }
         }
     }


//    ======== its for order submit data =======
    public function order_save($session_cart_info) {
   
       
        $subscription_id = $this->session->userdata('subscription_id');
        if ($this->cart->contents()) {


//            =========== its for invoice info =======
            $invoice_data = array(
                'customer_id' => $session_cart_info['log_id'],
                'invoice_id' => $session_cart_info['invoice_id'],
                'date' => date('Y-m-d'),
                'invoice' => $this->generators->number_generator(),
                'is_different' => '',
                'shipping_method' => $session_cart_info['shipping_method'],
                'payment_method' => $session_cart_info['payment_method'],
                'description' => $session_cart_info['description'],
                'invoice_discount' => '',
                'total_discount' => '',
                'total_amount' => $session_cart_info['total_amount'],
                'paid_amount' => $session_cart_info['total_amount'],
                'due_amount' => 0,
                'total_tax' => '',
                'status' => 0,
                'is_inhouse' => 2,
                'enterprise_id' => $session_cart_info['enterprise_id'],
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('invoice_tbl', $invoice_data);

            // coupon  method
            $this->order_coupon_insert($session_cart_info['log_id'], $session_cart_info['invoice_id']);
            // coupon  method end

            if ($carts = $this->cart->contents()) {
                 $i=0;
                foreach ($carts as $items) {
                    $get_offercourses = $this->db->select('a.*, b.name')
                                                            ->from('course_offers_tbl a')
                                                            ->join('course_tbl b', 'b.course_id = a.course_offerid')
                                                            ->where('a.course_id', $items['id'])
                                                            ->get()->result();
                    if($get_offercourses){
                        foreach($get_offercourses as $offercourse){
                        $invoice_details_id = "INVD" . $this->generators->generator(8);
                        $invoice_details = array(
                            'invoice_id' => $session_cart_info['invoice_id'],
                            'customer_id' => $session_cart_info['log_id'],
                            'invoice_details_id' => $invoice_details_id, //$session_cart_info['invoice_details_id'],
                            'product_id' => $offercourse->course_offerid, //$items['id'],
                            'quantity' => 1,//$items['qty'],
                            'price' => 0, //$items['price'],
                            'discount' => '',
                            'total_price' => 0, //$items['qty'] * $items['price'],
                            'discount_amount' => '',
                            'tax' => '',
                            'enterprise_id' => $session_cart_info['enterprise_id'],
                            'invoice_date' => date('Y-m-d'),
                        );
                        $this->db->insert('invoice_details', $invoice_details);
                    
                       }
                    }
        
                    $invoice_details_id = "INVD" . $this->generators->generator(8);
                        $invoice_details = array(
                            'invoice_id' => $session_cart_info['invoice_id'],
                            'customer_id' => $session_cart_info['log_id'],
                            'invoice_details_id' => $invoice_details_id, //$session_cart_info['invoice_details_id'],
                            'product_id' => $items['id'],
                            'quantity' => $items['qty'],
                            'price' => $items['price'],
                            'discount' => '',
                            'total_price' => $items['qty'] * $items['price'],
                            'discount_amount' => '',
                            'tax' => '',
                            'is_subscription'=>$items['is_course_type'],
                            'enterprise_id' => $session_cart_info['enterprise_id'],
                            'invoice_date' => date('Y-m-d'),
                        );
                        
                        $this->db->insert('invoice_details', $invoice_details);
                        $share_amount=$this->db->select("*")->from('course_tbl')->where('course_id',$items['id'])->get()->row();
                        $totalCredit=$items['price']*(!empty($share_amount->share_percent)?$share_amount->share_percent:'0')/100;
        
                        $faculty_id=$share_amount->faculty_id;
                        $instructor_ledger_data=array(
                            'transaction_id'  => $session_cart_info['invoice_id'],
                            'user_id'         => $faculty_id,
                            'course_id'       => $items['id'],
                            'date'            => date('Y-m-d'),
                            'description'     => '',
                            'is_subscription' => 0,
                            'subscription_id' => '',
                            'duration	'     => '',
                            'payment_type	' => '',
                            'share_percent	' => $share_amount->share_percent,
                            'debit	'         => 0,
                            'credit	'         => $totalCredit,
                            'status	'         => 0,
                            'created_by	'     => $session_cart_info['log_id'],
                            'created_date	' => date('Y-m-d H:i:s'),
                            'enterprise_id' => $session_cart_info['enterprise_id']
                        );
                        $this->db->insert('instructor_ledger_tbl',$instructor_ledger_data);
                        $academy_ledger_data=array(
                            'transaction_id'     => $session_cart_info['invoice_id'],
                            'course_id'          => $items['id'],
                            'description'        => '',
                            'is_subscription'    =>0,
                            'subscription_id'    =>'',
                            'payment_type'       =>'',
                            'debit'              =>$items['price'],
                            'credit'             =>'',
                            'status'             =>0,
                            'created_by	'        => $session_cart_info['log_id'],
                            'created_date	'    => date('Y-m-d H:i:s'),
                            'enterprise_id' => $session_cart_info['enterprise_id']
                        );

                        $this->db->insert('academic_ledger_tbl',$academy_ledger_data);
                       //   save course delete after purchaseing 
                        $this->db->where('student_id',$session_cart_info['log_id'])->where('course_id',$items['id'])->delete('coursesave_tbl');


                }
                
            }

           
            return true;
        }elseif($subscription_id){
        $course_type = "JSON_CONTAINS(course_type, '[\"2\"]')";
         // all subscription course get here 
        $subscription_course= $this->db->select('a.course_id')
        ->from('course_tbl a')
        ->where($course_type)
        ->where('a.enterprise_id', $session_cart_info['enterprise_id'])
        ->where('a.status',1)
        ->order_by('a.id', 'desc')
        ->get()->result();

        //=======subscription date check================= 
        $subscriptioncheck=$this->db->select('b.*,a.id as id,a.date,a.customer_id,a.invoice_id,a.subscription_id,a.expeiredate,b.duration')
        ->from('invoice_tbl a')
        ->join('subscription_tbl b','b.subscription_id=a.subscription_id','left')
        ->where('a.customer_id',$session_cart_info['log_id'])
        ->where('a.is_subscription',1)
        ->where('a.enterprise_id',$session_cart_info['enterprise_id'])
        ->where('a.status',1)
        ->order_by('a.id','desc')
        ->get()->row();

        $checksubscription_new_duration=$this->db->select('a.duration')
        ->from('subscription_tbl a')
        ->where('a.enterprise_id',$session_cart_info['enterprise_id'])
        ->where('a.subscription_id',$subscription_id)
        ->where('a.status',1)
        ->get()->row();

        //  check subscription
        if($subscriptioncheck){
          
            $exp_date = date("Y-m-d", strtotime($subscriptioncheck->expeiredate));
            //  old which duration 
            $current = strtotime('now');
            $event_date = strtotime($exp_date); 
            $diffference = ($event_date - $current);
            $days = ceil($diffference / (60 * 60 * 24));

            if ($subscriptioncheck->duration == 1) {

                    if($checksubscription_new_duration->duration==1){
                    $days=abs($days)+30;
                    $last_date = date('Y-m-d', strtotime($create_date . ' + '.$days.' days'));
                    }else{
                        $days=abs($days)+365;
                        $last_date = date('Y-m-d', strtotime($create_date . ' + '.$days.' days'));
                    }

            } else {

                if($checksubscription_new_duration->duration==1){
                    $days=abs($days)+30;
                    $last_date = date('Y-m-d', strtotime($create_date . ' + '.$days.' days'));
                    }else{
                    $days=abs($days)+365;
                    $last_date = date('Y-m-d', strtotime($create_date . ' + '.$days.' days'));
                }


            }


        }else{
         
            // New subscription 
            $current_date=date('Y-m-d');
            if($checksubscription_new_duration->duration==1){
               $last_date = date('Y-m-d', strtotime($current_date . ' + 30 days'));
            }else{
                   $last_date = date('Y-m-d', strtotime($current_date . ' + 365 days'));
            }
        }
        

        //=======end  subscription date check================= 


        $subscription_course_check= $this->db->select('a.invoice_id,a.customer_id,a.subscription_id,b.product_id,b.invoice_id,b.customer_id,b.is_subscription')
           ->from('invoice_tbl a')
           ->join('invoice_details b','b.invoice_id=a.invoice_id')
           ->join('subscription_tbl c','c.subscription_id=a.subscription_id')
           ->where('a.subscription_id',$subscription_id)
           ->where('a.customer_id',$session_cart_info['log_id'])
           ->where('a.is_subscription',1)
           ->where('a.enterprise_id',$session_cart_info['enterprise_id'])
           ->where('a.status',1)
           ->order_by('a.id','desc')
           ->get()->result() ;
           
        //===subscription check and delete old course from invoice_details table====== 
           if($subscription_course_check){
               $previous_course_count=count($subscription_course_check);
            foreach( $subscription_course_check as $previous_course){
                    $this->db->where('invoice_id', $previous_course->invoice_id)->delete('invoice_details');
            }
           }
            $invoice_data = array(
                'customer_id' => $session_cart_info['log_id'],
                'invoice_id' => $session_cart_info['invoice_id'],
                'date' => date('Y-m-d'),
                'invoice' => $this->generators->number_generator(),
                'is_different' => '',
                'shipping_method' => $session_cart_info['shipping_method'],
                'payment_method' => $session_cart_info['payment_method'],
                'description' => $session_cart_info['description'],
                'invoice_discount' => '',
                'total_discount' => '',
                'total_amount' => $session_cart_info['total_amount'],
                'paid_amount' => $session_cart_info['total_amount'],
                'due_amount' => 0,
                'total_tax' => '',
                'status' => 0,
                'is_inhouse' => 2,
                'is_subscription' => 1,
                'subscription_id' => $subscription_id,
                'enterprise_id' => $session_cart_info['enterprise_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'expeiredate' =>$last_date,
            );
            $this->db->insert('invoice_tbl', $invoice_data);
            // coupon  method
            $this->order_coupon_insert($session_cart_info['log_id'], $session_cart_info['invoice_id']);
             // coupon  method end

            //  subscription course insert invoice_details page 
            foreach ($subscription_course as $subcourse) {
                $invoice_details = array(
                    'invoice_id' => $session_cart_info['invoice_id'],
                    'customer_id' => $session_cart_info['log_id'],
                    'invoice_details_id' => $session_cart_info['invoice_details_id'],
                    'product_id' => $subcourse->course_id,
                    'quantity' => 0,
                    'price' =>0,
                    'discount' => '',
                    'total_price' =>'0',
                    'discount_amount' => '',
                    'tax' => '',
                    'enterprise_id' => $session_cart_info['enterprise_id'],
                    'invoice_date' => date('Y-m-d'),
                    'is_subscription' => 1,
                );
                $this->db->insert('invoice_details', $invoice_details);
            //   save course delete after purchaseing 
                $this->db->where('student_id',$session_cart_info['log_id'])->where('course_id',$subcourse->course_id)->delete('coursesave_tbl');
            }

            $academy_ledger_data=array(
                'transaction_id'     => $session_cart_info['invoice_id'],
                'course_id'          => '',
                'description'        => '',
                'is_subscription'    =>1,
                'subscription_id'    => $subscription_id,
                'payment_type'       =>'',
                'debit'              => $session_cart_info['total_amount'], //$items['price'],
                'credit'             =>'',
                'status'             =>0,
                'created_by	'        => $session_cart_info['log_id'],
                'created_date	'    => date('Y-m-d H:i:s'),
                'enterprise_id' => $session_cart_info['enterprise_id']
             );
             $this->db->insert('academic_ledger_tbl',$academy_ledger_data);
    
            return true;
            
        }
        // $coupon_amnt = $this->session->userdata('coupon_amnt');
        // if ($coupon_amnt > 0) {
            
        // }


    }

    private function order_coupon_insert($customer_id, $invoice_id){
        $coupon_code = $this->session->userdata('coupon_code');
        if(!empty($coupon_code)){
        $data = array(
            'user_id'     =>$customer_id,
            'invoice_id'  => $invoice_id,
            'coupon_code' => $coupon_code,
            'date_of_apply' => date('Y-m-d H:i:s')
        );
        $this->db->insert('coupon_history_tbl', $data);
       }
    }
    //    ============ its for payment gateway ============
    public function paypal_payment($customer_id, $order_id, $total_amount, $session_cart_info) {
       $paypal=$this->db->select('ClientSecret,ClientID, currency,status')
        ->from('gateway_tbl')
        ->where('id', 1)
        ->get()
        ->row();
        // $setting = $this->Setting_model->read();
        // $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        // $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        // $amount = $total_amount;
        // $price = number_format($amount, 2);
        // $quantity = 1;
        // $discount = 0;
        // $item_name = "Order :: Test";
        // // --------------------- Set variables for paypal form
        // $returnURL = site_url("frontend/success"); //payment success url
        // $cancelURL = site_url("frontend/cancel"); //payment cancel url
        // $notifyURL = site_url("frontend/ipn"); //ipn url
        // //set session token
        // $this->session->unset_userdata('_tran_token');
        // $this->session->set_userdata(array('_tran_token' => $order_id));
        // // set form auto fill data
        // $this->paypal_lib->add_field('return', $returnURL);
        // $this->paypal_lib->add_field('cancel_return', $cancelURL);
        // $this->paypal_lib->add_field('notify_url', $notifyURL);
        // // item information
        // $this->paypal_lib->add_field('item_number', $order_id);
        // $this->paypal_lib->add_field('item_name', $item_name);
        // $this->paypal_lib->add_field('amount', $amount);
        // $this->paypal_lib->add_field('quantity', $quantity);
        // $this->paypal_lib->add_field('discount_amount', $discount);
        // // additional information 
        // $this->paypal_lib->add_field('custom', $order_id);
        // $this->paypal_lib->image('');
        // // generates auto form
        // $this->paypal_lib->paypal_auto_form();



        require APPPATH.'libraries/paypal/vendor/autoload.php';


        // After Step 1
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $paypal->ClientID,     // ClientID
                $paypal->ClientSecret     // ClientSecret
            )
        );

        // Step 2.1 : Between Step 1 and Step 2
        $apiContext->setConfig(
            array(
                'mode' => $paypal->status,
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'FINE'
            )
        );
        // After Step 2
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');
        
        $item1 = new \PayPal\Api\Item();
        $item1->setName('setName');
        $item1->setCurrency('USD');
        $item1->setQuantity(1);
        $item1->setPrice((float)@$total_amount);
        
        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems(array($item1));
        
        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency("USD");
        $amount->setTotal((float)@$total_amount);
        
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList);
        $transaction->setDescription('Description');
        
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(base_url("frontend/success"))->setCancelUrl(base_url("frontend/cancel"));
        
        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);
            // After Step 3
            try {
            $payment->create($apiContext);                
            $data['payment']     =  $payment;
            $data['approval_url']=  $payment->getApprovalLink();

        }
        // print_r( $data['approval_url']);
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
            echo $ex->getData();
        }

      redirect($data['approval_url']);






    }
//    ============ paypal success msg ============
//    public function success($order_id = null, $customer_id = null) {
    public function success() {
        if (isset($_GET['paymentId'])) {
            $paypal=$this->db->select('ClientID,ClientSecret, currency,status')
            ->from('gateway_tbl')
            ->where('id', 1)
            ->get()
            ->row();
            require APPPATH.'libraries/paypal/vendor/autoload.php';

            // After Step 1
            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    $paypal->ClientID,     // ClientID
                    $paypal->ClientSecret     // ClientSecret
                )
            );

            // Step 2.1 : Between Step 2 and Step 3
            $apiContext->setConfig(
                array(
                    'mode' => $paypal->status,
                    'log.LogEnabled' => true,
                    'log.FileName' => 'PayPal.log',
                    'log.LogLevel' => 'FINE'
                )
            );

            // Get payment object by passing paymentId
            $paymentId = $_GET['paymentId'];

  
            $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
            $payerId = $_GET['PayerID'];

            // Execute payment with payer id
            $execution = new \PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);
            try {
                // Execute payment
                  $result = $payment->execute($execution, $apiContext);
                  $subtotal = $payment->transactions[0]->related_resources[0]->sale->amount->details->subtotal;
                  $fff = $payment->transactions[0]->related_resources[0]->sale->state;
                  $order_id = $this->session->userdata('invoice_id');
                  $customer_id = $this->session->userdata('log_id');
                  $user_info = $this->db->select('a.*, b.picture as picture')->from('loginfo_tbl a')
                                  ->join('picture_tbl b', 'b.from_id = a.log_id', 'left')
                                  ->where('log_id', $customer_id)->get()->row();
                  $session_userloginfo = array(
                      'log_id' => $user_info->log_id,
                      'session_id' => session_id(),
                      'name' => $user_info->name,
                      'mobile' => $user_info->mobile,
                      'email' => $user_info->email,
                      'user_type' => $user_info->user_types,
                      'user_id' => $user_info->log_id,
                      'image' => (!empty($user_info->picture) ? $user_info->picture : ''),
                  );
                  $this->session->set_userdata($session_userloginfo);
                  $data['title'] = "Order Title";
                  $invoice_info = array(
                      'status' => 1,
                  );
                  $this->db->where('invoice_id', $order_id)->update('invoice_tbl', $invoice_info);
                  $invoiceDetails_info = array(
                      'status' => 1,
                  );
                  $this->db->where('invoice_id', $order_id)->update('invoice_details', $invoiceDetails_info);
                  $this->cart->destroy();
                  $this->session->set_userdata('popup', '1');
                  redirect(base_url($this->enterprise_shortname));


              } catch (PayPal\Exception\PayPalConnectionException $ex) {
                  echo $ex->getCode();
                  echo $ex->getData();
                  die($ex);

              } catch (Exception $ex) {
                  die($ex);

              }



        
      }
    }
    public function cancel() {
        $order_id = $this->session->userdata('invoice_id');
        $customer_id = $this->session->userdata('log_id');
        $data['title'] = "Order";
        $data['module'] = "frontend";
        $data['page'] = "themes/default/payment_failed";
        echo Modules::run("template/frontend_layout", $data);
    }

    //===============coupon code===============
    public function apply_coupon(){
      $this->session->userdata('user_id');
      $session_id = $this->session->userdata('session_id');
        if (!$session_id) {
            $session_data=array(
                'coupon_error_message'    => 'login to apply coupon',
            );
            echo json_encode($session_data);
            exit();
            // echo "6";
        }
        $user_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('coupon_code', display('coupon_code'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_userdata(array('error_message' => validation_errors()));
            $session_data=array(
                'coupon_error_message'    => 'Coupon Code must be required!',
            );
            echo json_encode($session_data);
            // echo "5";
            exit;
        } else {
            $coupon_code = $this->input->post('coupon_code',TRUE);
            $result = $this->db->select('*')
                ->from('coupon_tbl')
                ->where('coupon_code', $coupon_code)
                ->where('status', 1)
                ->get()
                ->row();
            if(!empty($result)){
                $check_coupon = $this->db->select('user_id,date_of_apply,coupon_code')
                                         ->where('user_id', $user_id)
                                         ->where('coupon_code', $coupon_code)
                                         ->from('coupon_history_tbl')
                                         ->get()->row();
            if (empty($check_coupon)) {
                $today = strtotime(date('Y-m-d'));
               // $start_date = strtotime($result->start_date);
                $end_date = strtotime($result->expiry_date);
                $difference_date = (int)$end_date - (int)$today;
                if ($difference_date < 0) {
                    $this->session->set_userdata('error_message', 'coupon is expired');
                    $session_data=array(
                        'coupon_error_message'    => 'coupon is expired',
                    );
                    echo json_encode($session_data);
                    // echo "3";
                    exit;
                }
                // $diff = abs($start_date - $end_date);
                $diff = abs($end_date);
                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                if ((!empty($days) || !empty($months) || !empty($years))) {
                    $this->session->set_userdata("coupon", "$result->coupon_code");
                    if ($result->discount_type == 1) {
                        // print_r($result);
                        $this->session->set_userdata('coupon_code', $result->coupon_code);
                        // $this->session->unset_userdata('coupon_amnt');
                        // $this->session->set_userdata('coupon_amnt', $result->coupon_discount);
                        // $this->session->set_userdata('message', 'Your coupon is used');
                        if($result->coupon_discount <=$result->discount_limit){
                            $session_data=array(
                                'coupon_type'=> 1,
                                'coupon_amnt'=> $result->coupon_discount,
                                'coupon_message'    => 'Your coupon is successfully used',
                            );
                            echo json_encode($session_data);
                            exit;
                        }else{
                            $session_data=array(
                                'coupon_type'=> 1,
                                'coupon_amnt'=> $result->discount_limit,
                                'coupon_message'    => 'Your coupon is successfully used',
                            );
                            echo json_encode($session_data);
                            exit;
                        }
                    } elseif ($result->discount_type == 2) {
                        
                        $this->session->set_userdata('coupon_code', $result->coupon_code);
                        $subscription_price = $this->input->post('subscription_price',TRUE);
                        if(!empty($subscription_price)){
                            $total_dis = ($subscription_price * $result->coupon_discount) / 100;
                        }else{
                            $total_dis = ($this->cart->total() * $result->coupon_discount) / 100;
                        }
                       
                        // $this->session->unset_userdata('coupon_amnt');
                        // $this->session->set_userdata('coupon_amnt', $total_dis);
                        $this->session->set_userdata('message', 'Your coupon is successfully used');
                            if($total_dis <=$result->discount_limit){
                            $session_data=array(
                                'coupon_type'=> 2,
                                'coupon_amnt'=>  $total_dis,
                                'coupon_message'    => 'Your coupon is successfully used',
                            );
                            echo json_encode($session_data);
                            // echo "2";
                            exit;
                            }else{
                                $session_data=array(
                                    'coupon_type'=> 2,
                                    'coupon_amnt'=>  $result->discount_limit,
                                    'coupon_message'    => 'Your coupon is successfully used',
                                );
                                echo json_encode($session_data);
                                exit;
                            }
                    }

                } else {
                    $this->session->set_userdata('error_message','This coupon is expired');
                    // echo "3";
                    $session_data=array(
                        'coupon_error_message'    => 'Invalid coupon ',
                    );
                    echo json_encode($session_data);
                    exit;
                }
            } else {
                $this->session->set_userdata('error_message','This coupon is already used');
                // echo "4";
                $session_data=array(
                    'coupon_error_message'    => 'This coupon is already used',
                );
                echo json_encode($session_data);
                exit;
            }
         }else{
            $this->session->set_userdata('error_message','Invalid Code');
            $session_data=array(
                'coupon_error_message'    => 'Invalid coupon',
            );
            echo json_encode($session_data);
            exit;
         }

        }



    }
//============= its for add to  free course ==========
    public function add_to_mycourse() {
        $logid = $this->input->post('user_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $coursename = $this->input->post('coursename', TRUE);
        $qty = $this->input->post('qty', TRUE);
        $price = $this->input->post('price', TRUE);
        $course_type = $this->input->post('course_type', TRUE);

        $picture = $this->input->post('picture', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $invoice_id = "INV" . $this->generators->generator(7);
        $invoice_details_id = "INVD" . $this->generators->generator(8);
         
         if($course_type==3){
            $is_subscription=2 ; //free course status 
         }elseif($course_type==4){
            $is_subscription=4 ; //free event status 
         }else{
            $is_subscription=3;  // gov course 
         }
        $invoice_data = array(
            'customer_id' => $logid,
            'invoice_id' => $invoice_id,
            'date' => date('Y-m-d'),
            'invoice' => $this->generators->number_generator(),
            'is_different' => '',
            'shipping_method' => '',
            'payment_method' => '',
            'description' => '',
            'invoice_discount' => '',
            'total_discount' => '',
            'total_amount' => $price,
            'paid_amount' => 0,
            'due_amount' => 0,
            'total_tax' => '',
            'status' => 1,
            'is_inhouse' => 2,
            'is_subscription' =>$is_subscription,
            'subscription_id' =>'',
            'enterprise_id' =>$enterprise_id,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('invoice_tbl', $invoice_data);
        $invoice_details = array(
            'invoice_id' => $invoice_id,
            'customer_id' => $logid,
            'invoice_details_id' => $invoice_details_id,
            'product_id' => $course_id,
            'quantity' => $qty,
            'price' => $price,
            'discount' => '',
            'total_price' => 0,
            'discount_amount' => '',
            'tax' => '',
            'status' => 1,
            'enterprise_id' => $enterprise_id,
            'invoice_date' => date('Y-m-d'),
            'is_subscription' =>$is_subscription,
        );
        $this->db->insert('invoice_details', $invoice_details);
        echo 'Course added to my course!';
         //   save course delete after purchaseing 
        $this->db->where('student_id',$logid)->where('course_id',$course_id)->delete('coursesave_tbl');
    }
//    ============ its for faculty info ===========
    // public function faculty_info($faculty_id) {
    //     $data['title'] = display('faculty_info');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['faculty_info'] = $this->Faculty_model->faculty_info($faculty_id);
    //     $data['faculty_workExperience'] = $this->Faculty_model->faculty_experience($faculty_id);
    //     $data['faculty_education'] = $this->Faculty_model->faculty_education($faculty_id);
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/faculty_info";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
    //    ============= its for  faculty count ===============
    // public function faculty_count() {
    //     $this->db->where('status', 1);
    //     $count_query = $this->db->count_all_results('faculty_tbl');
    //     return $count_query;
    // }
    //    ============ its for faculties list ===========
    // public function faculties() {
    //     $data['title'] = display('faculty_list');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $config["base_url"] = base_url('faculties/');
    //     $config["total_rows"] = $this->faculty_count();
    //     $config["per_page"] = 12;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["faculty_list"] = $this->Faculty_model->get_faculty_list($config["per_page"], $page);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/faculties";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ========== its for enroll save =============
    // public function enroll_save() {
    //     $user_id = $this->input->post('user_id', TRUE);
    //     $product_id = $this->input->post('product_id', TRUE);
    //     $wishlist_check = $this->db->select('*')->from('enroll_tbl')->where('customer_id', $user_id)
    //                     ->where('product_id', $product_id)->get()->row();
    //     if ($wishlist_check) {
    //         $wishlist_data = array(
    //             'customer_id' => $user_id,
    //             'product_id' => $product_id,
    //         );
    //         $this->db->where('customer_id', $user_id)->where('product_id', $product_id);
    //         $this->db->update('enroll_tbl', $wishlist_data);
    //         echo "Wishlist added successfully";
    //     } else {
    //         $wishlist_data = array(
    //             'customer_id' => $user_id,
    //             'product_id' => $product_id,
    //         );
    //         $this->db->insert('enroll_tbl', $wishlist_data);
    //         echo "Wishlist added successfully";
    //     }
    // }
//============= its for courses =============
    // public function courses() {
    //     $data['title'] = display('our_courses');
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['setting'] = $this->Setting_model->read();
    //     $config["base_url"] = base_url('courses/');
    //     $config["total_rows"] = $this->db->where('status', 1)->count_all_results('course_tbl');
    //     $config["per_page"] = 24;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["courses"] = $this->Frontend_model->courses($config["per_page"], $page);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/courses";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//============= its for popular courses =============
    // public function popular_courses() {
    //     $data['title'] = display('popular_courses');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $config["base_url"] = base_url('popular-courses/');
    //     $config["total_rows"] = $this->db->where('status', 1)->where('is_popular', 1)->count_all_results('course_tbl');
    //     $config["per_page"] = 24;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["courses"] = $this->Frontend_model->popular_courses($config["per_page"], $page);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/popular_courses";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//============= its for free courses =============
    // public function free_courses() {
    //     $data['title'] = display('free_courses');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $config["base_url"] = base_url('free-courses/');
    //     $config["total_rows"] = $this->db->where('status', 1)->where('is_free', 1)->count_all_results('course_tbl');
    //     $config["per_page"] = 24;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["courses"] = $this->Frontend_model->free_courses($config["per_page"], $page);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/free_courses";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ============ its for review_save ===========
    public function review_save() {
        $user_id = $this->input->post('user_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $rating = $this->input->post('score', TRUE);
        $user_name = $this->input->post('reviewer_name', TRUE);
        $user_email = $this->input->post('reviewer_email', TRUE);
        $review = $this->input->post('review', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);

        $check_review = $this->db->select('*')->from('rating_tbl')->where('user_id', $user_id)
                        ->where('course_id', $course_id)->get()->row();
        $checkBuy = $this->db->select('*')->from('invoice_details')
                        ->where('customer_id', $user_id)
                        ->where('product_id', $course_id)->get()->row();
        if ($checkBuy) {
            if ($check_review) {
              
                $review_data = array(
                    // 'user_id' => $user_id,
                    // 'course_id' => $course_id,
                    'rating' => $rating,
                    'comments' => $review,
                    // 'enterprise_id' => $enterprise_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' =>date('Y-m-d H:i:s'),
                    'status' => 1,
                );
                
                $this->db->where('user_id', $user_id)->where('course_id', $course_id)->where('enterprise_id',$enterprise_id);
                $this->db->update('rating_tbl', $review_data);
            } else {
                $review_data = array(
                    'user_id' => $user_id,
                    'course_id' => $course_id,
                    'rating' => $rating,
                    'comments' => $review,
                    'enterprise_id' => $enterprise_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'status' => 1,
                );
                $this->db->insert('rating_tbl', $review_data);
            }
            echo "Review submitted successfully";
        } else {
            echo "Please buy this course, firstly!";
        }
    }
//    ============= its for my course count ===============
    // public function mycourse_count($user_id) {
    //     $this->db->where('customer_id', $user_id);
    //     $this->db->where('status', 1);
    //     $this->db->group_by('product_id');
    //     $count_query = $this->db->count_all_results('invoice_details');
    //     return $count_query;
    // }
//    ============ its for my course ==============
    // public function my_course() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('my_course');
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['get_categorycourse'] = $this->Frontend_model->get_categorycourse($this->user_id);
    //     $data['setting'] = $this->Setting_model->read();
    //     $config["base_url"] = base_url('my-course');
    //     $config["total_rows"] = $this->mycourse_count($this->user_id);
    //     $config["per_page"] = 20;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["course_list"] = $this->Frontend_model->mycourse_list($config["per_page"], $page, $this->user_id);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/my_course";
    //     echo modules::run('template/frontend_layout', $data);
    // }
    //    ============= its for my course count ===============
    // public function myenrollcourse_count($user_id) {
    //     $this->db->where('customer_id', $user_id);
    //     $count_query = $this->db->count_all_results('enroll_tbl');
    //     return $count_query;
    // }
//    ============ its for enroll course ==============
    // public function enroll_course() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['get_categoryenrollcourse'] = $this->Frontend_model->get_categoryenrollcourse($this->user_id);
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['title'] = display('enroll_course');
    //     $data['setting'] = $this->Setting_model->read();
    //     $config["base_url"] = base_url('enroll-course');
    //     $config["total_rows"] = $this->myenrollcourse_count($this->user_id);
    //     $config["per_page"] = 20;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["course_list"] = $this->Frontend_model->enrollCourse_list($config["per_page"], $page, $this->user_id);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/enroll_course";
    //     echo modules::run('template/frontend_layout', $data);
    // }
//============= its for my category course ================
    // public function my_category_course($category_id) {
    //     $data['title'] = '';
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['category_course'] = $this->Frontend_model->my_category_course($category_id, $this->user_id);
    //     $data['category_info'] = $this->db->select('*')->from('category_tbl')->where('category_id', $category_id)->get()->row();
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/category_course";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//============= its for my category enroll course ================
    // public function my_category_enrollcourse($category_id) {
    //     $data['title'] = '';
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['category_course'] = $this->Frontend_model->my_category_enrollcourse($category_id, $this->user_id);
    //     $data['category_info'] = $this->db->select('*')->from('category_tbl')->where('category_id', $category_id)->get()->row();
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/category_course";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
    //    ============= its for autocomplete_course_search =========
    public function autocomplete_course_search_ex() {
        $query = $this->input->post('query', TRUE);
        $results = $this->db->select('a.*')->from('course_tbl a')->like('a.name', $query)->where('a.is_livecourse', 0)->where('status', '1')->limit(100)->get()->result();
        echo json_encode($results);
    }
//    ============= its for autocomplete_course_search =========
    public function autocomplete_course_search() {
        $query = $this->input->post('query', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        
        $this->db->select('a.id, a.course_id, a.name as value, a.is_livecourse, a.enterprise_id, b.faculty_id, b.name faculty_name');
        $this->db->from('course_tbl a');
        $this->db->join('faculty_tbl b', 'b.faculty_id =a.faculty_id', 'left');
        
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', '1');
        $this->db->where('a.is_livecourse', 0);

        $this->db->group_start();
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', '1');
        $this->db->where('a.is_livecourse', 0);
        $this->db->like('a.name', $query, 'both');
        $this->db->or_like('b.name', $query, 'both');
        $this->db->group_end();

         $this->db->order_by('a.id','DESC');
        $this->db->limit(100);
        $results = $this->db->get()->result();
        // echo $this->db->last_query();
        echo json_encode($results);
    }

    //    ============= its for typeahead search ==============
    public function typeahead_search() {
 
        $item = $this->input->get('keyward', TRUE);
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $category_id = $this->input->post('category_id', TRUE);
        
        $data['category_id'] =$category_id ;
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $data['transfarentmenu'] = '';
        $data['get_popularcourse'] = $this->Frontend_model->popular_course(6, '', $enterprise_id);
        $data['free_courses'] = $this->Frontend_model->free_courses(6, '', $enterprise_id);
        $data['gov_courses'] = $this->Frontend_model->gov_courses(6, '', $enterprise_id);
        $data['category_courses'] = $this->Frontend_model->typeahead_search($item, $enterprise_id);
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        // $results = $this->Frontend_model->typeahead_search($item, $enterprise_id);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        // $this->load->view('frontend/themes/default/course_search', $data);
        // echo json_encode($results[0]);
        // dd( $results);
        $data['categorycourse_count']=$this->db->from('course_tbl a')
                                               ->where('a.enterprise_id', $enterprise_id)
                                               ->where('a.status', 1)
                                               ->get()->num_rows();

        $data['module'] = "frontend";
        $data['page'] = "themes/default/course_search";
        echo Modules::run("template/frontend_layout", $data);
      
    }
    //category_course_search
    public function autocomplete_category_wise_course_search() {
        $query = $this->input->post('query', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        $results = $this->db->select('a.*')->from('course_tbl a')->like('a.name', $query)
                                        //    ->where('category_id', $category_id)
                                           ->where('a.is_livecourse', 0)
                                           ->where('status',1)
                                           ->limit(100)->get()->result();
        echo json_encode($results);
    }

    //    ============= its for typeahead search ==============
    public function category_wise_typeahead_search() {
        $item = $this->input->post('item', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['category_id'] = $category_id;
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $data['enterprise_id']=$enterprise_id;
        $data['transfarentmenu'] = '';
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        // $data['get_popularcourse'] = $this->Frontend_model->popular_course(6, '', $enterprise_id);
        // $data['free_courses'] = $this->Frontend_model->free_courses(6, '', $enterprise_id);
        // $data['gov_courses'] = $this->Frontend_model->gov_courses(6, '', $enterprise_id);
        $data['category_courses'] = $this->Frontend_model->typeahead_search($item, $enterprise_id);
        // $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        // $data['categorycourse_count'] = $this->Frontend_model->categorycourse_count($category_id, $enterprise_id);
        $this->load->view('frontend/themes/default/category_course_filtering', $data);
    }

    // course category page search option 
    public function category_course_filtering() {

        $type = $this->input->post('course_type', TRUE);

        $category_id = $this->input->post('category_id', TRUE);
        $data['category_id'] = $category_id;
        $data['category_type'] = $type;
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['enterprise_id']=$enterprise_id;
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        $data['transfarentmenu'] = '';
        $data['category_courses'] = $this->Frontend_model->category_course_filtering($type, $category_id, $enterprise_id);
        $data['categorycourse_count'] = $this->Frontend_model->categorycourse_count($category_id, $enterprise_id);
        $this->load->view('frontend/themes/default/category_course_filtering', $data);
    }
    public function course_filtering_loadmore(){
        $type = $this->input->post('course_type', TRUE);
        $lastid = $this->input->post('lastid', TRUE);
      
        $category_id = $this->input->post('category_id', TRUE);
        $data['category_id'] = $category_id;
        $data['category_type'] = $type;
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['enterprise_id']=$enterprise_id;
        $data['user_id']= $this->user_id;
        $data['user_type']= $this->session->userdata('user_type');
        $data['transfarentmenu'] = '';
        $data['category_courses'] = $this->Frontend_model->course_filtering_loadmore($lastid,$type, $category_id, $enterprise_id);
        $data['categorycourse_count'] = $this->Frontend_model->categorycourse_count($category_id, $enterprise_id);
        $this->load->view('frontend/themes/default/category_course_filtering', $data);
    }

//    ============ its for events ===========
    // public function events() {
    //     $data['title'] = display('events');
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['get_sliderevents'] = $this->Frontend_model->get_sliderevents();
    //     $config["base_url"] = base_url('events/');
    //     $config["total_rows"] = $this->db->count_all('events_tbl');
    //     $config["per_page"] = 30;
    //     $config["uri_segment"] = 2;
    //     $config["last_link"] = "Last";
    //     $config["first_link"] = "First";
    //     $config['next_link'] = 'Next';
    //     $config['prev_link'] = 'Prev';
    //     $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
    //     $config['full_tag_close'] = '</ul></nav></div>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close'] = '</span></li>';
    //     $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close'] = '</span></li>';
    //     /* ends of bootstrap */
    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    //     $data["get_events"] = $this->Frontend_model->get_events($config["per_page"], $page);
    //     $data["links"] = $this->pagination->create_links();
    //     $data['pagenum'] = $page;
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/events";
    //     echo Modules::run("template/frontend_layout", $data);
    // }

   

//    =========== its for send comment ===========
    // public function send_comment() {
    //     $comment_id = "CM" . date('d') . $this->generators->generator(5);
    //     $user_id = $this->input->post('user_id', TRUE);
    //     $event_id = $this->input->post('event_id', TRUE);
    //     $comment = $this->input->post('comment', TRUE);
    //     $check_event = $this->db->select('*')->from('comments_tbl')->where('user_id', $user_id)->where('event_id', $event_id)->get()->row();
    //     if ($check_event) {
    //         $comment_data = array(
    //             'comments' => $comment,
    //             'created_date' => date('Y-m-d H:i:s'),
    //             'created_by' => $this->user_id,
    //         );
    //         $this->db->where('comment_id', $check_event->comment_id)->update('comments_tbl', $comment_data);
    //     } else {
    //         $comment_data = array(
    //             'comment_id' => $comment_id,
    //             'user_id' => $user_id,
    //             'event_id' => $event_id,
    //             'comments' => $comment,
    //             'created_date' => date('Y-m-d H:i:s'),
    //             'created_by' => $this->user_id,
    //         );
    //         $this->db->insert('comments_tbl', $comment_data);
    //     }
    //     echo display('commented_successfully');
    // }
//    =========== its for frontend dashboard ===========
    // public function dashboard() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('dashboard');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['profile_data'] = $this->Frontend_model->profile_data($this->user_id);
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/dashboard";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ============= its for profile_data_update ==============
    // public function profile_data_update() {
    //     $user_id = $this->input->post('user_id', TRUE);
    //     $name = $this->input->post('name', TRUE);
    //     $mobile = $this->input->post('mobile', TRUE);
    //     $address = $this->input->post('address', TRUE);
    //     $biography = $this->input->post('biography', TRUE);
    //     $facebook = $this->input->post('facebook', TRUE);
    //     $twitter = $this->input->post('twitter', TRUE);
    //     $linkedin = $this->input->post('linkedin', TRUE);
    //     $instagram = $this->input->post('instagram', TRUE);
    //     $profile_data = array(
    //         'name' => $name,
    //         'mobile' => $mobile,
    //         'address' => $address,
    //         'biography' => $biography,
    //         'facebook' => $facebook,
    //         'twitter' => $twitter,
    //         'linkedin' => $linkedin,
    //         'instagram' => $instagram,
    //     );
    //     $this->db->where('student_id', $user_id)->update('students_tbl', $profile_data);
    //     $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Updated successfully!</div>");
    //     redirect('student-dashboard');
    // }
//    =========== its for frontend quiz test form ===========
    // public function quiz_test_form() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('dashboard');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['profile_data'] = $this->Frontend_model->profile_data($this->user_id);
    //     $data['get_mycourse'] = $this->Frontend_model->get_mycourse($this->user_id);
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/quiz_test_form";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ============ its for show quiz ===========
    // public function show_coursequiz() {
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $data['get_coursequiz'] = $this->Frontend_model->get_coursequiz($course_id);
    //     $data['single_courseinfo'] = $this->Frontend_model->single_courseinfo($course_id);
    //     $check_existsquiz = $this->Frontend_model->check_existsquiz($course_id);
    //     if ($check_existsquiz) {
    //         echo '<span class="text-danger text-center">Already submit this course, please select another course!</span>';
    //     } else {
    //         $this->load->view('themes/default/student_panel/show_coursequiz', $data);
    //     }
    // }
//    ========= its for quiz submit ===========
    // public function submit_quiz() {
    //     $quiz_id = $this->input->post("quiz_id", TRUE);
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $count_quiz = count($quiz_id);
    //     for ($i = 0, $j = 1; $i < $count_quiz; $i++, $j++) {
    //         $quiz_data = array(
    //             'student_id' => $this->user_id,
    //             'course_id' => $course_id,
    //             'quiz_id' => $quiz_id[$i],
    //             'ans' => $this->input->post('ans_' . $j),
    //             'created_date' => date('Y-m-d H:i:s'),
    //         );
    //         if (!empty($quiz_data)) {
    //             $this->db->insert('quizresults_tbl', $quiz_data);
    //         }
    //     }
    //     $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please see your results!</div>");
    //     redirect('quiz-result/' . $course_id);
    // }
    // public function quiz_result($course_id = null) {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('quiz_result');
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['profile_data'] = $this->Frontend_model->profile_data($this->user_id);
    //     $data['get_mycourse'] = $this->Frontend_model->get_mycourse($this->user_id);
    //     $data['get_quizresult'] = $this->Frontend_model->get_quizresult($course_id);
    //     $data['get_summaryresult'] = $this->Frontend_model->get_summaryresult($course_id);
    //     $data['single_courseinfo'] = $this->Frontend_model->single_courseinfo($course_id);
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/quiz_result";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ============ its for show quiz result ===========
    // public function show_quiz_result() {
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $data['get_quizresult'] = $this->Frontend_model->get_quizresult($course_id);
    //     $data['get_summaryresult'] = $this->Frontend_model->get_summaryresult($course_id);
    //     $data['single_courseinfo'] = $this->Frontend_model->single_courseinfo($course_id);
    //     $this->load->view('themes/default/student_panel/show_quiz_result', $data);
    // }
//    ============= its for change_student_picture ============
    // public function change_student_picture() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('change_profile_picture');
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['studentpicture_data'] = $this->Frontend_model->studentpicture_data($this->user_id);
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/change_student_picture";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    =========== its for student_profile_picture_update ============
    // public function student_profile_picture_update() {
    //     $user_id = $this->session->userdata('user_id');
    //     $image = $this->fileupload->update_doupload(
    //             $user_id, 'assets/uploads/students/', 'picture'
    //     );
    //     $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $user_id)->get()->row();
    //     if ($image) {
    //         if ($check_image) {
    //             $picture_data = array(
    //                 'picture' => $image,
    //                 'picture_type' => 'students',
    //                 'status' => 1,
    //                 'updated_date' => date('Y-m-d H:i:s'),
    //                 'updated_by' => $this->user_id,
    //             );
    //             $this->db->where('from_id', $user_id)->update('picture_tbl', $picture_data);
    //         } else {
    //             $picture_data = array(
    //                 'from_id' => $user_id,
    //                 'picture' => $image,
    //                 'picture_type' => 'students',
    //                 'status' => 1,
    //                 'created_date' => date('Y-m-d H:i:s'),
    //                 'created_by' => $this->user_id,
    //             );
    //             $this->db->insert('picture_tbl', $picture_data);
    //         }
    //     }
    //     $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Updated successfully!</div>");
    //     redirect('change-student-picture');
    // }
//    ============= its for student_payment_info ============
    // public function student_payment_info() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('change_profile_picture');
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['profile_data'] = $this->Frontend_model->profile_data($this->user_id);
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/student_payment_info";
    //     echo Modules::run("template/frontend_layout", $data);
    // }
//    ============= its for student_paymentinfo_update ============
    // public function student_paymentinfo_update() {
    //     $user_id = $this->input->post('user_id', TRUE);
    //     $paypal = $this->input->post('paypal', TRUE);
    //     $payment_data = array(
    //         'paypal' => $paypal,
    //         'bitcoin' => '',
    //         'simbcoin' => '',
    //     );
    //     $this->db->where('student_id', $user_id)->update('students_tbl', $payment_data);
    //     $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Updated successfully!</div>");
    //     redirect('student-payment-info');
    // }
//    ============= its for student_change_password ============
    // public function student_change_password() {
    //     if (!$this->session->userdata('session_id')) {
    //         redirect('/');
    //     }
    //     $data['title'] = display('change_password');
    //     $data['active_theme'] = $this->Frontend_model->active_theme();
    //     $data['get_loginfodata'] = $this->Frontend_model->get_loginfodata($this->user_id);
    //     $data['setting'] = $this->Setting_model->read();
    //     $data['module'] = "frontend";
    //     $data['page'] = "themes/default/student_panel/student_change_password";
    //     echo Modules::run("template/frontend_layout", $data);
    // }

//=========== its for forgotpassword_form ==============
    public function forgotpassword_form() {
        $this->load->view('themes/default/forgotpassword_form');
    }

    public function password_resetlink(){
        $data['transfarentmenu'] = '';
        
       
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/password_resetpage";
        echo Modules::run("template/frontend_layout", $data);
    }


    public function subscription_details(){
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['subscription_info']= $this->Frontend_model->get_subscriptioninfo($enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/subscription_details";
        echo Modules::run("template/frontend_layout", $data);
    
    }
  
    
    public function set_timewatch(){

        $finish  = $this->input->post('finish');
        $summation_time  = $this->input->post('summation_time');
        $vp  = $this->input->post('vp');
        $starttimevalues  = $this->input->post('starttimevalues');
        $endtime  = $this->input->post('endtime');
        // echo "hello";
        // echo $starttimevalues;
        // echo "end";
        // echo $endtime;
        // exit;
        $video_progress  = $this->input->post('video_progress');

        $video_start_time  = $this->input->post('starttime');
        $video_stop_time   = $this->input->post('stoptime');

        $enterprise_id     = $this->input->post('enterprise_id');
        $course_id         = $this->input->post('course_id');
        $lesson_id         = $this->input->post('lesson_id');
        $student_id        = $this->input->post('student_id');
        $eachvideoDuration = $this->input->post('eachvideoDuration');
        $studentwatchTime = $this->input->post('studentwatchTime');
        $watch_ss_diff = $endtime-$starttimevalues;

        $watch_time_different = timediff($video_stop_time, $video_start_time);


        $checkwatchdata = $this->db->where('course_id',$course_id)->where('lesson_id', $lesson_id)->where('student_id', $student_id)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->row();
        // all time convert second
        $eachvideoWatchTime=(!empty($checkwatchdata->real_time)?$checkwatchdata->real_time +$watch_ss_diff: $watch_ss_diff+(!empty($checkwatchdata->real_time)?$checkwatchdata->real_time:0));
         
         $parsed = date_parse($eachvideoDuration);

         $Convertseconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']-5;
         $totalconvertstiontime = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
         $totalprogress=($eachvideoWatchTime *100)/$Convertseconds;
         if($finish==2){
            $complete          = 1;
         }else{
             $complete          = '';
             
        }
        if(@$checkwatchdata->is_complete == 1){
          $complete          = 1;
        }

        $previous_watch_time = 0;
        if(!empty($checkwatchdata)){
            $previous_watch_time = $checkwatchdata->real_time;
            $watchdata = array(
                // 'real_time'  => $previous_watch_time + $watch_time_different,
                'real_time'  => ($complete == 1?$totalconvertstiontime:($previous_watch_time + $watch_ss_diff)),
                'is_complete'=> $complete,
            );
            // $this->db->where('id',$checkwatchdata->id)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->update('watch_time_tbl', $watchdata);          
            $this->db->where('id',$checkwatchdata->id)->update('watch_time_tbl', $watchdata);
           
            if(!empty($complete) ==1 ){
                echo $complete;
            }
        }else{
          
            $watchdata = array(
                'real_time'     => (!empty($previous_watch_time)?$previous_watch_time:0) + $watch_ss_diff,
                'course_id'     => $course_id,
                'lesson_id'     => $lesson_id,
                'student_id'    => $student_id,
                'is_complete'   => $complete,
                'file_type'     => 1,
                'enterprise_id' => $enterprise_id
            );
            // dd($watchdata);
            $this->db->insert('watch_time_tbl', $watchdata);
            if(!empty($complete) ==1 ){
                echo $complete;
            }
        }

        
    //    daily watch time calculate 
        
        $date=date('Y-m-d');
        $previous_watch_timedaily = 0;
        $dailywatchtimecheck = $this->db->where('course_id',$course_id)->where('lesson_id', $lesson_id)->where('student_id', $student_id)->where('date',$date)->where('enterprise_id',$enterprise_id)->get('daily_watch_time_tbl')->row();
       
        
        if(!empty($dailywatchtimecheck)){
            $previous_watch_timedaily = $dailywatchtimecheck->real_time;
            $previouswatchtime = $dailywatchtimecheck->studentwatchTime;
            $dailywatchdata = array(
                'real_time'         => $previous_watch_timedaily + (!empty($summation_time)?$summation_time:0),
                'studentwatchTime'  => $previouswatchtime + $watch_ss_diff,
                'watchdatetime'        => date('Y-m-d H:i:s'),
            );
            $this->db->where('id',$dailywatchtimecheck->id)->update('daily_watch_time_tbl',$dailywatchdata);

            // d($dailywatchdata);
        }else{

            $dailywatch = array(
                'real_time'            => $previous_watch_timedaily + (!empty($summation_time)?$summation_time:0),
                'studentwatchTime'     => (!empty($previouswatchtime )?$previouswatchtime :0)+ $watch_ss_diff,
                'course_id'            => $course_id,
                'lesson_id'            => $lesson_id,
                'student_id'           => $student_id,
                'date'                 => date('Y-m-d'),
                'watchdatetime'        => date('Y-m-d H:i:s'),
                'enterprise_id'        => $enterprise_id
            );
            $this->db->insert('daily_watch_time_tbl', $dailywatch);
            // d($dailywatch);
        }


    }
  
    // public function set_timewatch(){

    //     $finish  = $this->input->post('finish');
    //     $starttimevalues  = $this->input->post('starttimevalues');
    //     $endtime  = $this->input->post('endtime');
    //     $video_progress  = $this->input->post('video_progress');

    //     $video_start_time  = $this->input->post('starttime');
    //     $video_stop_time   = $this->input->post('stoptime');

    //     $enterprise_id     = $this->input->post('enterprise_id');
    //     $course_id         = $this->input->post('course_id');
    //     $lesson_id         = $this->input->post('lesson_id');
    //     $student_id        = $this->input->post('student_id');
    //     $eachvideoDuration = $this->input->post('eachvideoDuration');
    //     $studentwatchTime = $this->input->post('studentwatchTime');
    //     $watch_ss_diff = $endtime-$starttimevalues;

    //     $watch_time_different = timediff($video_stop_time, $video_start_time);


    //     $checkwatchdata = $this->db->where('course_id',$course_id)->where('lesson_id', $lesson_id)->where('student_id', $student_id)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->row();
    //     // all time convert second
    //     // list($hours,$mins,$secs) = explode(':',$eachvideoDuration);
    //     //  $Convertseconds = mktime($hours,$mins,$secs) - mktime(0,0,0);
    //      $eachvideoWatchTime=(!empty($checkwatchdata->real_time)?$checkwatchdata->real_time +$watch_ss_diff: $watch_ss_diff+(!empty($checkwatchdata->real_time)?$checkwatchdata->real_time:0));
         
    //      $parsed = date_parse($eachvideoDuration);

    //      $Convertseconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']+0.5;
    //      $totalprogress=($eachvideoWatchTime *100)/$Convertseconds;
         
    //      if($finish==2 || $video_progress>=0.990 || $video_progress==1){
    //      // if($finish==2 || $totalprogress>=98|| $video_progress>=0.990 || $video_progress==1){
    //     //  if($totalprogress >=98){
    //     // if($eachvideoWatchTime >= $Convertseconds){
    //          $complete          = 1;
    //     }else{
    //          $complete          = '';
             
    //     }
    //     $previous_watch_time = 0;
    //     if(!empty($checkwatchdata)){
    //         $previous_watch_time = $checkwatchdata->real_time;
    //         $watchdata = array(
    //             // 'real_time'  => $previous_watch_time + $watch_time_different,
    //             'real_time'  => ($complete == 1?$Convertseconds:($previous_watch_time + $watch_ss_diff)),
    //             'is_complete'=> $complete,
    //         );
    //         $this->db->where('id',$checkwatchdata->id)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->update('watch_time_tbl', $watchdata);
           
    //         if(!empty($complete) ==1 ){
    //             echo $complete;
    //         }
    //     }else{
          
    //         $watchdata = array(
    //             // 'real_time'     => $previous_watch_time + $watch_time_different,
    //             // 'real_time'     => ($previous_watch_time?$previous_watch_time:0) + $watch_ss_diff,
    //             'real_time'     => (!empty($previous_watch_time)?$previous_watch_time:0) + $watch_ss_diff,
    //             'course_id'     => $course_id,
    //             'lesson_id'     => $lesson_id,
    //             'student_id'    => $student_id,
    //             'is_complete'   => $complete,
    //             'file_type'     => 1,
    //             'enterprise_id' => $enterprise_id
    //         );
    //         // dd($watchdata);
    //         $this->db->insert('watch_time_tbl', $watchdata);
    //         if(!empty($complete) ==1 ){
    //             echo $complete;
    //         }
    //     }
    //     // d($watchdata);
    //     // if(!empty($watchdata['is_complete']) ==1 ){
    //     //     echo $watchdata['is_complete'];
    //     // }
        
    // //    daily watch time calculate 
        
    //     $date=date('Y-m-d');
    //     $previous_watch_timedaily = 0;
    //     $dailywatchtimecheck = $this->db->where('course_id',$course_id)->where('lesson_id', $lesson_id)->where('student_id', $student_id)->where('date',$date)->where('enterprise_id',$enterprise_id)->get('daily_watch_time_tbl')->row();
       
        
    //     if(!empty($dailywatchtimecheck)){
    //         $previous_watch_timedaily = $dailywatchtimecheck->real_time;
    //         $previouswatchtime = $dailywatchtimecheck->studentwatchTime;
    //         $dailywatchdata = array(
    //             'real_time'         => $previous_watch_timedaily + $watch_time_different,
    //             'studentwatchTime'  => $previouswatchtime + $watch_ss_diff,
    //             'watchdatetime'        => date('Y-m-d H:i:s'),
    //         );
    //        // print_r($dailywatchdata);
    //         $this->db->where('id',$dailywatchtimecheck->id)->update('daily_watch_time_tbl',$dailywatchdata);
    //     }else{
    //         $dailywatch = array(
    //             'real_time'            => $previous_watch_timedaily + $watch_time_different,
    //             'studentwatchTime'     => (!empty($previouswatchtime )?$previouswatchtime :0)+ $watch_ss_diff,
    //             'course_id'            => $course_id,
    //             'lesson_id'            => $lesson_id,
    //             'student_id'           => $student_id,
    //             'date'                 => date('Y-m-d'),
    //             'watchdatetime'        => date('Y-m-d H:i:s'),
    //             'enterprise_id'        => $enterprise_id
    //         );
    //         $this->db->insert('daily_watch_time_tbl', $dailywatch);
    //     }


    // }

    public function lesson_textfilecompleted(){
        $enterprise_id     = $this->input->post('enterprise_id');
        $course_id         = $this->input->post('course_id');
        $lesson_id         = $this->input->post('lesson_id');
        $student_id        = $this->input->post('student_id');
        $checkcompletelesson = $this->db->where('course_id',$course_id)->where('lesson_id', $lesson_id)->where('student_id', $student_id)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->row();
        // print_r($checkcompletelesson);
        if(!empty($checkcompletelesson)){

            $completestatus = array(
                'real_time'     => '',
                'file_type'     =>0,
                'is_complete'   =>1,
                'enterprise_id' => $enterprise_id
            );
            $this->db->where('id',$checkcompletelesson->id)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->update('watch_time_tbl', $completestatus);
        }else{
            $completestatus = array(
                'real_time'     => '',
                'course_id'     => $course_id,
                'lesson_id'     => $lesson_id,
                'student_id'    => $student_id,
                'file_type'     =>0,
                'is_complete'   =>1,
                'enterprise_id' => $enterprise_id
            );
            $this->db->insert('watch_time_tbl', $completestatus);
        }
      echo "Successfully Lesson Complete";
    }
    // student dashboard interest save 
   public function interest_save(){

            $enterprise_id =$this->input->post('enterprise_id');
            $student_id =$this->input->post('user_id');
             $check_status =$this->input->post('ncategories');
            $category_id =$this->input->post('category_id');


            for($i = 0;$i < count($category_id);$i++){
                $single_cat = $category_id[$i];
                $checked_val = $check_status[$i];
                $checkexsisting=$this->db->select('*')->from("interests_topics_tbl")->where('category_id',$single_cat)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->get()->row();
                if($checkexsisting){
                    $interest = array(
                        'status'     =>$checked_val,
                    );
                  $this->db->where('id',$checkexsisting->id)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->update('interests_topics_tbl', $interest);
                }else{
                    if($checked_val==1){
                    $interest = array(
                        'category_id'     =>  $single_cat,
                        'student_id'    => $student_id,
                        'enterprise_id' => $enterprise_id,
                        'status' => $checked_val
                    );
                    $this->db->insert('interests_topics_tbl', $interest);
                   }
                }
            }
            echo 'Save Successfully';
          
        
   }

   public function socialIconOrdering(){
      
    $page_id_array =$this->input->post('page_id_array');
    $enterprise_id =$this->input->post('enterprise_id');
    $user_id =$this->input->post('user_id');

      for($i=0; $i<count($this->input->post('page_id_array')); $i++){
        $data=array(
            'ordering'=>$i
        );
           $this->db->where('id',$page_id_array[$i])
                ->where('enterprise_id',$enterprise_id)
                ->where('user_id',$user_id)
                ->update('certificate_mapping_tbl', $data);
      }
        echo 'Page Order has been updated'; 
   }

   public function nofity_counter(){
        $student_id=$this->input->post('user_id',true);
        $enterprise_id=$this->input->post('enterprise_id',true);

        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id                = $this->session->userdata('user_id');
        $notification_list =$this->db->select("*")->from('notifications_tbl')->where('isNotify',1)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->get()->result();
        $isnotify=0;
            foreach ($notification_list as $key => $value) {
                if($value->isNotify==1){
                    $isnotify++;
                }
            }
            echo $isnotify;

    }
   public function nofity_read(){
        $id=$this->input->post('id',true);
        $student_id=$this->input->post('user_id',true);
        $enterprise_id=$this->input->post('enterprise_id',true);

        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $user_id                = $this->session->userdata('user_id');
        // $notification_list =$this->db->select("*")->from('notifications_tbl')->where('notification_id',$id)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->get()->result();
        $data=array(
           'isNotify'=>0,
        );
      echo   $this->db->where('notification_id',$id)->where('student_id',$student_id)->where('enterprise_id',$enterprise_id)->update('notifications_tbl', $data);
        // print_r($notification_list);
        // exit;
        // $isnotify=0;
        //     foreach ($notification_list as $key => $value) {
        //         if($value->isNotify==1){
        //             $isnotify++;
        //         }
        //     }
        //     echo $isnotify;

    }

    public  function faq(){
        $data['title'] = display('faq');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_faqs'] = $this->Frontend_model->get_faqs(20, '', $enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/faq";
        echo Modules::run("template/frontend_layout", $data);
    }   
    
    public function blog(){
        $data['title'] = display('Forum');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        // dd($enterprise_id);
        $this->load->library('pagination');
        #pagination starts
        $config["base_url"]       = base_url($this->enterprise_shortname.'/blog'); 
        $config["total_rows"]     = $this->db->select('*')->from('forum_tbl')->where('enterprise_id', $enterprise_id)->where('status',1)->get()->num_rows(); 
        $config["per_page"]       = 10;
        $config["uri_segment"]    = 3; 
        $config["num_links"]      = 3;  
        /* This Application Must Be Used With BootStrap 4 * */
        $config['full_tag_open']  = "<ul class='pagination g-3'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open']   = '<li class="page-item">';
        $config['num_tag_close']  = '</li>';
        $config['cur_tag_open']   = "<li class='disabled page-item'><li class='page-item active'><a href='#' class='page-link'>";
        $config['cur_tag_close']  = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']  = "<li class='page-item'>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open']  = "<li class='page-item'>";
        $config['prev_tagl_close'] = "</li>";
        // $config['first_tag_open'] = "<li class='page-item'><a class='page-link'>";
        // $config['first_tagl_close'] = "</a></li>";
        $config['first_tag_open'] = "<li class='page-item'>";
        $config['first_tagl_close'] = "</li>";
        $config['attributes'] = array('class' => 'page-link');
        $config['last_tag_open']  = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>"; 
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['get_forumlist'] =$this->Frontend_model->forum_list($config["per_page"], $page,$enterprise_id) ;     
        $data["links"] = $this->pagination->create_links();
        // dd($data['get_forumlist']);


        $data['module'] = "frontend";
        $data['page'] = "themes/default/blog";
        echo Modules::run("template/frontend_layout", $data);
    }
    public function forum_details($forum_id){
        $data['title'] = display('Forum Details');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_forum_details'] = $this->db->select('a.*,a.title, b.picture,c.title as cat_name')
        ->from('forum_tbl a')
        ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
        ->join('forum_category_tbl c', 'c.forum_category_id = a.category_id', 'left')
        ->where('a.forum_id', $forum_id)
        ->where('a.enterprise_id', $enterprise_id)
        ->get()->row();
        $data['module'] = "frontend";
        $data['page'] = "themes/default/blog_details";
        echo Modules::run("template/frontend_layout", $data);      
    }
    public function forum_category($forum_cat_id){
       $data['title'] = display('Forum Details');
       $data['transfarentmenu'] = '';
       $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $this->load->library('pagination');
        #pagination starts
        $config["base_url"]       = base_url($this->enterprise_shortname.'/forum-category-page/'.$forum_cat_id); 
        $config["total_rows"]     = $this->db->select('*')->from('forum_tbl')->where('category_id', $forum_cat_id)->where('enterprise_id', $enterprise_id)->where('status',1)->get()->num_rows(); 
        $config["per_page"]       = 10;
        $config["uri_segment"]    = 4; 
        $config["num_links"]      = 2;  
        /* This Application Must Be Used With BootStrap 4 * */
        $config['full_tag_open']  = "<ul class='pagination g-3'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open']   = '<li class="page-item">';
        $config['num_tag_close']  = '</li>';
        $config['cur_tag_open']   = "<li class='disabled page-item'><li class='page-item active'><a href='#' class='page-link'>";
        $config['cur_tag_close']  = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']  = "<li class='page-item'>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open']  = "<li class='page-item'>";
        $config['prev_tagl_close'] = "</li>";
        // $config['first_tag_open'] = "<li class='page-item'><a class='page-link'>";
        // $config['first_tagl_close'] = "</a></li>";
        $config['first_tag_open'] = "<li class='page-item'>";
        $config['first_tagl_close'] = "</li>";
        $config['attributes'] = array('class' => 'page-link');
        $config['last_tag_open']  = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>"; 
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['forum_category'] =$this->Frontend_model->forum_category_wise_post($config["per_page"], $page,$enterprise_id,$forum_cat_id) ;     
        $data["links"] = $this->pagination->create_links();

      $data['module'] = "frontend";
      $data['page'] = "themes/default/blog_category";
      echo Modules::run("template/frontend_layout", $data);     
    }
    public function contact(){
        $data['title'] = display('faq');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_faqs'] = $this->Frontend_model->get_faqs(20, '', $enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/contact";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function submit_contact(){
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
      $name=  $this->input->post('name');
      $phoneNumber=  $this->input->post('phoneNumber');
      $emailAddress=  $this->input->post('emailAddress');
      $whoAmI=  $this->input->post('whoAmI');
      $organizationName=  $this->input->post('organizationName');
      $prefferedDate=  $this->input->post('prefferedDate');
      $reasonForCall=  $this->input->post('reasonForCall');
      $data=array(
          'name'=>$name,
          'mobile'=>$phoneNumber,
          'email'=>$emailAddress,
          'whoami'=>$whoAmI,
          'organization'=>$organizationName,
          'preffered_date'=>$prefferedDate,
          'message'=>$reasonForCall,
          'enterprise_id'=>$enterprise_id,
          'created_by'=>$enterprise_id,
          'created_date'=> date('Y-m-d H:i:s'),
      );
      $this->db->insert('contactus_tbl', $data);
      $app_setting = get_appsettings();
      $fromemail=$app_setting->email;
      $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();
        // dd($send_email);
      $config = array(
          'protocol'  => $send_email->protocol,
          'smtp_host' => $send_email->smtp_host,
          'smtp_port' => $send_email->smtp_port,
          'smtp_user' => $send_email->smtp_user,
          'smtp_pass' => $send_email->smtp_pass,
          'mailtype'  => $send_email->mailtype,
          'charset'   => 'utf-8',
          'wordwrap' => TRUE,
          'smtp_crypto'=>'tls'
        );
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $htmlContent="<!DOCTYPE html>
        <html>
        <head>
        </head>
        <body>
        <h2 style='text-align: center;width: 50%;'>Email</h2>
        <table style='border:1px solid #000;width: 50%;'>
          <tr>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Name:</td>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>$name</td>
          </tr>
           <tr>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>I am </td>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Teacher </td>
          </tr>
         <tr>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Phone No:</td>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>$phoneNumber</td>
          </tr>
          <tr>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Organization Name:</td>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>$organizationName</td>
          </tr>
          <tr>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Preffered date and Time:</td>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>$prefferedDate</td>
          </tr>
          <tr >
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>Reason for a call</td>
            <td style='border: 1px solid #dddddd;text-align: left;padding: 8px;'>$reasonForCall</td>
          </tr>
        </table>
        
        </body>
        </html>";
        $this->email->from("$fromemail",enterpriseinfo()->shortname);
        $this->email->to($emailAddress);
        $this->email->subject(enterpriseinfo()->shortname);
        $this->email->message($htmlContent);
        $this->email->send();

        echo "Send successfully!";
    //   echo "<pre>";
    //   print_r($data);
    //   exit;
    }

     public function projectlistcount($enterprise_id) {
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('is_visibility', 1);
        $this->db->where('type', 1);
        $count_query = $this->db->count_all_results('project_tbl');
        return $count_query;
    }

    public function project_list(){
        $data['title'] = display('projects');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);

        $config["base_url"] = base_url($this->enterprise_shortname.'/project-list/');
        $config["total_rows"] = $this->projectlistcount($enterprise_id);
        $config["per_page"] = 12;
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
        $data["get_projectlist"] = $this->Frontend_model->get_projectlist($config["per_page"], $page, $enterprise_id);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['module'] = "frontend";
        $data['page'] = "themes/default/project_list";
        echo Modules::run("template/frontend_layout", $data);
    }
       // ============ its for project_view =================
       public function project_view($project_id){
        $data['transfarentmenu'] = '1';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_appseeting'] = $this->Frontend_model->get_appseeting($enterprise_id);
        $data['get_projectsingledata'] = $this->Frontend_model->get_projectsingledata($project_id);
        $data['get_singleprojectdetails'] = $this->Frontend_model->get_singleprojectdetails($project_id);
        $data['get_studentinfo'] = get_studentinfo($data['get_projectsingledata']->created_by);
        
        $data['projectlikecount'] = get_projectlikecount($project_id, $enterprise_id);
        $data['projectcommentcount'] = get_projectcommentcount($project_id, $enterprise_id);
        $data['projectviewcount'] = get_projectviewcount($project_id, $enterprise_id);
        
        $data['module'] = "frontend";
        $data['page'] = "themes/default/students/student_project_view";
        echo Modules::run("template/frontend_layout", $data);
    }
     // ================ its for get_allprojectbytype ==============
     public function get_allprojectbytype(){
        $type = $this->input->post('type', True);
        // $data['mode'] = $this->input->post('mode', TRUE);
        $enterprise_id = $this->input->post('enterprise_id', TRUE);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', TRUE);
        $data['get_projectlist'] = $this->Frontend_model->get_allprojectbytype($type, $enterprise_id);

        $this->load->view('frontend/themes/default/get_allprojectbytype', $data);
    }
    public function comming_soon(){
        $data['title'] = display('faq');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['get_faqs'] = $this->Frontend_model->get_faqs(20, '', $enterprise_id);
        $data['module'] = "frontend";
        $data['page'] = "themes/default/coming-soon";
        echo Modules::run("template/frontend_layout", $data);
    }


    public function eventcount($enterprise_id) {
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('is_livecourse', 2);
        $this->db->where('status', 1);
        $count_query = $this->db->count_all_results('course_tbl');
        return $count_query;
    }

    public function eventlist(){
        $data['title'] = display('events');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        // d(getappsettings($enterprise_id));
        // dd($enterprise_id);
        $config["base_url"] = base_url($this->enterprise_shortname.'/eventlist/');
        $config["total_rows"] = $this->eventcount($enterprise_id);
        $config["per_page"] = 12;
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
        $data["get_eventlist"] = $this->Frontend_model->get_eventlist($config["per_page"], $page, $enterprise_id);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['module'] = "frontend";
        $data['page'] = "themes/default/eventlist";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function uniqueemailcheck() {
        $email = $this->input->post('email', true);
        $this->db->select('*')->from('loginfo_tbl');
        $this->db->where('email', $email);
        // $this->db->or_where('username', $email);
        $this->db->where('status', 1);
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        if ($query) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function learner(){        
        $data['title'] = display('learner');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $data['featuredin_list'] = $this->Frontend_model->featuredin_list($enterprise_id);
        $data['company_list'] = $this->Setting_model->company_list($enterprise_id);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/learner";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function instructor(){        
        $data['title'] = display('instructor');
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);

        $data['module'] = "frontend";
        $data['page'] = "themes/default/instructor";
        echo Modules::run("template/frontend_layout", $data);
    }

    public function show_assignmentDetails(){
        $data['title'] = 'Assignment Details';
        $data['transfarentmenu'] = '';
        $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $assignment_id = $this->input->post('assignment_id');
        $data["get_assignmentdetails"] = $this->Frontend_model->get_assignmentdetails($assignment_id);
        $data["get_projectmarks"] = $this->Frontend_model->get_projectmarks($assignment_id);

        
        $this->load->view('themes/default/show_assignment_details', $data);
    }
    
   public function subscription_expaired(){
    $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
        $allSubscription= $this->db->select("b.email,b.enterprise_id,b.student_id,a.invoice_id,(CASE WHEN datediff(a.expeiredate,CURDATE()) >0 then 
                        datediff(a.expeiredate,CURDATE()) ELSE '0' END) as Remaining_days_expired")
                        ->from("invoice_tbl a")
                        ->join('students_tbl b','b.student_id=a.customer_id')
                        ->where('a.is_subscription',1)
                        ->where('b.enterprise_id',$enterprise_id)
                        ->get()
                        ->result();

        foreach($allSubscription as $expiredSubscription){

            $course_site= $this->db->select("user_id,courses_site,courses_email,courses_sms")
            ->from('notification_config_tbl a')
            ->where('user_id',$expiredSubscription->student_id)
            ->get()->row();
         if($expiredSubscription->Remaining_days_expired == 5){
             if($course_site->courses_site==1){
                $data_nofi=array(
                    'notification_id'=>$expiredSubscription->invoice_id,
                    'student_id'=>$expiredSubscription->student_id,
                    'notification_type'=>9,
                    'created_date'=>date('Y-m-d H:i:s'),
                    'isNotify'=>1,
                    'enterprise_id'=>$expiredSubscription->enterprise_id,
                );
                $this->db->insert('notifications_tbl', $data_nofi);
             }
            if($course_site->courses_email==1){
                $to_email = $expiredSubscription->email;
                $to_mail_delivered = explode(',', $to_email);
                $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id', $expiredSubscription->enterprise_id)->get()->row();	
                $demo_email =$this->db->select("email")->from('setting')->where('enterprise_id', $expiredSubscription->enterprise_id)->get()->row();	
                    $config = array(
                        'protocol'  => $send_email->protocol,
                        'smtp_host' => $send_email->smtp_host,
                        'smtp_port' => $send_email->smtp_port,
                        'smtp_user' => $send_email->smtp_user,
                        'smtp_pass' => $send_email->smtp_pass,
                        'mailtype'  => $send_email->mailtype,
                        'charset'   => 'utf-8',
                        'wordwrap' => TRUE,
                        'smtp_crypto'=>'tls',
                    );
                    // d( $demo_email);
                    $this->load->library('email');
                    $this->email->initialize($config);
                    $this->email->set_newline("\r\n");
                    $this->email->set_mailtype("html");
                    $htmlContent="Your subscription package has been expired for 5 days left  please update it.";
                    $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,$this->enterprise_shortname);
                    $this->email->to($to_mail_delivered);
                    $this->email->subject($this->enterprise_shortname);
                    $this->email->message($htmlContent);
                    $this->email->send();
            }
        
          }
          
        if($expiredSubscription->Remaining_days_expired== 1){
             if($course_site->courses_site==1){
                $data_nofi=array(
                    'notification_id'=>$expiredSubscription->invoice_id,
                    'student_id'=>$expiredSubscription->student_id,
                    'notification_type'=>9,
                    'created_date'=>date('Y-m-d H:i:s'),
                    'isNotify'=>1,
                    'enterprise_id'=>$expiredSubscription->enterprise_id,
                );
                $this->db->insert('notifications_tbl', $data_nofi);
             }
            if($course_site->courses_email==1){
                $to_email = $expiredSubscription->email;
                $to_mail_delivered = explode(',', $to_email);
                $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id', $expiredSubscription->enterprise_id)->get()->row();	
                $demo_email =$this->db->select("email")->from('setting')->where('enterprise_id', $expiredSubscription->enterprise_id)->get()->row();	
                    $config = array(
                        'protocol'  => $send_email->protocol,
                        'smtp_host' => $send_email->smtp_host,
                        'smtp_port' => $send_email->smtp_port,
                        'smtp_user' => $send_email->smtp_user,
                        'smtp_pass' => $send_email->smtp_pass,
                        'mailtype'  => $send_email->mailtype,
                        'charset'   => 'utf-8',
                        'wordwrap' => TRUE,
                        'smtp_crypto'=>'tls',
                    );

                    $this->load->library('email');
                    $this->email->initialize($config);
                    $this->email->set_newline("\r\n");
                    $this->email->set_mailtype("html");
                    $htmlContent="Your subscription package has been expired for 1 day left  please update it.";
                    $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,$this->enterprise_shortname);
                    $this->email->to($to_mail_delivered);
                    $this->email->subject($this->enterprise_shortname);
                    $this->email->message($htmlContent);
                    $this->email->send();
            }
        
          }



        }
                    


   }



    
}