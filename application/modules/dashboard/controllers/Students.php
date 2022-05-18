<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Students extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model('Student_model');
                
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }

    public function index() {
        $data['title'] = display('students');

        $data['module'] = "dashboard";
        $data['page'] = "students/add_student";
        echo modules::run('template/layout', $data);
    }

   public function get_studentlist(){
        $postData = $_POST;
        $search = (object) array(
            'student_id' => $this->input->post('student_id'),
            'mobile' => $this->input->post('mobile'),
        );
        // Get data
        $data = $this->getstudentslist($postData, $search);
        echo json_encode($data);
   }

    public function total_studentcount($search = null, $searchQuery = null)
    {   
        $this->db->select('a.*,a.status as logstatus, b.picture');
        $this->db->from('students_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('picture_tbl b', 'b.from_id = a.student_id', 'left');
        $student_id=@$search->student_id;
        $mobile= @$search->mobile;
        if ($student_id && $mobile) {
            $this->db->where('a.student_id',$student_id);
            $this->db->where('a.mobile',$mobile);
        } elseif($student_id) {
            $this->db->where('a.student_id',$student_id);
        } elseif ($mobile) {
            $this->db->where('a.mobile', $mobile);
        } 

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getstudentslist($postData = null, $searchs = null)
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
        $totalRecords = $this->total_studentcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;
          


   
        $this->db->select('a.*,a.status as logstatus, b.picture');
        $this->db->from('students_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('picture_tbl b', 'b.from_id = a.student_id', 'left');
        //this is custom filtering condition 
        if ($searchs->student_id && $searchs->mobile) {
            $this->db->where('a.student_id', $searchs->student_id);
            $this->db->where('a.mobile', $searchs->mobile);
        } elseif ($searchs->student_id) {
            $this->db->where('a.student_id', $searchs->student_id);
        } elseif ($searchs->mobile) {
            $this->db->where('a.mobile', $searchs->mobile);
        }
        
        $this->db->where('a.enterprise_id', get_enterpriseid());
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        // $this->db->order_by('a.id', 'desc');

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        // $this->db->last_query(); 

        $data = array();
        $showcoursebtn = $statusbtn = $editbtn = $deletebtn = $studentnamebtn = '';
        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;

            $showcoursebtn = '<a href="javascript:void(0)" onclick="studentshowcourse(' . "'" . $record->student_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" ><i class="fas fa-eye btn-primary  btn btn-sm"></i></a>';
            $studentnamebtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/student-profile-show/" . $record->student_id) . '" data-toggle="tooltip" title="' . display('show') . '" target="_new">'.$record->name.'</a> ';

            if ($record->logstatus == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="studentinactive(' . "'" . $record->student_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
            } elseif ($record->logstatus == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="studentactive(' . "'" . $record->student_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }

            if ($this->permission->check_label('student_list')->update()->access()) {
                // $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/student-edit/" . $record->student_id) . '" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            }
            if ($this->permission->check_label('student_list')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="student_delete(' . "'" . $record->student_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            }
            $image= '<div class="avatar avatar-xs"><img src="'. base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png'). '" alt="'.html_escape($record->name). '" class="avatar-img rounded-circle"></div>';

            
            
            $action = $showcoursebtn . ' '. $statusbtn . ' '. $editbtn . ' ' . $deletebtn;
        
            $data[] = array(
                "sl" => $sl++,
                "name" => $studentnamebtn, //!empty($record->name) ? $record->name : " ",
                "mobile" => !empty($record->mobile) ? $record->mobile : " ",
                "email" => $record->email,
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

//    ========== its for student save ===========
    public function student_save() {
        $student_id = "ST" . date('d') . $this->generators->generator(6);
        $name = $this->input->post('name', true);
        $mobile = $this->input->post('mobile', true);
        $address = $this->input->post('address', true);
        $biography = $this->input->post('biography', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $facebook = $this->input->post('facebook', true);
        $twitter = $this->input->post('twitter', true);
        $linkedin = $this->input->post('linkedin', true);
        $instagram = $this->input->post('instagram', true);
        $paypal = $this->input->post('paypal', true);
        $bitcoin = '';
        $simbcoin = '';

        //picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/students/', 'picture'
        );
        if ($this->user_type == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $loginfo_data = array(
            'log_id' => $student_id,
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'username' => $email,
            'password' => md5($password),
            'user_types' => 4,
            'is_admin' => 4,
            'last_login' => '',
            'last_logout' => '',
            'ip_address' => '',
            'status' => $status,
            'created_by' => $this->user_id,
            'created_at' => $this->createdtime,
        );

        $this->db->insert('loginfo_tbl', $loginfo_data);
        
        $student_data = array(
            'student_id' => $student_id,
            'name' => $name,
            'mobile' => $mobile,
            'address' => $address,
            'email' => $email,
            'biography' => $biography,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'paypal' => $paypal,
            'bitcoin' => $bitcoin,
            'simbcoin' => $simbcoin,
            'status ' => $status,
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        $this->db->insert('students_tbl', $student_data);

        if ($image) {
            $picture_data = array(
                'from_id' => $student_id,
                'picture' => $image,
                'picture_type' => 'students',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }
       
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Student added successfully!</div>");
        redirect(enterpriseinfo()->shortname .'/add-student');
    }

//    ============= its for  students count ===============
    public function students_count() {
        $this->db->where('status', 1);
        $count_query = $this->db->count_all_results('students_tbl');
        return $count_query;
    }

    public function student_list() {
        $data['title'] = display('student_list');
        $data['total_student'] = $this->total_studentcount();
        $data['get_studentlist'] = $this->Student_model->get_studentlist();
        $data['module'] = "dashboard";
        $data['page'] = "students/student_list";
        echo modules::run('template/layout', $data);
    }

//    ============ its for students_filter ============
    public function students_filter() {
        $student_id = $this->input->post('student_id', true);
        $mobile = $this->input->post('mobile', true);
        $data['student_list'] = $this->Student_model->students_filter($student_id, $mobile);

        $this->load->view('students/student_filter', $data);
    }

    public function student_edit($student_id) {
        $data['title'] = display('student_edit');
        $data['edit_data'] = $this->Student_model->edit_data($student_id);

        $data['module'] = "dashboard";
        $data['page'] = "students/student_edit";
        echo modules::run('template/layout', $data);
    }

//=========== its for student update ============
    public function student_update() {
        $student_id = $this->input->post('student_id', true);
        $name = $this->input->post('name', true);
        $mobile = $this->input->post('mobile', true);
        $address = $this->input->post('address', true);
        $biography = $this->input->post('biography', true);
        $email = $this->input->post('email', true);
        $oldpass = $this->input->post('oldpass', true);
        $password = $this->input->post('password', true);
        $facebook = $this->input->post('facebook', true);
        $twitter = $this->input->post('twitter', true);
        $linkedin = $this->input->post('linkedin', true);
        $instagram = $this->input->post('instagram', true);
        $paypal = $this->input->post('paypal', true);
        $bitcoin = '';
        $simbcoin = '';

        //picture upload
        $image = $this->fileupload->update_doupload(
                $student_id, 'assets/uploads/students/', 'picture'
        );

        $loginfo_data = array(
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'username' => $email,
            'password' => (!empty($this->input->post('password', true)) ? md5($password) : $oldpass),
            'updated_by' => $this->user_id,
            'updated_at' => $this->createdtime,
        );
        $this->db->where('log_id', $student_id)->update('loginfo_tbl', $loginfo_data);

        $student_data = array(
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'address' => $address,
            'biography' => $biography,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'paypal' => $paypal,
            'bitcoin' => $bitcoin,
            'simbcoin' => $simbcoin,
            'status ' => 1,
            'updated_by' => $this->user_id,
            'updated_date' => $this->createdtime,
        );
        $this->db->where('student_id', $student_id)->update('students_tbl', $student_data);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $student_id)->get()->row();
        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'students',
                    'status' => 1,
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $student_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $student_id,
                    'picture' => $image,
                    'picture_type' => 'students',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }
        if ($this->user_type == 1) {
            $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Student updated successfully!</div>");
            redirect(enterpriseinfo()->shortname .'/student-list');
        } else {
            redirect(enterpriseinfo()->shortname .'/dashboard');
        }
    }

    //    ============ its for student inactive =============
    public function student_inactive() {
        $student_id = $this->input->post('student_id', true);
        $data = array(
            'status' => 0,
        );
        $this->db->where('student_id', $student_id);
        $this->db->update('students_tbl', $data);
//        activitiylog_save("Student Inactive By", "Inactive", $this->user_id, $this->createdtime);

        $logdata = array(
            'status' => 0,
        );
        $this->db->where('log_id', $student_id);
        $this->db->update('loginfo_tbl', $logdata);
        activitiylog_save("Student Log Inactive By", "Inactive", $this->user_id, $this->createdtime);
        echo display('inactive_successfully');
    }

//    ================== its for student active ============
    public function student_active() {
        $student_id = $this->input->post('student_id', true);
        $data = array(
            'status' => 1,
        );
        $this->db->where('student_id', $student_id);
        $this->db->update('students_tbl', $data);
//        activitiylog_save("Student  Active By", "Active", $this->user_id, $this->createdtime);
        $logdata = array(
            'status' => 1,
        );
        $this->db->where('log_id', $student_id);
        $this->db->update('loginfo_tbl', $logdata);
        activitiylog_save("Student Log Active By", "Active", $this->user_id, $this->createdtime);
        echo display('active_successfully');
    }

//    =========== its for student delete method =========
    public function student_delete() {
        $student_id = $this->input->post("studnet_id", true);
        $check_studentcourses = $this->db->select('*')->from('invoice_details')->where('customer_id', $student_id)->get()->row();
        if ($check_studentcourses) {
            $this->db->where('customer_id', $student_id)->delete('invoice_details');
        }
        $this->db->where('student_id', $student_id)->delete('students_tbl');
        $this->db->where('log_id', $student_id)->delete('loginfo_tbl');
        echo display('deleted_successfully');
    }

    // ============= its for assign_certificate ===========
    public function assign_certificate(){
            $data['title'] = display('assign_certificate');
            $data['get_studentlist'] = get_studentlist();
            $data['get_certificatelist'] = get_certificatelist('certificate');
    
            $data['module'] = "dashboard";
            $data['page'] = "students/assign_certificate";
            echo modules::run('template/layout', $data);
    }

    // =============== its for assign certificate save ==============
    public function assign_certificate_save(){
        $mode = $this->input->post('mode', true);
        $id = $this->input->post('id', true);
        $student_id = $this->input->post('student_id', true);
        $certificate_id = $this->input->post('certificate_id', true);
        $students = explode(",",$student_id);

        if($mode == 'edit'){
            $assigneddata = array(
                'user_id' => $student_id,
                'certificate_id' => $certificate_id,
                // 'status' => 1, 
                'enterprise_id' => get_enterpriseid(),
                // 'updated_date' => $this->createdtime,
                // 'updated_by' => $this->user_id,
            );
            $this->db->where('id', $id)->update('certificate_mapping_tbl', $assigneddata); 
        }else{
            foreach($students as $student){
                $checkExistsdata = $this->db->where('user_id', $student)->where('certificate_id', $certificate_id)->get('certificate_mapping_tbl')->row();
                $assigneddata = array(
                    'user_id' => $student,
                    'certificate_id' => $certificate_id,
                    // 'status' => 1, 
                    'enterprise_id' => get_enterpriseid(),
                    'created_by' => $this->user_id,
                    'created_date' => $this->createdtime,
                );
               
                if(empty($checkExistsdata)){
                    $this->db->insert('certificate_mapping_tbl', $assigneddata);
                }
            }
        }
        
        echo display('assigned_successfully');
    }
    

    public function get_assignedcertificatelist(){
        $postData = $_POST;
        $search = (object) array(
            // 'student_id' => $this->input->post('student_id'),
            // 'mobile' => $this->input->post('mobile'),
        );
        // Get data
        $data = $this->getassignedcertificatelist($postData, $search);
        echo json_encode($data);
   }

    public function total_assignedcertificatecount($search = null, $searchQuery = null)
    {   
        $this->db->select('a.*, b.name student_name, c.title certificate_name');
        $this->db->from('certificate_mapping_tbl a');
        $this->db->join('students_tbl b', 'b.student_id = a.user_id', 'left');
        $this->db->join('template_tbl c', 'c.id = certificate_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
      

        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getassignedcertificatelist($postData = null, $searchs = null)
    {
        $response = array();
        ## Read value
        $draw = @$postData['draw'];
        $start = @$postData['start'];
        $rowperpage = @$postData['length']; // Rows display per page
        $columnIndex = @$postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
       $testColumn="$columnName";
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (b.name like '%" . $searchValue . "%')
                              or c.title like '%" . $searchValue . "%'
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_assignedcertificatecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;


   
        $this->db->select('a.*, b.name student_name, c.title certificate_name');
        $this->db->from('certificate_mapping_tbl a');
        $this->db->join('students_tbl b', 'b.student_id = a.user_id', 'left');
        $this->db->join('template_tbl c', 'c.id = a.certificate_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
               
        $this->db->where('a.enterprise_id', get_enterpriseid());
        // $this->db->order_by('a.id', 'desc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        // echo $this->db->last_query();
    
        $data = array();
        $editbtn = $deletebtn = $showbtn = '';
        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;

            // $showbtn = '<a href="javascript:void(0)" onclick="showassign_certificate(' . "'" . $record->id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" ><i class="fa fa-eye btn btn-info btn-sm"></i> </a> ';
            $showbtn = '<a href="'.base_url(enterpriseinfo()->shortname. '/showassign-certificate/'.$record->id).'" target="_new" data-toggle="tooltip" title="' . display('show') . '" ><i class="fa fa-eye btn btn-info btn-sm"></i> </a> ';
            // if ($this->permission->check_label('student_list')->update()->access()) {
                $editbtn = '<a href="javascript:void(0)" onclick="assigncertificateedit(' . "'" . $record->id . "'" . ')" data-toggle="tooltip" title="' . display('edit') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            // }
            // if ($this->permission->check_label('student_list')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="assigncertificatedelete(' . "'" . $record->id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
           
            
            
            $action = $showbtn . ' '. $editbtn . ' ' . $deletebtn;
        
            $data[] = array(
                "sl" => $sl++,
                "student_name" => !empty($record->student_name) ? $record->student_name : "",
                "certificate_name" => !empty($record->certificate_name) ? $record->certificate_name : " ",
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

    // public function showassign_certificate($id){
    public function showassign_certificate($id){
        $data['title'] = display('assign_certificate');
        // $id = $this->input->post('id', true);
        $data['get_assigncertificate'] = $this->Student_model->assigncertificate_edit($id);
        $get_userinfo = get_userinfo($data['get_assigncertificate']->user_id);
        $certificate_id = $data['get_assigncertificate']->certificate_id;
        $name = $get_userinfo->name;
        $templates_info = $this->db->select('*')->from('template_tbl')->where('id', $certificate_id)->get()->row();
        // d($get_userinfo);
        // dd($templates_info);

        $data['template'] = $this->smsgateway->certificatetemplate([
            'name' => $name,
            'certificate_name' => $templates_info->title,
            'summary' => '', //$templates_info->template_body,
            'logo' => $templates_info->logo,
            'signature' => $templates_info->signature,
            'date' => date('d F Y', strtotime($data['get_assigncertificate']->created_date)),
            'message' => $templates_info->template_body,
            'baseurl' => base_url(),
        ]);
    //    dd($data['template']);
        

        $data['module'] = "dashboard";
        $data['page'] = "students/showassign_certificate";
        echo modules::run('template/layout', $data);

        
        // $this->load->view('dashboard/students/showassign_certificate', $data);
    }
    public function assigncertificate_edit(){
        $data['id'] = $this->input->post('id', true);
        $data['assigncertificate_edit'] = $this->Student_model->assigncertificate_edit($data['id']);
        $data['get_studentlist'] = get_studentlist();
        $data['get_certificatelist'] = get_certificatelist('certificate');
        
        $this->load->view('dashboard/students/assigncertificate_editform', $data);
    }

    // ============== its for assigncertificate_delete ================
    public function assigncertificate_delete(){
        $id = $this->input->post('id', true);
       
        $this->db->where('id', $id)->delete('certificate_mapping_tbl');
        echo display('deleted_successfully');
    }
    
    public function student_showcourse(){
        $student_id = $this->input->post('student_id', true);
        $data['get_studentpurchasescourse'] = $this->Student_model->getstudentcourse($student_id, 0);
        $data['get_studentsubscriptioncourse'] = $this->Student_model->getstudentcourse($student_id, 1);
        
        $this->load->view('dashboard/students/student_showcourse', $data);
    }
}