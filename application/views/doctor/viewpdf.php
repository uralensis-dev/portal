<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
foreach ($query1 as $row1) :

    global $serial_number;
    global $pci_number;
    global $first_name;
    global $sur_name;
    global $emis_number;
    global $lab_number;
    global $nhs_number;
    global $dob;
    global $age;
    global $gender;
    global $clrk;
    global $dermatological_surgeon;
    global $date_taken;
    global $converted_time;
    global $last_modify_publish;
    global $date_rec_bylab;
    global $date_rec_by_doctor;
    global $lab_release_date;
    global $h_group_id;

    $id = $row1->id;
    $time = $row1->publish_datetime;

    $converted_time = '';
    if ($time != '') {
        $converted_time = date('d-m-Y', strtotime($time));
    }
    $last_modify_publish = '';
    if (!empty($row1->publish_datetime_modified)) {
        $last_modify_publish = date('d-m-Y', $row1->publish_datetime_modified);
        $last_modify_publish = '<tr><td>Latest Published Date : </td><td>' . $last_modify_publish . '</td></tr>';
    }
    if (!empty($row1->date_sent_touralensis)) {
        $lab_release_date = date('d-m-Y', strtotime($row1->date_sent_touralensis));
        $lab_release_date = '<tr><td>Lab Released Date : </td><td>' . $lab_release_date . '</td></tr>';
    }
    if (!empty($row1->date_rec_by_doctor)) {
        $date_rec_by_doctor = date('d-m-Y', strtotime($row1->date_rec_by_doctor));
        $date_rec_by_doctor = '<tr><td>Date Received by Dr : </td><td>' . $date_rec_by_doctor . '</td></tr>';
    }

    $age = '<tr><td>Age : </td><td></td></tr>';
    $gender = '<tr><td>Gender : </td><td></td></tr>';
    if (!empty($row1->age)) {
        $age = '<tr><td>Age : </td><td>' . $row1->age . '</td></tr>';
    }

    if (!empty($row1->gender)) {
        $gender = '<tr><td>Gender : </td><td>' . $row1->gender . '</td></tr>';
    }
    $serial_number = $row1->serial_number;
    $pci_number = $row1->pci_number;
    $emis_number = $row1->emis_number;
    $nhs_number = $row1->nhs_number;
    $lab_number = $row1->lab_number;
    $hos_number = $row1->hos_number;
    $sur_name = $row1->sur_name;
    $first_name = $row1->f_name;

    $dermatological_surgeon = $row1->dermatological_surgeon;
    if (!empty($row1->dermatological_surgeon) && ctype_digit($row1->dermatological_surgeon)) {
        $dermatological_surgeon = uralensisGetUsername($row1->dermatological_surgeon, 'fullname');
    }

    $var = $row1->dob;
    $dob = '';
    if (!empty($var)) {
        $date = str_replace('/', '-', $var);
        $change_dob = date('d-m-Y', strtotime($date));
        $dob = !empty($change_dob) ? $change_dob : '';
    }
    $clrk = $row1->clrk;
    if (!empty($row1->clrk) && ctype_digit($row1->clrk)) {
        $clrk = uralensisGetUsername($row1->clrk, 'fullname');
    }
    $date_taken = !empty($row1->date_taken) ? date('d-m-Y', strtotime($row1->date_taken)) : '';
    $urgent = $row1->urgent;
    $hsc = $row1->hsc;
    $cl_detail = $row1->cl_detail;
    $date_rec_bylab = !empty($row1->date_received_bylab) ? date('d-m-Y', strtotime($row1->date_received_bylab)) : '';
    $Result_clinical = str_replace("\n", '<br />', $cl_detail);
    $comment_section = $row1->comment_section;
    $comment_section_date = $row1->comment_section_date;
    $h_group_id = $row1->hospital_group_id;
endforeach;

foreach ($query4 as $row4) {
    $additional_work = $row4->description;
    $Result_additional = str_replace("\n", '<br />', $additional_work);
    $additional_work_time = $row4->additional_work_time;
}
foreach ($query2 as $row2) :
    $specimen_type = $row2->specimen_type;
    $specimen_site = $row2->specimen_site;
    $specimen_right = $row2->specimen_right;
    $specimen_left = $row2->specimen_left;
    $specimen_na = $row2->specimen_na;
    $user_first_name = $row2->first_name;
    $user_last_name = $row2->last_name;
    $user_email = $row2->email;
    $user_phone = $row2->phone;
    $gmc_code = $row2->gmc_code;
endforeach;

