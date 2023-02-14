<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Barcode_model extends CI_Model 
{
    public function save_barcode($data){
        $this->db->insert('barcode', $data);
        return $this->db->insert_id();
    }
    public function check_barcode_exist($request_id, $test_id){
        $query = $this->db->select('*, br.id as br_id')
        ->from('barcode br')
        ->join('request rq', 'rq.uralensis_request_id = br.request_id', 'inner')
        ->join('patients pt', 'pt.id = rq.patient_id', 'inner')
        ->where('request_id' , $request_id)
        ->where('test_id' , $test_id)->limit(1)
        ->get();
        return $query->row_array();
    }

    // public function get_bulk_barcode($ids){
    //     $this->db->select('br.*, group_concat(DISTINCT(sp_block.name)) as test, concat(ptnt.first_name," ",ptnt.last_name) as patient_name');
    //     $this->db->from('barcode br');
    //     $this->db->join('specimen sp', 'sp.request_id = br.request_id', 'inner'); 
	// 	$this->db->join('specimen_blocks sp_block', 'sp_block.specimen_id=sp.specimen_id', 'LEFT');         
    //     $this->db->join('patients ptnt', 'ptnt.id = br.patient_id', 'left');
    //     $this->db->where_in('br.id', $ids);
    //     $this->db->group_by('br.id');
    //     $query = $this->db->get();
    //     //echo $this->db->last_query();
    //     return $query->result_array();
    // }

    public function get_bulk_barcode($ids){
        $subQuery = "(SELECT  req_assign_id,user_id,request_id,MAX(req_assign_id) Maxpath FROM  request_assignee GROUP BY req_assign_id) rq_as";
        $this->db->select('br.*, group_concat(DISTINCT(sp_block.name)) as testOld, group_concat(concat(sp_block.name,"_",sp.specimen_id,"_",sp_block.block_no) separator ",") as test,concat(rq.f_name," ",rq.sur_name) as patient_name, CONCAT(AES_DECRYPT(patho.first_name, "' . DATA_KEY . '")," " ,AES_DECRYPT(patho.last_name, "' . DATA_KEY . '")) AS pathologist');
        $this->db->from('barcode br');
        $this->db->join('request rq', 'rq.uralensis_request_id = br.request_id', 'inner'); 
        $this->db->join($subQuery, 'rq_as.request_id = rq.uralensis_request_id', 'inner');
        $this->db->join('users patho', 'patho.id = rq_as.user_id', 'left');
        $this->db->join('specimen sp', 'sp.request_id = br.request_id', 'inner'); 
		$this->db->join('specimen_blocks sp_block', 'sp_block.specimen_id=sp.specimen_id', 'LEFT');         
        $this->db->join('patients ptnt', 'ptnt.id = br.patient_id', 'left');
        $this->db->where_in('br.id', $ids);
        $this->db->group_by('br.id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_request_bulk_barcode($ids){
        $subQuery = "(SELECT  req_assign_id,user_id,request_id,MAX(req_assign_id) Maxpath FROM  request_assignee GROUP BY req_assign_id) rq_as";
        $this->db->select('br.*, group_concat(concat(sp_block.name,"_",sp.specimen_id,"_",sp_block.block_no) separator ",") as test, concat(rq.f_name," ",rq.sur_name) as patient_name, group_concat(DISTINCT(sp.specimen_id)) as sp_id, CONCAT(AES_DECRYPT(patho.first_name, "' . DATA_KEY . '")," " ,AES_DECRYPT(patho.last_name, "' . DATA_KEY . '")) AS pathologist');
        $this->db->from('barcode br');
        $this->db->join('request rq', 'rq.uralensis_request_id = br.request_id', 'inner'); 
        $this->db->join($subQuery, 'rq_as.request_id = rq.uralensis_request_id', 'inner');
        $this->db->join('users patho', 'patho.id = rq_as.user_id', 'left');
        $this->db->join('specimen sp', 'sp.request_id = br.request_id', 'inner'); 
		$this->db->join('specimen_blocks sp_block', 'sp_block.specimen_id=sp.specimen_id', 'LEFT');         
        $this->db->join('patients ptnt', 'ptnt.id = br.patient_id', 'left');
        $this->db->where_in('br.id', $ids);
        $this->db->group_by('br.id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_template($hospital_id){
        $query = $this->db->select('*')
        ->from('barcode_template')
        ->where('hospital_id', $hospital_id)
        ->limit(1)
        ->get();
        return $query->row_array();
    }    

    public function save_template($data, $action){
        if($action == 'create'){
            $this->db->insert('barcode_template', $data);
            return $this->db->insert_id();
        }else{
            $this->db->where('hospital_id', $data['hospital_id']);
            $this->db->limit(1);
            $this->db->update('barcode_template', $data);
            return $this->db->affected_rows();
        }        
    }

    public function get_request_data($request_id){
        $query = $this->db->select('*, date_format(pt.dob,"%d %b %Y") as birth_date, concat(DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),pt.dob)), "%Y")+0, " Years") AS pt_age')
        ->from('request r')
        ->join('patients pt', 'pt.id = r.patient_id', 'inner')
        ->where('r.uralensis_request_id', $request_id)
        ->limit(1)
        ->get();
        return $query->row_array();
    }

    public function specimen_pot_label($sp_id_arr){
        $this->db->select('sp.specimen_id, sp.request_id,rq.patient_id, rq.lab_id, rq.lab_number,  pt.first_name, pt.last_name, pt.dob, ifnull(sp_pot.id, 0) as is_exist, rq.pci_number as digi_number, sp_pot.barcode_img, sp_pot.specimen');
        $this->db->from('specimen sp');
        $this->db->join('request rq', 'rq.uralensis_request_id = sp.request_id', 'inner');
        $this->db->join('patients pt', 'pt.id = rq.patient_id', 'inner');
        $this->db->join('specimen_pot sp_pot', 'sp_pot.specimen_id = sp.specimen_id', 'left');
        $this->db->where_in('sp.specimen_id', $sp_id_arr);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_specimen_pot($save_sp_data){
        $this->db->insert_batch('specimen_pot', $save_sp_data);
        return;
    }
}
