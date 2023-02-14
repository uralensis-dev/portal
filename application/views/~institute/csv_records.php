<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <a onclick="window.history.back();"><button type="submit" class="btn btn-primary"><< Go Back</button></a>
        <hr>
        <?php
        if (!empty($find_csv_records)) {

            $hospital_group_id = $this->ion_auth->user()->row()->id;
            $group_id = $this->ion_auth->get_users_groups($hospital_group_id)->row()->id;
            $date_to = $_GET['date_to'];
            $date_from = $_GET['date_from'];

            $get_concat_values = '';

            if (isset($_GET['ura_no'])) {
                $get_concat_values .= '&ura_no=' . $_GET['ura_no'];
            }
            if (isset($_GET['check_date_taken'])) {
                $get_concat_values .= '&check_date_taken=' . $_GET['check_date_taken'];
            }
            if (isset($_GET['lab_number'])) {
                $get_concat_values .= '&lab_number=' . $_GET['lab_number'];
            }
            if (isset($_GET['patient_name'])) {
                $get_concat_values .= '&patient_name=' . $_GET['patient_name'];
            }
            if (isset($_GET['patient_sex'])) {
                $get_concat_values .= '&patient_sex=' . $_GET['patient_sex'];
            }
            if (isset($_GET['check_dob'])) {
                $get_concat_values .= '&check_dob=' . $_GET['check_dob'];
            }
            if (isset($_GET['nhs_number'])) {
                $get_concat_values .= '&nhs_number=' . $_GET['nhs_number'];
            }
            if (isset($_GET['emis_number'])) {
                $get_concat_values .= '&emis_number=' . $_GET['emis_number'];
            }
            if (isset($_GET['check_date_rec_by_lab'])) {
                $get_concat_values .= '&check_date_rec_by_lab=' . $_GET['check_date_rec_by_lab'];
            }
            if (isset($_GET['check_date_autho'])) {
                $get_concat_values .= '&check_date_autho=' . $_GET['check_date_autho'];
            }
            if (isset($_GET['clinician'])) {
                $get_concat_values .= '&clinician=' . $_GET['clinician'];
            }
            if (isset($_GET['speci_diagnosis'])) {
                $get_concat_values .= '&speci_diagnosis=' . $_GET['speci_diagnosis'];
            }
            if (isset($_GET['speci_snomed_t'])) {
                $get_concat_values .= '&speci_snomed_t=' . $_GET['speci_snomed_t'];
            }
            if (isset($_GET['speci_snomed_p'])) {
                $get_concat_values .= '&speci_snomed_p=' . $_GET['speci_snomed_p'];
            }
            if (isset($_GET['speci_snomed_m'])) {
                $get_concat_values .= '&speci_snomed_m=' . $_GET['speci_snomed_m'];
            }
            if (isset($_GET['cases_category'])) {
                $get_concat_values .= '&cases_category=' . $_GET['cases_category'];
            }
            if (isset($_GET['report_urgency'])) {
                $get_concat_values .= '&report_urgency=' . $_GET['report_urgency'];
            }
            if (isset($_GET['clinical_history'])) {
                $get_concat_values .= '&cl_detail=' . $_GET['clinical_history'];
            }
            if (isset($_GET['specimen_microscopy'])) {
                $get_concat_values .= '&specimen_microscopic_description=' . $_GET['specimen_microscopy'];
            }
            if (isset($_GET['specimen_macroscopy'])) {
                $get_concat_values .= '&specimen_macroscopic_description=' . $_GET['specimen_macroscopy'];
            }
            if (isset($_GET['dermatological_surgeon'])) {
                $get_concat_values .= '&dermatological_surgeon=' . $_GET['dermatological_surgeon'];
            }
            if (isset($_GET['reporting_doctor'])) {
                $get_concat_values .= '&reporting_doctor=' . $_GET['reporting_doctor'];
            }
            if (isset($_GET['date_rec_back_from_lab'])) {
                $get_concat_values .= '&date_sent_touralensis=' . $_GET['date_rec_back_from_lab'];
            }
            ?>
            <div class="alert bg-success">Following <?php echo count($find_csv_records); ?> Record/s Found Related To Your Search.</div>
            <?php
            if (isset($_GET['published_reports'])) {
                ?>
                <a href="<?php echo base_url('index.php/institute/download_csv_publish?date_from=' . $date_from . '&date_to=' . $date_to . '&hospital_list=' . intval($group_id) . $get_concat_values); ?>">
                    <button type="submit" class="btn btn-primary">Download</button>
                </a>
                <?php
            } else {
                ?>
                <a href="<?php echo base_url('index.php/institute/download_csv_publish_unpublish?date_from=' . $date_from . '&date_to=' . $date_to . '&hospital_list=' . intval($group_id) . $get_concat_values); ?>">
                    <button type="submit" class="btn btn-primary">Download</button>
                </a>
                <?php
            }
            ?>
            <?php
        } else {
            echo '<div class="alert bg-danger">Sorry No Record Found.</div>';
        }
        ?>
    </div>
</div>