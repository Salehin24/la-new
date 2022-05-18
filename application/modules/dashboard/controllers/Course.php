<?php

defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Leadacademy Project
# Developed by : Md. Shahab uddin
#------------------------------------

class Course extends MX_Controller {

    private $user_id = "";
    private $user_type = "";
    private $vimeoClient;
    private $videoURL="";
    public function __construct() {
        parent::__construct();
        $this->load->library('Videoupload');
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model('Category_model');
        $this->load->model('Course_model');
        $this->load->model('Videoapi_model');
        $this->load->model('setting_model');
        $this->load->model('Faculty_model');
        $this->load->model('Student_model');
        $this->load->model('frontend/Instructor_model');
        
        $this->load->library('generators');

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        date_default_timezone_set($timezone);
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        // $pusher_config = $this->setting_model->pusher_config();
        $pusher_config = $this->setting_model->pusher_config(get_enterpriseid());

        $pusher_data = array(
            'api_id' => (!empty($pusher_config->api_id) ? $pusher_config->api_id : ''),
            'api_key' => (!empty($pusher_config->api_key) ? $pusher_config->api_key : ''),
            'secret_key' => (!empty($pusher_config->secret_key) ? $pusher_config->secret_key : ''),
            'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
        );
        $this->session->set_userdata($pusher_data);
        $options = array(
            'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
            'useTLS' => true
        );
        if ($pusher_config) {
            $this->pusher = new Pusher\Pusher(
                    $pusher_config->api_key, $pusher_config->secret_key, $pusher_config->api_id, $options
            );
        }


        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname . '/login');
    }

    public function index($course_id = null) {
        $this->permission->check_label('add_course', 'create')->redirect();
        $data['title'] = display('course');
        $data['get_languages'] = get_languages();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['get_category'] = $this->Category_model->get_category();
        $data['get_categoryforlibary'] = $this->Category_model->get_categoryforlibary();
        $data['get_course'] = $this->Course_model->get_course();
        $data['get_librarycourse'] = $this->db->select('a.*')->from('library_tbl a')->where('a.enterprise_id', get_enterpriseid())->order_by('a.id', 'desc')->get()->result();

        $course_id = $course_id; 
        // $data['course_id'] = $course_id;
        $data['course_wise_section'] = $this->Course_model->course_wise_section($course_id);
        $data["edit_data"] = $this->Course_model->edit_data($course_id);
        $data["get_assignexamlist"] = $this->Course_model->get_assignexamlist($course_id);
        $data["get_assignmentprojectlist"] = $this->Course_model->get_assignmentprojectlist($course_id);
        // dd($data["get_assignmentprojectlist"]);
        $data['module'] = "dashboard";
        $data['page'] = "course/course";
        echo modules::run('template/layout', $data);
    }

    // ================ its for category_wise_subcategory ==============
    public function category_wise_subcategory(){
        $category_id = $this->input->post('category_id', TRUE);
        $category_wise_subcategory = $this->Category_model->category_wise_subcategory($category_id, get_enterpriseid());
        
        echo "<option value=''>-- select one --</option>";
       foreach ($category_wise_subcategory as $value) {
           echo "<option value='$value->category_id'>$value->name</option>";
       }
    }

//    ============== its for course save  ==========
    public function course_save() {
        $course_id = "CO" . date('d') . $this->generators->generator(5);
        $name = $this->input->post('name', true);
        $slug = str_replace(" ", "-", strtolower($name));
        $slug = rtrim($slug, "-");
        $faculty_id = $this->input->post('faculty_id', true);
        $summary = $this->input->post('summary', true);
        $description = $this->input->post('description', true);
        $category_id = $this->input->post('category_id', true);
        $subcategory_id = $this->input->post('subcategory_id', TRUE);
        $category_id = (!empty($subcategory_id) ? $subcategory_id : $category_id);
        $course_level = $this->input->post('course_level', true);
        $course_type = $this->input->post('course_type', true);
        // dd($category_id);
        $language = $this->input->post('language', true);
        $course_material = $this->input->post('course_material', true);
        // $course_result = $this->input->post('course_result', true);
        // $course_isfor = $this->input->post('course_isfor', true);
        $career_outcomes = $this->input->post('career_outcomes', true);
        $skillsgain = $this->input->post('skillsgain', true);
        $related_resource = $this->input->post('related_resource', true);
        $related_courseid = $this->input->post('related_courseid', true);
        $related_courseid = (!empty($related_courseid) ? $related_courseid : 0);
        $is_popular = $this->input->post('is_popular', true);
        $is_popular = (($is_popular) ? "$is_popular" : "0");
        $is_new = $this->input->post('is_new', true);
        $is_new = (($is_new) ? "$is_new" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }
        // $commission = $this->input->post('commission', true);
        $requirements = $this->input->post('requirements', true);
        $benifits = $this->input->post('benifits', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : NULL);
        $discount_type = $this->input->post('discount_type', true);
        $is_discount = $this->input->post('is_discount', true);
        $is_discount = (($is_discount) ? "$is_discount" : "0");
        $discount = $this->input->post('discount', true);
        $discount = (!empty($discount) ? "$discount" : NULL);
        $is_offer = $this->input->post('is_offer', true);
        $is_offer = (($is_offer) ? "$is_offer" : "0");        
        $offer_courseid = $this->input->post('offer_courseid', true);
        $offer_courseprice = $this->input->post('offer_courseprice', true);
        // $offer_courseid = (!empty($offer_courseid) ? $offer_courseid : 0);
        
        // dd($offer_courseid);
        // $is_discount = '';
        // $discount = '';
        $course_provider = $this->input->post('course_provider', true);
        $url = $this->input->post('url', true);
        $thumbnail = $this->input->post('thumbnail', true);
        $question = $this->input->post('question', true);
        $qst_ans = $this->input->post('qst_ans', true);
        $syllabu = $this->input->post('syllabu', true);

        $passing_grade = $this->input->post('passing_grade', true);
        $meta_keyword = $name;
        $meta_description = $summary;

        // $video_url = $this->videoupload->do_upload(
        //     'assets/uploads/course/', 'url'
        // );
        //picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/course/', 'thumbnail', 'gif|jpg|png|jpeg|pdf|webp'
        );
        // cover thumbnail upload
        $cover_thumbnail = $this->fileupload->do_upload(
                'assets/uploads/course/', 'cover_thumbnail', 'gif|jpg|png|jpeg|pdf|webp'
        );
        // hover thumbnail upload
        $hover_thumbnail = $this->fileupload->do_upload(
                'assets/uploads/course/', 'hover_thumbnail', 'gif|jpg|png|jpeg|pdf|webp'
        );
        
        // syllabus upload
        $syllabus = $this->fileupload->do_upload(
            'assets/uploads/course/', 'syllabu','jpg|png|jpeg|pdf||svg|webp'
        );
        if($_FILES['syllabu']['name']){
            $syllabus_filename = $_FILES['syllabu']['name'];
        }
        
        // if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image, 398, 224
            );
            $thumbnail_name = $_FILES['thumbnail']['name'];
        }
        // if image is uploaded then resize the $cover_thumbnail
        if ($cover_thumbnail !== false && $cover_thumbnail != null) {
            $this->fileupload->do_resize(
                    $cover_thumbnail, 1903, 476
            );
            $cover_thumbnail_name = $_FILES['cover_thumbnail']['name'];
        }
        // if image is uploaded then resize the $hover_thumbnail
        if ($hover_thumbnail !== false && $hover_thumbnail != null) {
            $this->fileupload->do_resize(
                    $hover_thumbnail, 312, 345
            );
            $hover_thumbnail_name = $_FILES['hover_thumbnail']['name'];
        }

        $course_data = array(
            'course_id' => $course_id,
            'name' => $name,
            'faculty_id' => $faculty_id,
            'summary' => $summary,
            'description' => $description,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'course_level' => $course_level,
            'course_type' => json_encode($course_type),
            'language' => $language,
            'course_material' => $course_material,
            'course_result' => '', //$course_result,
            'course_isfor' => '', //$course_isfor,
            'career_outcomes' => json_encode($career_outcomes),
            'skillsgain' => json_encode($skillsgain),
            'related_resource' => json_encode($related_resource),
            'is_popular' => $is_popular,
            'is_new' => $is_new,
            'requirements' => json_encode($requirements),
            'benifits' => json_encode($benifits),
            'is_free' => $is_free,
            // 'commission' => $commission,
            'price' => $price,
            'oldprice' => $oldprice,
            'is_discount' => $is_discount,
            'discount_type' => $discount_type,
            'discount' => $discount,
            'is_offer' => $is_offer,
            'offer_courseprice' => $offer_courseprice,
            // 'offer_courseid' => json_encode($offer_courseid),
            'related_courseid' => json_encode($related_courseid),
            'course_provider' => $course_provider,
            'url' => $url, //$video_url,
            'cover_thumbnail' => $cover_thumbnail,
            'cover_thumbnail_name' => $cover_thumbnail_name,
            'hover_thumbnail' => $hover_thumbnail,
            'hover_thumbnail_name' => $hover_thumbnail_name,
            'syllabus' => $syllabus,
            'syllabus_filename' => $syllabus_filename,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'status' => $status,
            'is_draft' => 0,
            'passing_grade' => $passing_grade,
            'enterprise_id' => get_enterpriseid(),
            'created_date' => $this->createdtime,
            'created_by' => $this->user_id,
        );
        $this->db->insert('course_tbl', $course_data);


        // ========= its for offer courses start ==============
        if($offer_courseid){
            foreach($offer_courseid as $course){
                $offer_courses = array(
                    'course_id' => $course_id,
                    'course_offerid' => $course,
                    'created_by' => $this->user_id,
                    'created_date' => $this->createdtime,
                );
                $this->db->insert('course_offers_tbl', $offer_courses);
            }
        }
        // ========= its for offer courses close ==============

        activitiylog_save("Course Insert By", "Insert", $this->user_id, $this->createdtime);
        

        // send email to student start
    //    $allstudent= $this->db->select("*")
    //                          ->from('students_tbl a')
    //                           ->join('notification_config_tbl b', 'b.user_id = a.student_id', 'left')
    //                          ->where('b.courses_email',1)
    //                          ->where('a.enterprise_id',get_enterpriseid())
    //                          ->get()->result();
    //      $course_url=base_url(enterpriseinfo()->shortname."/course-details/".$course_id);
    //      $app_setting = get_appsettings();
    //      $fromemail=$app_setting->email;
    //      $studentcount=count($allstudent);
    //      for($i=0;$i<$studentcount;$i++)
    //      { 
    //          $to_email = $allstudent[$i]->email;
    //          $to_mail_delivered = explode(',', $to_email);
    //          $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
    //             $config = array(
    //                 'protocol'  => $send_email->protocol,
    //                 'smtp_host' => $send_email->smtp_host,
    //                 'smtp_port' => $send_email->smtp_port,
    //                 'smtp_user' => $send_email->smtp_user,
    //                 'smtp_pass' => $send_email->smtp_pass,
    //                 'mailtype'  => $send_email->mailtype,
    //                 'charset'   => 'utf-8',
    //                 'wordwrap' => TRUE,
    //                 'smtp_crypto'=>'tls',
    //             );
    //             $this->load->library('email');
    //             $this->email->initialize($config);
    //             $this->email->set_newline("\r\n");
    //             $this->email->set_mailtype("html");
    //             $htmlContent="New Course Name: <b>$name</b> and  New Course Link: <a href='$course_url'>Link</a>";
    //             $this->email->from("$fromemail", "enterpriseinfo()->shortname");
    //             $this->email->to($to_mail_delivered);
    //             $this->email->subject(enterpriseinfo()->shortname);
    //             $this->email->message($htmlContent);
    //             $this->email->send();
        
    //     }
        // send email to student end 

        if ($image) {
            $picture_data = array(
                'from_id' => $course_id,
                'picture' => $image,
                'filename' => $thumbnail_name,
                'picture_type' => 'course',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }

        $filesCount = count($_FILES['resource']['name']);
        
        $filecontent = [];
        if($filesCount > 0){
       for ($i = 0; $i < $filesCount; $i++) {
           if(!empty(@$_FILES['resource']['name'])){
           $uploadfile = (@$_FILES['resource']?count(@$_FILES['resource']['name']):0);
           if($uploadfile > $i){ 
           $_FILES['resourcefile']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['resource']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
           $_FILES['resourcefile']['type']     = $_FILES['resource']['type'][$i];
           $_FILES['resourcefile']['tmp_name'] = $_FILES['resource']['tmp_name'][$i];
           $_FILES['resourcefile']['error']    = $_FILES['resource']['error'][$i];
           $_FILES['resourcefile']['size']     = $_FILES['resource']['size'][$i];
  
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
           if ($this->upload->do_upload('resourcefile')) {
               $image_data = $this->upload->data();

               $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['resource']['name'][$i]); //$image_data['file_name'];
            // d($image_name);
               $config['image_library'] = 'gd2';
               $config['source_image'] = $image_data['full_path']; //get original image
               $config['maintain_ratio'] = TRUE;
               $config['height'] = 800;
               $config['width'] = 800;
               $this->load->library('image_lib', $config);
               $this->image_lib->clear();
               $this->image_lib->initialize($config);

               $filecontent[$i]['course_id'] = $course_id;
            //    $filecontent[$i]['lesson_id'] = '';
            //    $filecontent[$i]['chapter_id'] = '';
               $filecontent[$i]['files'] = $image_name;
               $filecontent[$i]['created_by'] = $this->user_id; 
           }
          }
       }
  
       }
    //    d($filecontent);
       if (!empty($filecontent)) {
            $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
        }
    }

        // if ($this->user_type == 3) {
        //     $get_pendingcourse = $this->db->select('count(course_id) as total_pending')->from('course_tbl')->where('status', 0)->get()->row();
        //     $data['count'] = $get_pendingcourse->total_pending;
        //     $data['message'] = 'course-pending';
        //     $this->pusher->trigger('my-channel', 'my-event', $data);
        // }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>added successfully, please continue section, lesson and exam assign if you want!</div>");
        // redirect(enterpriseinfo()->shortname . '/add-course/' . $course_id);
        redirect(enterpriseinfo()->shortname . '/course-edit/' . $course_id);
    }

