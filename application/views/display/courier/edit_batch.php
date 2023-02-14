<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if (!empty($batch_data)) {
    $batch_ref = '';
    $batch_courier_id = '';
    $courier_collection = '';
    $courier_track_no = '';
    $courier_cost_code = '';
    $collect_by_courier = '';
    $rec_by_lab = '';
    $sent_to_admin = '';
    $rec_by_admin = '';
    foreach ($batch_data as $values) {
        $batch_ref = $values->ura_batch_ref;
        $batch_courier_id = $values->ura_courier_id;
        $courier_collection = $values->ura_courier_collection_date;
        $courier_track_no = $values->ura_courier_tracky_number;
        $courier_cost_code = $values->ura_courier_cost_code;
        $collect_by_courier = $values->ura_batch_collect_by_courier;
        $rec_by_lab = $values->ura_batch_receive_by_lab;
        $sent_to_admin = $values->ura_batch_sent_to_admin;
        $rec_by_admin = $values->ura_batch_receive_by_admin;
    }
}
if (isset($_GET) && !empty($_GET['batch_id']) && !empty($_GET['hospital_id'])) {
    $batch_id = $_GET['batch_id'];
    $hospital_id = $_GET['hospital_id'];
}
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('batch_update') != '') {
            echo $this->session->flashdata('batch_update');
        }
        ?>
        <form class="form" id="edit_batch_form" method="post" action="<?php echo base_url('index.php/admin/process_edit_batch'); ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="batch_ref">Batch Reference</label>
                        <input class="form-control" name="batch_ref" readonly value="<?php echo!empty($batch_ref) ? $batch_ref : ''; ?>" id="batch_ref">
                    </div>
                    <div class="form-group">
                        <label for="batch_courier_collec_date">Collection Date</label>
                        <input class="form-control" name="batch_courier_collec_date" value="<?php echo!empty($courier_collection) ? date('d-m-Y', strtotime($courier_collection)) : ''; ?>" id="batch_courier_collec_date">
                    </div>
                    <div class="form-group">
                        <label for="courier_cost_code">Courier Cost Code</label>
                        <input class="form-control" name="courier_cost_code" value="<?php echo!empty($courier_cost_code) ? $courier_cost_code : ''; ?>" id="courier_cost_code">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="batch_courier">Courier Name</label>
                        <select name="batch_courier" id="batch_courier" class="form-control">
                            <option value="false">Choose Courier</option>
                            <?php
                            if (!empty($courier_list)) {
                                foreach ($courier_list as $courier) {
                                    $selected = '';
                                    if ($batch_courier_id === $courier->ura_courier_id) {
                                        $selected = 'selected';
                                    }
                                    echo '<option ' . $selected . ' value="' . $courier->ura_courier_id . '">' . $courier->ura_courier_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="courier_track_no">Courier Tracky Number</label>
                        <input class="form-control" name="courier_track_no" value="<?php echo!empty($courier_track_no) ? $courier_track_no : ''; ?>" id="courier_track_no">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-warning batch_collection" data-batchcollection="collect_courier">Collected By Courier</button>
                    <hr>
                    <p class="col_by_courier_date"><?php echo!empty($collect_by_courier) ? '<label class="label label-success" style="font-size:12px;">' . date('d-m-Y g:i:s A', $collect_by_courier) . '</label>' : ''; ?></p>
                    <input type="hidden" name="batch_collect_by_courier" id="batch_collect_by_courier" value="<?php echo!empty($collect_by_courier) ? date('d-m-Y g:i:s A', $collect_by_courier) : ''; ?>"> 
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-warning batch_collection" data-batchcollection="rec_by_lab">Receive By Lab</button>
                    <hr>
                    <p class="rec_by_lab_date"><?php echo!empty($rec_by_lab) ? '<label class="label label-success" style="font-size:12px;">' . date('d-m-Y g:i:s A', $rec_by_lab) . '</label>' : ''; ?></p>
                    <input type="hidden" name="batch_rec_by_lab" id="batch_rec_by_lab" value="<?php echo!empty($rec_by_lab) ? date('d-m-Y g:i:s A', $rec_by_lab) : ''; ?>"> 
                    <input type="hidden" name="rec_by_lab_active" id="rec_by_lab_active" value="">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-warning batch_collection" data-batchcollection="sent_to_admin">Sent To Admin</button>
                    <hr>
                    <p class="sent_to_admin_date"><?php echo!empty($sent_to_admin) ? '<label class="label label-success" style="font-size:12px;">' . date('d-m-Y g:i:s A', $sent_to_admin) . '</label>' : ''; ?></p>
                    <input type="hidden" name="batch_sent_to_admin" id="batch_sent_to_admin" value="<?php echo!empty($sent_to_admin) ? date('d-m-Y g:i:s A', $sent_to_admin) : ''; ?>"> 
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-warning batch_collection" data-batchcollection="rec_by_admin">Received BY Admin</button>
                    <hr>
                    <p class="rec_by_admin_date"><?php echo!empty($rec_by_admin) ? '<label class="label label-success" style="font-size:12px;">' . date('d-m-Y g:i:s A', $rec_by_admin) . '</label>' : ''; ?></p>
                    <input type="hidden" name="batch_rec_by_admin" id="batch_rec_by_admin" value="<?php echo!empty($rec_by_admin) ? date('d-m-Y g:i:s A', $rec_by_admin) : ''; ?>"> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <input type="submit" class="btn btn-primary" name="save_edit_batch" value="Save Batch">
                </div>
            </div>
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
            <input type="hidden" name="hospital_id" value="<?php echo $hospital_id; ?>">
            <?php
            if (!empty($clinic_record_ids)) {
                foreach ($clinic_record_ids as $record_ids) {
                    ?>
                    <input type="hidden" name="clinic_record_ids[]" value="<?php echo $record_ids; ?>">
                    <?php
                }
            }
            ?>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Clinics</h3>
        <?php if (!empty($clinics_list)) { ?>
            <table class="table table-condensed" id="clinic_batches_list">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Location</th>
                        <th>Lead</th>
                        <th>Patients</th>
                        <th>Samples</th>
                        <th>IMF Samples</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clinics_list as $clinics) { ?>
                        <tr>
                            <td><?php echo $clinics->ura_clinic_ref_no; ?></td>
                            <td><?php echo $clinics->ura_clinic_loca; ?></td>
                            <td><?php echo $clinics->ura_clinic_lead; ?></td>
                            <td><?php echo $clinics->ura_clinic_total_patients; ?></td>
                            <td><?php echo $clinics->ura_clinic_total_samples; ?></td>
                            <td><?php echo $clinics->ura_clinic_imf_samples; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>