<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Category extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('Category_model');
        $this->load->model('Videoapi_model');
        
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }
    
    public function index()    {
        $data['title'] = display('category');
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['total_category'] = $this->total_categorycount();
        
        $data['module'] = "dashboard";
        $data['page'] = "categories/category";
        echo modules::run('template/layout', $data);
    }

    public function  get_categorylist(){
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getcategorylist($postData, $search);
        echo json_encode($data);
    }

    public function total_categorycount($search = null, $searchQuery = null){
        $this->db->select('*');
        $this->db->from('category_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        
        $this->db->where('a.enterprise_id', get_enterpriseid());   
        $this->db->where("a.status !=", 2);  
        $this->db->where('a.parent_id', '');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getcategorylist($postData = null, $searchs = null){        
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
            $searchQuery = " (a.name like '%" . $searchValue . "%'
                            )
            ";
            // $wheredd = '"a.enterprise_id", get_enterpriseid()';
            
        }
        // echo  $searchQuery;exit();
        ## Total number of records without filtering
        $totalRecords = $this->total_categorycount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.id, a.category_id, a.parent_id, a.name category_name, a.ordering, a.status, a.created_by, a.created_date, a.updated_by, a.updated_date');
        $this->db->from('category_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
            // $this->db->where('a.enterprise_id', get_enterpriseid());   
        
        $this->db->where('a.enterprise_id', get_enterpriseid());     
        $this->db->where("a.status !=", 2);  
        $this->db->where('a.parent_id', '');
        // $this->db->order_by('a.ordering', 'asc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        // echo $this->db->last_query(); exit();
        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $action = $statusbtn = $editbtn = $deletebtn = $categorybtn = $orderinput = '';
            // $parents = $this->Category_model->category_parent_name($record->parent_id);
            $categorybtn = '<a href="javascript:void(0)" onclick="showcategory(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >'.(!empty($record->category_name)?$record->category_name : " ").'</a>';
            // $parentcategorybtn = '<a href="javascript:void(0)" onclick="showcategory(' . "'" . $record->parent_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >'.(!empty($record->parent_category)?$record->parent_category : " ").'</a>';
            
            $orderinput = '<input type="text" value="'.$record->ordering.'" id="ordering_'.$record->id.'" onkeyup="assignordering(' . "'" . $record->id . "'" . ', this.value)" class="form-control">';

            if ($record->status == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="categoryinactive(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-info"></i></a>';
            } elseif ($record->status == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="categoryactive(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }

            if ($this->permission->check_label('category')->update()->access())  {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/category-edit/" . $record->category_id) . '" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-sm btn-success text-white"></i> </a> ';
            }
            if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="category_delete(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            }
            $action =  $statusbtn .' '. $editbtn . ' ' . $deletebtn;
        
            $data[] = array(
                "sl" => $sl++,
                "name" => $categorybtn,
                "ordering" => $orderinput,
                // "commission" => $record->commission,
                'created_date' =>  $record->created_date,
                'created_by' => get_userinfo($record->created_by)->name,
                'updated_date' =>  $record->updated_date,
                'updated_by' => get_userinfo($record->updated_by)->name,
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
    
//    ============= its for category save ===============
    public function category_save() {
        $category_id = "C" . date('d') . $this->generators->generator(5);
        $commission_id = "CM" . date('d') . $this->generators->generator(6);

        $name = $this->input->post('name', true);
        $parent_id = $this->input->post('parent_id', true);
        $ordering = $this->input->post('ordering', true);
        $commission = $this->input->post('commission', true);
        $is_popular = $this->input->post('is_popular', true);
        $category_type = $this->input->post('category_type', true);
        if ($parent_id == 'null') {
            $parent_id = 0;
        } else {
            $parent_id = $parent_id;
        }
        $duplicateCheck = $this->Category_model->duplicateCheck($name, get_enterpriseid());
        if($duplicateCheck){
            echo 0;
            exit();
        }
        //picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/categories/', 'image','gif|jpg|png|jpeg|ico'
        );
        // if picture is uploaded then resize the picture
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image,966,179
            );
        }

        $category_data = array(
            'category_id'   => $category_id,
            'name'          => $name,
            'parent_id'     => $parent_id,
            'ordering'     => $ordering,
            'category_type' => $category_type,
            'is_popular' => $is_popular,
            'enterprise_id' => get_enterpriseid(),
            'status'        => 1,
            'created_date'  => $this->createdtime,
            'created_by'    => $this->user_id,
            'updated_date'  => $this->createdtime,
            'updated_by'    => $this->user_id,
        );

        $this->db->insert('category_tbl', $category_data);
        activitiylog_save("Category Insert By", "Insert", $this->user_id, $this->createdtime);

        // if ($commission && $category_id) {
        //     $commission_generate = array(
        //         'commission_id' => $commission_id,
        //         'category_id' => $category_id,
        //         'commission' => $commission,
        //         'commission_rate' => '',
        //         'created_date' => $this->createdtime,
        //         'created_by' => $this->user_id,
        //     );
        //     $this->db->insert('commission_setup_tbl', $commission_generate);
           
        // }
        if ($image) {
            $picture_data = array(
                'from_id' => $category_id,
                'picture' => $image,
                'picture_type' => 'categories',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
           
        }
        // echo display('category_save_successfully');
        echo 1;
    }

//    =================== its for category edit ============
    public function category_edit($category_id) {
        $data['title'] = "Edit Information";
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['edit_data'] = $this->Category_model->edit_data($category_id);

        $data['module'] = "dashboard";
        $data['page'] = "categories/category_edit";
        echo modules::run('template/layout', $data);
    }

//    ======= its for category_update =========
    public function category_update() {
        $category_id = $this->input->post('category_id', true);
        $name = $this->input->post('name', true);
        $parent_id = $this->input->post('parent_id', true);
        $ordering = $this->input->post('ordering', true);
        $category_type = $this->input->post('category_type', true);
        $commission = $this->input->post('commission', true);
        $is_popular = $this->input->post('is_popular', true);
        $icon = $this->input->post('icon', true);
        $is_popular = $this->input->post('is_popular', true);
        if ($parent_id == 'null') {
            $parent_id = 0;
        } else {
            $parent_id = $parent_id;
        }
        //picture upload
        $image = $this->fileupload->update_doupload(
                $category_id, 'assets/uploads/categories/', 'image','gif|jpg|png|jpeg|ico'
        );
        if ( $image !== false &&  $image != null) {
            $this->fileupload->do_resize(
                $image,966, 179
            );
        }
        $category_data = array(
            'name' => $name,
            'parent_id' => $parent_id,
            'ordering' => $ordering,
            'category_type' => $category_type,
            'is_popular' => $is_popular,
            'enterprise_id' => get_enterpriseid(),
            'status' => 1,
            'updated_date' => $this->createdtime,
            'updated_by' => $this->user_id,
        );
        $this->db->where('category_id', $category_id)->update('category_tbl', $category_data);
        activitiylog_save("Category Updated By", "Update", $this->user_id, $this->createdtime);

        // if ($commission && $category_id) {
        //     $check_categorycommission = $this->db->select('*')->from('commission_setup_tbl')->where('category_id', $category_id)->get()->row();
        //     if ($check_categorycommission) {
        //         $commission_generate = array(
        //             'commission' => $commission,
        //             'commission_rate' => '',
        //             'updated_date' => $this->createdtime,
        //             'updated_by' => $this->user_id,
        //         );
        //         $this->db->where('category_id', $category_id)->update('commission_setup_tbl', $commission_generate);
               
        //     } else {
        //         $commission_id = "CM" . date('d') . $this->generators->generator(6);
        //         $commission_generate = array(
        //             'commission_id' => $commission_id,
        //             'category_id' => $category_id,
        //             'commission' => $commission,
        //             'commission_rate' => '',
        //             'updated_date' => $this->createdtime,
        //             'updated_by' => $this->user_id,
        //         );
        //         $this->db->insert('commission_setup_tbl', $commission_generate);
                
        //     }
        // }
        $check_categoryimage = $this->db->select('*')->from('picture_tbl')->where('from_id', $category_id)->get()->row();
        if ($image) {
            if ($check_categoryimage) {
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'categories',
                    'status' => 1,
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $category_id)->update('picture_tbl', $picture_data);
                
            } else {
                $picture_data = array(
                    'from_id' => $category_id,
                    'picture' => $image,
                    'picture_type' => 'categories',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
               
            }
        }
        echo display('update_successfully');
    }

//============ its for category_search ===========
    public function category_search() {
        $category_name = $this->input->post('category', TRUE);
        $data['category_list'] = $this->Category_model->category_search($category_name);

        $this->load->view('categories/category_search', $data);
    }

    
//    ============ its for category inactive =============
public function category_inactive() {
    $category_id = $this->input->post('category_id', TRUE);
    $data = array(
        'status' => 0,
    );
    $this->db->where('category_id', $category_id);
    $this->db->update('category_tbl', $data);
    activitiylog_save($category_id. " Category Inactive By", "Inactive", $this->user_id, $this->createdtime);
    echo display('inactive_successfully');
}

//    ================== its for category active ============
public function category_active() {
    $category_id = $this->input->post('category_id', TRUE);
    $data = array(
        'status' => 1,
    );
    $this->db->where('category_id', $category_id);
    $this->db->update('category_tbl', $data);
    activitiylog_save($category_id ." Category Active By", "Active", $this->user_id, $this->createdtime);
    echo display('active_successfully');
}

//    ================== its for category active ============
public function category_ordering_update() {
    $id = $this->input->post('id', TRUE);
    $ordervalue = $this->input->post('ordervalue', TRUE);
    $data = array(
        'ordering' => $ordervalue,
    );
//    d($data);dd($id);
    $this->db->where('id', $id);
    $this->db->update('category_tbl', $data);
    echo display('added_successfully');
}

    public function category_delete() {
        $category_id = $this->input->post('category_id', TRUE);
        $check_categorycourse = $this->db->select('*')->from('course_tbl')->where('category_id', $category_id)->get()->row();
        // if ($check_categorycourse) {
            // echo 0;
        // } else {
            $data = array(
                'status' => 2,
                'deleted_by' => $this->user_id,
                'deleted_date' => $this->createdtime
            );
            $this->db->where('category_id', $category_id)->update('category_tbl', $data);
            // $this->fileupload->delete_uploadedfile($category_id);
            activitiylog_save("Category Deleted By", "Delete", $this->user_id, $this->createdtime);
            echo 1;
        // }
    }

    public function category_restore() {
        $category_id = $this->input->post('category_id', TRUE);
            $data = array(
                'status' => 1,
            );
            $this->db->where('category_id', $category_id)->update('category_tbl', $data);
            activitiylog_save("Category restore By", "Restore", $this->user_id, $this->createdtime);
            echo 1;
        // }
    }

    
    //    ======= its for show category =============
    public function show_category() {
        $data['title'] = display('show_category');
        $category_id = $this->input->post('category_id', TRUE);
        $data['edit_data'] = $this->Category_model->edit_data($category_id);
        
        $this->load->view('categories/show_category', $data);
    }

    // =============== its for category archives ================
    public function category_archives(){
        $data['title'] = display('category_archives');
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['total_categoryarchive'] = $this->total_categoryarchivecount();
        
        $data['module'] = "dashboard";
        $data['page'] = "categories/category_archives";
        echo modules::run('template/layout', $data);
    }

    public function  get_categoryarchivelist(){
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getcategoryarchivelist($postData, $search);
        echo json_encode($data);
    }

    public function total_categoryarchivecount($search = null, $searchQuery = null)
    {
        $this->db->select('*');
        $this->db->from('category_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        // $this->db->join('commission_setup_tbl b', 'a.category_id = b.category_id', "left");
        $this->db->join('category_tbl c', 'c.category_id = a.parent_id',"left");
        
        $this->db->where('a.enterprise_id', get_enterpriseid());   
        $this->db->where("a.status", 2);  
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getcategoryarchivelist($postData = null, $searchs = null)
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
        $get_enterpriseid = get_enterpriseid();
        if ($searchValue != '') {
            $searchQuery = " (a.name like '%" . $searchValue . "%'
                            or c.name like '%" . $searchValue . "%')
            ";
            // $wheredd = '"a.enterprise_id", get_enterpriseid()';
            
        }

        ## Total number of records without filtering
        $totalRecords = $this->total_categoryarchivecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.id, a.category_id, a.parent_id, a.name category_name, a.status, a.created_by, a.created_date, a.updated_by, a.updated_date, a.deleted_date, a.deleted_by,  b.name as  parent_category, ');
        $this->db->from('category_tbl a');
        
        if ($searchQuery != '')
            $this->db->where($searchQuery);  
        
        // $this->db->join('commission_setup_tbl b', 'a.category_id = b.category_id',"left");
        $this->db->join('category_tbl b', 'b.category_id = a.parent_id',"left");
        
        $this->db->where('a.enterprise_id', get_enterpriseid());     
        $this->db->where("a.status", 2);  
        if($testColumn=='sl' || $testColumn=='action'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        //echo $this->db->last_query(); 
        
        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $action = $action = $restorebtn = '';
            // $parents = $this->Category_model->category_parent_name($record->parent_id);
            $categorybtn = '<a href="javascript:void(0)"  data-toggle="tooltip" title="' . display('show') . '" class="">'.(!empty($record->category_name)?$record->category_name : " ").'</a>';
            $parentcategorybtn = '<a href="javascript:void(0)" data-toggle="tooltip" title="' . display('show') . '" class="">'.(!empty($record->parent_category)?$record->parent_category : " ").'</a>';
            


            if ($this->permission->check_label('category')->delete()->access()) {
                $restorebtn = '<a href="javascript:void(0)" onclick="category_restore(' . "'" . $record->category_id . "'" . ')" data-toggle="tooltip" title="Restore" ><i class="fas fa-redo-alt btn-success text-white btn btn-sm"></i></a>';
            }
            $action =   $restorebtn;
        
            $data[] = array(
                "sl" => $sl++,
                "category_name" => $categorybtn,
                "parent_category" => $parentcategorybtn,
                'created_date' =>  $record->created_date,
                'created_by' => get_userinfo($record->created_by)->name,
                'updated_date' =>  $record->updated_date,
                'updated_by' => get_userinfo($record->updated_by)->name,
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


    public function set_timewatch(){
        $starttime = $this->input->post('starttime');
        $stoptime = $this->input->post('stoptime');
        $running_time = $this->input->post('running_time');
        $type = $this->input->post('type');
        $timediff = timediff($stoptime, $starttime);
        // d("Start Time " .$starttime);
        // d("End Time " .$stoptime);
        // d($timediff);
        // echo $running_time;
        $checkwatchdata = $this->db->where('id', 1)->where('lesson_id', 1)->get('time_tbl')->row();
        // dd($checkwatchdata);
        $oldtime = 0;
        $oldtime = $checkwatchdata->real_time;
        $real_time = $oldtime + $timediff;
        // d($timediff);
        // d($real_time);

        if(!empty($checkwatchdata)){
            $oldtime = $checkwatchdata->real_time;
            $watchdata = array(
                'real_time' => $oldtime + $timediff,
                // 'real_time' => $running_time,
            );
            // d($watchdata);
            $this->db->where('id', 1)->where('lesson_id', 1)->update('time_tbl', $watchdata);
        }else{
            $watchdata = array(
                'real_time' => $oldtime + $timediff,
                // 'real_time' => $running_time,
                'lesson_id' => 1
            );
            $this->db->insert('time_tbl', $watchdata);
        }




    }

    public function test_vimeoapi(){
        $youtube_api_key = get_appsettings()->youtube_api_key;
        $vimeo_api_key = get_appsettings()->vimeo_api_key;
        // $url = 'https://vimeo.com/117275538'; //$data['video_url'];
        // $url = 'https://vimeo.com/105526199'; // 15 seconds 
        $url = 'https://vimeo.com/444150825'; // 60 seconds;
        // $url = 'https://vimeo.com/664155498'; // 29.19 seconds;
        // $url = 'https://www.youtube.com/watch?v=GoSwEBp7e9s'; //$data['video_url'];
        $lesson_provider = 2; //$data['lesson_provider'];

        $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
        $host = isset($host[0]) ? $host[0] : $host;
        
        if ($host == 'vimeo') {
            $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
            $options = array('http' => array(
                    'method' => 'GET',
                    'header' => 'Authorization: Bearer ' . $vimeo_api_key
            ));
            $context = stream_context_create($options);

            $hash = json_decode(file_get_contents("https://api.vimeo.com/videos/".$video_id, false, $context));
            // d($hash);
            $data['vimeodata'] =  array(
                'provider' => 'Vimeo',
                'video_id' => $video_id,
                'title' => $hash->name,
                'description' => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash->description),
                'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash->description),
                'thumbnail' => $hash->pictures->sizes[0]->link,
                'video' => $hash->link,
                'embed_video' => "https://player.vimeo.com/video/" . $video_id,
                'duration' => gmdate("H:i:s", $hash->duration)
            );
            // d($data['vimeodata']);
        } 
        // elseif ('youtube' || 'youtu') {
        //     $video_id = $this->Videoapi_model->youtube_videoid($url);
        //     $hash = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=" . $video_id . "&key=" . $youtube_api_key . ""));
        // //    dd($hash);
        //     $duration = new DateInterval($hash->items[0]->contentDetails->duration);
        //     $data['youtubedata'] = array(
        //         'provider' => 'YouTube',
        //         'video_id' => $video_id,
        //         'title' => $hash->items[0]->snippet->title,
        //         'description' => str_replace(array("", "<br/>", "<br />"), NULL, $hash->items[0]->snippet->description),
        //         'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, nl2br($hash->items[0]->snippet->description)),
        //         'thumbnail' => 'https://i.ytimg.com/vi/' . $hash->items[0]->id . '/default.jpg',
        //         'video' => "http://www.youtube.com/watch?v=" . $hash->items[0]->id,
        //         'embed_video' => "http://www.youtube.com/embed/" . $hash->items[0]->id,
        //         'duration' => $duration->format('%H:%I:%S'),
        //     );
        //     // dd($data['youtubedata']);
        // }
        
        $data['module'] = "dashboard";
        $data['page'] = "categories/test_vimeoapi";
        echo modules::run('template/layout', $data);
    }

    public function subcategory() {
        $data['title'] = display('subcategory');
        $data['parent_category'] = $this->Category_model->parent_category();
        $data['total_subcategorycount'] = $this->total_subcategorycount();
        
        $data['module'] = "dashboard";
        $data['page'] = "categories/subcategory";
        echo modules::run('template/layout', $data);
    }


    public function  get_subcategorylist(){
        $postData = $_POST;

        $search = (object) array();
        // Get data
        $data = $this->getsubcategorylist($postData, $search);
        echo json_encode($data);
    }

    public function total_subcategorycount($search = null, $searchQuery = null){
        $this->db->select('*');
        $this->db->from('category_tbl a');
        $this->db->join('category_tbl b', 'b.parent_id = a.category_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        
        $this->db->where('b.enterprise_id', get_enterpriseid());     
        $this->db->where("b.status !=", 2);  
        $this->db->order_by('b.ordering', 'asc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getsubcategorylist($postData = null, $searchs = null){        
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
            $searchQuery = " (a.name like '%" . $searchValue . "%'
                                or b.name like '%" . $searchValue . "%'
                            )
            ";
            // $wheredd = '"a.enterprise_id", get_enterpriseid()';
            
        }
        // echo  $searchQuery;exit();
        ## Total number of records without filtering
        $totalRecords = $this->total_subcategorycount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;



        $this->db->select('a.id, a.category_id, b.id as subrowid, b.category_id subcategory_id, b.name subcategory, a.name category_name, b.ordering, b.status, a.created_by, a.created_date, a.updated_by, a.updated_date');
        $this->db->from('category_tbl a');
        $this->db->join('category_tbl b', 'b.parent_id = a.category_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
            // $this->db->where('a.enterprise_id', get_enterpriseid());   
        
        $this->db->where('b.enterprise_id', get_enterpriseid());     
        $this->db->where("b.status !=", 2);  
        // $this->db->order_by('b.ordering', 'asc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        // echo $this->db->last_query(); exit();
        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $i = 1;
            $action = $statusbtn = $editbtn = $deletebtn = $subcategorybtn = $orderinput = '';
            // $parents = $this->Category_model->category_parent_name($record->parent_id);
            $subcategorybtn = '<a href="javascript:void(0)" onclick="showcategory(' . "'" . $record->subcategory_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >'.(!empty($record->subcategory)?$record->subcategory : " ").'</a>';
            // $parentcategorybtn = '<a href="javascript:void(0)" onclick="showcategory(' . "'" . $record->parent_id . "'" . ')" data-toggle="tooltip" title="' . display('show') . '" >'.(!empty($record->parent_category)?$record->parent_category : " ").'</a>';
            
            $orderinput = '<input type="text" value="'.$record->ordering.'" id="ordering_'.$record->subrowid.'" onkeyup="assignsubcategoryordering(' . "'" . $record->subrowid . "'" . ', this.value)" class="form-control">';

            if ($record->status == 1) {
                $statusbtn = '<a href="javascript:void(0)" onclick="subcategoryinactive(' . "'" . $record->subcategory_id . "'" . ')" data-toggle="tooltip" title="' . display('disapprove') . '" class="text-white"><i class="fa fa-check btn btn-sm btn-info"></i></a>';
            } elseif ($record->status == 0) {
                $statusbtn = '<a href="javascript:void(0)" onclick="subcategoryactive(' . "'" . $record->subcategory_id . "'" . ')" data-toggle="tooltip" title="' . display('approve') . '" class="text-white"><i class="fa fa-times btn btn-sm btn-warning"></i></a>';
            }

            if ($this->permission->check_label('category')->update()->access())  {
                $editbtn = '<a href="' . base_url(enterpriseinfo()->shortname ."/category-edit/" . $record->subcategory_id) . '" data-toggle="tooltip" title="' . display('edit_course') . '" ><i class="fa fa-edit btn btn-sm btn-success text-white"></i> </a> ';
            }
            if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="category_delete(' . "'" . $record->subcategory_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn btn-sm"></i></a>';
            }
            $action =  $statusbtn .' '. $editbtn . ' ' . $deletebtn;
        
            $data[] = array(
                "sl" => $sl++,
                "subcategory" => $subcategorybtn,
                "category_name" => $record->category_name,
                "ordering" => $orderinput, //$record->ordering,
                // "commission" => $record->commission,
                'created_date' =>  $record->created_date,
                'created_by' => get_userinfo($record->created_by)->name,
                'updated_date' =>  $record->updated_date,
                'updated_by' => get_userinfo($record->updated_by)->name,
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

}