<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zoomcontroler extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model('Zoom_model');
        $this->load->model('frontend/Frontend_model');
        $this->load->model('dashboard/Faculty_model');
        $this->load->model('dashboard/Setting_model');
        $this->load->model('dashboard/Category_model');
        $this->load->model('dashboard/Course_model');
        // if (!$this->session->userdata('session_id'))
        //     redirect();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function index() {
        if (!$this->session->userdata('session_id')) {
            redirect('login');
        }
        $data['title'] = display('meeting_list');
        $config["base_url"] = base_url(enterpriseinfo()->shortname.'/zoom-meeting/');
        $config["total_rows"] = $this->db->count_all('meeting_tbl');
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
        $data["meeting_list"] = $this->Zoom_model->meeting_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;
//        dd($data["meeting_list"]);

        $data['module'] = "zoom";
        $data['page'] = "index";
        echo modules::run('template/layout', $data);
    }

//    ============ its for meeting save ===========
    public function meeting_save() {
        $title = $this->input->post('title', TRUE);
        $meeting_id = $this->input->post('meeting_id');
        $meeting_password = $this->input->post('meeting_password');
        $meeting_date = $this->input->post('meeting_date');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $status = 1;

        $meeting_data = array(
            'title' => $title,
            'meeting_id' => $meeting_id,
            'meeting_password' => $meeting_password,
            'meeting_date' => $meeting_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $status,
            'created_by' => $this->user_id
        );
        $this->db->insert('meeting_tbl', $meeting_data);
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Meeting add successfully!</div>");

        redirect(enterpriseinfo()->shortname .'/zoom-meeting');
    }

    public function viewHost() {
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $data['enterprise_id'] = $this->input->post('enterprise_id');
        $data['meetingID'] = $this->input->post('meeting_id');

        echo $this->load->view('zoom/viewHost', $data, true);
    }

    public function host() {
        $data['title'] = '';
        $this->load->view('zoom/host', $data);
    }

//    ========= its for joining zoom meeting =============
    public function join_zoom_meeting() {
        if (!$this->session->userdata('session_id')) {
            redirect('login');
        }
        $facultyids = array();
        $get_ownproductids = $this->db->select('product_id')->from('invoice_details')->where('customer_id', get_userid())->get()->result();

        $data['title'] = display('join_zoom_meeting');
        $config["base_url"] = base_url('join-zoom-meeting/');
        $config["total_rows"] = $this->db->count_all('meeting_tbl');
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
        $data["meeting_list"] = $this->Zoom_model->meeting_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;
        $data['active_theme'] = $this->Frontend_model->active_theme();

        $data['module'] = "zoom";
        $data['page'] = "meeting_list";
        echo Modules::run("template/frontend_layout", $data);
    }

//    ==============its for join modal ==============
    public function joinModal() {
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname');
        $data['enterprise_id'] = $this->input->post('enterprise_id');

        $data['meetingID'] = $this->input->post('meeting_id');
        echo $this->load->view('zoom/live_meetingModal', $data, true);
    }

    public function loadlivejoin() {
        $data['title'] = '';
        $data['meetingID'] = $this->input->post('meeting_id', true);
        $data['liveID'] = $this->input->post('live_id', true);
        $data['enterprise_id'] = $this->input->post('enterprise_id', true);
        $data['enterprise_shortname'] = $this->input->post('enterprise_shortname', true);
        // dd($enterprise_shortname);
        // dd($meetingID);
        // if (empty($meetingID) || empty($liveID)) {
        //     $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>URL not valid!</div>");
        //     redirect('join-zoom-meeting');
        // }
        $this->load->view('zoom/loadlivejoin', $data);
    }
    public function livejoin() {
        $data['title'] = '';
        $meetingID = $this->input->get('meeting_id', true);
        $liveID = $this->input->get('live_id', true);
        $event_id = $this->input->get('event_id');
        $enterprise_id = $this->input->get('enterprise_id');
        $enterprise_shortname = $this->input->get('enterprise_shortname');
        // dd($liveID);
        $checkparticipant = $this->db->where('event_id', $event_id)->where('live_id', $liveID)->where('user_id', $this->user_id)->get('meeting_participant_tbl')->row();

        $participantdata = array(
            'event_id' => $event_id,
            'live_id' => $liveID,
            'user_id' => $this->user_id,
            'created_date' => date('Y-m-d H:i:s'),
        );
        if($checkparticipant){
            $this->db->where('event_id', $event_id)->where('user_id', $this->user_id)->update('meeting_participant_tbl', $participantdata);
        }else{
            $this->db->insert('meeting_participant_tbl', $participantdata);
        }

        // d($enterprise_id);
        // dd($enterprise_shortname);

        if (empty($meetingID) || empty($liveID)) {
            $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>URL not valid!</div>");
            redirect($enterprise_shortname .'/join-zoom-meeting');
        }
        $this->load->view('zoom/livejoin', $data);
    }

//    ======== its for zoom config =============
    public function zoom_config() {
        $data['title'] = display('zoom_configuration');
        $data['active_theme'] = $this->Frontend_model->active_theme();
        $data['get_zoomconfigdata'] = $this->Zoom_model->get_zoomconfigdata(get_enterpriseid());

        $data['module'] = "zoom";
        $data['page'] = "zoom_config";
        echo Modules::run("template/layout", $data);
    }

