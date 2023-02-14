<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

Class SearchTracking extends CI_Controller 
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Searchtracking_model');
        $this->load->model('Admin_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'dashboard_functions_helper','ec_helper'));
    }

    /**
     * Search Tracking View
     *
     * @return void
     */
    public function search_tracking() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $session_records_ids = $this->session->userdata('session_records');
        $session_rec_data = array();
        if (!empty($session_records_ids) && isset($session_records_ids)) {
            $session_rec_data['session_data'] = $this->Searchtracking_model->get_all_session_records($session_records_ids);
        }
        $admin_id = $this->ion_auth->user()->row()->id;
        $hospital_users['hos_users'] = $this->Admin_model->get_hospital_groups();
        $lab_names['lab_names'] = $this->Admin_model->get_lab_names();
        $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
        $track_templates['track_templates'] = $this->Admin_model->get_all_track_record_templates($admin_id);
        $track_records['track_records'] = $this->Admin_model->display_tracking_records(date('Y'), intval(30));
        $track_get_data = array_merge($hospital_users, $lab_names, $doc_list, $track_templates, $track_records, $session_rec_data);
        $this->load->view('display/inc/search_track_header');
        $this->load->view('display/record_tracking/search_trackingv3', $track_get_data);
        $this->load->view('display/inc/search_track_footer');
    }

    /**
     * Get the template button data
     * retunr tags html
     *
     * @return void
     */
    public function get_load_template_data_tags() 
    {
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
            $clinic_user = $this->ion_auth->user($clinicid)->row()->username;
            $doctor_name = $this->ion_auth->user($pathologist)->row()->username;
            //Get Lab name
            $get_lab_name = $this->db->select('description')->where('id', $labname)->get('groups')->row_array();
            $tags_data .='<div class="tg-tagsholder">';
            $tags_data .='<div class="tg-tagsactive"></div>';
            $tags_data .='<ul class="tg-tagsarea template-tags-container" data-templateid="' . $templateid . '">';
            $tags_data .='<li class="tg-clinic">';
            $tags_data .='<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic: <em>' . $hospital_name . '</em><i>+</i></span></a>';
            $tags_data .='</li>';
            $tags_data .='<li class="tg-users">';
            $tags_data .='<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic User: <em>' . ucwords($clinic_user) . '</em><i>+</i></span></a>';
            $tags_data .='</li>';
            $tags_data .='<li class="tg-labs">';
            $tags_data .='<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Lab: <em>' . ucwords($get_lab_name['description']) . '</em><i>+</i></span></a>';
            $tags_data .='</li>';
            $tags_data .='<li class="tg-pathologist">';
            $tags_data .='<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Pathologist: <em>' . ucwords($doctor_name) . '</em><i>+</i></span></a>';
            $tags_data .=' </li>';
            $tags_data .='<li class= "tg-urgency">';
            $tags_data .='<a class="tg-tag" href = "javascript:;"><i class="fa fa-check"></i><span>Urgency: <em>' . ucwords($urgency) . ' </em><i>+</i></span></a>';
            $tags_data .='</li>';
            $tags_data .='<li class="tg-specimen">';
            $tags_data .='<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Specimen Type: <em>' . ucwords($specimen_type) . ' </em><i>+</i></span></a>';
            $tags_data .='</li>';
            $tags_data .='</ul>';
            $tags_data .='<div class="track_temp_edit_btn"><a class="tg-btntrackoption track_edit_template" href="javascript:;" data-templateid="' . $templateid . '" data-hospitalid="' . $hospitalid . '" data-clinicuserid="' . $clinicid . '" data-pathologist="' . $pathologist . '" data-labname="' . $labname . '" data-urgency="' . $urgency . '" data-specitype="' . $specimen_type . '"><span>Track Options Menu</span><i class="fa fa-pencil"></i></a></div>';
            $tags_data .='</div>';
            $json['type'] = 'success';
            $json['tags_data'] = $tags_data;
            $json['msg'] = 'Template Loaded';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Load Track Edit Templates
     *
     * @return void
     */
    public function load_track_edit_template_data() 
    {
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
            $hospital_users = $this->Admin_model->get_hospital_groups();
            $get_hospital_name = $this->db->select('description')->from('groups')->where('id', $hospitalid)->get()->row_array();
            $hospital_clinic_users = $this->Admin_model->get_all_hospital_users_by_group($hospitalid);
            $lab_names = $this->Admin_model->get_lab_names();
            $get_lab_name = $this->db->select('description')->where('id', $labid)->get('groups')->row_array();
            $doctor_list = $this->Admin_model->get_doctors();
            $clinic_username = '';
            
            if (!empty($clinicuserid)) {
                $clinic_username = $this->get_uralensis_username($clinicuserid);
            }

            $tmpl_edit_data .='<div class="tg-catagoryhead">';
            $tmpl_edit_data .='<h3>Track Options Menu</h3>';
            $tmpl_edit_data .='<a class="tg-btnsave update-track-template" href="javascript:;"><i class="fa fa-save"></i></a>';
            $tmpl_edit_data .='<a class="tg-btnacollapse collapse_temp_data_btn" href="javascript:;"><i class="fa fa-angle-up"></i></a>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='<div class="collapse_temp_data">';
            $tmpl_edit_data .='<form class="form track_temp_edit_form">';
            $tmpl_edit_data .='<div class="tg-topic">';
            $tmpl_edit_data .='<a href="javascript:;" class="show_clinic_btn">';
            $tmpl_edit_data .='<div class="tg-catagorytopic tg-clinic">';
            $tmpl_edit_data .='<span class="tg-checked fa fa-check"></span>';
            $tmpl_edit_data .='<i class="lnr lnr-apartment"></i>';
            $tmpl_edit_data .='<div class="tg-catagorycontent">';
            $tmpl_edit_data .='<h3>Clinic</h3>';
            $tmpl_edit_data .='<span class="display_selected_option">' . $get_hospital_name['description'] . '</span>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='<em>+</em>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='</a>';
            $tmpl_edit_data .='<div class="show-data-holder" style="background: #1abc9c;">';
            $tmpl_edit_data .='<div class="show_clinic">';
            $tmpl_edit_data .='<div class="show_clinic_title">';
            $tmpl_edit_data .='<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
            $tmpl_edit_data .='<h4><i class="lnr lnr-apartment"></i>Clinic</h4>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='<div class="input-scroll-holder ura-custom-scrollbar">';

            if (!empty($hospital_users)) {
                foreach ($hospital_users as $users) {
                    $hospital_name = !empty($users->description) ? $users->description : '';
                    $checked = '';
                    if ($hospitalid === $users->id) {
                        $checked = 'checked';
                    }
                    $tmpl_edit_data .='<div class="input-holder">';
                    $tmpl_edit_data .='<input ' . $checked . ' class="tat hospital_user" data-hospitalname="' . $hospital_name . '" type="radio" id="hospital_' . $users->id . '" name="hospital_user" value="' . $users->id . '">';
                    $tmpl_edit_data .='<label for="hospital_' . $users->id . '">' . $hospital_name . '</label>';
                    $tmpl_edit_data .='</div>';
                }
            }

            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .='</div>';
            $tmpl_edit_data .= '<div class="tg-topic">';
            $tmpl_edit_data .= '<a href="javascript:;" class="show_clinic_users_btn">';
            $tmpl_edit_data .= '<div class="tg-catagorytopic tg-users">';
            $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
            $tmpl_edit_data .= '<i class="lnr lnr-users"></i>';
            $tmpl_edit_data .= '<div class="tg-catagorycontent">';
            $tmpl_edit_data .= '<h3>Clinic Users</h3>';
            $tmpl_edit_data .= '<span class="display_selected_option">' . $clinic_username . '</span>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '<em>+</em>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</a>';
            $tmpl_edit_data .= '<div class="show-data-holder" style="background: #2ecc71;">';
            $tmpl_edit_data .= '<div class="show_clinic_users">';
            $tmpl_edit_data .= '<div class="show_clinic_title">';
            $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
            $tmpl_edit_data .= '<h4><i class="lnr lnr-users"></i>Clinic User</h4>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
            foreach ($hospital_clinic_users as $value) {
                $checked = '';
                if ($value['id'] === $clinicuserid) {
                    $checked = 'checked="checked"';
                }
                $tmpl_edit_data .= '<div class="input-holder">';
                $tmpl_edit_data .= '<input ' . $checked . ' class="tat" data-clinicuser="' . $value['first_name'] . ' ' . $value['last_name'] . '" type="radio" id="hospital_user_id_' . $value['id'] . '" name="clinic_users" value="' . $value['id'] . '">';
                $tmpl_edit_data .= '<label for="hospital_user_id_' . $value['id'] . '">' . $value['first_name'] . ' ' . $value['last_name'] . '</label>';
                $tmpl_edit_data .= '</div>';
            }
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .='</div>';
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
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search Hospital Group Users
     *
     * @return void
     */
    public function search_hospital_group_users() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $encode_data = '';
        $json = array();
        if (isset($_POST)) {
            $hospital_id = $this->input->post('hospital_id');
            $hospital_users = $this->Admin_model->get_all_hospital_users_by_group($hospital_id);
            if (!empty($hospital_users)) {
                $encode_data .= '<a href="javascript:;" class="show_clinic_users_btn">';
                $encode_data .= '<div class="tg-catagorytopic tg-users">';
                $encode_data .= '<i class="lnr lnr-users"></i>';
                $encode_data .= '<div class="tg-catagorycontent">';
                $encode_data .= '<h3>Clinic Users</h3>';
                $encode_data .= '<span class="display_selected_option"></span>';
                $encode_data .= '</div>';
                $encode_data .= '<em>+</em>';
                $encode_data .= '</div>';
                $encode_data .= '</a>';
                $encode_data .= '<div class="show-data-holder" style="background: #2ecc71;">';
                $encode_data .= '<div class="show_clinic_users">';
                $encode_data .= '<div class="show_clinic_title">';
                $encode_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
                $encode_data .= '<h4><i class="lnr lnr-users"></i>Clinic User</h4>';
                $encode_data .= '</div>';
                $encode_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
                foreach ($hospital_users as $value) {
                    $encode_data .= '<div class="input-holder">';
                    $encode_data .= '<input class="tat" data-clinicuser="' . $value['first_name'] . ' ' . $value['last_name'] . '" type="radio" id="hospital_user_id_' . $value['id'] . '" name="clinic_users" value="' . $value['id'] . '">';
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
     * Save Temp Data
     * @return string
     */
    public function update_track_edit_temp_data() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($_POST)) {
            $template_id = $this->input->post('template_id');
            $hospital_user = $this->input->post('hospital_user');
            $clinic_users = $this->input->post('clinic_users');
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

    /**
     * Load Track New Template
     *
     * @return void
     */
    public function load_track_new_template() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $tmpl_edit_data = '';
        $json = array();
        $hospital_users = $this->Admin_model->get_hospital_groups();
        $lab_names = $this->Admin_model->get_lab_names();
        $doctor_list = $this->Admin_model->get_doctors();
        $tmpl_edit_data .='<div class="tg-catagoryhead">';
        $tmpl_edit_data .='<h3>Track Options Menu</h3>';
        $tmpl_edit_data .='<a class="tg-btnsave save-track-template" href="javascript:;"><i class="fa fa-save"></i></a>';
        $tmpl_edit_data .='<a class="tg-btnacollapse collapse_temp_data_btn" href="javascript:;"><i class="fa fa-angle-up"></i></a>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='<div class="collapse_temp_data">';
        $tmpl_edit_data .='<form class="form track_temp_edit_form">';
        $tmpl_edit_data .= '<div class="col-md-3 show_template_name_input hidden-boxes"><input type="text" name="track_template_name" class="form-control"></div>';
        $tmpl_edit_data .= '<div class="clearfix"></div>';
        $tmpl_edit_data .='<div class="tg-topic">';
        $tmpl_edit_data .='<a href="javascript:;" class="show_clinic_btn">';
        $tmpl_edit_data .='<div class="tg-catagorytopic tg-clinic">';
        $tmpl_edit_data .='<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .='<i class="lnr lnr-apartment"></i>';
        $tmpl_edit_data .='<div class="tg-catagorycontent">';
        $tmpl_edit_data .='<h3>Clinic</h3>';
        $tmpl_edit_data .='<span class="display_selected_option"></span>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='<em>+</em>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='</a>';
        $tmpl_edit_data .='<div class="show-data-holder" style="background: #1abc9c;">';
        $tmpl_edit_data .='<div class="show_clinic">';
        $tmpl_edit_data .='<div class="show_clinic_title">';
        $tmpl_edit_data .='<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .='<h4><i class="lnr lnr-apartment"></i>Clinic</h4>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='<div class="input-scroll-holder ura-custom-scrollbar">';
        if (!empty($hospital_users)) {
            foreach ($hospital_users as $users) {
                $hospital_name = !empty($users->description) ? $users->description : '';
                $tmpl_edit_data .='<div class="input-holder">';
                $tmpl_edit_data .='<input class="tat hospital_user" data-hospitalname="' . $hospital_name . '" type="radio" id="hospital_' . $users->id . '" name="hospital_user" value="' . $users->id . '">';
                $tmpl_edit_data .='<label for="hospital_' . $users->id . '">' . $hospital_name . '</label>';
                $tmpl_edit_data .='</div>';
            }
        }

        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .='</div>';
        $tmpl_edit_data .= '<div class="tg-topic">';
        $tmpl_edit_data .= '<a href="javascript:;" class="show_clinic_users_btn">';
        $tmpl_edit_data .= '<div class="tg-catagorytopic tg-users">';
        $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .= '<i class="lnr lnr-users"></i>';
        $tmpl_edit_data .= '<div class="tg-catagorycontent">';
        $tmpl_edit_data .= '<h3>Clinic Users</h3>';
        $tmpl_edit_data .= '<span class="display_selected_option"></span>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<em>+</em>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</a>';
        $tmpl_edit_data .= '<div class="show-data-holder" style="background: #2ecc71;">';
        $tmpl_edit_data .= '<div class="show_clinic_users">';
        $tmpl_edit_data .= '<div class="show_clinic_title">';
        $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .= '<h4><i class="lnr lnr-users"></i>Clinic User</h4>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .='</div>';
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
     *
     * @return void
     */
    public function save_new_track_temp_data() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->ion_auth->user()->row()->id;
        if (!empty($_POST)) {
            $hospital_user = $this->input->post('hospital_user');
            $clinic_users = $this->input->post('clinic_users');
            $lab_name = $this->input->post('lab_name');
            $pathologist = $this->input->post('pathologist');
            $report_urgency = $this->input->post('report_urgency');
            $specimen_type = $this->input->post('specimen_type');
            $template_name = $this->input->post('track_template_name');

            //Prepare Data for update
            $temp_data = array(
                'temp_assignee_id' => $user_id,
                'temp_hospital_user' => !empty($hospital_user) ? $hospital_user : '',
                'temp_clinic_user' => !empty($clinic_users) ? $clinic_users : '',
                'temp_pathologist' => !empty($pathologist) ? $pathologist : '',
                'temp_lab_name' => !empty($lab_name) ? $lab_name : '',
                'temp_report_urgency' => !empty($report_urgency) ? $report_urgency : '',
                'temp_skin_type' => !empty($specimen_type) ? $specimen_type : '',
                'temp_input_name' => !empty($template_name) ? $template_name : '',
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_track_template', $temp_data);

            $json['type'] = 'success';
            $json['msg'] = 'Track Template Inserted successfully.';
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
     * Search record based on barcode scanner
     *
     * @return void
     */
    public function search_and_add_barcode_record() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $search_term = $this->input->post('barcode');
        $json = array();
        $encode = '';
        if (isset($_POST) && $_POST['search_type'] === 'only_search') {
            $query = $this->db->where('ura_barcode_no', $search_term)->get('request')->row_array();
           // echo last_query();exit;

            //Get the doctor id
            $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];
           
            if (!empty($query)) {
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
                $encode .= '<td><a target="_blank" href="' . site_url() . '/admin/detail_view_record/' . $query['uralensis_request_id'] . '">' . $query['lab_number'] . '</a></td>';
                $encode .= '<td>' . ucwords(substr($query['report_urgency'], 0, 1)) . '</td>';
                $publish_date = '';
                if (!empty($query['publish_datetime'])) {
                    $publish_date = date('d-m-Y', strtotime($query['publish_datetime']));
                }
                $encode .= '<td>' . $publish_date . '</td>';
                $encode .= '<td class="dropdown tg-userdropdown tg-liststatuses">';
                $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->get_track_template_statuses($query['uralensis_request_id'], 'recent')['ura_rec_track_status'] . '</a>';
                $encode .= '<ul class="dropdown-menu tg-themedropdownmenu custom-list-scroll ura-custom-scrollbar" aria-labelledby="tg-adminnav">';
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
                } elseif ($query['flag_status'] === 'flag_yellow') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                } elseif ($query['flag_status'] === 'flag_blue') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                } elseif ($query['flag_status'] === 'flag_black') {
                    $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                } elseif ($query['flag_status'] === 'flag_gray') {
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
                $count_docs_result = $this->Searchtracking_model->count_documents($query['uralensis_request_id'], $doctor_id);
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
                if ($record_old_count <= 10) {
                    $badge = 'bg-success';
                } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                    $badge = 'bg-warning';
                } else {
                    $badge = 'bg-danger';
                }

                $encode .= '<span class="badge ' . $badge . '">' . $record_old_count . '</span>';
                $encode .= '</a>';
                $encode .= '</td>';
                $encode .= '<td><a href="' . base_url('index.php/admin/edit_report/' . $query['uralensis_request_id']) . '"><img src="' . base_url('assets/img/edit.png') . '"></a></td>';
                $encode .= '<td class="dropdown tg-userdropdown tg-menu-dropdown">';
                $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><span class="lnr lnr-menu"></span></a>';
                $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
                $encode .= '<li>';
                $encode .= '<a href="javascript:;"><i class="lnr lnr-trash"></i><em>Delete</em></a>';
                $encode .= '</li>';
                $encode .= '</ul>';
                $encode .= '</td>';
                $encode .= '</tr>';
                $encode .= '</table>';

                $json['type'] = 'success';
                $json['encode_data'] = $encode;
                $json['msg'] = 'Record found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No record found against this tracking number.';
                echo json_encode($json);
                die;
            }
        } elseif ($_POST['search_type'] === 'add_record') {
            $encode = '';
            $encode_status = '';

            //Get the all post data
            $template_id = $this->input->post('template_id');
            $status_code = $this->input->post('status_code');

            //Create template id and status combine key.
            $batch_session_key = $template_id . '-' . str_replace(' ', '', strtolower($status_code));

            $batch_array = array(
                $search_term => $search_term
            );

            //Prepare Data for insertion
            $batch_data = array(
                'template_id' => $template_id,
                'status_code' => $status_code,
                'session_batch_key' => $batch_session_key,
                'session_batch_data' => serialize($batch_array),
                'timestamp' => time()
            );

            //Check first if data already exists.
            $check_batch_record = $this->db->where('session_batch_key', $batch_session_key)->get('uralensis_session_record_batch')->row_array();
            $get_batch_data = unserialize($check_batch_record['session_batch_data']);
            if (empty($check_batch_record)) {
                $this->db->insert('uralensis_session_record_batch', $batch_data);
            } elseif (!empty($check_batch_record) && array_key_exists($search_term, $get_batch_data)) {
                $json['type'] = 'error';
                $json['msg'] = 'Somehow record found to be deleted or not found. Contact to Administrator.';
                echo json_encode($json);
                die;
                return true;
            } else {
                $update_array = array(
                    $search_term => $search_term
                );
                $final_data = array_merge($get_batch_data, $update_array);
                $update_batch_data = array(
                    'session_batch_data' => serialize($final_data)
                );
                $this->db->where('session_batch_key', $batch_session_key);
                $this->db->update('uralensis_session_record_batch', $update_batch_data);
            }
            //Check if record already exist in 
            //the system then show the error

            $check_record_vd_barcode = $this->db->where('ura_barcode_no', $search_term)->get('request')->row_array();
            if (!empty($check_record_vd_barcode['ura_barcode_no'])) {
                //Check if record status is already added or same
                $check_record_status = $this->db->where('ura_rec_track_status', $status_code)->where('ura_rec_track_no', $check_record_vd_barcode['ura_barcode_no'])->get('uralensis_record_track_status')->row_array();

                if (!empty($check_record_status['ura_rec_track_status']) && $check_record_status['ura_rec_track_status'] === $status_code) {
                    $json['type'] = 'update_statuses';
                    $json['msg'] = 'Record already existed with same track status.';
                    $json['status_msg'] = 'Record found: Track Status - ' . $status_code . '.';
                    echo json_encode($json);
                    die;
                } else {
                    /**
                     * Now update the status if status not found in the table
                     * Gather information from other table in order
                     * to insert the data in status table.
                     */
                    $get_request_data = $this->db->select('uralensis_request_id, lab_name')->where('ura_barcode_no', $search_term)->get('request')->row_array();
                    $record_track_id = '';
                    $record_track_lab = '';
                    if (!empty($get_request_data)) {
                        $record_track_id = $get_request_data['uralensis_request_id'];
                        $record_track_lab = $get_request_data['lab_name'];
                    }

                    $check_record_assign_status = $this->db->select('user_id')->where('request_id', $record_track_id)->get('request_assignee')->row_array();
                    if (empty($check_record_assign_status)) {
                        $pathologist_status = 'Not Assigned';
                    } else {
                        $pathologist_name = $this->get_uralensis_username($check_record_assign_status['user_id']);
                        $pathologist_status = $pathologist_name;
                    }

                    //Check if lab release date is already added.
                    $check_lab_release_date = $this->db->select('date_sent_touralensis')->from('request')->where('uralensis_request_id', $record_track_id)->get()->row_array();
                    if ($status_code === 'Booked out from Lab' && !empty($check_lab_release_date['date_sent_touralensis'])) {
                        $track_status_data = array(
                            'ura_rec_track_no' => $search_term,
                            'ura_rec_track_location' => $record_track_lab,
                            'ura_rec_track_record_id' => intval($record_track_id),
                            'ura_rec_track_status' => $status_code,
                            'ura_rec_track_pathologist' => $pathologist_status,
                            'timestamp' => time()
                        );
                        $this->db->insert('uralensis_record_track_status', $track_status_data);
                        $json['type'] = 'error';
                        $json['msg'] = 'Lab release date already been added.';
                        echo json_encode($json);
                        die;
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
                    $encode_status .='<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->Searchtracking_model->get_track_template_statuses($record_track_id, 'recent')['ura_rec_track_status'] . '</a>';
                    $encode_status .= '<ul class="dropdown-menu tg-themedropdownmenu custom-list-scroll ura-custom-scrollbar" aria-labelledby="tg-adminnav">';
                    $list_statuses = $this->Searchtracking_model->get_track_template_statuses($record_track_id, 'all');
                    if (!empty($list_statuses)) {
                        foreach ($list_statuses as $statuses) {
                            $encode_status .= '<li>';
                            $encode_status .= '<a href="javascript:;">';
                            $encode_status .= '<span>' . $statuses['ura_rec_track_status'] . '</span>';
                            $encode_status .= '</a>';
                            $encode_status .= '</li>';
                        }
                    }
                    $encode_status .='</ul>';
                    $json['type'] = 'update_statuses';
                    $json['msg'] = 'Record already existed and track status updated.';
                    $json['status_msg'] = 'Record found: Track Status - ' . $status_code . '.';
                    $json['encode_status'] = $encode_status;
                    echo json_encode($json);
                    die;
                }
            }

            //Get the data from template track table
            //and get all necessary field for adding record.
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
            } elseif ($serial_query->num_rows() < 0) {
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

            $this->Admin_model->institute_insert($request);

            //Fetch the record last inserted id.
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

            //Set Session and save record ids array in session.
            $record_session_val = $this->session->userdata('record_ids', $record_last_id);
            $record_session_val[] = $record_last_id;
            $this->session->set_userdata('record_ids', $record_session_val);
            $session_record_data = $this->session->userdata('record_ids');

            //Add the entry in user request table.
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

            //Save bookin from clinic status
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
            $query = $this->db->where('ura_barcode_no', $search_term)->get('request')->row_array();

            //Get the doctor id
            $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];

            //Check if all session record exists in actually database.
            if (!empty($session_record_data)) {
                $check_record = array();
                foreach ($session_record_data as $ids) {
                    if (!empty($ids)) {
                        $check_record[] = $this->db->where('uralensis_request_id', $ids)->get('request')->row_array();
                        $record_data = array_filter($check_record);
                    }
                }
            }

            //Set session for final records and save in session
            //Get all records ids from record_data
            if (!empty($record_data)) {
                $record_ids_data = array();
                foreach ($record_data as $recordids) {
                    $record_ids_data[] = $recordids['uralensis_request_id'];
                }
            }
            $this->session->set_userdata('session_records', $record_ids_data);

            if (!empty($record_data)) {
                $encode .= '<a target="_blank" href="' . base_url('index.php/admin_tracking/SearchTracking/print_session_records') . '">Print Records</a>';
                $encode .= '<table class="table track_search_table">';
                $encode .= '<tr class="bg-primary">';
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
                    $encode .= '<td><a target="_blank" href="' . site_url() . '/admin/detail_view_record/' . $row_data['uralensis_request_id'] . '">' . $row_data['lab_number'] . '</a></td>';
                    $encode .= '<td>' . ucwords(substr($row_data['report_urgency'], 0, 1)) . '</td>';
                    $publish_date = '';
                    if (!empty($row_data['publish_datetime'])) {
                        $publish_date = date('d-m-Y', strtotime($row_data['publish_datetime']));
                    }
                    $encode .= '<td>' . $publish_date . '</td>';
                    $encode .= '<td class="dropdown tg-userdropdown tg-liststatuses">';
                    $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->get_track_template_statuses($row_data['uralensis_request_id'], 'recent')['ura_rec_track_status'] . '</a>';
                    $encode .= '<ul class="dropdown-menu tg-themedropdownmenu custom-list-scroll ura-custom-scrollbar" aria-labelledby="tg-adminnav">';
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
                    } elseif ($row_data['flag_status'] === 'flag_yellow') {
                        $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_yellow.png') . '">';
                    } elseif ($row_data['flag_status'] === 'flag_blue') {
                        $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_blue.png') . '">';
                    } elseif ($row_data['flag_status'] === 'flag_black') {
                        $encode .= '<img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="' . base_url('assets/img/flag_lg_black.png') . '">';
                    } elseif ($row_data['flag_status'] === 'flag_gray') {
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
                    $count_docs_result = $this->Searchtracking_model->count_documents($row_data['uralensis_request_id'], $doctor_id);
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
                    } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                        $badge = 'bg-warning';
                    } else {
                        $badge = 'bg-danger';
                    }

                    $encode .= '<span class="badge ' . $badge . '">' . $record_old_count . '</span>';
                    $encode .= '</a>';
                    $encode .= '</td>';
                    $encode .= '<td><a href="' . base_url('index.php/admin/edit_report/' . $row_data['uralensis_request_id']) . '"><img src="' . base_url('assets/img/edit.png') . '"></td>';
                    $encode .= '<td class="dropdown tg-userdropdown tg-menu-dropdown">';
                    $encode .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true"><span class="lnr lnr-menu"></span></a>';
                    $encode .= '<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">';
                    $encode .= '<li>';
                    $encode .= '<a href="javascript:;"><i class="lnr lnr-trash"></i><em>Delete</em></a>';
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
            echo json_encode($json);
            die;
        }
    }

    /**
     * Get track template statuses
     *
     * @param int $record_id
     * @param string $get_type
     * @return void
     */
    public function get_track_template_statuses($record_id = '', $get_type = '') 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($record_id)) {
            if (!empty($get_type) && $get_type === 'recent') {
                return $this->db->where('ura_rec_track_record_id', $record_id)->order_by("ura_rec_track_id", "desc")->limit(1)->get('uralensis_record_track_status')->row_array();
            } elseif (!empty($get_type) && $get_type === 'all') {
                return $this->db->where('ura_rec_track_record_id', $record_id)->order_by("ura_rec_track_id", "desc")->get('uralensis_record_track_status')->result_array();
            }
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
     * Print Session Records
     *
     * @return void
     */
    public function print_session_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $session_records_ids = $this->session->userdata('session_records');
        $session_rec_data = array();
        if (!empty($session_records_ids) && isset($session_records_ids)) {
            $session_rec_data['session_data'] = $this->Searchtracking_model->get_all_session_records($session_records_ids);
        }
        $this->load->view('display/sessions_record_pdf', $session_rec_data);
    }

    /**
     * Track Session Records Status
     *
     * @return void
     */
    public function track_session_records_status() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $track_templates['track_templates'] = $this->Searchtracking_model->get_track_all_templates();


        $this->load->view('display/inc/search_track_header-new');
        $this->load->view('display/record_tracking/track_session_record_status', $track_templates);
        $this->load->view('display/inc/search_track_footer-new');
        // $this->load->view('display/inc/search_track_header');
        // $this->load->view('display/record_tracking/track_session_record_status', $track_templates);
        // $this->load->view('display/inc/search_track_footer');
    }

    /**
     * Search Template Session Record Data
     *
     * @return void
     */
    public function search_template_session_record_data() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $track_batch_data = array();
        $json = array();
        $encode_data = '';
        if (isset($_POST)) {
            $template_id = $this->input->post('template_id');
            $track_batch_data = $this->Searchtracking_model->get_session_record_batch_data($template_id);

            if (!empty($track_batch_data)) {
                $encode_data .= '<div class="row">';
                $encode_data .= '<div class="col-md-12">';
                $count = 1;
                foreach ($track_batch_data as $data) {
                    $session_data = unserialize($data['session_batch_data']);
                    $record_data = $this->Searchtracking_model->get_session_batch_records($session_data);
                    $encode_data .= '<div class="haslayout">';
                    $encode_data .= '<p>' . $count . '--&nbsp;&nbsp;Date: ' . date('d-m-Y H:i:s', $data['timestamp']) . '&nbsp;<span class="lnr lnr-arrow-right"></span>&nbsp;Status: ' . $data['status_code'] . '&nbsp;&nbsp;&nbsp;<button data-toggle="collapse" data-target="#collapse_records_' . $count . '"><span class="lnr lnr-arrow-down"></span></button></p>';
                    $encode_data .='<div id="collapse_records_' . $count . '" class="collapse">';
                    $encode_data .= '<table class="table table-bordered">';
                    $encode_data .= '<tr class="bg-primary">';
                    $encode_data .= '<th><b>UL No.</b></th>';
                    $encode_data .= '<th><b>Track No.</b></th>';
                    $encode_data .= '<th><b>Client</b></th>';
                    $encode_data .= '<th><b>First Name</b></th>';
                    $encode_data .= '<th><b>Surname</b></th>';
                    $encode_data .= '<th><b>DOB</b></th>';
                    $encode_data .= '<th><b>NHS No.</b></th>';
                    $encode_data .= '<th><b>Lab No.</b></th>';
                    $encode_data .= '<th><b>Type</b></th>';
                    $encode_data .= '<th><b>Release Date</b></th>';
                    $encode_data .= '<th><b>TAT</b></th>';
                    $encode_data .= '</tr>';
                    if (!empty($record_data)) {
                        foreach ($record_data as $row) {
                            $f_initial = '';
                            $l_initial = '';
                            if (!empty($this->ion_auth->group($row['hospital_group_id'])->row()->first_initial)) {
                                $f_initial = $this->ion_auth->group($row['hospital_group_id'])->row()->first_initial;
                            }
                            if (!empty($this->ion_auth->group($row['hospital_group_id'])->row()->last_initial)) {
                                $l_initial = $this->ion_auth->group($row['hospital_group_id'])->row()->last_initial;
                            }

                            $publish_date = '';
                            if (!empty($row['publish_datetime'])) {
                                $publish_date = date('d-m-Y', strtotime($row['publish_datetime']));
                            }

                            $now = time(); // or your date as well
                            $date_taken = !empty($row['date_taken']) ? $row['date_taken'] : '';
                            $request_date = !empty($row['request_datetime']) ? $row['request_datetime'] : '';
                            $tat_date = '';

                            if (!empty($date_taken)) {
                                $tat_date = $date_taken;
                            } else {
                                $tat_date = $request_date;
                            }

                            $compare_date = strtotime("$tat_date");
                            $datediff = $now - $compare_date;
                            $record_old_count = floor($datediff / (60 * 60 * 24));
                            $encode_data .= '<tr>';
                            $encode_data .= '<td>' . $row['serial_number'] . '</td>';
                            $encode_data .= '<td>' . $row['ura_barcode_no'] . '</td>';
                            $encode_data .= '<td>' . $f_initial . ' ' . $l_initial . '</td>';
                            $encode_data .= '<td>' . $row['f_name'] . '</td>';
                            $encode_data .= '<td>' . $row['sur_name'] . '</td>';
                            $encode_data .= '<td>' . $row['dob'] . '</td>';
                            $encode_data .= '<td>' . $row['nhs_number'] . '</td>';
                            $encode_data .= '<td>' . $row['lab_number'] . '</td>';
                            $encode_data .= '<td>' . $row['report_urgency'] . '</td>';
                            $encode_data .= '<td>' . $publish_date . '</td>';
                            $encode_data .= '<td>' . $record_old_count . '</td>';
                            $encode_data .= '</tr>';
                        }
                    }
                    $encode_data .= '</table>';
                    $encode_data .= '</div>';
                    $encode_data .= '<hr>';
                    $encode_data .= '</div>';
                    $count++;
                }

                $encode_data .= '</div>';
                $encode_data .= '</div>';
                $json['type'] = 'success';
                $json['session_batch_data'] = $encode_data;
                $json['msg'] = 'Session Batch Record Found Successfully.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Session Batch Record Found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Create New Session Track List
     *
     * @return void
     */
    public function create_new_session_track_record_list() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
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
        } elseif ($batch_query->num_rows() < 0) {
            $key = 'Batch-' . date('y') . '-1';
        } else {
            $key = 'Batch-' . date('y') . '-1';
        }

        if (isset($_SESSION) && !empty($_SESSION['session_records'])) {
            //Get the Db 
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
    public function view_session_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('display/inc/search_track_header');
        $this->load->view('display/record_tracking/view_session_records');
        $this->load->view('display/inc/search_track_footer');
    }

    /**
     * Print Session Records DB Data
     *
     * @param int $sess_record_id
     * @return void
     */
    public function print_session_records_document($sess_record_id) 
    {
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
            $session_rec_data['session_data'] = $this->Searchtracking_model->get_all_session_records($extract_data);
        }
        $this->load->view('display/sessions_record_pdf', $session_rec_data);
    }

}
