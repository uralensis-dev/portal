<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row report_listing">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('message_further') != '') {
            ?>
            <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_further'); ?></p>
        <?php } ?>
        <?php
        if ($this->session->flashdata('message_additional') != '') {
            ?>
            <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_additional'); ?></p>
        <?php } ?>
        <?php
        if ($this->session->flashdata('final_report_message') != '') {
            echo $this->session->flashdata('final_report_message');
        }
        ?>
        <?php
        if ($this->session->flashdata('record_updated') != '') {
            echo $this->session->flashdata('record_updated');
        }
        ?>
        <a onclick="window.history.back();"><button class="btn btn-primary"><< Go Back</button></a>
        <br /><br />
        <div class="flag_message"></div>
        <div id="advance_search_table">
            <form action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                <table class="table table-bordered">
                    <tr class="bg-primary">
                        <th>Emis No</th>
                        <th>NHS No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Lab No</th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" type="text" id="emis_no" name="emis_no">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="f_name" name="f_name">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="l_name" name="l_name">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="lab_no" name="lab_no">
                        </td>
                    </tr>

                </table>
                <div>
                    <button type="submit" class="btn btn-warning">Search</button>
                </div> 
            </form>
        </div>
        <p class="pull-right"><a id="doctor_advance_search" href="javascript:;">Advance Search</a></p>
        <div class="clearfix"></div>
        <div class="flag_sorting">
            <label for="flag_green">
                <input type="radio" name="flag_sorting" id="flag_green" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
            </label>
            <label for="flag_red">
                <input type="radio" name="flag_sorting" id="flag_red" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
            </label>
            <label for="flag_yellow">
                <input type="radio" name="flag_sorting" id="flag_yellow" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
            </label>
            <label for="flag_blue">
                <input type="radio" name="flag_sorting" id="flag_blue" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
            </label>
            <label for="flag_black">
                <input type="radio" name="flag_sorting" id="flag_black" class="flag_status">
                <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
            </label>
            <label for="flag_all">
                <input type="radio" name="flag_sorting" id="flag_all" class="flag_status">
                <img src="<?php echo base_url('assets/img/flag_all.png'); ?>">
            </label>
        </div>
        <button class="sort_by_authorize">Sort by authorize</button>
        <table id="doctor_record_publish_table" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr class="info">
                    <th><input type="checkbox" name="check_all"><a href="javascript:;" class="generate-bulk-reports" data-bulkurl="<?php echo base_url('index.php/doctor/generateBulkReports'); ?>"><img width="22px" src="<?php echo base_url('assets/img/download-1.png'); ?>"></a><input type="hidden" name="bulk_report_ids"></th>
                    <th>UL No.</th>
                    <th>Track No.</th>
                    <th>First name</th>
                    <th>Surname:</th>
                    <th>DOB.</th>
                    <th>PCI No.</th>
                    <th>EMIS No.</th>
                    <th>NHS No.</th>
                    <th>LAB.No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Authorised</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>Docs</th>
                    <th>Un Publish</th>
                    <th class="text-center">Flag</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="info">
                    <th>&nbsp;</th>
                    <th>UL No.</th>
                    <th>Track No.</th>
                    <th>First name</th>
                    <th>Surname:</th>
                    <th>DOB.</th>
                    <th>PCI No.</th>
                    <th>EMIS No.</th>
                    <th>NHS No.</th>
                    <th>LAB.No.</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Request Date:</th>
                    <th>Received by Lab.</th>
                    <th>Authorised</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                    <th>Docs</th>
                    <th>Un Publish</th>
                    <th class="text-center">Flag</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>