<?php defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Testimonials extends MX_Controller
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
        $data['title'] = display('testimonials_list');
        $data['module'] = "dashboard";
        $data['page'] = "testimonials/testimonials_list";
        $data['total_testimonialcount'] = $this->total_testimonialcount();

        echo modules::run('template/layout', $data);
    }
   
    public function  get_testimonial()
    {
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->gettestimoniallist($postData, $search);
        echo json_encode($data);
    }

    public function total_testimonialcount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('testimonials_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where("a.status !=", 2);  
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function gettestimoniallist($postData = null, $searchs = null)
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
        $totalRecords = $this->total_testimonialcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*,b.name');
        $this->db->from('testimonials_tbl a');
        $this->db->join('students_tbl b', 'b.student_id = a.user_id',"left");
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
        // echo $this->db->last_query();
  
        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;


            $action = $statusbtn = $editbtn = $deletebtn = '';
            if ($record->status == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="testimonial_inactive(' . "'" . $record->testimonials_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-success"></i></a>';
            } elseif ($record->status == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="testimonials_active(' . "'" . $record->testimonials_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }

            // if ($this->permission->check_label('category')->update()->access()) {
                $editbtn = '<a href="'.base_url(enterpriseinfo()->shortname ."/edit-testimonial/" . $record->testimonials_id).'"  data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="testimonials_delete(' . "'" . $record->testimonials_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            // }
            $action =$statusbtn.' '.$editbtn . ' ' . $deletebtn;
            $udata =  get_userinfo($record->created_by);
             
            $data[] = array(
                "sl"           => $sl++,
                "title"        => $record->title,
                "name"         => ($record?$record->name:''),//get_userinfo($record->user_id)->name,
                "designation"  => $record->designation,
                "created_date" => $record->created_date,
                "created_by"   => ($udata?$udata->name:''),
                "updated_date" => $record->updated_date,
                "updated_by"   => (!empty($record->updated_by) ? get_userinfo($record->updated_by)->name : " "),
                "action"       => $action,
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
    public function add_testimonial(){
        $data['title'] = display('add_testimonial');
        $data['module'] = "dashboard";
        $data['page'] = "testimonials/add_testimonials";
        $data['user'] = $this->db->select('*')->from('students_tbl')->get()->result();
        echo modules::run('template/layout', $data);
    }

    public function testimonial_save(){
        $title         =$this->input->post('title',true);
        $user_id       =$this->input->post('user_id',true);
        $designation   =$this->input->post('designation',true);
        $description   =$this->input->post('description',true);
        $rating_number   =$this->input->post('rating_number',true);
        $testimonial_id="TS".date('d') . $this->generators->generator(5);

       //picture upload
       $image = $this->fileupload->do_upload(
        'assets/uploads/testimonial/', 'image','gif|jpg|png|jpeg|ico|svg'
        );

         if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image,150,50
            );
        }

        $testimonials_data=array(
           'testimonials_id' => $testimonial_id,
            'title'          => $title,
            'user_id'        => $user_id,
            'designation'    => $designation,
            'description'    => $description,
            'rating_number'  => $rating_number,
            'enterprise_id'  => get_enterpriseid(),
            'company_image'  =>$image,
            'status'         => 1,
            'created_by'     => $this->user_id,
            'created_date'   => $this->createdtime,
         );

         
        $this->db->insert('testimonials_tbl', $testimonials_data);
        activitiylog_save("Testimonial Insert By", "Insert", $this->user_id, $this->createdtime);
        echo "Testimonial Insert Successfully";
    }

    public function edit_testimonial($testimonials_id) {
        $data['title']     = display('edit_testimonial');
        $data['edit_data'] = $this->db->select('*')->from('testimonials_tbl')->where('testimonials_id', $testimonials_id)->get()->row();
        $data['module'] = "dashboard";
        $data['page'] = "testimonials/edit_testimonials";
        $data['user'] = $this->db->select('*')->from('students_tbl')->get()->result();
        echo modules::run('template/layout', $data);
    }
    public function testimonial_update(){
        $testimonials_id = $this->input->post('testimonials_id', true);
        $title         =$this->input->post('title',true);
        $user_id       =$this->input->post('user_id',true);
        $designation   =$this->input->post('designation',true);
        $description   =$this->input->post('description',true);
        $rating_number   =$this->input->post('rating_number',true);
        // $testimonial_id="TS".date('d') . $this->generators->generator(5);
        $picture_unlink = $this->db->select('*')->from('testimonials_tbl')->where('testimonials_id',$testimonials_id)->get()->row();
        // if (!empty($picture_unlink->company_image)) {
        //     $img_path = $picture_unlink->company_image;
        //     unlink($img_path);
        
        // $image = $this->fileupload->update_doupload(
        //     $testimonials_id,'assets/uploads/testimonial/','image','gif|jpg|png|jpeg|ico|svg'
        //     );
        // }else{
            $image = $this->fileupload->update_doupload(
                $testimonials_id,'assets/uploads/testimonial/', 'image','gif|jpg|png|jpeg|ico|svg'
                );
        // }

        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image,150,50
            );
        }
        
        $testimonials_data=array(
            'title'          => $title,
            'user_id'        => $user_id,
            'designation'    => $designation,
            'description'    => $description,
            'rating_number'  => $rating_number,
            'company_image'  => (!empty($image)?$image:$this->input->post('old_image',true)),
            'enterprise_id'  => get_enterpriseid(),
            'status'         => 1,
            'created_by'     => $this->user_id,
            'created_date'   => $this->createdtime,
         );
        $this->db->where('testimonials_id', $testimonials_id)->update('testimonials_tbl',$testimonials_data);
        activitiylog_save("Testimonials Updated By", "Update", $this->user_id, $this->createdtime);
        echo display('updated_successfully');
    } 
    

    //    ============ its for testimonials inactive =============
    public function testimonial_inactive() {
        $testimonials_id = $this->input->post('testimonials_id', TRUE);
        $data = array(
            'status' => 0,
        );
        $this->db->where('testimonials_id', $testimonials_id);
        $this->db->update('testimonials_tbl', $data);
        activitiylog_save("Testimonials Inactive By", "Inactive", $this->user_id, $this->createdtime);
        echo display('inactive_successfully');
    }

    //    ================== its for testimonials active ============
    public function testimonial_active() {
        $testimonials_id = $this->input->post('testimonials_id', TRUE);
        $data = array(
            'status' => 1,
        );
        $this->db->where('testimonials_id', $testimonials_id);
        $this->db->update('testimonials_tbl', $data);
        activitiylog_save("Testimonials Active By", "Active", $this->user_id, $this->createdtime);
        echo display('active_successfully');
    }

    //    ================== its for testimonials delete ============
    public function testimonials_delete(){
        $testimonials_id = $this->input->post('testimonials_id', TRUE);
        // $check_categorycourse = $this->db->select('*')->from('course_tbl')->where('category_id', $category_id)->get()->row();
        $data = array(
            'status' => 2,
            // 'deleted_by' => $this->user_id,
            // 'deleted_date' => $this->createdtime
        );
        $this->db->where('testimonials_id', $testimonials_id)->update('testimonials_tbl', $data);
        activitiylog_save("Testimonials Deleted By", "Delete", $this->user_id, $this->createdtime);
        echo 1;

    }
  
}
