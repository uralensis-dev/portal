<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
/**
 * @var $id
 * @var $query
 * @var $time
 * @var $nhs_number
 * @var $lab_number
 * @var $serial_number
 * @var $emis_number
 * @var $hos_number
 * @var $sur_name
 * @var $first_name
 * @var $user_information
 * @var $dob
 * @var $gender
 * @var $clrk
 * @var $date_taken
 * @var $urgent
 * @var $hsc
 * @var $cl_detail
 * @var $specimen_macroscopic_code
 * @var $specimen_macroscopic_description
 * @var $specimen_microscopic_code
 * @var $specimen_microscopic_description
 * @var $specimen_snomed_code
 * @var $specimen_snomed_description
 * @var $specimen_diagnosis_code
 * @var $specimen_diagnosis_description
 * @var $specimen_comment_code
 * @var $specimen_comment_description
 * @var $specimen_information_code
 * @var $specimen_information_description
 * @var $specimen_type
 * @var $specimen_slides
 * @var $specimen_block_type
 * @var $specimen_site
 * @var $specimen_block
 * @var $specimen_right
 * @var $specimen_left
 * @var $specimen_na
 * @var $specimen_urgent
 * @var $specimen_hsc_205
 */
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
    if(!empty($row1->age)){
        $age = '<tr><td>Age : </td><td>' . $row1->age . '</td></tr>';
    }

    if(!empty($row1->gender)){
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

/**
 * MYPDF extends TCPDF
 *
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

class MYPDF extends TCPDF
{

    public function Header()
    {

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
        if (!empty($dermatological_surgeon)) {
            $derm_surgeon = '<tr><td>Dermatological Surgeon : </td><td>' . $dermatological_surgeon . '</td></tr>';
        }

        if (!empty($h_group_id)) {
            switch($h_group_id) {
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
        <td width="32%" align="center" style="font-size:20px;"><b>Autopsy Report</b></td>
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

    public function Footer()
    {
        global $hospital_information;
        $footer_text = $hospital_information;
        $this->SetY(-30);
        $this->SetFont('times', 16);

        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 0, 25, $footer_text, 0, 0, 0, true, true);
    }

}

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

    $html = '
<div style="border-bottom:1px solid black;"></div>
<br />
<table>
    <tr style="font-weight: bold">
        <th width="33%"> Identified By</th>
        <th width="33%">Place of Examination</th>
        <th width="33%">Date & Time of Examination</th>
    </tr>
    <tr>
        <td width="33%">'.$name_identified_by.'</td>
        <td width="33%">'.$query1[0]->ap_examination_place.'</td>
        <td width="33%">'.date('d-m-Y H:i:s', strtotime($query1[0]->ap_examination_datetime)).'</td>
    </tr>
    <br />
</table>
';

$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold">History</div>
<table>
    <tr style="font-weight: bold">
        <th width="100%">Circumstance of Death</th>
    </tr>
    <tr>
        <td width="100%">'.$query1[0]->ap_death_circumstance.'</td>
    </tr>
    <br>
</table>
';

$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">External Examination</div>
<table>
    <tr style="font-weight: bold">
        <th width="33%">Height</th>
        <th width="33%">Weight</th>
        <th width="33%">BMI</th>
    </tr>
    <tr>
        <td width="33%">'.$query1[0]->ap_height_cm.'</td>
        <td width="33%">'.$query1[0]->ap_weight_kg.'</td>
        <td width="33%">'.$query1[0]->ap_bmi_calculated.'</td>
    </tr>
    <tr>
        <td width="20%" style="font-weight: bold">Description</td> 
        <td width="80%">'.$query1[0]->ap_ext_description.'</td> 
    </tr>
    <br>
</table>
';
$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Internal Examination</div>

<table>
    <tr style="font-weight: bold">
        <td colspan="2">Central Nervous System</td>
        <td colspan="2">Respiratory System</td>
    </tr>
    <tr>
        <td width="40%">Brain</td>
        <td width="10%">'.$query1[0]->ap_ext_brain_status.'</td>
        <td width="40%">Larynx and Trachea</td>
        <td width="10%">'.$query1[0]->ap_lyranx_trachea.'</td>
    </tr>
    <tr>
        <td>Brain Weight (g)</td>
        <td>'.$query1[0]->ap_brain_weight_gm.'</td>
        
        <td>Bronchi</td>
        <td>'.$query1[0]->ap_bronchi.'</td>
    </tr>
    <tr>
        <td>Circle of Willis</td>
        <td>'.$query1[0]->ap_ext_circle_wilis.'</td>
        
        <td>Lungs</td>
        <td>'.$query1[0]->ap_lungs.'</td>
    </tr>
    <tr>
        <td>Meningies and Dura</td>
        <td>'.$query1[0]->ap_ext_meningies_dura.'</td>
        
        <td>Right Lung Weight (g)</td>
        <td>'.$query1[0]->ap_rt_lung_weight_gm.'</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
       
        <td>Left Lung Weight (g)</td>
        <td>'.$query1[0]->ap_lt_lung_weight_gm.'</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
       
        <td>Pleura</td>
        <td>'.$query1[0]->ap_pleura.'</td>
    </tr>
    <br>
</table>
<table>
    <tr style="font-weight: bold">
        <td colspan="2">Alimentary System</td>
        <td colspan="2">Genito-Urinary System</td>
    </tr>
    <tr>
        <td width="40%">Mouth, tongue, pharynx, oesophagus</td>
        <td width="10%">'.$query1[0]->ap_mouth_t_phyr_oesophagus.'</td>
        <td width="40%">Kidneys</td>
        <td width="10%">'.$query1[0]->ap_kidneys.'</td>
    </tr>
    <tr>
        <td>Stomach</td>
        <td>'.$query1[0]->ap_stomach.'</td>
        
        <td>Right Kidney Weight (g)</td>
        <td>'.$query1[0]->ap_rt_kidney_weight_gm.'</td>
    </tr>
    <tr>
        <td>Small and large intestines</td>
        <td>'.$query1[0]->ap_sm_lg_intestine.'</td>
        
        <td>Left Kidney Weight (g)</td>
        <td>'.$query1[0]->ap_lt_kidney_weight_gm.'</td>
    </tr>
    <tr>
        <td>Liver</td>
        <td>'.$query1[0]->ap_liver.'</td>
        
        <td>Ureters, bladder</td>
        <td>'.$query1[0]->ap_uretus_bladder.'</td>
    </tr>
    <tr>
        <td>Liver Weight (g)</td>
        <td>'.$query1[0]->ap_liver_weight_gm.'</td>
       
        <td>Uterus, cervix, ovaries</td>
        <td>'.$query1[0]->ap_uterus_cerv_overies.'</td>
    </tr>
    <tr>
        <td>Gall bladder</td>
        <td>'.$query1[0]->ap_gall_bladder.'</td>
       
        <td>Prostate</td>
        <td>'.$query1[0]->ap_prostate.'</td>
    </tr>
    <tr>
        <td>Pancreas</td>
        <td>'.$query1[0]->ap_pancreas.'</td>
       
        <td>External genitalia</td>
        <td>'.$query1[0]->ap_external_genitalia.'</td>
    </tr>
    <tr>
        <td>Peritoneum</td>
        <td>'.$query1[0]->ap_peritoneum.'</td>
       
        <td></td>
        <td></td>
    </tr>
    <br>
</table>
<table>
    <tr style="font-weight: bold">
        <td colspan="2">Reticulo-endothelial System</td>
        <td colspan="2">Endocrine System</td>
    </tr>
    <tr>
        <td width="40%">Spleen</td>
        <td width="10%">'.$query1[0]->ap_spleen.'</td>
        <td width="40%">Thyroid, adrenals</td>
        <td width="10%">'.$query1[0]->ap_thyroid_adrenals.'</td>
    </tr>
    <tr>
        <td>Spleen Weight (g)</td>
        <td>'.$query1[0]->ap_spleen_weight_gm.'</td>
        <td>Thyroid Weight (g)</td>
        <td>'.$query1[0]->ap_thyroid_wt_gm.'</td>
    </tr>
    <tr>
        <td>Lymph nodes</td>
        <td>'.$query1[0]->ap_lymph_nodes.'</td>
        <td>Pituitary gland</td>
        <td>'.$query1[0]->ap_pituitary_gland.'</td>
    </tr>
    <tr>
        <td>Thymus</td>
        <td>'.$query1[0]->ap_thymus.'</td>
        <td></td>
        <td></td>
    </tr>
    <br>
</table>
';


$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Musculoskeletal System</div>
<table>
    <tr>
        <td width="100%">'.$query1[0]->ap_musculoskeletal.'</td>
    </tr>
    <br>
</table>
';
$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Pathological Finding</div>
<table>
    <tr>
        <td width="100%">'.$query1[0]->ap_pathological_finding.'</td>
    </tr>
    <br>
</table>
';
$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Histopathological Finding</div>
<table>
    <tr>
        <td width="100%">'.$query1[0]->ap_histopathological_finding.'</td>
    </tr>
    <br>
</table>
';
$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Toxicology Report</div>
<table>
    <tr>
        <td width="100%">'.$query1[0]->ap_toxicology_report.'</td>
    </tr>
    <br>
</table>
';
$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Cause of Death</div>
<table>
    <tr>
        <td width="100%">In my Opinion:</td>
    </tr>
    <tr>'.$query1[0]->ap_cause_of_death.'</tr>
    <br>
</table>
';
$html .= '
<br>
<div style="border-top:1px solid black; font-weight: bold;">Comments</div>
<table>
    <tr>
        <td width="100%">'.$query1[0]->ap_comments.'</td>
    </tr>
    <br>
</table>
';


$html .='
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
