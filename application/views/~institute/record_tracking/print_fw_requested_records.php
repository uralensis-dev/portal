<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ob_start();
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    public function Header() {
        $this->SetY(0);
        $this->SetFont('times', 10);
        $this->writeHTMLCell(0, 0, 5, 5, '', 0, 0, 0, false, false);
    }

    public function Footer() {
        $this->SetY(-30);
        $this->SetFont('times', 16);
        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 0, 25, '', 0, 0, 0, true, true);
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
$pdf->SetMargins(1, PDF_MARGIN_TOP + 5, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('times', 12);

$pdf->AddPage();
$html = '';
$html .= '<h2 style="text-align:center;">FW Requested Records.</h2>';
$html .='
<table border="1" cellspacing="2" cellpading="2" style="text-align:center;">
    <tr>
        <th width="50px"><b>ID</b></th>
        <th><b>Uralensis ID</b></th>
        <th width="200px"><b>Further Work Detail</b></th>
        <th><b>Doctor Name</b></th>
        <th><b>Timestamp</b></th>
        <th><b>FW Status</b></th>
    </tr>
';

if (!empty($fw_data)) {
    foreach ($fw_data as $fw) {
        $html .='
    <tr>
        <td>'.$fw->request_id.'</td>
        <td>'.$fw->serial_number.'</td>
        <td>'.$fw->furtherword_description.'</td>
        <td>'.$fw->first_name.'</td>
        <td>'.$fw->furtherwork_date.'</td>
        <td>'.$fw->fw_status.'</td>
    </tr>
';
    }
}

$html .='</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$file_name = 'test.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
