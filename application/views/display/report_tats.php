<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
function display_tat10_form($hospital_groups) {
    ?>
    <div class="well">
        <form id="generate_tat10_report" action="<?php echo base_url('index.php/admin/generate_tat10/'); ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="custom_label" for="hospital_list">Choose Hospital</label>
                    <select class="custom_input" name="hospital_list" id="hospital_list">
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
            <div class="col-md-6">
                <div class="form-group">
                    <button value="tat10_pdf" name="tat10_pdf" id="tat10_pdf" type="submit" class="btn btn-primary pull-right">Generate PDF</button>
                    <button value="tat10_csv" name="tat10_csv" id="tat10_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}
function display_tat2w_form($hospital_groups) {
    ?>
    <div class="well">
        <form id="generate_tat2w_report" action="<?php echo base_url('index.php/admin/generate_tat2w/'); ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="custom_label" for="hospital_list">Choose Hospital</label>
                    <select class="custom_input" name="hospital_list" id="hospital_list">
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
            <div class="col-md-6">
                <div class="form-group">
                    <button value="tat2w_pdf" name="tat2w_pdf" id="tat2w_pdf" type="submit" class="btn btn-primary pull-right">Generate PDF</button>
                    <button value="tat2w_csv" name="tat2w_csv" id="tat2w_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}
function display_tat3w_form($hospital_groups) {
    ?>
    <div class="well">
        <form id="generate_tat3w_report" action="<?php echo base_url('index.php/admin/generate_tat3w/'); ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="custom_label" for="hospital_list">Choose Hospital</label>
                    <select class="custom_input" name="hospital_list" id="hospital_list">
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
            <div class="col-md-6">
                <div class="form-group">
                    <button value="tat3w_pdf" name="tat3w_pdf" id="tat3w_pdf" type="submit" class="btn btn-primary pull-right">Generate PDF</button>
                    <button value="tat3w_csv" name="tat3w_csv" id="tat3w_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}

function display_fw_report($hospital_groups) {
    ?>
    <div class="well">
        <form id="generate_finance_report" action="<?php echo base_url('index.php/admin/generate_fw_reprot/'); ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="custom_label" for="hospital_list">Choose Hospital</label>
                    <select class="custom_input" name="hospital_list" id="hospital_list">
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
            <div class="col-md-6">
                <div class="form-group">
                    <button name="fw_report_pdf" id="fw_report_pdf" type="submit" class="btn btn-primary pull-right">Generate PDF</button>
                    <button name="fw_report_csv" id="fw_report_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}

function display_imf_report($hospital_groups) {
    ?>
    <div class="well">
    <?php
           $attributes = array('class' => '','id'=>'generate_finance_report');
            echo form_open("admin/generate_imf_reprot/", $attributes);
            ?>
    
           <div class="col-md-6">
                <div class="form-group">
                    <label class="custom_label" for="hospital_list">Choose Hospital</label>
                    <select class="custom_input" name="hospital_list" id="hospital_list">
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
            <div class="col-md-6">
                <div class="form-group">
                    <button name="imf_report_pdf" id="imf_report_pdf" type="submit" class="btn btn-primary pull-right">Generate PDF</button>
                    <button name="imf_report_csv" id="imf_report_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php
}
