<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model {

    private $product_key = '27323682';
    private $api_url = "https://store.bdtask.com/alpha2/api/products";
    private $access_key = "3b32166232ca4e50bcde73a98ec6a96c25d59567";
    private $header;

    public function __construct() {
        parent::__construct();
        $this->header = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->access_key
        );
    }

    public function create($data = array()) {
        return $this->db->insert('module', $data);
    }

    public function read() {
        return $this->db->select('*')
                        ->from('module')
                        ->get()
                        ->result();
    }

    public function single($id = null) {
        return $this->db->select('*')
                        ->from('module')
                        ->where('id', $id)
                        ->get()
                        ->row();
    }

    public function update($data = array()) {
        return $this->db->where('id', $data["id"])
                        ->update("module", $data);
    }

    public function delete($id = null) {
        $this->db->where('id', $id)
                ->delete("module");
        $this->db->where('fk_module_id', $id)
                ->delete("module_permission");
        return true;
    }

    public function delete_by_directory($directory = null) {
        $row = $this->db->select('id')->from('module')->where('directory', $directory)->get();
        if ($row->num_rows() > 0) {
            $id = $row->row()->id;
            $this->db->where('id', $id)
                    ->delete("module");
            $this->db->where('fk_module_id', $id)
                    ->delete("module_permission");
            return true;
        } else {
            return false;
        }
    }

    public function dropdown() {
        $data = $this->db->select('id,name')
                ->from("module")
                ->where('status', 1)
                ->order_by('name', 'asc')
                ->get()
                ->result();
        $list = array();
        if (!empty($data)) {
            foreach ($data as $value)
                $list[$value->id] = $value->name;
            return $list;
        } else {
            return false;
        }
    }

    // Send Curl request
    public function send_curl_request($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    // Purchase New Module
    public function purchase_new_module($getdata) {
        $url = $this->api_url . "/download_module?" . $getdata . "&access_key=" . $this->access_key;
        $return = $this->send_curl_request($url);
        return json_decode($return);
    }

    // Get all module ids
    public function get_installed_module_names() {
//        $this->db->select('identity');
//        $modules = $this->db->get('module')->result_array();
//        $modulenames = array_column($modules, 'identity');
//        return $modulenames;
        $path = 'application/modules/';
        $map = directory_map($path);
        $modnames = array();
        if (is_array($map) && sizeof($map) > 0) {
            $modnames = array_filter(array_keys($map));
            $modnames = preg_replace('/\W/', '', $modnames);
        }
        return $modnames;
    }

    // Get availble modules 
    public function search_available_modules() {
        $new_module = $this->session->userdata('add_new_module');

//        if (isset($new_module) && !empty($new_module)) {
//            return $new_module;
//        } else {
        $module_url = $this->api_url . "/modules/" . $this->product_key;
        $result = $this->send_curl_request($module_url);
//        dd($result);
        $this->session->set_userdata('add_new_module', $result);
        return $result;
//        }
    }

}
