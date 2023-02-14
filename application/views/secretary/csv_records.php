<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <a onclick="window.history.back();"><button type="submit" class="btn btn-primary"><< Go Back</button></a>
        <hr>
        <?php

        if (!empty($find_csv_records)) {
            $group_id = $_GET['hospital_list'];
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
            ?>
            <div class="alert bg-success">Following <?php echo count($find_csv_records); ?> Record/s Found Related To Your Search.</div>
            <?php
            if (isset($_GET['published_reports'])) {
                ?>
                <a href="<?php echo base_url('index.php/secretary/download_csv_publish?date_from=' . $date_from . '&date_to=' . $date_to . '&hospital_list=' . $group_id . $get_concat_values); ?>">
                    <button type="submit" class="btn btn-primary">Download</button>
                </a>
                <?php
            } else {
                ?>
                <a href="<?php echo base_url('index.php/secretary/download_csv_publish_unpublish?date_from=' . $date_from . '&date_to=' . $date_to . '&hospital_list=' . $group_id . $get_concat_values); ?>">
                    <button type="submit" class="btn btn-primary">Download</button>
                </a>
                <?php
            }
        } else {
            echo '<div class="alert bg-danger">Sorry No Record Found.</div>';
        }
        ?>
    </div>
</div>