<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

//    ============ its for student list ===============
    public function student_list($offset, $limit) {
        $this->db->select('a.*, b.picture, c.status as logstatus');
        $this->db->from('students_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.student_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.student_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get()->result();
        return $query;
    }

//    ============ its for student filter ===============
    public function students_filter($student_id = null, $mobile = null) {
        $this->db->select('a.*, b.picture, c.status as logstatus');
        $this->db->from('students_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.student_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.student_id');
        if ($student_id && $mobile) {
            $this->db->where('a.student_id', $student_id);
            $this->db->like('a.mobile', $mobile);
        } elseif ($student_id) {
            $this->db->where('a.student_id', $student_id);
        } elseif ($mobile) {
            $this->db->like('a.mobile', $mobile);
        }
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    //    ============ its for get student list ===============
    public function get_studentlist() {
        $this->db->select('a.student_id, a.name');
        $this->db->from('students_tbl a');
        $this->db->order_by('a.id', 'desc');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.status', 1);
        $query = $this->db->get();
        return $query->result();
    }

//    ========== its for student sales course faculty wise =============
    public function student_sales_course_facultywise($offset, $limit, $user_id, $user_type) {
        $this->db->select('a.name, a.course_id')
                ->from('course_tbl a')
                ->where('a.faculty_id', $user_id);
        $get_facultyCourse = $this->db->get()->result();

        $courseids = '';
        foreach ($get_facultyCourse as $facultycourse) {
            $courseids .= "'" . $facultycourse->course_id . "',";
        }
        $course_ids = rtrim($courseids, ",");
        if ($course_ids) {
            $where_in = "a.product_id IN ($course_ids)";
            $this->db->select('b.student_id, b.name, b.mobile, a.product_id, SUM(a.quantity) as totalsales');
            $this->db->from('invoice_details a');
            $this->db->join('students_tbl b', 'b.student_id = a.customer_id');
            $this->db->where($where_in);
            $this->db->group_by('a.customer_id');
            $this->db->limit($offset, $limit);
            $query = $this->db->get();
            return $query->result();
        }
    }

    public function student_sales_course($offset, $limit) {
        $this->db->select('a.id, a.student_id, a.name, a.mobile, SUM(b.quantity) as totalsales');
        $this->db->from('students_tbl a');
        $this->db->join('invoice_details b', 'b.customer_id = a.student_id');
        $this->db->limit($offset, $limit);
        $this->db->group_by('b.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

//    ========= its for student_salescourse_filter ===========
    public function student_salescourse_filter($student_id = null, $mobile = null, $start_date = null, $end_date = null) {
        $date_range = "b.invoice_date BETWEEN '$start_date' AND '$end_date'";
        $this->db->select('a.id, a.student_id, a.name, a.mobile, SUM(b.quantity) as totalsales');
        $this->db->from('students_tbl a');
        $this->db->join('invoice_details b', 'b.customer_id = a.student_id');
        if ($student_id && $mobile && $start_date && $end_date) {
            $this->db->where('a.student_id', $student_id);
            $this->db->like('a.mobile', $mobile);
            $this->db->where($date_range);
        } elseif ($student_id && $start_date && $end_date) {
            $this->db->where('a.student_id', $student_id);
            $this->db->where($date_range);
        } elseif ($mobile && $start_date && $end_date) {
            $this->db->like('a.mobile', $mobile);
            $this->db->where($date_range);
        } elseif ($start_date && $end_date) {
            $this->db->where($date_range);
        } elseif ($student_id) {
            $this->db->where('a.student_id', $student_id);
        } elseif ($mobile) {
            $this->db->like('a.mobile', $mobile);
        }
        $this->db->group_by('b.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

////    ============== its for student edit ==============
    public function edit_data($student_id) {
        $this->db->select('a.*, b.picture, c.username, c.password');
        $this->db->from('students_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.student_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.student_id', 'left');
        $this->db->where('a.student_id', $student_id);
        $query = $this->db->get()->row();
        return $query;
    }

//
//    ============== its for get student faculty course ===========
    public function get_studentfacultycourse($student_id, $faculty_id) {
        $this->db->select('b.course_id, b.name, COUNT(a.product_id) totalcount');
        $this->db->from('invoice_details a');
        $this->db->join('course_tbl b', 'b.course_id = a.product_id');
        $this->db->where('a.customer_id', $student_id);
        $this->db->where('b.faculty_id', $faculty_id);
        $this->db->group_by('a.product_id');
        $query = $this->db->get()->result();
        return $query;
    }

//    ============== its for get student course ===========
    public function get_studentcourse($student_id) {
        $this->db->select('a.created_date, a.price, b.course_id, b.name, COUNT(a.product_id) totalcount');
        $this->db->from('invoice_details a');
        $this->db->join('course_tbl b', 'b.course_id = a.product_id');
        $this->db->where('a.customer_id', $student_id);
        $this->db->where('a.status', 1);
        $this->db->group_by('a.product_id');
        $query = $this->db->get()->result();
        return $query;
    }

    // ============= its for assign certificate edit ===============
    public function assigncertificate_edit($id){
        $this->db->select('*');
        $this->db->from('certificate_mapping_tbl');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getstudentcourse($student_id = null, $type = null){
        $this->db->select('a.*, b.name');
        $this->db->from('invoice_details a');
        $this->db->join('course_tbl b', 'b.course_id = a.product_id');
        $this->db->where('a.customer_id', $student_id);
        $this->db->where('a.is_subscription', $type);
        $query = $this->db->get();
        return $query->result();
    }
}