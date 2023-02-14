<?php
$incident_data = '';
if (!empty($inciden_report_edit)) {
    $incident_data = unserialize($inciden_report_edit['ura_incident_data']);
}
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <a onclick="window.history.back();" style="position: relative;bottom: 5px;left: 1px"><button class="btn btn-primary">&lt;&lt; Go Back</button></a>
        <form class="form save_incident_report_form">
            <fieldset>
            <strong>Details of Person Reporting the Incident</strong>
                <div class="form-group">
                <label class="form-label">Type</label>
                    <input type="text" name="person_type" class="form-control" placeholder="Type" value="<?php echo html_purify($incident_data['person_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Subtype</label>
                    <input type="text" name="person_subtype" class="form-control" placeholder="Subtype" value="<?php echo html_purify($incident_data['person_subtype']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Title</label>
                    <input type="text" name="person_title" class="form-control" placeholder="Title" value="<?php echo html_purify($incident_data['person_title']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">First Name</label>
                    <input type="text" name="person_first_name" class="form-control" placeholder="First Name" value="<?php echo html_purify($incident_data['person_first_name']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Surname</label>
                    <input type="text" name="person_surname" class="form-control" placeholder="Surname" value="<?php echo html_purify($incident_data['person_surname']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Telephone</label>
                    <input type="number" name="person_telephone" class="form-control" placeholder="Telephone" value="<?php echo $incident_data['person_telephone']; ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Incident Details</strong>
                <div class="form-group">
                <label class="form-label">Incident Date</label>
                    <input type="date" name="inc_detail_date" class="form-control" placeholder="Incident Date" value="<?php echo $incident_data['inc_detail_date']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Time</label>
                    <input type="time" name="inc_detail_time" class="form-control" placeholder="Time" value="<?php echo $incident_data['inc_detail_time']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Main Location</label>
                    <input type="text" name="inc_detail_main_loca" class="form-control" placeholder="Main Location" value="<?php echo html_purify($incident_data['inc_detail_main_loca']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Division</label>
                    <input type="text" name="inc_detail_division" class="form-control" placeholder="Division" value="<?php echo html_purify($incident_data['inc_detail_division']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Specialty</label>
                    <input type="text" name="inc_detail_specialty" class="form-control" placeholder="Specialty" value="<?php echo html_purify($incident_data['inc_detail_specialty']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Location (type)</label>
                    <input type="text" name="inc_detail_loca_type" class="form-control" placeholder="Location (type)" value="<?php echo html_purify($incident_data['inc_detail_loca_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Location (exact)</label>
                    <input type="text" name="inc_detail_loca_exact" class="form-control" placeholder="Location (exact)" value="<?php echo html_purify($incident_data['inc_detail_loca_exact']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Description and Immediate Action Taken</strong>
                <div class="form-group">
                <label class="form-label">Description of incident</label>
                    <input type="text" name="desc_immed_desc_inci" class="form-control" placeholder="Description of incident" value="<?php echo html_purify($incident_data['desc_immed_desc_inci']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Immediate action taken</label>
                    <input type="text" name="desc_immed_immediate_action" class="form-control" placeholder="Immediate action taken" value="<?php echo html_purify($incident_data['desc_immed_immediate_action']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Type of Incident and Result</strong>
                <div class="form-group">
                <label class="form-label">Type of Incident</label>
                    <input type="text" name="type_inci_type" class="form-control" placeholder="Type of Incident" value="<?php echo html_purify($incident_data['type_inci_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Detail</label>
                    <input type="text" name="type_inci_detail" class="form-control" placeholder="Detail" value="<?php echo html_purify($incident_data['type_inci_detail']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Adverse event</label>
                    <input type="text" name="type_inci_adverse_event" class="form-control" placeholder="Adverse event" value="<?php echo html_purify($incident_data['type_inci_adverse_event']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Result</label>
                    <input type="text" name="type_inci_result" class="form-control" placeholder="Result" value="<?php echo html_purify($incident_data['type_inci_result']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Additional Information: People Affected</strong>
            <div class="well">
                <div class="form-group">
                <label class="form-label">Person Type</label>
                    <input type="text" name="peop_affec1_type" class="form-control" placeholder="Person Type" value="<?php echo html_purify($incident_data['peop_affec1_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Title</label>
                    <input type="text" name="peop_affec1_title" class="form-control" placeholder="Title" value="<?php echo html_purify($incident_data['peop_affec1_title']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">First names</label>
                    <input type="text" name="peop_affec1_f_name" class="form-control" placeholder="First names" value="<?php echo html_purify($incident_data['peop_affec1_f_name']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Surname</label>
                    <input type="text" name="peop_affec1_surname" class="form-control" placeholder="Surname" value="<?php echo html_purify($incident_data['peop_affec1_surname']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Address</label>
                    <input type="text" name="peop_affec1_address" class="form-control" placeholder="Address" value="<?php echo html_purify($incident_data['peop_affec1_address']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Postcode</label>
                    <input type="text" name="peop_affec1_postcode" class="form-control" placeholder="Postcode" value="<?php echo html_purify($incident_data['peop_affec1_postcode']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Telephone</label>
                    <input type="number" name="peop_affec1_tel" class="form-control" placeholder="Telephone" value="<?php echo $incident_data['peop_affec1_tel']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Email</label>
                    <input type="text" name="peop_affec1_email" class="form-control" placeholder="Email" value="<?php echo $incident_data['peop_affec1_email']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Gender</label>
                    <input type="text" name="peop_affec1_gender" class="form-control" placeholder="Gender" value="<?php echo html_purify($incident_data['peop_affec1_gender']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Ethnicity</label>
                    <input type="text" name="peop_affec1_ethnicity" class="form-control" placeholder="Ethnicity" value="<?php echo html_purify($incident_data['peop_affec1_ethnicity']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Was the person injured in the incident?</label>
                    <input type="text" name="peop_affec1_was_person_injur" class="form-control" placeholder="Was the person injured in the incident?" value="<?php echo html_purify($incident_data['peop_affec1_was_person_injur']); ?>">
                </div>
            </div>
            <div class="well">
                <div class="form-group">
                <label class="form-label">Person Type</label>
                    <input type="text" name="peop_affec2_type" class="form-control" placeholder="Person Type" value="<?php echo html_purify($incident_data['peop_affec2_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Title</label>
                    <input type="text" name="peop_affec2_title" class="form-control" placeholder="Title" value="<?php echo html_purify($incident_data['peop_affec2_title']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">First names</label>
                    <input type="text" name="peop_affec2_f_name" class="form-control" placeholder="First names" value="<?php echo html_purify($incident_data['peop_affec2_f_name']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Surname</label>
                    <input type="text" name="peop_affec2_surname" class="form-control" placeholder="Surname" value="<?php echo html_purify($incident_data['peop_affec2_surname']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Address</label>
                    <input type="text" name="peop_affec2_address" class="form-control" placeholder="Address" value="<?php echo html_purify($incident_data['peop_affec2_address']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Postcode</label>
                    <input type="text" name="peop_affec2_postcode" class="form-control" placeholder="Postcode" value="<?php echo html_purify($incident_data['peop_affec2_postcode']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Telephone</label>
                    <input type="number" name="peop_affec2_tel" class="form-control" placeholder="Telephone" value="<?php echo html_purify($incident_data['peop_affec2_tel']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Email</label>
                    <input type="text" name="peop_affec2_email" class="form-control" placeholder="Email" value="<?php echo $incident_data['peop_affec2_email']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Gender</label>
                    <input type="text" name="peop_affec2_gender" class="form-control" placeholder="Gender" value="<?php echo html_purify($incident_data['peop_affec2_gender']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Ethnicity</label>
                    <input type="text" name="peop_affec2_ethnicity" class="form-control" placeholder="Ethnicity" value="<?php echo html_purify($incident_data['peop_affec2_ethnicity']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Was the person injured in the incident?</label>
                    <input type="text" name="peop_affec2_was_person_injur" class="form-control" placeholder="Was the person injured in the incident?" value="<?php echo html_purify($incident_data['peop_affec2_was_person_injur']); ?>">
                </div>
            </div>
            </fieldset>
            <fieldset>
            <strong>Anyone else involved in the incident</strong>
                <div class="form-group">
                <label class="form-label">Other Contact</label>
                    <input type="text" name="any_inv_inci_other_cont" class="form-control" placeholder="Other Contact" value="<?php echo html_purify($incident_data['any_inv_inci_other_cont']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">How was this person involved?</label>
                    <input type="text" name="any_inv_inci_pers_inv" class="form-control" placeholder="How was this person involved?" value="<?php echo html_purify($incident_data['any_inv_inci_pers_inv']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Type</label>
                    <input type="text" name="any_inv_inci_type" class="form-control" placeholder="Type" value="<?php echo html_purify($incident_data['any_inv_inci_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Title</label>
                    <input type="text" name="any_inv_inci_title" class="form-control" placeholder="Title" value="<?php echo html_purify($incident_data['any_inv_inci_title']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">First names</label>
                    <input type="text" name="any_inv_inci_f_name" class="form-control" placeholder="First names" value="<?php echo html_purify($incident_data['any_inv_inci_f_name']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Surname</label>
                    <input type="text" name="any_inv_inci_surname" class="form-control" placeholder="Surname" value="<?php echo html_purify($incident_data['any_inv_inci_surname']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Address</label>
                    <input type="text" name="any_inv_inci_address" class="form-control" placeholder="Address" value="<?php echo html_purify($incident_data['any_inv_inci_address']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Postcode</label>
                    <input type="text" name="any_inv_inci_postcode" class="form-control" placeholder="Postcode" value="<?php echo html_purify($incident_data['any_inv_inci_postcode']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Telephone</label>
                    <input type="number" name="any_inv_inci_tel" class="form-control" placeholder="Telephone" value="<?php echo $incident_data['any_inv_inci_tel']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Email</label>
                    <input type="text" name="any_inv_inci_email" class="form-control" placeholder="Email" value="<?php echo $incident_data['any_inv_inci_email']; ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Gender</label>
                    <input type="text" name="any_inv_inci_gender" class="form-control" placeholder="Gender" value="<?php echo html_purify($incident_data['any_inv_inci_gender']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Ethnicity</label>
                    <input type="text" name="any_inv_inci_ethnicity" class="form-control" placeholder="Ethnicity" value="<?php echo html_purify($incident_data['any_inv_inci_ethnicity']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Equipment Details</strong>
                <div class="form-group">
                <label class="form-label">Product Type</label>
                    <input type="text" name="equip_detail_type" class="form-control" placeholder="Product Type" value="<?php echo html_purify($incident_data['equip_detail_type']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Brand name</label>
                    <input type="text" name="equip_detail_brand_name" class="form-control" placeholder="Brand name" value="<?php echo html_purify($incident_data['equip_detail_brand_name']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Serial No</label>
                    <input type="text" name="equip_detail_serial_no" class="form-control" placeholder="Serial No" value="<?php echo html_purify($incident_data['equip_detail_serial_no']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Description of device</label>
                    <input type="text" name="equip_detail_desc_device" class="form-control" placeholder="Description of device" value="<?php echo html_purify($incident_data['equip_detail_desc_device']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Description of effect</label>
                    <input type="text" name="equip_detail_desc_effect" class="form-control" placeholder="Description of effect" value="<?php echo html_purify($incident_data['equip_detail_desc_effect']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Current location</label>
                    <input type="text" name="equip_detail_curr_loca" class="form-control" placeholder="Current location" value="<?php echo html_purify($incident_data['equip_detail_curr_loca']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Medication Involved</strong>
                <div class="form-group">
                <label class="form-label">Was this medication incident?</label>
                    <input type="text" name="medic_inv_was_medic_inci" class="form-control" placeholder="Was this medication incident?" value="<?php echo html_purify($incident_data['medic_inv_was_medic_inci']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Was this an incident of violence or aggression towards staff?</label>
                    <input type="text" name="medic_inv_was_inci_viol" class="form-control" placeholder="Was this an incident of violence or aggression towards staff?" value="<?php echo html_purify($incident_data['medic_inv_was_inci_viol']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Security Involved Incident</strong>
                <div class="form-group">
                <label class="form-label">If Security was called or involved in this incident you must put “YES” in this box.</label>
                    <input type="text" name="secur_inv_inci_was_medic_inci" class="form-control" placeholder="If Security was called or involved in this incident you must put “YES” in this box." value="<?php echo html_purify($incident_data['secur_inv_inci_was_medic_inci']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Dementia or Learning Difficulties</strong>
                <div class="form-group">
                <label class="form-label">Does this patient have dementia or learning Disabilities</label>
                    <input type="text" name="dementia_learn_does_patient_dementia" class="form-control" placeholder="Does this patient have dementia or learning Disabilities" value="<?php echo html_purify($incident_data['dementia_learn_does_patient_dementia']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Pressure Sore hospital or Community Acquired</label>
                    <input type="text" name="dementia_learn_pressure_sore" class="form-control" placeholder="Pressure Sore hospital or Community Acquired" value="<?php echo html_purify($incident_data['dementia_learn_pressure_sore']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Witnessed or Unwitnessed Patient Fall</label>
                    <input type="text" name="dementia_learn_witness_patient_fall" class="form-control" placeholder="Witnessed or Unwitnessed Patient Fall" value="<?php echo html_purify($incident_data['dementia_learn_witness_patient_fall']); ?>">
                </div>
            </fieldset>
            <fieldset>
            <strong>Incident Report</strong>
                <div class="form-group">
                <label class="form-label">Harm Level (see appendix 2)</label>
                    <input type="text" name="incident_report_harm_level" class="form-control" placeholder="Harm Level (see appendix 2)" value="<?php echo html_purify($incident_data['incident_report_harm_level']); ?>">
                </div>
                <div class="form-group">
                <label class="form-label">Responsibility</label>
                    <input type="text" name="incident_report_responsibility" class="form-control" placeholder="Responsibility" value="<?php echo html_purify($incident_data['incident_report_responsibility']); ?>">
                </div>
            </fieldset>
            <div class="form-group">
                <input type="hidden" name="incident_report_id" value="<?php echo intval($inciden_report_edit['ura_incident_reports_id']); ?>">
                <button type="button" class="btn btn-success edit_incident_reprot">Update Report</button>
            </div>
        </form>
    </div>
</div>