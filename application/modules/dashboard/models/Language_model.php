<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {

   private function get_allphrases() {
        $column_order = array(null, 'phrase'); //set column field database for datatable orderable
        $column_search = array('phrase'); //set column field database for datatable searchable 
        $order = array('id' => 'desc');
        //add custom filter here


        $this->db->from('language');
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
  public function phrases() {
         $this->get_allphrases();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    
    }
    public function count_allfilterphrase() {
        $this->get_allphrases();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allphrase() {
        $this->db->from('language');
        return $this->db->count_all_results();
    }

}
