<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Enable/Disable Search
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <form action="<?php echo site_url('Admin/search_request'); ?>" method="post">
                            <table class="table table-bordered">
                                <tr class="bg-primary">
                                    <th>First Name</th>
                                    <th>Sur Name</th>
                                    <th>EMIS No</th>
                                    <th>LAB No</th>
                                    <th>NHS No</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" id="first_name" name="first_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="sur_name" name="sur_name">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="emis_no" name="emis_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="lab_no" name="lab_no">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                                    </td>
                                </tr>
                            </table>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-warning">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($this->session->flashdata('batch_delete') != '') {
    echo $this->session->flashdata('batch_delete');
}
?>
<div class="batch_status"></div>
<table id="admin_display_tracking" class="table table-striped admin_display_tracking" cellspacing="0" width="100%">
    <thead>
        <tr class="info">
            <th>Batch Name</th>
            <th>Batch Code</th>
            <th>Clinic Name</th>
            <th>Clinic Date</th>
            <th>Patients</th>
            <th>Specimens</th>
            <th>Status</th>
            <th>Checklist</th>
            <th>Batch Date</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="info">
            <th>Batch Name</th>
            <th>Batch Code</th>
            <th>Clinic Name</th>
            <th>Clinic Date</th>
            <th>Patients</th>
            <th>Specimens</th>
            <th>Status</th>
            <th>Checklist</th>
            <th>Batch Date</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        if (!empty($tracking_list)) {
            $batch_status = 1;
            foreach ($tracking_list as $tracking_data) {
                ?>
                <tr>
                    <td><?php echo $tracking_data->ura_track_batch_name; ?></td>
                    <td><?php echo $tracking_data->ura_track_batch_code; ?></td>
                    <td><?php echo $tracking_data->ura_batch_clinic_name; ?></td>
                    <td><?php echo $tracking_data->ura_batch_clinic_date; ?></td>
                    <td><?php echo $tracking_data->ura_batch_total_patients; ?></td>
                    <td><?php echo $tracking_data->ura_batch_total_specimens; ?></td>
                    <td>
                        
                        <select class="change_status" data-batchid="<?php echo $tracking_data->ura_track_batch_id; ?>">
                            <option value="false">Choose Status</option>
                            <?php
                                $status = array(
                                    'Courier' => 'Courier',
                                    'Lab Processing' => 'Lab Processing',
                                    'Assigned To Doctor' => 'Assigned To Doctor'
                                );
                                
                                foreach($status as $key => $value){
                                   $selected = ''; 
                                    if($value == $tracking_data->ura_batch_status){
                                        $selected = 'selected';   
                                    }
                                    echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td><?php echo $tracking_data->ura_batch_checklist_name; ?></td>
                    <td>
                        <?php
                        $change_date = $tracking_data->ura_batch_timestamp;
                        echo date('d-m-Y', strtotime($change_date));
                        ?>
                    </td>
                    <th>
                        <a href="<?php echo base_url('index.php/admin_tracking/tracking/track_detail/' . $tracking_data->ura_track_batch_id); ?>">
                            <img src="<?php echo base_url('assets/img/detail.png'); ?>" >
                        </a>
                    </th>
                    <th>
                        <a href="<?php echo base_url('index.php/admin_tracking/tracking/update_tracking/?batch_id=' . $tracking_data->ura_track_batch_id . '&name=' . $tracking_data->ura_track_batch_name . '&code=' . $tracking_data->ura_track_batch_code); ?>">
                            <img src="<?php echo base_url('assets/img/edit.png'); ?>" >
                        </a>
                    </th>
                    <th>
                        <a href="<?php echo base_url('index.php/admin_tracking/tracking/delete_tracking/' . $tracking_data->ura_track_batch_id); ?>">
                            <img src="<?php echo base_url('assets/img/delete.png'); ?>" >
                        </a>
                    </th>
                </tr>

                <?php
                $batch_status++;
            }
        }
        ?>
    </tbody>
</table>