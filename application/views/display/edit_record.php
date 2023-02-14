<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $id = $this->uri->segment(3); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
                <div class="col-md-2">
                    <button onclick="window.history.back()" class="btn btn-primary"><< Go Back</button>
                </div>

                <div class="col-md-12">
                    <h1 style="text-align: center;">Edit Request</h1>
                    <hr />
                    <?php if (!empty($record_query)) { ?>
                        <form method="post" id="personal_record_form">
                            <?php foreach ($record_query as $row): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="custom_label">Tracking No</label>
                                            <input type="text" class="custom_input" name="tracking_no" id="tracking_no" placeholder="Tracking No" value="<?php echo $row->ura_barcode_no; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Patient Initial</label>
                                            <input type="text" class="custom_input" name="patient_initial" id="patient_initial" placeholder="Patient Initial" value="<?php echo $row->patient_initial; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">PCI No.</label>
                                            <input type="text" class="custom_input" name="pci_no" id="pci_no" placeholder="PCI Number" value="<?php echo $row->pci_number; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">First Name</label>
                                            <input type="text" class="custom_input" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $row->f_name; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Emis Number :</label>
                                            <input type="text" class="custom_input" name="emis_number"  id="nhs_number" placeholder="Nhs Number" value="<?php echo $row->emis_number; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Lab Number</label>
                                            <input type="text" class="custom_input" name="lab_number" id="lab_number" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Date of Birth</label>
                                            <?php
                                            $dob = '';
                                            if (!empty($row->dob)) {
                                                $dob = date('d-m-Y', strtotime($row->dob));
                                            }
                                            ?>
                                            <input type="text" class="custom_input" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $dob; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Lab Receiving Date</label>
                                            <?php
                                            $lab_rec_date = '';
                                            if (!empty($row->date_received_bylab)) {
                                                $lab_rec_date = date('d-m-Y', strtotime($row->date_received_bylab));
                                            }
                                            ?>
                                            <input type="text" class="custom_input" name="date_received_bylab" id="date_received_bylab" placeholder="Lab Receiving Date" value="<?php echo $lab_rec_date; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Uralensis Sent Date</label>
                                            <?php
                                            $date_sent_ura = '';
                                            if (!empty($row->date_sent_touralensis)) {
                                                $date_sent_ura = date('d-m-Y', strtotime($row->date_sent_touralensis));
                                            }
                                            ?>
                                            <input type="text" class="custom_input" name="date_sent_touralensis" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="<?php echo $date_sent_ura; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="custom_label">Surname</label>
                                            <input type="text" class="custom_input" name="sur_name" id="sur_name" placeholder="SurName" value="<?php echo $row->sur_name; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Nhs Number :</label>
                                            <input type="text" class="custom_input" name="nhs_number"  id="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Lab Name</label>
                                            <select name="lab_name" class="custom_input lab_name">
                                                <option value="0">Choose Lab Name</option>
                                                <?php
                                                /**
                                                 * Get Lab Name By calling Its Model Method
                                                 */
                                                $get_lab_names = $this->Admin_model->get_lab_names();

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
                                        </div>
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
                                        <div class="form-group">
                                            <label class="custom_label">Date Taken</label>
                                            <?php
                                            $date_taken = '';
                                            if (!empty($row->date_taken)) {
                                                $date_taken = date('d-m-Y', strtotime($row->date_taken));
                                            }
                                            ?>
                                            <input type="text" class="custom_input" name="date_taken" id="date_taken" placeholder="Date Taken" value="<?php echo $date_taken; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label">Importance</label>
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
                                        <div class="form-group">
                                            <label class="custom_label" for="clrk">Clinical Req Work</label>
                                            <select class="custom_input" readonly name="clrk" id="clrk">
                                                <option value="">Choose Clinician</option>
                                                <?php echo $this->Admin_model->get_clinician_and_derm($row->hospital_group_id, 'clinician', $row->clrk); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="custom_label" for="dermatological_surgeon">Derm Surgeon</label>
                                            <select readonly name="dermatological_surgeon" id="dermatological_surgeon" class="custom_input">
                                                <option value="">Choose Dermatological Surgeon</option>
                                                <?php echo $this->Admin_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological', $row->dermatological_surgeon); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="update_personal_record">Update Record</button>
                                    <hr>
                                    <div id="update_record_message"></div>
                                </div>
                                <input type="hidden" name="record_id" value="<?php echo $id; ?>">
                            <?php endforeach; ?>
                        </form>
                    <?php } ?>
                    <div class="tg-inputshold specimen_content">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_specimen_model">Add Specimen</button>
                                <div class="modal fade" id="add_specimen_model" role="dialog" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Add Specimen</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form record_specimen_form">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Specimen Accepted By</label>
                                                            <select name="specimen_accepted_by" class="form-control">
                                                                <option value="">Accepted By:</option>
                                                                <?php
                                                                if (!empty($specimen_accepted_by)) {
                                                                    foreach ($specimen_accepted_by as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['spec_accep_by_id']; ?>"><?php echo $value['spec_accep_by_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen Cut Up By</label>
                                                            <select name="specimen_cutupby" class="form-control">
                                                                <option value="">Cut up by:</option>
                                                                <?php
                                                                if (!empty($specimen_cutup_by)) {
                                                                    foreach ($specimen_cutup_by as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['spec_cutup_by_id']; ?>"><?php echo $value['spec_cutup_by_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen Assisted By</label>
                                                            <select data-placeholder="Assisted by:" name="specimen_assisted_by" class="form-control">
                                                                <option value="">Assisted by:</option>
                                                                <?php
                                                                if (!empty($specimen_assisted_by)) {
                                                                    foreach ($specimen_assisted_by as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['spec_assis_by_id']; ?>"><?php echo $value['spec_assis_by_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen Block Checked By</label>
                                                            <select data-placeholder="Block checked by:" name="specimen_block_checked_by" class="form-control">
                                                                <option value="">Block checked by:</option>
                                                                <?php
                                                                if (!empty($specimen_block_checked_by)) {
                                                                    foreach ($specimen_block_checked_by as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['spec_block_check_id']; ?>"><?php echo $value['spec_block_check_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen Labeled By</label>
                                                            <select data-placeholder="Labelled by:" name="specimen_labeled_by" class="form-control">
                                                                <option value="">Labeled by:</option>
                                                                <?php
                                                                if (!empty($specimen_labeled_by)) {
                                                                    foreach ($specimen_labeled_by as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['spec_labeled_by_id']; ?>"><?php echo $value['spec_labeled_by_name']; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen QC'd By</label>
                                                            <select data-placeholder="QC’d by:" name="specimen_qcd_by" class="form-control">
                                                                <option value="">QC’d by:</option>
                                                                <?php
                                                                if (!empty($specimen_qcd_by)) {
                                                                    foreach ($specimen_qcd_by as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value['spec_qcd_by_id']; ?>"><?php echo $value['spec_qcd_by_name']; ?></option> 
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Specimen Diagnosis</label>
                                                            <input type="text" class="form-control" name="specimen_diagnosis" placeholder="Specimen Diagnosis"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen Slides</label>
                                                            <input type="text" class="form-control" name="specimen_slides" id="date" placeholder="Specimen Slides"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Specimen Block</label>
                                                            <select name="specimen_block" id="specimen_block"  class="form-control">
                                                                <?php
                                                                $hospital_id = $record_query[0]->hospital_group_id;
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
                                                            <label>Specimen Macroscopic Description</label>
                                                            <textarea class="form-control" name="specimen_macroscopic_description" placeholder="Specimen Macroscopic Description"></textarea>
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
                                                        <input type="hidden" name="record_id" value="<?php echo intval($id); ?>">
                                                        <button class="btn btn-warning pull-right finish_specimen_edit_report">Finish Specimen</button>
                                                        <div class="pull-left"><button type="button" class="btn btn-primary add-specimen-admin-btn">Add Specimen</button></div>
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
                        <ul class="nav nav-tabs specimen_tabs">
                            <?php
                            $active = 'active';
                            $count = 1;
                            foreach ($specimen_query as $row) :
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
                            foreach ($specimen_query as $row) :
                                $session_data = array(
                                    'specimen_id' => $row->specimen_id
                                );
                                $this->session->set_userdata($session_data);
                                $specimen_id = $this->session->userdata('specimen_id');
                                ?>
                                <div id="tabs_<?php echo $inner_tab_count; ?>" class="tab-pane fade in <?php echo $tabs_active; ?>">
                                    <form id="update_specimen_record_<?php echo $inner_tab_count; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-3">
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
                                            <div class="col-md-3">
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Specimen Block Checked By:</label>
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
                                            <div class="col-md-3">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
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

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Specimen Block</label>
                                                    <select name="specimen_block" id="specimen_block"  class="form-control">
                                                        <?php
                                                        $hospital_id = $record_query[0]->hospital_group_id;
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
                                            <div class="col-md-3">
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Specimen Slides</label>
                                                    <input type="text" class="form-control" name="specimen_slides" value="<?php echo $row->specimen_slides; ?>" placeholder="Slide No:">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Specimen Type</label>
                                                    <input type="text" class="form-control" name="specimen_type" placeholder="Specimen Type" value="<?php echo $row->specimen_type; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Clinical History</label>
                                                    <textarea name="specimen_clinical_history" class="form-control" placeholder="Clinical History"><?php echo $row->specimen_clinical_history; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Macroscopic Description</label>
                                                    <textarea rows="5" class="form-control" name="specimen_macroscopic_description"  placeholder="Specimen Block Type"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Microscopic Code</label>
                                                    <input type="text" class="form-control" name="specimen_microscopic_code" id="date" placeholder="Specimen Microscopic Code" value="<?php echo $row->specimen_microscopic_code; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Specimen Microscopic Description</label>
                                                    <textarea rows="5" class="form-control" name="specimen_microscopic_description"  placeholder="Specimen Microscopic Description"><?php echo $row->specimen_microscopic_description; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Specimen Cancer Register</label>
                                                    <input type="text" class="form-control specimen_cancer" name="specimen_cancer" id="specimen_cancer" value="<?php echo $row->specimen_cancer_register; ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Specimen Diagnosis</label>
                                                    <input type="text" class="form-control specimen_dignosis" name="specimen_dignosis" id="specimen_dignosis" value="<?php echo $row->specimen_diagnosis_description; ?>"/>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="update_specimen_record_message_<?php echo $inner_tab_count; ?>"></div>
                                            <button class="btn btn-info" id="update_specimen_record_btn_<?php echo $inner_tab_count; ?>" name="submit">Update Diagnosis</button>
                                        </div>
                                        <input type="hidden" name="record_id" value="<?php echo $id; ?>" >
                                        <input type="hidden" name="specimen_id" value="<?php echo $specimen_id; ?>" >
                                    </form>
                                    <script>
                                        jQuery(document).ready(function () {
                                            jQuery('#update_specimen_record_btn_<?php echo $inner_tab_count; ?>').on('click', function (e) {
                                                e.preventDefault();
                                                var $this = jQuery(this);
                                                var update_persoanl_record = jQuery('#update_specimen_record_<?php echo $inner_tab_count; ?>').serialize();
                                                jQuery.ajax({
                                                    type: "POST",
                                                    url: "<?php echo base_url() . '/index.php/admin/update_edit_report'; ?>",
                                                    data: update_persoanl_record,
                                                    dataType: "json",
                                                    success: function (response) {
                                                        if (response.type === 'success') {
                                                            jQuery('#update_specimen_record_message_<?php echo $inner_tab_count; ?>').html(response.msg);
                                                        } else {
                                                            jQuery('#update_specimen_record_message_<?php echo $inner_tab_count; ?>').html(response.msg);
                                                        }
                                                    }
                                                });
                                            });
                                        });

                                    </script>
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
