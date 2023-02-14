<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
        <form method="get" action="<?php echo base_url('index.php/secretary/find_mdt_cases'); ?>" class="form">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Up Coming MDT Dates</strong>
                    <select required class="form-control" name="hospital_id" id="mdt_hospital_id">
                        <option value="false">Choose Hospital</option>
                        <?php
                        if (!empty($get_hospitals)) {
                            foreach ($get_hospitals as $list_hospitals) {
                                echo '<option value="' . intval($list_hospitals->id) . '">' . html_purify($list_hospitals->description) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Archived MDT Dates</strong>
                    <select required class="form-control" name="prev_hospital_id" id="prev_mdt_hospital_id">
                        <option value="false">Choose Hospital</option>
                        <?php
                        if (!empty($get_hospitals)) {
                            foreach ($get_hospitals as $list_hospitals) {
                                echo '<option value="' . intval($list_hospitals->id) . '">' . html_purify($list_hospitals->description) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="mdt_dates_ajax_data"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
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
