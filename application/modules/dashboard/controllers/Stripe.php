<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
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

    public function index() {
        if (!$this->session->userdata('session_id')) {
            redirect('login');
        }
        $data['title'] = display('stripe_configuration');
        $data['get_configdata'] = $this->stripe_model->get_configdata();

        $data['module'] = "stripe";
        $data['page'] = "index";
        echo modules::run('template/layout', $data);
    }

//    ============ its for sslcommerz configuration info save ===========
    public function config_save() {
        $id = $this->input->post('id');
        $payment_method_name = $this->input->post('payment_method_name');
        $marchant_id = $this->input->post('marchant_id');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $currency = $this->input->post('currency');
        $is_live = $this->input->post('is_live');
        $status = $this->input->post('status');
        $check_configdata = $this->stripe_model->get_configdata();
        if ($check_configdata) {
            $config_data = array(
                'payment_method_name' => $payment_method_name,
                'marchant_id' => $marchant_id,
                'password' => $password,
                'email' => $email,
                'currency' => $currency,
                'is_live' => $is_live,
                'status' => $status,
            );
            $this->db->where('id', $id)->update('stripe_config', $config_data);
            $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Updated successfully!</div>");
        } else {
            $config_data = array(
                'id' => 1,
                'payment_method_name' => $payment_method_name,
                'marchant_id' => $marchant_id,
                'password' => $password,
                'email' => $email,
                'currency' => $currency,
                'is_live' => $is_live,
                'status' => $status,
            );
            $this->db->insert('stripe_config', $config_data);
            $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Inserted successfully!</div>");
        }
        redirect('stripe/stripe/index');
    }

    public function gotoStripe() {
//        require_once('application/modules/stripe/libraries/stripe-php/init.php');

        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
        $order_id = $this->session->userdata('invoice_id');


        $data['gateway'] = $this->stripe_model->get_configdata();

        $this->load->view('stripe', $data);
    }

    public function stripePayment() {
        // Include Stripe PHP library 
        require_once('application/modules/stripe/libraries/stripe-php/init.php');

        $data['gateway'] = $this->stripe_model->get_configdata();
        $orderid = $this->session->userdata('invoice_id');
        $amount = $this->session->userdata('total_amount');
        $currency = $data['gateway']->currency;
        $customer_id = $this->session->userdata('log_id');
        $customer_email = $this->session->userdata('email');
//        echo $orderid." ". $amount. " ". $currency;die();
        $data['orderid'] = $orderid;

        $marchant_id = $data['gateway']->marchant_id;
        $data['orderinfo'] = $this->db->select('*')->from('invoice_tbl')->where('invoice_id', $orderid)->get()->result();
        $data['customerinfo'] = $this->db->select('*')->from('students_tbl')->where('student_id', 'ST11GC326A')->get()->row();

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
//            require_once 'stripe-php/init.php';
            // Set API key 
            \Stripe\Stripe::setApiKey($marchant_id);

            // Add customer to stripe 
            $stripe_customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'source' => $token
            ));
            // Unique order ID 
//            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            // Convert price to cents 
//            $itemPrice = ($amount * 100);
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
//            dd($chargeJson);
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
//                $payment_id = $this->db->insert_id();;
                // If the order is successful 
                if ($payment_status == 'succeeded') {
                    $ordStatus = 'success';
//                    $statusMsg = 'Your Payment has been Successful!';
                    redirect('stripe/stripe/payment_success/');
                } else {
                    $statusMsg = "Your Payment has Failed!";
                }
            } else {
                $statusMsg = "Transaction has been failed!";
            }
        }
//        ============ news start===========        
////        \Stripe\Stripe::setApiKey($paymentinfo->marchantid);
//        \Stripe\Stripe::setApiKey($marchant_id);
//
//        $charge = \Stripe\Charge::create([
//                    "amount" => $amount,
//                    "currency" => $currency,
//                    "source" => $this->input->post('stripeToken'),
//                    "description" => "Test payment from itsolutionstuff.com."
//        ]);
//        dd($charge);
        $this->session->set_flashdata('success', 'Payment made successfully.');

        redirect('stripe/stripe/payment_success/' . $orderid);
    }

    public function payment_success() {
        //Order entry
        $order_id = $this->session->userdata('invoice_id');
        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
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

        $this->cart->destroy();
        $this->session->set_userdata('popup', '1');
        redirect('student-dashboard');
    }

}
