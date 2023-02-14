<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Doctor Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class Doctor extends CI_Controller
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Institute_model');
        $this->load->model('Doctor_model');
		$this->load->model('Admin_model');
        $this->load->model('Pm_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'activity_helper', 'dashboard_functions_helper', 'datasets_helper', 'ec_helper'));
        $this->load->library('email');
        $this->load->helper("file");
        $this->load->library('Mybreadcrumb');
        $this->load->model('Userextramodel');

        track_user_activity();
    }

    /**
     * Dashboard Function
     * Load Dashboard View
     *
     * @return void
     */
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $published['published'] = $this->Doctor_model->status_bar_result_count_published('');
        $unpublished['unpublished'] = $this->Doctor_model->status_bar_result_count_un_reported('');
        $totalreports['totalreports'] = $this->Doctor_model->status_bar_result_count_total_reports();
        $login_records['previous_login'] = $this->Doctor_model->previous_login_records();

        $decryptedDetails['decryptedDetails'] = $this->Userextramodel->getUserDecryptedDetailsByid($doctor_id);
        $dashboard_reports_status = array_merge($published, $unpublished, $totalreports, $login_records, $decryptedDetails);
        $this->load->model('Tasks_model');
        $dashboard_reports_status['task_stats'] = $this->Tasks_model->get_stats($doctor_id);
        $dashboard_reports_status["query"] = $this->Doctor_model->doctor_record_list($doctor_id);
        $dashboard_reports_status['pathologists'] = $this->Doctor_model->get_doctors_data();
        $dashboard_reports_status['active_pathologists'] = $this->Doctor_model->get_logged_in_doctors();
        $dashboard_reports_status['upload_docs'] = $this->Institute_model->get_upload_doc_forms();
        $dashboard_reports_status['doc_case_files'] = $this->Doctor_model->get_doctor_files();
