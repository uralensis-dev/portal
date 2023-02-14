<style>
    /* The alert message box */
    .alert {
        padding: 20px;
        background-color: #4CAF50; /* Red */
        color: white;
        margin-bottom: 15px;
    }

    /* The close button */
    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .unread{
        background: rgba(255, 0, 0, 0.1);
    }
    tr.unread:hover,tr.read:hover{
        background: rgba(0, 255, 0, 0.1) !important;
    }
    /* When moving the mouse over the close button */
    .closebtn:hover {
        color: black;
    }
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title"> <?php
                if($this->uri->segment(2)=="index" or $this->uri->segment(2)=="inbox"){echo "Inbox";}
                if($this->uri->segment(2)=="sent"){echo "Sent";}
                if($this->uri->segment(2)=="draft"){echo "Draft";}
                if($this->uri->segment(2)=="deleted"){echo "Trash";}
                ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('auth/index'); ?>">Dashboard</a></li>
                <?php ?>
                <li class="breadcrumb-item active">
                    <?php
                    if($this->uri->segment(2)=="index" or $this->uri->segment(2)=="inbox"){echo "Inbox";}
                    if($this->uri->segment(2)=="sent"){echo "Sent";}
                    if($this->uri->segment(2)=="draft"){echo "Draft";}
                    if($this->uri->segment(2)=="deleted"){echo "Trash";}
                    ?>
                </li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo site_url('pm/compose'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Compose</a>

        </div>

    </div>
</div>
<!-- /Page Header -->
<?php if ($type == 1) { ?>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Message has been deleted!!
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="email-header">
                    <div class="row">
                        <div class="col top-action-left">
                            <div class="float-left">
                                <div class="btn-group dropdown-action">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Select <i class="fa fa-angle-down "></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item action-select" data-value="all" href="#">All</a>
<!--                                        <a class="dropdown-item" href="#">None</a>-->
<!--                                        <div class="dropdown-divider"></div>-->
                                        <a class="dropdown-item action-select" data-value="read" href="#">Read</a>
                                        <a class="dropdown-item action-select" data-value="unread" href="#">Unread</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown-action">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                        Actions <i class="fa fa-angle-down "></i></button>
                                    <div class="dropdown-menu">
                                        <!--<a class="dropdown-item" href="#">All</a>
                                        <a class="dropdown-item" href="#">None</a>
                                        <div class="dropdown-divider"></div> -->
                                        <a class="dropdown-item" href="javascript:" onclick="markasread(1)">Mark As
                                            Read</a>
                                        <a class="dropdown-item" href="javascript:" onclick="markasread(0)">Mark As
                                            Unread</a>
                                    </div>
                                </div>
                                <!--<div class="btn-group dropdown-action">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down "></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Reply</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Archive</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Mark As Read</a>
                                        <a class="dropdown-item" href="#">Mark As Unread</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown-action">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> <i class="fa fa-angle-down"></i></button>
                                    <div role="menu" class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Social</a>
                                        <a class="dropdown-item" href="#">Forums</a>
                                        <a class="dropdown-item" href="#">Updates</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Spam</a>
                                        <a class="dropdown-item" href="#">Trash</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">New</a>
                                    </div>
                                </div>-->
                                <div class="btn-group dropdown-action">
                                    <button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                                        <i class="fa fa-tags"></i> <i class="fa fa-angle-down"></i></button>
                                    <div role="menu" class="dropdown-menu">
                                        <?php
                                        $getLabels = getRecords("*", "privmsgs_labels", array("created_by" => $this->ion_auth->user()->row()->id));
                                        foreach ($getLabels as $rec) {

                                            ?>
                                            <a class="dropdown-item" href="javascript:"
                                               onclick="markaslabeled(<?php echo $rec->id ?>)"><?php echo $rec->name ?></a>
                                        <?php } ?>
                                        <!--<a class="dropdown-item" href="#">Family</a>
                                        <a class="dropdown-item" href="#">Social</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Primary</a>
                                        <a class="dropdown-item" href="#">Promotions</a>
                                        <a class="dropdown-item" href="#">Forums</a>-->
                                    </div>
                                </div>
                            </div>
                            <!--<div class="float-left d-none d-sm-block">
                                <input type="text" placeholder="Search Messages" class="form-control search-message">
                            </div>-->
                        </div>
                        <div class="col-auto top-action-right">
                            <div class="text-right">
                                <button type="button" title="Refresh" data-toggle="tooltip" onclick="location.reload();"
                                        class="btn btn-white d-none d-md-inline-block"><i class="fa fa-refresh"></i>
                                </button>
<!--                                <div class="btn-group">-->
<!--                                    <a class="btn btn-white"><i class="fa fa-angle-left"></i></a>-->
<!--                                    <a class="btn btn-white"><i class="fa fa-angle-right"></i></a>-->
<!--                                </div>-->
                            </div>
<!--                            <div class="text-right">-->
<!--                                <span class="text-muted d-none d-md-inline-block">Showing 10 of 112 </span>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="email-content">
                    <div class="table-responsive">
                        <table class="table table-inbox table-hover" id="">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="checkbox-all" onclick="toggle(this)">
                                </th>
                                <th>Label</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //debug($messages);exit;
                            for ($i = 0; $i < count($messages); $i++):

                                $checkread = getRecords("*", "privmsgs_to", array("pmto_message" => $messages[$i][TF_PM_ID], "pmto_recipient" => $this->ion_auth->user()->row()->id));
                                if ($checkread[0]->pmto_read == 1) {
                                    $class = "read";
                                } else {
                                    $class = "unread";
                                }

                                if ($label_id != "") {
                                    $checkIsLabel = getRecords("COUNT(*) AS TOTROWS", "privmsgs_labels_id", array("message_id" => $messages[$i][TF_PM_ID], "label_id" => $label_id));

                                    $labledmails = $checkIsLabel[0]->TOTROWS;

                                } else {
                                    $labledmails = 1;

                                }


                                if ($labledmails > 0) {


                                    $jointable = array("privmsgs_labels" => "privmsgs_labels.id=privmsgs_labels_id.label_id");
                                    $checkedlabel = getRecords("name", "privmsgs_labels_id", array("message_id" => $messages[$i][TF_PM_ID]), "", "", $jointable);
                                    $labelName = "";
                                    foreach ($checkedlabel as $reclbl) {

                                        $labelName .= $reclbl->name . ",";
                                    }
                                    $labelName = substr($labelName,0,-1);


                                    ?>
                                    <tr class="user-email-card <?php echo $class ?>" data-status='<?php echo $class; ?>'>
                                        <td>
                                            <input type="checkbox" class="checkmail"
                                                   id="emails<?php echo $messages[$i][TF_PM_ID] ?>" name="emails"
                                                   value="<?php echo $messages[$i][TF_PM_ID] ?>"
                                                   onclick="toggleme(this,<?php echo $messages[$i][TF_PM_ID] ?>)">
                                        </td>
                                        <td><span class="mail-important"><span
                                                        style="background-color: BLUE;color:WHITE"><?php echo $labelName ?></span></span>
                                        </td>
                                        <td class="name"><?php
                                            if ($type != MSG_SENT) echo $messages[$i][TF_PM_AUTHOR];
                                            else {
                                                $recipients = $messages[$i][PM_RECIPIENTS];
                                                foreach ($recipients as $recipient)
                                                    echo (next($recipients)) ? $recipient . ', ' : $recipient;
                                            } ?>
                                        </td>
                                        <td class="subject"><a
                                                    href='<?php echo site_url() . '/pm/message/' . $messages[$i][TF_PM_ID]; ?>'><?php echo $messages[$i][TF_PM_SUBJECT] ?></a>
                                        </td>
                                        <td>
                                            <?php
                                            $resultBody = implode(' ', array_slice(explode(' ', $messages[$i][TF_PM_BODY]), 0, 10));
//                                             $resultBody = substr($messages[$i][TF_PM_BODY], 0, 20);
                                            echo $resultBody;
//                                             echo (!empty($resultBody) ? $resultBody." ....":"");
                                            ?>
                                        </td>
                                        <td class="mail-date"><?php echo $messages[$i][TF_PM_DATE]; ?></td>
                                    </tr>
                                <?php } endfor; ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="messages_id" id="messages_id"/>
<script>


    function toggle(source) {

        checkboxes = window.document.getElementsByName('emails');
        var idstring = "";
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            //alert(checkboxes[i].value);
            idstring += checkboxes[i].value + ",";
            checkboxes[i].checked = source.checked;
            if (checkboxes[i].checked) {
                window.document.getElementById("messages_id").value = idstring;
            } else {
                var messags = window.document.getElementById("messages_id").value;
                messags = messags.replace(checkboxes[i].value + ",", "");
                window.document.getElementById("messages_id").value = messags;

            }
        }


    }

    function toggleme(source, id) {
        checkboxes = window.document.getElementById('emails' + id);
        var idstring = "";
        if (checkboxes.checked) {
            idstring += id + ",";
            window.document.getElementById("messages_id").value += idstring;
        } else {
            var messags = window.document.getElementById("messages_id").value;
            messags = messags.replace(id + ",", "");
            window.document.getElementById("messages_id").value = messags;
        }


    }


</script>