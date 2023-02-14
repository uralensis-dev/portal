<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$id = $this->uri->segment(3);
$data1['query'] = $this->Doctor_model->doctor_record_detail($id);
$data2['query'] = $this->Doctor_model->doctor_record_detail_specimen($id);

/* Snomed T Code */
require_once('application/views/doctor/inc/snomed/snomed-t-code.php');

/* Snomed P Code */
require_once('application/views/doctor/inc/snomed/snomed-p-code.php');

/* Snomed M Code */
require_once('application/views/doctor/inc/snomed/snomed-m-code.php');
?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="pull-left form-group">
            <a onclick="window.history.back();"><button class="btn btn-primary"><i class="fa fa-backward" style="margin-right:10px;"></i> Go Back</button></a>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
            <div class="panel panel-primary">
              <div class="panel-heading">Report Details</div>
              <div class="panel-body">
                <form id="teaching_case_detail" method="post">
                    <?php foreach ($query as $row): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="custom_label" for="sur_name">Patient Initial</label>
                                    <input type="text" class="custom_input" id="patient_initial" name="patient_initial" placeholder="Patient Initial" value="<?php echo $row->patient_initial; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="pci_no">PCI No.</label>
                                    <input type="text" class="custom_input" id="pci_no" name="pci_no" placeholder="PCI Number" value="<?php echo $row->pci_number; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="sur_name">Surname</label>
                                    <input type="text" class="custom_input" id="sur_name" name="sur_name" placeholder="Surname" value="<?php echo $row->sur_name; ?>">
                                </div>
                                 <div class="form-group">
                                    <label class="custom_label" for="emis_number">Emis Number</label>
                                    <input type="text" class="custom_input" id="emis_number" name="emis_number" placeholder="Emis Number" value="<?php echo $row->emis_number; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="lab_number">Lab Number</label>
                                    <input type="text" class="custom_input" id="lab_number" name="lab_number" placeholder="Lab Number" value="<?php echo $row->lab_number; ?>">
                                </div>
                                 <div class="form-group">
                                    <label class="custom_label" for="dob">Date of Birth</label>
                                    <input class="custom_input" type="text" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $row->dob; ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="date_received_bylab">Lab Receiving Date</label>
                                    <input class="custom_input" type="text" name="date_received_bylab" id="date_received_bylab" placeholder="Lab Receiving Date" value="<?php echo $row->date_received_bylab; ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="date_sent_touralensis">Received back from Lab</label>
                                    <input class="custom_input" type="text" name="date_sent_touralensis" id="date_sent_touralensis" placeholder="Uralensis Sent Date" value="<?php echo $row->date_sent_touralensis; ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="clrk">Clinical Requesting Work</label>
                                    <input class="custom_input" readonly type="text" name="clrk" id="clrk" placeholder="Clinical Requesting Work" value="<?php echo $row->clrk; ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="custom_label" for="first_name">First Name</label>
                                    <input type="text" class="custom_input" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $row->f_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="nhs_number">Nhs Number</label>
                                    <input type="text" class="custom_input" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="<?php echo $row->nhs_number; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="hos_number">Hospital Number</label>
                                    <input type="text" class="custom_input" id="hos_number" name="hos_number" placeholder="Hospital Number" value="<?php echo $row->hos_number; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="lab_name">Lab Name</label>
                                    <input type="text" class="custom_input" id="lab_name" name="lab_name" placeholder="Lab Name" value="<?php echo $row->lab_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="data_processed_bylab">Lab Processing Date</label>
                                    <input class="custom_input" type="text" name="data_processed_bylab" id="data_processed_bylab" placeholder="Lab Processing Date" value="<?php echo $row->data_processed_bylab; ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="gender">Gender</label>
                                    <input class="custom_input" readonly type="text" name="gender" id="dob" placeholder="Gender" value="<?php echo $row->gender; ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="date_taken">Date Taken</label>
                                    <input class="custom_input" type="text" name="date_taken" id="datetaken_doctor" placeholder="Date Taken" value="<?php echo $row->date_taken; ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="report_urgency">Report Urgency</label>
                                    <input class="custom_input" readonly type="text" name="report_urgency" id="report_urgency" placeholder="Report Urgency" value="<?php echo $row->report_urgency; ?>" />
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="custom_label" for="cl_detail">Clinical Detail <b style="color:red;">*</b></label>
                                    <textarea class="custom_input"  required name="cl_detail" id="cl_detail" placeholder="Clinical Detail"><?php echo $row->cl_detail; ?></textarea>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
              </div>
            </div>
        </div>

        <?php
        $count = 1;
        foreach ($data2['query'] as $row) :
            $session_data = array(
                'specimen_id' => $row->specimen_id
            );
            $this->session->set_userdata($session_data);
            $specimen_id = $this->session->userdata('specimen_id');
            ?>
        <div class="form-group">
        <form method="post" id="doctor_update_specimen_record_<?php echo $count; ?>">
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                    <div class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $count; ?>" aria-expanded="true" aria-controls="collapseOne">
                            Specimen <?php echo $count; ?>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="<?php echo $count; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Specimen Site (T Code)</label>
                                    <input type="text" class="form-control" name="specimen_site" id="date" value="<?php echo $row->specimen_site; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Specimen Type</label>
                                    <input type="text" class="form-control" name="specimen_type" id="date" placeholder="Specimen Type" value="<?php echo $row->specimen_type; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Specimen Block</label>
                                    <input type="text" class="form-control" name="specimen_block" id="date" value="<?php echo $row->specimen_block; ?>"/>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Specimen Procedure (P Code)</label>
                                    <input type="text" class="form-control" name="specimen_procedure" id="date" value="<?php echo $row->specimen_procedure; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>Specimen Slides</label>
                                    <input type="text" class="form-control" name="specimen_slides" id="date" value="<?php echo $row->specimen_slides; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Specimen Block Type</label>
                                    <input type="text" class="form-control" name="specimen_block_type" id="date" value="<?php echo $row->specimen_block_type; ?>"/>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Specimen Snomed Code</label>
                                <input  type="text" class="form-control" name="specimen_snomed_code" id="specimen_snomed_code"  value="<?php echo $row->specimen_snomed_code; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Specimen Snomed Description</label>
                                <textarea class="form-control" name="specimen_snomed_description" id="specimen_snomed_description"><?php echo $row->specimen_snomed_description; ?></textarea>

                            </div>
                            <div class="form-group">
                                <label>Specimen RCPath Code</label>
                                <input  type="text" class="form-control" name="rcpath_code" id="rcpath_code"  value="<?php echo $row->specimen_rcpath_code; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $snomed_t_array = snomed_t_code();
                                $snomed_t_id = $row->specimen_snomed_t;
                                ?>
                                <label for="specimen_snomed_t">Snomed T</label>
                                <select  name="specimen_snomed_t" id="specimen_snomed_t"  class="form-control selectpicker" data-live-search="true">
                                    <?php
                                    foreach ($snomed_t_array as $key => $snomed_t_code) {
                                        //echo $key . 'Testing';
                                        $selected = '';
                                        if ($key == $row->specimen_snomed_t) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $snomed_t_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php
                                $snomed_p_array = snomed_p_code();
                                $snomed_p_id = $row->specimen_snomed_p;
                                
                                ?>
                                <label for="specimen_snomed_p">Snomed P</label>
                                <select name="specimen_snomed_p" id="specimen_snomed_p"  class="form-control selectpicker" data-live-search="true">
                                    <?php
                                    foreach ($snomed_p_array as $key => $snomed_p_code) {
                                        $selected = '';
                                        if ($key == $row->specimen_snomed_p) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $snomed_p_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <?php
                                $snomed_m_array = snomed_m_code();
                                $snomed_m_id = $row->specimen_snomed_m;
                                ?>
                                <label for="specimen_snomed_m">Snomed M</label>
                                <select name="specimen_snomed_m" id="specimen_snomed_m"  class="form-control selectpicker" data-live-search="true">

                                    <?php
                                    foreach ($snomed_m_array as $key => $snomed_m_code) {
                                        $selected = '';
                                        if ($key == $row->specimen_snomed_m) {

                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $snomed_m_code; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-12 dynamic_data">
                            <div class="form-group">
                                <label>Specimen Microscopic Code </label>
                                <input type="text" class="form-control specimen_microscopic_code" name="specimen_microscopic_code" id="specimen_microscopic_code" value="<?php echo $row->specimen_microscopic_code; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Specimen Macroscopic Description <b style="color:red;">*</b></label>
                                <textarea rows="5" required class="form-control" name="specimen_macroscopic_description" id="specimen_macroscopic_description"><?php echo $row->specimen_macroscopic_description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Specimen Microscopic Description <b style="color:red;">*</b></label>
                                <textarea rows="5" required class="form-control specimen_microscopic_description" name="specimen_microscopic_description" id="specimen_microscopic_description"><?php echo $row->specimen_microscopic_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div id="doctor_update_specimen_record_message_<?php echo $count; ?>"></div>
                    <?php if (!$row->specimen_publish_status == 1) { ?>
                        <button class="btn btn-info" id="doctor_update_specimen_record_btn_<?php echo $count; ?>" name="submit">Update Diagnosis</button>
                    <?php } ?>
                </div>
            </div>
            
            </form>

            <?php
            $count++;
        endforeach;
        ?>
        </div>
    </div>
</div>
