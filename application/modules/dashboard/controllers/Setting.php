<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin
  #------------------------------------
class Setting extends MX_Controller {

    private $user_id = '';

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model(array(
            'setting_model', 'user_model', 'stripe_model', 'payeer_model', 'payu_model'
        ));
        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');

        if (!$this->session->userdata('session_id'))
            redirect('login');
    }

    public function index($url = null) {
        $data['title'] = display('setting');
        //check setting table row if not exists then insert a row
        $this->check_setting();
        $data['languageList'] = $this->languageList();
        $data['currencyList'] = $this->setting_model->currencyList();
        $data['setting'] = $this->setting_model->read();

        $data['module'] = "dashboard";
        $data['page'] = "home/setting";
        echo Modules::run('template/layout', $data);
    }


    public function app_setting() {
        $data['title'] = display('application_setting');
        //check setting table row if not exists then insert a row
        $this->check_setting();
        $data['languageList'] = $this->languageList();
        $data['currencyList'] = $this->setting_model->currencyList();
        $data['setting'] = $this->setting_model->read(get_enterpriseid());

        $this->load->view('home/app_setting', $data);
    }

    public function create() {
        $data['title'] = display('application_setting');
        $this->form_validation->set_rules('title', display('application_title'), 'required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('address', display('address'), 'max_length[255]|xss_clean');
        $this->form_validation->set_rules('email', display('email'), 'max_length[100]|valid_email|xss_clean');
        $this->form_validation->set_rules('phone', display('phone'), 'max_length[20]|xss_clean');
        $this->form_validation->set_rules('language', display('language'), 'max_length[250]|xss_clean');
        $this->form_validation->set_rules('footer_text', display('footer_text'), 'max_length[255]|xss_clean');
        $this->form_validation->set_rules('currency', display('currency'), 'required|xss_clean');

        //apps_logo upload
        $apps_logo = $this->fileupload->do_upload(
                'assets/uploads/logo/', 'appslogo','gif|jpg|png|jpeg|ico|svg'
        );
        //backend logo upload
        $logo = $this->fileupload->do_upload(
                'assets/uploads/logo/', 'logo','gif|jpg|png|jpeg|ico|svg'
        );
        //website logo one upload
        $logoTwo = $this->fileupload->do_upload(
                'assets/uploads/logo/', 'logoTwo','gif|jpg|png|jpeg|ico|svg'
        );
        
        //website logo one upload
        $logoThree = $this->fileupload->do_upload(
                'assets/uploads/logo/', 'logoThree','gif|jpg|png|jpeg|ico|svg'
        );
        // if logo is uploaded then resize the logo
        if ($logo !== false && $logo != null) {
            $this->fileupload->do_resize(
                    $logo, 173, 55
            );
        }
        //if logo is not uploaded
        if ($logo === false) {
            $this->session->set_flashdata('exception', display('invalid_logo'));
        }
        //favicon upload
        $favicon = $this->fileupload->do_upload(
                'assets/img/icons/', 'favicon','gif|jpg|png|jpeg|ico|svg'
        );
        // if favicon is uploaded then resize the favicon
        if ($favicon !== false && $favicon != null) {
            $this->fileupload->do_resize(
                    $favicon, 32, 32
            );
        }
        //if favicon is not uploaded
        if ($favicon === false) {
            echo display('invalid_favicon');
        }
//        ============= its for course header image ============
        $courseheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'course_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for faculty header image ============
        $facultyheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'faculty_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for cart header image ============
        $cartheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'cart_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for checkout header image ============
        $checkoutheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'checkout_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for profile header image ============
        $profileheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'profile_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for profile header image ============
        $faqheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'faq_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for project header image ============
        $projectheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'project_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for event header image ============
        $eventheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'event_header_image','gif|jpg|png|jpeg|ico'
        );
       
        //        ============= its for contactus header image ============
        $contacusheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'contactus_header_image','gif|jpg|png|jpeg|ico'
        );
        //        ============= its for forum header image ============
        $forumheaderImage = $this->fileupload->do_upload(
                'assets/img/icons/', 'forum_header_image','gif|jpg|png|jpeg|ico'
        );
        $docusign_sample = $this->fileupload->do_upload(
                'assets/img/icons/', 'docusign_sample','pdf'
        );

        $data['setting'] = (object) $postData = [
            'id'                   => $this->input->post('id', true),
            'storename'            => $this->input->post('stname', TRUE),
            'title'                => $this->input->post('title', TRUE),
            'address'              => $this->input->post('address', TRUE),
            'email'                => $this->input->post('email', TRUE),
            'phone'                => $this->input->post('phone', TRUE),
            'logo'                 => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
            'logoTwo'              => (!empty($logoTwo) ? $logoTwo : $this->input->post('old_logoTwo', true)),
            'logoThree'            => (!empty($logoThree) ? $logoThree : $this->input->post('old_logoThree', true)),
            'favicon'              => (!empty($favicon) ? $favicon : $this->input->post('old_favicon', true)),
            'vat'                  => '',
            'is_ready_subscription'=> $this->input->post('is_ready_subscription', TRUE),
            'currency'             => $this->input->post('currency', TRUE),
            'currency_rate'        => '',
            'currency_position'    => $this->input->post('currency_position', TRUE),
            'language'             => $this->input->post('language', TRUE),
            'dateformat'           => $this->input->post('dateformat', true),
            'site_align'           => $this->input->post('site_align', true),
            'powerbytxt'           => $this->input->post('power_text', TRUE),
            'youtube_api_key'      => $this->input->post('youtube_api_key', TRUE),
            'vimeo_api_key'        => $this->input->post('vimeo_api_key', TRUE),
            'apps_logo'            => (!empty($apps_logo) ? $apps_logo : $this->input->post('old_apps_logo', true)),
            'course_header_image'  => (!empty($courseheaderImage) ? $courseheaderImage : $this->input->post('old_course_header_image', true)),
            'lead_featured_image' => (!empty($facultyheaderImage) ? $facultyheaderImage : $this->input->post('old_faculty_header_image', true)),
            'cart_header_image'    => (!empty($cartheaderImage) ? $cartheaderImage : $this->input->post('old_cart_header_image', true)),
            'checkout_header_image'=> (!empty($checkoutheaderImage) ? $checkoutheaderImage : $this->input->post('old_checkout_header_image', true)),
            'profile_header_image' => (!empty($profileheaderImage) ? $profileheaderImage : $this->input->post('old_profile_header_image', true)),
            'faq_header_image' => (!empty($faqheaderImage) ? $faqheaderImage : $this->input->post('old_faq_header_image', true)),
            'project_header_image' => (!empty($projectheaderImage) ? $projectheaderImage : $this->input->post('old_project_header_image', true)),
            'event_header_image' => (!empty($eventheaderImage) ? $eventheaderImage : $this->input->post('old_event_header_image', true)),
            'contactus_header_image' => (!empty($contacusheaderImage) ? $contacusheaderImage : $this->input->post('old_contactus_header_image', true)),
            'forum_header_image' => (!empty($forumheaderImage) ? $forumheaderImage : $this->input->post('old_forum_header_image', true)),
            'docusign_sample'      => (!empty($docusign_sample) ? $docusign_sample : $this->input->post('old_docusign_sample', true)),
            'apps_url'             => $this->input->post('apps_url', TRUE),
            'header_color'         => $this->input->post('header_color', TRUE),
            'sidebar_color'        => $this->input->post('sidebar_color', TRUE),
            'sidebar_activecolor'  => $this->input->post('sidebar_activecolor', TRUE),
            'button_color'         => $this->input->post('button_color', TRUE),
            'footer_color'         => $this->input->post('footer_color', TRUE),
            'timezone'             => $this->input->post('timezone', TRUE),
            'enterprise_id'        => get_enterpriseid()
        ];
   
        #if empty $id then insert data
        if (empty($postData['id'])) {
            if ($this->setting_model->create($postData)) {
                #set success message
                echo display('save_successfully');
            } else {
                #set exception message
                echo display('please_try_again');
            }
        } else {
          
            if ($this->setting_model->update($postData)) {
                #set success message
                
                 echo display('update_successfully');
            } else {
                #set exception message
                echo display('please_try_again');
            }
        }
        return true;
    }

    //check setting table row if not exists then insert a row
    public function check_setting() {
        if ($this->db->count_all('setting') == 0) {
            $this->db->insert('setting', [
                'title' => 'Dynamic Admin Panel',
                'address' => '123/A, Street, State-12345, Demo',
                'footer_text' => '2016&copy;Copyright',
            ]);
        }
    }

    public function languageList() {
        if ($this->db->table_exists("language")) {

            $fields = $this->db->field_data("language");

            $i = 1;
            foreach ($fields as $field) {
                if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
            }

            if (!empty($result))
                return $result;
        } else {
            return false;
        }
    }

//    ============== its for mail_config ==================
    public function mail_config() {
        $data['title'] = display('mail_config');
        $data['mail_setting'] = $this->setting_model->mailconfig();
        

        $this->load->view('home/mail_config', $data);
    }

//    ============ its for mail_config_update ============
    public function mail_config_update() {
        $protocol = $this->input->post('protocol', true);
        $smtp_host = $this->input->post('smtp_host', true);
        $smtp_port = $this->input->post('smtp_port', true);
        $smtp_user = $this->input->post('smtp_user', true);
        $smtp_pass = $this->input->post('smtp_pass', true);
        $mailtype = $this->input->post('mailtype', true);
        $isinvoice = $this->input->post('isinvoice', true);
        $isreceive = $this->input->post('isreceive', true);

        $mail_data = array(
            'protocol' => $protocol,
            'smtp_host' => $smtp_host,
            'smtp_port' => $smtp_port,
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'mailtype' => $mailtype,
            'is_invoice' => $isinvoice,
            'is_receive' => $isreceive,
            'enterprise_id' => get_enterpriseid(),
        );
        $this->db->where('id', 1)->update('mail_config_tbl', $mail_data);
        echo display('update_successfully');
    }

