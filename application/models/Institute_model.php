<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Institute Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Institute_model extends CI_Model {

	var $table = 'request';
	var $column_order = array(null, null, null, null, null, null, null, null, null, null, null, null, null); //set column field database for datatable orderable
	var $column_search = array('serial_number', 'f_name', 'sur_name', 'emis_number', 'nhs_number', 'lab_number', 'gender'); //set column field database for datatable searchable
	var $order = array('uralensis_request_id' => 'asc'); // default order

	/**
	 * Get Published Record Query
	 * For Datatables
	 *
	 * @return void
	 */

	private function _get_datatables_published_record_query() {

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$this->db->select('req.uralensis_request_id,req.ura_barcode_no,req.serial_number,req.f_name,req.pci_number,req.sur_name,req.emis_number,req.nhs_number,req.lab_number,req.gender,req.request_datetime,req.specimen_publish_status,req.status,req.hospital_group_id,ur.request_id,ur.group_id,grp.id');
		$this->db->from($this->table . ' AS req');
		$this->db->join('users_request AS ur', 'ur.request_id = req.uralensis_request_id', 'INNER');
		$this->db->join('`groups` AS grp', 'grp.id = ur.group_id', 'INNER');
		$this->db->where('ur.group_id', $group_id);
		$this->db->where('req.specimen_publish_status', '0');
		$this->db->order_by('req.uralensis_request_id', 'ASC');
		$where_not_exists = "NOT EXISTS(
      SELECT reqv.request_viewed_id,reqv.user_viewed_id,reqv.user_group_id FROM request_viewed AS reqv WHERE
      req.uralensis_request_id = reqv.request_viewed_id
      AND reqv.user_group_id = $group_id
    )";

		$this->db->where($where_not_exists);

		$i = 0;
		foreach ($this->column_search as $item) {
			// loop column
			if ($_POST['search']['value']) {
				// if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
				{
					$this->db->group_end();
				}
				//close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			// here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	/**
	 * Display Published Records
	 *
	 * @return void
	 */
	public function display_published_records() {
		$this->_get_datatables_published_record_query();
		if ($_POST['length'] != -1) {
			$this->db->limit(intval($_POST['length']), $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Count Published Records Filter
	 *
	 * @return void
	 */
	public function published_record_count_filtered() {
		$this->_get_datatables_published_record_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	/**
	 * Count All Published Records
	 *
	 * @return void
	 */
	public function published_record_count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_allhos_information($group_id) {

		if ($group_id > 0) {
			$this->db->select('*');
			$this->db->from('hospital_information li');
			$this->db->join('groups gr', 'gr.id = li.group_id');
			$this->db->where('gr.group_type', 'H');
			$result = $this->db->get()->result_array();
			$response = array();
			if (!empty($result)) {
				$response = $result;
			}
		} else {
			$this->db->select('*');
			$this->db->from('hospital_information li');
			$this->db->join('groups gr', 'gr.id = li.group_id');
			$this->db->where('gr.group_type', 'H');
			$result = $this->db->get()->result_array();
			$response = array();
			if (!empty($result)) {
				$response = $result;
			}
		}
		//print "<pre>";
		//print_r($response);
		//exit;
		return $response;
	}

	private function _get_datatables_viewed_record_query($year) {

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
		$this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
		$this->db->where('users_request.group_id', $group_id);
		$this->db->where('request.specimen_publish_status', '1');
		$where_not_exists = " EXISTS(
      SELECT * FROM request_viewed WHERE
      request.uralensis_request_id = request_viewed.request_viewed_id
      AND request_viewed.user_group_id = $group_id
      AND request_viewed.user_viewed_id = $user_id
    )";
		//
		$this->db->where($where_not_exists);
		$this->db->where('YEAR(request_datetime)', $year);

		$i = 0;
		foreach ($this->column_search as $item) {
			// loop column
			if ($_POST['search']['value']) {
				// if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
				{
					$this->db->group_end();
				}
				//close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			// here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	/**
	 * Display Viewed Records
	 *
	 * @param string $year
	 * @return void
	 */
	public function display_viewed_records($year) {
		$this->_get_datatables_viewed_record_query($year);
		if ($_POST['length'] != -1) {
			$this->db->limit(intval($_POST['length']), $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Viewed Records Count Filter
	 *
	 * @param [type] $year
	 * @return void
	 */
	public function viewed_record_count_filtered($year) {
		$this->_get_datatables_viewed_record_query($year);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/**
	 * Viewed Records Count All
	 *
	 * @return void
	 */

	public function viewed_record_count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	/**
	 * Add Record
	 *
	 * @param array $request
	 * @return void
	 */
	public function institute_insert($request) {

		$this->db->insert("request", $request);
		$id = $this->db->insert_id();
		$session_data = array(
			'id' => $id,
		);
		$this->session->set_userdata($session_data);
	}

	/**
	 * Insert Record Specimen
	 *
	 * @param array $specimen
	 * @return void
	 */
	public function insert_specimen($specimen) {
		$this->db->insert("specimen", $specimen);
		$specimen_id = $this->db->insert_id();
		$session_data = array(
			'specimen_id' => $specimen_id,
		);
		$this->session->set_userdata($session_data);
		if ($this->db->affected_rows() > 0) {
			echo 'Record Inserted';
		} else {
			echo 'Record Not Inserted';
		}
	}

	/**
	 * Get Specimen Type
	 *
	 * @return void
	 */
	public function specimen_type() {
		$query = $this->db->get('request_type');
		return $query->result();
	}

	/**
	 * View Record Detail
	 *
	 * @return void
	 */
	public function view_request_detail() {
		$query = $this->db->get('request');
		return $query->result();
	}

	/**
	 * Assign Record to user
	 *
	 * @return void
	 */
	public function request_assign() {
		$user_id = $this->ion_auth->user()->row()->id;
		$req_id = $this->session->userdata('id');
		$req_spec = array('request_id' => $req_id, 'users_id' => $user_id);
		$this->db->insert("users_request", $req_spec);
	}

	/**
	 * Add Specimen against record
	 *
	 * @return void
	 */
	public function request_specimen_add() {
		$request_id = $this->session->userdata('id');
		$specimen_id = $this->session->userdata('specimen_id');

		$data = array('rs_request_id' => $request_id, 'rs_specimen_id' => $specimen_idcount_total_users);
		$this->db->insert('request_specimen', $data);
	}

	/**
	 * View Record Detail
	 *
	 * @return void
	 */
	public function view_final_record() {
		// $user_id = $this->ion_auth->user()->row()->id;
		// $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

		// $query = $this->db->query("SELECT * FROM request INNER JOIN
		// users_request INNER JOIN `groups`
		// WHERE users_request.request_id = request.uralensis_request_id
		// AND groups.id = users_request.group_id

		// AND users_request.group_id = $group_id
		// AND request.specimen_publish_status = 0"
		// );
		// if ($query->num_rows() > 0) {
		//     foreach ($query->result_array() as $row) {
		//         $data[] = $row;
		//     }
		// }
		// return $query->result();

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$group_id[] = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$groupsInfo = $this->ion_auth->get_users_main_groups($user_id)->result_array();
		if (count($groupsInfo) > 1) {
			$groupIdDetails = $this->ion_auth->get_users_groups()->row();
			if ($groupIdDetails->group_type == 'HA' || $groupIdDetails->group_type == 'C' || $groupIdDetails->group_type == 'HD' || $groupIdDetails->group_type == 'HS') {
				$mainGroup = 'H';
			}
			if ($groupIdDetails->group_type == 'LC' || $groupIdDetails->group_type == 'DE' || $groupIdDetails->group_type == 'LS' || $groupIdDetails->group_type == 'LA') {
				$mainGroup = 'L';
			}
			foreach ($groupsInfo as $gkey => $grp) {
				if ($grp['group_type'] == $mainGroup) {
					$group_id[] = $grp['id'];
				}
			}
		}
		$group_ids = implode(",", $group_id);
		// $filter = " AND request.hospital_group_id IN ($group_id)";
		$filter = " AND users_request.group_id IN ($group_ids)";

		$query = $this->db->query("SELECT *, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number, count(DISTINCT(specimen.specimen_id)) as speciman_no FROM request
            INNER JOIN users_request
            INNER JOIN groups
            LEFT JOIN users ON request.request_add_user = users.id
            LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
            LEFT JOIN specimen on specimen.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = users_request.request_id
            AND request.specimen_publish_status = 0
            AND request.publish_status = 0
            AND groups.id = users_request.group_id
            $filter  GROUP BY `request`.`uralensis_request_id`");
		//GROUP BY request.uralensis_request_id
		//    echo $this->db->last_query(); exit;
		/*AND request.request_add_user = $lab_id */

		$resArr = $query->result();
		foreach ($resArr as $key => $row) {
			$description = $this->db->get_where('section_comments', ['record_id' => $row->uralensis_request_id])->row()->description;
			$resArr[$key]->description = (isset($description)) ? $description : '';
		}
		return $resArr;
	}

	/**
	 * View Single Record
	 *
	 * @param int $id
	 * @return void
	 */
	public function request_singlerecord($id) {
		$query1 = $this->db->query("SELECT * FROM request WHERE request.uralensis_request_id = $id");
		return $query1->result();
	}

	public function getCourierNo($user_id) {

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$query = $this->db->query("SELECT * FROM tbl_courier WHERE (sender_organization='$group_id' or receiver_organization='$group_id') and active = 1  order by created_at desc");
		return $query->result();
	}

	public function getCourierData($user_id, $courier_no) {
		$query = $this->db->query("SELECT * FROM tbl_courier WHERE courier_no = '$courier_no' AND created_by = $user_id");
		return $query->row();
	}

	/**
	 * View Single Record Specimen
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function request_singlerecord_specimen($id) {
		$query2 = $this->db->query("SELECT DISTINCT * FROM request_specimen
        INNER JOIN request
        INNER JOIN specimen
        WHERE request_specimen.rs_request_id = $id
        AND request.uralensis_request_id = $id
        AND request.uralensis_request_id = request_specimen.rs_request_id
        AND request.uralensis_request_id = specimen.request_id
        AND specimen.specimen_id = request_specimen.rs_specimen_id");
		return $query2->result();
	}

	/**
	 * View Record Detail
	 *
	 * @param int $id
	 * @return array
	 */
	public function doctor_record_detail($id) {
		$query1 = $this->db->query("SELECT uralensis_request_id, record_batch_id, serial_number,
        ura_barcode_no, patient_initial, pci_number, request_datetime, publish_datetime, publish_datetime_modified,
        emis_number, nhs_number, lab_number, hos_number, sur_name,
        f_name, dob, age, lab_name, date_received_bylab, data_processed_bylab,
        date_sent_touralensis, date_rec_by_doctor, gender, clrk, dermatological_surgeon,
        date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id, status, assign_status,
        specimen_update_status, specimen_publish_status, further_work_status, supplementary_report_status,
        supplementary_review_status, report_status, publish_status, hospital_group_id, additional_data_state,
        comment_section, comment_section_date, teaching_case, mdt_case, mdt_case_status, mdt_list_id, mdt_specimen_status,
        mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, mdt_case_add_to_report_status, mdt_outcome_text,
        fw_levels, fw_immunos, fw_imf, special_notes, special_notes_date, record_secretary_id, record_assign_sec_time,
        record_secretary_status, secretary_record_edit_status, cases_category, cost_codes, flag_status, authorize_status,
        request_add_user, request_add_user_timestamp, clinic_ref_number, clinic_request_form, request_code_status,
        record_edit_status, request_assign_status, ura_rec_temp_dataset,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,
        AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM request
        INNER JOIN users
        INNER JOIN users_request
        WHERE request.uralensis_request_id = $id
        AND users_request.request_id = $id
        AND users.id = users_request.doctor_id");
		$session_data = array(
			'id' => $id,
		);
		$this->session->set_userdata($session_data);
		return $query1->result();
	}

	/**
	 * This Methos Will only return the Hospital Information
	 *
	 * @param int $id
	 * @return array
	 */
	public function get_hospital_info($id) {
		$query = $this->db->query("SELECT * FROM `groups`
        INNER JOIN request
        INNER JOIN users_request
        WHERE request.uralensis_request_id = $id
        AND users_request.request_id = request.uralensis_request_id
        AND groups.id = request.hospital_group_id");
		return $query->result();
	}

	/**
	 * Record Detail Specimen
	 *
	 * @param int $id
	 * @return array
	 */
	public function doctor_record_detail_specimen($id) {
		$query2 = $this->db->query("SELECT uralensis_request_id,
        record_batch_id, serial_number, ura_barcode_no,
        patient_initial, pci_number, request_datetime,
        publish_datetime, publish_datetime_modified, emis_number,
        nhs_number, lab_number, hos_number, sur_name, f_name,
        dob, age, lab_name, date_received_bylab, data_processed_bylab,
        date_sent_touralensis, date_rec_by_doctor, gender,
        clrk, dermatological_surgeon, date_taken, urgent, hsc,
        report_urgency, cl_detail, request.specimen_id, status, assign_status,
        specimen_update_status, specimen_publish_status,
        further_work_status, supplementary_report_status,
        supplementary_review_status, report_status, publish_status,
        hospital_group_id, additional_data_state, comment_section,
        comment_section_date, teaching_case, mdt_case, mdt_case_status,
        mdt_list_id, mdt_specimen_status, mdt_case_assignee_username,
        mdt_case_msg, mdt_case_msg_timestamp, mdt_case_add_to_report_status,
        mdt_outcome_text, fw_levels, fw_immunos, fw_imf, special_notes,
        special_notes_date, record_secretary_id, record_assign_sec_time,
        record_secretary_status, secretary_record_edit_status,
        cases_category, cost_codes, flag_status, authorize_status,
        request_add_user, request_add_user_timestamp, clinic_ref_number,
        clinic_request_form, request_code_status, record_edit_status,
        request_assign_status, ura_rec_temp_dataset,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username,
        specimen.specimen_id, specimen.request_id, specimen_clinical_history,
        specimen_site, specimen_procedure, specimen_type,
        specimen_block, specimen_slides, specimen_block_type,
        specimen_macroscopic_code, specimen_macroscopic_description,
        specimen_info_save_code, specimen_info_save_description,
        specimen_microscopic_code, specimen_microscopic_description,
        specimen_diagnosis_code, specimen_diagnosis_description,
        specimen_comment_code, specimen_comment_description,
        specimen_snomed_code, specimen_snomed_description, specimen_snomed_t,
        specimen_snomed_t2, specimen_snomed_p, specimen_snomed_m,
        specimen_information_code, specimen_information_description,
        specimen_status, specimen_cancer_register, specimen_right,
        specimen_left, specimen_na, specimen_urgent, specimen_hsc_205,
        specimen_rcpath_code, specimen_benign, specimen_atypical,
        specimen_malignant, specimen_inflammation, specimen_accepted_by,
        specimen_assisted_by, specimen_labelled_by, specimen_cutup_by,
        specimen_block_checked_by, specimen_qc_by, specimen_comment_section,
        specimen_comment_section_timestamp, specimen_special_notes,
        specimen_special_notes_timestamp, specimen_feedback_to_lab,
        specimen_feedback_to_lab_timestamp, specimen_feedback_to_secretary,
        specimen_feedback_to_secretary_timestamp, specimen_error_log,
        specimen_error_log_timestamp FROM request
        INNER JOIN specimen
        INNER JOIN users
        INNER JOIN users_request
        WHERE request.uralensis_request_id = $id
        AND specimen.request_id = $id
        AND users_request.request_id = $id
        AND users.id = users_request.doctor_id");
		$session_data = array(
			'id' => $id,
		);
		$this->session->set_userdata($session_data);
		return $query2->result();
	}

	/**
	 * This Code will get the additional work detail
	 *
	 * @param int $id
	 * @return array
	 */
	public function get_additional_work($id) {
		$query = $this->db->query("SELECT * FROM request
        INNER JOIN additional_work
        WHERE request.uralensis_request_id = $id
        AND additional_work.request_id = $id
        AND data_state = 'save_data'");
		return $query->result();
	}

	/**
	 * Display Further Work
	 *
	 * @return array
	 */
	public function further_view() {

		// if (!$this->ion_auth->logged_in()) {
		//     redirect('auth/login', 'refresh');
		// }

		// $user_id = $this->ion_auth->user()->row()->id;
		// $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		// $labIdStr = $this->getLabIdsFromUser($user_id);
		// $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
		// $filter = " AND request.lab_id IN ($labIds)";
		// $query = $this->db->query(
		//     "SELECT
		// AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
		// AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
		// AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
		// AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
		// AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.id,
		// AES_DECRYPT(username, '" . DATA_KEY . "') AS username ,
		// further_work.fw_id,
		// further_work.request_id,
		// further_work.furtherword_description,
		// further_work.furtherwork_date,
		// further_work.furtherwork_status,
		// further_work.furtherwork_to_emails,
		// further_work.hospital_id,
		// further_work.doctor_id,
		// further_work.group_id,
		// further_work.fw_status,
		// further_work.fw_preview_template,
		// request.uralensis_request_id,
		// request.record_batch_id,
		// request.serial_number,
		// request.ura_barcode_no,
		// request.patient_initial,
		// request.pci_number,
		// request.request_datetime,
		// request.publish_datetime,
		// request.publish_datetime_modified,
		// request.emis_number,
		// request.nhs_number,
		// request.lab_number,
		// request.hos_number,
		// request.sur_name,
		// request.f_name, request.dob, request.age, request.lab_name, request.date_received_bylab,
		// request.data_processed_bylab, request.date_sent_touralensis, request.date_rec_by_doctor,
		// request.gender, request.clrk, request.dermatological_surgeon, request.date_taken, request.urgent,
		// request.hsc, request.report_urgency, request.cl_detail, request.specimen_id, request.status,
		// request.assign_status, request.specimen_update_status, request.specimen_publish_status,
		// request.further_work_status, request.supplementary_report_status,
		// request.supplementary_review_status, request.report_status, request.publish_status,
		// request.hospital_group_id, request.additional_data_state, request.comment_section,
		// request.comment_section_date, request.teaching_case, request.mdt_case,
		// request.mdt_case_status, request.mdt_list_id, request.mdt_specimen_status,
		// request.mdt_case_assignee_username, request.mdt_case_msg, request.mdt_case_msg_timestamp,
		// request.mdt_case_add_to_report_status, request.mdt_outcome_text, request.fw_levels,
		// request.fw_immunos, request.fw_imf, request.special_notes, request.special_notes_date,
		// request.record_secretary_id, request.record_assign_sec_time, request.record_secretary_status,
		// request.secretary_record_edit_status, request.cases_category, request.cost_codes,
		// request.flag_status, request.authorize_status, request.request_add_user,
		// request.request_add_user_timestamp, request.clinic_ref_number, request.clinic_request_form,
		// request.request_code_status, request.record_edit_status, request.request_assign_status,
		// request.ura_rec_temp_dataset,
		// groups.id, groups.name, groups.first_initial, groups.last_initial, groups.description,
		// groups.information, groups.group_type, groups.lab_mask, groups.user_lab_default_status
		// FROM further_work
		// INNER JOIN `groups`
		// INNER JOIN request
		// INNER JOIN users
		// INNER JOIN request_assignee
		// INNER JOIN users_request
		// WHERE further_work.request_id = request.uralensis_request_id
		// AND groups.id = users_request.group_id
		// AND request_assignee.user_id = further_work.doctor_id
		// AND further_work.doctor_id = users.id
		// AND request_assignee.request_id = further_work.request_id
		// AND users_request.request_id = request.uralensis_request_id $filter"
		// );
		// /*AND users_request.group_id = $group_id*/
		// return $query->result();

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		// $user_id = $this->ion_auth->user()->row()->id;
		// $labIdStr = $this->getLabIdsFromUser($user_id);
		// $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
		// $filter = " AND request.lab_id IN ($labIds)";
		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$filter = " AND request.hospital_group_id IN ($group_id)";

		$query = $this->db->query(
			"SELECT further_work.fw_id,further_work.furtherwork_date,further_work.fw_status,
                                    request.uralensis_request_id as request_id,
                                    requester.id,
                                    request.serial_number,
                                    request.lab_number,
                                    request.nhs_number,
                                    request.request_datetime,
                                    request.date_taken,
                                    request.hospital_group_id,
                                    request.date_sent_touralensis,
                                    request.hospital_group_id,
                                    request.data_processed_bylab,
                                    request.date_received_bylab,
                                    request.publish_datetime,
                                    request.date_rec_by_doctor,

                                    CONCAT(p1.first_name,' ' ,p1.last_name) AS patient_name,
                                    sp.description as test_name,
                                    CONCAT(AES_DECRYPT(pathologist.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(pathologist.last_name, '" . DATA_KEY . "')) AS pathologist,
                                    CONCAT(AES_DECRYPT(requester.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(requester.last_name, '" . DATA_KEY . "')) AS requester,
                                    sp.id as further_status_id,sp.block_no as further_block_no,sp.description as further_test_name, sp.fw_status as further_starus

            FROM further_work
                INNER JOIN request ON further_work.request_id=request.uralensis_request_id
                LEFT JOIN further_work_detail as fwd ON fwd.further_work_id=further_work.fw_id
                LEFT JOIN specimen_blocks as sp ON sp.specimen_id=fwd.block_id
                LEFT JOIN laboratory_tests as lt ON lt.id=fwd.test_id
                LEFT JOIN users as requester ON requester.id=request.request_add_user
                LEFT JOIN users as pathologist ON pathologist.id=sp.created_by
                LEFT JOIN patients as p1 ON p1.id=request.patient_id

                WHERE request.uralensis_request_id = further_work.request_id
                    AND further_work.fw_status = 'requested' AND sp.created_by!=0 $filter
                    GROUP BY further_status_id "
		);
		/* AND users.id = $user_id */

		return $query->result();
	}

	/**
	 * Search Record
	 *
	 * @param string $emis_no
	 * @param string $nhs_no
	 * @param string $f_name
	 * @param string $l_name
	 * @param string $lab_no
	 * @return array
	 */
	public function get_search_request($emis_no, $nhs_no, $f_name, $l_name, $lab_no) {
		$where = array();
		$where['specimen_publish_status'] = 1;

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

		if ($emis_no != '') {
			$where['emis_number'] = $emis_no;
		}
		if ($nhs_no != '') {
			$where['nhs_number'] = $nhs_no;
		}
		if ($f_name != '') {
			$where['f_name'] = $f_name;
		}
		if ($l_name != '') {
			$where['sur_name'] = $l_name;
		}
		if ($lab_no != '') {
			$where['lab_number'] = $lab_no;
		}
		if (!empty($group_id)) {
			$where['hospital_group_id'] = $group_id;
		}
		if (empty($where)) {
			return array(); // ... or NULL
		} else {

			$query = $this->db->get_where('request', $where);
			$rowcount = $query->num_rows();
			if ($this->db->affected_rows() == 0) {
				$record_not_found = '<p class="bg-danger" style="padding:7px;">Sorry there is no record found mathing with your words. Please try to find with different words.</p>';
				$this->session->set_flashdata('record_found', $record_not_found);
			} else {
				$record_found = '<p class="bg-success" style="padding:7px;font-size:13px;font-weight:bold;">We have found ' . $rowcount . ' result/s based on your search query.</p>';
				$this->session->set_flashdata('record_found', $record_found);
			}
			return $query->result();
		}
	}
	/**
	 * Get Hospital Published Records
	 *
	 * @return array
	 */
	public function institute_record_all($type, $res_type, $viewType = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id[] = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$groupsInfo = $this->ion_auth->get_users_main_groups($user_id)->result_array();
		if (count($groupsInfo) > 1) {
			$groupIdDetails = $this->ion_auth->get_users_groups()->row();
			if ($groupIdDetails->group_type == 'HA' || $groupIdDetails->group_type == 'C' || $groupIdDetails->group_type == 'HD' || $groupIdDetails->group_type == 'HS') {
				$mainGroup = 'H';
			}
			if ($groupIdDetails->group_type == 'LC' || $groupIdDetails->group_type == 'DE' || $groupIdDetails->group_type == 'LS' || $groupIdDetails->group_type == 'LA') {
				$mainGroup = 'L';
			}
			foreach ($groupsInfo as $gkey => $grp) {
				if ($grp['group_type'] == $mainGroup) {
					$group_id[] = $grp['id'];
				}
			}
		}
		$group_ids = implode(",", $group_id);
		$status = "request.specimen_publish_status in (0,1)";
		$viewtypeStatus = '';
		$req_status = '';
		if ($type == 'unpublished') {
			$status = "request.specimen_publish_status = 0";
			$req_status = " AND request.publish_status = 0";
		} else if ($type == 'published') {
			$status = "request.specimen_publish_status = 1";
			$req_status = " AND request.publish_status = 1";
			if ($viewType != '' && $viewType != 3) {
				$viewtypeStatus = " AND request.is_viewed = $viewType";
			}
		}
		$sql = "SELECT * FROM request
      INNER JOIN users_request
      INNER JOIN `groups`
      WHERE users_request.request_id = request.uralensis_request_id
      AND groups.id = users_request.group_id
      AND users_request.group_id IN($group_ids)
      AND $status
      $req_status
      $viewtypeStatus
      AND NOT EXISTS (
      SELECT * FROM request_viewed
      WHERE request.uralensis_request_id = request_viewed.request_viewed_id
      AND request_viewed.user_group_id IN($group_ids)
      GROUP BY `request`.`uralensis_request_id`)";
		// echo $sql;exit;
		if ($res_type == 'count') {
			$query = $this->db->query($sql);
			return $query->num_rows();
		} else {
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
	/**
	 * Get Hospital Published Records
	 *
	 * @return array
	 */
	// public function institute_record_published()
	// {
	//     if (!$this->ion_auth->logged_in()) {
	//         redirect('auth/login', 'refresh');
	//     }

	//   $user_id = $this->ion_auth->user()->row()->id;
	//   $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

	//    $sql = "SELECT * FROM request
	//   INNER JOIN users_request
	//   INNER JOIN `groups`
	//   WHERE users_request.request_id = request.uralensis_request_id
	//   AND groups.id = users_request.group_id
	//   AND users_request.group_id = $group_id
	//   AND request.specimen_publish_status = 0
	//   AND NOT EXISTS (
	//   SELECT * FROM request_viewed
	//   WHERE request.uralensis_request_id = request_viewed.request_viewed_id
	//   AND request_viewed.user_group_id = $group_id
	// )";
	//     $query = $this->db->query($sql);
	//     return $query->result();
	// }

	public function institute_record_published() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

		$filter = " AND request.hospital_group_id IN ($group_id)";

		$query = $this->db->query("SELECT *, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number, count(DISTINCT(specimen.specimen_id)) as speciman_no FROM request
            INNER JOIN request_assignee
            /*LEFT JOIN section_comments ON section_comments.record_id=request.uralensis_request_id*/
            LEFT JOIN users ON request.request_add_user = users.id
            LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
            LEFT JOIN specimen on specimen.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' $filter GROUP BY `request`.`uralensis_request_id`");
		//GROUP BY request.uralensis_request_id
		//    echo $this->db->last_query(); exit;
		/*AND request.request_add_user = $lab_id */

		$resArr = $query->result();
		foreach ($resArr as $key => $row) {
			$description = $this->db->get_where('section_comments', ['record_id' => $row->uralensis_request_id])->row();
			$resArr[$key]->description = ($description) ? $description->description : '';
		}
		return $resArr;

		//return $query->result();
	}

	/**
	 * Viewed Reports
	 *
	 * @param string $year
	 * @return void
	 */
	public function institute_record_viewed($year) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (!empty($year)) {
			$user_id = $this->ion_auth->user()->row()->id;
			$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
			$query = $this->db->query(
				"SELECT * FROM request
          INNER JOIN users_request
          INNER JOIN `groups`
          WHERE users_request.request_id = request.uralensis_request_id
          AND groups.id = users_request.group_id
          AND users_request.group_id = $group_id
          AND request.specimen_publish_status = 1
          AND EXISTS(
          SELECT * FROM request_viewed WHERE
          request.uralensis_request_id = request_viewed.request_viewed_id
          AND request_viewed.user_viewed_id = $user_id
        )AND YEAR(request.request_datetime) = $year ORDER BY request.uralensis_request_id DESC"
			);
			return $query->result();
		}
	}

	/**
	 * Viewed Reports
	 *
	 * @return array
	 */
	public function institute_record_viewed_16() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$query = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND EXISTS(
        SELECT * FROM request_viewed WHERE
        request.uralensis_request_id = request_viewed.request_viewed_id
        AND request_viewed.user_viewed_id = $user_id
      )AND YEAR(request.request_datetime) = 2016 ORDER BY request.uralensis_request_id DESC"
		);
		return $query->result();
	}

	/**
	 * Viewed Reports
	 *
	 * @return array
	 */
	public function institute_record_viewed_15() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$query = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND EXISTS(
        SELECT * FROM request_viewed WHERE
        request.uralensis_request_id = request_viewed.request_viewed_id
        AND request_viewed.user_viewed_id = $user_id
      )AND YEAR(request.request_datetime) = 2015 ORDER BY request.uralensis_request_id ASC"
		);
		return $query->result();
	}

	/**
	 * Update File
	 *
	 * @param string $filename
	 * @param string $title
	 * @param string $path
	 * @param string $file_ext
	 * @param string $is_image
	 * @param int $doc_id
	 */
	public function update_file($filename, $title, $path, $file_ext, $is_image, $hos_id, $user, $record_id) {

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
			'user_id' => $hos_id,
			'record_id' => $record_id,
		);
		$this->db->insert('files', $data);
	}

	/**
	 * Get Files Data
	 *
	 * @param int $record_id
	 * @return array
	 */
	public function fetch_files_data($record_id) {

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (isset($record_id) && !empty($record_id)) {
			$query = $this->db->query("SELECT * FROM files WHERE record_id = $record_id ORDER BY files_id");
			return $query->result();
		}
	}

	/**
	 * Function That will insert the data into db.
	 *
	 * @param $filename
	 * @param $title
	 * @param $path
	 * @param $file_ext
	 * @param $is_image
	 * @param $request_type
	 * @param $rtype_code
	 * @param $hospital_id
	 */
	public function upload_center_form_model($filename, $title, $path, $file_ext, $is_image, $request_type, $rtype_code, $hospital_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$data = array(
			'upc_file_name' => $filename,
			'upc_file_title' => $title,
			'upc_file_path' => $path,
			'upc_file_ext' => $file_ext,
			'upc_is_image' => $is_image,
			'upc_file_type' => $request_type,
			'upc_file_type_code' => $rtype_code,
			'upc_uploader_id' => $hospital_id,
		);
		$this->db->insert('uralensis_uplaod_center', $data);
	}

	/**
	 * Get Uploaded Request Forms
	 *
	 * @return array
	 */
	public function get_upc_requestforms() {
		$hospital_user_id = $this->ion_auth->user()->row()->id;
		$get_request_docs = $this->db->query("SELECT * FROM uralensis_uplaod_center
        WHERE upc_file_type_code = 'rf'
        AND upc_uploader_id = $hospital_user_id
        ORDER BY upc_file_id DESC");
		return $get_request_docs->result();
	}

	/**
	 * Get Uploaded Request Form Assignee
	 *
	 * @return array
	 */
	public function get_upc_requestforms_assignee() {
		$hospital_user_id = $this->ion_auth->user()->row()->id;
		$get_request_docs = $this->db->query("SELECT * FROM uralensis_uplaod_center
        INNER JOIN uralensis_uplaod_center_assigns
        WHERE upc_file_type_code = 'rf'
        AND uralensis_uplaod_center_assigns.upload_file_id = uralensis_uplaod_center.upc_file_id
        AND uralensis_uplaod_center_assigns.upc_assignee_id = $hospital_user_id
        ORDER BY upc_file_id DESC");
		return $get_request_docs->result();
	}

	/**
	 * Get Uploaded Checklist Form
	 *
	 * @return array
	 */
	public function get_upc_checklistforms() {
		$hospital_user_id = $this->ion_auth->user()->row()->id;
		$get_checklist_docs = $this->db->query("SELECT * FROM uralensis_uplaod_center
        WHERE upc_file_type_code = 'cf'
        AND upc_uploader_id = $hospital_user_id
        ORDER BY upc_file_id DESC");
		return $get_checklist_docs->result();
	}

	/**
	 * Get Checklist form assignee
	 *
	 * @return array
	 */
	public function get_upc_checklistforms_assignee() {
		$hospital_user_id = $this->ion_auth->user()->row()->id;
		$get_checklist_docs = $this->db->query("SELECT * FROM uralensis_uplaod_center
        INNER JOIN uralensis_uplaod_center_assigns
        WHERE upc_file_type_code = 'cf'
        AND uralensis_uplaod_center_assigns.upload_file_id = uralensis_uplaod_center.upc_file_id
        AND uralensis_uplaod_center_assigns.upc_assignee_id = $hospital_user_id
        ORDER BY upc_file_id DESC");
		return $get_checklist_docs->result();
	}

	public function getLabIdsFromUser($user_id) {
		$lab_ids = $this->db->select('GROUP_CONCAT(li.group_id) as lab_id')
			->from('laboratory_information li')
			->join('groups gr', 'gr.id = li.group_id')
			->join('users_groups ugr', 'gr.id = ugr.group_id', 'left')
			->where([
				'gr.group_type' => 'L',
				'ugr.user_id' => $user_id,
				//'ugr.institute_id' => $user_id
			])
			->get()->row()->lab_id;
		return $lab_ids;
	}

	/**
	 * Fetch Status Bar Results Count Published
	 *
	 * @return array
	 */
	public function status_bar_result_count_published() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id[] = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$groupsInfo = $this->ion_auth->get_users_main_groups($user_id)->result_array();
		if (count($groupsInfo) > 1) {
			$groupIdDetails = $this->ion_auth->get_users_groups()->row();
			if ($groupIdDetails->group_type == 'HA' || $groupIdDetails->group_type == 'C' || $groupIdDetails->group_type == 'HD' || $groupIdDetails->group_type == 'HS') {
				$mainGroup = 'H';
			}
			if ($groupIdDetails->group_type == 'LC' || $groupIdDetails->group_type == 'DE' || $groupIdDetails->group_type == 'LS' || $groupIdDetails->group_type == 'LA') {
				$mainGroup = 'L';
			}
			foreach ($groupsInfo as $gkey => $grp) {
				if ($grp['group_type'] == $mainGroup) {
					$group_id[] = $grp['id'];
				}
			}
		}
		$group_ids = implode(",", $group_id);
		$labIdStr = $this->getLabIdsFromUser($user_id);
		$labIds = (!empty($labIdStr)) ? $labIdStr : '0';

		$result = $this->db->query(
			"SELECT * FROM request INNER JOIN
        users_request INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND request.specimen_publish_status = 1
        AND request.publish_status = 1
        AND users_request.group_id IN ($group_ids)"
		);
		/*AND users_request.users_id = $user_id*/
		//echo $this->db->last_query(); exit;
		return $result->num_rows();
	}

	// public function status_bar_result_count_published()
	// {
	//     if (!$this->ion_auth->logged_in()) {
	//         redirect('auth/login', 'refresh');
	//     }

	//     $user_id = $this->ion_auth->user()->row()->id;
	//     $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
	//     $labIdStr = $this->getLabIdsFromUser($user_id);
	//     $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
	//     $filter = " AND request.lab_id IN (114,115)";
	//     $result = $this->db->query(
	//         "SELECT *, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number, count(DISTINCT(specimen.specimen_id)) as speciman_no FROM request
	//         INNER JOIN request_assignee
	//         /*LEFT JOIN section_comments ON section_comments.record_id=request.uralensis_request_id*/
	//         LEFT JOIN users ON request.request_add_user = users.id
	//         LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
	//         LEFT JOIN specimen on specimen.request_id = request.uralensis_request_id
	//         WHERE request.uralensis_request_id = request_assignee.request_id
	//         AND request.specimen_publish_status = 0
	//         AND request.supplementary_review_status = 'false' $filter GROUP BY `request`.`uralensis_request_id`"
	//     );
	//     /*AND users_request.users_id = $user_id*/
	//     //echo $this->db->last_query(); exit;
	//     return $result->num_rows();
	// }

	/**
	 * Fetch Status Bar Results Count Un Reported
	 *
	 * @return array
	 */
	public function status_bar_result_count_un_reported() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id[] = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$groupsInfo = $this->ion_auth->get_users_main_groups($user_id)->result_array();
		if (count($groupsInfo) > 1) {
			$groupIdDetails = $this->ion_auth->get_users_groups()->row();
			if ($groupIdDetails->group_type == 'HA' || $groupIdDetails->group_type == 'C' || $groupIdDetails->group_type == 'HD' || $groupIdDetails->group_type == 'HS') {
				$mainGroup = 'H';
			}
			if ($groupIdDetails->group_type == 'LC' || $groupIdDetails->group_type == 'DE' || $groupIdDetails->group_type == 'LS' || $groupIdDetails->group_type == 'LA') {
				$mainGroup = 'L';
			}
			foreach ($groupsInfo as $gkey => $grp) {
				if ($grp['group_type'] == $mainGroup) {
					$group_id[] = $grp['id'];
				}
			}
		}
		$group_ids = implode(",", $group_id);
		$labIdStr = $this->getLabIdsFromUser($user_id);
		$labIds = (!empty($labIdStr)) ? $labIdStr : '0';

		$result = $this->db->query(
			"SELECT * FROM request INNER JOIN
        users_request INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND request.specimen_publish_status = 0
        AND request.publish_status = 0
        AND users_request.group_id IN ($group_ids) GROUP BY `request`.`uralensis_request_id`"
		);
		/*AND users_request.users_id = $user_id*/
		return $result->num_rows();
	}

	/**
	 * Fetch Status Bar Results Count Total Reported
	 *
	 * @return array
	 */
	public function status_bar_result_count_total_reports() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$result = $this->db->query(
			"SELECT * FROM request INNER JOIN
        users_request INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id

        AND users_request.group_id = $group_id"
		);
		return $result->num_rows();
	}

	/**
	 * Fetch Status Bar Results Count New Reports
	 *
	 * @return array
	 */
	public function status_bar_result_count_new_reports() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$result = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND NOT EXISTS(
        SELECT * FROM request_viewed WHERE
        request.uralensis_request_id = request_viewed.request_viewed_id
        AND request_viewed.user_viewed_id = $user_id
      )"
		);
		return $result->num_rows();
	}

	/**
	 * Fetch Status Bar Results Count Submitted Reports
	 *
	 * @return void
	 */
	public function status_bar_result_count_submitted_reports() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$result = $this->db->query(
			"SELECT * FROM request INNER JOIN
        users_request INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 0"
		);

		return $result->num_rows();
	}

	/**
	 * Fetch Status Bar Results Count Viewed Reports
	 *
	 * @return void
	 */
	public function status_bar_result_count_viewed_reprots() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$result = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND EXISTS(
        SELECT * FROM request_viewed WHERE
        request.uralensis_request_id = request_viewed.request_viewed_id
        AND request_viewed.user_viewed_id = $user_id
      )"
		);

		return $result->num_rows();
	}

	/**
	 * Get Lab Name Records
	 *
	 * @return void
	 */
	public function getLabSpecimenDetails($group_id, $search_term) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$this->db->select('*');
		$this->db->from('request');
		$this->db->join('users_request', 'users_request.request_id = request.uralensis_request_id', 'INNER');
		$this->db->join('groups', 'groups.id = users_request.group_id', 'INNER');
		$this->db->where('ura_barcode_no', $search_term);
		$this->db->where('users_request.group_id', $group_id);
		return $this->db->get()->result_array();
	}

	/**
	 * Get Lab Name Records
	 *
	 * @return void
	 */
	public function get_lab_names() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		return $this->db->where('group_type', 'L')->get('groups')->result_array();
	}

	/**
	 * Teaching Cases Display
	 *
	 * @return void
	 */
	public function teaching_cases() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$query = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.teaching_case = 'on'"
		);

		return $query->result();
	}

	/**
	 * Pending MDT Cases Display Model
	 *
	 * @return void
	 */
	public function pending_mdt_cases() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$query = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.mdt_case_status = 'pending'
        AND request.mdt_case = 'on'"
		);

		return $query->result();
	}

	/**
	 * Post MDT Cases Display Model
	 *
	 * @return void
	 */
	public function post_mdt_cases() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$query = $this->db->query(
			"SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.mdt_case_status = 'post'
        AND request.mdt_case = 'on'"
		);
		return $query->result();
	}

	public function getUserDecryptedDetailsByid($id) {

		$query = $this->db->query("SELECT id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users
        WHERE id=" . $id);
		//query->collumn_name

		return $query->row();
	}

	/**
	 * Previous Login Records
	 *
	 * @return void
	 */
	public function previous_login_records() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$getemail = $this->getUserDecryptedDetailsByid($user_id);
		$get_user_email = $getemail->email;
		$query = $this->db->query("SELECT * FROM users_login_records
        WHERE users_login_records.users_login_id = '$get_user_email'
        ORDER BY users_login_records.ulr_id DESC LIMIT 5");
		return $query->result();
	}

	/**
	 * Get Cost Codes
	 *
	 * @param int $hospital_id
	 * @return array
	 */
	public function get_cost_codes_by_block($hospital_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT * FROM uralensis_cost_codes
        WHERE uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_id
        AND ura_cost_code_type = 'block'");
		return $query->result();
	}

	/**
	 * Find Macthing Records Based On NHS Number MODEL
	 *
	 * @param string $nhs_number
	 * @return array
	 */
	public function find_matching_records_model($nhs_number) {
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
	 * Find Macthing Records Based On NHS Number MODEL
	 *
	 * @param string $nhs_number
	 * @return array
	 */
	public function deleteSpeciment($speciment_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("DELETE FROM specimen WHERE specimen_id=" . $speciment_id);

		return $query;
	}

	/**
	 * List Users For Message
	 *
	 * @param int $hospital_id
	 * @return array
	 */
	public function get_message_users($hospital_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM
        users WHERE users.id != $hospital_id");
		return $query->result();
	}

	/**
	 * Display Messages
	 *
	 * @param int $hospital_id
	 * @param string $type
	 * @return void
	 */
	public function display_institute_msg_model($hospital_id, $type) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$t1 = 'privmsgs';
		$t2 = 'privmsgs_to';
		$this->db->select('*');
		$this->db->from($t1);

		switch ($type) {
		case 'trash':
			$this->db->where('pmto_recipient', $hospital_id);
			$this->db->where('pmto_deleted', 1);
			$this->db->or_where('privmsg_author', $hospital_id);
			$this->db->where('privmsg_deleted', 1);
			break;
		case 'inbox':
			$this->db->where('pmto_recipient', $hospital_id);
			$this->db->where('pmto_deleted', NULL);
			$this->db->where('pmto_read', NULL);
			break;
		// Message type SENT
		case 'sent':
			$this->db->where('privmsg_author', $hospital_id);
			$this->db->where('privmsg_deleted', 0);
			break;
		// Message type RECEIVED OR SENT (deleted or not, sent to or by this user)
		default:
			$this->db->where('pmto_recipient', $hospital_id);
			$this->db->where('privmsg_author', $hospital_id);
			break;
		}

		$this->db->join($t2, 'pmto_message' . ' = ' . 'privmsg_id');
		$this->db->group_by('privmsg_id'); // To get only distinct messages

		$q = $this->db->get();
		return $data = $q->result();
	}

	/**
	 * Get Record Flag Comments From Flag Comments Table
	 *
	 * @param int $group_id
	 * @param int $record_id
	 * @return void
	 */
	public function get_flag_commnets_record($group_id, $record_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT ufc.ufc_id, ufc.ufc_record_id, ufc.ufc_comments, ufc.ufc_user_id, ufc.ufc_timestamp
        FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        INNER JOIN uralensis_flag_comments AS ufc
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND ufc.ufc_record_id = request.uralensis_request_id
        AND request.uralensis_request_id = $record_id ORDER BY ufc.ufc_id DESC
        ");

		return $query->result();
	}

	/**
	 * List All Hospitals on Doctor Side.
	 *
	 * @return array
	 */
	public function display_hospitals_list() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT * FROM `groups` WHERE groups.group_type = 'H'");
		return $query->result();
	}

	/**
	 * Pending MDT Cases Display Model
	 *
	 * @param int $hospital_group_id
	 * @param string $mdt_date
	 * @return void
	 */
	public function mdt_cases_list_model($hospital_group_id, $mdt_date) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$mdt_date_convert = date('Y-m-d', $mdt_date);
		if (isset($hospital_group_id)) {
			$query = $this->db->query("SELECT * FROM request
          INNER JOIN users_request
          INNER JOIN `groups`
          INNER JOIN uralensis_mdt_dates
          WHERE users_request.request_id = request.uralensis_request_id
          AND groups.id = users_request.group_id
          AND users_request.group_id = $hospital_group_id
          AND uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
          AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') = request.mdt_case
          AND request.mdt_case_status = 'for_mdt'
          AND request.mdt_case = '$mdt_date_convert'");
			return $query->result();
		}
	}

	/**
	 * List MDT Cases
	 *
	 * @param int $hospital_group_id
	 * @param string $mdt_date
	 * @return void
	 */
	public function mdt_cases_list_model_new($hospital_group_id, $mdt_date) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$mdt_date_convert = date('Y-m-d', $mdt_date);

		if (isset($hospital_group_id)) {
			$sql = "SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        INNER JOIN uralensis_mdt_dates
        INNER JOIN uralensis_mdt_records
        WHERE users_request.request_id = request.uralensis_request_id
        AND uralensis_mdt_records.record_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $hospital_group_id
        AND uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') = uralensis_mdt_records.mdt_date
        AND request.mdt_case_status = 'for_mdt'
        AND uralensis_mdt_records.mdt_date = '$mdt_date_convert'";
			$query = $this->db->query($sql);
			return $query->result();
		}
	}

	/**
	 * Get All MDT Dates
	 *
	 * @param int $hospital_group_id
	 * @return void
	 */
	public function get_all_mdt_dates($hospital_group_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$current_date = strtotime(date('Y-m-d'));
		$query = $this->db->query("SELECT * FROM uralensis_mdt_dates
        WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND uralensis_mdt_dates.ura_mdt_timestamp >= $current_date
        ORDER BY uralensis_mdt_dates.ura_mdt_timestamp");
		return $query->result();
	}

	/**
	 * Get MDT Categories
	 *
	 * @param int $hospital_group_id
	 * @return string
	 */
	public function get_previous_all_mdt_dates($hospital_group_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$current_date = strtotime(date('Y-m-d'));
		$query = $this->db->query("SELECT * FROM uralensis_mdt_dates
        WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND uralensis_mdt_dates.ura_mdt_timestamp < $current_date
        ORDER BY uralensis_mdt_dates.ura_mdt_timestamp");
		return $query->result();
	}

	/**
	 * Get Hospital Clinician List
	 *
	 * @param int $hospital_group_id
	 * @return void
	 */
	public function get_hospital_clinician($hospital_group_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT * FROM uralensis_clinician
        WHERE uralensis_clinician.hospital_id = $hospital_group_id");
		return $query->result();
	}

	/**
	 * Get hospital dermatological surgeon
	 *
	 * @param int $hospital_group_id
	 * @return array
	 */
	public function get_hospital_dermatological_surgeon($hospital_group_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT * FROM uralensis_dermatological_surgeon
        WHERE uralensis_dermatological_surgeon.hospital_id = $hospital_group_id");
		return $query->result();
	}

	/**
	 * List All Up coming clinic dates
	 *
	 * @param int $hospital_id
	 * @return array
	 */
	public function get_upcoming_clinic_dates($hospital_id) {
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
	 * @return void
	 */
	public function get_previous_clinic_dates($hospital_id) {
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
	 * @return void
	 */
	public function display_clinic_edit_data($clinic_record_id, $hospital_id) {
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
	 * @return void
	 */
	public function display_clinic_checklist_data($clinic_record_id) {
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
	 * @return void
	 */
	public function display_clinic_requestform_data($clinic_record_id) {
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
	 * @return array
	 */
	public function display_clinic_otherdoc_data($clinic_record_id) {
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
	 * @return void
	 */
	public function get_request_form_records($clinic_record_id) {
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
	 * @return array
	 */
	public function get_all_clinic_requests_data($hospital_id, $clinic_record_id) {
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
	 * @return void
	 */
	public function get_request_form_data($request_form_id, $clinic_record_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT rf.ura_clinic_request_form, rf.ura_clinic_request_ext FROM uralensis_clinic_date_requestform_uploads AS rf
        WHERE rf.ura_clinic_date_id = $clinic_record_id
        AND rf.ucd_requestform_upload_id = $request_form_id");
		return $query->result();
	}

	/**
	 * Get MDT Categories
	 *
	 * @param int $hospital_group_id
	 * @return void
	 */
	public function get_mdt_cases_model($hospital_group_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT * FROM uralensis_mdt_dates
        WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND uralensis_mdt_dates.ura_mdt_timestamp >= CURDATE() ORDER BY uralensis_mdt_dates.ura_mdt_timestamp
        LIMIT 10");
		return $query->result();
	}

	/**
	 * Get all track record templates with name of template.
	 *
	 * @param int $user_id
	 * @return void
	 */
	public function get_all_track_record_templates_bynameLike($user_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$is_admin = $this->ion_auth->in_group('admin');
		$query = '';
		if ($is_admin) {
			$query = $this->db->query("SELECT ura_rec_temp_id,temp_input_name FROM uralensis_record_track_template
          WHERE temp_status='1'");
		} else {
			$query = $this->db->query("SELECT ura_rec_temp_id,temp_input_name FROM uralensis_record_track_template
          WHERE temp_status='1' ");
		}
		return $query->result();
	}

	/**
	 * Get all track record templates with name of template.
	 *
	 * @param int $user_id
	 * @return void
	 */
	public function get_all_track_record_templates_byname($user_id, $templatename) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$is_admin = $this->ion_auth->in_group('admin');
		$query = '';
		if ($is_admin) {
			$query = $this->db->query("SELECT * FROM uralensis_record_track_template
          WHERE temp_status='1' AND ura_rec_temp_id=" . $templatename);
		} else {
			//$query = $this->db->query("SELECT * FROM uralensis_record_track_template
			//WHERE temp_status='1' AND temp_assignee_id=" . $user_id . " AND ura_rec_temp_id=" . $templatename);
			$query = $this->db->query("SELECT * FROM uralensis_record_track_template
          WHERE temp_status='1' AND ura_rec_temp_id=" . $templatename);
		}
		return $query->result();
	}

	/**
	 * Get all track record templates.
	 *
	 * @param int $user_id
	 * @return void
	 */
	public function get_all_track_record_templates($user_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = array();
		if (!empty($user_id)) {
			return $query = $this->db->where('temp_assignee_id', $user_id)->get('uralensis_record_track_template')->result_array();
		}
	}

	public function get_track_record_templates_by_id($user_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = array();
		if (!empty($user_id)) {
			$query = $this->db->where('ura_rec_temp_id', $user_id)->get('uralensis_record_track_template')->result_array();

			if (empty($query)) {
				throw new Exception("Patient not found");
			}
			return $query[0];
		}
	}

	/**
	 * Get All Hospitals By its Groups
	 *
	 * @return void
	 */
	public function get_hospital_groups() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$query = $this->db->query("SELECT * FROM `groups` WHERE groups.group_type = 'H'");
		return $query->result();
	}

	/**
	 * Get doctors list
	 *
	 * @return void
	 */
	public function get_doctors($hospital_id = '') {
		$filter = (!empty($hospital_id)) ? " AND users_groups.institute_id=$hospital_id" : "";
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		// Check if current user is admin
		$is_admin = $this->ion_auth->in_group('admin');
		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		//get_user_group_type

		$groupType = $this->ion_auth->get_users_main_groups()->row()->group_type;
		$result = array();
		if ($hospital_id != '') {
			$sql = "
        SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        users.id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username
        FROM users
        INNER JOIN users_groups ON users.id = users_groups.user_id
        INNER JOIN `groups` ON `groups`.id = users_groups.institute_id
        WHERE `users`.user_type = 'D' $filter";
			$query = $this->db->query($sql);
			$result = $query->result();
		} else {
			$sql = "
        SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        users.id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username
        FROM users
        WHERE `users`.user_type = 'D'";
			$query = $this->db->query($sql);
			$result = $query->result();
		}

		return $result;
	}

	/**
	 * Get Clinic list
	 *
	 * @return void
	 */
	public function get_clinic($hospital_id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		if ($hospital_id != '') {
			$filter = (!empty($hospital_id)) ? " AND users_groups.institute_id=$hospital_id" : "";
			$sql = "SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username
                    FROM users
                    JOIN users_groups ON users_groups.user_id = users.id
                    WHERE `users`.user_type = 'C' $filter";
			$query = $this->db->query($sql);
		} else {
			$sql = "SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username
                    FROM users
                    WHERE `users`.user_type = 'C'";
			$query = $this->db->query($sql);
		}

		return $query->result();
	}

	public function get_location($hos_id = FALSE) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$sql = "SELECT * FROM users INNER JOIN user_locations ON users.id = user_locations.user_id";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function count_total_hospital_users($hos_id = FALSE, $group_type = FALSE) {
		//  print "SELECT * FROM hospital_group JOIN groups on hospital_group.hospital_id=groups.id WHERE hospital_group.hospital_id='$hos_id' AND groups.group_type='$group_type'";

		$h = $this->db->query("SELECT * FROM users_groups  WHERE institute_id='$hos_id'")->result();
		// return $this->db->count_all_results();
		return count($h);
		//  return $query;
	}

	public function get_courier() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$sql = "SELECT * from tbl_courier where active=1 order by created_at DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_speciality_category($ids = false) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$is_admin = $this->ion_auth->in_group('admin');
		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

		$sql = "SELECT * from department_settings where specialty='Histopathology' and hospital_id='89'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	/**
	 * Count Attached Documents To Records
	 *
	 * @param int $record_id
	 * @param int $doctor_id
	 * @return void
	 */

	public function count_documents($record_id, $doctor_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		if ($doctor_id = 0) {
			return 0;
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

	public function get_all_session_records($session_rec_data) {
		if (!empty($session_rec_data)) {
			$sess_id = implode(",", @$session_rec_data);
			$sql = "SELECT * FROM request WHERE request.hospital_group_id IN ($sess_id)";
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

	public function get_track_template_statuses($record_id = '', $get_type = '') {
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
	 * Get assignee doctor id
	 *
	 * @param int $record_id
	 * @return void
	 */
	public function get_record_assignee_doctor_id($record_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$doctor_id = '';
		if (!empty($record_id)) {
			return $doctor_id = $this->db->select('user_id')->where('request_id', $record_id)->get('request_assignee')->row_array()['user_id'];
		}
	}

	/**
	 * Display Further Work
	 *
	 * @param string $type
	 * @return void
	 */

	public function print_further_work_records($type = '') {

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;

		$sql = '';
		$sql .= "SELECT SELECT  AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username ,further_work.fw_id, further_work.request_id, further_work.furtherword_description, further_work.furtherwork_date, further_work.furtherwork_status, further_work.furtherwork_to_emails, further_work.hospital_id, further_work.doctor_id, further_work.group_id, further_work.fw_status, further_work.fw_preview_template,request.uralensis_request_id, request.record_batch_id, request.serial_number, request.ura_barcode_no, request.patient_initial, request.pci_number, request.request_datetime, request.publish_datetime, request.publish_datetime_modified, request.emis_number, request.nhs_number, request.lab_number, request.hos_number, request.sur_name, request.f_name, request.dob, request.age, request.lab_name, request.date_received_bylab, request.data_processed_bylab, request.date_sent_touralensis, request.date_rec_by_doctor, request.gender, request.clrk, request.dermatological_surgeon, request.date_taken, request.urgent, request.hsc, request.report_urgency, request.cl_detail, request.specimen_id, request.status, request.assign_status, request.specimen_update_status, request.specimen_publish_status, request.further_work_status, request.supplementary_report_status, request.supplementary_review_status, request.report_status, request.publish_status, request.hospital_group_id, request.additional_data_state, request.comment_section, request.comment_section_date, request.teaching_case, request.mdt_case, request.mdt_case_status, request.mdt_list_id, request.mdt_specimen_status, request.mdt_case_assignee_username, request.mdt_case_msg, request.mdt_case_msg_timestamp, request.mdt_case_add_to_report_status, request.mdt_outcome_text, request.fw_levels, request.fw_immunos, request.fw_imf, request.special_notes, request.special_notes_date, request.record_secretary_id, request.record_assign_sec_time, request.record_secretary_status, request.secretary_record_edit_status, request.cases_category, request.cost_codes, request.flag_status, request.authorize_status, request.request_add_user, request.request_add_user_timestamp, request.clinic_ref_number, request.clinic_request_form, request.request_code_status, request.record_edit_status, request.request_assign_status, request.ura_rec_temp_dataset,
      groups.id, groups.name, groups.first_initial, groups.last_initial, groups.description, groups.information, groups.group_type, groups.lab_mask, groups.user_lab_default_status FROM further_work
      INNER JOIN `groups`
      INNER JOIN request
      INNER JOIN users
      INNER JOIN request_assignee
      INNER JOIN users_request
      WHERE further_work.request_id = request.uralensis_request_id
      AND groups.id = users_request.group_id
      AND users_request.group_id = $group_id
      AND request_assignee.user_id = further_work.doctor_id
      AND further_work.doctor_id = users.id
      AND request_assignee.request_id = further_work.request_id
      AND users_request.request_id = request.uralensis_request_id";

		if (!empty($type) && $type === 'completed') {
			$sql .= ' AND further_work.fw_status = "complete"';
		} else {
			$sql .= ' AND further_work.fw_status = "requested"';
		}
		$query = $this->db->query($sql);
		return $query->result();
	}

	/**
	 * Get hospital records all documents
	 *
	 * @return void
	 */
	public function get_hospital_records_all_documents() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$this->db->select('files_id, file_name, title, file_path, record_id, user, upload_date, uralensis_request_id, hospital_group_id');
		$this->db->from('files');
		$this->db->join('request', 'request.uralensis_request_id = files.record_id', 'INNER');
		$this->db->where('request.hospital_group_id', $group_id);
		return $query = $this->db->get()->result();
	}

	/**
	 * Get all hospital clinic dates
	 *
	 * @return void
	 */
	public function get_hospital_clinic_dates() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		return $this->db->where('ura_clinic_hospital_id', $group_id)->get('uralensis_clinic_dates')->result_array();
	}

	/**
	 * Get all hospital users from same group
	 *
	 * @return void
	 */
	public function get_all_users_by_group() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$get_all_users = $this->db->select('user_id')->where('group_id', $group_id)->get('users_groups')->result_array();
		$users_array = array();
		if (!empty($get_all_users)) {
			foreach ($get_all_users as $users) {
				$users_array[] = $users['user_id'];
			}
		}
		return $users_array;
	}

	/**
	 * Get all groups user data
	 *
	 * @param int $record_ids
	 * @return void
	 */
	public function get_all_group_users_data($record_ids) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		return $this->db->where_in('id', $record_ids)->where('user_login_status', 'true')->where_not_in('id', $user_id)->get('users')->result_array();
	}

	/**
	 * Get all users with exclude option
	 *
	 * @param int $record_ids
	 * @return void
	 */
	public function get_all_group_users_exclude_current($record_ids) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;
		return $this->db->select('id,first_name,last_name')->where_in('id', $record_ids)->where_not_in('id', $user_id)->get('users')->result_array();
	}

	/**
	 * Get all user upload area documents
	 *
	 * @return void
	 */
	public function get_all_current_users_upload_area_docs() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		return $this->db->order_by("ura_upload_area_id", "desc")->get('uralensis_upload_area')->result_array();
	}

	/**
	 * Get all user upload area documents
	 *
	 * @return void
	 */
	public function get_all_current_users_client_doc_upload_area_docs() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		return $this->db->get('uralensis_client_doc_upload_area')->result_array();
	}

	/**
	 * Get all hospital Assigned doctors
	 *
	 * @param int $group_id
	 * @return void
	 */
	public function get_all_hospital_assigned_doctors($group_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (!empty($group_id)) {
			return $this->db->select('doctor_id')->distinct()->where('group_id', $group_id)->get('users_request')->result_array();
		}
	}

	/**
	 * Get all hospital assiged doctor data
	 *
	 * @param array $doctor_ids_array
	 * @return void
	 */
	public function get_all_hospital_assigned_doctors_data($doctor_ids_array) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (!empty($doctor_ids_array)) {
			return $this->db->where_in('id', $doctor_ids_array)->get('users')->result_array();
		}
	}

	/**
	 * Display Only Publish Reports
	 *
	 * @param int $group_id
	 * @param string $date_to
	 * @param string $date_from
	 * @return void
	 */
	public function find_csv_report_model_publish($group_id, $date_to, $date_from) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "SELECT * FROM request
      INNER JOIN users_request
      INNER JOIN `groups`
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
	 * @return void
	 */
	public function find_csv_report_model_publish_unpublish($group_id, $date_to, $date_from) {
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
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND (request.specimen_publish_status = 1 OR request.specimen_publish_status = 0)
        AND request.request_datetime >= '$date_from' AND request.request_datetime < '$date_to'");
		return $query->result();
	}

	/**
	 * Generate TAT10 Reprot
	 *
	 * @param int $group_id
	 * @param string $tat_opt
	 * @return void
	 */
	public function generate_tat10_model($group_id, $tat_opt = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$current_date = date('Y-m-d');
		$ten_days_ago = date('Y-m-d', strtotime('-10 days', strtotime($current_date)));
		$query = $this->db->query("SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND request.$tat_opt >= '$ten_days_ago' AND request.$tat_opt <= '$current_date'");
		return $query->result_array();
	}

	/**
	 * Generate TAT2W Reprot
	 *
	 * @param int $group_id
	 * @param string $tat_opt
	 * @return void
	 */
	public function generate_tat2w_model($group_id, $tat_opt = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$current_date = date('Y-m-d');
		$two_weeks_ago = date('Y-m-d', strtotime('-2 week', strtotime($current_date)));
		$query = $this->db->query("SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND request.$tat_opt >= '$two_weeks_ago' AND request.date_taken <= '$current_date'");
		return $query->result_array();
	}

	/**
	 * Generate TAT3W Reprot
	 *
	 * @param int $group_id
	 * @param string $tat_opt
	 * @return void
	 */
	public function generate_tat3w_model($group_id, $tat_opt = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$current_date = date('Y-m-d');
		$three_weeks_ago = date('Y-m-d', strtotime('-3 week', strtotime($current_date)));
		$query = $this->db->query("SELECT * FROM request
        INNER JOIN users_request
        INNER JOIN `groups`
        WHERE users_request.request_id = request.uralensis_request_id
        AND groups.id = users_request.group_id
        AND users_request.group_id = $group_id
        AND request.specimen_publish_status = 1
        AND request.$tat_opt >= '$three_weeks_ago' AND request.date_taken <= '$current_date'");
		return $query->result_array();
	}

	/**
	 * Get Records data with TAT option enabled
	 *
	 * @param int $hospital_id
	 * @param string $start_date
	 * @param string $end_date
	 * @return void
	 */
	public function get_hospital_records_data_vd_tat($hospital_id = '', $start_date = '', $end_date = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (!empty($hospital_id)) {

			$sql = "SELECT
        GROUP_CONCAT(DISTINCT specimen.specimen_type separator '/') AS Specimen_Type,
        CONCAT(AES_DECRYPT(first_name, '" . DATA_KEY . "'), ' ', AES_DECRYPT(last_name, '" . DATA_KEY . "')) AS Doctor,
        SUM(request.report_urgency = 'Urgent') AS Urgent,
        SUM(request.report_urgency = 'Routine') AS Routine,
        request.hospital_group_id AS Hospital_ID,
        users.id AS Doctor_ID,
        SUM(request.report_urgency = '2WW') AS TwoWW,
        COUNT(*) AS Total
        FROM request
        INNER JOIN request_assignee
        INNER JOIN users_request
        INNER JOIN users
        INNER JOIN `groups`
        INNER JOIN specimen
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND users_request.request_id = request.uralensis_request_id
        AND users_request.group_id = groups.id
        AND groups.id = $hospital_id
        AND request_assignee.user_id = users.id
        AND request.uralensis_request_id = specimen.request_id
        AND request.request_datetime BETWEEN '$start_date' AND '$end_date'
        GROUP BY users.id";
			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Get TAT weekdays records data
	 *
	 * @param int $hospital_id
	 * @return void
	 */
	public function get_hospital_weekdays_records_data_vd_tat($hospital_id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$current_year = date('Y');
		if (!empty($hospital_id)) {
			$sql = "SELECT
        GROUP_CONCAT(DISTINCT specimen.specimen_type separator '/') AS Specimen_Type,
        CONCAT(AES_DECRYPT(first_name, '" . DATA_KEY . "'), ' ', AES_DECRYPT(last_name, '" . DATA_KEY . "')) AS Doctor,
        SUM(request.report_urgency = 'Urgent') AS Urgent,
        SUM(request.report_urgency = 'Routine') AS Routine,
        request.hospital_group_id AS Hospital_ID,
        users.id AS Doctor_ID,
        SUM(request.report_urgency = '2WW') AS TwoWW,
        COUNT(*) AS Total
        FROM request
        INNER JOIN request_assignee
        INNER JOIN users_request
        INNER JOIN users
        INNER JOIN `groups`
        INNER JOIN specimen
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND users_request.request_id = request.uralensis_request_id
        AND users_request.group_id = groups.id
        AND groups.id = $hospital_id
        AND request_assignee.user_id = users.id
        AND request.uralensis_request_id = specimen.request_id
        AND YEAR(request.request_datetime) = '$current_year'
        GROUP BY users.id";
			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Get Average TAT records data
	 *
	 * @param string $hospital_id
	 * @param string $doctor_id
	 * @param string $type
	 * @param string $tat_date
	 * @param string $start_date
	 * @param string $end_date
	 * @return void
	 */
	public function get_average_tat_records($hospital_id = '', $doctor_id = '', $type = '', $tat_date = '', $start_date = '', $end_date = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "";
		$sql .= "SELECT
      datediff(DATE(NOW()), request.$tat_date) AS DATE_DIFF,
      request.uralensis_request_id AS record_id,
      request.serial_number AS serial_no
      FROM request
      INNER JOIN request_assignee
      INNER JOIN users_request
      INNER JOIN users
      INNER JOIN `groups`
      WHERE request.uralensis_request_id = request_assignee.request_id
      AND users_request.request_id = request.uralensis_request_id
      AND users_request.group_id = groups.id
      AND groups.id = $hospital_id
      AND request_assignee.user_id = users.id
      AND users.id = $doctor_id ";

		if (!empty($hospital_id) && $type === 'unreport') {
			$sql .= "AND request.specimen_publish_status = 0 ";
		} else {
			$sql .= "AND request.specimen_publish_status = 1 ";
		}
		$sql .= " AND request.request_datetime BETWEEN '$start_date' AND '$end_date'";
		return $this->db->query($sql)->result_array();
	}

	/**
	 * Get Weekly Record Data
	 *
	 * @param string $current_date
	 * @param int $doctor_id
	 * @param int $hospital_id
	 * @return void
	 */
	public function get_weekly_record_data($current_date, $doctor_id, $hospital_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "";
		if (!empty($current_date) && !empty($doctor_id) && !empty($hospital_id)) {
			$sql .= "SELECT
        COUNT(
        CASE
        WHEN (request.specimen_publish_status = 1)
        THEN request.specimen_publish_status
        ELSE NULL END) AS Published,
        COUNT(
        CASE
        WHEN (request.specimen_publish_status = 0)
        THEN request.specimen_publish_status
        ELSE NULL END) AS UnPublished,
        count(*) AS Total_Cases
        FROM request
        INNER JOIN request_assignee
        INNER JOIN users_request
        INNER JOIN users
        INNER JOIN `groups`
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND users_request.request_id = request.uralensis_request_id
        AND users_request.group_id = groups.id
        AND groups.id = $hospital_id
        AND request_assignee.user_id = users.id
        AND users.id = $doctor_id
        AND DATE(request.request_datetime) = '$current_date'";
			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Get weekly day base data
	 *
	 * @param int $doctor_id
	 * @param int $hospital_id
	 * @param string $current_date
	 * @param string $rec_status
	 * @return void
	 */
	public function get_weekly_day_base_data($doctor_id = '', $hospital_id = '', $current_date = '', $rec_status = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "";
		if (!empty($doctor_id) && !empty($hospital_id) && !empty($current_date) && !empty($rec_status)) {
			$sql .= "SELECT *
        FROM request
        INNER JOIN request_assignee
        INNER JOIN users_request
        INNER JOIN users
        INNER JOIN `groups`
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND users_request.request_id = request.uralensis_request_id
        AND users_request.group_id = groups.id
        AND groups.id = $hospital_id
        AND request_assignee.user_id = users.id
        AND users.id = $doctor_id
        AND DATE(request.request_datetime) = '$current_date' ";
			if (!empty($rec_status) && $rec_status === 'week_day_total') {
			} elseif (!empty($rec_status) && $rec_status === 'pub') {
				$sql .= " AND request.specimen_publish_status = 1";
			} else {
				$sql .= " AND request.specimen_publish_status = 0";
			}
			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Get weekly day base data modal
	 *
	 * @param int $doctor_id
	 * @param int $hospital_id
	 * @param string $start_date
	 * @param string $end_date
	 * @param string $rec_status
	 * @return void
	 */
	public function get_weekly_day_base_data_total($doctor_id = '', $hospital_id = '', $start_date = '', $end_date = '', $rec_status = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "";
		if (!empty($doctor_id) && !empty($hospital_id) && !empty($start_date) && !empty($end_date) && !empty($rec_status)) {
			$sql .= "SELECT *
        FROM request
        INNER JOIN request_assignee
        INNER JOIN users_request
        INNER JOIN users
        INNER JOIN `groups`
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND users_request.request_id = request.uralensis_request_id
        AND users_request.group_id = groups.id
        AND groups.id = $hospital_id
        AND request_assignee.user_id = users.id
        AND users.id = $doctor_id
        AND request.request_datetime BETWEEN '$start_date' AND '$end_date' ";
			if (!empty($rec_status) && $rec_status === 'week_total') {
			} else if (!empty($rec_status) && $rec_status === 'pub') {
				$sql .= " AND request.specimen_publish_status = 1";
			} else {
				$sql .= " AND request.specimen_publish_status = 0";
			}
			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Get hospital accumulative records for specific doctor
	 *
	 * @param int $doctor_id
	 * @param int $hospital_id
	 * @param string $current_year
	 * @return void
	 */
	public function get_accumulative_doctor_hospital_records($doctor_id = '', $hospital_id = '', $current_year = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "";
		if (!empty($doctor_id) && !empty($hospital_id) && !empty($current_year)) {
			$sql .= "SELECT *
        FROM request
        INNER JOIN request_assignee
        INNER JOIN users_request
        INNER JOIN users
        INNER JOIN `groups`
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND users_request.request_id = request.uralensis_request_id
        AND users_request.group_id = groups.id
        AND groups.id = $hospital_id
        AND request_assignee.user_id = users.id
        AND users.id = $doctor_id
        AND YEAR(request.request_datetime) = '$current_year'";
			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Get latest hospital invoice
	 *
	 * @param int $hospital_id
	 * @return void
	 */
	public function get_latest_hospital_invoice($hospital_id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (!empty($hospital_id)) {
			return $this->db->where('ura_hos_id', $hospital_id)->order_by('ura_hos_invoice', 'desc')->limit(1)->get('uralensis_hospital_invoice')->row_array();
		}
	}

	/**
	 * Load Accumulative invoices based on yearly
	 *
	 * @param string $year
	 * @param int $hospital_id
	 * @return void
	 */
	public function get_accumulative_yearly_invoices($year = '', $hospital_id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$sql = "";
		if (!empty($hospital_id) && !empty($year)) {
			$sql .= "SELECT * FROM uralensis_hospital_invoice AS uhi
        WHERE YEAR(uhi.ura_hos_date_from) = $year
        AND uhi.ura_hos_id = $hospital_id
        ORDER BY uhi.ura_hos_invoice DESC";

			return $this->db->query($sql)->result_array();
		}
	}

	/**
	 * Display Uralensis Generated Invoices
	 *
	 * @param int $invoice_id
	 * @return void
	 */
	public function generated_hospital_invoices_pdf($invoice_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		return $this->db->where('ura_hos_invoice', $invoice_id)->get('uralensis_hospital_invoice')->row_array();
	}

	/**
	 * Get Record Download History
	 *
	 * @param int $record_id
	 * @param int $user_id
	 * @return void
	 */
	public function getRecordDownloadHistory($record_id = '', $user_id = '') {
		if (!empty($record_id) && !empty($user_id)) {
			return $this->db->from('uralensis_bulk_report_history')
				->where('ura_bulk_report_user_id', $user_id)
				->where('ura_bulk_report_record_data', $record_id)
				->order_by('ura_bulk_report_history', 'desc')
				->get()
				->result_array();
		}
	}

	/**
	 * Get Incident reports
	 *
	 * @param int $user_id
	 * @return void
	 */
	public function getIncidentReports($user_id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		if (!empty($user_id)) {
			return $this->db->where('ura_incident_user_id', $user_id)->get('uralensis_incident_reports')->result_array();
		}
	}

	/**
	 * Get forms documents uploaded
	 *
	 * @return void
	 */
	public function get_upload_doc_forms() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;

		$idArr = $this->db->select('users.id')->from('users')
			->join('users_groups', 'users_groups.user_id = users.id')
			->join('groups', 'groups.id = users_groups.group_id')
			->where('groups.name', 'admin')
			->or_where('users.id', $user_id)
			->get()->result();
		$user_ids = array_column($idArr, 'id');

		//        $group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$this->db->select("uralensis_upload_forms.*,groups.name as group_name,AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name");
		$this->db->from('uralensis_upload_forms');
		$this->db->join('users', 'users.id = uralensis_upload_forms.uploaded_by', 'INNER');
		$this->db->join('users_groups', 'users_groups.user_id = users.id');
		$this->db->join('groups', 'groups.id = users_groups.group_id');
		//$this->db->where('users.id', $user_id);
		$this->db->where_in('users.id', $user_ids);
		$this->db->where_in('uralensis_upload_forms.assign_to', ['', 'Hospital', 'All']);
		return $query = $this->db->get()->result();
	}

	/**
	 * Get forms documents uploaded
	 *
	 * @return void
	 */
	public function get_request_from_to_data() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("request_from_to_detail.*,AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name, country.nicename as country_name");
		$this->db->from('request_from_to_detail');
		$this->db->join('users', 'users.id = request_from_to_detail.created_by', 'INNER');
		$this->db->join('country', 'country.id = request_from_to_detail.identifier_country', 'LEFT');
		$this->db->where('request_from_to_detail.created_by', $user_id);
		return $query = $this->db->get()->result();
	}

	/**
	 * Get request from to data list
	 *
	 * @return void
	 */
	public function get_request_from_to_list() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$this->db->select("request_from_to_detail.*, country.nicename as country_name");
		$this->db->from('request_from_to_detail');
		$this->db->join('country', 'country.id = request_from_to_detail.identifier_country', 'LEFT');
		return $query = $this->db->get()->result_array();
	}

	/**
	 * Get forms documents uploaded
	 *
	 * @return void
	 */
	public function get_request_from_to_by_id($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("*");
		$this->db->from('request_from_to_detail');
		$this->db->where('request_from_to_detail.id', $id);
		return $query = $this->db->get()->row_array();
	}

	/**
	 * Get forms documents uploaded
	 *
	 * @return void
	 */
	public function get_add_req_from_to_exist_name($ident_name, $ident_type) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("*");
		$this->db->from('request_from_to_detail');
		$this->db->where('request_from_to_detail.identifier_name', $ident_name);
		$this->db->where('request_from_to_detail.identifier_type', $ident_type);
		return $query = $this->db->get()->row_array();
	}

	/**
	 * Get forms documents uploaded
	 *
	 * @return void
	 */
	public function get_ed_req_from_to_exist_name($id, $ident_name, $ident_type) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("*");
		$this->db->from('request_from_to_detail');
		$this->db->where('request_from_to_detail.id !=', $id);
		$this->db->where('request_from_to_detail.identifier_name', $ident_name);
		$this->db->where('request_from_to_detail.identifier_type', $ident_type);
		return $query = $this->db->get()->row_array();
	}

	/**
	 * Get Countries list
	 *
	 * @return void
	 */
	public function get_countries() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("*");
		$this->db->from('country');
		return $query = $this->db->get()->result_array();
	}

	/**
	 * Get Auto Generated Reference No
	 *
	 * @return void
	 */
	public function courier_generate_reference_no() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$this->load->helper('string');
		$reference_no = random_string('numeric', 8);
		if ($this->check_reference_no($reference_no) == 1) {
			$reference_no = $this->courier_generate_reference_no();
		}
		return $reference_no;
	}

	/**
	 * Check if Reference No already exists in database
	 *
	 * @return void
	 */
	function check_reference_no($reference_no) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$response = 0;
		$this->db->select("*");
		$this->db->from('tbl_courier');
		$this->db->where('tbl_courier.reference_no', $reference_no);
		$result = $this->db->get()->row_array();
		if ($result) {
			$response = 1;
		}
		return $response;
	}

	function check_batch_no() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$year = date('y');
		$this->db->select("*");
		$this->db->from('tbl_courier');
		$this->db->where("tbl_courier.batch_no LIKE '%$year-%'");
		$this->db->order_by("tbl_courier.batch_no DESC");
		$result = $this->db->get()->row_array();
		if (empty($result)) {
			$retData = str_pad(1, 6, "0", STR_PAD_LEFT); // 0010
		} else {
			$data = explode("-", $result['batch_no']);
			$retData = str_pad(++$data[1], 6, "0", STR_PAD_LEFT);
		}
		return $retData;
	}

	function check_courier_no() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$year = date('y');
		$this->db->select("*");
		$this->db->from('tbl_courier');
		$this->db->where("tbl_courier.courier_no LIKE '%$year-%'");
		$this->db->order_by("tbl_courier.courier_no DESC");
		$result = $this->db->get()->row_array();
		if (empty($result)) {
			$retData = str_pad(1, 6, "0", STR_PAD_LEFT); // 0010
		} else {
			$data = explode("-", $result['courier_no']);
			$retData = str_pad(++$data[1], 6, "0", STR_PAD_LEFT);
		}
		return $retData;
	}

	/**
	 * Send Courier Function
	 *
	 * @return void
	 */
	public function add_courier($return_courier_id = false) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;

		$sld_lab_no = $this->input->post('slide_lab_no');
		$json_slides_lab_no = json_encode($sld_lab_no, JSON_FORCE_OBJECT);

		$sld_no_of_slds = $this->input->post('slide_no_of_slides');
		$json_slides_no_of_slds = json_encode($sld_no_of_slds, JSON_FORCE_OBJECT);

		$sld_comments = $this->input->post('slide_comments');
		$json_slides_comments = json_encode($sld_comments, JSON_FORCE_OBJECT);

		$blck_lab_no = $this->input->post('block_lab_no');
		$json_block_lab_no = json_encode($blck_lab_no, JSON_FORCE_OBJECT);

		$blck_no_of_blcks = $this->input->post('block_no_of_blocks');
		$json_block_no_of_blcks = json_encode($blck_no_of_blcks, JSON_FORCE_OBJECT);

		$blck_comments = $this->input->post('block_comments');
		$json_block_comments = json_encode($blck_comments, JSON_FORCE_OBJECT);

		$othrs_comments = $this->input->post('others_comments');
		$json_othrs_comments = json_encode($othrs_comments, JSON_FORCE_OBJECT);
		$collected_date = $this->input->post('collection_date');
		$collection_date = ($collected_date == "" ? NULL : date('Y-m-d H:i:s', strtotime($collected_date)));

		$stamped_date = $this->input->post('stamp_date');
		$stamp_date = ($stamped_date == "" ? NULL : date('Y-m-d H:i:s', strtotime($stamped_date)));

		$senderData = (array) json_decode($this->input->post('sender_data'));
		$receiverData = (array) json_decode($this->input->post('receiver_data'));

		$data = array(
			//            'origin_country'        =>$this->input->post('origin_country'),
			//            'destination_country'   =>$this->input->post('destination_country'),
			'initials' => $this->input->post('initials'),
			'batch_no' => $this->input->post('batch_no'),
			'courier_no' => $this->input->post('courier_no'),
			'reference_no ' => '1111',
			'sender_organization' => $this->input->post('sender_organization'),
			'receiver_organization' => $this->input->post('receiver_organization'),
			'sender_address1' => $this->input->post('sender_address'),
			'receiver_address1' => $this->input->post('receiver_address'),
			'consignment_no' => $this->input->post('consignment_no'),
			'parcel_weight' => $this->input->post('parcel_weight'),
			'collection_date' => $collection_date,
			'stamp_date' => $stamp_date,
			'urgency' => $this->input->post('urgency_type'),
			'courier_company' => $this->input->post('courier_company'),
			'sender_id' => $this->input->post('sender_search'),
			'sender_email' => $senderData['user_name'],
			'sender_company' => $senderData['company'],
			'sender_phone_no' => $senderData['phone'],
			'sender_address2' => $senderData['address2'],
			'sender_county' => $senderData['county'],
			'sender_country' => $senderData['country'],
			'sender_post_code' => $senderData['postcode'],
			'receiver_id' => $this->input->post('receiver_search'),
			'receiver_email' => $receiverData['user_name'],
			'receiver_company' => $receiverData['company'],
			'receiver_phone_no' => $receiverData['phone'],
			'receiver_address2' => $receiverData['address2'],
			'receiver_county' => $receiverData['county'],
			'receiver_country' => $receiverData['country'],
			'receiver_post_code' => $receiverData['postcode'],
			'unit' => $this->input->post('weight_unit'),
			'notes' => $this->input->post('courier_notes'),
			'checklist_title' => $this->input->post('checklist_title'),

			'item_type' => json_encode($this->input->post('item_type'), JSON_FORCE_OBJECT),
			'item_department' => json_encode($this->input->post('item_departments'), JSON_FORCE_OBJECT),
			'item_specimen_type' => json_encode($this->input->post('item_st'), JSON_FORCE_OBJECT),
			'item_lab' => json_encode($this->input->post('item_lab'), JSON_FORCE_OBJECT),
			'item_block' => json_encode($this->input->post('item_block'), JSON_FORCE_OBJECT),
			'other_detail' => json_encode($this->input->post('other_detail'), JSON_FORCE_OBJECT),

			'status' => NEW_COURIER,
			'courier_sent_at' => date('y-m-d h:i:s'),
			'created_by' => $user_id,
			'created_at' => date('y-m-d h:i:s'),
		);

		$this->db->insert('tbl_courier', $data);

		$courier_id = $this->db->insert_id();
		$this->db->reset_query();
		$input_data['log_id'] = $this->session->userdata['activity_detail']['log_id'];
		$input_data['module_id'] = 5;
		$input_data['user_id'] = $this->ion_auth->user()->row()->id;
		$input_data['courier_id'] = $courier_id;
		$input_data['status'] = NEW_COURIER;
		$this->db->insert('courier_tracking', $input_data);

		if ($return_courier_id) {
			return $courier_id;
		}
		return true;
	}

	public function edit_couier() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$edit_id = $this->input->post('edit_id');
		$collected_date = $this->input->post('collection_date');

		$collection_date = ($collected_date == "" ? NULL : date('Y-m-d H:i:s', strtotime($collected_date)));

		$stamped_date = $this->input->post('stamp_date');
		$stamp_date = ($collected_date == "" ? NULL : date('Y-m-d H:i:s', strtotime($stamped_date)));
		//        $collection_time = date('H:i:s', strtotime($this->input->post('collection_time')));

		$senderData = (array) json_decode($this->input->post('sender_data'));
		$receiverData = (array) json_decode($this->input->post('receiver_data'));

		$data = array(
			'sender_organization' => $this->input->post('sender_organization'),
			'receiver_organization' => $this->input->post('receiver_organization'),
			'sender_address1' => $this->input->post('sender_address'),
			'receiver_address1' => $this->input->post('receiver_address'),
			'consignment_no' => $this->input->post('consignment_no'),
			'parcel_weight' => $this->input->post('parcel_weight'),
			'collection_date' => $collection_date,
			// 'stamp_date' => $stamp_date,
			'urgency' => $this->input->post('urgency_type'),
			'courier_company' => $this->input->post('courier_company'),
			'sender_id' => $this->input->post('sender_search'),
			'sender_email' => $senderData['user_name'],
			'sender_company' => $senderData['company'],
			'sender_phone_no' => $senderData['phone'],
			'sender_address2' => $senderData['address2'],
			'sender_county' => $senderData['county'],
			'sender_country' => $senderData['country'],
			'sender_post_code' => $senderData['postcode'],
			'receiver_id' => $this->input->post('receiver_search'),
			'receiver_email' => $receiverData['user_name'],
			'receiver_company' => $receiverData['company'],
			'receiver_phone_no' => $receiverData['phone'],
			'receiver_address2' => $receiverData['address2'],
			'receiver_county' => $receiverData['county'],
			'receiver_country' => $receiverData['country'],
			'receiver_post_code' => $receiverData['postcode'],
			'unit' => $this->input->post('weight_unit'),
			'notes' => $this->input->post('courier_notes'),
			'checklist_title' => $this->input->post('checklist_title'),
		);

		$this->db->where('id', $edit_id);
		$this->db->update('tbl_courier', $data);
		return true;
	}

	/**
	 * Get Couriers sent by a user Function
	 *
	 * @return void
	 */
	public function get_user_couriers($courier_id = FALSE, $sender_type = FALSE) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$is_admin = $this->ion_auth->is_admin();
		$user_id = $this->ion_auth->user()->row()->id;
		$groupRowData = $this->ion_auth->get_users_main_groups()->row();
		$groupType = $groupRowData->group_type;
		$groupId = $groupRowData->id;

		$this->db->select("tbl_courier.*,DATE_FORMAT(tbl_courier.created_at,'%d-%m-%Y') as created_at,
                           IFNULL(DATE_FORMAT(tbl_courier.collection_date,'%d-%m-%Y %r'),'') as collection_date,
                           IFNULL(DATE_FORMAT(tbl_courier.stamp_date,'%d-%m-%Y %r'),'') as stamp_date,
                           courier_companies.name as courier_company,courier_companies.id as courier_company_id,courier_companies.logo as company_logo,
                           GROUP_CONCAT(request.lab_number) as request_id,
                           GROUP_CONCAT(CONCAT(request.uralensis_request_id, '|', request.lab_number)) as request_ids,
                           u2f.file_name,
                           CONCAT(g1.first_initial,g1.last_initial) as sender_org,
                           CONCAT(g2.first_initial,g2.last_initial) as receiver_org,
                           AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS ufirst_name,
                           AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS ulast_name,
                           GROUP_CONCAT(u2f.file_name) as filesnames,
                           GROUP_CONCAT(u2f.file_path) as filespaths,
                           GROUP_CONCAT(u2f.id) as filesIds,
                           ");
		$this->db->from('tbl_courier');
		$this->db->join('courier_companies', 'courier_companies.id=tbl_courier.courier_company', 'LEFT');
		$this->db->join('users', 'users.id=tbl_courier.stamp_user_id', 'LEFT');
		$this->db->join('request', 'request.emis_number=tbl_courier.id', 'LEFT');
		$this->db->join('uralensis_upload_forms as u2f', 'u2f.courier_id=tbl_courier.id', 'LEFT');

		$this->db->join('groups as g1', 'g1.id=tbl_courier.sender_organization', 'LEFT');
		$this->db->join('groups as g2', 'g2.id=tbl_courier.receiver_organization', 'LEFT');
		if ($sender_type && $sender_type != "all") {
			if ($sender_type == "sent") {
				$whereClasue = " (tbl_courier.sender_id=$user_id)";
			} else {
				$whereClasue = " (tbl_courier.receiver_id=$user_id)";
			}
			$whereClasue = "($whereClasue)";
			$this->db->where($whereClasue);
		} else {
			if (!$is_admin) {
				$whereClasue = " 1 = 1";
				if (base_url() == 'https://pci.pathhub.live/') {
					$whereClasue = " (tbl_courier.sender_id=$user_id OR tbl_courier.receiver_id=$user_id OR tbl_courier.created_by=$user_id)";
				}
				if ($groupType != "HA" or $groupType != "LA") {
					$userIds = $this->get_user_institutes($user_id)->result_array();
					$userIds = implode(', ', array_map(function ($entry) {
						return $entry['id'];
					}, $userIds));
					if ($userIds != "") {
						$whereClasue .= " AND (tbl_courier.sender_organization IN ($userIds) OR tbl_courier.receiver_organization IN ($userIds))";
					}
				} else {
					$whereClasue .= " OR (tbl_courier.sender_organization IN ($groupId) OR tbl_courier.receiver_organization IN ($groupId))";
				}
				$whereClasue = "($whereClasue)";
				$this->db->where($whereClasue);
			}
		}

		$this->db->where('tbl_courier.active', 1);
		if ($courier_id) {
			$this->db->or_where('tbl_courier.id', $courier_id);
		}
		$this->db->order_by("id", "desc");
		$this->db->group_by('tbl_courier.id');
		return $query = $this->db->get()->result_array();
	}

	public function getCourierCounts($user_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$is_admin = $this->ion_auth->is_admin();
		//        $user_id = $this->ion_auth->user()->row()->id;
		$groupRowData = $this->ion_auth->get_users_main_groups()->row();
		$groupType = $groupRowData->group_type;
		$groupId = $groupRowData->id;

		$this->db->select("COUNT(DISTINCT id) as total,
        SUM(CASE WHEN status = '" . NEW_COURIER . "' THEN 1 ELSE 0 END) new,
        SUM(CASE WHEN status = '" . IN_TRANSIT . "' THEN 1 ELSE 0 END) dispatch,
        SUM(CASE WHEN status = '" . DELIVERED . "' THEN 1 ELSE 0 END) received,
        SUM(CASE WHEN status = '" . COURIERISSUE . "' THEN 1 ELSE 0 END) issue
        ");
		$this->db->from('tbl_courier');
		if (!$is_admin) {
			//            $this->db->select("'0' as is_admin");
			$whereClasue = " (tbl_courier.sender_id=$user_id OR tbl_courier.receiver_id=$user_id OR tbl_courier.receiver_id=$user_id) OR (tbl_courier.created_by=$user_id)";
			if ($groupType != "HA" or $groupType != "LA") {
				$userIds = $this->get_user_institutes($user_id)->result_array();
				$userIds = implode(', ', array_map(function ($entry) {
					return $entry['id'];
				}, $userIds));
				if ($userIds != "") {
					$whereClasue .= " AND (tbl_courier.sender_organization IN ($userIds) OR tbl_courier.receiver_organization IN ($userIds))";
				}
			} else {
				$whereClasue .= " AND (tbl_courier.sender_organization IN ($groupId) OR tbl_courier.receiver_organization IN ($groupId))";
			}
			$whereClasue = "($whereClasue)";
			$this->db->where($whereClasue);
		}
		$this->db->where('tbl_courier.active', 1);
		//        if($courier_id){
		//            $this->db->or_where('tbl_courier.id', $courier_id);
		//        }
		return $query = $this->db->get()->row_array();
	}

	public function get_active_directory_users() {
		$lab_id = $this->ion_auth->get_users_main_groups()->row()->id;
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		//        $type = $this->input->get('type');
		//        if (empty($type)) {
		//            $this->output->set_status_header(400);
		//            echo "Group type not provided";
		//            return;
		//        }
		//        $hospital_row = $this->ion_auth->get_users_main_groups()->row();
		//        $hospital_id = $hospital_row->id;
		$this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email
        ", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('groups', 'groups.id = users_groups.group_id', 'left');
		//        $this->db->where('group_type', $type);
		$this->db->where('in_directory', TRUE);
		$this->db->where('users_groups.institute_id', $lab_id);
		$this->db->group_by("users.id");
		$res = $this->db->get('users_groups')->result_array();
		return $res;
	}

	/**
	 * Get Couriers Slide Columns only Function
	 *
	 * @return void
	 */
	public function get_slides_columns($courier_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("tbl_courier.id, tbl_courier.slides_lab_no, tbl_courier.slides_no_of_slides, tbl_courier.slides_no_of_comments");
		$this->db->from('tbl_courier');
		$this->db->where('tbl_courier.id', $courier_id);
		return $query = $this->db->get()->row_array();
	}

	/**
	 * Get Couriers Block Columns only Function
	 *
	 * @return void
	 */
	public function get_blocks_columns($courier_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("tbl_courier.id, tbl_courier.block_lab_no, tbl_courier.block_block_no, tbl_courier.block_comments");
		$this->db->from('tbl_courier');
		$this->db->where('tbl_courier.id', $courier_id);
		return $query = $this->db->get()->row_array();
	}

	/**
	 * Get Couriers Other Comments Column only Function
	 *
	 * @return void
	 */
	public function get_other_comments_column($courier_id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select("tbl_courier.id, tbl_courier.others_comments");
		$this->db->from('tbl_courier');
		$this->db->where('tbl_courier.id', $courier_id);
		return $query = $this->db->get()->row_array();
	}

	public function is_user_hospital_admin() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$user_id = $this->ion_auth->user()->row()->id;
		$this->db->select('group_type');
		$this->db->from('users_groups');
		$this->db->join('groups', '`groups`.`id` = `users_groups`.`group_id`');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		if (empty($result)) {
			return FALSE;
		}

		if ($result[0]['group_type'] === 'H' || $result[0]['group_type'] === 'HA' || $result[0]['group_type'] === 'A') {
			return TRUE;
		}
		return FALSE;
	}

	public function get_hospital_information() {
		$hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		//$this->db->last_query(); exit;
		$this->db->select('description, first_initial, last_initial');
		$this->db->from('`groups`');
		$this->db->where('id', $hospital_id);
		$group_result = $this->db->get()->result_array();
		$this->db->select('*');
		$this->db->from('hospital_information');
		$this->db->where('group_id', $hospital_id);
		$query = $this->db->get();
		$result = $query->result_array();
		$hospital_info = array(
			'hospital_address' => array('value' => ''),
			'hospital_country' => array('value' => ''),
			'hospital_city' => array('value' => ''),
			'hospital_state' => array('value' => ''),
			'hospital_post_code' => array('value' => ''),
			'hospital_email' => array('value' => ''),
			'hospital_number' => array('value' => ''),
			'hospital_mobile_num' => array('value' => ''),
			'hospital_fax' => array('value' => ''),
			'hospital_website' => array('value' => ''),
			'hospital_name' => array('value' => $group_result[0]['description']),
			'hospital_initials_1' => array('value' => $group_result[0]['first_initial']),
			'hospital_initials_2' => array('value' => $group_result[0]['last_initial']),
		);

		if (empty($result)) {
			return $hospital_info;
		} else {
			$result = $result[0];
			$hospital_info = array(
				'hospital_address' => array('value' => $result['hosp_address']),
				'hospital_country' => array('value' => $result['hosp_country']),
				'hospital_city' => array('value' => $result['hosp_city']),
				'hospital_state' => array('value' => $result['hosp_state']),
				'hospital_post_code' => array('value' => $result['hosp_post_code']),
				'hospital_email' => array('value' => $result['hosp_email']),
				'hospital_number' => array('value' => $result['hosp_phone']),
				'hospital_mobile_num' => array('value' => $result['hosp_mobile']),
				'hospital_fax' => array('value' => $result['hosp_fax']),
				'hospital_website' => array('value' => $result['hosp_website']),
				'hospital_name' => array('value' => $group_result[0]['description']),
				'hospital_initials_1' => array('value' => $group_result[0]['first_initial']),
				'hospital_initials_2' => array('value' => $group_result[0]['last_initial']),
			);
			return $hospital_info;
		}
	}

	public function get_hospital_users() {
		$hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
      AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
      AES_DECRYPT(email, '" . DATA_KEY . "') AS email
      ", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->where('group_id', $hospital_id);
		$result = $this->db->get('users_groups')->result_array();
		return $result;
	}

	public function getClinicDetails($user_id) {
		$results = $this->db
			->select("*")
			->where('user_id', $user_id)
			->where('institute_id is NOT NULL')
			->get('users_groups')->row_array();

		if (empty($results)) {
			return array();
		} else {
			return $results;
		}
	}

	public function save_hospital_data($main_group_info, $hospital_info) {
		$group_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$this->db->set($main_group_info);
		$this->db->where('id', $group_id);
		$this->db->update('`groups`');

		$this->db->select('*');
		$this->db->where('group_id', $group_id);
		$result = $this->db->get('hospital_information')->result_array();
		if (empty($result)) {
			$hsopital_info['group_id'] = $group_id;
			$this->db->insert('hospital_information', $hospital_info);
		} else {
			$this->db->set($hospital_info);
			$this->db->where('group_id', $group_id);
			$this->db->update('hospital_information');
		}
	}

	public function save_hospital_data_new($main_group_info, $hospital_info) {

		//$group_id = $this->ion_auth->get_users_groups()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups()->row()->id;

		$this->db->update('groups', $main_group_info, ['id' => $group_id]);
		$whereArr = ['group_id' => $group_id];
		$count = $this->db->get_where('hospital_information', $whereArr)->num_rows();
		if ($count > 0) {
			$this->db->update('hospital_information', $hospital_info, $whereArr);
		} else {
			$hospital_info['group_id'] = $group_id;
			$this->db->insert('hospital_information', $hospital_info);
		}
	}

	public function courier_selection_data($table, $select, $where, $groupby) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
		$this->db->select($select, FALSE);
		$this->db->where($where);
		$this->db->group_by($groupby);
		$res = $this->db->get($table)->result_array();
		return $res;
	}

	public function get_pathologists($hospital_id = "") {
		$rows = $this->db->get_where('groups', array('id', $hospital_id))->num_rows();
		if ($rows === 0) {
			$user_id = $this->ion_auth->user()->row()->id;
			$hospital_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		}

		$results = $this->db
			->select("DISTINCT `user_id`", FALSE)
			->where('institute_id', $hospital_id)
			->get('users_groups')->result_array();
		if (empty($results)) {
			return array();
		}
		$ids = array();
		foreach ($results as $res) {
			array_push($ids, $res['user_id']);
		}
		$this->db->distinct();
		$users = $this->db
			->select("
                users.id,
                AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name,
                AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,
                AES_DECRYPT(users.email, '" . DATA_KEY . "') AS email,
                AES_DECRYPT(users.phone, '" . DATA_KEY . "') AS phone,
                AES_DECRYPT(users.company, '" . DATA_KEY . "') AS company,
                profile_picture_path as profile_picture
                ")
			->join("users_groups", "users_groups.user_id = users.id")
			->join("groups", "groups.id = users_groups.group_id")
			->where("users.id in (" . implode(",", $ids) . ")", "", FALSE)
			->where("users.user_type", "D")
			->get("users")->result_array();

		return $users;
	}

	public function fetch_all_hospitals() {
		return $this->db->get_where('groups', ['group_type' => 'H'])->result_array();
	}

	public function getUsersLogins($status = FALSE, $explodeDate = FALSE) {
		//        $hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
		$this->db->select("userlogin_activity.*,profile_picture_path,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
      AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('userlogin_activity', 'users.id = userlogin_activity.session_userid');
		$this->db->join('ip_location', 'ip_location.ip_address = userlogin_activity.client_ip', 'LEFT');
		$this->db->where('institute_id', $hospital_id);
		if ($explodeDate) {
			$this->db->where("login_time>=", strtotime(date("Y-m-d", strtotime($explodeDate[0])) . " 00:00:01"));
			$this->db->where("login_time<=", strtotime(date("Y-m-d", strtotime($explodeDate[1])) . " 23:59:59"));
		}
		if (!$status) {
			$this->db->limit(5);
		}
		$this->db->order_by("login_time", "DESC");
		$result = $this->db->get('users_groups')->result();
		return $result;
	}

	public function getLoginDetail($userDetail = FALSE, $explodeDate = FALSE) {
		//        $hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
		$this->db->select("userlogin_log.*,profile_picture_path,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
      AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('userlogin_log', 'users.id = userlogin_log.session_userid');
		$this->db->join('ip_location', 'ip_location.ip_address = userlogin_log.client_ip', 'LEFT');
		$this->db->where('institute_id', $hospital_id);
		$this->db->where('session_userid', $userDetail[0]);
		$this->db->where('client_ip', $userDetail[1]);
		if ($explodeDate) {
			$this->db->where("login_time>=", strtotime(date("Y-m-d", strtotime($explodeDate[0])) . " 00:00:01"));
			$this->db->where("login_time<=", strtotime(date("Y-m-d", strtotime($explodeDate[1])) . " 23:59:59"));
		}
		$this->db->order_by("login_time", "DESC");
		$result = $this->db->get('users_groups')->result();
		return $result;
	}

	public function getAllLoginDetail($explodeDate = FALSE) {
		//        $hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
		$this->db->select("userlogin_log.*,profile_picture_path,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
      AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('userlogin_log', 'users.id = userlogin_log.session_userid');
		$this->db->join('ip_location', 'ip_location.ip_address = userlogin_log.client_ip', 'LEFT');
		$this->db->where('institute_id', $hospital_id);
		if ($explodeDate) {
			$this->db->where("login_time>=", strtotime(date("Y-m-d", strtotime($explodeDate[0])) . " 00:00:01"));
			$this->db->where("login_time<=", strtotime(date("Y-m-d", strtotime($explodeDate[1])) . " 23:59:59"));
		} else {
			$start_date = strtotime(date("Y-m-01 00:00:01"));
			$end_date = strtotime(date("Y-m-t 23:59:59"));
			$this->db->where("login_time>=", $start_date);
			$this->db->where("login_time<=", $end_date);
		}
		$this->db->order_by("login_time", "DESC");
		$result = $this->db->get('users_groups')->result();
		return $result;
	}

	public function get_hospital_finance() {
		$hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		//$hospital_id = $this->ion_auth->get_users_groups()->row()->id;
		$this->db->select('*');
		$this->db->from('`hospital_finance_details`');
		$this->db->where('hospital_id', $hospital_id);
		$finance_result = $this->db->get()->result_array();
		return $finance_result;
	}

	public function save_hospital_financedata($hospital_info) {
		$hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$this->db->select('*');
		$this->db->where('hospital_id', $hospital_id);
		$result = $this->db->get('hospital_finance_details')->result_array();
		if (empty($result)) {
			$this->db->insert('hospital_finance_details', $hospital_info);
		} else {
			$this->db->set($hospital_info);
			$this->db->where('hospital_id', $hospital_id);
			$this->db->update('hospital_finance_details');
		}
	}

	public function save_hospital_financedata_new($hospital_info) {
		//$hospital_id = $this->ion_auth->get_users_groups()->row()->id;
		$hospital_id = $this->ion_auth->get_users_main_groups()->row()->id;
		$whereArr = ['hospital_id' => $hospital_id];
		$count = $this->db->get_where('hospital_finance_details', $whereArr)->num_rows();
		if ($count > 0) {
			$this->db->update('hospital_finance_details', $hospital_info, $whereArr);
		} else {
			$this->db->insert('hospital_finance_details', $hospital_info);
		}
	}

	public function getLabsUsersGroup() {
		$query = "SELECT * FROM groups where parent_group_type = 'L' AND group_type !='LA'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	public function get_courier_users($institute_id = FALSE) {
		//     $this->db->select("AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
		//   AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
		//   AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
		//   AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.id as user_id,profile_picture_path,
		//   AES_DECRYPT(username, '" . DATA_KEY . "') AS username,usermeta1.meta_value as address1,usermeta2.meta_value as address2");
		//     $this->db->join("users", "courier_users.user_id=users.id");
		//     $this->db->join("usermeta as usermeta1", "courier_users.user_id=usermeta1.user_id AND usermeta1.meta_key='address1'", "LEFT");
		//     $this->db->join("usermeta as usermeta2", "courier_users.user_id=usermeta2.user_id AND usermeta2.meta_key='address2'", "LEFT");
		//     if ($institute_id) {
		//         $this->db->where("courier_users.hospital_lab_id", $institute_id);
		//     }
		//     $result = $this->db->get("courier_users");
		//     return $result;
		$lab_id = $this->ion_auth->get_users_main_groups()->row()->id;

		$last_login_query = "(SELECT user_id, MAX(last_activity) as last_login_date FROM login_data group by user_id) lg";
		$request_query = "(SELECT request_add_user, count(request_add_user) as request_count FROM request group by request_add_user) rq";
		$courier_query = "(SELECT created_by, count(created_by) as courier_count FROM tbl_courier group by created_by) cr";
		$enq_query = "(SELECT ticket_created_by, count(ticket_created_by) as enq_count FROM lab_enquiries group by ticket_created_by) enq";
		$doc_query = "(SELECT uploaded_by, count(uploaded_by) as doc_count FROM uralensis_upload_forms group by uploaded_by) doc";
		$this->db->select("`users`.`id` as user_id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
    AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,profile_picture_path,last_login,users.user_type,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
    AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.active, aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone, users.in_directory, groups.description, groups.first_initial, groups.last_initial, users_groups.group_id, groups.group_type, groups.type_cate,
    lg.last_login_date, ifnull(rq.request_count, 0) as request_count, ifnull(cr.courier_count, 0) as courier_count, ifnull(enq.enq_count,0) as enq_count, ifnull(doc.doc_count,0) as doc_count", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('groups', 'users.user_type = groups.group_type', 'left');
		$this->db->join($last_login_query, 'lg.user_id = users.id', 'left');
		$this->db->join($request_query, 'rq.request_add_user = users.id', 'left');
		$this->db->join($courier_query, 'cr.created_by = users.id', 'left');
		$this->db->join($enq_query, 'enq.ticket_created_by = users.id', 'left');
		$this->db->join($doc_query, 'doc.uploaded_by = users.id', 'left');
		$this->db->where('institute_id', $lab_id);
		$this->db->where('users.deleted', 0);
		$this->db->group_by('users.id');
		$result = $this->db->get('users_groups');
		return $result;
	}

	public function get_user_institutes($user_id = FALSE) {
		$query = $this->db->query("SELECT
      groups.id,groups.name,hospital_information.hosp_address FROM users_groups
      JOIN groups on users_groups.institute_id=groups.id
      LEFT JOIN hospital_information on groups.id=hospital_information.group_id
      WHERE users_groups.user_id=$user_id AND users_groups.group_id IS NULL");
		//   echo $this->db->last_query();exit;;
		//        $result = $this->db->query($query)->result();
		return $query;
	}

	public function get_user_institutesdetails($user_id = FALSE) {
		$query = $this->db->query("SELECT
      groups.id,groups.name,hospital_information.hosp_address FROM users_groups
      JOIN groups on users_groups.institute_id=groups.id
      LEFT JOIN hospital_information on groups.id=hospital_information.group_id
      WHERE users_groups.user_id=$user_id");
		//   echo $this->db->last_query();exit;;
		//        $result = $this->db->query($query)->result();
		return $query;
	}

	public function get_user_laboratories($user_id = FALSE) {
		$query = $this->db->query("SELECT
      g2.id,
      g2.description as name, CONCAT(g2.first_initial,'',g2.last_initial) as lab_initial
      FROM
      users_groups
      JOIN groups ON users_groups.institute_id = groups.id
      INNER JOIN hospital_group ON groups.id = hospital_group.hospital_id
      INNER JOIN groups as g2 ON hospital_group.group_id = g2.id
      WHERE
      users_groups.user_id = $user_id AND users_groups.group_id IS NULL
      GROUP BY g2.id");
		//        $result = $this->db->query($query)->result();
		return $query;
	}

	public function get_institute_users() {
		$is_admin = $this->ion_auth->in_group('admin');
		$whereClause = "WHERE 1=1";
		if (!$is_admin) {
			$hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
			$whereClause .= " AND users_groups.institute_id=$hospital_id";
		}

		$query = $this->db->query("SELECT
      aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
      aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
      aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
      users.id as user_id,users.status as user_status,
      active, profile_picture_path,group_id,
      `groups`.`description` as `description`,
      `groups`.`group_type` as `group_type`,
      `groups`.`first_initial`,
      `groups`.`last_initial`,
      `groups`.`type_cate`
      FROM users
      INNER JOIN users_groups ON users_groups.user_id = users.id
      LEFT JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id` $whereClause");

		//        $result = $this->db->query($query)->result();
		return $query;
	}

	public function get_courier_log($consignment_no, $col_log = FALSE) {
		//        $is_admin = $this->ion_auth->in_group('admin');
		//        $whereClause = "";
		//        if (!$is_admin) {
		//            $userIds = $this->get_institute_users()->result_array();
		//            $userIds = implode(', ', array_map(function ($entry) {
		//                return $entry['user_id'];
		//            }, $userIds));
		//            $userIds = (empty($userIds)?0:$userIds);
		//            $whereClause .= " AND courier_tracking.user_id IN ($userIds)";
		//        }
		$whereClause = "";
		if ($col_log) {
			$whereClause .= "courier_tracking.courier_id='$consignment_no' ";
		} else {
			$whereClause .= "tbl_courier.consignment_no='$consignment_no' ";
		}
		//        $whereClause1 = $whereClause1.$whereClause;
		$query = $this->db->query("SELECT
      aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
      aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
      aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
      users.id as user_id,users.status as user_status,
      profile_picture_path,courier_tracking.*,
      tbl_courier.sender_email,tbl_courier.sender_company,tbl_courier.sender_phone_no,tbl_courier.sender_address1,
      tbl_courier.receiver_email,tbl_courier.receiver_company,tbl_courier.receiver_phone_no,tbl_courier.receiver_address1
      FROM courier_tracking
      JOIN tbl_courier ON  courier_tracking.courier_id=tbl_courier.id
      JOIN users on users.id=courier_tracking.user_id
      WHERE $whereClause ORDER BY courier_tracking.created_date DESC
      ");

		//        $result = $this->db->query($query)->result();
		return $query;
	}

	public function get_institute_team_count($groupId) {
		$query = "select count(*) as team_count
                  from users_groups hi
                  join users on hi.user_id=users.id
                  where hi.group_id=$groupId and users.deleted=0";
		$result = $this->db->query($query)->row_array();
		return $result['team_count'];
	}

	public function count_total_users($hos_id = FALSE, $group_type = '') {
		$sql = "SELECT count(*) as value FROM hospital_group JOIN groups on hospital_group.group_id=groups.id WHERE hospital_group.hospital_id='$hos_id' AND groups.group_type='$group_type'";

		$your_count = $this->db->query($sql, array($your_field))->row(0)->value;
		return $your_count;
	}

	public function count_total_lab($hos_id = FALSE, $group_type = '') {

		$sql = "SELECT count(*) as value FROM users_groups JOIN users on users_groups.user_id=users.id WHERE users_groups.institute_id='$hos_id' AND users.user_type='$group_type'";

		$your_count = $this->db->query($sql, array($your_field))->row(0)->value;
		return $your_count;
	}

	public function getHospitalLabs($hospitalId) {
		$sql = "SELECT groups.id,groups.description
                FROM hospital_group
                JOIN groups on hospital_group.group_id=groups.id
                WHERE hospital_group.hospital_id='$hospitalId' AND groups.group_type='L'";
		$result = $this->db->query($sql)->result();
		return $result;
	}

	public function select_where($select, $table, $where = FALSE, $order_by = FALSE) {
		$this->db->select($select);
		if ($where) {
			$this->db->where($where);
		}
		if ($order_by) {
			$this->db->order_by($order_by);
		}
		$result = $this->db->get($table);
		return $result;
	}

	public function get_insitute_users($hospital_id = '', $group_id = '') {
		$lab_id = $this->ion_auth->get_users_main_groups()->row()->id;
		if ($group_id != '') {
			$lab_id = $group_id;
		}
		$last_login_query = "(SELECT user_id, MAX(last_activity) as last_login_date FROM login_data group by user_id) lg";
		$request_query = "(SELECT request_add_user, count(request_add_user) as request_count FROM request group by request_add_user) rq";
		$courier_query = "(SELECT created_by, count(created_by) as courier_count FROM tbl_courier group by created_by) cr";
		$enq_query = "(SELECT ticket_created_by, count(ticket_created_by) as enq_count FROM lab_enquiries group by ticket_created_by) enq";
		$doc_query = "(SELECT uploaded_by, count(uploaded_by) as doc_count FROM uralensis_upload_forms group by uploaded_by) doc";
		$this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,profile_picture_path,last_login,users.user_type,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.active, aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone, users.in_directory, groups.description, groups.first_initial, groups.last_initial, users_groups.group_id, groups.group_type, groups.type_cate,
        lg.last_login_date, ifnull(rq.request_count, 0) as request_count, ifnull(cr.courier_count, 0) as courier_count, ifnull(enq.enq_count,0) as enq_count, ifnull(doc.doc_count,0) as doc_count", FALSE);
		$this->db->join('users', 'users.id = users_groups.user_id');
		$this->db->join('groups', 'users.user_type = groups.group_type', 'left');
		$this->db->join($last_login_query, 'lg.user_id = users.id', 'left');
		$this->db->join($request_query, 'rq.request_add_user = users.id', 'left');
		$this->db->join($courier_query, 'cr.created_by = users.id', 'left');
		$this->db->join($enq_query, 'enq.ticket_created_by = users.id', 'left');
		$this->db->join($doc_query, 'doc.uploaded_by = users.id', 'left');
		$this->db->where('institute_id', $lab_id);
		$this->db->group_by('users.id');
		$result = $this->db->get('users_groups')->result_array();
		// echo $this->db->last_query();exit;
		return $result;
	}
}
