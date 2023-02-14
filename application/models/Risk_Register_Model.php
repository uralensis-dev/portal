<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Risk_Register_Model extends CI_Model
{
	
	
	public function fetch_list() 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
		//After the review date 
		
		
        $res = array();       
			
		$sql="SELECT risk_register.id as riskId, date_raised, risk_description, risk_register_likelihood.name as likelihood, risk_register_impact.name as impact, risk_register_severity.name as severity, mitigating_actions, owner_id, status, date_closed    
		FROM `risk_register` 
		JOIN  risk_register_likelihood  ON risk_register.likelihood_id=risk_register_likelihood.id
		JOIN  risk_register_impact  ON risk_register.Impact_id=risk_register_impact.id
		JOIN  risk_register_severity  ON risk_register.severity_id=risk_register_severity.id
		-- LEFT JOIN risk_comment ON  risk_register.id = (SELECT risk_id from risk_comment where risk_comment.risk_id = risk_register.id LIMIT 1)
		";
		$query = $this->db->query($sql);
		$res = $query->result_array();
        
        //echo $this->db->last_query(); exit; 
        return $res;
    }
	
	function getCategory(){
		
		$sql="SELECT * FROM `risk_register_category` ";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	function getSubCategory($catId){
		
		$sql="SELECT * FROM `risk_register_sub_category` where risk_register_category_id=".$catId."";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	function getLikelihood(){
		
		$sql="SELECT * FROM `risk_register_likelihood` ";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	function getImpact(){
		
		$sql="SELECT * FROM `risk_register_impact` ";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	
	function getSeverity(){
		
		$sql="SELECT * FROM `risk_register_severity` ";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	function getSubCategoryList(){
		
		$sql="SELECT risk_register_sub_category.id as sid, risk_register_sub_category.name as sname , risk_register_category.name as name,risk_register_sub_category.created_at as screated_at FROM `risk_register_sub_category` JOIN `risk_register_category` ON  risk_register_category.id= risk_register_sub_category.risk_register_category_id";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	
	

	
	
	
	
}