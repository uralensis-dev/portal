<?php

defined('BASEPATH') or exit('No direct script access allowed');



/**

 * Chat Controller

 *

 * @package    CI

 * @subpackage Controller

 * @author     Mohsin Raza

 * @version    1.0.0

 */

class Chat extends CI_Controller

{

    /**

     * Constructor to load models and helpers

     */

    public function __construct()

    {

        parent::__construct();

        $this->load->model('Ion_auth_model');

        $this->load->model('chat_model');

        $this->load->helper(array('form', 'url', 'file', 'activity_helper', 'dashboard_functions_helper', 'ec_helper'));

        track_user_activity(); //Track user activity function which logs user track actions.

    }
    function index()
    {

       
    
    $data["groups"] = getRecords("*","chat_groups");
     $this->load->view('chat/inc/header',$data);
     $this->load->view('chat/index', $data);
     $this->load->view('chat/inc/footer');
    }

function creatgroup()
{
     
 $this->db->insert('chat_groups', array('name' => $this->input->post('groupname'), 'created_by' =>  $this->session->userdata('chat_user_id')));
   $json['type'] = 'success';
           
            $json['msg'] = 'Record Added Successfuly';
            echo json_encode($json);
            die;
   
}

       function search_user()
 {
  sleep(2);
  if($this->input->post('search_query'))
  {
   $data = $this->chat_model->search_user_data($this->session->userdata('chat_user_id'), $this->input->post('search_query'));
   $output = array();
   if($data->num_rows() > 0)
   {
    foreach($data->result() as $row)
    {
     $request_status = $this->chat_model->Check_request_status($this->session->userdata('chat_user_id'), $row->user_id);
     $is_request_send = 'yes';
     if($request_status == '')
     {
      $is_request_send = 'no';
     } 
     else
     {
      if($request_status == 'pending')
      {
       $is_request_send = 'yes';
      }
     }
     if($request_status != 'Accept')
     {
      $output[] = array(
       'user_id'  => $row->user_id,
       'first_name' => $row->first_name,
       'last_name'  => $row->last_name,
       'profile_picture'=> $row->profile_picture,
       'is_request_send'=> $is_request_send
      );
     } 
    }
   }
   echo json_encode($output);
  }
 }

 function send_request()
 {
  sleep(2);
  if($this->input->post('send_userid'))
  {
   $data = array(
    'sender_id'  => $this->input->post('send_userid'),
    'receiver_id' => $this->input->post('receiver_userid'),
    'chat_request_status'=>'Pending'
   );
   $this->chat_model->Insert_chat_request($data);
  }
 }

 function load_notification()
 {
  sleep(2);
  if($this->input->post('action'))
  {
   $data = $this->chat_model->Fetch_notification_data($this->session->userdata('chat_user_id'));
  
   $output = array();
   if($data->num_rows() > 0)
   {
    foreach($data->result() as $row)
    {
     $userdata = $this->chat_model->Get_user_data($row->sender_id);

     $output[] = array(
      'user_id'  => $row->sender_id,
      'first_name' => $userdata['first_name'],
      'last_name'  => $userdata['last_name'],
      'profile_picture' => $userdata['profile_picture'],
      'chat_request_id' => $row->chat_request_id
     );
    }
   }
   echo json_encode($output);
  }
 }

 function accept_request()
 {
  if($this->input->post('chat_request_id'))
  {
   $update_data = array(
    'chat_request_status' => 'Accept'
   );
   $this->chat_model->Update_chat_request($this->input->post('chat_request_id'), $update_data);
  }
 }

 function load_chat_user()
 {
  sleep(2);
  if($this->input->post('action'))
  {
   $sender_id = $this->session->userdata('chat_user_id');
   $receiver_id = '';
   $data = $this->chat_model->Fetch_chat_user_data($sender_id);
   if($data->num_rows() > 0)
   {
    foreach($data->result() as $row)
    {
     if($row->sender_id == $sender_id)
     {
      $receiver_id = $row->receiver_id;
     }
     else
     {
      $receiver_id = $row->sender_id;
     }
     $userdata = $this->chat_model->Get_user_data($receiver_id);
     $output[] = array(
      'receiver_id'  => $receiver_id,
      'first_name'  => $userdata['first_name'],
      'last_name'   => $userdata['last_name'],
      'profile_picture' => $userdata['profile_picture']
     );
    }
   }
   echo json_encode($output);
  }
 }

