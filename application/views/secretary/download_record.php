<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('csv_search_error') != '') {
            echo html_purify($this->session->flashdata('csv_search_error'));
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
                    <form id="download_csv_rec_pub" action="<?php echo base_url('index.php/secretary/find_csv_reports'); ?>" method="get">
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
                            <label class="custom_label" for="hospital_list">Choose Hospital</label>
                            <select class="custom_input" name="hospital_list" id="hospital_list">
                                <option value="0">Choose Hospital</option>
                                <?php
                                if (!empty($hospital_groups)) {
                                    foreach ($hospital_groups as $groups) {
                                        echo '<option value="' . intval($groups->id) . '">' . html_purify($groups->description) . '</option>';
                                    }
                                }
                                ?>
                            </select>
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
                    <form id="download_csv_rec_pub_unpub" action="<?php echo base_url('index.php/secretary/find_csv_reports'); ?>" method="get">
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
                            <label class="custom_label" for="hospital_list">Choose Hospital</label>
                            <select class="custom_input" name="hospital_list" id="hospital_list">
                                <option value="0">Choose Hospital</option>
                                <?php
                                if (!empty($hospital_groups)) {
                                    foreach ($hospital_groups as $groups) {
                                        echo '<option value="' . intval($groups->id) . '">' . html_purify($groups->description) . '</option>';
                                    }
                                }
                                ?>
                            </select>
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