//    ========== its form zoom config save ============
    public function zoom_config_save() {
        $zoom_api_key = $this->input->post('zoom_api_key', TRUE);
        $zoom_api_secret = $this->input->post('zoom_api_secret', TRUE);
        $meetingid = $this->input->post('meetingid', TRUE);
        $meeting_password = $this->input->post('meeting_password', TRUE);

        $get_zoomconfigdata = $this->Zoom_model->get_zoomconfigdata(get_enterpriseid());

        $zoom_apidata = array(
            'zoom_api_key' => $zoom_api_key,
            'zoom_api_secret' => $zoom_api_secret,
            'meetingid' => $meetingid,
            'meeting_password' => $meeting_password,
            'enterprise_id' => get_enterpriseid(),
        );
        // dd($zoom_apidata);
        if (empty($get_zoomconfigdata)) {
            $this->db->insert('zoomconfig_tbl', $zoom_apidata);
        } else {
            $this->db->where('id', $get_zoomconfigdata->id)->update('zoomconfig_tbl', $zoom_apidata);
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Zoom configuration updated successfully!</div>");

        redirect(enterpriseinfo()->shortname .'/zoom-config');
    }

//    ========= its for meeting_edit ==============
    public function meeting_edit() {
        $data['title'] = '';
        $meetingid = $this->input->post('meetingid', TRUE);
        $data['get_meetinginfo'] = $this->Zoom_model->get_meetinginfo($meetingid);

        $this->load->view('zoom/meeting_edit', $data);
    }

//    ========= its for meeting update=============
    public function meeting_update() {
        $id = $this->input->post('id', TRUE);
        $title = $this->input->post('title', TRUE);
        $meeting_id = $this->input->post('meeting_id', TRUE);
        $meeting_password = $this->input->post('meeting_password', TRUE);
        $meeting_date = $this->input->post('meeting_date', TRUE);
        $start_time = $this->input->post('start_time', TRUE);
        $end_time = $this->input->post('end_time', TRUE);

        $meeting_updatedata = array(
            'title' => $title,
            'meeting_id' => $meeting_id,
            'meeting_password' => $meeting_password,
            'meeting_date' => $meeting_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
        );
        $this->db->where('id', $id)->update('meeting_tbl', $meeting_updatedata);

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Zoom meeting updated successfully!</div>");
        redirect(enterpriseinfo()->shortname .'zoom-meeting');
    }

//    =========== its for meeting delete ===========
    public function meeting_delete() {
        $id = $this->input->post('meetingid', TRUE);
        if ($id) {
            $this->db->where('id', $id)->delete('meeting_tbl');
        }
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Zoom meeting deleted successfully!</div>");
    }

//    ======== its for add live course form =============
    public function add_live_course() {
        $data['title'] = display('add_live_course');
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['get_category'] = $this->Category_model->get_category();

        $data['module'] = "zoom";
        $data['page'] = "add_live_course";
        echo Modules::run("template/layout", $data);
    }

//    ========== it's for live course save =============
    public function live_course_save() {
        $course_id = "LCO" . date('d') . $this->generators->generator(5);
        $courseid = $this->input->post('course_id', TRUE);
        $name = $this->input->post('name', true);
        $slug = str_replace(" ", "-", strtolower($name));
        $slug = rtrim($slug, "-");
        $faculty_id = $this->input->post('faculty_id', true);
        $category_id = $this->input->post('category_id', true);
        $course_level = $this->input->post('course_level', true);
        $description = $this->input->post('description', true);
        $language = $this->input->post('language', true);
        $is_popular = $this->input->post('is_popular', true);
        $is_popular = (($is_popular) ? "$is_popular" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }


        $requirements = $this->input->post('requirements', true);

        $benifits = $this->input->post('benifits', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : "0");
        $is_discount = '';
        $discount = '';

        $course_provider = ''; //$this->input->post('course_provider', true);
        $url = ''; //$this->input->post('url', true);
        $thumbnail = $this->input->post('thumbnail', true);

        $meeting_id = $this->input->post('meeting_id', TRUE);
        $meeting_password = $this->input->post('meeting_password', TRUE);
        $start_date = $this->input->post('start_date', True);
        $end_date = $this->input->post('end_date', TRUE);
        $start_time = $this->input->post('start_time', TRUE);
        $end_time = $this->input->post('end_time', TRUE);

        if ($start_date && $end_date) {
            $period = $this->getDatesFromRange($start_date, $end_date);
        }

        $meta_keyword = $name;
        $meta_description = $name;
//picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/course/', 'thumbnail'
        );

// if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image, 300, 300
            );
        }

        $course_data = array(
            'course_id' => $course_id,
            'name' => $name,
            'faculty_id' => $faculty_id,
            'summary' => '', //$summary,
            'description' => $description,
            'category_id' => $category_id,
            'course_level ' => $course_level,
            'language ' => '', //$language,
            'is_popular  ' => $is_popular,
            'requirements ' => json_encode($requirements),
            'benifits ' => json_encode($benifits),
            'is_free' => $is_free,
            'price' => $price,
            'oldprice' => $oldprice,
            'is_discount' => $is_discount,
            'discount' => $discount,
            'course_provider' => $course_provider,
            'url' => $url,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'status' => $status,
            'is_livecourse' => 1,
            'enterprise_id' => get_enterpriseid(),
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->user_id,
        );

        $this->db->insert('course_tbl', $course_data);


        if ($image) {
            $picture_data = array(
                'from_id' => $course_id,
                'picture' => $image,
                'picture_type' => 'course',
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->user_id,
            );

            $this->db->insert('picture_tbl', $picture_data);
        }

        foreach ($period as $key => $value) {
            $meeting_data = array(
                'course_id' => $course_id,
                'title' => $name,
                'meeting_id' => $meeting_id,
                'meeting_password' => $meeting_password,
                'meeting_date' => $value,
                'start_date' => $value, //$start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'status' => 0,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id
            );
            $this->db->insert('meeting_tbl', $meeting_data);
        }

        if ($this->user_type == 3) {
            $get_pendingcourse = $this->db->select('count(course_id) as total_pending')->from('course_tbl')->where('status', 0)->get()->row();
            $data['count'] = $get_pendingcourse->total_pending;
            $data['message'] = 'course-pending';
            $this->pusher->trigger('my-channel', 'my-event', $data);
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Course added successfully!</div>");
        redirect(enterpriseinfo()->shortname .'/add-live-course');
    }

    //    ============= its for my course count ===============
    public function livecourse_count($user_id, $user_type) {
        if ($user_type != 1) {
            $this->db->where('created_by', $user_id);
            $this->db->where('is_livecourse', 1);
        }
        $count_query = $this->db->count_all_results('course_tbl');
        return $count_query;
    }

