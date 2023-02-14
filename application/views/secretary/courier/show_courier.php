<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-6 text-center">
        <button data-toggle="collapse" data-target="#add_batch" class="btn btn-success">Add Batch</button>
    </div>
    <div class="col-md-6 text-center">
        <button data-toggle="collapse" data-target="#add_courier" class="btn btn-success">Add Courier</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="add_batch" class="collapse">
            <hr>
            <form id="add_batch_form" class="form">
                <div class="form-group">
                    <label for="batch_hospital_id">Hospital</label>
                    <select required name="batch_hospital_id" id="batch_hospital_id" class="form-control">
                        <option value="false">Choose Hospital</option>
                        <?php
                        if (!empty($hospitals_list)) {
                            foreach ($hospitals_list as $hospitals) {
                                echo '<option value="' . intval($hospitals->id) . '">' . html_purify($hospitals->description) . '</option> ';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="batch_ref_key">

                </div>
                <div class="batch_courier_data">

                </div>
                <div class="form-group">
                    <label for="batch_courier_collec_date">Collection Date</label>
                    <input readonly class="form-control" type="text" name="batch_courier_collec_date" id="batch_courier_collec_date">
                </div>
                <div class="form-group">
                    <label for="batch_courier_tracky_no">Courier Tracky No.</label>
                    <input class="form-control" type="text" name="batch_courier_tracky_no" id="batch_courier_tracky_no">
                </div>
                <div class="batch_courier_cost_code_price">

                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary batch_add_btn">Add Batch</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div id="add_courier" class="collapse">
            <hr>
            <form id="add_courier_form" class="form">
                <div class="form-group">
                    <label for="hospital_id">Hospital</label>
                    <select required name="hospital_id" class="form-control">
                        <option value="false">Choose Hospital</option>
                        <?php
                        if (!empty($hospitals_list)) {
                            foreach ($hospitals_list as $hospitals) {
                                echo '<option value="' . intval($hospitals->id) . '">' . html_purify($hospitals->description) . '</option> ';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="courier_name">Courier Name</label>
                    <input required class="form-control" type="text" name="courier_name" id="courier_name">
                </div>
                <div class="form-group">
                    <label for="courier_address">Courier Address</label>
                    <input required class="form-control" type="text" name="courier_address" id="courier_address">
                </div>
                <div class="form-group">
                    <label for="courier_cost_code">Courier Cost Code</label>
                    <input required class="form-control" type="text" name="courier_cost_code" id="courier_cost_code">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary add_courier">Add Courier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <hr>
        <select class="form-control batch_courier_hospital_record">
            <option value="false">Choose Hospital</option>
            <?php
            if (!empty($hospitals_list)) {
                foreach ($hospitals_list as $hospitals) {
                    echo '<option value="' . intval($hospitals->id) . '">' . html_purify($hospitals->description) . '</option> ';
                }
            }
            ?>
        </select>
        <hr>
        <div class="courier_batch_records_data"></div>
    </div>
    <div class="col-md-6">
        <hr>
        <select class="form-control courier_hospital_record">
            <option value="false">Choose Hospital</option>
            <?php
            if (!empty($hospitals_list)) {
                foreach ($hospitals_list as $hospitals) {
                    echo '<option value="' . intval($hospitals->id) . '">' . html_purify($hospitals->description) . '</option> ';
                }
            }
            ?>
        </select>
        <hr>
        <div class="courier_records_data"></div>
    </div>
</div>