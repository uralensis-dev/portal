<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Auth extends CI_Controller
{
    private $data = [];
    private $h_data = array('styles' => ['css/auth/style.css']);

    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Libs and helper
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language', 'cookie', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        // Models
        $this->load->model('Ion_auth_model');
        $this->load->model('Chatlogin_model');
        $this->load->model('Admin_model');
        $this->load->model('Searchtracking_model');
        $this->load->model('Userextramodel');
    }

    /**
     * Redirect if needed, otherwise display the user list
     *
     * @return void
     */
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            return redirect('auth/login', 'refresh');
        }

        if (!empty($this->ion_auth->get_users_groups()->row()->id)) {
            $groups = $this->Ion_auth_model->get_group_type($this->ion_auth->get_users_groups()->row()->id);
        }

        $getparent = getRecords("*", "groups", array("id" => $groups[0]->id));
        $get_group_type = getRecords("group_type", "groups", array("id" => $getparent[0]->parent_id));

        if ($this->ion_auth->is_admin()) {
            // if an admin, go to admin area
            // set the flash data error message if there is one
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
            $this->data["group_id"] = $group_id;
            $this->data['usersList'] = $this->Userextramodel->getAllusersForadmin($group_id="", $this->input->post('name'), $this->input->post('status'));
//            echo '<pre>'; print_r($this->data['usersList']); exit;
            foreach($this->data['usersList'] as $key=>$value){
                $user_hosp = $this->Userextramodel->get_user_hospitals_ids($value->user_id); //10
                $this->data['usersList'][$key]->user_hospitals=$user_hosp;
//                echo '<pre>'.$value->user_id; print_r($user_hosp);
            }
//            echo '<pre>'; print_r($this->data['usersList']); exit;
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }

            $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('index.php'));
            $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
            track_user_activity();
            $f_data['javascripts'] = array('js/auth/index.js');
            $this->_render_page('templates/header-new');
            $this->_render_page('auth/index-new', $this->data);
            $this->_render_page('templates/footer-new', $f_data);
        } else if (!empty($groups) && $groups[0]->group_type === 'H' || (isset($get_group_type) && !empty($get_group_type) && is_array($get_group_type) && count($get_group_type) > 0 && $get_group_type[0]->group_type)) {
            track_user_activity();
            redirect('institute/', 'refresh');
        } else if (!empty($groups) && $groups[0]->group_type === 'D') {
            track_user_activity();
            redirect('doctor/', 'refresh');
        } else if (!empty($groups) && $groups[0]->group_type === 'S') {
            track_user_activity();
            redirect('secretary/', 'refresh');
        } else if (!empty($groups) && $groups[0]->group_type === 'L') {
            track_user_activity();
            redirect('laboratory/', 'refresh');
        } else if (!empty($groups) && $groups[0]->group_type === 'C') {
            track_user_activity();
            redirect('clinician/', 'refresh');
        } else if (!empty($groups) && $groups[0]->group_type === 'G') {
            track_user_activity();
            redirect('surgeon/', 'refresh');
        } else if (!empty($groups) && $groups[0]->group_type === 'CS') {
            track_user_activity();
            redirect('cancerService/', 'refresh');
        } else {
            echo 'Please Contact To Administrator For Further Instructions.';
        }
    }

    /**
     * Render View
     *
     * @param {html} $view
     * @param string $data
     * @param boolean $render
     * @return void
     */
    public function _render_page($view, $data = NULL, $render = FALSE)
    {
        $this->viewdata = (empty($data)) ? $this->data : $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if (!$render) {
            return $view_html;
        }
    }

    /**
     * Log the user in
     *
     *
     * @return void
     */
    public function login()
    {
        // Check if user already logged in. If true redirect to appropriate dashboard
        if ($this->ion_auth->logged_in()) {
            //check the password expiry time of user
            $user_data = $this->db->get_where('users', array('id' => $_SESSION['user_id'],'password_expiry <= NOW() and 1='=>"1"))->row();
            if(!empty($user_data)){
                return redirect('auth/password_change', 'refresh');
            }
            return redirect('auth', 'refresh');
        }

        $this->data['title'] = "Login";
        // validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
        $this->form_validation->set_rules('memorable1', 'Memorable 1', 'required');
        $this->form_validation->set_rules('memorable2', 'Memorable 2', 'required');
        $this->form_validation->set_rules('auth_token', 'Token', 'required');

        if ($this->form_validation->run() == TRUE) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $this->input->post('memorable1'), $this->input->post('mem'), $this->input->post('memorable2'), $this->input->post('mem2'), $remember)) {
                // if the login is successful
                // redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                /* Insert User Status into user Table Start */
                $user_ip = $this->input->ip_address();
                $insert_user_status = array(
                    'user_status' => 'true',
                    'user_login_time' => date("Y-m-d H:i:s"),
                    'user_logout_time' => '',
                    'user_logged_ip' => $user_ip,
                    'user_login_status' => 'true'
                );
                $user = $this->Userextramodel->updateUserData($user_ip, $this->input->post('identity'));
                /* Insert User Status into user Table End */
                $insert_user_login_times = array(
                    'users_login_id' => $this->input->post('identity')
                );
                $this->db->insert('users_login_records', $insert_user_login_times);
                /* Insert User Login Times on Seperate Table */
                $userdt = $this->Userextramodel->getuserId($this->input->post('identity'));
                $check_cookie = $this->input->cookie('remember_auth_access_' . $userdt[0]->id, TRUE);

                /*********** Chat Login data Model***************/

                $current_datetime = date('Y-m-d H:i:s');
                $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($userdt[0]->id);
                if ($this->Chatlogin_model->Is_already_register($userdt[0]->id)) {
                    //update data
                    $user_data = array(
                        'login_oauth_uid' => $userdt[0]->id,
                        'first_name' => $decryptedDetails->first_name,
                        'last_name' => $decryptedDetails->last_name,
                        'email_address' => $decryptedDetails->email,
                        'profile_picture' => $decryptedDetails->profile_picture_path,
                        'updated_at' => $current_datetime
                    );

                    $this->Chatlogin_model->Update_user_data($user_data, $userdt[0]->id);
                } else {
                    //insert data
                    $user_data = array(
                        'login_oauth_uid' => $userdt[0]->id,
                        'first_name' => $decryptedDetails->first_name,
                        'last_name' => $decryptedDetails->last_name,
                        'email_address' => $decryptedDetails->email,
                        'profile_picture' => $decryptedDetails->profile_picture_path,
                        'created_at' => $current_datetime
                    );

                    $this->Chatlogin_model->Insert_user_data($user_data);
                }

                $user_id = $this->Chatlogin_model->Get_user_id($userdt[0]->id);

                $login_data = array(
                    'user_id' => $user_id,
                    'last_activity' => $current_datetime
                );

                $login_id = $this->Chatlogin_model->Insert_login_data($login_data);
                if (isset($data)) {
                    $this->session->set_userdata('username', ucfirst($data['given_name']) . ' ' . ucfirst($data['family_name']));
                }

                $this->session->set_userdata('chat_user_id', $user_id);

                $this->session->set_userdata('login_id', $login_id);

                /*********** Chat Login data Model**************/

                if (!isset($check_cookie)) {
                    delete_cookie('user_id');
                }
                delete_cookie('users_logged_out');
                redirect('auth/index', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );
            $this->data['memorable1'] = array(
                'name' => 'memorable1',
                'id' => 'memorable1',
                'type' => 'password',
            );
            $this->data['mem'] = array(
                'name' => 'mem',
                'id' => 'mem',
                'type' => 'hidden',
            );
            $this->data['memorable2'] = array(
                'name' => 'memorable2',
                'id' => 'memorable2',
                'type' => 'password',
            );
            $this->data['mem2'] = array(
                'name' => 'mem2',
                'id' => 'mem2',
                'type' => 'hidden',
            );
            $this->data['auth_token'] = array(
                'name' => 'auth_token',
                'id' => 'auth_token',
                'type' => 'password',
            );
            $this->_render_page('templates/header-login');
            $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
            $this->_render_page('templates/footer');
        }
    }

    public function job_plan($id)
    {
        $this->data['title'] = "User Job Plan";
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
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
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        if (isset($_POST) && !empty($_POST)) {

            if ($this->form_validation->run() === TRUE) {

                if ($_FILES['profile_image_name']) //when user submit basic profile info with profile image
                {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10000';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('profile_image_name')) {
                        $error = 0;
                    } else {
                        $filedata = array('upload_data' => $this->upload->data());
                        $profile_image = $filedata['upload_data']['file_name'];
                        $error = 1;
                    }
                }
                //update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }
                //update the memorable if it was posted
                if ($this->input->post('memorable')) {
                    $data['memorable'] = $this->input->post('memorable');
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
                if ($this->input->post("input_type") == "basic_info") //basic_info is input type being sent from edit form page in order to updated info
                {
                    $image_path = 'uploads/' . $profile_image;
                    if ($this->input->post('is_hospital_admin')) {
                        $mvalue = 1;
                    } else {
                        $mvalue = 0;
                    }
                    $updatebasic = $this->Userextramodel->UpdateBasicInfoUser($this->input->post('group_id'), $this->input->post('memorable'), $user->id, $this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('company'), $this->input->post('phone'), $image_path, $mvalue);

                    if (!empty($hos_id)) {
                        $updatehospital = $this->Userextramodel->updateHospitalfordoctor($user->id, $hos_id, $this->input->post('usergroup_type'));
                    } else {
                        $updateGroupid = $this->Userextramodel->updategroupID($user->id, $this->input->post('group_id'));
                    }
                }
                //check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                } else {
                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
            }
            //Prepare User Meta Data Array
            $meta_data_user_detail = array(
                'dob' => $this->input->post('dob'),
                'street_address' => $this->input->post('street_address'),
                'post_code' => $this->input->post('post_code'),
                'additional_number' => $this->input->post('additional_number'),
                'gmc_no' => $this->input->post('gmc_no'),
                'current_position' => $this->input->post('current_position'),
                'current_status' => $this->input->post('current_status'),
                'current_employer' => $this->input->post('current_employer'),
                'work_street_address' => $this->input->post('work_street_address'),
                'work_post_code' => $this->input->post('work_post_code'),
                'work_number' => $this->input->post('work_number'),
                'work_email' => $this->input->post('work_email'),
                'work_gmc_no' => $this->input->post('work_gmc_no'),
                'responsible_officer' => $this->input->post('responsible_officer'),
                'revalidation_date' => $this->input->post('revalidation_date'),
                'last_appraisal_date' => $this->input->post('last_appraisal_date'),
                'last_appraisal_location' => $this->input->post('last_appraisal_location'),
                'last_appraisal_person' => $this->input->post('last_appraisal_person'),
                'fitness_to_practice' => $this->input->post('fitness_to_practice'),
                'conflict_of_interest' => $this->input->post('conflict_of_interest'),
            );
            foreach ($meta_data_user_detail as $key => $value) {
                //Check if Specific data exists in DB
                $db_meta = $this->db->where('user_id', $id)->where('meta_key', $key)->get('usermeta')->row_array();
                if (!empty($db_meta)) {
                    $this->db->where('user_id', $db_meta['user_id'])
                        ->where('meta_key', $db_meta['meta_key'])
                        ->update(
                            'usermeta',
                            array('meta_value' => $value)
                        );
                } else {
                    if (!empty($value)) {
                        $this->db->insert('usermeta', array('user_id' => $id, 'meta_key' => $key, 'meta_value' => $value));
                    }
                }
            }
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
        $this->data['usergrouphospital'] = $hospitallist;
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $decryptedDetails->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $decryptedDetails->last_name),
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $decryptedDetails->company),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $decryptedDetails->phone),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $decryptedDetails->email,
        );
        $this->data['is_hospital_admin'] = array(
            'name' => 'is_hospital_admin',
            'id' => 'is_hospital_admin',
            'type' => 'text',
            'value' => $decryptedDetails->is_hospital_admin,
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password'
        );
        $this->data['memorable'] = array(
            'name' => 'memorable',
            'id' => 'memorable',
            'type' => 'text',
            'value' => $this->form_validation->set_value('memorable', $user->memorable),
        );

        $this->data['profile_image_name'] = array(
            'name' => 'profile_image_name',
            'id' => 'profile_image_name',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('profile_image_name', $user->picture_name),
        );
        $this->data['profile_image_path'] = array(
            'name' => 'profile_image_path',
            'id' => 'profile_image_path',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('profile_image_path', $user->profile_picture_path),
        );
        $this->data['dob'] = array(
            'name' => 'dob',
            'id' => 'dob',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'dob')
        );
        $this->data['street_address'] = array(
            'name' => 'street_address',
            'id' => 'street_address',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'street_address')
        );
        $this->data['post_code'] = array(
            'name' => 'post_code',
            'id' => 'post_code',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'post_code')
        );
        $this->data['additional_number'] = array(
            'name' => 'additional_number',
            'id' => 'additional_number',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'additional_number')
        );
        $this->data['gmc_no'] = array(
            'name' => 'gmc_no',
            'id' => 'gmc_no',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'gmc_no')
        );
        $this->data['current_position'] = array(
            'name' => 'current_position',
            'id' => 'current_position',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'current_position')
        );
        $this->data['current_status'] = array(
            'name' => 'current_status',
            'id' => 'current_status',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'current_status')
        );
        $this->data['current_employer'] = array(
            'name' => 'current_employer',
            'id' => 'current_employer',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'current_employer')
        );
        $this->data['work_street_address'] = array(
            'name' => 'work_street_address',
            'id' => 'work_street_address',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_street_address')
        );
        $this->data['work_post_code'] = array(
            'name' => 'work_post_code',
            'id' => 'work_post_code',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_post_code')
        );
        $this->data['work_number'] = array(
            'name' => 'work_number',
            'id' => 'work_number',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_number')
        );
        $this->data['work_email'] = array(
            'name' => 'work_email',
            'id' => 'work_email',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_email')
        );
        $this->data['work_gmc_no'] = array(
            'name' => 'work_gmc_no',
            'id' => 'work_gmc_no',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_gmc_no')
        );
        $this->data['responsible_officer'] = array(
            'name' => 'responsible_officer',
            'id' => 'responsible_officer',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'responsible_officer')
        );
        $this->data['revalidation_date'] = array(
            'name' => 'revalidation_date',
            'id' => 'revalidation_date',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'revalidation_date')
        );
        $this->data['last_appraisal_date'] = array(
            'name' => 'last_appraisal_date',
            'id' => 'last_appraisal_date',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'last_appraisal_date')
        );
        $this->data['last_appraisal_location'] = array(
            'name' => 'last_appraisal_location',
            'id' => 'last_appraisal_location',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'last_appraisal_location')
        );
        $this->data['last_appraisal_person'] = array(
            'name' => 'last_appraisal_person',
            'id' => 'last_appraisal_person',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'last_appraisal_person')
        );
        $this->data['fitness_to_practice'] = array(
            'name' => 'fitness_to_practice',
            'id' => 'fitness_to_practice',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'fitness_to_practice')
        );
        $this->data['conflict_of_interest'] = array(
            'name' => 'conflict_of_interest',
            'id' => 'conflict_of_interest',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'conflict_of_interest')
        );
        $this->data['outsource_work_name'] = array(
            'name' => 'outsource_work_name',
            'id' => 'outsource_work_name',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'outsource_work_name')
        );
        $this->data['outsource_work_avail_date'] = array(
            'name' => 'outsource_work_avail_date',
            'id' => 'outsource_work_avail_date',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'outsource_work_avail_date')
        );
        $this->data['account_name'] = array(
            'name' => 'account_name',
            'id' => 'account_name',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'account_name')
        );
        $this->data['account_number'] = array(
            'name' => 'account_number',
            'id' => 'account_number',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'account_number')
        );
        $this->data['account_csv_code'] = array(
            'name' => 'account_csv_code',
            'id' => 'account_csv_code',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'account_csv_code')
        );
        $this->data['cases_limit'] = $this->getUserMetaData($id, 'cases_limit');
        $this->data['cases_posted_address'] = array(
            'name' => 'cases_posted_address',
            'id' => 'cases_posted_address',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'cases_posted_address')
        );
        $this->data['report_from_home'] = array(
            'name' => 'report_from_home',
            'id' => 'report_from_home',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'report_from_home')
        );
        $this->data['receive_work_days'] = $this->getUserMetaData($id, 'receive_work_days');
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
        $this->data['user_id'] = $id;
        $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('index.php'));
        $this->mybreadcrumb->add('Job Plan', '#');
        // Get user specialties
        $query = "
        SELECT specialties.*, user_id
        FROM `specialties`
        LEFT JOIN (SELECT * FROM usermeta WHERE user_id = " . $this->db->escape($id) . " AND meta_key = 'specialty_id') as usermeta ON specialties.id = usermeta.meta_value
        ORDER BY specialties.specialty ASC
        ";
        $this->data['specialties'] = $this->db->query($query)->result();


        //Get HR Data
        $job_plan = $this->db->get_where('user_job_plan', ['user_id' => $id])->row();
        if (empty($job_plan)) {
            $this->db->insert('user_job_plan', ['user_id' => $id]);
        }

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

        $this->load->model('JobPlanModel');
        $this->data['job_plan'] = $this->JobPlanModel->get_user_job_plan($id);
        $this->data['user_specialties'] = $this->JobPlanModel->get_user_specialties($id);
        $this->data['has_errors'] = FALSE;
        $this->data['rcpath'] = $this->JobPlanModel->get_user_week_rcpath($id);
        if (array_key_exists('job_plan_data', $_SESSION)) {
            $this->data['has_errors'] = TRUE;
            $this->data['form_values'] = $_SESSION['job_plan_data']['values'];
            $this->data['form_errors'] = $_SESSION['job_plan_data']['errors'];
        }

        $this->_render_page('templates/header-new');
        $this->_render_page('auth/job_plan', $this->data);
        $this->_render_page('templates/footer-new');
    }

    public function update_job_plan($user_id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $user_id))) {
            redirect('auth', 'refresh');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $event_val = trim($this->input->post('event', TRUE));
            $specialty = $this->input->post('specialty_id', TRUE);
            $dayOfWeek = $this->input->post('dayOfWeek', TRUE);
            $color = $this->input->post('color', TRUE);
            $from_time = $this->input->post('from_time', TRUE);
            $to_time = $this->input->post('to_time');
            $event_id = $this->input->post('event_id');

            $valid = true;
            $errors = array();
            $this->load->model("JobPlanModel");
            if (!$this->JobPlanModel->valid_specialty($user_id, $specialty)) {
                $valid = FALSE;
                array_push($errors, 'specialty_id');
            }
            $week = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');
            if (!in_array($dayOfWeek, $week)) {
                $valid = FALSE;
                array_push($errors, 'dayOfWeek');
            }

            if (!preg_match("/^bg-*/", $color)) {
                $valid = FALSE;
                array_push($errors, 'color');
            }
            $valid_time = strtotime($to_time);
            $to_time = date('H:m:s', $valid_time);
            if (is_bool($valid_time)) {
                $valid = FALSE;
                array_push($errors, 'to_time');
            }
            $valid_time = strtotime($from_time);
            $from_time = date('H:m:s', $valid_time);
            if (is_bool($valid_time)) {
                $valid = FALSE;
                array_push($errors, 'from_time');
            }
            if ($from_time >= $to_time) {
                $valid = FALSE;
                array_push($errors, 'invalid_time');
            }

            $values = array(
                'user_id' => $user_id,
                'event' => $event_val,
                'specialty_id' => $specialty,
                'dayOfWeek' => $dayOfWeek,
                'color' => $color,
                'from_time' => $from_time,
                'to_time' => $to_time,
                'event_id' => $event_id
            );

            if ($valid) {
                $this->JobPlanModel->update_job_plan($values);
            }
        }
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success'));
    }

    public function delete_job_plan($user_id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $user_id))) {
            redirect('auth', 'refresh');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('JobPlanModel');
            $this->JobPlanModel->delete_job_plan($this->input->post('event_id', TRUE), $user_id);
        }
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success'));
    }

    public function get_user_events($user_id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $user_id))) {
            redirect('auth', 'refresh');
        }
        $this->load->model('JobPlanModel');
        $res = $this->JobPlanModel->get_user_job_plan($user_id);
        header('Content-Type: application/json');
        echo json_encode($res);
    }

    public function add_job_plan($user_id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $user_id))) {
            redirect('auth', 'refresh');
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $event_val = trim($this->input->post('event', TRUE));
            $specialty = $this->input->post('specialty', TRUE);
            $dayOfWeek = $this->input->post('dayOfWeek', TRUE);
            $color = $this->input->post('color', TRUE);
            $from_time = $this->input->post('from_time');
            $to_time = $this->input->post('to_time');


            $valid = true;
            $errors = array();
            $this->load->model("JobPlanModel");
            if (!$this->JobPlanModel->valid_specialty($user_id, $specialty)) {
                $valid = FALSE;
                array_push($errors, 'specialty_id');
            }
            $week = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');
            if (!in_array($dayOfWeek, $week)) {
                $valid = FALSE;
                array_push($errors, 'dayOfWeek');
            }

            if (!preg_match("/^bg-*/", $color)) {
                $valid = FALSE;
                array_push($errors, 'color');
            }
            $valid_time = strtotime($to_time);
            $to_time = date('H:m:s', $valid_time);
            if (is_bool($valid_time)) {
                $valid = FALSE;
                array_push($errors, 'to_time');
            }
            $valid_time = strtotime($from_time);
            $from_time = date('H:m:s', $valid_time);
            if (is_bool($valid_time)) {
                $valid = FALSE;
                array_push($errors, 'from_time');
            }
            if ($from_time >= $to_time) {
                $valid = FALSE;
                array_push($errors, 'invalid_time');
            }

            $values = array(
                'user_id' => $user_id,
                'event' => $event_val,
                'specialty_id' => $specialty,
                'dayOfWeek' => $dayOfWeek,
                'color' => $color,
                'from_time' => $from_time,
                'to_time' => $to_time
            );

            if ($valid) {
                $this->JobPlanModel->add_job_plan($values);
                redirect('auth/job_plan/' . $user_id, 'refresh');
            } else {
                $_SESSION['job_plan_data'] = array('values' => $values, 'errors' => $errors);
                $this->session->mark_as_flash('job_plan_data');
                redirect('auth/job_plan/' . $user_id, 'refresh');
            }
        } else {
            redirect('auth/job_plan/' . $user_id, 'refresh');
        }
    }

    /**
     * Change password
     *
     * @return void
     */
    public function change_password()
    {
        track_user_activity();
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == FALSE) {
            //display the form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );
            //render
            $this->_render_page('templates/header');
            $this->_render_page('auth/change_password', $this->data);
            $this->_render_page('templates/footer');
        } else {
            $identity = $this->session->userdata('identity');
            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    /**
     * Log the user out
     *
     * @return void
     */

    public function logout()
    {
        $this->data['title'] = "Logout";
        $user_email = '';
        if (!empty($this->ion_auth->user()->row()->email)) {
            $user_email = $this->ion_auth->user()->row()->email;
        }
        //Check if data exists in session first
        if (isset($_SESSION) && !empty($_SESSION['session_records'])) {
            $get_batch_number = $this->db->query("SELECT * FROM uralensis_track_session_records ORDER BY ura_track_sess_rec_id DESC LIMIT 1")->row_array();
            if ($get_batch_number == '') {
                $batch_id_before_insert = 1;
            } else {
                $batch_id_before_insert = $get_batch_number['ura_track_sess_rec_id'];
            }
            $batch_query = $this->db->query("SELECT ura_track_sess_rec_batch_id FROM uralensis_track_session_records WHERE ura_track_sess_rec_id = $batch_id_before_insert");
            if ($batch_query->num_rows() > 0) {
                $row = $batch_query->row();
                $last_inserted_serial_number = $row->ura_track_sess_rec_batch_id;
                $keyParts = explode('-', $last_inserted_serial_number);
                if ($keyParts[1] == date('y')) {
                    $key = $keyParts[0] . "-" . $keyParts[1] . "-" . ($keyParts[2] + 1);
                } else {
                    $key = $keyParts[0] . "-" . date("y") . "-1";
                }
            } else if ($batch_query->num_rows() < 0) {
                $key = 'Batch-' . date('y') . '-1';
            } else {
                $key = 'Batch-' . date('y') . '-1';
            }
            $session_records_ids = $this->session->userdata('session_records');
            //Assign Batch ID to all session records.
            if (!empty($session_records_ids)) {
                foreach ($session_records_ids as $rec_key => $rec_val) {
                    //Update records with Batch Number
                    $this->db->where('uralensis_request_id', $rec_val)->update('request', array('record_batch_id' => $key));
                }
            }
            //Save Session Record Ids Into Database...
            //Prepare Data for insertion
            $user_id = $this->ion_auth->user()->row()->id;
            $reocrd_data = array(
                'ura_track_sess_rec_data' => serialize($session_records_ids),
                'ura_track_sess_rec_user_id' => $user_id,
                'ura_track_sess_rec_batch_id' => $key,
                'timestamp' => time(),
                'ura_date_format' => date('Y-m-d')
            );
            $this->db->insert('uralensis_track_session_records', $reocrd_data);
        }
        $insert_user_status = array(
            'user_status' => 'false',
            'user_logout_time' => date("Y-m-d H:i:s"),
            'user_login_status' => 'false'
        );
        if (!empty($user_email)) {
            $this->db->where('email', $user_email)->update('users', $insert_user_status);
        }
        if (insert_logout_time() == TRUE) {
            insert_logout_time();
        }
        //Unset the record ids Session.
        $this->session->unset_userdata('record_ids');
        $this->session->unset_userdata('session_records');
        //log the user out
        $logout = $this->ion_auth->logout();
        /* Insert User Status into user Table End */
        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('auth/login', 'refresh');
    }

    /**
     * Forgot password
     *
     * @return void
     */
    public function forgot_password()
    {
        //setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') == 'username') {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }
        if ($this->form_validation->run() == FALSE) {
            //setup the input
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
            );
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }
            //set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_render_page('templates/header-login');
            $this->_render_page('auth/forgot_password', $this->data);
            $this->_render_page('templates/footer');
        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
            if (empty($identity)) {
                if ($this->config->item('identity', 'ion_auth') == 'username') {
                    $this->ion_auth->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth->set_message('forgot_password_email_not_found');
                }
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/forgot_password", 'refresh');
            }
            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    /**
     * Reset password - final step for forgotten password
     *
     * @param [type] $code
     * @return void
     */
    public function reset_password($code = NULL)
    {
        track_user_activity();
        if (!$code) {
            show_404();
        }
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');
            if ($this->form_validation->run() == FALSE) {
                //display the form
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;
                //render
                $this->_render_page('templates/header-login');
                $this->_render_page('auth/reset_password', $this->data);
                $this->_render_page('templates/footer');
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {
                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);
                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * CSRF Token
     *
     * @return void
     */
    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    /**
     * Validate CSRF Token
     *
     * @return void
     */
    public function _valid_csrf_nonce()
    {
        if (
            $this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')
        ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Activate the user
     *
     * @param int $id
     * @param boolean $code
     * @return void
     */
    public function activate($id, $code = FALSE)
    {
        track_user_activity();
        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }
        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Deactivate the user
     *
     * @param int $id
     * @return void
     */
    public function deactivate($id = NULL)
    {
        track_user_activity();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        $id = (int)$id;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');
        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();
            $this->_render_page('auth/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }
                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }
            //redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    /**
     * Create a new user
     *
     * @return void
     */
    public function create_user()
    {
        // Post Data Structure
        /*
        Multipart Form
        $_POST = {
            first_name, last_name, company, phone, email,
            password, password_confirm, memorable, user_role [ad, admin]
        }

        $_FILES = {
            profile_pic
        }
        */

        // Post Request Part
        track_user_activity();
        $this->load->model('Admin_model');
        $this->data['title'] = $this->lang->line('create_user_heading');
        $this->data['javascripts'] = array('password/js/jquery.passwordRequirements.min.js', 'password/js/custom.js', 'js/auth/create_user.js');
        array_unshift($this->h_data['styles'], 'password/css/jquery.passwordRequirements.css');
        $includes['styles'] = array('password/css/jquery.passwordRequirements.css');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // Validate form input

        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|callback__unique_email');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        $form_submitted = true;

        if ($this->form_validation->run() === TRUE) {
            // If Post Data Valid. Complete Save Data

            $last_user_id = $this->db->select_max("id")->get("users")->result_array();
            if (empty($last_user_id)) {
                $last_user_id = '';
            } else {
                $last_user_id = intval($last_user_id[0]["id"]) + 1;
            }

            $username = strtolower($this->input->post('first_name')) . '_' . strtolower($this->input->post('last_name')).$last_user_id;
            $email = $this->input->post('email');
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');
            $user_role = $this->input->post('user_role');
            $is_hospital_admin = 0;
            $group_id = -1;
            $in_directory = 0;
            switch ($user_role) {
                case "admin":
                    $group_id = $this->Admin_model->get_group_id('A');
                    break;
                case "ad":
                    $in_directory = 1;
                    break;
            }
            if ($group_id === -1 && $user_role === 'admin') {
                $this->session->set_flashdata('message', "Invalid group");
                redirect("auth/create_user", 'refresh');
                return;
            }

            $profile_picture = DEFAULT_PROFILE_PIC;

            // Upload profile picture if exists

            if (!empty($_FILES['profile_pic']["name"])) //when user submit basic profile info with profile image
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

            $user_type = $user_role == 'admin' ? 'A': '';

            $additional_data = [
                'username' => $this->db->escape($username),
                'first_name' => $this->db->escape($this->input->post('first_name')),
                'last_name' => $this->db->escape($this->input->post('last_name')),
                'company' => $this->db->escape($this->input->post('company')),
                'phone' => $this->db->escape($this->input->post('phone')),
                'memorable' => $this->db->escape($this->input->post('memorable')),
                'is_hospital_admin' => $is_hospital_admin,
                'profile_picture_path' => $this->db->escape($profile_picture),
                'user_type' => $this->db->escape($user_type),
                'group_id' => ""
            ];

            // Check User Group
            $groups_array = array($group_id);

            echo __LINE__."<br/>";
            if ($this->ion_auth->register($identity, $password, $email, $additional_data, $groups_array, $in_directory)) {
                echo __LINE__."<br/>";
                $this->sendVerificationEmail($email);
                exit;
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
                return;
            }
            exit;
        }

        // Display the create user form
        // Set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
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


        $this->load->view('templates/header-new', $includes);
        $this->load->view('auth/create_user_new', $this->data);
        $this->load->view('templates/footer-new');

    }

    public function sendVerificationEmail($email){
        echo __LINE__."<br/>";
        echo $this->config->item('admin_email', 'ion_auth')."-----".$this->config->item('site_title', 'ion_auth')."<br/>";
       echo $this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject')."<br/>";
       echo $email."<br/>";
        $activationLink = base_url()."auth/verifyEmail/".base64_encode($email);
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('aleatha@uralensis.com', $this->config->item('site_title', 'ion_auth'));
        $this->email->to("shariq.libra@live.com");
        $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
        $this->email->set_mailtype("html");
        $this->email->message("Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n ".$activationLink."\n"."\n\nThanks\nAdmin Team");
        echo __LINE__."<br/>";
        if(!$this->email->send()){
            echo "I am not Send";
            print_r($this->email->print_debugger());
        }
        echo __LINE__."<br/>";
    }

    public function verifyEmail($email){
        $email = base64_decode($email);

        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect("auth", 'refresh');

        $res = $this->db
            ->where("AES_ENCRYPT(email, '".DATA_KEY."') = ", $email)
            ->where("status", 0)
            ->update('users',array('status'=>1));
        if ($res != 0) {
            $this->session->set_flashdata('email_activation', "Email Activated Successfully");
        }
        redirect("auth", 'refresh');
    }

    public function _unique_email($str)
    {
        if (!$this->ion_auth->logged_in()) {
            return FALSE;
        }
        $res = $this->db
            ->where("AES_DECRYPT(email, '".DATA_KEY."') = ", $str)
            ->get('users')->num_rows();
        if ($res > 0) {
            $this->form_validation->set_message('_unique_email', 'This email already exists');
            return FALSE;
        }
        return TRUE;
    }


    /**
     * API Endpoint. Checks if provided email is present is `users`.
     * GET Params
     * email
     */
    public function unique_email() {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->output
                ->set_status_header(405);
            return;
        }

        $user_id = $this->input->get('id');

        $email = $this->input->get('email', TRUE);
        $this->output->set_content_type('application/json');
        if (empty($email)) {
            $this->output->set_output(json_encode(FALSE));
            return;
        }

        $this->db
            ->where("AES_DECRYPT(email, '".DATA_KEY."') = ", $email);
        if (!empty($user_id)) {
            $this->db->where('id !=', $user_id);
        }

        $res = $this->db->get('users')->num_rows();
        if ($res > 0) {
            $this->output->set_output(json_encode(FALSE));
            return;
        }
        $this->output->set_output(json_encode(TRUE));
    }

    public function create_hospital()
    {
        // Only super admin allowed
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            return redirect('/', 'refresh');
        }
        $data = array();
        if ($this->input->method() === 'get') {
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
            $this->load->view('auth/create_hospital', $data);
            $this->load->view('templates/footer-new');
        } else if ($this->input->method() === 'post') {
            // Check for input validations
            $this->form_validation->set_rules('hospital_name', 'Institute Name', 'trim|required|is_unique[groups.description]');
            $this->form_validation->set_rules('hospital_initials_1', 'Hospital First Initial', 'trim|required|exact_length[1]');
            $this->form_validation->set_rules('hospital_initials_2', 'Hospital Second Initial', 'trim|required|exact_length[1]');
            $this->form_validation->set_rules('hospital_email', 'Hospital Email', 'trim|valid_email');
            $this->form_validation->set_rules('hospital_website', 'Hospital Website', 'trim|valid_url');

            // Form validation for admin data
            $this->form_validation->set_rules('admin_first_name', 'Admin First Name', 'trim|required');
            $this->form_validation->set_rules('admin_last_name', 'Admin Last Name', 'trim|required');
            $this->form_validation->set_rules('admin_email', 'Admin Email', 'required|valid_email|callback__unique_email');
            $this->form_validation->set_rules('admin_password', 'Admin Password', 'trim|required');
            $this->form_validation->set_rules('admin_password_confirm', 'Admin Password Confirm', 'trim|required|matches[admin_password]');
            $this->form_validation->set_rules('admin_memorable', 'Admin Memorable', 'trim|required');

            if (!empty($_POST['ac_checkbox'])) {
                $this->form_validation->set_rules('ac_first_name', 'Account Holder First Name', 'trim|required');
                $this->form_validation->set_rules('ac_last_name', 'Account Holder Last Name', 'trim|required');
                $this->form_validation->set_rules('ac_email', 'Account Holder Email', 'trim|required|valid_email|callback__unique_email');
                $this->form_validation->set_rules('ac_password', 'Account Holder Password', 'trim|required');
                $this->form_validation->set_rules('ac_password_confirm', 'Account Holder Password Confirm', 'trim|required|matches[ac_password]');
                $this->form_validation->set_rules('ac_memorable', 'Account Holder Memorable', 'trim|required');
            }

            if (!empty($_POST['dac_checkbox'])) {
                $this->form_validation->set_rules('dac_first_name', 'Deputy Account Holder First Name', 'trim|required');
                $this->form_validation->set_rules('dac_last_name', 'Deputy Account Holder Last Name', 'trim|required');
                $this->form_validation->set_rules('dac_email', 'Deputy Account Holder Email', 'trim|required|valid_email|callback__unique_email');
                $this->form_validation->set_rules('dac_password', 'Deputy Account Holder Password', 'trim|required');
                $this->form_validation->set_rules('dac_password_confirm', 'Deputy Account Holder Password Confirm', 'trim|required|matches[dac_password]');
                $this->form_validation->set_rules('dac_memorable', 'Deputy Account Holder Memorable', 'trim|required');
            }

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
                    // check to see if we are creating the group
                    // redirect them back to the admin page
                    $info_data = array(
                        'group_id' => $new_group_id,
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
                    $this->Admin_model->insertHospitalInformation($info_data);

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
                        if ($_FILES['ac_profile_pic']["name"]) //when user submit basic profile info with profile image
                        {
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
                        $user_type = 'H';
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
                                ->update('hospital_information');
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
                        if ($_FILES['dac_profile_pic']["name"]) //when user submit basic profile info with profile image
                        {
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
                        $user_type = 'H';
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
                                ->update('hospital_information');
                        }
                    }

                    $this->session->set_flashdata('message', $this->ion_auth->messages());

                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('status' => 'error', 'message' => 'Error Creating, hospital user try again later')));
                }
            } else {
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'error', 'message' => 'Invalid Input', 'errors' => validation_errors())));
            }
        } else {
            $this->output->set_status_header(405)->set_output("Method not allowed");
        }
    }

    public function downloadpins($filename)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            redirect('auth', 'refresh');
        }
        $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($filename);
        $this->load->helper('download');
        $data = file_get_contents(FCPATH . "uploads/" . $decryptedDetails->email . ".txt"); // Read the file's contents
        $name = "pins.txt";
        force_download($name, $data);
    }

    function objectToArray($d)
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        } else {
            // Return array
            return $d;
        }
    }

    /**
     * Edit a user
     *
     * @param int $id
     * @return void
     */
    public function toggle_specialty()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            redirect('auth', 'refresh');
        }
        if (!empty($this->input->get('action'))) {
            $formData = $this->input->get();
            if ($formData['action'] == 'remove_specialty') {
                $this->db->where([
                    'user_id' => $formData['user_id'],
                    'meta_key' => 'specialty_id',
                    'meta_value' => $formData['id']
                ])
                    ->delete('usermeta');
            }
            if ($formData['action'] == 'add_specialty') {
                $this->db->insert('usermeta', [
                    'user_id' => $formData['user_id'],
                    'meta_key' => 'specialty_id',
                    'meta_value' => $formData['id']
                ]);
                echo json_encode($formData);
            }
        }
    }

    public function edit_user($id)
    {
        track_user_activity();
        $this->Userextramodel->generate_userid($id);
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
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
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        if (isset($_POST) && !empty($_POST)) {

            if ($this->form_validation->run() === TRUE) {

                if ($_FILES['profile_image_name']) //when user submit basic profile info with profile image
                {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10000';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('profile_image_name')) {
                        $error = 0;
                    } else {
                        $filedata = array('upload_data' => $this->upload->data());
                        $profile_image = $filedata['upload_data']['file_name'];
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
                if ($this->input->post("input_type") == "basic_info") //basic_info is input type being sent from edit form page in order to updated info
                {
                    $profile_image = isset($profile_image) ? $profile_image : '';
                    $image_path = 'uploads/' . $profile_image;
                    $updatebasic = $this->Userextramodel->UpdateBasicInfoUser(
                        $this->input->post('group_id'),
                        $this->input->post('memorable'),
                        $this->input->post('login_token'),
                        $user->id,
                        $this->input->post('first_name'),
                        $this->input->post('last_name'),
                        $this->input->post('company'),
                        $this->input->post('email'),
                        $this->input->post('phone'),
                        $image_path,
                        !empty($profile_image),
                        !empty($this->input->post('hospital_admin')));
                } else {
                    //check to see if we are updating the user
                    if ($this->ion_auth->update($user->id, $data)) {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                    } else {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                }
            }
            //Prepare User Meta Data Array
            $meta_data_user_detail = array(
                'dob' => $this->input->post('dob'),
                'street_address' => $this->input->post('street_address'),
                'post_code' => $this->input->post('post_code'),
                'additional_number' => $this->input->post('additional_number'),
                'gmc_no' => $this->input->post('gmc_no'),
                'current_position' => $this->input->post('current_position'),
                'current_status' => $this->input->post('current_status'),
                'current_employer' => $this->input->post('current_employer'),
                'work_street_address' => $this->input->post('work_street_address'),
                'work_post_code' => $this->input->post('work_post_code'),
                'work_number' => $this->input->post('work_number'),
                'work_email' => $this->input->post('work_email'),
                'work_gmc_no' => $this->input->post('work_gmc_no'),
                'responsible_officer' => $this->input->post('responsible_officer'),
                'revalidation_date' => $this->input->post('revalidation_date'),
                'last_appraisal_date' => $this->input->post('last_appraisal_date'),
                'last_appraisal_location' => $this->input->post('last_appraisal_location'),
                'last_appraisal_person' => $this->input->post('last_appraisal_person'),
                'fitness_to_practice' => $this->input->post('fitness_to_practice'),
                'conflict_of_interest' => $this->input->post('conflict_of_interest'),
            );
            foreach ($meta_data_user_detail as $key => $value) {
                //Check if Specific data exists in DB
                $db_meta = $this->db->where('user_id', $id)->where('meta_key', $key)->get('usermeta')->row_array();
                if (!empty($db_meta)) {
                    $this->db->where('user_id', $db_meta['user_id'])
                        ->where('meta_key', $db_meta['meta_key'])
                        ->update(
                            'usermeta',
                            array('meta_value' => $value)
                        );
                } else {
                    if (!empty($value)) {
                        $this->db->insert('usermeta', array('user_id' => $id, 'meta_key' => $key, 'meta_value' => $value));
                    }
                }
            }
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
            return redirect("/auth/edit_user/$user->id", "refresh");
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
        $this->data['usergrouphospital'] = $hospitallist;
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $decryptedDetails->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $decryptedDetails->last_name),
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $decryptedDetails->company),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $decryptedDetails->phone),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $decryptedDetails->email,
        );
        $this->data['is_hospital_admin'] = array(
            'name' => 'is_hospital_admin',
            'id' => 'is_hospital_admin',
            'type' => 'text',
            'value' => $decryptedDetails->is_hospital_admin,
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password'
        );
        $this->data['memorable'] = array(
            'name' => 'memorable',
            'id' => 'memorable',
            'type' => 'text',
            'value' => $this->form_validation->set_value('memorable', $user->memorable),
        );
        $this->data['login_token'] = array(
            'name' => 'login_token',
            'id' => 'login_token',
            'type' => 'text',
            'value' => $this->form_validation->set_value('login_token', $decryptedDetails->login_token),
        );
        $this->data['profile_image_name'] = array(
            'name' => 'profile_image_name',
            'id' => 'profile_image_name',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('profile_image_name', $user->picture_name),
        );
        $this->data['profile_image_path'] = array(
            'name' => 'profile_image_path',
            'id' => 'profile_image_path',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('profile_image_path', $user->profile_picture_path),
        );
        $this->data['dob'] = array(
            'name' => 'dob',
            'id' => 'dob',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'dob')
        );
        $this->data['street_address'] = array(
            'name' => 'street_address',
            'id' => 'street_address',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'street_address')
        );
        $this->data['post_code'] = array(
            'name' => 'post_code',
            'id' => 'post_code',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'post_code')
        );
        $this->data['additional_number'] = array(
            'name' => 'additional_number',
            'id' => 'additional_number',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'additional_number')
        );
        $this->data['gmc_no'] = array(
            'name' => 'gmc_no',
            'id' => 'gmc_no',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'gmc_no')
        );
        $this->data['current_position'] = array(
            'name' => 'current_position',
            'id' => 'current_position',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'current_position')
        );
        $this->data['current_status'] = array(
            'name' => 'current_status',
            'id' => 'current_status',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'current_status')
        );
        $this->data['current_employer'] = array(
            'name' => 'current_employer',
            'id' => 'current_employer',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'current_employer')
        );
        $this->data['work_street_address'] = array(
            'name' => 'work_street_address',
            'id' => 'work_street_address',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_street_address')
        );
        $this->data['work_post_code'] = array(
            'name' => 'work_post_code',
            'id' => 'work_post_code',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_post_code')
        );
        $this->data['work_number'] = array(
            'name' => 'work_number',
            'id' => 'work_number',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_number')
        );
        $this->data['work_email'] = array(
            'name' => 'work_email',
            'id' => 'work_email',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_email')
        );
        $this->data['work_gmc_no'] = array(
            'name' => 'work_gmc_no',
            'id' => 'work_gmc_no',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'work_gmc_no')
        );
        $this->data['responsible_officer'] = array(
            'name' => 'responsible_officer',
            'id' => 'responsible_officer',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'responsible_officer')
        );
        $this->data['revalidation_date'] = array(
            'name' => 'revalidation_date',
            'id' => 'revalidation_date',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'revalidation_date')
        );
        $this->data['last_appraisal_date'] = array(
            'name' => 'last_appraisal_date',
            'id' => 'last_appraisal_date',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'last_appraisal_date')
        );
        $this->data['last_appraisal_location'] = array(
            'name' => 'last_appraisal_location',
            'id' => 'last_appraisal_location',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'last_appraisal_location')
        );
        $this->data['last_appraisal_person'] = array(
            'name' => 'last_appraisal_person',
            'id' => 'last_appraisal_person',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'last_appraisal_person')
        );
        $this->data['fitness_to_practice'] = array(
            'name' => 'fitness_to_practice',
            'id' => 'fitness_to_practice',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'fitness_to_practice')
        );
        $this->data['conflict_of_interest'] = array(
            'name' => 'conflict_of_interest',
            'id' => 'conflict_of_interest',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'conflict_of_interest')
        );
        $this->data['outsource_work_name'] = array(
            'name' => 'outsource_work_name',
            'id' => 'outsource_work_name',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'outsource_work_name')
        );
        $this->data['outsource_work_avail_date'] = array(
            'name' => 'outsource_work_avail_date',
            'id' => 'outsource_work_avail_date',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'outsource_work_avail_date')
        );
        $this->data['account_name'] = array(
            'name' => 'account_name',
            'id' => 'account_name',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'account_name')
        );
        $this->data['account_number'] = array(
            'name' => 'account_number',
            'id' => 'account_number',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'account_number')
        );
        $this->data['account_csv_code'] = array(
            'name' => 'account_csv_code',
            'id' => 'account_csv_code',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'account_csv_code')
        );
        $this->data['cases_limit'] = $this->getUserMetaData($id, 'cases_limit');
        $this->data['cases_posted_address'] = array(
            'name' => 'cases_posted_address',
            'id' => 'cases_posted_address',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'cases_posted_address')
        );
        $this->data['report_from_home'] = array(
            'name' => 'report_from_home',
            'id' => 'report_from_home',
            'type' => 'text',
            'value' => $this->getUserMetaData($id, 'report_from_home')
        );
        $this->data['receive_work_days'] = $this->getUserMetaData($id, 'receive_work_days');
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
        $group_type = $this->ion_auth->get_group_type($group_id);
        if ($this->ion_auth->in_group('admin') && $group_type[0]->group_type === 'D') {
            $secretary_data = array();
            $this->load->model('Secretary_model');
            $all_secretaries = $this->Secretary_model->get_all_secretaries($id);
            foreach ($all_secretaries as $secretary_id) {
                $secretary = $this->Secretary_model->get_secretary_user_details($secretary_id->ura_sec_id);
                if (count($secretary) === 0) continue;
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
        $this->data['isMultiple'] = $this->leave_model->isUserMultiple($id);
//        echo $this->db->last_query();exit;
//        echo "<pre>";print_r($this->data['usersLeaveBalance']);exit;
        $includes['styles'] = array(
            'password/css/jquery.passwordRequirements.css',
            'css/daterangepicker.css'
        );
        $includes['javascripts'] = array(
            'js/jquery.form.min.js',
            'password/js/jquery.passwordRequirements.min.js',
            'js/daterangepicker.js',
            'password/js/custom.js',
            'js/auth/edit_user.js',
            'js/leaves.js');

        $this->_render_page('templates/header-new', $includes);
        $this->_render_page('auth/edit_user-new', $this->data);
        $this->_render_page('templates/footer-new', $includes);
    }

    public function unassign_secretary()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            return redirect('auth', 'refresh');
        }
        $user_id = $this->input->post('user_id');
        $sec_id = $this->input->post('sec_id');
        if (!isset($user_id) || is_null($user_id) || empty($user_id) || !isset($sec_id) || is_null($sec_id) || empty($sec_id)) {
            header('Content-Type: application/json');
            echo json_encode(array(
                "status" => "fail"
            ));
        } else {
            $this->load->model("Secretary_model");
            $this->Secretary_model->unassign_secretary($user_id, $sec_id);
            header('Content-Type: application/json');
            echo json_encode(array(
                "status" => "success"
            ));
        }
    }

    public function assign_secretary()
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            return redirect('auth', 'refresh');
        }
        $user_id = $this->input->post('user_id');
        $sec_ids = $this->input->post('sec_ids');
        if (!isset($user_id) || is_null($user_id) || empty($user_id) || !isset($sec_ids) || is_null($sec_ids) || empty($sec_ids)) {
            header('Content-Type: application/json');
            echo json_encode(array(
                "status" => "fail"
            ));
        } else {
            $this->load->model("Secretary_model");
            $this->Secretary_model->assign_secretary($user_id, $sec_ids);
            header('Content-Type: application/json');
            echo json_encode(array(
                "status" => "success"
            ));
        }
    }

    public function get_avaialable_secretary($user_id)
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin())) {
            return redirect('auth', 'refresh');
        }
        $this->load->model("Secretary_model");
        $secretaries = $this->Secretary_model->get_avaialble_secretary($user_id);
        $payload = array();
        foreach ($secretaries as $secretary_id) {
            $user_details = $this->Secretary_model->get_secretary_user_details($secretary_id['user_id']);
            if (count($user_details) == 0) {
                continue;
            }
            $user_details = $user_details[0];
            array_push($payload, array(
                "id" => $secretary_id['user_id'],
                "first_name" => $user_details['first_name'],
                "last_name" => $user_details['last_name'],
                "profile_picture" => $user_details['profile_picture_path'],
                "working_for" => $secretary_id['working_for']
            ));
        }
        header('Content-Type: application/json');
        echo json_encode(array(
            "status" => "success",
            "secretaries" => $payload
        ));
    }

    /**
     * Get User Meta Data
     *
     * @param [type] $id
     * @param string $type
     * @return void
     */
    public function getUserMetaData($id, $type = '')
    {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }
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

    public function updateUserCustomForm($id)
    {
        if (!empty($id)) {
            $meta_data_outsource = array(
                'outsource_work_name' => $this->input->post('outsource_work_name'),
                'outsource_work_avail_date' => $this->input->post('outsource_work_avail_date'),
                'account_name' => $this->input->post('account_name'),
                'account_number' => $this->input->post('account_number'),
                'account_csv_code' => $this->input->post('account_csv_code'),
                'cases_limit' => $this->input->post('cases_limit'),
                'cases_posted_address' => $this->input->post('cases_posted_address'),
                'report_from_home' => $this->input->post('report_from_home'),
                'receive_work_days' => $this->input->post('receive_work_days')
            );
            foreach ($meta_data_outsource as $key => $value) {
                //Check if Specific data exists in DB
                $db_meta = $this->db->where('user_id', $id)->where('meta_key', $key)->get('usermeta')->row_array();
                if (!empty($db_meta)) {
                    $this->db->where('user_id', $db_meta['user_id'])
                        ->where('meta_key', $db_meta['meta_key'])
                        ->update(
                            'usermeta',
                            array('meta_value' => $value)
                        );
                } else {
                    if (!empty($value)) {
                        $this->db->insert('usermeta', array('user_id' => $id, 'meta_key' => $key, 'meta_value' => $value));
                    }
                }
            }
            redirect('auth/edit_user/' . $id, 'refresh');
        }
    }

    /**
     * Delete User
     *
     * @param int $id
     * @return void
     */
    public function delete_user($id)
    {
        track_user_activity();
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }
        $this->ion_auth->delete_user($id);
        redirect("auth", 'refresh');
    }

    public function delete_user_ajax()
    {
        track_user_activity();
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }
        $user_id = $this->input->post("delete_user_id");
        $this->db->where('id', $user_id)->update('users', array('deleted' => 1));
        $response['status'] = "success";
        $response['message'] = "User Deleted Successfully";
        echo json_encode($response);exit;
    }

    /**
     * Create a new group
     *
     * @return void
     */
    public function create_group()
    {
        track_user_activity();
        $this->data['title'] = $this->lang->line('create_group_title');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required');
        $this->form_validation->set_rules('first_initial', $this->lang->line('create_group_validation_first_initial_label'), 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('last_initial', $this->lang->line('create_group_validation_last_initial_label'), 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('group_type', $this->lang->line('create_group_validation_type'), 'required|min_length[1]|max_length[1]');
        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group_main(
                strtolower(str_replace(' ', '', $this->input->post('group_name'))),
                $this->input->post('first_initial'),
                $this->input->post('last_initial'),
                $this->input->post('description'),
                $this->input->post('group_type'),
                $this->input->post('group_info'),
                $this->input->post('group_lab_number_format')
            );
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['first_initial'] = array(
                'name' => 'first_initial',
                'id' => 'first_initial',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_initial'),
            );
            $this->data['last_initial'] = array(
                'name' => 'last_initial',
                'id' => 'last_initial',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_initial'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );
            $this->data['group_type'] = array(
                'name' => 'group_type',
                'id' => 'group_type',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_type'),
            );
            $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('index.php'));
            $this->mybreadcrumb->add('Create Group', '#');
            $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
            $this->_render_page('templates/header');
            $this->_render_page('auth/create_group', $this->data);
            $this->_render_page('templates/footer');
        }
    }

    /**
     * Edit a group
     *
     * @param int $id
     * @return void
     */
    public function edit_group($id)
    {
        track_user_activity();
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }
        $this->data['title'] = $this->lang->line('edit_group_title');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        $group = $this->ion_auth->group($id)->row();

        $selectgroups = getRecords("*", "groups");
        //validate form input
        $this->form_validation->set_rules('first_initial', $this->lang->line('edit_group_validation_first_initial_label'), 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('last_initial', $this->lang->line('edit_group_validation_last_initial_label'), 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');
        if (isset($_POST) && !empty($_POST)) {
            $report_header = '';
            if (!empty($_POST['report_header'])) {
                $report_header = $_POST['report_header'];
            }
            $lab_format_mask = '';
            if (!empty($_POST['group_lab_number_format'])) {
                $lab_format_mask = $_POST['group_lab_number_format'];
            }
            if (!empty($_POST['set_default_user'])) {
                $user_default_id = $_POST['set_default_user'];
                //Set the user as default user by id.
                $this->db->where('id', $id)->update('groups', array('user_lab_default_status' => $user_default_id));
            }
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['first_initial'], $_POST['last_initial'], $_POST['group_description'], $report_header, $lab_format_mask);
                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("auth", 'refresh');
            }
        }
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        //pass the user to the view
        $this->data['group'] = $group;
        $this->data['allgroups'] = $selectgroups;
        $this->data['parent_id'] = $group->parent_id;
        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';
        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['first_initial'] = array(
            'name' => 'first_initial',
            'id' => 'first_initial',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_initial', $group->first_initial),
        );
        $this->data['last_initial'] = array(
            'name' => 'last_initial',
            'id' => 'last_initial',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_initial', $group->last_initial),
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );
        $this->data['report_header'] = array(
            'name' => 'report_header',
            'id' => 'report_header',
            'width' => '100%',
            'cols' => '69',
            'rows' => '30',
            'value' => $this->form_validation->set_value('report_header', $group->information),
        );
        $this->data['group_type'] = array(
            'name' => 'group_type',
            'id' => 'group_type',
            'readonly' => 'readonly',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_type', $group->group_type),
        );
        $this->data['lab_mask'] = $group->lab_mask;
        $this->mybreadcrumb->add('<i class="lnr lnr-home"></i>', base_url('index.php'));
        $this->mybreadcrumb->add('Edit Group', '#');
        $this->data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->_render_page('templates/header-new');
        $this->_render_page('auth/edit_group', $this->data);
        $this->_render_page('templates/footer-new');
    }

    /**
     * Get Roles Post Data And Insert it into User Roles Table
     *
     * @return void
     */
    public function assign_users_roles()
    {
        track_user_activity();
        $json = array();
        if (isset($_POST) && !$_POST['roles_name'] == 0) {
            $user_id = $this->input->post('user_id');
            $role_id = $this->input->post('roles_name');
            $get_user_role = $this->Ion_auth_model->get_user_role_data($user_id);
            if (!empty($get_user_role)) {
                $roles_data = array(
                    'role_id' => $role_id,
                    'user_id' => $user_id
                );
                $this->db->where('user_id', $user_id);
                $this->db->update('user_roles', $roles_data);
            } else {
                $roles_data = array(
                    'role_id' => $role_id,
                    'user_id' => $user_id
                );
                $this->db->insert('user_roles', $roles_data);
            }
            $json['type'] = 'success';
            $json['msg'] = 'Role Assigned to this User.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Role First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Verify Phone
     *
     * @return void
     */
    public function verify_phone()
    {
        $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';
        $check_cookie = $this->input->cookie('remember_auth_access_' . $user_id, TRUE);
        if (isset($check_cookie)) {
            $this->Ion_auth_model->set_session('', 'no');
            redirect('/', 'refresh');
        } else {
            if (isset($_SESSION['temp_data'])) {
                $this->load->view('templates/header-login');
                $this->load->view('auth/varify_phone');
                $this->load->view('templates/footer');
            } else {
                redirect('auth/login', 'refresh');
            }
        }
    }

    /**
     * Check Phone Verification
     *
     * @return void
     */
    public function check_phone_verification()
    {
        $json = array();
        if (isset($_SESSION['temp_data'])) {
            /**
             * Get Session Data
             * Check Phone Varification BY User ID
             */
            $email_id = !empty($_SESSION['temp_data']['identity']) ? $_SESSION['temp_data']['identity'] : '';
            $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';
            //Check if POST method is set.
            if (!empty($_POST['phone_no'])) {
                $phone_data = $this->Ion_auth_model->get_phone_by_user($email_id, $user_id);
                $user_phone = $_POST['phone_no'];
                if ($phone_data[0]->phone === $user_phone) {
                    /**
                     * Call 2FA Method
                     * @param email_id
                     * @param user_phone
                     */
                    $this->load->helper('authy_helper');
                    get_authy_data($email_id, $user_phone, $user_id);
                    $json['type'] = 'success';
                    $json['msg'] = '<div class="alert alert-success">Phone Verified. Please Wait...</div>';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['msg'] = '<div class="alert alert-danger">Your Phone is Not Verified.</div>';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Please Enter the Phone Number.</div>';
                echo json_encode($json);
                die;
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    /**
     * Check Authentication
     *
     * @return void
     */
    public function check_auth()
    {
        /**
         * User Auth View
         * 2FA
         */
        if (isset($_SESSION['temp_data'])) {
            $this->load->view('templates/header-login');
            $this->load->view('auth/verify_auth');
            $this->load->view('templates/footer');
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    /**
     * Check Access Token
     *
     * @return void
     */
    public function check_access_token()
    {
        $json = array();
        if (isset($_SESSION['temp_data'])) {
            /**
             * Get Session Data
             * Check Phone Varification BY User ID
             */
            $email_id = !empty($_SESSION['temp_data']['identity']) ? $_SESSION['temp_data']['identity'] : '';
            $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';
            if (!empty($_POST['user_token'])) {
                $access_data = $this->Ion_auth_model->get_accestoken_by_user($email_id, $user_id);
                $user_access = $_POST['user_token'];
                $authy_id = $access_data[0]->authy_id;
                /**
                 * Call 2FA Method
                 * @param email_id
                 * @param user_phone
                 */
                $this->load->helper('authy_helper');
                if (check_access($authy_id, $user_access, $user_id) === TRUE) {
                    if (isset($_POST['remember_for']) && $_POST['remember_for'] === 'true') {
                        $set_auth_cookie = array(
                            'name' => 'remember_auth_access_' . $user_id,
                            'value' => $user_id,
                            'expire' => '2678400'
                        );
                        $this->input->set_cookie($set_auth_cookie);
                    }
                    $json['type'] = 'success';
                    $json['msg'] = '<div class="alert alert-success">Access Token Verified.</div>';
                    echo json_encode($json);
                    $this->Ion_auth_model->set_session('', 'no');
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['msg'] = '<div class="alert alert-danger">Access Token Not Verified.</div>';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Please Enter Your Access Token.</div>';
                echo json_encode($json);
                die;
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    /**
     * Resend Authentication Code
     *
     * @return void
     */
    public function resend_auth_code()
    {
        /**
         * Get Session Data
         * Check Phone Varification BY User ID
         */
        if (isset($_SESSION['temp_data'])) {
            $email_id = !empty($_SESSION['temp_data']['identity']) ? $_SESSION['temp_data']['identity'] : '';
            $user_id = !empty($_SESSION['temp_data']['user_id']) ? $_SESSION['temp_data']['user_id'] : '';
            $this->load->helper('authy_helper');
            $access_data = $this->Ion_auth_model->get_accestoken_by_user($email_id, $user_id);
            $authy_id = $access_data[0]->authy_id;
            if (resend_access_code($authy_id) === TRUE) {
                $json['type'] = 'success';
                $json['msg'] = '<div class="alert alert-success">Access Code Send.</div>';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = '<div class="alert alert-danger">Access Code Not Send sue to some server error.</div>';
                echo json_encode($json);
                die;
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    /**
     * Save Batch Data
     *
     * @return void
     */
    public function edit_profile_picture()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $_POST['user_id'];
        $json['type'] = 'error';
        $json['msg'] = 'Something went wrong';
        if ($_FILES['profile_pic']["name"]) //when user submit basic profile info with profile image
        {
            $json['data']['image_name'] = $_FILES["profile_pic"]["name"];
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_pic')) {
                $error = 0;
            } else {
                $filedata = array('upload_data' => $this->upload->data());
                $profile_image = $filedata['upload_data']['file_name'];
                $image_path = 'uploads/' . $profile_image;
                $update = $this->Userextramodel->UpdateProfilePicture($user_id, $image_path);

                $json['type'] = 'success';
                $json['data']['user_id'] = $user_id;
                $json['msg'] = 'Picture updated Successfully.';
            }
        }
        echo json_encode($json);
        die;
    }


    function unlock_user()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->input->post('id');
        $email = $this->input->post('email');
        $this->ion_auth->clear_login_attempts($email);
        return redirect('/auth/edit_user/' . $user_id, 'refresh');
    }

    public function validation_is_unique_hospital_name()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->output->set_status_header(401);
            echo "Not authorized";
            return;
        }
        $name = $this->input->get('name');
        if (empty($name)) {
            $this->output->set_status_header(400);
            echo "Provide hospital name";
            return;
        }

        $row = $this->db->get_where('groups', array('description' => $name))->num_rows();
        $this->output
            ->set_content_type('application/json');

        if (empty($row)) {
            $this->output
                ->set_output(json_encode(TRUE));
        } else {
            $this->output
                ->set_output(json_encode(FALSE));
        }
    }

    public function validation_is_unique_user_email()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->output->set_status_header(401);
            echo "Not authorized";
            return;
        }
        $email = $this->input->get('email');
        if (empty($email)) {
            $this->output->set_status_header(400);
            echo "Provide user email";
            return;
        }

        $row = $this->db->query("SELECT * FROM `users` WHERE AES_DECRYPT(`users`.`email`, '" . DATA_KEY . "') = '$email'")->num_rows();

        $this->output->set_content_type('application/json');

        if (empty($row)) {
            $this->output
                ->set_output(json_encode(TRUE));
        } else {
            $this->output
                ->set_output(json_encode(FALSE));
        }
    }

    public function get_all_hospitals()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->output->set_status_header(401);
            echo "Not authorized";
            return;
        }
        $this->db->order_by('description', 'ASC');
        $res = $this->db->get_where('groups', array('group_type' => 'H'))->result_array();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($res));
    }

    public function get_all_roles()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->output->set_status_header(401);
            echo "Not authorized";
            return;
        }
        $this->db->order_by('description', 'ASC');
        $res = $this->db->get_where('groups', array('type_cate' => 'category'))->result_array();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($res));
    }

    public function get_all_roles_hospital()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->output->set_status_header(401);
            echo "Not authorized";
            return;
        }
        $this->db->order_by('description', 'ASC');
        $res = $this->db->get_where('groups', array('type_cate' => 'category'))->result_array();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($res));
    }

    public function get_all_organizations()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            $this->output->set_status_header(401);
            echo "Not authorized";
            return;
        }
        $this->db->order_by('description', 'ASC');
        $res = $this->db->get_where('groups', array('group_type !=' => 'H', 'type_cate' => 'usergroup'))->result_array();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($res));
    }

    public function update_password()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userId = $this->input->post('user_id');
        $password = $this->input->post('password');
        if ($this->input->post("pass_status")) {
            $update_password = $this->Ion_auth_model->update_password($password, $userId);
            $response['status'] = "success";
            $response['message'] = "Password changed successfully";
        } else {
            $this->form_validation->set_rules('prepass', 'Username', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $response['status'] = "fail";
                $response['message'] = validation_errors();
            } else {
                $prepass = $this->input->post('prepass');
                $user = $this->ion_auth->user($userId)->row();
                if ($this->ion_auth->verify_password($prepass, $user->password)) {
                    // Validate password strength
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);
                    $specialChars = preg_match('@[^\w]@', $password);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                        $response['status'] = "fail";
                        $response['message'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                    } else {
                        $whereArray['user_id'] = $user->id;
                        $allPasswords = $this->db->get_where('password_logs', $whereArray)->result();
                        $checkPass = $this->checkPasswordLogs($allPasswords, $password);
                        if ($checkPass) {
                            $numDays = 30;
                            $group_id = $this->ion_auth->get_users_groups()->row()->id;
                            $res = $this->db->get_where('password_expiry_settings', array('group_id' => $group_id))->row();
                            if (!empty($res)) {
                                $numDays = $res->days;
                            }
                            $Date1 = date('Y-m-d H:i:s');
                            $date = new DateTime($Date1);
                            $date->add(new DateInterval('P' . $numDays . 'D')); // P1D means a period of 1 day
                            $expiryDate = $date->format('Y-m-d H:i:s');
                            $update_password = $this->Ion_auth_model->update_password($password, $user->id);
                            $update_expiry = $this->Ion_auth_model->update_password_expiry($expiryDate, $user->id);
                            if ($update_expiry) {
                                $insRec['user_id'] = $user->id;
                                $insRec['password'] = $user->password;
                                $this->db->insert('password_logs', $insRec);
                            }
                            $response['status'] = "success";
                            $response['message'] = "Password changed successfully";
                        } else {
                            $response['status'] = "fail";
                            $response['message'] = "Please don't repeat existing password";
                        }
                    }
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Current password is incorrect";
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function checkPassword()
    {
        $userId = $this->input->post('user_id');
        $prepassbit = $this->input->post('prepassbit');
        $passwordbit = $this->input->post('newpassword');
        $prepass = $this->input->post('prepass');
        $password = $this->input->post('password');
        $user = $this->ion_auth->user($userId)->row();
        if ($prepassbit == 1) {
            if ($this->ion_auth->verify_password($prepass, $user->password)) {
                // Validate password strength
                $response['prepassbit'] = 1;
                $response['premessage'] = "Current password is ok";
            } else {
                $response['prepassbit'] = 0;
                $response['premessage'] = "Current password is incorrect";
            }
        }
        if ($passwordbit == 1) {
            $whereArray['user_id'] = $user->id;
            $allPasswords = $this->db->get_where('password_logs', $whereArray)->result();
            $checkPass = $this->checkPasswordLogs($allPasswords, $password);
            if ($checkPass) {
                $response['passbit'] = 1;
                $response['passmessage'] = "Success";
            } else {
                $response['passbit'] = 0;
                $response['passmessage'] = "This password was already used before";
            }
        }
        echo json_encode($response);
        exit;
    }

    public function checkPasswordLogs($allPasswords, $currentPassword)
    {
        $counter = 0;
        foreach ($allPasswords as $isPassword) {
            if ($this->ion_auth->verify_password($currentPassword, $isPassword->password)) {
                $counter++;
            }

        }
        if ($counter == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function password_change(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $includes['styles'] = array('password/css/jquery.passwordRequirements.css');
        $includes['javascripts'] = array('password/js/jquery.passwordRequirements.min.js', 'password/js/custom.js');
        $this->_render_page('templates/header-new',$includes);
        $this->_render_page('auth/password_change', $this->data);
        $this->_render_page('templates/footer-new',$includes);
    }

    public function check_session_time(){
        $status = $this->input->post('status');
        if(time() > $_SESSION['expire'] or $status=="logout"){
            session_destroy();
            session_write_close();
            session_unset();
            $_SESSION = array();
            $response['status'] = "logout";
        } else if($status=="continue"){
            $_SESSION['expire'] = time() + $_SESSION['inactivity_min']*60;
            $response['timer'] = $_SESSION['expire']-time();
        }
        else {
            if($_SESSION['expire']-time() <= 60){
                $response['status'] = "error";
                $response['timer'] = $_SESSION['expire']-time();
            } else {
                $response['status'] = "success";
                $response['timer'] = $_SESSION['expire']-time();
            }
        }
        echo json_encode($response);exit;
    }

    public function check_email_existance(){
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|callback__unique_email');
        $response['status'] = "success";
        if ($this->form_validation->run() === FALSE) {
            $response['status'] = "fail";
            $response['message'] = strip_tags(validation_errors());
        }
        echo json_encode($response);exit;
    }
}
