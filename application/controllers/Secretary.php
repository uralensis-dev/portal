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

Class Secretary extends CI_Controller 
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Secretary_model');
        $this->load->helper(array('url', 'activity_helper','ec_helper'));
        $this->load->helper("file");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Userextramodel');
        track_user_activity();
    }

    /**
     * Dashboard Function
     * Load Dashbord View
     *
     * @return void
     */
    public function index() 
    {
        $login_records['previous_login'] = $this->Secretary_model->previous_login_records();
        $user_id = $this->ion_auth->user()->row()->id;
        $login_records['decryptedDetails'] = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/dashboard', $login_records);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * This function wil add the records.
     * And Assign the records to corresponding hospitals Account.
     *
     * @return void
     */
    public function show_form() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_record', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/secretary_add_records');
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Add Report
     *
     * @return void
     */
    public function secretary_add_report() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    /**
     * List Auto Populated Cinician
     *
     * @return void
     */
    public function get_clinician_auto_populated() 
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($_GET['hospital_user_id'])) {
            $hospital_user_id = $_GET['hospital_user_id'];
            $hospital_group_id = $this->ion_auth->get_users_groups($hospital_user_id)->row()->id;
            $get_clinicians = $this->db->query("SELECT * FROM uralensis_clinician WHERE uralensis_clinician.hospital_id = $hospital_group_id");
            $clinician_result = $get_clinicians->result();
            echo '<option value="">Please Choose Primary Clinician.</option>';
            foreach ($clinician_result as $clinicians) {
                echo '<option value="' . $clinicians->clinician_name . '">' . $clinicians->clinician_name . '</option>';
            }
        }
        die;
    }

    /**
     * List Auto Populated Dermatological Surgeon
     *
     * @return void
     */
    public function get_dermatological_surgeon_auto_populated() 
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $hospital_user_id = $_GET['hospital_user_id'];
        $hospital_group_id = $this->ion_auth->get_users_groups($hospital_user_id)->row()->id;
        $get_dermatological_surgeon = $this->db->query("SELECT * FROM uralensis_dermatological_surgeon WHERE uralensis_dermatological_surgeon.hospital_id = $hospital_group_id");
        $dermatological_surgeon_result = $get_dermatological_surgeon->result();
        foreach ($dermatological_surgeon_result as $dermatological_surgeon) {
            echo '<option value="' . $dermatological_surgeon->dermatological_surgeon_name . '">' . $dermatological_surgeon->dermatological_surgeon_name . '</option>';
        }
        die;
    }

    /**
     * Find Macthing Records Based On NHS Number
     *
     * @return void
     */
    public function find_matching_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if (!empty($_POST['nhs_number']) && intval($_POST['nhs_number'])) {
            $nhs_number = $this->input->post('nhs_number');
            $match_record['find_match_record'] = $this->Secretary_model->find_matching_records_model($nhs_number);
            echo json_encode($match_record);
            die;
        }
    }

    /**
     * Find Matching Lab Number
     *
     * @return void
     */
    public function find_lab_number_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if (!empty($_POST['lab_number'])) {
            $lab_number = $_POST['lab_number'];
            $lab_prefix = substr($lab_number, 0, 2);
            $find_lab = $this->db->query("SELECT * FROM request WHERE request.lab_number = '$lab_number'");
            $check_lab = $find_lab->result();
            if (($lab_number != 'U' && strlen($lab_number) == 1) &&
                    ($lab_number != 'S' && strlen($lab_number) == 1) &&
                    ($lab_number != 'H' && strlen($lab_number) == 1)
            ) {
                $json['type'] = 'error';
                $json['msg'] = 'The string length must be one letter and letter should be U, S, H and in capital form.';
                echo json_encode($json);
                die;
            } else if (($lab_number != 'U') &&
                    ($lab_number != 'S') &&
                    ($lab_number != 'H') &&
                    (strlen($lab_number) > 1) &&
                    ($lab_prefix != 'PU')) {
                $json['type'] = 'error';
                $json['msg'] = 'The Prefix Should be start from PU-';
                echo json_encode($json);
                die;
            } else if (($lab_number == 'U') ||
                    ($lab_number == 'S') ||
                    ($lab_number == 'H') &&
                    (strlen($lab_number) == 1)) {
                $json['type'] = 'success';
                $json['msg'] = 'The lab number combination is new and you can proceed to add request now.';
                echo json_encode($json);
                die;
            } else {
                $find_lab = $this->db->query("SELECT * FROM request WHERE request.lab_number = '$lab_number'");
                $check_lab = $find_lab->result();
                if (!empty($check_lab) && $lab_number === $check_lab[0]->lab_number) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Lab Number Already Exists.';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'success';
                    $json['msg'] = 'The lab number combination is new and you can proceed to add request now.';
                    echo json_encode($json);
                    die;
                }
            }
        }
    }

    /**
     * Add Record Function
     *
     * @return void
     */
    public function add_record() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (isset($_POST)) {
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
                    $key = $keyParts[0] . "-" . $keyParts[1] . "-" . ($keyParts[2] + 1);
                } else {
                    $key = $keyParts[0] . "-" . date("y") . "-1";
                }
            } elseif ($serial_query->num_rows() < 0) {
                $key = 'UL-' . date('y') . '-1';
            } else {
                $key = 'UL-' . date('y') . '-1';
            }
            $request = array(
                'serial_number' => $key,
                'record_batch_id' => $this->input->post('admin_choose_batch'),
                'emis_number' => $this->input->post('emis_number'),
                'patient_initial' => $this->input->post('patient_initial'),
                'pci_number' => $this->input->post('pci_no'),
                'nhs_number' => str_replace(' ', '', $this->input->post('nhs_number')),
                'lab_number' => $this->input->post('lab_number'),
                'hos_number' => $this->input->post('hos_number'),
                'sur_name' => $this->input->post('sur_name'),
                'f_name' => $this->input->post('first_name'),
                'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                'lab_name' => $this->input->post('lab_name'),
                'date_received_bylab' => date('Y-m-d', strtotime($this->input->post('date_received_bylab'))),
                'data_processed_bylab' => date('Y-m-d', strtotime($this->input->post('data_processed_bylab'))),
                'date_sent_touralensis' => date('Y-m-d', strtotime($this->input->post('date_sent_touralensis'))),
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
                'date_taken' => date('Y-m-d', strtotime($this->input->post('date_taken'))),
                'report_urgency' => $this->input->post('report_urgency'),
                'cl_detail' => $this->input->post('cl_detail'),
                'status' => 0,
                'cases_category' => $this->input->post('cases_category')
            );

            $session_data_hospital = array(
                'hospital_id' => $_POST['hospital_user']
            );
            $this->session->set_userdata($session_data_hospital);
            $this->Secretary_model->institute_insert($request);
            $this->Secretary_model->request_assign();
            $record_id = $this->session->userdata('record_id');
            $hospital_id_request = $this->session->userdata('hospital_id');
            $hospital_group_id_request = $this->ion_auth->get_users_groups($hospital_id_request)->row()->id;
            $hospital_request_data = array('hospital_group_id' => $hospital_group_id_request);
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $hospital_request_data);
            $hospital_id_user_request = $this->session->userdata('hospital_id');
            $hospital_user_request_group_id = $this->ion_auth->get_users_groups($hospital_id_user_request)->row()->id;
            $add_hospital_group_id = array('group_id' => $hospital_user_request_group_id);
            $this->db->where('request_id', $record_id);
            $this->db->update('users_request', $add_hospital_group_id);
            $secretary_id = $this->ion_auth->user()->row()->id;
            $user_add_data = array(
                'request_add_user' => $secretary_id,
                'request_add_user_timestamp' => time()
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $user_add_data);
            $msg = '<p class="bg-info" style="padding: 7px;">Request Submitted, Please Add Specimen Below.</p>';
            $this->session->set_flashdata('record_add_msg', $msg);
            redirect('secretary/show_specimen');
        }
    }

    /**
     * This Function will Produce the Specimen Page.
     * 
     * @return Specimen View
     */
    public function show_specimen() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $hospital_id_user_request = $this->session->userdata('hospital_id');
        $hospital_user_request_group_id = $this->ion_auth->get_users_groups($hospital_id_user_request)->row()->id;
        $get_cost_codes['cost_codes'] = $this->Secretary_model->get_all_cost_codes($hospital_user_request_group_id);
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/secretary_add_specimen', $get_cost_codes);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Add Specimen
     *
     * @return void
     */
    public function add_specimen() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $record_id = $this->session->userdata('record_id');
        $specimen = array(
            'request_id' => $record_id,
            'specimen_site' => $this->input->post('specimen_site'),
            'specimen_procedure' => $this->input->post('specimen_procedure'),
            'specimen_type' => $this->input->post('specimen_type'),
            'specimen_block' => $this->input->post('specimen_block'),
            'specimen_slides' => $this->input->post('specimen_slides'),
            'specimen_block_type' => $this->input->post('specimen_block_type'),
            'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
            'specimen_diagnosis_description' => $this->input->post('specimen_diagnosis'),
            'specimen_cancer_register' => $this->input->post('specimen_cancer_register'),
            'specimen_rcpath_code' => $this->input->post('rcpath_code')
        );
        $this->Secretary_model->insert_specimen($specimen);
        $this->Secretary_model->request_specimen_add();
        $specimen_message = '<p class="bg-info" style="padding:7px;">Specimen Successfully Added. If you want to add more specimen please add it with same way. After adding click on Finish Button.</p>';
        $this->session->set_flashdata('specimen_add_msg', $specimen_message);
        redirect('secretary/show_specimen');
    }

    /**
     * Profile Form Display
     *
     * @return void
     */
    public function profile_form() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');

        }
        $user_id = $this->ion_auth->user()->row()->id;
        $decryptedDetails['decryptedDetails'] = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/profile_form',$decryptedDetails);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Profile Form Processing
     *
     * @return void
     */
    public function update_profile() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('email_address', 'Email Address', 'valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'integer');
        $this->form_validation->set_rules('memorable', 'Memorable', 'min_length[10]|max_length[10]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('secretary/inc/header');
            $this->load->view('secretary/profile_form');
            $this->load->view('secretary/inc/footer');
        } else {
            if ($_FILES['profile_picture']['size'] > 0) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = 'profile_picture_' . substr(md5(rand()), 0, 7);
                $config['overwrite'] = false;
                $config['max_size'] = '1024';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('profile_picture')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_error', $error['error']);
                    $this->load->view('secretary/inc/header');
                    $this->load->view('secretary/profile_form');
                    $this->load->view('secretary/inc/footer');
                } else {
                    $data = $this->upload->data();
                }
            }
            // 'first_name' => $this->input->post('first_name'),
            // 'email' => $this->input->post('email_address'),
            // 'username' => $this->input->post('username'),
            // 'company' => $this->input->post('company'),
            // 'last_name' => $this->input->post('last_name'),
            // 'phone' => $this->input->post('phone'),

            $profile_data = array(
               
                'memorable' => $this->input->post('memorable'),
                'profile_picture_path' => $data['full_path'],
                'picture_name' => $data['file_name']
            );

            $secretary_id = $this->ion_auth->user()->row()->id;
            $this->db->where('id', $secretary_id);
            $this->db->update('users', $profile_data);
            $updatebasic = $this->Userextramodel->UpdateBasicInfoUserDoctor($secretary_id,$this->input->post('email_address'),$this->input->post('username'),$this->input->post('first_name'),$this->input->post('last_name'), $this->input->post('company'),$this->input->post('phone'));
         
            if ($this->db->affected_rows() > 0 || $updatebasic==TRUE) {
                $success = '<div class="alert bg-success">Your Profile Information Was Successfully Updated.</div>';
                $this->session->set_flashdata('success_update', $success);
                redirect('secretary/profile_form');
            } else {
                $general_error = '<div class="alert bg-danger">Something Went Wrong While Updating Profile Information.</div>';
                $this->session->set_flashdata('general_error', $general_error);
                redirect('secretary/update_profile');
            }
        }
    }

    /**
     * Change Password Function
     *
     * @return void
     */
    public function change_password_secretary() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $password_hash = $this->ion_auth->user()->row()->password;
        $json = array();
        if ($_POST['old_pass'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter Your Old Password First.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['new_pass'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter Your New Password.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['new_confirm_pass'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter Your Confirm New Password.</div>';
            echo json_encode($json);
            die;
        }
        if (!password_verify($_POST['old_pass'], $password_hash)) {
            $json['type'] = 'old_pass_error';
            $json['msg'] = '<div class="alert alert-danger">Your Old Password Did Not Match.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['new_pass'] !== $_POST['new_confirm_pass']) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Your Confirm New Password Did Not Match.</div>';
            echo json_encode($json);
            die;
        }

        $pass_options = ['cost' => 11];
        $hash_change_pass = password_hash($_POST['new_confirm_pass'], PASSWORD_BCRYPT, $pass_options);
        $institute_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'password' => $hash_change_pass
        );
        $this->db->where('id', $institute_id);
        $this->db->update('users', $data);

        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Password Successfully Updated.</div>';
        echo json_encode($json);
        $this->ion_auth->logout();
    }

    /**
     * Display Doctors List and Reports
     *
     * @return void
     */
    public function reports() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sect_id = $this->ion_auth->user()->row()->id;
        $doctors['doctors_list'] = $this->Secretary_model->get_all_doctors_list($sect_id);
        $reports = array();
        if (!empty($_GET['doctors_id']) && isset($_GET['doctors_id'])) {
            $doctor_id = $_GET['doctors_id'];
            $reports['doctors_reports'] = $this->Secretary_model->get_all_doctor_reports($doctor_id);
        }
        $secretary = array();
        if (!empty($_GET['doctors_id'])) {
            $doctor_id = $_GET['doctors_id'];
            $secretary['secretary_list'] = $this->Secretary_model->get_all_secretaries($doctor_id);
        }
        $result = array_merge($doctors, $reports, $secretary);
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/reports', $result);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Assign Records To Secretary
     *
     * @return void
     */
    public function assign_record_secretary() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if ($_POST['secretary_id'] === 'false') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Choose The Secretary First.</div>';
            echo json_encode($json);
            die;
        } else {
            $check_data = '';
            $record_id = $this->input->post('record_id');
            $record_sec = $this->db->query("SELECT * FROM uralensis_sec_rec_assign WHERE uralensis_sec_rec_assign.ura_sec_rec_rec_id = $record_id");
            $check_data = $record_sec->num_rows();
            if ($check_data > 0) {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-info">Record Already Assigned To Choosen Secretary.</div>';
                echo json_encode($json);
                die;
            } else {
                $data = array(
                    'ura_sec_rec_sec_id' => $this->input->post('secretary_id'),
                    'ura_sec_rec_doc_id' => $this->input->post('doctor_id'),
                    'ura_sec_rec_rec_id' => $this->input->post('record_id')
                );
                $this->db->insert('uralensis_sec_rec_assign', $data);
                $record_data = array(
                    'record_secretary_id' => $this->input->post('secretary_id'),
                    'record_assign_sec_time' => time(),
                    'record_secretary_status' => 'true'
                );
                $this->db->where('uralensis_request_id', $this->input->post('record_id'));
                $this->db->update('request', $record_data);
                $json['type'] = 'success';
                $json['msg'] = '<div class="alert alert-success">Record Assign Successfully.</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * View Assigned Reports
     *
     * @return void
     */
    public function view_reports() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $view_records['records'] = $this->Secretary_model->get_all_assigned_records();
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/view_reports', $view_records);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * View Reports Details
     *
     * @return void
     */
    public function view_reports_detail() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $view_records['records'] = $this->Secretary_model->get_all_assigned_records();
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/view_reports', $view_records);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Record detail view
     * 
     * @param int $record_id
     */
    public function record_detail($record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_edit_record', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (!empty($record_id)) {
            $get_doc_id['doctor_id'] = $this->Secretary_model->get_doctor_id();
            $doctor_id = $get_doc_id['doctor_id'][0]->ura_sec_rec_doc_id;
            $data['request_query'] = $this->Secretary_model->doctor_record_detail($record_id, $doctor_id);
            $specimen_data['specimen_query'] = $this->Secretary_model->doctor_record_detail_specimen($record_id, $doctor_id);
            $supplemnt_data['supplementary_query'] = $this->Secretary_model->get_supplementary($record_id);
            $nhs_number = $data['request_query'][0]->nhs_number;
            $related_posts['related_query'] = $this->Secretary_model->related_posts_model($record_id, $nhs_number);
            $edu_cats['education_cats'] = $this->Secretary_model->get_education_cases_model();
            $cpc_cats['cpc_cats'] = $this->Secretary_model->get_cpc_cases_model();
            $mdt_cats['mdt_cats'] = $this->Secretary_model->get_mdt_cases_model();
            $session_data = array('id' => $record_id);
            $this->session->set_userdata($session_data);
            $change_status = array('report_status' => 0);
            $req_id = $this->session->userdata('id');
            $this->db->where('uralensis_request_id', $req_id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Secretary_model->fetch_files_data($record_id);
        }
        $data_and_files = array_merge(
                $data, $specimen_data, $files_data, $supplemnt_data, $related_posts, $edu_cats, $cpc_cats, $mdt_cats, $get_doc_id
        );
        require_once('application/views/doctor/comment_section.php');
        require_once('application/views/doctor/manage_supplementary.php');
        require_once('application/views/doctor/manage_documents.php');
        require_once('application/views/doctor/related_posts.php');
        require_once('application/views/secretary/get_specimens.php');
        require_once('application/views/doctor/special_notes.php');
        require_once('application/views/secretary/inc/functions.php');
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/record_detail', $data_and_files);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Upload Files
     *
     * @param int $record_id
     * @return void
     */
    public function do_upload($record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($record_id)) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('upload_error', $error['error']);
                redirect('secretary/record_detail/' . $record_id, 'refresh');
            } else {
                $get_doc_id = $this->Secretary_model->get_doctor_id();
                $doctor_id = $get_doc_id[0]->ura_sec_rec_doc_id;
                $user = $this->ion_auth->user($doctor_id)->row()->username;
                $data = $this->upload->data();
                $this->Secretary_model->insert_file(
                    $data['file_name'],
                    $data['raw_name'],
                    $data['full_path'],
                    $data['file_ext'],
                    $data['is_image'],
                    $user,
                    $doctor_id,
                    $record_id
                );
                $uplaod_success = '<p class="bg-success" style="padding:7px;">File Successfully Uploaded.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_success);
                redirect('secretary/record_detail/' . $record_id, 'refresh');
            }
        }
    }

    /**
     * Delete Record Files
     *
     * @return void
     */
    public function delete_record_files() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $record_id = $_GET['record_id'];
        $file_id = $_GET['file_id'];
        $get_doc_id = $this->Secretary_model->get_doctor_id();
        $doctor_id = $get_doc_id[0]->ura_sec_rec_doc_id;
        if (isset($file_id) && isset($doctor_id) && isset($record_id)) {
            $get_file_path_query = $this->db->query("SELECT * FROM files WHERE files_id = $file_id AND user_id = $doctor_id ORDER BY files_id");
            $get_file_path = $get_file_path_query->result();
            $this->db->query("DELETE FROM files WHERE files_id = $file_id AND user_id = $doctor_id ORDER BY files_id");
            unlink($get_file_path[0]->file_path);
            $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
            $this->session->set_flashdata('delete_file', $delete_file);
            redirect('secretary/record_detail/' . $record_id, 'refresh');
        }
    }

    /**
     * Add Special Notes
     *
     * @return void
     */
    public function add_special_notes() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if ($_POST['special_notes'] == '' && empty($this->input->post('special_notes'))) {
            $json['type'] = 'error';
            $json['message'] = '<div class="alert alert-danger">Please Add Special Notes.</div>';
            echo json_encode($json);
            die;
        } else {
            $notes_data = array(
                'special_notes' => $this->input->post('special_notes'),
                'special_notes_date' => date('M j Y g:i A')
            );
            $this->db->where('uralensis_request_id', $this->input->post('record_id'));
            $this->db->update('request', $notes_data);
            $json['type'] = 'success';
            $json['message'] = '<div class="alert alert-success">Special Notes Suuccessfully Added.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Remove Special Notes
     *
     * @return void
     */
    public function clear_special_notes() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if ($_POST['special_notes'] == '' && empty($this->input->post('special_notes'))) {
            $json['type'] = 'error';
            $json['message'] = '<div class="alert alert-danger">There is Already No Special Notes to be Deleted.</div>';
            echo json_encode($json);
            die;
        } else {
            $notes_data = array(
                'special_notes' => '',
                'special_notes_date' => ''
            );
            $this->db->where('uralensis_request_id', $this->input->post('record_id'));
            $this->db->update('request', $notes_data);
            $json['type'] = 'success';
            $json['message'] = '<div class="alert alert-success">Sepcial Notes Successfully Removed.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add Comment in Comment Section
     *
     * @return void
     */
    public function add_comments_section() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if ($_POST['commnet_section'] == '' && empty($this->input->post('commnet_section'))) {
            $json['type'] = 'error';
            $json['message'] = 'Please Add Comments in Above Area.';
            echo json_encode($json);
            die;
        } else {
            $comment_data = array(
                'comment_section' => $this->input->post('commnet_section'),
                'comment_section_date' => date('M j Y g:i A')
            );
            $this->db->where('uralensis_request_id', $this->input->post('record_id'));
            $this->db->update('request', $comment_data);
            $json['type'] = 'success';
            $json['message'] = 'Commnets Suuccessfully Added To Report PDF.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Remove Comments From Comment Section
     *
     * @return void
     */
    public function clear_comments_section() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if ($_POST['commnet_section'] == '' && empty($this->input->post('commnet_section'))) {
            $json['type'] = 'error';
            $json['message'] = 'There is Already No Comment To Delete From This Section.';
            echo json_encode($json);
            die;
        } else {
            $comment_data = array(
                'comment_section' => '',
                'comment_section_date' => ''
            );
            $this->db->where('uralensis_request_id', $this->input->post('record_id'));
            $this->db->update('request', $comment_data);
            $json['type'] = 'success';
            $json['message'] = 'Commnets Successfully Removed';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update Report
     *
     * @return void
     */
    public function update_only_report() 
    {

        if (isset($_POST)) {
            $json = array();
            $record_id = $_POST['record_id'];
            $user_id = $this->ion_auth->user()->row()->id;
            $data = array(
                'sur_name' => $this->input->post('sur_name'),
                'patient_initial' => $this->input->post('patient_initial'),
                'pci_number' => $this->input->post('pci_no'),
                'f_name' => $this->input->post('first_name'),
                'emis_number' => $this->input->post('emis_number'),
                'nhs_number' => $this->input->post('nhs_number'),
                'date_taken' => $this->input->post('date_taken'),
                'lab_number' => $this->input->post('lab_number'),
                'hos_number' => $this->input->post('hos_number'),
                'cl_detail' => $this->input->post('cl_detail'),
                'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
                'lab_name' => $this->input->post('lab_name'),
                'date_received_bylab' => date('Y-m-d', strtotime($this->input->post('date_received_bylab'))),
                'data_processed_bylab' => date('Y-m-d', strtotime($this->input->post('data_processed_bylab'))),
                'date_sent_touralensis' => date('Y-m-d', strtotime($this->input->post('date_sent_touralensis'))),
                'cases_category' => $this->input->post('cases_category')
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            $check_record = $this->db->affected_rows();
            if ($check_record == 1) {
                $json['type'] = 'success';
                $json['msg'] = '<div class="bg-success alert">Record Has Been Successfully Updated.</div>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="bg-danger alert">Some how record did not updated successfully or updated already.</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * View PDF Before Publish Report
     *
     * @param int $id
     * @return void
     */
    public function view_report($id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($id)) {
            $get_doc_id = $this->Secretary_model->get_doctor_id();
            $doctor_id = $get_doc_id[0]->ura_sec_rec_doc_id;
            $data1['query1'] = $this->Secretary_model->doctor_record_detail($id, $doctor_id);
            $data2['query2'] = $this->Secretary_model->doctor_record_detail_specimen($id, $doctor_id);
            $data3['query3'] = $this->Secretary_model->get_further_work($id, $doctor_id);
            $data4['query4'] = $this->Secretary_model->get_additional_work_for_prebulish($id);
            $data5['query5'] = $this->Secretary_model->get_hospital_info($id);
            $result = array_merge($data1, $data2, $data3, $data4, $data5);
            $this->load->view('secretary/viewpdf', $result);
        }
    }

    /**
     * Update Client Report
     *
     * @return void
     */
    public function update_client_report() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('specimen_macroscopic_description', 'Macroscopic Description ', 'required');
        $this->form_validation->set_rules('specimen_microscopic_description', 'Microscopic Description', 'required');
        if (isset($_POST)) {
            $record_id = $_POST['record_id'];
            $specimen_id = $_POST['specimen_id'];
            $specimen_benign = $this->input->post('specimen_benign');
            $specimen_atypical = $this->input->post('specimen_atypical');
            $specimen_malignant = $this->input->post('specimen_malignant');
            $specimen_inflammation = $this->input->post('specimen_inflammation');
            $specimen_snomed_t = '';
            $specimen_snomed_p = '';
            $specimen_snomed_m = '';
            if (!empty($this->input->post('specimen_snomed_t'))) {
                $specimen_snomed_t = implode(',', $this->input->post('specimen_snomed_t'));
            }
            if (!empty($this->input->post('specimen_snomed_p'))) {
                $specimen_snomed_p = implode(',', $this->input->post('specimen_snomed_p'));
            }
            if (!empty($this->input->post('specimen_snomed_m'))) {
                $specimen_snomed_m = implode(',', $this->input->post('specimen_snomed_m'));
            }
            $spec = array(
                'specimen_site' => $this->input->post('specimen_site'),
                'specimen_procedure' => $this->input->post('specimen_procedure'),
                'specimen_block' => $this->input->post('specimen_block'),
                'specimen_slides' => $this->input->post('specimen_slides'),
                'specimen_block_type' => $this->input->post('specimen_block_type'),
                'specimen_macroscopic_description' => htmlspecialchars($this->input->post('specimen_macroscopic_description')),
                'specimen_microscopic_code' => $this->input->post('specimen_microscopic_code'),
                'specimen_microscopic_description' => htmlspecialchars($this->input->post('specimen_microscopic_description')),
                'specimen_type' => $this->input->post('specimen_type'),
                'specimen_snomed_code' => $this->input->post('specimen_snomed_code'),
                'specimen_snomed_t' => $specimen_snomed_t,
                'specimen_snomed_p' => $specimen_snomed_p,
                'specimen_snomed_m' => $specimen_snomed_m,
                'specimen_rcpath_code' => $this->input->post('rcpath_code'),
                'specimen_diagnosis_description' => $this->input->post('specimen_diagnosis'),
                'specimen_cancer_register' => $this->input->post('specimen_cancer'),
                'specimen_benign' => !empty($specimen_benign) ? $specimen_benign : '',
                'specimen_atypical' => !empty($specimen_atypical) ? $specimen_atypical : '',
                'specimen_malignant' => !empty($specimen_malignant) ? $specimen_malignant : '',
                'specimen_inflammation' => !empty($specimen_inflammation) ? $specimen_inflammation : ''
            );
            $this->db->where('request_id', $record_id);
            $this->db->where('specimen_id', $specimen_id);
            $this->db->update('specimen', $spec);
            $user_id = $this->ion_auth->user()->row()->id;
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            $check_record = $this->db->affected_rows();
            if ($check_record == 1) {
                $get_doc_id = $this->Secretary_model->get_doctor_id();
                $doctor_id = $get_doc_id[0]->ura_sec_rec_doc_id;
                $session_data = array(
                    'doctor_id' => $doctor_id
                );
                $this->session->set_userdata($session_data);
                $doctor_data = array(
                    'doctor_id' => $doctor_id
                );
                $this->db->where('request_id', $record_id);
                $this->db->update('users_request', $doctor_data);
                $data = array(
                    'specimen_update_status' => 1
                );
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', $data);
                $json['type'] = 'success';
                $json['msg'] = '<div class="bg-success alert">Specimen Has Been Successfully Updated.</div>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="bg-danger alert">Some how specimen did not updated successfully or updated already.</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Teaching And MDT Cases Function
     *
     * @return void
     */
    public function set_teach_and_mdt() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if (isset($_POST['edu_cats'])) {
            $record_id = $_POST['record_id'];
            $edu_cat_data = array(
                'teaching_case' => $_POST['edu_cats']
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $edu_cat_data);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Education Category Updated.</div>';
            echo json_encode($json);
            die;
        }
        
        if (isset($_POST['mdt_dates'])) {
            $record_id = $_POST['record_id'];
            $mdt_cat_data = array(
                'mdt_case' => $_POST['mdt_dates']
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $mdt_cat_data);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">MDT Date Inserted.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add Further Work Controller 
     *
     * @return void
     */
    public function further_work() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_request_fw', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        $get_request_id = $this->input->post('record_id');
        $get_doc_id = $this->Secretary_model->get_doctor_id();
        $doctor_id = $get_doc_id[0]->ura_sec_rec_doc_id;
        if ($_POST['furtherwork_date'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Select Further Work Date.</div>';
            echo json_encode($json);
            die;
        } elseif ($_POST['description'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Add Further Work Description.</div>';
            echo json_encode($json);
            die;
        } else {
            $work = array(
                'furtherword_description' => $this->input->post('description'),
                'furtherwork_date' => $this->input->post('furtherwork_date'),
                'furtherwork_status' => 1,
                'request_id' => $get_request_id,
                'doctor_id' => $doctor_id,
                'fw_status' => 'requested',
                'group_id' => $this->input->post('hospital_group_id')
            );
            $this->Doctor_model->further_work($work);
            $update_service_code = array(
                'fw_levels' => $this->input->post('fwlevels'),
                'fw_immunos' => $this->input->post('immuno'),
                'fw_imf' => $this->input->post('imf')
            );
            $this->db->where('uralensis_request_id', $get_request_id);
            $this->db->update('request', $update_service_code);
            $lab_name_from_request_sql = $this->db->query("SELECT serial_number, patient_initial, lab_name, lab_number FROM request WHERE uralensis_request_id = $get_request_id");
            $get_lab_name_from_request = $lab_name_from_request_sql->row();
            $lab_name_sql = $this->db->query("SELECT * FROM lab_names WHERE lab_name = '$get_lab_name_from_request->lab_name'");
            $lab_name_result = $lab_name_sql->row();
            $lab_name_email = $lab_name_result->lab_email;
            $message = '';
            $message .= '<table width="100%" border="1" cellpadding="3" cellspacing="3">';
            $message .= '<tr>';
            $message .= '<td width="20%"><strong>Patient Initials:</strong></td>';
            $message .= '<td>' . $get_lab_name_from_request->patient_initial . '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td width="20%"><strong>Further Work Description:</strong></td>';
            $message .= '<td width="80%">' . $this->input->post('description') . '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td width="20%"><strong>Lab Number:</strong></td>';
            $message .= '<td width="80%">' . $get_lab_name_from_request->lab_number . '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td width="20%"><strong>Further Work Request Date:</strong></td>';
            $message .= '<td width="80%">' . $this->input->post('furtherwork_date') . '</td>';
            $message .= '</tr>';
            $message .= '</table>';

            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('aleatha@uralensis.com', 'Uralensis');
            $this->email->to($lab_name_email);
            $this->email->subject('Uralensis Further Work Request ' . $get_lab_name_from_request->serial_number);
            $this->email->set_mailtype("html");
            $this->email->message($message);
            if ($this->email->send()) {
                $json['type'] = 'success';
                $json['msg'] = '<div class="alert alert-success">Further Work Requested And Email Sent To Lab Name.</div>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Email Not Sent Due To Server Issue.' . show_error($this->email->print_debugger()) . '</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Save Flag Comments
     *
     * @return void
     */
    public function save_flag_comments() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if (!empty($_POST['flag_comment'])) {
            $record_id = $_POST['record_id'];
            $flag_comments = $_POST['flag_comment'];
            $user_id = $this->ion_auth->user()->row()->id;
            $comments_data = array(
                'ufc_record_id' => $record_id,
                'ufc_comments' => strip_tags($flag_comments),
                'ufc_user_id' => $user_id,
                'ufc_timestamp' => time()
            );
            $this->db->insert('uralensis_flag_comments', $comments_data);
            $json['type'] = 'success';
            $json['msg'] = 'Case Marked as Flagged Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please Add The Comments First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Change Flag Status
     *
     * @return void
     */
    public function set_flag_status() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $encode = '';
        if (!empty($_POST['record_id']) && !empty($_POST['flag_status'])) {
            $record_id = $_POST['record_id'];
            $flag = $_POST['flag_status'];
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', array('flag_status' => $flag));
            $query = $this->db->query("SELECT flag_status FROM request WHERE request.uralensis_request_id = $record_id");
            $check_status = $query->result_array();
            $get_flag_status = $check_status[0]['flag_status'];
            switch ($get_flag_status) {
                case 'flag_red':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
                    break;
                case 'flag_yellow':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for review." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                    break;
                case 'flag_blue':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                    break;
                case 'flag_black':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                    break;
                case 'flag_gray':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
                    break;
                default:
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as new case." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
                    break;
            }
            $json['type'] = 'success';
            $json['flag_data'] = $encode;
            $json['msg'] = 'Flag status changed successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Some how flag status did not updated.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Show Comments Box
     *
     * @return void
     */
    public function show_comments_box() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $encode_data = '';
        if (isset($_POST) && !empty($_POST['record_id'])) {
            $user_id = $this->ion_auth->user()->row()->id;
            $record_id = $_POST['record_id'];
            $flag_data = $this->Secretary_model->get_flag_commnets_record($user_id, $record_id);
            if (!empty($flag_data)) {
                $encode_data .= '<div class="flag_container">';
                $encode_data .= '<ul class="flag_items">';
                foreach ($flag_data as $flag) {
                    $first_name = $this->ion_auth->user($flag->ufc_user_id)->row()->first_name;
                    $last_name = $this->ion_auth->user($flag->ufc_user_id)->row()->last_name;
                    $full_name = $first_name . ' ' . $last_name;
                    $flag_time = date('d-m-Y h:i a', $flag->ufc_timestamp);
                    $encode_data .= '<li>';
                    $encode_data .= '<p>' . $flag->ufc_comments . '</p>';
                    $encode_data .= '</hr>';
                    if ($user_id === $flag->ufc_user_id) {
                        $encode_data .= '<a class="pull-left" href="javascript:;" id="delete_flag_comment" data-flagid="' . $flag->ufc_id . '">Delete</a>';
                    }
                    $encode_data .= '<span class="pull-right">' . $flag_time . '</span>';
                    $encode_data .= '<span class="pull-right" href="javascript:;">Added By : ' . $full_name . '</span>';
                    $encode_data .= '<div class="clearfix"></div>';
                    $encode_data .= '</li>';
                }
                $encode_data .= '</ul>';
                $encode_data .= '</div>';

                $json['type'] = 'success';
                $json['msg'] = 'Comments Found';
                $json['flag_data'] = $encode_data;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Flag Comments Not Yet Added For This Record!';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Delete Flag Comments
     *
     * @return void
     */
    public function delete_flag_comments() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if (isset($_POST) && !empty($_POST['flag_id'])) {
            $flag_id = $_POST['flag_id'];
            $this->db->query("DELETE FROM uralensis_flag_comments WHERE uralensis_flag_comments.ufc_id = $flag_id");
            $json['type'] = 'success';
            $json['msg'] = 'Flag Comment Deleted Successfully!';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Populate Microscopic Data
     *
     * @return void
     */
    public function set_populate_micro_data() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        if (!empty($_POST['micro_code'])) {
            $micro_code = $_POST['micro_code'];
            $micro_data = $this->Secretary_model->populate_micro_records_model($micro_code);
            if (!empty($micro_data)) {
                echo json_encode($micro_data[0]);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Record Found';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Download Tracker Reports
     *
     * @return void
     */
    public function download_tracker() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_download_tracker', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $data['hospital_groups'] = $this->Secretary_model->get_hospital_groups();
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/download_record', $data);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Find CSV Reports
     *
     * @return void
     */
    public function find_csv_reports() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_download_tracker', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_GET) && $_GET['hospital_list'] > 0 && $_GET['date_to'] != '' && $_GET['date_from'] != '') {
            $group_id = $_GET['hospital_list'];
            $date_to = date('Y-m-d', strtotime($_GET['date_to']));
            $date_from = date('Y-m-d', strtotime($_GET['date_from']));
            if (isset($_GET['published_reports'])) {
                $csv_records['find_csv_records'] = $this->Secretary_model->find_csv_report_model_publish($group_id, $date_to, $date_from);
            } else {
                $csv_records['find_csv_records'] = $this->Secretary_model->find_csv_report_model_publish_unpublish($group_id, $date_to, $date_from);
            }
            $this->load->view('secretary/inc/header');
            $this->load->view('secretary/csv_records', $csv_records);
            $this->load->view('secretary/inc/footer');
        } else {
            $search_error = '<p class="alert bg-danger">Some Thing Wrong. Try To Fill Out All Fields And Then Press Search Reports.</p>';
            $this->session->set_flashdata('csv_search_error', $search_error);
            redirect('secretary/download_reports');
        }
    }

    /**
     * Download Excel Report
     *
     * @return void
     */
    public function download_csv_publish() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (isset($_GET)) {
            $csv_records_query = '';
            $group_id = $_GET['hospital_list'];
            $date_to = date('Y-m-d', strtotime($_GET['date_to']));
            $date_from = date('Y-m-d', strtotime($_GET['date_from']));
            $group_name = $this->ion_auth->group($group_id)->row()->description;
            $csv_records_query .= "SELECT request.uralensis_request_id,
                            request.date_sent_touralensis, request.cl_detail,
                            ";

            if (!empty($_GET['ura_no'])) {
                $csv_records_query .= 'request.serial_number,';
            }
            if (!empty($_GET['check_date_taken'])) {
                $csv_records_query .= 'request.date_taken,';
            }
            if (!empty($_GET['lab_number'])) {
                $csv_records_query .= 'request.lab_number,';
            }
            if (!empty($_GET['patient_name'])) {
                $csv_records_query .= 'request.f_name,request.sur_name,';
            }
            if (!empty($_GET['patient_sex'])) {
                $csv_records_query .= 'request.gender,';
            }
            if (!empty($_GET['check_dob'])) {
                $csv_records_query .= 'request.dob,';
            }
            if (!empty($_GET['nhs_number'])) {
                $csv_records_query .= 'request.nhs_number,';
            }
            if (!empty($_GET['emis_number'])) {
                $csv_records_query .= 'request.emis_number,';
            }
            if (!empty($_GET['check_date_rec_by_lab'])) {
                $csv_records_query .= 'request.date_received_bylab,';
            }
            if (!empty($_GET['check_date_autho'])) {
                $csv_records_query .= 'request.publish_datetime,';
            }
            if (!empty($_GET['clinician'])) {
                $csv_records_query .= 'request.clrk';
            }
            $csv_records_query = rtrim($csv_records_query, ',');
            $csv_records_query .= " FROM request 
                            INNER JOIN users_request
                            INNER JOIN groups
                            WHERE users_request.request_id = request.uralensis_request_id
                            AND groups.id = users_request.group_id
                            AND users_request.group_id = $group_id
                            AND request.specimen_publish_status = 1
                            AND request.publish_datetime >= '$date_from'
                            AND request.publish_datetime < '$date_to'";

            $date = date('M j Y g:i A');
            $file_name = strtolower($group_name) . '_' . $date . '.csv';
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . $file_name);
            $output = fopen('php://output', 'w');
            fputcsv($output, array(
                $group_name,
                    )
            );
            fputcsv($output, array(
                'Uralensis NO',
                'Date Taken',
                'Lab Number',
                'Patient Name',
                'Sex',
                'Date of Birth',
                'NHS Number',
                'Emis Number',
                'D. Received Lab',
                'D. Authorised',
                'Specimen(s)',
                'Clinician',
                'Diagnosis',
                'Snomed T',
                'Snomed P',
                'Snomed M'
                    )
            );
            $query_csv_records = $this->db->query($csv_records_query);
            foreach ($query_csv_records->result_array() as $row) {
                $specimens = $this->count_specimens($row['uralensis_request_id']);
                $fname = !empty($row['f_name']) ? $row['f_name'] : '';
                $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
                $patinet_name = $fname . ' ' . $surname;
                fputcsv($output, array(
                    'Uralensis NO' => !empty($row['serial_number']) ? $row['serial_number'] : '',
                    'Date Taken' => !empty($row['date_taken']) ? $row['date_taken'] : '',
                    'Lab Number' => !empty($row['lab_number']) ? $row['lab_number'] : '',
                    'Patient Name' => !empty($patinet_name) ? $patinet_name : '',
                    'Sex' => !empty($row['gender']) ? $row['gender'] : '',
                    'Date of Birth' => !empty($row['dob']) ? $row['dob'] : '',
                    'NHS Number' => !empty($row['nhs_number']) ? $row['nhs_number'] : '',
                    'Emis Number' => !empty($row['emis_number']) ? $row['emis_number'] : '',
                    'D. Received Lab' => !empty($row['date_received_bylab']) ? $row['date_received_bylab'] : '',
                    'D. Authorised' => !empty($row['publish_datetime']) ? $row['publish_datetime'] : '',
                    'Specimen(s)' => !empty($specimens) ? count($specimens) : '',
                    'Clinician' => !empty($row['clrk']) ? $row['clrk'] : '',
                        )
                );
                if (!empty($_GET['speci_diagnosis'])) {
                    if (!empty($specimens)) {
                        foreach ($specimens as $spec) {
                            $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                            $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                            $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                            fputcsv($output, array(
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                'Diagnosis' => !empty($spec['specimen_diagnosis_description']) ? $spec['specimen_diagnosis_description'] : '',
                                'Snomed T' => !empty($snomed_t) ? $snomed_t : '',
                                'Snomed P' => !empty($snomed_p) ? $snomed_p : '',
                                'Snomed M' => !empty($snomed_m) ? $snomed_m : '',
                                    )
                            );
                        }
                    }
                }
            }
        }
    }

    /**
     * Download Excel Report
     *
     * @return void
     */
    public function download_csv_publish_unpublish() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (isset($_GET)) {
            $csv_pub_unpub = '';
            $group_id = $_GET['hospital_list'];
            $date_to = date('Y-m-d', strtotime($_GET['date_to']));
            $date_from = date('Y-m-d', strtotime($_GET['date_from']));
            $group_name = $this->ion_auth->group($group_id)->row()->description;
            $csv_pub_unpub .= "SELECT request.uralensis_request_id, request.specimen_publish_status, 
                            request.date_sent_touralensis, request.cl_detail, request.request_datetime, 
                            ";

            if (!empty($_GET['ura_no'])) {
                $csv_pub_unpub .= ' request.serial_number,';
            }
            if (!empty($_GET['check_date_taken'])) {
                $csv_pub_unpub .= ' request.date_taken,';
            }
            if (!empty($_GET['lab_number'])) {
                $csv_pub_unpub .= ' request.lab_number,';
            }
            if (!empty($_GET['patient_name'])) {
                $csv_pub_unpub .= ' request.f_name, request.sur_name,';
            }
            if (!empty($_GET['patient_sex'])) {
                $csv_pub_unpub .= ' request.gender,';
            }
            if (!empty($_GET['check_dob'])) {
                $csv_pub_unpub .= ' request.dob,';
            }
            if (!empty($_GET['nhs_number'])) {
                $csv_pub_unpub .= ' request.nhs_number,';
            }
            if (!empty($_GET['emis_number'])) {
                $csv_pub_unpub .= ' request.emis_number,';
            }
            if (!empty($_GET['check_date_rec_by_lab'])) {
                $csv_pub_unpub .= ' request.date_received_bylab,';
            }
            if (!empty($_GET['check_date_autho'])) {
                $csv_pub_unpub .= ' request.publish_datetime,';
            }
            if (!empty($_GET['clinician'])) {
                $csv_pub_unpub .= ' request.clrk ';
            }
            $csv_pub_unpub = rtrim($csv_pub_unpub, ',');
            $csv_pub_unpub .= " FROM request
                INNER JOIN users_request
                INNER JOIN groups
                WHERE users_request.request_id = request.uralensis_request_id
                AND groups.id = users_request.group_id
                AND users_request.group_id = $group_id
                AND (request.specimen_publish_status = 1 OR request.specimen_publish_status = 0)
                AND request.request_datetime >= '$date_from' AND request.request_datetime < '$date_to'";

            $query_csv_records = $this->db->query($csv_pub_unpub);
            $date = date('M j Y g:i A');
            $file_name = strtolower($group_name) . '_' . $date . '.csv';
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=' . $file_name);
            $output = fopen('php://output', 'w');
            fputcsv($output, array(
                $group_name,
                    )
            );
            fputcsv($output, array(
                'Uralensis NO',
                'Date Taken',
                'Lab Number',
                'Patient Name',
                'Sex',
                'Date of Birth',
                'NHS Number',
                'Emis Number',
                'D. Received Lab',
                'D. Authorised',
                'Specimen(s)',
                'Clinician',
                'Diagnosis',
                'Snomed T',
                'Snomed P',
                'Snomed M'
                    )
            );
            fputcsv($output, array(
                'Publish Records'
                    )
            );
            foreach ($query_csv_records->result_array() as $row) {
                $specimens = $this->count_specimens($row['uralensis_request_id']);
                $fname = !empty($row['f_name']) ? $row['f_name'] : '';
                $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
                $patinet_name = $fname . ' ' . $surname;
                if ($row['specimen_publish_status'] == 1) {
                    fputcsv($output, array(
                        'Uralensis NO' => !empty($row['serial_number']) ? $row['serial_number'] : '',
                        'Date Taken' => !empty($row['date_taken']) ? $row['date_taken'] : '',
                        'Lab Number' => !empty($row['lab_number']) ? $row['lab_number'] : '',
                        'Patient Name' => !empty($patinet_name) ? $patinet_name : '',
                        'Sex' => !empty($row['gender']) ? $row['gender'] : '',
                        'Date of Birth' => !empty($row['dob']) ? $row['dob'] : '',
                        'NHS Number' => !empty($row['nhs_number']) ? $row['nhs_number'] : '',
                        'Emis Number' => !empty($row['emis_number']) ? $row['emis_number'] : '',
                        'D. Received Lab' => !empty($row['date_received_bylab']) ? $row['date_received_bylab'] : '',
                        'D. Authorised' => !empty($row['publish_datetime']) ? $row['publish_datetime'] : '',
                        'Specimen(s)' => !empty($specimens) ? count($specimens) : '',
                        'Clinician' => !empty($row['clrk']) ? $row['clrk'] : ''
                            )
                    );
                    if (!empty($_GET['speci_diagnosis'])) {
                        if (!empty($specimens)) {
                            foreach ($specimens as $spec) {
                                $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                                $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                                $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                                fputcsv($output, array(
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    'Diagnosis' => !empty($spec['specimen_diagnosis_description']) ? $spec['specimen_diagnosis_description'] : '',
                                    'Snomed T' => !empty($snomed_t) ? $snomed_t : '',
                                    'Snomed P' => !empty($snomed_p) ? $snomed_p : '',
                                    'Snomed M' => !empty($snomed_m) ? $snomed_m : '',
                                        )
                                );
                            }
                        }
                    }
                }
            }
            fputcsv($output, array(
                'Un-Publish Records'
                    )
            );
            foreach ($query_csv_records->result_array() as $row) {
                $specimens = $this->count_specimens($row['uralensis_request_id']);
                $fname = !empty($row['f_name']) ? $row['f_name'] : '';
                $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
                $patinet_name = $fname . ' ' . $surname;
                if ($row['specimen_publish_status'] == 0) {
                    fputcsv($output, array(
                        'Uralensis NO' => !empty($row['serial_number']) ? $row['serial_number'] : '',
                        'Date Taken' => !empty($row['date_taken']) ? $row['date_taken'] : '',
                        'Lab Number' => !empty($row['lab_number']) ? $row['lab_number'] : '',
                        'Patient Name' => !empty($patinet_name) ? $patinet_name : '',
                        'Sex' => !empty($row['gender']) ? $row['gender'] : '',
                        'Date of Birth' => !empty($row['dob']) ? $row['dob'] : '',
                        'NHS Number' => !empty($row['nhs_number']) ? $row['nhs_number'] : '',
                        'Emis Number' => !empty($row['emis_number']) ? $row['emis_number'] : '',
                        'D. Received Lab' => !empty($row['date_received_bylab']) ? $row['date_received_bylab'] : '',
                        'D. Authorised' => !empty($row['publish_datetime']) ? $row['publish_datetime'] : '',
                        'Specimen(s)' => !empty($specimens) ? count($specimens) : '',
                        'Clinician' => !empty($row['clrk']) ? $row['clrk'] : ''
                            )
                    );
                    if (!empty($_GET['speci_diagnosis'])) {
                        if (!empty($specimens)) {
                            foreach ($specimens as $spec) {
                                fputcsv($output, array(
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    'Diagnosis' => !empty($spec['specimen_diagnosis_description']) ? $spec['specimen_diagnosis_description'] : '',
                                        )
                                );
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Specimens Count
     *
     * @param int $record_id
     * @return void
     */
    public function count_specimens($record_id) 
    {
        if (isset($record_id)) {
            $query2 = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN users
                    INNER JOIN specimen
                    WHERE request.uralensis_request_id = $record_id
                    AND users_request.request_id = $record_id
                    AND specimen.request_id = $record_id
                    AND users_request.users_id = users.id");

            return $query2->result_array();
        }
    }

    /**
     * Download Reports
     *
     * @return void
     */
    public function download_reports() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['hospital_groups'] = $this->Secretary_model->get_hospital_groups();
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/download_record', $data);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Assign MDT dates to Record
     *
     * @return void
     */
    public function assign_mdt_record() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_mdt', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if (isset($_POST['mdt_dates_radio']) && $_POST['mdt_dates_radio'] === 'for_mdt') {
            $record_id = $_POST['record_id'];
            $specimen_data = '';
            $msdt_specimen_data = $this->input->post('mdt_specimen');
            if (!empty($msdt_specimen_data)) {
                $specimen_data = serialize($msdt_specimen_data);
            }
            $user_id = $this->ion_auth->user()->row()->id;
            $username = $this->ion_auth->user($user_id)->row()->username;
            $data = array(
                'mdt_case' => $this->input->post('mdt_dates'),
                'mdt_case_status' => $this->input->post('mdt_dates_radio'),
                'mdt_specimen_status' => $specimen_data,
                'mdt_case_assignee_username' => $username
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            $json['type'] = 'success';
            $json['msg'] = 'MDT Date Assign Suuccessfully.!';
            echo json_encode($json);
            die;
        } else {
            $record_id = $_POST['record_id'];
            $data = array(
                'mdt_case' => $this->input->post('report_option'),
                'mdt_case_status' => $this->input->post('mdt_dates_radio')
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            $json['type'] = 'success';
            $json['msg'] = 'MDT Option Added!';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Display MDT Cases Controller
     *
     * @return void
     */
    public function mdt_cases() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_view_mdt', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $hospitals["get_hospitals"] = $this->Secretary_model->get_hospital_groups();
        $result = array_merge($hospitals);
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/mdt_cases', $result);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Find MDT Dates
     *
     * @return void
     */
    public function find_mdt_dates() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $encode_future = '';
        if ($_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $get_mdt_dates = $this->Secretary_model->get_all_mdt_dates($hospital_id);
            if (!empty($get_mdt_dates)) {
                $encode_future .= '<select class="form-control" name="mdt_dates" id="mdt_dates">';
                $encode_future .= '<option value="false">Choose Up Coming MDT Dates</option>';
                foreach ($get_mdt_dates as $dates) {
                    $encode_future .= '<option value="' . $dates->ura_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                }
                $encode_future .= '</select>';
                $json['type'] = 'success';
                $json['dates_data'] = $encode_future;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'NO MDT Found Against the selected Hospital.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find Archived MDT Dates
     *
     * @return void
     */
    public function find_prev_mdt_dates() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $encode_prev = '';
        if ($_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];

            $get_prev_mdt_dates = $this->Secretary_model->get_previous_all_mdt_dates($hospital_id);
            if (!empty($get_prev_mdt_dates)) {
                $encode_prev .= '<select class="form-control" name="prev_mdt_dates" id="prev_mdt_dates">';
                $encode_prev .= '<option value="false">Choose Archived MDT Dates</option>';
                foreach ($get_prev_mdt_dates as $dates) {
                    $encode_prev .= '<option value="' . $dates->ura_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                }
                $encode_prev .= '</select>';
                $json['type'] = 'success';
                $json['dates_prev_data'] = $encode_prev;
                $json['msg'] = 'Following Archived MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'NO Archived MDT Found Against the selected Hospital.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find MDT Records
     *
     * @return void
     */
    public function find_mdt_cases() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode = '';
        if (!empty($_POST['hospital_id']) && !empty($_POST['mdt_date'])) {
            $hospital_id = $_POST['hospital_id'];
            $mdt_date = $_POST['mdt_date'];
            $secretary_id = $this->ion_auth->user()->row()->id;
            $sec_doc_data = $this->db->query("SELECT * FROM uralensis_doctor_sec_assign WHERE uralensis_doctor_sec_assign.ura_sec_id = $secretary_id")->result();
            $doctor_id = $sec_doc_data[0]->ura_doctor_id;
            $mdt_record = $this->Secretary_model->mdt_cases_list_model($hospital_id, $mdt_date, $doctor_id);
            if (!empty($mdt_record)) {
                $encode .='<a download href="' . base_url('index.php/secretary/generate_word?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date . '&doctor_id=' . $doctor_id) . '">Download Word</a>';
                $encode .='<table class="table table-condensed">';
                $encode .='<tr>';
                $encode .='<th>Serial No</th>';
                $encode .='<th>First Name</th>';
                $encode .='<th>Sur Name</th>';
                $encode .='<th>EMIS No</th>';
                $encode .='<th>Gender</th>';
                $encode .='<th>Authorized</th>';
                $encode .='</tr>';
                foreach ($mdt_record as $row) {
                    $encode .= '<tr>';
                    $encode .= '<td>' . $row->serial_number . '</td>';
                    $encode .= '<td>' . $row->f_name . '</td>';
                    $encode .= '<td>' . $row->sur_name . '</td>';
                    $encode .= '<td>' . $row->emis_number . '</td>';
                    $encode .= '<td>' . $row->gender . '</td>';
                    $authorize_status = 'NO';
                    if ($row->specimen_publish_status == 1) {
                        $authorize_status = 'YES';
                    }
                    $encode .= '<td>' . $authorize_status . '</td>';
                    $encode .= '</tr>';
                }
                $encode .='</table>';
                $json['type'] = 'success';
                $json['mdt_data'] = $encode;
                $json['msg'] = 'MDT Record Found.';
                echo json_encode($json);
                die;
            } else {
                $encode .= '<tr><td>No Record Found</td></tr>';
                $json['type'] = 'error';
                $json['mdt_data'] = $encode;
                $json['msg'] = 'No MDT Record Found.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find Previous MDT Cases
     *
     * @return void
     */
    public function find_prev_mdt_cases() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $encode = '';
        if (!empty($_POST['hospital_id']) && !empty($_POST['prev_mdt_date'])) {

            $hospital_id = $_POST['hospital_id'];
            $prev_mdt_date = $_POST['prev_mdt_date'];
            $secretary_id = $this->ion_auth->user()->row()->id;
            $sec_doc_data = $this->db->query("SELECT * FROM uralensis_doctor_sec_assign WHERE uralensis_doctor_sec_assign.ura_sec_id = $secretary_id")->result();
            $doctor_id = $sec_doc_data[0]->ura_doctor_id;
            $mdt_record = $this->Secretary_model->mdt_cases_list_model($hospital_id, $prev_mdt_date, $doctor_id);
            if (!empty($mdt_record)) {
                $encode .='<a download href="' . base_url('index.php/secretary/generate_word?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date . '&doctor_id=' . $doctor_id) . '">Download Word</a>';
                $encode .='<table class="table table-condensed">';
                $encode .='<tr>';
                $encode .='<th>Serial No</th>';
                $encode .='<th>First Name</th>';
                $encode .='<th>Sur Name</th>';
                $encode .='<th>EMIS No</th>';
                $encode .='<th>Gender</th>';
                $encode .='</tr>';
                foreach ($mdt_record as $row) {
                    $encode .= '<tr>';
                    $encode .= '<td>' . $row->serial_number . '</td>';
                    $encode .= '<td>' . $row->f_name . '</td>';
                    $encode .= '<td>' . $row->sur_name . '</td>';
                    $encode .= '<td>' . $row->emis_number . '</td>';
                    $encode .= '<td>' . $row->gender . '</td>';
                    $encode .= '</tr>';
                }
                $encode .='</table>';
                $json['type'] = 'success';
                $json['mdt_prev_data'] = $encode;
                $json['msg'] = 'Archived MDT Records Found.';
                echo json_encode($json);
                die;
            } else {
                $encode .= '<tr><td>No Record Found</td></tr>';
                $json['type'] = 'error';
                $json['mdt_data'] = $encode;
                $json['msg'] = 'No Archived MDT Records Found.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Generate Word Report
     *
     * @return void
     */
    public function generate_word() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date']) && !empty($_GET['doctor_id'])) {
            $hospital_id = $_GET['hospital_id'];
            $mdt_date = $_GET['mdt_date'];
            $doctor_id = $_GET['doctor_id'];
            $mdt_record['mdt_records'] = $this->Secretary_model->mdt_cases_list_model($hospital_id, $mdt_date, $doctor_id);
            $doctor_id_data = array(
                'doctor_id' => $doctor_id
            );
            $mdt_cases_data = array_merge($mdt_record, $doctor_id_data);
            $this->load->view('secretary/inc/documents/word', $mdt_cases_data);
        }
    }

    /**
     * Check if the Role Permissions retunrs false
     * then call this function.
     * 
     * @access public
     * @return html
     */
    public function forbidden() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/forbidden');
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Show Clinic Dates With Hospital List
     *
     * @return void
     */
    public function show_hospital_clinic_dates() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $hospital_list['hospitals_list'] = $this->Secretary_model->get_hospital_groups();
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/clinic_dates/show_hospital_clinic_dates', $hospital_list);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Show Clinic Dates
     *
     * @return void
     */
    public function show_clinic_dates() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_GET) && $_GET['hospital_id'] != 'false') {
            $hospital_id = $_GET['hospital_id'];
            $ref_counter = 0001;
            $get_ref_last_rec = $this->db->query("SELECT * FROM uralensis_clinic_dates AS ucd
            WHERE ucd.ura_clinic_hospital_id = $hospital_id
            ORDER BY ucd.ura_clinic_date_id DESC
            LIMIT 1")->result();
            $db_ref_key = '';
            if (!empty($get_ref_last_rec)) {
                $db_ref_key = $get_ref_last_rec[0]->ura_clinic_ref_no;
                $clinic_ref_explode = explode('-', $db_ref_key);
                $clinic_ref = (int) $clinic_ref_explode[2];
                if (!empty($clinic_ref)) {
                    $ref_counter = $clinic_ref + 1;
                }
            }
            $ref_data['ref_data'] = array(
                'ref_key' => sprintf("%04d", $ref_counter)
            );
            $clinic_upcoming['clinic_upcoming'] = $this->Secretary_model->get_upcoming_clinic_dates($hospital_id);
            $clinic_previous['clinic_previous'] = $this->Secretary_model->get_previous_clinic_dates($hospital_id);
            $clinic_data = array_merge($ref_data, $clinic_upcoming, $clinic_previous);
            $this->load->view('secretary/inc/header');
            $this->load->view('secretary/clinic_dates/add_clinic_dates', $clinic_data);
            $this->load->view('secretary/inc/footer');
        } else {
            $msg = '<div class="alert alert-danger">Kindly Choose the hospital first.</div>';
            $this->session->set_flashdata('hospital_error', $msg);
            redirect('secretary/show_hospital_clinic_dates', 'refresh');
        }
    }

    /**
     * Add Clinic Dates
     *
     * @return void
     */
    public function add_clinics_date() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_POST) && !empty($_POST['add_clinic_date'])) {
            $ura_clinic_ref = $this->input->post('ref_number');
            $ura_clinic_date = $this->input->post('clinic_date');
            $ura_clinic_loca = $this->input->post('location');
            $ura_clinic_lead = $this->input->post('clinic_lead');
            $hospital_id = $this->input->post('hospital_id');
            $ura_clinic_data = array(
                'ura_clinic_date' => date(strtotime($ura_clinic_date)),
                'ura_clinic_hospital_id' => $hospital_id,
                'ura_clinic_ref_no' => $ura_clinic_ref,
                'ura_clinic_loca' => $ura_clinic_loca,
                'ura_clinic_lead' => $ura_clinic_lead,
                'ura_clinic_add_timestamp' => time()
            );
            $this->db->insert('uralensis_clinic_dates', $ura_clinic_data);
            $msg = '<div class="alert alert-success">Clinic Date Successfully Added.</div>';
            $this->session->set_flashdata('clinic_date', $msg);
            redirect('secretary/show_clinic_dates/?hospital_id=' . $hospital_id, 'refresh');
        }
    }

    /**
     * Edit Clinic Date
     *
     * @return void
     */
    public function edit_clinic_date() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $clinic_record_id = '';
        $hospital_id = '';
        if (isset($_GET['rec_id']) && !empty($_GET['rec_id'])) {
            $clinic_record_id = $_GET['rec_id'];
        }
        if (isset($_GET['hopital_id']) && !empty($_GET['hopital_id'])) {
            $hospital_id = $_GET['hopital_id'];
        }
        $clinic_data['clinic_data'] = $this->Secretary_model->display_clinic_edit_data($clinic_record_id, $hospital_id);
        $checklist_data['checklist_data'] = $this->Secretary_model->display_clinic_checklist_data($clinic_record_id);
        $request_data['request_data'] = $this->Secretary_model->display_clinic_requestform_data($clinic_record_id);
        $other_data['otherdoc_data'] = $this->Secretary_model->display_clinic_otherdoc_data($clinic_record_id);
        $clinic_request['request_form'] = $this->Secretary_model->get_all_clinic_requests_data($hospital_id, $clinic_record_id);
        $batches_list['batches_list'] = $this->Secretary_model->get_all_hospital_batches($hospital_id);
        $clinic_edit_data = array_merge($clinic_data, $checklist_data, $request_data, $other_data, $clinic_request, $batches_list);
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/clinic_dates/edit_clinic_date', $clinic_edit_data);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Process Edit Clinic Date
     *
     * @return void
     */
    public function process_edit_clinic_date() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_POST) && !empty($_POST['save_clinic_date'])) {
            $total_patients = $this->input->post('total_patients');
            $total_samples = $this->input->post('total_samples');
            $imf_samples = $this->input->post('imf_samples');
            $batch_id = $this->input->post('clinic_batches');
            $rec_id = $this->input->post('rec_id');
            $hospital_id = $this->input->post('hospital_id');
            $ref_key = $this->input->post('ref_key');
            if (isset($_FILES['upload_checklist']) && $_FILES['upload_checklist']['name'] != '') {
                $upload_checklist = $this->do_upload_clinic_files('upload_checklist', $ref_key);
                if ($upload_checklist === false) {
                    $error = array('upload_error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_error', $error['upload_error']);
                } else {
                    $data = $this->upload->data();
                    $checklist_file_name = $data['file_name'];
                    $checklist_file_ext = $data['file_ext'];
                    $checklist_file_type = $data['is_image'];
                }
            }
            if (isset($_FILES['upload_request_form']) && $_FILES['upload_request_form']['name'] != '') {
                $upload_request_form = $this->do_upload_clinic_files('upload_request_form', '');
                if ($upload_request_form === false) {
                    $error = array('upload_error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_error', $error['upload_error']);
                } else {
                    $data = $this->upload->data();
                    $request_file_name = $data['file_name'];
                    $request_file_ext = $data['file_ext'];
                    $request_file_type = $data['is_image'];
                }
            }
            if (isset($_FILES['upload_other_doc']) && $_FILES['upload_other_doc']['name'] != '') {
                $upload_other_doc = $this->do_upload_clinic_files('upload_other_doc', $ref_key);
                if ($upload_other_doc === false) {
                    $error = array('upload_error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_error', $error['upload_error']);
                } else {
                    $data = $this->upload->data();
                    $other_doc_file_name = $data['file_name'];
                    $other_doc_file_ext = $data['file_ext'];
                    $other_doc_file_type = $data['is_image'];
                }
            }
            $clinic_edit_data = array(
                'ura_clinic_total_patients' => !empty($total_patients) ? $total_patients : '',
                'ura_clinic_total_samples' => !empty($total_samples) ? $total_samples : '',
                'ura_clinic_imf_samples' => !empty($imf_samples) ? $imf_samples : '',
                'ura_clinic_batch_id' => !empty($batch_id) ? $batch_id : '',
                'ura_clinic_edit_timestamp' => time()
            );
            $this->db->where('ura_clinic_date_id', $rec_id);
            $this->db->update('uralensis_clinic_dates', $clinic_edit_data);
            if (!empty($checklist_file_name)) {
                $clinic_checklsit_upload_data = array(
                    'ura_clinic_checklist_form' => !empty($checklist_file_name) ? $checklist_file_name : '',
                    'ura_clinic_checklist_ext' => !empty($checklist_file_ext) ? $checklist_file_ext : '',
                    'ura_clinic_checklist_image_type' => !empty($checklist_file_type) ? $checklist_file_type : '',
                    'ura_clinic_date_id' => $rec_id,
                    'ura_clinic_checklist_timestamp' => time()
                );
                $this->db->insert('uralensis_clinic_date_checklist_uploads', $clinic_checklsit_upload_data);
            }
            if (!empty($request_file_name)) {
                $clinic_request_upload_data = array(
                    'ura_clinic_request_form' => !empty($request_file_name) ? $request_file_name : '',
                    'ura_clinic_request_ext' => !empty($request_file_ext) ? $request_file_ext : '',
                    'ura_clinic_request_image_type' => !empty($request_file_type) ? $request_file_type : '',
                    'ura_clinic_date_id' => $rec_id,
                    'ura_clinic_request_timestamp' => time()
                );
                $this->db->insert('uralensis_clinic_date_requestform_uploads', $clinic_request_upload_data);
            }
            if (!empty($other_doc_file_name)) {
                $clinic_otherdocs_upload_data = array(
                    'ura_clinic_otherdoc_form' => !empty($other_doc_file_name) ? $other_doc_file_name : '',
                    'ura_clinic_otherdoc_ext' => !empty($other_doc_file_ext) ? $other_doc_file_ext : '',
                    'ura_clinic_otherdoc_image_type' => !empty($other_doc_file_type) ? $other_doc_file_type : '',
                    'ura_clinic_date_id' => $rec_id,
                    'ura_clinic_otherdocs_timestamp' => time()
                );
                $this->db->insert('uralensis_clinic_date_otherdocs_uploads', $clinic_otherdocs_upload_data);
            }
        }
        $msg = '<div class="alert alert-success">Clinic Edit Successfully.</div>';
        $this->session->set_flashdata('clinic_edit', $msg);
        redirect('secretary/edit_clinic_date/?rec_id=' . $rec_id . '&hopital_id=' . $hospital_id . '&ref_key=' . $ref_key, 'refresh');
    }

    /**
     * Upload Clinic Files
     *
     * @param string $clinic_filename
     * @param string $ref_key
     * @return void
     */
    public function do_upload_clinic_files($clinic_filename, $ref_key) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $config['upload_path'] = './clinic_uploads/';
        $config['allowed_types'] = 'pdf|png|jpg|docx|doc';
        $config['max_size'] = 20400;
        $config['overwrite'] = TRUE;
        if (!empty($ref_key)) {
            $new_name = $ref_key . '-' . $_FILES[$clinic_filename]['name'];
        } else {
            $new_name = $_FILES[$clinic_filename]['name'];
        }
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($clinic_filename)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Delete Clinic Date Upload Files
     *
     * @return void
     */
    public function delete_clinic_upload_files() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['file_id'])) {
            $upload_type = $this->input->post('file_type');
            $file_id = $this->input->post('file_id');
            $hospital_id = $this->input->post('hospital_id');
            if ($upload_type === 'checklist_files') {
                $this->db->delete('uralensis_clinic_date_checklist_uploads', array('ucd_checklist_upload_id' => $file_id));
                $json['type'] = 'success';
                echo json_encode($json);
                die;
            } elseif ($upload_type === 'request_files') {
                $this->db->delete('uralensis_clinic_date_requestform_uploads', array('ucd_requestform_upload_id' => $file_id));
                $this->db->where('clinic_request_form', $file_id)->where('hospital_group_id', $hospital_id);
                $this->db->update('request', array('clinic_request_form' => NULL));
                $json['type'] = 'success';
                echo json_encode($json);
                die;
            } elseif ($upload_type === 'other_files') {
                $this->db->delete('uralensis_clinic_date_otherdocs_uploads', array('ucd_otherdocs_upload_id' => $file_id));
                $json['type'] = 'success';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Clinic Reference Auto Suggest Code
     *
     * @return void
     */
    public function clinic_reference_autosuggest() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_REQUEST['query']) && !empty($_REQUEST['hospital_id'])) {
            $user_id = $_REQUEST['hospital_id'];
            $hospital_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
            $search_query = $_REQUEST['query'];
            $sql = "SELECT * FROM uralensis_clinic_dates AS ucd
                    WHERE ucd.ura_clinic_hospital_id = $hospital_id
                    AND ucd.ura_clinic_date >= UNIX_TIMESTAMP(CURDATE() - INTERVAL 10 DAY)
                    AND ucd.ura_clinic_ref_no LIKE '%{$search_query}%'";

            $query = $this->db->query($sql);
            $clinic_data_array = array();
            foreach ($query->result() as $row) {
                $clinic_data_array[$row->ura_clinic_date_id]['key'] = $row->ura_clinic_date_id;
                $clinic_data_array[$row->ura_clinic_date_id]['value'] = $row->ura_clinic_ref_no;
            }
            echo json_encode($clinic_data_array);
        }
    }

    /**
     * Set Populate Request Form Data
     *
     * @return void
     */
    public function set_populate_request_form() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['clinic_record_id'])) {
            $clinic_record_id = $_POST['clinic_record_id'];
            $request_form = $this->Secretary_model->get_request_form_records($clinic_record_id);
            if (empty($request_form)) {
                $json['type'] = 'error';
                $json['msg'] = 'No Request Form Found. Please Add First.';
                echo json_encode($json);
                die;
            } else {
                $encode_data = '';
                $encode_data .= '<div class="form-group">';
                $encode_data .= '<label for="request_form">Request Forms</label>';
                $encode_data .= '<select required class="form-control" name="request_form" id="request_form">';
                $encode_data .= '<option value="false">Choose Request Form</option>';
                foreach ($request_form as $requests) {
                    $encode_data .= '<option value="' . $requests->ucd_requestform_upload_id . '">' . $requests->ura_clinic_request_form . '</option>';
                }
                $encode_data .= '</select>';
                $encode_data .= '</div>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode_data;
                $json['msg'] = 'Following Request Forms Found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Delete Clinic Date
     *
     * @return void
     */
    public function delete_clinic_date() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_GET) && !empty($_GET['rec_id']) && !empty($_GET['hopital_id'])) {
            $clinic_id = $_GET['rec_id'];
            $hospital_id = $_GET['hopital_id'];
            $this->db->where('ura_clinic_date_id', $clinic_id)->where('ura_clinic_hospital_id', $hospital_id);
            $this->db->delete('uralensis_clinic_dates');
            $this->db->where('ura_clinic_date_id', $clinic_id);
            $this->db->delete('uralensis_clinic_date_checklist_uploads');
            $this->db->where('ura_clinic_date_id', $clinic_id);
            $this->db->delete('uralensis_clinic_date_otherdocs_uploads');
            $this->db->where('ura_clinic_date_id', $clinic_id);
            $this->db->delete('uralensis_clinic_date_requestform_uploads');
            $this->db->where('clinic_ref_number', $clinic_id)->where('hospital_group_id', $hospital_id);
            $this->db->update('request', array('clinic_ref_number' => NULL));
            redirect('secretary/show_clinic_dates/?hospital_id=' . $hospital_id, 'refresh');
        }
    }

    /**
     * Display Courier View
     *
     * @return void
     */
    public function show_courier() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $hospitals['hospitals_list'] = $this->Secretary_model->get_hospital_groups();
        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/courier/show_courier', $hospitals);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Add Courier Functyionality
     *
     * @return void
     */
    public function add_courier() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if ($_POST['hospital_id'] === 'false') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Select Hospital First.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['courier_name'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please Enter the courier name.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['courier_address'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please enter the courier address.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['courier_cost_code'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please enter courier cost code price.';
            echo json_encode($json);
            die;
        }
        if (!intval($_POST['courier_cost_code'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Courier cost code price must be in numbers.';
            echo json_encode($json);
            die;
        }
        $courier_data = array(
            'ura_courier_name' => $_POST['courier_name'],
            'ura_courier_address' => $_POST['courier_address'],
            'ura_courier_cost_code' => floatval($_POST['courier_cost_code']),
            'ura_courier_hospital_id' => $_POST['hospital_id'],
            'ura_courier_timestamp' => time()
        );
        $this->db->insert('uralensis_courier', $courier_data);
        $json['type'] = 'success';
        $json['msg'] = 'Courier Added Successfully. Refreshing....';
        echo json_encode($json);
        die;
    }

    /**
     * Delete Courier
     *
     * @return void
     */
    public function delete_courier() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['courier_id'])) {
            $courier_id = $_POST['courier_id'];
            $this->db->where('ura_courier_id', $courier_id);
            $this->db->delete('uralensis_courier');
            $json['type'] = 'success';
            $json['msg'] = 'Courier Deleted Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something wrong while deleting the record.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Display Courier Records
     *
     * @return void
     */
    public function display_courier_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        $encode_data = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $couriers_records = $this->Secretary_model->get_couriers_display_record($hospital_id);
            if (!empty($couriers_records)) {
                $encode_data .= '<table id="courier_records_table" class="table table-condensed">';
                $encode_data .= '<thead>';
                $encode_data .= '<tr>';
                $encode_data .= '<th>Name</th>';
                $encode_data .= '<th>Address</th>';
                $encode_data .= '<th>Cost Code</th>';
                $encode_data .= '<th>Timestamp</th>';
                $encode_data .= '<th>&nbsp;</th>';
                $encode_data .= '</tr>';
                $encode_data .= '</thead>';
                $encode_data .= '<tbody>';
                foreach ($couriers_records as $couriers) {
                    $encode_data .= '<tr>';
                    $encode_data .= '<td>' . $couriers->ura_courier_name . '</td>';
                    $encode_data .= '<td>' . $couriers->ura_courier_address . '</td>';
                    $encode_data .= '<td>' . $couriers->ura_courier_cost_code . '</td>';
                    $encode_data .= '<td>' . date('d-m-Y', $couriers->ura_courier_timestamp) . '</td>';
                    $encode_data .= '<td><a href="javascript:;" class="delete_courier_id" data-courierid="' . $couriers->ura_courier_id . '"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                    $encode_data .= '</tr>';
                }
                $encode_data .= '</tbody>';
                $encode_data .= '</table>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode_data;
                $json['msg'] = 'Following Records Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'You have not added any courier against the selected hospital.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please Choose The Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Generate Batch Key
     *
     * @return void
     */
    public function generate_batch_key() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        $encode_batch = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $f_initial = $this->ion_auth->group($hospital_id)->row()->first_initial;
            $l_initial = $this->ion_auth->group($hospital_id)->row()->last_initial;
            $h_letter_first = '';
            $h_letter_last = '';
            if (!empty($f_initial)) {
                $h_letter_first = $f_initial;
            }
            if (!empty($f_initial)) {
                $h_letter_last = $l_initial;
            }
            $ref_counter = 0001;
            $get_ref_last_rec = $this->db->query("SELECT * FROM uralensis_batches AS ub
            WHERE ub.ura_batch_hospital_id = $hospital_id
            ORDER BY ub.ura_batches_id DESC
            LIMIT 1")->result();
            $db_ref_key = '';
            if (!empty($get_ref_last_rec)) {
                $db_ref_key = $get_ref_last_rec[0]->ura_batch_ref;
                $batch_ref_explode = explode('-', $db_ref_key);
                $batch_ref = (int) $batch_ref_explode[3];
                if (!empty($batch_ref)) {
                    $ref_counter = $batch_ref + 1;
                }
            }
            $ref_data = sprintf("%04d", $ref_counter);
            $ref_key = '';
            $batch_name = 'Batch-';
            if (empty($h_letter_first) && empty($h_letter_last)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please Add First and Last Initial First For Batch Reference Key.';
                echo json_encode($json);
                die;
            } else {
                if (!empty($ref_data)) {
                    $ref_key = $h_letter_first . $h_letter_last . '-' . date('y') . '-' . sprintf("%04d", $ref_data);
                    $batch_key = $batch_name . $ref_key;
                    $encode_batch .= '<div class="form-group">';
                    $encode_batch .= '<label for="batch_ref">Batch Reference</label>';
                    $encode_batch .= '<input class="form-control" readonly name="batch_ref" id="batch_ref" value="' . $batch_key . '">';
                    $encode_batch .= '</div>';
                    $json['type'] = 'success';
                    $json['msg'] = 'Batch Reference Key Generated.';
                    $json['batch_key_data'] = $encode_batch;
                    echo json_encode($json);
                    die;
                }
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please Choose The Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Generate Courier List
     *
     * @return void
     */
    public function generate_courier_list() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        $encode_courier = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $courier_list = $this->db->query("SELECT * FROM uralensis_courier WHERE uralensis_courier.ura_courier_hospital_id = $hospital_id")->result();
            if (!empty($courier_list)) {
                $encode_courier .= '<div class="form-group">';
                $encode_courier .= '<label for="batch_courier">Courier</label>';
                $encode_courier .= '<select name="batch_courier" id="batch_courier" class="form-control">';
                $encode_courier .= '<option value="false">Choose Courier</option>';
                foreach ($courier_list as $courier) {
                    $encode_courier .= '<option value="' . $courier->ura_courier_id . '">' . $courier->ura_courier_name . '</option>';
                }
                $encode_courier .= '</select>';
                $encode_courier .= '</div>';
                $json['type'] = 'success';
                $json['msg'] = 'Couriers Found Against selected hospital.';
                $json['batch_courier_data'] = $encode_courier;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Courier Found. Please Add First.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please Choose The Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Display Courier Cost Code 
     *
     * @return void
     */
    public function display_courier_cost_code() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        $encode_cost = '';
        if (isset($_POST) && $_POST['courier_id'] !== 'false') {
            $courier_id = $_POST['courier_id'];
            $courier_cost_code = $this->db->query("SELECT ura_courier_cost_code FROM uralensis_courier WHERE uralensis_courier.ura_courier_id = $courier_id")->result();
            if (!empty($courier_cost_code)) {
                $cost_code = $courier_cost_code[0]->ura_courier_cost_code;
                $encode_cost .= '<div class="form-group">';
                $encode_cost .= '<label for="batch_courier_code">Batch Courier Cost Code</label>';
                $encode_cost .= '<input class="form-control" readonly name="batch_courier_code" id="batch_courier_code" value="' . $cost_code . '">';
                $encode_cost .= '</div>';
            }
            $json['type'] = 'success';
            $json['msg'] = 'Courier Cost Code Found.';
            $json['courier_cost_code'] = $encode_cost;
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please Choose The Courier First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save Batch Data
     *
     * @return void
     */
    public function save_batch_data() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if ($_POST['batch_hospital_id'] === 'false') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Choose The Hospital First.';
            echo json_encode($json);
            die;
        }
        if ($_POST['batch_ref'] === '') {
            $json['type'] = 'error';
            $json['msg'] = 'Batch Ref Key field missed.';
            echo json_encode($json);
            die;
        }
        if ($_POST['batch_courier'] === 'false') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Select Courier Name.';
            echo json_encode($json);
            die;
        }
        if ($_POST['batch_courier_collec_date'] === '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Add the collection date.';
            echo json_encode($json);
            die;
        }
        if ($_POST['batch_courier_tracky_no'] === '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Add Courier Track Number.';
            echo json_encode($json);
            die;
        }
        $batches_data = array(
            'ura_batch_ref' => !empty($_POST['batch_ref']) ? $_POST['batch_ref'] : '',
            'ura_courier_id' => !empty($_POST['batch_courier']) ? $_POST['batch_courier'] : '',
            'ura_batch_hospital_id' => !empty($_POST['batch_hospital_id']) ? $_POST['batch_hospital_id'] : '',
            'ura_courier_collection_date' => !empty($_POST['batch_courier_collec_date']) ? $_POST['batch_courier_collec_date'] : '',
            'ura_courier_tracky_number' => !empty($_POST['batch_courier_tracky_no']) ? $_POST['batch_courier_tracky_no'] : '',
            'ura_courier_cost_code' => !empty($_POST['batch_courier_code']) ? $_POST['batch_courier_code'] : '',
            'ura_batch_timestamp' => time()
        );
        $this->db->insert('uralensis_batches', $batches_data);
        $json['type'] = 'success';
        $json['msg'] = 'Batch Added Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Display Batch Courier Records
     *
     * @return void
     */
    public function display_batch_courier_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        $encode_data = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $batch_couriers_records = $this->Secretary_model->get_batch_couriers_display_record($hospital_id);
            if (!empty($batch_couriers_records)) {
                $encode_data .= '<table id="batch_courier_records_table" class="table table-condensed">';
                $encode_data .= '<thead>';
                $encode_data .= '<tr>';
                $encode_data .= '<th>Batch Ref.</th>';
                $encode_data .= '<th>Courier Name</th>';
                $encode_data .= '<th>Collection Date</th>';
                $encode_data .= '<th>Cost Code</th>';
                $encode_data .= '<th>Created</th>';
                $encode_data .= '<th>&nbsp;</th>';
                $encode_data .= '<th>&nbsp;</th>';
                $encode_data .= '</tr>';
                $encode_data .= '</thead>';
                $encode_data .= '<tbody>';
                foreach ($batch_couriers_records as $batch_rec) {
                    $encode_data .= '<tr>';
                    $encode_data .= '<td>' . $batch_rec->ura_batch_ref . '</td>';
                    $encode_data .= '<td>' . $this->get_courier_name($batch_rec->ura_courier_id) . '</td>';
                    $encode_data .= '<td>' . date('d-m-Y', strtotime($batch_rec->ura_courier_collection_date)) . '</td>';
                    $encode_data .= '<td>' . $batch_rec->ura_courier_cost_code . '</td>';
                    $encode_data .= '<td>' . date('d-m-Y', $batch_rec->ura_batch_timestamp) . '</td>';
                    $encode_data .= '<td><a href="' . base_url('index.php/secretary/edit_batch?batch_id=' . $batch_rec->ura_batches_id . '&hospital_id=' . $batch_rec->ura_batch_hospital_id) . '"><img src="' . base_url('assets/img/edit.png') . '"></a></td>';
                    $encode_data .= '<td><a href="javascript:;" class="delete_batch_courier_id" data-batchcourierid="' . $batch_rec->ura_batches_id . '"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                    $encode_data .= '</tr>';
                }
                $encode_data .= '</tbody>';
                $encode_data .= '</table>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode_data;
                $json['msg'] = 'Following Records Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'You have not added any Batch against the selected hospital.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please Choose The Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete Batch Courier
     *
     * @return void
     */
    public function delete_batch_courier() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['batch_courier_id'])) {
            $batch_courier_id = $_POST['batch_courier_id'];
            $this->db->where('ura_batches_id', $batch_courier_id);
            $this->db->delete('uralensis_batches');
            $this->db->where('ura_clinic_batch_id', $batch_courier_id);
            $this->db->update('uralensis_clinic_dates', array('ura_clinic_batch_id' => NULL));
            $json['type'] = 'success';
            $json['msg'] = 'Batch Deleted Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something wrong while deleting the record.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Get Courier Name with Courier ID
     *
     * @param int $courier_id
     * @return void
     */
    public function get_courier_name($courier_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (!empty($courier_id)) {
            $query = $this->db->query("SELECT ura_courier_name FROM uralensis_courier WHERE uralensis_courier.ura_courier_id = $courier_id")->result();
            return $query[0]->ura_courier_name;
        }
    }

    /**
     * Edit Batch Function
     *
     * @return void
     */
    public function edit_batch() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        $batch_and_courier = array();
        if (isset($_GET) && !empty($_GET['batch_id']) && !empty($_GET['hospital_id'])) {
            $batch_id = $_GET['batch_id'];
            $batch_data['batch_data'] = $this->Secretary_model->get_batch_data($batch_id);
            $hospital_id = $_GET['hospital_id'];
            $courier_list['courier_list'] = $this->db->query("SELECT * FROM uralensis_courier WHERE uralensis_courier.ura_courier_hospital_id = $hospital_id")->result();
            $clinics_list['clinics_list'] = $this->Secretary_model->get_clinic_batches_list($batch_id, $hospital_id);
            $clinics_array = array();
            foreach ($clinics_list['clinics_list'] as $clinics) {
                $clinics_array[] = $clinics->ura_clinic_date_id;
            }
            $record_ids['clinic_record_ids'] = $this->get_clinic_date_records($clinics_array);
            $batch_and_courier = array_merge($batch_data, $courier_list, $clinics_list, $record_ids);
        }

        $this->load->view('secretary/inc/header');
        $this->load->view('secretary/courier/edit_batch', $batch_and_courier);
        $this->load->view('secretary/inc/footer');
    }

    /**
     * Process Edit Batch Fields
     *
     * @return void
     */
    public function process_edit_batch() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (isset($_POST) && !empty($_POST['save_edit_batch'])) {
            $batch_id = $this->input->post('batch_id');
            $hospital_id = $this->input->post('hospital_id');
            $batch_ref = $this->input->post('batch_ref');
            $collection_date = $this->input->post('batch_courier_collec_date');
            $cost_code = $this->input->post('courier_cost_code');
            $bacth_courier = $this->input->post('batch_courier');
            $trach_no = $this->input->post('courier_track_no');
            $collected_by_courier = $this->input->post('batch_collect_by_courier');
            $rec_by_lab = $this->input->post('batch_rec_by_lab');
            $sent_to_admin = $this->input->post('batch_sent_to_admin');
            $rec_by_admin = $this->input->post('batch_rec_by_admin');
            if (!empty($_POST['rec_by_lab_active']) && $_POST['rec_by_lab_active'] === 'rec_by_lab_true') {
                $clinic_record_ids = $_POST['clinic_record_ids'];
                foreach ($clinic_record_ids as $record_ids) {
                    $this->db->where('uralensis_request_id', $record_ids);
                    $this->db->update('request', array('request_code_status' => 'rec_by_lab'));
                }
            }
            $edit_array = array(
                'ura_batch_ref' => $batch_ref,
                'ura_courier_id' => $bacth_courier,
                'ura_courier_collection_date' => $collection_date,
                'ura_courier_tracky_number' => $trach_no,
                'ura_courier_cost_code' => $cost_code,
                'ura_batch_collect_by_courier' => date(strtotime($collected_by_courier)),
                'ura_batch_receive_by_lab' => date(strtotime($rec_by_lab)),
                'ura_batch_sent_to_admin' => date(strtotime($sent_to_admin)),
                'ura_batch_receive_by_admin' => date(strtotime($rec_by_admin)),
            );
            $this->db->where('ura_batches_id', $batch_id)->where('ura_batch_hospital_id', $hospital_id);
            $this->db->update('uralensis_batches', $edit_array);
            $msg = '<div class="alert alert-success">Batch Updated Successfully.</div>';
            $this->session->set_flashdata('batch_update', $msg);
            redirect('secretary/edit_batch?batch_id=' . $batch_id . '&hospital_id=' . $hospital_id);
        }
    }

    /**
     * Get Clinic Dates Records
     *
     * @param array $clinics_array
     * @return void
     */
    public function get_clinic_date_records($clinics_array) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = array();
        if (!empty($secretary_perms)) {
            $sec_perm = unserialize($secretary_perms);
        }
        if (!in_array('sec_can_add_clinic', $sec_perm)) {
            redirect('secretary/forbidden', 'refresh');
        }
        if (!empty($clinics_array)) {
            foreach ($clinics_array as $clinic) {
                $record_ids_array = array();
                $record_query = $this->db->query("SELECT * FROM request WHERE request.clinic_ref_number = $clinic")->result();
                foreach ($record_query as $record_id) {
                    $record_ids_array[] = $record_id->uralensis_request_id;
                }
            }
            return $record_ids_array;
        }
    }

    /**
     * Switch Back User Account To Admin
     *
     * @param int $admin_id
     * @return void
     */
    public function switchUserAccountToAdmin($admin_id) 
    {
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
}
