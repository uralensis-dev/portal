<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Doccument list Controller
 *
 * @package    CI
 * @subpackage Controller
 */
class Document_List extends CI_Controller
{

    private $h_data = array('styles' => array('css/linearicons.css', 'css/patient/style.css'));
	private $f_data = array('javascripts' => array('js/document_list/document_list.js'));
	
	
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
        $this->load->model('Document_List_Model', 'Document_List_Model');
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
		
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();
		
		
		$data['searchtype'] = $searchtype;
		//echo "<pre>"; print_r($data["user_info"]);
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/document_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }
	
	public function get_document_list($searchtype=0)
    {
        $data = array('data' => array());
        $res = $this->Document_List_Model->fetch_document_list($searchtype);
		 $this->load->model('Userextramodel');
		//echo "<pre>"; print_r($res);
		$no_r = 0;
        foreach ($res as $row) 
		{	
           $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['document_owner_id']);
		   $profile_picture_path  = $decryptedDetails->profile_picture_path;
		   $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
		   
		   $viewCout = $this->Document_List_Model->view_count($row['document_id']);
		   
		   $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
		   $rowClss = '';
		   //After the review date 
		   if($row['date_of_next_review']<=date('Y-m-d')){
			  $rowClss = 'row_red'; 
		   }
		   //With 3 months of review date 
		   if($row['date_of_next_review'] >=date('Y-m-d') && $row['date_of_next_review']<=$effectiveDate){
			  $rowClss = 'row_orange'; 
		   }
		   // More than 3 months
		   if($row['date_of_next_review']>= $effectiveDate ){
			  $rowClss = 'row_green'; 
		   }
		   
            
            $document = array(
                'id' => $row['document_id'],
				'document_number' => '#'.$row['document_number'].'<br> '.$row['document_title'],
				'document_title' => $row['document_title'],
				'document_owner' => $img,
				'viewCout'=>$viewCout,
				'document_category' => $row['cat_name'],
				'date_of_1_issue' => $row['date_of_1_issue'],
				'date_of_current_issue' => $row['date_of_current_issue'],
				'live_revision_number' => $row['live_revision_number'],
				'status' => ($row['status'])?'Live':'Obsolete',
				'location' => $row['location'],
				'type' => $row['short_name'],
				'interval_months' => $row['interval_months'].' M',
				'date_of_next_review' => $row['date_of_next_review'],   
				'rowClss'=> $rowClss,	
				'document_status'=>$row['document_status'],
				'Rcount' => $no_r,
				'document_published' => $row['is_published'],
            );
            array_push($data['data'], $document);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	
	
	
	function getSubCategory($catId=1){
		
		$categoey = $this->Document_List_Model->getSubCategory($catId);
		$option = '';
		foreach($categoey as $row){
			
			$option .= '<option values="'.$row['id'].'">'.$row['name'].'</option>';
		}
		echo $option;
		
	}
	
	public function view($id, $action = "", $field = "")
    {
        switch ($action) 
		{
            case "update":
                $this->_update_patient($id, $field);
				
                break;
            case "delete":
                $this->_delete_document($id);
				
                break;
            case "":
                $this->_show_view_page($id);
				
                break;
            default:
                $this->_show_view_page($id);
        }
    }
	
	private function _delete_document($id)
    {
		if($id!='')
		{
			$count = $this->db->get_where('document', array('id' => $id))->num_rows();
			if($count > 0)
			{
				$this->db->where('id', $id);
				$this->db->delete('document');
			}
			// Delete document information
			$this->db->where('document_id', $id);
    		$this->db->delete('document_information');

    		// Delete document revision
			$this->db->where('document_id', $id);
    		$this->db->delete('document_revision');

    		// Delete document revision
			$this->db->where('document_id', $id);
    		$this->db->delete('document_share');

    		// Delete document Uploaded forms
			$this->db->where('document_id', $id);
    		$this->db->delete('document_upload_forms');

    		// Delete document Uploaded Viewrs
			$this->db->where('document_id', $id);
    		$this->db->delete('document_viewers');

    		// Delete document viewers history
			$this->db->where('document_id', $id);
    		$this->db->delete('document_viewers_history');
		}  
		redirect("/Document_List", "refresh");
		exit;
    }
	
	
	public function delete_bulk_document(){
        $pt_ids = $this->input->post('patient_id');        
        if(!empty($pt_ids))
		{            
			for($i=0; $i<count($pt_ids); $i++){
                $count = $this->db->get_where('document', array('id' => $pt_ids[$i]))->num_rows();                
                if($count >0)
                {
                    $this->db->where('id', $pt_ids[$i]);
                    $this->db->delete('document');
                }
            }
		}
		redirect("/Document_List", "refresh");exit;
    }
	
	public function document_section($documentId=0)
	{ 
		if($documentId==0){	
			$data['page_title'] = 'Create New Document';
		}else{
			$data['page_title'] = 'Edit Document';
		}
	
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['issueTo'] = $this->Document_List_Model->getIssueTo();
		$data['users'] = $this->Document_List_Model->getUsers(); 		
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();

		// Get subcategpry here
		$data['sub_cat'] = $this->Document_List_Model->getSubCategoryList();		
		$data['status'] =  array(1=>'Live',2=>'Obsolete');
		$data['interval_months'] =  array(12=>' 12 M',24=>'24 M',36=>'36 M');
	
	    $this->form_validation->set_rules('document_number', 'document_number', 'required');
            $user_id = $this->ion_auth->user()->row()->id;

            

            if ($this->form_validation->run() == TRUE ) {
				
				$fieldsArr = array('submit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }elseif($key=='date_of_1_issue'){
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }else if($key=='date_of_current_issue'){					   
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }
				   else if($key=='revised_review_date'){					   
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }
				   else{
                        $formData[$key] = $values;
					}
				}
				
				$da = "+".$formData['interval_months']." months";
				
				$date_of_next_review = date('Y-m-d', strtotime($da, strtotime($formData['date_of_current_issue'])));
				
				$formData['date_of_next_review']  = $date_of_next_review;
				
				if($documentId==0){
					$formData['document_owner_id']  = $user_id;
					$formData['created_by'] = $user_id ;
					$formData['created_at'] = date("Y-m-d H:i:s");
					
					$this->db->insert('document', $formData);
					$lastId = $this->db->insert_id();
					
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Document added successfully.');
					redirect('/Document_List', 'refresh');
					
				}else{
					// print_r($formData); die;
					$this->db->update('document', $formData,array('id'=>$documentId));
										
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Document Updated successfully.');
					redirect('/Document_List', 'refresh');
				}
				 
			
            }
		
		
		$result = $this->db->where('id',$documentId)->get('document')->row_array();
		$data['result'] = $result;
		$userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
		$data['loginUsername'] = $userinfo[0]->first_name . ' ' . $userinfo[0]->last_name;
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/document_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
	
	
	}
	
	
	
	public function share_document()
    {
        if ($this->input->is_ajax_request()) {          
            $user_id = $this->ion_auth->user()->row()->id;
				$fieldsArr = array('btnSubmit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }
				   else{
					   if($key=='to_user_id'){
						  $userArr =  $values;
					   }else{
						$formData[$key] = $values;
					   }
					}
				}
				
				if(!empty($userArr)){
					foreach($userArr as $row){
					$formData['from_user_id']  = $user_id;
					$formData['to_user_id']  = $row;
					$formData['created_by'] = $user_id;
					
					$formData['created_at'] = date("Y-m-d H:i:s");
					
					$this->db->insert('document_share', $formData);
					}
				} 
				 
				 $lastId =1;
				 if( $lastId){
					  echo json_encode(['lastId'=>$lastId,'type' => 'success', 'msg' => 'Document shared successfully.']);
				 }else{
					  echo json_encode(['lastId'=>0,'type' => 'error', 'msg' => 'Something went wrong, Please Try Again..!']);
				 }
            
        }else{
            echo json_encode(['type' => 'error', 'msg' => 'Something went wrong, Please Try Again..!']);
        }
        die;
    }
	
	
	public function shared_list(){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        
        $data['group_type'] = $group_type;
		
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['issueTo'] = $this->Document_List_Model->getIssueTo();
		$data['users'] = $this->Document_List_Model->getUsers(); 		
		
		
		/*if(in_array($group_type,LAB_GROUP))
		{
           $data['hospitals'] = $this->patient->fetch_hospitals();        
		}
		else
		{
		$data['hospitals'] = $this->patient->fetch_hospitals(); 	
		}*/

		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/shared_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	
	
	public function get_sharedfrom_list()
    {
        $data = array('data' => array());
        $res = $this->Document_List_Model->fetch_sharedfrom_list();
		 $this->load->model('Userextramodel');
		//echo "<pre>"; print_r($res);
		$no_r = 0;
        foreach ($res as $row) 
		{	
           $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['document_owner_id']);
		   $profile_picture_path  = $decryptedDetails->profile_picture_path;
		   $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
            
            $document = array(
                'id' => $row['document_share_id'],
				'document_id' => $row['document_id'],
				'view_permission' => $row['view_permission'],
				'delete_permission' => $row['delete_permission'],
				'download_permission' => $row['download_permission'],
				'edit_permission' => $row['edit_permission'],
				'document_number' => '#'.$row['document_number'].'<br>'.$row['document_title'],
				'document_title' => $row['document_title'],
				'document_owner' => $img,
				'document_category' => $row['cat_name'],
				'date_of_1_issue' => $row['date_of_1_issue'],
				'date_of_current_issue' => $row['date_of_current_issue'],
				'live_revision_number' => $row['live_revision_number'],
				'status' => ($row['status'])?'Live':'Obsolete',
				'location' => $row['location'],
				'type' => $row['short_name'],
				'interval_months' => $row['interval_months'].'M',
				'date_of_next_review' => $row['date_of_next_review'],
				'description' => $row['description'],                  
				'Rcount' => $no_r,
            );
            array_push($data['data'], $document);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	
	public function get_sharedto_list()
    {
        $data = array('data' => array());
        $res = $this->Document_List_Model->fetch_sharedto_list();
		 $this->load->model('Userextramodel');
		//echo "<pre>"; print_r($res);
		$no_r = 0;
        foreach ($res as $row) 
		{	
           $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['document_owner_id']);
		   $profile_picture_path  = $decryptedDetails->profile_picture_path;
		   $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
            
            $document = array(
                'id' => $row['document_share_id'],
				'document_id' => $row['document_id'],
				'view_permission' => $row['view_permission'],
				'delete_permission' => $row['delete_permission'],
				'download_permission' => $row['download_permission'],
				'edit_permission' => $row['edit_permission'],
				'document_number' => '#'.$row['document_number'].'<br>'.$row['document_title'],
				'document_title' => $row['document_title'],
				'document_owner' => $img,
				'document_category' => $row['cat_name'],
				'date_of_1_issue' => $row['date_of_1_issue'],
				'date_of_current_issue' => $row['date_of_current_issue'],
				'live_revision_number' => $row['live_revision_number'],
				'status' => ($row['status'])?'Live':'Obsolete',
				'location' => $row['location'],
				'type' => $row['short_name'],
				'interval_months' => $row['interval_months'],
				'date_of_next_review' => $row['date_of_next_review'],  
				'description' => $row['description'],  	
				'Rcount' => $no_r,
            );
            array_push($data['data'], $document);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	
	public function delete_shared($id){
		
		if($id!='')
		{
			$count = $this->db->get_where('document_share', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$user_id = $this->ion_auth->user()->row()->id; 
				
				$formDataV['viewer_user_id']  = $user_id;
				$formDataV['document_id'] = $documentId;
				$formDataV['created_by'] = $user_id;		
				$this->db->insert('document_viewers_history', $formDataV);
				
				
				$this->db->where('id', $id);
				$this->db->delete('document_share');
			}
		}  
		redirect("/Document_List/shared_list", "refresh");
		exit;
		
	}
	
	
	
	public function getUsersByDocumentIdByAjax($documentId =0 ){
		
		if ($this->input->is_ajax_request()) {
			
			$users  = $this->Document_List_Model->getUsersByDocumentId($documentId);
			
			
			$bedge = '';
			
			foreach($users as $row){
				$name = $row['enc_first_name']." ".$row['enc_last_name'];
				$id = $row['user_id']."_".$documentId;
				$spnId = 'user_'.$id; 
				$bedge .= '<span id="'.$spnId.'" class="badge badge-secondary mr-2">'.$name.' <span><a class="remove_bedge" id="'.$id.'" href="">X</a> </span></span>';
			}
			
			echo $bedge;			
		}		
	}
	
	
	public function document_share_section($documentId=0)
	{ 
		if($documentId==0){	
			$data['page_title'] = 'Add Document';
		}else{
			$data['page_title'] = 'Edit Document';
		}
		
		
	
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['issueTo'] = $this->Document_List_Model->getIssueTo();
		$data['users'] = $this->Document_List_Model->getUsers(); 		
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();
		
		
		
		
		
		$data['status'] =  array(1=>'Live',2=>'Obsolete');
		$data['interval_months'] =  array(12=>' 12 M',24=>'24 M',36=>'36 M');
	
	    $this->form_validation->set_rules('document_number', 'document_number', 'required');
            $user_id = $this->ion_auth->user()->row()->id;         

            if ($this->form_validation->run() == TRUE ) {
				
				$fieldsArr = array('submit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }elseif($key=='date_of_1_issue'){
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }else if($key=='date_of_current_issue'){					   
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }
				   else if($key=='revised_review_date'){					   
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }
				   else{
                        $formData[$key] = $values;
					}
				}
				
				$da = "+".$formData['interval_months']." months";
				
				$date_of_next_review = date('Y-m-d', strtotime($da, strtotime($formData['date_of_current_issue'])));
				
				//$formData['date_of_next_review']  = $date_of_next_review;
				
				
				$formData['document_id']  = $documentId;
				$formData['updated_by'] = $user_id;
				
				$formData['document_owner_id']  = $user_id;
				$formData['created_by'] = $user_id;
				$formData['created_at'] = date("Y-m-d H:i:s");
				
				$this->db->insert('document_revision', $formData);
				$lastId = $this->db->insert_id();
				
				 
				 if( $lastId){
					 
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Document added successfully.');
					redirect('/Document_List/shared_list', 'refresh');
					 
					
				 }else{
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','error');
					$this->session->set_flashdata('message','Invalid Data, Please Try Again.');
					redirect('/Document_List/document_section/0', 'refresh');
					 
				 }
            }
		
		
		$result = $this->db->where('id',$documentId)->get('document')->row_array();
		$data['result'] = $result;
		
		$formDataV['viewer_user_id']  = $user_id;
		$formDataV['document_id'] = $documentId;
		$formDataV['created_by'] = $user_id;		
		$this->db->insert('document_viewers_history', $formDataV);	
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/document_section_share', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	
	public function document_revision($documentId=0){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['issueTo'] = $this->Document_List_Model->getIssueTo();
		$data['users'] = $this->Document_List_Model->getUsers(); 		
		
		$res = $this->Document_List_Model->fetch_revision_list($documentId);
		$this->load->model('Userextramodel');
		//echo "<pre>"; print_r($res);
		$no_r = 0;
		$result =  array();
        foreach ($res as $row) 
		{	
            $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['updated_by']);
		    $profile_picture_path  = $decryptedDetails->profile_picture_path;
			$img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
		$row['img'] = $img;
		$result[] = $row;	
		}
		
		$data['result'] = $result;
		$data['documentId'] = $documentId;

		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/revision_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	public function document_revision_verify($revisionId=0)
	{ 
		if($revisionId==0){	
			$data['page_title'] = 'Add Document';
		}else{
			$data['page_title'] = 'Verify Document';
		}
	
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['issueTo'] = $this->Document_List_Model->getIssueTo();
		$data['users'] = $this->Document_List_Model->getUsers(); 		
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();
		
		$result = $this->db->where('id',$revisionId)->get('document_revision')->row_array();
		$data['result'] = $result;
		
		$data['status'] =  array(1=>'Live',2=>'Obsolete');
		$data['interval_months'] =  array(12=>' 12 M',24=>'24 M',36=>'36 M');
	
	    $this->form_validation->set_rules('document_number', 'document_number', 'required');
            $user_id = $this->ion_auth->user()->row()->id;         

            if ($this->form_validation->run() == TRUE ) {
				
				$fieldsArr = array('submit');
				$approved = $reject = 0;
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){
					
                   }elseif($key=='date_of_1_issue'){
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }else if($key=='date_of_current_issue'){					   
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }
				   else if($key=='revised_review_date'){					   
					   $formData[$key] = date("Y-m-d",strtotime($values));
				   }else if($key=='approved'){
					   $approved = 1;
				   }
				   else if($key=='reject'){
					   
					  $reject = 1;  
				   }
				   
				   else{
                        $formData[$key] = $values;
					}
				}
				
				if($reject==1){
					$formDataup['revision_status'] = 1;
					$this->db->update('document_revision', $formDataup,array('id'=>$revisionId));
					
					$formDataupShare['revision_status'] = 1;
					$this->db->update('document_share', $formDataupShare,array('document_id'=>$result['document_id'],'to_user_id'=>$result['updated_by']));
					
					$this->session->set_flashdata('showMessage',true);
				    $this->session->set_flashdata('type','success');
				    $this->session->set_flashdata('message','Document update successfully.');
				    redirect('/Document_List/document_revision/'.$result['document_id'], 'refresh');
					
					
				}
				
				if($approved==1){
					$this->db->update('document', $formData,array('id'=>$result['document_id']));
					
					$formDataupShare['revision_status'] = 2;
					$this->db->update('document_revision', $formDataupShare,array('id'=>$revisionId));
					
					$formDataup['revision_status'] = 2;
					$this->db->update('document_share', $formDataup,array('document_id'=>$result['document_id'],'to_user_id'=>$result['updated_by']));
					
					
					$this->session->set_flashdata('showMessage',true);
				    $this->session->set_flashdata('type','success');
				    $this->session->set_flashdata('message','Document update successfully.');
				    redirect('/Document_List', 'refresh');
					
				}
				
            }
				
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/document_section_verify', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	
	public function document_viewer($documentId=0){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['issueTo'] = $this->Document_List_Model->getIssueTo();
		$data['users'] = $this->Document_List_Model->getUsers(); 		
		
		$res = $this->Document_List_Model->fetch_viwer_list($documentId);
		$this->load->model('Userextramodel');
		//echo "<pre>"; print_r($res);
		$no_r = 0;
		$result =  array();
        foreach ($res as $row) 
		{	
            $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['document_owner_id']);
		    $profile_picture_path  = $decryptedDetails->profile_picture_path;
			$img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
			$row['img'] = $img;
			$row['owner'] = $decryptedDetails->first_name.' '.$decryptedDetails->last_name;
		
		
			$decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['viewer_user_id']);
			$profile_picture_path  = $decryptedDetails->profile_picture_path;
			$img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
			$row['imgv'] = $img;
			$row['ownerv'] = $decryptedDetails->first_name.' '.$decryptedDetails->last_name;
		
		
			$result[] = $row;	
		}
		
		$data['result'] = $result;
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/viewer_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	
	public function category_list(){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		$data['result'] = $this->Document_List_Model->getCategory(); 
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/category_list', $data);
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
					$this->db->insert('document_category', $formData);
					
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Category added successfully.');
					redirect('/Document_List/category_list', 'refresh');
				 
				 
				}else{
					
					$this->db->update('document_category', $formData,array('id'=>$categoryId));
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Category Updated successfully.');
					redirect('/Document_List/category_list', 'refresh');
					
				}
				
            }
		
		
		$result = $this->db->where('id',$categoryId)->get('document_category')->row_array();
		$data['result'] = $result;
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/categoey_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	function delete_category($id){
		
		if($id!='')
		{
			$count = $this->db->get_where('document_category', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$this->db->where('id', $id);
				$this->db->delete('document_category');
				
				$this->session->set_flashdata('showMessage',true);
				$this->session->set_flashdata('type','success');
				$this->session->set_flashdata('message','Category delete successfully.');
				
			}
		}  
		redirect("/Document_List/category_list", "refresh");
		exit;
		
		
	}
	
	
		
	public function sub_category_list(){
		
		
		$data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;        
        $data['group_type'] = $group_type;
		$data['result'] = $this->Document_List_Model->getSubCategoryList(); 
				
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/sub_category_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
	}
	
	function sub_category_section($categoryId=0,$subcategoryId=0){
	
		if($subcategoryId==0){	
			$data['page_title'] = 'Add Sub Category';
		}else{
			$data['page_title'] = 'Edit Sub Category';
		}
		
	    $this->form_validation->set_rules('name', 'Name', 'required');
		 $this->form_validation->set_rules('category_id', 'Category', 'required');
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
				
				if($subcategoryId==0){	
				
					$formData['created_by'] = $user_id;
					$formData['created_at'] = date("Y-m-d H:i:s");
					$this->db->insert('document_subcategory', $formData);
					
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Sub Category added successfully.');
					redirect('/Document_List/sub_category_list', 'refresh');
				 
				 
				}else{
					
					$this->db->update('document_subcategory', $formData,array('id'=>$subcategoryId));
					$this->session->set_flashdata('showMessage',true);
					$this->session->set_flashdata('type','success');
					$this->session->set_flashdata('message','Sub Category Updated successfully.');
					redirect('/Document_List/sub_category_list', 'refresh');
					
				}
				
            }
		
		
		$result = $this->db->where('id',$subcategoryId)->get('document_subcategory')->row_array();
		$data['result'] = $result;
		$data['category'] = $this->Document_List_Model->getCategory(); 
		$data['categoryId'] = $categoryId;
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/sub_categoey_section', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
	}
	
	function delete_sub_category($id){
		
		if($id!='')
		{
			$count = $this->db->get_where('document_subcategory', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$this->db->where('id', $id);
				$this->db->delete('document_subcategory');
				$this->session->set_flashdata('showMessage',true);
				$this->session->set_flashdata('type','success');
				$this->session->set_flashdata('message','Sub Category delete successfully.');
				
			}
		}  
		redirect("/Document_List/sub_category_list", "refresh");
		exit;
		
		
	}
	
	public function delete_revision($id,$documentId){
		
	  if($id!='')
		{
			$count = $this->db->get_where('document_revision', array('id' => $id))->num_rows();
			if($count > 0)
			{
				
				$this->db->where('id', $id);
				$this->db->delete('document_revision');
				$this->session->set_flashdata('showMessage',true);
				$this->session->set_flashdata('type','success');
				$this->session->set_flashdata('message','Document Revision delete successfully.');
				
			}
		}  
		redirect("/Document_List/document_revision/".$documentId, "refresh");
		exit;
	}
	
	function statusChange($id,$status){
	
		$this->db->update('document', array('document_status'=>$status),array('id'=>$id));
		$this->session->set_flashdata('showMessage',true);
		$this->session->set_flashdata('type','success');
		$this->session->set_flashdata('message','Status Updated successfully.');
		redirect('/Document_List', 'refresh');
		
	}
	
	
	function publishDocument($id,$status){
	
		$this->db->update('document', array('is_published'=>$status),array('id'=>$id));
		$this->session->set_flashdata('showMessage',true);
		$this->session->set_flashdata('type','success');
		$this->session->set_flashdata('message','Documents publeshed successfully.');
		redirect('/Document_List', 'refresh');
		
	}
	
	
	
	public function published($searchtype = 0)
    {   	     
        $data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        
        $data['group_type'] = $group_type;
		
		$this->load->model('Laboratory_model');
		$data["user_info"] = $this->Laboratory_model->get_lab_users();
		
		$data['searchtype'] = $searchtype;
		//echo "<pre>"; print_r($data["user_info"]);
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/publeshed_list', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }
	
	public function get_publeshed_list($searchtype=0)
    {
        $data = array('data' => array());
        $res = $this->Document_List_Model->fetch_document_published_list($searchtype);
		 $this->load->model('Userextramodel');
		//echo "<pre>"; print_r($res);
		$no_r = 0;
        foreach ($res as $row) 
		{	
           $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['document_owner_id']);
		   $profile_picture_path  = $decryptedDetails->profile_picture_path;
		   $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
		   
		   $viewCout = $this->Document_List_Model->view_count($row['document_id']);
		   
		   $effectiveDate = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
		   $rowClss = '';
		   //After the review date 
		   if($row['date_of_next_review']<=date('Y-m-d')){
			  $rowClss = 'row_red'; 
		   }
		   //With 3 months of review date 
		   if($row['date_of_next_review'] >=date('Y-m-d') && $row['date_of_next_review']<=$effectiveDate){
			  $rowClss = 'row_orange'; 
		   }
		   // More than 3 months
		   if($row['date_of_next_review']>= $effectiveDate ){
			  $rowClss = 'row_green'; 
		   }
		   
            
            $document = array(
                'id' => $row['document_id'],
				'document_number' => '#'.$row['document_number'].'<br> '.$row['document_title'],
				'document_title' => $row['document_title'],
				'document_owner' => $img,
				'viewCout'=>$viewCout,
				'document_category' => $row['cat_name'],
				'date_of_1_issue' => $row['date_of_1_issue'],
				'date_of_current_issue' => $row['date_of_current_issue'],
				'live_revision_number' => $row['live_revision_number'],
				'status' => ($row['status'])?'Live':'Obsolete',
				'location' => $row['location'],
				'type' => $row['short_name'],
				'interval_months' => $row['interval_months'].' M',
				'date_of_next_review' => $row['date_of_next_review'],   
				'rowClss'=> $rowClss,	
				'document_status'=>$row['document_status'],
				'Rcount' => $no_r,
            );
            array_push($data['data'], $document);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
	
	
	public function comments_send()
    {
        if ($this->input->is_ajax_request()) {          
            $user_id = $this->ion_auth->user()->row()->id;
				$fieldsArr = array('btnSubmit');
				foreach($this->input->post() as $key=>$values) {
                if(in_array($key, $fieldsArr)){					
                   }
				   else{
						$formData[$key] = $values;
					   
					}
				}
				
				if(!empty($formData)){
					$formData['sender_id']  = $user_id;
					$formData['created_by'] = $user_id;
					$formData['created_at'] = date("Y-m-d H:i:s");
					$this->db->insert('document_comments', $formData);
					
				} 
				 
				 $lastId =1;
				 if( $lastId){
					  echo json_encode(['lastId'=>$lastId,'type' => 'success', 'msg' => 'Commets send successfully.']);
				 }else{
					  echo json_encode(['lastId'=>0,'type' => 'error', 'msg' => 'Something went wrong, Please Try Again..!']);
				 }
            
        }else{
            echo json_encode(['type' => 'error', 'msg' => 'Something went wrong, Please Try Again..!']);
        }
        die;
    }
	
	
	
	function commments($document_id=0){
		
		$comments = $this->Document_List_Model->getDocumentComments($document_id);		
		     
		$data['statusArr'] = array(1=>'Modify',2=>'Reject');	
		$data['comments'] = $comments;		
		
		$data['document'] = $this->db->get_where('document', array('id' => $document_id))->row_array();
		$data['user_info'] = $this->Userextramodel->getUserDecryptedDetailsByid($data['document']['document_owner_id']);
		 
		
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('document_list/document_comments', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);	
		
		
		
	}
	
	function updateCommetsStatus($documentId,$status){
		
		if ($this->input->is_ajax_request()) {
			if(!empty($documentId)){
				
				$formDataupShare['status'] = $status;
				$this->db->update('document_comments', $formDataupShare,array('id'=>$documentId));
				
			}
		 

		}
		
		
	}


	




}
