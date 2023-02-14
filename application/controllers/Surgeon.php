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

class Surgeon extends CI_Controller
{
    /**
     * Constructor to load models and helpers
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper(array('url', 'activity_helper'));

        track_user_activity();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $surgeon_id = $this->ion_auth->user()->row()->id;

        //Get Records Bases On Current Dermatological Surgeon
        $result['result'] = $this->db->where('dermatological_surgeon', $surgeon_id)->get('request')->result_array();
        $this->load->view('surgeon/inc/header');
        $this->load->view('surgeon/index', $result);
        $this->load->view('surgeon/inc/footer');
    }

    public function search_result() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $search_result = $this->input->post('search_result');
        $surgeon_id = $this->ion_auth->user()->row()->id;
        $sql = "SELECT * FROM request
        INNER JOIN users WHERE request.hospital_group_id = users.surgeon_clinician_hos_group_id
        AND users.id = $surgeon_id
        AND request.ura_barcode_no LIKE '%$search_result'
        ";
        $query_result['query_result'] = $this->db->query($sql)->result_array();

        $this->load->view('surgeon/inc/header');
        $this->load->view('surgeon/search_result', $query_result);
        $this->load->view('surgeon/inc/footer');
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

        if (!empty($record_id)) {
            $data1['query1'] = $this->Admin_model->detail_record_view_request($record_id);
            $data2['query2'] = $this->Admin_model->detail_record_view_specimen($record_id);
            $doc_list['doctor_list'] = $this->Admin_model->get_doctors();
            $record_history['record_history'] = $this->Admin_model->get_record_history_data($record_id);
            $specimen_type['specimen_type'] = $this->Admin_model->specimen_type();

            $result = array_merge($data1, $data2, $doc_list, $record_history, $specimen_type);
        }

        $this->load->view('surgeon/inc/header');
        $this->load->view('surgeon/record_detail', $result);
        $this->load->view('surgeon/inc/footer');
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
            $this->session->sess_regenerate(true);

            redirect('/', 'refresh');
        }
    }
}