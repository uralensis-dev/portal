<!-- Page Header -->


<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">View Message</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">View Message</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo site_url('pm/compose'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Compose</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<?php
$ci = &get_instance();
$ci->load->database();
$output = '';
$message_id = $message['privmsg_id'];
//$check_data = $ci->db->query('SELECT * FROM privmsgs WHERE privmsg_id = "' . intval($message_id) . '"')->result_array();
//foreach ($check_data as $row) {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="mailview-content">
                        <div class="mailview-header">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="text-ellipsis m-b-10">
                                        <span class="mail-view-title"><?php echo $message["privmsg_subject"] ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mail-view-action">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-white btn-sm" data-toggle="tooltip"
                                                    title="Delete" onClick="deleteMessage(<?php echo $message['privmsg_id'] ?>)"><i
                                                        class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-white btn-sm" data-toggle="tooltip"
                                                    title="Reply" onClick="replythis(<?php echo $message['privmsg_id'] ?>)"><i
                                                        class="fa fa-reply"></i></button>
                                            <!--<button type="button" class="btn btn-white btn-sm" data-toggle="tooltip" title="Forward"> <i class="fa fa-share"></i></button>-->
                                        </div>
                                        <!--<button type="button" class="btn btn-white btn-sm" data-toggle="tooltip" title="Print"> <i class="fa fa-print"></i></button>-->
                                    </div>
                                </div>
                            </div>


                            <div class="sender-info">
                                <div class="sender-img">
                                    <img width="40" alt="" src="<?php echo base_url()."/".$message['profile_picture_path'];?>"
                                         class="rounded-circle">
                                </div>
                                <div class="receiver-details float-left">
                                    <?php
                                    $user_id = $this->ion_auth->user()->row()->id;
                                    $searchArray = $message['recipients'];
                                    $pos = array_search($user_id, $message['recipients_ids']);
                                    unset($searchArray[$pos]);
                                    $searchArray = implode(",",$searchArray);
                                    ?>
                                    <span class="sender-name">From: <?php echo $message['privmsg_author']; ?></span>
                                    	<span class="receiver-name">
                                            <?php
                                            if($pos!==FALSE){
                                                echo "to me".(!empty($searchArray)?", ":"");
                                            }
                                            ?>
                                            <span><?php echo $searchArray;?></span>
                                        </span>
                                </div>
                                <div class="mail-sent-time">
                                    <span class="mail-time"><?php echo date("Y,m,d h:m", strtotime($message["privmsg_date"])) ?></span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="mailview-inner">
                            <?php echo $message["privmsg_body"] ?>
                        </div>

                    </div>
                    <?php
                    $getFiles = getRecords("*", "privmsgs_attachments", array("privmsgid" => $message["privmsg_id"], "is_deleted" => 0));


                    if (count($getFiles) > 0) {
                        echo "<br/><br/>";
                        ?>
                        <div class="mail-attachments">
                            <p><i class="fa fa-paperclip"></i> <?php echo count($getFiles) ?> Attachments -
                                <!--<a href="#">View all</a> | <a href="#">Download all</a>--></p>
                            <ul class="attachments clearfix">
                                <?php foreach ($getFiles as $rec) {


                                    ?>
                                    <li>
                                        <div class="attach-file"><i class="fa fa-file-pdf-o"></i></div>
                                        <div class="attach-info"><a
                                                    href="<?php echo base_url() ?>pm/downloadFile/<?php echo $rec->files ?>"
                                                    class="attach-filename"><?php echo $rec->files ?></a></div>
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>
                    <?php } ?>
                    <div class="mailview-footer">
                        <div class="row">
                            <div class="col-sm-6 left-action">
                                <button type="button" class="btn btn-white"
                                        onClick="replythis(<?php echo $message_id ?>)"><i class="fa fa-reply"></i> Reply
                                </button>
                                <!--<button type="button" class="btn btn-white"><i class="fa fa-share"></i> Forward</button>-->
                            </div>
                            <div class="col-sm-6 right-action">
                                <!--<button type="button" class="btn btn-white"><i class="fa fa-print"></i> Print</button>-->
                                <button type="button" class="btn btn-white"
                                        onClick="deleteMessage(<?php echo $message_id ?>)"><i class="fa fa-trash-o"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php //} ?>

<script>

    function replythis(message_id) {
        window.location.href = "<?php echo base_url()?>index.php/pm/compose/" + message_id;
    }

    function deleteMessage(message_id) {
        window.location.href = "<?php echo base_url()?>index.php/pm/delete/" + message_id;
    }


</script>