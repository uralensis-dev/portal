<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Doctor Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
Class Doctor_model extends CI_Model
{
    
    var $table = 'request';
    var $column_order = array(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'publish_datetime', NULL, NULL, NULL, NULL, NULL, NULL,); //set column field database for datatable orderable
    var $column_search = array('serial_number', 'ura_barcode_no', 'f_name', 'sur_name', 'dob', 'pci_number', 'emis_number', 'nhs_number', 'lab_number', 'report_urgency'); //set column field database for datatable searchable 
    var $order = array('uralensis_request_id' => 'DESC'); // default order
    
    /**
     * Display Published Records
     *
     * @param [type] $year
     * @param string $recent
     * @param string $flag_type
     * @param string $sort_authorize
     * @param string $urgency_type
     * @param string $row_color_code
     * @return array
     */
    public function display_published_record($year, $recent = '', $flag_type = '', $sort_authorize = '', $urgency_type = '', $row_color_code = '')
    {
        $this->get_datatables_record_query($year, $recent, $flag_type, $sort_authorize, $urgency_type, $row_color_code);
        if ($_POST['length'] != -1) 
		{
            $this->db->limit(intval(10), $_POST['start']);
        }
        $query = $this->db->get();
    //    echo $this->db->last_query(); 
        //exit;
        return $query->result();
    }
    
    /**
     * Get Datatables Record Query
     *
     * @param [type] $year
     * @param string $recent
     * @param string $flag_type
     * @param string $sort_authorize
     * @param string $urgency_type
     * @param string $row_color_code
     * @return array
     */
    public function get_datatables_record_query($year, $recent = '', $flag_type = '', $sort_authorize = '', $urgency_type = '', $row_color_code = '')
    {
		$user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$groupType = $this->ion_auth->get_users_main_groups()->row()->group_type;			
		$doctor_id=$user_id;
		if(in_array($groupType,LAB_GROUP))
		{         
			//$this->db->select("*, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by");
			$this->db->select('*,count(DISTINCT(specimen.specimen_id)) as speciman_no');
			$this->db->from($this->table);
			$this->db->join('request_assignee', 'request.uralensis_request_id = request_assignee.request_id', 'INNER');
            $this->db->join('specimen', 'specimen.request_id = request.uralensis_request_id', 'LEFT');
			// $this->db->where('request.lab_id', $group_id);
            $this->db->where_in('request.lab_id', array(114,115));
			$this->db->where('request.publish_status', '1');
            $this->db->group_by('request.uralensis_request_id');
            
			//$this->db->where('request.request_code_status', 'record_publish');
			
				
		}
		else if(in_array($groupType,HOSPITAL_GROUP))
		{
			
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->join('request_assignee', 'request.uralensis_request_id = request_assignee.request_id', 'INNER');
			$this->db->where('request.hospital_group_id', $group_id);
			$this->db->where('request.publish_status', '1');
			//$this->db->where('request.request_code_status', 'record_publish');        				
		}
		else
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->join('request_assignee', 'request.uralensis_request_id = request_assignee.request_id', 'INNER');
			$this->db->where('request_assignee.user_id', $doctor_id);
			$this->db->where('request.publish_status', '1');
			//$this->db->where('request.request_code_status', 'record_publish');        	
		}
		
        // $this->db->where('YEAR(request_datetime)', $year);
        if (!empty($urgency_type)) {
            if($urgency_type>20)
            {
                 $this->db->where('request_datetime >=', 'DATE_FORMAT(CURDATE(), "%Y-%m-%d") - INTERVAL '.$urgency_type.' DAY');

            }else{
                    $this->db->where('request_datetime <=', 'DATE_FORMAT(CURDATE(), "%Y-%m-%d") - INTERVAL '.$urgency_type.' DAY');
            }
            
            //$this->db->where('report_urgency', $urgency_type);
        }
        if ($row_color_code === 'row_yellow') {
            $this->db->where('request_code_status', 'new');
        } else if ($row_color_code === 'row_orange') {
            $this->db->where('request_code_status', 'rec_by_lab');
        } else if ($row_color_code === 'row_purple') {
            $this->db->where('request_code_status', 'pci_added');
        } else if ($row_color_code === 'row_green') {
            $this->db->where('request_code_status', 'assign_doctor');
        } else if ($row_color_code === 'row_skyblue') {
            $this->db->where('request_code_status', 'micro_add');
        } else if ($row_color_code === 'row_blue') {
            $this->db->where('request_code_status', 'add_to_authorize');
        } else if ($row_color_code === 'row_brown') {
            $this->db->where('request_code_status', 'furtherwork_add');
        } else if ($row_color_code === 'row_white') {
            $this->db->where('request_code_status', 'record_publish');
        }
        if (!empty($flag_type)) {
            $this->db->where('flag_status', $flag_type);
        }
        if (!empty($recent) && $recent === 'recent') {
            $this->db->where('request_datetime >=', 'DATE_FORMAT(CURDATE(), "%Y-%m-%d") - INTERVAL 2 MONTH');
        }
        if (!empty($sort_authorize) && $sort_authorize === 'sort_authorize') {
            $this->db->order_by('publish_datetime', 'DESC');
        } else {
            $this->db->order_by('uralensis_request_id', 'DESC');
        }
        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    if ($item === 'dob') {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $new_format_dob = date('Y-m-d', strtotime($_POST['search']['value']));
                        $this->db->like($item, $new_format_dob);
                    }
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    if ($item === 'dob') {
                        $new_format_dob = date('Y-m-d', strtotime($_POST['search']['value']));
                        $this->db->or_like($item, $new_format_dob);
                    }
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    /**
     * Record Count Filter
     *
     * @param [type] $year
     * @param string $recent
     * @param string $flag_type
     * @param string $sort_authorize
     * @param string $urgency_type
     * @param string $row_color_code
     * @return {data}
     */
    public function record_count_filtered($year, $recent = '', $flag_type = '', $sort_authorize = '', $urgency_type = '', $row_color_code = '')
    {
        $this->get_datatables_record_query($year, $recent, $flag_type, $sort_authorize, $urgency_type = '', $row_color_code = '');
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * Count all results
     *
     * @return {data}
     */
    public function record_count_all()
    {
        $this->db->from($this->table);
        
        return $this->db->count_all_results();
    }
    
    public function doctor_record_list($doctor_id, $filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT *, CASE WHEN request_assignee.user_id = $doctor_id THEN 'assigned' Else 'unassigned' END AS user_type FROM request
            INNER JOIN request_assignee on request.uralensis_request_id = request_assignee.request_id
            LEFT JOIN `groups` ON `groups`.`id` = request.hospital_group_id            
            LEFT JOIN users_request ON users_request.request_id = request.uralensis_request_id
            WHERE request_assignee.user_id=$doctor_id   
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' group by request.uralensis_request_id");
        return $query->result();
    }
	
	public function hospital_record_list($hos_id, $filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request
            INNER JOIN request_assignee
            LEFT JOIN `groups` ON `groups`.`id` = request.hospital_group_id            
            LEFT JOIN users_request ON users_request.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.hospital_group_id=$hos_id   
            AND request.specimen_publish_status = 0" );
//        echo $this->db->last_query(); exit;

        return $query->result();
    }
	
	public function doctor_record_list_publish($doctor_id, $filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT *, CASE WHEN request_assignee.user_id = $doctor_id THEN 'assigned' Else 'unassigned' END AS user_type FROM request
            INNER JOIN request_assignee
            LEFT JOIN `groups` ON `groups`.`id` = request.hospital_group_id
            
            LEFT JOIN users_request ON users_request.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND users_request.doctor_id=$doctor_id   
            AND request.specimen_publish_status = 1
            AND request.supplementary_review_status = 'false' ");
//        echo $this->db->last_query(); exit;

        return $query->result();
    }
	
		public function hospital_record_list_publish($hos_id, $filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request
            INNER JOIN request_assignee
            LEFT JOIN `groups` ON `groups`.`id` = request.hospital_group_id
            
            LEFT JOIN users_request ON users_request.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.hospital_group_id=$hos_id   
            AND request.specimen_publish_status = 1");
    //    echo $this->db->last_query(); exit;

        return $query->result();
    }
	
	
	public function lab_record_list($lab_id, $filter='', $status='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $status_where = '';
        if($status != ''){
            //$status_where = " AND request_code_status = '".base64_decode($status)."'";
        }
        $labIdStr = $this->getLabIdsFromUser($lab_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
        
        //commented by Vishal to list all the requests for all labs
        //$filter .= " AND request.lab_id IN ($labIds)";
        $filter .= " AND request.lab_id IN (114,115)";

        $query = $this->db->query("SELECT *, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number, count(DISTINCT(specimen.specimen_id)) as speciman_no FROM request
            INNER JOIN request_assignee                     
            /*LEFT JOIN section_comments ON section_comments.record_id=request.uralensis_request_id*/
            LEFT JOIN users ON request.request_add_user = users.id
            LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
            LEFT JOIN specimen on specimen.request_id = request.uralensis_request_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' $filter $status_where GROUP BY `request`.`uralensis_request_id`");
        //GROUP BY request.uralensis_request_id
    //    echo $this->db->last_query(); exit;
        /*AND request.request_add_user = $lab_id */

        $resArr = $query->result();
        foreach($resArr as $key=>$row) {
            $description = $this->db->get_where('section_comments', ['record_id' => $row->uralensis_request_id])->row()->description;
            $resArr[$key]->description = (isset($description)) ? $description : '';
        }
        return $resArr;

        //return $query->result();
    }
    

    public function lab_record_counts_by_status($lab_id, $filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $labIdStr = $this->getLabIdsFromUser($lab_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
        $filter .= " AND request.lab_id IN ($labIds)";

        $query = $this->db->query("SELECT count(DISTINCT(request.uralensis_request_id)) as request_status_count,request_code_status  FROM request
            INNER JOIN request_assignee                     
            /*LEFT JOIN section_comments ON section_comments.record_id=request.uralensis_request_id*/
            LEFT JOIN users ON request.request_add_user = users.id
            LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' AND request.request_code_status != '' $filter GROUP BY request.request_code_status");
        //GROUP BY request.uralensis_request_id
    //    echo $this->db->last_query(); exit;
        /*AND request.request_add_user = $lab_id */

        $resArr = $query->result();
        foreach($resArr as $key=>$row) {
            $description = $this->db->get_where('section_comments', ['record_id' => $row->uralensis_request_id])->row()->description;
            $resArr[$key]->description = (isset($description)) ? $description : '';
        }
        return $resArr;

        //return $query->result();
    }

    public function get_all_records($lab_id, $filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $labIdStr = $this->getLabIdsFromUser($lab_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
        $filter .= " AND request.lab_id IN ($labIds)";

        $query = $this->db->query("SELECT *, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by, tbl_courier.courier_no as courier_number FROM request
            INNER JOIN request_assignee                     
            LEFT JOIN users ON request.request_add_user = users.id
            LEFT JOIN tbl_courier ON tbl_courier.id=request.emis_number
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request.specimen_publish_status in (0,1)
            AND request.supplementary_review_status = 'false' ".$filter);
        return $query->result();
    }
    
    public function doctor_record_list_with_slide($doctor_id, $filter = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("
        SELECT DISTINCT request.uralensis_request_id as record_id
        FROM request 
        INNER JOIN request_assignee ON request.uralensis_request_id = request_assignee.request_id 
        INNER JOIN request_specimen ON request.uralensis_request_id = request_specimen.rs_request_id 
        INNER JOIN specimen_slide 
        WHERE request_assignee.user_id = $doctor_id
        AND request_specimen.rs_specimen_id = specimen_slide.specimen_id 
        AND request.specimen_publish_status = 0 
        AND request.supplementary_review_status = 'false' ".$filter);

        return $query->result();

    }
	
	    public function lab_record_list_with_slide($lab_id, $filter = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("
        SELECT DISTINCT request.uralensis_request_id as record_id
        FROM request 
        INNER JOIN request_assignee ON request.uralensis_request_id = request_assignee.request_id 
        INNER JOIN request_specimen ON request.uralensis_request_id = request_specimen.rs_request_id 
        INNER JOIN specimen_slide 
        where request.request_add_user = $lab_id
        AND request_specimen.rs_specimen_id = specimen_slide.specimen_id 
        AND request.specimen_publish_status = 0 
        AND request.supplementary_review_status = 'false' ".$filter);

        return $query->result();

    }
    public function lab_all_record_list_with_slide($lab_id, $filter = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("
        SELECT DISTINCT request.uralensis_request_id as record_id
        FROM request 
        INNER JOIN request_assignee ON request.uralensis_request_id = request_assignee.request_id 
        INNER JOIN request_specimen ON request.uralensis_request_id = request_specimen.rs_request_id 
        INNER JOIN specimen_slide 
        where request.request_add_user = $lab_id
        AND request_specimen.rs_specimen_id = specimen_slide.specimen_id 
        AND request.specimen_publish_status in (0,1) 
        AND request.supplementary_review_status = 'false' ".$filter);

        return $query->result();

    }
	

	
	
	public function hospital_record_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        //$user_id = $this->ion_auth->user()->row()->id;
		$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
			}
			else
			{
			$user_id=$user_id;
			}
		
		
        $query = $this->db->query("SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
         AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(username, '" . DATA_KEY . "') AS username,
        uralensis_request_id, record_batch_id, 
        serial_number, ura_barcode_no, 
        patient_initial, pci_number, 
        request_datetime, publish_datetime,
        publish_datetime_modified, emis_number, 
        nhs_number, lab_number, hos_number, sur_name,
        f_name, dob, age, lab_id, lab_name, date_received_bylab, 
        data_processed_bylab, date_sent_touralensis,
        date_rec_by_doctor, gender, clrk, dermatological_surgeon, 
        date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id,
        request.status, specimen_update_status, specimen_publish_status, 
        further_work_status, supplementary_report_status, supplementary_review_status, 
        report_status, publish_status, hospital_group_id, additional_data_state,
        comment_section, comment_section_date, teaching_case, mdt_case,
        mdt_case_status, mdt_list_id, mdt_specimen_status, 
        mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, 
        mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos,
        fw_imf, special_notes, special_notes_date, record_secretary_id, 
        record_assign_sec_time, record_secretary_status, secretary_record_edit_status,
        cases_category, cost_codes, flag_status, authorize_status, request_add_user, 
        request_add_user_timestamp, clinic_ref_number, clinic_request_form, 
        request_code_status, record_edit_status, ura_rec_temp_dataset, remote_record, `location`, `apd`.*, `vrd`.*
        FROM request
        INNER JOIN request_assignee ON request_assignee.request_id = request.uralensis_request_id
        LEFT JOIN request_autopsy_detail apd ON apd.request_id = request.uralensis_request_id
        LEFT JOIN request_virology_detail vrd ON vrd.request_id = request.uralensis_request_id
        INNER JOIN users ON request_assignee.user_id = users.id
        WHERE request.uralensis_request_id = $id ");
        $session_data = array(
            'id' => $id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);
        
        return $query->result();
    }
	

    /**
     * Record Detail Page
     *
     * @param int $id
     * @return array
     */
    public function doctor_record_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
            $user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
				$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
				$user_id=$res[0]['user_id'];
			}
			else
			{
				$user_id=$user_id;
			}
		
		
		
		
		/*print "SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
         AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(username, '" . DATA_KEY . "') AS username,
        uralensis_request_id, record_batch_id, 
        serial_number, ura_barcode_no, 
        patient_initial, pci_number, 
        request_datetime, publish_datetime,
        publish_datetime_modified, emis_number, 
        nhs_number, lab_number, hos_number, sur_name,
        f_name, dob, age, lab_id, lab_name, date_received_bylab, 
        data_processed_bylab, date_sent_touralensis,
        date_rec_by_doctor, gender, clrk, dermatological_surgeon, 
        date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id,
        request.status, specimen_update_status, specimen_publish_status, 
        further_work_status, supplementary_report_status, supplementary_review_status, 
        report_status, publish_status, hospital_group_id, additional_data_state,
        comment_section, comment_section_date, teaching_case, mdt_case,
        mdt_case_status, mdt_list_id, mdt_specimen_status, 
        mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, 
        mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos,
        fw_imf, special_notes, special_notes_date, record_secretary_id, 
        record_assign_sec_time, record_secretary_status, secretary_record_edit_status,
        cases_category, cost_codes, flag_status, authorize_status, request_add_user, 
        request_add_user_timestamp, clinic_ref_number, clinic_request_form, 
        request_code_status, record_edit_status, ura_rec_temp_dataset, remote_record, `location`, `apd`.*, `vrd`.*
        FROM request
        INNER JOIN request_assignee ON request_assignee.request_id = request.uralensis_request_id
        LEFT JOIN request_autopsy_detail apd ON apd.request_id = request.uralensis_request_id
        LEFT JOIN request_virology_detail vrd ON vrd.request_id = request.uralensis_request_id
        INNER JOIN users ON request_assignee.user_id = users.id
        WHERE request.uralensis_request_id = $id ";*/
		//exit;
		
        $query = $this->db->query("SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
        AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
        AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
         AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
        AES_DECRYPT(username, '" . DATA_KEY . "') AS username,patient_id as p_id,
        uralensis_request_id, record_batch_id, 
        serial_number, ura_barcode_no, 
        patient_initial,patient_id, pci_number, 
        request_datetime, publish_datetime,
        publish_datetime_modified, emis_number, 
        nhs_number, lab_number, hos_number, sur_name,
        f_name, dob, age, lab_id, lab_name, date_received_bylab, 
        data_processed_bylab, date_sent_touralensis,
        date_rec_by_doctor, gender, clrk, dermatological_surgeon, 
        date_taken, urgent, hsc, report_urgency, cl_detail, specimen_id,
        request.status,request.lab_processing_id, specimen_update_status, specimen_publish_status, 
        further_work_status, supplementary_report_status, supplementary_review_status, 
        report_status, publish_status, hospital_group_id, additional_data_state,
        comment_section, comment_section_date, teaching_case, mdt_case,
        mdt_case_status, mdt_list_id, mdt_specimen_status, 
        mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, 
        mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos,
        fw_imf, special_notes, special_notes_date, record_secretary_id, 
        record_assign_sec_time, record_secretary_status, secretary_record_edit_status,
        cases_category, cost_codes, flag_status, authorize_status, request_add_user, 
        request_add_user_timestamp, clinic_ref_number, clinic_request_form, 
        request_code_status, record_edit_status, ura_rec_temp_dataset, remote_record, `location`, `apd`.*, `vrd`.*, urtt.courier_no, urtt.billing_type,request.ref_lab_number
        FROM request
        INNER JOIN request_assignee ON request_assignee.request_id = request.uralensis_request_id
        LEFT JOIN request_autopsy_detail apd ON apd.request_id = request.uralensis_request_id
        LEFT JOIN request_virology_detail vrd ON vrd.request_id = request.uralensis_request_id
        LEFT JOIN uralensis_record_track_template AS urtt ON urtt.ura_rec_temp_id = request.template_id
        INNER JOIN users ON request_assignee.user_id = users.id
        WHERE request.uralensis_request_id = $id ");
        $session_data = array(
            'id' => $id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);
        
        return $query->result();
    }
    
    /**
     * Record Detail Specimen
     *
     * @param int $id
     * @return array
     */
    public function doctor_record_detail_specimen($id, $hospital_group_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        $currentGroupId = $this->ion_auth->get_users_main_groups()->row()->id;
		    $user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
			}
			else
			{
			$user_id=$user_id;
			}
		
		
        $sql = "SELECT users.id,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
                AES_DECRYPT(company, '" . DATA_KEY . "') AS company,
                AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,
                AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
                AES_DECRYPT(email, '" . DATA_KEY . "') AS email,
                AES_DECRYPT(username, '" . DATA_KEY . "') AS username,
                uralensis_request_id, record_batch_id, 
                serial_number, ura_barcode_no, 
                patient_initial, pci_number, 
                request_datetime, publish_datetime,
                publish_datetime_modified, emis_number, 
                nhs_number, lab_number, hos_number, sur_name,
                f_name, dob, age, lab_name, date_received_bylab, 
                data_processed_bylab, date_sent_touralensis,
                date_rec_by_doctor, gender, clrk, dermatological_surgeon, 
                date_taken, urgent, hsc, report_urgency, cl_detail,
                request.status, specimen_update_status, specimen_publish_status, 
                further_work_status, supplementary_report_status, supplementary_review_status, 
                report_status, publish_status, hospital_group_id, additional_data_state,
                comment_section, comment_section_date, teaching_case, mdt_case,
                mdt_case_status, mdt_list_id, mdt_specimen_status, 
                specimen.request_id,
                mdt_case_assignee_username, mdt_case_msg, mdt_case_msg_timestamp, 
                mdt_case_add_to_report_status, mdt_outcome_text, fw_levels, fw_immunos,
                fw_imf, special_notes, special_notes_date, record_secretary_id, 
                record_assign_sec_time, record_secretary_status, secretary_record_edit_status,
                cases_category, cost_codes, flag_status, authorize_status, request_add_user, 
                request_add_user_timestamp, clinic_ref_number, clinic_request_form, 
                request_code_status, record_edit_status, request_assign_status, ura_rec_temp_dataset,
                specimen.specimen_id, specimen_clinical_history, specimen_site,
                specimen_procedure, specimen_type, specimen_block, 
                specimen_slides, specimen_block_type, specimen_macroscopic_code,
                specimen_macroscopic_description, specimen_info_save_code,
                specimen_info_save_description, specimen_microscopic_code, 
                specimen_microscopic_description, specimen_diagnosis_code,
                specimen_diagnosis_description, specimen_comment_code, 
                specimen_comment_description, specimen_snomed_code, 
                specimen_snomed_description, specimen_snomed_t, 
                specimen_snomed_t2, specimen_snomed_p, specimen_snomed_m,
                specimen_information_code, specimen_information_description,
                specimen_status, specimen_cancer_register, 
                specimen_right, specimen_left, specimen_na,
                specimen_urgent, specimen_hsc_205, specimen_rcpath_code, 
                specimen_benign, specimen_atypical, 
                specimen_malignant, specimen_inflammation, 
                specimen_accepted_by, specimen_assisted_by,
                specimen_labelled_by, specimen_cutup_by,
                specimen_block_checked_by,
                specimen_qc_by, specimen_comment_section, 
                specimen_comment_section_timestamp, 
                specimen_special_notes, specimen_special_notes_timestamp,
                specimen_feedback_to_lab, specimen_feedback_to_lab_timestamp,
                specimen_feedback_to_secretary, specimen_feedback_to_secretary_timestamp,
                specimen_error_log, specimen_error_log_timestamp,
                rbc.billing_type, rbc.bill_code, rbc.bill_code_text, rbc.billing_type, rbc.bill_description, rbc.bill_price,urtt.billing_type as billing_type2, urtt.specimen_id_val as specimen_id_val, urtt.tissue_type_id, urtt.department_id
                 FROM request
            INNER JOIN specimen
            INNER JOIN users
            INNER JOIN request_assignee
            LEFT JOIN uralensis_record_track_template as urtt ON urtt.ura_rec_temp_id=request.template_id
            LEFT JOIN request_billing_code as rbc ON rbc.request_id=request.uralensis_request_id AND rbc.specimen_id=specimen.specimen_id
            WHERE request.uralensis_request_id = $id
            AND specimen.request_id = $id
            AND request_assignee.request_id = $id
            AND request_assignee.user_id = $user_id
            AND users.id = $user_id GROUP BY specimen.specimen_id";
        $query = $this->db->query($sql);
        $session_data = array(
            'id' => $id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);

        $resArr = $query->result();
        foreach ($resArr as $row){
            if($hospital_group_id != ''){
                $row->bill_code_arr = $this->db->select('bd.id, bd.bill_code, bd.bill_description')->from('billing_data as bd')->join('specimen_type as st', 'st.spec_type_id = bd.specimen_type_id', 'left')->where('bd.group_id', $currentGroupId)->where('bd.clinic_id', $hospital_group_id)->get()->result_array();
            }else{
                $row->bill_code_arr = $this->db->select('bd.id, bd.bill_code, bd.bill_description')->from('billing_data as bd')->join('specimen_type as st', 'st.spec_type_id = bd.specimen_type_id', 'left')->where('bd.group_id', $currentGroupId)->get()->result_array();
            }
            $row->request = $this->db->get_where('request_billing_code', ['specimen_id'=>$row->specimen_id, 'request_id'=>$row->uralensis_request_id])->result_array();
            $row->specimenArr = $this->db->select('specimen_type_id as id, specimen_type as name')->get_where('department_settings_labs', ['department_id'=>$row->department_id ,'specimen_type !='=>NULL])->result_array();
            $row->tissueTypeArr = $this->db->select('id, name')->get_where('tissue_type', ['department_id'=>$row->department_id])->result_array();
        }
        return $resArr;
        //return $query->result();
    }
    
    /**
     * Record Detail Specimen For MDT Reports
     *
     * @param int $id
     * @return array
     */
    public function doctor_record_detail_specimen_mdt($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
       // $user_id = $this->ion_auth->user()->row()->id;
		$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
			}
			else
			{
			$user_id=$user_id;
			}
		
		
        $sql = "SELECT * FROM request
            INNER JOIN specimen
            INNER JOIN users
            INNER JOIN request_assignee
            WHERE request.uralensis_request_id = $id
            AND specimen.request_id = $id
            AND request_assignee.request_id = $id
            AND request_assignee.user_id = users.id";
        $query = $this->db->query($sql);
        $session_data = array(
            'id' => $id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);
        
        return $query->result();
    }
    
    /**
     * This Method Will only return the Hospital Information
     *
     * @param int $id
     * @return array
     */
    public function get_hospital_info($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM `groups`
                                INNER JOIN request
                                INNER JOIN users_request
                                WHERE request.uralensis_request_id = $id
                                AND users_request.request_id = request.uralensis_request_id
                                AND groups.id = request.hospital_group_id");
        
        return $query->result();
    }
	
	
	public function get_patient_info($id)
    {
        if (!$this->ion_auth->logged_in()) 
		{
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM `groups`
                                INNER JOIN request
                                INNER JOIN users_request
                                WHERE request.uralensis_request_id = $id
                                AND users_request.request_id = request.uralensis_request_id
                                AND groups.id = request.hospital_group_id");
        
        return $query->result();
    }
    
    /**
     * Further Work
     *
     * @param int $id
     * @return array
     */
    public function get_further_work($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
       // $user_id = $this->ion_auth->user()->row()->id;
		
		    $user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
			}
			else
			{
			$user_id=$user_id;
			}
		
		
		
        $query = $this->db->query("SELECT * FROM `further_work`
                                    WHERE request_id = $id
                                    AND doctor_id = $user_id");
        
        return $query->result();
    }
	
	  public function get_patient_details($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
       // $user_id = $this->ion_auth->user()->row()->id;
	   if($id!='')
	   {
        $query = $this->db->query("SELECT * FROM `patients` WHERE id = $id");
        
        return $query->result();
	   }
	   else
	   {
		   return 0;
		}
    }
    
    /**
     * Insert Further Work
     *
     * @param array $work
     * @return void
     */
    public function further_work_add($work)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('further_work', $work);
    }
    
    /**
     * Update Further Work Table
     *
     * @param array $work
     * @return void
     */
    public function further_work($work)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('further_work', $work);
    }
    
    /**
     * Add Hospital And Request ID in Additional Work Table
     *
     * @param array $additional_work_add
     * @return void
     */
    public function additional_work_add($additional_work_add)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('additional_work', $additional_work_add);
    }
    
    /**
     * Update Additional Work Table
     *
     * @param array $additional_work
     * @return void
     */
    public function additional_work($additional_work)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('additional_work', $additional_work);
    }
    
    /**
     * Get additional work
     *
     * @param int $id
     * @return array
     */
    public function get_additional_work_for_prebulish($id)
    {
        $query = $this->db->query("SELECT * FROM `additional_work` WHERE request_id = $id");
        
        return $query->result();
    }
    
    /**
     * Get Specific Supplementary record
     *
     * @param int $id
     * @return array
     */
    public function get_additional_work($id)
    {
        $query = $this->db->query("SELECT * FROM `additional_work` WHERE request_id = $id AND data_state = 'save_data'");
        
        return $query->result();
    }
    
    /**
     * Get Search Request
     *
     * @param string $first_name
     * @param string $sur_name
     * @param string $nhs_no
     * @param string $dob
     * @param string $gender
     * @return array
     */
    public function get_search_request($first_name = '', $sur_name = '', $nhs_no = '', $dob = '', $gender = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
		
		
		//$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$doctor_id=$res[0]['user_id'];
			}
			else
			{
			$doctor_id=$user_id;
			}
		
		
        $where = array();
        if ($first_name != '') {
            $where['f_name'] = $first_name;
        }
        if ($sur_name != '') {
            $where['sur_name'] = $sur_name;
        }
        if ($nhs_no != '') {
            $where['nhs_number'] = $nhs_no;
        }
        if ($dob != '') {
            $where['dob'] = $dob;
        }
        if ($gender != '') {
            $where['gender'] = $gender;
        }
            $where['request_assignee.user_id'] = $doctor_id;
        if (empty($where)) {
            return array(); // ... or NULL
        } else {
            $this->db->select('*');
            $this->db->from('request');
            $this->db->join('request_assignee', 'request_assignee.request_id=request.uralensis_request_id');
            $this->db->where($where);
            $query = $this->db->get();
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
     * Display published records
     *
     * @param string $year
     * @param string $recent
     * @return array
     */
    public function doctor_record_published($year, $recent = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($year)) {
            $doctor_id = $this->ion_auth->user()->row()->id;
			
			//$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$doctor_id=$res[0]['user_id'];
			}
			else
			{
			$doctor_id=$user_id;
			}
			
            $sql = "";
            $sql .= "SELECT * FROM request
                INNER JOIN request_assignee
                WHERE request.uralensis_request_id = request_assignee.request_id
                AND request_assignee.user_id = $doctor_id
                AND specimen_publish_status = 1
                AND YEAR(request.request_datetime) = $year ";
            if (!empty($recent) && $recent === 'recent') {
                $sql .= " AND request.request_datetime >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH) ";
            }
            $sql .= " ORDER BY request.uralensis_request_id ASC";
            $query = $this->db->query($sql);
            
            return $query->result();
        }
    }
    
    /**
     * Fetch Status Bar Results Count Published
     *
     * @return void
     */
    public function status_bar_result_count_published($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->ion_auth->user()->row()->id;
		$group_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
		$groupType = $this->ion_auth->get_users_main_groups()->row()->group_type;
        if(in_array($groupType,LAB_GROUP))
		{         
			//$this->db->select("*, CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS added_by");
			$this->db->select('*,count(DISTINCT(specimen.specimen_id)) as speciman_no');
			$this->db->from($this->table);
			$this->db->join('request_assignee', 'request.uralensis_request_id = request_assignee.request_id', 'INNER');
            $this->db->join('specimen', 'specimen.request_id = request.uralensis_request_id', 'LEFT');
			$this->db->where('request.lab_id', $group_id);
			$this->db->where('request.publish_status', '1');
            $this->db->group_by('request.uralensis_request_id');

            $result = $this->db->get();
            
			//$this->db->where('request.request_code_status', 'record_publish');
			
				
		}else{
            //$user_id = $this->ion_auth->user()->row()->id;
            $user_id = $this->ion_auth->user()->row()->id;
            $user_type = $this->ion_auth->user()->row()->user_type;
            //$user_type = get_user_type($user_id);
            if($user_type!='D')
            {
                if($id!='')
                {
            $res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
            $user_id=$res[0]['user_id'];
                }
            }
            else
            {
            $user_id=$user_id;
            }
            if (!empty($id)) {
                $user_id = $id;
            }
            $year = date('Y');
            $result = $this->db->query("SELECT * FROM request
                        INNER JOIN request_assignee
                        WHERE request.uralensis_request_id = request_assignee.request_id
                        AND request_assignee.user_id = $user_id
                        AND YEAR(request.request_datetime) = $year
                        AND request.specimen_publish_status = 1");
        }

        
        
        return $result->num_rows();
    }
    
    /**
     * Fetch Status Bar Results Count Un Reported
     *
     * @return void
     */
    public function status_bar_result_count_un_reported($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
       // $user_id = $this->ion_auth->user()->row()->id;
		$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
				if($id!='')
				{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
				}
			}
			else
			{
			$user_id=$user_id;
			}
		
        if (!empty($id)) {
            $user_id = $id;
        }
        $result = $this->db->query("SELECT * FROM request 
                    INNER JOIN request_assignee
                    WHERE request.uralensis_request_id = request_assignee.request_id
                    AND request_assignee.user_id = $user_id 
                    AND request.specimen_publish_status = 0
                    AND supplementary_review_status = 'false' group by request.uralensis_request_id");
        
        return $result->num_rows();
    }
    
    /**
     * Fetch Status Bar Results Count Total Reported
     *
     * @return void
     */
    public function status_bar_result_count_total_reports()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        //$user_id = $this->ion_auth->user()->row()->id;
		
		$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
				if($id!='')
				{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
			}
			}
			else
			{
			$user_id=$user_id;
			}
		
        $result = $this->db->query("SELECT * FROM request 
                    INNER JOIN request_assignee
                    WHERE request.uralensis_request_id = request_assignee.request_id
                    AND request_assignee.user_id = $user_id");
        
        return $result->num_rows();
    }
    
    /**
     * Insert file data into DB
     *
     * @param string $filename
     * @param string $title
     * @param string $path
     * @param string $file_ext
     * @param string $is_image
     * @param int $user
     * @param int $doc_id
     * @param int $record_id
     * @return void
     */
    public function insert_file($filename, $title, $path, $file_ext, $is_image, $user, $doc_id, $record_id, $file_tag)
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
            'record_id' => $record_id,
            'file_tag'=>$file_tag
        );
        $this->db->insert('files', $data);
    }
    
    /**
     * Fetch Files Data
     *
     * @param int $id
     * @return array
     */
    public function fetch_files_data($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        //$user_id = $this->ion_auth->user()->row()->id;
		
		
		$user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$user_id=$res[0]['user_id'];
			}
			else
			{
			$user_id=$user_id;
			}
        if (isset($id) && !empty($id)) {
            $record_id = $id;
            $query = $this->db->query("
                SELECT files.*, 
                CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'), ' ', AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS uploaded_by 
                FROM files 
                INNER JOIN users ON files.user_id = users.id
                WHERE record_id = $record_id 
                ORDER BY files_id");
            
            return $query->result();
        }
    }
    
    /**
     * Get Lab Name Records
     *
     * @return void
     */
    public function get_lab_names()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        return $this->db->where('group_type', 'L')->get('groups')->result_array();
    }
    
    /**
     * Get All  laboratory names from group table.
     *
     * @return void
     */
    public function getLabNamesFromLabGroups()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        return $this->db->where('group_type', 'L')->get('groups')->result_array();
    }
    
    /**
     * Teaching Cases Display Model
     *
     * @param int $category_id
     * @return void
     */
    public function teaching_cases($category_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
		
		    $user_id = $this->ion_auth->user()->row()->id;
		    $user_type = $this->ion_auth->user()->row()->user_type;
			//$user_type = get_user_type($user_id);
			if($user_type!='D')
			{
			$res = $this->db->query("SELECT `user_id` FROM `request_assignee` WHERE request_id = $id")->result_array();	
			$doctor_id=$res[0]['user_id'];
			}
			else
			{
			$doctor_id=$user_id;
			}
		
        $query = $this->db->query("SELECT * FROM request
        INNER JOIN request_assignee
        INNER JOIN uralensis_teach_mdt_cats
        WHERE request.uralensis_request_id = request_assignee.request_id
        AND request_assignee.user_id = $doctor_id
        AND request.teaching_case = uralensis_teach_mdt_cats.ura_tec_mdt_id
        AND uralensis_teach_mdt_cats.ura_tec_mdt_id = $category_id GROUP BY request.uralensis_request_id");
        // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    /**
     * Pending MDT Cases Display Model
     *
     * @param int $hospital_group_id
     * @param string $mdt_date
     * @param int $list_id
     * @return array
     */
    public function mdt_cases_list_model($hospital_group_id = '', $mdt_date = '', $list_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "";
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($hospital_group_id)) {
            $sql = "";
            $sql .= "SELECT * FROM request
                INNER JOIN users_request
                INNER JOIN groups
                INNER JOIN request_assignee
                INNER JOIN uralensis_mdt_dates ";
            if (!empty($list_id)) {
                $sql .= ' INNER JOIN uralensis_mdt_lists';
            }
            $sql .= " INNER JOIN uralensis_mdt_records
                WHERE users_request.request_id = request.uralensis_request_id
                AND request.uralensis_request_id = request_assignee.request_id
                AND groups.id = users_request.group_id
                AND users_request.group_id = $hospital_group_id
                AND request_assignee.user_id = $doctor_id
                AND uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
                AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') = uralensis_mdt_records.mdt_date
                AND request.mdt_case_status = 'for_mdt'
                AND uralensis_mdt_records.mdt_date = '$mdt_date' ";
            if (!empty($list_id)) {
                $sql .= " AND uralensis_mdt_lists.ura_mdt_list_id = $list_id
                AND request.mdt_list_id = $list_id
                AND request.mdt_list_id = uralensis_mdt_records.mdt_list_id
                AND request.mdt_list_id = uralensis_mdt_lists.ura_mdt_list_id ";
            }
            $sql .= "ORDER BY request.publish_datetime DESC, request.uralensis_request_id DESC";
            $query = $this->db->query($sql);
            
            return $query->result();
        }
    }
    
    /**
     * Pending MDT Cases Display Model
     *
     * @param int $hospital_group_id
     * @param string $mdt_date
     * @return void
     */
    public function mdt_cases_list_model_new($hospital_group_id = '', $mdt_date = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "";
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($hospital_group_id)) {
            $sql = "";
            //AND request_assignee.user_id = $doctor_id
            //This above part deleted because mdt records only listed user specific
            //Now the records will be listed if cases assign on same mdt date also 
            //to different doctors
            $sql .= "SELECT * FROM request
                INNER JOIN users_request
                INNER JOIN groups
                INNER JOIN request_assignee
                INNER JOIN uralensis_mdt_dates ";
            $sql .= " INNER JOIN uralensis_mdt_records
                WHERE users_request.request_id = request.uralensis_request_id
                AND request.uralensis_request_id = request_assignee.request_id
                AND uralensis_mdt_records.record_id = request.uralensis_request_id
                AND groups.id = users_request.group_id
                AND users_request.group_id = $hospital_group_id

                AND uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
                AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') = uralensis_mdt_records.mdt_date
                AND request.mdt_case_status = 'for_mdt'
                AND uralensis_mdt_records.mdt_date = '$mdt_date' ";
            $sql .= "GROUP BY request.uralensis_request_id ORDER BY request.publish_datetime DESC, request.uralensis_request_id DESC";
          
            $query = $this->db->query($sql);
            
            return $query->result();
        }
    }
    
    /**
     * Pending MDT Cases Display Model
     *
     * @param int $hospital_group_id
     * @return array
     */
    public function pending_mdt_cases($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($hospital_group_id)) {
            $query = $this->db->query("SELECT * FROM request
                        INNER JOIN users_request
                        INNER JOIN groups
			INNER JOIN request_assignee
                        WHERE users_request.request_id = request.uralensis_request_id
                        AND request.uralensis_request_id = request_assignee.request_id
                        AND groups.id = users_request.group_id
                        AND users_request.group_id = $hospital_group_id
                        AND request_assignee.user_id = $doctor_id
                        AND request.mdt_case_status = 'pending'
                        AND request.mdt_case = 'on'");
            
            return $query->result();
        }
    }
    
    /**
     * Post MDT Cases Display Model
     *
     * @param int $hospital_group_id
     * @return array
     */
    public function post_mdt_cases($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        if (isset($hospital_group_id)) {
            $query = $this->db->query("SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN groups
                    INNER JOIN request_assignee
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND request.uralensis_request_id = request_assignee.request_id
                    AND groups.id = users_request.group_id
                    AND users_request.group_id = $hospital_group_id
                    AND request_assignee.user_id = $doctor_id
                    AND request.mdt_case_status = 'post'
                    AND request.mdt_case = 'on'");
            
            return $query->result();
        }
    }
    
    /**f
     * Teaching Case Detail Data
     *
     * @param int $record_id
     * @return array
     */
    public function teaching_case_detail_model($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT * FROM request
                                INNER JOIN users
                                INNER JOIN request_assignee
                                WHERE request.uralensis_request_id = $record_id
                                AND request_assignee.request_id = $record_id
                                AND request_assignee.user_id = $user_id
                                AND users.id = $user_id");
        $session_data = array(
            'id' => $record_id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);
        
        return $query->result();
    }
    
    /**
     * MDT Detail Cases
     *
     * @return array
     */
    public function mdt_case_detail_model()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $record_id = '';
        if (isset($_GET['record_id'])) {
            $record_id = $_GET['record_id'];
            $doctor_id = $this->ion_auth->user()->row()->id;
            $query = $this->db->query("SELECT * FROM request
                        INNER JOIN users
                        INNER JOIN request_assignee
                        WHERE request.uralensis_request_id = $record_id
                        AND request_assignee.request_id = $record_id
                        AND request_assignee.user_id = $doctor_id
                        AND users.id = $doctor_id");
            
            return $query->result();
        }
    }

    public function display_further_work_requested()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $subQuery = "(SELECT  req_assign_id,user_id,request_id,MAX(req_assign_id) Maxpath FROM  request_assignee GROUP BY req_assign_id) rq_as";
        $query = $this->db->query("SELECT GROUP_CONCAT(DISTINCT block.fw_status) as existingStatus,count(fwd.id) as testCount, fw.*, requester.id,request.uralensis_request_id as request_id, request.lab_number, request.nhs_number, request.request_datetime, request.hospital_group_id, request.data_processed_bylab, request.date_received_bylab, request.publish_datetime,request.date_rec_by_doctor, request.sur_name as pSurname,CONCAT(p1.first_name,' ' ,p1.last_name) AS patient_name,concat(request.f_name,' ',request.sur_name) as patientnm, lt.name as test_name, CONCAT(AES_DECRYPT(patho.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(patho.last_name, '" . DATA_KEY . "')) AS pathologist FROM further_work fw
        LEFT JOIN further_work_detail as fwd on fwd.further_work_id = fw.fw_id
        LEFT JOIN laboratory_tests as lt ON lt.id=fwd.test_id 
        LEFT JOIN specimen_blocks as block on fwd.block_id=block.specimen_id AND fwd.test_id = block.specimen_no
        LEFT JOIN request on request.uralensis_request_id = fw.request_id
        LEFT JOIN $subQuery ON rq_as.request_id = request.uralensis_request_id
        LEFT JOIN users as patho ON patho.id = rq_as.user_id
        LEFT JOIN users as requester ON requester.id=request.request_add_user
        LEFT JOIN patients as p1 ON p1.id=request.patient_id GROUP BY fw.fw_id ORDER BY fw.furtherwork_date DESC");
        
        return $query->result();
    }
    
    /**
     * Display Further Work
     *
     * @return array
     */

    public function display_further_work_model_requested_new()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $labIdStr = $this->getLabIdsFromUser($user_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
        $filter = " AND request.lab_id IN ($labIds)";   
        $user_where = "";
        // $query = $this->db->query("SELECT further_work.fw_id, 
        //                             request.uralensis_request_id as request_id,
        //                             requester.id,
        //                             request.serial_number,
        //                             request.lab_number,
        //                             request.nhs_number,
        //                             request.request_datetime,
        //                             request.date_taken,
        //                             request.hospital_group_id,
        //                             request.date_sent_touralensis,
        //                             request.hospital_group_id,
        //                             request.data_processed_bylab,
        //                             request.date_received_bylab,
        //                             request.publish_datetime,
        //                             request.date_rec_by_doctor, 
        //                             CONCAT(p1.first_name,' ' ,p1.last_name) AS patient_name,
        //                             lt.name as test_name,
        //                             CONCAT(AES_DECRYPT(pathologist.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(pathologist.last_name, '" . DATA_KEY . "')) AS pathologist,
        //                             CONCAT(AES_DECRYPT(requester.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(requester.last_name, '" . DATA_KEY . "')) AS requester
                                   
        //     FROM further_work
        //         INNER JOIN request ON further_work.request_id=request.uralensis_request_id
        //         LEFT JOIN further_work_detail as fwd ON fwd.further_work_id=further_work.fw_id
        //         LEFT JOIN laboratory_tests as lt ON lt.id=fwd.test_id
        //         LEFT JOIN users as requester ON requester.id=request.request_add_user
        //         LEFT JOIN users as pathologist ON pathologist.id=further_work.doctor_id
        //         LEFT JOIN patients as p1 ON p1.id=request.patient_id
        //         WHERE further_work.doctor_id = $user_id
        //             AND request.uralensis_request_id = further_work.request_id
        //             AND further_work.fw_status = 'requested' $filter
        //     GROUP BY fw_id"
        // );
        $query = $this->db->query("SELECT further_work.fw_id,further_work.furtherwork_date,further_work.fw_status, 
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
                                    sp.block_no as further_block_no,
                                    fwd.id as further_request_detail_id,request.sur_name as pSurname,
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
                    AND further_work.fw_status = 'requested' AND sp.created_by!=0"
        );
        /* AND users.id = $user_id */

        return $query->result();
    }

    public function specimen_block_detailwithTests($id){
        $query = $this->db->query("select fwd.*, lt.name as test_name, GROUP_CONCAT(DISTINCT fwd.block_id) as blocks_ids FROM further_work_detail fwd 
        INNER JOIN further_work ON fwd.further_work_id=further_work.fw_id 
        INNER join request on further_work.request_id =request.uralensis_request_id 
        INNER JOIN users as requester ON requester.id=request.request_add_user
        INNER JOIN laboratory_tests as lt ON lt.id=fwd.test_id 
        INNER JOIN patients as p1 ON p1.id=request.patient_id
        where  request.uralensis_request_id = '".$id."' AND fwd.block_id != 0
        GROUP BY fwd.test_id;");

        $result = $query->result_array();
        foreach($result as $key => $res){
            $query = $this->db->query("select GROUP_CONCAT(DISTINCT block_no separator '_') as further_block_no FROM specimen_blocks WHERE specimen_id IN (".$res['blocks_ids'].") AND description = '".$res['test_name']."'");
            $result[$key]['blocks'] = $query->row_array()['further_block_no'];
        }
        return $result;
    }

    public function display_further_work_model_requested()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $labIdStr = $this->getLabIdsFromUser($user_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
        $filter = " AND request.lab_id IN ($labIds)";

        $query = $this->db->query("SELECT  users.id,
        CONCAT(AES_DECRYPT(first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(last_name, '" . DATA_KEY . "')) AS added_by,
        AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
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
                WHERE further_work.doctor_id = $user_id
                AND request.uralensis_request_id = further_work.request_id
                AND further_work.fw_status = 'requested' $filter"
        );
        /* AND users.id = $user_id */

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
        $user_id = $this->ion_auth->user()->row()->id;
        $labIdStr = $this->getLabIdsFromUser($user_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';
        $filter = " AND request.lab_id IN ($labIds)";

        $query = $this->db->query("SELECT users.id,
        CONCAT(AES_DECRYPT(first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(last_name, '" . DATA_KEY . "')) AS added_by,
        AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,
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
                WHERE further_work.doctor_id = $user_id
                AND request.uralensis_request_id = further_work.request_id
                AND further_work.fw_status = 'complete' $filter");

        /* AND users.id = $user_id */
        return $query->result();
    }
    

    public function get_case_slides_data($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT rs_specimen_id from request_specimen where rs_request_id = $id");
        $slides = array();
        foreach ($query->result_array() as $row)
        {
            $specimen_id = $row['rs_specimen_id'];
            $query = $this->db->query("SELECT * from specimen_slide where specimen_id = $specimen_id");
            $specimen_slide = array('specimen_id' => $specimen_id, 'slides' => $query->result_array());
            // foreach($query->result_array() as $r) {
            //     array_push($slides, $r);
            // }
            array_push($slides, $specimen_slide);
        }
        function sort_with_slide_name($a, $b)
        {
            if (strpos($a['slide_name'], "HE") !== FALSE) {
                return -1;
            }else if (strpos($b['slide_name'], "HE") !== FALSE) {
                return 1;
            }
            return strcmp($a['slide_name'], $b['slide_name']);
        }
    
        foreach ($slides as $ind => $spec_slide) {
            $spec_slides = $spec_slide['slides'];
            usort($spec_slides, 'sort_with_slide_name');
            $slides[$ind]['slides'] = $spec_slides;
        }
        return $slides;
    }


    /**
     * Display Hospital List
     *
     * @return void
     */
    public function display_hospitals_list($hospitallist = NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        if (!empty($hospitallist)) 
		{
            $hoslist = implode(",", $hospitallist);
            $query = $this->db->query("SELECT * FROM `groups` WHERE groups.group_type = 'H' AND id IN(" . $hoslist . ")");
        } 
		else 
		{
            $query = $this->db->query("SELECT * FROM `groups` WHERE groups.group_type = 'H'");
        }
        
        return $query->result();
    }

    public function display_hospitals_list_with_org($hospitallist = NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        if (!empty($hospitallist))
        {
            $hoslist = implode(",", $hospitallist);
            $query = $this->db->query("
                        SELECT groups.*, hi.site_identifier, hi.identifier 
                        FROM `groups` 
                        LEFT JOIN `hospital_information` hi on hi.group_id=groups.id 
                        WHERE groups.group_type = 'H' AND 
                              groups.id IN(" . $hoslist . ")");
        }
        else
        {
            $query = $this->db->query("SELECT groups.*, hi.site_identifier, hi.identifier FROM `groups` LEFT JOIN `hospital_information` hi on hi.group_id=groups.id WHERE groups.group_type = 'H'");
        }

        return $query->result();
    }
    
    /**
     * Display Hospital List For MDT
     *
     * @return void
     */
    public function display_doctor_only_hospitals()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query(
            "SELECT * FROM users_request
            INNER JOIN `groups`
            WHERE users_request.doctor_id = $user_id
            AND `groups`.id = users_request.group_id
            AND `groups`.group_type = 'H'
            GROUP BY users_request.group_id"
        );
        
        return $query->result();
    }
	
	
    
    /**
     * Filter Results
     *
     * @param int $hospital_id
     * @param string $report_urgency
     * @return array
     */
    public function find_filter_results($hospital_id, $report_urgency)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $query = "";
        $query .= "SELECT * FROM request
                    INNER JOIN users_request
                    INNER JOIN groups
                    INNER JOIN request_assignee
                    WHERE users_request.request_id = request.uralensis_request_id
                    AND request.uralensis_request_id = request_assignee.request_id
                    AND groups.id = users_request.group_id
                    AND request.specimen_publish_status = 0
                    AND request_assignee.user_id = $doctor_id
                    AND YEAR(request.request_datetime) >= 2016";
        if (!$hospital_id == 0) {
            $query .= " AND users_request.group_id = $hospital_id";
        }
        if (!$report_urgency == 0) {
            $query .= " AND request.report_urgency = '$report_urgency'";
        }
        $result = $this->db->query($query);
        
        return $result->result();
    }
    
    /**
     * Get Supplementary Data
     *
     * @param int $id
     * @return array
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
     * Display Related Posts
     *
     * @param [type] $record_id
     * @param [type] $nhs_no
     * @return array
     */
    public function related_posts_model($record_id, $nhs_no)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $related_posts_query = $this->db->query("SELECT * FROM request
                            WHERE request.nhs_number = '$nhs_no'
                            AND request.uralensis_request_id != $record_id
                            AND CHAR_LENGTH(request.nhs_number) > 3");
        
        return $related_posts_query->result();
    }
    
    /**
     * Previous Login Records
     *
     * @return array
     */
    public function previous_login_records()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $get_user_id = $this->ion_auth->user()->row()->id;
        
        $query = $this->db->query("SELECT AES_DECRYPT(email, '".DATA_KEY."') as email FROM users WHERE id=$get_user_id");
        $get_user_email = $query->result_array()[0]['email'];

        $query = $this->db->query("SELECT * FROM users_login_records
                    WHERE users_login_records.users_login_id = '$get_user_email'
                    ORDER BY users_login_records.ulr_id
                    DESC LIMIT 5");
        
        return $query->result();
    }
    
    /**
     * Get Cost Codes With Block Type
     *
     * @param int $hospital_id
     * @return array
     */
    public function get_cost_codes_by_block($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // uralensis_cost_codes.ura_cost_code_hospital_id = $hospital_id
                //AND
        $query = $this->db->query("SELECT * FROM uralensis_cost_codes
                WHERE ura_cost_code_type = 'block'");
        
        return $query->result();
    }
    
    /**
     * Get Code Codes
     *
     * @param int $hospital_id
     * @return array
     */
    public function get_cost_codes($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
  $query = $this->db->query("SELECT * FROM uralensis_cost_codes WHERE ura_cost_code_hospital_id = '$hospital_id' and ura_cost_code_type != 'block'");
        
        return $query->result();
    }
    
    /**
     * Get Education Categories
     *
     * @return array
     */
    public function get_education_cases_model()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        // $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats
        //             WHERE uralensis_teach_mdt_cats.ura_tech_mdt_type = 'teaching'");
        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats");
        return $query->result();
    }
    public function get_education_cases_model_updated()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats");
        
        return $query->result();
    }
    
    /**
     * Get MDT Categories
     *
     * @param int $hospital_group_id
     * @return array
     */
    public function get_mdt_cases_model($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($hospital_group_id)) {
            $sql = "SELECT * FROM uralensis_mdt_dates
            WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
            AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d')  >= CURDATE()
            ORDER BY uralensis_mdt_dates.ura_mdt_timestamp ASC
            LIMIT 50";
            $query = $this->db->query($sql)->result();
        }
        
        return $query;
    }
    
    /**
     * Get All MDT Dates
     *
     * @param int $hospital_group_id
     * @return void
     */
    public function get_all_mdt_dates($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($hospital_group_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_mdt_dates
            WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
            AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') >= CURDATE() ORDER BY uralensis_mdt_dates.ura_mdt_timestamp")->result();
        }
        
        return $query;
    }
    
    /**
     * Get MDT Dates Based on MDT List
     *
     * @param int $list_id
     * @param int $hospital_id
     * @return array
     */
    public function get_all_mdt_dates_based_on_list($list_id, $hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_mdt_dates
            INNER JOIN request
            INNER JOIN uralensis_mdt_records
            WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_id
            AND request.mdt_list_id = $list_id
            AND request.uralensis_request_id = uralensis_mdt_records.record_id
            AND request.mdt_list_id = uralensis_mdt_records.mdt_list_id
            AND uralensis_mdt_records.mdt_date = DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d')
            AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') >= CURDATE() 
            GROUP BY uralensis_mdt_dates.ura_mdt_date_id
            ORDER BY uralensis_mdt_dates.ura_mdt_timestamp";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Get all MDT dates
     *
     * @param int $list_id
     * @param int $hospital_id
     * @return array
     */
    public function get_all_mdt_dates_based_on_list_new($list_id, $hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_mdt_dates
            INNER JOIN request
            INNER JOIN uralensis_mdt_records
            WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_id
            AND request.mdt_list_id = $list_id
            AND request.uralensis_request_id = uralensis_mdt_records.record_id
            AND request.mdt_list_id = uralensis_mdt_records.mdt_list_id
            AND uralensis_mdt_records.mdt_date = DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d')
            AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') >= CURDATE() 
            GROUP BY uralensis_mdt_dates.ura_mdt_date_id
            ORDER BY uralensis_mdt_dates.ura_mdt_timestamp";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Get MDT Categories
     *
     * @param int $hospital_group_id
     * @return array
     */
    public function get_previous_all_mdt_dates($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_mdt_dates
        WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') <= CURDATE() ORDER BY uralensis_mdt_dates.ura_mdt_timestamp";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Archived MDT Dates
     *
     * @param int $list_id
     * @param int $hospital_group_id
     * @return void
     */
    public function get_previous_all_mdt_dates_based_on_list($list_id, $hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_mdt_dates
        INNER JOIN request
        WHERE uralensis_mdt_dates.ura_mdt_hospital_id = $hospital_group_id
        AND request.mdt_list_id = $list_id
        AND request.mdt_case = DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d')
        AND DATE_FORMAT(FROM_UNIXTIME(uralensis_mdt_dates.ura_mdt_timestamp), '%Y-%m-%d') <= CURDATE() 
        GROUP BY uralensis_mdt_dates.ura_mdt_date_id ORDER BY uralensis_mdt_dates.ura_mdt_timestamp";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Get CPC Categories
     *
     * @return void
     */
    public function get_cpc_cases_model()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM uralensis_teach_mdt_cats
                    WHERE uralensis_teach_mdt_cats.ura_tech_mdt_type = 'cpc'");
        
        return $query->result();
    }
    
    /**
     * Get Message Users
     *
     * @param [type] $doctor_id
     * @return void
     */
    public function get_message_users($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT users.id, users.username, users.first_name, users.last_name FROM users
                    WHERE users.id != $doctor_id");
        
        return $query->result();
    }
    
    /**
     * Get Unread Messages
     *
     * @param int $doctor_id
     * @return void
     */
    public function get_total_unread_msg($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM privmsgs_to
                                WHERE privmsgs_to.pmto_read = 0 
                                AND privmsgs_to.pmto_recipient = $doctor_id");
        
        return $query->result();
    }
    
    /**
     * Display Messages
     *
     * @param int $doctor_id
     * @param string $type
     * @return array
     */
    public function display_doctor_msg_model($doctor_id, $type)
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
                $this->db->where('pmto_recipient', $doctor_id);
                $this->db->where('pmto_deleted', 1);
                $this->db->or_where('privmsg_author', $doctor_id);
                $this->db->where('privmsg_deleted', 1);
                break;
            case 'inbox':
                $this->db->where('pmto_recipient', $doctor_id);
                $this->db->where('pmto_deleted', 0);
                break;
            // Message type SENT
            case 'sent':
                $this->db->where('privmsg_author', $doctor_id);
                $this->db->where('privmsg_deleted', 0);
                break;
            // Message type RECEIVED OR SENT (deleted or not, sent to or by this user)
            default:
                $this->db->where('pmto_recipient', $doctor_id);
                $this->db->where('privmsg_author', $doctor_id);
                break;
        }
        $this->db->join($t2, 'pmto_message' . ' = ' . 'privmsg_id');
        $this->db->group_by('privmsg_id'); // To get only distinct messages
        $q = $this->db->get();
        
        return $data = $q->result();
    }
    
    /**
     * Display Messages with message id
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
     * Get the Record From Request Viewed Table
     *
     * @param int $record_id
     * @return void
     */
    public function get_request_viewed_record($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request_viewed WHERE request_viewed.request_viewed_id = $record_id");
        
        return $query->result_array();
    }
    
    /**
     * Get Doctors List
     *
     * @return void
     */
    public function list_doctors()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users
                    WHERE users.user_type = 'D'
                    AND users.id != $doctor_id");
        
        return $query->result();
    }
    
    /**
     * Get Review Cases Model
     *
     * @param int $doctor_id
     * @return void
     */
    public function doctor_review_case_model($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request
            INNER JOIN request_assignee
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request_assignee.user_id = $doctor_id
            AND request.specimen_publish_status = 1
            AND request.supplementary_review_status = 'true'");
        
        return $query->result();
    }
    
    /**
     * Get Clinician Requesting Work and dermatology Surgeon
     *
     * @param int $hospital_id
     * @param string $type
     * @return void
     */
    public function get_clinician_name($db_value){
        $user_data = $this->db->select('id, username, first_name, last_name')
            ->get_where('users', ['id' => $db_value])
            ->row_array();
    }

    public function get_clinician_and_derm(
        $hospital_id = '',
        $type = '',
        $db_value = ''
    ) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $result = '';
        
           
           
            $user_data = $this->db->select('id, username, first_name, last_name')
                                  ->where('user_type', 'C')                                 
                                  ->get('users')
                                  ->result_array();
								  
            $user_result = $user_data;
            if (!empty($user_result)) {
                foreach ($user_result as $key => $value) {
                    $select = '';
                    if ($value['id'] === $db_value) {
                        $select = 'selected';
                    }
                    $result .= '<option ' . $select . ' value="' . $value['id'] . '">' . uralensisGetUsername($value['id'], 'fullname') . '</option>';
                }
            }
        
        
        return $result;
    }
	
	
	public function get_pathologist(
        $hospital_id = '',
        $type = '',
        $db_value = ''
    ) {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $result = '';
        
           
           
            $user_data = $this->db->select('id, username, first_name, last_name')
                                  ->where('user_type', 'D')
                                  //->where('surgeon_clinician_hos_group_id', $hospital_id)
                                  ->get('users')
                                  ->result_array();
								  
            $user_result = $user_data;
            if (!empty($user_result)) {
                foreach ($user_result as $key => $value) {
                    $select = '';
                    if ($value['id'] === $db_value) {
                        $select = 'selected';
                    }
                    $result .= '<option ' . $select . ' value="' . $value['id'] . '">' . uralensisGetUsername($value['id'], 'fullname') . '</option>';
                }
            }
        
        
        return $result;
    }
    
    /**
     * Get Record Flag Comments From Flag Comments Table
     *
     * @param int $doctor_id
     * @param int $record_id
     * @return void
     */
    public function get_flag_commnets_record($doctor_id, $record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT ufc.ufc_id, ufc.ufc_record_id, ufc.ufc_comments, ufc.ufc_user_id, ufc.ufc_timestamp FROM request
            INNER JOIN request_assignee
            INNER JOIN uralensis_flag_comments AS ufc
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request_assignee.user_id = $doctor_id
            AND ufc.ufc_record_id = request.uralensis_request_id
            AND request.uralensis_request_id = $record_id ORDER BY ufc.ufc_id DESC
            ");
        
        return $query->result();
    }
    
    /**
     * Microscopic Codes
     *
     * @return void
     */
    public function micro_codes_records_model()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT umc.umc_title, umc.umc_micro_desc, umc.umc_disgnosis, umc.umc_snomed_t_code,
        umc.umc_snomed_m_code, umc.umc_snomed_p_code, umc.umc_classification, umc.umc_cancer_register, umc.umc_rcpath_score
        FROM uralensis_micro_codes AS umc ORDER BY umc.umc_code ASC");
        
        return $query->result_array();
    }
    
    /**
     * Find the Microscopic record based on Micro Code.
     *
     * @param string $micro_code
     * @return void
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
     * User Record Edit Status
     *
     * @param int $record_id
     * @return void
     */
    public function get_one_user_record_edit_status($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_record_edit_status AS ures WHERE ures.record_id_for_edit = $record_id ORDER BY ures.ura_rec_edit_status_id DESC LIMIT 1";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Get User record edit status
     *
     * @param int $record_id
     * @return void
     */
    public function get_user_record_edit_status($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_record_edit_status AS ures WHERE ures.record_id_for_edit = $record_id ORDER BY ures.ura_rec_edit_status_id DESC";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Display Authorization Queue Data
     *
     * @param int $doctor_id
     * @return void
     */
    public function display_auth_queue_record_model($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM request
            INNER JOIN request_assignee
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request_assignee.user_id = $doctor_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' AND request.authorize_status = 'true'");
        
        return $query->result();
    }
    
    /**
     * Display Record Request Forms
     *
     * @param int $req_form_id
     * @return void
     */
    public function get_record_request_forms($req_form_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($req_form_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_clinic_date_requestform_uploads WHERE uralensis_clinic_date_requestform_uploads.ucd_requestform_upload_id = $req_form_id");
            
            return $query->result();
        }
    }
    
    /**
     * Display Opinion Cases
     *
     * @param int $doctor_id
     * @return void
     */
    public function display_opinion_cases($doctor_id, $opinion_status)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM request
            INNER JOIN uralensis_opinions
            INNER JOIN uralensis_opinion_recipient 
            INNER JOIN speciality_group ON request.speciality_group_id = speciality_group.spec_grp_id 
            WHERE request.uralensis_request_id = uralensis_opinions.ura_opinion_req_id
            AND uralensis_opinions.ura_opinion_id = uralensis_opinion_recipient.ura_opinion_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false'
            AND uralensis_opinion_recipient.recipient_id=$doctor_id ";
        $sql.=" AND uralensis_opinion_recipient.ura_rec_opinion_status != 'Declined'";
//        $sql.=" AND uralensis_opinions.ura_opinion_status = '$opinion_status'";
        $sql.=" GROUP BY uralensis_opinions.ura_opinion_id";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    /**
     * Display Opinion Cases
     *
     * @param int $doctor_id
     * @return void
     */
    public function display_opinion_cases_requested($doctor_id, $opinion_status)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM request
            INNER JOIN uralensis_opinions
            INNER JOIN uralensis_opinion_recipient
            INNER JOIN speciality_group ON request.speciality_group_id = speciality_group.spec_grp_id 
            WHERE request.uralensis_request_id = uralensis_opinions.ura_opinion_req_id
            AND uralensis_opinions.ura_opinion_id = uralensis_opinion_recipient.ura_opinion_id
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false'
            AND uralensis_opinions.ura_opinion_doctor_id=$doctor_id 
            AND uralensis_opinions.ura_opinion_parent_id=0 ";
//        $sql.=" AND uralensis_opinion_recipient.ura_rec_opinion_status != 'Declined'";
//        $sql.=" AND uralensis_opinions.ura_opinion_status = '$opinion_status'";
        $sql.=" GROUP BY uralensis_opinions.ura_opinion_req_id";
//        echo $sql; exit;
        $query = $this->db->query($sql);

        return $query->result();
    }

    /**
     * Display Opinion Cases + Doctors
     *
     * @param int $doctor_id
     * @return void
     */
    public function opinion_requested_doctors_list($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $result = array();
        $response = array();
        $sql = "SELECT * FROM uralensis_opinions
            INNER JOIN uralensis_opinion_recipient ON uralensis_opinions.ura_opinion_id = uralensis_opinion_recipient.ura_opinion_id
            WHERE uralensis_opinions.ura_opinion_doctor_id=$doctor_id
            AND uralensis_opinions.ura_opinion_parent_id=0 
            GROUP BY uralensis_opinion_recipient.recipient_id ";
//        echo $sql; exit;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $user_id_in = "";
        if(!empty($result)){
            foreach ($result as $key=>$value){
                $user_id_in.=$value['recipient_id'].",";
            }
            $user_id_in = rtrim($user_id_in, ',');
            $query2 = $this->db->query("SELECT profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username FROM users
                    WHERE users.user_type = 'D'
                    AND users.id IN($user_id_in)");
            $response = $query2->result();
        }
        return $response;
    }

    public function get_all_doctors_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query2 = $this->db->query("SELECT profile_picture_path, AES_DECRYPT(phone, '7kgtY3rYvbx6krm2HGiR') AS phone, AES_DECRYPT(company, '7kgtY3rYvbx6krm2HGiR') AS company, AES_DECRYPT( last_name, '7kgtY3rYvbx6krm2HGiR' ) AS last_name, AES_DECRYPT( first_name, '7kgtY3rYvbx6krm2HGiR' ) AS first_name, AES_DECRYPT(email, '7kgtY3rYvbx6krm2HGiR') AS email, users.id, AES_DECRYPT(username, '7kgtY3rYvbx6krm2HGiR') AS username FROM users JOIN users_groups ON users.id=users_groups.user_id join groups ON users_groups.group_id=groups.id WHERE groups.group_type = 'D' ");
        $response = $query2->result();
        return $response;
    }

    /**
     * Opinion Record Detail
     *
     * @param int $id
     * @return void
     */
    public function opinion_record_detail_model($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT * FROM request WHERE request.uralensis_request_id = $id");
        $session_data = array(
            'id' => $id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);
        
        return $query->result();
    }
    
    /**
     * Specimen Opinion Cases Detail
     *
     * @param int $id
     * @return void
     */
    public function opinion_record_detail_specimen($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT * FROM request INNER JOIN specimen WHERE request.uralensis_request_id = $id AND specimen.request_id = $id");
        $session_data = array(
            'id' => $id,
            'doctor_id' => $user_id
        );
        $this->session->set_userdata($session_data);
        
        return $query->result();
    }
    
    /**
     * Display Doctor Invoices Model
     *
     * @param int $doctor_id
     * @return void
     */
    public function display_invoices_model($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($doctor_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_doctor_invoice WHERE uralensis_doctor_invoice.ura_doc_id = $doctor_id ORDER  BY uralensis_doctor_invoice.ura_doc_invoice DESC")->result_array();
        }
        
        return $query;
    }
    
    /**
     * Get Opinion Comments Model
     *
     * @param int $record_id
     * @param int $doctor_id
     * @return void
     */
    public function get_opinion_comments($record_id, $doctor_id=FALSE)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_opinions AS opin
            INNER JOIN uralensis_opinion_recipient AS recp
            WHERE opin.ura_opinion_req_id = $record_id
            AND opin.ura_opinion_id = recp.ura_opinion_id
            AND opin.ura_opinion_parent_id = 0
            GROUP BY opin.ura_opinion_id";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Get Opinion Comments Model
     *
     * @param int $record_id
     * @param int $doctor_id
     * @return void
     */
    public function get_opinion_comments_reply($record_id, $doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_opinions AS opin
            INNER JOIN uralensis_opinion_recipient AS recp
            WHERE opin.ura_opinion_id = recp.ura_opinion_id
            AND opin.ura_opinion_req_id = $record_id
            AND opin.ura_opinion_parent_id = 1
            GROUP BY opin.ura_opinion_id";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function get_opinion_all_comments_reply($record_id, $doctor_id=FALSE)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_opinions AS opin
            INNER JOIN uralensis_opinion_recipient AS recp
            WHERE opin.ura_opinion_req_id = $record_id
            AND opin.ura_opinion_id = recp.ura_opinion_id
            AND opin.ura_opinion_parent_id = 0
            GROUP BY opin.ura_opinion_id";
        $query = $this->db->query($sql);

        $result1[] =  $query->row();

        $sql = "SELECT * FROM uralensis_opinions AS opin
            INNER JOIN uralensis_opinion_recipient AS recp
            WHERE opin.ura_opinion_id = recp.ura_opinion_id
            AND opin.ura_opinion_req_id = $record_id
            AND opin.ura_opinion_parent_id != 0
            GROUP BY opin.ura_opinion_id";
        $query = $this->db->query($sql);

        $result2 =  $query->result();

        $retData = array_merge($result1,$result2);
        return $retData;
    }

    /**
     * Display MDT Lists Model
     *
     * @param int $hospital_group_id
     * @return void
     */
    public function display_mdt_list_model($hospital_group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM uralensis_mdt_lists WHERE uralensis_mdt_lists.ura_mdt_list_hospital_id = '%" . $hospital_group_id . "%'  ORDER BY uralensis_mdt_lists.ura_mdt_list_id ASC";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Get Datasets Data
     *
     * @return void
     */
    public function get_datasets_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM uralensis_datasets AS ud ORDER BY ud.ura_datasets_id DESC");
        
        return $query->result();
    }
    
    /**
     * Get Datasets category Names
     *
     * @param int $dataset_id
     * @return void
     */
    public function get_datasets_category_names($dataset_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($dataset_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_dataset_cats AS udc WHERE udc.ura_dataset_parent_id = $dataset_id");
            
            return $query->result();
        }
    }
    
    /**
     * Get Datasets category Questions
     *
     * @param int $dataset_cat_id
     * @return void
     */
    public function get_datasets_category_questions_names($dataset_cat_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($dataset_cat_id)) {
            $query = $this->db->query("SELECT * FROM uralensis_datasets_questions AS udq WHERE udq.ura_datasets_category_id = $dataset_cat_id");
            
            return $query->result();
        }
    }
    
    /**
     * Get Answers Data based on question id.
     *
     * @param int $ques_id
     * @return void
     */
    public function get_datasets_category_questions_answer_data($ques_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($ques_id)) {
            $query = $this->db->query("SELECT ura_answer_text FROM uralensis_datasets_answers AS uda WHERE uda.ura_ans_ques_id = $ques_id");
            
            return $query->result();
        }
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

    public function get_record_block_history_data($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($record_id)) {
            $sql = "SELECT * FROM uralensis_block_history
                    WHERE uralensis_block_history.rec_history_record_id = $record_id
                    ORDER BY uralensis_block_history.ura_rec_history_id DESC";
            $query = $this->db->query($sql)->result_array();

            return $query;
        }
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
        $query = $this->db->query("SELECT * FROM `groups` WHERE groups.group_type = 'H'");
        
        return $query->result();
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
        $sql = "SELECT * FROM users WHERE users.user_type = 'D'";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    /**
     * Add Record Into DB
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
     * Get all track record templates.
     *
     * @param int $doctor_id
     * @return void
     */
    public function get_all_track_record_templates($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = array();
        if (!empty($doctor_id)) {
            return $query = $this->db->where('temp_assignee_id', $doctor_id)->get('uralensis_record_track_template')->result_array();
        }
    }
    
    /**
     * Display Records
     *
     * @param string $year
     * @param string $limit
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
     * Get hospital users by group id.
     *
     * @param int $group_id
     * @return void
     */
    public function get_all_hospital_users_by_group($group_id = '')
    {
        $query = array();
        if (!empty($group_id)) {
            $this->db->select('u.id, u.first_name, u.last_name');
            $this->db->from('groups AS g');
            $this->db->join('users_groups AS ug', 'g.id = ug.group_id', 'INNER');
            $this->db->join('users AS u', 'u.id = ug.user_id', 'INNER');
            $this->db->where('g.id', $group_id);
            $query = $this->db->get()->result_array();
        }
        
        return $query;
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
     * This Function return the number of rows that
     * how many files attahced to following record.
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
     * Get assignee doctor id
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
     * Get DB Assign records
     *
     * @param int $record_id
     * @return void
     */
    public function get_db_assign_dates($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($record_id)) {
            return $this->db->from('uralensis_mdt_records')->where('record_id', $record_id)->get()->result_array();
        }
    }
    
    /**
     * Get Record Download History
     *
     * @param int $record_id
     * @param int $doctor_id
     * @return void
     */
    public function getRecordDownloadHistory($record_id = '', $doctor_id = '')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($record_id) && !empty($doctor_id)) {
            return $this->db->from('uralensis_bulk_report_history')->where('ura_bulk_report_user_id', $doctor_id)->where('ura_bulk_report_record_data', $record_id)->order_by('ura_bulk_report_history', 'desc')->get()->result_array();
        }
    }
    
    /**
     * Get Specimen Data
     *
     * @param string $db_name
     * @return void
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
    
    /**
     * Display Further Work
     *
     * @return void
     */
    public function further_view()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query(
            "SELECT * FROM further_work
                    INNER JOIN request
                    INNER JOIN users
                    INNER JOIN request_assignee
                    INNER JOIN users_request
                    WHERE further_work.request_id = request.uralensis_request_id
                    AND request_assignee.user_id = further_work.doctor_id
                    AND further_work.doctor_id = users.id
                    AND users.id = $user_id
                    AND request_assignee.request_id = further_work.request_id
                    AND users_request.request_id = request.uralensis_request_id AND further_work.fw_status = 'requested'"
        );
        
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
     * Find Hospital Doctors
     *
     * @param [type] $hospital_id
     * @return void
     */
    public function find_hospital_doctors($hospital_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $result = array();
        if (!empty($hospital_id)) {
            $sql = "SELECT u.id FROM users AS u 
                INNER JOIN groups
                INNER JOIN users_request
                WHERE users_request.group_id = $hospital_id
                AND groups.id = users_request.group_id
                AND u.id = users_request.doctor_id
                GROUP BY users_request.doctor_id";
            $result = $this->db->query($sql)->result_array();
        }
        
        return $result;
    }
    
    /**
     * Get Other Doctor Records
     *
     * @return void
     */
    public function get_other_doctor_records($hospital_id, $doctor_ids, $selected_year)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $result = array();
        if (!empty($hospital_id) && !empty($doctor_ids)) {
            $this->db->select('*');
            $this->db->from('request');
            $this->db->join('request_assignee', 'request.uralensis_request_id = request_assignee.request_id', 'INNER');
            $this->db->join('users_request', 'request.uralensis_request_id = users_request.request_id', 'INNER');
            $this->db->where_in('request_assignee.user_id', $doctor_ids);
            $this->db->where('request.specimen_publish_status', '1');
            $this->db->where('YEAR(request_datetime)', $selected_year);
            $result = $this->db->get()->result_array();
        }
        
        return $result;
    }
    
    /**
     * Get Up Coming MDT Date
     */
    public function get_upcoming_mdt_date($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $result = array();
        $sql = "SELECT * FROM uralensis_mdt_dates umd
        WHERE STR_TO_DATE(FROM_UNIXTIME(umd.ura_mdt_timestamp), '%Y-%m-%d') > CURDATE()
        AND umd.ura_mdt_hospital_id = 7
        ORDER BY STR_TO_DATE(FROM_UNIXTIME(umd.ura_mdt_timestamp), '%Y-%m-%d')
        LIMIT 1";
        $result = $this->db->query($sql)->row_array();
        
        return $result;
    }

