<!-- Page Content -->

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Leave Groups</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Leave Groups</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="javascript:;" class="btn add-btn" data-toggle="modal"
               data-target="#add_leave_modal"><i class="fa fa-plus"></i> Add Leave Group</a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- Add Leave Modal -->
<div id="add_leave_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leave Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id'=>'addLeaveGroupForm');
                echo form_open('',$attributes);
                ?>
<!--                <form id="addLeaveTypeForm">-->
                    <div class="col-md-12">
                        <input class="form-control" type="hidden" id="form_status" name="form_status">
                        <input class="form-control" type="hidden" id="edit_id" name="edit_id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Leave Group<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="leave_group" name="leave_group">
                            </div>
                            <div class="col-md-8 form-group">
                                <label>Leave Codes <span class="text-danger">*</span></label>
                                <select class="select" id="leave_types" name="leave_types[]" multiple>
                                    <option>Select Leave Type</option>
                                    <?php foreach ($leaveTypes as $leaveType){ ?>
                                        <option value="<?php echo $leaveType->id;?>"><?php echo $leaveType->code;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Notes <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control" id="remarks" name="remarks"></textarea>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                <?php echo form_close();?>
<!--                </form>-->
            </div>
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
                    <th>Leave Group</th>
                    <th>Leave Codes</th>
                    <th>Notes</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($leaveGroups as $leave) { ?>
                    <tr>
                        <td><?php echo $leave->name; ?></td>
                        <td><?php echo $leave->leave_types; ?></td>
                        <td><?php echo $leave->remarks; ?></td>
                        <td class="text-right">
                            <textarea id="edit_<?php echo $leave->id;?>" style="display:none;">
                                <?php echo json_encode($leave);?>
                            </textarea>
                            <div class="dropdown dropdown-action">
                                <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editBtnLeaveGroup" data-id="<?php echo $leave->id;?>" href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a>
<!--                                    <a class="dropdown-item" href="javascript:;" data-toggle="modal"-->
<!--                                       data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
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
