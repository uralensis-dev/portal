<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary" data-toggle="collapse" data-target="#hos_inv_temp">Invoice Template Settings</button>
        <div id="hos_inv_temp" class="collapse">
            <form class="form hospital_invoice_temp_form">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <select name="inv_hospital" class="form-control find_hospital_inv_temp">
                            <option value="">Choose Hospital</option>
                            <?php
                            if (!empty($hospitals_list)) {
                                foreach ($hospitals_list as $hospitals) {
                                    echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                }
                            }
                            ?>
                        </select>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload your logo here.</label>
                            <a id="upload_to_sec_logo" href="javascript:;" class="btn btn-success"><span class="lnr lnr-upload"></span></a>
                            <div id="plupload-profile-container"></div>
                            <div class="profile-to-sec-img-wrap"></div>
                            <p class="invoice_to_section_logo"></p>
                            <input type="hidden" name="invoice_to_sec_logo" value="">
                        </div>
                        <h3>Invoice To Section Settings</h3>
                        <textarea name="inv_left_settings" cols="10" rows="10" class="form-control inv_left_settings"></textarea>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload your logo here.</label>
                            <a id="upload_from_sec_logo" href="javascript:;" class="btn btn-success"><span class="lnr lnr-upload"></span></a>
                            <div id="plupload-profile-container"></div>
                            <div class="profile-from-sec-img-wrap"></div>
                            <p class="invoice_from_section_logo"></p>
                            <input type="hidden" name="invoice_from_sec_logo" value="">
                        </div>
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
                        <button class="btn btn-success pull-right save_hos_inv_temp">Save Template</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
<h3 class="text-center">Hospital Invoice Settings</h3>
<div class="row">
    <div class="col-md-4">
        <form class="form hos_inv_form">
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
                <input type="checkbox" name="hos_inv_tat">
            </div>
            <div class="hide_if_tat_select">
                <div class="form-group">
                    <label>Cost Code Name</label>
                    <input class="form-control" type="text" name="hos_cost_code_name_without_tat">
                </div>
                <div class="form-group">
                    <label>Cost Code Price</label>
                    <input class="form-control" type="text" name="hos_cost_code_price">
                </div>
                <div class="form-group">
                    <label>Cost Code Description</label>
                    <textarea class="form-control" name="hos_cost_code_desc"></textarea>
                </div>
            </div>
            <div class="show_tat_opt hidden-boxes">
                <div class="form-group">
                    <label>Cost Code Name</label>
                    <input class="form-control" type="text" name="hos_cost_code_name">
                </div>
                <div class="form-group">
                    <label>Cost Code Price 1 - 6</label>
                    <input class="form-control" type="text" name="hos_cost_code_price_1_to_6">
                </div>
                <div class="form-group">
                    <label>Cost Code Description 1 - 6</label>
                    <textarea class="form-control" name="hos_cost_code_desc_1_to_6"></textarea>
                </div>
                <div class="form-group">
                    <label>Cost Code Price 7 - Above</label>
                    <input class="form-control" type="text" name="hos_cost_code_price_7_to_abv">
                </div>
                <div class="form-group">
                    <label>Cost Code Description 7 - Above</label>
                    <textarea class="form-control" name="hos_cost_code_desc_7_to_abv"></textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary hos_inv_btn">Save</button>
            </div>
        </form>
    </div>
    <div class="col-md-8 hospital_invoice_data">
        <select name="hospial_group_id" class="form-control refresh_hos_inv_opt_data">
            <option value="">Choose Hospital</option>
            <?php
            if (!empty($hospitals_list)) {
                foreach ($hospitals_list as $hospitals) {
                    echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                }
            }
            ?>
        </select>
        <div class="load_hos_inv_opt_data"></div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h3 class="text-center">Generate Invoice</h3>
        <form id="admin_invoice_case_form">
            <div class="form-group">
                <label for="doctors_list">Choose Hospital</label>
                <select name="hospial_group_id" class="form-control">
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
                <label for="case_cost_date_from">Choose Date From</label>
                <input class="form-control" type="text" name="case_cost_date_from" id="case_cost_date_from" placeholder="Date From">
            </div>
            <div class="form-group">
                <label for="case_cost_date_to">Choose Date To</label>
                <input class="form-control" type="text" name="case_cost_date_to" id="case_cost_date_to" placeholder="Date To">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-success generate_admin_invoice_btn">Generate Invoice</button>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row invoice_records">
    <div class="col-md-4 col-md-offset-4">
        <h4>Search Invoice</h4>
        <div class="form-group">
            <label for="search_hos_inv">Choose Hospital</label>
            <select name="hospital_group_id" class="form-control search_hos_inv" id="search_hos_inv">
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
    </div>
    <div class="col-md-12 display_invoice_data"></div>
</div>