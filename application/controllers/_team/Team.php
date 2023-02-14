<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller {


    private $h_data = array('styles' => array('newtheme/css/project_employee.css', 'css/team/style.css'));
    private $f_data = array('javascripts' => array('newtheme/js/multiselect.min.js', 'js/team/app.js'));

    public function __construct() {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('_team/TeamsModel', 'teams');
        $this->load->helper(array('form', 'url', 'file', 'cookie','activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function dashboard() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $dataSet['userList'] = $this->teams->getUsersList();
        $dataSet['rota_categories'] = $this->teams->getRotaCategoryList();
        $team_name = $group_id = $user_id = '';
        if ($_GET) {
            if ($this->input->get('team_name') != '') {
                $team_name = $this->input->get('team_name');
            }
            if ($this->input->get('group_id') != '') {
                $group_id = $this->input->get('group_id');
            }
            if ($this->input->get('user_id') != '') {
                $user_id = $this->input->get('user_id');
            }
        }
        $dataSet['teamList'] = $this->teams->getTeamList($team_name, $group_id, $user_id);
//        echo $this->db->last_query();
        $this->load->view('templates/header-new', $this->h_data);
        $this->load->view('_team/dashboard', $dataSet);
        $this->load->view('templates/footer-new', $this->f_data);
    }

    public function saveData() {
           $this->load->library('form_validation');
        $validationConfigArr = array(
            array('field' => 'team_name', 'label' => 'Team', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validationConfigArr);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', TRUE);
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('_team/team/dashboard/', 'refresh');
        } else {
            $teamID = $this->input->post('team_id');
            $teamData = array();
            $teamData['group_id'] = implode(',', $this->input->post('group_id'));
            $teamData['team_name'] = $this->input->post('team_name');
            $teamData['team_leader'] = $this->input->post('team_leader');
            $teamData['deputy_team_leader'] = implode(',', $this->input->post('deputy_team_leader'));
            $teamData['team_member'] = implode(',', $this->input->post('team_member'));
            $teamData['rota_type'] = $this->input->post('rota_type');
            $teamData['description'] = $this->input->post('description');
            $isUpdate = FALSE;
            if ($teamID != '' && $teamID != 0) {
                $teamData['modified_by'] = $this->ion_auth->user()->row()->id;
                $teamData['modified_at'] = date('Y-m-d H:i:s');
                $this->teams->updateTeam($teamData, $teamID);
                $isUpdate = TRUE;
            } else {
                $teamData['created_by'] = $this->ion_auth->user()->row()->id;
                $teamID = $this->teams->saveTeam($teamData);
            }


            $this->session->set_flashdata('inserted', TRUE);
            if ($isUpdate) {
                $this->session->set_flashdata('tckSuccessMsg', 'Team Updated...');
            } else {
                $this->session->set_flashdata('tckSuccessMsg', 'Team Added...');
            }
            redirect('_team/team/dashboard/', 'refresh');
        }
    }

    public function getTeamData($teamID = '') {
        $teamID = $this->input->post('teamID');
        $teamData = $this->teams->getTeamData($teamID);
        echo json_encode($teamData);
        die();
    }

    public function removeTeam() {
        $teamID = $this->input->post('team_id');
        if ($teamID != '' && is_numeric($teamID)) {
            $this->teams->removeTeam($teamID);
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('tckSuccessMsg', 'Team Removed...');
        } else {
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('tckSuccessMsg', 'In-Valid Team ID...');
        }
        $this->session->set_flashdata('inserted', TRUE);
        redirect('_team/team/dashboard/', 'refresh');
    }

    public function getUsers() {
        $groupID = $this->input->post('group_id');
        $userListData = $this->teams->getUsersList($groupID);
        echo json_encode($userListData);
        die();
    }

    public function get_users_by_id() {
        if (!empty($this->input->post())) {
            $userListData = $this->teams->getUsersList($this->input->post('IDs'));
            echo json_encode($userListData);
            die();
        } else {
            die('Invalid Request');
        }
    }

}
