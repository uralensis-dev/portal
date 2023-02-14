<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if ($this->session->flashdata('batch_msg') != '') {
    echo $this->session->flashdata('batch_msg');
}
?>
<form enctype="multipart/form-data" class="form" action="<?php echo base_url('index.php/admin_tracking/tracking/add_batch'); ?>" method="post">
    <div class="row">
        <div class="col-md-4"><?php echo form_error('batch_name', '<div class="alert alert-danger">', '</div>'); ?></div>
        <div class="col-md-4"><?php echo form_error('batch_code', '<div class="alert alert-danger">', '</div>'); ?></div>
        <div class="col-md-4"><?php echo form_error('batch_clinic_date', '<div class="alert alert-danger">', '</div>'); ?></div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">

                <label for="batch_name">Batch Name</label>
                <input type="text" class="form-control" value="<?php echo set_value('batch_name'); ?>" name="batch_name" id="batch_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <label for="batch_code">Batch Code</label>
                <input type="text" class="form-control" value="<?php echo set_value('batch_code'); ?>" name="batch_code" id="batch_code">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="batch_clinic_date">Clinic Date</label>
                <div class="input-group date" id="batch_clinic" style="margin-top:8px;">
                    <input type="text" name="batch_clinic_date" value="<?php echo set_value('batch_clinic_date'); ?>" id="batch_clinic_date" class="form-control" style="margin-top:0px;" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="batch_total_patients">Total Patients</label>
                <input type="text" class="form-control" name="batch_total_patients" id="batch_total_patients">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="batch_total_specimens">Total Specimens</label>
                <input type="text" class="form-control" name="batch_total_specimens" id="batch_total_specimens">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="batch_clinic_name">Clinic Name</label>
                <input type="text" class="form-control" name="batch_clinic_name" id="batch_clinic_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="batch_status">Status</label>
                <select name="batch_status" id="batch_status" class="form-control">
                    <option value="0">Choose Status</option>
                    <option value="Courier">Courier</option>
                    <option value="Lab Processing">Lab Processing</option>
                    <option value="Assigned To Doctor">Assigned To Doctor</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="batch_notes">Additional Notes</label>
                <textarea class="form-control" name="batch_notes" id="batch_notes"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="batch_checklist">Upload Checklist</label>
                <input required class="form-control" type="file" name="batch_checklist" id="batch_checklist" style="margin-top:8px;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="form-group text-center">
                <button style="width:100%;" type="submit" name="submit_batch" class="btn btn-lg btn-success">Add Batch</button>
            </div>
        </div>
    </div>
</form>
