<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
global $group_id;
global $date_from;
global $date_to;
global $group_name;
$group_id = $finance_data['hospital_group_id'];
$date_from = $finance_data['date_from'];
$date_to = $finance_data['date_to'];
$group_name = $finance_data['hospital_group_name'];
$logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
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
        $this->SetFont('helvetica', 8);

        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 3, 270, $footer_text, 0, 0, 0, true, true);
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

$html = '';
$finance_request = $this->Admin_model->finance_report_request($group_id, $date_to, $date_from);

$html .='
<table border="1" cellpadding="7">
<tr align="center" style="background-color:#1d5eaa;color:#fff;">
<th width="10%;">UL-Ref</th>
<th width="10%;">Lab Ref</th>
<th width="10%;">Patient Name</th>
<th width="10%;">Clinic Date</th>
<th width="7%;">Specimen (s)</th>
<th width="20%;">
<table align="center">
<tr>
<td>Blocks</td>
<td>Block Code</td>
<td>Fee</td>
</tr>
</table>
</th>
<th width="7%;">Levels</th>
<th width="7%;">Immunos</th>
<th width="7%;">IMF</th>
<th width="7%;">Storage</th>
<th width="5%;">Sub Total</th>
</tr>
';

$calc_price = 0;
foreach ($finance_request as $row) {
    
    $total_specimens = 0;
        $total_price = 0;

        $specimens = $this->Admin_model->display_specimens_report($row['uralensis_request_id'], $row['hospital_group_id']);

    if ($row['fw_levels'] !== 'NULL' || $row['fw_immunos'] == 'NULL' || !$row['fw_imf'] !== 'NULL') {
        
        $html .='
<tr align="center">
<td>' . $row['serial_number'] . '</td>
<td>' . $row['lab_number'] . '</td>
<td>' . $row['f_name'] . ' ' . $row['sur_name'] . '</td>
<td>' . date('Y-m-d', strtotime($row['date_taken'])) . '</td>
<td>' . count($specimens) . '</td>
<td>';
        if (!empty($specimens)) {
            $html .='
                    <table>';

            foreach ($specimens as $key => $value) {
                $calc_price = $calc_price + $value->ura_cost_code_price;
                $total_price = $total_price + $value->ura_cost_code_price;

                $html .='
                        <tr align="center">
                        <td>' . $value->ura_cost_code_desc . '</td>
                        <td>' . $value->ura_cost_code_prefix . '</td>
                        <td>' . $value->ura_cost_code_price . '</td>
                        </tr>';
            }
            $html .= '</table>';
        }
        $sub_total = $total_price + $row['Total'] + $row['ura_cost_code_storage_price'];
        $calc_price = $calc_price + $row['Total'] + $row['ura_cost_code_storage_price'];
        $html .='
                </td>
                <td>' . $row['Level_TOTAL'] . '</td>
                <td>' . $row['Immunos_TOTAL'] . '</td>
                <td>' . $row['Imf_TOTAL'] . '</td>
                <td>' . $row['ura_cost_code_storage_price'] . '</td>
                <td>' . $sub_total . '</td>
                </tr>';
    }
}
$html .= '
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center"><b>Total</b></td>
                    <td align="center"><b>' . $calc_price . '</b></td>
                </tr>
            </table>';

$pdf->writeHTML($html, true, false, true, false, '');
$file_name = 'Finance_Report_' . $group_name . '_' . date('dMY') . '.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');