 function send_chat()
 {
  if($this->input->post('receiver_id'))
  {
   $data = array(
    'sender_id'  => $this->session->userdata('chat_user_id'),
    'receiver_id' => $this->input->post('receiver_id'),
    'chat_messages_text' => $this->input->post('chat_message'),
    'chat_messages_status' => 'no',
    'chat_messages_datetime'=> date('Y-m-d H:i:s')
   );

   $this->chat_model->Insert_chat_message($data);
  }
 }

 function send_chat_group()
 {
  if($this->input->post('group_id'))
  {
   $data = array(
    'sender_id'  => $this->session->userdata('chat_user_id'),
    'group_id' => $this->input->post('group_id'),
    'chat_messages_text' => $this->input->post('chat_message'),
    'chat_messages_status' => 'no',
    'chat_messages_datetime'=> date('Y-m-d H:i:s')
   );

   $this->chat_model->Insert_chat_message_group($data);
 $group_id = $this->input->post('group_id');
 
     $date = date('D M Y H:i');
     $output[] = array(
         'message' =>$this->input->post('chat_message'),
      'timedate'  => $date, 
      'group_id'        =>$row->group_id
     );
   
   echo json_encode($output);

   
  }
 }


 function load_chat_data_group()
 {
  if($this->input->post('group_id'))
  {
   $group_id = $this->input->post('group_id');
   $sender_id = $this->session->userdata('chat_user_id');
  
   $chat_data = $this->chat_model->Fetch_chat_data_group($sender_id, $group_id);
   
   if($chat_data->num_rows() > 0)
   {
    foreach($chat_data->result() as $row)
    {
     $message_direction = '';
     if($row->sender_id == $sender_id)
     {
      $message_direction = 'left';
     }
     else
     {
      $message_direction = 'right';
     }
     $date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
     $output[] = array(
      'chat_messages_text' => $row->chat_messages_text,
      'chat_messages_datetime'=> $date,
      'message_direction'  => $message_direction,
      'group_id'        =>$row->group_id
     );
    }
   }
   echo json_encode($output);
  }
 }

 function load_chat_data()
 {
  if($this->input->post('receiver_id'))
  {
   $receiver_id = $this->input->post('receiver_id');
   $sender_id = $this->session->userdata('chat_user_id');
   if($this->input->post('update_data') == 'yes')
   {
    $this->chat_model->Update_chat_message_status($sender_id);
   }
   $chat_data = $this->chat_model->Fetch_chat_data($sender_id, $receiver_id);
   if($chat_data->num_rows() > 0)
   {
    foreach($chat_data->result() as $row)
    {
     $message_direction = '';
     if($row->sender_id == $sender_id)
     {
      $message_direction = 'right';
     }
     else
     {
      $message_direction = 'left';
     }
     $date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
     $output[] = array(
      'chat_messages_text' => $row->chat_messages_text,
      'chat_messages_datetime'=> $date,
      'message_direction'  => $message_direction
     );
    }
   }
   echo json_encode($output);
  }
 }

 function check_chat_notification()
 {
  if($this->input->post('user_id_array'))
  {
   $receiver_id = $this->session->userdata('chat_user_id');

   $this->chat_model->Update_login_data($this->input->post('is_type'),$this->input->post('receiver_id'));

   $user_id_array = explode(",", $this->input->post('user_id_array'));

   $output = array();

   foreach($user_id_array as $sender_id)
   {
    if($sender_id != '')
    {
     $status = "offline";
     $last_activity = $this->chat_model->User_last_activity($sender_id);

     $is_type = '';

     if($last_activity != '')
     {
      $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');

      $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

      if($last_activity > $current_timestamp)
      {
       $status = 'online';
       $is_type = $this->chat_model->Check_type_notification($sender_id, $receiver_id, $current_timestamp);
     
      }
     }

     $output[] = array(
      'user_id'  => $sender_id,
      'total_notification' => $this->chat_model->Count_chat_notification($sender_id, $receiver_id),
      'status'  => $status,
      'is_type'  => $is_type
     );
    }
   }
   echo json_encode($output);
  }
 }

}