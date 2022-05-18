<?php defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Subscription extends MX_Controller
{

    private $user_id = "";
    private $user_type = "";

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model('setting_model');
        // $this->load->model('Faculty_model');
        $this->load->library('generators');

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname . '/login');
    }

    public function index()
    {
        $data['title'] = display('subscription_list');
        $course_type = "JSON_CONTAINS(course_type, '[\"2\"]')";
        $data['subscription_course']=$this->db->select('name,course_id')->from('course_tbl')->where($course_type)->where('status',1)->get()->result();
        $data['total_subscription'] = $this->total_subscriptioncount();
        
        $data['module'] = "dashboard";
        $data['page'] = "course/subscription_list";
        echo modules::run('template/layout', $data);
    }
    public function subcription_save(){
        $title=$this->input->post('title',true);
        $start_date=$this->input->post('start_date',true);
        $end_date=$this->input->post('end_date',true);
        $duration=$this->input->post('duration',true);
        $course_id=$this->input->post('course_id',true);
        $description=$this->input->post('description',true);
        $course_sub_content=$this->input->post('course_sub_content',true);
        $price=$this->input->post('price',true);
        $is_free=$this->input->post('is_free',true);
        $subscrption_id  = "sub" . date('d') . $this->generators->generator(5);
        
        $subctiption_data=array(
           'subscription_id'    => $subscrption_id,
           'title'             => $title,
        //    'start_time'        => $start_date,
        //    'end_time'          => $end_date,
           'description'       => $description,
           'duration'          => $duration,
           'price'             => $price,
           'course_sub_content'=>$course_sub_content,
        //    'is_free'           =>$is_free,
           'enterprise_id'     => get_enterpriseid(),
           'status'            => 1,
           'created_by'        => $this->user_id,
           'created_date'      => $this->createdtime,
        );
        $this->db->insert('subscription_tbl', $subctiption_data);//

 
        // for($i=0; $i<$count; $i++){
        //     $subctiption=array(
        //         'subscription_id'  => $subscrption_id,
        //         'course_id'        => $course_id[$i],  
        //         'enterprise_id'     => get_enterpriseid(),
        //         'status'            => 1,
        //       );
        //     $this->db->insert('subscription_course_tbl', $subctiption);
        // }
        activitiylog_save("Subcription Insert By", "Insert", $this->user_id, $this->createdtime);
        echo "Subscription Insert Successfully";
    }

    public function  get_subscriptionlist()
    {
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getsubscriptionlist($postData, $search);
        echo json_encode($data);
    }

    public function total_subscriptioncount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('subscription_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getsubscriptionlist($postData = null, $searchs = null)
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
            $searchQuery = " (a.title like '%" . $searchValue . "%')
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_subscriptioncount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*');
        $this->db->from('subscription_tbl a');
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

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            if ($record->duration == 1) {
                $duration = "Monthly" ;
            } elseif ($record->duration == 2) {
                $duration = "Yearly" ;
            } elseif ($record->duration == 3) {
                $duration = "Free" ;
            } elseif ($record->duration == 4) {
                $duration = "Enterprise Package" ;
            }

            // if ($this->permission->check_label('category')->update()->access()) {
                $editbtn = '<a href="javascript:void(0)" onclick="edit_subscription(' . "'" . $record->subscription_id . "'" . ')" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="subscription_delete(' . "'" . $record->subscription_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
            $action =  $editbtn . ' ' . $deletebtn;

            
            $data[] = array(
                "sl" => $sl++,
                "title" =>  $record->title,
                // "start_date" => $record->start_time,
                // "end_date"   => $record->end_time,
                "duration"   => $duration,
                "price"      => $record->price,
                "action"     => $action,
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

    public function subscription_edit(){
        $subscription_id = $this->input->post('subscription_id', TRUE);
        $course_type = "JSON_CONTAINS(course_type, '[\"2\"]')";
        $data['course']=$this->db->select('name,course_id')->from('course_tbl')->where($course_type)->where('status',1)->get()->result();
        // $data['subscription_course']=$this->db->select('subscription_id,course_id')->from('subscription_course_tbl')->where('status',1)->get()->result();
        $data['edit_data'] = $this->db->select('*')->from('subscription_tbl')->where('subscription_id', $subscription_id)->get()->row();
        // echo json_encode($subscription);
        $this->load->view('course/edit_from_subscription',$data);
        
    }
    public function subcription_update(){
        $subscription_id = $this->input->post('subscription_id', true);
        $title = $this->input->post('title', true);
        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);
        $duration = $this->input->post('duration', true);
        $course_id = $this->input->post('course_id', true);
        $description = $this->input->post('description', true);
        $price = $this->input->post('price', true);
        $oldprice = $this->input->post('oldprice', true);
        $course_sub_content=$this->input->post('course_sub_content',true);
        $is_free=$this->input->post('is_free',true);
        $subctiption_data = array(
            'subscription_id'    => $subscription_id,
            'title'              => $title,
            // 'start_time'         => $start_date,
            // 'end_time'           => $end_date,
            'description'        => $description,
            'duration'           => $duration,
            'price'              => $price,
            'oldprice'           => $oldprice,
            'course_sub_content' => $course_sub_content,
            // 'is_free'            => $is_free,
            'enterprise_id'      => get_enterpriseid(),
            'status'             => 1,
            'created_by'         => $this->user_id,
            'created_date'       => $this->createdtime,
        );
        
        $this->db->where('subscription_id', $subscription_id)->update('subscription_tbl',$subctiption_data);
        activitiylog_save("Subcription Updated By", "Update", $this->user_id, $this->createdtime);
        // $existingdata=$this->db->select('subscription_id')->from("subscription_course_tbl")->where('subscription_id',$subscription_id)->get()->result();
        // if($existingdata){
        //     $this->db->where('subscription_id', $subscription_id)->delete('subscription_course_tbl');
        //     $count=count($course_id);
        //     for($i=0; $i<$count; $i++){
        //         $subctiption=array(
        //             'subscription_id'  => $subscription_id,
        //             'course_id'        => $course_id[$i],  
        //             'enterprise_id'     => get_enterpriseid(),
        //             'status'            => 1,
        //         );
        //         $this->db->insert('subscription_course_tbl', $subctiption);
        //     }
        // }else{
        //     $count=count($course_id);
        //     for($i=0; $i<$count; $i++){
        //         $subctiption=array(
        //             'subscription_id'  => $subscription_id,
        //             'course_id'        => $course_id[$i],  
        //             'enterprise_id'     => get_enterpriseid(),
        //             'status'            => 1,
        //         );
        //         $this->db->insert('subscription_course_tbl', $subctiption);
        //     }
        // }
        echo display('updated_successfully');
    } 



    public function subscription_delete(){
        $subscription_id = $this->input->post('subscription_id', TRUE);
    
        $check_subscription = $this->db->select('*')->from('subscription_tbl')->where('subscription_id', $subscription_id)->get()->row();

        if ($check_subscription) {
            echo 1;
            $this->db->where('subscription_id', $subscription_id)->delete('subscription_tbl');
            activitiylog_save("subscription Deleted By", "Delete", $this->user_id, $this->createdtime);
        } else {
            echo 0;
        }
    }
  
}
