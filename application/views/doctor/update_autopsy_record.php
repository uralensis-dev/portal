<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Header -->
<style type="text/css">
    .nohead_border thead th {
        border-top: 0px;
    }

    .border-right {
        border-right: 1px solid #ddd;
    }
    .npr{padding-right: 0;}
    .table td, .table th {
        padding: 15px 30px !important;
        /*font-size: 14px;*/
    }

    .faq-card .card .card-header h4 > a:after {
        top: 0;
    }

    .faq-card .card .card-header h4 > a:not(.collapsed):after {
        content: "\f077";
    }

    .faq-card .card .card-header h4 > a.collapsed:after {
        content: "\f078";
    }
    button.auto_save {
        position: absolute;
        right: 60px;
        top: 50%;
        transform: translateY(-50%);
    }
    @media screen and (min-width: 1600px) {
        .table td, .table th {font-size: 16px;}
        .font-16{
            font-size: 18px;
        }
    }
    .font-16{
        font-size: 16px;
    }

</style>
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Autopsy Record</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Records</li>
                <li class="breadcrumb-item active">Update Record</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="faq-card autosp_cards">
    <div class="card">
            <div class="card-body">
                <?php
                $attributes = array('class' => '');
                echo form_open_multipart("doctor/update_autopsy_record/". $record_id, $attributes);
                ?>
                <div class="row">
                        <input type="hidden" name="record_id" value="<?php echo $record_id ?>">

                            <div class="col-md-3 form-group">
                                <label for="initials">Initial</label>
                                <input type="text" class="form-control" name="initials" id="initials">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="sur_name">Sur Name</label>
                                <input type="text" class="form-control" name="sur_name" id="sur_name">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="patient_dob">DOB</label>
                                <input type="text" class="form-control" name="patient_dob" id="patient_dob">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="nhs_no">NHS No. (CR0010)</label>
                                <input type="text" class="form-control" name="nhs_no" id="nhs_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="hospital_no">Hospital No.</label>
                                <input readonly type="text" class="form-control" name="hospital_no" id="hospital_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="hospital_code">Hospital Code</label>
                                <input readonly type="text" class="form-control" name="hospital_code" id="hospital_code">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="p_usual_address">Patient Usual Address</label>
                                <input readonly type="text" class="form-control" name="p_usual_address" id="p_usual_address">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="p_city">Patient City</label>
                                <input readonly type="text" class="form-control" name="p_city" id="p_city">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="post_code">Post Code</label>
                                <input readonly type="text" class="form-control" name="post_code" id="post_code">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="ul_no">UL No.</label>
                                <input type="text" class="form-control" name="ul_no" id="ul_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="track_no">Track No.</label>
                                <input readonly type="text" class="form-control" name="track_no" id="track_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pm_no">PM No.</label>
                                <input type="text" class="form-control" name="pm_no" id="pm_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="coroner_reference">Coroner Reference</label>
                                <input type="text" class="form-control" name="coroner_reference" id="coroner_reference">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="specimen_nature">Specimen Nature (Pcr0970)</label>
                                <input readonly type="text" class="form-control" name="specimen_nature" id="specimen_nature">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="org_site_identifier">Organisation Site Identifier (Pcr0980)</label>
                                <input readonly type="text" class="form-control" name="org_site_identifier" id="org_site_identifier">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="org_identifier">Organisation Identifier (Pcr0800)</label>
                                <input readonly type="text" class="form-control" name="org_identifier" id="org_identifier">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lab_name">Lab (Pcr0980)</label>
                                <select class="form-control lab_name" id="lab_name" name="lab_name">
                                    <option value="0">Choose Lab</option>
                                <?php
                                $get_lab_names = $this->Doctor_model->getLabNamesFromLabGroups();

                                if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                    foreach ($get_lab_names as $lab_key => $lab_val) {
                                        $selected = '';
                                        if ($lab_val['id'] == $row->lab_id) {
                                            $selected = 'selected';
                                        }
                                        echo '<option data-labnameid="' . $lab_val['id'] . '" ' . $selected . ' value="' . $lab_val['id'] . '">' . ucwords($lab_val['description']) . '</option>';
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
                            <div class="col-md-3 form-group">
                                <label for="clinician">Clinician (Pcr7100)</label>
                                <input readonly type="text" class="form-control" name="clinician" id="clinician">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="patient_id">Patient ID</label>
                                <input readonly type="text" class="form-control" name="patient_id" id="patient_id">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="fridge_no">Fridge No.</label>
                                <input type="text" class="form-control" name="fridge_no" id="fridge_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="surgeon">Surgeon</label>
                                <input readonly type="text" class="form-control" name="surgeon" id="surgeon">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="death_date_time">Date & Time of Death</label>
                                <input type="text" class="form-control" name="death_date_time" id="death_date_time">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pathologist">Pathologist</label>
                                <input readonly type="text" class="form-control" name="pathologist" id="pathologist">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="apt">APT</label>
                                <input type="text" class="form-control" name="apt" id="apt">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="rec_lab_date">REC Lab (Pcr0770)</label>
                                <input type="text" class="form-control" name="rec_lab_date" id="rec_lab_date">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="rel_lab_date">REL Lab</label>
                                <input type="text" class="form-control" name="rel_lab_date" id="rel_lab_date">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="scanner_type">Scanner Type</label>
                                <input type="text" class="form-control" name="scanner_type" id="scanner_type">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="digi_no">DIGI Number (Pcr0950)</label>
                                <input type="text" class="form-control" name="digi_no" id="digi_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="speciality">Speciality</label>
                                <input type="text" class="form-control" name="speciality" id="speciality">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="specimen_no">Sopecimen No. (Pcr7130)</label>
                                <input type="text" class="form-control" name="specimen_no" id="specimen_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="courier_no">Courier No.</label>
                                <input type="text" class="form-control" name="courier_no" id="courier_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="batch_no">Batch No.</label>
                                <input type="text" class="form-control" name="batch_no" id="batch_no">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="identified_by">Identified By</label>
                                <input type="text" class="form-control" name="identified_by" id="identified_by">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="examination_place">Place of Examination</label>
                                <input type="text" class="form-control" name="examination_place" id="examination_place">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="examination_datetime">Date & Time of Examination</label>
                                <input type="text" class="form-control" name="examination_datetime" id="examination_datetime">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="death_circumstance">Circumstance of Death</label>
                                <input type="text" class="form-control" name="death_circumstance" id="death_circumstance">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="death_circumstance">Circumstance of Death</label>
                                <input type="text" class="form-control" name="death_circumstance" id="death_circumstance">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="ext_brain_status">Brain External Examination</label>
                                <input type="text" class="form-control" name="ext_brain_status" id="ext_brain_status">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="int_brain_status">Brain Internal Examination</label>
                                <input type="text" class="form-control" name="int_brain_status" id="int_brain_status">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lyranx_trachea">Larynx and Trachea</label>
                                <input type="text" class="form-control" name="lyranx_trachea" id="lyranx_trachea">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="bronchi">Bronchi</label>
                                <input type="text" class="form-control" name="bronchi" id="bronchi">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lungs">Lungs</label>
                                <input type="text" class="form-control" name="lungs" id="lungs">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pleura">Pleura</label>
                                <input type="text" class="form-control" name="pleura" id="pleura">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mouth_t_phyr_oesophagus">Mouth, Tongue, Pharynx, Oesophagus</label>
                                <input type="text" class="form-control" name="mouth_t_phyr_oesophagus" id="mouth_t_phyr_oesophagus">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="stomach">Stomach</label>
                                <input type="text" class="form-control" name="stomach" id="stomach">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="sm_lg_intestines">Small and Large Intestines</label>
                                <input type="text" class="form-control" name="sm_lg_intestines" id="sm_lg_intestines">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="liver">Liver</label>
                                <input type="text" class="form-control" name="liver" id="liver">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="gall_bladder">Gall Bladder</label>
                                <input type="text" class="form-control" name="gall_bladder" id="gall_bladder">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pancreas">Pancreas</label>
                                <input type="text" class="form-control" name="pancreas" id="pancreas">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="peritoneum">Peritoneum</label>
                                <input type="text" class="form-control" name="peritoneum" id="peritoneum">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="kidneys">Kidneys</label>
                                <input type="text" class="form-control" name="kidneys" id="kidneys">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="uterus_bladder">Ureters, Bladder</label>
                                <input type="text" class="form-control" name="uterus_bladder" id="uterus_bladder">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="uterus_cerv_overies">Uterus, Cervix, Ovaries</label>
                                <input type="text" class="form-control" name="uterus_cerv_overies" id="uterus_cerv_overies">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="prostate">Prostate</label>
                                <input type="text" class="form-control" name="prostate" id="prostate">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="ext_genitalia">External Genitalia</label>
                                <input type="text" class="form-control" name="ext_genitalia" id="ext_genitalia">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="spleen">Spleen</label>
                                <input type="text" class="form-control" name="spleen" id="spleen">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lymph_nodes">Lymph Nodes</label>
                                <input type="text" class="form-control" name="lymph_nodes" id="lymph_nodes">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="thymus">Thymus</label>
                                <input type="text" class="form-control" name="thymus" id="thymus">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="thyroid_adrenals">Thyroid, Adrenals</label>
                                <input type="text" class="form-control" name="thyroid_adrenals" id="thyroid_adrenals">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pituitary_gland">Pituitary Gland</label>
                                <input type="text" class="form-control" name="pituitary_gland" id="pituitary_gland">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="musculoskeletal_system">Musculoskeletal System</label>
                                <input type="text" class="form-control" name="musculoskeletal_system" id="musculoskeletal_system">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pathological_finding">Pathological Finding</label>
                                <input type="text" class="form-control" name="pathological_finding" id="pathological_finding">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="histopathological_finding">Histopathological Finding</label>
                                <input type="text" class="form-control" name="histopathological_finding" id="histopathological_finding">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="toxicology_report">Toxicology Report</label>
                                <input type="text" class="form-control" name="toxicology_report" id="toxicology_report">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="death_cause">Cause of Death</label>
                                <input type="text" class="form-control" name="death_cause" id="death_cause">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="comments">Comments</label>
                                <input type="text" class="form-control" name="comments" id="comments">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="gmc_no">GMC No.</label>
                                <input type="text" class="form-control" name="gmc_no" id="gmc_no">
                            </div>

                            <div class="col-md-12 form-group mt-5">
                                <button type="button" data-submittype="add" class="btn btn-primary add_lab_names_btn">Update Record</button>
                            </div>
                </div>
                <?php echo form_close(); ?>
            </div>
    </div>
</div>