<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enterprise_model extends CI_Model {

    public function get_enterpriseeditdata($enterprise_id){
        $this->db->select('a.*, b.username, b.password');
        $this->db->from('enterprise_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_enterprisedata($enterprise_id) {
        $this->db->select('a.*, b.log_id, b.shortname, b.username, b.password');
        $this->db->from('enterprise_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id');
        $this->db->where('b.log_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function checkUser($data = array()) {
        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.username', $data['email']);
        $this->db->where('a.password', ($data['password']));
        $query = $this->db->get();
        return $query;
    }

    public function userPermission2($id = null) {
        $acc_tbl = $this->db->select('*')->from('sec_user_access_tbl')->where('fk_user_id', $id)->get()->result();
        if ($acc_tbl != NULL) {
            $role_id = [];
            foreach ($acc_tbl as $key => $value) {
                $role_id[] = $value->fk_role_id;
            }

            return $result = $this->db->select("
				sec_role_permission.role_id, 
				sec_role_permission.menu_id, 
				IF(SUM(sec_role_permission.can_create)>=1,1,0) AS 'create', 
				IF(SUM(sec_role_permission.can_access)>=1,1,0) AS 'read', 
				IF(SUM(sec_role_permission.can_edit)>=1,1,0) AS 'update', 
				IF(SUM(sec_role_permission.can_delete)>=1,1,0) AS 'delete',
				sec_menu_item.menu_title,
				sec_menu_item.page_url,
				sec_menu_item.module
				")
                    ->from('sec_role_permission')
                    ->join('sec_menu_item', 'sec_menu_item.menu_id = sec_role_permission.menu_id', 'full')
                    ->where_in('sec_role_permission.role_id', $role_id)
                    ->group_by('sec_role_permission.menu_id')
                    ->group_start()
                    ->where('can_create', 1)
                    ->or_where('can_access', 1)
                    ->or_where('can_edit', 1)
                    ->or_where('can_delete', 1)
                    ->group_end()
                    ->get()
                    ->result();
        } else {
            return 0;
        }
    }
    

}
