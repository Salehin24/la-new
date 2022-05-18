<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function create($data = array()) {
        return $this->db->insert('user', $data);
    }

    public function read() {
        return $this->db->select("
		user.*")
                        ->from('user')
                        ->where('enterprise_id', get_enterpriseid())
                        ->order_by('id', 'desc')
                        ->get()
                        ->result();
    }

    public function single($id = null) {
        return $this->db->select('*')
                        ->from('user')
                        ->where('id', $id)
                        ->get()
                        ->row();
    }

    public function edit_data($log_id = null) {
        return $this->db->select('a.*, b.password')
                        ->from('user a')
                        ->join('loginfo_tbl b', 'b.log_id = a.log_id')
                        ->where('a.log_id', $log_id)
                        ->get()
                        ->row();
    }

    public function update($data = array()) {
        return $this->db->where('log_id', $data["id"])
                        ->update("user", $data);
    }

    public function delete($id = null) {
         $this->db->where('log_id', $id)
                        ->where_not_in('is_admin', 1)
                        ->delete("user");

         $this->db->where('log_id', $id)
                        ->where_not_in('is_admin', 1)
                        ->delete("loginfo_tbl");
         return true;
    }

    public function dropdown() {
        $data = $this->db->select("log_id, CONCAT_WS(' ', firstname, lastname) AS fullname")
                ->from("user")
                ->where('status', 1)
                ->where_not_in('is_admin', 1)
                ->get()
                ->result();
        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value)
                $list[$value->id] = $value->fullname;
            return $list;
        } else {
            return false;
        }
    }

}
