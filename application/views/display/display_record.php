<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-info">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Enable/Disable Search
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <form action="<?php echo site_url('Admin/search_request'); ?>" method="post">
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
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-warning">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#batch_process">Run Batch Assigning Process</a>
                            </h4>
                        </div>
                        <div id="batch_process" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="unassign_records">
                                    <form id="assign_doc_form">
                                <?php echo form_open("", array('id' => 'assign_doc_form')); ?>
                                   <!-- <form id="assign_doc_form">
                                        <div class="form-group">
                                            <select class="form-control" name="doctor" id="doctor">
                                                <option value="0">Choose Doctor</option>
                                                <?php
                                                foreach ($doctor_list as $doctors) :
                                                    ?>
                                                    <option value="<?php echo $doctors->id; ?>"><?php echo $doctors->username; ?></option>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </select>
                                            <hr />
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>&nbsp</th>
                                                <th>UL No.</th>
                                                <th>First name</th>
                                                <th>Surname</th>
                                                <th>EMIS No.</th>
                                                <th>NHS No.</th>
                                                <th>Lab. No.</th>
                                                <th>Status</th>
                                            </tr>
                                            <?php if (!empty($display_unassign_records) && is_array($display_unassign_records)) { ?>
                                                <?php foreach ($display_unassign_records as $unassign_records) { ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="assign_id[]" value="<?php echo $unassign_records->uralensis_request_id; ?>"></td>
                                                        <td><?php echo $unassign_records->serial_number; ?></td>
                                                        <td><?php echo $unassign_records->f_name; ?></td>
                                                        <td><?php echo $unassign_records->sur_name; ?></td>
                                                        <td><?php echo $unassign_records->emis_number; ?></td>
                                                        <td><?php echo $unassign_records->nhs_number; ?></td>
                                                        <td><?php echo $unassign_records->lab_number; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($unassign_records->assign_status == 0) {
                                                                echo 'Not Assigned';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </table>
                                        <div class="form-group">
                                            <button type="button" id="assign_btn" class="btn btn-primary">Assign</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel-footer">&nbsp</div>
                        </div>
                    </div>
                </div>
                <div class="flag_sorting">
                    <label for="flag_green">
                        <input type="radio" name="flag_sorting" id="flag_green" class="flag_status">
                        <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                    </label>
                    <label for="flag_red">
                        <input type="radio" name="flag_sorting" id="flag_red" class="flag_status">
                        <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                    </label>
                    <label for="flag_yellow">
                        <input type="radio" name="flag_sorting" id="flag_yellow" class="flag_status">
                        <img data-toggle="tooltip" data-placement="top" title="This case marked for review." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                    </label>
                    <label for="flag_blue">
                        <input type="radio" name="flag_sorting" id="flag_blue" class="flag_status">
                        <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                    </label>
                    <label for="flag_black">
                        <input type="radio" name="flag_sorting" id="flag_black" class="flag_status">
                        <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                    </label>
                    <label for="flag_all">
                        <input type="radio" name="flag_sorting" id="flag_all" class="flag_status">
                        <img src="<?php echo base_url('assets/img/flag_all.png'); ?>">
                    </label>
                </div>
                <div class="row">
                    <div class="flag_message"></div>
                    <div class="col-md-12">
                        <?php
                        if ($this->session->flashdata('edit_message') != '') {
                            echo $this->session->flashdata('edit_message');
                        }
                        ?>
                        <?php
                        if ($this->session->flashdata('specimen_added') != '') {
                            echo $this->session->flashdata('specimen_added');
                        }
                        ?>
                        <?php
                        if ($this->session->flashdata('specimen_deleted') != '') {
                            echo $this->session->flashdata('specimen_deleted');
                        }
                        ?>
                        <?php
                        if ($this->session->flashdata('unpublish_record_message') != '') {
                            echo $this->session->flashdata('unpublish_record_message');
                        }
                        ?>
                        <?php
                        if ($this->session->flashdata('record_status') != '') {
                            echo $this->session->flashdata('record_status');
                        }
                        ?>
                        <table id="admin_display_records" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr class="bg-primary">
                                    <th>UL No.<br />Track No.</th>
                                    <th>Client<br />Clinic</th>
                                    <th>Courier<br />Assignment No.</th>
                                    <th>Batch<br />PCI No.</th>
                                    <th>First<br />Surname</th>
                                    <th>NHS No.<br />DOB</th>
                                    <th>LAB No.<br />Rel Date</th>
                                    <th><i class="lnr lnr-layers" style="font-size:18px;"></i></th>
                                    <th>Status</th>
                                    <th style="text-align: center; width: 104px;">Flag</th>
                                    <th><i class="lnr lnr-bubble" style="font-size:18px;"></i></th>
                                    <th><i class="lnr lnr-file-empty" style="font-size:18px;"></i></th>
                                    <th>A-S</th>
                                    <th>P-S</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="hide_content">&nbsp;</th>
                                    <th class="hide_content">&nbsp;</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>