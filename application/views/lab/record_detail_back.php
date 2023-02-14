<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="doctor_record_detail_page">
    <?php
    $record_id = $this->uri->segment(3);
    /**
     * Get User report Edit data
     */
    $doc_id = $this->ion_auth->user()->row()->id;
    if (!empty($record_edit_status)) {
        $user_id = $record_edit_status[0]->user_id_for_edit;
        $edit_timestamp = $record_edit_status[0]->user_record_edit_timestamp;

        /* Get First & Last Name */
        $first_name = '';
        $last_name = '';
        if (!empty($this->ion_auth->user($user_id)->row()->first_name)) {
            $first_name = $this->ion_auth->user($user_id)->row()->first_name;
        }
        if ($this->ion_auth->user($user_id)->row()->last_name) {
            $last_name = $this->ion_auth->user($user_id)->row()->last_name;
        }

        $edit_full_name = $first_name . '&nbsp;' . $last_name;
    }

    if (!empty($request_query)) {
        $userid = $request_query[0]->request_add_user;

        $record_add_timestamp = $request_query[0]->request_add_user_timestamp;
        /* Get First & Last Name */
        $first_name = '';
        $last_name = '';
        if (!empty($this->ion_auth->user($userid)->row()->first_name)) {
            $first_name = $this->ion_auth->user($userid)->row()->first_name;
        }
        if (!empty($this->ion_auth->user($userid)->row()->last_name)) {
            $last_name = $this->ion_auth->user($userid)->row()->last_name;
        }

        $add_full_name = $first_name . '&nbsp;' . $last_name;
    }

    $micro_codes_data = array();
    if (!empty($micro_codes)) {
        foreach ($micro_codes as $mi_codes) {
            $micro_codes_data[] = $mi_codes;
        }
    }

    if (!empty($user_id) && $edit_timestamp) {
        ?>
        <div class="user_edit_status">Record Last Edited By : <?php echo $edit_full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?>
            <span><a href="javascript:;" data-toggle="modal" data-target="#edit_record_history">View History</a></span>
        </div>
    <?php } ?>
    <?php
    if (!empty($userid) && $record_add_timestamp) {
        ?>
        <div class="user_add_report_status">Record Added By : <?php echo $add_full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $record_add_timestamp); ?></div>
    <?php } ?>
    <div id="edit_record_history" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?php
                    if (!empty($record_edit_status_full)) {
                        foreach ($record_edit_status_full as $value) {
                            $user_id = $value->user_id_for_edit;
                            $edit_timestamp = $value->user_record_edit_timestamp;
                            /* Get First & Last Name */
                            $first_name = $this->ion_auth->user($user_id)->row()->first_name;
                            $last_name = $this->ion_auth->user($user_id)->row()->last_name;
                            $full_name = $first_name . '&nbsp;' . $last_name;
                            ?>
                            <div class="well">Record Last Edited By : <?php echo $full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Record Tracking and record history modules-->
    <div class="row">
        <div class="col-md-4">
            <label class="label label-default" style="font-size: 17px;display: inline-block;">
                <?php echo uralensis_get_record_db_detail($record_id, 'serial_number'); ?>
            </label>
            <label class="label label-warning" style="font-size: 17px;display: inline-block;">
                Track No: <?php echo uralensis_get_record_db_detail($record_id, 'ura_barcode_no'); ?>
            </label>
            <button class='btn btn-primary' data-toggle="modal" data-target="#record_download_history">Record Download History</button>
            <div id="record_download_history" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Record Download History</h4>
                        </div>
                        <div class="modal-body">
                            <table class='table table-bordered'>
                                <tr>
                                    <th>ID</th>
                                    <th>Record</th>
                                    <th>Timestamp</th>
                                </tr>
                                <?php
                                if (!empty($download_history)) {
                                    foreach ($download_history as $key => $value) {
                                        $timestamp = '';
                                        if(!empty($value['ura_bulk_report_timestamp'])){
                                            $timestamp = date('d-m-Y H:i:s', $value['ura_bulk_report_timestamp']);
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $value['ura_bulk_report_history']; ?></td>
                                            <td><?php echo $value['ura_bulk_report_record_data']; ?></td>
                                            <td><?php echo $timestamp; ?></td>
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
        </div>
        <?php ?>
        <div class="col-md-2 pull-right">
            <?php record_history($record_history); ?>
        </div>
    </div>
    <hr>
    <!--Record Tracking and record history modules-->

    <div class="row">
        <div class="col-md-12">
            <div class="assign_doctor_and_authorize">
                <div class="authorize_msg"></div>
                <div class="col-md-3">
                    <div class="doctor_assign_msg"></div>
                    <form id="doctor_assign_form">
                        <label>Assign To Other Doctor : </label>
                        <select style="padding:2px;" name="assign_doctor" id="assign_doctor">
                            <option value="0">Choose Doctor</option>
                            <?php
                            if (!empty($list_doctors)) {
                                foreach ($list_doctors as $value) {
                                    ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                    </form>
                </div>
                <!--=========================Request For Opinion===============================-->
                <div class="col-md-3">
                    <a href="javascript:;" class="request_for_opinion">
                        <label class="label label-success" style="font-size: 14px;display: inline-block;">
                            Request For Opinion
                        </label>
                    </a>
                    <div id="request_for_opinion" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Opinion Request</h4>
                                </div>
                                <div class="modal-body">
                                    <?php $rec_id = $this->uri->segment(3); ?>
                                    <form class="form opinion_cases_form">
                                        <div class="form-group">
                                            <label for="opinion_case_doctors">Choose Doctors</label>
                                            <select multiple class="form-control" style="padding:2px;" name="opinion_case_doctors[]" id="opinion_case_doctors">
                                                <?php
                                                if (!empty($list_doctors)) {
                                                    foreach ($list_doctors as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Opinion Request Date</label>
                                            <input type="text" value="" readonly class="form-control" name="opinion_date"  id="opinion_date" placeholder="Opinion Request Date">
                                            <input type="hidden" value="" name="opinion_date"  id="opinion_date_hide">
                                        </div>
                                        <div class="form-group">
                                            <label for="opinion_comment">Opinion Comment</label>
                                            <textarea id="opinion_comment" name="opinion_comment" class="form-control"></textarea>
                                        </div>
                                        <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success assign_to_opinion_case">Assign</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=========================///Request For Opinion///===============================-->
                <div class="col-md-6">
                    <p>
                        <!--Add to Authorization Queue Start-->
                        <label class="label label-success" style="font-size: 14px;display: inline-block;">
                            <?php $record_id = $this->uri->segment(3); ?>
                            <a href="javascript:;" data-recordid="<?php echo $record_id; ?>" id="add_to_authorization" style="color:#fff;">Add to Authorization Queue</a>
                        </label>
                        <!--Add to Authorization Queue End-->
                        <?php if (!empty($request_query)) { ?>
                            <label style="font-size: 14px;display: inline-block;" class="label label-danger pull-right"><?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->description; ?></label>
                        <?php } ?>
                    </p>    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="well">
        <?php //if ($request_query[0]->specimen_publish_status == 1) :        ?>

        <form id="teach_and_mdt_form" class="form form-inline teach_and_mdt_form">

            <div class="teach_mdt_cpc_msg"></div>
            <div class="form-group">
                <label for="education_cats">Education</label>
                <select name="education_cats" id="education_cats" class="form-control">
                    <option value="0">Select Education Category</option>
                    <?php
                    if (!empty($education_cats)) {

                        foreach ($education_cats as $cats) {
                            $selected = '';
                            if ($cats->ura_tec_mdt_id === $request_query[0]->teaching_case) {

                                $selected = 'selected';
                            }
                            echo '<option ' . $selected . ' value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cpc_cats">CPC</label>
                <select name="cpc_cats" id="cpc_cats" class="form-control">
                    <option value="0">Select CPC Category</option>
                    <?php
                    if (!empty($cpc_cats)) {
                        foreach ($cpc_cats as $cats) {
                            echo '<option value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <?php $record_id = $this->uri->segment(3); ?>
                <input type="hidden" name="record_id" id="record_id" value="<?php echo $record_id; ?>">
                <!--<button id="teach_and_mdt_btn" class="btn btn-default">Save Case</button>-->
            </div>

        </form>
        <?php //endif;        ?>
    </div>


    <!--Datasets Functionality Start 2 Dec 17-->
    <?php set_datasets_data($datasets); ?>
    <!--Datasets Functionality End 2 Dec 17---->


    <div class="row record_detail_page">
        <div class="col-md-9">
            <?php
            $recordid = $this->uri->segment(3);
            display_mdt($mdt_cats, $recordid, $request_query, $mdt_list, $mdt_assign_dates);
            ?>
        </div>
        <div class="col-md-3">
            <div class="flag_column" style="width:100px !important; float:right; position: inherit;">
                <div class="hover_flags">
                    <div class="flag_images">
                        <?php if ($request_query[0]->flag_status === 'flag_red') { ?>
                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                        <?php } elseif ($request_query[0]->flag_status === 'flag_yellow') { ?>
                            <img data-toggle="tooltip" data-placement="top" title="This case marked for review." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                        <?php } elseif ($request_query[0]->flag_status === 'flag_blue') { ?>
                            <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                        <?php } elseif ($request_query[0]->flag_status === 'flag_black') { ?>
                            <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                        <?php } else { ?>
                            <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                        <?php } ?>

                    </div>
                    <ul class="report_flags list-unstyled list-inline">
                        <?php
                        $active = '';
                        if ($request_query[0]->flag_status === 'flag_green') {
                            $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change">
                                <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                            </a>
                        </li>
                        <?php
                        $active = '';
                        if ($request_query[0]->flag_status === 'flag_red') {
                            $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change">
                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                            </a>
                        </li>
                        <?php
                        $active = '';
                        if ($request_query[0]->flag_status === 'flag_yellow') {
                            $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change">
                                <img data-toggle="tooltip" data-placement="top" title="This case marked for review." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                            </a>
                        </li>
                        <?php
                        $active = '';
                        if ($request_query[0]->flag_status === 'flag_blue') {
                            $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change">
                                <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                            </a>
                        </li>
                        <?php
                        $active = '';
                        if ($request_query[0]->flag_status === 'flag_black') {
                            $active = 'flag_active';
                        }
                        ?>
                        <li class="<?php echo $active; ?>">
                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>" class="detail_flag_change">
                                <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- ************************DOCS DOWNLOAD CODE START************************** -->

    <div class="row">
        <div class="col-md-12">

            <?php
            if ($this->session->userdata('id') !== '') {
                $record_id = $this->session->userdata('id');
            }
            ?>
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
            if ($this->session->flashdata('delete_file') != '') {
                echo $this->session->flashdata('delete_file');
            }
            ?>
            <div id="relateddocs" class="collapse">
                <h3>Related Documents</h3>
                <div class="well">
                    <form method="post" class="form-inline" enctype="multipart/form-data" action="<?php echo base_url('index.php/doctor/do_upload/' . $record_id); ?>">

                        <div class="form-group">

                            <input required id="upload_user_file" class="form-control" type="file" name="userfile" />
                        </div>
                        <button type="submit" class="btn btn-default">Upload</button>
                    </form>
                    <div id="files">
                        <table class="table table-striped">
                            <h3>Files</h3>
                            <tr class="bg-info">
                                <th>File Name</th>
                                <th>Type</th>
                                <th>File Ext</th>
                                <th>View File</th>
                                <th>Download File</th>
                                <th>Delete</th>
                                <th>Uploaded by</th>
                                <th>Upload On</th>
                            </tr>
                            <?php
                            if (isset($files) && is_array($files)) {
                                $doctor_id = $this->ion_auth->user()->row()->id;
                                $record_id = $this->uri->segment(3);
                                foreach ($files as $file) {
                                    $file_id = $file->files_id;
                                    $file_path = $file->file_path;
                                    $session_data = array(
                                        'file_path' => $file_path
                                    );
                                    $file_ext = ltrim($file->file_ext, ".");
                                    $modify_ext = strtolower($file_ext);
                                    $this->session->set_userdata($session_data);
                                    ?>
                                    <tr>
                                        <td><?php echo $file->title; ?></td>
                                        <td><?php
                                            if ($file->is_image == 1) {
                                                echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                            } else {
                                                echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $file->file_ext; ?></td>
                                        <td>
                                            <a data-exttype="<?php echo $modify_ext; ?>" class="hover_image" data-imageurl="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                            <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                                <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                    <img src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>">
                                                    <hr>
                                                    <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                </div>
                                            <?php } ?>
                                            <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                                <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                    <iframe width="700" height="500"  src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"></iframe>
                                                    <hr>
                                                    <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a download href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($doctor_id == $file->user_id) : ?>
                                                <a href="<?php echo site_url() . '/doctor/delete_record_files?file_id=' . $file_id . '&record_id=' . $record_id; ?>">
                                                    <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                                </a>
                                            <?php else : ?>
                                                <span>No Access</span>
                                            <?php endif; ?>

                                        </td>
                                        <td><?php echo ucwords($file->user); ?></td>
                                        <td><?php
                                            $time = $file->upload_date;
                                            echo date('M j Y g:i A', strtotime($time));
                                            ?></td>
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
    </div>

    <?php $record_id = $this->uri->segment(3); ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($this->session->flashdata('update_report_message') != '') {
                echo $this->session->flashdata('update_report_message');
            }
            ?>
            <?php
            if ($this->session->flashdata('update_specimen_message') != '') {
                echo $this->session->flashdata('update_specimen_message');
            }
            ?>
            <?php
            if ($this->session->flashdata('final_report_message') != '') {
                echo $this->session->flashdata('final_report_message');
            }
            ?>
            <div id="sticky_area">
                <form id="doctor_update_personal_record" method="post">
                    <?php
                    $json = array();
                    if (!empty($request_query) && is_array($request_query)) {
                        foreach ($request_query as $row) {
                            $record_edit_serial = $row->record_edit_status;
                            $redit_status = unserialize($record_edit_serial);
                            ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="patient_initial">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="patient_initial">Initial</label>
                                        <input type="text" class="custom_input" id="patient_initial" name="patient_initial" placeholder="Patient Initial" value="<?php echo $row->patient_initial; ?>">
                                        <?php $json['patient_initial'] = $row->patient_initial; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['first_name']) && $redit_status['first_name'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['first_name']) && $redit_status['first_name'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="first_name">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="first_name">First Name</label>
                                        <input type="text" class="custom_input" id="first_name" name="f_name" placeholder="First Name" value="<?php echo $row->f_name; ?>">
                                        <?php $json['f_name'] = $row->f_name; ?>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="sur_name">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="sur_name">Surname</label>
                                        <input type="text" class="custom_input" id="sur_name" name="sur_name" placeholder="Surname" value="<?php echo $row->sur_name; ?>">
                                        <?php $json['sur_name'] = $row->sur_name; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['emis_number']) && $redit_status['emis_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="emis_number">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="emis_number">Emis No.</label>
                                        <input type="text" class="custom_input" id="emis_number" name="emis_number" placeholder="Emis Number" value="<?php echo $row->emis_number; ?>">
                                        <?php $json['emis_number'] = $row->emis_number; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="lab_number">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="lab_number">Lab No.</label>
                                        <input type="text" class="custom_input" id="lab_number" name="lab_number" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>">
                                        <?php $json['lab_number'] = $row->lab_number; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['dob']) && $redit_status['dob'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['dob']) && $redit_status['dob'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="dob">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="dob">Date of Birth</label>
                                        <input class="custom_input" type="text" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo!empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?>" />
                                        <?php $json['dob'] = date('d-m-Y', strtotime($row->dob)); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="date_received_bylab">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="date_received_bylab">Lab Rec'd Date</label>
                                        <?php
                                        $rec_by_lab_date = '';
                                        if (!empty($row->date_received_bylab)) {
                                            $rec_by_lab_date = date('d-m-Y', strtotime($row->date_received_bylab));
                                        }
                                        ?>
                                        <input class="custom_input" type="text" name="date_received_bylab" id="date_received_bylab" placeholder="Lab Receiving Date" value="<?php echo $rec_by_lab_date; ?>" />
                                        <?php $json['date_received_bylab'] = date('d-m-Y', strtotime($row->date_received_bylab)); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="date_sent_touralensis">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="date_sent_touralensis">Released from Lab date</label>
                                        <?php
                                        $sent_to_uralensis_date = '';
                                        if (!empty($row->date_sent_touralensis)) {
                                            $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
                                        } else {
                                            if (!empty($bck_frm_lab_date_data)) {
                                                $sent_to_uralensis_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
                                            }
                                        }
                                        ?>
                                        <input class="custom_input" type="text" name="date_sent_touralensis" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="<?php echo $sent_to_uralensis_date; ?>" />
                                        <?php $json['date_sent_touralensis'] = date('d-m-Y', strtotime($sent_to_uralensis_date)); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['clrk']) && $redit_status['clrk'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['clrk']) && $redit_status['clrk'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="rec_by_doc_date">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="rec_by_doc_date">Rec'd by doctor date</label>
                                        <?php
                                        $rec_by_doc_date = '';
                                        if (!empty($row->date_rec_by_doctor)) {
                                            $rec_by_doc_date = date('d-m-Y', strtotime($row->date_rec_by_doctor));
                                        } else {
                                            if (!empty($rec_by_doc_date_data)) {
                                                $rec_by_doc_date = date('d-m-Y', strtotime($rec_by_doc_date_data));
                                            }
                                        }
                                        ?>
                                        <input class="custom_input" type="text" name="rec_by_doc_date" id="rec_by_doc_date" placeholder="Received by doctor date" value="<?php echo $rec_by_doc_date; ?>" />
                                        <?php $json['rec_by_doc_date'] = date('d-m-Y', strtotime($rec_by_doc_date)); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['clrk']) && $redit_status['clrk'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['clrk']) && $redit_status['clrk'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="clrk">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="clrk">Clinical Req Work</label>
                                        <select class="custom_input" readonly name="clrk" id="clrk">
                                            <option value="">Choose Clinician</option>
                                            <?php
                                            $get_clinician = $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'clinician');
                                            if (!empty($get_clinician)) {
                                                foreach ($get_clinician as $clinician) {
                                                    $select = '';
                                                    if ($clinician->clinician_name === $row->clrk) {
                                                        $select = 'selected';
                                                    }
                                                    echo '<option ' . $select . ' value="' . $clinician->clinician_name . '">' . $clinician->clinician_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php $json['clrk'] = $row->clrk; ?>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="dermatological_surgeon">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="dermatological_surgeon">Derm Surgeon</label>
                                        <select readonly name="dermatological_surgeon" id="dermatological_surgeon" class="custom_input">
                                            <option value="">Choose Dermatological Surgeon</option>
                                            <?php
                                            $get_dermatological_surgeon = $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological');
                                            if (!empty($get_dermatological_surgeon)) {
                                                foreach ($get_dermatological_surgeon as $dermatological_surgeon) {
                                                    $select = '';
                                                    if ($dermatological_surgeon->dermatological_surgeon_name === $row->dermatological_surgeon) {
                                                        $select = 'selected';
                                                    }
                                                    echo '<option ' . $select . ' value="' . $dermatological_surgeon->dermatological_surgeon_name . '">' . $dermatological_surgeon->dermatological_surgeon_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php $json['dermatological_surgeon'] = $row->dermatological_surgeon; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="pci_number">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="pci_number">PCI No.</label>
                                        <input type="text" class="custom_input" id="pci_no" name="pci_number" placeholder="PCI Number" value="<?php echo $row->pci_number; ?>">
                                        <?php $json['pci_number'] = $row->pci_number; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="nhs_number">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="nhs_number">Nhs No.</label>
                                        <input type="text" class="custom_input" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>">
                                        <?php $json['nhs_number'] = $row->nhs_number; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="lab_name">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label">Lab Name</label>
                                        <select id="lab_name" name="lab_name" class="custom_input lab_name">
                                            <option value="0">Choose Lab Name</option>
                                            <?php
                                            $get_lab_names = $this->Doctor_model->get_lab_names();
                                            if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                                foreach ($get_lab_names as $lab_name) {

                                                    $selected = '';
                                                    if ($lab_name->lab_name == $row->lab_name) {

                                                        $selected = 'selected';
                                                    }
                                                    echo '<option data-labnameid="' . $lab_name->lab_name_id . '" ' . $selected . ' value="' . $lab_name->lab_name . '">' . $lab_name->lab_name . '</option>';
                                                }
                                            endif;
                                            ?>
                                            <?php
                                            $selected = '';
                                            if ($row->lab_name === 'U') {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="U">Other</option>
                                        </select>
                                        <?php $json['lab_name'] = $row->lab_name; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['gender']) && $redit_status['gender'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['gender']) && $redit_status['gender'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="gender">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="gender">Gender</label>
                                        <select class="custom_input" name="gender" id="gender">
                                            <?php
                                            $gender_array = array(
                                                'Male' => 'Male',
                                                'Female' => 'Female'
                                            );

                                            foreach ($gender_array as $key => $gender) {
                                                $selected = '';
                                                if ($key == $row->gender) {

                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $gender; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['gender'] = $row->gender; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="date_taken">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label" for="date_taken">Date Taken</label>
                                        <?php
                                        $date_taken = '';
                                        if (!empty($row->date_taken)) {
                                            $date_taken = date('d-m-Y', strtotime($row->date_taken));
                                        }
                                        ?>
                                        <input class="custom_input" type="text" name="date_taken" id="datetaken_doctor" placeholder="Date Taken" value="<?php echo $date_taken; ?>" />
                                        <?php $json['date_taken'] = date('d-m-Y', strtotime($row->date_taken)); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="report_urgency">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label">Status</label>
                                        <select name="report_urgency" class="custom_input">
                                            <?php
                                            $report_urgency = array(
                                                'Routine' => 'Routine',
                                                'Urgent' => 'Urgent',
                                                '2WW' => '2WW'
                                            );

                                            foreach ($report_urgency as $key => $urgency) {
                                                $selected = '';
                                                if ($key == $row->report_urgency) {

                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $urgency; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['report_urgency'] = $row->report_urgency; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    $color_status = 'input-bg-orange';
                                    if (!empty($redit_status['cases_category']) && $redit_status['cases_category'] == '1') {
                                        $color_status = 'input-bg-green';
                                    } elseif (!empty($redit_status['cases_category']) && $redit_status['cases_category'] == '2') {
                                        $color_status = 'input-bg-blue';
                                    }
                                    ?>
                                    <div class="form-group input_color <?php echo $color_status; ?>" data-key="cases_category">
                                        <span class="change_status_color"></span>
                                        <label class="custom_label">Case Category</label>
                                        <select name="cases_category" class="custom_input">
                                            <option value="0">Choose Category</option>
                                            <?php
                                            $cases_category = array(
                                                'Routine' => 'Routine',
                                                'Alopecia' => 'Alopecia',
                                                'IMF' => 'IMF',
                                                'Review' => 'Review'
                                            );

                                            foreach ($cases_category as $key => $category) {
                                                $selected = '';
                                                if ($key == $row->cases_category) {

                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $category; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $json['cases_category'] = $row->cases_category; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?php uralensis_get_cost_code_dropdown($row->hospital_group_id, $row); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="custom_label" for="cl_detail">Clinical Detail <b style="color:red;">*</b></label>
                                        <textarea class="custom_input"  required name="cl_detail" id="cl_detail" placeholder="Clinical Detail"><?php echo $row->cl_detail; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <?php $json_data = json_encode($json); ?>
                                    <input type="hidden" name="json_edit_data" value='<?php echo $json_data; ?>'>
                                    <button style="margin-top: 5px;" id="make_editable" class="custom_btn_size disable btn btn-primary">Enable Fields</button>
                                    <div id="doctor_update_record_message"></div>
                                    <?php
                                    $button_disable = '';
                                    if (!empty($opinion_data[0]->ura_opinion_req_id) && $record_id == $opinion_data[0]->ura_opinion_req_id) {
                                        $button_disable = 'disabled';
                                    }
                                    ?>
                                    <button <?php echo $button_disable; ?> id="update_doctor_personal_report_btn" class="custom_btn_size btn btn-info update_doctor_personal_report_btn">Update Report</button>
                                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                                </div>
                            </div>

                            <?php
                        }//endforeach
                    }//endif 
                    ?>

                </form>
                <!--Related Cases Section Start-->
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $hospital_name = '';
                        if (!empty($related_query)) {
                            $hospital_name = $this->ion_auth->group($related_query[0]->hospital_group_id)->row()->description;
                            display_related_posts($related_query, $hospital_name);
                        }
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php
                if ($this->session->flashdata('message_additional') != '') {
                    ?>
                    <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_additional'); ?></p>
                <?php } ?>
                <?php
                if ($this->session->flashdata('message_further') != '') {
                    echo $this->session->flashdata('message_further');
                }
                if ($this->session->flashdata('message_email_send') != '') {
                    echo $this->session->flashdata('message_email_send');
                }
                if ($this->session->flashdata('message_email_not_sent') != '') {
                    echo $this->session->flashdata('message_email_not_sent');
                }
                ?>
                <div id="supplementary_report_status"></div>
                <table class="table table-striped doctor_record_detail">
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="relateddocs" class="inline_docs">
                                        <strong>Related Documents : </strong>
                                        <?php
                                        if (!empty($files)) {
                                            foreach ($files as $file) {
                                                $file_ext = ltrim($file->file_ext, ".");
                                                $modify_ext = strtolower($file_ext);
                                                ?>
                                                <a data-exttype="<?php echo $modify_ext; ?>" class="hover_image" data-imageurl="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                    <?php
                                                    if ($file->is_image == 1) {
                                                        echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                                    } else {
                                                        echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                                    }
                                                    ?>
                                                    <?php echo ucfirst($file->title); ?>
                                                </a>
                                                <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                                    <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                        <img src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>">
                                                        <hr>
                                                        <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                                    <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                        <iframe width="700" height="500"  src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"></iframe>
                                                        <hr>
                                                        <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="relateddocs" class="inline_docs">
                                        <strong>Request Form : </strong>
                                        <?php
                                        $request_forms = $this->Doctor_model->get_record_request_forms($request_query[0]->clinic_request_form);
                                        if (!empty($request_forms)) {
                                            foreach ($request_forms as $key => $request) {
                                                $file_ext = ltrim($request->ura_clinic_request_ext, ".");
                                                $modify_ext = strtolower($file_ext);
                                                ?>
                                                <a data-exttype="<?php echo $modify_ext; ?>" class="hover_image" data-imageurl="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>" href="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>" target="_blank">
                                                    <?php
                                                    if ($request->ura_clinic_request_image_type == 1) {
                                                        echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                                    } else {
                                                        echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                                    }
                                                    ?>
                                                    <?php echo ucfirst($request->ura_clinic_request_form); ?>
                                                </a>
                                                <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                                    <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                        <img src="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>">
                                                        <hr>
                                                        <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                                    <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                        <iframe width="700" height="500"  src="<?php echo base_url() . 'clinic_uploads/' . $request->ura_clinic_request_form; ?>"></iframe>
                                                        <hr>
                                                        <button class="btn btn-warning" id="close_hover_image">Close</button>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-2 custom_width">
                                    <a style="cursor: pointer;" class="btn-link" data-toggle="collapse" data-target="#relateddocs">
                                        <img data-toggle="tooltip" data-placement="top" title="Click To Open Related Document" src="<?php echo base_url('assets/img/attachment.png'); ?>" >
                                    </a>
                                </div>
                                <?php
                                if (!empty($request_query)) {
                                    $record_id = $this->uri->segment(3);
                                    foreach ($request_query as $pdf) {
                                        if ($pdf->specimen_update_status == 1) {
                                            echo '<div class="col-md-2 custom_width">';
                                            ?>
                                            <a style="cursor: pointer;" id="show_pdf_iframe" target="_blank" href="javascript:;">
                                                <img data-toggle="tooltip" data-placement="top" title="Click To View Pre-Publish Report" src="<?php echo base_url('assets/img/docs.png'); ?>">
                                            </a>
                                            <div id="display_iframe_pdf" class="modal fade display_iframe_pdf" role="dialog" data-backdrop="static" data-keyboard="false">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <object type="application/pdf" data="<?php echo site_url() . '/doctor/view_report/' . $record_id; ?>" width="100%" style="height: 80vh;">No Support</object>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                            <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                                                                <a class="pull-left" style="cursor: pointer;" data-toggle="modal" data-target="#user_auth_popup">
                                                                    <img data-toggle="tooltip" data-placement="top" title="Click To Publish This Report" src="<?php echo base_url('assets/img/pdf.png'); ?>">
                                                                </a>
                                                            <?php } else { ?>
                                                                <p class="label label-success pull-left" style="font-size:16px;">Report Already Has Been Published!</p>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($request_query)) {
                                                $user_id = $this->ion_auth->user()->row()->id;
                                                $record_id = $this->uri->segment(3);
                                                foreach ($request_query as $check_publish) {
                                                    if ($check_publish->specimen_update_status == 1) {
                                                        if ($check_publish->specimen_publish_status == 0) {
                                                            ?>
                                                            <div id="user_auth_popup" class="modal fade user_auth_popup" role="dialog" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Publish Report</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php if (empty($check_publish->mdt_case) && empty($check_publish->mdt_case_status)) { ?>
                                                                                <div class="well">
                                                                                    <p>Please Select One Of The MDT Option.</p>
                                                                                    <button class="btn btn-sm btn-success" id="close_popups_for_mdt">Add MDT</button>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <div id="publish_button"></div>
                                                                            <div class="publish_report_form">
                                                                                <form class="form" method="post" id="check_auth_pass_form">
                                                                                    <div class="form-group">
                                                                                        <p>Enter Your Pin To Publish This Report.</p>
                                                                                        <input autofocus maxlength="1" type="password" id="auth_pass1" name="auth_pass1">
                                                                                        <input maxlength="1" type="password" name="auth_pass2">
                                                                                        <input maxlength="1" type="password" name="auth_pass3">
                                                                                        <input maxlength="1" type="password" name="auth_pass4">
                                                                                        <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                                                                                        <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                                                                                        <?php
                                                                                        if (empty($check_publish->mdt_case) && empty($check_publish->mdt_case_status)) {
                                                                                            echo '<input name="mdt_not_select" type="hidden" value="mdt_uncheck">';
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <button id="check_pass" class="btn btn-warning pull-right">Submit</button>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                    }//Check for if specimen publish status is 0 and update is 1
                                                }// Foreach Loop End Here
                                            }//Check if there some data in request query.
                                            ?>
                                            <!--Publish Code End Here-->
                                            <?php
                                            echo '</div>';
                                        }
                                    }
                                }
                                ?>
                                <div class="col-md-2 custom_width">
                                    <?php
                                    $req_id = $this->uri->segment(3);
                                    $doc_name = $this->session->userdata('doc_name');
                                    foreach ($request_query as $row) {
                                        $hospital_group_id = $row->hospital_group_id;
                                        ?>
                                        <a style="cursor: pointer;" id="further_work_add">
                                            <img data-toggle="tooltip" data-placement="top" title="Add Further Work" src="<?php echo base_url('assets/img/fw.png'); ?>">
                                        </a> 
                                        <div id="further_work" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Further Work</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="fw_msg"></div>
                                                        <form id="further_work_form" method="post">
                                                            <div class="form-group">
                                                                <?php
                                                                $check_count = 1;
                                                                $hospital_id = $request_query[0]->hospital_group_id;
                                                                $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes($hospital_id);


                                                                if (!empty($get_cost_codes['cost_codes'])) {
                                                                    foreach ($get_cost_codes['cost_codes'] as $codes) {
                                                                        $selected = '';
                                                                        $fw_levels = '';
                                                                        if ($codes->ura_cost_code_type == $request_query[0]->fw_levels) {
                                                                            $selected = 'checked disabled';
                                                                            $fw_levels = $codes->ura_cost_code_type;
                                                                        }
                                                                        if ($codes->ura_cost_code_type == $request_query[0]->fw_immunos) {
                                                                            $selected = 'checked disabled';
                                                                            $fw_levels = $codes->ura_cost_code_type;
                                                                        }
                                                                        if ($codes->ura_cost_code_type == $request_query[0]->fw_imf) {
                                                                            $selected = 'checked disabled';
                                                                            $fw_levels = $codes->ura_cost_code_type;
                                                                        }
                                                                        ?>
                                                                        <input type="hidden" name="<?php echo $codes->ura_cost_code_type; ?>" value="<?php echo $fw_levels; ?>">

                                                                        <label for="report_check_<?php echo $check_count; ?>"><?php echo $codes->ura_cost_code_desc; ?></label>
                                                                        <input id="report_check_<?php echo $check_count; ?>" <?php echo $selected; ?> name="<?php echo $codes->ura_cost_code_type; ?>" type="checkbox" value="<?php echo $codes->ura_cost_code_type; ?>">


                                                                        <?php
                                                                        $check_count++;
                                                                    }//endforeach
                                                                }//endif
                                                                ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Further Work Date</label>
                                                                <input type="text" value="" readonly class="form-control" name="furtherwork_date"  id="furtherwork_date" placeholder="Further Work Date">
                                                                <input type="hidden" value="" name="furtherwork_date"  id="further_work_date_hide">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="further_work">Further Work:</label>
                                                                <textarea class="form-control" rows="5" id="further_work" name="description"></textarea>
                                                            </div>
                                                            <input type="hidden" name="record_id" value="<?php echo $req_id; ?>">
                                                            <input type="hidden" name="hospital_group_id" value="<?php echo $hospital_group_id; ?>"> 
                                                            <button type="button" id="fw_submit_btn" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <?php
                                if (isset($request_query)) :
                                    foreach ($request_query as $row) :
                                        if ($row->specimen_publish_status == 1) :
                                            echo '<div class="col-md-2 custom_width">';
                                            ?>
                                            <a style="cursor: pointer;" data-toggle="modal" data-target="#add_supplementary">
                                                <img data-toggle="tooltip" data-placement="top" title="Add Supplementarty Report" src="<?php echo base_url('assets/img/supplementary.png'); ?>">
                                            </a>
                                            <div id="add_supplementary" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Add Supplementary</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('doctor/additional_work'); ?>">
                                                                <div class="form-group">
                                                                    <label for="additional_work">Add Supplementary Report:</label>
                                                                    <textarea class="form-control" rows="5" id="additional_work" name="additional_description"></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            echo '</div>';
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                                <?php
                                $record_id = $this->uri->segment(3);
                                if (isset($request_query)) : foreach ($request_query as $row) :
                                        ?>
                                        <?php if ($row->specimen_publish_status == 1) : ?>
                                            <div class="col-md-2 custom_width">
                                                <a style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Click To View Final PDF" target="_blank" href="<?php echo site_url() . '/doctor/generate_report/' . $record_id; ?>">
                                                    <img src="/uralensis/assets/img/pdf.png" title='Pdf View'>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                    endforeach;
                                endif;
                                ?>

                                <?php
                                if (isset($request_query)) {
                                    $record_id = $this->uri->segment(3);
                                    foreach ($request_query as $check_additional_status) {
                                        if ($check_additional_status->additional_data_state == 'in_session') {
                                            ?>
                                            <div class="col-md-2 custom_width">
                                                <form class="form" method="post" id="publish_supplementary">
                                                    <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                                                    <a style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Publish Supplementary" id="publish_supplementary_btn">
                                                        <img src="<?php echo base_url('assets/img/pub_supply.png'); ?>"
                                                    </a>
                                                </form>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <div class="col-md-2">
                                    <?php
                                    $record_id = $this->uri->segment(3);
                                    show_supplementary_modal($record_id, $supplementary_query);
                                    ?> 
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }

            $hospital_id = $request_query[0]->hospital_group_id;
            $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes_by_block($hospital_id);

            get_specimens($specimen_query, $request_query, $record_id, $get_cost_codes['cost_codes'], $opinion_data);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }
            comment_section($record_id, $request_query, $opinion_data);
            ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }

            if (class_exists('Notes')) {
                Notes::special_notes($record_id, $request_query, $opinion_data);
            }
            ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }
            if (empty($opinion_data_reply['opinion_data_reply'])) {
                $opinion_data_reply = array();
            }
            if (class_exists('Opinion_Cases')) {
                Opinion_Cases::display_comments($record_id, $opinion_data, $opinion_data_reply);
            }
            ?>
        </div>
    </div>
    <script>
        var micro_data = <?php echo json_encode($micro_codes_data); ?>;
    </script>
</div>