//    ========= its for course datalist ===========
    public function course_datalist() {
        $postData = $_POST;
        $search = (object) array(
                    'name' => $this->input->post('name'),
                    'category_id' => $this->input->post('category_id'),
                    'course_id' => $this->input->post('course_id'),
                    'faculty_id' => $this->input->post('faculty_id'),
                    'course_status' => $this->input->post('course_status'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
        );
        // Get data
        $data = $this->getcoursedataList($postData, $search);
        echo json_encode($data);
    }

    public function total_coursecount($search = null, $searchQuery = null) {
        $this->db->select('a.*, b.name as category_name, c.name as faculty_name, c.user_types as usertype');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        // if ($this->user_type != 1) {
        //     $this->db->where('a.created_by', $this->user_id);
        // }
        $this->db->where('a.is_draft', 0);
        $this->db->where('a.is_livecourse', 0);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status !=", 3);

        $start_date = $search->start_date;
        $end_date = $search->end_date;
        $dateRange = "a.created_date BETWEEN '$start_date' AND '$end_date'";

        if ($search->category_id && $search->course_id && $search->faculty_id && $search->course_status && $search->start_date && $search->end_date) {
            $this->db->where('a.category_id', $search->category_id);
            $this->db->where('a.course_id', $search->course_id);
            $this->db->where('a.faculty_id', $search->faculty_id);
            $this->db->where('a.status', $search->course_status);
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($search->category_id && $search->course_id && $search->faculty_id && $search->course_status) {
            $this->db->where('a.category_id', $search->category_id);
            $this->db->where('a.course_id', $search->course_id);
            $this->db->where('a.faculty_id', $search->faculty_id);
            $this->db->where('a.status', $search->course_status);
        } elseif ($search->category_id && $search->course_id && $search->course_status) {
            $this->db->where('a.category_id', $search->category_id);
            $this->db->where('a.course_id', $search->course_id);
            $this->db->where('a.status', $search->course_status);
        } elseif ($search->start_date && $search->end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($search->category_id) {
            $this->db->where('a.category_id', $search->category_id);
        } elseif ($search->course_id) {
            $this->db->where('a.course_id', $search->course_id);
        } elseif ($search->faculty_id) {
            $this->db->where('a.faculty_id', $search->faculty_id);
        } elseif ($search->course_status){
            $this->db->where('a.status', $search->course_status);
        }

        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getcoursedataList($postData = null, $searchs = null) {
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
            $searchQuery = " (a.name like '%" . $searchValue . "%'
                    or b.name like '%" . $searchValue . "%'
                    or c.name like '%" . $searchValue . "%')
                    ";
        }
## Total number of records without filtering
        $totalRecords = $this->total_coursecount($searchs, $searchQuery);
## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*, a.name as course_name, b.name as category_name, c.name as faculty_name, c.user_types as usertype');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->join('category_tbl b', 'b.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');

        $this->db->where('a.is_draft', 0);
        $this->db->where('a.is_livecourse', 0);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status !=", 3);

        $start_date = $searchs->start_date;
        $end_date = $searchs->end_date;
        $dateRange = "a.created_date BETWEEN '$start_date' AND '$end_date'";
        if ($searchs->category_id && $searchs->course_id && $searchs->faculty_id && $searchs->course_status && $searchs->start_date && $searchs->end_date) {
            $this->db->where('a.category_id', $searchs->category_id);
            $this->db->where('a.course_id', $searchs->course_id);
            $this->db->where('a.faculty_id', $searchs->faculty_id);
            $this->db->where('a.status', $searchs->course_status);
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($searchs->category_id && $searchs->course_id && $searchs->faculty_id && $searchs->course_status) {
            $this->db->where('a.category_id', $searchs->category_id);
            $this->db->where('a.course_id', $searchs->course_id);
            $this->db->where('a.faculty_id', $searchs->faculty_id);
            $this->db->where('a.status', $searchs->course_status);
        }elseif ($searchs->category_id && $searchs->course_id && $searchs->course_status) {
            $this->db->where('a.category_id', $searchs->category_id);
            $this->db->where('a.course_id', $searchs->course_id);
            $this->db->where('a.status', $searchs->course_status);
        } elseif ($searchs->start_date && $searchs->end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($searchs->category_id) {
            $this->db->where('a.category_id', $searchs->category_id);
        } elseif ($searchs->course_id) {
            $this->db->where('a.course_id', $searchs->course_id);
        } elseif ($searchs->faculty_id) {
            $this->db->where('a.faculty_id', $searchs->faculty_id);
        } elseif ($searchs->course_status) {
            $this->db->where('a.status', $searchs->course_status);
        }
        // d($columnSortOrder);
        // d($testColumn);
        // $this->db->order_by('a.id', 'desc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        // echo $this->db->last_query();exit();
        $records = $this->db->get()->result();

        $data = array();
        // dd($records);
        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $course_wise_sectioncount = $this->Course_model->course_wise_sectioncount($record->course_id);
            $course_wise_lessoncount = $this->Course_model->course_wise_lessoncount($record->course_id);
            // $course_totalsales = $this->Course_model->course_totalsales($record->course_id);
            // $statusbtn = '';

            $coursedetalslink = $facultylink = $lesson_section = $statusbtn = $inactivestatusbtn = $activestatusbtn = $resizebtn = $editbtn = $sectionbtn = $lessonbtn = $deletebtn = $action = $sharepercentbtn = $tagstatusbtn = $courseviewbtn = $rejectbtn = $agreement_status = '';
            $categorybtn = '<a href="javascript:void(0)" onclick="showcategory(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >' . (!empty($record->category_name) ? $record->category_name : " ") . '</a>';
            $facultylink = '<a href="javascript:void(0)" onclick="showinstructor(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >' . (!empty($record->faculty_name) ? $record->faculty_name : " ") . '</a>';

            // $coursedetalslink = '<a href="' . base_url("/course-details/" . $record->course_id . '/' . $record->slug) . '" data-toggle="tooltip" title="Course Details" target="_new">' . $record->name . '</a>';
            $coursedetalslink = '<a href="' . base_url(enterpriseinfo()->shortname . "/course-edit/" . $record->course_id) . '" data-toggle="tooltip" title="Course Details">' . $record->name . '</a>';

            // $facultylink = '<a href="' . base_url("/faculty-info/" . $record->faculty_id) . '" data-toggle="tooltip" title="Faculty Info" target="_new">' . $record->faculty_name . '</a>';
            // $facultylink = '<a href="javascript:void(0)" data-toggle="tooltip" title="Faculty Info" >' . $record->faculty_name . '</a>';

            $lesson_section = '<strong>Total Section : </strong>' . $course_wise_sectioncount . '<br> <strong>Total Lesson : </strong> ' . $course_wise_lessoncount;

            // if($record->status == 1){
            //     $activestatusbtn = '<a href="javascript:void(0)" data-toggle="tooltip" title="Already Approved" class="text-white" disabled style="pointer-events: none"><i class="fa fa-check btn btn-sm btn-secondary"></i></a>';
            // }else{
            //     $activestatusbtn = '<a href="javascript:void(0)" onclick="courseactive(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
            // }
   
            // if($record->status == 2){
            //     $inactivestatusbtn = '<a href="javascript:void(0)" data-toggle="tooltip"  title="Already Disapproved" class="text-white" disabled style="pointer-events: none"><i class="fa fa-times btn btn-sm btn-secondary"></i></a>';
            // }else{
            //     $inactivestatusbtn = '<a href="javascript:void(0)" onclick="courseinactive(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip"  title="' . display('disapprove') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            // }
            

            if($record->status == 1 || $record->status == 2){
                // $statusbtn = 'C Name '. $record->course_name. ' ' .$record->course_id . ' KK '. $record->status;
                if ($record->status == 1) {
                    $statusbtn = '<a href="javascript:void(0)" onclick="courseinactive(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
                } elseif ($record->status == 2) {
                    $statusbtn = '<a href="javascript:void(0)" onclick="courseactive(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
                }
                $rejectbtn = '<a href="javascript:void(0)" onclick="coursereject(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="Course Reject" class="text-white"><i class="fa fa-times btn btn-sm btn-danger"></i></a>';
            }
          
            $resizebtn = '<a href="javascript:void(0)" onclick="addresize_form(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('resize') . '" class="text-white"><i class="fab fa-r-project btn-primary btn btn-sm"></i></a>';
            $sectionbtn = '<a href="javascript:void(0)" onclick="addsection_form(' . "'" . $record->course_id . "'," . "'" . 1 . "'" . ')" data-toggle="tooltip" title="' . display('add_section') . '" class="text-white"><i class="fab fa-artstation btn-primary  btn btn-sm"></i></a>';
            $lessonbtn = '<a href="javascript:void(0)" onclick="addlesson_form(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('add_lesson') . '" class="text-white"><i class="fab fa-adn btn-info  btn btn-sm"></i></a>';
            $sharepercentbtn = '<a href="javascript:void(0)" onclick="sharepercent_form(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('share_percent') . '" class="text-white"><i class="fas fa-share-square btn-primary  btn btn-sm"></i></a>';
            $tagstatusbtn = '<a href="javascript:void(0)" onclick="tagstatus_form(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="Tag Status" class="text-white"><i class="fas fa-align-justify btn-primary  btn btn-sm"></i></a>';
            $courseviewbtn = '<a href="javascript:void(0)" onclick="course_preview(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="Course Preview" class="text-white"><i class="fas fa-eye btn-primary  btn btn-sm"></i></a>';

            $ispopular = (($record->is_popular == 1) ? $record->is_popular : 0);
            // $ispopularstatus = (($record->is_popular == 1) ? 'checked' : '');
            // $ispopularbtn = '<div class="checkbox-success">
            //                     <input id="is_popular_'.$sl.'" name="is_popular" type="checkbox" value="'.$ispopular.'" '.$ispopularstatus.' onclick="coursepopularstatus('."'$record->course_id', '$sl'".')"> Is Popular
            //                 </div>';

            // $isnew = (($record->is_new == 1) ? $record->is_new : 0);
            // $isnewstatus = (($record->is_new == 1) ? 'checked' : '');
            // $isnewbtn = '<div class="checkbox-success">
            //                 <input id="is_new_'.$sl.'" name="is_new" type="checkbox" value="'.$isnew.'" '.$isnewstatus.' onclick="coursenewstatus('."'$record->course_id', '$sl'".')"> Is New
            //             </div>';
                            
            
            if ($this->permission->check_label('course_list')->update()->access()) {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname . "/course-edit/" . $record->course_id) . '" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            }
            if ($this->permission->check_label('course_list')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="course_delete(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            }

            $action = $courseviewbtn . ' &nbsp; ' . $sharepercentbtn .' '. $statusbtn .'  ' . $rejectbtn . ' &nbsp; ' . $editbtn . ' &nbsp; ' . $deletebtn;
            $created_date = (($record->created_date) ? date('d-m-Y H:m:s', strtotime($record->created_date)) : '');
            $updated_date = (($record->updated_date) ? date('d-m-Y H:m:s', strtotime($record->updated_date)) : '');
            // if(($record->published_date != null)){
                $published_date = (($record->published_date) ? date('d-m-Y H:m:s', strtotime($record->published_date)) : '');
                // $published_date = $record->published_date; 
            // }
                $feedback = (!empty($record->feedback)  ? $record->feedback : '');
                if($record->agreement_status == 1){
                    $agreement_status = 'Pending';
                }elseif($record->agreement_status == 2){
                    $agreement_status = 'Approved';
                }elseif($record->agreement_status == 3){
                    $agreement_status = 'Instructor Submitted';
                }elseif($record->agreement_status == 4){
                    $agreement_status = 'Rejected';
                }

            $data[] = array(
                "sl" => $sl++,
                "course_name" => $coursedetalslink, //$record->name,
                "category_name" => $categorybtn, //$record->category_name,
                "faculty_name" => $facultylink, //$record->faculty_name,
                // "totalsales" => $course_totalsales->totalsales,
                "lesson_section" => $lesson_section,
                "agreement_status" => $agreement_status,
                'feedback' => substr($feedback,0,50).'...',
                'created_by' => (!empty(get_userinfo($record->created_by)) ? get_userinfo($record->created_by)->name : '') . ' <br> '. $created_date,
                'updated_by' => (!empty(get_userinfo($record->updated_by)) ? get_userinfo($record->updated_by)->name : '') . ' <br> '. $updated_date,
                'published_by' => (!empty(get_userinfo($record->published_by)) ? get_userinfo($record->published_by)->name : '') . ' <br> '. $published_date,
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

//    ============= its for my course count ===============
    public function course_count($user_id, $user_type) {
        if ($user_type != 1) {
            $this->db->where('created_by', $user_id);
            $this->db->where('is_livecourse', 0);
        }
        $count_query = $this->db->count_all_results('course_tbl');
        return $count_query;
    }

    public function course_list() {
        $data['title'] = display('course_list');
        $data['get_category'] = $this->Category_model->get_category();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        // $data['get_course'] = $this->Course_model->get_course();
        $data['course_quickview'] = $this->Course_model->course_quickview($this->user_id, $this->user_type);
        $data['total_course'] = $this->course_count($this->user_id, $this->user_type);

//        dd($data['total_course']);
//        $config["base_url"] = base_url('course-list/');
//        $config["total_rows"] = $this->course_count($this->user_id, $this->user_type);
//        $config["per_page"] = 50;
//        $config["uri_segment"] = 2;
//        $config["last_link"] = "Last";
//        $config["first_link"] = "First";
//        $config['next_link'] = 'Next';
//        $config['prev_link'] = 'Prev';
//        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
//        $config['full_tag_close'] = '</ul></nav></div>';
//        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
//        $config['num_tag_close'] = '</span></li>';
//        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
//        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
//        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
//        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
//        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
//        $config['prev_tagl_close'] = '</span></li>';
//        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
//        $config['first_tagl_close'] = '</span></li>';
//        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
//        $config['last_tagl_close'] = '</span></li>';
//        /* ends of bootstrap */
//        $this->pagination->initialize($config);
//        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
//        $data["course_list"] = $this->Course_model->course_list($config["per_page"], $page, $this->user_id, $this->user_type);
//        $data["links"] = $this->pagination->create_links();
//        $data['pagenum'] = $page;

        $data['module'] = "dashboard";
        $data['page'] = "course/course_list";
        echo modules::run('template/layout', $data);
    }

//    ============ its for course_filter ===========
    public function course_filter() {
        $category_id = $this->input->post('category_id', TRUE);
        $course_id = $this->input->post('course_id', TRUE);
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);
        $data['course_list'] = $this->Course_model->course_filter($category_id, $course_id, $start_date, $end_date, $this->user_id, $this->user_type);

        $this->load->view('course/course_list_filter', $data);
    }

    public function course_edit($course_id) {
        $data['title'] = display('course_edit');
        $data['get_languages'] = get_languages();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['get_category'] = $this->Category_model->get_category();
        $data['get_course'] = $this->Course_model->get_course();
        $data['get_offercourses'] = $this->Course_model->get_offercourses($course_id);
        $data['course_wise_section'] = $this->Course_model->course_wise_section($course_id);
        $data["edit_data"] = $this->Course_model->edit_data($course_id);
        $data["get_courseresource"] = $this->Course_model->get_courseresource($course_id);
        // dd($data["edit_data"]);
        $data["get_assignexamlist"] = $this->Course_model->get_assignexamlist($course_id);
        $data["get_assignmentprojectlist"] = $this->Course_model->get_assignmentprojectlist($course_id);
        // $data["courseQuiz"] = $this->Course_model->courseQuiz($course_id);
        if($data["edit_data"]->subcategory_id){
            $data['get_parentcategoryid'] = $this->db->select('parent_id')->where('category_id', $data["edit_data"]->subcategory_id)->get('category_tbl')->row();
            $data['parent_id'] = $data['get_parentcategoryid']->parent_id;
        }else{
            $data['parent_id'] = $data["edit_data"]->category_id;
        }
        $data['category_wise_subcategory'] = $this->Category_model->category_wise_subcategory($data['parent_id'], get_enterpriseid());
        // dd($data['get_assignmentprojectlist']);
        $data['module'] = "dashboard";
        $data['page'] = "course/course_edit";
        echo modules::run('template/layout', $data);
    }

//    ============= its for course_update =============
    public function course_update() {
        $course_id = $this->input->post('course_id', true);
        $name = $this->input->post('name', true);
        $slug = str_replace(" ", "-", strtolower($name));
        $slug = rtrim($slug, "-");
        $faculty_id = $this->input->post('faculty_id', true);
        $summary = $this->input->post('summary', true);
        $description = $this->input->post('description', true);
        $category_id = $this->input->post('category_id', true);
        $subcategory_id = $this->input->post('subcategory_id', true);        
        $category_id = (!empty($subcategory_id) ? $subcategory_id : $category_id);
        $course_level = $this->input->post('course_level', TRUE);
        $course_type = $this->input->post('course_type', TRUE);
        $language = $this->input->post('language', true);
        $course_material = $this->input->post('course_material', true);
        // $course_result = $this->input->post('course_result', true);
        // $course_isfor = $this->input->post('course_isfor', true);
        $career_outcomes = $this->input->post('career_outcomes', true);
        $skillsgain = $this->input->post('skillsgain', true);
        $related_resource = $this->input->post('related_resource', true);
        
        // $offer_courseid = $this->input->post('offer_courseid', true);
        // $offer_courseid = (!empty($offer_courseid) ? $offer_courseid : 0);

        $related_courseid = $this->input->post('related_courseid', true);
        $related_courseid = (!empty($related_courseid) ? $related_courseid : 0);

        $is_popular = $this->input->post('is_popular', true);
        $is_popular = (($is_popular) ? "$is_popular" : "0");
        $is_new = $this->input->post('is_new', true);
        $is_new = (($is_new) ? "$is_new" : "0");

        // $commission = $this->input->post('commission', true);

        $requirements = $this->input->post('requirements', true);

        $benifits = $this->input->post('benifits', true);
    
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $oldprice = $this->input->post('oldprice', true);        
        $oldprice = (!empty($oldprice) ? "$oldprice" : NULL);
        
        $discount_type = $this->input->post('discount_type', true);
        $is_discount = $this->input->post('is_discount', true);
        $is_discount = (($is_discount) ? $is_discount : "0");
        $discount = $this->input->post('discount', true); 
        $discount = (!empty($discount) ? "$discount" : NULL);

        $is_offer = $this->input->post('is_offer', true);
        $is_offer = (($is_offer) ? "$is_offer" : "0");        
        $offer_courseid = $this->input->post('offer_courseid', true);
        $offer_courseprice = $this->input->post('offer_courseprice', true);

        $course_provider = $this->input->post('course_provider', true);
        $url = $this->input->post('url', true);
        $old_url = $this->input->post('old_url', true);
        $thumbnail = $this->input->post('thumbnail', true);

        $question = $this->input->post('question', true);
        $qst_ans = $this->input->post('qst_ans', true);
        $passing_grade = $this->input->post('passing_grade', true);
        $meta_keyword = $name;
        $meta_description = $summary;

        // $old_url = $this->input->post('old_url', True);
        // $video_url = $this->videoupload->do_upload(
        //         'assets/uploads/course/', 'url'
        // );
        

        //picture upload
        $old_thumbnail = $this->input->post('old_thumbnail', True);
        $image = $this->fileupload->update_doupload(
                $course_id, 'assets/uploads/course/', 'thumbnail', 'gif|jpg|png|jpeg|pdf|webp'
        );
          
        if ($image !== false && $image != null) {
            $thumbnail_name = $_FILES['thumbnail']['name'];
            $this->fileupload->do_resize(
                 $image,398,224
            );
        }

        //cover_thumbnail upload
        $old_cover_thumbnail = $this->input->post('old_cover_thumbnail', True);
        $old_cover_thumbnail_name = $this->input->post('old_cover_thumbnail_name', True);

        $config['upload_path'] = './assets/uploads/course/'.date('Y-m-d') . "/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|webp';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('cover_thumbnail')) {
			$data = $this->upload->data();
			$cover_thumbnail = $config['upload_path'] . $data['file_name'];
            if ($cover_thumbnail !== false && $cover_thumbnail != null) {
                $this->fileupload->do_resize(
                     $cover_thumbnail,1903,476
                );
            }
            $config['encrypt_name'] = true;
			$config['image_library'] = 'gd2';
			$config['source_image'] = $cover_thumbnail;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = TRUE;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
		}
      //cover_thumbnail upload end

        //hover_thumbnail upload
        $old_hover_thumbnail = $this->input->post('old_hover_thumbnail', True);
        $old_hover_thumbnail_name = $this->input->post('old_hover_thumbnail_name', True);

        $config['upload_path'] = './assets/uploads/course/'.date('Y-m-d') . "/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|webp';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('hover_thumbnail')) {
			$data = $this->upload->data();
			$hover_thumbnail = $config['upload_path'] . $data['file_name'];
            if ($hover_thumbnail !== false && $hover_thumbnail != null) {
                $this->fileupload->do_resize(
                     $hover_thumbnail,312,345
                );
            }
            $config['encrypt_name'] = true;
			$config['image_library'] = 'gd2';
			$config['source_image'] = $hover_thumbnail;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = TRUE;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
		}
      //cover_thumbnail upload end

      $old_syllabus = $this->input->post('old_syllabus', True);
      $old_syllabus_filename = $this->input->post('old_syllabus_filename', True);
      
        $syllabus = '';
        $config['upload_path'] = './assets/uploads/course/'.date('Y-m-d') . "/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|webp';
		$this->load->library('upload', $config);
        if ($this->upload->do_upload('syllabus')) {
			$data = $this->upload->data();
			$syllabus = $config['upload_path'] . $data['file_name'];
            $config['encrypt_name'] = true;
			$config['image_library'] = 'gd2';
			$config['source_image'] = $syllabus;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = TRUE;
			$this->load->library('image_lib', $config);
			// $this->image_lib->resize();
		}
        //  dd($config['upload_path']);
        // d($old_syllabus);
      //syllabus upload end
        $course_data = array(
            'name' => $name,
            'faculty_id' => $faculty_id,
            'summary' => $summary,
            'description' => $description,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'course_level' => $course_level,
            'course_type' => json_encode($course_type),
            'language' => $language,
            'course_material' => $course_material,
            'course_result' => '', //$course_result,
            'course_isfor' => '', //$course_isfor,
            'career_outcomes' => json_encode($career_outcomes),
            'skillsgain' => json_encode($skillsgain),
            'related_resource' => json_encode($related_resource),
            'is_popular' => $is_popular,
            'is_new' => $is_new,
            'requirements' => json_encode($requirements),
            'benifits' => json_encode($benifits),
            // 'commission' => $commission,
            'is_free' => $is_free,
            'price' => $price,
            'oldprice' => $oldprice,
            'is_discount' => $is_discount,
            'discount_type' => $discount_type,
            'discount' => $discount,
            'is_offer' => $is_offer,
            'offer_courseprice' => $offer_courseprice,
            // 'offer_courseid' => json_encode($offer_courseid),
            'related_courseid' => json_encode($related_courseid),
            'course_provider' => $course_provider,
            'url' =>  (!empty($url) ? $url : $old_url),
            'cover_thumbnail' => (!empty($cover_thumbnail) ? $cover_thumbnail : $old_cover_thumbnail), //$cover_thumbnail,
            'cover_thumbnail_name' => (!empty($_FILES['cover_thumbnail']['name']) ? $_FILES['cover_thumbnail']['name'] : $old_cover_thumbnail_name),
            'hover_thumbnail' => (!empty($hover_thumbnail) ? $hover_thumbnail : $old_hover_thumbnail), //$hover_thumbnail,
            'hover_thumbnail_name' => (!empty($_FILES['hover_thumbnail']['name']) ? $_FILES['hover_thumbnail']['name'] : $old_hover_thumbnail_name),
            'syllabus' => (!empty($syllabus) ? $syllabus : $old_syllabus), //$syllabus,
            'syllabus_filename' => (!empty($_FILES['syllabus']['name']) ? $_FILES['syllabus']['name'] : $old_syllabus_filename),
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'passing_grade' => $passing_grade,
            'enterprise_id' => get_enterpriseid(),
            'updated_date' => $this->createdtime,
            'updated_by' => $this->user_id,
        );
        // dd($course_data);

        $this->db->where('course_id', $course_id)->update('course_tbl', $course_data);

        
        // ========= its for offer courses start ==============
            $this->db->where('course_id', $course_id)->delete('course_offers_tbl');
        if($is_offer == 1){
            
            foreach($offer_courseid as $course){
                $offer_courses = array(
                    'course_id' => $course_id,
                    'course_offerid' => $course,
                    'created_by' => $this->user_id,
                    'created_date' => $this->createdtime,
                );
                $this->db->insert('course_offers_tbl', $offer_courses);
            }
        }


        activitiylog_save($name . " Course Updated By", "Update", $this->user_id, $this->createdtime);

        // $checkCourseQuiz = $this->db->select('course_id')->from('coursequiz_tbl')->where('course_id', $course_id)->get()->row();
        // if ($checkCourseQuiz) {
        //     $this->db->where('course_id', $course_id)->delete('coursequiz_tbl');
        // }
        // $count_question = count($question);
        // for ($i = 0; $i < $count_question; $i++) {
        //     $quizdata = array(
        //         'course_id' => $course_id,
        //         'quiz' => $question[$i],
        //         'ans' => $qst_ans[$i],
        //         'status' => 1,
        //         'created_by' => $this->user_id,
        //         'created_at' => $this->createdtime,
        //     );
        //     if (!empty($quizdata)) {
        //         $this->db->insert('coursequiz_tbl', $quizdata);
        //     }
        // }

        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $course_id)->get()->row();

        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => (!empty($image) ? $image : $old_thumbnail), //$image,
                    'filename' => $this->input->post('old_thumbnail_name'),
                    'picture_type' => 'course',
                    'status' => 1,
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $course_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $course_id,
                    'picture' => (!empty($image) ? $image : $old_thumbnail), //$image,
                    'filename' => $thumbnail_name,
                    'picture_type' => 'course',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }

        $filesCount = count($_FILES['resource']['name']);
        
        $filecontent = [];
        if($filesCount > 0){
       for ($i = 0; $i < $filesCount; $i++) {
           if(!empty(@$_FILES['resource']['name'])){
           $uploadfile = (@$_FILES['resource']?count(@$_FILES['resource']['name']):0);
           if($uploadfile > $i){ 
           $_FILES['resourcefile']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['resource']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
           $_FILES['resourcefile']['type']     = $_FILES['resource']['type'][$i];
           $_FILES['resourcefile']['tmp_name'] = $_FILES['resource']['tmp_name'][$i];
           $_FILES['resourcefile']['error']    = $_FILES['resource']['error'][$i];
           $_FILES['resourcefile']['size']     = $_FILES['resource']['size'][$i];
  
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
           if ($this->upload->do_upload('resourcefile')) {
               $image_data = $this->upload->data();

               $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['resource']['name'][$i]); //$image_data['file_name'];
            // d($image_name);
               $config['image_library'] = 'gd2';
               $config['source_image'] = $image_data['full_path']; //get original image
               $config['maintain_ratio'] = TRUE;
               $config['height'] = 800;
               $config['width'] = 800;
               $this->load->library('image_lib', $config);
               $this->image_lib->clear();
               $this->image_lib->initialize($config);

               $filecontent[$i]['course_id'] = $course_id;
            //    $filecontent[$i]['lesson_id'] = '';
            //    $filecontent[$i]['chapter_id'] = '';
               $filecontent[$i]['files'] = $image_name;
               $filecontent[$i]['created_by'] = $this->user_id; 
           }
          }
       }
  
       }
       if (!empty($filecontent)) {
           //d($filecontent);
            $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
        }
    }
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Course updated successfully!</div>");
        redirect(enterpriseinfo()->shortname . '/course-list');
    }
//    =============== its for add section ==============
    public function addsection_form() {
        $data['course_id'] = $this->input->post('course_id', true);
        $data['mode'] = $this->input->post('mode', true);

        $this->load->view('dashboard/course/add_section', $data);
    }


//    ============ its for section_save =========
    public function section_save() {
        $mode = $this->input->post('mode', true);
        $course_id = $this->input->post('course_id', true);
        $sections = $this->input->post('section_name', true);

        foreach ($sections as $section) {
            $check_section = $this->Course_model->check_section($course_id, $section);
            $section_id = "SE" . date('d') . $this->generators->generator(5);
            $section_data = array(
                'section_id' => $section_id,
                'course_id' => $course_id,
                'section_name' => $section,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            if (empty($check_section)) {
                $this->db->insert('section_tbl', $section_data);
                activitiylog_save($section_name . " Section Insert By", "Insert", $this->user_id, $this->createdtime);
            }
        }
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Added successfully!</div>");
        if ($mode == 1) {
            redirect(enterpriseinfo()->shortname . '/course-list');
        } elseif ($mode == 2) {
            redirect(enterpriseinfo()->shortname . '/course-edit/' . $course_id);
        } elseif ($mode == 3) {
            redirect(enterpriseinfo()->shortname . '/add-course/' . $course_id);
        }

        // if ($check_section) {
        //     echo display('already_exists');
        // } else {
        //     $section_data = array(
        //         'section_id' => $section_id,
        //         'course_id' => $course_id,
        //         'section_name' => $section_name,
        //         'enterprise_id' => get_enterpriseid(),
        //         'created_date' => $this->createdtime,
        //         'created_by' => $this->user_id,
        //     );
        //     $this->db->insert('section_tbl', $section_data);
        //     activitiylog_save($section_name ." Section Insert By", "Insert", $this->user_id, $this->createdtime);
        //     echo display('section_added_successfully');
        // }
    }

//    =============== its for edit section ==============
    public function editsection_form() {
        $section_id = $this->input->post('section_id', true);
        $data['section_editdata'] = $this->Course_model->section_editdata($section_id);

        $this->load->view('dashboard/course/edit_section', $data);
    }

//    ======== its for section update =============
    public function section_update() {
        $section_id = $this->input->post('section_id', true);
        $section_name = $this->input->post('section_name', true);
        $section_data = array(
            'section_name' => $section_name,
            'enterprise_id' => get_enterpriseid(),
            'updated_date' => $this->createdtime,
            'updated_by' => $this->user_id,
        );
        $this->db->where('section_id', $section_id)->update('section_tbl', $section_data);
        activitiylog_save($section_name . " Section Update By", "Update", $this->user_id, $this->createdtime);
        echo display('section_updated_successfully');
    }

//    ============== its for section_delete ==========
    public function section_delete() {
        $course_id = $this->input->post('course_id', true);
        $section_id = $this->input->post('section_id', true);
        $courseIsinvoice = $this->Course_model->courseIsinvoice($course_id);
        $section_wise_lesson = $this->Course_model->section_wise_lesson($section_id);
        if ($courseIsinvoice || $section_wise_lesson) {
            echo 0;
        } else {
            $this->db->where('section_id', $section_id)->delete('section_tbl');
            activitiylog_save(" Section Delete By", "Delete", $this->user_id, $this->createdtime);
            echo 1;
        }
    }

//    =============== its for add lesson ==============
    public function addlesson_form() {
        $data['course_id'] = $this->input->post('course_id', true);
        $data['course_wise_section'] = $this->Course_model->course_wise_section($data['course_id']);

        $this->load->view('dashboard/course/add_lesson', $data);
    }

//    ============= its for get video details ==============
    public function get_video_details() {
        $data['setting'] = $this->setting_model->read(get_enterpriseid());
        $data['lesson_provider'] = $this->input->post('lesson_provider', true);
        $data['video_url'] = $this->input->post('video_url', true);

        $video_details = $this->Videoapi_model->video_details($data);

        echo json_encode($video_details);
    }

//    ========== its for lesson save ============
    public function lesson_save() {
        $lesson_id = "LE" . date('d') . $this->generators->generator(5);
        $course_id = $this->input->post('course_id', true);
        $lesson_name = $this->input->post('lesson_name', true);
        $section_id = $this->input->post('section_id', true);
        $lesson_type = $this->input->post('lesson_type', true);
        $lesson_provider = $this->input->post('lesson_provider', true);
        $attachment = $this->input->post('attachment', TRUE);
        $provider_url = $this->input->post('provider_url', true);
        $duration = $this->input->post('duration', true);
        $summary = $this->input->post('summary', true);
        $description = $this->input->post('description', true);
        $is_preview = $this->input->post('is_preview', true);
        $is_preview = (($is_preview) ? "$is_preview" : "0");



        if ($duration) {
            $duration = $duration;
        } else {
            $duration = "00:00:00";
        }
        $get_lessoninfo = $this->db->select_max("lesson_order")->from('lesson_tbl')->where('course_id', $course_id)->get()->row();
        if($get_lessoninfo ){
            $lesson_order = ($get_lessoninfo->lesson_order+1);
        }else{
            $lesson_order = 1;
        }

        $lesson_check = $this->Course_model->lesson_check($section_id, $lesson_name);

        if ($lesson_check) {
            echo display('already_exists');
        } else {
            $lesson_data = array(
                'lesson_id' => $lesson_id,
                'course_id' => $course_id,
                'lesson_name' => $lesson_name,
                'section_id' => $section_id,
                'lesson_type' => $lesson_type,
                'lesson_provider' => $lesson_provider,
                'provider_url' => $provider_url,
                'lesson_order' => $lesson_order,
                'duration' => $duration,
                'summary' => $summary,
                'description' => $description,
                'is_preview' => $is_preview,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );

            $this->db->insert('lesson_tbl', $lesson_data);
            activitiylog_save($lesson_name . " Lesson Insert By", "Insert", $this->user_id, $this->createdtime);
            //picture upload
            $image = $this->fileupload->do_upload(
                    'assets/uploads/lesson/', 'attachment', 'gif|jpg|png|jpeg|pptx|pdf|doc'
            );
            if ($image) {
                $picture_data = array(
                    'from_id' => $lesson_id,
                    'picture' => $image,
                    'filename' => $_FILES['attachment']['name'],
                    'picture_type' => 'lesson',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
                activitiylog_save($lesson_name . " Lesson Insert By", "Insert", $this->user_id, $this->createdtime);
            }

            
            $resource_length = $this->input->post('resource_length', true);

            $filesCount = $resource_length;
            
           for ($i = 0; $i < $filesCount; $i++) {
               if(!empty(@$_FILES['resourcefile']['name'])){
               $uploadfile = (@$_FILES['resourcefile']?count(@$_FILES['resourcefile']['name']):0);
               if($uploadfile > $i){ 
               $_FILES['lessonresourcefile']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['resourcefile']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
               $_FILES['lessonresourcefile']['type']     = $_FILES['resourcefile']['type'][$i];
               $_FILES['lessonresourcefile']['tmp_name'] = $_FILES['resourcefile']['tmp_name'][$i];
               $_FILES['lessonresourcefile']['error']    = $_FILES['resourcefile']['error'][$i];
               $_FILES['lessonresourcefile']['size']     = $_FILES['resourcefile']['size'][$i];
      
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
               if ($this->upload->do_upload('lessonresourcefile')) {
                   $image_data = $this->upload->data();
                   // $image_name = 'assets/uploads/downloadfile/' . $image_data['file_name'];
                   $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['resourcefile']['name'][$i]); //$image_data['file_name'];
                //    d($image_name);
                   $config['image_library'] = 'gd2';
                   $config['source_image'] = $image_data['full_path']; //get original image
                   $config['maintain_ratio'] = TRUE;
                   $config['height'] = 800;
                   $config['width'] = 800;
                   $this->load->library('image_lib', $config);
                   $this->image_lib->clear();
                   $this->image_lib->initialize($config);

                   $filecontent[$i]['course_id'] = $course_id;
                   $filecontent[$i]['lesson_id'] = $lesson_id;
                   $filecontent[$i]['chapter_id'] = $section_id;
                   $filecontent[$i]['files'] = $image_name;
                   $filecontent[$i]['created_by'] = $this->user_id; 
               }
              }
           }
      
           }

           if (!empty($filecontent)) {
            // $checkoldlesson=$this->db->select('*')->from('course_resource_tbl')->where('course_id', $course_id)->where('lesson_id',$old_lesson_id)->get()->result();
            // if($checkoldlesson){
            //     $this->db->where('course_id', $course_id)->where('lesson_id',$old_lesson_id)->delete('course_resource_tbl');
            //     $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
            // }else{
                $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
            // }
        }

            echo display('lesson_added_successfully');
        }
    }

//    =============== its for edit lesson ==============
    public function editlesson_form() {
        $course_id = $this->input->post('course_id', true);
        $data['course_wise_section'] = $this->Course_model->course_wise_section($course_id);
        $lesson_id = $this->input->post('lesson_id', true);
        $data['lesson_wise_resource'] = $this->Course_model->lesson_wise_resource($lesson_id);
        $data['lesson_editdata'] = $this->Course_model->lesson_editdata($lesson_id);


        $this->load->view('dashboard/course/edit_lesson', $data);
    }

//    ========== its for lesson update ============
    public function lesson_update() {
        $lesson_id = $this->input->post('lesson_id', true);
        $course_id = $this->input->post('course_id', true);
        $lesson_name = $this->input->post('lesson_name', true);
        $section_id = $this->input->post('section_id', true);
        $lesson_type = $this->input->post('lesson_type', true);
        $lesson_provider = $this->input->post('lesson_provider', true);
        $attachment = $this->input->post('attachment', true);
        $provider_url = $this->input->post('provider_url', true);
        $oldprovider_url = $this->input->post('oldprovider_url', true);
        $duration = $this->input->post('duration', true);
        $summary = $this->input->post('summary', true);
        $description = $this->input->post('description', true);
        $is_preview = $this->input->post('is_preview', true);
        $is_preview = (($is_preview) ? "$is_preview" : "0");

        if ($duration) {
            $duration = $duration;
        } else {
            $duration = "00:00:00";
        }
   
        $lesson_data = array(
            'lesson_name' => $lesson_name,
            'section_id' => $section_id,
            'lesson_type' => $lesson_type,
            'lesson_provider' => $lesson_provider,
            'provider_url' => (!empty($provider_url)?$provider_url:$oldprovider_url),
            'duration' => $duration,
            'summary' => $summary,
            'description' => $description,
            'is_preview' => $is_preview,
            'enterprise_id' => get_enterpriseid(),
            'created_date' => $this->createdtime,
            'created_by' => $this->user_id,
        );
        $this->db->where('lesson_id', $lesson_id)->update('lesson_tbl', $lesson_data);
        activitiylog_save($lesson_name . " Lesson Update By", "Update", $this->user_id, $this->createdtime);
        //picture upload
        $image = $this->fileupload->update_doupload(
                $lesson_id, 'assets/uploads/lesson/', 'attachment', 'gif|jpg|png|jpeg|pptx|pdf|doc'
        );
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $lesson_id)->get()->row();
        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'from_id' => $lesson_id,
                    'picture' => $image,
                    'picture_type' => 'lesson',
                    'status' => 1,
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );

                $this->db->where('from_id', $lesson_id)->update('picture_tbl', $picture_data);
            } else {

                $picture_data = array(
                    'from_id' => $lesson_id,
                    'picture' => $image,
                    'picture_type' => 'lesson',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );

                $this->db->insert('picture_tbl', $picture_data);
            }
        }

        $resource_length = $this->input->post('resource_length', true);
        $filesCount = $resource_length;
        // $old_resource = $this->input->post('old_resource');
        $filecontent = [];

 
       for ($i = 0; $i < $filesCount; $i++) {
           if(!empty(@$_FILES['resourcefile']['name'])){
           $uploadfile = (@$_FILES['resourcefile']?count(@$_FILES['resourcefile']['name']):0);
           if($uploadfile > $i){ 
           $_FILES['lessonresourcefile']['name']     = date('dHis').'-f-'.str_replace(" ","-",$_FILES['resourcefile']['name'][$i]); //$_FILES['downloadable_file']['name'][$i];
           $_FILES['lessonresourcefile']['type']     = $_FILES['resourcefile']['type'][$i];
           $_FILES['lessonresourcefile']['tmp_name'] = $_FILES['resourcefile']['tmp_name'][$i];
           $_FILES['lessonresourcefile']['error']    = $_FILES['resourcefile']['error'][$i];
           $_FILES['lessonresourcefile']['size']     = $_FILES['resourcefile']['size'][$i];
  
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
           if ($this->upload->do_upload('lessonresourcefile')) {
               $image_data = $this->upload->data();
               // $image_name = 'assets/uploads/downloadfile/' . $image_data['file_name'];

               $image_name = 'assets/uploads/downloadfile/' .date('dHis').'-f-'.str_replace(" ","-",$_FILES['resourcefile']['name'][$i]); //$image_data['file_name'];
            //    d($image_name);
               $config['image_library'] = 'gd2';
               $config['source_image'] = $image_data['full_path']; //get original image
               $config['maintain_ratio'] = TRUE;
               $config['height'] = 800;
               $config['width'] = 800;
               $this->load->library('image_lib', $config);
               $this->image_lib->clear();
               $this->image_lib->initialize($config);

               $filecontent[$i]['course_id'] = $course_id;
               $filecontent[$i]['lesson_id'] = $lesson_id;
               $filecontent[$i]['chapter_id'] = $section_id;
               $filecontent[$i]['files'] = $image_name;
               $filecontent[$i]['created_by'] = $this->user_id; 
            //    d($image_name);
           }
        //    else{
        //     $image_name = $old_resource[$i];
        //     // d($image_name);
        //     $filecontent[$i]['course_id'] = $course_id;
        //     $filecontent[$i]['lesson_id'] = $lesson_id;
        //     $filecontent[$i]['chapter_id'] = $section_id;
        //     $filecontent[$i]['files'] = $image_name;
        //     $filecontent[$i]['created_by'] = $this->user_id; 
        //    }
          }
       }
  
       }
               if (!empty($filecontent)) {
           // $checklessonresource = $this->db->select('*')->from('course_resource_tbl')->where('course_id', $course_id)->where('lesson_id',$lesson_id)->get()->result();
           // if($checklessonresource){
               //     $this->db->where('course_id', $course_id)->where('lesson_id',$lesson_id)->delete('course_resource_tbl');
               //     $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
               // }else{
                   $insert = $this->db->insert_batch('course_resource_tbl', $filecontent);
                   // }
        }
        //   dd($filecontent);

        echo display('lesson_updated_successfully');
    }