//    ============== its for sms_config ==================
    public function sms_config() {
        $data['title'] = display('sms_config');
        
        $data['sms_gateway'] = $this->setting_model->sms_gateway();

        $this->load->view('home/sms_config', $data);
    }

    //    ============== its for sms_config_update =========
    public function sms_config_update() {
        $provider_name = $this->input->post('provider_name', true);
        $user_name = $this->input->post('user_name', true);
        $password = $this->input->post('password', true);
        $phone = $this->input->post('phone', true);
        $sender_name = $this->input->post('sender_name', true);
        $isinvoice = $this->input->post('isinvoice', true);
        $isreceive = $this->input->post('isreceive', true);

        $sms_data = array(
            'provider_name' => $provider_name,
            'user' => $user_name,
            'password' => $password,
            'phone' => $phone,
            'authentication' => $sender_name,
            'is_invoice' => $isinvoice,
            'is_receive' => $isreceive,
            'enterprise_id' => get_enterpriseid(),
        );
        $this->db->where('gateway_id', 1)->update('sms_gateway', $sms_data);
        echo display('update_successfully');
    }
    

//    ============== its for payment_method_list ==================
    public function payment_method_list() {
        $data['title'] = display('payment_method_list');
        $data['payment_method_list'] = $this->setting_model->payment_method_list();

        $this->load->view('home/payment_method_list', $data);
    }

//    ============ its for paymentmethode_config_form ============
    public function paymentmethod_config_form() {
        $methodid = $this->input->post('id', True);
        $data['get_paymentmethodinfo'] = $this->setting_model->get_paymentmethodinfo($methodid);

        $this->load->view('home/paymentmethod_config', $data);
    }

//    ========== its for payment method update ===============
    public function payment_method_update() {
        $payment_method_name = $this->input->post('payment_method_name', True);
        $marchant_id = $this->input->post('marchant_id', True);
        $password = $this->input->post('password', True);
        $email = $this->input->post('email', True);
        $currency = $this->input->post('currency', True);
        $is_live = $this->input->post('is_live', True);
        $is_status = $this->input->post('is_status', True);
        $methodid = $this->input->post('methodid', True);
        $paymentmethod_data = array(
            'title' => $payment_method_name,
            'marchant_id' => $marchant_id,
            'password' => $password,
            'email' => $email,
            'marchant_id' => $marchant_id,
            'password' => $password,
            'email' => $email,
            'currency' => $currency,
            'is_live' => $is_live,
            'status' => $is_status,
            'enterprise_id' => get_enterpriseid(),
        );
        $this->db->where('id', $methodid)->update('payment_method_tbl', $paymentmethod_data);
        echo 1;
//        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Payment method updated successfully!</div>");
//        redirect('settings/7');
    }

//    =========== its for payment_method_activeinactive =======
    public function payment_method_activeinactive() {
        $id = $this->input->post('id', TRUE);
        $status = $this->input->post('status', TRUE);
        if ($status == 0) {
            $activedata = array(
                'status' => 1,
            );
            $this->db->where('id', $id);
            $this->db->update('payment_method_tbl', $activedata);
            echo display('active_successfully');
        } elseif ($status == 1) {
            $inactivedata = array(
                'status' => 0,
            );
            $this->db->where('id', $id);
            $this->db->update('payment_method_tbl', $inactivedata);
            echo display('inactive_successfully');
        }
    }



//    ============== its for paypal_config ==================
    public function paypal_config() {

        $data['title'] = display('paypal_config');
        $data['paypal_setting'] = $this->setting_model->paypalconfig();

        $this->load->view('home/paypal_config', $data);
    }

    //    ============ its for paypal_setting_update ============
    public function paypal_setting_update() {
        $ClientID = $this->input->post('ClientID', true);
        $ClientSecret = $this->input->post('ClientSecret', true);
        $currency = $this->input->post('currency', true);
        $mode = $this->input->post('mode', true);


        $paypal_data = array(
            'payment_gateway' => 'paypal',
            'ClientID' => $ClientID,
            'ClientSecret' => $ClientSecret,
            'currency' => $currency,
            'status' => $mode,
            'enterprise_id' => get_enterpriseid(),
            'updated_by' => $this->user_id,
            'updated_date' => date('Y-m-d'),
        );
        $this->db->where('enterprise_id', get_enterpriseid())->update('gateway_tbl', $paypal_data);
        echo display('update_successfully');
    }

//    ============== its for stripe_config ==================
    public function stripe_config() {
        $data['title'] = display('stripe_config');
        $data['get_configdata'] = $this->stripe_model->get_configdata();

        $this->load->view('home/stripe_config', $data);
    }

    //    ============ its for stripeconfig_save ============
    public function stripeconfig_save() {
        $payment_method_name = $this->input->post('payment_method_name', true);
        $marchant_id = $this->input->post('marchant_id', true);
        $password = $this->input->post('password', true);
        $email = $this->input->post('email', true);
        $currency = $this->input->post('currency', true);
        $is_live = $this->input->post('is_live', true);
        $status = $this->input->post('status', true);
        $id = $this->input->post('id', true);


        $stripe_data = array(
            'payment_method_name' => $payment_method_name,
            'marchant_id' => $marchant_id,
            'password' => $password,
            'email' => $email,
            'currency' => $currency,
            'is_live' => $is_live,
            'status' => $status,
            'enterprise_id' => get_enterpriseid(),
        );

        if ($id) {
            $this->db->where('id', $id)->update('stripe_config', $stripe_data);
            echo display('update_successfully');
        } else {
            $this->db->insert('stripe_config', $stripe_data);
            echo display('update_successfully');
        }
    }

//    =========== its for payeer_config =========
    public function payeer_config() {
        $data['title'] = display('payeer_config');
        $data['get_configdata'] = $this->payeer_model->get_configdata();

        $this->load->view('home/payeer_config', $data);
    }

    //    ============ its for payeerconfig_save ============
    public function payeerconfig_save() {
        $payment_method_name = $this->input->post('payment_method_name', true);
        $marchant_id = $this->input->post('marchant_id', true);
        $password = $this->input->post('password', true);
        $email = $this->input->post('email', true);
        $currency = $this->input->post('currency', true);
        $is_live = $this->input->post('is_live', true);
        $status = $this->input->post('status', true);
        $id = $this->input->post('id', true);


        $payeer_data = array(
            'payment_method_name' => $payment_method_name,
            'marchant_id' => $marchant_id,
            'password' => $password,
            'email' => $email,
            'currency' => $currency,
            'is_live' => $is_live,
            'status' => $status,
            'enterprise_id' => get_enterpriseid(),
        );
        if ($id) {
            $this->db->where('id', $id)->update('payeer_config', $payeer_data);
            echo display('update_successfully');
        } else {
            $this->db->insert('payeer_config', $payeer_data);
            echo display('update_successfully');
        }
    }

//    =========== its for payu_config =========
    public function payu_config() {
        $data['title'] = display('payu_config');
        $data['get_configdata'] = $this->payu_model->get_configdata();

        $this->load->view('home/payu_config', $data);
    }

    //    ============ its for payuconfig_save ============
    public function payuconfig_save() {
        $payment_method_name = $this->input->post('payment_method_name', true);
        $marchant_id = $this->input->post('marchant_id', true);
        $password = $this->input->post('password', true);
        $email = $this->input->post('email', true);
        $currency = $this->input->post('currency', true);
        $is_live = $this->input->post('is_live', true);
        $status = $this->input->post('status', true);
        $id = $this->input->post('id', true);


        $payu_data = array(
            'payment_method_name' => $payment_method_name,
            'marchant_id' => $marchant_id,
            'password' => $password,
            'email' => $email,
            'currency' => $currency,
            'is_live' => $is_live,
            'status' => $status,
            'enterprise_id' => get_enterpriseid(),
        );
        if ($id) {
            $this->db->where('id', $id)->update('payu_config', $payu_data);
            echo display('update_successfully');
        } else {
            $this->db->insert('payu_config', $payu_data);
            echo display('update_successfully');
        }
    }

//    ============== its for pusher_config ==================
    public function pusher_config() {
        $data['title'] = display('pusher_config');
        $data['pusher_config'] = $this->setting_model->pusher_config();

        $this->load->view('home/pusher_config', $data);
    }

//    ============ its for pusherconfig_save ============
    public function pusherconfig_save() {
        $api_id = $this->input->post('api_id', true);
        $api_key = $this->input->post('api_key', true);
        $secret_key = $this->input->post('secret_key', true);
        $cluster = $this->input->post('cluster', true);


        $pusher_data = array(
            'api_id' => $api_id,
            'api_key' => $api_key,
            'secret_key' => $secret_key,
            'cluster' => $cluster,
            'status' => 1,
            'enterprise_id' => get_enterpriseid()
        );
        $this->db->where('id', 1)->update('pusherconfig_tbl', $pusher_data);
        echo display('update_successfully');
    }

