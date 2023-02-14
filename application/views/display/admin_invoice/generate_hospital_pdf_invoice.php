<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
global $to_section;
global $from_section;
global $comment_section;
global $footer_section;
global $invoice_number;
global $invoice_date;
global $to_sec_logo;
global $from_sec_logo;
if (!empty($invoice_temp)) {
    $to_section = str_replace("\n", '<br />', $invoice_temp['ura_hos_inv_to_section']);
    $from_section = str_replace("\n", '<br />', $invoice_temp['ura_hos_inv_from_section']);
    $comment_section = str_replace("\n", '<br />', $invoice_temp['ura_hos_inv_comments_setting']);
    $footer_section = str_replace("\n", '<br />', $invoice_temp['ura_hos_inv_footer_setting']);
    $to_sec_logo = $invoice_temp['ura_hos_inv_to_section_logo'];
    $from_sec_logo = $invoice_temp['ura_hos_inv_from_section_logo'];
}
$invoice_number = $hospital_invoice['ura_invoice_no'];
$invoice_date = date('d M Y', $hospital_invoice['timestamp']);
ob_start();
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    public function Header() {
        global $to_section;
        global $from_section;
        global $invoice_number;
        global $invoice_date;
        global $to_sec_logo;
        global $from_sec_logo;
        if (count($this->pages) === 1) {
            $header_text = <<<EOD
<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="35%" align="left"><br><br><br><br><br><img width="150px" src="$to_sec_logo"><br>$to_section</td>
        <td width="20%" style="font-size:12px;">
            
        </td>
        <td width="35%"><br><img width="150px" src="$from_sec_logo"><br>$from_section
            <br><br><br><br><br>
            <strong>Invoice Number:</strong> $invoice_number
            <br>
            <strong>Invoice Date:</strong> $invoice_date    
        </td>
    </tr>
</table>
EOD;
        }

        $this->SetY(0);
        $this->SetFont('arialuni', 16);
        $this->writeHTMLCell(0, 0, 5, 5, $header_text, 0, 0, 0, false, false);
    }

    public function Footer() {
        global $comment_section;
        global $footer_section;


        $footer_text = <<<EOD
<table width="100%">
    <tr>
        <td width="40%" style="font-size:12px;">$comment_section</td>
    </tr>
                        <br><br><br><br><br><br><br><br><br>
    <tr>
        <td align="left">$footer_section</td>
    </tr>
</table>
EOD;

        $this->SetY(-30);
        $this->SetFont('arialuni', 12);
        $this->writeHTMLCell(0, 0, 10, 200, $footer_text, 0, 0, 0, true, true);
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OxbridgeMedica');
$pdf->SetTitle('Uralensis');
$pdf->SetSubject('Uralensis Invoice Resport');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(5, PDF_MARGIN_TOP + 75, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('arialuni', 12);

$pdf->AddPage();
$html = '';


if (!empty($hospital_invoice)) {
    $tat_inv = unserialize($hospital_invoice['ura_invoice_data']);
    foreach ($tat_inv as $tat => $data) {
        $html .= '<table cellpadding="10" width="100%" style="font-size:13px;">';
        $html .= '<tr>';
        $html .= '<th width="40%"><strong>Description</strong></th>';
        $html .= '<th width="37%"></th>';
        $html .= '<th width="7%"><strong>Qty.</strong></th>';
        $html .= '<th width="15%"><strong>Amount GBP</strong></th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="border-top:1px solid black;"><h2 style="font-size:14px;">' . $data['hospital_name'] . '</h2><br>Period ' . date('d', strtotime($hospital_invoice['ura_hos_date_from'])) . '-' . date('d F Y', strtotime($hospital_invoice['ura_hos_date_to'])) . '</td>';
        $html .= '<td style="border-top:1px solid black;font-size:11px;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">
                                                <table>
                                                    <tr><td><strong>TAT</strong></td></tr>
                                                    <tr><td>1 -- 6</td></tr>
                                                    <tr><td>7 -- Abv</td></tr>
                                                </table>
                                            </td>
                                            <td width="50%">
                                            <table style="text-align:center;">
                                                <tr>
                                                    <td style="border-bottom:1px solid black;">Qty</td>
                                                </tr>
                                                <tr>
                                                    <td>' . $data['tat_1_to_6']['total_cases'] . '</td>
                                                </tr>
                                                <tr>
                                                    <td>' . $data['tat_7_to_above']['total_cases'] . '</td>
                                                </tr>
                                            </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>';
        $html .= '<td style="border-top:1px solid black;text-align:center; font-size:11px;">
                                    <table>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td>' . $data['total_cases'] . '</td></tr>
                                    </table>
                              </td>';
        $html .= '<td style="border-top:1px solid black;text-align:center; font-size:11px;">
                                    <table>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td>' . number_format($data['tat_1_to_6']['case_cost_total'], 2) . '</td></tr>
                                        <tr><td>' . number_format($data['tat_7_to_above']['case_cost_total'], 2) . '</td></tr>
                                    </table>
                              </td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '<div style="border-top:1px solid #ccc;"></div>';
        $html .= '<table cellpadding="10" width="100%" style="font-size:13px;margin-top:-10px;">';
        $html .= '<tr>';
        $html .= '<th width="20%">&nbsp;</th>';
        $html .= '<th width="37%">&nbsp;</th>';
        $html .= '<th style="border-bottom:1px solid black;" width="32%">Sub Total</th>';
        $html .= '<th style="border-bottom:1px solid black;" width="10%">' . number_format($data['total_cases_cost'], 2) . '</th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>&nbsp;</td>';
        $html .= '<td>&nbsp;</td>';
        $html .= '<td style="border-bottom:1px solid black;" width="32%">Total GBP</td>';
        $html .= '<td style="border-bottom:1px solid black;" width="10%">' . number_format($data['total_cases_cost'], 2) . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
    }
}

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->AddPage();
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetY(20);
$pdf->SetMargins(20, PDF_MARGIN_TOP + 0, 20);
$html_detail = '';

$html_detail .= '<p style="color:brown; font-size:17px;border-bottom:1px solid black;"><strong>Summary and detail</strong></p>';
$html_detail .= '<div style="margin-top:10px;"></div>';

if (!empty($tat_db_records)) {
    $below_six = false;
    $total_cases = 0;
    $total_completed_vd_in_time_cost_codes_cases = 0;
    foreach ($tat_db_records as $tat_check) {

        if ($tat_check['Cost_Code_Diff'] <= 6) {
            $below_six = true;
            $total_completed_vd_in_time_cost_codes_cases = $total_completed_vd_in_time_cost_codes_cases + 1;
        }
        $total_cases++;
    }

    $total_cases_of_90_percent = round(($total_cases / 100) * 90);
    $total_completed_cases = $total_completed_vd_in_time_cost_codes_cases;
    $total_percentage = ($total_completed_cases / $total_cases) * 100;

    $case_counter = 0;
    foreach ($tat_db_records as $key => $tat_data) {
        $case_counter++;
        if ($case_counter <= $total_cases_of_90_percent) {
            $tat_percentage_check = 'YES';
        } else {
            if ($total_percentage >= 90) {
                $tat_percentage_check = 'NO';
            }
        }
    }
}

if (!empty($pdf_record_summary)) {
    $html_detail .= '<br><strong>Summary</strong><br><br>';
    $html_detail .= '<table style="font-size:12px;" border="1" cellpadding="10" width="100%">';
    $html_detail .= '<tr>';
    $html_detail .= '<th><strong>Date</strong></th>';
    $html_detail .= '<th><strong>Total Cases Received</strong></th>';
    $html_detail .= '<th><strong>Total Cases Authorized</strong></th>';
    $html_detail .= '</tr>';
    $count_total_rec = 0;
    $count_total_pub = 0;
    foreach ($pdf_record_summary as $key => $value) {
        $html_detail .= '<tr>';
        $html_detail .= '<td>' . date('d/m/Y', strtotime($value['Req_Date'])) . '</td>';
        $html_detail .= '<td>' . $value['Total_cases_received'] . '</td>';
        $html_detail .= '<td>' . $value['Total_Published'] . '</td>';
        $html_detail .= '</tr>';
        $count_total_rec = $count_total_rec + $value['Total_cases_received'];
        $count_total_pub = $count_total_pub + $value['Total_Published'];
    }
    $html_detail .= '<tr>';
    $html_detail .= '<td>Total</td>';
    $html_detail .= '<td>' . $count_total_rec . '</td>';
    $html_detail .= '<td>' . $count_total_pub . '</td>';
    $html_detail .= '</tr>';
    $html_detail .= '<tr>';
    $html_detail .= '<td colspan="2"><strong>90% Reported With 6 TAT</strong></td>';
    $html_detail .= '<td><strong>' . $tat_percentage_check . '</strong></td>';
    $html_detail .= '</tr>';
    $html_detail .= '</table><br>';
}

if (!empty($pdf_record_detail)) {
    $html_detail .= '<br><strong>Detail</strong><br><br>';
    $html_detail .= '<table style="font-size:12px;" border="1" cellpadding="10" width="100%">';
    $html_detail .= '<tr>';
    $html_detail .= '<th>Partner Number</th>';
    $html_detail .= '<th>Lab Number</th>';
    $html_detail .= '<th>Received From</th>';
    $html_detail .= '<th>Date Authorised</th>';
    $html_detail .= '<th>TAT</th>';
    $html_detail .= '</tr>';
    foreach ($pdf_record_detail as $key => $value) {
        $rec_from_date = '';
        if (!empty($value['receive_from_date'])) {
            $rec_from_date = date('d/m/Y', strtotime($value['receive_from_date']));
        }
        $publish_date = '';
        if (!empty($value['publish_date'])) {
            $publish_date = date('d/m/Y', strtotime($value['publish_date']));
        }
        $html_detail .= '<tr>';
        $html_detail .= '<td>' . $value['serial_number'] . '</td>';
        $html_detail .= '<td>' . $value['lab_number'] . '</td>';
        $html_detail .= '<td>' . $rec_from_date . '</td>';
        $html_detail .= '<td>' . $publish_date . '</td>';
        if ($value['Cost_Code_Diff'] == 0) {
            $html_detail .= '<td>&lt;1</td>';
        } else {
            $html_detail .= '<td>' . $value['Cost_Code_Diff'] . '</td>';
        }

        $html_detail .= '</tr>';
    }
    $html_detail .= '</table>';
}
$pdf->writeHTML($html_detail, true, false, true, false, '');
$file_name = 'test.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
