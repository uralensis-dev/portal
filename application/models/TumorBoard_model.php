<?php

class TumorBoard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_meetings($hospital_id)
    {
        return $this->db->get_where('uralensis_mdt_lists', ['ura_mdt_list_hospital_id' => $hospital_id]);
    }
    
    public function create_meeting($new_meeting)
    {
        //Add new list
        $this->db->insert('uralensis_mdt_lists', [
            'ura_mdt_list_name' => $new_meeting['ura_mdt_list_name'],
            'ura_mdt_list_hospital_id' => $new_meeting['ura_mdt_list_hospital_id'],
            'ura_mdt_description' => $new_meeting['ura_mdt_description'],
            'ura_mdt_list_timestamp' => date('U')
        ]);
        $list_id = $this->db->insert_id();
        //Add first date
        $this->db->insert('uralensis_mdt_dates', [
            'ura_mdt_hospital_id' => $new_meeting['ura_mdt_list_hospital_id'],
            'ura_mdt_date' => $new_meeting['ura_mdt_date'],
            'ura_mdt_list_id' => $list_id,
            'ura_mdt_timestamp' => strtotime($new_meeting['ura_mdt_date'])
        ]);
        $dateId = $this->db->insert_id();
        
        return $list_id;
    }
    
    public function get_meeting($meeting_id)
    {
        return $this->db->get_where('uralensis_mdt_lists', ['ura_mdt_list_id' => $meeting_id])->row();
    }
    
}