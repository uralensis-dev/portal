<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Doctor Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */
class Userextramodel extends CI_Model
{

    public function getuserId($email)
    {
        $query = $this->db->query("SELECT id FROM users WHERE email= AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "')");

        return $query->result();
    }

    public function getAllUserData($email)
    {
        $query = $this->db->query("SELECT memorable,password,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name  FROM users
                                WHERE email= AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "')");

        return $query->result_array();
    }

    public function getDataForSession($collumnName, $tableName, $identity)
    {
        $query = $this->db->query("SELECT AES_DECRYPT(" . $collumnName . ", '" . DATA_KEY . "') AS email, id, password, active, last_login, memorable,AES_DECRYPT(username, '" . DATA_KEY . "') AS username
          ,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name
          FROM users
                                WHERE " . $collumnName . "= AES_ENCRYPT(" . $this->db->escape($identity) . ", '" . DATA_KEY . "') order by id desc");

        return $query->row();
    }

    public function updateUserData($user_ip, $email)
    {
        $insert_user_status = array(
            'user_status' => 'true',
            'user_login_time' => date("Y-m-d H:i:s"),
            'user_logout_time' => '',
            'user_logged_ip' => $user_ip,
            'user_login_status' => 'true'
        );
        $this->db
            ->where("AES_DECRYPT(email, '" . DATA_KEY . "') = ", $email)
            ->update('users', $insert_user_status);
    }
	
	 public function display_doctor_only_hospitalsbyID($doc_id=false)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		if($doc_id!='')
		{
        
		
        $query = $this->db->query(
            "SELECT * FROM users_request
            INNER JOIN `groups`
            WHERE users_request.doctor_id = $doc_id
            AND `groups`.id = users_request.group_id
            AND `groups`.group_type = 'H'
            GROUP BY users_request.group_id"
        );
		
        
        return $query->result();
		}
		else
		{
		return 0;	
		}
    }

    public function UpdateBasicInfoUser($group_id, $memorable, $login_token, $userid, $first_name, $last_name, $company, $email, $phone, $profileimage = "", $update_profile = '', $is_hospital_admin = '', $status = 0)
    {
        $h_admin = $is_hospital_admin ? 1 : 0;
        $sql = "UPDATE users SET ";
        $sql .= "user_type=" . $this->db->escape($group_id) . ",";
        $sql .= "memorable=" . $this->db->escape($memorable) . ",";
        $sql .= "status=" . $this->db->escape($status) . ",";
        $sql .= "login_token=" . $this->db->escape($login_token) . ",";
        $sql .= "is_hospital_admin=" . $h_admin . ",";
        $sql .= "first_name=AES_ENCRYPT(" . $this->db->escape($first_name) . ", '" . DATA_KEY . "' ),";
        $sql .= "email=AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "' ),";
        if ($update_profile) {
            $sql .= "profile_picture_path='$profileimage', ";
        }
        $sql .= "last_name=AES_ENCRYPT(" . $this->db->escape($last_name) . ", '" . DATA_KEY . "' ),";
        $sql .= "company=AES_ENCRYPT(" . $this->db->escape($company) . ", '" . DATA_KEY . "' ), phone=AES_ENCRYPT(" . $this->db->escape($phone) . ", '" . DATA_KEY . "' )  WHERE id= " . $userid;
        $this->db->query($sql);

        $groups = $this->db->get_where('groups', array('id' => $group_id))->num_rows();
        if ($groups > 0) {
            $this->db->where('user_id', $userid)
                ->update('users_groups', array('group_id' => $group_id));
        }

    }

    public function UpdateUserProfile($userid, $profileimage = "")
    {
        $query = $this->db->query("UPDATE users SET 
        profile_picture_path = '" . $profileimage . "'  WHERE id= " . $this->db->escape($userid));
    }

    public function getCountOfUserGroups($institute_id, $type)
    {
        $query = $this->db->query("SELECT COUNT(*) AS TOTROWS,`groups`.`group_type` FROM `users_groups` INNER JOIN `groups` on `groups`.id=users_groups.group_id WHERE users_groups.institute_id=" . $institute_id . " AND `groups`.`group_type`='" . $type . "' GROUP BY `groups`.id");
        return $query->result_array();
    }

    public function getHospitalAdmin($institute_id, $type)
    {
        $this->db->select('user_id');
        $this->db->from('users_groups');
        $this->db->where('group_id', $institute_id);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) === 0) {
            return array();
        }
        $user_id = $result[0];
        // TODO: Only select is_hospital_admin
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function isHospitalAdmin()
    {
        $userid = $this->ion_auth->user()->row()->id;

        $this->db->select('users_groups.user_id, users_groups.group_id');
        $this->db->from('users_groups');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->where('users_groups.user_id', $userid);
        $this->db->where('groups.group_type', 'H');
        $query = $this->db->get();

        $result = $query->result_array();
        $response = array();
        if (count($result) === 0) {
            return $response;
        } else {
            $response = $result[0];
        }
        return $response;
    }

    public function updategroupID($userid, $group_type, $institute = array())
    {
        $delete = "DELETE FROM users_groups WHERE user_id=" . $this->db->escape($userid);
        $deleteresult = $this->db->query($delete);

        if (count($institute) > 0) {
            foreach ($institute as $rec) {
                $insert = "INSERT INTO users_groups(user_id,group_id,institute_id) VALUES(" . $this->db->escape($userid) . "," . $group_type . "," . $rec . ") ";
                $insert1 = $this->db->query($insert);
            }
        }
        return true;
        exit;
    }

    public function updateHospitalfordoctor($userid, $hospital, $group_type)
    {
        $select = $this->db->query("SELECT COUNT(*) AS TOTROWS FROM users_groups_type WHERE user_id=" . $this->db->escape($userid));
        $selectResults = $select->row();

        if ($selectResults->TOTROWS > 0) {
            $delete = "DELETE FROM users_groups_type WHERE user_id=" . $this->db->escape($userid);
            $deleteresult = $this->db->query($delete);
            if ($deleteresult) {
                foreach ($hospital as $rows) {
                    $insert = "INSERT INTO users_groups_type(user_id,group_id,group_type) VALUES(" . $this->db->escape($userid) . "," . $rows . "," . $this->db->escape($group_type) . ") ";
                    $insert1 = $this->db->query($insert);
                }
            }
        } else {
            foreach ($hospital as $rows) {
                $insert = "INSERT INTO users_groups_type(user_id,group_id,group_type) VALUES(" . $this->db->escape($userid) . "," . $rows . "," . $this->db->escape($group_type) . ") ";
                $insert1 = $this->db->query($insert);
            }
        }

        return true;
        exit;
    }

    public function UpdateBasicInfoUserDoctor($memorable, $userid, $email, $username, $first_name, $last_name, $company, $phone)
    {
        $query = $this->db->query("UPDATE users SET 
        memorable=" . $this->db->escape($memorable) . ",
        first_name=AES_ENCRYPT(" . $this->db->escape($first_name) . ", '" . DATA_KEY . "' ),
        last_name=AES_ENCRYPT(" . $this->db->escape($last_name) . ", '" . DATA_KEY . "' ),
        company=AES_ENCRYPT(" . $this->db->escape($company) . ", '" . DATA_KEY . "' ),phone=AES_ENCRYPT(" . $this->db->escape($phone) . ", '" . DATA_KEY . "' )
        ,email=AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "' )
        ,username=AES_ENCRYPT(" . $this->db->escape($username) . ", '" . DATA_KEY . "' )
        WHERE id= " . $this->db->escape($userid));


        return TRUE;
    }

    public function getAllPathologist($group_id=""){
        $where = "";
        if (!empty($group_id)){
            $where .= "Where group_id='$group_id'";
        }
        $query = "SELECT
                    aes_decrypt(users.username, '" . DATA_KEY . "') AS enc_username,
                    aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
                    aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
                    aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
                    aes_decrypt(users.company, '" . DATA_KEY . "') AS enc_company,
                    aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone
                FROM users 
                LEFT JOIN users_groups ON users_groups.user_id = users.id
                LEFT JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
                $where 
                GROUP BY users.id";

        $res = $this->db->query($query);
        return $res->result();
    }
    public function getAllusersForadmin($group_id = "", $name = "", $status = "", $selectuserlist = "")
    {
        if ($selectuserlist != "") {
            $where = "where users.id IN(" . $selectuserlist . ")";
        } else {
            $where = "where users.id=users.id";
        }
//        $where .= " AND users.deleted=0";
        if ($name != "" && $name != NULL) {

            $where .= " AND users.first_name= AES_ENCRYPT(" . $this->db->escape($name) . ", '" . DATA_KEY . "') OR users.last_name= AES_ENCRYPT(" . $this->db->escape($name) . ", '" . DATA_KEY . "')";
        }
        if ($status != "" && $status != NULL && $status != "Select Status") {
            $where .= " AND users.active=" . $status;
        }

        if ($group_id != "") {
            $where .= " AND group_id='" . $group_id . "'";
        }

        $where .= " AND users.deleted=0";

        $query = "SELECT
        aes_decrypt(users.username, '" . DATA_KEY . "') AS enc_username,
        aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
        aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
        aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
        aes_decrypt(users.company, '" . DATA_KEY . "') AS enc_company,
        aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone,
        is_hospital_admin,
        users.active,
        users.in_directory,
        count(login_attempts.id) as wrong_attempt,
        users.id as user_id,users.status as user_status,
        active, profile_picture_path,
        group_id,
        `groups`.`description` as `description`,
        `groups`.`group_type` as `group_type`,
        `groups`.`first_initial`,
        `groups`.`last_initial`,
        `groups`.`type_cate`
        FROM users
        LEFT JOIN login_attempts ON login_attempts.login = aes_decrypt(users.email, '" . DATA_KEY . "')
        INNER JOIN users_groups ON users_groups.user_id = users.id
        INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
        " . $where ."
        GROUP BY users.id";

        $dataquery = $this->db->query($query);                
        return $dataquery->result();
    }

    public function getAllusersForadmin2($group_id=""){
            $where = 'WHERE user_type = "D"';

            if($group_id != ""){
                //$where .= " AND group_id='$group_id'";
            }

            $query = "SELECT
            aes_decrypt(users.username, '" . DATA_KEY . "') AS enc_username,
            aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
            aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
            aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
            aes_decrypt(users.company, '" . DATA_KEY . "') AS enc_company,
            aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone,
            is_hospital_admin,
            users.active,
            users.in_directory,
            users.id as user_id,users.status as user_status,
            users.fee_per_case, users.fee_per_specimen,
            active, profile_picture_path,
            group_id,
            `groups`.`description` as `description`,
            `groups`.`group_type` as `group_type`,
            `groups`.`first_initial`,
            `groups`.`last_initial`,
            `groups`.`type_cate`
            FROM users
            INNER JOIN users_groups ON users_groups.user_id = users.id
            INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
            " . $where ."
            GROUP BY users.id";

            $dataquery = $this->db->query($query);
            return $dataquery->result();
        }


    public function getAllusersForadminList($group_id = "", $name = "", $status = "", $selectuserlist = "")
    {
        if ($selectuserlist != "") {
            $where = "where users.id IN(" . $selectuserlist . ")";
        } else {
            $where = "where users.id=users.id";
        }
//        $where .= " AND users.deleted=0";
        if ($name != "" && $name != NULL) {

            $where .= " AND users.first_name= AES_ENCRYPT(" . $this->db->escape($name) . ", '" . DATA_KEY . "') OR users.last_name= AES_ENCRYPT(" . $this->db->escape($name) . ", '" . DATA_KEY . "')";
        }
        if ($status != "" && $status != NULL && $status != "Select Status") {
            $where .= " AND users.active=" . $status;
        }

        if ($group_id != "") {
            $where .= " AND group_type='" . $group_id . "'";
        }

        $query =
            "SELECT
        aes_decrypt(users.username, '" . DATA_KEY . "') AS enc_username,
        aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
        aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
        aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name,
        aes_decrypt(users.company, '" . DATA_KEY . "') AS enc_company,
        aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone,
        is_hospital_admin,
        users.id as user_id,users.status as user_status,
        active, profile_picture_path,
        group_id,
        `groups`.`description` as `description`,
        `groups`.`group_type` as `group_type`,
        `groups`.`first_initial`,
        `groups`.`last_initial`,
        `groups`.`type_cate`
        FROM users
        INNER JOIN users_groups ON users_groups.user_id = users.id
        INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
        " . $where;
        $dataquery = $this->db->query($query);

        return $dataquery->result();
    }

    public function get_user_hospitals_ids($user_id)
    {
        $query = "SELECT `groups`.id FROM `groups` WHERE `groups`.group_type = 'H' AND 
                `groups`.id IN (SELECT IF(ug.group_id IS NULL, ug.institute_id, ug.group_id) AS group_id 
                FROM users_groups ug WHERE ug.user_id =$user_id)";
        $dataquery = $this->db->query($query);
        $response = $dataquery->result_array();
        $return_result = array();
        if (!empty($response)) {
            foreach ($response as $key => $value) {
                $return_result[] = $value['id'];
            }
        }
        return $return_result;
    }

    public function getUserDecryptedDetailsByid($id)
    {
        $query = $this->db->query("SELECT  division_id,department_id,category_id,speciality_id,is_hospital_admin,profile_picture_path,AES_DECRYPT(phone, '" . DATA_KEY . "') AS phone,AES_DECRYPT(company, '" . DATA_KEY . "') AS company,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name, AES_DECRYPT(email, '" . DATA_KEY . "') AS email, id,AES_DECRYPT(username, '" . DATA_KEY . "') AS username, login_token, fee_per_case, fee_per_specimen, clinic_id FROM users
                                WHERE id=" . $this->db->escape($id));
        return $query->row();
    }


    public function getassociatedhostpitals($id)
    {
        $query = $this->db->query("SELECT  AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(username, '" . DATA_KEY . "') AS username  FROM users INNER JOIN users_groups_type ON users_groups_type.group_id=users.id
                                WHERE users_groups_type.user_id=" . $this->db->escape($id));
        return $query->result();
    }

    /**
     * Display Hospital List
     *
     */
    public function display_hospitals_list()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $getChild = getRecords("id", "groups", array("group_type" => "H"));
        $getchild = getRecords("GROUP_CONCAT(group_type) AS groupstype", "groups", array("parent_id" => $getChild[0]->id));

        $user_id = $this->ion_auth->user()->row()->id;
        $query = $this->db->query("SELECT id,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name,AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name FROM `users` WHERE users.user_type IN('H','" . $getchild[0]->groupstype . "')");
        return $query->result();
    }

    public function UpdateProfilePicture($userid, $profile_picture)
    {
        $query = $this->db->query("UPDATE users SET
         profile_picture_path=" . $this->db->escape($profile_picture) . "
          WHERE id= " . $this->db->escape($userid));
        return TRUE;
    }

    public function getRemainingAttempts($identity)
    {
        $query = $this->db->query("SELECT COUNT(id) as attempts_done FROM login_attempts WHERE login = '$identity'");
        return $query->row();
    }

    //  Add notification to system_notifications table, to be shown by each user
    public function add_notification($data = array())
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->db->insert('system_notifications', $data);
        return true;
    }

    /**
     * Find the Hospital record based on Group ID.
     *
     * @param string $group_id
     */
    public function populate_hospital_data($group_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $query = $this->db->query("SELECT * FROM groups 
                LEFT JOIN hospital_information ON groups.id = hospital_information.group_id
                WHERE groups.id = $group_id");

        return $query->result_array();
    }

    /**
     * Find the Hospital record based on Group ID.
     *
     * @param string $role_id
     */
    public function save_hospital_info($role_id, $data)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT * FROM hospital_information WHERE hospital_information.group_id = $role_id");
        $result = $query->row_array();
        if ($result) {
            // ************* Update Record *************
            $this->db->where('group_id', $role_id);
            $this->db->update('hospital_information', $data);
            return "Data updated successfully";
        } else {
            // ************* Insert Record *************
            $this->db->insert('hospital_information', $data);
            return "Data inserted successfully";
        }
    }

    /**
     * Generates a user id as PatientInitalsDBID (padded to 4 digits)
     *
     * @param int DB Id of the user
     */
    public function generate_userid($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->select("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name");
        $this->db->select("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name");
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) == 0) {
            return NULL;
        }
        $result = $result[0];
        $first_initial = 'F';
        $last_initial = 'L';
        if (strlen($result['first_name']) > 0) {
            $first_initial = strtoupper($result['first_name'])[0];
        }

        if (strlen($result['last_name']) > 0) {
            $last_initial = strtoupper($result['last_name'])[0];
        }
        $g_user_id = $first_initial . $last_initial . date("y") . "-" . sprintf("%05d", $id);
        return $g_user_id;
    }

    public function getAllAdminUser()
    {
        $this->db->select("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name");
        $this->db->select("AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name");
        $this->db->select("profile_picture_path");
        $this->db->select("users.id");
        $this->db->from('users');
        $this->db->join("users_groups", "users_groups.user_id = users.id");
        $this->db->where("group_id", 1);
        $temp = $this->db->get()->result_array();
        for ($i = 0; $i < count($temp); $i++) {
            $temp[$i]['profile_picture'] = get_profile_picture($temp[$i]['profile_picture_path'], $temp[$i]['first_name'], $temp[$i]['last_name']);
        }
        return $temp;
    }

    public function addRecord($table, $recordArray)
    {
        if (!empty($recordArray)) {
            $this->db->trans_begin();
            $this->db->insert($this->db->dbprefix . $table, $recordArray);
            $last_insert_id = $this->db->insert_id();
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $last_insert_id;
            }
        }
    }

