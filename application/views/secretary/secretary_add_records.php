<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('lab_match_msg') != '') {
            echo $this->session->flashdata('lab_match_msg');
        }
        ?>
        <form class="form" id="add_record_form" action="<?php echo base_url('/index.php/secretary/add_record'); ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="admin_choose_hospital"><i>Choose Clicnic which you want to assign the record.</i></label>
                        <select id="admin_choose_hospital" required class="form-control admin_choose_hospital" name="hospital_user">
                            <option value="">Select Clinic</option>
                            <?php
                            $get_hospital_users = $this->Secretary_model->get_hospital_users();
                            if (!empty($get_hospital_users) && is_array($get_hospital_users)) {
                                foreach ($get_hospital_users as $hospital_users) {
                                    echo '<option value="' . intval($hospital_users->id) . '">' . html_purify($hospital_users->first_name) . ' ' . html_purify($hospital_users->last_name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="dynamic_data clinic_ref">
                        <div class="form-group">
                            <label>Select Clinic Reference </label>
                            <input required type="text" class="form-control clinic_reference" name="clinic_reference" id="clinic_reference" placeholder="Type to select clinic reference"/>
                            <input type="hidden" class="clinic_reference_id" name="clinic_reference_id" value="" >
                            <input type="hidden" class="hospital_id" value="" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="admin_choose_batch"><i>Assign Batch to this Record.</i></label>
                        <select id="admin_choose_batch" required class="form-control admin_choose_batch" name="admin_choose_batch">
                            <option value="">Select Batch</option>
                            <?php
                            $display_batches = $this->Secretary_model->display_tracking_model();
                            if (!empty($display_batches) && is_array($display_batches)) {
                                foreach ($display_batches as $list_batches) {
                                    echo '<option value="' . intval($list_batches->ura_track_batch_id) . '">' . html_purify($list_batches->ura_track_batch_name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div> 
                    <div class="request_form_dynamic">

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Patient Initial :</label>
                        <input type="text" class="form-control" name="patient_initial" id="patient_initial" placeholder="Patient Initial"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">EMIS Number :</label>
                        <input required type="text" class="form-control" name="emis_number" id="emis_number" placeholder="Emis Number"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nhs Number :</label>
                        <input required type="text" class="form-control" name="nhs_number" id="nhs_number" placeholder="Nhs Number"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Lab Number</label>
                        <div class="lab_message"></div>
                        <input required type="text" class="form-control" name="lab_number" id="lab_number" placeholder="Lab Number"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Hospital Number</label>
                        <input required type="text" class="form-control" name="hos_number" id="hos_number" placeholder="Hospital Number"/>

                    </div>
                    <div class="form-group">  
                        <label class="control-label">Surname</label>
                        <input required type="text" class="form-control" name="sur_name" id="sur_name" placeholder="SurName"/>

                    </div>
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input required type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name"/>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Date of Birth</label>
                        <input required type="text" class="form-control" name="dob" id="dob" placeholder="Date of Birth"/>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Lab Name</label>
                        <select required name="lab_name" class="form-control">
                            <option value="">Choose Lab Name</option>
                            <?php
                            /**
                             * Get Lab Name By calling Its Model Method
                             */
                            $get_lab_names = $this->Secretary_model->get_lab_names();
                            if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                foreach ($get_lab_names as $lab_name) {
                                    echo '<option value="' . html_purify($lab_name->lab_name) . '">' . html_purify($lab_name->lab_name) . '</option>';
                                }
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Sent To Uralensis</label>
                        <input type="text" class="form-control" name="date_sent_touralensis" id="date_sent_touralensis" placeholder="Date Sent To Uralensis">

                    </div>
                </div>
                <div class="col-md-6">
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
                        <input type="text" class="form-control" name="pci_no" id="pci_no" placeholder="PCI Number"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Gender</label>
                        <select id="gender" required name="gender" class="form-control">
                            <option value="">Select Gender...</option> 
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group dynamic_data">
                        <label class="control-label">Primary Clinician</label>
                        <select required name="clrk" id="clrk" class="form-control clrk">

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Dermatological Surgeon</label>
                        <select name="dermatological_surgeon" id="dermatological_surgeon" class="form-control dermatological_surgeon">
                            <option>Please choose from above</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Taken</label>
                        <?php
                        $datestring = "%Y /%m /%d";
                        $time = time();
                        ?>
                        <input required type="text" class="form-control" name="date_taken" id="date_taken" placeholder="Date Taken"/>

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
                        <label class="control-label">Clinical Detail</label>
                        <textarea required class="form-control" rows="6"  name="cl_detail" id="cl_detail" placeholder="Clinical Detail"></textarea>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Received By Lab</label>
                        <input type="text" class="form-control" name="date_received_bylab" id="date_received_bylab" placeholder="Date Received By Lab">

                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Processed By Lab</label>
                        <input type="text" class="form-control" name="data_processed_bylab" id="data_processed_bylab" placeholder="Date Processed By Lab">

                    </div>

                </div>
            </div>     
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <button style="width: 100%;margin-top: 30px;" id="check_form" type="submit" class="btn btn-primary check_form">Add Request</button>
                </div>
            </div>
        </form>
    </div>
</div>