foreach ($query5 as $row5) :
    global $hospital_information;
    $hospital_information = $row5->information;
endforeach;

require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    public function Header() {

        global $serial_number;
        global $pci_number;
        global $first_name;
        global $sur_name;
        global $emis_number;
        global $lab_number;
        global $nhs_number;
        global $h_group_id;
        global $dob;
        global $age;
        global $gender;
        global $clrk;
        global $dermatological_surgeon;
        global $date_taken;
        global $converted_time;
        global $last_modify_publish;
        global $date_rec_bylab;
        global $date_rec_by_doctor;
        global $lab_release_date;
        global $h_group_id;
        $derm_surgeon = '';
        $CI = &get_instance();
        $userinfo = getLoggedInUserProfile(intval($CI->ion_auth->user()->row()->id));
        $dr_name = $userinfo[0]->first_name . ' ' . $userinfo[0]->last_name;
        if (!empty($dermatological_surgeon)) {
            $derm_surgeon = '<tr><td>Dermatological Surgeon : </td><td>' . $dermatological_surgeon . '</td></tr>';
        }

        if (!empty($h_group_id)) {
            switch ($h_group_id) {
                case 9:
                    $ura_logo = base_url('/application/helpers/tcpdf/plymouth-hospitals.jpeg');
                    break;
                case 18:
                    $ura_logo = base_url('/application/helpers/tcpdf/torbay-and-south-devon.jpeg');
                    break;
                case 54:
                    $ura_logo = base_url('/application/helpers/tcpdf/royal-cornwall-hospitals.jpeg');
                    break;
                case 55:
                    $ura_logo = base_url('/application/helpers/tcpdf/royal-devon-and-exeter.jpeg');
                    break;
                default:
                    $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
            }
        } else {
            $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
        }

        $header_text = <<<EOD
                
<table width="100%">
    <tr>
        <td width="25%" align="left">
            <img width="180px" src="$ura_logo" />
        </td>
        <td width="32%" align="center" style="font-size:20px;"><b>Histopathology Report</b></td>
        <td width="50%" align="right">
            <table style="font-size:12.5px;text-align:left;">
                <tr><td width="45%">Serial Number : </td><td><b>$serial_number</b></td></tr>
                <tr><td>PCI Number : </td><td><b>$pci_number</b></td></tr>
                <tr><td>Patient Name : </td><td><b>$first_name $sur_name</b></td></tr>
		<tr><td>EMIS Number : </td><td><b>$emis_number</b></td></tr>
		<tr><td>LAB Ref : </td><td>$lab_number</td></tr>
		<tr><td>NHS Ref : </td><td>$nhs_number</td></tr>
                <tr><td>Date of Birth : </td><td>$dob</td></tr>
                $age
                $gender
                <tr><td>Clinician : </td><td>$clrk</td></tr>
                $derm_surgeon
                <tr><td>Clinic Date : </td><td>$date_taken</td></tr>
                <tr><td>Date Received By Lab : </td><td>$date_rec_bylab</td></tr>
                <tr><td>Date Published : </td><td>$converted_time</td></tr>
                $last_modify_publish
                $lab_release_date
                $date_rec_by_doctor
            </table>
        </td>
    </tr>
</table>
EOD;
        $this->SetY(0);
        $this->SetFont('times', 10);
        $this->writeHTMLCell(0, 0, 5, 5, $header_text, 0, 0, 0, false, false);
    }

    public function Footer() {
        global $hospital_information;
        $footer_text = $hospital_information;
        $this->SetY(-30);
        $this->SetFont('times', 16);

        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 0, 25, $footer_text, 0, 0, 0, true, true);
    }

}

// DATASETS STARTS

$get_bcc_record = get_bcc_dataset_record($this->uri->segment(3), '');
$bcc_output_pdf = '';
$get_scc_record = get_ssc_dataset_record($this->uri->segment(3), '');
$scc_output_pdf = '';
$get_cmm_record = get_cmm_dataset_record($this->uri->segment(3), '');
$cmm_output_pdf = '';

