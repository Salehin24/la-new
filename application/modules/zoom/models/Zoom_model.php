<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zoom_model extends CI_Model {

    public function meeting_list($offset, $limit) {
        if (get_usertype() == 1) {
            $this->db->select('a.*');
            $this->db->from('meeting_tbl a');
            $this->db->order_by('a.id', 'desc');
            $this->db->limit($offset, $limit);
            $query = $this->db->get()->result();
            return $query;
        } else {
            $get_ownproductids = $this->db->select('product_id')->from('invoice_details')->where('customer_id', get_userid())->get()->result();
            if ($get_ownproductids) {
                $ids = '';
                foreach ($get_ownproductids as $key => $id) {
                    $ids .= '"' . $id->product_id . '",';
                }
                $rtrim_ids = (rtrim($ids, ','));
                $sql_query = 'SELECT * FROM meeting_tbl WHERE course_id IN (' . $rtrim_ids . ')';
                $query = $this->db->query($sql_query)->result();
                
                return $query;
            }
        }
    }

//    =============== its for get meeting info ===========
    public function get_meetinginfo($meetingid) {
        $this->db->select('a.*');
        $this->db->from('meeting_tbl a');
        $this->db->where('a.id', $meetingid);
        $query = $this->db->get();
        return $query->row();
    }

//    ============== its for zoom config data ===============
    public function get_zoomconfigdata($enterprise_id) {
        $this->db->select('a.*');
        $this->db->from(' zoomconfig_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }

//    ============== its for zoom config data ===============
    public function get_livecourseeditdata($course_id) {
        $this->db->select('a.*, b.picture');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->where('a.course_id', $course_id);
        $query = $this->db->get()->row();
        return $query;
    }

//    =========== its for get_meetinginfo ===========
    public function getmeetinginfo($course_id) {
        $this->db->select('a.*');
        $this->db->from('meeting_tbl a');
        $this->db->where('a.course_id', $course_id);
        $query = $this->db->get();
        return $query->row();
    }

}
