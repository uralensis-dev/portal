<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('lab_match_msg') != '') {
            echo $this->session->flashdata('lab_match_msg');
        }
        ?>
        <form id="add_request_form" method="post" action="<?php echo site_url('Institute/add_institute'); ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="dynamic_data">
                        <div class="form-group">
                            <label>Select Clinic Reference </label>
                            <input type="text" class="form-control clinic_reference" name="clinic_reference" id="clinic_reference" placeholder="Type to select clinic reference" value="<?php echo set_value('clinic_reference'); ?>"/>
                            <input type="hidden" class="clinic_reference_id" name="clinic_reference_id" value="" >
                            <span><?php echo form_error('clinic_reference'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Patient Initial :</label>
                        <input type="text" class="form-control" name="patient_initial" id="patient_initial" placeholder="Patient Initial" value="<?php echo set_value('patient_initial'); ?>"/>
                        <span><?php echo form_error('patient_initial'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>EMIS Number :</label>
                        <input type="text" class="form-control" name="emis_number" id="emis_number" placeholder="Emis Number" value="<?php echo set_value('emis_number'); ?>"/>
                        <span><?php echo form_error('emis_number'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Nhs Number :</label>
                        <input type="text" class="form-control" name="nhs_number" id="nhs_number" placeholder="Nhs Number" value="<?php echo set_value('nhs_number'); ?>"/>
                        <span><?php echo form_error('nhs_number'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Lab Number</label>
                        <input type="text" class="form-control" name="lab_number" id="lab_number" placeholder="Lab Number" value="<?php echo set_value('lab_number'); ?>"/>
                        <span><?php echo form_error('lab_number'); ?></span>
                    </div>
                    <div class="form-group">  
                        <label>Surname</label>
                        <input type="text" class="form-control" name="sur_name" id="sur_name" placeholder="SurName" value="<?php echo set_value('sur_name'); ?>"/>
                        <span><?php echo form_error('sur_name'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo set_value('first_name'); ?>"/>
                        <span><?php echo form_error('first_name'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo set_value('dob'); ?>"/>
                        <span><?php echo form_error('dob'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Lab Name</label>
                        <select name="lab_name" class="form-control">
                            <option value="0">Choose Lab Name</option>
                            <?php
                            $get_lab_names = $this->Institute_model->get_lab_names();
                            if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                foreach ($get_lab_names as $lab_name) {
                                    echo '<option value="' . html_purify($lab_name->lab_name) . '">' . html_purify($lab_name->lab_name) . '</option>';
                                }
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Received By Lab</label>
                        <input type="text" class="form-control" name="date_received_bylab" id="date_received_bylab" placeholder="Date Received By Lab">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="request_form_dynamic">

                    </div>
                    <div class="form-group">
                        <label for="case_categories">Case Category</label>
                        <select id="case_categories" class="form-control" name="cases_category">
                            <option value="0">Choose Case Category</option>
                            <option value="Routine">Routine</option>
                            <option value="Alopecia">Alopecia</option>
                            <option value="IMF">IMF</option>
                            <option value="Review">Review</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>PCI No.</label>
                        <input type="text" class="form-control" name="pci_no" id="pci_no" placeholder="PCI Number" value="<?php echo set_value('pci_no'); ?>"/>
                        <span><?php echo form_error('pci_no'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select id="gender" name="gender" class="form-control" value="<?php echo set_value('gender'); ?>">
                            <option value="male">Select   ......</option> 
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                        </select>
                        <span><?php echo form_error('gender'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Primary Clinician</label>
                        <select required name="clrk" id="clrk" class="form-control clrk">
                            <option value="false">Choose Primary Clinician</option>
                            <?php
                            if (!empty($hospital_clinician)) {
                                foreach ($hospital_clinician as $clinicians) {
                                    echo '<option value="' . html_purify($clinicians->clinician_name) . '">' . html_purify($clinicians->clinician_name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Dermatological Surgeon</label>
                        <select required name="dermatological_surgeon" id="dermatological_surgeon" class="form-control dermatological_surgeon">
                            <option value="false">Choose Dermatological Surgeon</option>
                            <?php
                            if (!empty($hospital_surgeon)) {
                                foreach ($hospital_surgeon as $dermatological_surgeon) {
                                    echo '<option value="' . html_purify($dermatological_surgeon->dermatological_surgeon_name) . '">' . html_purify($dermatological_surgeon->dermatological_surgeon_name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Taken</label>
                        <?php
                        $datestring = "%Y /%m /%d";
                        $time = time();
                        ?>
                        <input type="text" class="form-control" name="date_taken" id="datetaken" placeholder="Date Taken"value="<?php //echo mdate($datestring, $time);                       ?>"/>
                        <span><?php echo form_error('date_taken'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Importance</label>
                        <select name="report_urgency" class="form-control">
                            <?php
                            $report_urgency = array(
                                'Routine' => 'Routine',
                                'Urgent' => 'Urgent',
                                '2WW' => '2WW'
                            );

                            foreach ($report_urgency as $key => $urgency) {
                                ?>
                                <option value="<?php echo html_purify($key); ?>"><?php echo html_purify($urgency); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Sent To Uralensis</label>
                        <input type="text" class="form-control" name="date_sent_touralensis" id="date_sent_touralensis" placeholder="Date Sent To Uralensis">

                    </div>
                    <div class="form-group">
                        <label>Clinical Detail</label>
                        <textarea class = "form-control" rows = "6" name = "cl_detail" id = "cl_detail" placeholder = "Clinical Detail"><?php echo set_value('cl_detail');
                            ?></textarea>
                        <span><?php echo form_error('cl_detail'); ?></span>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    if ($this->session->flashdata('message') == '') {
                        ?>
                        <button style="width: 100%;margin-top: 30px;" id="check_form" type="submit" class="btn btn-primary check_form">Add Request</button>
                    <?php } ?>
                </div>
            </div>
        </form>
        <hr />
    </div>
</div>