//    ======== its for live course list =============
    public function live_course_list() {
        $data['title'] = display('live') . '  ' . display('course_list');
        $data['total_livecourse'] = $this->livecourse_count($this->user_id, $this->user_type);

        $data['module'] = "zoom";
        $data['page'] = "live_course_list";
        echo Modules::run("template/layout", $data);
    }

//    ============ its for live course data list ===========
    public function livecourse_datalist() {
        $postData = $_POST;
        $search = (object) array(
                    'name' => $this->input->post('name'),
        );
// Get data
        $data = $this->getlivecoursedataList($postData, $search);
        echo json_encode($data);
    }

    public function total_livecoursecount($search = null, $searchQuery = null) {
        $this->db->select('a.*, b.name category_name, c.name faculty_name');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('faculty_tbl c', 'c.faculty_id = a.faculty_id', 'left');
        $this->db->where('a.is_livecourse', 1);


        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getlivecoursedataList($postData = null, $searchs = null) {
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
                    or c.name like '%" . $searchValue . "%'
                    ";
        }
## Total number of records without filtering
        $totalRecords = $this->total_livecoursecount($searchs, $searchQuery);
## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*, b.name category_name, c.name faculty_name');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->join('category_tbl b', 'b.category_id = a.category_id', 'left');
        $this->db->join('faculty_tbl c', 'c.faculty_id = a.faculty_id', 'left');
        $this->db->where('a.is_livecourse', 1);

        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $course_totalsales = $this->Course_model->course_totalsales($record->course_id);


            $editbtn = $deletebtn = $action = '';
            if ($this->permission->check_label('course_list')->update()->access()) {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/live-course-edit/" . $record->course_id) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            }
            if ($this->permission->check_label('course_list')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="livecourse_delete(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash btn btn-danger btn-sm"></i></a>';
            }
            $action = $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "course_name" => $record->name,
                "category_name" => $record->category_name,
                "price" => $record->price,
                "totalsales" => $course_totalsales->totalsales,
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

//    ========= its for live course edit  ===========
    public function live_course_edit($course_id) {
        $data['title'] = display('live_course_update');
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        $data['get_category'] = $this->Category_model->get_category();
        $data['get_livecourseeditdata'] = $this->Zoom_model->get_livecourseeditdata($course_id);
        $data['get_meetinginfo'] = $this->Zoom_model->getmeetinginfo($course_id);

        $data['module'] = "zoom";
        $data['page'] = "live_course_edit";
        echo Modules::run("template/layout", $data);
    }

//    ========== it's for live course save =============
    public function live_course_update() {
        $course_id = $this->input->post('course_id', TRUE);
        $name = $this->input->post('name', true);
        $slug = str_replace(" ", "-", strtolower($name));
        $slug = rtrim($slug, "-");
        $faculty_id = $this->input->post('faculty_id', true);
        $category_id = $this->input->post('category_id', true);
        $course_level = $this->input->post('course_level', true);
        $description = $this->input->post('description', true);
        $language = $this->input->post('language', true);
        $is_popular = $this->input->post('is_popular', true);
        $is_popular = (($is_popular) ? "$is_popular" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }


        $requirements = $this->input->post('requirements', true);

        $benifits = $this->input->post('benifits', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : "0");
        $is_discount = '';
        $discount = '';

        $course_provider = ''; //$this->input->post('course_provider', true);
        $url = ''; //$this->input->post('url', true);
        $thumbnail = $this->input->post('thumbnail', true);

        $meeting_id = $this->input->post('meeting_id', TRUE);
        $meeting_password = $this->input->post('meeting_password', TRUE);
        $start_date = $this->input->post('start_date', True);
        $end_date = $this->input->post('end_date', TRUE);
        $start_time = $this->input->post('start_time', TRUE);
        $end_time = $this->input->post('end_time', TRUE);

        if ($start_date && $end_date) {
            $period = $this->getDatesFromRange($start_date, $end_date);
        }

        $meta_keyword = $name;
        $meta_description = $name;
//picture upload
        $image = $this->fileupload->update_doupload(
                $course_id, 'assets/uploads/course/', 'thumbnail'
        );

// if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image, 300, 300
            );
        }

        $course_data = array(
            'name' => $name,
            'faculty_id' => $faculty_id,
            'summary' => '', //$summary,
            'description' => $description,
            'category_id' => $category_id,
            'course_level ' => $course_level,
            'language ' => '', //$language,
            'is_popular  ' => $is_popular,
            'requirements ' => json_encode($requirements),
            'benifits ' => json_encode($benifits),
            'is_free' => $is_free,
            'price' => $price,
            'oldprice' => $oldprice,
            'is_discount' => $is_discount,
            'discount' => $discount,
            'course_provider' => $course_provider,
            'url' => $url,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'status' => $status,
            'is_livecourse' => 1,
            'enterprise_id' => get_enterpriseid(),
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->user_id,
        );

        $this->db->where('course_id', $course_id)->update('course_tbl', $course_data);


        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $course_id)->get()->row();

        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'course',
                    'status' => 1,
                    'updated_date' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $course_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $course_id,
                    'picture' => $image,
                    'picture_type' => 'course',
                    'status' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }

        $this->db->where('course_id', $course_id)->delete('meeting_tbl');
        foreach ($period as $key => $value) {
            $meeting_data = array(
                'course_id' => $course_id,
                'title' => $name,
                'meeting_id' => $meeting_id,
                'meeting_password' => $meeting_password,
                'meeting_date' => $value,
                'start_date' => $value, //$start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'status' => 0,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id
            );
            $this->db->insert('meeting_tbl', $meeting_data);
        }

        if ($this->user_type == 3) {
            $get_pendingcourse = $this->db->select('count(course_id) as total_pending')->from('course_tbl')->where('status', 0)->get()->row();
            $data['count'] = $get_pendingcourse->total_pending;
            $data['message'] = 'course-pending';
            $this->pusher->trigger('my-channel', 'my-event', $data);
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Course updated successfully!</div>");
        redirect(enterpriseinfo()->shortname. '/live-course-list');
    }

