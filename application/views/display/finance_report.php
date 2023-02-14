<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <p><a href="<?php echo base_url('index.php/admin/manage_cost_codes'); ?>">Manage Cost Codes</a></p>
        <?php
        if ($this->session->flashdata('finance_search_error') != '') {
            echo $this->session->flashdata('finance_search_error');
        }?>
        <div class="well">
            <form id="generate_finance_report" action="<?php echo base_url('index.php/admin/generate_finance/'); ?>" method="get">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="custom_label" for="date_from">Choose Date From</label>
                        <input class="custom_input" type="text" name="date_from" id="date_from" placeholder="Date From">
                    </div>
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
                        <label class="custom_label" for="date_to">Choose Date To</label>
                        <input class="custom_input" type="text" name="date_to" id="date_to" placeholder="Date To">
                    </div>
                    <div class="form-group">
                        <button value="finance_pdf" name="finance_pdf" id="finance_pdf" type="submit" class="btn btn-primary pull-right">Generate PDF</button>
                        <button value="finance_csv" name="finance_csv" id="finance_csv" type="submit" class="btn btn-primary pull-right">Generate CSV</button>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
