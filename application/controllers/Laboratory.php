<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Laboratory Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class Laboratory extends CI_Controller {

    private $group_id = 0;
    private $user_id = 0;
    private $group_type = "";

    /**
     * Constructor to load models and helpers
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Laboratory_model', 'lab');
        $this->load->helper(array('url', 'activity_helper'));
        $this->load->model('Doctor_model');
        $this->load->model('Institute_model');
        $this->load->model('Pm_model');
        $this->load->model('invoice_model');
        $this->load->model('billing_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'datasets_helper', 'ec_helper'));
        $this->load->library('email');
        // $this->load->library('word');
        $this->load->helper("file");
        $this->load->model('Userextramodel');
        $this->load->model('Laboratory_model');
        $this->load->model('Admin_model');
        track_user_activity();

        $this->user_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $this->group_type = $group_row->group_type;
        $this->group_id = $group_row->id;
    }

    /**
     * Dashboard Function
     * Load Dashboard View
     *
     * @return void
     */
    public function index() 
	{
        $data['javascripts'] = array(
            'js/custom_js/laboratory_dashboard.js',
        );
        $data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $this->ion_auth->user()->row()->id;
        $groupType = $this->ion_auth->get_users_groups()->row()->group_type;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_id = $group_row->id; // hospital ID

        $lab_information = $this->Laboratory_model->get_lab_information($group_id);
        $data["status_count"] = $this->Doctor_model->lab_record_counts_by_status($lab_id);
        $data['lab_info'] = $lab_information;
        $data["firstRowCounts"] = $this->Admin_model->getDashboardFirstRowCount();
        $data["hospital_list"] = $this->Admin_model->getLaboratoryHospitals($group_id);
		$data["hospital_count"] = $this->Admin_model->getLaboratoryHospitalsCount($group_id);
		
        $data["hospital_networks"] = $this->Admin_model->getHospitalNetworks();
        $data['upload_docs'] = $this->Laboratory_model->get_upload_doc_forms();

        $data["pathologist"] = $this->Userextramodel->getAllusersForadmin($group_id);
		$data["team"] = $this->Laboratory_model->get_lab_team_count($group_id);
		$data["is_hospital_admin"] = ($groupType == 'LA' || $groupType == 'A') ? true : false;
        //$data["pathologist"] = $this->Institute_model->get_pathologists($group_id);
        $data['new'] = $this->db->query("SELECT * FROM tbl_courier where status='COURIER REQUEST'")->num_rows();
        $data['ackoweldge'] = $this->db->query("SELECT * FROM tbl_courier where status='ACKNOWLEDGE'")->num_rows();
        $this->load->view('laboratory/inc/header-new');
        $this->load->view('laboratory/dashboard', $data);
        $this->load->view('laboratory/inc/footer-new');
    }
    public function get_counter(){
        $data['reported'] = uralensis_get_Labrecord_status_counter('reported', 'return_me');
        $data['unreported'] = uralensis_get_Labrecord_status_counter('unreported', 'return_me');
        $data['further_work'] = uralensis_get_further_work_data();
        //$data['inbox_msg'] = count(uralensis_get_total_inbox_msg());
        $data['notification'] = count(getNotificationCount($this->input->get('user_id')));
        echo json_encode($data);
        exit;        
    }

    public function Labview($type) 
	{	
	 if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['javascripts'] = array(
            'js/custom_js/laboratory_dashboard.js',
        );
        $tempGroupType = $this->ion_auth->get_users_groups()->row()->group_type;
		if(in_array($type,LAB_GROUP))
		{
				$hospital_row = $this->ion_auth->get_users_main_groups()->row();            
				$groupType= $hospital_row->group_type;
				$hospital_id = $hospital_row->id;
				$hospitalUserGroupArray = array("H","HA");
				if  (in_array($groupType, $hospitalUserGroupArray)) 
				{
					$data["lab_info"] = $this->Laboratory_model->get_alllab_information($hospital_id);
				}
				else
				{                    
					$data["lab_info"] = $this->Laboratory_model->get_alllab_information(0);
				}
				$data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $hospital_id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_id = $group_row->id;
       
	    $data['user_error'] = array();
	    $data['title'] = 'Laboratory';
	    $data["is_admin"] = ($groupType == 'A' || $tempGroupType == 'A') ? true : false;

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/lab_view', $data);
        $this->load->view('templates/footer-new');
		}	
		else
		{
            
				$hospital_row = $this->ion_auth->get_users_main_groups()->row();            
				$groupType= $hospital_row->group_type;
                $groupType = $type;
				$hospital_id = $hospital_row->id;
				$hospitalUserGroupArray = array("H","HA");
				if  (in_array($groupType, $hospitalUserGroupArray))
				{   
                    $data["hospital_info"] = $this->Laboratory_model->get_alllab_Hospitalinfo($hospital_id);                    
				}
				else
				{                    
					$data["hospital_info"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);                    
				}
				$data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $hospital_id;
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_id = $group_row->id;
	    $data['user_error'] = array();
        $data['title'] = 'Clinic';
        $data["is_admin"] = ($groupType == 'A' || $tempGroupType == 'A') ? true : false;
        $data['br_template'] = $this->load->view('barcode_template_view', NULL, TRUE);
        $this->load->view('templates/header-new');
        $this->load->view('laboratory/lab_view', $data);
        $this->load->view('templates/footer-new');
					
		}       
		
    }

    public function pathologist_view()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['javascripts'] = array(
            'js/custom_js/laboratory_dashboard.js',
        );

        $hospital_row = $this->ion_auth->get_users_main_groups()->row();
        $groupType= $hospital_row->group_type;
        $hospital_id = $hospital_row->id;
        //$data["pathologist_info"] = $this->Laboratory_model->get_lab_users($hospital_id);
        //$data["pathologist_info"] = $this->Institute_model->get_pathologists($hospital_id);

        $data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_id = $group_row->id;

        $data["pathologistArr"] = $this->Userextramodel->getAllusersForadmin2($group_id);
        //$data["pathologistArr"] = $this->Userextramodel->getAllPathologist($group_id);

        $data['user_error'] = array();

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/pathologist_view', $data);
        $this->load->view('templates/footer-new');
    }

    public function delete_user($id){
        if(!empty($id)){
            $this->db->delete('users', ['id' => $id]);
            redirect('laboratory/pathologist_view');
        }
    }
	 function random_password() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); 
        $alpha_length = strlen($alphabet) - 1; 
        for ($i = 0; $i < 12; $i++) 
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password); 
    }
	 public function team_view($group_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['javascripts'] = array(
            'js/custom_js/laboratory_dashboard.js',
        );

        // Check query string if exist then send link
        $sendPassword = $this->input->get('send_password');
        if (!empty($sendPassword) && isset($sendPassword)) {
            $pass = $this->random_password(); 

            // Get user mail here
            $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($sendPassword);
            $to_email = $decryptedDetails->email;

             $config = Array(
                'mailtype' => 'html',
                'charset' => 'utf-8', //iso-8859-1
                'newline' => '\r\n',
                'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from('aleatha@uralensis.com'); // change it to yours, default: aleatha@uralensis.com
            $this->email->to($to_email); // change it to yours
            $this->email->subject('Your updated password');
            $this->email->message("Please find below yor updated password  ------:".$pass);
            $this->email->send();
            $this->Ion_auth_model->update_password($pass,$sendPassword);
            redirect('laboratory/team_view', 'refresh');
        }
        $hospital_row = $this->ion_auth->get_users_groups()->row();
        
        $groupType= $hospital_row->group_type;
        $hospital_id = $hospital_row->id;
        if($group_id != ''){
            $group_id = base64_decode($group_id);
        }
        $data["pathologist_info"] = $this->Laboratory_model->get_lab_users($hospital_id, $group_id);
        $data['group_id'] = $group_id;

        //$data["pathologist_info"] = $this->Institute_model->get_pathologists($hospital_id);

        $data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_id = $group_row->id;

        $data['user_error'] = array();

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/team_view', $data);
        $this->load->view('templates/footer-new');
    }


    /**
     * Search record based on barcode scanner
     *
     * @return {html}
     */
    public function search_barcode_record() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $encode = '';
        $status_data_1 = '';
        $status_data_2 = '';
        $status_data_3 = '';
        if ($this->input->method() == 'post') {

            if (!empty($_POST['search_type']) && $_POST['search_type'] === 'ura_barcode_no') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('barcode');
                $msg = 'Barcode No';
            } elseif (!empty($_POST['search_type']) && $_POST['search_type'] === 'serial_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_ul');
                $msg = 'Serial No';
            } elseif (!empty($_POST['search_type']) && $_POST['search_type'] === 'lab_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_lab');
                $msg = 'Lab No';
            }

            $this->db->select('ura_rec_track_no,ura_rec_track_record_id,ura_rec_track_location,ura_rec_track_status,ura_rec_track_pathologist,timestamp');
            $this->db->from('request');
            $this->db->join('uralensis_record_track_status', 'request.uralensis_request_id = uralensis_record_track_status.ura_rec_track_record_id');
            $this->db->where($search_type, $search_term);
            $query = $this->db->get()->result_array();

            //Get the record ID and barcode based on barcode no.
            $this->db->select('uralensis_request_id,ura_barcode_no');
            $this->db->from('request');
            $this->db->where($search_type, $search_term);
            $get_record_data = $this->db->get()->row_array();

            $barcode = '';
            $record_id = '';
            if (!empty($get_record_data)) {
                $barcode = $get_record_data['ura_barcode_no'];
                $record_id = $get_record_data['uralensis_request_id'];
            }

            $status_data_1 .= '<a class="institute_book_in_from_clinic text-center" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="book_in_from_clinic">';
            $status_data_1 .= '<img src="' . base_url('assets/img/01_Book-In-From-Clinic.jpg') . '">';
            $status_data_1 .= '</a>';

            $status_data_2 .= '<a class="institute_book_out_to_lab_primary_release text-center" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="book_out_to_lab_primary_release">';
            $status_data_2 .= '<img src="' . base_url('assets/img/02_Booked-out-to-Lab-Primary-Release.jpg') . '">';
            $status_data_2 .= '</a>';

            $status_data_3 .= '<a class="institute_book_out_to_lab_fw_completed text-center" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="book_out_to_lab_fw_completed">';
            $status_data_3 .= '<img src="' . base_url('assets/img/03_Booked-out-to-Lab-FW-Completed.jpg') . '">';
            $status_data_3 .= '</a>';

            if (!empty($query)) {
                $encode .= '<table class="table">';
                $encode .= '<tr class="bg-primary">';
                $encode .= '<th>Track No.</th>';
                $encode .= '<th>Time/Date</th>';
                $encode .= '<th>Location</th>';
                $encode .= '<th>Status</th>';
                $encode .= '<th>Pathologist</th>';
                $encode .= '</tr>';
                foreach ($query as $data) {
                    $encode .= '<tr class="bg-info">';
                    $encode .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $encode .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $encode .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $encode .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $encode .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $encode .= '</tr>';
                }
                $encode .= '<table>';

                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['encode_status_data_1'] = $status_data_1;
                $json['encode_status_data_2'] = $status_data_2;
                $json['encode_status_data_3'] = $status_data_3;
                $json['msg'] = $msg . ' record found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['add_specimen_btn'] = '<a class="btn btn-success add_specimen_hide" data-toggle="collapse" data-target="#specimen_tracking" href="javascript:;">Add Specimen</a>';
                $json['msg'] = 'No record add yet against this ' . $msg;
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Barcode field must not be empty.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Set Track Record Statuses
     *
     * @return void
     */
    public function set_laboratory_record_history_track_status() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $record_track_data = '';
        $record_id = $this->input->post('record_id');
        $get_lab_name = $this->db->select('lab_name')->where('uralensis_request_id', $record_id)->get('request')->row_array();
        if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'book_in_from_clinic') {
            $record_id = $this->input->post('record_id');
            $barcode_no = $this->input->post('barcode_no');
            $status_key = $this->input->post('track_status_key');
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => $barcode_no,
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $track_sql = "SELECT * FROM uralensis_record_track_status WHERE uralensis_record_track_status.ura_rec_track_record_id = $record_id";
            $record_track_query = $this->db->query($track_sql)->result_array();
            if (!empty($record_track_query)) {
                $record_track_data .= '<hr>';
                $record_track_data .= '<table class="table">';
                $record_track_data .= '<tr class="bg-primary">';
                $record_track_data .= '<th>Track No.</th>';
                $record_track_data .= '<th>Time/Date</th>';
                $record_track_data .= '<th>Location</th>';
                $record_track_data .= '<th>Status</th>';
                $record_track_data .= '<th>Pathologist</th>';
                $record_track_data .= '</tr>';
                foreach ($record_track_query as $data) {
                    $record_track_data .= '<tr class="bg-info">';
                    $record_track_data .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $record_track_data .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $record_track_data .= '</tr>';
                }
                $record_track_data .= '</table>';
            }

            $json['type'] = 'success';
            $json['record_track_data'] = $record_track_data;
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        } elseif (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'book_out_to_lab_primary_release') {
            $record_id = $this->input->post('record_id');
            $barcode_no = $this->input->post('barcode_no');
            $status_key = $this->input->post('track_status_key');

            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => $barcode_no,
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $track_sql = "SELECT * FROM uralensis_record_track_status WHERE uralensis_record_track_status.ura_rec_track_record_id = $record_id";
            $record_track_query = $this->db->query($track_sql)->result_array();
            if (!empty($record_track_query)) {
                $record_track_data .= '<hr>';
                $record_track_data .= '<table class="table">';
                $record_track_data .= '<tr class="bg-primary">';
                $record_track_data .= '<th>Track No.</th>';
                $record_track_data .= '<th>Time/Date</th>';
                $record_track_data .= '<th>Location</th>';
                $record_track_data .= '<th>Status</th>';
                $record_track_data .= '<th>Pathologist</th>';
                $record_track_data .= '</tr>';
                foreach ($record_track_query as $data) {
                    $record_track_data .= '<tr class="bg-info">';
                    $record_track_data .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $record_track_data .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $record_track_data .= '</tr>';
                }
                $record_track_data .= '</table>';
            }
            $json['type'] = 'success';
            $json['record_track_data'] = $record_track_data;
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        } elseif (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'book_out_to_lab_fw_completed') {
            $record_id = $this->input->post('record_id');
            $barcode_no = $this->input->post('barcode_no');
            $status_key = $this->input->post('track_status_key');
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => $barcode_no,
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $track_sql = "SELECT * FROM uralensis_record_track_status WHERE uralensis_record_track_status.ura_rec_track_record_id = $record_id";
            $record_track_query = $this->db->query($track_sql)->result_array();
            if (!empty($record_track_query)) {
                $record_track_data .= '<hr>';
                $record_track_data .= '<table class="table">';
                $record_track_data .= '<tr class="bg-primary">';
                $record_track_data .= '<th>Track No.</th>';
                $record_track_data .= '<th>Time/Date</th>';
                $record_track_data .= '<th>Location</th>';
                $record_track_data .= '<th>Status</th>';
                $record_track_data .= '<th>Pathologist</th>';
                $record_track_data .= '</tr>';
                foreach ($record_track_query as $data) {
                    $record_track_data .= '<tr class="bg-info">';
                    $record_track_data .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $record_track_data .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $record_track_data .= '</tr>';
                }
                $record_track_data .= '</table>';
            }
            $json['type'] = 'success';
            $json['record_track_data'] = $record_track_data;
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Get User first and last name
     * @param type $user_id
     * @return string
     */
    public function get_uralensis_username($user_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($user_id)) {

            $f_name = $this->ion_auth->user($user_id)->row()->first_name;
            $l_name = $this->ion_auth->user($user_id)->row()->last_name;
            $username = $f_name . ' ' . $l_name;

            return $username;
        }
    }

    /**
     * Swith Back User Account To Admin
     *
     * @param int $admin_id
     * @return void
     */
    public function switchUserAccountToAdmin($admin_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($admin_id)) {
            @$this->Ion_auth_model->identity_column = $this->config->item('identity', 'ion_auth');
            @$this->Ion_auth_model->tables = $this->config->item('tables', 'ion_auth');
            $query = $this->db->select($this->Ion_auth_model->identity_column . ', username, email, id, password, active, last_login, memorable')
                    ->where('id', $admin_id)
                    ->limit(1)
                    ->order_by('id', 'desc')
                    ->get($this->Ion_auth_model->tables['users']);
            $user = $query->row();

            if (insert_logout_time() == true) {
                insert_logout_time();
            }

            $session_data = array(
                'identity' => $user->email,
                'username' => $user->username,
                'email' => $user->email,
                'user_id' => $user->id, //everyone likes to overwrite id so we'll use user_id
                'old_last_login' => $user->last_login,
            );
            $this->session->set_userdata($session_data);
            $this->session->sess_regenerate(TRUE);
            redirect('/', 'refresh');
        }
    }

    /**
     * Search Receipent Users
     *
     * @return void
     */
    public function searchReceipentUsers() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            $query = $this->db->query("SELECT * FROM users WHERE users.username LIKE '%$search_query%' AND users.id != $user_id ORDER BY users.username");
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->id]['user_id'] = $row->id;
                $array[$row->id]['username'] = $row->username;
                $array[$row->id]['first_name'] = $row->first_name;
                $array[$row->id]['last_name'] = $row->last_name;
            }
            echo json_encode($array); //Return the JSON Array
        }
    }

    /**
     * View Laboratory Record
     *
     * @param int $record_id
     * @return void
     */
    public function view_record($record_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $result_array = array();
        if (!empty($record_id)) {
            $doctor_id = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array()['user_id'];
            $record_data['record_query'] = $this->lab->record_detail($record_id, $doctor_id);
            $specimen_data['specimen_query'] = $this->lab->record_detail_specimen($record_id, $doctor_id);
            $result_array = array_merge($record_data, $specimen_data);
        }
        $this->load->view('laboratory/inc/header');
        $this->load->view('laboratory/record_view', $result_array);
        $this->load->view('laboratory/inc/footer');
    }

    public function template_test() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!in_array($this->group_type,LAB_GROUP)) {
            redirect('/', 'refresh');
        }

        $h_data = array('styles' => array());
        $f_data = array('javascripts' => array(
                '/assets/js/laboratory.js',
        ));

        $user_id = $this->ion_auth->user()->row()->id;
        $res = $this->db
                        ->select("
        `users`.`id` as id, 
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        profile_picture_path as profile_picture")->where('id', $user_id)->get('users')->result_array()[0];

        $data_array['user_data']['profile_picture_path'] = $res['profile_picture'];
        $data_array['user_data']['id'] = $user_id;
        $data_array['user_data']['first_name'] = $res['first_name'];
        $data_array['user_data']['last_name'] = $res['last_name'];
        $data_array['group_id'] = $this->group_id;
        $data_array['group_type'] = $this->group_type;
        $data_array['user_id'] = $this->user_id;
        if ($this->group_type === 'A') {
            $data_array['labs'] = $this->lab->get_lab_names();
        } else if (in_array($this->group_type,LAB_GROUP)) {
            $data_array['lab'] = $this->lab->get_lab_name($this->group_id);
        }
        $test_id = date("Y") . "-";
        $test_id = $test_id . str_pad((intval($this->db->select('id')->order_by('id', 'DESC')->get('groups')->result_array()[0]['id']) + 1), 7, "0", STR_PAD_LEFT);
        $data_array['test_id'] = $test_id;
        $data_array['speciality_groups'] = $this->lab->get_speciality_group_data();
        $data_array["codeType"] = $this->invoice_model->getBillingCodes();
        $data_array["codeName"] = $this->invoice_model->getBillingCodesName();
		$data_array["costCode"] = $this->invoice_model->getCostCodesName();
//        echo "<pre>";
    //    print_r($data_array["costCode2"]); exit; 

        $this->load->view('doctor/inc/header-new');
//        $this->load->view('templates/header-new', $h_data);
        $this->load->view('laboratory/laboratory_sample_tests', $data_array);
        $this->load->view('doctor/inc/footer-new');
//        $this->load->view('templates/footer-new', $f_data);
    }

    public function laboratory_add_test() 
	{
        if (!$this->ion_auth->logged_in()) {
           // redirect('auth/login', 'refresh');
        }
        if (in_array($this->group_type,HOSPITAL_GROUP)) {
            $this->hospital_labs_test();
            return;
        }

        
        $h_data = array('styles' => array());
        $f_data = array('javascripts' => array(
                '/assets/js/laboratory.js',
        ));


		$this->load->model('Doctor_model');
        

        $user_id = $this->ion_auth->user()->row()->id;
        $res = $this->db->select("`users`.`id` as id,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,profile_picture_path as profile_picture")->where('id', $user_id)->get('users')->result_array()[0];

        $data_array['user_data']['profile_picture_path'] = $res['profile_picture'];
        $data_array['user_data']['id'] = $user_id;
        $data_array['user_data']['first_name'] = $res['first_name'];
        $data_array['user_data']['last_name'] = $res['last_name'];
        $data_array['group_id'] = $this->group_id;
        $data_array['group_type'] = $this->group_type;
        $data_array['user_id'] = $this->user_id;
        if ($this->group_type === 'A') 
		{
            $data_array['labs'] = $this->lab->get_lab_names();
        } 
		else if (in_array($this->group_type,LAB_GROUP)) 
		{
			$labId = $this->Doctor_model->getLabIdsFromUser($this->user_id);
            $data_array['lab'] = $this->lab->get_lab_name($labId);
        }

        $labName = $this->lab->get_lab_name($this->group_id);
        $labInitial = $labName['first_initial'].$labName['last_initial'];
        $labTestRef = $this->lab->lab_ref_test_no($labInitial);
        $data_array["test_id"] = $labTestRef["test_id"];
        $data_array["ref_name"] = $labTestRef["ref_name"];

        $data_array['speciality_groups'] = $this->lab->get_speciality_group_data();
        $data_array["codeType"] = $this->invoice_model->getBillingCodes();
        $data_array["codeName"] = $this->invoice_model->getBillingCodesName();
		
        $data_array["testMainCategories"] = getMainTestCategories();
		
//        $data_array["testSubCategories"] = getSubTestCatAgainstMainCat(1);
//
//        $data_array["testSubCategories"] = getSubTestCatAgainstMainCat(1);
		
        $data_array["categoriesTests"] = getTestAgsinstSubCat('1');
		//exit;
		
		$data_array["costCode"] = $this->invoice_model->getCostCodesName();
		$data_array["hospital_id"] = $this->ion_auth->get_users_main_groups()->row()->id;

       // print_r($data_array["testMainCategories"]);  
//        echo "<pre>";
//        print_r($data_array["codeType"]); exit; 

        $this->load->view('doctor/inc/header-new');
//        $this->load->view('templates/header-new', $h_data);
        $this->load->view('laboratory/laboratory_add_test', $data_array);
        $this->load->view('doctor/inc/footer-new');
//        $this->load->view('templates/footer-new', $f_data);
    }

    public function hospital_labs_test()
	{
//        $user_id = $this->ion_auth->user()->row()->id;
//        $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

		$user_id = $this->ion_auth->user()->row()->id;
		if ($this->group_type === 'A') 
		{			
           $labsArray = $this->Institute_model->getHospitalLabs($this->group_id);
		   $labIds = implode(', ', array_map(function ($entry) {
            return $entry->id;
        }, $labsArray));

        $labTestArray = $this->lab->get_hospital_laboratory_test($labIds);
        } 
		else if (in_array($this->group_type,LAB_GROUP)) 
		{
            $labsArray = $this->lab->getLabIdsFromUser($user_id);
			$labTestArray = $this->lab->get_hospital_laboratory_test($labsArray);
        }

        
        $data_array['lab_test'] = $labTestArray;
        $this->load->view('doctor/inc/header-new');
//        $this->load->view('templates/header-new', $h_data);
        $this->load->view('laboratory/hospital_laboratory_test', $data_array);
        $this->load->view('doctor/inc/footer-new');
//        $this->load->view('templates/footer-new', $f_data);
    }

    public function get_categories(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hospitalId = $this->ion_auth->get_users_main_groups()->row()->id;
        $departmentId = $this->input->post("department_id");
        $specialtyId = $this->input->post("specialty_id");
        $getData = $this->db->select("id, name")->get_where('laboratory_test_category', ['speciality_id' => $specialtyId, 'laboratory_id' => $hospitalId])->result();
        /*$getData = $this->db->from('laboratory_test_category as ltc')
            ->join('tests_main_categories tmc', 'tmc.name = ltc.name')
            ->where([
                'tmc.is_active' => '1',
                'ltc.laboratory_id' => $hospitalId,
                //'ltc.department_id' => $departmentId,
                'ltc.speciality_id' => $specialtyId
            ])
            ->select("tmc.id, tmc.name")
            ->get()
            ->result();*/

        echo json_encode($getData);exit;
    }

    public function get_sub_categories()
	{
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $catId = $this->input->post("catId");
        $getData = $this->db->where(array("main_category_id"=>$catId,"is_active"=>'1'))->select("id,name")->get("tests_sub_categories")->result();
        echo json_encode($getData);exit;
    }

    public function get_sub_categories_by_main_cat(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $catId = $this->input->post("category_id");
        $getData = $this->db->from('tests_sub_categories as tsc')
            ->join('tests_main_categories as tmc', 'tmc.id=tsc.main_category_id')
            ->join('laboratory_test_category as ltc', 'ltc.name=tmc.name')
            ->where(['ltc.id'=>$catId, 'tsc.is_active'=>'1'])
            ->select('tsc.id, tsc.name')
            ->get()->result_array();
        echo json_encode($getData);exit;
    }

    public function update_category_info(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $catId = $this->input->post("cat_id");
            $catName = $this->input->post("cat_name");
            if(!empty($catId)){
                $getData = $this->db->from('laboratory_test_category as ltc')
                    ->join('tests_main_categories as tmc', 'tmc.name=ltc.name')
                    ->where(['ltc.id'=>$catId])
                    ->select('ltc.id, tmc.id as main_cat_id')
                    ->get()->row();
                if($getData){
                    $res1 = $this->db->update("laboratory_test_category", ['name'=>$catName], ['id'=>$getData->id]);
                    $res2 = $this->db->update("tests_main_categories", ['name'=>$catName], ['id'=>$getData->main_cat_id]);
                    if ($res1 && $res2) {
                        $json['status'] = "success";
                        $json['message'] = "Category info update successfully";
                    }
                }
            }
        }
        echo json_encode($json); exit;
    }

    public function update_sub_category_info(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $subCatId = $this->input->post("sub_cat_id");
            $subCatName = $this->input->post("sub_cat_name");
            if(!empty($subCatId)){
                $res = $this->db->update("tests_sub_categories", ['name'=>$subCatName], ['id'=>$subCatId]);
                if ($res) {
                    $json['status'] = "success";
                    $json['message'] = "Sub category info update successfully";
                }
            }
        }
        echo json_encode($json); exit;
    }

    public function delete_category(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $catId = $this->input->post("cat_id");
            if(!empty($catId)){
                $getData = $this->db->from('laboratory_test_category as ltc')
                    ->join('tests_main_categories as tmc', 'tmc.name=ltc.name')
                    ->where(['ltc.id'=>$catId])
                    ->select('ltc.id, tmc.id as main_cat_id')
                    ->get()->row();
                if($getData){
                    $res1 = $this->db->delete("laboratory_test_category", ['id'=>$getData->id]);
                    $res2 = $this->db->delete("tests_main_categories", ['id'=>$getData->main_cat_id]);
                    if ($res1 && $res2) {
                        $this->db->delete("tests_sub_categories", ['main_category_id'=>$getData->main_cat_id]);
                        $json['status'] = "success";
                        $json['message'] = "Category delete successfully";
                    }
                }
            }
        }
        echo json_encode($json); exit;
    }

    public function delete_sub_category(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $subCatId = $this->input->post("sub_cat_id");
            if(!empty($subCatId)){
                $res = $this->db->delete("tests_sub_categories", ['id'=>$subCatId]);
                if ($res) {
                    $json['status'] = "success";
                    $json['message'] = "Sub category delete successfully";
                }
            }
        }
        echo json_encode($json); exit;
    }

    public function add_test() 
	{
         if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
//        echo '<pre>'; print_r($this->input->post()); echo'</pre>'; exit;
        $lab_id = $this->input->post('lab_id');
		$groupId = $this->input->post('groupId');
		
		//$hospital_row = $this->ion_auth->get_users_main_groups()->row();
		//$lab_id =$hospital_row->group_id;
		
		
        $laboratory_test_category_ids = $this->input->post('laboratory_test_category_id');
//        echo print_r($this->input->post('billing_code'));
//        exit; 
//        pexplode("-", $this->input->post('billing_code')); exit; 
        $labName = $this->lab->get_lab_name($this->group_id);
        $labInitials = substr($labName["name"], 0, 4);

        $cost_code = implode(",", $this->input->post('cost_code'));
		$cost_sum = $this->lab->get_cost_price($cost_code);     
	    $cost_sum= $cost_sum[0]['total_cost'];
		
		$billing_code = implode(",", $this->input->post('billing_code'));
		$sale_sum = $this->lab->get_sale_price($billing_code);     
	    $sale_sum= $sale_sum[0]['total_sale'];
		
        $data = array(
            'lab_id' => $groupId,
            'speciality_group_id' => $this->input->post('specialty_id'),
            'test_id' => $this->input->post('test_id'),
            'department_id' => $this->input->post('department_id'),
            'specialty_id' => $this->input->post('specialty_id'),
            'lab_ref_name' => $this->input->post('lab_ref'),
            'name' => $this->input->post('test_name'),
            'test_category_id' => $this->input->post('test_category'),
            'category_id' => $this->input->post('test_category_main'),
            'sub_category_id' => $this->input->post('test_sub_category_main'),
            // 'cost'=>$this->input->post('cost'),
            'sale'=>$sale_sum,
            'user_id' => $this->input->post('user_id'),
            'created_at' => date("Y-m-d H:i:s"),
            'cost_code_id' => $cost_code,
            'billing_code_id' => implode(",", $this->input->post('billing_code')),
			'cost' => $cost_sum,
            'path_index' => $labInitials . "-" . date("y-m") . "-" . date("hi")
        );

        $this->db->trans_start();
        $this->db->insert('laboratory_tests', $data);
        $laboratory_test_id = $this->db->insert_id();
        $this->db->insert('lab_test', ['lab_id' => $lab_id, 'laboratory_test_id' => $laboratory_test_id]);

//        if (is_array($laboratory_test_category_ids) && !empty($laboratory_test_category_ids)) {
//            foreach ($laboratory_test_category_ids as $laboratory_test_category_id) {
//                $this->db->insert('laboratory_test_hierarchy', ['laboratory_test_id' => $laboratory_test_id, 'hospital_test_hierarchy_id' => $laboratory_test_category_id]);
//            }
//        }

        $last = $this->db->last_query();
        $this->db->trans_complete();
        $json['type'] = 'success';
        $json['msg'] = 'Laboratory Test Inserted successfully.';
        echo json_encode($json);
        die;
    }

    public function edit_test()
	{
        if (in_array($this->group_type,LAB_GROUP)) {
            //redirect('/', 'refresh');
        }

//        echo $this->input->post('test_sub_category_main');exit;
//        echo '<pre>'; print_r($this->input->post()); echo'</pre>'; exit;
        $edit_id = $this->input->post('edit_id');
        $lab_id = $this->input->post('lab_id');
        $laboratory_test_category_ids = $this->input->post('laboratory_test_category_id');
//        echo print_r($this->input->post('billing_code'));
//        exit;
//        pexplode("-", $this->input->post('billing_code')); exit;
        $labName = $this->lab->get_lab_name($this->group_id);
        $labInitials = substr($labName["name"], 0, 4);

        $cost_code = implode(",", $this->input->post('cost_code'));
		$cost_sum = $this->lab->get_cost_price($cost_code);
	    $cost_sum= $cost_sum[0]['total_cost'];

		$billing_code = implode(",", $this->input->post('billing_code'));
		$sale_sum = $this->lab->get_sale_price($billing_code);
	    $sale_sum= $sale_sum[0]['total_sale'];


        $data = array(
            'speciality_group_id' => $this->input->post('specialty_id'),
            'test_id' => $this->input->post('test_id'),
            'department_id' => $this->input->post('department_id'),
            'specialty_id' => $this->input->post('specialty_id'),
            'lab_ref_name' => $this->input->post('lab_ref'),
            'name' => $this->input->post('test_name'),
            'test_category_id' => $this->input->post('test_category'),
            'category_id' => $this->input->post('test_category_main'),
            'sub_category_id' => $this->input->post('test_sub_category_main'),
            // 'cost'=>$this->input->post('cost'),
            'sale'=>$sale_sum,
            'user_id' => $this->input->post('user_id'),
            'created_at' => date("Y-m-d H:i:s"),
            'cost_code_id' => $cost_code,
            'billing_code_id' => implode(",", $this->input->post('billing_code')),
			'cost' => $cost_sum,
            'path_index' => $labInitials . "-" . date("y-m") . "-" . date("hi")
        );

        $this->db->trans_start();
        $this->db->where(array("id"=>$edit_id))->update('laboratory_tests', $data);
        $this->db->where(array("laboratory_test_id"=>$edit_id))->update('lab_test', ['lab_id' => $lab_id, 'laboratory_test_id' => $edit_id]);

        $this->db->where(array("laboratory_test_id"=>$edit_id))->delete('laboratory_test_hierarchy');

//        if (is_array($laboratory_test_category_ids) && !empty($laboratory_test_category_ids)) {
//            foreach ($laboratory_test_category_ids as $laboratory_test_category_id) {
//                $this->db->insert('laboratory_test_hierarchy', ['laboratory_test_id' => $edit_id, 'hospital_test_hierarchy_id' => $laboratory_test_category_id]);
//            }
//        }

        $last = $this->db->last_query();
        $this->db->trans_complete();
        $json['type'] = 'success';
        $json['msg'] = 'Laboratory Test updated successfully.';
        echo json_encode($json);
        die;
    }

    public function deleteLabTest($testId)
	{
        if (!$this->ion_auth->logged_in()) 
        {
            redirect('/', 'refresh');
        }

        $this->db->where(array("id"=>$testId))->delete('laboratory_tests');
        $this->db->where(array("laboratory_test_id"=>$testId))->delete('lab_test');

        $this->db->where(array("laboratory_test_id"=>$testId))->delete('laboratory_test_hierarchy');

        redirect("laboratory/laboratory_add_test");
    }

    public function deleteSelectedLabTest(){
        if($this->input->post('labIds')){
            $labIds = $this->input->post('labIds');
            $this->db->where_in('id',$labIds)->delete('laboratory_tests');
            $this->db->where_in('laboratory_test_id', $labIds)->delete('lab_test');
            $this->db->where_in('laboratory_test_id', $labIds)->delete('laboratory_test_hierarchy');
            echo json_encode(['type'=>'success', 'msg'=>'Selected records delete successfully.']);die;
        }
    }

    public function get_laboratory_test_data_ajax()
	 {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
       $query = $this->lab->get_laboratory_test_data_ajax($start,$length);
	   
	  // $query = $this->lab->get_laboratory_tests_data($start,$length);
	   
//        echo $this->db->last_query();
//echo "<pre>";print_r($query->result_array());exit;

        $data = [];
        foreach ($query->result_array() as $key => $row) 
		{
            $get_pic_path = get_profile_picture($row['profile_picture_path'], $row['first_name'], $row['last_name']);
            $row['new_profile_pic'] = $get_pic_path;
            /*$actionsColData = '<div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <textarea id="test_data_'.$row["id"].'" style="display: none">'.json_encode($row).'</textarea>
                                    <a class="dropdown-item edit_btn" href="javascript:void(0)" data-id="'.$row["id"].'"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:delete_lab(\''.base_url().'laboratory/deleteLabTest/'.$row["id"].'\')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';*/

            $actionsTd = '<textarea id="test_data_'.$row["id"].'" style="display: none">'.json_encode($row).'</textarea>';
            $actionsTd .= '<a title="Edit" class="edit_btn" href="javascript:void(0);" data-id="'.$row["id"].'"><i class="fa fa-pencil m-r-5"></i></a> &nbsp;';
            $actionsTd .= '<a title="Delete" class="" href="javascript:delete_lab(\''.base_url().'laboratory/deleteLabTest/'.$row["id"].'\')"><i class="fa fa-trash-o m-r-5"></i></a>';
            //$actionsColData = ' <a class="" href="'.base_url().'laboratory/deleteLabTest/'.$row["id"].'"><i class="fa fa-trash-o m-r-5"></i></a>';
							
            $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row['user_id']);
            $profile_picture_path = $decryptedDetails->profile_picture_path;
            $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
            $imgIcon = "<img src=".$img." class='avatar' title='". $row['user_name'] ."'>";

            $data[] = array(
                'checkbox' => '<input type="checkbox" class="checkSingle" value="' . $row['id'] . '">',
                'name' => $row['name'],
                'test_id' => $row['test_id'],
                'lab_name' => '<a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="" href="#">PC</a>',
                'test_category' => str_replace(",", "<br/>", $row['test_category']),
                'test_sub_category' => $row['test_sub_category'],
                'lab_ref' => $row['lab_ref_name'],
                'speciality_group' => '<span class="badge badge-success">' . $row['spec_grp_name'] . '</span>',
                'cost' => $row['cost'],
                'sale' => $row['sale'],
                'user_id' => $imgIcon . $row['user_name'],
                'created_at' => $row['created_at'],
                'action' => $actionsTd
            );
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $this->lab->get_laboratory_test_count_all(),
            "recordsFiltered" => $this->lab->get_laboratory_test_count_all(),
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }

    public function get_laboratory_test_hirarchy() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $level = $this->input->post('level');
        $parent_id = $this->input->post('parent_id');

        $test_category_hirarchy = $this->lab->get_laboratory_test_hirarchy($parent_id, $level);
        $data = [];
        if (is_array($test_category_hirarchy) && !empty($test_category_hirarchy)) {
            foreach ($test_category_hirarchy as $test_category) {
                $data[] = [
                    'text' => $test_category['name'],
                    'nodes' => $this->lab->get_test_category_hirarchy_children($test_category['id'], $test_category['level']),
                    'id' => $test_category['id'],
                    'parent_id' => $test_category['id'],
                    'level' => $test_category['level'],
                    'has_level' => $test_category['has_level'],
                ];
            }
        }

        echo json_encode($data);
        exit();
    }

    public function get_lab_departments() 
	{
        if (in_array($this->group_type,LAB_GROUP)) 
		{
			$user_id = $this->ion_auth->user()->row()->id;
			$lab_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
        }
		else
		{
		        $lab_id = $this->input->get('lab_id');	
		}
				
        // Get related hospital
        $this->load->model('DepartmentModel', 'department');
        try {
            $departments = $this->department->get_laboratory_department($lab_id);

            $labName = $this->lab->get_lab_name($lab_id);
            $labInitial = $labName['first_initial'].$labName['last_initial'];
            $labTestRef = $this->lab->lab_ref_test_no($labInitial);
            $data_array["test_id"] = $labTestRef["test_id"];
            $data_array["ref_name"] = $labTestRef["ref_name"];



//            echo "<pre>";
//            print_r($departments); 
//            exit;
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'success', 'departments' => $departments,'lab_test_codes'=>$data_array)));
        } catch (Exception $e) {
            $this->output->set_status_header(404)->set_output("Laboratory Not found");
            return;
        }
    }

    public function add_category() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('doctor/inc/header-new');
        $this->load->view('laboratory/add_category');
        $this->load->view('doctor/inc/footer-new');
    }

    public function getDataAgainstBillingCode() {
        $POST = $this->input->post("NULL", TRUE);
        $result = $this->invoice_model->getCodeDetails($this->input->post('billingCode'));

        $html = "";
        foreach ($result as $resKey => $resValue) {
            $html .= '<table class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PathHub Index</th>
                        <th>Department</th>
                        <th>Category</th>
                        <th>Code Type</th>
                        <th>Code Name</th>
                        <th>Rate</th>
                        <th>Country </th>
                        <th>Description</th>
                      
                    </tr>
                </thead>';

            $cnt = 0;
            foreach ($result as $resKey => $resValue) {
                $cnt ++;


                $html .= '<tr>
                        <td>' . $cnt . '</td>
                        <td>' . $resValue["pathhub_index"] . '</td>
                        <td>' . $resValue["department_name"] . '</td>
                        <td>' . $resValue["category_name"] . '</td>
                        <td>' . $resValue["code_type"] . '</td>
                        <td>' . $resValue["billing_code"] . "-" . $resValue["billing_code_name"] . '</td>
                        <td>' . $resValue["rate"] . " " . $resValue["currency"] . '</td>
                        <td>' . $resValue["country"] . '</td>
                        <td>' . $resValue["description"] . '</td>
                       
                        
                    </tr>';
            }

            $html .= '</tbody> </table>';

            echo $html;
        }
    }

    public function allLoginUsers() {
        $data['usersLogins'] = $this->lab->getUsersLogins(TRUE);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $explodeDate = explode(" - ", $this->input->post("start_end_date"));
            $data['usersLogins'] = $this->lab->getUsersLogins(TRUE, $explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "laboratory/";


        $data['styles'] = array(
            'css/daterangepicker.css'
        );
        $data['javascripts'] = array(
            'js/daterangepicker.js',
            'js/custom_js/activities.js');
        $this->load->view('templates/header-new', $data);
        $this->load->view('institute/login_user_list', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function getLoginDetail($id = FALSE) {
        $explodeId = explode("___", base64_decode($id));
        $data['usersLogins'] = $this->lab->getLoginDetail($explodeId);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $explodeDate = explode(" - ", $this->input->post("start_end_date"));
            $data['usersLogins'] = $this->lab->getLoginDetail($explodeId, $explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "laboratory/";

        $data['styles'] = array(
            'css/daterangepicker.css'
        );
        $data['javascripts'] = array(
            'js/daterangepicker.js',
            'js/custom_js/activities.js');
        $this->load->view('templates/header-new', $data);
        $this->load->view('institute/login_user_detail', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function showUserActivity($id = FALSE) {
        $explodeId = base64_decode($id);
        $data['usersLogins'] = getUserTrackActivity($explodeId);
        $data['route'] = "laboratory/";
        $this->load->view('templates/header-new', $data);
        $this->load->view('institute/login_user_activities', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function update_prefixes() {
        $lab_id = $this->input->post('lab_info_id');
        $update_data = array(
            "lab_specimen_prefix" => $this->input->post('specimen_prefix'),
            "lab_specimen_block_prefix" => $this->input->post('specimen_block_prefix'),
            "lab_no_prefix" => $this->input->post('lab_no_prefix')
        );
        $result = $this->Laboratory_model->update_lab_prefixes($update_data, $lab_id);
        $response = array();
        if ($result) {
            $response['type'] = 'success';
            $response['msg'] = 'Prefixes updates successfully';
        } else {
            $response['type'] = 'error';
            $response['msg'] = 'Something went wrong!';
        }
        echo json_encode($response);
        exit;
    }

    function fetch_all_linked_hospital() {

        $lab_row = $this->ion_auth->get_users_groups()->row();
        $lab_id = $lab_row->id;
        $get_file_path_query = $this->db->query("SELECT * FROM `groups` where group_type = 'H' and id IN(select group_id from hospital_group where group_id=$lab_id)");
        $res = $get_file_path_query->result();
        return $res;
    }

function testimportcsv() 
        {
        if($_REQUEST) 
		{
		//print_r($_REQUEST);
		
            $fileName = $_FILES["UploadCSV"]["tmp_name"];
			print $_FILES["UploadCSV"]["size"];
			
			////�xit;
			if ($_FILES["UploadCSV"]["size"] > 0) 
			{
                $postdata = array();
                $file = fopen($fileName, "r");
                $i = 0;
                $j = 1;
                $records_data = "";

                $hospital_row = $this->ion_auth->get_users_groups()->row();
                $hospital_id = $hospital_row->id;
                $f_initial = '';
                $l_initial = '';
                if (!empty($this->ion_auth->group($hospital_row->id)->row()->first_initial)) {
                    $f_initial = $this->ion_auth->group($hospital_row->id)->row()->first_initial;
                }
                if (!empty($this->ion_auth->group($hospital_row->id)->row()->last_initial)) {
                    $l_initial = $this->ion_auth->group($hospital_row->id)->row()->last_initial;
                }
                if (!empty($f_initial) && !empty($l_initial)) {
                    $last_d = str_pad($j, 4, "0", STR_PAD_LEFT);
                    $batch_no = $f_initial . $l_initial . '.' . date('y') . '.' . $last_d;
                } else {
                    $last_d = str_pad($j, 4, "0", STR_PAD_LEFT);
                    $batch_no = "AD" . '.' . date('y') . '.' . $last_d;
                }
			    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) 
				{
				print "<pre>";
				print_r($column);

						$lab_row = $this->ion_auth->get_users_groups()->row();
						//$request['user_id'] = $lab_row->id;
				
                    if ($i >= 1) {
                        if (isset($column[0])) {
                            $request['test_category_id'] = $column[0];
                        }
						if (isset($column[1])) {
                            $request['test_subcategory_id'] = $column[1];
                        }
                        if (isset($column[2])) {
                            $request['name'] = $column[2];                            
                        }
                        if (isset($column[3])) {
                         //   $request['dob'] = $column[3];                           
                        }
                        if (isset($column[4])) {
                            $request['department_id'] = $column[4];                            
                        }
                        if (isset($column[5])) {
                            $request['specialty_id'] = $column[5];
                        }
                        if (isset($column[6])) {
                            $request['billing_code_id'] = $column[6];
                        }
					
					 $labName = $this->lab->get_lab_name($lab_row->id);
                     $labInitials = substr($labName["name"], 0, 4);
	
                         $request['lab_ref_name'] = $labInitials;
                         $request['cost'] = "";
                         $request['sale'] = "";		
                         $request['created_at'] = date("Y-m-d H:i:s");
						 $request['path_index'] = $labInitials . "-" . date("y-m") . "-" . date("hi");
							
						$this->db->insert('laboratory_tests',$request);
                        $lab_request['lab_id'] = $lab_row->id;
						$lab_request['laboratory_test_id'] = $this->db->insert_id();
                        $this->db->insert('lab_test',$lab_request);
                        $laboratorycate_id=1;
$this->db->insert('laboratory_test_hierarchy', ['laboratory_test_id' => $this->db->insert_id(), 'hospital_test_hierarchy_id' => $laboratorycate_id]);

                        if ($column[1] != '') {/*
                            $get_serial_number = $this->db->query("SELECT * FROM request ORDER BY uralensis_request_id DESC LIMIT 1")->row_array();
                            if ($get_serial_number == '') {
                                $req_id_before_insert = 1;
                            } else {
                                $req_id_before_insert = $get_serial_number['uralensis_request_id'];
                            }
                            $serial_query = $this->db->query("SELECT serial_number FROM request WHERE uralensis_request_id = $req_id_before_insert");
                            if ($serial_query->num_rows() > 0) {
                                $row = $serial_query->row();
                                $last_inserted_serial_number = $row->serial_number;
                                $keyParts = explode('-', $last_inserted_serial_number);
                                if ($keyParts[1] == date('y')) {
                                    $Klast_d = str_pad(($keyParts[2] + 1), 4, "0", STR_PAD_LEFT);
                                    $key = 'PCI' . "." . $keyParts[1] . "." . ($Klast_d);
                                } else {
                                    $key = 'PCI' . "." . date("y") . ".00001";
                                }
                            } else if ($serial_query->num_rows() < 0) {
                                $key = 'PCI.' . date('y') . '.00001';
                            } else {
                                $key = 'PCI.' . date('y') . '.00001';
                            }
                            $this->db->insert('patients', $patients);
                            $request['patient_id'] = $this->db->insert_id();
                            $request['record_batch_id'] = $batch_no;
                            $request['serial_number'] = $key;
                            $this->db->insert('request', $request);
                            $request_assignee['request_id'] = $this->db->insert_id();
                            //$request_assignee['assign_status']=0;
                            //$request_assignee['user_id']=0;
                            //$this->db->insert('request_assignee', $request_assignee);
                        */}
                    }
                    $i++;
                    $j++;
                }
                redirect('laboratory/laboratory_add_test', 'refresh');
                return;
            } else {
                redirect('laboratory/laboratory_add_test', 'refresh');
                return;
            }
        } else {
            print "error";
        }
        exit;
    }

    public function labsetting() {
        $data['javascripts'] = array(
            'js/custom_js/laboratory_dashboard.js',
        );
        $data['countries'] = $this->Institute_model->get_countries();
        $data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_id = $group_row->id;
       
       $getNewGroupId = "SELECT * FROM  users_groups where institute_id > 0 and user_id = $lab_id";
       $getNewGroupIdRes = $this->db->query($getNewGroupId)->result_array();
       $newGroupId = $getNewGroupIdRes[0]["institute_id"];
       //print_r($getNewGroupIdRes); exit;  
        
        
//        echo $group_id; exit; 

        if ($this->input->method() === 'get') {
            $data = array();
            $h_f_data = array();
            $h_f_data['javascripts'] = array(
                '/js/typeahead.jquery.js',
                '/newtheme/js/custom_js/admin_settings.js',
                '/js/institute/settings_lab_users.js',
                'password/js/jquery.passwordRequirements.min.js',
                'password/js/custom.js'
            );
            $h_f_data['styles'] = array('password/css/jquery.passwordRequirements.css');

            $data['countries'] = $this->Institute_model->get_countries();
            $data['errors'] = FALSE;
            if (!empty($_SESSION['form_data'])) {
                $data['errors'] = TRUE;
                $data['hospital_data'] = $_SESSION['form_data'];
            } else {
                $hospital_data = $this->Institute_model->get_hospital_information();
                $data['hospital_data'] = $hospital_data;
            }

            $data["getAllLabsUsersGroup"] = $this->Institute_model->getLabsUsersGroup();
            $lab_row = $this->ion_auth->get_users_groups()->row();
            $lab_id = $lab_row->id;


//                echo $lab_id; exit; 

            $get_hosptial_count = $this->db->query("SELECT count(*) as total_hosp FROM `groups` where group_type = 'H' and id IN(select hospital_id from hospital_group where group_id=$lab_id)");
            $data['get_hosp_count'] = $get_hosptial_count->result();


            $get_file_path_query = $this->db->query("SELECT * FROM `groups` where group_type = 'H' and id IN(select hospital_id from hospital_group where group_id=$lab_id)");
            $data['hospital_count'] = $get_hosptial_count->result();

            $pathologistArr = $this->Userextramodel->getAllusersForadmin2($group_id);
            $data["pathologist_count"] = count($pathologistArr);

            $data['lab_users'] = $this->Laboratory_model->get_lab_users();
            $lab_information = $this->Laboratory_model->get_lab_information($newGroupId);
            $data["group_type"] = $this->group_type; 
            $data["group_id"] = $this->group_id; 
            $data["user_id"] = $this->user_id; 
           // echo $data["user_id"]."-".$data["group_id"];exit;

            $hospital_row = $this->ion_auth->get_users_main_groups()->row();
            $groupType= $hospital_row->group_type;
            $hospital_id = $hospital_row->id;
            $hospitalUserGroupArray = array("H","HA");
            if  (in_array($groupType, $hospitalUserGroupArray)) {
                $data["hospital_list"] = $this->Laboratory_model->get_alllab_Hospitalinfo($hospital_id);
            } else {
                $data["hospital_list"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
            }
            $data['lab_info'] = $lab_information;
            $data['categories'] = getMainTestCategories();
            $data['total_lab_templates'] = $this->db->get_where('lab_templates', ['created_by' => $this->user_id])->num_rows();
            $data['user_error'] = array();
            $this->load->view('templates/header-new');
            $this->load->view('laboratory/lab_edit', $data);
            $this->load->view('templates/footer-new', $h_f_data);
        } else if ($this->input->method() === 'post') {

            $this->form_validation->set_rules('laboratory_name', 'Institute Name', 'trim|required');
            $this->form_validation->set_rules('laboratory_initials_1', 'First Initial', 'trim|required|exact_length[1]');
            $this->form_validation->set_rules('laboratory_initials_2', 'Second Initial', 'trim|required|exact_length[1]');
            $this->form_validation->set_rules('laboratory_email', 'Email', 'trim|valid_email');
            if ($this->form_validation->run() === TRUE) {
                $main_group_info = array(
                    'description' => $this->input->post('laboratory_name'),
                    'first_initial' => $this->input->post('laboratory_initials_1'),
                    'last_initial' => $this->input->post('laboratory_initials_2'),
                    'name' => $this->input->post('laboratory_name'),
                    //'name' => strtolower(str_replace(' ', '', $this->input->post('laboratory_name'))),
                );
                $lab_info = array(
                    'lab_address' => $this->input->post('lab_address'),
                    'lab_country' => $this->input->post('lab_country'),
                    'lab_city' => $this->input->post('lab_city'),
                    'lab_state' => $this->input->post('lab_state'),
                    'lab_post_code' => $this->input->post('lab_post_code'),
                    'lab_email' => $this->input->post('laboratory_email'),
                    'lab_phone' => $this->input->post('lab_phone'),
                    'lab_mobile' => $this->input->post('lab_mobile'),
                    'lab_fax' => $this->input->post('lab_fax'),
                    'lab_website' => $this->input->post('lab_website'),
                );

                $this->Laboratory_model->save_lab_data_new($main_group_info, $lab_info);
                return redirect('/laboratory/labsetting', 'refresh');
            } else {
                
            }
        }
    }

     /* Upload SOP Files */
    public function upload_docs_form() 
	{
        $user_id = $this->ion_auth->user()->row()->id;
        $user_name = $this->ion_auth->user()->row()->username;
        //$hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

        if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0) 
		{
            $ref_key = $user_id;

            $upload_doc = $this->do_upload_lab_files('files', $ref_key);

            if (!empty($upload_doc['error_upload'])) 
			{
                $error = array('upload_error' => $this->upload->display_errors());
                $this->session->set_flashdata('upload_error', $error['upload_error']);
                //echo json_encode(['error' => true]);exit;
            }
            $dataArr = $upload_doc['success'];
            $count = 0;
            foreach ($dataArr as $data)
			{
                $checklist_file_name = $data['file_name'];
                $file_path = "lab_uploads/" . $checklist_file_name;
                $file_type = $_POST['file_type'];

                if (!empty($checklist_file_name)) 
				{
                    $sop_upload_data = array(
                        'file_name' => !empty($checklist_file_name) ? $checklist_file_name : '',
                        'file_path' => !empty($file_path) ? $file_path : '',
                        'file_type' => !empty($file_type) ? $file_type : '',
                        'uploaded_by' => !empty($user_id) ? $user_id : '',
                        'uploaded_at' => date('Y-m-d H:i:s')
                    );
                    $tempCount = $this->db->insert('uralensis_upload_forms', $sop_upload_data);
					
					if($tempCount)
					{
                        $count++;
                    }
					$file_name=explode(".",@$checklist_file_name);
					
					$reqArr = $this->db->get_where('request', ['lab_number'=>$file_name[0]])->result_array();
                    if(count($reqArr) > 0 && !empty($reqArr[0]['lab_number']))
					{
                        $record_id = $reqArr[0]['uralensis_request_id'];
						$file_tag = '';
                        
						$data = array(
					'file_name' => $data['file_name'],
					'title' => $file_name[0],
					'file_path' => $data['full_path'],
					'file_ext' => $data['file_ext'],
					'is_image' => $data['is_image'],
					'user' => $user_name,
					'user_id' => $user_id,
					'record_id' => $record_id,
					'file_tag'=>'request'
					);
					$this->db->insert('files', $data);
						
                    }
                }
            }

            if($count > 0){
                $msg = ($count == 1) ? ' file is ' : ' files are ';
                $this->session->set_flashdata('upload_success', $count.$msg.'upload successfully.');
            }else{
                $this->session->set_flashdata('upload_error', 'Something went wrong!');
            }
            //redirect('laboratory');
            echo json_encode(['success' => true]);exit;
        }
    }

    /* Upload Laboratory Files */
    public function do_upload_lab_files($lab_file_name, $ref_key, $folderName='') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $config['upload_path'] = './lab_uploads/'.$folderName;
        $config['allowed_types'] = 'pdf|doc|xls|xlsx|png|jpeg|jpg|docx|otd|odtx|exls|exl';
        $config['max_size'] = 2040000;
        $config['overwrite'] = TRUE;
        $file = $_FILES;
        $errorUploadType = '';
        $filesCount = count($_FILES[$lab_file_name]['name']);
        for($i = 0; $i < $filesCount; $i++)
		{
            $_FILES['files']['name']     = $file[$lab_file_name]['name'][$i];
            $_FILES['files']['type']     = $file[$lab_file_name]['type'][$i];
            $_FILES['files']['tmp_name'] = $file[$lab_file_name]['tmp_name'][$i];
            $_FILES['files']['error']    = $file[$lab_file_name]['error'][$i];
            $_FILES['files']['size']     = $file[$lab_file_name]['size'][$i];

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('files'))
			{
                $fileData[] = $this->upload->data();
            }else{
                $errorUploadType .= $_FILES['file']['name'].' | ';
            }
        }

        return ['error_upload' => $errorUploadType, 'success' => $fileData];
            /*foreach ($_FILES[$lab_file_name]['name'] as $key => $image) {
                $_FILES['images']['name']       = $_FILES[$lab_file_name]['name'][$key];
                $_FILES['images']['type']       = $_FILES[$lab_file_name]['type'][$key];
                $_FILES['images']['tmp_name']   = $_FILES[$lab_file_name]['tmp_name'][$key];
                $_FILES['images']['error']      = $_FILES[$lab_file_name]['error'][$key];
                $_FILES['images']['size']       = $_FILES[$lab_file_name]['size'][$key];

                $config['file_name'] = $ref_key . '-' . $_FILES[$lab_file_name]['name'];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload($image)) {
                    $this->upload->data();
                } else {
                    return false;
                }
            }
            return TRUE;*/

        /*$return = [];
        $total = count($_FILES[$lab_file_name]['name']);
        for( $i=0 ; $i < $total ; $i++ ) {
            $new_name = $ref_key . '-' . $_FILES[$lab_file_name]['name'][$i];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($lab_file_name)) {
                return FALSE;
            } else {
                $return[] = $this->upload->data();
                //return TRUE;
            }
        }
        return $return;*/

        /*$new_name = $ref_key . '-' . $_FILES[$lab_file_name]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($lab_file_name)) {
            return FALSE;
        } else {
            return TRUE;
        }*/
    }

    public function do_upload_single($file, $lab_file_name, $ref_key){
        $config['upload_path'] = './lab_uploads/';
        $config['allowed_types'] = 'pdf|doc|xls|xlsx|png|jpeg|jpg|docx|otd|odtx|exls|exl';
        $config['max_size'] = 204000;
        $config['overwrite'] = TRUE;
        $new_name = $ref_key . '-' . $file[$lab_file_name]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($lab_file_name)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /* Download SOP Files */
    public function download_forms($filename) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('lab_uploads/' . $filename));
        force_download($filename, $data);
    }

    /* Delete SOP Files */
    public function delete_upload_docs($file_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = $this->session->userdata('record_id');
        $hospital_id = $this->ion_auth->user()->row()->id;
        if (isset($file_id) && isset($hospital_id)) 
		{
            $get_file_path_query = $this->db->query("SELECT * FROM uralensis_upload_forms WHERE id = $file_id ");
            $get_file_path = $get_file_path_query->result();
			//print $file_name=$get_file_path[0]->file_name;
			$this->db->query("DELETE FROM files WHERE file_name = '".$get_file_path[0]->file_name."'");
            unlink(base_url('lab_uploads/' . $get_file_path[0]->filename));
			$this->db->query("DELETE FROM uralensis_upload_forms WHERE id = $file_id");
            $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
            $this->session->set_flashdata('delete_file', $delete_file);
            redirect('laboratory', 'refresh');
        }
    }

    /* Track for viewer */
    public function track_viewer(){
        $json['status'] = "error";
        $json['message'] = "There might be some error. Please try again";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userId = $this->ion_auth->user()->row()->id;
            $dataArr = array(
                'document_id'   => $this->input->post('document_id'),
                'viewer_id'     => $userId,
                'created_by'    => $userId,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert("document_viewers", $dataArr);
            if ($this->db->insert_id() > 0) {
                $json['status'] = "success";
                $json['message'] = "Viewer data save successfully";
            }
        }
        echo json_encode($json); exit;
    }

    public function supportZoneArea(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $lab_id = $this->group_id;

//        $this->load->view('doctor/inc/header-new');
//        $this->load->view('laboratory/add_category');
//        $this->load->view('doctor/inc/footer-new');

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $status = $this->input->post("status");
            if($status=="delete"){

            }
            $area_name = $this->input->post("leave_group");

            $insData['lab_id'] = $lab_id;
            $insData['area'] = $area_name;
            $checkStatus = $this->db->insert("lab_support_area",$insData);
            if($checkStatus){
                $json['status'] = 'success';
                $json['message'] = 'Data added successfully.';
                echo json_encode($json);
            } else {
                $json['status'] = 'fail';
                $json['message'] = 'Failed to add data';
                echo json_encode($json);
            }
            exit;

        }

        $getLabArea = $this->db->select("*")->where(array("lab_id"=>$lab_id))->get("lab_support_area")->result();

        $data['lab_areas'] = $getLabArea;

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/support_category', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function getLabSupportArea(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $lab_id = $this->input->post("dataId");
            $getLabArea = $this->db->select("*")->where(array("lab_id"=>$lab_id))->get("lab_support_area")->result();
            $createHtml= "";
            $createHtml .= "<option value=''>Select Area</option>";
            foreach ($getLabArea as $labArea){
                $createHtml .= "<option value='".$labArea->id."'>".$labArea->area."</option>";
            }
            $json['html'] = $createHtml;
            echo json_encode($json);
            exit;

        }
    }

    public function create_user($cgroup_id = '', $hsa = '')
    {
        // Post Request Part
        $group_row = $this->ion_auth->get_users_main_groups()->row();

        /*if($group_row->group_type != 'LA'){
            redirect('/laboratory', 'refresh');
        }*/
        //track_user_activity();
		
        $this->load->model('Admin_model');
        $this->data['title'] = $this->lang->line('create_user_heading');
        $this->data['javascripts'] = array('password/js/jquery.passwordRequirements.min.js', 'password/js/custom.js', 'js/auth/create_user.js');
       // array_unshift($this->h_data['styles'], 'password/css/jquery.passwordRequirements.css');
        $includes['styles'] = array('password/css/jquery.passwordRequirements.css');

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
//        if ($identity_column !== 'email') {
//            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
//            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
//        } else {
//            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|callback__unique_email');
//        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_rules('user_role', 'User role is required', 'required');
        $this->form_validation->set_rules('clinic_id', 'Clinic is required', 'required');
        $this->form_validation->set_rules('memorable', 'Memorable word is required', 'required');

        if ($this->form_validation->run() === TRUE)
        {
            // If Post Data Valid. Complete Save Data

            $last_user_id = $this->db->select_max("id")->get("users")->result_array();
            if (empty($last_user_id)) {
                $last_user_id = '';
            } else {
                $last_user_id = intval($last_user_id[0]["id"]) + 1;
            }

            $username = strtolower($this->input->post('first_name')) . '_' . strtolower($this->input->post('last_name')) . $last_user_id;
            $email = $this->input->post('email');
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');
            $user_role = $this->input->post('user_role');
            // $group_id = $user_role;//$this->Admin_model->get_group_id(trim($user_role));
            $group_id = $this->Admin_model->get_group_id(trim($user_role));
            if($this->input->post('user_role')==63)
            {
                $is_hospital_admin = 1;
            }
            else
            {
                $is_hospital_admin = 0;
            }
            $profile_picture = DEFAULT_PROFILE_PIC;

            // Upload profile picture if exists

            if (!empty($_FILES['profile_pic']["name"])) { //when user submit basic profile info with profile image
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['file_name'] = time() . '-' . $_FILES['profile_pic']["name"];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile_pic'))
                {
                    $error = 0;
                } else {
                    $filedata = array('upload_data' => $this->upload->data());
                    $profile_image = $filedata['upload_data']['file_name'];
                    $image_path = 'uploads/' . $config['file_name'];
                    $profile_picture = $image_path;
                }
            }

            $additional_data = [
                'username' => $this->db->escape($username),
                'first_name' => $this->db->escape($this->input->post('first_name')),
                'last_name' => $this->db->escape($this->input->post('last_name')),
                'company' => $this->db->escape($this->input->post('company')),
                'phone' => $this->db->escape($this->input->post('phone')),
                'memorable' => $this->db->escape($this->input->post('memorable')),
                'is_hospital_admin' => $is_hospital_admin,
                'profile_picture_path' => $this->db->escape($profile_picture),
                'user_type' => $this->db->escape($user_role),
                'sub_role' => $this->input->post('user_sub_role'),
                'clinic_id' => $this->input->post('clinic_id'),
                'group_id' => $group_id
            ];

            // Check User Group
            $groups_array = array($group_id);

            $user_ids=$this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array);
            if ($user_ids)
            {
                $groupRow = $this->ion_auth->get_users_groups()->row();
                $mainGroupRow = $this->ion_auth->get_users_main_groups()->row();

                $this->db->insert('users_groups', [
                    'user_id' => $user_ids,
                    'group_id' => $this->input->post('user_role'),
                    'institute_id' => $this->input->post('clinic_id')
                ]);

                $this->db->insert('hospital_group', [
                    'hospital_id' => $this->input->post('clinic_id'),
                    'group_id' => $user_ids
                ]);

                /*$userRoles = $this->input->post('Hgroup_id');
                foreach ($userRoles as $role=>$roleData){
                    $temp_data = array(
                        'user_id' => $user_ids,
                        'group_id' => $mainGroupRow->id,
                        'institute_id' => $roleData
                    );
                    $this->db->insert('users_groups', $temp_data);

                    $hos_data = array(
                        'hospital_id' => $roleData,
                        'group_id' => $user_ids
                    );

                    $this->db->insert('hospital_group', $hos_data);
                }*/
                // $this->sendVerificationEmail($email);
                $this->sendAdminVerificationEmail($email, $password);
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                if($cgroup_id != ''){
                    if($hsa && $hsa != ''){
                        return redirect('institute', 'refresh');
                    }else{
                        return redirect('laboratory/team_view/'.$cgroup_id, 'refresh');    
                    }
                }else{
                    return redirect('laboratory/create_user', 'refresh');
                }
                
            }
        }

        // Display the create user form
        // Set the flash data error message if there is one
//        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['first_name'] = [
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        ];
        $this->data['last_name'] = [
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        ];
        $this->data['email'] = [
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email'),
        ];
        $this->data['company'] = [
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company'),
        ];
        $this->data['phone'] = [
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone'),
        ];
        $this->data['password'] = [
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'value' => $this->form_validation->set_value('password'),
        ];
        $this->data['password_confirm'] = [
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'value' => $this->form_validation->set_value('password_confirm'),
        ];
        $this->data['memorable'] = [
            'name' => 'memorable',
            'id' => 'memorable',
            'type' => 'text',
            'value' => $this->form_validation->set_value('memorable'),
        ];
        $this->data['user_roles'] = $this->Admin_model->getUserGroupsuserCreation();
        $this->data['user_typeH'] = $this->Admin_model->getGroupsDateByType('H');
        $this->data['user_typeL'] = $this->Admin_model->getGroupsDateByType('L');
        $this->data['user_typeP'] = $this->Admin_model->getGroupsDateByType('P');

        //$hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        $hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
        $hospital_ids = [$hospital_id];
        $this->data['clinicArr'] = $this->Doctor_model->display_hospitals_list_with_org();
        $this->data['cgroup_id'] = ($cgroup_id == 'hsa') ? "" : base64_decode($cgroup_id);
        $doctor_id = $this->ion_auth->user()->row()->id;
        $user_type = $this->Doctor_model->get_user_type($doctor_id);
        $this->data['clinichId'] = $group_row->id;
        $this->data['userType'] = $user_type;
        $this->data['hsa'] = $hsa;
        //$this->data['clinicianArr'] = $this->Institute_model->get_clinic($hospital_id);
        //pre($this->data['clinicArr']);

        $this->load->view('templates/header-new', $includes);
        $this->load->view('laboratory/create_new_user', $this->data);
        $this->load->view('templates/footer-new');
    }

    public function edit_user($id){

        $this->load->model('Admin_model');
        $this->data['title'] = $this->lang->line('edit_user_heading');
        $this->data['javascripts'] = array('password/js/jquery.passwordRequirements.min.js', 'password/js/custom.js', 'js/auth/create_user.js');
        //array_unshift($this->h_data['styles'], 'password/css/jquery.passwordRequirements.css');
        $includes['styles'] = array('password/css/jquery.passwordRequirements.css');

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }

        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('clinic_id', 'Clinic is required', 'required');
        $this->form_validation->set_rules('memorable', 'Memorable word is required', 'required');

        $user = $this->ion_auth->user($id)->row();
        $group_info = $this->ion_auth->get_users_groups($id)->row();

        $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($id);
        $this->data['user_details'] = array(
            'first_name'=>$this->form_validation->set_value('first_name', $decryptedDetails->first_name),
            'last_name'=>$this->form_validation->set_value('last_name', $decryptedDetails->last_name),
            'company'=>$this->form_validation->set_value('company', $decryptedDetails->company),
            'phone'=>$this->form_validation->set_value('phone', $decryptedDetails->phone),
            'email'=>$decryptedDetails->email,
            'fee_per_case'=>$decryptedDetails->fee_per_case,
            'fee_per_specimen'=>$decryptedDetails->fee_per_specimen,
            'is_hospital_admin'=>$decryptedDetails->is_hospital_admin,
            'memorable'=>$this->form_validation->set_value('memorable', $user->memorable),
            'login_token'=>$this->form_validation->set_value('login_token', $decryptedDetails->login_token),
            'profile_image_name'=>$this->form_validation->set_value('profile_image_name', $user->picture_name),
            'profile_image_path'=>$this->form_validation->set_value('profile_image_path', $user->profile_picture_path),
            'clinic_id' => $decryptedDetails->clinic_id,
            'user_role_name' => $group_info->name,
            'user_role_id' => $group_info->id
        );
        $this->data['user_id'] = $id;
        $this->data['clinicArr'] = $this->Doctor_model->display_hospitals_list_with_org();

        if (isset($_POST) && !empty($_POST)) {
            $current_email = $this->input->post("email");
            $pre_email = $this->input->post("pre_email");
            if ($this->form_validation->run() === TRUE) {

                // Update login token on tbl login table
                $token = $this->input->post('token');
                $data = array(
                    'useremail' => $current_email,
                    'token' => $token,
                    'token_status' => 1
                );
                $this->db->where('useremail',$current_email);
                $q = $this->db->get('tbl_pins');

                if ( $q->num_rows() > 0 ) 
                {
                    $this->db->where('useremail',$current_email);
                    $this->db->update('tbl_pins',$data);
                } else {
                    $this->db->insert('tbl_pins', $data);
                }

                if (!empty($_FILES['profile_pic']["name"])) { //when user submit basic profile info with profile image
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10000';
                    $config['file_name'] = time() . '-' . $_FILES['profile_pic']["name"];

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('profile_pic'))
                    {
                        $error = 0;
                    } else {
                        $filedata = array('upload_data' => $this->upload->data());
                        $profile_image = $filedata['upload_data']['file_name'];
                        $image_path = 'uploads/' . $config['file_name'];
                        $profile_picture = $image_path;
                        $_POST['profile_picture_path'] = $this->db->escape($profile_picture);
                    }
                }


                //update the memorable if it was posted
                $data = array();
                if ($this->input->post('memorable')) {
                    $data['memorable'] = $this->input->post('memorable');
                }
                if ($this->input->post('login_token')) {
                    $data['login_token'] = $this->input->post('login_token');
                }

                $update_user_info =$this->Userextramodel->updateUserProfileByAdmin($user->id, $image_path, !empty($profile_image), ($current_email != $pre_email) ? 0 : $this->input->post("pre_status"));
                if($update_user_info){
                    $this->session->set_flashdata('message', 'User updated successfully');
                    redirect('laboratory');
                }
            }
        }

        $this->load->view('templates/header-new', $includes);
        $this->load->view('laboratory/edit_user', $this->data);
        $this->load->view('templates/footer-new');
    }

    public function sendVerificationEmail($email) {
        $message = $this->load->view("auth/email/verify_email", array('email' => $email), TRUE);
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8', //iso-8859-1
            'newline' => '\r\n',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
//        $logo = $this->email->attach("./uploads/logo/uralensis_latest.jpg", "inline");
//        $cid = $this->email->attachment_cid($logo);
        $this->email->from($this->session->email, 'PathHub');
        $this->email->to($email);
//        $this->email->set_header('Content-Type', 'text/html');
        $this->email->subject("Pathology Healthcare Email Verification");
        $this->email->message($message);
        $this->email->send();
//        if(!$this->email->send()){
//            print_r($this->email->print_debugger());
//        }
    }

    public function sendAdminVerificationEmail($email, $password) {
        $message = $this->load->view("auth/email/verify_admin_email", array('email' => $email, 'password' => $password), TRUE);
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8', //iso-8859-1
            'newline' => '\r\n',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
//        $logo = $this->email->attach("./uploads/logo/uralensis_latest.jpg", "inline");
//        $cid = $this->email->attachment_cid($logo);
        $this->email->from($this->session->email, 'PathHub');
        $this->email->to($email);
//        $this->email->set_header('Content-Type', 'text/html');
        $this->email->subject("Pathology Healthcare Email Verification");
        $this->email->message($message);
        $this->email->send();
//        if(!$this->email->send()){
//            print_r($this->email->print_debugger());
//        }
    }

    function addTestDataFromCsv() {

        if($_REQUEST) {
            //pre($_FILES);exit;

            $labId = $this->Doctor_model->getLabIdsFromUser($this->user_id);
            $labName = $this->lab->get_lab_name($labId);
            $labInitials = substr($labName["name"], 0, 4);
            //pre($labInitials);

            $fileName = $_FILES["UploadCSV"]["tmp_name"];
            //print $_FILES["UploadCSV"]["size"];exit;

            if ($_FILES["UploadCSV"]["size"] > 0)
            {
                $postdata = array();
                $file = fopen($fileName, "r");
                $i = 0;
                $j = 1;
                $records_data = "";
                $hospitalId = $this->ion_auth->get_users_main_groups()->row()->id;

                /*$hospital_row = $this->ion_auth->get_users_groups()->row();
                $hospital_id = $hospital_row->id;

                $f_initial = '';
                $l_initial = '';
                if (!empty($this->ion_auth->group($hospital_row->id)->row()->first_initial)) {
                    $f_initial = $this->ion_auth->group($hospital_row->id)->row()->first_initial;
                }
                if (!empty($this->ion_auth->group($hospital_row->id)->row()->last_initial)) {
                    $l_initial = $this->ion_auth->group($hospital_row->id)->row()->last_initial;
                }
                if (!empty($f_initial) && !empty($l_initial)) {
                    $last_d = str_pad($j, 4, "0", STR_PAD_LEFT);
                    $batch_no = $f_initial . $l_initial . '.' . date('y') . '.' . $last_d;
                } else {
                    $last_d = str_pad($j, 4, "0", STR_PAD_LEFT);
                    $batch_no = "AD" . '.' . date('y') . '.' . $last_d;
                }*/
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                    if ($i >= 1) {
                        if (isset($column[0])) {
                            $request['test_id'] = $column[0];
                        }
                        if (isset($column[1])) {
                            $request['name'] = $column[1];
                        }
                        if (isset($column[2])) {
                            $department_id = $this->db->get_where('departments', ['department'=>$column[2]])->row()->department_id;
                            if(!isset($department_id)){
                                $this->db->insert('departments', ['department'=>$column[2]]);
                                $department_id = $this->db->insert_id();
                            }
                            $request['department_id'] = $department_id;
                        }

                        if (isset($column[3]) && !empty($department_id)) {
                            $specialty_id = $this->db->get_where('speciality_group', ['spec_grp_name'=>$column[3]])->row()->spec_grp_id;
                            if(!isset($specialty_id)){
                                $this->db->insert('speciality_group', [
                                    'spec_grp_name' => $column[3],
                                    'department_id' => $department_id,
                                    'created_by'    => $this->user_id
                                ]);
                                $specialty_id = $this->db->insert_id();
                            }
                            $request['speciality_group_id'] = $specialty_id;
                            $request['specialty_id'] = $specialty_id;
                        }

                        if (isset($column[4])) {
                            $category_id = $this->db->get_where('tests_main_categories', ['name'=>$column[4]])->row()->id;
                            if(!isset($category_id)){
                                $this->db->insert('tests_main_categories', ['name' => $column[4]]);
                                $category_id = $this->db->insert_id();
                                $this->db->insert('laboratory_test_category', [
                                    'name' => $column[4],
                                    'laboratory_id' => $hospitalId,
                                    'department_id' => $department_id,
                                    'speciality_id' => $specialty_id
                                ]);
                            }
                            $request['category_id'] = $category_id;
                        }

                        if (isset($column[5]) && !empty($category_id)) {
                            $sub_category_id = $this->db->get_where('tests_sub_categories', ['name'=>$column[5]])->row()->id;
                            if(!isset($sub_category_id)){
                                $this->db->insert('tests_sub_categories', [
                                    'name' => $column[5],
                                    'main_category_id' => $category_id
                                ]);
                                $sub_category_id = $this->db->insert_id();
                            }
                            $request['sub_category_id'] = $sub_category_id;
                        }

                        if (isset($column[6])) {
                            $request['cost'] = $column[6];
                        }

                        if (isset($column[7])) {
                            $request['sale'] = $column[7];
                        }

                        $request['lab_id'] = $labId;
                        $request['lab_ref_name'] = $labInitials.'-'.$request['test_id'];
                        $request['user_id'] = $this->user_id;
                        $request['created_at'] = date("Y-m-d H:i:s");
                        $request['path_index'] = 0;
//pre($request);
                        $this->db->insert('laboratory_tests', $request);
                        $this->db->insert('lab_test', [
                            'lab_id' => $labId,
                            'laboratory_test_id' => $this->db->insert_id()
                        ]);
                        $this->db->insert('department_settings_labs', [
                            'hospital_id'       => $labId,
                            'department_id'     => $department_id,
                            'specialty_id'      => $specialty_id,
                            'category_id'       => $category_id,
                            'sub_category_id'   => $sub_category_id,
                            'department_name'   => $column[2],
                            'specialty'         => $column[3],
                            'category'          => $column[4],
                            'sub_category_name' => $column[5],
                            'created_by'        => $this->user_id,
                            'updated_by'        => $this->user_id,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        ]);
                    }
                    $i++;
                    $j++;
                }
                redirect('laboratory/laboratory_add_test', 'refresh'); return;
            } else {
                redirect('laboratory/laboratory_add_test', 'refresh'); return;
            }
        } else {
            print "Something went wrong, Please Try Again..!";
        }
        exit;
    }

    public function create_hospital()
    {
        // Only super admin allowed
        if (!$this->ion_auth->logged_in()) {
            return redirect('/', 'refresh');
        }
        $data = array();
        if ($this->input->method() === 'get') 
		{
            $data['javascripts'] = array('js/auth/create_hospital.js');
            $data['errors'] = FALSE;
            if (!empty($_SESSION['form_data'])) 
			{
                $data['errors'] = TRUE;
                $data['form_data'] = $_SESSION['form_data'];
            }

            $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('/'));
            $this->mybreadcrumb->add('Create Hospital', '#');
            $data['breadcrumbs'] = $this->mybreadcrumb->render();

            $this->load->model('Institute_model');
            $data['countries'] = $this->Institute_model->get_countries();
            $this->load->view('templates/header-new');
            $this->load->view('laboratory/create_hospital', $data);
            $this->load->view('templates/footer-new');

        } else if ($this->input->method() === 'post'){

            // Check for input validations
            $this->form_validation->set_rules('hospital_name', 'Institute Name', 'trim|required|is_unique[groups.description]');
            $this->form_validation->set_rules('hospital_initials_1', 'Hospital First Initial', 'trim|required|exact_length[1]');
            $this->form_validation->set_rules('hospital_initials_2', 'Hospital Second Initial', 'trim|required|exact_length[1]');
            $this->form_validation->set_rules('hospital_email', 'Hospital Email', 'trim|valid_email');

            // Form validation for admin data
            $this->form_validation->set_rules('admin_first_name', 'Admin First Name', 'trim|required');
            $this->form_validation->set_rules('admin_last_name', 'Admin Last Name', 'trim|required');
            $this->form_validation->set_rules('admin_email', 'Admin Email', 'required|valid_email');
            //$this->form_validation->set_rules('admin_email', 'Admin Email', 'required|valid_email|callback__unique_email');
            $this->form_validation->set_rules('admin_password', 'Admin Password', 'trim|required');
            $this->form_validation->set_rules('admin_password_confirm', 'Admin Password Confirm', 'trim|required|matches[admin_password]');
            $this->form_validation->set_rules('admin_memorable', 'Admin Memorable', 'trim|required');

            if ($this->form_validation->run() === TRUE) {
                // Institute data validated
                $new_group_id = $this->ion_auth->create_group_main(
                    strtolower(str_replace(' ', '', $this->input->post('hospital_name'))),
                    $this->input->post('hospital_initials_1'),
                    $this->input->post('hospital_initials_2'),
                    $this->input->post('hospital_name'),
                    'H',
                    $this->input->post('hospital_information'),
                    '',
                    'usergroup'
                );
                if ($new_group_id) {
					
					
					 $temp_data = array(
                            'user_id' => $user_id,
                            'group_id' => $mainGroupRow->id,
                            'institute_id' => $roleData
                        );
                       // $this->db->insert('users_groups', $temp_data);
        $group_row = $this->ion_auth->get_users_main_groups()->row();
        $group_id = $group_row->id; 

                        $hos_data = array(
                            'hospital_id' => $new_group_id,
                            'group_id' => $group_id
                        );

                        $this->db->insert('hospital_group', $hos_data);
					
					
					
					
                    // check to see if we are creating the group
                    // redirect them back to the admin page
                    $this->Admin_model->insertHospitalInformation([
                        'group_id'          => $new_group_id,
                        'hosp_address'      => $this->input->post('hospital_address'),
                        'hosp_country'      => $this->input->post('hospital_country'),
                        'hosp_city'         => $this->input->post('hospital_city'),
                        'hosp_state'        => $this->input->post('hospital_state'),
                        'hosp_post_code'    => $this->input->post('hospital_post_code'),
                        'hosp_email'        => $this->input->post('hospital_email'),
                        'hosp_phone'        => $this->input->post('hospital_number'),
                        'site_identifier'   => $this->input->post('site_identifier'),
                        'identifier'        => $this->input->post('identifier'),
                        'channel_no'        => $this->input->post('channel_no')
                    ]);
                    $hospital_info_id = $this->db->insert_id();
                    if($hospital_info_id){
                        $this->load->library('upload');
                        $new_name = '';
                        if($_FILES["hospital_logo"]['name']){
                            $temp = $_FILES["hospital_logo"]['name'];
                            $temp_arr = explode('.', $temp);
                            if(in_array(strtolower(end($temp_arr)), array('png', 'jpg', 'jpeg'))){
                                $new_name = $temp_arr[0].date('dmyhis').'.'.end($temp_arr);
                                $config['file_name'] = $new_name;
                                $config['upload_path'] = FCPATH.'uploads/logo/';
                                $config['allowed_types'] = '*';
                                $config['max_size'] = 2000;
                                $config['max_width'] = 1500;
                                $config['max_height'] = 1500;
                                $this->upload->initialize($config);
                                $this->load->library('upload', $config);

                                if ($this->upload->do_upload('hospital_logo')) {
                                    $this->db->update('hospital_information', ['logo' => $new_name], ['hosp_id' => $hospital_info_id]);
                                }
                            }else{
                                $this->session->set_flashdata('error_message', 'Only allow png, jpg and jpeg format for clinic logo.');
                            }
                        }
                    }


                    // Create hospital admin user
                    $username = strtolower($this->input->post('admin_first_name')) . ' ' . strtolower($this->input->post('admin_last_name'));
                    $email = $this->input->post('admin_email');
                    $identity = $email;
                    $password = $this->input->post('admin_password');
                    $is_hospital_admin = 1;

                    $group_id = $new_group_id;
                    $profile_picture = DEFAULT_PROFILE_PIC;
                    // Upload profile picture if exists
                    if ($_FILES['admin_profile_pic']["name"]) //when user submit basic profile info with profile image
                    {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = '10000';
                        $config['file_name'] = time() . '-' . $_FILES['admin_profile_pic']["name"];

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('admin_profile_pic')) {
                            $error = 0;
                        } else {
                            $filedata = array('upload_data' => $this->upload->data());
                            $profile_image = $filedata['upload_data']['file_name'];
                            $image_path = 'uploads/' . $config['file_name'];
                            $profile_picture = $image_path;
                        }
                    }
                    $user_type = 'HA';
                    $additional_data = [
                        'username'              => $this->db->escape($username),
                        'first_name'            => $this->db->escape($this->input->post('admin_first_name')),
                        'last_name'             => $this->db->escape($this->input->post('admin_last_name')),
                        'company'               => $this->db->escape($this->input->post('admin_company')),
                        'phone'                 => $this->db->escape($this->input->post('admin_phone')),
                        'memorable'             => $this->db->escape($this->input->post('admin_memorable')),
                        'is_hospital_admin'     => $is_hospital_admin,
                        'profile_picture_path'  => $this->db->escape($profile_picture),
                        'user_type'             => $this->db->escape($user_type),
                        'group_id'              => "",
                        'group_id' => $group_id,
                        'division_id' => 0,
                        'department_id' => 0,
                        'speciality_id' => 0,
                        'category_id' => 0,
                        'clinic_id' => 0
                    ];

                    $groups_array = array();
                    if ($group_id !== -1) {
                        $groups_array = array($group_id);
                    }
                    $this->sendAdminVerificationEmail($identity, $password);
                    // $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
                    $user_ids=$this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array,0);
                    if ($user_ids) {
                        $this->db->where('user_id', $user_ids)->update('users_groups', ['institute_id' => $new_group_id]);
                        // $group_row = $this->ion_auth->get_users_main_groups()->row();
                        // $group_id = $group_row->id;
                        // $this->db->where('user_id', $user_ids)->update('users_groups', ['institute_id' => $group_id]);
                        $this->db->where('id', $user_ids)->update('users', ['in_directory' => 1]);

                        /*$this->db->insert('hospital_group', [
                            'hospital_id'   => $this->input->post('Hgroup_id'),
                            'group_id'      => $user_ids
                        ]);*/
                    }

                    $this->session->set_flashdata('success', $this->ion_auth->messages());
                    redirect('laboratory/create_hospital', 'refresh');

                } else {
                    //return redirect()->back()->withInput()->with('errors', $this->validation->listErrors());
                    $this->session->set_flashdata('error', 'Error Creating, hospital user try again later');
                    return redirect('laboratory/create_hospital', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', validation_errors());
                $data['javascripts'] = array('js/auth/create_hospital.js');
                $data['errors'] = FALSE;
                if (!empty($_SESSION['form_data'])) {
                    $data['errors'] = TRUE;
                    $data['form_data'] = $_SESSION['form_data'];
                }

                $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('/'));
                $this->mybreadcrumb->add('Create Hospital', '#');
                $data['breadcrumbs'] = $this->mybreadcrumb->render();

                $this->load->model('Institute_model');
                $data['countries'] = $this->Institute_model->get_countries();
                $this->load->view('templates/header-new');
                $this->load->view('laboratory/create_hospital', $data);
                $this->load->view('templates/footer-new');
                // return redirect('laboratory/create_hospital', 'refresh');
                //return redirect()->back()->withInput()->with('errors', $this->validation->listErrors());
//                $this->output
//                    ->set_status_header(500)
//                    ->set_content_type('application/json')
//                    ->set_output(json_encode(array('status' => 'error', 'message' => 'Error Creating, hospital user try again later')));

            }
        } else {
            $this->output->set_status_header(405)->set_output("Method not allowed");
        }
    }

    public function lab_template($clinicId = ''){
        if($clinicId != ''){
            $clinicId =  base64_decode($clinicId);
        }
        $data = array();
        //$user_id = $this->ion_auth->user()->row()->id;
        //$group_id = $this->ion_auth->get_users_main_groups()->row()->id;
        //$group_type = $this->ion_auth->get_users_groups()->row()->group_type;

        $data["group_type"] = $this->group_type;
        $data["group_id"] = $this->group_id;
        $data["user_id"] = $this->user_id;

        $hospital_row = $this->ion_auth->get_users_main_groups()->row();
        $groupType= $hospital_row->group_type;
        $hospital_id = $hospital_row->id;
        $hospitalUserGroupArray = array("H","HA");
        if  (in_array($groupType, $hospitalUserGroupArray)) {
            $data["hospital_list"] = $this->Laboratory_model->get_alllab_Hospitalinfo($hospital_id);
        } else {
            $data["hospital_list"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
        }
        $data['categories'] = getMainTestCategories();
        $data['clinicId'] = $clinicId;
        $data['lab_templates'] = $this->lab->get_lab_templates($this->user_id, $clinicId);


        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('laboratory/lab_template_list.php', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function get_template_data(){
        $json = [ 'status'=>'error', 'msg'=>'There might be some error. Please try again', 'data'=>[] ];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $templateId = $this->input->post('id');
            if($templateId){
                $res = $this->db->get_where('lab_templates', ['id'=>$templateId])->row_array();
                if($res){
                    $json = ['status'=>'success', 'msg'=>'success', 'data' => $res];
                }
            }
        }
        echo json_encode($json); exit;
    }

    public function set_default_template(){
        $json = ['status'=>'error', 'type'=>'important' ,'msg'=>'There might be some error. Please try again'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $templateId = $this->input->post('id');
            if($templateId){
                $this->db->update('lab_templates', ['is_default'=>'0'], ['created_by'=>$this->user_id]);
                $this->db->update('lab_templates', ['is_default'=>'1'], ['id'=>$templateId]);
                $json = ['status'=>'success', 'type'=>'success', 'msg'=>'Default template save successfully.'];
            }
        }
        echo json_encode($json); exit;
    }

    public function add_template(){
        if ($this->input->post()) {

            $this->form_validation->set_rules('template_name', 'Template Name', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            $this->form_validation->set_rules('hospital_id', 'Clinic', 'required');
            $this->form_validation->set_rules('header', 'Header Name', 'trim|required');
            $this->form_validation->set_rules('footer', 'Footer Name', 'trim|required');

            if ($this->form_validation->run() == TRUE) {

                $user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->ion_auth->get_users_main_groups()->row()->id;

                if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0){
                    $ref_key = $user_id;
                    $upload_doc = $this->do_upload_lab_files('files', $ref_key, 'logo/');

                    if (!empty($upload_doc['error_upload'])){
                        $error = array('upload_error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', $error['upload_error']);
                        return redirect('laboratory/lab_template', 'refresh');
                    }
                    $dataArr = $upload_doc['success'];
                    foreach ($dataArr as $data){
                        $logo_file_name = $data['file_name'];
                        $logo_path = "lab_uploads/logo/" . $logo_file_name;
                        break;
                    }
                }
                $dataArr = [
                    'template_name' => $this->input->post('template_name'),
                    'logo'          => !empty($logo_file_name) ? $logo_file_name : '',
                    'logo_path'     => !empty($logo_path) ? $logo_path : '',
                    'category_id'   => $this->input->post('category_id'),
                    'hospital_id'   => $this->input->post('hospital_id'),
                    'header'        => $this->input->post('header'),
                    'footer'        => $this->input->post('footer'),
                    'group_id'      => $this->input->post('group_id'),
                    //'group_id'      => $group_id,
                    'lab_id'        => $group_id,
                    'created_by'    => $user_id,
                    'updated_by'    => $user_id,
                ];
                $this->db->insert('lab_templates', $dataArr);
                $this->session->set_flashdata('success', 'Template add successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
            }
        }else{
            $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
        }
        return redirect('laboratory/lab_template', 'refresh');
    }

    public function edit_template(){
        if ($this->input->post()) {

            $this->form_validation->set_rules('template_name', 'Template Name', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            $this->form_validation->set_rules('hospital_id', 'Clinic', 'required');
            $this->form_validation->set_rules('header', 'Header Name', 'trim|required');
            $this->form_validation->set_rules('footer', 'Footer Name', 'trim|required');

            if ($this->form_validation->run() == TRUE) {

                $id = $this->input->post('id');
                $user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->ion_auth->get_users_main_groups()->row()->id;
                $isUpdateFlag = false;
                if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0 && !empty($_FILES['files']['name'][0])){
                    $ref_key = $user_id;
                    $upload_doc = $this->do_upload_lab_files('files', $ref_key, 'logo/');

                    if (!empty($upload_doc['error_upload'])){
                        $error = array('upload_error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', $error['upload_error']);
                        return redirect('laboratory/lab_template', 'refresh');
                    }
                    $dataArr = $upload_doc['success'];
                    $templateData = $this->db->get_where('lab_templates', ['id'=>$id])->row_array();
                    foreach ($dataArr as $data){
                        if($data['file_name'] && !empty($data['file_name'])){
                            $logo_file_name = $data['file_name'];
                            $logo_path = "lab_uploads/logo/" . $logo_file_name;
                            unlink($templateData['logo_path']);
                            $isUpdateFlag = true;
                            break;
                        }
                    }
                }
                $dataArr = [
                    'template_name' => $this->input->post('template_name'),
                    'category_id'   => $this->input->post('category_id'),
                    'hospital_id'   => $this->input->post('hospital_id'),
                    'header'        => $this->input->post('header'),
                    'footer'        => $this->input->post('footer'),
                    'group_id'      => $this->input->post('group_id'),
                    'updated_by'    => $user_id,
                ];
                if($isUpdateFlag){
                    $dataArr['logo'] = $logo_file_name;
                    $dataArr['logo_path'] = $logo_path;
                }
                $this->db->where(['id'=>$id])->update('lab_templates', $dataArr);
                $this->session->set_flashdata('success', 'Template update successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
            }
        }else{
            $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
        }
        return redirect('laboratory/lab_template', 'refresh');
    }

    public function delete_lab_template($id) {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($id)) {
            $template = $this->db->get_where('lab_templates', ['id'=>$id])->row_array();
            $res = $this->db->where(['id'=>$id])->delete('lab_templates');
            if($res){
                unlink($template['logo_path']);
                $this->session->set_flashdata('success', 'Template delete successfully.');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
            }
        }else{
            $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
        }
        redirect('laboratory/lab_template', 'refresh');
    }

    public function create_clinician(){
        if($this->input->post()){
            $record_id = $this->input->post('record_id');
            $tables = $this->config->item('tables', 'ion_auth');
            $identity_column = $this->config->item('identity', 'ion_auth');

            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('provider_no', 'Provider No', 'required');
            if ($identity_column !== 'email') {
                $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
            } else {
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
            }

            if ($this->form_validation->run() === TRUE) {
                $last_user_id = $this->db->select_max("id")->get("users")->result_array();
                if (empty($last_user_id)) {
                    $last_user_id = '';
                } else {
                    $last_user_id = intval($last_user_id[0]["id"]) + 1;
                }

                $username = strtolower($this->input->post('first_name')) . '_' . strtolower($this->input->post('last_name')) . $last_user_id;
                $email = $this->input->post('email');
                $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
                $password = 'Test@123';
                $memorable = '1234';
                $user_role = $this->db->get_where('groups', ['parent_group_type' => 'H', 'group_type' => 'C'])->row()->id;    //Get Clinician ID
                $group_id = $user_role;//$this->Admin_model->get_group_id(trim($user_role));
                if ($user_role == 62) {
                    $is_hospital_admin = 1;
                } else {
                    $is_hospital_admin = 0;
                }
                $profile_picture = DEFAULT_PROFILE_PIC;

                $additional_data = [
                    'username' => $this->db->escape($username),
                    'first_name' => $this->db->escape($this->input->post('first_name')),
                    'last_name' => $this->db->escape($this->input->post('last_name')),
                    'company' => $this->db->escape(''),
                    'phone' => $this->db->escape(''),
                    'memorable' => $this->db->escape($memorable),
                    'is_hospital_admin' => $is_hospital_admin,
                    'profile_picture_path' => $this->db->escape($profile_picture),
                    'user_type' => $this->db->escape('C'),
                    'provider_no' => $this->db->escape($this->input->post('provider_no')),
                    //'sub_role' => $this->input->post('user_sub_role'),
                    'group_id' => $group_id
                ];

                // Check User Group
                $groups_array = array($group_id);
                $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array);
                if ($user_id){
                    $groupRow = $this->ion_auth->get_users_groups()->row();
                    $mainGroupRow = $this->ion_auth->get_users_main_groups()->row();

                    /*$this->db->insert('users_groups', [
                        'user_id' => $user_id,
                        'group_id' => $mainGroupRow->id,
                        'institute_id' => $groupRow->id
                    ]);*/
                    $this->db->insert('users_groups', [
                        'user_id' => $user_id,
                        'group_id' => $mainGroupRow->id,
                        'institute_id' => $mainGroupRow->id
                    ]);

                    $this->db->insert('hospital_group', [
                        'hospital_id' => $groupRow->id,
                        'group_id' => $mainGroupRow->id
                    ]);

                    /*$userRoles = $this->input->post('Hgroup_id');
                    foreach ($userRoles as $role=>$roleData){
                        $temp_data = array(
                            'user_id' => $user_id,
                            'group_id' => $mainGroupRow->id,
                            'institute_id' => $roleData
                        );
                        $this->db->insert('users_groups', $temp_data);

                        $hos_data = array(
                            'hospital_id' => $roleData,
                            'group_id' => $user_id
                        );

                        $this->db->insert('hospital_group', $hos_data);
                    }*/
                    $this->sendVerificationEmail($email);
                    //$this->db->update('request', ['dermatological_surgeon' => $user_id], ['uralensis_request_id' => $record_id]);
                    $requestClinicianData = array(
                        'request_id' => $record_id,
                        'clinician_id' => $user_id,
                        'added_by' => $this->ion_auth->user()->row()->id,
                    );
                    $this->db->insert('request_clinicians', $requestClinicianData);

                    $this->session->set_flashdata('success', true);
                    $this->session->set_flashdata('message', 'Create new clinician & update it.');
                    redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
                    return $user_id;
                }
            }else{
                $this->session->set_flashdata('error', true);
                $this->session->set_flashdata('message', validation_errors());
                redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
            }
        }
    }

    public function create_pathologist(){
        if($this->input->post()){
            $record_id = $this->input->post('record_id');
            $identity_column = $this->config->item('identity', 'ion_auth');
            $tables = $this->config->item('tables', 'ion_auth');

            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            if ($identity_column !== 'email') {
                $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
            } else {
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
            }

            if ($this->form_validation->run() === TRUE) {
                $last_user_id = $this->db->select_max("id")->get("users")->result_array();
                if (empty($last_user_id)) {
                    $last_user_id = '';
                } else {
                    $last_user_id = intval($last_user_id[0]["id"]) + 1;
                }

                $username = strtolower($this->input->post('first_name')) . '_' . strtolower($this->input->post('last_name')) . $last_user_id;
                $email = $this->input->post('email');
                $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
                $password = 'Test@123';
                $memorable = '1234';
                $user_role = $this->db->get_where('groups', ['parent_group_type' => 'D', 'group_type' => 'D'])->row()->id;    //Get Clinician ID
                $group_id = $user_role;//$this->Admin_model->get_group_id(trim($user_role));
                if ($user_role == 62) {
                    $is_hospital_admin = 1;
                } else {
                    $is_hospital_admin = 0;
                }
                $profile_picture = DEFAULT_PROFILE_PIC;

                $additional_data = [
                    'username' => $this->db->escape($username),
                    'first_name' => $this->db->escape($this->input->post('first_name')),
                    'last_name' => $this->db->escape($this->input->post('last_name')),
                    'company' => $this->db->escape(''),
                    'phone' => $this->db->escape(''),
                    'memorable' => $this->db->escape($memorable),
                    'is_hospital_admin' => $is_hospital_admin,
                    'profile_picture_path' => $this->db->escape($profile_picture),
                    'user_type' => $this->db->escape('D'),
                    //'sub_role' => $this->input->post('user_sub_role'),
                    'group_id' => $group_id
                ];

                // Check User Group
                $groups_array = array($group_id);
                $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array);
                if ($user_id)
                {
                    $groupRow = $this->ion_auth->get_users_groups()->row();
                    $mainGroupRow = $this->ion_auth->get_users_main_groups()->row();

                    /*$this->db->insert('users_groups', [
                        'user_id' => $user_id,
                        'group_id' => $mainGroupRow->id,
                        'institute_id' => $groupRow->id
                    ]);*/
                    $updateUserData = [
                        'fee_per_case' => $this->input->post('fee_per_case'),
                        'fee_per_specimen' => $this->input->post('fee_per_specimen'),
                    ];
                    $this->db->update('users', $updateUserData, ['id' => $user_id]);

                    $this->db->insert('users_groups', [
                        'user_id' => $user_id,
                        'group_id' => $group_id,
                        'institute_id' => $mainGroupRow->id
                    ]);

                    $this->db->insert('hospital_group', [
                        'hospital_id' => $groupRow->id,
                        'group_id' => $mainGroupRow->id
                    ]);

                    $this->sendVerificationEmail($email);
                    $this->db->update('request_assignee', ['user_id' => $user_id], ['request_id' => $record_id]);
                    $this->session->set_flashdata('success', true);
                    $this->session->set_flashdata('message', 'Create new pathologist & update it.');
                    redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
                    return $user_id;
                }
            }else{
                $this->session->set_flashdata('error', true);
                $this->session->set_flashdata('message', validation_errors());
                redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
            }
        }
    }

    public function test(){
        $res = serial_number('users', 'id', 'PCI', ['ip_address' => '119.158.15.242']);
        echo $res;exit;
    }    
    public function edit_clinic($id){
        $autoload['helper'] = array('form', 'html', 'url');
        $clinic_id = base64_decode($id);

        $this->form_validation->set_rules('hospital_name', 'Clinic Name', 'required');
        $data['countries'] = $this->Institute_model->get_countries();
        $data['clinic'] = $this->Laboratory_model->get_clinic($clinic_id);
        $subEmpQuery = "select COUNT(id) as emp_count from users_groups where users_groups.institute_id=".$data['clinic']['hospital_id'];
        $data['employee_count'] = $this->db->query($subEmpQuery)->row()->emp_count;
        $getResult = $this->ion_auth->get_users_main_groups()->row();		
        $data['departmentURL'] = base_url()."/department/laboratory/" . $getResult->id;
        if(!$getResult){
            $data['departmentURL'] = base_url()."/department/laboratory/" . base64_decode($this->input->get('hid', TRUE));
        }
        $hospital_row = $this->ion_auth->get_users_groups()->row();
        $hospital_id = $hospital_row->id;
        $data["pathologist_info"] = $this->Laboratory_model->get_lab_users_count($hospital_id,$data['clinic']['hospital_id']);
        if($data['clinic'])
        {
            if ($this->form_validation->run() == FALSE) { 
                $this->load->view('templates/header-new');
                $this->load->view('laboratory/edit_clinic', $data);
                $this->load->view('templates/footer-new');
            }else{
                $this->load->library('upload');  
                $new_name = '';          
                if($_FILES["logo"]['name']){                
                    $temp = $_FILES["logo"]['name'];
                    $temp_arr =explode('.', $temp);
                    if(!in_array(strtolower(end($temp_arr)), array('png', 'jpg', 'jpeg'))){
                        $this->session->set_flashdata('error_message', 'Only allow png, jpg and jpeg format.');
                        redirect("laboratory/edit_clinic/$id");exit;
                    }
                    $new_name = $temp_arr[0].date('dmyhis').'.'.end($temp_arr);
                    $config['file_name'] = $new_name;
                    $config['upload_path'] = FCPATH.'uploads/logo/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 2000;
                    $config['max_width'] = 1500;
                    $config['max_height'] = 1500;
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('logo')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error_message', $error['error']);
                        redirect("laboratory/edit_clinic/$id");exit;
                    }
                }
                
                $group_data['description'] = $this->input->post('hospital_name');
                $group_data['first_initial'] = $this->input->post('hospital_initials_1');
                $group_data['last_initial'] = $this->input->post('hospital_initials_2');            

                $hosp_data['hosp_address'] = $this->input->post('hospital_address');
                $hosp_data['hosp_country'] = $this->input->post('hospital_country');
                $hosp_data['hosp_city'] = $this->input->post('hospital_city');
                $hosp_data['hosp_state'] = $this->input->post('hospital_state');
                $hosp_data['hosp_post_code'] = $this->input->post('hospital_post_code');
                $hosp_data['hosp_email'] = $this->input->post('hospital_email');
                $hosp_data['hosp_fax'] = $this->input->post('hospital_fax');
                $hosp_data['hosp_mobile'] = $this->input->post('hospital_mobile_num');
                $hosp_data['hosp_phone'] = $this->input->post('hospital_number');            
                $hosp_data['hosp_website'] = $this->input->post('hospital_website');
                $hosp_data['site_identifier'] = $this->input->post('site_identifier');
                $hosp_data['identifier'] = $this->input->post('identifier');
                $hosp_data['channel_no'] = $this->input->post('channel_no');
                $hosp_data['logo'] = $new_name;

                $this->Laboratory_model->update_group($group_data, $data['clinic']['group_id'], $hosp_data, $clinic_id, 'hospital_information'); 
                $this->session->set_flashdata('message', 'Clinic updated successfully!');
                redirect('laboratory/Labview/H');
            }    
        }else{
            redirect('laboratory/Labview/H');
        }
        
    }
    public function edit_lab($id){        
        $lab_id = base64_decode($id);        
        
        $this->form_validation->set_rules('hospital_name', 'Lab Name', 'required');
        $data['countries'] = $this->Institute_model->get_countries();
        $data['lab'] = $this->Laboratory_model->get_lab($lab_id);        
        if($data['lab']){
            if ($this->form_validation->run() == FALSE) {             
                $this->load->view('templates/header-new');
                $this->load->view('laboratory/edit_lab', $data);
                $this->load->view('templates/footer-new');
            }else{  
                $this->load->library('upload');  
                $new_name = '';          
                if($_FILES["logo"]['name']){                
                    $temp = $_FILES["logo"]['name'];
                    $temp_arr =explode('.', $temp);
                    if(!in_array(strtolower(end($temp_arr)), array('png', 'jpg', 'jpeg'))){
                        $this->session->set_flashdata('error_message', 'Only allow png, jpg and jpeg format.');
                        redirect("laboratory/edit_clinic/$id");exit;
                    }
                    $new_name = $temp_arr[0].date('dmyhis').'.'.end($temp_arr);
                    $config['file_name'] = $new_name;
                    $config['upload_path'] = FCPATH.'uploads/logo/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 2000;
                    $config['max_width'] = 1500;
                    $config['max_height'] = 1500;
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('logo')) {
                        $error = array('error' => $this->upload->display_errors());                    
                        $this->session->set_flashdata('error_message', $error['error']);
                        redirect("laboratory/edit_lab/$id");exit;
                    }
                }

                $group_data['description'] = $this->input->post('hospital_name');
                $group_data['first_initial'] = $this->input->post('hospital_initials_1');
                $group_data['last_initial'] = $this->input->post('hospital_initials_2');            

                $lab_data['lab_address'] = $this->input->post('hospital_address');
                $lab_data['lab_country'] = $this->input->post('hospital_country');
                $lab_data['lab_city'] = $this->input->post('hospital_city');
                $lab_data['lab_state'] = $this->input->post('hospital_state');
                $lab_data['lab_post_code'] = $this->input->post('hospital_post_code');
                $lab_data['lab_email'] = $this->input->post('hospital_email');
                $lab_data['lab_fax'] = $this->input->post('hospital_fax');
                $lab_data['lab_mobile'] = $this->input->post('hospital_mobile_num');
                $lab_data['lab_phone'] = $this->input->post('hospital_number');            
                $lab_data['lab_website'] = $this->input->post('hospital_website');
                $lab_data['site_identifier'] = $this->input->post('site_identifier');
                $lab_data['identifier'] = $this->input->post('identifier');
                $lab_data['logo'] = $new_name;

                $this->Laboratory_model->update_group($group_data, $data['lab']['group_id'], $lab_data, $lab_id, 'laboratory_information'); 
                $this->session->set_flashdata('message', 'Lab updated successfully!');
                redirect('laboratory/Labview/L');            
            }    
        }else{
            redirect('laboratory/Labview/L');
        }
        
    }

    public function billing(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userId = $this->session->userdata('user_id');
        $data = array();
        $data["result"] = $this->billing_model->billingData($userId);

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/billing', $data);
        $this->load->view('templates/footer-new');
    }

    public function add_billing(){

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $data['default_slide'] = ($_POST && $_POST['slides']) ? $_POST['slides'] : 1;

        $hospital = $this->ion_auth->get_users_main_groups()->row();
        $data['group_type'] = $this->ion_auth->get_users_groups()->row()->group_type;
        $data['group_id'] = "";
        if (in_array($hospital->group_type, ["H","HA"])){
            $data["clinicArr"] = $this->Laboratory_model->get_alllab_Hospitalinfo($hospital->id);
            if($data['group_type'] == 'HA'){
                $data["clinicArr"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
                $data['group_id'] = $this->ion_auth->get_users_main_groups()->row()->id;
            }
        } else {
            $data["clinicArr"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
        }
        $data['specimenTypeArr'] = $this->billing_model->get_specimen_type();
        // Get tissue type here
        $data['tissue_type'] = $this->db->get('tissue_type')->result_array();

        if($this->input->post()){
            $this->form_validation->set_rules('clinic_id', 'Clinic', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('bill_code', 'Bill Code', 'required');
            $this->form_validation->set_rules('specimen_type_id', 'Specimen Type', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');

            if ($this->form_validation->run() === TRUE) {
                $post = $this->input->post(NULL, true);
                $this->db->insert('billing_data', [
                    'group_id'          => $hospital->id,
                    'clinic_id'         => $post['clinic_id'],
                    'type'              => $post['type'],
                    'category'          => $post['category'],
                    'bill_code'         => $post['bill_code'],
                    'bill_description'  => $post['bill_description'],
                    'specimen_type_id'  => $post['specimen_type_id'],
                    'price'             => $post['price'],
                    'tissue_type'       => $post['tissue_type'],
                    'created_by'        => $this->user_id,
                    'updated_by'        => $this->user_id
                ]);
                if($this->db->insert_id()){
                    $this->session->set_flashdata('success', 'Billing data add successfully');
                    // redirect('laboratory/billing');
                    if($data['group_type'] == 'HA'){
                        redirect("invoice/billingcodelist");
                    }else{
                        redirect("laboratory/billing");
                    }
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/billing_add', $data);
        $this->load->view('templates/footer-new');
    }

    public function updateBillingType(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $response['status'] = "fail";
        $response['message'] = "Something went wrong. Please try again!!!";
        $dataArr = [
            'billing_type'   => $this->input->post('btype'),
        ];
        if($this->db->update('hospital_information', $dataArr, ['hosp_id' => base64_decode($this->input->post('hid'))])){
            $response['status'] = "success";
            $response['message'] = "Billing type has been changed successfully!!!!";
        }
        echo json_encode($response);exit;
    }

    public function edit_billing($id){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['default_slide'] = ($_POST && $_POST['slides']) ? $_POST['slides'] : 1;

        $hospital = $this->ion_auth->get_users_main_groups()->row();
        $data['group_type'] = $this->ion_auth->get_users_groups()->row()->group_type;
        $data['group_id'] = "";
        if (in_array($hospital->group_type, ["H","HA"])){
            $data["clinicArr"] = $this->Laboratory_model->get_alllab_Hospitalinfo($hospital->id);
            if($data['group_type'] == 'HA'){
                $data["clinicArr"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
                $data['group_id'] = $this->ion_auth->get_users_main_groups()->row()->id;
            }
        } else {
            $data["clinicArr"] = $this->Laboratory_model->get_alllab_Hospitalinfo(0);
        }
        $data['specimenTypeArr'] = $this->billing_model->get_specimen_type();
        // Get tissue type here
        $data['tissue_type'] = $this->db->get('tissue_type')->result_array();
        $data['resultArr'] = $this->billing_model->get_bill_detail($id);
        $data['id'] = $id;

        if($this->input->post()){
            $this->form_validation->set_rules('clinic_id', 'Clinic', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('bill_code', 'Bill Code', 'required');
            $this->form_validation->set_rules('specimen_type_id', 'Specimen Type', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');

            if ($this->form_validation->run() === TRUE) {
                $post = $this->input->post(NULL, true);
                $dataArr = [
                    'clinic_id'         => $post['clinic_id'],
                    'type'              => $post['type'],
                    'category'          => $post['category'],
                    'bill_code'         => $post['bill_code'],
                    'bill_description'  => $post['bill_description'],
                    'specimen_type_id'  => $post['specimen_type_id'],
                    'price'             => $post['price'],
                    'tissue_type'       => $post['tissue_type'],
                    'updated_by'        => $this->user_id
                ];
                $res = $this->db->update('billing_data', $dataArr, ['id' => $id]);
                if($res){
                    $this->session->set_flashdata('success', 'Billing data update successfully');
                    //redirect("laboratory/edit_billing/$id");
                    if($data['group_type'] == 'HA'){
                        redirect("invoice/billingcodelist");
                    }else{
                        redirect("laboratory/billing");
                    }
                    
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/billing_edit', $data);
        $this->load->view('templates/footer-new');
    }

    public function delete_billing($id){
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        if(!empty($id) && $id > 0){
            $count = $this->db->get_where('billing_data', ['id' => $id])->num_rows();
            if($count > 0){
                $res = $this->db->where('id', $id)->delete('billing_data');
                if($res){
                    $this->session->set_flashdata('success', 'Billing data delete successfully');
                    
                    if($group_type == 'HA'){
                        redirect("invoice/billingcodelist");
                    }else{
                        redirect('laboratory/billing');
                    }
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', 'Record not found, Please try again.');
            }
        }else{
            $this->session->set_flashdata('error', 'Record ID not valid.');
        }
        if($group_type == 'HA'){
            redirect("invoice/billingcodelist", "refresh");exit;
        }else{
            redirect("laboratory/billing", "refresh");exit;
        }
        
    }

    public function get_billing_data(){
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $userId = $this->session->userdata('user_id');
        if($group_type == 'HA'){
            $userId = $this->ion_auth->get_users_main_groups()->row()->id;
        }
        //$groupId = $this->ion_auth->get_users_main_groups()->row()->id;
        //$groupId = $this->ion_auth->get_users_groups()->row();

        $data = array();
        $res = $this->billing_model->billingData($userId);
        if($group_type == 'HA'){
            $res = $this->billing_model->getClinicBillingData($userId);
        }
        $cnt = 0;

        foreach ($res as $row){
            $cnt++;
            $data['data'][] = array(
                'count'         => $cnt,
                'clinic'        => $row["clinic"],
                'code'          => $row["bill_code"],
                'description'   => $row["bill_description"],
                'specimen_type' => $row["specimen_type"],
                'category'      => ucwords($row["category"]),
                'tissue_type'   => !empty($row["tissue_name"]) ? $row["tissue_name"] : '-',
                'price'         => $row["price"],
                'id'            => $row["id"],
            );
            //array_push($data['data'], $billData);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_all_request($hos_group_id){
        $result = $this->billing_model->get_request_data($hos_group_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    public function pathologist(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/pathologist');
        $this->load->view('templates/footer-new');
    }

    public function add_pathologist(){

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $lab_id = $this->ion_auth->get_users_main_groups()->row()->id;
        $data["pathologistArr"] = $this->Institute_model->get_doctors($lab_id);

        if($this->input->post()){
            $this->form_validation->set_rules('pathologist_id', 'Pathologist', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() === TRUE) {
                $post = $this->input->post(NULL, true);
                $this->db->insert('pathologist_data', [
                    'lab_id'        => $lab_id,
                    'pathologist_id'=> $post['pathologist_id'],
                    'type'          => $post['type'],
                    'price'         => $post['price'],
                    'description'   => $post['description'],
                    'created_by'    => $this->user_id,
                    'updated_by'    => $this->user_id
                ]);
                if($this->db->insert_id()){
                    $this->session->set_flashdata('success', 'Pathologist data add successfully');
                    redirect("laboratory/pathologist");
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/pathologist_add', $data);
        $this->load->view('templates/footer-new');
    }

    public function edit_pathologist($id){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $lab_id = $this->ion_auth->get_users_main_groups()->row()->id;
        $data["pathologistArr"] = $this->Institute_model->get_doctors($lab_id);
        $data['resultArr'] = $this->billing_model->get_pathologist_detail($id);
        $data['id'] = $id;

        if($this->input->post()){
            $this->form_validation->set_rules('pathologist_id', 'Pathologist', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() === TRUE) {
                $post = $this->input->post(NULL, true);
                $dataArr = [
                    'pathologist_id'=> $post['pathologist_id'],
                    'type'          => $post['type'],
                    'price'         => $post['price'],
                    'description'   => $post['description'],
                    'updated_by'    => $this->user_id
                ];
                $res = $this->db->update('pathologist_data', $dataArr, ['id' => $id]);
                if($res){
                    $this->session->set_flashdata('success', 'Pathologist data update successfully');
                    redirect("laboratory/pathologist");
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/pathologist_edit', $data);
        $this->load->view('templates/footer-new');
    }

    public function delete_pathologist($id){
        if(!empty($id) && $id > 0){
            $count = $this->db->get_where('pathologist_data', ['id' => $id])->num_rows();
            if($count > 0){
                $res = $this->db->where('id', $id)->delete('pathologist_data');
                if($res){
                    $this->session->set_flashdata('success', 'Pathologist data delete successfully');
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                }
            }else{
                $this->session->set_flashdata('error', 'Record not found, Please try again.');
            }
        }else{
            $this->session->set_flashdata('error', 'Record ID not valid.');
        }
        redirect('laboratory/pathologist');
    }

    public function get_pathologist_data(){

        $userId = $this->session->userdata('user_id');
        $lab_id = $this->ion_auth->get_users_main_groups()->row()->id;
        $res = $this->billing_model->pathologistData($userId, $lab_id);
        $cnt = 0;
        foreach ($res as $row){
            $cnt++;
            $data['data'][] = array(
                'count'         => $cnt,
                'pathologist'   => $row["pathologist"],
                'type'          => ucwords(str_replace('_', ' ', $row["type"])),
                'price'         => number_format($row["price"], 2),
                'description'   => $row["description"],
                'id'            => $row["id"]
            );
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function add_billing_by_request(){

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if($this->input->post()){
            $this->form_validation->set_rules('clinic_id', 'Clinic', 'required');
            $this->form_validation->set_rules('request_id', 'Request ID', 'required');
            $this->form_validation->set_rules('bill_code', 'Bill Code', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('bill_description', 'Bill Description', 'required');

            if ($this->form_validation->run() === TRUE) {

                $group_id = $this->ion_auth->get_users_main_groups()->row()->id;
                $post = $this->input->post(NULL, true);
                if($post['bill_type'] != 'not_billed'){
                    $this->db->insert('billing_data', [
                        'group_id'          => $group_id,
                        'clinic_id'         => $post['clinic_id'],
                        'request_id'        => $post['request_id'],
                        'category'          => 'all',
                        'type'              => $post['bill_type'],
                        'specimen_type_id'  => '1',
                        'bill_code'         => $post['bill_code'],
                        'bill_description'  => $post['bill_description'],
                        'price'             => $post['price'],
                        'created_by'        => $this->user_id,
                        'updated_by'        => $this->user_id
                    ]);
                    if($this->db->insert_id()){
                        $this->db->insert('request_billing_code', [
                            'request_id'        => $post['request_id'],
                            'specimen_id'       => $post['specimen_id'],
                            'billing_type'      => $post['bill_type'],
                            'bill_code'         => $this->db->insert_id(),
                            'bill_code_text'    => $post['bill_code'],
                            'bill_description'  => $post['bill_description'],
                            'bill_price'        => $post['price'],
                            'created_by'        => $this->user_id,
                            'updated_by'        => $this->user_id
                        ]);
                        $this->session->set_flashdata('success', 'Billing data add successfully');
                    }else{
                        $this->session->set_flashdata('error', 'Something went wrong, Please Try Again.');
                    }
                }else{
                    $this->session->set_flashdata('error', 'Not Billed (PCI) option for hide data');
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
            redirect('doctor/doctor_record_detail_old/' . $post['request_id']);
        }
    }

    public function delete_billing_by_request($id, $request_id){
        $message = 'Something went wrong, Please Try Again.';
        if(!empty($id)){
            $bill_id = $this->db->get_where('request_billing_code', ['id'=>$id])->row()->bill_code;
            if(isset($bill_id)){
                $res1 = $this->db->delete('request_billing_code', ['id' => $id]);
                //$res2 = $this->db->delete('billing_data', ['id' => $bill_id]);
                //if($res1 && $res2){
                if($res1){
                    $this->session->set_flashdata('success', TRUE);
                    $message = 'Billing data delete successfully';
                }else{
                    $this->session->set_flashdata('error', TRUE);
                }
            }else{
                $this->session->set_flashdata('error', TRUE);
            }
        }else{
            $this->session->set_flashdata('error', TRUE);
        }

        $this->session->set_flashdata('message', $message);

        redirect('/doctor/doctor_record_detail_old/' . $request_id);
    }

    public function request_form(){
        $resArr = $this->getHL7files();

        if(count($resArr) == 0){
            $this->session->set_flashdata('upload_error', 'HL7 files are not available.');
            return redirect('laboratory', 'refresh');
        }

        $count = 0;
        foreach ($resArr as $k=>$res){ //if($k=='Histo_Sample01.hl7'){ continue; }
            $filePath = "uploads/hl7_input/$k";
            $destinationFilePath = "uploads/hl7_imported/$k";

            if(isset($res['Patient Identification'])){
                $patientID = $this->addPatientData($res['Patient Identification']);
                if($patientID){
                    $doctorID = $this->addPathologistData($res['Patient Visit']);
                    $requestID = $this->addRequestData($res['Observation Request'], $patientID, $doctorID);
                    if($requestID){
                        $count++;
                        // file move
                        if(copy($filePath, $destinationFilePath)){
                            unlink($filePath);
                            //echo "File has been moved!";
                        }else{
                            //echo "File can't be moved!";
                        }
                    }
                }
            }
        }
        if($count > 0){
            $record_del_status = '<p class="bg-success" style="padding:7px;">Total '. $count .' record has been successfully inserted.</p>';
            $this->session->set_flashdata('record_status', $record_del_status);
            return redirect('lab/lab_record_list', 'refresh');
        }
    }

    private function getHL7files(){
        $resArr = [];
        $path = './uploads/hl7_input/';
        //$files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));
        foreach($files as $file){
            $fp = fopen($path.$file, "r");
            $content = fread($fp, filesize($path.$file));
            //$lines = explode("\n", $content);
            fclose($fp);
            $contentText = nl2br($content);
            $resArr["$file"] = $this->convertStringData($contentText);

//            echo "<hr>$file<hr>$content<hr>";
//            pre("$contentText<hr>", false);
//            pre($resArr["$file"], false);
//            pre("<hr><hr><hr>", false);
        }
        return $resArr;
    }
    private function convertStringData($contentText){
        $res = [];
        $sectionList = ['MSH', 'PID', 'PV1', 'ORC', 'OBR', 'OBX'];
        $contentArr = explode('<br />', $contentText);
        foreach ($contentArr as $str){
            $row = explode('|', $str);
            if(in_array(trim($row[0]), $sectionList)){
                if(trim($row[0]) == 'MSH'){
                    $res['Message Header'] = $this->getMSH($row);
                } elseif(trim($row[0]) == 'PID'){
                    $res['Patient Identification'] = $this->getPID($row);
                } elseif(trim($row[0]) == 'PV1'){
                    $res['Patient Visit'] = $this->getPV1($row);
                }elseif (trim($row[0]) == 'OBR'){
                    $res['Observation Request'] = $this->getOBR($row);
                }elseif (trim($row[0]) == 'OBX'){
                    $res['Observation Result'] = $this->getOBX($row);
                }elseif (trim($row[0]) == 'ORC'){
                    $res['Common Order'] = $this->getORC($row);
                }
            }
        }
        return $res;
    }

    /* Get main data */
    private function getMSH($row){
        return [
            'Field Separator'                   => trim($row[0]),
            'Encoding Characters'               => trim($row[1]),
            'Sending Application'               => trim($row[2]),
            'Sending Facility'                  => trim($row[3]),
            'Receiving Application'             => trim($row[4]),
            'Receiving Facility'                => trim($row[5]),
            'Date/Time Of Message'              => trim($row[6]),
            'Security'                          => trim($row[7]),
            'Message Type'                      => $this->messageTypeArr(trim($row[8])),
            'Message Control ID'                => trim($row[9]),
            'Processing ID'                     => trim($row[10]),
            'Version ID'                        => trim($row[11]),
            'Sequence Number'                   => trim($row[12]),
            'Continuation Pointer'              => trim($row[13]),
            'Accept Acknowledgment Type'        => trim($row[14]),
            'Application Acknowledgment Type'   => trim($row[15]),
            'Country Code'                      => trim($row[16]),
            'Character Set'                     => trim($row[17]),
            'Principal Language of Message'     => trim($row[18])
        ];
    }
    private function getPID($row){
        return [
            'Set ID PID'                        => trim($row[1]),
            'Patient ID'                        => trim($row[2]),
            'Patient Identifier List'           => $this->managePatientArr(trim($row[3])),
            'Alternate Patient ID PID'          => $this->managePatientArr(trim($row[4])),
            'Patient Name'                      => $this->patientDetailsArr(trim($row[5])),
            'Mother Maiden Name'                => trim($row[6]),
            'DateTime of Birth'                 => trim($row[7]),
            'Administrative Sex'                => trim($row[8]),
            'Patient Alias'                     => trim($row[9]),
            'Race'                              => trim($row[10]),
            'Patient Address'                   => $this->patientAddressArr(trim($row[11])),
            'County Code'                       => trim($row[12]),
            'Phone Number Home'                 => trim($row[13]),
            'Phone Number Business'             => trim($row[14]),
            'Primary Language'                  => trim($row[15]),
            'Marital Status'                    => trim($row[16]),
            'Religion'                          => trim($row[17]),
            'Patient Account Number'            => trim($row[18]),
            'SSN Number Patient'                => trim($row[19]),
            'Driver License Number Patient'     => trim($row[20]),
            'Mother Identifier'                 => trim($row[21]),
            'Ethnic Group'                      => trim($row[22]),
            'Birth Place'                       => trim($row[23]),
            'Multiple Birth Indicator'          => trim($row[24]),
            'Birth Order'                       => trim($row[25]),
            'Citizenship'                       => trim($row[26]),
            'Veterans Military Status'          => trim($row[27]),
            'Nationality'                       => trim($row[28]),
            'Patient Death Date and Time'       => trim($row[29]),
            'Patient Death Indicator'           => trim($row[30])
        ];
    }
    private function getPV1($row){
        return [
            'Set ID PV1'                        => trim($row[1]),
            'Patient Class'                     => trim($row[2]),
            'Assigned Patient Location'         => trim($row[3]),
            'Admission Type'                    => trim($row[4]),
            'Preadmit Number'                   => trim($row[5]),
            'Prior Patient Location'            => trim($row[6]),
            'Attending Doctor'                  => $this->attendRefferDoctorArr(trim($row[7])),
            'Referring Doctor'                  => $this->attendRefferDoctorArr(trim($row[8])),
            'Consulting Doctor'                 => $this->consultingDoctorArr(trim($row[9])),
            'Hospital Service'                  => trim($row[10]),
            'Temporary Location'                => trim($row[11]),
            'Preadmit Test Indicator'           => trim($row[12]),
            'Re-admission Indicator'            => trim($row[13]),
            'Admit Source'                      => trim($row[14]),
            'Ambulatory Status'                 => trim($row[15]),
            'VIP Indicator'                     => trim($row[16]),
            'Admitting Doctor'                  => trim($row[17]),
            'Patient Type'                      => trim($row[18]),
            'Visit Number'                      => trim($row[19]),
            'Financial Class'                   => trim($row[20]),
            'Charge Price Indicator'            => trim($row[21]),
            'Courtesy Code'                     => trim($row[22])
        ];
    }
    private function getOBR($row){
        return [
            'Set ID OBR'                        => trim($row[1]),
            'Placer Order Number'               => trim($row[2]),
            'Filler Order Number'               => $this->fillerOrderArr(trim($row[3])),
            'Universal Service Identifier'      => $this->generalServiceArr(trim($row[4])),
            'Requested DateTime'                => trim($row[5]),
            'Observation DateTime'              => trim($row[6]),
            'Observation End DateTime'          => trim($row[7]),
            'Collection Volume'                 => trim($row[8]),
            'Collector Identifier'              => trim($row[9]),
            'Specimen Action Code'              => trim($row[10]),
            'Danger Code'                       => trim($row[11]),
            'Relevant Clinical Information'     => trim($row[12]),
            'Specimen Received DateTime'        => trim($row[13]),
            'Specimen Source'                   => trim($row[14]),
            'Ordering Provider'                 => $this->generalServiceArr(trim($row[15])),
            'Order Callback Phone Number'       => trim($row[16]),
            'Placer Field 1'                    => trim($row[17]),
            'Placer Field 2'                    => trim($row[18]),
            'Filler Field 1'                    => trim($row[19]),
            'Filler Field 2'                    => trim($row[20]),
            'Results Rpt/Status Chng - DateTime'=> trim($row[21]),
            'Charge to Practice'                => trim($row[22]),
            'Diagnostic Serv Sect ID'           => trim($row[23]),
            'Result Status'                     => trim($row[24]),
            'Parent Result'                     => trim($row[25]),
            'Quantity Timing'                   => trim($row[26]),
            'Result Copies To'                  => trim($row[27]),
            'Parent'                            => trim($row[28]),
            'Transportation Mode'               => trim($row[29]),
            'Reason for Study'                  => trim($row[30]),
            'Principal Result Interpreter'      => trim($row[31]),
            'Assistant Result Interpreter'      => trim($row[32]),
            'Technician'                        => trim($row[33]),
            'Transcriptionist'                  => trim($row[34]),
            'Scheduled DateTime'                => trim($row[35]),
            'Number of Sample Containers'       => trim($row[36]),
            'Transport Logistics of Collected Sample' => trim($row[37])
        ];
    }
    private function getOBX($row){
        return [
            'Set ID'                            => trim($row[1]),
            'Value Type'                        => trim($row[2]),
            'Observation Identifier'            => $this->generalServiceArr(trim($row[3])),
            'Observation Sub-ID'                => trim($row[4]),
            'Observation Value'                 => trim($row[5]),
            'Units'                             => trim($row[6]),
            'References Range'                  => trim($row[7]),
            'Abnormal Flags'                    => trim($row[8]),
            'Probability'                       => trim($row[9]),
            'Nature of Abnormal Test'           => trim($row[10]),
            'Observation Result Status'         => trim($row[11]),
            'Effective Date of Reference Range' => trim($row[12]),
            'User Defined Access Checks'        => trim($row[13]),
            'DateTime of the Observation'       => trim($row[14]),
            'Producer ID'                       => $this->generalServiceArr(trim($row[15])),
            'Responsible Observer'              => trim($row[16]),
            'Observation Method'                => trim($row[17]),
            'Equipment Instance Identifier'     => trim($row[18]),
            'DateTime of the Analysis'          => trim($row[19])
        ];
    }
    private function getORC($row){
        return [
            'Order Control'                     => trim($row[1]),
            'Placer Order Number'               => trim($row[2]),
            'Filler Order Number'               => trim($row[3]),
            'Placer Group Number'               => trim($row[4]),
            'Order Status'                      => trim($row[5]),
            'Response Flag'                     => trim($row[6]),
            'Quantity Timing'                   => trim($row[7]),
            'Parent'                            => trim($row[8]),
            'DateTime of Transaction'           => trim($row[9]),
            'Entered By'                        => trim($row[10]),
            'Verified By'                       => $this->attendRefferDoctorArr(trim($row[11])),
            'Ordering Provider'                 => trim($row[12]),
            'Enterer Location'                  => trim($row[13]),
            'Call Back Phone Number'            => trim($row[14]),
            'Order Effective Date/Time'         => trim($row[15]),
            'Order Control Code Reason'         => trim($row[16]),
            'Entering Organization'             => trim($row[17]),
            'Entering Device'                   => trim($row[18]),
            'Action By'                         => trim($row[19]),
            'Advanced Beneficiary Notice Code'  => trim($row[20]),
            'Ordering Facility Name'            => trim($row[21]),
            'Ordering Facility Address'         => trim($row[22]),
            'Ordering Facility Phone Number'    => trim($row[23]),
            'Ordering Provider Address'         => trim($row[24])
        ];
    }

    /* Get sub array data */
    private function messageTypeArr($str){
        $mTypeArr = explode('^', $str);
        return [
            'Message Type'          => trim($mTypeArr[0]),
            'Trigger Event'         => trim($mTypeArr[1]),
            'Message Structure'     => trim($mTypeArr[2])
        ];
    }
    private function managePatientArr($str){
        $res = [];
        $patientIdentifierList = explode('~', $str);
        foreach ($patientIdentifierList as $patientIdentifierRow){
            $patientIdentifier = explode('^', $patientIdentifierRow);
            $res[] = [
                'ID'                    => trim($patientIdentifier[0]),
                'Check Digit'           => trim($patientIdentifier[1]),
                'Check Digit Scheme'    => trim($patientIdentifier[2]),
                'Assigning Authority'   => trim($patientIdentifier[3]),
                'Identifier Type Code'  => trim($patientIdentifier[4]),
                'Assigning Facility'    => trim($patientIdentifier[5])
            ];
        }
        return $res;
    }
    private function patientDetailsArr($str){
        $patientArr = explode('^', $str);
        return [
            'Last Name'             => trim($patientArr[0]),
            'First Name'            => trim($patientArr[1]),
            'Further Given Names'   => trim($patientArr[2]),
            'Suffix'                => trim($patientArr[3]),
            'Prefix'                => trim($patientArr[4]),
            'Degree'                => trim($patientArr[5]),
            'Name Type Code'        => trim($patientArr[6]),
            'Name Representation Code' => trim($patientArr[7])
        ];
    }
    private function patientAddressArr($str){
        $pAddressArr = explode('^', $str);
        return [
            'Street Address'        => trim($pAddressArr[0]),
            'Other Designation'     => trim($pAddressArr[1]),
            'City'                  => trim($pAddressArr[2]),
            'State or Province'     => trim($pAddressArr[3]),
            'Zip or Postal Code'    => trim($pAddressArr[4]),
            'Country'               => trim($pAddressArr[5]),
            'Address Type'          => trim($pAddressArr[6])
        ];
    }
    private function attendRefferDoctorArr($str){
        $doctorArr = explode('^', $str);
        return [
            'Number'                => trim($doctorArr[0]),
            'Last Name'             => trim($doctorArr[1]),
            'First Name'            => trim($doctorArr[2]),
            'Further Given Names'   => trim($doctorArr[3]),
            'Suffix'                => trim($doctorArr[4]),
            'Prefix'                => trim($doctorArr[5]),
            'Degree'                => trim($doctorArr[6]),
            'Source Table'          => trim($doctorArr[7]),
            'Assigning Authority'   => trim($doctorArr[8]),
            'Name Type Code'        => trim($doctorArr[9]),
            'Identifier Check Digit'=> trim($doctorArr[10]),
            'Check Digit Scheme'    => trim($doctorArr[11]),
            'Identifier Type Code'  => trim($doctorArr[12]),
            'Assigning Facility'    => trim($doctorArr[13]),
            'Name Representation Code' => trim($doctorArr[14]),
            'Name Context'          => trim($doctorArr[15]),
            'Name Validity Range'   => trim($doctorArr[16]),
            'Name Assembly Order'   => trim($doctorArr[17]),
            'Effective Date'        => trim($doctorArr[18]),
            'Expiration Date'       => trim($doctorArr[19])
        ];
    }
    private function consultingDoctorArr($str){
        $doctorArr = explode('^', $str);
        return [
            'Last Name'             => trim($doctorArr[0]),
            'First Name'            => trim($doctorArr[1]),
            'Further Given Names'   => trim($doctorArr[2]),
            'Suffix'                => trim($doctorArr[3]),
            'Prefix'                => trim($doctorArr[4]),
            'Degree'                => trim($doctorArr[5]),
            'Source Table'          => trim($doctorArr[6]),
            'Assigning Authority'   => trim($doctorArr[7]),
            'Name Type Code'        => trim($doctorArr[8]),
            'Identifier Check Digit'=> trim($doctorArr[9]),
            'Check Digit Scheme'    => trim($doctorArr[10]),
            'Identifier Type Code'  => trim($doctorArr[11]),
            'Assigning Facility'    => trim($doctorArr[12]),
            'Name Representation Code'  => trim($doctorArr[13])
        ];
    }
    private function fillerOrderArr($str){
        $orderArr = explode('^', $str);
        return [
            'Entity Identifier'     => trim($orderArr[0]),
            'Namespace ID'          => trim($orderArr[1]),
            'Universal ID'          => trim($orderArr[2]),
            'Universal ID Type'     => trim($orderArr[3])
        ];
    }
    private function generalServiceArr($str){
        //$str1 = strlen('&&', '^', $str);
        $resArr = explode('^', $str);
        return [
            'Identifier'            => trim($resArr[0]),
            'Text'                  => trim($resArr[1]),
            'Name of Coding System' => trim($resArr[2])
        ];
    }

    /* Insert data */
    private function addPatientData($pArr){
        if(!empty($pArr['Patient Name']['First Name'])){
            $patientArr = [
                'msg_patient_ID'=> setValue($pArr['Patient ID']),
                'first_name'    => $pArr['Patient Name']['First Name'],
                'last_name'     => $pArr['Patient Name']['Last Name'],
                'dob'           => dateCovertString($pArr['DateTime of Birth']),
                'gender'        => ($pArr['Administrative Sex'] == 'M') ? 'Male' : 'Female',
                'phone'         => setValue($pArr['Phone Number Home']),
                'address_1'     => setValue($pArr['Patient Address']['Street Address']),
                'city'          => setValue($pArr['Patient Address']['City']),
                'state'         => setValue($pArr['Patient Address']['State or Province']),
                'country'       => setValue($pArr['Patient Address']['Country']),
                'post_code'     => setValue($pArr['Patient Address']['Zip or Postal Code']),
                'p_id_1'        => setValue($pArr['Patient Identifier List'][0]['ID']),
                'p_id_2'        => setValue($pArr['Patient Identifier List'][1]['ID']),
            ];
            $rowQuery = $this->db->get_where('patients', $patientArr);
            if($rowQuery->num_rows() == 0){
                $this->db->insert('patients', $patientArr);
                $patientID = $this->db->insert_id();
                //echo "<strong style='color: green;'>Successfully inserted patient with ID: $patientID</strong><br>";
            }else{
                $patientID = $rowQuery->row()->id;
                //echo "<strong style='color: red;'>Already inserted patient ID: $patientID</strong><br>";
            }
            return $patientID;
        }
        return false;
    }
    private function addRequestData($reqArr, $pid, $doctor_id){

        $template_id = 14;
        $hospital_group_id = 128;

        //$lab_id=128; // for AUS server
        $lab_id=118; // for local server

        $this->load->model('DepartmentModel', 'department');

        $row = $tem_query = $this->db->query("SELECT * FROM uralensis_record_track_template where ura_rec_temp_id='$template_id'")->result();
        $specialty_id       = $row->speciality;
        $courier_no         = $row->courier_no;
        $temp_hospital_id   = (!empty($row->hospital_id)) ? $row->hospital_id : $hospital_group_id;
        $num_Spno           = $row->speciman_no;
        $dermatological_surgeon = $row->temp_clinic_user;
        $doctor_id          = (!empty($doctor_id)) ? $doctor_id : $row->temp_pathologist;

        /*
        $doctor_id          = $row->temp_pathologist;
        $hospital_userid    = $row->temp_hospital_user;
        $clinic_id          = $row->temp_clinic_user;
        $pathologist_id     = $row->temp_pathologist;
        $lab_name           = $row->temp_lab_name;
        $spec_name          = $row->specimen_no;
        $batch_no           = $row->batch_no;
        $lab_no             = $row->lab_no;
        */

        $this->db->update('patients', ['hospital_id' => $temp_hospital_id], ['id' => $pid]);

        $user_id = $this->ion_auth->user()->row()->id;
        $ass_status= (!empty($doctor_id)) ? 1 : 0;

        if ($this->group_type === 'H' || $this->group_type === 'HA'){
            $hospital_id = $this->group_id;
            //$lab_id=$lab_id;
        }
        if(in_array($this->group_type,LAB_GROUP)){
            $hospital_id = $temp_hospital_id;
        }
        $get_serial_number = $this->db->query("SELECT * FROM request ORDER BY uralensis_request_id DESC LIMIT 1")->row_array();
        if ($get_serial_number == ''){
            $req_id_before_insert = 1;
        }else{
            $req_id_before_insert = $get_serial_number['uralensis_request_id'];
        }
        $serial_query = $this->db->query("SELECT serial_number FROM request WHERE uralensis_request_id = $req_id_before_insert");
        if ($serial_query->num_rows() > 0) {
            $row = $serial_query->row();
            //$last_inserted_serial_number = $row->serial_number;
            $last_inserted_serial_number = $row->uralensis_request_id;
            $keyParts = explode('.', $last_inserted_serial_number);

            if ($keyParts[1] == date('y')){
                //$key = $keyParts[0] . "." . $keyParts[1] . ".00" . ($keyParts[2] + 1);
                $key = $keyParts[1] . $keyParts[0] . "00" . ($keyParts[2] + 1);
            } else {
                //$key = $keyParts[0] . "." . date("y") . "001";
                $key = date("y").'FN'.$last_inserted_serial_number;
            }
        } else if ($serial_query->num_rows() < 0) {
            //$key = 'PB.' . date('y') . '.00' . '1';
            $key = date('y').'FN'.'00'.'1';
        } else {
            //$key = 'PB.' . date('y') . '.00' . '1';
            $key = date('y').'FN'.'00'.'1';
        }

        $patient = $this->db->get_where('patients', ['id' => $pid])->row_array();
        $initial = '';
        if (!empty($patient['first_name']) && strlen($patient['first_name']) > 0) {
            $initial .= $patient['first_name'][0];
        }
        if (!empty($patient['last_name']) && strlen($patient['last_name']) > 0) {
            $initial .= $patient['last_name'][0];
        }

        $get_lab_name = $this->db->select('name, description')->where('id', $lab_id)->get('groups')->row_array();
        if (!empty($get_lab_name)) {
            $lab_name = $get_lab_name['description'];
        } else {
            $lab_name ='Poundbury Cancer Institute';
        }
        $lab_no=uniqid(rand(0,10));

        $record_edit_status = array(
            'patient_initial'       => $initial,
            'f_name'                => $patient['first_name'],
            'sur_name'              => $patient['last_name'],
            'emis_number'           => $courier_no,
            'lab_number'            => $lab_no,
            'dob'                   => $patient['dob'],
            'date_received_bylab'   => 'no',
            'date_sent_touralensis' => 'no',
            'rec_by_doc_date'       => 'no',
            'clrk'                  => 'no',
            'ura_barcode_no'        => $lab_no,
            'pci_number'            => 'PCI-22-001',
            'nhs_number'            => $patient['nhs_number'],
            'lab_name'              => $lab_name,
            'gender'                => $patient['gender'],
            'date_taken'            => 'no',
            'report_urgency'        => 'no',
            'cases_category'        => 'no'
        );
        $lab_specs = $this->department->get_laboratory_pathology($lab_id);
        $r_type = 'unknown';
        if (!empty($lab_specs)) {
            foreach ($lab_specs as $s_id => $spec) {
                if ($s_id == $specialty_id) {
                    $r_type = strtolower($spec['name']);
                }
            }
        }

//        $lab_no = "PB22-".rand(10000,99999);
//        $bat_no = rand(10000,99999);
//        $pic_no = 'PB22'.rand(1000,99999);

        $bat_no = 'BN'.$key;
        $pic_no = 'PC'.$key;
        $ura_barcode_no = $key;
        $lab_no = $key;
        $lab_name = '';

        $request = array(
            'serial_number'                 => $key,
            'hospital_group_id'             => $temp_hospital_id,
            'lab_name'                      => $lab_name,
            'lab_number'                    => $lab_no,
            'request_code_status'           => 'new',
            'record_edit_status'            => serialize($record_edit_status),
            'request_add_user'              => $user_id,
            'request_datetime'              => dateCovertString($reqArr['Observation DateTime']),
            'ura_barcode_no'                => $ura_barcode_no,
            'request_add_user_timestamp'    => time(),
            'speciality_group_id'           => $specialty_id,
            'record_batch_id'               => $bat_no,
            'patient_initial'               => $initial,
            'pci_number'                    => $pic_no,
            'patient_id'                    => $pid,
            'nhs_number'                    => $patient['nhs_number'],
            'report_urgency'                => 'Routine',
            'request_type'                  => $r_type,
            'location'                      => $patient['address_1'],
            'lab_id'                        => $lab_id,
            'template_id'                   => $template_id,
            'dermatological_surgeon'        => $dermatological_surgeon,
            'speciman_no'                   => '1',
            'f_name'                        => $patient['first_name'],
            'sur_name'                      => $patient['last_name'],
            'dob'                           => $patient['dob'],
            'age'                           => ageCalculate($patient['dob']),
            'emis_number'                   => $reqArr['Filler Order Number']['Entity Identifier'],
            'gender'                        => $patient['gender'],
            'status'                        => 1,
            'specimen_update_status'        => 1,
            'specimen_publish_status'       => 0,
            'further_work_status'           => 0,
            'supplementary_report_status'   => 0,
            'report_status'                 => 0,
            'publish_status'                => 0
        );
        $this->Institute_model->institute_insert($request);
        $record_last_id = $this->db->insert_id();

        $specimen = array(
            'request_id'        => $record_last_id,
            'specimen_block'    => '1',
            'specimen_slides'   => '1',
            'numberOfSlides'    => '1',
            'numberOfBlocks'    => '1',
            'blockDetail'       => 'A1',
            'slides'            => '0',
            'speciality_id'     => '1'
        );

        if($num_Spno > 0){
            for($i=0; $i<$num_Spno; $i++){
                $this->db->insert('specimen', $specimen);
            }
        } else {
            $this->db->insert('specimen', $specimen);
        }
        $specimen_id = $this->db->insert_id();

        $this->db->insert('specimen_blocks', [
            'specimen_id'   => $specimen_id,
            'specimen_no'   => 1,
            'block_no'      => 1,
            'description'   => 'HE'
        ]);

        $this->db->insert('request_specimen', [
            'rs_request_id'  => $record_last_id,
            'rs_specimen_id' => $specimen_id
        ]);
        $record_session_val = $this->session->userdata('record_ids', $record_last_id);
        $record_session_val[] = $record_last_id;
        $this->session->set_userdata('record_ids', $record_session_val);
        $session_record_data = $this->session->userdata('record_ids');

        $this->db->insert("users_request", [
            'request_id'    => $record_last_id,
            'users_id'      => $user_id,
            'doctor_id'     => $doctor_id,
            'group_id'      => $hospital_id
        ]);

        $this->db->insert("request_assignee", [
            'request_id'    => $record_last_id,
            'user_id'       => $doctor_id,
            'assign_status' => $ass_status
        ]);

        $assign_request_args = array(
            'assign_status'         => intval(0),
            'report_status'         => intval(1),
            'request_code_status'   => '',
            'request_assign_status' => $ass_status
        );
        $this->db->update("request", $assign_request_args, ['uralensis_request_id' => $record_last_id]);

        $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_last_id)->get('request_assignee')->row_array();
        if (empty($check_assign_stat)){
            $pathologist_status = 'Not Assigned';
        } else {
            $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
            $pathologist_status = $pathologist_name;
        }

        $this->db->insert('uralensis_record_track_status', [
            'ura_rec_track_no'          => '',
            'ura_rec_track_location'    => $lab_name,
            'ura_rec_track_record_id'   => intval($record_last_id),
            'ura_rec_track_status'      => '',
            'ura_rec_track_pathologist' => $pathologist_status,
            'timestamp'                 => time()
        ]);

        return $record_last_id;
    }
    private function addPathologistData($arr){

        $attDr = $arr['Attending Doctor'];
        $refDr = $arr['Referring Doctor'];
        $conDr = $arr['Consulting Doctor'];
        $hospital_or_clinic_id = 128;

        $last_user_id = $this->db->select_max("id")->get("users")->result_array();
        if (empty($last_user_id)) {
            $last_user_id = '';
        } else {
            $last_user_id = intval($last_user_id[0]["id"]) + 1;
        }

        $username = strtolower($refDr['First Name']) . '_' . strtolower($refDr['Last Name']) . $last_user_id;
        $email = "$username@yopmail.com";
        $identity = $refDr['Number'];
        $password = 'Test@123456';
        $user_role = '20';
        $group_id = $user_role;//$this->Admin_model->get_group_id(trim($user_role));
        $is_hospital_admin = 0;
        $profile_picture = DEFAULT_PROFILE_PIC;

        $additional_data = [
            'username'              => $this->db->escape($username),
            'first_name'            => $this->db->escape($refDr['First Name']),
            'last_name'             => $this->db->escape($refDr['First Name']),
            'company'               => $this->db->escape($refDr['Assigning Authority']),
            'phone'                 => $this->db->escape(NULL),
            'memorable'             => $this->db->escape('helloworld'),
            'is_hospital_admin'     => $is_hospital_admin,
            'profile_picture_path'  => $this->db->escape($profile_picture),
            'user_type'             => $this->db->escape('D'),
            'sub_role'              => '',
            'clinic_id'             => $hospital_or_clinic_id,
            'group_id'              => $group_id
        ];

        // Check User Group
        $groups_array = array($group_id);

        $user_ids=$this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array);
        if ($user_ids)
        {
            //$groupRow = $this->ion_auth->get_users_groups()->row();
            //$mainGroupRow = $this->ion_auth->get_users_main_groups()->row();

            $this->db->insert('users_groups', [
                'user_id' => $user_ids,
                'group_id' => $this->db->escape($user_role),
                'institute_id' => $hospital_or_clinic_id
            ]);

            $this->db->insert('hospital_group', [
                'hospital_id' => $hospital_or_clinic_id,
                'group_id' => $user_ids
            ]);

            /*$userRoles = $this->input->post('Hgroup_id');
            foreach ($userRoles as $role=>$roleData){
                $temp_data = array(
                    'user_id' => $user_ids,
                    'group_id' => $mainGroupRow->id,
                    'institute_id' => $roleData
                );
                $this->db->insert('users_groups', $temp_data);

                $hos_data = array(
                    'hospital_id' => $roleData,
                    'group_id' => $user_ids
                );

                $this->db->insert('hospital_group', $hos_data);
            }*/
            //$this->sendVerificationEmail($email);
            //$this->sendAdminVerificationEmail($email, $password);
            //$this->session->set_flashdata('success', $this->ion_auth->messages());
            return $user_ids;
        }
    }
    public function login_attempts(){
        if (!$this->ion_auth->logged_in()) {
        }
        $this->db->truncate('login_attempts');
        redirect('auth/login', 'refresh');
    }

}