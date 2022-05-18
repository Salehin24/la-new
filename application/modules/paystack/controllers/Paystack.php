<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paystack extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('paystack_model');
        if (!$this->session->userdata('session_id'))
            redirect();
    }

    public function index() {
        if (!$this->session->userdata('session_id')) {
            redirect('login');
        }
        $data['title'] = display('paystack_configuration');
        $data['get_configdata'] = $this->paystack_model->get_configdata();

        $data['module'] = "paystack";
        $data['page'] = "index";
        echo modules::run('template/layout', $data);
    }

    //    ============ its for payment gateway ============
    public function gotopaystack() {
        $gateway = $this->paystack_model->get_configdata(9);
        $customer_id = $this->session->userdata('log_id');
        $total_amount = $this->session->userdata('total_amount');
        $order_id = $this->session->userdata('invoice_id');


        echo '<form>
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <button type="button" onclick="payWithPaystack()" id="paytrack" style="display:none;"> Pay </button> 
</form>
<script>
document.getElementById("paytrack").click();
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: "' . $gateway->password . '",
      email: "' . $gateway->email . '",
      amount: "' . round($total_amount) . '",
      currency: "' . $gateway->currency . '", //NGN
      ref: ""+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
		  window.location.href="' . base_url() . 'payment-success/' . '";
      },
      onClose: function(){
           window.location.href="' . base_url('paystack-cancel') . '";
      }
    });
    handler.openIframe();
  }
</script>';
    }

    public function payment_success() {
        //Order entry
        $order_id = $this->session->userdata('invoice_id');
        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');

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

    public function cancel($order_id = null, $customer_id = null) {
        $data['title'] = "Order";


        $this->session->set_userdata('popup', '0');
        redirect(base_url());
    }

}
