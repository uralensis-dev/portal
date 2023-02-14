<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    private $group_id = 0;
    private $user_id = 0;
    private $group_type = "";

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Ion_auth_model');
        $this->load->model('Tracking_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

       // track_user_activity(); //Track user activity function which logs user track actions.
        
        $this->user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $this->group_type = $group_row->group_type;
        $this->group_id = $group_row->id;
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('templates/header-new');
        $this->load->view('tracking/tracking.php');
        $this->load->view('templates/footer-new');
    }
    
    /**
     * Method: GET
     * Displaying the page to update and fetch track status of a case.
     */
    public function laboratory_track()
    {  
        if (!in_array($this->group_type, ['A', 'H', 'L','LA', 'D', 'HA'])) {
            redirect('/');
        }
        
        // Load data from model
        $data = array();
        $data['javascripts'] = array('js/tracking/qrcode.min.js', 'js/tracking/laboratory_track.js');
        $this->load->view('templates/header-new');
        $this->load->view('tracking/laboratory_track.php', $data);
        $this->load->view('templates/footer-new');
    }

    

    /**
     * Method: GET
     * Fetch record history of case, through jquery get request
     */
    public function get_record_history()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $lab_number = $this->input->get('lab_number');
        $data = array();
        $response = array();
        // Validate the input
        if (strlen($lab_number) == 0) {
            $response['status'] = 'error';   
            $response['message'] = 'No record found with this lab number';   
        } else {
            // Fetch data from model
            $record_history = $this->Tracking_model->fetch_record_history($lab_number);
            $requestData = $this->Tracking_model->getRequestData($lab_number);
            $response['requestData'] = $requestData;   
            if (gettype($record_history) != 'array') {
                $response['status'] = 'error';   
                $response['message'] = 'No record found with this lab number';
            }
            else {
                $response['status'] = 'success';
                $response['history'] = $record_history;
                $response['track_status'] = $this->Tracking_model->fetch_track_status($lab_number);
            }
        }
        header('Content-Type: application/json');
        echo json_encode( $response );
    }

    public function get_block_history()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $requestId = $this->input->get('requestId');
        $data = array();
        $response = array();
        // Validate the input
        if (strlen($requestId) == 0) {
            $response['status'] = 'error';   
            $response['message'] = 'No record found with this lab number';   
        } else {
            // Fetch data from model
            $record_history = $this->Tracking_model->fetch_record_block_history($requestId);
            if (gettype($record_history) != 'array') {
                $response['status'] = 'error';   
                $response['message'] = 'No record found with this lab number';
            }
            else {
                $response['status'] = 'success';
                $response['history'] = $record_history;
            }
        }
        header('Content-Type: application/json');
        echo json_encode( $response );
    }

    /**
     * Method: GET
     * API function that sends the generated user id as json 
     */
    public function get_userid($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
        $response = array();
        $this->load->model('Userextramodel');
        // Show user image here not ID

        $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($id);
        $profile_picture_path  = $decryptedDetails->profile_picture_path;
        $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
         

        //$user_id = $this->Userextramodel->generate_userid($id);
        // if ($user_id == NULL) {
        //     $response['status'] = 'error';
        //     $response['message'] = 'User not found';
        // }
        // else {
        //     $response['status'] = 'success';
        //     $response['userid'] = $user_id;
        // }
        // Check for user image
        if($img){
            $response['status'] = 'success';
            $response['userid'] = $img;
        }
        else{
            $response['status'] = 'error';
            $response['message'] = 'User not found';
        }
        header('Content-Type: application/json');
        echo json_encode( $response );
    }

    /**
     * Method: Post
     * Updates the track status of case by querying through lab number and returns json response
     */
    public function update_track_status() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // Receive input and validate
        $response = array();
        $lab_number = $this->input->post('lab_number');
        $status = $this->input->post('status');
        if (empty($lab_number) || empty($status)) {
            $response['status'] = 'error';
        }
        else{
            $res = $this->Tracking_model->update_track_status($lab_number, $status);
            if ($res == Null) {
                $response['status'] = 'error';
            } else {
                $response['status'] = 'success';
            }
        }

        header('Content-Type: application/json');
        echo json_encode( $response );
    }

    public function get_lab_numbers() {
        if (!in_array($this->group_type, ['H', 'A', 'L','LA','HA'])) {
            $this->output->set_status_header(405);
            return;
        }

        if ($this->group_type === 'L') {
            $hospitals = $this->db
                ->select('hospital_id')
                ->where('group_id', $this->group_id)
                ->get('hospital_group')->result_array();    
            $hospital_ids = [];
            foreach($hospitals as $h) {
                array_push($hospital_ids, $h['hospital_id']);
            }
            $ids = implode(",", $hospital_ids);
            $this->db->select('DISTINCT `lab_number`', FALSE);
            $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
            $this->db->where("`group_id` IN ($ids)", '', FALSE);
            $this->db->where('lab_number IS NOT NULL', '', FALSE);
            $lab_numbers =$this->db->get('request')->result_array();
            $lab = [];
            foreach ($lab_numbers as $ln) {
                array_push($lab, $ln['lab_number']);
            }
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($lab));
        } else {
            $this->db->select('DISTINCT `lab_number`', FALSE);
            
            if ($this->group_type === 'H') {
                $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                $this->db->where('group_id', $this->group_id);
            }
            
            $this->db->where('lab_number IS NOT NULL', '', FALSE);
            $lab_numbers =$this->db->get('request')->result_array();
            $lab = [];
            foreach ($lab_numbers as $ln) {
                array_push($lab, $ln['lab_number']);
            }
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($lab));
        }
    }
}