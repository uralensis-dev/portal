<?php
/*error_reporting(-1);
ini_set('display_errors', -1)*/;
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Husers Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class Husers extends CI_Controller {

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
      $this->load->helper('form');
      $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'datasets_helper', 'ec_helper'));
      $this->load->library('email');
        // $this->load->library('word');
      $this->load->helper("file");
      $this->load->model('Userextramodel');
      $this->load->model('Laboratory_model');
      $this->load->model('Admin_model');
      $this->load->model('Huser_model');
        // $this->load->model('Ion_auth_model');

      $this->load->model('Specialty_model');
      $this->load->library('form_validation');
      $this->load->helper('Permission_helper');


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
   /* public function index() {
        $data['javascripts'] = array(
            'js/custom_js/laboratory_dashboard.js',
        );
        $data['usersLogins'] = $this->lab->getUsersLogins();
        $lab_id = $this->ion_auth->user()->row()->id;
        $group_row = $this->ion_auth->get_users_groups()->row();
        $group_id = $group_row->id;
       
        $lab_information = $this->Laboratory_model->get_lab_information($group_id);
        $data['lab_info'] = $lab_information;
        $data["firstRowCounts"] = $this->Admin_model->getDashboardFirstRowCount();
        $data["hospital_networks"] = $this->Admin_model->getHospitalNetworks();

        $this->load->view('templates/header-new');
        $this->load->view('laboratory/dashboard', $data);
        $this->load->view('templates/footer-new');
      }*/


      function edit_hospital_user($id=''){

        track_user_activity();
        $this->Userextramodel->generate_userid($id);
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in()) {
          redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();

        $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($id);

        $getpinsCheck = getRecords("COUNT(*) AS TOTROWS", "tbl_pins", array("useremail" => $decryptedDetails->email));
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
          $hospitallist[] = $rec->group_id;
        }
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
          $current_email = $this->input->post("email");
          $pre_email = $this->input->post("pre_email");
          if ($this->form_validation->run() === TRUE) {

                if ($_FILES['profile_image_name']) { //when user submit basic profile info with profile image
                  $config['upload_path'] = './uploads/';
                  $config['allowed_types'] = 'gif|jpg|png';
                  $config['max_size'] = '10000';

                  $this->load->library('upload', $config);

                  if (!$this->upload->do_upload('profile_image_name')) {
                    $error = 0;
                  } else {
                    $filedata = array('upload_data' => $this->upload->data());
                    $profile_image = $filedata['upload_data']['file_name'];
                    $image_path = 'uploads/' . $profile_image;
                    $error = 1;
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
                if ($this->input->post('case_cost')) {
                  $data['case_cost'] = $this->input->post('case_cost');
                }
                if ($this->input->post('alopecia_case_cost')) {
                  $data['alopecia_case_cost'] = $this->input->post('alopecia_case_cost');
                }
                if ($this->input->post('imf_case_cost')) {
                  $data['imf_case_cost'] = $this->input->post('imf_case_cost');
                }
                if ($this->input->post('hos_id')) {
                  $hos_id = $this->input->post('hos_id');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                  $groupData = $this->input->post('groups');
                  if (isset($groupData) && !empty($groupData)) {
                    $this->ion_auth->remove_from_group('', $id);
                    foreach ($groupData as $grp) {
                      $this->ion_auth->add_to_group($grp, $id);
                    }
                  }
                }
                
                $update_user_info =$this->Huser_model->updateUserProfileByAdmin($user->id, $image_path, !empty($profile_image), ($current_email != $pre_email) ? 0 : $this->input->post("pre_status"));

                if($update_user_info){
                  $this->session->set_flashdata('message', 'User updated successfully');
                }

                /*-------------------------------------------------------------------------------*/
               
              }
           

                /*-------------------------------------------------------------------------------*/

              if ($this->input->post('action')) {
                $formData = $this->input->post();
                if ($formData['action'] == 'update_job_plan') {
                  $this->db->where('user_id', $id)
                  ->update('user_job_plan', [
                    'pa' => $formData['pa'],
                    'leave' => $formData['leave'],
                    'uses_rcpath' => empty($formData['uses_rcpath']) ? FALSE : TRUE,
                    'sun' => empty($formData['sun']) ? FALSE : TRUE,
                    'mon' => empty($formData['mon']) ? FALSE : TRUE,
                    'tue' => empty($formData['tue']) ? FALSE : TRUE,
                    'wed' => empty($formData['wed']) ? FALSE : TRUE,
                    'thu' => empty($formData['thu']) ? FALSE : TRUE,
                    'fri' => empty($formData['fri']) ? FALSE : TRUE,
                    'sat' => empty($formData['sat']) ? FALSE : TRUE,
                  ]);
                }
              }


            /*if ($current_email != $pre_email) {
                $this->sendVerificationEmail($current_email);
              }*/

              return redirect("/husers/edit_hospital_user/$user->id", "refresh");
            }

        //display the edit user form
            $this->data['csrf'] = $this->_get_csrf_nonce();
        //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        //pass the user to the view
            $this->data['user'] = $user;
            $this->data['groups'] = $groups;
            $this->data['currentGroups'] = $currentGroups;
            $this->data['profile_picture_path'] = $decryptedDetails->profile_picture_path;

            $this->data['userrolename'] = $groups[0]['description'];
            $this->data['userhospitalname'] = $groups[3]['name'];
            $this->data['usergrouphospital'] = $hospitallist;

            $this->data['user_details'] = array(
              'first_name'=>$this->form_validation->set_value('first_name', $decryptedDetails->first_name),
              'last_name'=>$this->form_validation->set_value('last_name', $decryptedDetails->last_name),
              'company'=>$this->form_validation->set_value('company', $decryptedDetails->company),
              'phone'=>$this->form_validation->set_value('phone', $decryptedDetails->phone),
              'email'=>$decryptedDetails->email,
              'is_hospital_admin'=>$decryptedDetails->is_hospital_admin,
              'division_id'=>$decryptedDetails->division_id,
              'department_id'=>$decryptedDetails->department_id,
              'speciality_id'=>$decryptedDetails->speciality_id,
              'category_id'=>$decryptedDetails->category_id,
              'memorable'=>$this->form_validation->set_value('memorable', $user->memorable),
              'login_token'=>$this->form_validation->set_value('login_token', $decryptedDetails->login_token),
              'profile_image_name'=>$this->form_validation->set_value('profile_image_name', $user->picture_name),
              'profile_image_path'=>$this->form_validation->set_value('profile_image_path', $user->profile_picture_path),
              'dob'=>$this->getUserMetaData($id, 'dob'),
              'street_address'=>$this->getUserMetaData($id, 'street_address'),
              'address2'=>$this->getUserMetaData($id, 'address2'),
              'address1'=>$this->getUserMetaData($id, 'address1'),
              'post_code'=>$this->getUserMetaData($id, 'post_code'),
              'additional_number'=>$this->getUserMetaData($id, 'additional_number'),
              'gmc_no'=>$this->getUserMetaData($id, 'gmc_no'),
              'current_position'=>$this->getUserMetaData($id, 'current_position'),
              'current_status'=>$this->getUserMetaData($id, 'current_status'),
              'current_employer'=>$this->getUserMetaData($id, 'current_employer'),
              'work_street_address'=>$this->getUserMetaData($id, 'work_street_address'),
              'work_post_code'=>$this->getUserMetaData($id, 'work_post_code'),
              'work_number'=>$this->getUserMetaData($id, 'work_number'),
              'work_email'=>$this->getUserMetaData($id, 'work_email'),
              'work_gmc_no'=>$this->getUserMetaData($id, 'work_gmc_no'),
              'responsible_officer'=>$this->getUserMetaData($id, 'responsible_officer'),
              'revalidation_date'=>$this->getUserMetaData($id, 'revalidation_date'),
              'last_appraisal_date'=>$this->getUserMetaData($id, 'last_appraisal_date'),
              'last_appraisal_location'=>$this->getUserMetaData($id, 'last_appraisal_location'),
              'last_appraisal_person'=>$this->getUserMetaData($id, 'last_appraisal_person'),
              'fitness_to_practice'=>$this->getUserMetaData($id, 'fitness_to_practice'),
              'conflict_of_interest'=>$this->getUserMetaData($id, 'conflict_of_interest'),
              'outsource_work_name'=>$this->getUserMetaData($id, 'outsource_work_name'),
              'outsource_work_avail_date'=>$this->getUserMetaData($id, 'outsource_work_avail_date'),
              'account_name'=>$this->getUserMetaData($id, 'account_name'),
              'account_number'=>$this->getUserMetaData($id, 'account_number'),
              'account_csv_code'=>$this->getUserMetaData($id, 'account_csv_code'),
              'cases_limit'=>$this->getUserMetaData($id, 'cases_limit'),
              'cases_posted_address'=>$this->getUserMetaData($id, 'cases_posted_address'),
              'report_from_home'=>$this->getUserMetaData($id, 'report_from_home'),
              'receive_work_days'=>$this->getUserMetaData($id, 'receive_work_days'),

            );
        // echo "<pre>"; print_r($this->data['user_details']);die;
            $get_hospitals = $this->Userextramodel->display_hospitals_list();


            $this->data['getCheckPin'] = $getpinsCheck[0]->TOTROWS;
            $this->data['get_hospitals'] = $get_hospitals;
            $content = "";
            if ($getpinsCheck[0]->TOTROWS > 0) {
              $getpinsCheck2 = getRecords("*", "tbl_pins", array("useremail" => $decryptedDetails->email));
              foreach ($getpinsCheck2 as $rec) {
                $content .= $rec->token . ",";
              }

              $txtfile = FCPATH . "uploads/" . $decryptedDetails->email . ".txt";
            $handle = fopen($txtfile, 'w') or die('Cannot open file:  ' . $txtfile); // check the file is readable
            fwrite($handle, $content); // write content
            fclose($handle); // close the text file
          }

          $this->data['myuseremail'] = $id;
          $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('index.php'));
          $this->mybreadcrumb->add('Edit User', '#');
        // Get user specialties
          $query = "
          SELECT specialties.*, user_id
          FROM `specialties`
          LEFT JOIN (SELECT * FROM usermeta WHERE user_id = " . $this->db->escape($id) . " AND meta_key = 'specialty_id') as usermeta ON specialties.id = usermeta.meta_value
          ORDER BY specialties.specialty ASC
          ";
          $this->data['specialties'] = $this->db->query($query)->result();
        //Get HR Data
          $this->load->model('JobPlanModel');
          $this->data['rcpath'] = $this->JobPlanModel->get_user_week_rcpath($id);
          $this->data['job_plan'] = $this->JobPlanModel->get_user_job_plan($id);
          $leaves = $this->db->order_by('start', 'asc')->get_where('user_leave', ['user_id' => $id])->result();
          $monday = strtotime("last monday");
          $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;

          $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");

          $this_week_sd = date("Y-m-d", $monday);
          $this_week_ed = date("Y-m-d", $sunday);
          $week_leave = array(
            'mon' => FALSE,
            'tue' => FALSE,
            'wed' => FALSE,
            'thu' => FALSE,
            'fri' => FALSE,
            'sat' => FALSE,
            'sun' => FALSE
          );

          $start_date = $this_week_sd;
          while ($start_date <= $this_week_ed) {
            foreach ($leaves as $l) {
              $s_date = date('Y-m-d', strtotime($l->start));
              $e_date = date('Y-m-d', strtotime($l->end));
              if ($start_date >= $s_date && $start_date <= $e_date) {
                $day = strtolower(date('D', strtotime($start_date)));
                $week_leave[$day] = true;
              }
            }
            $start_date = date("Y-m-d", strtotime("+1 day", strtotime($start_date)));
          }
          $this->data['week_leave'] = $week_leave;
          $this->data['leave'] = $leaves;

        // Secretary Data
          $group_id = $this->ion_auth->get_users_groups($id)->row()->id;
          $member_of_group_id = array($group_id);
