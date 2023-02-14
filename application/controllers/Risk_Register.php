<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Doccument list Controller
 *
 * @package    CI
 * @subpackage Controller
 */
class Risk_Register extends CI_Controller
{

    private $h_data = array('styles' => array('css/linearicons.css', 'css/patient/style.css'));
	private $f_data = array('javascripts' => array('js/risk_register/risk_register.js'));
	
	
	 /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
		
		/*error_reporting(E_ALL);
		ini_set('display_errors', 1);*/
		
        $this->load->database();
        // Libs and helper
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language', 'cookie', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->model('Risk_Register_Model', 'Risk_Register_Model');
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            return redirect('', 'refresh');
        }
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        if ($group_type != 'A' && $group_type != 'D' && $group_type != 'H' && $group_type != 'HA' && $group_type != 'L') 
		{
            //return redirect('', 'refresh');
        }
		$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }
	
	 
	public function index($searchtype = 0)
    {   	     
        $data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $data['group_type'] = $group_type;
		 $this->load->model('Userextramodel');		
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();
			
		$user =array();	
		foreach($data["user_info"] as $row){
				$user[$row['id']] =  $row['first_name']." ".$row['last_name']; 
		}
		
		
		$data['user'] =  $user;
				
		$res = $this->Risk_Register_Model->fetch_list();
		$result = array();
		foreach($res as $row){
			
			 $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['owner_id']);
		   $profile_picture_path  = $decryptedDetails->profile_picture_path;
		   $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
		 
			// Get last revision date here

			$lastRevionDate = $this->db->select('next_revision_date')->order_by('id','DESC')->get_where('risk_comment', array('risk_id' => $row['riskId']))->row()->next_revision_date;
			$row['next_revision_date'] = $lastRevionDate;

			
			$row['img'] = $img;
			$result[] =  $row;
			
			
		}
		$data['result'] = $result; 

		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/risk_register_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }
	
	public function risk_register_view($riskid){

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$comment = $this->input->post('add_comment');
			$user_id = $this->ion_auth->user()->row()->id;
			$severty = $this->input->post('severty');
			$next_revision_date = $this->input->post('next_revision_date');
			 $insData = array(
                'risk_id'=>$riskid,
                'user_id'=>$user_id,
                'comment'=>$comment,
                'severty' => $severty,
                'next_revision_date' => $next_revision_date
            );
            $this->db->insert('risk_comment',$insData);
            redirect('/Risk_Register', 'refresh');	
		}
		$result = $this->db->select('id as Risk ID,project_name as Project Name,date_raised as Date Raised,risk_description as Risk Description,mitigating_actions as Mitigating Actions,status,date_closed as Date Closed,risk_ref as Risk Reference,risk_source as Risk Source,current_controls as Current Controls,risk_cons as Risk CONS,likely,risk_score as Risk Score,risk_level,action_plan_progress as Action Plan and Progress,risk_cost as Cost')->where('id',$riskid)->get('risk_register')->row_array();
		$data['result'] = $result;
		$data['severity'] = $this->Risk_Register_Model->getSeverity(); 
		if(isset($result['risk_register_category_id']))
		$data['subcategoey'] = $this->Risk_Register_Model->getSubCategory($result['risk_register_category_id']);

		// Get comments 
		$comment = $this->db->where('risk_id',$riskid)->order_by('id','ASC')->get('risk_comment')->result_array();
		$commentWithImage = array();
		foreach ($comment as $key => $value) {

			// Get user Image here
			$decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($value['user_id']);
		   	$profile_picture_path  = $decryptedDetails->profile_picture_path;
		   	$img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
		   	$value['user_img'] = $img;
		   	// COmment with user image
		   	$commentWithImage[] =  $value;

		}
		$data['comment'] = $commentWithImage;
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/risk_register_view', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
	}
	
	function getSubCategory($catId=1){
	
	$categoey = $this->Risk_Register_Model->getSubCategory($catId);
	$option = '<option values="">Select Sub Category</option>';
	foreach($categoey as $row){
		
		$option .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
	echo $option;
		
	}
	
	public function risk_register_section($riskid=0){
		
		if($riskid==0){	
			$data['page_title'] = 'Add Risk Register';
		}else{
			$data['page_title'] = 'Edit Risk Register';
		}
		
		$data['category'] = $this->Risk_Register_Model->getCategory();		
		$data['likelihood'] = $this->Risk_Register_Model->getLikelihood(); 
		$data['impact'] = $this->Risk_Register_Model->getImpact(); 
		$data['severity'] = $this->Risk_Register_Model->getSeverity(); 	
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();
		$data['status'] = array(1=>'Open',2=>'Closed');
		
			$user_id = $this->ion_auth->user()->row()->id;
		
			$this->form_validation->set_rules('project_name', 'project_name', 'required');	
			if ($this->form_validation->run() == TRUE ){
				$fieldsArr = array('btnSubmit');
				foreach($this->input->post() as $key=>$values) {
				if(in_array($key, $fieldsArr)){
					
				   }else if($key=='date_closed'){
					 $formData[$key] = date("Y-m-d",strtotime($values));  
				   }else if($key=='date_raised'){
					 $formData[$key] = date("Y-m-d",strtotime($values));  
				   }
				   else{
						$formData[$key] = $values;
						   							
					}
				}
				if($riskid==0){
				
					$formData['owner_id']  = $user_id;
					$formData['created_by'] = $user_id ;
					$formData['created_at'] = date("Y-m-d H:i:s");
					$this->db->insert('risk_register', $formData);
					$this->session->set_flashdata('success','Risk Register added successfully.');
					
				}else{
				
					$this->db->update('risk_register', $formData,array('id'=>$riskid));
					$this->session->set_flashdata('success','Risk Register update successfully.');
					
				}		
				
				redirect('/Risk_Register', 'refresh');				
			}
		
		$result = $this->db->where('id',$riskid)->get('risk_register')->row_array();
		$data['result'] = $result;
		if(isset($result['risk_register_category_id'])){
		$data['subcategoey'] = $this->Risk_Register_Model->getSubCategory($result['risk_register_category_id']);
		}
		
		
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/risk_register_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
		
	}
	
	public function delete_record($id){
		if($id!='')
		{
			$count = $this->db->get_where('risk_register', array('id' => $id))->num_rows();
			if($count > 0)
			{
				$this->db->where('id', $id);
				$this->db->delete('risk_register');
				
				
				$this->session->set_flashdata('success','Record deleted.');
				
			}
		}
		redirect("/Risk_Register", "refresh");
		exit;
		
	}
	
	
	
	public function category_list(){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		$data['result'] = $this->Risk_Register_Model->getCategory(); 
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/category_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	function category_section($categoryId=0){
	
		if($categoryId==0){	
			$data['page_title'] = 'Add Category';
		}else{
			$data['page_title'] = 'Edit Category';
		}
		
	    $this->form_validation->set_rules('name', 'Category Name', 'required');
            $user_id = $this->ion_auth->user()->row()->id;         

            if ($this->form_validation->run() == TRUE ) {
				
				$fieldsArr = array('submit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }
				   else{
                        $formData[$key] = $values;
					}
				}
				
				if($categoryId==0){	
				
					$formData['created_by'] = $user_id;
					$formData['created_at'] = date("Y-m-d H:i:s");
					$this->db->insert('risk_register_category', $formData);
					
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Category added successfully.');
					redirect('/Risk_Register/category_list', 'refresh');
				 
				 
				}else{
					
					$this->db->update('risk_register_category', $formData,array('id'=>$categoryId));
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Category Updated successfully.');
					redirect('/Risk_Register/category_list', 'refresh');
					
				}
				
            }
		
		
		$result = $this->db->where('id',$categoryId)->get('risk_register_category')->row_array();
		$data['result'] = $result;
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/categoey_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	function delete_category($id){
		
		if($id!='')
		{
			$count = $this->db->get_where('risk_register_category', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$this->db->where('id', $id);
				$this->db->delete('risk_register_category');
				
				$this->session->set_flashdata('showMessage',true);
				$this->session->set_flashdata('type','success');
				$this->session->set_flashdata('message','Category delete successfully.');
				
			}
		}  
		redirect("/Risk_Register/category_list", "refresh");
		exit;
		
		
	}
	
	
		
	public function sub_category_list(){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		$data['result'] = $this->Risk_Register_Model->getSubCategoryList(); 
		
		
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/sub_category_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	function sub_category_section($categoryId=0){
	
		if($categoryId==0){	
			$data['page_title'] = 'Add Sub Category';
		}else{
			$data['page_title'] = 'Edit Sub Category';
		}
		
	    $this->form_validation->set_rules('name', 'Name', 'required');
		 $this->form_validation->set_rules('risk_register_category_id', 'Category', 'required');
            $user_id = $this->ion_auth->user()->row()->id;         

            if ($this->form_validation->run() == TRUE ) {
				
				$fieldsArr = array('submit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }
				   else{
                        $formData[$key] = $values;
					}
				}
				
				if($categoryId==0){	
				
					$formData['created_by'] = $user_id;
					$formData['created_at'] = date("Y-m-d H:i:s");
					$this->db->insert('risk_register_sub_category', $formData);
					
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Sub Category added successfully.');
					redirect('/Risk_Register/sub_category_list', 'refresh');
				 
				 
				}else{
					
					$this->db->update('risk_register_sub_category', $formData,array('id'=>$categoryId));
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Sub Category Updated successfully.');
					redirect('/Risk_Register/sub_category_list', 'refresh');
					
				}
				
            }
		
		
		$result = $this->db->where('id',$categoryId)->get('risk_register_sub_category')->row_array();
		$data['result'] = $result;
		
		$data['category'] = $this->Risk_Register_Model->getCategory(); 
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/sub_categoey_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	function delete_sub_category($id){
		
		if($id!='')
		{
			$count = $this->db->get_where('risk_register_sub_category', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$this->db->where('id', $id);
				$this->db->delete('risk_register_sub_category');
				$this->session->set_flashdata('showMessage',true);
				$this->session->set_flashdata('type','success');
				$this->session->set_flashdata('message','Sub Category delete successfully.');
				
			}
		}  
		redirect("/Risk_Register/sub_category_list", "refresh");
		exit;
		
		
	}
	
	
	
	public function severity_list(){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		$data['result'] = $this->Risk_Register_Model->getSeverity(); 
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/severity_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	function severity_section($categoryId=0){
	
		if($categoryId==0){	
			$data['page_title'] = 'Add Severity';
		}else{
			$data['page_title'] = 'Edit Severity';
		}
		
	    $this->form_validation->set_rules('name', 'Severity Name', 'required');
            $user_id = $this->ion_auth->user()->row()->id;         

            if ($this->form_validation->run() == TRUE ) {
				
				$fieldsArr = array('submit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }
				   else{
                        $formData[$key] = $values;
					}
				}
				
				if($categoryId==0){	
				
					$formData['created_by'] = $user_id;
					$formData['created_at'] = date("Y-m-d H:i:s");
					$this->db->insert('risk_register_severity', $formData);
					
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Severity added successfully.');
					redirect('/Risk_Register/severity_list', 'refresh');
				 
				 
				}else{
					
					$this->db->update('risk_register_severity', $formData,array('id'=>$categoryId));
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Severity Updated successfully.');
					redirect('/Risk_Register/severity_list', 'refresh');
					
				}
				
            }
		
		
		$result = $this->db->where('id',$categoryId)->get('risk_register_severity')->row_array();
		$data['result'] = $result;
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('risk_register/severity_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	function delete_Severity($id){
		
		if($id!='')
		{
			$count = $this->db->get_where('risk_register_severity', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$this->db->where('id', $id);
				$this->db->delete('risk_register_severity');
				
				$this->session->set_flashdata('showMessage',true);
				$this->session->set_flashdata('type','success');
				$this->session->set_flashdata('message','Severity delete successfully.');
				
			}
		}  
		redirect("/Risk_Register/Severity_list", "refresh");
		exit;
		
		
	}
	
	
	
	
	
	
	

}
