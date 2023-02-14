<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content tg-editform">
                <?php
                if ($this->session->flashdata('csv_search_error') != '') {
                    echo $this->session->flashdata('csv_search_error');
                }
                ?>
                <div class="col-md-6">
                    <div class="tg-btnarea">
                        <button class="tg-btn" data-toggle="collapse" data-target="#published_reports">Published Reports</button>
                    </div>
                    <div id="published_reports" class="collapse">
                        <hr>
                        <div class="well">
                            <div class="tg-title">
                                <h4>Published Reports</h4>
                            </div>
                            <form novalidate id="download_csv_rec_pub" action="<?php echo base_url('index.php/admin/find_csv_reports'); ?>" method="get">
                                <div class="tg-groupschecks">
                                    <div class="tg-formradiohold">
                                        <div class="form-group text-center">
                                            <div class="tg-checkbox">
                                                <input required type="checkbox" id="ura_no" name="ura_no" value="ura_no"> 
                                                <label for="ura_no">Uralensis No</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="check_date_taken" name="check_date_taken" value="check_date_taken">
                                                <label for="check_date_taken">Date Taken</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="lab_number" name="lab_number" value="lab_number">
                                                <label for="lab_number">Lab Number</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input required type="checkbox" id="patient_name" name="patient_name" value="patient_name">
                                                <label for="patient_name">Patient Name</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="patient_sex" name="patient_sex" value="patient_sex">
                                                <label for="patient_sex">Gender</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="check_dob" name="check_dob" value="check_dob">
                                                <label for="check_dob">Date of Birth</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="nhs_number" name="nhs_number" value="nhs_number">
                                                <label for="nhs_number">NHS Number</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="emis_number" name="emis_number" value="emis_number">
                                                <label for="emis_number">Emis Number</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="check_date_rec_by_lab" name="check_date_rec_by_lab" value="check_date_rec_by_lab">
                                                <label for="check_date_rec_by_lab">D. Received Lab</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="check_date_autho" name="check_date_autho" value="check_date_autho">
                                                <label for="check_date_autho">D. Authorised</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="clinician" name="clinician" value="clinician">
                                                <label for="clinician">Clinician</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="speci_diagnosis" name="speci_diagnosis" value="speci_diagnosis">
                                                <label for="speci_diagnosis">Diagnosis</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="speci_snomed_t" name="speci_snomed_t" value="speci_snomed_t">
                                                <label for="speci_snomed_t">Snomed T</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="speci_snomed_p" name="speci_snomed_p" value="speci_snomed_p">
                                                <label for="speci_snomed_p">Snomed P</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="speci_snomed_m" name="speci_snomed_m" value="speci_snomed_m">
                                                <label for="speci_snomed_m">Snomed M</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="cases_category" name="cases_category" value="cases_category">
                                                <label for="cases_category">Case Category</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="report_urgency" name="report_urgency" value="report_urgency">
                                                <label for="report_urgency">Report Urgency</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="clinical_history" name="clinical_history" value="clinical_history">
                                                <label for="clinical_history">Clinical History</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="specimen_microscopy" name="specimen_microscopy" value="specimen_microscopy">
                                                <label for="specimen_microscopy">Specimen Microscopy</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="specimen_macroscopy" name="specimen_macroscopy" value="specimen_macroscopy">
                                                <label for="specimen_macroscopy">Specimen Macroscopy</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="dermatological_surgeon" name="dermatological_surgeon" value="dermatological_surgeon">
                                                <label for="dermatological_surgeon">Dermatological Surgeon</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="reporting_doctor" name="reporting_doctor" value="reporting_doctor">
                                                <label for="reporting_doctor">Reporting Doctor</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="date_rec_back_from_lab" name="date_rec_back_from_lab" value="date_rec_back_from_lab">
                                                <label for="date_rec_back_from_lab">Date Received Back From Lab</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="specimen_comments" name="specimen_comments" value="specimen_comments">
                                                <label for="specimen_comments">Specimen Comments</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="specimen_notes" name="specimen_notes" value="specimen_notes">
                                                <label for="specimen_notes">Specimen Notes</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <fieldset>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-clock"></i>
                                        <input class="form-control" type="text" name="date_from" id="date_from" placeholder="Choose Date From">
                                    </div>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-clock"></i>
                                        <input class="form-control" type="text" name="date_to" id="date_to" placeholder="Choose Date To">
                                    </div>
                                    <div class="form-group tg-inputwithicon report_select_dropdown">
                                        <i class="lnr lnr-apartment"></i>
                                        <div class="tg-select">
                                            <select class="form-control" name="hospital_list" id="hospital_list">
                                                <option value="" disabled selected>Choose Hospital</option>
                                                <?php
                                                if (!empty($hospital_groups)) {
                                                    foreach ($hospital_groups as $groups) {
                                                        echo '<option value="' . $groups->id . '">' . $groups->description . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="tg-btnarea">
                                    <button type="submit" name="published_reports" class="tg-btn">Search Reports</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tg-btnarea">
                        <button class="tg-btn" data-toggle="collapse" data-target="#published_and_un_reports">Published & Un-Published Reports</button>
                    </div>
                    <div id="published_and_un_reports" class="collapse">
                        <hr>
                        <div class="well">
                            <div class="tg-title">
                                <h4>Published & Un-Published Reports</h4>
                            </div>
                            <form novalidate id="download_csv_rec_pub_unpub" action="<?php echo base_url('index.php/admin/find_csv_reports'); ?>" method="get">
                                <div class="tg-groupschecks">
                                    <div class="tg-formradiohold">
                                        <div class="form-group text-center">
                                            <div class="tg-checkbox">
                                                <input required type="checkbox" id="unpub_ura_no" name="ura_no" value="ura_no">
                                                <label for="unpub_ura_no">Uralensis No</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_check_date_taken" name="check_date_taken" value="check_date_taken">
                                                <label for="unpub_check_date_taken">Date Taken</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_lab_number" name="lab_number" value="lab_number">
                                                <label for="unpub_lab_number">Lab Number</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input required type="checkbox" id="unpub_patient_name" name="patient_name" value="patient_name">
                                                <label for="unpub_patient_name">Patient Name</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_patient_sex" name="patient_sex" value="patient_sex">
                                                <label for="unpub_patient_sex">Gender</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_check_dob" name="check_dob" value="check_dob">
                                                <label for="unpub_check_dob">Date of Birth</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_nhs_number" name="nhs_number" value="nhs_number">
                                                <label for="unpub_nhs_number">NHS Number</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_emis_number" name="emis_number" value="emis_number">
                                                <label for="unpub_emis_number">Emis Number</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_check_date_rec_by_lab" name="check_date_rec_by_lab" value="check_date_rec_by_lab">
                                                <label for="unpub_check_date_rec_by_lab">D. Received Lab</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_check_date_autho" name="check_date_autho" value="check_date_autho">
                                                <label for="unpub_check_date_autho">D. Authorised</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_clinician" name="clinician" value="clinician">
                                                <label for="unpub_clinician">Clinician</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_speci_diagnosis" name="speci_diagnosis" value="speci_diagnosis">
                                                <label for="unpub_speci_diagnosis">Diagnosis</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_speci_snomed_t" name="speci_snomed_t" value="speci_snomed_t">
                                                <label for="unpub_speci_snomed_t">Snomed T</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_speci_snomed_p" name="speci_snomed_p" value="speci_snomed_p">
                                                <label for="unpub_speci_snomed_p">Snomed P</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_speci_snomed_m" name="speci_snomed_m" value="speci_snomed_m">
                                                <label for="unpub_speci_snomed_m">Snomed M</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_cases_category" name="cases_category" value="cases_category">
                                                <label for="unpub_cases_category">Case Category</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_report_urgency" name="report_urgency" value="report_urgency"> 
                                                <label for="unpub_report_urgency">Report Urgency</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_clinical_history" name="clinical_history" value="clinical_history">
                                                <label for="unpub_clinical_history">Clinical History</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_specimen_microscopy" name="specimen_microscopy" value="specimen_microscopy">
                                                <label for="unpub_specimen_microscopy">Specimen Microscopy</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_specimen_macroscopy" name="specimen_macroscopy" value="specimen_macroscopy">
                                                <label for="unpub_specimen_macroscopy">Specimen Macroscopy</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_dermatological_surgeon" name="dermatological_surgeon" value="dermatological_surgeon">
                                                <label for="unpub_dermatological_surgeon">Dermatological Surgeon</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_reporting_doctor" name="reporting_doctor" value="reporting_doctor">
                                                <label for="unpub_reporting_doctor">Reporting Doctor</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_date_rec_back_from_lab" name="date_rec_back_from_lab" value="date_rec_back_from_lab">
                                                <label for="unpub_date_rec_back_from_lab">Date Received Back From Lab</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_specimen_comments" name="specimen_comments" value="specimen_comments">
                                                <label for="unpub_specimen_comments">Specimen Comments</label>
                                            </div>
                                            <div class="tg-checkbox">
                                                <input type="checkbox" id="unpub_specimen_notes" name="specimen_notes" value="specimen_notes">
                                                <label for="unpub_specimen_notes">Specimen Notes</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <fieldset>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-clock"></i>
                                        <input class="form-control" type="text" name="date_from" id="date_from" placeholder="Choose Date From">
                                    </div>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-clock"></i>
                                        <input class="form-control" type="text" name="date_to" id="date_to" placeholder="Choose Date To">
                                    </div>
                                    <div class="form-group tg-inputwithicon report_select_dropdown">
                                        <i class="lnr lnr-apartment"></i>
                                        <div class="tg-select">
                                            <select class="form-control" name="hospital_list" id="hospital_list">
                                                <option value="" disabled selected>Choose Hospital</option>
                                                <?php
                                                if (!empty($hospital_groups)) {
                                                    foreach ($hospital_groups as $groups) {
                                                        echo '<option value="' . $groups->id . '">' . $groups->description . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="tg-btnarea">
                                    <button type="submit" name="published_and_un_reports" class="tg-btn">Search Reports</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