//        print_r($member_of_group_id); exit;
          $this->data['child_groups'] = $this->Admin_model->getHospiGroupsByUserId($user->id);
       // echo '<pre>'; print_r($this->data['child_groups']); exit;
          $this->data['user_child_group'] = $this->ion_auth->get_users_groups($user->id)->row_array();
//        echo '<pre>'; print_r($this->data['user_child_group']); exit;
          $this->data['all_pathologists'] = array();
          $this->data['manager_pathologist'] = array();

          if($this->data['user_child_group']['group_type'] == 'T' || $this->data['user_child_group']['group_type'] == 'PS'){
            $pathologist_group  = $this->Admin_model->GetGroupByType('D');
            $this->data['child_pathologist_groups'][] = $pathologist_group;
//            $child_pathologist_groups_arr = $this->Admin_model->getChildGroupsByType($this->data['user_child_group']['group_type']);
            $child_pathologist_groups_arr = $this->Admin_model->getChildPathologistGroups();
//            echo '<pre>'; print_r($child_pathologist_groups_arr); exit;
            if(!empty($child_pathologist_groups_arr)){
              foreach ($child_pathologist_groups_arr as $pathologists){
                $this->data['child_pathologist_groups'][] = $pathologists;
              }
            }
            $this->data['all_pathologists'] = $this->Admin_model->getAllPathologists();
            $this->data['manager_pathologist'] = $this->Admin_model->getManagerPathologist($user->id);
//            echo '<pre>'; print_r($this->data['all_pathologists']); exit;
//            echo '<pre>'; print_r($this->data['manager_pathologist']); exit;
//            echo '<pre>'; print_r($this->data['child_pathologist_groups']); exit;
          }

          $get_institute_ids = $this->Admin_model->getParentGroupsByUserId($user->id);
          if(!empty($get_institute_ids)){
            $member_of_group_id = $get_institute_ids;
          }

          $this->data['user_member_groups'] = $member_of_group_id;
       // echo '<pre>'; print_r($this->data['user_child_group']); exit;
          $group_type = $this->ion_auth->get_group_type($group_id);

          if ($this->ion_auth->in_group('admin') && $group_type[0]->group_type === 'D') {
            $secretary_data = array();
            $this->load->model('Secretary_model');
            $all_secretaries = $this->Secretary_model->get_all_secretaries($id);
            foreach ($all_secretaries as $secretary_id) {
              $secretary = $this->Secretary_model->get_secretary_user_details($secretary_id->ura_sec_id);
              if (count($secretary) === 0)
                continue;
              array_push($secretary_data, array(
                "id" => $secretary_id->ura_sec_id,
                "first_name" => $secretary[0]['first_name'],
                "last_name" => $secretary[0]['last_name'],
                "profile_picture" => $secretary[0]['profile_picture_path']
              ));
            }
            $this->data['secretary_data'] = $secretary_data;
          }

          $this->data['generated_user_id'] = $this->Userextramodel->generate_userid($id);

        //Leave Management
          $this->load->model('Leave_model', 'leave_model');
          $this->data['usersLeaves'] = $this->leave_model->getAllUserLeaves($id);
          $this->data['usersLeaveBalance'] = $this->leave_model->getUserLeaveBalance($id);
          $this->data['userHospitals'] = $this->leave_model->getUserHospitals($id);
          $this->data['division'] = $this->Huser_model->get_division_list();
    // echo "<pre>";
    // print_r($this->data['user_details']);
