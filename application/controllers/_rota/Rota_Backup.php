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
    public function __construct() {

        parent::__construct();

        $this->load->model('Ion_auth_model');

        $this->load->model('_rota/RotaModel', 'rota');

        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));

        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function index() {



        if (!$this->ion_auth->logged_in()) {

            redirect('auth/login', 'refresh');
        }

        $this->load->view('_rota/inc/header-new');

        $this->load->view('_rota/rota', $dataSet);

        $this->load->view('_rota/inc/footer-new');
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
                    $html .= '<li id="" class="' . $class . '" onclick="return toggleSubMenu('.$team['team_id'].')">
                                <a href="#">' . $team['team_name'] . '<span class="fa fa-chevron-down pull-right"></span></a>
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
                die();
            }
        }
    }

}
