<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Admin extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Ion_auth_model');
        $this->load->model('Institute_model');
        $this->load->model('Userextramodel');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper','globalfunctions'));
        track_user_activity(); //Track user activity function which logs user track actions.

        // Check if user is logged in and is admin
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
           // redirect('auth/login', 'refresh');
        }
    }

    /**
     * Dashboard Function
     * Load Dashboard View
     *
     */
    public function home($id = "")
    {
        $data['totalreports'] = $this->Admin_model->gettotalpublishedunpublishedreports();
        $data['totalreportsCurrentYear'] = $this->Admin_model->gettotalpublishedunpublishedreports(date("Y"));
        $data['totalfurthercase'] = $this->Admin_model->totalnumbersoffurtherwork();
        $data['totalfurthercasecurryear'] = $this->Admin_model->totalnumbersoffurtherwork(date("Y"));
        $data['tatmorethanten'] = $this->Admin_model->tottattendays();
        $data['gethospitals'] = $this->Admin_model->display_hospitals_list();
        $data['getpublishedcases'] = $this->Admin_model->getpublishedcases();
        $data['totalNoAdmin'] = $this->Admin_model->getAllNonAdminUser();
        $data['usersLogins'] = $this->Admin_model->getUsersLogins();
        $data["parent_id"] = $id;
        $data["firstRowCounts"] = $this->Admin_model->getDashboardFirstRowCount(); 
        $data["hospital_networks"] = $this->Admin_model->getHospitalNetworks(); 
      
        $data['user_error'] = array();
        $this->load->model('Tasks_model');
        $userid = $this->ion_auth->user()->row()->id;
        $data['task_stats'] = $this->Tasks_model->get_stats($userid);
        $this->load->view('templates/header-new');
        $this->load->view('display/dashboard-new', $data);
        $this->load->view('templates/footer-new');
    }


    // TODO: Hospital settings should only be managed from the institute settings area.
    // Remove this function
    public function getsettings($role_id = "")
    {
        if ($_POST) {
            if ($this->input->post('submittype') == "adduser") {
                $getusertype = getRecords("*", "groups", array("id" => $this->input->post('user_groups')));
                $additional_data = [
                    'first_name' => $this->db->escape($this->input->post('first_name')),
                    'last_name' => $this->db->escape($this->input->post('last_name')),
                    'company' => $this->db->escape($this->input->post('company')),
                    'phone' => $this->db->escape($this->input->post('phone')),
                    'user_type' => $getusertype[0]->group_type,
                    'memorable' => $this->db->escape($this->input->post('memorable')),
                    'group_id' => intval($this->input->post('user_groups')),
                    'image_name' => $this->input->post('profile_image_name'),
                    'image_path' => $this->input->post('profile_image_path'),
                    'hospital_group' => $this->input->post('hospital_list')
                ];
                $password = $this->input->post('password');

                $result = $this->ion_auth->register($this->input->post('email'), $password, $this->input->post('email'), $additional_data);

                $group_id = array();
                array_push($group_id, $this->input->post('institute_id'));
                if ($result != 0)
                    $updateGroupid = $this->Userextramodel->updategroupID($result, $this->input->post('user_groups'), $group_id);

            } else {
                $arrayextra = array(
                    "address" => $this->input->post("address"),
                    "initials" => $this->input->post("initials"),
                    "postalcode" => $this->input->post("postalcode"),
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "mobile" => $this->input->post("mobile"),
                    "fax" => $this->input->post("fax"),
                    "website" => $this->input->post("website")
                );

                $updateArray = array(
                    "first_initial" => substr($this->input->post("initial_name"), 0, 1),
                    "last_initial" => substr($this->input->post("initial_name"), 0, 2),
                    "name" => $this->input->post("name"),
                    "information" => json_encode($arrayextra)
                );
                $update = updateRecord("groups", $updateArray, array("id" => $this->input->post("role_id")));
            }
        }
        $data["Hospital"] = $this->Userextramodel->getCountOfUserGroups($role_id, "H");
        $data["Admin"] = $this->Userextramodel->getHospitalAdmin($role_id, "HA");
        $data["Clinician"] = $this->Userextramodel->getCountOfUserGroups($role_id, "C");
        $data["Requestor"] = $this->Userextramodel->getCountOfUserGroups($role_id, "R");
        $data["CancerService"] = $this->Userextramodel->getCountOfUserGroups($role_id, "CS");
        $data["Laboratory"] = $this->Userextramodel->getCountOfUserGroups($role_id, "L");
        $data["Pathologist"] = $this->Userextramodel->getCountOfUserGroups($role_id, "D");
        $data["Secretary"] = $this->Userextramodel->getCountOfUserGroups($role_id, "S");
        $data["Trainee"] = $this->Userextramodel->getCountOfUserGroups($role_id, "T");
        $data["getRoleData"] = getRecords("*", "groups", array("id" => $role_id));
        $data["role_id"] = $role_id;
        $this->load->view('templates/header-new');

        $this->load->view('pages/settings.php', $data);

        $this->load->view('templates/footer-new');
    }

    /**
     * Roles and Permissions
     * 
     */
    // TODO: Roles and permission needs reworking according to the new groups.
    // Not in use.
    public function grouplist()
    {
        if ($_POST) {

            if ($this->input->post("method") == "addusergroup") {
                $updateArray = array(
                    "name" => $this->input->post("group_name"),
                    "parent_id" => $this->input->post("parent_id"),
                    "type_cate" => "usergroup"

                );
                $insert = insertRecord("groups", $updateArray);
                $this->session->set_flashdata('updateMessage', "institute added!");
            } else if ($this->input->post("method") == "updateusergroup") {
                $updateArray = array(
                    "name" => $this->input->post("group_name"),
                    "parent_id" => $this->input->post("parent_id"),
                    "type_cate" => "usergroup"
                );
                $update = updateRecord("groups", $updateArray, array("id" => $this->input->post("group_id")));
                $this->session->set_flashdata('updateMessage', "institute Updated!");
            } else if ($this->input->post("method") == "addcategory") {
                $updateArray = array(
                    "name" => $this->input->post("group_name"),
                    "parent_id" => 0,
                    "group_type" => "",
                    "type_cate" => "category",
                    "parent_cate" => $this->input->post("parent_id_cat")
                );
                $insert = insertRecord("groups", $updateArray);
                $this->session->set_flashdata('updateMessage', "User Category added!");
            } else if ($this->input->post("method") == "editcategory") {
                $updateArray = array(
                    "name" => $this->input->post("group_name"),
                    "parent_id" => 0,
                    "type_cate" => "category",
                    "parent_cate" => $this->input->post("parent_id_cat")
                );
                $update = updateRecord("groups", $updateArray, array("id" => $this->input->post("group_id")));
                $this->session->set_flashdata('updateMessage', "User Category Updated!");
            }
        }
        $data = array();
        $data["groups"] = getRecords("*", "groups", array("type_cate" => "usergroup"));
        $data["category"] = getRecords("*", "groups", array("type_cate" => "category"));
        $this->load->view('templates/header-new');
        $this->load->view('display/roles_permission', $data);
        $this->load->view('templates/footer-new');
    }

    // Add specialty, specialty codes and snomed codes
    public function specialty($id)
    {
        $specialty = $this->db->get_where('specialties', ['id' => $id])->row();
        if ($this->input->is_ajax_request()) {
            echo json_encode($specialty);
        } else {
            $data = array();
            $data['specialty'] = $specialty;
            $decryptFields = [
                "AES_DECRYPT(username, '" . DATA_KEY . "') AS username",
                "AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name",
                "AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name",
                "AES_DECRYPT(email, '" . DATA_KEY . "') AS email",
            ];
            $decryptFields = implode(', ', $decryptFields);
            $data['doctors'] = $this->db->select('*, ' . $decryptFields)
                ->from('usermeta')
                ->where('meta_key', 'specialty_id')
                ->where('meta_value', $specialty->id)
                ->join('users', 'usermeta.user_id = users.id')
                ->get()
                ->result();
            $data['specialties'] = $this->db->get('specialties')->result();
            $data['specialtyCodes'] = $this->Admin_model->get_specialty_code_data();
            $data['specialtyNav'] = $this->load->view('display/navigation/specialty_navigation', $data, TRUE);
            $this->load->view('templates/header-new');
            $this->load->view('display/admin_edit_specialty', $data);
            $this->load->view('templates/footer-new');
        }
    }

    // TODO: same as above function 
    public function specialties()
    {
        $formData = $this->input->post();
        if (!empty($formData)) {
            if ($formData['action'] == 'create_specialty') {
                $this->Admin_model->create_specialty($formData['specialty'], $formData['pa'], $formData['code']);
            }
            if ($formData['action'] == 'update_specialty') {
                $this->Admin_model->update_specialty($formData['id'], [
                    'specialty' => $formData['specialty'],
                    'pa' => $formData['pa']
                ]);
            }
            if ($formData['action'] == 'delete_specialty') {
                $this->Admin_model->delete_specialty($formData['id']);
            }
            if ($formData['action'] == 'delete_specialty_code') {
                $this->Admin_model->delete_specialty_code($formData['id'], $formData['code']);
            }
        }
        $data = array();
        $data['specialties'] = $this->db->get('specialties')->result();
        $data['specialtyCodes'] = $this->Admin_model->get_specialty_code_data();
        $data['specialtyNav'] = $this->load->view('display/navigation/specialty_navigation', $data, TRUE);
        $this->load->view('templates/set-header-new');
        $this->load->view('display/admin_specialty_settings', $data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Record list view
     *
     */
    // Should only be present in pathologists area
    // Ṣhould not be accessed from here
    public function doctor_record_list()
    {
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/institute/doctor_record_list'));
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data["query"] = $this->Admin_model->doctor_record_list();
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }
        $hospitals["get_hospitals"] = $this->Admin_model->display_hospitals_list($hospitallist);
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist);
        $this->load->view('templates/header-new');
        $this->load->view('doctor/record_list', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Display Further Work.
     *
     */

    // TODO: Review. Broken page.
    public function view_further_work()
    {
        if (!empty($_GET) && $_GET['fw_page'] == 'requested') 
		{
            $fw_data1["requested"] = $this->Admin_model->display_further_work_model_requested();
            $this->load->view('doctor/inc/header-new');
            // $this->load->view('templates/header-new');
            $this->load->view('lab/fw_requested_new', $fw_data1);
            // $this->load->view('templates/footer-new');
            $this->load->view('doctor/inc/footer-new');
        } else if (!empty($_GET) && $_GET['fw_page'] == 'completed') 
		{
            $fw_data2["completed"] = $this->Admin_model->display_further_work_model_completed();
            $this->load->view('templates/header-new');
            $this->load->view('doctor/fw_completed', $fw_data2);
            $this->load->view('templates/footer-new');
        } else {
            redirect('/doctor');
        }
    }

    /**
     * Load all records
     *
     * @param string $year
     * @param int $recent
     */
    public function display_all($year, $recent = '')
    {
        $data = array();
		$year=2021;
        if (!empty($year)) 
		{
            $data["query"] = $this->Admin_model->display_record($year, $recent);
        }
		$user_id = $this->ion_auth->user()->row()->id;
        //$unassigned_rec['display_unassign_records'] = $this->Admin_model->display_published_records($year);
		if($this->ion_auth->is_admin())
		{
		}
		else
		{
        // $list['list_records'] = $this->Admin_model->display_admin_record($year, $recent,$user_id);
		}
		//$doc_list['doctor_list'] = $this->Admin_model->get_doctors();
		//$doc_aslist['assign_doctor_list'] = $this->Admin_model->get_assigned_doctors();
        // $result = array_merge($data, $unassigned_rec, $doc_list,$doc_aslist);
        $result = array_merge($data);
		if (!empty($this->ion_auth->get_users_groups()->row()->id)) 
		{
           $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }
		$group_type=$groups[0]->group_type;
		if (in_array($group_type, LAB_GROUP))
		{
			$this->load->view('templates/header-new');
			$this->load->view('display/display_record_publish', $result);
			$this->load->view('templates/footer-new');
		}
		else
		{
			$this->load->view('templates/header-new');
			$this->load->view('display/display_record_publish', $result);
			$this->load->view('templates/footer-new');			
		}
		
		

    }
	
	
	public function display_unpublish($year, $recent = '')
    {
        $data = array();
		$year=2021;
        if (!empty($year)) 
		{
            $data["query"] = $this->Admin_model->display_record($year, $recent);
        }
		$user_id = $this->ion_auth->user()->row()->id;
        $unassigned_rec['display_unassign_records'] = $this->Admin_model->display_unassigned_records($year);
        $list['list_records'] = $this->Admin_model->display_admin_record($year, $recent,$user_id);
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
		$doc_aslist['assign_doctor_list'] = $this->Admin_model->get_assigned_doctors();
		
	
        $result = array_merge($data, $unassigned_rec, $doc_list,$doc_aslist);


        
		if (!empty($this->ion_auth->get_users_groups()->row()->id)) 
		{
           $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }
		$group_type=$groups[0]->group_type;
		if (in_array($group_type, LAB_GROUP))
		{
			$this->load->view('templates/header-new');
			$this->load->view('display/display_record-new', $result);
			$this->load->view('templates/footer-new');
		}
		else
		{
			$this->load->view('templates/header-new');
			$this->load->view('display/display_record-new', $result);
			$this->load->view('templates/footer-new');			
		}
		
		

    }
	
	
	

    /**
     * Record detail page
     *
     * @param int $id
     */
    public function detail_view_record($id)
    {
        $userid = $this->ion_auth->user()->row()->id;
        $data1['query1'] = $this->Admin_model->detail_record_view_request($id);
        $data2['query2'] = $this->Admin_model->detail_record_view_specimen($id);
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
        $record_history['record_history'] = $this->Admin_model->get_record_history_data($id);
        $specimen_type['specimen_type'] = $this->Admin_model->specimen_type();
        $result = array_merge($data1, $data2, $doc_list, $record_history, $specimen_type);
        $session_data = array(
            'id' => $id
        );
        $this->session->set_userdata($session_data);
        $user_id = $this->session->userdata('id');
        require_once('application/views/display/record_history/record_history-functions.php');
        $this->load->view('templates/header-new');
        $this->load->view('display/detail_record', $result);
        $this->load->view('templates/footer-new');
    }
	
	
	public function detail_view_unrecord($id)
    {
        $userid = $this->ion_auth->user()->row()->id;
        $data1['query1'] = $this->Admin_model->detail_record_view_request($id);
        $data2['query2'] = $this->Admin_model->detail_record_view_specimen($id);
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
        $record_history['record_history'] = $this->Admin_model->get_record_history_data($id);
        $specimen_type['specimen_type'] = $this->Admin_model->specimen_type();
        $result = array_merge($data1, $data2, $doc_list, $record_history, $specimen_type);
        $session_data = array(
            'id' => $id
        );
        $this->session->set_userdata($session_data);
        $user_id = $this->session->userdata('id');
        require_once('application/views/display/record_history/record_history-functions.php');
        $this->load->view('templates/header-new');
        $this->load->view('display/detail_record', $result);
        $this->load->view('templates/footer-new');
    }

    /**
     * Edit record function
     *
     * @param int $id
     */
    public function edit_report($id)
    {
        $session_data = array(
            'request_id' => $id
        );
        $this->session->set_userdata($session_data);
        $record_query['record_query'] = $this->Admin_model->detail_record_view_request($id);
        $specimen_query['specimen_query'] = $this->Admin_model->detail_record_view_specimen($id);
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $data_array = array_merge(
            $record_query,
            $specimen_query,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/header-new');
        $this->load->view('display/edit_record-new', $data_array);
        $this->load->view('templates/footer-new');
    }

    /**
     * Update Report function
     *
     */
    public function update_personal_report()
    {
        if (isset($_POST)) {
            $json = array();
            $user_id = $this->ion_auth->user()->row()->id;
            $record_id = $_POST['record_id'];
            $lab_number = $this->input->post('lab_number');
            if (!empty($record_id)) {
                $check_lab_no = $this->db->query("SELECT request.lab_number FROM request WHERE request.lab_number = '$lab_number'")->result_array();
                //Check if lab number match then redirect to form page.
                if (($lab_number == 'U') ||
                    ($lab_number == 'S') ||
                    ($lab_number == 'H') &&
                    (strlen($lab_number) == 1)
                ) {
                    //return true;
                } else if (!empty($check_lab_no[0]['lab_number']) && $check_lab_no[0]['lab_number'] === $lab_number) {
                    $json['type'] = 'error';
                    $json['msg'] = 'This lab number already assigned to some case.';
                    echo json_encode($json);
                    die;
                }
            }
            $record_data = array(
                'f_name' => $this->input->post('first_name'),
                'sur_name' => $this->input->post('sur_name'),
                'ura_barcode_no' => $this->input->post('tracking_no'),
                'patient_initial' => $this->input->post('patient_initial'),
                'pci_number' => $this->input->post('pci_no'),
                'emis_number' => $this->input->post('emis_number'),
                'nhs_number' => str_replace(' ', '', $this->input->post('nhs_number')),
                'lab_number' => $this->input->post('lab_number'),
                'dob' => !empty($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '',
                'lab_name' => $this->input->post('lab_name'),
                'date_received_bylab' => !empty($this->input->post('date_received_bylab')) ? date('Y-m-d', strtotime($this->input->post('date_received_bylab'))) : '',
                'date_sent_touralensis' => !empty($this->input->post('date_sent_touralensis')) ? date('Y-m-d', strtotime($this->input->post('date_sent_touralensis'))) : '',
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
                'date_taken' => !empty($this->input->post('date_taken')) ? date('Y-m-d', strtotime($this->input->post('date_taken'))) : '',
                'report_urgency' => $this->input->post('report_urgency'),
                //'cl_detail' => html_escape($this->input->post('cl_detail')),
                'cases_category' => $this->input->post('cases_category')
            );
            //Update age column if date field is updated or changed.
            $dob = '';
            $age = '';
            if (!empty($this->input->post('dob'))) {
                //Get the request time of current record.
                $request_time_data = $this->db->select('request_datetime')->where('uralensis_request_id', $record_id)->get('request')->row_array()['request_datetime'];
                $request_time = date('Y-m-d', strtotime($request_time_data));
                $dob = date('Y-m-d', strtotime($this->input->post('dob')));
                $diff = date_diff(date_create($dob), date_create($request_time));
                $age = $diff->format('%y');
                //Update age field in current record.
                $this->db->where('uralensis_request_id', $record_id)->update('request', array('age' => intval($age)));
            }
            /**
             * Get pre saved data from request
             * Update record history data
             * Prepare Data for update
             */
            $get_record = "SELECT f_name, ura_barcode_no, sur_name,
            patient_initial, pci_number, emis_number,
            nhs_number, lab_number, dob, lab_name,
            date_received_bylab, date_sent_touralensis,
            gender, clrk, dermatological_surgeon, date_taken,
            report_urgency, cl_detail, cases_category
            FROM request
            WHERE request.uralensis_request_id = $record_id";
            $get_record_data = $this->db->query($get_record)->result_array();
            $record_history_data = array();
            if ($get_record_data[0] === $record_data) {
                $json['type'] = 'error';
                $json['msg'] = 'You have not changed any field yet!';
                echo json_encode($json);
                die;
            } else {
                foreach ($record_data as $key => $value) {
                    if ($value !== $get_record_data[0][$key]) {
                        $record_history_data[$key] = $record_data[$key];
                    }
                }
            }
            if (!empty($record_history_data)) {
                $history_data = array(
                    'rec_history_user_id' => $user_id,
                    'rec_history_record_id' => $record_id,
                    'rec_history_data' => serialize($record_history_data),
                    'rec_history_status' => 'edit',
                    'timestamp' => time()
                );
                $this->db->insert('uralensis_record_history', $history_data);
            }
            //Update request data.
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $record_data);
            /* Check if user enter the pci number to save */
            if (!empty($this->input->post('pci_no'))) {
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('request_code_status' => 'pci_added'));
            }
            /**
             * Update The user id and timestamp
             */
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            $check_record = $this->db->affected_rows();
            if ($check_record == 1) {
                $json['type'] = 'success';
                $json['msg'] = 'Record Has Been Successfully Updated';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Some how record did not updated successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Update specimen data
     *
     */
    public function update_edit_report()
    {
        if (isset($_POST)) {
            $json = array();
            $record_id = $_POST['record_id'];
            $specimen_id = $_POST['specimen_id'];
            $spec = array(
                'specimen_accepted_by' => $this->input->post('specimen_accepted_by'),
                'specimen_assisted_by' => $this->input->post('specimen_assisted_by'),
                'specimen_block_checked_by' => $this->input->post('specimen_block_checked_by'),
                'specimen_labelled_by' => $this->input->post('specimen_labeled_by'),
                'specimen_qc_by' => $this->input->post('specimen_qcd_by'),
                'specimen_block' => $this->input->post('specimen_block'),
                'specimen_cutup_by' => $this->input->post('specimen_cutupby'),
                'specimen_slides' => $this->input->post('specimen_slides'),
                'specimen_type' => $this->input->post('specimen_type'),
                'specimen_clinical_history' => $this->input->post('specimen_clinical_history'),
                'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
                'specimen_microscopic_code' => $this->input->post('specimen_microscopic_code'),
                'specimen_microscopic_description' => $this->input->post('specimen_microscopic_description'),
                'specimen_cancer_register' => $this->input->post('specimen_cancer'),
                'specimen_diagnosis_description' => $this->input->post('specimen_dignosis')
            );
            $this->db->where('request_id', $record_id);
            $this->db->where('specimen_id', $specimen_id);
            $this->db->update('specimen', $spec);
            $user_id = $this->ion_auth->user()->row()->id;
            //Update The user id and timestamp
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            $check_specimen_record = $this->db->affected_rows();
            if ($check_specimen_record == 1) {
                $json['type'] = 'success';
                $json['msg'] = '<div class="bg-success alert">Specimen Has Been Successfully Updated</div><hr>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="bg-danger alert">Some how specimen did not updated successfully.</div><hr>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Assign doctor to record
     *
     */
    public function save_assign_doctor()
    {
        $json = array();
        if (isset($_POST) && !$_POST['doctor'] == 0) {
            $req_id = $_POST['record_id'];
            $request_assign = array(
                'request_id' => $req_id,
                'user_id' => $this->input->post('doctor'),
            );
            $this->Admin_model->save_assign_doctor($request_assign, $req_id);
            $this->db->where('uralensis_request_id', $req_id);
            $this->db->update('request', array('request_code_status' => 'assign_doctor', 'request_assign_status' => intval(1)));
            if ($this->db->affected_rows() > 0) {
                $json['type'] = 'success';
                $json['msg'] = 'Doctor Successfully Assigned To This Record.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something Went Wrong While Assigning The Doctor. Contact Admin.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Kindly Select the doctor First!';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search record
     *
     */
    public function search_request()
    {
        $emis_no = $this->input->post('emis_no');
        $nhs_no = $this->input->post('nhs_no');
        $f_name = $this->input->post('first_name');
        $l_name = $this->input->post('sur_name');
        $lab_no = $this->input->post('lab_no');
        $data['query'] = $this->Admin_model->get_search_request(
            $emis_no,
            $nhs_no,
            $f_name,
            $l_name,
            $lab_no
        );
        $this->load->view('templates/header-new');
        $this->load->view('display/search_result', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Download reports view
     *
     */
    public function download_reports()
    {
        $data['hospital_groups'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/download_record-new', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Find CSV reports
     *
     */
    public function find_csv_reports()
    {
        if (isset($_GET) && $_GET['hospital_list'] > 0 && $_GET['date_to'] != '' && $_GET['date_from'] != '') {
            $group_id = $_GET['hospital_list'];
            $date_to = date('Y-m-d', strtotime($_GET['date_to']));
            $date_from = date('Y-m-d', strtotime($_GET['date_from']));
            if (isset($_GET['published_reports'])) {
                $csv_records['find_csv_records'] = $this->Admin_model->find_csv_report_model_publish($group_id, $date_to, $date_from);
            } else {
                $csv_records['find_csv_records'] = $this->Admin_model->find_csv_report_model_publish_unpublish($group_id, $date_to, $date_from);
            }
            $this->load->view('templates/header-new');
            $this->load->view('display/csv_records', $csv_records);
            $this->load->view('templates/footer-new');
        } else {
            $search_error = '<p class="alert bg-danger">Some Thing Wrong. Try To Fill Out All Fields And Then Press Search Reports.</p>';
            $this->session->set_flashdata('csv_search_error', $search_error);
            redirect('admin/download_reports');
        }
    }

    /**
     * Download CSV for publish records
     *
     */
    public function download_csv_publish()
    {
        if (isset($_GET)) {
            $csv_records_query = '';
            $group_id = $_GET['hospital_list'];
            $date_to = date('Y-m-d', strtotime($_GET['date_to']));
            $date_from = date('Y-m-d', strtotime($_GET['date_from']));
            $group_name = $this->ion_auth->group($group_id)->row()->description;
            $csv_records_query .= "SELECT request.uralensis_request_id, request.comment_section,
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
            if (!empty($_GET['check_date_rec_by_doctor'])) {
                $csv_records_query .= 'request.date_rec_by_doctor,';
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
                $csv_records_query .= 'request.cl_detail, ';
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
                $output,
                array(
                    $group_name,
                )
            );
            fputcsv(
                $output,
                array(
                    'Uralensis NO',
                    'Date Taken',
                    'Lab Number',
                    'Patient Name',
                    'Sex',
                    'Date of Birth',
                    'NHS Number',
                    'Emis Number',
                    'D. Received Lab',
                    'D. Received By Doctor',
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
                    'Old Comments',
                    'Comments',
                    'Notes'
                )
            );
            $query_csv_records = $this->db->query($csv_records_query);
            foreach ($query_csv_records->result_array() as $row) {
                $specimens = $this->count_specimens($row['uralensis_request_id']);
                $fname = !empty($row['f_name']) ? $row['f_name'] : '';
                $surname = !empty($row['sur_name']) ? $row['sur_name'] : '';
                $patinet_name = $fname . ' ' . $surname;
                fputcsv(
                    $output,
                    array(
                        'Uralensis NO' => !empty($row['serial_number']) ? $row['serial_number'] : '',
                        'Date Taken' => !empty($row['date_taken']) ? $row['date_taken'] : '',
                        'Lab Number' => !empty($row['lab_number']) ? $row['lab_number'] : '',
                        'Patient Name' => !empty($patinet_name) ? $patinet_name : '',
                        'Sex' => !empty($row['gender']) ? $row['gender'] : '',
                        'Date of Birth' => !empty($row['dob']) ? $row['dob'] : '',
                        'NHS Number' => !empty($row['nhs_number']) ? $row['nhs_number'] : '',
                        'Emis Number' => !empty($row['emis_number']) ? $row['emis_number'] : '',
                        'D. Received Lab' => !empty($row['date_received_bylab']) ? $row['date_received_bylab'] : '',
                        'D. Received By Doctor' => !empty($row['date_rec_by_doctor']) ? $row['date_rec_by_doctor'] : '',
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
                $old_comments = '';
                if (!empty($row['comment_section'])) {
                    $old_comments = $row['comment_section'];
                }
                if (!empty($specimens)) {
                    foreach ($specimens as $spec) {
                        $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                        $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                        $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                        $microscopy = $spec['specimen_microscopic_description'];
                        $macroscopy = $spec['specimen_macroscopic_description'];
                        $comments = '';
                        $notes = '';
                        if (!empty($_GET['specimen_comment_section'])) {
                            $comments = $spec['specimen_comment_section'];
                        }
                        if (!empty($_GET['specimen_special_notes'])) {
                            $notes = $spec['specimen_special_notes'];
                        }
                        fputcsv(
                            $output,
                            array(
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
                                '',
                                'Diagnosis' => !empty($_GET['speci_diagnosis']) && !empty($spec['specimen_diagnosis_description']) ? $spec['specimen_diagnosis_description'] : '',
                                'Snomed T' => !empty($_GET['speci_snomed_t']) && !empty($snomed_t) ? $snomed_t : '',
                                'Snomed P' => !empty($_GET['speci_snomed_p']) && !empty($snomed_p) ? $snomed_p : '',
                                'Snomed M' => !empty($_GET['speci_snomed_m']) && !empty($snomed_m) ? $snomed_m : '',
                                'Microscopy' => !empty($_GET['specimen_microscopy']) && !empty($microscopy) ? $microscopy : '',
                                'Macroscopy' => !empty($_GET['specimen_macroscopy']) && !empty($macroscopy) ? $macroscopy : '',
                                'Old Comments' => $old_comments,
                                'Comments' => $comments,
                                'Notes' => $notes,
                            )
                        );
                    }
                }
            }
        }
    }

    /**
     * Count specimens
     *
     * @param int $record_id
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
     * Get reporting doctor from request_assignee table
     *
     * @param int $request_id
     * @return string
     */
    public function get_reporting_doctor($request_id)
    {
        if (!empty($request_id)) {
            //Get doctor id from request assignee table.
            $doctor_id = $this->db->select('user_id')->where('request_id', $request_id)->get('request_assignee')->row_array()['user_id'];

            return $this->get_uralensis_username($doctor_id);
        }
    }

    /**
     * Get User first and last name
     *
     * @param int $user_id
     */
    public function get_uralensis_username($user_id)
    {
        if (!empty($user_id)) {
            $f_name = $this->ion_auth->user($user_id)->row()->first_name;
            $l_name = $this->ion_auth->user($user_id)->row()->last_name;
            $username = $f_name . ' ' . $l_name;

            return $username;
        }
    }

    /**
     * Download CSV for publish and un-publish records
     *
     */
    public function download_csv_publish_unpublish()
    {
        if (isset($_GET)) {
            $csv_pub_unpub = '';
            $group_id = $_GET['hospital_list'];
            $date_to = date('Y-m-d', strtotime($_GET['date_to']));
            $date_from = date('Y-m-d', strtotime($_GET['date_from']));
            $group_name = $this->ion_auth->group($group_id)->row()->description;
            $csv_pub_unpub .= "SELECT request.uralensis_request_id, request.comment_section,
            request.specimen_publish_status, request.cl_detail,
            request.request_datetime, ";
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
            if (!empty($_GET['check_date_rec_by_doctor'])) {
                $csv_pub_unpub .= 'request.date_rec_by_doctor,';
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
                $csv_pub_unpub .= 'request.cl_detail, ';
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
                $output,
                array(
                    $group_name,
                )
            );
            fputcsv(
                $output,
                array(
                    'Uralensis NO',
                    'Date Taken',
                    'Lab Number',
                    'Patient Name',
                    'Sex',
                    'Date of Birth',
                    'NHS Number',
                    'Emis Number',
                    'D. Received Lab',
                    'D. Received By Doctor',
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
                    'Old Comments',
                    'Comments',
                    'Notes'
                )
            );
            fputcsv(
                $output,
                array(
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
                        $output,
                        array(
                            'Uralensis NO' => !empty($row['serial_number']) ? $row['serial_number'] : '',
                            'Date Taken' => !empty($row['date_taken']) ? $row['date_taken'] : '',
                            'Lab Number' => !empty($row['lab_number']) ? $row['lab_number'] : '',
                            'Patient Name' => !empty($patinet_name) ? $patinet_name : '',
                            'Sex' => !empty($row['gender']) ? $row['gender'] : '',
                            'Date of Birth' => !empty($row['dob']) ? $row['dob'] : '',
                            'NHS Number' => !empty($row['nhs_number']) ? $row['nhs_number'] : '',
                            'Emis Number' => !empty($row['emis_number']) ? $row['emis_number'] : '',
                            'D. Received Lab' => !empty($row['date_received_bylab']) ? $row['date_received_bylab'] : '',
                            'D. Received By Doctor' => !empty($row['date_rec_by_doctor']) ? $row['date_rec_by_doctor'] : '',
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
                    $old_comments = '';
                    if (!empty($row['comment_section'])) {
                        $old_comments = $row['comment_section'];
                    }
                    if (!empty($specimens)) {
                        foreach ($specimens as $spec) {
                            $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                            $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                            $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                            $microscopy = $spec['specimen_microscopic_description'];
                            $macroscopy = $spec['specimen_macroscopic_description'];
                            $comments = '';
                            $notes = '';
                            if (!empty($_GET['specimen_comment_section'])) {
                                $comments = $spec['specimen_comment_section'];
                            }
                            if (!empty($_GET['specimen_special_notes'])) {
                                $notes = $spec['specimen_special_notes'];
                            }
                            fputcsv(
                                $output,
                                array(
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
                                    '',
                                    'Diagnosis' => !empty($_GET['speci_diagnosis']) && !empty($spec['specimen_diagnosis_description']) ? $spec['specimen_diagnosis_description'] : '',
                                    'Snomed T' => !empty($_GET['speci_snomed_t']) && !empty($snomed_t) ? $snomed_t : '',
                                    'Snomed P' => !empty($_GET['speci_snomed_p']) && !empty($snomed_p) ? $snomed_p : '',
                                    'Snomed M' => !empty($_GET['speci_snomed_m']) && !empty($snomed_m) ? $snomed_m : '',
                                    'Microscopy' => !empty($_GET['specimen_microscopy']) && !empty($microscopy) ? $microscopy : '',
                                    'Macroscopy' => !empty($_GET['specimen_macroscopy']) && !empty($macroscopy) ? $macroscopy : '',
                                    'Old Comments' => $old_comments,
                                    'Comments' => $comments,
                                    'Notes' => $notes,
                                )
                            );
                        }
                    }
                }
            }
            fputcsv(
                $output,
                array(
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
                        $output,
                        array(
                            'Uralensis NO' => !empty($row['serial_number']) ? $row['serial_number'] : '',
                            'Date Taken' => !empty($row['date_taken']) ? $row['date_taken'] : '',
                            'Lab Number' => !empty($row['lab_number']) ? $row['lab_number'] : '',
                            'Patient Name' => !empty($patinet_name) ? $patinet_name : '',
                            'Sex' => !empty($row['gender']) ? $row['gender'] : '',
                            'Date of Birth' => !empty($row['dob']) ? $row['dob'] : '',
                            'NHS Number' => !empty($row['nhs_number']) ? $row['nhs_number'] : '',
                            'Emis Number' => !empty($row['emis_number']) ? $row['emis_number'] : '',
                            'D. Received Lab' => !empty($row['date_received_bylab']) ? $row['date_received_bylab'] : '',
                            'D. Received By Doctor' => !empty($row['date_rec_by_doctor']) ? $row['date_rec_by_doctor'] : '',
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
                    $old_comments = '';
                    if (!empty($row['comment_section'])) {
                        $old_comments = $row['comment_section'];
                    }
                    if (!empty($specimens)) {
                        foreach ($specimens as $spec) {
                            $snomed_t = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_t']));
                            $snomed_p = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_p']));
                            $snomed_m = strtoupper(str_replace(',', ' | ', $spec['specimen_snomed_m']));
                            $microscopy = $spec['specimen_microscopic_description'];
                            $macroscopy = $spec['specimen_macroscopic_description'];
                            $comments = '';
                            $notes = '';
                            if (!empty($_GET['specimen_comment_section'])) {
                                $comments = $spec['specimen_comment_section'];
                            }
                            if (!empty($_GET['specimen_special_notes'])) {
                                $notes = $spec['specimen_special_notes'];
                            }
                            fputcsv(
                                $output,
                                array(
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
                                    '',
                                    'Diagnosis' => !empty($_GET['speci_diagnosis']) && !empty($spec['specimen_diagnosis_description']) ? $spec['specimen_diagnosis_description'] : '',
                                    'Snomed T' => !empty($_GET['speci_snomed_t']) && !empty($snomed_t) ? $snomed_t : '',
                                    'Snomed P' => !empty($_GET['speci_snomed_p']) && !empty($snomed_p) ? $snomed_p : '',
                                    'Snomed M' => !empty($_GET['speci_snomed_m']) && !empty($snomed_m) ? $snomed_m : '',
                                    'Microscopy' => !empty($_GET['specimen_microscopy']) && !empty($microscopy) ? $microscopy : '',
                                    'Macroscopy' => !empty($_GET['specimen_macroscopy']) && !empty($macroscopy) ? $macroscopy : '',
                                    'Old Comments' => $comments,
                                    'Comments' => $old_comments,
                                    'Notes' => $notes,
                                )
                            );
                        }
                    }
                }
            }
        }
    }

    /**
     * Get specimen snomed data
     *
     * @param int $record_id
     * @return array
     */
    public function get_specimen_snomed($record_id)
    {
        if (isset($record_id)) {
            $query2 = $this->db->query("SELECT specimen.specimen_snomed_t,
            specimen.specimen_snomed_p, specimen.specimen_snomed_m,
            specimen.specimen_diagnosis_description
            FROM request
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
     * Add specimen data from admin side
     *
     * @param int $specimen_request_id
     */
    public function add_specimen_admin($specimen_request_id)
    {
        $session_data_specimen = array(
            'specimen_request_id' => $specimen_request_id
        );
        $this->session->set_userdata($session_data_specimen);
        $specimen = array(
            'request_id' => $specimen_request_id,
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
        $this->Admin_model->insert_specimen_admin($specimen);
        $this->Admin_model->admin_request_specimen_add();
        $specimen_message = '<p class="bg-info" style="padding:7px;">Specimen Added.</p>';
        $this->session->set_flashdata('specimen_added', $specimen_message);
        $current_year = date('Y');
        redirect('/Admin/display_all/' . $current_year . '/recent');
    }

    /**
     * Delete admin specimen
     *
     * @param int $specimen_id
     */
    public function delete_admin_specimen($specimen_id)
    {
        $this->db->query("DELETE FROM request_specimen WHERE rs_specimen_id = $specimen_id");
        $this->db->query("DELETE FROM specimen WHERE specimen_id = $specimen_id");
        $specimen_delete_message = '<p class="bg-danger" style="padding:7px;">Specimen Delete.</p>';
        $this->session->set_flashdata('specimen_deleted', $specimen_delete_message);
        $current_year = date('Y');
        redirect('/Admin/display_all/' . $current_year . '/recent');
    }

    /**
     * Display record detail
     *
     */
    public function show_record_detail()
    {
        $users_detail_data['show_users_query'] = $this->Admin_model->get_show_users_detail();
        $this->load->view('templates/header-new');
        $this->load->view('display/show_detail', $users_detail_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Unpublish records
     *
     * @param int $id
     */
    public function unpublish_record($id)
    {
        $unpublish_record_id = $id;
        $user_id = $this->ion_auth->user()->row()->id;
        $this->db->query("UPDATE request SET specimen_publish_status = 0 WHERE uralensis_request_id = $unpublish_record_id");
        //Save UnPublish data in record history table
        $history_data = array(
            'rec_history_user_id' => $user_id,
            'rec_history_record_id' => $unpublish_record_id,
            'rec_history_data' => '',
            'rec_history_status' => 'unpublish',
            'timestamp' => time()
        );
        $this->db->insert('uralensis_record_history', $history_data);
        $record_unpublish_message = '<p class="bg-success" style="padding:7px;">Your Record Has Been Successfully Un-Published.</p>';
        $this->session->set_flashdata('unpublish_record_message', $record_unpublish_message);
        $current_year = date('Y');
        redirect('/Admin/display_all/' . $current_year . '/recent');
    }

    /**
     * Change account status
     *
     * @param int $account_id
     */
    public function change_account_status($account_id)
    {
        if (isset($account_id) && !empty($account_id)) {
            if (isset($_POST['account_lock_status']) && $_POST['account_lock_status'] == 'lock') {
                $this->db->query("UPDATE users SET active = 0 WHERE id = $account_id");
                $account_lock_status = '<p class="bg-success" style="padding:7px;">Account Successfully Locked.</p>';
                $this->session->set_flashdata('account_lock_status', $account_lock_status);
                redirect('/Admin/show_record_detail');
            } else {
                $this->db->query("UPDATE users SET active = 1 WHERE id = $account_id");
                $account_unlock_status = '<p class="bg-success" style="padding:7px;">Account Successfully Un-Locked.</p>';
                $this->session->set_flashdata('account_unlock_status', $account_unlock_status);
                redirect('/Admin/show_record_detail');
            }
        }
    }

    /**
     * Upload Center view
     *
     */
    public function upload_center()
    {
        $request_form['requestforms'] = $this->Admin_model->get_upc_requestforms();
        $checklist_form['checlistforms'] = $this->Admin_model->get_upc_checklistforms();
        $upc_files_data = array_merge($request_form, $checklist_form);
        $this->load->view('templates/header-new');
        $this->load->view('display/doc_uplaod_center', $upc_files_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Upload center request form
     *
     */
    public function upload_center_request_form()
    {
        $admin_user_id = $this->ion_auth->user()->row()->id;
        if (isset($admin_user_id) && !empty($admin_user_id)) {
            $config['upload_path'] = './uplaod_center/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('upload_center_requestform')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('upload_error', $error['error']);
                redirect('admin/upload_center/', 'refresh');
            } else {
                $data = $this->upload->data();
                $this->Admin_model->upload_center_form_model(
                    $data['file_name'],
                    $data['raw_name'],
                    $data['full_path'],
                    $data['file_ext'],
                    $data['is_image'],
                    $_POST['request_form'],
                    'rf',
                    $admin_user_id
                );
                $uplaod_success = '<p class="bg-success" style="padding:7px;">' . $_POST['request_form'] . ' Successfully Uploaded.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_success);
                redirect('admin/upload_center/', 'refresh');
            }
        }
    }

    /**
     * Upload center checklist form
     *
     */
    public function upload_center_checklist_form()
    {
        $admin_user_id = $this->ion_auth->user()->row()->id;
        if (isset($admin_user_id) && !empty($admin_user_id)) {
            $config['upload_path'] = './uplaod_center/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('upload_center_checklist')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('upload_error', $error['error']);
                redirect('admin/upload_center/', 'refresh');
            } else {
                $data = $this->upload->data();
                $this->Admin_model->upload_center_form_model(
                    $data['file_name'],
                    $data['raw_name'],
                    $data['full_path'],
                    $data['file_ext'],
                    $data['is_image'],
                    $_POST['checklist_form'],
                    'cf',
                    $admin_user_id
                );
                $uplaod_success = '<p class="bg-success" style="padding:7px;">' . $_POST['checklist_form'] . ' Successfully Uploaded.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_success);
                redirect('admin/upload_center/', 'refresh');
            }
        }
    }

    /**
     * Delete upload center files
     *
     * @param int $files_id
     */
    public function delete_upc_files($files_id)
    {
        $this->db->query("DELETE FROM uralensis_uplaod_center_assigns WHERE upload_file_id = $files_id");
        $this->db->query("DELETE FROM uralensis_uplaod_center WHERE upc_file_id = $files_id");
        redirect('admin/upload_center/', 'refresh');
    }

    /**
     * Assign upload center request form
     *
     */
    public function assign_upc_files_rf()
    {
        if (isset($_POST)) {
            $hospital_id = $_POST['assignee_list_rf'];
            $first_name = $this->ion_auth->user($hospital_id)->row()->first_name;
            $last_name = $this->ion_auth->user($hospital_id)->row()->last_name;
            $data = array(
                'upload_file_id' => $_POST['upc_file_id_rf'],
                'upc_assignee_id' => $_POST['assignee_list_rf'],
                'upc_assignee_name' => $first_name . ' ' . $last_name,
                'upc_file_type' => $_POST['upc_file_type_code_rf'],
                'upc_assign_status' => 'true'
            );
            $this->db->insert('uralensis_uplaod_center_assigns', $data);
            $upc_file_id = $_POST['upc_file_id_rf'];
            $data_upc_status = array(
                'upc_file_status' => 1,
                'upc_file_assignee_name' => $first_name . ' ' . $last_name
            );
            $this->db->where('upc_file_id', $upc_file_id);
            $this->db->update('uralensis_uplaod_center', $data_upc_status);
            $rf_assign_status = '<p class="bg-success" style="padding:7px;">File Successfully Assigned.</p>';
            $this->session->set_flashdata('rf_assign_status', $rf_assign_status);
            redirect('admin/upload_center/', 'refresh');
        }
    }

    /**
     * Upload center checklist form
     *
     */
    public function assign_upc_files_cf()
    {
        if (isset($_POST)) {
            $hospital_id = $_POST['assignee_list_cf'];
            $first_name = $this->ion_auth->user($hospital_id)->row()->first_name;
            $last_name = $this->ion_auth->user($hospital_id)->row()->last_name;
            $data = array(
                'upload_file_id' => $_POST['upc_file_id_cf'],
                'upc_assignee_id' => $_POST['assignee_list_cf'],
                'upc_assignee_name' => $first_name . ' ' . $last_name,
                'upc_file_type' => $_POST['upc_file_type_code_cf'],
                'upc_assign_status' => 'true'
            );
            $this->db->insert('uralensis_uplaod_center_assigns', $data);
            $upc_file_id = $_POST['upc_file_id_cf'];
            $data_upc_status = array(
                'upc_file_status' => 1,
                'upc_file_assignee_name' => $first_name . ' ' . $last_name
            );
            $this->db->where('upc_file_id', $upc_file_id);
            $this->db->update('uralensis_uplaod_center', $data_upc_status);
            $cf_assign_status = '<p class="bg-success" style="padding:7px;">File Successfully Assigned.</p>';
            $this->session->set_flashdata('cf_assign_status', $cf_assign_status);
            redirect('admin/upload_center/', 'refresh');
        }
    }

    /**
     * Delete record and its relations
     * from different tables
     *
     * @param int $record_id
     * @param string $del_type
     */
    public function delete_admin_side_record($record_id, $del_type = '')
    {
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
        if (!empty($del_type) && $del_type === 'track_del') 
		{
            redirect('admin/search_tracking/central_admin', 'refresh');
        } else {
            redirect('admin/display_all/' . $current_date_year . '/recent', 'refresh');
        }
    }

    /**
     * New General setting view
     *
     */
    public function new_general_settings()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/admin_general_settings-new', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * MDT data
     *
     */
    public function mdtdata()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/adminaddmdt', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add hospital Clinician
     *
     */
    public function add_hospital_clinician()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_hospital_clinician', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add dermatological Surgeon
     *
     */
    public function add_dermatological_surgeon()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();

        $clinican['clinican'] = $this->Admin_model->get_clinic();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by,
            $clinican
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_dermatological_surgeon', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add TAT Settings
     *
     */
    public function tat_settings()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/tat_settings', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add published the password
     *
     */
    public function publish_report_password()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/publish_report_password', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add MDT tech cats
     *
     */
    public function add_teach_mdt_cats_main()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_teach_mdt_cats', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function add_sec_assign()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_sec_assign', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function add_lab_names_main()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_lab_names', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function add_microscopic_codes_main()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_microscopic_codes', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function add_snomed_codes()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_snomed_codes', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function add_datasets()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/add_datasets', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function specimen_accepted_by()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/specimen_accepted_by', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function specimen_labeled_by()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/specimen_labeled_by', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function specimen_assisted_by()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/specimen_assisted_by', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function specimen_cutup_by()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/specimen_cutup_by', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function specimen_blockchecked_by()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/specimen_blockchecked_by', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * Add sectary assignments
     *
     */
    public function specimen_qcd_by()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/set-header-new');
        $this->load->view('display/specimen_qcd_by', $merge_data);
        $this->load->view('templates/set-footer-new');
    }

    /**
     * General setting view
     *
     */
    public function general_settings()
    {
        //Put User table query on general settings page.
        $user_details['doc_users_table_query'] = $this->Admin_model->get_all_doctor_users_detail();
        $secretary_details['secretary_detail'] = $this->Admin_model->get_all_secretary_users_detail();
        $list_tech_mdt_cats['list_cats'] = $this->Admin_model->display_teach_mdt_cats();
        $tech_mdt_cats_tree['tech_mdt_tree'] = $this->Admin_model->categoryParentChildTree();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $doc_and_sec['doc_sec_list'] = $this->Admin_model->get_doc_sec_list();
        $micro_code['micro_codes'] = $this->Admin_model->get_all_microscopic_codes();
        $mdt_lists['mdt_lists'] = $this->Admin_model->get_all_mdt_list_names();
        $display_lab_data['lab_name_record'] = $this->db->query("SELECT * FROM lab_names")->result();
        $datasets_data['datasets'] = $this->Admin_model->get_datasets_data();
        $specimen_accepted_by['specimen_accepted_by'] = $this->Admin_model->get_specimen_data('specimen_accepted_by');
        $specimen_assisted_by['specimen_assisted_by'] = $this->Admin_model->get_specimen_data('specimen_assisted_by');
        $specimen_block_checked_by['specimen_block_checked_by'] = $this->Admin_model->get_specimen_data('specimen_block_checked_by');
        $specimen_cutup_by['specimen_cutup_by'] = $this->Admin_model->get_specimen_data('specimen_cutup_by');
        $specimen_labeled_by['specimen_labeled_by'] = $this->Admin_model->get_specimen_data('specimen_labeled_by');
        $specimen_qcd_by['specimen_qcd_by'] = $this->Admin_model->get_specimen_data('specimen_qcd_by');
        $merge_data = array_merge(
            $list_tech_mdt_cats,
            $user_details,
            $tech_mdt_cats_tree,
            $hospitals,
            $secretary_details,
            $doc_and_sec,
            $micro_code,
            $mdt_lists,
            $display_lab_data,
            $datasets_data,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        $this->load->view('templates/header-new');
        $this->load->view('display/admin_general_settings', $merge_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Change Doctor publish record password
     *
     */
    public function change_publish_record_password()
    {
        if (isset($_POST) && is_array($_POST) && $_POST['doctors_list'] != 0 && $_POST['doctor_publish_password'] != '') {
            $json = array();
            $doctor_id = $_POST['doctors_list'];
            $publish_pass = $_POST['doctor_publish_password'];
            $data = array(
                'user_auth_pass' => $publish_pass
            );
            $this->db->where('id', $doctor_id);
            $this->db->update('users', $data);
            if ($this->db->affected_rows() == 1) {
                $json['type'] = 'success';
                $json['msg'] = '<div class="bg-success" style="padding:6px;">Password Successfully Changed</div>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="bg-danger" style="padding:6px;">Something wrong. Please update the password.</div>';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="bg-danger" style="padding:6px;">Fields Are Missing. Or Choose the doctor from the list.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * This function wil add the records.
     * And Assign the records to corresponding hospitals Account.
     *
     */
    public function show_form()
    {
        $this->load->view('templates/header-new');
        $this->load->view('display/admin_add_records');
        $this->load->view('templates/footer-new');
    }

    /**
     * Admin add record function
     *
     */
    public function add_record()
    {
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
            //Check from database if lab number already exists.
            $rec_last_insert_id = $this->session->userdata('record_id');
            $lab_number = $this->input->post('lab_number');
            if (!empty($rec_last_insert_id)) {
                $check_lab_no = $this->db->query("SELECT request.lab_number FROM request WHERE request.uralensis_request_id = $rec_last_insert_id")->result_array();
                //Check if lab number match then redirect to form page.
                if (($lab_number == 'U') ||
                    ($lab_number == 'S') ||
                    ($lab_number == 'H') &&
                    (strlen($lab_number) == 1)
                ) {
                    //return true;
                } else if (!empty($check_lab_no[0]['lab_number']) && $check_lab_no[0]['lab_number'] === $lab_number) {
                    $msg = '<p class="bg-danger" style="padding: 7px;">The lab number you have entered is already exists.</p>';
                    $this->session->set_flashdata('record_add_msg', $msg);
                    redirect('admin/show_form');
                }
            }
            $request = array(
                'serial_number' => $key,
                'record_batch_id' => $this->input->post('admin_choose_batch'),
                'emis_number' => $this->input->post('emis_number'),
                'patient_initial' => $this->input->post('patient_initial'),
                'pci_number' => $this->input->post('pci_no'),
                'nhs_number' => str_replace('_', '', $this->input->post('nhs_number')),
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
                'report_urgency' => $this->input->post('report_urgency'),
                'cl_detail' => $this->input->post('cl_detail'),
                'status' => 0,
                'cases_category' => $this->input->post('cases_category'),
                'clinic_ref_number' => $this->input->post('clinic_reference_id'),
                'clinic_request_form' => $this->input->post('request_form'),
                'request_code_status' => 'new',
                'record_edit_status' => serialize($record_edit_status)
            );
            $session_data_hospital = array(
                'hospital_id' => $_POST['hospital_user']
            );
            $this->session->set_userdata($session_data_hospital);
            $this->Admin_model->institute_insert($request);
            $this->Admin_model->request_assign();
            // Check if user enter the pci number to save
            if (!empty($this->input->post('pci_no'))) {
                $record_id = $this->session->userdata('record_id');
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('request_code_status' => 'pci_added'));
            }
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
            $user_id = $this->ion_auth->user()->row()->id;
            $user_add_data = array(
                'request_add_user' => $user_id,
                'request_add_user_timestamp' => time()
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $user_add_data);
            $record_history_data = array(
                'emis_number' => 'no',
                'patient_initial' => 'no',
                'pci_number' => 'no',
                'nhs_number' => 'no',
                'lab_number' => 'no',
                'sur_name' => 'no',
                'f_name' => 'no',
                'dob' => 'no',
                'lab_name' => 'no',
                'date_received_bylab' => 'no',
                'date_sent_touralensis' => 'no',
                'gender' => 'no',
                'clrk' => 'no',
                'dermatological_surgeon' => 'no',
                'date_taken' => 'no',
                'report_urgency' => 'no',
                'cl_detail' => 'no',
                'cases_category' => 'no',
                'clinic_ref_number' => 'no',
                'clinic_request_form' => 'no',
            );
            $record_history = array(
                'rec_history_record_id' => $record_id,
                'rec_history_user_id' => $user_id,
                'rec_history_data' => serialize($record_history_data),
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_history', $record_history);
            $msg = '<p class="bg-info" style="padding: 7px;">Request Submitted, Please Add Specimen Below.</p>';
            $this->session->set_flashdata('record_add_msg', $msg);
            redirect('admin/show_specimen');
        }
    }

    /**
     * Show specimen
     *
     */
    public function show_specimen()
    {
        $hospital_id_user_request = $this->session->userdata('hospital_id');
        $hospital_user_request_group_id = $this->ion_auth->get_users_groups($hospital_id_user_request)->row()->id;
        $get_cost_codes['cost_codes'] = $this->Admin_model->get_cost_codes($hospital_user_request_group_id);
        $this->load->view('templates/header-new');
        $this->load->view('display/admin_add_specimen', $get_cost_codes);
        $this->load->view('templates/footer-new');
    }

    /**
     * Add specimen function
     *
     */
    public function add_specimen()
    {
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
        $this->Admin_model->insert_specimen($specimen);
        $this->Admin_model->request_specimen_add();
        $specimen_message = '<p class="bg-info" style="padding:7px;">Specimen Successfully Added. If you want to add more specimen please add it with same way. After adding click on Finish Button.</p>';
        $this->session->set_flashdata('specimen_add_msg', $specimen_message);
        redirect('admin/show_specimen');
    }

    /**
     * List Auto Populated Cinician
     *
     */
    public function get_clinician_auto_populated()
    {
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
     */
    public function get_dermatological_surgeon_auto_populated()
    {
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
     * Save batch assign record to doctor
     *
     */
    public function save_batch_assign()
    {
        $json = array();
		
		$json['doc'] = $_POST['doctor'];		
        if ($_POST['doctor'] == 0) 
		{
            $json['type'] = 'error';
            $json['msg'] = 'Choose The Doctor First.';
            echo json_encode($json);
            die;
        }
		else if (!isset($_POST['assign_id'])) 
		{
            $json['type'] = 'error';
            $json['msg'] = 'You have not select any reocrd yet.';
            echo json_encode($json);
            die;
        } 
		else 
		{
            $record_ids = $this->input->post('assign_id');
            $doctor_id = $this->input->post('doctor');
            foreach ($record_ids as $key => $value) 
			{
                $request_assign = array(
                    'request_id' => $value,
                    'user_id' => $doctor_id
                );
                $this->db->insert("request_assignee", $request_assign);
				
                $args = array(
                    'assign_status' => 1,
                    'report_status' => 1
                );
                $this->db->where('uralensis_request_id', $value);
                $this->db->update("request", $args);
            }
            $json['type'] = 'success';
            $json['msg'] = 'Records Assigning Completed Successfully.';
            echo json_encode($json);
            die;
        }
    }
	
	 public function assign_doctor()
    {
        $json = array();
		
		$json['doc'] = $_POST['doctor'];		
        if ($_POST['doctor'] == 0) 
		{
            $json['type'] = 'error';
            $json['msg'] = 'Choose The Doctor First.';
            echo json_encode($json);
            die;
        }
		else if (!isset($_POST['assign_id'])) 
		{
            $json['type'] = 'error';
            $json['msg'] = 'You have not select any reocrd yet.';
            echo json_encode($json);
            die;
        } 
		else 
		{
            $record_ids = $this->input->post('assign_id');
			$record_ids = explode("_",$record_ids);
			$record_ids = array_unique($record_ids);
            $doctor_id = $this->input->post('doctor');
            foreach ($record_ids as $key => $value) 
			{
				if($value!=0){
                $request_assign = array(
                    'request_id' => $value,
                    'user_id' => $doctor_id
                );
                $this->db->insert("request_assignee", $request_assign);
				
                $args = array(
                    'assign_status' => 1,
                    'report_status' => 1
                );
                $this->db->where('uralensis_request_id', $value);
                $this->db->update("request", $args);
				}
            }
            $json['type'] = 'success';
            $json['msg'] = 'Records Assigning Completed Successfully.';
            echo json_encode($json);
            redirect('admin/show_finance_display');
			
        }
    }

    /**
     * Show finance report display
     *
     */
    public function show_finance_display()
    {
        $data['hospital_groups'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/finance_report', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Generate finance report
     *
     */
    public function generate_finance()
    {
        if (isset($_GET['finance_pdf'])) {
            if (isset($_GET) && $_GET['hospital_list'] > 0 && $_GET['date_to'] != '' && $_GET['date_from'] != '') {
                $group_id = $_GET['hospital_list'];
                $date_to = $_GET['date_to'];
                $date_from = $_GET['date_from'];
                $group_name = $this->ion_auth->group($group_id)->row()->description;
                $finance_data['finance_data'] = array(
                    'hospital_group_id' => $group_id,
                    'date_to' => $date_to,
                    'date_from' => $date_from,
                    'hospital_group_name' => $group_name
                );
                $this->load->view('display/generate_finance', $finance_data);
            } else {
                $search_error = '<p class="alert bg-danger">Some Thing Wrong. Try To Fill Out All Fields And Then Press Generate Report.</p>';
                $this->session->set_flashdata('finance_search_error', $search_error);
                redirect('admin/show_finance_display');
            }
        } else {
            if (isset($_GET) && $_GET['hospital_list'] > 0 && $_GET['date_to'] != '' && $_GET['date_from'] != '') {
                $group_id = $_GET['hospital_list'];
                $date_to = $_GET['date_to'];
                $date_from = $_GET['date_from'];
                $group_name = $this->ion_auth->group($group_id)->row()->description;
                $finance_data['finance_data'] = array(
                    'hospital_group_id' => $group_id,
                    'date_to' => $date_to,
                    'date_from' => $date_from,
                    'hospital_group_name' => $group_name
                );
                $this->load->view('display/generate_csv', $finance_data);
            } else {
                $search_error = '<p class="alert bg-danger">Some Thing Wrong. Try To Fill Out All Fields And Then Press Generate Report.</p>';
                $this->session->set_flashdata('finance_search_error', $search_error);
                redirect('admin/show_finance_display');
            }
        }
    }

    /**
     * Ref Generate Finanace
     *
     * @param int $record_id
     */
    public function check_specimen_blocks($record_id)
    {
        if (isset($record_id)) {
            $query2 = $this->db->query("SELECT specimen.specimen_block FROM request
                    INNER JOIN specimen
                    WHERE request.uralensis_request_id = $record_id
                    AND specimen.request_id = $record_id");
            $data = $query2->result();

            return $data[0]->specimen_block;
        }
    }

    /**
     * Ref Generate Finanace
     *
     * @param int $record_id
     */
    public function check_further_work($record_id)
    {
        if (isset($record_id)) {
            $query2 = $this->db->query("SELECT request.further_work_status FROM request
                    WHERE request.uralensis_request_id = $record_id");
            $data = $query2->result();
            if ($data[0]->further_work_status == 1) {
                return 'Yes';
            } else {
                return '';
            }
        }
    }

    /**
     * Ref Generate Finanace
     *
     * @param int $record_id
     */
    public function check_supplimentary_report($record_id)
    {
        if (isset($record_id)) {
            $query2 = $this->db->query("SELECT request.supplementary_report_status FROM request
                            WHERE request.uralensis_request_id = $record_id");
            $data = $query2->result();
            if ($data[0]->supplementary_report_status == 1) {
                return 'Yes';
            } else {
                return '';
            }
        }
    }

    /**
     * Ref Generate Finanace
     *
     */
    public function manage_cost_codes()
    {
        $hospital_list['hospital_groups'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/manage_codes', $hospital_list);
        $this->load->view('templates/footer-new');
    }

    /**
     *  Ref Generate Finanace
     *
     */
    public function save_cost_codes()
    {
        $json = array();
        if ($_POST['hospital_list'] == 0) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Select Hospital First</div>';
            echo json_encode($json);
            die;
        } else if ($_POST['service_type'] == 'null') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Service Type.</div>';
            echo json_encode($json);
            die;
        } else if ($_POST['prefix'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Prefix.</div>';
            echo json_encode($json);
            die;
        } else if ($_POST['rate'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Rate.</div>';
            echo json_encode($json);
            die;
        } else if ($_POST['cost'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Cost Rate.</div>';
            echo json_encode($json);
            die;
        } else if ($_POST['storage_price'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Storage Price.</div>';
            echo json_encode($json);
            die;
        } else if ($_POST['service_desc'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Service Description.</div>';
            echo json_encode($json);
            die;
        } else {
            $insert_cost_data = array(
                'ura_cost_code_desc' => $this->input->post('service_desc'),
                'ura_cost_code_rate' => $this->input->post('rate'),
                'ura_cost_code_price' => $this->input->post('cost'),
                'ura_cost_code_storage_price' => $this->input->post('storage_price'),
                'ura_cost_code_type' => $this->input->post('service_type'),
                'ura_cost_code_prefix' => $this->input->post('prefix'),
                'ura_cost_code_hospital_id' => $this->input->post('hospital_list')
            );
            $this->db->insert('uralensis_cost_codes', $insert_cost_data);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Cost Code Enter Successfully.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Ref Generate Finanace
     *
     */
    public function display_cost_codes()
    {
        $json = array();
        if ($_POST['hospital_group_id'] == 0) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Choose Hospital First.</div>';
            echo json_encode($json);
            die;
        } else {
            $encode_data = '';
            $hospital_group_id = $_POST['hospital_group_id'];
            $cost_codes['query_cost_codes'] = $this->Admin_model->display_cost_codes_model($hospital_group_id);
            $encode_data .= '<table class="table table-hover table-striped" id="display_cost_codes_table">';
            $encode_data .= '<tr>';
            $encode_data .= '<th style="width:65%;">Service/Sample</th>';
            $encode_data .= '<th style="width:15%;">Rate</th>';
            $encode_data .= '<th style="width:5%;">Cost</th>';
            $encode_data .= '<th style="width:5%;">Storage</th>';
            $encode_data .= '<th style="width:5%;">Type</th>';
            $encode_data .= '<th style="width:5%;">Prefix</th>';
            $encode_data .= '<th style="width:5%;">&nbsp;</th>';
            $encode_data .= '<th style="width:5%;">&nbsp;</th>';
            $encode_data .= '</tr>';
            if (!empty($cost_codes['query_cost_codes'])) {
                $modal_count = 1;
                foreach ($cost_codes['query_cost_codes'] as $cost_codes) {
                    $encode_data .= '<tr>';
                    $encode_data .= '<td>' . $cost_codes->ura_cost_code_desc . '</td>';
                    $encode_data .= '<td>' . $cost_codes->ura_cost_code_rate . '</td>';
                    $encode_data .= '<td>' . $cost_codes->ura_cost_code_price . '</td>';
                    $encode_data .= '<td>' . $cost_codes->ura_cost_code_storage_price . '</td>';
                    $encode_data .= '<td>' . $cost_codes->ura_cost_code_type . '</td>';
                    $encode_data .= '<td>' . $cost_codes->ura_cost_code_prefix . '</td>';
                    $encode_data .= '<td><a href="' . base_url('index.php/admin/edit_cost_code/?cost_code_id=' . $cost_codes->ura_cost_code_id . '&hospital_id=' . $cost_codes->ura_cost_code_hospital_id . '&code_desc=' . $cost_codes->ura_cost_code_desc . '&code_rate=' . $cost_codes->ura_cost_code_rate . '&code_price=' . $cost_codes->ura_cost_code_price . '&code_type=' . $cost_codes->ura_cost_code_type . '&code_prefix=' . $cost_codes->ura_cost_code_prefix . '&storage_price=' . $cost_codes->ura_cost_code_storage_price) . '"><img src="' . base_url('assets/img/edit.png') . '"></a></td>';
                    $encode_data .= '<td><button class="btn-link delete_cost_code" data-cost_id="' . $cost_codes->ura_cost_code_id . '"><img src="' . base_url('assets/img/delete.png') . '"></button></td>';
                    $encode_data .= '</tr>';
                }
                $encode_data .= '</table>';
                $json['type'] = 'success';
                $json['cost_data'] = $encode_data;
                $json['msg'] = '<div class="alert alert-success">Following Codes Are Listed Accroding To Selected Hospital.</div>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'not_found';
                $json['msg'] = '<div class="alert alert-danger">Record Not Found.</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Edit Cost Code Ref of finance report
     *
     */
    public function edit_cost_code()
    {
        $this->load->view('templates/header-new');
        $this->load->view('display/edit_codes');
        $this->load->view('templates/footer-new');
    }

    /**
     * Ref : edit_cost_code
     *
     */
    public function update_cose_codes()
    {
        $json = array();
        if ($_POST['service_type'] == 'null') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Service Type.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['prefix'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Prefix.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['rate'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Rate.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['cost'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Cost Rate.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['storage_price'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Storage Price.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['service_desc'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Enter The Service Description.</div>';
            echo json_encode($json);
            die;
        }
        $cost_code_id = $_POST['cost_code_id'];
        $hospital_id = $_POST['cost_code_hospital_id'];
        $code_desc = $this->input->post('service_desc');
        $code_rate = $this->input->post('rate');
        $code_price = $this->input->post('cost');
        $storage_price = $this->input->post('storage_price');
        $code_type = $this->input->post('service_type');
        $code_prefix = $this->input->post('prefix');
        $update_cost_data = array(
            'ura_cost_code_desc' => $code_desc,
            'ura_cost_code_rate' => $code_rate,
            'ura_cost_code_price' => $code_price,
            'ura_cost_code_storage_price' => $storage_price,
            'ura_cost_code_type' => $code_type,
            'ura_cost_code_prefix' => $code_prefix
        );
        $this->db->where('ura_cost_code_id', $cost_code_id);
        $this->db->update('uralensis_cost_codes', $update_cost_data);
        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Cost Code Updated Successfully, Please Wait While We Redirecting You!</div>';
        echo json_encode($json);
        die;
    }

    /**
     * Ref Generate Finanace
     *
     */
    public function delete_cost_code()
    {
        $json = array();
        if ($_POST['cost_id'] != 0) {
            $cost_code_id = $_POST['cost_id'];
            $this->db->where('ura_cost_code_id', $cost_code_id);
            $this->db->delete('uralensis_cost_codes');
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Record Deleted.</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Something Wrong.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find Macthing Records Based On NHS Number
     *
     */
    public function find_matching_records()
    {
        $json = array();
        if (!empty($_POST['nhs_number']) && intval($_POST['nhs_number'])) {
            $nhs_number = $this->input->post('nhs_number');
            $match_record['find_match_record'] = $this->Admin_model->find_matching_records_model($nhs_number);
            echo json_encode($match_record);
            die;
        }
    }

    /**
     * Reports Landing Page
     *
     */
    public function reports_page()
    {
        $this->load->view('templates/header-new');
        $this->load->view('display/reports_page');
        $this->load->view('templates/footer-new');
    }

    /**
     * TATScores Reports
     *
     */
    public function tatscores_reports()
    {
        require_once('application/views/display/report_tats.php');
        $hospital_list['hospital_groups'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/tatscores_reports', $hospital_list);
        $this->load->view('templates/footer-new');
    }

    /**
     * Generate FW Reprot
     *
     */
    public function generate_fw_reprot()
    {
        $fw_data['csv_data'] = array(
            'group_id' => $_POST['hospital_list']
        );
        if (isset($_POST['fw_report_csv']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/fw_report_csv', $fw_data);
        } else if (isset($_POST['fw_report_pdf']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/fw_report_pdf', $fw_data);
        } else {
            $search_error = '<p class="alert alert-danger">Please Select Hospital First</p>';
            $this->session->set_flashdata('fw_search_error', $search_error);
            redirect('admin/tatscores_reports');
        }
    }

    /**
     * Generate IMF report
     *
     */
    public function generate_imf_reprot()
    {
        $fw_data['csv_data'] = array(
            'group_id' => $_POST['hospital_list']
        );
        if (isset($_POST['imf_report_csv']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/imf_report_csv', $fw_data);
        } else if (isset($_POST['imf_report_pdf']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/imf_report_pdf', $fw_data);
        } else {
            $search_error = '<p class="alert alert-danger">Please Select Hospital First</p>';
            $this->session->set_flashdata('imf_search_error', $search_error);
            redirect('admin/tatscores_reports');
        }
    }

    /**
     * Generate TAT 10
     *
     */
    public function generate_tat10()
    {
        //var_dump( $_POST['hospital_list']);exit;
        $fw_data['csv_data'] = array(
            'group_id' => $_POST['hospital_list']
        );
        //var_dump($fw_data);exit;
        if (isset($_POST['tat10_csv']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/tat10_report_csv', $fw_data);
        } else if (isset($_POST['tat10_pdf']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/tat10_report_pdf', $fw_data);
        } else {
            $search_error = '<p class="alert alert-danger">Please Select Hospital First</p>';
            $this->session->set_flashdata('imf_search_error', $search_error);
            redirect('admin/tatscores_reports');
        }
    }

    /**
     * Generate TAT 2W
     *
     */
    public function generate_tat2w()
    {
        $fw_data['csv_data'] = array(
            'group_id' => $_POST['hospital_list']
        );
        if (isset($_POST['tat2w_csv']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/tat2w_report_csv', $fw_data);
        } else if (isset($_POST['tat2w_pdf']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/tat2w_report_pdf', $fw_data);
        } else {
            $search_error = '<p class="alert alert-danger">Please Select Hospital First</p>';
            $this->session->set_flashdata('imf_search_error', $search_error);
            redirect('admin/tatscores_reports');
        }
    }

    /**
     * Generate TAT 3W
     *
     */
    public function generate_tat3w()
    {
        $fw_data['csv_data'] = array(
            'group_id' => $_POST['hospital_list']
        );
        if (isset($_POST['tat3w_csv']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/tat3w_report_csv', $fw_data);
        } else if (isset($_POST['tat3w_pdf']) && $_POST['hospital_list'] != 0) {
            $this->load->view('display/reports/tat3w_report_pdf', $fw_data);
        } else {
            $search_error = '<p class="alert alert-danger">Please Select Hospital First</p>';
            $this->session->set_flashdata('imf_search_error', $search_error);
            redirect('admin/tatscores_reports');
        }
    }

    /**
     * Add Teaching and MDT Cats
     *
     */
    public function add_teach_mdt_cats()
    {
        $json = array();
        if (isset($_POST['add_tech_mdt_parent']) && $_POST['add_tech_mdt_parent'] == 'add_tech_mdt_parent') {
            if ($_POST['tech_mdt_cats'] == '') {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Please Add Parent Category Name.</div>';
                echo json_encode($json);
                die;
            } else {
                $data = array(
                    'ura_tech_mdt_cat' => $_POST['tech_mdt_cats'],
                    'ura_tech_mdt_parent' => 0
                );
                $this->db->insert('uralensis_teach_mdt_cats', $data);
                $json['type'] = 'success';
                $json['msg'] = '<div class="alert alert-success">Successfuly Added The Parent Category.</div>';
                echo json_encode($json);
                die;
            }
        } else if (isset($_POST['add_tech_mdt_child']) && $_POST['add_tech_mdt_child'] == 'add_tech_mdt_child') {
            if ($_POST['tech_mdt_parent_cat'] == 0) {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Please Select The Parent Category First.</div>';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['tech_mdt_cats_type'])) {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Please Choose The Category Type.</div>';
                echo json_encode($json);
                die;
            }
            $child_data = array(
                'parent_id' => $_POST['tech_mdt_parent_cat'],
                'level1_id' => $_POST['tech_mdt_cats_child_name'],
                'level2_id' => $_POST['tech_mdt_cats_child_name_2'],
                'level3_id' => $_POST['tech_mdt_cats_child_name_3'],
                'type' => $_POST['tech_mdt_cats_type']
            );
            $this->db->insert('tbl_teaching_cpc_category', $child_data);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Child Category Successfully Added</div>';
            echo json_encode($json);
            die;
        }
    }

    public function edit_teach_mdt_cats()
    {
        $json = array();
        if (isset($_POST['ura_tec_mdt_id']) && $_POST['edit_tech_mdt_parent'] == 'edit_tech_mdt_parent') {
            if ($_POST['ura_tec_mdt_id'] == '') {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Something went wrong, please try again.</div>';
                echo json_encode($json);
                die;
            } else {
                $data = array(
                    'ura_tech_mdt_cat' => $_POST['ura_tech_mdt_cat_edit'],
                );
                $this->db->where('ura_tec_mdt_id', $_POST['ura_tec_mdt_id']);
                $this->db->update('uralensis_teach_mdt_cats', $data);
                $json['type'] = 'success';
                $json['msg'] = '<div class="alert alert-success">Successfuly updated the Category Name.</div>';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Something went wrong, please try again.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add MDT dates
     *
     */
    public function add_mdt_dates()
    {
        $json = array();
        if (empty($_POST['mdt_date'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please Add The Date.';
            echo json_encode($json);
            die;
        }
        $hospital_id = $this->input->post('mdt_date_hospital_id');
        $mdt_date = $this->input->post('mdt_date');
        $check_mdt_date = strtotime(date('Y-m-d', strtotime($mdt_date)));
        $mdt_categories = $this->input->post('mdt_category');
        $check_mdt_date_query = $this->db->select('*')->where('ura_mdt_timestamp', $check_mdt_date)->where('ura_mdt_hospital_id', $hospital_id)->get('uralensis_mdt_dates');
        if ($check_mdt_date_query->num_rows() > 0) {
            $mdt_date_result = $check_mdt_date_query->row_array();
            $update_array = array(
                'ura_mdt_date' => $mdt_date,
                'ura_mdt_timestamp' => $check_mdt_date
            );
            $this->db->where('ura_mdt_date_id', $mdt_date_result['ura_mdt_date_id'])->where('ura_mdt_hospital_id', $hospital_id)->update('uralensis_mdt_dates', $update_array);
            if (!empty($mdt_categories) && is_array($mdt_categories)) {
                $this->db->where('ura_mdt_date_id', $mdt_date_result['ura_mdt_date_id'])->delete('uralensis_mdt_date_categories');
                foreach ($mdt_categories as $mdt_cat_key => $mdt_cat_val) {
                    $this->db->insert('uralensis_mdt_date_categories', array('ura_mdt_date_id' => $mdt_date_result['ura_mdt_date_id'], 'ura_mdt_category_id' => $mdt_cat_val, 'timestamp' => time()));
                }
            }
            $json['type'] = 'success';
            $json['msg'] = 'MDT Date Updated Successfully';
            echo json_encode($json);
            die;
        } else {
            $change_mdt_date = date('Y-m-d', strtotime($mdt_date));
            $data = array(
                'ura_mdt_hospital_id' => $this->input->post('mdt_date_hospital_id'),
                'ura_mdt_date' => $this->input->post('mdt_date'),
                'ura_mdt_timestamp' => strtotime($change_mdt_date)
            );
            $this->db->insert('uralensis_mdt_dates', $data);
            //Last Insert ID
            $insert_id = $this->db->insert_id();
            // Insert Data into pivot table
            if (!empty($mdt_categories) && is_array($mdt_categories)) {
                foreach ($mdt_categories as $mdt_cat_key => $mdt_cat_val) {
                    $this->db->insert('uralensis_mdt_date_categories', array('ura_mdt_date_id' => $insert_id, 'ura_mdt_category_id' => $mdt_cat_val, 'timestamp' => time()));
                }
            }
            $json['type'] = 'success';
            $json['msg'] = 'MDT Date Successfully Added.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find MDT Dates
     *
     */
    public function find_mdt_dates()
    {
        $json = array();
        $encode = '';
        if (empty($_POST['hospital_id'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong.';
            echo json_encode($json);
            die;
        } else {
            $hospital_id = $this->input->post('hospital_id');
            $mdt_result = $this->db->select('*')->where('ura_mdt_hospital_id', $hospital_id)->order_by('ura_mdt_date', 'asc')->get('uralensis_mdt_dates')->result_array();
            if (!empty($mdt_result)) {
                $mdt_json_data = array();
                foreach ($mdt_result as $mst_key => $mdt_val) {
                    //Get MDT Categories Data
                    $mdt_cats = $this->db->select('ura_mdt_category_id')->where('ura_mdt_date_id', $mdt_val['ura_mdt_date_id'])->get('uralensis_mdt_date_categories')->result_array();
                    if (!empty($mdt_cats)) {
                        foreach ($mdt_cats as $mdt_cats_key => $mdt_cats_val) {
                            //Get Names Of MDT Categories
                            $mdt_cat_name = $this->db->select('mdt_cat_name')->where('mdt_cat_id', $mdt_cats_val['ura_mdt_category_id'])->get('uralensis_mdt_category')->row_array()['mdt_cat_name'];
                            $mdt_cats_names[$mdt_cats_key] = '<label class="label label-info" style="padding:10px;font-size:16px;">' . $mdt_cat_name . '</label>';
                        }
                    }
                    $get_date = date('Y-m-d', strtotime($mdt_val['ura_mdt_date']));
                    $get_time = date('H:i:s', strtotime($mdt_val['ura_mdt_date']));
                    $mdt_json_data[$mst_key]['title'] = date('Y-m-d', $mdt_val['ura_mdt_timestamp']);
                    $mdt_json_data[$mst_key]['start'] = $get_date . 'T' . $get_time;
                    $mdt_json_data[$mst_key]['mdt_hospital_title'] = 'MDT Date For ' . uralensis_get_hospital_name($mdt_val['ura_mdt_hospital_id']);
                    $mdt_json_data[$mst_key]['mdt_cats_names'] = implode(' ', $mdt_cats_names);
                }
                $json['type'] = 'success';
                $json['mdt_json'] = $mdt_json_data;
                $json['msg'] = 'MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'There Is No MDT Assign To This Hospital Yet.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Delete MDT CPC Teach Sub Cats
     *
     */
    public function delete_teach_cpc_teach()
    {
        $json = array();
        if (!empty($_POST['teachcpcid'])) {
            $teachcpc_id = $_POST['teachcpcid'];
            $this->db->query("DELETE FROM uralensis_teach_mdt_cats WHERE uralensis_teach_mdt_cats.ura_tec_mdt_id = $teachcpc_id");
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Deleted Successfully!</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Something Wrong!</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete MDT dates
     *
     */
    public function delete_mdt_dates()
    {
        $json = array();
        if (!empty($_POST['mdt_date'])) {
            $mdt_id = $_POST['mdt_date'];
            $this->db->query("DELETE FROM uralensis_mdt_dates WHERE uralensis_mdt_dates.ura_mdt_date_id = $mdt_id");
            $json['type'] = 'success';
            $json['msg'] = 'MDT Date Deleted Successfully!';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Wrong!';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Message Center
     *
     */
    public function messages_center()
    {
        $admin_id = $this->ion_auth->user()->row()->id;
        $total_unread['unread'] = $this->Admin_model->get_total_unread_msg($admin_id);
        $list_all_users['list_users'] = $this->Admin_model->get_message_users($admin_id);
        $admin_sent_msg['sent_msg'] = $this->Admin_model->display_admin_msg_model($admin_id, 'sent');
        $admin_inbox_msg['inbox_msg'] = $this->Admin_model->display_admin_msg_model($admin_id, 'inbox');
        $admin_trash_msg['trash_msg'] = $this->Admin_model->display_admin_msg_model($admin_id, 'trash');
        $merge_msg_data = array_merge($total_unread, $admin_sent_msg, $admin_inbox_msg, $admin_trash_msg, $list_all_users);
        $this->load->view('templates/header-new');
        $this->load->view('display/message_center/message_center', $merge_msg_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Get Users List
     *
     */
    public function get_users_list()
    {
        $searchterm = $_GET['term'];
        $admin_id = $this->ion_auth->user()->row()->id;
        $names = array();
        $query = $this->db->query("SELECT * FROM users WHERE users.username LIKE '%$searchterm%' AND users.id != $admin_id ORDER BY users.username");
        $result = $query->result_array();
        if (!empty($result)) {
            $names = array();
            foreach ($result as $row) {
                $names[] = array('id' => $row['id'], 'username' => $row['username']);
            }
        }
        $term = trim(strip_tags($_GET['term']));
        $matches = array();
        foreach ($names as $name) {
            if (stripos($name['username'], $term) !== FALSE) {
                $name['value'] = $name['username'];
                $name['label'] = "{$name['username']}";
                $matches[] = $name;
            }
        }
        echo json_encode($matches);
        die;
    }

    /**
     * View private message
     *
     * @param int $msg_id
     */
    public function view_private_msg($msg_id)
    {
        if (!empty($msg_id)) {
            $display_msg['display_msg'] = $this->Admin_model->display_msg_model($msg_id);
            $this->db->where('pmto_message', $msg_id);
            $this->db->update('privmsgs_to', array('pmto_read' => 1));
            $this->load->view('templates/header-new');
            $this->load->view('display/message_center/message_view', $display_msg);
            $this->load->view('templates/footer-new');
        }
    }

    /**
     * Insert message from admin side
     *
     */
    public function insert_pm_by_admin()
    {
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
        $admin_id = $this->ion_auth->user()->row()->id;
        $pm_data = array(
            'privmsg_subject' => $this->input->post('msg_subject'),
            'privmsg_body' => $this->input->post('msg_description'),
            'privmsg_author' => $admin_id
        );
        $this->db->insert('privmsgs', $pm_data);
        $insert_id = $this->db->insert_id();
        $pm_to_data = array(
            'pmto_message' => $insert_id,
            'pmto_recipient' => $this->input->post('list_users'),
            'pmto_read' => '0'
        );
        $this->db->insert('privmsgs_to', $pm_to_data);
        if (isset($_POST['send_mail'])) {
            $to_user_id = $this->input->post('list_users');
            $mail_to_id = $this->ion_auth->user($to_user_id)->row()->email;
            $admin_email = $this->ion_auth->user($admin_id)->row()->email;
            $subject = $this->input->post('msg_subject');
            $fname = $this->ion_auth->user($admin_id)->row()->first_name;
            $lname = $this->ion_auth->user($admin_id)->row()->last_name;
            $message = '';
            $message .= '<p>You have been received an inbox message from : ' . $fname . ' ' . $lname . '</p>';
            $message .= '<p>Please Login and go to message center from dashboard to view your message.</p>';
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($admin_email, 'Uralensis Message Notification');
            $this->email->to($mail_to_id);
            $this->email->subject('Uralensis Message Notification ' . $subject);
            $this->email->set_mailtype("html");
            $this->email->message($message);
            if ($this->email->send()) {
                $json['type'] = 'success';
                $json['msg'] = '<div class="alert alert-success">Mail and Message Successfully Send.</div>';
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
     * Admin trash message
     *
     */
    public function msg_trashinbox_admin()
    {
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
     * Message sent trash
     *
     */
    public function msg_trashsent_admin()
    {
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
     */
    public function delete_trash_admin()
    {
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
     * Get User Activity
     *
     * @param int $user_id
     */
    public function get_user_activity($user_id)
    {
        $activity['user_activity'] = $this->Admin_model->user_tracking_model($user_id);
        $this->load->view('templates/header-new');
        $this->load->view('display/track_activity/activity', $activity);
        $this->load->view('templates/footer-new');
    }

    /**
     * Assign Clinician
     *
     */
    public function assign_clinician()
    {
        $json = array();
        if ($_POST['clinician_name'] == '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Add the clinician name.';
            echo json_encode($json);
            die;
        }
        if ($_POST['hospital_id'] == 'false') {
            $json['type'] = 'error';
            $json['msg'] = 'Please select the hospital.';
            echo json_encode($json);
            die;
        }
        $clinician_name = $_POST['clinician_name'];
        $hospital_id = $_POST['hospital_id'];
        $check_clinician = $this->db->query("SELECT * FROM uralensis_clinician WHERE uralensis_clinician.clinician_name = '$clinician_name' AND uralensis_clinician.hospital_id = $hospital_id");
        $check_data = $check_clinician->result();
        if (count($check_data) == 0) {
            $data = array(
                'hospital_id' => $this->input->post('hospital_id'),
                'clinician_name' => $this->input->post('clinician_name')
            );
            $this->db->insert('uralensis_clinician', $data);
            $json['type'] = 'success';
            $json['msg'] = 'Clinician Assign Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Clinician Already Assigned.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update hospital clinician
     *
     */
    public function updateHospitalClinician()
    {
        $json = array();
        $clinician_id = $this->input->post('clinician_id');
        $clinician_text = $this->input->post('clinician_text');
        $this->db->where('clinician_id', $clinician_id)->update('uralensis_clinician', array('clinician_name' => $clinician_text));
    }

    /**
     * Search Clinician
     *
     */
    public function search_clinician()
    {
        $json = array();
        $encode = '';
        if ($_POST['hosiptal_id'] == '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please select the hospital first.';
            echo json_encode($json);
            die;
        }
        $hosiptal_id = $this->input->post('hosiptal_id');
        $sql = "SELECT * FROM uralensis_clinician AS uc WHERE uc.hospital_id = $hosiptal_id";
        $search_clinician = $this->db->query($sql)->result_array();
        if (!empty($search_clinician)) {
            $encode .= '<ul class="list-group">';
            foreach ($search_clinician as $key => $value) {
                $encode .= '<li class="list-group-item">';
                $encode .= '<span class="clinician_text">' . $value['clinician_name'] . '</span>';
                $encode .= '<a data-id="' . $value['clinician_id'] . '" href="javascript:;" class="delete-hospital-clinican"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>';
                $encode .= '<a data-id="' . $value['clinician_id'] . '" href="javascript:;" data-toggle="collapse" data-target="#edit_clinician_' . $value['clinician_id'] . '" class="edit-hospital-clinican"><i class="glyphicon glyphicon-edit pull-right" style="color: green; margin-right: 10px;"></i></a>';
                $encode .= '</li>';
                $encode .= '<div id="edit_clinician_' . $value['clinician_id'] . '" class="collapse">';
                $encode .= '<div class="form-group">';
                $encode .= '<input type="text" name="update_clinician" data-clinicianid="' . $value['clinician_id'] . '" class="form-control" value="' . $value['clinician_name'] . '">';
                $encode .= '</div>';
                $encode .= '</div>';
            }
            $encode .= '</ul>';
            $json['type'] = 'success';
            $json['encode_data'] = $encode;
            $json['msg'] = 'Clinician found successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No clinicain found in this hospital, Please add first.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete Clinican
     *
     */
    public function delete_clinician()
    {
        $json = array();
        if (isset($_POST)) {
            $record_id = $this->input->post('record_id');
            $this->db->where('clinician_id', $record_id);
            $this->db->delete('uralensis_clinician');
            $json['type'] = 'success';
            $json['msg'] = 'Clinican deleted successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while deleting this clinican.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Assign Dermatological Surgeon
     *
     */
    public function assign_dermatological_surgeon()
    {
        if ($_POST['clinician_id'] == '') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please  the Dermatological Surgeon.</div>';
            echo json_encode($json);
            die;
        }
        if ($_POST['hospital_id'] == 'false') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please select the hospital.</div>';
            echo json_encode($json);
            die;
        }
        $dermatological_surgeon_name = $_POST['clinician_id'];
        $hospital_id = $_POST['hospital_id'];
        $dermatological_surgeon = $this->db->query("SELECT * FROM uralensis_dermatological_surgeon
                                    WHERE uralensis_dermatological_surgeon.dermatological_surgeon_name = '$dermatological_surgeon_name'
                                    AND uralensis_dermatological_surgeon.hospital_id = $hospital_id");
        $check_data = $dermatological_surgeon->result();
        if (count($check_data) == 0) {
            $data = array(
                'hospital_id' => $this->input->post('hospital_id'),
                'dermatological_surgeon_name' => $this->input->post('clinician_id')
            );
            $this->db->insert('uralensis_dermatological_surgeon', $data);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Dermatological Surgeon Assign Successfully.</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-info">Dermatological Surgeon Already Assigned.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search functionality for dermatological surgeon
     *
     */
    public function searchDermatologicalSurgeon()
    {
        $json = array();
        $encode = '';
        if ($_POST['hosiptal_id'] == '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please select the hospital first.';
            echo json_encode($json);
            die;
        }
        $hosiptal_id = $this->input->post('hosiptal_id');
        $sql = "SELECT * FROM uralensis_dermatological_surgeon AS uds WHERE uds.hospital_id = $hosiptal_id";
        $search_dermatological_surgeon = $this->db->query($sql)->result_array();
        if (!empty($search_dermatological_surgeon)) {
            $encode .= '<ul class="list-group">';
            foreach ($search_dermatological_surgeon as $key => $value) {
                $encode .= '<li class="list-group-item">';
                $encode .= '<span class="dermatological_text">' . $value['dermatological_surgeon_name'] . '</span>';
                $encode .= '<a data-id="' . $value['dermatological_surgeon_id'] . '" href="javascript:;" class="delete-hospital-dermatological"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>';
                $encode .= '<a data-id="' . $value['dermatological_surgeon_id'] . '" href="javascript:;" data-toggle="collapse" data-target="#edit_dermatological_' . $value['dermatological_surgeon_id'] . '" class="edit-hospital-clinican"><i class="glyphicon glyphicon-edit pull-right" style="color: green; margin-right: 10px;"></i></a>';
                $encode .= '</li>';
                $encode .= '<div id="edit_dermatological_' . $value['dermatological_surgeon_id'] . '" class="collapse">';
                $encode .= '<div class="form-group">';
                $encode .= '<input type="text" name="update_dermatological_surgeon" data-dermatologicalsurgeonid="' . $value['dermatological_surgeon_id'] . '" class="form-control" value="' . $value['dermatological_surgeon_name'] . '">';
                $encode .= '</div>';
                $encode .= '</div>';
            }
            $encode .= '</ul>';
            $json['type'] = 'success';
            $json['encode_data'] = $encode;
            $json['msg'] = 'Dermatological Surgeons found successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No Dermatological Surgeon found in this hospital, Please add first.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete Dermatological Surgeon
     *
     */
    public function deleteDermatologicalSurgeo()
    {
        $json = array();
        if (isset($_POST)) {
            $record_id = $this->input->post('record_id');
            $this->db->where('dermatological_surgeon_id', $record_id);
            $this->db->delete('uralensis_dermatological_surgeon');
            $json['type'] = 'success';
            $json['msg'] = 'Dermatological Surgeon deleted successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while deleting this dermatological surgeon.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update Dermatological Surgeon
     *
     */
    public function updateDermatologicalSurgeon()
    {
        $json = array();
        $dermatological_id = $this->input->post('dermatological_id');
        $dermatological_text = $this->input->post('dermatological_text');
        $this->db->where('dermatological_surgeon_id', $dermatological_id)->update('uralensis_dermatological_surgeon', array('dermatological_surgeon_name' => $dermatological_text));
    }

    /**
     * Assign Secretary
     *
     */
    public function assign_secretary()
    {
        $json = array();
        if ($_POST['sec_doc_list'] === 'false') {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Choose The Doctor First.</div>';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['secretary'])) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Choose The Secretary.</div>';
            echo json_encode($json);
            die;
        }
        $doctor_id = $_POST['sec_doc_list'];
        if (!empty($_POST['secretary'])) {
            $encode = array();
            $counter = 0;
            foreach ($_POST['secretary'] as $key => $value) {
                $check_sec = $this->db->query("SELECT * FROM uralensis_doctor_sec_assign WHERE uralensis_doctor_sec_assign.ura_sec_id = $value AND uralensis_doctor_sec_assign.ura_doctor_id = $doctor_id");
                $result = $check_sec->result();
                if (count($result) == 0) {
                    $sec_data = array(
                        'ura_doctor_id' => $doctor_id,
                        'ura_sec_id' => $value
                    );
                    $this->db->insert('uralensis_doctor_sec_assign', $sec_data);
                    $row_id = $this->db->insert_id();
                    $doc_first = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name", "users", array("id" => $doctor_id));
                    $doc_last = getRecords("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $doctor_id));
                    $sec_first = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name", "users", array("id" => $value));
                    $sec_last = getRecords("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $value));
                    $encode[$counter][] = $doc_first[0]->first_name . ' ' . $doc_last[0]->last_name;
                    $encode[$counter][] = $sec_first[0]->first_name . ' ' . $sec_last[0]->last_name;
                    $encode[$counter][] = '<a class="delete_sec" href="javascript:void(0);" data-rowid="' . $row_id . '" data-docid="' . $doctor_id . '"><img src="' . base_url('assets/img/delete.png') . '"></a>';
                    $json['type'] = 'success';
                    $json['dynamic_data'] = $encode;
                    $json['msg'] = '<div class="alert alert-success">Assign Successfully!</div>';
                    $counter++;
                } else {
                    $json['type'] = 'error';
                    $json['msg'] = '<div class="alert alert-danger">Secretary Allready Assigned!</div>';
                }
            }
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete Secretary
     *
     */
    public function delete_secretary()
    {
        $json = array();
        $row_id = $this->input->post('delete_row_id');
        $doc_id = $this->input->post('doctor_id');
        if (!empty($row_id)) {
            $this->db->query("DELETE FROM uralensis_doctor_sec_assign
            WHERE uralensis_doctor_sec_assign.ura_doctor_id = $doc_id
            AND uralensis_doctor_sec_assign.ura_doc_sec_assign_id = $row_id");
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Delete Successfully!</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Something Wrong!</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Classification Report
     *
     */
    public function classification_reports()
    {
        $specimen_reports = array();
        if (!empty($_POST['search_specimen_cats']) && $_POST['search_specimen_cats'] === 'search_specimen_cats') {
            $hospital_id = $_POST['hospital_list'];
            $specimen_cat = $_POST['specimen_category'];
            $specimen_reports['specimen_cats_reports'] = $this->Admin_model->search_specimen_cats_reports($hospital_id, $specimen_cat);
        }
        $hospital_list['hospital_groups'] = $this->Admin_model->get_hospital_groups();
        $result = array_merge($hospital_list, $specimen_reports);
        $this->load->view('templates/header-new');
        $this->load->view('display/classification_reports', $result);
        $this->load->view('templates/footer-new');
    }

    /**
     * Save flag comments
     *
     */
    public function save_flag_comments()
    {
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
            $json['msg'] = 'Comment added Successfully.';
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
     * Set flag status
     *
     */
    public function set_flag_status()
    {
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
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                    break;
                case 'flag_blue':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                    break;
                case 'flag_black':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                    break;
                case 'flag_gray':
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
                    break;
                default:
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
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
     * Show comments box
     *
     */
    public function show_comments_box()
    {
        $json = array();
        $encode_data = '';
        if (isset($_POST) && !empty($_POST['record_id'])) {
            $user_id = $this->ion_auth->user()->row()->id;
            $record_id = $_POST['record_id'];
            $flag_data = $this->Admin_model->get_flag_commnets_record($user_id, $record_id);
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
     * Delete flag comments
     *
     */
    public function delete_flag_comments()
    {
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
     * Upload microscopic code
     *
     */
    public function upload_microscopic_csv()
    {
        $config['upload_path'] = './uplaod_center/microscopic_codes/';
        $config['allowed_types'] = 'csv';
        //Get the user name from user id
        $userid = $this->ion_auth->user()->row()->id;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_micro_csv')) {
            $error = array('msg' => '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>', 'open_collapse' => 'in');
            $this->load->view('templates/header-new');
            $this->load->view('display/admin_general_settings', $error);
            $this->load->view('templates/footer-new');
        } else {
            $data = array('upload_data' => $this->upload->data(), 'msg' => '<div class="alert alert-success">Csv File Uploaded Successfully</div>', 'open_collapse' => 'in');
            $file_name = $data['upload_data']['file_name'];
            $csv_path = 'https://admin:admin0@0@aleatha.uralensis.com/uralensis/uplaod_center/microscopic_codes/' . $file_name;
            // For localhost testing purpose
            // $csv_path = 'http://localhost/uralensis/uplaod_center/microscopic_codes/' . $file_name;
            $file = fopen($csv_path, "r");
            $flag = TRUE;
            while (($micro = fgetcsv($file)) !== FALSE) {
                if ($flag) {
                    $flag = FALSE;
                    continue;
                }
                //Ready Data For Insertion
                if (!empty($micro[0]) && !empty($micro[2])) {
                    $micro_code = !empty($micro[0]) ? $this->db->escape_str($micro[0]) : '';
                    $micro_title = !empty($micro[1]) ? $this->db->escape_str($micro[1]) : '';
                    $micro_desc = !empty($micro[2]) ? $this->db->escape_str($micro[2]) : '';
                    $micro_diagnosis = !empty($micro[3]) ? $this->db->escape_str($micro[3]) : '';
                    $snomed_t = !empty($micro[4]) ? $this->db->escape_str($micro[4]) : '';
                    $snomed_m = !empty($micro[5]) ? $this->db->escape_str($micro[5]) : '';
                    $snomed_p = !empty($micro[6]) ? $this->db->escape_str($micro[6]) : '';
                    $classifi = !empty($micro[7]) ? $this->db->escape_str($micro[7]) : '';
                    $micro_snomedtcode = strtolower(str_replace(' ', '', trim($snomed_t)));
                    $micro_snomedmcode = strtolower(str_replace(' ', '', trim($snomed_m)));
                    $micro_snomedpcode = strtolower(str_replace(' ', '', trim($snomed_p)));
                    $micro_classification = strtolower(str_replace(' ', '', trim($classifi)));
                    $micro_cancer_register = !empty($micro[8]) ? $micro[8] : '';
                    $micro_recpath_codes = !empty($micro[9]) ? $micro[9] : '';
                } else {
                    $micro_code = '';
                    $micro_title = '';
                    $micro_desc = '';
                    $micro_diagnosis = '';
                    $micro_snomedtcode = '';
                    $micro_snomedmcode = '';
                    $micro_snomedpcode = '';
                    $micro_classification = '';
                    $micro_cancer_register = '';
                    $micro_recpath_codes = '';
                }
                $timestamp = time();
                //Insert Microscopic Data Into Uralensis Microscopic Table
                $sql = "INSERT INTO `uralensis_micro_codes`
                    (`umc_code`,
                    `umc_title`,
                    `umc_micro_desc`,
                    `umc_disgnosis`,
                    `umc_snomed_t_code`,
                    `umc_snomed_m_code`,
                    `umc_snomed_p_code`,
                    `umc_classification`,
                    `umc_cancer_register`,
                    `umc_rcpath_score`,
                    `umc_added_by`,
                    `umc_status`,
                    `timestamp`)
                VALUES ('$micro_code','$micro_title','$micro_desc','$micro_diagnosis','$micro_snomedtcode','$micro_snomedmcode','$micro_snomedpcode','$micro_classification','$micro_cancer_register','$micro_recpath_codes', '$userid', 'master', '$timestamp')
                ON DUPLICATE KEY UPDATE `umc_code` = '$micro_code', `umc_title` = '$micro_title', `umc_micro_desc` = '$micro_desc', `umc_disgnosis` = '$micro_diagnosis', `umc_snomed_t_code` = '$micro_snomedtcode', `umc_snomed_m_code` = '$micro_snomedmcode', `umc_snomed_p_code` = '$micro_snomedpcode', `umc_classification` = '$micro_classification', `umc_cancer_register` = '$micro_cancer_register', `umc_rcpath_score` = '$micro_recpath_codes', `umc_added_by` = '$userid', `umc_status` = 'master', `timestamp` = '$timestamp'";
                $this->db->query($sql);
            }
            fclose($file);
            redirect('admin/general_settings', 'refresh');
        }
    }

    /**
     * Upload Snomed Codes
     *
     */
    public function uploadSnomedCodes()
    {
        $config['upload_path'] = './uplaod_center/snomed_codes/';
        $config['allowed_types'] = 'csv';
        $this->load->library('upload', $config);
        //Get the user name from user id
        $userid = $this->ion_auth->user()->row()->id;
        if (!$this->upload->do_upload('upload_snomed_csv')) 
		{
            $error = array('msg' => '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>', 'open_collapse' => 'in');
            $this->load->view('templates/header-new');
            $this->load->view('display/admin_general_settings', $error);
            $this->load->view('templates/footer-new');
        } 
		else 
		{
            $data = array('upload_data' => $this->upload->data(), 'msg' => '<div class="alert alert-success">Csv File Uploaded Successfully</div>', 'open_collapse' => 'in');
            $file_name = $data['upload_data']['file_name'];
            $csv_path = 'https://admin:admin0@0@aleatha.uralensis.com/uralensis/uplaod_center/snomed_codes/' . $file_name;
            // For localhost testing purpose
            // $csv_path = 'http://localhost/uralensis/uplaod_center/snomed_codes/' . $file_name;
            $file = fopen($csv_path, "r");
            $flag = TRUE;
            while (($snomed = fgetcsv($file)) !== FALSE) {
                if ($flag) {
                    $flag = FALSE;
                    continue;
                }
                /* Ready Data For Insertion */
                if (!empty($snomed[0]) && !empty($snomed[1]) && !empty($snomed[1])) {
                    $snomed_code = !empty($snomed[0]) ? $this->db->escape_str(strtolower(str_replace(' ', '', trim($snomed[0])))) : '';
                    $snome_code_desc = !empty($snomed[1]) ? $this->db->escape_str($snomed[1]) : '';
                    $snomed_type = !empty($snomed[2]) ? $this->db->escape_str($snomed[2]) : '';
                    $snomed_diagnosis = !empty($snomed[3]) ? $this->db->escape_str($snomed[3]) : '';
                    $rcpath_score = !empty($snomed[4]) ? $this->db->escape_str($snomed[4]) : '';
                } else {
                    $snomed_code = '';
                    $snome_code_desc = '';
                    $snomed_type = '';
                    $snomed_diagnosis = '';
                    $rcpath_score = '';
                }
                //Generate Unique Key.
                $snomed_unique = $snomed_code . $snomed_type;
                $current_time_stamp = time();
                //Insert Data Into Uralensis Snomed T1 Table
                $sql = "INSERT INTO `uralensis_snomed_codes`
                    (`usmdcode_unique`,
                    `usmdcode_code`,
                    `usmdcode_code_desc`,
                    `snomed_type`,
                    `snomed_diagnoses`,
                    `rc_path_score`,
                    `snomed_added_by`,
                    `snomed_status`,
                    `timestamp`)
                VALUES ('$snomed_unique', '$snomed_code', '$snome_code_desc', '$snomed_type', '$snomed_diagnosis', '$rcpath_score', '$userid', 'master', '$current_time_stamp')
                ON DUPLICATE KEY UPDATE `usmdcode_unique` = '$snomed_unique', `usmdcode_code` = '$snomed_code', `usmdcode_code_desc` = '$snome_code_desc', `snomed_type` = '$snomed_type', `snomed_diagnoses` = '$snomed_diagnosis', `rc_path_score` = '$rcpath_score', `snomed_added_by` = '$userid', `snomed_status` = 'master', `timestamp` = '$current_time_stamp'";
                $this->db->query($sql);
            }
            fclose($file);
            $snomed_data = array(
                'msg' => '<p class="bg-success" style="padding:7px;">Snomed Code Uploaded Successfully.</p>',
                'open_collapse' => 'true'
            );
            $this->session->set_flashdata('msg_snomed', $snomed_data);
            redirect('admin/general_settings', 'refresh');
        }
    }

    /**
     * Add Microscopic Codes Manually
     *
     */
    public function add_microscopic_codes()
    {
        $json = array();
        if (isset($_POST)) {
            $micro_code = '';
            $micro_title = '';
            $micro_desc = '';
            $micro_diagnose = '';
            $micro_sno_t_code = '';
            $micro_sno_t2_code = '';
            $micro_sno_m_code = '';
            $micro_sno_p_code = '';
            $micro_classi = '';
            $micro_canc_reg = '';
            $micro_rcpath = '';
            if (
                empty($_POST['micro_code']) ||
                empty($_POST['micro_title']) ||
                empty($_POST['micro_desc']) ||
                empty($_POST['micro_diagnose']) ||
                empty($_POST['micro_sno_t_code']) ||
                empty($_POST['micro_sno_t2_code']) ||
                empty($_POST['micro_sno_m_code']) ||
                empty($_POST['micro_sno_p_code']) ||
                empty($_POST['micro_classi']) ||
                empty($_POST['micro_canc_reg']) ||
                empty($_POST['micro_rcpath'])
            ) {
                $json['type'] = 'error';
                $json['msg'] = 'Please Fill All Fields Before Adding Code.';
                echo json_encode($json);
                die;
            } else {
                $micro_code = $this->input->post('micro_code');
                $micro_title = $this->input->post('micro_title');
                $micro_desc = $this->input->post('micro_desc');
                $micro_diagnose = $this->input->post('micro_diagnose');
                $micro_sno_t_code = strtolower(str_replace(' ', '', trim($this->input->post('micro_sno_t_code'))));
                $micro_sno_t2_code = strtolower(str_replace(' ', '', trim($this->input->post('micro_sno_t2_code'))));
                $micro_sno_m_code = strtolower(str_replace(' ', '', trim($this->input->post('micro_sno_m_code'))));
                $micro_sno_p_code = strtolower(str_replace(' ', '', trim($this->input->post('micro_sno_p_code'))));
                $micro_classi = strtolower(str_replace(' ', '', trim($this->input->post('micro_classi'))));
                $micro_canc_reg = $this->input->post('micro_canc_reg');
                $micro_rcpath = $this->input->post('micro_rcpath');
                /* Insert Microscopic Data Into Uralensis Microscopic Table */
                $sql = "INSERT INTO `uralensis_micro_codes`
                    (`umc_code`,
                    `umc_title`,
                    `umc_micro_desc`,
                    `umc_disgnosis`,
                    `umc_snomed_t_code`,
                    `umc_snomed_t2_code`,
                    `umc_snomed_m_code`,
                    `umc_snomed_p_code`,
                    `umc_classification`,
                    `umc_cancer_register`,
                    `umc_rcpath_score`)
                VALUES ('$micro_code','$micro_title','$micro_desc','$micro_diagnose','$micro_sno_t_code', '$micro_sno_t2_code', '$micro_sno_m_code','$micro_sno_p_code','$micro_classi','$micro_canc_reg','$micro_rcpath')
                ON DUPLICATE KEY UPDATE `umc_code` = '$micro_code', `umc_title` = '$micro_title', `umc_micro_desc` = '$micro_desc', `umc_disgnosis` = '$micro_diagnose', `umc_snomed_t_code` = '$micro_sno_t_code', `umc_snomed_t2_code` = '$micro_sno_t2_code', `umc_snomed_m_code` = '$micro_sno_m_code', `umc_snomed_p_code` = '$micro_sno_p_code', `umc_classification` = '$micro_classi', `umc_cancer_register` = '$micro_canc_reg', `umc_rcpath_score` = '$micro_rcpath'";
                $this->db->query($sql);
                $json['type'] = 'success';
                $json['msg'] = 'Microscopic Code Added Successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Edit Microscopic Code
     *
     * @param int $micro_id
     */
    public function edit_microscopic_code_view($micro_id)
    {
        $query = array();
        if (!empty($micro_id)) {
            $query['micro_result'] = $this->db->get_where('uralensis_micro_codes', array('umc_id' => $micro_id))->row();
        }
        $this->load->view('templates/header-new');
        $this->load->view('display/edit_microscopic_code', $query);
        $this->load->view('templates/footer-new');
    }

    /**
     * Edit Snomed Code
     *
     * @param int $snomed_id
     * @param string $snomed_type
     */
    public function editSnomedCode($snomed_id, $snomed_type)
    {
        $query = array();
        $query['snomed_result'] = $this->db->get_where('uralensis_snomed_codes', array('usmd_code_id' => $snomed_id))->row_array();
        $this->load->view('templates/header-new');
        $this->load->view('display/edit_snomed_code', $query);
        $this->load->view('templates/footer-new');
    }

    /**
     * Edit microscopic code
     *
     */
    public function edit_microscopic_code()
    {
        $json = array();
        if (isset($_POST) && !empty($_POST['micro_id'])) {
            //Prepare data array for updation
            $micro_id = $this->input->post('micro_id');
            $micro_data = array(
                'umc_code' => $this->input->post('micro_code'),
                'umc_title' => $this->input->post('micro_title'),
                'umc_micro_desc' => $this->input->post('micro_desc'),
                'umc_disgnosis' => $this->input->post('micro_diagnose'),
                'umc_snomed_t_code' => $this->input->post('micro_sno_t_code'),
                'umc_snomed_t2_code' => $this->input->post('micro_sno_t2_code'),
                'umc_snomed_m_code' => $this->input->post('micro_sno_m_code'),
                'umc_snomed_p_code' => $this->input->post('micro_sno_p_code'),
                'umc_classification' => $this->input->post('micro_classi'),
                'umc_cancer_register' => $this->input->post('micro_canc_reg'),
                'umc_rcpath_score' => $this->input->post('micro_rcpath'),
            );
            $this->db->where('umc_id', $micro_id);
            $this->db->update('uralensis_micro_codes', $micro_data);
            $json['type'] = 'success';
            $json['msg'] = 'Microscopic code Updated Successfully.';
            echo json_encode($json);
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong.';
            echo json_encode($json);
        }
    }

    /**
     * Edit Snomed Code
     *
     */
    public function updateSnomedCode()
    {
        $json = array();
        if (!empty($_POST)) {
            //Prepare data array for updation
            $snomed_id = $this->input->post('snomed_id');
            $snomed_type = $this->input->post('snomed_type');
            $snomed_diagnoses = !empty($this->input->post('snomed_code_diagnoses')) ? $this->input->post('snomed_code_diagnoses') : '';
            $rc_path_score = !empty($this->input->post('rcpath_score')) ? $this->input->post('rcpath_score') : '';
            $snomed_data = array(
                'usmdcode_code' => $this->input->post('snomed_code'),
                'usmdcode_code_desc' => $this->input->post('snomed_code_desc'),
                'snomed_diagnoses' => $snomed_diagnoses,
                'rc_path_score' => $rc_path_score
            );
            $this->db->where('usmd_code_id', $snomed_id);
            $this->db->where('snomed_type', $snomed_type);
            $this->db->update('uralensis_snomed_codes', $snomed_data);
        }
        $snomed_data = array(
            'msg' => '<p class="bg-success" style="padding:7px;">Snomed Code Updated Successfully.</p>',
            'open_collapse' => 'true'
        );
        $this->session->set_flashdata('msg_snomed', $snomed_data);
        redirect('admin/general_settings', 'refresh');
    }

    /**
     * Delete Microscopic Code
     *
     */
    public function delete_microscopic_codes()
    {
        $json = array();
        if (isset($_POST['micro_code']) && !empty($_POST['micro_code'])) {
            $micro_code = $_POST['micro_code'];
            $this->db->query("DELETE FROM uralensis_micro_codes WHERE uralensis_micro_codes.umc_code = '$micro_code'");
            $json['type'] = 'success';
            $json['msg'] = 'Code Delete Successfully';
            echo json_encode($json);
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
        }
    }

    /**
     * Delete Snomed Code
     *
     */
    public function deleteSnomedCode()
    {
        $json = array();
        if (!empty($_POST['snomed_id'])) {
            $snomed_id = $_POST['snomed_id'];
            $snomed_type = $_POST['snomed_type'];
            $this->db->query("DELETE FROM uralensis_snomed_codes WHERE uralensis_snomed_codes.usmd_code_id = '$snomed_id' AND uralensis_snomed_codes.snomed_type = '$snomed_type'");
            $json['type'] = 'success';
            $json['msg'] = 'Code Delete Successfully';
            echo json_encode($json);
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
        }
    }

    /**
     * Find lab number records
     *
     */
    public function find_lab_number_records()
    {
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
     * Assign report option to Secretary
     *
     */
    public function assign_report_option()
    {
        $json = array();
        if (isset($_POST) && !empty($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $sec_perm = $this->input->post('sec_add_report_perm');
            $this->db->where('id', $user_id);
            $this->db->update('users', array('user_sec_rec_permission' => !empty($sec_perm) ? serialize($sec_perm) : ''));
            $json['type'] = 'success';
            $json['msg'] = 'Following Selected Permissions Assign to this secretary.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Somehow Permissions did not assigned at this time.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Show Clinic Dates With Hospital List
     *
     */
    public function show_hospital_clinic_dates()
    {
        $hospital_list['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/clinic_dates/show_hospital_clinic_dates', $hospital_list);
        $this->load->view('templates/footer-new');
    }

    /**
     * Show Clinic Dates
     *
     */
    public function show_clinic_dates()
    {
        if (!empty($_GET['hospital_id']) && $_GET['hospital_id'] != 'false') {
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
                if (!empty($clinic_ref_explode[2])) {
                    $clinic_ref = (int)$clinic_ref_explode[2];
                } else {
                    $clinic_ref = (int)$clinic_ref_explode[1];
                }
                if (!empty($clinic_ref)) {
                    $ref_counter = $clinic_ref + 1;
                }
            }
            $ref_data['ref_data'] = array(
                'ref_key' => sprintf("%04d", $ref_counter)
            );
            $clinic_upcoming['clinic_upcoming'] = $this->Admin_model->get_upcoming_clinic_dates($hospital_id);
            $clinic_previous['clinic_previous'] = $this->Admin_model->get_previous_clinic_dates($hospital_id);
            $clinic_data = array_merge($ref_data, $clinic_upcoming, $clinic_previous);
            $this->load->view('templates/header-new');
            $this->load->view('display/clinic_dates/add_clinic_dates', $clinic_data);
            $this->load->view('templates/footer-new');
        } else {
            $msg = '<div class="alert alert-danger">Kindly Choose the hospital first.</div>';
            $this->session->set_flashdata('hospital_error', $msg);
            redirect('admin/show_hospital_clinic_dates', 'refresh');
        }
    }

    /**
     * Add Clinic Dates
     *
     */
    public function add_clinics_date()
    {
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
            redirect('admin/show_clinic_dates/?hospital_id=' . $hospital_id, 'refresh');
        }
    }

    /**
     * Edit Clinic Date
     *
     */
    public function edit_clinic_date()
    {
        $clinic_record_id = '';
        $hospital_id = '';
        if (isset($_GET['rec_id']) && !empty($_GET['rec_id'])) {
            $clinic_record_id = $_GET['rec_id'];
        }
        if (isset($_GET['hospital_id']) && !empty($_GET['hospital_id'])) {
            $hospital_id = $_GET['hospital_id'];
        }
        $clinic_data['clinic_data'] = $this->Admin_model->display_clinic_edit_data($clinic_record_id, $hospital_id);
        $checklist_data['checklist_data'] = $this->Admin_model->display_clinic_checklist_data($clinic_record_id);
        $request_data['request_data'] = $this->Admin_model->display_clinic_requestform_data($clinic_record_id);
        $other_data['otherdoc_data'] = $this->Admin_model->display_clinic_otherdoc_data($clinic_record_id);
        $clinic_request['request_form'] = $this->Admin_model->get_all_clinic_requests_data($hospital_id, $clinic_record_id);
        $batches_list['batches_list'] = $this->Admin_model->get_all_hospital_batches($hospital_id);
        $clinic_edit_data = array_merge($clinic_data, $checklist_data, $request_data, $other_data, $clinic_request, $batches_list);
        $this->load->view('templates/header-new');
        $this->load->view('display/clinic_dates/edit_clinic_date', $clinic_edit_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Process Edit Clinic Date
     *
     */
    public function process_edit_clinic_date()
    {
        if (isset($_POST) && !empty($_POST['save_clinic_date'])) {
            $total_patients = $this->input->post('total_patients');
            $total_samples = $this->input->post('total_samples');
            $imf_samples = $this->input->post('imf_samples');
            $batch_id = $this->input->post('clinic_batches');
            $rec_id = $this->input->post('rec_id');
            $hospital_id = $this->input->post('hospital_id');
            $ref_key = $this->input->post('ref_key');
            $clinic_edit_data = array(
                'ura_clinic_total_patients' => !empty($total_patients) ? $total_patients : '',
                'ura_clinic_total_samples' => !empty($total_samples) ? $total_samples : '',
                'ura_clinic_imf_samples' => !empty($imf_samples) ? $imf_samples : '',
                'ura_clinic_batch_id' => !empty($batch_id) ? $batch_id : '',
                'ura_clinic_edit_timestamp' => time()
            );
            $this->db->where('ura_clinic_date_id', $rec_id);
            $this->db->update('uralensis_clinic_dates', $clinic_edit_data);
        }
        if (isset($_FILES)) {
            $rec_id = $this->input->post('rec_id');
            $hospital_id = $this->input->post('hospital_id');
            $ref_key = $this->input->post('ref_key');
            //Uplaod single added other docs
            if ($_FILES['upload_other_doc']['name'] != '') {
                $upload_other_doc = $this->do_upload_clinic_files('upload_other_doc', $ref_key);
                if ($upload_other_doc == FALSE) {
                    $error = array('upload_error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_error', $error['upload_error']);
                } else {
                    $data = $this->upload->data();
                    $other_doc_file_name = $data['file_name'];
                    $other_doc_file_ext = $data['file_ext'];
                    $other_doc_file_type = $data['is_image'];
                }
            }
            //Add multiple request forms
            if ($_FILES['upload_request_form']['name'] != '') {
                $this->load->library('upload');
                if (count($_FILES['upload_request_form']['name']) == 1) {
                    $request_form = $this->do_upload_clinic_files('upload_request_form', '');
                    if ($request_form === FALSE) {
                        $error = array('upload_error' => $this->upload->display_errors());
                        $this->session->set_flashdata('upload_error', $error['upload_error']);
                    } else {
                        $data = $this->upload->data();
                        $request_form_file_name = $data['file_name'];
                        $request_form_file_ext = $data['file_ext'];
                        $request_form_file_type = $data['is_image'];
                    }
                } else {
                    $this->upload->initialize(array(
                        "allowed_types" => "gif|jpg|png|jpeg",
                        "upload_path" => "./clinic_uploads/",
                        "max_size" => 20400,
                        "overwrite" => FALSE,
                    ));
                    if ($this->upload->do_upload("upload_request_form")) {
                        $uploaded = $this->upload->data();
                        if (!empty($uploaded)) {
                            foreach ($uploaded as $data) {
                                $request_file_name = $data['file_name'];
                                $request_file_ext = $data['file_ext'];
                                $request_file_type = $data['is_image'];
                                $clinic_request_upload_data = array(
                                    'ura_clinic_request_form' => !empty($request_file_name) ? $request_file_name : '',
                                    'ura_clinic_request_ext' => !empty($request_file_ext) ? $request_file_ext : '',
                                    'ura_clinic_request_image_type' => !empty($request_file_type) ? $request_file_type : '',
                                    'ura_clinic_date_id' => $rec_id,
                                    'ura_clinic_request_timestamp' => time()
                                );
                                $this->db->insert('uralensis_clinic_date_requestform_uploads', $clinic_request_upload_data);
                            }
                        }
                    } else {
                        $error = array('upload_error' => $this->upload->display_errors());
                        $this->session->set_flashdata('upload_error', $error['upload_error']);
                    }
                }
            }
            //Add multiple checklists
            if ($_FILES['upload_checklist']['name'] != '') {
                $this->load->library('upload');
                if (count($_FILES['upload_checklist']['name']) == 1) {
                    $config['upload_path'] = './clinic_uploads/';
                    $config['allowed_types'] = 'pdf|png|jpg|docx|doc';
                    $config['max_size'] = 20400;
                    $config['overwrite'] = TRUE;
                    $new_name = '';
                    if (!empty($ref_key)) {
                        $new_name = $ref_key . '-' . $_FILES['upload_checklist']['name'][0];
                    }
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('upload_checklist')) {
                        $error = array('upload_error' => $this->upload->display_errors());
                        $this->session->set_flashdata('upload_error', $error['upload_error']);
                    } else {
                        $data = $this->upload->data();
                        $checklist_file_name = $data['file_name'];
                        $checklist_file_ext = $data['file_ext'];
                        $checklist_file_type = $data['is_image'];
                    }
                } else {
                    $number_of_files = sizeof($_FILES['upload_checklist']['tmp_name']);
                    $files = $_FILES['upload_checklist'];
                    for ($i = 0; $i < $number_of_files; $i++) {
                        if ($_FILES['upload_checklist']['error'][$i] != 0) {
                            // save the error message and return false, the validation of uploaded files failed
                            $this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');

                            return FALSE;
                        }
                    }
                    $this->load->library('upload');
                    $config['upload_path'] = './clinic_uploads/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = FALSE;
                    for ($i = 0; $i < $number_of_files; $i++) {
                        $_FILES['upload_checklist']['name'] = $ref_key . '-' . $files['name'][$i];
                        $_FILES['upload_checklist']['type'] = $files['type'][$i];
                        $_FILES['upload_checklist']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['upload_checklist']['error'] = $files['error'][$i];
                        $_FILES['upload_checklist']['size'] = $files['size'][$i];
                        $uploaded = array();
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('upload_checklist')) {
                            $uploaded[] = $this->upload->data();
                            if (!empty($uploaded)) {
                                foreach ($uploaded as $data) {
                                    $checklist_form_file_name = $data['file_name'];
                                    $checklist_form_file_ext = $data['file_ext'];
                                    $checklist_form_file_type = $data['is_image'];
                                    $clinic_checklsit_form_upload_data = array(
                                        'ura_clinic_checklist_form' => !empty($checklist_form_file_name) ? $checklist_form_file_name : '',
                                        'ura_clinic_checklist_ext' => !empty($checklist_form_file_ext) ? $checklist_form_file_ext : '',
                                        'ura_clinic_checklist_image_type' => !empty($checklist_form_file_type) ? $checklist_form_file_type : '',
                                        'ura_clinic_date_id' => $rec_id,
                                        'ura_clinic_checklist_timestamp' => time()
                                    );
                                    $this->db->insert('uralensis_clinic_date_checklist_uploads', $clinic_checklsit_form_upload_data);
                                }
                            } else {
                                $error = array('upload_error' => $this->upload->display_errors());
                                $this->session->set_flashdata('upload_error', $error['upload_error']);
                            }
                        } else {
                            $this->form_validation->set_message('fileupload_check', $this->upload->display_errors());

                            return FALSE;
                        }
                    }
                }
            }
            //Save request form data into db
            if (!empty($request_form_file_name)) {
                $request_form_upload_data = array(
                    'ura_clinic_request_form' => !empty($request_form_file_name) ? $request_form_file_name : '',
                    'ura_clinic_request_ext' => !empty($request_form_file_ext) ? $request_form_file_ext : '',
                    'ura_clinic_request_image_type' => !empty($request_form_file_type) ? $request_form_file_type : '',
                    'ura_clinic_date_id' => $rec_id,
                    'ura_clinic_request_timestamp' => time()
                );
                $this->db->insert('uralensis_clinic_date_requestform_uploads', $request_form_upload_data);
            }
            //Save checklist form data into db
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
            //Save other docs form data into db
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
        $msg = '<div class = "alert alert-success">Clinic Edit Successfully.</div>';
        $this->session->set_flashdata('clinic_edit', $msg);
        redirect('admin/edit_clinic_date/?rec_id=' . $rec_id . '&hospital_id=' . $hospital_id . '&ref_key=' . $ref_key, 'refresh');
    }

    /**
     * Upload clinic files
     *
     * @param string $clinic_filename
     * @param string $ref_key
     */
    public function do_upload_clinic_files($clinic_filename, $ref_key)
    {
        $config['upload_path'] = './clinic_uploads/';
        $config['allowed_types'] = 'pdf|png|jpg|docx|doc';
        $config['max_size'] = 20400;
        $config['overwrite'] = TRUE;
        $ref_key = '';
        if (!empty($ref_key)) {
            $new_name = $ref_key . '-' . $_FILES[$clinic_filename]['name'];
        } else {
            $new_name = $_FILES[$clinic_filename]['name'];
        }
        if ($clinic_filename === 'upload_request_form') {
            $config['file_name'] = $new_name[0];
        } else {
            $config['file_name'] = $new_name;
        }
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($clinic_filename)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Delete Clinic Date Upload Files
     *
     */
    public function delete_clinic_upload_files()
    {
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
     * Clinic Reference Auto Suggest Code
     *
     */
    public function clinic_reference_autosuggest()
    {
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
     */
    public function set_populate_request_form()
    {
        $json = array();
        if (isset($_POST) && !empty($_POST['clinic_record_id'])) {
            $clinic_record_id = $_POST['clinic_record_id'];
            $request_form = $this->Admin_model->get_request_form_records($clinic_record_id);
            if (empty($request_form)) {
                $json['type'] = 'error';
                $json['msg'] = 'No Request Form Found. Please Add First.';
                echo json_encode($json);
                die;
            } else {
                $encode_data = '';
                $encode_data .= '<div class = "form-group">';
                $encode_data .= '<label for = "request_form">Request Forms</label>';
                $encode_data .= '<select required class = "form-control" name = "request_form" id = "request_form">';
                $encode_data .= '<option value = "false">Choose Request Form</option>';
                foreach ($request_form as $requests) {
                    $encode_data .= '<option value = "' . $requests->ucd_requestform_upload_id . '">' . $requests->ura_clinic_request_form . '</option>';
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
     */
    public function delete_clinic_date()
    {
        if (isset($_GET) && !empty($_GET['rec_id']) && !empty($_GET['hospital_id'])) {
            $clinic_id = $_GET['rec_id'];
            $hospital_id = $_GET['hospital_id'];
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
            redirect('admin/show_clinic_dates/?hospital_id=' . $hospital_id, 'refresh');
        }
    }

    /**
     * Display Courier
     *
     */
    public function show_courier()
    {
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/courier/show_courier', $hospitals);
        $this->load->view('templates/footer-new');
    }

    /**
     * Add Courier
     *
     */
    public function add_courier()
    {
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
     */
    public function delete_courier()
    {
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
     */
    public function display_courier_records()
    {
        $json = array();
        $encode_data = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $couriers_records = $this->Admin_model->get_couriers_display_record($hospital_id);
            if (!empty($couriers_records)) {
                $encode_data .= '<table id = "courier_records_table" class = "table table-condensed">';
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
                    $encode_data .= '<td><a href = "javascript:;" class = "delete_courier_id" data-courierid = "' . $couriers->ura_courier_id . '"><img src = "' . base_url('assets/img/delete.png') . '"></a></td>';
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
     */
    public function generate_batch_key()
    {
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
                $batch_ref = (int)$batch_ref_explode[3];
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
                    $encode_batch .= '<div class = "form-group">';
                    $encode_batch .= '<label for = "batch_ref">Batch Reference</label>';
                    $encode_batch .= '<input class = "form-control" readonly name = "batch_ref" id = "batch_ref" value = "' . $batch_key . '">';
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
     */
    public function generate_courier_list()
    {
        $json = array();
        $encode_courier = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $courier_list = $this->db->query("SELECT * FROM uralensis_courier WHERE uralensis_courier.ura_courier_hospital_id = $hospital_id")->result();
            if (!empty($courier_list)) {
                $encode_courier .= '<div class = "form-group">';
                $encode_courier .= '<label for = "batch_courier">Courier</label>';
                $encode_courier .= '<select name = "batch_courier" id = "batch_courier" class = "form-control">';
                $encode_courier .= '<option value = "false">Choose Courier</option>';
                foreach ($courier_list as $courier) {
                    $encode_courier .= '<option value = "' . $courier->ura_courier_id . '">' . $courier->ura_courier_name . '</option>';
                }
                $encode_courier .= '</select>';
                $encode_courier .= '</div>';
                $json['type'] = 'success';
                $json['msg'] = 'Couriers Found Against  selected hospital.';
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
     */
    public function display_courier_cost_code()
    {
        $json = array();
        $encode_cost = '';
        if (isset($_POST) && $_POST['courier_id'] !== 'false') {
            $courier_id = $_POST['courier_id'];
            $courier_cost_code = $this->db->query("SELECT ura_courier_cost_code FROM uralensis_courier WHERE uralensis_courier.ura_courier_id = $courier_id")->result();
            if (!empty($courier_cost_code)) {
                $cost_code = $courier_cost_code[0]->ura_courier_cost_code;
                $encode_cost .= '<div class = "form-group">';
                $encode_cost .= '<label for = "batch_courier_code">Batch Courier Cost Code</label>';
                $encode_cost .= '<input class = "form-control" readonly name = "batch_courier_code" id = "batch_courier_code" value = "' . $cost_code . '">';
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
     */
    public function save_batch_data()
    {
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
     */
    public function display_batch_courier_records()
    {
        $json = array();
        $encode_data = '';
        if (isset($_POST) && $_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $batch_couriers_records = $this->Admin_model->get_batch_couriers_display_record($hospital_id);
            if (!empty($batch_couriers_records)) {
                $encode_data .= '<table id = "batch_courier_records_table" class = "table table-condensed">';
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
                    $encode_data .= '<td><a href = "' . base_url('index.php/admin/edit_batch?batch_id=' . $batch_rec->ura_batches_id . '&hospital_id=' . $batch_rec->ura_batch_hospital_id) . '"><img src = "' . base_url('assets/img/edit.png') . '"></a></td>';
                    $encode_data .= '<td><a href = "javascript:;" class = "delete_batch_courier_id" data-batchcourierid = "' . $batch_rec->ura_batches_id . '"><img src = "' . base_url('assets/img/delete.png') . '"></a></td>';
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
     * Get Courier Name with Courier ID
     *
     * @param int $courier_id
     */
    public function get_courier_name($courier_id)
    {
        if (!empty($courier_id)) {
            $query = $this->db->query("SELECT ura_courier_name FROM uralensis_courier WHERE uralensis_courier.ura_courier_id = $courier_id")->result();

            return $query[0]->ura_courier_name;
        }
    }

    /**
     * Delete Batch Courier
     *
     */
    public function delete_batch_courier()
    {
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
     * Edit Batch function
     *
     */
    public function edit_batch()
    {
        $batch_and_courier = array();
        if (isset($_GET) && !empty($_GET['batch_id']) && !empty($_GET['hospital_id'])) {
            $batch_id = $_GET['batch_id'];
            $batch_data['batch_data'] = $this->Admin_model->get_batch_data($batch_id);
            $hospital_id = $_GET['hospital_id'];
            $courier_list['courier_list'] = $this->db->query("SELECT * FROM uralensis_courier WHERE uralensis_courier.ura_courier_hospital_id = $hospital_id")->result();
            $clinics_list['clinics_list'] = $this->Admin_model->get_clinic_batches_list($batch_id, $hospital_id);
            $clinics_array = array();
            foreach ($clinics_list['clinics_list'] as $clinics) {
                $clinics_array[] = $clinics->ura_clinic_date_id;
            }
            $record_ids['clinic_record_ids'] = $this->get_clinic_date_records($clinics_array);
            $batch_and_courier = array_merge($batch_data, $courier_list, $clinics_list, $record_ids);
        }
        $this->load->view('templates/header-new');
        $this->load->view('display/courier/edit_batch', $batch_and_courier);
        $this->load->view('templates/footer-new');
    }

    /**
     * Get clinic date records
     *
     * @param [array] $clinics_array
     */
    public function get_clinic_date_records($clinics_array)
    {
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
     * Process Edit Batch Fields
     *
     */
    public function process_edit_batch()
    {
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
            $msg = '<div class = "alert alert-success">Batch Updated Successfully.</div>';
            $this->session->set_flashdata('batch_update', $msg);
            redirect('admin/edit_batch?batch_id = ' . $batch_id . '&hospital_id = ' . $hospital_id);
        }
    }

    /**
     * Image Uploader Function
     *
     */
    public function aleatha_image_uploader()
    {
        $json = array();
        //echo  $_SERVER['DOCUMENT_ROOT'];exit;
        $whitelist = [
            // IPv4 address
            '127.0.0.1',
            // IPv6 address
            '::1'
        ];
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            $config['upload_path'] = './uploads/';
        } else {
            $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('aleatha_image_uploader')) {
            $error = array('error' => $this->upload->display_errors());
            $json = array('success' => FALSE, 'reason' => $error);
            echo json_encode($json);
            die;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image_path = base_url() . 'uploads/' . $data['upload_data']['file_name'];
            $file_name = $data['upload_data']['file_name'];
            $updatebasic = $this->Userextramodel->UpdateUserProfile($_POST['user_id'], $image_path);
            $json = array(
                'success' => TRUE,
                'file_name' => $data['upload_data']['file_name'],
                'full_path' => $image_path,
                'document_roo' => $_SERVER['DOCUMENT_ROOT']
            );
            echo json_encode($json);
        }
    }

    /**
     * Display Doctor Invoices
     *
     */
    public function doctor_invoices_display()
    {
        $doc_list['doctor_list'] = $this->Admin_model->get_all_doctor_users_detail();
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $result = array_merge($doc_list, $hospitals);
        $this->load->view('templates/header-new');
        $this->load->view('display/doctor_invoice/display_invoices-new', $result);
        $this->load->view('templates/footer-new');
    }

    /**
     * Search Doctor Invoices
     *
     */
    public function search_doctor_invoice()
    {
        $json = array();
        if (!empty($_POST)) {
            if (empty($_POST['doctors_list'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the doctor first.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['case_cost_date_from'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the from date.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['case_cost_date_to'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the to date.';
                echo json_encode($json);
                die;
            }
            $doctor_id = $this->input->post('doctors_list');
            $date_from = $this->input->post('case_cost_date_from');
            $date_to = $this->input->post('case_cost_date_to');
            $doctor_reports = $this->Admin_model->search_doctor_invoice($doctor_id, $date_from, $date_to);
            $tat_false_array = array();
            if (!empty($doctor_reports)) {
                foreach ($doctor_reports as $key => $data) {
                    $doctor_inv_opt = $this->Admin_model->get_db_doctor_inv_opt_data($doctor_id, $data['Hospital_ID']);
                    if (!empty($doctor_inv_opt)) {
                        $inv_opt = array();
                        if (!empty($doctor_inv_opt) && !empty($doctor_inv_opt['ura_hos_opt'])) {
                            $inv_opt = unserialize($doctor_inv_opt['ura_hos_opt']);
                        }
                        if (!empty($doctor_inv_opt) && $doctor_inv_opt['ura_tat_option'] === 'false') {
                            extract($inv_opt);
                            $alopecia_cases = $data['Alopecia_Cases'];
                            $imf_cases = $data['IMF_Cases'];
                            $routine_cases = $data['Routine_Cases'];
                            $alopecia_cost = $routine_rate;
                            $imf_cost = $alopecia_rate;
                            $routine_cost = $imf_rate;
                            $alopecia_total = $alopecia_cases * $alopecia_cost;
                            $imf_total = $imf_cases * $imf_cost;
                            $routine_total = $routine_cases * $routine_cost;
                            $total_cases_cost = $alopecia_total + $imf_total + $routine_total;
                            $hospital_name = $this->ion_auth->group($data['Hospital_ID'])->row()->description;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['alopecia_cases'] = $alopecia_cases;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['alopecia_cases_cost'] = $alopecia_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['alopecia_total_cases_cost'] = $alopecia_cases * $alopecia_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['imf_cases'] = $imf_cases;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['imf_cases_cost'] = $imf_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['imf_total_cases_cost'] = $imf_cases * $imf_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['routine_cases'] = $routine_cases;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['routine_cases_cost'] = $routine_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['routine_total_cases_cost'] = $routine_cases * $routine_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['total_cases_cost'] = $total_cases_cost;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['inv_status'] = 'unpaid';
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['hospital_name'] = $hospital_name;
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['tat_value'] = 'false';
                            $tat_false_array['tat_false'][$data['Hospital_ID']]['timestamp'] = time();
                        } else {
                            $tat_db_records = $this->Admin_model->search_doctor_invoice_with_tat($doctor_id, $data['Hospital_ID'], $date_from, $date_to);
                            if (!empty($tat_db_records)) {
                                $alopecia_total = 0;
                                $imf_total = 0;
                                $routine_total = 0;
                                $alopecia_cases_count = 0;
                                $imf_cases_count = 0;
                                $routine_cases_count = 0;
                                $alopecia_1_to_3 = 0;
                                $alopecia_4_to_6 = 0;
                                $imf_1_to_3 = 0;
                                $imf_4_to_6 = 0;
                                $routine_1_to_3 = 0;
                                $routine_4_to_6 = 0;
                                $alopecia_1_to_3_cost = 0;
                                $alopecia_4_to_6_cost = 0;
                                $imf_1_to_3_cost = 0;
                                $imf_4_to_6_cost = 0;
                                $routine_1_to_3_cost = 0;
                                $routine_4_to_6_cost = 0;
                                foreach ($tat_db_records as $key => $tat_data) {
                                    $alopecia_cases = $tat_data['Alopecia_Cases'];
                                    $imf_cases = $tat_data['IMF_Cases'];
                                    $routine_cases = $tat_data['Routine_Cases'];
                                    $alopecia_1_to_3_cost = $inv_opt['tat_1_to_3']['alopecia_rate'];
                                    $alopecia_4_to_6_cost = $inv_opt['tat_4_to_6']['alopecia_rate'];
                                    if ($tat_data['Alopecia_DATE_DIFF'] <= 3) {
                                        $alopecia_per_case_cost = $tat_data['Alopecia_Cases'] * $inv_opt['tat_1_to_3']['alopecia_rate'];
                                        $alopecia_1_to_3 = $alopecia_1_to_3 + $tat_data['Alopecia_Cases'];
                                    } else {
                                        $alopecia_per_case_cost = $tat_data['Alopecia_Cases'] * $inv_opt['tat_4_to_6']['alopecia_rate'];
                                        $alopecia_4_to_6 = $alopecia_4_to_6 + $tat_data['Alopecia_Cases'];
                                    }
                                    $imf_1_to_3_cost = $inv_opt['tat_1_to_3']['imf_rate'];
                                    $imf_4_to_6_cost = $inv_opt['tat_4_to_6']['imf_rate'];
                                    if ($tat_data['IMF_DATE_DIFF'] <= 3) {
                                        $imf_per_case_cost = $tat_data['IMF_Cases'] * $inv_opt['tat_1_to_3']['imf_rate'];
                                        $imf_1_to_3 = $imf_1_to_3 + $tat_data['IMF_Cases'];
                                    } else {
                                        $imf_per_case_cost = $tat_data['IMF_Cases'] * $inv_opt['tat_4_to_6']['imf_rate'];
                                        $imf_4_to_6 = $imf_4_to_6 + $tat_data['IMF_Cases'];
                                    }
                                    $routine_1_to_3_cost = $inv_opt['tat_1_to_3']['routine_rate'];
                                    $routine_4_to_6_cost = $inv_opt['tat_4_to_6']['routine_rate'];
                                    if ($tat_data['Routine_DATE_DIFF'] <= 3) {
                                        $routine_per_case_cost = $tat_data['Routine_Cases'] * $inv_opt['tat_1_to_3']['routine_rate'];
                                        $routine_1_to_3 = $routine_1_to_3 + $tat_data['Routine_Cases'];
                                    } else {
                                        $routine_per_case_cost = $tat_data['Routine_Cases'] * $inv_opt['tat_4_to_6']['routine_rate'];
                                        $routine_4_to_6 = $routine_4_to_6 + $tat_data['Routine_Cases'];
                                    }
                                    $alopecia_cases_count = $alopecia_cases_count + intval($alopecia_cases);
                                    $imf_cases_count = $imf_cases_count + intval($imf_cases);
                                    $routine_cases_count = $routine_cases_count + intval($routine_cases);
                                    $alopecia_total = $alopecia_total + $alopecia_per_case_cost;
                                    $imf_total = $imf_total + $imf_per_case_cost;
                                    $routine_total = $routine_total + $routine_per_case_cost;
                                }
                                $total_cases_cost = $alopecia_total + $imf_total + $routine_total;
                                $hospital_name = $this->ion_auth->group($data['Hospital_ID'])->row()->description;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['alopecia_cases']['total_cases'] = $alopecia_cases_count;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['alopecia_cases']['tat_1_to_3'] = $alopecia_1_to_3;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['alopecia_cases']['tat_4_to_6'] = $alopecia_4_to_6;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['alopecia_cases']['tat_1_to_3_cost'] = $alopecia_1_to_3_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['alopecia_cases']['tat_4_to_6_cost'] = $alopecia_4_to_6_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['alopecia_cases']['total_cases_cost'] = $alopecia_total;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['imf_cases']['total_cases'] = $imf_cases_count;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['imf_cases']['tat_1_to_3'] = $imf_1_to_3;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['imf_cases']['tat_4_to_6'] = $imf_4_to_6;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['imf_cases']['tat_1_to_3_cost'] = $imf_1_to_3_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['imf_cases']['tat_4_to_6_cost'] = $imf_4_to_6_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['imf_cases']['total_cases_cost'] = $imf_total;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['routine_cases']['total_cases'] = $routine_cases_count;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['routine_cases']['tat_1_to_3'] = $routine_1_to_3;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['routine_cases']['tat_4_to_6'] = $routine_4_to_6;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['routine_cases']['tat_1_to_3_cost'] = $routine_1_to_3_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['routine_cases']['tat_4_to_6_cost'] = $routine_4_to_6_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['routine_cases']['total_cases_cost'] = $routine_total;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['total_cases_cost'] = $total_cases_cost;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['inv_status'] = 'unpaid';
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['hospital_name'] = $hospital_name;
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['tat_value'] = 'true';
                                $tat_false_array['tat_true'][$data['Hospital_ID']]['timestamp'] = time();
                            }
                        }
                    } else {
                        $group_name = $this->ion_auth->group($data['Hospital_ID'])->row()->description;
                        $json['type'] = 'error';
                        $json['msg'] = 'There seems to be more cases reported for ' . $group_name . ' which the invoice settings have not been added.';
                        echo json_encode($json);
                        die;
                    }
                }
                $ref_counter = 0001;
                $db_ref_key = '';
                $check_invoice_rec = $this->db->query("SELECT * FROM uralensis_doctor_invoice WHERE uralensis_doctor_invoice.ura_doc_id = $doctor_id ORDER BY uralensis_doctor_invoice.ura_doc_invoice DESC LIMIT 1")->row_array();
                if (!empty($check_invoice_rec['ura_invoice_no'])) {
                    $db_ref_key = $check_invoice_rec['ura_invoice_no'];
                    $inv_ref_explode = explode('-', $db_ref_key);
                    $inv_ref_data = (int)$inv_ref_explode[2];
                    if (!empty($inv_ref_data)) {
                        $ref_counter = $inv_ref_data + 1;
                    }
                }
                $ref_data = sprintf("%04d", $ref_counter);
                $invoice_no = 'UL-INV-' . $ref_data;
                if (!empty($check_invoice_rec) && $check_invoice_rec['ura_doc_date_from'] === $date_from && $check_invoice_rec['ura_doc_date_to'] === $date_to) {
                    $invoice_data_update = array(
                        'ura_invoice_data' => serialize($tat_false_array),
                        'timestamp' => time()
                    );
                    $this->db->where('ura_doc_invoice', $check_invoice_rec['ura_doc_invoice']);
                    $this->db->update('uralensis_doctor_invoice', $invoice_data_update);
                } else {
                    $invoice_data = array(
                        'ura_invoice_no' => $invoice_no,
                        'ura_doc_id' => $doctor_id,
                        'ura_doc_date_from' => $date_from,
                        'ura_doc_date_to' => $date_to,
                        'ura_invoice_data' => serialize($tat_false_array),
                        'timestamp' => time()
                    );
                    $this->db->insert('uralensis_doctor_invoice', $invoice_data);
                }
                $json['type'] = 'success';
                $json['msg'] = 'Invoice generated successfully.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Invoice Could not be generated';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Search Doctor Generated Invoices
     *
     */
    public function search_generated_invoice()
    {
        $json = array();
        $encode = '';
        if (empty($_POST['doctor_id'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please Select the doctor first.';
            echo json_encode($json);
            die;
        }
        $doctor_id = $this->input->post('doctor_id');
        $invoice_data = $this->Admin_model->display_generated_invoices($doctor_id);
        $encode .= '<table class="table table-striped" id="doctor_invoice_table">';
        $encode .= '<thead>';
        $encode .= '<tr class="bg-primary">';
        $encode .= '<th>INV No.</th>';
        $encode .= '<th>Doctor</th>';
        $encode .= '<th>Inv From</th>';
        $encode .= '<th>Inv To</th>';
        $encode .= '<th>Created</th>';
        $encode .= '<th colspan="2">Actions</th>';
        $encode .= '</tr>';
        $encode .= '</thead>';
        if (!empty($invoice_data)) {
            $encode .= '<tbody>';
            foreach ($invoice_data as $key => $value) {
                $timestamp = date('d-m-Y h:i:s A', $value['timestamp']);
                $encode .= '<tr>';
                $encode .= '<td>' . $value['ura_invoice_no'] . '</td>';
                $encode .= '<td>' . $this->get_uralensis_username($value['ura_doc_id']) . '</td>';
                $encode .= '<td>' . $value['ura_doc_date_from'] . '</td>';
                $encode .= '<td>' . $value['ura_doc_date_to'] . '</td>';
                $encode .= '<td>' . $timestamp . '</td>';
                $encode .= '<td><a href="' . base_url('index.php/admin/generate_doctor_invoice/' . $value['ura_doc_invoice']) . '"><img src="' . base_url('assets/img/view.png') . '"></a></td>';
                $encode .= '<td><a class="delete_doc_inv" data-invid="' . $value['ura_doc_invoice'] . '" href="javascript:;"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
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

    /**
     * Generate Doctor Invoice
     *
     * @param [int] $invoice_id
     */
    public function generate_doctor_invoice($invoice_id)
    {
        $doctor_invoice['doctor_invoice'] = $this->Admin_model->generated_invoices_pdf($invoice_id);
        $doctor_id = '';
        $date_from = '';
        $date_to = '';
        if (!empty($doctor_invoice['doctor_invoice'])) {
            $doctor_id = $doctor_invoice['doctor_invoice']['ura_doc_id'];
            $date_from = $doctor_invoice['doctor_invoice']['ura_doc_date_from'];
            $date_to = $doctor_invoice['doctor_invoice']['ura_doc_date_to'];
        }
        $pdf_record_summary['pdf_record_summary'] = $this->Admin_model->get_pdf_summary_records_doctor($doctor_id, $date_from, $date_to);
        $invoice_temp['invoice_temp'] = $this->Admin_model->get_doctor_invoice_template_data($doctor_id);
        $result = array_merge($doctor_invoice, $invoice_temp, $pdf_record_summary);
        $this->load->view('display/doctor_invoice/generate_doctor_pdf_invoice', $result);
    }

    /**
     * Delete Doctro Invoices
     *
     */
    public function delete_admin_doctor_invoice()
    {
        $json = array();
        if (isset($_POST)) {
            $inv_id = $this->input->post('inv_id');
            $this->db->where('ura_doc_invoice', $inv_id)->delete('uralensis_doctor_invoice');
            $json['type'] = 'success';
            $json['msg'] = 'Invoice Deleted Successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Change Invoice Status
     *
     */
    public function change_doctor_invoice_status()
    {
        $json = array();
        if (!empty($_POST['inv_id'])) {
            $inv_id = $_POST['inv_id'];
            $inv_status = $_POST['inv_status'];
            $status = 'unpaid';
            if ($inv_status == 'unpaid') {
                $status = 'paid';
            }
            $this->db->where('ura_doc_invoice', $inv_id);
            $this->db->update('uralensis_doctor_invoice', array('ura_invoice_status' => $status));
            $json['type'] = 'success';
            $json['msg'] = 'Invoice Status Changed.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Admin Inovice Display
     *
     */
    public function admin_invoices_display()
    {
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/admin_invoice/display_invoices', $hospitals);
        $this->load->view('templates/footer-new');
    }

    /**
     * Search Doctor Invoice
     *
     */
    public function search_hospital_invoice()
    {
        $json = array();
        if (!empty($_POST)) {
            if (empty($_POST['hospial_group_id'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the hospital first.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['case_cost_date_from'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the from date.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['case_cost_date_to'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the to date.';
                echo json_encode($json);
                die;
            }
            $hospial_id = $this->input->post('hospial_group_id');
            $date_from = $this->input->post('case_cost_date_from');
            $date_to = $this->input->post('case_cost_date_to');
            $hospital_reports = $this->Admin_model->search_db_hospital_invoice($hospial_id, '', $date_from, $date_to);
            $tat_false_array = array();
            $hospital_inv_opt = $this->Admin_model->get_hos_inv_opt_data($hospial_id);
            if (!empty($hospital_inv_opt)) {
                $inv_opt = array();
                if (!empty($hospital_inv_opt) && !empty($hospital_inv_opt['ura_hos_opt'])) {
                    $inv_opt = unserialize($hospital_inv_opt['ura_hos_opt']);
                }
                if ($hospital_inv_opt['ura_tat_option'] === 'false') {
                    extract($inv_opt);
                    $total_cost_code_cases = $this->get_cost_codes_total_cases($hospial_id, $cost_code_name, $date_from, $date_to);
                    $total_cost_codes_cost = $total_cost_code_cases * $cost_code_price;
                    $hospital_name = $this->ion_auth->group($hospital_inv_opt['ura_hos_id'])->row()->description;
                    $tat_false_array['tat_false']['total_cases'] = $total_cost_code_cases;
                    $tat_false_array['tat_false']['total_cost'] = $cost_code_price;
                    $tat_false_array['tat_false']['total_cases_cost'] = $total_cost_codes_cost;
                    $tat_false_array['tat_false']['inv_status'] = 'unpaid';
                    $tat_false_array['tat_false']['hospital_name'] = $hospital_name;
                    $tat_false_array['tat_false']['timestamp'] = time();
                } else {
                    $tat_db_records = $this->Admin_model->search_db_hospital_invoice_with_tat($hospial_id, $date_from, $date_to);
                    if (!empty($tat_db_records)) {
                        $below_six = FALSE;
                        $total_cases = 0;
                        $total_completed_vd_in_time_cost_codes_cases = 0;
                        foreach ($tat_db_records as $tat_check) {
                            if ($tat_check['Cost_Code_Diff'] <= 6) {
                                $below_six = TRUE;
                                $total_completed_vd_in_time_cost_codes_cases = $total_completed_vd_in_time_cost_codes_cases + 1;
                            }
                            $total_cases++;
                        }
                        $total_cases_of_90_percent = round(($total_cases / 100) * 90);
                        $total_completed_cases = $total_completed_vd_in_time_cost_codes_cases;
                        $total_percentage = ($total_completed_cases / $total_cases) * 100;
                    }
                    $cost_code_cases_count = 0;
                    $case_counter = 0;
                    $total_cases_cost = 0;
                    $tat_1_to_6_cases = 0;
                    $tat_7_to_abv_cases = 0;
                    $tat_1_to_6_cost = 0;
                    $tat_7_to_abv_cost = 0;
                    foreach ($tat_db_records as $key => $tat_data) {
                        $case_counter++;
                        $cost_code_cases = 1;
                        if ($case_counter <= $total_cases_of_90_percent) {
                            $cost_code_per_case_cost = 1 * $inv_opt[$tat_data['Cost_codes']]['tat_1_to_6']['cost_code_price'];
                            $total_cost = $cost_code_per_case_cost;
                            $total_cases_cost = $total_cases_cost + $total_cost;
                            $tat_1_to_6_cases = $tat_1_to_6_cases + $cost_code_cases;
                            $tat_1_to_6_cost = $tat_1_to_6_cost + $total_cost;
                        } else {
                            if ($total_percentage >= 90) {
                                $cost_code_per_case_cost = 1 * $inv_opt[$tat_data['Cost_codes']]['tat_1_to_6']['cost_code_price'];
                                $total_cost = $cost_code_per_case_cost;
                                $total_cases_cost = $total_cases_cost + $total_cost;
                                $tat_1_to_6_cases = $tat_1_to_6_cases + $cost_code_cases;
                                $tat_1_to_6_cost = $tat_1_to_6_cost + $total_cost;
                            } else {
                                $cost_code_per_case_cost = 1 * $inv_opt[$tat_data['Cost_codes']]['tat_7_to_above']['cost_code_price'];
                                $total_cost = $cost_code_per_case_cost;
                                $total_cases_cost = $total_cases_cost + $total_cost;
                                $tat_7_to_abv_cases = $tat_7_to_abv_cases + $cost_code_cases;
                                $tat_7_to_abv_cost = $tat_7_to_abv_cost + $total_cost;
                            }
                        }
                        $cost_code_cases_count = $cost_code_cases_count + intval($cost_code_cases);
                    }
                    $hospital_name = $this->ion_auth->group($hospial_id)->row()->description;
                    $tat_false_array['tat_true']['tat_1_to_6']['total_cases'] = $tat_1_to_6_cases;
                    $tat_false_array['tat_true']['tat_1_to_6']['case_cost_total'] = $tat_1_to_6_cost;
                    $tat_false_array['tat_true']['tat_7_to_above']['total_cases'] = $tat_7_to_abv_cases;
                    $tat_false_array['tat_true']['tat_7_to_above']['case_cost_total'] = $tat_7_to_abv_cost;
                    $tat_false_array['tat_true']['total_cases'] = $cost_code_cases_count;
                    $tat_false_array['tat_true']['total_cases_cost'] = $total_cases_cost;
                    $tat_false_array['tat_true']['inv_status'] = 'unpaid';
                    $tat_false_array['tat_true']['hospital_name'] = $hospital_name;
                    $tat_false_array['tat_true']['timestamp'] = time();
                }
                $ref_counter = 0001;
                $db_ref_key = '';
                $check_invoice_rec = $this->db->query("SELECT * FROM uralensis_hospital_invoice ORDER BY uralensis_hospital_invoice.ura_hos_invoice DESC LIMIT 1")->row_array();
                if (!empty($check_invoice_rec['ura_invoice_no'])) {
                    $db_ref_key = $check_invoice_rec['ura_invoice_no'];
                    $inv_ref_explode = explode('-', $db_ref_key);
                    $inv_ref_data = (int)$inv_ref_explode[2];
                    if (!empty($inv_ref_data)) {
                        $ref_counter = $inv_ref_data + 1;
                    }
                }
                $ref_data = sprintf("%04d", $ref_counter);
                $invoice_no = 'UL-INV-' . $ref_data;
                if (!empty($check_invoice_rec)) {
                    $inv_date_range_array = $this->createDateRange($date_from, $date_to);
                    foreach ($inv_date_range_array as $key => $value) {
                        $check_inv_date_data = $this->Admin_model->check_hos_invoice_dates_from_db($value, $hospial_id);
                        if (!empty($check_inv_date_data)) {
                            $json['type'] = 'error';
                            $json['msg'] = 'Invoice already generated.';
                            echo json_encode($json);
                            die;
                        } else {
                            $invoice_data = array(
                                'ura_invoice_no' => $invoice_no,
                                'ura_hos_id' => $hospial_id,
                                'ura_hos_date_from' => date('Y-m-d', strtotime($date_from)),
                                'ura_hos_date_to' => date('Y-m-d', strtotime($date_to)),
                                'ura_invoice_data' => serialize($tat_false_array),
                                'timestamp' => time()
                            );
                            $this->db->insert('uralensis_hospital_invoice', $invoice_data);
                            $json['type'] = 'success';
                            $json['msg'] = 'Invoice generated successfully.';
                            echo json_encode($json);
                            die;
                        }
                        break;
                    }
                } else {
                    $invoice_data = array(
                        'ura_invoice_no' => $invoice_no,
                        'ura_hos_id' => $hospial_id,
                        'ura_hos_date_from' => date('Y-m-d', strtotime($date_from)),
                        'ura_hos_date_to' => date('Y-m-d', strtotime($date_to)),
                        'ura_invoice_data' => serialize($tat_false_array),
                        'timestamp' => time()
                    );
                    $this->db->insert('uralensis_hospital_invoice', $invoice_data);
                }
                $json['type'] = 'success';
                $json['msg'] = 'Invoice generated successfully.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Invoice Could not be generated';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Get cost codes total cases
     *
     * @param int $hospital_id
     * @param string $code_name
     * @param string $date_from
     * @param string $date_to
     */
    public function get_cost_codes_total_cases($hospital_id = '', $code_name = '', $date_from = '', $date_to = '')
    {
        if (!empty($hospital_id) && !empty($code_name)) {
            return $this->Admin_model->search_db_hospital_invoice($hospital_id, $code_name, $date_from, $date_to)['Total_Cases'];
        }
    }

    /**
     * Create date range function
     *
     * @param string $startDate
     * @param string $endDate
     * @param string $format
     */
    public function createDateRange($startDate, $endDate, $format = "Y-m-d")
    {
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = new DateInterval('P1D'); // 1 Day
        $dateRange = new DatePeriod($begin, $interval, $end);
        $range = [];
        foreach ($dateRange as $date) {
            $range[$date->format($format)] = $date->format($format);
        }

        return $range;
    }

    /**
     * Search hospital generated invoices
     *
     */
    public function search_hospital_generated_invoice()
    {
        $json = array();
        $encode = '';
        if (empty($_POST['hospital_id'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please Select the hospital first.';
            echo json_encode($json);
            die;
        }
        $hospital_id = $this->input->post('hospital_id');
        $invoice_data = $this->Admin_model->display_hos_generated_invoices($hospital_id);
        $encode .= '<table class="table table-striped">';
        $encode .= '<thead>';
        $encode .= '<tr class="bg-primary">';
        $encode .= '<th>INV No.</th>';
        $encode .= '<th>Hospital</th>';
        $encode .= '<th>Inv From</th>';
        $encode .= '<th>Inv To</th>';
        $encode .= '<th>Created</th>';
        $encode .= '<th colspan="2">Actions</th>';
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
                $encode .= '<td><a href="' . base_url('index.php/admin/generate_hospital_invoice/' . $value['ura_hos_invoice']) . '"><img src="' . base_url('assets/img/view.png') . '"></a></td>';
                $encode .= '<td><a class="delete_hos_inv" data-invid="' . $value['ura_hos_invoice'] . '" href="javascript:;"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
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

    /**
     * Generate hospital invoices
     *
     * @param int $invoice_id
     */
    public function generate_hospital_invoice($invoice_id)
    {
        $hospital_invoice['hospital_invoice'] = $this->Admin_model->generated_hospital_invoices_pdf($invoice_id);
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
        $this->load->view('display/admin_invoice/generate_hospital_pdf_invoice', $result);
    }

    /**
     * Delete invoices
     *
     */
    public function delete_admin_hospital_invoice()
    {
        $json = array();
        if (isset($_POST)) {
            $inv_id = $this->input->post('inv_id');
            $this->db->where('ura_hos_invoice', $inv_id)->delete('uralensis_hospital_invoice');
            $json['type'] = 'success';
            $json['msg'] = 'Invoice Deleted Successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add MDT Lists
     *
     */
    public function add_mdt_lists()
    {
        $json = array();
        $encode = '';
        if (empty($_POST['mdt_list_hospital'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Kindly select the hospital first.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['add_mdt_list'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Kindly add the mdt list name first.';
            echo json_encode($json);
            die;
        }
        $list_name = $this->input->post('add_mdt_list');
        $hospital_id = $this->input->post('mdt_list_hospital');
        $check_list_name = $this->db->query("SELECT * FROM uralensis_mdt_lists WHERE uralensis_mdt_lists.ura_mdt_list_name = '$list_name' AND uralensis_mdt_lists.ura_mdt_list_hospital_id = $hospital_id")->num_rows();
        if ($check_list_name > 0) {
            $json['type'] = 'error';
            $json['msg'] = 'You have already submitted the list with same name.';
            echo json_encode($json);
            die;
        }
        $data = array(
            'ura_mdt_list_name' => $this->input->post('add_mdt_list'),
            'ura_mdt_list_hospital_id' => $this->input->post('mdt_list_hospital'),
            'ura_mdt_list_timestamp' => time()
        );
        $this->db->insert('uralensis_mdt_lists', $data);
        $insert_id = $this->db->insert_id();
        $institute_description = $this->ion_auth->group($this->input->post('mdt_list_hospital'))->row()->description;
        $encode .= '<tr>';
        $encode .= '<td>' . $institute_description . '</td>';
        $encode .= '<td>' . $this->input->post('add_mdt_list') . '</td>';
        $encode .= '<td>' . time() . '</td>';
        $encode .= '<td><a class="delete_mdt_list" href="javascript:;" data-mdtlistid="' . $insert_id . '"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a></td>';
        $encode .= '</tr>';
        $json['type'] = 'success';
        $json['encode_data'] = $encode;
        $json['msg'] = 'List Added Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Delete MDT lists
     *
     */
    public function delete_mdt_list()
    {
        $json = array();
        if (!empty($_POST['mdt_list_id'])) {
            $mdt_list_id = $this->input->post('mdt_list_id');
            $this->db->where('ura_mdt_list_id', $mdt_list_id);
            $this->db->delete('uralensis_mdt_lists');
            $json['type'] = 'success';
            $json['msg'] = 'List deleted successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add lab names
     *
     */
    public function add_lab_names()
    {
        $json = array();
        $lab_name = $_POST["lab_name"];
        $db_lab_check = $this->db->query("SELECT * FROM lab_names WHERE lab_names.lab_name = '$lab_name' LIMIT 1")->result_array();
        if (!empty($db_lab_check[0]) && $db_lab_check[0]['lab_name'] === $lab_name) {
            $json['type'] = 'error';
            $json['msg'] = 'You have already submitted the lab name. Lab name must be unique.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST["lab_name"])) {
            $json['type'] = 'error';
            $json['msg'] = 'Lab name required.';
            echo json_encode($json);
            die;
        }
        if (!empty($_POST["lab_email"])) {
            $count = 1;
            foreach ($_POST["lab_email"] as $key => $emails) {
                echo $emails;
                if ($key === 0 && empty($emails)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'First email is a required field.';
                    echo json_encode($json);
                    die;
                }
                if (!filter_var($emails, FILTER_VALIDATE_EMAIL) && $key === 0) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Invalid email format for email field ' . $count;
                    echo json_encode($json);
                    die;
                }
                $count++;
            }
        }
        if (empty($_POST['lab_number_format'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please select the lab format.';
            echo json_encode($json);
            die;
        }
        $data_array = array(
            'lab_name' => $this->input->post('lab_name'),
            'lab_email' => serialize($this->input->post('lab_email')),
            'lab_format_mask' => $this->input->post('lab_number_format'),
        );
        $this->db->insert('lab_names', $data_array);
        $json['type'] = 'success';
        $json['msg'] = 'Lab Name Inserted Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Add lab names
     *
     */
    public function update_lab_names()
    {
        $json = array();
        if (empty($_POST["lab_name"])) {
            $json['type'] = 'error';
            $json['msg'] = 'Lab name required.';
            echo json_encode($json);
            die;
        }
        if (!empty($_POST["lab_email"])) {
            $count = 1;
            foreach ($_POST["lab_email"] as $key => $emails) {
                if ($key === 0 && empty($emails)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'First email is a required field.';
                    echo json_encode($json);
                    die;
                }
                if (!filter_var($emails, FILTER_VALIDATE_EMAIL) && $key === 0) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Invalid email format for email field ' . $count;
                    echo json_encode($json);
                    die;
                }
                $count++;
            }
        }
        if (empty($_POST["lab_format_mask"])) {
            $json['type'] = 'error';
            $json['msg'] = 'Lab format mask field should not be empty.';
            echo json_encode($json);
            die;
        }
        $data_array = array(
            'lab_name' => $this->input->post('lab_name'),
            'lab_email' => serialize($this->input->post('lab_email')),
            'lab_format_mask' => $this->input->post('lab_format_mask'),
        );
        $lab_id = $this->input->post('lab_id');
        $this->db->where('lab_name_id', $lab_id);
        $this->db->update('lab_names', $data_array);
        $json['type'] = 'success';
        $json['msg'] = 'Lab Name Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Delete lab names
     *
     */
    public function delete_lab_name()
    {
        $json = array();
        if (isset($_POST)) {
            $lab_id = $this->input->post('lab_id');
            $this->db->query("DELETE FROM lab_names WHERE lab_names.lab_name_id = $lab_id");
            $json['type'] = 'success';
            $json['msg'] = 'Lab Name Deleted Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search lab number mask
     *
     */
    public function search_lab_number_mask()
    {
        $json = array();
        if (isset($_POST) && !empty($_POST['lab_id'])) {
            $lab_id = $this->input->post('lab_id');
            $find_lab_mask = $this->db->query("SELECT lab_names.lab_format_mask FROM lab_names WHERE lab_names.lab_name_id = $lab_id")->result_array();
            $lab_mask = '';
            if (!empty($find_lab_mask[0])) {
                $lab_mask = $find_lab_mask[0]['lab_format_mask'];
                if (empty($lab_mask)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Sorry add the lab number format first in general settings.';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'success';
                    $json['lab_mask'] = $lab_mask;
                    $json['msg'] = 'Lab Format Found.';
                    echo json_encode($json);
                    die;
                }
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save dataset name
     *
     */
    public function save_dataset_name()
    {
        $json = array();
        if (isset($_POST)) {
            $data_array = array(
                'ura_datasets_name' => $this->input->post('dataset_name'),
                'timestamp' => time()
            );
            $this->db->insert('uralensis_datasets', $data_array);
            $json['type'] = 'success';
            $json['msg'] = 'Dataset Added Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save Dataset Cat Name
     *
     */
    public function save_dataset_cat_name()
    {
        $json = array();
        if (isset($_POST)) {
            $data_array = array(
                'ura_dataset_cat_name' => $this->input->post('dataset_cat'),
                'ura_dataset_parent_id' => $this->input->post('dataset_parent_id'),
                'timestamp' => time()
            );
            $this->db->insert('uralensis_dataset_cats', $data_array);
            $json['type'] = 'success';
            $json['msg'] = 'Dataset  Category Added Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Refresh Dataset Data
     *
     */
    public function refresh_dataset_data()
    {
        $json = array();
        $encode = '';
        if (isset($_POST)) {
            $dataset_id = $this->input->post('dataset_id');
            $dataset_data = $this->db->query("SELECT * FROM uralensis_dataset_cats WHERE uralensis_dataset_cats.ura_dataset_parent_id = $dataset_id ORDER BY uralensis_dataset_cats.ura_datasets_cat_id ASC")->result();
            if (!empty($dataset_data)) {
                $encode .= '<ul class="list-group">';
                foreach ($dataset_data as $key => $value) {
                    $encode .= '<li class="list-group-item">';
                    $encode .= $value->ura_dataset_cat_name;
                    $encode .= '<a href="javascript:;" data-datasetcat="' . $value->ura_datasets_cat_id . '" class="delete_dataset_cat"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>';
                    $encode .= '</li>';
                }
                $encode .= '</ul>';
                $json['type'] = 'success';
                $json['msg'] = 'Data found in this dataset.';
                $json['response_data'] = $encode;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No data found in this dataset.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Delete Dataset Category
     *
     */
    public function delete_dataset_cat()
    {
        $json = array();
        if (isset($_POST)) {
            $dataset_cat_id = $this->input->post('datasetcat_id');
            $this->db->where('ura_datasets_cat_id', $dataset_cat_id);
            $this->db->delete('uralensis_dataset_cats');
            $this->db->where('ura_datasets_category_id', $dataset_cat_id);
            $this->db->delete('uralensis_datasets_questions');
            $get_questions_ids = $this->db->query("SELECT ura_datasets_ques_id FROM uralensis_datasets_questions AS udq WHERE udq.ura_datasets_category_id = $dataset_cat_id")->result();
            if (!empty($get_questions_ids)) {
                foreach ($get_questions_ids as $ques_id) {
                    $ques_id = $ques_id->ura_datasets_ques_id;
                    $sql = "DELETE FROM uralensis_datasets_answers AS uda WHERE uda.ura_ans_ques_id = $ques_id";
                }
            }
            $json['type'] = 'success';
            $json['msg'] = 'Category deleted successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search Dataset Category
     *
     */
    public function search_dataset_cats()
    {
        $json = array();
        $encode = '';
        if (isset($_POST) && !empty($_POST['dataset_id'])) {
            $dataset_id = $this->input->post('dataset_id');
            $dataset_data = $this->db->query("SELECT * FROM uralensis_dataset_cats WHERE uralensis_dataset_cats.ura_dataset_parent_id = $dataset_id ORDER BY uralensis_dataset_cats.ura_datasets_cat_id ASC")->result();
            if (!empty($dataset_data)) {
                $encode .= '<hr>';
                $encode .= '<strong>Note: Select the dataset category in which you want to add the questions.</strong>';
                $encode .= '<div class="panel-group" id="datasets-cat-accordion">';
                foreach ($dataset_data as $key => $value) {
                    $encode .= '<div class="panel panel-default">';
                    $encode .= '<div class="panel-heading">';
                    $encode .= '<h4 class="panel-title">';
                    $encode .= '<a data-toggle="collapse" data-parent="#datasets-cat-accordion" href="#datacollasecat-' . intval($value->ura_datasets_cat_id) . '">';
                    $encode .= $value->ura_dataset_cat_name;
                    $encode .= '</a>';
                    $encode .= '</h4>';
                    $encode .= '</div>';
                    $encode .= '<div id="datacollasecat-' . intval($value->ura_datasets_cat_id) . '" class="panel-collapse collapse in">';
                    $encode .= '<div class="panel-body add_datasets_question_data">';
                    $encode .= '<button type="button" data-toggle="modal" data-target="#add_dataset_cat_ques-' . $value->ura_datasets_cat_id . '">Add Questions</button>';
                    $encode .= '<button type="button" class="pull-right refresh_question_data" data-datasetcatid="' . $value->ura_datasets_cat_id . '">Refresh Data</button>';
                    $encode .= '<div class="clearfix"></div>';
                    $encode .= '<div id="add_dataset_cat_ques-' . $value->ura_datasets_cat_id . '" class="modal fade" role="dialog">';
                    $encode .= '<div class="modal-dialog">';
                    $encode .= '<div class="modal-content">';
                    $encode .= '<div class="modal-header">';
                    $encode .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    $encode .= '<h4 class="modal-title">Add Dataset Question</h4>';
                    $encode .= '</div>';
                    $encode .= '<div class="modal-body">';
                    $encode .= '<form class="form add_questions_form">';
                    $encode .= '<div class="form-group">';
                    $encode .= '<select class="form-control" name="question_type">';
                    $encode .= '<option value="">Choose Question Type</option>';
                    $encode .= '<option value="truefalse">True/False</option>';
                    $encode .= '<option value="singlechoice">Single Choice</option>';
                    $encode .= '<option value="multiplechoice">Multiple Choice</option>';
                    $encode .= '<option value="number">Number</option>';
                    $encode .= '<option value="textfield">TextField</option>';
                    $encode .= '<option value="textarea">TextArea</option>';
                    $encode .= '</select>';
                    $encode .= '</div>';
                    $encode .= '<div class="form-group">';
                    $encode .= '<label for="question_title">Question Title</label>';
                    $encode .= '<input id="question_title" type="text" class="form-control" name="question_text">';
                    $encode .= '</div>';
                    $encode .= '<div class="form-group">';
                    $encode .= '<input type="hidden" name="dataset_cat_id" value="' . $value->ura_datasets_cat_id . '">';
                    $encode .= '<button class="btn btn-primary save_question_btn-' . $value->ura_datasets_cat_id . '">Save Question</button>';
                    $encode .= '</div>';
                    $encode .= '</form>';
                    $encode .= '<script>';
                    $encode .= '$(document).ready(function(){
                                    $(document).on("click", ".save_question_btn-' . $value->ura_datasets_cat_id . '", function (e) {
                                        e.preventDefault();
                                        var _this = $(this);
                                        var form_data = _this.parents(".add_questions_form").serialize();
                                        $.ajax({
                                            url: "' . base_url('/index.php/admin/save_dataset_question_data') . '",
                                            type: "POST",
                                            global: false,
                                            dataType: "json",
                                            data: form_data,
                                            success: function (data) {
                                                if (data.type === "success") {
                                                    alert(data.msg);
                                                     window.location.reload();
                                                } else {
                                                    _this.parents(".dataset_data").find(".dataset_cat_response").html("");
                                                    jQuery.sticky(data.msg, {classList: "important", speed: 200, autoclose: 7000});
                                                }
                                            }
                                        });
                                    });
                                });';
                    $encode .= '</script>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '<hr>';
                    $encode .= '<div class="datasets_cat_question_data"></div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                }
                $encode .= '</div>';
                $json['type'] = 'success';
                $json['msg'] = 'Dataset category found in this dataset.';
                $json['response_data'] = $encode;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No dataset category found in this dataset. Please add first.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please select the dataset first.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save Datasets Question Data
     *
     */
    public function save_dataset_question_data()
    {
        $json = array();
        if (isset($_POST)) {
            $data_array = array(
                'ura_datasets_category_id' => $this->input->post('dataset_cat_id'),
                'ura_datasets_ques_type' => $this->input->post('question_type'),
                'ura_datasets_ques_title' => $this->input->post('question_text'),
                'timestamp' => time()
            );
            $this->db->insert('uralensis_datasets_questions', $data_array);
            $json['type'] = 'success';
            $json['msg'] = 'Dataset Question Added Successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     *  Search Datasets Categories Question Data
     *
     */
    public function search_dataset_cats_questions()
    {
        $json = array();
        $encode = '';
        if (isset($_POST)) {
            $dataset_cat_id = $this->input->post('dataset_cat_id');
            $question_data = $this->db->query("SELECT * FROM uralensis_datasets_questions AS udq WHERE udq.ura_datasets_category_id = $dataset_cat_id ORDER BY udq.ura_datasets_ques_id DESC")->result();
            if (!empty($question_data)) {
                $encode .= '<ul class="list-group">';
                foreach ($question_data as $key => $value) {
                    $encode .= '<li class="list-group-item">';
                    $encode .= $value->ura_datasets_ques_title;
                    $encode .= '<a href="javascript:;" data-datasetquesid="' . $value->ura_datasets_ques_id . '" class="delete_dataset_question"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>';
                    $encode .= '<a href="javascript:;" data-toggle="modal" data-target="#dataset_question_id_' . $value->ura_datasets_ques_id . '"><i class="glyphicon glyphicon-edit pull-right" style="color: green; margin-right: 10px;"></i></a>';
                    $encode .= '<div id="dataset_question_id_' . $value->ura_datasets_ques_id . '" class="modal fade" role="dialog">';
                    $encode .= '<div class="modal-dialog">';
                    $encode .= '<div class="modal-content">';
                    $encode .= '<div class="modal-header">';
                    $encode .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    $encode .= '<h4 class="modal-title">Add Answers</h4>';
                    $encode .= '</div>';
                    $encode .= '<div class="modal-body">';
                    $encode .= '<h4>Q:&nbsp;' . $value->ura_datasets_ques_title . '</h4>';
                    if ($value->ura_datasets_ques_type === 'multiplechoice') {
                        $encode .= '<p>Question Type: Mutilple Choices</p>';
                        $encode .= '<p><strong>Note: Use pipeline ( | ) seperator after each word. eg: Apple|Orange|Cherry</strong></p>';
                    } else if ($value->ura_datasets_ques_type === 'singlechoice') {
                        $encode .= '<p>Question Type: Single Choices</p>';
                        $encode .= '<p><strong>Note: Use pipeline ( | ) seperator after each word. eg: Apple|Orange|Cherry</strong></p>';
                    } else if ($value->ura_datasets_ques_type === 'number') {
                        $encode .= '<p>Question Type: Number Field</p>';
                    } else if ($value->ura_datasets_ques_type === 'textfield') {
                        $encode .= '<p>Question Type: Text Field</p>';
                    } else if ($value->ura_datasets_ques_type === 'textarea') {
                        $encode .= '<p>Question Type: Text Area</p>';
                    } else if ($value->ura_datasets_ques_type === 'fillinblanks') {
                        $encode .= '<span>Question Type: Fill in Blanks</span>';
                    } else if ($value->ura_datasets_ques_type === 'multiplechoice') {
                        $encode .= '<span>Question Type: True / False</span>';
                        $encode .= '<p><strong>Note: Use pipeline ( | ) seperator after each word. eg: True|False</strong></p>';
                    }
                    $answer_save_data = $this->Admin_model->get_datasets_question_answers($value->ura_datasets_ques_id);
                    $answer_result = '';
                    if (!empty($answer_save_data[0])) {
                        $answer_result = $answer_save_data[0]['ura_answer_text'];
                    }
                    $encode .= '<form class="form save_answer_form">';
                    if ($value->ura_datasets_ques_type === 'fillinblanks') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>No need to add answer for this question option type.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '</div>';
                    } else if ($value->ura_datasets_ques_type === 'multiplechoice') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Add answers in below textarea using pipelines.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '<textarea class="form-control" name="question_answer">' . $answer_result . '</textarea>';
                        $encode .= '<input type="hidden" name="question_id" value="' . $value->ura_datasets_ques_id . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<button type="button" class="save_answer_' . $value->ura_datasets_ques_id . '">Save Answer</button>';
                        $encode .= '</div>';
                    } else if ($value->ura_datasets_ques_type === 'singlechoice') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Add answers in below textarea using pipelines.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '<textarea class="form-control" name="question_answer">' . $answer_result . '</textarea>';
                        $encode .= '<input type="hidden" name="question_id" value="' . $value->ura_datasets_ques_id . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<button type="button" class="save_answer_' . $value->ura_datasets_ques_id . '">Save Answer</button>';
                        $encode .= '</div>';
                    } else if ($value->ura_datasets_ques_type === 'number') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>No need to add answer for this question option type.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '</div>';
                    } else if ($value->ura_datasets_ques_type === 'textfield') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>No need to add answer for this question option type.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '</div>';
                    } else if ($value->ura_datasets_ques_type === 'textarea') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>No need to add answer for this question option type.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '</div>';
                    } else if ($value->ura_datasets_ques_type === 'truefalse') {
                        $checked = '';
                        if ($value->is_required === 'yes') {
                            $checked = 'checked';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Add true false using pipeline seperator.</label>';
                        $encode .= '<p class="pull-right">Is Required?&nbsp;<input ' . $checked . ' data-quesid="' . $value->ura_datasets_ques_id . '" type="checkbox" name="is_dataset_ans_required"></p>';
                        $encode .= '<textarea class="form-control" name="question_answer">' . $answer_result . '</textarea>';
                        $encode .= '<input type="hidden" name="question_id" value="' . $value->ura_datasets_ques_id . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<button type="button" class="save_answer_' . $value->ura_datasets_ques_id . '">Save Answer</button>';
                        $encode .= '</div>';
                    }
                    $encode .= '</form>';
                    $encode .= '<script>
                        $(document).ready(function () {
                            $(document).on("click", ".save_answer_' . $value->ura_datasets_ques_id . '", function (e) {
                                e.preventDefault();
                                var _this = $(this);
                                var form_data = _this.parents(".save_answer_form").serialize();
                                $.ajax({
                                    url: "' . base_url('/index.php/admin/save_answers_data') . '",
                                    type: "POST",
                                    global: false,
                                    dataType: "json",
                                    data: form_data,
                                    success: function (data) {
                                        if (data.type === "success") {
                                            jQuery.sticky(data.msg, {classList: "success", speed: 200, autoclose: 7000});
                                        } else {
                                            
                                            jQuery.sticky(data.msg, {classList: "important", speed: 200, autoclose: 7000});
                                        }
                                    }
                                });
                            });
                        });
                    </script>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</li>';
                }
                $encode .= '</ul>';
                $encode .= '<script>
                $(document).ready(function () {
                    $("input[name=\'is_dataset_ans_required\']").click(function(){
                        var _this = $(this);
                        var req_status = "no";
                        if ($("input[name=\'is_dataset_ans_required\']").is(":checked")) {
                            req_status = "yes";
                        }
                        var ques_id = _this.data("quesid");
                        $.ajax({
                            url: "' . base_url('/index.php/admin/setDatasetIsReqStatus') . '",
                            type: "POST",
                            dataType: "json",
                            data: {"req_status": req_status, "ques_id": ques_id},
                            success: function (response) {
                                if (response.type === "success") {
                                    jQuery.sticky(response.msg, {classList: "success", speed: 200, autoclose: 7000});
                                } else {
                                    jQuery.sticky(response.msg, {classList: "important", speed: 200, autoclose: 7000});
                                }
                            }
                        });
                    });
                });
                </script>';
                $json['type'] = 'success';
                $json['msg'] = 'Questions found successfully.';
                $json['response_data'] = $encode;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Sorry no question added yet. Please add first.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Delete Dataset Question Data
     *
     */
    public function delete_dataset_question_data()
    {
        $json = array();
        if (isset($_POST)) {
            $question_id = $this->input->post('question_id');
            $this->db->where('ura_datasets_ques_id', $question_id);
            $this->db->delete('uralensis_datasets_questions');
            $json['type'] = 'success';
            $json['msg'] = 'Questions deleted successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save Answers Data
     *
     */
    public function save_answers_data()
    {
        $json = array();
        if (isset($_POST) && !empty($_POST['question_answer'])) {
            $ques_id = $this->input->post('question_id');
            $answer_text = $this->input->post('question_answer');
            $is_required = 'no';
            if ($this->input->post('is_dataset_ans_required') && $this->input->post('is_dataset_ans_required') == 'on') {
                $is_required = 'yes';
            }
            $check_ans = $this->db->query("SELECT * FROM uralensis_datasets_answers AS uda WHERE uda.ura_ans_ques_id = $ques_id")->result_array();
            if (!empty($check_ans) && $check_ans[0]['ura_ans_ques_id'] == $ques_id) {
                $this->db->where('ura_ans_ques_id', $ques_id);
                $this->db->update('uralensis_datasets_answers', array('ura_answer_text' => $answer_text, 'is_required' => $is_required));
                $json['type'] = 'success';
                $json['msg'] = 'Record updated Successfully.';
                echo json_encode($json);
                die;
            } else {
                $data_array = array(
                    'ura_answer_text' => $answer_text,
                    'ura_ans_ques_id' => $ques_id,
                    'timestamp' => time()
                );
                $this->db->insert('uralensis_datasets_answers', $data_array);
                $json['type'] = 'success';
                $json['msg'] = 'Answer Added Successfully.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Please add answer first.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Specimen Tracking
     *
     */
    public function specimen_tracking()
    {
        $this->load->view('templates/header-new');
        $this->load->view('display/specimen_tracking/index');
        $this->load->view('templates/footer-new');
    }

    /**
     * Process Specimen Tracking
     *
     */
    public function process_specimen_tracking()
    {
        $json = array();
        $record_track_data = '';
        if (isset($_POST)) {
            $barcode = $this->input->post('tracking_no');
            $this->db->select('ura_barcode_no, uralensis_request_id');
            $this->db->from('request');
            $check_record_exists = $this->db->where('ura_barcode_no', $barcode)->get()->row_array();
            if (!empty($check_record_exists) && !empty($check_record_exists['ura_barcode_no'])) {
                $this->db->select('*');
                $this->db->from('uralensis_record_track_status');
                $get_tracking_data = $this->db->where('ura_rec_track_no', "$barcode")->get()->result_array();
                $record_track_data .= '<a href="' . base_url('index.php/admin/edit_report/' . $check_record_exists['uralensis_request_id']) . '" class="btn btn-success pull-left">Record Detail</a>';
                $record_track_data .= '<a data-delrecordurl="' . base_url('index.php/admin/delete_admin_side_record/' . $check_record_exists['uralensis_request_id'] . '/track_del') . '" class="btn btn-danger pull-right delete_track_record">Delete Record</a>';
                $record_track_data .= '<table class="table">';
                $record_track_data .= '<tr class="bg-primary">';
                $record_track_data .= '<th>Track No.</th>';
                $record_track_data .= '<th>Time/Date</th>';
                $record_track_data .= '<th>Location</th>';
                $record_track_data .= '<th>Status</th>';
                $record_track_data .= '<th>Pathologist</th>';
                $record_track_data .= '</tr>';
                foreach ($get_tracking_data as $data) {
                    $record_track_data .= '<tr class="bg-info">';
                    $record_track_data .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $record_track_data .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $record_track_data .= '</tr>';
                }
                $record_track_data .= '</table>';
                $json['type'] = 'success';
                $json['record_found'] = 'true';
                $json['track_data'] = $record_track_data;
                $json['msg'] = 'Case already added.';
                echo json_encode($json);
                die;
            }
            $hospital_id = $this->input->post('clinic_users');
            $hospital_group_id = $this->input->post('hospital_user');
            $report_urgeny = $this->input->post('report_urgency');
            $doctor_id = $this->input->post('pathologist');
            $lab_id = $this->input->post('lab_name');
            $specimen_type = $this->input->post('specimen_type');
            $specimen_count = $this->input->post('specimen_count');
            $user_id = $this->ion_auth->user()->row()->id;
            $get_lab_name = $this->db->select('lab_name')->where('lab_name_id', $lab_id)->get('lab_names')->row_array();
            $lab_name = '';
            if (!empty($get_lab_name)) {
                $lab_name = $get_lab_name['lab_name'];
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
            $request = array(
                'serial_number' => $key,
                'ura_barcode_no' => $barcode,
                'hospital_group_id' => $hospital_group_id,
                'report_urgency' => !empty($report_urgeny) ? $report_urgeny : '',
                'lab_name' => !empty($lab_name) ? $lab_name : '',
                'status' => 0,
                'request_code_status' => 'new',
                'record_edit_status' => serialize($record_edit_status),
                'request_add_user' => $user_id,
                'request_add_user_timestamp' => time()
            );
            $this->Admin_model->institute_insert($request);
            $record_id = $this->db->insert_id();
            $user_req_data = array(
                'request_id' => $record_id,
                'users_id' => $hospital_id,
                'group_id' => $hospital_group_id
            );
            $this->db->insert("users_request", $user_req_data);
            $request_assign = array(
                'request_id' => $record_id,
                'user_id' => $doctor_id,
            );
            $this->db->insert("request_assignee", $request_assign);
            $assign_request_args = array(
                'assign_status' => intval(1),
                'report_status' => intval(1),
                'request_code_status' => 'assign_doctor',
                'request_assign_status' => intval(1)
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update("request", $assign_request_args);
            if (!empty($specimen_count)) {
                for ($i = 1; $i <= $specimen_count; $i++) {
                    $specimen = array(
                        'request_id' => $record_id,
                        'specimen_site' => '',
                        'specimen_procedure' => '',
                        'specimen_type' => !empty($specimen_type) ? $specimen_type : '',
                        'specimen_block' => '',
                        'specimen_slides' => '',
                        'specimen_block_type' => '',
                        'specimen_macroscopic_description' => '',
                        'specimen_diagnosis_description' => '',
                        'specimen_cancer_register' => '',
                        'specimen_rcpath_code' => ''
                    );
                    $this->db->insert("specimen", $specimen);
                    $specimen_id = $this->db->insert_id();
                    $data = array('rs_request_id' => $record_id, 'rs_specimen_id' => $specimen_id);
                    $this->db->insert('request_specimen', $data);
                }
            }
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data_2 = array(
                'ura_rec_track_no' => $barcode,
                'ura_rec_track_location' => $lab_name,
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => 'booked_out_to_lab',
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data_2);
            $track_sql = "SELECT * FROM uralensis_record_track_status WHERE uralensis_record_track_status.ura_rec_track_record_id = $record_id";
            $record_track_query = $this->db->query($track_sql)->result_array();
            if (!empty($record_track_query)) {
                $record_track_data .= '<table class="table">';
                $record_track_data .= '<tr class="bg-primary">';
                $record_track_data .= '<th>Track No.</th>';
                $record_track_data .= '<th>Time/Date</th>';
                $record_track_data .= '<th>Location</th>';
                $record_track_data .= '<th>Status</th>';
                $record_track_data .= '<th>Pathologist</th>';
                $record_track_data .= '<th>&nbsp;</th>';
                $record_track_data .= '<th>&nbsp;</th>';
                $record_track_data .= '</tr>';
                foreach ($record_track_query as $data) {
                    $record_track_data .= '<tr class="bg-info">';
                    $record_track_data .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $record_track_data .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $record_track_data .= '<td><a href="' . base_url('index.php/admin/edit_report/' . $record_id) . '"><img src="' . base_url('assets/img/edit_clinic.png') . '"></a></td>';
                    $record_track_data .= '<td><a style="cursor:pointer;" data-delrecordurl="' . base_url('index.php/admin/delete_admin_side_record/' . $record_id . '/track_del') . '" class="delete_track_record"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                    $record_track_data .= '</tr>';
                }
                $record_track_data .= '</table>';
            }
            $json['type'] = 'success';
            $json['track_data'] = $record_track_data;
            $json['msg'] = 'Case Inserted Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something wrong while processing your request.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Process Admin Specimen Records
     *
     */
    public function process_record_specimen()
    {
        $json = array();
        if (isset($_POST) && !empty($_POST['record_id'])) {
            $record_id = $this->input->post('record_id');
            $session_data_specimen = array(
                'specimen_request_id' => $record_id
            );
            $this->session->set_userdata($session_data_specimen);
            $specimen = array(
                'request_id' => $record_id,
                'specimen_accepted_by' => $this->input->post('specimen_accepted_by'),
                'specimen_cutup_by' => $this->input->post('specimen_cutupby'),
                'specimen_assisted_by' => $this->input->post('specimen_assisted_by'),
                'specimen_block_checked_by' => $this->input->post('specimen_block_checked_by'),
                'specimen_labelled_by' => $this->input->post('specimen_labeled_by'),
                'specimen_qc_by' => $this->input->post('specimen_qcd_by'),
                'specimen_block' => $this->input->post('specimen_block'),
                'specimen_slides' => $this->input->post('specimen_slides'),
                'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
                'specimen_diagnosis_description' => $this->input->post('specimen_diagnosis'),
                'specimen_rcpath_code' => $this->input->post('rcpath_code')
            );
            $this->db->insert('specimen', $specimen);
            $specimen_id = $this->db->insert_id();
            $data = array('rs_request_id' => $record_id, 'rs_specimen_id' => $specimen_id);
            $this->db->insert('request_specimen', $data);
            if ($this->db->affected_rows() > 0) {
                $json['type'] = 'success';
                $json['msg'] = 'Specimen added successfully.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something wrong while processing your request.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search record based on barcode scanner
     *
     */
    public function search_barcode_record()
    {
        $hospital_users = $this->Admin_model->get_hospital_groups();
        $lab_names = $this->Admin_model->get_lab_names();
        $doc_list = $this->Admin_model->get_doctors();
        $json = array();
        $encode = '';
        $tags_data = '';
        $status_data_1 = '';
        $status_data_2 = '';
        if (isset($_POST)) {
            if (!empty($_POST['search_type']) && $_POST['search_type'] === 'ura_barcode_no') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('barcode');
                $msg = 'Barcode No';
            } else if (!empty($_POST['search_type']) && $_POST['search_type'] === 'serial_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_ul');
                $msg = 'Serial No';
            } else if (!empty($_POST['search_type']) && $_POST['search_type'] === 'lab_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_lab');
                $msg = 'Lab No';
            }
            $this->db->select('*');
            $this->db->from('request');
            $this->db->join('uralensis_record_track_status', 'request.uralensis_request_id = uralensis_record_track_status.ura_rec_track_record_id');
            $this->db->where($search_type, $search_term);
            $query = $this->db->get()->result_array();
            $tag_query = $this->db->where($search_type, $search_term)->get('request')->row_array();
            if (!empty($tag_query)) {
                $record_id = $tag_query['uralensis_request_id'];
                $hospital_group_id = $tag_query['hospital_group_id'];
                $clinic_users = $this->Admin_model->get_all_hospital_users_by_group($hospital_group_id);
                $get_hospital_name = $this->ion_auth->group($hospital_group_id)->row()->description;
                $hospital_name = !empty($get_hospital_name) ? $get_hospital_name : '';
                $tags_data .= '<li class="tg-clinic" data-recordid="' . $record_id . '">';
                $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="lnr lnr-cross show_tag_clinic"></i><span>Clinic: <em>' . $hospital_name . '</em></span></a>';
                $tags_data .= '<div class="show-data-holder" style="background: #1abc9c;">';
                $tags_data .= '<div class="show_clinic">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-apartment"></i>Select Clinic</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                if (!empty($hospital_users)) {
                    foreach ($hospital_users as $users) {
                        $hospital_name = $users->description;
                        $tags_data .= '<div class="input-holder">';
                        $tags_data .= '<input class="tat tag_hospital_user" data-hospitalname="' . $hospital_name . '" type="radio" id="hospital_' . $users->id . '" name="tag_hospital_user" value="' . $users->id . '">';
                        $tags_data .= '<label for="hospital_' . $users->id . '">' . $hospital_name . '</label>';
                        $tags_data .= '</div>';
                    }
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</li>';
                $get_clinic_user = $this->db->where('request_id', $record_id)->get('users_request')->row_array();
                $clinic_user = $this->ion_auth->user($get_clinic_user['users_id'])->row()->username;
                $tags_data .= '<li class="tg-users" data-recordid="' . $record_id . '">';
                $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="lnr lnr-cross show_tag_clinic_user"></i><span>Clinic User: <em>' . ucwords($clinic_user) . '</em></span></a>';
                $tags_data .= '<div class="show-data-holder" style="background: #2ecc71;">';
                $tags_data .= '<div class="show_clinic_users">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-users"></i>Select Clinic User</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                foreach ($clinic_users as $value) {
                    $tags_data .= '<div class="input-holder">';
                    $tags_data .= '<input class="tag_clinic_users" data-hospitalid="' . $hospital_group_id . '" data-clinicuser="' . $value['first_name'] . ' ' . $value['last_name'] . '" type="radio" id="hospital_user_id_' . $value['id'] . '" name="clinic_users" value="' . $value['id'] . '">';
                    $tags_data .= '<label for="hospital_user_id_' . $value['id'] . '">' . $value['first_name'] . ' ' . $value['last_name'] . '</label>';
                    $tags_data .= '</div>';
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</li>';
                $tags_data .= '<li class="tg-labs" data-recordid="' . $record_id . '">';
                $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="lnr lnr-cross show_tag_labs"></i><span>Lab: <em>' . ucwords($tag_query['lab_name']) . '</em></span></a>';
                $tags_data .= '<div class="show-data-holder" style="background: #3498db;">';
                $tags_data .= '<div class="show_labs">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-heart-pulse"></i>Select Lab</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                if (!empty($lab_names)) {
                    foreach ($lab_names as $labs) {
                        $tags_data .= '<div class="input-holder">';
                        $tags_data .= '<input class="tag_lab_name" data-labname="' . $labs->lab_name . '" type="radio" id="lab_' . $labs->lab_name_id . '" name="lab_name" value="' . $labs->lab_name_id . '">';
                        $tags_data .= '<label for="lab_' . $labs->lab_name_id . '">' . $labs->lab_name . '</label>';
                        $tags_data .= '</div>';
                    }
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</li>';
                $get_doctor_id = $this->db->where('request_id', $record_id)->get('request_assignee')->row_array();
                $doctor_name = $this->ion_auth->user($get_doctor_id['user_id'])->row()->username;
                $tags_data .= '<li class="tg-pathologist" data-recordid="' . $record_id . '">';
                $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="lnr lnr-cross show_tag_pathologist"></i><span>Pathologist: <em>' . ucwords($doctor_name) . '</em></span></a>';
                $tags_data .= '<div class="show-data-holder" style="background: #9b59b6;">';
                $tags_data .= '<div class="show_pathologists">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-heart"></i>Select Pathologist</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                if (!empty($doc_list)) {
                    foreach ($doc_list as $doctor) {
                        $tags_data .= '<div class="input-holder">';
                        $tags_data .= '<input class="tag_pathology_users" type="radio" data-pathologist="' . $doctor->first_name . ' ' . $doctor->last_name . '" id="doctor_' . $doctor->id . '" name="pathologist" value="' . $doctor->id . '">';
                        $tags_data .= '<label for="doctor_' . $doctor->id . '">' . $doctor->first_name . ' ' . $doctor->last_name . '</label>';
                        $tags_data .= '</div>';
                    }
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= ' </li>';
                $tags_data .= '<li class= "tg-urgency" data-recordid="' . $record_id . '">';
                $tags_data .= '<a class="tg-tag" href = "javascript:;"><i class="lnr lnr-cross show_tag_urgency"></i><span>Urgency: <em>' . ucwords($tag_query['report_urgency']) . ' </em></span></a>';
                $tags_data .= '<div class="show-data-holder" style="background: #e67e22;">';
                $tags_data .= '<div class="show_report_urgency">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-clock"></i>Select Report Urgency</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder">';
                $report_urgeny_data = array(
                    'routine' => 'Routine',
                    '2ww' => '2WW',
                    'urgent' => 'Urgent',
                );
                foreach ($report_urgeny_data as $key => $urgency) {
                    $tags_data .= '<div class="input-holder">';
                    $tags_data .= '<input class="tag_urgency" data-urgency="' . $urgency . '" type="radio" id="report_' . $key . '" name="report_urgency" value="' . $key . '">';
                    $tags_data .= '<label for="report_' . $key . '">' . $urgency . '</label>';
                    $tags_data .= '</div>';
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</li>';
                $get_specimen_type = $this->db->select('specimen_type')->where('request_id ', $record_id)->get('specimen')->row_array();
                $tags_data .= '<li class="tg-specimen" data-recordid="' . $record_id . '">';
                $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="lnr lnr-cross show_tag_specimen"></i><span>Specimen Type: <em>' . ucwords($get_specimen_type['specimen_type']) . ' </em></span></a>';
                $tags_data .= '<div class="show-data-holder" style="background: #e74c3c;">';
                $tags_data .= '<div class="show_specimen_type">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-layers"></i>Select Specimen Type</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder">';
                $specimen_type_data = array(
                    'gi' => 'GI',
                    'skin' => 'Skin',
                    'other' => 'Other'
                );
                foreach ($specimen_type_data as $key => $specimen_type) {
                    $tags_data .= '<div class="input-holder">';
                    $tags_data .= '<input class="tag_specimen_type" data-specimentype="' . $specimen_type . '" type="radio" id="speci_type_' . $key . '" name="specimen_type" value="' . $key . '">';
                    $tags_data .= '<label for="speci_type_' . $key . '">' . $specimen_type . '</label>';
                    $tags_data .= '</div>';
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</li>';
            }
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
            $status_data_1 .= '<a class="admin_book_in_from_clinic text-center" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="book_in_from_clinic">';
            $status_data_1 .= '<img src="' . base_url('assets/img/Central-Admin-2.jpg') . '">';
            $status_data_1 .= '</a>';
            $status_data_2 .= '<a class="admin_received_from_lab text-center" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="received_from_lab">';
            $status_data_2 .= '<img src="' . base_url('assets/img/Received-From-Lab.jpg') . '">';
            $status_data_2 .= '</a>';
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
                    $encode .= '<td>' . $data['ura_rec_track_no'] . ' </td>';
                    $encode .= '<td>' . date('h:i, d/m/Y ', $data['timestamp']) . ' </td>';
                    $encode .= '<td>' . $data['ura_rec_track_location'] . ' </td>';
                    $encode .= '<td>' . $data['ura_rec_track_status'] . ' </td>';
                    $encode .= '<td>' . $data['ura_rec_track_pathologist'] . ' </td>';
                    $encode .= '</tr>';
                }
                $encode .= '</table>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['tags_data'] = $tags_data;
                $json['status_data_1'] = $status_data_1;
                $json['status_data_2'] = $status_data_2;
                $json['msg'] = $msg . ' record found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
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
     * Save Track record tag data
     * Update the existing record.
     *
     */
    public function get_track_tag_hospital_user()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login ', 'refresh');
        }
        $json = array();
        $tags_data = '';
        if (isset($_POST)) {
            $tag_type = $this->input->post('tag_type');
            $record_id = $this->input->post('record_id');
            $hospital_id = $this->input->post('hospital_id');
            $hospital_users = $this->Admin_model->get_all_hospital_users_by_group($hospital_id);
            if (!empty($hospital_users)) {
                $tags_data .= '<div class="show-data-holder" style="background: #2ecc71;">';
                $tags_data .= '<div class="show_clinic_users">';
                $tags_data .= '<div class="show_clinic_title">';
                $tags_data .= '<a href="javascript:;" class="lnr lnr-cross tag_close_showpanel"></a>';
                $tags_data .= '<h4><i class="lnr lnr-users"></i>Select Clinic User</h4>';
                $tags_data .= '</div>';
                $tags_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                foreach ($hospital_users as $value) {
                    $tags_data .= '<div class="input-holder">';
                    $tags_data .= '<input class="tat" data-hospitalid="' . $hospital_id . '" data-clinicuser="' . $value['first_name'] . ' ' . $value['last_name'] . '" type="radio" id="hospital_user_id_' . $value['id'] . '" name="clinic_users" value="' . $value['id'] . '">';
                    $tags_data .= '<label for="hospital_user_id_' . $value['id'] . '">' . $value['first_name'] . ' ' . $value['last_name'] . ' </label>';
                    $tags_data .= '</div>';
                }
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $tags_data .= '</div>';
                $json['type'] = 'success';
                $json['msg'] = 'User Found in this clinic.';
                $json['tags_data'] = $tags_data;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No user found in the selected clinic.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Save Track record tag data
     * Update the existing record.
     *
     */
    public function set_track_record_tag_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login ', 'refresh');
        }
        $json = array();
        $tags_data = '';
        if (isset($_POST)) {
            $tag_type = $this->input->post('tag_type');
            $record_id = $this->input->post('record_id');
            $hospital_id = $this->input->post('hospital_id');
            $clinic_user_id = $this->input->post('clinic_user');
            $lab_id = $this->input->post('lab_id');
            $doctor_id = $this->input->post('doctor_id');
            $urgency_val = $this->input->post('urgency_val');
            $specimen_val = $this->input->post('specimen_val');
            $get_lab_name = $this->db->select('lab_name')->where('lab_name_id', $lab_id)->get('lab_names')->row_array();
            $lab_name = '';
            if (!empty($get_lab_name)) {
                $lab_name = $get_lab_name['lab_name'];
            }
            switch ($tag_type) {
                case "hospital_user":
                    if (!empty($hospital_id) && !empty($clinic_user_id)) {
                        $this->db->where('uralensis_request_id', $record_id)->update('request', array('hospital_group_id' => $hospital_id));
                        $this->db->where('request_id', $record_id)->update('users_request', array('users_id' => $clinic_user_id, 'group_id' => $hospital_id));
                        $json['type'] = 'success';
                        $json['msg'] = 'Record Updated Successfully.';
                        echo json_encode($json);
                        die;
                    } else {
                        $json['type'] = 'error';
                        $json['msg'] = 'Something went wrong.';
                        echo json_encode($json);
                        die;
                    }
                    break;
                case "lab_name":
                    if (!empty($lab_id)) {
                        $this->db->where('uralensis_request_id', $record_id)->update('request', array('lab_name' => $lab_name));
                        $json['type'] = 'success';
                        $json['msg'] = 'Record Updated Successfully.';
                        echo json_encode($json);
                        die;
                    } else {
                        $json['type'] = 'error';
                        $json['msg'] = 'Something went wrong.';
                        echo json_encode($json);
                        die;
                    }
                    break;
                case "pathologist":
                    if (!empty($doctor_id)) {
                        $this->db->where('request_id', $record_id)->update('request_assignee', array('request_id' => $record_id, 'user_id' => $doctor_id));
                        $json['type'] = 'success';
                        $json['msg'] = 'Record Updated Successfully.';
                        echo json_encode($json);
                        die;
                    } else {
                        $json['type'] = 'error';
                        $json['msg'] = 'Something went wrong.';
                        echo json_encode($json);
                        die;
                    }
                    break;
                case "urgency":
                    if (!empty($urgency_val)) {
                        $this->db->where('uralensis_request_id', $record_id)->update('request', array('report_urgency' => $urgency_val));
                        $json['type'] = 'success';
                        $json['msg'] = 'Record Updated Successfully.';
                        echo json_encode($json);
                        die;
                    } else {
                        $json['type'] = 'error';
                        $json['msg'] = 'Something went wrong.';
                        echo json_encode($json);
                        die;
                    }
                    break;
                case "specimen":
                    if (!empty($specimen_val)) {
                        $this->db->where('request_id', $record_id)->update('specimen', array('specimen_type' => $specimen_val));
                        $json['type'] = 'success';
                        $json['msg'] = 'Record Updated Successfully.';
                        echo json_encode($json);
                        die;
                    } else {
                        $json['type'] = 'error';
                        $json['msg'] = 'Something went wrong.';
                        echo json_encode($json);
                        die;
                    }
                    break;
                default:
                    echo "Your favorite color is neither red, blue, nor green!";
            }
        }
    }

    /**
     * Get Pathologist/Doctor Name
     *
     * @param int $record_id
     */
    public function get_doctor_name($record_id)
    {
        if (!empty($record_id)) {
            $query = $this->db
                ->where('request_id', $record_id)
                ->get('request_assignee')
                ->row_array();
            $doctor_name = $this->get_uralensis_username($query['user_id']);

            return $doctor_name;
        }
    }

    /**
     * Save User record history status
     * check if user still on editing mode
     * alse abort the ajax request.
     *
     */
    public function save_user_view_status()
    {
        $json = array();
        $user_id = $this->ion_auth->user()->row()->id;
        if (isset($_POST['user_status']) && $_POST['user_status'] === 'view' && !empty($_POST['record_id'])) {
            $record_id = $_POST['record_id'];
            $history_data = array(
                'rec_history_user_id' => $user_id,
                'rec_history_record_id' => $record_id,
                'rec_history_data' => '',
                'rec_history_status' => 'view',
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_history', $history_data);
            $json['msg'] = 'Ajax Aborted';
            echo json_encode($json);
            die;
        } else {
            $json['msg'] = 'Still Checking';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Display all ajax processing
     *
     */
    public function display_all_ajax_processing()
    {
        $url_year = '';
        $url_type = '';
		$docs_ids = ''; 
        if (!empty($_POST['year']) && !empty($_POST['type'])) {
            $url_year = $_POST['year'];
            $url_type = $_POST['type'];
        }
        $flag_type = '';
        if (!empty($_POST['flag_type'])) {
            $flag_type = $_POST['flag_type'];
        }
		
		//$docs_ids = '10,83,0';
        $docs_ids = '';
		if (is_array($_POST['docs_ids'])) 
		{
			$docs_ids = implode(",",$_POST['docs_ids']);
			//$docs_ids=removeItem('0', $docs_ids);				
		}
		//$list = $this->Admin_model->display_admin_record($url_year, $url_type, $flag_type, $docs_ids);
		$list = $this->Admin_model->display_admin_publishrecord($url_year, $url_type, $flag_type, $docs_ids);		
	    
		$data = array();
        $flag_count = 11;
        $row_count = 0;
        //debug($list);
        foreach ($list as $record) 
		{
			$doc_name='';
			$Doctor_list = $this->Admin_model->get_doctor_by_id($record->uralensis_request_id);
			foreach($Doctor_list as $doc_record)
			{
				$doc_name='<img alt="" class="doct_pic_table" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=Andrew+Patterson">'.$doc_record->first_name." ".$doc_record->last_name;
			}
			
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
            $publish_status = '<span data-toggle="tooltip" data-placement="top" title="Not Published">N-Pub</span>';
            if ($record->specimen_publish_status == 1) 
			{
                $publish_status = '
                <div class="dropdown">
                  <button type="button" class="btn btn-light btn-rounded dropdown-toggle" data-toggle="dropdown">
                    <i class="la la-cloud-upload-alt" style="font-size:28px; color:#222;"></i>
                  </button>
                  <div class="dropdown-menu" style="min-width:100%">
                    <a  href="#" class="record_id_unpublish btn btn-link dropdown-item" data-recordserial="' . $record->serial_number . '" data-unpublishrecordid="' . site_url() . '/admin/unpublish_record/' . $record->uralensis_request_id . '"><img class="ubpub_pic" src="'. base_url('assets/icons/UnPublishBlack.png') . '" title="Un Publish" /></a>
                  </div>
                </div>';
            }
			
			
            $delete_btn = '<a class="record_id_delete btn btn-link" data-recordserial="' . $record->serial_number . '" data-delrecordid="' . site_url() . '/admin/delete_admin_side_record/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/delete.png') . '" /></a>';
            $ul_and_track = '';
            if (!empty($record->serial_number) || !empty($record->ura_barcode_no)) {
                $ul_and_track = $record->serial_number . '<br>' . $record->ura_barcode_no;
            }
            $f_initial = '';
            $l_initial = '';
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->first_initial)) {
                $f_initial = $this->ion_auth->group($record->hospital_group_id)->row()->first_initial;
            }
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->last_initial)) {
                $l_initial = $this->ion_auth->group($record->hospital_group_id)->row()->last_initial;
            }
            $batch_no = '';
            if (!empty($record->record_batch_id)) {
                $batch_no = $record->record_batch_id;
            }
            $full_name = '';
            if (!empty($record->f_name) || !empty($record->sur_name)) {
                $full_name = $record->f_name . '<br>' . $record->sur_name;
            }
            $dob_nd_nhs = '<br>' . $record->nhs_number;
            if (!empty($record->dob)) {
                $dob_nd_nhs = $record->nhs_number . '<br>' . date('d-m-Y', strtotime($record->dob));
            }
            $rec_by_lab_date = '';
            if (!empty($record->date_received_bylab)) {
                $rec_by_lab_date = date('d-m-Y', strtotime($record->date_received_bylab));
            }
            $lab_and_lab_rec_date = '';
            if (!empty($record->lab_number) || !empty($rec_by_lab_date)) {
                $lab_and_lab_rec_date = $record->lab_number . '<br>' . $rec_by_lab_date;
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
            $add_comments = '';
            $show_comments = '';
            $add_comments .= '<div class="comments_icon">';
            $add_comments .= '<a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="' . $record->uralensis_request_id . '" data-modalid="' . $flag_count . '">';
            $add_comments .= '<i class="lnr lnr-bubble" style="font-size:18px;font-weight:bold;"></i>';
            $add_comments .= '</a>';
            $add_comments .= '</div>';
            $show_comments .= '<div class="comments_icon">';
            $show_comments .= '<a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="' . $record->uralensis_request_id . '" data-modalid="' . $flag_count . '">';
            $show_comments .= '<i class="lnr lnr-file-empty" style="font-size:18px;font-weight:bold;"></i>';
            $show_comments .= '</a>';
            $show_comments .= '</div>';
            $add_comments .= '<div id="flag_comment_model-' . $flag_count . '" class="flag_comment_model modal fade" role="dialog" data-backdrop="static" data-keyboard="false">';
            $add_comments .= '<div class="modal-dialog">';
            $add_comments .= '<div class="modal-content">';
            $add_comments .= '<div class="modal-header">';
            $add_comments .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            $add_comments .= '<h4 class="modal-title">Flag Reason Comment</h4>';
            $add_comments .= '</div>';
            $add_comments .= '<div class="modal-body">';
            $add_comments .= '<div class="flag_msg"></div>';
            $add_comments .= '<form class="form flag_comments" id="flag_comments_form">';
            $add_comments .= '<div class="form-group">';
            $add_comments .= '<textarea name="flag_comment" id="flag_comment" class="form-control flag_comment"></textarea>';
            $add_comments .= '</div>';
            $add_comments .= '<div class="form-group">';
            $add_comments .= '<hr>';
            $add_comments .= '<input type="hidden" name="record_id" value="' . $record->uralensis_request_id . '">';
            $add_comments .= '<a class="btn btn-primary" id="flag_comments_save" href="javascript:;">Save Comments</a>';
            $add_comments .= '</div>';
            $add_comments .= '</form>';
            $add_comments .= '</div>';
            $add_comments .= '</div>';
            $add_comments .= '</div>';
            $add_comments .= '</div>';
            $show_comments .= '<div id="display_comments_list-' . $flag_count . '" class="modal fade display_comments_list" role="dialog" data-backdrop="static" data-keyboard="false">';
            $show_comments .= '<div class="modal-dialog">';
            $show_comments .= '<div class="modal-content">';
            $show_comments .= '<div class="modal-header">';
            $show_comments .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            $show_comments .= '<h4 class="modal-title">Flag Comments</h4>';
            $show_comments .= '</div>';
            $show_comments .= '<div class="modal-body">';
            $show_comments .= '<div class="display_flag_msg"></div>';
            $show_comments .= '<div class="flag_comments_dynamic_data"></div>';
            $show_comments .= '</div>';
            $show_comments .= '<div class="modal-footer">';
            $show_comments .= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            $show_comments .= '</div>';
            $show_comments .= '</div>';
            $show_comments .= '</div>';
            $show_comments .= '</div>';
            $flag_content = '<div class="hover_flags">';
            $flag_content .= '<div class="flag_images">';
            if ($record->flag_status === 'flag_red') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
            } else if ($record->flag_status === 'flag_yellow') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
            } else if ($record->flag_status === 'flag_blue') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
            } else if ($record->flag_status === 'flag_black') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
            } else if ($record->flag_status === 'flag_gray') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
            } else {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
            }
            $flag_content .= '</div>';
            $flag_content .= '<ul class="report_flags list-unstyled list-inline record-latest-flags">';
            $active = '';
            if ($record->flag_status === 'flag_green') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_green" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="' . base_url('assets/img/flag_green.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_red') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_red" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="' . base_url('assets/img/flag_red.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_yellow') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_yellow" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="' . base_url('assets/img/flag_yellow.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_blue') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_blue" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="' . base_url('assets/img/flag_blue.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_black') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_black" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="' . base_url('assets/img/flag_black.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_gray') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_gray" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="' . base_url('assets/img/flag_gray.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $flag_content .= '</ul>';
            $flag_content .= '</div>';
            $hospital_description_name = '';
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->description)) {
                $hospital_description_name = $this->ion_auth->group($record->hospital_group_id)->row()->description;
            }
            $row = array();
			if ($record->assign_status == 0) 
			{
            	//$row[] = '<input type="checkbox" onclick="new_data(this.value)" name="assign_id[]" value="' . $record->uralensis_request_id . '">';
				$row[] = '';
			}
			else
			{
				$row[] ='';
			}
			$row[] = $ul_and_track;
            $row[] = '<a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="' . $hospital_description_name . '" href="javascript:;" >'.$f_initial.''.$l_initial.'</a>';
            $row[] = '';
            $row[] = $batch_no . '<br>' . $record->pci_number;
            $row[] = $full_name;
            $row[] = $dob_nd_nhs;
            $row[] = $lab_and_lab_rec_date;
            $row[] = '';
            $row[] = '';
            $row[] = '<i class="' . $urgency_class . '" data-toggle="tooltip" data-placement="top" title="' . $urgency_title . '" style="font-size:18px;"></i>';
            $row[] = $doc_name;
            $row[] = $flag_content;
            $row[] = $add_comments;
            $row[] = $show_comments;
            $assign_status = '<span style=""><img data-toggle="tooltip" data-placement="top" title="Not Assigned" src="' . base_url('assets/img/error.png') . '" /></span>';			
            if ($record->assign_status == 1) 
			{
                $assign_status = '<span style="color:green;"><img data-toggle="tooltip" data-placement="top" title="Assigned" src="' . base_url('assets/img/correct.png') . '" /><span>';
            }
			
            $row[] = $assign_status;
            $row[] = $publish_status;
            $row[] = '<a style="" class="" href="' . site_url() . 'doctor/doctor_record_detail_old/' . $record->uralensis_request_id . '"><i class="fa fa-pencil edit_icon m-r-5"></i></a> 
                        <a style="float:right;" class="record_id_delete" data-recordserial="' . $record->serial_number . '" data-delrecordid="' . site_url() . '/admin/delete_admin_side_record/' . $record->uralensis_request_id . '"><i class="fa fa-trash-o edit_icon m-r-5"></i></a> ';
            $row[] = '';
            $row[] = '';
            $row[] = '<p style="display:none;">' . $row_code . '</p>';
            $row[] = '<p style="">' . $record->flag_status . '</p>';
            $data[] = $row;
            $flag_count++;
            $row_count++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => intval($row_count),
            "recordsFiltered" => intval($this->Admin_model->record_count_filtered($url_year, $url_type, $flag_type)),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function display_all_ajax_published()
    {
        $url_year = '';
        $url_type = '';
		$docs_ids = ''; 
        if (!empty($_POST['year']) && !empty($_POST['type'])) {
            $url_year = $_POST['year'];
            $url_type = $_POST['type'];
        }
        $flag_type = '';
        if (!empty($_POST['flag_type'])) {
            $flag_type = $_POST['flag_type'];
        }
		
		//$docs_ids = '10,83,0';
		if (is_array($_POST['docs_ids'])) 
		{
			$docs_ids = $_POST['docs_ids'];	
			//$docs_ids=removeItem('0', $docs_ids);				
		}
		$docs_ids =implode(",",$_POST['docs_ids']);
		$list = $this->Admin_model->display_admin_publishrecord($url_year, $url_type, $flag_type, $docs_ids);		
	    
		$data = array();
        $flag_count = 11;
        //debug($list);
        foreach ($list as $record) 
		{
			$doc_name='';
			$Doctor_list = $this->Admin_model->get_doctor_by_id($record->uralensis_request_id);
			foreach($Doctor_list as $doc_record)
			{
				$doc_name='<img alt="" class="doct_pic_table" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=Andrew+Patterson">'.$doc_record->first_name." ".$doc_record->last_name;
			}
			
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
            $publish_status = '<span data-toggle="tooltip" data-placement="top" title="Not Published">N-Pub</span>';
            if ($record->specimen_publish_status == 1) 
			{
                $publish_status = '
                <div class="dropdown">
                  <button type="button" class="btn btn-light btn-rounded dropdown-toggle" data-toggle="dropdown">
                    <i class="la la-cloud-upload-alt" style="font-size:28px; color:#222;"></i>
                  </button>
                  <div class="dropdown-menu" style="min-width:100%">
                    <a  href="#" class="record_id_unpublish btn btn-link dropdown-item" data-recordserial="' . $record->serial_number . '" data-unpublishrecordid="' . site_url() . '/admin/unpublish_record/' . $record->uralensis_request_id . '"><img class="ubpub_pic" src="'. base_url('assets/icons/UnPublishBlack.png') . '" title="Un Publish" /></a>
                  </div>
                </div>';
            }
			
			
            $delete_btn = '<a class="record_id_delete btn btn-link" data-recordserial="' . $record->serial_number . '" data-delrecordid="' . site_url() . '/admin/delete_admin_side_record/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/delete.png') . '" /></a>';
            $ul_and_track = '';
            if (!empty($record->serial_number) || !empty($record->ura_barcode_no)) {
                $ul_and_track = $record->serial_number . '<br>' . $record->ura_barcode_no;
            }
            $f_initial = '';
            $l_initial = '';
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->first_initial)) {
                $f_initial = $this->ion_auth->group($record->hospital_group_id)->row()->first_initial;
            }
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->last_initial)) {
                $l_initial = $this->ion_auth->group($record->hospital_group_id)->row()->last_initial;
            }
            $batch_no = '';
            if (!empty($record->record_batch_id)) {
                $batch_no = $record->record_batch_id;
            }
            $full_name = '';
            if (!empty($record->f_name) || !empty($record->sur_name)) {
                $full_name = $record->f_name . '<br>' . $record->sur_name;
            }
            $dob_nd_nhs = '<br>' . $record->nhs_number;
            if (!empty($record->dob)) {
                $dob_nd_nhs = $record->nhs_number . '<br>' . date('d-m-Y', strtotime($record->dob));
            }
            $rec_by_lab_date = '';
            if (!empty($record->date_received_bylab)) {
                $rec_by_lab_date = date('d-m-Y', strtotime($record->date_received_bylab));
            }
            $lab_and_lab_rec_date = '';
            if (!empty($record->lab_number) || !empty($rec_by_lab_date)) {
                $lab_and_lab_rec_date = $record->lab_number . '<br>' . $rec_by_lab_date;
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
            $add_comments = '';
            $show_comments = '';
            $add_comments .= '<div class="comments_icon">';
            $add_comments .= '<a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="' . $record->uralensis_request_id . '" data-modalid="' . $flag_count . '">';
            $add_comments .= '<i class="lnr lnr-bubble" style="font-size:18px;font-weight:bold;"></i>';
            $add_comments .= '</a>';
            $add_comments .= '</div>';
            $show_comments .= '<div class="comments_icon">';
            $show_comments .= '<a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_list" data-recordid="' . $record->uralensis_request_id . '" data-modalid="' . $flag_count . '">';
            $show_comments .= '<i class="lnr lnr-file-empty" style="font-size:18px;font-weight:bold;"></i>';
            $show_comments .= '</a>';
            $show_comments .= '</div>';
            $add_comments .= '<div id="flag_comment_model-' . $flag_count . '" class="flag_comment_model modal fade" role="dialog" data-backdrop="static" data-keyboard="false">';
            $add_comments .= '<div class="modal-dialog">';
            $add_comments .= '<div class="modal-content">';
            $add_comments .= '<div class="modal-header">';
            $add_comments .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            $add_comments .= '<h4 class="modal-title">Flag Reason Comment</h4>';
            $add_comments .= '</div>';
            $add_comments .= '<div class="modal-body">';
            $add_comments .= '<div class="flag_msg"></div>';
            $add_comments .= '<form class="form flag_comments" id="flag_comments_form">';
            $add_comments .= '<div class="form-group">';
            $add_comments .= '<textarea name="flag_comment" id="flag_comment" class="form-control flag_comment"></textarea>';
            $add_comments .= '</div>';
            $add_comments .= '<div class="form-group">';
            $add_comments .= '<hr>';
            $add_comments .= '<input type="hidden" name="record_id" value="' . $record->uralensis_request_id . '">';
            $add_comments .= '<a class="btn btn-primary" id="flag_comments_save" href="javascript:;">Save Comments</a>';
            $add_comments .= '</div>';
            $add_comments .= '</form>';
            $add_comments .= '</div>';
            $add_comments .= '</div>';
            $add_comments .= '</div>';
            $add_comments .= '</div>';
            $show_comments .= '<div id="display_comments_list-' . $flag_count . '" class="modal fade display_comments_list" role="dialog" data-backdrop="static" data-keyboard="false">';
            $show_comments .= '<div class="modal-dialog">';
            $show_comments .= '<div class="modal-content">';
            $show_comments .= '<div class="modal-header">';
            $show_comments .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            $show_comments .= '<h4 class="modal-title">Flag Comments</h4>';
            $show_comments .= '</div>';
            $show_comments .= '<div class="modal-body">';
            $show_comments .= '<div class="display_flag_msg"></div>';
            $show_comments .= '<div class="flag_comments_dynamic_data"></div>';
            $show_comments .= '</div>';
            $show_comments .= '<div class="modal-footer">';
            $show_comments .= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            $show_comments .= '</div>';
            $show_comments .= '</div>';
            $show_comments .= '</div>';
            $show_comments .= '</div>';
            $flag_content = '<div class="hover_flags">';
            $flag_content .= '<div class="flag_images">';
            if ($record->flag_status === 'flag_red') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_red.png') . '">';
            } else if ($record->flag_status === 'flag_yellow') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
            } else if ($record->flag_status === 'flag_blue') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
            } else if ($record->flag_status === 'flag_black') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
            } else if ($record->flag_status === 'flag_gray') {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_gray.png') . '">';
            } else {
                $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_green.png') . '">';
            }
            $flag_content .= '</div>';
            $flag_content .= '<ul class="report_flags list-unstyled list-inline record-latest-flags">';
            $active = '';
            if ($record->flag_status === 'flag_green') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_green" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="' . base_url('assets/img/flag_green.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_red') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_red" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="' . base_url('assets/img/flag_red.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_yellow') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_yellow" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="' . base_url('assets/img/flag_yellow.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_blue') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_blue" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="' . base_url('assets/img/flag_blue.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_black') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_black" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="' . base_url('assets/img/flag_black.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $active = '';
            if ($record->flag_status === 'flag_gray') {
                $active = 'flag_active';
            }
            $flag_content .= '<li class="' . $active . '">';
            $flag_content .= '<a href="javascript:;" data-flag="flag_gray" data-serial="' . $record->serial_number . '" data-recordid="' . $record->uralensis_request_id . '" class="flag_change">';
            $flag_content .= '<img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="' . base_url('assets/img/flag_gray.png') . '">';
            $flag_content .= '</a>';
            $flag_content .= '</li>';
            $flag_content .= '</ul>';
            $flag_content .= '</div>';
            $hospital_description_name = '';
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->description)) {
                $hospital_description_name = $this->ion_auth->group($record->hospital_group_id)->row()->description;
            }
            $row = array();
			if ($record->assign_status == 0) 
			{
            	$row[] = '<input type="checkbox" onclick="new_data(this.value)" name="assign_id[]" value="' . $record->uralensis_request_id . '">';
			}
			else
			{
				$row[] ='';
			}
			$row[] = $ul_and_track;
            $row[] = '<a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="' . $hospital_description_name . '" href="javascript:;" >'.$f_initial.''.$l_initial.'</a>';
            $row[] = '';
            $row[] = $batch_no . '<br>' . $record->pci_number;
            $row[] = $full_name;
            $row[] = $dob_nd_nhs;
            $row[] = $lab_and_lab_rec_date;
            $row[] = '';
            $row[] = '';
            $row[] = '<i class="' . $urgency_class . '" data-toggle="tooltip" data-placement="top" title="' . $urgency_title . '" style="font-size:18px;"></i>';
            $row[] = $doc_name;
            $row[] = $flag_content;
            $row[] = $add_comments;
            $row[] = $show_comments;
            $assign_status = '<span style=""><img data-toggle="tooltip" data-placement="top" title="Not Assigned" src="' . base_url('assets/img/error.png') . '" /></span>';			
            if ($record->assign_status == 1) 
			{
                $assign_status = '<span style="color:green;"><img data-toggle="tooltip" data-placement="top" title="Assigned" src="' . base_url('assets/img/correct.png') . '" /><span>';
            }
			
            $row[] = $assign_status;
            $row[] = $publish_status;
            $row[] = '<a href="' . site_url() . 'doctor/doctor_record_detail_old/' . $record->uralensis_request_id . '"> <i class="fa fa-pencil edit_icon m-r-5"></i></a>
                    <a style="float:right;" class="record_id_delete" data-recordserial="' . $record->serial_number . '" data-delrecordid="' . site_url() . '/admin/delete_admin_side_record/' . $record->uralensis_request_id . '"><i class="fa fa-trash-o edit_icon m-r-5"></i></a>';
            $row[] = '';
            $row[] = '';
            $row[] = '<p style="display:none;">' . $row_code . '</p>';
            $row[] = '<p style="">' . $record->flag_status . '</p>';
            $data[] = $row;
            $flag_count++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => intval($this->Admin_model->record_count_all()),
            "recordsFiltered" => intval($this->Admin_model->record_count_filtered($url_year, $url_type, $flag_type)),
            "data" => $data,
        );
        echo json_encode($output);
    }


    /**
     * Download Microscopic Code CSV
     *
     */
    public function download_microscopic_code_csv()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Histology_Codes.csv');
        $output = fopen('php://output', 'w');
        fputcsv(
            $output,
            array(
                'Code',
                'Title',
                'Description',
                'Diagnosis',
                'T Code',
                'M Code',
                'P Code',
                'Classification',
                'Cancer Register',
                'RCPath'
            )
        );
        $query = $this->db->order_by("umc_id", "asc")->get('uralensis_micro_codes')->result_array();
        if (!empty($query)) {
            foreach ($query as $micro) {
                fputcsv(
                    $output,
                    array(
                        'Code' => $micro['umc_code'],
                        'Title' => $micro['umc_title'],
                        'Description' => $micro['umc_micro_desc'],
                        'Diagnosis' => $micro['umc_disgnosis'],
                        'T Code' => $micro['umc_snomed_t_code'],
                        'M Code' => $micro['umc_snomed_m_code'],
                        'P Code' => $micro['umc_snomed_p_code'],
                        'Classification' => $micro['umc_classification'],
                        'Cancer Register' => $micro['umc_cancer_register'],
                        'RCPath' => $micro['umc_rcpath_score']
                    )
                );
            }
        }
    }

    /**
     * Tracking Record View.
     *
     */
    public function record_tracking()
    {
        $this->load->view('templates/header-new');
        $this->load->view('display/record_tracking/index-new');
        $this->load->view('templates/footer-new');
    }

    /**
     * Search Tracking
     *
     */
    public function search_tracking()
    {
        $admin_id = $this->ion_auth->user()->row()->id;
        $hospital_users['hos_users'] = $this->Admin_model->get_hospital_groups();
        $lab_names['lab_names'] = $this->Admin_model->get_lab_names();
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
        $track_templates['track_templates'] = $this->Admin_model->get_all_track_record_templates($admin_id);
        $track_records['track_records'] = $this->Admin_model->display_tracking_records(date('Y'), 30);
        $track_get_data = array_merge($hospital_users, $lab_names, $doc_list, $track_templates, $track_records);
        $this->load->view('templates/header-new');
        $this->load->view('display/record_tracking/search_trackingv3', $track_get_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Search Tracking
     *
     */
    public function record_search_tracking()
    {
        $hospital_users['hos_users'] = $this->Admin_model->get_hospital_groups();
        $lab_names['lab_names'] = $this->Admin_model->get_lab_names();
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
        $track_get_data = array_merge($hospital_users, $lab_names, $doc_list);
        $this->load->view('templates/header-new');
        $this->load->view('display/record_tracking/record_search_tracking', $track_get_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Record Tracking View
     *
     */
    public function record_tracking_view()
    {
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
        $specimen_type['specimen_type'] = $this->Admin_model->specimen_type();
        $track_view_data = array_merge($specimen_type, $doc_list);
        require_once('application/views/display/record_history/record_history-functions.php');
        $this->load->view('templates/header-new');
        $this->load->view('display/record_tracking/record_tracking_detail', $track_view_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Search Hospital Group Users
     *
     */
    public function search_hospital_group_users()
    {
        $encode_data = '';
        $json = array();
        if (isset($_POST)) {
            $hospital_id = $this->input->post('hospital_id');
            $clinic_user_id = $this->input->post('clinic_user_id');
            $hospital_users = $this->Admin_model->get_all_hospital_users_by_group($hospital_id);
            $clinic_username = '';
            if (!empty($clinic_user_id)) {
                $clinic_username = $this->get_uralensis_username($clinic_user_id);
            }
            if (!empty($hospital_users)) {
                $encode_data .= '<a href="javascript:;" class="show_clinic_users_btn">';
                $encode_data .= '<div class="tg-catagorytopic tg-users">';
                $encode_data .= '<i class="lnr lnr-users"></i>';
                $encode_data .= '<h3>Select Clinic Users</h3>';
                $encode_data .= '<span class="display_selected_option">' . $clinic_username . '</span>';
                $encode_data .= '<em>+</em>';
                $encode_data .= '</div>';
                $encode_data .= '</a>';
                $encode_data .= '<div class="show-data-holder" style="background: #2ecc71;">';
                $encode_data .= '<div class="show_clinic_users">';
                $encode_data .= '<div class="show_clinic_title">';
                $encode_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
                $encode_data .= '<h4><i class="lnr lnr-users"></i>Select Clinic User</h4>';
                $encode_data .= '</div>';
                $encode_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                foreach ($hospital_users as $value) {
                    $checked = '';
                    if ($value['id'] === $clinic_user_id) {
                        $checked = 'checked="checked"';
                    }
                    $encode_data .= '<div class="input-holder">';
                    $encode_data .= '<input ' . $checked . ' class="tat" data-clinicuser="' . $value['first_name'] . ' ' . $value['last_name'] . '" type="radio" id="hospital_user_id_' . $value['id'] . '" name="clinic_users" value="' . $value['id'] . '">';
                    $encode_data .= '<label for="hospital_user_id_' . $value['id'] . '">' . $value['first_name'] . ' ' . $value['last_name'] . '</label>';
                    $encode_data .= '</div>';
                }
                $encode_data .= '</div>';
                $encode_data .= '</div>';
                $encode_data .= '</div>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode_data;
                $json['msg'] = 'Users found in this clinic.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No user found in this clinic.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Set Track History Status
     *
     */
    public function set_admin_record_history_track_status()
    {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'received_from_lab') {
            $record_id = $this->input->post('record_id');
            $status_key = $this->input->post('track_status_key');
            $barcode_no = $this->input->post('barcode_no');
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
                'ura_rec_track_status' => $status_key, 'ura_rec_track_pathologist' => $pathologist_status,
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'booked_in') {
            $record_id = $this->input->post('record_id');
            $status_key = $this->input->post('track_status_key');
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => '12355-17',
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $json['type'] = 'success';
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'released') {
            $record_id = $this->input->post('record_id');
            $status_key = $this->input->post('track_status_key');
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => '12355-17',
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $json['type'] = 'success';
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'slides_booked_in') {
            $record_id = $this->input->post('record_id');
            $status_key = $this->input->post('track_status_key');
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => '12355-17',
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $json['type'] = 'success';
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'released_slides_back_to_lab') {
            $record_id = $this->input->post('record_id');
            $status_key = $this->input->post('track_status_key');
            $check_assign_stat = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array();
            if (empty($check_assign_stat)) {
                $pathologist_status = 'Not Assigned';
            } else {
                $pathologist_name = $this->get_uralensis_username($check_assign_stat['user_id']);
                $pathologist_status = $pathologist_name;
            }
            $track_data = array(
                'ura_rec_track_no' => '12355-17',
                'ura_rec_track_location' => !empty($get_lab_name['lab_name']) ? $get_lab_name['lab_name'] : '',
                'ura_rec_track_record_id' => intval($record_id),
                'ura_rec_track_status' => $status_key,
                'ura_rec_track_pathologist' => $pathologist_status,
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_status', $track_data);
            $json['type'] = 'success';
            $json['msg'] = 'Data updated successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Set the doctor add record permission.
     */
    public function set_doctor_add_record_perm()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('user_doc_rec_perm' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Set Permission for doctor
     * for the use of microdescription
     *
     */
    public function set_doctor_change_micro_perm()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('user_change_micro_codes' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Set Permission for doctor
     * for the use of microdescription
     *
     */
    public function set_doctor_change_view_other_records_perm()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('view_other_doctor_records' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Set Permission for doctor
     * for the use of microdescription
     *
     */
    public function set_surgeon_clinican_record_perm()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('user_derm_clinician_perm' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Set Permission for doctor
     * for the use of microdescription
     *
     */
    public function set_surgeon_clinican_role_assign()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $group_status = $this->input->post('group_status');
        $this->db->where('id', $user_id)->update('users', array('user_type' => $group_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Set hospital lab track permission
     *
     */
    public function set_hospiatl_lab_track_perm()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('user_doc_rec_perm' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Set hospital lab track permission
     *
     */
    public function set_hospiatl_user_specimen_permission()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('hospital_user_specimen_data' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Save Track Selected Options Template
     *
     */
    public function save_admin_track_template()
    {
        $json = array();
        if (isset($_POST)) {
            $user_id = $this->ion_auth->user()->row()->id;
            $temp_name = $this->input->post('input_name');
            $hospital_user = $this->input->post('hospital_user');
            $clinic_users = $this->input->post('clinic_users');
            $pathologist = $this->input->post('pathologist');
            $lab_name = $this->input->post('lab_name');
            $report_urgency = $this->input->post('report_urgency');
            $specimen_type = $this->input->post('specimen_type');
            $temp_data_array = array(
                'temp_input_name' => $temp_name,
                'temp_assignee_id' => $user_id,
                'temp_hospital_user' => $hospital_user,
                'temp_clinic_user' => $clinic_users,
                'temp_pathologist' => $pathologist,
                'temp_lab_name' => $lab_name,
                'temp_report_urgency' => $report_urgency,
                'temp_skin_type' => $specimen_type,
                'timestamp' => time()
            );
            $check_temp = $this->db->select('temp_input_name')->where('temp_input_name', "$temp_name")->get('uralensis_record_track_template')->row_array();
            if (!empty($check_temp['temp_input_name'])) {
                $json['type'] = 'error';
                $json['msg'] = 'This template is already added, please choose another name.';
                echo json_encode($json);
                die;
            } else {
                $this->db->insert('uralensis_record_track_template', $temp_data_array);
                $json['type'] = 'success';
                $json['msg'] = 'Template save successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Search record based on barcode scanner
     *
     */
    public function lab_search_barcode_record()
    {
        $json = array();
        $encode = '';
        $status_data_1 = '';
        $status_data_2 = '';
        $status_data_3 = '';
        if (isset($_POST)) {
            if (!empty($_POST['search_type']) && $_POST['search_type'] === 'ura_barcode_no') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('barcode');
                $msg = 'Barcode No';
            } else if (!empty($_POST['search_type']) && $_POST['search_type'] === 'serial_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_ul');
                $msg = 'Serial No';
            } else if (!empty($_POST['search_type']) && $_POST['search_type'] === 'lab_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_lab');
                $msg = 'Lab No';
            }
            $this->db->select('ura_rec_track_no,ura_rec_track_record_id,ura_rec_track_location,ura_rec_track_status,ura_rec_track_pathologist,timestamp');
            $this->db->from('request');
            $this->db->join('uralensis_record_track_status', 'request.uralensis_request_id = uralensis_record_track_status.ura_rec_track_record_id');
            $this->db->where($search_type, $search_term);
            $query = $this->db->get()->result_array();
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
     */
    public function set_laboratory_record_history_track_status()
    {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'book_out_to_lab_primary_release') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'book_out_to_lab_fw_completed') {
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
     * Search record based on barcode scanner
     *
     */
    public function doctor_search_barcode_record()
    {
        $json = array();
        $record_track_data = '';
        $encode_btn_data = '';
        if (isset($_POST)) {
            if (!empty($_POST['search_type']) && $_POST['search_type'] === 'ura_barcode_no') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('barcode');
                $msg = 'Barcode No';
            } else if (!empty($_POST['search_type']) && $_POST['search_type'] === 'serial_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_ul');
                $msg = 'Serial No';
            } else if (!empty($_POST['search_type']) && $_POST['search_type'] === 'lab_number') {
                $search_type = $this->input->post('search_type');
                $search_term = $this->input->post('track_no_lab');
                $msg = 'Lab No';
            }
            $this->db->select('ura_rec_track_no,ura_rec_track_record_id,ura_rec_track_location,ura_rec_track_status,ura_rec_track_pathologist,timestamp');
            $this->db->from('request');
            $this->db->join('uralensis_record_track_status', 'request.uralensis_request_id = uralensis_record_track_status.ura_rec_track_record_id');
            $this->db->where($search_type, $search_term);
            $query = $this->db->get()->result_array();
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
            $encode_btn_data .= '<hr>';
            $encode_btn_data .= '<div class="row">';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_slides_booked_in" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="slides_booked_in">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Slides Booked In</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_released_slides_back_to_lab" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="released_slides_back_to_lab">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Released Slides Back To Lab</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_received_from_lab" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="received_from_lab">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Received From Lab</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_draft_report" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="draft_report">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Draft Report</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<hr>';
            $encode_btn_data .= '<div class="row">';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_fw_request_ss" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="fw_request_ss">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>FW Request-SS</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_booked_out_to_lab_fw_completed" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="booked_out_to_lab_fw_completed">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Booked Out To Lab FW Completed</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_mdt" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="mdt">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>MDT</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_authorised" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="authorised">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Authorised</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<hr>';
            $encode_btn_data .= '<div class="row">';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_fw_request_immuno" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="fw_request_immuno">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>FW Request - Immuno</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '<div class="col-md-3">';
            $encode_btn_data .= '<a class="track_status_btn doctor_supplementary" href="javascript:;" data-barcode="' . $barcode . '" data-recordid="' . $record_id . '" data-statuskey="supplementary">';
            $encode_btn_data .= '<img src="' . base_url('assets/img/Reporting.png') . '">';
            $encode_btn_data .= '<span>Supplementary</span>';
            $encode_btn_data .= '</a>';
            $encode_btn_data .= '</div>';
            $encode_btn_data .= '</div>';
            $record_track_data .= '<table class="table">';
            $record_track_data .= '<tr class="bg-primary">';
            $record_track_data .= '<th>Track No.</th>';
            $record_track_data .= '<th>Time/Date</th>';
            $record_track_data .= '<th>Location</th>';
            $record_track_data .= '<th>Status</th>';
            $record_track_data .= '<th>Pathologist</th>';
            $record_track_data .= '</tr>';
            if (!empty($query)) {
                foreach ($query as $data) {
                    $record_track_data .= '<tr class="bg-info">';
                    $record_track_data .= '<td>' . $data['ura_rec_track_no'] . '</td>';
                    $record_track_data .= '<td>' . date('h:i, d/m/Y', $data['timestamp']) . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_location'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_status'] . '</td>';
                    $record_track_data .= '<td>' . $data['ura_rec_track_pathologist'] . '</td>';
                    $record_track_data .= '</tr>';
                }
                $record_track_data .= '</table>';
                $json['type'] = 'success';
                $json['track_data'] = $record_track_data;
                $json['btn_data'] = $encode_btn_data;
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
     */
    public function set_doctor_record_history_track_status()
    {
        $json = array();
        $record_track_data = '';
        $record_id = $this->input->post('record_id');
        $get_lab_name = $this->db->select('lab_name')->where('uralensis_request_id', $record_id)->get('request')->row_array();
        if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'slides_booked_in') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'released_slides_back_to_lab') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'received_from_lab') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'draft_report') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'fw_request_ss') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'booked_out_to_lab_fw_completed') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'mdt') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'authorised') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'fw_request_immuno') {
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
        } else if (!empty($_POST['record_id']) && $_POST['track_status_key'] === 'supplementary') {
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
     * Set hospital tat dates data.
     *
     */
    public function set_hospital_tat_dates_data()
    {
        $json = array();
        if (isset($_POST)) {
            if (empty($_POST['tat_hospital'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the hospital first.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['tat_date'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please select the TAT date procedure.';
                echo json_encode($json);
                die;
            }
            $hospital_id = $this->input->post('tat_hospital');
            $tat_date = $this->input->post('tat_date');
            $check_tat_data = $this->db->where('ura_tat_hospital_id', $hospital_id)->get('uralensis_tat_settings')->row();
            if (empty($check_tat_data)) {
                $tat_data = array(
                    'ura_tat_hospital_id' => intval($hospital_id),
                    'ura_tat_date_data' => $tat_date,
                    'timestamp' => time()
                );
                $this->db->insert('uralensis_tat_settings', $tat_data);
                $json['type'] = 'success';
                $json['msg'] = 'TAT Setting save successfully.';
                echo json_encode($json);
                die;
            } else {
                $tat_data = array(
                    'ura_tat_hospital_id' => intval($hospital_id),
                    'ura_tat_date_data' => $tat_date,
                    'timestamp' => time()
                );
                $this->db->where('ura_tat_hospital_id', $hospital_id);
                $this->db->update('uralensis_tat_settings', $tat_data);
                $json['type'] = 'success';
                $json['msg'] = 'TAT setting update successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Save Hospital Invoicing Option
     *
     */
    public function save_hospital_invoice_cost_opt()
    {
        $json = array();
        if (!empty($_POST)) {
            if (empty($_POST['inv_hospital'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please Select the hospital first.';
                echo json_encode($json);
                die;
            }
            if (!empty($_POST['checkbox_val']) && $_POST['checkbox_val'] === 'false') {
                if (empty($_POST['hos_cost_code_name_without_tat'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter the cost code name.';
                    echo json_encode($json);
                    die;
                }
                if (empty($_POST['hos_cost_code_price'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter the cost code price.';
                    echo json_encode($json);
                    die;
                }
                if (!intval($_POST['hos_cost_code_price'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter only integer value.';
                    echo json_encode($json);
                    die;
                }
                if (empty($_POST['hos_cost_code_desc'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter the cost code description.';
                    echo json_encode($json);
                    die;
                }
            } else {
                if (empty($_POST['hos_cost_code_name'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter the cost code name.';
                    echo json_encode($json);
                    die;
                }
                if (empty($_POST['hos_cost_code_price_1_to_6'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter the cost code price.';
                    echo json_encode($json);
                    die;
                }
                if (!intval($_POST['hos_cost_code_price_1_to_6'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter only integer value.';
                    echo json_encode($json);
                    die;
                }
                if (empty($_POST['hos_cost_code_price_7_to_abv'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter the cost code price.';
                    echo json_encode($json);
                    die;
                }
                if (!intval($_POST['hos_cost_code_price_7_to_abv'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please enter only integer value.';
                    echo json_encode($json);
                    die;
                }
            }
            $tat_check = $this->input->post('checkbox_val');
            if (!empty($_POST['checkbox_val']) && $_POST['checkbox_val'] === 'false') {
                $cost_name = $this->input->post('hos_cost_code_name_without_tat');
                $cost_price = $this->input->post('hos_cost_code_price');
                $cost_desc = $this->input->post('hos_cost_code_desc');
                $data_array = array(
                    'cost_code_name' => $cost_name,
                    'cost_code_price' => $cost_price,
                    'cost_code_desc' => $cost_desc
                );
            } else {
                $cost_name = $this->input->post('hos_cost_code_name');
                $cost_price_1to6 = $this->input->post('hos_cost_code_price_1_to_6');
                $cost_desc_1to6 = $this->input->post('hos_cost_code_desc_1_to_6');
                $cost_price_7toabv = $this->input->post('hos_cost_code_price_7_to_abv');
                $cost_desc_7toabv = $this->input->post('hos_cost_code_desc_7_to_abv');
                $data_array = array();
                $data_array[$cost_name]['tat_1_to_6']['cost_code_price'] = $cost_price_1to6;
                $data_array[$cost_name]['tat_1_to_6']['cost_code_desc'] = $cost_desc_1to6;
                $data_array[$cost_name]['tat_7_to_above']['cost_code_price'] = $cost_price_7toabv;
                $data_array[$cost_name]['tat_7_to_above']['cost_code_desc'] = $cost_desc_7toabv;
                $data_array[$cost_name]['timestamp'] = time();
            }
            $hospital_id = $this->input->post('inv_hospital');
            $db_data_array = array(
                'ura_hos_id' => $hospital_id,
                'ura_hos_opt' => serialize($data_array),
                'ura_tat_option' => $tat_check,
                'timestamp' => time()
            );
            $check_record = $this->db->where('ura_hos_id', $hospital_id)->get('uralensis_hospital_inovice_opt')->row_array();
            if (!empty($check_record)) {
                if ($check_record['ura_tat_option'] === 'true') {
                    $tat_opt = unserialize($check_record['ura_hos_opt']);
                    if (!empty($tat_opt) && array_key_exists($cost_name, $tat_opt)) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This Cost Code is already existed with this name.';
                        echo json_encode($json);
                        die;
                    } else {
                        $new_data_array = array();
                        $new_data_array[$cost_name]['tat_1_to_6']['cost_code_price'] = $cost_price_1to6;
                        $new_data_array[$cost_name]['tat_1_to_6']['cost_code_desc'] = $cost_desc_1to6;
                        $new_data_array[$cost_name]['tat_7_to_above']['cost_code_price'] = $cost_price_7toabv;
                        $new_data_array[$cost_name]['tat_7_to_above']['cost_code_desc'] = $cost_desc_7toabv;
                        $new_data_array[$cost_name]['timestamp'] = time();
                        $tat_merge_array = array_merge($tat_opt, $new_data_array);
                        $new_db_data_array = array(
                            'ura_hos_id' => $hospital_id,
                            'ura_hos_opt' => serialize($tat_merge_array),
                            'ura_tat_option' => $tat_check,
                            'timestamp' => time()
                        );
                        $this->db->where('ura_hos_id', $hospital_id);
                        $this->db->update('uralensis_hospital_inovice_opt', $new_db_data_array);
                    }
                } else {
                    $this->db->where('ura_hos_id', $hospital_id);
                    $this->db->update('uralensis_hospital_inovice_opt', $db_data_array);
                }
                $json['type'] = 'success';
                $json['msg'] = 'Invoice Options Successfully Updated.';
                echo json_encode($json);
                die;
            } else {
                $this->db->insert('uralensis_hospital_inovice_opt', $db_data_array);
                $json['type'] = 'success';
                $json['msg'] = 'Invoice Options Successfully Added.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Load Hospital Invoice Option Data
     *
     */
    public function load_hospital_invoice_opt_data()
    {
        $json = array();
        $encode = '';
        if (isset($_POST)) {
            $hospital_id = $this->input->post('hospital_id');
            $hos_inv_data = $this->Admin_model->get_hos_inv_opt_data($hospital_id);
            if (!empty($hos_inv_data)) {
                $inv_opt_data = unserialize($hos_inv_data['ura_hos_opt']);
                $encode .= '<hr>';
                $encode .= '<table class="table table-bordered">';
                if ($hos_inv_data['ura_tat_option'] === 'true') {
                    $encode .= '<tr class="bg-primary">';
                    $encode .= '<th>Default</th>';
                    $encode .= '<th>Name</th>';
                    $encode .= '<th colspan="2">TAT 1 - 6</th>';
                    $encode .= '<th colspan="2">TAT 7 - Above</th>';
                    $encode .= '<th>Timestamp</th>';
                    $encode .= '<th colspan="2">Actions</th>';
                    $encode .= '</tr>';
                    $counter = 0;
                    foreach ($inv_opt_data as $key => $value) {
                        $checked = '';
                        if (!empty($value['make_default']) && $value['make_default'] === 'on') {
                            $checked = 'checked';
                        }
                        $encode .= '<tr>';
                        $encode .= '<td><input ' . $checked . ' type="radio" name="make_default" data-tatid="' . $hos_inv_data['ura_hos_inv_id'] . '" value="' . $key . '"></td>';
                        $encode .= '<td>' . $key . '</td>';
                        $encode .= '<td>Price: ' . $value['tat_1_to_6']['cost_code_price'] . '</td>';
                        $encode .= '<td>Desc: ' . $value['tat_1_to_6']['cost_code_desc'] . '</td>';
                        $encode .= '<td>Price: ' . $value['tat_7_to_above']['cost_code_price'] . '</td>';
                        $encode .= '<td>Desc: ' . $value['tat_7_to_above']['cost_code_desc'] . '</td>';
                        $encode .= '<td>' . date('d/m/Y H:i:s', $value['timestamp']) . '</td>';
                        $encode .= '<td>';
                        $encode .= '<a href="javascript:;" data-toggle="modal" data-target="#tat_true_modal_' . $counter . '"><img src="' . base_url('assets/img/edit.png') . '"></a>';
                        $encode .= '<div id="tat_true_modal_' . $counter . '" class="modal fade" role="dialog">';
                        $encode .= '<div class="modal-dialog">';
                        $encode .= '<div class="modal-content">';
                        $encode .= '<div class="modal-header">';
                        $encode .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                        $encode .= '<h4 class="modal-title"></h4>';
                        $encode .= '</div>';
                        $encode .= '<div class="modal-body text-left">';
                        $encode .= '<form class="form update_tat_opt_data_form_' . $counter . '">';
                        if (!empty($value['tat_1_to_6'])) {
                            $encode .= '<div class="well">';
                            $encode .= '<h3 class="text-center">TAT 1 to 6 Settings</h3>';
                            $encode .= '<div class="form-group">';
                            $encode .= '<label>Cost Code Price</label>';
                            $encode .= '<input class="form-control" type="text" name="tat_1_to_6[cost_code_price]" value="' . $value['tat_1_to_6']['cost_code_price'] . '">';
                            $encode .= '</div>';
                            $encode .= '<div class="form-group">';
                            $encode .= '<label>Cost Code Description</label>';
                            $encode .= '<textarea class="form-control" name="tat_1_to_6[cost_code_desc]">' . $value['tat_1_to_6']['cost_code_desc'] . '</textarea>';
                            $encode .= '</div>';
                            $encode .= '</div>';
                        }
                        if (!empty($value['tat_7_to_above'])) {
                            $encode .= '<div class="well">';
                            $encode .= '<h3 class="text-center">TAT 7 to above Settings</h3>';
                            $encode .= '<div class="form-group">';
                            $encode .= '<label>Cost Code Price</label>';
                            $encode .= '<input class="form-control" type="text" name="tat_7_to_above[cost_code_price]" value="' . $value['tat_7_to_above']['cost_code_price'] . '">';
                            $encode .= '</div>';
                            $encode .= '<div class="form-group">';
                            $encode .= '<label>Cost Code Description</label>';
                            $encode .= '<textarea class="form-control" name="tat_7_to_above[cost_code_desc]">' . $value['tat_7_to_above']['cost_code_desc'] . '</textarea>';
                            $encode .= '</div>';
                            $encode .= '</div>';
                        }
                        $encode .= '<div class="form-group">';
                        $encode .= '<input type="hidden" name="code_name" value="' . $key . '">';
                        $encode .= '<input type="hidden" name="tat_option" value="' . $hos_inv_data['ura_tat_option'] . '">';
                        $encode .= '<input type="hidden" name="tat_id" value="' . $hos_inv_data['ura_hos_inv_id'] . '">';
                        $encode .= '<button class="btn btn-primary update_tat_opt_data_btn_' . $counter . '">Update</button>';
                        $encode .= '</div>';
                        $encode .= '
                            <script>
                                $(document).ready(function(){
                                    $(document).on("click", ".update_tat_opt_data_btn_' . $counter . '", function (e) {
                                        e.preventDefault();
                                        var _this = $(this);
                                        var form_data = $(".update_tat_opt_data_form_' . $counter . '").serialize();

                                        $.ajax({
                                            url: "' . base_url('/index.php/admin/update_hospital_invoice_opt_data') . '",
                                            type: "POST",
                                            dataType: "json",
                                            data: form_data,
                                            success: function (response) {
                                                if (response.type === "success") {
                                                    jQuery.sticky(response.msg, {classList: "success", speed: 200, autoclose: 7000});
                                                    setTimeout(function () {
                                                        window.location.reload();
                                                    }, 2000);
                                                } else {
                                                    jQuery.sticky(response.msg, {classList: "important", speed: 200, autoclose: 7000});
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        ';
                        $encode .= '</form>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</td>';
                        $encode .= '<td><a data-codename="' . $key . '" data-tatid="' . $hos_inv_data['ura_hos_inv_id'] . '" class="delete_tat_inv_opt" href="javascript:;"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                        $encode .= '</tr>';
                        $counter++;
                    }
                    $encode .= '</tr>';
                } else {
                    $encode .= '<tr class="bg-primary">';
                    $encode .= '<th>TAT</th>';
                    $encode .= '<th colspan="3">Cost Rate<br>Name | Price | Description</th>';
                    $encode .= '<th>Timestamp</th>';
                    $encode .= '<th colspan="2">Actions</th>';
                    $encode .= '</tr>';
                    $encode .= '<tr>';
                    $encode .= '<td>False</td>';
                    $encode .= '<td>' . $inv_opt_data['cost_code_name'] . '</td>';
                    $encode .= '<td>' . $inv_opt_data['cost_code_price'] . '</td>';
                    $encode .= '<td>' . $inv_opt_data['cost_code_desc'] . '</td>';
                    $encode .= '<td>' . date('d/m/Y H:i:s', $hos_inv_data['timestamp']) . '</td>';
                    $encode .= '<td>';
                    $encode .= '<a href="javascript:;" data-toggle="modal" data-target="#tat_false_modal"><img src="' . base_url('assets/img/edit.png') . '"></a>';
                    $encode .= '<div id="tat_false_modal" class="modal fade" role="dialog">';
                    $encode .= '<div class="modal-dialog">';
                    $encode .= '<div class="modal-content">';
                    $encode .= '<div class="modal-header">';
                    $encode .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    $encode .= '<h4 class="modal-title"></h4>';
                    $encode .= '</div>';
                    $encode .= '<div class="modal-body text-left">';
                    $encode .= '<form class="form update_tat_opt_data_form">';
                    $encode .= '<div class="form-group">';
                    $encode .= '<label>Cost Code Name</label>';
                    $encode .= '<input class="form-control" type="text" name="hos_cost_code_name" value="' . $inv_opt_data['cost_code_name'] . '">';
                    $encode .= '</div>';
                    $encode .= '<div class="form-group">';
                    $encode .= '<label>Cost Code Price</label>';
                    $encode .= '<input class="form-control" type="text" name="hos_cost_code_price" value="' . $inv_opt_data['cost_code_price'] . '">';
                    $encode .= '</div>';
                    $encode .= '<div class="form-group">';
                    $encode .= '<label>Cost Code Description</label>';
                    $encode .= '<textarea class="form-control" type="text" name="hos_cost_code_desc">' . $inv_opt_data['cost_code_desc'] . '</textarea>';
                    $encode .= '</div>';
                    $encode .= '<div class="form-group">';
                    $encode .= '<input type="hidden" name="tat_option" value="' . $hos_inv_data['ura_tat_option'] . '">';
                    $encode .= '<input type="hidden" name="tat_id" value="' . $hos_inv_data['ura_hos_inv_id'] . '">';
                    $encode .= '<button class="btn btn-primary update_tat_opt_data_btn">Update</button>';
                    $encode .= '</div>';
                    $encode .= '</form>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</div>';
                    $encode .= '</td>';
                    $encode .= '<td><a data-codename="" data-tatid="' . $hos_inv_data['ura_hos_inv_id'] . '" class="delete_tat_inv_opt" href="javascript:;"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                    $encode .= '</tr>';
                }
                $encode .= '</table>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['msg'] = 'Invoice TAT Option Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Invoice TAT Option Found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Set Code Name Default
     *
     */
    public function set_code_name_default()
    {
        $json = array();
        if (isset($_POST)) {
            $tat_opt_id = $this->input->post('tat_id');
            $tat_code = $this->input->post('make_default');
            $tat_data = $this->db->select('ura_hos_opt')->where('ura_hos_inv_id', $tat_opt_id)->get('uralensis_hospital_inovice_opt')->row_array()['ura_hos_opt'];
            $tat_data_array = unserialize($tat_data);
            $merge_tat_array = array();
            foreach ($tat_data_array as $key => $value) {
                $merge_tat_array[$key] = $value;
                unset($merge_tat_array[$key]['make_default']);
                if ($tat_code === $key) {
                    $merge_tat_array[$key]['make_default'] = 'on';
                }
            }
            $this->db->where('ura_hos_inv_id', $tat_opt_id)->update('uralensis_hospital_inovice_opt', array('ura_hos_opt' => serialize($merge_tat_array)));
            $json['type'] = 'success';
            $json['msg'] = $tat_code . ' is defualt now.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete TAT Option Data
     *
     */
    public function delete_hospital_invoice_opt_data()
    {
        $json = array();
        if (isset($_POST)) {
            $tat_id = $this->input->post('tat_id');
            $code_name = $this->input->post('code_name');
            $hos_inv_opt = $this->db->select('ura_hos_opt')->where('ura_hos_inv_id', $tat_id)->get('uralensis_hospital_inovice_opt')->row_array()['ura_hos_opt'];
            $inv_opt_data = unserialize($hos_inv_opt);
            if (count($inv_opt_data) <= 1) {
                $this->db->where('ura_hos_inv_id', $tat_id)->delete('uralensis_hospital_inovice_opt');
            } else {
                unset($inv_opt_data[$code_name]);
                $this->db->where('ura_hos_inv_id', $tat_id)->update('uralensis_hospital_inovice_opt', array('ura_hos_opt' => serialize($inv_opt_data)));
            }
            $json['type'] = 'success';
            $json['msg'] = 'TAT Option deleted successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update Hospital Invoice Data
     *
     */
    public function update_hospital_invoice_opt_data()
    {
        $json = array();
        if (isset($_POST)) {
            $tat_id = $this->input->post('tat_id');
            $cost_code_name = $this->input->post('code_name');
            $tat_option = $this->input->post('tat_option');
            if ($tat_option === 'false') {
                $cost_name = $this->input->post('hos_cost_code_name');
                $cost_price = $this->input->post('hos_cost_code_price');
                $cost_desc = $this->input->post('hos_cost_code_desc');
                if (!is_numeric($_POST['hos_cost_code_price'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Price must be in integers.';
                    echo json_encode($json);
                    die;
                }
                $cost_array = array(
                    'cost_code_name' => $cost_name,
                    'cost_code_price' => $cost_price,
                    'cost_code_desc' => $cost_desc
                );
                $data_array = array(
                    'ura_hos_opt' => serialize($cost_array),
                    'timestamp' => time()
                );
                $this->db->where('ura_hos_inv_id', $tat_id)->update('uralensis_hospital_inovice_opt', $data_array);
                $json['type'] = 'success';
                $json['msg'] = 'TAT Invoice Data Updated Successfully.';
                echo json_encode($json);
                die;
            } else {
                $cost_codes = $this->db->select('ura_hos_opt')->where('ura_hos_inv_id', $tat_id)->get('uralensis_hospital_inovice_opt')->row_array()['ura_hos_opt'];
                $cost_codes_array = unserialize($cost_codes);
                if (!is_numeric($_POST['tat_1_to_6']['cost_code_price'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Price must be in integers.';
                    echo json_encode($json);
                    die;
                }
                if (!is_numeric($_POST['tat_7_to_above']['cost_code_price'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Price must be in integers.';
                    echo json_encode($json);
                    die;
                }
                $cost_array['tat_1_to_6']['cost_code_price'] = $_POST['tat_1_to_6']['cost_code_price'];
                $cost_array['tat_1_to_6']['cost_code_desc'] = $_POST['tat_1_to_6']['cost_code_desc'];
                $cost_array['tat_7_to_above']['cost_code_price'] = $_POST['tat_7_to_above']['cost_code_price'];
                $cost_array['tat_7_to_above']['cost_code_desc'] = $_POST['tat_7_to_above']['cost_code_desc'];
                $cost_array['timestamp'] = $cost_codes_array[$cost_code_name]['timestamp'];
                if (!empty($cost_codes_array[$cost_code_name]['make_default'])) {
                    $cost_array['make_default'] = $cost_codes_array[$cost_code_name]['make_default'];
                }
                $cost_codes_array[$cost_code_name] = $cost_array;
                $this->db->where('ura_hos_inv_id', $tat_id)->update('uralensis_hospital_inovice_opt', array('ura_hos_opt' => serialize($cost_codes_array)));
                $json['type'] = 'success';
                $json['msg'] = 'TAT Invoice Data Updated Successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Doctor Incoice Option Data Code Start
     * Save Doctor Invoicing Option
     *
     */
    public function save_doctor_invoice_cost_opt()
    {
        $json = array();
        if (!empty($_POST)) {
            if (empty($_POST['doctors_list'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please Select the doctor first.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['inv_hospital'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please Select the hospital first.';
                echo json_encode($json);
                die;
            }
            if (!empty($_POST['checkbox_val']) && $_POST['checkbox_val'] === 'false') {
                if (empty($_POST['hos_inv_routine_rate'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please Enter the routine price.';
                    echo json_encode($json);
                    die;
                }
                if (empty($_POST['hos_inv_alopecia_rate'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please Enter the alopecia price.';
                    echo json_encode($json);
                    die;
                }
                if (empty($_POST['hos_inv_imf_rate'])) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Please Enter the imf price.';
                    echo json_encode($json);
                    die;
                }
            }
            $tat_check = $this->input->post('checkbox_val');
            $tat_duration = '';
            if (!empty($_POST['checkbox_val']) && $_POST['checkbox_val'] === 'false') {
                $routine_rate = $this->input->post('hos_inv_routine_rate');
                $alopecia_rate = $this->input->post('hos_inv_alopecia_rate');
                $imf_rate = $this->input->post('hos_inv_imf_rate');
                $data_array = array(
                    'routine_rate' => $routine_rate,
                    'alopecia_rate' => $alopecia_rate,
                    'imf_rate' => $imf_rate
                );
            } else {
                $hos_inv_tat = $this->input->post('doc_inv_tat');
                $tat_duration = $this->input->post('tat_duration');
                $routine_rate = $this->input->post('hos_inv_routine_rate');
                $alopecia_rate = $this->input->post('hos_inv_alopecia_rate');
                $imf_rate = $this->input->post('hos_inv_imf_rate');
                $data_array['tat_check'] = $hos_inv_tat;
                $data_array[$tat_duration]['routine_rate'] = $routine_rate;
                $data_array[$tat_duration]['alopecia_rate'] = $alopecia_rate;
                $data_array[$tat_duration]['imf_rate'] = $imf_rate;
            }
            $hospital_id = $this->input->post('inv_hospital');
            $doctor_id = $this->input->post('doctors_list');
            $db_data_array = array(
                'ura_hos_id' => $hospital_id,
                'ura_doc_id' => $doctor_id,
                'ura_hos_opt' => serialize($data_array),
                'ura_tat_option' => $tat_check,
                'timestamp' => time()
            );
            $check_record = $this->db->where('ura_doc_id', $doctor_id)->where('ura_hos_id', $hospital_id)->get('uralensis_doctor_inovice_opt')->row_array();
            if (!empty($check_record)) {
                if ($check_record['ura_tat_option'] === 'true') {
                    $tat_opt = unserialize($check_record['ura_hos_opt']);
                    if (!empty($tat_opt) && !empty($tat_opt[$tat_duration])) {
                        $new_tat_opt[$tat_duration]['routine_rate'] = $routine_rate;
                        $new_tat_opt[$tat_duration]['alopecia_rate'] = $alopecia_rate;
                        $new_tat_opt[$tat_duration]['imf_rate'] = $imf_rate;
                        $tat_merge_array = array_merge($tat_opt, $new_tat_opt);
                        $new_db_data_array = array(
                            'ura_hos_id' => $hospital_id,
                            'ura_doc_id' => $doctor_id,
                            'ura_hos_opt' => serialize($tat_merge_array),
                            'ura_tat_option' => $tat_check,
                            'timestamp' => time()
                        );
                        $this->db->where('ura_doc_id', $doctor_id);
                        $this->db->where('ura_hos_id', $hospital_id);
                        $this->db->update('uralensis_doctor_inovice_opt', $new_db_data_array);
                    } else {
                        $new_tat_opt[$tat_duration]['routine_rate'] = $routine_rate;
                        $new_tat_opt[$tat_duration]['alopecia_rate'] = $alopecia_rate;
                        $new_tat_opt[$tat_duration]['imf_rate'] = $imf_rate;
                        $tat_merge_array = array_merge($tat_opt, $new_tat_opt);
                        $new_db_data_array = array(
                            'ura_hos_id' => $hospital_id,
                            'ura_doc_id' => $doctor_id,
                            'ura_hos_opt' => serialize($tat_merge_array),
                            'ura_tat_option' => $tat_check,
                            'timestamp' => time()
                        );
                        $this->db->where('ura_doc_id', $doctor_id);
                        $this->db->where('ura_hos_id', $hospital_id);
                        $this->db->update('uralensis_doctor_inovice_opt', $new_db_data_array);
                    }
                } else {
                    $this->db->where('ura_doc_id', $doctor_id);
                    $this->db->where('ura_hos_id', $hospital_id);
                    $this->db->update('uralensis_doctor_inovice_opt', $db_data_array);
                }
                $json['type'] = 'success';
                $json['msg'] = 'Invoice Options Successfully Updated.';
                echo json_encode($json);
                die;
            } else {
                $this->db->insert('uralensis_doctor_inovice_opt', $db_data_array);
                $json['type'] = 'success';
                $json['msg'] = 'Invoice Options Successfully Added.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Load Hospital Invoice Option Data
     *
     */
    public function load_doctor_invoice_opt_data()
    {
        $json = array();
        $encode = '';
        if (isset($_POST)) {
            $doctor_id = $this->input->post('doctor_id');
            $hos_inv_data = $this->Admin_model->get_doc_inv_opt_data($doctor_id);
            if (!empty($hos_inv_data)) {
                $encode .= '<hr>';
                $encode .= '<table class="table table-bordered">';
                $encode .= '<tr class="bg-primary">';
                $encode .= '<th>TAT</th>';
                $encode .= '<th>Doctor</th>';
                $encode .= '<th colspan="3">Cost Rate<br>Routine | Alopecia | IMF</th>';
                $encode .= '<th>Timestamp</th>';
                $encode .= '<th colspan="2">Actions</th>';
                $encode .= '</tr>';
                foreach ($hos_inv_data as $key => $doctor_inv) {
                    $inv_opt_data = unserialize($doctor_inv['ura_hos_opt']);
                    if ($doctor_inv['ura_tat_option'] === 'true') {
                        $encode .= '<tr class="bg-primary">';
                        $encode .= '<th>TAT</th>';
                        $encode .= '<th>Doctor</th>';
                        $encode .= '<th colspan="3">TAT 1 - 3 </th>';
                        $encode .= '<th colspan="3">TAT 4 - 6 </th>';
                        $encode .= '<th>Timestamp</th>';
                        $encode .= '<th colspan="2">Actions</th>';
                        $encode .= '</tr>';
                        $encode .= '<tr>';
                        $encode .= '<td>True</td>';
                        $encode .= '<td>' . $this->get_uralensis_username($doctor_inv['ura_doc_id']) . '</td>';
                        $encode .= '<td>' . $inv_opt_data['tat_1_to_3']['routine_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['tat_1_to_3']['alopecia_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['tat_1_to_3']['imf_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['tat_4_to_6']['routine_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['tat_4_to_6']['alopecia_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['tat_4_to_6']['imf_rate'] . '</td>';
                        $encode .= '<td>' . date('d/m/Y H:i:s', $doctor_inv['timestamp']) . '</td>';
                        $encode .= '<td>';
                        $encode .= '<a href="javascript:;" data-toggle="modal" data-target="#tat_true_modal_' . $doctor_inv['ura_doc_inv_id'] . '"><img src="' . base_url('assets/img/edit.png') . '"></a>';
                        $encode .= '<div id="tat_true_modal_' . $doctor_inv['ura_doc_inv_id'] . '" class="modal fade" role="dialog">';
                        $encode .= '<div class="modal-dialog">';
                        $encode .= '<div class="modal-content">';
                        $encode .= '<div class="modal-header">';
                        $encode .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                        $encode .= '<h4 class="modal-title"></h4>';
                        $encode .= '</div>';
                        $encode .= '<div class="modal-body text-left">';
                        $encode .= '<form class="form update_tat_doc_opt_data_form">';
                        $encode .= '<div class="well">';
                        $encode .= '<h3 class="text-center">TAT 1 - 3 Settings</h3>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="tat_1_to_3[routine_rate]" value="' . $inv_opt_data['tat_1_to_3']['routine_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="tat_1_to_3[alopecia_rate]" value="' . $inv_opt_data['tat_1_to_3']['alopecia_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="tat_1_to_3[imf_rate]" value="' . $inv_opt_data['tat_1_to_3']['imf_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '<div class="well">';
                        $encode .= '<h3 class="text-center">TAT 4 - 6 Settings</h3>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="tat_4_to_6[routine_rate]" value="' . $inv_opt_data['tat_4_to_6']['routine_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="tat_4_to_6[alopecia_rate]" value="' . $inv_opt_data['tat_4_to_6']['alopecia_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="tat_4_to_6[imf_rate]" value="' . $inv_opt_data['tat_4_to_6']['imf_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<input type="hidden" name="tat_option" value="' . $doctor_inv['ura_tat_option'] . '">';
                        $encode .= '<input type="hidden" name="tat_id" value="' . $doctor_inv['ura_doc_inv_id'] . '">';
                        $encode .= '<button class="btn btn-primary update_tat_doc_opt_data_btn">Update</button>';
                        $encode .= '</div>';
                        $encode .= '</form>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</td>';
                        $encode .= '<td><a data-tatid="' . $doctor_inv['ura_doc_inv_id'] . '" class="delete_doc_tat_inv_opt" href="javascript:;"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                        $encode .= '</tr>';
                    } else {
                        $encode .= '<tr>';
                        $encode .= '<td>False</td>';
                        $encode .= '<td>' . $this->get_uralensis_username($doctor_inv['ura_doc_id']) . '</td>';
                        $encode .= '<td>' . $inv_opt_data['routine_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['alopecia_rate'] . '</td>';
                        $encode .= '<td>' . $inv_opt_data['imf_rate'] . '</td>';
                        $encode .= '<td>' . date('d/m/Y H:i:s', $doctor_inv['timestamp']) . '</td>';
                        $encode .= '<td>';
                        $encode .= '<a href="javascript:;" data-toggle="modal" data-target="#tat_false_modal_' . $doctor_inv['ura_doc_inv_id'] . '"><img src="' . base_url('assets/img/edit.png') . '"></a>';
                        $encode .= '<div id="tat_false_modal_' . $doctor_inv['ura_doc_inv_id'] . '" class="modal fade" role="dialog">';
                        $encode .= '<div class="modal-dialog">';
                        $encode .= '<div class="modal-content">';
                        $encode .= '<div class="modal-header">';
                        $encode .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                        $encode .= '<h4 class="modal-title"></h4>';
                        $encode .= '</div>';
                        $encode .= '<div class="modal-body text-left">';
                        $encode .= '<form class="form update_tat_doc_opt_data_form">';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Routine Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="hos_inv_routine_rate" value="' . $inv_opt_data['routine_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>Alopecia Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="hos_inv_alopecia_rate" value="' . $inv_opt_data['alopecia_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<label>IMF Per Case Rate</label>';
                        $encode .= '<input class="form-control" type="text" name="hos_inv_imf_rate" value="' . $inv_opt_data['imf_rate'] . '">';
                        $encode .= '</div>';
                        $encode .= '<div class="form-group">';
                        $encode .= '<input type="hidden" name="tat_option" value="' . $doctor_inv['ura_tat_option'] . '">';
                        $encode .= '<input type="hidden" name="tat_id" value="' . $doctor_inv['ura_doc_inv_id'] . '">';
                        $encode .= '<button class="btn btn-primary update_tat_doc_opt_data_btn">Update</button>';
                        $encode .= '</div>';
                        $encode .= '</form>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</div>';
                        $encode .= '</td>';
                        $encode .= '<td><a data-tatid="' . $doctor_inv['ura_doc_inv_id'] . '" class="delete_doc_tat_inv_opt" href="javascript:;"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                        $encode .= '</tr>';
                    }
                }
                $encode .= '</table>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['msg'] = 'Invoice TAT Option Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Invoice TAT Option Found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Delete TAT Option Data
     *
     */
    public function delete_doctor_invoice_opt_data()
    {
        $json = array();
        if (isset($_POST)) {
            $tat_id = $this->input->post('tat_id');
            $this->db->where('ura_doc_inv_id', $tat_id)->delete('uralensis_doctor_inovice_opt');
            $json['type'] = 'success';
            $json['msg'] = 'TAT Option deleted successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update Hospital Invoice Data
     *
     */
    public function update_doctor_invoice_opt_data()
    {
        $json = array();
        if (isset($_POST)) {
            $tat_id = $this->input->post('tat_id');
            $tat_option = $this->input->post('tat_option');
            if ($tat_option === 'false') {
                $routine_rate = $this->input->post('hos_inv_routine_rate');
                $alopecia_rate = $this->input->post('hos_inv_alopecia_rate');
                $imf_rate = $this->input->post('hos_inv_imf_rate');
                $tat_cost_array = array(
                    'routine_rate' => $routine_rate,
                    'alopecia_rate' => $alopecia_rate,
                    'imf_rate' => $imf_rate
                );
                $data_array = array(
                    'ura_hos_opt' => serialize($tat_cost_array),
                    'timestamp' => time()
                );
                $this->db->where('ura_doc_inv_id', $tat_id)->update('uralensis_doctor_inovice_opt', $data_array);
                $json['type'] = 'success';
                $json['msg'] = 'TAT Invoice Data Updated Successfully.';
                echo json_encode($json);
                die;
            } else {
                $tat_less_5 = $this->input->post('tat_less_5');
                $tat_less_10 = $this->input->post('tat_less_10');
                $tat_less_20 = $this->input->post('tat_less_20');
                $tat_great_20 = $this->input->post('tat_great_20');
                $tat_cost_array = array(
                    'tat_check' => 'on',
                    'tat_less_5' => $tat_less_5,
                    'tat_less_10' => $tat_less_10,
                    'tat_less_20' => $tat_less_20,
                    'tat_great_20' => $tat_great_20,
                );
                $data_array = array(
                    'ura_hos_opt' => serialize($tat_cost_array),
                    'timestamp' => time()
                );
                $this->db->where('ura_doc_inv_id', $tat_id)->update('uralensis_doctor_inovice_opt', $data_array);
                $json['type'] = 'success';
                $json['msg'] = 'TAT Invoice Data Updated Successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Save doctor invoice settings
     *
     */
    public function save_doctor_invoice_template_settings()
    {
        $json = array();
        if (isset($_POST)) {
            if (empty($_POST['doctors_list'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please choose the doctor first.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['inv_left_settings'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Invoice To section must not empty.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['inv_right_settings'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Invoice From section must not empty.';
                echo json_encode($json);
                die;
            }
            $doctor_id = $this->input->post('doctors_list');
            $inv_left_settings = $this->input->post('inv_left_settings');
            $inv_right_settings = $this->input->post('inv_right_settings');
            $inv_comments_settings = $this->input->post('inv_comments_settings');
            $inv_footer_settings = $this->input->post('inv_footer_settings');
            $check_inv_temp = $this->db->where('ura_doc_inv_doctor_id', $doctor_id)->get('uralensis_doctor_invoice_template')->row_array();
            if (!empty($check_inv_temp)) {
                $temp_data_update = array(
                    'ura_doc_inv_to_section' => $inv_left_settings,
                    'ura_doc_inv_from_section' => $inv_right_settings,
                    'ura_doc_inv_comments_setting' => $inv_comments_settings,
                    'ura_doc_inv_footer_setting' => $inv_footer_settings,
                    'timestamp' => time()
                );
                $this->db->where('ura_doc_inv_doctor_id', $doctor_id);
                $this->db->update('uralensis_doctor_invoice_template', $temp_data_update);
                $json['type'] = 'success';
                $json['msg'] = 'Template Updated Successfully.';
            } else {
                $temp_data = array(
                    'ura_doc_inv_doctor_id' => $doctor_id,
                    'ura_doc_inv_to_section' => $inv_left_settings,
                    'ura_doc_inv_from_section' => $inv_right_settings,
                    'ura_doc_inv_comments_setting' => $inv_comments_settings,
                    'ura_doc_inv_footer_setting' => $inv_footer_settings,
                    'timestamp' => time()
                );
                $this->db->insert('uralensis_doctor_invoice_template', $temp_data);
                $json['type'] = 'success';
                $json['msg'] = 'Template Inserted Successfully.';
            }
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search Doctor Invoice
     *
     */
    public function search_doctor_invoice_template_settings()
    {
        $json = array();
        $to_section = '';
        $from_section = '';
        $comment_section = '';
        $footer_section = '';
        $doctor_id = $this->input->post('doctor_id');
        $inv_temp_data = $this->db->where('ura_doc_inv_doctor_id', $doctor_id)->get('uralensis_doctor_invoice_template')->row_array();
        if (!empty($inv_temp_data)) {
            $to_section .= $inv_temp_data['ura_doc_inv_to_section'];
            $from_section .= $inv_temp_data['ura_doc_inv_from_section'];
            $comment_section .= $inv_temp_data['ura_doc_inv_comments_setting'];
            $footer_section .= $inv_temp_data['ura_doc_inv_footer_setting'];
            $json['type'] = 'success';
            $json['to_section_data'] = $to_section;
            $json['from_section_data'] = $from_section;
            $json['comment_data'] = $comment_section;
            $json['footer_data'] = $footer_section;
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No Invoice Template Saved.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save doctor invoice settings
     *
     */
    public function save_hospital_invoice_template_settings()
    {
        $json = array();
        if (isset($_POST)) {
            if (empty($_POST['inv_hospital'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Please choose the hospital first.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['inv_left_settings'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Invoice To section must not empty.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['inv_right_settings'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Invoice From section must not empty.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['invoice_to_sec_logo'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Logo must not be empty.';
                echo json_encode($json);
                die;
            }
            if (empty($_POST['invoice_from_sec_logo'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Logo must not be empty.';
                echo json_encode($json);
                die;
            }
            $hospital_id = $this->input->post('inv_hospital');
            $inv_left_settings = $this->input->post('inv_left_settings');
            $invoice_to_sec_logo = $this->input->post('invoice_to_sec_logo');
            $inv_right_settings = $this->input->post('inv_right_settings');
            $invoice_from_sec_logo = $this->input->post('invoice_from_sec_logo');
            $inv_comments_settings = $this->input->post('inv_comments_settings');
            $inv_footer_settings = $this->input->post('inv_footer_settings');
            $check_inv_temp = $this->db->where('ura_hos_inv_hospital_id', $hospital_id)->get('uralensis_hospital_invoice_template')->row_array();
            if (!empty($check_inv_temp)) {
                $temp_data_update = array(
                    'ura_hos_inv_to_section' => $inv_left_settings,
                    'ura_hos_inv_to_section_logo' => $invoice_to_sec_logo,
                    'ura_hos_inv_from_section' => $inv_right_settings,
                    'ura_hos_inv_from_section_logo' => $invoice_from_sec_logo,
                    'ura_hos_inv_comments_setting' => $inv_comments_settings,
                    'ura_hos_inv_footer_setting' => $inv_footer_settings,
                    'timestamp' => time()
                );
                $this->db->where('ura_hos_inv_hospital_id', $hospital_id);
                $this->db->update('uralensis_hospital_invoice_template', $temp_data_update);
                $json['type'] = 'success';
                $json['msg'] = 'Template Updated Successfully.';
            } else {
                $temp_data = array(
                    'ura_hos_inv_hospital_id' => $hospital_id,
                    'ura_hos_inv_to_section' => $inv_left_settings,
                    'ura_hos_inv_to_section_logo' => $invoice_to_sec_logo,
                    'ura_hos_inv_from_section' => $inv_right_settings,
                    'ura_hos_inv_from_section_logo' => $invoice_from_sec_logo,
                    'ura_hos_inv_comments_setting' => $inv_comments_settings,
                    'ura_hos_inv_footer_setting' => $inv_footer_settings,
                    'timestamp' => time()
                );
                $this->db->insert('uralensis_hospital_invoice_template', $temp_data);
                $json['type'] = 'success';
                $json['msg'] = 'Template Inserted Successfully.';
            }
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search Doctor Invoice
     *
     */
    public function search_hospital_invoice_template_settings()
    {
        $json = array();
        $to_section = '';
        $from_section = '';
        $comment_section = '';
        $footer_section = '';
        $to_logo = '';
        $from_logo = '';
        $hospital_id = $this->input->post('hospital_id');
        $inv_temp_data = $this->db->where('ura_hos_inv_hospital_id', $hospital_id)->get('uralensis_hospital_invoice_template')->row_array();
        if (!empty($inv_temp_data)) {
            $to_section .= $inv_temp_data['ura_hos_inv_to_section'];
            $from_section .= $inv_temp_data['ura_hos_inv_from_section'];
            $comment_section .= $inv_temp_data['ura_hos_inv_comments_setting'];
            $footer_section .= $inv_temp_data['ura_hos_inv_footer_setting'];
            $to_logo .= $inv_temp_data['ura_hos_inv_to_section_logo'];
            $from_logo .= $inv_temp_data['ura_hos_inv_from_section_logo'];
            $json['type'] = 'success';
            $json['to_section_data'] = $to_section;
            $json['from_section_data'] = $from_section;
            $json['comment_data'] = $comment_section;
            $json['footer_data'] = $footer_section;
            $json['to_logo'] = $to_logo;
            $json['from_logo'] = $from_logo;
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No Invoice Template Found.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Image Uploader.
     * Invoice Template Section upload logo
     *
     */
    public function invoice_logo_aleatha_image_uploader()
    {
        $json = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpeg|gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
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
            );
            echo json_encode($json);
        }
    }

    /**
     * Display Hospital TAT Settings
     *
     */
    public function display_hospital_tat_settings()
    {
        $json = array();
        $encode = '';
        if (isset($_POST)) {
            $hospital_id = $this->input->post('hospital_id');
            $tat_data = $this->Admin_model->display_tat_settings_modal($hospital_id);
            $group_name = $this->ion_auth->group($hospital_id)->row()->description;
            if (!empty($tat_data)) {
                $encode .= '<table class="table table-bordered">';
                $encode .= '<tr class="bg-primary">';
                $encode .= '<th>Clinic</th>';
                $encode .= '<th>TAT On</th>';
                $encode .= '<th>Timestamp</th>';
                $encode .= '<th>Action</th>';
                $encode .= '</tr>';
                $encode .= '<tr>';
                $encode .= '<td>' . $group_name . '</td>';
                $encode .= '<td>' . $tat_data['ura_tat_date_data'] . '</td>';
                $encode .= '<td>' . date('d-m-Y H:i:s', $tat_data['timestamp']) . '</td>';
                $encode .= '<td><a class="delete_tat_setting" href="javascript:;" data-tatid="' . $tat_data['ura_tat_id'] . '"><img src="' . base_url('assets/img/delete.png') . '"></a></td>';
                $encode .= '</tr>';
                $encode .= '</table>';
                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['msg'] = 'TAT settings found.';
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No TAT setting availabe for this hospital.';
            }
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete TAT Settings
     *
     */
    public function delete_hospital_tat_settings()
    {
        $json = array();
        if (isset($_POST)) {
            $tat_id = $this->input->post('tat_id');
            $this->db->where('ura_tat_id', $tat_id)->delete('uralensis_tat_settings');
            $json['type'] = 'success';
            $json['msg'] = 'TAT Delete Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Unlock User Account
     * Unclock Account if due to failed login attempts
     *
     */
    public function unlock_user_account()
    {
        if (isset($_POST)) {
            $user_email = $this->input->post('user_email');
            $this->ion_auth->clear_login_attempts($user_email);
            $json['type'] = 'success';
            $json['msg'] = 'User account successfully un-locked.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Save Speciemen Data Save
     *
     */
    public function specimen_data_save()
    {
        $json = array();
        $type = $this->input->post('specimen_type');
        if (!empty($type) && $type === 'accepted_by') {
            if (empty($_POST['specimen_accepted_by'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Field Should not be empty.';
                echo json_encode($json);
                die;
            }
            $accpeted_by = $this->input->post('specimen_accepted_by');
            $this->db->insert('specimen_accepted_by', array('spec_accep_by_name' => $accpeted_by, 'timestamp' => time()));
            $json['type'] = 'success';
            $json['msg'] = 'Data save successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($type) && $type === 'assisted_by') {
            if (empty($_POST['specimen_assisted_by'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Field Should not be empty.';
                echo json_encode($json);
                die;
            }
            $assisted_by = $this->input->post('specimen_assisted_by');
            $this->db->insert('specimen_assisted_by', array('spec_assis_by_name' => $assisted_by, 'timestamp' => time()));
            $json['type'] = 'success';
            $json['msg'] = 'Data save successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($type) && $type === 'labeled_by') {
            if (empty($_POST['specimen_labeled_by'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Field Should not be empty.';
                echo json_encode($json);
                die;
            }
            $labeled_by = $this->input->post('specimen_labeled_by');
            $this->db->insert('specimen_labeled_by', array('spec_labeled_by_name' => $labeled_by, 'timestamp' => time()));
            $json['type'] = 'success';
            $json['msg'] = 'Data save successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($type) && $type === 'cutup_by') {
            if (empty($_POST['specimen_cutup_by'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Field Should not be empty.';
                echo json_encode($json);
                die;
            }
            $cutup_by = $this->input->post('specimen_cutup_by');
            $this->db->insert('specimen_cutup_by', array('spec_cutup_by_name' => $cutup_by, 'timestamp' => time()));
            $json['type'] = 'success';
            $json['msg'] = 'Data save successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($type) && $type === 'blockchecked_by') {
            if (empty($_POST['specimen_blockchecked_by'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Field Should not be empty.';
                echo json_encode($json);
                die;
            }
            $blockchecked_by = $this->input->post('specimen_blockchecked_by');
            $this->db->insert('specimen_block_checked_by', array('spec_block_check_name' => $blockchecked_by, 'timestamp' => time()));
            $json['type'] = 'success';
            $json['msg'] = 'Data save successfully.';
            echo json_encode($json);
            die;
        } else if (!empty($type) && $type === 'qcd_by') {
            if (empty($_POST['specimen_qcd_by'])) {
                $json['type'] = 'error';
                $json['msg'] = 'Field Should not be empty.';
                echo json_encode($json);
                die;
            }
            $qcd_by = $this->input->post('specimen_qcd_by');
            $this->db->insert('specimen_qcd_by', array('spec_qcd_by_name' => $qcd_by, 'timestamp' => time()));
            $json['type'] = 'success';
            $json['msg'] = 'Data save successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Delete Specimen Data
     *
     */
    public function specimen_data_delete()
    {
        $json = array();
        if (!empty($_POST['item_id'])) {
            $db_name = $this->input->post('item_type');
            $id_name = '';
            if (!empty($db_name) && $db_name === 'specimen_accepted_by') {
                $id_name = 'spec_accep_by_id';
            } else if ($db_name === 'specimen_assisted_by') {
                $id_name = 'spec_assis_by_id';
            } else if ($db_name === 'specimen_block_checked_by') {
                $id_name = 'spec_block_check_id';
            } else if ($db_name === 'specimen_cutup_by') {
                $id_name = 'spec_cutup_by_id';
            } else if ($db_name === 'specimen_labeled_by') {
                $id_name = 'spec_labeled_by_id';
            } else if ($db_name === 'specimen_qcd_by') {
                $id_name = 'spec_qcd_by_id';
            }
            $this->db->where($id_name, $_POST['item_id'])->delete($db_name);
            $json['type'] = 'success';
            $json['msg'] = 'Data deleted successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Logout All Users
     *
     */
    public function logoutAllUsers()
    {
        $json = array();
        $admin_id = $this->ion_auth->user()->row()->id;
        $users = $this->db->select('id, email')->where('id!=', $admin_id)->get('users')->result_array();
        if (!empty($users)) {
            foreach ($users as $key => $users) {
                $this->db->like('data', $users['email']);
                $this->db->delete('ci_sessions');
            }
            $json['type'] = 'success';
            $json['msg'] = 'Users Logged Out Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Login As Admin
     *
     */
    public function loginAsAdmin()
    {
        $json = array();
        $admin_id = $this->ion_auth->user()->row()->id;
        if (isset($_POST)) {
            $user_id = $this->input->post('user_id');
            $this->Ion_auth_model->identity_column = $this->config->item('identity', 'ion_auth');
            $this->Ion_auth_model->tables = $this->config->item('tables', 'ion_auth');
            $query = $this->db->select($this->Ion_auth_model->identity_column . ', AES_DECRYPT(username, "' . DATA_KEY . '") AS username,AES_DECRYPT(first_name, "' . DATA_KEY . '") AS first_name,AES_DECRYPT(last_name, "' . DATA_KEY . '") AS last_name, AES_DECRYPT(email, "' . DATA_KEY . '") AS email, id, password, active, last_login, memorable')
                ->where('id', $user_id)
                ->limit(1)
                ->order_by('id', 'desc')
                ->get($this->Ion_auth_model->tables['users']);
            $user = $query->row();
            $session_data = array(
                'identity' => $user->email,
                'username' => $user->username,
                'email' => $user->email,
                'user_id' => $user->id, //everyone likes to overwrite id so we'll use user_id
                'old_last_login' => $user->last_login,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'admin_id' => $admin_id
            );
            $this->session->set_userdata($session_data);
            $this->session->sess_regenerate(TRUE);
            $_SESSION['pre_activity'] = $_SESSION['activity_detail'];
            user_login_activity();
            $json['type'] = 'success';
            $json['msg'] = 'You are going to login as ' . $user->username . ' Please Wait Redirecting...';
            $json['redirect_url'] = base_url('index.php');
            echo json_encode($json);
            die;
        }
    }

    /**
     * Login As Admin
     *
     */
    public function generatepins()
    {
        $json = array();
        if (isset($_POST)) {
            $user_id = $this->input->post('user_id');
            $userdetails = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
            for ($i = 1; $i <= 1; $i++) {
                $data = array(
                    "useremail" => $userdetails->email,
                    "token" => $this->generateRandomString(),
                    "token_status" => 1
                );
                $query = insertRecord("tbl_pins", $data); //$this->generateRandomString()."<br/>";
            }
            $json['type'] = 'success';
            $json['msg'] = 'Pins generated!  Please Wait Redirecting...';
            $json['redirect_url'] = base_url('auth/edit_user/' . $user_id);
            echo json_encode($json);
            die;
        }
    }

    function generateRandomString($length = 4)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Search Receipent Users
     *
     */
    public function searchReceipentUsers()
    {
        $admin_id = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            if (strpos($search_query, ';') !== FALSE) {
                $splitedQuery = explode(";", $search_query);
                $search_query = end($splitedQuery);
            } else {
                $search_query = $search_query;
            }
            $query = $this->db->query("SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users WHERE users.email = AES_ENCRYPT(" . $this->db->escape($search_query) . ", '" . DATA_KEY . "') AND users.id != $admin_id ORDER BY users.username");
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->id]['user_id'] = $row->id;
                $array[$row->id]['username'] = $row->username;
                $array[$row->id]['email'] = $row->email;
                $array[$row->id]['first_name'] = $row->first_name;
                $array[$row->id]['last_name'] = $row->last_name;
            }
            echo json_encode($array);
        }
    }

    /**
     * Exclude user from request viewed.
     *
     */
    public function setUserExcludeFromRequestViewedPermission()
    {
        $json = array();
        $user_id = $this->input->post('user_id');
        $perm_status = $this->input->post('perm_status');
        $this->db->where('id', $user_id)->update('users', array('exclude_user_request_viewed' => $perm_status));
        $json['type'] = 'success';
        $json['msg'] = 'Status Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Download Snomed Codes
     *
     * @param string $type
     */
    public function downloadSnomedCodes($type = '')
    {
        if (!empty($type)) {
            if ($type === 't1') {
                $type = 't1andt2';
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Snomed_Codes_' . $type . '|' . date('Y-m-d-H:i:s') . '.csv');
            $output = fopen('php://output', 'w');
            $csv_head_array = array(
                'Code',
                'Description',
                'Type'
            );
            if ($type === 'm') {
                $csv_head_array = array(
                    'Code',
                    'Description',
                    'Type',
                    'Diagnosis',
                    'RCPath Score'
                );
            }
            fputcsv($output, $csv_head_array);
            $query = $this->db->where('snomed_type', $type)->order_by("usmd_code_id", "ASC")->get('uralensis_snomed_codes')->result_array();
            if (!empty($query)) {
                foreach ($query as $snomed) {
                    $prepare_data = array(
                        'Code' => $snomed['usmdcode_code'],
                        'Description' => $snomed['usmdcode_code_desc'],
                        'Type' => $snomed['snomed_type'],
                    );
                    if ($type === 'm') {
                        $prepare_data = array(
                            'Code' => $snomed['usmdcode_code'],
                            'Description' => $snomed['usmdcode_code_desc'],
                            'Type' => $snomed['snomed_type'],
                            'Diagnosis' => $snomed['snomed_diagnoses'],
                            'RCPath Score' => $snomed['rc_path_score']
                        );
                    }
                    fputcsv($output, $prepare_data);
                }
            }
        }
    }

    /**
     * Delete Snomed Codes
     *
     * @param string $type
     */
    public function deleteAllSnomedCodes($type = '')
    {
        if (!empty($type) && $type === 't1') {
            $this->db->where('snomed_type', 't1')->delete('uralensis_snomed_codes');
        } else {
            $this->db->where('snomed_type', $type)->delete('uralensis_snomed_codes');
        }
        $snomed_data = array(
            'msg' => '<p class="bg-success" style="padding:7px;">Snomed Code Deleted Successfully.</p>',
            'open_collapse' => 'true'
        );
        $this->session->set_flashdata('msg_snomed', $snomed_data);
        redirect('admin/general_settings', 'refresh');
    }

    /**
     * View Incident Reports
     *
     */
    public function viewIncidentReports()
    {
        $hospitals['hospitals_list'] = $this->Admin_model->get_hospital_groups();
        $this->load->view('templates/header-new');
        $this->load->view('display/view_incident_reports', $hospitals);
        $this->load->view('templates/footer-new');
    }

    /**
     * Search Hospital users
     *
     */
    public function searchHospitalUsers()
    {
        $json = array();
        $encode_lists = '';
        if (!empty($_POST['group_id'])) {
            $group_id = $this->input->post('group_id');
            $hospital_users = $this->db->where('group_id', $group_id)->get('users_groups')->result_array();
            if (!empty($hospital_users)) {
                $encode_lists .= '<select class="form-control incident_report_user_id" name="incident_report_user_id">';
                $encode_lists .= '<option value="false">Select Hospital User</option>';
                foreach ($hospital_users as $users_list) {
                    $encode_lists .= '<option value="' . $users_list['user_id'] . '">' . uralensisGetUsername($users_list['user_id'], 'fullname') . '</option>';
                }
                $encode_lists .= '</select>';
                $json['type'] = 'success';
                $json['users_data'] = $encode_lists;
                $json['msg'] = 'Following User Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No User Found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Search Incident reports
     *
     */
    public function searchIncidentReports()
    {
        $json = array();
        $encode_lists = '';
        if (!empty($_POST['user_id'])) {
            $user_id = $this->input->post('user_id');
            $hospital_incident_reports = $this->db->where('ura_incident_user_id', $user_id)->get('uralensis_incident_reports')->result_array();
            if (!empty($hospital_incident_reports)) {
                $encode_lists .= '<h3 class="text-center">Incident Reports</h3>';
                $encode_lists .= '<table id="admin_incident_reports" class="table">';
                $encode_lists .= '<thead>';
                $encode_lists .= '<tr>';
                $encode_lists .= '<th>ID</th>';
                $encode_lists .= '<th>View</th>';
                $encode_lists .= '<th>Added By</th>';
                $encode_lists .= '<th>Timestamp</th>';
                $encode_lists .= '</tr>';
                $encode_lists .= '</thead>';
                $encode_lists .= '<tbody>';
                foreach ($hospital_incident_reports as $incident_reports) {
                    $encode_lists .= '<tr>';
                    $encode_lists .= '<td>' . intval($incident_reports["ura_incident_reports_id"]) . '</td>';
                    $encode_lists .= '<td><a href="' . base_url('index.php/admin/viewIncidentReport/' . intval($incident_reports['ura_incident_reports_id'])) . '"><img src="' . base_url('assets/img/view.png') . '"></a></td>';
                    $encode_lists .= '<td>' . uralensisGetUsername($incident_reports['ura_incident_user_id'], 'fullname') . '</td>';
                    $encode_lists .= '<td>' . date("d-m-Y H:i:s", $incident_reports["timestamp"]) . '</td>';
                    $encode_lists .= '</tr>';
                }
                $encode_lists .= '</tbody>';
                $encode_lists .= '</table>';
                $encode_lists .= '<script>
                $("#admin_incident_reports").DataTable({
                    ordering: false,
                    stateSave: true,
                    "processing": true,
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                });
                </script>';
                $json['type'] = 'success';
                $json['incident_reports'] = $encode_lists;
                $json['msg'] = 'Following User Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No User Found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * View Incident Reports
     *
     * @param int $record_id
     */
    public function viewIncidentReport($record_id = '')
    {
        if (!empty($record_id)) {
            $data['inciden_report_view'] = $this->db->where('ura_incident_reports_id', $record_id)->get('uralensis_incident_reports')->row_array();
        }
        $this->load->view('templates/header-new');
        $this->load->view('display/show_incident_report', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Save MDT Category
     *
     */
    public function saveMdtCategory()
    {
        $json = array();
        $output = '';
        if (empty($_POST['mdt_category_name'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please enter the mdt category name';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['mdt_category_hospital_id'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong.';
            echo json_encode($json);
            die;
        }
        $hospital_id = $this->input->post('mdt_category_hospital_id');
        $mdt_category_name = $this->input->post('mdt_category_name');
        $this->db->insert('uralensis_mdt_category', array('mdt_cat_name' => $mdt_category_name, 'hospital_id' => $hospital_id, 'timestamp' => time()));
        $mdt_cats = $this->db->select('*')->get('uralensis_mdt_category')->result_array();
        if (!empty($mdt_cats)) {
            $output .= '<ul id="mdt_category_list" class="list-group">';
            foreach ($mdt_cats as $mdt_key => $mdt_val) {
                $output .= '<li class="list-group-item">';
                $output .= $mdt_val['mdt_cat_name'];
                $output .= '<a data-mdtcategoryid="' . $mdt_val['mdt_cat_id'] . '" href="javascript:;" class="mdt_cat_delete"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>';
                $output .= '</li>';
            }
            $output .= '</ul>';
            $json['type'] = 'success';
            $json['mdt_data'] = $output;
            $json['msg'] = 'Record Added Successfuly';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Get MDT Categories
     *
     */
    public function getMdtCategories()
    {
        $json = array();
        $output = '';
        $mdt_cats = $this->db->select('*')->get('uralensis_mdt_category')->result_array();
        $refresh_type = $this->input->post('refresh_type');
        if (!empty($mdt_cats)) {
            if (isset($refresh_type) && $refresh_type === 'button') {
                $output .= '<ul id="mdt_category_list" class="list-group">';
                foreach ($mdt_cats as $mdt_key => $mdt_val) {
                    $output .= '<li class="list-group-item">';
                    $output .= $mdt_val['mdt_cat_name'];
                    $output .= '<a data-mdtcategoryid="' . $mdt_val['mdt_cat_id'] . '" href="javascript:;" class="mdt_cat_delete"><i class="glyphicon glyphicon-remove pull-right" style="color: red;"></i></a>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<nav class="tg-usergroupnav tg-usergroupnavradio">';
                $output .= '<h5>Select MDT Category</h5>';
                $output .= '<ul>';
                foreach ($mdt_cats as $mdt_key => $mdt_val) {
                    $output .= '<li>';
                    $output .= '<div class="tg-checkbox">';
                    $output .= '<input id="tg-mdtcat-' . $mdt_val['mdt_cat_id'] . '" type="checkbox" name="mdt_category[]" value="' . $mdt_val['mdt_cat_id'] . '">';
                    $output .= '<label for="tg-mdtcat-' . $mdt_val['mdt_cat_id'] . '">' . $mdt_val['mdt_cat_name'] . '</label>';
                    $output .= '</div>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
                $output .= '</nav>';
            }
            $json['type'] = 'success';
            $json['mdt_data'] = $output;
            $json['msg'] = 'MDT Category Found';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No MDT Category Found';
            echo json_encode($json);
            die;
        }
    }

    public function deleteMdtCategories()
    {
        $json = array();
        if (!empty($_POST['mdt_cat_id'])) {
            $mdt_cat_id = $this->input->post('mdt_cat_id');
            $this->db->where('mdt_cat_id', $mdt_cat_id)->delete('uralensis_mdt_category');
            $json['type'] = 'success';
            $json['msg'] = 'No MDT Category Found';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong';
            echo json_encode($json);
            die;
        }
    }

    public function setDatasetIsReqStatus()
    {
        $json = array();
        if (!empty($_POST['ques_id'])) {
            $ques_id = $this->input->post('ques_id');
            $req_status = $this->input->post('req_status');
            $this->db->where('ura_datasets_ques_id', $ques_id)
                ->update('uralensis_datasets_questions', array('is_required' => $req_status));
            $json['type'] = 'success';
            $json['msg'] = 'Question Require Status Updated.';
            echo json_encode($json);
            die;
        }
    }

    public function support()
    {
        $title = "Support";
        $data = array('home_url' => '/admin/home');
        $this->load->view('templates/header-new');
        $this->load->view('/support', $data);
        $this->load->view('templates/footer-new');
    }

    public function roles_permissions()
    {

        $this->load->view('templates/header-new');
        $this->load->view('pages/roles_permissions');
        $this->load->view('templates/footer-new');
    }

    /**
     * List all the networks
     * Method: GET
     */
    public function networks()
    {
        // Fetch all networks and display on the page
        $networks = $this->Admin_model->fetchAllGroupType('N');
        $data = array();
        $data['networks'] = $networks;
    
        $data['javascripts'] = array('js/admin/networks.js');
        $this->load->view('templates/header-new');
        $this->load->view('pages/networks', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Method: GET
     * Displays the network properties
     */
    public function network($id = '')
    {
        // Get network ID and show
        $network =  $this->Admin_model->fetchNetwork($id);
        if (is_null($network)) {
            $default = $this->Admin_model->getDefaultNetworkId();
            if (is_null($default)) {
                return redirect('/admin/networks', 'refresh');
            } else {
                return redirect('/admin/network/' . $default, 'refresh');
            }
        }
        $data = array();
        $data['network'] = $network;
        $data['javascripts'] = array('js/admin/network.js');
        $this->load->view('templates/header-new');
        $this->load->view('pages/network', $data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Method: GET/POST
     * Displays for to add network and accepts form result to show result
     */
    public function new_network()
    {
        $data = array();
        $data['javascript'] = array('admin/new_network.js');
        // POST Request
        if($this->input->method(TRUE) == 'POST') {
            $this->form_validation->set_rules('network_name', 'Network Name', 'required|is_unique[`groups`.name]');
            if ($this->form_validation->run() == FALSE) {

                $data['from_data'] = array(
                    'network_name' => $this->input->post('network_name'),
                );
                $data['form_error'] = array(
                    'network_name' => validation_errors()
                );
                $this->load->view('templates/header-new');
                $this->load->view('pages/network_new', $data);
                $this->load->view('templates/footer-new');
            }else{
                // Add new network
                $res = $this->Admin_model->addNetwork($this->input->post('network_name'));
                if ($res == TRUE) {
                    redirect('/admin/networks', 'refresh');
                } else {
                    $data['from_data'] = array(
                        'network_name' => $this->input->post('network_name'),
                    );
                    $data['form_error'] = array(
                        'network_name' => $res
                    );
                    $this->load->view('templates/header-new');
                    $this->load->view('pages/network_new', $data);
                    $this->load->view('templates/footer-new');
                }
            }
        // GET Request
        }else if($this->input->method(TRUE) == 'GET') {
            $this->load->view('templates/header-new');
            $this->load->view('pages/network_new', $data);
            $this->load->view('templates/footer-new');
        }
    }

    public function delete_network()
    {

    }

    public function edit_network()
    {
    }


    public function user_privileges()
    {
//        if (user_is_privileged('View user privileges list')) {
            $data['page_title'] = 'User Privileges';
            $data['javascripts'] = array(
                'js/nestable/jquery.nestable.min.js',
                'js/nestable/treeview.js',
            );
            $data['styles'] = array(
                'css/font-awesome.min.css',
                'css/treeview.css',
            );

            $data['privileges'] = $this->Admin_model->get_user_privileges();

//        echo '<pre>'; print_r($data['privileges']); exit;

//            $this->load->new_template('admin/user_privileges', $data);

            $this->load->view('templates/header-new',$data);
            $this->load->view('admin/user_privileges', $data);
            $this->load->view('templates/footer-new',$data);
//        } else {
//            $this->session->set_flashdata('message', 'You are not privileged to access this area!');
//            redirect('dashboard');
//        }
    }


    public function add_privilege()
    {
//        if (user_is_privileged('Insert user privilege')) {
            $this->form_validation->set_rules('privilege_name', 'Privilege Name', 'required|callback_check_privilege_name');
            $this->form_validation->set_rules('privilege_description', 'Privilege Description', 'required');
            $this->form_validation->set_rules('parent_privilege', 'Parent Privilege', 'required');


            if ($this->form_validation->run() == FALSE) {
                $data['page_title'] = 'User Privileges';
                $data['javascripts'] = array(
                    'js/custom_js/add_privilege.js',
                );
                $data['styles'] = array(
                );
                $data['parent_privileges'] = $this->Admin_model->get_user_privileges(' DESC');

                $this->load->view('templates/header-new',$data);
                $this->load->view('admin/add_privilege', $data);
                $this->load->view('templates/footer-new',$data);
            } else {
                $result = $this->Admin_model->add_user_privilege();
                if ($result == true) {
                    $this->session->set_flashdata('success_message', 'User privilege inserted successfully!');
                    redirect('Admin/user_privileges');
                } else if ($result == false) {
                    $data['page_title'] = 'User Privileges';
                    $data['javascripts'] = array(
                        'js/custom_js/add_privilege.js',
                    );
                    $data['styles'] = array();
                    $data['parent_privileges'] = $this->Admin_model->get_user_privileges();
                    $this->session->set_flashdata('error_message', 'User privilege is not inserted, try again!');

                    $this->load->view('templates/header-new',$data);
                    $this->load->view('admin/add_privilege', $data);
                    $this->load->view('templates/footer-new',$data);
                }
            }
//        } else {
//            $this->session->set_flashdata('message', 'You are not privileged to access this area!');
//            redirect('dashboard');
//        }
    }

    public function manage_user_group($group_id)
    {

        $group_id =1;

//        if (user_is_privileged('View manage user groups list')) {
            // If 'Update Group Privilege' form has been submitted, update the privileges of the user group.
            if ($this->input->post('update_group_privilege')) {
//                if (user_is_privileged('Update user group privileges')) {
//                    echo '<pre>'; print_r($this->input->post()); exit;
                    $this->Admin_model->update_group_privileges($group_id);
//                } else {
//                    $this->session->set_flashdata('message', 'You are not privileged to access this area!');
//                    redirect('dashboard');
//                }
            }

            $data['page_title'] = 'User Groups';
            $data['javascripts'] = array(
                'js/nestable/jquery.nestable.min.js',
                'js/nestable/treeview.js',
            );
            $data['styles'] = array(
                'css/font-awesome.min.css',
                'css/treeview.css',
            );

            $data['group_privileges'] = $this->Admin_model->get_group_privileges($group_id);
            $data['privileges'] = $this->Admin_model->get_user_privileges();
            $data['group_id'] = $group_id;

//        echo '<pre>'; print_r($data['privileges']); exit; //group_privileges

//            $this->load->new_template('admin/update_group_privileges', $data);
            $this->load->view('templates/header-new',$data);
            $this->load->view('admin/update_group_privileges', $data);
            $this->load->view('templates/footer-new',$data);
//        } else {
//            $this->session->set_flashdata('message', 'You are not privileged to access this area!');
//            redirect('dashboard');
//        }
    }

//######################## CI Validation Callback Functions #######################
    public function check_privilege_name($privilege_name)
    {

        $where = "user_privileges.upriv_name = '$privilege_name' ";
        $result = $this->Admin_model->get_privilege_data(NULL, $where);

        if ($result) {
            $this->form_validation->set_message('check_privilege_name', "Privilege Name already exists");
            return FALSE;
        } else {
            return TRUE;
        }
    }
//######################## CI Validation Callback Functions #######################

    public function allLoginUsers()
    {
        $data['usersLogins'] = $this->Admin_model->getUsersLogins(TRUE);

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $explodeDate = explode(" - ",$this->input->post("start_end_date"));
            $data['usersLogins'] = $this->Admin_model->getUsersLogins(TRUE,$explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "admin/";


        $data['styles'] = array(
            'css/daterangepicker.css'
        );
        $data['javascripts'] = array(
            'js/daterangepicker.js',
            'js/custom_js/activities.js');
        $this->load->view('templates/header-new',$data);
        $this->load->view('institute/login_user_list', $data);
        $this->load->view('templates/footer-new',$data);
    }
    public function getLoginDetail($id=FALSE)
    {
        $explodeId = explode("___",base64_decode($id));
        $data['usersLogins'] = $this->Admin_model->getLoginDetail($explodeId);
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $explodeDate = explode(" - ",$this->input->post("start_end_date"));
            $data['usersLogins'] = $this->Admin_model->getLoginDetail($explodeId,$explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "admin/";

        $data['styles'] = array(
            'css/daterangepicker.css'
        );
        $data['javascripts'] = array(
            'js/daterangepicker.js',
            'js/custom_js/activities.js');
        $this->load->view('templates/header-new',$data);
        $this->load->view('institute/login_user_detail', $data);
        $this->load->view('templates/footer-new',$data);
    }

    public function getAllLoginDetail()
    {
        $data['usersLogins'] = $this->Admin_model->getAllLoginDetail();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $explodeDate = explode(" - ",$this->input->post("start_end_date"));
            $data['usersLogins'] = $this->Admin_model->getAllLoginDetail($explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "admin/";

        $data['styles'] = array(
            'css/daterangepicker.css'
        );
        $data['javascripts'] = array(
            'js/daterangepicker.js',
            'js/custom_js/activities.js');
        $this->load->view('templates/header-new',$data);
        $this->load->view('institute/login_all_user_detail', $data);
        $this->load->view('templates/footer-new',$data);
    }

    public function showUserActivity($id=FALSE)
    {
        $explodeId = base64_decode($id);
        $data['usersLogins'] = getUserTrackActivity($explodeId);
//        echo $this->db->last_query();exit;
        $data['route'] = "admin/";
        $this->load->view('templates/header-new',$data);
        $this->load->view('institute/login_user_activities', $data);
        $this->load->view('templates/footer-new',$data);
    }

    public function usergroups($id,$name){
        if($name != ''){
            $name = explode('-',$name);
            if(count($name) == 1){
                $finalname = ucfirst($name[0]);
            }else if(count($name) == 2){
                $finalname = ucfirst($name[0]).' '.ucfirst($name[1]);
            }else if(count($name) == 3){
                $finalname = ucfirst($name[0]).' '.ucfirst($name[1]).' '.ucfirst($name[2]);
            }
            
        }
        
        $data['name'] = $finalname;
        $data['groupDetail'] = $this->Userextramodel->getAllusersForadmin($id);
            
        //  echo "<pre/>"; print_r($data['groupDetail']); exit();  
        $this->load->view('templates/header-new');
        $this->load->view('display/user_group_dashboard', $data);
        $this->load->view('templates/footer-new');
    }
}