// ######### Doctors, TAT<10 graph Last 12 Months #############
    public function doctor_tat_last_12_month($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT DATE_FORMAT(rq.publish_datetime, '%Y-%m') as y_m, DATE_FORMAT(rq.publish_datetime, '%m/%y') as publish_month, 
            COUNT(rq.uralensis_request_id) as num_of_cases, 
            COUNT(IF(DATEDIFF(rq.publish_datetime, rq.date_taken)<=10,1,NULL)) AS tat_less_ten, 
            ROUND((COUNT(IF(DATEDIFF(rq.publish_datetime, rq.date_taken)<=10,1,NULL))/COUNT(rq.uralensis_request_id))*100,2) AS tat_less_ten_percent,
            ROUND((90/100)*COUNT(rq.uralensis_request_id),2) AS target_less_ten  
            FROM request rq
            INNER JOIN request_assignee ra ON rq.uralensis_request_id = ra.request_id
            WHERE ra.user_id = $doctor_id
            AND (DATE_FORMAT(rq.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 12 MONTH), '%Y%m') 
            AND DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y%m'))
            GROUP BY DATE_FORMAT(rq.publish_datetime, '%Y%m')
            ORDER BY DATE_FORMAT(rq.publish_datetime, '%Y%m') ");

        return $query->result();
    }


