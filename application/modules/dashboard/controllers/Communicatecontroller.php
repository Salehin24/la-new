<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Communicatecontroller extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('Communicate_model');
        $this->load->model('Setting_model');
        
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }
    // public function index()    {
    //     $data['title'] = display('send_email');
        
    //     $data['module'] = "dashboard";
    //     $data['page'] = "communicates/send_email";
    //     echo modules::run('template/layout', $data);
    // }
    public function send_emailform() {
        $data['title'] = display('send_email');
        
        $data['module'] = "dashboard";
        $data['page'] = "communicates/send_emailform";
        echo modules::run('template/layout', $data);
    }

    //    ============ its for get_loadusers ==========
   public function get_loadusers() {
    $type = $this->input->post('type', true);
    $enterprise_id = $this->input->post('enterprise_id', true);
   
    $get_typewiseusers = $this->Communicate_model->get_typewiseusers($type, $enterprise_id);
    
    if($type == 4 || $type == 5){
        echo '<select class="form-control placeholder-single" id="sendto" name="sendto[]"
        data-placeholder="-- select one --" multiple>';
        echo "<option value=''>-- select one --</option>";
        echo "<option value='all'>All</option>";
        foreach ($get_typewiseusers as $value) {
            echo "<option value='$value->log_id'>$value->name</option>";
        }  
        echo '</select>';
    }elseif($type == 6){
        echo '<input name="sendto[]" type="text" class="form-control" id="sendto">';
    }
    echo '<a href="javascript:void(0)" onclick="loadbccusers()">Bcc</a>';
}

    //    ============ its for get_loadbccusers ==========
   public function get_loadbccusers() {
    $type = $this->input->post('type', true);
    $enterprise_id = $this->input->post('enterprise_id', true);
   
    $get_typewiseusers = $this->Communicate_model->get_typewiseusers($type, $enterprise_id);
    
    if($type == 4 || $type == 5){
        echo '<select class="form-control placeholder-single" id="bccsendto" name="bccsendto[]"
        data-placeholder="-- select one --" multiple>';
        echo "<option value=''>-- select one --</option>";
        echo "<option value='all'>All</option>";
        foreach ($get_typewiseusers as $value) {
            echo "<option value='$value->log_id'>$value->name</option>";
        }  
        echo '</select>';
    }elseif($type == 6){
        echo '<input name="bccsendto[]" type="text" class="form-control" id="bccsendto">';
    }
}

