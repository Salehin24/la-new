<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Square extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('square_model');
        if (!$this->session->userdata('session_id'))
            redirect();
    }

    public function index() {
        if (!$this->session->userdata('session_id')) {
            redirect('login');
        }
        $data['title'] = display('square_configuration');
        $data['get_configdata'] = $this->square_model->get_configdata(7);

        $data['module'] = "square";
        $data['page'] = "index";
        echo modules::run('template/layout', $data);
    }

    public function gotoSquare() {
        $customer_id = $this->session->userdata('log_id');
        $amount = $this->session->userdata('total_amount');
        $order_id = $this->session->userdata('invoice_id');

        $data['gateway'] = $this->square_model->get_configdata(7);

        $this->load->view('square', $data);
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

}
