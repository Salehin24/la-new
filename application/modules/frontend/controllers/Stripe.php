<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stripe extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('stripe_model');
        if (!$this->session->userdata('session_id'))
            redirect();
    }

    public function gotoStripe() {

        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
        $order_id = $this->session->userdata('invoice_id');


        $data['gateway'] = $this->stripe_model->get_configdata();

        $this->load->view('frontend/themes/stripe/stripe', $data);
    }

    public function stripepayment() {
        // Include Stripe PHP library 
        require_once('application/modules/frontend/libraries/stripe-php/init.php');

        $data['gateway'] = $this->stripe_model->get_configdata();
        $orderid = $this->session->userdata('invoice_id');
        $amount = $this->session->userdata('total_amount');
        $currency = $data['gateway']->currency;
        $customer_id = $this->session->userdata('log_id');
        $customer_email = $this->session->userdata('email');

        $data['orderid'] = $orderid;

        $marchant_id = $data['gateway']->marchant_id;
        $data['orderinfo'] = $this->db->select('*')->from('invoice_tbl')->where('invoice_id', $orderid)->get()->result();
        $data['customerinfo'] = $this->db->select('*')->from('students_tbl')->where('student_id', $customer_id)->get()->row();

        // Check whether stripe token is not empty 
        if (!empty($_POST['stripeToken'])) {

            // Retrieve stripe token, card and user info from the submitted form data 
            $token = $_POST['stripeToken'];
            $name = $_POST['cardName'];
            $email = $customer_email;
            $card_number = $_POST['cardNumber'];
            $card_exp_month = $_POST['card_exp_month'];
            $card_exp_year = $_POST['card_exp_year'];
            $card_cvc = $_POST['card_cvc'];

            // Include Stripe PHP library 
            // Set API key 
            \Stripe\Stripe::setApiKey($marchant_id);

            // Add customer to stripe 
            $stripe_customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'source' => $token
            ));
            // Unique order ID 
            // Convert price to cents 
            // Charge a credit or a debit card 
            $charge = \Stripe\Charge::create(array(
                        'customer' => $stripe_customer->id,
                        'amount' => $amount,
                        'currency' => $currency,
                        'description' => '',
                        'metadata' => array(
                            'order_id' => $orderid
                        )
            ));

            // Retrieve charge details 
            $chargeJson = $charge->jsonSerialize();
            // Check whether the charge is successful 
            if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
                // Order details  
                $transactionID = $chargeJson['balance_transaction'];
                $paidAmount = $chargeJson['amount'];
                $paidCurrency = $chargeJson['currency'];
                $payment_status = $chargeJson['status'];

                // Include database connection file  
//                include_once 'dbConnect.php';
                // Insert tansaction data into the database 
                $cardInfo_data = array(
                    'invoice_id' => $orderid,
                    'customer_id' => $customer_id,
                    'card_number' => $card_number,
                    'ex_month' => $card_exp_month,
                    'ex_year' => $card_exp_year,
                    'order_amount' => $amount,
                    'order_currency' => $currency,
                    'paid_amount' => $paidAmount,
                    'paid_currency' => $paidCurrency,
                    'balance_trxID' => $transactionID,
                    'payment_status' => $payment_status,
                );
                $this->db->insert('cardinfo_tbl', $cardInfo_data);
                // If the order is successful 

                if ($payment_status == 'succeeded') {
                    $ordStatus = 'success';
                    redirect('frontend/stripe/payment_success/');
                } else {
                    $statusMsg = "Your Payment has Failed!";
                }
            } else {
                $statusMsg = "Transaction has been failed!";
            }
        }

        $this->session->set_flashdata('success', 'Payment not successfully.');

        redirect('frontend/stripe/payment_success/' . $orderid);
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

}
