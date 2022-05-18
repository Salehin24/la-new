<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sslcommerz_model extends CI_Model {

    public function get_configdata($id = null) {
        $this->db->select('*');
        $this->db->from('payment_method_tbl');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

//    ================ its for payment submit by sslcommerz ============
    public function payment_by_sslcommerz($session_cart_info,$enterprise_shortname=null) {

       $customer_id = $session_cart_info['log_id'];
        $order_id = $session_cart_info['invoice_id'];
        $amount = $session_cart_info['total_amount'];
        $email = $session_cart_info['email'];
        $shipp_email = $session_cart_info['shipp_email'];
        //Payment method for sslcommerz


        $gateway = $this->get_configdata(1);

        $total_amount = number_format($amount, 2, '.', '');

// Set Session for payment
        $paysession = array(
            'trans_id' => $order_id,
            'amount' => $total_amount,
            'currency_type' => $gateway->currency,
            'currency_amount' => $total_amount
        );
        $this->session->set_userdata($paysession);
        $this->session->set_userdata('order_id', $order_id);
        $this->session->set_userdata('customer_id', $customer_id);     


        $inId=base64_encode($order_id);
        $post_data = array();
//            $post_data['store_id'] = "style5c246d140fefc";
//            $post_data['store_passwd'] = "style5c246d140fefc@ssl";
        $post_data['store_id'] = $gateway->marchant_id;
        $post_data['store_passwd'] = $gateway->password;
        $post_data['total_amount'] = $total_amount;
        $post_data['currency'] = $gateway->currency;
        $post_data['tran_id'] = $order_id;       
        $post_data['success_url'] = base_url($enterprise_shortname.'/sslcommerz-payment-success/'.$inId);
        $post_data['fail_url'] = base_url($enterprise_shortname.'/sslcommerz-payment-failed');
        $post_data['cancel_url'] = base_url($enterprise_shortname.'/sslcommerz-payment-cancel');

# EMI INFO
        $post_data['emi_option'] = "0";

        $cus_email = $email; //$this->session->userdata('customer_email');
        $ship_email = $shipp_email; //$this->session->userdata('ship_email');

        $customer_email = (!empty($cus_email) ? $cus_email : $ship_email);

//            dd($customer_email);
# CUSTOMER INFORMATION
        $post_data['cus_name'] = $session_cart_info['name']; //$this->session->userdata('customer_name');
        $post_data['cus_email'] = $session_cart_info['email']; //$customer_email;
        $post_data['cus_add1'] = $session_cart_info['address']; //$this->session->userdata('customer_address_1');
        $post_data['cus_add2'] = $session_cart_info['shipp_address']; //$this->session->userdata('customer_address_1');
        $post_data['cus_city'] = $session_cart_info['city']; //$this->session->userdata('city');
        $post_data['cus_state'] = $session_cart_info['state']; //$this->session->userdata('state');
        $post_data['cus_postcode'] = $session_cart_info['zip']; //$this->session->userdata('zip');
        $post_data['cus_country'] = $session_cart_info['country']; //$this->session->userdata('country');
        $post_data['cus_phone'] = $session_cart_info['mobile']; //$this->session->userdata('customer_mobile');
# OPTIONAL PARAMETERS
        $post_data['value_a'] = $order_id;
        $post_data['value_b'] = "";
        $post_data['value_c'] = $customer_id;
        $post_data['value_d'] = "";

        $product_amount = '';
        $post_data['product_amount'] = '';
//            dd($post_data);
//                $post_data['product_amount'] = number_format($product_amount, 2,'.','');
// dd($post_data);
         
        $post_data['shipping_method'] = "No";
        $post_data['product_name'] = "product_name";
        $post_data['product_category'] = "product_category";
        $post_data['product_profile'] = "general";
        $post_data['num_of_item'] =1;
        
# REQUEST SEND TO SSLCOMMERZ
        if ($gateway->is_live == 0) {
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";
        } elseif ($gateway->is_live == 1) {
            $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php";
        }

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, TRUE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

        $content = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !( curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close($handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

# PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true);

// dd($sslcz);
        if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
            echo "<script>window.location.href = '" . $sslcz['GatewayPageURL'] . "';</script>";
            exit;
        } else {
            echo "JSON Data parsing error!";
        }

//            }
    }

}
