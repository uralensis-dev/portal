<?php

class RotaModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveRota($teamData){
        $sql = $this->db->set($teamData);
        $this->db->insert('tbl_events');       
        return $this->db->insert_id();     
    }

    public function updateRota($rotaData, $rotaID){
        $sql = $this->db->set($rotaData);
        $this->db->where('event_id',$rotaID);
        $this->db->update('tbl_events');       
        return $this->db->insert_id();         
    }
    public function saveRotaCategory($Data){
        $sql = $this->db->set($Data);
        $this->db->insert('tbl_rota_category');       
        return $this->db->insert_id();     
    }
    public function saveRotaInnerCategory($Data){
        $sql = $this->db->set($Data);
        $this->db->insert('tbl_rota_inner_category');       
        return $this->db->insert_id();     
    }
    public function updateRotaCategory($Data,$ID){
        $sql = $this->db->set($Data);
        $this->db->where('rota_category_id',$ID);
        $this->db->update('tbl_rota_inner_category');       
        return $this->db->insert_id();     
    }
    public function updateRotaInnerCategory($Data,$ID){
        $sql = $this->db->set($Data);
        $this->db->where('rota_inner_category_id',$ID);
        $this->db->update('tbl_rota_inner_category');       
        return $this->db->insert_id();     
    }
    public function updateTeam($teamData,$teamID){
        $sql = $this->db->set($teamData);
        $this->db->where('team_id',$teamID);
        $this->db->update('tbl_teams');       
        return $this->db->insert_id();     
    }
    public function getRotaCategoryList(){
        //TODO: GET APPROPRIATE TEAM LEAD LIST
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select('*');
        $res = $this->db->get("tbl_rota_category");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }
    public function getRotaInnerCategoryList(){
        //TODO: GET APPROPRIATE TEAM LEAD LIST
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select('*');
        $res = $this->db->get("tbl_rota_inner_category");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
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



    public function getTeamList($team_name,$group_id,$user_id){
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select('*');
        $this->db->from('tbl_teams');
        if (!$isAdmin){
            $this->db->where('tbl_teams.created_by',$userID);
        }        
        
        if($team_name!='') {
            $this->db->like('team_name',$team_name);
        }
        if($group_id!='') {
            $this->db->where(" find_in_set('$group_id',group_id) <> 0 ");
        }
        if($user_id!='') {
            $this->db->like('team_leader',$user_id);
            $this->db->like('deputy_team_leader',$user_id);
            $this->db->like("  find_in_set('$user_id',group_id) <> 0  ");
        }
        $res = $this->db->get();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
        return array();
        }        
    }
    
    public function getGroupName($groupIds){
        if(!array($groupIds)){
            $this->db->where('id',$groupIds);
        }else{
            $this->db->where_in('id',$groupIds);
        }

        $this->db->select('name');
        $res = $this->db->get("groups");
        $retArr = array();
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

    public function removeTeam($teamID){
        $this->db->where('team_id',$teamID);
        $this->db->delete('tbl_teams');
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













    public function setTeamNumber($teamID,$teamType){
        $this->db->set('ticket_number', strtoupper($teamType)."-".$teamID);
        $this->db->where('team_id',$teamID);
        $this->db->update('teams');
    }   

    public function addFileData ($fileData){
        $sql = $this->db->set($fileData);
        $this->db->insert('mskss_team_attachment');       
        return $this->db->insert_id();     
    }


    


    public function getTeamData($teamID){
        $this->db->where('team_id',$teamID);
        $res = $this->db->get("teams");
        $retArr = array();
        if($res->num_rows() > 0){
            $this->db->where('attachment_team_id',$teamID);
            $res_attch = $this->db->get("mskss_team_attachment");
            if($res->num_rows() > 0){
                $retArr ['team_attach_data'] =  $res_attch->result_array();
            }
            $retArr ['team_data'] =  $res->result_array();
            return $retArr;
        }else{
            return array();
        }
    }

    public function getTeamCommentsData($teamID){
        $this->db->select(array(
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "ticket_comment_addedBy",
            "ticket_comment_addedOn",
            "ticket_comment_id",
            "ticket_comment_text",
            "comment_team_id"
        ));
        $this->db->where('comment_team_id',$teamID);
        $this->db->where('isActive','1');
        $this->db->join("users",'users.id = teams_comments.ticket_comment_addedBy','LEFT');
        $res = $this->db->get("teams_comments");
        $retArr = array();
        if($res->num_rows() > 0){
            $retArr =  $res->result_array();
            // var_dump($retArr);die();
            return $retArr;
        }else{
            return array();
        }
    }


    public function getTeamAssignee($teamID){
        $this->db->select(array(
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->where('assignee_team_id',$teamID);
        $this->db->join('users','assignee_id = users.id');
        $res = $this->db->get("mskss_ticket_assignee");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }

    public function removeRotaCategory($ID){
        $this->db->where('rota_category_id',$ID);
        $this->db->delete('tbl_rota_category');
    }

    public function removeRotaInnerCategory($ID){
        $this->db->where('rota_inner_category_id',$ID);
        $this->db->delete('tbl_rota_inner_category');
    }

}