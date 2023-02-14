<!-- Page Content -->
<style type="text/css">
    .custom_badge_tat .bg-success {
        background: #92dd59;
        box-shadow: unset;
    }
    .dataTables_processing.card{
        display: none;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Leaves Requests</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Leaves Requests</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div id="hospital_18" class="all_leave_show" style="">

    <!--    <div class="row">-->
    <!--        <div class="col-md-12">-->
    <!--            --><?php
    //            $attributes = array('id' => 'leaveTypeFilterForm');
    //            echo form_open(current_url(), $attributes);
    //            ?>
    <!--            <input type="hidden" name="filter_status" value="1">-->
    <!--            --><?php //if (!empty($isMultiple)) { ?>
    <!--                <div class="col-md-4 form-group">-->
    <!--                    <label>Hospital<span class="text-danger">*</span></label>-->
    <!--                    <select class="select" id="leave_hospital_filter" name="leave_hospital_filter">-->
    <!--                        <option>Select Hospital</option>-->
    <!--                        --><?php //foreach ($userHospitals as $userHospital) { ?>
    <!--                            <option value="--><?php //echo $userHospital->id; ?><!--" -->
    <?php //echo($userHospital->id == $hospital_id ? "selected" : ""); ?><!--<?php //echo $userHospital->hospital_name; ?><!--</option>-->
    <!--                        --><?php //} ?>
    <!--                    </select>-->
    <!--                </div>-->
    <!--            --><?php //} else { ?>
    <!--                <input class="form-control" type="hidden" id="leave_hospital_filter" name="leave_hospital_filter"-->
    <!--                       value="--><?php //echo $usersLeaves[0]->hospital_id; ?><!--">-->
    <!--            --><?php //} ?>
    <!--            <div class="col-md-4 form-group">-->
    <!--                <label>Leave<span class="text-danger">*</span></label>-->
    <!--                <select class="select" id="leave_code_filter" name="leave_code_filter">-->
    <!--                    <option value="">Select Leave</option>-->
    <!--                    --><?php //if (empty($isMultiple)) {
    //                        foreach ($usersLeaves as $leaves) { ?>
    <!--                            <option value="--><?php //echo $leaves->id; ?><!--" -->
    <?php //echo($leaves->id == $leave_type_id ? "selected" : ""); ?><!--<?php //echo $leaves->name; ?><!--</option>-->
    <!--                        --><?php //}
    //                    } ?>
    <!--                </select>-->
    <!--            </div>-->
    <!--            --><?php //echo form_close(); ?>
    <!--        </div>-->
    <!---->
    <!--    </div>-->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="admin_users_datatable" class="table table-striped custom-table mb-0 simpletable">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Hospital Name</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Leaves</th>
                        <th>Status</th>
                        <th>Date Applied</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $leavesTotal = 0;
                    foreach ($userAllLeaves as $userLeave) { ?>
                        <tr id="leave_tr_<?php echo $userLeave->id; ?>">
                            <td>
                                <h2 class="table-avatar">
                                    <a href="#" class="avatar dashboard_admin">
                                        <img alt="" class="profile-pic"
                                             src="<?php echo get_profile_picture($userLeave->profile_picture_path, $userLeave->first_name, $userLeave->last_name); ?>"></a>
                                    <a href="#client-profile"><?php echo  $userLeave->first_name." ".$userLeave->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($userLeave->user_id)->row()->description; ?></span></a>
                                </h2>
                            </td>
                            <td><?php echo $userLeave->hospital_name; ?></td>
                            <td><?php echo $userLeave->name; ?></td>
                            <td><?php echo date("d-M-Y", strtotime($userLeave->start_date)); ?></td>
                            <td><?php echo date("d-M-Y", strtotime($userLeave->end_date)); ?></td>
                            <td class="text-center">
                                <a class="custom_badge_tat">
                                    <span class="badge bg-success"> <?php echo $userLeave->total_days;
                                        $leavesTotal = $leavesTotal + $userLeave->total_days; ?></span>
                                </a>
                            </td>
                            <td>
                                <?php
                                $status = $class = "";
                                if ($userLeave->status == 0) {
                                    $status = "Pending";
                                    $class = "warning";
                                } else if ($userLeave->status == 1) {
                                    $status = "Approved";
                                    $class = "success";
                                } else if ($userLeave->status == 2) {
                                    $status = "Rejected";
                                    $class = "danger";
                                }
                                ?>
                                <span class="status-badge badge badge-<?php echo $class; ?>"><?php echo $status; ?></span>
                            </td>
                            <td><?php echo date("d-M-Y h:i A", strtotime($userLeave->applied_date)); ?></td>
                            <td>
                                <?php if ($status == "Pending") { ?>
                                    <div class="action-btns">
                                        <span style="color:green;">
                                            <img class="btn-approve" data-id="<?php echo $userLeave->id; ?>"
                                             data-status="approve" data-toggle="tooltip" data-placement="top" title=""
                                             data-original-title="Approve"
                                             src="<?php echo base_url(); ?>assets/img/correct.png" />

                                        </span>
                                        <span style="color:red;padding-left: 15px">
                                            <img class="btn-reject" data-id="<?php echo $userLeave->id; ?>"
                                             data-status="reject" data-toggle="tooltip" data-placement="top" title=""
                                             data-original-title="Reject"
                                             src="<?php echo base_url(); ?>assets/img/cross.png" />
                                        </span>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <!--                    <tr>-->
                    <!--                        <td colspan="4" style="text-align: center">Total Leaves</td>-->
                    <!--                        <td class="text-center">-->
                    <!--                            <a class="custom_badge_tat">-->
                    <!--                                <span class="badge bg-success">-->
                    <?php //echo $leavesTotal; ?><!--</span>-->
                    <!--                            </a>-->
                    <!--                        </td>-->
                    <!--                        <td colspan="3"></td>-->
                    <!--                    </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="leave_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply For Leave</h5>
                    <input type="hidden" id="min_date" value="01-01-<?php echo date("Y"); ?>"/>
                    <input type="hidden" id="max_date" value="31-12-<?php echo date("Y"); ?>"/>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $attributes = array('id' => 'editLeaveTypeForm');
                    echo form_open('', $attributes);
                    ?>
                    <input class="form-control" type="hidden" id="form_status" name="form_status">
                    <input class="form-control" type="hidden" id="edit_leave_id" name="edit_leave_id">
                    <div class="row">
                        <?php if (!empty($isMultiple)) { ?>
                            <div class="col-md-4 form-group">
                                <label>Hospital<span class="text-danger">*</span></label>
                                <select class="select" id="leave_hospital" name="leave_hospital">
                                    <option>Select Hospital</option>
                                    <?php foreach ($userHospitals as $userHospital) { ?>
                                        <option value="<?php echo $userHospital->id; ?>"><?php echo $userHospital->hospital_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } else { ?>
                            <input class="form-control" type="hidden" id="leave_hospital" name="leave_hospital"
                                   value="<?php echo $usersLeaves[0]->hospital_id; ?>">
                        <?php } ?>
                        <div class="col-md-4 form-group">
                            <label>Leave<span class="text-danger">*</span></label>
                            <select class="select" id="leave_code" name="leave_code">
                                <option>Select Leave</option>
                                <?php if (empty($isMultiple)) {
                                    foreach ($usersLeaves as $leaves) { ?>
                                        <option value="<?php echo $leaves->id; ?>"><?php echo $leaves->name; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Start End Date</label>
                            <input class="form-control datepicker range2Picker" type="text" name="start_end_date"
                                   id="start_end_date" readonly/>
                        </div>
                        <!--                    <div class="col-md-4">-->
                        <!--                        <label class="form-label">To</label>-->
                        <!--                        <input class="form-control datepicker" type="text" name="end_date" id="end_date"/>-->
                        <!--                    </div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Notes <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" id="leave_remarks" name="leave_remarks"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-rounded submit-btn">Submit</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom_badge_tat .badge {
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            border-radius: 50px;
            width: 38px;
            height: 38px;
            line-height: 2.25
        }

        .custom_badge_tat .bg-success {
            font-size: 14px;
            background: #92dd59;
            color: #fff;
        }
    </style>
