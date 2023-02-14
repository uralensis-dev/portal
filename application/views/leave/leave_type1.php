<!-- Page Content -->
<style type="text/css">
    .custom-modal .modal-header{padding: 15px;}
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
        <div class="col-auto float-right ml-auto">
            <a href="javascript:;" class="btn btn-rounded add-btn" data-toggle="modal"
               data-target="#add_leave_modal"><i class="fa fa-plus"></i> Add Leave</a>
        </div>
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
                $attributes = array('id'=>'addLeaveTypeForm');
                echo form_open('',$attributes);
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
                                    <option value="J0800 - Compassionate Leave">J0800 - Compassionate Leave</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Total Days (per year) <span class="text-danger">*</span></label>
                                <input class="form-control"  type="text" id="total_leaves" name="total_leaves">
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
                <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- /Add Leave Modal -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 simpletable">
                <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Leave Code</th>
                    <th>Total Days (per year)</th>
                    <th>Min. Days (single period)</th>
                    <th>Max. Days (single period)</th>
<!--                    <th>Leave for Gender</th>-->
                    <th>Notes</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($leaveTypes as $leave) { ?>
                    <tr>
                        <td><?php echo $leave->name; ?></td>
                        <td><?php echo $leave->code; ?></td>
                        <td><?php echo $leave->no_of_leaves; ?></td>
                        <td><?php echo $leave->min_leave; ?></td>
                        <td><?php echo $leave->leave_stretch; ?></td>
<!--                        <td>--><?php //echo ucwords($leave->leave_for); ?><!--</td>-->
                        <td><?php echo $leave->remarks; ?></td>
                        <td class="text-right">
                            <textarea id="edit_<?php echo $leave->id;?>" style="display:none;">
                                <?php echo json_encode($leave);?>
                            </textarea>
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editBtn" data-id="<?php echo $leave->id;?>" href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item deleteBtn" data-id="<?php echo $leave->id;?>" href="javascript:;" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
