<!-- Page Content -->
<style type="text/css">
    .custom-modal .modal-header {
        padding: 15px;
    }
</style>
<style type="text/css">
    .fa-file-o {
        position: absolute;
        left: -22px;
        border: 1px solid #ddd;
        width: 40px;
        height: 50px;
        text-align: center;
        line-height: 2.5;
        font-size: 20px;
        background: #f5f5f5;
    }

    span.tooltipIcon {
        position: absolute;
        top: 3px;
        left: 15px;
    }

    .tooltipIcon img {
        max-width: 14px;
    }

    button.add_temp {
        position: absolute;
        top: 0;
        right: 15px;
        bottom: 0px;
        padding: 0 5px;
        font-size: 24px;
        width: 35px;
        height: 50px;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .form-control {
        height: 50px;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-8">
            <h3 class="page-title">Leave Settings</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Leave Settings</li>
            </ul>
        </div>
        <!--        <div class="col-auto float-right ml-auto">-->
        <!--            <a href="javascript:;" class="btn btn-rounded add-btn" data-toggle="modal"-->
        <!--               data-target="#add_leave_modal"><i class="fa fa-plus"></i> Add Leave</a>-->
        <!--        </div>-->
    </div>
</div>
<!-- /Page Header -->


<!-- Add Leave Modal -->
<div id="add_leave_modal" class="modal custom-modal fade" role="dialog">
    <input type="hidden" id="get_csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" id="get_csrf_token_name" value="<?php echo $this->security->get_csrf_token_name(); ?>">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leave Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $attributes = array('id' => 'addLeaveTypeForm');
            echo form_open('', $attributes);
            ?>
            <div class="modal-body">
                <!--                <form id="addLeaveTypeForm">-->
                <div class="col-md-12">
                    <input class="form-control" type="hidden" id="form_status" name="form_status">
                    <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="leave_name" name="leave_name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Leave Code <span class="text-danger">*</span></label>
                            <select class="select" id="leave_code" name="leave_code">
                                <option>Select Leave Code</option>
                                <option value="J0001- Annual Leave">J0001- Annual Leave</option>
                                <option value="J0100- Annual Leave">J0100- Annual Leave</option>
                                <option value="J0200- Annual Leave">J0200- Annual Leave</option>
                                <option value="J0300 - Professional Leave">J0300 - Professional Leave</option>
                                <option value="J0400 - Study leave">J0400 - Study leave</option>
                                <option value="J0500 - Sick Leave">J0500 - Sick Leave</option>
                                <option value="J0600 - Maternity Leave">J0600 - Maternity Leave</option>
                                <option value="J0700 - Paternity Leave">J0700 - Paternity Leave</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Total Days (per year) <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="total_leaves" name="total_leaves">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Min. Days (single period) <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="min_leaves" name="min_leaves">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Max. Days (single period) <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="leave_stretch" name="leave_stretch">
                        </div>
                        <!--                            <div class="col-md-4 form-group">-->
                        <!--                                <label>Leave for Gender <span class="text-danger">*</span></label>-->
                        <!--                                <select class="select" id="leave_gender" name="leave_gender">-->
                        <!--                                    <option>Select Leave Gender</option>-->
                        <!--                                    <option value="male">Male</option>-->
                        <!--                                    <option value="female">Female</option>-->
                        <!--                                    <option value="both">Both</option>-->
                        <!--                                </select>-->
                        <!--                            </div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Notes <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" id="leave_remarks" name="leave_remarks"></textarea>
                        </div>
                    </div><!--

                        <div class="submit-section">
                            
                        </div> -->
                </div>
                <!--                </form>-->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-rounded submit-btn">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- /Add Leave Modal -->
<div class="doctorSCard">
    <div class="row">
<!--        <div class="col-sm-6 col-md-3">-->
<!--            <h4 class="title_specimen">Leave Groups </h4>-->
<!--        </div>-->
<!--        <div class="col-sm-6 col-md-3">-->
<!--            --><?php
//            $attributes = array('id' => 'leaveGroupForm');
//            echo form_open('', $attributes);
//            ?>
<!--            <div class="form-group" data-select2-id="100">-->
<!--                <i class="fa fa-file-o"></i>-->
<!---->
<!--                <select class="form-control leave_group" id="leave_group" name="leave_group">-->
<!--                    <option value="">Select Group</option>-->
<!--                    --><?php //foreach ($leaveGroups as $leave) { ?>
<!--                        <option value="--><?php //echo $leave->id; ?><!--" data-remarks="--><?php //echo $leave->remarks;?><!--" data-group="--><?php //echo $leave->group_id;?><!--">--><?php //echo $leave->name; ?><!--</option>-->
<!--                    --><?php //} ?>
<!--                </select>-->
<!--                <button type="button" class="btn btn-primary add_temp" data-toggle="dropdown" aria-expanded="false">-->
<!--                    <i class="fa fa-ellipsis-v"></i></button>-->
<!--                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"-->
<!--                     style="position: absolute; transform: translate3d(107px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">-->
<!--                    <a class="dropdown-item" id="add_group" href="javascript:void(0)" data-toggle="modal" data-target="#add_temp">-->
<!--                        <i class="fa fa-plus m-r-5"></i> Add</a>-->
<!--                    <a class="dropdown-item" id="edit_group" href="javascript:void(0)"><i-->
<!--                                class="fa fa-pencil m-r-5"></i> Edit</a>-->
<!--                    <a class="dropdown-item delete-group" href="javascript:void(0)"><i-->
<!--                                class="fa fa-trash-o m-r-5"></i> Delete</a>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--            --><?php //echo form_close(); ?>
<!---->
<!--        </div>-->
        <input type="hidden" id="is_check_admin" value="<?php echo (($this->ion_auth->is_admin()) ? 1 : 2)?>">
        <?php if($this->ion_auth->is_admin()) { ?>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus hospital-select-container">
                    <select class="floating select-hospital" name="hospital" id="select-hospital">
                        <option value="">Select Hospital</option>

                    </select>
                    <label class="focus-label">Hospital</label>
                </div>
            </div>
        <?php } else {?>
            <input type="hidden" class="select-hospital" value="<?php echo $hospital_id;?>">
        <?php } ?>
        <?php if($is_hospital_admin or $this->ion_auth->is_admin()) {?>
        <?php } ?>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus role-select-container">
                <select class="floating" name="groups" id="group-select">
                    <option value="">Select Role</option>
                </select>
                <label class="focus-label">Role</label>
            </div>
        </div>
        <!--        <div class="col-sm-6 col-md-3">-->
        <!--            <div class="row">-->
        <!--                <div class="col-md-9 col-lg-9  col-xl-9">-->
        <!--                    <button class="btn btn-success btn-block btn-lg search_btn barcode_no_search">Search</button>-->
        <!--                </div>-->
        <!-- <div class="col-md-3  col-lg-3 col-xl-3 nopadding">
            <i class="fa fa-cog fa-2x cog-class collapsed" data-toggle="collapse" data-target="#adv_searc_area" style="margin-right:5px" aria-expanded="false"></i>
            <a href="javascript:;" class="list_view_show"><i class="fa fa-bars fa-2x cog-class fa-th"></i></a>
        </div>  -->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</div>
<div class="row leave_div" style="display: none">
    <div class="col-md-12">
        <!-- Annual Leave -->
        <div class="card leave-box 1_leave" id="leave_annual">
            <?php
            $attributes = array('id' => 'annualLeaveForm');
            echo form_open('', $attributes);
            ?>
            <div class="card-body">
                <input type="hidden" value="1" class="leave_type_id" name="leave_type_id">
                <div class="h3 card-title with-switch">
                    Annual
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_annual"
                               checked="">
                        <label class="onoffswitch-label" for="switch_annual">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                <div class="leave-item">

                    <!-- Annual Days Leave -->
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <div class="form-group">
                                    <label>Days</label>
                                    <input type="text" class="form-control" name="days" disabled="">
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">Edit</button>
                        </div>
                    </div>
                    <!-- /Annual Days Leave -->

                    <!-- Carry Forward -->
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <label class="d-block">Carry forward</label>
                                <div class="leave-inline-form">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carry_forward"
                                               id="carry_no" value="0" disabled="">
                                        <label class="form-check-label" for="carry_no">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carry_forward"
                                               id="carry_yes" value="1" disabled="">
                                        <label class="form-check-label" for="carry_yes">Yes</label>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Max</span>
                                        </div>
                                        <input type="text" class="form-control" disabled="" name="max"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                    <!-- /Carry Forward -->

                    <!-- Earned Leave -->
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <label class="d-block">Earned leave</label>
                                <div class="leave-inline-form">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="earned_leave"
                                               id="earned_no" value="0" disabled="">
                                        <label class="form-check-label" for="earned_no">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="earned_leave"
                                               id="earned_yes" value="1" disabled="">
                                        <label class="form-check-label" for="earned_yes">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                    <!-- /Earned Leave -->

                </div>

                <!-- Custom Policy -->
                <!--                <div class="custom-policy">-->
                <!--                    <div class="leave-header">-->
                <!--                        <div class="title">Custom policy</div>-->
                <!--                        <div class="leave-action">-->
                <!--                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"-->
                <!--                                    data-target="#add_custom_policy"><i class="fa fa-plus"></i> Add custom policy-->
                <!--                            </button>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="table-responsive">-->
                <!--                        <table class="table table-hover table-nowrap leave-table mb-0">-->
                <!--                            <thead>-->
                <!--                            <tr>-->
                <!--                                <th class="l-name">Name</th>-->
                <!--                                <th class="l-days">Days</th>-->
                <!--                                <th class="l-assignee">Assignee</th>-->
                <!--                                <th></th>-->
                <!--                            </tr>-->
                <!--                            </thead>-->
                <!--                            <tbody>-->
                <!--                            <tr>-->
                <!--                                <td>5 Year Service</td>-->
                <!--                                <td>5</td>-->
                <!--                                <td>-->
                <!--                                    <a href="javascript:;" class="avatar"><img alt=""-->
                <!--                                                                               src="-->
                <?php //echo base_url(); ?><!--assets/img/dummy-doctors.jpg"></a>-->
                <!--                                    <a href="javascript:;">John Doe</a>-->
                <!--                                </td>-->
                <!--                                <td class="text-right">-->
                <!--                                    <div class="dropdown dropdown-action">-->
                <!--                                        <a aria-expanded="false" data-toggle="dropdown"-->
                <!--                                           class="action-icon dropdown-toggle" href="javascript:;"><i-->
                <!--                                                    class="fa fa-ellipsis-v"></i></a>-->
                <!--                                        <div class="dropdown-menu dropdown-menu-right">-->
                <!--                                            <a href="javascript:;" class="dropdown-item" data-toggle="modal"-->
                <!--                                               data-target="#edit_custom_policy"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
                <!--                                            <a href="javascript:;" class="dropdown-item" data-toggle="modal"-->
                <!--                                               data-target="#delete_custom_policy"><i class="fa fa-trash-o m-r-5"></i>-->
                <!--                                                Delete</a>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </td>-->
                <!--                            </tr>-->
                <!--                            </tbody>-->
                <!--                        </table>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!-- /Custom Policy -->

            </div>
            <?php echo form_close(); ?>

        </div>
        <!-- /Annual Leave -->

        <!-- Sick Leave -->
        <div class="card leave-box 2_leave" id="leave_sick">
            <?php
            $attributes = array('id' => 'sickLeaveForm');
            echo form_open('', $attributes);
            ?>
            <div class="card-body">
                <input type="hidden" value="2" class="leave_type_id" name="leave_type_id">
                <div class="h3 card-title with-switch">
                    Sick
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_sick"
                               checked="">
                        <label class="onoffswitch-label" for="switch_sick">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                <div class="leave-item">
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <div class="form-group">
                                    <label>Days</label>
                                    <input type="text" class="form-control" disabled="" name="days">
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

        </div>
        <!-- /Sick Leave -->

<!--        Hospitalisation Leave -->
<!--        <div class="card leave-box 3_leave" id="leave_hospitalisation">-->
<!--            --><?php
//            $attributes = array('id' => 'hospitalisationLeaveForm');
//            echo form_open('', $attributes);
//            ?>
<!--            <div class="card-body">-->
<!--                <input type="hidden" value="3" class="leave_type_id" name="leave_type_id">-->
<!--                <div class="h3 card-title with-switch">-->
<!--                    Hospitalisation-->
<!--                    <div class="onoffswitch">-->
<!--                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"-->
<!--                               id="switch_hospitalisation" checked="">-->
<!--                        <label class="onoffswitch-label" for="switch_hospitalisation">-->
<!--                            <span class="onoffswitch-inner"></span>-->
<!--                            <span class="onoffswitch-switch"></span>-->
<!--                        </label>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="leave-item">-->
<!---->
<!--                     Annual Days Leave -->
<!--                    <div class="leave-row">-->
<!--                        <div class="leave-left">-->
<!--                            <div class="input-box">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Days</label>-->
<!--                                    <input type="text" class="form-control" disabled="" name="days">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="leave-right">-->
<!--                            <button class="leave-edit-btn" disabled="">-->
<!--                                Edit-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                     /Annual Days Leave -->
<!---->
<!--                </div>-->
<!---->
<!--                 Custom Policy -->
<!--                                <div class="custom-policy">-->
<!--                                    <div class="leave-header">-->
<!--                                        <div class="title">Custom policy</div>-->
<!--                                        <div class="leave-action">-->
<!--                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"-->
<!--                                                    data-target="#add_custom_policy" disabled=""><i class="fa fa-plus"></i> Add custom-->
<!--                                                policy-->
<!--                                            </button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="table-responsive">-->
<!--                                        <table class="table table-hover table-nowrap leave-table mb-0">-->
<!--                                            <thead>-->
<!--                                            <tr>-->
<!--                                                <th class="l-name">Name</th>-->
<!--                                                <th class="l-days">Days</th>-->
<!--                                                <th class="l-assignee">Assignee</th>-->
<!--                                                <th></th>-->
<!--                                            </tr>-->
<!--                                            </thead>-->
<!--                                            <tbody>-->
<!--                                            <tr>-->
<!--                                                <td>5 Year Service</td>-->
<!--                                                <td>5</td>-->
<!--                                                <td>-->
<!--                                                    <a href="javascript:;" class="avatar"><img alt=""-->
<!--                                                                                               src="-->
<!--                --><?php ////echo base_url(); ?><!--<!assets/img/dummy-doctors.jpg"></a>-->
<!--                                                    <a href="javascript:;">John Doe</a>-->
<!--                                                </td>-->
<!--                                                <td class="text-right">-->
<!--                                                    <div class="dropdown dropdown-action">-->
<!--                                                        <a aria-expanded="false" data-toggle="dropdown"-->
<!--                                                           class="action-icon dropdown-toggle" href="javascript:;"><i-->
<!--                                                                    class="fa fa-ellipsis-v"></i></a>-->
<!--                                                        <div class="dropdown-menu dropdown-menu-right">-->
<!--                                                            <a href="javascript:;" class="dropdown-item"><i-->
<!--                                                                        class="fa fa-pencil m-r-5"></i> Edit</a>-->
<!--                                                            <a href="javascript:;" class="dropdown-item"><i-->
<!--                                                                        class="fa fa-trash-o m-r-5"></i> Delete</a>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                            </tbody>-->
<!--                                        </table>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                 /Custom Policy -->
<!---->
<!--            </div>-->
<!--            --><?php //echo form_close(); ?>
<!---->
<!--        </div>-->
<!--         /Hospitalisation Leave -->

        <!-- Maternity Leave -->
        <div class="card leave-box 4_leave" id="leave_maternity">
            <?php
            $attributes = array('id' => 'maternityLeaveForm');
            echo form_open('', $attributes);
            ?>
            <div class="card-body">
                <input type="hidden" value="4" class="leave_type_id" name="leave_type_id">
                <div class="h3 card-title with-switch">
                    Maternity <span class="subtitle">Assigned to female only</span>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_maternity"
                               checked="">
                        <label class="onoffswitch-label" for="switch_maternity">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                <div class="leave-item">
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <div class="form-group">
                                    <label>Days</label>
                                    <input type="text" class="form-control" disabled="" name="days">
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

        </div>
        <!-- /Maternity Leave -->

        <!-- Paternity Leave -->
        <div class="card leave-box 5_leave" id="leave_paternity">
            <?php
            $attributes = array('id' => 'paternityLeaveForm');
            echo form_open('', $attributes);
            ?>
            <div class="card-body">
                <input type="hidden" value="5" class="leave_type_id" name="leave_type_id">
                <div class="h3 card-title with-switch">
                    Paternity <span class="subtitle">Assigned to male only</span>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_paternity"
                               checked="">
                        <label class="onoffswitch-label" for="switch_paternity">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                <div class="leave-item">
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <div class="form-group">
                                    <label>Days</label>
                                    <input type="text" class="form-control" disabled="" name="days">
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn" disabled="">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

        </div>
        <!-- /Paternity Leave -->

        <!-- Custom Create Leave -->
        <div class="card leave-box mb-0 6_leave" id="leave_custom01">
            <?php
            $attributes = array('id' => 'lopLeaveForm');
            echo form_open('', $attributes);
            ?>
            <div class="card-body">
                <input type="hidden" value="6" class="leave_type_id" name="leave_type_id">
                <div class="h3 card-title with-switch">
                    Loss of Pay
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_custom01"
                               checked="">
                        <label class="onoffswitch-label" for="switch_custom01">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                    <!--                    <button class=onoffswitch-inner"btn btn-danger leave-delete-btn" type="button">Delete</button>-->
                </div>
                <div class="leave-item">

                    <!-- Annual Days Leave -->
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <div class="form-group">
                                    <label>Days</label>
                                    <input type="text" class="form-control" disabled="" name="days">
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">Edit</button>
                        </div>
                    </div>
                    <!-- /Annual Days Leave -->

                    <!-- Carry Forward -->
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <label class="d-block">Carry forward</label>
                                <div class="leave-inline-form">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carry_forward"
                                               id="carry_no" value="0" disabled="">
                                        <label class="form-check-label" for="carry_no_01">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="carry_forward"
                                               id="carry_yes" value="1" disabled="">
                                        <label class="form-check-label" for="carry_yes_01">Yes</label>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Max</span>
                                        </div>
                                        <input type="text" class="form-control" disabled="" name="max">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                    <!-- /Carry Forward -->

                    <!-- Earned Leave -->
                    <div class="leave-row">
                        <div class="leave-left">
                            <div class="input-box">
                                <label class="d-block">Earned leave</label>
                                <div class="leave-inline-form">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="earned_leave"
                                               id="earned_no" value="0" disabled="">
                                        <label class="form-check-label" for="inlineRadio1">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="earned_leave"
                                               id="earned_yes" value="1" disabled="">
                                        <label class="form-check-label" for="inlineRadio2">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leave-right">
                            <button class="leave-edit-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                    <!-- /Earned Leave -->

                </div>

                <!-- Custom Policy -->
                <!--                <div class="custom-policy">-->
                <!--                    <div class="leave-header">-->
                <!--                        <div class="title">Custom policy</div>-->
                <!--                        <div class="leave-action">-->
                <!--                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"-->
                <!--                                    data-target="#add_custom_policy"><i class="fa fa-plus"></i> Add custom policy-->
                <!--                            </button>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="table-responsive">-->
                <!--                        <table class="table table-hover table-nowrap leave-table mb-0">-->
                <!--                            <thead>-->
                <!--                            <tr>-->
                <!--                                <th class="l-name">Name</th>-->
                <!--                                <th class="l-days">Days</th>-->
                <!--                                <th class="l-assignee">Assignee</th>-->
                <!--                                <th></th>-->
                <!--                            </tr>-->
                <!--                            </thead>-->
                <!--                            <tbody>-->
                <!--                            <tr>-->
                <!--                                <td>5 Year Service</td>-->
                <!--                                <td>5</td>-->
                <!--                                <td>-->
                <!--                                    <a href="javascript:;" class="avatar"><img alt=""-->
                <!--                                                                               src="-->
                <?php //echo base_url(); ?><!--assets/img/dummy-doctors.jpg"></a>-->
                <!--                                    <a href="javascript:;">John Doe</a>-->
                <!--                                </td>-->
                <!--                                <td class="text-right">-->
                <!--                                    <div class="dropdown dropdown-action">-->
                <!--                                        <a aria-expanded="false" data-toggle="dropdown"-->
                <!--                                           class="action-icon dropdown-toggle" href="javascript:;"><i-->
                <!--                                                    class="fa fa-ellipsis-v"></i></a>-->
                <!--                                        <div class="dropdown-menu dropdown-menu-right">-->
                <!--                                            <a href="javascript:;" class="dropdown-item" data-toggle="modal"-->
                <!--                                               data-target="#edit_custom_policy"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
                <!--                                            <a href="javascript:;" class="dropdown-item" data-toggle="modal"-->
                <!--                                               data-target="#delete_custom_policy"><i class="fa fa-trash-o m-r-5"></i>-->
                <!--                                                Delete</a>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                </td>-->
                <!--                            </tr>-->
                <!--                            </tbody>-->
                <!--                        </table>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!-- /Custom Policy -->

            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /Custom Create Leave -->
    </div>
</div>
<div id="add_temp" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Group</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'addLeaveGroupForm');
                echo form_open('', $attributes);
                ?>
                <input type="hidden" class="leave_group_id" name="edit_id" id="edit_id" value="">
                <div class="edit_fields">
                    <div class="row">
                        <input type="hidden" name="edit_mod" id="edit_mod" value="add">

                        <div class="col-md-6 form-group ">
                            <label class="focus-label">Name</label>
                            <input type="text" name="leave_group" id="leave_group"
                                   class="form-control input-lg leave_group_name">
                        </div>
                        <div class="col-md-6 form-group ">
                            <label class="focus-label">User Group</label>
                            <select class="select" id="user_group_id" name="user_group_id">
                                <option>Select User Group</option>
                                <?php foreach ($groups as $userGroup){?>
                                    <option value="<?php echo $userGroup->group_id;?>"><?php echo $userGroup->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Notes <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" id="remarks" name="remarks"></textarea>
                        </div>


                        <!-- <div class="chkbx"><input type="checkbox" name="checkbox"></div> -->
                    </div>


                </div>
                <div class="m-t-20 text-center submit_all">
                    <button class="btn btn-info" id="save-track-template-add" type="submit">Submit</button>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>