<?php

class Tasks_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_tasks($user_id, $filter = NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $tasks = $this->db->join('user_tasks', 'tasks.id = user_tasks.task_id', 'left')
                          ->where('created_by', $user_id)
                          ->or_where('user_id', $user_id)
                          ->group_by('tasks.id')
                          ->get('tasks')
                          ->result();
        return $tasks;
    }
    
    public function get_task_assignees($task_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->select([
            "user_tasks.*",
            "AES_DECRYPT(username, '" . DATA_KEY . "') as username",
            "AES_DECRYPT(first_name, '" . DATA_KEY . "') as first_name",
            "AES_DECRYPT(last_name, '" . DATA_KEY . "') as last_name",
        ])
                        ->from('user_tasks')
                        ->where('task_id', $task_id)
                        ->join('users', 'user_id = users.id')
                        ->get()
                        ->result();
    }
    
    public function get_group_tasks($user_id, $filter = NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->get_where('tasks', ['created_by' => $user_id])->result();
    }
    
    public function create_task($task)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->db->insert('tasks', $task);
        
        return $this->db->insert_id();
    }
    
    public function get_task($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        return $this->db->get_where('tasks', ['id' => $id])->row();
    }
    
    public function get_stats($userid)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $statuses = [
            'Completed',
            'In Progress',
            'On Hold',
            'Pending',
            'Review'
        ];
        $stats = new stdClass();
        if ($this->isUserAdmin($userid)) {
            $stats->total = $this->db->query("SELECT count(*) as allTask from `tasks`")->result_array()[0]['allTask'];
            $current_date = date('Y-m-d H:i:s');
            $stats->overdue = $this->db->query("SELECT count(*) as overdueTask from `tasks` where due_date < '$current_date'")->result_array()[0]['overdueTask'];
            foreach ($statuses as $status) {
                $stats->status_counts[$status] = $this->db->query("SELECT count(*) as statusCount from `tasks` where `status` = '$status'")->result_array()[0]['statusCount'];
            }
        }
        else 
        {
            $stats->total = $this->db->join('user_tasks', 'tasks.id = user_tasks.task_id', 'left')
                                     ->where('created_by', $userid)
                                     ->or_where('user_id', $userid)
                                     ->group_by('tasks.id')
                                     ->count_all_results('tasks');
            $stats->overdue = $this->db->join('user_tasks', 'tasks.id = user_tasks.task_id', 'left')
                                       ->group_start()
                                       ->where('created_by', $userid)
                                       ->or_where('user_id', $userid)
                                       ->group_end()
                                       ->where('due_date <', date('Y-m-d H:i:s'))
                                       ->group_by('tasks.id')
                                       ->count_all_results('tasks');
            $stats->status_amounts = [];
            foreach ($statuses as $status) {
                $stats->status_counts[$status] = $this->db->join('user_tasks', 'tasks.id = user_tasks.task_id', 'left')
                                                          ->group_start()
                                                          ->where('created_by', $userid)
                                                          ->or_where('user_id', $userid)
                                                          ->group_end()
                                                          ->where('status', $status)
                                                          ->group_by('tasks.id')
                                                          ->count_all_results('tasks');
            }    
            
        }
        return $stats;
    }

    public function isUserAdmin($user_id = '') {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!empty($user_id)) {
            $sql = "SELECT * from users_groups where user_id = $user_id and group_id = 1";
            $res = $this->db->query($sql)->result_array();
            return count($res) != 0;
        }
    }
    
}