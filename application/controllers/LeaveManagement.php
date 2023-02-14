<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Shariq ali.
 * @version    1.0.0
 */
class LeaveManagement extends CI_Controller
{

    /**
     * Constructor to load models and helpers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('Leave_model', 'leave_model');
        // $this->load->model('TicketsModel');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function leaveSettings()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $hospital_id = $this->input->post('hospital_id');
            $role_id = $this->input->post('role_id');
            $leaveType = $this->input->post('leave_type_id');
            $hospital_id = ($role_id == 1 ? 0 : $hospital_id);

            $whereArray['hospital_id'] = $hospital_id;
            $whereArray['role_id'] = $role_id;
            $whereArray['leave_type_id'] = $leaveType;
            $getLeaveType = $this->leave_model->select_where("*", "leave_group_types", $whereArray)->row();

//            echo "<pre>";print_r($_POST);exit;
            if (empty($getLeaveType)) {
                //Add Case
                $dataRecord['hospital_id'] = $hospital_id;
                $dataRecord['role_id'] = $role_id;
                $dataRecord['leave_type_id'] = $leaveType;
                if (isset($_POST['days']))
                    $dataRecord['days'] = $this->input->post('days');
                if (isset($_POST['carry_forward']))
                    $dataRecord['carry_forward'] = $this->input->post('carry_forward');
                if (isset($_POST['max']))
                    $dataRecord['max'] = $this->input->post('max');
                if (isset($_POST['earned_leave']))
                    $dataRecord['earned_leave'] = $this->input->post('earned_leave');

                $chkRecord = $this->leave_model->addRecord('leave_group_types', $dataRecord);
            } else {
                //Update Case
                if (isset($_POST['days']))
                    $dataRecord['days'] = $this->input->post('days');
                if (isset($_POST['carry_forward']))
                    $dataRecord['carry_forward'] = $this->input->post('carry_forward');
                if (isset($_POST['max']))
                    $dataRecord['max'] = $this->input->post('max');
                if (isset($_POST['earned_leave']))
                    $dataRecord['earned_leave'] = $this->input->post('earned_leave');

                $chkRecord = $this->leave_model->updateTable('leave_group_types', $dataRecord, $whereArray);
            }

            //Assigning Leaves
            if ($role_id == 0) {
                $sqlQuery = "SELECT `ug`.*
                          FROM `users_groups` `ug` 
                          JOIN `users` `u` ON `ug`.`user_id`=`u`.`id` 
                          WHERE `ug`.`group_id` = $hospital_id AND `u`.`is_hospital_admin` = 1";
            } else if ($role_id == 1) {
                $sqlQuery = "SELECT `ug`.*
                          FROM `users_groups` `ug` 
                          JOIN `users` `u` ON `ug`.`user_id`=`u`.`id` 
                          WHERE `ug`.`group_id` = $role_id";
            } else {
                $sqlQuery = "SELECT * 
                         FROM `users_groups` where user_id in (select user_id from users_groups inner join `groups` on `groups`.`id` = users_groups.group_id where `groups`.`id`=$role_id)
                         and institute_id = $hospital_id and group_id is NULL";
            }

            $getAllUsers = $this->leave_model->sqlQuery($sqlQuery)->result();
            $getLeaveType = $this->leave_model->select_where("*", "leave_group_types", $whereArray)->result();
            $whereArray = array();
            foreach ($getAllUsers as $user) {
                foreach ($getLeaveType as $leaveType) {
                    $whereArray['user_id'] = $user->user_id;
                    $whereArray['hospital_id'] = $hospital_id;
                    $whereArray['leave_type_id'] = $leaveType->leave_type_id;
                    $whereArray['leave_year'] = date("Y");
                    $checkRecord = $this->leave_model->select_where("*", "leave_balance", $whereArray)->row();
                    if (empty($checkRecord)) {
                        //Add New Record
                        $insBalance['user_id'] = $user->user_id;
                        $insBalance['hospital_id'] = $hospital_id;
                        $insBalance['leave_type_id'] = $leaveType->leave_type_id;
                        $insBalance['total_leaves'] = $leaveType->days;
                        $insBalance['quota'] = $leaveType->days;
                        $insBalance['availed'] = 0;
                        $insBalance['remaining'] = $leaveType->days;
                        $insBalance['start_date'] = date("Y") . "-01-01";
                        $insBalance['end_date'] = date("Y") . "-12-31";
                        $insBalance['leave_year'] = date("Y");
                        $insBalance['created_date'] = date("Y-m-d");
                        $insBalance['created_by'] = $this->ion_auth->user()->row()->id;
                        $this->leave_model->addRecord('leave_balance', $insBalance);
                    } else {
                        //Update Existing Record
                        $insBalance['total_leaves'] = $leaveType->days;
                        $insBalance['quota'] = $leaveType->days;
                        $insBalance['availed'] = 0;
                        $insBalance['remaining'] = $leaveType->days;
                        $insBalance['created_date'] = date("Y-m-d");
                        $insBalance['created_by'] = $this->ion_auth->user()->row()->id;
                        $this->leave_model->updateTable('leave_balance', $insBalance, $whereArray);
                    }
                }
            }

            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Record added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );

        $user_id = $this->ion_auth->user()->row()->id;
        $hospital_admin = $this->db->get_where("users", array('id' => $user_id, 'is_hospital_admin' => 1))->row();
        $hospital_row = $this->ion_auth->get_users_groups()->row();
        $hospital_id = $hospital_row->id;

        if (!$this->ion_auth->is_admin() && empty($hospital_admin)) {
            redirect('auth/login', 'refresh');
        }


        $data['is_hospital_admin'] = (empty($hospital_admin) ? false : true);
        $data['hospital_id'] = $hospital_id;
        $data['groups'] = $this->leave_model->getAllGroups();
        $data['leaveGroups'] = $this->leave_model->leaveGroups1();
        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('leave/leave_type', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function leaveSettings1()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $insRecord['name'] = $this->input->post('leave_name');
            $insRecord['code'] = $this->input->post('leave_code');
            $insRecord['no_of_leaves'] = $this->input->post('total_leaves');
            $insRecord['min_leave'] = $this->input->post('min_leaves');
            $insRecord['leave_stretch'] = $this->input->post('leave_stretch');
//            $insRecord['leave_for'] = $this->input->post('leave_gender');
            $insRecord['remarks'] = $this->input->post('leave_remarks');
            if ($this->input->post('form_status') == "edit") {
                $editId = $this->input->post('edit_id');
                $chkRecord = $this->leave_model->updateTable('leave_types', $insRecord, array("id" => $editId));
            } else {
                $chkRecord = $this->leave_model->addRecord('leave_types', $insRecord);
            }

            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Record added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );
        $data['leaveGroups'] = $this->leave_model->leaveGroups();
        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('leave/leave_type_new', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function deleteLeaveType()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $deleteId = $this->input->post("dataId");
            $chkRecord = $this->leave_model->deleteData('leave_types', array("id" => $deleteId));

            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Record added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );
        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('leave/leave_type', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function deleteLeaveGroup()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $deleteId = $this->input->post("dataId");
            $chkRecord = $this->leave_model->deleteData('leave_groups', array("id" => $deleteId));

            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Record added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );
        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('leave/leave_type', $data);
        $this->load->view('templates/footer-new', $data);
    }

    function check_leave_group()
    {
        $leave_group = $this->input->post('leave_group');// get first name
        $user_group = $this->input->post('user_group_id');// get last name
        $this->db->select('id');
        $this->db->from('leave_groups');
        $this->db->where('name', $leave_group);
        $this->db->where('group_id', $user_group);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            $this->form_validation->set_message('check_leave_group', 'This Group already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function leaveGroups()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            is_unique[user.email]
            $this->form_validation->set_rules('leave_group', 'Group Name', 'required|callback_check_leave_group');
            $this->form_validation->set_rules('user_group_id', 'Group Name', 'required');
            $this->form_validation->set_rules('remarks', 'Notes', 'required');
            if ($this->form_validation->run() == FALSE) {
                $response['status'] = "fail";
                $response['message'] = strip_tags(validation_errors());
            } else {
                $insRecord['group_id'] = $this->input->post('user_group_id');
                $insRecord['name'] = $this->input->post('leave_group');
//            $leaveTypes = $this->input->post('leave_types');
                $insRecord['remarks'] = $this->input->post('remarks');
                if ($this->input->post('edit_mod') == "edit") {
                    $editId = $this->input->post('edit_id');
                    $chkRecord = $this->leave_model->updateTable('leave_groups', $insRecord, array("id" => $editId));
//                $leaveGroup = $this->leave_model->leaveGroups(array("leave_group_types.leave_group_id" => $editId));
//                $preArray = explode(",",$leaveGroup[0]->leave_type_ids);
//                sort($preArray);
//                sort($leaveTypes);
//                if($preArray!=$leaveTypes){
//                    $this->leave_model->deleteData('leave_group_types', array("leave_group_id" => $editId));
//                    $count = 0;
//                    foreach ($leaveTypes as $leave => $val) {
//                        $groupLeaves[$count]['leave_group_id'] = $editId;
//                        $groupLeaves[$count]['leave_type_id'] = $val;
//                        $count++;
//                    }
//                    $chkRecord = $this->leave_model->addBatchRecord('leave_group_types', $groupLeaves);
//                }

                } else {
                    $chkRecord = $this->leave_model->addRecord('leave_groups', $insRecord);
//                $count = 0;
//                foreach ($leaveTypes as $leave => $val) {
//                    $groupLeaves[$count]['leave_group_id'] = $lastId;
//                    $groupLeaves[$count]['leave_type_id'] = $val;
//                    $count++;
//                }
//                $chkRecord = $this->leave_model->addBatchRecord('leave_group_types', $groupLeaves);
                }

                if ($chkRecord) {
                    $response['status'] = "success";
                    $response['message'] = "Record added successfully";
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Failed to add record. Please try again";
                }
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );
        $data['leaveGroups'] = $this->leave_model->leaveGroups();
        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $this->load->view('templates/header-new');
        $this->load->view('leave/leave_group', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function getGroupData()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $hospitalId = $this->input->post('hospital_id');
            $groupId = $this->input->post('role_id');
            if ($groupId == 1) {
                $hospitalId = 0;
            }
            $getLeaveType = $this->leave_model->select_where("*", "leave_group_types", array('hospital_id' => $hospitalId, 'role_id' => $groupId))->result();
            $response['leave_group_types'] = $getLeaveType;
            echo json_encode($response);
            exit;
        }
    }

    public function workingWeek()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $insRecord['name'] = $this->input->post('name');
            $insRecord['mon'] = ($this->input->post('monday') == 'on' ? 1 : 0);
            $insRecord['tue'] = ($this->input->post('tuesday') == 'on' ? 1 : 0);
            $insRecord['wed'] = ($this->input->post('wednesday') == 'on' ? 1 : 0);
            $insRecord['thu'] = ($this->input->post('thursday') == 'on' ? 1 : 0);
            $insRecord['fri'] = ($this->input->post('friday') == 'on' ? 1 : 0);
            $insRecord['sat'] = ($this->input->post('saturday') == 'on' ? 1 : 0);
            $insRecord['sun'] = ($this->input->post('sunday') == 'on' ? 1 : 0);
            if ($this->input->post('form_status') == "edit") {
                $editId = $this->input->post('edit_id');
                $chkRecord = $this->leave_model->updateTable('working_weeks', $insRecord, array("id" => $editId));
            } else {
                $chkRecord = $this->leave_model->addRecord('working_weeks', $insRecord);
            }

            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Record added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );
        $data['workingWeeks'] = $this->leave_model->workingWeeks();
        $this->load->view('templates/header-new');
        $this->load->view('leave/working_week', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function assignGroup()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $group = $this->input->post('group_id');
            $leaveGroupId = $this->input->post('leave_group_id');
            $insRecord['group_id'] = $group;
            $insRecord['leave_group_id'] = $leaveGroupId;
//            if ($this->input->post('form_status') == "edit") {
            $editId = $this->input->post('edit_id');
            $getRecord = $this->leave_model->select_where("*", "user_group_week", array('group_id' => $group));
            $getLeaveGroups = $this->leave_model->leaveGroupTypes(array('leave_group_types.leave_group_id' => $leaveGroupId, 'leave_group_types.status' => 1));
            $getUsers = $this->leave_model->select_where("*", "users_groups", array('group_id' => $group))->result();
            if (empty($getRecord->row())) {
                $chkRecord = $this->leave_model->addRecord('user_group_week', $insRecord);
                $counter = 0;
                foreach ($getUsers as $userData) {
                    foreach ($getLeaveGroups as $leaveData) {
                        $insBalance[$counter]['user_id'] = $userData->user_id;
                        $insBalance[$counter]['leave_type_id'] = $leaveData->leave_type_id;
                        $insBalance[$counter]['total_leaves'] = $leaveData->days;
                        $insBalance[$counter]['quota'] = $leaveData->days;
                        $insBalance[$counter]['availed'] = 0;
                        $insBalance[$counter]['remaining'] = $leaveData->days;
                        $insBalance[$counter]['start_date'] = date("Y") . "-01-01";
                        $insBalance[$counter]['end_date'] = date("Y") . "-12-31";
                        $insBalance[$counter]['leave_year'] = date("Y");
                        $insBalance[$counter]['created_date'] = date("Y-m-d");
                        $insBalance[$counter]['created_by'] = $this->ion_auth->user()->row()->id;
                        $counter++;
                    }
                }
                $chkRecord = $this->leave_model->addBatchRecord('leave_balance', $insBalance);
            } else {
                $chkRecord = $this->leave_model->updateTable('user_group_week', $insRecord, array("group_id" => $group));
                $counter = 0;
                foreach ($getUsers as $userData) {
                    foreach ($getLeaveGroups as $leaveData) {
                        $insBalance[$counter]['user_id'] = $userData->user_id;
                        $insBalance[$counter]['leave_type_id'] = $leaveData->leave_type_id;
                        $insBalance[$counter]['total_leaves'] = $leaveData->days;
                        $insBalance[$counter]['quota'] = $leaveData->days;
                        $insBalance[$counter]['availed'] = 0;
                        $insBalance[$counter]['remaining'] = $leaveData->days;
                        $insBalance[$counter]['start_date'] = date("Y") . "-01-01";
                        $insBalance[$counter]['end_date'] = date("Y") . "-12-31";
                        $insBalance[$counter]['leave_year'] = date("Y");
                        $insBalance[$counter]['created_date'] = date("Y-m-d");
                        $insBalance[$counter]['created_by'] = $this->ion_auth->user()->row()->id;
                        $counter++;
                    }
                    $chkRecord = $this->leave_model->deleteData('leave_balance', array("user_id" => $userData->user_id));

                }
//                $chkRecord = $this->leave_model->deleteData('leave_balance', array("user_id" => $user_id));
                $chkRecord = $this->leave_model->addBatchRecord('leave_balance', $insBalance);
            }
//            } else {
//                $chkRecord = $this->leave_model->addRecord('user_group_week', $insRecord);
//            }

            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Record added successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
        $data['javascripts'] = array(
            'js/leaves.js'
        );

        $data['groups'] = $this->leave_model->getAllGroups();
//        echo "<pre>";print_r($res);exit;

//        $data['users'] = $this->ion_auth->users()->result();
//        $data['workingWeeks'] = $this->leave_model->workingWeeks();
        $data['leaveGroups'] = $this->leave_model->leaveGroups1();
        $this->load->view('templates/header-new');
        $this->load->view('leave/assign_leave_group', $data);
        $this->load->view('templates/footer-new', $data);
    }

    public function applyLeave()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $this->ion_auth->user()->row()->id;
            $hospital_id = $this->input->post('leave_hospital');
            $leave_type = $this->input->post('leave_code');
            $notes = $this->input->post('leave_remarks');
            $start_end_date = explode(" - ", $this->input->post('start_end_date'));
            $start_date = date("Y-m-d", strtotime($start_end_date[0]));
            $end_date = date("Y-m-d", strtotime($start_end_date[1]));
            //GEt Days
            $earlier = new DateTime($start_date);
            $later = new DateTime($end_date);
            $noDays = $later->diff($earlier)->format("%a") + 1;
            //Where Conditions
            $whereArray['user_id'] = $user_id;
            $whereArray['hospital_id'] = $hospital_id;
            $whereArray['leave_type_id'] = $leave_type;
            //Define Another Where caluse for dates check
            $checkAppliedArray = $whereArray;
            //Remove Leave Type Where Clause for dates (Confirm user can apply on same date for different hospitals)
            unset($checkAppliedArray['leave_type_id']);
            $checkAppliedArray['status'] = 0;
            $checkAppliedArray['(start_date BETWEEN "' . $start_date . '" AND "' . $end_date . '" OR end_date BETWEEN "' . $start_date . '" AND "' . $end_date . '") AND 1 = '] = '1';
            $checkIfApplied = $this->leave_model->select_where("*", "apply_leave", $checkAppliedArray)->row();
            //Check If leave already applied between the given dates
            if (empty($checkIfApplied)) {
                $getBalance = $this->leave_model->select_where("*", "leave_balance", $whereArray)->row();
                //Check if Empty Balance or not
                if (!empty($getBalance)) {
                    $leaveAvailed = $getBalance->availed;
                    $leaveRemaining = $getBalance->remaining;
                    if ($noDays <= $leaveRemaining) {
                        $leaveRemaining = $leaveRemaining - $noDays;
                        $leaveAvailed = $leaveAvailed + $noDays;
                        //update Record Array for leave balance
                        $updateBalance['availed'] = $leaveAvailed;
                        $updateBalance['remaining'] = $leaveRemaining;
                        //Ins Record Array for Apply Leave
                        $insRecord['user_id'] = $user_id;
                        $insRecord['hospital_id'] = $hospital_id;
                        $insRecord['leave_type_id'] = $leave_type;
                        $insRecord['start_date'] = $start_date;
                        $insRecord['end_date'] = $end_date;
                        $insRecord['notes'] = $notes;
                        $insRecord['total_days'] = $noDays;
                        $insRecord['leave_year'] = date("Y");
                        //Transaction Start
                        $this->db->trans_start();

                        $this->leave_model->updateTable('leave_balance', $updateBalance, $whereArray);
                        $this->leave_model->addRecord('apply_leave', $insRecord);

                        //Transaction End
                        $this->db->trans_complete();
                        $trans_status = $this->db->trans_status();
                        if ($trans_status == FALSE) {
                            $this->db->trans_rollback();
                            $response['status'] = "fail";
                            $response['message'] = "Something Went Wrong.";
                        } else {
                            $this->db->trans_commit();
                            $response['status'] = "success";
                            $response['message'] = "You have successfully applied for leave";
                        }
                    } else {
                        $response['status'] = "fail";
                        $response['message'] = "You don't have sufficient leaves in your balance";
                    }
                } else {
                    $response['status'] = "fail";
                    $response['message'] = "Leave Balance not assigned";
                }
            } else {
                $response['status'] = "fail";
                $response['message'] = "You have already applied leave between the given dates";
            }
            echo json_encode($response);
            exit;
        }
    }

    public function editAppliedLeave()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $this->ion_auth->user()->row()->id;
            $edit_leave_id = $this->input->post('edit_leave_id');
            $leaveOldRecord = $this->leave_model->select_where("*", "apply_leave", array("id" => $edit_leave_id, 'status' => 0))->row();
            if (empty($leaveOldRecord)) {
                $response['status'] = "fail";
                $response['message'] = "You can only edit pending leaves";
            } else {
                $pre_hospital_id = $leaveOldRecord->hospital_id;
                $pre_leave_type = $leaveOldRecord->leave_type_id;
                $pre_days = $leaveOldRecord->total_days;
                $hospital_id = $this->input->post('leave_hospital');
                $leave_type = $this->input->post('leave_code');
                $notes = $this->input->post('leave_remarks');
                $start_end_date = explode(" - ", $this->input->post('start_end_date'));
                $start_date = date("Y-m-d", strtotime($start_end_date[0]));
                $end_date = date("Y-m-d", strtotime($start_end_date[1]));
                //GEt Days
                $earlier = new DateTime($start_date);
                $later = new DateTime($end_date);
                $noDays = $later->diff($earlier)->format("%a") + 1;
                //Check Leave Change
                $checkLeaveChange['id'] = $edit_leave_id;
                $checkLeaveChange['user_id'] = $user_id;
                $checkLeaveChange['hospital_id'] = $hospital_id;
                $checkLeaveChange['leave_type_id'] = $leave_type;
                $checkLeaveChange['start_date'] = $start_date;
                $checkLeaveChange['end_date'] = $end_date;
                $checkLeaveChange['notes'] = $notes;
                $checkSameRecord = $this->leave_model->select_where("*", "apply_leave", $checkLeaveChange)->row();
                if (!empty($checkSameRecord)) {
                    $response['status'] = "fail";
                    $response['message'] = "No change found";
                } else {
                    //Where Conditions
                    $whereArray['user_id'] = $user_id;
                    $whereArray['hospital_id'] = $hospital_id;
                    $whereArray['leave_type_id'] = $leave_type;
                    //Define Another Where caluse for dates check
                    $checkAppliedArray = $whereArray;
                    //Remove Leave Type Where Clause for dates (Confirm user can apply on same date for different hospitals)
                    $checkAppliedArray['id!='] = $edit_leave_id;
                    unset($checkAppliedArray['leave_type_id']);
                    $checkAppliedArray['status'] = 0;
                    $checkAppliedArray['(start_date BETWEEN "' . $start_date . '" AND "' . $end_date . '" OR end_date BETWEEN "' . $start_date . '" AND "' . $end_date . '") AND 1 = '] = '1';
                    $checkIfApplied = $this->leave_model->select_where("*", "apply_leave", $checkAppliedArray)->row();
                    //Check If leave already applied between the given dates
                    if (empty($checkIfApplied)) {
                        //Change leave balance table
                        $getBalance = $this->leave_model->select_where("*", "leave_balance", $whereArray)->row();
                        //Check if Empty Balance or not
                        if (!empty($getBalance)) {
                            $leaveAvailed = $getBalance->availed;
                            $leaveRemaining = $getBalance->remaining;
                            if ($pre_hospital_id == $hospital_id && $pre_leave_type == $leave_type) {
                                $updateWhereBalance = $whereArray;
                                $leaveRemaining = $leaveRemaining + $pre_days;
                                $leaveAvailed = $leaveAvailed - $pre_days;
                                //Update Array
                                $updateBalance['availed'] = $leaveAvailed;
                                $updateBalance['remaining'] = $leaveRemaining;
                            } else {
                                //Update Array
                                $updateWhereBalance['user_id'] = $user_id;
                                $updateWhereBalance['hospital_id'] = $pre_hospital_id;
                                $updateWhereBalance['leave_type_id'] = $pre_leave_type;
                                $getBalance = $this->leave_model->select_where("*", "leave_balance", $updateWhereBalance)->row();
                                $updateBalance['availed'] = $getBalance->availed - $pre_days;
                                $updateBalance['remaining'] = $getBalance->remaining + $pre_days;
                            }
                            if ($noDays < $leaveRemaining) {
                                //Transaction Start
                                $this->db->trans_start();
                                $this->leave_model->updateTable('leave_balance', $updateBalance, $updateWhereBalance);

                                $leaveRemaining = $leaveRemaining - $noDays;
                                $leaveAvailed = $leaveAvailed + $noDays;
                                //update Record Array for leave balance
                                $updateBalance['availed'] = $leaveAvailed;
                                $updateBalance['remaining'] = $leaveRemaining;
                                //Ins Record Array for Apply Leave
                                $updateRecord = array();
                                $updateRecord['hospital_id'] = $hospital_id;
                                $updateRecord['leave_type_id'] = $leave_type;
                                $updateRecord['start_date'] = $start_date;
                                $updateRecord['end_date'] = $end_date;
                                $updateRecord['notes'] = $notes;
                                $updateRecord['total_days'] = $noDays;
                                $updateRecord['leave_year'] = date("Y");
                                $updateRecord['date_modified'] = date("Y-m-d H:i:s");

                                $this->leave_model->updateTable('leave_balance', $updateBalance, $whereArray);
                                $this->leave_model->updateTable('apply_leave', $updateRecord, array("id" => $edit_leave_id));

                                //Transaction End
                                $this->db->trans_complete();
                                $trans_status = $this->db->trans_status();
                                if ($trans_status == FALSE) {
                                    $this->db->trans_rollback();
                                    $response['status'] = "fail";
                                    $response['message'] = "Something Went Wrong.";
                                } else {
                                    $this->db->trans_commit();
                                    $response['status'] = "success";
                                    $response['message'] = "You have successfully applied for leave";
                                }
                            } else {
                                $response['status'] = "fail";
                                $response['message'] = "You don't have sufficient leaves in your balance";
                            }
                        } else {
                            $response['status'] = "fail";
                            $response['message'] = "Leave Balance not assigned";
                        }
                    } else {
                        $response['status'] = "fail";
                        $response['message'] = "You have already applied leave between the given dates";
                    }
                }
            }
            echo json_encode($response);
            exit;
        }
    }

    public function leaveDetail($leaveEncode = FALSE)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $hospital_id = $leave_type = FALSE;
        if ($leaveEncode) {
            $leaveDecode = explode("_", base64_decode($leaveEncode));
            $hospital_id = ($leaveDecode[0]==0?FALSE:$leaveDecode[0]);
            $leave_type = ($leaveDecode[1]==0?FALSE:$leaveDecode[1]);
        }
        $includes['styles'] = array(
            'css/daterangepicker.css'
        );
        $includes['javascripts'] = array(
            'js/daterangepicker.js',
            'js/leaves.js');
        $user_id = $this->ion_auth->user()->row()->id;
//        $data['userAllLeaves'] = $this->leave_model->userAppliedLeaves($user_id, $hospital_id, $leave_type);
        $data['usersLeaveBalance'] = $this->leave_model->getUserLeaveBalance($user_id);
        $data['allLeaveTypes'] = $this->leave_model->getAllLeaveTypes();
        $data['usersLeaves'] = $this->leave_model->getAllUserLeaves($user_id);
        $data['userHospitals'] = $this->leave_model->getUserHospitals($user_id);
        $data['isMultiple'] = $this->leave_model->isUserMultiple($user_id);

        $data['user_id'] = $user_id;
        $data['hospital_id'] = $leaveDecode[0];
        $data['leave_type_id'] = $leaveDecode[1];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $hospital_id = $this->input->post("leave_hospital_filter");
            $leave_code_filter = $this->input->post("leave_code_filter");
            $data['hospital_id'] = $hospital_id;
            $data['leave_type_id'] = $leave_code_filter;
            $encodeData = base64_encode($hospital_id . "_" . $leave_code_filter);
            redirect('leaveManagement/leaveDetail/'.$encodeData, 'refresh');
//            $data['userAllLeaves'] = $this->leave_model->userAppliedLeaves($user_id, $hospital_id, $leave_code_filter);
        } else {
            $data['userAllLeaves'] = $this->leave_model->userAppliedLeaves($user_id, $hospital_id, $leave_type);
//            echo $this->db->last_query();
//            exit;
        }

//        echo "<pre>";print_r($data['userAllLeaves']);exit;
        $this->load->view('templates/header-new', $includes);
        $this->load->view('leave/leave_list', $data);
        $this->load->view('templates/footer-new', $includes);
    }

    public function leaveRequests()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->ion_auth->user()->row()->id;
        $hospital_admin = $this->db->get_where("users", array('id' => $user_id, 'is_hospital_admin' => 1))->row();
        if (!$this->ion_auth->is_admin() && empty($hospital_admin)) {
            redirect('auth/login', 'refresh');
        }

        $includes['styles'] = array(
            'css/daterangepicker.css'
        );
        $includes['javascripts'] = array(
            'js/daterangepicker.js',
            'js/leaves.js');
        $hospital_row = $this->ion_auth->get_users_groups()->row();
        $hospital_id = $hospital_row->id;
        //Status Categories
        // Admin = 1
        // Hospital Admin = 2
        if (!empty($hospital_admin)) {
            $filterArray['is_admin'] = 2;
            $filterArray['hospital_id'] = $hospital_id;
        }
        if ($this->ion_auth->is_admin()) {
            $filterArray['is_admin'] = 1;
        }
        $dateRange['start_date'] = date("Y-01-01");
        $dateRange['end_date'] = date("Y-12-31");
        $data['leaveTypes'] = $this->leave_model->leaveTypes();
        $data['plannedCount'] = $this->leave_model->plannedLeaveCount($filterArray, $dateRange);
        $data['unPannedCount'] = $this->leave_model->unPlannedLeaveCount($filterArray, $dateRange);
        $data['totalPendingCount'] = $this->leave_model->totalPendingCount($filterArray);
        $data['totalTodayPresents'] = $this->leave_model->totalTodayPresents($filterArray,date("Y-m-d"));

//        echo "<pre>";print_r($data['totalTodayPresents']);exit;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data['userAllLeaves'] = $this->leave_model->getAllLeaveRequests($filterArray, $_POST);
            $data['leave_types'] = $_POST['leave_types'];
            $data['leave_status'] = $_POST['leave_status'];
            $data['emp_name'] = $_POST['emp_name'];
            $data['start_end_date'] = $_POST['start_end_date'];
        } else {
            $data['userAllLeaves'] = $this->leave_model->getAllLeaveRequests($filterArray);
        }


//        echo "<pre>";print_r($data['userAllLeaves']);exit;
        $this->load->view('templates/header-new', $includes);
        $this->load->view('leave/admin_leaves', $data);
        $this->load->view('templates/footer-new', $includes);
    }

    public function leaveAction()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $this->ion_auth->user()->row()->id;
            $leaveId = $this->input->post('dataId');
            $status = $this->input->post('dataStatus');
            $leaveOldRecord = $this->leave_model->select_where("*", "apply_leave", array("id" => $leaveId, 'status' => 0))->row();
            if (empty($leaveOldRecord)) {
                $response['status'] = "fail";
                $response['message'] = "You can only edit pending leaves";
            } else {
                //Transaction Start
                $this->db->trans_start();
                if ($status == "approve") {
                    $updateRecord['approve_flag'] = $this->input->post('leaveData');;
                    $updateRecord['status'] = 1;
                    $updateRecord['approve_reject_by'] = $user_id;
                    $updateRecord['approve_reject_at'] = date("Y-m-d H:i:s");
                    $this->leave_model->updateTable('apply_leave', $updateRecord, array("id" => $leaveId));
                } else if ($status == "reject") {
                    $total_days = $leaveOldRecord->total_days;
                    //Update Array
                    $updateWhereBalance['user_id'] = $leaveOldRecord->user_id;
                    $updateWhereBalance['hospital_id'] = $leaveOldRecord->hospital_id;
                    $updateWhereBalance['leave_type_id'] = $leaveOldRecord->leave_type_id;
                    $getBalance = $this->leave_model->select_where("*", "leave_balance", $updateWhereBalance)->row();
                    $updateBalance['availed'] = $getBalance->availed - $total_days;
                    $updateBalance['remaining'] = $getBalance->remaining + $total_days;
                    $this->leave_model->updateTable('leave_balance', $updateBalance, $updateWhereBalance);
                    //Ins Record Array for Apply Leave
                    $updateRecord = array();
                    $updateRecord['status'] = 2;
                    $updateRecord['approve_reject_by'] = $user_id;
                    $updateRecord['approve_reject_at'] = date("Y-m-d H:i:s");
                    $this->leave_model->updateTable('apply_leave', $updateRecord, array("id" => $leaveId));
                }
                //Transaction End
                $this->db->trans_complete();
                $trans_status = $this->db->trans_status();
                if ($trans_status == FALSE) {
                    $this->db->trans_rollback();
                    $response['status'] = "fail";
                    $response['message'] = "Something Went Wrong.";
                } else {
                    $this->db->trans_commit();
                    $response['status'] = "success";
                    $response['message'] = "You have successfully applied for leave";
                }
            }
            echo json_encode($response);
            exit;
        }
    }

    public function deleteApplyLeave()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $this->ion_auth->user()->row()->id;
            $leaveId = $this->input->post('dataId');
            $leaveOldRecord = $this->leave_model->select_where("*", "apply_leave", array("id" => $leaveId, 'status' => 0))->row();
            if (empty($leaveOldRecord)) {
                $response['status'] = "fail";
                $response['message'] = "You can only delete pending leaves";
            } else {
                //Transaction Start
                $this->db->trans_start();
                $total_days = $leaveOldRecord->total_days;
                //Update Array
                $updateWhereBalance['user_id'] = $leaveOldRecord->user_id;
                $updateWhereBalance['hospital_id'] = $leaveOldRecord->hospital_id;
                $updateWhereBalance['leave_type_id'] = $leaveOldRecord->leave_type_id;
                $getBalance = $this->leave_model->select_where("*", "leave_balance", $updateWhereBalance)->row();
                $updateBalance['availed'] = $getBalance->availed - $total_days;
                $updateBalance['remaining'] = $getBalance->remaining + $total_days;
                $this->leave_model->updateTable('leave_balance', $updateBalance, $updateWhereBalance);
                //Delete Record from Apply Leave
                $this->leave_model->deleteTable('apply_leave', array("id" => $leaveId));
                //Transaction End
                $this->db->trans_complete();
                $trans_status = $this->db->trans_status();
                if ($trans_status == FALSE) {
                    $this->db->trans_rollback();
                    $response['status'] = "fail";
                    $response['message'] = "Something Went Wrong.";
                } else {
                    $this->db->trans_commit();
                    $response['status'] = "success";
                    $response['message'] = "You have successfully applied for leave";
                }
            }
            echo json_encode($response);
            exit;
        }
    }

    public function leaveStatus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $hospital_id = $this->input->post('hospital_id');
            $role_id = $this->input->post('role_id');
            $leaveType = $this->input->post('leave_type_id');
            $status = $this->input->post('leave_status');
            $whereArray['hospital_id'] = $hospital_id;
            $whereArray['role_id'] = $role_id;
            $whereArray['leave_type_id'] = $leaveType;
            $getLeaveType = $this->leave_model->select_where("*", "leave_group_types", $whereArray)->row();

//            echo "<pre>";print_r($_POST);exit;
            $dataRecord['status'] = $status;
            if (empty($getLeaveType)) {
                //Add Case
                $dataRecord['hospital_id'] = $hospital_id;
                $dataRecord['role_id'] = $role_id;
                $dataRecord['leave_type_id'] = $leaveType;
                if (isset($_POST['days']))
                    $dataRecord['days'] = $this->input->post('days');
                if (isset($_POST['carry_forward']))
                    $dataRecord['carry_forward'] = $this->input->post('carry_forward');
                if (isset($_POST['max']))
                    $dataRecord['max'] = $this->input->post('max');
                if (isset($_POST['earned_leave']))
                    $dataRecord['earned_leave'] = $this->input->post('earned_leave');

                $chkRecord = $this->leave_model->addRecord('leave_group_types', $dataRecord);
            } else {
                //Update Case
                if (isset($_POST['days']))
                    $dataRecord['days'] = $this->input->post('days');
                if (isset($_POST['carry_forward']))
                    $dataRecord['carry_forward'] = $this->input->post('carry_forward');
                if (isset($_POST['max']))
                    $dataRecord['max'] = $this->input->post('max');
                if (isset($_POST['earned_leave']))
                    $dataRecord['earned_leave'] = $this->input->post('earned_leave');

                $chkRecord = $this->leave_model->updateTable('leave_group_types', $dataRecord, $whereArray);
            }
            if ($chkRecord) {
                $response['status'] = "success";
                $response['message'] = "Status changed successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "Failed to add record. Please try again";
            }
            echo json_encode($response);
            exit;
        }
    }

    public function userHospitalLeaves()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $this->ion_auth->user()->row()->id;
            $hospital_id = $this->input->post('hospital_id');
            $getAllLeaves = $this->leave_model->userHospitalLeaves($hospital_id, $user_id);
            if (!empty($getAllLeaves)) {
                $response['status'] = "success";
                $response['leaves'] = $getAllLeaves;
                $response['message'] = "Status changed successfully";
            } else {
                $response['status'] = "fail";
                $response['message'] = "No Leave Assign in Hospital";
            }
            echo json_encode($response);
            exit;
        }
    }


}