// ######### Doctors, TAT Patients Month Details #############
    public function doctor_tat_month_detail($doctor_id, $report_month)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT rq.serial_number, rq.pci_number, CONCAT(rq.f_name,' ', rq.sur_name) AS patient_name, rq.lab_number, rq.nhs_number,
            rq.dob, rq.age, rq.gender, (SELECT AES_DECRYPT(users.first_name, '" . DATA_KEY . "') FROM users WHERE users.id = rq.clrk) AS clinician, DATE_FORMAT(rq.date_taken, '%d-%m-%Y') AS date_taken, 
            DATE_FORMAT(rq.date_received_bylab, '%d-%m-%Y') AS date_received_by_lab, 
            DATE_FORMAT(rq.publish_datetime, '%d-%m-%Y') AS publish_date, DATE_FORMAT(rq.date_rec_by_doctor,'%d-%m-%Y') AS date_rec_by_doctor, 
            CONCAT(AES_DECRYPT(usr.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(usr.last_name, '" . DATA_KEY . "')) AS doctor_name,
            DATEDIFF(rq.publish_datetime, rq.date_taken) as tat_days
            FROM request rq
            INNER JOIN request_assignee ra ON rq.uralensis_request_id = ra.request_id
            INNER JOIN users usr ON usr.id = ra.user_id
            WHERE ra.user_id = $doctor_id
            AND DATE_FORMAT(rq.publish_datetime, '%m-%y') = '$report_month'
            ORDER BY rq.publish_datetime";
//        return $sql;
        $query = $this->db->query($sql);

        return $query->result();
    }


