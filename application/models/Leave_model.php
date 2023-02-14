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
Class Leave_model extends CI_Model
{

    public function sqlQuery($query)
    {
        return $this->db->query($query);
    }

    public function leaveTypes()
    {
        $this->db->select('*');
        return $this->db->get('leave_types')->result();
    }

    public function leaveGroups1()
    {
        $this->db->select('*');
        return $this->db->get('leave_groups')->result();
    }

    public function workingWeeks()
    {
        $this->db->select('*');
        return $this->db->get('working_weeks')->result();
    }

    public function leaveGroups($whereArray = FALSE)
    {
        $this->db->select('leave_groups.*,GROUP_CONCAT(leave_types.name) as leave_types,GROUP_CONCAT(leave_types.id) as leave_type_ids');
        $this->db->join('leave_group_types', 'leave_group_types.leave_group_id=leave_groups.id');
        $this->db->join('leave_types', 'leave_types.id=leave_group_types.leave_type_id');
        $this->db->group_by('leave_groups.id');
        if ($whereArray) {
            $this->db->where($whereArray);
        }
        return $this->db->get('leave_groups')->result();
    }

    public function leaveGroupTypes($whereArray = FALSE)
    {
        $this->db->select('leave_group_types.*,leave_groups.id as group_id,leave_groups.name as group_name');
        $this->db->join('leave_group_types', 'leave_group_types.leave_group_id=leave_groups.id');
        $this->db->join('leave_types', 'leave_types.id=leave_group_types.leave_type_id');
        if ($whereArray) {
            $this->db->where($whereArray);
        }
        return $this->db->get('leave_groups')->result();
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

    public function deleteTable($table, $where)
    {
        $this->db->where($where);
        $status = $this->db->delete($table);
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

    public function getAllusersForadmin($group_id = "", $name = "", $status = "", $selectuserlist = "")
    {
        if ($selectuserlist != "") {
            $where = "where users.id IN(" . $selectuserlist . ")";
        } else {
            $where = "where users.id=users.id";
        }

        if ($name != "" && $name != NULL) {

            $where .= " AND users.first_name= AES_ENCRYPT(" . $this->db->escape($name) . ", '" . DATA_KEY . "') OR users.last_name= AES_ENCRYPT(" . $this->db->escape($name) . ", '" . DATA_KEY . "')";
        }
        if ($status != "" && $status != NULL && $status != "Select Status") {
            $where .= " AND users.active=" . $status;
        }

        if ($group_id != "") {
            $where .= " AND user_type='" . $group_id . "'";
        }

        $query = "SELECT DISTINCT users.*, aes_decrypt(users.username, '" . DATA_KEY . "') AS enc_username,
         aes_decrypt(users.email, '" . DATA_KEY . "') AS enc_email,
          aes_decrypt(users.first_name, '" . DATA_KEY . "') AS enc_first_name,
           aes_decrypt(users.last_name, '" . DATA_KEY . "') AS enc_last_name, 
           aes_decrypt(users.company, '" . DATA_KEY . "') AS enc_company,
            aes_decrypt(users.phone, '" . DATA_KEY . "') AS enc_phone,
            is_hospital_admin,
             users.id as id, users.id as user_id,lg.name as leave_group,lg.id as leave_group_id,
             group_id,
        `groups`.`description` as `description`,
        `groups`.`group_type` as `group_type`,
        `groups`.`first_initial`,
        `groups`.`last_initial`,
        `groups`.`type_cate`
             FROM users 
             INNER JOIN users_groups ON users_groups.user_id = users.id
        INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
             LEFT JOIN user_group_week ugw on users.id = ugw.user_id
             LEFT JOIN leave_groups lg on ugw.leave_group_id = lg.id
              " . $where;
        $dataquery = $this->db->query($query);

        return $dataquery->result();
    }

    public function getAllGroups()
    {
        $query = "select g.id as group_id,g.name,g.group_type,lg.id as leave_group_id,lg.name as leave_group from `groups` g
                  left join user_group_week ugw on g.id=ugw.group_id
                  LEFT JOIN leave_groups lg on ugw.leave_group_id=lg.id
                  ";
        $dataquery = $this->db->query($query);

        return $dataquery->result();
    }

    public function getAllUserLeaves($user_id)
    {
        $query = "select lt.id,lt.name,lb.hospital_id
             FROM leave_balance lb 
             INNER JOIN leave_types lt on lb.leave_type_id = lt.id
             WHERE lb.user_id=$user_id
             ";
        $dataquery = $this->db->query($query);

        return $dataquery->result();
    }

    public function getUserLeaveBalance($user_id)
    {
        $groupId = $this->ion_auth->get_users_groups($user_id)->row()->id;
        $groupId = ($groupId == 1 ? $groupId : "lb.hospital_id");
        $query = "select lt.id,lt.name,lt.code,lb.*, gp.name as hospital_name,gp.first_initial,gp.last_initial
             FROM leave_balance lb 
             INNER JOIN leave_types lt on lb.leave_type_id = lt.id
             LEFT JOIN `groups` gp on lb.hospital_id= gp.id
             WHERE lb.user_id=$user_id
             ";
        $dataquery = $this->db->query($query);

        return $dataquery->result();
    }

    public function getUserHospitals($user_id)
    {
        $query = "select gp.id,gp.name as hospital_name,gp.first_initial,gp.last_initial
             FROM leave_balance lb 
             INNER JOIN `groups` gp on lb.hospital_id = gp.id
             WHERE lb.user_id=$user_id GROUP BY gp.id
             ";
        $dataquery = $this->db->query($query);

        return $dataquery->result();
    }

    public function isUserMultiple($user_id)
    {
        $query = "SELECT * FROM `users_groups` 
                  WHERE `group_id` IN (select id from `groups` where type_cate='category' and group_type != 'A' and group_type is not NULL) 
                  and user_id=$user_id";
        $dataquery = $this->db->query($query);

        return $dataquery->row();
    }

    public function select_where($select, $table, $where)
    {

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    public function userHospitalLeaves($hospital_id, $user_id)
    {

        $this->db->select('lt.id,lt.name');
        $this->db->from("leave_types lt");
        $this->db->join("leave_balance lb", 'lb.leave_type_id=lt.id');
        $this->db->where('lb.hospital_id', $hospital_id);
        $this->db->where('lb.user_id', $user_id);
        $query = $this->db->get()->result();
//        echo $this->db->last_query();exit;
        return $query;
    }

    public function getHospitalAdmin($hospital_id)
    {

        $this->db->select('u.id as user_id');
        $this->db->from("users_groups ug");
        $this->db->join("users u", 'ug.user_id=u.id');
        $this->db->where('ug.group_id', $hospital_id);
        $this->db->where('u.is_hospital_admin', 1);
        $query = $this->db->get()->row()->user_id;
//        echo $this->db->last_query();exit;
        return $query;
    }

    public function userAppliedLeaves($user_id, $hospital_id = FALSE, $leave_type = FALSE)
    {

        $this->db->select('lt.name,g.name as hospital_name,al.*');
        $this->db->from("apply_leave al");
        $this->db->join("leave_types lt", 'al.leave_type_id=lt.id');
        $this->db->join("groups g", 'al.hospital_id=g.id', 'left');
        if ($hospital_id) {
            $this->db->where('al.hospital_id', $hospital_id);
        }
        if ($leave_type) {
            $this->db->where('al.leave_type_id', $leave_type);
        }
        $this->db->where('al.user_id', $user_id);
        $this->db->order_by('al.id', 'DESC');
        $query = $this->db->get()->result();
//        echo $this->db->last_query();exit;
        return $query;
    }

    public function getAllLeaveRequests($filterArray = FALSE, $postData = FALSE)
    {
        $this->db->select("us.profile_picture_path,AES_DECRYPT(us.first_name, '" . DATA_KEY . "') AS first_name,
        AES_DECRYPT(us.last_name, '" . DATA_KEY . "') AS last_name, 
           lt.name,g.name as hospital_name,al.*");
        $this->db->from("apply_leave al");
        $this->db->join("leave_types lt", 'al.leave_type_id=lt.id');
        $this->db->join("users us", 'us.id=al.user_id');
        $this->db->join("groups g", 'al.hospital_id=g.id', 'left');
        if ($filterArray['is_admin'] == 2) {
            $this->db->where('al.hospital_id', $filterArray['hospital_id']);
        }
        if ($postData) {
            if ($postData['leave_types'] != "") {
                $this->db->where('al.leave_type_id', $postData['leave_types']);
            }
            if ($postData['leave_status'] != "") {
                $this->db->where('al.status', $postData['leave_status']);
            }
            if ($postData['start_end_date'] != "") {
                $explodeDate = explode(" - ", $postData['start_end_date']);
                $startDate = date("Y-m-d", strtotime($explodeDate[0]));
                $endDate = date("Y-m-d", strtotime($explodeDate[1]));
                $this->db->where("( al.start_date BETWEEN '$startDate' AND '$endDate' OR al.end_date BETWEEN '$startDate' AND '$endDate' )");
            }
            if ($postData['emp_name'] != "") {
                $strarray = (explode(" ", $postData['emp_name']));
                $query = "(";
                foreach ($strarray as $key => $value) {
                    $value = strtolower($value);
                    If ($key > 0) {
                        $query .= " OR ";
                    }
//                    "AES_DECRYPT(`users`.`email`, '" . DATA_KEY . "') LIKE '%$value%'";
                    $query .= " ((CONVERT(AES_DECRYPT(us.first_name, '" . DATA_KEY . "') using latin1) LIKE '%$value%') OR (CONVERT(AES_DECRYPT(us.last_name, '" . DATA_KEY . "') using latin1) LIKE '%$value%')) ";
                }
                $query .= ")";
                $this->db->where($query);
            }
        }
        $this->db->order_by('al.status', 'ASC');
        $this->db->order_by('al.applied_date', 'DESC');
        $query = $this->db->get()->result();
//        echo $this->db->last_query();exit;
        return $query;
    }

    public function getAllLeaveTypes()
    {

        $this->db->select('id,name');
        $this->db->from("leave_types");
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function plannedLeaveCount($filterArray = FALSE, $date = FALSE)
    {

        $this->db->select('COUNT(al.id) as total');
        $this->db->from("apply_leave al");
        $this->db->join("users us", 'us.id=al.user_id');
        $this->db->join("groups g", 'al.hospital_id=g.id', 'left');
        $this->db->where('al.approve_flag', 0);
        $this->db->where('al.status', 1);
        if ($filterArray['is_admin'] == 2) {
            $this->db->where('al.hospital_id', $filterArray['hospital_id']);
        }
        if ($date) {
            $startDate = date("Y-m-d", strtotime($date['start_date']));
            $endDate = date("Y-m-d", strtotime($date['end_date']));
            $this->db->where("( al.start_date BETWEEN '$startDate' AND '$endDate' OR al.end_date BETWEEN '$startDate' AND '$endDate' )");
        }
        $query = $this->db->get()->row()->total;
        return $query;
    }

    public function unPlannedLeaveCount($filterArray = FALSE, $date = FALSE)
    {

        $this->db->select('COUNT(al.id) as total');
        $this->db->from("apply_leave al");
        $this->db->join("users us", 'us.id=al.user_id');
        $this->db->join("groups g", 'al.hospital_id=g.id', 'left');
        $this->db->where('al.approve_flag', 1);
        $this->db->where('al.status', 1);
        if ($filterArray['is_admin'] == 2) {
            $this->db->where('al.hospital_id', $filterArray['hospital_id']);
        }
        if ($date) {
            $startDate = date("Y-m-d", strtotime($date['start_date']));
            $endDate = date("Y-m-d", strtotime($date['end_date']));
            $this->db->where("( al.start_date BETWEEN '$startDate' AND '$endDate' OR al.end_date BETWEEN '$startDate' AND '$endDate' )");
        }
        $query = $this->db->get()->row()->total;
        return $query;
    }

    public function totalPendingCount($filterArray)
    {

        $this->db->select('COUNT(al.id) as total');
        $this->db->from("apply_leave al");
        $this->db->join("users us", 'us.id=al.user_id');
        $this->db->join("groups g", 'al.hospital_id=g.id', 'left');
        $this->db->where('al.status', 0);
        if ($filterArray['is_admin'] == 2) {
            $this->db->where('al.hospital_id', $filterArray['hospital_id']);
        }
        $query = $this->db->get()->row()->total;
        return $query;
    }

    public function totalTodayPresents($filterArray, $date = FALSE)
    {

        if ($filterArray['is_admin'] == 2) {
            $hospital_id = $filterArray['hospital_id'];
            $sqlQuery = "SELECT
                                SUM(totalUsers) AS totalUsers,
                                SUM(absent_today) AS absent_today
                            FROM
                                (
                                    (
                                    SELECT
                                        COUNT(DISTINCT u.id) AS totalUsers,
                                        SUM(
                                            CASE WHEN(
                                                '$date' BETWEEN al.start_date AND al.end_date AND al.status != 2
                                            ) THEN 1 ELSE 0
                                        END
                                ) AS absent_today
                            FROM
                                `users_groups` ug
                            JOIN `users` `u` ON
                                `ug`.`user_id` = `u`.`id`
                            LEFT JOIN `apply_leave` `al` ON
                                u.id = al.user_id
                            WHERE
                                institute_id = $hospital_id AND group_id IS NULL
                                )
                            UNION
                                (
                                SELECT
                                    COUNT(DISTINCT u.id) AS totalUsers,
                                    SUM(
                                        CASE WHEN(
                                            '$date' BETWEEN al.start_date AND al.end_date AND al.status != 2
                                        ) THEN 1 ELSE 0
                                    END
                            ) AS absent_today
                            FROM
                                `users_groups` `ug`
                            JOIN `users` `u` ON
                                `ug`.`user_id` = `u`.`id`
                            LEFT JOIN `apply_leave` `al` ON
                                u.id = al.user_id
                            WHERE
                                `ug`.`group_id` = $hospital_id AND `u`.`is_hospital_admin` = 1
                            )
                            ) AS hospital_admin";
        } else {
            $sqlQuery = "SELECT
                            COUNT(DISTINCT us.id) AS totalUsers,
                            SUM(
                                CASE WHEN(
                                    '$date' BETWEEN al.start_date AND al.end_date AND al.status != 2
                                ) THEN 1 ELSE 0
                            END
                        ) AS absent_today
                        FROM
                            `users` `us`
                        LEFT JOIN `apply_leave` `al` ON
                            `us`.`id` = `al`.`user_id`
                        LEFT JOIN `groups` `g` ON
                            `al`.`hospital_id` = `g`.`id`";
        }
        $query = $this->db->query($sqlQuery)->row();
        return $query;
    }


}
