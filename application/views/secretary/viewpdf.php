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
    global $first_name;
    global $sur_name;
    global $emis_number;
    global $lab_number;
    global $nhs_number;
    global $dob;
    global $clrk;
    global $date_taken;
    global $converted_time;
    global $date_rec_bylab;

    $id = $row1->id;
    $time = $row1->publish_datetime;
    
    $converted_time = '';
    if($time != ''){
        $converted_time = date('M j Y', strtotime($time));
    }
    $serial_number = $row1->serial_number;
    $emis_number = $row1->emis_number;
    $nhs_number = $row1->nhs_number;
    $lab_number = $row1->lab_number;
    $hos_number = $row1->hos_number;
    $sur_name = $row1->sur_name;
    $first_name = $row1->f_name;
    $var = $row1->dob;
    $date = str_replace('/', '-', $var);
    $change_dob =  date('d-m-Y', strtotime($date));
    $dob = !empty($change_dob) ? $change_dob : '';
    $gender = $row1->gender;
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
endforeach;

foreach ($query5 as $row5) :
    global $hospital_information;
    $hospital_information = $row5->information;
endforeach;

$logo = base_url('/application/helpers/tcpdf/uralensis_latest.png');

require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

/**
 * MYPDF Extends TCPDF
 *
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

class MYPDF extends TCPDF 
{

    public function Header() 
    {
        global $serial_number;
        global $first_name;
        global $sur_name;
        global $emis_number;
        global $lab_number;
        global $nhs_number;
        global $dob;
        global $clrk;
        global $date_taken;
        global $converted_time;
        global $date_rec_bylab;

        $logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
        $header_text = <<<EOD
                
<table width="100%">
    <tr>
        <td width="25%" align="left">
            <img width="180px" src="$logo" />
        </td>
        <td width="32%" align="center" style="font-size:20px;"><b>Histopathology Report</b></td>
        <td width="50%" align="right">
            <table style="font-size:13.6px;text-align:left;">
                <tr><td width="45%">Serial Number : </td><td><b>$serial_number</b></td></tr>
                <tr><td>Patient Name : </td><td><b>$first_name $sur_name</b></td></tr>
		<tr><td>EMIS Number : </td><td><b>$emis_number</b></td></tr>
		<tr><td>LAB Ref : </td><td>$lab_number</td></tr>
		<tr><td>NHS Ref : </td><td>$nhs_number</td></tr>
                <tr><td>Date of Birth : </td><td>$dob</td></tr>
                <tr><td>Clinician : </td><td>$clrk</td></tr>
                <tr><td>Clinic Date : </td><td>$date_taken</td></tr>
                <tr><td>Date Received By Lab : </td><td>$date_rec_bylab</td></tr>
                <tr><td>Date Published : </td><td>$converted_time</td></tr>
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
$pdf->SetMargins(5, PDF_MARGIN_TOP + 40, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('times', 12);
$pdf->AddPage();

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
$count = 1;
foreach ($query2 as $row2) :
    $Result_macro = str_replace("\n", '<br />', $row2->specimen_macroscopic_description);
    $Result_micro = str_replace("\n", '<br />', $row2->specimen_microscopic_description);
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
            <td width="85%">' . $row2->specimen_type . '&nbsp;' . $row2->specimen_right . '&nbsp;' . $row2->specimen_left . '&nbsp;' . $row2->specimen_na . '&nbsp;' . $row2->specimen_site . '
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
    </table>';
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
    $html .='
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td><b>Additional Comments  &nbsp; | &nbsp; Comment Time : ' . date('d-m-Y g:i A', strtotime($comment_section_date)) . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $comment_section . '</td>
    </tr>
</table>

';
}

$html .='
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td style="font-size:14px;"><b>Reported by: Dr. ' . $user_first_name . ' ' . $user_last_name . '. </b><b>GMC: 4336598. </b><b>Email: ' . $user_email . '. </b><b>Mobile: ' . $user_phone . '</b></td>
    </tr>
</table>

';
$pdf->writeHTML($html, true, false, true, false, '');
$file_name = $serial_number . '_Report_' . $first_name . '_' . $sur_name . '_' . date('dMY') . '.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
?>


