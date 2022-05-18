<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate_model extends CI_Model {

    //    ========= its for certificate_edit ========
    public function certificate_edit($id) {
        $this->db->select('*');
        $this->db->from('template_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }


}