//    ============= its for lesson delete ===========
    public function lesson_delete() {
        $course_id = $this->input->post('course_id', true);
        $lesson_id = $this->input->post('lesson_id', true);
        $courseIsinvoice = $this->Course_model->courseIsinvoice($course_id);
        if ($courseIsinvoice) {
            echo 0;
        } else {
            $this->db->where('lesson_id', $lesson_id)->delete('lesson_tbl');
            activitiylog_save("Lesson Deleted By", "Delete", $this->user_id, $this->createdtime);
            echo 1;
        }
    }
//    ============= its for resource delete ===========
public function resource_delete() {
    $id = $this->input->post('id', true);
    $this->db->where('id', $id)->delete('course_resource_tbl');
    activitiylog_save("Resource Deleted By", "Delete", $this->user_id, $this->createdtime);
    echo 1;
}

    // ============== its for assignexam form ================
    public function assignexam_form() {
        $data['course_id'] = $this->input->post('course_id', true);
        $enterprise_id = get_enterpriseid();
        // $data['get_lessons'] = get_lessons($data['course_id'], $enterprise_id);
        $data['get_sections'] = get_sections($data['course_id'], $enterprise_id);
        $data['get_exams'] = get_exams();

        $this->load->view('dashboard/course/assignexam_form', $data);
    }


    // ============ its for assign exam ===============
    public function assign_exam() {
        $id = $this->input->post('id', true);
        // $lesson_id = $this->input->post('lesson_id', true);
        $section_id = $this->input->post('section_id', true);
        $exam_id = $this->input->post('exam_id', true);
        $course_id = $this->input->post('course_id', true);

        $checkExistsdata = $this->db->where('course_id', $course_id)
                ->where('section_id', $section_id)
                ->where('exam_id', $exam_id)
                ->get('assign_courseexam_tbl')
                ->row();

        $assigndata = array(
            'course_id' => $course_id,
            // 'lesson_id' => $lesson_id,
            'section_id' => $section_id,
            'exam_id' => $exam_id,
            'enterprise_id' => get_enterpriseid(),
            'status' => 1,
            'created_by' => get_userid(),
            'created_date' => $this->createdtime,
        );
        if ($id) {
            $this->db->where('id', $id)->update('assign_courseexam_tbl', $assigndata);
            echo display('updated_successfully');
        } else {
            if (empty($checkExistsdata)) {
                $this->db->insert('assign_courseexam_tbl', $assigndata);
                echo display('assigned_successfully');
            }
        }
    }

    // ============== its for assignexam edit form ================
    public function assignexam_edit() {
        $enterprise_id = get_enterpriseid();
        $data['course_id'] = $this->input->post('course_id', true);
        $data['id'] = $this->input->post('id', true);
        $data['get_assigneditdata'] = $this->Course_model->get_assigneditdata($data['id']);
        // $data['get_lessons'] = get_lessons($data['course_id'], $enterprise_id);
        $data['get_sections'] = get_sections($data['course_id'], $enterprise_id);
        $data['get_exams'] = get_exams();

        $this->load->view('dashboard/course/assignexam_editform', $data);
    }

    //    ============= its for assignexam delete ===========
    public function assignexam_delete() {
        $id = $this->input->post('id', true);
        // $courseIsinvoice = $this->Course_model->courseIsinvoice($course_id);
        // if ($courseIsinvoice) {
        //     echo 0;
        // } else {
        $this->db->where('id', $id)->delete('assign_courseexam_tbl');
        activitiylog_save("Assign Exam Deleted By", "Delete", $this->user_id, $this->createdtime);
        echo 1;
        // }
    }

