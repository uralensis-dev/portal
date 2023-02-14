<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Institute extends CI_Controller 
{
  private $group_id = 0;
  private $user_id = 0;
  private $group_type = "";

    /**
     * Constructor to load models and helpers
     */
    public function __construct() {
      parent::__construct();
      $this->load->model('Institute_model');
      $this->load->model('Doctor_model');
	  $this->load->model('PatientModel');
      $this->load->model('Userextramodel');
      $this->load->model('Admin_model');
      $this->load->model('Pm_model');
      $this->load->model('Specialty_model');
      $this->load->model('Huser_model');
      $this->load->library('form_validation');
      $this->load->helper('Permission_helper');
      $this->load->helper('form');

      $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
      $this->load->helper("file");
      $this->load->library('email');

        // $this->load->library('word');
      track_user_activity();
      if (!$this->ion_auth->logged_in()) {
        redirect('/', 'refresh');
      }

      $this->user_id = $this->ion_auth->user()->row()->id;

      $group_row = $this->ion_auth->get_users_groups()->row();
      $this->group_type = $group_row->group_type;
      $this->group_id = $group_row->id;
    }

    /**
     * Redirect if needed, otherwise display the user list
     *
     * @return void
     */
    public function UserList() {
      $user_id = $this->ion_auth->user()->row()->id;
      if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
        $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
      }

      $getparent = getRecords("*", "groups", array("id" => $groups[0]->id));
      $selectuserlist = getRecords("GROUP_CONCAT(user_id) AS users_id", "users_groups_type", array("group_id" => $user_id));
        //echo last_query();exit;
        // if an admin, go to admin area
        //set the flash data error message if there is one
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        //list the users
      $this->data['users'] = $this->ion_auth->users()->result();

      if ($this->input->get("group_id") != "") {
        $group_id = $_GET["group_id"];
      } elseif ($this->input->post('groups') != "") {
        $group_id = $this->input->post('groups');
      } else {
        $group_id = "";
      }
      $this->data["name"] = $this->input->post('name');

      if ($selectuserlist[0]->users_id != "") {
        $this->data['userslist'] = $this->Userextramodel->getAllusersForadmin($group_id, $this->input->post('name'), $this->input->post('status'), $selectuserlist[0]->users_id);
      }


        // echo last_query();exit;
        // echo last_query();exit;
        //debug($this->data['users']);exit;
        // var_dump($this->data['users']);exit;
      foreach ($this->data['users'] as $k => $user) {
        $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
      }
      $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('index.php'));
      $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        // echo "dd";exit;
      track_user_activity();
        //$this->_render_page('templates/header');
        //$this->_render_page('auth/index', $this->data);
        //$this->_render_page('templates/footer');
      $this->load->view('institute/inc/header-new');
      $this->load->view('institute/index-new', $this->data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Dashboard Function
     * Load Dashbord View
     *
     * @return void
     */
    public function index() {
      $user_id = $this->ion_auth->user()->row()->id;
      $isuserAdmin['isuserAdmin'] = getRecords("is_hospital_admin", "users", array('id' => $user_id));
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

      $start_date = '';
      $end_date = '';
      if (isset($_GET['mode']) && $_GET['mode'] === 'period') {
        $start_date = date("Y-m-d", strtotime($_GET['start_date']));
        $end_date = date("Y-m-d", strtotime($_GET['end_date']));
      }
      $published['Doctors'] = $this->Institute_model->count_total_lab($hospital_group_id,'D');
      $published['Lab'] = $this->Institute_model->count_total_users($hospital_group_id,'L');	
      $published['CService'] = $this->Institute_model->count_total_users($hospital_group_id,'CS');
      $published['NService'] = $this->Institute_model->count_total_users($hospital_group_id,'NS');
      $published['Husers'] = $this->Institute_model->count_total_hospital_users($hospital_group_id,'HA');

      $published['HAusers'] = $this->Huser_model->get_hospital_users('63','count');
      $published['CSusers'] = $this->Huser_model->get_hospital_users('33','count');
      $published['Rusers'] = $this->Huser_model->get_hospital_users('45','count');
      $published['HSusers'] = $this->Huser_model->get_hospital_users('14','count');
      $published['CANusers'] = $this->Huser_model->get_hospital_users('15','count');

      $published['medi_div'] = $this->Huser_model->get_divison_user_count('1');
      $published['surgen_div'] = $this->Huser_model->get_divison_user_count('2');
      $published['fam_div'] = $this->Huser_model->get_divison_user_count('3');
      $published['cli_div'] = $this->Huser_model->get_divison_user_count('4');
      $published['division'] = $this->Huser_model->get_division_list();
      

      $published['published'] = $this->Institute_model->status_bar_result_count_published();
      $unpublished['unpublished'] = $this->Institute_model->status_bar_result_count_un_reported();
      $totalreports['totalreports'] = $this->Institute_model->status_bar_result_count_total_reports();
      $new_reports['new_reports'] = $this->Institute_model->status_bar_result_count_new_reports();
      $submitted_reports['submitted_reports'] = $this->Institute_model->status_bar_result_count_submitted_reports();
      $viewed_reports['viewed_reports'] = $this->Institute_model->status_bar_result_count_viewed_reprots();
      $login_records['previous_login'] = $this->Institute_model->previous_login_records();
      $hospital_docs['hospital_docs'] = $this->Institute_model->get_hospital_records_all_documents();
      $clinic_dates['clinic_dates'] = $this->Institute_model->get_hospital_clinic_dates();
      $upload_area['upload_area'] = $this->Institute_model->get_all_current_users_upload_area_docs();
      $cl_doc_upload_area['cl_doc_upload_area'] = $this->Institute_model->get_all_current_users_client_doc_upload_area_docs();
      $hos_tat_rec_data['hos_tat_rec_data'] = $this->Institute_model->get_hospital_records_data_vd_tat($hospital_group_id, $start_date, $end_date);
      $hos_weekdays_tat_rec_data['hos_weekdays_tat_rec_data'] = $this->Institute_model->get_hospital_weekdays_records_data_vd_tat($hospital_group_id);
      $incident_reports['incident_reports'] = $this->Institute_model->getIncidentReports($user_id);
      $decryptedDetails['decryptedDetails'] = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
      $uploads_new_docs['upload_docs'] = $this->Institute_model->get_upload_doc_forms();
      $request_from_to_data['request_from_to'] = $this->Institute_model->get_request_from_to_data();
      $countries_list['countries'] = $this->Institute_model->get_countries();
      $hospital_pathologists['pathologists'] = $this->Institute_model->get_pathologists();
      $data['usersLogins'] = $this->Institute_model->getUsersLogins();
      $hospital_dashboard_data = array_merge(
      
	  $published, $unpublished, $totalreports, $new_reports, $incident_reports, $submitted_reports, $viewed_reports, $login_records, $hospital_docs, $clinic_dates, $upload_area, $cl_doc_upload_area, $hos_tat_rec_data, $hos_weekdays_tat_rec_data, $isuserAdmin, $decryptedDetails, $uploads_new_docs, $request_from_to_data, $countries_list, $hospital_pathologists, $data);
      $h_data = array('styles' => array('css/institute/dashboard.css'));
      $f_data = array('javascripts' => array('js/institute/dashboard.js'));


      $this->load->view('institute/inc/header-new');
      $this->load->view('institute/dashboard', $hospital_dashboard_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Upload SOP Doc Function
     * Return to Dashboard
     *
     * @return void
     */
    public function upload_docs_form() {
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

      if (isset($_FILES['upload_doc']) && $_FILES['upload_doc']['name'] != '') {
        $ref_key = $user_id;
        $upload_doc = $this->do_upload_clinic_files('upload_doc', $ref_key);
        if ($upload_doc === FALSE) {
          $error = array('upload_error' => $this->upload->display_errors());
          $this->session->set_flashdata('upload_error', $error['upload_error']);
          redirect('Institute');
        } else {
          $data = $this->upload->data();
          $checklist_file_name = $data['file_name'];
          $file_path = "clinic_uploads/" . $checklist_file_name;
          $file_type = $this->input->post('file_type');
        }

        if (!empty($checklist_file_name)) {
          $sop_upload_data = array(
            'file_name' => !empty($checklist_file_name) ? $checklist_file_name : '',
            'file_path' => !empty($file_path) ? $file_path : '',
            'file_type' => !empty($file_type) ? $file_type : '',
            'uploaded_by' => !empty($user_id) ? $user_id : '',
            'uploaded_at' => date('Y-m-d H:i:s')
          );
                //                echo '<pre>'; print_r($sop_upload_data); exit;
          $this->db->insert('uralensis_upload_forms', $sop_upload_data);
          $this->session->set_flashdata('upload_success', 'File upload successfully.');
          redirect('Institute');
        }
      }
    }

    public function download_forms($filename) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
        // load download helder
      $this->load->helper('download');
        // read file contents
      $data = file_get_contents(base_url('clinic_uploads/' . $filename));
      force_download($filename, $data);
    }

    /**
     * Delete Record Files
     *
     * @param int $file_id
     * @return void
     */
    public function delete_upload_docs($file_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $record_id = $this->session->userdata('record_id');
      $hospital_id = $this->ion_auth->user()->row()->id;
      if (isset($file_id) && isset($hospital_id)) {
        $get_file_path_query = $this->db->query("SELECT * FROM uralensis_upload_forms WHERE id = $file_id ");
        $get_file_path = $get_file_path_query->result();
        $this->db->query("DELETE FROM uralensis_upload_forms WHERE id = $file_id");
        unlink($get_file_path[0]->file_path);
        $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
        $this->session->set_flashdata('delete_file', $delete_file);
        redirect('institute', 'refresh');
      }
    }

    /**
     * Add Request from and to data
     * Return to Hospital Admin Dashboard
     *
     * @return void
     */
    public function add_request_from_to_data() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $edit_id = $this->input->post('ed_id');
      $ident_name = $this->input->post('identifier_name');
      $ident_type = $this->input->post('identifier_type');
      $req_f_t_data = $this->Institute_model->get_add_req_from_to_exist_name($ident_name, $ident_type);

        //        $json['type'] = 'error';
        //        $json['msg'] = $req_f_t_data;
        //        echo json_encode($json);
        //        die;

      if ($req_f_t_data) {
        $json['type'] = 'error';
        $json['msg'] = 'Identifier name already exists';
        echo json_encode($json);
        die;
      }
      $add_req_data = array();
      if (isset($_FILES['identifier_logo']) && $_FILES['identifier_logo']['name'] != '') {
        $ref_key = $user_id;
        $upload_doc = $this->do_upload_request_logo('identifier_logo', $ref_key);
        if ($upload_doc === FALSE) {
          $error = array('upload_error' => $this->upload->display_errors());
          $this->session->set_flashdata('upload_error', $error['upload_error']);
          redirect('Institute');
        } else {
          $data = $this->upload->data();
          $checklist_file_name = $data['file_name'];
          $file_path = "uploads/" . $checklist_file_name;
        }

        if (!empty($checklist_file_name)) {
          $add_req_data['identifier_logo'] = !empty($file_path) ? $file_path : '';
        }
      }
      $add_req_data['identifier_name'] = $this->input->post('identifier_name');
      $add_req_data['identifier_contact'] = $this->input->post('identifier_contact');
      $add_req_data['identifier_email'] = $this->input->post('identifier_email');
      $add_req_data['identifier_address'] = $this->input->post('identifier_address');
      $add_req_data['identifier_post_code'] = $this->input->post('identifier_post_code');
      $add_req_data['identifier_city'] = $this->input->post('identifier_city');
      $add_req_data['identifier_country'] = $this->input->post('identifier_country');
      $add_req_data['identifier_type'] = !empty($ident_type) ? $ident_type : '';
      $add_req_data['created_by'] = !empty($user_id) ? $user_id : '';
      $add_req_data['created_at'] = date('Y-m-d H:i:s');

      $this->db->insert('request_from_to_detail', $add_req_data);

      $json['type'] = 'success';
      $json['msg'] = 'Data added successfully';
      echo json_encode($json);
      die;
    }

    /**
     * Edit Request from and to data
     * Return to Hospital Admin Dashboard
     *
     * @return void
     */
    public function edit_request_from_to_data() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $edit_id = $this->input->post('ed_id');
      $ident_name = $this->input->post('identifier_name');
      $ident_type = $this->input->post('identifier_type');
      $req_f_t_data = $this->Institute_model->get_ed_req_from_to_exist_name($edit_id, $ident_name, $ident_type);
      if ($req_f_t_data) {
        $json['type'] = 'error';
        $json['msg'] = 'Identifier name already exists';
        echo json_encode($json);
        die;
      }

      $edit_req_data = array();
      if (isset($_FILES['identifier_logo']) && $_FILES['identifier_logo']['name'] != '') {

        $ref_key = $user_id;
        $upload_doc = $this->do_upload_request_logo('identifier_logo', $ref_key);
        if ($upload_doc === FALSE) {
          $error = array('upload_error' => $this->upload->display_errors());
          $this->session->set_flashdata('upload_error', $error['upload_error']);
          redirect('Institute');
        } else {
          $data = $this->upload->data();
          $checklist_file_name = $data['file_name'];
          $file_path = "uploads/" . $checklist_file_name;
          $existing_logo = $this->input->post('existing_identifier_logo');
          unlink($existing_logo);
        }
        if (!empty($checklist_file_name)) {

          $edit_req_data['identifier_logo'] = !empty($file_path) ? $file_path : '';
        }
      }
      $edit_req_data['identifier_name'] = $this->input->post('identifier_name');
      $edit_req_data['identifier_contact'] = $this->input->post('identifier_contact');
      $edit_req_data['identifier_email'] = $this->input->post('identifier_email');
      $edit_req_data['identifier_address'] = $this->input->post('identifier_address');
      $edit_req_data['identifier_post_code'] = $this->input->post('identifier_post_code');
      $edit_req_data['identifier_city'] = $this->input->post('identifier_city');
      $edit_req_data['identifier_country'] = $this->input->post('identifier_country');
      $edit_req_data['identifier_type'] = !empty($ident_type) ? $ident_type : '';
      $edit_req_data['created_by'] = !empty($user_id) ? $user_id : '';
      $edit_req_data['created_at'] = date('Y-m-d H:i:s');

        //                echo '<pre>'; print_r($edit_req_data); exit;
      $this->db->where('id', $edit_id);
      $this->db->update('request_from_to_detail', $edit_req_data);

      $json['type'] = 'success';
      $json['data'] = $edit_req_data;
      $json['msg'] = 'Data updated successfully';
      echo json_encode($json);
      die;
    }

    /**
     * Delete Request From To Record
     *
     * @return void
     */
    public function delete_request_from_to($id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }

      $json = array();
      if (isset($_POST)) {
        $delete_id = $id;

        $req_from_to_data = $this->Institute_model->get_request_from_to_by_id($id);
        if ($req_from_to_data) {
          $logo_path = $req_from_to_data[0]['identifier_logo'];
          if (!empty($logo_path)) {
            unlink($logo_path);
          }
        }

        $this->db->where('id', $delete_id);
        $this->db->delete('request_from_to_detail');

        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Deleted.</div>';
        redirect('institute');
      }
    }

    /**
     * Show Request Form View
     *
     * @return void
     */
    public function show_requestform() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_requestform')) {
        
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $clinician['hospital_clinician'] = $this->Institute_model->get_hospital_clinician($hospital_group_id);
      $surgeon['hospital_surgeon'] = $this->Institute_model->get_hospital_dermatological_surgeon($hospital_group_id);
      $hospital_data = array_merge($clinician, $surgeon);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/institute_add_request', $hospital_data);
      $this->load->view('institute/inc/footer-new');
    }
	
	  public function Hview() 
	{
      if (!$this->ion_auth->logged_in()) 
	  {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_requestform')) {
       // 
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $clinician['hospital_clinician'] = $this->Institute_model->get_hospital_clinician($hospital_group_id);


      $uDetails = get_usergroup_tyep_cate($user_id);      
        // $thislinked = get_related_hospital($uDetails['user_id'],$uDetails['groupid'],$uDetails['group_type'],$uDetails['type_cate']);
        if(!empty($uDetails) && $uDetails['group_type']!='A'){
          $hospital_data['hos_info'] = get_user_related_lab_hospital($uDetails['user_id'],$uDetails['groupid'],$uDetails['group_type'],$uDetails['type_cate']);
        }else{
          $hospital_data['hos_info'] = $this->Institute_model->get_allhos_information(0);
        }
         // echo "<pre>";
        // print_r($uDetails);die;
        // print_r($rest);die;

	  
      // $hospital_data['hos_info'] = $this->Institute_model->get_allhos_information(0);
      
	 // $hospital_data = array_merge($clinician, $surgeon);
	  
      $this->load->view('templates/header-new');
      $this->load->view('institute/hospital_view', $hospital_data);
      $this->load->view('templates/footer-new');
    }

    /**
     * Add Institute function
     *
     * @return void
     */
    public function add_institute() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('add_institute')) {
        
      }
      $this->form_validation->set_rules('emis_number', 'Emis Number', 'required');
      $this->form_validation->set_rules('clinic_reference', 'Clinic Reference', 'required');
      $this->form_validation->set_rules('patient_initial', 'Patient Initial', 'required');
      $this->form_validation->set_rules('pci_no', 'PCI Number', 'required');
      $this->form_validation->set_rules('nhs_number', 'Nhs Number', 'required');
      $this->form_validation->set_rules('lab_number', 'Lab Number', 'required');
      $this->form_validation->set_rules('sur_name', 'SurName', 'required');
      $this->form_validation->set_rules('first_name', 'First Name', 'required');
      $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
      $this->form_validation->set_rules('gender', 'Gender', 'required');
      $this->form_validation->set_rules('date_taken', 'Date Taken', 'required');
      $this->form_validation->set_rules('cl_detail', 'Clinical Detail', 'required');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('institute/inc/header');
        $this->load->view('institute/institute_add_request');
        $this->load->view('institute/inc/footer-new');
      } else {
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
        } else if ($serial_query->num_rows() < 0) {
          $key = 'PB-' . date('y') . '-1';
        } else {
          $key = 'PB-' . date('y') . '-1';
        }
        $request = array(
          'serial_number' => $key,
          'emis_number' => $this->input->post('emis_number'),
          'nhs_number' => str_replace(' ', '', $this->input->post('nhs_number')),
          'patient_initial' => $this->input->post('patient_initial'),
          'pci_number' => $this->input->post('pci_no'),
          'lab_number' => $this->input->post('lab_number'),
          'sur_name' => $this->input->post('sur_name'),
          'f_name' => $this->input->post('first_name'),
          'dob' => !empty($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '',
          'lab_name' => $this->input->post('lab_name'),
          'date_received_bylab' => !empty($this->input->post('date_received_bylab')) ? date('Y-m-d', strtotime($this->input->post('date_received_bylab'))) : '',
          'date_sent_touralensis' => !empty($this->input->post('date_sent_touralensis')) ? date('Y-m-d', strtotime($this->input->post('date_sent_touralensis'))) : '',
          'gender' => $this->input->post('gender'),
          'clrk' => $this->input->post('clrk'),
          'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
          'date_taken' => !empty($this->input->post('date_taken')) ? date('Y-m-d', strtotime($this->input->post('date_taken'))) : '',
          'urgent' => $this->input->post('urgent'),
          'hsc' => $this->input->post('hsc'),
          'report_urgency' => $this->input->post('report_urgency'),
          'cl_detail' => $this->input->post('cl_detail'),
          'status' => 0,
          'cases_category' => $this->input->post('cases_category'),
          'clinic_ref_number' => $this->input->post('clinic_reference_id'),
          'clinic_request_form' => $this->input->post('request_form'),
        );
        $this->Institute_model->institute_insert($request);
        $this->Institute_model->request_assign();
        $req_id = $this->session->userdata('id');
        $hospital_id_request = $this->ion_auth->user()->row()->id;
        $hospital_group_id_request = $this->ion_auth->get_users_groups($hospital_id_request)->row()->id;
        $hospital_request_data = array('hospital_group_id' => $hospital_group_id_request);
        $this->db->where('uralensis_request_id', $req_id);
        $this->db->update('request', $hospital_request_data);
        $user_id = $this->ion_auth->user()->row()->id;
        $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $add_hospital_group_id = array('group_id' => $group_id);
        $this->db->where('request_id', $req_id);
        $this->db->update('users_request', $add_hospital_group_id);
        $user_add_data = array(
          'request_add_user' => $user_id,
          'request_add_user_timestamp' => time()
        );
        $this->db->where('uralensis_request_id', $req_id);
        $this->db->update('request', $user_add_data);
        $this->session->set_flashdata('message', 'Request Submitted.');
        $msg = '<p class="bg-info" style="padding: 7px;">Request Submitted, Please Add Specimen Below.</p>';
        $this->session->set_flashdata('message2', $msg);
        redirect('Institute/show_specimen');
      }
    }

    /**
     * Show Specimen View
     *
     * @return void
     */
    public function show_specimen() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_specimen')) {
        
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($hospital_id)->row()->id;
      $get_cost_codes['cost_codes'] = $this->Institute_model->get_cost_codes_by_block($hospital_group_id);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/specimen', $get_cost_codes);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Add Specimen Function
     *
     * @return void
     */
    public function add_specimen() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('add_specimen')) {
        
      }
      $last_row_id = $this->session->userdata('id');
      $specimen = array(
        'request_id' => $last_row_id,
        'specimen_site' => $this->input->post('specimen_site'),
        'specimen_procedure' => $this->input->post('specimen_procedure'),
        'specimen_type' => $this->input->post('specimen_type'),
        'specimen_block' => $this->input->post('specimen_block'),
        'specimen_slides' => $this->input->post('specimen_slides'),
        'specimen_block_type' => $this->input->post('specimen_block_type'),
        'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
        'specimen_rcpath_code' => $this->input->post('rcpath_code'),
        'specimen_diagnosis_description' => $this->input->post('specimen_diagnosis'),
        'specimen_cancer_register' => $this->input->post('specimen_cancer_register'),
      );
      $this->Institute_model->insert_specimen($specimen);
      $this->Institute_model->request_specimen_add();
      $specimen_message = '<p class="bg-info" style="padding:7px;">Specimen Added.</p>';
      $this->session->set_flashdata('message3', $specimen_message);
      redirect('Institute/show_specimen');
    }

    /**
     * Finish Specimen
     *
     * @return void
     */
    public function finish_specimen() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      redirect('Institute/index');
      redirect('Institute/index');
      redirect('Institute/index');
    }

    /**
     * View Request detail view
     *
     * @return void
     */
    public function view_request_detailall() 
    {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }

      $data["query"] = $this->Institute_model->view_final_record();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/request_view_recored', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * View Single Record
     *
     * @param int $id
     * @return void
     */
    public function view_singlerecord($id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $user_id = $this->ion_auth->user()->row()->id;
      if (isset($id) && !empty($id)) {
        $hospital_group_id = $this->ion_auth->get_users_groups()->row()->id;
        $data1['query1'] = $this->Institute_model->request_singlerecord($id);
        $data2['query2'] = $this->Institute_model->request_singlerecord_specimen($id);
        $data3['files'] = $this->Institute_model->fetch_files_data($id);
        $mdt_cats['mdt_cats'] = $this->Institute_model->get_mdt_cases_model($hospital_group_id);
        $download_history['download_history'] = $this->Institute_model->getRecordDownloadHistory($id, $user_id);
        $result = array_merge($data1, $data2, $data3, $mdt_cats, $download_history);
        require_once('application/views/institute/inc/functions.php');
        $this->load->view('institute/inc/header');
        $this->load->view('institute/view_single_record', $result);
        $this->load->view('institute/inc/footer-new');
      }
    }

    /**
     * View Published Records.
     *
     * @param int $id
     * @return void
     */
    public function view_single_final($id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $exclude_user_request_viewed = $this->ion_auth->user()->row()->exclude_user_request_viewed;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      if (!empty($exclude_user_request_viewed) && $exclude_user_request_viewed === 'on' && !is_null($exclude_user_request_viewed)) {
        $data = array(
          'request_viewed_id' => $id,
          'user_viewed_id' => $user_id,
          'user_group_id' => $hospital_group_id,
          'request_view_status' => 'TRUE',
          'timestamp' => time()
        );
        $this->db->insert('request_viewed', $data);
      } else {
            //Get all users from same hospital group.
        $hospital_users_list = $this->db->select('user_id')->where('group_id', $hospital_group_id)->get('users_groups')->result_array();
        if (!empty($hospital_users_list)) {
          foreach ($hospital_users_list as $key => $val) {
            if (!empty($val['user_id'])) {
              $data = array(
                'request_viewed_id' => $id,
                'user_viewed_id' => $val['user_id'],
                'user_group_id' => $hospital_group_id,
                'request_view_status' => 'TRUE',
                'timestamp' => time()
              );
              $this->db->insert('request_viewed', $data);
            }
          }
        }
      }
      $status = array('publish_status' => 0);
      $this->db->where('uralensis_request_id', $id);
      $this->db->update('request', $status);
      $data1['query1'] = $this->Institute_model->doctor_record_detail($id);
        //echo last_query();exit;
      $data2['query2'] = $this->Institute_model->doctor_record_detail_specimen($id);
      $data3['query4'] = $this->Institute_model->get_additional_work($id);
      $data4['query5'] = $this->Institute_model->get_hospital_info($id);
      $result = array_merge($data1, $data2, $data3, $data4);
      $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $record_group_data = $this->db->query(
        "SELECT * FROM groups
        INNER JOIN users_request
        INNER JOIN request
        WHERE groups.id = $group_id
        AND request.uralensis_request_id = users_request.request_id
        AND users_request.group_id = groups.id
        AND request.uralensis_request_id = $id LIMIT 1"
      )->num_rows();
      if ($record_group_data > 0) {
        $this->load->view('institute/view-pdf', $result);
      } else {
        echo 'Restricted';
      }
    }

    /**
     * Download PDF function
     *
     * @param int $id
     * @return void
     */
    public function download_pdf($id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $user_id = $this->ion_auth->user()->row()->id;
        //Check User Settings if User is Excluded From Record Viewed Set.
      $exclude_user_request_viewed = $this->ion_auth->user()->row()->exclude_user_request_viewed;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        //If User exclude from request viewed.
      if (!empty($exclude_user_request_viewed) && $exclude_user_request_viewed === 'on' && !is_null($exclude_user_request_viewed)) {
        $data = array(
          'request_viewed_id' => $id,
          'user_viewed_id' => $user_id,
          'user_group_id' => $hospital_group_id,
          'request_view_status' => 'TRUE',
          'timestamp' => time()
        );
        $this->db->insert('request_viewed', $data);
      } else {
            //Get all users from same hospital group.
        $hospital_users_list = $this->db->select('user_id')->where('group_id', $hospital_group_id)->get('users_groups')->result_array();
        if (!empty($hospital_users_list)) {
          foreach ($hospital_users_list as $key => $val) {
            if (!empty($val['user_id'])) {
              $data = array(
                'request_viewed_id' => $id,
                'user_viewed_id' => $val['user_id'],
                'user_group_id' => $hospital_group_id,
                'request_view_status' => 'TRUE',
                'timestamp' => time()
              );
              $this->db->insert('request_viewed', $data);
            }
          }
        }
      }
      $status = array('publish_status' => 0);
      $this->db->where('uralensis_request_id', $id);
      $this->db->update('request', $status);
      $data1['query1'] = $this->Institute_model->doctor_record_detail($id);
      $data2['query2'] = $this->Institute_model->doctor_record_detail_specimen($id);
      $data3['query4'] = $this->Institute_model->get_additional_work($id);
      $data4['query5'] = $this->Institute_model->get_hospital_info($id);
      $result = array_merge($data1, $data2, $data3, $data4);
      $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $record_group_data = $this->db->query("SELECT * FROM groups INNER JOIN users_request INNER JOIN request WHERE groups.id = $group_id AND request.uralensis_request_id = users_request.request_id
        AND users_request.group_id = groups.id AND request.uralensis_request_id = $id LIMIT 1")->row();

      if (count($record_group_data) > 0) {
        $this->load->view('institute/download-pdf', $result);
      } else {
        echo 'Restricted';
      }
    }

    /**
     * Furtherwork Display
     *
     * @return void
     */
    public function further_display_work() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('further_display_work')) {
        //
      }
      $data['query'] = $this->Institute_model->further_view();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/display_further_work', $data);
      $this->load->view('institute/inc/footer');
    }

    /**
     * Search Request
     *
     * @return void
     */
    public function search_request() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('search_request')) {
        
      }
      $emis_no = $this->input->post('emis_no');
      $nhs_no = $this->input->post('nhs_no');
      $f_name = $this->input->post('f_name');
      $l_name = $this->input->post('l_name');
      $lab_no = $this->input->post('lab_no');
      $user_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $data['query'] = $this->Institute_model->get_search_request($emis_no, $nhs_no, $f_name, $l_name, $lab_no, $group_id);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/search_result', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Publish Reports
     *
     * @return void
     */
    public function published_reports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('new_case')) {
        //
      }
      $data["query"] = $this->Institute_model->institute_record_published();



      $this->load->view('institute/inc/header');
      $this->load->view('institute/record_latest', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Published Report Ajax Processing
     * using datatables
     *
     * @return void
     */
    public function published_reports_ajax_load() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $list = $this->Institute_model->display_published_records();
      $data = array();
      $flag_count = 11;
      foreach ($list as $record) {
        $row_code = '';
        if (!empty($record->request_code_status) && $record->request_code_status === 'new') {
          $row_code = 'row_yellow';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'rec_by_lab') {
          $row_code = 'row_orange';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'pci_added') {
          $row_code = 'row_purple';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'assign_doctor') {
          $row_code = 'row_green';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'micro_add') {
          $row_code = 'row_skyblue';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'add_to_authorize') {
          $row_code = 'row_blue';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'furtherwork_add') {
          $row_code = 'row_brown';
        } else if (!empty($record->request_code_status) && $record->request_code_status === 'record_publish') {
          $row_code = 'row_white';
        }
        $urgency_class = '';
        $urgency_title = '';
        if (!empty($record->report_urgency) && $record->report_urgency === 'Urgent') {
          $urgency_class = 'lnr lnr-star';
          $urgency_title = 'Urgent';
        } else if (!empty($record->report_urgency) && $record->report_urgency === '2WW') {
          $urgency_class = 'lnr lnr-heart';
          $urgency_title = '2WW';
        } else {
          $urgency_class = 'lnr lnr-sync';
          $urgency_title = 'Routine';
        }
        $dob = '';
        if (!empty($record->dob)) {
          $dob = date('d-m-Y', strtotime($record->dob));
        }
        $lab_release_date = '';
        if (!empty($record->date_received_bylab)) {
          $lab_release_date = date('d-m-Y', strtotime($record->date_received_bylab));
        }
        $batch_no = '';
        if (!empty($record->record_batch_id)) {
          $batch_no = $record->record_batch_id;
        }
        $assign_status = '<span style="color:green;" data-toggle="tooltip" data-placement="top" title="Completed."> <img src="' . base_url('assets/img/completed.png') . '"> </span>';
        if ($record->status == 0) {
          $assign_status = '<span data-toggle="tooltip" data-placement="top" title="In Progress."> <img src="' . base_url('assets/img/fail.gif') . '"></span>';
        }
        $publish_status = 'Not Published';
        if ($record->specimen_publish_status == 1) {
          $publish_status = '<a target="_blank" href="' . site_url('Institute/view_single_final/' . $record->uralensis_request_id) . '"><img src="' . base_url('assets/img/view.png') . '">&nbsp;View</a>';
        }
        $publish_status_download = 'Not Published';
        if ($record->specimen_publish_status == 1) {
          $publish_status_download = '<a  href="' . site_url('Institute/download_pdf/' . $record->uralensis_request_id) . '"><img src="' . base_url('assets/img/download.png') . '">Download</a>';
        }
        $f_initial = '';
        $l_initial = '';
        if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->first_initial)) {
          $f_initial = $this->ion_auth->group($record->hospital_group_id)->row()->first_initial;
        }
        if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->last_initial)) {
          $l_initial = $this->ion_auth->group($record->hospital_group_id)->row()->last_initial;
        }
        $hospital_initial = '<a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="' . $this->ion_auth->group($record->hospital_group_id)->row()->description . '" href="javascript:;" >' . $f_initial . ' ' . $l_initial . '</a>';
        $row = array();
        $row[] = '<input type="checkbox" class="bulk_report_generate" name="bulk_report_generate[]" value="' . $record->uralensis_request_id . '">';
        $row[] = $record->serial_number . '<br />' . $record->ura_barcode_no;
        $row[] = $hospital_initial;
        $row[] = $batch_no . '<br>' . $record->pci_number;
        $row[] = $record->f_name . '<br>' . $record->sur_name;
        $row[] = $record->nhs_number . '<br>' . $dob;
        $row[] = $record->lab_number . '<br>' . $record->emis_number;
        $row[] = '<i class="' . $urgency_class . '" data-toggle="tooltip" data-placement="top" title="' . $urgency_title . '" style="font-size:18px;"></i>';
        $row[] = '<a href="' . site_url() . '/Institute/view_single_published/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/detail.png') . '"></a>';
        $row[] = $assign_status;
        $row[] = $publish_status;
        $row[] = $publish_status_download;
        $row[] = '<a href="' . site_url() . '/institute/institute_download_section/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/adobe.png') . '" />&nbsp; Docs</a>';
        $data[] = $row;
        $flag_count++;
      }
      $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => intval($this->Institute_model->published_record_count_all()),
        "recordsFiltered" => intval($this->Institute_model->published_record_count_filtered()),
        "data" => $data,
      );
      echo json_encode($output);
    }

    /**
     * View Single Published
     *
     * @param int $id
     * @return void
     */
    public function view_single_published($id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('new_case')) {
        
      }
      $user_id = $this->ion_auth->user()->row()->id;
      if (isset($id) && !empty($id)) {
        $hospital_group_id = $this->ion_auth->get_users_groups()->row()->id;
        $data1['query1'] = $this->Institute_model->request_singlerecord($id);
        $data2['query2'] = $this->Institute_model->request_singlerecord_specimen($id);
        $data3['files'] = $this->Institute_model->fetch_files_data($id);
        $mdt_cats['mdt_cats'] = $this->Institute_model->get_mdt_cases_model($hospital_group_id);
        $download_history['download_history'] = $this->Institute_model->getRecordDownloadHistory($id, $user_id);
        $result = array_merge($data1, $data2, $data3, $mdt_cats, $download_history);
        $user_id = $this->ion_auth->user()->row()->id;
        $data = array(
          'request_viewed_id' => $id,
          'user_viewed_id' => $user_id,
          'request_view_status' => 'TRUE'
        );
        $this->db->insert('request_viewed', $data);
        $status = array('publish_status' => 0);
        $this->db->where('uralensis_request_id', $id);
        $this->db->update('request', $status);
        require_once('application/views/institute/inc/functions.php');
        $this->load->view('institute/inc/header');
        $this->load->view('institute/view_single_record', $result);
        $this->load->view('institute/inc/footer-new');
      }
    }

    /**
     * Viewed Reports View
     *
     * @return void
     */
    public function viewed_reports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/viewed_reports');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Viewes Reports Ajax Processing
     *
     * @return void
     */
    public function viewed_reports_ajax_load() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $url_year = '';
      if (!empty($_POST['year'])) {
        $url_year = $_POST['year'];
      }
      $list = $this->Institute_model->display_viewed_records($url_year);
      $data = array();
      $flag_count = 11;
      foreach ($list as $record) {
        $assign_status = '<span style="color:green;"> <img src="' . base_url('assets/img/completed.png') . '"> </span>';
        if ($record->status == 0) {
          $assign_status = '<span>In Progress <img src="' . base_url('assets/img/fail.gif') . '"></span>';
        }
        $publish_status = 'Not Published';
        if ($record->specimen_publish_status == 1) {
          $publish_status = '<a target="_blank" href="' . site_url('Institute/view_single_final/' . $record->uralensis_request_id) . '"><img src="' . base_url('assets/img/view.png') . '">&nbsp;View</a>';
        }
        $publish_status_download = 'Not Published';
        if ($record->specimen_publish_status == 1) {
          $publish_status_download = '<a download href="' . site_url('Institute/download_pdf/' . $record->uralensis_request_id) . '"><img src="' . base_url('assets/img/download.png') . '">Download</a>';
        }
        $row = array();
        $row[] = '<input type="checkbox" class="bulk_report_generate" name="bulk_report_generate[]" value="' . $record->uralensis_request_id . '">';
        $row[] = '<strong>' . $record->serial_number . '</strong>';
        $row[] = $record->ura_barcode_no;
        $row[] = $record->f_name;
        $row[] = $record->sur_name;
        $row[] = $record->emis_number;
        $row[] = $record->nhs_number;
        $row[] = $record->lab_number;
        $row[] = $record->gender;
        $row[] = $record->request_datetime;
        $row[] = '<a href="' . site_url() . '/Institute/view_singlerecord/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/detail.png') . '"></a>';
        $row[] = $assign_status;
        $row[] = $publish_status;
        $row[] = $publish_status_download;
        $row[] = '<a href="' . site_url() . '/institute/institute_download_section/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/adobe.png') . '" />&nbsp; Docs</a>';
        $data[] = $row;
        $flag_count++;
      }
      $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => intval($this->Institute_model->viewed_record_count_all()),
        "recordsFiltered" => intval($this->Institute_model->viewed_record_count_filtered($url_year)),
        "data" => $data,
      );
      echo json_encode($output);
    }

    /**
     * Viewed Reports
     *
     * @return void
     */
    public function viewed_reports_17() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $data["query"] = $this->Institute_model->institute_record_viewed_17();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/viewed_reports', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Viewed Reports
     *
     * @return void
     */
    public function viewed_reports_16() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $data["query"] = $this->Institute_model->institute_record_viewed_16();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/viewed_reports', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Viewed Reports
     *
     * @return void
     */
    public function viewed_reports_15() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        
      }
      $data["query"] = $this->Institute_model->institute_record_viewed_15();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/viewed_reports_15', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Download Section View
     *
     * @param int $id
     * @return void
     */
    public function institute_download_section($id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('view_case')) {
        //
      }
      $session_data = array(
        'record_id' => $id
      );
      $this->session->set_userdata($session_data);
      $record_id = $this->session->userdata('record_id');
      $files_data["files"] = $this->Institute_model->fetch_files_data($record_id);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/download_section', $files_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Do Upload Function
     *
     * @param int $record_id
     * @return void
     */
    public function do_upload($record_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('do_upload')) {
        
      }
      if (isset($record_id) && !empty($record_id)) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '9000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
          $error = array('error' => '<p class="bg-danger" style="padding:7px;">' . $this->upload->display_errors() . '</p>');
          $this->session->set_flashdata('upload_error', $error['error']);
          redirect('institute/view_singlerecord/' . $record_id, 'refresh');
        } else {
          $user = $this->ion_auth->user()->row()->username;
          $hospital_id = $this->ion_auth->user()->row()->id;
          $data = $this->upload->data();
          $this->Institute_model->update_file(
            $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $hospital_id, $user, $record_id
          );
          $uplaod_success = '<p class="bg-success" style="padding:7px;">File Successfully Uploaded.</p>';
          $this->session->set_flashdata('upload_success', $uplaod_success);
          redirect('institute/view_singlerecord/' . $record_id, 'refresh');
        }
      }
    }

    /**
     * Download Uploaded Files
     *
     * @param int $record_id
     * @return void
     */
    public function do_upload_download_section_files($record_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('do_upload_download_section_files')) {
        
      }
      if (isset($record_id) && !empty($record_id)) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '9000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
          $error = array('error' => '<p class="bg-danger" style="padding:7px;">' . $this->upload->display_errors() . '</p>');
          $this->session->set_flashdata('upload_error', $error['error']);
          redirect('institute/institute_download_section/' . $record_id, 'refresh');
        } else {
          $user = $this->ion_auth->user()->row()->username;
          $hospital_id = $this->ion_auth->user()->row()->id;
          $data = $this->upload->data();
          $this->Institute_model->update_file(
            $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $hospital_id, $user, $record_id
          );
          $uplaod_success = '<p class="bg-success" style="padding:7px;">File Successfully Uploaded.</p>';
          $this->session->set_flashdata('upload_success', $uplaod_success);
          redirect('institute/institute_download_section/' . $record_id, 'refresh');
        }
      }
    }

    /**
     * Delete Record Files
     *
     * @param int $file_id
     * @return void
     */
    public function delete_record_files($file_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('delete_record_files')) {
        
      }
      $record_id = $this->session->userdata('record_id');
      $hospital_id = $this->ion_auth->user()->row()->id;
      if (isset($file_id) && isset($hospital_id) && isset($record_id)) {
        $get_file_path_query = $this->db->query("SELECT * FROM files WHERE files_id = $file_id AND user_id = $hospital_id ORDER BY files_id");
        $get_file_path = $get_file_path_query->result();
        $this->db->query("DELETE FROM files WHERE files_id = $file_id AND user_id = $hospital_id ORDER BY files_id");
        unlink($get_file_path[0]->file_path);
        $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
        $this->session->set_flashdata('delete_file', $delete_file);
        redirect('institute/view_singlerecord/' . $record_id, 'refresh');
      }
    }

    /**
     * Delete Download Section Files
     *
     * @param int $file_id
     * @return void
     */
    public function delete_download_section_files($file_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('delete_download_section_files')) {
        
      }
      $record_id = $this->session->userdata('record_id');
      $hospital_id = $this->ion_auth->user()->row()->id;
      if (isset($file_id) && isset($hospital_id) && isset($record_id)) {
        $get_file_path_query = $this->db->query("SELECT * FROM files WHERE files_id = $file_id AND user_id = $hospital_id ORDER BY files_id");
        $get_file_path = $get_file_path_query->result();
        $this->db->query("DELETE FROM files WHERE files_id = $file_id AND user_id = $hospital_id ORDER BY files_id");
        unlink($get_file_path[0]->file_path);
        $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
        $this->session->set_flashdata('delete_file', $delete_file);
        redirect('institute/institute_download_section/' . $record_id, 'refresh');
      }
    }

    /**
     * Upload Center Function
     *
     * @return void
     */
    public function upload_center() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('upload_center')) {
        
      }
      $request_form_assignee['requestforms_assignee'] = $this->Institute_model->get_upc_requestforms_assignee();
      $checklist_form_assignee['checlistforms_assignee'] = $this->Institute_model->get_upc_checklistforms_assignee();
      $request_form['requestforms'] = $this->Institute_model->get_upc_requestforms();
      $checklist_form['checlistforms'] = $this->Institute_model->get_upc_checklistforms();
      $upc_files_data = array_merge($request_form_assignee, $checklist_form_assignee, $request_form, $checklist_form);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/hospital_uplaod_center', $upc_files_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Upload Request Form Files
     *
     * @return void
     */
    public function upload_center_request_form() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('upload_center_request_form')) {
        
      }
      $hospital_user_id = $this->ion_auth->user()->row()->id;
      if (isset($_POST['request_form'])) {
        $config['upload_path'] = './uplaod_center/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_center_requestform')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('upload_error', $error['error']);
          redirect('Institute/upload_center/', 'refresh');
        } else {
          $data = $this->upload->data();
          $this->Institute_model->upload_center_form_model(
            $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $_POST['request_form'], 'rf', $hospital_user_id
          );
          $uplaod_success = '<p class="bg-success" style="padding:7px;">' . $_POST['request_form'] . ' Successfully Uploaded.</p>';
          $this->session->set_flashdata('upload_success', $uplaod_success);
          redirect('Institute/upload_center/', 'refresh');
        }
      }
    }

    /**
     * Upload Checklist Form Files
     *
     * @return void
     */
    public function upload_center_checklist_form() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('upload_center_checklist_form')) {
        
      }
      $hospital_user_id = $this->ion_auth->user()->row()->id;
      if (isset($_POST['checklist_form'])) {
        $config['upload_path'] = './uplaod_center/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_center_checklist')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('upload_error', $error['error']);
          redirect('Institute/upload_center/', 'refresh');
        } else {
          $data = $this->upload->data();
          $this->Institute_model->upload_center_form_model(
            $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $_POST['checklist_form'], 'cf', $hospital_user_id
          );
          $uplaod_success = '<p class="bg-success" style="padding:7px;">' . $_POST['checklist_form'] . ' Successfully Uploaded.</p>';
          $this->session->set_flashdata('upload_success', $uplaod_success);
          redirect('Institute/upload_center/', 'refresh');
        }
      }
    }

    /**
     * Delete Uploaded Checklist Files
     *
     * @param int $files_id
     * @return void
     */
    public function delete_upc_files($files_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('delete_upc_files')) {
        
      }
      $this->db->query("DELETE FROM uralensis_uplaod_center WHERE upc_file_id = $files_id");
      redirect('Institute/upload_center/', 'refresh');
    }

    /**
     * Teaching Cases
     *
     * @return void
     */
    public function teaching_cases() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('teaching_cases')) {
        
      }
      $data["query"] = $this->Institute_model->teaching_cases();
      $this->load->view('institute/inc/header');
      $this->load->view('institute/teaching_cases', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * MDT Cases View
     *
     * @return void
     */
    public function mdt_cases() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('mdt')) {
        
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($hospital_id)->row()->id;
      $get_mdt_dates['coming_mdt'] = $this->Institute_model->get_all_mdt_dates($hospital_group_id);
      $prev_mdt_dates['prev_mdt'] = $this->Institute_model->get_previous_all_mdt_dates($hospital_group_id);
      $mdt_result = array_merge($get_mdt_dates, $prev_mdt_dates);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/mdt_cases', $mdt_result);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * MDT Cases New View
     *
     * @return void
     */
    public function mdt_cases_new() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('mdt')) {
        
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($hospital_id)->row()->id;
      $get_mdt_dates['coming_mdt'] = $this->Institute_model->get_all_mdt_dates($hospital_group_id);
      $prev_mdt_dates['prev_mdt'] = $this->Institute_model->get_previous_all_mdt_dates($hospital_group_id);
      $mdt_result = array_merge($get_mdt_dates, $prev_mdt_dates);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/mdt_cases_new', $mdt_result);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Find MDT Cases
     *
     * @return void
     */
    public function find_mdt_cases() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $encode = '';
      if (!empty($_POST['hospital_id']) && !empty($_POST['mdt_date'])) {
        $hospital_id = $_POST['hospital_id'];
        $mdt_date = $_POST['mdt_date'];
        $mdt_record = $this->Institute_model->mdt_cases_list_model($hospital_id, $mdt_date);
        if (!empty($mdt_record)) {
          $encode .= '<a download href="' . base_url('index.php/institute/generate_word?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date) . '">Download Word</a>';
          $encode .= '<table class="table table-condensed">';
          $encode .= '<tr>';
          $encode .= '<th>Serial No</th>';
          $encode .= '<th>First Name</th>';
          $encode .= '<th>Sur Name</th>';
          $encode .= '<th>EMIS No</th>';
          $encode .= '<th>Gender</th>';
          $encode .= '<th>Authorized</th>';
          $encode .= '</tr>';
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
          $encode .= '</table>';
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
     * Find MDT Cases New
     *
     * @return void
     */
    public function find_mdt_cases_new() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $encode = '';
      if (!empty($_POST['hospital_id']) && !empty($_POST['mdt_date'])) {
        $hospital_id = $_POST['hospital_id'];
        $mdt_date = $_POST['mdt_date'];
        $mdt_record = $this->Institute_model->mdt_cases_list_model_new($hospital_id, $mdt_date);
        if (!empty($mdt_record)) {
          $encode .= '<a download href="' . base_url('index.php/institute/generate_word_new?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date) . '">Download Word</a>';
          $encode .= '<table class="table table-condensed">';
          $encode .= '<tr>';
          $encode .= '<th>Serial No</th>';
          $encode .= '<th>First Name</th>';
          $encode .= '<th>Sur Name</th>';
          $encode .= '<th>EMIS No</th>';
          $encode .= '<th>Gender</th>';
          $encode .= '<th>Authorized</th>';
          $encode .= '</tr>';
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
          $encode .= '</table>';
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
     * Find Archived MDT Cases
     *
     * @return void
     */
    public function find_prev_mdt_cases() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $encode = '';
      if (!empty($_POST['hospital_id']) && !empty($_POST['prev_mdt_date'])) {
        $hospital_id = $_POST['hospital_id'];
        $prev_mdt_date = $_POST['prev_mdt_date'];
        $mdt_record = $this->Institute_model->mdt_cases_list_model($hospital_id, $prev_mdt_date);
        if (!empty($mdt_record)) {
          $encode .= '<a download href="' . base_url('index.php/institute/generate_word?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date) . '">Download Word</a>';
          $encode .= '<table class="table table-condensed">';
          $encode .= '<tr>';
          $encode .= '<th>Serial No</th>';
          $encode .= '<th>First Name</th>';
          $encode .= '<th>Sur Name</th>';
          $encode .= '<th>EMIS No</th>';
          $encode .= '<th>Gender</th>';
          $encode .= '</tr>';
          foreach ($mdt_record as $row) {
            $encode .= '<tr>';
            $encode .= '<td>' . $row->serial_number . '</td>';
            $encode .= '<td>' . $row->f_name . '</td>';
            $encode .= '<td>' . $row->sur_name . '</td>';
            $encode .= '<td>' . $row->emis_number . '</td>';
            $encode .= '<td>' . $row->gender . '</td>';
            $encode .= '</tr>';
          }
          $encode .= '</table>';
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
     * Find Archived MDT Cases New
     *
     * @return void
     */
    public function find_prev_mdt_cases_new() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $encode = '';
      if (!empty($_POST['hospital_id']) && !empty($_POST['prev_mdt_date'])) {
        $hospital_id = $_POST['hospital_id'];
        $prev_mdt_date = $_POST['prev_mdt_date'];
        $mdt_record = $this->Institute_model->mdt_cases_list_model_new($hospital_id, $prev_mdt_date);
        if (!empty($mdt_record)) {
          $encode .= '<a download href="' . base_url('index.php/institute/generate_word_new?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date) . '">Download Word</a>';
          $encode .= '<table class="table table-condensed">';
          $encode .= '<tr>';
          $encode .= '<th>Serial No</th>';
          $encode .= '<th>First Name</th>';
          $encode .= '<th>Sur Name</th>';
          $encode .= '<th>EMIS No</th>';
          $encode .= '<th>Gender</th>';
          $encode .= '</tr>';
          foreach ($mdt_record as $row) {
            $encode .= '<tr>';
            $encode .= '<td>' . $row->serial_number . '</td>';
            $encode .= '<td>' . $row->f_name . '</td>';
            $encode .= '<td>' . $row->sur_name . '</td>';
            $encode .= '<td>' . $row->emis_number . '</td>';
            $encode .= '<td>' . $row->gender . '</td>';
            $encode .= '</tr>';
          }
          $encode .= '</table>';
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
     * Generate Word
     *
     * @return void
     */
    public function generate_word() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date'])) {
        $hospital_id = $_GET['hospital_id'];
        $mdt_date = $_GET['mdt_date'];
        $mdt_record['mdt_records'] = $this->Institute_model->mdt_cases_list_model($hospital_id, $mdt_date);
        $this->load->view('institute/inc/documents/word', $mdt_record);
      }
    }

    /**
     * Generate Word New
     *
     * @return void
     */
    public function generate_word_new() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date'])) {
        $hospital_id = $_GET['hospital_id'];
        $mdt_date = $_GET['mdt_date'];
        $mdt_record['mdt_records'] = $this->Institute_model->mdt_cases_list_model_new($hospital_id, $mdt_date);
        $this->load->view('institute/inc/documents/word', $mdt_record);
      }
    }

    /**
     * Profile Form View
     *
     * @return void
     */
    public function profile_form() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('profile')) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $decryptedDetails['decryptedDetails'] = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/profile_form', $decryptedDetails);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Update Profile Function
     *
     * @return void
     */
    public function update_profile() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('profile')) {
        
      }
      $this->form_validation->set_rules('email_address', 'Email Address', 'valid_email');
      $this->form_validation->set_rules('phone', 'Phone', 'integer');
      $this->form_validation->set_rules('memorable', 'Memorable', 'min_length[10]|max_length[10]');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('institute/inc/header');
        $this->load->view('institute/profile_form');
        $this->load->view('institute/inc/footer-new');
      } else {
        if ($_FILES['profile_picture']['size'] > 0) {
          $config['upload_path'] = './uploads/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['file_name'] = 'profile_picture_' . substr(md5(rand()), 0, 7);
          $config['overwrite'] = FALSE;
          $config['max_size'] = '1024';
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('profile_picture')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('upload_error', $error['error']);
            $this->load->view('institute/inc/header');
            $this->load->view('institute/profile_form');
            $this->load->view('institute/inc/footer-new');
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
        $doctor_id = $this->ion_auth->user()->row()->id;
        $this->db->where('id', $doctor_id);
        $this->db->update('users', $profile_data);
        $updatebasic = $this->Userextramodel->UpdateBasicInfoUserDoctor($doctor_id, $this->input->post('email_address'), $this->input->post('username'), $this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('company'), $this->input->post('phone'));
        if ($this->db->affected_rows() > 0 || $updatebasic == TRUE) {
          $success = '<div class="alert bg-success">Your Profile Information Was Successfully Updated.</div>';
          $this->session->set_flashdata('success_update', $success);
          redirect('institute/profile_form');
        } else {
          $general_error = '<div class="alert bg-danger">Something Went Wrong While Updating Profile Information.</div>';
          $this->session->set_flashdata('general_error', $general_error);
          redirect('institute/update_profile');
        }
      }
    }

    /**
     * Change Password Function
     *
     * @return void
     */
    public function change_password_institute() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('profile')) {
        
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
     * Find Matching record
     * based on NHS number
     *
     * @return void
     */
    public function find_matching_records() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('add_institute')) {
        
      }
      $json = array();
      if (!empty($_POST['nhs_number']) && intval($_POST['nhs_number'])) {
        $nhs_number = $this->input->post('nhs_number');
        $match_record['find_match_record'] = $this->Institute_model->find_matching_records_model($nhs_number);
        echo json_encode($match_record);
        die;
      }
    }

    /**
     * Message Center View
     *
     * @return void
     */
    public function messages_center() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('message_center')) {
        
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $list_all_users['list_users'] = $this->Institute_model->get_message_users($hospital_id);
      $hospital_sent_msg['sent_msg'] = $this->Institute_model->display_institute_msg_model($hospital_id, 'sent');
      $hospital_inbox_msg['inbox_msg'] = $this->Institute_model->display_institute_msg_model($hospital_id, 'inbox');
      $hospital_trash_msg['trash_msg'] = $this->Institute_model->display_institute_msg_model($hospital_id, 'trash');
      $merge_msg_data = array_merge($hospital_sent_msg, $hospital_inbox_msg, $hospital_trash_msg, $list_all_users);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/message_center/message_center', $merge_msg_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Insert Private Message function
     *
     * @return void
     */
    public function insert_pm_by_institute() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('message_center')) {
        
      }
      $json = array();
      if ($_POST['list_users'] == 0) {
        $json['type'] = 'error';
        $json['msg'] = '<div class="alert alert-danger">Please Choose the User First.</div>';
        echo json_encode($json);
        die;
      }
      if ($_POST['msg_subject'] == '') {
        $json['type'] = 'error';
        $json['msg'] = '<div class="alert alert-danger">Please Add the Subject.</div>';
        echo json_encode($json);
        die;
      }
      if ($_POST['msg_description'] == '') {
        $json['type'] = 'error';
        $json['msg'] = '<div class="alert alert-danger">Please Add the Message Description.</div>';
        echo json_encode($json);
        die;
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $pm_data = array(
        'privmsg_subject' => $this->input->post('msg_subject'),
        'privmsg_body' => $this->input->post('msg_description'),
        'privmsg_author' => $hospital_id
      );
      $this->db->insert('privmsgs', $pm_data);
      $insert_id = $this->db->insert_id();
      $pm_to_data = array(
        'pmto_message' => $insert_id,
        'pmto_recipient' => $this->input->post('list_users')
      );
      $this->db->insert('privmsgs_to', $pm_to_data);
      if (isset($_POST['send_mail'])) {
        $to_user_id = $this->input->post('list_users');
        $mail_to_id = $this->ion_auth->user($to_user_id)->row()->email;
        $hospital_email = $this->ion_auth->user($hospital_id)->row()->email;
        $subject = $this->input->post('msg_subject');
        $fname = $this->ion_auth->user($hospital_id)->row()->first_name;
        $lname = $this->ion_auth->user($hospital_id)->row()->last_name;
        $message = '';
        $message .= '<p>You have been received an inbox message from : ' . $fname . ' ' . $lname . '</p>';
        $message .= '<p>Please Login and go to message center from dashboard to view your message.</p>';
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($hospital_email, 'Uralensis Message Notification');
        $this->email->to($mail_to_id);
        $this->email->subject('Uralensis Message Notification ' . $subject);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        if ($this->email->send()) {
          $json['type'] = 'success';
          $json['msg'] = '<div class="alert alert-success">Message Successfully Send.</div>';
          echo json_encode($json);
          die;
        } else {
          $json['type'] = 'error';
          $json['msg'] = '<div class="alert alert-danger">Email Not Sent Due To Server Issue.' . show_error($this->email->print_debugger()) . '</div>';
          echo json_encode($json);
          die;
        }
      }
      $json['type'] = 'success';
      $json['msg'] = '<div class="alert alert-success">Message Successfully Send.</div>';
      echo json_encode($json);
      die;
    }

    /**
     * Trash From Inbox
     *
     * @return void
     */
    public function msg_trashinbox_institute() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('message_center')) {
        
      }
      $json = array();
      if (isset($_POST)) {
        $trash_id = $this->input->post('trash_id');
        $trash_data = array(
          'pmto_deleted' => 1
        );
        $this->db->where('pmto_message', $trash_id);
        $this->db->update('privmsgs_to', $trash_data);
        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Trashed.</div>';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Trash From Sent Items
     *
     * @return void
     */
    public function msg_trashsent_institute() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('message_center')) {
        
      }
      $json = array();
      if (isset($_POST)) {
        $trash_id = $this->input->post('trash_id');
        $trash_data = array(
          'privmsg_deleted' => 1
        );
        $this->db->where('privmsg_id', $trash_id);
        $this->db->update('privmsgs', $trash_data);
        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Trashed.</div>';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Delete Trash Items
     *
     * @return void
     */
    public function delete_trash_institute() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('message_center')) {
        
      }
      $json = array();
      if (isset($_POST)) {
        $delete_id = $this->input->post('delete_id');
        $delete_data = array(
          'ura_msg_sent_trash_status' => 1
        );
        $this->db->where('ura_msg_id', $delete_id);
        $this->db->delete('uralensis_inbox_msgs');
        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Deleted.</div>';
        echo json_encode($json);
        die;
      }
    }

    /**
     * @access public
     * @return html
     *
     * Check if the Role Permissions retunrs false
     * then call this function.
     */
    public function forbidden() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/forbidden');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Insert Flag Comments
     *
     * @return void
     */
    public function save_flag_comments() {
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
        $json['msg'] = 'Comments Added Successfully.';
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
     * Set Flag Status
     *
     * @return void
     */
    public function set_flag_status() {
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
     * Show Comment Box
     *
     * @return void
     */
    public function show_comments_box() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $encode_data = '';
      if (isset($_POST) && !empty($_POST['record_id'])) {
        $user_id = $this->ion_auth->user()->row()->id;
        $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $record_id = $_POST['record_id'];
        $flag_data = $this->Institute_model->get_flag_commnets_record($group_id, $record_id);
        if (!empty($flag_data)) {
          $encode_data .= '<div class="flag_container">';
          $encode_data .= '<ul class="flag_items">';
          foreach ($flag_data as $flag) {
            $first_name = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name", "users", array("id" => $flag->ufc_user_id));
            $last_name = getRecords("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $flag->ufc_user_id));
                    // $first_name = $this->ion_auth->user($flag->ufc_user_id)->row()->first_name;
                    //$last_name = $this->ion_auth->user($flag->ufc_user_id)->row()->last_name;
            $full_name = $first_name[0]->first_name . ' ' . $last_name[0]->last_name;
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
    public function delete_flag_comments() {
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
     * Show Clinic Dates View
     *
     * @return void
     */
    public function show_clinic_dates() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $ref_counter = 0001;
      $hospital_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $get_ref_last_rec = $this->db->query("SELECT * FROM uralensis_clinic_dates AS ucd
        WHERE ucd.ura_clinic_hospital_id = $hospital_id
        ORDER BY ucd.ura_clinic_date_id DESC
        LIMIT 1")->result();
      $db_ref_key = '';
      if (!empty($get_ref_last_rec)) {
        $db_ref_key = $get_ref_last_rec[0]->ura_clinic_ref_no;
        $clinic_ref_explode = explode('-', $db_ref_key);
        $clinic_ref = (int) $clinic_ref_explode[1];
        if (!empty($clinic_ref)) {
          $ref_counter = $clinic_ref + 1;
        }
      }
      $ref_data['ref_data'] = array(
        'ref_key' => sprintf("%04d", $ref_counter)
      );
      $clinic_upcoming['clinic_upcoming'] = $this->Institute_model->get_upcoming_clinic_dates($hospital_id);
      $clinic_previous['clinic_previous'] = $this->Institute_model->get_previous_clinic_dates($hospital_id);
      $clinic_data = array_merge($ref_data, $clinic_upcoming, $clinic_previous);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/clinic_dates/add_clinic_dates', $clinic_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Add Clinic Dates
     *
     * @return void
     */
    public function add_clinics_date() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (isset($_POST) && !empty($_POST['add_clinic_date'])) {
        $ura_clinic_ref = $this->input->post('ref_number');
        $ura_clinic_date = $this->input->post('clinic_date');
        $ura_clinic_loca = $this->input->post('location');
        $ura_clinic_lead = $this->input->post('clinic_lead');
        $user_id = $this->ion_auth->user()->row()->id;
        $hospital_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
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
        redirect('institute/show_clinic_dates', 'refresh');
      }
    }

    /**
     * Edit Clinic Dates
     *
     * @return void
     */
    public function edit_clinic_date() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $clinic_record_id = '';
      $hospital_id = '';
      if (isset($_GET['rec_id']) && !empty($_GET['rec_id'])) {
        $clinic_record_id = $_GET['rec_id'];
      }
      if (isset($_GET['hopital_id']) && !empty($_GET['hopital_id'])) {
        $hospital_id = $_GET['hopital_id'];
      }
      $clinic_data['clinic_data'] = $this->Institute_model->display_clinic_edit_data($clinic_record_id, $hospital_id);
      $checklist_data['checklist_data'] = $this->Institute_model->display_clinic_checklist_data($clinic_record_id);
      $request_data['request_data'] = $this->Institute_model->display_clinic_requestform_data($clinic_record_id);
      $other_data['otherdoc_data'] = $this->Institute_model->display_clinic_otherdoc_data($clinic_record_id);
      $clinic_request['request_form'] = $this->Institute_model->get_all_clinic_requests_data($hospital_id, $clinic_record_id);
      $clinic_edit_data = array_merge($clinic_data, $checklist_data, $request_data, $other_data, $clinic_request);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/clinic_dates/edit_clinic_date', $clinic_edit_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Process Clinic Dates
     *
     * @return void
     */
    public function process_edit_clinic_date() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (isset($_POST) && !empty($_POST['save_clinic_date'])) {
        $total_patients = $this->input->post('total_patients');
        $total_samples = $this->input->post('total_samples');
        $imf_samples = $this->input->post('imf_samples');
        $rec_id = $this->input->post('rec_id');
        $hospital_id = $this->input->post('hospital_id');
        $ref_key = $this->input->post('ref_key');
        if (isset($_FILES['upload_checklist']) && $_FILES['upload_checklist']['name'] != '') {
          $upload_checklist = $this->do_upload_clinic_files('upload_checklist', $ref_key);
          if ($upload_checklist === FALSE) {
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
          $upload_request_form = $this->do_upload_clinic_files('upload_request_form', $ref_key);
          if ($upload_request_form === FALSE) {
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
          if ($upload_other_doc === FALSE) {
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
      redirect('institute/edit_clinic_date/?rec_id=' . $rec_id . '&hopital_id=' . $hospital_id . '&ref_key=' . $ref_key, 'refresh');
    }

    /**
     * Upload Clinic Files
     *
     * @param string $clinic_filename
     * @param string $ref_key
     * @return void
     */
    public function do_upload_clinic_files($clinic_filename, $ref_key) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $config['upload_path'] = './clinic_uploads/';
      $config['allowed_types'] = 'pdf|png|jpg|docx|doc|jpeg';
      $config['max_size'] = 20400;
      $config['overwrite'] = TRUE;
      $new_name = $ref_key . '-' . $_FILES[$clinic_filename]['name'];
      $config['file_name'] = $new_name;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if (!$this->upload->do_upload($clinic_filename)) {
        return FALSE;
      } else {
        return TRUE;
      }
    }

    /**
     * Upload Clinic Files
     *
     * @param string $clinic_filename
     * @param string $ref_key
     * @return void
     */
    public function do_upload_request_logo($clinic_filename, $ref_key) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'pdf|png|jpg|docx|doc|jpeg';
      $config['max_size'] = 20400;
      $config['overwrite'] = TRUE;
      $new_name = $ref_key . '-' . $_FILES[$clinic_filename]['name'];
      $config['file_name'] = $new_name;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if (!$this->upload->do_upload($clinic_filename)) {
        return FALSE;
      } else {
        return TRUE;
      }
    }

    /**
     * Delete Clinic Files
     *
     * @return void
     */
    public function delete_clinic_upload_files() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
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
        } else if ($upload_type === 'request_files') {
          $this->db->delete('uralensis_clinic_date_requestform_uploads', array('ucd_requestform_upload_id' => $file_id));
          $this->db->where('clinic_request_form', $file_id)->where('hospital_group_id', $hospital_id);
          $this->db->update('request', array('clinic_request_form' => NULL));
          $json['type'] = 'success';
          echo json_encode($json);
          die;
        } else if ($upload_type === 'other_files') {
          $this->db->delete('uralensis_clinic_date_otherdocs_uploads', array('ucd_otherdocs_upload_id' => $file_id));
          $json['type'] = 'success';
          echo json_encode($json);
          die;
        }
      }
    }

    /**
     * Autosuggest Clinic Reference
     *
     * @return void
     */
    public function clinic_reference_autosuggest() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (isset($_REQUEST['query'])) {
        $user_id = $this->ion_auth->user()->row()->id;
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
     * Populate Request Form Files
     *
     * @return void
     */
    public function set_populate_request_form() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (isset($_POST) && !empty($_POST['clinic_record_id'])) {
        $clinic_record_id = $_POST['clinic_record_id'];
        $request_form = $this->Institute_model->get_request_form_records($clinic_record_id);
        if (empty($request_form)) {
          $json['type'] = 'error';
          $json['msg'] = 'No Request Form Found. Please Add First.';
          echo json_encode($json);
          die;
        } else {
          $encode_data = '';
          $encode_data .= '<div class="form-group">';
          $encode_data .= '<label for="request_form">Request Forms</label>';
          $encode_data .= '<select class="form-control" name="request_form" id="request_form">';
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
     * Find Matching lab number records
     *
     * @return void
     */
    public function find_lab_number_records() {
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
        ($lab_prefix != 'PU')
      ) {
        $json['type'] = 'error';
        $json['msg'] = 'The Prefix Should be start from PU-';
        echo json_encode($json);
        die;
      } else if (($lab_number == 'U') ||
        ($lab_number == 'S') ||
        ($lab_number == 'H') &&
        (strlen($lab_number) == 1)
      ) {
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
     * Delete Clinic Dates
     *
     * @return void
     */
    public function delete_clinic_date() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
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
        redirect('institute/show_clinic_dates', 'refresh');
      }
    }

    /**
     * Mark all records status to read
     *
     * @return void
     */
    public function mark_read_records() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      if (isset($_POST) && !empty($_POST['record_ids'])) {
        $record_ids = explode(',', $_POST['record_ids']);
        foreach ($record_ids as $ids) {
          $data = array(
            'request_viewed_id' => $ids,
            'user_viewed_id' => $user_id,
            'user_group_id' => $hospital_group_id,
            'request_view_status' => 'TRUE',
            'timestamp' => time()
          );
          $this->db->insert('request_viewed', $data);
        }
        $json['type'] = 'success';
        $json['msg'] = 'Record Marked as Viewed Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Assign MDT Records
     *
     * @return void
     */
    public function assign_mdt_record() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
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
        $user_id = $this->ion_auth->user()->row()->id;
        $username = $this->ion_auth->user($user_id)->row()->username;
        $data = array(
          'mdt_case' => $this->input->post('report_option'),
          'mdt_case_status' => $this->input->post('mdt_dates_radio'),
          'mdt_case_assignee_username' => $username
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
     * Add MDT Message
     *
     * @return void
     */
    public function add_mdt_message() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (isset($_POST) && !empty($_POST['mdt_message'])) {
        $record_id = $_POST['record_id'];
        $data = array(
          'mdt_case_msg' => $this->input->post('mdt_message'),
          'mdt_case_msg_timestamp' => time()
        );
        $this->db->where('uralensis_request_id', $record_id);
        $this->db->update('request', $data);
        $json['type'] = 'success';
        $json['msg'] = 'MDT Message Added!';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Delete MDT Record Notes
     *
     * @return void
     */
    public function delete_mdt_record_note() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST['record_id'])) {
        $record_id = $this->input->post('record_id');
        $this->db->where('uralensis_request_id', $record_id);
        $this->db->update('request', array('mdt_case_msg' => '', 'mdt_case_msg_timestamp' => '', 'mdt_case_add_to_report_status' => 0));
        $json['type'] = 'success';
        $json['msg'] = 'Record Deleted Successfully.';
        echo json_encode($json);
      } else {
        $json['type'] = 'error';
        $json['msg'] = 'Something wrong while deleting this record.';
        echo json_encode($json);
      }
    }

    /**
     * Add MDT record notes on PDF report
     *
     * @return void
     */
    public function add_mdt_record_note_on_report() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST['record_id'])) {
        $record_id = $this->input->post('record_id');
        if ($_POST['mdt_status'] === 'mdt_not_add') {
          $mdt_add_report_status = 1;
          $mdt_add_report_msg = 'MDT Note Added Successfully.';
        } else {
          $mdt_add_report_status = 0;
          $mdt_add_report_msg = 'MDT Note not added on report.';
        }
        $this->db->where('uralensis_request_id', $record_id);
        $this->db->update('request', array('mdt_case_add_to_report_status' => $mdt_add_report_status));
        $json['type'] = 'success';
        $json['msg'] = $mdt_add_report_msg;
        echo json_encode($json);
      } else {
        $json['type'] = 'error';
        $json['msg'] = 'Something wrong while adding mdt on report.';
        echo json_encode($json);
      }
    }

    /**
     * Record Tracking Module
     *
     * @return void
     */
    public function record_tracking() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $permissions = $this->ion_auth->user($user_id)->row()->user_doc_rec_perm;
      $this->load->view('institute/inc/header');
      if ($permissions === 'on') {
        $track_templates['track_templates'] = $this->Institute_model->get_all_track_record_templates($user_id);
        $session_records_ids = $this->session->userdata('session_records');
        $session_rec_data = array();
        if (!empty($session_records_ids) && isset($session_records_ids)) {
          $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($session_records_ids);
        }
        $result_data = array_merge($track_templates, $session_rec_data);
        $this->load->view('institute/record_tracking/index', $result_data);
      } else {
            //return FALSE;

        $track_templates['track_templates'] = $this->Institute_model->get_all_track_record_templates($user_id);
        $session_records_ids = $this->session->userdata('session_records');
        $session_rec_data = array();
        if (!empty($session_records_ids) && isset($session_records_ids)) {
          $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($session_records_ids);
        }
        $result_data = array_merge($track_templates, $session_rec_data);
        $this->load->view('institute/record_tracking/index', $result_data);
      }
      $this->load->view('institute/inc/footer-new');
    }

    public function record_tracking_old() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }

      $user_id = $this->ion_auth->user()->row()->id;
      $permissions = $this->ion_auth->user($user_id)->row()->user_doc_rec_perm;
      $this->load->view('institute/inc/header_old');
      if ($permissions === 'on') {
        $track_templates['track_templates'] = $this->Institute_model->get_all_track_record_templates($user_id);
        $session_records_ids = $this->session->userdata('session_records');
        $session_rec_data = array();
        if (!empty($session_records_ids) && isset($session_records_ids)) {
          $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($session_records_ids);
        }
        $result_data = array_merge($track_templates, $session_rec_data);
        $this->load->view('institute/record_tracking/index_original', $result_data);
      } else {
        return false;
      }
      $this->load->view('institute/inc/footer_old');
    }

    /**
     * get all templates Tracking Module
     *
     * @return void
     */
    public function getTemplatesNames() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $templatename = $this->input->post('track_template_name');
      $track_templates = $this->Institute_model->get_all_track_record_templates_bynameLike($user_id, $templatename);
      $templatearrary = "";

      foreach ($track_templates as $rec) {
        $templatearrary .= $rec->temp_input_name . ",";
      }
      $str = rtrim($templatearrary, ',');

      echo $str;
      die;
      if (!empty($track_templates)) {

        $json['type'] = 'success';
        $json['msg'] = 'Template Loaded';
        $json['data'] = $templatearrary;
        echo json_encode($json);
        die;
      }
    }

    /**
     * get all templates Tracking Module
     *
     * @return void
     */
    public function getTemplates() {
      if (!$this->ion_auth->logged_in()) {
       // redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $templatename = $this->input->post('track_template_name');
      $track_templates = $this->Institute_model->get_all_track_record_templates_byname($user_id, $templatename);
      if (!empty($track_templates)) {
        $get_hospital_name = $this->ion_auth->group($track_templates[0]->temp_hospital_user)->row();
        $get_hospital_name = empty($get_hospital_name) ? '' : $get_hospital_name->description;
        $hospital_name = !empty($get_hospital_name) ? $get_hospital_name : '';
        $authorname = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username", "users", array("id" => $user_id));
        $authorname = empty($authorname) ? '' : $authorname[0]->username;
        $clinic_user = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username", "users", array("id" => $track_templates[0]->temp_clinic_user));
        $clinic_user = empty($clinic_user) ? '' : $clinic_user[0]->username;
        $doctor_name = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username", "users", array("id" => $track_templates[0]->temp_pathologist));
        $doctor_name = empty($doctor_name) ? '' : $doctor_name[0]->username;
            //Get Lab name
        $get_lab_name = $this->db->select('description')->where('id', $track_templates[0]->temp_lab_name)->get('groups')->row_array();
        $get_lab_name = empty($get_lab_name) ? '' : $get_lab_name['description'];
        $urgency = '';
        $specimen_type = '';
        $templateArray = array(
          'hospitalId' => $track_templates[0]->hospital_id,
          'clinicId' => $track_templates[0]->temp_clinic_user,
          'pathologist' => $track_templates[0]->temp_pathologist,
          'labname' => $track_templates[0]->temp_lab_name,
          'urgency' => $track_templates[0]->temp_report_urgency,
          'specimen_type' => $track_templates[0]->temp_skin_type,
          'templateid' => $track_templates[0]->ura_rec_temp_id,
          'temp_input_name' => $track_templates[0]->temp_input_name,
          'specimen_no' => $track_templates[0]->specimen_no,
          'department_id' => $track_templates[0]->department_id,
          'speciality' => $track_templates[0]->speciality,
          'sub_specialist' => $track_templates[0]->sub_specialist,
          'snomed_code_id' => $track_templates[0]->snomed_code_id,
          'courier_no' => $track_templates[0]->courier_no,
          'batch_no' => $track_templates[0]->batch_no,
          'hospital_name' => $hospital_name,
          'clinicuser' => ucwords($clinic_user),
          'labdesc' => ucwords($get_lab_name),
          'doctorusername' => ucwords($doctor_name),
          'urgencytxt' => ucwords($urgency),
          'specimentxt' => ucwords($specimen_type),
          'authorname' => $authorname,
          'timestamp' => gmdate("Y-m-d", $track_templates[0]->timestamp),
          'stamp_date' => (!empty($track_templates[0]->stamp_date)) ? date('Y-m-d', strtotime($track_templates[0]->stamp_date)) : '',
          'report_schedule' => (!empty($track_templates[0]->report_schedule)) ? $track_templates[0]->report_schedule : '',
          'request_type' => $track_templates[0]->temp_request_type
        );
        $json['type'] = 'success';
        $json['msg'] = 'Template Loaded';
        $json['data'] = $templateArray;
        echo json_encode($json);
        die;
      } else {
        $json = array(
          'type' => 'error',
          'msg' => 'Template could not be found'
        );
        echo json_encode($json);
        die;
      }
    }

    /**
     * Record Tracking Module
     * record_tracking_new
     * @return void
     */
//    public function bookingin()
//    {
//        if (!in_array($this->group_type, ['A', 'H'])) {
//            redirect('/');
//        }
//        
//        $h_data = array('styles' => array('css/institute/bookingin.css'));
//        $f_data = array('javascripts' => array('js/institute/bookinging.js'));
//
////
//        $lab = $this->input->get('lab');
//        $speciality = $this->input->get('speciality');
//        
////        $lab = 24;
////        $speciality = 1;
//
////        if (empty($lab) || empty($speciality)) {
////            $labs = [];
////            if ($this->group_type === 'A') {
////                $labs = $this->db->get_where('groups', array('group_type' =>'L'))->result_array();
////            }
////            if ($this->group_type === 'H') {
////                $labs = $this->db->join('hospital_group', 'hospital_group.group_id = groups.id')
////                ->where('hospital_id', $this->group_id)
////                ->get('groups')->result_array();
////            }
////            $this->load->view('institute/inc/header-new', $h_data);
////            $this->load->view('institute/record_tracking/lab_selection', array(
////                "labs" => $labs,
////                "lab" => $lab,
////                "speciality" => $speciality
////            ));
////            $this->load->view('institute/inc/footer-new', $f_data);
////            return;
////        }
// 
//        $user_id = $this->ion_auth->user()->row()->id;
//        //echo $user_id."-".111; exit; 
//       //$user_id = 1;
//        //$permissions = $this->ion_auth->user()->row()->user_doc_rec_perm;
//
//        // All groups with group type L
//       
//        $lab_names['lab_names'] = $this->Institute_model->get_lab_names();
//        #comment because of no doctors
//        // User info with group_type D
//     //   $doctor_list['doctor_list'] = $this->Institute_model->get_doctors();
//
//        // User info with group_type C
//        
//        $doctor_list['clinic_list'] = $this->Institute_model->get_clinic();
// 
//        $this->load->model('DepartmentModel', 'department');
//        $deps = $this->department->get_laboratory_department($lab_names['lab_names'][0]["id"]);
//        // echo 1; exit; 
//        $spec_array = [];
//        foreach($deps as $d_id => $dep) {
//            if ($dep['name'] === 'Pathology') {
//                foreach ($dep['specialties'] as $spec_id => $spec) {
//                    $spec_array[] = (object)['id' => $spec_id, 'specialty' => $spec['name']];
//                }
//                break;
//            }
//        }
//       
//        $Speciality['Speciality'] = $spec_array;
//        $authorname['authorname'] = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username", "users", array("id" => $user_id));
//
//        // Get all templates assigned to current user
//        $track_templates['track_templates'] = $this->Institute_model->get_all_track_record_templates_bynameLike($user_id);
//        // All records in current session
//        $session_records_ids = $this->session->userdata('session_records');
//
//        // Validate session
//        $valid_session_ids = array();
//        if (is_array($session_records_ids) && !empty($session_records_ids)) {
//            foreach ($session_records_ids as $ids) {
//                if (!empty($ids) && is_numeric($ids)) {
//                    array_push($valid_session_ids, $ids);
//                }
//            }
//        }
//        $this->session->set_userdata('session_records', $valid_session_ids);
//        $session_rec_data = array('session_data' => null);
//        if (is_array($valid_session_ids) && !empty($valid_session_ids)) {
//            $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($valid_session_ids);
//        }
//
//        $this->load->model('Laboratory_model', 'laboratory');
//        $lab_departments = $this->department->get_laboratory_department($lab_names['lab_names'][0]["id"]);
//        $specialties = [];
//        foreach($lab_departments as $d_id => $department) {
//            if ($department['name'] === 'Pathology') {
//                $specialties = $department['specialties'];
//            }
//        }
//
//        $this->load->view('institute/inc/header-new', $h_data);
//        $result_data = array_merge($lab_names, $doctor_list, $Speciality, $authorname, $track_templates, $session_rec_data);
//        $result_data['specialties'] = $specialties;
////        if ($this->group_type === 'A') {
////            $result_data['hospitals'] = $this->Institute_model->fetch_all_hospitals();
////        } 
////        if ($this->group_type === 'H') {
////            $result_data['hospital'] = $this->db->get_where('groups', ['id' => $this->group_id])->result_array();
////        }
//        $result_data['group_type'] = $this->group_type;
////print_r($result_data); exit; 
//        $this->load->model('PatientModel', 'patient');
//        $result_data['patients'] = $this->patient->fetch_patients();
//       // print_r($result_data); exit; 
//        $this->load->view('institute/record_tracking/index-new', $result_data);
//        $this->load->view('institute/inc/footer-new', $f_data);
//    }



    public function bookingin() 
    {
     if (!$this->ion_auth->logged_in())  
	  {
        redirect('/');
      }

      $h_data = array('styles' => array('css/institute/bookingin.css'));
      $f_data = array('javascripts' => array('js/institute/bookinging.js'));

//
//       $lab = $this->input->get('lab');
//       $speciality = $this->input->get('speciality');
        #get labs against hospital
	 

     //$user_id = $this->ion_auth->user()->row()->id;
	 
	 
		$user_id = $this->ion_auth->user()->row()->id;
		$group_row = $this->ion_auth->get_users_main_groups()->row();
		$group_type = $group_row->group_type;
		$group_id = $group_row->id;
	 
      if (in_array($group_type,HOSPITAL_GROUP)) 
	  {
       $lab_names['lab_names'] = getHospitalLabs($group_id);
      }

     if (in_array($group_type,LAB_GROUP)) 
	 {

     $lab_names['lab_names'] = getSelectedLabsDetails($user_id);
	  
	  //print_r($lab_names['lab_names'][0]["description"]);
	  
	  
	  $lab_names['lab_des'] = getSelectedLabsDetails($user_id);
     }

	

	 
	$group_name= $this->ion_auth->get_users_groups($user_id)->row()->description;;
	
	$group_details['group_name']=$group_name;
	
	$group_details['uniq_number']=$this->ion_auth->get_auto_increment_unique('uralensis_record_track_template','ura_rec_temp_id');

    $permissions = $this->ion_auth->user()->row()->user_doc_rec_perm;

        //print_r(getHospitalLabs($this->group_id)); exit; 
        // All groups with group type L
        //  $lab_names['lab_names'] = $this->Institute_model->get_lab_names($lab_names[0]["id"]);
//        print_r($lab_names['lab_names']); exit; 
    $doc_list['doctor_list'] = $this->Admin_model->get_doctors();

    // User info with group_type D
    
	$doctor_list['doctor_list'] = $this->Institute_model->get_doctors();

    $doctor_list['courier_list'] = $this->Institute_model->get_courier();
	
	

    $doctor_list['clinic_list'] = $this->Institute_model->get_clinic();

    $this->load->model('DepartmentModel', 'department');

    if (in_array($group_type,HOSPITAL_GROUP)) {
      if($lab_names['lab_names'][0]["id"]!='')
      {
        $deps = $this->department->get_laboratory_department($lab_names['lab_names'][0]["id"]);
      }
    }



    if (in_array($group_type,LAB_GROUP)) 
    {
     if($this->group_id!='')
     {
      $deps = $this->department->get_laboratory_department($group_id);
    }        
  }





      //  print_r($deps); exit; 
  $spec_array = [];
  foreach ($deps as $d_id => $dep) {
    if ($dep['name'] === 'Pathology') {
      foreach ($dep['specialties'] as $spec_id => $spec) {
        $spec_array[] = (object) ['id' => $spec_id, 'specialty' => $spec['name']];
      }
      break;
    }
  }

  $Speciality['Speciality'] = $spec_array;

       // print_r($spec_array); exit; 
         //$Speciality['getTcodes'] = $this->getTCodesAgainstSpeciality($spec_array->id);
        //print_r($Speciality['getTcodes'] ); exit; 

  $authorname['authorname'] = getRecords("AES_DECRYPT(email, '" . DATA_KEY . "') AS username", "users", array("id" => $user_id));

        // Get all templates assigned to current user
  $track_templates['track_templates'] = $this->Institute_model->get_all_track_record_templates_bynameLike($user_id);
        // All records in current session
  $session_records_ids = $this->session->userdata('session_records');

        // Validate session
  $valid_session_ids = array();
  if (is_array($session_records_ids) && !empty($session_records_ids)) {
    foreach ($session_records_ids as $ids) {
      if (!empty($ids) && is_numeric($ids)) {
        array_push($valid_session_ids, $ids);
      }
    }
  }
  $this->session->set_userdata('session_records', $valid_session_ids);
  $session_rec_data = array('session_data' => null);
  if (is_array($valid_session_ids) && !empty($valid_session_ids)) {
   // $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($valid_session_ids);
  }

        /*$this->load->model('Laboratory_model', 'laboratory');
        
        $lab_departments = $this->department->get_laboratory_department($lab_names['lab_names'][0]["id"]);
        $specialties = [];
        foreach ($lab_departments as $d_id => $department) {
            if ($department['name'] === 'Pathology') {
                $specialties = $department['specialties'];
            }
          }*/

          $this->load->view('institute/inc/header-new', $h_data);
		  
		  
		  
		  
          $result_data = array_merge($lab_names, $doctor_list, $Speciality, $authorname, $track_templates, $session_rec_data,$group_details);
        // $result_data['hospitals'] = $this->Institute_model->fetch_all_hospitals();
          $result_data['specialties'] = $specialties;

          if (in_array($this->group_type,LAB_GROUP)) 
		  {
            $result_data['hospitals'] = $this->PatientModel->fetch_hospitals();
          }
          else if (in_array($this->group_type,HOSPITAL_GROUP)) 
		  {
            $result_data['hospital'] = $this->db->get_where('groups', ['id' => $this->group_id])->result_array();
          }
		  else
		  {
			 $result_data['hospitals'] = $this->Institute_model->fetch_all_hospitals(); 
		  }
		  $data_department= $this->department->get_laboratory_department($group_id);
          $result_data['dep_list'] = $this->get_department_list($data_department);
		  
		  $result_data['courier_data'] = $this->Institute_model->getCourierNo($user_id);
		  $result_data['spe_category_sub'] = $this->Institute_model->get_speciality_category($group_id);
		  
          $result_data['group_type'] = $this->group_type;
          $this->load->model('PatientModel', 'patient');
          $result_data['patients'] = $this->patient->fetch_patients();
          $result_data['countries'] = $this->Institute_model->get_countries();

          $result_data['department_list'] = $data_department;
          $result_data['speciality_list'] = $this->db->select('specialty_id as id, specialty as text')->where(['hospital_id' => $this->group_id, 'specialty !=' => ''])->group_by('specialty')->order_by('specialty_id', 'ASC')->get('department_settings_labs')->result_array();
          $result_data['sub_speciality_list'] = $this->db->select('category_id as id, category as text')->where(['hospital_id' => $this->group_id, 'category !=' => ''])->group_by('category')->order_by('category', 'ASC')->get('department_settings_labs')->result_array();
          $result_data['snomed_code_list'] = $this->db->select('snomed_code_id as id, snomed_code_desc as text')->where(['lab_id'=>$this->group_id])->order_by('snomed_code_desc ASC')->get('speciality_snomed_codes')->result_array();
          //pre($result_data['speciality_list']);

          $this->load->view('institute/record_tracking/index-new', $result_data);
          $this->load->view('institute/inc/footer-new', $f_data);
        }

    public function getDepartmentSpecialityData() {

        //pre($_POST);
        if($this->input->post('action') == 'get_speciality') {
            $whereArr = [
                'specialty !='  => '',
                'hospital_id'   => $this->group_id,
                'department_id' => $this->input->post('department_id')
            ];
            $resArr = $this->db->select('specialty_id as id, specialty as text')->where($whereArr)->group_by('specialty')->order_by('specialty_id', 'ASC')->get('department_settings_labs')->result_array();
        } elseif($this->input->post('action') == 'get_sub_speciality') {
            $whereArr = [
                'category !='   => '',
                'hospital_id'   => $this->group_id,
                'department_id' => $this->input->post('department_id'),
                'specialty_id'  => $this->input->post('specialty_id'),
            ];
            $resArr = $this->db->select('category_id as id, category as text')->where($whereArr)->group_by('category')->order_by('category', 'ASC')->get('department_settings_labs')->result_array();
        } elseif ($this->input->post('action') == 'get_snomed_code'){
            $whereArr = [
                'lab_id'        => $this->group_id,
                'department_id' => $this->input->post('department_id'),
                'speciality_id' => $this->input->post('specialty_id'),
                'category_id'   => $this->input->post('sub_specialty_id'),
            ];
            $resArr = $this->db->select('snomed_code_id as id, snomed_code_desc as text')->where($whereArr)->order_by('snomed_code_desc ASC')->get('speciality_snomed_codes')->result_array();
        } elseif ($this->input->post('action') == 'get_report_schedule'){
            $whereArr = [
                'snomed_code_id' => $this->input->post('snomed_code_id')
            ];
            $tempResArr = $this->db->select('(CASE WHEN schedule_type = "weekly" AND schedule_value != "" THEN CONCAT("weekly on ", schedule_value) WHEN schedule_type = "days" AND schedule_value != "" THEN CONCAT("after ", schedule_value, " days") ELSE "" END) as report_schedule')->where($whereArr)->get('speciality_snomed_codes')->result_array();
            if(count($tempResArr) > 0){
                $resArr = $tempResArr[0];
            }else{
                $resArr = ['schedule_title' => 'N/A'];
            }
        } elseif ($this->input->post('action') == 'update_all'){
            $temp_data = array(
                'department_id'     => $this->input->post('department_id'),
                'speciality'        => $this->input->post('specialty_id'),
                'sub_specialist'    => $this->input->post('sub_specialty_id'),
                'snomed_code_id'    => $this->input->post('snomed_code_id'),
                'report_schedule'   => $this->input->post('report_schedule')
            );
            $resArr = updateRecord('uralensis_record_track_template', $temp_data, array('ura_rec_temp_id' => $this->input->post('template_id')));
        }else{
            $resArr = [];
        }
        $json['res'] = $resArr;
        $json['type'] = 'success';
        $json['msg'] = 'Track Template updated successfully.';
        echo json_encode($json);
        die;
    }

	function get_speciality_snomed($ids=false)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * from speciality_snomed_codes where category_id='$ids' and lab_id='".$this->group_id."'";
        $query = $this->db->query($sql);
		//print_r($query->result());
        return $query->result();
    }
	
	
		function get_snomed_code($ids=false)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * from speciality_snomed_codes where category_id='$ids' and lab_id='".$this->group_id."'";
        $query = $this->db->query($sql);
		//print_r($query->result());
        return $query->result();
    }
		

function get_department_list($deppart_list=''){
          $array = array();
          $i=0;
          $spec_count=0;
          $spec_count=0;
          if(!empty($deppart_list)){
            foreach($deppart_list as $dkey=>$dval){
              $array[$i] = array(
                                      'department_id'=>$dkey,
                                      'department_name'=>$dval['name']
                                        );
              if(!empty($dval['specialties'])){
                foreach ($dval['specialties'] as $skey => $sval) {
                  $array[$i]['specialties'][$spec_count] = array(
                                                    'specialties_id'=>$skey,
                                                    'specialties_name'=>$sval['name']
                                                      );
                  if(!empty($sval['categories'])){
                    foreach($sval['categories'] as $ckey=>$cval){
                      $array[$i]['specialties'][$spec_count]['category'][] = array(
                                                    'category_id'=>$ckey,
                                                    'category_name'=>$cval['name']
                                                      );
                    }
                  }

                  if(!empty($sval['specimen_types'])){
                    foreach($sval['specimen_types'] as $spekey=>$speval){
                      $array[$i]['specialties'][$spec_count]['specimen'][] = array(
                                                    'specimen_id'=>$spekey,
                                                    'specimen_name'=>$speval['name']
                                                      );
                    }
                  }

                  $spec_count++;
                }
              }

              $i++;
            }
          }
          // echo "<pre>"; print_r($array);die;
          return json_encode($array);
        }




        public function getTCodesAgainstSpeciality($specialityId ="") 
        {
          $specialityId = $this->input->post('speciality_id');
          $query = "SELECT * FROM speciality_snomed_codes WHERE speciality_id = $specialityId";
          $result = $this->db->query($query)->result_array();
        //print_r($result); exit; 
          $html = "";
          if (count($result) > 0) {
            $html .= "<select name='tCodeId' id='tCodeId' class='form-control select2' multiple='multiple' data-rule-required='true' >";
            foreach ($result as $resKey => $resValue) {

              $html .= '<option value="' . $resValue["snomed_code_id"] . '">' . $resValue["snomed_code"] . '</option>';
            }

            $html .= '</select>';
          }
          $json['type'] = 'success';
          $json['msg'] = 'TCode Loaded';
          $json['data'] = $html;
          echo json_encode($json);
        }

        public function get_patient_record() 
		{

          $patient_id = $this->input->post('patient_id');
        // echo $patient_id; exit; 
          $query = "SELECT * FROM patients where id = $patient_id";
          $result = $this->db->query($query)->result_array();
		  
		  	$today = new DateTime();
            $dob_obj = date_create($result[0]["dob"]);
            $diff = $today->diff($dob_obj);
            $age = $diff->y." y ";
		  
          $html = '<div class="row mb-3">
          <input type="hidden" name="booking_patient_id" id="booking_patient_id" value="' . $result[0]["id"] . '"/>
          <div class="col-3">
          Patient: <span>' . $result[0]["first_name"] . ' ' . $result[0]["last_name"] . '</span>
          </div>
		  <div class="col-3">
          DOB/Age: <span>' . $result[0]["dob"] . '/' . $age . '</span>
          </div>
          <div class="col-2">
          Gender: <span>' . $result[0]["gender"] . '</span>
          </div>
          <div class="col-3">
          Phone No: <span>' . $result[0]["phone"] . '</span>
          </div>
         
          </div>';


          echo $html;
          exit;
        }

    /**
     * Record Tracking List Module
     *
     * @return void
     */
    public function record_tracking_list($search_term = "") {
      if (!$this->ion_auth->logged_in()) {

        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

      $dataset['result'] = $this->Institute_model->getLabSpecimenDetails($group_id, $search_term);


        // echo last_query();exit;


      $this->load->view('institute/inc/header-new');
      $this->load->view('institute/record_tracking/index-new-list', $dataset);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Load track new template
     *
     * @return void
     */
    public function load_track_new_template() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $tmpl_edit_data = '';
      $json = array();
      $lab_names = $this->Institute_model->get_lab_names();
      $doctor_list = $this->Institute_model->get_doctors();
      $tmpl_edit_data .= '<div class="tg-catagoryhead">';
      $tmpl_edit_data .= '<h3>Track Options Menu</h3>';
      $tmpl_edit_data .= '<a class="tg-btnsave save-track-template" href="javascript:;"><i class="fa fa-save"></i></a>';
      $tmpl_edit_data .= '<a class="tg-btnacollapse collapse_temp_data_btn" href="javascript:;"><i class="fa fa-angle-up"></i></a>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="collapse_temp_data">';
      $tmpl_edit_data .= '<form class="form track_temp_edit_form">';
      $tmpl_edit_data .= '<div class="col-md-3 show_template_name_input hidden-boxes"><input type="text" name="track_template_name" class="form-control"></div>';
      $tmpl_edit_data .= '<div class="clearfix"></div>';
      $tmpl_edit_data .= '<div class="tg-topic">';
      $tmpl_edit_data .= '<a href="javascript:;" class="show_lab_btn">';
      $tmpl_edit_data .= '<div class="tg-catagorytopic tg-heartpuls">';
      $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
      $tmpl_edit_data .= '<i class="lnr lnr-heart-pulse"></i>';
      $tmpl_edit_data .= '<div class="tg-catagorycontent">';
      $tmpl_edit_data .= '<h3>Lab</h3>';
      $tmpl_edit_data .= '<span class="display_selected_option"></span>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<em>+</em>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= ' </a>';
      $tmpl_edit_data .= '<div class="show-data-holder" style="background: #3498db;">';
      $tmpl_edit_data .= '<div class="show_labs">';
      $tmpl_edit_data .= '<div class="show_clinic_title">';
      $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
      $tmpl_edit_data .= '<h4><i class="lnr lnr-heart-pulse"></i>Lab</h4>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
      if (!empty($lab_names)) {
        foreach ($lab_names as $labs) {
          $tmpl_edit_data .= '<div class="input-holder">';
          $tmpl_edit_data .= '<input class="track_lab_name" data-labname="' . $labs['description'] . '" type="radio" id="lab_' . $labs['id'] . '" name="lab_name" value="' . $labs['id'] . '">';
          $tmpl_edit_data .= '<label for="lab_' . $labs['id'] . '">' . $labs['description'] . '</label>';
          $tmpl_edit_data .= '</div>';
        }
      }
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="tg-topic">';
      $tmpl_edit_data .= '<a href="javascript:;" class="show_pathologists_btn">';
      $tmpl_edit_data .= '<div class="tg-catagorytopic tg-pathologist">';
      $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
      $tmpl_edit_data .= '<i class="lnr lnr-heart"></i>';
      $tmpl_edit_data .= '<div class="tg-catagorycontent">';
      $tmpl_edit_data .= '<h3>Pathologist</h3>';
      $tmpl_edit_data .= '<span class="display_selected_option"></span>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<em>+</em>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</a>';
      $tmpl_edit_data .= '<div class="show-data-holder" style="background: #9b59b6;">';
      $tmpl_edit_data .= '<div class="show_pathologists">';
      $tmpl_edit_data .= '<div class="show_clinic_title">';
      $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
      $tmpl_edit_data .= '<h4><i class="lnr lnr-heart"></i>Pathologist</h4>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
        //Add Default - Not Assigned
      $tmpl_edit_data .= '<div class="input-holder">';
      $tmpl_edit_data .= '<input class="pathologist" type="radio" data-pathologist="Unassigned" id="doctor_0" name="pathologist" value="0">';
      $tmpl_edit_data .= '<label for="doctor_0">Unassigned</label>';
      $tmpl_edit_data .= '</div>';
      if (!empty($doctor_list)) {
        foreach ($doctor_list as $doctor) {
          $tmpl_edit_data .= '<div class="input-holder">';
          $tmpl_edit_data .= '<input class="pathologist" type="radio" data-pathologist="' . $doctor->first_name . ' ' . $doctor->last_name . '" id="doctor_' . $doctor->id . '" name="pathologist" value="' . $doctor->id . '">';
          $tmpl_edit_data .= '<label for="doctor_' . $doctor->id . '">' . $doctor->first_name . ' ' . $doctor->last_name . '</label>';
          $tmpl_edit_data .= '</div>';
        }
      }
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="tg-topic">';
      $tmpl_edit_data .= '<a href="javascript:;" class="show_report_urgency_btn">';
      $tmpl_edit_data .= '<div class="tg-catagorytopic tg-urgency">';
      $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
      $tmpl_edit_data .= '<i class="lnr lnr-clock"></i>';
      $tmpl_edit_data .= '<div class="tg-catagorycontent">';
      $tmpl_edit_data .= '<h3>Report Urgency</h3>';
      $tmpl_edit_data .= '<span class="display_selected_option"></span>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<em>+</em>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</a>';
      $tmpl_edit_data .= '<div class="show-data-holder" style="background: #e67e22;">';
      $tmpl_edit_data .= '<div class="show_report_urgency">';
      $tmpl_edit_data .= '<div class="show_clinic_title">';
      $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
      $tmpl_edit_data .= '<h4><i class="lnr lnr-clock"></i>Report Urgency</h4>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="input-scroll-holder">';
      $report_urgeny_data = array(
        'routine' => 'Routine',
        '2ww' => '2WW',
        'urgent' => 'Urgent',
      );
      foreach ($report_urgeny_data as $key => $report_urgency) {
        $tmpl_edit_data .= '<div class="input-holder">';
        $tmpl_edit_data .= '<input class="report_urgency" data-urgency="' . $report_urgency . '" type="radio" id="report_' . $key . '" name="report_urgency" value="' . $key . '">';
        $tmpl_edit_data .= '<label for="report_' . $key . '">' . $report_urgency . '</label>';
        $tmpl_edit_data .= '</div>';
      }
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="tg-topic">';
      $tmpl_edit_data .= '<a href="javascript:;" class="show_specimen_type_btn">';
      $tmpl_edit_data .= '<div class="tg-catagorytopic tg-specimentype">';
      $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
      $tmpl_edit_data .= '<i class="lnr lnr-layers"></i>';
      $tmpl_edit_data .= '<div class="tg-catagorycontent">';
      $tmpl_edit_data .= '<h3>Specimen Type</h3>';
      $tmpl_edit_data .= '<span class="display_selected_option"></span>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<em>+</em>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</a>';
      $tmpl_edit_data .= '<div class="show-data-holder" style="background: #e74c3c;">';
      $tmpl_edit_data .= '<div class="show_specimen_type">';
      $tmpl_edit_data .= '<div class="show_clinic_title">';
      $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
      $tmpl_edit_data .= '<h4><i class="lnr lnr-layers"></i>Specimen Type</h4>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '<div class="input-scroll-holder">';
      $specimen_type_data = array(
        'gi' => 'GI',
        'skin' => 'Skin',
        'other' => 'Other'
      );
      foreach ($specimen_type_data as $key => $specimen_type) {
        $tmpl_edit_data .= '<div class="input-holder">';
        $tmpl_edit_data .= '<input class="specimen_type" data-specimentype="' . $specimen_type . '" type="radio" id="speci_type_' . $key . '" name="specimen_type" value="' . $key . '">';
        $tmpl_edit_data .= '<label for="speci_type_' . $key . '">' . $specimen_type . '</label>';
        $tmpl_edit_data .= '</div>';
      }
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</form>';
      $tmpl_edit_data .= '</div>';
      $tmpl_edit_data .= '</div>';
      $json['type'] = 'success';
      $json['tmpl_new_data'] = $tmpl_edit_data;
      $json['msg'] = 'Template Loaded';
      echo json_encode($json);
      die;
    }

    /**
     * Save Temp Data
     * @return string
     */
    public function save_new_track_temp_data() 
    {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        //debug($_POST);exit;
        // print_r($_POST); exit; 

      if (!empty($_POST)) {
        $pathologist = $this->input->post('pathologist_pop');
        $report_urgency = $this->input->post('report_urgency_pop');
        $specimen_type = $this->input->post('specimen_type_pop');
        $template_name = $this->input->post('template_name_pop');
        $clinician_pop = $this->input->post('clinician_pop');
        //$specimen_no = $this->input->post('specimen_no_new');
        $courier_no = $this->input->post('courier_no_pop');
        $batch_no = $this->input->post('batch_no_pop');
        $tCodeId = $this->input->post('tCodeId');
        $hospital_id = $this->input->post('hospital_id');
        $lab_name = $this->input->post('bookingin_lab_id');
        $speciality = $this->input->post('bookingin_sepciality_id');
        $specimen_no = $this->input->post('multiple');
        $department_no_pop = $this->input->post('department_no_pop');
        $specialties_no_pop = $this->input->post('specialties_no_pop');
        $category_no_pop = $this->input->post('category_no_pop');
        $specimen_no_pop = $this->input->post('specimen_no_pop');

        if ($this->input->post('edit_mod') == "add" && empty($this->input->post('template_id'))) {
                //Prepare Data for update
          $temp_data = array(
            'temp_assignee_id' => $user_id,
            'temp_hospital_user' => $hospital_group_id,
            'temp_clinic_user' => $clinician_pop,
            'temp_pathologist' => !empty($pathologist) ? $pathologist : '',
            'temp_report_urgency' => !empty($report_urgency) ? $report_urgency : '',
            'temp_skin_type' => !empty($specimen_type) ? $specimen_type : '',
            'temp_input_name' => !empty($template_name) ? $template_name : '',
            'specimen_no' => !empty($specimen_no) ? $specimen_no : '',
            'courier_no' => !empty($courier_no) ? $courier_no : '',
            'batch_no' => !empty($batch_no) ? $batch_no : '',
            'sep_t_codes' => (isset($tCodeId) && $tCodeId != "" ? $tCodeId : ''),
            'hospital_id' => ($hospital_id > 0 ? $hospital_id : ''),
            'speciality' => ($speciality > 0 ? $speciality : ''),
            'timestamp' => time()
          );
          $this->db->insert('uralensis_record_track_template', $temp_data);
		  $last_id = $this->db->insert_id();
		  $spe_type_array = array();
          for($i=0; $i< count($department_no_pop); $i++){
            $spe_type_array = array(
                              'temp_id'     =>$last_id,
                              'dep_id'     =>$department_no_pop[$i],
                              'spe_id'     =>$specialties_no_pop[$i],
                              'cate_id'     =>$category_no_pop[$i],
                              'spe_type'     =>$specimen_no_pop[$i],
                              'user_id'     =>$user_id
                                );
            $this->db->insert('template_specimen', $spe_type_array);
		  }
                // echo $this->db->last_query(); exit; 
          $json['type'] = 'success';
          $json['msg'] = 'Track Template Inserted successfully.';
          echo json_encode($json);
          die;
        } else {
                //Prepare Data for update
          $temp_data = array(
            'temp_assignee_id' => $user_id,
            'temp_hospital_user' => $hospital_group_id,
            'temp_clinic_user' => $this->input->post('clinician_pop'),
            'temp_pathologist' => !empty($this->input->post('pathologist_pop')) ? $this->input->post('pathologist_pop') : '',
            'temp_report_urgency' => !empty($this->input->post('report_urgency_pop')) ? $this->input->post('report_urgency_pop') : '',
            'temp_skin_type' => !empty($this->input->post('specimen_type_pop')) ? $this->input->post('specimen_type_pop') : '',
            'temp_input_name' => !empty($this->input->post('template_name_pop')) ? $this->input->post('template_name_pop') : '',
            'specimen_no' => !empty($this->input->post('specimen_no')) ? $this->input->post('specimen_no') : '',
            'courier_no' => !empty($this->input->post('courier_no_pop')) ? $this->input->post('courier_no_pop') : '',
            'batch_no' => !empty($this->input->post('batch_no_pop')) ? $this->input->post('batch_no_pop') : '',
            'timestamp' => time()
          );

          $update = updateRecord('uralensis_record_track_template', $temp_data, array('ura_rec_temp_id' => $this->input->post('template_id')));

          $json['type'] = 'success';
          $json['msg'] = 'Track Template updated successfully.';
          redirect('institute/bookingin', 'refresh');
          echo json_encode($json);
          die;
        }
      } else {
        $json['type'] = 'error';
        $json['msg'] = 'Something went wrong.';
        redirect('institute/bookingin', 'refresh');
        echo json_encode($json);
        die;
      }
    }

    /**
     * Get load template data tags
     *
     * @return void
     */
    public function get_load_template_data_tags() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $tags_data = '';
      $tags_edit_btn = '';
      if (!empty($_POST)) {
        $hospitalid = $this->input->post('hospitalid');
        $clinicid = $this->input->post('clinicid');
        $pathologist = $this->input->post('pathologist');
        $labname = $this->input->post('labname');
        $urgency = $this->input->post('urgency');
        $specimen_type = $this->input->post('speci');
        $templateid = $this->input->post('templateid');
        $get_hospital_name = $this->ion_auth->group($hospitalid)->row()->description;
        $hospital_name = !empty($get_hospital_name) ? $get_hospital_name : '';
            //  $clinic_user = $this->ion_auth->user($clinicid)->row()->username;
            //$doctor_name = $this->ion_auth->user($pathologist)->row()->username;
        $clinic_user = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username", "users", array("id" => $clinicid));
        $doctor_name = getRecords("AES_DECRYPT(username, '" . DATA_KEY . "') AS username", "users", array("id" => $pathologist));
        if (empty($doctor_name)) {
          $doctor_name[0] = new stdClass();
          $doctor_name[0]->username = 'Unassigned';
        }
            //$clinic_user = $clname[0]->
            //Get Lab name
        $get_lab_name = $this->db->select('description')->where('id', $labname)->get('groups')->row_array();
        $tags_data .= '<div class="tg-tagsholder">';
        $tags_data .= '<div class="tg-tagsactive"></div>';
        $tags_data .= '<ul class="tg-tagsarea template-tags-container" data-templateid="' . $templateid . '">';
        $tags_data .= '<li class="tg-clinic">';
        $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic: <em>' . $hospital_name . '</em><i>+</i></span></a>';
        $tags_data .= '</li>';
        $tags_data .= '<li class="tg-users">';
        $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic User: <em>' . ucwords($clinic_user[0]->username) . '</em><i>+</i></span></a>';
        $tags_data .= '</li>';
        $tags_data .= '<li class="tg-labs">';
        $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Lab: <em>' . ucwords($get_lab_name['description']) . '</em><i>+</i></span></a>';
        $tags_data .= '</li>';
        $tags_data .= '<li class="tg-pathologist">';
        $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Pathologist: <em>' . ucwords($doctor_name[0]->username) . '</em><i>+</i></span></a>';
        $tags_data .= ' </li>';
        $tags_data .= '<li class= "tg-urgency">';
        $tags_data .= '<a class="tg-tag" href = "javascript:;"><i class="fa fa-check"></i><span>Urgency: <em>' . ucwords($urgency) . ' </em><i>+</i></span></a>';
        $tags_data .= '</li>';
        $tags_data .= '<li class="tg-specimen">';
        $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Specimen Type: <em>' . ucwords($specimen_type) . ' </em><i>+</i></span></a>';
        $tags_data .= '</li>';
        $tags_data .= '</ul>';
        $tags_data .= '<div class="track_temp_edit_btn"><a class="tg-btntrackoption track_edit_template" href="javascript:;" data-templateid="' . $templateid . '" data-hospitalid="' . $hospitalid . '" data-clinicuserid="' . $clinicid . '" data-pathologist="' . $pathologist . '" data-labname="' . $labname . '" data-urgency="' . $urgency . '" data-specitype="' . $specimen_type . '"><span>Track Options Menu</span><i class="fa fa-pencil"></i></a></div>';
        $tags_data .= '</div>';
        $json['type'] = 'success';
        $json['tags_data'] = $tags_data;
        $json['msg'] = 'Template Loaded';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Edit track template
     *
     * @return void
     */
    public function load_track_edit_template_data() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $tmpl_edit_data = '';
      if (!empty($_POST)) {
        $template_id = $this->input->post('template_id');
        $hospitalid = $this->input->post('hospital_id');
        $clinicuserid = $this->input->post('clinic_userid');
        $pathologist = $this->input->post('pathologist');
        $labid = $this->input->post('labname');
        $urgency = $this->input->post('urgency');
        $specitype = $this->input->post('specitype');
        $doctor_list = $this->Institute_model->get_doctors();
        $lab_names = $this->Institute_model->get_lab_names();
        $get_lab_name = $this->db->select('description')->where('id', $labid)->get('groups')->row_array();
        $tmpl_edit_data .= '<div class="tg-catagoryhead">';
        $tmpl_edit_data .= '<h3>Track Options Menu</h3>';
        $tmpl_edit_data .= '<a class="tg-btnsave update-track-template" href="javascript:;"><i class="fa fa-save"></i></a>';
        $tmpl_edit_data .= '<a class="tg-btnacollapse collapse_temp_data_btn" href="javascript:;"><i class="fa fa-angle-up"></i></a>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="collapse_temp_data">';
        $tmpl_edit_data .= '<form class="form track_temp_edit_form">';
        $tmpl_edit_data .= '<div class="tg-topic">';
        $tmpl_edit_data .= '<a href="javascript:;" class="show_lab_btn">';
        $tmpl_edit_data .= '<div class="tg-catagorytopic tg-heartpuls">';
        $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .= '<i class="lnr lnr-heart-pulse"></i>';
        $tmpl_edit_data .= '<div class="tg-catagorycontent">';
        $tmpl_edit_data .= '<h3>Lab</h3>';
        $tmpl_edit_data .= '<span class="display_selected_option">' . $get_lab_name['description'] . '</span>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<em>+</em>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= ' </a>';
        $tmpl_edit_data .= '<div class="show-data-holder" style="background: #3498db;">';
        $tmpl_edit_data .= '<div class="show_labs">';
        $tmpl_edit_data .= '<div class="show_clinic_title">';
        $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .= '<h4><i class="lnr lnr-heart-pulse"></i>Lab</h4>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
        if (!empty($lab_names)) {
          foreach ($lab_names as $labs) {
            $checked = '';
            if ($labs['id'] === $labid) {
              $checked = 'checked';
            }
            $tmpl_edit_data .= '<div class="input-holder">';
            $tmpl_edit_data .= '<input ' . $checked . ' class="track_lab_name" data-labname="' . $labs['description'] . '" type="radio" id="lab_' . $labs['id'] . '" name="lab_name" value="' . $labs['id'] . '">';
            $tmpl_edit_data .= '<label for="lab_' . $labs['id'] . '">' . $labs['description'] . '</label>';
            $tmpl_edit_data .= '</div>';
          }
        }
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="tg-topic">';
        $tmpl_edit_data .= '<a href="javascript:;" class="show_pathologists_btn">';
        $tmpl_edit_data .= '<div class="tg-catagorytopic tg-pathologist">';
        $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .= '<i class="lnr lnr-heart"></i>';
        $tmpl_edit_data .= '<div class="tg-catagorycontent">';
        $tmpl_edit_data .= '<h3>Pathologist</h3>';
        $tmpl_edit_data .= '<span class="display_selected_option">' . $this->get_uralensis_username($pathologist) . '</span>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<em>+</em>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</a>';
        $tmpl_edit_data .= '<div class="show-data-holder" style="background: #9b59b6;">';
        $tmpl_edit_data .= '<div class="show_pathologists">';
        $tmpl_edit_data .= '<div class="show_clinic_title">';
        $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .= '<h4><i class="lnr lnr-heart"></i>Pathologist</h4>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
        if (!empty($doctor_list)) {
          foreach ($doctor_list as $doctor) {
            $checked = '';
            if ($doctor->id === $pathologist) {
              $checked = 'checked';
            }
            $tmpl_edit_data .= '<div class="input-holder">';
            $tmpl_edit_data .= '<input  ' . $checked . ' class="pathologist" type="radio" data-pathologist="' . $doctor->first_name . ' ' . $doctor->last_name . '" id="doctor_' . $doctor->id . '" name="pathologist" value="' . $doctor->id . '">';
            $tmpl_edit_data .= '<label for="doctor_' . $doctor->id . '">' . $doctor->first_name . ' ' . $doctor->last_name . '</label>';
            $tmpl_edit_data .= '</div>';
          }
        }
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="tg-topic">';
        $tmpl_edit_data .= '<a href="javascript:;" class="show_report_urgency_btn">';
        $tmpl_edit_data .= '<div class="tg-catagorytopic tg-urgency">';
        $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .= '<i class="lnr lnr-clock"></i>';
        $tmpl_edit_data .= '<div class="tg-catagorycontent">';
        $tmpl_edit_data .= '<h3>Report Urgency</h3>';
        $tmpl_edit_data .= '<span class="display_selected_option">' . ucwords($urgency) . '</span>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<em>+</em>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</a>';
        $tmpl_edit_data .= '<div class="show-data-holder" style="background: #e67e22;">';
        $tmpl_edit_data .= '<div class="show_report_urgency">';
        $tmpl_edit_data .= '<div class="show_clinic_title">';
        $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .= '<h4><i class="lnr lnr-clock"></i>Report Urgency</h4>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="input-scroll-holder">';
        $report_urgeny_data = array(
          'routine' => 'Routine',
          '2ww' => '2WW',
          'urgent' => 'Urgent',
        );
        foreach ($report_urgeny_data as $key => $report_urgency) {
          $checked = '';
          if ($key === $urgency) {
            $checked = 'checked';
          }
          $tmpl_edit_data .= '<div class="input-holder">';
          $tmpl_edit_data .= '<input ' . $checked . ' class="report_urgency" data-urgency="' . $report_urgency . '" type="radio" id="report_' . $key . '" name="report_urgency" value="' . $key . '">';
          $tmpl_edit_data .= '<label for="report_' . $key . '">' . $report_urgency . '</label>';
          $tmpl_edit_data .= '</div>';
        }
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="tg-topic">';
        $tmpl_edit_data .= '<a href="javascript:;" class="show_specimen_type_btn">';
        $tmpl_edit_data .= '<div class="tg-catagorytopic tg-specimentype">';
        $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .= '<i class="lnr lnr-layers"></i>';
        $tmpl_edit_data .= '<div class="tg-catagorycontent">';
        $tmpl_edit_data .= '<h3>Specimen Type</h3>';
        $tmpl_edit_data .= '<span class="display_selected_option">' . ucwords($specitype) . '</span>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<em>+</em>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</a>';
        $tmpl_edit_data .= '<div class="show-data-holder" style="background: #e74c3c;">';
        $tmpl_edit_data .= '<div class="show_specimen_type">';
        $tmpl_edit_data .= '<div class="show_clinic_title">';
        $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .= '<h4><i class="lnr lnr-layers"></i>Specimen Type</h4>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="input-scroll-holder">';
        $specimen_type_data = array(
          'gi' => 'GI',
          'skin' => 'Skin',
          'other' => 'Other'
        );
        foreach ($specimen_type_data as $key => $specimen_type) {
          $checked = '';
          if ($key === $specitype) {
            $checked = 'checked';
          }
          $tmpl_edit_data .= '<div class="input-holder">';
          $tmpl_edit_data .= '<input ' . $checked . ' class="specimen_type" data-specimentype="' . $specimen_type . '" type="radio" id="speci_type_' . $key . '" name="specimen_type" value="' . $key . '">';
          $tmpl_edit_data .= '<label for="speci_type_' . $key . '">' . $specimen_type . '</label>';
          $tmpl_edit_data .= '</div>';
        }
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<input class="temp_id" type="hidden" name="template_id" value="">';
        $tmpl_edit_data .= '</form>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $json['type'] = 'success';
        $json['tmpl_edit_data'] = $tmpl_edit_data;
        $json['msg'] = 'Template Loaded';

        header('Content-Type: application/json');
        echo json_encode($json, JSON_INVALID_UTF8_IGNORE);
        die;
      }
    }

    /**
     * Get User first and last name
     * @param int $user_id
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
     * Save Temp Data
     * @return string
     */
    public function update_track_edit_temp_data() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!empty($_POST)) {
        $template_id = $this->input->post('template_id');
        $clinic_users = $this->ion_auth->user()->row()->id;
        $hospital_user = $this->ion_auth->get_users_groups($clinic_users)->row()->id;
        $lab_name = $this->input->post('lab_name');
        $pathologist = $this->input->post('pathologist');
        $report_urgency = $this->input->post('report_urgency');
        $specimen_type = $this->input->post('specimen_type');
            //Prepare Data for update
        $temp_data = array(
          'temp_hospital_user' => !empty($hospital_user) ? $hospital_user : '',
          'temp_clinic_user' => !empty($clinic_users) ? $clinic_users : '',
          'temp_pathologist' => !empty($pathologist) ? $pathologist : '',
          'temp_lab_name' => !empty($lab_name) ? $lab_name : '',
          'temp_report_urgency' => !empty($report_urgency) ? $report_urgency : '',
          'temp_skin_type' => !empty($specimen_type) ? $specimen_type : ''
        );
        $this->db->where('ura_rec_temp_id', $template_id);
        $this->db->update('uralensis_record_track_template', $temp_data);
        $json['type'] = 'success';
        $json['msg'] = 'Track Template updated successfully.';
        echo json_encode($json);
        die;
      } else {
        $json['type'] = 'error';
        $json['msg'] = 'Something went wrong.';
        echo json_encode($json);
        die;
      }
    }

    public function getTCodes() {
      $getcodes = getRecords("code", "specialty_codes", array("specialty_id" => $this->input->post('specialty_id')));

      $html = '<select name="specimen_type_pop" id="specimen_type_pop" class="form-control select2">';

      foreach ($getcodes as $rec) {
        $html .= '<option value="' . $rec->code . '">' . $rec->code . '</option>';
      }

      $html .= '</select>';


      $json['type'] = 'success';
      $json['data'] = $html;
      $json['msg'] = 'Data is updated.';
      echo json_encode($json);
      die;
    }

    public function search_and_add_barcode_record_submit() {
      if (!$this->ion_auth->logged_in()) 
	  {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
        // 'barcode': barcode, 'nhs_number': nhs_number,'serial_number':serial_number,'clinic_txt':clinic_txt,'assessment_no':assessment_no,'hospital_no':hospital_no,'f_name':f_name,'sur_name':sur_name,'dob':dob,'age':age,'gender':gender,'emis_no':emis_no,'courier_no':courier_no,'batch_no':batch_no,'clinician_no':clinician_no,'location':location,'toDate':toDate,'Speciality':Speciality,'digino':digino,'urgency':urgency,'labdate':labdate,'rcpath':rcpath,'specimen_snomed_t':specimen_snomed_t,'specimen_diagnosis_description':specimen_diagnosis_description,'specimen_macroscopic_description':specimen_macroscopic_description,'request_id':request_id
      $record_edit_status = array(
        'patient_initial' => '',
        'f_name' => !empty($this->input->post('f_name')) ? $this->input->post('f_name') : '',
        'sur_name' => !empty($this->input->post('sur_name')) ? $this->input->post('sur_name') : '',
        'emis_number' => !empty($this->input->post('emis_no')) ? $this->input->post('emis_no') : '',
        'lab_number' => !empty($this->input->post('clinic_txt')) ? $this->input->post('clinic_txt') : '',
        'dob' => !empty($this->input->post('dob')) ? $this->input->post('dob') : '',
        'date_received_bylab' => !empty($this->input->post('labdate')) ? $this->input->post('labdate') : '',
        'date_sent_touralensis' => !empty($this->input->post('date_sent_touralensis')) ? $this->input->post('date_sent_touralensis') : '',
        'rec_by_doc_date' => 'no',
        'clrk' => 'no',
        'dermatological_surgeon' => 'no',
        'pci_number' => !empty($this->input->post('pci_number')) ? $this->input->post('pci_number') : '',
        'nhs_number' => !empty($this->input->post('nhs_number')) ? $this->input->post('nhs_number') : '',
        'lab_name' => !empty($this->input->post('clinician_no')) ? $this->input->post('clinician_no') : '',
        'gender' => !empty($this->input->post('gender')) ? $this->input->post('gender') : '',
        'date_taken' => time(),
        'report_urgency' => !empty($this->input->post('urgency')) ? $this->input->post('urgency') : '',
        'cases_category' => !empty($this->input->post('cases_category')) ? $this->input->post('cases_category') : ''
      );
        $hospital_id = 117; //Only for norkfolk it will runn
        if (!isset($key)) {
          $key = '';
        }
        $request = array(
          'patient_initial' => '',
          'f_name' => !empty($this->input->post('f_name')) ? $this->input->post('f_name') : '',
          'sur_name' => !empty($this->input->post('sur_name')) ? $this->input->post('sur_name') : '',
          'emis_number' => !empty($this->input->post('emis_no')) ? $this->input->post('emis_no') : '',
          'lab_number' => !empty($this->input->post('clinic_txt')) ? $this->input->post('clinic_txt') : '',
          'dob' => !empty($this->input->post('dob')) ? $this->input->post('dob') : '',
          'serial_number' => $key,
          'ura_barcode_no' => !empty($this->input->post('barcode')) ? $this->input->post('barcode') : '',
          'hospital_group_id' => $hospital_id,
          'report_urgency' => !empty($urgency) ? $urgency : '',
          'lab_name' => !empty($clinician_no) ? $clinician_no : '',
          'status' => intval(0),
          'request_code_status' => 'new',
          'record_edit_status' => serialize($record_edit_status),
          'request_add_user' => $user_id,
          'request_add_user_timestamp' => time()
        );
        $update = updateRecord("request", $request, array('uralensis_request_id' => $this->input->post('request_id')));
        $specimen = array(
          'specimen_site' => '',
          'specimen_procedure' => '',
          'specimen_type' => !empty($speci_type) ? $speci_type : '',
          'specimen_block' => !empty($this->input->post('specimen_block')) ? $this->input->post('specimen_block') : '',
          'specimen_slides' => !empty($this->input->post('pci_number')) ? $this->input->post('pci_number') : '',
          'specimen_block_type' => !empty($this->input->post('specimen_block_type')) ? $this->input->post('specimen_block_type') : '',
          'specimen_macroscopic_description' => !empty($this->input->post('specimen_macroscopic_description')) ? $this->input->post('specimen_macroscopic_description') : '',
          'specimen_diagnosis_description' => !empty($this->input->post('specimen_diagnosis_description')) ? $this->input->post('specimen_diagnosis_description') : '',
          'specimen_cancer_register' => '',
          'specimen_rcpath_code' => !empty($this->input->post('specimen_rcpath_code')) ? $this->input->post('specimen_rcpath_code') : '',
          'specimen_diagnosis_code' => !empty($this->input->post('specimen_diagnosis_code')) ? $this->input->post('specimen_diagnosis_code') : '',
          'specimen_snomed_t' => !empty($this->input->post('specimen_snomed_t')) ? $this->input->post('specimen_snomed_t') : ''
        );
        $update2 = updateRecord("specimen", $specimen, array('request_id' => $this->input->post('request_id')));
        $json['type'] = 'success';
        $json['msg'] = 'Data is updated.';
        echo json_encode($json);
        die;
      }

      public function deletespeciment() {
        if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
        }

        $delete = $this->Institute_model->deleteSpeciment($this->input->post('specimen_id'));
        if ($delete) {
          $json['type'] = 'success';
          $json['msg'] = 'Specimen is deleted.';
          echo json_encode($json);
          die;
        }
      }

      public function AddSubmitSpecimenHospital() {
        if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
        }

        $updatequery = array(
          "speciality_id" => $this->input->post('speciality_list'),
          "blockDetail" => $this->input->post('block_detail'),
          "specimen_diagnosis_description" => $this->input->post('specimen_diagnosis_description'),
          "specimen_microscopic_description" => $this->input->post('specimen_microscopic_description'),
          "specimen_snomed_p" => $this->input->post('specimen_snomed_p'),
          "specimen_snomed_t" => $this->input->post('specimen_snomed_t'),
          "numberOfBlocks" => $this->input->post('numberOfBlocks'),
          "request_id" => $this->input->post('request_id_addspeciment'),
          "specimen_rcpath_code" => $this->input->post('specimen_rcpath_code')
        );

        $update = insertRecord("specimen", $updatequery);
        $json['type'] = 'success';
        $json['msg'] = 'Specimen is added.';
        echo json_encode($json);
        die;
      }

      public function SubmitSpecimenHospital($specimentid) {
        if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
        }

        $updatequery = array(
          "speciality_id" => $this->input->post('speciality_list'),
          "blockDetail" => $this->input->post('block_detail'),
          "specimen_diagnosis_description" => $this->input->post('specimen_diagnosis_description'),
          "specimen_microscopic_description" => $this->input->post('specimen_microscopic_description'),
          "specimen_snomed_p" => $this->input->post('specimen_snomed_p'),
          "specimen_snomed_t" => $this->input->post('specimen_snomed_t'),
          "numberOfBlocks" => $this->input->post('numberOfBlocks'),
          "specimen_rcpath_code" => $this->input->post('specimen_rcpath_code')
        );

        $update = updateRecord("specimen", $updatequery, array('specimen_id' => $specimentid));

        $json['type'] = 'success';
        $json['msg'] = 'Specimen is updated.';
        echo json_encode($json);
        die;
      }

      public function search_and_add_barcode_record_new() {
        if (!$this->ion_auth->logged_in()) {
          redirect('auth/login', 'refresh');
        }
        $search_term = $this->input->post('barcode');
        $template_id = $this->input->post('template_id');
        $specimen_no_pre = $this->input->post('specimen_no_pre');
        $user_id = $this->ion_auth->user()->row()->id;
        $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $json = array();
        $encode = '';
        if (isset($_POST) && $_POST['search_type'] === 'only_search') {
          $this->db->select('*');
          $this->db->from('request');
          $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
          $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
          $this->db->where('users_request.group_id', $group_id);
          $this->db->where('ura_barcode_no', $search_term);
          $query = $this->db->get()->row_array();
          $innerjoin = array("specialties" => "specialties.id=specimen.speciality_id");

          $specimen = getRecords("*", "specimen", array("request_id" => $query['request_id']), "", "", $innerjoin);
          $specialitylist = getRecords("*", "specialties");

          $specilist = '<select name="speciality_list" id="speciality_list" class="form-control select2">';
          foreach ($specialitylist as $myrec) {
            $specilist .= ' <option value="' . $myrec->id . '">' . $myrec->specialty . '</option>';
          }
          $specilist .= '</select>';


            //Get the doctor id
          $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];
          if (!empty($query)) {
            $specmen = '<ul class="nav nav-tabs nav-tabs-solid specimen_tabs pull-right">';

            $number = 1;
            $spechtml = '';
            $specimentDetails = '';

            $snomed_p_array = getSnomedCodes('p');
            $snomed_t_array = getSnomedCodes('t1');

            foreach ($specimen as $rec) {
              $snomedhtml = '';
              $snomed_thtml = '';

              $snomedhtml = '<select name="specimen_snomed_p" id="specimen_snomed_p" class="form-control  input-lg select2">
              <option value="" data-hidden="true" selected>P Code</option>';

              foreach ($snomed_p_array as $snomed_p_code) {
                $selected = '';

                $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                if ($rec->specimen_snomed_p == $snomed_p) {
                  $selected = 'selected="selected"';
                }
                $snomedhtml .= '<option data-pdesc="' . $snomed_p_code['usmdcode_code_desc'] . '" value="' . $snomed_p . '" ' . $selected . '>' . $snomed_p_code['usmdcode_code'] . '</option>';
              }

              $snomedhtml .= '</select>';
              $snomed_thtml = '<select name="specimen_snomed_t" id="specimen_snomed_t"  class="form-control  input-lg select2">
              <option value="" data-hidden="true" selected>T1 Code</option>';

              foreach ($snomed_t_array as $snomed_t_code) {
                $selected = '';
                $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));

                if ($rec->specimen_snomed_t == $snomed_t) {
                  $selected = 'selected="selected"';
                }
                $snomed_thtml .= '<option data-tdesc="' . $snomed_t_code['usmdcode_code_desc'] . '" value="' . $snomed_t . '" ' . $selected . '>' . $snomed_t_code['usmdcode_code'] . '</option>';
              }

              $snomed_thtml .= '</select>';

              $specmen .= '<li class="nav-item spec_buttons"><a class="nav-link" href="#specimen' . $number . '" data-toggle="tab">Specimen ' . $number . '</a>
              <div class="dropdown dropdown-action active">
              <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
              <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#add_specimen_div"><i class="fa fa-plus m-r-5"></i> Add</a>
              <a class="dropdown-item" href="javascript:" onClick="deletespeciment(' . $rec->specimen_id . ')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
              </div>
              </div>
              </li>';

              $specimentDetails .= '<form id="edit_form_' . $rec->specimen_id . '" action="' . base_url() . 'index.php/institute/SubmitSpecimenHospital/' . $rec->specimen_id . '" method="post"><div id="edit_specimen_' . $number . '" class="modal custom-modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title">Edit Specimen</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
              <div class="row">
              <div class="form-group col-md-12">

              <label class="focus-label">Specialty</label>
              ' . $specilist . '
              </div>
              <div class="form-group col-md-12">
              <div class="newforms ">
              <label class="focus-label">Block Details</label>
              <input name="block_detail" id="block_detail" class="form-control input-lg " type="text" value="' . $rec->blockDetail . '">
              </div>

              </div>
              <div class="form-group col-md-12">
              <div class="doctorSCard d-block">
              <div class="input-group">
              <span class="input-group-text" id="basic-addon1">
              <label class="focus-label">Clinical</label>
              <img src="' . base_url() . 'assets/institute/img/iconBtn.png" align="btn">
              </span>
              <input class="form-control" list="desc">
              <datalist id="desc">
              <option value="Clinical 1">
              </option>
              <option value="Clinical 2">
              </option>
              <option value="Clinical 3">
              </option>
              <option value="Clinical 4">
              </option>
              <option value="Clinical 5">
              </option>
              </datalist>
              </div>
              <textarea class="form-control" name="specimen_diagnosis_description" id="specimen_diagnosis_description">' . $rec->specimen_diagnosis_description . '</textarea>
              </div>                                       
              </div>
              <div class="form-group col-md-12">
              <div class="doctorSCard d-block">
              <div class="input-group">
              <span class="input-group-text" id="basic-addon1">
              <label class="focus-label">Microscopic</label>
              <img src="' . base_url() . 'assets/institute/img/iconBtn.png" align="btn">
              </span>
              <input class="form-control" list="desc">
              <datalist id="desc">
              <option value="Microscopic 1">
              </option>
              <option value="Microscopic 2">
              </option>
              <option value="Microscopic 3">
              </option>
              <option value="Microscopic 4">
              </option>
              <option value="Microscopic 5">
              </option>
              </datalist>
              </div>
              <textarea class="form-control" name="specimen_microscopic_description" id="specimen_microscopic_description">' . $rec->specimen_microscopic_description . '</textarea>
              </div>                                       
              </div>
              <div class="form-group col-md-12">
              <div class="row">
              <div class="form-group col-md-6">
              <div class="newforms ">
              <label class="focus-label">P Code</label>
              ' . $snomedhtml . '
              </div>
              </div>

              <div class="form-group col-md-6">
              <div class="newforms ">
              <label class="focus-label">T Code</label>
              ' . $snomed_thtml . '
              </div>
              </div>
              </div>
              </div>
              <div class="form-group col-md-12">
              <div class="row">
              <div class="form-group col-md-6">
              <div class="newforms ">
              <label class="focus-label">No. of Blocks</label>
              <input name="numberOfBlocks" id="numberOfBlocks" class="form-control input-lg " type="text" value="' . $rec->numberOfBlocks . '">
              </div>
              </div>

              <div class="form-group col-md-6">
              <div class="newforms ">
              <label class="focus-label">RCPath Score</label>
              <input name="specimen_rcpath_code" id="specimen_rcpath_code" class="form-control input-lg " type="text" value="' . $rec->specimen_rcpath_code . '">
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
              <button class="btn btn-info btn-lg btn-rounded btn-save updateSpec" id="updateSpec_' . $rec->specimen_id . '">Save</button>
              </div>
              </div>
              </div>
              </div></form>';


              $spechtml .= '<div class="tab-pane fade" id="specimen' . $number . '">
              <div class="card profile-box flex-fill">
              <div class="card-body">
              <h3 class="card-title">Specimen ' . $number . ' <a href="#" class="edit-icon" data-toggle="modal" data-target="#edit_specimen_' . $number . '"><i class="fa fa-pencil"></i></a></h3>
              <ul class="personal-info new_personal-info">
              <li>
              <div class="title">Specialty</div>
              <div class="text">' . $rec->specialty . '</div>
              </li>
              <!--  <li>
              <div class="title">POT Label</div>
              <div class="text">Left inner canthus, C+C.</div>
              </li>-->
              <li>
              <div class="title">Clinical Description</div>
              <div class="text">' . $rec->specimen_diagnosis_description . '</div>
              </li>
              <li>
              <div class="title">Microscopic Description</div>
              <div class="text">' . $rec->specimen_microscopic_description . '</div>
              </li>
              <li>
              <div class="title">Block Details</div>
              <div class="text">' . $rec->blockDetail . '
              <!-- <ul class="list-unstyled">
              <li>A1: Ends</li>
              <li>A2 Middles</li>
              <li>A3 Pigmented lesion</li>
              </ul>-->
              </div>
              </li>
              <li>
              <ul class="list-inline">
              <li class="list_view">
              <div class="title">P Code.</div>
              <div class="text">' . $rec->specimen_snomed_p . '</div>
              </li>
              <li class="list_view">
              <div class="title">T Code.</div>
              <div class="text">' . $rec->specimen_snomed_t . '</div>
              </li>
              <li class="list_view">
              <div class="title">No. of Slides</div>
              <div class="text"><a href="">' . $rec->numberOfSlides . '</a></div>
              </li>
              <li class="list_view">
              <div class="title">No. of Blocks</div>
              <div class="text">' . $rec->numberOfBlocks . '</div>
              </li>
              <li  class="list_view">
              <div class="title">RCPath Score</div>
              <div class="text">' . $rec->specimen_rcpath_code . '</div>
              </li>
              </ul>
              </li>
              </ul>
              </div>
              </div>
              </div>';

              $number = $number + 1;
            }
            $specmen .= '</ul>';

            $f_initial = '';
            $l_initial = '';
            if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->first_initial)) {
              $f_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->first_initial;
            }
            if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->last_initial)) {
              $l_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->last_initial;
            }

            $mdata = ' <table class="table table-striped custom-table datatable" id="booking_in_list">
            <thead>
            <tr>
            <th>UL No.</th>
            <th>Track No.</th>
            <th>Client</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>DOB</th>
            <th>NHS No.</th>
            <th>Lab No.</th>
            <th>Urgency</th>
            <th><img data-toggle="tooltip" title="" src="' . base_url() . 'assets/icons/flag-skyblue.png" class="img-responsive" data-original-title="Flag" aria-describedby="tooltip656672"></th>
            <th><img data-toggle="tooltip" title="" src="' . base_url() . 'assets/icons/Comments.png" class="img-responsive" data-original-title="Comments" aria-describedby="tooltip157063"></th>
            <th>Status</th>
            <th class="text-right">
            <img src="' . base_url() . 'assets/icons/Actions-Blue.png" class="img-responsive pull-right">
            </th>
            </tr>
            </thead> <tbody>';

            $mdata .= '<tr>
            <td>' . $query['serial_number'] . '</td>
            <td>' . $query['ura_barcode_no'] . '</td>
            <td>' . $f_initial . " " . $l_initial . '</td>
            <td>' . $query['f_name'] . '</td>
            <td>' . $query['sur_name'] . '</td>
            <td>' . date('d-m-Y', strtotime($query['dob'])) . '</td>
            <td>' . $query['nhs_number'] . '</td>
            <td>' . $query['lab_number'] . '</td>
            <td>' . ucwords(substr($query['report_urgency'], 0, 1)) . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">
            <div class="dropdown dropdown-action">
            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="' . base_url() . 'index.php/doctor/doctor_record_detail/43843"><i class="fa fa-pencil m-r-5"></i> Edit</a>
            <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
            <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
            </div>
            </div>
            </td>
            </tr> </tbody>
            </table>';


            $json['type'] = 'success';
            $json['msg'] = 'Data is available.';
            $json['data'] = $query;
            $json['mdata'] = $mdata;
            $json['specmen'] = $specmen;
            $json['spechtml'] = $spechtml;
            $json['specimentDetails'] = $specimentDetails;
            echo json_encode($json);
            die;
          } else {
                //if we want to add ulnumber
            $template_data = $this->db->where('ura_rec_temp_id', $template_id)->get('uralensis_record_track_template')->row_array();

            $hospital_id = '';
            $clinic_user_id = '';
            $pathologist_id = '';
            $lab_id = '';
            $urgency = '';
            $speci_type = '';
            if (!empty($template_data)) {
              $hospital_id = $template_data['temp_hospital_user'];
              $clinic_user_id = $template_data['temp_clinic_user'];
              $pathologist_id = $template_data['temp_pathologist'];
              $lab_id = $template_data['temp_lab_name'];
              $urgency = $template_data['temp_report_urgency'];
              $speci_type = $template_data['temp_skin_type'];
            }
            $user_id = $this->ion_auth->user()->row()->id;
            $get_lab_name = $this->db->select('name')->where('id', $lab_id)->get('groups')->row_array();


                //debug( $get_lab_name);exit;
            $lab_name = '';
            if (!empty($get_lab_name)) {
              $lab_name = $get_lab_name['name'];
            }
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
            } else if ($serial_query->num_rows() < 0) {
              $key = 'UL-' . date('y') . '-1';
            } else {
              $key = 'UL-' . date('y') . '-1';
            }

            $record_edit_status = array(
              'patient_initial' => 'no',
              'f_name' => 'no',
              'sur_name' => 'no',
              'emis_number' => 'no',
              'lab_number' => 'no',
              'dob' => 'no',
              'date_received_bylab' => 'no',
              'date_sent_touralensis' => 'no',
              'rec_by_doc_date' => 'no',
              'clrk' => 'no',
              'dermatological_surgeon' => 'no',
              'pci_number' => 'no',
              'nhs_number' => 'no',
              'lab_name' => 'no',
              'gender' => 'no',
              'date_taken' => 'no',
              'report_urgency' => 'no',
              'cases_category' => 'no'
            );
                $hospital_id = $hospital_id; //Only for norkfolk it will runn
                $request = array(
                  'serial_number' => $key,
                  'ura_barcode_no' => $search_term,
                  'hospital_group_id' => $hospital_id,
                  'report_urgency' => !empty($urgency) ? $urgency : '',
                  'lab_name' => !empty($lab_name) ? $lab_name : '',
                  'status' => intval(0),
                  'request_code_status' => 'new',
                  'record_edit_status' => serialize($record_edit_status),
                  'request_add_user' => $user_id,
                  'request_add_user_timestamp' => time()
                );
                $this->Institute_model->institute_insert($request);

                $record_last_id = $this->db->insert_id();

                for ($i = 1; $i <= $specimen_no_pre; $i++) {
                  $specimen = array(
                    'request_id' => $record_last_id,
                    'specimen_site' => '',
                    'specimen_procedure' => '',
                    'specimen_type' => !empty($speci_type) ? $speci_type : '',
                    'specimen_block' => '',
                    'specimen_slides' => '',
                    'specimen_block_type' => '',
                    'specimen_macroscopic_description' => '',
                    'specimen_diagnosis_description' => '',
                    'specimen_cancer_register' => '',
                    'specimen_rcpath_code' => ''
                  );
                  $this->db->insert('specimen', $specimen);
                }

                $specimen_id = $this->db->insert_id();
                $data = array('rs_request_id' => $record_last_id, 'rs_specimen_id' => $specimen_id);
                $this->db->insert('request_specimen', $data);
                $record_session_val = $this->session->userdata('record_ids', $record_last_id);
                $record_session_val[] = $record_last_id;
                $this->session->set_userdata('record_ids', $record_session_val);
                $session_record_data = $this->session->userdata('record_ids');
                //debug($session_record_data);
                $user_req_data = array(
                  'request_id' => $record_last_id,
                  'users_id' => $user_id,
                  'group_id' => $hospital_id
                );
                $this->db->insert("users_request", $user_req_data);
                $request_assign = array(
                  'request_id' => $record_last_id,
                  'user_id' => $user_id,
                );
                $this->db->insert("request_assignee", $request_assign);
                $assign_request_args = array(
                  'assign_status' => intval(1),
                  'report_status' => intval(1),
                  'request_code_status' => 'assign_doctor',
                  'request_assign_status' => intval(1)
                );
                $this->db->where('uralensis_request_id', $record_last_id);
                $this->db->update("request", $assign_request_args);
                $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_last_id)->get('request_assignee')->row_array();
                if (empty($check_assign_stat)) {
                  $pathologist_status = 'Not Assigned';
                } else {
                  $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                  $pathologist_status = $pathologist_name;
                }
                //$status_code we need to set later
                $track_status_data = array(
                  'ura_rec_track_no' => $search_term,
                  'ura_rec_track_location' => $lab_name,
                  'ura_rec_track_record_id' => intval($record_last_id),
                  'ura_rec_track_status' => 0,
                  'ura_rec_track_pathologist' => $pathologist_status,
                  'timestamp' => time()
                );
                $this->db->insert('uralensis_record_track_status', $track_status_data);
                $this->db->select('uralensis_request_id');
                $this->db->from('request');
                $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                $this->db->where('users_request.group_id', $group_id);
                $this->db->where('ura_barcode_no', $search_term);
                $query = $this->db->get()->row_array();

                $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];

                if (!empty($session_record_data)) {
                  $check_record = array();
                  foreach ($session_record_data as $ids) {
                    if (!empty($ids)) {
                      $this->db->select('*');
                      $this->db->from('request');
                      $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                      $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                      $this->db->where('users_request.group_id', $group_id);
                      $this->db->where('uralensis_request_id', $ids);
                      $check_record[] = $this->db->get()->row_array();
                      $record_data = array_filter($check_record);
                    }
                  }
                }

                //Get all records ids from record_data
                $record_ids_data = array();
                if (!empty($record_data)) {
                  $record_ids_data = array();
                  foreach ($record_data as $recordids) {
                    $record_ids_data[] = $recordids['uralensis_request_id'];
                  }
                }
                $this->session->set_userdata('session_records', $record_ids_data);
                $this->db->select('*');
                $this->db->from('request');
                $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                $this->db->where('users_request.group_id', $group_id);
                $this->db->where('ura_barcode_no', $search_term);
                $query = $this->db->get()->row_array();

                $specimen = getRecords("*", "specimen", array("request_id" => $query['request_id']));

                //Get the doctor id
                $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];
                if (empty($rec)) {
                  $rec = array('dob' => '', 'report_urgency' => 0);
                }
                if (!empty($query)) {


                  $f_initial = '';
                  $l_initial = '';

                  if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->first_initial)) {
                    $f_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->first_initial;
                  }
                  if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->last_initial)) {
                    $l_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->last_initial;
                  }

                  $mdata = ' <table class="table table-striped custom-table datatable" id="booking_in_list">
                  <thead>
                  <tr>
                  <th>UL No.</th>
                  <th>Track No.</th>
                  <th>Client</th>
                  <th>First Name</th>
                  <th>Surname</th>
                  <th>DOB</th>
                  <th>NHS No.</th>
                  <th>Lab No.</th>
                  <th>Urgency</th>
                  <th><img data-toggle="tooltip" title="" src="' . base_url() . 'assets/icons/flag-skyblue.png" class="img-responsive" data-original-title="Flag" aria-describedby="tooltip656672"></th>
                  <th><img data-toggle="tooltip" title="" src="' . base_url() . 'assets/icons/Comments.png" class="img-responsive" data-original-title="Comments" aria-describedby="tooltip157063"></th>
                  <th>Status</th>
                  <th class="text-right">
                  <img src="' . base_url() . 'assets/icons/Actions-Blue.png" class="img-responsive pull-right">
                  </th>
                  </tr>
                  </thead> <tbody>';
                  $mdata .= '<tr>
                  <td>' . $query['serial_number'] . '</td>
                  <td>' . $query['ura_barcode_no'] . '</td>
                  <td>' . $f_initial . " " . $l_initial . '</td>
                  <td>' . $query['f_name'] . '</td>
                  <td>' . $query['sur_name'] . '</td>
                  <td>' . date('d-m-Y', strtotime($rec['dob'])) . '</td>
                  <td>' . $query['nhs_number'] . '</td>
                  <td>' . $query['lab_number'] . '</td>
                  <td>' . ucwords(substr($rec['report_urgency'], 0, 1)) . '</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-right">
                  <div class="dropdown dropdown-action">
                  <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="' . base_url() . 'index.php/doctor/doctor_record_detail/43843"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                  </div>
                  </div>
                  </td>
                  </tr> </tbody>
                  </table>';
                  $json['type'] = 'success';
                  $json['msg'] = 'Data is available.';
                  $json['data'] = $query;
                  $json['mdata'] = $mdata;
                  $json['specimen'] = $specimen;
                  echo json_encode($json);
                  die;
                  $json['type'] = 'success';
                  $json['msg'] = 'Data is available.';
                  $json['data'] = $query;
                  echo json_encode($json);
                  die;
                }
              }
            }
          }

          public function add_patient_record() 
		  {
		  if (!in_array($this->group_type, ['A','HA', 'H', 'L','LA'])) 
		  {
              $this->output
              ->set_status_header(405)
              ->set_output("Not Authorized");
              return;
            }
            $this->load->model('PatientModel', 'patient');
            $this->load->model('DepartmentModel', 'department');
            $pid = $this->input->post('patient_id');
			 $tem_id=$this->input->post('tem_id');
			 $courier_id=$this->input->post('courier_id');
           // echo $pid; exit;
            custom_log($_POST);
            if (empty($pid) || !is_numeric($pid)) {
              $this->output->set_status_header(404)->set_output("Patient ID is missing or invalid");
            }
            custom_log($pid, "patient id");

           // $temp_details=$this->Institute_model->get_track_record_templates_by_id($tem_id);

            $patient = $this->patient->get_patient_data($pid);
            $status_code = $this->input->post('status_code');
            $is_admin = $this->ion_auth->in_group('admin');
            $lab_id = $this->input->post('lab_id');
			$tem_id = $this->input->post('tem_id');
			if($tem_id!='')
			{
			$tem_query = $this->db->query("SELECT * FROM uralensis_record_track_template where ura_rec_temp_id='$tem_id'");
			foreach ($tem_query->result() as $row)
			{
				 $hospital_userid=$row->temp_hospital_user;
				 $clinic_id=$row->temp_clinic_user;
				 $pathologist_id=$row->temp_pathologist;
				 $lab_name=$row->temp_lab_name;
				 $specialty_id=$row->speciality;
				 $spec_name=$row->specimen_no;
				 $courier_no=$row->courier_no;
				 $batch_no=$row->batch_no;
				 $temphospital_id=$row->hospital_id;
				 $lab_no=$row->lab_no;
				 $num_Spno=$row->speciman_no;
				 $dermatological_surgeon=$row->temp_clinic_user;
			}
			$temphospital_id = $temphospital_id;	
			$doctor_id= $pathologist_id;	
			}
            //$specialty_id = $this->input->post('speciality_id');
            $user_id = $this->ion_auth->user()->row()->id;
			if($doctor_id!='')
			{
				$ass_status=1;
			}
			else
			{
				$ass_status=0;
			}
            //$hospital_id = 90;
           // $hospital_id = 9;
            if ($this->group_type === 'H') 
			{
              $hospital_id = $this->group_id;
			  $lab_id=$lab_id;
            }
			if(in_array($this->group_type,LAB_GROUP))
			{
				$hospital_id = $temphospital_id;
				$lab_id=114;
			}
            $get_serial_number = $this->db->query("SELECT * FROM request ORDER BY uralensis_request_id DESC LIMIT 1")->row_array();
            if ($get_serial_number == '') 
			{
              $req_id_before_insert = 1;
            } 
			else 
			{
              $req_id_before_insert = $get_serial_number['uralensis_request_id'];
            }
            $serial_query = $this->db->query("SELECT serial_number FROM request WHERE uralensis_request_id = $req_id_before_insert");
            if ($serial_query->num_rows() > 0) {
              $row = $serial_query->row();
              $last_inserted_serial_number = $row->serial_number;
              $keyParts = explode('.', $last_inserted_serial_number);
              if ($keyParts[1] == date('y')) 
			  {
                $key = $keyParts[0] . "." . $keyParts[1] . ".00" . ($keyParts[2] + 1);
              } else {
                $key = $keyParts[0] . "." . date("y") . "001";
              }
            } else if ($serial_query->num_rows() < 0) {
              $key = 'PB.' . date('y') . '.00' . '1';
            } else {
              $key = 'PB.' . date('y') . '.00' . '1';
            }
            $initial = '';
            if (!empty($patient['first_name']) && strlen($patient['first_name']) > 0) {
              $initial .= $patient['first_name'][0];
            }
            if (!empty($patient['last_name']) && strlen($patient['last_name']) > 0) {
              $initial .= $patient['last_name'][0];
            }
            $get_lab_name = $this->db->select('name, description')->where('id', $lab_id)->get('groups')->row_array();
            $lab_name = '';
            if (!empty($get_lab_name)) {
              $lab_name = $get_lab_name['description'];
            }
			else
			{
				$lab_name ='Poundbury Cancer Institute';
			}
			$lab_no=uniqid(rand(0,10));
            $record_edit_status = array(
              'patient_initial' => $initial,
              'f_name' => $patient['first_name'],
              'sur_name' => $patient['last_name'],
              'emis_number' => 'no',
              'lab_number' => $lab_no,
              'dob' => $patient['dob'],
              'date_received_bylab' => 'no',
              'date_sent_touralensis' => 'no',
              'rec_by_doc_date' => 'no',
              'clrk' => 'no',              
			  'ura_barcode_no' => $lab_no,
              'pci_number' => 'PCI-22-001',
              'nhs_number' => $patient['nhs_number'],
              'lab_name' => $lab_name,
              'gender' => $patient['gender'],
              'date_taken' => 'no',
              'report_urgency' => 'no',
              'cases_category' => 'no'
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
            $today = new DateTime();
            $dob_obj = date_create($patient['dob']);
            $diff = $today->diff($dob_obj);
            $age = $diff->y;
			$lab_no="PB22-".rand(10000,99999);
			$bat_no=rand(10000,99999);	
			$pic_no='PB22'.rand(1000,99999);		
			$lab_name ='';
            $request = array(
              'serial_number' => $key,
              'hospital_group_id' => $temphospital_id,
              'lab_name' => $lab_name,
			  'lab_number' => $lab_no,
              'status' => intval(0),
              'request_code_status' => 'new',
              'record_edit_status' => serialize($record_edit_status),
              'request_add_user' => $user_id,
			  'ura_barcode_no' => $lab_no,
              'request_add_user_timestamp' => time(),
              'request_type' => $r_type,
              'speciality_group_id' => $specialty_id,
			  'record_batch_id' => $bat_no,
              'patient_initial' => $initial,
			  'pci_number' => $pic_no,
			  'patient_id' => $pid,
			  'nhs_number' => $patient['nhs_number'],
			  'report_urgency' => 'Routine',
			  'request_type' => $r_type,
			  'location' => $patient['address_1'],
			  'lab_id' => $lab_id,
			  'template_id' => $tem_id,
			  'dermatological_surgeon' => $dermatological_surgeon,
			  'speciman_no' => '1',
              'f_name' => $patient['first_name'],
              'sur_name' => $patient['last_name'],
              'dob' => $patient['dob'],
              'age' => $age,
              'emis_number' => $courier_id,
              'gender' => $patient['gender'],
            );
            $this->Institute_model->institute_insert($request);
            $record_last_id = $this->db->insert_id();
			$specimen = array(
              'request_id' => $record_last_id,
              'specimen_site' => '',
              'specimen_procedure' => '',
              'specimen_type' => '',
              'specimen_block' => '1',
              'specimen_slides' => '1',
              'specimen_block_type' => '',
              'specimen_macroscopic_description' => 'Specimen Macroscopic Description',
              'specimen_diagnosis_description' => 'Specimen Diagnosis Description',
              'specimen_cancer_register' => '',
              'specimen_rcpath_code' => ''
            );
			if($num_Spno>0)
			{
								for($i=0;$i<$num_Spno;$i++)
				{
            $this->db->insert('specimen', $specimen);
				}

			}
		else
			{
				$this->db->insert('specimen', $specimen);
			}
			
            
            $specimen_id = $this->db->insert_id();
			
			$blocks_data = array('specimen_id' => $specimen_id, 'specimen_no' => 1,'block_no' => 1,'description' => 'HE');
            $this->db->insert('specimen_blocks', $blocks_data);
			
            $data = array('rs_request_id' => $record_last_id, 'rs_specimen_id' => $specimen_id);
            $this->db->insert('request_specimen', $data);
            $record_session_val = $this->session->userdata('record_ids', $record_last_id);
            $record_session_val[] = $record_last_id;
            $this->session->set_userdata('record_ids', $record_session_val);
            $session_record_data = $this->session->userdata('record_ids');
            $user_req_data = array(
              'request_id' => $record_last_id,
              'users_id' => $user_id,
			  'doctor_id' => $doctor_id,
              'group_id' => $hospital_id
            );
            $this->db->insert("users_request", $user_req_data);
			
            $request_assign = array(
              'request_id' => $record_last_id,
              'user_id' => $doctor_id,
			  'assign_status' => $ass_status,
            );
            $this->db->insert("request_assignee", $request_assign);
            $assign_request_args = array(
              'assign_status' => intval(0),
              'report_status' => intval(1),
              'request_code_status' => '',
              'request_assign_status' => $ass_status
            );
            $this->db->where('uralensis_request_id', $record_last_id);
            $this->db->update("request", $assign_request_args);
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_last_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) 
			{
              $pathologist_status = 'Not Assigned';
            } else {
              $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
              $pathologist_status = $pathologist_name;
            }
            $track_status_data = array(
              'ura_rec_track_no' => '',
              'ura_rec_track_location' => $lab_name,
              'ura_rec_track_record_id' => intval($record_last_id),
              'ura_rec_track_status' => $status_code,
              'ura_rec_track_pathologist' => $pathologist_status,
              'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_status_data);

            $doctor_id = 0;

            if (empty($session_record_data) || !is_array($session_record_data)) {
              $session_record_data = array($record_last_id);
            }
            $record_data = array();
            if (!empty($session_record_data)) {
              foreach ($session_record_data as $ids) {
                if (!empty($ids)) {
                  $this->db->select('*');
                  $this->db->from('request');
                  $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                  $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                  if (!$is_admin) {
                    $this->db->where('users_request.users_id', $user_id);
                  }
                  $this->db->where('uralensis_request_id', $ids);
                  $row = $this->db->get()->row_array();
                  if (!empty($row) && isset($row['uralensis_request_id']) && is_numeric($row['uralensis_request_id'])) {
                    array_push($record_data, $row);
                  }
                }
              }
            }
        //Set session for final records and save in session
        //Get all records ids from record_data
            $record_ids_data = array();
            if (!empty($record_data)) {
              foreach ($record_data as $recordids) {
                $record_ids_data[] = $recordids['uralensis_request_id'];
              }
            }
            $encode = '';
            $this->session->set_userdata('session_records', $record_ids_data);
            if (!empty($record_data)) {
              $encode .= '';
              $encode .= '<table class="table track_search_table table-stripped">';
              $encode .= '<tr style="background-color:#fff">';
              $encode .= '<th>UL No.</th>';
              $encode .= '<th>Track No.</th>';              
              $encode .= '<th>Patient</th>';             
              $encode .= '<th>Age</th>';
              $encode .= '<th>NHS No.</th>';
              $encode .= '<th>Lab No.</th>';            
              $encode .= '<th>Status</th>';
              $encode .= '<th>Flag</th>';
              $encode .= '<th><img src="' . base_url('assets/img/comment-bubble-white.png') . '"></th>';
              $encode .= '<th><img src="' . base_url('assets/img/docs-white.png') . '"></th>';
              $encode .= '<th>TAT</th>';
              $encode .= '<th colspan="2">Actions</th>';
              $encode .= '</tr>';
              foreach ($record_data as $row_data) {
                $encode .= '<tr class="track_session_row" data-trackno="' . $row_data['ura_barcode_no'] . '">';
                $encode .= '<td>' . $row_data['serial_number'] . '</td>';
                $encode .= '<td>' . $row_data['ura_barcode_no'] . '</td>';
                $f_initial = '';
                $l_initial = '';
                if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial)) {
                  $f_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial;
                }
                if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial)) {
                  $l_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->species;
                }
               
                $encode .= '<td>' . $row_data['f_name'] . ' ' . $row_data['sur_name'] . '</td>';               
                $dob = '';
                if (!empty($row_data['dob'])) {
                  $dob = date('d-m-Y', strtotime($row_data['dob']));
                }
                $encode .= '<td>' . $dob . '</td>';
                $encode .= '<td>' . $row_data['animal_id'] . '</td>';
                $encode .= '<td><a target="_blank" href="' . site_url() . '/Institute/view_singlerecord/' . $row_data['uralensis_request_id'] . '">' . $row_data['lab_number'] . '</a></td>';
                
                
               
                $encode .= '<td class="dropdown tg-userdropdown tg-liststatuses">';
                $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->get_track_template_statuses($row_data['uralensis_request_id'], 'recent')['ura_rec_track_status'] . '</a>';
                $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
                $list_statuses = $this->get_track_template_statuses($row_data['uralensis_request_id'], 'all');
                if (!empty($list_statuses)) {
                  foreach ($list_statuses as $statuses) {
                    $encode .= '<li>';
                    $encode .= '<a href="javascript:;">';
                    $encode .= '<span>' . $statuses['ura_rec_track_status'] . '</span>';
                    $encode .= '</a>';
                    $encode .= '</li>';
                  }
                }
                $encode .= '</ul>';
                $encode .= '</td>';
                $encode .= '<td class="flag_column">';
                $encode .= '<div class="hover_flags">';
                $encode .= '<div class="flag_images">';
                if ($row_data['flag_status'] === 'flag_red') {
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
                } else if ($row_data['flag_status'] === 'flag_yellow') {
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                } else if ($row_data['flag_status'] === 'flag_blue') {
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                } else if ($row_data['flag_status'] === 'flag_black') {
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                } else if ($row_data['flag_status'] === 'flag_gray') {
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
                } else {
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
                }
                $encode .= '</div>';
                $encode .= '<ul class="report_flags list-unstyled list-inline" style="display:none;">';
                $active = '';
                if ($row_data['flag_status'] === 'flag_green') {
                  $active = 'flag_active';
                }
                $encode .= '<li class="' . $active . '">';
                $encode .= '<a href="javascript:;" data-flag="flag_green" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="' . base_url('assets/img/flag_green.png') . '">';
                $encode .= '</a>';
                $encode .= '</li>';
                $active = '';
                if ($row_data['flag_status'] === 'flag_red') {
                  $active = 'flag_active';
                }
                $encode .= '<li class="' . $active . '">';
                $encode .= '<a href="javascript:;" data-flag="flag_red" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="' . base_url('assets/img/flag_red.png') . '">';
                $encode .= '</a>';
                $encode .= '</li>';
                $active = '';
                if ($row_data['flag_status'] === 'flag_yellow') {
                  $active = 'flag_active';
                }
                $encode .= '<li class="' . $active . '">';
                $encode .= '<a href="javascript:;" data-flag="flag_yellow" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="' . base_url('assets/img/flag_yellow.png') . '">';
                $encode .= '</a>';
                $encode .= '</li>';
                $active = '';
                if ($row_data['flag_status'] === 'flag_blue') {
                  $active = 'flag_active';
                }
                $encode .= '<li class="' . $active . '">';
                $encode .= '<a href="javascript:;" data-flag="flag_blue" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="' . base_url('assets/img/flag_blue.png') . '">';
                $encode .= '</a>';
                $encode .= '</li>';
                $active = '';
                if ($row_data['flag_status'] === 'flag_black') {
                  $active = 'flag_active';
                }
                $encode .= '<li class="' . $active . '">';
                $encode .= '<a href="javascript:;" data-flag="flag_black" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="' . base_url('assets/img/flag_black.png') . '">';
                $encode .= '</a>';
                $encode .= '</li>';
                $active = '';
                if ($row_data['flag_status'] === 'flag_gray') {
                  $active = 'flag_active';
                }
                $encode .= '<li class="' . $active . '">';
                $encode .= '<a href="javascript:;" data-flag="flag_gray" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="' . base_url('assets/img/flag_gray.png') . '">';
                $encode .= '</a>';
                $encode .= '</li>';
                $encode .= '</ul>';
                $encode .= '</div>';
                $encode .= '</td>';
                $encode .= '<td>';
                $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" href="javascrip:;" data-original-title="View your record comments or add comments.">';
                $encode .= '<img src="' . base_url('assets/img/comment-bubble.png') . '">&nbsp;';
                $encode .= '<span class="badge bg-danger">0</span>';
                $encode .= '</a>';
                $encode .= '</td>';
                $count_docs_result = $this->Institute_model->count_documents($row_data['uralensis_request_id'], $doctor_id);
                $encode .= '<td>';
                $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" href="javascript:;" data-original-title="View your record comments or add comments.">';
                $encode .= '<img src="' . base_url('assets/img/docs-black.png') . '">&nbsp;';
                $encode .= '<span class="badge bg-danger">' . $count_docs_result . '</span>';
                $encode .= '</a>';
                $encode .= '</td>';
                $encode .= '<td>';
                $encode .= '<a class="custom_badge_tat">';
                $now = time(); // or your date as well
                $date_taken = !empty($row_data['date_taken']) ? $row_data['date_taken'] : '';
                $request_date = !empty($row_data['request_datetime']) ? $row_data['request_datetime'] : '';
                $tat_date = '';
                if (!empty($date_taken)) {
                  $tat_date = $date_taken;
                } else {
                  $tat_date = $request_date;
                }
                $compare_date = strtotime("$tat_date");
                $datediff = $now - $compare_date;
                $record_old_count = floor($datediff / (60 * 60 * 24));
                $badge = '';
                if ($record_old_count <= 10) {
                  $badge = 'bg-success';
                } else if ($record_old_count > 10 && $record_old_count <= 20) {
                  $badge = 'bg-warning';
                } else {
                  $badge = 'bg-danger';
                }
                $encode .= '<span class="badge ' . $badge . '">' . $record_old_count . '</span>';
                $encode .= '</a>';
                $encode .= '</td>';

                $request_type = '';
                if ($r_type !== 'histopathology') {
                  $request_type = '/' . $r_type;
                }

                $record_url = base_url('/doctor/doctor_record_detail_old/' . $row_data['uralensis_request_id'] . $request_type);

                $encode .= '<td>
                <a class="edit-icon" href="' . $record_url . '"><i class="fa fa-pencil"></i></a>
                </td>';
                $encode .= '<td class="dropdown">';
                $encode .= '';
               // $encode .= '<a class="record_id_delete" data-recordserial="'.$row_data['serial_number'].'" href="javascript:;" data-delrecordid="' . base_url('index.php/institute/delete_admin_side_record/' . $row_data['uralensis_request_id'] . '/track_del') . '"><i class="lnr lnr-trash"></i><em></em></a>';
                 
                $encode .= '</td>';
                $encode .= '</tr>';
              }
              $encode .= '</table>';
            }
            $json['redirect_url'] = base_url('/doctor/doctor_record_detail_old/' . $record_last_id);
            $json['type'] = 'success';
            $json['track_data'] = $encode;
            $json['msg'] = 'Case Inserted Successfully.';


            $this->output->set_content_type('application/json')
            ->set_output(json_encode($json, JSON_INVALID_UTF8_SUBSTITUTE));
          }

          public function updateTemplateWithId() {


            $temp_data = array(
              $this->input->post('column') => $this->input->post('value')
            );
            $update = updateRecord('uralensis_record_track_template', $temp_data, array('ura_rec_temp_id' => $this->input->post('template_id')));
            $json['type'] = 'success';
            $json['msg'] = 'Track Template updated successfully.';
            echo json_encode($json);
            die;
          }

    /**
     * Search record based on barcode scanner
     * @return {html}
     */
    public function search_and_add_barcode_record() {

      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $search_term = $this->input->post('barcode');
      $user_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
      $json = array();

      $encode = '';
      if (isset($_POST) && $_POST['search_type'] === 'only_search') 
      {

        $is_admin = $this->ion_auth->in_group('admin');
        $query = '';
        if ($is_admin) 
		{
          $this->db->select('*');
          $this->db->from('request');
          $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
          $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
          $this->db->where('ura_barcode_no', $search_term);
        } 
		else 
		{
          $this->db->select('*');
          $this->db->from('request');
          $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
          $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
          $this->db->where('users_request.group_id', $group_id);
          $this->db->where('ura_barcode_no', $search_term);
        }

        $query = $this->db->get()->row_array();

            //Get the doctor id
        $doctor_id = -1;
        if (!empty($query)) 
		{
          $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];
          $encode .= '<div class="card"><table class="table track_search_table table-stripped">';
          $encode .= '<tr>';
          $encode .= '<th>UL No.</th>';
          $encode .= '<th>Track No.</th>';
          $encode .= '<th>Client</th>';
          $encode .= '<th>First Name</th>';
          $encode .= '<th>Surname</th>';
          $encode .= '<th>DOB</th>';
          $encode .= '<th>NHS No.</th>';
          $encode .= '<th>Lab No.</th>';
          $encode .= '<th>Type</th>';
          $encode .= '<th>Release Date</th>';
          $encode .= '<th>Statuses</th>';
          $encode .= '<th>Flag</th>';
          $encode .= '<th><img src="' . base_url('assets/img/comment-bubble-white.png') . '"></th>';
          $encode .= '<th><img src="' . base_url('assets/img/docs-white.png') . '"></th>';
          $encode .= '<th>TAT</th>';
          $encode .= '<th colspan="2">Actions</th>';
          $encode .= '</tr>';
          $encode .= '<tr>';
          $encode .= '<td>' . $query['serial_number'] . '</td>';
          $encode .= '<td>' . $query['ura_barcode_no'] . '</td>';
          $f_initial = '';
          $l_initial = '';
          if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->first_initial)) {
            $f_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->first_initial;
          }
          if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->last_initial)) {
            $l_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->last_initial;
          }
          $encode .= '<td><a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="' . $this->ion_auth->group($query['hospital_group_id'])->row()->description . '" href="javascript:;" >' . $f_initial . ' ' . $l_initial . '</a></td>';
          $encode .= '<td>' . $query['f_name'] . '</td>';
          $encode .= '<td>' . $query['sur_name'] . '</td>';
          $dob = '';
          if (!empty($query['dob'])) {
            $dob = date('d-m-Y', strtotime($query['dob']));
          }
          $encode .= '<td>' . $dob . '</td>';
          $encode .= '<td>' . $query['nhs_number'] . '</td>';
          $encode .= '<td><a target="_blank" href="' . site_url() . '/Institute/view_singlerecord/' . $query['uralensis_request_id'] . '">' . $query['lab_number'] . '</a></td>';
          $encode .= '<td>' . ucwords(substr($query['report_urgency'], 0, 1)) . '</td>';
          $publish_date = '';
          if (!empty($query['publish_datetime'])) {
            $publish_date = date('d-m-Y', strtotime($query['publish_datetime']));
          }
          $encode .= '<td>' . $publish_date . '</td>';
          $encode .= '<td class="dropdown tg-userdropdown tg-liststatuses">';
          $track_status = '';
          $track_status = $this->get_track_template_statuses($query['uralensis_request_id'], 'recent');
          $track_status = $track_status == null ? '' : $track_status['ura_rec_track_status'];
          $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $track_status . '</a>';
          $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
          $list_statuses = $this->get_track_template_statuses($query['uralensis_request_id'], 'all');
          if (!empty($list_statuses)) {
            foreach ($list_statuses as $statuses) {
              $encode .= '<li>';
              $encode .= '<a href="javascript:;">';
              $encode .= '<span>' . $statuses['ura_rec_track_status'] . '</span>';
              $encode .= '</a>';
              $encode .= '</li>';
            }
          }
          $encode .= '</ul>';
          $encode .= '</td>';
          $encode .= '<td class="flag_column">';
          $encode .= '<div class="hover_flags">';
          $encode .= '<div class="flag_images">';
          if ($query['flag_status'] === 'flag_red') {
            $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
          } else if ($query['flag_status'] === 'flag_yellow') {
            $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
          } else if ($query['flag_status'] === 'flag_blue') {
            $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
          } else if ($query['flag_status'] === 'flag_black') {
            $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
          } else if ($query['flag_status'] === 'flag_gray') {
            $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
          } else {
            $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
          }
          $encode .= '</div>';
          $encode .= '<ul class="report_flags list-unstyled list-inline" style="display:none;">';
          $active = '';
          if ($query['flag_status'] === 'flag_green') {
            $active = 'flag_active';
          }
          $encode .= '<li class="' . $active . '">';
          $encode .= '<a href="javascript:;" data-flag="flag_green" data-serial="' . $query['serial_number'] . '" data-recordid="' . $query['uralensis_request_id'] . '" class="flag_change">';
          $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="' . base_url('assets/img/flag_green.png') . '">';
          $encode .= '</a>';
          $encode .= '</li>';
          $active = '';
          if ($query['flag_status'] === 'flag_red') {
            $active = 'flag_active';
          }
          $encode .= '<li class="' . $active . '">';
          $encode .= '<a href="javascript:;" data-flag="flag_red" data-serial="' . $query['serial_number'] . '" data-recordid="' . $query['uralensis_request_id'] . '" class="flag_change">';
          $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="' . base_url('assets/img/flag_red.png') . '">';
          $encode .= '</a>';
          $encode .= '</li>';
          $active = '';
          if ($query['flag_status'] === 'flag_yellow') {
            $active = 'flag_active';
          }
          $encode .= '<li class="' . $active . '">';
          $encode .= '<a href="javascript:;" data-flag="flag_yellow" data-serial="' . $query['serial_number'] . '" data-recordid="' . $query['uralensis_request_id'] . '" class="flag_change">';
          $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="' . base_url('assets/img/flag_yellow.png') . '">';
          $encode .= '</a>';
          $encode .= '</li>';
          $active = '';
          if ($query['flag_status'] === 'flag_blue') {
            $active = 'flag_active';
          }
          $encode .= '<li class="' . $active . '">';
          $encode .= '<a href="javascript:;" data-flag="flag_blue" data-serial="' . $query['serial_number'] . '" data-recordid="' . $query['uralensis_request_id'] . '" class="flag_change">';
          $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="' . base_url('assets/img/flag_blue.png') . '">';
          $encode .= '</a>';
          $encode .= '</li>';
          $active = '';
          if ($query['flag_status'] === 'flag_black') {
            $active = 'flag_active';
          }
          $encode .= '<li class="' . $active . '">';
          $encode .= '<a href="javascript:;" data-flag="flag_black" data-serial="' . $query['serial_number'] . '" data-recordid="' . $query['uralensis_request_id'] . '" class="flag_change">';
          $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="' . base_url('assets/img/flag_black.png') . '">';
          $encode .= '</a>';
          $encode .= '</li>';
          $active = '';
          if ($query['flag_status'] === 'flag_gray') {
            $active = 'flag_active';
          }
          $encode .= '<li class="' . $active . '">';
          $encode .= '<a href="javascript:;" data-flag="flag_gray" data-serial="' . $query['serial_number'] . '" data-recordid="' . $query['uralensis_request_id'] . '" class="flag_change">';
          $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="' . base_url('assets/img/flag_gray.png') . '">';
          $encode .= '</a>';
          $encode .= '</li>';
          $encode .= '</ul>';
          $encode .= '</div>';
          $encode .= '</td>';
          $encode .= '<td>';
          $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" href="javascript:;" data-original-title="View your record comments or add comments.">';
          $encode .= '<img src="' . base_url('assets/img/comment-bubble.png') . '">&nbsp;';
          $encode .= '<span class="badge bg-danger">0</span>';
          $encode .= '</a>';
          $encode .= '</td>';
          $count_docs_result = $this->Institute_model->count_documents($query['uralensis_request_id'], $doctor_id);
          $encode .= '<td>';
          $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" data-original-title="View your record comments or add comments.">';
          $encode .= '<img src="' . base_url('assets/img/docs-black.png') . '">&nbsp;';
          $encode .= '<span class="badge bg-danger">' . $count_docs_result . '</span>';
          $encode .= '</a>';
          $encode .= '</td>';
          $encode .= '<td>';
          $encode .= '<a class="custom_badge_tat">';
                $now = time(); // or your date as well
                $date_taken = !empty($query['date_taken']) ? $query['date_taken'] : '';
                $request_date = !empty($query['request_datetime']) ? $query['request_datetime'] : '';
                $tat_date = '';
                if (!empty($date_taken)) {
                  $tat_date = $date_taken;
                } else {
                  $tat_date = $request_date;
                }
                $compare_date = strtotime("$tat_date");
                $datediff = $now - $compare_date;
                $record_old_count = floor($datediff / (60 * 60 * 24));
                $badge = '';
                if ($record_old_count <= 10) 
				{
                  $badge = 'bg-success';
                } 
				else if ($record_old_count > 10 && $record_old_count <= 20) {
                  $badge = 'bg-warning';
                } 
				else {
                  $badge = 'bg-danger';
                }
                $encode .= '<span class="badge ' . $badge . '">' . $record_old_count . '</span>';
                $encode .= '</a>';
                $encode .= '</td>';
                // Get request type and site url
                $request_type = '';
                if ($query['speciality_group_id'] == '2') 
				{
                  $request_type = '/postmortem';
                } 
				elseif ($query['speciality_group_id'] == '3') 
				{
                  $request_type = '/virology';
                }

                $record_url = base_url('/doctor/doctor_record_detail_old/' . $query['uralensis_request_id'] . $request_type);

                $encode .= '<td>
                <a class="edit-icon" href="' . $record_url . '"><i class="fa fa-pencil"></i></a>
                </td>';
                $encode .= '<td class="dropdown tg-userdropdown tg-menu-dropdown">';
                $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><span class="lnr lnr-menu"></span></a>';
                $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
                $encode .= '<li>';
                $encode .= '<a class="record_id_delete" data-recordserial="' . $query['serial_number'] . '" href="javascript:;" data-delrecordid="' . base_url('index.php/institute/delete_admin_side_record/' . $query['uralensis_request_id'] . '/track_del') . '"><i class="lnr lnr-trash"></i><em>Delete</em></a>';
                $encode .= '</li>';
                $encode .= '</ul>';
                $encode .= '</td>';
                $encode .= '</tr>';
                $encode .= '</table></div>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['msg'] = 'Record found.';
                echo json_encode($json);
                die;
              } 
			  else {
                $json['type'] = 'error';
                $json['msg'] = 'No record found against this tracking number.';
                echo json_encode($json);
                die;
              }
            } 
			else if ($_POST['search_type'] === 'add_record') 
			{

              $encode = '';
              $encode_status = '';
              custom_log("Add record requested");
              //Get the all post data
              $template_id = $this->input->post('template_id');
              $status_code = $this->input->post('status_code');
              $laboratory_id = $this->input->post('lab_id');
              $specialty_id = $this->input->post('speciality_id');
              $is_admin = $this->ion_auth->in_group('admin');
              $check_record_vd_barcode = '';
              if ($is_admin) {
                custom_log("User is admin");
                $this->db->select('*');
                $this->db->from('request');
                $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                $this->db->where('ura_barcode_no', $search_term);
              } else {


                custom_log("User is belongs to group id " . $group_id);
                $this->db->select('*');
                $this->db->from('request');
                $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                $this->db->where('users_request.group_id', $group_id);
                $this->db->where('ura_barcode_no', $search_term);
              }
              $check_record_vd_barcode = $this->db->get()->row_array();

              if (!empty($check_record_vd_barcode['ura_barcode_no'])) {
                custom_log($check_record_vd_barcode['ura_barcode_no'], "Record exists with search term");
                // Check if record status is already added or same

                $check_record_status = $this->db->where('ura_rec_track_status', $status_code)->where('ura_rec_track_no', $check_record_vd_barcode['ura_barcode_no'])->get('uralensis_record_track_status')->row_array();

                if (!empty($check_record_status['ura_rec_track_status']) && $check_record_status['ura_rec_track_status'] === $status_code) {
                  custom_log('Record has same track status');
                  $json['type'] = 'update_statuses';
                  $json['msg'] = 'Record already existed with same track status.';
                  $json['status_msg'] = 'Record found: Track Status - ' . $status_code . '.';
                  echo json_encode($json);
                  custom_log($json, 'Reply sent');
                  return;
                } else {
                  custom_log('Record has different track status');
                  if ($is_admin) {
                    $this->db->select('uralensis_request_id, lab_name');
                    $this->db->from('request');
                    $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                    $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                    $this->db->where('ura_barcode_no', $search_term);
                  } else {
                    $this->db->select('uralensis_request_id, lab_name');
                    $this->db->from('request');
                    $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                    $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                    $this->db->where('users_request.group_id', $group_id);
                    $this->db->where('ura_barcode_no', $search_term);
                  }
                  $get_request_data = $this->db->get()->row_array();
                  $record_track_id = '';
                  $record_track_lab = '';
                  if (!empty($get_request_data)) {

                    $record_track_id = $get_request_data['uralensis_request_id'];
                    $record_track_lab = $get_request_data['lab_name'];
                  }
                  $check_record_assign_status = $this->db->select('user_id')->where('request_id', $record_track_id)->get('request_assignee')->row_array();
                  if (empty($check_record_assign_status)) {
                    $pathologist_status = 'Not Assigned';
                    custom_log('Pathologists not assigned');
                  } else {
                    $pathologist_name = $this->get_uralensis_username($check_record_assign_status['user_id']);
                    $pathologist_status = $pathologist_name;
                    custom_log("Pathologists assigned");
                    custom_log($pathologist_name);
                    custom_log($pathologist_status);
                  }
                    //Prepare data for track status insertion.
                  $track_status_data = array(
                    'ura_rec_track_no' => $search_term,
                    'ura_rec_track_location' => $record_track_lab,
                    'ura_rec_track_record_id' => intval($record_track_id),
                    'ura_rec_track_status' => $status_code,
                    'ura_rec_track_pathologist' => $pathologist_status,
                    'timestamp' => time()
                  );
                  $this->db->insert('uralensis_record_track_status', $track_status_data);

                  $encode_status .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->get_track_template_statuses($record_track_id, 'recent')['ura_rec_track_status'] . '</a>';
                  $encode_status .= '<ul class="dropdown-menu tg-themedropdownmenu custom-list-scroll ura-custom-scrollbar" aria-labelledby="tg-adminnav">';
                  $list_statuses = $this->get_track_template_statuses($record_track_id, 'all');
                  custom_log('Track status updated');
                  if (!empty($list_statuses)) {
                    foreach ($list_statuses as $statuses) {
                      $encode_status .= '<li>';
                      $encode_status .= '<a href="javascript:;">';
                      $encode_status .= '<span>' . $statuses['ura_rec_track_status'] . '</span>';
                      $encode_status .= '</a>';
                      $encode_status .= '</li>';
                    }
                  }
                  $encode_status .= '</ul>';
                  $json['type'] = 'update_statuses';
                  $json['msg'] = 'Record already existed and track status updated.';
                  $json['status_msg'] = 'Record found: Track Status - ' . $status_code . '.';
                  $json['encode_status'] = $encode_status;

                  echo json_encode($json);
                  return;
                }
              }
              custom_log("New record is being created");
              $template_data = $this->db->where('ura_rec_temp_id', $template_id)->get('uralensis_record_track_template')->row_array();
            // echo $this->db->last_query(); exit; 
              $hospital_id = '';
              $clinic_user_id = '';
              $pathologist_id = '';
              $urgency = '';
              $speci_type = '';
              if (!empty($template_data)) {
                $hospital_id = $template_data['temp_hospital_user'];
                $clinic_user_id = $template_data['temp_clinic_user'];
                $pathologist_id = $template_data['temp_pathologist'];
                $urgency = $template_data['temp_report_urgency'];
                $speci_type = $template_data['temp_skin_type'];
              }
              $user_id = $this->ion_auth->user()->row()->id;
              $get_lab_name = $this->db->select('name, description')->where('id', $laboratory_id)->get('groups')->row_array();
            //echo $this->db->last_query(); exit; 
              $lab_name = '';
              if (!empty($get_lab_name)) {
                $lab_name = $get_lab_name['description'];
              }
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
              } else if ($serial_query->num_rows() < 0) {
                $key = 'PCI-' . date('y') . '-1';
              } else {
                $key = 'PCI-' . date('y') . '-1';
              }
              $record_edit_status = array(
                'patient_initial' => 'no',
                'f_name' => 'no',
                'sur_name' => 'no',
                'emis_number' => 'no',
                'lab_number' => 'no',
                'dob' => 'no',
                'date_received_bylab' => 'no',
                'date_sent_touralensis' => 'no',
                'rec_by_doc_date' => 'no',
                'clrk' => 'no',
                'dermatological_surgeon' => 'no',
                'pci_number' => 'no',
                'nhs_number' => 'no',
                'lab_name' => 'no',
                'gender' => 'no',
                'date_taken' => 'no',
                'report_urgency' => 'no',
                'cases_category' => 'no'
              );

              $this->load->model('DepartmentModel', 'department');
              $lab_specs = $this->department->get_laboratory_pathology($laboratory_id);

              $r_type = 'unknown';
              if (!empty($lab_specs)) {
                foreach ($lab_specs as $s_id => $spec) {
                  if ($s_id == $specialty_id) {
                    $r_type = strtolower($spec['name']);
                  }
                }
              }

              $request = array(
                'serial_number' => $key,
                'ura_barcode_no' => $search_term,
                'hospital_group_id' => $hospital_id,
                'report_urgency' => !empty($urgency) ? $urgency : '',
                'lab_name' => !empty($lab_name) ? $lab_name : '',
                'status' => intval(0),
                'request_code_status' => 'new',
                'record_edit_status' => serialize($record_edit_status),
                'request_add_user' => $user_id,
                'request_add_user_timestamp' => time(),
                'request_type' => $r_type,
                'speciality_group_id' => $specialty_id
              );
              $this->Institute_model->institute_insert($request);
            //echo $this->db->last_query(); exit; 
              $record_last_id = $this->db->insert_id();
              $specimen = array(
                'request_id' => $record_last_id,
                'specimen_site' => '',
                'specimen_procedure' => '',
                'specimen_type' => $speci_type,
                'specimen_block' => '',
                'specimen_slides' => '',
                'specimen_block_type' => '',
                'specimen_macroscopic_description' => '',
                'specimen_diagnosis_description' => '',
                'specimen_cancer_register' => '',
                'specimen_rcpath_code' => ''
              );
              $this->db->insert('specimen', $specimen);
              $specimen_id = $this->db->insert_id();
              $data = array('rs_request_id' => $record_last_id, 'rs_specimen_id' => $specimen_id);
              $this->db->insert('request_specimen', $data);
              $record_session_val = $this->session->userdata('record_ids', $record_last_id);
              $record_session_val[] = $record_last_id;
              $this->session->set_userdata('record_ids', $record_session_val);
              $session_record_data = $this->session->userdata('record_ids');
              $user_req_data = array(
                'request_id' => $record_last_id,
                'users_id' => $clinic_user_id,
                'group_id' => $hospital_id
              );
              $this->db->insert("users_request", $user_req_data);
              $request_assign = array(
                'request_id' => $record_last_id,
                'user_id' => $pathologist_id,
              );
              $this->db->insert("request_assignee", $request_assign);
              $assign_request_args = array(
                'assign_status' => intval(1),
                'report_status' => intval(1),
                'request_code_status' => 'assign_doctor',
                'request_assign_status' => intval(1)
              );
              $this->db->where('uralensis_request_id', $record_last_id);
              $this->db->update("request", $assign_request_args);
              $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_last_id)->get('request_assignee')->row_array();
              if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
              } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
              }
              $track_status_data = array(
                'ura_rec_track_no' => $search_term,
                'ura_rec_track_location' => $lab_name,
                'ura_rec_track_record_id' => intval($record_last_id),
                'ura_rec_track_status' => $status_code,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
              );
              $this->db->insert('uralensis_record_track_status', $track_status_data);
              $this->db->select('uralensis_request_id');
              $this->db->from('request');
              $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
              $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
              if (!$is_admin) {
                $this->db->where('users_request.group_id', $group_id);
              }
              $this->db->where('ura_barcode_no', $search_term);
              $query = $this->db->get()->row_array();
              if (!empty($query)) {
                $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array();
                if (!empty($doctor_id)) {
                  $doctor_id = $doctor_id['user_id'];
                } else {
                  $doctor_id = 0;
                }
              } else {
                $doctor_id = 0;
              }

              if (empty($session_record_data) || !is_array($session_record_data)) {
                $session_record_data = array($record_last_id);
              }
              $record_data = array();
              if (!empty($session_record_data)) {
                foreach ($session_record_data as $ids) {
                  if (!empty($ids)) {
                    $this->db->select('*');
                    $this->db->from('request');
                    $this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
                    $this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
                    if (!$is_admin) {
                      $this->db->where('users_request.group_id', $group_id);
                    }
                    $this->db->where('uralensis_request_id', $ids);
                    $row = $this->db->get()->row_array();
                    if (!empty($row) && isset($row['uralensis_request_id']) && is_numeric($row['uralensis_request_id'])) {
                      array_push($record_data, $row);
                    }
                  }
                }
              }
            //Set session for final records and save in session
            //Get all records ids from record_data
              $record_ids_data = array();
              if (!empty($record_data)) {
                foreach ($record_data as $recordids) {
                  $record_ids_data[] = $recordids['uralensis_request_id'];
                }
              }
              $this->session->set_userdata('session_records', $record_ids_data);
              if (!empty($record_data)) {
                $encode .= '<a target="_blank" href="' . base_url('index.php/institute/print_session_records') . '">Print Records</a>';
                $encode .= '<table class="table track_search_table table-stripped">';
                $encode .= '<tr>';
                $encode .= '<th>UL No.</th>';
                $encode .= '<th>Track No.</th>';
                $encode .= '<th>Client</th>';
                $encode .= '<th>First Name</th>';
                $encode .= '<th>Surname</th>';
                $encode .= '<th>DOB</th>';
                $encode .= '<th>NHS No.</th>';
                $encode .= '<th>Lab No.</th>';
                $encode .= '<th>Type</th>';
                $encode .= '<th>Release Date</th>';
                $encode .= '<th>Statuses</th>';
                $encode .= '<th>Flag</th>';
                $encode .= '<th><img src="' . base_url('assets/img/comment-bubble-white.png') . '"></th>';
                $encode .= '<th><img src="' . base_url('assets/img/docs-white.png') . '"></th>';
                $encode .= '<th>TAT</th>';
                $encode .= '<th colspan="2">Actions</th>';
                $encode .= '</tr>';
                foreach ($record_data as $row_data) {
                  $encode .= '<tr class="track_session_row" data-trackno="' . $row_data['ura_barcode_no'] . '">';
                  $encode .= '<td>' . $row_data['serial_number'] . '</td>';
                  $encode .= '<td>' . $row_data['ura_barcode_no'] . '</td>';
                  $f_initial = '';
                  $l_initial = '';
                  if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial)) {
                    $f_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->first_initial;
                  }
                  if (!empty($this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial)) {
                    $l_initial = $this->ion_auth->group($row_data['hospital_group_id'])->row()->last_initial;
                  }
                  $encode .= '<td><a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="' . $this->ion_auth->group($row_data['hospital_group_id'])->row()->description . '" href="javascript:;" >' . $f_initial . ' ' . $l_initial . '</a></td>';
                  $encode .= '<td>' . $row_data['f_name'] . '</td>';
                  $encode .= '<td>' . $row_data['sur_name'] . '</td>';
                  $dob = '';
                  if (!empty($row_data['dob'])) {
                    $dob = date('d-m-Y', strtotime($row_data['dob']));
                  }
                  $encode .= '<td>' . $dob . '</td>';
                  $encode .= '<td>' . $row_data['nhs_number'] . '</td>';
                  $encode .= '<td><a target="_blank" href="' . site_url() . '/Institute/view_singlerecord/' . $row_data['uralensis_request_id'] . '">' . $row_data['lab_number'] . '</a></td>';
                  $encode .= '<td>' . ucwords(substr($row_data['report_urgency'], 0, 1)) . '</td>';
                  $publish_date = '';
                  if (!empty($row_data['publish_datetime'])) {
                    $publish_date = date('d-m-Y', strtotime($row_data['publish_datetime']));
                  }
                  $encode .= '<td>' . $publish_date . '</td>';
                  $encode .= '<td class="dropdown tg-userdropdown tg-liststatuses">';
                  $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->get_track_template_statuses($row_data['uralensis_request_id'], 'recent')['ura_rec_track_status'] . '</a>';
                  $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
                  $list_statuses = $this->get_track_template_statuses($row_data['uralensis_request_id'], 'all');
                  if (!empty($list_statuses)) {
                    foreach ($list_statuses as $statuses) {
                      $encode .= '<li>';
                      $encode .= '<a href="javascript:;">';
                      $encode .= '<span>' . $statuses['ura_rec_track_status'] . '</span>';
                      $encode .= '</a>';
                      $encode .= '</li>';
                    }
                  }
                  $encode .= '</ul>';
                  $encode .= '</td>';
                  $encode .= '<td class="flag_column">';
                  $encode .= '<div class="hover_flags">';
                  $encode .= '<div class="flag_images">';
                  if ($row_data['flag_status'] === 'flag_red') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
                  } else if ($row_data['flag_status'] === 'flag_yellow') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                  } else if ($row_data['flag_status'] === 'flag_blue') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                  } else if ($row_data['flag_status'] === 'flag_black') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                  } else if ($row_data['flag_status'] === 'flag_gray') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
                  } else {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
                  }
                  $encode .= '</div>';
                  $encode .= '<ul class="report_flags list-unstyled list-inline" style="display:none;">';
                  $active = '';
                  if ($row_data['flag_status'] === 'flag_green') {
                    $active = 'flag_active';
                  }
                  $encode .= '<li class="' . $active . '">';
                  $encode .= '<a href="javascript:;" data-flag="flag_green" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="' . base_url('assets/img/flag_green.png') . '">';
                  $encode .= '</a>';
                  $encode .= '</li>';
                  $active = '';
                  if ($row_data['flag_status'] === 'flag_red') {
                    $active = 'flag_active';
                  }
                  $encode .= '<li class="' . $active . '">';
                  $encode .= '<a href="javascript:;" data-flag="flag_red" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="' . base_url('assets/img/flag_red.png') . '">';
                  $encode .= '</a>';
                  $encode .= '</li>';
                  $active = '';
                  if ($row_data['flag_status'] === 'flag_yellow') {
                    $active = 'flag_active';
                  }
                  $encode .= '<li class="' . $active . '">';
                  $encode .= '<a href="javascript:;" data-flag="flag_yellow" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="' . base_url('assets/img/flag_yellow.png') . '">';
                  $encode .= '</a>';
                  $encode .= '</li>';
                  $active = '';
                  if ($row_data['flag_status'] === 'flag_blue') {
                    $active = 'flag_active';
                  }
                  $encode .= '<li class="' . $active . '">';
                  $encode .= '<a href="javascript:;" data-flag="flag_blue" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="' . base_url('assets/img/flag_blue.png') . '">';
                  $encode .= '</a>';
                  $encode .= '</li>';
                  $active = '';
                  if ($row_data['flag_status'] === 'flag_black') {
                    $active = 'flag_active';
                  }
                  $encode .= '<li class="' . $active . '">';
                  $encode .= '<a href="javascript:;" data-flag="flag_black" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="' . base_url('assets/img/flag_black.png') . '">';
                  $encode .= '</a>';
                  $encode .= '</li>';
                  $active = '';
                  if ($row_data['flag_status'] === 'flag_gray') {
                    $active = 'flag_active';
                  }
                  $encode .= '<li class="' . $active . '">';
                  $encode .= '<a href="javascript:;" data-flag="flag_gray" data-serial="' . $row_data['serial_number'] . '" data-recordid="' . $row_data['uralensis_request_id'] . '" class="flag_change">';
                  $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="' . base_url('assets/img/flag_gray.png') . '">';
                  $encode .= '</a>';
                  $encode .= '</li>';
                  $encode .= '</ul>';
                  $encode .= '</div>';
                  $encode .= '</td>';
                  $encode .= '<td>';
                  $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" href="javascrip:;" data-original-title="View your record comments or add comments.">';
                  $encode .= '<img src="' . base_url('assets/img/comment-bubble.png') . '">&nbsp;';
                  $encode .= '<span class="badge bg-danger">0</span>';
                  $encode .= '</a>';
                  $encode .= '</td>';
                  $count_docs_result = $this->Institute_model->count_documents($row_data['uralensis_request_id'], $doctor_id);
                  $encode .= '<td>';
                  $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" href="javascript:;" data-original-title="View your record comments or add comments.">';
                  $encode .= '<img src="' . base_url('assets/img/docs-black.png') . '">&nbsp;';
                  $encode .= '<span class="badge bg-danger">' . $count_docs_result . '</span>';
                  $encode .= '</a>';
                  $encode .= '</td>';
                  $encode .= '<td>';
                  $encode .= '<a class="custom_badge_tat">';
                    $now = time(); // or your date as well
                    $date_taken = !empty($row_data['date_taken']) ? $row_data['date_taken'] : '';
                    $request_date = !empty($row_data['request_datetime']) ? $row_data['request_datetime'] : '';
                    $tat_date = '';
                    if (!empty($date_taken)) {
                      $tat_date = $date_taken;
                    } else {
                      $tat_date = $request_date;
                    }
                    $compare_date = strtotime("$tat_date");
                    $datediff = $now - $compare_date;
                    $record_old_count = floor($datediff / (60 * 60 * 24));
                    $badge = '';
                    if ($record_old_count <= 10) {
                      $badge = 'bg-success';
                    } else if ($record_old_count > 10 && $record_old_count <= 20) {
                      $badge = 'bg-warning';
                    } else {
                      $badge = 'bg-danger';
                    }
                    $encode .= '<span class="badge ' . $badge . '">' . $record_old_count . '</span>';
                    $encode .= '</a>';
                    $encode .= '</td>';

                    $request_type = '';
                    if ($r_type !== 'histopathology') {
                      $request_type = '/' . $r_type;
                    }

                    $record_url = base_url('/doctor/doctor_record_detail_old/' . $query['uralensis_request_id'] . $request_type);

                    $encode .= '<td>
                    <a class="edit-icon" href="' . $record_url . '"><i class="fa fa-pencil"></i></a>
                    </td>';
                    $encode .= '<td class="dropdown tg-userdropdown tg-menu-dropdown">';
                    $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><span class="lnr lnr-menu"></span></a>';
                    $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
                    $encode .= '<li>';
                    $encode .= '<a class="record_id_delete" data-recordserial="' . $row_data['serial_number'] . '" href="javascript:;" data-delrecordid="' . base_url('index.php/institute/delete_admin_side_record/' . $row_data['uralensis_request_id'] . '/track_del') . '"><i class="lnr lnr-trash"></i><em>Delete</em></a>';
                    $encode .= '</li>';
                    $encode .= '</ul>';
                    $encode .= '</td>';
                    $encode .= '</tr>';
                  }
                  $encode .= '</table>';
                }
                $json['type'] = 'success';
                $json['track_data'] = $encode;
                $json['msg'] = 'Case Inserted Successfully.';
                echo json_encode($json, JSON_INVALID_UTF8_SUBSTITUTE);
                return;
              }
            }

    /**
     * Get track template statuses
     * @return data
     */
    public function get_track_template_statuses($record_id = '', $get_type = '') {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!empty($record_id)) {
        if (!empty($get_type) && $get_type === 'recent') {
          return $this->db->where('ura_rec_track_record_id', $record_id)->order_by("ura_rec_track_id", "desc")->limit(1)->get('uralensis_record_track_status')->row_array();
        } else if (!empty($get_type) && $get_type === 'all') {
          return $this->db->where('ura_rec_track_record_id', $record_id)->order_by("ura_rec_track_id", "desc")->get('uralensis_record_track_status')->result_array();
        }
      }
    }

    /**
     * Print out further work completed records
     *
     * @return void
     */
    public function print_fw_records() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $fw_result = array();
      if (isset($_GET) && $_GET['fw_type'] === 'completed') {
        $fw_result['fw_data'] = $this->Institute_model->print_further_work_records('completed');
        $this->load->view('institute/record_tracking/print_fw_completed_records', $fw_result);
      } else {
        $fw_result['fw_data'] = $this->Institute_model->print_further_work_records('requested');
        $this->load->view('institute/record_tracking/print_fw_requested_records', $fw_result);
      }
    }

    /**
     * Delete Institute Dcoument File.
     *
     * @return void
     */
    public function delete_institute_document_file() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (isset($_POST)) {
        $file_id = $this->input->post('files_id');
        $this->db->where('files_id', $file_id)->delete('files');
        $json['type'] = 'success';
        $json['msg'] = 'Document Deleted Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Delete Institute Dcoument File.
     *
     * @return void
     */
    public function aleatha_image_uploader() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $upload_user_id = $_REQUEST['upload_user_id'];
      $json = array();
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png|doc|docx|xls|xlsx|ppt|pptx|pdf|csv';
      $config['max_size'] = '50000';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('aleatha_image_uploader')) {
        $error = array('error' => $this->upload->display_errors());
        $json = array('success' => FALSE, 'reason' => $error);
        echo json_encode($json);
        die;
      } else {
        $data = array('upload_data' => $this->upload->data());
        $image_path = base_url() . 'uploads/' . $data['upload_data']['file_name'];
        $json = array(
          'success' => TRUE,
          'file_name' => $data['upload_data']['file_name'],
          'full_path' => $data['upload_data']['full_path'],
          'file_path' => $image_path,
          'file_ext' => $data['upload_data']['file_ext']
        );
        echo json_encode($json);
      }
    }

    /**
     * Delete Upload Area Document
     *
     * @return void
     */
    public function delete_upload_area_document() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $file_path = $this->input->post('file_path');
      if (!unlink($file_path)) {
        $json['type'] = 'success';
        $json['msg'] = 'Something went wrong.';
      } else {
        $json['type'] = 'success';
        $json['msg'] = 'Document Deleted Successfully.';
      }
      echo json_encode($json);
      die;
    }

    /**
     * Save Upload Area Document
     *
     * @return void
     */
    public function save_upload_area_document() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        if (empty($_POST['upload_area_users'])) {
          $json['type'] = 'error';
          $json['msg'] = 'Please Select the user.';
          echo json_encode($json);
          die;
        }
        if (empty($_POST['upload_area_file_name'])) {
          $json['type'] = 'error';
          $json['msg'] = 'Please upload image.';
          echo json_encode($json);
          die;
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $users_array = $this->input->post('upload_area_users');
        $file_name = $this->input->post('upload_area_file_name');
        $file_path = $this->input->post('upload_area_file_path');
        $full_path = $this->input->post('upload_area_full_path');
        $file_ext = $this->input->post('upload_area_file_ext');
            //Prepare Data for upload area to insert in DB
        $uplaod_array = array(
          'ura_uploader_id' => $user_id,
          'ura_upload_area_filename' => $file_name,
          'ura_upload_area_fileext' => $file_ext,
          'ura_upload_area_filepath' => $file_path,
          'ura_upload_area_fullpath' => $full_path,
          'ura_upload_area_file_perms' => serialize($users_array),
          'timestamp' => time()
        );
        $this->db->insert('uralensis_upload_area', $uplaod_array);
        $json['type'] = 'success';
        $json['msg'] = 'Document Uploaded Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Delete Upload Area documents
     *
     * @return void
     */
    public function delete_upload_area_document_db() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        $file_id = $this->input->post('file_id');
        $full_path = $this->input->post('full_path');
        unlink($full_path);
        $this->db->where('ura_upload_area_id', $file_id);
        $this->db->delete('uralensis_upload_area');
        $json['type'] = 'success';
        $json['msg'] = 'File Deleted Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Upload Area Documents Permissions
     *
     * @return void
     */
    public function update_upload_area_document_perms() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        if (empty($_POST['upload_area_change_perm_users'])) {
          $json['type'] = 'error';
          $json['msg'] = 'Please Select the user first.';
          echo json_encode($json);
          die;
        }
        $file_id = $this->input->post('file_id');
        $users_perm_array = '';
        if (!empty($this->input->post('upload_area_change_perm_users'))) {
          $users_perm_array = serialize($this->input->post('upload_area_change_perm_users'));
        }
        $this->db->where('ura_upload_area_id', $file_id);
        $this->db->update('uralensis_upload_area', array('ura_upload_area_file_perms' => $users_perm_array));
        $json['type'] = 'success';
        $json['msg'] = 'Permissions updated successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Save Upload Area Document
     *
     * @return void
     */
    public function cl_doc_save_upload_area_document() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        if (empty($_POST['upload_area_users'])) {
          $json['type'] = 'error';
          $json['msg'] = 'Please Select the user.';
          echo json_encode($json);
          die;
        }
        if (empty($_POST['upload_area_file_name'])) {
          $json['type'] = 'error';
          $json['msg'] = 'Please upload image.';
          echo json_encode($json);
          die;
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $users_array = $this->input->post('upload_area_users');
        $file_name = $this->input->post('upload_area_file_name');
        $file_path = $this->input->post('upload_area_file_path');
        $full_path = $this->input->post('upload_area_full_path');
        $file_ext = $this->input->post('upload_area_file_ext');
            //Prepare Data for upload area to insert in DB
        $uplaod_array = array(
          'ura_uploader_id' => $user_id,
          'ura_upload_area_filename' => $file_name,
          'ura_upload_area_fileext' => $file_ext,
          'ura_upload_area_filepath' => $file_path,
          'ura_upload_area_fullpath' => $full_path,
          'ura_upload_area_file_perms' => serialize($users_array),
          'timestamp' => time()
        );
        $this->db->insert('uralensis_client_doc_upload_area', $uplaod_array);
        $json['type'] = 'success';
        $json['msg'] = 'Document Uploaded Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Delete Upload Area documents
     *
     * @return void
     */
    public function cl_doc_delete_upload_area_document_db() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        $file_id = $this->input->post('file_id');
        $full_path = $this->input->post('full_path');
        unlink($full_path);
        $this->db->where('ura_upload_area_id', $file_id);
        $this->db->delete('uralensis_client_doc_upload_area');
        $json['type'] = 'success';
        $json['msg'] = 'File Deleted Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Upload Area Documents Permissions
     *
     * @return void
     */
    public function cl_doc_update_upload_area_document_perms() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        if (empty($_POST['upload_area_change_perm_users'])) {
          $json['type'] = 'error';
          $json['msg'] = 'Please Select the user first.';
          echo json_encode($json);
          die;
        }
        $file_id = $this->input->post('file_id');
        $users_perm_array = '';
        if (!empty($this->input->post('upload_area_change_perm_users'))) {
          $users_perm_array = serialize($this->input->post('upload_area_change_perm_users'));
        }
        $this->db->where('ura_upload_area_id', $file_id);
        $this->db->update('uralensis_client_doc_upload_area', array('ura_upload_area_file_perms' => $users_perm_array));
        $json['type'] = 'success';
        $json['msg'] = 'Permissions updated successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Print Session Records
     *
     * @return void
     */
    public function print_session_records() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $session_records_ids = $this->session->userdata('session_records');
      $session_rec_data = array();
      if (!empty($session_records_ids) && isset($session_records_ids)) {
        $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($session_records_ids);
      }
      $this->load->view('institute/sessions_record_pdf', $session_rec_data);
    }

    /**
     * Create New Session Track List
     *
     * @return void
     */
    public function create_new_session_track_record_list() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (isset($_SESSION) && !empty($_SESSION['session_records'])) {
        $session_records_ids = $this->session->userdata('session_records');
        $user_id = $this->ion_auth->user()->row()->id;
        $reocrd_data = array(
          'ura_track_sess_rec_data' => serialize($session_records_ids),
          'ura_track_sess_rec_user_id' => $user_id,
          'timestamp' => time(),
          'ura_date_format' => date('Y-m-d')
        );
        $this->db->insert('uralensis_track_session_records', $reocrd_data);
        $this->session->unset_userdata('session_records');
        $this->session->unset_userdata('record_ids');
        $json['type'] = 'success';
        $json['msg'] = 'Session Records Found & List Created.';
        echo json_encode($json);
        die;
      } else {
        $json['type'] = 'error';
        $json['msg'] = 'No record found in session.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * View Session records
     *
     * @return void
     */
    public function view_session_records() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/record_tracking/view_session_records');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Print Session Records DB Data
     *
     * @param int $sess_record_id
     * @return void
     */
    public function print_session_records_document($sess_record_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $session_rec_data = array();
      if (!empty($sess_record_id) && isset($sess_record_id)) {
        $session_record_serialize_data = $this->db->select('ura_track_sess_rec_data')->where('ura_track_sess_rec_id', $sess_record_id)->get('uralensis_track_session_records')->row_array();
        $extract_data = '';
        if (!empty($session_record_serialize_data)) {
          $extract_data = unserialize($session_record_serialize_data['ura_track_sess_rec_data']);
        }
        $session_rec_data['session_data'] = $this->Institute_model->get_all_session_records($extract_data);
      }
      $this->load->view('institute/sessions_record_pdf', $session_rec_data);
    }

    /**
     * Delete Record Data From Respective Tables
     *
     * @param int $record_id
     * @param string $del_type
     * @return void
     */
    public function delete_admin_side_record($record_id, $del_type = '') {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $current_date_year = date('Y');
      $this->db->query("DELETE FROM users_request WHERE request_id = $record_id");
      $this->db->query("DELETE FROM request_specimen WHERE rs_request_id = $record_id");
      $this->db->query("DELETE FROM request_assignee WHERE request_id = $record_id");
      $this->db->query("DELETE FROM further_work WHERE request_id = $record_id");
      $this->db->query("DELETE FROM specimen WHERE request_id = $record_id");
      $this->db->query("DELETE FROM request WHERE uralensis_request_id = $record_id");
      $this->db->query("DELETE FROM additional_work WHERE request_id = $record_id");
      $this->db->query("DELETE FROM files WHERE files.record_id = $record_id");
      $this->db->query("DELETE FROM additional_work WHERE additional_work.request_id = $record_id");
      $this->db->query("DELETE FROM uralensis_sec_rec_assign WHERE uralensis_sec_rec_assign.ura_sec_rec_rec_id = $record_id");
      $this->db->query("DELETE FROM uralensis_record_track_status WHERE uralensis_record_track_status.ura_rec_track_record_id = $record_id");
      $record_del_status = '<p class="bg-success" style="padding:7px;">Record Has Been Successfully Deleted.</p>';
      $this->session->set_flashdata('record_status', $record_del_status);
      if (!empty($del_type) && $del_type === 'track_del') {
        redirect('institute/record_tracking/', 'refresh');
      } else {
            //redirect('admin/display_all/' . $current_date_year . '/recent', 'refresh');
      }
    }

    /**
     * Show Reports
     *
     * @return void
     */
    public function show_reports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/reports_page');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Tracker Reports
     *
     * @return void
     */
    public function tracker_reports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/tracker_reports');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Find CSV Reports
     *
     * @return void
     */
    public function find_csv_reports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      if (isset($_GET) && $_GET['date_to'] != '' && $_GET['date_from'] != '') {
        $hospital_group_id = $this->ion_auth->user()->row()->id;
        $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
        $date_to = date('Y-m-d', strtotime($_GET['date_to']));
        $date_from = date('Y-m-d', strtotime($_GET['date_from']));
        if (isset($_GET['published_reports'])) {
          $csv_records['find_csv_records'] = $this->Institute_model->find_csv_report_model_publish($group_id, $date_to, $date_from);
        } else {
          $csv_records['find_csv_records'] = $this->Institute_model->find_csv_report_model_publish_unpublish($group_id, $date_to, $date_from);
        }
        $this->load->view('institute/inc/header');
        $this->load->view('institute/csv_records', $csv_records);
        $this->load->view('institute/inc/footer-new');
      } else {
        $search_error = '<p class="alert bg-danger">Some Thing Wrong. Try To Fill Out All Fields And Then Press Search Reports.</p>';
        $this->session->set_flashdata('csv_search_error', $search_error);
        redirect('institute/tracker_reports');
      }
    }

    /**
     * Download Excel Report
     *
     * @return void
     */
    public function download_csv_publish() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      if (isset($_GET)) {
        $csv_records_query = '';
        $hospital_group_id = $this->ion_auth->user()->row()->id;
        $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
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
        if (!empty($_GET['date_sent_touralensis'])) {
          $csv_records_query .= 'request.date_sent_touralensis,';
        }
        if (!empty($_GET['clinician'])) {
          $csv_records_query .= 'request.clrk,';
        }
        if (!empty($_GET['cases_category'])) {
          $csv_records_query .= 'request.cases_category,';
        }
        if (!empty($_GET['report_urgency'])) {
          $csv_records_query .= 'request.report_urgency,';
        }
        if (!empty($_GET['clinical_history'])) {
          $csv_records_query .= 'request.cl_detail,';
        }
        if (!empty($_GET['dermatological_surgeon'])) {
          $csv_records_query .= 'request.dermatological_surgeon ';
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
        fputcsv(
          $output, array(
            $group_name,
          )
        );
        fputcsv(
          $output, array(
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
            'D. Received Back From Lab',
            'Specimen(s)',
            'Clinician',
            'Reporting Doctor',
            'Case Category',
            'Report Urgency',
            'Clinical History',
            'Dermatological Surgeon',
            'Diagnosis',
            'Snomed T',
            'Snomed P',
            'Snomed M',
            'Microscopy',
            'Macroscopy',
          )
        );
        $query_csv_records = $this->db->query($csv_records_query);
        foreach ($query_csv_records->result_array() as $row) {
          $specimens = $this->count_specimens($row['uralensis_request_id']);
          $fname = !empty($row['f_name']) ? $row['f_name'] : '';
          $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
          $patinet_name = $fname . ' ' . $surname;
          fputcsv(
            $output, array(
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
              'D. Received Back From Lab' => !empty($row['date_sent_touralensis']) ? $row['date_sent_touralensis'] : '',
              'Specimen(s)' => !empty($specimens) ? count($specimens) : '',
              'Clinician' => !empty($row['clrk']) ? $row['clrk'] : '',
              'Reporting Doctor' => !empty($_GET['reporting_doctor']) ? $this->get_reporting_doctor($row['uralensis_request_id']) : '',
              'Case Category' => !empty($row['cases_category']) ? $row['cases_category'] : '',
              'Report Urgency' => !empty($row['report_urgency']) ? $row['report_urgency'] : '',
              'Dermatological Surgeon' => !empty($row['dermatological_surgeon']) ? $row['dermatological_surgeon'] : '',
            )
          );
          if (!empty($specimens)) {
            foreach ($specimens as $spec) {
              $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
              $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
              $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
              $microscopy = $spec['specimen_microscopic_description'];
              $macroscopy = $spec['specimen_macroscopic_description'];
              fputcsv(
                $output, array(
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
                  'Microscopy' => !empty($microscopy) ? $microscopy : '',
                  'Macroscopy' => !empty($macroscopy) ? $macroscopy : '',
                )
              );
            }
          }
        }
      }
    }

    public function count_specimens($record_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
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
     * Get Reporting Doctor
     *
     * @param int $request_id
     * @return void
     */
    public function get_reporting_doctor($request_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      if (!empty($request_id)) {
        $doctor_id = $this->db->select('user_id')->where('request_id', $request_id)->get('request_assignee')->row_array()['user_id'];

        return $this->get_uralensis_username($doctor_id);
      }
    }

    /**
     * Download Publish and Un-Publish Records
     *
     * @return void
     */
    public function download_csv_publish_unpublish() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      if (isset($_GET)) {
        $csv_pub_unpub = '';
        $hospital_group_id = $this->ion_auth->user()->row()->id;
        $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
        $date_to = date('Y-m-d', strtotime($_GET['date_to']));
        $date_from = date('Y-m-d', strtotime($_GET['date_from']));
        $group_name = $this->ion_auth->group($group_id)->row()->description;
        $csv_pub_unpub .= "SELECT request.uralensis_request_id, request.specimen_publish_status, request.cl_detail, request.request_datetime,
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
        if (!empty($_GET['date_sent_touralensis'])) {
          $csv_pub_unpub .= 'request.date_sent_touralensis,';
        }
        if (!empty($_GET['clinician'])) {
          $csv_pub_unpub .= ' request.clrk,';
        }
        if (!empty($_GET['cases_category'])) {
          $csv_pub_unpub .= 'request.cases_category,';
        }
        if (!empty($_GET['report_urgency'])) {
          $csv_pub_unpub .= 'request.report_urgency,';
        }
        if (!empty($_GET['clinical_history'])) {
          $csv_pub_unpub .= 'request.cl_detail,';
        }
        if (!empty($_GET['dermatological_surgeon'])) {
          $csv_pub_unpub .= 'request.dermatological_surgeon ';
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
        fputcsv(
          $output, array(
            $group_name,
          )
        );
        fputcsv(
          $output, array(
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
            'D. Received Back From Lab',
            'Specimen(s)',
            'Clinician',
            'Reporting Doctor',
            'Case Category',
            'Report Urgency',
            'Clinical History',
            'Dermatological Surgeon',
            'Diagnosis',
            'Snomed T',
            'Snomed P',
            'Snomed M',
            'Microscopy',
            'Macroscopy'
          )
        );
        fputcsv(
          $output, array(
            'Publish Records'
          )
        );
        foreach ($query_csv_records->result_array() as $row) {
          $specimens = $this->count_specimens($row['uralensis_request_id']);
          $fname = !empty($row['f_name']) ? $row['f_name'] : '';
          $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
          $patinet_name = $fname . ' ' . $surname;
          if ($row['specimen_publish_status'] == 1) {
            fputcsv(
              $output, array(
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
                'D. Received Back From Lab' => !empty($row['date_sent_touralensis']) ? $row['date_sent_touralensis'] : '',
                'Specimen(s)' => !empty($specimens) ? count($specimens) : '',
                'Clinician' => !empty($row['clrk']) ? $row['clrk'] : '',
                'Reporting Doctor' => !empty($_GET['reporting_doctor']) ? $this->get_reporting_doctor($row['uralensis_request_id']) : '',
                'Case Category' => !empty($row['cases_category']) ? $row['cases_category'] : '',
                'Report Urgency' => !empty($row['report_urgency']) ? $row['report_urgency'] : '',
                'Clinical History' => !empty($row['cl_detail']) ? $row['cl_detail'] : '',
                'Dermatological Surgeon' => !empty($row['dermatological_surgeon']) ? $row['dermatological_surgeon'] : ''
              )
            );
            if (!empty($specimens)) {
              foreach ($specimens as $spec) {
                $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                $microscopy = $spec['specimen_microscopic_description'];
                $macroscopy = $spec['specimen_macroscopic_description'];
                fputcsv(
                  $output, array(
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
                    'Microscopy' => !empty($microscopy) ? $microscopy : '',
                    'Macroscopy' => !empty($macroscopy) ? $macroscopy : ''
                  )
                );
              }
            }
          }
        }
        fputcsv(
          $output, array(
            'Un-Publish Records'
          )
        );
        foreach ($query_csv_records->result_array() as $row) {
          $specimens = $this->count_specimens($row['uralensis_request_id']);
          $fname = !empty($row['f_name']) ? $row['f_name'] : '';
          $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
          $patinet_name = $fname . ' ' . $surname;
          if ($row['specimen_publish_status'] == 0) {
            fputcsv(
              $output, array(
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
                'D. Received Back From Lab' => !empty($row['date_sent_touralensis']) ? $row['date_sent_touralensis'] : '',
                'Specimen(s)' => !empty($specimens) ? count($specimens) : '',
                'Clinician' => !empty($row['clrk']) ? $row['clrk'] : '',
                'Reporting Doctor' => !empty($_GET['reporting_doctor']) ? $this->get_reporting_doctor($row['uralensis_request_id']) : '',
                'Case Category' => !empty($row['cases_category']) ? $row['cases_category'] : '',
                'Report Urgency' => !empty($row['report_urgency']) ? $row['report_urgency'] : '',
                'Clinical History' => !empty($row['cl_detail']) ? $row['cl_detail'] : '',
                'Dermatological Surgeon' => !empty($row['dermatological_surgeon']) ? $row['dermatological_surgeon'] : ''
              )
            );
            if (!empty($specimens)) {
              foreach ($specimens as $spec) {
                $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                $microscopy = $spec['specimen_microscopic_description'];
                $macroscopy = $spec['specimen_macroscopic_description'];
                fputcsv(
                  $output, array(
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
                    'Microscopy' => !empty($microscopy) ? $microscopy : '',
                    'Macroscopy' => !empty($macroscopy) ? $macroscopy : ''
                  )
                );
              }
            }
          }
        }
      }
    }

    /**
     * TATScores Reports
     *
     * @return void
     */
    public function tatscores_reports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      require_once('application/views/institute/report_tats.php');
      $this->load->view('institute/inc/header');
      $this->load->view('institute/tatscores_reports');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Generate TAT 10
     *
     * @return void
     */
    public function generate_tat10() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      $hospital_group_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
      $tat_settings = uralensis_get_tat_date_settings($group_id);
      if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
        $date_sent_to_uralensis = 'date_sent_touralensis';
        $tat_date = $date_sent_to_uralensis;
      } else if ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
        $data_processed_bylab = 'data_processed_bylab';
        $tat_date = $data_processed_bylab;
      } else if ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
        $date_received_bylab = 'date_received_bylab';
        $tat_date = $date_received_bylab;
      } else if ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
        $publish_datetime = 'publish_datetime';
        $tat_date = $publish_datetime;
      } else {
        $tat_date = 'request_datetime';
      }
      $fw_data['csv_data'] = array(
        'group_id' => $group_id,
        'tat_opt' => $tat_date
      );
      if (isset($_POST['tat10_csv'])) {
        $this->load->view('institute/reports/tat10_report_csv', $fw_data);
      } else if (isset($_POST['tat10_pdf'])) {
        $this->load->view('institute/reports/tat10_report_pdf', $fw_data);
      } else {
        $search_error = '<p class="alert alert-danger">Something Went Wrong.</p>';
        $this->session->set_flashdata('imf_search_error', $search_error);
        redirect('institute/tatscores_reports');
      }
    }

    /**
     * Generate TAT 2W
     *
     * @return void
     */
    public function generate_tat2w() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      $hospital_group_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
      $tat_settings = uralensis_get_tat_date_settings($group_id);
      if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
        $date_sent_to_uralensis = 'date_sent_touralensis';
        $tat_date = $date_sent_to_uralensis;
      } else if ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
        $data_processed_bylab = 'data_processed_bylab';
        $tat_date = $data_processed_bylab;
      } else if ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
        $date_received_bylab = 'date_received_bylab';
        $tat_date = $date_received_bylab;
      } else if ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
        $publish_datetime = 'publish_datetime';
        $tat_date = $publish_datetime;
      } else {
        $tat_date = 'request_datetime';
      }
      $fw_data['csv_data'] = array(
        'group_id' => $group_id,
        'tat_opt' => $tat_date
      );
      if (isset($_POST['tat2w_csv'])) {
        $this->load->view('institute/reports/tat2w_report_csv', $fw_data);
      } else if (isset($_POST['tat2w_pdf'])) {
        $this->load->view('institute/reports/tat2w_report_pdf', $fw_data);
      } else {
        $search_error = '<p class="alert alert-danger">Something Went Wrong.</p>';
        $this->session->set_flashdata('imf_search_error', $search_error);
        redirect('institute/tatscores_reports');
      }
    }

    /**
     * Generate TAT 3W
     *
     * @return void
     */
    public function generate_tat3w() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!check_user_role('show_reports')) {
        
      }
      $hospital_group_id = $this->ion_auth->user()->row()->id;
      $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
      $tat_settings = uralensis_get_tat_date_settings($group_id);
      if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
        $date_sent_to_uralensis = 'date_sent_touralensis';
        $tat_date = $date_sent_to_uralensis;
      } else if ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
        $data_processed_bylab = 'data_processed_bylab';
        $tat_date = $data_processed_bylab;
      } else if ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
        $date_received_bylab = 'date_received_bylab';
        $tat_date = $date_received_bylab;
      } else if ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
        $publish_datetime = 'publish_datetime';
        $tat_date = $publish_datetime;
      } else {
        $tat_date = 'request_datetime';
      }
      $fw_data['csv_data'] = array(
        'group_id' => $group_id,
        'tat_opt' => $tat_date
      );
      if (isset($_POST['tat3w_csv'])) {
        $this->load->view('institute/reports/tat3w_report_csv', $fw_data);
      } else if (isset($_POST['tat3w_pdf'])) {
        $this->load->view('institute/reports/tat3w_report_pdf', $fw_data);
      } else {
        $search_error = '<p class="alert alert-danger">Something Went Wrong.</p>';
        $this->session->set_flashdata('imf_search_error', $search_error);
        redirect('institute/tatscores_reports');
      }
    }

    /**
     * Show weekly day base records
     *
     * @return void
     */
    public function search_weekly_records() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $weekly_day_data = array();
      if (isset($_GET['search_key']) && !empty($_GET['search_key']) && isset($_GET['mode']) && $_GET['mode'] === 'total') {
        $search_key_decode = base64_decode($_GET['search_key']);
        $explode_search = explode("|", $search_key_decode);
        if (!empty($explode_search)) {
          $doctor_id = $explode_search[0];
          $hospital_id = $explode_search[1];
          $start_date = $explode_search[2];
          $end_date = $explode_search[3];
          $rec_status = $explode_search[4];
          $weekly_day_data['weekly_day_data'] = $this->Institute_model->get_weekly_day_base_data_total($doctor_id, $hospital_id, $start_date, $end_date, $rec_status);
        }
      } else {
        $search_key_decode = base64_decode($_GET['search_key']);
        $explode_search = explode("|", $search_key_decode);
        if (!empty($explode_search)) {
          $doctor_id = $explode_search[0];
          $hospital_id = $explode_search[1];
          $current_date = $explode_search[2];
          $rec_status = $explode_search[3];
          $weekly_day_data['weekly_day_data'] = $this->Institute_model->get_weekly_day_base_data($doctor_id, $hospital_id, $current_date, $current_date, $rec_status);
        }
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/search_weekly_records', $weekly_day_data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Generate Hospital Latest Invoice
     *
     * @return void
     */
    public function generate_hospital_latest_invoice() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($hospital_id)->row()->id;
      $latest_invoice['hospital_invoice'] = $this->Institute_model->get_latest_hospital_invoice($hospital_group_id);
      $date_from = '';
      $date_to = '';
      if (!empty($latest_invoice)) {
        $date_from = $latest_invoice['hospital_invoice']['ura_hos_date_from'];
        $date_to = $latest_invoice['hospital_invoice']['ura_hos_date_to'];
      }
      $tat_db_records['tat_db_records'] = $this->Admin_model->search_db_hospital_invoice_with_tat($hospital_group_id, $date_from, $date_to);
      $pdf_record_detail['pdf_record_detail'] = $this->Admin_model->get_pdf_detail_records($hospital_group_id, $date_from, $date_to);
      $pdf_record_summary['pdf_record_summary'] = $this->Admin_model->get_pdf_summary_records($hospital_group_id, $date_from, $date_to);
      $invoice_temp['invoice_temp'] = $this->Admin_model->get_hospital_invoice_template_data($hospital_group_id);
      $result = array_merge($latest_invoice, $invoice_temp, $pdf_record_detail, $pdf_record_summary, $tat_db_records);
      $this->load->view('institute/generate_hospital_pdf_invoice', $result);
    }

    /**
     * Accumulative Invoice Display
     *
     * @return void
     */
    public function accumulative_invoices_display() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/accumulative_invoice_display');
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Users of this hospitals
     *
     * @return void
     */
    public function getAllUsers() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
      $data['userslist'] = $this->Userextramodel->getAllusersForadmin($hospital_group_id);
      $this->load->view('institute/inc/header');
      $this->load->view('institute/hospital_users', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Load Accumulative Yearly Invoices
     *
     * @return void
     */
    public function load_accumulative_yearly_invoices() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $hospital_id = $this->ion_auth->user()->row()->id;
      $hospital_group_id = $this->ion_auth->get_users_groups($hospital_id)->row()->id;
      $encode = '';
      $json = array();
      if (isset($_POST)) {
        $year = $this->input->post('year');
        $invoice_data = $this->Institute_model->get_accumulative_yearly_invoices($year, $hospital_group_id);
        $encode .= '<table class="table table-striped">';
        $encode .= '<thead>';
        $encode .= '<tr class="bg-primary">';
        $encode .= '<th>INV No.</th>';
        $encode .= '<th>Hospital</th>';
        $encode .= '<th>Inv From</th>';
        $encode .= '<th>Inv To</th>';
        $encode .= '<th>Created</th>';
        $encode .= '<th>Actions</th>';
        $encode .= '</tr>';
        $encode .= '</thead>';
        if (!empty($invoice_data)) {
          $encode .= '<tbody>';
          foreach ($invoice_data as $key => $value) {
            $hospital_name = $this->ion_auth->group($value['ura_hos_id'])->row()->description;
            $timestamp = date('d-m-Y h:i:s A', $value['timestamp']);
            $encode .= '<tr>';
            $encode .= '<td>' . $value['ura_invoice_no'] . '</td>';
            $encode .= '<td>' . $hospital_name . '</td>';
            $encode .= '<td>' . $value['ura_hos_date_from'] . '</td>';
            $encode .= '<td>' . $value['ura_hos_date_to'] . '</td>';
            $encode .= '<td>' . $timestamp . '</td>';
            $encode .= '<td><a href="' . base_url('index.php/institute/generate_hospital_accumulative_invoice/' . $value['ura_hos_invoice']) . '"><img src="' . base_url('assets/img/view.png') . '"></a></td>';
            $encode .= '</tr>';
            $encode .= '</tbody>';
          }
        } else {
          $json['type'] = 'error';
          $json['msg'] = 'No Invoice/s Found.';
          echo json_encode($json);
          die;
        }
        $json['type'] = 'success';
        $json['encode_data'] = $encode;
        $json['msg'] = 'Invoice/s Found.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Generate Doctor Invoice
     *
     * @param int $invoice_id
     * @return void
     */
    public function generate_hospital_accumulative_invoice($invoice_id) {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $hospital_invoice['hospital_invoice'] = $this->Institute_model->generated_hospital_invoices_pdf($invoice_id);
      $hospital_id = '';
      $date_from = '';
      $date_to = '';
      if (!empty($hospital_invoice['hospital_invoice'])) {
        $hospital_id = $hospital_invoice['hospital_invoice']['ura_hos_id'];
        $date_from = $hospital_invoice['hospital_invoice']['ura_hos_date_from'];
        $date_to = $hospital_invoice['hospital_invoice']['ura_hos_date_to'];
      }
      $tat_db_records['tat_db_records'] = $this->Admin_model->search_db_hospital_invoice_with_tat($hospital_id, $date_from, $date_to);
      $pdf_record_detail['pdf_record_detail'] = $this->Admin_model->get_pdf_detail_records($hospital_id, $date_from, $date_to);
      $pdf_record_summary['pdf_record_summary'] = $this->Admin_model->get_pdf_summary_records($hospital_id, $date_from, $date_to);
      $invoice_temp['invoice_temp'] = $this->Admin_model->get_hospital_invoice_template_data($hospital_id);
      $result = array_merge($hospital_invoice, $invoice_temp, $pdf_record_detail, $pdf_record_summary, $tat_db_records);
      $this->load->view('institute/generate_hospital_pdf_invoice', $result);
    }

    /**
     * Generate Bulk Reports
     *
     * @return void
     */
    public function generateBulkReports() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      if (!empty($_GET['id'])) {
        $records_ids['id'] = $_GET['id'];
        $record_data[] = $_GET['id'];
        $data = array(
          'ura_bulk_report_user_id' => $user_id,
          'ura_bulk_report_record_data' => $_GET['id'],
          'ura_bulk_report_timestamp' => time()
        );
        $this->db->insert('uralensis_bulk_report_history', $data);
        $this->load->view('institute/generate_bulk_report', $records_ids);
      }
    }

    /**
     * Download Document Files
     *
     * @return void
     */
    public function download_document_file() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $db_file = '';
      if (!empty($_GET)) {
        $file_id = $this->input->get('file_id');
        $db_result = $this->db->select('ura_upload_area_filepath, ura_upload_area_filename')->from('uralensis_upload_area')->where('ura_upload_area_id', $file_id)->get()->row_array();
        if (!empty($db_result)) {
          $file_path = $db_result['ura_upload_area_filepath'];
          $file_name = $db_result['ura_upload_area_filename'];
          $json['type'] = 'success';
          $json['file_path'] = $file_path;
          $json['file_name'] = $file_name;
          echo json_encode($json);
          die;
        }
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
        $this->Ion_auth_model->identity_column = $this->config->item('identity', 'ion_auth');
        $this->Ion_auth_model->tables = $this->config->item('tables', 'ion_auth');
        $query = $this->db->select($this->Ion_auth_model->identity_column . ", AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
          AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,username, email, id, password, active, last_login, memorable")
        ->where('id', $admin_id)
        ->limit(1)
        ->order_by('id', 'desc')
        ->get($this->Ion_auth_model->tables['users']);
        $user = $query->row();
        if (insert_logout_time() == TRUE) {
          insert_logout_time();
        }
        $session_data = array(
          'identity' => $user->email,
          'username' => $user->username,
          'email' => $user->email,
                'user_id' => $user->id, //everyone likes to overwrite id so we'll use user_id
                'old_last_login' => $user->last_login,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
              );
        $this->session->set_userdata($session_data);
        update_logout_activity();
        $_SESSION['activity_detail'] = $_SESSION['pre_activity'];
        unset($_SESSION['admin_id']);
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
     * Save Incident reports
     *
     * @return void
     */
    public function saveIncidentReport() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      $user_id = $this->ion_auth->user()->row()->id;
      if (!empty($_POST)) {
            //Check if any filed is empty
        foreach ($_POST as $key => $val) {
          if (empty($val)) {
            $json['type'] = 'error';
            $json['msg'] = 'All Fields Mandatory.';
            echo json_encode($json);
            die;
          }
        }
            //Prepare Data
        $prepare_data = array(
          'ura_incident_data' => serialize($_POST),
          'ura_incident_user_id' => intval($user_id),
          'timestamp' => time()
        );
        $this->db->insert('uralensis_incident_reports', $prepare_data);
        $incident_report_id = $this->db->insert_id();
        $recipient_id = intval(1);
        $msg_subject = 'Incident Report Submitted By: ' . uralensisGetUsername($user_id, 'fullname');
        if (!empty($incident_report_id)) {
          $incident_data = $this->db->where('ura_incident_reports_id', $incident_report_id)->get('uralensis_incident_reports')->row_array();
          $data = unserialize($incident_data['ura_incident_data']);
        }
            //Prepare Message Body
        $output = '';
        $output .= "<h3 class='text-center'>INCIDENT REPORTS</h3>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Details of Person Reporting the Incident</b></td></tr>
        <tr><td width='50%'><b>Type</b></td><td>" . $data['person_type'] . "</td></tr>
        <tr><td><b>Subtype</b></td><td>" . $data['person_subtype'] . "</td></tr>
        <tr><td><b>Title</b></td><td>" . $data['person_title'] . "</td></tr>
        <tr><td><b>First Name</b></td><td>" . $data['person_first_name'] . "</td></tr>
        <tr><td><b>Surname</b></td><td>" . $data['person_surname'] . "</td></tr>
        <tr><td><b>Telephone</b></td><td>" . $data['person_telephone'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Incident Details</b></td></tr>
        <tr><td width='50%'><b>Incident Date</b></td><td>" . $data['inc_detail_date'] . "</td></tr>
        <tr><td><b>Time</b></td><td>" . $data['inc_detail_time'] . "</td></tr>
        <tr><td><b>Main Location</b></td><td>" . $data['inc_detail_main_loca'] . "</td></tr>
        <tr><td><b>Division</b></td><td>" . $data['inc_detail_division'] . "</td></tr>
        <tr><td><b>Specialty</b></td><td>" . $data['inc_detail_specialty'] . "</td></tr>
        <tr><td><b>Location (type)	</b></td><td>" . $data['inc_detail_loca_type'] . "</td></tr>
        <tr><td><b>Location (exact)	</b></td><td>" . $data['inc_detail_loca_exact'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Description and Immediate Action Taken</b></td></tr>
        <tr><td width='50%'><b>Description of incident</b></td><td>" . $data['desc_immed_desc_inci'] . "</td></tr>
        <tr><td><b>Immediate action taken</b></td><td>" . $data['desc_immed_immediate_action'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Type of Incident and Result</b></td></tr>
        <tr><td width='50%'><b>Type of Incident</b></td><td>" . $data['type_inci_type'] . "</td></tr>
        <tr><td><b>Detail</b></td><td>" . $data['type_inci_detail'] . "</td></tr>
        <tr><td><b>Adverse event</b></td><td>" . $data['type_inci_adverse_event'] . "</td></tr>
        <tr><td><b>Result</b></td><td>" . $data['type_inci_result'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Additional Information: People Affected</b></td></tr>
        <tr><td width='50%'><b>Person Type</b></td><td>" . $data['peop_affec1_type'] . "</td></tr>
        <tr><td><b>Title</b></td><td>" . $data['peop_affec1_title'] . "</td></tr>
        <tr><td><b>First names</b></td><td>" . $data['peop_affec1_f_name'] . "</td></tr>
        <tr><td><b>Surname</b></td><td>" . $data['peop_affec1_surname'] . "</td></tr>
        <tr><td><b>Address</b></td><td>" . $data['peop_affec1_address'] . "</td></tr>
        <tr><td><b>Postcode</b></td><td>" . $data['peop_affec1_postcode'] . "</td></tr>
        <tr><td><b>Telephone</b></td><td>" . $data['peop_affec1_tel'] . "</td></tr>
        <tr><td><b>Email</b></td><td>" . $data['peop_affec1_email'] . "</td></tr>
        <tr><td><b>Gender</b></td><td>" . $data['peop_affec1_gender'] . "</td></tr>
        <tr><td><b>Ethnicity</b></td><td>" . $data['peop_affec1_ethnicity'] . "</td></tr>
        <tr><td><b>Was the person injured in the incident?	</b></td><td>" . $data['peop_affec1_was_person_injur'] . "</td></tr>
        <tr><td colspan='2'><b>Additional Information: People Affected</b></td></tr>
        <tr><td width='50%'><b>Person Type</b></td><td>" . $data['peop_affec2_type'] . "</td></tr>
        <tr><td><b>Title</b></td><td>" . $data['peop_affec2_title'] . "</td></tr>
        <tr><td><b>First names</b></td><td>" . $data['peop_affec2_f_name'] . "</td></tr>
        <tr><td><b>Surname</b></td><td>" . $data['peop_affec2_surname'] . "</td></tr>
        <tr><td><b>Address</b></td><td>" . $data['peop_affec2_address'] . "</td></tr>
        <tr><td><b>Postcode</b></td><td>" . $data['peop_affec2_postcode'] . "</td></tr>
        <tr><td><b>Telephone</b></td><td>" . $data['peop_affec2_tel'] . "</td></tr>
        <tr><td><b>Email</b></td><td>" . $data['peop_affec2_email'] . "</td></tr>
        <tr><td><b>Gender</b></td><td>" . $data['peop_affec2_gender'] . "</td></tr>
        <tr><td><b>Ethnicity</b></td><td>" . $data['peop_affec2_ethnicity'] . "</td></tr>
        <tr><td><b>Was the person injured in the incident?	</b></td><td>" . $data['peop_affec2_was_person_injur'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Anyone else involved in the incident</b></td></tr>
        <tr><td width='50%'><b>Other Contact</b></td><td>" . $data['any_inv_inci_other_cont'] . "</td></tr>
        <tr><td><b>How was this person involved?</b></td><td>" . $data['any_inv_inci_pers_inv'] . "</td></tr>
        <tr><td><b>Type</b></td><td>" . $data['any_inv_inci_type'] . "</td></tr>
        <tr><td><b>Title</b></td><td>" . $data['any_inv_inci_title'] . "</td></tr>
        <tr><td><b>First names</b></td><td>" . $data['any_inv_inci_f_name'] . "</td></tr>
        <tr><td><b>Surname</b></td><td>" . $data['any_inv_inci_surname'] . "</td></tr>
        <tr><td><b>Address</b></td><td>" . $data['any_inv_inci_address'] . "</td></tr>
        <tr><td><b>Postcode</b></td><td>" . $data['any_inv_inci_postcode'] . "</td></tr>
        <tr><td><b>Telephone</b></td><td>" . $data['any_inv_inci_tel'] . "</td></tr>
        <tr><td><b>Email</b></td><td>" . $data['any_inv_inci_email'] . "</td></tr>
        <tr><td><b>Gender</b></td><td>" . $data['any_inv_inci_gender'] . "</td></tr>
        <tr><td><b>Ethnicity</b></td><td>" . $data['any_inv_inci_ethnicity'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Equipment Details</b></td></tr>
        <tr><td width='50%'><b>Product Type</b></td><td>" . $data['equip_detail_type'] . "</td></tr>
        <tr><td><b>Brand name</b></td><td>" . $data['equip_detail_brand_name'] . "</td></tr>
        <tr><td><b>Serial No</b></td><td>" . $data['equip_detail_serial_no'] . "</td></tr>
        <tr><td><b>Description of device</b></td><td>" . $data['equip_detail_desc_device'] . "</td></tr>
        <tr><td><b>Description of effect</b></td><td>" . $data['equip_detail_desc_effect'] . "</td></tr>
        <tr><td><b>Current location</b></td><td>" . $data['equip_detail_curr_loca'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Medication Involved</b></td></tr>
        <tr><td width='50%'><b>Was this medication incident?</b></td><td>" . $data['medic_inv_was_medic_inci'] . "</td></tr>
        <tr><td><b>Was this an incident of violence or aggression towards staff?</b></td><td>" . $data['medic_inv_was_inci_viol'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Security Involved Incident</b></td></tr>
        <tr><td width='50%'><b>If Security was called or involved in this incident you must put “YES” in this box.</b></td><td>" . $data['secur_inv_inci_was_medic_inci'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Dementia or Learning Difficulties</b></td></tr>
        <tr><td width='50%'><b>Does this patient have dementia or learning Disabilities</b></td><td>" . $data['dementia_learn_does_patient_dementia'] . "</td></tr>
        <tr><td><b>Pressure Sore hospital or Community Acquired</b></td><td>" . $data['dementia_learn_pressure_sore'] . "</td></tr>
        <tr><td><b>Witnessed or Unwitnessed Patient Fall</b></td><td>" . $data['dementia_learn_witness_patient_fall'] . "</td></tr>
        </table>
        <br>
        <table border='1' width='100%'>
        <tr><td colspan='2'><b>Incident Report</b></td></tr>
        <tr><td width='50%'><b>Harm Level (see appendix 2)</b></td><td>" . $data['incident_report_harm_level'] . "</td></tr>
        <tr><td><b>Responsibility</b></td><td>" . $data['incident_report_responsibility'] . "</td></tr>
        </table>";
        $msg_body = $output;
        if ($this->Pm_model->send_message($recipient_id, $msg_subject, $msg_body, TRUE, '', '', '')) {
          $json['type'] = 'success';
          $json['msg'] = 'Incident Report Added Successfully.';
          echo json_encode($json);
          die;
        } else {
          $json['type'] = 'error';
          $json['msg'] = 'Something went wrong while sending your message.';
          echo json_encode($json);
          die;
        }
      }
    }

    /**
     * Save Incident reports
     *
     * @param int $record_id
     * @return void
     */
    public function editIncidentReport($record_id = '') {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $data = array();
      if (!empty($record_id)) {
        $data['inciden_report_edit'] = $this->db->where('ura_incident_reports_id', $record_id)->get('uralensis_incident_reports')->row_array();
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/edit_incident_reports', $data);
      $this->load->view('institute/inc/footer-new');
    }

    /**
     * Update Incident reports
     *
     * @return void
     */
    public function updateIncidentReport() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $user_id = $this->ion_auth->user()->row()->id;
      if (!empty($_POST)) {
            //Check if any filed is empty
        foreach ($_POST as $key => $val) {
          if (empty($val)) {
            $json['type'] = 'error';
            $json['msg'] = 'All Fields Mandatory.';
            echo json_encode($json);
            die;
          }
        }
        $record_id = $this->input->post('incident_report_id');
            //Prepare Data
        $prepare_data = array(
          'ura_incident_data' => serialize($_POST),
          'ura_incident_user_id' => intval($user_id),
          'timestamp' => time()
        );
        $this->db->where('ura_incident_reports_id', $record_id)->update('uralensis_incident_reports', $prepare_data);
        $json['type'] = 'success';
        $json['msg'] = 'Incident Report Updated Successfully.';
        echo json_encode($json);
        die;
      }
    }

    /**
     * Delete Incident Report
     *
     * @return void
     */
    public function deleteIncidentReport() {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      $json = array();
      if (!empty($_POST)) {
        $recordid = $this->input->post('recordid');
        $this->db->where('ura_incident_reports_id', $recordid);
        $this->db->delete('uralensis_incident_reports');
        $json['type'] = 'success';
        $json['msg'] = 'Report Deleted Successfully';
        echo json_encode($json);
        die;
      }
    }

    /**
     * View Incident Reports
     *
     * @param int $record_id
     * @return void
     */
    public function viewIncidentReport($record_id = '') {
      if (!$this->ion_auth->logged_in()) {
        redirect('auth/login', 'refresh');
      }
      if (!empty($record_id)) {
        $data['inciden_report_view'] = $this->db->where('ura_incident_reports_id', $record_id)->get('uralensis_incident_reports')->row_array();
      }
      $this->load->view('institute/inc/header');
      $this->load->view('institute/view_incident_report', $data);
      $this->load->view('institute/inc/footer-new');
    }

    public function support() {
      $title = "Support";
      $data = array('home_url' => '/institue');
      $this->load->view('institute/inc/header-new');
      $this->load->view('/support', $data);
      $this->load->view('institute/inc/footer-new');
    }

    // Settings page for hospital
    public function settings() 
    {   
      

      if (!$this->ion_auth->logged_in()) 
      {
        redirect('auth/login', 'refresh');
      }

      if ($this->input->method() === 'get') 
      {

        $data = array();
        $h_f_data = array();
        $h_f_data['javascripts'] = array(
          '/js/typeahead.jquery.js',
          '/newtheme/js/custom_js/admin_settings.js',
          '/js/institute/settings.js',
          'password/js/jquery.passwordRequirements.min.js',
          'password/js/custom.js'
        );

        $h_f_data['styles'] = array('password/css/jquery.passwordRequirements.css');
        $data['countries'] = $this->Institute_model->get_countries();
        $data["group_type"] = $this->group_type; 

        $data["group_id"] = $this->group_id; 
        $data["user_id"] = $this->user_id; 

        $data['errors'] = FALSE;
        if (!empty($_SESSION['form_data'])) 
        {
          $data['errors'] = TRUE;
          $data['hospital_data'] = $_SESSION['form_data'];
        } 
        else 
        {
          $hospital_data = $this->Institute_model->get_hospital_information();

				//print_r($hospital_data);
          $data['hospital_data'] = $hospital_data;
        }
			//exit;
        $data['has_user_error'] = FALSE;
        if (!empty($_SESSION['user_error'])) 
        {
          $data['user_data'] = $_SESSION['user_data']['form_data'];
          $data['user_error'] = $_SESSION['user_data']['form_error'];
          $data['has_user_error'] = TRUE;
        }
        else {
          $data['user_data'] = array(
            'first_name' => '',
            'last_name' => '',
            'company' => '',
            'phone' => '',
            'memorable' => '',
            'email' => '',
            'password' => '',
            'password_confirm' => '',
            'group_id' => '',
            'active_directory_user' => ''
          );
          $data['user_error'] = array();
        }
        $huserCount = $this->Huser_model->get_hospital_users('all','count');
        $data['huserCount'] = $huserCount;

        $data['hospital_users'] = $this->Institute_model->get_hospital_users();
        $hospitalIds = $this->ion_auth->get_user_group_type();
         //print   $user_id = $this->ion_auth->user()->row()->id;
        $hospitalId = $this->ion_auth->get_user_group_type()->row()->id;
		 //exit;
        $data['hospital_users_new'] = $this->ion_auth->get_institute_users($hospitalId)->result();
        $data['courier_users'] = $this->Institute_model->get_courier_users($hospitalId)->result();

//            echo "<pre>";print_r($data['courier_users']);exit;

        $data['hospital_finance'] = $this->Institute_model->get_hospital_finance();
            #get Hospital Main groups
        $groupQry = "SELECT * FROM groups WHERE parent_group_type ='H' AND group_type !='HA'";
        $qryResult = $this->db->query($groupQry)->result_array(); 
        $data["hospital_mainGroups"] = $qryResult; 
        $getPathalogistGroup = "SELECT * FROM groups WHERE parent_group_type ='P'";
        $pathalogistQry = $this->db->query($getPathalogistGroup)->result_array();
        $data["pathalogist_group"] = $pathalogistQry;
//                        echo 1; exit;
        $data['networks'] = $this->db->get_where('groups', array('group_type' => 'N'))->result_array();
        $data['division'] = $this->Huser_model->get_division_list();
        // echo "<pre>"; print_r(json_encode($data['division']));die;
        $data['HAusers'] = $this->Huser_model->get_hospital_users('63','count');
        $data['CSusers'] = $this->Huser_model->get_hospital_users('33','count');
        $data['Rusers'] = $this->Huser_model->get_hospital_users('45','count');
        $data['HSusers'] = $this->Huser_model->get_hospital_users('14','count');
        $data['CANusers'] = $this->Huser_model->get_hospital_users('15','count');


        $this->load->view('templates/header-new', $h_f_data);
        $this->load->view('institute/hospital_settings.php', $data);
        $this->load->view('templates/footer-new', $h_f_data);
      } 
      else if ($this->input->method() === 'post') 
      {
        $this->form_validation->set_rules('hospital_name', 'Institute Name', 'trim|required');
        $this->form_validation->set_rules('hospital_initials_1', 'First Initial', 'trim|required|exact_length[1]');
        $this->form_validation->set_rules('hospital_initials_2', 'Second Initial', 'trim|required|exact_length[1]');
        $this->form_validation->set_rules('hospital_email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('hospital_website', 'Website', 'trim|valid_url');
        if ($this->form_validation->run() === TRUE) {
                // Save hospital information
          $main_group_info = array(
            'description' => $this->input->post('hospital_name'),
            'first_initial' => $this->input->post('hospital_initials_1'),
            'last_initial' => $this->input->post('hospital_initials_2'),
            'name' => strtolower(str_replace(' ', '', $this->input->post('hospital_name'))),
          );
          $hospital_info = array(
            'hosp_address' => $this->input->post('hospital_address'),
            'hosp_country' => $this->input->post('hospital_country'),
            'hosp_city' => $this->input->post('hospital_city'),
            'hosp_state' => $this->input->post('hospital_state'),
            'hosp_post_code' => $this->input->post('hospital_post_code'),
            'hosp_email' => $this->input->post('hospital_email'),
            'hosp_phone' => $this->input->post('hospital_number'),
            'hosp_mobile' => $this->input->post('hospital_mobile_num'),
            'hosp_fax' => $this->input->post('hospital_fax'),
            'hosp_website' => $this->input->post('hospital_website'),
          );

          $this->Institute_model->save_hospital_data($main_group_info, $hospital_info);


          $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
          $hospital_finance_info = array(
            'hospital_id' => $hospital_id,
            'sales_account_no' => $this->input->post('sales_account_no'),
            'sales_project' => $this->input->post('sales_project'),
            'purchase_account_no' => $this->input->post('purchase_account_no'),
            'purchase_project' => $this->input->post('purchase_project'),
            'sales_vat' => $this->input->post('sales_vat'),
            'purchase_vat' => $this->input->post('purchase_vat'),
            'comp_reg_number' => $this->input->post('comp_reg_number'),
            'sales_discount' => $this->input->post('sales_discount'),
            'card_limit_amount' => $this->input->post('card_limit_amount'),
            'block_limit' => $this->input->post('block_limit'),
            'bill_due_date' => $this->input->post('bill_due_date'),
          );
          $this->Institute_model->save_hospital_financedata($hospital_finance_info);


          return redirect('/institute/settings', 'refresh');
        } else {
          $form_data = array(
            'hospital_name' => array(
              'value' => $this->input->post('hospital_name'),
              'error' => form_error('hospital_name')
            ),
            'hospital_initials_1' => array(
              'value' => $this->input->post('hospital_initials_1'),
              'error' => form_error('hospital_initials_1')
            ),
            'hospital_initials_2' => array(
              'value' => $this->input->post('hospital_initials_2'),
              'error' => form_error('hospital_initials_2')
            ),
            'hospital_address' => array('value' => $this->input->post('hospital_address')),
            'hospital_country' => array('value' => $this->input->post('hospital_country')),
            'hospital_city' => array('value' => $this->input->post('hospital_city')),
            'hospital_province' => array('value' => $this->input->post('hospital_provice')),
            'hosptial_post_code' => array('value' => $this->input->post('hospital_post_code')),
            'hospital_email' => array('value' => $this->input->post('hospital_email'), 'error' => form_error('hospital_email')),
            'hospital_number' => array('value' => $this->input->post('hospital_number')),
            'hospital_mobile_num' => array('value' => $this->input->post('hospital_mobile_num')),
            'hospital_fax' => array('value' => $this->input->post('hospital_fax')),
            'hospital_post_code' => array('value' => $this->input->post('hospital_post_code')),
            'hospital_website' => array('value' => $this->input->post('hospital_website'), 'error' => form_error('hospital_website')),
            'hospital_information' => array('value' => $this->input->post('hospital_information')),
          );
          $this->session->set_flashdata('form_data', $form_data);
          return redirect(base_url('/institute/settings'), 'refresh');
        }
      }
    }

    function hospital_username_exist($desc) {
      $group_id = $this->ion_auth->get_users_groups()->row()->id;
      $this->db->select('id');
      $this->db->from('`groups`');
      $this->db->where('description', $desc);
      $this->db->where('id != ', $group_id);
      $result = $this->db->get()->result_array();
      if (empty($result)) {
        return TRUE;
      } else {
        $this->form_validation->set_message('hospital_name', 'Institute already exists');
        return FALSE;
      }
    }

    function get_hospital_account_holders() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
        // Get group id
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->where('group_id', $hospital_id);
      $result = $this->db->get('hospital_information')->result_array();
      $resp = array('account_holder' => '', 'deputy_account_holder' => '');

      if (count($result) !== 0) {
        $resp['account_holder'] = $result[0]['account_holder'] ? $result[0]['account_holder'] : '';
        $resp['deputy_account_holder'] = $result[0]['deputy_account_holder'] ? $result[0]['deputy_account_holder'] : '';
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($resp));
    }

    function set_hospital_account_holder() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->where('group_id', $hospital_id);
      $res = $this->db->get('hospital_information')->num_rows();
      $account_holder = $this->input->post('account_holder');
      if ($res === 0) {
        $data = array('group_id' => $hospital_id, 'account_holder' => $account_holder);
        $this->db->insert('hospital_information', $data);
      } else {
        $this->db->set('account_holder', $account_holder);
        $this->db->where('group_id', $hospital_id);
        $this->db->update('hospital_information');
      }
      custom_log("Hospital account holder changed");
    }

    function set_hospital_deputy_account_holder() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->where('group_id', $hospital_id);
      $res = $this->db->get('hospital_information')->num_rows();
      $deputy_account_holder = $this->input->post('deputy_account_holder');
      if ($res === 0) {
        $data = array('group_id' => $hospital_id, 'deputy_account_holder' => $deputy_account_holder);
        $this->db->insert('hospital_information', $data);
      } else {
        $this->db->set('deputy_account_holder', $deputy_account_holder);
        $this->db->where('group_id', $hospital_id);
        $this->db->update('hospital_information');
      }
      custom_log("Hospital deputy account holer changed");
    }

    function get_hospital_groups() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->join('groups', 'groups.id = hospital_group.group_id');
      $this->db->where('hospital_id', $hospital_id);
      $res = $this->db->get('hospital_group')->result_array();
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }

    function get_hospital_user_group() 
    {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;

      $this->db->join('groups', 'groups.id = users_groups.group_id');
      $this->db->where('institute_id', $hospital_id);
      $res = $this->db->get('users_groups')->result_array();
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }

    function get_group_users() {

      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $type = $this->input->get('type');
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_main_groups()->row();
      $hospital_id = $hospital_row->id;
      $res = $this->db
      ->select("
        `users`.`id` as id, 
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        profile_picture_path as profile_picture
        ")
      ->join('users', 'users.id = users_groups.user_id')
      ->join('groups', 'groups.id = users_groups.group_id')
      ->where('group_type', $type)
      ->where('institute_id', $hospital_id)
      ->get('users_groups')->result_array();
       // echo $this->db->last_query(); exit; 

      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }
    
    
    function get_group_users_lab() {
//        if (!$this->ion_auth->logged_in()) {
//            $this->output->set_status_header(401);
//            echo "Not authorized";
//            return;
//        }

      $type = $this->input->get('type');
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;

       // echo $hospital_id; exit; 
      $res = $this->db
      ->select("
        `users`.`id` as id, 
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        profile_picture_path as profile_picture
        ")
      ->join('users', 'users.id = users_groups.user_id')
      ->join('groups', 'groups.id = users_groups.group_id')
      ->where('group_type', $type)
      ->where('institute_id', $hospital_id)
      ->get('users_groups')->result_array();
//      echo $this->db->last_query(); exit; 

      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }

    function fetch_all_groups() 
    {
      $type = $this->input->get('type');
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->join('groups', 'groups.id = hospital_group.group_id');
      $this->db->where('hospital_id', $hospital_id);
      $this->db->where('group_type', $type);
      $res = $this->db->get('hospital_group')->result_array();
      for ($i = 0; $i < count($res); $i++) {
        $this->db->select("
          `users`.`id` as id, 
          AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
          AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
          AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
          profile_picture_path as profile_picture
          ", FALSE);
        $this->db->join('users', 'users.id = users_groups.user_id');
        $this->db->where('group_id', $res[$i]['id']);
        $users = $this->db->get('users_groups')->result_array();
        $res[$i]['users'] = $users;
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }

    function get_active_directory_users() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $type = $this->input->get('type');
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email
        ", FALSE);
      $this->db->join('users', 'users.id = users_groups.user_id');
      $this->db->join('groups', 'groups.id = users_groups.group_id');
      $this->db->where('group_type', $type);
      $this->db->where('in_directory', 1);
      $res = $this->db->get('users_groups')->result_array();
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }
    
    
    function get_active_directory_users_lab() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $type = $this->input->get('type');
      if (empty($type)) 
      {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $this->db->select("`users`.`id` as id, `users_groups`.`group_id` as group_id,  AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email
        ", FALSE);
      $this->db->join('users', 'users.id = users_groups.user_id');
      $this->db->join('groups', 'groups.id = users_groups.group_id');
      $this->db->where('group_type', $type);
   //   $this->db->where('in_directory', TRUE);
      $res = $this->db->get('users_groups')->result_array();
       //echo $this->db->last_query(); exit; 
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }

    function get_active_request_users() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $type = $this->input->get('type');
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }
      $year = 2021;
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $sql .= "SELECT * FROM request
      WHERE YEAR(request.request_datetime) = $year ";
      if (!empty($recent) && $recent === 'recent') {
        $sql .= " AND request.request_datetime >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH) ";
      }
      $sql .= " ORDER BY request.uralensis_request_id ASC";
      $query = $this->db->query($sql);
      $res = $query->result();
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res));
    }

    function get_user_details() 
    {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $user_id = $this->input->get('id');
      if (empty($user_id)) {
        $this->output->set_status_header(400);
        echo "User ID not provided";
        return;
      }
      $this->db->select("
        `users`.`id` as id,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        profile_picture_path as profile_picture
        ", FALSE);
      $this->db->where('users.id', $user_id);
      $res = $this->db->get('users')->result_array();
      if (count($res) === 0) {
        $this->output->set_status_header(404);
        return;
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res[0]));
    }
    
    
    
    function get_user_details_lab() {
//        if (!$this->ion_auth->logged_in()) {
//            $this->output->set_status_header(401);
//            echo "Not authorized";
//            return;
//        }
      $user_id = $this->input->get('id');
      if (empty($user_id)) {
        $this->output->set_status_header(400);
        echo "User ID not provided";
        return;
      }
      $this->db->select("
        `users`.`id` as id,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        profile_picture_path as profile_picture
        ", FALSE);
      $this->db->where('users.id', $user_id);
      $res = $this->db->get('users')->result_array();
      if (count($res) === 0) {
        $this->output->set_status_header(404);
        return;
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res[0]));
    }

    function get_request_details() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $user_id = $this->input->get('id');
      if (empty($user_id)) {
        $this->output->set_status_header(400);
        echo "User ID not provided";
        return;
      }
      $this->db->select("*");
      $this->db->where('	uralensis_request_id', $user_id);
      $res = $this->db->get('request')->result_array();
      if (count($res) === 0) {
        $this->output->set_status_header(404);
        return;
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res[0]));
    }

    function get_group_id() {
      if (!$this->ion_auth->logged_in()) {
        $this->output->set_status_header(401);
        echo "Not authorized";
        return;
      }
      $type = $this->input->get('type');
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }

      $res = $this->db->get_where('groups', array('group_type' => $type))->result_array();
      if (empty($res)) {
        $this->output->set_status_header(404);
        echo "Group not found";
        return;
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res[0]));
    }
    
    
    function get_group_id_lab() {

      $type = $this->input->get('type');
      echo $type ; exit; 
      if (empty($type)) {
        $this->output->set_status_header(400);
        echo "Group type not provided";
        return;
      }

      $res = $this->db->get_where('groups', array('group_type' => $type))->result_array();
      if (empty($res)) {
        $this->output->set_status_header(404);
        echo "Group not found";
        return;
      }
      $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($res[0]));
    }


    function create_user() 
    {
      if (!$this->ion_auth->logged_in()) {
        redirect('/', 'refresh');
        return;
      }

      $hospital_row = $this->ion_auth->get_users_main_groups()->row();
      $hospital_id = $hospital_row->id;
      if ($this->input->method() == 'post') 
      {

        $this->form_validation->set_rules('first_name', 'Frist Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('group_id', 'User group', 'trim|required');
        $this->form_validation->set_rules('active_directory_user', 'Active Directory', 'trim|required');
        if ($this->form_validation->run() === FALSE) 
          { 
          $form_errors = array(
            'first_name' => form_error('first_name'),
            'general' => array(
              'group_id' => form_error('group_id'),
              'active_directory_user' => form_error('active_directory_user')
            )
          );
          $this->session->set_flashdata('user_error', TRUE);
          $this->session->set_flashdata('user_data', array(
            'form_data' => array(
              'first_name' => set_value('first_name'),
              'last_name' => set_value('last_name'),
              'division_id' => set_value('division_id'),
              'department_id' => set_value('department_id'),
              'speciality_id' => set_value('speciality_id'),
              'category_id' => set_value('category_id'),
              'company' => set_value('company'),
              'email' => set_value('email'),
              'phone' => set_value('phone'),
              'memorable' => set_value('memorable'),
              'password' => set_value('password'),
              'password_confirm' => set_value('password_confirm'),
              'group_id' => $this->input->post('group_id'),
              'active_directory_user' => $this->input->post('active_directory_user')
            ),
            'form_error' => $form_errors,
          ));
          custom_log("Form validation failed");
          custom_log(validation_errors());
          redirect('/institute/settings', 'TRUE');
        } else {

          $ac = (int) $this->input->post('active_directory_user'); 
            // If new user then register this user
            // Check if group id if a lab or cancer service 
            // If group type_category is usergroup, check if that group belongs to hospital
            $group_id = $this->input->post('user_main_groups');
            //                echo $group_id; exit; 
            // echo $group_id; exit;
            //                $is_usergroup = $this->db->get_where('groups', array('type_cate' => 'usergroup', 'id' => $group_id))->num_rows() > 0;
            //                if ($is_usergroup) {
            //                    $res = $this->db->get_where('hospital_group', array('group_id' => $group_id, 'hospital_id' => $hospital_id))->num_rows();
            //                    if ($res === 0) {
            //                        custom_log('Usergroup does not belong to the hospital');
            //                        redirect('/institute/settings', 'refresh');
            //                        return;
            //                    }
            //                }

          if ($ac === 0) 
          {
            
            $email = $this->input->post('email');
            $res = $this->db->query("SELECT * FROM users WHERE AES_DECRYPT(email, '" . DATA_KEY . "') = '$email'")->num_rows();
            if ($res > 0) {
              $this->session->set_flashdata('user_error', TRUE);
              $this->session->set_flashdata('user_data', array(
                'form_data' => array(
                  'first_name' => set_value('first_name'),
                  'last_name' => set_value('last_name'),
                  'company' => set_value('company'),
                  'division_id' => set_value('division_id'),
                  'department_id' => set_value('department_id'),
                  'speciality_id' => set_value('speciality_id'),
                  'category_id' => set_value('category_id'),
                  'phone' => set_value('phone'),
                  'email' => set_value('email'),
                  'memorable' => set_value('memorable'),
                  'user_auth_pass' => set_value('pin_code'),
                  'password' => set_value('password'),
                  'password_confirm' => set_value('password_confirm'),
                  'group_id' => $group_id,
                  'active_directory_user' => $ac
                ),
                'form_error' => array('email' => 'User already exists'),
              ));
              custom_log('Email not unique');
              redirect('/institute/settings', 'refresh');
              return;
            }

                    // All checks performed. Create new user
                  $profile_picture = DEFAULT_PROFILE_PIC;
                    // Upload profile picture if exists 
                    if ($_FILES['profile_pic']["name"]) { //when user submit basic profile info with profile image
                      $config['upload_path'] = './uploads/';
                      $config['allowed_types'] = 'gif|jpg|png';
                      $config['max_size'] = '10000';
                      $config['file_name'] = time() . '-' . $_FILES['profile_pic']["name"];

                      $this->load->library('upload', $config);

                      if (!$this->upload->do_upload('profile_pic')) {
                        $error = 0;
                      } else {
                        $filedata = array('upload_data' => $this->upload->data());
                        $profile_image = $filedata['upload_data']['file_name'];
                        $image_path = 'uploads/' . $config['file_name'];
                        $profile_picture = $image_path;
                      }
                    }
                    $group_type = $this->db->get_where('groups', array('id' => $hospital_id))->result_array()[0]['group_type'];

                    $user_role = $this->input->post('user_role');
                    $roleArray = $this->Huser_model->get_role_id();
                    $group_id = $roleArray[$user_role];
                    $group_ids = $roleArray[$user_role];

                    
                    $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                    $additional_data = [
                      'username' => $this->db->escape($username),
                      'first_name' => $this->db->escape($this->input->post('first_name')),
                      'last_name' => $this->db->escape($this->input->post('last_name')),
                      'company' => $this->db->escape($this->input->post('company')),
                      'phone' => $this->db->escape($this->input->post('phone')),
                      'memorable' => $this->db->escape($this->input->post('memorable')),
                      'division_id' => $this->db->escape($this->input->post('division_id')),
                      'department_id'=> $this->db->escape($this->input->post('department_id')),
                      'speciality_id' => $this->db->escape($this->input->post('speciality_id')),
                      'category_id' => $this->db->escape($this->input->post('category_id')),
                      'user_auth_pass' => date('h'),
                      'is_hospital_admin' => 0,
                      'profile_picture_path' => $this->db->escape($profile_picture),
                      'user_type' => $this->db->escape($this->input->post('user_role')),
                      'group_id' => ""
                    ];
                    $identity_column = $this->config->item('identity', 'ion_auth');
                    $password = $this->input->post('password');
                    $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
                    
                    $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array($group_id), 0);

                    // Add user to current hospital

                    // $hospital_row = $this->ion_auth->get_users_main_groups()->row();
                    $hospital_row = $this->ion_auth->get_users_groups()->row();                   
                    $groupType= $hospital_row->group_type;
                    $hospital_id = $hospital_row->id;
                   
                    //$hospitalUserGroupArray = array("H","HA");
                    $hospitalUserGroupArray= HOSPITAL_GROUP;

                    if  (in_array($groupType, $hospitalUserGroupArray)) 
                    {					
                      $addCurrentHospital = array("institute_id" => $hospital_id,"user_id" =>$user_id,"group_id"=>$group_ids);
                      $this->db->insert("users_groups", $addCurrentHospital);
                    }
//                    $this->db
//                            ->set('institute_id', $hospital_id)
//                            ->where('user_id', $user_id)
//                            ->update('users_groups');

                    //Assign Leaves
                    $getLeaveGroup = $this->db->get_where('user_group_week', array('group_id' => $hospital_id))->row();
                    if (!empty($getLeaveGroup)) {
                      $this->load->model('Leave_model', 'leave_model');
                      $getLeaveGroups = $this->leave_model->leaveGroupTypes(array('leave_group_types.leave_group_id' => $getLeaveGroup->leave_group_id, 'leave_group_types.status' => 1));
                      $counter = 0;
                      foreach ($getLeaveGroups as $leaveData) {
                        $insBalance[$counter]['user_id'] = $user_id;
                        $insBalance[$counter]['leave_type_id'] = $leaveData->leave_type_id;
                        $insBalance[$counter]['total_leaves'] = $leaveData->days;
                        $insBalance[$counter]['quota'] = $leaveData->days;
                        $insBalance[$counter]['availed'] = 0;
                        $insBalance[$counter]['remaining'] = $leaveData->days;
                        $insBalance[$counter]['start_date'] = date("Y") . "-01-01";
                        $insBalance[$counter]['end_date'] = date("Y") . "-12-31";
                        $insBalance[$counter]['leave_year'] = date("Y");
                        $insBalance[$counter]['created_date'] = date("Y-m-d");
                        $insBalance[$counter]['created_by'] = $this->ion_auth->user()->row()->id;
                        $counter++;
                      }
                      $chkRecord = $this->leave_model->addBatchRecord('leave_balance', $insBalance);
                    }
                    $i = 0;
                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "company";
                    $metaData[$i++]['meta_value'] = $this->input->post('company');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "address1";
                    $metaData[$i++]['meta_value'] = $this->input->post('address1');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "address2";
                    $metaData[$i++]['meta_value'] = $this->input->post('address2');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "county";
                    $metaData[$i++]['meta_value'] = $this->input->post('county');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "country";
                    $metaData[$i++]['meta_value'] = $this->input->post('country');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "postcode";
                    $metaData[$i++]['meta_value'] = $this->input->post('postcode');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "telephone";
                    $metaData[$i++]['meta_value'] = $this->input->post('telephone');

                    $getRows = $this->db->get_where('usermeta', array('user_id' => $user_id))->num_rows();

                    if ($getRows >= 1) {
                      foreach ($metaData as $key => $data) {
                        $whereArray['user_id'] = $data['user_id'];
                        $whereArray['meta_key'] = $data['meta_key'];

                        $checkExist = $this->db->get_where('usermeta', $whereArray)->num_rows();
                        if ($checkExist >= 1) {
                          $this->db->update('usermeta', $metaData[$key], $whereArray);
                        } else {
                          $this->db->insert('usermeta', $metaData[$key]);
                        }
                      }
                    } else {
                      $this->db->insert_batch('usermeta', $metaData);
                    }
                    $this->sendVerificationEmail($email);
                    custom_log("New user created and registered");
                    redirect('/institute/settings', 'refresh');
                  } else {
                    // Get user from ac

                    $first_name = $this->input->post('first_name');
                    $last_name = $this->input->post('last_name');
                    $company = $this->input->post('company');
                    $phone = $this->input->post('phone');
                    $this->db->query("
                      UPDATE `users`
                      SET first_name = AES_ENCRYPT('$first_name', '" . DATA_KEY . "'),
                      last_name = AES_ENCRYPT('$last_name', '" . DATA_KEY . "'),
                      company = AES_ENCRYPT('$company', '" . DATA_KEY . "'),
                      phone = AES_ENCRYPT('$phone', '" . DATA_KEY . "')
                      where `users`.`id` = $ac
                      ");
                    $group_id = $this->input->post('group_id');
                    $this->db
                    ->set('group_id', $group_id)
                    ->where('user_id', $ac)
                    ->update('users_groups');

							//$this->user_id = $this->ion_auth->user()->row()->id;

                    $group_row = $this->ion_auth->get_users_groups()->row();
                    $this->group_type = $group_row->group_type;
                    $hospital_id = $group_row->id;


                  // print $hospital_row = $this->ion_auth->get_users_main_groups()->row();
                    //print $hospital_id = $hospital_row->id;
					//exit;

                    $addHospitalArr = array("institute_id" => $hospital_id,
                      "user_id"=> $ac);
                    $this->db->insert("users_groups", $addHospitalArr);


                    $i = 0;
                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "company";
                    $metaData[$i++]['meta_value'] = $this->input->post('company');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "address1";
                    $metaData[$i++]['meta_value'] = $this->input->post('address1');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "address2";
                    $metaData[$i++]['meta_value'] = $this->input->post('address2');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "county";
                    $metaData[$i++]['meta_value'] = $this->input->post('county');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "country";
                    $metaData[$i++]['meta_value'] = $this->input->post('country');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "postcode";
                    $metaData[$i++]['meta_value'] = $this->input->post('postcode');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "telephone";
                    $metaData[$i++]['meta_value'] = $this->input->post('telephone');


                    $getRows = $this->db->get_where('usermeta', array('user_id' => $ac))->num_rows();

                    if ($getRows >= 1) {
                      foreach ($metaData as $key => $data) {
                        $whereArray['user_id'] = $data['user_id'];
                        $whereArray['meta_key'] = $data['meta_key'];

                        $checkExist = $this->db->get_where('usermeta', $whereArray)->num_rows();
                        if ($checkExist >= 1) {
                          $this->db->update('usermeta', $metaData[$key], $whereArray);
                        } else {
                          $this->db->insert('usermeta', $metaData[$key]);
                        }
                      }
                    } else {
                      $this->db->insert_batch('usermeta', $metaData);
                    }


                    custom_log("User updated and registered");
                    redirect('/institute/settings', 'refresh');
                  }
                }
              } else {
                $this->output->set_status_header(404);
              }
            }


            function create_user_lab() {
//        if (!$this->ion_auth->logged_in()) {
//            redirect('/', 'refresh');
//            return;
//        }
              $hospital_row = $this->ion_auth->get_users_groups()->row();
              $hospital_id = $hospital_row->id;
              if ($this->input->method() == 'post') {

                $this->form_validation->set_rules('first_name', 'Frist Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_rules('group_id', 'User group', 'trim|required|is_natural');
                $this->form_validation->set_rules('active_directory_user', 'Active Directory', 'trim|required|is_natural');
                if ($this->form_validation->run() === FALSE) {
                  $form_errors = array(
                    'first_name' => form_error('first_name'),
                    'general' => array(
                      'group_id' => form_error('group_id'),
                      'active_directory_user' => form_error('active_directory_user')
                    )
                  );
                  $this->session->set_flashdata('user_error', TRUE);
                  $this->session->set_flashdata('user_data', array(
                    'form_data' => array(
                      'first_name' => set_value('first_name'),
                      'last_name' => set_value('last_name'),
                      'company' => set_value('company'),
                      'email' => set_value('email'),
                      'phone' => set_value('phone'),
                      'memorable' => set_value('memorable'),
                      'password' => set_value('password'),
                      'password_confirm' => set_value('password_confirm'),
                      'group_id' => $this->input->post('group_id'),
                      'active_directory_user' => $this->input->post('active_directory_user')
                    ),
                    'form_error' => $form_errors,
                  ));
                  custom_log("Form validation failed");
                  custom_log(validation_errors());
                  redirect('/institute/settings', 'TRUE');
                } else {

                  $ac = (int) $this->input->post('active_directory_user');
                // If new user then register this user
                // Check if group id if a lab or cancer service 
                // If group type_category is usergroup, check if that group belongs to hospital
                  $group_id = $this->input->post('group_id');
                # get User group ID 
                  $getUserGroupId = "SELECT * FROM users_groups WHERE institute_id > 0 and user_id = $this->user_id"; 
                  $groupQryRes = $this->db->query($getUserGroupId)->result_array();

                  $is_usergroup = $this->db->get_where('groups', array('type_cate' => 'usergroup', 'id' => $groupQryRes[0]["institute_id"]))->num_rows() > 0;
//                echo $this->db->last_query(); exit; 
//                if ($is_usergroup) {
//                    $res = $this->db->get_where('hospital_group', array('group_id' => $group_id, 'hospital_id' => $hospital_id))->num_rows();
//                    if ($res === 0) {
//                        custom_log('Usergroup does not belong to the hospital');
//                        redirect('/institute/settings', 'refresh');
//                        return;
//                    }
//                }
                  if ($ac === 0) {

                    // Check if the email exists
                    $email = $this->input->post('email');
                    $res = $this->db->query("SELECT * FROM users WHERE AES_DECRYPT(email, '" . DATA_KEY . "') = '$email'")->num_rows();
                   // echo $this->db->last_query(); exit; 
                    if ($res > 0) {
                      $this->session->set_flashdata('user_error', TRUE);
                      $this->session->set_flashdata('user_data', array(
                        'form_data' => array(
                          'first_name' => set_value('first_name'),
                          'last_name' => set_value('last_name'),
                          'company' => set_value('company'),
                          'phone' => set_value('phone'),
                          'email' => set_value('email'),
                          'memorable' => set_value('memorable'),
                          'user_auth_pass' => set_value('pin_code'),
                          'password' => set_value('password'),
                          'password_confirm' => set_value('password_confirm'),
                          'group_id' => $group_id,
                          'active_directory_user' => $ac
                        ),
                        'form_error' => array('email' => 'User already exists'),
                      ));
                      custom_log('Email not unique');
                      redirect('/institute/settings', 'refresh');
                      return;
                    }
                    // All checks performed. Create new user
                    $profile_picture = DEFAULT_PROFILE_PIC;
                    // Upload profile picture if exists 
                    if ($_FILES['profile_pic']["name"]) { //when user submit basic profile info with profile image
                      $config['upload_path'] = './uploads/';
                      $config['allowed_types'] = 'gif|jpg|png';
                      $config['max_size'] = '10000';
                      $config['file_name'] = time() . '-' . $_FILES['profile_pic']["name"];

                      $this->load->library('upload', $config);

                      if (!$this->upload->do_upload('profile_pic')) {
                        $error = 0;
                      } else {
                        $filedata = array('upload_data' => $this->upload->data());
                        $profile_image = $filedata['upload_data']['file_name'];
                        $image_path = 'uploads/' . $config['file_name'];
                        $profile_picture = $image_path;
                      }
                    }
                    $group_type = $this->db->get_where('groups', array('id' => $groupQryRes[0]["institute_id"]))->result_array()[0]['group_type'];
                  //  echo $this->db->last_query(); exit; 
                    $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                    $additional_data = [
                      'username' => $this->db->escape($username),
                      'first_name' => $this->db->escape($this->input->post('first_name')),
                      'last_name' => $this->db->escape($this->input->post('last_name')),
                      'company' => $this->db->escape($this->input->post('company')),
                      'phone' => $this->db->escape($this->input->post('phone')),
                      'memorable' => $this->db->escape($this->input->post('memorable')),
                      'user_auth_pass' => '' . $this->db->escape($this->input->post('pin_code')) . '',
                      'is_hospital_admin' => 0,
                      'profile_picture_path' => $this->db->escape($profile_picture),
                      'user_type' => $this->db->escape($group_type),
                      'group_id' => ""
                    ];
                    $identity_column = $this->config->item('identity', 'ion_auth');
                    $password = $this->input->post('password');
                    $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
                 //   echo $this->input->post('user_group_type'); exit; 
                    $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array($this->input->post('user_group_type')), 0);
                   // echo $user_id; exit; 
                    // Add user to current hospital
                    #Add user another row for related group id; 
                    $addGroupArr = array("institute_id" => $groupQryRes[0]["institute_id"],
                      "user_id" => $user_id);
                    
                    $this->db->insert('users_groups', $addGroupArr); 
                   // echo $this->db->last_query(); exit; 
//                    
//                    $this->db
//                            ->set('institute_id', $groupQryRes[0]["institute_id"])
//                            ->where('user_id', $user_id)
//                            ->update('users_groups');

                    //Assign Leaves
                    $getLeaveGroup = $this->db->get_where('user_group_week', array('group_id' => $hospital_id))->row();
                    if (!empty($getLeaveGroup)) {
                      $this->load->model('Leave_model', 'leave_model');
                      $getLeaveGroups = $this->leave_model->leaveGroupTypes(array('leave_group_types.leave_group_id' => $getLeaveGroup->leave_group_id, 'leave_group_types.status' => 1));
                      $counter = 0;
                      foreach ($getLeaveGroups as $leaveData) {
                        $insBalance[$counter]['user_id'] = $user_id;
                        $insBalance[$counter]['leave_type_id'] = $leaveData->leave_type_id;
                        $insBalance[$counter]['total_leaves'] = $leaveData->days;
                        $insBalance[$counter]['quota'] = $leaveData->days;
                        $insBalance[$counter]['availed'] = 0;
                        $insBalance[$counter]['remaining'] = $leaveData->days;
                        $insBalance[$counter]['start_date'] = date("Y") . "-01-01";
                        $insBalance[$counter]['end_date'] = date("Y") . "-12-31";
                        $insBalance[$counter]['leave_year'] = date("Y");
                        $insBalance[$counter]['created_date'] = date("Y-m-d");
                        $insBalance[$counter]['created_by'] = $this->ion_auth->user()->row()->id;
                        $counter++;
                      }
                      $chkRecord = $this->leave_model->addBatchRecord('leave_balance', $insBalance);
                    }
                    $i = 0;
                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "company";
                    $metaData[$i++]['meta_value'] = $this->input->post('company');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "address1";
                    $metaData[$i++]['meta_value'] = $this->input->post('address1');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "address2";
                    $metaData[$i++]['meta_value'] = $this->input->post('address2');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "county";
                    $metaData[$i++]['meta_value'] = $this->input->post('county');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "country";
                    $metaData[$i++]['meta_value'] = $this->input->post('country');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "postcode";
                    $metaData[$i++]['meta_value'] = $this->input->post('postcode');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "telephone";
                    $metaData[$i++]['meta_value'] = $this->input->post('telephone');

                    $getRows = $this->db->get_where('usermeta', array('user_id' => $user_id))->num_rows();

                    if ($getRows >= 1) {
                      foreach ($metaData as $key => $data) {
                        $whereArray['user_id'] = $data['user_id'];
                        $whereArray['meta_key'] = $data['meta_key'];

                        $checkExist = $this->db->get_where('usermeta', $whereArray)->num_rows();
                        if ($checkExist >= 1) {
                          $this->db->update('usermeta', $metaData[$key], $whereArray);
                        } else {
                          $this->db->insert('usermeta', $metaData[$key]);
                        }
                      }
                    } else {
                      $this->db->insert_batch('usermeta', $metaData);
                    }
                    $this->sendVerificationEmail($email);
                    custom_log("New user created and registered");
                    redirect('/institute/settings', 'refresh');
                  } else {
                    // Get user from ac
                    $first_name = $this->input->post('first_name');
                    $last_name = $this->input->post('last_name');
                    $company = $this->input->post('company');
                    $phone = $this->input->post('phone');
                    $this->db->query("
                      UPDATE `users`
                      SET first_name = AES_ENCRYPT('$first_name', '" . DATA_KEY . "'),
                      last_name = AES_ENCRYPT('$last_name', '" . DATA_KEY . "'),
                      company = AES_ENCRYPT('$company', '" . DATA_KEY . "'),
                      phone = AES_ENCRYPT('$phone', '" . DATA_KEY . "')
                      where `users`.`id` = $ac
                      ");
                    $this->db
                    ->set('institute_id', $groupQryRes[0]["institute_id"])
                    ->set('group_id', NULL)
                    ->where('user_id', $ac)
                    ->update('users_groups');
                    
                    
                    $insGroupArray = array("user_id" => $ac,
                      "group_id" => $this->input->post('user_group_type'));
                    $this->db->insert("users_groups", $insGroupArray);
                    


                    $i = 0;
                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "company";
                    $metaData[$i++]['meta_value'] = $this->input->post('company');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "address1";
                    $metaData[$i++]['meta_value'] = $this->input->post('address1');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "address2";
                    $metaData[$i++]['meta_value'] = $this->input->post('address2');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "county";
                    $metaData[$i++]['meta_value'] = $this->input->post('county');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "country";
                    $metaData[$i++]['meta_value'] = $this->input->post('country');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "postcode";
                    $metaData[$i++]['meta_value'] = $this->input->post('postcode');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "telephone";
                    $metaData[$i++]['meta_value'] = $this->input->post('telephone');


                    $getRows = $this->db->get_where('usermeta', array('user_id' => $ac))->num_rows();

                    if ($getRows >= 1) {
                      foreach ($metaData as $key => $data) {
                        $whereArray['user_id'] = $data['user_id'];
                        $whereArray['meta_key'] = $data['meta_key'];

                        $checkExist = $this->db->get_where('usermeta', $whereArray)->num_rows();
                        if ($checkExist >= 1) {
                          $this->db->update('usermeta', $metaData[$key], $whereArray);
                        } else {
                          $this->db->insert('usermeta', $metaData[$key]);
                        }
                      }
                    } else {
                      $this->db->insert_batch('usermeta', $metaData);
                    }


                    custom_log("User updated and registered");
                    redirect('/institute/settings', 'refresh');
                  }
                }
              } else {
                $this->output->set_status_header(404);
              }
            }


            public function sendVerificationEmail($email) {
              $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'ISO-8859-1',
                'wordwrap' => TRUE
              );
              $this->load->library('email', $config);
//        $logo = $this->email->attach("./uploads/logo/uralensis_latest.jpg", "inline");
//        $cid = $this->email->attachment_cid($logo);
              $message = $this->load->view("auth/email/verify_email", array('email' => $email), true);
              $this->email->set_mailtype("html");
              $this->email->from($this->session->email, 'PathHub');
              $this->email->to($email);
              $this->email->set_header('Content-Type', 'text/html');
              $this->email->subject("Pathology Healthcare Email Verification");
              $this->email->message($message);
              $this->email->send();
//        if(!$this->email->send()){
//            print_r($this->email->print_debugger());
//        }
            }

            public function group_exists() {
              if (!$this->ion_auth->logged_in()) {
                $this->output->set_status_header(401);
                echo "Not authorized";
                return;
              }
              if ($this->input->get('name')) {
                $name = $this->input->get('name');
                custom_log($name, 'Searching for this name');
                $res = $this->db->get_where('groups', array('description' => $name))->num_rows();
                $exists = $res > 0 ? 1 : 0;
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($exists));
              } else {
                $this->output->set_status_header(400);
                echo "Provide group name";
                return;
              }
            }

            public function create_group() {
              if (!$this->ion_auth->logged_in()) {
                redirect('/', 'refresh');
                return;
              }
              $hospital_row = $this->ion_auth->get_users_groups()->row();
              $hospital_id = $hospital_row->id;
              if ($this->input->method() == 'post') {
                $name = $this->input->post('name');
                $first_initial = $this->input->post('first_initial');
                $last_initial = $this->input->post('last_initial');
                $lab_mask = $this->input->post('lab_mask');
                $group_type = $this->input->post('group_type');
                if ($group_type !== 'L' && $group_type !== 'CS') {
                  redirect('/institute/settings', 'refresh');
                  return;
                }
                $this->db->insert('groups', array(
                  'name' => strtolower(str_replace(' ', '', $name)),
                  'description' => $name,
                  'first_initial' => $first_initial,
                  'last_initial' => $last_initial,
                  'lab_mask' => $lab_mask,
                  'group_type' => $group_type,
                  'type_cate' => 'usergroup'
                ));
                $group_id = $this->db->insert_id();
                $this->db->insert('hospital_group', array(
                  'hospital_id' => $hospital_id,
                  'group_id' => $group_id
                ));
                redirect('/institute/settings', 'refresh');
              } else {
                $this->output->set_status_header('404');
              }
            }

            public function update_password_time() {
              if (!$this->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
              }
              if ($this->input->method() == 'post') {
                $this->form_validation->set_rules('num_days', 'No. of Days', 'required|numeric');
                if ($this->form_validation->run() == FALSE) {
                  $response['status'] = "fail";
                  $response['message'] = validation_errors();
                } else {
                  if (isset($_POST['hospital_id']) and $_POST['hospital_id'] != "") {
                    $group_id = $_POST['hospital_id'];
                  } else {
                    $group_id = $this->ion_auth->get_users_groups()->row()->id;
                  }
                  $num_days = $this->input->post('num_days');

                  $res = $this->db->get_where('password_expiry_settings', array('group_id' => $group_id))->num_rows();
                  if ($res == 0) {
                    $this->db->insert('password_expiry_settings', array(
                      'group_id' => $group_id,
                      'days' => $num_days
                    ));
                  } else {
                    $this->db->where('group_id', $group_id);
                    $this->db->update('password_expiry_settings', array("days" => $num_days));
                  }
                  $response['status'] = "success";
                  $response['message'] = "Data saved successfully";
                }
                echo json_encode($response);
                exit;
              }
            }

            public function add_courier_user() {
              if (!$this->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
              }
              if ($this->input->method() == 'post') {
                $this->form_validation->set_rules('dataId', 'User Id', 'required|numeric');
                if ($this->form_validation->run() == FALSE) {
                  $response['status'] = "fail";
                  $response['message'] = validation_errors();
                } else {
                  $user_id = $this->input->post("dataId");
                  $status = $this->input->post("dataStatus");
                  $hospitalId = $this->ion_auth->get_user_group_type()->row()->id;
                  if($status=="delete"){
                    $this->db->where('user_id', $user_id);
                    $this->db->where('hospital_lab_id', $hospitalId);
                    $this->db->delete('courier_users');
                    $response['status'] = "success";
                    $response['message'] = "User Deleted successfully";
                  }else{
                    $res = $this->db->get_where('courier_users', array('user_id' => $user_id))->num_rows();
                    if ($res == 0) {
                      $this->db->insert('courier_users', array(
                        'user_id' => $user_id,
                        'hospital_lab_id' => $hospitalId
                      ));
                      if($this->input->post("status")=="courier"){
                        $receiver_detail = $this->Institute_model->getUserDecryptedDetailsByid($user_id);
                        $sender_email = $this->session->userdata['identity'];
                            //Send Email
                        $message = "You have been added in courier list";
                        $config = array(
                          'mailtype' => 'html',
                                'charset' => 'utf-8',  //iso-8859-1
                                'newline' => '\r\n',
                                'wordwrap' => TRUE
                              );
                        $this->load->library('email', $config);
                            // $this->email->set_header('Content-type', 'text/html\r\n');
                        $this->email->set_mailtype("html");
                        $this->email->set_newline("\r\n");
                            $this->email->from($sender_email); // change it to yours
                            $this->email->reply_to($sender_email, 'PathHub Support Team');
                            $this->email->to($receiver_detail->email); // change it to yours
                            $this->email->subject('PathHub: Added in Courier List');
                            // $mesg = $this->load->view('auth/pinemailtemplate',$dataTemp,true);
                            $this->email->message($message);

                            //$this->email->message($mesg);
                            $this->email->send();
                          }
                        } else {
                          $this->db->where('user_id', $user_id);
//                        $this->db->where('hospital_lab_id', $hospitalId);
                          $this->db->update('courier_users', array("user_id" => $user_id));
                        }
                        $response['status'] = "success";
                        $response['message'] = "Data saved successfully";
                      }

                    }
                    echo json_encode($response);
                    exit;
                  }
                }

    // Settings page for Laboratory
//    public function AddLaboratory() {
//
//        if (!$this->Institute_model->is_user_hospital_admin() && !$this->ion_auth->is_admin()) {
//            return redirect('/', 'refresh');
//        }
//        if ($this->input->method() === 'get') {
//            $data = array();
//            $h_f_data = array();
//            $h_f_data['javascripts'] = array(
//                '/js/typeahead.jquery.js',
//                '/newtheme/js/custom_js/admin_settings.js',
//                '/js/institute/settings.js',
//                'password/js/jquery.passwordRequirements.min.js',
//                'password/js/custom.js'
//            );
//            $h_f_data['styles'] = array('password/css/jquery.passwordRequirements.css');
//
//            $data['countries'] = $this->Institute_model->get_countries();
//            $data['errors'] = FALSE;
//            if (!empty($_SESSION['form_data'])) {
//                $data['errors'] = TRUE;
//                $data['hospital_data'] = $_SESSION['form_data'];
//            } else {
//                $hospital_data = $this->Institute_model->get_hospital_information();
//                $data['hospital_data'] = $hospital_data;
//            }
//            $data['has_user_error'] = FALSE;
//            if (!empty($_SESSION['user_error'])) {
//                $data['user_data'] = $_SESSION['user_data']['form_data'];
//                $data['user_error'] = $_SESSION['user_data']['form_error'];
//                $data['has_user_error'] = TRUE;
//            } else {
//                $data['user_data'] = array(
//                    'first_name' => '',
//                    'last_name' => '',
//                    'company' => '',
//                    'phone' => '',
//                    'memorable' => '',
//                    'email' => '',
//                    'password' => '',
//                    'password_confirm' => '',
//                    'group_id' => '',
//                    'active_directory_user' => ''
//                );
//                $data['user_error'] = array();
//            }
//
//            $data['hospital_users'] = $this->Institute_model->get_hospital_users();
//            $data['networks'] = $this->db->get_where('groups', array('group_type' => 'N'))->result_array();
////            echo "<pre>";print_r($data['country']);exit;
//            $this->load->view('templates/header-new', $h_f_data);
//            $this->load->view('institute/lab_settings.php', $data);
//            $this->load->view('templates/footer-new', $h_f_data);
//        } else if ($this->input->method() === 'post') {
//
//            // Check for input validations
//            $this->form_validation->set_rules('laboratory_name', 'Laboratory Name', 'trim|required|is_unique[groups.description]');
//            $this->form_validation->set_rules('laboratory_initials_1', 'Laboratory First Initial', 'trim|required|exact_length[1]');
//            $this->form_validation->set_rules('laboratory_initials_2', 'Laboratory Second Initial', 'trim|required|exact_length[1]');
//            $this->form_validation->set_rules('laboratory_email', 'Laboratory Email', 'trim|valid_email');
//            $this->form_validation->set_rules('laboratory_website', 'Laboratory Website', 'trim|valid_url');
//
//            if (!empty($_POST['ac_checkbox'])) {
//                $this->form_validation->set_rules('ac_first_name', 'Account Holder First Name', 'trim|required');
//                $this->form_validation->set_rules('ac_last_name', 'Account Holder Last Name', 'trim|required');
//                //$this->form_validation->set_rules('ac_email', 'Account Holder Email', 'trim|required|valid_email|callback__unique_email');
//                $this->form_validation->set_rules('ac_password', 'Account Holder Password', 'trim|required');
//                $this->form_validation->set_rules('ac_password_confirm', 'Account Holder Password Confirm', 'trim|required|matches[ac_password]');
//                $this->form_validation->set_rules('ac_memorable', 'Account Holder Memorable', 'trim|required');
//            }
//
//            if (!empty($_POST['dac_checkbox'])) {
//                $this->form_validation->set_rules('dac_first_name', 'Deputy Account Holder First Name', 'trim|required');
//                $this->form_validation->set_rules('dac_last_name', 'Deputy Account Holder Last Name', 'trim|required');
//                // $this->form_validation->set_rules('dac_email', 'Deputy Account Holder Email', 'trim|required|valid_email|callback__unique_email');
//                $this->form_validation->set_rules('dac_password', 'Deputy Account Holder Password', 'trim|required');
//                $this->form_validation->set_rules('dac_password_confirm', 'Deputy Account Holder Password Confirm', 'trim|required|matches[dac_password]');
//                $this->form_validation->set_rules('dac_memorable', 'Deputy Account Holder Memorable', 'trim|required');
//            }
//
//            if ($this->form_validation->run() === TRUE) {
//                // Institute data validated
//                $new_group_id = $this->ion_auth->create_group_main(
//                        strtolower(str_replace(' ', '', $this->input->post('laboratory_name'))), $this->input->post('laboratory_initials_1'), $this->input->post('laboratory_initials_2'), $this->input->post('laboratory_name'), 'L', $this->input->post('laboratory_name'), '', 'usergroup'
//                );
//                if ($new_group_id) {
//                    // check to see if we are creating the group
//                    // redirect them back to the admin page
//                    $info_data = array(
//                        'group_id' => $new_group_id,
//                        'lab_address' => $this->input->post('laboratory_address'),
//                        'lab_country' => $this->input->post('laboratory_country'),
//                        'lab_city' => $this->input->post('laboratory_city'),
//                        'lab_state' => $this->input->post('laboratory_state'),
//                        'lab_post_code' => $this->input->post('laboratory_post_code'),
//                        'lab_email' => $this->input->post('laboratory_email'),
//                        'lab_phone' => $this->input->post('laboratory_number'),
//                        'lab_mobile' => $this->input->post('laboratory_mobile_num'),
//                        'lab_fax' => $this->input->post('laboratory_fax'),
//                        'lab_website' => $this->input->post('laboratory_website'),
//                        'lab_connection' => $this->input->post('lab_connection'),
//                    );
//                    $this->Admin_model->insertLaboratoryInformation($info_data);
//
//                    //$hospital_row = $this->ion_auth->get_users_groups()->row();
//                    //$hospital_id = $hospital_row->id;
//                    //$group_id = $new_group_id;
//                    $this->db->insert('hospital_group', array('hospital_id' => $hospital_id, 'group_id' => $group_id));
//
//                    // Create hospital admin user
//                    $username = strtolower($this->input->post('admin_first_name')) . ' ' . strtolower($this->input->post('admin_last_name'));
//                    $email = $this->input->post('admin_email');
//                    $identity = $email;
//                    $password = $this->input->post('admin_password');
//                    $is_hospital_admin = 1;
//                    $group_id = $new_group_id;
//                    $profile_picture = DEFAULT_PROFILE_PIC;
//                    // Upload profile picture if exists 
//                    if ($_FILES['admin_profile_pic']["name"]) { //when user submit basic profile info with profile image
//                        $config['upload_path'] = './uploads/';
//                        $config['allowed_types'] = 'gif|jpg|png';
//                        $config['max_size'] = '10000';
//                        $config['file_name'] = time() . '-' . $_FILES['admin_profile_pic']["name"];
//
//                        $this->load->library('upload', $config);
//
//                        if (!$this->upload->do_upload('admin_profile_pic')) {
//                            $error = 0;
//                        } else {
//                            $filedata = array('upload_data' => $this->upload->data());
//                            $profile_image = $filedata['upload_data']['file_name'];
//                            $image_path = 'uploads/' . $config['file_name'];
//                            $profile_picture = $image_path;
//                        }
//                    }
//                    $user_type = 'L';
//                    $additional_data = [
//                        'username' => $this->db->escape($username),
//                        'first_name' => $this->db->escape($this->input->post('admin_first_name')),
//                        'last_name' => $this->db->escape($this->input->post('admin_last_name')),
//                        'company' => $this->db->escape($this->input->post('admin_company')),
//                        'phone' => $this->db->escape($this->input->post('admin_phone')),
//                        'memorable' => $this->db->escape($this->input->post('admin_memorable')),
//                        'is_hospital_admin' => $is_hospital_admin,
//                        'profile_picture_path' => $this->db->escape($profile_picture),
//                        'user_type' => $this->db->escape($user_type),
//                        'group_id' => ""
//                    ];
//                    $groups_array = array();
//                    if ($group_id !== -1) {
//                        $groups_array = array($group_id);
//                    }
//                    $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
//
//
//
//                    if (!empty($_POST['ac_checkbox'])) {
//                        // Create hospital admin user
//                        $username = strtolower($this->input->post('ac_first_name')) . ' ' . strtolower($this->input->post('ac_last_name'));
//                        $email = $this->input->post('ac_email');
//                        $identity = $email;
//                        $password = $this->input->post('ac_password');
//                        $is_hospital_admin = 0;
//                        $group_id = $new_group_id;
//                        $profile_picture = DEFAULT_PROFILE_PIC;
//                        // Upload profile picture if exists 
//                        if ($_FILES['ac_profile_pic']["name"]) { //when user submit basic profile info with profile image
//                            $config['upload_path'] = './uploads/';
//                            $config['allowed_types'] = 'gif|jpg|png';
//                            $config['max_size'] = '10000';
//                            $config['file_name'] = time() . '-' . $_FILES['ac_profile_pic']["name"];
//
//                            $this->load->library('upload', $config);
//
//                            if (!$this->upload->do_upload('ac_profile_pic')) {
//                                $error = 0;
//                            } else {
//                                $filedata = array('upload_data' => $this->upload->data());
//                                $profile_image = $filedata['upload_data']['file_name'];
//                                $image_path = 'uploads/' . $config['file_name'];
//                                $profile_picture = $image_path;
//                            }
//                        }
//                        $user_type = 'L';
//                        $additional_data = [
//                            'username' => $this->db->escape($username),
//                            'first_name' => $this->db->escape($this->input->post('ac_first_name')),
//                            'last_name' => $this->db->escape($this->input->post('ac_last_name')),
//                            'company' => $this->db->escape($this->input->post('ac_company')),
//                            'phone' => $this->db->escape($this->input->post('ac_phone')),
//                            'memorable' => $this->db->escape($this->input->post('ac_memorable')),
//                            'is_hospital_admin' => $is_hospital_admin,
//                            'profile_picture_path' => $this->db->escape($profile_picture),
//                            'user_type' => $this->db->escape($user_type),
//                            'group_id' => ""
//                        ];
//                        $groups_array = array();
//                        if ($group_id !== -1) {
//                            $groups_array = array($group_id);
//                        }
//                        $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
//                        if ($user_id === FALSE) {
//                            custom_log("Error while creating account holder");
//                        } else {
//                            $this->db
//                                    ->set('account_holder', $user_id)
//                                    ->where('group_id', $group_id)
//                                    ->update('laboratory_information');
//                        }
//                    }
//
//                    if (!empty($_POST['dac_checkbox'])) {
//                        // Create hospital admin user
//                        $username = strtolower($this->input->post('dac_first_name')) . ' ' . strtolower($this->input->post('dac_last_name'));
//                        $email = $this->input->post('dac_email');
//                        $identity = $email;
//                        $password = $this->input->post('dac_password');
//                        $is_hospital_admin = FALSE;
//                        $group_id = $new_group_id;
//                        $profile_picture = DEFAULT_PROFILE_PIC;
//                        // Upload profile picture if exists 
//                        if ($_FILES['dac_profile_pic']["name"]) { //when user submit basic profile info with profile image
//                            $config['upload_path'] = './uploads/';
//                            $config['allowed_types'] = 'gif|jpg|png';
//                            $config['max_size'] = '10000';
//                            $config['file_name'] = time() . '-' . $_FILES['dac_profile_pic']["name"];
//
//                            $this->load->library('upload', $config);
//
//                            if (!$this->upload->do_upload('dac_profile_pic')) {
//                                $error = 0;
//                            } else {
//                                $filedata = array('upload_data' => $this->upload->data());
//                                $profile_image = $filedata['upload_data']['file_name'];
//                                $image_path = 'uploads/' . $config['file_name'];
//                                $profile_picture = $image_path;
//                            }
//                        }
//                        $user_type = 'L';
//                        $additional_data = [
//                            'username' => $this->db->escape($username),
//                            'first_name' => $this->db->escape($this->input->post('dac_first_name')),
//                            'last_name' => $this->db->escape($this->input->post('dac_last_name')),
//                            'company' => $this->db->escape($this->input->post('dac_company')),
//                            'phone' => $this->db->escape($this->input->post('dac_phone')),
//                            'memorable' => $this->db->escape($this->input->post('dac_memorable')),
//                            'is_hospital_admin' => 0,
//                            'profile_picture_path' => $this->db->escape($profile_picture),
//                            'user_type' => $this->db->escape($user_type),
//                            'group_id' => ""
//                        ];
//                        $groups_array = array();
//                        if ($group_id !== -1) {
//                            $groups_array = array($group_id);
//                        }
//                        $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
//                        if ($user_id === FALSE) {
//                            custom_log("Error while creating deputy account holder");
//                        } else {
//                            $this->db
//                                    ->set('deputy_account_holder', $user_id)
//                                    ->where('group_id', $group_id)
//                                    ->update('laboratory_information');
//                        }
//                    }
//
//
//                    $this->session->set_flashdata('message', $this->ion_auth->messages());
//                    redirect('/', 'refresh');
//                    return;
//                } else {
//                    /* $this->output
//                      ->set_status_header(500)
//                      ->set_content_type('application/json')
//                      ->set_output(json_encode(array('status' => 'error', 'message' => 'Error Creating, user try again later'))); */
//                    return redirect('institute/AddLaboratory', 'refresh');
//                }
//            } else {
//                /* $this->output
//                  ->set_status_header(400)
//                  ->set_content_type('application/json')
//                  ->set_output(json_encode(array('status' => 'error', 'message' => 'Invalid Input', 'errors' => validation_errors()))); */
//                return redirect('institute/AddLaboratory', 'refresh');
//            }
//        }
//    }

                public function AddLaboratory() 
                {

                  if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
                    return redirect('auth/login', 'refresh');
                  }
                  if ($this->input->method() === 'get') {
                    $data = array();
                    $h_f_data = array();
                    $h_f_data['javascripts'] = array(
                      '/js/typeahead.jquery.js',
                      '/newtheme/js/custom_js/admin_settings.js',
                      '/js/institute/settings.js',
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
                    $data['has_user_error'] = FALSE;
                    if (!empty($_SESSION['user_error'])) {
                      $data['user_data'] = $_SESSION['user_data']['form_data'];
                      $data['user_error'] = $_SESSION['user_data']['form_error'];
                      $data['has_user_error'] = TRUE;
                    } else {
                      $data['user_data'] = array(
                        'first_name' => '',
                        'last_name' => '',
                        'company' => '',
                        'phone' => '',
                        'memorable' => '',
                        'email' => '',
                        'password' => '',
                        'password_confirm' => '',
                        'group_id' => '',
                        'active_directory_user' => ''
                      );
                      $data['user_error'] = array();
                    }

                    $data['hospital_users'] = $this->Institute_model->get_hospital_users();
                    $data['networks'] = $this->db->get_where('groups', array('group_type' => 'N'))->result_array();
//            echo "<pre>";print_r($data['country']);exit;
                    $this->load->view('templates/header-new', $h_f_data);
                    $this->load->view('institute/lab_settings.php', $data);
                    $this->load->view('templates/footer-new', $h_f_data);
                  } else if ($this->input->method() === 'post') {

            // Check for input validations
                    $this->form_validation->set_rules('laboratory_name', 'Laboratory Name', 'trim|required|is_unique[groups.description]');
                    $this->form_validation->set_rules('laboratory_initials_1', 'Laboratory First Initial', 'trim|required|exact_length[1]');
                    $this->form_validation->set_rules('laboratory_initials_2', 'Laboratory Second Initial', 'trim|required|exact_length[1]');
                    $this->form_validation->set_rules('laboratory_email', 'Laboratory Email', 'trim|valid_email');
                    $this->form_validation->set_rules('laboratory_website', 'Laboratory Website', 'trim|valid_url');

                    if (!empty($_POST['ac_checkbox'])) {
                      $this->form_validation->set_rules('ac_first_name', 'Account Holder First Name', 'trim|required');
                      $this->form_validation->set_rules('ac_last_name', 'Account Holder Last Name', 'trim|required');
                //$this->form_validation->set_rules('ac_email', 'Account Holder Email', 'trim|required|valid_email|callback__unique_email');
                      $this->form_validation->set_rules('ac_password', 'Account Holder Password', 'trim|required');
                      $this->form_validation->set_rules('ac_password_confirm', 'Account Holder Password Confirm', 'trim|required|matches[ac_password]');
                      $this->form_validation->set_rules('ac_memorable', 'Account Holder Memorable', 'trim|required');
                    }

                    if (!empty($_POST['dac_checkbox'])) {
                      $this->form_validation->set_rules('dac_first_name', 'Deputy Account Holder First Name', 'trim|required');
                      $this->form_validation->set_rules('dac_last_name', 'Deputy Account Holder Last Name', 'trim|required');
                // $this->form_validation->set_rules('dac_email', 'Deputy Account Holder Email', 'trim|required|valid_email|callback__unique_email');
                      $this->form_validation->set_rules('dac_password', 'Deputy Account Holder Password', 'trim|required');
                      $this->form_validation->set_rules('dac_password_confirm', 'Deputy Account Holder Password Confirm', 'trim|required|matches[dac_password]');
                      $this->form_validation->set_rules('dac_memorable', 'Deputy Account Holder Memorable', 'trim|required');
                    }

                    if ($this->form_validation->run() === TRUE) 
                    {
                // Institute data validated
                      $new_group_id = $this->ion_auth->create_group_main(
                        strtolower(str_replace(' ', '', $this->input->post('laboratory_name'))), $this->input->post('laboratory_initials_1'), $this->input->post('laboratory_initials_2'), $this->input->post('laboratory_name'), 'L', $this->input->post('laboratory_name'), '', 'usergroup');
                      if ($new_group_id) {
                    // check to see if we are creating the group
                    // redirect them back to the admin page
                        $info_data = array(
                          'group_id' => $new_group_id,
                          'lab_address' => $this->input->post('laboratory_address'),
                          'lab_country' => $this->input->post('laboratory_country'),
                          'lab_city' => $this->input->post('laboratory_city'),
                          'lab_state' => $this->input->post('laboratory_state'),
                          'lab_post_code' => $this->input->post('laboratory_post_code'),
                          'lab_email' => $this->input->post('laboratory_email'),
                          'lab_phone' => $this->input->post('laboratory_number'),
                          'lab_mobile' => $this->input->post('laboratory_mobile_num'),
                          'lab_fax' => $this->input->post('laboratory_fax'),
                          'lab_website' => $this->input->post('laboratory_website'),
						  'site_identifier' => $this->input->post('site_identifier'),
						  'identifier' => $this->input->post('identifier'),
                          'lab_connection' => 0,
                        );
                        $lab_id=$this->Admin_model->insertLaboratoryInformation($info_data);                    

	//				print $groups[0]->group_type;
                        $hospital_row = $this->ion_auth->get_users_groups()->row();            
                        $groupType= $hospital_row->group_type;
                        $hospital_id = $hospital_row->id;

                        $hospitalUserGroupArray = array("H","HA");
                        if  (in_array($groupType, $hospitalUserGroupArray)) 
                        {
                          $hospital_row = $this->ion_auth->get_users_groups()->row();
                          $hospital_id = $hospital_row->id;
                          $group_id = $new_group_id;					   
                          $this->db->insert('hospital_group', array('hospital_id' => $hospital_id, 'group_id' => $group_id));


                          $this->db->insert('users_groups', array('institute_id' => $hospital_id, 'group_id' => 65,'user_id'=>$group_id));

                        }

                    // Create hospital admin user
                        $username = strtolower($this->input->post('admin_first_name')) . ' ' . strtolower($this->input->post('admin_last_name'));
                        $email = $this->input->post('admin_email');
                        $identity = $email;
                        $password = $this->input->post('admin_password');
                        $is_hospital_admin = 0;
                        $group_id = $new_group_id;
                        $mainGroupQry = "SELECT * FROM groups where group_type = 'L' and type_cate='category'";
                        $mainGroupResult = $this->db->query($mainGroupQry)->result_array();
                        $mainGroupId = $mainGroupResult[0]["id"];

                        $profile_picture = DEFAULT_PROFILE_PIC;
                    // Upload profile picture if exists 
                        if ($_FILES['admin_profile_pic']["name"]) 
					{ //when user submit basic profile info with profile image
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
          $user_type = 'LA';
          $additional_data = [
            'username' => $this->db->escape($username),
            'first_name' => $this->db->escape($this->input->post('admin_first_name')),
            'last_name' => $this->db->escape($this->input->post('admin_last_name')),
            'company' => $this->db->escape($this->input->post('admin_company')),
            'phone' => $this->db->escape($this->input->post('admin_phone')),
            'memorable' => $this->db->escape($this->input->post('admin_memorable')),
            'is_hospital_admin' => $is_hospital_admin,
            'profile_picture_path' => $this->db->escape($profile_picture),
            'user_type' => $this->db->escape($user_type),
            'group_id' => "$new_group_id"
          ];
          $groups_array = array();
          if ($group_id !== -1) {
            $groups_array = array($mainGroupId);
          }
          $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
                 //   echo $user_id; exit; 
          $addGroup = array("user_id" => $user_id,"institute_id" => $group_id);
          $this->db->insert('users_groups', $addGroup);

          $this->session->set_flashdata('message', $this->ion_auth->messages());
          redirect('/', 'refresh');
          return;
        } else {

          return redirect('institute/AddLaboratory', 'refresh');
        }
      } else {

        return redirect('institute/AddLaboratory', 'refresh');
      }
    }
  }


  

  public function viewLabsDetails() {
    if (!$this->ion_auth->logged_in()) {
      $this->output->set_status_header(401);
      echo "Not authorized";
      return;
    }
    $lab_id = $this->input->get('lab_id');

    $get_file_path_query = $this->db->query("SELECT * FROM groups as gr join laboratory_information as la on gr.id=la.group_id WHERE gr.id = $lab_id");
    $get_file_path = $get_file_path_query->result();

    if ($get_file_path[0]->lab_connection == 1) {
      $conne_status = "Yes";
    } else {
      $conne_status = "No";
    }
    $data = "<div class='row'><div class='col-md-4'><b>Name:</b></div><div class='col-md-8'>" . $get_file_path[0]->description . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Email:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_email . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Phone Number:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_phone . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Mobile Number:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_mobile . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Fax:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_fax . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Address:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_address . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>City:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_city . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>State/Province:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_state . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Postal Code:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_post_code . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Website Url:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_website . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>No Hospital or Lab Connections:</b></div><div class='col-md-8'>" . $conne_status . "</div></div>";
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function allLoginUsers() {
    $data['usersLogins'] = $this->Institute_model->getUsersLogins(TRUE);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $explodeDate = explode(" - ", $this->input->post("start_end_date"));
      $data['usersLogins'] = $this->Institute_model->getUsersLogins(TRUE, $explodeDate);
      $data['date_filtered'] = $this->input->post("start_end_date");
    }
    $data['route'] = "institute/";


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
    $data['usersLogins'] = $this->Institute_model->getLoginDetail($explodeId);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $explodeDate = explode(" - ", $this->input->post("start_end_date"));
      $data['usersLogins'] = $this->Institute_model->getLoginDetail($explodeId, $explodeDate);
      $data['date_filtered'] = $this->input->post("start_end_date");
    }
    $data['route'] = "institute/";

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

  public function getAllLoginDetail() {
    $data['usersLogins'] = $this->Institute_model->getAllLoginDetail();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $explodeDate = explode(" - ", $this->input->post("start_end_date"));
      $data['usersLogins'] = $this->Institute_model->getAllLoginDetail($explodeDate);
      $data['date_filtered'] = $this->input->post("start_end_date");
    }
    $data['route'] = "institute/";

    $data['styles'] = array(
      'css/daterangepicker.css'
    );
    $data['javascripts'] = array(
      'js/daterangepicker.js',
      'js/custom_js/activities.js');
    $this->load->view('templates/header-new', $data);
    $this->load->view('institute/login_all_user_detail', $data);
    $this->load->view('templates/footer-new', $data);
  }

  public function showUserActivity($id = FALSE) {
    $explodeId = base64_decode($id);
    $data['usersLogins'] = getUserTrackActivity($explodeId);
    $data['route'] = "institute/";
    $this->load->view('templates/header-new', $data);
    $this->load->view('institute/login_user_activities', $data);
    $this->load->view('templates/footer-new', $data);
  }

  public function ShowLabsDetails() {
    if (!$this->ion_auth->logged_in()) {
      $this->output->set_status_header(401);
      echo "Not authorized";
      return;
    }
    $lab_id = $this->input->get('lab_id');

    $get_file_path_query = $this->db->query("SELECT * FROM groups as gr join laboratory_information as la on gr.id=la.group_id WHERE gr.group_type = 'L'");
    $get_file_path = $get_file_path_query->result();

    if ($get_file_path[0]->lab_connection == 1) {
      $conne_status = "Yes";
    } else {
      $conne_status = "No";
    }
    $data = "<div class='row'><div class='col-md-4'><b>Name:</b></div><div class='col-md-8'>" . $get_file_path[0]->description . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Email:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_email . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Phone Number:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_phone . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Mobile Number:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_mobile . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Fax:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_fax . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Address:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_address . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>City:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_city . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>State/Province:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_state . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Postal Code:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_post_code . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>Website Url:</b></div><div class='col-md-8'>" . $get_file_path[0]->lab_website . "</div></div>";
    $data.="<div class='row'><div class='col-md-4'><b>No Hospital or Lab Connections:</b></div><div class='col-md-8'>" . $conne_status . "</div></div>";
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  function get_active_directory_labs() {
    if (!$this->ion_auth->logged_in()) {
      $this->output->set_status_header(401);
      echo "Not authorized";
      return;
    }
    $type = $this->input->get('type');
    if (empty($type)) {
      $this->output->set_status_header(400);
      echo "Group type not provided";
      return;
    }
    $hospital_row = $this->ion_auth->get_users_groups()->row();
    $hospital_id = $hospital_row->id;
    $get_file_path_query = $this->db->query("SELECT * FROM `groups` where group_type = 'L' and id NOT IN(select group_id from hospital_group where hospital_id=$hospital_id)");

    $res = $get_file_path_query->result();
    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($res));
  }

  function get_active_department() {
    if (!$this->ion_auth->logged_in()) {
      $this->output->set_status_header(401);
      echo "Not authorized";
      return;
    }
    $division_id = $this->input->get('type');
    if (empty($division_id)) {
      $this->output->set_status_header(400);
      echo "Group type not provided";
      return;
    }
    /*$hospital_row = $this->ion_auth->get_users_groups()->row();
    $hospital_id = $hospital_row->id;
    $get_file_path_query = $this->db->query("SELECT * FROM `department_settings` where  division_id = $division_id and hospital_id= $hospital_id");

    $res = $get_file_path_query->result();*/
    $res = $this->Huser_model->get_division_list();
    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($res));
  }

  function update_labGroup_details() {
    $id = $this->input->get('id');
    if ($id != '') {
      $hospital_row = $this->ion_auth->get_users_groups()->row();
      $hospital_id = $hospital_row->id;
      $sop_upload_data = array(
        'hospital_id' => $hospital_id,
        'group_id' => $id
      );
      $this->db->insert('hospital_group', $sop_upload_data);
    }
  }

  public function CreateCustomer() {
    if (!$this->Institute_model->is_user_hospital_admin() && !$this->ion_auth->is_admin()) {
      return redirect('/', 'refresh');
    }
    if ($this->input->method() === 'get') {
      $data = array();
      $h_f_data = array();
      $h_f_data['javascripts'] = array(
        '/js/typeahead.jquery.js',
        '/newtheme/js/custom_js/admin_settings.js',
        '/js/institute/settings.js',
        'password/js/jquery.passwordRequirements.min.js',
        'password/js/custom.js'
      );
      $h_f_data['styles'] = array('password/css/jquery.passwordRequirements.css');

      $data['countries'] = $this->Institute_model->get_countries();
      $data['errors'] = FALSE;
    }

    $this->load->view('templates/header-new', $h_f_data);
    $this->load->view('institute/create_customer.php', '');
    $this->load->view('templates/footer-new', $h_f_data);
  }

    // Settings page for Customer
  public function customer() {

//        $explodeId = base64_decode($id);
//        $data['usersLogins'] = getUserTrackActivity($explodeId);
//        $data['route'] = "institute/";
//        $this->load->view('templates/header-new',$data);
//        $this->load->view('institute/login_user_activities', $data);
//        $this->load->view('templates/footer-new',$data);


    if (!$this->Institute_model->is_user_hospital_admin() && !$this->ion_auth->is_admin()) {
      return redirect('/', 'refresh');
    }

    $data = array();
    $h_f_data = array();
    $h_f_data['javascripts'] = array(
      '/js/typeahead.jquery.js',
      '/newtheme/js/custom_js/admin_settings.js',
      '/js/institute/settings.js',
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
    $data['has_user_error'] = FALSE;
    if (!empty($_SESSION['user_error'])) {
      $data['user_data'] = $_SESSION['user_data']['form_data'];
      $data['user_error'] = $_SESSION['user_data']['form_error'];
      $data['has_user_error'] = TRUE;
    } else {
      $data['user_data'] = array(
        'first_name' => '',
        'last_name' => '',
        'company' => '',
        'phone' => '',
        'memorable' => '',
        'email' => '',
        'password' => '',
        'password_confirm' => '',
        'group_id' => '',
        'active_directory_user' => ''
      );
      $data['user_error'] = array();
    }

    $data['hospital_users'] = $this->Institute_model->get_hospital_users();
    $data['networks'] = $this->db->get_where('groups', array('group_type' => 'N'))->result_array();
//            echo "<pre>";print_r($data['country']);exit;


    $this->load->view('templates/header-new', $h_f_data);
    $this->load->view('customer/customer_view', $data);
    $this->load->view('templates/footer-new', $h_f_data);
  }

  public function AddCustomer() {

    if (!$this->Institute_model->is_user_hospital_admin() && !$this->ion_auth->is_admin()) {
      return redirect('/', 'refresh');
    }
    if ($this->input->method() === 'get') {
      $data = array();
      $h_f_data = array();
      $h_f_data['javascripts'] = array(
        '/js/typeahead.jquery.js',
        '/newtheme/js/custom_js/admin_settings.js',
        '/js/institute/settings.js',
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
      $data['has_user_error'] = FALSE;
      if (!empty($_SESSION['user_error'])) {
        $data['user_data'] = $_SESSION['user_data']['form_data'];
        $data['user_error'] = $_SESSION['user_data']['form_error'];
        $data['has_user_error'] = TRUE;
      } else {
        $data['user_data'] = array(
          'first_name' => '',
          'last_name' => '',
          'company' => '',
          'phone' => '',
          'memorable' => '',
          'email' => '',
          'password' => '',
          'password_confirm' => '',
          'group_id' => '',
          'active_directory_user' => ''
        );
        $data['user_error'] = array();
      }

      $data['hospital_users'] = $this->Institute_model->get_hospital_users();
      $data['networks'] = $this->db->get_where('groups', array('group_type' => 'N'))->result_array();
//            echo "<pre>";print_r($data['country']);exit;
      $this->load->view('templates/header-new', $h_f_data);
      $this->load->view('institute/lab_settings.php', $data);
      $this->load->view('templates/footer-new', $h_f_data);
    } else if ($this->input->method() === 'post') {

            // Check for input validations
      $this->form_validation->set_rules('laboratory_name', 'Institute Name', 'trim|required|is_unique[groups.description]');
      $this->form_validation->set_rules('laboratory_initials_1', 'Laboratory First Initial', 'trim|required|exact_length[1]');
      $this->form_validation->set_rules('laboratory_initials_2', 'Laboratory Second Initial', 'trim|required|exact_length[1]');
      $this->form_validation->set_rules('laboratory_email', 'Laboratory Email', 'trim|valid_email');
      $this->form_validation->set_rules('laboratory_website', 'Laboratory Website', 'trim|valid_url');

      if (!empty($_POST['ac_checkbox'])) {
        $this->form_validation->set_rules('ac_first_name', 'Account Holder First Name', 'trim|required');
        $this->form_validation->set_rules('ac_last_name', 'Account Holder Last Name', 'trim|required');
                //$this->form_validation->set_rules('ac_email', 'Account Holder Email', 'trim|required|valid_email|callback__unique_email');
        $this->form_validation->set_rules('ac_password', 'Account Holder Password', 'trim|required');
        $this->form_validation->set_rules('ac_password_confirm', 'Account Holder Password Confirm', 'trim|required|matches[ac_password]');
        $this->form_validation->set_rules('ac_memorable', 'Account Holder Memorable', 'trim|required');
      }



      if ($this->form_validation->run() === TRUE) {
                // Institute data validated
        $new_group_id = $this->ion_auth->create_group_main(
          strtolower(str_replace(' ', '', $this->input->post('laboratory_name'))), $this->input->post('laboratory_initials_1'), $this->input->post('laboratory_initials_2'), $this->input->post('laboratory_name'), 'L', $this->input->post('laboratory_name'), '', 'usergroup'
        );
        if ($new_group_id) {
                    // check to see if we are creating the group
                    // redirect them back to the admin page
          $info_data = array(
            'group_id' => $new_group_id,
            'lab_address' => $this->input->post('laboratory_address'),
            'lab_country' => $this->input->post('laboratory_country'),
            'lab_city' => $this->input->post('laboratory_city'),
            'lab_state' => $this->input->post('laboratory_state'),
            'lab_post_code' => $this->input->post('laboratory_post_code'),
            'lab_email' => $this->input->post('laboratory_email'),
            'lab_phone' => $this->input->post('laboratory_number'),
            'lab_mobile' => $this->input->post('laboratory_mobile_num'),
            'lab_fax' => $this->input->post('laboratory_fax'),
            'lab_website' => $this->input->post('laboratory_website'),
            'lab_connection' => $this->input->post('lab_connection'),
          );
          $this->Admin_model->insertLaboratoryInformation($info_data);

                    //$hospital_row = $this->ion_auth->get_users_groups()->row();
                    //$hospital_id = $hospital_row->id;
                    //$group_id = $new_group_id;
          $this->db->insert('hospital_group', array('hospital_id' => $hospital_id, 'group_id' => $group_id));

                    // Create hospital admin user
          $username = strtolower($this->input->post('admin_first_name')) . ' ' . strtolower($this->input->post('admin_last_name'));
          $email = $this->input->post('admin_email');
          $identity = $email;
          $password = $this->input->post('admin_password');
          $is_hospital_admin = 1;
          $group_id = $new_group_id;
          $profile_picture = DEFAULT_PROFILE_PIC;
                    // Upload profile picture if exists 
                    if ($_FILES['admin_profile_pic']["name"]) { //when user submit basic profile info with profile image
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
                    $user_type = 'H';
                    $additional_data = [
                      'username' => $this->db->escape($username),
                      'first_name' => $this->db->escape($this->input->post('admin_first_name')),
                      'last_name' => $this->db->escape($this->input->post('admin_last_name')),
                      'company' => $this->db->escape($this->input->post('admin_company')),
                      'phone' => $this->db->escape($this->input->post('admin_phone')),
                      'memorable' => $this->db->escape($this->input->post('admin_memorable')),
                      'is_hospital_admin' => $is_hospital_admin,
                      'profile_picture_path' => $this->db->escape($profile_picture),
                      'user_type' => $this->db->escape($user_type),
                      'group_id' => ""
                    ];
                    $groups_array = array();
                    if ($group_id !== -1) {
                      $groups_array = array($group_id);
                    }
                    $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);



                    if (!empty($_POST['ac_checkbox'])) {
                        // Create hospital admin user
                      $username = strtolower($this->input->post('ac_first_name')) . ' ' . strtolower($this->input->post('ac_last_name'));
                      $email = $this->input->post('ac_email');
                      $identity = $email;
                      $password = $this->input->post('ac_password');
                      $is_hospital_admin = 0;
                      $group_id = $new_group_id;
                      $profile_picture = DEFAULT_PROFILE_PIC;
                        // Upload profile picture if exists 
                        if ($_FILES['ac_profile_pic']["name"]) { //when user submit basic profile info with profile image
                          $config['upload_path'] = './uploads/';
                          $config['allowed_types'] = 'gif|jpg|png';
                          $config['max_size'] = '10000';
                          $config['file_name'] = time() . '-' . $_FILES['ac_profile_pic']["name"];

                          $this->load->library('upload', $config);

                          if (!$this->upload->do_upload('ac_profile_pic')) {
                            $error = 0;
                          } else {
                            $filedata = array('upload_data' => $this->upload->data());
                            $profile_image = $filedata['upload_data']['file_name'];
                            $image_path = 'uploads/' . $config['file_name'];
                            $profile_picture = $image_path;
                          }
                        }
                        $user_type = 'LA';
                        $additional_data = [
                          'username' => $this->db->escape($username),
                          'first_name' => $this->db->escape($this->input->post('ac_first_name')),
                          'last_name' => $this->db->escape($this->input->post('ac_last_name')),
                          'company' => $this->db->escape($this->input->post('ac_company')),
                          'phone' => $this->db->escape($this->input->post('ac_phone')),
                          'memorable' => $this->db->escape($this->input->post('ac_memorable')),
                          'is_hospital_admin' => $is_hospital_admin,
                          'profile_picture_path' => $this->db->escape($profile_picture),
                          'user_type' => $this->db->escape($user_type),
                          'group_id' => ""
                        ];
                        $groups_array = array();
                        if ($group_id !== -1) {
                          $groups_array = array($group_id);
                        }
                        $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
                        if ($user_id === FALSE) {
                          custom_log("Error while creating account holder");
                        } else {
                          $this->db
                          ->set('account_holder', $user_id)
                          ->where('group_id', $group_id)
                          ->update('laboratory_information');
                        }
                      }

                      if (!empty($_POST['dac_checkbox'])) {
                        // Create hospital admin user
                        $username = strtolower($this->input->post('dac_first_name')) . ' ' . strtolower($this->input->post('dac_last_name'));
                        $email = $this->input->post('dac_email');
                        $identity = $email;
                        $password = $this->input->post('dac_password');
                        $is_hospital_admin = FALSE;
                        $group_id = $new_group_id;
                        $profile_picture = DEFAULT_PROFILE_PIC;
                        // Upload profile picture if exists 
                        if ($_FILES['dac_profile_pic']["name"]) { //when user submit basic profile info with profile image
                          $config['upload_path'] = './uploads/';
                          $config['allowed_types'] = 'gif|jpg|png';
                          $config['max_size'] = '10000';
                          $config['file_name'] = time() . '-' . $_FILES['dac_profile_pic']["name"];

                          $this->load->library('upload', $config);

                          if (!$this->upload->do_upload('dac_profile_pic')) {
                            $error = 0;
                          } else {
                            $filedata = array('upload_data' => $this->upload->data());
                            $profile_image = $filedata['upload_data']['file_name'];
                            $image_path = 'uploads/' . $config['file_name'];
                            $profile_picture = $image_path;
                          }
                        }
                        $user_type = 'L';
                        $additional_data = [
                          'username' => $this->db->escape($username),
                          'first_name' => $this->db->escape($this->input->post('dac_first_name')),
                          'last_name' => $this->db->escape($this->input->post('dac_last_name')),
                          'company' => $this->db->escape($this->input->post('dac_company')),
                          'phone' => $this->db->escape($this->input->post('dac_phone')),
                          'memorable' => $this->db->escape($this->input->post('dac_memorable')),
                          'is_hospital_admin' => 0,
                          'profile_picture_path' => $this->db->escape($profile_picture),
                          'user_type' => $this->db->escape($user_type),
                          'group_id' => ""
                        ];
                        $groups_array = array();
                        if ($group_id !== -1) {
                          $groups_array = array($group_id);
                        }
                        $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
                        if ($user_id === FALSE) {
                          custom_log("Error while creating deputy account holder");
                        } else {
                          $this->db
                          ->set('deputy_account_holder', $user_id)
                          ->where('group_id', $group_id)
                          ->update('laboratory_information');
                        }
                      }


                      $this->session->set_flashdata('message', $this->ion_auth->messages());
                      redirect('/', 'refresh');
                      return;
                    } else {
                      $this->output
                      ->set_status_header(500)
                      ->set_content_type('application/json')
                      ->set_output(json_encode(array('status' => 'error', 'message' => 'Error Creating, user try again later')));
                    }
                  } else {
                    $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'error', 'message' => 'Invalid Input', 'errors' => validation_errors())));
                  }
                }
              }

              function fetch_all_lab() {
                if (!$this->ion_auth->logged_in()) {
                  $this->output->set_status_header(401);
                  echo "Not authorized";
                  return;
                }
                $type = $this->input->get('type');
                if (empty($type)) {
                  $this->output->set_status_header(400);
                  echo "Group type not provided";
                  return;
                }
                $hospital_row = $this->ion_auth->get_users_groups()->row();
                $hospital_id = $hospital_row->id;
                $this->db->join('groups', 'groups.id = hospital_group.group_id');
                $this->db->where('hospital_id', $hospital_id);
                $this->db->where('group_type', $type);
                $res = $this->db->get('hospital_group')->result_array();
                for ($i = 0; $i < count($res); $i++) {
                  $this->db->select("
                    `users`.`id` as id, 
                    AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, 
                    AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                    AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
                    profile_picture_path as profile_picture
                    ", FALSE);
                  $this->db->join('users', 'users.id = users_groups.user_id');
                  $this->db->where('group_id', $res[$i]['id']);
                  $users = $this->db->get('users_groups')->result_array();
                  $res[$i]['users'] = $users;
                }
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
              }

              function fetch_all_labs() {
                if (!$this->ion_auth->logged_in()) {
                  $this->output->set_status_header(401);
                  echo "Not authorized";
                  return;
                }
                $type = $this->input->get('type');
                if (empty($type)) {
                  $this->output->set_status_header(400);
                  echo "Group type not provided";
                  return;
                }
                $hospital_row = $this->ion_auth->get_users_groups()->row();
                $hospital_id = $hospital_row->id;
                $hospital_row = $this->ion_auth->get_users_groups()->row();
                $hospital_id = $hospital_row->id;
                $get_file_path_query = $this->db->query("SELECT * FROM `groups` where group_type = 'L' and id IN(select group_id from hospital_group where hospital_id=$hospital_id)");

                $res = $get_file_path_query->result();
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
              }

              function create_customer() {
                if (!$this->ion_auth->logged_in()) {
                  redirect('/', 'refresh');
                  return;
                }
                $hospital_row = $this->ion_auth->get_users_groups()->row();
                $hospital_id = $hospital_row->id;
                if ($this->input->method() == 'post') {
                  $this->form_validation->set_rules('first_name', 'Frist Name', 'trim|required');
                  $this->form_validation->set_rules('email', 'Email', 'trim|required');
                  $this->form_validation->set_rules('group_id', 'User group', 'trim|required|is_natural');
                  $this->form_validation->set_rules('active_directory_user', 'Active Directory', 'trim|required|is_natural');
                  if ($this->form_validation->run() === FALSE) {
                    $form_errors = array(
                      'first_name' => form_error('first_name'),
                      'general' => array(
                        'group_id' => form_error('group_id'),
                        'active_directory_user' => form_error('active_directory_user')
                      )
                    );
                    $this->session->set_flashdata('user_error', TRUE);
                    $this->session->set_flashdata('user_data', array(
                      'form_data' => array(
                        'first_name' => set_value('first_name'),
                        'last_name' => set_value('last_name'),
                        'company' => set_value('company'),
                        'email' => set_value('email'),
                        'phone' => set_value('phone'),
                        'memorable' => set_value('memorable'),
                        'password' => set_value('password'),
                        'password_confirm' => set_value('password_confirm'),
                        'group_id' => $this->input->post('group_id'),
                        'active_directory_user' => $this->input->post('active_directory_user')
                      ),
                      'form_error' => $form_errors,
                    ));
                    custom_log("Form validation failed");
                    custom_log(validation_errors());
                    redirect('/institute/settings', 'TRUE');
                  } else {
                    $ac = (int) $this->input->post('active_directory_user');
                // If new user then register this user
                // Check if group id if a lab or cancer service 
                // If group type_category is usergroup, check if that group belongs to hospital
                    $group_id = $this->input->post('group_id');
                    $is_usergroup = $this->db->get_where('groups', array('type_cate' => 'usergroup', 'id' => $group_id))->num_rows() > 0;
                    if ($is_usergroup) {
                      $res = $this->db->get_where('hospital_group', array('group_id' => $group_id, 'hospital_id' => $hospital_id))->num_rows();
                      if ($res === 0) {
                        custom_log('Usergroup does not belong to the hospital');
                        redirect('/institute/settings', 'refresh');
                        return;
                      }
                    }
                    if ($ac === 0) {
                    // Check if the email exists
                      $email = $this->input->post('email');
                      $res = $this->db->query("SELECT * FROM users WHERE AES_DECRYPT(email, '" . DATA_KEY . "') = '$email'")->num_rows();
                      if ($res > 0) {
                        $this->session->set_flashdata('user_error', TRUE);
                        $this->session->set_flashdata('user_data', array(
                          'form_data' => array(
                            'first_name' => set_value('first_name'),
                            'last_name' => set_value('last_name'),
                            'company' => set_value('company'),
                            'phone' => set_value('phone'),
                            'email' => set_value('email'),
                            'memorable' => set_value('memorable'),
                            'user_auth_pass' => set_value('pin_code'),
                            'password' => set_value('password'),
                            'password_confirm' => set_value('password_confirm'),
                            'group_id' => $group_id,
                            'active_directory_user' => $ac
                          ),
                          'form_error' => array('email' => 'User already exists'),
                        ));
                        custom_log('Email not unique');
                        redirect('/institute/settings', 'refresh');
                        return;
                      }
                    // All checks performed. Create new user
                      $profile_picture = DEFAULT_PROFILE_PIC;
                    // Upload profile picture if exists 
                    if ($_FILES['profile_pic']["name"]) { //when user submit basic profile info with profile image
                      $config['upload_path'] = './uploads/';
                      $config['allowed_types'] = 'gif|jpg|png';
                      $config['max_size'] = '10000';
                      $config['file_name'] = time() . '-' . $_FILES['profile_pic']["name"];

                      $this->load->library('upload', $config);

                      if (!$this->upload->do_upload('profile_pic')) {
                        $error = 0;
                      } else {
                        $filedata = array('upload_data' => $this->upload->data());
                        $profile_image = $filedata['upload_data']['file_name'];
                        $image_path = 'uploads/' . $config['file_name'];
                        $profile_picture = $image_path;
                      }
                    }
                    $group_type = $this->db->get_where('groups', array('id' => $group_id))->result_array()[0]['group_type'];
                    $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                    $additional_data = [
                      'username' => $this->db->escape($username),
                      'first_name' => $this->db->escape($this->input->post('first_name')),
                      'last_name' => $this->db->escape($this->input->post('last_name')),
                      'company' => $this->db->escape($this->input->post('company')),
                      'phone' => $this->db->escape($this->input->post('phone')),
                      'memorable' => $this->db->escape($this->input->post('memorable')),
                      'user_auth_pass' => '' . $this->db->escape($this->input->post('pin_code')) . '',
                      'is_hospital_admin' => 0,
                      'profile_picture_path' => $this->db->escape($profile_picture),
                      'user_type' => $this->db->escape($group_type),
                      'group_id' => ""
                    ];
                    $identity_column = $this->config->item('identity', 'ion_auth');
                    $password = $this->input->post('password');
                    $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
                    $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array($group_id), 0);
                    // Add user to current hospital
                    $this->db
                    ->set('institute_id', $hospital_id)
                    ->where('user_id', $user_id)
                    ->update('users_groups');

                    //Assign Leaves
                    $getLeaveGroup = $this->db->get_where('user_group_week', array('group_id' => $hospital_id))->row();
                    if (!empty($getLeaveGroup)) {
                      $this->load->model('Leave_model', 'leave_model');
                      $getLeaveGroups = $this->leave_model->leaveGroupTypes(array('leave_group_types.leave_group_id' => $getLeaveGroup->leave_group_id, 'leave_group_types.status' => 1));
                      $counter = 0;
                      foreach ($getLeaveGroups as $leaveData) {
                        $insBalance[$counter]['user_id'] = $user_id;
                        $insBalance[$counter]['leave_type_id'] = $leaveData->leave_type_id;
                        $insBalance[$counter]['total_leaves'] = $leaveData->days;
                        $insBalance[$counter]['quota'] = $leaveData->days;
                        $insBalance[$counter]['availed'] = 0;
                        $insBalance[$counter]['remaining'] = $leaveData->days;
                        $insBalance[$counter]['start_date'] = date("Y") . "-01-01";
                        $insBalance[$counter]['end_date'] = date("Y") . "-12-31";
                        $insBalance[$counter]['leave_year'] = date("Y");
                        $insBalance[$counter]['created_date'] = date("Y-m-d");
                        $insBalance[$counter]['created_by'] = $this->ion_auth->user()->row()->id;
                        $counter++;
                      }
                      $chkRecord = $this->leave_model->addBatchRecord('leave_balance', $insBalance);
                    }
                    $i = 0;
                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "company";
                    $metaData[$i++]['meta_value'] = $this->input->post('company');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "address1";
                    $metaData[$i++]['meta_value'] = $this->input->post('address1');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "address2";
                    $metaData[$i++]['meta_value'] = $this->input->post('address2');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "county";
                    $metaData[$i++]['meta_value'] = $this->input->post('county');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "country";
                    $metaData[$i++]['meta_value'] = $this->input->post('country');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "postcode";
                    $metaData[$i++]['meta_value'] = $this->input->post('postcode');

                    $metaData[$i]['user_id'] = $user_id;
                    $metaData[$i]['meta_key'] = "telephone";
                    $metaData[$i++]['meta_value'] = $this->input->post('telephone');

                    $getRows = $this->db->get_where('usermeta', array('user_id' => $user_id))->num_rows();

                    if ($getRows >= 1) {
                      foreach ($metaData as $key => $data) {
                        $whereArray['user_id'] = $data['user_id'];
                        $whereArray['meta_key'] = $data['meta_key'];

                        $checkExist = $this->db->get_where('usermeta', $whereArray)->num_rows();
                        if ($checkExist >= 1) {
                          $this->db->update('usermeta', $metaData[$key], $whereArray);
                        } else {
                          $this->db->insert('usermeta', $metaData[$key]);
                        }
                      }
                    } else {
                      $this->db->insert_batch('usermeta', $metaData);
                    }
                    $this->sendVerificationEmail($email);
                    custom_log("New user created and registered");
                    redirect('/institute/settings', 'refresh');
                  } else {
                    // Get user from ac
                    $first_name = $this->input->post('first_name');
                    $last_name = $this->input->post('last_name');
                    $company = $this->input->post('company');
                    $phone = $this->input->post('phone');
                    $this->db->query("
                      UPDATE `users`
                      SET first_name = AES_ENCRYPT('$first_name', '" . DATA_KEY . "'),
                      last_name = AES_ENCRYPT('$last_name', '" . DATA_KEY . "'),
                      company = AES_ENCRYPT('$company', '" . DATA_KEY . "'),
                      phone = AES_ENCRYPT('$phone', '" . DATA_KEY . "')
                      where `users`.`id` = $ac
                      ");
                    $this->db
                    ->set('institute_id', $hospital_id)
                    ->where('user_id', $ac)
                    ->update('users_groups');


                    $i = 0;
                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "company";
                    $metaData[$i++]['meta_value'] = $this->input->post('company');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "address1";
                    $metaData[$i++]['meta_value'] = $this->input->post('address1');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "address2";
                    $metaData[$i++]['meta_value'] = $this->input->post('address2');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "county";
                    $metaData[$i++]['meta_value'] = $this->input->post('county');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "country";
                    $metaData[$i++]['meta_value'] = $this->input->post('country');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "postcode";
                    $metaData[$i++]['meta_value'] = $this->input->post('postcode');

                    $metaData[$i]['user_id'] = $ac;
                    $metaData[$i]['meta_key'] = "telephone";
                    $metaData[$i++]['meta_value'] = $this->input->post('telephone');


                    $getRows = $this->db->get_where('usermeta', array('user_id' => $ac))->num_rows();

                    if ($getRows >= 1) {
                      foreach ($metaData as $key => $data) {
                        $whereArray['user_id'] = $data['user_id'];
                        $whereArray['meta_key'] = $data['meta_key'];

                        $checkExist = $this->db->get_where('usermeta', $whereArray)->num_rows();
                        if ($checkExist >= 1) {
                          $this->db->update('usermeta', $metaData[$key], $whereArray);
                        } else {
                          $this->db->insert('usermeta', $metaData[$key]);
                        }
                      }
                    } else {
                      $this->db->insert_batch('usermeta', $metaData);
                    }


                    custom_log("User updated and registered");
                    redirect('/institute/settings', 'refresh');
                  }
                }
              } else {
                $this->output->set_status_header(404);
              }
            }

            function eximportcsv() {
              if ($_POST) {
                $fileName = $_FILES["image"]["tmp_name"];
                if ($_FILES["image"]["size"] > 0) {
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
                  while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

                    if ($i >= 1) {
                      if (isset($column[0])) {
                        $request['lab_number'] = $column[0];
                      }
                      if (isset($column[1])) {
                        $name_data = explode(" ", $column[1]);
                        $request['f_name'] = $name_data[0];
                        $request['sur_name'] = $name_data[1];

                        $patients['first_name'] = $name_data[0];
                        $patients['last_name'] = $name_data[1];
                      }
                      if (isset($column[2])) {
                        $request['dob'] = $column[2];
                        $patients['dob'] = $name_data[1];
                      }
                      if (isset($column[3])) {
                        $records_data['specimen_type'] = $column[3];
                        $request['specimen_id'] = '';
                      }
                      if (isset($column[4])) {
                        $records_data['specimen'] = $column[4];
                      }
                      if (isset($column[5])) {
                        $records_data['slides'] = $column[5];
                      }
                      $hospital_row = $this->ion_auth->get_users_groups()->row();
                      $request['hospital_group_id'] = $hospital_row->id;


                      $patients['hospital_id'] = $hospital_row->id;
                      ;
                      $patients['created_at'] = '';
                      if ($column[1] != '') {
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
                            $key = 'PB' . "." . $keyParts[1] . "." . ($Klast_d);
                          } else {
                            $key = 'PB' . "." . date("y") . ".00001";
                          }
                        } else if ($serial_query->num_rows() < 0) {
                          $key = 'PB.' . date('y') . '.00001';
                        } else {
                          $key = 'PB.' . date('y') . '.00001';
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
                      }
                    }
                    $i++;
                    $j++;
                  }
                  redirect('admin/display_all/2021/all', 'refresh');
                  return;
                } else {
                  redirect('institute/bookingin', 'refresh');
                  return;
                }
              } else {
                print "error";
              }
              exit;
            }

            function records_view() {

              if (!$this->Institute_model->is_user_hospital_admin() && !$this->ion_auth->is_admin()) {
                return redirect('/', 'refresh');
              }

              $data = "";


              $get_records_data = $this->db->query("SELECT * FROM `records_information` where hospital_id=$hos_id");
              $data['records_data'] = $get_records_data->result();


              $this->load->view('templates/header-new', $h_f_data);
              $this->load->view('institute/record_tracking/records_view', $data);
              $this->load->view('templates/footer-new', $h_f_data);
            }

            function delete_records($ids) {
              $this->db->query("DELETE FROM records_information WHERE id = $ids");
              redirect('institute/records_view', 'refresh');
              return;
            }

            public function allrecords() {
              $data = array();
              $year = 2022;
              $recent = all;
              if (!empty($year)) {
                $data["query"] = $this->Admin_model->display_record($year, $recent);
              }



              $unassigned_rec['display_unassign_records'] = $this->Admin_model->display_unassigned_records($year);
              $list['list_records'] = $this->Admin_model->display_admin_record($year, $recent);
              $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
              $result = array_merge($data, $unassigned_rec, $doc_list);

              $this->load->view('templates/header-new');
              $this->load->view('display/display_hospital_record', $result);
              $this->load->view('templates/footer-new');
            }

            public function deleterecords($id) {
              $data = array();
              $year = 2021;
              $recent = all;
              if (!empty($year)) {
                $data["query"] = $this->Admin_model->display_record($year, $recent);
              }
              $unassigned_rec['display_unassign_records'] = $this->Admin_model->display_unassigned_records($year);
              $list['list_records'] = $this->Admin_model->display_admin_record($year, $recent);
              $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
              $result = array_merge($data, $unassigned_rec, $doc_list);

              $this->load->view('templates/header-new');
              $this->load->view('display/display_hospital_record', $result);
              $this->load->view('templates/footer-new');
            }


            public function records() 
			{
              if (!$this->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
              }
              $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
              $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
              $doctor_id = $this->ion_auth->user()->row()->id;
              $filter = " AND request.speciality_group_id IN(1,2) ";
              $data["query"] = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
              $data['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id, $filter);
              $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
              $hospitallist = array();
              foreach ($checkhospital as $rec) 
			  {
                $hospitallist[] = $rec->group_id;
              }

              $data['sr_first_name'] = '';
              $data['sr_sur_name'] = '';
              $data['sr_nhs_no'] = '';
              $data['sr_dob'] = '';
              $data['sr_gender'] = '';
              $data['sr_specialty'] = '';
              $hospitals["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
              $filter = " AND speciality_group_id IN(1,2) ";
              $specialties["get_specialties"] = $this->Doctor_model->get_specialties($filter);
              $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
              $specialty_grp['speciality_group_hdn'] = "histology";
              $data['doctor_list'] = $this->Admin_model->get_doctors();
              $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist, $specialties, $specialty_grp);

              $this->load->view('templates/header-new');
              $this->load->view('doctor/record_list_hospital', $result);
              $this->load->view('templates/footer-new');
            }

public function delete_new_track_temp_data($ids)
{
	if (!$this->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
              }
			  if($ids!='')
			  {
				  $this->db->where('ura_rec_temp_id', $ids);
				  $this->db->delete('uralensis_record_track_template');
				  
				  $this->db->where('temp_id', $ids);
				  $this->db->delete('template_specimen');
			  }
			  redirect('institute/bookingin', 'refresh');
}

            public function hospitalview() 
            {
              if (!$this->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
              }

              $data['javascripts'] = array(
                'js/custom_js/laboratory_dashboard.js',
              );
              $data['usersLogins'] = $this->lab->getUsersLogins();
              $lab_id = $this->ion_auth->user()->row()->id;
              $group_row = $this->ion_auth->get_users_groups()->row();
              $group_id = $group_row->id;

              $data["lab_info"] = $this->Laboratory_model->get_alllab_information(0);

              $this->load->view('templates/header-new');
              $this->load->view('institute/hospital_view', $data);
              $this->load->view('templates/footer-new');
            }
            public function bookingin_new() 
            {
              if (!$this->ion_auth->logged_in()) {
                redirect('auth/login', 'refresh');
              }

              $this->load->view('institute/inc/header-new');
              $this->load->view('institute/record_tracking/bookingin');
              $this->load->view('institute/inc/footer-new');
            }

  public function saveHospitalData() {
        $this->load->library('form_validation');

        /*$this->form_validation->set_rules('hospital_name', 'Institute Name', 'trim|required|is_unique[groups.description]');
        $this->form_validation->set_rules('hospital_initials_1', 'Hospital First Initial', 'trim|required|exact_length[1]');
        $this->form_validation->set_rules('hospital_initials_2', 'Hospital Second Initial', 'trim|required|exact_length[1]');
        $this->form_validation->set_rules('hospital_email', 'Hospital Email', 'trim|valid_email');
        $this->form_validation->set_rules('admin_first_name', 'Admin First Name', 'trim|required');
        $this->form_validation->set_rules('admin_last_name', 'Admin Last Name', 'trim|required');
        $this->form_validation->set_rules('admin_email', 'Admin Email', 'required|valid_email|callback__unique_email');*/

        $validationConfigArr = array(
            array('field' => 'hospital_name',       'label' => 'Institute Name',    'rules' => 'trim|required|is_unique[groups.description]'),
            array('field' => 'hospital_initials_1', 'label' => 'First Initial',     'rules' => 'trim|required|exact_length[1]'),
            array('field' => 'hospital_initials_2', 'label' => 'Second Initial',    'rules' => 'trim|required|exact_length[1]'),
            array('field' => 'hospital_email',      'label' => 'Hospital Email',    'rules' => 'trim|valid_email'),
            array('field' => 'admin_first_name',    'label' => 'First Name',        'rules' => 'trim|required'),
            array('field' => 'admin_last_name',     'label' => 'Last Name',         'rules' => 'trim|required'),
            array('field' => 'admin_email',         'label' => 'Email',             'rules' => 'required|valid_email|callback__unique_email2')
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
          pre(validation_errors());
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);exit;
        } else {

            $inserted_group_id = $this->ion_auth->create_group_main(
                strtolower(str_replace(' ', '', $this->input->post('hospital_name'))), $this->input->post('hospital_initials_1'), $this->input->post('hospital_initials_2'), $this->input->post('hospital_name'), 'H', $this->input->post('hospital_information'), '', 'usergroup'
            );
            /*if($this->group_id){
                $groupID = $this->group_id;
            }else{
                $inserted_group_id = $this->ion_auth->create_group_main(
                    strtolower(str_replace(' ', '', $this->input->post('hospital_name'))), $this->input->post('hospital_initials_1'), $this->input->post('hospital_initials_2'), $this->input->post('hospital_name'), 'H', $this->input->post('hospital_information'), '', 'usergroup'
                );
            }*/

            if ($inserted_group_id) {

                // add hospital data
                $hospitalData = array(
                    'group_id'      => $inserted_group_id,
                    'hosp_address'  => $this->input->post('hospital_address'),
                    'hosp_country'  => $this->input->post('hospital_country'),
                    'hosp_city'     => $this->input->post('hospital_city'),
                    'hosp_state'    => $this->input->post('hospital_state'),
                    'hosp_post_code'=> $this->input->post('hospital_post_code'),
                    'hosp_email'    => $this->input->post('hospital_email')
                );
                $res1 = $this->Admin_model->insertHospitalInformation($hospitalData);
                if($res1){
                    $inserted_hospital_id = $this->db->insert_id();
                }

                // add hospital admin user data
                $username = strtolower($this->input->post('admin_first_name')) . ' ' . strtolower($this->input->post('admin_last_name'));
                $email = $this->input->post('admin_email');
                $identity = $email;
                $password = $this->randomGeneratePassword();
                $is_hospital_admin = 1;

                $group_id = $inserted_group_id;
                $profile_picture = DEFAULT_PROFILE_PIC;
                $user_type = 'H';
                $additional_data = [
                    'username'              => $this->db->escape($username),
                    'first_name'            => $this->db->escape($this->input->post('admin_first_name')),
                    'last_name'             => $this->db->escape($this->input->post('admin_last_name')),
                    'company'               => $this->db->escape($this->input->post('hospital_name')),
                    'phone'                 => $this->db->escape($this->input->post('admin_phone')),
                    'memorable'             => $this->db->escape('helloworld'),
                    'is_hospital_admin'     => $is_hospital_admin,
                    'profile_picture_path'  => $this->db->escape($profile_picture),
                    'user_type'             => $this->db->escape($user_type),
                    'group_id'              => ""
                ];
                $groups_array = array();
                $getHospitalAdminGroup = "SELECT * FROM groups where group_type = 'HA'";
                $adminGroupResult = $this->db->query($getHospitalAdminGroup)->result_array($getHospitalAdminGroup);

                if ($group_id !== -1){
                    $groups_array = array($adminGroupResult[0]["id"]);
                }
                $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, 0);
                $res2 = $this->db->insert("users_groups", ['user_id' => $user_id, 'institute_id' => $inserted_group_id]);
                $res3 = $this->db->insert("hospital_group", ['hospital_id' => $inserted_group_id, 'group_id' => $this->group_id]);

                if($res1 && $res2 && $res3){
                    $dataArr = ['id' => $inserted_group_id, 'text' => $this->input->post('hospital_name') ];
                    echo json_encode(['status' => 'success', 'message' => 'Hospital add successfully', 'dataArr' => $dataArr]);exit;
                }else{
                    echo json_encode(['status' => 'error', 'message' => validation_errors()]);exit;
                }
            }else{
                echo json_encode(['status' => 'error', 'message' => 'Error Creating, hospital user try again later.']);exit;
            }
        }
    }

    public function getBatchByCourier(){
        if(!empty($_POST['courier_no'])){
            $userID = $this->ion_auth->user()->row()->id;
            $courierNo = $_POST['courier_no'];
            $result = $this->Institute_model->getCourierData($userID, $courierNo);
            if($result) {
                echo json_encode(['status'=>'success', 'data'=>$result]);exit;
            }else{
                echo json_encode(['status' => 'error', 'message' => 'Some thing wrong!']);exit;
            }
        }
        echo json_encode(['status' => 'error', 'message' => 'Some thing wrong!']);exit;
    }

    private function randomGeneratePassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function _unique_email2($str) {
        if (!$this->ion_auth->logged_in()) {
            return FALSE;
        }
        $res = $this->db->where("AES_DECRYPT(email, '" . DATA_KEY . "') = ", $str)->get('users')->num_rows();
        
        if ($res > 0) {
            $this->form_validation->set_message('_unique_email', 'This email already exists');
            return FALSE;
        }
        return TRUE;
    }

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

}
