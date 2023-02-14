<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Admin_model extends CI_Model
{
    public $table = 'request';
    public $column_order = array(null, 'f_name', 'sur_name'); //set column field database for datatable orderable
    public $column_search = array('serial_number', 'f_name', 'sur_name', 'emis_number', 'nhs_number', 'lab_number', 'gender'); //set column field database for datatable searchable
    public $order = array('uralensis_request_id' => 'asc'); // default order

    /**
     * Prepare Datatables Record Query
     *
     * @param string $year
     * @param string $recent
     * @param string $flag_type
     * @return void
     */
    private function _get_datatables_record_query($year, $recent = '', $flag_type = '',$doc_ids='',$user_ids='')
    {
        $this->db->select('*');
       
	    $this->db->from($this->table);

        if (!empty($flag_type)) 
		{
            $this->db->where('flag_status', $flag_type);
        }
		if (!empty($user_ids)) 
		{
            $this->db->where('request_add_user', $user_ids);
        }
        if (!empty($recent) && $recent === 'recent') 
		{
            $this->db->where('AND request_datetime >=', 'DATE_SUB(CURDATE(), INTERVAL 2 MONTH)');
        }
        if (!empty($doc_ids)) 
		{
			//$docs_ids =;
            $this->db->where("uralensis_request_id IN (SELECT DISTINCT(request_id) FROM request_assignee where user_id IN ($doc_ids))");
        }
		
		//$this->db->where("uralensis_request_id IN (SELECT DISTINCT(request_id) FROM request_assignee where user_id IN ($doc_ids))");
		
        $this->db->order_by('uralensis_request_id', 'ASC');

        $i = 0;
        foreach ($this->column_search as $item) 
		{ // loop column
            if (!empty($_POST['search']) && $_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) { //last loop
                    $this->db->group_end();
                } //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	
	
	
	private function _get_datatables_publishrecord_query($year, $recent = '', $flag_type = '',$doc_ids='',$user_ids='')
    {
        $this->db->select('*');
       
	    $this->db->from($this->table);
        $this->db->where('publish_status', '1');
        if (!empty($flag_type)) 
		{
            $this->db->where('flag_status', $flag_type);
        }
		
		
		if (!empty($user_ids)) 
		{
            $this->db->where('request_add_user', $user_ids);
        }
        if (!empty($recent) && $recent === 'recent') 
		{
            $this->db->where('AND request_datetime >=', 'DATE_SUB(CURDATE(), INTERVAL 2 MONTH)');
        }
        if (!empty($doc_ids)) 
		{
			//$docs_ids =;
           // $this->db->where("uralensis_request_id IN (SELECT DISTINCT(request_id) FROM request_assignee where user_id IN ($doc_ids))");
        }
		
		//$this->db->where("uralensis_request_id IN (SELECT DISTINCT(request_id) FROM request_assignee where user_id IN ($doc_ids))");
		
        $this->db->order_by('uralensis_request_id', 'ASC');

        $i = 0;
        foreach ($this->column_search as $item) 
		{ // loop column
            if (!empty($_POST['search']) && $_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) { //last loop
                    $this->db->group_end();
                } //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	

    /**
     * number of published and unpublished report total
     *
     */
    public function gettotalpublishedunpublishedreports($year = "")
    {
        $where = "";
        if ($year != "") {
            $where = " AND YEAR(request.publish_datetime)=" . $year;
        }
        $sql = "SELECT request.specimen_publish_status,COUNT(*) AS TOTROWS FROM request
     INNER JOIN users_request INNER JOIN `groups` WHERE users_request.request_id = request.uralensis_request_id " . $where . "
         AND `groups`.id = users_request.group_id GROUP BY request.specimen_publish_status";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        if (count($result) === 0) {
            array_push($result, array('specimen_publish_status' => 1, 'TOTROWS' => 0));
            array_push($result, array('specimen_publish_status' => 0, 'TOTROWS' => 0));
        } else if (count($result) === 1) {
            if ($result[0]['specimen_publish_status'] === 1) {
                array_push($result, array('specimen_publish_status' => 0, 'TOTROWS' => 0));
            } else {
                array_push($result, array('specimen_publish_status' => 1, 'TOTROWS' => 0));
            }
        }
        return $result;

    }


    /**
     * Number of further works
     *
     */
    public function totalnumbersoffurtherwork($year = "")
    {
        $where = "";
        if ($year != "") {
            $where = " AND YEAR(request.request_datetime)=" . $year;
        }

        $sql = "SELECT COUNT(*) AS TOTROWS FROM further_work
    INNER JOIN `groups`
    INNER JOIN request
    INNER JOIN users
    INNER JOIN request_assignee
    INNER JOIN users_request
    WHERE further_work.request_id = request.uralensis_request_id
    AND `groups`.id = users_request.group_id
    AND request_assignee.user_id = further_work.doctor_id
    AND further_work.doctor_id = users.id
    AND request_assignee.request_id = further_work.request_id
    AND users_request.request_id = request.uralensis_request_id " . $where;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Number of TAT more than 10 days
     *
     */
    public function tottattendays()
    {
        $current_date = date('Y-m-d');
        $ten_days_ago = date('Y-m-d', strtotime('-10 days', strtotime($current_date)));
        $sql = "SELECT COUNT(*) AS TOTROWS FROM request
    INNER JOIN users_request
    INNER JOIN `groups`
    WHERE users_request.request_id = request.uralensis_request_id
    AND `groups`.id = users_request.group_id
    AND request.specimen_publish_status = 0
    AND request.date_taken <= '" . $current_date . "' AND request.date_taken >= '" . $ten_days_ago . "'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * number of published and unpublished report total
     *
     */
    public function getpublishedcases($year = "")
    {
        $where = "";
        if ($year != "") {
            $where = " AND YEAR(request.publish_datetime)=" . $year;
        }
        $sql = "SELECT * FROM request INNER JOIN users_request 
    INNER JOIN `groups` WHERE users_request.request_id = request.uralensis_request_id
     AND `groups`.id = users_request.group_id order by request_datetime DESC LIMIT 5";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function display_hospitals_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        $query = $this->db->query("SELECT users.id AS userid,user_status,users.status,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email,description
        FROM `groups`  
        INNER JOIN users_groups ON users_groups.group_id=`groups`.id
        INNER JOIN users ON users.id=users_groups.user_id
        WHERE `groups`.group_type = 'H' AND users.status=1
         ORDER BY `groups`.id DESC LIMIT 5");
        return $query->result();
    }

    /**
     * Display Further Work
     *
     * @return array
     */
    public function display_further_work_model_requested()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query(
            "SELECT  users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(username, '" . DATA_KEY . "') AS username,
        fw_id, request_id, furtherword_description, furtherwork_date, furtherwork_status, furtherwork_to_emails, hospital_id, doctor_id, group_id, fw_status, fw_preview_template,
        uralensis_request_id, record_batch_id, serial_number, ura_barcode_no, patient_initial, pci_number, request_datetime, publish_datetime, publish_datetime_modified, emis_number, nhs_number, lab_number, hos_number, sur_name, f_name, dob, age, lab_name, date_received_bylab, data_processed_bylab, date_sent_touralensis, date_rec_by_doctor, gender, clrk, dermatological_surgeon, date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id, request.status, assign_status, specimen_update_status, specimen_publish_status, further_work_status, supplementary_report_status, supplementary_review_status, report_status, publish_status, hospital_group_id, additional_data_state, comment_section, comment_section_date, teaching_case, mdt_case, mdt_case_status, mdt_list_id, mdt_specimen_status, mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos, fw_imf, special_notes, special_notes_date, record_secretary_id, record_assign_sec_time, record_secretary_status, secretary_record_edit_status, cases_category, cost_codes, flag_status, authorize_status, request_add_user, request_add_user_timestamp, clinic_ref_number, clinic_request_form, request_code_status, record_edit_status, request_assign_status, ura_rec_temp_dataset
        
         FROM `further_work`
                INNER JOIN request
                INNER JOIN users
                WHERE 
                 request.uralensis_request_id = further_work.request_id
                 AND further_work.fw_status = 'requested'"
        );
        return $query->result();
    }

    /**
     * Display Further Work
     *
     * @return array
     */
    public function display_further_work_model_requested_Count()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query(
            "SELECT COUNT(*) AS TOTROWS
         FROM `further_work`
                INNER JOIN request
                INNER JOIN users
                WHERE 
                 request.uralensis_request_id = further_work.request_id
                 AND further_work.fw_status = 'requested'"
        );
        return $query->result();
    }
	
	
	public function display_all_requested_Count()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query(
            "SELECT COUNT(*) AS TOTROWS
         FROM `request` where publish_status='1'"
        );
        return $query->result();
    }

    /**
     * Display Further Work Completed
     *
     * @return array
     */
    public function display_further_work_model_completed()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(username, '" . DATA_KEY . "') AS username,
        fw_id, request_id, furtherword_description, furtherwork_date, furtherwork_status, furtherwork_to_emails, hospital_id, doctor_id, group_id, fw_status, fw_preview_template,
        uralensis_request_id, record_batch_id, serial_number, ura_barcode_no, patient_initial, pci_number, request_datetime, publish_datetime, publish_datetime_modified, emis_number, nhs_number, lab_number, hos_number, sur_name, f_name, dob, age, lab_name, date_received_bylab, data_processed_bylab, date_sent_touralensis, date_rec_by_doctor, gender, clrk, dermatological_surgeon, date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id, request.status, assign_status, specimen_update_status, specimen_publish_status, further_work_status, supplementary_report_status, supplementary_review_status, report_status, publish_status, hospital_group_id, additional_data_state, comment_section, comment_section_date, teaching_case, mdt_case, mdt_case_status, mdt_list_id, mdt_specimen_status, mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos, fw_imf, special_notes, special_notes_date, record_secretary_id, record_assign_sec_time, record_secretary_status, secretary_record_edit_status, cases_category, cost_codes, flag_status, authorize_status, request_add_user, request_add_user_timestamp, clinic_ref_number, clinic_request_form, request_code_status, record_edit_status, request_assign_status, ura_rec_temp_dataset
         FROM `further_work`
                INNER JOIN request
                INNER JOIN users
                WHERE request.uralensis_request_id = further_work.request_id
               AND further_work.fw_status = 'complete'");
        return $query->result();
    }

    public function doctor_record_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request
            INNER JOIN request_assignee
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false'");

        return $query->result();
    }

    /**
     * Get Clinic list
     *
     * @return void
     */
    public function get_clinic()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users WHERE users.user_type = 'C'";
        $query = $this->db->query($sql);
        return $query->result();
    }


    /**
     * Display Further Work Completed COUNT
     *
     * @return array
     */
    public function display_further_work_model_completed_Count()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        if ($user_id != "") {
            $query = $this->db->query("SELECT COUNT(*) AS TOTROWS
         FROM `further_work`
                INNER JOIN request
                INNER JOIN users
                WHERE request.uralensis_request_id = further_work.request_id
                AND users.id = $user_id AND further_work.fw_status = 'complete'");
        } else {

            $query = $this->db->query("SELECT COUNT(*) AS TOTROWS
         FROM `further_work`
                INNER JOIN request
                INNER JOIN users
                WHERE request.uralensis_request_id = further_work.request_id
                AND further_work.fw_status = 'complete'");
        }

        return $query->result();
    }

    /**
     * Display Records
     *
     * Display Records
     *
     * @param string $year
     * @param string $recent
     * @param string $flag_type
     * @return void
     */
    public function display_admin_record($year, $recent = '', $flag_type = '', $doc_ids='', $user_ids='')
    {		
        $this->_get_datatables_record_query($year, $recent = '', $flag_type,$doc_ids,$user_ids);
        if (!empty($_POST['length']) && $_POST['length'] != -1) {
            $this->db->limit(intval($_POST['length']), $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
	
	public function display_admin_publishrecord($year, $recent = '', $flag_type = '', $doc_ids='', $user_ids='')
    {		
        $this->_get_datatables_publishrecord_query($year, $recent = '', $flag_type,$doc_ids,$user_ids);
        if (!empty($_POST['length']) && $_POST['length'] != -1) {
            $this->db->limit(intval($_POST['length']), $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
	
	
	
	
	
	

    public function display_admin_filter_record($year, $recent = '', $flag_type = '',$doc_ids='')
    {
        if (!empty($flag_type)) {
            $this->db->where('flag_status', $flag_type);
        }
        if (!empty($recent) && $recent === 'recent') {
            $this->db->where('AND request_datetime >=', 'DATE_SUB(CURDATE(), INTERVAL 2 MONTH)');
        }
       
	   		$sql = "SELECT * FROM request where uralensis_request_id IN (SELECT DISTINCT(request_id) FROM request_assignee where user_id IN ($doc_ids))";
			if (!empty($_POST['length']) && $_POST['length'] != -1) {
            $this->db->limit(intval($_POST['length']), $_POST['start']);
        }
			$this->db->order_by('uralensis_request_id', 'ASC');
            return $this->db->query($sql)->result_array();	   	   
    }

    /**
     * Filter Record Count
     *
     * @param string $year
     * @param string $recent
     * @param string $flag_type
     * @return void
     */
    public function record_count_filtered($year, $recent = '', $flag_type = '')
    {
        $this->_get_datatables_record_query($year, $recent = '', $flag_type);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Count All Records
     *
     * @return void
     */
    public function record_count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    /**
     * Display Records
     *
     * @param string $year
     * @param string $recent
     * @return void
     */
    public function display_record($year, $recent = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($year)) {
            $sql = "";
            $sql .= "SELECT * FROM request
                WHERE YEAR(request.request_datetime) = $year ";
            if (!empty($recent) && $recent === 'recent') {
                $sql .= " AND request.request_datetime >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH) ";
            }
            $sql .= " ORDER BY request.uralensis_request_id ASC";
            $query = $this->db->query($sql);
            return $query->result();
        }
    }
	
	
	public function display_user_record($user_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($user_id)) {
            $sql = "";
            $sql .= "SELECT * FROM request
                WHERE YEAR(request.request_add_user) = $user_id";
            if (!empty($recent) && $recent === 'recent') {
                $sql .= " AND request.request_datetime >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) ";
            }
            $sql .= " ORDER BY request.uralensis_request_id ASC";
            $query = $this->db->query($sql);
            return $query->result();
        }
    }

    /**
     * Display Unassigned records
     *
     * @param string $year
     * @return void
     */
    public function display_unassigned_records($year)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($year)) {
            $query = $this->db->query("SELECT * FROM request
                        WHERE YEAR(request.request_datetime) = $year
                        AND request.assign_status = 0
                        ORDER BY request.uralensis_request_id DESC");
            return $query->result();
        }
    }
	
	public function display_published_records($year)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($year)) {
            $query = $this->db->query("SELECT * FROM request
                        WHERE YEAR(request.request_datetime) = $year
                        AND request.publish_status = 1
                        ORDER BY request.uralensis_request_id DESC");
            return $query->result();
        }
    }
	
	 public function display_unassigned_users_records($user_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($user_id)) {
            $query = $this->db->query("SELECT * FROM request
                        WHERE YEAR(request.request_add_user) = $user_id
                        AND request.assign_status = 0
                        ORDER BY request.uralensis_request_id DESC");
            return $query->result();
        }
    }

    /**
     * Detail Record View Request
     *
     * @param int $id
     * @return void
     */
    public function detail_record_view_request($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query1 = $this->db->query("SELECT * FROM request
                        INNER JOIN users_request
                        INNER JOIN users
                        WHERE request.uralensis_request_id = $id
                        AND users_request.request_id = $id
                        AND users_request.users_id = users.id");
        return $query1->result();
    }

    /**
     * Detail Record Specimen Data
     *
     * @param int $id
     * @return void
     */
    public function detail_record_view_specimen($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query2 = $this->db->query("SELECT * FROM request
                            INNER JOIN users_request
                            INNER JOIN users
                            INNER JOIN specimen
                            WHERE request.uralensis_request_id = $id
                            AND users_request.request_id = $id
                            AND specimen.request_id = $id
                            AND users_request.users_id =  users.id");
        return $query2->result();
    }

    /**
     * Get Doctors Data
     *
     * @return void
     */
    public function get_doctors()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users WHERE users.user_type = 'D'";
        $query = $this->db->query($sql);
        return $query->result();
    }
	
	 public function get_doctor_by_id($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
      $sql = "SELECT AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name FROM users as users join request_assignee as req on users.id=req.user_id WHERE users.user_type = 'D' and req.request_id=$id";
		
		$query = $this->db->query($sql);
        return $query->result();
    }
	
	 public function get_assigned_doctors()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
      $sql = "SELECT AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name,users.id as id,profile_picture_path  FROM users  WHERE users.user_type = 'D' and users.id IN (select distinct(user_id) from request_assignee)";
		
		$query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Assign Doctor To Record
     *
     * @param array $request_assign
     * @param int $req_id
     * @return void
     */
    public function save_assign_doctor($request_assign, $req_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->insert("request_assignee", $request_assign);
        $args = array(
            'assign_status' => 1,
            'report_status' => 1
        );
        $this->db->where('uralensis_request_id', $req_id);
        $this->db->update("request", $args);
    }

    /**
     * Get Doctor Name
     *
     * @return void
     */
    public function get_doctor_name()
    {
        $req_id = $this->session->userdata('id');
        $users = $this->db->query("SELECT users.first_name, users.last_name FROM users
                                INNER JOIN request_assignee
                                WHERE request_assignee.request_id = $req_id
                                AND users.id = request_assignee.user_id");
        return $users->result();
    }

    /**
     * Get Search Request
     *
     * @param string $emis_no
     * @param string $nhs_no
     * @param string $f_name
     * @param string $l_name
     * @param string $lab_no
     * @return array
     */
    public function get_search_request($emis_no, $nhs_no, $f_name, $l_name, $lab_no)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $where = array();

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
     * Insert Specimen Record
     *
     * @param array $specimen
     * @return void
     */
    public function insert_specimen_admin($specimen)
    {
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
     * Assign record to specimen
     *
     * @return void
     */
    public function admin_request_specimen_add()
    {
        $request_id = $this->session->userdata('specimen_request_id');
        $specimen_id = $this->session->userdata('specimen_id');
        $data = array('rs_request_id' => $request_id, 'rs_specimen_id' => $specimen_id);
        $this->db->insert('request_specimen', $data);
    }

    /**
     * Return Hospital Users
     *
     * @return void
     */
    public function get_show_users_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $get_users_detail_query = "SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, users.id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users
                            INNER JOIN users_groups
                            WHERE users.id = users_groups.user_id
                            AND users.user_type = 'H'";
        $show_users_query = $this->db->query($get_users_detail_query);
        return $show_users_query->result();
    }

    /**
     * Get All Doctors List
     *
     * @return void
     */
    public function get_all_doctor_users_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $get_users_query = "SELECT id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users
                            WHERE users.user_type = 'D'";
        $show_users = $this->db->query($get_users_query);
        return $show_users->result();
    }

    /**
     * Get All Secretary Details
     *
     * @return void
     */
    public function get_all_secretary_users_detail()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $get_users_query = "SELECT  id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users
                            WHERE users.user_type = 'S'";
        $show_users = $this->db->query($get_users_query);
        return $show_users->result();
    }

    /**
     * Upload Center
     * Function That will insert the data into db.
     * @param $filename
     * @param $title
     * @param $path
     * @param $file_ext
     * @param $is_image
     * @param $request_type
     * @param $rtype_code
     * @param $admin_id
     */
    public function upload_center_form_model($filename, $title, $path, $file_ext, $is_image, $request_type, $rtype_code, $admin_id)
    {
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
            'upc_uploader_id' => $admin_id
        );
        $this->db->insert('uralensis_uplaod_center', $data);
    }

    /**
     * Upload Request Forms
     *
     * @return void
     */
    public function get_upc_requestforms()
    {
        $get_request_docs = $this->db->query("SELECT * FROM uralensis_uplaod_center
                                WHERE upc_file_type_code = 'rf'
                                ORDER BY upc_file_id DESC");
        return $get_request_docs->result();
    }

    /**
     * Upload Checklist Forms
     *
     * @return void
     */
    public function get_upc_checklistforms()
    {
        $get_checklist_docs = $this->db->query("SELECT * FROM uralensis_uplaod_center
                                    WHERE upc_file_type_code = 'cf'
                                    ORDER BY upc_file_id DESC");
        return $get_checklist_docs->result();
    }

    /**
     * Get all hospital users
     *
     * @return void
     */
    public function get_all_hospital_users()
    {
        $get_hospital_users = $this->db->query("SELECT id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users
                                WHERE user_type = 'H'
                                ORDER BY id ASC");
        return $get_hospital_users->result();
    }

    /**
     * Get hospital users by group id.
     * @param type $group_id
     * @return type
     */
    public function get_all_hospital_users_by_group($group_id = '')
    {
        $query = array();
        if (!empty($group_id)) {
            $this->db->select('u.id, u.first_name, u.last_name');
            $this->db->from('`groups` AS g');
            $this->db->join('users_groups AS ug', 'g.id = ug.group_id', 'INNER');
            $this->db->join('users AS u', 'u.id = ug.user_id', 'INNER');
            $this->db->where('g.id', $group_id);
            $query = $this->db->get()->result_array();
        }
        return $query;
    }

    /**
     * Get Lab Name Records
     * @return type Array
     */
    public function get_lab_names()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        return $this->db->where('group_type', 'L')->get('`groups`')->result_array();
    }

    /**
     * Get hospital users
     *
     * @return void
     */
    public function get_hospital_users($user_type='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if($user_type=='all'){

        }else{
            
        }

        $result = $this->db->query("SELECT id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users
                                WHERE user_type = 'H'
                                ORDER BY id ASC");
        return $result->result();
    }

    /**
     * Add Record
     *
     * @param array $request
     * @return void
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
     * @return void
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
     * Get Specimen Type
     *
     * @return void
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
     * Insert Specimen
     *
     * @param array $specimen
     * @return void
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
     * Assign record to specimen
     *
     * @return void
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
     * Get All Hospitals By its Groups
     *
     * @return void
     */
    public function get_hospital_groups()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM `groups` WHERE `groups`.group_type = 'H'");
        return $query->result();
    }

    /**
     * Display Only Publish Reports
     *
     * @param int $group_id
     * @param string $date_to
     * @param string $date_from
     * @return void
     */
    public function find_csv_report_model_publish($group_id, $date_to, $date_from)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN `groups`
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND `groups`.id = users_request.group_id
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
                INNER JOIN `groups`
                WHERE users_request.request_id = request.uralensis_request_id
                AND `groups`.id = users_request.group_id
                AND users_request.group_id = $group_id
                AND (request.specimen_publish_status = 1 OR request.specimen_publish_status = 0)
                AND request.request_datetime >= '$date_from' AND request.request_datetime < '$date_to'");
        return $query->result();
    }

    /**
     * Display Cost Codes
     *
     * @param [type] $hospital_group_id
     * @return void
     */
    public function display_cost_codes_model($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_cost_codes WHERE ura_cost_code_hospital_id = $hospital_group_id ORDER BY uralensis_cost_codes.ura_cost_code_id ASC");
        return $query->result();
    }

    /**
     * Get Cost Codes
     *
     * @param int $hospital_id
     * @return void
     */
    public function get_cost_codes($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_cost_codes
                        WHERE uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_id AND ura_cost_code_type = 'block'");
        return $query->result();
    }

    /**
     * Get Finance Report Data
     *
     * @param int $group_id
     * @param string $date_to
     * @param string $date_from
     * @return void
     */
    public function finance_report_request($group_id, $date_to, $date_from)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $change_from = date('Y-m-d', strtotime($date_from));
        $change_to = date('Y-m-d', strtotime($date_to));

        $sql = "SELECT request.uralensis_request_id,
                        request.publish_datetime, request.serial_number,
                        request.date_taken, request.clrk,
                        request.lab_number, request.f_name,
                        request.sur_name, request.gender,
                        request.dob, request.nhs_number,
                        request.emis_number,
                        request.hospital_group_id,
                        uralensis_cost_codes.ura_cost_code_storage_price,
                        request.fw_levels, request.fw_immunos, request.fw_imf,
                        SUM(
                            CASE
                            WHEN (uralensis_cost_codes.ura_cost_code_type = 'fwlevels' AND uralensis_cost_codes.ura_cost_code_type = request.fw_levels AND uralensis_cost_codes.ura_cost_code_hospital_id = request.hospital_group_id)
                            THEN uralensis_cost_codes.ura_cost_code_price
                            ELSE NULL END) AS Level_TOTAL,
                        SUM(
                            CASE
                            WHEN (uralensis_cost_codes.ura_cost_code_type = 'immuno' AND uralensis_cost_codes.ura_cost_code_type = request.fw_immunos AND uralensis_cost_codes.ura_cost_code_hospital_id = request.hospital_group_id)
                            THEN uralensis_cost_codes.ura_cost_code_price
                            ELSE NULL END) AS Immunos_TOTAL,
                        SUM(
                            CASE
                            WHEN (uralensis_cost_codes.ura_cost_code_type = 'imf' AND uralensis_cost_codes.ura_cost_code_type = request.fw_imf AND uralensis_cost_codes.ura_cost_code_hospital_id = request.hospital_group_id)
                            THEN uralensis_cost_codes.ura_cost_code_price
                            ELSE NULL END) AS Imf_TOTAL,
                        SUM(
                            CASE
                            WHEN (uralensis_cost_codes.ura_cost_code_type = 'fwlevels' AND uralensis_cost_codes.ura_cost_code_type = request.fw_levels AND uralensis_cost_codes.ura_cost_code_hospital_id = request.hospital_group_id)
                            THEN uralensis_cost_codes.ura_cost_code_price
                            
                            WHEN (uralensis_cost_codes.ura_cost_code_type = 'immuno' AND uralensis_cost_codes.ura_cost_code_type = request.fw_immunos AND uralensis_cost_codes.ura_cost_code_hospital_id = request.hospital_group_id)
                            THEN uralensis_cost_codes.ura_cost_code_price
                            
                            WHEN (uralensis_cost_codes.ura_cost_code_type = 'imf' AND uralensis_cost_codes.ura_cost_code_type = request.fw_imf AND uralensis_cost_codes.ura_cost_code_hospital_id = request.hospital_group_id)
                            THEN uralensis_cost_codes.ura_cost_code_price
                            
                            ELSE NULL END) AS 'Total'

                        FROM request 
                        INNER JOIN users_request
                        INNER JOIN `groups`
                        INNER JOIN uralensis_cost_codes
                        WHERE users_request.request_id = request.uralensis_request_id
                        AND `groups`.id = users_request.group_id
                        AND users_request.group_id = $group_id
                        AND request.specimen_publish_status = 1
                        AND request.publish_datetime >= '$change_from'
                        AND request.publish_datetime < '$change_to'
                        GROUP BY(request.uralensis_request_id)";

        $query_csv_records = $this->db->query($sql);

        return $query_csv_records->result_array();
    }

    /**
     * Display Specimen Report
     *
     * @param int $record_id
     * @param int $hospital_group_id
     * @return void
     */
    public function display_specimens_report($record_id, $hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (isset($record_id)) {
            $query2 = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN users
                    INNER JOIN specimen
                    INNER JOIN uralensis_cost_codes
                    WHERE request.uralensis_request_id = $record_id
                    AND users_request.request_id = $record_id
                    AND specimen.request_id = $record_id
                    AND users_request.users_id = users.id
                    AND request.specimen_publish_status = 1
                    AND uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_group_id
                    AND specimen.specimen_block = uralensis_cost_codes.ura_cost_code_desc");

            return $query2->result();
        }
    }

    /**
     * Search Records By NHS Number
     *
     * @param string $nhs_number
     * @return void
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
     * Generate FW Reprot
     *
     * @param int $group_id
     * @return void
     */
    public function generate_fw_reprot_model($group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM request
                    INNER JOIN further_work
                    INNER JOIN users_request
                    INNER JOIN `groups`
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND `groups`.id = users_request.group_id
                    AND users_request.group_id = $group_id
                    AND further_work.group_id = $group_id
                    AND further_work.fw_status = 'requested'
                    AND request.uralensis_request_id = further_work.request_id");
        return $query->result_array();
    }

    /**
     * Generate IMF Reprot
     *
     * @param int $group_id
     * @return void
     */
    public function generate_imf_reprot_model($group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN `groups`
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND `groups`.id = users_request.group_id
                    AND users_request.group_id = $group_id
                    AND request.specimen_publish_status = 1
                    AND request.fw_imf = 'imf'");

        return $query->result_array();
    }

    /**
     * Generate TAT10 Reprot
     *
     * @param int $group_id
     * @return void
     */
    public function generate_tat10_model($group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $current_date = date('Y-m-d');
        $ten_days_ago = date('Y-m-d', strtotime('-10 days', strtotime($current_date)));
        $query = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN `groups`
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND `groups`.id = users_request.group_id
                    AND users_request.group_id = $group_id
                    AND request.specimen_publish_status = 0
                    AND request.date_taken >= '$ten_days_ago' AND request.date_taken <= '$current_date'");
        return $query->result_array();
    }

    /**
     * Generate TAT2W Reprot
     *
     * @param int $group_id
     * @return void
     */
    public function generate_tat2w_model($group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $current_date = date('Y-m-d');
        $two_weeks_ago = date('Y-m-d', strtotime('-2 week', strtotime($current_date)));
        $query = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN `groups`
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND `groups`.id = users_request.group_id
                    AND users_request.group_id = $group_id
                    AND request.specimen_publish_status = 0
                    AND request.date_taken >= '$two_weeks_ago' AND request.date_taken <= '$current_date'");
        return $query->result_array();
    }

    /**
     * Generate TAT3W Reprot
     *
     * @param int $group_id
     * @return void
     */
    public function generate_tat3w_model($group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $current_date = date('Y-m-d');
        $three_weeks_ago = date('Y-m-d', strtotime('-3 week', strtotime($current_date)));
        $query = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN `groups`
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND `groups`.id = users_request.group_id
                    AND users_request.group_id = $group_id
                    AND request.specimen_publish_status = 0
                    AND request.date_taken >= '$three_weeks_ago' AND request.date_taken <= '$current_date'");
        return $query->result_array();
    }

    /**
     * Add Teaching and MDT Cats
     *
     * @return void
     */
    public function display_teach_mdt_cats()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats");
        return $query->result();
    }

    /**
     * Display Teaching, MDT, CPC Categories Tree
     * @param type $parent
     * @param type $spacing
     * @param type $category_tree_array
     * @return type
     * 25 Oct 2016
     */
    public function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!is_array($category_tree_array)) {
            $category_tree_array = array();
        }
        $sqlCategory = "SELECT ura_tec_mdt_id,ura_tech_mdt_cat,ura_tech_mdt_parent
                        FROM uralensis_teach_mdt_cats
                        WHERE ura_tech_mdt_parent = $parent
                        ORDER BY ura_tec_mdt_id ASC";

        $resCategory = $this->db->query($sqlCategory);
        foreach ($resCategory->result_array() as $row) {
            $category_tree_array[] = array(
                "ura_tec_mdt_id" => $row['ura_tec_mdt_id'],
                "ura_tech_mdt_cat" => $spacing . $row['ura_tech_mdt_cat'],
                "ura_tech_mdt_parent" => $row['ura_tech_mdt_parent']
            );
            $category_tree_array = $this->categoryParentChildTree($row['ura_tec_mdt_id'], '&nbsp;&nbsp;&nbsp;&nbsp;' . $spacing . '-&nbsp;', $category_tree_array);
        }

        return $category_tree_array;
    }

    /**
     * Get Message Users
     *
     * @param int $admin_id
     * @return void
     */
    public function get_message_users($admin_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query(
            "SELECT id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS usernamee
            FROM users 
            WHERE users.id != $admin_id"
        );
        return $query->result();
    }

    /**
     * Get UnRead Messages Count
     *
     * @param int $admin_id
     * @return void
     */
    public function get_total_unread_msg($admin_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query(
            "SELECT * FROM privmsgs_to
            WHERE privmsgs_to.pmto_read IS NULL
            AND privmsgs_to.pmto_recipient = $admin_id"
        );
        return $query->result();
    }

    /**
     * Display Messages
     *
     * @param int $msg_id
     * @return void
     */
    public function display_msg_model($msg_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM privmsgs WHERE privmsgs.privmsg_id = $msg_id");
        return $query->result();
    }

    /**
     * Display Messages
     *
     * @param int $admin_id
     * @param string $type
     * @return void
     */
    public function display_admin_msg_model($admin_id, $type)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $t1 = 'privmsgs';
        $t2 = 'privmsgs_to';
        $this->db->select('*');
        $this->db->from($t1);

        switch ($type) {
            case 'trash':
                $this->db->where('pmto_recipient', $admin_id);
                $this->db->where('pmto_deleted', 1);
                $this->db->or_where('privmsg_author', $admin_id);
                $this->db->where('privmsg_deleted', 1);
                break;
            case 'inbox':
                $this->db->where('pmto_recipient', $admin_id);
                $this->db->where('pmto_deleted', 0);
                break;
            // Message type SENT
            case 'sent':
                $this->db->where('privmsg_author', $admin_id);
                $this->db->where('privmsg_deleted', 0);
                break;
            // Message type RECEIVED OR SENT (deleted or not, sent to or by this user)
            default:
                $this->db->where('pmto_recipient', $admin_id);
                $this->db->where('privmsg_author', $admin_id);
                break;
        }

        $this->db->join($t2, 'pmto_message' . ' = ' . 'privmsg_id');
        $this->db->group_by('privmsg_id'); // To get only distinct messages
        $q = $this->db->get();
        return $data = $q->result();
    }

    /**
     * Display Tracking Details
     *
     * @return void
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
     * Display Tracking Details
     *
     * @param int $batch_id
     * @return void
     */
    public function display_sent_to_lab_model($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_sent_to_lab WHERE ura_sent_batch_id = $batch_id");
        return $query->result();
    }

    /**
     * Display Tracking Details
     *
     * @param int $batch_id
     * @return void
     */
    public function display_rec_from_lab_model($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_receive_from_lab WHERE ura_rec_batch_id = $batch_id");
        return $query->result();
    }

    /**
     * Display Tracking Details
     *
     * @param int $batch_id
     * @return void
     */
    public function display_sent_to_doc_model($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_sent_to_doctor WHERE ura_sent_doc_batch_id = $batch_id");
        return $query->result();
    }

    /**
     * Detail Tracking Record
     *
     * @param int $batch_id
     * @return void
     */
    public function detail_tracking_model($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT b.ura_track_batch_name, b.ura_track_batch_code,
            b.ura_batch_clinic_date, b.ura_batch_checklist_name,
            stl.ura_sent_to_address, stl.ura_sent_to_name,
            stl.ura_sent_to_timestamp, url.ura_rec_from_lab_timestamp,
            url.ura_rec_from_lab_address, url.ura_rec_from_lab_name,
            stdoc.ura_sent_to_doc_timestamp, stdoc.ura_sent_to_doc_address,
            stdoc.ura_sent_to_doc_name FROM uralensis_track_batch b
            LEFT JOIN uralensis_sent_to_lab stl ON stl.ura_sent_batch_id = b.ura_track_batch_id
            LEFT JOIN uralensis_receive_from_lab url ON url.ura_rec_batch_id = b.ura_track_batch_id
            LEFT JOIN uralensis_sent_to_doctor stdoc ON stdoc.ura_sent_doc_batch_id = b.ura_track_batch_id
            AND b.ura_track_batch_id = $batch_id");
        return $query->result();
    }

    /**
     * Get records based on batch ida
     *
     * @param int $batch_id
     * @return void
     */
    public function detail_tracking_get_batched_model($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM request WHERE request.record_batch_id = $batch_id");
        return $query->result();
    }

    /**
     * Get Track Batch Records
     *
     * @param int $batch_id
     * @return void
     */
    public function get_tracking_model($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_track_batch
                                WHERE uralensis_track_batch.ura_track_batch_id = $batch_id");
        return $query->result();
    }

    /**
     * Get Failed Login Attemps
     *
     * @return void
     */
    public function get_failed_login_attempts()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM login_attempts ORDER BY login_attempts.id DESC");
        return $query->result();
    }

    /**
     * Get User Tracking
     *
     * @return void
     */
    public function get_user_tracking()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM usertracking ORDER BY usertracking.user_tracking_id DESC");
        return $query->result();
    }

    /**
     * User Tracking Activity Model
     *
     * @param int $user_id
     * @return void
     */
    public function user_tracking_model($user_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM usertracking
        INNER JOIN usertracking_activity
        WHERE usertracking.session_userid = usertracking_activity.track_session_userid
        AND usertracking.session_userid = $user_id ORDER BY user_activity_id DESC LIMIT 200");

        return $query->result();
    }

    /**
     * Get Doctor and Secretary Assign List
     *
     * @return void
     */
    public function get_doc_sec_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_doctor_sec_assign");
        return $query->result();
    }

    /**
     * Search Specimen Categories Reports
     *
     * @param int $hospital_id
     * @param string $specimen_cat
     * @return void
     */
    public function search_specimen_cats_reports($hospital_id, $specimen_cat)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "";

        $sql .= "SELECT * FROM request
            INNER JOIN specimen
            INNER JOIN `groups`
            WHERE request.hospital_group_id = $hospital_id
            AND `groups`.id = $hospital_id
            AND request.uralensis_request_id = specimen.request_id";

        if (!empty($specimen_cat) && $specimen_cat === 'benign') {
            $sql .= " AND specimen.specimen_benign = 'benign'";
        }

        if (!empty($specimen_cat) && $specimen_cat === 'atypical') {
            $sql .= " AND specimen.specimen_atypical = 'atypical'";
        }

        if (!empty($specimen_cat) && $specimen_cat === 'malignant') {
            $sql .= " AND specimen.specimen_malignant = 'malignant'";
        }

        if (!empty($specimen_cat) && $specimen_cat === 'inflammation') {
            $sql .= " AND specimen.specimen_inflammation = 'inflammation'";
        }

        $query = $this->db->query($sql);

        return $query->result();
    }

    /**
     *  Get Record Flag Comments From Flag Comments Table
     *
     * @param int $user_id
     * @param int $record_id
     * @return void
     */
    public function get_flag_commnets_record($user_id, $record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT ufc.ufc_id, ufc.ufc_record_id, ufc.ufc_comments, ufc.ufc_user_id, ufc.ufc_timestamp FROM request
            INNER JOIN uralensis_flag_comments AS ufc
            INNER JOIN users
            WHERE request.uralensis_request_id = ufc.ufc_record_id
            AND users.id = $user_id
            AND request.uralensis_request_id = $record_id
            ");

        return $query->result();
    }

    /**
     * Get All Microscopic Records
     *
     * @return void
     */
    public function get_all_microscopic_codes()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_micro_codes ORDER BY uralensis_micro_codes.umc_code ASC");
        return $query->result();
    }

    /**
     * Get Clinician Requesting Work and dermatology Surgeon
     *
     * @param int $hospital_id
     * @param string $type
     * @return void
     */
    public function get_clinician_and_derm(
        $hospital_id = '',
        $type = '',
        $db_value = ''
    )
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $result = '';

        if (!empty($db_value) && !is_numeric($db_value)) {
            if (!empty($hospital_id) && !empty($type) && $type === 'clinician') {
                $get_clinicians = $this->db->query("SELECT * FROM uralensis_clinician WHERE uralensis_clinician.hospital_id = $hospital_id");
                foreach ($get_clinicians->result() as $clinician) {
                    $select = '';
                    if ($clinician->clinician_name === $db_value) {
                        $select = 'selected';
                    }
                    $result .= '<option ' . $select . ' value="' . $clinician->clinician_name . '">' . $clinician->clinician_name . '</option>';
                }
            } else {
                $get_dermatological_surgeon = $this->db->query("SELECT * FROM uralensis_dermatological_surgeon WHERE uralensis_dermatological_surgeon.hospital_id = $hospital_id");
                foreach ($get_dermatological_surgeon->result() as $dermatological_surgeon) {
                    $select = '';
                    if ($dermatological_surgeon->dermatological_surgeon_name === $db_value) {
                        $select = 'selected';
                    }
                    $result .= '<option ' . $select . ' value="' . $dermatological_surgeon->dermatological_surgeon_name . '">' . $dermatological_surgeon->dermatological_surgeon_name . '</option>';
                }
            }
        } else {

            if ($type === 'clinician') {
                $where = 'C';
            } else {
                $where = 'G';
            }

            $user_data = $this->db->select('id', 'username', 'first_name', 'last_name')
                ->where('user_type', $where)
                ->get('users')
                ->result_array();

            if (!empty($user_data)) {
                foreach ($user_data as $key => $value) {
                    $select = '';
                    if ($value['id'] === $db_value) {
                        $select = 'selected';
                    }
                    $result .= '<option ' . $select . ' value="' . $value['id'] . '">' . uralensisGetUsername($value['id'], 'fullname') . '</option>';
                }
            }
        }

        return $result;
    }

    /**
     * List All Up coming clinic dates
     *
     * @param int $hospital_id
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
     */
    public function get_batch_data($batch_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM uralensis_batches
                                    WHERE uralensis_batches.ura_batches_id = $batch_id");
        return $query->result();
    }

    /**
     * Get All Batches List
     *
     * @param int $hosptal_id
     * @return void
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
     * @return void
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

    /**
     * Search Doctor Invoices
     *
     * @param int $doctor_id
     * @param string $date_from
     * @param string $date_to
     * @return void
     */
    public function search_doctor_invoice($doctor_id, $date_from, $date_to)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $from_date = date('Y-m-d', strtotime($date_from));
        $to_date = date('Y-m-d', strtotime($date_to));
        $sql = "SELECT 
            SUM(request.cases_category = 'Alopecia') AS Alopecia_Cases,
            SUM(request.cases_category = 'IMF') AS IMF_Cases,
            SUM(request.cases_category = 'Routine') AS Routine_Cases,
            request.hospital_group_id AS Hospital_ID,
            COUNT(*) AS Total_Cases
            FROM request
            INNER JOIN request_assignee
            INNER JOIN users
            INNER JOIN users_request
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND users.id = request_assignee.user_id
            AND users.id = $doctor_id
            AND users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND request.publish_datetime >= '$from_date' AND request.publish_datetime < '$to_date'
            GROUP BY request.hospital_group_id ORDER BY request.publish_datetime ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Search Doctor invoices if tat enabled
     *
     * @param int $doctor_id
     * @param int $hospital_id
     * @param string $date_from
     * @param string $date_to
     * @return void
     */
    public function search_doctor_invoice_with_tat($doctor_id, $hospital_id, $date_from, $date_to)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        //Get TAT settings based on hospital id
        $tat_opt = $this->get_db_tat_settings($hospital_id);
        if (empty($tat_opt)) {
            $tat_opt = 'date_rec_by_doctor';
        }
        $from_date = date('Y-m-d', strtotime($date_from));
        $to_date = date('Y-m-d', strtotime($date_to));
        $sql = "SELECT
            request.uralensis_request_id AS record_id,
            request.serial_number AS serial_number,
            request.cases_category = 'Alopecia' AS Alopecia_Cases,
            request.cases_category = 'IMF' AS IMF_Cases,
            request.cases_category = 'Routine' AS Routine_Cases,
            request.hospital_group_id AS Hospital_ID,
            IF(request.cases_category = 'Alopecia', datediff(DATE(request.publish_datetime), DATE(request.$tat_opt)), NULL) AS Alopecia_DATE_DIFF,
            IF(request.cases_category = 'IMF', datediff(DATE(request.publish_datetime), DATE(request.$tat_opt)), NULL) AS IMF_DATE_DIFF, IF(request.cases_category = 'Routine', datediff(DATE(request.publish_datetime), DATE(request.$tat_opt)), NULL) AS Routine_DATE_DIFF
            FROM request
            INNER JOIN request_assignee
            INNER JOIN users
            INNER JOIN users_request
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND users.id = request_assignee.user_id
            AND users.id = $doctor_id
            AND request.hospital_group_id = $hospital_id
            AND users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND request.publish_datetime >= '$from_date'
            AND request.publish_datetime < '$to_date'
            ORDER BY request.publish_datetime ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Search Doctor Invoice
     *
     * @param int $hospital_id
     * @param string $code_name
     * @param string $date_from
     * @param string $date_to
     * @return void
     */
    public function search_db_hospital_invoice($hospital_id, $code_name, $date_from, $date_to)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $from_date = date('Y-m-d', strtotime($date_from));
        $to_date = date('Y-m-d', strtotime($date_to));
        $sql = '';
        $sql .= "SELECT
            request.hospital_group_id AS Hospital_ID,
            request.cost_codes AS Cost_codes,
            COUNT(*) AS Total_Cases
            FROM request
            INNER JOIN users_request
            INNER JOIN `groups`
            WHERE users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND users_request.group_id = `groups`.id
            AND `groups`.id = $hospital_id
            AND request.publish_datetime BETWEEN '$from_date' AND '$to_date' ";
        if (!empty($code_name)) {
            $sql .= "AND request.cost_codes = '$code_name'";
        }
        $sql .= "GROUP BY request.cost_codes ORDER BY request.publish_datetime ASC";

        $query = $this->db->query($sql);
        if (!empty($code_name)) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * Search Hospital Invoice With TAT
     *
     * @param int $hospital_id
     * @param string $date_from
     * @param string $date_to
     * @return void
     */
    public function search_db_hospital_invoice_with_tat($hospital_id, $date_from, $date_to)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        //Get TAT settings based on hospital id
        $tat_opt = $this->get_db_tat_settings($hospital_id);

        if (empty($tat_opt)) {
            $tat_opt = 'date_rec_by_doctor';
        }

        $from_date = date('Y-m-d', strtotime($date_from));
        $to_date = date('Y-m-d', strtotime($date_to));

        $sql = "SELECT 
            request.cost_codes AS Cost_codes,
            request.hospital_group_id AS Hospital_ID,
            request.uralensis_request_id as record_id,
            request.serial_number as serial_number,
            IF(request.cost_codes = request.cost_codes, datediff(DATE(request.publish_datetime), request.$tat_opt), NULL) AS Cost_Code_Diff
            FROM request
            INNER JOIN users_request
            INNER JOIN `groups`
            WHERE users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND users_request.group_id = `groups`.id
            AND `groups`.id = $hospital_id
            AND request.specimen_publish_status = 1
            AND request.publish_datetime BETWEEN '$from_date' AND '$to_date' ORDER BY request.publish_datetime ASC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Display Uralensis Generated Invoices
     *
     * @param int $doctor_id
     * @return void
     */
    public function display_generated_invoices($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->where('ura_doc_id', $doctor_id)->get('uralensis_doctor_invoice')->result_array();
    }

    /**
     * Display Uralensis Generated Invoices
     *
     * @param int $hospital_id
     * @return void
     */
    public function display_hos_generated_invoices($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->where('ura_hos_id', $hospital_id)->get('uralensis_hospital_invoice')->result_array();
    }

    /**
     * Display Uralensis Generated Invoices
     *
     * @param int $invoice_id
     * @return void
     */
    public function generated_invoices_pdf($invoice_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->where('ura_doc_invoice', $invoice_id)->get('uralensis_doctor_invoice')->row_array();
    }

    /**
     * Display Uralensis Generated Invoices
     *
     * @param int $invoice_id
     * @return void
     */
    public function generated_hospital_invoices_pdf($invoice_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->where('ura_hos_invoice', $invoice_id)->get('uralensis_hospital_invoice')->row_array();
    }

    /**
     * Get all MDT list names
     *
     * @return void
     */
    public function get_all_mdt_list_names()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM uralensis_mdt_lists ORDER BY uralensis_mdt_lists.ura_mdt_list_id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Get Datasets Data Model
     *
     * @return void
     */
    public function get_datasets_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM uralensis_datasets ORDER BY uralensis_datasets.ura_datasets_id DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Get Dataset Category Data
     *
     * @param int $question_id
     * @return void
     */
    public function get_datasets_question_answers($question_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM uralensis_datasets_answers AS uda WHERE uda.ura_ans_ques_id = $question_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get record history data
     *
     * @param int $record_id
     * @return void
     */
    public function get_record_history_data($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = array();
        if (!empty($record_id)) {
            $sql = "SELECT * FROM uralensis_record_history
                    WHERE uralensis_record_history.rec_history_record_id = $record_id
                    ORDER BY uralensis_record_history.ura_rec_history_id DESC";
            $query = $this->db->query($sql)->result_array();
            return $query;
        }
    }

    /**
     * Get all track record templates.
     *
     * @param int $admin_id
     * @return void
     */
    public function get_all_track_record_templates($admin_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = array();
        if (!empty($admin_id)) {
            return $query = $this->db->where('temp_assignee_id', $admin_id)->get('uralensis_record_track_template')->result_array();
        }
    }

    /**
     * Display Records
     *
     * @param string $year
     * @param int $limit
     * @return void
     */
    public function display_tracking_records($year, $limit = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $userid = $this->ion_auth->user()->row()->id;
        if (!empty($year)) {
            $sql = "";
            $sql .= "SELECT * FROM request
                WHERE YEAR(request.request_datetime) = $year AND request.request_add_user = $userid";
            $sql .= " ORDER BY request.uralensis_request_id DESC";
            if (!empty($limit)) {
                $sql .= " LIMIT $limit";
            }
            $query = $this->db->query($sql);
            return $query->result();
        }
    }

    /**
     * Get track record data from record id
     *
     * @param int $record_id
     * @return array
     */
    public function get_track_record_data_from_record_id($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($record_id)) {
            return $query = $this->db->where('ura_rec_track_record_id', $record_id)->get('uralensis_record_track_status')->result();
        }
    }

    /**
     * Get hospital invoice options data
     *
     * @param int $hospital_id
     * @return array
     */
    public function get_hos_inv_opt_data($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($hospital_id)) {
            return $this->db->where('ura_hos_id', $hospital_id)->get('uralensis_hospital_inovice_opt')->row_array();
        }
    }

    /**
     * Get hospital invoice options data
     *
     * @param int $doctor_id
     * @return array
     */
    public function get_doc_inv_opt_data($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($doctor_id)) {
            return $this->db->where('ura_doc_id', $doctor_id)->get('uralensis_doctor_inovice_opt')->result_array();
        }
    }

    /**
     * Get record form doctor invoice table
     *
     * @param int $doctor_id
     * @param int $hospital_id
     * @return array
     */
    public function get_db_doctor_inv_opt_data($doctor_id, $hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($doctor_id)) {
            return $this->db->where('ura_doc_id', $doctor_id)->where('ura_hos_id', $hospital_id)->get('uralensis_doctor_inovice_opt')->row_array();
        }
    }

    /**
     * Get Doctor Inovice Template
     *
     * @param int $doctor_id
     * @return array
     */
    public function get_doctor_invoice_template_data($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($doctor_id)) {
            return $this->db->where('ura_doc_inv_doctor_id', $doctor_id)->get('uralensis_doctor_invoice_template')->row_array();
        }
    }

    /**
     * Get Hospital Inovice Template
     *
     * @param int $hospital_id
     * @return array
     */
    public function get_hospital_invoice_template_data($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($hospital_id)) {
            return $this->db->where('ura_hos_inv_hospital_id', $hospital_id)->get('uralensis_hospital_invoice_template')->row_array();
        }
    }

    /**
     * Check invoice dates
     *
     * @param string $date
     * @param int $hospital_id
     * @return array
     */
    public function check_hos_invoice_dates_from_db($date = '', $hospital_id='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($date) && !empty($hospital_id)) {
            $sql = "SELECT * FROM uralensis_hospital_invoice WHERE '$date' BETWEEN ura_hos_date_from AND ura_hos_date_to AND ura_hos_id = $hospital_id";
            return $this->db->query($sql)->row_array();
        }
    }

    /**
     * Display TAT Settings model
     *
     * @param int $hospital_id
     * @return array
     */
    public function display_tat_settings_modal($hospital_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($hospital_id)) {
            return $this->db->where('ura_tat_hospital_id', $hospital_id)->get('uralensis_tat_settings')->row_array();
        }
    }

    /**
     * Get TAT Settings
     *
     * @param int $hospital_id
     * @return array
     */
    public function get_db_tat_settings($hospital_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($hospital_id)) {
            return $this->db->select('ura_tat_date_data')->where('ura_tat_hospital_id', $hospital_id)->get('uralensis_tat_settings')->row_array()['ura_tat_date_data'];
        }
    }

    /**
     * Get PDF detail records
     *
     * @param int $hospital_id
     * @param string $date_from
     * @param string $date_to
     * @return array
     */
    public function get_pdf_detail_records($hospital_id = '', $date_from = '', $date_to = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        //Get TAT settings based on hospital id
        $tat_opt = $this->get_db_tat_settings($hospital_id);
        if (empty($tat_opt)) {
            $tat_opt = 'date_rec_by_doctor';
        }
        $sql = "";
        if (!empty($hospital_id) && !empty($date_from) && !empty($date_to)) {
            $sql = "SELECT 
                request.hospital_group_id AS Hospital_ID,
                request.uralensis_request_id as record_id,
                request.serial_number as serial_number,
                request.lab_number as lab_number,
                request.date_rec_by_doctor as receive_from_date,
                request.publish_datetime as publish_date,
                IF(request.cost_codes = request.cost_codes, datediff(DATE(request.publish_datetime), request.$tat_opt), NULL) AS Cost_Code_Diff
                FROM request
                INNER JOIN users_request
                INNER JOIN `groups`
                WHERE users_request.group_id = request.hospital_group_id
                AND users_request.request_id = request.uralensis_request_id
                AND users_request.group_id = `groups`.id
                AND `groups`.id = $hospital_id
                AND request.publish_datetime BETWEEN '$date_from' AND '$date_to' ORDER BY request.serial_number ASC";
            return $this->db->query($sql)->result_array();
        }
    }

    /**
     * Get PDF summary records
     *
     * @param int $hospital_id
     * @param string $date_from
     * @param string $date_to
     * @return array
     */
    public function get_pdf_summary_records($hospital_id = '', $date_from = '', $date_to = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "";
        if (!empty($hospital_id) && !empty($date_from) && !empty($date_to)) {
            $sql = "SELECT 
            DATE_FORMAT(request.request_datetime, '%Y-%m-%d') as Req_Date,
            COUNT(
                  CASE
                  WHEN (request.specimen_publish_status = 1)
                  THEN request.specimen_publish_status
                  ELSE NULL END) AS Total_Published,
            COUNT(*) AS Total_cases_received
            FROM request
            INNER JOIN users_request
            INNER JOIN `groups`
            WHERE users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND users_request.group_id = `groups`.id
            AND `groups`.id = $hospital_id
            AND request.publish_datetime BETWEEN '$date_from' AND '$date_to' 
            GROUP BY DATE_FORMAT(request.request_datetime, '%Y-%m-%d')
            ORDER BY request.publish_datetime ASC";

            return $this->db->query($sql)->result_array();
        }
    }

    /**
     * Get PDF summary records for doctor
     *
     * @param int $doctor_id
     * @param string $date_from
     * @param string $date_to
     * @return array
     */
    public function get_pdf_summary_records_doctor($doctor_id = '', $date_from = '', $date_to = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $from_date = date('Y-m-d', strtotime($date_from));

        $to_date = date('Y-m-d', strtotime($date_to));

        $sql = "";
        if (!empty($doctor_id) && !empty($date_from) && !empty($date_to)) {
            $sql = "SELECT 
            DATE_FORMAT(request.request_datetime, '%Y-%m-%d') as Req_Date,
            COUNT(
                  CASE
                  WHEN (request.specimen_publish_status = 1)
                  THEN request.specimen_publish_status
                  ELSE NULL END) AS Total_Published,
            request.hospital_group_id AS Hospital_ID,
            COUNT(*) AS Total_Cases
            FROM request
            INNER JOIN request_assignee
            INNER JOIN users
            INNER JOIN users_request
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND users.id = request_assignee.user_id
            AND users.id = $doctor_id
            AND users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND request.publish_datetime >= '$from_date' AND request.publish_datetime < '$to_date'
            GROUP BY request.hospital_group_id ORDER BY request.publish_datetime ASC";
            return $this->db->query($sql)->result_array();
        }
    }

    /**
     * Get PDF detail records
     *
     * @param int $doctor_id
     * @param string $hospital_name
     * @param string $date_from
     * @param string $date_to
     * @return array
     */
    public function get_pdf_detail_records_doctor($doctor_id = '', $hospital_name = '', $date_from = '', $date_to = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        //Get hospital ID based on hospital name
        $hospital_id = $this->db->select('id')->where('description', $hospital_name)->get('`groups`')->row_array()['id'];
        //Get TAT settings based on hospital id
        $tat_opt = $this->get_db_tat_settings($hospital_id);

        if (empty($tat_opt)) {
            $tat_opt = 'date_rec_by_doctor';
        }
        $from_date = date('Y-m-d', strtotime($date_from));
        $to_date = date('Y-m-d', strtotime($date_to));

        $sql = "";
        if (!empty($doctor_id) && !empty($date_from) && !empty($date_to)) {
            $sql = "SELECT
            request.serial_number as serial_number,
            request.lab_number as lab_number,
            request.date_rec_by_doctor as receive_from_date,
            request.publish_datetime as publish_date,
            IF(request.cases_category = 'Alopecia', datediff(DATE(request.publish_datetime), DATE(request.$tat_opt)), NULL) AS Alopecia_DATE_DIFF,
            IF(request.cases_category = 'IMF', datediff(DATE(request.publish_datetime), DATE(request.$tat_opt)), NULL) AS IMF_DATE_DIFF,
            IF(request.cases_category = 'Routine', datediff(DATE(request.publish_datetime), DATE(request.$tat_opt)), NULL) AS Routine_DATE_DIFF
            FROM request INNER JOIN request_assignee
            INNER JOIN users
            INNER JOIN users_request
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND users.id = request_assignee.user_id
            AND users.id = $doctor_id
            AND request.hospital_group_id = $hospital_id
            AND users_request.group_id = request.hospital_group_id
            AND users_request.request_id = request.uralensis_request_id
            AND request.publish_datetime BETWEEN '$from_date' AND '$to_date'
            ORDER BY request.publish_datetime ASC";

            return $this->db->query($sql)->result_array();
        }
    }

    /**
     * Get DB TAT opt
     *
     * @param int $hospital_id
     * @param int $doctor_id
     * @return void
     */
    public function get_db_doctor_tat_opt($hospital_id = '', $doctor_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if (!empty($hospital_id) && !empty($doctor_id)) {
            return $this->db->select('ura_hos_opt')->where('ura_hos_id', $hospital_id)->where('ura_doc_id', $doctor_id)->get('uralensis_doctor_inovice_opt')->row_array()['ura_hos_opt'];
        }
    }

    /**
     * Get Specimen related data
     *
     * @param string $db_name
     * @return array
     */
    public function get_specimen_data($db_name = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($db_name)) {
            return $this->db->get($db_name)->result_array();
        }
    }

    public function get_specialty_code_data()
    {
        return $this->db->select('*')
            ->from('specialties')
            ->join('specialty_codes', 'specialties.id = specialty_id')
            ->join('uralensis_snomed_codes', 'specialty_codes.code = usmdcode_code')
            ->get()
            ->result();
    }

    public function update_specialty($id, $data = [])
    {
        $this->db->where('id', $id)->update('specialties', $data);
    }

    public function delete_specialty($id)
    {
        $this->db->where('specialty_id', $id)->delete('specialty_codes');
        $this->db->where('id', $id)->delete('specialties');
    }

    public function delete_specialty_code($id, $code)
    {
        $this->db->where('specialty_id', $id)
            ->where('code', $code)
            ->delete('specialty_codes');
    }

    public function create_specialty($name, $pa, $code = NULL)
    {
        $exists = $this->db->get_where('specialties', ['specialty' => $name])->row();
        if (empty($exists)) {
            $this->db->insert('specialties', [
                'specialty' => $name,
                'pa' => $pa,
            ]);
            $id = $this->db->insert_id();
            if (!empty($code)) {
                $related_codes = $this->db->like('usmdcode_code', $code, 'after')
                    ->get('uralensis_snomed_codes')
                    ->result();
                $specialty_codes = [];
                foreach ($related_codes as $code) {
                    $specialty_codes[] = [
                        'specialty_id' => $id,
                        'code' => $code->usmdcode_code
                    ];
                }
                $this->db->insert_batch('specialty_codes', $specialty_codes);
            }
        }
    }

    /**
     * Get specialty data
     */
    public function get_specialties_data()
    {
        $specialties = $this->db->get('specialties')->result();
        foreach ($specialties as $specialty) {
            $specialty->codes = $this->db->get_where('specialty_codes', ['specialty_id' => $specialty->id])->result();
        }

        return $specialties;
    }

    /**
     * Get All Hospitals Groups
     *
     * @param string $selective_group
     * @return array
     */
    public function getAllHopsitalsGroups($selective_group = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($selective_group)) {
            return $this->db->select('id, name, description, group_type')->where('group_type', $selective_group)->get('`groups`')->result_array();
        } else {
            return $this->db->select('id, name, description, group_type')->where('group_type', 'H')->get('`groups`')->result_array();
        }
    }

    /**
     * Get User Counts based on group id.
     *
     * @param int $group_id
     * @return array
     */
    public function getAllUserCountsOnGroupId($group_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($group_id)) {
            $query = $this->db->where('group_id', $group_id)->get('users_groups');
            return $query->num_rows();
        }
    }

    /**
     * Get Non Admin User Count.
     *
     * @return INT number of non admin user
     */
    public function getAllNonAdminUser($group_id = '')
    {
        if (!$this->ion_auth->logged_in()) 
		{
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT count(*) AS NONADMIN FROM users_groups WHERE group_id != 1";
        $res = $this->db->query($sql)->result_array()[0]['NONADMIN'];
        return $res;
    }


    /**
     * Returns a list of all group type
     *
     * @return ARRAY of group type with name and description.
     */
    public function fetchAllGroupType($group_type)
    {
        $this->db->select('id, name, description');
        $this->db->where('group_type', $group_type);
		$this->db->where('type_cate', 'usergroup');
        $query = $this->db->get('groups');
        return $query->result_array();
    }

    /**
     * Returns all the groups and their group ID
     */
    public function fetchAllGroups()
    {
        $this->db->select('id, name, group_type');
        return $this->db->get('groups')->result_array();
    }

    /**
     * Returns all the feilds of network group with row $id
     * if network is not found return network with last id if that is also not found return null
     *
     * @param id The id of network
     * @return OBJECT|NULL of network details
     */
    public function fetchNetwork($id)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->join('network', 'network.group_id = groups.id');
        $this->db->where('groups.id', $id);
        $this->db->where('group_type', 'N');
        $query = $this->db->get();
        $result = $query->result_array();
        if (empty($result)) return NULL;
        $response = array();
        // Get all Network users
        $this->db->select();
    }

    public function addNetwork($data)
    {
        if (gettype($data) != 'string') {
            return 'Invalid Name';
        }
        $this->db->select('*');
        $this->db->where('name', $data);
        $check = $this->db->get('groups')->result_array();
        if (count($check) > 0) {
            return "$data already exists";
        }
        $words = explode(" ", $data);
        $inp = array(
            'parent_id' => 0,
            'name' => $data,
            'description' => $data,
            'first_initial' => '',
            'last_initial' => '',
            'information' => '',
            'group_type' => 'N',
            'type_cate' => 'category',
            'parent_cate' => 0
        );
        if (count($words) >= 1) {
            $inp['first_initial'] = strtoupper($words[0][0]);
        }
        if (count($words) >= 2) {
            $inp['last_initial'] = strtoupper($words[1][0]);
        }

        $this->db->insert('groups', $inp);
        $group_id = $this->db->insert_id();
        $this->db->insert('network', array('group_id' => $group_id));
        return TRUE;
    }

    public function deleteNetwork($id)
    {

    }

    public function editNetwork($id, $data)
    {

    }

    /**
     * Returns the network ID of default (first) network
     * @return INT|NULL id of default network. Null is returned if no networks are present in db
     */
    public function getDefaultNetworkId()
    {
        $this->db->select('id');
        $this->db->where('group_type', 'N');
        $query = $this->db->get('groups');
        $res = $query->result();
        if (empty($res)) {
            return NULL;
        }
        return $res[0]->id;
    }


    public function insertHospitalInformation($data)
    {
        $this->db->insert('hospital_information', $data);
        return TRUE;
    }


    public function get_group_id($group_type = "")
    {
        if (empty($group_type)) {
            return null;
        }

        $result = $this->db->get_where('groups', array('group_type' => $group_type))->row();
        if (empty($result) || empty($result->id)) {
            return null;
        }
        return $result->id;
    }


    public function get_group_privileges($group_id)
    {
        $this->db->select('user_privilege_groups.upriv_groups_upriv_fk as upriv_groups_upriv_fk');
        $this->db->from('user_privilege_groups');
        $this->db->where('user_privilege_groups.upriv_groups_ugrp_fk', $group_id);
        $query = $this->db->get();
        $response = array();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $key => $value) {
                $response[] = $value['upriv_groups_upriv_fk'];
            }
        } else {
            $response = 0;
        }
        return $response;

    }


    function update_group_privileges($group_id)
    {
//		echo '<pre>'; print_r($this->input->post()); exit;
        // Update privileges.
        foreach ($this->input->post('update') as $row) {
            if ($row['current_status'] != $row['new_status']) {

                // Insert new user privilege.
                if ($row['new_status'] == 1) {
                    $this->insert_user_group_privilege($group_id, $row['id']);
                } // Delete existing user privilege.
                else {
                    $sql_where = array(
                        'upriv_groups_ugrp_fk' => $group_id,
                        'upriv_groups_upriv_fk' => $row['id']
                    );

                    $this->delete_user_group_privilege($sql_where);
                }
            }
        }
        // Save any public or admin status or error messages to CI's flash session data.
        $this->session->set_flashdata('message', 'User Group Privileges are updated!');

        // Redirect user.
//        redirect('admin/user_groups');
        redirect('admin/user_privileges');
    }


    public function get_user_privileges($order_by = '')
    {

        $query = "select user_privileges.* from user_privileges ";
        $query .= " order by user_privileges.upriv_id $order_by";
        $result = $this->db->query($query);
//        echo '<pre>';print_r($this->db->last_query()); exit;
        if ($result->num_rows() > 0) {
            $response = $result->result_array();
        } else {
            $response = 0;
        }
        return $response;
    }


    public function get_privilege_data($id = NULL, $where = NULL, $order_by = 'ASC')
    {

        $this->db->select('*');
        $this->db->from('user_privileges');
        $this->db->where($where);

        $query = $this->db->get();
        $count_row = $query->num_rows();
        if ($count_row > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add_user_privilege()
    {

        $data = array(
            'upriv_name' => $this->input->post('privilege_name'),
            'upriv_desc' => $this->input->post('privilege_description'),
            'parent_id' => $this->input->post('parent_privilege')
        );

        if ($this->db->insert('user_privileges', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function insert_user_group_privilege($group_id, $privilege_id)
    {
        $data = array(
            'upriv_groups_ugrp_fk' => $group_id,
            'upriv_groups_upriv_fk' => $privilege_id
        );
        $this->db->insert('user_privilege_groups', $data);
        return true;
    }

    public function delete_user_group_privilege($where_array)
    {
        $this->db->delete('user_privilege_groups', $where_array);
        return true;
    }

    public function getUsersLogins($status = FALSE,$explodeDate=FALSE)
    {
//        $query = $this->db->query("SELECT  is_hospital_admin,profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username, login_token  FROM users
//                                WHERE id=" . $this->db->escape($id));
        $this->db->select("userlogin_activity.*,profile_picture_path,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name");
        $this->db->order_by("login_time", "DESC");
        if (!$status) {
            $this->db->limit(5);
        }
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        }
        $this->db->join('users', 'users.id = userlogin_activity.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_activity.client_ip','LEFT');
        $get_data = $this->db->get("userlogin_activity");
        $get_data = $get_data->result();
        return $get_data;
    }

    public function getLoginDetail($userDetail = FALSE,$explodeDate=FALSE)
    {
        $this->db->select("userlogin_log.*,profile_picture_path,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name");
        $this->db->order_by("login_time", "DESC");
        $this->db->join('users', 'users.id = userlogin_log.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_log.client_ip','LEFT');
        $this->db->where('session_userid', $userDetail[0]);
        $this->db->where('client_ip', $userDetail[1]);
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        }
        $get_data = $this->db->get("userlogin_log");
        $get_data = $get_data->result();
        return $get_data;
    }

    public function getAllLoginDetail($explodeDate=FALSE)
    {
        $this->db->select("userlogin_log.*,profile_picture_path,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name");
        $this->db->order_by("login_time", "DESC");
        $this->db->join('users', 'users.id = userlogin_log.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_log.client_ip','LEFT');
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        } else {
            $start_date = strtotime(date("Y-m-01 00:00:01"));
            $end_date = strtotime(date("Y-m-t 23:59:59"));
            $this->db->where("login_time>=",$start_date);
            $this->db->where("login_time<=",$end_date);
        }
        $get_data = $this->db->get("userlogin_log");
        $get_data = $get_data->result();
        return $get_data;
    }

	public function insertLaboratoryInformation($data) {
        $this->db->insert('laboratory_information', $data);
        return TRUE;
    }
    
    
    public function getDashboardFirstRowCount(){
        $query = "SELECT "
                . "COUNT(IF(group_type= 'L', groups.id, NULL)) AS lab_counts, COUNT(IF(group_type= 'H', groups.id, NULL)) AS hosp_counts, "
                . "COUNT(IF(group_type= 'CSD', groups.id, NULL)) AS cancer_counts from groups ;";
        $result = $this->db->query($query)->result_array(); 
        return $result;
        
    }

    public function getLaboratoryHospitals($laboratoryId){
        $query = "select  groups.description,hi.hosp_city,hi.hosp_email,hi.hosp_phone 
                  from hospital_information hi 
                  join groups on hi.group_id=groups.id
                  join hospital_group hg on hg.hospital_id=groups.id
                  where hg.group_id=$laboratoryId";
        $result = $this->db->query($query)->result_array();
        return $result;

    }
	
	
	    public function getLaboratoryHospitalsCount($laboratoryId){
        $query = "select count(*) as hospital_count 
                  from hospital_information hi 
                  join groups on hi.group_id=groups.id
                  join hospital_group hg on hg.hospital_id=groups.id
                  where hg.group_id=$laboratoryId";
        $result = $this->db->query($query)->result_array();
        return $result;

    }
	
    public function getHospitalNetworks(){
        $query = "SELECT  
                    count(*) as _CNT 
                    from network";
        $result = $this->db->query($query)->result_array(); 
        return $result;
        
    }

    public function getUserGroupsForAdmin_UserCreation(){
        $query = "SELECT DISTINCT * FROM groups WHERE group_type IN('A','M')";
        $result = $this->db->query($query)->result_array();
        return $result;

    }
	
	    public function getUserGroupsuserCreation(){
        $query = "SELECT DISTINCT * FROM groups WHERE type_cate='category' and group_type!='A' order by parent_group_type";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    public function getChildGroupsByType($group_type=''){
        $query = "SELECT * FROM groups WHERE parent_group_type ='$group_type' AND parent_group_type!='-1' ";
        $result = $this->db->query($query)->result_array();
        return $result;

    }
	
	    public function getGroupsDateByType($group_type=''){
        $query = "SELECT * FROM groups WHERE group_type ='$group_type' AND type_cate='usergroup' ";
        $result = $this->db->query($query)->result_array();
        return $result;

    }

    public function getChildGroupsByUserId($user_id=''){
        $query_group_type = "SELECT DISTINCT groups.id, group_type 
                            FROM groups 
                            INNER JOIN users_groups ON groups.id = users_groups.institute_id 
                            WHERE users_groups.user_id=$user_id";
        $group_type = $this->db->query($query_group_type)->row_array();
        $group_type_val = @$group_type['group_type'];
       $query = "SELECT * FROM groups WHERE parent_group_type ='$group_type_val' AND parent_group_type!='-1' ";
        $result = $this->db->query($query)->result_array();
        return $result;

    }

    public function getHospiGroupsByUserId($user_id=''){
        $query_group_type = "SELECT DISTINCT groups.id, group_type 
                            FROM groups 
                            INNER JOIN users_groups ON groups.id = users_groups.institute_id 
                            WHERE users_groups.user_id=$user_id";
        $group_type = $this->db->query($query_group_type)->result_array();
        $array = array();
        if(!empty($group_type)){
            
            foreach($group_type as $val){

                if(!empty($val['group_type'])){
                     $group_type_val = @$val['group_type'];
                     $query = "SELECT * FROM groups WHERE parent_group_type ='$group_type_val' AND parent_group_type!='-1' ";
                    $result = $this->db->query($query)->result_array();
                    if(!empty($result)){
                        foreach ($result as $va) {
                            $array[] = $va;
                        }
                        
                    }
                }
            }
        }
        return $array;

    }

    public function getParentGroupsByUserId($user_id){
        $query = "SELECT groups.id, group_type, groups.name
                            FROM groups 
                            INNER JOIN users_groups ON groups.id = users_groups.institute_id 
                            WHERE users_groups.user_id=$user_id AND users_groups.institute_id IS NOT NULL";
        $response = array();
        $result = $this->db->query($query)->result_array();
        if(!empty($result)){
            foreach($result as $res){
                $response[]= $res['id'];
            }
        }
        return $response;

    }

    public function getAllPathologists(){
        $query = "SELECT CONCAT(AES_DECRYPT(first_name, '".DATA_KEY."'), ' ', 
                AES_DECRYPT(last_name, '".DATA_KEY."')) AS pathologist_name, id, user_type 
                FROM users 
                WHERE user_type='D' AND status=1";
        $response = array();
        $result = $this->db->query($query)->result_array();
        if(!empty($result)){
            $response = $result;
        }
        return $response;
    }

    public function getManagerPathologist($user_id){
        $query = "SELECT users.id, users_groups.reporting_to_id as manager_pathologist_id, CONCAT(AES_DECRYPT(users.first_name, '".DATA_KEY."'), ' ', 
                AES_DECRYPT(users.last_name, '".DATA_KEY."')) AS pathologist_name, users.user_type 
                FROM users INNER JOIN users_groups ON users_groups.user_id = users.id
                WHERE users_groups.user_id = $user_id AND users_groups.reporting_to_id IS NOT NULL ";
        $response = array();
        $result = $this->db->query($query)->result_array();
//        echo '<pre>'; print_r($result); exit;
        if(!empty($result)){
            foreach($result as $res){
                $response[] = $res['manager_pathologist_id'];
            }
        }
//        echo '<pre>'; print_r($response); exit;
        return $response;
    }

    public function getChildPathologistGroups(){
        $query = "SELECT * FROM groups WHERE parent_group_type='D' ";
        $response = array();
        $result = $this->db->query($query)->result_array();
        if(!empty($result)){
            $response = $result;
        }
        return $response;
    }

    public function GetGroupByType($group_type){
        $query = "SELECT * FROM groups WHERE group_type='$group_type' ";
        $response = array();
        $result = $this->db->query($query)->row_array();
        if(!empty($result)){
            $response = $result;
        }
        return $response;
    }

}
