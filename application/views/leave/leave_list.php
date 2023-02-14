<!-- Page Content -->
<style type="text/css">
    .no_after_dropdown .dropdown-toggle::after{display: none;}
    .custom_badge_tat .bg-success {
        background: #92dd59;
        box-shadow: unset;
    }

    .profile-widget {
        background-color: transparent !important;
        border: none !important;
        border-radius: 4px;
        margin-bottom: 30px;
        padding: 20px;
        text-align: center;
        position: relative;
        box-shadow: none !important;
        overflow: hidden;
    }

    .dataTables_processing.card {
        display: none;
    }

    .hospital-container {
        position: absolute;
        left: 0.6rem;
        top: 0.5rem;
        display: inline;
    }

    .hospital-info {
        border: 2px solid #0192E6;
        display: inline;
        padding: 6px 4px;
        border-radius: 600px;
        font-size: 0.75rem;
        color: #0192E6;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Employee Leaves</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Employee Leaves</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
<!--            <a href="javascript:;" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>-->

            <a href="#" class="btn btn-primary btn-rounded btn-sm pull-right" data-toggle="modal"
               data-target="#add_leave_modal">Apply Leave</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="hospital_18" style="">
    <div class="profile-widget">
        <div class="hospital-container">
            <?php foreach ($userHospitals as $userHospital) { ?>
                <div data-toggle="tooltip" data-placement="top" title=""
                     class="hospital-info hos_open" data-id="<?php echo $userHospital->id; ?>"
                     data-original-title="<?php echo $userHospital->hospital_name; ?>"><?php echo $userHospital->first_initial . $userHospital->last_initial ?></div>
            <?php } ?>
            <!--                                <div data-toggle="tooltip" data-placement="top" title="" class="hospital-info" data-original-title="Newlife Hospital">NH</div>-->
        </div>
    </div>
    <div class="total_leave_show">
        <?php $groupId = $this->ion_auth->get_users_groups($user_id)->row()->id;

        if ($groupId == 1) { ?>
            <?php if (!empty($usersLeaveBalance)) { ?>
                <div class="row all_leave_show" id="hospital_<?php echo $userHospital->id; ?>">
                    <div class="col-md-6 npl">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title form-group">Total Leaves :</h4>
                                <div class="time-list">
                                    <div class="clearfix"></div>

                                    <?php foreach ($usersLeaveBalance as $userLeave) {
                                        ?>
                                        <div class="dash-stats-list">
                                            <h4><?php echo $userLeave->quota; ?></h4>
                                            <p><?php echo $userLeave->name; ?></p>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 npl">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title form-group">Leaves Taken:</h4>
                                <div class="time-list">
                                    <div class="clearfix"></div>
                                    <?php foreach ($usersLeaveBalance as $userLeave) {
                                        $leaveDataEncode = base64_encode($userLeave->user_id . "_" . $userLeave->hospital_id . "_" . $userLeave->leave_type_id);
                                        ?>
                                        <div class="dash-stats-list">
                                            <h4>
                                                <?php echo $userLeave->availed; ?>
                                            </h4>
                                            <p><?php echo $userLeave->name; ?></p>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?php $counter = 1;
            foreach ($userHospitals as $userHospital) { ?>
                <div class="row all_leave_show" id="hospital_<?php echo $userHospital->id; ?>"
                     style="display: <?php echo($counter == 1 ? "" : "none") ?>">
                    <?php if (!empty($usersLeaveBalance)) { ?>
                        <div class="col-md-6 npl">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title form-group">Total Leaves :</h4>
                                    <div class="time-list">
                                        <div class="clearfix"></div>

                                        <?php foreach ($usersLeaveBalance as $userLeave) {
                                            if ($userLeave->hospital_id == $userHospital->id) {
                                                ?>
                                                <div class="dash-stats-list">
                                                    <h4><?php echo $userLeave->quota; ?></h4>
                                                    <p><?php echo $userLeave->name; ?></p>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 npl">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title form-group">Leaves Taken:</h4>
                                    <div class="time-list">
                                        <div class="clearfix"></div>
                                        <?php foreach ($usersLeaveBalance as $userLeave) {
                                            if ($userLeave->hospital_id == $userHospital->id) {
                                                $leaveDataEncode = base64_encode($userLeave->user_id . "_" . $userLeave->hospital_id . "_" . $userLeave->leave_type_id);
                                                ?>
                                                <div class="dash-stats-list">
                                                    <h4>
                                                        <?php echo $userLeave->availed; ?>
                                                    </h4>
                                                    <p><?php echo $userLeave->name; ?></p>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php $counter++;
            } ?>
        <?php } ?>


    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $attributes = array('id' => 'leaveTypeFilterForm');
        echo form_open(current_url(), $attributes);
        ?>
        <input type="hidden" name="filter_status" value="1">
        <div class="row">
            <?php if (!empty($isMultiple)) { ?>
                <div class="col-md-4 form-group">
                    <label>Hospital<span class="text-danger">*</span></label>
                    <select class="select" id="leave_hospital_filter" name="leave_hospital_filter">
                        <option value="0">Select Hospital</option>
                        <?php foreach ($userHospitals as $userHospital) { ?>
                            <option value="<?php echo $userHospital->id; ?>" <?php echo($userHospital->id == $hospital_id ? "selected" : ""); ?>><?php echo $userHospital->hospital_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } else { ?>
                <input class="form-control" type="hidden" id="leave_hospital_filter" name="leave_hospital_filter"
                       value="<?php echo $usersLeaves[0]->hospital_id; ?>">
            <?php } ?>

            <div class="col-md-4 form-group">
                <label>Leave<span class="text-danger">*</span></label>
                <select class="select" id="leave_code_filter" name="leave_code_filter">
                    <option value="">Select Leave</option>
                    <?php
                    foreach ($allLeaveTypes as $leaves) { ?>
                        <option value="<?php echo $leaves->id; ?>" <?php echo($leaves->id == $leave_type_id ? "selected" : ""); ?>><?php echo $leaves->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>

</div>
<div class="row">
    <div class="col-md-12 mb-4">
        <strong>Select Leave Type : </strong>
        <button class="btn btn-light btn-sm leave_type_filter" data-toggle="tooltip" data-placement="top" title="Annual Leave" data-id="1">
            <img style="width: 50px;" src="<?php echo base_url(); ?>assets/icons/annual_leave.svg">
        </button>
        <button class="btn btn-light btn-sm leave_type_filter" data-toggle="tooltip" data-placement="top" title="Sick Leave" data-id="2">
            <img style="width: 50px;" src="<?php echo base_url(); ?>assets/icons/sick_leave.svg">
        </button>
        <button class="btn btn-light btn-sm leave_type_filter" data-toggle="tooltip" data-placement="top" title="Maternity Leave" data-id="4">
            <img style="width: 50px;" src="<?php echo base_url(); ?>assets/icons/maternity_leave.svg">
        </button>
        <button class="btn btn-light btn-sm leave_type_filter" data-toggle="tooltip" data-placement="top" title="Paternity Leave" data-id="5">
            <img style="width: 50px;" src="<?php echo base_url(); ?>assets/icons/parental_leave.svg">
        </button>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped" id="leaves_datatable">
                <thead>
                <tr>
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
                    <tr>
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
                                $status = "Approved ".($userLeave->approve_flag==1?"Up ":"P ");
                                $class = "success";
                            } else if ($userLeave->status == 2) {
                                $status = "Rejected";
                                $class = "danger";
                            }
                            ?>
                            <div class="dropdown action-label no_after_dropdown">
                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-dot-circle-o status-badge text-<?php echo $class;?>"></i> <span class="status-text"><?php echo $status; ?></span>
                                </a>
                            </div>
                        </td>
                        <td><?php echo date("d-M-Y h:i A", strtotime($userLeave->applied_date)); ?></td>
                        <td>
                            <?php
                            if ($userLeave->status == 0) { ?>
<!--                                <a href="javascript:void(0)" data-target="#leave_modal" class="edit-icon"-->
<!--                                   data-toggle="modal">-->
<!--                                    <i class="fa fa-pencil edit_leave"-->
<!--                                       data-id="--><?php //echo $userLeave->id; ?><!--"-->
<!--                                       data-leave="--><?php //echo $userLeave->leave_type_id ?><!--"-->
<!--                                       data-dates="--><?php //echo date("d-m-Y", strtotime($userLeave->start_date)) . " - " . date("d-m-Y", strtotime($userLeave->end_date)); ?><!--"-->
<!--                                       data-notes="--><?php //echo $userLeave->notes; ?><!--">-->
<!--                                    </i>-->
<!--                                </a>-->
                                <div class="dropdown dropdown-action">
                                    <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item edit_leave" href="javascript:;" data-target="#leave_modal" data-toggle="modal"
                                           data-id="<?php echo $userLeave->id; ?>" data-leave="<?php echo $userLeave->leave_type_id ?>" data-hospital="<?php echo $userLeave->hospital_id ?>"
                                           data-dates="<?php echo date("d-m-Y", strtotime($userLeave->start_date)) . " - " . date("d-m-Y", strtotime($userLeave->end_date)); ?>" data-notes="<?php echo $userLeave->notes; ?>">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item deleteApplyLeave" data-id="<?php echo $userLeave->id; ?>" href="javascript:;" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" style="text-align: center">Total Leaves</td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td class="text-center">
                        <a class="custom_badge_tat">
                            <span class="badge bg-success"><?php echo $leavesTotal; ?></span>
                        </a>
                    </td>
                    <td colspan="3"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Leave Modal -->
<div id="add_leave_modal" class="modal custom-modal fade" role="dialog">
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
                $attributes = array('id' => 'addLeaveTypeForm');
                echo form_open('', $attributes);
                ?>
                <input class="form-control" type="hidden" id="form_status" name="form_status">
                <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                <div class="row">
                    <?php if (!empty($isMultiple)) { ?>
                        <div class="col-md-4 form-group">
                            <label>Hospital<span class="text-danger">*</span></label>
                            <select class="select-add-leave leave_hospital" id="leave_hospital" name="leave_hospital">
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
                        <select class="select-add-leave" id="leave_code" name="leave_code">
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
                <button class="btn btn-primary btn-rounded">Submit</button>
                <?php echo form_close(); ?>
            </div>
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
                            <select class="select leave_hospital" id="edit_leave_hospital" name="leave_hospital">
                                <option value="0">Select Hospital</option>
                                <?php foreach ($userHospitals as $userHospital) { ?>
                                    <option value="<?php echo $userHospital->id; ?>"><?php echo $userHospital->hospital_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <input class="form-control" type="hidden" id="edit_leave_hospital" name="leave_hospital"
                               value="<?php echo $usersLeaves[0]->hospital_id; ?>">
                    <?php } ?>
                    <div class="col-md-4 form-group">
                        <label>Leave<span class="text-danger">*</span></label>
                        <select class="select" id="edit_leave_code" name="leave_code">
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
                               id="edit_start_end_date" readonly/>
                    </div>
                    <!--                    <div class="col-md-4">-->
                    <!--                        <label class="form-label">To</label>-->
                    <!--                        <input class="form-control datepicker" type="text" name="end_date" id="end_date"/>-->
                    <!--                    </div>-->
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Notes <span class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control" id="edit_leave_remarks" name="leave_remarks"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary btn-rounded submit-btn">Submit</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Delete Leave Modal -->
<div class="modal custom-modal fade" id="delete_approve" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Leave</h3>
                    <p>Are you sure want to delete this leave?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary btn-delete-leave continue-btn" data-leave="" data-id="" data-status="">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Leave Modal -->
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