//     print_r($this->data['usersLeaveBalance']);
//     print_r($this->data['userHospitals']);
    // exit;
          $this->data['isMultiple'] = $this->leave_model->isUserMultiple($id);
       // echo $this->db->last_query();exit;
//        echo "<pre>";print_r($this->data['usersLeaveBalance']);exit;
          $includes['styles'] = array(
            'password/css/jquery.passwordRequirements.css',
            'css/daterangepicker.css'
          );
          $includes['javascripts'] = array(
            'js/jquery.form.js',
            'password/js/jquery.passwordRequirements.min.js',
            'js/daterangepicker.js',
            'js/jquery-pincode-autotab.js',
            'password/js/custom.js',
            'js/auth/edit_user.js',
            'js/leaves.js');

          $this->_render_page('templates/header-new', $includes);
          $this->_render_page('husers/edit-hospital_user', $this->data);
          $this->_render_page('templates/footer-new', $includes);

        }
    /**
     * Render View
     *
     * @param {html} $view
     * @param string $data
     * @param boolean $render
     * @return void
     */
    public function _render_page($view, $data = NULL, $render = FALSE) {
      $this->viewdata = (empty($data)) ? $this->data : $data;
      $view_html = $this->load->view($view, $this->viewdata, $render);
      if (!$render) {
        return $view_html;
      }
    }

     /**
     * Get User Meta Data
     *
     * @param [type] $id
     * @param string $type
     * @return void
     */

     public function getUserMetaData($id, $type = '') {

        /*if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {

            redirect('auth', 'refresh');
          }*/
          $user_meta = '';
          if (!empty($id) && !empty($type)) {
            //Get User Meta
            $meta_data = $this->db->where('user_id', $id)->where('meta_key', $type)->get('usermeta')->row_array();
            if (!empty($meta_data)) {
              $user_meta = $meta_data['meta_value'];
            }
          }

          return $user_meta;
        }

        public function _get_csrf_nonce() {
          $this->load->helper('string');
          $key = random_string('alnum', 8);
          $value = random_string('alnum', 20);
          $this->session->set_flashdata('csrfkey', $key);
          $this->session->set_flashdata('csrfvalue', $value);

          return array($key => $value);
        }
        function cancerservice($role_id = ''){
          if ($this->input->method() === 'get') {
            $data['usersLogins'] = $this->lab->getUsersLogins();
            $role_id=15;
            $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);
            $data['role_id']=$role_id;
            $data['Heading']='Hospital Cancer Users';
            $data['Breadcum']='Cancer Users';
            $this->load->view('templates/header-new');
            $this->load->view('husers/hospital_role_user_list', $data);
            $this->load->view('templates/footer-new');
          }
        }

        function hospitalsec(){
          if ($this->input->method() === 'get') {
            $data['usersLogins'] = $this->lab->getUsersLogins();
            $role_id='HS';
            $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);
            $data['role_id']=$role_id;
            $data['Heading']='Hospital Secretary Users';
            $data['Breadcum']='Hospital Secretary Users';
            $this->load->view('templates/header-new');
            $this->load->view('husers/hospital_role_user_list', $data);
            $this->load->view('templates/footer-new');
          }

        }
        function requester(){
          if ($this->input->method() === 'get') {
            $data['usersLogins'] = $this->lab->getUsersLogins();
            $role_id="R";
            $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);
            $data['role_id']=$role_id;
            $data['Heading']='Hospital Requestor Users';
            $data['Breadcum']='Hospital Requestor Users';
            $this->load->view('templates/header-new');
            $this->load->view('husers/hospital_role_user_list', $data);
            $this->load->view('templates/footer-new');
          }

        }
        function clinician(){
          if ($this->input->method() === 'get') {
            $data['usersLogins'] = $this->lab->getUsersLogins();
            $role_id='C';
            $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);
            $data['role_id']=$role_id;
            $data['Heading']='Hospital Clinician/Surgery Users';
            $data['Breadcum']='Hospital Clinician/Surgery Users';
            $this->load->view('templates/header-new');
            $this->load->view('husers/hospital_role_user_list', $data);
            $this->load->view('templates/footer-new');
          }
        }
        function divisionuser(){
          if ($this->input->method() === 'get') {
            $data['usersLogins'] = $this->lab->getUsersLogins();
            $role_id=33;
            $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);
            $data['role_id']=$role_id;
            $data['Heading']='Hospital Division Users';
            $data['Breadcum']='Hospital Division Users';
            $this->load->view('templates/header-new');
            $this->load->view('husers/hopital_division_users', $data);
            $this->load->view('templates/footer-new');
          }
        }
        function hosaccount(){
          if ($this->input->method() === 'get') {
            $data['usersLogins'] = $this->lab->getUsersLogins();
            $role_id="HA";
            $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);
            $data['role_id']=$role_id;
            $data['Heading']='Hospital Accounts/Surgery Users';
            $data['Breadcum']='Hospital Accounts/Surgery Users';
            $this->load->view('templates/header-new');
            $this->load->view('husers/hospital_role_user_list', $data);
            $this->load->view('templates/footer-new');
          }
        }

        function remove_hos_users($group_id='', $user_id=''){

          if($_GET['group_id']!='' && $_GET['user_id']!=''){
            $group_id = $_GET['group_id'];
            $user_id = $_GET['user_id'];
            $this->db->where('id', $group_id);
            $this->db->where('user_id', $user_id);
            $update = $this->db->update('users_groups', array('group_id'=>NULL, 'institute_id'=>NULL));
        // echo $this->db->last_query();d
            echo 'udpate';
          }
        }

        public function update_group_id()
        {
          if($_POST){

            $user_id = $_POST['user_id'];
            $user_group_id = $_POST['user_group_id'];
            $group_id = $_POST['g_id'];
            $result = $this->Huser_model->get_gourp_details($group_id);
            $user_type = $result->group_type;
            $result = $this->Huser_model->get_update_details($user_type, $user_id, $user_group_id, $group_id);
            $response['type'] = "success";
            $response['msg'] = "User type update successfully";
        // $response['redirect_url'] = "Data saved successfully";
            echo json_encode($response);

          }
        }
        public function huserlist($userType='') 
        {
          if ($this->input->method() === 'get') {
            if($_GET['t']){
              $role_id = $_GET['t'];
            }else{
              $role_id = '';
            }

        /*$data['javascripts'] = array(
        'js/custom_js/laboratory_dashboard.js',
      );*/
      $data['usersLogins'] = $this->lab->getUsersLogins();

      $data['hospital_array'] = $this->Huser_model->get_hospital_users($role_id);

      $data['HAusers'] = $this->Huser_model->get_hospital_users('HA','count');
      $data['CSusers'] = $this->Huser_model->get_hospital_users('C','count');
      $data['Rusers'] = $this->Huser_model->get_hospital_users('R','count');
      $data['HSusers'] = $this->Huser_model->get_hospital_users('HS','count');
      $data['CANusers'] = $this->Huser_model->get_hospital_users('15','count');
      $data['Pathusers'] = $this->Huser_model->get_hospital_users('D','count');
      $data['role_id']=$role_id;
        // echo "<pre>"; print_r($data['hospital_array']);die;
      $this->load->view('templates/header-new');
      $this->load->view('husers/hospital_user_list', $data);
      $this->load->view('templates/footer-new');
    }else if ($this->input->method() === 'post') {
      $fileName = $_FILES["laboratory_logo"]["tmp_name"];

      if ($_FILES["laboratory_logo"]["size"] > 0) {
        $company_id = $_POST['compane_id'];
        $user_array = array();
        $login_array = array();
        $file = fopen($fileName, "r");
        $i=0;
        $email_id_matched=0;
        $number_of_emp=0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          if($i>=1){
            if($column[0]){
              $firstname = $column[0];
            }else{
              $firstname = ''; 
            }
            if($column[1]){
              $lastname = $column[1];
            }else{
              $lastname = ''; 
            }
            if($column[2]){
              $company = $column[2];
            }else{
              $company = ''; 
            }
            if($column[3]){
              $phone = $column[3];
            }else{
              $phone = ''; 
            }
            if($column[4]){
              $userType = str_replace(' ','_',$column[4]);
              $user_type_a = HOSPITAL_GROUP_LIST;
              $user_type = $user_type_a[$userType];
            }else{
              $user_type = ''; 
            }
            if($column[5]){
              $memorable = $column[5];
            }else{
              $memorable = ''; 
            }

            if($column[6]){
              $email = $column[6];
            }else{
              $email = ''; 
            }
            if($column[7]){
              $username = $column[7];
            }else{
              $username = ''; 
            }


            $password = 'PATH@1223';
            $active=1;
            $profile_picture = DEFAULT_PROFILE_PIC;

            $additional_data = [
              'username' => $this->db->escape($username),
              'first_name' => $this->db->escape($firstname),
              'last_name' => $this->db->escape($lastname),
              'company' => $this->db->escape($company),
              'phone' => $this->db->escape($phone),
              'memorable' => $this->db->escape($memorable),
              'profile_picture_path' => $this->db->escape($profile_picture),
              'user_type' => $this->db->escape($user_type)
            ];

            $identity = $email;

            $user_id = $this->Huser_model->register($identity, $password, $email, $additional_data, array());
            if($user_id>=0){
              $addGroup = array("user_id" => $user_id,"institute_id" => $this->group_id);
              $this->db->insert('users_groups', $addGroup);
            }




          }
          $i++;
        }
      }

      $this->session->set_flashdata('message', $this->ion_auth->messages());
      redirect('husers/huserlist', 'refresh');
      return;
    }
  }


}
