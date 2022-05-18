<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payu_model extends CI_Model {

    public function get_configdata() {
        $this->db->select('*');
        $this->db->from('payu_config');
        $query = $this->db->get();
        return $query->row();
    }


}
