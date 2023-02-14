<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$batch_id = $_GET['batch_id'];
$batch_name = $_GET['name'];
$batch_code = $_GET['code'];

if ($this->session->flashdata('batch_sent_to_lab') != '') {
    echo $this->session->flashdata('batch_sent_to_lab');
}
if ($this->session->flashdata('batch_rec_from_lab') != '') {
    echo $this->session->flashdata('batch_rec_from_lab');
}
if ($this->session->flashdata('batch_sent_to_doc') != '') {
    echo $this->session->flashdata('batch_sent_to_doc');
}
if ($this->session->flashdata('batch_update_msg') != '') {
    echo $this->session->flashdata('batch_update_msg');
}

$sent_to_lab_data = $this->Admin_model->display_sent_to_lab_model($batch_id);
$rec_from_lab_data = $this->Admin_model->display_rec_from_lab_model($batch_id);
$sent_to_doc_data = $this->Admin_model->display_sent_to_doc_model($batch_id);
$batch_records = $this->Admin_model->get_tracking_model($batch_id);

//Batch Record Data
$batch_name = !empty($batch_records[0]->ura_track_batch_name) ? $batch_records[0]->ura_track_batch_name : '';
$batch_code = !empty($batch_records[0]->ura_track_batch_code) ? $batch_records[0]->ura_track_batch_code : '';
$batch_clinic_date = !empty($batch_records[0]->ura_batch_clinic_date) ? $batch_records[0]->ura_batch_clinic_date : '';
$batch_clinic_name = !empty($batch_records[0]->ura_batch_clinic_name) ? $batch_records[0]->ura_batch_clinic_name : '';
$batch_patients = !empty($batch_records[0]->ura_batch_total_patients) ? $batch_records[0]->ura_batch_total_patients : '';
$batch_specimens = !empty($batch_records[0]->ura_batch_total_specimens) ? $batch_records[0]->ura_batch_total_specimens : '';
$batch_status = !empty($batch_records[0]->ura_batch_status) ? $batch_records[0]->ura_batch_status : '';
$batch_notes = !empty($batch_records[0]->ura_batch_notes) ? $batch_records[0]->ura_batch_notes : '';

//Get Sent To Lab Information Base on Batch ID
$sent_to_lab_id = !empty($sent_to_lab_data[0]->ura_sent_to_id) ? $sent_to_lab_data[0]->ura_sent_to_id : '';
$sent_to_lab_time = !empty($sent_to_lab_data[0]->ura_sent_to_timestamp) ? $sent_to_lab_data[0]->ura_sent_to_timestamp : '';
$sent_to_lab_address = !empty($sent_to_lab_data[0]->ura_sent_to_address) ? $sent_to_lab_data[0]->ura_sent_to_address : '';
$sent_to_lab_name = !empty($sent_to_lab_data[0]->ura_sent_to_name) ? $sent_to_lab_data[0]->ura_sent_to_name : '';

//Get Receive From Lab Information Base on Batch ID
$rec_from_lab_id = !empty($rec_from_lab_data[0]->ura_rec_from_lab_id) ? $rec_from_lab_data[0]->ura_rec_from_lab_id : '';
$rec_from_lab_time = !empty($rec_from_lab_data[0]->ura_rec_from_lab_timestamp) ? $rec_from_lab_data[0]->ura_rec_from_lab_timestamp : '';
$rec_from_lab_address = !empty($rec_from_lab_data[0]->ura_rec_from_lab_address) ? $rec_from_lab_data[0]->ura_rec_from_lab_address : '';
$rec_from_lab_name = !empty($rec_from_lab_data[0]->ura_rec_from_lab_name) ? $rec_from_lab_data[0]->ura_rec_from_lab_name : '';

//Get Sent To Doctor Information Base on Batch ID
$sent_to_doc_id = !empty($sent_to_doc_data[0]->ura_sent_to_doc_id) ? $sent_to_doc_data[0]->ura_sent_to_doc_id : '';
$sent_to_doc_time = !empty($sent_to_doc_data[0]->ura_sent_to_doc_timestamp) ? $sent_to_doc_data[0]->ura_sent_to_doc_timestamp : '';
$sent_to_doc_address = !empty($sent_to_doc_data[0]->ura_sent_to_doc_address) ? $sent_to_doc_data[0]->ura_sent_to_doc_address : '';
$sent_to_doc_name = !empty($sent_to_doc_data[0]->ura_sent_to_doc_name) ? $sent_to_doc_data[0]->ura_sent_to_doc_name : '';
?>

