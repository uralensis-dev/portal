<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<div class="row">
    <div class="general_padding_t_r_b_l">
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo $this->session->flashdata('upload_error');
        }
        ?>
        <?php
        if ($this->session->flashdata('upload_success') != '') {
            echo $this->session->flashdata('upload_success');
        }
        ?>
        <?php
        if ($this->session->flashdata('rf_assign_status') != '') {
            echo $this->session->flashdata('rf_assign_status');
        }
        ?>
        <?php
        if ($this->session->flashdata('cf_assign_status') != '') {
            echo $this->session->flashdata('cf_assign_status');
        }
        ?>
    </div>

    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><strong>Request Forms</strong></div>
            <div class="panel-body">
                <form name="upload_requestform" action="<?php echo base_url('/index.php/admin/upload_center_request_form'); ?>" id="upload_requestform" method="post" enctype="multipart/form-data">
                    <table> 
                        <tr>
                            <td><input required class="form-control" type="file" name="upload_center_requestform" id="upload_center_requestform" ></td>
                        <input type="hidden" name="request_form" value="Request Form" >
                        <td><button name="upload_requestform_btn" type="submit" class="btn btn-default upload_requestform_btn">Upload</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="scrollable_div">
                <table class="table  table-condensed table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>Time</th>
                        <th>Assign To</th>
                    </tr>
                    <?php
                    $count = 1;
                    if (isset($requestforms) && is_array($requestforms)) {
                        foreach ($requestforms as $request_form_data) {
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
                                <td>
                                    <a href="<?php echo site_url() . '/admin/delete_upc_files/' . $request_form_data->upc_file_id; ?>">
                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                    </a>
                                </td>
                                <td><?php
                                    $time = $request_form_data->upc_upload_date;
                                    echo date('d/m/Y G:i', strtotime($time));
                                    ?>
                                </td>
                                <td>
                                    <?php if (!$request_form_data->upc_file_status == 1) { ?>
                                        <button id="upload_rf_pop_id-<?php echo $count; ?>" class="btn btn-link" ><span class="label label-warning">Add</span></button>
                                        <div class="upload_rf_popup" id="upload_rf_popup-<?php echo $count; ?>" style="display: none;">
                                            <span class="button b-close"><span>X</span></span>
                                            <form method="post" action="<?php echo site_url('admin/assign_upc_files_rf'); ?>">
                                                <div class="form-group">
                                                    <label for="assignee_list_rf">Assign To</label>
                                                    <select class="form-control" name="assignee_list_rf" id="assignee_list_rf">
                                                        <?php
                                                        $get_hospital_users = $this->Admin_model->get_all_hospital_users();
                                                        if (!empty($get_hospital_users) && is_array($get_hospital_users)) {
                                                            foreach ($get_hospital_users as $hospital_users) {
                                                                echo '<option value="' . $hospital_users->id . '">' . $hospital_users->first_name . $hospital_users->last_name . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" name="upc_file_id_rf" value="<?php echo $request_form_data->upc_file_id; ?>">
                                                    <input type="hidden" name="upc_file_type_code_rf" value="<?php echo $request_form_data->upc_file_type_code; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </form>
                                        </div>
                                        <script>
                                            jQuery(document).ready(function () {
                                                jQuery('#upload_rf_pop_id-<?php echo $count; ?>').click(function () {
                                                    jQuery('#upload_rf_popup-<?php echo $count; ?>').bPopup({
                                                        easing: 'easeOutBack',
                                                        speed: 450
                                                    });
                                                });
                                            });
                                        </script>
                                    <?php
                                    } else {
                                        echo '<span class="label label-success">' . $request_form_data->upc_file_assignee_name . '</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $count++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><strong>Checklists</strong></div>
            <div class="panel-body">
                <form name="upload_checklistform" action="<?php echo base_url('/index.php/admin/upload_center_checklist_form'); ?>" method="post" enctype="multipart/form-data">
                    <table> 
                        <tr>
                            <td><input required class="form-control" type="file" name="upload_center_checklist" id="upload_center_checklist" ></td>
                        <input type="hidden" name="checklist_form" value="Checklist Form" >
                        <td><button type="submit" class="btn btn-default">Upload</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="scrollable_div">
                <table class="table  table-condensed table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>Time</th>
                        <th>Assign To</th>
                    </tr>
                    <?php
                    $cl_count = 1;
                    if (isset($checlistforms) && is_array($checlistforms)) {

                        foreach ($checlistforms as $checklist_form_data) {
                            ?>
                            <tr>
                                <td><?php echo $checklist_form_data->upc_file_title; ?></td>
                                <td><?php
                                    if ($checklist_form_data->upc_is_image == 1) {
                                        echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                    } else {
                                        echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() . 'uplaod_center/' . $checklist_form_data->upc_file_name; ?>" target="_blank">
                                        <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                    </a>
                                </td>
                                <td>
                                    <a download href="<?php echo base_url() . 'uplaod_center/' . $checklist_form_data->upc_file_name; ?>" target="_blank">
                                        <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo site_url() . '/admin/delete_upc_files/' . $checklist_form_data->upc_file_id; ?>">
                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                    </a>
                                </td>
                                <td><?php
                                    $time = $checklist_form_data->upc_upload_date;
                                    echo date('d/m/Y G:i', strtotime($time));
                                    ?>
                                </td>
                                <td>
                                    <?php if (!$checklist_form_data->upc_file_status == 1) { ?>
                                        <button id="upload_cf_pop_id-<?php echo $cl_count; ?>" class="btn btn-link" ><span class="label label-warning">Add</span></button>
                                        <div class="upload_cf_popup" id="upload_cf_popup-<?php echo $cl_count; ?>" style="display: none;">
                                            <span class="button b-close"><span>X</span></span>
                                            <form method="post" action="<?php echo site_url('admin/assign_upc_files_cf'); ?>">
                                                <div class="form-group">
                                                    <label for="assignee_list_cf">Assign To</label>
                                                    <select class="form-control" name="assignee_list_cf" id="assignee_list_cf">
                                                        <?php
                                                        $get_hospital_users = $this->Admin_model->get_all_hospital_users();
                                                        if (!empty($get_hospital_users) && is_array($get_hospital_users)) {
                                                            foreach ($get_hospital_users as $hospital_users) {
                                                                echo '<option value="' . $hospital_users->id . '">' . $hospital_users->first_name . $hospital_users->last_name . '</option>';
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                    <input type="hidden" name="upc_file_id_cf" value="<?php echo $checklist_form_data->upc_file_id; ?>">
                                                    <input type="hidden" name="upc_file_type_code_cf" value="<?php echo $checklist_form_data->upc_file_type_code; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </form>
                                        </div>
                                        <script>
                                            jQuery(document).ready(function () {
                                                jQuery('#upload_cf_pop_id-<?php echo $cl_count; ?>').click(function () {
                                                    jQuery('#upload_cf_popup-<?php echo $cl_count; ?>').bPopup({
                                                        easing: 'easeOutBack',
                                                        speed: 450
                                                    });
                                                });
                                            });
                                        </script>
                                    <?php
                                    } else {
                                        echo '<span class="label label-success">' . $checklist_form_data->upc_file_assignee_name . '</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $cl_count++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
