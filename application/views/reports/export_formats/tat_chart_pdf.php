<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
/**
 * @var $id
 * @var $query
 * @var $time
 * @var $user
 * @var $lab_number
 */
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

global $user;

$user = $user_name;

class MYPDF extends TCPDF {
    public function Header() {

        global $user;
        global $h_group_id;

        if (!empty($h_group_id) && $h_group_id == 18) {
            $ura_logo = base_url('/application/helpers/tcpdf/shs_partner.jpg');
        } else {
            $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
        }

        $header_text = <<<EOD
<table width="100%">
    <tr>
        <td width="35%" align="left">
            <img width="180px" src="$ura_logo" />
        </td>
        <td  align="left" style=" font-size:15px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;" ><b style="height: 2em;">TAT Last Month (All Doctors)</b></td>
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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OxbridgeMedica');
$pdf->SetTitle('All Doctors TAT (Last Month)');
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
$pdf->SetY(30);


$html= " ";
$group_by_th = "";
if($group_by=="Doctor"){
    $group_by_th = "Doctor Name";
    }
if($group_by=="Speciality"){
    $group_by_th = "Speciality Name";
    }

$html .= '
<table style=" border-collapse: collapse; width: 100%;">
<tr >
<th style="color: white; background-color: #A0A0A0; border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left;">'.$group_by_th.'</th>
<th style="color: white; background-color: #A0A0A0; border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left;">Total Cases</th>
<th style="color: white; background-color: #A0A0A0; border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left;">TAT < 10 days (Cases)</th>
<th style="color: white; background-color: #A0A0A0; border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left;">TAT < 10 days (%)</th>
<th style="color: white; background-color: #A0A0A0; border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left;">Target TAT < 10 days (Cases)</th>
</tr>';
foreach ($all_docs_l_month_data as $key=>$value){
    $group_by_value = "";
    if($group_by=="Doctor"){
        $group_by_value = $value->doctor_name;
    }
    if($group_by=="Speciality"){
        $group_by_value = $value->speciality_group;
    }
    $html.= '
        <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">'.$group_by_value.'</td>
        <td style="border: 1px solid #ddd; padding: 8px;">'.$value->num_of_cases.'</td>
        <td style="border: 1px solid #ddd; padding: 8px;">'.$value->tat_less_ten.'</td>
        <td style="border: 1px solid #ddd; padding: 8px;">'.$value->tat_less_ten_percent.'</td>
        <td style="border: 1px solid #ddd; padding: 8px;">'.$value->target_less_ten.'</td>
        </tr>
    ';
}
$html.="</table>";

$html.='
<br /><br />
<div style="border-bottom:1px solid black;"></div> ';
//echo $html; exit;

$pdf->writeHTML($html, true, false, true, false, '');
$file_name = 'All_Doctors_TAT_Last_Month_' . date('dMY') . '.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');