//    ============ its for single_invoice =============
    public function single_invoice($invoice_id) {
        $data['setting'] = $this->setting_model->read();
        $data['get_invoice_info'] = $this->Course_model->get_invoice_info($invoice_id);
        $data['get_invoicedetails'] = $this->Course_model->get_invoicedetails($invoice_id);

        $data['module'] = "dashboard";
        $data['page'] = "course/single_invoice";
        echo modules::run('template/layout', $data);
    }

//    ============ its for course_inactive =============
    public function course_inactive() {
        $course_id = $this->input->post('course_id', TRUE);
        $data = array(
            'status' => 2,
        );
        $this->db->where('course_id', $course_id);
        $this->db->update('course_tbl', $data);
        activitiylog_save($course_id . " Course Inactive By", "Inactive", $this->user_id, $this->createdtime);
        echo display('inactive_successfully');
    }
// //    ============ its for course_reject =============
    // public function course_reject() {
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $data = array(
    //         'status' => 4,
    //     );
    //     $this->db->where('course_id', $course_id);
    //     $this->db->update('course_tbl', $data);
    //     activitiylog_save($course_id . " Course Rejected By", "Rejected", $this->user_id, $this->createdtime);
    //     echo 'Rejected successfully';
    // }

    public function coursesharepercent_check(){
        $course_id = $this->input->post('course_id');
        $coursesharepercent_check=$this->db->select('*')->from("course_tbl")->where('course_id',$course_id)->get()->row();

        // d($coursesharepercent_check->tagstatus);die();
        // d($coursesharepercent_check->share_percent);
        // d($coursesharepercent_check->docusign);
        if(empty($coursesharepercent_check->share_percent) || empty($coursesharepercent_check->docusign) || ($coursesharepercent_check->agreement_status != 2)){
            echo 0;
        }
        // elseif($coursesharepercent_check->tagstatus ==null){
        //     echo 1;
        // }
        else{
            echo 2;
        }
    }

//    ================== its for course_active ============
    public function course_active() {

         $course_id = $this->input->post('course_id', TRUE);
        $data = array(
            'status' => 1,
            'feedback' => '',
            'published_date' => $this->createdtime,
            'published_by' => $this->user_id,
        );
        $this->db->where('course_id', $course_id);
        $this->db->update('course_tbl', $data);


    //     $check_offer_course=$this->db->select('*')->from("course_tbl")->where('is_offer',1)->where('course_id',$course_id)->get()->row();
    // if(!empty($check_offer_course->is_offer)==1){

        //  $course_site= $this->db->select("a.*,b.user_id,b.offerupdates_site,b.offerupdates_email	,b.offerupdates_sms")
        //     ->from('loginfo_tbl a')
        //      ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
        //     ->where('a.enterprise_id',get_enterpriseid())
        //     ->where('a.status',1)
        //     ->get()->result();
            
        //     $app_setting = get_appsettings();
        //     $fromemail=$app_setting->email;
        //     $course_url=base_url(enterpriseinfo()->shortname."/event-details/".$course_id);
        //     $course_details=$this->db->select("*")->from("course_tbl")->where('course_id',$course_id)->get()->row();
        //     $sms_gateway_info = $this->setting_model->sms_gateway(1);
            
        //     foreach($course_site as $course_status){
        //         if($course_status->offerupdates_site==1){
        //          $data_nofi=array(
        //              'notification_id'=>$course_id,
        //              'student_id'=>$course_status->user_id,
        //              'notification_type'=>4,
        //              'created_date'=>date('Y-m-d H:i:s'),
        //              'isNotify'=>1,
        //              'enterprise_id'=>get_enterpriseid(),
        //          );
        //          $this->db->insert('notifications_tbl', $data_nofi);
        //         }
        //         if($course_status->offerupdates_email==1){
        //             $to_email = $course_status->email;
        //             $to_mail_delivered = explode(',', $to_email);
        //             $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
        //             $description = word_limiter($course_details->description, 10);
        //             $description = strip_tags(html_entity_decode($description));
        //                 $config = array(
        //                     'protocol'  => $send_email->protocol,
        //                     'smtp_host' => $send_email->smtp_host,
        //                     'smtp_port' => $send_email->smtp_port,
        //                     'smtp_user' => $send_email->smtp_user,
        //                     'smtp_pass' => $send_email->smtp_pass,
        //                     'mailtype'  => $send_email->mailtype,
        //                     'charset'   => 'utf-8',
        //                     'wordwrap' => TRUE,
        //                     'smtp_crypto'=>'tls',
        //                 );
        //                 $this->load->library('email');
        //                 $this->email->initialize($config);
        //                 $this->email->set_newline("\r\n");
        //                 $this->email->set_mailtype("html");
        //                 $htmlContent="<h1>Course </h1> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
        //                 $this->email->from("$fromemail",enterpriseinfo()->shortname);
        //                 $this->email->to($to_mail_delivered);
        //                 $this->email->subject(enterpriseinfo()->shortname);
        //                 $this->email->message($htmlContent);
        //                 $this->email->send();
                     
                     
        //         }
        //         if($course_status->offerupdates_sms==1){
        //              $to_mobile = $course_status->mobile;
        //                 // $this->smsgateway->send([
        //                 //     'apiProvider' => $sms_gateway_info->provider_name,
        //                 //     'username' => $sms_gateway_info->user,
        //                 //     'password' => $sms_gateway_info->password,
        //                 //     'from' => $sms_gateway_info->authentication,
        //                 //     'to' =>  $to_mobile ,
        //                 //     'message' => "Forum -> $course_details->name . $description Learn more click here:  <a href='$course_url'>Link</a>",
        //                 // ]);
        //                 $alphasmsdata = array(
        //                     'mobile' => $to_mobile,
        //                     'message' => "Course -> $course_details->name . $description Learn more click here:  $course_url",
        //                 );
        //                 // $this->sendalphasms($alphasmsdata);
        //                 $this->send_elitbuzzsms($alphasmsdata);
        //         }  
        //     }

            
            

       
       
        // }else{

            // user type student
            $course_site= $this->db->select("a.*,b.user_id,b.courses_site,b.courses_email,b.courses_sms")
            ->from('loginfo_tbl a')
             ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
            ->where('a.enterprise_id',get_enterpriseid())
            ->where('a.status',1)
            ->where('b.type',1)
            ->get()->result();
            $app_setting = get_appsettings();
            $fromemail=$app_setting->email;
            $course_url=base_url(enterpriseinfo()->shortname."/course-details/".$course_id);
            $course_details=$this->db->select("*")->from("course_tbl")->where('course_id',$course_id)->get()->row();
            $sms_gateway_info = $this->setting_model->sms_gateway(1);
            
            foreach($course_site as $course_status){
                if($course_status->courses_site==1){
                 $data_nofi=array(
                     'notification_id'=>$course_id,
                     'student_id'=>$course_status->user_id,
                     'notification_type'=>1,
                     'created_date'=>date('Y-m-d H:i:s'),
                     'isNotify'=>1,
                     'enterprise_id'=>get_enterpriseid(),
                 );
                 $this->db->insert('notifications_tbl', $data_nofi);
                }
                if($course_status->courses_email==1){
                    $to_email = $course_status->email;
                    $to_mail_delivered = explode(',', $to_email);
                    $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
                    $demo_email =$this->db->select("email")->from('setting')->where('enterprise_id',$course_status->enterprise_id)->get()->row();
                    $description = word_limiter($course_details->description, 10);
                    $description = strip_tags(html_entity_decode($description));
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
                        $htmlContent="<h1>Course </h1> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                        $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,enterpriseinfo()->shortname);
                        $this->email->to($to_mail_delivered);
                        $this->email->subject(enterpriseinfo()->shortname);
                        $this->email->message($htmlContent);
                        $this->email->send();
                     
                     
                }
                if($course_status->courses_sms==1){
                     $to_mobile = $course_status->mobile;
                        // $this->smsgateway->send([
                        //     'apiProvider' => $sms_gateway_info->provider_name,
                        //     'username' => $sms_gateway_info->user,
                        //     'password' => $sms_gateway_info->password,
                        //     'from' => $sms_gateway_info->authentication,
                        //     'to' =>  $to_mobile ,
                        //     'message' => "Forum -> $course_details->name . $description Learn more click here:  <a href='$course_url'>Link</a>",
                        // ]);
                        $alphasmsdata = array(
                            'mobile' => $to_mobile,
                            'message' => "কোর্স  -> $course_details->name – প্রিয় গ্রাহক, আপনি নতুন একটি কোর্সে যুক্ত হয়েছেন । আরো জানতে এখানে ক্লিক করুন:  $course_url ধন্যবাদ। ",
                        );
                        // dd($alphasmsdata);
                        // $this->sendalphasms($alphasmsdata);
                        $this->send_elitbuzzsms($alphasmsdata);
              }

            }



            //===========instructor
          $instructor_info=  $this->db->select('course_id,faculty_id')->from('course_tbl')->where('course_id',$course_id)->get()->row(); 
          $instructor_id=$instructor_info->faculty_id;
           $instructor_course_site= $this->db->select("a.*,b.user_id,b.courses_site,b.courses_email,b.courses_sms")
           ->from('loginfo_tbl a')
            ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
           ->where('a.enterprise_id',get_enterpriseid())
           ->where('a.status',1)
           ->where('b.user_id',$instructor_id)
           ->where('b.type',2)
           ->get()->result();
        
           foreach($instructor_course_site as $siteinfo){
            if($siteinfo->courses_site==1){
                $data_nofi=array(
                    'notification_id'=>$course_id,
                    'student_id'=>$siteinfo->user_id,
                    'notification_type'=>1,
                    'type'=>1,
                    'created_date'=>date('Y-m-d H:i:s'),
                    'isNotify'=>1,
                    'enterprise_id'=>get_enterpriseid(),
                );
                $this->db->insert('notifications_tbl', $data_nofi);
               }
               if($siteinfo->courses_email==1){
                   $to_email = $siteinfo->email;
                   $to_mail_delivered = explode(',', $to_email);
                   $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
                   $description = word_limiter($course_details->description, 10);
                   $demo_email =$this->db->select("email")->from('setting')->where('enterprise_id',$siteinfo->enterprise_id)->get()->row();
                   $description = strip_tags(html_entity_decode($description));
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
                       $htmlContent="<h2>Your course has been published successfully</h2> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                       $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,enterpriseinfo()->shortname);
                       $this->email->to($to_mail_delivered);
                       $this->email->subject(enterpriseinfo()->shortname);
                       $this->email->message($htmlContent);
                       $this->email->send(); 
               }
               if($course_status->courses_sms==1){
                    $to_mobile = $course_status->mobile;
                    $alphasmsdata = array(
                        'mobile' => $to_mobile,
                        'message' => "প্রিয় গ্রাহক, আপনার কোর্সটি সফলভাবে পাবলিশ হয়েছে  -> $course_details->name  বিস্তারিত জানতে এখানে ক্লিক করুন। :  $course_url ধন্যবাদ। ",
                    );
                    $this->send_elitbuzzsms($alphasmsdata);
                }


            
           }








        // }
    // notification query end

        activitiylog_save($course_id . " Course Active By", "Active", $this->user_id, $this->createdtime);
        echo display('active_successfully');
    }

    public function sendalphasms($data = array()){        
        $apikey = 'pNBvPzTC8002Ai2Wc1CyWAt8svm0vcqvAmUBRLvO';
        //dd($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
                'api_key' => $apikey,
                'msg' => trim($data['message']),
                'to' => $data['mobile'],
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
    public function send_elitbuzzsms($data = array()){        
        // $senderid = '8809612472604';
        $senderid = 'LEADACADEMY';
        $apikey = 'C200813661af359ecfaa53.01117491';
        $message = $data['message'];
        $phone = $data['mobile'];
        
        // $sendelitbuzz = 'https://msg.elitbuzz-bd.com/smsapi?api_key='.$apikey.'&type=text&contacts='.$phone.'&senderid='.$senderid.'&msg='.$message.'';
        
        $message2=strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $message)));
            if(!empty($message) && !empty($phone)){

                $urltopost = "https://msg.elitbuzz-bd.com/smsapi";
                $datatopost = array (
                        "api_key"	=> $apikey,
                        "type" 		=> 'unicode',
                        "senderid" 	=> $senderid,
                        "msg" 		=> trim($message),
                        "contacts" 	=> $phone
                );
                // dd($datatopost);
                $ch = curl_init ($urltopost);
                curl_setopt ($ch, CURLOPT_POST, true);
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
    
                if($result === false)
                {
                    echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
                    return;
                }
                // print_r($result);
                curl_close($ch);
                // return $result;
    
            }
    }


    //    ============ its for course_popularstatus =============
    // public function course_popularstatus() {
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $is_popular = $this->input->post('is_popular', TRUE);

    //     $data = array(
    //         'is_popular' => $is_popular,
    //     );
    //     $this->db->where('course_id', $course_id);
    //     $this->db->update('course_tbl', $data);
    //     activitiylog_save($course_id . " Course popular By", "popular", $this->user_id, $this->createdtime);
    //     if($is_popular==1){
    //     echo display('added_successfully');
    //     }else{
    //         echo "Unchecked successfully!";
    //     }
    // }
    // //    ============ its for course_newstatus =============
    // public function course_newstatus() {
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $is_new = $this->input->post('is_new', TRUE);

    //     $data = array(
    //         'is_new' => $is_new,
    //     );
    //     $this->db->where('course_id', $course_id);
    //     $this->db->update('course_tbl', $data);
    //     activitiylog_save($course_id . " Course new By", "new", $this->user_id, $this->createdtime);
    //     if($is_new==1){
    //     echo display('added_successfully');
    //     }else{
    //         echo "Unchecked successfully!";
    //     }
    // }

