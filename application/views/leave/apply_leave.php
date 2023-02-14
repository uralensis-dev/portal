<!-- Page Content -->
<style type="text/css">
    .custom-modal .modal-header {
        padding: 15px;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-8">
            <h3 class="page-title">Apply Leave</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Leaves</a></li>
                <li class="breadcrumb-item active">Apply Leave</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="row">
    <div class="col-md-12">
        <?php
        $attributes = array('id' => 'addLeaveTypeForm');
        echo form_open('', $attributes);
        ?>
        <input class="form-control" type="hidden" id="form_status" name="form_status">
        <input class="form-control" type="hidden" id="edit_id" name="edit_id">
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Leave Code <span class="text-danger">*</span></label>
                <select class="select" id="leave_code" name="leave_code">
                    <option>Select Leave Code</option>
                    <?php foreach ($usersLeaves as $leaves) { ?>
                        <option value="<?php echo $leaves->id; ?>"><?php echo $leaves->code; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">From</label>
                <input class="form-control" type="date" name="start"/>
            </div>
            <div class="col-md-4">
                <label class="form-label">To</label>
                <input class="form-control" type="date" name="end"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 form-group">
                <label>Notes <span class="text-danger">*</span></label>
                <textarea rows="4" class="form-control" id="leave_remarks" name="leave_remarks"></textarea>
            </div>
        </div>
        <button class="btn btn-primary btn-rounded submit-btn">Submit</button>
        <?php echo form_close(); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 table-responsive" style="float:right;">
                    <table class="table">
                        <thead>
                        <th>Leave Code</th>
                        <th>Total Leave</th>
                        <th>Availed</th>
                        <th>Remaining</th>
                        </thead>
                        <tbody>
                        <?php foreach ($usersLeaveBalance as $leaveBalance) { ?>
                            <tr>
                                <td><?php echo $leaveBalance->code; ?></td>
                                <td><?php echo $leaveBalance->total_leaves; ?></td>
                                <td><?php echo $leaveBalance->availed; ?></td>
                                <td><?php echo $leaveBalance->remaining; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
