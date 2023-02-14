<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top: -65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding: 0;
    }

    .btn-default {
        background: #f5f5f5 !important;
    }

    .breadcrumb {
        padding: 0 !important
    }

    .tg-cancel input {
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }

    .avatar > img {
        border-radius: 50%;
        display: block;
        overflow: hidden;
        width: 100%;
        height: 40px;
    }

    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/

    @media screen and (min-width: 1600px) {
        body {
            font-size: 18px;
        }
    }

    @media screen and (max-width: 1580px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }

        div.dataTables_wrapper div.dataTables_length select {
            top: -59px;
        }
    }

    ol.breadcrumb {
        float: left;
    }
</style>
<div class="clearfix"></div>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h3 class="page-title">Users</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item active">Show User Activity</li>
            </ul>
        </div>
        
        <div class="clearfix"></div>
    </div>
</div>

    <div class="row report_listing" id="report-list-table">
        <div class="col-md-12">
            <div class="flag_message"></div>
            <table id="admin_users_activities" class="table table-striped custom-table" cellspacing="0" width="100%"
                   style="margin-top:0px">
                <thead>
                <tr>
                    <th>User</th>
                    <th>IP</th>
                    <th>URL</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($usersLogins as $uDetail) { ?>
                    <tr>
                        <td>
                            <h2 class="table-avatar">
                                <a href="#" class="avatar dashboard_admin">
                                    <img alt="" class="profile-pic"
                                         src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                <a href="#client-profile"><?php echo $uDetail->first_name." ".$uDetail->last_name; ?>
                                    <span><?php echo $this->ion_auth->get_users_groups($uDetail->track_session_userid)->row()->description; ?></span></a>
                            </h2>
                        </td>
                        <td><?php echo $uDetail->user_activity_ip; ?></td>
                        <td><?php echo $uDetail->request_uri; ?></td>
                        <td><?php echo $uDetail->module; ?></td>
                        <td><?php echo $uDetail->description; ?></td>
                        <td><?php echo date("d-M-Y h:i A", strtotime($uDetail->timestamp)); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- 
<script type="text/javascript">
    $('.flags_check span.tg-radio.first').hover(
          function () {
            $(".flags_check span.tg-radio").show();
          },
          function () {
            $('.flags_check span.tg-radio').hide();
            $('.flags_check span.tg-radio.first').show();
          });
</script> -->