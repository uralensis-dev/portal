<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth Controller
 *
 * @package    CI
 * @subpackage Controller
 */
class Documents extends CI_Controller
{

    private $h_data = array('styles' => array('css/linearicons.css', 'css/patient/style.css'));
    private $f_data = array('javascripts' => array('js/documents/documents.js'));

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
        $this->load->model('DocumentsModel', 'patient');
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            return redirect('', 'refresh');
        }
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        if ($group_type != 'A' && $group_type != 'D' && $group_type != 'H' && $group_type != 'HA' && $group_type != 'L') 
		{
            //return redirect('', 'refresh');
        }
    }
   
   
    public function index()
    {   	     
        $data = array();
        $group_type = $this->ion_auth->get_users_groups()->row()->group_type;
        $data['upload_docs'] = $this->patient->get_upload_doc_forms();
        //pre($data);
        //$data['group_type'] = $group_type;
		//$data['hospitals'] = $this->documents->fetch_hospitals();
		$this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('documents/documents.php', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    /* Update Data */
    public function update_document_data() {
        $user_id = $this->ion_auth->user()->row()->id;
        //$hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

        $this->load->library('form_validation');
        $validationConfigArr = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'assign_to', 'label' => 'Assigned To', 'rules' => 'required'),
            array('field' => 'file_type', 'label' => 'Type', 'rules' => 'required')
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('upload_error', validation_errors());
            redirect('documents');
        }

        $editedId = $this->input->post('id');
        $upload_data = array(
            'name'          => $this->input->post('name'),
            'assign_to'     => $this->input->post('assign_to'),
            'file_type'     => $this->input->post('file_type'),
            'uploaded_by'   => !empty($user_id) ? $user_id : '',
            'uploaded_at'   => date('Y-m-d H:i:s')
        );

        if (isset($_FILES['upload_doc']) && $_FILES['upload_doc']['name'] != '') {
            $ref_key = $user_id;
            $upload_doc = $this->do_upload_files('upload_doc', $ref_key);
            if ($upload_doc === FALSE) {
                $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                redirect('documents');
            } else {
                $data = $this->upload->data();
                $checklist_file_name = $data['file_name'];
                $file_path = "admin_uploads/" . $checklist_file_name;
                $file_type = $this->input->post('file_type');
            }

            if (!empty($checklist_file_name)) {
                $upload_data['file_name'] = !empty($checklist_file_name) ? $checklist_file_name : '';
                $upload_data['file_path'] = !empty($file_path) ? $file_path : '';
            }
            $get_file_path = $this->db->query("SELECT * FROM uralensis_upload_forms WHERE id = $editedId ")->row()->file_path;
            if($get_file_path){
                unlink($get_file_path);
            }
        }


        $this->db->where('id', $editedId);
        $this->db->update('uralensis_upload_forms', $upload_data);
        $this->session->set_flashdata('upload_success', 'Data update successfully.');
        redirect('documents');

    }

    /* Upload Files */
    public function upload_files() {
        $user_id = $this->ion_auth->user()->row()->id;
        //$hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;

        $this->load->library('form_validation');
        $validationConfigArr = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'assign_to', 'label' => 'Assigned To', 'rules' => 'required'),
            array('field' => 'file_type', 'label' => 'Type', 'rules' => 'required')
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('upload_error', validation_errors());
            redirect('documents');
        }

        if (!isset($_FILES['upload_doc']) || $_FILES['upload_doc']['name'] == '') {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('upload_error', 'Please select a file');
            redirect('documents');
        }

        if (isset($_FILES['upload_doc']) && $_FILES['upload_doc']['name'] != '') {
            $ref_key = $user_id;
            $upload_doc = $this->do_upload_files('upload_doc', $ref_key);
            if ($upload_doc === FALSE) {
                $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                redirect('documents');
            } else {
                $data = $this->upload->data();
                $checklist_file_name = $data['file_name'];
                $file_path = "admin_uploads/" . $checklist_file_name;
                $file_type = $this->input->post('file_type');
            }

            if (!empty($checklist_file_name)) {
                $upload_data = array(
                    'file_name'     => !empty($checklist_file_name) ? $checklist_file_name : '',
                    'file_path'     => !empty($file_path) ? $file_path : '',
                    'file_type'     => !empty($file_type) ? $file_type : '',
                    'name'          => $this->input->post('name'),
                    'assign_to'     => $this->input->post('assign_to'),
                    'uploaded_by'   => !empty($user_id) ? $user_id : '',
                    'uploaded_at'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('uralensis_upload_forms', $upload_data);
                $this->session->set_flashdata('upload_success', 'File upload successfully.');
                redirect('documents');
            }
        }
    }

    /* Upload Files */
    public function do_upload_files($uploaded_file_name, $ref_key) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $config['upload_path'] = './admin_uploads/';
        $config['allowed_types'] = 'pdf|doc|png|jpeg|jpg';
        $config['max_size'] = 20400;
        $config['overwrite'] = TRUE;
        $new_name = $ref_key . '-' . $_FILES[$uploaded_file_name]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($uploaded_file_name)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /* Download Files */
    public function download_forms($filename) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('admin_uploads/' . $filename));
        force_download($filename, $data);
    }

    /* Delete Files */
    public function delete_upload_docs($file_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = $this->session->userdata('record_id');
        $admin_id = $this->ion_auth->user()->row()->id;
        if (isset($file_id) && isset($admin_id)) {
            $get_file_path_query = $this->db->query("SELECT * FROM uralensis_upload_forms WHERE id = $file_id ");
            $get_file_path = $get_file_path_query->result();
            $this->db->query("DELETE FROM uralensis_upload_forms WHERE id = $file_id");
            unlink($get_file_path[0]->file_path);
            $delete_file = '<p class="bg-warning" style="padding:7px;">File Successfully Deleted.</p>';
            $this->session->set_flashdata('delete_file', $delete_file);
            redirect('documents', 'refresh');
        }
    }

    /* Viewer List */
    public function viewer_list($file_id){
        $data = array();
        $data['viewer_list'] = $this->patient->get_uploaded_doc_viewer($file_id);
        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('documents/viewer_list.php', $data);
        //$this->load->view('templates/footer-new.php', $this->f_data);
    }


 public function view($id, $action = "", $field = "")
    {
        switch ($action) 
		{
            case "update":
                $this->_update_patient($id, $field);
				
                break;
            case "delete":
                $this->_delete_patient($id);
				
                break;
            case "":
                $this->_show_view_page($id);
				
                break;
            default:
                show_404();
        }
    }

    private function _show_view_page($id)
    {
        if (!is_numeric($id)) {
            show_404();
            return;
        }
        $data = array();
        try {
            $data['patient'] = $this->patient->get_patient_data($id);
            $dob_obj = date_create($data['patient']['dob']);
            $today = new DateTime();
            $diff = $today->diff($dob_obj);
            $age = $diff->y;
            $data['patient']['age'] = $age;
            $dob = date_format($dob_obj, "dS M, Y");
            $dob_format = date_format($dob_obj, "Y-m-d");
            $data['patient']['dob'] = $dob;
            $data['patient']['nhs_format'] = format_nhs_number($data['patient']['nhs_number']);
            $data['patient']['dob_format'] = $dob_format;

            $data['patient']['pid'] = $this->patient->get_patient_id($data['patient']['patient_id']);

            $data['patient']['address1'] = "";
            $data['patient']['address2'] = "";
            $address_line = $data['patient']['address_1'];
            if (!empty($address_line)) {
                $address_line = explode("\n", $address_line);
                $data['patient']['address1'] = $address_line[0];
                if (count($address_line) > 1) {
                    $data['patient']['address2'] = $address_line[1];
                }
            }
        } catch (\Exception $e) {
            show_404();
        }
        $data['records'] = $this->patient->get_patient_records($id);
        $data['profile_picture_path'] = $this->patient->get_profile_picture($id);
        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('patient/patient.php', $data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    private function _update_patient($id, $field)
    {
        if ($this->input->method() !== "post") 
		{
            $this->output->set_status_header(405);
            $this->output->set_output("Method not allowed");
            return;
        }
        switch ($field) 
		{
            case "picture":
                if (empty($_FILES['profile_pic']["name"]) || empty($id) || !is_numeric($id)) {
                    $this->output->set_status_header(400);
                    $this->output->set_output("Please provide patient id and picture");
                    return;
                }
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['file_name'] = time() . '-' . $_FILES['profile_pic']["name"];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile_pic')) {
                    $this->output->set_status_header(500);
                    $this->output->set_output($this->upload->display_errors("", ""));
                    return;
                }

                $filedata = array('upload_data' => $this->upload->data());
                $profile_image = $filedata['upload_data']['file_name'];
                $image_path = 'uploads/' . $config['file_name'];
                $profile_picture = $image_path;

                try {
                    $this->patient->set_profile_picture($id, $profile_picture);
                    custom_log("Patient Profile pic set");
                    // Profile safely uploaded
                    return;
                } catch (Exception $e) {
                    if ($e->getCode() === 404) {
                        $this->output->set_status_header(404);
                        $this->output->set_output("Patient does not exists");
                    } else if ($e->getCode() === 400) {
                        $this->output->set_status_header(500);
                        $this->output->set_output("Profile picture not uploaded");
                    }
                }
                break;

            case "profile":
                $address1 = $this->input->post('address1');
                $address2 = $this->input->post('address2');

                $address = "";

                if (empty($address1) && !empty($address2)) {
                    $address = $address2;
                }

                if (empty($address2) && !empty($address1)) {
                    $address = $address1;
                }

                if (!empty($address2) && !empty($address1)) {
                    $address = $address1 . '\n' . $address2;
                }

                $hospital_id = $this->input->post('group');

                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'nhs_number' => $this->input->post('nhs_number'),
                    'gender' => $this->input->post('gender'),
                    'dob' => $this->input->post('dob'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address_1' => $address,
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'post_code' => $this->input->post('post_code'),
                    'updated_at' => date("Y-m-d H:i:s")
                );

                $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
                $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
                $this->form_validation->set_rules('nhs_number', 'NHS Number', 'trim|required|exact_length[10]');
                $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

                $res = $this->db
                ->where("hospital_id = ".$hospital_id." AND id != ".$id." AND (email = '".$data['email']."' OR nhs_number = '".$data['nhs_number']."')")
                ->get("patients")->num_rows();

                if ($this->form_validation->run() == FALSE || $res > 0) {
                    custom_log(validation_errors(), 'Validation errors');
                    custom_log($res, 'Res');
                    $this->output->set_status_header(400);
                    echo "Invalid input";
                    return;
                }

                $this->db
                ->where('id', $id)
                ->update("patients", $data);

                redirect("/patient/view/".$id, "refresh");

                break;
            default:
                $this->output->set_status_header(404);
                $this->output->set_output("Field not found");
        }
    }

    private function _delete_patient($id)
    {
		if($id!='')
		{
			$count = $this->db->get_where('request', array('patient_id' => $id))->num_rows();
			if($count==0)
			{
				$this->db->where('id', $id);
				$this->db->delete('patients');
			}
		}
		redirect("/patient", "refresh");
		exit;
    }

    public function unique_email($patient_id = "")
    {
        $email = $this->input->get('email');
        $group_id = $this->input->get('group_id');
        if (empty($email)) {
            $this->output
                ->set_status_header(400);
            echo "Please provide email";
            return;
        }
        $res = 0;
        if ($patient_id === "") {
            $res = $this->db->get_where('patients', array('email' => $email, 'hospital_id' => $group_id))->num_rows();
        } else {
            $res = $this->db
                ->where("email", $email)
                ->where("hospital_id", $group_id)
                ->where("id !=", $patient_id)
                ->get("patients")->num_rows();
        }
        $this->output
            ->set_content_type('application/json');

        if ($res === 0) {
            $this->output
                ->set_output(json_encode(TRUE));
        } else {
            $this->output
                ->set_output(json_encode(FALSE));
        }
    }

    public function unique_nhs($patient_id = "")
    {
        $nhs_number = $this->input->get('nhs_number');
        $group_id = $this->input->get('group_id');
        if (empty($nhs_number)) {
            $this->output
                ->set_status_header(400);
            echo "Please provide nhs number";
            return;
        }
        $res = 0;
        if ($patient_id === "") {
            $res = $this->db->get_where('patients', array('nhs_number' => $nhs_number, 'hospital_id' => $group_id))->num_rows();
        } else {
            $res = $this->db
                ->where("nhs_number", $nhs_number)
                ->where("hospital_id", $group_id)
                ->where("id !=", $patient_id)
                ->get("patients")->num_rows();
        }
        $this->output
            ->set_content_type('application/json');

        if ($res === 0) {
            $this->output
                ->set_output(json_encode(TRUE));
        } else {
            $this->output
                ->set_output(json_encode(FALSE));
        }
    }

    public function get_documents()
    {
        $data = array('data' => array());
        $res = $this->patient->fetch_documents();
        foreach ($res as $p) {
           
            $patient = array(
                'id' => $p['id'],
				'nhs' => $p['nhs_number'],
                'name' => $p['first_name'],
                'dob' => $dob,
				'breed' => $p['breed'],
                'species' => $p['last_name'],
				'owner_name' => $p['owner_name'],
                'gender' => $p['gender'],
                'hospital' => $p['description'],
            );
            array_push($data['data'], $patient);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function add_patient()
    {
        $address1 = $this->input->post('address1');
        $address2 = $this->input->post('address2');

        $address = "";

        if (empty($address1) && !empty($address2)) {
            $address = $address2;
        }

        if (empty($address2) && !empty($address1)) {
            $address = $address1;
        }

        if (!empty($address2) && !empty($address1)) {
            $address = $address1 . '\n' . $address2;
        }


        $data = array(
            'hospital_id' => $this->input->post('group'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('species'),
			'nhs_number' => $this->input->post('animal_id'),
			'breed' => $this->input->post('breed'),
            'owner_name' => $this->input->post('owner_name'),
            'gender' => $this->input->post('gender'),
            'dob' => $this->input->post('dob'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address_1' => $address,
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'post_code' => $this->input->post('post_code'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $this->form_validation->set_rules('group', 'Hospital', 'required|integer');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
       // $this->form_validation->set_rules('nhs_number', 'NHS Number', 'trim|required|exact_length[10]');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $res = $this->db
        ->where("hospital_id = ".$data['hospital_id']." AND (email = '".$data['email']."' OR nhs_number = '".$data['nhs_number']."')")
        ->get("patients")->num_rows();

        if ($this->form_validation->run() == FALSE || $res > 0) {
            custom_log(validation_errors(), 'Validation errors');
            custom_log($res, 'Res');
            $this->output->set_status_header(400);
            echo "Invalid input";
            return;
        }

        $this->db->insert('patients', $data);
        echo "Patient added";
    }
}
