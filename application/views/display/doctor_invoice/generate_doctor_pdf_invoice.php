<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
global $to_section;
global $from_section;
global $comment_section;
global $footer_section;
global $invoice_number;
global $invoice_date;
if (!empty($invoice_temp)) {
    $to_section = str_replace("\n", '<br />', $invoice_temp['ura_doc_inv_to_section']);
    $from_section = str_replace("\n", '<br />', $invoice_temp['ura_doc_inv_from_section']);
    $comment_section = str_replace("\n", '<br />', $invoice_temp['ura_doc_inv_comments_setting']);
    $footer_section = str_replace("\n", '<br />', $invoice_temp['ura_doc_inv_footer_setting']);
}
$invoice_number = $doctor_invoice['ura_invoice_no'];
$invoice_date = date('d M Y', $doctor_invoice['timestamp']);
ob_start();
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    public function Header() {
        global $to_section;
        global $from_section;
        global $invoice_number;
        global $invoice_date;
        $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
        $header_text = <<<EOD
<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="35%" align="left"><br><br><br><br><br><img width="150px" src="$ura_logo"><br>$to_section</td>
        <td width="20%" style="font-size:12px;">
            
        </td>
        <td width="35%"><br>$from_section
            <br><br><br><br><br>
            <strong>Invoice Number:</strong> $invoice_number
            <br>
            <strong>Invoice Date:</strong> $invoice_date    
        </td>
    </tr>
</table>
EOD;
        $this->SetY(0);
        $this->SetFont('arialuni', '', 10, '', 'default', true);
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
    <br>
    <tr>
        <td align="left">$footer_section</td>
    </tr>
</table>
EOD;

        $this->SetY(-10);
        $this->SetFont('arialuni', '', 12, '', 'default', true);
        $this->writeHTMLCell(0, 0, 10, 230, $footer_text, 0, 0, 0, true, true);
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
$pdf->SetMargins(5, PDF_MARGIN_TOP + 60, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('arialuni', 12);

$pdf->AddPage();
$html = '';

$tat_inv = unserialize($doctor_invoice['ura_invoice_data']);

if (!empty($tat_inv)) {
    foreach ($tat_inv as $tat => $data) {
        if ($tat === 'tat_true') {
            $alopecia_check = false;
            $imf_check = false;
            $routine_check = false;
            foreach ($data as $invkey => $invdata) {
                if ($invdata['alopecia_cases']['total_cases'] !== 0 && $invdata['alopecia_cases']['total_cases'] !== NULL) {
                    $alopecia_check = true;
                }
                if ($invdata['imf_cases']['total_cases'] !== 0 && $invdata['imf_cases']['total_cases'] !== NULL) {
                    $imf_check = true;
                }
                if ($invdata['routine_cases']['total_cases'] !== 0 && $invdata['routine_cases']['total_cases'] !== NULL) {
                    $routine_check = true;
                }
                $html .= '<table cellpadding="10" width="100%" style="font-size:13px;">';
                $html .= '<tr>';
                $html .= '<th width="40%"><strong>Description</strong></th>';
                $html .= '<th width="37%"></th>';
                $html .= '<th width="7%"><strong>Qty.</strong></th>';
                $html .= '<th width="15%"><strong>Amount GBP</strong></th>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td style="border-top:1px solid black;"><h2 style="font-size:14px;">' . $invdata['hospital_name'] . '</h2><br>Period ' . date('d', strtotime($doctor_invoice['ura_doc_date_from'])) . '-' . date('d F Y', strtotime($doctor_invoice['ura_doc_date_to'])) . '</td>';
                $html .= '<td style="border-top:1px solid black;font-size:11px;">
                                    <table width="100%">
                                        <tr>
                                            <td width="30%">
                                            <table>
                                                <tr><td><strong>Type</strong></td></tr>';
                if ($alopecia_check !== false) {
                    $html .= '<tr><td>Alopecia</td></tr>';
                }
                if ($imf_check !== false) {
                    $html .= '<tr><td>IMF</td></tr>';
                }
                if ($routine_check !== false) {
                    $html .= '<tr><td>Routine</td></tr>';
                }
                $html .='</table>
                                            </td>
                                            <td width="75%">
                                            <table style="text-align:center;">
                                                <tr>
                                                    <td style="border-bottom:1px solid black;">1 - 3 Q&nbsp;|</td>
                                                    <td style="border-bottom:1px solid black;">1 - 3 P&nbsp;|</td>
                                                    <td style="border-bottom:1px solid black;">4 - 6 Q&nbsp;|</td>
                                                    <td style="border-bottom:1px solid black;">4 - 6 P</td>
                                                </tr>';
                if ($alopecia_check !== false) {
                    $html .='<tr>
                            <td>' . $invdata['alopecia_cases']['tat_1_to_3'] . '</td>
                            <td>' . $invdata['alopecia_cases']['tat_1_to_3_cost'] . '</td>
                            <td>' . $invdata['alopecia_cases']['tat_4_to_6'] . '</td>
                            <td>' . $invdata['alopecia_cases']['tat_4_to_6_cost'] . '</td>
                        </tr>';
                }
                if ($imf_check !== false) {
                    $html .= '<tr>
                            <td>' . $invdata['imf_cases']['tat_1_to_3'] . '</td>
                            <td>' . $invdata['imf_cases']['tat_1_to_3_cost'] . '</td>
                            <td>' . $invdata['imf_cases']['tat_4_to_6'] . '</td>
                            <td>' . $invdata['imf_cases']['tat_4_to_6_cost'] . '</td>
                        </tr>';
                }
                if ($routine_check !== false) {
                    $html .= '<tr>
                            <td>' . $invdata['routine_cases']['tat_1_to_3'] . '</td>
                            <td>' . $invdata['routine_cases']['tat_1_to_3_cost'] . '</td>
                            <td>' . $invdata['routine_cases']['tat_4_to_6'] . '</td>
                            <td>' . $invdata['routine_cases']['tat_4_to_6_cost'] . '</td>
                        </tr>';
                }

                $html .='</table>
                </td>
                </tr>
                </table>
                </td>';
                $html .= '<td style = "border-top:1px solid black;text-align:center; font-size:11px;">
                <table>
                <tr><td>&nbsp;
                </td></tr>';
                if ($alopecia_check !== false) {
                    $html .= '<tr><td>' . $invdata['alopecia_cases']['total_cases'] . '</td></tr>';
                }
                if ($imf_check !== false) {
                    $html .= '<tr><td>' . $invdata['imf_cases']['total_cases'] . '</td></tr>';
                }
                if ($routine_check !== false) {
                    $html .= '<tr><td>' . $invdata['routine_cases']['total_cases'] . '</td></tr>';
                }
                $html .= '</table>
                </td>';
                $html .= '<td style = "border-top:1px solid black;text-align:center; font-size:11px;">
                <table>
                <tr><td>&nbsp;
                </td></tr>';
                if ($alopecia_check !== false) {
                    $html .= '<tr><td>' . number_format($invdata['alopecia_cases']['total_cases_cost'], 2) . '</td></tr>';
                }
                if ($imf_check !== false) {
                    $html .= '<tr><td>' . number_format($invdata['imf_cases']['total_cases_cost'], 2) . '</td></tr>';
                }
                if ($routine_check !== false) {
                    $html .= '<tr><td>' . number_format($invdata['routine_cases']['total_cases_cost'], 2) . '</td></tr>';
                }
                $html .= '</table>
                </td>';
                $html .= '</tr>';
                $html .= '</table>';
                $html .= '<div style = "border-top:1px solid #ccc;"></div>';
                $html .= '<table cellpadding = "10" width = "100%" style = "font-size:13px;margin-top:-10px;">';
                $html .= '<tr>';
                $html .= '<th width = "20%">&nbsp;
                </th>';
                $html .= '<th width = "37%">&nbsp;
                </th>';
                $html .= '<th style = "border-bottom:1px solid black;" width = "32%">Sub Total</th>';
                $html .= '<th style = "border-bottom:1px solid black;" width = "10%">' . number_format($invdata['total_cases_cost'], 2) . '</th>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>&nbsp;
                </td>';
                $html .= '<td>&nbsp;
                </td>';
                $html .= '<td style = "border-bottom:1px solid black;" width = "32%">Total GBP</td>';
                $html .= '<td style = "border-bottom:1px solid black;" width = "10%">' . number_format($invdata['total_cases_cost'], 2) . '</td>';
                $html .= '</tr>';
                $html .= '</table>';
            }
        } else {
            $alopecia_check = false;
            $imf_check = false;
            $routine_check = false;
            foreach ($data as $invkey => $invdata) {
                if ($invdata['alopecia_total_cases_cost'] !== 0 && $invdata['alopecia_total_cases_cost'] !== NULL) {
                    $alopecia_check = true;
                }
                if ($invdata['imf_total_cases_cost'] !== 0 && $invdata['imf_total_cases_cost'] !== NULL) {
                    $imf_check = true;
                }
                if ($invdata['routine_total_cases_cost'] !== 0 && $invdata['routine_total_cases_cost'] !== NULL) {
                    $routine_check = true;
                }
                
                if (!empty($invdata['alopecia_cases']) || !empty($invdata['imf_cases']) || !empty($invdata['routine_cases'])) {
                    $html .= '<table cellpadding = "10" width = "100%" style = "font-size:13px;">';
                    $html .= '<tr>';
                    $html .= '<th width = "40%"><strong>Description</strong></th>';
                    $html .= '<th width = "37%"></th>';
                    $html .= '<th width = "7%"><strong>Qty.</strong></th>';
                    $html .= '<th width = "15%"><strong>Amount GBP</strong></th>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td style = "border-top:1px solid black;"><h2 style = "font-size:14px;">' . $invdata['hospital_name'] . '</h2><br>Period ' . date('d', strtotime($doctor_invoice['ura_doc_date_from'])) . '-' . date('d F Y', strtotime($doctor_invoice['ura_doc_date_to'])) . '</td>';
                    $html .= '<td style = "border-top:1px solid black;font-size:11px;">
                <table width = "100%">
                <tr>
                <td width = "30%">
                <table>
                <tr><td><strong>Type</strong></td></tr>';
                    if ($alopecia_check !== false) {
                        $html .= '<tr><td>Alopecia</td></tr>';
                    }
                    if ($imf_check !== false) {
                        $html .= '<tr><td>IMF</td></tr>';
                    }
                    if ($routine_check !== false) {
                        $html .= '<tr><td>Routine</td></tr>';
                    }
                    $html .= '</table>
                </td>
                <td width = "75%">
                <table style = "text-align:center;">
                <tr>
                <td style = "border-bottom:1px solid black;">Qty.</td>
                <td style = "border-bottom:1px solid black;">Price</td>
                </tr>';
                    if ($alopecia_check !== false) {
                        $html .='<tr>
                            <td>' . $invdata['alopecia_cases'] . '</td>
                            <td>' . $invdata['alopecia_cases_cost'] . '</td>
                            </tr>';
                    }
                    if ($imf_check !== false) {
                        $html .= '<tr>
                            <td>' . $invdata['imf_cases'] . '</td>
                            <td>' . $invdata['imf_cases_cost'] . '</td>
                            </tr>';
                    }
                    if ($routine_check !== false) {
                        $html .= '<tr>
                            <td>' . $invdata['routine_cases'] . '</td>
                            <td>' . $invdata['routine_cases_cost'] . '</td>
                            </tr>';
                    }
                    $html .= '</table>
                </td>
                </tr>
                </table>
                </td>';
                    $html .= '<td style = "border-top:1px solid black;text-align:center; font-size:11px;">
                <table>
                <tr><td>&nbsp;
                </td></tr>';
                    if ($alopecia_check !== false) {
                        $html .= '<tr><td>' . $invdata['alopecia_cases'] . '</td></tr>';
                    }
                    if ($imf_check !== false) {
                        $html .= '<tr><td>' . $invdata['imf_cases'] . '</td></tr>';
                    }
                    if ($routine_check !== false) {
                        $html .= '<tr><td>' . $invdata['routine_cases'] . '</td></tr>';
                    }
                    $html .= '</table>
                </td>';
                    $html .= '<td style = "border-top:1px solid black;text-align:center; font-size:11px;">
                <table>
                <tr><td>&nbsp;
                </td></tr>';
                    if ($alopecia_check !== false) {
                        $html .= '<tr><td>' . number_format($invdata['alopecia_total_cases_cost'], 2) . '</td></tr>';
                    }
                    if ($imf_check !== false) {
                        $html .= '<tr><td>' . number_format($invdata['imf_total_cases_cost'], 2) . '</td></tr>';
                    }
                    if ($routine_check !== false) {
                        $html .= '<tr><td>' . number_format($invdata['routine_total_cases_cost'], 2) . '</td></tr>';
                    }
                    $html .= '</table>
                </td>';
                    $html .= '</tr>';
                    $html .= '</table>';
                    $html .= '<div style = "border-top:1px solid #ccc;"></div>';
                    $html .= '<table cellpadding = "10" width = "100%" style = "font-size:13px;margin-top:-10px;">';
                    $html .= '<tr>';
                    $html .= '<th width = "20%">&nbsp;
                </th>';
                    $html .= '<th width = "37%">&nbsp;
                </th>';
                    $html .= '<th style = "border-bottom:1px solid black;" width = "32%">Sub Total</th>';
                    $html .= '<th style = "border-bottom:1px solid black;" width = "10%">' . number_format($invdata['total_cases_cost'], 2) . '</th>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td>&nbsp;
                </td>';
                    $html .= '<td>&nbsp;
                </td>';
                    $html .= '<td style = "border-bottom:1px solid black;" width = "32%">Total GBP</td>';
                    $html .= '<td style = "border-bottom:1px solid black;" width = "10%">' . number_format($invdata['total_cases_cost'], 2) . '</td>';
                    $html .= '</tr>';
                    $html .= '</table>';
                }
            }
        }
    }
}

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetPrintHeader(false);
$pdf->AddPage();

$pdf->SetPrintFooter(false);
$pdf->SetY(20);
$pdf->SetMargins(15, PDF_MARGIN_TOP + 0, 15);
$html_detail = '';

$html_detail .= '<p style = "color:brown; font-size:17px;border-bottom:1px solid black;"><strong>Summary and detail</strong></p>';
$html_detail .= '<div style = "margin-top:10px;"></div>';

if (!empty($pdf_record_summary)) {
    $html_detail .= '<strong>Summary</strong><br><br>';
    $html_detail .= '<table style = "font-size:12px;" border = "1" cellpadding = "10" width = "100%">';
    $html_detail .= '<tr>';
    $html_detail .= '<th>Date</th>';
    $html_detail .= '<th>Total Cases Received</th>';
    $html_detail .= '<th>Total Cases Authorised</th>';
    $html_detail .= '</tr>';
    foreach ($pdf_record_summary as $key => $value) {
        $html_detail .= '<tr>';
        $html_detail .= '<td>' . date('d/m/Y', strtotime($value['Req_Date'])) . '</td>';
        $html_detail .= '<td>' . $value['Total_Cases'] . '</td>';
        $html_detail .= '<td>' . $value['Total_Published'] . '</td>';
        $html_detail .= '</tr>';
    }
    $html_detail .= '</table><br>';
}

if (!empty($tat_inv)) {
    foreach ($tat_inv as $tat => $data) {
        foreach ($data as $invkey => $invdata) {

            $doctor_tat_records = $this->Admin_model->get_pdf_detail_records_doctor($doctor_invoice['ura_doc_id'], $invdata['hospital_name'], $doctor_invoice['ura_doc_date_from'], $doctor_invoice['ura_doc_date_to']);
            if (!empty($doctor_tat_records)) {

                $check_alo_col = false;
                $check_imf_col = false;
                $check_rou_col = false;
                foreach ($doctor_tat_records as $key => $val) {
                    if ($val['Alopecia_DATE_DIFF'] !== '' && $val['Alopecia_DATE_DIFF'] !== NULL) {
                        $check_alo_col = true;
                    }
                    if ($val['IMF_DATE_DIFF'] !== '' && $val['IMF_DATE_DIFF'] !== NULL) {
                        $check_imf_col = true;
                    }
                    if ($val['Routine_DATE_DIFF'] !== '' && $val['Routine_DATE_DIFF'] !== NULL) {
                        $check_rou_col = true;
                    }
                }

                $html_detail .= '<br><strong>' . $invdata['hospital_name'] . '</strong><br><br>';
                $html_detail .= '<table style = "font-size:12px;" border = "1" cellpadding = "10" width = "100%">';
                $html_detail .= '<tr>';
                $html_detail .= '<th>UL-Number</th>';
                $html_detail .= '<th>Lab Number</th>';
                $html_detail .= '<th>Date Received</th>';
                $html_detail .= '<th>Date Authorised</th>';

                if ($check_alo_col === true) {
                    $html_detail .= '<th>Alopecia TAT</th>';
                }
                if ($check_imf_col === true) {
                    $html_detail .= '<th>Imf TAT</th>';
                }
                if ($check_rou_col === true) {
                    $html_detail .= '<th>Routine TAT</th>';
                }
                $html_detail .= '</tr>';
                foreach ($doctor_tat_records as $tat_doc_key => $tat_doc_val) {

                    $rec_from_date = '';
                    if (!empty($tat_doc_val['receive_from_date'])) {
                        $rec_from_date = date('d/m/Y', strtotime($tat_doc_val['receive_from_date']));
                    }

                    $publish_date = '';
                    if (!empty($tat_doc_val['publish_date'])) {
                        $publish_date = date('d/m/Y', strtotime($tat_doc_val['publish_date']));
                    }

                    $html_detail .= '<tr>';
                    $html_detail .= '<td>' . $tat_doc_val ['serial_number'] . '</td>';
                    $html_detail .= '<td>' . $tat_doc_val['lab_number'] . '</td>';
                    $html_detail .= '<td>' . $rec_from_date . '</td>';
                    $html_detail .= '<td>' . $publish_date . '</td>';
                    if ($check_alo_col !== false) {
                        if ($tat_doc_val['Alopecia_DATE_DIFF'] == 0) {
                            $html_detail .= '<td>&lt;
                1</td>';
                        } else {
                            $html_detail .= '<td>' . $tat_doc_val['Alopecia_DATE_DIFF'] . '</td>';
                        }
                    }
                    if ($check_imf_col !== false) {
                        if ($tat_doc_val['IMF_DATE_DIFF'] == 0) {
                            $html_detail .= '<td>&lt;
                1</td>';
                        } else {
                            $html_detail .= '<td>' . $tat_doc_val['IMF_DATE_DIFF'] . '</td>';
                        }
                    }
                    if ($check_rou_col !== false) {
                        if ($tat_doc_val['Routine_DATE_DIFF'] == 0) {
                            $html_detail .= '<td>&lt;
                1</td>';
                        } else {
                            $html_detail .= '<td>' . $tat_doc_val['Routine_DATE_DIFF'] . '</td>';
                        }
                    }
                    $html_detail .= '</tr>';
                }
                $html_detail .= '</table>';
            }
        }
    }
}

$pdf->writeHTML($html_detail, true, false, true, false, '');
$file_name = 'test.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');

