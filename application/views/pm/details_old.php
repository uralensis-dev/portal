<?php
if(count($message)>0):?>
<?php 
$ci = & get_instance();
$ci->load->database();
$output = '';
$message_id = $message['privmsg_id'];
$check_data = $ci->db->query('SELECT * FROM privmsgs WHERE privmsg_id = "'.intval($message_id).'"')->result_array();

// $reply_data = $ci->pm_model->get_parent_reply($message['privmsg_id']);
foreach ($check_data as $row) {
    $output .= '
    <div class="panel panel-primary">
    <div class="panel-heading">By <b>' . uralensis_get_username($row["privmsg_author"]) . '</b> on <i>' . $row["privmsg_date"] . '</i></div>
    <div class="panel-body"><b>Subject:</b> ' . $row["privmsg_subject"] . '<br><b>Message:</b> '. $row["privmsg_body"] . '</div>
   </div>
 ';
    $output .= get_reply_comment($message, $row["privmsg_id"]);
}
echo $output;

?>
<?php else:?>
	<div class="alert alert-danger">No message found.</div>
<?php endif;?>

<?php 
function get_reply_comment($message, $parent_id = 0, $marginleft = 0)
{
	$ci = & get_instance();
    $ci->load->database();
    
	$reply_data = $ci->pm_model->get_parent_reply($parent_id);
    $output = '';
    
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 48;
    }
        foreach ($reply_data as $row) {

            $output .= '
   <div class="panel panel-info" style="margin-left:' . $marginleft . 'px">
    <div class="panel-heading">By <b>' . uralensis_get_username($row["privmsg_author"]) . '</b> on <i>' . $row["privmsg_date"] . '</i></div>
    <div class="panel-body"><b>Subject:</b> ' . $row["privmsg_subject"] . '<br><b>Message:</b> '. $row["privmsg_body"] . '</div>
   </div>
   ';
            $output .= get_reply_comment($message, $row["privmsg_id"], $marginleft);
        }
    
    return $output;
}
// echo get_reply_comment(0, $message, $marginleft = 0);
?>