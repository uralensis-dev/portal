<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('csv_search_error') != '') {
            echo $this->session->flashdata('csv_search_error');
        }
        ?>
        <div class="col-md-6">
            <button class="btn btn-primary" data-toggle="collapse" data-target="#published_reports">Published Reports</button>
            <button class="btn btn-primary" data-toggle="collapse" data-target="#published_and_un_reports">Published & Un-Published Reports</button>
        </div>
        <div class="col-md-6">
            <div id="published_reports" class="collapse">
                <div class="well">
                    <p class="lead text-center">Published Reports</p>
                    <form id="download_csv_rec_pub" action="<?php echo base_url('index.php/institute/find_csv_reports'); ?>" method="get">
                        <div class="form-group text-center">
                            <label class="checkbox-inline">
                                <input required type="checkbox" id="ura_no" name="ura_no" value="ura_no"> Uralensis No.
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_date_taken" name="check_date_taken" value="check_date_taken"> Date Taken
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="lab_number" name="lab_number" value="lab_number"> Lab Number
                            </label>
                            <label class="checkbox-inline">
                                <input required type="checkbox" id="patient_name" name="patient_name" value="patient_name"> Patient Name
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="patient_sex" name="patient_sex" value="patient_sex"> Sex
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_dob" name="check_dob" value="check_dob"> Date of Birth
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="nhs_number" name="nhs_number" value="nhs_number"> NHS Number
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="emis_number" name="emis_number" value="emis_number"> Emis Number
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_date_rec_by_lab" name="check_date_rec_by_lab" value="check_date_rec_by_lab"> D. Received Lab
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_date_autho" name="check_date_autho" value="check_date_autho"> D. Authorised
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="clinician" name="clinician" value="clinician"> Clinician
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_diagnosis" value="speci_diagnosis"> Diagnosis
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_snomed_t" value="speci_snomed_t"> Snomed T
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_snomed_p" value="speci_snomed_p"> Snomed P
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_snomed_m" value="speci_snomed_m"> Snomed M
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="cases_category" name="cases_category" value="cases_category"> Case Category
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="report_urgency" name="report_urgency" value="report_urgency"> Report Urgency
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="clinical_history" name="clinical_history" value="clinical_history"> Clinical History
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="specimen_microscopy" name="specimen_microscopy" value="specimen_microscopy"> Specimen Microscopy
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="specimen_macroscopy" name="specimen_macroscopy" value="specimen_macroscopy"> Specimen Macroscopy
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="dermatological_surgeon" name="dermatological_surgeon" value="dermatological_surgeon"> Dermatological Surgeon
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="reporting_doctor" name="reporting_doctor" value="reporting_doctor"> Reporting Doctor
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="date_rec_back_from_lab" name="date_rec_back_from_lab" value="date_rec_back_from_lab"> Date Received Back From Lab
                            </label>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="custom_label" for="date_from">Choose Date From</label>
                            <input class="custom_input" type="text" name="date_from" id="date_from" placeholder="Date From">
                        </div>
                        <div class="form-group">
                            <label class="custom_label" for="date_to">Choose Date To</label>
                            <input class="custom_input" type="text" name="date_to" id="date_to" placeholder="Date To">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="published_reports" class="btn btn-warning">Search Reports</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="published_and_un_reports" class="collapse">
                <div class="well">
                    <p class="lead text-center">Published & Un-Published Reports</p>
                    <form id="download_csv_rec_pub_unpub" action="<?php echo base_url('index.php/institute/find_csv_reports'); ?>" method="get">
                        <div class="form-group text-center">
                            <label class="checkbox-inline">
                                <input required type="checkbox" id="ura_no" name="ura_no" value="ura_no"> Uralensis No.
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_date_taken" name="check_date_taken" value="check_date_taken"> Date Taken
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="lab_number" name="lab_number" value="lab_number"> Lab Number
                            </label>
                            <label class="checkbox-inline">
                                <input required type="checkbox" id="patient_name" name="patient_name" value="patient_name"> Patient Name
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="patient_sex" name="patient_sex" value="patient_sex"> Sex
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_dob" name="check_dob" value="check_dob"> Date of Birth
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="nhs_number" name="nhs_number" value="nhs_number"> NHS Number
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="emis_number" name="emis_number" value="emis_number"> Emis Number
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_date_rec_by_lab" name="check_date_rec_by_lab" value="check_date_rec_by_lab"> D. Received Lab
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="check_date_autho" name="check_date_autho" value="check_date_autho"> D. Authorised
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="clinician" name="clinician" value="clinician"> Clinician
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_diagnosis" value="speci_diagnosis"> Diagnosis
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_snomed_t" value="speci_snomed_t"> Snomed T
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_snomed_p" value="speci_snomed_p"> Snomed P
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="speci_diagnosis" name="speci_snomed_m" value="speci_snomed_m"> Snomed M
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="cases_category" name="cases_category" value="cases_category"> Case Category
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="report_urgency" name="report_urgency" value="report_urgency"> Report Urgency
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="clinical_history" name="clinical_history" value="clinical_history"> Clinical History
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="specimen_microscopy" name="specimen_microscopy" value="specimen_microscopy"> Specimen Microscopy
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="specimen_macroscopy" name="specimen_macroscopy" value="specimen_macroscopy"> Specimen Macroscopy
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="dermatological_surgeon" name="dermatological_surgeon" value="dermatological_surgeon"> Dermatological Surgeon
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="reporting_doctor" name="reporting_doctor" value="reporting_doctor"> Reporting Doctor
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="date_rec_back_from_lab" name="date_rec_back_from_lab" value="date_rec_back_from_lab"> Date Received Back From Lab
                            </label>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="custom_label" for="date_from">Choose Date From</label>
                            <input class="custom_input" type="text" name="date_from" id="date_from" placeholder="Date From">
                        </div>
                        <div class="form-group">
                            <label class="custom_label" for="date_to">Choose Date To</label>
                            <input class="custom_input" type="text" name="date_to" id="date_to" placeholder="Date To">
                        </div>
                        <div class="form-group">
                            <button name="published_and_un_reports" type="submit" class="btn btn-warning">Search Reports</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>