// BCC
if (!empty($get_bcc_record)) {

    $bcc_output_pdf .= "<b><h2 style='text-align:center'>Reporting proforma for cutaneous basal cell carcinoma removed
with therapeutic intent</h2></b><br>";
    for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
        $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);
        $bcc_output_pdf .= '<b><h3>Specimen ' . $get_bcc_record[$clinical_arr]['patient_specimen'] . '</h3></b>';
        $bcc_output_pdf .= "<br>Speciment Type :" . $data_set['Specimen_type'];
        $bcc_output_pdf .= "<br>Tumour type: ";
        $bcc_output_pdf .= "<br>Subtype: ";
        $bcc_output_pdf .= "<br>Basosquamous component : ";
        $bcc_output_pdf .= "<br>Extent : ";
        $bcc_output_pdf .= "<br>Perinueural invasion :" . $data_set['n_invasion'];
        $bcc_output_pdf .= "<br>Lymphovascular invasion : " . $data_set['n_carcinoma'];
        $bcc_output_pdf .= "<br>Maximum tumour diameter : " . $data_set['Maximum_Indicate'];
        $bcc_output_pdf .= "<br>Maximum tumour depth: " . $data_set['Maximum_Dimention'] . ' mm';
        $bcc_output_pdf .= "<br>Clark level : ";
        $bcc_output_pdf .= "<br>Margins : " . $data_set['n_Peripheral'] . ' mm; deep ' . $data_set['n_Deep'] . ' mm';
        $bcc_output_pdf .= "<br>Additional comments : " . $data_set['bcc_comments'];
        $bcc_output_pdf .= "<br>Pathological risk status for skin cancer MDT : " . $data_set['Histological_low'] != '' ? 'low' : 'high';
        $bcc_output_pdf .= "<br>TBN pathological (p) stage (AJCC8) : " . $data_set['ptnm'] . $data_set['ptnm'] . $data_set['ptnm'];
        $bcc_output_pdf .= "<br>Summary : <br> ";
    }
}

// SCC
if (!empty($get_scc_record)) {

    $scc_output_pdf .= "<b><h2 style='text-align:center'>Squamous Cell Carcinoma</h2></b><br>";
    for ($clinical_arr = 0; $clinical_arr < sizeof($get_scc_record); $clinical_arr++) {
        $data_set = json_decode($get_scc_record[$clinical_arr]['scc_data'], true);
        $scc_output_pdf .= '<b><h3>Specimen ' . $get_scc_record[$clinical_arr]['patient_specimen'] . '</h3></b>';
        $scc_output_pdf .= "<br> Site : " . $data_set['site'] ;
        $scc_output_pdf .= "<br> Specimen Type: ". $data_set['specimen_type'] ;
        $scc_output_pdf .= "<br> Subtype: " . $data_set['subtype'] ;
        $scc_output_pdf .= "<br> Differentiation : " . $data_set['differentiation'] ;
        $scc_output_pdf .= "<br> Perineurial Invasion : " . $data_set['perineurialInvasion'] ;
        $scc_output_pdf .= "<br> Lymphovascular invasion : " . $data_set['lymphovascularInvasion'] ;
        $scc_output_pdf .= "<br> Maximum tumour diameter : " . $data_set['max_diameter'] . ' mm' ;
        $scc_output_pdf .= "<br> Maximum tumour depth: " . $data_set['depth'] . ' mm' ;
        $scc_output_pdf .= "<br> Clark level : " . $data_set['clark_level'] ;
        $scc_output_pdf .= "<br> Margins : " . 'epidermal: ' . $data_set['epidermal'] . ' mm deep: ' . $data_set['deep'] . ' mm' ;
        $scc_output_pdf .= "<br> Additional comments : " . $data_set['additionalComments'] ;
        $scc_output_pdf .= "<br> Pathological risk status for skin cancer MDT : " . $data_set['risk'] ;
        $scc_output_pdf .= "<br> TBN pathological (p) stage (AJCC8) : " . $data_set['tnm'] ;
        $scc_output_pdf .= "<br> Summary : " . $data_set['summary'] ;
    }
}

