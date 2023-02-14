<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    /*div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top: -65px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding: 0;
    }*/
    .dropdown-toggle::after{display: none;}
    .btn-default {
        background: #f5f5f5 !important;
    }

    .breadcrumb {
        padding: 0 !important
    }

    .tg-cancel input {
        display: none;
    }
    div.dataTables_wrapper div.dataTables_length select{
        position: static;
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

        /*div.dataTables_wrapper div.dataTables_length select {
            top: -59px;
        }*/
    }

    ol.breadcrumb {
        float: left;
    }
</style>
<div class="clearfix"></div>
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">All Login Users</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:;">Dashboard</a></li>
                    <li class="breadcrumb-item active">All Login Users</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            $attributes = array('id' => 'loginFilterForm');
            echo form_open(current_url(), $attributes);
            ?>
            <input type="hidden" name="filter_status" value="1">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Searchable Date Range</label>
                    <input class="form-control datepicker range2Picker" type="text" name="start_end_date"
                           id="start_end_date" value="<?php echo $date_filtered;?>" readonly/>
                </div>
                <div class="col-3 filter-row">
                    <label class="form-label"></label>
                    <button href="javascript:void(0);" type="submit" class="btn btn-success btn-block">Search</button>
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>

    </div>

    <br/>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="row report_listing" id="report-list-table">
                <div class="col-md-12">
                    <div class="flag_message"></div>
                    <table id="admin_users_activities" class="table table-striped custom-table" cellspacing="0" width="100%"
                           style="margin-top:40px">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Login</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usersLogins as $uDetail) { ?>
                            <tr>
                                <!--                        <td>--><?php //echo $uDetail->first_name." ".$uDetail->last_name; ?><!--</td>-->
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar dashboard_admin">
                                            <img alt="" class="profile-pic"
                                                 src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                        <a href="#client-profile"><?php echo  $uDetail->first_name." ".$uDetail->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>
                                    </h2>
                                </td>
                                <td><?php echo $uDetail->session_identity; ?></td>
                                <td><?php echo date("d-M-Y h:i A", $uDetail->login_time); ?></td>
                                <td><?php echo $uDetail->client_ip; ?></td>
                                <td><?php echo $uDetail->country_name; ?></td>
<!--                                <td>--><?php //echo ip_info($uDetail->client_ip)['country']; ?><!--</td>-->
                                <td>
                                    <?php
                                    $innerText = $innerClass = "";
                                    if ($uDetail->remember == 0) {
                                        $innerText = "New IP";
                                        $innerClass = "warning";
                                    } else if ($uDetail->remember == 1) {
                                        $innerText = "Approved IP";
                                        $innerClass = "success";
                                    } else {
                                        $innerText = "Reported IP";
                                        $innerClass = "danger";
                                    }
                                    ?>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-<?php echo $innerClass;?>"></i> <?php echo $innerText; ?>
                                        </a>
                                    </div>
                                    <!--                            <span class="badge bg-inverse---><?php //echo $innerClass; ?><!--">--><?php //echo $innerText; ?><!--</span>-->

                                </td>
                                <td class="text-right">
                                    <?php
                                    $user_detail = base64_encode($uDetail->session_userid."___".$uDetail->client_ip);
                                    ?>
                                    <div class="dropdown dropdown-action">
                                        <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo base_url()."/".$route;?>getLoginDetail/<?php echo $user_detail;?>"><i class="fa fa-eye m-r-5"></i> Detail</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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