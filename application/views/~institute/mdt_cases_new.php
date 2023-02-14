<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="advance_search_table">
<?php
           $attributes = array('class' => '');
            echo form_open("institute/search_request", $attributes);
            ?>
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
        <div>
            <button type="submit" class="btn btn-warning">Search</button>
        </div> 
    </form>
</div>
<p class="pull-right"><a id="doctor_advance_search" href="javascript:void(0);">Advance Search</a></p>
<div class="clearfix"></div>
<div class="row mdt_dates_content">
    <p class="text-center lead"><i>Choose MDT Cases By MDT Dates</i></p>
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('hospital_select_error') != '') {
            echo html_purify($this->session->flashdata('hospital_select_error'));
        }
        ?>
        <div class="dates_find"></div>
        <div class="prev_dates_find"></div>
        <div class="records_found"></div>
        <div class="prev_records_found"></div>
        <form method="get" action="<?php echo base_url('index.php/institute/find_mdt_cases'); ?>" class="form">
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    if (!empty($coming_mdt)) {
                        
                        ?>
                        <select class="form-control" name="mdt_dates" id="mdt_dates_new" data-hospital-id="<?php echo intval($coming_mdt[0]->ura_mdt_hospital_id); ?>">
                            <option value="false">Choose Up Coming MDT Dates</option>
                            <?php
                            foreach ($coming_mdt as $dates) {
                                echo '<option value="' . $dates->ura_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                            }
                            ?>
                        </select>
                        <?php
                    }else{
                        echo '<div class="alert alert-danger">There is no UpComing MDT Record Dates Found.</div>';
                    }
                    ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    if (!empty($prev_mdt)) {
                        ?>
                        <select class="form-control" name="prev_mdt_dates" id="prev_mdt_dates_new" data-hospital-id="<?php echo intval($prev_mdt[0]->ura_mdt_hospital_id); ?>">
                            <option value="false">Choose Archived MDT Dates</option>
                            <?php
                            foreach ($prev_mdt as $dates) {
                                echo '<option value="' . $dates->ura_mdt_timestamp . '">' . $dates->ura_mdt_date . '</option>';
                            }
                            ?>
                        </select>
                        <?php
                    }else{
                        echo '<div class="alert alert-danger">There is no Archive MDT Record Dates Found.</div>';
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="dynamic_mdt_data"></div>
    </div>
    <div class="col-md-6">
        <div class="dynamic_prev_mdt_data"></div>
    </div>
</div>
