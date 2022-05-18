<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paypal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
    }

    public function buy($customer_id, $order_id, $total_price) {

        $customer_id = $customer_id;
        $order_id = $order_id;
        $quantity = 1;
        $price = $total_price;

        $discount = 0;
        $item_name = "Order :: Test";
        // ---------------------
        //Set variables for paypal form
        $returnURL = base_url("Paypal/success/$order_id/$customer_id"); //payment success url
        $cancelURL = base_url("Paypal/cancel/$order_id/$customer_id"); //payment cancel url
        $notifyURL = base_url('Paypal/ipn'); //ipn url
        //set session token
        $this->session->unset_userdata('_tran_token');
        $this->session->set_userdata(array('_tran_token' => $order_id));
        // set form auto fill data
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);

        // item information
        $this->paypal_lib->add_field('item_number', $order_id);
        $this->paypal_lib->add_field('item_name', $item_name);
        $this->paypal_lib->add_field('amount', $price);
        $this->paypal_lib->add_field('quantity', $quantity);
        $this->paypal_lib->add_field('discount_amount', $discount);

        // additional information 
        $this->paypal_lib->add_field('custom', $order_id);
        $this->paypal_lib->image('');
        // generates auto form
        $this->paypal_lib->paypal_auto_form();
//        }
    }

    public function success($order_id = null, $customer_id = null) {
        $data['title'] = "Order Title";
        #--------------------------------------

        $datas['customer_info'] = $this->db->select('a.username, b.user_id, b.first_name, b.last_name')
                        ->from('user_login a')
                        ->join('users b', 'b.user_id = a.user_id')
                        ->where('a.user_id', $customer_id)->get()->row();

        $email = $datas['customer_info']->username;
        $this->load->library('pdfgenerator');
        $id = $order_id;
        $name = $datas['customer_info']->first_name . " " . (!empty($datas['customer_info']->last_name) ? $datas['customer_info']->last_name : '');

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Payment successfully done!</div>");
        redirect('Cinvoice/manage_invoice');
    }

    public function cancel($order_id = null, $customer_id = null) {
        #---------------Clean Database------------
        #----------------------------------------

        $data['title'] = "Order";
    }

    /*
     * Add this ipn url to your paypal account
     * Profile and Settings > My selling tools > 
     * Instant Payment Notification (IPN) > update 
     * Notification URL: (eg:- http://domain.com/website/paypal/ipn/)
     * Receive IPN messages (Enabled) 
     */

    public function ipn() {

        //paypal return transaction details array
        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

        //check whether the payment is verified
        if (preg_match("/VERIFIED/i", $result)) {
            //insert the transaction data into the database
            $this->load->model('Paypal_model');
            $this->Paypal_model->insertTransaction($data);
        }
    }

    //Send Customer Email with invoice
    public function setmail($email, $file_path, $id = null, $name = null) {
        $mail_config_detail = $this->db->select('*')->from('mail_config_tbl')->get()->row();

        $subject = 'ticket Information';
        $message = "Congratulation Mr. " . ' ' . $name . "Your Purchase Order No-  " . '-' . $id;

        $config = Array(
            'protocol' => $mail_config_detail->protocol,
            'smtp_host' => $mail_config_detail->smtp_host,
            'smtp_port' => $mail_config_detail->smtp_port,
            'smtp_user' => $mail_config_detail->smtp_user,
            'smtp_pass' => $mail_config_detail->smtp_pass,
            'mailtype' => $mail_config_detail->mailtype,
            'charset' => 'utf-8',
            'smtp_crypto'=>'tls',
        );


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($mail_config_detail->smtp_user);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($file_path);

        $check_email = $this->test_input($email);

        if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {

            if ($this->email->send()) {
                $this->session->set_flashdata(array('message' => "Email Sent Sucessfully"));
                return true;
            } else {
                $this->session->set_flashdata(array('exception' => "Please configure your mail."));
                return false;
            }
        } else {
            $this->session->set_userdata(array('message' => "Your Data Successfully Saved"));
            redirect("b-single-order-test");
        }
    }

    //Email testing for email
    public function test_input($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
