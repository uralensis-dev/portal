<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class Project extends CI_Controller
{
    
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('ProjectsModel','projects');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }
    
    public function dashboard()
    {
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $dataSet['userList'] = $this->projects->getUsersList();
        $dataSet['clientList'] = $this->projects->getClientList();
        $project_team = ($this->input->get('project_users_srch')!='')?$this->input->get('project_users_srch'):'';
        $priority = ($this->input->get('project_priority_srch')!='')?$this->input->get('project_priority_srch'):'';
        $name = ($this->input->get('project_name_srch')!='')?$this->input->get('project_name_srch'):'';

        $dataSet['projectList'] = $this->projects->getProjectList($project_team,$priority,$name);
        $this->load->view('project/inc/header-new');
        $this->load->view('project/dashboard', $dataSet);
        $this->load->view('project/inc/footer-new');
    }
    public function tasks()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('project/inc/header-new');
        $this->load->view('project/tasks', $dataSet);
        $this->load->view('project/inc/footer-new');
    }
    public function task_board()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('project/inc/header-new');
        $this->load->view('project/task-board', $dataSet);
        $this->load->view('project/inc/footer-new');
    }

    public function saveData(){
  
        $projectID = $this->input->post('project_id');
        $projectData = array();
        $projectData['project_name'] = $this->input->post('project_name');
        $projectData['client_id'] = $this->input->post('client_id');
        $projectData['project_start_date'] = date("Y-m-d",strtotime($this->input->post('project_start_date')));
        $projectData['project_end_date'] = date("Y-m-d",strtotime($this->input->post('project_end_date')));
        $projectData['project_rate'] = $this->input->post('project_rate');
        $projectData['project_rate_type'] = $this->input->post('project_rate_type');
        $projectData['project_piority'] = $this->input->post('project_piority');
        $projectData['project_lead'] = $this->input->post('project_lead');
        $projectData['project_team']=implode(',',$this->input->post('project_team'));
        $projectData['project_desc'] = $this->input->post('project_desc');
        $projectData['created_by'] =  $this->ion_auth->user()->row()->id;
        $isUpdate = FALSE;
        if($projectID !='' && $projectID!=0){
            $this->projects->updateProject($projectData,$projectID);
            $isUpdate = TRUE;
        }else{
            $projectData['created_on'] = date("Y-m-d H:i:s");
            $projectID = $this->projects->saveProject($projectData);
        }

        if(isset($_FILES)){
            $config = array(
                'upload_path' => './uploads/project_files',
                'allowed_types' => 'pdf|doc|docx|jpg|jpeg|png|gif|txt',
                'max_size' => '2048',
                'encrypt_name' => true,
                'multi' => 'all'
            );
            
            // load Upload library
            $this->load->library('upload',$config);
            
            $this->upload->do_upload('project_attachments');
            // echo '<pre>';
            $uploaded = $this->upload->data();
            $errors = $this->upload->display_errors();
            if(!empty($errors)){
                $error = TRUE;
                $errorMsgs[] = $errors;
            }else{
                if(!is_array($uploaded[0])){
                    $saveArr = [
                        "attachment_path" => $uploaded['file_name'],
                        "attachment_name" => $uploaded['client_name'],
                        "attachment_project_id" =>  $projectID ,
                        "attachment_added_by" => $this->ion_auth->user()->row()->id
                    ];
                    $this->projects->addFileData($saveArr);
                }else{
                    foreach($uploaded as $key=> $fileData){
                        $saveArr = [
                            "attachment_path" => $fileData['file_name'],
                            "attachment_name" => $fileData['client_name'],
                            "attachment_project_id" =>  $projectID ,
                            "attachment_added_by" => $this->ion_auth->user()->row()->id
                        ];
                        $this->projects->addFileData($saveArr);
                    }
                }
            }
        }

        $this->session->set_flashdata('inserted',TRUE);
        if($isUpdate){
            $this->session->set_flashdata('tckSuccessMsg','Project Updated...');
        }else{
            $this->session->set_flashdata('tckSuccessMsg','Project Added...');
        }
        redirect('project/dashboard/', 'refresh');
    }

    public function getProjectData($projectID=''){
        $projectID = $this->input->post('projectID');
        $projectData = $this->projects->getProjectData($projectID);
        echo json_encode($projectData);
        die();
    }

    public function removeAttachment(){
        $attachmentID = $this->input->post('attachmentID');
        if(is_numeric($attachmentID)){
            $this->db->where('attachment_id',$attachmentID);
            $attachRES = $this->db->get('mskss_project_attachment');
            if($attachRES->num_rows()>0){
                $attachRES = $attachRES->result();
                unlink('./uploads/project_files' . $attachRES->attachment_path);
                $this->db->where('attachment_id',$attachmentID);
                $this->db->delete('mskss_project_attachment');
            }
            echo json_encode(array('sts'=>'success'));
        }else{
            echo json_encode(array('sts'=>'error'));
        }
    }


    public function removeProject(){
        $projectID  = $this->input->post('project_id'); 
        if($projectID!='' && is_numeric($projectID)){
            $this->projects->removeProject($projectID);
            $this->session->set_flashdata('type','success');
            $this->session->set_flashdata('tckSuccessMsg','Project Removed...');
        }else{
            $this->session->set_flashdata('type','error');
            $this->session->set_flashdata('tckSuccessMsg','In-Valid Project ID...');
        }
        $this->session->set_flashdata('inserted',TRUE);
        redirect('project/dashboard/', 'refresh');
    }


    public function getUsers(){
        $groupID = $this->input->post('group_id');
        $userListData = $this->projects->getUsersList($groupID);
        echo json_encode($userListData);
        die();
    }
    
}