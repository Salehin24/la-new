<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generators {

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 34);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return strtoupper($con);
    }

//    ============ its for random key generator ===========
    public function random_keygenerator($mode = null, $len = null) {
        $result = "";
        if ($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif ($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif ($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif ($mode == 4):
            $chars = "0123456789";
        endif;
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    //NUMBER GENERATOR
    public function number_generator() {
        $CI = & get_instance();
        $CI->db->select_max('invoice', 'invoice');
        $query = $CI->db->get('invoice_tbl');
        $result = $query->result_array();
        $invoice_no = $result[0]['invoice'];
        if ($invoice_no != '') {
            $invoice_no = $invoice_no + 1;
        } else {
            $invoice_no = 1000;
        }
        return $invoice_no;
    }
    //NUMBER GENERATOR
    public function withdrawrequestnumber_generator() {
        $CI = & get_instance();
        $CI->db->select_max('request_id', 'request_id');
        $query = $CI->db->get('payment_withdrawrequst_tbl');
        $result = $query->result_array();
        $request_no = $result[0]['request_id'];
        if ($request_no != '') {
            $request_no = $request_no + 1;
        } else {
            $request_no = 1000;
        }
        return $request_no;
    }

    function get_table($table, $id = NULL, $single = FALSE) {
        if ($single == TRUE) {
            $method = 'row_array';
        } else {
            $this->CI->db->order_by('id', 'ASC');
            $method = 'result_array';
        }
        if ($id != NULL) {
            $this->CI->db->where('id', $id);
        }
        $query = $this->CI->db->get($table);
        return $query->$method();
    }

}

?>