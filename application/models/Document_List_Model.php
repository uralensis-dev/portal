<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Document_List_Model extends CI_Model
{
	
	
	public function fetch_document_list($search_type=0) 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
		//After the review date 
		
		$effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
		
		$where = 'where is_published =0';
		//After the review date 
		if($search_type==1){
			$where = ' AND date_of_next_review <="'.date('Y-m-d').'"';
		}
		//With 3 months of review date 
		if($search_type==2){ 
			$where = ' AND date_of_next_review >="'.date('Y-m-d').'" AND date_of_next_review <= "'.$effectiveDate.'"';
		}
		// More than 3 months
		if($search_type==3){
			$where = ' AND date_of_next_review >="'.$effectiveDate.'"';
		}	
	  
	  
        $res = array();       
			
		$sql="SELECT document.id as document_id,document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, document.date_of_current_issue, document.live_revision_number, document.status, document.location, document.document_category_id,document.interval_months, document.date_of_next_review, document_category.name as cat_name,document_category.short_name, document_status,is_published  FROM `document` JOIN  document_category  ON document.document_category_id=document_category.id  ".$where." order by document.id desc";
		$query = $this->db->query($sql);
		$res = $query->result_array();
     
        return $res;
    }
	
	
	public function fetch_document_published_list($search_type=0) 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
		//After the review date 
		
		$effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
		
		$where = 'where is_published =1';
		//After the review date 
		if($search_type==1){
			$where = ' AND date_of_next_review <="'.date('Y-m-d').'"';
		}
		//With 3 months of review date 
		if($search_type==2){ 
			$where = ' AND date_of_next_review >="'.date('Y-m-d').'" AND date_of_next_review <= "'.$effectiveDate.'"';
		}
		// More than 3 months
		if($search_type==3){
			$where = ' AND date_of_next_review >="'.$effectiveDate.'"';
		}	
	  
	  
        $res = array();       
			
		$sql="SELECT document.id as document_id,document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, document.date_of_current_issue, document.live_revision_number, document.status, document.location, document.document_category_id,document.interval_months, document.date_of_next_review, document_category.name as cat_name,document_category.short_name, document_status  FROM `document` JOIN  document_category  ON document.document_category_id=document_category.id  ".$where." order by document.id desc";
		$query = $this->db->query($sql);
		$res = $query->result_array();
     
        return $res;
    }
	
	
	
	public function fetch_sharedfrom_list() 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();       
			
		$sql="SELECT document.id as document_id, document_share.id as document_share_id,document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, document.date_of_current_issue, document.live_revision_number, document.status, document.location, document.document_category_id,document.interval_months, document.date_of_next_review, document_category.name as cat_name,document_category.short_name, 	view_permission, delete_permission, download_permission, edit_permission, description  FROM `document` 
		JOIN  document_category  ON document.document_category_id=document_category.id
		JOIN  document_share  ON document.id=document_share.document_id where from_user_id =".$user_id."";
		$query = $this->db->query($sql);
		$res = $query->result_array();
        
       
        return $res;
    }
	
	
	public function fetch_sharedto_list() 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();       
			
		$sql="SELECT document.id as document_id, document_share.id as document_share_id, document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, document.date_of_current_issue, document.live_revision_number, document.status, document.location, document.document_category_id,document.interval_months, document.date_of_next_review, document_category.name as cat_name,document_category.short_name, view_permission, delete_permission, download_permission, edit_permission,description  FROM `document` 
		JOIN  document_category  ON document.document_category_id=document_category.id
		JOIN  document_share  ON document.id=document_share.document_id where to_user_id =".$user_id."";
		$query = $this->db->query($sql);
		$res = $query->result_array();
        
     
        return $res;
    }
	
	
	public function fetch_revision_list($documentId) 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();       
			
		$sql="SELECT document_revision.id, document_id,document_revision.document_number, document_revision.document_title, document_revision.document_owner_id, updated_by, document_revision.document_category_id, document_revision.date_of_1_issue, document_revision.date_of_current_issue, document_revision.live_revision_number, document_revision.status, document_revision.location, document_revision.document_category_id,document_revision.interval_months, document_revision.date_of_next_review, document_category.name as cat_name,document_category.short_name,revision_status  FROM `document_revision` 
		JOIN  document_category  ON document_revision.document_category_id=document_category.id
		where document_id =".$documentId."";
		$query = $this->db->query($sql);
		$res = $query->result_array();
       
        return $res;
    }
	
	
	
	public function fetch_viwer_list($documentId) 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();       
			
		$sql="SELECT document.id, document_id,document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, viewer_user_id, document_category.name as cat_name,document_category.short_name , document_viewers_history.created_at as vcreated_at  FROM `document` 
		JOIN  document_category  ON document.document_category_id=document_category.id
		JOIN  document_viewers_history  ON document.id=document_viewers_history.document_id
		where document_id =".$documentId."";
		$query = $this->db->query($sql);
		$res = $query->result_array();
       
        return $res;
    }
	
	
	
	public function fetch_viwer_revision($documentId) 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();       
			
		$sql="SELECT document.id, document.document_owner_id,updated_by, document_revision.created_at as vcreated_at FROM `document` JOIN document_revision ON document.id=document_revision.document_id  
		where document_id =".$documentId."";
		$query = $this->db->query($sql);
		$res = $query->result_array();
      
        return $res;
    }
	
	
	
	
	
	
	
	function getCategory(){
		
		$sql="SELECT * FROM `document_category` ";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	function getSubCategory($catId){
		
		$sql="SELECT * FROM `document_subcategory` where category_id=".$catId."";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	function getSubCategoryList(){
		
		$sql="SELECT document_subcategory.id as sid, document_category.id as cid , document_subcategory.name as sname , document_category.name as name,document_subcategory.created_at as screated_at FROM `document_subcategory` JOIN `document_category` ON  document_category.id= document_subcategory.category_id";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	
	function getIssueTo(){
		
		$sql="SELECT * FROM `document_issue_to` ";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	
	public function getUsers(){
	   	$user_id = $this->ion_auth->user()->row()->id;
		$res = array();       
			
		$sql="SELECT document.id as document_id,document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, document.date_of_current_issue, document.live_revision_number, document.status, document.location, document.document_category_id,document.interval_months, document.date_of_next_review, document_category.name as cat_name,document_category.short_name  FROM `document` JOIN  document_category  ON document.document_category_id=document_category.id";
		$query = $this->db->query($sql);
		$res = $query->result_array();
       
        return $res;
		
			
	}
	
	
	
	
	
  

  

  

  


    public function get_profile_picture($patient_id) 
    {
        $pdata = $this->db->get_where('patients', array('id' => $patient_id))->row();
        if(isset($pdata)){
            //pre($pdata);
            if(file_exists($pdata->profile_picture_path)){
                return base_url($pdata->profile_picture_path);
            }
        }

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
	
	
	
	public function fetch_document_by_id($did =0) 
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_type = $group_row->group_type;
        $group_id = $group_row->id;
	  
        $res = array();       
			
		$sql="SELECT document.id as document_id,document.document_number, document.document_title, document.document_owner_id, document.document_category_id, document.date_of_1_issue, document.date_of_current_issue, document.live_revision_number, document.status, document.location, document.document_category_id,document.interval_months, document.date_of_next_review, document_category.name as cat_name,document_category.short_name  FROM `document` JOIN  document_category  ON document.document_category_id=document_category.id where document.id=".$did."";
		$query = $this->db->query($sql);
		$res = $query->result_array();
        
        //echo $this->db->last_query(); exit; 
        return $res;
    }
	
	public function view_count($documentId=0){
		
		 return $this->db->get_where('document_viewers_history', array('document_id' => $documentId))->num_rows();
		 
	}
	
	public function getUsersByDocumentId($documentID=''){
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            "users.id as user_id",
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        if($documentID!=''){
            $this->db->join('document_share', 'document_share.to_user_id = users.id', 'left');
            $this->db->where('document_share.document_id', $documentID);
			$this->db->where('document_share.from_user_id', $userID);
        }
        $res = $this->db->get("users");
        // echo $this->db->last_query();die();
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }
	
	
	public function received_request(){
		$userID =  $this->ion_auth->user()->row()->id;
       
		$sql = "SELECT users.id as user_id, profile_picture_path, document_number,  document_title, date_of_next_review, document_share.description as sdescription, document_share.created_at as sdate
					FROM document_share 
					JOIN document ON document_share.document_id = document.id
					JOIN users ON  document.document_owner_id = users.id 					
					WHERE document_share.to_user_id = $userID";
					
					
		$query = $this->db->query($sql);
		return $query->result_array();
		
	   
       /* $this->db->select(array(
            "users.id as user_id",            
            "profile_picture_path",
			"document_number",
			"document_title"
        ));
   
		$this->db->join('document', 'document_share.document_id = document.id');	
		$this->db->join('users', 'document_share.to_user_id = users.id');
		
		$this->db->where('document_share.to_user_id', $userID);
    
        $res = $this->db->get("document_share");
        // echo $this->db->last_query();die();
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
			*/
	}
	
	
	function getDocumentComments($documnentId = 0){
			
		$sql = "SELECT document_comments.id as cid, users.id as user_id,  profile_picture_path,  document_comments.comments,  document_comments.created_at as cdate, document_comments.status as cstatus
					FROM document_comments 
					JOIN users ON  document_comments.sender_id = users.id 					
					WHERE document_comments.document_id = $documnentId";
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}
	
	
	
	
	
	
	
	
	
	
}