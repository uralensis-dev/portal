<?php

class LabEnquiriesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isLabAdmin() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->select('group_type');
        $this->db->from('users_groups');
        $this->db->join('groups', '`groups`.`id` = `users_groups`.`group_id`');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        if (empty($result))
            return FALSE;
        if ($result[0]['group_type'] === 'L' or $result[0]['group_type'] === 'LA' or $result[0]['group_type'] === 'DE' or $result[0]['group_type'] === 'LS') {
            return TRUE;
        }
        return FALSE;
    }

    public function getAllAdminUser() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;

        $sqlQuery = "SELECT AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                             AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                             profile_picture_path,users.id
                         FROM `users`
                          JOIN users_groups ON users_groups.user_id=users.id
                          where user_id in (select user_id from users_groups inner join `groups` on `groups`.`id` = users_groups.group_id where groups.group_type IN ('LA','DE','LS'))
                         and institute_id = $laboratoryId and group_id is NULL";


        return $this->db->query($sqlQuery)->result_array();
        echo $this->db->last_query();
        exit;


        $this->db->select("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name");
        $this->db->select("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name");
        $this->db->select("profile_picture_path");
        $this->db->select("users.id");
        $this->db->from('users');
        $this->db->join("users_groups", "users_groups.user_id = users.id");
        $this->db->where("group_id IN ()");
        $temp = $this->db->get()->result_array();



        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->select('group_type');
        $this->db->from('users_groups');
        $this->db->join('groups', '`groups`.`id` = `users_groups`.`group_id`');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result))
            return FALSE;
        if ($result[0]['group_type'] === 'LA' or $result[0]['group_type'] === 'DE' or $result[0]['group_type'] === 'LS') {
            return TRUE;
        }
        return FALSE;
    }

    public function saveTicket($ticketData)
    {
        $sql = $this->db->set($ticketData);
        $this->db->insert('lab_enquiries');
        return $this->db->insert_id();
    }

    public function updateTicket($ticketData, $ticketID)
    {
        $sql = $this->db->set($ticketData);
        $this->db->where('ticket_id', $ticketID);
        $this->db->update('lab_enquiries');
        return $this->db->insert_id();
    }

    public function setTicketNumber($ticketID, $ticketType)
    {
        $this->db->set('ticket_number', strtoupper($ticketType) . "-" . $ticketID);
        $this->db->where('ticket_id', $ticketID);
        $this->db->update('lab_enquiries');
    }

    public function addFileData($fileData)
    {
        $sql = $this->db->set($fileData);
        $this->db->insert('lab_enquiries_attachment');
        return $this->db->insert_id();
    }


    public function getTicketList($status = '', $priority = '', $star_end_date = '')
    {
        $userID = $this->ion_auth->user()->row()->id;
        if($this->isLabAdmin())
		{
            $isAdmin = TRUE;
            $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
        }
        $this->db->select(array(
            'ticket_id', 'ticket_number', 'ticket_type', 'ticket_subject', 'ticket_message', 'ticket_priority',
            'ticket_status', "ticket_created_by", "ticket_created_on", "ticket_mod_on", "category_id"
        ));
        if (!$isAdmin) 
		{
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        } 
		else 
		{
            $this->db->where('lab_id', $laboratoryId);
        }
        if ($status != '') {
            $this->db->where('ticket_status', $status);

        }
        if ($priority != '') {
            $this->db->where('ticket_priority', $priority);
        }
        if ($star_end_date != '') {
            $star_end_date = explode(" - ",$star_end_date);
            $this->db->where('DATE(ticket_created_on) >=', date("Y-m-d", strtotime($star_end_date[0])));
            $this->db->where('DATE(ticket_created_on) <=', date("Y-m-d", strtotime($star_end_date[1])));
        }

        $res = $this->db->get("lab_enquiries");
		//print $this->db->last_query();
		//exit;
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }


    }

    public function getFurtherWorkTicketList($status = '', $priority = '', $star_end_date = ''){
        $userID = $this->ion_auth->user()->row()->id;
        if($this->isLabAdmin())
        {
            $isAdmin = TRUE;
            $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
        }
        $this->db->select(array(
            'ticket_id', 'ticket_number', 'ticket_type', 'ticket_subject','ticket_message', 'ticket_priority',
            'ticket_status', "ticket_created_by", "ticket_created_on", "ticket_mod_on"
        ));
        if (!$isAdmin)
        {
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        }
        else
        {
            $this->db->where('lab_id', $laboratoryId);
        }
        $this->db->where('record_type', 'FW');
        if ($status != '') {
            $this->db->where('ticket_status', $status);

        }
        if ($priority != '') {
            $this->db->where('ticket_priority', $priority);
        }
        if ($star_end_date != '') {
            $star_end_date = explode(" - ",$star_end_date);
            $this->db->where('DATE(ticket_created_on) >=', date("Y-m-d", strtotime($star_end_date[0])));
            $this->db->where('DATE(ticket_created_on) <=', date("Y-m-d", strtotime($star_end_date[1])));
        }

        $res = $this->db->get("lab_enquiries");
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function getTicketListForRecord($doctorId,$recordId)
    {
        $this->db->select(array(
            'ticket_id', 'ticket_number', 'ticket_type', 'ticket_subject', 'ticket_priority',
            'ticket_status', "ticket_created_by", "ticket_created_on", "ticket_mod_on"
        ));
        $this->db->where('ticket_created_by', $doctorId);
        $this->db->where('record_id', $recordId);
        $this->db->where('isActive', '1');


        $res = $this->db->get("lab_enquiries");
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }


    }

    public function getTicketData($ticketID, $hospital_id = '')
    {
        $this->db->where('ticket_id', $ticketID);
        if (!empty($hospital_id)) {
            $this->db->where('hospital_id', $hospital_id);
        }
        $res = $this->db->get("lab_enquiries");
        $retArr = array();
        if ($res->num_rows() > 0) {
            $this->db->where('attachment_ticket_id', $ticketID);
            $res_attach = $this->db->get("lab_enquiries_attachment");
            if ($res->num_rows() > 0) {
                $retArr ['ticket_attach_data'] = $res_attach->result_array();
            }
            $retArr ['ticket_data'] = $res->result_array();
            return $retArr;
        } else {
            return array();
        }
    }

    public function getTicketCommentsData($ticketID)
    {
        $this->db->select(array(
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "ticket_comment_addedBy",
            "ticket_comment_addedOn",
            "ticket_comment_id",
            "ticket_comment_text",
            "comment_ticket_id"
        ));
        $this->db->where('comment_ticket_id', $ticketID);
        $this->db->where('isActive', '1');
        $this->db->join("users", 'users.id = lab_enquiries_comments.ticket_comment_addedBy', 'LEFT');
        $res = $this->db->get("lab_enquiries_comments");
        $retArr = array();
        if ($res->num_rows() > 0) {
            $retArr = $res->result_array();
            // var_dump($retArr);die();
            return $retArr;
        } else {
            return array();
        }
    }


    public function getTicketAssignee($ticketID)
    {
        $this->db->select(array(
            "aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name",
            "aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name",
            "profile_picture_path"
        ));
        $this->db->where('assignee_ticket_id', $ticketID);
        $this->db->join('users', 'assignee_id = users.id');
        $res = $this->db->get("lab_enquiries_assignee");
        $retArr = array();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }


    public function getCounts($userID)
    {
        if($this->isLabAdmin()){
            $isAdmin = $this->isLabAdmin();
            $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
        }
        if (!$isAdmin) {
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        } else {
            $laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
            $this->db->where('lab_id', $laboratoryId);
        }
        $ttlCntRES = $this->db->get('lab_enquiries');
        $retArr['total'] = $ttlCntRES->num_rows();

        if (!$isAdmin) {
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        } else {
            $this->db->where('lab_id', $laboratoryId);
        }
        $this->db->join("lab_enquiries_assignee", 'lab_enquiries_assignee.assignee_ticket_id = lab_enquiries.	ticket_id', 'INNER');
        $newRES = $this->db->get('lab_enquiries');
        $retArr['new'] = $newRES->num_rows();
        $retArr['new'] = $retArr['total'] - $newRES->num_rows();


        if (!$isAdmin) {
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        } else {
            $this->db->where('lab_id', $laboratoryId);
        }
        $this->db->where('ticket_status', 'closed');
        $closedCntRES = $this->db->get('lab_enquiries');
        $retArr['closed'] = $closedCntRES->num_rows();


        if (!$isAdmin) {
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        } else {
            $this->db->where('lab_id', $laboratoryId);
        }
        $this->db->where('ticket_status', 'in_progress');
        $inprogressRES = $this->db->get('lab_enquiries');
        $retArr['in_progress'] = $inprogressRES->num_rows();

        if (!$isAdmin) {
            $this->db->where('ticket_created_by', $userID);
            $this->db->where('isActive', '1');
        } else {
            $this->db->where('lab_id', $laboratoryId);
        }
        $this->db->where_in('ticket_status', array('open', 'in_progress', 'on_hold'));
        $pendingCntRES = $this->db->get('lab_enquiries');
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