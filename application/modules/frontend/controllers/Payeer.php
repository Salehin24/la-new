<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payeer extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('payeer_model');
        if (!$this->session->userdata('session_id'))
            redirect();
    }

    public function gotopayeer() {
        $data['active_theme'] = get_activethemes();
        $date = new DateTime();
        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
        $order_id = $this->session->userdata('invoice_id');
        $comment = $customer_id . '/buy/' . $order_id . '/' . $date->format('Y-m-d H:i:s');

        /**         * ***********************
         * Payeer
         * ************************ */
        $gateway = $this->payeer_model->get_configdata();

        $data['m_shop'] = $gateway->marchant_id;
        $data['m_orderid'] = $order_id;
        $data['m_amount'] = number_format($amount, 2, '.', '');
        $data['m_curr'] = 'USD';
        $data['m_desc'] = base64_encode($comment);
        $data['m_key'] = $gateway->password;
        $data['user_id'] = $customer_id;
        $data['title'] = display('payeer_payment');

        $arHash = array(
            $data['m_shop'],
            $data['m_orderid'],
            $data['m_amount'],
            $data['m_curr'],
            $data['m_desc']
        );
        $arHash[] = $data['m_key'];
        $data['sign'] = strtoupper(hash('sha256', implode(':', $arHash)));
        $this->load->view('frontend/themes/payeer/show', $data);
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

    public function payment_fail() {
        
    }

    public function payment_statusurl() {
        
    }
}