//        echo '<pre>'; print_r($dashboard_reports_status['doc_case_files']); exit;
        $dashboard_reports_status['unpublished_stats'] = $this->Doctor_model->dr_dash_unpublished_stats($doctor_id);
        $dashboard_reports_status['published_stats'] = $this->Doctor_model->dr_dash_published_stats($doctor_id, $period = 7);
        $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
        $full_name = $userinfo[0]->last_name . ' ' . $userinfo[0]->first_name;
        $data['user_name'] = $full_name;
        $twelve_m_data = $this->Doctor_model->doctor_tat_last_12_month($doctor_id);

        $cv_appr_data = array(
            'gmc_no' => $this->getUserMetaData($doctor_id, 'gmc_no'),
            'last_appraisal' => $this->getUserMetaData($doctor_id, 'last_appraisal'),
            'next_appraisal' => $this->getUserMetaData($doctor_id, 'next_appraisal'),
            'cpd_last' => $this->getUserMetaData($doctor_id, 'cpd_last'),
            'cpd_next' => $this->getUserMetaData($doctor_id, 'cpd_next'),
            'revalidation' => $this->getUserMetaData($doctor_id, 'revalidation'),
            'cv_doc_file_name' => $this->getUserMetaData($doctor_id, 'cv_doc_file_name'),
            'trainee_name' => $this->getUserMetaData($doctor_id, 'trainee_name'),
            'trainee_period_start' => $this->getUserMetaData($doctor_id, 'trainee_period_start'),
            'trainee_period_end' => $this->getUserMetaData($doctor_id, 'trainee_period_end'),
        );

        $dashboard_reports_status["cv_appr_data"] = $cv_appr_data;

        $yms = array();
        $now = date('Y-m');
        for ($x = 12; $x >= 1; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
            $yms[$ym] = $ym;
        }

        $data_sorted = array();
        $data_sort_itr = 0;

        foreach ($yms as $key => $value) {
            $found_obj = 0;
            $count = 0;
            $yr_mon = $value;
            foreach ($twelve_m_data as $k => $v) {
                if ($v->y_m == $yr_mon) {
                    $count++;
                    $found_obj = $v;
                }
            }
            if ($count == 0) {
//                Months Not Exists
                $dt_comp = $yr_mon . "-01";
                $date_formatted = date('m/y', strtotime($dt_comp));
                $empty_obj = (object)['y_m' => $yr_mon, 'publish_month' => $date_formatted, 'num_of_cases' => 0, 'tat_less_ten' => 0, 'tat_less_ten_percent' => 0, 'target_less_ten' => 0,];
                array_push($data_sorted, $empty_obj);
            } else {
                array_push($data_sorted, $found_obj);
            }
        }


        if ($this->input->post('edit_cv_appraisal')) {

            $doc_id = $this->ion_auth->user()->row()->id;
            $ref_key = $doc_id;
            $this->load->library('upload');
            $cv_doc_file_name = "";
            if ($_FILES['upload_cv']['name'] != '') {
                $upload_cv = $this->do_upload_cv('upload_cv', $ref_key);
                if ($upload_cv == FALSE) {
                    $error = array('upload_error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_error', $error['upload_error']);
                } else {
                    $data = $this->upload->data();
                    $cv_doc_file_name = "uploads/doc_cvs/" . $data['file_name'];
                }
            }

            $date_range = $this->input->post('date_range');
            $splitted = (explode("-", $date_range));

            $last_dt = date("Y-m-d", strtotime($splitted[0]));
            $next_dt = date("Y-m-d", strtotime($splitted[1]));

            $apr_date_range = $this->input->post('last_appraisal');
            $apr_splitted = (explode("-", $apr_date_range));

            $apr_last_dt = date("Y-m-d", strtotime($apr_splitted[0]));
            $apr_next_dt = date("Y-m-d", strtotime($apr_splitted[1]));

            $meta_data_user_detail = array(
                'gmc_no' => $this->input->post('gmc_no'),
                'last_appraisal' => $apr_last_dt,
                'next_appraisal' => $apr_next_dt,
                'cpd_last' => $last_dt,
                'cpd_next' => $next_dt,
                'revalidation' => $this->input->post('revalidation'),
            );

            if ($this->input->post('is_education_supervisor')) {
                $trainee_name = $this->input->post('trainee_name');
                $trn_date_range = $this->input->post('train_period');
                $trn_splitted = (explode("-", $trn_date_range));

                $trn_last_dt = date("Y-m-d", strtotime($trn_splitted[0]));
                $trn_next_dt = date("Y-m-d", strtotime($trn_splitted[1]));

                $meta_data_user_detail['trainee_name'] = $trainee_name;
                $meta_data_user_detail['trainee_period_start'] = $trn_last_dt;
                $meta_data_user_detail['trainee_period_end'] = $trn_next_dt;
            }


            if ($cv_doc_file_name != "") {
                $meta_data_user_detail['cv_doc_file_name'] = $cv_doc_file_name;
            }

            foreach ($meta_data_user_detail as $key => $value) {
                //Check if Specific data exists in DB
                $db_meta = $this->db->where('user_id', $doc_id)->where('meta_key', $key)->get('usermeta')->row_array();
                if (!empty($db_meta)) {
                    $this->db->where('user_id', $db_meta['user_id'])
                        ->where('meta_key', $db_meta['meta_key'])
                        ->update(
                            'usermeta',
                            array('meta_value' => $value)
                        );
                } else {
                    if (!empty($value)) {
                        $this->db->insert('usermeta', array('user_id' => $doc_id, 'meta_key' => $key, 'meta_value' => $value));
                    }
                }
            }
            redirect('doctor');
        }
        $user_id = $this->Userextramodel->generate_userid($doctor_id);
        $dashboard_reports_status['user_id'] = $user_id;
        $dashboard_reports_status['usersLogins'] = $this->Doctor_model->getUsersLogins();

        $dashboard_reports_status['twelve_month_tat'] = $data_sorted;
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/dashboard', $dashboard_reports_status);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Record list view
     *
     * @return void
     */
    public function doctor_record_list()
    {
        if (!$this->ion_auth->logged_in()) 
		{
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
		
        $doctor_id = $this->ion_auth->user()->row()->id;       
		$filter = " AND request.speciality_group_id IN(1,2)";
		$data['doctor_list'] = $this->Admin_model->get_doctors();
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
        $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist, $specialties, $specialty_grp);
		
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/record_list', $result);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Record detail page
     *
     * @param int $id
     * @return void
     */
    public function doctor_record_detail($id, $view = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
        if (isset($id) && !empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
                    // Check if doctor is assigned request
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                    return redirect('/', 'refresh');
            }
            $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $slide_data['slide_data'] = $this->Doctor_model->get_case_slides_data($id);
            $supplemnt_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
            $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_cpc_cases_model();
            $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->list_doctors();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id);
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $data_and_files = array_merge(
            $data,
            $breadcrumb,
            $unpublish_list,
            $specimen_data,
            $slide_data,
            $files_data,
            $supplemnt_data,
            $related_posts,
            $edu_cats, $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $mdt_list,
            $datasets_data,
            $record_history,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates,
            $download_history,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        require_once('application/views/doctor/comment_section.php');
        require_once('application/views/doctor/manage_supplementary.php');
        require_once('application/views/doctor/manage_documents.php');
        require_once('application/views/doctor/related_posts.php');
        require_once('application/views/doctor/get_specimens.php');
        require_once('application/views/doctor/special_notes.php');
        require_once('application/views/doctor/inc/functions.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions.php');

        if ($view == 'view') {
            $this->load->view('doctor/inc/header-new');
            $slide_inp = $this->input->get('slide');
            if (!isset($slide_inp)) {
                $data_and_files['slide_url'] = $slide_data['slide_data'][0]['slides'][0]['url'];
                $data_and_files['slide_specimen_id'] = $slide_data['slide_data'][0]['specimen_id'];
            } else {
                $search_query = explode("_", $this->input->get('slide'));
                if ($search_query != null) {
                    $specimenId = intval($search_query[0]);
                    $queryId = intval($search_query[1]);
                    foreach ($slide_data['slide_data'] as $specimen_slide) {
                        if ($specimen_slide['specimen_id'] == $specimenId) {
                            $data_and_files['slide_url'] = $specimen_slide['slides'][$queryId]['url'];
                            $data_and_files['slide_specimen_id'] = $specimenId;
                            break;
                        }
                    }
                }
            }
            $this->load->view('doctor/record_detail_view', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'bridgehead') {
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/record_detail_bridgehead.php', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } else {

            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/record_detail', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Virology Record list view
     *
     * @return void
     */
    public function virology_record_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Virology Record Listing', base_url('index.php/doctor/virology_record_list'));
        $doctor_id = $this->ion_auth->user()->row()->id;
        $filter = " AND request.speciality_group_id IN(3) ";
        $data["query"] = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
        $data['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id, $filter);
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }

        $data['sr_first_name'] = '';
        $data['sr_sur_name'] = '';
        $data['sr_nhs_no'] = '';
        $data['sr_dob'] = '';
        $data['sr_gender'] = '';
        $data['sr_specialty'] = '';
        $hospitals["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
        $filter = " AND speciality_group_id IN(3) ";
        $specialties["get_specialties"] = $this->Doctor_model->get_specialties($filter);
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $specialty_grp['speciality_group_hdn'] = "virology";
        $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist, $specialties, $specialty_grp);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/record_list', $result);
        $this->load->view('doctor/inc/footer-new');
    }

    public function doctor_record_detail_old($id, $view = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
        if (isset($id) && !empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);
            $main_id=$data['request_query']['0'];			
			
			$patient_q['patient_query']= $this->Doctor_model->get_patient_details($main_id->p_id);			
    		//print_r($data_patient_id); exit;
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        //return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            //return redirect('/', 'refresh');
                        }
                    }
					case 'HA':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            //return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                   // return redirect('/', 'refresh');
            }
            $req_from_to_data['request_from_to_list'] = $this->Institute_model->get_request_from_to_list();
            $reporting_doctors['reporting_doctors'] = $this->Doctor_model->get_reporting_doctors_by_request($id);
            $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $slide_data['slide_data'] = $this->Doctor_model->get_case_slides_data($id);
        //  echo "<pre>";print_r($slide_data['slide_data']);exit;
            $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
            $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->opinion_requested_doctors_list($doctor_id);
            $doctors_list['all_doctors_list'] = $this->Doctor_model->get_all_doctors_list();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $specimen_data['specimen_blocks'] = $this->Doctor_model->specimen_block_detail($id);
            //            echo "<pre>";print_r($specimen_data['specimen_blocks'] );exit;
            $unpublish_records = array();
            if ($view == 'postmortem') {
                $filter = " AND request.speciality_group_id='2' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } elseif ($view == 'virology') {
                $filter = " AND request.speciality_group_id='3' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } else {
                $filter = " AND request.speciality_group_id='1' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            }
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $cv_appr_data = array(
            'gmc_no' => $this->getUserMetaData($doctor_id, 'gmc_no'),
            'last_appraisal' => $this->getUserMetaData($doctor_id, 'last_appraisal'),
            'next_appraisal' => $this->getUserMetaData($doctor_id, 'next_appraisal'),
            'cpd_last' => $this->getUserMetaData($doctor_id, 'cpd_last'),
            'cpd_next' => $this->getUserMetaData($doctor_id, 'cpd_next'),
            'revalidation' => $this->getUserMetaData($doctor_id, 'revalidation'),
            'cv_doc_file_name' => $this->getUserMetaData($doctor_id, 'cv_doc_file_name'),
            'trainee_name' => $this->getUserMetaData($doctor_id, 'trainee_name'),
            'trainee_period_start' => $this->getUserMetaData($doctor_id, 'trainee_period_start'),
            'trainee_period_end' => $this->getUserMetaData($doctor_id, 'trainee_period_end'),
        );
        $data['cv_appr_data'] = $cv_appr_data;
		$hospital_users['hos_users'] = $this->Doctor_model->get_hospital_groups();

        $data_and_files = array_merge(
            $data,
            $breadcrumb,
            $unpublish_list,
            $specimen_data,
            $slide_data,
            $files_data,
            $supplement_data,
            $related_posts,
            $edu_cats, $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $mdt_list,
            $datasets_data,
            $record_history,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates,
            $download_history,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by,
            $req_from_to_data,
            $reporting_doctors,
			$hospital_users,
			$patient_q
        );
        //        echo "<pre>";print_r($slide_data['slide_data']);exit;

        require_once('application/views/doctor/comment_section_old.php');
        require_once('application/views/doctor/manage_supplementary_old.php');
        require_once('application/views/doctor/manage_documents_old.php');
        require_once('application/views/doctor/related_posts_old.php');
        require_once('application/views/doctor/get_specimens_old.php');
        require_once('application/views/doctor/special_notes_old.php');
        require_once('application/views/doctor/inc/functions_old.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions_old.php');
        if ($view == 'view') {
            $this->load->view('doctor/inc/header-new');
            $search_query = explode("_", $this->input->get('slide'));
            if ($search_query != null) {
                $specimenId = intval($search_query[0]);
                $queryId = intval($search_query[1]);
                foreach ($slide_data['slide_data'] as $specimen_slide) {
                    if ($specimen_slide['specimen_id'] == $specimenId) {
                        $data_and_files['slide_url'] = $specimen_slide['slides'][$queryId]['url'];
                        $data_and_files['slide_specimen_id'] = $specimenId;
                        break;
                    }
                }
            }
            $this->load->view('doctor/record_detail_view', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'postmortem') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/autopsy_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'virology') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/virology_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } else {
            $footer_data['javascripts'] = array(
                'js/webcam/webcam.min.js',
                'js/custom_js/webcam_capture.js',
                'js/custom_js/record_detail.js',
            );
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/record_detail_old', $data_and_files);
            $this->load->view('doctor/inc/footer-new', $footer_data);
        }
    }
    public function doctor_record_detail_new($id, $view = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
        if (isset($id) && !empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);
            $main_id=$data['request_query']['0'];           
            
            $patient_q['patient_query']= $this->Doctor_model->get_patient_details($main_id->p_id);          
            //print_r($data_patient_id); exit;
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        //return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            //return redirect('/', 'refresh');
                        }
                    }
                    case 'HA':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            //return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                   // return redirect('/', 'refresh');
            }
            $req_from_to_data['request_from_to_list'] = $this->Institute_model->get_request_from_to_list();
            $reporting_doctors['reporting_doctors'] = $this->Doctor_model->get_reporting_doctors_by_request($id);
            $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $slide_data['slide_data'] = $this->Doctor_model->get_case_slides_data($id);
        //            echo "<pre>";print_r($slide_data['slide_data']);exit;
            $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
            $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->opinion_requested_doctors_list($doctor_id);
            $doctors_list['all_doctors_list'] = $this->Doctor_model->get_all_doctors_list();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $specimen_data['specimen_blocks'] = $this->Doctor_model->specimen_block_detail($id);
            //            echo "<pre>";print_r($specimen_data['specimen_blocks'] );exit;
            $unpublish_records = array();
            if ($view == 'postmortem') {
                $filter = " AND request.speciality_group_id='2' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } elseif ($view == 'virology') {
                $filter = " AND request.speciality_group_id='3' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } else {
                $filter = " AND request.speciality_group_id='1' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            }
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $cv_appr_data = array(
            'gmc_no' => $this->getUserMetaData($doctor_id, 'gmc_no'),
            'last_appraisal' => $this->getUserMetaData($doctor_id, 'last_appraisal'),
            'next_appraisal' => $this->getUserMetaData($doctor_id, 'next_appraisal'),
            'cpd_last' => $this->getUserMetaData($doctor_id, 'cpd_last'),
            'cpd_next' => $this->getUserMetaData($doctor_id, 'cpd_next'),
            'revalidation' => $this->getUserMetaData($doctor_id, 'revalidation'),
            'cv_doc_file_name' => $this->getUserMetaData($doctor_id, 'cv_doc_file_name'),
            'trainee_name' => $this->getUserMetaData($doctor_id, 'trainee_name'),
            'trainee_period_start' => $this->getUserMetaData($doctor_id, 'trainee_period_start'),
            'trainee_period_end' => $this->getUserMetaData($doctor_id, 'trainee_period_end'),
        );
        $data['cv_appr_data'] = $cv_appr_data;
        $hospital_users['hos_users'] = $this->Doctor_model->get_hospital_groups();

        $data_and_files = array_merge(
            $data,
            $breadcrumb,
            $unpublish_list,
            $specimen_data,
            $slide_data,
            $files_data,
            $supplement_data,
            $related_posts,
            $edu_cats, $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $mdt_list,
            $datasets_data,
            $record_history,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates,
            $download_history,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by,
            $req_from_to_data,
            $reporting_doctors,
            $hospital_users,
            $patient_q
        );
        //        echo "<pre>";print_r($slide_data['slide_data']);exit;

        require_once('application/views/doctor/comment_section_old.php');
        require_once('application/views/doctor/manage_supplementary_old.php');
        require_once('application/views/doctor/manage_documents_old.php');
        require_once('application/views/doctor/related_posts_old.php');
        require_once('application/views/doctor/get_specimens_old.php');
        require_once('application/views/doctor/special_notes_old.php');
        require_once('application/views/doctor/inc/functions_old.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions_old.php');
        if ($view == 'view') {
            $this->load->view('doctor/inc/header-new');
            $search_query = explode("_", $this->input->get('slide'));
            if ($search_query != null) {
                $specimenId = intval($search_query[0]);
                $queryId = intval($search_query[1]);
                foreach ($slide_data['slide_data'] as $specimen_slide) {
                    if ($specimen_slide['specimen_id'] == $specimenId) {
                        $data_and_files['slide_url'] = $specimen_slide['slides'][$queryId]['url'];
                        $data_and_files['slide_specimen_id'] = $specimenId;
                        break;
                    }
                }
            }
            $this->load->view('doctor/record_detail_view', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'postmortem') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/autopsy_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'virology') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/virology_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } else {
            $footer_data['javascripts'] = array(
                'js/webcam/webcam.min.js',
                'js/custom_js/webcam_capture.js',
                'js/custom_js/record_detail.js',
            );
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/record_detail_old', $data_and_files);
            $this->load->view('doctor/inc/footer-new', $footer_data);
        }
    }


    public function doctor_record_details_new($id, $view = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
        if (isset($id) && !empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);
            //            echo '<pre>'; print_r($data['request_query']); exit;
			
			$patient['patient_details']=$data['request_query'][0]->patient_id;
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                    return redirect('/', 'refresh');
            }
            $req_from_to_data['request_from_to_list'] = $this->Institute_model->get_request_from_to_list();
            $reporting_doctors['reporting_doctors'] = $this->Doctor_model->get_reporting_doctors_by_request($id);
            $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $slide_data['slide_data'] = $this->Doctor_model->get_case_slides_data($id);
            $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
            $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->opinion_requested_doctors_list($doctor_id);
            $doctors_list['all_doctors_list'] = $this->Doctor_model->get_all_doctors_list();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $specimen_data['specimen_blocks'] = $this->Doctor_model->specimen_block_detail($id);
            //            echo "<pre>";print_r($specimen_data['specimen_blocks'] );exit;
            $unpublish_records = array();
            if ($view == 'postmortem') {
                $filter = " AND request.speciality_group_id='2' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } elseif ($view == 'virology') {
                $filter = " AND request.speciality_group_id='3' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } else {
                $filter = " AND request.speciality_group_id='1' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            }
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $cv_appr_data = array(
            'gmc_no' => $this->getUserMetaData($doctor_id, 'gmc_no'),
            'last_appraisal' => $this->getUserMetaData($doctor_id, 'last_appraisal'),
            'next_appraisal' => $this->getUserMetaData($doctor_id, 'next_appraisal'),
            'cpd_last' => $this->getUserMetaData($doctor_id, 'cpd_last'),
            'cpd_next' => $this->getUserMetaData($doctor_id, 'cpd_next'),
            'revalidation' => $this->getUserMetaData($doctor_id, 'revalidation'),
            'cv_doc_file_name' => $this->getUserMetaData($doctor_id, 'cv_doc_file_name'),
            'trainee_name' => $this->getUserMetaData($doctor_id, 'trainee_name'),
            'trainee_period_start' => $this->getUserMetaData($doctor_id, 'trainee_period_start'),
            'trainee_period_end' => $this->getUserMetaData($doctor_id, 'trainee_period_end'),
        );
        $data['cv_appr_data'] = $cv_appr_data;

        $data_and_files = array_merge(
            $data,
            $breadcrumb,
            $unpublish_list,
            $specimen_data,
            $slide_data,
            $files_data,
            $supplement_data,
            $related_posts,
            $edu_cats, $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $mdt_list,
            $datasets_data,
            $record_history,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates,
            $download_history,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by,
            $req_from_to_data,
            $reporting_doctors
        );
        //        echo "<pre>";print_r($slide_data['slide_data']);exit;

        require_once('application/views/doctor/comment_section_old.php');
        require_once('application/views/doctor/manage_supplementary_old.php');
        require_once('application/views/doctor/manage_documents_old.php');
        require_once('application/views/doctor/related_posts_old.php');
        require_once('application/views/doctor/get_specimens_micro.php');
        require_once('application/views/doctor/special_notes_old.php');
        require_once('application/views/doctor/inc/functions_old.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions_old.php');
        if ($view == 'view') {
            $this->load->view('doctor/inc/header-new');
            $search_query = explode("_", $this->input->get('slide'));
            if ($search_query != null) {
                $specimenId = intval($search_query[0]);
                $queryId = intval($search_query[1]);
                foreach ($slide_data['slide_data'] as $specimen_slide) {
                    if ($specimen_slide['specimen_id'] == $specimenId) {
                        $data_and_files['slide_url'] = $specimen_slide['slides'][$queryId]['url'];
                        $data_and_files['slide_specimen_id'] = $specimenId;
                        break;
                    }
                }
            }
            $this->load->view('doctor/record_detail_view', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'postmortem') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/autopsy_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'virology') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/virology_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } else {
            $footer_data['javascripts'] = array(
                'js/webcam/webcam.min.js',
                'js/custom_js/webcam_capture.js',
                'js/custom_js/record_detail.js',
            );
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/record_detail_new_temp', $data_and_files);
            $this->load->view('doctor/inc/footer-new', $footer_data);
        }
    }


    /**
     * Record detail page
     *
     * @param int $id
     * @return void
     */
    // public function doctor_record_detail_new($id)
    // {
    //     if (!$this->ion_auth->logged_in()) {
    //         redirect('auth/login', 'refresh');
    //     }
    //     $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
    //     $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
    //     $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
    //     if (isset($id) && !empty($id)) {
    //         $doctor_id = $this->ion_auth->user()->row()->id;
    //         $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);
    //         $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
    //         $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
    //         $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
    //         $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
    //         $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model();
    //         $cpc_cats['cpc_cats'] = $this->Doctor_model->get_cpc_cases_model();
    //         $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
    //         $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
    //         $doctors_list['list_doctors'] = $this->Doctor_model->list_doctors();
    //         $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
    //         $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
    //         $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
    //         $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
    //         $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
    //         $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
    //         $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
    //         $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
    //         $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
    //         $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
    //         $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
    //         $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
    //         $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
    //         $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
    //         $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id);
    //         $unpublish_list['unpublish_list'] = array();
    //         if (!empty($unpublish_records)) {
    //             foreach ($unpublish_records as $key => $value) {
    //                 $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
    //             }
    //         }
    //         $rec_bck_frm_lab_date_data = array();
    //         $rec_by_doc_date_data = array();
    //         $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
    //         $rec_by_doc_date = '';
    //         $booked_out_from_lab_time = '';
    //         if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
    //             $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
    //             if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
    //                 $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
    //                 $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
    //                 $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
    //             } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
    //                 $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
    //                 $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
    //                 $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
    //             }
    //         } else {
    //             if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
    //                 $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
    //                 $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
    //                 $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
    //                 $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
    //             }
    //         }
    //         $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
    //         $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
    //         $record_id = $id;
    //         $user_id = $this->ion_auth->user()->row()->id;
    //         $record_user_data['user_record_data'] = array(
    //             'record_id' => $record_id,
    //             'user_id' => $user_id
    //         );
    //         $change_status = array('report_status' => 0);
    //         $this->db->where('uralensis_request_id', $id);
    //         $this->db->update('request', $change_status);
    //         $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
    //     }
    //     $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
    //     $data_and_files = array_merge(
    //         $data,
    //         $breadcrumb,
    //         $unpublish_list,
    //         $specimen_data,
    //         $files_data,
    //         $supplement_data,
    //         $related_posts,
    //         $edu_cats, $cpc_cats,
    //         $mdt_cats,
    //         $doctors_list,
    //         $user_rec_edit_status,
    //         $user_rec_edit_status_full,
    //         $micro_codes,
    //         $mdt_list,
    //         $datasets_data,
    //         $record_history,
    //         $rec_bck_frm_lab_date_data,
    //         $rec_by_doc_date_data,
    //         $mdt_assign_dates,
    //         $download_history,
    //         $specimen_accepted_by,
    //         $specimen_assisted_by,
    //         $specimen_block_checked_by,
    //         $specimen_cutup_by,
    //         $specimen_labeled_by,
    //         $specimen_qcd_by
    //     );
    //     require_once('application/views/doctor/related_posts.php');
    //     $this->load->view('doctor/inc/header-new', $data_and_files);
    //     $this->load->view('doctor/record_detail-new', $data_and_files);
    //     $this->load->view('doctor/inc/footer-new');
    // }

    /**
     * Generate report
     *
     * @param int $id
     * @return void
     */
    public function generate_report($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($id) && !empty($id)) {
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $lab_release_date = array();
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $lab_release_date['release_date'] = date('d-m-Y', $check_booked_out_status['timestamp']);
            }
            $data1['query1'] = $this->Doctor_model->doctor_record_detail($id);
            $data2['query2'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $data3['query3'] = $this->Doctor_model->get_further_work($id);
            $data4['query4'] = $this->Doctor_model->get_additional_work($id);
            $data5['query5'] = $this->Doctor_model->get_hospital_info($id);
            $result = array_merge($data1, $data2, $data3, $data4, $data5, $lab_release_date);
            $this->load->view('doctor/pdf', $result);
        }
    }

    /**
     * Update report view
     *
     * @return void
     */
    public function update_report()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/update_recored');
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Update report data
     *
     * @return void
     */
    public function update_only_report()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = 0;
        if (isset($_POST)) {
            $json = array();
            $record_id = $_POST['record_id'];
            $user_id = $this->ion_auth->user()->row()->id;
            $edit_status_query = $this->db->query("SELECT request.record_edit_status FROM request WHERE request.uralensis_request_id = $record_id")->result();
            $default_edit_status = unserialize($edit_status_query[0]->record_edit_status);
            $json_edit_status = json_decode($_POST['json_edit_data'], TRUE);
            $edit_color_array = array();
            foreach ($json_edit_status as $key => $value) {
                if (trim($_POST[$key]) != trim($value)) {
                    $default_edit_status[$key] = 'yes';
                }
            }
            $lab_number = $this->input->post('lab_number');
            if (!empty($record_id)) {
                $check_lab_no = $this->db->query("SELECT request.lab_number FROM request WHERE request.lab_number = '$lab_number' AND request.uralensis_request_id != $record_id")->result_array();
                if (($lab_number == 'U') ||
                    ($lab_number == 'S') ||
                    ($lab_number == 'H') &&
                    (strlen($lab_number) == 1)) {

                } else if (!empty($check_lab_no[0]['lab_number']) && $check_lab_no[0]['lab_number'] === $lab_number) {
                    $json['type'] = 'error';
                    $json['msg'] = 'This lab number already assigned to some case.';
                    echo json_encode($json);
                    die;
                }
            }
            $lab_name_input_val = $this->input->post('lab_name');
            $lab_number_input_val = $this->input->post('lab_number');
            $lab_format = '';
            $temp = $this->db->select('lab_format_mask')->where('lab_name', $lab_name_input_val)->get('lab_names')->row_array();
            if (isset($temp) && !empty($temp) && is_array($temp) && count($temp) > 0) {
                $lab_format = $temp['lab_format_mask'];
            }
            if (preg_match('/-/', $lab_format)) {
                $explode_mask = explode("-", $lab_format);
                $explode_lab_no = explode("-", $lab_number_input_val);
                if (empty($lab_number_input_val)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Lab  format field should not be empty.';
                    echo json_encode($json);
                    die;
                }
                if (!empty($explode_mask) && !empty($explode_lab_no)) {
                    if ($explode_mask[0] && $explode_lab_no[0] && strcmp($explode_mask[0], $explode_lab_no[0])) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This lab number does not match to lab mask no. eg: ' . $lab_format;
                        echo json_encode($json);
                        die;
                    }
                }
            } else {
                if (!empty($lab_format)) {
                    if (strcmp(substr($lab_format, 0, 3), substr($lab_number_input_val, 0, 3))) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This lab number does not match to lab mask no.';
                        echo json_encode($json);
                        die;
                    }
                }
            }
            $data = array(
                'sur_name' => $this->input->post('sur_name'),
                'patient_initial' => $this->input->post('patient_initial'),
                'pci_number' => $this->input->post('pci_number'),
                'f_name' => $this->input->post('f_name'),
                'emis_number' => $this->input->post('emis_number'),
                'nhs_number' => $this->input->post('nhs_number'),
                'date_taken' => !empty($this->input->post('date_taken')) ? date('Y-m-d', strtotime($this->input->post('date_taken'))) : '',
                'lab_number' => $this->input->post('lab_number'),
                'cl_detail' => $this->input->post('cl_detail'),
                'mdt_outcome_text' => $this->input->post('mdt_outcome_text'),
                'dob' => !empty($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '',
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
                'lab_id' => $this->input->post('lab_name'),
                'report_urgency' => $this->input->post('report_urgency'),
                'date_received_bylab' => !empty($this->input->post('date_received_bylab')) ? date('Y-m-d', strtotime($this->input->post('date_received_bylab'))) : '',
                'date_sent_touralensis' => !empty($this->input->post('date_sent_touralensis')) ? date('Y-m-d', strtotime($this->input->post('date_sent_touralensis'))) : '',
                'date_rec_by_doctor' => !empty($this->input->post('rec_by_doc_date')) ? date('Y-m-d', strtotime($this->input->post('rec_by_doc_date'))) : '',
                'cases_category' => $this->input->post('cases_category'),
                'cost_codes' => $this->input->post('cost_codes'),
                'location' => $this->input->post('location'),
                'record_edit_status' => serialize($default_edit_status),
            );
            $dob = '';
            $age = '';
            if (!empty($this->input->post('dob'))) {
                $request_time_data = $this->db->select('request_datetime')->where('uralensis_request_id', $record_id)->get('request')->row_array()['request_datetime'];
                $request_time = date('Y-m-d', strtotime($request_time_data));
                $dob = date('Y-m-d', strtotime($this->input->post('dob')));
                $diff = date_diff(date_create($dob), date_create($request_time), TRUE);
                $age = $diff->format('%y');
                $this->db->where('uralensis_request_id', $record_id)->update('request', array('age' => intval($age)));
            }
            $get_record = "SELECT sur_name, patient_initial, pci_number, f_name, emis_number, nhs_number, date_taken, lab_number, cl_detail, dob, gender, clrk, dermatological_surgeon, lab_name, report_urgency, date_received_bylab, date_sent_touralensis, date_rec_by_doctor, cases_category, cost_codes, record_edit_status FROM request WHERE request.uralensis_request_id = $record_id";
            $get_record_data = $this->db->query($get_record)->result_array();
            $record_history_data = array();
            if ($get_record_data[0] === $data) {
                $json['type'] = 'error';
                $json['msg'] = 'You have not changed any field yet!';
                echo json_encode($json);
                die;
            } else {
                foreach ($data as $key => $value) {
                    if (!empty($get_record_data[0][$key]) && $value !== $get_record_data[0][$key]) {
                        $record_history_data[$key] = $data[$key];
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
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            $check_record = $this->db->affected_rows();
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            if (!empty($this->input->post('pci_number'))) {
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('request_code_status' => 'pci_added'));
            }
            if ($check_record > 0) {
                $json['type'] = 'success';
                $json['msg'] = 'Record Has Been Successfully Updated.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Some how record did not updated successfully or updated already.';
                echo json_encode($json);
                die;
            }
        }
        $report_update_message = '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Updated.</p>';
        $this->session->set_flashdata('update_report_message', $report_update_message);
        redirect('doctor/update_report/' . $record_id, 'refresh');
    }

    /**
     * Publish additional work
     *
     * @return void
     */
    public function update_autopsy_bmi_organs_wt()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST['request_id'])) {
            $user_id = $this->ion_auth->user()->row()->id;
            $record_id = $_POST['request_id'];

            $ap_data = array(
                'request_id' => $this->input->post('request_id'),
                'ap_height_cm' => $this->input->post('ap_height_cm'),
                'ap_weight_kg' => $this->input->post('ap_weight_kg'),
                'ap_bmi_calculated' => $this->input->post('ap_bmi_calculated'),
                'ap_brain_weight_gm' => $this->input->post('ap_brain_weight_gm'),
                'ap_heart_weight_gm' => $this->input->post('ap_heart_weight_gm'),
                'ap_rt_ventricle_weight_gm' => $this->input->post('ap_rt_ventricle_weight_gm'),
                'ap_lt_ventricle_weight_gm' => $this->input->post('ap_lt_ventricle_weight_gm'),
                'ap_rt_lung_weight_gm' => $this->input->post('ap_rt_lung_weight_gm'),
                'ap_lt_lung_weight_gm' => $this->input->post('ap_lt_lung_weight_gm'),
                'ap_liver_weight_gm' => $this->input->post('ap_liver_weight_gm'),
                'ap_spleen_weight_gm' => $this->input->post('ap_spleen_weight_gm'),
                'ap_rt_kidney_weight_gm' => $this->input->post('ap_rt_kidney_weight_gm'),
                'ap_lt_kidney_weight_gm' => $this->input->post('ap_lt_kidney_weight_gm'),
                'ap_thyroid_wt_gm' => $this->input->post('ap_thyroid_wt_gm')
            );

            $autopsy_detail_data = $this->Doctor_model->get_autopsy_record_data($record_id);
            if (!empty($autopsy_detail_data)) {
                //Update existing record in autopsy detail
                $this->db->where('request_id', $record_id);
                $this->db->update('request_autopsy_detail', $ap_data);
            } else {
                //Insert New record in autopsy detail
                $this->db->insert('request_autopsy_detail', $ap_data);
            }

            $check_record = $this->db->affected_rows();
            if ($check_record > 0) {
                $json['type'] = 'success';
                $json['msg'] = 'Autopsy BMI weights updated successfully.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Some how record did not updated successfully or updated already.';
                $json['affected_rows'] = $check_record;
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong While Updating BMI and Organ(s) Weights';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update Related Doctors in Autopsy Request
     *
     * @return void
     */
    public function update_autopsy_related_doctors()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST['request_id'])) {
            $user_id = $this->ion_auth->user()->row()->id;
            $record_id = $_POST['request_id'];
            $ap_relevant_doctors = $this->input->post('ap_relevant_doctors');
            $json_ap_relevant_doctors = json_encode($ap_relevant_doctors, JSON_FORCE_OBJECT);

            $ap_data = array(
                'request_id' => $this->input->post('request_id'),
                'ap_relevant_doctors' => $json_ap_relevant_doctors,
            );

            $autopsy_detail_data = $this->Doctor_model->get_autopsy_record_data($record_id);
            if (!empty($autopsy_detail_data)) {
                //Update existing record in autopsy detail
                $this->db->where('request_id', $record_id);
                $this->db->update('request_autopsy_detail', $ap_data);
            } else {
                //Insert New record in autopsy detail
                $this->db->insert('request_autopsy_detail', $ap_data);
            }

            $check_record = $this->db->affected_rows();
            if ($check_record > 0) {
                $json['type'] = 'success';
                $json['msg'] = '+ Doctors updated successfully.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Some how record did not updated successfully or updated already.';
                $json['affected_rows'] = $check_record;
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong While Updating BMI and Organ(s) Weights';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update report data
     *
     * @return void
     */
    public function update_report_postmortem()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = 0;
        if (isset($_POST)) {
            $record_id = $_POST['request_id'];
            $user_id = $this->ion_auth->user()->row()->id;
            $edit_status_query = $this->db->query("SELECT request.record_edit_status FROM request WHERE request.uralensis_request_id = $record_id")->result();
            $default_edit_status = unserialize($edit_status_query[0]->record_edit_status);
            $json_edit_status = json_decode($_POST['json_edit_data'], TRUE);
            $edit_color_array = array();
            foreach ($json_edit_status as $key => $value) {
                if (trim($_POST[$key]) != trim($value)) {
                    $default_edit_status[$key] = 'yes';
                }
            }
            $lab_number = $this->input->post('lab_number');
            if (!empty($record_id)) {
                $check_lab_no = $this->db->query("SELECT request.lab_number FROM request WHERE request.lab_number = '$lab_number' AND request.uralensis_request_id != $record_id")->result_array();
                if (($lab_number == 'U') ||
                    ($lab_number == 'S') ||
                    ($lab_number == 'H') &&
                    (strlen($lab_number) == 1)) {
                    //return true;
                } else if (!empty($check_lab_no[0]['lab_number']) && $check_lab_no[0]['lab_number'] === $lab_number) {
                    $json['type'] = 'error';
                    $json['msg'] = 'This PM number already assigned to some case.';
                    echo json_encode($json);
                    die;
                }
            }
            $lab_name_input_val = $this->input->post('lab_name');
            $lab_number_input_val = $this->input->post('lab_number');
            $lab_format = '';
            $temp = $this->db->select('lab_format_mask')->where('lab_name', $lab_name_input_val)->get('lab_names')->row_array();
            if (isset($temp) && !empty($temp) && is_array($temp) && count($temp) > 0) {
                $lab_format = $temp['lab_format_mask'];
            }
            if (preg_match('/-/', $lab_format)) {
                $explode_mask = explode("-", $lab_format);
                $explode_lab_no = explode("-", $lab_number_input_val);
                if (empty($lab_number_input_val)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Lab  format field should not be empty.';
                    echo json_encode($json);
                    die;
                }
                if (!empty($explode_mask) && !empty($explode_lab_no)) {
                    if ($explode_mask[0] && $explode_lab_no[0] && strcmp($explode_mask[0], $explode_lab_no[0])) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This lab number does not match to lab mask no. eg: ' . $lab_format;
                        echo json_encode($json);
                        die;
                    }
                }
            } else {
                if (!empty($lab_format)) {
                    if (strcmp(substr($lab_format, 0, 3), substr($lab_number_input_val, 0, 3))) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This lab number does not match to lab mask no.';
                        echo json_encode($json);
                        die;
                    }
                }
            }
            $data = array(
                'sur_name' => $this->input->post('sur_name'),
                'patient_initial' => $this->input->post('patient_initial'),
                'f_name' => $this->input->post('f_name'),
                'nhs_number' => $this->input->post('nhs_number'),
                'lab_number' => $this->input->post('lab_number'),
                'cl_detail' => $this->input->post('cl_detail'),
                'mdt_outcome_text' => $this->input->post('mdt_outcome_text'),
                'dob' => !empty($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '',
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
                'lab_id' => $this->input->post('lab_name'),
                'report_urgency' => $this->input->post('report_urgency'),
                'date_rec_by_doctor' => !empty($this->input->post('rec_by_doc_date')) ? date('Y-m-d', strtotime($this->input->post('rec_by_doc_date'))) : '',
                'cases_category' => $this->input->post('cases_category'),
                'cost_codes' => $this->input->post('cost_codes'),
                'location' => $this->input->post('location'),
                'record_edit_status' => serialize($default_edit_status),
            );
            $dob = '';
            $age = '';
            if (!empty($this->input->post('dob'))) {
                $request_time_data = $this->db->select('request_datetime')->where('uralensis_request_id', $record_id)->get('request')->row_array()['request_datetime'];
                $request_time = date('Y-m-d', strtotime($request_time_data));
                $dob = date('Y-m-d', strtotime($this->input->post('dob')));
                $diff = date_diff(date_create($dob), date_create($request_time), TRUE);
                $age = $diff->format('%y');
                $this->db->where('uralensis_request_id', $record_id)->update('request', array('age' => intval($age)));
            }
            $get_record = "SELECT sur_name, patient_initial, pci_number, f_name, emis_number, nhs_number, date_taken, lab_number, cl_detail, dob, gender, clrk, dermatological_surgeon, lab_name, report_urgency, date_received_bylab, date_sent_touralensis, date_rec_by_doctor, cases_category, cost_codes, record_edit_status FROM request WHERE request.uralensis_request_id = $record_id";
            $get_record_data = $this->db->query($get_record)->result_array();
            $record_history_data = array();
            if ($get_record_data[0] === $data) {
                $json['type'] = 'error';
                $json['msg'] = 'You have not changed any field yet!';
                echo json_encode($json);
                die;
            } else {
                foreach ($data as $key => $value) {
                    if (!empty($get_record_data[0][$key]) && $value !== $get_record_data[0][$key]) {
                        $record_history_data[$key] = $data[$key];
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
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);

            $path_findings = $this->input->post('ap_pathological_finding');
            $json_path_findings = json_encode($path_findings, JSON_FORCE_OBJECT);

            $h_path_findings = $this->input->post('ap_histopathological_finding');
            $json_h_path_findings = json_encode($h_path_findings, JSON_FORCE_OBJECT);

            $ap_relevant_doctors = $this->input->post('ap_relevant_doctors');

            $upd_reporting_docs = $this->Doctor_model->update_reporting_doctors($record_id, $ap_relevant_doctors);
            $json_ap_relevant_doctors = json_encode($ap_relevant_doctors, JSON_FORCE_OBJECT);

            $c_of_death = $this->input->post('ap_cause_of_death');
            $json_c_of_death = json_encode($c_of_death, JSON_FORCE_OBJECT);

            $snomed_t1 = $this->input->post('ap_snomed_t1');
            $json_snomed_t1 = json_encode($snomed_t1, JSON_FORCE_OBJECT);

            $snomed_t2 = $this->input->post('ap_snomed_t2');
            $json_snomed_t2 = json_encode($snomed_t2, JSON_FORCE_OBJECT);

            $snomed_p = $this->input->post('ap_snomed_p');
            $json_snomed_p = json_encode($snomed_p, JSON_FORCE_OBJECT);

            $snomed_m = $this->input->post('ap_snomed_m');
            $json_snomed_m = json_encode($snomed_m, JSON_FORCE_OBJECT);

            $ap_data = array(
                'request_id' => $this->input->post('record_id'),
                'ap_pm_number' => $this->input->post('ap_pm_number'),
                'ap_coroner_reference' => $this->input->post('ap_coroner_reference'),
                'ap_patient_id' => $this->input->post('ap_patient_id'),
                'ap_death_datetime' => !empty($this->input->post('ap_death_datetime')) ? date('Y-m-d H:i', strtotime($this->input->post('ap_death_datetime'))) : NULL,
                'ap_fridge_no' => $this->input->post('ap_fridge_no'),
                'ap_apt' => $this->input->post('ap_apt'),
                'ap_identified_by' => $this->input->post('ap_identified_by'),
                'ap_examination_place' => $this->input->post('ap_examination_place'),
                'ap_examination_datetime' => !empty($this->input->post('ap_examination_datetime')) ? date('Y-m-d H:i', strtotime($this->input->post('ap_examination_datetime'))) : NULL,
                'ap_death_circumstance' => $this->input->post('ap_death_circumstance'),
                'ap_ext_brain_status' => $this->input->post('ap_ext_brain_status'),
                'ap_ext_circle_wilis' => $this->input->post('ap_ext_circle_wilis'),
                'ap_ext_meningies_dura' => $this->input->post('ap_ext_meningies_dura'),
                'ap_external_exam_desc' => $this->input->post('ap_external_exam_desc'),
                'ap_int_brain_status' => $this->input->post('ap_int_brain_status'),
                'ap_lyranx_trachea' => $this->input->post('ap_lyranx_trachea'),
                'ap_bronchi' => $this->input->post('ap_bronchi'),
                'ap_lungs' => $this->input->post('ap_lungs'),
                'ap_pleura' => $this->input->post('ap_pleura'),
                'ap_mouth_t_phyr_oesophagus' => $this->input->post('ap_mouth_t_phyr_oesophagus'),
                'ap_stomach' => $this->input->post('ap_stomach'),
                'ap_sm_lg_intestine' => $this->input->post('ap_sm_lg_intestine'),
                'ap_liver' => $this->input->post('ap_liver'),
                'ap_gall_bladder' => $this->input->post('ap_gall_bladder'),
                'ap_pancreas' => $this->input->post('ap_pancreas'),
                'ap_peritoneum' => $this->input->post('ap_peritoneum'),
                'ap_kidneys' => $this->input->post('ap_kidneys'),
                'ap_uretus_bladder' => $this->input->post('ap_uretus_bladder'),
                'ap_uterus_cerv_overies' => $this->input->post('ap_uterus_cerv_overies'),
                'ap_prostate' => $this->input->post('ap_prostate'),
                'ap_external_genitalia' => $this->input->post('ap_external_genitalia'),
                'ap_spleen' => $this->input->post('ap_spleen'),
                'ap_lymph_nodes' => $this->input->post('ap_lymph_nodes'),
                'ap_thymus' => $this->input->post('ap_thymus'),
                'ap_thyroid_adrenals' => $this->input->post('ap_thyroid_adrenals'),
                'ap_pituitary_gland' => $this->input->post('ap_pituitary_gland'),
                'ap_musculoskeletal' => $this->input->post('ap_musculoskeletal'),
                'ap_pathological_finding' => $json_path_findings,
                'ap_histopathological_finding' => $json_h_path_findings,
                'ap_toxicology_report' => $this->input->post('ap_toxicology_report'),
                'ap_cause_of_death' => $json_c_of_death,
                'ap_comments' => $this->input->post('ap_comments'),
                'ap_pericardium' => $this->input->post('ap_pericardium'),
                'ap_coronary_vessels' => $this->input->post('ap_coronary_vessels'),
                'ap_atrium_valves_myocardium' => $this->input->post('ap_atrium_valves_myocardium'),
                'ap_aorta_great_veins' => $this->input->post('ap_aorta_great_veins'),
                'ap_snomed_t1' => $json_snomed_t1,
                'ap_snomed_t2' => $json_snomed_t2,
                'ap_snomed_p' => $json_snomed_p,
                'ap_snomed_m' => $json_snomed_m,
                'ap_special_notes' => $this->input->post('ap_special_notes'),
                'ap_relevant_doctors' => $json_ap_relevant_doctors,
            );

            $autopsy_detail_data = $this->Doctor_model->get_autopsy_record_data($record_id);
            if (!empty($autopsy_detail_data)) {
                //Update existing record in autopsy detail
                $this->db->where('request_id', $record_id);
                $this->db->update('request_autopsy_detail', $ap_data);
            } else {
                //Insert New record in autopsy detail
                $this->db->insert('request_autopsy_detail', $ap_data);
            }


            $check_record = $this->db->affected_rows();
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            if (!empty($this->input->post('pci_number'))) {
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('request_code_status' => 'pci_added'));
            }
            if ($check_record > 0) {
                $json['type'] = 'success';
                $json['msg'] = 'Record Has Been Successfully Updated.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Some how record did not updated successfully or updated already.';
                $json['affected_rows'] = $check_record;
                echo json_encode($json);
                die;
            }
        }
        $report_update_message = '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Updated.</p>';
        $this->session->set_flashdata('update_report_message', $report_update_message);
        redirect('doctor/update_report/' . $record_id, 'refresh');
    }

    /**
     * Update report data
     *
     * @return void
     */
    public function update_report_virology()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = 0;
        if (isset($_POST)) {
            $record_id = $_POST['request_id'];
            $user_id = $this->ion_auth->user()->row()->id;
            $edit_status_query = $this->db->query("SELECT request.record_edit_status FROM request WHERE request.uralensis_request_id = $record_id")->result();
            $default_edit_status = unserialize($edit_status_query[0]->record_edit_status);
            $json_edit_status = json_decode($_POST['json_edit_data'], TRUE);
            $edit_color_array = array();
            foreach ($json_edit_status as $key => $value) {
                if (trim($_POST[$key]) != trim($value)) {
                    $default_edit_status[$key] = 'yes';
                }
            }
            $lab_number = $this->input->post('lab_number');
            if (!empty($record_id)) {
                $check_lab_no = $this->db->query("SELECT request.lab_number FROM request WHERE request.lab_number = '$lab_number' AND request.uralensis_request_id != $record_id")->result_array();
                if (($lab_number == 'U') ||
                    ($lab_number == 'S') ||
                    ($lab_number == 'H') &&
                    (strlen($lab_number) == 1)) {
                    //return true;
                } else if (!empty($check_lab_no[0]['lab_number']) && $check_lab_no[0]['lab_number'] === $lab_number) {
                    $json['type'] = 'error';
                    $json['msg'] = 'This PM number already assigned to some case.';
                    echo json_encode($json);
                    die;
                }
            }
            $lab_name_input_val = $this->input->post('lab_name');
            $lab_number_input_val = $this->input->post('lab_number');
            $lab_format = '';
            $temp = $this->db->select('lab_format_mask')->where('lab_name', $lab_name_input_val)->get('lab_names')->row_array();
            if (isset($temp) && !empty($temp) && is_array($temp) && count($temp) > 0) {
                $lab_format = $temp['lab_format_mask'];
            }
            if (preg_match('/-/', $lab_format)) {
                $explode_mask = explode("-", $lab_format);
                $explode_lab_no = explode("-", $lab_number_input_val);
                if (empty($lab_number_input_val)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Lab  format field should not be empty.';
                    echo json_encode($json);
                    die;
                }
                if (!empty($explode_mask) && !empty($explode_lab_no)) {
                    if ($explode_mask[0] && $explode_lab_no[0] && strcmp($explode_mask[0], $explode_lab_no[0])) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This lab number does not match to lab mask no. eg: ' . $lab_format;
                        echo json_encode($json);
                        die;
                    }
                }
            } else {
                if (!empty($lab_format)) {
                    if (strcmp(substr($lab_format, 0, 3), substr($lab_number_input_val, 0, 3))) {
                        $json['type'] = 'error';
                        $json['msg'] = 'This lab number does not match to lab mask no.';
                        echo json_encode($json);
                        die;
                    }
                }
            }
            $data = array(
                'sur_name' => $this->input->post('sur_name'),
                'patient_initial' => $this->input->post('patient_initial'),
                'f_name' => $this->input->post('f_name'),
                'nhs_number' => $this->input->post('nhs_number'),
                'lab_number' => $this->input->post('lab_number'),
                'cl_detail' => $this->input->post('cl_detail'),
                'mdt_outcome_text' => $this->input->post('mdt_outcome_text'),
                'dob' => !empty($this->input->post('dob')) ? date('Y-m-d', strtotime($this->input->post('dob'))) : '',
                'gender' => $this->input->post('gender'),
                'clrk' => $this->input->post('clrk'),
                'dermatological_surgeon' => $this->input->post('dermatological_surgeon'),
                'lab_id' => $this->input->post('lab_name'),
                'report_urgency' => $this->input->post('report_urgency'),
                'date_rec_by_doctor' => !empty($this->input->post('rec_by_doc_date')) ? date('Y-m-d', strtotime($this->input->post('rec_by_doc_date'))) : '',
                'cases_category' => $this->input->post('cases_category'),
                'cost_codes' => $this->input->post('cost_codes'),
                'location' => $this->input->post('location'),
                'record_edit_status' => serialize($default_edit_status),
            );
            $dob = '';
            $age = '';
            if (!empty($this->input->post('dob'))) {
                $request_time_data = $this->db->select('request_datetime')->where('uralensis_request_id', $record_id)->get('request')->row_array()['request_datetime'];
                $request_time = date('Y-m-d', strtotime($request_time_data));
                $dob = date('Y-m-d', strtotime($this->input->post('dob')));
                $diff = date_diff(date_create($dob), date_create($request_time), TRUE);
                $age = $diff->format('%y');
                $this->db->where('uralensis_request_id', $record_id)->update('request', array('age' => intval($age)));
            }
            $get_record = "SELECT sur_name, patient_initial, pci_number, f_name, emis_number, nhs_number, date_taken, lab_number, cl_detail, dob, gender, clrk, dermatological_surgeon, lab_name, report_urgency, date_received_bylab, date_sent_touralensis, date_rec_by_doctor, cases_category, cost_codes, record_edit_status FROM request WHERE request.uralensis_request_id = $record_id";
            $get_record_data = $this->db->query($get_record)->result_array();
            $record_history_data = array();
            if ($get_record_data[0] === $data) {
                $json['type'] = 'error';
                $json['msg'] = 'You have not changed any field yet!';
                echo json_encode($json);
                die;
            } else {
                foreach ($data as $key => $value) {
                    if (!empty($get_record_data[0][$key]) && $value !== $get_record_data[0][$key]) {
                        $record_history_data[$key] = $data[$key];
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
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);

            $vr_data = array(
                'request_id' => $this->input->post('record_id'),
                'vr_pm_number' => $this->input->post('vr_pm_number'),
                'vr_coroner_reference' => $this->input->post('vr_coroner_reference'),
                'vr_patient_id' => $this->input->post('vr_patient_id'),
                'vr_fridge_no' => $this->input->post('vr_fridge_no'),
                'vr_death_datetime' => !empty($this->input->post('vr_death_datetime')) ? date('Y-m-d H:i', strtotime($this->input->post('vr_death_datetime'))) : NULL,
                'vr_apt' => $this->input->post('vr_apt'),
                'vr_sample_type' => $this->input->post('vr_sample_type'),
                'vr_collection_date_time' => $this->input->post('vr_collection_date_time'),
                'vr_phe_sent_date' => !empty($this->input->post('vr_phe_sent_date')) ? date('Y-m-d', strtotime($this->input->post('vr_phe_sent_date'))) : NULL,
                'vr_flu_a' => $this->input->post('vr_flu_a'),
                'vr_flu_b' => $this->input->post('vr_flu_b'),
                'vr_other_respiratory' => $this->input->post('vr_other_respiratory'),
                'vr_other_pathogen' => $this->input->post('vr_other_pathogen'),
                'vr_rdrp_assay' => $this->input->post('vr_rdrp_assay'),
                'vr_egene_assay' => $this->input->post('vr_egene_assay'),
                'vr_other_covid_testing' => $this->input->post('vr_other_covid_testing'),
                'vr_other_comments' => $this->input->post('vr_other_comments'),
            );

            $virology_detail_data = $this->Doctor_model->get_virology_record_data($record_id);
            if (!empty($virology_detail_data)) {
                //Update existing record in autopsy detail
                $this->db->where('request_id', $record_id);
                $this->db->update('request_virology_detail', $vr_data);
            } else {
                //Insert New record in autopsy detail
                $this->db->insert('request_virology_detail', $vr_data);
            }

            $check_record = $this->db->affected_rows();
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            if (!empty($this->input->post('pci_number'))) {
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('request_code_status' => 'pci_added'));
            }
            if ($check_record > 0) {
                $json['type'] = 'success';
                $json['msg'] = 'Record Has Been Successfully Updated.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Some how record did not updated successfully or updated already.';
                $json['affected_rows'] = $check_record;
                echo json_encode($json);
                die;
            }
        }
        $report_update_message = '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Updated.</p>';
        $this->session->set_flashdata('update_report_message', $report_update_message);
        redirect('doctor/update_report/' . $record_id, 'refresh');
    }

    /**
     * Update client report
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
            $specimen_snomed_t1 = '';
            $specimen_snomed_t2 = '';
            $specimen_snomed_p = '';
            $specimen_snomed_m = '';
            if (!empty($this->input->post('specimen_snomed_t1'))) {
                $specimen_snomed_t1 = implode(',', $this->input->post('specimen_snomed_t1'));
            }
            if (!empty($this->input->post('specimen_snomed_t2'))) {
                $specimen_snomed_t2 = implode(',', $this->input->post('specimen_snomed_t2'));
            }
            if (!empty($this->input->post('specimen_snomed_p'))) {
                $specimen_snomed_p = implode(',', $this->input->post('specimen_snomed_p'));
            }
            if (!empty($this->input->post('specimen_snomed_m'))) {
                $specimen_snomed_m = implode(',', $this->input->post('specimen_snomed_m'));
            }
            $spec = array(
                'specimen_clinical_history' => $this->input->post('specimen_clinical_history'),
                'specimen_accepted_by' => $this->input->post('specimen_accepted_by'),
                'specimen_cutup_by' => $this->input->post('specimen_cutupby'),
                'specimen_assisted_by' => $this->input->post('specimen_assisted_by'),
                'specimen_block_checked_by' => $this->input->post('specimen_block_checked_by'),
                'specimen_labelled_by' => $this->input->post('specimen_labeled_by'),
                'specimen_qc_by' => $this->input->post('specimen_qcd_by'),
                'specimen_block' => $this->input->post('specimen_block'),
                'specimen_slides' => $this->input->post('specimen_slides'),
                'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
                'specimen_microscopic_code' => $this->input->post('specimen_microscopic_code'),
                'specimen_rcpath_code' => $this->input->post('rcpath_code'),
                'specimen_microscopic_description' => $this->input->post('specimen_microscopic_description'),
                'specimen_snomed_t' => $specimen_snomed_t1,
                'specimen_snomed_t2' => $specimen_snomed_t2,
                'specimen_snomed_p' => $specimen_snomed_p,
                'specimen_snomed_m' => $specimen_snomed_m,
                'specimen_diagnosis_description' => $this->input->post('specimen_diagnosis'),
                'specimen_comment_section' => $this->input->post('specimen_commnet_section'),
                'specimen_comment_section_timestamp' => time(),
                'specimen_special_notes' => $this->input->post('specimen_special_notes'),
                'specimen_special_notes_timestamp' => time(),
                'specimen_feedback_to_lab' => $this->input->post('specimen_feedback_to_lab'),
                'specimen_feedback_to_lab_timestamp' => time(),
                'specimen_feedback_to_secretary' => $this->input->post('specimen_feedback_to_secretary'),
                'specimen_feedback_to_secretary_timestamp' => time(),
                'specimen_error_log' => $this->input->post('specimen_error_log'),
                'specimen_error_log_timestamp' => time(),
                'specimen_benign' => !empty($specimen_benign) ? $specimen_benign : '',
                'specimen_atypical' => !empty($specimen_atypical) ? $specimen_atypical : '',
                'specimen_malignant' => !empty($specimen_malignant) ? $specimen_malignant : '',
                'specimen_inflammation' => !empty($specimen_inflammation) ? $specimen_inflammation : ''
            );
            $this->db->where('request_id', $record_id);
            $this->db->where('specimen_id', $specimen_id);
            $this->db->update('specimen', $spec);
            $user_id = $this->ion_auth->user()->row()->id;
            if (!empty($this->input->post('specimen_microscopic_description'))) {
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('request_code_status' => 'micro_add'));
            }
            $user_edit_data = array(
                'user_id_for_edit' => $user_id,
                'record_id_for_edit' => $record_id,
                'user_record_edit_timestamp' => time()
            );
            $this->db->insert('uralensis_record_edit_status', $user_edit_data);
            $check_record = $this->db->affected_rows();
            if ($check_record == 1) {
                $session_data = array(
                    'doctor_id' => $user_id
                );
                $this->session->set_userdata($session_data);
                $doctor_data = array(
                    'doctor_id' => $user_id = $this->session->userdata('doctor_id')
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
     * Publish report
     *
     * @return void
     */
    public function publish_report()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $id = $this->uri->segment(3);
        if (isset($id) && !empty($id)) {
            $data = array(
                'status' => 1,
                'specimen_publish_status' => 1,
                'publish_status' => 1,
            );
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $data);
            $finalreport_update_message = '<p class="bg-success" style="padding:7px;">Report Has Been Published Now.</p>';
            $this->session->set_flashdata('final_report_message', $finalreport_update_message);
            redirect('doctor/update_report/' . $id, 'refresh');
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
        $json = array();
        $get_request_id = $this->input->post('record_id');
        $doctor_id = $this->ion_auth->user()->row()->id;
        $lab_name_from_request_sql = $this->db->query("SELECT serial_number, patient_initial, lab_name, lab_number FROM request WHERE uralensis_request_id = $get_request_id");
        $get_lab_name_from_request = $lab_name_from_request_sql->row();
        if ($_POST['furtherwork_date'] == '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Select Further Work Date.';
            echo json_encode($json);
            die;
        } else if ($_POST['description'] == '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please Add Further Work Description.';
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
            $insert_id = $this->db->insert_id();
            $update_service_code = array(
                'fw_levels' => $this->input->post('fwlevels'),
                'fw_immunos' => $this->input->post('immuno'),
                'fw_imf' => $this->input->post('imf')
            );
            $this->db->where('uralensis_request_id', $get_request_id);
            $this->db->update('request', $update_service_code);
            $this->db->where('uralensis_request_id', $get_request_id);
            $this->db->update('request', array('request_code_status' => 'furtherwork_add'));
            $fw_history_data = array(
                'Date' => $this->input->post('furtherwork_date'),
                'Description' => $this->input->post('description')
            );
            $history_data = array(
                'rec_history_user_id' => $doctor_id,
                'rec_history_record_id' => $get_request_id,
                'rec_history_data' => serialize($fw_history_data),
                'rec_history_status' => 'fw_add',
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_history', $history_data);
            $message = '';
            $message .= '<table width="100%" border="1" cellpadding="3" cellspacing="3">';
            $message .= '<tr>';
            $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Patient Initials:</strong></td>';
            $message .= '<td style="padding: 6px;">' . $get_lab_name_from_request->patient_initial . '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Further Work Description:</strong></td>';
            $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('description') . '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Lab Number:</strong></td>';
            $message .= '<td width="80%" style="padding: 6px;">' . $get_lab_name_from_request->lab_number . '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Further Work Request Date:</strong></td>';
            $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('furtherwork_date') . '</td>';
            $message .= '</tr>';
            $message .= '</table>';
            $fw_message = array(
                'fw_preview_template' => $message
            );
            $this->db->where('fw_id', $insert_id);
            $this->db->update('further_work', $fw_message);
            /*             * **************************
             * Email sent to Doc Iskanader
             * developed by Mohsin Raza
             *
             */
            $config = Array(
                'mailtype' => 'html',
                'charset' => 'utf-8', //iso-8859-1
                'newline' => '\r\n',
                'wordwrap' => TRUE
            );

            $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($doctor_id);
            $to_email = $decryptedDetails->email;
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from('aleatha@uralensis.com'); // change it to yours
            $this->email->reply_to('aleatha@uralensis.com', 'Uralensis');
            $this->email->cc('dev@oxbridgemedica.com');
            $this->email->to($to_email); // change it to yours
            $this->email->subject(' Uralensis Further Work Request' . $get_lab_name_from_request->serial_number);
            $this->email->message($message);
            if ($this->email->send()) {
                $json['type'] = 'success';
                $json['msg'] = 'Further Work Requested.';
                echo json_encode($json);
                die;
            }
            /*             * **end of code */
        }
    }

    /**
     * Add Additional Work Controller
     *
     * @return void
     */
    public function additional_work()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $req_id = $this->session->userdata('id');
        $additional_work = array('request_id' => $req_id, 'doctor_id' => $user_id, 'status' => 1, 'description' => $this->input->post('additional_description'), 'data_state' => 'in_session');
        $this->db->where('uralensis_request_id', $req_id);
        $this->db->update('request', array('additional_data_state' => 'in_session'));
        $this->Doctor_model->additional_work($additional_work);
        $supply_record_data = array(
            'description' => $this->input->post('additional_description'),
            'data_state' => 'in_session'
        );
        $history_data = array(
            'rec_history_user_id' => $user_id,
            'rec_history_record_id' => $req_id,
            'rec_history_data' => serialize($supply_record_data),
            'rec_history_status' => 'supple_add',
            'timestamp' => time()
        );
        $this->db->insert('uralensis_record_history', $history_data);
        $get_record_viewed_result = $this->Doctor_model->get_request_viewed_record($req_id);
        if ($get_record_viewed_result != 0) {
            $status = array('publish_status' => 1, 'supplementary_review_status' => 'true');
            $this->db->where('uralensis_request_id', $req_id);
            $this->db->update('request', $status);
        }
        $this->session->set_flashdata('message_additional', 'Submitted Supplementary Work');
        redirect('doctor/case_review_list/', 'refresh');
    }

    /**
     * Publish additional work
     *
     * @return void
     */
    public function publish_additional_work()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST['request_id'])) {
            $user_id = $this->ion_auth->user()->row()->id;
            $req_id = $_POST['request_id'];
            $this->db->where('request_id', $req_id);
            $this->db->update('additional_work', array('data_state' => 'save_data'));
            $request_data = array(
                'additional_data_state' => 'save_data',
                'supplementary_report_status' => 1,
                'supplementary_review_status' => 'false'
            );
            $this->db->where('uralensis_request_id', $req_id);
            $this->db->update('request', $request_data);
            $this->db->query("DELETE FROM request_viewed WHERE request_viewed.request_viewed_id = $req_id");
            $fw_data = array(
                'fw_status' => 'complete'
            );
            $this->db->where('request_id', $req_id);
            $this->db->update('further_work', $fw_data);
            $history_data = array(
                'rec_history_user_id' => $user_id,
                'rec_history_record_id' => $req_id,
                'rec_history_data' => '',
                'rec_history_status' => 'supple_publish',
                'timestamp' => time()
            );
            $this->db->insert('uralensis_record_history', $history_data);
            $json['type'] = 'success';
            $json['msg'] = 'Supplementary Report Published Successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong While Publishing Supplementary Report.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search Functionality Code Start
     *
     * @return void
     */
    public function search_request()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $first_name = $this->input->post('first_name', TRUE);
        $sur_name = $this->input->post('sur_name', TRUE);
        $nhs_no = $this->input->post('nhs_no', TRUE);
        $dob = $this->input->post('dob', TRUE);
        $gender = $this->input->post('gender', TRUE);
        $specialty = $this->input->post('specialty', TRUE);
        $specialty_grp = array();
        $specialty_grp_hdn = $this->input->post('speciality_group_hdn', TRUE);

        $data['sr_first_name'] = '';
        $data['sr_sur_name'] = '';
        $data['sr_nhs_no'] = '';
        $data['sr_dob'] = '';
        $data['sr_gender'] = '';
        $data['sr_specialty'] = '';
        $data['speciality_group_hdn'] = '';

        $filter = '';
        if (isset($first_name) && !empty($first_name) && trim($first_name) != '') {
            $first_name = trim($first_name);
            $data['sr_first_name'] = $first_name;
            $filter = $filter . " AND f_name = '$first_name'";
        }
        if (isset($sur_name) && !empty($sur_name) && trim($sur_name) != '') {
            $sur_name = trim($sur_name);
            $data['sr_sur_name'] = $sur_name;
            $filter = $filter . " AND sur_name = '$sur_name'";
        }
        if (isset($nhs_no) && !empty($nhs_no) && trim($nhs_no) != '') {
            $nhs_no = trim($nhs_no);
            $data['sr_nhs_no'] = $nhs_no;
            $filter = $filter . " AND nhs_number = '$nhs_no'";
        }
        if (isset($dob) && !empty($dob) && trim($dob) != '') {
            $dob = trim($dob);
            $data['sr_dob'] = $dob;
            $filter = $filter . " AND dob = '$dob'";
        }
        if (isset($gender) && !empty($gender) && trim($gender) != '') {
            $gender = trim($gender);
            $data['sr_gender'] = $gender;
            $filter = $filter . " AND gender = '$gender'";
        }
        if (isset($specialty) && !empty($specialty) && trim($specialty) != '') {
            $specialty = trim($specialty);
            $data['sr_specialty'] = $specialty;
        }
        $spcl_filter = '';
        if ($specialty_grp_hdn == 'histology') {
            $spcl_filter = ' AND speciality_group_id IN(1,2)';
            $filter = " AND request.speciality_group_id IN(1,2) ";
            $specialty_grp['speciality_group_hdn'] = "histology";
        }
        if ($specialty_grp_hdn == 'virology') {
            $spcl_filter = ' AND speciality_group_id IN(3)';
            $filter = " AND request.speciality_group_id IN(3) ";
            $specialty_grp['speciality_group_hdn'] = "virology";
        }

        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $doctor_id = $this->ion_auth->user()->row()->id;

        $data["query"] = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
        $data['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id, $filter);
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }
        $hospitals["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);

        $specialties["get_specialties"] = $this->Doctor_model->get_specialties($spcl_filter);
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist, $specialties, $specialty_grp);
        // echo '<pre>'; print_r($result); exit;
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/record_list', $result);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Display Published Reports
     *
     * @return void
     */
    public function published_reports()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Publish Reports', base_url('index.php/doctor/published_reports'));
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $hospitals["get_hospitals"] = $this->Doctor_model->display_hospitals_list();
        $doctor_hospitals["get_doctor_hospitals"] = $this->Doctor_model->display_doctor_only_hospitals();
        $data_array = array_merge($breadcrumb, $hospitals, $doctor_hospitals);
        $data_array['selected'] = '';
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/record_latest', $data_array);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Display datatables ajax
     * processing published records
     *
     * @return void
     */
    public function display_published_reports_ajax_processing()
    {
        $url_year = '';
        $url_type = '';
        if (!empty($_POST['year']) && !empty($_POST['type'])) {
            $url_year = $_POST['year'];
            $url_type = $_POST['type'];
        }
        $flag_type = '';
        if (!empty($_POST['flag_type'])) {
            $flag_type = $_POST['flag_type'];
        }
        $sort_authorize = '';
        if (!empty($_POST['sort_authorize'])) {
            $sort_authorize = $_POST['sort_authorize'];
        }
        $urgency_type = '';
        if (!empty($_POST['urgency_type'])) {
            $urgency_type = $_POST['urgency_type'];
        }
        $row_color_code = '';
        if (!empty($_POST['row_color_code'])) {
            $row_color_code = $_POST['row_color_code'];
        }

        $list = $this->Doctor_model->display_published_record($url_year, $url_type, $flag_type, $sort_authorize, $urgency_type, $row_color_code);

        $data = array();
        $flag_count = 11;
        $row_count=0;
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
            $add_comments = '';
            $show_comments = '';
            $add_comments .= '<div class="comments_icon">';
            $add_comments .= '<a style="color:#000;" href="javascript:;" id="display_comment_box" class="display_comment_box" data-recordid="' . $record->uralensis_request_id . '" data-modalid="' . $flag_count . '">';
            $add_comments .= '<i class="lnr lnr-bubble" style="font-size:18px;font-weight:bold;"></i>';
            $add_comments .= '</a>';
            $add_comments .= '</div>';
            $show_comments .= '<div class="comments_icon">';
            $show_comments .= '<a style="color:#000;" href="javascript:;" id="show_comments_list" class="show_comments_list_published" data-recordid="' . $record->uralensis_request_id . '" data-modalid="' . $flag_count . '">';
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
            $add_comments .= '<a class="btn btn-primary flag_comments_save" id="flag_comments_save" href="javascript:;">Save Comments</a>';
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
            $edit_button = '<a href="javascript:;" class="edit-icon" style="float: none !important;">';
            $edit_button .= '<i class="fa fa-pencil"></i>';
            $edit_button .= '</a>';
            $dob_nd_nhs = '<br>' . $record->nhs_number;
            if (!empty($record->dob)) {
                $dob_nd_nhs = $record->nhs_number . '<br>' . date('d-m-Y', strtotime($record->dob));
            }
            $request_time = '';
            if (!empty($record->request_datetime)) {
                $request_time = date('d-m-Y', strtotime($record->request_datetime));
            }
            $rec_by_lab_date = '';
            if (!empty($record->date_received_bylab)) {
                $rec_by_lab_date = date('d-m-Y', strtotime($record->date_received_bylab));
            }
            $publish_date = '';
            if (!empty($record->publish_datetime)) {
                $publish_date = date('d-m-Y', strtotime($record->publish_datetime));
            }
            $record_published = '';
            if ($record->specimen_update_status == 1 && $record->specimen_publish_status == 1) {
                $record_published = '<a data-toggle="tooltip" data-placement="top" title="' . $record->serial_number . ' Record Has Been Published Or Completed." href="' . site_url() . '/doctor/doctor_record_detail_new/' . $record->uralensis_request_id . '"><img src="' . base_url('assets/img/completed.png') . '"></a>';
            }
            $supply_record = '';
            if ($record->supplementary_report_status == 1) {
                $supply_record = '<a data-toggle="tooltip" data-placement="top" title="Supplementary Report Requested For This Record ' . $record->serial_number . '" href="javascript:;"><img src="' . base_url('assets/img/requested.png') . '"></a>';
            }
            $pdf_doc = '';
            $pdf_doc = '<a target="_blank" href="' . site_url() . "/doctor/generate_report/" . $record->uralensis_request_id . '"><img src="' . base_url("assets/img/pdf.png") . '" title="Pdf View"></a>';
            $publish_status = 'Not Published';
            if ($record->specimen_publish_status == 1) {
                $publish_status = '<button title="Unpublish Record" class="record_id_unpublish btn btn-link" data-recordserial="' . $record->serial_number . '" data-unpublishrecordid="' . site_url() . "/doctor/unpublish_record/" . $record->uralensis_request_id . '">
                                    <img src="' . base_url('assets/icons/UnPublishBlack.png') . '" class="pub_unpub" />

                                    </button>';
            }
            $f_initial = '';
            $l_initial = '';
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->first_initial)) {
                $f_initial = $this->ion_auth->group($record->hospital_group_id)->row()->first_initial;
            }
            if (!empty($this->ion_auth->group($record->hospital_group_id)->row()->last_initial)) {
                $l_initial = $this->ion_auth->group($record->hospital_group_id)->row()->last_initial;
            }
            $urgency_class = '';
            $urgency_title = '';
            if (!empty($record->report_urgency) && $record->report_urgency === 'Urgent') {
                $urgency_class = 'urgent-wb';
                $urgency_title = 'Urgent';
            } else if (!empty($record->report_urgency) && $record->report_urgency === '2WW') {
                $urgency_class = 'two_ww';
                $urgency_title = '2WW';
            } else {
                $urgency_class = 'routine';
                $urgency_title = 'Routine';
            }
            $full_name = '';
            if (!empty($record->f_name) || !empty($record->sur_name)) {
                $full_name = $record->f_name . '<br>' . $record->sur_name;
            }
            $ul_and_track = '';
            if (!empty($record->serial_number) || !empty($record->ura_barcode_no)) {
                $ul_and_track = $record->serial_number . '<br>' . $record->ura_barcode_no;
            }
            $lab_and_lab_rec_date = '';
            if (!empty($record->lab_number) || !empty($rec_by_lab_date)) {
                $lab_and_lab_rec_date = $record->lab_number . '<br>' . $rec_by_lab_date;
            }
            $batch_no = '';
            if (!empty($record->record_batch_id)) {
                $batch_no = $record->record_batch_id;
            }

            $row = array();
            $row[] = '<input type="checkbox" class="bulk_report_generate" name="bulk_report_generate[]" value="' . $record->uralensis_request_id . '">';
            $row[] = $ul_and_track;
            $row[] = $full_name;
            $row[] = $dob_nd_nhs;
            $row[] = $batch_no . '<br>' . $record->pci_number;
            $row[] = $lab_and_lab_rec_date;
            $row[] = '<a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="' . $this->ion_auth->group($record->hospital_group_id)->row()->description . '" href="javascript:;" >'.$f_initial.''.$l_initial.'</a>';
            $row[] = '<div class="' . $urgency_class . '" data-toggle="tooltip" data-placement="top" title="' . $urgency_title . '" style="font-size:18px;"></div>';
            $row[] = $publish_date;
            $row[] = $record_published;
            $row[] = $supply_record;
            $row[] = $pdf_doc;
            $row[] = $publish_status;
            $row[] = $add_comments;
            $row[] = $show_comments;
            $row[] = $flag_content;
            $row[] = $edit_button;
            $row[] = '<p style="display:none;">' . $row_code . '</p>';
            $row[] = '<p style="display:none;">' . $record->flag_status . '</p>';
            $data[] = $row;
            $flag_count++;
            $row_count++;
        }
        // $this->Doctor_model->record_count_all()
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => intval($row_count),
            "recordsFiltered" => $this->Doctor_model->record_count_filtered($url_year, $url_type, $flag_type, $sort_authorize, $urgency_type, $row_color_code),
            "data" => $data,
        );
        echo json_encode($output);
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
        if (isset($id) && !empty($id)) {
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $lab_release_date = array();
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $lab_release_date['release_date'] = date('d-m-Y', $check_booked_out_status['timestamp']);
            }
            $data1['query1'] = $this->Doctor_model->doctor_record_detail($id);
            $data2['query2'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $data3['query3'] = $this->Doctor_model->get_further_work($id);
            $data4['query4'] = $this->Doctor_model->get_additional_work_for_prebulish($id);
            $data5['query5'] = $this->Doctor_model->get_hospital_info($id);
            $result = array_merge($data1, $data2, $data3, $data4, $data5, $lab_release_date);
            $this->load->view('doctor/viewpdf', $result);
        }
    }

    /**
     * View PDF Before Publish Report
     *
     * @param int $id
     * @return void
     */
    public function view_autopsy_report($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }	
        if (isset($id) && !empty($id)) {
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $lab_release_date = array();
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $lab_release_date['release_date'] = date('d-m-Y', $check_booked_out_status['timestamp']);
            }
            $data1['query1'] = $this->Doctor_model->doctor_record_detail($id);
            $name_identified_by = "";
            if (!empty($data1['query1'][0]->ap_identified_by)) {
                $name_identified_by = $this->Doctor_model->get_user_full_name($data1['query1'][0]->ap_identified_by);
            }
            $data2['query2'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $data3['query3'] = $this->Doctor_model->get_further_work($id);
            $data4['query4'] = $this->Doctor_model->get_additional_work_for_prebulish($id);
            $data5['query5'] = $this->Doctor_model->get_hospital_info($id);
            $data6['name_identified_by'] = $name_identified_by;
            $result = array_merge($data1, $data2, $data3, $data4, $data5, $lab_release_date, $data6);
            $this->load->view('doctor/view_autopsy_pdf_new', $result);
        }
    }

    /**
     * Micrscopic Ajax
     *
     * @return void
     */
    public function get_microscopic_ajax_record()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $microscopic_array = array(
            '001' => 'This is a Test Text for 001',
            '007' => 'This is a Test Text for 007'
        );
        $micro_id = '';
        $micro_id = $this->input->post('id');
        if (!empty($micro_id) && isset($micro_id)) {
            if (array_key_exists($micro_id, $microscopic_array)) {
                echo $value = $microscopic_array[$micro_id];
            } else {
                echo $value = 'NO Record Found';
            }
        }
        die;
    }

    /**
     * Download Section
     *
     * @param int $id
     * @return void
     */
    public function doctor_download_section($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $session_data = array(
            'record_id' => $id
        );
        $this->session->set_userdata($session_data);
        $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/download_section', $files_data);
        $this->load->view('doctor/inc/footer-new');
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
        if (isset($record_id) && !empty($record_id)) :
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('upload_error', $error['error']);
                redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
            } else {
                $user = $this->ion_auth->user()->row()->enc_username;
                $doctor_id = $this->ion_auth->user()->row()->id;
                $data = $this->upload->data();
                $file_id = $this->Doctor_model->insert_file(
                    $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $user, $doctor_id, $record_id
                );
                $uplaod_success = '<p class="bg-success" style="padding:7px;">File Successfully Uploaded.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_success);
                redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
            }
        endif;
    }


    /**
     * Upload Files
     *
     * @param int $record_id
     * @return void
     */
    public function do_upload_captured($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $image_base64 = $this->input->post('image');
        $img = str_replace('data:image/jpeg;base64,', '', $image_base64);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $image_name = time();
        $filename = $image_name . '.' . 'jpeg';
        //rename file name with random number
        $path = "./uploads/" . $filename;
        if (file_put_contents($path, $data)) {

            $user = $this->ion_auth->user()->row()->enc_username;
            $doctor_id = $this->ion_auth->user()->row()->id;
            $file_tag = "case";
            $file_id = $this->Doctor_model->insert_file(
                $filename, $filename, $path, '.jpeg', 1, $user, $doctor_id, $record_id, $file_tag
            );
            $uplaod_success = '<p class="bg-success" style="padding:7px;">Captured Image Successfully Uploaded.</p>';
            $this->session->set_flashdata('upload_success', $uplaod_success);
            redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
        } else {
            $this->session->set_flashdata('upload_error', 'There was an error uploading image');
            redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
        }

//        if (isset($record_id) && !empty($record_id)) :
//            $config['upload_path'] = './uploads/';
//            $config['allowed_types'] = '*';
//            $config['max_size'] = '9000';
//            $this->load->library('upload', $config);
//
//            if (!$this->upload->do_upload($image_base64)) {
//                echo "HERE"; exit;
//                $error = array('error' => $this->upload->display_errors());
//
//                $this->session->set_flashdata('upload_error', $error['error']);
//                redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
//            } else {
//
//                $data = $this->upload->data();
//
//                $file_id = $this->Doctor_model->insert_file(
//                    $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $user, $doctor_id, $record_id, $file_tag
//                );
//                $uplaod_success = '<p class="bg-success" style="padding:7px;">Captured Image Successfully Uploaded.</p>';
//                $this->session->set_flashdata('upload_success', $uplaod_success);
//                redirect('doctor/doctor_record_detail_old/' . $record_id, 'refresh');
//            }
//        endif;
    }

    /**
     * Upload Multiple Files
     *
     * @param int $record_id
     * @return void
     */
    public function do_upload_multiple($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $autopsy_redirect = 'doctor/doctor_record_detail_old/' . $record_id;
        if ($this->input->post('autopsy_url')) {
            $autopsy_redirect = $this->input->post('autopsy_url');
        }
        if (isset($record_id) && !empty($record_id)) {
            $file_tag = $this->input->post('file_tag');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);
            $files = array();
            if (!empty($_FILES['userfile']['name'][0])) {
                $files = $_FILES['userfile'];
            }
            foreach ($files['name'] as $key => $doc_file) {
                $all_processed = 0;
                $_FILES['userfile']['name'] = $files['name'][$key];
                $_FILES['userfile']['type'] = $files['type'][$key];
                $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['userfile']['error'] = $files['error'][$key];
                $_FILES['userfile']['size'] = $files['size'][$key];
                $config['file_name'] = $doc_file;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('upload_success', $error['error']);
                    redirect($autopsy_redirect, 'refresh');
                } else {
                    $user = $this->ion_auth->user()->row()->username;
                    $doctor_id = $this->ion_auth->user()->row()->id;
                    $data = $this->upload->data();
                    $file_id = $this->Doctor_model->insert_file(
                        $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $user, $doctor_id, $record_id, $file_tag
                    );
                    $all_processed = 1;
                }
            }
            if ($all_processed == 1) {
                $uplaod_success = '<p class="bg-success" style="padding:7px;">File(s) Successfully Uploaded.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_success);
                redirect($autopsy_redirect, 'refresh');
            } else {
                $uplaod_error = '<p class="bg-danger" style="padding:7px;">Something went wrong.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_error);
                redirect($autopsy_redirect, 'refresh');
            }
        }
    }

    /**
     * Upload download section
     *
     * @param int $record_id
     * @return void
     */
    public function do_upload_download_section($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($record_id) && !empty($record_id)) :
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('upload_error', $error['error']);
                redirect('doctor/doctor_download_section/' . $record_id, 'refresh');
            } else {
                $user = $this->ion_auth->user()->row()->username;
                $doctor_id = $this->ion_auth->user()->row()->id;
                $data = $this->upload->data();
                $file_id = $this->Doctor_model->insert_file(
                    $data['file_name'], $data['raw_name'], $data['full_path'], $data['file_ext'], $data['is_image'], $user, $doctor_id, $record_id
                );
                $uplaod_success = '<p class="bg-success" style="padding:7px;">File Successfully Uploaded.</p>';
                $this->session->set_flashdata('upload_success', $uplaod_success);
                redirect('doctor/doctor_download_section/' . $record_id, 'refresh');
            }
        endif;
    }

    /**
     * Delete record files
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
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($file_id) && isset($doctor_id) && isset($record_id)) :
            $get_file_path_query = $this->db->query("SELECT * FROM files WHERE files_id = $file_id AND user_id = $doctor_id ORDER BY files_id");
            $get_file_path = $get_file_path_query->result();
            $this->db->query("DELETE FROM files WHERE files_id = $file_id AND user_id = $doctor_id ORDER BY files_id");
            unlink($get_file_path[0]->file_path);
            $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
            $this->session->set_flashdata('delete_file', $delete_file);
            redirect('doctor/doctor_record_detail/' . $record_id, 'refresh');
        endif;
    }

    /**
     * Delete function for download section.
     *
     * @return void
     */
    public function delete_download_section_files()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = $_GET['record_id'];
        $file_id = $_GET['file_id'];
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($file_id) && isset($doctor_id) && isset($record_id)) {
            $get_file_path_query = $this->db->query("SELECT * FROM files WHERE files_id = $file_id AND user_id = $doctor_id ORDER BY files_id");
            $get_file_path = $get_file_path_query->result();
            $this->db->query("DELETE FROM files WHERE files_id = $file_id AND user_id = $doctor_id ORDER BY files_id");
            unlink($get_file_path[0]->file_path);
            $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
            $this->session->set_flashdata('delete_file', $delete_file);
            redirect('doctor/doctor_download_section/' . $record_id, 'refresh');
        }
    }

    /**
     * Datatable records
     *
     * @return void
     */
    public function datatable_record()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $requestData = $_REQUEST;
        $query = $this->db->query('SELECT * FROM request');
        $count = $query->num_rows();
        $totalFiltered = $count;
        $query->result();
        $json_data = array(
            "recordsTotal" => intval($count),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $query
        );
        $json = json_encode($json_data);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/test_view', $json);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Check Pin to publish the record.
     *
     * @return void
     */
    public function check_auth_pass()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST)) {
            $json = array();
            $user_id = $this->ion_auth->user()->row()->id;
            $auth_pass1 = $_POST['auth_pass1'];
            $auth_pass2 = $_POST['auth_pass2'];
            $auth_pass3 = $_POST['auth_pass3'];
            $auth_pass4 = $_POST['auth_pass4'];
            $user_pass = str_split($this->ion_auth->user()->row()->user_auth_pass);
            $request_id = $_POST['request_id'];
            if (empty($user_pass) && !is_array($user_pass)) {
                $json['type'] = 'error';
                $json['message'] = '<div class="alert bg-danger">Your Pin is not set yet!</div>';
                echo json_encode($json);
                die;
            }
            if ($auth_pass1 != '' && $auth_pass2 != '' && $auth_pass3 != '' && $auth_pass4 != '' && !empty($user_pass)) {
                if ($user_pass[0] === $auth_pass1 && $user_pass[1] === $auth_pass2 && $user_pass[2] === $auth_pass3 && $user_pass[3] === $auth_pass4) {
                    $check_record_status = $this->db->select('publish_datetime')->where('uralensis_request_id', $request_id)->get('request')->row_array()['publish_datetime'];
                    if (!empty($check_record_status)) {
                        $data = array(
                            'status' => 1,
                            'specimen_publish_status' => 1,
                            'publish_status' => 1,
                            'publish_datetime_modified' => time(),
                            'record_secretary_status' => 'false',
                            'authorize_status' => 'false',
                            'request_code_status' => 'record_publish'
                        );
                    } else {
                        $data = array(
                            'status' => 1,
                            'specimen_publish_status' => 1,
                            'publish_status' => 1,
                            'publish_datetime' => date('Y-m-d h:i:s'),
                            'record_secretary_status' => 'false',
                            'authorize_status' => 'false',
                            'request_code_status' => 'record_publish'
                        );
                    }
                    $this->db->where('uralensis_request_id', $request_id);
                    $this->db->update('request', $data);
                    if (isset($_POST['mdt_not_select']) && $_POST['mdt_not_select'] === 'mdt_uncheck') {
                        $data = array(
                            'mdt_case' => 'not_to_add_to_report',
                            'mdt_case_status' => 'not_for_mdt'
                        );
                        $this->db->where('uralensis_request_id', $request_id);
                        $this->db->update('request', $data);
                    }
                    $fw_data = array(
                        'fw_status' => 'complete'
                    );
                    $this->db->where('request_id', $request_id);
                    $this->db->update('further_work', $fw_data);
                    $history_data = array(
                        'rec_history_user_id' => $user_id,
                        'rec_history_record_id' => $request_id,
                        'rec_history_data' => '',
                        'rec_history_status' => 'publish',
                        'timestamp' => time()
                    );
                    $this->db->insert('uralensis_record_history', $history_data);
                    $json['type'] = 'success';
                    $json['message'] = '<div class="alert bg-success">Pin Match. Please Wait......</div>';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = '<div class="alert bg-danger">Your Pin Did Not Match!</div>';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = '<div class="alert bg-danger">Some thing wrong!</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Function that will un published the record
     *
     * @param int $id
     * @return void
     */
    public function unpublish_record($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $unpublish_record_id = $id;
        $update_data = array(
            'specimen_publish_status' => 0,
            'report_status' => 1,
            'record_secretary_status' => 'unset'
        );
        $this->db->where('uralensis_request_id', $unpublish_record_id);
        $this->db->update('request', $update_data);
        $record_unpublish_message = '<p class="bg-success" style="padding:7px;">Your Record Has Been Successfully Un-Published.</p>';
        $this->session->set_flashdata('unpublish_record_message', $record_unpublish_message);
        redirect('/doctor/doctor_record_list');
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
            $json['message'] = 'Comments Suuccessfully Added To Report PDF.';
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
            $json['message'] = 'Comments Successfully Removed';
            echo json_encode($json);
            die;
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
    }

    /**
     * Display Teaching Cases Controller
     *
     * @return void
     */
    public function teaching_cases()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $edu_cats["edu_cats"] = $this->Doctor_model->get_education_cases_model();
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/teaching_cases', $edu_cats);
        $this->load->view('doctor/inc/footer-new');
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
        $hospitals["get_hospitals"] = $this->Doctor_model->display_hospitals_list();
        $result = array_merge($hospitals);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/mdt_cases', $result);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * New MDT System
     *
     * @return void
     */
    public function mdt_cases_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hospitals["get_hospitals"] = $this->Doctor_model->display_doctor_only_hospitals();
        $result = array_merge($hospitals);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/mdt_cases_new', $result);
        $this->load->view('doctor/inc/footer-new');
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
        $encode_lists = '';
        if ($_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $check_mdt = $this->db->query("SELECT * FROM uralensis_mdt_lists WHERE uralensis_mdt_lists.ura_mdt_list_hospital_id = $hospital_id")->result();
            if (!empty($check_mdt)) {
                $encode_lists .= '<select class="form-control mdt_list" name="mdt_list" data-hospitalid="' . $hospital_id . '">';
                $encode_lists .= '<option value="false">Select MDT List</option>';
                foreach ($check_mdt as $mdt_list) {
                    $encode_lists .= '<option value="' . $mdt_list->ura_mdt_list_id . '">' . $mdt_list->ura_mdt_list_name . '</option>';
                }
                $encode_lists .= '</select>';
                $json['type'] = 'success';
                $json['dates_data'] = $encode_lists;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $get_mdt_dates = $this->Doctor_model->get_all_mdt_dates($hospital_id);
                if (!empty($get_mdt_dates)) {
                    $encode_future .= '<select class="form-control" name="mdt_dates" id="mdt_dates">';
                    $encode_future .= '<option value="false">Choose Up Coming MDT Dates</option>';
                    foreach ($get_mdt_dates as $dates) {
                        $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                        $encode_future .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
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
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find MDT Dates
     *
     * @return void
     */
    public function find_mdt_dates_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode_future = '';
        $encode_lists = '';
        if ($_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $get_mdt_dates = $this->Doctor_model->get_all_mdt_dates($hospital_id);
            if (!empty($get_mdt_dates)) {
                $encode_future .= '<select class="form-control" name="mdt_dates" id="mdt_dates_new">';
                $encode_future .= '<option value="false">Choose Up Coming MDT Dates</option>';
                foreach ($get_mdt_dates as $dates) {
                    $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                    $encode_future .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
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
     * Find MDT dates on MDT lists
     *
     * @return void
     */
    public function find_mdt_dates_on_mdt_lists()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode_future = '';
        if ($_POST['list_id'] !== 'false') {
            $list_id = $_POST['list_id'];
            $hospital_id = $_POST['hospital_id'];
            $get_mdt_dates = $this->Doctor_model->get_all_mdt_dates_based_on_list($list_id, $hospital_id);
            if (!empty($get_mdt_dates)) {
                $encode_future .= '<select class="form-control" name="mdt_dates" id="mdt_dates" data-mdtlistid="' . $list_id . '">';
                $encode_future .= '<option value="false">Choose Up Coming MDT Dates</option>';
                foreach ($get_mdt_dates as $dates) {
                    $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                    $encode_future .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                }
                $encode_future .= '</select>';
                $json ['type'] = 'success';
                $json['dates_data'] = $encode_future;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'NO MDT Found Against the selected List.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose MDT List First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find MDT dates on mdt lists new function
     *
     * @return void
     */
    public function find_mdt_dates_on_mdt_lists_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode_future = '';
        if ($_POST['list_id'] !== 'false') {
            $list_id = $_POST['list_id'];
            $hospital_id = $_POST['hospital_id'];
            $get_mdt_dates = $this->Doctor_model->get_all_mdt_dates_based_on_list_new($list_id, $hospital_id);
            if (!empty($get_mdt_dates)) {
                $encode_future .= '<select class="form-control" name="mdt_dates" id="mdt_dates_new" data-mdtlistid="' . $list_id . '">';
                $encode_future .= '<option value="false">Choose Up Coming MDT Dates</option>';
                foreach ($get_mdt_dates as $dates) {
                    $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                    $encode_future .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                }
                $encode_future .= '</select>';
                $json ['type'] = 'success';
                $json['dates_data'] = $encode_future;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'NO MDT Found Against the selected List.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose MDT List First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find archived mdt dates
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
        $encode_lists = '';
        if ($_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $check_mdt = $this->db->query("SELECT * FROM uralensis_mdt_lists WHERE uralensis_mdt_lists.ura_mdt_list_hospital_id = $hospital_id")->result();
            if (!empty($check_mdt)) {
                $encode_lists .= '<select class="form-control prev_mdt_list" name="prev_mdt_list" data-hospitalid="' . $hospital_id . '">';
                $encode_lists .= '<option value="false">Select MDT List</option>';
                foreach ($check_mdt as $mdt_list) {
                    $encode_lists .= '<option value="' . $mdt_list->ura_mdt_list_id . '">' . $mdt_list->ura_mdt_list_name . '</option>';
                }
                $encode_lists .= '</select>';
                $json['type'] = 'success';
                $json['dates_prev_data'] = $encode_lists;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $get_prev_mdt_dates = $this->Doctor_model->get_previous_all_mdt_dates($hospital_id);
                if (!empty($get_prev_mdt_dates)) {
                    $encode_prev .= '<select class="form-control" name="prev_mdt_dates" id="prev_mdt_dates">';
                    $encode_prev .= '<option value="false">Choose Archived MDT Dates</option>';
                    foreach ($get_prev_mdt_dates as $dates) {
                        $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                        $encode_prev .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
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
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose Hospital First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find archived mdt dates new function
     *
     * @return void
     */
    public function find_prev_mdt_dates_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode_prev = '';
        $encode_lists = '';
        if ($_POST['hospital_id'] !== 'false') {
            $hospital_id = $_POST['hospital_id'];
            $get_prev_mdt_dates = $this->Doctor_model->get_previous_all_mdt_dates($hospital_id);
            if (!empty($get_prev_mdt_dates)) {
                $encode_prev .= '<select class="form-control" name="prev_mdt_dates" id="prev_mdt_dates_new">';
                $encode_prev .= '<option value="false">Choose Archived MDT Dates</option>';
                foreach ($get_prev_mdt_dates as $dates) {
                    $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                    $encode_prev .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
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
     * Find archived mdt dates on mdt lists
     *
     * @return void
     */
    public function find_prev_mdt_dates_on_mdt_lists()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode_future = '';
        if ($_POST['list_id'] !== 'false') {
            $list_id = $_POST['list_id'];
            $hospital_id = $_POST['hospital_id'];
            $get_prev_mdt_dates = $this->Doctor_model->get_previous_all_mdt_dates_based_on_list($list_id, $hospital_id);
            if (!empty($get_prev_mdt_dates)) {
                $encode_future .= '<select class="form-control" name="prev_mdt_dates" id="prev_mdt_dates" data-mdtlistid="' . $list_id . '">';
                $encode_future .= '<option value="false">Choose Previous MDT Dates</option>';
                foreach ($get_prev_mdt_dates as $dates) {
                    $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                    $encode_future .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                }
                $encode_future .= '</select>';
                $json ['type'] = 'success';
                $json['dates_data'] = $encode_future;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'NO MDT Found Against the selected List.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose MDT List First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find archived mdt dates new on mdt lists
     *
     * @return void
     */
    public function find_prev_mdt_dates_on_mdt_lists_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode_future = '';
        if ($_POST['list_id'] !== 'false') {
            $list_id = $_POST['list_id'];
            $hospital_id = $_POST['hospital_id'];
            $get_prev_mdt_dates = $this->Doctor_model->get_previous_all_mdt_dates_based_on_list($list_id, $hospital_id);
            if (!empty($get_prev_mdt_dates)) {
                $encode_future .= '<select class="form-control" name="prev_mdt_dates" id="prev_mdt_dates_new" data-mdtlistid="' . $list_id . '">';
                $encode_future .= '<option value="false">Choose Previous MDT Dates</option>';
                foreach ($get_prev_mdt_dates as $dates) {
                    $change_mdt_timestamp = date('Y-m-d', $dates->ura_mdt_timestamp);
                    $encode_future .= '<option value="' . $change_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                }
                $encode_future .= '</select>';
                $json ['type'] = 'success';
                $json['dates_data'] = $encode_future;
                $json['msg'] = 'Following MDT Dates Found.';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'NO MDT Found Against the selected List.';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Choose MDT List First.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Find mdt dates records
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
            $list_id = !empty($_POST['list_id']) ? $_POST['list_id'] : '';
            $mdt_record = $this->Doctor_model->mdt_cases_list_model($hospital_id, $mdt_date, $list_id);
            if (!empty($mdt_record)) {
                $encode .= '<a href="' . base_url('index.php/doctor/generate_word?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date . '&mdt_list=' . $list_id) . '">Download Word</a>';
                $encode .= '<a target="_blank" class="pull-right" href="' . base_url('index.php/doctor/generate_mdt_pdf?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date . '&mdt_list=' . $list_id) . '">Download PDF</a>';
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
     * Find mdt dates cases new function
     *
     * @return void
     */
    public function find_mdt_cases_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode = '';
        if (!empty($_POST['hospital_id']) && !empty($_POST['mdt_date'])) {
            $hospital_id = $_POST['hospital_id'];
            $mdt_date = $_POST['mdt_date'];
            $mdt_record = $this->Doctor_model->mdt_cases_list_model_new($hospital_id, $mdt_date);
            if (!empty($mdt_record)) {
                $encode .= '<a href="' . base_url('index.php/doctor/generate_word_new?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date) . '">Download Word</a>';
                $encode .= '<a target="_blank" class="pull-right" href="' . base_url('index.php/doctor/generate_mdt_pdf_new?hospital_id=' . $hospital_id . '&mdt_date=' . $mdt_date) . '">Download PDF</a>';
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
            $list_id = !empty($_POST['list_id']) ? $_POST['list_id'] : '';
            $mdt_record = $this->Doctor_model->mdt_cases_list_model($hospital_id, $prev_mdt_date, $list_id = '');
            if (!empty($mdt_record)) {
                $encode .= '<a href="' . base_url('index.php/doctor/generate_word?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date . '&mdt_list=' . $list_id) . '">Download Word</a>';
                $encode .= '<a target="_blank" class="pull-right" href="' . base_url('index.php/doctor/generate_mdt_pdf?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date . '&mdt_list=' . $list_id) . '">Download PDF</a>';
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
     * Find archived mdt cases new function
     *
     * @return void
     */
    public function find_prev_mdt_cases_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $encode = '';
        if (!empty($_POST['hospital_id']) && !empty($_POST['prev_mdt_date'])) {
            $hospital_id = $_POST['hospital_id'];
            $prev_mdt_date = $_POST['prev_mdt_date'];
            $list_id = !empty($_POST['list_id']) ? $_POST['list_id'] : '';
            $mdt_record = $this->Doctor_model->mdt_cases_list_model_new($hospital_id, $prev_mdt_date, $list_id = '');
            //echo last_query();exit;
            if (!empty($mdt_record)) {
                $encode .= '<a href="' . base_url('index.php/doctor/generate_word_new?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date . '&mdt_list=' . $list_id) . '">Download Word</a>';
                $encode .= '<a target="_blank" class="pull-right" href="' . base_url('index.php/doctor/generate_mdt_pdf_new?hospital_id=' . $hospital_id . '&mdt_date=' . $prev_mdt_date . '&mdt_list=' . $list_id) . '">Download PDF</a>';
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
     * Change MDT records status
     *
     * @return void
     */
    public function publish_to_post_mdt()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($_GET)) {
            $record_id = $_GET['record_id'];
            $hospital_id = $_GET['hospital_id'];
            $update_status = array('mdt_case_status' => 'post');
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $update_status);
            $success = '<div class="alert bg-success">Pending MDT Case Status Successfully Changed To Post MDT.</div>';
            $this->session->set_flashdata('pending_to_post_success_msg', $success);
            redirect('/doctor/find_mdt_cases?hospital_id=' . $hospital_id);
        }
    }

    /**
     * Teaching Case Detail Controller
     *
     * @param int $record_id
     * @return void
     */
    public function teaching_case_detail($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($record_id)) {
            $data["query"] = $this->Doctor_model->teaching_case_detail_model($record_id);
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/teaching_case_detail', $data);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * MDT Case Detail Controller
     *
     * @return void
     */
    public function mdt_case_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($_GET['record_id'])) {
            $record_id = $_GET['record_id'];
            $data1["mdt_cases"] = $this->Doctor_model->mdt_case_detail_model();
            $data2["mdt_cases_specimen"] = $this->Doctor_model->doctor_record_detail_specimen($record_id);
            $mdt_case_result = array_merge($data1, $data2);
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/mdt_case_detail', $mdt_case_result);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Remove Teaching Case
     *
     * @param int $record_id
     * @return void
     */
    public function remove_teaching_case($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->query("UPDATE request SET request.teaching_case = 'off' WHERE request.uralensis_request_id = $record_id");
        $success = '<div class="alert bg-success">Teaching Case Successfully Removed From This Tab.</div>';
        $this->session->set_flashdata('teaching_success_remove', $success);
        redirect('doctor/teaching_cases');
    }

    /**
     * Remove Pending MDT Case
     *
     * @return void
     */
    public function remove_mdt_case_pending()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($_GET)) {
            $record_id = $_GET['record_id'];
            $hospital_id = $_GET['hospital_id'];
            $this->db->query("UPDATE request SET request.mdt_case = 'off' WHERE request.uralensis_request_id = $record_id");
            $success = '<div class="alert bg-success">Pending MDT Case Successfully Removed From Pending MDT Tab.</div>';
            $this->session->set_flashdata('pending_mdt_success_remove', $success);
            redirect('doctor/find_mdt_cases?hospital_id=' . $hospital_id);
        }
    }

    /**
     * Remove Post MDT Case
     *
     * @return void
     */
    public function remove_mdt_case_post()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($_GET)) {
            $record_id = $_GET['record_id'];
            $hospital_id = $_GET['hospital_id'];
            $this->db->query("UPDATE request SET request.mdt_case_status = 'pending' WHERE request.uralensis_request_id = $record_id");
            $success = '<div class="alert bg-success">Post MDT Case Successfully Removed From Post MDT Tab And Moved To Pending Tab.</div>';
            $this->session->set_flashdata('post_mdt_success_remove', $success);
            redirect('doctor/find_mdt_cases?hospital_id=' . $hospital_id);
        }
    }

    /**
     * Display Further Work.
     *
     * @return void
     */
    public function view_further_work()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_GET) && $_GET['fw_page'] == 'requested') {
            $fw_data1["requested"] = $this->Doctor_model->display_further_work_model_requested();
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/fw_requested', $fw_data1);
            $this->load->view('doctor/inc/footer-new');
        } else if (!empty($_GET) && $_GET['fw_page'] == 'completed') {
            $fw_data2["completed"] = $this->Doctor_model->display_further_work_model_completed();
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/fw_completed', $fw_data2);
            $this->load->view('doctor/inc/footer-new');
        } else {
            redirect('/doctor');
        }
    }

    /**
     * Further Work Complete
     *
     * @param [type] $fw_id
     * @return void
     */
    public function further_work_complete($fw_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $update_status = array(
            'fw_status' => 'complete'
        );
        $this->db->where('fw_id', $fw_id);
        $this->db->update('further_work', $update_status);
        redirect('/doctor/view_furtehr_work');
    }

    /**
     * Profile Setting View
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
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/profile_form', $decryptedDetails);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Update Profile Settings
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
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/profile_form');
            $this->load->view('doctor/inc/footer-new');
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
                    $this->load->view('doctor/inc/header-new');
                    $this->load->view('doctor/profile_form');
                    $this->load->view('doctor/inc/footer-new');
                } else {
                    $data = $this->upload->data();
                }
            }
            $profile_data = array(
                'gmc_code' => $this->input->post('gmc_code'),
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
                redirect('doctor/profile_form');
            } else {
                $general_error = '<div class="alert bg-danger">Something Went Wrong While Updating Profile Information.</div>';
                $this->session->set_flashdata('general_error', $general_error);
                redirect('doctor/update_profile');
            }
        }
    }

    /**
     * Filter records by hospiatl and urgency
     *
     * @return void
     */
    public function filter_results()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$_POST['hospital_id'] == 0 || !$_POST['report_urgency'] == 0) {
            $hospital_id = $_POST['hospital_id'];
            $report_urgency = $_POST['report_urgency'];
            $filter_result["filter_data"] = $this->Doctor_model->find_filter_results($hospital_id, $report_urgency);
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/filter_results', $filter_result);
            $this->load->view('doctor/inc/footer-new');
        } else {
            $general_error = '<div class="alert bg-danger">Please Select One of The Filter Option Below.</div>';
            $this->session->set_flashdata('general_error', $general_error);
            redirect('doctor/doctor_record_list');
        }
    }

    /**
     * Change record PIN
     *
     * @return void
     */
    public function change_pin()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (!intval($_POST['new_pin']) || !intval($_POST['new_confirm_pin'])) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert bg-danger">Use Only Digits.</div>';
            echo json_encode($json);
            die;
        } else if (intval($_POST['new_confirm_pin']) !== intval($_POST['new_pin'])) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert bg-danger">Your Confirm Pin Did Not Match.</div>';
            echo json_encode($json);
            die;
        } else {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data = array(
                'user_auth_pass' => $this->input->post('new_confirm_pin')
            );
            $this->db->where('id', $doctor_id);
            $this->db->update('users', $data);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert bg-success">Pin Match and saved successfully.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Change Password Function
     *
     * @return void
     */
    public function change_password_doctor()
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
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data = array(
            'password' => $hash_change_pass
        );
        $this->db->where('id', $doctor_id);
        $this->db->update('users', $data);
        $json['type'] = 'success';
        $json['msg'] = '<div class="alert alert-success">Password Successfully Updated.</div>';
        echo json_encode($json);
        $this->ion_auth->logout();
    }

    /**
     * Manage Supplementary Reports
     *
     * @return void
     */
    public function manage_supplemenary()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (!empty($_POST['supple_id'])) {
            $supple_id = $_POST['supple_id'];
            $this->db->query("DELETE FROM additional_work WHERE additional_id = $supple_id");
            $record_id = $_POST['record_id'];
            $check_supple_rec = $this->db->query("SELECT * FROM additional_work WHERE additional_work.request_id = $record_id");
            $check_supply_result = $check_supple_rec->num_rows();
            if ($check_supply_result == 0) {
                $this->db->where('uralensis_request_id', $record_id);
                $this->db->update('request', array('supplementary_report_status' => 0, 'additional_data_state' => '', 'supplementary_review_status' => 'false'));
                $check_request_year = $this->db->query("SELECT * FROM request WHERE request.uralensis_request_id = $record_id");
                $get_result = $check_request_year->result();
                $get_request_date = $get_result [0]->request_datetime;
                $get_request_year = date('Y', strtotime($get_request_date));
                $redirect_url = base_url('index.php/doctor/published_reports/' . $get_request_year . '/all');
                $json['type'] = 'success';
                $json['redirect_url'] = $redirect_url;
                $json['supply_val'] = 'false';
                echo json_encode($json);
                die;
            }
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert bg-success">Successfully Removed</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert bg-danger">Something Wrong While Deleting.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Download Pending MDT Cases.
     *
     * @param int $hospital_id
     * @return void
     */
    public function download_pending_mdt($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $group_name = $this->ion_auth->group($hospital_id)->row()->description;
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
                'First Name',
                'Sur Name',
                'EMIS No',
                'Gender'
            )
        );
        $download_pending_mdt = $this->db->query(
            "SELECT * FROM request
                INNER JOIN users_request
                INNER JOIN groups
                INNER JOIN request_assignee
                WHERE users_request.request_id = request.uralensis_request_id
                AND request.uralensis_request_id = request_assignee.request_id
                AND groups.id = users_request.group_id
                AND users_request.group_id = $hospital_id
                AND request_assignee.user_id = $doctor_id
                AND request.mdt_case_status = 'pending'
                AND request.mdt_case =  'on'
        ");
        foreach ($download_pending_mdt->result_array() as $row) {
            fputcsv($output, array(
                    'Uralensis NO' => $row['serial_number'],
                    'First Name' => $row['f_name'],
                    'Sur Name' => $row['sur_name'],
                    'EMIS No' => $row['emis_number'],
                    'Gender' => $row['gender']
                )
            );
        }
    }

    /**
     * Download Post MDT Cases.
     *
     * @param int $hospital_id
     * @return void
     */
    public function download_post_mdt($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $group_name = $this->ion_auth->group($hospital_id)->row()->description;
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
                'First Name',
                'Sur Name',
                'EMIS No',
                'Gender'
            )
        );
        $download_pending_mdt = $this->db->query("SELECT * FROM request
                        INNER JOIN users_request
                        INNER JOIN groups
			            INNER JOIN request_assignee
                        WHERE users_request.request_id = request.uralensis_request_id
                        AND request.uralensis_request_id = request_assignee.request_id
                        AND groups.id = users_request.group_id
                        AND users_request.group_id = $hospital_id
                        AND request_assignee.user_id = $doctor_id
                        AND request.mdt_case_status = 'post'
                        AND request.mdt_case =  'on'");
        foreach ($download_pending_mdt->result_array() as $row) {
            fputcsv($output, array(
                    'Uralensis NO' => $row['serial_number'],
                    'First Name' => $row['f_name'],
                    'Sur Name' => $row['sur_name'],
                    'EMIS No' => $row['emis_number'],
                    'Gender' => $row['gender']
                )
            );
        }
    }

    /**
     * Display Education Cases Based On Category
     *
     * @return void
     */
    public function display_edu_cases()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST) && $_POST['edu_cats'] == 0) {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Select the Category</div>';
            echo json_encode($json);
            die;
        } else {
            $category_id = $_POST['edu_cats'];
            $edu_cases = $this->Doctor_model->teaching_cases($category_id);
            $json_encode = '';
            $json_encode .= '<table id="teaching_case_table" class="table table-striped" cellspacing="0" width="100%">';
            $json_encode .= '<thead><tr class="info">';
            $json_encode .= '<th>Serial No</th>';
            $json_encode .= '<th>First Name</th>';
            $json_encode .= '<th>Sur Name</th>';
            $json_encode .= '<th>EMIS No</th>';
            $json_encode .= '<th>NHS No.</th>';
            $json_encode .= '<th>LAB No.</th>';
            $json_encode .= '<th>Gender</th>';
            $json_encode .= '<th>Request Date</th>';
            $json_encode .= '<th>Report</th>';
            $json_encode .= '<th>Detail</th>';
            $json_encode .= '<th>Status</th>';
            $json_encode .= '<th>&nbsp;</th>';
            $json_encode .= '</tr></thead>';
            $json_encode .= '<tfoot><tr class="info">';
            $json_encode .= '<th>Serial No</th>';
            $json_encode .= '<th>First Name</th>';
            $json_encode .= '<th>Sur Name</th>';
            $json_encode .= '<th>EMIS No</th>';
            $json_encode .= '<th>NHS No.</th>';
            $json_encode .= '<th>LAB No.</th>';
            $json_encode .= '<th>Gender</th>';
            $json_encode .= '<th>Request Date</th>';
            $json_encode .= '<th>Report</th>';
            $json_encode .= '<th>Detail</th>';
            $json_encode .= '<th>Status</th>';
            $json_encode .= '<th>&nbsp;</th>';
            $json_encode .= '</tr></tfoot>';
            $json_encode .= '<tbody>';
            if (!empty($edu_cases)) {
                foreach ($edu_cases as $row) {
                    $json_encode .= '<tr>';
                    $json_encode .= '<td>' . $row['serial_number'] . '</td>';
                    $json_encode .= '<td>' . $row ['f_name'] . '</td>';
                    $json_encode .= '<td>' . $row ['sur_name'] . '</td>';
                    $json_encode .= '<td>' . $row['emis_number'] . '</td>';
                    $json_encode .= '<td>' . $row['nhs_number'] . '</td>';
                    $json_encode .= '<td>' . $row['lab_number'] . '</td>';
                    $json_encode .= '<td>' . $row ['gender'] . '</td>';
                    $json_encode .= '<td>' . date('M j Y g:i A', strtotime($row['request_datetime'])) . '</td>';
                    $json_encode .= '<td>';
                    if ($row['specimen_publish_status'] == 1) {
                        '<a target="_blank" href="' . base_url('index.php/doctor/generate_report/' . $row['uralensis_request_id']) . '"><img src="' . base_url('assets/img/Pdf_file_symbol_32.png') . '" title="Pdf View"></a>';
                    } else {
                        'Not Published';
                    }
                    $json_encode .= '</td>';
                    $json_encode .= '<td><a href="' . site_url() . '/doctor/teaching_case_detail/' . $row['uralensis_request_id'] . '"><img src="' . base_url('assets/img/detail.png') . '"></a></td>';
                    $json_encode .= '<td>';
                    if ($row ['specimen_update_status'] == 0 && $row['specimen_publish_status'] == 0) :
                        '<span>Not Updated</span> <img src="' . base_url('assets/img/error.png') . '">';
                    elseif ($row ['specimen_update_status'] == 1 && $row['specimen_publish_status'] == 0) :
                        '<span style="color:green;"><strong>Updated ..</strong> &nbsp;&nbsp; </span> <img src="' . base_url('assets/img/update.png') . '">';
                    elseif ($row ['specimen_update_status'] == 1 && $row['specimen_publish_status'] == 1) :
                        '<span style="color:green;">Published</span> <img src="' . base_url('assets/img/correct.png') . '">';
                    endif;
                    $json_encode .= '</td>';
                    $json_encode .= '<td><a href="' . site_url() . '/doctor/remove_teaching_case/' . $row['uralensis_request_id'] . '"><img src="' . base_url('assets/img/error.png') . '"></a></td>';
                    $json_encode .= '</tr>';
                }
                $json_encode .= '</tbody>';
                $json_encode .= '</table>';
                $json['type'] = 'success';
                $json['edu_data'] = $json_encode;
                $json['msg'] = '<div class="alert alert-success">Records Found.</div>';
                echo json_encode($json);
                die;
            }
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">No Record Found.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Display Message Board
     *
     * @return void
     */
    public function messages_center()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $total_unread['unread'] = $this->Doctor_model->get_total_unread_msg($doctor_id);
        $list_all_users['list_users'] = $this->Doctor_model->get_message_users($doctor_id);
        $admin_sent_msg['sent_msg'] = $this->Doctor_model->display_doctor_msg_model($doctor_id, 'sent');
        $admin_inbox_msg['inbox_msg'] = $this->Doctor_model->display_doctor_msg_model($doctor_id, 'inbox');
        $admin_trash_msg['trash_msg'] = $this->Doctor_model->display_doctor_msg_model($doctor_id, 'trash');
        $merge_msg_data = array_merge($total_unread, $admin_sent_msg, $admin_inbox_msg, $admin_trash_msg, $list_all_users);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/message_center/message_center', $merge_msg_data);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Get users list
     *
     * @return void
     */
    public function get_users_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $searchterm = $_GET['term'];
        $doctor_id = $this->ion_auth->user()->row()->id;
        $names = array();
        $query = $this->db->query("SELECT * FROM users WHERE users.username LIKE '%$searchterm%' AND users.id != $doctor_id ORDER BY users.username");
        $result = $query->result_array();
        if (!empty($result)) {
            $names = array();
            foreach ($result as $row) {
                $names[] = array('id' => $row['id'], 'username' => $row['username']);
            }
        }
        $term = trim(strip_tags($_GET ['term']));
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
     * @return void
     */
    public function view_private_msg($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($msg_id)) {
            $display_msg['display_msg'] = $this->Doctor_model->display_msg_model($msg_id);
            $this->db->where('pmto_message', $msg_id);
            $this->db->update('privmsgs_to', array('pmto_read' => 1));
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/message_center/message_view', $display_msg);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Insert Private Message Function
     *
     * @return void
     */
    public function insert_pm_by_doctor()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
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
        $doctor_id = $this->ion_auth->user()->row()->id;
        $pm_data = array(
            'privmsg_subject' => $this->input->post('msg_subject'),
            'privmsg_body' => $this->input->post('msg_description'),
            'privmsg_author' => $doctor_id
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
            $doctor_email = $this->ion_auth->user($doctor_id)->row()->email;
            $subject = $this->input->post('msg_subject');
            $fname = $this->ion_auth->user($doctor_id)->row()->first_name;
            $lname = $this->ion_auth->user($doctor_id)->row()->last_name;
            $message = '';
            $message .= '<p>You have been received an inbox message from : ' . $fname . ' ' . $lname . '</p>';
            $message .= '<p>Please Login and go to message center from dashboard to view your message.</p>';
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($doctor_email, 'Uralensis Message Notification');
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
     * Admin Sent Trash
     *
     * @return void
     */
    public function msg_trashinbox_doctor()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
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
     * Admin Sent Trash
     *
     * @return void
     */
    public function msg_trashsent_doctor()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
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
     * Admin Delete Item
     *
     * @return void
     */
    public function delete_trash_doctor()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
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
            $json['message'] = 'Please Add Special Notes.';
            echo json_encode($json);
            die;
        } else {
            $notes_data = array(
                'special_notes' => $this->input->post('special_notes'),
                'special_notes_date' => date('M j Y g:i A'));
            $this->db->where('uralensis_request_id', $this->input->post('record_id'));
            $this->db->update('request', $notes_data);
            $json['type'] = 'success';
            $json['message'] = 'Special Notes Suuccessfully Added.';
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
            $json['message'] = 'There is Already No Special Notes to be Deleted.';
            echo json_encode($json);
            die;
        } else {
            $notes_data = array(
                'special_notes' => '',
                'special_notes_date' => '');
            $this->db->where('uralensis_request_id', $this->input->post('record_id'));
            $this->db->update('request', $notes_data);
            $json['type'] = 'success';
            $json['message'] = 'Sepcial Notes Successfully Removed.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Assign Record To Another Doctor
     *
     * @return void
     */
    public function assign_doctor()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !$_POST['assign_doctor'] == 0) {
            $record_id = $_POST['record_id'];
            $doctor_id = $_POST['assign_doctor'];
            $request_assign = array(
                'request_id' => $record_id,
                'user_id' => $doctor_id
            );
            $this->db->where('request_id', $record_id);
            $this->db->update('request_assignee', $request_assign);
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert bg-success">Doctor Assigned to this record successfully. Please wait while page refresh.</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert bg-danger">Kindly Select the doctor First!</div>';
            echo json_encode($json);
            die;
        }
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
        $json = array();
        if (isset($_POST['mdt_dates_radio']) && $_POST['mdt_dates_radio'] === 'for_mdt') {
            $record_id = $_POST['record_id'];
            $specimen_data = '';
            $msdt_specimen_data = $this->input->post('mdt_specimen');
            $mdt_dates_array = $this->input->post('mdt_dates');
            if (empty($mdt_dates_array)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please Select MDT Date First.';
                echo json_encode($json);
                die;
            }
            if (!empty($msdt_specimen_data)) {
                $specimen_data = serialize($msdt_specimen_data);
            }
            $user_id = $this->ion_auth->user()->row()->id;
            $data = array(
                'mdt_case' => '',
                'mdt_case_status' => $this->input->post('mdt_dates_radio'),
                'mdt_specimen_status' => $specimen_data,
                'mdt_case_assignee_username' => uralensisGetUsername($user_id, 'fullname')
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            $mdt_list_id = $this->input->post('choose_mdt_list');
            $this->db->where('record_id', $record_id)->delete('uralensis_mdt_records');
            if (!empty($mdt_dates_array)) {
                //Delete all records from MDT table then insert mdt dates
                $this->db->where('record_id', $record_id)->delete('uralensis_mdt_records');
                foreach ($mdt_dates_array as $key => $mdt_date) {
                    $this->db->insert('uralensis_mdt_records', array('mdt_date' => $mdt_date, 'record_id' => $record_id));
                }
            }
            //Update the doctor ID in user_requests table
            //Because this doctor ID will be used in MDT 
            //Where hospitals listed based on doctor ID
            $this->db->where('request_id', $record_id)->update('users_request', array('doctor_id' => $user_id));
            $json['type'] = 'success';
            $json['msg'] = 'MDT Date Assign Suuccessfully.!';
            echo json_encode($json);
            die;
        } else {
            $record_id = $_POST['record_id'];
            $user_id = $this->ion_auth->user()->row()->id;
            //Delete all records from MDT table then insert mdt dates
            $this->db->where('record_id', $record_id)->delete('uralensis_mdt_records');
            $data = array(
                'mdt_case' => $this->input->post('report_option'),
                'mdt_case_status' => $this->input->post('mdt_dates_radio'),
                'mdt_specimen_status' => '',
                'mdt_case_assignee_username' => uralensisGetUsername($user_id, 'fullname')
            );
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            //Update the doctor ID in user_requests table
            //Because Now MDT select as a Not for MDT
            $this->db->where('request_id', $record_id)->update('users_request', array('doctor_id' => intval(0)));
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
    public function add_mdt_message()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['mdt_message'])) {
            $record_id = $_POST['record_id'];
            $data = array(
                'mdt_case_msg' => $this->input->post('mdt_message'),
                'mdt_case_msg_timestamp' => time());
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', $data);
            $json['type'] = 'success';
            $json['msg'] = 'MDT Message Added!';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Generate Word
     *
     * @return void
     */
    public function generate_word()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date'])) {
            $hospital_id = $_GET['hospital_id'];
            $mdt_date = $_GET['mdt_date'];
            $mdt_list = !empty($_GET['mdt_list']) ? $_GET['mdt_list'] : '';
            $mdt_record['mdt_records'] = $this->Doctor_model->mdt_cases_list_model($hospital_id, $mdt_date, $mdt_list);
            $this->load->view('doctor/inc/documents/word', $mdt_record);
        }
    }

    /**
     * Generate MDT PDF
     *
     * @return void
     */
    public function generate_mdt_pdf()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date'])) {
            $hospital_id = $_GET['hospital_id'];
            $mdt_date = $_GET['mdt_date'];
            $mdt_list = !empty($_GET['mdt_list']) ? $_GET['mdt_list'] : '';
            $mdt_record['mdt_records'] = $this->Doctor_model->mdt_cases_list_model($hospital_id, $mdt_date, $mdt_list);
            $this->load->view('doctor/inc/documents/mdt_pdf', $mdt_record);
        }
    }

    /**
     * Generate MDT Word New
     *
     * @return void
     */
    public function generate_word_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date'])) {
            $hospital_id = $_GET['hospital_id'];
            $mdt_date = $_GET['mdt_date'];
            $mdt_record['mdt_records'] = $this->Doctor_model->mdt_cases_list_model_new($hospital_id, $mdt_date);
            $this->load->view('doctor/inc/documents/word', $mdt_record);
        }
    }

    /**
     * Generate MDT PDF New
     *
     * @return void
     */
    public function generate_mdt_pdf_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_GET['hospital_id']) && !empty($_GET['mdt_date'])) {
            $hospital_id = $_GET['hospital_id'];
            $mdt_date = $_GET['mdt_date'];
            $mdt_record['mdt_records'] = $this->Doctor_model->mdt_cases_list_model_new($hospital_id, $mdt_date);
            $this->load->view('doctor/inc/documents/mdt_pdf', $mdt_record);
        }
    }

    /**
     * Display Review Cases List
     *
     * @return void
     */
    public function case_review_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $data["query"] = $this->Doctor_model->doctor_review_case_model($doctor_id);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/display_review_cases', $data);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Save Flag Comments
     *
     * @return void
     */
    public function get_flag_comments($commentId,$dataSection=FALSE,$retFlag=FALSE)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($_SERVER["REQUEST_METHOD"]=="POST" OR !empty($commentId)){
            $commentHtml = getFlagCommentDetails($commentId,$_POST,$dataSection);
            if($retFlag){
                return $commentHtml;
            } else {
                $response['status'] = "success";
                $response['html'] = $commentHtml;
                echo json_encode($response);exit;
            }
        }
    }

    public function save_flag_comments()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $time_id = $this->input->post("task_comment_id");
            $user_id = $this->ion_auth->user()->row()->id;
            $description = $this->input->post("flag_comment");
            $dataSection = $this->input->post("data_section");
            $updateData['record_id'] = $time_id;
            $updateData['user_id'] = $user_id;
            $updateData['description'] = $description;
            $updateData['module_id'] = $dataSection;
//            $retRes = $this->db->where(array('id'=>$time_id))->update("user_timesheet",$updateData);
            $retRes = $this->db->insert("section_comments",$updateData);

            $getCommentDetails = $this->get_flag_comments($time_id,$dataSection,true);

            if($retRes){
                $response['status'] = "success";
                $response['message'] = "Comment Posted Successfully";
                $response['html'] = $getCommentDetails;
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add detail. Please try again.";
            }
            echo json_encode($response);exit;
        }
    }

    public function delete_comment_flg()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $time_id = $this->input->post("dataId");
            $dataRecordId = $this->input->post("dataRecordId");
            $dataSection = $this->input->post("dataSection");
            $retRes = $this->db->where(array("id"=>$time_id))->delete("section_comments");

            $getCommentDetails = $this->get_flag_comments($dataRecordId,$dataSection,true);

            if($retRes){
                $response['status'] = "success";
                $response['message'] = "Comment Posted Successfully";
                $response['html'] = $getCommentDetails;
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add detail. Please try again.";
            }
            echo json_encode($response);exit;
        }
    }

    public function likeFlagComments()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $response = saveFlagLikeData($_POST);
            echo json_encode($response);exit;
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
            $this->db->query("UPDATE request SET request.flag_status = '$flag' WHERE request.uralensis_request_id = $record_id");
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
            $flag_data = $this->Doctor_model->get_flag_commnets_record($user_id, $record_id);
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
     * Populate microdescription data
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
            $micro_data = $this->Doctor_model->populate_micro_records_model($micro_code);
            if (!empty($micro_data)) {
                echo json_encode($micro_data[0]);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Record Found';
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No Record Found';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add record to authorization Queue
     *
     * @return void
     */
    public function add_record_to_authorization()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $json = array();
        if (!empty($_POST['record_id'])) {
            $record_id = $_POST ['record_id'];
            $this->db->where('uralensis_request_id', $record_id);
            $this->db->update('request', array('authorize_status' => 'true', 'request_code_status' => 'add_to_authorize'));
            $json['type'] = 'success';
            $json['msg'] = 'Record successfully added to authorization queue. Redirecting...';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Display Authorization Queue Records
     *
     * @return void
     */
    public function authorization_queue()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $auth_queue['auth_queue'] = $this->Doctor_model->display_auth_queue_record_model($doctor_id);
        //echo last_query();
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/authorization_queue_records', $auth_queue);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Publish Authorization Reports Bulk
     *
     * @return void
     */
    public function publish_bulk_reports_authrization()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $json = array();
        if (isset($_POST)) {
            $json = array();
            $auth_pass1 = $_POST['password1'];
            $auth_pass2 = $_POST['password2'];
            $auth_pass3 = $_POST['password3'];
            $auth_pass4 = $_POST['password4'];
            $user_pass = str_split($this->ion_auth->user()->row()->user_auth_pass);
            $request_id = $_POST['record_ids'];
            if ($auth_pass1 != "" && $auth_pass2 != "" && $auth_pass3 != "" && $auth_pass4 != "") {
                if ($user_pass[0] === $auth_pass1 && $user_pass[1] === $auth_pass2 && $user_pass[2] === $auth_pass3 && $user_pass[3] === $auth_pass4) {
                    $data = array(
                        'status' => 1,
                        'specimen_publish_status' => 1,
                        'publish_status' => 1,
                        'publish_datetime' => date('Y-m-d h:i A'),
                        'record_secretary_status' => 'false',
                        'authorize_status' => 'false'
                    );
                    $fw_data = array(
                        'fw_status' => 'complete'
                    );
                    $mdt_data = array(
                        'mdt_case' => 'not_to_add_to_report',
                        'mdt_case_status' => 'not_for_mdt'
                    );
                    foreach ($request_id as $record) {
                        $this->db->where('uralensis_request_id', $record);
                        $this->db->update('request', $mdt_data);
                        $this->db->where('uralensis_request_id', $record);
                        $this->db->update('request', $data);
                        $this->db->where('request_id', $record);
                        $this->db->update('further_work', $fw_data);
                    }
                    $json['type'] = 'success';
                    $json['message'] = '<div class="alert bg-success">Pin Match. Please Wait......</div>';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = '<div class="alert bg-danger">Your Pin Did Not Match!</div>';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = '<div class="alert bg-danger">Some thing wrong!</div>';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Microscopic Code Autosuggest
     *
     * @return void
     */
    public function microscopic_autosuggest()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userid = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            $sql = "SELECT * FROM uralensis_micro_codes WHERE uralensis_micro_codes.umc_code LIKE '%{$search_query}%'";
            $query = $this->db->query($sql);
            $array = array();
            foreach ($query->result() as $row) {
                $added_by = '';
                if ($row->umc_added_by === $userid) {
                    $added_by = 'micro_provisional';
                }
                $array[$row->umc_id]['umc_id'] = $row->umc_id;
                $array[$row->umc_id]['umc_code'] = $row->umc_code;
                $array[$row->umc_id]['umc_added_by'] = $added_by;
            }
            echo json_encode($array);
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
            if (($lab_number != 'U' && strlen($lab_number) == 1) && ($lab_number != 'S' && strlen($lab_number) == 1) &&
                ($lab_number != 'H' && strlen($lab_number) == 1)
            ) {
                $json['type'] = 'error';
                $json['msg'] = 'The string length must be one letter and letter should be U, S, H and in capital form.';
                echo json_encode($json);
                die;
            } else if (($lab_number == 'U') || ($lab_number == 'S') ||
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
     * Opinion Cases Display
     *
     * @return void
     */
    public function doctor_opinion_cases()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }

        //echo last_query();exit;
        $opinion_cases["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
        $opinion_cases["get_specialties"] = $this->Doctor_model->get_specialties();

        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Opinion Cases', base_url('index.php/doctor/doctor_opinion_cases'));
        $opinion_cases['breadcrumbs'] = $this->mybreadcrumb->render();

        $opinion_cases['opinion_cases'] = array();
        $opinion_cases['opinion_cases_requested'] = array();
        $opinion_cases['sr_opinion_status'] = 'inbound';
        $opinion_status = 'inbound';
        $opinion_cases['opinion_cases'] = $this->Doctor_model->display_opinion_cases($doctor_id, '');
//        echo $this->db->last_query();exit;
        if ($this->input->post('sr_opinion_status')) {
            $opinion_status = $this->input->post('sr_opinion_status');
            $opinion_cases['sr_opinion_status'] = $this->input->post('sr_opinion_status');
            if ($opinion_status == 'inbound') {
                $opinion_cases['opinion_cases'] = $this->Doctor_model->display_opinion_cases($doctor_id, '');
            }
            if ($opinion_status == 'outbound') {
                $opinion_cases['opinion_cases_requested'] = $this->Doctor_model->display_opinion_cases_requested($doctor_id, '');
            }
        }
        $opinion_cases['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id);
//        echo "<pre>";print_r($opinion_cases['opinion_cases']);exit;
        $footer_data['javascripts'] = array(
            'js/custom_js/record_detail.js',
        );
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/opinion_cases/opinion_cases_new', $opinion_cases);
        $this->load->view('doctor/inc/footer-new', $footer_data);
    }

    /**
     * Opinion Cases Display
     *
     * @return void
     */
    public function doctor_opinion_requested_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if ($this->input->post()) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $opinion_id = $this->input->post('opinion_req_id');
            $opinion_details = $this->Doctor_model->opinion_request_detail($opinion_id);
            $json['type'] = 'success';
            $json['msg'] = 'Data found';
            $json['list'] = $opinion_details;
            echo json_encode($json);
            die;
            if ($opinion_details) {
                $json['type'] = 'success';
                $json['msg'] = 'Data found';
                $json['list'] = $opinion_details;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Opinion Cases Sent/Requested Display
     *
     * @return void
     */
    public function doctor_opinion_cases_requested()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $opinion_cases['sr_opinion_status'] = 'Pending';
        $opinion_status = 'Pending';
        if ($this->input->post('sr_opinion_status')) {
            $opinion_status = $this->input->post('sr_opinion_status');
            $opinion_cases['sr_opinion_status'] = $this->input->post('sr_opinion_status');
        }

        $doctor_id = $this->ion_auth->user()->row()->id;
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }

        $opinion_cases["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
        $opinion_cases["get_specialties"] = $this->Doctor_model->get_specialties();

        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Opinion Cases Requested', base_url('index.php/doctor/doctor_opinion_cases_requested'));
        $opinion_cases['breadcrumbs'] = $this->mybreadcrumb->render();

        $opinion_cases['opinion_cases'] = $this->Doctor_model->display_opinion_cases_requested($doctor_id, $opinion_status);
        $opinion_cases['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/opinion_cases/opinion_cases_requested', $opinion_cases);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Delete MDT Record Note
     *
     * @return void
     */
    public function delete_mdt_record_note()
    {
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
     * Add MDT note on report.
     *
     * @return void
     */
    public function add_mdt_record_note_on_report()
    {
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
     * Assign Opinion Cases
     *
     * @return void
     */
    public function assign_opinion_cases()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
//        echo "<pre>";print_r($_POST['opinion_case_doctors']);exit;
        $json = array();
        $sender_id = $this->ion_auth->user()->row()->id;
        if (empty($_POST['opinion_case_doctors'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Please choose the doctor first';
            echo json_encode($json);
            die;
        }
        if ($_POST['opinion_comment'] === '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please add the opinion description.';
            echo json_encode($json);
            die;
        }
        if ($_POST['opinion_last_date'] === '') {
            $json['type'] = 'error';
            $json['msg'] = 'Please select opinion last date.';
            echo json_encode($json);
            die;
        }

        $record_id = $this->input->post("record_id");
        if ($this->input->post("opinion_all_slides")) {
            $allSlides = $this->Doctor_model->get_case_slides_data($record_id);
            $countSlide = 0;
            foreach ($allSlides as $allSlide) {
                if (!empty($allSlide['slides'])) {
                    $slide_data[$countSlide]['specimen_id'] = $allSlide['specimen_id'];
                    foreach ($allSlide['slides'] as $innSlides) {
                        $slide_data[$countSlide]['slides'][] = $innSlides['url'];
                    }
                    $countSlide++;
                }

            }
        } else {
            $specIds = $this->input->post("email_specimen_ids");
            $countSlide = 0;
            foreach ($specIds as $index => $valueId) {
                if ($this->input->post("email_request_specimen_" . $valueId)) {
                    $slide_data[$countSlide]['specimen_id'] = $valueId;
                    $innerSlides = $this->input->post("email_request_specimen_" . $valueId);
                    foreach ($innerSlides as $inIndex => $inValue) {
                        $slide_data[$countSlide]['slides'][] = $inValue;
                    }
                    $countSlide++;
                }
            }
        }

        $opinion_data_array = array(
            'ura_opinion_doctor_id' => $sender_id,
            'ura_opinion_req_id' => !empty($_POST['record_id']) ? $this->input->post('record_id') : '',
            'ura_opinion_parent_id' => '0',
            'ura_opinion_date' => !empty($_POST['opinion_date']) ? strtotime($this->input->post('opinion_date')) : '',
            'ura_opinion_slides' => !empty($slide_data) ? json_encode($slide_data) : NULL,
            'ura_opinion_last_date' => !empty($_POST['opinion_last_date']) ? date('Y-m-d', strtotime($this->input->post('opinion_last_date'))) : '',
            'ura_opinion_comments' => !empty($_POST['opinion_comment']) ? $this->input->post('opinion_comment') : '',
            'ura_opinion_timestamp' => time()
        );
        $this->db->insert('uralensis_opinions', $opinion_data_array);
        $opinion_id = $this->db->insert_id();
        if (!empty($_POST['opinion_case_doctors'])) {
//            $opinion_recp_data = array(
//                'recipient_id' => $_POST['opinion_case_doctors'],
//                'ura_opinion_id' => !empty($opinion_id) ? $opinion_id : '',);
//            $this->db->insert('uralensis_opinion_recipient', $opinion_recp_data);
//            $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($sender_id);
//            $first_name = $decryptedDetails->first_name;
//            $last_name = $decryptedDetails->last_name;
//            $notification_data = array(
//                'user_id' => $_POST['opinion_case_doctors'],
//                'notification' => "You have received an opinion request from <br>$first_name $last_name</br>",
//                'startdate' => date('Y-m-d'),
//                'redirect_url' => 'doctor/doctor_opinion_cases'
//            );
//            addNotification($notification_data);
            foreach ($_POST['opinion_case_doctors'] as $key => $value) {
                $opinion_recp_data = array(
                    'recipient_id' => $value,
                    'ura_opinion_id' => !empty($opinion_id) ? $opinion_id : '',);
                $this->db->insert('uralensis_opinion_recipient', $opinion_recp_data);
                $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($sender_id);
                $first_name = $decryptedDetails->first_name;
                $last_name = $decryptedDetails->last_name;
                $notification_data = array(
                    'user_id' => $value,
                    'notification' => "You have received an opinion request from <br>$first_name $last_name</br>",
                    'startdate' => date('Y-m-d'),
                    'redirect_url' => 'doctor/doctor_opinion_cases'
                );
                addNotification($notification_data);

                if ($this->input->post("internal_opnion_request") == "external") {
                    $sendData = $_POST;
                    $sendData['slides_data'] = $slide_data;
                    $decryptedDetailsd = $this->Userextramodel->getUserDecryptedDetailsByid($value);
                    $df_name = $decryptedDetailsd->first_name;
                    $dl_name = $decryptedDetailsd->last_name;
                    $demail = $decryptedDetailsd->email;
                    $sendData['rec_name'] = $df_name . " " . $dl_name;
                    $emailSubject = $sendData['request_hospital_name'] . " and " . $sendData['request_lab_no'];
                    $message = $this->load->view("doctor/email/request_email", $sendData, TRUE);
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
                    $this->email->to($demail); // change it to yours
                    $this->email->bcc("shariq.libra@gmail.com"); // change it to yours
                    $this->email->subject('External Pathology Opinion. ' + $emailSubject);
                    $this->email->message($message);
                    $this->email->send();

                }

            }
        }
        $json['type'] = 'success';
        $json['msg'] = 'Opinion  Requested Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Opinion Record Detail
     *
     * @param int $id
     * @return void
     */
    public function opinion_record_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->opinion_record_detail_model($id);
            $specimen_data['specimen_query'] = $this->Doctor_model->opinion_record_detail_specimen($id);
            $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = $data['request_query'][0]->nhs_number;
            $related_posts ['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_cpc_cases_model();
            $hospital_group_id = $data['request_query'][0]->hospital_group_id;
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->list_doctors();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $opinion_data ['opinion_data'] = $this->Doctor_model->get_opinion_comments($id, $doctor_id);
            $opinion_data_reply['opinion_data_reply'] = $this->Doctor_model->get_opinion_comments_reply($id, $doctor_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id);
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $data_and_files = array_merge(
            $data,
            $specimen_data,
            $files_data,
            $supplement_data,
            $related_posts,
            $edu_cats,
            $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $opinion_data,
            $opinion_data_reply,
            $datasets_data,
            $record_history,
            $mdt_list,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by,
            $unpublish_list,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates
        );
        require_once('application/views/doctor/comment_section.php');
        require_once('application/views/doctor/manage_supplementary.php');
        require_once('application/views/doctor/manage_documents.php');
        require_once('application/views/doctor/related_posts.php');
        require_once('application/views/doctor/get_specimens.php');
        require_once('application/views/doctor/special_notes.php');
        require_once('application/views/doctor/opinion_cases/get_opinion_cases.php');
        require_once('application/views/doctor/inc/functions.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions.php');
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/record_detail', $data_and_files);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Opinion Record Detail New
     *
     * @param int $id
     * @return void
     */
    public function opinion_record_detail_new($id, $view = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($id) && !empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->opinion_record_detail_model($id);
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
//                     Check if doctor is assigned request
                    if (!$this->Doctor_model->is_opinion_assigned_doctor($doctor_id, $id)) {
                        return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                    return redirect('/', 'refresh');
            }
            $req_from_to_data['request_from_to_list'] = $this->Institute_model->get_request_from_to_list();
            $reporting_doctors['reporting_doctors'] = $this->Doctor_model->get_reporting_doctors_by_request($id);
            $specimen_data['specimen_query'] = $this->Doctor_model->opinion_record_detail_specimen($id);
            $slide_data['slide_data'] = $this->Doctor_model->get_case_slides_data($id);
            $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
            $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_education_cases_model_updated();
            $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->list_doctors();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $opinion_data ['opinion_data'] = $this->Doctor_model->get_opinion_comments($id, $doctor_id);
            $opinion_data_reply['opinion_data_reply'] = $this->Doctor_model->get_opinion_comments_reply($id, $doctor_id);
            $unpublish_records = array();
            if ($view == 'postmortem') {
                $filter = " AND request.speciality_group_id='2' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            } else {
                $filter = " AND request.speciality_group_id='1' ";
                $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id, $filter);
            }
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $cv_appr_data = array(
            'gmc_no' => $this->getUserMetaData($doctor_id, 'gmc_no'),
            'last_appraisal' => $this->getUserMetaData($doctor_id, 'last_appraisal'),
            'next_appraisal' => $this->getUserMetaData($doctor_id, 'next_appraisal'),
            'cpd_last' => $this->getUserMetaData($doctor_id, 'cpd_last'),
            'cpd_next' => $this->getUserMetaData($doctor_id, 'cpd_next'),
            'revalidation' => $this->getUserMetaData($doctor_id, 'revalidation'),
            'cv_doc_file_name' => $this->getUserMetaData($doctor_id, 'cv_doc_file_name'),
            'trainee_name' => $this->getUserMetaData($doctor_id, 'trainee_name'),
            'trainee_period_start' => $this->getUserMetaData($doctor_id, 'trainee_period_start'),
            'trainee_period_end' => $this->getUserMetaData($doctor_id, 'trainee_period_end'),
        );
        $data['cv_appr_data'] = $cv_appr_data;

        $data_and_files = array_merge(
            $data,
            $breadcrumb,
            $unpublish_list,
            $specimen_data,
            $slide_data,
            $files_data,
            $supplement_data,
            $related_posts,
            $edu_cats, $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $opinion_data,
            $opinion_data_reply,
            $mdt_list,
            $datasets_data,
            $record_history,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates,
            $download_history,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by,
            $req_from_to_data,
            $reporting_doctors
        );

        require_once('application/views/doctor/comment_section_old.php');
        require_once('application/views/doctor/manage_supplementary_old.php');
        require_once('application/views/doctor/manage_documents_old.php');
        require_once('application/views/doctor/related_posts_old.php');
        require_once('application/views/doctor/get_specimens_old.php');
        require_once('application/views/doctor/special_notes_old.php');
        require_once('application/views/doctor/opinion_cases/get_opinion_cases.php');
        require_once('application/views/doctor/inc/functions_old.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions_old.php');
        if ($view == 'view') {
            $this->load->view('doctor/inc/header-new');
            $search_query = explode("_", $this->input->get('slide'));
            if ($search_query != null) {
                $specimenId = intval($search_query[0]);
                $queryId = intval($search_query[1]);
                foreach ($slide_data['slide_data'] as $specimen_slide) {
                    if ($specimen_slide['specimen_id'] == $specimenId) {
                        $data_and_files['slide_url'] = $specimen_slide['slides'][$queryId]['url'];
                        $data_and_files['slide_specimen_id'] = $specimenId;
                        break;
                    }
                }
            }
            $this->load->view('doctor/record_detail_view', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } elseif ($view == 'postmortem') {
            $this->load->view('templates/header-new');
            $this->load->view('doctor/autopsy_edit_record', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } else {
            ;
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/record_detail_old', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Update Opinion Record Status Accept/Reject
     *
     * @return void
     */
    public function update_opinion_status()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($this->input->post('opinion_id')) {
            $opinion_id = $this->input->post('opinion_id');
            $recipient_id = $this->input->post('recipient_id');
            if (!empty($opinion_id)) {
                $opinion_status = $this->input->post('opinion_status');
                $opinion_update = $this->Doctor_model->update_opinion_status($opinion_id, $recipient_id, $opinion_status);
                if ($opinion_update) {
                    $this->session->set_flashdata('record_status', 'Opinion status updated successfully');
                    redirect('doctor/doctor_opinion_cases');
                } else {
                    $this->session->set_flashdata('record_status', 'Something went wrong');
                    redirect('doctor/doctor_opinion_cases');
                }
            } else {
                $this->session->set_flashdata('record_status', 'Something went wrong');
                redirect('doctor/doctor_opinion_cases');
            }
        } else {
            $this->session->set_flashdata('record_status', 'Something went wrong');
            redirect('doctor/doctor_opinion_cases');
        }
    }

    /**
     * Reject Opinion Request
     *
     * @return void
     */
    public function reject_opinion_request()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($this->input->post('ad_opinion_id')) {
            $opinion_id = $this->input->post('ad_opinion_id');
            if (!empty($opinion_id)) {
                $opinion_status = "Declined";
                $reject_reason = "";
                if ($this->input->post('reject_reason_opt') == 'other') {
                    $reject_reason = $this->input->post('rej_other_reason');
                } else {
                    if ($this->input->post('reject_reason_opt') == 'not_my_specialty') {
                        $reject_reason = "This is not my specialty";
                    }
                    if ($this->input->post('reject_reason_opt') == 'other_commitments') {
                        $reject_reason = "I have other commitments";
                    }
                }
                $update_data = array(
                    "ura_rec_opinion_status" => $opinion_status,
                    "ura_rec_opinion_rej_reason" => $reject_reason
                );
                $opinion_update = $this->Doctor_model->reject_opinion_request($opinion_id, $update_data);
//                echo $this->db->last_query();exit;
                if ($opinion_update) {
                    $this->session->set_flashdata('record_status', 'Opinion status updated successfully');
                    redirect('doctor/doctor_opinion_cases');
                } else {
                    $this->session->set_flashdata('record_status', 'Something went wrong');
                    redirect('doctor/doctor_opinion_cases');
                }
            } else {
                $this->session->set_flashdata('record_status', 'Something went wrong');
                redirect('doctor/doctor_opinion_cases');
            }
        } else {
            $this->session->set_flashdata('record_status', 'Something went wrong');
            redirect('doctor/doctor_opinion_cases');
        }
    }

    /**
     * Display Docotor Invoices Section
     *
     * @return void
     */
    public function display_invoices()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $invoice_data['invoices_data'] = $this->Doctor_model->display_invoices_model($doctor_id);
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/invoices/display_invoices', $invoice_data);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Save Opinion Reply
     *
     * @return void
     */
    public function save_opinion_reply()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (!empty($_POST)) {
            $is_edit_status = $this->input->post('is_edit_status');
            $is_opinion_id = $this->input->post('is_opinion_id');
            $reply_desc = $this->input->post('opinion_reply');
            $reply_date = $this->input->post('opinion_reply_date');
            $record_id = $this->input->post('record_id');
            $ura_opinion_id = $this->input->post('ura_opinion_id');
            $opinion_doctor = $this->input->post('opinion_doctor_id');
            if (empty($reply_desc)) {
                $json['type'] = 'error';
                $json['msg'] = 'Please add the description first.';
                echo json_encode($json);
                die;
            }
            if ($is_edit_status == 1) {
                $reply_data = array(
                    'ura_opinion_date' => strtotime($reply_date),
                    'ura_opinion_comments' => $reply_desc,
                    'ura_opinion_timestamp' => time()
                );
                $this->db->where('ura_opinion_id', $is_opinion_id);
                $this->db->update('uralensis_opinions', $reply_data);
                $json['msg'] = 'Record updated';

            } else {
                $reply_data = array(
                    'ura_opinion_doctor_id' => $doctor_id,
                    'ura_opinion_req_id' => $record_id,
                    'ura_opinion_parent_id' => $ura_opinion_id,
                    'ura_opinion_date' => strtotime($reply_date),
                    'ura_opinion_comments' => $reply_desc,
                    'ura_opinion_timestamp' => time(),
                    'ura_opinion_status' => "Reply Sent"
                );
                $this->db->insert('uralensis_opinions', $reply_data);
                $opinion_id = $this->db->insert_id();
                $reply_data_recp = array(
                    'recipient_id' => $opinion_doctor,
                    'ura_opinion_id' => $opinion_id,
                    'ura_rec_opinion_status' => "Reply Sent"
                );
                $this->db->insert('uralensis_opinion_recipient', $reply_data_recp);

                $upd_data = array(
                    'ura_rec_opinion_status' => "Reply Sent"
                );
                $this->db->where('ura_opinion_id', $ura_opinion_id);
                $this->db->update('uralensis_opinion_recipient', $upd_data);
                $json['msg'] = 'Reply Submitted';

            }

            $json['type'] = 'success';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Wrong';
            echo json_encode($json);
            die;
        }
    }

    public function delete_opinion_reply()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $is_opinion_id = $this->input->post('dataId');


        $checkStatus = $this->db->where('ura_opinion_id', $is_opinion_id)->delete('uralensis_opinions');
        $this->db->where('ura_opinion_id', $is_opinion_id)->delete('uralensis_opinion_recipient');
        if ($checkStatus) {
            $json['type'] = 'success';
            $json['msg'] = 'Record deleted';
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Wrong';
        }
        echo json_encode($json);
        die;
    }

    public function save_opinion_comment_like()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $doctor_id = $this->ion_auth->user()->row()->id;
        $is_opinion_id = $this->input->post('dataId');
        $dataArray['recipient_id'] = $doctor_id;
        $dataArray['ura_opinion_id'] = $is_opinion_id;
        $recordExist = $this->db->select("*")->where($dataArray)->get("opinion_comment_likes")->row();
        if (empty($recordExist)) {
            $this->db->insert("opinion_comment_likes", $dataArray);
        } else {
//            $this->db->update("opinion_comment_likes",$dataArray);
        }

        $json['type'] = 'success';
        $json['msg'] = 'Liked';
        echo json_encode($json);
        die;
    }

    /**
     * Change input color in doctor detail page.
     *
     * @return void
     */
    public function set_input_change_color()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $record_id = $_POST['record_id'];
        $user_id = $this->ion_auth->user()->row()->id;
        $input_key = $_POST['key'];
       
	    $edit_status_query = $this->db->query("SELECT request.record_edit_status FROM request WHERE request.uralensis_request_id = $record_id")->result();
        $default_edit_status = unserialize($edit_status_query [0]->record_edit_status);
        if (!empty($default_edit_status) && array_key_exists($input_key, $default_edit_status)) {
            $default_edit_status[$input_key] = 2;
        } else {
            $default_edit_status[$input_key] = 1;
        }
        $data = array(
            'record_edit_status' => serialize($default_edit_status)
        );
        $this->db->where('uralensis_request_id', $record_id);
        $this->db->update('request', $data);
		
		
		$Rdata = array(
            'f_name' => $_POST['f_name'],
			'sur_name' => $_POST['sur_name'],
			'gender' => $_POST['gender'],
			'dob' => $_POST['dob'],
			'nhs_number' => $_POST['nhs_number']
        );
		$record_id=$_POST['patient_id'];
        $this->db->where('patient_id', $record_id);
        $this->db->update('request', $Rdata);
		
		$Pdata = array(
            'first_name' => $_POST['f_name'],
			'last_name' => $_POST['sur_name'],
			'gender' => $_POST['gender'],
			'dob' => $_POST['dob'],
			'nhs_number' => $_POST['nhs_number'],
			'address_1' => $_POST['patient_usual_address'],
			'city' => $_POST['patient_city'],
			'post_code' => $_POST['post_code'],
			'hospital_id' => $_POST['hospital_no']
        );
		$record_id=$_POST['patient_id'];
        $this->db->where('id', $record_id);
        $this->db->update('patients', $Pdata);
		
		
		
        $color_code = 'orange';
        if (!empty($default_edit_status) && $default_edit_status[$input_key] == 1) {
            $color_code = 'green';
        } else if ($default_edit_status[$input_key] == 2) {
            $color_code = 'blue';
        }
        $json['type'] = 'success';
        $json['color_code'] = $color_code;
        $json['msg'] = 'Record Updated Successfully.';
        echo json_encode($json);
        die;
    }

    /**
     * Search Lab Number Format or Mask
     *
     * @return void
     */
    public function search_lab_number_mask()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['lab_id'])) {
            $lab_id = $this->input->post('lab_id');
            $find_lab_mask = $this->db->select('lab_no_prefix')->where('group_id', $lab_id)->get('laboratory_information')->row_array();
            $lab_mask = '';
            if (!empty($find_lab_mask)) {
                $lab_mask = $find_lab_mask['lab_no_prefix'];
                if (empty($lab_mask)) {
                    $json['type'] = 'error';
                    $json['msg'] = 'Sorry add the laboratory first and set prefixes from laboratory dashboard.';
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
     * Set Microscopic Date
     *
     * @return void
     */
    public function set_microscopic_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_POST)) {
            $record_id = $this->input->post('record_id');
            $form_data = $this->input->post('form_data');
            $this->db->where('uralensis_request_id', $record_id)->update('request', array('ura_rec_temp_dataset' => serialize($form_data)));
            $json['type'] = 'success';
            $json['msg'] = 'Dataset Template Saved.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Check user record status and save in DB
     *
     * @return void
     */
    public function save_user_view_status()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
            $json['msg'] = 'Ajax Aborted!';
            echo json_encode($json);
            die;
        } else {
            $json['msg'] = 'Still Checking...';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Set Track Record Statuses
     *
     * @return void
     */
    public function set_doctor_record_history_track_status()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
     * Get User first and last name
     * @param type $user_id
     * @return string
     */
    public function get_uralensis_username($user_id)
    {
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
     * Record Tracking Module
     *
     * @return void
     */
    public function record_tracking()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $doc_permissions = $this->ion_auth->user($doctor_id)->row()->user_doc_rec_perm;
        $this->load->view('doctor/inc/header-new');
        if ($doc_permissions === 'on') {
            $hospital_users['hos_users'] = $this->Doctor_model->get_hospital_groups();
            $lab_names['lab_names'] = $this->Doctor_model->get_lab_names();
            $doc_list['doctor_list'] = $this->Doctor_model->get_doctors();
            $track_templates['track_templates'] = $this->Doctor_model->get_all_track_record_templates($doctor_id);
            $track_set_data = array_merge($hospital_users, $lab_names, $doc_list, $track_templates);
            $this->load->view('doctor/record_tracking/index', $track_set_data);
        }
        $this->load->view('doctor/inc/footer-new');
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
        $hospital_users = $this->Doctor_model->get_hospital_groups();
        $lab_names = $this->Doctor_model->get_lab_names();
        $doctor_list = $this->Doctor_model->get_doctors();
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
        $tmpl_edit_data .= '<a href="javascript:;" class="show_clinic_btn">';
        $tmpl_edit_data .= '<div class="tg-catagorytopic tg-clinic">';
        $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
        $tmpl_edit_data .= '<i class="lnr lnr-apartment"></i>';
        $tmpl_edit_data .= '<div class="tg-catagorycontent">';
        $tmpl_edit_data .= '<h3>Clinic</h3>';
        $tmpl_edit_data .= '<span class="display_selected_option"></span>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<em>+</em>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</a>';
        $tmpl_edit_data .= '<div class="show-data-holder" style="background: #1abc9c;">';
        $tmpl_edit_data .= '<div class="show_clinic">';
        $tmpl_edit_data .= '<div class="show_clinic_title">';
        $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
        $tmpl_edit_data .= '<h4><i class="lnr lnr-apartment"></i>Clinic</h4>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
        if (!empty($hospital_users)) {
            foreach ($hospital_users as $users) {
                $hospital_name = !empty($users->description) ? $users->description : '';
                $tmpl_edit_data .= '<div class="input-holder">';
                $tmpl_edit_data .= '<input class="tat hospital_user" data-hospitalname="' . $hospital_name . '" type="radio" id="hospital_' . $users->id . '" name="hospital_user" value="' . $users->id . '">';
                $tmpl_edit_data .= '<label for="hospital_' . $users->id . '">' . $hospital_name . '</label>';
                $tmpl_edit_data .= '</div>';
            }
        }
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
        $tmpl_edit_data .= '</div>';
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
        $tmpl_edit_data .= '</div>';
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
            $clinic_user_id = $this->input->post('clinic_user_id');
            $hospital_users = $this->Doctor_model->get_all_hospital_users_by_group($hospital_id);
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
            $get_lab_name = $this->db->select('description')->where('id', $labname)->get('groups')->row_array();
            $tags_data .= '<div class="tg-tagsholder">';
            $tags_data .= '<div class="tg-tagsactive"></div>';
            $tags_data .= '<ul class="tg-tagsarea template-tags-container" data-templateid="' . $templateid . '">';
            $tags_data .= '<li class="tg-clinic">';
            $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic: <em>' . $hospital_name . '</em><i>+</i></span></a>';
            $tags_data .= '</li>';
            $tags_data .= '<li class="tg-users">';
            $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic User: <em>' . ucwords($clinic_user) . '</em><i>+</i></span></a>';
            $tags_data .= '</li>';
            $tags_data .= '<li class="tg-labs">';
            $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Lab: <em>' . ucwords($get_lab_name['description']) . '</em><i>+</i></span></a>';
            $tags_data .= '</li>';
            $tags_data .= '<li class="tg-pathologist">';
            $tags_data .= '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Pathologist: <em>' . ucwords($doctor_name) . '</em><i>+</i></span></a>';
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
     * Load Track Edit Template
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
            $hospital_users = $this->Doctor_model->get_hospital_groups();
            $get_hospital_name = $this->db->select('description')->from('groups')->where('id', $hospitalid)->get()->row_array();
            $hospital_clinic_users = $this->Doctor_model->get_all_hospital_users_by_group($hospitalid);
            $lab_names = $this->Doctor_model->get_lab_names();
            $get_lab_name = $this->db->select('description')->where('id', $labid)->get('groups')->row_array();
            $doctor_list = $this->Doctor_model->get_doctors();
            $clinic_username = '';
            if (!empty($clinicuserid)) {
                $clinic_username = $this->get_uralensis_username($clinicuserid);
            }
            $tmpl_edit_data .= '<div class="tg-catagoryhead">';
            $tmpl_edit_data .= '<h3>Track Options Menu</h3>';
            $tmpl_edit_data .= '<a class="tg-btnsave update-track-template" href="javascript:;"><i class="fa fa-save"></i></a>';
            $tmpl_edit_data .= '<a class="tg-btnacollapse collapse_temp_data_btn" href="javascript:;"><i class="fa fa-angle-up"></i></a>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '<div class="collapse_temp_data">';
            $tmpl_edit_data .= '<form class="form track_temp_edit_form">';
            $tmpl_edit_data .= '<div class="tg-topic">';
            $tmpl_edit_data .= '<a href="javascript:;" class="show_clinic_btn">';
            $tmpl_edit_data .= '<div class="tg-catagorytopic tg-clinic">';
            $tmpl_edit_data .= '<span class="tg-checked fa fa-check"></span>';
            $tmpl_edit_data .= '<i class="lnr lnr-apartment"></i>';
            $tmpl_edit_data .= '<div class="tg-catagorycontent">';
            $tmpl_edit_data .= '<h3>Clinic</h3>';
            $tmpl_edit_data .= '<span class="display_selected_option">' . $get_hospital_name['description'] . '</span>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '<em>+</em>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</a>';
            $tmpl_edit_data .= '<div class="show-data-holder" style="background: #1abc9c;">';
            $tmpl_edit_data .= '<div class="show_clinic">';
            $tmpl_edit_data .= '<div class="show_clinic_title">';
            $tmpl_edit_data .= '<a href="javascript:;" class="lnr lnr-cross close_showpanel"></a>';
            $tmpl_edit_data .= '<h4><i class="lnr lnr-apartment"></i>Clinic</h4>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '<div class="input-scroll-holder ura-custom-scrollbar">';
            if (!empty($hospital_users)) {
                foreach ($hospital_users as $users) {
                    $hospital_name = !empty($users->description) ? $users->description : '';
                    $checked = '';
                    if ($hospitalid === $users->id) {
                        $checked = 'checked';
                    }
                    $tmpl_edit_data .= '<div class="input-holder">';
                    $tmpl_edit_data .= '<input ' . $checked . ' class="tat hospital_user" data-hospitalname="' . $hospital_name . '" type="radio" id="hospital_' . $users->id . '" name="hospital_user" value="' . $users->id . '">';
                    $tmpl_edit_data .= '<label for="hospital_' . $users->id . '">' . $hospital_name . '</label>';
                    $tmpl_edit_data .= '</div>';
                }
            }
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</div>';
            $tmpl_edit_data .= '</div>';
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
            $tmpl_edit_data .= '</div>';
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
     * Save Temp Data
     *
     * @return void
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
                $encode .= '<td><a target="_blank" href="' . site_url() . '/doctor/doctor_record_detail/' . $query['uralensis_request_id'] . '">' . $query['lab_number'] . '</a></td>';
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
                $count_docs_result = $this->Doctor_model->count_documents($query['uralensis_request_id'], $doctor_id);
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
                } else if ($record_old_count > 10 && $record_old_count <= 20) {
                    $badge = 'bg-warning';
                } else {
                    $badge = 'bg-danger';
                }
                $encode .= '<span class="badge ' . $badge . '">' . $record_old_count . '</span>';
                $encode .= '</a>';
                $encode .= '</td>';
                $encode .= '<td><a href="' . base_url('index.php/doctor/doctor_record_detail/' . $query['uralensis_request_id']) . '"><img src="' . base_url('assets/img/edit.png') . '"></a></td>';
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
        } else if ($_POST['search_type'] === 'add_record') {
            $encode = '';
            $encode_status = '';
            $template_id = $this->input->post('template_id');
            $status_code = $this->input->post('status_code');
            $batch_session_key = $template_id . '-' . str_replace(' ', '', strtolower($status_code));
            $batch_array = array(
                $search_term => $search_term
            );
            $batch_data = array(
                'template_id' => $template_id,
                'status_code' => $status_code,
                'session_batch_key' => $batch_session_key,
                'session_batch_data' => serialize($batch_array),
                'timestamp' => time()
            );
            $check_batch_record = $this->db->where('session_batch_key', $batch_session_key)->get('uralensis_session_record_batch')->row_array();
            $get_batch_data = unserialize($check_batch_record['session_batch_data']);
            if (empty($check_batch_record)) {
                $this->db->insert('uralensis_session_record_batch', $batch_data);
            } else if (!empty($check_batch_record) && array_key_exists($search_term, $get_batch_data)) {
                return;
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
            $check_record_vd_barcode = $this->db->where('ura_barcode_no', $search_term)->get('request')->row_array();
            if (!empty($check_record_vd_barcode['ura_barcode_no'])) {
                $check_record_status = $this->db->where('ura_rec_track_status', $status_code)->where('ura_rec_track_no', $check_record_vd_barcode['ura_barcode_no'])->get('uralensis_record_track_status')->row_array();
                if (!empty($check_record_status['ura_rec_track_status']) && $check_record_status['ura_rec_track_status'] === $status_code) {
                    $json['type'] = 'update_statuses';
                    $json['msg'] = 'Record already existed with same track status.';
                    $json['status_msg'] = 'Record found: Track Status - ' . $status_code . '.';
                    echo json_encode($json);
                    die;
                } else {
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
                    $track_status_data = array(
                        'ura_rec_track_no' => $search_term,
                        'ura_rec_track_location' => $record_track_lab,
                        'ura_rec_track_record_id' => intval($record_track_id),
                        'ura_rec_track_status' => $status_code,
                        'ura_rec_track_pathologist' => $pathologist_status,
                        'timestamp' => time()
                    );
                    $this->db->insert('uralensis_record_track_status', $track_status_data);
                    $encode_status .= '<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">' . $this->Doctor_model->get_track_template_statuses($record_track_id, 'recent')['ura_rec_track_status'] . '</a>';
                    $encode_status .= '<ul class="dropdown-menu tg-themedropdownmenu custom-list-scroll ura-custom-scrollbar" aria-labelledby="tg-adminnav">';
                    $list_statuses = $this->Doctor_model->get_track_template_statuses($record_track_id, 'all');
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
                    die;
                }
            }
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
            $this->Doctor_model->institute_insert($request);
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
            $this->db->inserdoctor_record_listt('request_specimen', $data);
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
            $query = $this->db->where('ura_barcode_no', $search_term)->get('request')->row_array();
            $doctor_id = $this->db->select('user_id')->where('request_id', $query['uralensis_request_id'])->get('request_assignee')->row_array()['user_id'];
            if (!empty($session_record_data)) {
                $check_record = array();
                foreach ($session_record_data as $ids) {
                    if (!empty($ids)) {
                        $check_record[] = $this->db->where('uralensis_request_id', $ids)->get('request')->row_array();
                        $record_data = array_filter($check_record);
                    }
                }
            }
            if (!empty($record_data)) {
                $record_ids_data = array();
                foreach ($record_data as $recordids) {
                    $record_ids_data[] = $recordids['uralensis_request_id'];
                }
            }
            $this->session->set_userdata('session_records', $record_ids_data);
            if (!empty($record_data)) {
                $encode .= '<a target="_blank" href="' . base_url('index.php/doctor/print_session_records') . '">Print Records</a>';
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
                    $encode .= '<td><a target="_blank" href="' . site_url() . '/doctor/doctor_record_detail/' . $row_data['uralensis_request_id'] . '">' . $row_data['lab_number'] . '</a></td>';
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
                    $count_docs_result = $this->Doctor_model->count_documents($row_data['uralensis_request_id'], $doctor_id);
                    $encode .= '<td>';
                    $encode .= '<a class="custom_badge_track" data-toggle="tooltip" data-placement="top" title="" href="javascript:;" data-original-title="View your record comments or add comments.">';
                    $encode .= '<img src="' . base_url('assets/img/docs-black.png') . '">&nbsp;';
                    $encode .= '<span class="badge bg-danger">' . $count_docs_result . '</span>';
                    $encode .= '</a>';
                    $encode .= '</td>';
                    $encode .= '<td>';
                    $encode .= '<a class="custom_badge_tat">';
                    $now = time();
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
                    $encode .= '<td><a href="' . base_url('index.php/doctor/doctor_record_detail/' . $row_data['uralensis_request_id']) . '"><img src="' . base_url('assets/img/edit.png') . '"></td>';
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
            } else if (!empty($get_type) && $get_type === 'all') {
                return $this->db->where('ura_rec_track_record_id', $record_id)->order_by("ura_rec_track_id", "desc")->get('uralensis_record_track_status')->result_array();
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
    public function view_session_records()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/record_tracking/view_session_records');
        $this->load->view('doctor/inc/footer-new');
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
            $session_rec_data['session_data'] = $this->Doctor_model->get_all_session_records($extract_data);
        }
        $this->load->view('doctor/record_tracking/sessions_record_pdf', $session_rec_data);
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
            $session_rec_data['session_data'] = $this->Doctor_model->get_all_session_records($session_records_ids);
        }
        $this->load->view('doctor/record_tracking/sessions_record_pdf', $session_rec_data);
    }

    /**
     * Set Color Code Session Data
     *
     * @return void
     */
    public function set_color_code_session_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($_POST)) {
            $color_code = $this->input->post('color_code');
            $this->session->unset_userdata('color_code');
            $this->session->set_userdata('color_code', $color_code);
        }
    }

    /**
     * Generate Bulk Reports
     *
     * @return void
     */
    public function generateBulkReports()
    {
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
            $this->load->view('doctor/generate_bulk_report', $records_ids);
        }
    }

    /**
     * Delete Spceimen Ajax Request
     *
     * @return void
     */
    public function delete_specimen()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['specimen_id']) && !empty($_POST['request_id'])) {
            $specimen_id = $this->input->post('specimen_id');
            $request_id = $this->input->post('request_id');
            $this->db->where('rs_request_id', $request_id)->where('rs_specimen_id', $specimen_id)->delete('request_specimen');
            $this->db->where('specimen_id', $specimen_id)->delete('specimen');
            $json['type'] = 'success';
            $json['msg'] = 'Specimen Deleted Successfully. Please Wait...';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something Went Wrong';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add Specimen
     *
     * @param int $specimen_request_id
     * @return void
     */
    public function add_specimen_doctor($specimen_request_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $specimen = array(
            'request_id' => $specimen_request_id,
            'specimen_accepted_by' => $this->input->post('specimen_accepted_by'),
            'specimen_cutup_by' => $this->input->post('specimen_cutupby'),
            'specimen_assisted_by' => $this->input->post('specimen_assisted_by'),
            'specimen_block_checked_by' => $this->input->post('specimen_block_checked_by'),
            'specimen_labelled_by' => $this->input->post('specimen_labeled_by'),
            'specimen_qc_by' => $this->input->post('specimen_qcd_by'),
            'specimen_slides' => $this->input->post('specimen_slides'),
            'specimen_block' => $this->input->post('specimen_block'),
            'specimen_snomed_p' => $this->input->post('specimen_snomed_p'),
            'specimen_snomed_t' => $this->input->post('specimen_snomed_t1'),
            'specimen_snomed_t2' => $this->input->post('specimen_snomed_t2'),
            'specimen_clinical_history' => $this->input->post('specimen_clinical_history'),
            'specimen_macroscopic_description' => $this->input->post('specimen_macroscopic_description'),
            'specimen_rcpath_code' => $this->input->post('rcpath_code')
        );
        $this->db->insert("specimen", $specimen);
        $specimen_id = $this->db->insert_id();
        $data = array('rs_request_id' => $specimen_request_id, 'rs_specimen_id' => $specimen_id);
        $this->db->insert('request_specimen', $data);
        $specimen_message = '<p class="bg-info" style="padding:7px;">Specimen Added Successfully.</p>';
        $this->session->set_flashdata('specimen_added', $specimen_message);
//        redirect('/doctor/doctor_record_detail/' . $specimen_request_id);
        redirect('/doctor/doctor_record_detail_old/' . $specimen_request_id);
    }

    /**
     * Search Record with auto suggestion
     *
     * @return void
     */
    public function search_record_detail_suggestion()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            $sql = "SELECT DISTINCT * FROM request INNER JOIN request_assignee WHERE request.uralensis_request_id = request_assignee.request_id 
            AND request_assignee.user_id = $doctor_id AND request.serial_number LIKE '%{$search_query}%'
            AND request.specimen_publish_status = 0 AND request.supplementary_review_status = 'false'
            OR request.ura_barcode_no LIKE '%{$search_query}%' OR request.patient_initial LIKE '%{$search_query}%'
            OR request.pci_number LIKE '%{$search_query}%' OR request.emis_number LIKE '%{$search_query}%'
            OR request.nhs_number LIKE '%{$search_query}%' OR request.lab_number LIKE '%{$search_query}%'
            OR request.hos_number LIKE '%{$search_query}%' OR request.sur_name LIKE '%{$search_query}%'
            OR request.f_name LIKE '%{$search_query}%' OR request.dob LIKE '%{$search_query}%'
            OR request.gender LIKE '%{$search_query}%' OR request.report_urgency LIKE '%{$search_query}%' GROUP BY request.uralensis_request_id ORDER BY request.uralensis_request_id";
            $query = $this->db->query($sql);
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->uralensis_request_id]['record_id'] = $row->uralensis_request_id;
                $array[$row->uralensis_request_id]['serial_number'] = $row->serial_number;
                $array[$row->uralensis_request_id]['f_name'] = $row->f_name;
                $array[$row->uralensis_request_id]['sur_name'] = $row->sur_name;
            }
            echo json_encode($array); //Return the JSON Array
        }
    }

    /**
     * Search Autopsy Record with auto suggestion
     *
     * @return void
     */
    public function autopsy_search_record_detail_suggestion()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            $sql = "SELECT DISTINCT * FROM request INNER JOIN request_assignee WHERE request.uralensis_request_id = request_assignee.request_id 
            AND request.speciality_group_id= '2' 
            AND (request_assignee.user_id = $doctor_id AND request.serial_number LIKE '%{$search_query}%'
            AND request.specimen_publish_status = 0 AND request.supplementary_review_status = 'false'
            OR request.ura_barcode_no LIKE '%{$search_query}%' OR request.patient_initial LIKE '%{$search_query}%'
            OR request.pci_number LIKE '%{$search_query}%' OR request.emis_number LIKE '%{$search_query}%'
            OR request.nhs_number LIKE '%{$search_query}%' OR request.lab_number LIKE '%{$search_query}%'
            OR request.hos_number LIKE '%{$search_query}%' OR request.sur_name LIKE '%{$search_query}%'
            OR request.f_name LIKE '%{$search_query}%' OR request.dob LIKE '%{$search_query}%'
            OR request.gender LIKE '%{$search_query}%' OR request.report_urgency LIKE '%{$search_query}%') GROUP BY request.uralensis_request_id ORDER BY request.uralensis_request_id";
            $query = $this->db->query($sql);
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->uralensis_request_id]['record_id'] = $row->uralensis_request_id;
                $array[$row->uralensis_request_id]['serial_number'] = $row->serial_number;
                $array[$row->uralensis_request_id]['f_name'] = $row->f_name;
                $array[$row->uralensis_request_id]['sur_name'] = $row->sur_name;
            }
            echo json_encode($array); //Return the JSON Array
        }
    }

    /**
     * Swith Back User Account To Admin
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
            $this->Ion_auth_model->identity_column = $this->config->item('identity', 'ion_auth');
            $this->Ion_auth_model->tables = $this->config->item('tables', 'ion_auth');
            $query = $this->db->select($this->Ion_auth_model->identity_column . ', username, email, id, password, active, last_login, memorable')
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
                'user_id' => $user->id,
                'old_last_login' => $user->last_login,
            );
            $this->session->set_userdata($session_data);
            $this->session->sess_regenerate(TRUE);
            redirect('/', 'refresh');
        }
    }

    /**
     * Function To Check if Data is Serialized or Not.
     *
     * @param string $data
     * @param boolean $strict
     * @return boolean
     */
    public function is_serialized($data, $strict = TRUE)
    {
        if (!is_string($data)) {
            return FALSE;
        }
        $data = trim($data);
        if ('N;' == $data) {
            return TRUE;
        }
        if (strlen($data) < 4) {
            return FALSE;
        }
        if (':' !== $data[1]) {
            return FALSE;
        }
        if ($strict) {
            $lastc = substr($data, -1);
            if (';' !== $lastc && '}' !== $lastc) {
                return FALSE;
            }
        } else {
            $semicolon = strpos($data, ';');
            $brace = strpos($data, '}');
            if (FALSE === $semicolon && FALSE === $brace)
                return FALSE;
            if (FALSE !== $semicolon && $semicolon < 3)
                return FALSE;
            if (FALSE !== $brace && $brace < 4)
                return FALSE;
        }
        $token = $data[0];
        switch ($token) {
            case 's' :
                if ($strict) {
                    if ('"' !== substr($data, -2, 1)) {
                        return FALSE;
                    }
                } else if (FALSE === strpos($data, '"')) {
                    return FALSE;
                }
            case 'a' :
            case 'O' :
                return (bool)preg_match("/^{$token}:[0-9]+:/s", $data);
            case 'b' :
            case 'i' :
            case 'd' :
                $end = $strict ? '$' : '';

                return (bool)preg_match("/^{$token}:[0-9.E-]+;$end/", $data);
        }

        return FALSE;
    }

    /**
     * Send message to laboratory
     *
     * @return void
     */
    public function sendMessageToLaboratory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (empty($_POST['msg_subject'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Message Subject Should Not Be Empty.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['msg_body'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Message Body Not Be Empty.';
            echo json_encode($json);
            die;
        }
        $recipient_id = $this->input->post('lab_user_id');
        $msg_subject = $this->input->post('msg_subject');
        $msg_body = $this->input->post('msg_body');
        $record_id = $this->input->post('record_id');
        if ($this->Pm_model->send_message($recipient_id, $msg_subject, $msg_body, TRUE, '', '', $record_id)) {
            $json['type'] = 'success';
            $json['msg'] = 'Message send successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while sending your message.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Search Receipent Users
     *
     * @return void
     */
    public function searchReceipentUsers()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($_REQUEST['query'])) {
            $search_query = $_REQUEST['query'];
            $query = $this->db->query("SELECT * FROM users WHERE users.username LIKE '%$search_query%' AND users.id != $doctor_id ORDER BY users.username");
            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->id]['user_id'] = $row->id;
                $array[$row->id]['username'] = $row->username;
                $array[$row->id]['first_name'] = $row->first_name;
                $array[$row->id]['last_name'] = $row->last_name;
            }
            echo json_encode($array);
        }
    }

    /**
     * Set Microscopic Data
     *
     * @return void
     */
    public function setMicroscopicCodeData()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (!empty($_POST) && !empty($_POST['micro_id'])) {
            $micro_id = $this->input->post('micro_id');
            $micro_desc = $this->input->post('micro_desc');
            $this->db->where('umc_id', $micro_id)->update('uralensis_micro_codes', array('umc_micro_desc' => htmlentities($micro_desc)));
            $json['type'] = 'success';
            $json['msg'] = 'Code updated successfully.';
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
     * Snomed Code View
     *
     * @return void
     */
    public function showSnomedCodes()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/snomed_codes');
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Add Snomed Codes
     *
     * @return void
     */
    public function addSnomedCodes()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userid = $this->ion_auth->user()->row()->id;
        $json = array();
        if (!empty($_POST)) {
            $snomed_type = !empty($this->input->post('snomed_type')) ? $this->input->post('snomed_type') : '';
            $snomed_title = !empty($this->input->post('snomed_code')) ? $this->input->post('snomed_code') : '';
            $snomed_desc = !empty($this->input->post('snomed_desc')) ? $this->input->post('snomed_desc') : '';
            $snomed_diagnosis = !empty($this->input->post('snomed_diagnosis')) ? $this->input->post('snomed_diagnosis') : '';
            $snomed_rc_path = !empty($this->input->post('snomed_rc_path')) ? $this->input->post('snomed_rc_path') : '';
            $snomed_unique = $snomed_title . $snomed_type;
            $current_time_stamp = time();
            if ($snomed_type == 's') {
                $sql = "INSERT INTO `uralensis_micro_codes`
                    (`umc_code`,
                    `umc_micro_desc`,
                    `umc_disgnosis`,
                    `umc_rcpath_score`,
                    `umc_added_by`,
                    `umc_status`,
                    `timestamp`)
                VALUES ('$snomed_title', '$snomed_desc', '$snomed_diagnosis', '$snomed_rc_path', '$userid', 'provisional', '$current_time_stamp')
                ON DUPLICATE KEY UPDATE `umc_code` = '$snomed_title', `umc_micro_desc` = '$snomed_desc', `umc_disgnosis` = '$snomed_diagnosis', `umc_rcpath_score` = '$snomed_rc_path', `umc_added_by` = '$userid', `umc_status` = 'provisional', `timestamp` = '$current_time_stamp'";
            } else {
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
                VALUES ('$snomed_unique', '$snomed_title', '$snomed_desc', '$snomed_type', '$snomed_diagnosis', '$snomed_rc_path', '$userid', 'provisional', '$current_time_stamp')
                ON DUPLICATE KEY UPDATE `usmdcode_unique` = '$snomed_unique', `usmdcode_code` = '$snomed_title', `usmdcode_code_desc` = '$snomed_desc', `snomed_type` = '$snomed_type', `snomed_diagnoses` = '$snomed_diagnosis', `rc_path_score` = '$snomed_rc_path', `snomed_added_by` = '$userid', `snomed_status` = 'provisional', `timestamp` = '$current_time_stamp'";
            }
            $this->db->query($sql);
            $json['type'] = 'success';
            $json['msg'] = 'Snomed Code Added Successfully.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Edit Snomed Code
     *
     * @param int $snomed_id
     * @param string $snomed_type
     * @return void
     */
    public function editSnomedCode($snomed_id, $snomed_type)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if ($snomed_type == 's') {
            $query['snomed_result'] = $this->db->get_where('uralensis_micro_codes', array('umc_id' => $snomed_id))->row_array();
        } else {
            $query['snomed_result'] = $this->db->get_where('uralensis_snomed_codes', array('usmd_code_id' => $snomed_id))->row_array();
        }
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/edit_snomed_code', $query);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Delete Snomed Code
     *
     * @param int $snomed_id
     * @param string $snomed_type
     * @return void
     */
    public function deleteSnomedCode($snomed_id, $snomed_type)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if ($snomed_type == 's') {
            $this->db->where('umc_id', $snomed_id);
            $this->db->delete('uralensis_micro_codes');
        } else {
            $this->db->where('usmd_code_id', $snomed_id);
            $this->db->delete('uralensis_snomed_codes');
        }
        $snomed_data = '<span class="bg-success" style="padding:7px;">Snomed Code Deleted Successfully.</span>';
        $this->session->set_flashdata('msg_snomed', $snomed_data);
        redirect('doctor/showSnomedCodes', 'refresh');
    }

    /**
     * Edit Snomed Code
     *
     * @return void
     */
    public function updateSnomedCode()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_POST)) {
            $snomed_id = $this->input->post('snomed_id');
            $snomed_type = $this->input->post('snomed_type');
            $snomed_diagnoses = !empty($this->input->post('snomed_code_diagnoses')) ? $this->input->post('snomed_code_diagnoses') : '';
            $rc_path_score = !empty($this->input->post('rcpath_score')) ? $this->input->post('rcpath_score') : '';
            if ($snomed_type == 's') {
                $snomed_data = array(
                    'umc_code' => $this->input->post('snomed_code'),
                    'umc_micro_desc' => $this->input->post('snomed_code_desc'),
                    'umc_disgnosis' => $snomed_diagnoses,
                    'umc_rcpath_score' => $rc_path_score
                );
                $this->db->where('umc_id', $snomed_id);
                $this->db->update('uralensis_micro_codes', $snomed_data);
            } else {
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
        }
        $snomed_data = '<span class="bg-success" style="padding:7px;">Snomed Code Updated Successfully.</span>';
        $this->session->set_flashdata('msg_snomed', $snomed_data);
        redirect('doctor/showSnomedCodes', 'refresh');
    }

    /**
     * Send snomed message to admin
     *
     * @return void
     */
    public function sendMessageSnomedToAdmin()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (empty($_POST['msg_subject'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Message Subject Should Not Be Empty.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['msg_body'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Message Body Not Be Empty.';
            echo json_encode($json);
            die;
        }
        $recipient_id = $this->input->post('admin_id');
        $msg_subject = $this->input->post('msg_subject');
        $msg_body = $this->input->post('msg_body');
        if ($this->Pm_model->send_message($recipient_id, $msg_subject, $msg_body, TRUE, '', '', '')) {
            $json['type'] = 'success';
            $json['msg'] = 'Message send successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while sending your message.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Show Microscopic Codes
     *
     * @return void
     */
    public function showMicroscopicCodes()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $micro_code['micro_codes'] = $this->Doctor_model->get_all_microscopic_codes();
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/show_microscopic_codes', $micro_code);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Send Micro message to admin
     *
     * @return void
     */
    public function sendMessageMicrocodeToAdmin()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (empty($_POST['msg_subject'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Message Subject Should Not Be Empty.';
            echo json_encode($json);
            die;
        }
        if (empty($_POST['msg_body'])) {
            $json['type'] = 'error';
            $json['msg'] = 'Message Body Not Be Empty.';
            echo json_encode($json);
            die;
        }
        $recipient_id = $this->input->post('admin_id');
        $msg_subject = $this->input->post('msg_subject');
        $msg_body = $this->input->post('msg_body');
        if ($this->Pm_model->send_message($recipient_id, $msg_subject, $msg_body, TRUE, '', '', '')) {
            $json['type'] = 'success';
            $json['msg'] = 'Message send successfully.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while sending your message.';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Add Microscopic Codes using form
     *
     * @return void
     */
    public function add_microscopic_codes()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $userid = $this->ion_auth->user()->row()->id;
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
            if (empty($_POST['micro_code']) ||
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
                $timestamp = time();
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
                    `umc_rcpath_score`,
                    `umc_added_by`,
                    `umc_status`,
                    `timestamp`)
                VALUES ('$micro_code','$micro_title','$micro_desc','$micro_diagnose','$micro_sno_t_code', '$micro_sno_t2_code', '$micro_sno_m_code','$micro_sno_p_code','$micro_classi','$micro_canc_reg','$micro_rcpath', '$userid', 'provisional', '$timestamp')
                ON DUPLICATE KEY UPDATE `umc_code` = '$micro_code', `umc_title` = '$micro_title', `umc_micro_desc` = '$micro_desc', `umc_disgnosis` = '$micro_diagnose', `umc_snomed_t_code` = '$micro_sno_t_code', `umc_snomed_t2_code` = '$micro_sno_t2_code', `umc_snomed_m_code` = '$micro_sno_m_code', `umc_snomed_p_code` = '$micro_sno_p_code', `umc_classification` = '$micro_classi', `umc_cancer_register` = '$micro_canc_reg', `umc_rcpath_score` = '$micro_rcpath', `umc_added_by` = '$userid', `umc_status` = 'provisional', `timestamp` = '$timestamp'";
                $this->db->query($sql);
                $json['type'] = 'success';
                $json['msg'] = 'Microscopic Code Added Successfully.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Edit Micro Code view
     *
     * @param int $micro_id
     * @return void
     */
    public function editMicroCode($micro_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($micro_id)) {
            $query['micro_result'] = $this->db->get_where('uralensis_micro_codes', array('umc_id' => $micro_id))->row();
        }
        $this->load->view('doctor/inc/header-new');
        $this->load->view('doctor/edit_microscopic_code', $query);
        $this->load->view('doctor/inc/footer-new');
    }

    /**
     * Edit Microscopic Code
     *
     * @return void
     */
    public function edit_microscopic_code()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST) && !empty($_POST['micro_id'])) {
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
     * Search Doctors based on hospital
     *
     * @return void
     */
    public function search_hospital_doctors()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $output = '';
        $hospital_id = $this->input->post('hospital_id');
        //Search Doctors whom report to their respective hospitals
        $doctors_list = $this->Doctor_model->find_hospital_doctors($hospital_id);
        if (!empty($doctors_list)) {
            $output .= '<span class="tg-select tg-multi-selection">';
            $output .= '<select class="multi-doctor-select" name="doctors_ids[]" multiple="multiple">';
            foreach ($doctors_list as $key => $val) {
                $output .= '<option value="' . intval($val['id']) . '">' . html_purify(uralensisGetUsername(intval($val['id']), 'fullname')) . '</option>';
            }
            $output .= '</select>';
            $output .= '</span>';
            $json['type'] = 'success';
            $json['doctors_list'] = $output;
            $json['msg'] = 'Doctors Reported to selected hospital found.';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'No doctor found reported for the selected hospital.';
            echo json_encode($json);
            die;
        }

        return $output;
    }

    /**
     * Get other doctor records
     *
     * @return void
     */
    public function search_hospital_doctors_records()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (empty($this->input->post('hospital_id'))) {
            $json['type'] = 'error';
            $json['msg'] = 'Please select the hospital first';
            echo json_encode($json);
            die;
        }
        if (empty($this->input->post('doctors_ids'))) {
            $json['type'] = 'error';
            $json['msg'] = 'Please choose at least one doctor';
            echo json_encode($json);
            die;
        }
        if ($this->input->post('selected_year') === 0) {
            $json['type'] = 'error';
            $json['msg'] = 'Somehow year did not find in request.';
            echo json_encode($json);
            die;
        }
        $json['type'] = 'success';
        $json['msg'] = '';
        echo json_encode($json);
        die;
    }

    public function search_record()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_GET['hospital_id']) && !empty($_GET['doctors_ids']) && !empty($_GET['selected_year'])) {
            $hospital_id = $this->input->get('hospital_id');
            $doctor_ids = $this->input->get('doctors_ids');
            $selected_year = $this->input->get('selected_year');
            $doctor_records['doctor_records'] = $this->Doctor_model->get_other_doctor_records($hospital_id, $doctor_ids, $selected_year);
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/search_other_doctor_records', $doctor_records);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Assign One Click MDT Record
     *
     * @return void
     */
    public function assign_one_click_mdt()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        if (!empty($_POST['record_id'])) {
            $record_id = $this->input->post('record_id');
            $hospital_id = $this->input->post('hospital_id');
            $upcoming_mdt_date = $this->Doctor_model->get_upcoming_mdt_date($hospital_id);
            if (!empty($upcoming_mdt_date)) {
                $mdt_date = $upcoming_mdt_date['ura_mdt_date'];
                //Insert MDT Record ID
                $data_array = array(
                    'mdt_date' => date('Y-m-d', strtotime($mdt_date)),
                    'record_id' => intval($record_id)
                );
                $this->db->insert('uralensis_mdt_records', $data_array);
                //Update record table
                $update_data = array(
                    'mdt_case_status' => 'for_mdt',
                    'mdt_case_assignee_username' => uralensisGetUsername($user_id, 'fullname')
                );
                $this->db->where('uralensis_request_id', $record_id)->update('request', $update_data);
                $this->db->where('request_id', $record_id)->update('users_request', array('doctor_id' => $user_id));
                $json['type'] = 'success';
                $json['msg'] = 'Up Coming MDT Assigned Successfully';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'There is no up coming mdt date found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Record Datasets
     */
    public function record_dataset($record_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($record_id)) {
            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/datasets/indexv2');
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Datasets Auto suggest
     */
    public function dataset_autosuggest()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $dataset = getDatasets();
        echo json_encode($dataset);
    }

    /**
     * Fetch Datasests Categories
     */
    public function fetchDatasetCats()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        $json = array();
        if (!empty($_POST['dataset_id'])) {
            $dataset_id = $this->input->post('dataset_id');
            $dataset_name = $this->input->post('dataset_name');
            $datasets = getDatasets();
            $get_dataset_data = getDatasetsArrayIndexData($datasets, 'datasets_id', $dataset_id);
            $cats_and_quest = array();
            if (!empty($get_dataset_data['categories'])) {
                foreach ($get_dataset_data['categories'] as $key => $val) {
                    $questions_array = $val['questions'];
                    $cats_and_quest[$key]['cat_id'] = $val['cat_id'];
                    $cats_and_quest[$key]['cat_name'] = $val['cat_name'];
                    $cats_and_quest[$key]['questions'] = $this->getDatasetsQuestions($questions_array, $val['cat_id'], $dataset_id, 'for_html');
                }
            }
            if (!empty($get_dataset_data['categories'])) {
                $json['type'] = 'success';
                $json['msg'] = 'Dataset found.';
                $json['datasets'] = $cats_and_quest;
                $json['dataset_name'] = $dataset_name;
                $json['dataset_id'] = $dataset_id;
                print_r(json_encode($json));
                die;
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'No Dataset Categories found.';
                echo json_encode($json);
                die;
            }
        }
    }

    /**
     * Get Datasets Category Questions
     */
    public function getDatasetsQuestions($questions_array = array(), $cat_id = '', $dataset_id = '', $type = 'for_html')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $ques_array = array();
        if (!empty($cat_id)) {
            if (!empty($questions_array)) {
                foreach ($questions_array as $key => $val) {
                    if (!empty($type) && $type === 'for_html') {
                        $ques_array[$key]['dataset_id'] = $dataset_id;
                        $ques_array[$key]['cat_id'] = $cat_id;
                        $ques_array[$key]['ques_id'] = $val['ques_id'];
                        $ques_array[$key]['type'] = $val['type'];
                        $ques_array[$key]['title'] = $val['title'];
                        $ques_array[$key]['required'] = $val['required'];
                        $ques_array[$key]['dependency'] = $val['dependency'];
                        if ($val['type'] === 'singlechoicev2') {
                            $ques_array[$key]['answer_data'] = $this->getAnswerDatav2($val['options'], $val['ques_id'], $cat_id, 'for_html');
                        } else {
                            $ques_array[$key]['answer_data'] = $this->getAnswerData($val['answers'], $val['ques_id'], $cat_id, 'for_html');
                        }
                        // $ques_array[$key]['db_answer_list'] = $this->getAnswerData($val['answers'], $val['ques_id'], $cat_id, 'for_pdf'));
                    } else {
                        $ques_array[$key]['ques_id'] = $val['ques_id'];
                        $ques_array[$key]['type'] = $val['type'];
                        $ques_array[$key]['title'] = $val['title'];
                        $ques_array[$key]['dependency'] = $val['dependency'];
                        if ($val['type'] === 'singlechoicev2') {
                            $ques_array[$key]['answer_data'] = $this->getAnswerDatav2($val['options'], $val['ques_id'], $cat_id, 'for_pdf');
                        } else {
                            $ques_array[$key]['answer_data'] = $this->getAnswerData($val['answers'], $val['ques_id'], $cat_id, 'for_pdf');
                        }
                    }
                }
            }

            return $ques_array;
        }
    }

    /**
     * Get Answers Data
     */
    public function getAnswerDatav2($options_data = array(), $ques_id = '', $cat_id = '', $type = 'for_html')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $ans_array = array();
        if (!empty($ques_id) && $type === 'for_html') {
            if (!empty($options_data)) {
                foreach ($options_data as $key => $val) {
                    $ans_array[$key]['title'] = $val['title'];
                    if (!empty($val['answers']) && is_array($val['answers'])) {
                        foreach ($val['answers'] as $ans_key => $ans_val) {
                            $ans_array[$key]['answers'][$ans_key]['title'] = $ans_val['title'];
                            $ans_array[$key]['answers'][$ans_key]['type'] = $ans_val['type'];
                            if (!empty($ans_val['ans_options']) && is_array($ans_val['ans_options']) && array_key_exists('ans_options', $ans_val)) {
                                $ans_array[$key]['answers'][$ans_key]['options'] = array();
                                foreach ($ans_val['ans_options'] as $ans_opt_key => $ans_opt_val) {
                                    $ans_array[$key]['answers'][$ans_key]['options'][] = $ans_opt_val;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $ans_query = $this->db->where('ques_id', $ques_id)
                ->where('dataset_cat', $cat_id)
                ->get('uralensis_record_datasets')
                ->result_array();
            if (!empty($ans_query)) {
                foreach ($ans_query as $key => $val) {
                    $ans_array[$key] = $val['dataset_ques_value'];
                }
            }
        }

        return $ans_array;
    }

    /**
     * Get Answers Data
     */
    public function getAnswerData($answers_data = array(), $ques_id = '', $cat_id = '', $type = 'for_html')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $ans_array = array();
        if (!empty($ques_id) && $type === 'for_html') {
            if (!empty($answers_data)) {
                foreach ($answers_data as $key => $val) {
                    $ans_array[$key]['answer'] = $val['title'];
                    $ans_array[$key]['ans_type'] = $val['type'];
                    if (!empty($val['depend'])) {
                        $ans_array[$key]['depend'] = $val['depend'];
                    }
                }
            }
        } else {
            $ans_query = $this->db->where('ques_id', $ques_id)
                ->where('dataset_cat', $cat_id)
                ->get('uralensis_record_datasets')
                ->result_array();
            if (!empty($ans_query)) {
                foreach ($ans_query as $key => $val) {
                    $ans_array[$key] = $val['dataset_ques_value'];
                }
            }
        }

        return $ans_array;
    }

    /**
     * Save Question Data
     */
    public function saveQuestionData()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($_POST['dataset_id']) && !empty($_POST['cat_id']) && !empty($_POST['ques_id'])) {
            $dataset_id = $this->input->post('dataset_id');
            $cat_id = $this->input->post('cat_id');
            $ques_id = $this->input->post('ques_id');
            $ques_type = $this->input->post('ques_type');
            $ques_title = $this->input->post('ques_title');
            $ques_data = $this->input->post('ques_data');
            $ques_dependent_data = $this->input->post('ques_dependent_data');
            //Check if question data already exists in table
            $this->db->where('ques_id', $ques_id)->where('dataset_cat', $cat_id)->delete('uralensis_record_datasets');
            //Insert Data into dataset table
            if (!empty($ques_data)) {
                $this->db->insert('uralensis_record_datasets', array(
                    'dataset_id' => $dataset_id,
                    'dataset_cat' => $cat_id,
                    'ques_id' => $ques_id,
                    'dataset_ques_key' => $ques_title,
                    'dataset_ques_value' => serialize($ques_data),
                    'timestamp' => time()
                ));
            }
            if (!empty($ques_dependent_data) && count($ques_dependent_data) > 0) {
                foreach ($ques_dependent_data as $depnd_key => $depend_data) {
                    $this->db->insert('uralensis_record_datasets', array(
                        'dataset_id' => $dataset_id,
                        'dataset_cat' => $cat_id,
                        'ques_id' => $depend_data['id'],
                        'dataset_ques_key' => preg_replace('/[ ,-]+/', '_', trim(strtolower($depend_data['ques']))),
                        'dataset_ques_value' => serialize($depend_data['answer']),
                        'timestamp' => time()
                    ));
                }
            }
        }
    }

    /**
     * Print PDF Dataset Data
     */
    public function printPDFDatasetData($dataset_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($dataset_id)) {
            $datasets = getDatasets();
            $get_dataset_data = getDatasetsArrayIndexData($datasets, 'datasets_id', $dataset_id);

            $dataset_name = '';
            if ($get_dataset_data) {
                $dataset_name = $get_dataset_data['datasets_name'];
            }
            unset($get_dataset_data['datasets_id']);
            unset($get_dataset_data['datasets_name']);
            $cats_and_quest = array();
            if (!empty($get_dataset_data)) {
                $cats_and_quest['dataset_name'] = $dataset_name;
                foreach ($get_dataset_data['categories'] as $key => $val) {
                    $questions_array = $val['questions'];
                    $cats_and_quest[$key]['cat_id'] = $val['cat_id'];
                    $cats_and_quest[$key]['cat_name'] = $val['cat_name'];
                    $cats_and_quest[$key]['questions'] = $this->getDatasetsQuestions($questions_array, $val['cat_id'], $dataset_id, 'for_pdf');
                }
            }
        }
        $result['dataset_data'] = $cats_and_quest;
        $this->load->view('doctor/datasets/datasets_pdf', $result);
    }

    public function support()
    {
        $title = "Support";
        $data = array('home_url' => '/doctor');
        $this->load->view('doctor/inc/header-new');
        $this->load->view('/support', $data);
        $this->load->view('doctor/inc/footer-new');
    }

    public function histo_record_edit($id, $view = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
        if (isset($id) && !empty($id)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
            $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);


            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
                    // Check if doctor is assigned request
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                    return redirect('/', 'refresh');
            }
            $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $slide_data['slide_data'] = $this->Doctor_model->get_case_slides_data($id);
            $supplement_data['supplementary_query'] = $this->Doctor_model->get_supplementary($id);
            $nhs_number = !empty($data['request_query'][0]) ? $data['request_query'][0]->nhs_number : '';
            $related_posts['related_query'] = $this->Doctor_model->related_posts_model($id, $nhs_number);
            $edu_cats['education_cats'] = $this->Doctor_model->get_education_cases_model();
            $cpc_cats['cpc_cats'] = $this->Doctor_model->get_cpc_cases_model();
            $hospital_group_id = !empty($data['request_query'][0]) ? $data['request_query'][0]->hospital_group_id : '';
            $mdt_cats['mdt_cats'] = $this->Doctor_model->get_mdt_cases_model($hospital_group_id);
            $doctors_list['list_doctors'] = $this->Doctor_model->list_doctors();
            $user_rec_edit_status['record_edit_status'] = $this->Doctor_model->get_one_user_record_edit_status($id);
            $user_rec_edit_status_full['record_edit_status_full'] = $this->Doctor_model->get_user_record_edit_status($id);
            $micro_codes['micro_codes'] = $this->Doctor_model->micro_codes_records_model();
            $mdt_list['mdt_list'] = $this->Doctor_model->display_mdt_list_model($hospital_group_id);
            $datasets_data['datasets'] = $this->Doctor_model->get_datasets_data();
            $record_history['record_history'] = $this->Doctor_model->get_record_history_data($id);
            $mdt_assign_dates['mdt_assign_dates'] = $this->Doctor_model->get_db_assign_dates($id);
            $download_history['download_history'] = $this->Doctor_model->getRecordDownloadHistory($id, $doctor_id);
            $specimen_accepted_by['specimen_accepted_by'] = $this->Doctor_model->get_specimen_data('specimen_accepted_by');
            $specimen_assisted_by['specimen_assisted_by'] = $this->Doctor_model->get_specimen_data('specimen_assisted_by');
            $specimen_block_checked_by['specimen_block_checked_by'] = $this->Doctor_model->get_specimen_data('specimen_block_checked_by');
            $specimen_cutup_by['specimen_cutup_by'] = $this->Doctor_model->get_specimen_data('specimen_cutup_by');
            $specimen_labeled_by['specimen_labeled_by'] = $this->Doctor_model->get_specimen_data('specimen_labeled_by');
            $specimen_qcd_by['specimen_qcd_by'] = $this->Doctor_model->get_specimen_data('specimen_qcd_by');
            $unpublish_records = $this->Doctor_model->doctor_record_list($doctor_id);
            $unpublish_list['unpublish_list'] = array();
            if (!empty($unpublish_records)) {
                foreach ($unpublish_records as $key => $value) {
                    $unpublish_list['unpublish_list'][$value->uralensis_request_id] = $value->serial_number;
                }
            }
            $rec_bck_frm_lab_date_data = array();
            $rec_by_doc_date_data = array();
            $check_booked_out_status = $this->db->where('ura_rec_track_record_id', $id)->where('ura_rec_track_status', 'Booked out from Lab')->get('uralensis_record_track_status')->row_array();
            $rec_by_doc_date = '';
            $booked_out_from_lab_time = '';
            if (!empty($check_booked_out_status) && $check_booked_out_status['ura_rec_track_status'] === 'Booked out from Lab') {
                $booked_out_from_lab_time = date('Y-m-d', $check_booked_out_status['timestamp']);
                if (empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_sent_touralensis' => $booked_out_from_lab_time, 'date_rec_by_doctor' => $rec_by_doc_date));
                } else if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_time));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            } else {
                if (!empty($data['request_query'][0]->date_sent_touralensis) && empty($data['request_query'][0]->date_rec_by_doctor)) {
                    $booked_out_from_lab_date = date('Y-m-d', strtotime($data['request_query'][0]->date_sent_touralensis));
                    $rec_by_doc_new_date = strtotime('+1 day', strtotime($booked_out_from_lab_date));
                    $rec_by_doc_date = date('Y-m-d', $rec_by_doc_new_date);
                    $this->db->where('uralensis_request_id', $id)->update('request', array('date_rec_by_doctor' => $rec_by_doc_date));
                }
            }
            $rec_bck_frm_lab_date_data['bck_frm_lab_date_data'] = $booked_out_from_lab_time;
            $rec_by_doc_date_data['rec_by_doc_date_data'] = $rec_by_doc_date;
            $record_id = $id;
            $user_id = $this->ion_auth->user()->row()->id;
            $record_user_data['user_record_data'] = array(
                'record_id' => $record_id,
                'user_id' => $user_id
            );
            $change_status = array('report_status' => 0);
            $this->db->where('uralensis_request_id', $id);
            $this->db->update('request', $change_status);
            $files_data["files"] = $this->Doctor_model->fetch_files_data($id);
        }
        $breadcrumb['breadcrumbs'] = $this->mybreadcrumb->render();
        $data_and_files = array_merge(
            $data,
            $breadcrumb,
            $unpublish_list,
            $specimen_data,
            $slide_data,
            $files_data,
            $supplement_data,
            $related_posts,
            $edu_cats, $cpc_cats,
            $mdt_cats,
            $doctors_list,
            $user_rec_edit_status,
            $user_rec_edit_status_full,
            $micro_codes,
            $mdt_list,
            $datasets_data,
            $record_history,
            $rec_bck_frm_lab_date_data,
            $rec_by_doc_date_data,
            $mdt_assign_dates,
            $download_history,
            $specimen_accepted_by,
            $specimen_assisted_by,
            $specimen_block_checked_by,
            $specimen_cutup_by,
            $specimen_labeled_by,
            $specimen_qcd_by
        );
        require_once('application/views/doctor/comment_section.php');
        require_once('application/views/doctor/manage_supplementary.php');
        require_once('application/views/doctor/manage_documents.php');
        require_once('application/views/doctor/related_posts.php');
        require_once('application/views/doctor/get_specimens.php');
        require_once('application/views/doctor/special_notes.php');
        require_once('application/views/doctor/inc/functions.php');
        require_once('application/views/doctor/datasets/datasets.php');
        require_once('application/views/doctor/record_history/record_history-functions.php');

        if ($view == 'view') {
            $this->load->view('doctor/inc/header-new');
            $search_query = explode("_", $this->input->get('slide'));
            if ($search_query != null) {
                $specimenId = intval($search_query[0]);
                $queryId = intval($search_query[1]);
                foreach ($slide_data['slide_data'] as $specimen_slide) {
                    if ($specimen_slide['specimen_id'] == $specimenId) {
                        $data_and_files['slide_url'] = $specimen_slide['slides'][$queryId]['url'];
                        $data_and_files['slide_specimen_id'] = $specimenId;
                        break;
                    }
                }
            }
            $this->load->view('doctor/record_detail_view', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        } else {

            $this->load->view('doctor/inc/header-new');
            $this->load->view('doctor/histo_record_edit', $data_and_files);
            $this->load->view('doctor/inc/footer-new');
        }
    }

    /**
     * Upload clinic files
     *
     * @param string $cv_filename
     * @param string $ref_key
     * @return void
     */
    public function do_upload_cv($cv_filename, $ref_key)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $config['upload_path'] = './uploads/doc_cvs';
        $config['allowed_types'] = 'pdf|png|jpg|docx|doc';
        $config['max_size'] = 20400;
        $config['overwrite'] = TRUE;
        if (!empty($ref_key)) {
            $new_name = $ref_key . '-' . $_FILES[$cv_filename]['name'];
        } else {
            $new_name = $_FILES[$cv_filename]['name'];
        }
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($cv_filename)) {
            return FALSE;
        } else {
            return TRUE;
        }
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

    public function send_request_email()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        $this->form_validation->set_rules('email_request_doctors', 'Doctor', 'required');
        $this->form_validation->set_rules('email_request_specimen', 'Specimen', 'required');
        if ($this->form_validation->run() == FALSE) {
            $json["type"] = "fail";
            $json["msg"] = validation_errors();
            echo json_encode($json);
            exit;
        } else {
            $doctor_id = $this->input->post("email_request_doctors");
            $specimen_data = explode("_", $this->input->post("email_request_specimen"));
            $specimen_id = $specimen_data[0];
            $specimen_count = $specimen_data[1];
            $clinical_history = $this->Doctor_model->select_where("*", "specimen", array("specimen_id" => $specimen_id))->row();
            $sendData = $_POST;
            $sendData['clinical_history'] = $clinical_history->specimen_clinical_history;
            $sendData['specimen_id'] = $specimen_id;
            $sendData['specimen_count'] = $specimen_count;
            echo "<pre>";
            print_r($sendData);
            exit;
            $message = $ci->load->view("doctor/email/request_email", $sendData, TRUE);
            echo "<pre>";
            print_r($clinical_history);
            exit;

            $config = Array(
                'mailtype' => 'html',
                'charset' => 'utf-8', //iso-8859-1
                'newline' => '\r\n',
                'wordwrap' => TRUE
            );

            $to_email = $this->input->post('recipients');
            $email_subject = $this->input->post('privmsg_subject');
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from('aleatha@uralensis.com'); // change it to yours, default: aleatha@uralensis.com
            $this->email->to($to_email); // change it to yours
            $this->email->subject(' Feedback to Lab: ' . $email_subject);
            $this->email->message($message);
            if ($this->email->send()) {
                $json['type'] = 'success';
                $json['msg'] = 'Feedback to lab sent successfully';
                echo json_encode($json);
                die;
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong while sending email to lab';
                echo json_encode($json);
                die;
            }
        }
        exit;


        $json = array();
        if (isset($_POST['recipients'])) {
            $user_id = $this->ion_auth->user()->row()->id;

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);
            $files = array();
            if (!empty($_FILES['files']['name'][0])) {
                $files = $_FILES['files'];
            }
            $files_paths = array();
            foreach ($files['name'] as $key => $doc_file) {
                $all_processed = 0;
                $_FILES['files']['name'] = $files['name'][$key];
                $_FILES['files']['type'] = $files['type'][$key];
                $_FILES['files']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['files']['error'] = $files['error'][$key];
                $_FILES['files']['size'] = $files['size'][$key];
                $config['file_name'] = $doc_file;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('files')) {
                    $error = array('error' => $this->upload->display_errors());
                    $json['type'] = 'error';
                    $json['msg'] = $error['error'];
                    echo json_encode($json);
                    die;
                } else {
                    $user = $this->ion_auth->user()->row()->username;
                    $doctor_id = $this->ion_auth->user()->row()->id;
                    $data = $this->upload->data();
                    $files_paths[] = base_url('uploads/' . $data['file_name']);

                    $all_processed = 1;
                }
            }
            if ($all_processed == 1) {
                $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
                $from_email = $decryptedDetails->email;
                $from_lab_email = "lab@virchow.com";
//                 Send email and attach uploaded images to email
                $message = '';
                $message .= '<table width="100%" border="1" cellpadding="3" cellspacing="3">';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>From:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $from_lab_email . '</td>';
                $message .= '</tr>';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>UL NO.|PM No.:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('privmsg_subject') . '</td>';
                $message .= '</tr>';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Feedback to Lab Description:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('privmsg_body') . '</td>';
                $message .= '</tr>';
                if (!empty($files_paths)) {
                    foreach ($files_paths as $filess) {
                        $message .= '<tr>';
                        $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Attachment:</strong></td>';
                        $message .= '<td style="padding: 6px;"> <img src="' . $filess . '" width="150" /> </td>';
                        $message .= '</tr>';
                    }
                }
                $message .= '</table>';
                /*                 * **************************
                 * Email sent to Lab as Feedback
                 * developed by Anonymous
                 *
                 */
                $config = Array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8', //iso-8859-1
                    'newline' => '\r\n',
                    'wordwrap' => TRUE
                );

                $to_email = $this->input->post('recipients');
                $email_subject = $this->input->post('privmsg_subject');
                $this->load->library('email', $config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from('aleatha@uralensis.com'); // change it to yours, default: aleatha@uralensis.com
                $this->email->to($to_email); // change it to yours
                $this->email->subject(' Feedback to Lab: ' . $email_subject);
                $this->email->message($message);
                if ($this->email->send()) {
                    $json['type'] = 'success';
                    $json['msg'] = 'Feedback to lab sent successfully';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['msg'] = 'Something went wrong while sending email to lab';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong while sending feedback to lab';
                echo json_encode($json);
                die;
            }

            $json['type'] = 'success';
            $json['msg'] = 'Feedback to lab sent successfully';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while sending feedback to lab';
            echo json_encode($json);
            die;
        }
    }

    public function autopsy_feedback_to_lab()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST['recipients'])) {
            $user_id = $this->ion_auth->user()->row()->id;

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);
            $files = array();
            if (!empty($_FILES['files']['name'][0])) {
                $files = $_FILES['files'];
            }
            $files_paths = array();
            foreach ($files['name'] as $key => $doc_file) {
                $all_processed = 0;
                $_FILES['files']['name'] = $files['name'][$key];
                $_FILES['files']['type'] = $files['type'][$key];
                $_FILES['files']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['files']['error'] = $files['error'][$key];
                $_FILES['files']['size'] = $files['size'][$key];
                $config['file_name'] = $doc_file;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('files')) {
                    $error = array('error' => $this->upload->display_errors());
                    $json['type'] = 'error';
                    $json['msg'] = $error['error'];
                    echo json_encode($json);
                    die;
                } else {
                    $user = $this->ion_auth->user()->row()->username;
                    $doctor_id = $this->ion_auth->user()->row()->id;
                    $data = $this->upload->data();
                    $files_paths[] = base_url('uploads/' . $data['file_name']);

                    $all_processed = 1;
                }
            }
            if ($all_processed == 1) {
                $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
                $from_email = $decryptedDetails->email;
                $from_lab_email = "lab@virchow.com";
//                 Send email and attach uploaded images to email
                $message = '';
                $message .= '<table width="100%" border="1" cellpadding="3" cellspacing="3">';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>From:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $from_lab_email . '</td>';
                $message .= '</tr>';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>UL NO.|PM No.:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('privmsg_subject') . '</td>';
                $message .= '</tr>';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Feedback to Lab Description:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('privmsg_body') . '</td>';
                $message .= '</tr>';
                if (!empty($files_paths)) {
                    foreach ($files_paths as $filess) {
                        $message .= '<tr>';
                        $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Attachment:</strong></td>';
                        $message .= '<td style="padding: 6px;"> <img src="' . $filess . '" width="150" /> </td>';
                        $message .= '</tr>';
                    }
                }
                $message .= '</table>';
                /*                 * **************************
                 * Email sent to Lab as Feedback
                 * developed by Anonymous
                 *
                 */
                $config = Array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8', //iso-8859-1
                    'newline' => '\r\n',
                    'wordwrap' => TRUE
                );

                $to_email = $this->input->post('recipients');
                $email_subject = $this->input->post('privmsg_subject');
                $this->load->library('email', $config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from('aleatha@uralensis.com'); // change it to yours, default: aleatha@uralensis.com
                $this->email->to($to_email); // change it to yours
                $this->email->subject(' Feedback to Lab: ' . $email_subject);
                $this->email->message($message);
                if ($this->email->send()) {
                    $json['type'] = 'success';
                    $json['msg'] = 'Feedback to lab sent successfully';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['msg'] = 'Something went wrong while sending email to lab';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong while sending feedback to lab';
                echo json_encode($json);
                die;
            }

            $json['type'] = 'success';
            $json['msg'] = 'Feedback to lab sent successfully';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while sending feedback to lab';
            echo json_encode($json);
            die;
        }
    }

    public function autopsy_feedback_to_mortuary()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        if (isset($_POST['recipients'])) {
            $user_id = $this->ion_auth->user()->row()->id;

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '9000';
            $this->load->library('upload', $config);
            $files = array();
            if (!empty($_FILES['files']['name'][0])) {
                $files = $_FILES['files'];
            }
            $files_paths = array();
            foreach ($files['name'] as $key => $doc_file) {
                $all_processed = 0;
                $_FILES['files']['name'] = $files['name'][$key];
                $_FILES['files']['type'] = $files['type'][$key];
                $_FILES['files']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['files']['error'] = $files['error'][$key];
                $_FILES['files']['size'] = $files['size'][$key];
                $config['file_name'] = $doc_file;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('files')) {
                    $error = array('error' => $this->upload->display_errors());
                    $json['type'] = 'error';
                    $json['msg'] = $error['error'];
                    echo json_encode($json);
                    die;
                } else {
                    $user = $this->ion_auth->user()->row()->username;
                    $doctor_id = $this->ion_auth->user()->row()->id;
                    $data = $this->upload->data();
                    $files_paths[] = base_url('uploads/' . $data['file_name']);
                    $all_processed = 1;
                }
            }
            if ($all_processed == 1) {
                $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($user_id);
                $from_email = $decryptedDetails->email;
//                 Send email and attach uploaded images to email
                $message = '';
                $message .= '<table width="100%" border="1" cellpadding="3" cellspacing="3">';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>From:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $from_email . '</td>';
                $message .= '</tr>';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>UL NO.|PM No.:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('privmsg_subject') . '</td>';
                $message .= '</tr>';
                $message .= '<tr>';
                $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Feedback to Mortuary Description:</strong></td>';
                $message .= '<td width="80%" style="padding: 6px;">' . $this->input->post('privmsg_body') . '</td>';
                $message .= '</tr>';
                if (!empty($files_paths)) {
                    foreach ($files_paths as $filess) {
                        $message .= '<tr>';
                        $message .= '<td width="20%" style="background: #ccc;padding: 6px;"><strong>Attachment:</strong></td>';
                        $message .= '<td style="padding: 6px;"> <img src="' . $filess . '" width="150" /> </td>';
                        $message .= '</tr>';
                    }
                }
                $message .= '</table>';
                /*                 * **************************
                 * Email sent to Mortuary as Feedback
                 * developed by Anonymous
                 *
                 */
                $config = Array(
                    'mailtype' => 'html',
                    'charset' => 'utf-8', //iso-8859-1
                    'newline' => '\r\n',
                    'wordwrap' => TRUE
                );

                $to_email = $this->input->post('recipients');
                $email_subject = $this->input->post('privmsg_subject');

                $this->load->library('email', $config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from('aleatha@uralensis.com'); // change it to yours, default: aleatha@uralensis.com
                $this->email->to($to_email); // change it to yours
                $this->email->subject(' Feedback to Mortuary: ' . $email_subject);
                $this->email->message($message);
                if ($this->email->send()) {
                    $json['type'] = 'success';
                    $json['msg'] = 'Feedback to mortuary sent successfully';
                    echo json_encode($json);
                    die;
                } else {
                    $json['type'] = 'error';
                    $json['msg'] = 'Something went wrong while sending email to mortuary';
                    echo json_encode($json);
                    die;
                }
            } else {
                $json['type'] = 'error';
                $json['msg'] = 'Something went wrong while sending feedback to mortuary';
                echo json_encode($json);
                die;
            }

            $json['type'] = 'success';
            $json['msg'] = 'Feedback to lab sent successfully';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = 'Something went wrong while sending feedback to mortuary';
            echo json_encode($json);
            die;
        }
    }

    public function update_autopsy_record($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_rules('budget_month', 'Budget Month', 'required');
        $this->form_validation->set_rules('phase_name', 'Phase Name', 'required');
        $this->form_validation->set_rules('package_name', 'Package Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['record_id'] = $record_id;
            $this->load->view('templates/header-new');
            $this->load->view('doctor/update_autopsy_record', $data);
            $this->load->view('templates/footer-new');
        } else {
            $result = false;
            if ($result) {
                $this->session->set_flashdata('success_message', 'Autopsy Record updated successfully!');
                redirect('Doctor/');
            } else {
                $this->session->set_flashdata('error_message', 'There was some problem!');
                redirect('Road_work/');
            }
        }
    }

    public function get_profile_picture_by_id()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $res = 0;
        if ($_POST['user_id']) {
            $user_id = $this->input->post('user_id');
            $res = $this->Doctor_model->get_profile_picture_path($user_id);
            $picture_path = $res['profile_pic'];
            $json['type'] = 'success';
            $json['msg'] = $picture_path;
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'success';
            $json['msg'] = $res;
            echo json_encode($json);
            die;
        }
    }

    public function get_authorized_cases_by_period()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $json = array();
        $res = 0;
        if ($_POST['doctor_id']) {
            $doctor_id = $this->input->post('doctor_id');
            $period = $this->input->post('period');
            $res = $this->Doctor_model->dr_dash_published_stats($doctor_id, $period);
            $json['type'] = 'success';
            $json['data'] = $res;
            $json['msg'] = "";
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'success';
            $json['msg'] = $res;
            echo json_encode($json);
            die;
        }
    }

    public function addSpecimenBlock()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();
        $res = 0;
        if ($_POST['specimen_id']) {
            $this->form_validation->set_rules('specimen_id', 'Specimen id', 'required|trim');
            $this->form_validation->set_rules('block_specimen_no[]', 'Specimen No', 'required|trim');
            $this->form_validation->set_rules('block_no_of_blocks[]', 'Block No', 'required|trim');
            $this->form_validation->set_rules('block_comments[]', 'Block Description', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $json["type"] = "fail";
                $json["msg"] = validation_errors();
                echo json_encode($json);
                exit;
            } else {
                $specimen_id = $this->input->post('specimen_id');

                $specimenNo = $this->input->post('block_specimen_no');
                $blockName = $this->input->post('block_no_of_blocks');
                $blockDescription = $this->input->post('block_comments');

                $totalLength = count($specimenNo);
                $createHtml = "";
                for ($i = 0; $i < $totalLength; $i++) {
                    $insData[$i]['specimen_id'] = $specimen_id;
                    $insData[$i]['specimen_no'] = $specimenNo[$i];
                    $insData[$i]['block_no'] = $blockName[$i];
                    $insData[$i]['description'] = $blockDescription[$i];

                    $createHtml .= "<tr>";
                    $createHtml .= "<td>" . $specimenNo[$i] . "</td>";
                    $createHtml .= "<td>" . $blockName[$i] . "</td>";
                    $createHtml .= "<td>" . $blockDescription[$i] . "</td>";
                    $createHtml .= "</tr>";
                }

                $res = $this->Doctor_model->add_specimen_block($insData);

//                $insData['specimen_id'] = $specimen_id;
//                $insData['name'] = $blockName;
//                $insData['description'] = $blockDescription;
//
//                $blockId = $this->db->insert_id();
//                $blockSlides['specimen_id'] = $specimen_id;
//                $blockSlides['url'] = $this->input->post('block_slides');
//                $blockSlides['thumbnail'] = $this->input->post('block_slides_thumbnail');
//                $blockSlides['block_id'] = $blockId;
//                $res = $this->Doctor_model->add_specimen_slide($blockSlides);
//
//                $createHtml = "<tr>";
//                $createHtml .= "<td>".$blockName."</td>";
//                $createHtml .= "<td>".$blockDescription."</td>";
//                $createHtml .= "</tr>";

                $json['type'] = 'success';
                $json['data'] = $createHtml;
                $json['msg'] = "Block added successfully";
                echo json_encode($json);
                die;
            }
        } else {
            $json['type'] = 'success';
            $json['msg'] = 'There is some issue. Please try again';
            echo json_encode($json);
            die;
        }
    }

    public function add_further_work($id)
    {
        $this->load->model("Laboratory_model");
		
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));
        if (isset($id) && !empty($id)) {
            $data['javascripts'] = [
                'js/further-request.js',
            ];
            $data['styles'] = [];

            $doctor_id = $this->ion_auth->user()->row()->id;
            //Get all level 1
            $data['test_categories'] = $this->Laboratory_model->get_laboratory_test_hirarchy(null, 1);
            $data['complete_records'] = [];
            if (is_array($data['test_categories']) && !empty($data['test_categories'])) {
                foreach ($data['test_categories'] as $test_category) {
                    $data['complete_records'][] = [
                        'text' => $test_category['name'],
                        'nodes' => $this->Laboratory_model->get_test_category_hirarchy_children($test_category['id'], $test_category['level']),
                        'id' => $test_category['id'],
                        'parent_id' => $test_category['id'],
                        'level' => $test_category['level'],
                        'has_level' => $test_category['has_level'],
                    ];
                }
            }

            $test_columns = ['lt.id', 'lt.name', 'lt.cost', 'lt.sale'];
            if (is_array($data['complete_records']) && !empty($data['complete_records'])) {
                foreach ($data['complete_records'] as $first_level_key => $first_level_record) {
                    if (is_null($first_level_record['has_level'])) {
                        $data['complete_records'][$first_level_key]['tests'] = $this->Laboratory_model->getCategoryTests($first_level_record['id'], $test_columns);
                    }

                    if ($first_level_record['has_level'] == 1) {
                        foreach ($first_level_record['nodes'] as $second_level_key => $second_level_record)
                            $data['complete_records'][$first_level_key]['nodes'][$second_level_key]['tests'] = $this->Laboratory_model->getCategoryTests($second_level_record['id'], $test_columns);
                    }

                    if ($first_level_record['has_level'] == 2) {
                        foreach ($first_level_record['nodes'] as $second_level_key => $second_level_record)
                            foreach ($second_level_record['nodes'] as $third_level_key => $third_level_record) {
                                $data['complete_records'][$first_level_key]['nodes'][$second_level_key]['nodes'][$third_level_key]['tests'] = $this->Laboratory_model->getCategoryTests($third_level_record['id'], $test_columns);
                            }
                    }
                }
            }


            $data['request_query'] = $this->Doctor_model->doctor_record_detail($id);
//            echo "<pre>";print_r($data['request_query']);exit;
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
//                     Check if doctor is assigned request
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            return redirect('/', 'refresh');
                        }
                    }
					case 'L':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                           // return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                    return redirect('/', 'refresh');
            }
            $req_from_to_data['request_from_to_list'] = $this->Institute_model->get_request_from_to_list();
            $reporting_doctors['reporting_doctors'] = $this->Doctor_model->get_reporting_doctors_by_request($id);
            $specimen_data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $specimen_data['specimen_blocks'] = $this->Doctor_model->specimen_block_detail($id);

            $result = array_merge($data, $req_from_to_data, $reporting_doctors, $specimen_data);
            $this->load->view('support/inc/header-new');
			
            $this->load->view('doctor/further_work_new', $result);
            $this->load->view('doctor/inc/footer-new');
        }
    }


    public function add_further_work_new($id)
    {

        $this->load->model("Laboratory_model");
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Listing', base_url('index.php/doctor/doctor_record_list'));
        $this->mybreadcrumb->add('Record Detail', base_url('index.php/doctor/doctor_record_detail'));

        if (isset($id) && !empty($id)) {
            $data['javascripts'] = [
                'js/further-request-new.js',
            ];

            $data['styles'] = [];
            $doctor_id = $this->ion_auth->user()->row()->id;
            //Get all level 1
            $data["testMainCategories"] = getMainTestCategories();
            $testSubCategoryArr = array();
            $i = 0;
            foreach ($data["testMainCategories"] as $mainCatArray => $mainCatValue) {

                $getSubCatAgainstMain = getSubTestCatAgainstMainCat($mainCatValue["id"]);
                //  print_r($getSubCatAgainstMain ); exit; 
                $testSubCategoryArr["main_cat"][$i]["main_cat_name"] = $mainCatValue["name"];
                $testSubCategoryArr["main_cat"][$i]["main_cat_id"] = $mainCatValue["id"];
                $s = 0;
                foreach ($getSubCatAgainstMain as $subValue => $subKey) {
                    //$testSubCategoryArr["main_cat"][$i][$mainCatValue["name"]]["sub_cat"][$s]["sub_cat_id"] = $subKey["id"];
                    $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["sub_cat_name"] = $subKey["name"];
                    $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["sub_cat_id"] = $subKey["id"];
                    $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["main_cat_id"] = $subKey["main_category_id"];

                    #Add tests under sub Categories
                    $t = 0;
                    $subCategoriesTests = getTestAgsinstSubCat($subKey["id"]);
                    foreach ($subCategoriesTests as $testKey => $testValue) {
                        $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["tests"][$t]["test_id"] = $testValue["id"];
                        $testSubCategoryArr["main_cat"][$i]["sub_cat"][$s]["tests"][$t]["test_name"] = $testValue["name"];
                        $t++;
                    }


                    $s++;


                }

                $i++;
            }

            $data["test_sub_categories"] = $testSubCategoryArr;

//            print_r($data["test_sub_categories"]); exit; 

            $recordId = $this->uri->segment(3);

            $data["recordDetails"] = $this->Doctor_model->getDetailsAgainstRequest($recordId);
            $data["labName"] = $this->Doctor_model->getLabNamesFromLabGroups();

            //print_r($data["recordDetails"]); exit; 


//             echo "<pre>";
//                print_r($data["labName"]);
//            exit;
//            echo "<pre>";
//            print_r($data["testMainCategories"]); exit; 


            $data['test_categories'] = $this->Laboratory_model->get_laboratory_test_hirarchy(null, 1);
            $data['complete_records'] = [];
            if (is_array($data['test_categories']) && !empty($data['test_categories'])) {
                foreach ($data['test_categories'] as $test_category) {
                    $data['complete_records'][] = [
                        'text' => $test_category['name'],
                        'nodes' => $this->Laboratory_model->get_test_category_hirarchy_children($test_category['id'], $test_category['level']),
                        'id' => $test_category['id'],
                        'parent_id' => $test_category['id'],
                        'level' => $test_category['level'],
                        'has_level' => $test_category['has_level'],
                    ];
                }
            }

            $test_columns = ['lt.id', 'lt.name', 'lt.cost', 'lt.sale'];
            if (is_array($data['complete_records']) && !empty($data['complete_records'])) {
                foreach ($data['complete_records'] as $first_level_key => $first_level_record) {
                    if (is_null($first_level_record['has_level'])) {
                        $data['complete_records'][$first_level_key]['tests'] = $this->Laboratory_model->getCategoryTests($first_level_record['id'], $test_columns);
                    }

                    if ($first_level_record['has_level'] == 1) {
                        foreach ($first_level_record['nodes'] as $second_level_key => $second_level_record)
                            $data['complete_records'][$first_level_key]['nodes'][$second_level_key]['tests'] = $this->Laboratory_model->getCategoryTests($second_level_record['id'], $test_columns);
                    }

                    if ($first_level_record['has_level'] == 2) {
                        foreach ($first_level_record['nodes'] as $second_level_key => $second_level_record)
                            foreach ($second_level_record['nodes'] as $third_level_key => $third_level_record) {
                                $data['complete_records'][$first_level_key]['nodes'][$second_level_key]['nodes'][$third_level_key]['tests'] = $this->Laboratory_model->getCategoryTests($third_level_record['id'], $test_columns);
                            }
                    }
                }
            }


            $data['request_query'] = $this->Doctor_model->doctor_record_detail($recordId);

//            echo "<pre>";
//            print_r($data['request_query'][0]); exit; 
//            echo "<pre>";print_r($data['request_query']);exit;
            $user_type = $this->Doctor_model->get_user_type($doctor_id);
            switch ($user_type) {
                case 'A':
                    break;
                case 'D':
//                     Check if doctor is assigned request
                    if (!$this->Doctor_model->is_request_assigned_doctor($doctor_id, $id)) {
                        return redirect('/', 'refresh');
                    }
                    break;
                case 'H':
                    // Check if request is of Hospital
                    $res = $this->db->query("SELECT `hospital_group_id` FROM `request` WHERE `request`.`uralensis_request_id` = $id")->result_array();
                    if (count($res) != 0) {
                        $hos_id = $res[0]['hospital_group_id'];
                        $res = $this->db->query("SELECT * FROM `users_groups` WHERE `user_id` = $doctor_id AND `group_id` = $hos_id")->result_array();
                        if (count($res) == 0) {
                            return redirect('/', 'refresh');
                        }
                    }
                    break;
                default:
                    return redirect('/', 'refresh');
            }
            //  $specimen_data = array();
            $req_from_to_data['request_from_to_list'] = $this->Institute_model->get_request_from_to_list();
            $reporting_doctors['reporting_doctors'] = $this->Doctor_model->get_reporting_doctors_by_request($id);
            $data['specimen_query'] = $this->Doctor_model->doctor_record_detail_specimen($id);
            $data['specimen_blocks'] = $this->Doctor_model->specimen_block_detail($id);
//            echo "<pre>";
//            print_r($specimen_data['specimen_query'] ); exit; 
            $result = array_merge($data, $req_from_to_data, $reporting_doctors);
//            echo "<Pre>";
//            print_r($specimen_data['specimen_blocks']); 
//            exit; 
            $this->load->view('templates/header-new');
            $this->load->view('doctor/further_work_new', $data);
            $this->load->view('templates/footer-new');
        }
    }


    public function save_further_request()
    {
        $work = array(
            'furtherword_description' => $this->input->post('request_reason'),
            'furtherwork_date' => date("Y-m-d h:i:s A"),
            'furtherwork_status' => 1,
            'request_id' => $this->input->post('request_id'),
            'num_of_levels' => $this->input->post('num_of_levels'),
            'last_pre_levels' => $this->input->post('last_pre_levels'),
            'levels' => $this->input->post('levels'),
            'request_comment' => $this->input->post('request_comment'),
            'doctor_id' => $this->ion_auth->user()->row()->id,
            'fw_status' => 'requested',
            'group_id' => $this->input->post('group_id')
        );
        $this->Doctor_model->further_work($work);
        $insert_id = $this->db->insert_id();

        $testIds = $this->input->post('test_id');
        $blockIds = $this->input->post('specimen_id');

        $arrayCount = count($this->input->post('test_id'));
        for ($i = 0; $i < $arrayCount; $i++) {
            $further_work_detail[$i]['further_work_id'] = $insert_id;
            $further_work_detail[$i]['block_id'] = $blockIds[$i];
            $further_work_detail[$i]['test_id'] = $testIds[$i];
        }
        $this->Doctor_model->add_further_work_detail($further_work_detail);
        $response['status'] = "success";
        $response['message'] = "Data saved successfully";
        $response['redirectId'] = $this->input->post('request_id');
        echo json_encode($response);
        exit;
    }

    public function allLoginUsers()
    {
        $data['usersLogins'] = $this->Doctor_model->getUsersLogins(TRUE);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $explodeDate = explode(" - ", $this->input->post("start_end_date"));
            $data['usersLogins'] = $this->Doctor_model->getUsersLogins(TRUE, $explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "doctor/";


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

    public function getLoginDetail($id = FALSE)
    {
        $explodeId = explode("___", base64_decode($id));
        $data['usersLogins'] = $this->Doctor_model->getLoginDetail($explodeId);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $explodeDate = explode(" - ", $this->input->post("start_end_date"));
            $data['usersLogins'] = $this->Doctor_model->getLoginDetail($explodeId, $explodeDate);
            $data['date_filtered'] = $this->input->post("start_end_date");
        }
        $data['route'] = "doctor/";

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

    public function showUserActivity($id = FALSE)
    {
        $explodeId = base64_decode($id);
        $data['usersLogins'] = getUserTrackActivity($explodeId);
        $data['route'] = "doctor/";
        $this->load->view('templates/header-new', $data);
        $this->load->view('institute/login_user_activities', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function view()
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
        foreach ($checkhospital as $rec) {
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
        $result = array_merge($data, $hospitals, $breadcrumb, $hospitallist, $specialties, $specialty_grp);
        $result['pathologists'] = $this->Institute_model->get_pathologists();

        $this->load->view('templates/header-new');
        $this->load->view('doctor/doctor_view', $result);
        $this->load->view('templates/footer-new');
    }


    public function getLabTestsAgainstSubCategory()
    {
        $subCatId = $this->input->post('subCatId');
        //    echo $subCatId; exit; 
        $getTestAgsinstSubCat = getTestAgsinstSubCat($subCatId);
        //   print_r($getTestAgsinstSubCat); exit; 

        $html = "";

        $html .= '<table class="table table-striped custom-table mb-0 show_text">
                <thead>
                    <tr>
                        
                        <th>#</th>
                        <th>Test Name</th>
                        <th>Price Code</th>
                    </tr>
                </thead>';
        if (count($getTestAgsinstSubCat) > 0) {
            $cnt = 0;
            foreach ($getTestAgsinstSubCat as $resKey => $resValue) {
                $cnt++;


                $html .= '<tr>
                        
                            <td><a href="javascript:;" onClick="getLabTestDetails(' . $resValue["id"] . ')">' . $cnt . '</a></td>
                            <td><a href="javascript:;" onClick="getLabTestDetails(' . $resValue["id"] . ')">' . $resValue["name"] . '</a></td>
                            <td><a href="javascript:;" onClick="getLabTestDetails(' . $resValue["id"] . ')">' . $resValue["name"] . rand() . '</a></td>
                       
                       
                       
                        
                    </tr> ';
            }
        } else {
            $html .= '<tr>
                        <td colspan="3">No Test Found</td>
                    </tr>';
        }

        $html .= '</tbody> </table>';

        echo $html;
    }


    /**
     * Opinion Cases Display
     *
     * @return void
     */
    public function datasets_cases()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }

        //echo last_query();exit;
        $datasets_cases["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
        $datasets_cases["get_specialties"] = $this->Doctor_model->get_specialties();

        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Dataset Cases', base_url('index.php/doctor/datasets_cases'));
        $datasets_cases['breadcrumbs'] = $this->mybreadcrumb->render();

        $datasets_cases['datasets_cases'] = array();
        $datasets_cases['sr_dataset_type'] = '';
        $opinion_status = 'inbound';
        $datasets_cases['datasets_cases'] = $this->Doctor_model->display_dataset_cases('');
        $datasets_cases['datasets_case_types'] = $this->Doctor_model->get_dataset_types();
//        echo $this->db->last_query();exit;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_dataset_type = $this->input->post('sr_dataset_type');
            $reportranget = explode(" - ", $this->input->post('reportranget'));
            $start_date = date("Y-m-d", strtotime($reportranget[0]));
            $end_date = date("Y-m-d", strtotime($reportranget[1] . ' +1 day'));
            $yms = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
            );
            foreach ($period as $key => $value) {
                //$value->format('Y-m-d')
                $datasets_cases['dates_data'][] = $value->format('Y-m-d');
                $yms[$value->format('Y-m-d')] = $value->format('Y-m-d');
            }

//            if($post_dataset_type=="all"){
            $datset_types = $datasets_cases['datasets_case_types'];
            $dataCategories = array();
            $counter = 0;
            foreach ($post_dataset_type as $data => $dataValue) {
                $getDataCode = $this->db->select("dataset_code")->where("dataset_id = $dataValue")->get("tbl_datasets")->row()->dataset_code;
                $dataCategories[] = $getDataCode;
                $datasets_cases1 = $this->Doctor_model->display_dataset_cases_chart($dataValue, $reportranget);

                $data_sorted = array();
                foreach ($yms as $key => $value) {
                    $found_obj = 0;
                    $count = 0;
                    $yr_mon = $value;
                    foreach ($datasets_cases1 as $k => $v) {
                        if ($v->y_m == $yr_mon) {
                            $count++;
                            $found_obj = $v;
                        }
                    }
                    if ($count == 0) {
                        //                Months Not Exists
                        $dt_comp = $yr_mon;
                        $date_formatted = date('M Y', strtotime($dt_comp));
                        $empty_obj = (object)['y_m' => $yr_mon, 'dataset_type' => $getDataCode, 'total_count' => (string)"0", 'record_date' => $yr_mon];
                        array_push($data_sorted, $empty_obj);
                    } else {
                        array_push($data_sorted, $found_obj);
                    }
                }

                $finalDataArray[$counter]["dataset_type"] = $getDataCode;
                $finalDataArray[$counter]["dataset_cases"] = $data_sorted;
                $counter++;
            }
//            } else {
//                $datasets_cases1 = $this->Doctor_model->display_dataset_cases_chart($post_dataset_type,$reportranget);
//
//                $data_sorted = array();
//                foreach ($yms as $key => $value) {
//                    $found_obj = 0;
//                    $count = 0;
//                    $yr_mon = $value;
//                    foreach ($datasets_cases1 as $k => $v) {
//                        if ($v->y_m == $yr_mon) {
//                            $count++;
//                            $found_obj = $v;
//                        }
//                    }
//                    if ($count == 0) {
//                        //                Months Not Exists
//                        $dt_comp = $yr_mon;
//                        $date_formatted = date('M Y', strtotime($dt_comp));
//                        $empty_obj = (object)['y_m' => $yr_mon, 'dataset_type' => $post_dataset_type, 'total_count' => (string)"0", 'record_date' => $yr_mon];
//                        array_push($data_sorted, $empty_obj);
//                    } else {
//                        array_push($data_sorted, $found_obj);
//                    }
//                }
//                $finalDataArray[0]["dataset_type"] = $post_dataset_type;
//                $finalDataArray[0]["dataset_cases"] = $data_sorted;
//            }
            $datasets_cases['dataset_data'] = $finalDataArray;
            $lineChartData = array();
            $counter = 0;

            foreach ($datasets_cases['dates_data'] as $datesData => $dateVal) {
                foreach ($datasets_cases['dataset_data'] as $datasetData) {
                    foreach ($datasetData['dataset_cases'] as $datasetCases) {
                        if ($dateVal == $datasetCases->record_date) {
                            $lineChartData[$counter] += $datasetCases->total_count;
                        }
                    }
                }
                $counter++;
            }
            $lineChartData1 = array();
            $maxVal = max($lineChartData);
            foreach ($lineChartData as $lineChart => $lineCharVal) {
                $lineChartData1[] = (float)number_format((float)(($lineCharVal / $maxVal) * 100), 2, '.', '');
            }
            $datasets_cases['dataset_lines'] = $lineChartData;
//                echo "<pre>";
//                print_r( $datasets_cases['dataset_data']);
//            $array = array_column($datasets_cases['dataset_data'][0]['dataset_cases'], 'total_count');
//            print_r( $array);
//                print_r($lineChartData1);
//                exit;
            if ($post_dataset_type == "all") {
                $datasets_cases['datasets_category'] = $datasets_cases['datasets_case_types'];
            } else {
//                $dataCategories = array();
//                if(!empty($post_dataset_type)){
//                    $dataCategories = implode(",",$post_dataset_type);
//                    $dataCategories = $this->db->select("dataset_code")->where("dataset_id IN ($dataCategories)")->get("tbl_datasets")->result_array();
//                    $dataCategories = array_map (function($value){
//                        return $value['dataset_code'];
//                    } , $dataCategories);
//                }

                $datasets_cases['datasets_category'] = $dataCategories;
            }
//            $datasets_cases['dates_data'] = $yms;
//            echo "<pre>";print_r($data_sorted );exit;
        }

//        $colorsArray = $this->colourArray(10);
//        echo "<pre>";print_r($colorsArray);exit;
//        $datasets_cases['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id);
//        echo "<pre>";print_r($datasets_cases['dataset_data']);exit;
//        echo "<pre>";print_r($datasets_cases['datasets_case_types']);exit;
        $footer_data['javascripts'] = array(
            'js/custom_js/record_detail.js',
        );
        $this->load->view('doctor/inc/header-new');
        $this->load->view('dataset/dataset_cases', $datasets_cases);
        $this->load->view('doctor/inc/footer-new', $footer_data);
    }

    public function record_cases()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;


        $datasets_cases["get_specialties"] = $this->Doctor_model->get_specialties();

        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Record Cases', base_url('index.php/doctor/datasets_cases'));
        $datasets_cases['breadcrumbs'] = $this->mybreadcrumb->render();

        $datasets_cases['datasets_cases'] = array();
        $datasets_cases['sr_dataset_type'] = '';
        $opinion_status = 'inbound';
        $datasets_cases['datasets_cases'] = $this->Doctor_model->display_dataset_cases('');
        $datasets_cases['datasets_case_types'] = $this->Doctor_model->get_dataset_types();
//        echo $this->db->last_query();exit;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_dataset_type = $this->input->post('sr_dataset_type');
            $reportranget = explode(" - ", $this->input->post('reportranget'));
            $start_date = date("Y-m-d", strtotime($reportranget[0]));
            $end_date = date("Y-m-d", strtotime($reportranget[1] . ' +1 day'));

            $datasets_cases['post_dates'] = $this->input->post('reportranget');
            $datasets_cases['post_category'] = $post_dataset_type;
//
            $noWeek = $this->datediff("ww",$start_date,$end_date);
            $datetime1 = new DateTime($start_date);
            $datetime2 = new DateTime($end_date);
            $interval = $datetime1->diff($datetime2);
            $noOfYear = $interval->format('%y');
            $noOfMonths = $interval->format('%m.%d');
            $noOfDays = $interval->format('%d');
            $datesArray = array();

//            echo "Year";
//            print_r($noOfYear);
//            echo "Month";
//            print_r($noOfMonths);
//            echo "Week";
//            print_r($noWeek);
//            echo "m".$noOfDays;exit;
            if($noOfMonths > 2 or $noOfYear >= 1){
                //case of month
                $datasets_cases['calendar_type'] = "m";
                $datetime1->modify('first day of this month');
                $datetime2->modify('first day of next month');
                $interval = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($datetime1, $interval, $datetime2);
                $dc = 0;
                foreach ($period as $dt) {
                    $starts_date = $dt->modify('first day of this month');
                    $ends_date = $dt->modify('last day of this month');
                    $datesArray[$dc]['label'] = $dt->format("Y-m");
                    $datesArray[$dc]['dates'] = $starts_date->format("Y-m-01")." - ".($ends_date->format("Y-m-d")>$end_date?$end_date:$ends_date->format("Y-m-d"));
                    $dc++;
                }

            } else if($noWeek <= 8 and ($noOfMonths >=1 or $noOfDays > 7)){
                //Week Case
                $datasets_cases['calendar_type'] = "w";
                $dc = 0;
                for($i = 1; $i <= $noWeek; $i++){
                    $week = $datetime1->format("W");
                    $datetime1->add(new DateInterval('P6D'));
//                    echo $week." = ".$start_date." - ".$datetime1->format('Y-m-d')."<br/>";
                    $datesArray[$dc]['label'] = "Week $i";
                    $datesArray[$dc]['dates'] = $start_date." - ".$datetime1->format('Y-m-d');
                    $datetime1->add(new DateInterval('P1D'));
                    $start_date = $datetime1->format('Y-m-d');
                    $dc++;
                }
            } else{
                // Days Case
                $datasets_cases['calendar_type'] = "d";
                $yms = array();
                $period = new DatePeriod(
                    new DateTime($start_date),
                    new DateInterval('P1D'),
                    new DateTime($end_date)
                );
                $dc = 0;
                foreach ($period as $key => $value) {
                    $datesArray[$dc]['label'] = $value->format('Y-m-d');
                    $datesArray[$dc]['dates'] = $value->format('Y-m-d')." - ".$value->format('Y-m-d');
                    $datasets_cases['dates_data'][] = $value->format('Y-m-d');
                    $yms[$value->format('Y-m-d')] = $value->format('Y-m-d');
                    $dc++;
                }
            }

            $dataCategories = array();
            $counter = 0;



//            foreach ($post_dataset_type as $data => $dataValue) {
//                //Final Old
//                $datasets_cases1 = array();
//                foreach ($datesArray as $datesData){
//                    $getData = $this->Doctor_model->display_record_cases_chart($dataValue, explode(" - ",$datesData['dates']));
////                    $datasets_cases1[] = $getData;
//                    if(!empty($getData)){
//                        $getData[0]->y_m = $datesData['label'];
//                        $datasets_cases1[] = (object) $getData[0];
//                    } else {
//                        $getData['y_m'] = $datesData['label'];
//                        $getData['dataset_code'] = $dataValue;
//                        $getData['total_count'] = 0;
//                        $datasets_cases1[] = (object) $getData;
//                    }
//                }
//
//                $finalDataArray[$counter]["dataset_type"] = $dataValue;
//                $finalDataArray[$counter]["dataset_cases"] = $datasets_cases1;
//                $counter++;
//            }


//            echo "<pre>";
//            print_r($datesArray);
//            print_r($post_dataset_type);
//            exit;

            $finalNewArray = array();$categoriesMax = array();
            $counter = 0;
            foreach ($datesArray as $datesData){
                $finalNewArray[$counter]->publish_month = $datesData['label'];
                //Final New
                $datasets_cases1 = array();$getMaxArray = array();
                $inner_count = 1;
                foreach ($post_dataset_type as $data => $dataValue) {
                    $getData = $this->Doctor_model->display_record_cases_chart($dataValue, explode(" - ",$datesData['dates']));
                    if(!empty($getData)){
                        $showNo = $getData[0]->total_count;
                    } else {
                        $showNo = 0;
                    }
                    $getMaxArray[] = $showNo;
                    $category = "category_".$inner_count;
                    $finalNewArray[$counter]->$category = $showNo;

                    if($showNo > $categoriesMax[$dataValue]){$categoriesMax[$dataValue]=$showNo;}

                    $inner_count++;
                }

//                $totalLength = count($post_dataset_type);
//                $getMaxNo = max($getMaxArray);
//
//                for ($j=1; $j<=$totalLength;$j++) {
//                    $percentage = "percentage_".$j;
//                    $category = "category_".$j;
//                    $finalNewArray[$counter]->$percentage = ($getMaxNo==0?0:($finalNewArray[$counter]->$category/$getMaxNo)*100);
//                }

                $counter++;
            }


            $counter = 0;
            foreach ($datesArray as $datesData){
                $inner_count = 1;
                foreach ($post_dataset_type as $data => $dataValue) {
                    $getMaxNo = $categoriesMax[$dataValue];
                    $percentage = "percentage_".$inner_count;
                    $category = "category_".$inner_count;
                    $finalNewArray[$counter]->$percentage = ($getMaxNo==0?0:($finalNewArray[$counter]->$category/$getMaxNo)*100);
                    $inner_count++;

                }
                $counter++;
            }




//            echo "<pre>";
//                            print_r($getMaxArray);
//            print_r($finalNewArray);
//                print_r($totalLength);
//                print_r($getMaxNo);
//            exit;
////
//            echo "<pre>";
//            echo "New one ";
//            print_r($categoriesMax);
//            exit;
//
//            $counter = 0;
//            foreach ($post_dataset_type as $data => $dataValue) {
//                $dataCategories[] = $dataValue;
//                $datasets_cases1 = $this->Doctor_model->display_record_cases_chart($dataValue, $reportranget);
////                echo $this->db->last_query()."<br/>";
//
//                $data_sorted = array();
//                foreach ($yms as $key => $value) {
//                    $found_obj = 0;
//                    $count = 0;
//                    $yr_mon = $value;
//                    foreach ($datasets_cases1 as $k => $v) {
//                        if ($v->y_m == $yr_mon) {
//                            $count++;
//                            $found_obj = $v;
//                        }
//                    }
//                    if ($count == 0) {
//                        //                Months Not Exists
//                        $dt_comp = $yr_mon;
//                        $date_formatted = date('M Y', strtotime($dt_comp));
//                        $empty_obj = (object)['y_m' => $yr_mon, 'dataset_type' => $dataValue, 'total_count' => (string)"0", 'record_date' => $yr_mon];
//                        array_push($data_sorted, $empty_obj);
//                    } else {
//                        array_push($data_sorted, $found_obj);
//                    }
//                }
//                $finalDataArray[$counter]["dataset_type"] = $dataValue;
//                $finalDataArray[$counter]["dataset_cases"] = $data_sorted;
//
//                $counter++;
//            }
//            echo "old one ";
//            print_r($finalDataArray);
//            exit;





            $datasets_cases['dataset_types'] = $post_dataset_type;
            $datasets_cases['dataset_data'] = $finalNewArray;
//                echo "<pre>";
//                print_r( $datasets_cases['dataset_data']);
//            $array = array_column($datasets_cases['dataset_data'][0]['dataset_cases'], 'total_count');
//            print_r( $array);
//                print_r($lineChartData1);
//                exit;
//            $datasets_cases['dates_data'] = $yms;
//            echo "<pre>";print_r($data_sorted );exit;
        }

