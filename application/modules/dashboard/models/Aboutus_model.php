<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus_model extends CI_Model {

    public function get_aboutinfo($enterprise_id){
        $this->db->select('*');
        $this->db->from('aboutinfo_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_aboutchoose($about_id){
        $this->db->select('*');
        $this->db->from('aboutchoose_tbl a');
        $this->db->where('a.about_id', $about_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function aboutchoose_edit($id){
        $this->db->select('*');
        $this->db->from('aboutchoose_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function aboutservice_edit($id){
        $this->db->select('*');
        $this->db->from('about_service_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