// ######### Doctors, TAT<10 graph Last 12 Months #############
    public function doctor_avg_tat_by_period($doctor_id, $interval)
    {
        $interval = (int) $interval;
        $avg_divisor=$interval*30;
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT DATE_FORMAT(rq.publish_datetime, '%m/%y') AS publish_month, 
            DATE_FORMAT(CURDATE(),'%m/%y') AS curr_month,
            DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL $interval MONTH), '%m/%y') AS last_month, 
            COUNT(rq.uralensis_request_id) AS num_of_cases, 
            ROUND((COUNT(rq.uralensis_request_id)/$avg_divisor),0) AS avg_tat
            FROM request rq
            INNER JOIN request_assignee ra ON rq.uralensis_request_id = ra.request_id
            WHERE ra.user_id = $doctor_id
            AND (DATE_FORMAT(rq.publish_datetime, '%Y%m') BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL $interval MONTH), '%Y%m') 
            AND DATE_FORMAT(CURDATE(), '%Y%m'))
            ORDER BY DATE_FORMAT(rq.publish_datetime, '%Y%m') ");

        return $query->result()[0];
    }


    public function tat_doctor_record_list($doctor_id, $filter)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM request
            INNER JOIN request_assignee
            LEFT JOIN uralensis_batches ON uralensis_batches.ura_batches_id = request.record_batch_id
            LEFT JOIN uralensis_courier ON uralensis_courier.ura_courier_id = uralensis_batches.ura_batches_id
            WHERE request.uralensis_request_id = request_assignee.request_id
            AND request_assignee.user_id = $doctor_id ";
        $sql .= $filter;