public function send_email(){
    $title = $this->input->post('title', true);
    $type = $this->input->post('type', true);
    $senders = $this->input->post('sendto', true);
    $bccsenders = $this->input->post('bccsendto', true);
    $message = $this->input->post('message', true);
    $enterprise_id = get_enterpriseid();
    $data['get_mail_config'] = $this->Setting_model->mailconfig();
    
    // dd($senders);

    //attachment upload
     $attachment = $this->fileupload->do_upload(
        'assets/uploads/attachments/', 'attachment','gif|jpg|png|jpeg|pdf|docs|svg|webp'
    );
    $data['attachment'] = $attachment;
    
    if($senders){
        if($senders[0] == 'all'){
            $get_typewiseusers = $this->Communicate_model->get_typewiseusers($type, $enterprise_id);
            // dd($get_typewiseusers);
            foreach($get_typewiseusers as $user){
                $data['log_id'] = $user->log_id;
                $data['title'] = $title;
                $data['message'] = $message;
                $data['type'] = $type;
                $data['is_bcc'] = 0;
                if($type == 6){
                    $data['others_email'] = $senders;
                }            

                $communicatedata = array(
                    'user_id' => $user->log_id,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'attachment' => (!empty($attachment) ? $attachment : ''),
                    'enterprise_id' => $enterprise_id,
                    'communicate_types' => 2,
                    'created_by' => $enterprise_id,
                    'created_date' => date('Y-m-d H:i:s'), 
                );
                $this->db->insert('communicate_tbl', $communicatedata);
                $this->Communicate_model->mailsend($data);
            }
        }else{
            // dd($senders);
            foreach($senders as $single){
                $data['log_id'] = $single;
                $data['title'] = $title;
                $data['message'] = $message;
                $data['type'] = $type;
                $data['is_bcc'] = 0;
                if($type == 6){
                    $data['others_email'] = $senders;
                }  

                $communicatedata = array(
                    'user_id' => $single,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'attachment' => (!empty($attachment) ? $attachment : ''),
                    'enterprise_id' => $enterprise_id,
                    'communicate_types' => 2,
                    'created_by' => $enterprise_id,
                    'created_date' => date('Y-m-d H:i:s'), 
                );
                // dd($communicatedata);
                $this->db->insert('communicate_tbl', $communicatedata);
                $this->Communicate_model->mailsend($data);
            }
        }
    }

    if($bccsenders){
        if($bccsenders[0] == 'all'){
            $get_typewiseusers = $this->Communicate_model->get_typewiseusers($type, $enterprise_id);
            // dd($get_typewiseusers);
            foreach($get_typewiseusers as $user){
                $data['log_id'] = $user->log_id;
                $data['title'] = $title;
                $data['message'] = $message;
                $data['type'] = $type;
                $data['is_bcc'] = 1;
                if($type == 6){
                    $data['others_email'] = $bccsenders;
                }            

                $communicatedata = array(
                    'user_id' => $user->log_id,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'attachment' => (!empty($attachment) ? $attachment : ''),
                    'enterprise_id' => $enterprise_id,
                    'communicate_types' => 2,
                    'created_by' => $enterprise_id,
                    'created_date' => date('Y-m-d H:i:s'), 
                );
                $this->db->insert('communicate_tbl', $communicatedata);
                $this->Communicate_model->mailsend($data);
            }
        }else{
            foreach($bccsenders as $single){
                $data['log_id'] = $single;
                $data['title'] = $title;
                $data['message'] = $message;
                $data['type'] = $type;
                $data['is_bcc'] = 1;
                if($type == 6){
                    $data['others_email'] = $bccsenders;
                }  

                $communicatedata = array(
                    'user_id' => $single,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'attachment' => (!empty($attachment) ? $attachment : ''),
                    'enterprise_id' => $enterprise_id,
                    'communicate_types' => 2,
                    'created_by' => $enterprise_id,
                    'created_date' => date('Y-m-d H:i:s'), 
                );
                // dd($communicatedata);
                $this->db->insert('communicate_tbl', $communicatedata);
                $this->Communicate_model->mailsend($data);
            }
        }
    }

    $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Send successfully!</div>");
    redirect(enterpriseinfo()->shortname . '/send-emailform/');

}

    public function email_list() {
        $data['title'] = display('email_list');
        
        $data['module'] = "dashboard";
        $data['page'] = "communicates/email_list";
        echo modules::run('template/layout', $data);
    }

    public function  get_emaillist()    {
        $postData = $_POST;
    
        $search = (object) array(
    
        );
        // Get data
        $data = $this->getemaillist($postData, $search);
        echo json_encode($data);
    }
    
    public function total_emailcount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('communicate_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.user_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.communicate_types', 2);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }
    
    public function getemaillist($postData = null, $searchs = null)
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
            $searchQuery = " (b.name like '%" . $searchValue . "%')
                            or a.title like '%" . $searchValue . "%'
            ";
    
            
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_emailcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;
    
        $this->db->select('a.*, b.name');
        $this->db->from('communicate_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.user_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.communicate_types', 2);
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
            // $editbtn = $deletebtn = $showbtn = '';
    
            $i = 1;
           
            $type = '';
            if($record->communicate_types == 1){
                $type = 'SMS';
            }elseif($record->communicate_types == 2){
                $type = "Email";
            }
            // // if ($this->permission->check_label('category')->update()->access())  {
            //     $showbtn ='<a href="javascript:void(0)" onclick= "show_certificate(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-info btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Show"><i class="far fa-eye"></i></a>';

            //     $editbtn ='<a href="javascript:void(0)" onclick= "template_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
               
            //     // // }
            //     // // if ($this->permission->check_label('category')->delete()->access()) {
            //         $deletebtn='<a href="javascript:void(0)" onclick="template_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
            // // }
            // $action =  $showbtn . ' '. $editbtn . ' ' . $deletebtn;
    
    
            $data[] = array(
                "sl" => $sl++,
                "title" => $record->title,
                "message" => ucwords($record->message),
                "name" => $record->name,
                "created_date" => $record->created_date,
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


    
public function send_smsform()    {
    $data['title'] = display('send_sms');
    
    $data['module'] = "dashboard";
    $data['page'] = "communicates/send_smsform";
    echo modules::run('template/layout', $data);
}

public function send_sms(){
    $title = $this->input->post('title', true);
    $type = $this->input->post('type', true);
    $senders = $this->input->post('sendto', true);
    $message = $this->input->post('message');
    $enterprise_id = get_enterpriseid();
    
    // dd($sendto[0]);
    if($senders[0] == 'all'){
        $get_typewiseusers = $this->Communicate_model->get_typewiseusers($type, $enterprise_id);
        // dd($get_typewiseusers);
        foreach($get_typewiseusers as $user){
            $data['log_id'] = $user->log_id;
            $data['type'] = $type;
            $data['title'] = $title;
            $data['message'] = strip_tags(html_entity_decode($message));

            $communicatedata = array(
                'user_id' => $user->log_id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'attachment' => '',
                'enterprise_id' => $enterprise_id,
                'communicate_types' => 1,
                'created_by' => $enterprise_id,
                'created_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->insert('communicate_tbl', $communicatedata);
            // $this->sendsms($data);            
            // $this->smsgateway->send_bdtasksmsgatway($data);
            // $this->smsgateway->send_alphasms($data);
            $this->smsgateway->send_elitbuzzsms($data);
        }
    }else{
        foreach($senders as $single){
            $data['log_id'] = $single;
            $data['type'] = $type;
            $data['title'] = $title;
            $data['message'] = strip_tags(html_entity_decode($message));

            $communicatedata = array(
                'user_id' => $single,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'attachment' => '',
                'enterprise_id' => $enterprise_id,
                'communicate_types' => 1,
                'created_by' => $enterprise_id,
                'created_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->insert('communicate_tbl', $communicatedata);
            // $this->sendsms($data);
            // $this->smsgateway->send_bdtasksmsgatway($data);            
            // $this->smsgateway->send_alphasms($data);
            $this->smsgateway->send_elitbuzzsms($data);
        }
    }
    $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Send successfully!</div>");
    redirect(enterpriseinfo()->shortname . '/send-smsform/');

}

public function sendsms($data) {
    
    $gateway_id = 1;
        $templates_info = $this->db->select('*')->from('template_tbl')->where('id', 1)->get()->row();
        //gate gateway_information
        $sms_gateway_info = $this->Setting_model->sms_gateway($gateway_id);
        $get_userinfo = get_userinfo($data['log_id']);
        
        $template = $this->smsgateway->template([
            'name' => $get_userinfo->name,
            'username' => $get_userinfo->username,
            'log_id' => $get_userinfo->log_id,
            'mobile' => $get_userinfo->mobile,
            'created_at' => date('d F Y', strtotime($get_userinfo->created_at)),
            'message' => $templates_info->template_body,
            'loginlink' => base_url('signin'),
        ]);
        // dd($template);

        $this->smsgateway->send([
            'apiProvider' => $sms_gateway_info->provider_name,
            'username' => $sms_gateway_info->user,
            'password' => $sms_gateway_info->password,
            'from' => $sms_gateway_info->authentication,
            'to' => $get_userinfo->mobile,
            'message' => $template
        ]);
}


    public function sms_list() {
        $data['title'] = display('sms_list');
        
        $data['module'] = "dashboard";
        $data['page'] = "communicates/sms_list";
        echo modules::run('template/layout', $data);
    }

    public function  get_smslist()    {
        $postData = $_POST;
    
        $search = (object) array(
    
        );
        // Get data
        $data = $this->getsmslist($postData, $search);
        echo json_encode($data);
    }
    
    public function total_smscount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('communicate_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.user_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.communicate_types', 1);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }
    
    public function getsmslist($postData = null, $searchs = null)
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
            $searchQuery = " (b.name like '%" . $searchValue . "%')
                            or a.title like '%" . $searchValue . "%'
            ";
    
            
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_smscount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;
    
        $this->db->select('a.*, b.name');
        $this->db->from('communicate_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.user_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.communicate_types', 1);
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
            // $editbtn = $deletebtn = $showbtn = '';
    
            $i = 1;
           
            $type = '';
            if($record->communicate_types == 1){
                $type = 'SMS';
            }elseif($record->communicate_types == 2){
                $type = "Email";
            }
            // // if ($this->permission->check_label('category')->update()->access())  {
            //     $showbtn ='<a href="javascript:void(0)" onclick= "show_certificate(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-info btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Show"><i class="far fa-eye"></i></a>';

            //     $editbtn ='<a href="javascript:void(0)" onclick= "template_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
               
            //     // // }
            //     // // if ($this->permission->check_label('category')->delete()->access()) {
            //         $deletebtn='<a href="javascript:void(0)" onclick="template_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
            // // }
            // $action =  $showbtn . ' '. $editbtn . ' ' . $deletebtn;
    
    
            $data[] = array(
                "sl" => $sl++,
                "title" => $record->title,
                "message" => ucwords($record->message),
                "name" => $record->name,
                "created_date" => $record->created_date,
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

    
    public function notice_board(){
        $data['title'] = display('notice_board');
        
        $data['module'] = "dashboard";
        $data['page'] = "communicates/notice_board";
        echo modules::run('template/layout', $data);
    }

// //    =========== its for show_certificate ==============
// public function show_certificate() {
//     $data['title'] = display('certificate');
//     $id = $this->input->post('id', true);
//     $show_certificate = $this->Certificate_model->certificate_edit($id);
//     $name = "YOUR NAME";
//     // dd($show_certificate);
//     $data['template'] = $this->smsgateway->certificatetemplate([
//         'name' => $name,
//         'certificate_name' => $show_certificate->title,
//         'summary' => '', //$templates_info->template_body,
//         'logo' => $show_certificate->logo,
//         'date' => date('Y-m-d'), //date('d F Y', strtotime($data['get_assigncertificate']->created_date)),
//         'message' => $show_certificate->template_body,
//         'baseurl' => base_url(),
//     ]);
// //    dd($data['template']);

//     $this->load->view('certificate/show_certificate', $data);
// }
// //    =========== its for certificate edit ==============
// public function certificate_edit() {
//     $data['title'] = display('certificate');
//     $id = $this->input->post('id', true);
//     $data['template_edit'] = $this->Certificate_model->certificate_edit($id);

//     $this->load->view('certificate/certificate_edit', $data);
// }

//     //    ============ its for certificate_delete ==========
//     public function certificate_delete() {
//         $id = $this->input->post('id', true);
//         if ($id) {
//             $this->db->where('id', $id)->delete('template_tbl');
//         }
//         echo display('deleted_successfully');
//     }

//     // ================ its for ===============
//     public function certificate_archives(){
//         $data['title'] = display('certificate_archives');
        
//         $data['module'] = "dashboard";
//         $data['page'] = "certificate/certificate_archives";
//         echo modules::run('template/layout', $data); 
//     }
}