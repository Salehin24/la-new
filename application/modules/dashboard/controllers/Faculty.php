<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Faculty extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->load->model('Faculty_model');
        $this->load->model('Setting_model');
        $this->user_id = $this->session->userdata('log_id');
        $this->user_type = $this->session->userdata('user_type');

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');

        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }

    public function index() {
        $data['title'] = display('instructor');
        $data['module'] = "dashboard";
        $data['page'] = "faculty/add_faculty";
        echo modules::run('template/layout', $data);
    }
    public function get_facultylist()
    {
        $postData = $_POST;
        $search = (object) array();
        // Get data
        $data = $this->getfacultyslist($postData, $search);
        echo json_encode($data);
    }

    public function total_facultycount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*, b.picture, c.status as logstatus');
        $this->db->from('faculty_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getfacultyslist($postData = null, $searchs = null)
    {
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
                    or a.mobile like '%" . $searchValue . "%'
                    or a.email like '%" . $searchValue . "%')
                    ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_facultycount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*, b.picture, c.status As logstatus');
        $this->db->from('faculty_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        // $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        $action = $editbtn = $deletebtn = $statusbtn = $image = $facultynamebtn = '';

        foreach ($records as $record) {
            $i = 1;

            $facultynamebtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/instructor-profile-show/" . $record->faculty_id) . '" data-toggle="tooltip" title="' . display('show') . '" target="_new">'.$record->name.'</a> ';

            if ($record->logstatus == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="facultyinactive(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-info"></i></a>';
            } elseif ($record->logstatus == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="facultyactive(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }
            $get_facultyCourse = $this->Faculty_model->get_facultyCourse($record->faculty_id);
            
                $facultycourseshow = '';
                foreach ($get_facultyCourse as $course) {
                 $facultycourseshow .='<li>'. html_escape($course->name).'</li>';
             }
            if ($this->permission->check_label('faculty_list')->update()->access()) {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/faculty-edit/" . $record->faculty_id) . '" data-toggle="tooltip" title="' . display('edit') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            }
            if ($this->permission->check_label('faculty_list')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="faculty_delete(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            }
           $image = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->name) . '" width="40%" class="avatar-img rounded-circle"></div>';
          
            $action = $statusbtn.' '.$editbtn . ' ' . $deletebtn;

            $data[] = array(
                "sl" => $sl++,
                "name" => $facultynamebtn, //!empty($record->name) ? $record->name : " ",
                "email" => $record->email,
                "mobile" => $record->mobile,
                "courses" => $facultycourseshow,
                "image" =>  $image,
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

    // public function faculty_capacity_check(){
    //     $facultycount_byenterprise = facultycount_byenterprise();
    //     if ($facultycount_byenterprise >= enterpriseinfo()->faculty_capacity) {
    //         echo 'Faculty limit is over'; 
    //         exit();
    //     }
    // }

//    ========== its for faculty save ===========
    public function faculty_save() {
        $faculty_id = "F" . date('d') . $this->generators->generator(6);
        $name = $this->input->post('name', true);
        $mobile = $this->input->post('mobile', true);
        $email = $this->input->post('email', true);
        $address = $this->input->post('address', true);

        $dateofbirth = $this->input->post('dateofbirth', true);
        $picture = $this->input->post('picture', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $paypal = $this->input->post('paypal', true);

       
        // $facultycount_byenterprise = facultycount_byenterprise();
        // if ($facultycount_byenterprise >= enterpriseinfo()->faculty_capacity) {
        //     $this->session->set_flashdata('error', "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Instructor limit is over!</div>");
        //     redirect(enterpriseinfo()->shortname .'/add-faculty');
        // }
        
        //picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/faculty/', 'picture', 'gif|jpg|png|jpeg'
        );

        $loginfo_data = array(
            'log_id' => $faculty_id,
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'username' => $username,
            'password' => md5($password),
            'user_types' => 5,
            'is_admin' => 5,
            'last_login' => '',
            'last_logout' => '',
            'ip_address' => '',
            'status' => 1,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_at' => $this->createdtime,
        );
        $this->db->insert('loginfo_tbl', $loginfo_data);
//        ============= its for faculty info ======== 
        $faculty_data = array(
            'faculty_id' => $faculty_id,
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'birthday' => $dateofbirth,
            'address' => $address,
            'paypal' => '',
            'status' => 1,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        $this->db->insert('faculty_tbl', $faculty_data);
        activitiylog_save("$name Faculty Insert By", "Insert", $this->user_id, $this->createdtime);
        if ($image) {
            $picture_data = array(
                'from_id' => $faculty_id,
                'picture' => $image,
                'picture_type' => 'faculty',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }
        //        ============ its for user access role assign ========
        $user_access_info = array(
            'fk_user_id' => $faculty_id,
            'fk_role_id' => 1,
        );
        $this->db->insert('sec_user_access_tbl', $user_access_info);

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Instructor added successfully!</div>");
        redirect(enterpriseinfo()->shortname .'/add-faculty');
    }

    //    ============= its for  faculty count ===============
    public function faculty_count() {
        $count_query = $this->db->count_all_results('faculty_tbl');
        return $count_query;
    }

    public function faculty_list() {
        $data['title'] = display('instructor_list');
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['total_faculty'] = $this->total_facultycount();
        $data['module'] = "dashboard";
        $data['page'] = "faculty/faculty_list";
        echo modules::run('template/layout', $data);
    }

//    ============= its for faculty_filter ===========
    public function faculty_filter() {
        $faculty_id = $this->input->post('faculty_id', true);
        $email = $this->input->post('email', true);
        $data["faculty_list"] = $this->Faculty_model->faculty_filter($faculty_id, $email);

        $this->load->view('faculty/faculty_filter', $data);
    }

    public function faculty_edit($faculty_id) {
        $data['title'] = display('instructor');
        $data['edit_data'] = $this->Faculty_model->edit_data($faculty_id);
        $data['module'] = "dashboard";
        $data['page'] = "faculty/faculty_edit";
        echo modules::run('template/layout', $data);
    }

//    ============ its for experience_delete =========
    public function experience_delete() {
        $experience_id = $this->input->post('experience_id', true);
        $this->db->where('experience_id', $experience_id)->delete('work_experience_tbl');
        echo display('deleted_successfully');
    }

//    ============ its for education_delete =========
    public function education_delete() {
        $education_id = $this->input->post('education_id', true);
        $this->db->where('education_id', $education_id)->delete('education_tbl');
        echo display('deleted_successfully');
    }

//    ============ its for faculty_update ==========
    public function faculty_update() {
        $faculty_id = $this->input->post('faculty_id', true);
        $name = $this->input->post('name', true);
        $mobile = $this->input->post('mobile', true);
        $email = $this->input->post('email', true);
        $dateofbirth = $this->input->post('dateofbirth', true);
        $address = $this->input->post('address', true);
        $picture = $this->input->post('picture', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $oldpass = $this->input->post('oldpass', true);
        $paypal = $this->input->post('paypal', true);
        //picture upload
        $image = $this->fileupload->update_doupload(
                $faculty_id, 'assets/uploads/faculty/', 'picture', 'gif|jpg|png|jpeg'
        );

        $loginfo_data = array(
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'username' => $username,
            'enterprise_id' => get_enterpriseid(),
            'password' => (!empty($this->input->post('password', true)) ? md5($password) : $oldpass),
            'updated_by' => $this->user_id,
            'updated_at' => $this->createdtime,
        );
        $this->db->where('log_id', $faculty_id)->update('loginfo_tbl', $loginfo_data);
//        ============= its for faculty info ======== 
        $faculty_data = array(
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'birthday' => $dateofbirth,
            'address' => $address,
            'paypal' => '',
            'status' => 1,
            'enterprise_id' => get_enterpriseid(),
            'updated_by' => $this->user_id,
            'updated_date' => $this->createdtime,
        );
        $this->db->where('faculty_id', $faculty_id)->update('faculty_tbl', $faculty_data);
        activitiylog_save("$name Faculty Updated By", "Update", $this->user_id, $this->createdtime);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $faculty_id)->get()->row();
        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'faculty',
                    'status' => 1,
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $faculty_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $faculty_id,
                    'picture' => $image,
                    'picture_type' => 'faculty',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }

        if ($this->user_type == 1) {
            $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Instructor updated successfully!</div>");
            redirect(enterpriseinfo()->shortname.'/faculty-list');
        } else {
            // redirect(enterpriseinfo()->shortname.'/dashboard');
            redirect(enterpriseinfo()->shortname . '/faculty-list');
        }
    }

    //    ============ its for course_inactive =============
    public function faculty_inactive() {
        $faculty_id = $this->input->post('faculty_id', true);
        $data = array(
            'status' => 0,
        );
        $this->db->where('faculty_id', $faculty_id);
        $this->db->update('faculty_tbl', $data);
        activitiylog_save("Faculty Inactive By", "Inactive", $this->user_id, $this->createdtime);

        $logdata = array(
            'status' => 0,
        );
        $this->db->where('log_id', $faculty_id);
        $this->db->update('loginfo_tbl', $logdata);
      
        echo display('inactive_successfully');
    }

//    ================== its for course_active ============
    public function faculty_active() {
        $get_mail_config = $this->Setting_model->mailconfig();
        $faculty_id = $this->input->post('faculty_id', true);

        $data = array(
            'status' => 1,
        );
        $this->db->where('faculty_id', $faculty_id);
        $this->db->update('faculty_tbl', $data);
        activitiylog_save("Faculty Active By", "Active", $this->user_id, $this->createdtime);
        $logdata = array(
            'status' => 1,
        );
        $this->db->where('log_id', $faculty_id);
        $this->db->update('loginfo_tbl', $logdata);
        
        $this->faculty_activemail($get_mail_config, $faculty_id);
        

        echo display('active_successfully');
    }

    public function faculty_activemail($get_mail_config, $faculty_id) {
       
        $config = Array(
            'protocol' => $get_mail_config->protocol, //'smtp',
            'smtp_host' => $get_mail_config->smtp_host, //'ssl://smtp.gmail.com',
            'smtp_port' => $get_mail_config->smtp_port, //465,
            'smtp_user' => $get_mail_config->smtp_user, //'', // change it to yours
            'smtp_pass' => $get_mail_config->smtp_pass, // '', // change it to yours
            'mailtype' => $get_mail_config->mailtype, //'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_crypto'=>'tls',
        );
        // dd($config);
        $data['author_info'] = get_userinfo($faculty_id); //$this->Faculty_model->faculty_info($faculty_id);
        $name = $data['author_info']->name;
        $email = $data['author_info']->email;
        
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user'], "Instructor Approved");
        $this->email->to($email);
        $this->email->subject("Instructor Approved");
        $this->email->message("Welcome <strong>$name</strong> ,<br>You are now registered Instructor of Lead Academy." . "<br><br>"
                . "<br>" . "Thanks for Being with us."
                . "<br> Regards"
                . "<br> Team Lead Academy");
        $send_data = $this->email->send();
    }

//    =========== its for faculty delete ====
    public function faculty_delete() {
        $faculty_id = $this->input->post('faculty_id', true);
        $get_facultyCourse = $this->Faculty_model->get_facultyCourse($faculty_id);
        if ($get_facultyCourse) {
            echo "This ID has several active courses. If you want to delete this ID you have to delete all the courses first.";
        } else {
            $this->db->where('faculty_id', $faculty_id)->delete('faculty_tbl');
            $this->db->where('log_id', $faculty_id)->delete('loginfo_tbl');
            activitiylog_save("faculty  Deleted By", "Delete", $this->user_id, $this->createdtime);
            echo display('deleted_successfully');
        }
    }

        //    ======= its for show instructor =============
        public function show_instructor() {
            $data['title'] = display('show_instructor');
            $faculty_id = $this->input->post('faculty_id', TRUE);
            $data['show_instructorinfo'] = $this->Faculty_model->edit_data($faculty_id);
            
            $this->load->view('faculty/show_instructor', $data);
        }


    public function instructor_report(){
        $data['title'] = 'Instructor Report';
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['total_faculty'] = $this->total_reportcount();
        $data['module'] = "dashboard";
        $data['page'] = "faculty/instructor_report";
        echo modules::run('template/layout', $data);
    }



    public function instructor_report_list()
    {
        $postData = $_POST;
        $search = (object) array();
        // Get data
        $data = $this->getinstructorslist($postData, $search);
        echo json_encode($data);
    }

    public function total_reportcount($search = null, $searchQuery = null)
    {

        // $this->db->select('a.*,sum(b.credit) as total_earnings,sum(b.duration) as total_duration');
        $this->db->select('a.*, (SELECT sum(credit) FROM instructor_ledger_tbl WHERE user_id = a.faculty_id AND is_subscription = 1 AND status = 1) as total_earnings, 
                            (SELECT sum(duration) FROM instructor_ledger_tbl WHERE user_id = a.faculty_id AND is_subscription = 1 AND status = 1) as total_duration
                        ');
        $this->db->from('faculty_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        // $this->db->join('instructor_ledger_tbl b', 'b.user_id = a.faculty_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        // $this->db->where('b.is_subscription',1);
        // $this->db->group_by('b.user_id');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getinstructorslist($postData = null, $searchs = null)
    {
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
        $totalRecords = $this->total_reportcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        // $this->db->select('a.*,sum(b.credit) as total_earnings,sum(b.duration) as total_duration');
        $this->db->select('a.*, (SELECT sum(credit) FROM instructor_ledger_tbl WHERE user_id = a.faculty_id AND is_subscription = 1 AND status = 1) as total_earnings, 
        (SELECT sum(duration) FROM instructor_ledger_tbl WHERE user_id = a.faculty_id AND is_subscription = 1 AND status = 1) as total_duration
            ');
        $this->db->from('faculty_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        // $this->db->join('instructor_ledger_tbl b', 'b.user_id = a.faculty_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        // $this->db->group_by('b.user_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        $action = $editbtn = $deletebtn = $statusbtn = $image = $facultynamebtn = '';

        foreach ($records as $record) {
            $i = 1;

            $facultynamebtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/instructor-profile-show/" . $record->faculty_id) . '" data-toggle="tooltip" title="' . display('show') . '" target="_new">'.$record->name.'</a> ';

            // if ($record->logstatus == 1) {
            //     $statusbtn = '<a href="javascript:void(0)" onclick="facultyinactive(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-info"></i></a>';
            // } elseif ($record->logstatus == 0) {
            //     $statusbtn = '<a href="javascript:void(0)" onclick="facultyactive(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            // }
            // $get_facultyCourse = $this->Faculty_model->get_facultyCourse($record->faculty_id);
            
            //     $facultycourseshow = '';
            //     foreach ($get_facultyCourse as $course) {
            //      $facultycourseshow .='<li>'. html_escape($course->name).'</li>';
            //  }
            // if ($this->permission->check_label('faculty_list')->update()->access()) {
            //     $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/faculty-edit/" . $record->faculty_id) . '" data-toggle="tooltip" title="' . display('edit') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            // }
            // if ($this->permission->check_label('faculty_list')->delete()->access()) {
            //     $deletebtn = '<a href="javascript:void(0)" onclick="faculty_delete(' . "'" . $record->faculty_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
        //    $image = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->name) . '" width="40%" class="avatar-img rounded-circle"></div>';
          
            $action = $statusbtn.' '.$editbtn . ' ' . $deletebtn;

            $data[] = array(
                "sl" => $sl++,
                "name" => $facultynamebtn, 
                "email" => $record->email,
                "duration" => (!empty($record->total_duration) ? (number_format(($record->total_duration/60), 3)). ' Min' : ''),
                "amount" =>number_format($record->total_earnings,3),
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

    


}