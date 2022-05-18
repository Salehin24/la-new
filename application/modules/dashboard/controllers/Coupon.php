<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Coupon extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        // $this->load->model('Category_model');
        
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }
    public function add_coupon()    {
        $data['title'] = display('add_coupon');
        $data['module'] = "dashboard";
        $data['page'] = "coupon/add_coupon";
        echo modules::run('template/layout', $data);
    }
    public function index($course_id = null){
        //$this->permission->check_label('add_course', 'create')->redirect();
        $data['title'] = display('coupon_list');
        //$data['parent_category'] = $this->Category_model->parent_category();
        $data['total_couponcount'] = $this->total_couponcount();
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
        $data['module'] = "dashboard";
        $data['page'] = "coupon/coupon_list";
        echo modules::run('template/layout', $data);
    }



    // public function index($course_id = null) {
    //     $this->permission->check_label('add_course', 'create')->redirect();
    //     $data['title'] = display('course');
    //     $data['get_languages'] = get_languages();
    //     $data['get_faculty'] = $this->Faculty_model->get_faculty();
    //     $data['parent_category'] = $this->Category_model->parent_category();
    //     $data['get_category'] = $this->Category_model->get_category();
    //     $data['get_categoryforlibary'] = $this->Category_model->get_categoryforlibary();
    //     $data['get_course'] = $this->Course_model->get_course();
    //     $data['get_librarycourse'] = $this->db->select('a.*')->from('library_tbl a')->where('a.enterprise_id', get_enterpriseid())->order_by('a.id', 'desc')->get()->result();

    //     $course_id = $course_id; 
    //     // $data['course_id'] = $course_id;
    //     $data['course_wise_section'] = $this->Course_model->course_wise_section($course_id);
    //     $data["edit_data"] = $this->Course_model->edit_data($course_id);
    //     $data["get_assignexamlist"] = $this->Course_model->get_assignexamlist($course_id);
    //     $data["get_assignmentprojectlist"] = $this->Course_model->get_assignmentprojectlist($course_id);
    //     // dd($data["get_assignmentprojectlist"]);

    //     $data['module'] = "dashboard";
    //     $data['page'] = "course/course";
    //     echo modules::run('template/layout', $data);
    // }

    // ================ its for category_wise_subcategory ==============
    public function category_wise_subcategory(){
        $category_id = $this->input->post('category_id', TRUE);
        $category_wise_subcategory = $this->Category_model->category_wise_subcategory($category_id, get_enterpriseid());
        
        echo "<option value=''>-- select one --</option>";
       foreach ($category_wise_subcategory as $value) {
           echo "<option value='$value->category_id'>$value->name</option>";
       }
    }








    public function  get_couponlist(){
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getcouponlist($postData, $search);
        echo json_encode($data);
    }

    public function total_couponcount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('coupon_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status !=", 2);  
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getcouponlist($postData = null, $searchs = null)
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
             $searchQuery = " (a.coupon_code like '%" . $searchValue . "%')
             ";
         }
        // echo  $searchQuery;exit();
        ## Total number of records without filtering
        $totalRecords = $this->total_couponcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*');
        $this->db->from('coupon_tbl a');
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
       //print_r($records);
        $data = array();
        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $action = $statusbtn = $editbtn = $deletebtn = '';
            if ($record->status == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="couponinactive(' . "'" . $record->coupon_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
            } elseif ($record->status == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="couponactive(' . "'" . $record->coupon_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }

            // if ($this->permission->check_label('category')->update()->access())  {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/edit-coupon/" . $record->coupon_id) . '" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-sm btn-success"></i> </a> ';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="coupon_delete(' . "'" . $record->coupon_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
            $action =  $statusbtn .' '. $editbtn . ' ' . $deletebtn;
        
            $data[] = array(
                "sl" => $sl++,
                "coupon_code" => (!empty($record->coupon_code)?$record->coupon_code : " "),
                "discount_type" => (!empty($record->discount_type)?$record->discount_type : " "),
                "coupon_discount" => (!empty($record->coupon_discount)?$record->coupon_discount : " "),
                'created_date' =>  $record->created_date,
                'created_by' => get_userinfo($record->created_by)->name,
                'updated_date' =>  $record->updated_date,
                'updated_by' => (!empty($record->updated_by) ? get_userinfo($record->updated_by)->name : " "),
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
    
//    ============= its for coupon save ===============
    public function coupon_save() {
        $coupon_id = "C" . date('d') . $this->generators->generator(5);
        $coupon_code     = $this->input->post('coupon_code', true);
        $discount_type   = $this->input->post('discount_type', true);
        $coupon_discount = $this->input->post('coupon_discount', true);
        $discount_limit  = $this->input->post('discount_limit', true);
        $expiry_date     = $this->input->post('expiry_date', true);
        $coupon_data     = array(
            'coupon_id'       => $coupon_id,
            'coupon_code'     =>$coupon_code,
            'discount_type'   => $discount_type,
            'coupon_discount' => $coupon_discount,
            'discount_limit'  => $discount_limit,
            'expiry_date'     => $expiry_date,
            'enterprise_id'   => get_enterpriseid(),
            'status'          => 1,
            'created_date'    => $this->createdtime,
            'created_by'      => $this->user_id,
        );
  
        $this->db->insert('coupon_tbl', $coupon_data);
        activitiylog_save("Coupon Insert By", "Insert", $this->user_id, $this->createdtime);
        echo  'Coupon save successfully' ;
    }

//    =================== its for coupon edit ============
    public function coupon_edit($coupon_id) {
        $data['title']     = display('edit_coupon');
        $data['edit_data'] = $this->db->select('*')->from('coupon_tbl')->where('coupon_id', $coupon_id)->get()->row();
        $data['module'] = "dashboard";
        $data['page'] = "coupon/edit_coupon";
        echo modules::run('template/layout', $data);
    }

//    ======= its for coupon_update =========
    public function coupon_update() {
       $coupon_id       = $this->input->post('coupon_id', true);
       $coupon_code     = $this->input->post('coupon_code', true);
       $discount_type   = $this->input->post('discount_type', true);
       $coupon_discount = $this->input->post('coupon_discount', true);
       $discount_limit  = $this->input->post('discount_limit', true);
        $expiry_date    = $this->input->post('expiry_date', true);
       $coupon_data = array(
           'coupon_code'     =>$coupon_code,
           'discount_type'   => $discount_type,
           'coupon_discount' => $coupon_discount,
           'discount_limit'  => $discount_limit,
           'expiry_date'     => $expiry_date,
           'enterprise_id'   => get_enterpriseid(),
           'status'          => 1,
           'updated_date' => $this->createdtime,
           'updated_by' => $this->user_id,
       );
        $this->db->where('coupon_id', $coupon_id)->update('coupon_tbl', $coupon_data);
        activitiylog_save("Coupon Updated By", "Update", $this->user_id, $this->createdtime);
        echo 'Coupon update successfully';
    }

//============ its for coupon ===========
    public function category_search() {
        $category_name = $this->input->post('category', TRUE);
        $data['category_list'] = $this->Category_model->category_search($category_name);

        $this->load->view('categories/category_search', $data);
    }

    
//    ============ its for coupon inactive =============
    public function coupon_inactive() {
        $coupon_id = $this->input->post('coupon_id', TRUE);
        $data = array(
            'status' => 0,
        );
        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupon_tbl', $data);
        activitiylog_save("Coupon Inactive By", "Inactive", $this->user_id, $this->createdtime);
        echo display('inactive_successfully');
    }

    //    ================== its for coupon active ============
    public function coupon_active() {
        $coupon_id = $this->input->post('coupon_id', TRUE);
        $data = array(
            'status' => 1,
        );
        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupon_tbl', $data);
        activitiylog_save("Coupon Active By", "Active", $this->user_id, $this->createdtime);
        echo display('active_successfully');
    }


    public function coupon_generate(){
        $coupon_generate = date('d') . $this->generators->generator(5);
        echo $coupon_generate;
    }

    public function coupon_delete(){
        $coupon_id = $this->input->post('coupon_id', TRUE);
        // $check_categorycourse = $this->db->select('*')->from('course_tbl')->where('category_id', $category_id)->get()->row();
        $data = array(
            'status' => 2,
            'deleted_by' => $this->user_id,
            'deleted_date' => $this->createdtime
        );
        $this->db->where('coupon_id', $coupon_id)->update('coupon_tbl', $data);
        activitiylog_save("Coupon Deleted By", "Delete", $this->user_id, $this->createdtime);
        echo 1;




    }

}