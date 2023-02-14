<?php

class Tasks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tasks_model');
        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        track_user_activity();
    }
    
    public function index()
    {
        $userid = $this->ion_auth->user()->row()->id;
        $groupid = $this->ion_auth->get_users_groups()->row()->id;
        $data = [];
        $this->load->view('templates/header-new');
        $this->load->view('tasks/dashboard', $data);
        $this->load->view('templates/footer-new');
    }
    
    public function api()
    {
        $userid = $this->ion_auth->user()->row()->id;
        $response = new stdClass();
        switch ($this->input->get('action')) {
            case 'create':
                $taskId = $this->Tasks_model->create_task([
                    'created_by' => $userid,
                    'status' => $this->input->post('status'),
                    'name' => $this->input->post('name'),
                    'due_date' => $this->input->post('due_date'),
                    'priority' => $this->input->post('priority')
                ]);
                $response->task = $this->Tasks_model->get_task($taskId);
                break;
            case 'assignees':
                $task_id = $this->input->get('task_id');
                $response->assignees = $this->Tasks_model->get_task_assignees($task_id);
                break;
            case 'assign':
                $assignment = [
                    'task_id' => $this->input->post('task_id'),
                    'user' => $this->input->post('user_id'),
                ];
                $this->Tasks_model->assign_task($assignment);
                //                $response->followers = $this->Tasks_model->get_task_followers($assignment['task_id']);
                break;
            case 'list':
            default:
                $response->tasks = $this->Tasks_model->get_tasks($userid);
        }
        echo json_encode($response);
    }
    
}