// Function to get all the dates in given range
    function getDatesFromRange($start, $end, $format = 'Y-m-d') {
// Declare an empty array
        $array = array();
// Variable that store the date interval
// of period 1 day
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
// Use loop to store date into array
        foreach ($period as $date) {
            $array[] = $date->format($format);
        }
// Return the array elements
        return $array;
    }

//    =========== its for live_course_delete ===========
    public function live_course_delete() {
        $course_id = $this->input->post('courseid', TRUE);
        if ($course_id) {
            $this->db->where('course_id', $course_id)->delete('course_tbl');
            $this->db->where('course_id', $course_id)->delete('meeting_tbl');
            echo 1;
            echo display('deleted_successfully');
        }
    }
       // ============ its for add_event ===========
       public function add_event(){
        $data['title'] = display('add_event');
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        // $data['get_category'] = $this->Category_model->get_category();
        $data['parent_category'] = $this->Category_model->parent_category();


        $data['module'] = "zoom";
        $data['page'] = "add_event";
        echo modules::run('template/layout', $data);
    }
    
    // ============= its for live_event_save ================
    public function live_event_save(){        
        $course_id = "LEO" . date('d') . $this->generators->generator(5);
        $courseid = $this->input->post('course_id', TRUE);
        $is_livecourse = $this->input->post('is_livecourse', TRUE);
        $name = $this->input->post('name', true);
        $slug = str_replace(" ", "-", strtolower($name));
        $slug = rtrim($slug, "-");
        $faculty_id = $this->input->post('faculty_id', true);
        $category_id = $this->input->post('category_id', true);
        $subcategory_id = $this->input->post('subcategory_id', TRUE);
        $category_id = (!empty($subcategory_id) ? $subcategory_id : $category_id);
        $course_level = $this->input->post('course_level', true);
        $description = $this->input->post('description', true);
        $language = $this->input->post('language', true);
        $is_popular = $this->input->post('is_popular', true);
        $is_popular = (($is_popular) ? "$is_popular" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }


        $requirements = $this->input->post('requirements', true);

        $benifits = $this->input->post('benifits', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : "0");
        $is_discount = '';
        $discount = '';

        $course_provider = ''; //$this->input->post('course_provider', true);
        $url = ''; //$this->input->post('url', true);
        $thumbnail = $this->input->post('thumbnail', true);

        $meeting_id = $this->input->post('meeting_id', TRUE);
        $meeting_password = $this->input->post('meeting_password', TRUE);
        $start_date = $this->input->post('start_date', True);
        $end_date = $this->input->post('end_date', TRUE);
        $start_time = $this->input->post('start_time', TRUE);
        $end_time = $this->input->post('end_time', TRUE);

        if ($start_date && $end_date) {
            $period = $this->getDatesFromRange($start_date, $end_date);
        }

        $meta_keyword = $name;
        $meta_description = $name;
//picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/course/', 'thumbnail','gif|jpg|png|jpeg|svg|webp'
        );

// if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image, 422, 171
            );
        }
//cover_thumbnail picture upload
        $cover_thumbnail = $this->fileupload->do_upload(
                'assets/uploads/course/', 'cover_thumbnail','gif|jpg|png|jpeg|svg|webp'
        );

