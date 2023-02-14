<?php
$incident_data = '';
if(!empty($inciden_report_view)){
    $incident_data = unserialize($inciden_report_view['ura_incident_data']);
}
?>	

<div class="row">
    <div class="col-md-12">
    <a onclick="window.history.back();" style="position: relative;bottom: 5px;left: 1px"><button class="btn btn-primary">&lt;&lt; Go Back</button></a>
    <h3 class="text-center">INCIDENT REPORTS</h3>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Details of Person Reporting the Incident</b></td></tr>
        <tr><td width="50%"><b>Type</b></td><td><?php echo html_purify($incident_data['person_type']); ?></td></tr>
        <tr><td><b>Subtype</b></td><td><?php echo html_purify($incident_data['person_subtype']); ?></td></tr>
        <tr><td><b>Title</b></td><td><?php echo html_purify($incident_data['person_title']); ?></td></tr>
        <tr><td><b>First Name</b></td><td><?php echo html_purify($incident_data['person_first_name']); ?></td></tr>
        <tr><td><b>Surname</b></td><td><?php echo html_purify($incident_data['person_surname']); ?></td></tr>
        <tr><td><b>Telephone</b></td><td><?php echo $incident_data['person_telephone']; ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Incident Details</b></td></tr>
        <tr><td width="50%"><b>Incident Date</b></td><td><?php echo $incident_data['inc_detail_date']; ?></td></tr>
        <tr><td><b>Time</b></td><td><?php echo $incident_data['inc_detail_time']; ?></td></tr>
        <tr><td><b>Main Location</b></td><td><?php echo html_purify($incident_data['inc_detail_main_loca']); ?></td></tr>
        <tr><td><b>Division</b></td><td><?php echo html_purify($incident_data['inc_detail_division']); ?></td></tr>
        <tr><td><b>Specialty</b></td><td><?php echo html_purify($incident_data['inc_detail_specialty']); ?></td></tr>
        <tr><td><b>Location (type)	</b></td><td><?php echo html_purify($incident_data['inc_detail_loca_type']); ?></td></tr>
        <tr><td><b>Location (exact)	</b></td><td><?php echo html_purify($incident_data['inc_detail_loca_exact']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Description and Immediate Action Taken</b></td></tr>
        <tr><td width="50%"><b>Description of incident</b></td><td><?php echo html_purify($incident_data['desc_immed_desc_inci']); ?></td></tr>
        <tr><td><b>Immediate action taken</b></td><td><?php echo html_purify($incident_data['desc_immed_immediate_action']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Type of Incident and Result</b></td></tr>
        <tr><td width="50%"><b>Type of Incident</b></td><td><?php echo html_purify($incident_data['type_inci_type']); ?></td></tr>
        <tr><td><b>Detail</b></td><td><?php echo html_purify($incident_data['type_inci_detail']); ?></td></tr>
        <tr><td><b>Adverse event</b></td><td><?php echo html_purify($incident_data['type_inci_adverse_event']); ?></td></tr>
        <tr><td><b>Result</b></td><td><?php echo html_purify($incident_data['type_inci_result']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Additional Information: People Affected</b></td></tr>
        <tr><td width="50%"><b>Person Type</b></td><td><?php echo html_purify($incident_data['peop_affec1_type']); ?></td></tr>
        <tr><td><b>Title</b></td><td><?php echo html_purify($incident_data['peop_affec1_title']); ?></td></tr>
        <tr><td><b>First names</b></td><td><?php echo html_purify($incident_data['peop_affec1_f_name']); ?></td></tr>
        <tr><td><b>Surname</b></td><td><?php echo html_purify($incident_data['peop_affec1_surname']); ?></td></tr>
        <tr><td><b>Address</b></td><td><?php echo html_purify($incident_data['peop_affec1_address']); ?></td></tr>
        <tr><td><b>Postcode</b></td><td><?php echo html_purify($incident_data['peop_affec1_postcode']); ?></td></tr>
        <tr><td><b>Telephone</b></td><td><?php echo $incident_data['peop_affec1_tel']; ?></td></tr>
        <tr><td><b>Email</b></td><td><?php echo $incident_data['peop_affec1_email']; ?></td></tr>
        <tr><td><b>Gender</b></td><td><?php echo html_purify($incident_data['peop_affec1_gender']); ?></td></tr>
        <tr><td><b>Ethnicity</b></td><td><?php echo html_purify($incident_data['peop_affec1_ethnicity']); ?></td></tr>
        <tr><td><b>Was the person injured in the incident?	</b></td><td><?php echo html_purify($incident_data['peop_affec1_was_person_injur']); ?></td></tr>
        <tr><td colspan="2"><b>Additional Information: People Affected</b></td></tr>
        <tr><td width="50%"><b>Person Type</b></td><td><?php echo html_purify($incident_data['peop_affec2_type']); ?></td></tr>
        <tr><td><b>Title</b></td><td><?php echo html_purify($incident_data['peop_affec2_title']); ?></td></tr>
        <tr><td><b>First names</b></td><td><?php echo html_purify($incident_data['peop_affec2_f_name']); ?></td></tr>
        <tr><td><b>Surname</b></td><td><?php echo html_purify($incident_data['peop_affec2_surname']); ?></td></tr>
        <tr><td><b>Address</b></td><td><?php echo html_purify($incident_data['peop_affec2_address']); ?></td></tr>
        <tr><td><b>Postcode</b></td><td><?php echo html_purify($incident_data['peop_affec2_postcode']); ?></td></tr>
        <tr><td><b>Telephone</b></td><td><?php echo html_purify($incident_data['peop_affec2_tel']); ?></td></tr>
        <tr><td><b>Email</b></td><td><?php echo $incident_data['peop_affec2_email']; ?></td></tr>
        <tr><td><b>Gender</b></td><td><?php echo html_purify($incident_data['peop_affec2_gender']); ?></td></tr>
        <tr><td><b>Ethnicity</b></td><td><?php echo html_purify($incident_data['peop_affec2_ethnicity']); ?></td></tr>
        <tr><td><b>Was the person injured in the incident?	</b></td><td><?php echo html_purify($incident_data['peop_affec2_was_person_injur']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Anyone else involved in the incident</b></td></tr>
        <tr><td width="50%"><b>Other Contact</b></td><td><?php echo html_purify($incident_data['any_inv_inci_other_cont']); ?></td></tr>
        <tr><td><b>How was this person involved?</b></td><td><?php echo html_purify($incident_data['any_inv_inci_pers_inv']); ?></td></tr>
        <tr><td><b>Type</b></td><td><?php echo html_purify($incident_data['any_inv_inci_type']); ?></td></tr>
        <tr><td><b>Title</b></td><td><?php echo html_purify($incident_data['any_inv_inci_title']); ?></td></tr>
        <tr><td><b>First names</b></td><td><?php echo html_purify($incident_data['any_inv_inci_f_name']); ?></td></tr>
        <tr><td><b>Surname</b></td><td><?php echo html_purify($incident_data['any_inv_inci_surname']); ?></td></tr>
        <tr><td><b>Address</b></td><td><?php echo html_purify($incident_data['any_inv_inci_address']); ?></td></tr>
        <tr><td><b>Postcode</b></td><td><?php echo html_purify($incident_data['any_inv_inci_postcode']); ?></td></tr>
        <tr><td><b>Telephone</b></td><td><?php echo $incident_data['any_inv_inci_tel']; ?></td></tr>
        <tr><td><b>Email</b></td><td><?php echo $incident_data['any_inv_inci_email']; ?></td></tr>
        <tr><td><b>Gender</b></td><td><?php echo html_purify($incident_data['any_inv_inci_gender']); ?></td></tr>
        <tr><td><b>Ethnicity</b></td><td><?php echo html_purify($incident_data['any_inv_inci_ethnicity']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Equipment Details</b></td></tr>
        <tr><td width="50%"><b>Product Type</b></td><td><?php echo html_purify($incident_data['equip_detail_type']); ?></td></tr>
        <tr><td><b>Brand name</b></td><td><?php echo html_purify($incident_data['equip_detail_brand_name']); ?></td></tr>
        <tr><td><b>Serial No</b></td><td><?php echo html_purify($incident_data['equip_detail_serial_no']); ?></td></tr>
        <tr><td><b>Description of device</b></td><td><?php echo html_purify($incident_data['equip_detail_desc_device']); ?></td></tr>
        <tr><td><b>Description of effect</b></td><td><?php echo html_purify($incident_data['equip_detail_desc_effect']); ?></td></tr>
        <tr><td><b>Current location</b></td><td><?php echo html_purify($incident_data['equip_detail_curr_loca']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Medication Involved</b></td></tr>
        <tr><td width="50%"><b>Was this medication incident?</b></td><td><?php echo html_purify($incident_data['medic_inv_was_medic_inci']); ?></td></tr>
        <tr><td><b>Was this an incident of violence or aggression towards staff?</b></td><td><?php echo html_purify($incident_data['medic_inv_was_inci_viol']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Security Involved Incident</b></td></tr>
        <tr><td width="50%"><b>If Security was called or involved in this incident you must put “YES” in this box.</b></td><td><?php echo html_purify($incident_data['secur_inv_inci_was_medic_inci']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Dementia or Learning Difficulties</b></td></tr>
        <tr><td width="50%"><b>Does this patient have dementia or learning Disabilities</b></td><td><?php echo html_purify($incident_data['dementia_learn_does_patient_dementia']); ?></td></tr>
        <tr><td><b>Pressure Sore hospital or Community Acquired</b></td><td><?php echo html_purify($incident_data['dementia_learn_pressure_sore']); ?></td></tr>
        <tr><td><b>Witnessed or Unwitnessed Patient Fall</b></td><td><?php echo html_purify($incident_data['dementia_learn_witness_patient_fall']); ?></td></tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr><td colspan="2"><b>Incident Report</b></td></tr>
        <tr><td width="50%"><b>Harm Level (see appendix 2)</b></td><td><?php echo html_purify($incident_data['incident_report_harm_level']); ?></td></tr>
        <tr><td><b>Responsibility</b></td><td><?php echo html_purify($incident_data['incident_report_responsibility']); ?></td></tr>
    </table>
    <br>
    </div>
</div>