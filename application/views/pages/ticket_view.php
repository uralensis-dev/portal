<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="chat-main-row" style='margin-top:30px'>
        <div class="chat-main-wrapper">
            <div class="col-lg-8 message-view task-view">
                <div class="chat-window">
                    <div class="fixed-header">
                        <div class="navbar">
                            <div class="float-left ticket-view-details">
                                <div class="ticket-header">
                                <?php switch($ticketData['ticket_data'][0]['ticket_status']){
                                        case 'open':
                                            ?><span>Status: </span> <span class="badge badge-info">New / Open</span> <?php
                                        break;
                                        case 're_open':
                                            ?><span>Status: </span> <span class="badge badge-info">Re-Open</span> <?php
                                        break;
                                        case 'hold':
                                            ?><span>Status: </span> <span class="badge badge-warning">Hold</span> <?php
                                        break;
                                        case 'closed':
                                            ?><span>Status: </span> <span class="badge badge-success">Closed</span> <?php
                                        break;
                                        case 'in_progress':
                                            ?><span>Status: </span> <span class="badge badge-info">In Progress</span> <?php
                                        break;
                                        case 'cancelled':
                                            ?><span>Status: </span> <span class="badge badge-danger">Cancelled</span> <?php
                                        break;
                                        default:
                                        ?><span>Status: </span> <span class="badge badge-warning">-</span> <?php
                                        break;
                                
                                    }?>
                                    <span class="m-l-15 text-muted">Created: </span>
                                    <span><?php echo date("d M Y h:i A",strtotime($ticketData['ticket_data'][0]['ticket_created_on']))." ".timeagoCustom($ticketData['ticket_data'][0]['ticket_created_on'])?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-contents">
                        <div class="chat-content-wrap">
                            <div class="chat-wrap-inner">
                                <div class="chat-box">
                                    <div class="task-wrapper">
                                    <?php 
                                        if($this->session->flashdata('error') === true){
                                            ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger show">
                                                        <p><?php echo $this->session->flashdata('tckSuccessMsg');?></p>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    <?php 
                                        if($this->session->flashdata('success') === true){
                                            ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-success show">
                                                        <p><?php echo $this->session->flashdata('tckSuccessMsg');?></p>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="project-title">
                                                    <div class="m-b-20">
                                                        <span class="h5 card-title "><?php echo $ticketData['ticket_data'][0]['ticket_subject'];?></span>
                                                        <div class="float-right ticket-priority"><span>Priority:</span>
                                                            <div class="btn-group">
                                                            <?php switch($ticketData['ticket_data'][0]['ticket_priority']){
                                                                    case 'normal':
                                                                        ?> <a href="javascript:void(0);" class="badge badge-success" data-toggle="dropdown">Normal </a><?php
                                                                    break;
                                                                    case 'high':
                                                                        ?> <a href="javascript:void(0);" class="badge badge-danger" data-toggle="dropdown">High </a><?php
                                                                    break;
                                                                    case 'critical':
                                                                        ?> <a href="javascript:void(0);" class="badge badge-danger" data-toggle="dropdown">Critical </a><?php
                                                                    break;
                                                            }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo $ticketData['ticket_data'][0]['ticket_message'];?>
                                            </div>
                                        </div>
                                        <?php if( !empty($ticketData['ticket_attach_data'])):?>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title m-b-20">Uploaded image files</h5>
                                                    <div class="row">
                                                        <?php
                                                        $imgCounter = 0;
                                                        foreach($ticketData['ticket_attach_data'] as $attachment):?>
                                                            <?php 
                                                            if (empty($attachment['attachment_path'])) continue;
                                                            $ext =  explode('.',$attachment['attachment_path']);
                                                            $ext = strtolower($ext[1]);
                                                                $imgArr = array( 'jpg','jpeg','png','gif');
                                                                if(in_array($ext,$imgArr)):
                                                                    $imgCounter++;
                                                                    ?>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="uploaded-box">
                                                                            <div class="uploaded-img">
                                                                                <img src="<?php echo base_url('/uploads/tickets/'.$attachment['attachment_path']);?>" class="img-fluid" alt="">
                                                                            </div>
                                                                            <div class="uploaded-img-name">
                                                                                <a href='<?php echo base_url('/uploads/tickets/'.$attachment['attachment_path']);?>' target='_blank' >
                                                                                <?php echo $attachment['attachment_name'];?></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php endif; ?>
                                                        <?php endforeach;?>
                                                        <?php if($imgCounter == 0){
                                                        ?><p class="ml-3">No Images Attached...</p><?php
                                                    }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-0">
                                                <div class="card-body">
                                                    <h5 class="card-title m-b-20">Uploaded files</h5>
                                                    <ul class="files-list">
                                                    <?php 
                                                    $count = 0;
                                                    foreach($ticketData['ticket_attach_data'] as $attachment):
                                                       ?>
                                                        <?php 
                                                        if (empty($attachment['attachment_path'])) continue;
                                                        $ext =  explode('.',$attachment['attachment_path']);
                                                        $ext = strtolower($ext[1]);
                                                            $imgArr = array( 'doc','docx','pdf');
                                                            if(in_array($ext,$imgArr)):
                                                                $count++;
                                                                ?>
                                                                <li>
                                                                    <div class="files-cont">
                                                                        <div class="file-type">
                                                                            <span class="files-icon"><i class="fa <?php echo ($ext == 'pdf')?"fa-file-pdf-o":"fa-file-text-o";?>"></i></span>
                                                                        </div>
                                                                        <div class="files-info">
                                                                            <span class="file-name text-ellipsis"><a href="<?php echo base_url('/uploads/tickets/'.$attachment['attachment_path']);?>" target='_blank'><?php echo $attachment['attachment_name'];?></a></span>
                                                                            <span class="file-author"><span class="file-date"><?php  echo date("d M Y h:i A",$attachment['attachment_added_on'])." ".timeagoCustom($attachment['attachment_added_on']);?></span>                                                                            </div>
                                                                    </div>
                                                                </li>
                                                        <?php endif; ?>
                                                    <?php endforeach;?>
                                                    <?php if($count == 0){
                                                        ?><p>No Files Attached...</p><?php
                                                    }?>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="notification-popup hide">
                                        <p>
                                            <span class="task"></span>
                                            <span class="notification-text"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 message-view task-chat-view ticket-chat-view" id="task_window">
                <div class="chat-window">
                    <div class="fixed-header">
                        <?php if($this->ion_auth->is_admin()):?>    
                            <div class="navbar">
                                <div class="task-assign">
                                    <span class="assign-title">Assigned to </span> 
                                    <?php if(!empty($ticketAssignee)):
                                        $counter = 1;?>
                                        <?php foreach($ticketAssignee as $assignee):?>
                                                <a href="javascript:void();" data-toggle="tooltip" data-placement="bottom" title="" class="avatar" data-original-title="<?php echo $assignee['enc_first_name'].' '. $assignee['enc_last_name']?>">
                                                <?php echo $assignee['enc_first_name'][0].$assignee['enc_last_name'][0];?></a>
                                        <?php endforeach;?>
                                    <?php else:?>
                                        <?php echo "<span class='badge badge-danger'>No One</span>";?>
                                    <?php endif;?>

                                </div>
                                <a href="#" class="followers-add pull-right" title="Add Assignee" data-toggle="modal" data-target="#assignee"><i class="material-icons">add</i></a>
                            </div>
                        <?php endif;?>
                        <div class="navbar">
                            <div class="task-assign">
                                <span class="assign-title">Comments</span> 
                            </div>
                        </div>
                    </div>
                    <div class="chat-contents task-chat-contents">
                        <div class="chat-content-wrap">
                            <div class="chat-wrap-inner">
                                <div class="chat-box">
                                    <div class="chats">
                                        <?php if(!empty($ticketCommentData)):?>
                                            <?php foreach($ticketCommentData as $comment):?>
                                                <div class="chat <?php echo ($this->ion_auth->user()->row()->id == $comment['ticket_comment_addedBy'])?"chat-right":"chat-left";?>">
                                                    <div class="chat-body">
                                                        <div class="chat-bubble">
                                                            <div class="chat-content">
                                                                <span class="task-chat-user">
                                                                    <?php if(($this->ion_auth->user()->row()->id == $comment['ticket_comment_addedBy'])){
                                                                        echo "You";
                                                                        echo "<a href='".site_url('tickets/deleteComment/'.$comment['ticket_comment_id']."/".$comment['comment_ticket_id'])."' class='pull-right text-danger'><i class='fa fa-times'></i> </a>";
                                                                    }else{
                                                                        echo  $comment['enc_first_name']." ".$comment['enc_last_name'];
                                                                    }?>
                                                                </span> 
                                                                <span class="chat-time"><small><?php echo timeagoCustom($comment['ticket_comment_addedOn']);?></small></span>
                                                                
                                                                <p><?php echo $comment['ticket_comment_text'];?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-footer">
                        <div class="message-bar">
                            <div class="message-inner">
                                <div class="message-area">
                                        <?php
                                        $attributes = array('method' => 'POST','enctype'=>"multipart/form-data");
                                        echo form_open("tickets/addComment/", $attributes);
                                        ?>
                                        <div class="input-group">
                                            <input type='hidden' name ="ticketID" value='<?php echo $ticketID;?>'/> 
                                            <textarea class="form-control" placeholder="Type message..." name='commentText' required></textarea>
                                            <span class="input-group-append">
                                                <button class="btn btn-primary" type="butsubmitton"><i class="fa fa-send"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Assignee Modal -->
<div id="assignee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign to this task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group m-b-30">
                    <input placeholder="Search to add" class="form-control search-input" type="text" id='s_str'>
                    <input type="hidden" id='ticket_id' value='<?php echo $ticketID?>'>
                    <span class="input-group-append">
                        <button class="btn btn-primary" id='search_user'>Search</button>
                    </span>
                </div>
                <div id='user-list-cont'></div>
            </div>
        </div>
    </div>
</div>
<!-- /Assignee Modal -->
