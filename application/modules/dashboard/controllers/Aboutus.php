<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Aboutus extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('Aboutus_model');
        $this->load->model('Setting_model');
        
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }
    public function index() {
        $data['title'] = display('aboutus');
        $enterprise_id = get_enterpriseid();
        $data['get_aboutinfo'] = $this->Aboutus_model->get_aboutinfo($enterprise_id);
        
        if($data['get_aboutinfo']){
            $about_id = (($data['get_aboutinfo']->about_id) ? $data['get_aboutinfo']->about_id : '');
            $data['get_aboutchoose'] = $this->Aboutus_model->get_aboutchoose($about_id);
        }
        // dd($data['get_aboutchoose']);
        
        $data['module'] = "dashboard";
        $data['page'] = "aboutus/add";
        echo modules::run('template/layout', $data);
    }

    public function about_summary_save(){
        $about_id = "A" . date('d') . $this->generators->generator(5);
        $summary = $this->input->post('summary', TRUE);
        $aboutlink = $this->input->post('aboutlink', TRUE);
        $mission = $this->input->post('mission', TRUE);
        $aboutid = $this->input->post('about_id', TRUE);
        
       
        
        if($summary){
            $aboutsummary_data = array(
                'about_id'   => (($aboutid) ? $aboutid : $about_id),
                'summary'     => $summary,
                'aboutlink'   => $aboutlink,
                'mission'     => $mission,
                'status'        => 1,
                'enterprise_id' => get_enterpriseid(),
                'created_date'  => $this->createdtime,
                'created_by'    => $this->user_id,
                'updated_date'  => $this->createdtime,
                'updated_by'    => $this->user_id,
            );
        }
      
        if($aboutid){
            $this->db->where('about_id', $aboutid)->update('aboutinfo_tbl', $aboutsummary_data);
            $this->session->set_flashdata('success', "<div class='alert alert-success'>Updated successfully!</div>");
        }else{
            $this->db->insert('aboutinfo_tbl', $aboutsummary_data);
            $this->session->set_flashdata('success', "<div class='alert alert-success'>Added successfully!</div>");
        }

        
        // activitiylog_save("Category Insert By", "Insert", $this->user_id, $this->createdtime);
        redirect(enterpriseinfo()->shortname . '/aboutus/1');
    }
    public function about_choose_save(){
        // $about_id = "A" . date('d') . $this->generators->generator(5);
        $about_id = $this->input->post('about_id', TRUE);
        $choose_title = $this->input->post('choose_title', TRUE);
        $chooselogo = $this->input->post('chooselogo', TRUE);
        
        $filesCount = count($_FILES['chooselogo']['name']);
        
        for ($i = 0; $i < $filesCount; $i++) {
            // d($choose_title[$i]);
            $_FILES['chooselogos']['name'] = $_FILES['chooselogo']['name'][$i];
            $_FILES['chooselogos']['type'] = $_FILES['chooselogo']['type'][$i];
            $_FILES['chooselogos']['tmp_name'] = $_FILES['chooselogo']['tmp_name'][$i];
            $_FILES['chooselogos']['error'] = $_FILES['chooselogo']['error'][$i];
            $_FILES['chooselogos']['size'] = $_FILES['chooselogo']['size'][$i];
            
            // configure for upload 
            $config = array(
                'upload_path' => "./assets/uploads/abouts/",
                'allowed_types' => "gif|jpg|png|jpeg|svg|webp",
                'overwrite' => false,
                'remove_spaces' => true,
                'encrypt_name' => TRUE,
                // 'max_size' => '0',
            );
            $image_data = array();
            
            // autoload the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('chooselogos')) {
                $image_data = $this->upload->data();
                $image_name = 'assets/uploads/abouts/' . $image_data['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path']; //get original image
                $config['maintain_ratio'] = TRUE;
                $config['height'] = 183;
                $config['width'] = 320;
                //                $config['quality'] = 50;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                // if (!$this->image_lib->resize()) {
                //     echo $this->image_lib->translate_errors();
                // }
                // d( $image_name);

                $aboutchooseinfo[$i]['about_id'] = $about_id;
                $aboutchooseinfo[$i]['logo'] = $image_name;
                $aboutchooseinfo[$i]['choose_title'] = $choose_title[$i];
                $aboutchooseinfo[$i]['created_date'] = date('Y-m-d H:i:s');
            }else{
                $aboutchooseinfo[$i]['about_id'] = $about_id;
                $aboutchooseinfo[$i]['logo'] = '';
                $aboutchooseinfo[$i]['choose_title'] = $choose_title[$i];
                $aboutchooseinfo[$i]['created_date'] = date('Y-m-d H:i:s');
            }
        }
        d($aboutchooseinfo);
        if (!empty($aboutchooseinfo)) {
            $insert = $this->db->insert_batch('aboutchoose_tbl', $aboutchooseinfo);
        }

        
        // activitiylog_save("Category Insert By", "Insert", $this->user_id, $this->createdtime);
        $this->session->set_flashdata('success', "<div class='alert alert-success'>Added successfully!</div>");
        redirect(enterpriseinfo()->shortname . '/aboutus/2');
    }

    public function  get_choosenlist() {
        $postData = $_POST;

        $search = (object) array(
            'about_id' => $this->input->post('about_id'),
        );
        // Get data
        $data = $this->getchoosenlist($postData, $search);
        echo json_encode($data);
    }

    public function total_choosendatacount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('aboutchoose_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.about_id', $search->about_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }
    public function getchoosenlist($postData = null, $searchs = null)
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
            $searchQuery = " (a.choose_title like '%" . $searchValue . "%'
                            )
            "; 
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_choosendatacount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*');
        $this->db->from('aboutchoose_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.about_id', $searchs->about_id);
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
            $editbtn = $deletebtn = $picture = '';

            $i = 1;
            $picture = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->logo)) ? html_escape($record->logo) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->choose_title) . '" width="40%" class="avatar-img rounded-circle"></div>';
        // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn ='<a href="javascript:void(0)" onclick= "aboutchoose_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
       
        // // }
        // // if ($this->permission->check_label('category')->delete()->access()) {
            $deletebtn='<a href="javascript:void(0)" onclick="aboutchoose_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
        
        // // }

            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "choose_title" => $record->choose_title,
                "picture" => $picture,
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

      //======= our aboutchoose in edit page ============
      public function aboutchoose_edit(){
        $data['title'] = '';
        $id = $this->input->post('id', true);
        $data['aboutchoose_edit'] = $this->Aboutus_model->aboutchoose_edit($id);
        // dd($data['aboutchoose_edit']);
        
        $this->load->view('aboutus/aboutchoose_edit', $data);
        }
        //=======our about choose in update info ============
        public function aboutchoose_infoupdate(){
            $choose_id = $this->input->post('choose_id', true);
            $title = $this->input->post('title', true);
            $old_logo = $this->input->post('old_logo', true);
            $logo = $this->fileupload->update_doupload(
                    $choose_id, 'assets/uploads/abouts/', 'logo','gif|jpg|png|jpeg|webp|svg'
            );
            
            if ($logo === false) {
                echo display('invalid_logo');
                exit();
            }
             // if image is uploaded then resize the $image
             if ($logo !== false && $logo != null) {
                $this->fileupload->do_resize(
                        $logo, 320, 183
                );
            }
            $choose_data = array(
                'choose_title' => $title,
                'logo' => (($logo) ? $logo : $old_logo),
                'created_date' => $this->createdtime,
            );
         
            $this->db->where('id', $choose_id)->update('aboutchoose_tbl', $choose_data);
        
            echo display('updated_successfully');
        }
             //    ============ its for aboutchoose_delete ==========
             public function aboutchoose_delete() {
                $id = $this->input->post('id', true);
                if ($id) {
                    $picture_unlink = $this->db->select('*')->from('aboutchoose_tbl')->where('id', $id)->get()->row();
                    if (!empty($picture_unlink->logo)) {
                        $img_path = FCPATH . $picture_unlink->logo;
                        unlink($img_path);
                    }
                    $this->db->where('id', $id)->delete('aboutchoose_tbl');
                }
                echo display('deleted_successfully');
            }

            public function about_service_save(){
                $aboutid = $this->input->post('about_id', TRUE);
                $id = $this->input->post('id', TRUE);
                
                // ============== our service =============
                $service_title = $this->input->post('service_title', True);
                if(empty($id)){
                    $subtitle = $this->input->post('subtitle', true);
                }else{
                    $subtitle = $this->input->post('edit_subtitle', true);
                }
                $old_service_logo = $this->input->post('old_service_logo', true);
        
                    //picture upload
                    $service_logo = $this->fileupload->do_upload(
                        'assets/uploads/abouts/', 'service_logo','gif|jpg|png|jpeg|ico|svg'
                );
                // if picture is uploaded then resize the picture
                if ($service_logo !== false && $service_logo != null) {
                    $this->fileupload->do_resize(
                            $service_logo, 165, 165
                    );
                }
                
                if($service_title){
                    $aboutservice_data = array(
                        'about_id'   => $aboutid,
                        'service_title' => $service_title,
                        'service_subtitle' => json_encode($subtitle),
                        'service_logo' => ($service_logo ? $service_logo : $old_service_logo),
                        'status'        => 1,
                        'enterprise_id' => get_enterpriseid(),
                        'created_date'  => $this->createdtime,
                        'created_by'    => $this->user_id,
                        'updated_date'  => $this->createdtime,
                        'updated_by'    => $this->user_id,
                    );
                }
        
              
                if($id){
                    $this->db->where('id', $id)->update('about_service_tbl', $aboutservice_data);
                    $this->session->set_flashdata('success', "<div class='alert alert-success'>Updated successfully!</div>");
                }else{
                    $this->db->insert('about_service_tbl', $aboutservice_data);
                    $this->session->set_flashdata('success', "<div class='alert alert-success'>Added successfully!</div>");
                }
        
                
                // activitiylog_save("Category Insert By", "Insert", $this->user_id, $this->createdtime);
                redirect(enterpriseinfo()->shortname . '/aboutus/3');
            }

            public function  get_aboutservicelist() {
                $postData = $_POST;
        
                $search = (object) array(
                    'about_id' => $this->input->post('about_id'),
                );
                // Get data
                $data = $this->getaboutservicelist($postData, $search);
                echo json_encode($data);
            }
        
            public function total_aboutservicedatacount($search = null, $searchQuery = null)
            {
                $this->db->select('a.*');
                $this->db->from('about_service_tbl a');
                if ($searchQuery != '')
                    $this->db->where($searchQuery);
                $this->db->where('a.about_id', $search->about_id);
                $this->db->order_by('a.id', 'desc');
                $query = $this->db->get();
                $record = $query->num_rows();
                return $record;
            }
            public function getaboutservicelist($postData = null, $searchs = null)
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
                    $searchQuery = " (a.service_title like '%" . $searchValue . "%'
                                    )
                    "; 
                }
                ## Total number of records without filtering
                $totalRecords = $this->total_aboutservicedatacount($searchs, $searchQuery);
                ## Total number of record with filtering
                $totalRecordwithFilter = $totalRecords;
        
                $this->db->select('a.*');
                $this->db->from('about_service_tbl a');
                if ($searchQuery != '')
                    $this->db->where($searchQuery);
                $this->db->where('a.about_id', $searchs->about_id);
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
                    $editbtn = $deletebtn = $service_logo = '';
        
                    $i = 1;
                    $service_logo = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->service_logo)) ? html_escape($record->service_logo) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->service_title) . '" width="40%" class="avatar-img rounded-circle"></div>';
                // if ($this->permission->check_label('category')->update()->access())  {
                    $editbtn ='<a href="javascript:void(0)" onclick= "aboutservice_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
               
                // // }
                // // if ($this->permission->check_label('category')->delete()->access()) {
                    $deletebtn='<a href="javascript:void(0)" onclick="aboutservice_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
                
                // // }
        
                    $action =  $editbtn . ' ' . $deletebtn;
        
        
                    $data[] = array(
                        "sl" => $sl++,
                        "service_title" => $record->service_title,
                        "service_logo" => $service_logo,
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

               //======= our aboutservice_edit in edit page ============
      public function aboutservice_edit(){
        $data['title'] = '';
        $id = $this->input->post('id', true);
        $data['aboutservice_edit'] = $this->Aboutus_model->aboutservice_edit($id);
        
        
        $this->load->view('aboutus/aboutservice_edit', $data);
        }
       
             //    ============ its for aboutchoose_delete ==========
             public function aboutservice_delete(){
                $id = $this->input->post('id', true);
                if ($id) {
                    $picture_unlink = $this->db->select('*')->from('about_service_tbl')->where('id', $id)->get()->row();
                    if (!empty($picture_unlink->service_logo)) {
                        $img_path = FCPATH . $picture_unlink->service_logo;
                        unlink($img_path);
                    }
                    $this->db->where('id', $id)->delete('about_service_tbl');
                }
                echo display('deleted_successfully');
            }
}