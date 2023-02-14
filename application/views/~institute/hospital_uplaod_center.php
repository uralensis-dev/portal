<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="general_padding_t_r_b_l">
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo html_purify($this->session->flashdata('upload_error'));
        }
        ?>
        <?php
        if ($this->session->flashdata('upload_success') != '') {
            echo html_purify($this->session->flashdata('upload_success'));
        }
        ?>
        <?php
        if ($this->session->flashdata('rf_assign_status') != '') {
            echo html_purify($this->session->flashdata('rf_assign_status'));
        }
        ?>
        <?php
        if ($this->session->flashdata('cf_assign_status') != '') {
            echo html_purify($this->session->flashdata('cf_assign_status'));
        }
        ?>
    </div>

    <div class="col-md-6">
        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading"><strong>Assigned Request Forms</strong></div>
            <!-- Table -->
            <div class="scrollable_div">
                <table class="table  table-condensed table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>View</th>
                    <th>Download</th>
                    <th>Time</th>
                </tr>
                <?php
                if (isset($requestforms_assignee) && is_array($requestforms_assignee)) {

                    foreach ($requestforms_assignee as $request_form_data) {
                        ?>
                        <tr>
                            <td><?php echo $request_form_data->upc_file_title; ?></td>
                            <td><?php
                                if ($request_form_data->upc_is_image == 1) {
                                    echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                } else {
                                    echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'uplaod_center/' . $request_form_data->upc_file_name; ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                </a>
                            </td>
                            <td>
                                <a download href="<?php echo base_url() . 'uplaod_center/' . $request_form_data->upc_file_name; ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                </a>
                            </td>
                            <td><?php
                                $time = $request_form_data->upc_upload_date;
                                echo date('d/m/Y G:i', strtotime($time));
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading"><strong>Assigned Checklists</strong></div>
            <!-- Table -->
            <div class="scrollable_div">
                <table class="table  table-condensed table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>View</th>
                    <th>Download</th>
                    <th>Time</th>
                </tr>
                <?php
                if (isset($checlistforms_assignee) && is_array($checlistforms_assignee)) {

                    foreach ($checlistforms_assignee as $checklist_form_data) {
                        ?>
                        <tr>
                            <td><?php echo html_purify($checklist_form_data->upc_file_title); ?></td>
                            <td><?php
                                if ($checklist_form_data->upc_is_image == 1) {
                                    echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                } else {
                                    echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'uplaod_center/' . html_purify($checklist_form_data->upc_file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                </a>
                            </td>
                            <td>
                                <a download href="<?php echo base_url() . 'uplaod_center/' . html_purify($checklist_form_data->upc_file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                </a>
                            </td>
                            <td><?php
                                $time = $checklist_form_data->upc_upload_date;
                                echo date('d/m/Y G:i', strtotime($time));
                                ?>
                            </td>
                        </tr>
                        <?php 
                    }
                }
                ?>
            </table>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    
     <div class="col-md-6">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><strong>Uploaded Request Forms</strong></div>
            <div class="panel-body">
                <form name="upload_requestform" action="<?php echo base_url('/index.php/institute/upload_center_request_form'); ?>" id="upload_requestform" method="post" enctype="multipart/form-data">
                    <table> 
                        <tr>
                            <td><input required class="form-control" type="file" name="upload_center_requestform" id="upload_center_requestform" ></td>
                        <input type="hidden" name="request_form" value="Request Form" >
                        <td><button name="upload_requestform_btn" type="submit" class="btn btn-default upload_requestform_btn">Upload</button></td>
                        </tr>
                    </table>
                </form>
            </div>

            <!-- Table -->
            <div class="scrollable_div">
                <table class="table  table-condensed table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Time</th>
                    
                </tr>
                <?php
                if (isset($requestforms) && is_array($requestforms)) {

                    foreach ($requestforms as $request_form) {
                        ?>
                        <tr>
                            <td><?php echo $request_form->upc_file_title; ?></td>
                            <td><?php
                                if ($request_form->upc_is_image == 1) {
                                    echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                } else {
                                    echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'uplaod_center/' . html_purify($request_form->upc_file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                </a>
                            </td>
                            <td>
                                <a download href="<?php echo base_url() . 'uplaod_center/' . html_purify($request_form->upc_file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo site_url() . '/Institute/delete_upc_files/' . intval($request_form->upc_file_id); ?>">
                                    <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                </a>
                            </td>
                            <td><?php
                                $time = $request_form->upc_upload_date;
                                echo date('d/m/Y G:i', strtotime($time));
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><strong>Uploaded Checklists</strong></div>
            <div class="panel-body">
                <form name="upload_checklistform" action="<?php echo base_url('/index.php/institute/upload_center_checklist_form'); ?>" method="post" enctype="multipart/form-data">
                    <table> 
                        <tr>
                            <td><input required class="form-control" type="file" name="upload_center_checklist" id="upload_center_checklist" ></td>
                        <input type="hidden" name="checklist_form" value="Checklist Form" >
                        <td><button type="submit" class="btn btn-default">Upload</button></td>
                        </tr>
                    </table>
                </form>
            </div>

            <!-- Table -->
            <div class="scrollable_div">
                <table class="table  table-condensed table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Time</th>
                </tr>
                <?php
                if (isset($checlistforms) && is_array($checlistforms)) {

                    foreach ($checlistforms as $checklist_form) {
                        ?>
                        <tr>
                            <td><?php echo $checklist_form->upc_file_title; ?></td>
                            <td><?php
                                if ($checklist_form->upc_is_image == 1) {
                                    echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                } else {
                                    echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'uplaod_center/' . html_purify($checklist_form->upc_file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                </a>
                            </td>
                            <td>
                                <a download href="<?php echo base_url() . 'uplaod_center/' . html_purify($checklist_form->upc_file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo site_url() . '/Institute/delete_upc_files/' . intval($checklist_form->upc_file_id); ?>">
                                    <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                </a>
                            </td>
                            <td><?php
                                $time = $checklist_form->upc_upload_date;
                                echo date('d/m/Y G:i', strtotime($time));
                                ?>
                            </td>
                        </tr>
                        <?php 
                    }
                }
                ?>
            </table>
            </div>
        </div>
    </div>
    
</div>