// if image is uploaded then resize the $image
        if ($cover_thumbnail !== false && $cover_thumbnail != null) {
            $this->fileupload->do_resize(
                    $cover_thumbnail, 1903, 287
            );
        }

        $course_data = array(
            'course_id' => $course_id,
            'name' => $name,
            'faculty_id' => $faculty_id,
            'summary' => '', //$summary,
            'description' => $description,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'course_level ' => $course_level,
            'language ' => '', //$language,
            'is_popular  ' => $is_popular,
            'requirements ' => json_encode($requirements),
            'benifits ' => json_encode($benifits),
            'is_free' => $is_free,
            'price' => $price,
            'oldprice' => $oldprice,
            'is_discount' => $is_discount,
            'discount' => $discount,
            'course_provider' => $course_provider,
            'url' => $url,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'status' => $status,
            'is_livecourse' => $is_livecourse,
            'event_date' => $end_date,
            'cover_thumbnail' => (!empty($cover_thumbnail) ? $cover_thumbnail : ''),
            'enterprise_id' => get_enterpriseid(),
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->user_id,
        );

        $this->db->insert('course_tbl', $course_data);
          





       



        if ($image) {
            $picture_data = array(
                'from_id' => $course_id,
                'picture' => $image,
                'picture_type' => 'live event',
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->user_id,
            );

            $this->db->insert('picture_tbl', $picture_data);
        }

        foreach ($period as $key => $value) {
            $meeting_data = array(
                'course_id' => $course_id,
                'title' => $name,
                'meeting_id' => $meeting_id,
                'meeting_password' => $meeting_password,
                'meeting_date' => $value,
                'start_date' => $value, //$start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'status' => 0,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id
            );
            $this->db->insert('meeting_tbl', $meeting_data);
        }

        if ($this->user_type == 3) {
            $get_pendingcourse = $this->db->select('count(course_id) as total_pending')->from('course_tbl')->where('status', 0)->get()->row();
            $data['count'] = $get_pendingcourse->total_pending;
            $data['message'] = 'course-pending';
            $this->pusher->trigger('my-channel', 'my-event', $data);
        }











        $course_site= $this->db->select("a.*,b.user_id,b.courses_site,b.courses_email,b.courses_sms")
        ->from('loginfo_tbl a')
         ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
        ->where('a.enterprise_id',get_enterpriseid())
        ->where('a.status',1)
        ->where('b.type',1)
        ->get()->result();
        $app_setting = get_appsettings();
        $fromemail=$app_setting->email;
        $course_url=base_url(enterpriseinfo()->shortname."/event-details/".$course_id);
        $course_details=$this->db->select("*")->from("course_tbl")->where('course_id',$course_id)->get()->row();
        
        foreach($course_site as $course_status){
            if($course_status->courses_site==1){
             $data_nofi=array(
                 'notification_id'=>$course_id,
                 'student_id'=>$course_status->user_id,
                 'notification_type'=>2,
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
                    if($is_livecourse==1){
                     $htmlContent="<h2>Live class</h2> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                    }else{
                     $htmlContent="<h2>Live event</h2> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                    }
                    $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,enterpriseinfo()->shortname);
                    $this->email->to($to_mail_delivered);
                    $this->email->subject(enterpriseinfo()->shortname);
                    $this->email->message($htmlContent);
                    $this->email->send();
                 
                 
            }
            if($course_status->courses_sms==1){
                $to_mobile = $course_status->mobile;
                if($is_livecourse==1){
                  $alphasmsdata = array(
                      'mobile' => $to_mobile,
                      'message' => ": প্রিয় গ্রাহক, আপনার জন্য নতুন Live কোর্স যুক্ত করা হয়েছে -> $course_details->name $description আরো জানতে এখানে ক্লিক করুন :  $course_url ধন্যবাদ। ",
                  );
                  $this->send_elitbuzzsms($alphasmsdata);
                }else{
                      $alphasmsdata = array(
                          'mobile' => $to_mobile,
                          'message' => "প্রিয় গ্রাহক আপনার জন্য একটি নতুন Event যুক্ত করা হয়েছে  -> $course_details->name  $description আরো জানতে এখানে ক্লিক করুন:  $course_url ধন্যবাদ। ",
                      );
                      $this->send_elitbuzzsms($alphasmsdata);
                }
          }

        }

    // instructor notification
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

     $course_url=base_url(enterpriseinfo()->shortname."/event-details/".$course_id);
     $course_details=$this->db->select("*")->from("course_tbl")->where('course_id',$course_id)->get()->row();
     foreach($instructor_course_site as $siteinfo){
      if($siteinfo->courses_site==1){
          $data_nofi=array(
              'notification_id'=>$course_id,
              'student_id'=>$siteinfo->user_id,
              'notification_type'=>2,
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
                 if($is_livecourse==1){
                 $htmlContent="<h2>Live class</h2> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                 }else{
                 $htmlContent="<h2>Live event</h2> <b>$course_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                 }
                 $this->email->from($send_email->smtp_user?$send_email->smtp_user :$demo_email->email,enterpriseinfo()->shortname);
                 $this->email->to($to_mail_delivered);
                 $this->email->subject(enterpriseinfo()->shortname);
                 $this->email->message($htmlContent);
                 $this->email->send();
                  
         }
         if($course_status->courses_sms==1){
              $to_mobile = $course_status->mobile;
              if($is_livecourse==1){
                $alphasmsdata = array(
                    'mobile' => $to_mobile,
                    'message' => "You have a new live course-> $course_details->name  $description Learn more click here:  $course_url",
                );
                $this->send_elitbuzzsms($alphasmsdata);
              }else{
                    $alphasmsdata = array(
                        'mobile' => $to_mobile,
                        'message' => "You have a new course new event -> $course_details->name  $description Learn more click here:  $course_url",
                    );
                    $this->send_elitbuzzsms($alphasmsdata);
              }
    
          }
     }


   // instructor notification end








        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Event added successfully!</div>");
        redirect(enterpriseinfo()->shortname .'/add-event');
    }

    
        //    =========== its for  active event===========
        public function event_active() {

            $event_id = $this->input->post('event_id', true);
            $event_data = array(
                'status' => 1,
            );
            $this->db->where('course_id', $event_id)->update('course_tbl', $event_data);

           // notification query
            // $event_site= $this->db->select("a.student_id,b.events_site,b.events_email,b.events_sms")
            // ->from('students_tbl a')
            //  ->join('notification_config_tbl b', 'b.user_id = a.student_id', 'left')
            // ->where('a.enterprise_id',get_enterpriseid())
            // ->get()->result();


            // $event_site= $this->db->select("a.*,b.user_id,b.events_site,b.events_email,b.events_sms")
            // ->from('loginfo_tbl a')
            //  ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
            // ->where('a.enterprise_id',get_enterpriseid())
            // ->where('a.status',1)
            // ->get()->result();
            // $app_setting = get_appsettings();
            // $fromemail=$app_setting->email;
            // $course_url=base_url(enterpriseinfo()->shortname."/event-details/". $event_id);
            // $event_details=$this->db->select("*")->from("course_tbl")->where('course_id',$event_id)->get()->row();
            // $sms_gateway_info = $this->Setting_model->sms_gateway(1);
            
            // foreach($event_site as $events_status){
            //     if($events_status->events_site==1){
            //      $data_nofi=array(
            //          'notification_id'=>$event_id,
            //          'student_id'=>$events_status->user_id,
            //          'notification_type'=>2,
            //          'created_date'=>date('Y-m-d H:i:s'),
            //          'isNotify'=>1,
            //          'enterprise_id'=>get_enterpriseid(),
            //      );
            //      $this->db->insert('notifications_tbl', $data_nofi);
            //     }
            //     if($events_status->events_email==1){
                    
            //              $to_email = $events_status->email;
            //              $to_mail_delivered = explode(',', $to_email);
            //              $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
            //              $description = word_limiter($event_details->description, 10);
            //                  $config = array(
            //                      'protocol'  => $send_email->protocol,
            //                      'smtp_host' => $send_email->smtp_host,
            //                      'smtp_port' => $send_email->smtp_port,
            //                      'smtp_user' => $send_email->smtp_user,
            //                      'smtp_pass' => $send_email->smtp_pass,
            //                      'mailtype'  => $send_email->mailtype,
            //                      'charset'   => 'utf-8',
            //                      'smtp_crypto'=>'tls'
            //                  );

            //                  $this->load->library('email');
            //                  $this->email->initialize($config);
            //                  $this->email->set_newline("\r\n");
            //                  $this->email->set_mailtype("html");
            //                  $htmlContent="<h1>Forum</h1> <b>$event_details->name</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
            //                  $this->email->from("$fromemail",enterpriseinfo()->shortname);
            //                  $this->email->to($to_mail_delivered);
            //                  $this->email->subject(enterpriseinfo()->shortname);
            //                  $this->email->message($htmlContent);
            //                  $this->email->send();
                     
                     
            //     }
            //      if($events_status->events_sms==1){
            //          $to_mobile = $events_status->mobile;
            //              $this->smsgateway->send([
            //                  'apiProvider' => $sms_gateway_info->provider_name,
            //                  'username' => $sms_gateway_info->user,
            //                  'password' => $sms_gateway_info->password,
            //                  'from' => $sms_gateway_info->authentication,
            //                  'to' =>  $to_mobile ,
            //                  'message' => "Forum -> $event_details->name . $description Learn more click here:  <a href='$course_url'>Link</a>",
            //              ]);
            //      }  
            //   }
       
        }
    
    //    =========== its for forum inactive ===========
        public function event_inactive() {
            
            $event_id = $this->input->post('event_id', true);
            $forum_data = array(
                'status' => 0,
            );
            $this->db->where('course_id', $event_id)->update('course_tbl', $forum_data);

            // notification query
            $event_site= $this->db->select("a.student_id,b.events_site,b.events_email,b.events_sms")
            ->from('students_tbl a')
             ->join('notification_config_tbl b', 'b.user_id = a.student_id', 'left')
            ->where('a.enterprise_id',get_enterpriseid())
            ->get()->result();
            
            foreach( $event_site as $event_status){
               if($event_status->events_site==1){
                // $data_nofi=array(
                //     'notification_id'=>$event_id,
                //     'student_id'=>$event_status->student_id,
                //     'notification_type'=>2,
                //     'isNotify'=>1,
                //     'created_date'=>date('Y-m-d H:i:s'),
                //     'enterprise_id'=>get_enterpriseid(),
                // );
                $this->db->where('notification_id',$event_id)->delete('notifications_tbl');
               }
               if($event_status->events_email==1){
    
               }
               if($event_status->events_sms==1){
    
               }
            }
            echo "inactive";
            // $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Inactivated Successfully</div>");
            // redirect(enterpriseinfo()->shortname.'/forum-list');
        }


     //    ============= its for  liveevent count ===============
     public function liveevent_count($user_id, $user_type) {
        if ($user_type != 1) {
            $this->db->where('created_by', $user_id);
            $this->db->where('is_livecourse', 2);
            $this->db->where('enterprise_id', get_enterpriseid());
        }
        $count_query = $this->db->count_all_results('course_tbl');
        return $count_query;
    }

    //    ======== its for live event list =============
    public function event_list() {
        $data['title'] = display('live') . '  ' . display('event_list');
        $data['total_liveevent'] = $this->liveevent_count($this->user_id, $this->user_type);

        $data['module'] = "zoom";
        $data['page'] = "event_list";
        echo Modules::run("template/layout", $data);
    }

//    ============ its for live course data list ===========
    public function liveevent_datalist() {
        $postData = $_POST;
        $search = (object) array(
                    'name' => $this->input->post('name'),
        );
// Get data
        $data = $this->getliveeventdataList($postData, $search);
        echo json_encode($data);
    }

    public function total_liveeventcount($search = null, $searchQuery = null) {
        $this->db->select('a.*, b.name category_name, c.name faculty_name');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('faculty_tbl c', 'c.faculty_id = a.faculty_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.is_livecourse', 1);
        $this->db->or_where('a.is_livecourse', 2);


        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getliveeventdataList($postData = null, $searchs = null) {
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
            // or c.name like '%" . $searchValue . "%'
        }
## Total number of records without filtering
        $totalRecords = $this->total_livecoursecount($searchs, $searchQuery);
## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*, b.name category_name, c.name faculty_name, (select count(id) from meeting_participant_tbl where event_id= a.course_id) as total_participant');
        $this->db->from('course_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        $this->db->join('category_tbl b', 'b.category_id = a.category_id', 'left');
        $this->db->join('faculty_tbl c', 'c.faculty_id = a.faculty_id', 'left');
        $this->db->group_start();
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.is_livecourse', 1);
        $this->db->or_where('a.is_livecourse', 2);
        $this->db->group_end();


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

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $course_totalsales = $this->Course_model->course_totalsales($record->course_id);


            $editbtn = $statusbtn = $deletebtn = $action = '';
            // if ($this->permission->check_label('course_list')->update()->access()) {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/live-event-edit/" . $record->course_id) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            // }
            // if ($this->permission->check_label('course_list')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="liveevent_delete(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash btn btn-danger btn-sm"></i></a>';
            // }

            if ($record->status == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="event_inactive(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
            } elseif ($record->status == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="event_active(' . "'" . $record->course_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }
            $action =$statusbtn . ' '. $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "name" => $record->name,
                "category_name" => $record->category_name,
                "price" => $record->price,
                // "totalsales" => $course_totalsales->totalsales,
                "total_participant" => $record->total_participant,
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

    //    ========= its for live event edit  ===========
    public function live_event_edit($course_id) {
        $data['title'] = display('live_event_update');
        $data['get_faculty'] = $this->Faculty_model->get_faculty();
        // $data['get_category'] = $this->Category_model->get_category();
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['get_livecourseeditdata'] = $this->Zoom_model->get_livecourseeditdata($course_id);
        $data['get_meetinginfo'] = $this->Zoom_model->getmeetinginfo($course_id);

        if($data["get_livecourseeditdata"]->subcategory_id){
            $data['get_parentcategoryid'] = $this->db->select('parent_id')->where('category_id', $data["get_livecourseeditdata"]->subcategory_id)->get('category_tbl')->row();
            $data['parent_id'] = $data['get_parentcategoryid']->parent_id;
        }else{
            $data['parent_id'] = $data["get_livecourseeditdata"]->category_id;
        }
        $data['category_wise_subcategory'] = $this->Category_model->category_wise_subcategory($data['parent_id'], get_enterpriseid());

        $data['module'] = "zoom";
        $data['page'] = "live_event_edit";
        echo Modules::run("template/layout", $data);
    }

//    ========== it's for live event save =============
    public function live_event_update() {
        $course_id = $this->input->post('course_id', TRUE);
        $is_livecourse = $this->input->post('is_livecourse', TRUE);
        $name = $this->input->post('name', true);
        $slug = str_replace(" ", "-", strtolower($name));
        $slug = rtrim($slug, "-");
        $faculty_id = $this->input->post('faculty_id', true);        
        $category_id = $this->input->post('category_id', true);
        $subcategory_id = $this->input->post('subcategory_id', true);        
        $category_id = (!empty($subcategory_id) ? $subcategory_id : $category_id);
        $course_level = $this->input->post('course_level', true);
        $description = $this->input->post('description', true);
        $language = $this->input->post('language', true);
        $is_popular = $this->input->post('is_popular', true);
        $is_popular = (($is_popular) ? "$is_popular" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }
        

        $requirements = $this->input->post('requirements', true);

        $benifits = $this->input->post('benifits', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");

        // dd($is_free);
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : "0");
        $is_discount = '';
        $discount = '';

        $course_provider = ''; //$this->input->post('course_provider', true);
        $url = ''; //$this->input->post('url', true);
        $thumbnail = $this->input->post('thumbnail', true);

        $meeting_id = $this->input->post('meeting_id', TRUE);
        $meeting_password = $this->input->post('meeting_password', TRUE);
        $start_date = $this->input->post('start_date', True);
        $end_date = $this->input->post('end_date', TRUE);
        $start_time = $this->input->post('start_time', TRUE);
        $end_time = $this->input->post('end_time', TRUE);

        if ($start_date && $end_date) {
            $period = $this->getDatesFromRange($start_date, $end_date);
        }

        $meta_keyword = $name;
        $meta_description = $name;
        //picture upload
        $image = $this->fileupload->update_doupload(
                $course_id, 'assets/uploads/course/', 'thumbnail','gif|jpg|png|jpeg'
        );

// if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image, 422, 171
            );
        }

        
        $old_cover_thumbnail = $this->input->post('old_cover_thumbnail', True);
        //picture upload
        $cover_thumbnail = $this->fileupload->update_doupload(
                $course_id, 'assets/uploads/course/', 'cover_thumbnail','gif|jpg|png|jpeg|svg|webp'
        );

// if image is uploaded then resize the $image
        if ($cover_thumbnail !== false && $cover_thumbnail != null) {
            $this->fileupload->do_resize(
                    $cover_thumbnail, 1903, 287
            );
        }

        $course_data = array(
            'name' => $name,
            'faculty_id' => $faculty_id,
            'summary' => '', //$summary,
            'description' => $description,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'course_level ' => $course_level,
            'language ' => '', //$language,
            'is_popular  ' => $is_popular,
            'requirements ' => json_encode($requirements),
            'benifits ' => json_encode($benifits),
            'is_free' => $is_free,
            'price' => $price,
            'oldprice' => $oldprice,
            'is_discount' => $is_discount,
            'discount' => $discount,
            'course_provider' => $course_provider,
            'url' => $url,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'status' => $status,
            'is_livecourse' => $is_livecourse,
            'cover_thumbnail' => (!empty($cover_thumbnail) ? $cover_thumbnail : $old_cover_thumbnail),
            'event_date' => $end_date,
            'enterprise_id' => get_enterpriseid(),
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->user_id,
        );
        // dd($course_data);
        $this->db->where('course_id', $course_id)->update('course_tbl', $course_data);


        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $course_id)->get()->row();

        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'course',
                    'status' => 1,
                    'updated_date' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $course_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $course_id,
                    'picture' => $image,
                    'picture_type' => 'course',
                    'status' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }

        $this->db->where('course_id', $course_id)->delete('meeting_tbl');
        foreach ($period as $key => $value) {
            $meeting_data = array(
                'course_id' => $course_id,
                'title' => $name,
                'meeting_id' => $meeting_id,
                'meeting_password' => $meeting_password,
                'meeting_date' => $value,
                'start_date' => $value, //$start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'status' => 0,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id
            );
            $this->db->insert('meeting_tbl', $meeting_data);
        }

        if ($this->user_type == 3) {
            $get_pendingcourse = $this->db->select('count(course_id) as total_pending')->from('course_tbl')->where('status', 0)->get()->row();
            $data['count'] = $get_pendingcourse->total_pending;
            $data['message'] = 'course-pending';
            $this->pusher->trigger('my-channel', 'my-event', $data);
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Event updated successfully!</div>");
        redirect(enterpriseinfo()->shortname. '/event-list');
    }

    
//    =========== its for live_event_delete ===========
public function live_event_delete() {
    $course_id = $this->input->post('courseid', TRUE);
    if ($course_id) {
        $this->db->where('course_id', $course_id)->delete('course_tbl');
        $this->db->where('course_id', $course_id)->delete('meeting_tbl');
        echo 1;
        echo display('deleted_successfully');
    }
}

public function countmeetinglist($event_id, $enterprise_id){
    $total_events = $this->db->where('course_id', $event_id)->where('enterprise_id', $enterprise_id)->count_all_results('meeting_tbl');
    return $total_events;
}

//    ============ its for event details ================
public function event_details($event_id) {
    $data['title'] = display('event_details');
    $data['transfarentmenu'] = '';
    $enterprise_id = (!empty($this->enterprise_shortname) ? enterpriseid_byshortname($this->enterprise_shortname) : 1);
    // $data['enterprise_id'] = $enterprise_id;
    $data['get_eventdetails'] = $this->Frontend_model->get_eventdetails($event_id, $enterprise_id);
    // dd($data['get_eventdetails']);
    // $data['get_meetingdetails'] = $this->Frontend_model->get_meetingdetails($event_id, $enterprise_id);
        
    $data['title'] = display('join_zoom_meeting');
    $config["base_url"] = base_url('join-zoom-meeting/');
    $config["total_rows"] = $this->countmeetinglist($event_id, $enterprise_id);
    $config["per_page"] = 20;
    $config["uri_segment"] = 4;
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
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $data["get_meetingdetails"] = $this->Frontend_model->get_meetingdetails($config["per_page"], $page, $event_id, $enterprise_id);
    $data["links"] = $this->pagination->create_links();
    $data['pagenum'] = $page;

    $data['module'] = "zoom";
    $data['page'] = "event_details";
    echo Modules::run("template/frontend_layout", $data);
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

}


