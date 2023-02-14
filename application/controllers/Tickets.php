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
class Tickets extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */

    private $group_id = 0;
    private $user_id = 0;
    private $group_type = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('TicketsModel', 'tickets');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
                
        $this->user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $this->group_type = $group_row->group_type;
        $this->group_id = $group_row->id;

    }


    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $dataSet = array();
        //---------- SAVE START----------------
        if(count($this->input->post()) > 0 ){
            if(isset($_POST['ticket_id']) && $_POST['ticket_id']!='' && is_numeric($_POST['ticket_id'])){
                $ticketSaveArr = array(
                    "ticket_type"=>$this->input->post('product'),
                    "ticket_subject"=>$this->input->post('ticket_subject'),
                    "ticket_message"=>$this->input->post('ticket_message'),
                    "ticket_priority"=>$this->input->post('ticket_priority'),
                    "ticket_reference"=>$this->input->post('ticket_reference'),
                    "ticket_cc_to"=>$this->input->post('ticket_cc_to'),
                    "ticket_reply_thru"=>$this->input->post('ticket_reply_thru'),
                    "ticket_sms_alert"=>$this->input->post('ticket_sms_alert'),
                    "ticket_mod_by"=>$this->ion_auth->user()->row()->id,
                    "ticket_mod_on"=>date("Y-m-d H:i:s")
                );
                $ticketID = $this->input->post('ticket_id');
                $assignee = $_POST['assignee'];
                if (!empty($assignee)) {

                    $this->db->where('assignee_ticket_id', $ticketID);
                    if ($this->db->get('mskss_ticket_assignee')->num_rows() > 0) {
                        $this->db->where('assignee_ticket_id', $ticketID);
                        $this->db->update('mskss_ticket_assignee', array('assignee_id' => $assignee));
                    } else {
                        $this->db->insert('mskss_ticket_assignee', array('assignee_ticket_id' => $ticketID, 'assignee_id' => $assignee));
                    }
                    $this->_notify_assignee($assignee, $ticketID);
                }
                
                $this->tickets->updateTicket($ticketSaveArr,$ticketID);
                if(isset($_FILES)){
                    $config = array(
                        'upload_path' => './uploads/tickets',
                        'allowed_types' => 'pdf|doc|docx|jpg|jpeg|png|gif',
                        'max_size' => '2048',
                        'encrypt_name' => true,
                        'multi' => 'all'
                    );
                    
                    // load Upload library
                    $this->load->library('upload',$config);
                    
                    $this->upload->do_upload('ticket_files');
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
                                "attachment_ticket_id" =>  $ticketID ,
                                "attachment_added_by" => $this->ion_auth->user()->row()->id
                            ];
                            $this->tickets->addFileData($saveArr);
                        }else{
                            foreach($uploaded as $key=> $fileData){
                                $saveArr = [
                                    "attachment_path" => $fileData['file_name'],
                                    "attachment_name" => $fileData['client_name'],
                                    "attachment_ticket_id" =>  $ticketID ,
                                    "attachment_added_by" => $this->ion_auth->user()->row()->id
                                ];
                                $this->tickets->addFileData($saveArr);
                            }
                        }
                    }
                }
                $this->session->set_flashdata('inserted',TRUE);
                $this->session->set_flashdata('tckSuccessMsg','Ticket Updated...');
                redirect('tickets/', 'refresh');
            } elseif (isset($_POST['save_type']) && $_POST['save_type']!='' && $_POST['save_type'] == 'add'){
                //---------- SAVE START----------------
                $errorControl = array();
                $errorMsgs = array();
                $error = FALSE;
                $assignee = $_POST['assignee'];
                if(isset($_POST['ticket_subject']) && $_POST['ticket_subject']=='') {
                    $error = TRUE;
                    $errorMsgs[] = 'Ticket Subject is Required.';
                }
                if(isset($_POST['ticket_message']) && $_POST['ticket_message']=='') {
                    $error = TRUE;
                    $errorMsgs[] = 'Ticket Message is Required.';
                }
                if($error) {
                    //BACK TO FORM AND SHOW ERRORS
                    $dataSet['showDiag']    = 'addDiag';
                    $dataSet['error']       = $error;
                    $dataSet['errorMsgs']   = $errorMsgs;
                } else {
                    //PERFORM ADD TO DB
                    $ticketSaveArr = array(
                        "ticket_type"=>$this->input->post('product'),
                        "ticket_subject"=>$this->input->post('ticket_subject'),
                        "ticket_message"=>$this->input->post('ticket_message'),
                        "ticket_priority"=>$this->input->post('ticket_priority'),
                        "ticket_reference"=>$this->input->post('ticket_reference'),
                        "ticket_cc_to"=>$this->input->post('ticket_cc_to'),
                        "ticket_reply_thru"=>$this->input->post('ticket_reply_thru'),
                        "ticket_sms_alert"=>$this->input->post('ticket_sms_alert'),
                        "ticket_created_by"=>$this->ion_auth->user()->row()->id
                    );

                    if ($this->group_type === 'H') {
                        
                    }

                    // INSERT TICKET INTO DB
                    $insertID = $this->tickets->saveTicket($ticketSaveArr);
                    $ticketID  =  $insertID;
                    // UPDATE THE TICKET NUMBER;
                    $this->tickets->setTicketNumber($insertID, $ticketSaveArr['ticket_type']);

                    // PROCESS FILE UPLOADS
                    if(!empty($_FILES)){
                        $config = array(
                            'upload_path' => './uploads/tickets',
                            'allowed_types' => 'pdf|doc|docx|jpg|jpeg|png|gif',
                            'max_size' => '2048',
                            'encrypt_name' => true,
                            'multi' => 'all'
                        );
                        
                        // load Upload library
                        $this->load->library('upload',$config);
                        
                        $this->upload->do_upload('ticket_files');
                        // echo '<pre>';
                        $uploaded = $this->upload->data();
                        $errors = $this->upload->display_errors();
                        // print_r( $uploaded);die("</pre>");
                        if(empty($uploaded)){
                            $error = TRUE;
                            $errorMsgs[] = $errors;
                        }else{
                            if(!is_array($uploaded[0])){
                                $saveArr = [
                                    "attachment_path" => $uploaded['file_name'],
                                    "attachment_name" => $uploaded['client_name'],
                                    "attachment_ticket_id" =>  $ticketID ,
                                    "attachment_added_by" => $this->ion_auth->user()->row()->id
                                ];
                                $this->tickets->addFileData($saveArr);
                            }else{
                                foreach($uploaded as $key=> $fileData){
                                    $saveArr = [
                                        "attachment_path" => $fileData['file_name'],
                                        "attachment_name" => $fileData['client_name'],
                                        "attachment_ticket_id" =>  $ticketID ,
                                        "attachment_added_by" => $this->ion_auth->user()->row()->id
                                    ];
                                    $this->tickets->addFileData($saveArr);
                                }
                            }
                           
                        }
                    }
                    $isAdmin = $this->ion_auth->is_admin();
                    if($isAdmin){
                        if(!empty($assignee)) {
                            $saveArr = array(
                                'assignee_ticket_id'=>$ticketID,
                                'assignee_id'=>$assignee
                            );
                            $this->db->insert('mskss_ticket_assignee', $saveArr);
                            $this->_notify_assignee($assignee, $ticketID);
                            $this->session->set_flashdata('success',TRUE);
                            $this->session->set_flashdata('tckSuccessMsg','Assignee Added');
                        }
                    }
                    $this->session->set_flashdata('inserted',TRUE);
                    $this->session->set_flashdata('tckSuccessMsg','Ticket Added...');
                    redirect('tickets/', 'refresh');
                }
            }
        }
        //---------- SAVE END----------------

        // -------------LISTING CODE START--------------
        $status = ($this->input->get('status')!='')?$this->input->get('status'):'';
        $priority = ($this->input->get('priority')!='')?$this->input->get('priority'):'';
        $from_date = ($this->input->get('from_date')!='')?$this->input->get('from_date'):'';
        $to_date = ($this->input->get('to_date')!='')?$this->input->get('to_date'):'';
        
        $dataSet['ticketsData']  = $this->tickets->getTicketList($status, $priority, $from_date, $to_date);
        $user_id = $this->ion_auth->user()->row()->id;
        $dataSet['ticketsCountData']  = $this->tickets->getCounts($user_id);
        
        // -------------LISTING CODE END  --------------
        if($this->session->flashdata('showDiag') === 'editDiag'){
            $dataSet['showDiag']     = $this->session->flashdata('showDiag');
            $dataSet['attachmentID']     = $this->session->flashdata('attachmentID') ;
            $dataSet['tckSuccessMsg']     = $this->session->flashdata('tckSuccessMsg') ;
        }
        

        $dataSet['products'] =[
            "GE"=>"General Enquiry",
            "DV"=>"Digital Viewer",
            "PH"=>"PathHub App",
            "S"=>"Servers"
        ];
        $this->session->flashdata('inserted');
        $dataSet['prvData'] = $privData ?? "";
        $this->load->view('templates/header-new');
        $this->load->view('pages/ticket',$dataSet);
        $this->load->view('templates/footer-new', array('javascripts' => array('js/auth/ticket/ticket.js')));
    }

    function changePriority($ticketID,$priority){
        if(isset($ticketID) && $ticketID!='0' && $ticketID!=''){
            switch($priority){
                case 0:
                    $priority = 'normal';
                break;
                case 1:
                    $priority = 'high';
                break;
                case 2:
                    $priority = 'critical';
                break;
                default:
                    $this->session->set_flashdata('error',TRUE);
                    $this->session->set_flashdata('tckSuccessMsg','Invalid Priority, Please Try Again.');
                    redirect('tickets/', 'refresh');
                break;
    
            }
    
            $this->db->set('ticket_priority',$priority);
            
            $this->db->where('ticket_id ', $ticketID);
            $this->db->update('mskss_tickets');
            $this->session->set_flashdata('inserted',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Ticket Priority Updated...');
            redirect('tickets/', 'refresh');
        }else{
            $this->session->set_flashdata('error',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Invalid Ticket, Please Try Again.');
            redirect('tickets/', 'refresh');
        }
       
        
    }
    function changeStatus($ticketID,$status){
        if(isset($ticketID) && $ticketID!='0' && $ticketID!=''){
            switch($status){
                case 0:
                    $status = 'open';
                break;
                case 1:
                    $status = 're_open';
                break;
                case 2:
                    $status = 'hold';
                break;
                case 3:
                    $status = 'closed';
                break;
                case 4:
                    $status = 'in_progress';
                break;
                case 5:
                    $status = 'cancelled';
                break;
                default:
                    $this->session->set_flashdata('error',TRUE);
                    $this->session->set_flashdata('tckSuccessMsg','Invalid Status, Please Try Again.');
                    redirect('tickets/', 'refresh');
                break;
    
            }
    
            $this->db->set('ticket_status',$status);
            
            $this->db->where('ticket_id ', $ticketID);
            $this->db->update('mskss_tickets');
            $this->session->set_flashdata('inserted',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Ticket Status Updated...');
            redirect('tickets/', 'refresh');
        }else{
            $this->session->set_flashdata('error',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Invalid Ticket, Please Try Again.');
            redirect('tickets/', 'refresh');
        }
       
        
    }

    function delete($ticketID){
        if(isset($ticketID) && $ticketID!='0' && $ticketID!='' && is_numeric($ticketID)){
            $this->db->set('isActive','0');

            $this->db->where('ticket_id ', $ticketID);
            $this->db->update('mskss_tickets');
            $this->session->set_flashdata('inserted',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Ticket Removed...');
            redirect('tickets/', 'refresh');


        }else{
            $this->session->set_flashdata('error',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Invalid Ticket, Please Try Again.');
            redirect('tickets/', 'refresh');
        }
    }


    public function editTicket()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $ticketID = $this->input->post('info');
        if (!empty( $ticketID) &&  $ticketID!='0' &&  $ticketID!='' && is_numeric($ticketID) ){
            $dataSet['products'] =[
                "GE"=>"General Enquiry",
                "DV"=>"Digital Viewer",
                "PH"=>"PathHub App",
                "S"=>"Servers"
            ];
            $dataSet['tckSuccessMsg'] = $this->session->flashdata('tckSuccessMsg') ;
            $dataSet['ticketData'] = $this->tickets->getTicketData($ticketID);
            $this->load->model('Userextramodel', 'users');
            $dataSet['userList'] = $this->users->getAllAdminUser();
            $this->load->view('pages/ticket_edit',$dataSet);
        }else{
            echo "<div class='text-center'><h3>INVALID TICKET....</h3></div>";
        }
    }
    public function viewTicket($ticketID)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty( $ticketID) &&  $ticketID!='0' &&  $ticketID!='' && is_numeric($ticketID) ){
            $dataSet['products'] =[
                "GE"=>"General Enquiry",
                "DV"=>"Digital Viewer",
                "PH"=>"PathHub App",
                "S"=>"Servers"
            ];
            $dataSet['tckSuccessMsg']     = $this->session->flashdata('tckSuccessMsg') ;
            $dataSet['ticketData'] = $this->tickets->getTicketData($ticketID);
            $dataSet['ticketCommentData'] = $this->tickets->getTicketCommentsData($ticketID);
            $dataSet['ticketAssignee'] = $this->tickets-> getTicketAssignee($ticketID);
            $dataSet['ticketID'] = $ticketID;

            $this->load->view('templates/header-new');
            $this->load->view('pages/ticket_view',$dataSet);
            $this->load->view('templates/footer-new');
        }else{
            show_404();
        }
    }


    public function deleteAttachment($attachmentID){

        if(isset($attachmentID) && $attachmentID!='0' && $attachmentID!='' && is_numeric($attachmentID)){
            $this->db->where('attachment_id',$attachmentID);
            $attachmentRES = $this->db->get('mskss_tickets_attachment');
            if($attachmentRES->num_rows() > 0){
                $attachData = $attachmentRES->row();
                $filePath = "./uploads/tickets/".$attachData->attachment_path;
                unset($filePath);

                $this->db->where('attachment_id',$attachmentID);
                $this->db->delete('mskss_tickets_attachment');
                $this->session->set_flashdata('showDiag','editDiag');
                $this->session->set_flashdata('attachmentID',$attachData->attachment_ticket_id);
                $this->session->set_flashdata('tckSuccessMsg','Attachment Removed');
                redirect('tickets/', 'refresh');
            }           
        }

    }


    public function deleteComment($commentID,$ticketID){
        if(isset($commentID) && $commentID!='0' && $commentID!='' && is_numeric($commentID)){
            $this->db->set('isActive','0');

            $this->db->where('ticket_comment_id ', $commentID);
            $this->db->update('mskss_tickets_comments');
        }
        redirect('tickets/viewTicket/'.$ticketID, 'refresh');
    }

    public function addComment(){
        $comment = $this->input->post('commentText');
        $ticketID = $this->input->post('ticketID');


        if(isset($ticketID) && $ticketID!='0' && $ticketID!='' && is_numeric($ticketID)){
            if($comment!=''){
                $saveArr = array(
                    'comment_ticket_id'=>$ticketID,
                    'ticket_comment_text'=>$comment,
                    'ticket_comment_addedBy'=>$this->ion_auth->user()->row()->id
                );
                $this->db->insert('mskss_tickets_comments', $saveArr);
            }
        }
        redirect('tickets/viewTicket/'.$ticketID, 'refresh');
    }
    
    public function addAssignee($assignee,$ticketID){

        $isAdmin = $this->ion_auth->is_admin();
        if($isAdmin){
            if(isset($ticketID) && $ticketID!='0' && $ticketID!='' && is_numeric($ticketID)){
                if($assignee!=''){
                    $saveArr = array(
                        'assignee_ticket_id'=>$ticketID,
                        'assignee_id'=>$assignee
                    );

                    $this->_notify_assignee($assignee, $ticketID);

                    $this->db->insert('mskss_ticket_assignee', $saveArr);
                    $this->session->set_flashdata('success',TRUE);
                    $this->session->set_flashdata('tckSuccessMsg','Assignee Added');
                }
            }else{
                $this->session->set_flashdata('error',TRUE);
                $this->session->set_flashdata('tckSuccessMsg','Invalid Data...');
            }
        }else{
            $this->session->set_flashdata('error',TRUE);
            $this->session->set_flashdata('tckSuccessMsg','Invalid Access...');
        }
        redirect('tickets/viewTicket/'.$ticketID, 'refresh');
    }

    private function _notify_assignee($user_id, $ticket_id) {
        $this->load->model('Userextramodel', 'users');
        $user = $this->users->getUserDecryptedDetailsByid($user_id);
        $ticket = $this->tickets->getTicketData($ticket_id);
        $requestor = $this->users->getUserDecryptedDetailsByid($ticket['ticket_data'][0]['ticket_created_by']);
        
        $message_data = array('user' => $user, 'requestor'=>$requestor, 'ticket' =>$ticket['ticket_data'][0]);
        $message = $this->load->view('support/ticket_email.php', $message_data, TRUE);
        $whitelist = [
            // IPv4 address
            '127.0.0.1',

            // IPv6 address
            '::1'
        ];
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            custom_log($message, "Ticket message");
        } else {
            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',  //iso-8859-1
                'newline' =>  '\r\n',
                'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from('info@uralensiswebapp.co.uk'); // change it to yours
            $this->email->reply_to('info@uralensiswebapp.co.uk', 'Pathhub Support Team');
            $this->email->cc('dev@oxbridgemedica.com');
            $this->email->to($user->email); // change it to yours
            $this->email->subject('Support Ticket Assign notification');
            // $mesg = $this->load->view('auth/pinemailtemplate',$dataTemp,true);
            $this->email->message($message);

            //$this->email->message($mesg);
            if ($this->email->send()) {

                $set_auth_cookie = array(
                    'name' => 'temp_access_token_validation_' . $user_id,
                    'value' => $user_id,
                    'expire' => '100'
                );
                $this->input->set_cookie($set_auth_cookie);

                $json['type'] = 'success';
                $json['msg'] = 'One time token sent to registered email';
                return TRUE;
            }
            return FALSE;
        }
    }

    public function userList(){
        $is_admin = $this->ion_auth->is_admin();
        if (!$is_admin) {
            $this->output->set_status_header(405)
            ->set_output(json_encode(array("message" => "Not Authorized")));
            return;
        }
        $this->load->model('Userextramodel', 'users');
        $admins = $this->users->getAllAdminUser();
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($admins));
        
    }
}