<div class="row">
    <div class="col-md-12">
        <form enctype="multipart/form-data" method="post" class="form" action="<?php echo base_url('index.php/admin_tracking/tracking/update_batch_record'); ?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        <label for="edit_batch_name">Batch Name</label>
                        <input type="text" class="form-control" value="<?php echo $batch_name; ?>" name="edit_batch_name" id="edit_batch_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        <label for="edit_batch_code">Batch Code</label>
                        <input type="text" class="form-control" value="<?php echo $batch_code; ?>" name="edit_batch_code" id="edit_batch_code">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edit_batch_clinic_date">Clinic Date</label>
                        <div class="input-group date" id="edit_batch_clinic" style="margin-top:8px;">
                            <input type="text" name="edit_batch_clinic_date" id="edit_batch_clinic_date" value="<?php echo!empty($batch_clinic_date) ? date('m/d/Y h:i A', strtotime($batch_clinic_date)) : ''; ?>" class="form-control" style="margin-top:0px;" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edit_batch_total_patients">Total Patients</label>
                        <input type="text" class="form-control" value="<?php echo $batch_patients; ?>" name="edit_batch_total_patients" id="edit_batch_total_patients">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edit_batch_total_specimens">Total Specimens</label>
                        <input type="text" class="form-control" value="<?php echo $batch_specimens; ?>" name="edit_batch_total_specimens" id="edit_batch_total_specimens">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edit_batch_clinic_name">Clinic Name</label>
                        <input type="text" class="form-control" value="<?php echo $batch_clinic_name; ?>" name="edit_batch_clinic_name" id="edit_batch_clinic_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edit_batch_status">Status</label>
                        <select class="form-control" name="edit_batch_status">
                            <option value="false">Choose Status</option>
                            <?php
                            $status = array(
                                'Courier' => 'Courier',
                                'Lab Processing' => 'Lab Processing',
                                'Assigned To Doctor' => 'Assigned To Doctor'
                            );

                            foreach ($status as $key => $value) {
                                $selected = '';
                                if ($value == $batch_status) {
                                    $selected = 'selected';
                                }
                                echo '<option ' . $selected . ' value="' . $value . '">' . $value . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="edit_batch_notes">Additional Notes</label>
                        <textarea class="form-control" name="edit_batch_notes" id="edit_batch_notes"><?php echo $batch_notes; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="edit_batch_checklist">Upload Checklist</label>
                        <input required class="form-control" type="file" name="edit_batch_checklist" id="edit_batch_checklist" style="margin-top:8px;">
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
                    <button type="submit" class="btn btn-primary">Update Batch</button>
                </div>
            </div>
        </form>
    </div>
</div>
<form class="form" action="<?php echo base_url('index.php/admin_tracking/tracking/update_tracking_sent_to_lab'); ?>" method="post">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="alert alert-info"><strong>1 - Sent To Lab.</strong></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sent_to_lab_datetime">Drop off Date & Time</label>
                    <div class="input-group date" id="sent_to_lab_date" style="margin-top:8px;">
                        <input type="text" name="sent_to_lab_datetime" id="sent_to_lab_datetime" value="<?php echo!empty($sent_to_lab_time) ? date('m/d/Y h:i A', strtotime($sent_to_lab_time)) : ''; ?>" class="form-control" style="margin-top:0px;" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sent_to_lab_location">Drop off Location</label>
                    <input class="form-control" type="text" name="sent_to_lab_location" value="<?php echo $sent_to_lab_address; ?>" id="sent_to_lab_location" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sent_to_lab_name">Drop off Name</label>
                    <input class="form-control" type="text" name="sent_to_lab_name" value="<?php echo $sent_to_lab_name; ?>" id="sent_to_lab_name" >
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Sent To Lab</button>
            </div>
            <input type="hidden" name="sent_to_lab_id" value="<?php echo $sent_to_lab_id; ?>">
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
            <input type="hidden" name="batch_name" value="<?php echo $batch_name; ?>">
            <input type="hidden" name="batch_code" value="<?php echo $batch_code; ?>">
        </div>

    </div>
</form>
<form class="form" action="<?php echo base_url('index.php/admin_tracking/tracking/update_tracking_rec_from_lab'); ?>" method="post">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="alert alert-info"><strong>2 - Receive From Lab.</strong></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rec_pickup_datetime">Pick Up Date & Time</label>
                    <div class="input-group date" id="pickup_date" style="margin-top:8px;">
                        <input type="text" name="rec_pickup_datetime" id="rec_pickup_datetime" class="form-control" value="<?php echo!empty($rec_from_lab_time) ? date('m/d/Y h:i A', strtotime($rec_from_lab_time)) : ''; ?>" style="margin-top:0px;" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rec_pickup_location">Pick Up Location</label>
                    <input class="form-control" type="text" name="rec_pickup_location" id="rec_pickup_location" value="<?php echo $rec_from_lab_address; ?>" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rec_pickup_name">Pick Up Name</label>
                    <input class="form-control" type="text" name="rec_pickup_name" value="<?php echo $rec_from_lab_name; ?>" id="rec_pickup_name" >
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Receive From Lab</button>
            </div>
            <input type="hidden" name="rec_from_id" value="<?php echo $rec_from_lab_id; ?>">
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
            <input type="hidden" name="batch_name" value="<?php echo $batch_name; ?>">
            <input type="hidden" name="batch_code" value="<?php echo $batch_code; ?>">
        </div>
    </div>
</form>
<form class="form" action="<?php echo base_url('index.php/admin_tracking/tracking/update_tracking_sent_to_doc'); ?>" method="post">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="alert alert-info"><strong>3 - Sent To Doctor.</strong></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="doc_pickup_datetime">Drop off Date & Time</label>
                    <div class="input-group date" id="to_doc_date" style="margin-top:8px;">
                        <input type="text" name="doc_pickup_datetime" id="doc_pickup_datetime" class="form-control" value="<?php echo!empty($sent_to_doc_time) ? date('m/d/Y h:i A', strtotime($sent_to_doc_time)) : ''; ?>" style="margin-top:0px;" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="doc_location">Drop off Location</label>
                    <input class="form-control" type="text" name="doc_location" id="doc_location" value="<?php echo $sent_to_doc_address; ?>" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="doc_name">Drop off Name</label>
                    <input class="form-control" type="text" name="doc_name" id="doc_name" value="<?php echo $sent_to_doc_name; ?>" >
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Sent To Doctor</button>
            </div>
            <input type="hidden" name="sent_doc_id" value="<?php echo $sent_to_doc_id; ?>">
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
            <input type="hidden" name="batch_name" value="<?php echo $batch_name; ?>">
            <input type="hidden" name="batch_code" value="<?php echo $batch_code; ?>">
        </div>
    </div>
</form>
</form>