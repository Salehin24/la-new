<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_permission_model extends CI_Model {

    public function create($data = array()) {
        $this->db->where('fk_user_id', $data[0]['fk_user_id'])->delete('module_permission');
        return $this->db->insert_batch('module_permission', $data);
    }

    public function read() {
        return $this->db->select("
				module_permission.fk_user_id,
				CONCAT_WS(' ', user.firstname,user.lastname) AS user_name,
			")
                        ->from('module_permission')
                        ->join('user', 'user.id = module_permission.fk_user_id', 'left')
                        ->group_by('module_permission.fk_user_id')
                        ->order_by('user.firstname', 'asc')
                        ->get()
                        ->result();
    }

    public function single($id = null) {
        return $this->db->select("
				module_permission.*,
				module.name as module_name,
				CONCAT_WS(' ',user.firstname,user.lastname) AS user_name
			")
                        ->from('module_permission')
                        ->join('module', 'module.id = module_permission.fk_module_id', 'left')
                        ->join('user', 'user.id = module_permission.fk_user_id', 'left')
                        ->where('module_permission.fk_user_id', $id)
                        ->get()
                        ->result();
    }

    public function permission_edit($id = null) {
        $modules = $this->db->select("id, name")
                ->from("module")
                ->where("status", 1)
                ->get()
                ->result();

        $mod = array();
        foreach ($modules as $value) {

            $modWisPer = $this->db->select("
				module_permission.*,
				module.name as module_name 
			")
                    ->from('module_permission')
                    ->join('module', 'module.id = module_permission.fk_module_id', 'left')
                    ->where('module_permission.fk_user_id', $id)
                    ->where('module_permission.fk_module_id', $value->id)
                    ->get()
                    ->row();

            $mod[$value->id] = (object) array(
                        'name' => $value->name,
                        'fk_module_id' => $value->id,
                        'fk_user_id' => $id,
                        'create' => (!empty($modWisPer->create) ? $modWisPer->create : 0),
                        'read' => (!empty($modWisPer->read) ? $modWisPer->read : 0),
                        'update' => (!empty($modWisPer->update) ? $modWisPer->update : 0),
                        'delete' => (!empty($modWisPer->delete) ? $modWisPer->delete : 0)
            );
        }
        return $mod;
    }

    public function delete($id = null) {
        return $this->db->where('fk_user_id', $id)
                        ->delete("module_permission");
    }

    private function get_menudata_query() {
        $column_order = array(null, 'menu_title', 'page_url', 'module', 'parent_menu', 'status'); //set column field database for datatable orderable
        $column_search = array('menu_title', 'page_url', 'module', 'parent_menu', 'status'); //set column field database for datatable searchable 
        $order = array('menu_id' => 'desc');
        //add custom filter here

        $this->db->from('sec_menu_item');
        $i = 0;
        foreach ($column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {

                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_menudata() {
        $this->get_menudata_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtermenu() {
        $this->get_menudata_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allmenu() {
        $this->db->from('sec_menu_item');
        return $this->db->count_all_results();
    }

}
