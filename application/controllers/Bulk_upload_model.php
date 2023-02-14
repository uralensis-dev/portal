<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Bulk_upload_model extends CI_Model 
{
    public function folder_exist($folder, $parent_id){
        $query = $this->db->select('id')
                ->where('name', $folder)
                ->where('parent_id', $parent_id)
                ->get('folders');
        return $query->result_array();
    }
    public function create_folder($folder_data){
        $this->db->insert('folders', $folder_data);
        return $this->db->insert_id();
    }

    public function get_folder($name){
        $query = $this->db->select('id')
                ->where('name', $name)                
                ->get('folders');
        return $query->row('id');   
    }
}