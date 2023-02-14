<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
ob_start();
global $group_id;
global $group_name;
$group_id = $csv_data['group_id'];
$group_name = $this->ion_auth->group($group_id)->row()->description;
$logo = base_url('/application/helpers/tcpdf/uralensis_latest.png');
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    public function Header() {


        $logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
        $header_text = <<<EOD
<table width="100%">
    <tr>
        <td width="40%" align="left">
            <img width="250px" src="$logo" />
        </td>
        <td width="20%">&nbsp;</td>
        
    </tr>
</table>
EOD;
        $this->SetY(-30);
        $this->SetFont('helvetica', 20);
        $this->writeHTMLCell(0, 0, 10, 5, $header_text, 0, 0, 0, false, false);
    }

    public function Footer() {
        global $hospital_information;
        $footer_text = $hospital_information;
        $this->SetY(-30);
        $this->SetFont('times', 20);

        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 0, 25, $footer_text, 0, 0, 0, true, true);
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OxbridgeMedica');
$pdf->SetTitle('Uralensis');
$pdf->SetSubject('Uralensis Resport');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(5, PDF_MARGIN_TOP + 30, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('times', 12);
$resolution = array(400, 400);
$pdf->AddPage('P', $resolution);

$html = '
<table border="1" cellpadding="7">
    <tr align="center" style="background-color:#1d5eaa;color:#fff;">
    <th width="10%;">UL-Ref</th>
    <th width="10%;">Patient Initial</th>
    <th width="10%;">Lab Ref</th>
    <th width="10%;">Patient Name</th>
    <th width="10%;">Clinic Date</th>
    <th width="10%;">NHS Number</th>
    <th width="10%;">Furtherwork Description</th>
    <th width="10%;">Furtherwork Date</th>
    <th width="10%;">Status</th>
</tr>
';
$fw_csv = $this->Admin_model->generate_fw_reprot_model($group_id);

foreach($fw_csv as $row) {
$html .= '<tr>';
$html .= '<td>'.$row['serial_number'].'</td>';
$html .= '<td>'.$row['patient_initial'].'</td>';
$html .= '<td>'.$row['lab_number'].'</td>';
$html .= '<td>'.$row['f_name']. ' ' .$row['sur_name'].'</td>';
$html .= '<td>'.$row['date_taken'].'</td>';
$html .= '<td>'.$row['nhs_number'].'</td>';
$html .= '<td>'.$row['furtherword_description'].'</td>';
$html .= '<td>'.$row['furtherwork_date'].'</td>';
$html .= '<td>'.$row['fw_status'].'</td>';
$html .= '</tr>';
}

$html .='</table>';

$pdf->writeHTML($html, true, false, true, false, '');
$file_name = 'Furtherwork_Report_' . $group_name . '_' . date('dMY') . '.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
?>

