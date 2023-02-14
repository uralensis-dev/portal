<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Laboratory Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

Class Laboratory_model extends CI_Model 
{

    /**
     * Record Detail
     *
     * @param int $record_id
     * @param int $doctor_id
     * @return void
     */
    public function record_detail($record_id = '', $doctor_id = '') 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if(!empty($record_id) && !empty($doctor_id)){
            $query = $this->db->query(
                "SELECT * FROM request
                INNER JOIN users
                INNER JOIN request_assignee
                WHERE request.uralensis_request_id = $record_id
                AND request_assignee.request_id = $record_id
                AND request_assignee.user_id = $doctor_id
                AND users.id = $doctor_id
            ");
        }
        $session_data = array(
            'id' => $record_id,
            'doctor_id' => $doctor_id
        );
        $this->session->set_userdata($session_data);
        return $query->row_array();
    }

    /**
     * Record Detail Specimen
     *
     * @param int $record_id
     * @param int $doctor_id
     * @return void
     */
    public function record_detail_specimen($record_id = '', $doctor_id = '') 
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if(!empty($record_id) && !empty($doctor_id)){
            $query = $this->db->query(
                "SELECT * FROM specimen
                INNER JOIN users
                INNER JOIN request_assignee
                WHERE specimen.request_id = $record_id
                AND request_assignee.request_id = $record_id
                AND request_assignee.user_id = $doctor_id
                AND users.id = $doctor_id
            ");
        }
        $session_data = array(
            'id' => $record_id,
            'doctor_id' => $doctor_id
        );
        $this->session->set_userdata($session_data);
        return $query->result_array();
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
	
	
	    public function get_lab_team_count($laboratoryId)
    {
       $query = "select count(*) as team_count 
                  from users_groups hi 
                  join users on hi.user_id=users.id                  
                  where hi.institute_id=$laboratoryId and users.deleted=0";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * Get specialty data
     */
    public function get_speciality_group_data()
    {
        $speciality_group = $this->db->get('speciality_group')->result_array();

        return $speciality_group;
    }

    public function get_test_categories_data($level = ''){
        if($level != ''){
            $this->db->where('level', $level);
        }

        $test_categories = $this->db->get('Laboratory_test_categories')->result_array();

        return $test_categories;
    }

    /**
     * Start DataTable
     */
	 
public function get_laboratory_tests_data($start,$length)
	{
        if ($this->ion_auth->is_admin()) 
		{
            $this->_get_laboratory_test_query(FALSE,$start,$length);
        }
		else 
		{	 
	  	$this->db->select("*");
        $this->db->from('laboratory_tests');
        $this->db->where("lab_id=114");
        $this->db->order_by("lab_ref_name DESC");
        $result = $this->db->get()->row_array();
        if (empty($result)) {
            $retData['ref_name'] = $labInitial."-".str_pad(1, 4, "0", STR_PAD_LEFT); // 0010
        } else {
            $data = explode("-", $result['lab_ref_name']);
            $retData['ref_name'] = $labInitial."-".str_pad(++$data[1], 4, "0", STR_PAD_LEFT);
        }

		}
        return $result;
}
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function get_laboratory_test_data_ajax($start,$length)
	{
        if ($this->ion_auth->is_admin()) 
		{
            $this->_get_laboratory_test_query(FALSE,$start,$length);
        }
		else 
		{
            $group_row = $this->ion_auth->get_users_main_groups()->row();
            $group_id = $group_row->id;
            
            $this->_get_laboratory_test_query($group_id,$start,$length);
        }

        $this->db->limit($length, $start);
//        if($_POST['length'] != -1){
//            $this->db->limit($_POST['length'], $_POST['start']);
//        }
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    /*
     * Count all records
     */
    public function get_laboratory_test_count_all(){
        if ($this->ion_auth->is_admin())
        {
            $this->_get_laboratory_test_query(FALSE);
        }
        else
        {
            //$group_row = $this->ion_auth->get_users_groups()->row();
            $group_row = $this->ion_auth->get_users_main_groups()->row();
            $group_id = $group_row->id;

            $this->_get_laboratory_test_query($group_id);
        }

        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function get_laboratory_test_count_filtered($start,$length){
        if ($this->ion_auth->is_admin())
        {
            $this->_get_laboratory_test_query(FALSE);
        }
        else
        {
            //$group_row = $this->ion_auth->get_users_groups()->row();
            $group_row = $this->ion_auth->get_users_main_groups()->row();
            $group_id = $group_row->id;

            $this->_get_laboratory_test_query($group_id);
        }
        $this->db->limit($length, $start);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_laboratory_test_query($lab_id=FALSE)
	{
        $this->db->select("lt.id,g.id as group_id, lt.department_id,lt.specialty_id as speciality_group_id, lt.test_id, lt.name,lt.lab_ref_name,lt.category_id,lt.sub_category_id, lt.cost, lt.sale, lt.user_id, lt.created_at, DATE_FORMAT(lt.created_at,'%d-%m-%Y') as formated_date, lt.cost_code_id, lt.billing_code_id, GROUP_CONCAT(distinct dsl.specialty) as spec_grp_name, GROUP_CONCAT(distinct g.description) AS lab_name, lmc.name AS test_category, tsc.name AS test_sub_category,
        users.profile_picture_path, AES_DECRYPT(users.first_name, '" . DATA_KEY . "') as first_name, AES_DECRYPT(users.last_name, '" . DATA_KEY . "') as last_name,CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'), ' ',AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) as user_name");
        $this->db->from('laboratory_tests AS lt');
        $this->db->join('speciality_group AS sg', 'lt.speciality_group_id = sg.spec_grp_id');
        $this->db->join('lab_test AS lt1', 'lt.id = lt1.laboratory_test_id');
        $this->db->join('groups AS g', 'lt1.lab_id = g.id');
        $this->db->join('tests_main_categories lmc', 'lt.category_id = lmc.id','LEFT');
        $this->db->join('tests_sub_categories tsc', 'lt.sub_category_id = tsc.id','LEFT');
        $this->db->join('department_settings_labs dsl', 'lt.lab_id = dsl.hospital_id AND lt.specialty_id = dsl.specialty_id','LEFT');
//        $this->db->join('laboratory_test_hierarchy lth', 'lt.id = lth.laboratory_test_id');
//        $this->db->join('hospital_test_hierarchy hth', 'lth.hospital_test_hierarchy_id = hth.id','LEFT');
        $this->db->join('lab_test', 'lab_test.laboratory_test_id = lt.id');
        $this->db->join('users', 'users.id = lt.user_id');
        $this->db->group_by(['lt.id'], ['lt.speciality_id'], ['lt.test_id'], ['lt.name'], ['lt.cost'], ['lt.sale'], ['lt.user_id'], ['lt.created_at']);
        if ($lab_id) {
            $this->db->where('lt.lab_id', $lab_id);
        }
        if ($_POST['search']['value'] && !empty($_POST['search']['value'])) {
            $columnArr = ['lt.name', 'lt.test_id', 'lt.cost', 'lt.sale', 'lt.lab_ref_name', 'lmc.name', "CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'), ' ',AES_DECRYPT(users.last_name, '" . DATA_KEY . "'))"];
            $this->db->group_start();
            foreach ($columnArr as $column){
                $this->db->or_like($column, $_POST['search']['value']);
            }
            $this->db->group_end();
        }
		//echo $this->db->last_query(); exit; 
    }

    public function get_hospital_laboratory_test($lab_ids)
	{
        $this->db->select("lt.id,g.id as group_id, lt.department_id,lt.specialty_id as speciality_group_id, lt.test_id, lt.name,lt.lab_ref_name,lt.category_id,lt.sub_category_id, lt.cost, lt.sale, lt.user_id, lt.created_at, DATE_FORMAT(lt.created_at,'%d-%m-%Y') as formated_date, lt.cost_code_id, lt.billing_code_id, GROUP_CONCAT(distinct dsl.specialty) as spec_grp_name, GROUP_CONCAT(distinct g.description) AS lab_name, lmc.name AS test_category,
        users.profile_picture_path, AES_DECRYPT(users.first_name, '" . DATA_KEY . "') as first_name, AES_DECRYPT(users.last_name, '" . DATA_KEY . "') as last_name,CONCAT(AES_DECRYPT(users.first_name, '" . DATA_KEY . "'), ' ',AES_DECRYPT(users.last_name, '" . DATA_KEY . "')) as user_name");
        $this->db->from('laboratory_tests AS lt');
        $this->db->join('speciality_group AS sg', 'lt.speciality_group_id = sg.spec_grp_id');
        $this->db->join('lab_test AS lt1', 'lt.id = lt1.laboratory_test_id');
        $this->db->join('groups AS g', 'lt1.lab_id = g.id');
        $this->db->join('tests_main_categories lmc', 'lt.category_id = lmc.id','LEFT');
        $this->db->join('department_settings_labs dsl', 'lt.lab_id = dsl.hospital_id AND lt.specialty_id = dsl.specialty_id','LEFT');
//        $this->db->join('laboratory_test_hierarchy lth', 'lt.id = lth.laboratory_test_id');
//        $this->db->join('hospital_test_hierarchy hth', 'lth.hospital_test_hierarchy_id = hth.id','LEFT');
        $this->db->join('lab_test', 'lab_test.laboratory_test_id = lt.id');
        $this->db->join('users', 'users.id = lt.user_id');
       // $this->db->group_by(['lt.id'], ['lt.speciality_id'], ['lt.test_id'], ['lt.name'], ['lt.cost'], ['lt.sale'], ['lt.user_id'], ['lt.created_at']);
        $this->db->where("lt.lab_id IN ($lab_ids)");
        return $this->db->get()->result_array();
    }

    function lab_ref_test_no($labInitial)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $year = date('Y');
        $this->db->select("*");
        $this->db->from('laboratory_tests');
        $this->db->where("test_id LIKE '%$year-%'");
        $this->db->order_by("test_id DESC");
        $result = $this->db->get()->row_array();
        if (empty($result)) {
            $retData['test_id'] = $year."-".str_pad(1, 6, "0", STR_PAD_LEFT); // 0010
        } else {
            $data = explode("-", $result['test_id']);
            $retData['test_id'] = $year."-".str_pad(++$data[1], 6, "0", STR_PAD_LEFT);
        }


        $this->db->select("*");
        $this->db->from('laboratory_tests');
        $this->db->where("lab_ref_name LIKE '%$labInitial-%'");
        $this->db->order_by("lab_ref_name DESC");
        $result = $this->db->get()->row_array();
        if (empty($result)) {
            $retData['ref_name'] = $labInitial."-".str_pad(1, 4, "0", STR_PAD_LEFT); // 0010
        } else {
            $data = explode("-", $result['lab_ref_name']);
            $retData['ref_name'] = $labInitial."-".str_pad(++$data[1], 4, "0", STR_PAD_LEFT);
        }


        return $retData;
    }
	
// TODO- Is Table mentioned in From clause right?
    public function get_laboratory_test_hirarchy($parent_id, $level)
	{
        $this->db->select('id, parent_id, name, level, has_level');
        $this->db->from('hospital_test_hierarchy');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('level', $level);
        return $this->db->get()->result_array();
    }

    public function get_test_category_hirarchy_children($parent_id, $level){
        $data = [];
        $childrens = $this->get_laboratory_test_hirarchy($parent_id, ++$level);
        if(is_array($childrens) && !empty($childrens)){
            foreach ($childrens as $children){
                $data[]= [
                    'text' => $children['name'],
                    'nodes' => $this->get_test_category_hirarchy_children($children['id'], $children['level']),
                    'id' => $children['id'],
                    'parent_id' => $children['id'],
                    'level' => $children['level'],
                    'has_level' => $children['has_level'],
                ];
            }
        }else{
            return [];
        }
        return $data;
    }

    public function getCategoryTests ($test_category_id, $columns = []){
        if(empty($columns)){
            $this->db->select('*');
        }else{
            $this->db->select($columns);
        }
        $this->db->from('laboratory_tests AS lt');
        $this->db->join('laboratory_test_hierarchy lth', 'lt.id = lth.laboratory_test_id');
        $this->db->where('lth.hospital_test_hierarchy_id', $test_category_id);
        return $this->db->get()->result_array();

    }


    public function get_lab_name($lab_id) {
        $res = $this->db->get_where('groups', array('id' => $lab_id))->result_array();
        if (empty($res)) {
            throw new Exception("Lab not found", 404);
        }

        return $res[0];
    }

    public function getUsersLogins($status = FALSE,$explodeDate=FALSE)
    {
//      $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        $hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
        $this->db->select("userlogin_activity.*,profile_picture_path,AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name", FALSE);
        $this->db->join('users', 'users.id = users_groups.user_id');
        $this->db->join('userlogin_activity', 'users.id = userlogin_activity.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_activity.client_ip','LEFT');
        $this->db->where('institute_id', $hospital_id);
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        }
        if (!$status) {
            $this->db->limit(5);
        }
        $this->db->order_by("login_time", "DESC");
        $result = $this->db->get('users_groups')->result();
        return $result;

    }

    public function getLoginDetail($userDetail = FALSE,$explodeDate=FALSE)
    {
//        $hospital_id = $this->ion_auth->get_users_groups()->row()->id;
        $hospital_id = $this->ion_auth->get_user_group_type()->row()->id;
        $this->db->select("userlogin_log.*,profile_picture_path,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,users.is_hospital_admin,ip_location.country_name,ip_location.city,ip_location.region_name", FALSE);
        $this->db->join('users', 'users.id = users_groups.user_id');
        $this->db->join('userlogin_log', 'users.id = userlogin_log.session_userid');
        $this->db->join('ip_location', 'ip_location.ip_address = userlogin_log.client_ip','LEFT');
        $this->db->where('institute_id', $hospital_id);
        $this->db->where('session_userid', $userDetail[0]);
        $this->db->where('client_ip', $userDetail[1]);
        if($explodeDate){
            $this->db->where("login_time>=",strtotime(date("Y-m-d",strtotime($explodeDate[0]))." 00:00:01"));
            $this->db->where("login_time<=",strtotime(date("Y-m-d",strtotime($explodeDate[1]))." 23:59:59"));
        }
        $this->db->order_by("login_time", "DESC");
        $result = $this->db->get('users_groups')->result();
        return $result;
    }
    public function get_lab_information($group_id)
	{
        $this->db->select('*');
        $this->db->from('laboratory_information li');
        $this->db->join('groups gr', 'gr.id = li.group_id');
        $this->db->where('li.group_id', $group_id);
        $result = $this->db->get()->row_array();
        $response = array();
        if(!empty($result)){
            $response = $result;
        }
        return $response;
    }
	
	public function get_alllab_information($group_id)
	{	
	
		if($group_id>0)
		{
		$this->db->select('*');
        $this->db->from('laboratory_information li');
        $this->db->join('groups gr', 'gr.id = li.group_id');
		$this->db->join('users_groups ugr', 'gr.id = ugr.user_id');
        $this->db->where('gr.group_type', 'L');
		$this->db->where('ugr.institute_id', $group_id);
        $result = $this->db->get()->result_array();
        $response = array();
        if(!empty($result))
		{
            $response = $result;
        }
		}
		else 
		{		
		$this->db->select('*');
        $this->db->from('laboratory_information li');
        $this->db->join('groups gr', 'gr.id = li.group_id');
        $this->db->where('gr.group_type', 'L');
        $result = $this->db->get()->result_array();
        $response = array();
        if(!empty($result))
		{
            $response = $result;
        }
		}
        return $response;				
    }
	
		public function get_alllab_Hospitalinfo($group_id)
	{	        
		if($group_id>0)
		{
            
		$this->db->select('*, COUNT(p.id) as patient_count');
        $this->db->from('hospital_information li');
        $this->db->join('groups gr', 'gr.id = li.group_id');
		$this->db->join('hospital_group ugr', 'gr.id = ugr.hospital_id');
        $this->db->join('patients p', 'p.hospital_id=li.group_id', 'left');
        $this->db->where('gr.group_type', 'H');
		$this->db->where('ugr.group_id', $group_id);
        $this->db->group_by('li.hosp_id');
        $result = $this->db->get()->result_array();        
        $response = array();
        if(!empty($result))
		{
            $response = $result;
        }
		}
		else 
		{
            
		$this->db->select('*, COUNT(p.id) as patient_count');
        $this->db->from('hospital_information li');
        $this->db->join('groups gr', 'gr.id = li.group_id');
        $this->db->join('patients p', 'p.hospital_id=li.group_id', 'left');
        $this->db->where('gr.group_type', 'H');
        $this->db->group_by('li.hosp_id');
        $result = $this->db->get()->result_array();
        $response = array();
        if(!empty($result))
		{
            $response = $result;
        }
		}
        
        foreach ($response as $k=>$row){
            $subQuery = "select COUNT(uralensis_request_id) as request_count from request where request.hospital_group_id=".$row['group_id'];
            $subEmpQuery = "select COUNT(id) as emp_count from users_groups where users_groups.institute_id=".$row['group_id'];
            $response[$k]['request_count'] = $this->db->query($subQuery)->row()->request_count;
            $response[$k]['employee_count'] = $this->db->query($subEmpQuery)->row()->emp_count;
        }        
        return $response;				
    }
	

    public function update_lab_prefixes($update_data, $lab_id){
        if (!empty($lab_id)) {
            $this->db->where('lab_id', $lab_id);
            $this->db->update('laboratory_information', $update_data);
            $query = TRUE;
        }else{
            $query = FALSE;
        }
        return $query;
    }

    public function get_record_blocks($request_id){

        $this->db->select('sp.specimen_id, sp.request_id');
        $this->db->from('specimen sp');
        $this->db->where('sp.request_id', $request_id);
        $this->db->order_by('sp.specimen_id', 'ASC');
        $result_specimen = $this->db->get()->result_array();

        $response = array();
        if(!empty($result_specimen)){
            foreach ($result_specimen as $key=>$value){
                $specimen_id = $value['specimen_id'];
                $this->db->select('sp_bl.*');
                $this->db->from('specimen_blocks sp_bl');
                $this->db->where('sp_bl.specimen_id', $specimen_id);
                $this->db->order_by('sp_bl.id', 'ASC');
                $result_block_specimen = $this->db->get()->result_array();
                if(!empty($result_block_specimen)){
                    $result_specimen[$key]['blocks'] = $result_block_specimen;
                }else{
                    $result_specimen[$key]['blocks'] = array();
                }
            }
            $response = $result_specimen;
        }
        return $response;
    }
	
	
	public function get_lab_users($hospital_id = '', $group_id = '') {
        $lab_id = $this->ion_auth->get_users_main_groups()->row()->id;
        if($group_id != ''){
            $lab_id = $group_id;
        }
		$last_login_query = "(SELECT user_id, MAX(last_activity) as last_login_date FROM login_data group by user_id) lg";
        $request_query = "(SELECT request_add_user, count(request_add_user) as request_count FROM request group by request_add_user) rq";
        $courier_query = "(SELECT created_by, count(created_by) as courier_count FROM tbl_courier group by created_by) cr";
        $enq_query = "(SELECT ticket_created_by, count(ticket_created_by) as enq_count FROM lab_enquiries group by ticket_created_by) enq";
        $doc_query = "(SELECT uploaded_by, count(uploaded_by) as doc_count FROM uralensis_upload_forms group by uploaded_by) doc";
        $this->db->select("`users`.`id` as id, AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name, 
        AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name,profile_picture_path,last_login,users.user_type,AES_DECRYPT(company, '".DATA_KEY."') AS company,
        AES_DECRYPT(email, '".DATA_KEY."') AS email, users.active, aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone, users.in_directory, groups.description, groups.first_initial, groups.last_initial, users_groups.group_id, groups.group_type, groups.type_cate,
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
	
	public function save_lab_data($main_group_info, $hospital_info) {
        $group_id = $this->ion_auth->get_users_groups()->row()->id;
        $this->db->set($main_group_info);
        $this->db->where('id', $group_id);
        $this->db->update('`groups`');

        $this->db->select('*');
        $this->db->where('group_id', $group_id);
        $result = $this->db->get('laboratory_information')->result_array();
        if (empty($result)) {
            $hsopital_info['group_id'] = $group_id;
            $this->db->insert('laboratory_information', $hospital_info);
        }else {
            $this->db->set($hospital_info);
            $this->db->where('group_id', $group_id);
            $this->db->update('laboratory_information');
        }
    }

    public function save_lab_data_new($main_group_info, $hospital_info) {
        $group_id = $this->db->get_where('users_groups', ['user_id' => $this->ion_auth->user()->row()->id, 'institute_id >' => 0])->row()->institute_id;
        $this->db->update('groups', $main_group_info, ['id' => $group_id]);
        $whereArr = ['group_id' => $group_id];
        $count = $this->db->get_where('laboratory_information', $whereArr)->num_rows();
        if($count > 0){
            $this->db->update('laboratory_information', $hospital_info, $whereArr);
        }else{
            $this->db->insert('laboratory_information', $hospital_info);
        }
    }
	
public function get_cost_price($ids)
{
	if($ids!='')
	{
 	 $query = $this->db->query("SELECT SUM(ura_cost_code_price) as total_cost FROM `uralensis_cost_codes` WHERE ura_cost_code_id IN ($ids)")->result_array();	 
    // $result = $this->db->query($query)->result();
     return $query;
	}
	else
	{
		return 0;
	}
}

public function get_sale_price($ids)
{
	if($ids!='')
	{
 	 $query = $this->db->query("SELECT SUM(billing_rate) as total_sale FROM `uralensis_billing_code_setup` WHERE id IN ($ids)")->result_array();
     return $query;
	 }
	else
	{
		return 0;
	}
}

public function status_bar_result_count_published()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->ion_auth->user()->row()->id;        
        $labIdStr = $this->getLabIdsFromUser($user_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';

        $result = $this->db->query("SELECT * FROM request where specimen_publish_status = 1 and lab_id IN ($labIds)");
        /*AND users_request.users_id = $user_id*/
        return $result->num_rows();
    }
	
	public function status_bar_result_count_unpublished()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;        
        $labIdStr = $this->getLabIdsFromUser($user_id);
        $labIds = (!empty($labIdStr)) ? $labIdStr : '0';

        $result = $this->db->query("SELECT * FROM request where specimen_publish_status = 0 and lab_id IN ($labIds)");
        /*AND users_request.users_id = $user_id*/
        return $result->num_rows();
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
        $this->db->where_in('uralensis_upload_forms.assign_to', ['','Laboratory','All']);
        $this->db->group_by('uralensis_upload_forms.id');
        return $query = $this->db->get()->result();
    }

    public function get_lab_templates($user_id='') {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        //$group_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $this->db->select("lab_templates.*, tmc.name as category, gr.name as clinic, CONCAT(AES_DECRYPT(users.last_name, '" . DATA_KEY . "'), ' ' ,AES_DECRYPT(users.first_name, '" . DATA_KEY . "')) AS user_name");
        $this->db->from('lab_templates');
        $this->db->join('users', 'users.id = lab_templates.created_by', 'INNER');
        $this->db->join('tests_main_categories tmc', 'tmc.id = lab_templates.category_id', 'LEFT');
        $this->db->join('hospital_information li', 'li.hosp_id = lab_templates.hospital_id', 'LEFT');
        $this->db->join('groups gr', 'gr.id = li.group_id', 'LEFT');

        if(!empty($user_id)){
            $this->db->where('users.id', $user_id);
        }
        return $this->db->get()->result();
    }
	public function get_clinic($id){
        $this->db->select('gr.description as clinic_name, gr.first_initial, gr.last_initial, hi.hosp_address, hi.hosp_country, hi.hosp_city, hi.hosp_state, hi.hosp_post_code, hi.hosp_email, hi.site_identifier, hi.identifier, hi.hosp_phone, hi.hosp_mobile, hi.hosp_fax, hi.hosp_website, hi.group_id, hi.logo');
        $this->db->from('hospital_information hi');        
        $this->db->join('groups gr', 'gr.id = hi.group_id');
        //$this->db->join('hospital_group ugr', 'gr.id = ugr.hospital_id');
        // $this->db->join('patients p', 'p.hospital_id=li.group_id', 'left');
        $this->db->where('gr.group_type', 'H');
        $this->db->where('hi.hosp_id', $id);
        $query = $this->db->get();        
        return $query->row_array();
    }
    public function update_group($group_data, $group_id, $data, $id, $table){        
        $this->db->set($group_data);
        $this->db->where('id', $group_id);
        $this->db->limit('1');
        $this->db->update('groups');

        $this->db->set($data);
        if($table == 'hospital_information')
            $this->db->where('hosp_id', $id);
        else
            $this->db->where('lab_id', $id);
        $this->db->limit('1');
        $this->db->update($table);        
        return;
    }

    public function get_lab($id){        
        $this->db->select('gr.description as lab_name, gr.first_initial, gr.last_initial, li.lab_address, li.lab_country, li.lab_city, li.lab_state, li.lab_post_code, li.lab_email, li.site_identifier, li.identifier, li.lab_phone, li.lab_mobile, li.lab_fax, li.lab_website, li.group_id, li.logo');
        $this->db->from('laboratory_information li');
        $this->db->join('groups gr', 'gr.id = li.group_id');        
        $this->db->where('gr.group_type', L);
        $this->db->where('li.lab_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

}
