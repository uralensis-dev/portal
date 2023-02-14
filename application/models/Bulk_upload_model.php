<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Bulk_upload_model extends CI_Model 
{
    public function folder_exist($folder, $parent_id){
        $query = $this->db->select('*')
                ->where('name', $folder)
                ->where('parent_id', $parent_id)
                ->get('folders');
        return $query->row_array();
    }

    public function slide_exist($filename, $folder_id){
        $query = $this->db->select('*')
                ->where('name', $filename)
                ->where('folder_id', $folder_id)
                ->where('is_deleted', 0)
                ->get('slides');
        return $query->row_array();
    }

    public function create_folder($folder_data){
        $this->db->insert('folders', $folder_data);
        return $this->db->insert_id();
    }
    public function create_slide($slide_data){
        $this->db->insert('slides', $slide_data);
        return $this->db->insert_id();
    }

    public function get_folder($name){
        $query = $this->db->select('*')
                ->where('name', $name)
                ->limit(1)
                ->get('folders');
        return $query->row_array();   
    }

    public function get_slide_folder($parent_folder, $parent_folder_name){
        $this->db->select('f_child.*');
        $this->db->from('folders f_child');
        if($parent_folder_name != 'root'){
            $this->db->join('folders f_parent', 'f_parent.id = f_child.parent_id', 'inner');
            $this->db->where('f_parent.name', $parent_folder_name);
        }else{
            $this->db->where('f_child.parent_id', 0);
        }
        $this->db->where('f_child.name', $parent_folder);            
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}