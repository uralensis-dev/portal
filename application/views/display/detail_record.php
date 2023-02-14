<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
                <?php
                $record_id = $this->uri->segment(3);
                if (!empty($query1)) {
                    $user_id = $query1[0]->request_add_user;
                    $edit_timestamp = $query1[0]->request_add_user_timestamp;
                    $first_name = '';
                    $last_name = '';
                    if (!empty($this->ion_auth->user($user_id)->row()->first_name)) {
                        $first_name = $this->ion_auth->user($user_id)->row()->first_name;
                    }
                    if (!empty($this->ion_auth->user($user_id)->row()->last_name)) {
                        $last_name = $this->ion_auth->user($user_id)->row()->last_name;
                    }
                    $full_name = $first_name . '&nbsp;' . $last_name;
                }
                if (!empty($user_id) && $edit_timestamp) {
                    ?>
                    <div class="user_add_report_status">Record Added By : <?php echo $full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?></div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-10">
                        <?php // record_tracking($doctor_list, $specimen_type, $record_id); ?>
                    </div>
                    <div class="col-md-2">
                        <?php record_history($record_history); ?>
                    </div>
                </div>
                <hr>
                <div class="row record_detail_page">
                    <div class="col-md-12">
                        <a onclick="window.history.back();"><button class="btn btn-primary"><< Go Back</button></a>
                        <div class="flag_column" style="width:100px !important; float:right; position: inherit;">
                            <div class="hover_flags">
                                <div class="flag_images">
                                    <?php if ($query1[0]->flag_status === 'flag_red') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                    <?php } elseif ($query1[0]->flag_status === 'flag_yellow') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked for review." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                    <?php } elseif ($query1[0]->flag_status === 'flag_blue') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                    <?php } elseif ($query1[0]->flag_status === 'flag_black') { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                    <?php } else { ?>
                                        <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                                    <?php } ?>

                                </div>
                                <ul class="report_flags list-unstyled list-inline">
                                    <?php
                                    $active = '';
                                    if ($query1[0]->flag_status === 'flag_green') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $query1[0]->serial_number; ?>" data-recordid="<?php echo $query1[0]->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as new case." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($query1[0]->flag_status === 'flag_red') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $query1[0]->serial_number; ?>" data-recordid="<?php echo $query1[0]->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($query1[0]->flag_status === 'flag_yellow') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $query1[0]->serial_number; ?>" data-recordid="<?php echo $query1[0]->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for review." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($query1[0]->flag_status === 'flag_blue') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $query1[0]->serial_number; ?>" data-recordid="<?php echo $query1[0]->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for ready to authorize." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $active = '';
                                    if ($query1[0]->flag_status === 'flag_black') {
                                        $active = 'flag_active';
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $query1[0]->serial_number; ?>" data-recordid="<?php echo $query1[0]->uralensis_request_id; ?>" class="flag_change">
                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as complete." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3>View Record</h3>
                        <?php foreach ($query1 as $row) :
                            ?>
                            <?php if ($row->assign_status == 0) : ?>
                                <div class="pull-right">
                                    <button data-toggle="modal" data-target="#assign_doc_modal" type="button" class="btn btn-success">Assign</button>
                                </div>
                                <?php
                            else :
                                $user_data['users'] = $this->Admin_model->get_doctor_name();
                                foreach ($user_data['users'] as $users) :
                                    echo '<h3><label class="label label-warning">Request Has Been Assigned To : ' . $users->first_name . ' ' . $users->last_name . '</label></h3>';
                                endforeach;
                            endif;
                            ?>
                            <div id="assign_doc_modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Assign The Doctor</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="assign_doc_form">
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
                                                    <input type="hidden" class="form-control" name="record_id" value="<?php echo $this->uri->segment(3); ?>" />
                                                    <hr />
                                                </div>
                                                <button type="button" id="doc_assign_btn" class="btn btn-primary">Assign Doctor</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="admin_display_data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3><span class="label label-info"><?php echo $row->company; ?></span></h3>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="patient_initial">Initial</label>
                                            <input disabled type="text" class="custom_input" id="patient_initial" value="<?php echo $row->patient_initial; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="nhs_number">NHS No.</label>
                                            <input disabled type="text" class="custom_input" id="nhs_number" value="<?php echo $row->nhs_number; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="lab_number">Lab No.</label>
                                            <input disabled type="text" class="custom_input" id="lab_number" value="<?php echo $row->lab_number; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="emis_number">Emis No.</label>
                                            <input disabled type="text" class="custom_input" id="emis_number" value="<?php echo $row->emis_number; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="request_time">Request Time</label>
                                            <input disabled type="text" class="custom_input" id="request_time" value="<?php echo date('d-m-Y h:i:s', strtotime($row->request_datetime)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="pci_number">PCI No.</label>
                                            <input disabled type="text" class="custom_input" id="pci_number" value="<?php echo $row->pci_number; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="lab_name">Lab Name</label>
                                            <input disabled type="text" class="custom_input" id="lab_name" value="<?php echo $row->lab_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="first_name">First Name</label>
                                            <input disabled type="text" class="custom_input" id="first_name" value="<?php echo $row->f_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="sur_name">Sur Name</label>
                                            <input disabled type="text" class="custom_input" id="sur_name" value="<?php echo $row->sur_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="dob">Date of Birth</label>
                                            <?php
                                            $dob = '';
                                            if (!empty($row->dob)) {
                                                $dob = date('d-m-Y', strtotime($row->dob));
                                            }
                                            ?>
                                            <input disabled type="text" class="custom_input" id="dob" value="<?php echo $dob; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="gender">Gender</label>
                                            <input disabled type="text" class="custom_input" id="gender" value="<?php echo $row->gender; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="lab_rec_date">Lab Rec'd Date</label>
                                            <?php
                                            $rec_by_lab_date = '';
                                            if (!empty($row->date_received_bylab)) {
                                                $rec_by_lab_date = date('d-m-Y', strtotime($row->date_received_bylab));
                                            }
                                            ?>
                                            <input disabled type="text" class="custom_input" id="lab_rec_date" value="<?php echo $rec_by_lab_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="rec_back_from_lab">Rec'd back from Lab</label>
                                            <?php
                                            $sent_to_uralensis_date = '';
                                            if (!empty($row->date_sent_touralensis)) {
                                                $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
                                            }
                                            ?>
                                            <input disabled type="text" class="custom_input" id="rec_back_from_lab" value="<?php echo $sent_to_uralensis_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="clrk">Clinical Req Work</label>
                                            <input disabled type="text" class="custom_input" id="clrk" value="<?php echo $row->clrk; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="date_taken">Date Taken</label>
                                            <?php
                                            $date_taken = '';
                                            if (!empty($row->date_taken)) {
                                                $date_taken = date('d-m-Y', strtotime($row->date_taken));
                                            }
                                            ?>
                                            <input disabled type="text" class="custom_input" id="date_taken" value="<?php echo $date_taken; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="importance">Importance</label>
                                            <input disabled type="text" class="custom_input" id="importance" value="<?php echo $row->report_urgency; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group input_color">
                                            <label class="custom_label" for="case_category">Case Category</label>
                                            <input disabled type="text" class="custom_input" id="case_category" value="<?php echo $row->cases_category; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="custom_label" for="cl_detail">Clinical Detail</label>
                                            <textarea class="custom_input"  disabled id="cl_detail"><?php echo $row->cl_detail; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalspecimen">Add Specimen</button>
                        <div class="modal fade" id="myModalspecimen" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Specimen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?php echo site_url() . '/Admin/add_specimen_admin/' . $this->uri->segment(3); ?>">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Specimen Site (T Code)</label>
                                                    <input type="text" class="form-control" name="specimen_site" placeholder="Specimen Site"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Procedure (P Code)</label>
                                                    <input type="text" class="form-control" name="specimen_procedure" placeholder="Specimen Procedure" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="specimen">Specimen Type</label>
                                                    <select name="specimen_type" id="specimen"  class="form-control">
                                                        <?php
                                                        $data['query'] = $this->Institute_model->specimen_type();
                                                        foreach ($data['query'] as $type) :
                                                            ?>
                                                            <option value="<?php echo $type->rtypetitle; ?>"><?php echo $type->rtypetitle; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="specimen_block">Specimen Block</label>

                                                    <select name="specimen_block" id="specimen_block"  class="form-control">
                                                        <?php
                                                        $hospital_id = $query1[0]->hospital_group_id;
                                                        $get_cost_codes['cost_codes'] = $this->Admin_model->get_cost_codes($hospital_id);
                                                        if (!empty($get_cost_codes['cost_codes'])) {
                                                            foreach ($get_cost_codes['cost_codes'] as $codes) {
                                                                ?>
                                                                <option value="<?php echo $codes->ura_cost_code_desc; ?>"><?php echo $codes->ura_cost_code_desc; ?></option>
                                                                <?php
                                                            }//endforeach
                                                        }//endif
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Diagnosis</label>
                                                    <input type="text" class="form-control" name="specimen_diagnosis" placeholder="Specimen Diagnosis"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Specimen Slides</label>
                                                    <input type="text" class="form-control" name="specimen_slides" id="date" placeholder="Specimen Slides"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Block Type</label>
                                                    <input type="text" class="form-control" name="specimen_block_type" id="date" placeholder="Specimen Block Type"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Macroscopic Description</label>
                                                    <input type="text" class="form-control" name="specimen_macroscopic_description" id="date" placeholder="Specimen Macroscopic Description"  />
                                                </div>

                                                <div class="form-group">
                                                    <label>Specimen Cancer Register</label>
                                                    <input type="text" class="form-control" name="specimen_cancer_register" placeholder="Specimen Cancer Register"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rcpath_code">RCPath Code</label>
                                                    <select name="rcpath_code" class="form-control">
                                                        <?php
                                                        $rcpath_array = array(
                                                            '0' => '0',
                                                            '1' => '1',
                                                            '2' => '2',
                                                            '3' => '3',
                                                            '4' => '4',
                                                            '5' => '5',
                                                            '6' => '6',
                                                            '7' => '7',
                                                            '8' => '8',
                                                            '9' => '9',
                                                            '10' => '10',
                                                            '11' => '11',
                                                            '12' => '12',
                                                            '13' => '13',
                                                            '14' => '14',
                                                            '15' => '15',
                                                            '16' => '16',
                                                            '17' => '17',
                                                            '18' => '18',
                                                            '19' => '19',
                                                            '20' => '20'
                                                        );
                                                        foreach ($rcpath_array as $key => $rcpath_code) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $rcpath_code; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pull-left"><button name="submit" type="submit" class="btn btn-primary">Add Specimen</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs specimen_tabs">
                            <?php
                            $active = 'active';
                            $count = 1;
                            foreach ($query2 as $row) :
                                ?>
                                <li class="<?php echo $active; ?>"><a data-toggle="tab" href="#tabs_<?php echo $count; ?>">Specimen <?php echo $count; ?></a></li>
                                <?php
                                $active = '';
                                $count++;
                            endforeach;
                            ?>
                        </ul>
                        <div class="tab-content specimen_tab_content">
                            <?php
                            $tabs_active = 'active';
                            $inner_tab_count = 1;
                            foreach ($query2 as $row) :
                                $session_data = array(
                                    'specimen_id' => $row->specimen_id
                                );
                                $this->session->set_userdata($session_data);
                                $specimen_id = $this->session->userdata('specimen_id');
                                ?>
                                <div id="tabs_<?php echo $inner_tab_count; ?>" class="tab-pane fade in <?php echo $tabs_active; ?>">
                                    <a class="pull-right" href="<?php echo site_url() . '/Admin/delete_admin_specimen/' . $specimen_id; ?>"><img src="<?php echo base_url('assets/img/delete.png'); ?>"></a>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Specimen Accepted By:</label>
                                                <select name="specimen_accepted_by" class="form-control">
                                                    <option value="">Accepted By:</option>
                                                    <?php
                                                    if (!empty($specimen_accepted_by)) {
                                                        foreach ($specimen_accepted_by as $key => $value) {
                                                            $selected = '';
                                                            if ($row->specimen_accepted_by === $value['spec_accep_by_id']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value['spec_accep_by_id']; ?>"><?php echo $value['spec_accep_by_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Specimen Assisted By:</label>
                                                <select data-placeholder="Assisted by:" name="specimen_assisted_by" class="form-control">
                                                    <option value="">Assisted by:</option>
                                                    <?php
                                                    if (!empty($specimen_assisted_by)) {
                                                        foreach ($specimen_assisted_by as $key => $value) {
                                                            $selected = '';
                                                            if ($row->specimen_assisted_by === $value['spec_assis_by_id']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value['spec_assis_by_id']; ?>"><?php echo $value['spec_assis_by_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Specimen Block Checked:</label>
                                                <select data-placeholder="Block checked by:" name="specimen_block_checked_by" class="form-control">
                                                    <option value="">Block checked by:</option>
                                                    <?php
                                                    if (!empty($specimen_block_checked_by)) {
                                                        foreach ($specimen_block_checked_by as $key => $value) {
                                                            $selected = '';
                                                            if ($row->specimen_block_checked_by === $value['spec_block_check_id']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value['spec_block_check_id']; ?>"><?php echo $value['spec_block_check_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Specimen Labeled By:</label>
                                                <select data-placeholder="Labelled by:" name="specimen_labeled_by" class="form-control">
                                                    <option value="">Labeled by:</option>
                                                    <?php
                                                    if (!empty($specimen_labeled_by)) {
                                                        foreach ($specimen_labeled_by as $key => $value) {
                                                            $selected = '';
                                                            if ($row->specimen_labelled_by === $value['spec_labeled_by_id']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value['spec_labeled_by_id']; ?>"><?php echo $value['spec_labeled_by_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Specimen QC'd By:</label>
                                                <select data-placeholder="QC’d by:" name="specimen_qcd_by" class="form-control">
                                                    <option value="">QC’d by:</option>
                                                    <?php
                                                    if (!empty($specimen_qcd_by)) {
                                                        foreach ($specimen_qcd_by as $key => $value) {
                                                            $selected = '';
                                                            if ($row->specimen_qc_by === $value['spec_qcd_by_id']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value['spec_qcd_by_id']; ?>"><?php echo $value['spec_qcd_by_name']; ?></option> 
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Specimen Cut up By:</label>
                                                <select name="specimen_cutupby" class="form-control">
                                                    <option value="">Cut up by:</option>
                                                    <?php
                                                    if (!empty($specimen_cutup_by)) {
                                                        foreach ($specimen_cutup_by as $key => $value) {
                                                            $selected = '';
                                                            if ($row->specimen_cutup_by === $value['spec_cutup_by_id']) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value['spec_cutup_by_id']; ?>"><?php echo $value['spec_cutup_by_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 custom_width">
                                            <div class="form-group">
                                                <label>Specimen Slides</label>
                                                <input type="text" class="form-control" name="specimen_slides" value="<?php echo $row->specimen_slides; ?>" placeholder="Slide No:">
                                            </div>
                                        </div>
                                        <div class="col-md-2 custom_width">
                                            <div class="form-group">
                                                <label>Specimen Type</label>
                                                <input type="text" class="form-control" name="specimen_type" placeholder="Specimen Type" value="<?php echo $row->specimen_type; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 custom_width">
                                            <div class="form-group">
                                                <label>Specimen Block</label>
                                                <select name="specimen_block" id="specimen_block"  class="form-control">
                                                    <?php
                                                    $hospital_id = $query1[0]->hospital_group_id;
                                                    $get_cost_codes['cost_codes'] = $this->Admin_model->get_cost_codes($hospital_id);
                                                    if (!empty($get_cost_codes['cost_codes'])) {
                                                        foreach ($get_cost_codes['cost_codes'] as $codes) {
                                                            $selected = '';
                                                            if ($codes->ura_cost_code_desc == $row->specimen_block) {

                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $codes->ura_cost_code_desc; ?>"><?php echo $codes->ura_cost_code_desc; ?></option>
                                                            <?php
                                                        }//endforeach
                                                    } else {
                                                        echo '<option value="0">Please Add Blocks First.</option>';
                                                    }//endif
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="rcpath_code">RCPath Code</label>
                                                <select style="margin-top:8px;" class="form-control rcpath_code">
                                                    <?php
                                                    $rcpath_array = array(
                                                        '0' => '0',
                                                        '1' => '1',
                                                        '2' => '2',
                                                        '3' => '3',
                                                        '4' => '4',
                                                        '5' => '5',
                                                        '6' => '6',
                                                        '7' => '7',
                                                        '8' => '8',
                                                        '9' => '9',
                                                        '10' => '10',
                                                        '11' => '11',
                                                        '12' => '12',
                                                        '13' => '13',
                                                        '14' => '14',
                                                        '15' => '15',
                                                        '16' => '16',
                                                        '17' => '17',
                                                        '18' => '18',
                                                        '19' => '19',
                                                        '20' => '20'
                                                    );
                                                    foreach ($rcpath_array as $key => $rcpath_code) {
                                                        $selected = '';
                                                        if ($key == $row->specimen_rcpath_code) {

                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $rcpath_code; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php
                                                $checked = '';
                                                if ($row->specimen_benign == 'benign') {
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                <label class="checkbox-inline">
                                                    <input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_benign" value="benign" style="margin-top:0px;">Benign
                                                </label>
                                                <?php
                                                $checked = '';
                                                if ($row->specimen_atypical == 'atypical') {
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                <label class="checkbox-inline"><input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_atypical" value="atypical" style="margin-top:0px;">Atypical</label>
                                                <?php
                                                $checked = '';
                                                if ($row->specimen_malignant == 'malignant') {
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                <label class="checkbox-inline"><input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_malignant" value="malignant" style="margin-top:0px;">Malignant</label>
                                                <?php
                                                $checked = '';
                                                if ($row->specimen_inflammation == 'inflammation') {
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                <label class="checkbox-inline"><input <?php echo $checked; ?> type="checkbox" class="specimen_classification" name="specimen_inflammation" value="inflammation" style="margin-top:0px;">Inflammation</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 dynamic_data">
                                            <div class="form-group">
                                                <label>Specimen Macroscopic Description <b style="color:red;">*</b></label>
                                                <textarea disabled rows="7" class="form-control"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Microscopic Code </label>
                                                <input disabled type="text" class="form-control specimen_microscopic_code" value="<?php echo $row->specimen_microscopic_code; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Specimen Microscopic Description <b style="color:red;">*</b></label>
                                                <textarea disabled rows="7" required class="form-control"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Specimen Cancer Register</label>
                                                <input disabled type="text" class="form-control" value="<?php echo $row->specimen_cancer_register; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Specimen Diagnosis</label>
                                                <input disabled type="text" class="form-control" value="<?php echo $row->specimen_diagnosis_description; ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                $tabs_active = '';
                                $inner_tab_count++;
                            endforeach;
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>