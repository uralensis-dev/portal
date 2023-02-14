<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php if (!empty($request_query)) { ?>
            <p><label style="font-size: 14px;display: inline-block;" class="label label-danger"><?php echo html_purify($this->ion_auth->group($request_query[0]->hospital_group_id)->row()->description); ?></label></p>    
        <?php } ?>
    </div>
</div>

<form id="teach_and_mdt_form" class="form form-inline teach_and_mdt_form">
    <div class="well">
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
                        echo '<option ' . html_purify($selected) . ' value="' . $cats->ura_tec_mdt_id . '">' . html_purify($cats->ura_tech_mdt_cat) . '</option>';
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
                        echo '<option value="' . $cats->ura_tec_mdt_id . '">' . html_purify($cats->ura_tech_mdt_cat) . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <?php $recordid = $this->uri->segment(3); ?>
            <input type="hidden" name="record_id" id="record_id" value="<?php echo intval($recordid); ?>">
        </div>
    </div>
</form>
<?php //endif;    ?>
<div class="row">
    <div class="col-md-9">
        <?php
        $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
        $sec_perm = unserialize($secretary_perms);
        if (in_array('sec_can_add_mdt', $sec_perm)) {
            $record_id = $this->uri->segment(3);
            display_mdt($mdt_cats, $record_id, $request_query);
        }
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
                        <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo intval($request_query[0]->uralensis_request_id); ?>" class="flag_change">
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
                        <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo intval($request_query[0]->uralensis_request_id); ?>" class="flag_change">
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
                        <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo intval($request_query[0]->uralensis_request_id); ?>" class="flag_change">
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
                        <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo intval($request_query[0]->uralensis_request_id); ?>" class="flag_change">
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
                        <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $request_query[0]->serial_number; ?>" data-recordid="<?php echo intval($request_query[0]->uralensis_request_id); ?>" class="flag_change">
                            <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
                <form method="post" class="form-inline" enctype="multipart/form-data" action="<?php echo base_url('index.php/secretary/do_upload/' . $record_id); ?>">
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
                            if (!empty($doctor_id)) {
                                $doctor_id = $doctor_id[0]->ura_sec_rec_doc_id;
                            }
                            $record_id = $this->uri->segment(3);

                            foreach ($files as $file) {
                                $file_id = $file->files_id;
                                $file_path = $file->file_path;
                                $session_data = array(
                                    'file_path' => $file_path
                                );
                                $this->session->set_userdata($session_data);
                                ?>
                                <tr>
                                    <td><?php echo $file->title; ?></td>
                                    <td>
                                    <?php
                                    if ($file->is_image == 1) {
                                        echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                    } else {
                                        echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                    }
                                    ?>
                                    </td>
                                    <td><?php echo $file->file_ext; ?></td>
                                    <td>
                                        <a href="<?php echo base_url() . 'uploads/' . html_purify($file->file_name); ?>" target="_blank">
                                            <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                            <?php echo ucfirst($file->title); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a download href="<?php echo base_url() . 'uploads/' . html_purify($file->file_name); ?>" target="_blank">
                                            <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                            <?php echo ucfirst($file->title); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($doctor_id == $file->user_id) : ?>
                                            <a href="<?php echo site_url() . '/secretary/delete_record_files?file_id=' . intval($file_id) . '&record_id=' . $record_id; ?>">
                                                <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                            </a>
                                        <?php else : ?>
                                            <span>No Access</span>
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo ucwords($file->user); ?></td>
                                    <td>
                                    <?php
                                        $time = $file->upload_date;
                                        echo date('M j Y g:i A', strtotime($time));
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
</div>

<?php
$record_id = $this->uri->segment(3);
?>
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
                if (!empty($request_query) && is_array($request_query)) {
                    foreach ($request_query as $row) {
                        ?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="patient_initial">Initial</label>
                                    <input type="text" class="custom_input" id="patient_initial" name="patient_initial" placeholder="Patient Initial" value="<?php echo $row->patient_initial; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="first_name">First Name</label>
                                    <input type="text" class="custom_input" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $row->f_name; ?>">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="sur_name">Surname</label>
                                    <input type="text" class="custom_input" id="sur_name" name="sur_name" placeholder="Surname" value="<?php echo $row->sur_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="emis_number">Emis No.</label>
                                    <input type="text" class="custom_input" id="emis_number" name="emis_number" placeholder="Emis Number" value="<?php echo $row->emis_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="lab_number">Lab No.</label>
                                    <input type="text" class="custom_input" id="lab_number" name="lab_number" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="dob">Date of Birth</label>
                                    <input class="custom_input" type="text" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $row->dob; ?>" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="date_received_bylab">Lab Rec'd Date</label>
                                    <input class="custom_input" type="text" name="date_received_bylab" id="date_received_bylab" placeholder="Lab Receiving Date" value="<?php echo $row->date_received_bylab; ?>" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="date_sent_touralensis">Rec'd back from Lab</label>
                                    <input class="custom_input" type="text" name="date_sent_touralensis" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="<?php echo $row->date_sent_touralensis; ?>" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="clrk">Clinical Req Work</label>
                                    <select class="custom_input" readonly name="clrk" id="clrk">
                                        <option value="">Choose Clinician</option>
                                        <?php
                                        $get_clinician = $this->Secretary_model->get_clinician_and_derm($row->hospital_group_id, 'clinician');
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
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="dermatological_surgeon">Derm Surgeon</label>
                                    <select readonly name="dermatological_surgeon" id="dermatological_surgeon" class="custom_input">
                                        <option value="">Choose Dermatological Surgeon</option>
                                        <?php
                                        $get_dermatological_surgeon = $this->Secretary_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological');
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
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="patient_initial">PCI No.</label>
                                    <input type="text" class="custom_input" id="pci_no" name="pci_no" placeholder="PCI Number" value="<?php echo $row->pci_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="nhs_number">Nhs No.</label>
                                    <input type="text" class="custom_input" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label">Lab Name</label>
                                    <select id="lab_name" name="lab_name" class="custom_input">
                                        <option value="0">Choose Lab Name</option>
                                        <?php
                                        $get_lab_names = $this->Secretary_model->get_lab_names();
                                        if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                            foreach ($get_lab_names as $lab_name) {

                                                $selected = '';
                                                if ($lab_name->lab_name == $row->lab_name) {

                                                    $selected = 'selected';
                                                }
                                                echo '<option ' . $selected . ' value="' . $lab_name->lab_name . '">' . $lab_name->lab_name . '</option>';
                                            }
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
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

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="custom_label" for="date_taken">Date Taken</label>
                                    <input class="custom_input" type="text" name="date_taken" id="datetaken_doctor" placeholder="Date Taken" value="<?php echo $row->date_taken; ?>" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
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
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
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
                                <button style="margin-top: 5px;" id="make_editable" class="custom_btn_size disable btn btn-primary">Enable Fields</button>
                                <div id="doctor_update_record_message"></div>
                                <button id="update_doctor_personal_report_btn" class="custom_btn_size btn btn-info">Update Report</button>
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
                                        <a style="cursor: pointer;" target="_blank" href="<?php echo site_url() . '/secretary/view_report/' . $record_id; ?>">
                                            <img data-toggle="tooltip" data-placement="top" title="Click To View Pre-Publish Report" src="<?php echo base_url('assets/img/docs.png'); ?>">
                                        </a>
                                        <?php
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>

                            <div class="col-md-2 custom_width">
                                <?php
                                $secretary_perms = $this->ion_auth->user()->row()->user_sec_rec_permission;
                                $sec_perm = unserialize($secretary_perms);
                                if (in_array('sec_can_request_fw', $sec_perm)) {
                                    $req_id = $this->uri->segment(3);

                                    foreach ($request_query as $row) :
                                        $hospital_group_id = $row->hospital_group_id;
                                        ?>
                                        <a style="cursor: pointer;" id="further_work_add">
                                            <img data-toggle="tooltip" data-placement="top" title="Add Further Work" src="<?php echo base_url('assets/img/fw.png'); ?>">
                                        </a> 
                                        <div id="further_work" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
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
                                                                $get_cost_codes['cost_codes'] = $this->Secretary_model->get_cost_codes($hospital_id);

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
                                        <?php
                                    endforeach;
                                }
                                ?>
                            </div>

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
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php
        $hospital_id = $request_query[0]->hospital_group_id;
        $get_cost_codes['cost_codes'] = $this->Secretary_model->get_cost_codes_by_block($hospital_id);

        get_specimens($specimen_query, $request_query, $record_id, $get_cost_codes['cost_codes']);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php comment_section($record_id, $request_query, array()); ?> 
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php Notes::special_notes($record_id, $request_query, array()); ?> 
    </div>
</div>