// CMM
if (!empty($get_cmm_record)) {

    $cmm_output_pdf .= "<b><h2 style='text-align:center'>Cutaneous Malignant Melanoma Carcinoma</h2></b><br>";
    for ($clinical_arr = 0; $clinical_arr < sizeof($get_cmm_record); $clinical_arr++) {
        $data_set = json_decode($get_cmm_record[$clinical_arr]['scc_data'], true);
        $cmm_output_pdf .= '<b><h3>Specimen ' . $get_cmm_record[$clinical_arr]['patient_specimen'] . '</h3></b>';
$cmm_output_pdf .= "<br> Site  : " .$data_set['site'] ;  
$cmm_output_pdf .= "<br> Specimen type   : " .$data_set['specimen_type'] ;  
$cmm_output_pdf .= "<br> Macroscopic ulceration   : " .$data_set['macroscopic_ulceration'] ;  
$cmm_output_pdf .= "<br> Photo taken  : " .$data_set['Photo_taken'] ;  
$cmm_output_pdf .= "<br> Histological type  : " .$data_set['Histological_type'] ;  
$cmm_output_pdf .= "<br> Growth phase (inavsion)  : " .$data_set['Growth_phase'] ;   
$cmm_output_pdf .= '<br> Invasive only  : Breslow depth : '.$data_set['breslow_depth'].' mm; <br>Breslow depth of scar :  '.$data_set['breslow_depth_scar'].' mm <br>Clark level : '.$data_set['clark_level'].'Ulceration : '.$data_set['Ulceration'].'Mitoses : '.$data_set['Mitoses'].' /mm<sup>2</sup>' ;   
$cmm_output_pdf .= "<br> Solar damage  : " .$data_set['Solar_damage'] ;  
$cmm_output_pdf .= '<br> Host response  : <br> tumour inflitrating lymphocytes : '.$data_set['tumour_infiltrating_'].'<br> regression : '.$data_set['regression'] ;  
$cmm_output_pdf .= '<br> Locoregional spread   : <br> neurotropism : '.$data_set['neurotropism'].'<br> lymphatic vessel invasion : '.$data_set['lymphatic_vessel_invasion'].'<br> blood vessel invasion : '.$data_set['blood_vessel_invasion'].'<br> microsatellite : '.$data_set['miscrosetellite'].'<br> satellite : '.$data_set['setellite'].'<br> in transit metastasis  : '.$data_set['in_transit_metastasis'] ;  
$cmm_output_pdf .= '<br> Excision margins   : <br> epdermal in situ components : '.$data_set['epi_insitu'].' mm<br> epdermal in invasive components : '.$data_set['epi_invasive'].' mm<br> deep : '.$data_set['deep'].' mm' ;  
$cmm_output_pdf .= "<br> Co-existing lesion   : " .$data_set['lesion'] ;  
$cmm_output_pdf .= "<br> Special techniques   : " .$data_set['special_techniques'] ;  
$cmm_output_pdf .= "<br> Biomarkers  : " .$data_set['biomarkers'] ;  
$cmm_output_pdf .= "<br> Additional comments  : " .$data_set['additional_comments'] ;  
$cmm_output_pdf .= "<br> TNM stagin (AJCC7)   : " .$data_set['tnm'] ;  
$cmm_output_pdf .= "<br> SNOMED code  : " .$data_set['snomed'] ;  
$cmm_output_pdf .= "<br> In-situ  : " .$data_set['insitu'] ;  
$cmm_output_pdf .= "<br> Inavsive : " .$data_set['_invasive'] ;  
    }
}


