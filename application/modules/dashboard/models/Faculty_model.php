<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty_model extends CI_Model {

//    ============ its for faculty list ===============
    public function faculty_list($offset = null, $limit = null) {
        $this->db->select('a.*, b.picture, c.status as logstatus');
        $this->db->from('faculty_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get()->result();
        return $query;
    }

//    ============ its for faculty course list ===============
    public function facultycourse_list($offset = null, $limit = null, $user_type=null, $user_id=null) {
        $this->db->select('a.name, a.faculty_id, a.paypal, b.course_id');
        $this->db->from('faculty_tbl a');
        $this->db->join('course_tbl b', 'b.faculty_id = a.faculty_id');
        if ($user_type != 1) {
            $this->db->where('a.faculty_id', $user_id);
        }
        $this->db->group_by('b.faculty_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }

//    ============ its for quick view faculty course list ===============
    public function quickview_facultycourse_list($user_type, $user_id) {
        // (select count(faculty_id) from course_tbl where faculty_id= `a`.`faculty_id`) as course_count
        $this->db->select('a.name, a.faculty_id,
        (select sum(credit) from instructor_ledger_tbl where user_id = a.faculty_id AND status = 1) as instructor_revenue,
        (select sum(debit) from instructor_ledger_tbl where user_id = a.faculty_id AND status = 1) as instructor_paidamount
        ');
        $this->db->from('faculty_tbl a');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

//    ============== its for frontend show faculty list ============
    public function get_faculty_list($offset = null, $limit = null) {
        $this->db->select('a.*, b.picture, c.status as logstatus');
        $this->db->from('faculty_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        $this->db->where('a.status', 1);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get()->result();
        return $query;
    }

//    ============= its for get faculty =============
    public function get_faculty() {
        $this->db->select('a.*');
        $this->db->from('faculty_tbl a');
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }

//    ============ its for faculty filter ===============
    public function faculty_filter($faculty_id = null, $email = null) {
        $this->db->select('a.*, b.picture, c.status as logstatus');
        $this->db->from('faculty_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id');
        if ($faculty_id && $email) {
            $this->db->where('a.faculty_id', $faculty_id);
            $this->db->like('a.email', $email);
        } elseif ($faculty_id) {
            $this->db->where('a.faculty_id', $faculty_id);
        } elseif ($email) {
            $this->db->like('a.email', $email);
        }
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

////    ============== its for course edit ==============
    public function edit_data($faculty_id) {
        $this->db->select('a.*, b.picture, c.username, c.password');
        $this->db->from('faculty_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id', 'left');
        $this->db->where('a.faculty_id', $faculty_id);
        $query = $this->db->get()->row();
        return $query;
    }

////    ============== its for faculty info ==============
    public function faculty_info($faculty_id) {
        $this->db->select('a.*, b.picture, c.username, c.password');
        $this->db->from('faculty_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id', 'left');
        $this->db->where('a.faculty_id', $faculty_id);
        $query = $this->db->get()->row();
        return $query;
    }

//    ============== its for faculty wise education ===========
    public function faculty_education($faculty_id) {
        $this->db->select('*');
        $this->db->from('education_tbl a');
        $this->db->where('a.from_id', $faculty_id);
        $query = $this->db->get()->result();
        return $query;
    }

//    ============== its for faculty wise work experience ===========
    public function faculty_experience($faculty_id) {
        $this->db->select('*');
        $this->db->from('work_experience_tbl a');
        $this->db->where('a.from_id', $faculty_id);
        $query = $this->db->get()->result();
        return $query;
    }

//    =========== its for get faculty courses ===============
    public function get_facultyCourse($faculty_id) {
        $this->db->select('a.name, a.category_id, a.course_id');
        $this->db->from('course_tbl a');
        $this->db->where('a.faculty_id', $faculty_id);
        $query = $this->db->get()->result();
        return $query;
    }

// //    ============= its for faculty_paidamount ============
//     public function faculty_paidamount($faculty_id) {
//         $query = $this->db->select('sum(amount) as paidamount')->from('ledger_tbl')->where('ledger_id', $faculty_id)->where('d_c', 'd')->get()->row();
//         return $query;
//     }

   

}