//    =============== its for course delete  ==============
    public function course_delete() {
        $course_id = $this->input->post('course_id', TRUE);
        // $courseIsinvoice = $this->Course_model->courseIsinvoice($course_id);
        // if ($courseIsinvoice) {
        //     echo 0;
        // } else {

        $data = array(
            'status' => 3,
            'deleted_by' => $this->user_id,
            'deleted_date' => $this->createdtime
        );
        $this->db->where('course_id', $course_id)->update('course_tbl', $data);
        activitiylog_save($course_id . " Course Deleted By", "Delete", $this->user_id, $this->createdtime);
        echo 1;
        // }
    }

//    ============= its for  students count ===============
    public function student_sales_course_count() {
        $this->db->select('count(a.id) as ttlrow');
        $this->db->from('students_tbl a');
        $this->db->join('invoice_details b', 'b.customer_id = a.student_id');
        $this->db->where('b.status', 1);
        $this->db->group_by('b.customer_id');
        $query = $this->db->count_all_results();
        return $query;
    }

//    ============== its for student_sales_course_facultywise_count ============
    public function student_sales_course_facultywise_count($user_id, $user_type) {
        $this->db->select('a.name, a.course_id')
                ->from('course_tbl a')
                ->where('a.faculty_id', $user_id);
        $get_facultyCourse = $this->db->get()->result();

        $courseids = '';
        foreach ($get_facultyCourse as $facultycourse) {
            $courseids .= "'" . $facultycourse->course_id . "',";
        }
        $course_ids = rtrim($courseids, ",");
        if ($course_ids) {
            $where_in = "a.product_id IN ($course_ids)";
            $this->db->select('count(a.id) as ttlrow');
            $this->db->from('invoice_details a');
            $this->db->join('students_tbl b', 'b.student_id = a.customer_id');
            $this->db->where($where_in);
            $this->db->where('a.status', 1);
            $this->db->group_by('a.customer_id');
            $query = $this->db->count_all_results();
            return $query;
        }
    }

//    =========== its for student_sales_course ===========
    public function student_sales_course() {
        $data['title'] = display('purchased_course_list');
        $config["base_url"] = base_url('purchased-course-list/');
        if ($this->user_type == 1) {
            $config["total_rows"] = $this->student_sales_course_count();
        } elseif ($this->user_type == 3) {
            $config["total_rows"] = $this->student_sales_course_facultywise_count($this->user_id, $this->user_type);
        }
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
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
        $data["student_sales_course"] = '';
        if ($this->user_type == 1) {
            $data["student_sales_course"] = $this->Student_model->student_sales_course($config["per_page"], $page);
        } elseif ($this->user_type == 3) {
            $data['student_sales_course'] = $this->Student_model->student_sales_course_facultywise($config["per_page"], $page, $this->user_id, $this->user_type);
        }
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['module'] = "dashboard";
        $data['page'] = "course/student_sales_course";
        echo modules::run('template/layout', $data);
    }

//    ================ its for student_salescourse_filter ===========
    public function student_salescourse_filter() {
        $student_id = $this->input->post('student_id', TRUE);
        $mobile = $this->input->post('mobile', true);
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);
        $data["student_list"] = $this->Student_model->student_salescourse_filter($student_id, $mobile, $start_date, $end_date);

        $this->load->view('course/student_salescourse_filter', $data);
    }

    //    ============= its for  faculty count ===============
    public function faculty_count() {
        $this->db->where('status', 1);
        $count_query = $this->db->count_all_results('faculty_tbl');
        return $count_query;
    }

    public function faculty_sales_course() {
        $data['title'] = display('faculty_sales_course');
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $config["base_url"] = base_url('student-sales-course/');
        $config["total_rows"] = $this->faculty_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
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
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["faculty_sales_course"] = $this->Course_model->faculty_sales_course($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['module'] = "dashboard";
        $data['page'] = "course/faculty_sales_course";
        echo modules::run('template/layout', $data);
    }

//    ================ its for faculty_salescourse_filter ===========
    public function faculty_salescourse_filter() {
        $faculty_id = $this->input->post('faculty_id', TRUE);
        $mobile = $this->input->post('mobile', TRUE);
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);
        $data["faculty_sales_course"] = $this->Course_model->faculty_salescourse_filter($faculty_id, $mobile, $start_date, $end_date);

        $this->load->view('course/faculty_sales_course_filter', $data);
    }

//    ============ its for get commission list count ==========
    public function get_commissionlistcount() {
        $this->db->select('a.id');
        $this->db->from('commission_setup_tbl a');
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->where('b.enterprise_id', get_enterpriseid());
        return $this->db->count_all_results();
    }

//    =============== its for commission_list ===========
    public function commission_list() {
        $data['title'] = display('commission_list');
        $data['setting'] = $this->setting_model->read();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $config["base_url"] = base_url(enterpriseinfo()->shortname . '/commission-list/');
        $config["total_rows"] = $this->get_commissionlistcount();
        $config["per_page"] = 20;
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
        $data["commission_list"] = $this->Course_model->commission_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;


        $data['module'] = "dashboard";
        $data['page'] = "course/commission_list";
        echo modules::run('template/layout', $data);
    }

//    ============its for faculty wise course =========
    public function faculty_wise_course() {
        $faculty_id = $this->input->post('faculty_id', TRUE);
        $faculty_courses = $this->Course_model->faculty_wise_cours($faculty_id);
        echo json_encode($faculty_courses);
    }

//    =============== its for course wise courseinfo ========== 
    public function course_wise_courseinfo() {
        $course_id = $this->input->post('course_id', TRUE);
        $course_info = $this->Course_model->course_info($course_id);
        echo json_encode($course_info);
    }