//        $sql .= "AND request.specimen_publish_status = 0
//            AND request.supplementary_review_status = 'false'";
//        if($month){
//            $sql .= " AND DATE_FORMAT(request.publish_datetime, '%m/%y') = '$month' ";
//        }
//        echo $sql; exit;=
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_user_type($user_id) {
        // A - Admin
        // D - Pathologist
        // H - Hospital
        // C - Clinicia
        // CS - Cancer Service
        // S - Secratary
        // R - Requestor
        // NULL - User type not found
        $res = $this->db->query("SELECT `group_type` FROM `users` 
        INNER JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id`
        INNER JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
        WHERE `users`.`id` = $user_id")->result_array();
        if (count($res) == 0) {
            return NULL;
        }else {
            return $res[0]['group_type'];
        }
    }

    public function is_request_assigned_doctor($user_id, $request_id) {
        $res = $this->db->query(
            "SELECT * FROM `request_assignee` WHERE `user_id` = $user_id AND `request_id` = $request_id"
        )->result_array();
       
        if (count($res) == 0) {
            return False;
        }
        else{
            return True;
        }
    }

    public function is_opinion_assigned_doctor($user_id, $request_id) {
        $res = $this->db->query(
            "SELECT * FROM `uralensis_opinions` INNER JOIN uralensis_opinion_recipient ON 
            uralensis_opinions.ura_opinion_id = uralensis_opinion_recipient.ura_opinion_id 
            WHERE uralensis_opinions.ura_opinion_req_id = $request_id AND uralensis_opinion_recipient.recipient_id = $user_id"
        )->result_array();
        if (count($res) == 0) {
            return False;
        }
        else{
            return True;
        }
    }

    public function add_download_log($log_data)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('report_download_logs', $log_data);
        return true;
    }

    /**
     * Get Doctors Data
     *
     * @return void
     */
    public function get_doctors_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT AES_DECRYPT(phone, '".DATA_KEY."') AS phone,AES_DECRYPT(company, '".DATA_KEY."') AS company,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, AES_DECRYPT(email, '".DATA_KEY."') AS email, id,AES_DECRYPT(username, '".DATA_KEY."') AS username, profile_picture_path as profile_pic FROM users WHERE users.user_type = 'D'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_upload_doc_forms()
    {
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

//        $group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $this->db->select("uralensis_upload_forms.*,groups.name as group_name,AES_DECRYPT(users.last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(users.first_name, '" . DATA_KEY . "') AS first_name, groups.name as group_name");
        $this->db->from('uralensis_upload_forms');
        $this->db->join('users', 'users.id = uralensis_upload_forms.uploaded_by', 'INNER');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->where_in('users.id', $user_ids);
        $this->db->where_in('uralensis_upload_forms.assign_to', ['','Pathologist','All']);
        return $query = $this->db->get()->result();
    }

    /**
     * Get Doctors Data
     *
     * @return void
     */
    public function get_doctor_files()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $sql = "SELECT files.files_id, files.title, files.file_name, files.file_path, files.file_tag, files.record_id, DATE_FORMAT(files.upload_date, '%d-%m-%Y') AS upload_date, 
                files.user_id, CONCAT(AES_DECRYPT(users.first_name, '".DATA_KEY."'),' ', AES_DECRYPT(users.last_name, '".DATA_KEY."')) AS uploaded_by
                FROM files 
                INNER JOIN request_assignee ra ON ra.request_id = files.record_id
                INNER JOIN users ON users.id = files.user_id
                WHERE files.file_tag='file' AND files.user_id = $doctor_id";
        $query = $this->db->query($sql);
        return $query->result();
    }


    /**
     * Get Unpublished records stats
     *
     */
    public function dr_dash_unpublished_stats($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT rq.uralensis_request_id,rq.f_name, rq.nhs_number, specimen.speciality_id, specialties.specialty, 
            DATE_FORMAT(rq.date_taken, '%d/%m/%Y') as cur_date, 
            CONCAT(`groups`.`first_initial`,`groups`.`last_initial`) as hospital, 
            rq.hospital_group_id, rq.report_urgency,rq.specimen_publish_status, rq.report_scanned 
            FROM request rq 
            INNER JOIN `request_specimen` ON `rs_request_id` = `rq`.`uralensis_request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
            INNER JOIN `users_request` ON `users_request`.`request_id` = `rq`.`uralensis_request_id`
			INNER JOIN `specialties` ON `specialties`.`id` = specimen.speciality_id           
            INNER JOIN `groups` ON `groups`.`id` = users_request.group_id
            WHERE users_request.doctor_id=$doctor_id             
            AND rq.specimen_publish_status=0
             GROUP BY rq.hospital_group_id";
        // echo $sql; exit();
        $res = $this->db->query($sql);
		
		
        if ($res->num_rows() > 0) 
		{
            $response =  $res->result_array();
            $speciality = array();
            $new_stat = array();
            foreach ($response as $key=>$value){
                $new_stat[$value['specialty']][] =$value;
            }

            $urgen_type =array();
            $stats_unpublished =array();
            foreach($new_stat as $key=>$value)
			{
                $speciality_name = $key;
                $urgent_sc = 0;
                $routine_sc = 0;
                $tww_sc = 0;
                $urgent_usc = 0;
                $routine_usc = 0;
                $tww_usc = 0;
                $stat = array();
                foreach ($value as $k=>$v)
				{
//                    $urgen_type[$value['report_urgency']][] = $v;

                    $stat['cur_date'] = $v['cur_date'];
                    $stat['speciality_id'] = $v['speciality_id'];
                    $stat['specialty'] = $v['specialty'];
                    $stat['hospital'] = $v['hospital']." ";
                    $stat['hospital_id'] = $v['hospital_group_id'];
                    if($v['report_scanned']==1){
                        if($v['report_urgency']==URGENT) {
                            $urgent_sc = $urgent_sc+1;
                        }if($v['report_urgency']==ROUTINE){
                            $routine_sc = $routine_sc+1;
                        }if($v['report_urgency']==TWW){
                            $tww_sc = $tww_sc+1;
                        }
                    }else{
                        if($v['report_urgency']==URGENT) {
                            $urgent_usc = $urgent_usc+1;
                        }if($v['report_urgency']==ROUTINE){
                            $routine_usc = $routine_usc+1;
                        }if($v['report_urgency']==TWW){
                            $tww_usc = $tww_usc+1;
                        }
                    }
                    $stat['animal_id'] = $nhs_number;
					$stat['urgent_scanned'] = $urgent_sc;
                    $stat['tww_scanned'] = $tww_sc;
                    $stat['routine_scanned'] = $routine_sc;
                    $stat['urgent_unscanned'] = $urgent_usc;
                    $stat['tww_unscanned'] = $tww_usc;
                    $stat['routine_unscanned'] = $routine_usc;
                    $stat['specialty_sc_total'] = $urgent_sc+$tww_sc+$routine_sc;
                    $stat['specialty_usc_total'] = $urgent_usc+$tww_usc+$routine_usc;

                    $stats_unpublished[] = $stat;
                }
                //$stats_unpublished[] = $stat;
            }
            $response = $stats_unpublished;
           // echo '<pre>'; print_r($stats_unpublished);
			//echo '</pre>';
            //echo "<pre>"; print_r($new_stat); exit;
        } else {
            $response = array();
        }
        return $response;

    }

    public function dr_dash_unpublished_stats_new($doctor_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "Select CONCAT(groups.first_initial,groups.last_initial) as hospital, sum(if(rq.report_scanned = '0', 1, 0)) as not_scanned, sum(if(rq.report_scanned = '1', 1, 0)) as scanned 
        FROM request rq  
        INNER JOIN request_assignee  rq_as on rq.uralensis_request_id = rq_as.request_id 
        LEFT JOIN groups ON groups.id = rq.hospital_group_id 
        WHERE rq_as.user_id=".$doctor_id." AND rq.specimen_publish_status=0 
        GROUP BY rq.hospital_group_id";
        $res = $this->db->query($sql);
        return $res->result_array();
        /*$sql = "SELECT rq.uralensis_request_id,rq.f_name, rq.nhs_number, specimen.speciality_id, GROUP_CONCAT(specialties.specialty separator ', ') as specialty, 
            DATE_FORMAT(rq.date_taken, '%d/%m/%Y') as cur_date, 
            CONCAT(`groups`.`first_initial`,`groups`.`last_initial`) as hospital, 
            rq.hospital_group_id, rq.report_urgency,rq.specimen_publish_status, rq.report_scanned 
            FROM request rq 
            LEFT JOIN `request_specimen` ON `rs_request_id` = `rq`.`uralensis_request_id`
            LEFT JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
            LEFT JOIN `users_request` ON `users_request`.`request_id` = `rq`.`uralensis_request_id`
			LEFT JOIN `specialties` ON `specialties`.`id` = specimen.speciality_id           
            LEFT JOIN `groups` ON `groups`.`id` = users_request.group_id
            WHERE users_request.doctor_id=$doctor_id             
            AND rq.specimen_publish_status=0
             GROUP BY rq.hospital_group_id";        
        // echo $sql; exit(); 
        $res = $this->db->query($sql);


        if ($res->num_rows() > 0)
        {
            $response =  $res->result_array();            
            $speciality = array();
            $new_stat = array();
            foreach ($response as $key=>$value){
                $new_stat[$value['specialty']][] =$value;
            }            
            $urgen_type =array();
            $stats_unpublished =array();
            foreach($new_stat as $key=>$value)
            {
                $speciality_name = $key;
                $urgent_sc = 0;
                $routine_sc = 0;
                $tww_sc = 0;
                $urgent_usc = 0;
                $routine_usc = 0;
                $tww_usc = 0;
                $stat = array();
                foreach ($value as $k=>$v)
                {                    
//                    $urgen_type[$value['report_urgency']][] = $v;

                    $stat['cur_date'] = $v['cur_date'];
                    $stat['speciality_id'] = $v['speciality_id'];
                    $stat['specialty'] = $v['specialty'];
                    $stat['hospital'] = $v['hospital']." ";
                    $stat['hospital_id'] = $v['hospital_group_id'];
                    if($v['report_scanned']==1){
                        if($v['report_urgency']==URGENT) {
                            $urgent_sc = $urgent_sc+1;
                        }if($v['report_urgency']==ROUTINE){
                            $routine_sc = $routine_sc+1;
                        }if($v['report_urgency']==TWW){
                            $tww_sc = $tww_sc+1;
                        }
                    }else{
                        if($v['report_urgency']==URGENT) {
                            $urgent_usc = $urgent_usc+1;
                        }if($v['report_urgency']==ROUTINE){
                            $routine_usc = $routine_usc+1;
                        }if($v['report_urgency']==TWW){
                            $tww_usc = $tww_usc+1;
                        }
                    }
                    $stat['animal_id'] = $nhs_number;
                    $stat['urgent_scanned'] = $urgent_sc;
                    $stat['tww_scanned'] = $tww_sc;
                    $stat['routine_scanned'] = $routine_sc;
                    $stat['urgent_unscanned'] = $urgent_usc;
                    $stat['tww_unscanned'] = $tww_usc;
                    $stat['routine_unscanned'] = $routine_usc;
                    $stat['specialty_sc_total'] = $urgent_sc+$tww_sc+$routine_sc;
                    $stat['specialty_usc_total'] = $urgent_usc+$tww_usc+$routine_usc;

                    $stats_unpublished[] = $stat;
                }
                //$stats_unpublished[] = $stat;
            }
            $response = $stats_unpublished;
            // echo '<pre>'; print_r($stats_unpublished);
            //echo '</pre>';
            //echo "<pre>"; print_r($new_stat); exit;
        } else {
            $response = array();
        }
        return $response;*/

    }

    /**
     * Get Published records stats
     *
     */
    public function dr_dash_published_stats($doctor_id, $period)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $period = (int) $period;

        $sql = "SELECT rq.uralensis_request_id, specimen.speciality_id, specialties.specialty, DATE_FORMAT(rq.publish_datetime, '%d/%m/%Y') as cur_date,
            CONCAT(`groups`.`first_initial`,`groups`.`last_initial`) as hospital, rq.report_urgency,rq.specimen_publish_status, rq.report_scanned 
            FROM request rq 
            INNER JOIN `request_specimen` ON `rs_request_id` = `rq`.`uralensis_request_id`
            INNER JOIN `specimen` ON `specimen`.`specimen_id` = `request_specimen`.`rs_specimen_id` 
            INNER JOIN `users_request` ON `users_request`.`request_id` = `rq`.`uralensis_request_id`
            INNER JOIN `specialties` ON `specialties`.`id` = specimen.speciality_id
            INNER JOIN `groups` ON `groups`.`id` = users_request.group_id
            WHERE users_request.doctor_id=$doctor_id 
            AND (DATE_FORMAT(rq.publish_datetime, '%Y%m%d') BETWEEN 
            DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL $period DAY), '%Y%m%d') 
            AND DATE_FORMAT(CURDATE(), '%Y%m%d')) 
            AND rq.specimen_publish_status=1 
             GROUP BY rq.uralensis_request_id";
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $response =  $res->result_array();
            $speciality = array();
            $new_stat = array();

            foreach ($response as $key=>$value){
                $new_stat[$value['specialty']][] =$value;
            }

            $urgen_type =array();
            $stats_published =array();
            foreach ($new_stat as $key=>$value){
                $speciality_name = $key;
                $urgent_sc = 0;
                $routine_sc = 0;
                $tww_sc = 0;
                $stat = array();
                foreach ($value as $k=>$v){
//                    $urgen_type[$value['report_urgency']][] = $v;

                    $stat['cur_date'] = $v['cur_date'];
                    $stat['speciality_id'] = $v['speciality_id'];
                    $stat['specialty'] = $v['specialty'];
                    $stat['hospital'] = $v['hospital'];
                    if($v['report_urgency']==URGENT) {
                        $urgent_sc = $urgent_sc+1;
                    }if($v['report_urgency']==ROUTINE){
                        $routine_sc = $routine_sc+1;
                    }if($v['report_urgency']==TWW){
                        $tww_sc = $tww_sc+1;
                    }
                    $stat['urgent_scanned'] = $urgent_sc;
                    $stat['tww_scanned'] = $tww_sc;
                    $stat['routine_scanned'] = $routine_sc;
                    $stat['specialty_sc_total'] = $urgent_sc+$tww_sc+$routine_sc;
                }
                $stats_published[] = $stat;
            }
            $response = $stats_published;
