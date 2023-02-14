<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="message_center">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="pull-right">
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <button data-toggle="modal" data-target="#compose_mail" class="btn btn-danger btn-sm btn-block" role="button">COMPOSE</button>
            <hr />
            <ul class="nav nav-pills nav-stacked" role="tablist">
                <li role="presentation" class="active">
                    <a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">
                        <span class="badge pull-right"><?php echo count($inbox_msg); ?></span>
                        Inbox 
                    </a>
                </li>
                <li role="presentation">
                    <a href="#sent_mail" aria-controls="sent_mail" role="tab" data-toggle="tab">
                        <span class="badge pull-right"><?php echo count($sent_msg); ?></span>
                        Sent
                    </a>
                </li>
                <li role="presentation">
                    <a href="#mail_trash" aria-controls="mail_trash" role="tab" data-toggle="tab">
                        <span class="badge pull-right"><?php echo count($trash_msg); ?></span>
                        Trash
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="inbox">
                    <div class="list-group">
                        <?php
                        if (!empty($inbox_msg)) {
                            $desc_content = 1;
                            foreach ($inbox_msg as $inbox) {
                                ?>
                                <div class="list-group-item">
                                    <span class="name" style="min-width: 120px; display: inline-block;">
                                        <strong>
                                            <?php
                                            $fname = $this->ion_auth->user($inbox->privmsg_author)->row()->first_name;
                                            $lname = $this->ion_auth->user($inbox->privmsg_author)->row()->last_name;
                                            echo $fname . ' ' . $lname;
                                            ?>
                                        </strong>
                                    </span>
                                    <span class=""><?php echo $inbox->privmsg_subject; ?></span>
                                    <span class="text-muted" style="font-size: 11px;"> - <?php echo substr($inbox->privmsg_body, 0, 40) . '....'; ?></span>
                                    <span class="badge"><?php echo date('M j Y - h:i A', strtotime($inbox->privmsg_date)); ?></span>
                                    <span class="pull-right">
                                        <span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#inbox_desc_<?php echo $desc_content; ?>" style="cursor:pointer;"></span>
                                        <span class="glyphicon glyphicon-trash trash_inbox" data-trashinboxid="<?php echo $inbox->privmsg_id; ?>" style="cursor:pointer;"></span>
                                    </span>
                                </div>
                                <div id="inbox_desc_<?php echo $desc_content; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Message Content</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo $inbox->privmsg_body; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                                $desc_content++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="sent_mail">
                    <div class="list-group">
                        <?php
                        if (!empty($sent_msg)) {
                            $desc_content = 1;
                            foreach ($sent_msg as $sent) {
                                ?>
                                <div class="list-group-item">
                                    <span class="name" style="min-width: 120px; display: inline-block;">
                                        <strong>
                                            <?php
                                            $fname = $this->ion_auth->user($sent->pmto_recipient)->row()->first_name;
                                            $lname = $this->ion_auth->user($sent->pmto_recipient)->row()->last_name;
                                            echo 'To : ' . $fname . ' ' . $lname;
                                            ?>
                                        </strong>
                                    </span>
                                    <span><?php echo $sent->privmsg_subject; ?></span>
                                    <span class="text-muted" style="font-size: 11px;"> - <?php echo substr($sent->privmsg_body, 0, 40) . '....'; ?></span>
                                    <span class="badge"><?php echo date('M j Y - h:i A', strtotime($sent->privmsg_date)); ?></span>
                                    <span class="pull-right">
                                        <span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#sent_desc_<?php echo $desc_content; ?>" style="cursor:pointer;"></span>
                                        <span class="glyphicon glyphicon-trash trash_sent" data-trashsentid="<?php echo $sent->privmsg_id; ?>" style="cursor:pointer;"></span>
                                    </span>
                                </div>
                                <div id="sent_desc_<?php echo $desc_content; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Message Content</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo $sent->privmsg_body; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                                $desc_content++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="mail_trash">
                    <div class="list-group">
                        <?php
                        if (!empty($trash_msg)) {
                            foreach ($trash_msg as $trash) {
                                ?>
                                <div class="list-group-item">
                                    <span class="name" style="min-width: 120px; display: inline-block;">
                                        <?php
                                        $fname = $this->ion_auth->user($trash->pmto_recipient)->row()->first_name;
                                        $lname = $this->ion_auth->user($trash->pmto_recipient)->row()->last_name;
                                        echo $fname . ' ' . $lname;
                                        ?>
                                    </span>
                                    <span><?php echo $trash->privmsg_subject; ?></span>
                                    <span class="text-muted" style="font-size: 11px;"> - <?php echo substr($trash->privmsg_body, 0, 40) . '....'; ?></span>
                                    <span class="badge"><?php echo date('M j Y - h:i A', strtotime($trash->privmsg_date)); ?></span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="compose_mail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Compose Message</h4>
            </div>
            <div class="modal-body">
                <div class="compose_msg"></div>
                <form class="form" id="pm_message_form">
                    <div class="form-group">
                        <label for="send_mail">Check To Send Mail : </label>
                        <input type="checkbox" value="send_mail" name="send_mail">
                    </div>
                    <div class="form-group">
                        <label for="list_users">Select User</label>
                        <select class="form-control" name="list_users" id="list_users">
                            <option value="0">Choose User</option>
                            <?php
                            if (!empty($list_users)) {
                                foreach ($list_users as $users) {
                                    ?>
                                    <option value="<?php echo $users->id; ?>"><?php echo $users->first_name . ' ' . $users->last_name; ?></option>
                                    <?php
                                }//endforeach
                            }//endif
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="msg_subject">Subject</label>
                        <input class="form-control" type="text" name="msg_subject" id="msg_subject">
                    </div>
                    <div class="form-group">
                        <label for="msg_description">Description - (Only 250 Characters Allowed.)</label>
                        <textarea maxlength="250" rows="5" class="textarea form-control" name="msg_description" id="msg_description"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="send_message" class="btn btn-danger">Send Message!</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>