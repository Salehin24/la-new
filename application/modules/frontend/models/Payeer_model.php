<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payeer_model extends CI_Model {

    public function get_configdata() {
        $this->db->select('*');
        $this->db->from('payeer_config');
        $query = $this->db->get();
        return $query->row();
    }

//    ================ its for payment submit by sslcommerz ============
//    public function payment_by_payeer() {
//        $date = new DateTime();
//        $customer_id = '3333';
//        $amount = 100;
//        $order_id = time();
//        $comment = $customer_id . '/buy/' . $order_id . '/' . $date->format('Y-m-d H:i:s');
//
//        /*         * ************************
//         * Payeer
//         * ************************ */
//        $gateway = $this->get_configdata();
//        dd($gateway);
//        $data['m_shop'] = $gateway->marchant_id;
//        $data['m_orderid'] = $order_id;
//        $data['m_amount'] = number_format($amount, 2, '.', '');
//        $data['m_curr'] = 'USD';
//        $data['m_desc'] = base64_encode($comment);
//        $data['m_key'] = $gateway->password;
//        $data['user_id'] = $customer_id;
//        $data['title'] = display('payeer_payment');
//
//        $arHash = array(
//            $data['m_shop'],
//            $data['m_orderid'],
//            $data['m_amount'],
//            $data['m_curr'],
//            $data['m_desc']
//        );
//        $arHash[] = $data['m_key'];
//        $data['sign'] = strtoupper(hash('sha256', implode(':', $arHash)));
//
////         dd($arHash);
////            $content = $this->parser->parse('website/payment', $data, true);
////            $this->template->full_website_html_view($content);
//    }
}
