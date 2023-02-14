<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <?php
        if ($this->session->flashdata('clinic_date') != '') {
            echo $this->session->flashdata('clinic_date');
        }
        ?>
        <h4 class="text-center">Add Clinic Dates</h4>
        <form action="<?php echo base_url('index.php/institute/add_clinics_date'); ?>" method="post"> 
            <div class="form-group">
                <label for="clinic_date">Clinic Date</label>
                <?php $curr_date = date('d-m-Y'); ?>
                <input required class="form-control" type="text" id="clinic_date" name="clinic_date" value="<?php echo $curr_date; ?>">
            </div>
            <div class="form-group">
                <?php
                $user_id = $this->ion_auth->user()->row()->id;
                $f_initial = $this->ion_auth->get_users_groups($user_id)->row()->first_initial;
                $l_initial = $this->ion_auth->get_users_groups($user_id)->row()->last_initial;
                $h_letter_first = '';
                $h_letter_last = '';
                if (!empty($f_initial)) {
                    $h_letter_first = $f_initial;
                }
                if (!empty($f_initial)) {
                    $h_letter_last = $l_initial;
                }
                
                $hospital_id = $this->ion_auth->get_users_groups($user_id)->row()->id;
                if (!empty($ref_data)) {
                    $ref_no = $ref_data['ref_key'];
                    $ref_key = $h_letter_first . $h_letter_last . '-' . sprintf("%04d", $ref_data['ref_key']);
                }
                ?>
                <label for="ref_number">Reference No.</label>
                <input disabled class="form-control" type="text" id="ref_number" value="<?php echo $ref_key; ?>" placeholder="Reference Number.">
                <input type="hidden" name="ref_number" value="<?php echo $ref_key; ?>">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input required class="form-control" type="text" id="location" name="location" placeholder="Add Location">
            </div>
            <div class="form-group">
                <label for="clinic_lead">Clinic Lead</label>
                <input required class="form-control" type="text" id="clinic_lead" name="clinic_lead" placeholder="Add Clinic Lead">
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" value="Add Clinic Date" name="add_clinic_date">
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <p class="lead text-center">Up Coming Clinic Dates</p>
        <?php if (!empty($clinic_upcoming)) { ?>
            <table id="clinic_upcoming" class="table table-condensed table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Clinic Date</th>
                        <th>Reff No.</th>
                        <th>Location</th>
                        <th>&nbsp</th>
                        <th>&nbsp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clinic_upcoming as $upcoming) {
                        $clinic_date = date('d-m-Y', $upcoming->ura_clinic_date);
                        $ref_key = $upcoming->ura_clinic_ref_no;
                        ?>
                        <tr>
                            <td><?php echo $clinic_date; ?></td>
                            <td><?php echo $ref_key; ?></td>
                            <td><?php echo $upcoming->ura_clinic_loca; ?></td>
                            <td><a href="<?php echo base_url('index.php/institute/edit_clinic_date/?rec_id='.$upcoming->ura_clinic_date_id.'&hopital_id='.$hospital_id.'&ref_key='.$ref_key); ?>"><img src="<?php echo base_url('assets/img/edit_clinic.png'); ?>"></a></td>
                            <td><a href="<?php echo base_url('index.php/institute/delete_clinic_date/?rec_id='.$upcoming->ura_clinic_date_id.'&hopital_id='.$hospital_id); ?>"><img src="<?php echo base_url('assets/img/delete.png'); ?>"></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <div class="col-md-6">
        <p class="lead text-center">Previous Clinic Dates</p>
        <?php if (!empty($clinic_previous)) { ?>
            <table id="clinic_previous" class="table table-condensed table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Clinic Date</th>
                        <th>Reff No.</th>
                        <th>Location</th>
                        <th>&nbsp</th>
                        <th>&nbsp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clinic_previous as $previous) {
                        $clinic_date = date('d-m-Y', $previous->ura_clinic_date);
                        $ref_key = $previous->ura_clinic_ref_no;
                        ?>
                        <tr>
                            <td><?php echo $clinic_date; ?></td>
                            <td><?php echo $ref_key; ?></td>
                            <td><?php echo $previous->ura_clinic_loca; ?></td>
                            <td><a href="<?php echo base_url('index.php/institute/edit_clinic_date/?rec_id='.$previous->ura_clinic_date_id.'&hopital_id='.$hospital_id.'&ref_key='.$ref_key); ?>"><img src="<?php echo base_url('assets/img/edit_clinic.png'); ?>"></a></td>
                            <td><a href="<?php echo base_url('index.php/institute/delete_clinic_date/?rec_id='.$previous->ura_clinic_date_id.'&hopital_id='.$hospital_id); ?>"><img src="<?php echo base_url('assets/img/delete.png'); ?>"></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>