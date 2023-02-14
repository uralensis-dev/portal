<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('cost_code_msg') != '') {
            echo $this->session->flashdata('cost_code_msg');
        }
        ?>
        <a href="<?php echo base_url('index.php/admin/show_finance_display'); ?>">
            <button class="btn btn-primary"><< Go Back</button>
        </a>
        <button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#add_cost_code">Add Cost Code</button>
        <hr>
        <div class="clearfix"></div>
        <div id="add_cost_code" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enter Cost Code Rates Here</h4>
                    </div>
                    <div class="modal-body">
                        <div class="cost_code_msg"></div>
                        <form class="form" id="save_cost_codes">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="hospital_list">Choose Hospital</label>
                                        <select class="form-control" name="hospital_list" id="hospital_list">
                                            <option value="0">Choose Hospital</option>
                                            <?php
                                            if (!empty($hospital_groups)) {
                                                foreach ($hospital_groups as $groups) {
                                                    echo '<option value="' . $groups->id . '">' . $groups->description . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_type">Choose Type</label>
                                        <!--<a class="pull-right" data-toggle="modal" data-target="#add_cost_code_type">Add Cost Code Type</a>-->
                                        <select style="margin-top:8px;" class="form-control" name="service_type" id="service_type">
                                            <option value="null">Choose Type</option>
                                            <option value="block">Blocks</option>
                                            <option value="imf">IMF</option>
                                            <option value="immuno">Immunos</option>
                                            <option value="fwlevels">Further Work Special Stains</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Per Rate Name</label>
                                        <input class="form-control" type="text" name="rate" id="rate" placeholder="Enter Rate. eg: Per Specimen">
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Storage Price</label>
                                        <input class="form-control" type="text" name="storage_price" id="storage_price" placeholder="Enter Storage Price. eg: 1.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prefix">Prefix</label>
                                        <input class="form-control" type="text" name="prefix" id="prefix" placeholder="Enter Prefix eg: CB001">
                                    </div>
                                    <div class="form-group">
                                        <label for="cost">Cost</label>
                                        <input class="form-control" type="text" name="cost" id="cost" placeholder="Enter Cost (&pound;)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="service_desc">Service / Sample</label>
                                        <textarea rows="7" class="form-control" name="service_desc" id="service_desc" placeholder="Enter Your Service Description. eg: 1Block, 2Block - (Note : Please enter only letters, do not use any special characters like comma or semi colon or periods. Whatever you enter in this field will display in your dropdown list or display with checkboxes, So enter only concise text here.)"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning" id="save_cost_codes_btn">Save Cost Code</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="display_cost_code_msg"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label>List Cost Code By Hospital</label>
        <select class="form-control hospital_list" name="hospital_list" id="hospital_list">
            <option value="0">Choose Hospital</option>
            <?php
            if (!empty($hospital_groups)) {
                foreach ($hospital_groups as $groups) {
                    echo '<option value="' . $groups->id . '">' . $groups->description . '</option>';
                }
            }
            ?>
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div id="display_cost_table"></div>
    </div>
</div>