<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Square_model extends CI_Model {

    public function get_configdata($id) {
        $this->db->select('*');
        $this->db->from('payment_method_tbl');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }


}
