<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Search Tracking Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

Class Searchtracking_model extends CI_Model 
{
    /**
     * Attached document of record
     *
     * @param int $record_id
     * @param int $doctor_id
     * @return void
     */
    public function count_documents($record_id, $doctor_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM files
                                WHERE files.record_id = $record_id
                                AND files.user_id = $doctor_id");
        return $query->num_rows();
    }

    /**
     * Get all session records data.
     *
     * @param array $session_rec_data
     * @return void
     */
    public function get_all_session_records($session_rec_data) 
    {
        if (!empty($session_rec_data)) {
            $sql = "SELECT * FROM request WHERE request.uralensis_request_id IN (" . implode(',', $session_rec_data) . ")";
            return $query = $this->db->query($sql)->result_array();
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
     * Get record assignee doctor id
     *
     * @param int $record_id
     * @return void
     */
    public function get_record_assignee_doctor_id($record_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $doctor_id = '';
        if (!empty($record_id)) {
            return $doctor_id = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array()['user_id'];
        }
    }

    /**
     * Get All Track Templates
     *
     * @return void
     */
    public function get_track_all_templates() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->get('uralensis_record_track_template')->result_array();
    }

    /**
     * Get Session record batch data
     *
     * @param int $template_id
     * @return void
     */
    public function get_session_record_batch_data($template_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($template_id)) {
            return $this->db->where('template_id', $template_id)->get('uralensis_session_record_batch')->result_array();
        }
    }

    /**
     * Get all session record by ids
     *
     * @param array $session_data
     * @return void
     */
    public function get_session_batch_records($session_data) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($session_data)) {
            return $this->db->where_in('ura_barcode_no', $session_data)->get('request')->result_array();
        }
    }
    
    

}