//            echo '<pre>'; print_r($stats_unpublished); exit;
//            echo "<pre>"; print_r($new_stat); exit;
        } else {
            $response = array();
        }
        return $response;

    }

    /**
     * Get Specialties list
     *
     */
    public function get_specialties($filter='')
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM specialties WHERE 1=1 ";
        if($filter !=''){
            $sql.= $filter;
        }
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $response =  $res->result_array();
        } else {
            $response = array();
        }
        return $response;

    }

    /**
     * Get Autopsy Detail Row by ID
     *
     */
    public function get_autopsy_record_data($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM request_autopsy_detail WHERE request_id=$record_id";
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $response =  $res->row_array();
        } else {
            $response = array();
        }
        return $response;

    }

    /**
     * Get Virology Detail Row by ID
     *
     */
    public function get_virology_record_data($record_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $sql = "SELECT * FROM request_virology_detail WHERE request_id=$record_id";
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $response =  $res->row_array();
        } else {
            $response = array();
        }
        return $response;

    }

    public function get_user_full_name($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT CONCAT(AES_DECRYPT(usr.first_name, '" . DATA_KEY . "'),' ' ,AES_DECRYPT(usr.last_name, '" . DATA_KEY . "')) AS user_full_name  FROM users usr
		WHERE ".TF_USER_ID."=".$this->db->escape($id));

        $result =$query->row();
        //echo last_query();exit;
        $retval = $result->user_full_name;
        return $retval;
    }


    /**
     * Get User profile picture path
     *
     * @return void
     */
    public function get_profile_picture_path($user_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT id, profile_picture_path as profile_pic FROM users WHERE users.id = $user_id";
        $result = $this->db->query($sql)->row_array();
        $response = 0;
        if($result){
            $response = $result;
        }
        return $response;
    }



    /**
     * Update reporting doctors for this request ID
     *
     * @return void
     */
    public function update_reporting_doctors($request_id, $ap_relevant_doctors)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->trans_start();
        if(empty($ap_relevant_doctors)){
            $tables = array('request_reporting_assignee');
            $this->db->where('request_id', $request_id);
            $this->db->delete($tables);
        }else{
            $tables = array('request_reporting_assignee');
            $this->db->where('request_id', $request_id);
            $this->db->delete($tables);

            foreach ($ap_relevant_doctors as $res){
                $req_rep_data = array();
                $req_rep_data['request_id'] = $request_id;
                $req_rep_data['user_id'] = $res;
                $req_rep_data['is_reporting'] = 1;

                $this->db->insert('request_reporting_assignee', $req_rep_data);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            // generate an error... or use the log_message() function to log your error
            $return = FALSE;
        }
        else{
            $return = TRUE;
        }
        return $return;
    }

    /**
     * Get reporting doctors assigned to request
     *
     * @return void
     */
    public function get_reporting_doctors_by_request($request_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->select("rra.req_rep_id, rra.request_id, rra.user_id as doctor_id");
        $this->db->from('request_reporting_assignee rra');
        $this->db->where('rra.request_id', $request_id);
        return $query = $this->db->get()->result_array();
    }

    /**
     * Update Opinion Status
     *
     * @param int $opinion_id
     * @return void
     */
    public function update_opinion_status($opinion_id,$recipient_id, $opinion_status)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = FALSE;
        if (!empty($opinion_id)) {
            $query = $this->db->query("UPDATE uralensis_opinion_recipient SET ura_rec_opinion_status='$opinion_status' WHERE ura_opinion_id =$opinion_id AND recipient_id =$recipient_id");
        }

        return $query;
    }

    /**
     * Reject Opinion Request
     *
     * @param int $opinion_id
     * @return void
     */
    public function reject_opinion_request($opinion_id, $update_data)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = FALSE;
        if (!empty($opinion_id)) {
            $this->db->where('ura_opinion_id', $opinion_id);
            $this->db->update('uralensis_opinion_recipient', $update_data);
            $query = TRUE;
        }

        return $query;
    }

    /**
     * Opinion Request Details
     *
     * @param int $opinion_id
     * @return void
     */
    public function opinion_request_detail($opinion_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $doctor_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT uralensis_opinions.*,uralensis_opinion_recipient.*, 
        CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'),' ', AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) 
        AS recipient_name, DATE_FORMAT(uralensis_opinions.ura_opinion_last_date, '%d-%m-%Y') AS opinion_due_date
        FROM uralensis_opinions 
        INNER JOIN uralensis_opinion_recipient 
        ON uralensis_opinions.ura_opinion_id = uralensis_opinion_recipient.ura_opinion_id
        INNER JOIN users 
        ON  uralensis_opinion_recipient.recipient_id = users.id
        WHERE uralensis_opinions.ura_opinion_req_id = $opinion_id 
        AND uralensis_opinions.ura_opinion_doctor_id =$doctor_id");
//        echo $this->db->last_query(); exit;
        $result = $query->result_array();
        return $result;
    }

    public function add_specimen_block($specimen_block)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert_batch('specimen_blocks', $specimen_block);
    }

    public function add_further_work_detail($further_work_detail)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert_batch('further_work_detail', $further_work_detail);
    }

    public function add_specimen_slide($specimen_slide)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('specimen_slide', $specimen_slide);
    }

    public function specimen_block_list($id){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT block.block_no,specimen.specimen_id FROM specimen INNER JOIN specimen_blocks block on block.specimen_id=specimen.specimen_id AND specimen.request_id = $id GROUP BY block_no ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function check_specimen_block_list_exist($sid, $sno, $bno, $testname){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM specimen_blocks WHERE specimen_id = $sid AND specimen_no = '".$sno."' AND block_no = '".$bno."' AND name = '".$testname."' LIMIT 1";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function delete_specimen_block($sid, $sno, $bno, $testname)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "DELETE FROM specimen_blocks WHERE specimen_id = $sid AND specimen_no = '".$sno."' AND block_no = '".$bno."' AND name  NOT IN (".$testname.")";
        $query = $this->db->query($sql);
        return $query;
        
        // $this->db->insert_batch('specimen_blocks', $specimen_block);
    }

    public function specimen_block_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT block.*
                 FROM specimen
            INNER JOIN specimen_blocks block on block.specimen_id=specimen.specimen_id
            AND specimen.request_id = $id ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_specimen_block_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT block.*, GROUP_CONCAT(block.name) as test_names, GROUP_CONCAT(block.id) as test_ids 
                 FROM specimen
            INNER JOIN specimen_blocks block on block.specimen_id=specimen.specimen_id
            AND specimen.request_id = $id GROUP by block.specimen_id,block.block_no ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_logged_in_doctors()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT MAX(usertracking_activity.user_activity_login_time) AS latest_login, usertracking_activity.track_session_userid, 
                CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'), ' ', AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) AS doctor_name, 
                AES_DECRYPT(users.email, '" . DATA_KEY . "') AS email, `groups`.name as hospital_name, users.profile_picture_path
                FROM usertracking_activity
                INNER JOIN users ON users.id = usertracking_activity.track_session_userid
                INNER JOIN users_groups ON users_groups.user_id = usertracking_activity.track_session_userid 
                INNER JOIN `groups` ON `groups`.id = users_groups.institute_id 
                WHERE user_activity_logout_time IS NULL AND users.user_type = 'D'
                GROUP BY track_session_userid";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getUsersLogins($status = FALSE,$explodeDate=FALSE)
    {
        $doctor_id = $this->ion_auth->user()->row()->id;
        $this->db->select("userlogin_activity.*,profile_picture_path,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name");
        $this->db->order_by("login_time", "DESC");
        if (!$status) {
            $this->db->limit(5);
        }
        $this->db->join('users', 'users.id = userlogin_activity.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_activity.client_ip','LEFT');
        $this->db->where("users.id", $doctor_id);
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        }
        $get_data = $this->db->get("userlogin_activity");
        $get_data = $get_data->result();
        return $get_data;

    }

    public function getLoginDetail($userDetail = FALSE,$explodeDate=FALSE)
    {
        $doctor_id = $this->ion_auth->user()->row()->id;
        $this->db->select("userlogin_log.*,profile_picture_path,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name");
        $this->db->order_by("login_time", "DESC");
        $this->db->join('users', 'users.id = userlogin_log.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_log.client_ip','LEFT');
        $this->db->where('session_userid', $userDetail[0]);
        $this->db->where('client_ip', $userDetail[1]);
        $this->db->where('users.id', $doctor_id);
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        }
        $get_data = $this->db->get("userlogin_log");
        $get_data = $get_data->result();
        return $get_data;
    }
    
    public function getDetailsAgainstRequest($record_id){
        
        $query = "SELECT * FROM request WHERE uralensis_request_id = $record_id ";
        $result = $this->db->query($query)->result_array();
        return $result; 
    }
	
	public function getTestDetails($test_id)
	{
        
        $query = "SELECT * FROM laboratory_tests WHERE id = $record_id ";
        $result = $this->db->query($query)->result_array();
        return $result; 
    }

    public function getGroupNameById($group_id){
        $this->db->select('id, name, description');
        $this->db->from('groups');
        $this->db->where('id', $group_id);
        $result = $this->db->get()->row_array();
        $response = array();
        if(!empty($result)){
            $response = $result;
        }
        return $response;
    }

    public function select_where($select, $table, $where)
    {

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }



    /**
     * Display Opinion Cases
     *
     * @param int $dataset_type
     * @return void
     */
    public function display_dataset_cases($dataset_type)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT * FROM request
            INNER JOIN tbl_dataset_record tdr ON request.uralensis_request_id = tdr.record_id
            WHERE 1=1 
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' ";
        if(!empty($dataset_type)){
            $sql.=" AND tdr.dataset_type='$dataset_type'";
        }
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function display_dataset_cases_chart($datasetType,$reportranget)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $start_date = date("Y-m-d",strtotime($reportranget[0]));
        $end_date = date("Y-m-d",strtotime($reportranget[1]));
        $sql = "SELECT DATE_FORMAT(tdr.created_at, '%Y-%m-%d') AS y_m,td.dataset_code as dataset_type,count(tdr.dataset_record_id) as total_count,DATE(tdr.created_at) as record_date FROM request
            INNER JOIN tbl_dataset_record tdr ON request.uralensis_request_id = tdr.record_id
            INNER JOIN tbl_datasets td ON tdr.dataset_id = td.dataset_id
            WHERE 1=1 
            AND request.specimen_publish_status = 0
            AND request.supplementary_review_status = 'false' ";
        $sql.=" AND tdr.dataset_id='$datasetType'";
        $sql.=" AND DATE(tdr.created_at) BETWEEN '$start_date' AND '$end_date' GROUP BY y_m";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function display_record_cases_chart($datasetType,$reportranget)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $start_date = date("Y-m-d",strtotime($reportranget[0]));
        $end_date = date("Y-m-d",strtotime($reportranget[1]));
        $sql = "SELECT DATE_FORMAT(publish_datetime, '%Y-%m-%d') AS y_m,'$datasetType' as dataset_code, COUNT(`specimen`.`specimen_id`) AS total_count
                FROM `specimen`
                JOIN request ON `specimen`.`request_id` = request.uralensis_request_id
                WHERE DATE(publish_datetime) BETWEEN '$start_date' AND '$end_date'
                AND (specimen_snomed_m LIKE '%$datasetType%' OR specimen_snomed_p LIKE '%$datasetType%')
                ";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function display_record_cases_detail($datasetType,$start_date,$end_date)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