    public function addBatchRecord($table, $recordArray)
    {
        if (!empty($recordArray)) {
            $this->db->trans_begin();
            $this->db->insert_batch($table, $recordArray);
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
    }

    public function updateTable($table, $data, $where)
    {
        $this->db->where($where);
        $status = $this->db->update($table, $data);
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($table, $where)
    {
        $status = $this->db->delete($table, $where);
        if ($status)
            return true;
        else
            return false;
    }

    public function getURLData()
    {
        $this->db->select("url_management.*,modules.name as module_name");
        $this->db->from("url_management");
        $this->db->join("modules", "url_management.module_id=modules.id", 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getModuleData()
    {
        $this->db->select("*");
        $this->db->from("modules");
        $query = $this->db->get();
        return $query->result();
    }

    public function checkUserRememberToken($user_id)
    {
        $this->load->helper("activity_helper");
        $userIp = getRealIpAddr();
        $current_date = date("Y-m-d");
        $this->db->select("*");
        $this->db->from("user_remember_pc");
        $this->db->where("user_id", $user_id);
        $this->db->where("remember_token_date >=", $current_date);
        $this->db->where("client_ip =", $userIp);
        $this->db->where("remember_token_date IS NOT NULL");
        $query = $this->db->get();        
        $result = $query->result();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserIPToken($user_id)
    {
        $this->load->helper("activity_helper");
        $userIp = getRealIpAddr();
        $current_date = date("Y-m-d");
        $this->db->select("*");
        $this->db->from("user_remember_pc");
        $this->db->where("user_id", $user_id);
        $this->db->where("client_ip =", $userIp);
        $query = $this->db->get();
        $result = $query->result();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserProfileByAdmin($user_id, $profileimage, $update_profile, $status)
    {
        // echo '<pre>'; print_r($this->input->post()); //exit;

        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $memorable = $this->input->post('memorable');
        $company = $this->input->post('company');
        $fee_per_case = $this->input->post('fee_per_case');
        $fee_per_specimen = $this->input->post('fee_per_specimen');
        $login_token = $this->input->post('login_token');


        $user_type = "";
        $main_group_id = $this->input->post('select_roles');
        $member_of_group_id = $this->input->post('group_id');
        // $institute_ids = $this->input->post('clinic_id');
        $institute_ids = $this->input->post('child_user_group');
        // $institute_ids = $this->input->post('child_user_group');
//        $member_of_child_groups = $this->input->post('child_user_group');
        $pathologist_child_groups = $this->input->post('child_pathologist_user_group');
        $manager_pathologists = $this->input->post('manager_pathologist');
        $clinic_id = $this->input->post('clinic_id');
        $user_role = $this->input->post('user_role');
        $existing_user_role = $this->input->post('existing_user_role');

        if($main_group_id==92){
            $sub_role=$this->input->post('user_sub_role');
        } else {
            $sub_role = 'NULL';
        }

//        $main_group_id = "";
//        $institute_ids = "";
        $reporting_to_ids = "";

//------------------- Check if Edited user group is Admin/Network Admin -------------
//        if(sizeof($member_of_group_id) >=1 && empty($member_of_child_groups) && !($this->input->post('child_pathologist_user_group')) && !($this->input->post('manager_pathologist'))){
//            echo "Its Super Admin/Network Admin";
//            remove all institute ids if exist, remove all manager pathologist entries if exist
//            $main_group_id = $member_of_group_id[0];
//        }

//------------------- Check if Edited user group is Admin/Network Admin -------------
//------------------- Check if Edited user group is Pathologist ---------------------
//        if(sizeof($member_of_group_id) >0 && !empty($member_of_child_groups) && $this->input->post('child_pathologist_user_group') && !($this->input->post('manager_pathologist'))){
//            echo "Its Pathologist";
//            remove all institute ids if exist, remove all manager pathologist entries if exist
//            $main_group_id = $pathologist_child_groups;
//            $institute_ids = $member_of_group_id;
//        }
//------------------- Check if Edited user group is Pathologist ---------------------
//------------------- Check if Edited user group is Lab related or hospital related other than pathologist ------------------
//        if(sizeof($member_of_group_id) >0 && !empty($member_of_child_groups) && !($this->input->post('child_pathologist_user_group')) && !($this->input->post('manager_pathologist'))){
//            echo "Its Lab or Hospital related user but not pathologist";
//            remove all institute ids if exist, remove all manager pathologist entries if exist
//            $main_group_id = $member_of_child_groups;
//            $institute_ids = $member_of_group_id;
//        }
//------------------- Check if Edited user group is Lab related or hospital related other than pathologist ------------------
//------------------- Check if Edited user group is Pathologist sub group ------------------
//        if(sizeof($member_of_group_id) >0 && !empty($member_of_child_groups) && !empty($this->input->post('child_pathologist_user_group')) && $this->input->post('manager_pathologist')){
//            echo "Its Pathologist Sub Group";
//            remove all institute ids if exist, remove all manager pathologist entries if exist
//            $main_group_id = $pathologist_child_groups;
//            $institute_ids = $member_of_group_id;
//       Check if Manager Pathologist array is not empty, then add them in reporting to id as separates rows
//        }
//------------------- Check if Edited user group is Pathologist sub group ------------------
        $meta_current_position = $this->input->post('current_position');
        $meta_street_address = $this->input->post('street_address');
        $meta_current_status = $this->input->post('current_status');
        $meta_current_employer = $this->input->post('current_employer');
        $meta_work_street_address = $this->input->post('work_street_address');
        $meta_last_appraisal_date = $this->input->post('last_appraisal_date');
        $meta_dob = $this->input->post('dob');

        $db_user_meta = array(
            'current_position' => $meta_current_position,
            'street_address' => $meta_street_address,
            'current_status' => $meta_current_status,
            'current_employer' => $meta_current_employer,
            'work_street_address' => $meta_work_street_address,
            'last_appraisal_date' => $meta_last_appraisal_date,
            'dob' => $meta_dob
        );
        foreach (array_keys($db_user_meta) as $meta_key) {
            $db_meta = $this->db->where('user_id', $user_id)->where('meta_key', $meta_key)->get('usermeta')->row_array();
            if (!empty($db_meta)) {
                $this->db->where('user_id', $user_id)
                    ->where('meta_key', $meta_key)
                    ->update(
                        'usermeta', array('meta_value' => $db_user_meta[$meta_key])
                    );
            } else {
                if (!empty($db_user_meta[$meta_key])) {
                    $this->db->insert('usermeta', array('user_id' => $user_id, 'meta_key' => $meta_key, 'meta_value' => $db_user_meta[$meta_key]));
                }
            }
        }
// ############### Getting User Type by group id ####################
        if($main_group_id!=0 and $main_group_id!=""){
            $group_type = $this->getGroupTypeByGroupId($main_group_id);
            // print_r($group_type);die;
            $user_type = $group_type['group_type'];
            $adduserst = "user_type=" . $this->db->escape($user_type) . ",";
        } else {
            $adduserst = "";
        }

// ############### Getting User Type by group id ####################
//        echo "<br>".$user_type; exit;


        $sql = "UPDATE users SET ";

        $sql .= $adduserst;
        $sql .= "memorable=" . $this->db->escape($memorable) . ",";
        $sql .= "status=" . $this->db->escape($status) . ",";
        $sql .= "login_token=" . $this->db->escape($login_token) . ",";
        $sql .= "first_name=AES_ENCRYPT(" . $this->db->escape($first_name) . ", '" . DATA_KEY . "' ),";
        $sql .= "email=AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "' ),";
        $sql .= "username=AES_ENCRYPT(" . $this->db->escape($email) . ", '" . DATA_KEY . "' ),";
        if ($update_profile) {
            $sql .= "profile_picture_path='$profileimage', ";
        }
        $sql .= "sub_role='$sub_role',";
        $sql .= "clinic_id='$clinic_id',";
        $sql .= "fee_per_case='$fee_per_case', fee_per_specimen='$fee_per_specimen', ";
        $sql .= "last_name=AES_ENCRYPT(" . $this->db->escape($last_name) . ", '" . DATA_KEY . "' ),";
        $sql .= "company=AES_ENCRYPT(" . $this->db->escape($company) . ", '" . DATA_KEY . "' ), 
        phone=AES_ENCRYPT(" . $this->db->escape($phone) . ", '" . DATA_KEY . "' )  
        WHERE id= " . $user_id;
        $this->db->query($sql);
//        echo $this->db->last_query(); exit;

        // if($existing_user_role != $user_role){

        //     $is_deleted = $this->db->delete('users_groups', ['group_id' => $existing_user_role, 'user_id' => $user_id]);
        //     if($is_deleted){
        //         $this->db->insert('users_groups', [
        //             'user_id' => $user_id,
        //             'group_id' => $user_role,
        //             'institute_id' => NULL
        //         ]);
        //         //$this->load->model('Ion_auth_model');
        //         //$this->ion_auth_model->add_to_group($user_role, $user_id);
        //     }
        // }

        if($main_group_id==0 or $main_group_id==""){
            return true;
        }

        $this->deleteUserInstitutesAndManagerPathologist($user_id);

        $this->updateUserGroupId
        ($user_id, $main_group_id);
//        echo "HERES"; exit;

        foreach ($institute_ids as $institutes) {
            $inst_data = array(
                'user_id ' => $user_id,
                'group_id' => NULL,
                'status' => true,
                'institute_id' => $institutes,
                'reporting_to_id' => NULL,
            );

            $this->db->insert('users_groups', $inst_data);
        }

        if (!empty($manager_pathologists)) {
            foreach ($manager_pathologists as $m_pathologist) {
                $inst_data = array(
                    'user_id ' => $user_id,
                    'group_id' => NULL,
                    'status' => true,
                    'institute_id' => NULL,
                    'reporting_to_id' => $m_pathologist,
                );

                $this->db->insert('users_groups', $inst_data);
            }
        }
        return true;
//        echo '<pre>'; print_r($institute_ids);
//        echo '<pre>'; print_r($inst_data); exit;
    }

    public function getGroupTypeByGroupId($group_id)
    {
        $query = "SELECT id, group_type FROM groups WHERE id =$group_id ";
        $result = $this->db->query($query)->row_array();
        return $result;
    }

    public function deleteUserInstitutesAndManagerPathologist($user_id)
    {
//        echo "here"; exit;
        $query = "DELETE FROM users_groups WHERE user_id =$user_id AND institute_id IS NOT NULL ";
        $this->db->query($query);
        $query2 = "DELETE FROM users_groups WHERE user_id =$user_id AND reporting_to_id IS NOT NULL ";
        $this->db->query($query2);
        return true;
    }

    public function updateUserGroupId($user_id, $group_id)
    {
        $query1 = "SELECT * FROM users_groups WHERE user_id=$user_id AND group_id IS NOT NULL";
        $existing_grp_id = $this->db->query($query1)->row_array();
//        echo '<pre>'; print_r($existing_grp_id); exit;
        if (!empty($existing_grp_id)) {
            $query = "UPDATE users_groups SET group_id = '$group_id' WHERE user_id= $user_id AND group_id IS NOT NULL; ";
            $this->db->query($query);
        } else {
            $query = "INSERT INTO users_groups (user_id, group_id, status,institute_id, reporting_to_id) VALUES ($user_id, $group_id, NULL, NULL, NULL);";
            $this->db->query($query);
        }
        return true;
    }
}
