<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Institute Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
 
 
 
class Customer extends CI_Controller
{
    private $group_id = 0;
    private $user_id = 0;
    private $group_type = "";

    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Institute_model');
        $this->load->model('Doctor_model');
        $this->load->model('Userextramodel');
        $this->load->model('Admin_model');
        $this->load->model('Pm_model');
        $this->load->model('Specialty_model');
        $this->load->library('form_validation');
        $this->load->helper('Permission_helper');
        $this->load->helper('form');
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        $this->load->helper("file");
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
    public function UserList()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

        $getparent = getRecords("*", "groups", array("id" => $groups[0]->id));

        $this->data['parent_id'] = $getparent[0]->parent_id;


        //debug($groups);exit;


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
    public function index()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $isuserAdmin['isuserAdmin'] = getRecords("is_hospital_admin", "users", array('id' => $user_id));
        $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $start_date = '';
        $end_date = '';
        if (isset($_GET['mode']) && $_GET['mode'] === 'period') 
		{
            $start_date = date("Y-m-d", strtotime($_GET['start_date']));
            $end_date = date("Y-m-d", strtotime($_GET['end_date']));
        }
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
        $hospital_dashboard_data = array_merge(
            $published,
            $unpublished,
            $totalreports,
            $new_reports,
            $incident_reports,
            $submitted_reports,
            $viewed_reports,
            $login_records,
            $hospital_docs,
            $clinic_dates,
            $upload_area,
            $cl_doc_upload_area,
            $hos_tat_rec_data,
            $hos_weekdays_tat_rec_data,
            $isuserAdmin,
            $decryptedDetails,
            $uploads_new_docs,
            $request_from_to_data,
            $countries_list,
            $hospital_pathologists);
        $h_data = array('styles' => array('css/institute/dashboard.css'));
        $f_data = array('javascripts' => array('js/institute/dashboard.js'));

        $this->load->view('templates/header-new');
        $this->load->view('customer/customer_view', $hospital_dashboard_data);
        $this->load->view('templates/footer-new');
    }

    /**
     * Upload SOP Doc Function
     * Return to Dashboard
     *
     * @return void
     */
   
public function labcustomer()	
	{
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		$data='';
		
        $h_data = array('styles' => array('css/institute/dashboard.css'));
        $f_data = array('javascripts' => array('js/institute/dashboard.js'));
		
		$lab_row = $this->ion_auth->get_users_groups()->row();
	    $lab_id = $lab_row->id;

		$get_hosptial_data = $this->db->query("SELECT * FROM `groups` as gr join hospital_information as hos on gr.id=hos.group_id  where gr.group_type = 'H' and id IN(select hospital_id from hospital_group where group_id=$lab_id)");		
		$data['hospital_data'] = $get_hosptial_data->result();

        $this->load->view('templates/header-new',$h_data);
        $this->load->view('customer/labcustomer_view',$data);
        $this->load->view('templates/footer-new',$f_data);
    }
	
	
	public function suppliers()	
	{
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		$data='';
		
        $h_data = array('styles' => array('css/institute/dashboard.css'));
        $f_data = array('javascripts' => array('js/institute/dashboard.js'));
		
		$lab_row = $this->ion_auth->get_users_groups()->row();
	    print $lab_id = $lab_row->id;

	$get_lab_data = $this->db->query("SELECT * FROM `groups` as gr join laboratory_information as hos on gr.id=hos.group_id  where gr.group_type = 'L' and id IN(select group_id from hospital_group where hospital_id=$lab_id)");		
		$data['hospital_data'] = $get_lab_data->result();

        $this->load->view('templates/header-new',$h_data);
        $this->load->view('customer/supplier_view',$data);
        $this->load->view('templates/footer-new',$f_data);
    }
	
	
	public function Deletecustomer($id)	
	{
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		$lab_row = $this->ion_auth->get_users_groups()->row();
	    $lab_id = $lab_row->id;

		$get_hosptial_data = $this->db->query("delete from hospital_group where group_id=$lab_id and hospital_id=$id");		
        redirect('customer/labcustomer', 'refresh');
    }
	
	
	public function InvoiceDetails($hos_id)	
	{
        if (!$this->ion_auth->logged_in()) 
		{
            redirect('auth/login', 'refresh');
        }
		
        $h_data = array('styles' => array('css/institute/dashboard.css'));
        $f_data = array('javascripts' => array('js/institute/dashboard.js'));
		
		$get_hosptial_data = $this->db->query("SELECT * FROM `groups` as gr join hospital_information as hos on gr.id=hos.group_id  where gr.group_type = 'H' and hos.group_id=$hos_id");
		$data['hospital_data'] = $get_hosptial_data->result();


		$get_finance_data = $this->db->query("SELECT * FROM `hospital_finance_details` where hospital_id=$hos_id");
		$data['finance_data'] = $get_finance_data->result();
		
		$lab_row = $this->ion_auth->get_users_groups()->row();
	    $lab_id = $lab_row->id;

        $this->load->view('templates/header-new',$h_data);
        $this->load->view('customer/invoice_view',$data);
        $this->load->view('templates/footer-new',$f_data);
    }
	

    function get_user_details()
    {
        if (!$this->Institute_model->is_user_hospital_admin()) {
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
	
	

    function get_group_id()
    {
        if (!$this->Institute_model->is_user_hospital_admin()) {
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

    function create_user()
    {
        if (!$this->Institute_model->is_user_hospital_admin()) {
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
                $ac = (int)$this->input->post('active_directory_user');
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
                    if ($_FILES['profile_pic']["name"]) //when user submit basic profile info with profile image
                    {
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
                        'user_auth_pass' => ''.$this->db->escape($this->input->post('pin_code')).'',
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

   
	
	
	
	public function CreateCustomer()
    {
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
	
	
	public function supplier()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $isuserAdmin['isuserAdmin'] = getRecords("is_hospital_admin", "users", array('id' => $user_id));
        $hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $start_date = '';
        $end_date = '';       
        $h_data = array('styles' => array('css/institute/dashboard.css'));
        $f_data = array('javascripts' => array('js/institute/dashboard.js'));
		$hospital_dashboard_data="";
        $this->load->view('templates/header-new');
        $this->load->view('customer/supplier_view', $hospital_dashboard_data);
        $this->load->view('templates/footer-new');
    }
	
	
	
}
