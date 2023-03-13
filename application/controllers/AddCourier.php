<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class AddCourier extends CI_Controller {
	private $group_id = 0;
	private $user_id = 0;
	private $group_type = "";

	/**
	 * Constructor to load models and helpers
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Ion_auth_model');
		$this->load->model('Institute_model');
		$this->load->model('Courier_model');
		$this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
		track_user_activity(); //Track user activity function which logs user track actions.

		$this->user_id = $this->ion_auth->user()->row()->id;
		$group_row = $this->ion_auth->get_users_groups()->row();
		$this->group_type = $group_row->group_type;
		$this->group_id = $group_row->id;
	}

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$data['javascripts'] = array(
			'subassets/js/new_jquery.datetimepicker.js',
			'js/custom_js/courier.js',
		);
		$data['styles'] = array(
			'subassets/css/new_jquery.datetimepicker.css',
		);

		$user_id = $this->ion_auth->user()->row()->id;

		$data['get_active_users'] = $this->Institute_model->get_active_directory_users();
//        echo $this->db->last_query();exit;
		$data['user_organizations'] = $this->Institute_model->get_user_institutes($user_id)->result();
		$data['user_data'] = $this->Institute_model->get_courier_users()->result();
		$data['ticketsCountData'] = $this->Institute_model->getCourierCounts($user_id);

		$data['tab_id'] = "consignment_tab";
		if ($_SERVER['REQUEST_METHOD'] == "POST" and !$this->input->post("sender_search_filter")) {
			$postMessage['tab_id'] = "courier_tab";
			$status = $this->input->post("status");
			if ($status == "courier_company") {
				$name = $this->input->post("courier_company_name");
				$prefix = 0;
				if ($this->input->post("courier_company_prefix")) {
					$prefix = 1;
				}
				// $checkStatus = $this->db->where(array("name" => $name))->select("*")->get("courier_companies")->row();
				$checkStatus = $this->db->where(array("name" => $name, "status" => 1))->select("*")->get("courier_companies")->row();
				if ($this->input->post("cid")) {
					$checkStatus = $this->db->where("name", $name)->where("id !=", $this->input->post("cid"))->where("status", 1)->select("*")->get("courier_companies")->row();
				}
				if (empty($checkStatus)) {
					$config = array(
						'upload_path' => "./uploads/",
						'allowed_types' => "gif|jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					);

					$fileUploaded = 0;
					if ($_FILES && !empty($_FILES['courier_company_logo']['name'][0])) {
						$this->load->library('upload', $config);
						if ($this->upload->do_upload("courier_company_logo")) {
							$data_file = $this->upload->data();
							$file_name = $data_file['file_name'];
							$fileUploaded = 1;
						} else {
							$postMessage['is_error'] = true;
							$postMessage['error_message'] = $this->upload->display_errors();
						}
					}
					if ($fileUploaded == 1 || $this->input->post("cid")) {
						$insData['name'] = $name;
						if ($fileUploaded) {
							$insData['logo'] = $file_name;
						}

						$insData['prefix'] = $prefix;
						if ($this->input->post("cid")) {
							$this->db->where('id', $this->input->post("cid"));
							$this->db->update('courier_companies', $insData);
						} else {
							$this->db->insert("courier_companies", $insData);
						}
					}

					// $this->load->library('upload', $config);
					// if ($this->upload->do_upload("courier_company_logo")) {
					//     $data_file = $this->upload->data();
					//     $file_name = $data_file['file_name'];
					//     $insData['name'] = $name;
					//     $insData['logo'] = $file_name;
					//     $insData['prefix'] = $prefix;
					//     $this->db->insert("courier_companies", $insData);
					// } else {
					//     $postMessage['is_error'] = true;
					//     $postMessage['error_message'] = $this->upload->display_errors();
					// }
				} else {
					$postMessage['is_error'] = true;
					$postMessage['error_message'] = "Company Already Exist";
				}
			} else if ($status == "courier_urgency") {
				$name = $this->input->post("courier_urgency");
				$prefix = 0;
				if ($this->input->post("courier_urgency_prefix")) {
					$prefix = 1;
				}
				$checkStatus = $this->db->where(array("urgency" => $name))->select("*")->get("courier_urgency")->row();
				if (empty($checkStatus)) {
					$insData['urgency'] = $name;
					$insData['prefix'] = $prefix;
					$this->db->insert("courier_urgency", $insData);
				} else {
					$postMessage['is_error'] = true;
					$postMessage['error_message'] = "Urgency Already Exist";
				}
			}
			$this->session->set_flashdata('sendData', $postMessage);
			redirect("AddCourier");
		}
		if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->input->post("sender_search_filter")) {
			$sender_type = $this->input->post("sender_search_filter");
			$data['couriers'] = $this->Institute_model->get_user_couriers(FALSE, $sender_type);
			$data['sender_type'] = $sender_type;
		} else {
			$data['sender_type'] = "all";
			$data['couriers'] = $this->Institute_model->get_user_couriers();
		}

		$data['courier_companies'] = $this->Institute_model->select_where("*", "courier_companies", array("status" => 1))->result();
		$data['courier_urgency'] = $this->Institute_model->select_where("*", "courier_urgency", array("status" => 1))->result();
		$data['group_type'] = $this->group_type;
//        echo $this->db->last_query();exit;
		//        echo "<pre>";
		//        print_r($data['group_type']);
		//        print_r($data['courier_urgency']);
		//        exit;

//        echo $this->ion_auth->get_users_groups()->row()->id;
		//        echo $this->ion_auth->get_user_group_type()->row()->id;
		//        echo "<pre>";print_r($data['user_organizations']);exit;

//        $this->db->select("`users`.`id` as id,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
		//            AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
		//            AES_DECRYPT(email, '" . DATA_KEY . "') AS email", FALSE);
		//        $this->db->join('users', 'users.id = users_groups.user_id');
		//        $this->db->join('groups', 'groups.id = users_groups.group_id');
		//        $this->db->where("group_type IN ('C','R','D','S','T')");
		//        $this->db->where('in_directory', TRUE);
		//        $this->db->order_by("`users`.`id`");
		//        $userIds = $this->db->get('users_groups')->result();

		$this->load->model('Userextramodel');
		$batchNo = $this->Institute_model->check_batch_no();
		$courierNo = $this->Institute_model->check_courier_no();
		$refNo = $this->Institute_model->courier_generate_reference_no();
		$data['generated_user_id'] = $this->Userextramodel->generate_userid($user_id);
		$data['batch_no'] = $batchNo;
		$data['courier_no'] = $courierNo;
		$data['ref_num'] = $refNo;

		$this->load->view('templates/header-new', $data);
		$this->load->view('courier/view', $data);
		$this->load->view('templates/footer-new', $data);
	}
	public function addFiles() {
		$courier_id = $this->input->post("fedit_id");
		$_POST['edit_id'] = $courier_id;
		if ($_FILES && !empty($_FILES['files']['name'][0])) {
			$this->upload_files($courier_id, "edit");
		}
		return redirect("/AddCourier", "refresh");
	}
	public function add() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$this->load->model('DepartmentModel', 'department');
		$batchNo = $this->Institute_model->check_batch_no();
		$courierNo = $this->Institute_model->check_courier_no();
		$refNo = $this->Institute_model->courier_generate_reference_no();
		$data['departments'] = array();
		if ($this->group_type === "A") {
			$data['departments'] = $this->department->fetch_departments();
		}
		if ($this->group_type === "H") {
			$data['departments'] = $this->department->get_hospital_department($this->group_id);
		}

		if ($this->input->post()) {
			$save_type = $this->input->post("save_type");
			if ($save_type == "edit") {
//                $_POST['initials'] = strtoupper(substr($_SESSION['first_name'], 0, 1)).strtoupper(substr($_SESSION['last_name'], 0, 1));
				//                $_POST['courier_no'] = date("y")."-".$courierNo;
				$courier_id = $this->input->post("edit_id");
				$_POST['edit_id'] = $courier_id;
				$_POST['sender_data'] = $this->getUserData($this->input->post('sender_search'));
				$_POST['receiver_data'] = $this->getUserData($this->input->post('receiver_search'));
//                echo "<pre>";print_r($_POST);exit;
				$insert_courier = $this->Institute_model->edit_couier();
				if ($insert_courier && $_FILES && !empty($_FILES['files']['name'][0])) {
					$this->db->delete('uralensis_upload_forms', ['courier_id' => $courier_id]);
					$this->upload_files($courier_id);
				}
				return redirect("/AddCourier", "refresh");
			} else {
				$json = array();
				$reference_no = $this->input->post('reference_no');
				$_POST['batch_no'] = date("y") . "-" . $batchNo;
				$_POST['initials'] = strtoupper(substr($_SESSION['first_name'], 0, 1)) . strtoupper(substr($_SESSION['last_name'], 0, 1));
				$_POST['courier_no'] = date("y") . "-" . $courierNo;
				$_POST['reference_no'] = $refNo;
				$_POST['sender_data'] = $this->getUserData($this->input->post('sender_search'));
				$_POST['receiver_data'] = $this->getUserData($this->input->post('receiver_search'));

				$check_existing_ref_no = $this->Institute_model->check_reference_no($reference_no);
				if ($check_existing_ref_no == 1) {
					$json['type'] = 'error';
					$json['msg'] = 'Reference No. already exists, please reload page';
					$this->session->set_flashdata('error', 'Reference No. already exists, please reload page');
					echo json_encode($json);
					die;
				}
				$return_courier_id = true;
				$courier_id = $this->Institute_model->add_courier($return_courier_id);
				if ($courier_id && $_FILES && !empty($_FILES['files']['name'][0])) {
					$this->upload_files($courier_id);
				}
				return redirect("/AddCourier", "refresh");
			}

			$json['type'] = 'success';
			$json['msg'] = 'Courier added successfully';
			$this->session->set_flashdata('success', 'Courier added successfully');
			echo json_encode($json);
			die;
		}

		$data['javascripts'] = array(
			'subassets/js/new_jquery.datetimepicker.js',
			'js/custom_js/courier.js',
		);
		$data['styles'] = array(
			'subassets/css/new_jquery.datetimepicker.css',
		);

		$this->db->select("`users`.`id` as id,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
            AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
            AES_DECRYPT(email, '" . DATA_KEY . "') AS email", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('groups', 'groups.id = users_groups.group_id');
		$this->db->where("group_type IN ('C','R','D','S','T')");
		$this->db->where('in_directory', TRUE);
		$this->db->order_by("`users`.`id`");
		$userIds = $this->db->get('users_groups')->result();

		$this->load->model('Userextramodel');
		$data['generated_user_id'] = $this->Userextramodel->generate_userid($this->ion_auth->user()->row()->id);
		$data['user_data'] = $userIds;
		$data['batch_no'] = $batchNo;
		$data['courier_no'] = $courierNo;
		$data['ref_num'] = $refNo;
		$this->load->view('templates/header-new', $data);
		$this->load->view('courier/add-courier', $data);
		$this->load->view('templates/footer-new', $data);

	}

	public function changeStatus($ticketID, $status) {
		if (isset($ticketID) && $ticketID != '0' && $ticketID != '') {
			switch ($status) {
			case 0:
				$status = NEW_COURIER;
				break;
			case 1:
				$status = READY_PRINT;
				break;
			case 2:
				$status = ORDER_CREATED;
				break;
			case 3:
				$status = LABEL_PRINTED;
				break;
			case 4:
				$status = MANIFESTED;
				break;
			case 5:
				$status = COLLECTED;
				break;
			case 6:
				$status = AT_DEPOT;
				break;
			case 7:
				$status = IN_TRANSIT;
				break;
			case 8:
				$status = DELIVERED;
				break;
			case 9:
				$status = COURIERISSUE;
				break;
			case 10:
				$status = NEWSTATUS;
				break;
			case 11:
				$status = ACKNOWLEDGE;
				break;
			default:
				$this->session->set_flashdata('error', TRUE);
				$this->session->set_flashdata('tckSuccessMsg', 'Invalid Status, Please Try Again.');
				redirect('AddCourier/', 'refresh');
				break;

			}

			$this->db->set('status', $status);

			$this->db->where('id ', $ticketID);
			$this->db->update('tbl_courier');

			$this->db->reset_query();
			$input_data['log_id'] = $this->session->userdata['activity_detail']['log_id'];
			$input_data['module_id'] = 5;
			$input_data['user_id'] = $this->ion_auth->user()->row()->id;
			$input_data['courier_id'] = $ticketID;
			$input_data['status'] = $status;
			$this->db->insert('courier_tracking', $input_data);

			$this->session->set_flashdata('inserted', TRUE);
			$this->session->set_flashdata('tckSuccessMsg', 'Courier Status Updated...');
			redirect('addCourier/', 'refresh');
		} else {
			$this->session->set_flashdata('error', TRUE);
			$this->session->set_flashdata('tckSuccessMsg', 'Invalid Courier, Please Try Again.');
			redirect('addCourier/', 'refresh');
		}

	}

	public function save_comments() {
		if ($this->input->post()) {
			$ticketID = $this->input->post("courier_id");
			$this->db->set('issue_comment', $this->input->post("courier_comment"));
			$this->db->set('status', COURIERISSUE);

			$this->db->where('id ', $ticketID);
			$this->db->update('tbl_courier');

			$this->db->reset_query();
			$input_data['log_id'] = $this->session->userdata['activity_detail']['log_id'];
			$input_data['module_id'] = 5;
			$input_data['user_id'] = $this->ion_auth->user()->row()->id;
			$input_data['courier_id'] = $ticketID;
			$input_data['status'] = COURIERISSUE;
			$input_data['remarks'] = $this->input->post("courier_comment");
			$this->db->insert('courier_tracking', $input_data);

			$this->session->set_flashdata('inserted', TRUE);
			$this->session->set_flashdata('tckSuccessMsg', 'Courier Status Updated...');
			$response['type'] = "success";
			$response['message'] = "Comments saved successfully";
			echo json_encode($response);
			exit;
		} else {
			$response['type'] = "fail";
			$response['message'] = "Comments not saved successfully";
			echo json_encode($response);
			exit;
		}

	}

	public function delete($ticketID) {
		if (isset($ticketID) && $ticketID != '0' && $ticketID != '' && is_numeric($ticketID)) {

			$this->db->set('active ', 0);
			$this->db->where('id ', $ticketID);
			$this->db->update('tbl_courier');
			$this->session->set_flashdata('inserted', TRUE);
			$this->session->set_flashdata('tckSuccessMsg', 'Courier Removed...');
			redirect('addCourier/', 'refresh');

		} else {
			$this->session->set_flashdata('error', TRUE);
			$this->session->set_flashdata('tckSuccessMsg', 'Invalid Ticket, Please Try Again.');
			redirect('addCourier/', 'refresh');
		}
	}

	public function getCourierData() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$dataId = $this->input->post("dataId");
		$data['couriers'] = $this->Institute_model->get_user_couriers($dataId);
		$returnData['html'] = $this->load->view('courier/edit_view', $data);
		echo json_encode($returnData);
		exit;

	}

	public function get_slides_data() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$json = array();
		$lab_no_html = "<div class='col'>Lab No.</div>";
		$no_slides_html = "<div class='col'>No. of Slides</div>";
		$comments_html = "<div class='col'>Comments</div>";
		if ($this->input->post('courier_id')) {
			$courier_id = $this->input->post('courier_id');
			$slides_list = $this->Institute_model->get_slides_columns($courier_id);
			if (!empty($slides_list)) {
				$slides_lab_no = json_decode($slides_list['slides_lab_no']);
				$slides_no_of_slides = json_decode($slides_list['slides_no_of_slides']);
				$slides_no_of_comments = json_decode($slides_list['slides_no_of_comments']);
				foreach ($slides_lab_no as $key => $value) {
					$lab_no_html .= "<div class='col'>$value</div>";
				}
				foreach ($slides_no_of_slides as $key => $value) {
					$no_slides_html .= "<div class='col'>$value</div>";
				}
				foreach ($slides_no_of_comments as $key => $value) {
					$comments_html .= "<div class='col'>$value</div>";
				}
			}
			$data['slide_lab'] = $lab_no_html;
			$data['slide_no_of_slides'] = $no_slides_html;
			$data['slide_comments'] = $comments_html;

			$json['type'] = 'success';
			$json['data'] = json_encode($data);
			$json['msg'] = 'Data found successfully';
			echo json_encode($json);
			die;
		}
	}

	public function get_blocks_data() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$json = array();
		$lab_no_html = "<div class='col'>Lab No.</div>";
		$no_blocks_html = "<div class='col'>No. of Blocks</div>";
		$comments_html = "<div class='col'>Comments</div>";
		if ($this->input->post('courier_id')) {
			$courier_id = $this->input->post('courier_id');
			$blocks_list = $this->Institute_model->get_blocks_columns($courier_id);
			if (!empty($blocks_list)) {
				$blocks_lab_no = json_decode($blocks_list['block_lab_no']);
				$blocks_no_of_slides = json_decode($blocks_list['block_block_no']);
				$blocks_no_of_comments = json_decode($blocks_list['block_comments']);
				foreach ($blocks_lab_no as $key => $value) {
					$lab_no_html .= "<div class='col'>$value</div>";
				}
				foreach ($blocks_no_of_slides as $key => $value) {
					$no_blocks_html .= "<div class='col'>$value</div>";
				}
				foreach ($blocks_no_of_comments as $key => $value) {
					$comments_html .= "<div class='col'>$value</div>";
				}
			}
			$data['block_lab'] = $lab_no_html;
			$data['block_no_of_blocks'] = $no_blocks_html;
			$data['block_comments'] = $comments_html;

			$json['type'] = 'success';
			$json['data'] = json_encode($data);
			$json['msg'] = 'Data found successfully';
			echo json_encode($json);
			die;
		}
	}

	public function get_other_data() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$json = array();
		$other_comment_html = "<div class='col'>Other Comments</div>";
		if ($this->input->post('courier_id')) {
			$courier_id = $this->input->post('courier_id');
			$other_cmnts_list = $this->Institute_model->get_other_comments_column($courier_id);
			if (!empty($other_cmnts_list)) {
				$other_comments_data = json_decode($other_cmnts_list['others_comments']);
				foreach ($other_comments_data as $key => $value) {
					$other_comment_html .= "<div class='col'>$value</div>";
				}
			}
			$data['other_comments'] = $other_comment_html;

			$json['type'] = 'success';
			$json['data'] = json_encode($data);
			$json['msg'] = 'Data found successfully';
			echo json_encode($json);
			die;
		}
	}

	public function update_courier_showing() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$courier_status = $this->input->post("status_value");
		$laboratoryId = $this->ion_auth->get_user_group_type()->row()->id;
		$insData['lab_hospital_id'] = $laboratoryId;
		$insData['status'] = $courier_status;

		$checkStatus = $this->db->where(array("lab_hospital_id" => $laboratoryId))->select('*')->get('courier_show_status')->row();
		if (empty($checkStatus)) {
			$this->db->insert("courier_show_status", $insData);
		} else {
			$this->db->where(array("lab_hospital_id" => $laboratoryId))->update("courier_show_status", $insData);
		}
		$response['status'] = "success";
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function search_emp_data() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		// $userInstitutes = $this->Institute_model->get_user_institutesdetails($_POST['dataId'])->result();
		$userInstitutes = $this->Institute_model->get_user_institutesdetails($_POST['dataId'])->result();
		$selected = (count($userInstitutes) == 1 ? "selected" : "");
		$select = "<option value=''>--Select--</option>";
		foreach ($userInstitutes as $institute) {
			$select .= "<option value='" . $institute->id . "' data-address='" . $institute->hosp_address . "' $selected>" . $institute->name . "</option>";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($select));
	}

	public function search_department_specimen() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$depId = $this->input->post('dataId');
		$this->db->select("st.spec_type_id as st_id,st.type as st_type,sg.spec_grp_id as sg_id");
		$this->db->join("specimen_type st", "st.spec_group_id=sg.spec_grp_id");
		$this->db->where("`sg`.`department_id`", $depId);
		$userData['result'] = $this->db->get('speciality_group sg')->result_array();

		$html = "";
		foreach ($userData['result'] as $dataD) {
			$html .= "<option value='" . $dataD['st_id'] . "'>" . $dataD['st_type'] . "</option>";
		}
		$userData['html'] = $html;
		echo json_encode($userData);
	}

	public function get_department() {
		if (!$this->ion_auth->logged_in()) {
			$this->output
				->set_status_header(405)
				->set_output("Not Authorized");
			return;
		}
		$this->load->model('DepartmentModel', 'department');
		if ($this->group_type === "A") {
			$departments = $this->department->fetch_departments();
			$this->output->set_content_type('application/json')->set_output(json_encode($departments));
		}
		if ($this->group_type === "H") {
			$departments = $this->department->get_hospital_department($this->group_id);
			$this->output->set_content_type('application/json')->set_output(json_encode($departments));
		}
		$this->output
			->set_status_header(405)
			->set_output("Not Authorized");
		return;
	}

	public function getUserData($dataId) {
		$this->db->select("`users`.`id` as id,CONCAT(AES_DECRYPT(first_name, '" . DATA_KEY . "'),' ',AES_DECRYPT(last_name, '" . DATA_KEY . "')) AS user_name,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        add1.meta_value as address1,add2.meta_value as address2,cunt.meta_value as county,cntr.meta_value as country,post.meta_value as postcode,
            ", FALSE);
		$this->db->join("usermeta add1", "add1.user_id=users.id AND add1.meta_key='address1'", "LEFT");
		$this->db->join("usermeta add2", "add2.user_id=users.id AND add2.meta_key='address2'", "LEFT");
		$this->db->join("usermeta cunt", "cunt.user_id=users.id AND cunt.meta_key='county'", "LEFT");
		$this->db->join("usermeta cntr", "cntr.user_id=users.id AND cntr.meta_key='country'", "LEFT");
		$this->db->join("usermeta post", "post.user_id=users.id AND post.meta_key='postcode'", "LEFT");
		$this->db->where("`users`.`id`", $dataId);
		$this->db->where('in_directory', TRUE);
		$userData = $this->db->get('users')->row_array();
		return json_encode($userData);
	}

	public function showCourierLog() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$data['styles'] = array(
			'css/daterangepicker.css',
		);
		$data['javascripts'] = array(
			'js/daterangepicker.js',
			'js/custom_js/courier.js');

//        $data['usersList'] = $this->Institute_model->get_institute_users()->result();
		$data['courier_log'] = array();
		if (isset($_GET['consignment_no']) and $_GET['consignment_no'] != "") {
			$data['courier_log'] = $this->Institute_model->get_courier_log($_GET['consignment_no'])->result();
		}
//        echo $this->db->last_query();exit;
		//        echo "<pre>";print_r($data['courier_log'] );exit;

		$this->load->view('templates/header-new', $data);
		$this->load->view('courier/courier_log', $data);
		$this->load->view('templates/footer-new', $data);
	}

	public function trackCourier($consignment_no) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$courier_id = base64_decode($consignment_no);
		$data['is_track'] = true;
		$data['courier_log'] = array();
		if ($consignment_no != "") {
			$data['courier_log'] = $this->Institute_model->get_courier_log($courier_id, true)->result();

		}
//        echo $this->db->last_query();exit;
		//        echo "<pre>";print_r($data['courier_log'] );exit;

		$this->load->view('templates/header-new', $data);
		$this->load->view('courier/courier_log', $data);
		$this->load->view('templates/footer-new', $data);
	}

	public function stamp_date_add($courier_no) {

		$flag = false;
		$msg = 'Something went wrong, Please Try Again.';
		if (!empty($courier_no) && $courier_no > 0) {
			$whereArr = ['id' => $courier_no];
			$row = $this->db->get_where('tbl_courier', $whereArr)->row();
			if (isset($row)) {
				$res = $this->db->where($whereArr)->update('tbl_courier', ['stamp_date' => date('Y-m-d H:i:s'), 'stamp_user_id' => $this->user_id]);
				if ($res) {
					$flag = true;
				}
				if (empty($row->stamp_date)) {

				} else {
					// $msg = 'Already stamp date added';
				}
			}
		}

		if ($flag) {
			$this->session->set_flashdata('success', TRUE);
			$this->session->set_flashdata('message', 'Stamp date & time add successfully.');
		} else {
			$this->session->set_flashdata('error', TRUE);
			$this->session->set_flashdata('message', $msg);
		}

		return redirect("/AddCourier", "refresh");
	}

	public function upload_files($courier_id, $type = '') {
		$user_id = $this->ion_auth->user()->row()->id;
		$user_name = $this->ion_auth->user()->row()->username;
		//$hospital_group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
		$checklist1 = false;
		if (isset($_FILES['files1']) && count($_FILES['files1']['name']) > 0) {
			$checklist1 = true;
		}
		if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0) {
			$ref_key = $user_id;

			$upload_doc = $this->do_upload_lab_files('files', $ref_key);

			if (!empty($upload_doc['error_upload'])) {
				$error = array('upload_error' => $this->upload->display_errors());
				$this->session->set_flashdata('upload_error', $error['upload_error']);
				//echo json_encode(['error' => true]);exit;
			}
			$dataArr = $upload_doc['success'];
			$count = 0;
			foreach ($dataArr as $data) {
				$checklist_file_name = $data['file_name'];
				$file_path = "lab_uploads/" . $checklist_file_name;
				$file_type = $_POST['file_type'];

				if (!empty($checklist_file_name)) {
					$sop_upload_data = array(
						'file_name' => !empty($checklist_file_name) ? $checklist_file_name : '',
						'file_path' => !empty($file_path) ? $file_path : '',
						'file_type' => !empty($file_type) ? $file_type : '',
						'courier_id' => $courier_id,
						'uploaded_by' => !empty($user_id) ? $user_id : '',
						'uploaded_at' => date('Y-m-d H:i:s'),
					);
					$tempCount = $this->db->insert('uralensis_upload_forms', $sop_upload_data);

					if ($tempCount) {
						$count++;
					}
					$file_name = explode(".", @$checklist_file_name);

					$reqArr = $this->db->get_where('request', ['pci_number' => $file_name[0]])->result_array();
					if (count($reqArr) > 0 && !empty($reqArr[0]['pci_number'])) {
						$record_id = $reqArr[0]['uralensis_request_id'];
						$file_tag = '';

						$data = array(
							'file_name' => $data['file_name'],
							'title' => $file_name[0],
							'file_path' => $data['full_path'],
							'file_ext' => $data['file_ext'],
							'is_image' => $data['is_image'],
							'user' => $user_name,
							'user_id' => $user_id,
							'record_id' => $record_id,
							'file_tag' => 'request',
						);
						$this->db->insert('files', $data);

					}
				}
			}

			if ($type == 'edit') {
				$recordInfo = $this->db->query("SELECT GROUP_CONCAT(DISTINCT u2f.file_name) as filesnames,
                GROUP_CONCAT(DISTINCT u2f.file_path) as filespaths,
                GROUP_CONCAT(DISTINCT u2f.id) as filesIds FROM uralensis_upload_forms as u2f INNER JOIN tbl_courier on tbl_courier.id = u2f.courier_id WHERE tbl_courier.id = $courier_id ")->row_array();
				$jsonResult['fileInfo'] = $recordInfo;
				echo json_encode($jsonResult);
				exit;
			}

			if ($count > 0) {
				$msg = ($count == 1) ? ' file is ' : ' files are ';
				$this->session->set_flashdata('upload_success', $count . $msg . 'upload successfully.');
			} else {
				$this->session->set_flashdata('upload_error', 'Something went wrong!');
			}
			if (!$checklist1) {
				return redirect("/AddCourier", "refresh");
				echo json_encode(['success' => true]);exit;
			}
			//redirect('laboratory');
		}

		//Checklist 1

		if (isset($_FILES['files1']) && count($_FILES['files1']['name']) > 0) {
			$ref_key = $user_id;

			$upload_doc = $this->do_upload_lab_files('files1', $ref_key);

			if (!empty($upload_doc['error_upload'])) {
				$error = array('upload_error' => $this->upload->display_errors());
				$this->session->set_flashdata('upload_error', $error['upload_error']);
				//echo json_encode(['error' => true]);exit;
			}
			$dataArr = $upload_doc['success'];
			$count = 0;
			foreach ($dataArr as $data) {
				$checklist_file_name = $data['file_name'];
				$file_path = "lab_uploads/" . $checklist_file_name;
				$file_type = $_POST['file_type1'];

				if (!empty($checklist_file_name)) {
					$sop_upload_data = array(
						'file_name' => !empty($checklist_file_name) ? $checklist_file_name : '',
						'file_path' => !empty($file_path) ? $file_path : '',
						'file_type' => !empty($file_type) ? $file_type : '',
						'courier_id' => $courier_id,
						'uploaded_by' => !empty($user_id) ? $user_id : '',
						'uploaded_at' => date('Y-m-d H:i:s'),
					);
					$tempCount = $this->db->insert('uralensis_upload_forms', $sop_upload_data);

					if ($tempCount) {
						$count++;
					}
					$file_name = explode(".", @$checklist_file_name);

					$reqArr = $this->db->get_where('request', ['pci_number' => $file_name[0]])->result_array();
					if (count($reqArr) > 0 && !empty($reqArr[0]['pci_number'])) {
						$record_id = $reqArr[0]['uralensis_request_id'];
						$file_tag = '';

						$data = array(
							'file_name' => $data['file_name'],
							'title' => $file_name[0],
							'file_path' => $data['full_path'],
							'file_ext' => $data['file_ext'],
							'is_image' => $data['is_image'],
							'user' => $user_name,
							'user_id' => $user_id,
							'record_id' => $record_id,
							'file_tag' => 'request',
						);
						$this->db->insert('files', $data);

					}
				}
			}

			if ($count > 0) {
				$msg = ($count == 1) ? ' file is ' : ' files are ';
				$this->session->set_flashdata('upload_success', $count . $msg . 'upload successfully.');
			} else {
				$this->session->set_flashdata('upload_error', 'Something went wrong!');
			}
			return redirect("/AddCourier", "refresh");
			echo json_encode(['success' => true]);exit;
			//redirect('laboratory');
		}

	}

	/* Upload files when add-courier */
	public function do_upload_lab_files($lab_file_name, $ref_key) {

		$config['upload_path'] = './lab_uploads/';
		$config['allowed_types'] = 'pdf|doc|xls|xlsx|png|jpeg|jpg|docx|otd|odtx|exls|exl';
		$config['max_size'] = 2040000;
		$config['overwrite'] = TRUE;
		$file = $_FILES;
		$errorUploadType = '';
		$filesCount = count($_FILES[$lab_file_name]['name']);
		for ($i = 0; $i < $filesCount; $i++) {
			$_FILES['files']['name'] = $file[$lab_file_name]['name'][$i];
			$_FILES['files']['type'] = $file[$lab_file_name]['type'][$i];
			$_FILES['files']['tmp_name'] = $file[$lab_file_name]['tmp_name'][$i];
			$_FILES['files']['error'] = $file[$lab_file_name]['error'][$i];
			$_FILES['files']['size'] = $file[$lab_file_name]['size'][$i];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('files')) {
				$fileData[] = $this->upload->data();
			} else {
				$errorUploadType .= $_FILES['file']['name'] . ' | ';
			}
		}

		return ['error_upload' => $errorUploadType, 'success' => $fileData];
	}

	public function delete_courier_company() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$company_id = $this->input->post("company_id");
		$response['status'] = "fail";
		$this->db->set('status', 0);
		$this->db->where('id ', $company_id);
		if ($this->db->update('courier_companies')) {
			$this->db->set('courier_company', 0);
			$this->db->set('active', 0);
			$this->db->where('courier_company ', $company_id);
			$this->db->update('tbl_courier');
			$response['status'] = "success";
		}
		echo json_encode($response);
		exit;
	}
	public function deleteChecklistFile() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$result['status'] = 'fail';

		$fileInfo = $this->db->where(array("id" => $this->input->post('fid')))->select("*")->get("uralensis_upload_forms")->row_array();
		if (count($fileInfo) > 0) {
			// $this->db->delete('uralensis_upload_forms', ['id' => $this->input->post('fid')]);
			
			if ($this->db->delete('uralensis_upload_forms', ['id' => $this->input->post('fid')])) {
				unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $fileInfo['file_path']);
				$remainingInfo = $this->db->where(array("courier_id" => $this->input->post('cid')))->select("GROUP_CONCAT(DISTINCT u2f.file_name) as filesnames,
                GROUP_CONCAT(DISTINCT u2f.file_path) as filespaths,
                GROUP_CONCAT(DISTINCT u2f.id) as filesIds")->get("uralensis_upload_forms u2f");
				$result['status'] = 'success';
				$result['filesnames'] = $remainingInfo['filesnames'];
				$result['filespaths'] = $remainingInfo['filespaths'];
				$result['filesIds'] = $remainingInfo['filesIds'];
			}
		}
		echo json_encode($result);
		exit;
	}
}
