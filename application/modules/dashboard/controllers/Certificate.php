<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Certificate extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('Certificate_model');
        
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }
    public function index()    {
        $data['title'] = display('add_certificate');
        
        $data['module'] = "dashboard";
        $data['page'] = "certificate/add_certificate";
        echo modules::run('template/layout', $data);
    }
    public function certificate_list()    {
        $data['title'] = display('certificate_list');
        
        $data['module'] = "dashboard";
        $data['page'] = "certificate/certificate_list";
        echo modules::run('template/layout', $data);
    }

//    ============== its for certificateinfo_save =============
public function certificateinfo_save() {
    $id = $this->input->post('id', true);
    $mode = $this->input->post('mode', true);
    $title = $this->input->post('title', true);
    $template_type = $this->input->post('template_type', true);
    $template_body = $this->input->post('template_body', false);
    $old_logo = $this->input->post('old_logo', true);
    $old_signature = $this->input->post('old_signature', true);
    
    //picture upload
    $logo = $this->fileupload->do_upload(
        'assets/uploads/template/', 'image','gif|jpg|png|jpeg|ico|svg'
    );
    //signature upload
    $signature = $this->fileupload->do_upload(
        'assets/uploads/template/', 'signature','gif|jpg|png|jpeg|ico|svg'
    );
    if($mode == 'edit'){
         //picture upload
         $logo = $this->fileupload->update_doupload(
            $id, 'assets/uploads/template/', 'image','gif|jpg|png|jpeg|ico|svg'
        );
         //signature upload
         $signature = $this->fileupload->update_doupload(
            $id, 'assets/uploads/template/', 'signature','gif|jpg|png|jpeg|ico|svg'
        );
    }

    $template_data = array(
        'title' => $title,
        'template_type' => $template_type,
        'template_body' => $template_body,
        'logo' => (!empty($logo) ? $logo : $old_logo),
        'signature' => (!empty($signature) ? $signature : $old_signature),
        'status' => 1,
        'enterprise_id' => get_enterpriseid(),
        'created_by' => $this->user_id,
        'created_date' => $this->createdtime,
    );
    if($mode == 'edit'){
        $this->db->where("id", $id)->update('template_tbl', $template_data);
        echo display('updated_successfully');
    }else{
        $this->db->insert('template_tbl', $template_data);
        echo display('added_successfully');
    }
  
    
}
    public function  get_certificatelist()    {
        $postData = $_POST;
    
        $search = (object) array(
    
        );
        // Get data
        $data = $this->gettemplatelist($postData, $search);
        echo json_encode($data);
    }
    
    public function total_templatecount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('template_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.template_type', 'certificate');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }
    
    public function gettemplatelist($postData = null, $searchs = null)
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
            $searchQuery = " (a.title like '%" . $searchValue . "%'
                            or a.template_type like '%" . $searchValue . "%')
            ";
    
            
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_templatecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;
    
        $this->db->select('a.*');
        $this->db->from('template_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.template_type', 'certificate');
        // $this->db->order_by('a.id', 'desc');
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        // echo $this->db->last_query();exit();
        $data = array();
    
        $sl = $start + 1;
        foreach ($records as $record) {
            $editbtn = $deletebtn = $showbtn = '';
    
            $i = 1;
           
            // if ($this->permission->check_label('category')->update()->access())  {
                $showbtn ='<a href="javascript:void(0)" onclick= "show_certificate(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-info btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Show"><i class="far fa-eye"></i></a>';

                $editbtn ='<a href="javascript:void(0)" onclick= "template_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
               
                // // }
                // // if ($this->permission->check_label('category')->delete()->access()) {
                    $deletebtn='<a href="javascript:void(0)" onclick="template_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
            // }
            $action =  $showbtn . ' '. $editbtn . ' ' . $deletebtn;
    
    
            $data[] = array(
                "sl" => $sl++,
                "title" => $record->title,
                "template_type" => ucwords($record->template_type),
                "template_body" => $record->template_body,
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

    
//    =========== its for show_certificate ==============
public function show_certificate() {
    $data['title'] = display('certificate');
    $id = $this->input->post('id', true);
    $show_certificate = $this->Certificate_model->certificate_edit($id);
    $name = "YOUR NAME";
    $signatue = base_url().$show_certificate->signature;
    $logo = base_url().$show_certificate->logo;
    // dd($show_certificate);
    $data['template'] = $this->smsgateway->certificatetemplate([
        'name' => $name,
        'certificate_name' => $show_certificate->title,
        'summary' => '', //$templates_info->template_body,
        'logo' => "<img src='$logo' width='20%'>",
        'signature' => "<img src='$signatue' width='100%'>",
        'date' => date('Y-m-d'), //date('d F Y', strtotime($data['get_assigncertificate']->created_date)),
        'message' => $show_certificate->template_body,
        'baseurl' => base_url(),
    ]);
//    dd($data['template']);

    $this->load->view('certificate/show_certificate', $data);
}
//    =========== its for certificate edit ==============
public function certificate_edit() {
    $data['title'] = display('certificate');
    $id = $this->input->post('id', true);
    $data['template_edit'] = $this->Certificate_model->certificate_edit($id);

    $this->load->view('certificate/certificate_edit', $data);
}

    //    ============ its for certificate_delete ==========
    public function certificate_delete() {
        $id = $this->input->post('id', true);
        if ($id) {
            $this->db->where('id', $id)->delete('template_tbl');
        }
        echo display('deleted_successfully');
    }

    // ================ its for ===============
    public function certificate_archives(){
        $data['title'] = display('certificate_archives');
        
        $data['module'] = "dashboard";
        $data['page'] = "certificate/certificate_archives";
        echo modules::run('template/layout', $data); 
    }
}