//    ============= its for commission_generate ==========
    public function commission_generate() {
        $commission_id = "CM" . date('d') . $this->generators->generator(6);
        $course_id = $this->input->post('course_id', TRUE);
        $commission = $this->input->post('commission', TRUE);
        $commission_rate = $this->input->post('rate', TRUE);
        $check_commission_generate = $this->db->select('*')->from('commission_setup_tbl')->where('course_id', $course_id)->get()->row();
        if ($check_commission_generate) {
            $commission_generate = array(
                'commission' => $commission,
                'commission_rate' => $commission_rate,
                'updated_date' => $this->createdtime,
                'updated_by' => $this->user_id,
            );
            $this->db->where('course_id', $course_id)->update('commission_setup_tbl', $commission_generate);
            echo display('updated_successfully');
        } else {
            $commission_generate = array(
                'commission_id' => $commission_id,
                'course_id' => $course_id,
                'commission' => $commission,
                'commission_rate' => $commission_rate,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('commission_setup_tbl', $commission_generate);
            echo display('generated_successfully');
        }
    }

//    ============= its for commission_setup_delete ==============
    public function commission_setup_delete() {
        $commission_id = $this->input->post('commission_id', TRUE);
        $this->db->where('commission_id', $commission_id)->delete('commission_setup_tbl');
        echo display('deleted_successfully');
    }

//    =============== its for faculty_commission ===========
    public function faculty_course_commission() {
        $data['title'] = display('faculty_course_commission');
        if ($this->user_type == 3) {
            $data['quick_view'] = $this->Course_model->quick_view($this->user_id, $this->user_type);
        }
        $data['setting'] = $this->setting_model->read();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $config["base_url"] = base_url('faculty-commission/');
        $config["total_rows"] = $this->db->count_all('commission_setup_tbl');
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
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
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["faculty_course_commission"] = $this->Course_model->faculty_course_commission($config["per_page"], $page, $this->user_id, $this->user_type);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;


        $data['module'] = "dashboard";
        $data['page'] = "course/faculty_course_commission";
        echo modules::run('template/layout', $data);
    }

//    ============ its for faculty course list ===============
    public function facultyrevenue_count() {
        $this->db->select('a.name, a.faculty_id, b.course_id');
        $this->db->from('faculty_tbl a');
        $this->db->join('course_tbl b', 'b.faculty_id = a.faculty_id');
        $this->db->group_by('b.faculty_id');
        $this->db->order_by('a.id', 'desc');
        return $this->db->count_all_results();
    }

//    =============== its for faculty_revenue ===========
    public function faculty_revenue() {
        $data['title'] = display('faculty_revenue');
        $data['setting'] = $this->setting_model->read();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        if ($this->user_type == 1) {
            $data['quick_view'] = $this->Course_model->quick_view($this->user_id, $this->user_type);
            $config["base_url"] = base_url(enterpriseinfo()->shortname . '/faculty-revenue/');
            $config["total_rows"] = $this->facultyrevenue_count();
            $config["per_page"] = 20;
            $config["uri_segment"] = 2;
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
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data["facultycourse_list"] = $this->Faculty_model->facultycourse_list($config["per_page"], $page, $this->user_type, $this->user_id);
            $data["links"] = $this->pagination->create_links();
            $data['pagenum'] = $page;
        } elseif ($this->user_type == 3) {
            $faculty_id = $this->session->userdata('user_id');
            $data['quick_view'] = $this->Course_model->quick_view($faculty_id, $this->user_type);
            $data['setting'] = $this->setting_model->read();
            $data['faculty_info'] = $this->Faculty_model->faculty_info($faculty_id);
            $data['get_faculty'] = $this->Faculty_model->get_faculty();
            $config["base_url"] = base_url('faculty-course-revenue/' . $faculty_id);
            $config["total_rows"] = $this->facultycourse_revenuecount($faculty_id);
            $config["per_page"] = 20;
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
            $data["faculty_course_revenue"] = $this->Course_model->faculty_course_revenue($config["per_page"], $page, $faculty_id, $this->user_type);
            $data["links"] = $this->pagination->create_links();
            $data['pagenum'] = $page;
        }

        $data['module'] = "dashboard";
        $data['page'] = "course/faculty_revenue";
        echo modules::run('template/layout', $data);
    }

//    ============= its for yearmonthly_myrevenue =============
    public function yearmonthly_myrevenue() {
        $data['setting'] = $this->setting_model->read();
        $user_id = $this->input->post('faculty_id', TRUE);
        $yearmonth = $this->input->post('yearmonth', TRUE);
        $yearmonth_explodes = explode("-", $yearmonth);
        $data['year'] = $yearmonth_explodes[0];
        $data['month'] = $yearmonth_explodes[1];

        $data['facultycourse_revenue_yearmonth'] = $this->Course_model->facultycourse_revenue_yearmonth($user_id);

        $this->load->view('dashboard/course/facultycourse_revenue_yearmonth', $data);
    }

//    ========== its for faculty course revenue ==========
    public function facultycourse_revenuecount($faculty_id) {
        $this->db->from('commission_setup_tbl a');
        $this->db->join('course_tbl b', 'b.category_id = a.category_id');
        $this->db->join('faculty_tbl c', 'c.faculty_id = b.faculty_id');
        $this->db->where('b.faculty_id', $faculty_id);
        $this->db->order_by('a.id', 'desc');
        return $this->db->count_all_results();
    }

//    ============ its for faculty_course_revenue =========
    public function faculty_course_revenue($faculty_id) {
        $data['title'] = display('faculty_course_revenue');
        $data['quick_view'] = $this->Course_model->quick_view($faculty_id, $this->user_type);
        $data['setting'] = $this->setting_model->read();
        $data['faculty_info'] = $this->Faculty_model->faculty_info($faculty_id);
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $config["base_url"] = base_url('faculty-course-revenue/' . $faculty_id);
        $config["total_rows"] = $this->facultycourse_revenuecount($faculty_id);
        $config["per_page"] = 20;
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
        $data["faculty_course_revenue"] = $this->Course_model->faculty_course_revenue($config["per_page"], $page, $faculty_id, $this->user_type);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;


        $data['module'] = "dashboard";
        $data['page'] = "course/faculty_course_revenue";
        echo modules::run('template/layout', $data);
    }

//    ============== its for commissionedit_form ===========
    public function commissionedit_form() {
        $commission_id = $this->input->post('commission_id', true);
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['commissionedit_data'] = $this->Course_model->commissionedit_data($commission_id);

        $this->load->view('course/commissionedit_form', $data);
    }

//    ============= its for commission_update ============
    public function commission_update() {
        $commission_id = $this->input->post('commission_id', true);
        $course_id = $this->input->post('course_id', true);
        $commission = $this->input->post('commission', true);
        $commission_rate = $this->input->post('rate', true);
        $commission_generate = array(
            'course_id' => $course_id,
            'commission' => $commission,
            'commission_rate' => $commission_rate,
            'updated_date' => $this->createdtime,
            'updated_by' => $this->user_id,
        );
        $this->db->where('commission_id', $commission_id)->update('commission_setup_tbl', $commission_generate);
        echo display('updated_successfully');
    }

//    =========== its for pay form ============
    public function pay_form() {

        $this->load->view('course/pay_form');
    }

    //    ============ its for payment gateway ============
    public function pay_with_paypal_submit() {
        $setting = $this->setting_model->read();
        $order_id = '22222';
        $faculty_id = $this->input->post('faculty_id', true);
        $total_amount = $this->input->post('payment_amount', true);
        $facultypaypal = $this->input->post('facultypaypal', true);
        $user_id = $this->user_id;

        $amount = $total_amount;
        $price = number_format($amount, 2);

        $quantity = 1;
        $discount = 0;
        $item_name = "Order :: Test";

        $receipt_no = "RE" . $this->generators->generator(7);
        $transaction_id = "TXN" . $this->generators->generator(8);
        $ledger_id = $faculty_id;
        $date = date('Y-m-d');


        $session_data = array(
            'faculty_id' => $faculty_id,
            'user_id' => $user_id,
            'transaction_id' => $transaction_id,
        );
        $this->session->set_userdata($session_data);

        $transaction_data = array(
            'transaction_id' => $transaction_id,
            'ledger_id' => $ledger_id,
            'transaction_category' => 3, // faculty = 3
            'invoice_no' => '',
            'receipt_no' => $receipt_no,
            'description' => "Paid by paypal",
            'payment_type' => 1, //1=paypal
            'amount' => $total_amount,
            'date' => $date,
            'd_c' => 'd',
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
            'status' => 0,
        );
        $this->db->insert('ledger_tbl', $transaction_data);

        // --------------------- Set variables for paypal form
        $returnURL = base_url("dashboard/course/success/"); //payment success url
        $cancelURL = base_url("dashboard/course/cancel/"); //payment cancel url
        $notifyURL = base_url('dashboard/course/ipn'); //ipn url
        //set session token
        $this->session->unset_userdata('_tran_token');
        $this->session->set_userdata(array('_tran_token' => $order_id));
        // set form auto fill data
        $this->paypalfaculty_lib->add_field('return', $returnURL);
        $this->paypalfaculty_lib->add_field('cancel_return', $cancelURL);
        $this->paypalfaculty_lib->add_field('notify_url', $notifyURL);
        $this->paypalfaculty_lib->add_field('faculty_id', $faculty_id);

        // item information
        $this->paypalfaculty_lib->add_field('item_number', $order_id);
        $this->paypalfaculty_lib->add_field('item_name', $item_name);
        $this->paypalfaculty_lib->add_field('amount', $price);
        $this->paypalfaculty_lib->add_field('quantity', $quantity);
        $this->paypalfaculty_lib->add_field('discount_amount', $discount);
        $this->paypalfaculty_lib->add_field2($facultypaypal);

        // additional information 
        $this->paypalfaculty_lib->add_field('custom', $order_id);
        $this->paypalfaculty_lib->image('');
        // generates auto form
        $this->paypalfaculty_lib->paypal_auto_form();
    }

    public function success() {
        $faculty_id = $this->session->userdata('faculty_id');
        $user_id = $this->session->userdata('user_id');
        $transaction_id = $this->session->userdata('transaction_id');

        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.log_id', $user_id);
        $user_info = $this->db->get()->row();


        $sData = array(
            'isLogIn' => true,
            'isAdmin' => (($user_info->is_admin == 1) ? true : false),
            'is_admin' => $user_info->is_admin,
            'user_type' => $user_info->user_types,
            'log_id' => $user_info->log_id,
            'user_id' => $user_info->log_id,
            'fullname' => $user_info->name,
            'email' => $user_info->email,
            'image' => (!empty($user_info->image) ? $user_info->image : $user_info->picture),
            'last_login' => $user_info->last_login,
            'last_logout' => $user_info->last_logout,
            'ip_address' => $user_info->ip_address,
            'session_id' => session_id(),
        );
        //store date to session 
        $this->session->set_userdata($sData);

        $transaction_data = array(
            'status' => 1,
        );
        $this->db->where('transaction_id', $transaction_id)->update('ledger_tbl', $transaction_data);
        $this->session->unset_userdata('faculty_id');
        $this->session->unset_userdata('transaction_id');

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Payment successfully done!</div>");
        redirect(enterpriseinfo()->shortname . '/faculty-revenue');
    }

    public function ipn() {
        //paypal return transaction details array
        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

        //check whether the payment is verified
        if (preg_match("/VERIFIED/i", $result)) {
            //insert the transaction data into the database
            $this->load->model('paypal_model');
            $this->paypal_model->insertTransaction($data);
        }
    }

//    =========== its for paypal cancel ============
    public function cancel($faculty_id, $user_id = null, $transaction_id = null) {
        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.log_id', $user_id);
        $user_info = $this->db->get()->row();
        $sData = array(
            'isLogIn' => true,
            'isAdmin' => (($user_info->is_admin == 1) ? true : false),
            'is_admin' => $user_info->is_admin,
            'user_type' => $user_info->user_types,
            'log_id' => $user_info->log_id,
            'user_id' => $user_info->log_id,
            'fullname' => $user_info->name,
            'email' => $user_info->email,
            'image' => (!empty($user_info->image) ? $user_info->image : $user_info->picture),
            'last_login' => $user_info->last_login,
            'last_logout' => $user_info->last_logout,
            'ip_address' => $user_info->ip_address,
            'session_id' => session_id(),
        );
        //store date to session 
        $this->session->set_userdata($sData);

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Payment canceled!</div>");
        redirect(enterpriseinfo()->shortname . '/faculty-revenue');
    }

    //    ============ its for admin revenue courses count===============
    public function adminrevenue_coursescount() {
        $this->db->from('course_tbl a');
        $this->db->join('commission_setup_tbl b', 'b.category_id = a.category_id');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        return $this->db->count_all_results();
    }

//    =============== its for admin_revenue ===========
    public function admin_revenue() {
        $data['title'] = display('admin_revenue');
        $data['setting'] = $this->setting_model->read();
        $config["base_url"] = base_url(enterpriseinfo()->shortname . '/admin-revenue/');
        $config["total_rows"] = $this->adminrevenue_coursescount();
        $config["per_page"] = 20;
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
        $data["adminrevenue_courses"] = $this->Course_model->adminrevenue_courses($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;


        $data['module'] = "dashboard";
        $data['page'] = "course/admin_revenue";
        echo modules::run('template/layout', $data);
    }

//    ============ its for category_wise_course ===========
    public function category_wise_course() {
        $category_id = $this->input->post('category_id', TRUE);
        $category_wise_course = $this->Course_model->category_wise_course($category_id);
        echo json_encode($category_wise_course);
    }

//    =============== its for add photo resize form ==============
    public function photo_resize_form() {
        $data['course_id'] = $this->input->post('course_id', true);
        $data['get_coursepicture'] = $this->Course_model->get_coursepicture($data['course_id']);

        $this->load->view('dashboard/course/photo_resize_form', $data);
    }

//    ============= its for photo_resize_submit =========
    public function photo_resize_submit() {
        $image_path = $this->input->post('image_path', TRUE);
        $widthsize = $this->input->post('widthsize', TRUE);
        $heightsize = $this->input->post('heightsize', TRUE);
        // if logo is uploaded then resize the logo
        if (!empty($image_path) && !empty($widthsize) && !empty($heightsize)) {
            $this->fileupload->do_resize(
                    $image_path, $widthsize, $heightsize
            );
            echo "1";
        } else {
            echo "0";
        }
    }

    public function csrf_generator() {
        $section_id = $this->input->post('section_id', TRUE);
        echo $this->security->get_csrf_hash();
    }

    public function add_exam($course_id = null) {
        $data['title'] = 'Quiz';
        $data['course_wise_section'] = $this->Course_model->course_wise_section($course_id);

        $data['module'] = "dashboard";
        $data['page'] = "course/add_exam";
        echo modules::run('template/layout', $data);
    }

    public function exam_save() {
        $exam_id = "Ex" . date('d') . $this->generators->generator(5);
        $course_id = $this->input->post('course_id', true);
        $chapter_id = $this->input->post('chapter_id', true);
        $name = $this->input->post('name', true);
        $pass_mark = $this->input->post('pass_mark', TRUE);
        $question_type = $this->input->post('question_type', true);
        $question_mark = $this->input->post('question_mark', true);
        $question = $this->input->post('question', true);
        $shortanswer = $this->input->post('shortanswer', true);
        $option_text = $this->input->post('option_text', true);
        // $is_answer = $this->input->post('is_answer', true);
        // $hdn_isans = $this->input->post('hdn_isans', true);
        $status = 1;
        
        $get_quizinfo = $this->db->select_max("quiz_order")->from('assign_courseexam_tbl')->where('course_id', $course_id)->get()->row();
        if($get_quizinfo){
            $quiz_order = ($get_quizinfo->quiz_order+1);
        }else{
            $quiz_order = 1;
        }
        
        $examdata = array(
            'exam_id' => $exam_id,
            'name' => $name,
            'pass_mark' => $pass_mark,
            'status' => $status,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        // d($examdata);
        $this->db->insert('exam_tbl', $examdata);
        for ($i = 0, $j = 1; $i < count($question); $i++, $j++) {
            $question_id = "QST" . date('d') . $this->generators->generator(5);

            $questiondata = array(
                'question_id' => $question_id,
                'name' => $question[$i],
                'exam_id' => $exam_id,
                'question_type' => $question_type[$i],
                'question_mark' => $question_mark[$i],
                'shortanswer' => ($shortanswer[$i] == '') ? '' : $shortanswer[$i],
                'status' => $status,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id,
                'created_date' => $this->createdtime,
            );

            // d($questiondata);
            $this->db->insert('question_tbl', $questiondata);
            $options = $this->input->post('question_' . $j . '_option');
            $hdn_isans = $this->input->post('question_' . $j . '_hdn_isans');
            if ($options) {
                for ($k = 0; $k < count($options); $k++) {
                    $questionoption_data = array(
                        'option_id' => "OPT" . date('d') . $this->generators->generator(4),
                        'question_id' => $question_id,
                        'option_type' => '',
                        'option_name' => $options[$k],
                        'is_answer' => ($hdn_isans[$k] == '') ? 0 : $hdn_isans[$k],
                    );
                    //    d($questionoption_data);
                    $this->db->insert('question_option_tbl', $questionoption_data);
                }
            }
        }
        // ================== its for exam course assign ================
        if($course_id){
        $assigndata = array(
            'course_id' => $course_id,
            'section_id' => $chapter_id,
            'exam_id' => $exam_id,
            'enterprise_id' => get_enterpriseid(),
            'status' => 1,
            'quiz_order' => $quiz_order,
            'created_by' => get_userid(),
            'created_date' => $this->createdtime,
        );
        $this->db->insert('assign_courseexam_tbl', $assigndata);
    }
    
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Exam added successfully!</div>");
        if($course_id){
            redirect(enterpriseinfo()->shortname . '/course-edit/'.$course_id);
        }else{
            redirect(enterpriseinfo()->shortname . '/add-exam');
        }
    }

    public function exam_list() {
        $data['title'] = display('quiz_list');

        $data['module'] = "dashboard";
        $data['page'] = "course/exam_list";
        echo modules::run('template/layout', $data);
    }

    public function get_examlist() {
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getexamlist($postData, $search);
        echo json_encode($data);
    }

    public function total_examcount($search = null, $searchQuery = null) {
        $this->db->select('a.*');
        $this->db->from('exam_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status !=", 2);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getexamlist($postData = null, $searchs = null) {
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
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_examcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*');
        $this->db->from('exam_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status !=", 2);
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
            $i = 1;

            $addquestion = '<a href="javascript:void(0)" onclick="addQusetionModal(' . "'" . $record->exam_id . "'" . ',' . "'list'" . ')" data-toggle="tooltip" title="' . display('add_question') . '" ><i class="fa fa-plus btn-info  btn btn-sm"></i></a>';
            $show = '<a href="javascript:void(0)" onclick="showExam(' . "'" . $record->exam_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" ><i class="fa fa-eye btn-primary  btn btn-sm"></i></a>';

            if ($record->status == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="examinactive(' . "'" . $record->exam_id . "'" . ')" data-toggle="tooltip" title="' . display('inactive') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
            } elseif ($record->status == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="examactive(' . "'" . $record->exam_id . "'" . ')" data-toggle="tooltip" title="' . display('active') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }

            // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname . "/exam-edit/" . $record->exam_id) . '" data-toggle="tooltip" title="' . display('edit_exam') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a>';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
            $deletebtn = '<a href="javascript:void(0)" onclick="exam_delete(' . "'" . $record->exam_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
            $action = $addquestion . ' ' . $show . ' ' . $statusbtn . ' ' . $editbtn . ' ' . $deletebtn;

            $data[] = array(
                "sl" => $sl++,
                "name" => !empty($record->name) ? $record->name : " ",
                "created_date" => $record->created_date,
                "created_by" => !empty(get_userinfo($record->created_by)->name) ? get_userinfo($record->created_by)->name : " ",
                "updated_date" => $record->updated_date,
                "updated_by" => !empty(get_userinfo($record->updated_by)->name) ? get_userinfo($record->updated_by)->name : " ",
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

    // public function exam_edit($exam_id) {
    //     $data['title'] = 'Quiz';
    //     $data['get_exameditdata'] = $this->Course_model->get_exameditdata($exam_id);
    //     $data['get_examwisequestion'] = get_examwisequestion($data['get_exameditdata']->exam_id, get_enterpriseid());
    //     // dd($data['get_exameditdata']);
    //     $data['course_wise_section'] = $this->Course_model->course_wise_section($exam_id);

    //     $data['module'] = "dashboard";
    //     $data['page'] = "course/exam_edit";
    //     echo modules::run('template/layout', $data);
    // }
    public function course_exam_edit($id) {
        $data['title'] = 'Quiz Edit';
        $data['get_assign_courseexam'] = $this->db->select('*')->from('assign_courseexam_tbl')->where('id', $id)->get()->row();
        $exam_id = $data['get_assign_courseexam']->exam_id;
        $data['course_id'] = $data['get_assign_courseexam']->course_id;
        $data['assign_id'] = $data['get_assign_courseexam']->id;
        $data['get_exameditdata'] = $this->Course_model->get_exameditdata($exam_id);
        $data['get_examwisequestion'] = get_examwisequestion($data['get_exameditdata']->exam_id, get_enterpriseid());
        // dd($data['get_exameditdata']);
        $data['course_wise_section'] = $this->Course_model->course_wise_section($exam_id);

        $data['module'] = "dashboard";
        $data['page'] = "course/exam_edit";
        echo modules::run('template/layout', $data);
    }

    public function exam_update() {
        $course_id = $this->input->post('course_id', true);
        $exam_id = $this->input->post('exam_id', true);
        $name = $this->input->post('name', true);
        $pass_mark = $this->input->post('pass_mark', true);
        $question_type = $this->input->post('question_type', true);
        $question_mark = $this->input->post('question_mark', true);
        $question = $this->input->post('question', true);
        $shortanswer = $this->input->post('shortanswer', true);
        $option_text = $this->input->post('option_text', true);
        // $is_answer = $this->input->post('is_answer', true);
        // $hdn_isans = $this->input->post('hdn_isans', true);
        $status = 1;

        $examdata = array(
            'name' => $name,
            'pass_mark' => $pass_mark,
            'status' => $status,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        // dd(count($question));
        $this->db->where('exam_id', $exam_id)->update('exam_tbl', $examdata);
        $get_examwisequestion = $this->Course_model->get_examwisequestion($exam_id);
        foreach ($get_examwisequestion as $single) {
            $this->db->where('question_id', $single->question_id)->delete('question_option_tbl');
        }
        $this->db->where('exam_id', $exam_id)->delete('question_tbl');
        // $this->db->where('question_id', $question_id)->delete('question_option_tbl');

        for ($i = 0, $j = 1; $i < count($question); $i++, $j++) {
            $question_id = "QST" . date('d') . $this->generators->generator(5);

            $questiondata = array(
                'question_id' => $question_id,
                'name' => $question[$i],
                'exam_id' => $exam_id,
                'question_type' => $question_type[$i],
                'question_mark' => $question_mark[$i],
                'shortanswer' => ($shortanswer[$i] == '') ? '' : $shortanswer[$i],
                'status' => $status,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id,
                'created_date' => $this->createdtime,
            );

            // d($questiondata);
            $this->db->insert('question_tbl', $questiondata);
            $options = $this->input->post('question_' . $j . '_option');
            $hdn_isans = $this->input->post('question_' . $j . '_hdn_isans');
            if ($options) {
                for ($k = 0; $k < count($options); $k++) {
                    $questionoption_data = array(
                        'option_id' => "OPT" . date('d') . $this->generators->generator(4),
                        'question_id' => $question_id,
                        'option_type' => '',
                        'option_name' => $options[$k],
                        'is_answer' => ($hdn_isans[$k] == '') ? 0 : $hdn_isans[$k],
                    );
                    //    d($questionoption_data);
                    $this->db->insert('question_option_tbl', $questionoption_data);
                }
            }
        }
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Quiz updated successfully!</div>");
        redirect(enterpriseinfo()->shortname . '/course-edit/'.$course_id);
    }

//    =============== its for add question modal ==============
    public function add_questionform() {
        $data['exam_id'] = $this->input->post('exam_id', true);
        $data['action'] = $this->input->post('action', true);
        $data['assign_id'] = $this->input->post('assign_id', true);

        $this->load->view('dashboard/course/add_questionmodalform', $data);
    }

    public function question_save() {
        $mode = $this->input->post('mode', TRUE);
        $assign_id = $this->input->post('assign_id', TRUE);
        $exam_id = $this->input->post('exam_id', TRUE);
        $question_id = "QST" . date('d') . $this->generators->generator(6);
        $question_type = $this->input->post('question_type', TRUE);
        $question = $this->input->post('question_name', TRUE);
        $question_mark = $this->input->post('question_mark', TRUE);
        $shortanswer = $this->input->post('shortanswer', TRUE);
        $option_text = $this->input->post('option_text', TRUE);
        $is_answer = $this->input->post('is_answer', TRUE);
        $hdn_ans = $this->input->post('hdn_isans', TRUE);

        $question_data = array(
            'exam_id' => $exam_id,
            'question_id' => $question_id,
            'name' => $question,
            'question_type' => $question_type,
            'question_mark' => $question_mark,
            'shortanswer' => $shortanswer,
            'status' => 1,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => get_userid(),
            'created_date' => $this->createdtime,
        );
        // d($question_data);
        $this->db->insert('question_tbl', $question_data);
        if ($question_type == 1 || $question_type == 2) {
//        =============its for question option data ==========
            for ($i = 0; $i < count($option_text); $i++) {
                $questionoption_data = array(
                    'option_id' => "OPT" . date('d') . $this->generators->generator(4),
                    'question_id' => $question_id,
                    'option_type' => '',
                    'option_name' => $option_text[$i],
                    'is_answer' => ($hdn_ans[$i] == '') ? 0 : $hdn_ans[$i],
                );
                //    d($questionoption_data);
                $this->db->insert('question_option_tbl', $questionoption_data);
            }
        }


        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Question added successfully!</div>");
        if ($mode == 'edit') {
            // redirect(enterpriseinfo()->shortname . '/exam-edit/' . $exam_id);
            redirect(enterpriseinfo()->shortname . '/course-exam-edit/' . $assign_id);
        } else {
            redirect(enterpriseinfo()->shortname . '/exam-list/');
        }
    }

//    =============== its for show exam set form modal ==============
    public function show_examset() {
        $data['exam_id'] = $this->input->post('exam_id', true);
        $data['get_examinfo'] = $this->Course_model->get_exameditdata($data['exam_id']);
        $data['get_examwisequestion'] = get_examwisequestion($data['exam_id'], get_enterpriseid());
        // dd($data['get_examwisequestion']);
        $this->load->view('dashboard/course/show_examset', $data);
    }

//    ============ its for exam inactive =============
    public function exam_inactive() {
        $exam_id = $this->input->post('exam_id', TRUE);
        $data = array(
            'status' => 0,
        );
        $this->db->where('exam_id', $exam_id);
        $this->db->update('exam_tbl', $data);
        activitiylog_save($exam_id . " Exam Inactive By", "Inactive", $this->user_id, $this->createdtime);
        echo display('inactive_successfully');
    }

// //    ================== its for exam active ============
    public function exam_active() {
        $exam_id = $this->input->post('exam_id', TRUE);
        $data = array(
            'status' => 1,
        );
        $this->db->where('exam_id', $exam_id);
        $this->db->update('exam_tbl', $data);
        activitiylog_save($exam_id . " Exam Active By", "Active", $this->user_id, $this->createdtime);
        echo display('active_successfully');
    }

//    ============== its for exam delete ==========
    public function exam_delete() {
        $exam_id = $this->input->post('exam_id', true);
        $data = array(
            'status' => 2,
            'deleted_by' => $this->user_id,
            'deleted_date' => $this->createdtime
        );
        $this->db->where('exam_id', $exam_id)->update('exam_tbl', $data);
        activitiylog_save("Exam Deleted By", "Delete", $this->user_id, $this->createdtime);
        echo 1;
        // $courseIsinvoice = $this->Course_model->courseIsinvoice($course_id);
        // if ($courseIsinvoice) {
        //     echo 0;
        // } else {
        //     $this->db->where('section_id', $section_id)->delete('section_tbl');
        //     activitiylog_save(" Section Delete By", "Delete", $this->user_id, $this->createdtime);
        //     echo 1;
        // }
    }

    // end_archive_list
    public function exam_archives() {
        $data['title'] = display('exam_archives_list');
        $data['module'] = "dashboard";
        $data['page'] = "course/exam_archives";
        $data['total_archive'] = $this->total_archivecount();
        echo modules::run('template/layout', $data);
    }

    public function get_archivelist() {
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getarchivelist($postData, $search);
        echo json_encode($data);
    }

    public function total_archivecount($search = null, $searchQuery = null) {
        $this->db->select('a.*');
        $this->db->from('exam_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status", 2);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getarchivelist($postData = null, $searchs = null) {
        $response = array();
        ## Read value
        $draw = @$postData['draw'];
        $start = @$postData['start'];
        $rowperpage = @$postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (a.name like '%" . $searchValue . "%')
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_archivecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*');
        $this->db->from('exam_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status", 2);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;

            // $addquestion = '<a href="javascript:void(0)" onclick="addQusetionModal(' . "'" . $record->exam_id . "'" . ','."'list'".')" data-toggle="tooltip" title="' . display('add_question') . '" ><i class="fa fa-plus btn-info  btn btn-sm"></i></a>';
            // $show = '<a href="javascript:void(0)" onclick="showExam(' . "'" . $record->exam_id . "'" .')" data-toggle="tooltip" title="' . display('show') . '" ><i class="fa fa-eye btn-primary  btn btn-sm"></i></a>';
            // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname . "/exam-edit/" . $record->exam_id) . '" data-toggle="tooltip" title="' . display('edit_exam') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a>';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
            //  $deletebtn = '<a href="javascript:void(0)" onclick="exam_delete(' . "'" . $record->exam_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
            $action = ''; //$addquestion .' '. $show .' '. $editbtn . ' ' . $deletebtn;

            $data[] = array(
                "sl" => $sl++,
                "name" => !empty($record->name) ? $record->name : " ",
                "deleted_date" => !empty($record->deleted_date) ? $record->deleted_date : " ",
                "deleted_by" => !empty(get_userinfo($record->deleted_by)->name) ? get_userinfo($record->deleted_by)->name : " ",
                    // "action" => $action,
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

// end_archive_list


    public function course_archive() {
        $data['title'] = display('course_archives');
        $data['get_category'] = $this->Category_model->get_category();
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['course_quickview'] = $this->Course_model->course_quickview($this->user_id, $this->user_type);

        $data['module'] = "dashboard";
        $data['page'] = "course/course_archive";
        // $data['total_coursearchive'] = $this->total_coursearchivecount();
        echo modules::run('template/layout', $data);
    }

//    ========= its for course archive datalist ===========
    public function course_archivedatalist() {
        $postData = $_POST;
        $search = (object) array(
                    'name' => $this->input->post('name'),
                    'category_id' => $this->input->post('category_id'),
                    'course_id' => $this->input->post('course_id'),
                    'faculty_id' => $this->input->post('faculty_id'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
        );
        // Get data
        $data = $this->coursearchivedatalist($postData, $search);
        echo json_encode($data);
    }

    public function total_coursearchivecount($search = null, $searchQuery = null) {
        $this->db->select('a.*, b.name as category_name, c.name as faculty_name, c.user_types as usertype');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');

        $this->db->where('is_livecourse', 0);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status", 3);

        $start_date = $search->start_date;
        $end_date = $search->end_date;
        $dateRange = "a.created_date BETWEEN '$start_date' AND '$end_date'";

        if ($search->category_id && $search->course_id && $search->faculty_id && $search->start_date && $search->end_date) {
            $this->db->where('a.category_id', $search->category_id);
            $this->db->where('a.course_id', $search->course_id);
            $this->db->where('a.faculty_id', $search->faculty_id);
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($search->category_id && $search->course_id && $search->faculty_id) {
            $this->db->where('a.category_id', $search->category_id);
            $this->db->where('a.course_id', $search->course_id);
            $this->db->where('a.faculty_id', $search->faculty_id);
        } elseif ($search->start_date && $search->end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($search->category_id) {
            $this->db->where('a.category_id', $search->category_id);
        } elseif ($search->course_id) {
            $this->db->where('a.course_id', $search->course_id);
        } elseif ($search->faculty_id) {
            $this->db->where('a.faculty_id', $search->faculty_id);
        }

        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function coursearchivedatalist($postData = null, $searchs = null) {
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
            $searchQuery = " (a.name like '%" . $searchValue . "%'
                or b.name like '%" . $searchValue . "%'
                or c.name like '%" . $searchValue . "%')
                ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_coursearchivecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*,a.name as course_name, b.name as category_name, c.name as faculty_name, c.user_types as usertype');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');


        $this->db->where('is_livecourse', 0);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status", 3);

        $start_date = $searchs->start_date;
        $end_date = $searchs->end_date;
        $dateRange = "a.created_date BETWEEN '$start_date' AND '$end_date'";
        if ($searchs->category_id && $searchs->course_id && $searchs->faculty_id && $searchs->start_date && $searchs->end_date) {
            $this->db->where('a.category_id', $searchs->category_id);
            $this->db->where('a.course_id', $searchs->course_id);
            $this->db->where('a.faculty_id', $searchs->faculty_id);
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($searchs->category_id && $searchs->course_id && $searchs->faculty_id) {
            $this->db->where('a.category_id', $searchs->category_id);
            $this->db->where('a.course_id', $searchs->course_id);
            $this->db->where('a.faculty_id', $searchs->faculty_id);
        } elseif ($searchs->start_date && $searchs->end_date) {
            $this->db->where($dateRange, NULL, FALSE);
        } elseif ($searchs->category_id) {
            $this->db->where('a.category_id', $searchs->category_id);
        } elseif ($searchs->course_id) {
            $this->db->where('a.course_id', $searchs->course_id);
        } elseif ($searchs->faculty_id) {
            $this->db->where('a.faculty_id', $searchs->faculty_id);
        }

        // $this->db->order_by('a.id', 'desc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        // $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $course_wise_sectioncount = $this->Course_model->course_wise_sectioncount($record->course_id);
            $course_wise_lessoncount = $this->Course_model->course_wise_lessoncount($record->course_id);


            $coursedetalslink = $restorebtn = $action = '';

            $categorybtn = '<a href="javascript:void(0)" onclick="showcategory(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >' . (!empty($record->category_name) ? $record->category_name : " ") . '</a>';
            $facultylink = '<a href="javascript:void(0)" onclick="showinstructor(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >' . (!empty($record->faculty_name) ? $record->faculty_name : " ") . '</a>';

            $coursedetalslink = '<a href="javascript:void(0)" data-toggle="tooltip" title="Course Details">' . $record->name . '</a>';


            $lesson_section = '<strong>Total Section : </strong>' . $course_wise_sectioncount . '<br> <strong>Total Lesson : </strong> ' . $course_wise_lessoncount;

            // if ($this->permission->check_label('course_list')->delete()->access()) {
            $restorebtn = '<a href="javascript:void(0)" onclick="course_restore(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('restore') . '" ><i class="fas fa-redo-alt btn-s text-white btn btn-sm"></i></a>';
            // }
            $action = $restorebtn;


            $data[] = array(
                "sl" => $sl++,
                "course_name" => $coursedetalslink,
                "category_name" => $categorybtn,
                "faculty_name" => $facultylink,
                "sectionlesson_count" => $lesson_section,
                'created_date' => (!empty($record->created_date) ? $record->created_date : ''),
                'created_by' => (!empty($record->created_by) ? get_userinfo($record->created_by)->name : ''),
                'updated_date' => (!empty($record->updated_date) ? $record->updated_date : ''),
                'updated_by' => (!empty($record->updated_by) ? get_userinfo($record->updated_by)->name : ''),
                'deleted_date' => (!empty($record->deleted_date) ? $record->deleted_date : ''),
                'deleted_by' => (!empty($record->deleted_by) ? get_userinfo($record->deleted_by)->name : ''),
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

    public function course_restore() {
        $course_id = $this->input->post('course_id', TRUE);
        $data = array(
            'status' => 1,
        );
        $this->db->where('course_id', $course_id)->update('course_tbl', $data);
        activitiylog_save("Course restore By", "Restore", $this->user_id, $this->createdtime);
        echo 1;
        // }
    }

    public function customvideocheck() {
        // $data['title'] = display('exam_information');        
        // $data['get_exameditdata'] = $this->Course_model->get_exameditdata($exam_id);
        // $data['get_examwisequestion'] = get_examwisequestion($data['get_exameditdata']->exam_id);

        $data['module'] = "dashboard";
        // $data['page'] = "course/customvideocheck";
        // $data['page'] = "course/testvideo";
        $data['page'] = "course/testvideVimeo";
        echo modules::run('template/layout', $data);
    }

    // public function video_watch_time(){
    //   $watchtime= $this->input->post('video_watch_time',true);
    //   $finish= $this->input->post('finish',true);
    //   $check_watchtime = $this->db->select('*')->from('time_tbl')->where('id','1')->where('leasion_id','1')->get()->row();
    //     if($check_watchtime->real_time){
    //         if(!empty($finish)){
    //             // echo "yes";
    //             // exit;
    //             echo  $pausetime = $watchtime-$check_watchtime->pausetime;
    //             echo  $total_times = $check_watchtime->real_time+$pausetime;
    //             $data = array(
    //                 'real_time'=>$total_times,
    //                 'pausetime'=>'',
    //                 );
    //             $dd=$this->db->where('id','1')->update('time_tbl', $data);
    //         }else{
    //             if(!empty($check_watchtime->pausetime)){
    //                 echo "ami pause";   
    //                          $pausetime = $watchtime-$check_watchtime->pausetime;
    //                     echo $totalPauseTime = $check_watchtime->pausetime+$pausetime;
    //                     $total=$pausetime+$check_watchtime->real_time;
    //                     $this->db->where('id','1')->update('time_tbl', array('real_time'=>$total,'pausetime'=>$totalPauseTime));
    //             }else{
    //                 echo "pause time is empty";
    //                 $pausetime1=$watchtime;
    //                 $data=array(
    //                     'pausetime'  =>$pausetime1,
    //                 );
    //                 $this->db->where('id','1')->update('time_tbl', $data);
    //             }
    //         }
    //     }else{  
    //         $data=array(
    //         'real_time'  =>$watchtime,
    //         'pausetime'  =>$watchtime,
    //         'leasion_id' =>1
    //         );
    //         $this->db->insert('time_tbl', $data);
    //     }
    // }
    // latest process
    public function video_watch_time() {
        $watchtime = $this->input->post('watch_time', true);
        $finish = $this->input->post('finish', true);
        $pagereload = $this->input->post('pagereload', true);
        $check_watchtime = $this->db->select('*')->from('time_tbl')->where('id', '1')->where('leasion_id', '1')->get()->row();
        if (!empty($check_watchtime->real_time)) {
            if ($pagereload == "pagereload") {
                $total_time = $check_watchtime->real_time;
                $data = array(
                    'real_time' => $total_time,
                    'pausetime' => '',
                );
                $this->db->where('id', '1')->update('time_tbl', $data);
            } else {


                if (!empty($finish)) {
                    $pausetime = $watchtime - $check_watchtime->pausetime;
                    $total_times = $check_watchtime->real_time + $pausetime;
                    $data = array(
                        'real_time' => $total_times,
                        'pausetime' => '',
                    );
                    $this->db->where('id', '1')->update('time_tbl', $data);
                } else {
                    //  pause time check
                    if (!empty($check_watchtime->pausetime)) {
                        $pausetime = $watchtime - $check_watchtime->pausetime;
                        $totalPauseTime = $check_watchtime->pausetime + $pausetime;
                        $total = $pausetime + $check_watchtime->real_time;

                        $this->db->where('id', '1')->update('time_tbl', array('real_time' => $total, 'pausetime' => $totalPauseTime));
                    } else {
                        $pausetime1 = $watchtime;
                        $updatetime = $watchtime + $check_watchtime->real_time;

                        $data = array(
                            'real_time' => $updatetime,
                            'pausetime' => $pausetime1,
                        );

                        $this->db->where('id', '1')->update('time_tbl', $data);
                    }
                }
            }
        } else {
            if ($pagereload == "pagereload") {
                $total_time = $check_watchtime->real_time;
                $pauserTime = $watchtime;
                $data = array(
                    'real_time' => $total_time,
                    'pausetime' => '',
                );
                $this->db->where('id', '1')->update('time_tbl', $data);
            } else {
                $data = array(
                    'real_time' => $watchtime,
                    'pausetime' => $watchtime,
                    'leasion_id' => 1
                );
                $this->db->insert('time_tbl', $data);
            }
        }
    }
//===== site faq ====

    public function faq() {
        $data['title'] = display('faq');
        $data['total_faq'] = $this->total_faqcount();


        $data['module'] = "dashboard";
        $data['page'] = "course/faq";
        echo modules::run('template/layout', $data);
    }

    public function faq_save() {
        $mode = $this->input->post('mode', TRUE);
        $id = $this->input->post('id', TRUE);
        $question = $this->input->post('question', TRUE);
        $answer = $this->input->post('answer', TRUE);

        if ($mode == 'edit') {
            $faq_data = array(
                'question' => $question,
                'answer' => $answer,
                'type' => 2,
                'status' => 1,
                'enterprise_id' => get_enterpriseid(),
                'updated_date' => $this->createdtime,
                'updated_by' => $this->user_id,
            );
            $this->db->where('id', $id)->update('faq_tbl', $faq_data);
            activitiylog_save(" FAQ Updated By", "Update", $this->user_id, $this->createdtime);
            echo display('updated_successfully');
        } else {
            $check_faq = $this->db->where('question', $question)->get('faq_tbl')->row();
            if ($check_faq) {
                echo display('already_exists');
            } else {
                $faq_data = array(
                    'question' => $question,
                    'answer' => $answer,
                    'type' => 2,
                    'status' => 1,
                    'enterprise_id' => get_enterpriseid(),
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('faq_tbl', $faq_data);
                activitiylog_save(" FAQ Insert By", "Insert", $this->user_id, $this->createdtime);
                echo display('added_successfully');
            }
        }
    }

    public function get_faqlist() {
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getfaqlist($postData, $search);
        echo json_encode($data);
    }

    public function total_faqcount($search = null, $searchQuery = null) {
        $this->db->select('*');
        $this->db->from('faq_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.type", 2);
        $this->db->where("a.status", 1);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getfaqlist($postData = null, $searchs = null) {
        $response = array();
        ## Read value
        $draw = @$postData['draw'];
        $start = @$postData['start'];
        $rowperpage = @$postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Search 
        $searchQuery = "";
        $get_enterpriseid = get_enterpriseid();
        if ($searchValue != '') {
            $searchQuery = " (a.question like '%" . $searchValue . "%'
                            or a.answer like '%" . $searchValue . "%')
            ";
            // $wheredd = '"a.enterprise_id", get_enterpriseid()';
        }
        // echo  $searchQuery;exit();
        ## Total number of records without filtering
        $totalRecords = $this->total_faqcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*');
        $this->db->from('faq_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.type", 2);
        $this->db->where("a.status", 1);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
//         echo $this->db->last_query(); exit();
        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $action = $editbtn = $deletebtn = '';

//            if ($this->permission->check_label('category')->update()->access())  {
            $editbtn = '<a href="javascript:void(0)" onclick="faqedit(' . "'" . $record->id . "'" . ')" data-toggle="tooltip" title="' . display('edit') . '" ><i class="fa fa-edit btn btn-sm btn-success text-white"></i> </a> ';
//            }
//            if ($this->permission->check_label('category')->delete()->access()) {
            $deletebtn = '<a href="javascript:void(0)" onclick="faq_delete(' . "'" . $record->id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
//            }

            $action = $editbtn . ' ' . $deletebtn;

            $data[] = array(
                "sl" => $sl++,
                "question" => $record->question,
                "answer" => $record->answer,
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

    public function faqedit_form() {
        $data['title'] = 'FAQ Information';
        $faqid = $this->input->post('id', True);
        $data['faqeditdata'] = $this->Course_model->faqeditdata($faqid);

        $this->load->view('course/faqedit_form', $data);
    }

    public function faq_delete() {
        $id = $this->input->post('id', True);
        if ($id) {
            $this->db->where('id', $id)->delete('faq_tbl');
        }
        echo display('deleted_successfully');
    }
    //====end site faq====

 //    =============== its for sharepercent_form ==============
 public function sharepercent_form() {
    $enterprise_id=get_enterpriseid();

    $data['course_id'] = $this->input->post('course_id', true);
    $data['edit_data'] = $this->Course_model->edit_data($data['course_id']);
    $data['get_templates'] = $this->Course_model->get_templates($type = 'certificate',$enterprise_id);
    $this->load->view('dashboard/course/sharepercent_form', $data);
}



// =========== its for sharepercent_save ==================
public function sharepercent_save(){
    $course_id = $this->input->post('course_id', true);
    $share_percent = $this->input->post('share_percent', true);
    $certificate_id = $this->input->post('certificate_id', true);

    $tagstatus = $this->input->post('tagstatus', TRUE);
    $toexplore = $this->input->post('toexplore', TRUE);
    $agreementstatus = $this->input->post('agreementstatus', TRUE);
    $agreement_reason = $this->input->post('agreement_reason', TRUE);
        
        if($tagstatus == 0){
            $tagname = 'None';
        }elseif($tagstatus == 1){
            $tagname = 'Recommended';
        }elseif($tagstatus == 2){
            $tagname = 'Best Sellers';
        }elseif($tagstatus == 3){
            $tagname = 'New Courses';
        }elseif($tagstatus == 4){
            $tagname = 'Most Popular';
        }

    // $docusign = $this->fileupload->do_upload(
    //     'assets/uploads/docusin/', 'docusign','gif|jpg|png|jpeg|ico|pdf'
    // );

    // $docusign = $this->fileupload->update_doupload(
    //     $course_id, 'assets/uploads/docusin/', 'docusign','gif|jpg|png|jpeg|ico|pdf'
    // );
    
    $sharedata = array(
        'share_percent' => $share_percent,
        // 'docusign' => $docusign,
        // 'docusign'        => (!empty($docusign) ? $docusign : $this->input->post('old_docusign', true)),
        'certificate_id' => $certificate_id,
        'tagstatus' => $tagstatus,
        'toexplore' => $toexplore,
        'agreement_status' => $agreementstatus,
        'agreement_reason' => (($agreementstatus == 4) ? $agreement_reason : ''),
    );
 
    if($sharedata){
        $this->db->where('course_id', $course_id)->update('course_tbl', $sharedata);

        echo "Added successfully!";
    }
}


 //    =============== its for tagstatus_form ==============
//  public function tagstatus_form() {
//     $data['course_id'] = $this->input->post('course_id', true);
//     $data['edit_data'] = $this->Course_model->edit_data($data['course_id']);

//     $this->load->view('dashboard/course/tagstatus_form', $data);
// }

    // public function tagstatus_save() {
    //     $course_id = $this->input->post('course_id', TRUE);
    //     $tagstatus = $this->input->post('tagstatus', TRUE);
    //     $toexplore = $this->input->post('toexplore', TRUE);
        
    //     if($tagstatus == 0){
    //         $tagname = 'None';
    //     }elseif($tagstatus == 1){
    //         $tagname = 'Recommended';
    //     }elseif($tagstatus == 2){
    //         $tagname = 'Best Sellers';
    //     }elseif($tagstatus == 3){
    //         $tagname = 'New Courses';
    //     }elseif($tagstatus == 4){
    //         $tagname = 'Most Popular';
    //     }
        

    //     $data = array(
    //         'tagstatus' => $tagstatus,
    //         'toexplore' => $toexplore,
    //     );
    //     $this->db->where('course_id', $course_id);
    //     $this->db->update('course_tbl', $data);
    //     activitiylog_save($course_id . " Course tag status ", ".$tagname. ", $this->user_id, $this->createdtime);
    
    //      echo display('added_successfully');
    // }

    
    public function course_agreement_paperupload(){
        $courseid = $this->input->post('courseid', TRUE);
       
        //apps_logo upload
        $docusign = $this->fileupload->do_resumeupload(
            'assets/uploads/docusin/', 'docusign','gif|jpg|png|jpeg|ico|pdf'
        );
        $docusigndata = array(
            'docusign'        => (!empty($docusign) ? $docusign : $this->input->post('old_docusign', true)),
            'agreement_status' => 1,
        );
        $this->db->where('course_id', $courseid)->update('course_tbl', $docusigndata);
        // echo 'Resume updated successfully!';
        
        $upload = 'err'; 
        if(!empty($_FILES['docusign'])){ 
            
            // File upload configuration 
            $targetDir = "assets/uploads/"; 
            $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
            
            $fileName = basename($_FILES['docusign']['name']); 
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

// === course faq start here === 
public function course_faq() {
    $data['title'] = display('faq');
    $data['total_faqs'] = $this->course_total_faqcount();
    $data['module'] = "dashboard";
    $data['page'] = "course/course_faq";
    $data['get_course'] = $this->Course_model->get_course();
    echo modules::run('template/layout', $data);
}
public function course_faq_save() {
    $id = $this->input->post('id', TRUE);
    $question = $this->input->post('question', TRUE);
    $answer = $this->input->post('answers', TRUE);
    $course_id = $this->input->post('course_id', TRUE);
    $old_id = $this->input->post('old_id', TRUE);
    $check_faq = '';
    // d($course_id); d($old_id);
    if ($id) {
        if($course_id !=  $old_id){
            $check_faq = $this->db->where('course_id', $course_id)->get('faq_tbl')->num_rows();
        }
          if ($check_faq) {
              echo "2";
              exit;
            }else{
                
            $faq_data = array(
                'course_id' => $course_id,
                'question' => $question,
                'answer' => $answer,
                'type' => 1,
                'status' => 1,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->where('id', $id)->update('faq_tbl', $faq_data);
            activitiylog_save($question . " FAQ Updated By", "Update", $this->user_id, $this->createdtime);
            echo display('updated_successfully');
         }
        
    } else {
        $check_faq = $this->db->where('course_id', $course_id)->get('faq_tbl')->row();
        if ($check_faq) {
            echo "2";
            // echo display('already_exists');
        }else{
            $faq_data = array(
                'course_id' => $course_id,
                'question' => $question,
                'answer' => $answer,
                'type' => 1,
                'status' => 1,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('faq_tbl', $faq_data);
            activitiylog_save($question . " FAQ Insert By", "Insert", $this->user_id, $this->createdtime);
            echo display('added_successfully');
        }
    }
}

public function course_total_faqcount($search = null, $searchQuery = null) {
    $this->db->select('a.*,b.*');
    $this->db->from('faq_tbl a');
    $this->db->join('course_tbl b', 'b.course_id = a.course_id',"left");
    if ($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->where('a.enterprise_id', get_enterpriseid());
    $this->db->where("a.type", 1);
    $this->db->where("a.status", 1);
    $this->db->order_by('a.id', 'desc');
    $query = $this->db->get();
    $record = $query->num_rows();
    return $record;
}
public function course_get_faqlist() {
    $postData = $_POST;
    $search = (object) array();
    // Get data
    $data = $this->coursegetfaqlist($postData, $search);
    echo json_encode($data);
}
public function coursegetfaqlist($postData = null, $searchs = null) {
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
    $get_enterpriseid = get_enterpriseid();
    if ($searchValue != '') {
        $searchQuery = " (b.name like '%" . $searchValue . "%')
        ";
        // $wheredd = '"a.enterprise_id", get_enterpriseid()';
    }
    // echo  $searchQuery;exit();
    ## Total number of records without filtering
    $totalRecords = $this->course_total_faqcount($searchs, $searchQuery);
    ## Total number of record with filtering
    $totalRecordwithFilter = $totalRecords;
    $this->db->select('a.*,a.id as faq_id,b.*');
    $this->db->from('faq_tbl a');
    $this->db->join('course_tbl b', 'b.course_id = a.course_id',"left");
    if ($searchQuery != '')
    $this->db->where($searchQuery);
    $this->db->where('a.enterprise_id', get_enterpriseid());
    $this->db->where("a.type", 1);
    $this->db->where("a.status", 1);
    // $this->db->order_by('a.id', 'desc');
    if($testColumn=='sl'){
        $this->db->order_by('a.id',$columnSortOrder);
    }else{
        $this->db->order_by($testColumn,$columnSortOrder);
    }
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get()->result();
//         echo $this->db->last_query(); exit();
    $data = array();

    $sl = $start + 1;
    foreach ($records as $record) {
        $i = 1;
        $action = $editbtn = $deletebtn = '';

//            if ($this->permission->check_label('category')->update()->access())  {
        $editbtn = '<a href="javascript:void(0)" onclick="faqedits(' . "'" . $record->faq_id . "'" . ')" data-toggle="tooltip" title="' . display('edit') . '" ><i class="fa fa-edit btn btn-sm btn-success text-white"></i> </a>';
//            }
//            if ($this->permission->check_label('category')->delete()->access()) {
        $deletebtn = '<a href="javascript:void(0)" onclick="faq_delete(' . "'" . $record->faq_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
//            }

        $action = $editbtn . ' ' . $deletebtn;

        $data[] = array(
            "sl" => $sl++,
            // "question" => $record->question,
            "name" => $record->name,
             "answer" => '',
            //  "answer" => $record->answer,
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

public function course_faqedit_form() {
    $data['title'] = 'FAQ Information';
    $faqid = $this->input->post('id', True);
    $data['get_course'] = $this->Course_model->get_course();
    $data['faqeditdata'] = $this->Course_model->faqeditdata($faqid);

    $this->load->view('course/course_faq_edit', $data);
}

public function course_faq_delete() {
    $id = $this->input->post('id', True);
    if ($id) {
        $this->db->where('id', $id)->delete('faq_tbl');
    }
    echo display('deleted_successfully');
}
// === course faq end here === 


  // ============== its for projectassignment form ================
  public function projectassignment_form() {
    $data['course_id'] = $this->input->post('course_id', true);
    $enterprise_id = get_enterpriseid();
    // $data['get_lessons'] = get_lessons($data['course_id'], $enterprise_id);
    // $data['get_exams'] = get_exams();

    $this->load->view('dashboard/course/projectassignment_form', $data);
}

public function get_chapterbycourse(){
    $course_id = $this->input->post('course_id');
    $course_chapters = $this->Course_model->get_course_chapters($course_id);
    // d($course_id);die();
    $chapterlist = '';
    $chapterlist .= '<label for="chapters" class="col-sm-3 col-form-label">Select Chapter</label><div class="col-7"><select name="project_chapter" id="project_chapter" class="form-control">';
    if($course_chapters){
     $chapterlist .= '<option value="">Select Chapter</option>'; 
    foreach($course_chapters as $chapters){
    $chapterlist .= '<option value="'.$chapters->section_id.'">'.$chapters->section_name.'</option>'; 
     }
    }else{
      $chapterlist .= '<option value="">No Chapter Found</option>';  
    }
    $chapterlist .= '</select></div>';
    echo $chapterlist;
        // d($course_id);
}

public function project_assignment_add(){
    $course_id          = $this->input->post('course_id',true);
    $title = $this->input->post('title', TRUE);
    $category = $this->input->post('category', TRUE);
    $project_chapter = $this->input->post('project_chapter', TRUE);
    $description = $this->input->post('description', TRUE);
    $pass_score = $this->input->post('pass_score', TRUE);
    $project_mark = $this->input->post('project_mark', TRUE);
    $tips = $this->input->post('tips', TRUE);
    $reference = $this->input->post('reference', TRUE);

    $distribute_title = $this->input->post('distribute_title', TRUE);
    $distribute_mark = $this->input->post('distribute_mark', TRUE);
    $assignment_id      = "PAS" . date('d') . $this->generators->generator(5);

    $get_projectinfo = $this->db->select_max("project_order")->from('project_assingment')->where('course_id', $course_id)->get()->row();
    if($get_projectinfo){
        $project_order = ($get_projectinfo->project_order+1);
    }else{
        $project_order = 1;
    }

    $assigndata = array(
        'assignment_id'     => $assignment_id, //($old_assign_id?$old_assign_id:$assignment_id),
        'course_id'         => $course_id,
        'title'             => $title,
        'category'          => $category,
        'chapter_id'        => $project_chapter,
        'description'       => $description,
        'pass_score'        => $pass_score,
        'project_mark'      => $project_mark,
        'tips'              => $tips,
        'project_reference' => $reference,
        'project_order' => $project_order,
        'enterprise_id' => get_enterpriseid(),
        'create_by'         => $this->user_id,
        'create_date' => $this->createdtime,
    );
    // d($assigndata);
    $this->db->insert('project_assingment', $assigndata);

    for ($i = 0; $i < count($distribute_title); $i++) {
        $d_title = $distribute_title[$i];
        $marks   = $distribute_mark[$i];

        $marksdata = array(
            'assignment_id' => $assignment_id, //($old_assign_id?$old_assign_id:$assignment_id),
            'markes_title'  => $d_title,
            'marks'         => $marks,
            'status'        => 1
        );

        // d($marksdata);
        $this->db->insert('project_mark_details',$marksdata);
    }
    $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Project/assignment added successfully!</div>");
    redirect(enterpriseinfo()->shortname . '/course-edit/' . $course_id);
}

  // ============== its for projectassignment edit form ================
  public function projectassignment_editform() {
    $course_id = $this->input->post('course_id', true);
    $id = $this->input->post('id', true);
    $enterprise_id = get_enterpriseid();
    $data['get_asseignmenteditdata'] = $this->Course_model->get_asseignmenteditdata($id);
    $data['course_wise_section'] = $this->Course_model->course_wise_section($course_id);
    $data['get_project_markdetails'] = $this->Course_model->get_project_markdetails($data['get_asseignmenteditdata']->assignment_id);

    $this->load->view('dashboard/course/projectassignment_editform', $data);
}
public function project_assignment_update(){
    $course_id          = $this->input->post('course_id',true);
    $title = $this->input->post('title', TRUE);
    $category = $this->input->post('category', TRUE);
    $project_chapter = $this->input->post('project_chapter', TRUE);
    $description = $this->input->post('description', TRUE);
    $pass_score = $this->input->post('pass_score', TRUE);
    $project_mark = $this->input->post('project_mark', TRUE);
    $tips = $this->input->post('tips', TRUE);
    $reference = $this->input->post('reference', TRUE);

    $distribute_title = $this->input->post('distribute_title', TRUE);
    $distribute_mark = $this->input->post('distribute_mark', TRUE);
    $assignment_id      = $this->input->post('assignment_id', TRUE);

    $assigndata = array(
        'course_id'         => $course_id,
        'title'             => $title,
        'category'          => $category,
        'chapter_id'        => $project_chapter,
        'description'       => $description,
        'pass_score'        => $pass_score,
        'project_mark'      => $project_mark,
        'tips'              => $tips,
        'project_reference' => $reference,
        'enterprise_id' => get_enterpriseid(),
        'create_by'         => $this->user_id,
        'create_date' => $this->createdtime,
    );
    // d($assigndata);
    $this->db->where('assignment_id', $assignment_id)->update('project_assingment', $assigndata);

    $this->db->where('assignment_id', $assignment_id)->delete('project_mark_details');

    for ($i = 0; $i < count($distribute_title); $i++) {
        $d_title = $distribute_title[$i];
        $marks   = $distribute_mark[$i];

        $marksdata = array(
            'assignment_id' => $assignment_id,
            'markes_title'  => $d_title,
            'marks'         => $marks,
            'status'        => 1
        );

        // d($marksdata);
        $this->db->insert('project_mark_details',$marksdata);
    }
    $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Project/assignment updated successfully!</div>");
    redirect(enterpriseinfo()->shortname . '/course-edit/' . $course_id);
}

  //    ============= its for assignmentproject delete ===========
  public function assignmentproject_delete() {
    $id = $this->input->post('id', true);
    // $courseIsinvoice = $this->Course_model->courseIsinvoice($course_id);
    // if ($courseIsinvoice) {
    //     echo 0;
    // } else {
    $this->db->where('id', $id)->delete('project_assingment');
    activitiylog_save("Assignment project Deleted By", "Delete", $this->user_id, $this->createdtime);
    echo 1;
    // }
}
// ============ its for subscription_pricing ==================
public function subscription_pricing() {
    $data['title'] = display('subscription_pricing');
    $data['get_subscriptionpricing'] = $this->Course_model->get_subscriptionpricing(get_enterpriseid());


    $data['module'] = "dashboard";
    $data['page'] = "course/subscription_pricing";
    echo modules::run('template/layout', $data);
}

// ============= its for subscription_pricing_update ===================
public function subscription_pricing_update(){
    $max_percentage = $this->input->post('max_percentage', True);
    $max_payable = $this->input->post('max_payable', True);
    $cronjob_time = $this->input->post('cronjob_time', True);
    $enterprise_id = get_enterpriseid();
    $checkexistsdata = $this->db->where('enterprise_id', $enterprise_id)->get('subscription_pricing_tbl')->row();
    if($checkexistsdata){
        $pricingdata = array(
            'max_percentage' => $max_percentage,
            'max_payable' => $max_payable,
            'cronjob_time' => $cronjob_time,
            'created_by' => $enterprise_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        $this->db->where('enterprise_id', $enterprise_id)->update('subscription_pricing_tbl', $pricingdata);
        echo "Pricing setting updated successfully!";
    }else{
        $pricingdata = array(
            'max_percentage' => $max_percentage,
            'max_payable' => $max_payable,
            'cronjob_time' => $cronjob_time,
            'enterprise_id' => $enterprise_id,
            'created_by' => $enterprise_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('subscription_pricing_tbl', $pricingdata);
        echo "Pricing setting added successfully!";
    }
}


    public function PromoVideoUpload(){
        $this->load->library('Vimeovideoupload');
        $file_name= $_FILES["video_file"]["tmp_name"];
        $video_response=$this->vimeovideoupload->video_upload($file_name);
        print_r($video_response);
        exit;
    }
    public function LessonVideoUpload(){
        $this->load->library('Vimeovideoupload');
        $file_name= $_FILES["video_file"]["tmp_name"];
        $video_response=$this->vimeovideoupload->video_upload($file_name);
        print_r($video_response);
        exit;
    }

    public function course_preview()    {
        $enterprise_id          = get_enterpriseid();
        $course_id              = $this->input->post('course_id');
        $data['course_info']           = $this->Instructor_model->course_info($course_id);

        if($data["course_info"]->subcategory_id){
            $data['get_subcategoryinfo'] = $this->db->select('name, parent_id')->where('category_id', $data["course_info"]->subcategory_id)->get('category_tbl')->row();
            $data['parent_id'] = $data['get_subcategoryinfo']->parent_id;
            $data['subcategoryname'] = $data['get_subcategoryinfo']->name;
        }
        // d($data['subcategoryname']);
        if($data["course_info"]->category_id){
            $data['get_subcategoryinfo'] = $this->db->select('name, parent_id')->where('category_id', $data["course_info"]->subcategory_id)->get('category_tbl')->row();
            $data['parent_id'] = $data['get_subcategoryinfo']->parent_id;
            $data['get_categoryinfo'] = $this->db->select('name, category_id')->where('category_id', $data["parent_id"])->get('category_tbl')->row();
            $data['categoryname'] = $data["get_categoryinfo"]->name;
        }
        // d($data['categoryname']);
        // $data['faculty_id']     = $this->session->userdata('user_id');
        $data['category_list']  = $this->Instructor_model->category_list($enterprise_id);
        // $data['sub_categories'] = $this->Instructor_model->get_subcategory($coursedata->category_id);
        $data['course_miniimg'] = $this->Instructor_model->course_image($course_id);
        $data['chapter_list']   = $this->Instructor_model->course_chapter_list($course_id);
        $data['offer_courses']  = $this->Instructor_model->offer_course_list($course_id);
        // dd($coursedata);
        $this->load->view('dashboard/course/course_preview', $data);
    }
    public function course_inactivepreview()    {
        $enterprise_id          = get_enterpriseid();
        $course_id          = $this->input->post('course_id');
        $data['course_info']           = $this->Instructor_model->course_info($course_id);

        $this->load->view('dashboard/course/course_inactivepreview', $data);
    }

    public function course_feedbacksubmit(){
        $course_id = $this->input->post('course_id');
        $feedback = $this->input->post('feedback');
        $feedbackdata = array(
            'feedback' => $feedback,
            'status' => 4,
        );
        $this->db->where('course_id', $course_id)->update('course_tbl', $feedbackdata);
        echo 'This course is rejected!';
        $instructor_info=  $this->db->select('course_id,faculty_id')->from('course_tbl')->where('course_id',$course_id)->get()->row(); 
        $instructor_id=$instructor_info->faculty_id;
         $instructor_course_site= $this->db->select("a.*,b.user_id,b.courses_site,b.courses_email,b.courses_sms")
         ->from('loginfo_tbl a')
          ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
         ->where('a.enterprise_id',get_enterpriseid())
         ->where('a.status',1)
         ->where('b.user_id',$instructor_id)
         ->where('b.type',2)
         ->get()->result();
         $app_setting = get_appsettings();
         $fromemail=$app_setting->email;
         $course_url=base_url(enterpriseinfo()->shortname."/course-details/".$course_id);
         $course_details=$this->db->select("*")->from("course_tbl")->where('course_id',$course_id)->get()->row();
         $sms_gateway_info = $this->setting_model->sms_gateway(1);
         foreach($instructor_course_site as $siteinfo){
          if($siteinfo->courses_site==1){
              $data_nofi=array(
                  'notification_id'=>$course_id,
                  'student_id'=>$siteinfo->user_id,
                  'notification_type'=>1,
                  'type'=>2,
                  'created_date'=>date('Y-m-d H:i:s'),
                  'isNotify'=>1,
                  'enterprise_id'=>get_enterpriseid(),
              );
              $this->db->insert('notifications_tbl', $data_nofi);
             }
             if($siteinfo->courses_email==1){
                 $to_email = $siteinfo->email;
                 $to_mail_delivered = explode(',', $to_email);
                 $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
                 $demo_email =$this->db->select("email")->from('setting')->where('enterprise_id',$siteinfo->enterprise_id)->get()->row();
                 $description = word_limiter($course_details->description, 10);
                 $description = strip_tags(html_entity_decode($description));
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
                     $htmlContent="<h2> Your course has been cancelled</h2> <b>$course_details->name</b></br><p>Feedback:$feedback</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                     $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,enterpriseinfo()->shortname);
                     $this->email->to($to_mail_delivered);
                     $this->email->subject(enterpriseinfo()->shortname);
                     $this->email->message($htmlContent);
                     $this->email->send(); 
             }
             if($course_status->courses_sms==1){
                  $to_mobile = $course_status->mobile;
                  $alphasmsdata = array(
                      'mobile' => $to_mobile,
                      'message' => " প্রিয় গ্রাহক, আপনার কোর্সটি বাতিল করা হয়েছে -> $course_details->name . $description আরো জানতে এখানে ক্লিক করুন:  $course_url ধন্যবাদ। ",
                  );
                  $this->send_elitbuzzsms($alphasmsdata);
              }
         }

        
    }




}