<?php defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
# Author: Bdtask Ltd
# Author link: https://www.bdtask.com/
# Leadacademy Project
# Developed by : Md. Shahab uddin & Al-amin
#------------------------------------
class LibraryContent extends MX_Controller
{

    private $user_id = "";
    private $user_type = "";

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model('setting_model');
        $this->load->model('Faculty_model');
        $this->load->model('Category_model');
        $this->load->model('Course_model');
        $this->load->library('generators');

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname . '/login');
    }
    public function index(){
        $data['title'] = display('library_content_list');
        $data['module'] = "dashboard";
        $data['total_lib_content'] = $this->total_librarycount();
        $data['page'] = "course/library_list";
        echo modules::run('template/layout', $data);
    }
    public function  get_librarylist()
    {
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getlibrarylist($postData, $search);
        echo json_encode($data);
    }

    public function total_librarycount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*, b.name as category_name, c.name as faculty_name, c.user_types as usertype');
        $this->db->from('library_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getlibrarylist($postData = null, $searchs = null)
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
            $searchQuery = " (a.title like '%" . $searchValue . "%')
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_librarycount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.*, b.name as category_name, c.name as faculty_name, c.user_types as usertype');
        $this->db->from('library_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('category_tbl b', 'b.category_id = a.category_id');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;

            $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname . "/library-content-edit/" . $record->library_id) . '" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-success btn-sm"></i> </a> ';
          
            $deletebtn = '<a href="javascript:void(0)" onclick="library_delete(' . "'" . $record->library_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl"         => $sl++,
                "name"      => $record->name,
                "category_name" => $record->category_name,
                "faculty_name"   => $record->faculty_name,
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
    public function library_content_save()
    {   $library_content_id = "Lib" . date('d') . $this->generators->generator(5);
        $name = $this->input->post('name', true);
        $category_id = $this->input->post('category_id', true);
        $faculty_id = $this->input->post('faculty_id', true);
        $level = $this->input->post('level', true);
        $language = $this->input->post('language', true);
        $description = $this->input->post('description', true);
        $offer_courseid = (!empty($this->input->post('offer_courseid', true)) ?$this->input->post('offer_courseid', true) :0);
        $content_provider = $this->input->post('content_provider', true);
        $source = $this->input->post('source', true);
        $picture = $this->input->post('picture', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : "0");
        $is_discount = $this->input->post('is_discount', true);
        $is_discount = (($is_discount) ? "$is_discount" : "0");
        $discount = $this->input->post('discount', true);


        $discount = (!empty($discount) ? "$discount" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }       
        //picture upload
        $image = $this->fileupload->do_upload(
            'assets/uploads/librarycontent/',
            'picture',
            'gif|jpg|png|jpeg'
        );
        $image2 = $this->fileupload->do_upload(
            'assets/uploads/librarycontent/',
            'source',
            'gif|jpg|png|jpeg'
        );

        // if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                $image,
                300,
                300
            );
        }
        if ($image2 !== false && $image2 != null) {
            $this->fileupload->do_resize(
                $image2,
                300,
                300
            );
        }

        $library_data = array(
            'library_id'        => $library_content_id,
            'name'              => $name,
            'category_id'       => $category_id,
            'faculty_id'        => $faculty_id,
            'level '            => $level,
            'language '         => $language,
            'details'           => $description,
            'offer_courseid'    => json_encode($offer_courseid),
            'content_provider'   => $content_provider,
            'source'            => $image2,
            'is_free'           => $is_free,
            'price'             => $price,
            'oldprice'          => $oldprice,
            'is_discount'       => $is_discount,
            'discount'          => $discount,
            'status'            => $status,
            'enterprise_id'     => get_enterpriseid(),
            'created_date'      => $this->createdtime,
            'created_by'        => $this->user_id,
        );
    
     $this->db->insert('library_tbl', $library_data);
     activitiylog_save("Library Insert By", "Insert", $this->user_id, $this->createdtime);
    
        if ($image) {
            $picture_data = array(
                'from_id' => $library_content_id,
                'picture' => $image,
                'picture_type' => 'libraryContent',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );

            $this->db->insert('picture_tbl', $picture_data);
        }
         $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Library added successfully!</div>");
         redirect(enterpriseinfo()->shortname . '/add-course');

       
    }

 

    public function library_content_edit($id)
    {   $data['title'] = display("library_content_edit");
        $data['module'] = "dashboard";
        $data['get_faculty']=$this->Faculty_model->get_faculty();
        $data['get_librarycourse'] =$this->db->select('a.*')->from('library_tbl a')->where('a.enterprise_id', get_enterpriseid())->order_by('a.id', 'desc')->get()->result();
        $data['get_categoryforlibary'] = $this->Category_model->get_categoryforlibary();
        $data['edit_data'] = $this->db->select('a.*, b.picture')
                                      ->from('library_tbl a')
                                      ->join('picture_tbl b', 'b.from_id = a.library_id', 'left')
                                      ->where('library_id',$id)->get()->row();                           
        $data['page'] = "course/edit_library";
        echo modules::run('template/layout', $data);
    }
    public function library_content_update()
    {
        $library_id = $this->input->post('library_id', true);
        $name = $this->input->post('name', true);
        $category_id = $this->input->post('category_id', true);
        $faculty_id = $this->input->post('faculty_id', true);
        $level = $this->input->post('level', true);
        $language = $this->input->post('language', true);
        $description = $this->input->post('description', true);
        $offer_courseid = (!empty($this->input->post('offer_courseid', true)) ?$this->input->post('offer_courseid', true) : 0);
        $content_provider = $this->input->post('content_provider', true);
        $oldsource = $this->input->post('oldsource', true);
        $source =$this->input->post('source', true);
       
        $picture = $this->input->post('picture', true);
        $is_free = $this->input->post('is_free', true);
        $is_free = (($is_free) ? "$is_free" : "0");
        $price = $this->input->post('price', true);
        $price = (!empty($price) ? "$price" : "0");
        $oldprice = $this->input->post('oldprice', true);
        $oldprice = (!empty($oldprice) ? "$oldprice" : "0");
        $is_discount = $this->input->post('is_discount', true);
        $is_discount = (($is_discount) ? "$is_discount" : "0");
        $discount = $this->input->post('discount', true);
        $discount = (!empty($discount) ? "$discount" : "0");
        if ($this->user_type == 1 || $this->user_type == 2) {
            $status = 1;
        } elseif ($this->user_type == 3) {
            $status = 0;
        }
        //picture upload
        $image = $this->fileupload->do_upload(
            'assets/uploads/librarycontent/',
            'picture',
            'gif|jpg|png|jpeg'
        );
        $image2 = $this->fileupload->do_upload(
            'assets/uploads/librarycontent/',
            'source',
            'gif|jpg|png|jpeg'
        );
        
        // if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                $image,
                300,
                300
            );
        }
        if ($image2 !== false && $image2 != null) {
            $this->fileupload->do_resize(
                $image2,
                300,
                300
            );
        }

        $library_data = array(
            'name'              => $name,
            'category_id'       => $category_id,
            'faculty_id'        => $faculty_id,
            'level '            => $level,
            'language '         => $language,
            'details'           => $description,
            'offer_courseid'    => json_encode($offer_courseid),
            'content_provider'   => $content_provider,
            'source'            => (!empty($image2) ? $image2 : $oldsource),
            'is_free'           => $is_free,
            'price'             => $price,
            'oldprice'          => $oldprice,
            'is_discount'       => $is_discount,
            'discount'          => $discount,
            'status'            => $status,
            'enterprise_id'     => get_enterpriseid(),
            'updated_date' => $this->createdtime,
            'updated_by' => $this->user_id,
        );
         $this->db->where('library_id', $library_id)->update('library_tbl', $library_data);
         activitiylog_save($name . " Library Updated By", "Update", $this->user_id, $this->createdtime);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $library_id)->get()->row();
       
        if ($image) {
            if ($check_image) {
              
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'libraryContent',
                    'status' => 1,
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $library_id)->update('picture_tbl', $picture_data);
            } else {
               
                $picture_data = array(
                    'from_id' => $library_id,
                    'picture' => $image,
                    'picture_type' => 'libraryContent',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Library Content updated successfully!</div>");
        redirect(enterpriseinfo()->shortname . '/library-content-list');
    }



    public function library_delete()
    {
        $library_id = $this->input->post('library_id', TRUE);
        if(!empty($library_id)){
        $delete_result=$this->db->where('library_id', $library_id)->delete('library_tbl');
        activitiylog_save("Library Deleted By", "Delete", $this->user_id, $this->createdtime);
        echo 1;
        }else{
            echo 0;
        }
    }
}