//        $colorsArray = $this->colourArray(10);
//        echo "<pre>";print_r($colorsArray);exit;
//        $datasets_cases['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id);
//        echo "<pre>";print_r($datasets_cases['dataset_data']);exit;
//        echo "<pre>";print_r($datasets_cases['datasets_case_types']);exit;
        $footer_data['javascripts'] = array(
            'js/custom_js/record_detail.js',
        );
        $this->load->view('doctor/inc/header-new');
        $this->load->view('dataset/record_cases', $datasets_cases);
        $this->load->view('doctor/inc/footer-new', $footer_data);
    }

    public function chart_report_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;


//        chart_report_detail
        $calendar_type = $this->input->post("calendar_type");
        $selected_category = $this->input->post("selected_category");
        $post_dates = $this->input->post("post_dates");
        $post_category = $this->input->post("post_category");

        $reportranget = explode(" - ", $post_dates);
        $start_date = date("Y-m-d", strtotime($reportranget[0]));
        $end_date = date("Y-m-d", strtotime($reportranget[1] . ' +1 day'));
        $noWeek = $this->datediff("ww",$start_date,$end_date);
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $datesArray = array();

        if($calendar_type=="m"){
            $queryStartDate = date("Y-m-01",strtotime($selected_category));
            $queryEndDate = date("Y-m-t",strtotime($selected_category));
        }
        else if($calendar_type=="w"){
            //Week Case
            $dc = 0;
            for($i = 1; $i <= $noWeek; $i++){
                $week = $datetime1->format("W");
                $datetime1->add(new DateInterval('P6D'));
//                    echo $week." = ".$start_date." - ".$datetime1->format('Y-m-d')."<br/>";
                $datesArray[$dc]['label'] = "Week $i";
                $datesArray[$dc]['dates'] = $start_date." - ".$datetime1->format('Y-m-d');
                $datetime1->add(new DateInterval('P1D'));
                $start_date = $datetime1->format('Y-m-d');
                $dc++;
            }

            $key = array_search($selected_category, array_column($datesArray, 'label'));
            $explodeDates = explode(" - ",$datesArray[$key]['dates']);
            $queryStartDate = $explodeDates[0];
            $queryEndDate = $explodeDates[1];
        }
        else{
            $queryStartDate = $selected_category;
            $queryEndDate = $selected_category;
        }

        $post_category = explode(",",$post_category);
        $finalArray = array();
        foreach ($post_category as $pstData=>$postValue){
            $getData = $this->Doctor_model->display_record_cases_detail($postValue,$queryStartDate,$queryEndDate);
            $finalArray = array_merge($getData,$finalArray);
        }

        if($finalArray){
            $json['type'] = 'success';
            $json['data'] = $finalArray;
            $json['msg'] = 'Data fetched successfully.';
        }
        echo json_encode($json);
        die;
    }

    function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
    {
        /*
        $interval can be:
        yyyy - Number of full years
        q    - Number of full quarters
        m    - Number of full months
        y    - Difference between day numbers
               (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
        d    - Number of full days
        w    - Number of full weekdays
        ww   - Number of full weeks
        h    - Number of full hours
        n    - Number of full minutes
        s    - Number of full seconds (default)
        */

        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto   = strtotime($dateto, 0);
        }

        $difference        = $dateto - $datefrom; // Difference in seconds
        $months_difference = 0;

        switch ($interval) {
            case 'yyyy': // Number of full years
                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
                    $years_difference--;
                }

                if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
                    $years_difference++;
                }

                $datediff = $years_difference;
                break;

            case "q": // Number of full quarters
                $quarters_difference = floor($difference / 8035200);

                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }

                $quarters_difference--;
                $datediff = $quarters_difference;
                break;

            case "m": // Number of full months
                $months_difference = floor($difference / 2678400);

                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }

                $months_difference--;

                $datediff = $months_difference;
                break;

            case 'y': // Difference between day numbers
                $datediff = date("z", $dateto) - date("z", $datefrom);
                break;

            case "d": // Number of full days
                $datediff = floor($difference / 86400);
                break;

            case "w": // Number of full weekdays
                $days_difference  = floor($difference / 86400);
                $weeks_difference = floor($days_difference / 7); // Complete weeks
                $first_day        = date("w", $datefrom);
                $days_remainder   = floor($days_difference % 7);
                $odd_days         = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?

                if ($odd_days > 7) { // Sunday
                    $days_remainder--;
                }

                if ($odd_days > 6) { // Saturday
                    $days_remainder--;
                }

                $datediff = ($weeks_difference * 5) + $days_remainder;
                break;

            case "ww": // Number of full weeks
                $datediff = floor($difference / 604800);
                break;

            case "h": // Number of full hours
                $datediff = floor($difference / 3600);
                break;

            case "n": // Number of full minutes
                $datediff = floor($difference / 60);
                break;

            default: // Number of full seconds (default)
                $datediff = $difference;
                break;
        }

        return $datediff;
    }

    public function datasets_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $checkhospital = getRecords("group_id", "users_groups_type", array("user_id" => $doctor_id));
        $hospitallist = array();
        foreach ($checkhospital as $rec) {
            $hospitallist[] = $rec->group_id;
        }

        //echo last_query();exit;
        $datasets_cases["get_hospitals"] = $this->Doctor_model->display_hospitals_list($hospitallist);
        $datasets_cases["get_specialties"] = $this->Doctor_model->get_specialties();

        $this->mybreadcrumb->add('Dashboard', base_url('index.php/doctor'));
        $this->mybreadcrumb->add('Dataset List', base_url('index.php/doctor/datasets_list'));
        $datasets_cases['breadcrumbs'] = $this->mybreadcrumb->render();

        $datasets_cases['datasets_cases'] = array();
        $datasets_cases['sr_dataset_type'] = '';
        $opinion_status = 'inbound';
        $datasets_cases['datasets_cases'] = $this->Doctor_model->get_datasets();
