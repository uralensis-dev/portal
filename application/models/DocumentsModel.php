<?php
defined('BASEPATH') or exit('No direct script access allowed');


class DocumentsModel extends CI_Model
{
    public function fetch_documents() 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();
		$sql="SELECT * from uralensis_upload_forms WHERE uploaded_by=$user_id";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
        return $res;
    }

    public function fetch_hospitals() 
	{
		//print $go_id = $this->ion_auth->group()->row()->id;
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
        $res = array();
        if ($group_type == 'A') 
		{
            // Get all hospitals
            $res = $this->db->get_where('groups', array('group_type' => 'H'))->result_array();
        }
        if ($group_type == 'H') {
            $res = $this->db->get_where('groups', array('id' => $group_id))->result_array();
        }
		if ($group_type == 'L') {
            $res = $this->db
            ->join('groups', 'groups.id = hospital_group.hospital_id')
            ->where('hospital_group.group_id', $group_id)           
            ->get('hospital_group')->result_array();

        }
        if ($group_type == 'D') 
		{
            $res = $this->db
            ->join('groups', 'groups.id = users_groups.institute_id')
            ->where('user_id', $user_id)
            ->where('institute_id !=', 'null')
            ->get('users_groups')->result_array();
        }
        return $res;
    }

    public function get_patient_data($id) 
    {
        $res = $this->db
        ->select("*", FALSE)
       // ->join("groups", "groups.id = patients.hospital_id")
        ->where("patients.id", $id)
        ->get("patients")->result_array();
        if (empty($res)) {
            throw new Exception("Patient not found");
        }
        return $res[0];
    }

    public function get_patient_id($id) {
        $res = $this->db
        ->select("patients.*, groups.*, patients.id as patient_id")
        ->join("groups", "groups.id = patients.hospital_id")
        ->where("patients.id", $id)->get("patients")->result_array();
        if (count($res) == 0) {
            throw new Exception("Patient not found", 404);
        }
        $patient = $res[0];
        $created_at = $patient["created_at"];
        $year = date("y", strtotime($created_at));
        $p_id = $patient['first_initial'].$patient['last_initial'].$year.str_pad($patient['patient_id'], 5, '0', STR_PAD_LEFT);
        return $p_id;
    }

    public function get_patient_records($id) 
    {
        return $this->db
        ->select(
            "
                users_request.*, groups.*, request.*, speciality_group.*,
                AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS doctor_first_name, 
                AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS doctor_last_name,
                profile_picture_path as doctor_profile_picture
            "
        )
        ->join("users_request", "users_request.request_id = request.uralensis_request_id")
        ->join("speciality_group", "request.speciality_group_id = speciality_group.spec_grp_id ")
        ->join("groups", "users_request.group_id = groups.id")
        ->join("users", "users.id = users_request.doctor_id")
        ->where("request.patient_id", $id)
        ->get("request")->result_array();
    }


    public function get_profile_picture($patient_id) 
    {
        $res = $this->db->get_where('patient_meta', array('patient_id' => $patient_id, 'meta_key' => 'profile_picture_path'))->result_array();
        if (count($res) !== 0) {
            $profile_picture_path = $res[0]['value'];
            if (!empty($profile_picture_path) && $profile_picture_path != DEFAULT_PROFILE_PIC && file_exists(APPPATH.'../'.$profile_picture_path)) {
                return base_url($profile_picture_path);
            }
        }
        $patient = $this->db->get_where('patients', array('id' => $patient_id))->result_array()[0];
        return UI_AVATAR.urlencode($patient['first_name'].' '.$patient['last_name']);
    }

    public function set_profile_picture($patient_id, $profile_picture_path) 
    {
        $rows = $this->db->get_where('patients', array('id' => $patient_id))->num_rows();
        if ($rows == 0) {
            throw new Exception("Patient does not exists", 404);
        }
        if (empty($profile_picture_path) || !file_exists(APPPATH.'../'.$profile_picture_path)) {
            throw new Exception("Profile picture does not exists", 400);
        }
        $rows = $this->db->get_where("patient_meta", array("patient_id" => $patient_id, "meta_key" => "profile_picture_path"))->num_rows();
        if ($rows == 0) {
            // insert
            $this->db->insert("patient_meta", array("patient_id" => $patient_id, "meta_key" => "profile_picture_path", "value" => $profile_picture_path));
        } else {
            // set
            $this->db
            ->set("value", $profile_picture_path)
            ->where("patient_id", $patient_id)
            ->where("meta_key", "profile_picture_path")
            ->update("patient_meta");
        }
    }

    public function get_upload_doc_forms()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->ion_auth->user()->row()->id;
        //$group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $this->db->select("uralensis_upload_forms.*, COUNT(dv.id) as viewer, AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name, groups.name as group_name");
        $this->db->from('uralensis_upload_forms');
        $this->db->join('document_viewers as dv', 'dv.document_id = uralensis_upload_forms.id', 'LEFT');
        $this->db->join('users', 'users.id = uralensis_upload_forms.uploaded_by', 'INNER');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->where('users.id', $user_id);
        $this->db->group_by('uralensis_upload_forms.id');
        return $query = $this->db->get()->result();
    }

    public function get_uploaded_doc_viewer($file_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->ion_auth->user()->row()->id;
        //$group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $this->db->select("dv.*, u2f.file_name, u2f.file_type, AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name, groups.name as group_name");
        $this->db->from('document_viewers as dv');
        $this->db->join('uralensis_upload_forms as u2f', 'u2f.id = dv.document_id');
        $this->db->join('users', 'users.id = dv.viewer_id', 'INNER');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->where('u2f.id', $file_id);
        return $this->db->get()->result();
    }
}