<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="advance_search_table">
<?php
           $attributes = array('class' => '');
            echo form_open("Doctor/search_request", $attributes);
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
    <p class="text-center lead"><i>Choose MDT Cases By Hospital</i></p>
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('hospital_select_error') != '') {
            echo $this->session->flashdata('hospital_select_error');
        }
        ?>
        <div class="dates_find"></div>
        <div class="prev_dates_find"></div>
        <div class="records_found"></div>
        <div class="prev_records_found"></div>
        <form method="get" action="<?php echo base_url('index.php/doctor/find_mdt_cases'); ?>" class="form">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Up Coming MDT Dates</strong>
                    <select required class="form-control" name="hospital_id" id="mdt_hospital_id_new">
                        <option value="false">Choose Hospital</option>
                        <?php
                        if (!empty($get_hospitals)) {
                            foreach ($get_hospitals as $list_hospitals) {
                                echo '<option value="' . $list_hospitals->id . '">' . $list_hospitals->description . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Archived MDT Dates</strong>
                    <select required class="form-control" name="prev_hospital_id" id="prev_mdt_hospital_id_new">
                        <option value="false">Choose Hospital</option>
                        <?php
                        if (!empty($get_hospitals)) {
                            foreach ($get_hospitals as $list_hospitals) {
                                echo '<option value="' . $list_hospitals->id . '">' . $list_hospitals->description . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="mdt_list_ajax_data"></div>
                    <div class="mdt_dates_ajax_data"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="mdt_list_ajax_data_prev"></div>
                    <div class="mdt_dates_ajax_data_prev"></div>
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
