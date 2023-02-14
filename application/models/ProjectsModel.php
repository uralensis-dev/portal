<?php

class ProjectsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveProject($projectData){
        $sql = $this->db->set($projectData);
        $this->db->insert('projects');       
        return $this->db->insert_id();     
    }
    public function updateProject($projectData,$projectID){
        $sql = $this->db->set($projectData);
        $this->db->where('project_id',$projectID);
        $this->db->update('projects');       
        return $this->db->insert_id();     
    }
    public function getLeadList(){
        //TODO: GET APPROPRIATE TEAM LEAD LIST
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            "id as user_id",
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        $res = $this->db->get("users");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }
    public function getUsersList($groupID=''){
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            "users.id as user_id",
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        if($groupID!=''){
            $this->db->join('users_groups', 'users_groups.user_id = users.id', 'left');
            $this->db->where('users_groups.group_id', $groupID);
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


    public function getClientList(){
        $userID =  $this->ion_auth->user()->row()->id;
        $userGrp = $this->getUserGroup($userID);
        if($userGrp->group_type == 'A'){
            return $this->getHospitals();
        }elseif($userGrp->group_type == 'D'){
            // TODO: UPADTE THE FOLLOWING FUNCTION
            return $this->getPathologistHospitals();
        }else{
            return $this->getHospitals($userGrp->group_id);
        }
    }



    public function getProjectList($project_team='',$priority ='',$name=''){
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            'project_id','	project_name','project_end_date','project_lead','project_team',
            'project_desc'
        ));
        if (!$isAdmin){
            $this->db->where('created_by',$userID);
            $this->db->where('isActive','1');
        }
        //TODO:FINALIZE THE TEAM MEMBER FILTER
        if($project_team !=''){
            $this->db->where_in('project_team',$project_team);

        }
        if($priority !=''){
            $this->db->where('project_piority',$priority);
        }
        if($name !=''){
            $this->db->like('project_name',$priority,'both');
        }
        

        $res = $this->db->get("projects");
        // echo $this->db->last_query();die();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
        return array();
        }        
    }
    
    public function getUserDetails($userIds){
        if(!array($userIds)){
            $this->db->where('id',$userIds);
        }else{
            $this->db->where_in('id',$userIds);
        }

        $this->db->select(array(
            "id as user_id",
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->order_by('created_on','DESC');
        $res = $this->db->get("users");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }

    public function removeProject($projectID){
        $this->db->where('project_id',$projectID);
        $this->db->delete('projects');
    }


    private function getUserGroup($userID){
        $this->db->select(['group_id','group_type']);
        $this->db->join('groups', ' groups.id = users_groups.group_id', 'left');
        $this->db->where('user_id',$userID);
        $userGrpRES = $this->db->get('users_groups');
        if($userGrpRES->num_rows() > 0){
            $grpRSLT = $userGrpRES->row();
            return $grpRSLT;
        }
        
    }


    private function getHospitals($userGrp=''){
        if($userGrp!=''){
            $this->db->where('id', $userGrp);
        }
        $this->db->where('group_type', 'H');
        $this->db->select(array('description as client_name','id as client_id'));
        $hospitalsRES = $this->db->get('groups');
        if($hospitalsRES->num_rows() > 0){
            $grpRSLT = $hospitalsRES->result_array();
            return $grpRSLT;
        }else{
            return array();
        }
        
    }
    private function getPathologistHospitals($userID=''){
        // TODO: UPDATE THIS FUNCTION TO GET ALL 
        //       HOSPITALS where the Pathologist is Working
        if($userID!=''){
            $this->db->where('id', $userID);
        }
        $this->db->where('group_type', 'H');
        $this->db->select(array('description as client_name','id as client_id'));
        $hospitalsRES = $this->db->get('groups');
        if($hospitalsRES->num_rows() > 0){
            $grpRSLT = $hospitalsRES->result_array();
            return $grpRSLT;
        }else{
            return array();
        }
        
    }













    public function setProjectNumber($projectID,$projectType){
        $this->db->set('ticket_number', strtoupper($projectType)."-".$projectID);
        $this->db->where('project_id',$projectID);
        $this->db->update('projects');
    }   

    public function addFileData ($fileData){
        $sql = $this->db->set($fileData);
        $this->db->insert('mskss_project_attachment');       
        return $this->db->insert_id();     
    }


    


    public function getProjectData($projectID){
        $this->db->where('project_id',$projectID);
        $res = $this->db->get("projects");
        $retArr = array();
        if($res->num_rows() > 0){
            $this->db->where('attachment_project_id',$projectID);
            $res_attch = $this->db->get("mskss_project_attachment");
            if($res->num_rows() > 0){
                $retArr ['project_attach_data'] =  $res_attch->result_array();
            }
            $retArr ['project_data'] =  $res->result_array();
            return $retArr;
        }else{
            return array();
        }
    }

    public function getProjectCommentsData($projectID){
        $this->db->select(array(
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "ticket_comment_addedBy",
            "ticket_comment_addedOn",
            "ticket_comment_id",
            "ticket_comment_text",
            "comment_project_id"
        ));
        $this->db->where('comment_project_id',$projectID);
        $this->db->where('isActive','1');
        $this->db->join("users",'users.id = projects_comments.ticket_comment_addedBy','LEFT');
        $res = $this->db->get("projects_comments");
        $retArr = array();
        if($res->num_rows() > 0){
            $retArr =  $res->result_array();
            // var_dump($retArr);die();
            return $retArr;
        }else{
            return array();
        }
    }


    public function getProjectAssignee($projectID){
        $this->db->select(array(
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->where('assignee_project_id',$projectID);
        $this->db->join('users','assignee_id = users.id');
        $res = $this->db->get("mskss_ticket_assignee");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }

}