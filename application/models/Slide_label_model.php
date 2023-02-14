<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_label_model extends CI_Model {

    public function getLabIdsFromUser($user_id){        
        $lab_ids = $this->db->select('institute_id as lab_id')
                            ->from('groups gr')                            
                            ->join('users_groups ugr', 'gr.id = ugr.institute_id', 'left')
                            ->where([
                                'gr.group_type' => 'L',
                                'ugr.user_id' => $user_id,
                                //'ugr.institute_id' => $user_id
                            ])
                            ->get()->row()->lab_id;
        return $lab_ids;
		
    }

    public function get_unpublished_data($table, $select = null, $type, $lab_id)
	{

        $labIdStr = $this->getLabIdsFromUser($lab_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';        
        $labIds = array($labIds);
		$columns = ['rq_id', 'lab_no', 'lims_no', 'patient', 'test', 'speciman_no', 'pathologist'];
		$this->db->select($select, FALSE);
		$keyword = $this->input->post('search');
		
		if (!empty($keyword['value']))
		{
			$this->db->having('lab_no LIKE "%'.$this->db->escape_str($keyword['value']).'%"
                OR lims_no LIKE "%'.$this->db->escape_str($keyword['value']).'%"
                OR lims_no LIKE "%'.$this->db->escape_str($keyword['value']).'%"
            	OR patient LIKE "%'.$this->db->escape_str($keyword['value']).'%"
                OR speciman_no LIKE "'.$this->db->escape_str($keyword['value']).'%"
                OR pathologist LIKE "'.$this->db->escape_str($keyword['value']).'%"
                OR test LIKE "'.$this->db->escape_str($keyword['value']).'%"', NULL);
		}
		$subQuery = "(SELECT  req_assign_id,user_id,request_id,MAX(req_assign_id) Maxpath FROM  request_assignee GROUP BY req_assign_id) rq_as";
		$this->db->join($subQuery, 'rq_as.request_id = rq.uralensis_request_id', 'inner');
        $this->db->join('users patho', 'patho.id = rq_as.user_id', 'left');
        $this->db->join('users u', 'rq.request_add_user = u.id', 'left');
        $this->db->join('tbl_courier cr', 'cr.id=rq.emis_number', 'left');
		$this->db->join('patients pt', 'pt.id = rq.patient_id', 'inner');
		$this->db->join('specimen sp', 'sp.request_id = rq.uralensis_request_id', 'inner'); 
		$this->db->join('specimen_blocks sp_block', 'sp_block.specimen_id=sp.specimen_id', 'LEFT'); 
		$this->db->join('barcode br', 'br.request_id = rq.uralensis_request_id', 'left');
		$this->db->order_by($columns[$this->input->post('order')[0]['column']], $this->input->post('order')[0]['dir']);
		$this->db->where('rq.specimen_publish_status', 0);
		$this->db->where('rq.supplementary_review_status', 'false');
		$user_filter = intval($this->input->post('user_id'));
		$date_filter = $this->input->post('date_filter');
		if($user_filter > 0){
			$this->db->where('rq.request_add_user', $user_filter);	
		}
		if($date_filter != ''){
			// $date_filter = date('Y-m-d', strtotime($date_filter));
			// $this->db->like('rq.request_datetime', $date_filter, 'after');
			$fl_dates = explode('-', $date_filter);
			$f_date = date('Y-m-d', strtotime($fl_dates[0]));
			$t_date = date('Y-m-d', strtotime($fl_dates[1]));
			$this->db->where('date_format(rq.request_datetime, "%Y-%m-%d") >=', $f_date);
			$this->db->where('date_format(rq.request_datetime, "%Y-%m-%d") <=', $t_date); //, 'after'	
		}
        $this->db->where_in('rq.lab_id', $labIds);
		$this->db->group_by('rq.uralensis_request_id');
		if ($type == 'count'){
			$query = $this->db->get($table);
			return $query->num_rows();
		}else{
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
			$start  = $this->input->post('start') + 1;
			$query  = $this->db->get($table);
			$result = $query->result_array();
			if ($result){
				$new_result = array();
				foreach ($result as $key => $val){
					$result[$key]            = $val;
					$result[$key]['test_id'] = $start++;
				}
			}			
			return $result;
		}
	}
	public function get_user_list($lab_id){		
		$query  = $this->db->select("u.id as user_id, CONCAT(AES_DECRYPT(u.first_name, '7kgtY3rYvbx6krm2HGiR'), ' ', AES_DECRYPT(u.last_name, '7kgtY3rYvbx6krm2HGiR')) AS user_name", FALSE)
				->from('users u')
				->join('users_groups ug', 'u.id = ug.user_id', 'inner')				
        		->where_in('ug.institute_id', $lab_id)
				->group_by('u.id')
				->order_by('user_name', 'ASC')->get();
		$result = $query->result_array();		
		return $result;
	}
	public function get_barcode_data($request_id, $test_id){
        $query = $this->db->select('*')
        ->from('barcode br')
        ->join('request rq', 'rq.uralensis_request_id = br.request_id', 'inner')
        ->join('patients pt', 'pt.id = rq.patient_id', 'inner')
        ->where('request_id' , $request_id)
        ->where('test_id' , $test_id)->limit(1)
        ->get();
        return $query->row_array();
    }
    
}