//        $start_date = date("Y-m-d",strtotime($reportranget[0]));
//        $end_date = date("Y-m-d",strtotime($reportranget[1]));
//        $sql = "SELECT DATE_FORMAT(publish_datetime, '%Y-%m-%d') AS y_m,'$datasetType' as dataset_code, COUNT(`specimen`.`specimen_id`) AS total_count
//                FROM `specimen`
//                JOIN request ON `specimen`.`request_id` = request.uralensis_request_id
//                WHERE DATE(publish_datetime) BETWEEN '$start_date' AND '$end_date'
//                AND (specimen_snomed_m LIKE '%$datasetType%' OR specimen_snomed_p LIKE '%$datasetType%')
//                ";
        $snomedcode_m = $snomedcode_p = "";
        $datasetDesc = $this->select_where(" usmdcode_code_desc,snomed_type ", "uralensis_snomed_codes", array("usmdcode_code"=>$datasetType))->row();

        if($datasetDesc->snomed_type=="m"){
            $snomedcode_m = $datasetDesc->usmdcode_code_desc;
        } else if($datasetDesc->snomed_type=="p"){
            $snomedcode_p = $datasetDesc->usmdcode_code_desc;
        }
        $sql = "SELECT rq.serial_number, rq.pci_number, CONCAT(rq.f_name,' ', rq.sur_name) AS patient_name, rq.lab_number, rq.nhs_number,
            rq.dob, rq.age, rq.gender, (SELECT AES_DECRYPT(users.first_name, '" . DATA_KEY . "') FROM users WHERE users.id = rq.clrk) AS clinician, DATE_FORMAT(rq.date_taken, '%d-%m-%Y') AS date_taken, 
            DATE_FORMAT(rq.date_received_bylab, '%d-%m-%Y') AS date_received_by_lab, '$snomedcode_m' as specimen_snomed_m,'$snomedcode_p' as specimen_snomed_p,
            DATE_FORMAT(rq.publish_datetime, '%d-%m-%Y') AS publish_date, DATE_FORMAT(rq.date_rec_by_doctor,'%d-%m-%Y') AS date_rec_by_doctor
            FROM request rq
            JOIN specimen ON `specimen`.`request_id` = rq.uralensis_request_id
            WHERE DATE(publish_datetime) BETWEEN '$start_date' AND '$end_date'
            AND (specimen_snomed_m LIKE '%$datasetType%' OR specimen_snomed_p LIKE '%$datasetType%')
            ORDER BY rq.publish_datetime";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function get_dataset_types(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT DISTINCT dataset_type FROM tbl_dataset_record";
        $query = $this->db->query($sql);
        $result =  $query->result_array();
        $response = array();
        if(!empty($result)){
            foreach ($result as $d_type){
                $response[] = $d_type['dataset_type'];
            }
        }
        return $response;
    }

    public function get_datasets(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $sql = "SELECT  dataset_id as id,groups.name as hospital_name,hospital_id,dataset_name,dataset_code,parent_dataset_id  FROM tbl_datasets join groups on tbl_datasets.hospital_id=groups.id";
        $query = $this->db->query($sql);
        $result =  $query->result();
        return $result;
    }

    public function getLabIdsFromUser($user_id){
        //$user_id = $this->ion_auth->user()->row()->id;
        $lab_ids = $this->db->select('institute_id as lab_id')
                            ->from('groups gr')                            
                            ->join('users_groups ugr', 'gr.id = ugr.institute_id', 'left')
                            ->where([
                                'gr.group_type' => 'L',
                                'ugr.user_id' => $user_id,
                                //'ugr.institute_id' => $user_id
                            ])
                            ->get()->row()->lab_id;
        return $lab_ids;
		
    }

    public function get_weekly_request($pathologist_id, $fdate, $tdate)
    {
        if($pathologist_id == 0){
            $user_id = $this->ion_auth->user()->row()->id;
            $hospital_id = $this->ion_auth->get_users_main_groups($user_id)->row()->id;
            $ids = $this->db->select("GROUP_CONCAT(user_id) as user_ids", FALSE)
                ->where('institute_id', $hospital_id)            
                ->get('users_groups')->row('user_ids');
        }else{
            $ids = $pathologist_id;
        }         
        $to_date = $tdate;
        $from_date = $fdate;
        $query = $this->db->select('AES_DECRYPT(u.first_name, "' . DATA_KEY . '") as first_name, AES_DECRYPT(u.last_name, "' . DATA_KEY . '") as last_name, date_format(rq.request_datetime, "%d %M %Y <br> %h:%i %p") as request_date, count(rq.uralensis_request_id) as request_count, rq_as.user_id, sum(if(rq.specimen_publish_status = 1, 1, 0)) as published, sum(if(rq.specimen_publish_status = 0, 1, 0)) as unpublished, , sum(if(rv.request_id > 1, 1, 0)) as request_viewed')
                ->join('request_assignee rq_as', 'rq_as.request_id = rq.uralensis_request_id', 'inner')
                ->join('request_viewers rv', 'rv.request_id = rq_as.request_id', 'left')
                ->join('users u', 'u.id = rq_as.user_id', 'inner')
                ->where('rq_as.assign_status = 1')
                ->where('date_format(rq.request_datetime, "%Y-%m-%d") >=', $from_date)
                ->where('date_format(rq.request_datetime, "%Y-%m-%d") <=', $to_date)
                ->where("u.id in (".$ids.")")
                //->where("u.user_type", "D")
                ->group_by('request_date, rq_as.user_id')
                ->order_by('request_date', 'DESC')
                ->get('request rq')->result_array();        
        //echo $this->db->last_query();exit;
        return $query;
    }   
}