//        echo $this->db->last_query();exit;

//        $datasets_cases['request_slides_id'] = $this->Doctor_model->doctor_record_list_with_slide($doctor_id);
//        echo "<pre>";print_r($datasets_cases['datasets_cases']);exit;
//        echo "<pre>";print_r($datasets_cases['datasets_case_types']);exit;
        $footer_data['javascripts'] = array(
            'js/custom_js/record_detail.js',
        );
        $this->load->view('doctor/inc/header-new');
        $this->load->view('dataset/dataset_list', $datasets_cases);
        $this->load->view('doctor/inc/footer-new', $footer_data);
    }

public function updatePatientsRecord()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }		
		$p_id=	$this->input->get('p_id');		
		$first_name = $this->input->get('f_name');		
		$change_status = array('first_name' => $first_name);
		$this->db->where('id', $p_id);
		$this->db->update('patients', $change_status);
	}
			
	
	
	public function delete_record($record_id)
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
		redirect('doctor/doctor_record_list', 'refresh');
    }
			

    public function updateDatasetRecord()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $editId = $this->input->post("edit_id");
            $hospital_id = $this->input->post("hospital_id");
            $dataset_name = $this->input->post("dataset_name");
            $dataset_code = $this->input->post("dataset_code");
            $dataset_parent = $this->input->post("dataset_parent");
            $updateData['hospital_id'] = $hospital_id;
            $updateData['dataset_name'] = $dataset_name;
            $updateData['dataset_code'] = $dataset_code;
            $updateData['parent_dataset_id'] = $dataset_parent;
            $this->db->where("dataset_id", $editId);
            $updateStatus = $this->db->update("tbl_datasets", $updateData);
            if ($updateStatus) {
                $json['status'] = "success";
                $json['message'] = "Record updated successfully";
            } else {
                $json['status'] = "error";
                $json['message'] = "There might be some error. Please try again";
            }

            echo json_encode($json);
            exit;
        }
    }

}