//    =========== its for subscriber_list ==============
    public function subscriber_list() {
        $data['title'] = display('subscriber_list');
        // $data['subscriber_list'] = $this->setting_model->subscriber_list();

        $this->load->view('home/subscriber_list', $data);
    }

    
    public function  get_subscriberlist()    {
        $postData = $_POST;

        $search = (object) array(

        );
        // Get data
        $data = $this->getsubscriberlist($postData, $search);
        echo json_encode($data);
    }

    public function total_seubscribercount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('subscribes_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getsubscriberlist($postData = null, $searchs = null)
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
            $searchQuery = " (a.mail like '%" . $searchValue . "%')
            ";
  
            
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_seubscribercount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*');
        $this->db->from('subscribes_tbl a');
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
            $editbtn = $deletebtn = '';

            if ($record->is_receive == 1) {
                $is_reveive = display('yes');
            } else {
                $is_reveive = display('no');
            }
            $i = 1;
           
            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "mail" => $record->mail,
                "is_receive" => $is_reveive,
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

//    =========== its for companies ==============
    public function companies() {
        $data['title'] = display('companies');
        // $data['company_list'] = $this->setting_model->company_list(get_enterpriseid());
        $data['total_company'] = $this->total_companycount();

        $this->load->view('home/companies', $data);
    }

    public function  get_companylist()    {
            $postData = $_POST;
    
            $search = (object) array(
    
            );
            // Get data
            $data = $this->getcompanylist($postData, $search);
            echo json_encode($data);
        }
    
        public function total_companycount($search = null, $searchQuery = null)
        {
            $this->db->select('a.*, b.picture');
            $this->db->from('company_tbl a');
            $this->db->join('picture_tbl b', 'b.from_id = a.company_id', 'left');
            if ($searchQuery != '')
                $this->db->where($searchQuery);
            $this->db->order_by('a.id', 'desc');
            $query = $this->db->get();
            $record = $query->num_rows();
            return $record;
        }
    
        public function getcompanylist($postData = null, $searchs = null)
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
                                or a.link like '%" . $searchValue . "%')
                "; 
            }
            ## Total number of records without filtering
            $totalRecords = $this->total_companycount($searchs, $searchQuery);
            ## Total number of record with filtering
            $totalRecordwithFilter = $totalRecords;
    
            $this->db->select('a.*, b.picture');
            $this->db->from('company_tbl a');
            $this->db->join('picture_tbl b', 'b.from_id = a.company_id', 'left');
            if ($searchQuery != '')
                $this->db->where($searchQuery);
                if($testColumn=='sl'){
                    $this->db->order_by('a.id',$columnSortOrder);
                }else{
                    $this->db->order_by($testColumn,$columnSortOrder);
                }
            // $this->db->order_by('a.ordering', 'asc');
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get()->result();
    
            $data = array();
    
            $sl = $start + 1;
            foreach ($records as $record) {
                $editbtn = $deletebtn = $picture = '';
    
                $i = 1;
                $picture = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->name) . '" width="40%" class="avatar-img rounded-circle"></div>';
            // if ($this->permission->check_label('category')->update()->access())  {
                $editbtn ='<a href="javascript:void(0)" onclick= "company_edit(' . "'" . $record->company_id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
           
            // // }
            // // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn='<a href="javascript:void(0)" onclick="company_delete(' . "'" . $record->company_id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
            
            // // }

                $action =  $editbtn . ' ' . $deletebtn;
    
    
                $data[] = array(
                    "sl" => $sl++,
                    "name" => $record->name,
                    "link" => $record->link,
                    "ordering" => $record->ordering,
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



//    ============== its for company_infosave =============
    public function company_infosave() {
        $company_id = "CM" . date('d') . $this->generators->generator(3);
        $name = $this->input->post('name', true);
        $link = $this->input->post('link', true);
        $ordering = $this->input->post('ordering', true);
        $logo = $this->fileupload->do_upload(
                'assets/uploads/companies/', 'logo','gif|jpg|png|jpeg|webp|svg'
        );
        if ($logo === false) {
            echo display('invalid_logo');
            exit();
        }
        // if ($logo !== false && $logo != null) {
        //     $this->fileupload->do_resize(
        //             $logo,196,50
        //     );
        // }
        $company_data = array(
            'company_id' => $company_id,
            'name' => $name,
            'link' => $link,
            'ordering' => $ordering,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        
        $this->db->insert('company_tbl', $company_data);
        // dd($company_data);
        if ($logo) {
            $picture_data = array(
                'from_id' => $company_id,
                'picture' => $logo,
                'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : ''),
                'picture_type' => 'company',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }
        echo display('company_added_successfully');
    }

//    =========== its for company_edit ==============
    public function company_edit() {
        $data['title'] = display('companies');
        $company_id = $this->input->post('company_id', true);
        $data['company_edit'] = $this->setting_model->company_edit($company_id);
        $this->load->view('home/company_edit', $data);
    }

//    ============ its for company_infoupdate==============
    public function company_infoupdate() {
        $company_id = $this->input->post('company_id', true);
        $name = $this->input->post('name', true);
        $link = $this->input->post('link', true);
        $ordering = $this->input->post('ordering', true);
        $old_logo = $this->input->post('old_logo', true);
        $old_logofilename = $this->input->post('old_logofilename', true);
        $logo = $this->fileupload->update_doupload(
                $company_id, 'assets/uploads/companies/', 'logo','gif|jpg|png|jpeg|webp|svg'
        );
        if ($logo === false) {
            echo display('invalid_logo');
            exit();
        }
        // if ($logo !== false && $logo != null) {
        //     $this->fileupload->do_resize(
        //             $logo,196,50
        //     );
        // }
        $company_data = array(
            'name' => $name,
            'link' => $link,
            'ordering' => $ordering,
            'enterprise_id' => get_enterpriseid(),
            'updated_by' => $this->user_id,
            'updated_date' => $this->createdtime,
        );
        $this->db->where('company_id', $company_id)->update('company_tbl', $company_data);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $company_id)->get()->row();
        if ($logo) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                    'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : $old_logofilename),
                    'picture_type' => 'company',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->where('from_id', $company_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $company_id,
                    'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                    'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : $old_logofilename),
                    'picture_type' => 'company',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }
        echo display('updated_successfully');
    }

//    ============ its for company_delete ==========
    public function company_delete() {
        $company_id = $this->input->post('company_id', true);
        if ($company_id) {
            $picture_unlink = $this->db->select('*')->from('picture_tbl')->where('from_id', $company_id)->get()->row();
            if (!empty($picture_unlink->picture)) {
                $img_path = FCPATH . $picture_unlink->picture;
                unlink($img_path);
            }
            $this->db->where('company_id', $company_id)->delete('company_tbl');
            $this->db->where('from_id', $company_id)->delete('picture_tbl');
        }
        echo display('deleted_successfully');
    }

    // ============== its for get proficiency ============
    public function get_proficiency(){
        $data['title'] = display('proficiency');

        $this->load->view('home/proficiency', $data);
    }

    public function  get_proficiencylist() {
        $postData = $_POST;

        $search = (object) array(

        );
        // Get data
        $data = $this->getproficiencylist($postData, $search);
        echo json_encode($data);
    }

    public function total_proficiencycount($search = null, $searchQuery = null){
        $this->db->select('a.*, b.picture');
        $this->db->from('proficiency_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.proficiency_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getproficiencylist($postData = null, $searchs = null){
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
        $totalRecords = $this->total_proficiencycount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*, b.picture');
        $this->db->from('proficiency_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.proficiency_id', 'left');
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
            $editbtn = $deletebtn = '';

            $i = 1;
            $image = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->logo)) ? html_escape($record->logo) : 'assets/img/prof-proficiency-icon.svg') . '" alt="' . html_escape($record->title) . '" width="40%" class="avatar-img rounded-circle"></div>';
            // if ($this->permission->check_label('category')->update()->access())  {
                $editbtn = '<a href="javascript:void(0)" onclick="proficiency_edit(' . "'" . $record->proficiency_id . "'" . ')" data-toggle="tooltip" title="Edit" class="fa fa-edit btn-primary btn-sm"></a>';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="proficiency_delete(' . "'" . $record->proficiency_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn-sm"></i></a>';
            // }
            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "title" => $record->title,
                "picture" => $image,
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

    
//    ============== its for proficiency info save =============
public function proficiency_infosave() {
    $proficiency_id = "PR" . date('d') . $this->generators->generator(4);
    $title = $this->input->post('title', true);
    $logo = $this->fileupload->do_upload(
            'assets/uploads/proficiency/', 'picture', 'gif|jpg|png|jpeg'
    );

    $checkproficiency = $this->db->where('title', $title)->where('enterprise_id', get_enterpriseid())->get('proficiency_tbl')->row();
    if($checkproficiency){
        echo 0;
    }else{
        $proficiency_data = array(
            'proficiency_id' => $proficiency_id,
            'title' => $title,
            'enterprise_id' => get_enterpriseid(),
            'logo' => $logo,
            'status' => 1,
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        $this->db->insert('proficiency_tbl', $proficiency_data);
        // if ($logo) {
        //     $picture_data = array(
        //         'from_id' => $proficiency_id,
        //         'picture' => $logo,
        //         'picture_type' => 'proficiency',
        //         'status' => 1,
        //         'created_date' => $this->createdtime,
        //         'created_by' => $this->user_id,
        //     );
        //     $this->db->insert('picture_tbl', $picture_data);
        // }
        echo 1;
    }
}

//    =========== its for proficiency edit ==============
public function proficiency_edit() {
    $data['title'] = display('proficiency');
    $proficiency_id = $this->input->post('proficiency_id', true);
    $data['proficiency_edit'] = $this->setting_model->proficiency_edit($proficiency_id);
    $this->load->view('home/proficiency_edit', $data);
}

//    ============ its for proficiency infoupdate==============
public function proficiency_infoupdate() {
    $proficiency_id = $this->input->post('proficiency_id', true);
    $title = $this->input->post('title', true);
    $old_logo = $this->input->post('old_logo', true);
    $logo = $this->fileupload->update_doupload(
            $proficiency_id, 'assets/uploads/proficiency/', 'picture', 'gif|jpg|png|jpeg'
    );
    if ($logo === false) {
        echo display('invalid_logo');
        exit();
    }
    $proficiency_data = array(
        'title' => $title,
        'logo' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
        'status' => 1,
        'updated_by' => $this->user_id,
        'updated_date' => $this->createdtime,
    );
    $this->db->where('proficiency_id', $proficiency_id)->update('proficiency_tbl', $proficiency_data);
    // $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $proficiency_id)->get()->row();
    // if ($logo) {
    //     if ($check_image) {
    //         $picture_data = array(
    //             'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
    //             'picture_type' => 'proficiency',
    //             'status' => 1,
    //             'created_date' => $this->createdtime,
    //             'created_by' => $this->user_id,
    //         );
    //         $this->db->where('from_id', $proficiency_id)->update('picture_tbl', $picture_data);
    //     } else {
    //         $picture_data = array(
    //             'from_id' => $proficiency_id,
    //             'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
    //             'picture_type' => 'proficiency',
    //             'status' => 1,
    //             'created_date' => $this->createdtime,
    //             'created_by' => $this->user_id,
    //         );
    //         $this->db->insert('picture_tbl', $picture_data);
    //     }
    // }
    echo display('updated_successfully');
}


//    ============ its for proficiency delete ==========
public function proficiency_delete() {
    $proficiency_id = $this->input->post('proficiency_id', true);
    if ($proficiency_id) {
        $picture_unlink = $this->db->select('*')->from('picture_tbl')->where('from_id', $proficiency_id)->get()->row();
        if (!empty($picture_unlink->picture)) {
            $img_path = FCPATH . $picture_unlink->picture;
            unlink($img_path);
        }
        $this->db->where('proficiency_id', $proficiency_id)->delete('proficiency_tbl');
        $this->db->where('from_id', $proficiency_id)->delete('picture_tbl');
    }
    echo display('deleted_successfully');
}

//    =========== its for team_members ==============
    public function team_members() {
        $data['title'] = display('team_members');
        // $data['teammembers_list'] = $this->setting_model->teammembers_list();

        $this->load->view('home/team_members', $data);
    }
    
    public function  get_teammemberlist()    {
        $postData = $_POST;

        $search = (object) array(

        );
        // Get data
        $data = $this->getteammemberlist($postData, $search);
        echo json_encode($data);
    }

    public function total_teammemberscount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*, b.picture');
        $this->db->from('teammembers_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.teammember_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getteammemberlist($postData = null, $searchs = null)
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
            $searchQuery = " (a.name like '%" . $searchValue . "%')
                            or a.designation like '%" . $searchValue . "%'
            ";
  
            
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_teammemberscount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*, b.picture');
        $this->db->from('teammembers_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.teammember_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        // $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $editbtn = $deletebtn = '';

            $i = 1;
            $image = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->name) . '" width="40%" class="avatar-img rounded-circle"></div>';
            // if ($this->permission->check_label('category')->update()->access())  {
                $editbtn = '<a href="javascript:void(0)" onclick="teammember_edit(' . "'" . $record->teammember_id . "'" . ')" data-toggle="tooltip" title="Edit" class="fa fa-edit btn-primary btn-sm"></a>';
            // }
            // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn = '<a href="javascript:void(0)" onclick="teammember_delete(' . "'" . $record->teammember_id . "'" . ')" data-toggle="tooltip" title="' . display('delete') . '" ><i class="far fa-trash-alt btn-danger  btn-sm"></i></a>';
            // }
            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "name" => $record->name,
                "designation" => $record->designation,
                "picture" => $image,
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

//    ============== its for teammembers_infosave =============
    public function teammembers_infosave() {
        $teammember_id = "TM" . date('d') . $this->generators->generator(4);
        $name = $this->input->post('name', true);
        $designation = $this->input->post('designation', true);
        $logo = $this->fileupload->do_upload(
                'assets/uploads/team_members/', 'picture', 'gif|jpg|png|jpeg'
        );
        $teammember_data = array(
            'teammember_id' => $teammember_id,
            'name' => $name,
            'designation' => $designation,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        $this->db->insert('teammembers_tbl', $teammember_data);
        if ($logo) {
            $picture_data = array(
                'from_id' => $teammember_id,
                'picture' => $logo,
                'picture_type' => 'team-member',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }
        echo display('teammember_added_successfully');
    }

//    =========== its for teammember_edit ==============
    public function teammember_edit() {
        $data['title'] = display('team_members');
        $teammember_id = $this->input->post('teammember_id', true);
        $data['teammember_edit'] = $this->setting_model->teammember_edit($teammember_id);
        $this->load->view('home/teammember_edit', $data);
    }

//    ============ its for team member infoupdate==============
    public function teammember_infoupdate() {
        $teammember_id = $this->input->post('teammember_id', true);
        $name = $this->input->post('name', true);
        $designation = $this->input->post('designation', true);
        $old_logo = $this->input->post('old_logo', true);
        $logo = $this->fileupload->update_doupload(
                $teammember_id, 'assets/uploads/team_members/', 'picture', 'gif|jpg|png|jpeg'
        );
        if ($logo === false) {
            echo display('invalid_logo');
            exit();
        }
        $teammember_data = array(
            'name' => $name,
            'designation' => $designation,
            'updated_by' => $this->user_id,
            'updated_date' => $this->createdtime,
        );
        $this->db->where('teammember_id', $teammember_id)->update('teammembers_tbl', $teammember_data);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $teammember_id)->get()->row();
        if ($logo) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                    'picture_type' => 'team-member',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->where('from_id', $teammember_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $teammember_id,
                    'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                    'picture_type' => 'team-member',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }
        echo display('updated_successfully');
    }


    //    ============ its for teammember_delete ==========
    public function teammember_delete() {
        $teammember_id = $this->input->post('teammember_id', true);
        if ($teammember_id) {
            $picture_unlink = $this->db->select('*')->from('picture_tbl')->where('from_id', $teammember_id)->get()->row();
            if (!empty($picture_unlink->picture)) {
                $img_path = FCPATH . $picture_unlink->picture;
                unlink($img_path);
            }
            $this->db->where('teammember_id', $teammember_id)->delete('teammembers_tbl');
            $this->db->where('from_id', $teammember_id)->delete('picture_tbl');
        }
        echo display('deleted_successfully');
    }

    
//    =========== its for templateinfo ==============
public function templateinfo() {
    $data['title'] = display('templateinfo');
    // $data['teammembers_list'] = $this->setting_model->teammembers_list();

    $this->load->view('home/templateinfo', $data);
}


public function  get_templatelist()    {
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
    $this->db->where('a.template_type !=', 'certificate');
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
        $searchQuery = " (a.name like '%" . $searchValue . "%')
                        or a.template_type like '%" . $searchValue . "%'
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
    $this->db->where('a.template_type !=', 'certificate');
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
        $editbtn = $deletebtn = '';

        $i = 1;
       
        // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn ='<a href="javascript:void(0)" onclick= "template_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1  active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
           
            // // }
            // // if ($this->permission->check_label('category')->delete()->access()) {
                $deletebtn='<a href="javascript:void(0)" onclick="template_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
        // }
        $action =  $editbtn . ' ' . $deletebtn;


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

//    ============== its for templateinfo_save =============
public function templateinfo_save() {
    $id = $this->input->post('id', true);
    $mode = $this->input->post('mode', true);
    $title = $this->input->post('title', true);
    $template_type = $this->input->post('template_type', true);
    $template_body = $this->input->post('template_body', false);
    
    $template_data = array(
        'title' => $title,
        'template_type' => $template_type,
        'template_body' => $template_body,
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


//    =========== its for template edit ==============
public function template_edit() {
    $data['title'] = display('template');
    $id = $this->input->post('id', true);
    $data['template_edit'] = $this->setting_model->template_edit($id);

    $this->load->view('home/template_edit', $data);
}

    //    ============ its for template_delete ==========
    public function template_delete() {
        $id = $this->input->post('id', true);
        if ($id) {
            $this->db->where('id', $id)->delete('template_tbl');
        }
        echo display('deleted_successfully');
    }




//    =========== its for aboutus form ==============
    public function aboutus_form() {
        $data['title'] = display('aboutus_form');
        $enterprise_id = get_enterpriseid();
        $data['get_aboutinfo'] = $this->setting_model->get_aboutinfo($enterprise_id);

        $this->load->view('home/aboutus_form', $data);
    }

//    ============ its for aboutus save ==============
    public function aboutus_save() {
        $about_id = "AB" . date('d') . $this->generators->generator(3);
        $title = $this->input->post('title', true);
        $description = $this->input->post('description', true);
        $checkAboutus = $this->db->select('*')->from('aboutinfo_tbl')->get()->row();

        if ($checkAboutus) {
            $about_id = $checkAboutus->about_id;
            $aboutinfo_data = array(
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'updated_by' => $this->user_id,
                'updated_date' => $this->createdtime,
            );
            $this->db->where('about_id', $about_id)->update('aboutinfo_tbl', $aboutinfo_data);
            //picture upload
            $image = $this->fileupload->update_doupload(
                    $about_id, 'assets/uploads/abouts/', 'image', 'gif|jpg|png|jpeg'
            );
            $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $about_id)->get()->row();
            if ($image) {
                if ($check_image) {
                    $picture_data = array(
                        'from_id' => $about_id,
                        'picture' => $image,
                        'picture_type' => 'about',
                        'status' => 1,
                        'created_date' => $this->createdtime,
                        'created_by' => $this->user_id,
                    );
                    $this->db->where('from_id', $about_id)->update('picture_tbl', $picture_data);
                } else {
                    $picture_data = array(
                        'from_id' => $about_id,
                        'picture' => $image,
                        'picture_type' => 'about',
                        'status' => 1,
                        'created_date' => $this->createdtime,
                        'created_by' => $this->user_id,
                    );
                    $this->db->insert('picture_tbl', $picture_data);
                }
            }
        } else {
            $aboutinfo_data = array(
                'about_id' => $about_id,
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'created_by' => $this->user_id,
                'created_date' => $this->createdtime,
            );
            $this->db->insert('aboutinfo_tbl', $aboutinfo_data);

            //picture upload
            $image = $this->fileupload->do_upload(
                    'assets/uploads/abouts/', 'image', 'gif|jpg|png|jpeg'
            );
            if ($image) {
                $picture_data = array(
                    'from_id' => $about_id,
                    'picture' => $image,
                    'picture_type' => 'about',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>About us updated successfully!</div>");
        redirect(enterpriseinfo()->shortname .'/settings/5');
    }

//    =========== its for privacy policy form ==============
    public function privacy_policy_form() {
        $data['title'] = display('privacy_policy');
        $enterprise_id = get_enterpriseid();
        $data['get_privacypolicy'] = $this->setting_model->get_privacypolicy($enterprise_id);

        $this->load->view('home/privacypolicy_form', $data);
    }

//    =========== its for privacy policy save ==============
    public function privacy_policy_save() {
        $privacy_id = "PP" . date('d') . $this->generators->generator(3);
        $title = $this->input->post('title', true);
        $description = $this->input->post('description', true);
        $check_privacy = $this->db->select('*')->from('privacy_policy_tbl')->get()->row();
        if ($check_privacy) {
            $privacy_id = $check_privacy->privacy_id;
            $privacy_data = array(
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'updated_date' => $this->createdtime,
                'updated_by' => $this->user_id,
            );
            $this->db->where('privacy_id', $privacy_id)->update('privacy_policy_tbl', $privacy_data);
        } else {
            $privacy_data = array(
                'privacy_id' => $privacy_id,
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('privacy_policy_tbl', $privacy_data);
        }
        echo display('updated_successfully');
    }
//    =========== its for refund policy form ==============
    public function refund_policy_form() {
        $data['title'] = display('refund_policy');
        $enterprise_id = get_enterpriseid();
        $data['get_refundpolicy'] = $this->setting_model->get_refundpolicy($enterprise_id);
        
        $this->load->view('home/refundpolicy_form', $data);
    }

//    =========== its for refund policy save ==============
    public function refund_policy_save() {
        $refund_id = "RP" . date('d') . $this->generators->generator(3);
        $title = $this->input->post('title', true);
        $description = $this->input->post('description', true);
        $check_refundpolicy = $this->db->select('*')->from('refund_policy_tbl')->get()->row();
        
        if ($check_refundpolicy) {
            $refund_id = $check_refundpolicy->refund_id;
            $refund_data = array(
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'updated_date' => $this->createdtime,
                'updated_by' => $this->user_id,
            );
            $this->db->where('refund_id', $refund_id)->update('refund_policy_tbl', $refund_data);
        } else {
            $refund_data = array(
                'refund_id' => $refund_id,
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('refund_policy_tbl', $refund_data);
        }
        echo display('updated_successfully');
    }

//    =========== its for terms condition_form form ==============
    public function termscondition_form() {
        $data['title'] = display('terms_condition');
        $enterprise_id = get_enterpriseid();
        $data['get_termscondition'] = $this->setting_model->get_termscondition($enterprise_id);

        $this->load->view('home/termscondition_form', $data);
    }

//    =========== its for terms condition save ==============
    public function termscondition_save() {
        $terms_id = "TC" . date('d') . $this->generators->generator(3);
        $title = $this->input->post('title', true);
        $description = $this->input->post('description', true);
        $check_termscondition = $this->db->select('*')->from('termscondition_tbl')->get()->row();
        if ($check_termscondition) {
            $terms_id = $check_termscondition->terms_id;
            $terms_data = array(
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'updated_date' => $this->createdtime,
                'updated_by' => $this->user_id,
            );
            $this->db->where('terms_id', $terms_id)->update('termscondition_tbl', $terms_data);
        } else {
            $terms_data = array(
                'terms_id' => $terms_id,
                'title' => $title,
                'description' => $description,
                'enterprise_id' => get_enterpriseid(),
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('termscondition_tbl', $terms_data);
        }
        echo display('updated_successfully');
    }

    //    =========== its for terms slider_form form ==============
    public function slider_form() {
        $data['title'] = display('slider');
        $data['get_sliderinfo'] = $this->setting_model->get_sliderinfo();

        $this->load->view('home/slider_form', $data);
    }

    //=========== its for slider_info_save ==========
        public function slider_info_save() {
            $title = $this->input->post('title', true);
            $subtitle = $this->input->post('subtitle', true);
            $old_background_video = $this->input->post('old_background_video', true);
            $short_video_url = $this->input->post('short_video_url', true);
            $slider_point_one = $this->input->post('slider_point_one', true);
            $slider_point_two = $this->input->post('slider_point_two', true);
            $slider_point_three = $this->input->post('slider_point_three', true);
            $old_image = $this->input->post('old_image', true);
            $image = $this->input->post('image', true);
            $slider_logo = $this->input->post('slider_logo', true);
            $old_slider_logo = $this->input->post('old_slider_logo', true);


            $enterprise_id = $this->input->post('enterprise_id', true);
            
            // $check_data = $this->db->select('*')->from('slide_tbl')->get()->row();
            $check_data = $this->db->select('*')->from('slide_tbl')->where('enterprise_id', get_enterpriseid())->get()->row();
            // dd($check_data);
            if ($check_data) {
                $slider_id = $check_data->slider_id;
                // $background_video_url = $this->fileupload->update_doupload(
                //     $slider_id, 'assets/uploads/sliders/', 'background_video_url', 'mp4'
                // );
                $this->load->library('Videoupload');
                $videolink = $this->videoupload->do_upload(
                       'assets/uploads/sliders/', 'background_video_url'
                );
                $background_video_url    = $videolink;

                $subtitle_image = $this->videoupload->do_upload(
                       'assets/uploads/sliders/', 'subtitle_image'
                );

                if ($subtitle_image !== false && $subtitle_image != null) {
                    $this->fileupload->do_resize(
                            $subtitle_image, 1920, 300
                    );
                }


                $logo = $this->fileupload->update_doupload(
                    $slider_id, 'assets/uploads/sliders/', 'slider_pic', 'gif|jpg|png|jpeg'
                );
                
                $slider_logo = '';
                $slider_logo = $this->fileupload->update_doupload($slider_id, 'assets/uploads/sliders/','slider_logo', 'gif|jpg|png|jpeg|svg|webp');
                // dd($slider_logo);
                $config['upload_path'] = './assets/uploads/sliders/'.date('Y-m-d') . "/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|webp';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('slider_logo')) {
                    $data = $this->upload->data();
                    $slider_logo = $config['upload_path'] . $data['file_name'];
                    $config['encrypt_name'] = true;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $slider_logo;
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = TRUE;
                    $this->load->library('image_lib', $config);
                    // $this->image_lib->resize();
                }

                $slider_data = array(
                    'slider_logo' => (!empty($slider_logo) ? $slider_logo : $old_slider_logo),
                    'title'       => $title,
                    'subtitle'    => $subtitle,
                    'background_video_url' =>(!empty($background_video_url) ? $background_video_url : $this->input->post('old_background_video')),
                    'subtitle_image' =>(!empty($subtitle_image) ? $subtitle_image : $this->input->post('old_subtitle_image')),
                    'short_video_url' => $short_video_url,
                    'slider_point_one' => $slider_point_one,
                    'slider_point_two' => $slider_point_two,
                    'slider_point_three' => $slider_point_three,
                    'enterprise_id' => get_enterpriseid(),
                    'updated_by' => $this->user_id,
                    'updated_date' => $this->createdtime,
                );
                $this->db->where('slider_id', $slider_id)->update('slide_tbl', $slider_data);
    
                $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $slider_id)->get()->row();
                if ($logo) {
                    if ($check_image) {
                        $picture_data = array(
                            'picture' => (!empty($logo) ? $logo : $this->input->post('old_image')),
                            'picture_type' => 'sliders',
                            'status' => 1,
                            'created_date' => $this->createdtime,
                            'created_by' => $this->user_id,
                        );
                        $this->db->where('from_id', $slider_id)->update('picture_tbl', $picture_data);
                    } else {
                        $picture_data = array(
                            'from_id' => $slider_id,
                            'picture' => (!empty($logo) ? $logo : $this->input->post('old_image', true)),
                            'picture_type' => 'sliders',
                            'status' => 1,
                            'created_date' => $this->createdtime,
                            'created_by' => $this->user_id,
                        );
                        $this->db->insert('picture_tbl', $picture_data);
                    }
                }
                echo display('updated_successfully');
            } else {
                $this->load->library('Videoupload');
                $videolink = $this->videoupload->do_upload(
                       'assets/uploads/sliders/', 'background_video_url'
                );
                $background_video_url    = $videolink;

                $slider_id = "SL" . date('d') . $this->generators->generator(3);
                $slider_data = array(
                    'slider_id' => $slider_id,
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'background_video_url' => $background_video_url,
                    'short_video_url' => $short_video_url,
                    'slider_point_one' => $slider_point_one,
                    'slider_point_two' => $slider_point_two,
                    'slider_point_three' => $slider_point_three,
                    'enterprise_id' => get_enterpriseid(),
                    'updated_by' => $this->user_id,
                    'updated_date' => $this->createdtime,
                );
                $this->db->insert('slide_tbl', $slider_data);
                $logo = $this->fileupload->do_upload(
                        'assets/uploads/sliders/', 'image'
                );
                if ($logo) {
                    $picture_data = array(
                        'from_id' => $slider_id,
                        'picture' => $logo,
                        'picture_type' => 'sliders',
                        'status' => 1,
                        'created_date' => $this->createdtime,
                        'created_by' => $this->user_id,
                    );
                    $this->db->insert('picture_tbl', $picture_data);
                }
                echo display('added_successfully');
            }
    
    
        }
    //    =========== its for terms slider_form form ==============
    public function currency_form() {
        $data['title'] = display('currency');
        $this->load->view('home/currency_form', $data);
    }

    //    ============ its for phrase_save ============
    public function currency_save() {
        $currencyname = $this->input->post('currencyname', true);
        $curr_icon = $this->input->post('curr_icon', true);
        $check_currency = $this->db->select('*')->from('currency')->where('currencyname', $currencyname)->get()->row();
        if ($check_currency) {
            echo display('already_exists');
        } else {
            $currency_data = array(
                'currencyname' => $currencyname,
                'curr_icon' => $curr_icon,
            );
            $this->db->insert('currency', $currency_data);
            echo display('currency_added_successfully');
        }
    }

//    ============= its for currency_list ============
    public function currency_list() {
        $list = $this->setting_model->get_currency();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rowdata) {
            $no++;
            $row = array();

            $update = '';
            $delete = '';
            $update = '<input name="url" type="hidden" id="url_' . $rowdata->currencyid . '" value="' . base_url() . 'maintenance/maintenance/updatemaintservicefrm" />'
                    . '<a onclick="editcurrencyinfo(' . $rowdata->currencyid . ')" style="cursor:pointer;color:#fff; width:25%;" class="btn-sm btn-success mr-1"  title="Update"><i class="ti-pencil"></i></a>';

            $delete = '<a onclick="currencyinfo_delete(' . $rowdata->currencyid . ')" class="btn-sm btn-danger mr-1" style="cursor:pointer;color:#fff; width:25%;" title="Delete"><i class="ti-trash"></i></a>';


            $row[] = $no;
            $row[] = $rowdata->currencyname;
            $row[] = $rowdata->curr_icon;
            $row[] = $update . $delete;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->setting_model->count_allcurrency(),
            "recordsFiltered" => $this->setting_model->count_allfiltercurrency(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function currencyedit_form() {
        $data['title'] = display('currency_info');
        $currencyid = $this->input->post('id', TRUE);
        $data['edit_currencydata'] = $this->setting_model->edit_currencydata($currencyid);

        $this->load->view('home/currency_editform', $data);
    }

    public function update_currencyinfo() {
        $currencyid = $this->input->post('currencyid', true);
        $currencyname = $this->input->post('currencyname', true);
        $curr_icon = $this->input->post('curr_icon', true);

        $currency_data = array(
            'currencyname' => $currencyname,
            'curr_icon' => $curr_icon,
        );
        $this->db->where('currencyid', $currencyid)->update('currency', $currency_data);
        echo display('currency_update_successfully');
    }

//    =========== its for currencyinfo-delete ===========
    public function currencyinfo_delete() {
        $currencyid = $this->input->post('currencyid');
        $this->db->where('currencyid', $currencyid)->delete('currency');
        echo display('currency_deleted_successfully');
    }


    
    public function get_activitieslog() {
        $data['title'] = display('activities_log');
        

        $this->load->view('home/activitieslog', $data);
    }

    public function  get_activitieslogdatalist()    {
        $postData = $_POST;

        $search = (object) array(

        );
        // Get data
        $data = $this->getactivitieslogdatalist($postData, $search);
        echo json_encode($data);
    }

    public function total_activitieslogcount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*');
        $this->db->from('activitylog_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.created_by', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getactivitieslogdatalist($postData = null, $searchs = null)
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
                            or a.action like '%" . $searchValue . "%'
                            or b.name like '%" . $searchValue . "%'
                            or c.name like '%" . $searchValue . "%'
                            )
            ";
  
            
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_activitieslogcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*, b.name enterprise_name, c.name createdname');
        $this->db->from('activitylog_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.created_by', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        // $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {

            $i = 1;

            $data[] = array(
                "sl" => $sl++,
                "title" => $record->title,
                "action" => $record->action,
                "enterprise_name" => $record->enterprise_name,
                "created_by" => $record->createdname,
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
    
    // alamin 24/7/21
    //=======featured in datatable ============
    public function getfeaturedin(){
        $data['title'] = display('featured_in');
        // $data['company_list'] = $this->setting_model->company_list(get_enterpriseid());
        $data['total_featuredin'] = $this->total_featuredincount();
        
        $this->load->view('home/getfeaturedin', $data);
    }
    public function  get_featuredinlist()    {
        $postData = $_POST;

        $search = (object) array(

        );
        // Get data
        $data = $this->getfeaturedinlist($postData, $search);
        echo json_encode($data);
    }

    public function total_featuredincount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*, b.picture');
        $this->db->from('featuredin_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.featuredin_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.type', 2);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }
    public function getfeaturedinlist($postData = null, $searchs = null)
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
            $searchQuery = " (a.name like '%" . $searchValue . "%')
                            or a.link like '%" . $searchValue . "%'
            "; 
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_featuredincount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*, b.picture');
        $this->db->from('featuredin_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.featuredin_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.type', 2);
        if($testColumn=='sl'){
            $this->db->order_by('a.id',$columnSortOrder);
        }else{
            $this->db->order_by($testColumn,$columnSortOrder);
        }
        // $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $sl = $start + 1;
        foreach ($records as $record) {
            $editbtn = $deletebtn = $picture = '';

            $i = 1;
            $picture = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->name) . '" width="40%" class="avatar-img rounded-circle"></div>';
        // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn ='<a href="javascript:void(0)" onclick= "featuredin_edit(' . "'" . $record->featuredin_id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
       
        // // }
        // // if ($this->permission->check_label('category')->delete()->access()) {
            $deletebtn='<a href="javascript:void(0)" onclick="featuredin_delete(' . "'" . $record->featuredin_id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
        
        // // }

            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "name" => $record->name,
                "link" => $record->link,
                "ordering" => $record->ordering,
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
    //=======featured in save info ============
    public function featuredin_infosave() {
        $featuredin_id = "CM" . date('d') . $this->generators->generator(3);
        $name = $this->input->post('name', true);
        $link = $this->input->post('link', true);
        $ordering = $this->input->post('ordering', true);
        $logo = $this->fileupload->do_upload(
                'assets/uploads/features/', 'logo','gif|jpg|png|jpeg|svg'
        );
        if ($logo === false) {
            echo display('invalid_logo');
            exit();
        }

        // if ($logo !== false && $logo != null) {
        //     $this->fileupload->do_resize(
        //             $logo,154,56
        //     );
        // }

        $featuredin_data = array(
            'featuredin_id' => $featuredin_id,
            'name' => $name,
            'link' => $link,
            'ordering' => $ordering,
            'type' => 2,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );
        $this->db->insert('featuredin_tbl', $featuredin_data);
        if ($logo) {
            $picture_data = array(
                'from_id' => $featuredin_id,
                'picture' => $logo,
                'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : ''),
                'picture_type' => 'featuredin',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }
        echo display('featured_in_added_successfully');
    }
     //=======featured in edit page ============
    public function featuredin_edit(){
    $data['title'] = display('featured_in');
    $featuredin_id = $this->input->post('featuredin_id', true);
    $data['featuredin_edit'] = $this->setting_model->featuredin_edit($featuredin_id);
    $this->load->view('home/featuredin_edit', $data);
    }
    //=======featured in update info ============
    public function featuredin_infoupdate(){
        $featuredin_id = $this->input->post('featuredin_id', true);
        $name = $this->input->post('name', true);
        $link = $this->input->post('link', true);
        $ordering = $this->input->post('ordering', true);
        $old_logo = $this->input->post('old_logo', true);
        $old_featured_filename = $this->input->post('old_featured_filename', true);
        $logo = $this->fileupload->update_doupload(
                $featuredin_id, 'assets/uploads/features/', 'logo','gif|jpg|png|jpeg|svg'
        );
        if ($logo === false) {
            echo display('invalid_logo');
            exit();
        }
        // if ($logo !== false && $logo != null) {
        //     $this->fileupload->do_resize(
        //             $logo,154,56
        //     );
        // }
        $featuredin_data = array(
            'name' => $name,
            'link' => $link,
            'ordering' => $ordering,
            'type' => 2,
            'enterprise_id' => get_enterpriseid(),
            'updated_by' => $this->user_id,
            'updated_date' => $this->createdtime,
        );
     
        $this->db->where('featuredin_id', $featuredin_id)->update('featuredin_tbl', $featuredin_data);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $featuredin_id)->get()->row();
        if ($logo) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                     'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : $old_featured_filename),
                    'picture_type' => 'featuredin',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->where('from_id', $featuredin_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $featuredin_id,
                    'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                    'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : $old_featured_filename),
                    'picture_type' => 'featuredin',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }
        echo display('updated_successfully');
    }

    //    ============ its for featured_delete ==========
    public function featuredin_delete() {
        $featuredin_id = $this->input->post('featuredin_id', true);
        if ($featuredin_id) {
            $picture_unlink = $this->db->select('*')->from('picture_tbl')->where('from_id', $featuredin_id)->get()->row();
            if (!empty($picture_unlink->picture)) {
                $img_path = FCPATH . $picture_unlink->picture;
                unlink($img_path);
            }
            $this->db->where('featuredin_id', $featuredin_id)->delete('featuredin_tbl');
            $this->db->where('from_id', $featuredin_id)->delete('picture_tbl');
        }
        echo display('deleted_successfully');
    }

    // ============= its for google_login_config ================
    public function google_login_config(){
        $data['title'] = display('google_login_config');
        $enterprise_id = get_enterpriseid();
        $data['get_socialauthconfigdata'] = $this->setting_model->get_socialauthconfigdata($enterprise_id, $type = 1);

        $data['module'] = "dashboard";
        $data['page'] = "home/googlelogin_config";
        echo Modules::run('template/layout', $data);
    }

    public function google_config_update(){
        $id = $this->input->post('id', TRUE);
        $client_id = $this->input->post('client_id', TRUE);
        $secret_key = $this->input->post('secret_key', TRUE);
        $redirect_url = $this->input->post('redirect_url', TRUE);
        $config_data = array(
            'appid_clientid' => $client_id,
            'secret_key' => $secret_key,
            'redirect_url' => $redirect_url,
            'type' => 1, // 1 for google
            'enterprise_id' => get_enterpriseid(),
            'created_by' => get_enterpriseid(),
            'created_date' => $this->createdtime,
            'status' => 1
        );
        if($id){
            $this->db->where('id', $id)->update('socialauth_config_tbl', $config_data);
            echo "Configuration updated successfully!";
        }else{
            $this->db->insert('socialauth_config_tbl', $config_data);
            echo "Configuration added successfully!";
        }
    }
    // ============= its for facebook_login_config ================
    public function facebook_login_config(){
        $data['title'] = display('facebook_login_config');
        $enterprise_id = get_enterpriseid();
        $data['get_socialauthconfigdata'] = $this->setting_model->get_socialauthconfigdata($enterprise_id, $type = 2);

        $data['module'] = "dashboard";
        $data['page'] = "home/facebooklogin_config";
        echo Modules::run('template/layout', $data);
    }

    public function facebook_config_update(){
        $id = $this->input->post('id', TRUE);
        $client_id = $this->input->post('client_id', TRUE);
        $secret_key = $this->input->post('secret_key', TRUE);
        $redirect_url = $this->input->post('redirect_url', TRUE);
        $config_data = array(
            'appid_clientid' => $client_id,
            'secret_key' => $secret_key,
            'type' => 2, // 2 for facebook
            'enterprise_id' => get_enterpriseid(),
            'created_by' => get_enterpriseid(),
            'created_date' => $this->createdtime,
            'status' => 1
        );
        if($id){
            $this->db->where('id', $id)->update('socialauth_config_tbl', $config_data);
            echo "Configuration updated successfully!";
        }else{
            $this->db->insert('socialauth_config_tbl', $config_data);
            echo "Configuration added successfully!";
        }
    }
    // ============= its for vimeo_config ================
    public function vimeo_config(){
        $data['title'] = display('vimeo_config');
        $enterprise_id = get_enterpriseid();
        $data['get_socialauthconfigdata'] = $this->setting_model->get_socialauthconfigdata($enterprise_id, $type = 3);

        $data['module'] = "dashboard";
        $data['page'] = "home/vimeo_config";
        echo Modules::run('template/layout', $data);
    }

    public function vimeo_config_update(){
        $id = $this->input->post('id', TRUE);
        $client_id = $this->input->post('client_id', TRUE);
        $secret_key = $this->input->post('secret_key', TRUE);
        $access_token = $this->input->post('access_token', TRUE);
        $config_data = array(
            'appid_clientid' => $client_id,
            'secret_key' => $secret_key,
            'access_token' => $access_token,
            'type' => 3, // 3 for vimeo
            'enterprise_id' => get_enterpriseid(),
            'created_by' => get_enterpriseid(),
            'created_date' => $this->createdtime,
            'status' => 1
        );
        if($id){
            $this->db->where('id', $id)->update('socialauth_config_tbl', $config_data);
            echo "Configuration updated successfully!";
        }else{
            $this->db->insert('socialauth_config_tbl', $config_data);
            echo "Configuration added successfully!";
        }
    }

    public function home_page_setting($url = null) {
        $data['title'] = display('home_page_setting');

        $data['module'] = "dashboard";
        $data['page'] = "home/home_page_setting";
        echo Modules::run('template/layout', $data);
    }
    
//    ============== its for ourfeatures_save =============
    public function ourfeatures_save() {
        $featuredin_id = "OF" . date('d') . $this->generators->generator(3);
        $name = $this->input->post('title', true);
        $link = $this->input->post('link', true);
        $summary = $this->input->post('summary', true);
        $ordering = $this->input->post('ordering', true);
        $logo = $this->fileupload->do_upload(
                'assets/uploads/features/', 'image','gif|jpg|png|jpeg|webp|svg'
        );
        if ($logo === false) {
            echo display('invalid_logo');
            exit();
        }
           // if image is uploaded then resize the $image
           if ($logo !== false && $logo != null) {
            $this->fileupload->do_resize(
                    $logo, 59, 59
            );
        }
        // if ($logo !== false && $logo != null) {
        //     $this->fileupload->do_resize(
        //             $logo,196,50
        //     );
        // }
        $featuresdata = array(
            'featuredin_id' => $featuredin_id,
            'name' => $name,
            'link' => $link,
            'summary' => $summary,
            'ordering' => $ordering,
            'type' => 1,
            'enterprise_id' => get_enterpriseid(),
            'created_by' => $this->user_id,
            'created_date' => $this->createdtime,
        );

        $this->db->insert('featuredin_tbl', $featuresdata);
        if ($logo) {
            $picture_data = array(
                'from_id' => $featuredin_id,
                'picture' => $logo,
                'filename' => (!empty($_FILES['image']['name']) ? $_FILES['image']['name'] : ''),
                'picture_type' => 'our features',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }
        echo display('added_successfully');
    }

    public function  get_ourfeaturelist() {
        $postData = $_POST;

        $search = (object) array(

        );
        // Get data
        $data = $this->getourfeaturelist($postData, $search);
        echo json_encode($data);
    }

    public function total_ourfeaturecount($search = null, $searchQuery = null)
    {
        $this->db->select('a.*, b.picture');
        $this->db->from('featuredin_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.featuredin_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.type', 1);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }
    public function getourfeaturelist($postData = null, $searchs = null)
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
                            or a.summary like '%" . $searchValue . "%')
            "; 
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_ourfeaturecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;

        $this->db->select('a.*, b.picture');
        $this->db->from('featuredin_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.featuredin_id', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('a.type', 1);
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
            $picture = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->picture)) ? html_escape($record->picture) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->name) . '" width="40%" class="avatar-img rounded-circle"></div>';
        // if ($this->permission->check_label('category')->update()->access())  {
            $editbtn ='<a href="javascript:void(0)" onclick= "ourfeature_edit(' . "'" . $record->featuredin_id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
       
        // // }
        // // if ($this->permission->check_label('category')->delete()->access()) {
            $deletebtn='<a href="javascript:void(0)" onclick="ourfeature_delete(' . "'" . $record->featuredin_id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
        
        // // }

            $action =  $editbtn . ' ' . $deletebtn;


            $data[] = array(
                "sl" => $sl++,
                "name" => $record->name,
                "link" => $record->link,
                "summary" => $record->summary,
                "ordering" => $record->ordering,
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
    

     //======= our feature in edit page ============
     public function ourfeature_edit(){
        $data['title'] = display('our_features');
        $featuredin_id = $this->input->post('featuredin_id', true);
        $data['featuredin_edit'] = $this->setting_model->featuredin_edit($featuredin_id);
        // dd($data['featuredin_edit']);
        $this->load->view('home/ourfeature_edit', $data);
        }
        //=======our featured in update info ============
        public function ourfeature_infoupdate(){
            $featuredin_id = $this->input->post('featuredin_id', true);
            $name = $this->input->post('name', true);
            $link = $this->input->post('link', true);
            $summary = $this->input->post('summary', true);
            $ordering = $this->input->post('ordering', true);
            $old_logo = $this->input->post('old_logo', true);
            $old_ourfeature_filename = $this->input->post('old_ourfeature_filename', true);
            $logo = $this->fileupload->update_doupload(
                    $featuredin_id, 'assets/uploads/features/', 'logo','gif|jpg|png|jpeg|webp|svg'
            );
            
            if ($logo === false) {
                echo display('invalid_logo');
                exit();
            }
             // if image is uploaded then resize the $image
             if ($logo !== false && $logo != null) {
                $this->fileupload->do_resize(
                        $logo, 59, 59
                );
            }
            $featuredin_data = array(
                'name' => $name,
                'link' => $link,
                'summary' => $summary,
                'ordering' => $ordering,
                'type' => 1,
                'enterprise_id' => get_enterpriseid(),
                'updated_by' => $this->user_id,
                'updated_date' => $this->createdtime,
            );
         
            $this->db->where('featuredin_id', $featuredin_id)->update('featuredin_tbl', $featuredin_data);
            $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $featuredin_id)->get()->row();
            if ($logo) {
                
                if ($check_image) {
                    $picture_data = array(
                        'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                        'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : $old_ourfeature_filename),
                        'picture_type' => 'our features',
                        'status' => 1,
                        'created_date' => $this->createdtime,
                        'created_by' => $this->user_id,
                    );
                    $this->db->where('from_id', $featuredin_id)->update('picture_tbl', $picture_data);
                } else {
                    $picture_data = array(
                        'from_id' => $featuredin_id,
                        'picture' => (!empty($logo) ? $logo : $this->input->post('old_logo', true)),
                        'filename' => (!empty($_FILES['logo']['name']) ? $_FILES['logo']['name'] : $old_ourfeature_filename),
                        'picture_type' => 'our features',
                        'status' => 1,
                        'created_date' => $this->createdtime,
                        'created_by' => $this->user_id,
                    );
                    $this->db->insert('picture_tbl', $picture_data);
                }
            }
            echo display('updated_successfully');
        }
    
          //    ============ its for ourfeature_delete ==========
    public function ourfeature_delete() {
        $featuredin_id = $this->input->post('featuredin_id', true);
        if ($featuredin_id) {
            $picture_unlink = $this->db->select('*')->from('picture_tbl')->where('from_id', $featuredin_id)->get()->row();
            if (!empty($picture_unlink->picture)) {
                $img_path = FCPATH . $picture_unlink->picture;
                unlink($img_path);
            }
            $this->db->where('featuredin_id', $featuredin_id)->delete('featuredin_tbl');
            $this->db->where('from_id', $featuredin_id)->delete('picture_tbl');
        }
        echo display('deleted_successfully');
    }
    
 //    =========== its for website settingform ==============
 public function website_settingform() {
    $data['title'] = display('website_settngs');
    $data['setting'] = $this->setting_model->read(get_enterpriseid());

    $this->load->view('home/website_settingform', $data);
}
 


// ============ its for website_settingupate ==============
public function website_settingupate(){
      //backend logo upload
      $anyquestion_picture = $this->fileupload->do_upload(
        'assets/uploads/settings/', 'anyquestion_picture','gif|jpg|png|jpeg|ico|svg'
        );

 // if logo is uploaded then resize the logo
 if ($anyquestion_picture !== false && $anyquestion_picture != null) {
    $this->fileupload->do_resize(
            $anyquestion_picture, 339, 366
    );
}

//website footer logo one upload
$footer_logo = $this->fileupload->do_upload(
    'assets/uploads/settings/', 'footer_logo','gif|jpg|png|jpeg|ico|svg'
);

 // if logo is uploaded then resize the logo
 if ($footer_logo !== false && $footer_logo != null) {
        $this->fileupload->do_resize(
                $footer_logo, 159, 67
        );
}


//website signin picture one upload
$signin_picture = $this->fileupload->do_upload(
    'assets/uploads/settings/', 'signin_picture','gif|jpg|png|jpeg|ico|svg'
);

// if signin_picture is uploaded then resize the logo
if ($signin_picture !== false && $signin_picture != null) {
    $this->fileupload->do_resize(
            $signin_picture, 344, 404
    );
}
//website signup picture one upload
$signup_picture = $this->fileupload->do_upload(
    'assets/uploads/settings/', 'signup_picture','gif|jpg|png|jpeg|ico|svg'
);

// if signup picture is uploaded then resize the logo
if ($signup_picture !== false && $signup_picture != null) {
    $this->fileupload->do_resize(
            $signup_picture, 344, 404
    );
}


$data['setting'] = (object) $postData = [
    'id'                   => $this->input->post('id', true),
    'subscription_savetitle' => $this->input->post('subscription_savetitle', true),
    'anyquestion_title'    => $this->input->post('anyquestion_title', true),
    'footer_about'         => $this->input->post('footer_about', TRUE),
    'footer_text'          => $this->input->post('footer_text', TRUE),
    'facebook_link'        => $this->input->post('facebook_link', TRUE),
    'twitter_link'         => $this->input->post('twitter_link', TRUE),
    'youtube_link'         => $this->input->post('youtube_link', TRUE),
    'instagram_link'       => $this->input->post('instagram_link', TRUE),

    'footer_logo'          => (!empty($footer_logo) ? $footer_logo : $this->input->post('old_footer_logo', true)),
    'anyquestion_picture'  => (!empty($anyquestion_picture) ? $anyquestion_picture : $this->input->post('old_anyquestion_picture', true)),
    'signin_picture'       => (!empty($signin_picture) ? $signin_picture : $this->input->post('old_signin_picture', true)),
    'signup_picture'       => (!empty($signup_picture) ? $signup_picture : $this->input->post('old_signup_picture', true)),
    'enterprise_id'        => get_enterpriseid()
];

 #if empty $id then insert data
 if (empty($postData['id'])) {
    if ($this->setting_model->create($postData)) {
        #set success message
        echo display('save_successfully');
    } else {
        #set exception message
        echo display('please_try_again');
    }
} else { 
    if ($this->setting_model->update($postData)) {
        #set success message
         echo display('update_successfully');
    } else {
        #set exception message
        echo display('please_try_again');
    }
}
return true;
}
   
 //    =========== its for strength_number ==============
 public function strength_number() {
    $data['title'] = display('strength_number');
    $data['setting'] = $this->setting_model->read(get_enterpriseid());

    $this->load->view('home/strength_number', $data);
}

// ============ its for strengthnumber_upate ==============
public function strengthnumber_upate(){

$data['setting'] = (object) $postData = [
  'id'                      => $this->input->post('id', true),
  'learner_count'           => $this->input->post('learner_count', true),
  'total_course'            => $this->input->post('total_course', true),
  'language_count'          => $this->input->post('language_count', true),
  'successfully_students'   => $this->input->post('successfully_students', true),
  'enterprise_id'           => get_enterpriseid()
];

#if empty $id then insert data
if (empty($postData['id'])) {
  if ($this->setting_model->create($postData)) {
      #set success message
      echo display('save_successfully');
  } else {
      #set exception message
      echo display('please_try_again');
  }
} else { 
  if ($this->setting_model->update($postData)) {
      #set success message
       echo display('update_successfully');
  } else {
      #set exception message
      echo display('please_try_again');
  }
}
return true;
}

public function need_consultation(){
  
    
    $this->load->view('home/consultation_list');
}

public function  get_consultationlist()    {
    $postData = $_POST;

    $search = (object) array(

    );
    // Get data
    $data = $this->getconsultationlist($postData, $search);
    echo json_encode($data);
}

public function total_consultationcount($search = null, $searchQuery = null)
{
    $this->db->select('a.*');
    $this->db->from('contactus_tbl a');
    if ($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->where('a.enterprise_id', get_enterpriseid());
    $this->db->order_by('a.id', 'desc');
    $query = $this->db->get();
    $record = $query->num_rows();
    return $record;
}

public function getconsultationlist($postData = null, $searchs = null)
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
        $searchQuery = " (a.name like '%" . $searchValue . "%')
        ";

        
    }
    ## Total number of records without filtering
    $totalRecords = $this->total_consultationcount($searchs, $searchQuery);
    ## Total number of record with filtering
    $totalRecordwithFilter = $totalRecords;

    $this->db->select('a.*');
    $this->db->from('contactus_tbl a');
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
        $editbtn = $deletebtn = '';

        // if ($record->is_receive == 1) {
        //     $is_reveive = display('yes');
        // } else {
        //     $is_reveive = display('no');
        // }
        $i = 1;
       
        $action =  $editbtn . ' ' . $deletebtn;


        $data[] = array(
            "sl" => $sl++,
            "name" => $record->name,
            "mobile" => $record->mobile,
            "email" => $record->email,
            "whoami" => $record->whoami,
            "organization" => $record->organization,
            "preffered_date" => $record->preffered_date,
            "message" => $record->message,
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


  //=======paywith in datatable ============
  public function paywith(){
    $data['title'] = display('paywith');
    $data['total_paywith'] = $this->total_paywithcount();
    
    $this->load->view('home/paywith', $data);
}
public function  get_paywithlist()    {
    $postData = $_POST;

    $search = (object) array(

    );
    // Get data
    $data = $this->getpaywithlist($postData, $search);
    echo json_encode($data);
}

public function total_paywithcount($search = null, $searchQuery = null)
{
    $this->db->select('a.*');
    $this->db->from('paywith_tbl a');
    if ($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->where('a.enterprise_id', get_enterpriseid());
    $this->db->order_by('a.id', 'desc');
    $query = $this->db->get();
    $record = $query->num_rows();
    return $record;
}
public function getpaywithlist($postData = null, $searchs = null)
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
        $searchQuery = " (a.logo like '%" . $searchValue . "%'
        )
        "; 
    }
    ## Total number of records without filtering
    $totalRecords = $this->total_paywithcount($searchs, $searchQuery);
    ## Total number of record with filtering
    $totalRecordwithFilter = $totalRecords;

    $this->db->select('a.*');
    $this->db->from('paywith_tbl a');
    if ($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->where('a.enterprise_id', get_enterpriseid());
    if($testColumn=='sl'){
        $this->db->order_by('a.id',$columnSortOrder);
    }else{
        $this->db->order_by($testColumn,$columnSortOrder);
    }
    // $this->db->order_by('a.id', 'desc');
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get()->result();
    // echo $this->db->last_query();
    $data = array();

    $sl = $start + 1;
    foreach ($records as $record) {
        $editbtn = $deletebtn = $logo = '';

        $i = 1;
        $logo = '<div class="avatar avatar-xs"><img src="' . base_url(!empty(html_escape($record->logo)) ? html_escape($record->logo) : 'assets/img/icons/default.png') . '" alt="' . html_escape($record->logo) . '" width="40%" class="avatar-img rounded-circle"></div>';
    // if ($this->permission->check_label('category')->update()->access())  {
        $editbtn ='<a href="javascript:void(0)" onclick= "paywith_edit(' . "'" . $record->id . "'" . ')" class="btn btn-sm btn-success btn-sm mr-1 custom_btn active-inactive-cls" data-toggle="tooltip" data-placement="left" title="Edit"><i class="ti-pencil"></i></a>';
   
    // // }
    // // if ($this->permission->check_label('category')->delete()->access()) {
        $deletebtn='<a href="javascript:void(0)" onclick="paywith_delete(' . "'" . $record->id . "'" . ')" title="' . display('delete') . '"  class="btn btn-sm btn-danger btn-sm mr-1 active-inactive-cls"><i class="ti-trash"></i></a>';
    
    // // }

        $action =  $editbtn . ' ' . $deletebtn;


        $data[] = array(
            "sl" => $sl++,
            "logo" => $logo,
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
// //=======paywith in save info ============
public function paywith_infosave() {
    // $logo = $this->fileupload->do_upload(
    //         'assets/uploads/paywith/', 'logo','gif|jpg|png|jpeg|svg|webp'
    // );
    $logo = $this->fileupload->do_resumeupload(
            'assets/uploads/paywith/', 'logo','gif|jpg|png|jpeg|svg|webp'
    );
    if ($logo === false) {
        echo display('invalid_logo');
        exit();
    }

    if ($logo !== false && $logo != null) {
        $this->fileupload->do_resize(
                $logo,40,40
        );
    }

    $paywith_data = array(
        'logo' => $logo,
        'status' => 1,
        'enterprise_id' => get_enterpriseid(),
        'created_by' => $this->user_id,
        'created_date' => $this->createdtime,
    );
    $this->db->insert('paywith_tbl', $paywith_data);
   
    echo display('added_successfully');
}
//  //=======paywith in edit page ============
public function paywith_edit(){
$data['title'] = display('paywith');
$id = $this->input->post('id', true);
$data['paywith_edit'] = $this->setting_model->paywith_edit($id);
$this->load->view('home/paywith_edit', $data);
}
//=======paywith in update info ============
public function paywith_infoupdate(){
    $id = $this->input->post('id', true);
    $old_logo = $this->input->post('old_logo', true);
    // $logo = $this->fileupload->update_doupload(
    //         $id, 'assets/uploads/paywith/', 'logo','gif|jpg|png|jpeg|svg|webp'
    // );
    $logo = $this->fileupload->update_resumeupload(
            $id, 'assets/uploads/paywith/', 'logo','gif|jpg|png|jpeg|svg|webp'
    );
    if ($logo === false) {
        echo display('invalid_logo');
        exit();
    }
    if ($logo !== false && $logo != null) {
        $this->fileupload->do_resize(
                $logo,40,40
        );
    }
    $paywith_data = array(
        'logo' => (!empty($logo) ? $logo : $old_logo),
        'status' => 1,
        'enterprise_id' => get_enterpriseid(),
        'created_by' => $this->user_id,
        'created_date' => $this->createdtime,
    );
 
    $this->db->where('id', $id)->update('paywith_tbl', $paywith_data);
    echo display('updated_successfully');
}

//    ============ its for paywith_delete ==========
public function paywith_delete() {
    $id = $this->input->post('id', true);
    if ($id) {
        $picture_unlink = $this->db->select('*')->from('paywith_tbl')->where('id', $id)->get()->row();
        if (!empty($picture_unlink->logo)) {
            $img_path = FCPATH . $picture_unlink->logo;
            unlink($img_path);
        }
        $this->db->where('id', $id)->delete('paywith_tbl');
    }
    echo display('deleted_successfully');
}

}