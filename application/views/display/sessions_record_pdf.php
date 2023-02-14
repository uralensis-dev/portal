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
$html .= '<h2 style="text-align:center;">Track Session Records</h2>';
$html .='
<table border="1" cellspacing="2" cellpading="2" style="text-align:center;">
    <tr>
        <th><b>UL No.</b></th>
        <th><b>Track No.</b></th>
        <th><b>Client</b></th>
        <th><b>First Name</b></th>
        <th><b>Surname</b></th>
        <th><b>DOB</b></th>
        <th><b>NHS No.</b></th>
        <th><b>Lab No.</b></th>
        <th><b>Type</b></th>
        <th><b>Release Date</b></th>
        <th><b>Status</b></th>
        <th><b>TAT</b></th>
    </tr>
';

if (!empty($session_data)) {
    foreach ($session_data as $row) {
        $f_initial = '';
        $l_initial = '';
        if (!empty($this->ion_auth->group($row['hospital_group_id'])->row()->first_initial)) {
            $f_initial = $this->ion_auth->group($row['hospital_group_id'])->row()->first_initial;
        }
        if (!empty($this->ion_auth->group($row['hospital_group_id'])->row()->last_initial)) {
            $l_initial = $this->ion_auth->group($row['hospital_group_id'])->row()->last_initial;
        }

        $publish_date = '';
        if (!empty($row['publish_datetime'])) {
            $publish_date = date('d-m-Y', strtotime($row['publish_datetime']));
        }

        $now = time(); // or your date as well
        $date_taken = !empty($row['date_taken']) ? $row['date_taken'] : '';
        $request_date = !empty($row['request_datetime']) ? $row['request_datetime'] : '';
        $tat_date = '';

        if (!empty($date_taken)) {
            $tat_date = $date_taken;
        } else {
            $tat_date = $request_date;
        }

        $compare_date = strtotime("$tat_date");
        $datediff = $now - $compare_date;
        $record_old_count = floor($datediff / (60 * 60 * 24));

        $html .='
    <tr>
        <td>' . $row['serial_number'] . '</td>
        <td>' . $row['ura_barcode_no'] . '</td>
        <td>' . $f_initial . ' ' . $l_initial . '</td>
        <td>' . $row['f_name'] . '</td>
        <td>' . $row['sur_name'] . '</td>
        <td>' . $row['dob'] . '</td>
        <td>' . $row['nhs_number'] . '</td>
        <td>' . $row['lab_number'] . '</td>
        <td>' . $row['report_urgency'] . '</td>
        <td>' . $publish_date . '</td>
        <td>' . $this->Searchtracking_model->get_track_template_statuses($row['uralensis_request_id'], 'recent')['ura_rec_track_status'] . '</td>
        <td>' . $record_old_count . '</td>
    </tr>
';
    }
}

$html .='</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$file_name = 'Session_Records_'.date('d-m-Y-H:i:s').'.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
