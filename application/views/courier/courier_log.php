<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$courierStatus = array(PENDING_PICKUP, DISPATCHED, DELIVERED, COURIERISSUE);
?>

<style type="text/css">

    .choose_courier_comp a, .choose_urgency a {
        background: #fff;
        color: #333;
        border-color: #ddd
    }
</style>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Courier Consignments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">View Courier Tracking</li>
                </ul>
            </div>
        </div>
    </div>


    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Search Filter -->
    <?php if(!$is_track){?>
        <form action="<?php echo site_url('addCourier/showCourierLog/'); ?>" method="GET" accept-charset="utf-8" class="form-group">
            <div class="row filter-row form-group">
                <!--            <div class="col-sm col">-->
                <!--                <div class="form-group form-focuss select-focus">-->
                <!--                    <label class="focus-label">Users</label>-->
                <!--                    <select class="select2 floating" name='users_list' name='users_list' style="width: 100%">-->
                <!--                        <option value=''> -- Select --</option>-->
                <!--                        --><?php //foreach ($usersList as $userData){?>
                <!--                            <option value='--><?php //echo $userData->user_id;?><!--' --><?php //echo ($userData->user_id==$_REQUEST['users_list'] ? "selected":""); ?><!--<?php //echo $userData->enc_first_name." ".$userData->enc_last_name;?><!--</option>-->
                <!--                        --><?php //}?>
                <!--                    </select>-->
                <!--                </div>-->
                <!--            </div>-->

                <div class="col-sm col-md-4">
                    <div class="form-group form-focus">
                        <!--                <div class="cal-icon">-->
                        <!--                    <input class="form-control floating datetimepicker" type="date" name='from_date'-->
                        <!--                           value='-->
                        <?php //echo (isset($_REQUEST['from_date']) && $_REQUEST['from_date'] != '') ? $_REQUEST['from_date'] : ''; ?><!--'>-->
                        <!--                </div>-->
                        <!--                <label class="focus-label">From</label>-->
                        <label class="form-label">
                            Consignment No.
                        </label>

                        <input class="form-control" type="text" name="consignment_no"
                               id="consignment_no" value="<?php echo $_REQUEST['consignment_no']; ?>"/>

                    </div>
                </div>
                <!--        <div class="col-sm col">-->
                <!--            <div class="form-group form-focus">-->
                <!--                <div class="cal-icon">-->
                <!--                    <input class="form-control floating datetimepicker" type="date" name='to_date'-->
                <!--                           value='--><?php //echo (isset($_REQUEST['to_date']) && $_REQUEST['to_date'] != '') ? $_REQUEST['to_date'] : ''; ?><!--'>-->
                <!--                </div>-->
                <!--                <label class="focus-label">To</label>-->
                <!--            </div>-->
                <!--        </div>-->
                <div class="col-sm col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type='submit' class="btn btn-success btn-block"> Search</button>
                </div>
            </div>
        </form>
    <?php }?>
    <!-- /Search Filter -->
    <div class="row form-group">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Sender</h2>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Organization</label>
                                </div>
                                <div class="col-md-8 s_organization"><?php echo $courier_log[0]->sender_company;?></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Person Name</label>
                                </div>
                                <div class="col-md-8 s_person"><?php echo $courier_log[0]->sender_email;?></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Contact Details</label>
                                </div>
                                <div class="col-md-8 s_phone"><?php echo $courier_log[0]->sender_phone_no;?></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-8 s_address1"><?php echo $courier_log[0]->sender_address1;?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Receiver</h2>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Organization</label>
                                </div>
                                <div class="col-md-8 r_organization"><?php echo $courier_log[0]->receiver_company;?></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Person Name</label>
                                </div>
                                <div class="col-md-8 r_person"><?php echo $courier_log[0]->receiver_email;?></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Contact Details</label>
                                </div>
                                <div class="col-md-8 r_phone"><?php echo $courier_log[0]->receiver_phone_no;?></div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-8 r_address1"><?php echo $courier_log[0]->receiver_address1;?></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row report_listing">
        <div class="col-md-12">
            <div class="flag_message"></div>
            <table id="admin_users_activities" class="table table-striped custom-table" cellspacing="0" width="100%"
                   style="margin-top:40px">
                <thead>
                <tr>
<!--                    <th>User</th>-->
                    <!--                    <th>Batch No.</th>-->
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($courier_log)) {
                    foreach ($courier_log as $uDetail) {
                        ?>
                        <tr class="">
<!--                            <td>-->
<!--                                <h2 class="table-avatar">-->
<!--                                    <a href="#" class="avatar dashboard_admin">-->
<!--                                        <img alt="" class="profile-pic"-->
<!--                                             src="--><?php //echo get_profile_picture($uDetail->profile_picture_path, $uDetail->enc_first_name, $uDetail->enc_last_name); ?><!--"></a>-->
<!--                                    <a href="#client-profile">--><?php //echo  $uDetail->enc_first_name ?><!-- <span>--><?php //echo  $this->ion_auth->get_users_groups($uDetail->user_id )->row()->description; ?><!--</span></a>                                    </h2>-->
<!--                            </td>-->

                            <td class=""><?php echo $uDetail->status;?></td>
                            <td class=""><?php echo date("d-M-Y h:i A",strtotime($uDetail->created_date)); ?></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- /Add Ticket Modal -->

