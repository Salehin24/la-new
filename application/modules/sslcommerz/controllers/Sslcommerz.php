<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sslcommerz extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        
        
        $this->user_id = $this->session->userdata('user_id');
        $this->sessionid = $this->session->userdata('session_id');
        $this->segmentone = $this->uri->segment(1);
        $this->segmenttwo = $this->uri->segment(2);
        $enterprise_id = $this->session->userdata('enterprise_id');
        $enterpriseid = (!empty($enterprise_id) ? $enterprise_id : '1');
        $this->enterprise_info = get_enterpriseinfo($enterpriseid);
        $this->session->userdata('session_id');
        $this->enterprise_shortname = (!empty($this->enterprise_info->shortname) ? $this->enterprise_info->shortname : 'admin');
        
        $this->load->model('sslcommerz_model');

        // $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        date_default_timezone_set("Asia/Dhaka");
    
    }

    public function index() {
        if (!$this->session->userdata('session_id')) {
            redirect('login');
        }
        $data['title'] = display('sslcommerz_configuration');
        $data['get_configdata'] = $this->sslcommerz_model->get_configdata();

        $data['module'] = "sslcommerz";
        $data['page'] = "index";
        echo modules::run('template/layout', $data);
    }

    public function gotosslcommerz() {
        return $this->sslcommerz_model->payment_by_sslcommerz();
    }

    public function sslcommerz_payment_success($id) {
        $inId=base64_decode($id);
        $orderinfo=$this->db->select('*')->from('invoice_tbl')->where('invoice_id',$inId)->get()->row();
        $customer_id = $orderinfo->customer_id;

        $this->load->model('dashboard/auth_model');
                 $this->auth_model->checkUserpaylogin($customer_id);
        if(empty($this->session->userdata('user_id'))){

       }
     //$this->session->userdata('user_id');
      //exit;
        //Order entry
        $order_id = $inId;
        
        $amount = $orderinfo->total_amount;
//        echo "Success order id" . $order_id . " cust id " . $customer_id;
        $invoice_info = array(
            'status' => 1,
            'paid_amount' => $amount,
        );
        $this->db->where('invoice_id', $order_id)->update('invoice_tbl', $invoice_info);

        $invoiceDetails_info = array(
            'status' => 1,
        );
        $this->db->where('invoice_id', $order_id)->update('invoice_details', $invoiceDetails_info);
        $instructor_ledger_data=array(
            'status	'         => 1,
         );
         $this->db->where('transaction_id', $order_id)->update('instructor_ledger_tbl',$instructor_ledger_data);

         
         $academy_ledger_data=array(
            'status'             =>1,
         );
         $this->db->where('transaction_id', $order_id)->update('academic_ledger_tbl',$academy_ledger_data);

        $invoice_type= $this->db->select("a.*,b.*")
                            ->from("invoice_details a")
                            ->join('course_tbl b','b.course_id=a.product_id')
                            ->where('invoice_id', $order_id)
                            ->get()
                            ->result();
        // $invoice_type= $this->db->select("*")->from("invoice_details")->where('invoice_id', $order_id)->get()->row();
    
       foreach($invoice_type as $inv){
        if($inv->is_subscription==1){
        $data_nofi=array(
            'notification_id'=>$inv->product_id,
            'student_id'=> $customer_id,
            'notification_type'=>8,
            'created_date'=>date('Y-m-d H:i:s'),
            'isNotify'=>1,
            'message' =>" has subscribed successfully",
            'enterprise_id'=>$inv->enterprise_id,
        );
        $this->db->insert('notifications_tbl', $data_nofi);
        }elseif($inv->is_subscription==0){
            $data_nofi=array(
                'notification_id'=>$inv->product_id,
                'student_id'=> $customer_id,
                'notification_type'=>8,
                'created_date'=>date('Y-m-d H:i:s'),
                'isNotify'=>1,
                'message' =>" has purchase successfully",
                'enterprise_id'=>$inv->enterprise_id,
            );
            $this->db->insert('notifications_tbl', $data_nofi);  
        }
    }



        $this->cart->destroy();
        $this->session->set_userdata('popup', '1');
        redirect($this->enterprise_shortname.'/student-dashboard');
       
        // exit;
        // redirect($this->enterprise_shortname);
    }

    public function sslcommerz_payment_cancel() {
        $customer_id=$_POST['value_c'];
        // print_r($_POST);
        $this->load->model('dashboard/auth_model');
        $this->auth_model->checkUserpaylogin($customer_id);
        //$this->cart->destroy();
        $this->session->set_userdata('popup', '0');
        redirect(base_url());
    }

    public function sslcommerz_payment_failed() {
        $customer_id=$_POST['value_c'];
        // print_r($_POST);
        $this->load->model('dashboard/auth_model');
        $this->auth_model->checkUserpaylogin($customer_id);
        $this->session->set_userdata('popup', '3');
        redirect(base_url());
    }

}
