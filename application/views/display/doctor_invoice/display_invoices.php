<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary" data-toggle="collapse" data-target="#doc_inv_temp">Invoice Template Settings</button>
        <div id="doc_inv_temp" class="collapse">
            <form class="form doctor_invoice_temp_form">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <select class="form-control find_doctor_inv_temp" name="doctors_list" id="doctors_list">
                            <option value="0">Select Doctor</option>
                            <?php
                            if (!empty($doctor_list)) {
                                foreach ($doctor_list as $list_doctors) {
                                    echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Invoice To Section Settings</h3>
                        <textarea name="inv_left_settings" cols="10" rows="10" class="form-control inv_left_settings"></textarea>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <h3>Invoice From Section Settings</h3>
                        <textarea name="inv_right_settings" cols="10" rows="10" class="form-control inv_right_settings"></textarea>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Invoice Comments Section</h3>
                        <textarea name="inv_comments_settings" cols="10" rows="10" class="form-control inv_comments_settings"></textarea>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <h3>Invoice Footer Section</h3>
                        <textarea name="inv_footer_settings" cols="10" rows="10" class="form-control inv_footer_settings"></textarea>
                        <hr>
                        <button class="btn btn-success pull-right save_doc_inv_temp">Save Template</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <h3 class="text-center">Add Doctor Invoice Options</h3>
        <form class="form doc_inv_form">
            <div class="form-group">
                <select class="form-control" name="doctors_list" id="doctors_list">
                    <option value="0">Select Doctor</option>
                    <?php
                    if (!empty($doctor_list)) {
                        foreach ($doctor_list as $list_doctors) {
                            echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select name="inv_hospital" class="form-control">
                    <option value="">Choose Hospital</option>
                    <?php
                    if (!empty($hospitals_list)) {
                        foreach ($hospitals_list as $hospitals) {
                            echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="use_tat">Use TAT</label>
                <input type="checkbox" name="doc_inv_tat">
            </div>

            <div class="show_tat_opt hidden-boxes">
                <div class="form-group">
                    <select class="form-control" name="tat_duration">
                        <option value="">Choose TAT Duration</option>
                        <option value="tat_1_to_3">TAT 1 - 3</option>
                        <option value="tat_4_to_6">TAT 4 - 6</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Routine Per Case Rate</label>
                <input class="form-control" type="text" name="hos_inv_routine_rate">
            </div>
            <div class="form-group">
                <label>Alopecia Per Case Rate</label>
                <input class="form-control" type="text" name="hos_inv_alopecia_rate">
            </div>
            <div class="form-group">
                <label>IMF Per Case Rate</label>
                <input class="form-control" type="text" name="hos_inv_imf_rate">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary doc_inv_btn">Save</button>
            </div>
        </form>
    </div>
    <div class="col-md-6 doctor_invoice_data">
        <h3 class="text-center">Search Doctor Invoice Options</h3>
        <select class="form-control refresh_doc_inv_opt_data" name="doctors_list">
            <option value="0">Select Doctor</option>
            <?php
            if (!empty($doctor_list)) {
                foreach ($doctor_list as $list_doctors) {
                    echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                }
            }
            ?>
        </select>
        <div class="load_doc_inv_opt_data">

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h3 class="text-center">Generate Invoice</h3>
        <form id="invoice_case_form">
            <div class="form-group">
                <label for="doctors_list">Choose Doctor</label>
                <select class="form-control" name="doctors_list" id="doctors_list">
                    <option value="0">Select Doctor</option>
                    <?php
                    if (!empty($doctor_list)) {
                        foreach ($doctor_list as $list_doctors) {
                            echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="case_cost_date_from">Choose Date From</label>
                <input class="form-control" type="text" name="case_cost_date_from" id="case_cost_date_from" placeholder="Date From">
            </div>
            <div class="form-group">
                <label for="case_cost_date_to">Choose Date To</label>
                <input class="form-control" type="text" name="case_cost_date_to" id="case_cost_date_to" placeholder="Date To">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-success generate_invoice_btn">Generate Invoice</button>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row invoice_records">
    <div class="col-md-4 col-md-offset-4">
        <h4>Search Invoice</h4>
        <div class="form-group">
            <label for="search_inv_by_doc">Choose Doctor</label>
            <select class="form-control" name="search_inv_by_doc" id="search_inv_by_doc">
                <option value="">Select Doctor</option>
                <?php
                if (!empty($doctor_list)) {
                    foreach ($doctor_list as $list_doctors) {
                        echo '<option value="' . $list_doctors->id . '">' . $list_doctors->first_name . $list_doctors->last_name . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-12 display_invoice_data">

    </div>
</div>