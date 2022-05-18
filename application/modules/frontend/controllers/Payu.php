<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payu extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('payu_model');
        if (!$this->session->userdata('session_id'))
            redirect();
    }

//    ========== its for payU money payment gateway integration ===========
    public function gotoPayu() {
        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
        $order_id = $this->session->userdata('invoice_id');
        $gateway = $this->payu_model->get_configdata();

        $amount = $amount;
        $product_info = 'Education';
        $customer_name = $this->session->userdata('name');
        $customer_emial = $this->session->userdata('email');
        $customer_mobile = $this->session->userdata('mobile');
        $customer_address = $this->session->userdata('address');
        //payumoney details

        $MERCHANT_KEY = $gateway->marchant_id; //change  merchant with yours
        $SALT = $gateway->password;  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        //optional udf values 
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;

        $hash = strtolower(hash('sha512', $hashstring));
        $this->session->unset_userdata('_tran_token');
        $this->session->set_userdata(array('_tran_token' => $order_id));
        $success = base_url("frontend/payu/payment_success/$order_id/$customer_id");
        $fail = base_url("frontend/payu/payment_failed");
        $cancel = base_url("frontend/payu/payment_cancel");

        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => (($gateway->is_live == 0) ? 'https://test.payu.in/_payment' : 'https://secure.payu.in/_payment'), //for test or live change 
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel
        );
        $this->load->view('frontend/themes/payu/payUpayment', $data);
    }

    public function payment_success() {
        //Order entry
        $order_id = $this->session->userdata('invoice_id');
        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
        $invoice_info = array(
            'status' => 1,
        );
        $this->db->where('invoice_id', $order_id)->update('invoice_tbl', $invoice_info);

        $invoiceDetails_info = array(
            'status' => 1,
        );
        $this->db->where('invoice_id', $order_id)->update('invoice_details', $invoiceDetails_info);

        $this->cart->destroy();
        $this->session->set_userdata('popup', '1');
        redirect('student-dashboard');
    }

//
    public function payment_cancel() {
        $order_id = $this->session->userdata('order_id');
        $customer_id = $this->session->userdata('customer_id');

        $this->session->set_userdata('popup', '0');
        redirect(base_url());
    }

    public function payment_failed() {
        $order_id = $this->session->userdata('order_id');
        $customer_id = $this->session->userdata('customer_id');

        $this->session->set_userdata('popup', '3');
        redirect(base_url());
    }

}
