<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tracking Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

Class Tracking extends CI_Controller 
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper(array('url', 'activity_helper'));
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        track_user_activity();
    }

    /**
     * Tracking View
     *
     * @return void
     */
    public function tracking() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('templates/header');
        $this->load->view('display/tracking/index');
        $this->load->view('templates/footer');
    }

    /**
     * Add Batch
     *
     * @return void
     */
    public function add_batch() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('batch_name', 'Batch Name', 'required');
        $this->form_validation->set_rules('batch_code', 'Batch Code', 'required');
        $this->form_validation->set_rules('batch_clinic_date', 'Batch Clinic Date', 'required');

        $batch_name = '';
        $batch_code = '';
        $batch_clinic_date = '';
        $upload_data = '';

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('display/tracking/index');
            $this->load->view('templates/footer');
        } else {

            $batch_name = $this->input->post('batch_name');
            $batch_code = $this->input->post('batch_code');
            $batch_clinic_date = $this->input->post('batch_clinic_date');
            $clinic_change_date = date('Y-m-d h:i A', strtotime($batch_clinic_date));

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 8192;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('batch_checklist')) {
                $upload_data = array('upload_data' => $this->upload->data());
            }

            $batch_data = array(
                'ura_track_batch_name' => $this->input->post('batch_name'),
                'ura_track_batch_code' => $this->input->post('batch_code'),
                'ura_batch_total_patients' => $this->input->post('batch_total_patients'),
                'ura_batch_total_specimens' => $this->input->post('batch_total_specimens'),
                'ura_batch_clinic_name' => $this->input->post('batch_clinic_name'),
                'ura_batch_status' => $this->input->post('batch_status'),
                'ura_batch_notes' => $this->input->post('batch_notes'),
                'ura_batch_clinic_date' => $clinic_change_date,
                'ura_batch_checklist_path' => !empty($upload_data['upload_data']['full_path']) ? $upload_data['upload_data']['full_path'] : '',
                'ura_batch_checklist_name' => !empty($upload_data['upload_data']['file_name']) ? $upload_data['upload_data']['file_name'] : ''
            );

            $this->db->insert('uralensis_track_batch', $batch_data);
            $batch_msg = '<p class="alert alert-success">Batch Successfully Added.</p>';
            $this->session->set_flashdata('batch_msg', $batch_msg);
            redirect('admin_tracking/tracking/tracking');
        }
    }

    /**
     * Display Tracking List
     *
     * @return void
     */
    public function display_tracking() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $tracking_data['tracking_list'] = $this->Admin_model->display_tracking_model();
        $this->load->view('templates/header');
        $this->load->view('display/tracking/display_tracking', $tracking_data);
        $this->load->view('templates/footer');
    }

    /**
     * Display Tracking Detail
     *
     * @param int $batch_id
     * @return void
     */
    public function track_detail($batch_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $tracking_data['tracking_detail'] = $this->Admin_model->detail_tracking_model($batch_id);
        $bacth_records_data['bacth_records'] = $this->Admin_model->detail_tracking_get_batched_model($batch_id);
        $batch_data = array_merge($tracking_data, $bacth_records_data);
        $this->load->view('templates/header');
        $this->load->view('display/tracking/detail_tracking', $batch_data);
        $this->load->view('templates/footer');
    }

    /**
     * Edit Tracking Details
     *
     * @return void
     */
    public function update_tracking() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('templates/header');
        $this->load->view('display/tracking/update_tracking');
        $this->load->view('templates/footer');
    }

    /**
     * Update Tracking Sent To Lab
     *
     * @return void
     */
    public function update_tracking_sent_to_lab() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $bacth_id = $this->input->post('batch_id');
        $bacth_name = $this->input->post('batch_name');
        $bacth_code = $this->input->post('batch_code');
        $sent_to_lab_datetime = $this->input->post('sent_to_lab_datetime');
        $sent_to_lab_change_date = date('Y-m-d h:i A', strtotime($sent_to_lab_datetime));
        $sent_to_lab_location = $this->input->post('sent_to_lab_location');
        $sent_to_lab_name = $this->input->post('sent_to_lab_name');
        if (empty($_POST['sent_to_lab_id'])) {
            $sent_to_lab_data = array(
                'ura_sent_batch_id' => $bacth_id,
                'ura_sent_to_timestamp' => !empty($sent_to_lab_change_date) ? $sent_to_lab_change_date : '',
                'ura_sent_to_address' => !empty($sent_to_lab_location) ? $sent_to_lab_location : '',
                'ura_sent_to_name' => !empty($sent_to_lab_name) ? $sent_to_lab_name : ''
            );
            $this->db->insert('uralensis_sent_to_lab', $sent_to_lab_data);
        } else {
            $sent_to_lab_data = array(
                'ura_sent_to_timestamp' => !empty($sent_to_lab_change_date) ? $sent_to_lab_change_date : '',
                'ura_sent_to_address' => !empty($sent_to_lab_location) ? $sent_to_lab_location : '',
                'ura_sent_to_name' => !empty($sent_to_lab_name) ? $sent_to_lab_name : ''
            );
            $this->db->where('ura_sent_to_id', $_POST['sent_to_lab_id']);
            $this->db->update('uralensis_sent_to_lab', $sent_to_lab_data);
        }
        $batch_msg = '<p class="alert alert-success">Batch Sent to Lab Information Successfully Updated.</p>';
        $this->session->set_flashdata('batch_sent_to_lab', $batch_msg);
        redirect('admin_tracking/tracking/update_tracking?batch_id=' . $bacth_id . '&name=' . $bacth_name . '&code=' . $bacth_code);
    }

    /**
     * Update Tracking Received From Lab
     *
     * @return void
     */
    public function update_tracking_rec_from_lab() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $bacth_id = $this->input->post('batch_id');
        $bacth_name = $this->input->post('batch_name');
        $bacth_code = $this->input->post('batch_code');
        $rec_pickup_datetime = $this->input->post('rec_pickup_datetime');
        $rec_pickup_change_date = date('Y-m-d h:i A', strtotime($rec_pickup_datetime));
        $rec_pickup_location = $this->input->post('rec_pickup_location');
        $rec_pickup_name = $this->input->post('rec_pickup_name');
        if (empty($_POST['rec_from_id'])) {
            $rec_pickup_data = array(
                'ura_rec_batch_id' => $bacth_id,
                'ura_rec_from_lab_timestamp' => !empty($rec_pickup_change_date) ? $rec_pickup_change_date : '',
                'ura_rec_from_lab_address' => !empty($rec_pickup_location) ? $rec_pickup_location : '',
                'ura_rec_from_lab_name' => !empty($rec_pickup_name) ? $rec_pickup_name : ''
            );
            $this->db->insert('uralensis_receive_from_lab', $rec_pickup_data);
        } else {
            $rec_pickup_data = array(
                'ura_rec_from_lab_timestamp' => !empty($rec_pickup_change_date) ? $rec_pickup_change_date : '',
                'ura_rec_from_lab_address' => !empty($rec_pickup_location) ? $rec_pickup_location : '',
                'ura_rec_from_lab_name' => !empty($rec_pickup_name) ? $rec_pickup_name : ''
            );
            $this->db->where('ura_rec_from_lab_id', $_POST['rec_from_id']);
            $this->db->update('uralensis_receive_from_lab', $rec_pickup_data);
        }
        $batch_msg = '<p class="alert alert-success">Batch Receive From Lab Information Successfully Updated.</p>';
        $this->session->set_flashdata('batch_rec_from_lab', $batch_msg);
        redirect('admin_tracking/tracking/update_tracking?batch_id=' . $bacth_id . '&name=' . $bacth_name . '&code=' . $bacth_code);
    }

    /**
     * Update Tracking Sent To Doctor
     *
     * @return void
     */
    public function update_tracking_sent_to_doc() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $bacth_id = $this->input->post('batch_id');
        $bacth_name = $this->input->post('batch_name');
        $bacth_code = $this->input->post('batch_code');
        $doc_pickup_datetime = $this->input->post('doc_pickup_datetime');
        $doc_pickup_change_date = date('Y-m-d h:i A', strtotime($doc_pickup_datetime));
        $doc_location = $this->input->post('doc_location');
        $doc_name = $this->input->post('doc_name');
        if (empty($_POST['sent_doc_id'])) {
            $doc_pickup_data = array(
                'ura_sent_doc_batch_id' => $bacth_id,
                'ura_sent_to_doc_timestamp' => !empty($doc_pickup_change_date) ? $doc_pickup_change_date : '',
                'ura_sent_to_doc_address' => !empty($doc_location) ? $doc_location : '',
                'ura_sent_to_doc_name' => !empty($doc_name) ? $doc_name : ''
            );
            $this->db->insert('uralensis_sent_to_doctor', $doc_pickup_data);
        } else {
            $doc_pickup_data = array(
                'ura_sent_to_doc_timestamp' => !empty($doc_pickup_change_date) ? $doc_pickup_change_date : '',
                'ura_sent_to_doc_address' => !empty($doc_location) ? $doc_location : '',
                'ura_sent_to_doc_name' => !empty($doc_name) ? $doc_name : ''
            );
            $this->db->where('ura_sent_to_doc_id', $_POST['sent_doc_id']);
            $this->db->update('uralensis_sent_to_doctor', $doc_pickup_data);
        }
        $batch_msg = '<p class="alert alert-success">Batch Sent to Doctor Information Successfully Updated.</p>';
        $this->session->set_flashdata('batch_sent_to_doc', $batch_msg);
        redirect('admin_tracking/tracking/update_tracking?batch_id=' . $bacth_id . '&name=' . $bacth_name . '&code=' . $bacth_code);
    }
    
    /**
     * Delete Tracking
     *
     * @param int $batch_id
     * @return void
     */
    public function delete_tracking($batch_id) 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->where('ura_track_batch_id', $batch_id);
        $this->db->delete('uralensis_track_batch');
        $this->db->where('ura_sent_batch_id', $batch_id);
        $this->db->delete('uralensis_sent_to_lab');
        $this->db->where('ura_rec_batch_id', $batch_id);
        $this->db->delete('uralensis_receive_from_lab');
        $this->db->where('ura_sent_doc_batch_id', $batch_id);
        $this->db->delete('uralensis_sent_to_doctor');
        $batch_msg = '<p class="alert alert-success">Batch Successfully Deleted.</p>';
        $this->session->set_flashdata('batch_delete', $batch_msg);
        redirect('admin_tracking/tracking/display_tracking');
    }

    /**
     * Change Batch Status
     *
     * @return void
     */
    public function change_batch_status() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $json = array();

        if (isset($_POST['status']) && $_POST['status'] !== 'false') {
            $batch_id = $this->input->post('batch_id');
            $batch_status = $this->input->post('status');
            $this->db->where('ura_track_batch_id', $batch_id);
            $this->db->update('uralensis_track_batch', array('ura_batch_status' => $batch_status));
            $json['type'] = 'success';
            $json['msg'] = '<div class="alert alert-success">Batch Status Updated Successfully. Refreshing...</div>';
            echo json_encode($json);
            die;
        } else {
            $json['type'] = 'error';
            $json['msg'] = '<div class="alert alert-danger">Please Select The Status First.</div>';
            echo json_encode($json);
            die;
        }
    }

    /**
     * Update batch Record
     *
     * @return void
     */
    public function update_batch_record() 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $bacth_id = $this->input->post('batch_id');
        $bacth_name = $this->input->post('edit_batch_name');
        $bacth_code = $this->input->post('edit_batch_code');
        $bacth_clinic_date = $this->input->post('edit_batch_clinic_date');
        $bacth_patients = $this->input->post('edit_batch_total_patients');
        $bacth_specimens = $this->input->post('edit_batch_total_specimens');
        $bacth_clinic_name = $this->input->post('edit_batch_clinic_name');
        $bacth_status = $this->input->post('edit_batch_status');
        $bacth_notes = $this->input->post('edit_batch_notes');
        $clinic_change_date = date('Y-m-d h:i A', strtotime($bacth_clinic_date));
        $upload_data = '';
        if ($_FILES['edit_batch_checklist']['tmp_name']) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 8192;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('edit_batch_checklist')) {
                $upload_data = array('upload_data' => $this->upload->data());
            }
        }

        $batch_data = array(
            'ura_track_batch_name' => !empty($bacth_name) ? $bacth_name : '',
            'ura_track_batch_code' => !empty($bacth_code) ? $bacth_code : '',
            'ura_batch_clinic_date' => !empty($clinic_change_date) ? $clinic_change_date : '',
            'ura_batch_clinic_name' => !empty($bacth_clinic_name) ? $bacth_clinic_name : '',
            'ura_batch_total_patients' => !empty($bacth_patients) ? $bacth_patients : '',
            'ura_batch_total_specimens' => !empty($bacth_specimens) ? $bacth_specimens : '',
            'ura_batch_status' => !empty($bacth_status) ? $bacth_status : '',
            'ura_batch_notes' => !empty($bacth_notes) ? $bacth_notes : '',
            'ura_batch_checklist_path' => !empty($upload_data['upload_data']['full_path']) ? $upload_data['upload_data']['full_path'] : '',
            'ura_batch_checklist_name' => !empty($upload_data['upload_data']['file_name']) ? $upload_data['upload_data']['file_name'] : ''
        );

        $this->db->where('ura_track_batch_id', $bacth_id);
        $this->db->update('uralensis_track_batch', $batch_data);
        $batch_msg = '<p class="alert alert-success">Batch Information Updated Successfully.</p>';
        $this->session->set_flashdata('batch_update_msg', $batch_msg);
        redirect('admin_tracking/tracking/update_tracking?batch_id=' . $bacth_id . '&name=' . $bacth_name . '&code=' . $bacth_code);
    }

}
