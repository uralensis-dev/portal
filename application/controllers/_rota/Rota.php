<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * @package    CI
 * @subpackage Controller
 * @author     Uralensis <firebug.j@gmail.com>
 * @version    1.0.0
 */
class Rota extends CI_Controller {
    /**
     * Constructor to load models and helpers
     */

    private $h_data = array('styles' => array('newtheme/css/jquery.timepicker.min.css', 'newtheme/css/rota_custom.css'));
    private $f_data = array('javascripts' => array('newtheme/plugins/timepicker/jquery.timepicker.js', 'newtheme/js/multiselect.min.js', 'js/rota/app.js'));

    public function __construct() {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->load->model('_rota/RotaModel', 'rota');
        $this->load->helper(array('form', 'url', 'file', 'cookie','activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function index($team_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->data['dataSet'] = getTeamsByGroupId($group_id = '', $team_id);
        $this->data['rota_inner_category'] = $this->rota->getRotaInnerCategoryList();

        $this->load->view('templates/header-new.php', $this->h_data);
        $this->load->view('_rota/rota.php', $this->data);
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function cut_up($team_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->view('templates/header-new.php', $this->h_data);

        if ($this->uri->segment(4) != '') {
            $this->data['dataSet'] = getTeamsByGroupId($group_id = '', $team_id, 'Cut Up');
            $this->data['rota_inner_category'] = $this->rota->getRotaInnerCategoryList();
        } else {
            $this->data['dataSet'] = array();
        }
        $this->data['rota_type'] = 'Cut Up';
        $this->load->view('_rota/rota.php', $this->data);

        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function embedding($team_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('templates/header-new.php', $this->h_data);
        if ($this->uri->segment(4) != '') {
            $this->data['dataSet'] = getTeamsByGroupId($group_id = '', $team_id, 'Embedding');
            $this->data['rota_inner_category'] = $this->rota->getRotaInnerCategoryList();
        } else {
            $this->data['dataSet'] = '';
        }

        $this->load->view('_rota/rota.php', $this->data);
        $this->data['rota_type'] = 'Embedding';
        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function sectioning($team_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->view('templates/header-new.php', $this->h_data);

        if ($this->uri->segment(4) != '') {
            $this->data['dataSet'] = getTeamsByGroupId($group_id = '', $team_id, 'Sectioning');
            $this->data['rota_inner_category'] = $this->rota->getRotaInnerCategoryList();
        } else {
            $this->data['dataSet'] = array();
        }
        $this->data['rota_type'] = 'Sectioning';
        $this->load->view('_rota/rota.php', $this->data);

        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function booking_in($team_id = '') {

        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('templates/header-new.php', $this->h_data);

        if ($this->uri->segment(4) != '') {
            $this->data['dataSet'] = getTeamsByGroupId($group_id = '', $team_id, 'Booking In');
            $this->data['rota_inner_category'] = $this->rota->getRotaInnerCategoryList();
        } else {
            $this->data['dataSet'] = array();
        }
        $this->data['rota_type'] = 'Booking In';
        $this->load->view('_rota/rota.php', $this->data);

        $this->load->view('templates/footer-new.php', $this->f_data);
    }

    public function getTeamsForRota($group_id = '') {
        $group_id = $this->input->post('group_id');
        if ($group_id != '') {
            $teams = getTeamsByGroupId($group_id);
            if (!empty($teams)) {
                $count = 1;
                foreach ($teams as $team) {
                    if ($count == 1) {
                        $class = 'active';
                    } else {
                        $class = '';
                    }
                    $html = '';
                    $html .= '<li id="" class="' . $class . '" onclick="return toggleSubMenu(' . $team['team_id'] . ')">
                                <a href="javascript:void(0)">' . $team['team_name'] . '<span class="fa fa-chevron-down pull-right"></span></a>
                                <ul class="children" id="' . $team['team_id'] . '">
                                    <li><a href="' . $team['team_leader'] . '"><strong>Leader: </strong> ' . $team['leader_first_name'] . ' ' . $team['leader_last_name'] . '</a></li>
                                    <li><a href="' . $team['deputy_team_leader'] . '"><strong>Deputy: </strong> ' . $team['deputy_first_name'] . ' ' . $team['deputy_last_name'] . '</a></li>';
                    $temMembers = $this->rota->getUserDetails(@explode(",", $team['team_member']));
                    if (!empty($temMembers)) {
                        foreach ($temMembers as $lead) {
                            $html .= '<li><a href="' . $lead['user_id'] . '">' . $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] . '</a></li>';
                        }
                    }
                    $html .= '</ul>
                            </li>';

                    $count++;
                }
                echo $html;
                return;
            }
        }
    }

    public function save_rota() {
        $rotaID = $this->input->post('event_id');
        $rota = array();
        $segment3 = $this->input->post('uri_segment_3');
        $segment4 = $this->input->post('uri_segment_4');

        if (null !== ($this->input->post('Delete')) && $this->input->post('Delete') == 'Delete') {
            $this->db->where('event_id', $this->input->post('event_id'));
            $this->db->delete('tbl_events');
            $this->session->set_flashdata('tckSuccessMsg', 'Rota Deleted...');
            redirect('_rota/rota/' . $segment3 . '/' . $segment4, 'refresh');
        }

        $rotaData['user_type'] = $this->input->post('type');
        $rotaData['team_id'] = $this->input->post('team_id');
        $rotaData['team_name'] = $this->input->post('team_name');
        $rotaData['user_id'] = $this->input->post('user_id');
        $rotaData['user_name'] = $this->input->post('user_name');
        $rotaData['event_category'] = $this->input->post('event_category');
        $rotaData['date_of_event'] = $this->input->post('date_of_event');
        $rotaData['start_time_of_rota'] = $this->input->post('start_time_of_rota');
        $rotaData['end_time_of_rota'] = $this->input->post('end_time_of_rota');
        $rotaData['rota_type'] = $this->input->post('rota_type');
        $isUpdate = FALSE;
        if ($rotaID != '' && $rotaID != 0) {
            $rotaData['modified_by'] = $this->ion_auth->user()->row()->id;
            $rotaData['modified_at'] = date('Y-m-d H:i:s');
            $this->rota->updateRota($rotaData, $rotaID);
            $isUpdate = TRUE;
        } else {
            $rotaData['created_by'] = $this->ion_auth->user()->row()->id;
            $rota = $this->rota->saveRota($rotaData);
        }


        $this->session->set_flashdata('inserted', TRUE);
        if ($isUpdate) {
            $this->session->set_flashdata('tckSuccessMsg', 'Rota Updated...');
        } else {
            $this->session->set_flashdata('tckSuccessMsg', 'Rota Added...');
        }
        redirect('_rota/rota/' . $segment3 . '/' . $segment4, 'refresh');
    }

    public function getEvents() {
        echo json_encode(getAllEvents($this->input->post('user_id')), JSON_PRETTY_PRINT);
        die();
    }

    public function daywise($team_id = '') {
        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('templates/header-new.php', $this->h_data);

        $this->data['dataSet'] = getTeamsByGroupId($group_id = '', $team_id);
        $this->data['rota_inner_category'] = $this->rota->getRotaInnerCategoryList();

        $this->load->view('_rota/rota_day', $this->data);

        $this->load->view('templates/footer-new.php', $this->f_data);
    }
    public function monthly() {
        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('templates/header-new.php', $this->h_data);


        $this->load->view('_rota/rota_month', $this->data);

        $this->load->view('templates/footer-new.php', $this->f_data);
    }

}