// DATASETS ENDS


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OxbridgeMedica');
$pdf->SetTitle('Uralensis') . ' - ' . $serial_number;
$pdf->SetSubject('Uralensis Resport');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(5, PDF_MARGIN_TOP + 55, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('times', 12);

$pdf->AddPage();
$pdf->SetY(80);
if (!empty($cl_detail)) {
    $html = '
<div style="border-bottom:1px solid black;"></div>
<br />
<table>
    <tr>
        <td width="15%"><b>Clinical Detail : </b></td>
        <td width="85%">' . $Result_clinical . '</td>
    </tr>
    <br />
</table>
';
} else {
    $specimen_count = 1;
    foreach ($query2 as $specimen_data) {
        $specimen_result_clinical = str_replace("\n", '<br />', $specimen_data->specimen_clinical_history);

        $html .= '
<div style="border-bottom:1px solid black;"></div>
<br />
<table>
    <tr>
        <td width="15%"><b>Clinical Detail (Specimen ' . $specimen_count . '): </b></td>
        <td width="85%">' . $specimen_result_clinical . '</td>
    </tr>
    <br />
</table>
';
        $specimen_count++;
    }
}
$count = 1;
foreach ($query2 as $row2) :
    $Result_macro = str_replace("\n", '<br />', $row2->specimen_macroscopic_description);
    $Result_micro = str_replace("\n", '<br />', $row2->specimen_microscopic_description);
    $diagnosis = !empty($row2->specimen_diagnosis_description) ? $row2->specimen_diagnosis_description : '';
    $Result_diagnosis = str_replace("\n", '<br />', $diagnosis);
    $html .= '<div style="border-bottom:1px solid black;"></div><br />
    <table>
        <tr>
            <td width="30%" style="font-size:18px;"><b>Specimen ' . $count . '</b></td>
            <td></td>
        </tr>
        <br />
        <tr>
            <td width="13%"><b>Specimen : </b></td>
            <td width="2%"></td>
            <td width="85%">' . ucfirst($row2->specimen_type) . '&nbsp;' . $row2->specimen_right . '&nbsp;' . $row2->specimen_left . '&nbsp;' . $row2->specimen_na . '&nbsp;' . $row2->specimen_site . '
            </td>
        </tr>
        <br />
        <tr>
            <td width="13%"><b>Macroscopic Description : </b></td>
            <td width="2%"></td>
            <td width="85%">' . $Result_macro . '</td>
        </tr>
        <br />
        <tr>
            <td width="13%"><b>Microscopic Description : </b></td>
            <td width="2%"></td>
            <td width="85%">' . $Result_micro . '</td>
        </tr>
        <br />
    </table>';

    if (!empty($diagnosis)) {
        $html .= '<table>
            <br /><br />
        <tr>
            <td width="13%"><b>Diagnosis :</b></td>
            <td width="2%"></td>
            <td width="85%">' . $diagnosis . '</td>
        </tr>
    </table>';
    }

    if (empty($comment_section)) {
        if (!empty($row2->specimen_comment_section)) {
            $format_specimen_comments = str_replace("\n", '<br />', $row2->specimen_comment_section);
            $specimen_comments_time = '';
            if ($row2->specimen_comment_section_timestamp != '') {
                $specimen_comments_time = date('M j Y', $row2->specimen_comment_section_timestamp);
            }
            $html .= '
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td><b>Additional Comments (Specimen ' . $count . ')  &nbsp; | &nbsp; Comment Date: ' . $specimen_comments_time . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $format_specimen_comments . '</td>
    </tr>
</table>

';
        }
    }
    $count++;
endforeach;

$supp_count = 1;
foreach ($query4 as $row4) {
    $additional_work = $row4->description;
    $Result_additional = str_replace("\n", '<br />', $additional_work);
    $additional_work_time = $row4->additional_work_time;
    if (isset($Result_additional) && $Result_additional != '') :

        $html .= '
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td><b>Supplementary Report ' . $supp_count . ' &nbsp; | &nbsp; Requested Time : ' . date('M j Y g:i A', strtotime($additional_work_time)) . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $Result_additional . '</td>
    </tr>
</table>
';

    endif;
    $supp_count++;
}

if (isset($comment_section) && $comment_section != '') {
    $format_comments = str_replace("\n", '<br />', $comment_section);
    $comment_date = '';
    if ($comment_section_date != '') {
        $comment_date = date('M j Y', strtotime($comment_section_date));
    }

    $html .= '
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td><b>Additional Comments  &nbsp; | &nbsp; Comment Date : ' . $comment_date . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $format_comments . '</td>
    </tr>
</table>

';
}
if ($query1[0]->mdt_case_status === 'not_for_mdt' && $query1[0]->mdt_case === 'add_to_report') {
    $html .= '
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td style="font-size:14px;"><b>This case is NOT required for the Local Skin MDT</b></td>
    </tr>
</table>
';
}
if ($query1[0]->mdt_case_status === 'for_mdt' && !empty($query1[0]->mdt_case)) {
    $html .= '
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td style="font-size:14px;"><b>This case should be listed for the Local Skin MDT</b></td>
    </tr>
</table>
';
}

if ($query1[0]->mdt_case_status === 'for_mdt') {
    if (!empty($query1[0]->mdt_specimen_status)) {
        $specimen_data = unserialize($query1[0]->mdt_specimen_status);
        $html .= '
<table>
<tr>
        <td style="font-size:14px; width:120px;"><b>MDT Specimens.</b></td>
';
        foreach ($specimen_data as $specimen_mdt) {
            $html .= '
        <td style="font-size:14px; width:100px;"><b>' . $specimen_mdt . '</b></td>
    ';
        }
        $html .= '</tr></table>
';
    }
}



//$html .= '<tcpdf pagebreak="true"/>';
$html .= $bcc_output_pdf;

//$html .= '<tcpdf pagebreak="true"/>';
$html .= $scc_output_pdf;

//$html .= '<tcpdf pagebreak="true"/>';
$html .= $cmm_output_pdf;

$html .= '
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td style="font-size:14px;"><b>Reported by: Dr. ' . $user_first_name . ' ' . $user_last_name . '. </b><b>GMC: ' . $gmc_code . '. </b><b>Email: ' . $user_email . '. </b><b>Mobile: ' . $user_phone . '</b></td>
    </tr>
</table>

';

$pdf->writeHTML($html, true, false, true, false, '');
$file_name = $serial_number . '_Report_' . $first_name . '_' . $sur_name . '_' . date('dMY') . '.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
