<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Secretary Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

Class Secretary_model extends CI_Model 
{

    /**
     * Display Previous Login Records
     *
     */
    public function previous_login_records() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $get_user_email = $this->ion_auth->user()->row()->email;
        $query = $this->db->query("SELECT * FROM users_login_records
                                WHERE users_login_records.users_login_id = '$get_user_email'
                                ORDER BY users_login_records.ulr_id DESC LIMIT 5");
        return $query->result();
    }

    /**
     * Get All Records Based on Doctor Selection.
     *
     * @param int $sect_id
     */
    public function get_all_doctors_list($sect_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($sect_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_doctor_sec_assign
            WHERE uralensis_doctor_sec_assign.ura_sec_id = $sect_id");
            return $query->result();
        }
    }

    /**
     * Find All Reports Bases on Doctor
     *
     * @param int $doctor_id
     */
    public function get_all_doctor_reports($doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($doctor_id)) {
            $query = $this->db->query("SELECT * FROM request
                INNER JOIN request_assignee
                WHERE request.uralensis_request_id = request_assignee.request_id
                AND request_assignee.user_id = $doctor_id
                AND request.specimen_publish_status = 0 AND request.record_secretary_status = 'unset'");
            return $query->result();
        }
    }

    /**
     * Get All Secretaries based on Doctor ID
     *
     * @param int $doctor_id
     */
    public function get_all_secretaries($doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($doctor_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_doctor_sec_assign
            WHERE uralensis_doctor_sec_assign.ura_doctor_id = $doctor_id");
            return $query->result();
        }
    }

    public function get_avaialble_secretary($doctor_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->select("user_id, COUNT(ura_doctor_id) AS working_for");
        $this->db->from("groups");
        $this->db->join("users_groups", "users_groups.group_id = groups.id");
        $this->db->join("uralensis_doctor_sec_assign", "uralensis_doctor_sec_assign.ura_sec_id = user_id", "left");
        $this->db->where("group_type", "S");
        $this->db->where("ura_doctor_id is NULL");
        $this->db->or_where("ura_doctor_id !=", $doctor_id);
        $this->db->group_by("user_id");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_secretary_user_details($id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($id)) {
            $query = $this->db->query("SELECT AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name, profile_picture_path FROM users WHERE id=$id")->result_array();
            return $query;
        }

    }

    public function unassign_secretary($user_id, $sec_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->where("ura_doctor_id", $user_id);
        $this->db->where("ura_sec_id", $sec_id);
        $this->db->delete("uralensis_doctor_sec_assign");
    }

    public function assign_secretary($user_id, $sec_ids) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        foreach ($sec_ids as $sec_id) {
            $data = array(
                'ura_doctor_id' => $user_id,
                'ura_sec_id' => $sec_id
            );
            $this->db->insert('uralensis_doctor_sec_assign', $data);
        }
    }

    /**
     * Find All Reports Bases on Doctor
     *
     */
    public function get_all_assigned_records() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $secretary_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT * FROM request
        INNER JOIN request_assignee
        INNER JOIN uralensis_sec_rec_assign
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND request.specimen_publish_status = 0 AND request.record_secretary_status = 'true'
        AND request.record_secretary_id = uralensis_sec_rec_assign.ura_sec_rec_sec_id
        AND request_assignee.user_id = uralensis_sec_rec_assign.ura_sec_rec_doc_id
        AND request.uralensis_request_id = uralensis_sec_rec_assign.ura_sec_rec_rec_id
        AND request.record_secretary_id = $secretary_id");
        return $query->result();
    }

    /**
     * Record Detail
     *
     * @param int $record_id
     * @param int $doctor_id
     */
    public function doctor_record_detail($record_id, $doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM request
            INNER JOIN users
            INNER JOIN request_assignee
            INNER JOIN uralensis_sec_rec_assign
            WHERE request.uralensis_request_id = $record_id
            AND request_assignee.request_id = $record_id
            AND uralensis_sec_rec_assign.ura_sec_rec_doc_id = $doctor_id
            AND users.id = $doctor_id
            AND request_assignee.request_id = uralensis_sec_rec_assign.ura_sec_rec_rec_id");
        $session_data = array(
            'id' => $record_id
        );
        $this->session->set_userdata($session_data);
        return $query->result();
    }

    /**
     * Record Detail Specimen
     *
     * @param int $record_id
     * @param int $doctor_id
     */
    public function doctor_record_detail_specimen($record_id, $doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM request
            INNER JOIN specimen
            INNER JOIN users
            INNER JOIN request_assignee
            INNER JOIN uralensis_sec_rec_assign
            WHERE request.uralensis_request_id = $record_id
            AND specimen.request_id = $record_id
            AND request_assignee.request_id = $record_id
            AND uralensis_sec_rec_assign.ura_sec_rec_doc_id = $doctor_id
            AND users.id = $doctor_id
            AND uralensis_sec_rec_assign.ura_sec_rec_rec_id = request_assignee.request_id");
        $session_data = array(
            'id' => $record_id
        );
        $this->session->set_userdata($session_data);
        return $query->result();
    }

    /**
     * Get Supplementary Reports
     *
     * @param int $id
     */
    public function get_supplementary($id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $supple_query = $this->db->query("SELECT * FROM additional_work
                            WHERE additional_work.request_id = $id");
        return $supple_query->result();
    }

    /**
     * Related Post Models
     *
     * @param int $record_id
     * @param string $nhs_no
     */
    public function related_posts_model($record_id, $nhs_no) 
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // $related_posts_query = $this->db->query("SELECT * FROM request
        //                             WHERE request.nhs_number = '$nhs_no'
        //                             AND request.uralensis_request_id != $record_id");

        $related_posts_query = $this->db->query("SELECT * FROM request
                WHERE request.nhs_number = '$nhs_no'
                AND request.uralensis_request_id != $record_id
                AND CHAR_LENGTH(request.nhs_number) > 3");
        return $related_posts_query->result();
    }

    /**
     * Get Education Categories
     *
     */
    public function get_education_cases_model() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats
                                WHERE uralensis_teach_mdt_cats.ura_tech_mdt_type = 'teaching'");
        return $query->result();
    }

    /**
     * Get MDT Categories
     *
     */
    public function get_mdt_cases_model() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats WHERE uralensis_teach_mdt_cats.ura_tech_mdt_type = 'mdt'");
        return $query->result();
    }

    /**
     * Get CPC Categories
     *
     */
    public function get_cpc_cases_model() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats WHERE uralensis_teach_mdt_cats.ura_tech_mdt_type = 'cpc'");
        return $query->result();
    }

    /**
     * Fetch Files Data
     *
     * @param int $id
     */
    public function fetch_files_data($id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($id)) {
            $record_id = $id;
            $query = $this->db->query("SELECT * FROM files WHERE record_id = $record_id ORDER BY files_id");
            return $query->result();
        }
    }

    /**
     * Get Lab Name Records
     *
     */
    public function get_lab_names() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $result = $this->db->query("SELECT * FROM lab_names ORDER BY lab_name_id ASC");
        return $result->result();
    }

    /**
     * Get Cost Codes
     *
     * @param int $hospital_id
     */
    public function get_cost_codes($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_cost_codes
                        WHERE uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_id AND ura_cost_code_type != 'block'");
        return $query->result();
    }

    /**
     * Get Cost Codes By Block
     *
     * @param int $hospital_id
     */
    public function get_cost_codes_by_block($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_cost_codes
                        WHERE uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_id AND ura_cost_code_type = 'block'");
        return $query->result();
    }

    /**
     * Insert Files Data
     * 
     * @param type $filename
     * @param type $title
     * @param type $path
     * @param type $file_ext
     * @param type $is_image
     * @param type $doc_id
     * @param type $record_id
     */
    public function insert_file($filename, $title, $path, $file_ext, $is_image, $user, $doc_id, $record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data = array(
            'file_name' => $filename,
            'title' => $title,
            'file_path' => $path,
            'file_ext' => $file_ext,
            'is_image' => $is_image,
            'user' => $user,
            'user_id' => $doc_id,
            'record_id' => $record_id
        );
        $this->db->insert('files', $data);
    }

    /**
     * Get Doctor ID
     *
     */
    public function get_doctor_id() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sec_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT * FROM uralensis_sec_rec_assign
                                WHERE uralensis_sec_rec_assign.ura_sec_rec_sec_id = $sec_id");
        return $query->result();
    }

    /**
     * Get Further Work
     *
     * @param int $id
     * @param int $doctor_id
     */
    public function get_further_work($id, $doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM `further_work`
                                WHERE request_id = $id AND doctor_id = $doctor_id");
        return $query->result();
    }

    /**
     * Get Additional Work
     *
     * @param int $id
     */
    public function get_additional_work_for_prebulish($id) 
    {
        $query = $this->db->query("SELECT * FROM `additional_work` WHERE request_id = $id");
        return $query->result();
    }

    /**
     * Get Hospital Info
     *
     * @param [type] $id
     */
    public function get_hospital_info($id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM groups
                                INNER JOIN request
                                INNER JOIN users_request
                                WHERE request.uralensis_request_id = $id
                                AND users_request.request_id = request.uralensis_request_id
                                AND groups.id = request.hospital_group_id");
        return $query->result();
    }

    /**
     * Get Record Flag Comments From Flag Comments Table
     *
     * @param int $user_id
     * @param int $record_id
     */
    public function get_flag_commnets_record($user_id, $record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT ufc.ufc_id, ufc.ufc_record_id, ufc.ufc_comments, ufc.ufc_user_id, ufc.ufc_timestamp FROM request
            INNER JOIN request_assignee
            INNER JOIN uralensis_sec_rec_assign
            INNER JOIN uralensis_flag_comments AS ufc
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.record_secretary_id = uralensis_sec_rec_assign.ura_sec_rec_sec_id
            AND request_assignee.user_id = uralensis_sec_rec_assign.ura_sec_rec_doc_id
            AND request.uralensis_request_id = $record_id
            AND request.uralensis_request_id = uralensis_sec_rec_assign.ura_sec_rec_rec_id
            AND request.record_secretary_id = $user_id
            AND ufc.ufc_record_id = request.uralensis_request_id ORDER BY ufc.ufc_id DESC");

        return $query->result();
    }

    /**
     * Find the Microscopic record based on Micro Code.
     *
     * @param string $micro_code
     */
    public function populate_micro_records_model($micro_code) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT umc.umc_title, umc.umc_micro_desc, umc.umc_disgnosis, umc.umc_snomed_t_code, 
                umc.umc_snomed_m_code, umc.umc_snomed_p_code, umc.umc_classification, umc.umc_cancer_register, umc.umc_rcpath_score
                FROM uralensis_micro_codes AS umc WHERE umc.umc_code = '$micro_code' ORDER BY umc.umc_code ASC");
        return $query->result_array();
    }

    /**
     * Get Clinician Requesting Work and dermatology Surgeon
     *
     * @param int $hospital_id
     * @param string $type
     */
    public function get_clinician_and_derm($hospital_id = '', $type = '') 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($hospital_id) && !empty($type) && $type === 'clinician') {
            $get_clinicians = $this->db->query("SELECT * FROM uralensis_clinician WHERE uralensis_clinician.hospital_id = $hospital_id");
            return $get_clinicians->result();
        } else {
            $get_dermatological_surgeon = $this->db->query("SELECT * FROM uralensis_dermatological_surgeon WHERE uralensis_dermatological_surgeon.hospital_id = $hospital_id");
            return $get_dermatological_surgeon->result();
        }
    }

    /**
     * Display Tracking Details
     *
     */
    public function display_tracking_model() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_track_batch");
        return $query->result();
    }

    /**
     * Get All Hospitals List
     *
     */
    public function get_hospital_users() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $result = $this->db->query("SELECT * FROM users WHERE user_type = 'H' ORDER BY id ASC");
        return $result->result();
    }

    /**
     * Find Macthing Records Based On NHS Number MODEL
     *
     * @param string $nhs_number
     */
    public function find_matching_records_model($nhs_number) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT request.patient_initial,
                        request.sur_name, request.f_name,
                        request.dob, request.gender
                        FROM request
                        WHERE request.nhs_number LIKE '$nhs_number'");

        return $query->result();
    }
    
    /**
     * Add Institute
     *
     * @param array $request
     */
    public function institute_insert($request) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->insert("request", $request);
        $record_id = $this->db->insert_id();
        $session_data = array(
            'record_id' => $record_id
        );
        $this->session->set_userdata($session_data);
    }

    /**
     * Assign Request in User Request Table
     *
     */
    public function request_assign() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $record_id = $this->session->userdata('record_id');
        $hospital_id = $this->session->userdata('hospital_id');
        $req_spec = array('request_id' => $record_id, 'users_id' => $hospital_id);
        $this->db->insert("users_request", $req_spec);
    }

    /**
     * Get Cost Codes
     *
     * @param int $hospital_id
     */
    public function get_all_cost_codes($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_cost_codes
                        WHERE uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_id AND ura_cost_code_type = 'block'");
        return $query->result();
    }

    /**
     * Insert Specimen for admin
     *
     * @param array $specimen
     */
    public function insert_specimen_admin($specimen) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->insert("specimen", $specimen);
        $specimen_id = $this->db->insert_id();
        $session_data = array(
            'specimen_id' => $specimen_id
        );
        $this->session->set_userdata($session_data);
        if ($this->db->affected_rows() > 0) {
            echo 'Record Inserted';
        } else {
            echo 'Record Not Inserted';
        }
    }

    /**
     * Insert Specimen
     *
     * @param [type] $specimen
     */
    public function insert_specimen($specimen) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->insert("specimen", $specimen);
        $specimen_id = $this->db->insert_id();
        $session_data = array(
            'specimen_id' => $specimen_id
        );
        $this->session->set_userdata($session_data);
    }

    /**
     * Request For Specimen
     *
     */
    public function request_specimen_add() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $record_id = $this->session->userdata('record_id');
        $specimen_id = $this->session->userdata('specimen_id');
        $data = array('rs_request_id' => $record_id, 'rs_specimen_id' => $specimen_id);
        $this->db->insert('request_specimen', $data);
    }

    /**
     * Specimen Type
     *
     */
    public function specimen_type() 
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->get('request_type');
        return $query->result();
    }

    /**
     * Get All Hospitals By its Groups
     *
     */
    public function get_hospital_groups() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM groups WHERE groups.group_type = 'H'");
        return $query->result();
    }

    /**
     * Display Only Publish Reports
     *
     * @param int $group_id
     * @param string $date_to
     * @param string $date_from
     */
    public function find_csv_report_model_publish($group_id, $date_to, $date_from) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN groups
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND groups.id = users_request.group_id
                    AND users_request.group_id = $group_id
                    AND request.specimen_publish_status = 1 AND request.publish_datetime >= '$date_from' AND request.publish_datetime < '$date_to'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Display Both Publish & Un Publish Reports
     *
     * @param int $group_id
     * @param string $date_to
     * @param string $date_from
     */
    public function find_csv_report_model_publish_unpublish($group_id, $date_to, $date_from) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT request.uralensis_request_id,
        request.publish_datetime, request.serial_number,
        request.request_datetime,
        request.date_taken, request.clrk,
        request.lab_number, request.f_name,
        request.sur_name, request.gender,
        request.dob, request.nhs_number,
        request.emis_number,
        request.hospital_group_id,
        request.date_received_bylab,
        request.clrk,
        request.specimen_publish_status
        FROM request
        INNER JOIN users_request
        INNER JOIN groups
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND (request.specimen_publish_status = 1 OR request.specimen_publish_status = 0)
        AND request.request_datetime >= '$date_from' AND request.request_datetime < '$date_to'");
        return $query->result();
    }

    /**
     * Pending MDT Cases Display Model
     *
     * @param int $hospital_group_id
     * @param string $mdt_date
     * @param int $doctor_id
     */
    public function mdt_cases_list_model($hospital_group_id, $mdt_date, $doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (isset($hospital_group_id)) {
            $query = $this->db->query("SELECT * FROM request
                INNER JOIN users_request
                INNER JOIN groups
                INNER JOIN request_assignee
                INNER JOIN uralensis_mdt_dates
                WHERE users_request.request_id = request.uralensis_request_id
                AND request.uralensis_request_id = request_assignee.request_id
                AND groups.id = users_request.group_id
                AND users_request.group_id = $hospital_group_id
                AND request_assignee.user_id = $doctor_id
                AND uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
                AND uralensis_mdt_dates.ura_mdt_timestamp = request.mdt_case
                AND request.mdt_case_status = 'for_mdt'
               AND request.mdt_case = '$mdt_date' ORDER BY request.publish_datetime DESC, request.uralensis_request_id DESC");
            return $query->result();
        }
    }

    /**
     * Get All MDT Dates
     *
     * @param int $hospital_group_id
     */
    public function get_all_mdt_dates($hospital_group_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_mdt_dates
        WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND uralensis_mdt_dates.ura_mdt_timestamp >= CURDATE() ORDER BY uralensis_mdt_dates.ura_mdt_timestamp");
        return $query->result();
    }

    /**
     * Get MDT Categories
     *
     * @param int $hospital_group_id
     */
    public function get_previous_all_mdt_dates($hospital_group_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_mdt_dates
            WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
            AND uralensis_mdt_dates.ura_mdt_timestamp <= CURDATE() ORDER BY uralensis_mdt_dates.ura_mdt_timestamp");
        return $query->result();
    }

    /**
     * List All Up coming clinic dates
     *
     * @param int $hospital_id
     */
    public function get_upcoming_clinic_dates($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_dates AS ucd
        WHERE ucd.ura_clinic_hospital_id = $hospital_id
        AND ucd.ura_clinic_date >= UNIX_TIMESTAMP(CURDATE()) ORDER BY ucd.ura_clinic_date_id DESC");
        return $query->result();
    }

    /**
     * List All Previous clinic dates
     *
     * @param int $hospital_id
     */
    public function get_previous_clinic_dates($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_dates AS ucd
        WHERE ucd.ura_clinic_hospital_id = $hospital_id
        AND ucd.ura_clinic_date <= UNIX_TIMESTAMP(CURDATE()) ORDER BY ucd.ura_clinic_date_id DESC");
        return $query->result();
    }

    /**
     * Display Save data in Edit clinic View
     *
     * @param int $clinic_record_id
     * @param int $hospital_id
     */
    public function display_clinic_edit_data($clinic_record_id, $hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_dates
            WHERE uralensis_clinic_dates.ura_clinic_date_id = $clinic_record_id
            AND uralensis_clinic_dates.ura_clinic_hospital_id = $hospital_id");
        return $query->result();
    }

    /**
     * Display Save data in Edit clinic View
     *
     * @param int $clinic_record_id
     */
    public function display_clinic_checklist_data($clinic_record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_date_checklist_uploads
        WHERE uralensis_clinic_date_checklist_uploads.ura_clinic_date_id = $clinic_record_id");
        return $query->result();
    }

    /**
     * Display Save data in Edit clinic View
     *
     * @param int $clinic_record_id
     */
    public function display_clinic_requestform_data($clinic_record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_date_requestform_uploads
        WHERE uralensis_clinic_date_requestform_uploads.ura_clinic_date_id = $clinic_record_id");
        return $query->result();
    }

    /**
     * Display Save data in Edit clinic View
     *
     * @param int $clinic_record_id
     */
    public function display_clinic_otherdoc_data($clinic_record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_date_otherdocs_uploads
        WHERE uralensis_clinic_date_otherdocs_uploads.ura_clinic_date_id = $clinic_record_id");
        return $query->result();
    }

    /**
     * Get Request Form Data Based On Clinic Record ID
     *
     * @param int $clinic_record_id
     */
    public function get_request_form_records($clinic_record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_date_requestform_uploads
        WHERE uralensis_clinic_date_requestform_uploads.ura_clinic_date_id = $clinic_record_id");
        return $query->result();
    }

    /**
     * Get All clinic date requests
     *
     * @param int $hospital_id
     * @param int $clinic_record_id
     */
    public function get_all_clinic_requests_data($hospital_id, $clinic_record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM request
            WHERE request.clinic_ref_number = $clinic_record_id
            AND request.hospital_group_id = $hospital_id
            ORDER BY request.uralensis_request_id DESC");

        return $query->result();
    }

    /**
     * Get Request Form Based On Record Request Form ID
     *
     * @param int $request_form_id
     * @param int $clinic_record_id
     */
    public function get_request_form_data($request_form_id, $clinic_record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($request_form_id)) {
            $query = $this->db->query("SELECT rf.ura_clinic_request_form, rf.ura_clinic_request_ext FROM uralensis_clinic_date_requestform_uploads AS rf
            WHERE rf.ura_clinic_date_id = $clinic_record_id
            AND rf.ucd_requestform_upload_id = $request_form_id");
            return $query->result();
        }
    }

    /**
     * Get Couriers Records For Display
     *
     * @param int $hospital_id
     */
    public function get_couriers_display_record($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_courier 
                            WHERE uralensis_courier.ura_courier_hospital_id = $hospital_id 
                            ORDER BY uralensis_courier.ura_courier_id DESC");
        return $query->result();
    }

    /**
     * Get Couriers Records For Display
     *
     * @param int $hospital_id
     */
    public function get_batch_couriers_display_record($hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_batches
                                WHERE uralensis_batches.ura_batch_hospital_id = $hospital_id 
                                ORDER BY uralensis_batches.ura_batches_id DESC");
        return $query->result();
    }

    /**
     * Get Batch Data
     *
     * @param int $batch_id
     */
    public function get_batch_data($batch_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_batches WHERE uralensis_batches.ura_batches_id = $batch_id");
        return $query->result();
    }

    /**
     * Get All Batches List
     *
     * @param int $hosptal_id
     */
    public function get_all_hospital_batches($hosptal_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_batches
                                WHERE uralensis_batches.ura_batch_hospital_id = $hosptal_id
                                ORDER BY uralensis_batches.ura_batches_id DESC");
        return $query->result();
    }

    /**
     * Get Clinic Batches List
     *
     * @param int $batch_id
     * @param int $hospital_id
     */
    public function get_clinic_batches_list($batch_id, $hospital_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_clinic_dates 
                                    WHERE uralensis_clinic_dates.ura_clinic_hospital_id = $hospital_id 
                                    AND uralensis_clinic_dates.ura_clinic_batch_id = $batch_id 
                                    ORDER BY uralensis_clinic_dates.ura_clinic_date_id DESC");
        return $query->result();
    }

}
