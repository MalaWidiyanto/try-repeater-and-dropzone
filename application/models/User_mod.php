<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_mod extends CI_Model {
    
    public function insert($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function insert_batch($table, $data){
        return $this->db->insert_batch($table, $data);
    }

    public function get($table, $where){
        return $this->db->get_where($table, $where)->result_array();
    }
}