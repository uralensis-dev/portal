<?php

class TicketsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveTicket($ticketData){
        $sql = $this->db->set($ticketData);
        $this->db->insert('mskss_tickets');       
        return $this->db->insert_id();     
    }
    public function updateTicket($ticketData,$ticketID){
        $sql = $this->db->set($ticketData);
        $this->db->where('ticket_id',$ticketID);
        $this->db->update('mskss_tickets');       
        return $this->db->insert_id();     
    }

    public function setTicketNumber($ticketID,$ticketType){
        $this->db->set('ticket_number', strtoupper($ticketType)."-".$ticketID);
        $this->db->where('ticket_id',$ticketID);
        $this->db->update('mskss_tickets');
    }   

    public function addFileData ($fileData){
        $sql = $this->db->set($fileData);
        $this->db->insert('mskss_tickets_attachment');       
        return $this->db->insert_id();     
    }


    public function getTicketList($status='',$priority ='',$from_date='',$to_date=''){
        $userID =  $this->ion_auth->user()->row()->id;
        $isAdmin = $this->ion_auth->is_admin();
        $this->db->select(array(
            'ticket_id','ticket_number','ticket_type','ticket_subject','ticket_priority',
            'ticket_status',"ticket_created_by","ticket_created_on","ticket_mod_on"
        ));
        if (!$isAdmin){
            $this->db->where('ticket_created_by',$userID);
            $this->db->where('isActive','1');
        }
        if($status !=''){
            $this->db->where('ticket_status',$status);

        }
        if($priority !=''){
            $this->db->where('ticket_priority',$priority);
        }
        if($from_date !='' && $to_date !=''){
            $this->db->where('DATE(ticket_created_on) >=', date("Y-m-d",strtotime($from_date)));
            $this->db->where('DATE(ticket_created_on) <=', date("Y-m-d",strtotime($to_date)));
        }else{
            if($from_date !=''){
                $this->db->where('DATE(ticket_created_on,"%d-%m-%Y") =', date("Y-m-d",strtotime($from_date)));
            }
        }

        $res = $this->db->get("mskss_tickets");
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
        return array();
        }
       
        
    }

    public function getTicketData($ticketID, $hospital_id='') {
        $this->db->where('ticket_id',$ticketID);
        if (!empty($hospital_id)) {
            $this->db->where('hospital_id', $hospital_id);
        }
        $res = $this->db->get("mskss_tickets");
        $retArr = array();
        if($res->num_rows() > 0){
            $this->db->where('attachment_ticket_id',$ticketID);
            $res_attach = $this->db->get("mskss_tickets_attachment");
            if($res->num_rows() > 0){
                $retArr ['ticket_attach_data'] =  $res_attach->result_array();
            }
            $retArr ['ticket_data'] =  $res->result_array();
            return $retArr;
        }else{
            return array();
        }
    }

    public function getTicketCommentsData($ticketID){
        $this->db->select(array(
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "ticket_comment_addedBy",
            "ticket_comment_addedOn",
            "ticket_comment_id",
            "ticket_comment_text",
            "comment_ticket_id"
        ));
        $this->db->where('comment_ticket_id',$ticketID);
        $this->db->where('isActive','1');
        $this->db->join("users",'users.id = mskss_tickets_comments.ticket_comment_addedBy','LEFT');
        $res = $this->db->get("mskss_tickets_comments");
        $retArr = array();
        if($res->num_rows() > 0){
            $retArr =  $res->result_array();
            // var_dump($retArr);die();
            return $retArr;
        }else{
            return array();
        }
    }


    public function getTicketAssignee($ticketID){
        $this->db->select(array(
            "aes_decrypt(users.first_name, '".DATA_KEY."') AS enc_first_name",
            "aes_decrypt(users.last_name, '".DATA_KEY."') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->where('assignee_ticket_id',$ticketID);
        $this->db->join('users','assignee_id = users.id');
        $res = $this->db->get("mskss_ticket_assignee");
        $retArr = array();
        if($res->num_rows() > 0){
            return $res->result_array();
        }else{
            return array();
        }
    }


    public function getCounts($userID){
        $isAdmin = $this->ion_auth->is_admin();
        if(!$isAdmin){
            $this->db->where('ticket_created_by',$userID);
            $this->db->where('isActive','1');
        }
        $ttlCntRES =  $this->db->get('mskss_tickets'); 
        $retArr['total'] = $ttlCntRES->num_rows();
       
       
        $isAdmin = $this->ion_auth->is_admin();
        if(!$isAdmin){
            $this->db->where('ticket_created_by',$userID);
            $this->db->where('isActive','1');
        }
        $this->db->join("mskss_ticket_assignee",'mskss_ticket_assignee.assignee_ticket_id = mskss_tickets.	ticket_id','INNER');
        $newRES =  $this->db->get('mskss_tickets'); 
        $retArr['new'] = $newRES->num_rows();
        $retArr['new'] = $retArr['total'] - $newRES->num_rows();


        if(!$isAdmin){
            $this->db->where('ticket_created_by',$userID);
            $this->db->where('isActive','1');
        }
        $this->db->where('ticket_status','closed');
        $closedCntRES =  $this->db->get('mskss_tickets'); 
        $retArr['closed'] = $closedCntRES->num_rows();
    
    
        if(!$isAdmin){
            $this->db->where('ticket_created_by',$userID);
            $this->db->where('isActive','1');
        }
        $this->db->where('ticket_status','in_progress');
        $inprogressRES =  $this->db->get('mskss_tickets'); 
        $retArr['in_progress'] = $inprogressRES->num_rows();

        if(!$isAdmin){
            $this->db->where('ticket_created_by',$userID);
            $this->db->where('isActive','1');
        }
        $this->db->where_in('ticket_status',array('open','in_progress','on_hold'));
        $pendingCntRES =  $this->db->get('mskss_tickets'); 
        $retArr['pending'] = $pendingCntRES->num_rows();
        
        return $retArr;        
    }

     /**
     * All MDT Cases Display Model
     *
     *
     * @return array
     */
    public function mdt_cases_list_model()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM request
                INNER JOIN users_request
                INNER JOIN groups
                INNER JOIN request_assignee
                INNER JOIN uralensis_mdt_dates
                INNER JOIN uralensis_mdt_records
                WHERE users_request.request_id = request.uralensis_request_id
                AND request.uralensis_request_id = request_assignee.request_id
                AND uralensis_mdt_records.record_id = request.uralensis_request_id
                AND groups.id = users_request.group_id
                AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') = uralensis_mdt_records.mdt_date
                GROUP BY request.uralensis_request_id ORDER BY request.publish_datetime DESC, request.uralensis_request_id DESC";
       
            $query = $this->db->query($sql);
            
            return $query->result();
        
    }
}