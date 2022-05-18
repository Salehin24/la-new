<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

//    ============ its for category list ===============
    public function forum_category_list($offset, $limit) {
        $query = $this->db->select('*')
                        ->from('forum_category_tbl')
                        ->order_by('id', 'desc')
                        ->limit($offset, $limit)
                        ->get()->result();
        return $query;
    }

//    ============ its for get forum category ==========
    public function get_forumcategory() {
        $this->db->select('*');
        $this->db->from('forum_category_tbl');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }

//    ============= its for edit_data ============
    public function edit_data($id) {
        $this->db->select('a.*');
        $this->db->from('forum_category_tbl a');
        $this->db->where('forum_category_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

//    ============ its for forum list ===============
    public function forum_list($offset, $limit) {
        $this->db->select('a.*, b.title as category_name');
        $this->db->from('forum_tbl a');
        $this->db->join('forum_category_tbl b', 'b.forum_category_id = a.category_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get()->result();
        return $query;
    }

//    ============= its for get forum ==========
    public function get_forum() {
        $this->db->select('a.*');
        $this->db->from('forum_tbl a');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }

//    ============ its for forum filter ===============
    public function forum_filter($forum_id = null, $category_id = null) {
        $this->db->select('a.*, b.title as category_name');
        $this->db->from('forum_tbl a');
        $this->db->join('forum_category_tbl b', 'b.forum_category_id = a.category_id', 'left');
        $this->db->order_by('a.id', 'desc');
        if ($forum_id && $category_id) {
            $this->db->where('a.forum_id', $forum_id);
            $this->db->where('a.category_id', $category_id);
        } elseif ($forum_id) {
            $this->db->where('a.forum_id', $forum_id);
        } elseif ($category_id) {
            $this->db->where('a.category_id', $category_id);
        }
        $query = $this->db->get()->result();
        return $query;
    }

//============== its for edit forum data =============
    public function edit_forumdata($forum_id) {
        $this->db->select('a.*, b.picture');
        $this->db->from('forum_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.forum_id', 'left');
        $this->db->where('a.forum_id', $forum_id);
        $query = $this->db->get();
        return $query->row();
    }

//    ============ its for comment list ===============
    public function comment_list($offset, $limit) {
        $this->db->select('a.*, b.title, c.name');
        $this->db->from('comments_tbl a');
        $this->db->join('forum_tbl b', 'b.forum_id = a.forum_id', 'left');
        $this->db->join('loginfo_tbl c', 'c.log_id = a.user_id', 'left');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get()->result();
        return $query;
    }

}
