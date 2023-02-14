<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$track_key = $this->uri->segment(3);
$record_id = $this->uri->segment(4);

if (!empty($track_key) && $track_key === 'laboratory') {
    ?>
    <div class="tg-trackrecords">
        <div class="row">
            <form class="form specimen_tracking_form">
                <div class="col-md-4 col-md-offset-4 specimen_track_search">
                    <h3 class="text-center">Specimen Tracking</h3>
                    <input class="form-control" type="text" name="lab_barcode_no" placeholder="Tracking No.">
                    <div class="row">
                        <div class="col-md-6">
                            <hr>
                            <input class="form-control" type="text" name="lab_tracking_no_ul" placeholder="Tracking No. (UL Number)">
                        </div>
                        <div class="col-md-6">
                            <hr>
                            <input class="form-control" type="text" name="lab_tracking_no_lab" placeholder="Tracking No. (Lab Number)">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-md-4">
                    <div class="book_in_from_clinic text-center">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="book_out_to_lab_primary_release text-center">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="book_out_to_lab_fw_completed text-center">

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                    <div class="find_barcode_result">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 load-track-record-data">

        </div>
    </div>
    <?php
} elseif (!empty($track_key) && !empty($record_id) && $track_key === 'central_admin') {
    ?>
    <div class="col-md-10 col-md-offset-1 text-center">
        <a class="btn btn-primary" href="<?php echo base_url('index.php/admin/record_tracking/' . $record_id); ?>"><<< Go Back</a>
        <div class="row">
            <div class="col-md-6">
                <a class="admin_booked_in_from_clinic" href="javascript:;" data-recordid="<?php echo $record_id; ?>" data-statuskey="booked_in_from_clinic">
                    <img src="<?php echo base_url('assets/img/Central-Admin-2.jpg'); ?>">
                </a>
            </div>
            <div class="col-md-6">
                <a class="admin_booked_out_lab" href="javascript:;" data-toggle="collapse" data-target="#admin_booked_out_lab">
                    <img src="<?php echo base_url('assets/img/Central-Admin-3.jpg'); ?>">
                </a>
                <div id="admin_booked_out_lab" class="collapse text-left">
                    <form class="admin_central_reporting_form">
                        <div class="form-group">
                            <label for="report_urgency">Importance</label>
                            <?php
                            $db_speci_type = check_record_data_state($record_id, 'specimen_type');
                            $speci_type = array(
                                'Routine' => 'Routine',
                                'Urgent' => 'Urgent',
                                '2WW' => '2WW'
                            );
                            ?>
                            <select name="report_urgency" class="form-control" id="report_urgency">
                                <?php
                                foreach ($speci_type as $key => $value) {
                                    $select = '';
                                    if ($key === $db_speci_type['report_urgency']) {
                                        $select = 'selected';
                                    }
                                    ?>
                                    <option <?php echo $select; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="pathologist">Pathologist</label>
                            <?php
                            if (!empty($doctor_list)) {
                                $doctor_assign_data = check_record_data_state($record_id, 'doctor');
                                ?>
                                <select class="form-control" name="doctor" id="doctor">
                                    <option value="">Choose Pathologist</option>
                                    <?php
                                    foreach ($doctor_list as $doctors) {
                                        $selected = '';
                                        if ($doctors->id === $doctor_assign_data['user_id']) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $doctors->id; ?>"><?php echo $doctors->username; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="specimen_type">Choose Specimen Type</label>
                            <?php if (!empty($specimen_type)) { ?>
                                <select name="specimen_type" id="specimen_type"  class="form-control">
                                    <?php foreach ($specimen_type as $type) { ?>
                                        <option <?php echo $type->rtypeid == 5 ? ' selected="selected"' : ''; ?> value="<?php echo $type->rtypetitle; ?>"><?php echo $type->rtypetitle; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $record_id; ?>" name="record_id">
                            <input type="hidden" value="booked_out_to_lab" name="track_status_key">
                            <button class="btn btn-primary central_admin_form_btn" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif (!empty($track_key) && $track_key === 'reporting') {
    ?>

    <div class="tg-trackrecords">
        <div class="row">
            <form class="form specimen_tracking_form">
                <div class="col-md-4 text-center doctor_slides_ajax_data">

                </div>

                <div class="col-md-4 specimen_track_search">
                    <h3 class="text-center">Specimen Tracking</h3>
                    <input class="form-control" type="text" name="doc_barcode_no" placeholder="Tracking No.">
                    <div class="row">
                        <div class="col-md-6">
                            <hr>
                            <input class="form-control" type="text" name="doc_tracking_no_ul" placeholder="Tracking No. (UL Number)">
                        </div>
                        <div class="col-md-6">
                            <hr>
                            <input class="form-control" type="text" name="doc_tracking_no_lab" placeholder="Tracking No. (Lab Number)">
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center doctor_released_slides_ajax_data">

                </div>

                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                    <div class="find_barcode_result">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 load-track-record-data">

        </div>
    </div>
    <?php
} else {
    echo '<div class="alert alert-danger">Sorry! Something Wrong. <a href="' . base_url('index.php/admin/record_tracking/' . $record_id) . '">Go Back</a></div>';
}
