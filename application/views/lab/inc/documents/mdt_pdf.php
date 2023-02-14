<?php
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');
ob_start();
$pdf = new TCPDF('L', PDF_UNIT, 'A3', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OxbridgeMedica');
$pdf->SetTitle('Uralensis MDT Report');
$pdf->SetSubject('Uralensis MDT Resport');
$pdf->SetPrintHeader(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 15, 15);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('times', 14);


if (!empty($mdt_records)) {
    $record_count = 1;
    foreach ($mdt_records as $record) {
        $specimen_data = $this->Doctor_model->doctor_record_detail_specimen($record->uralensis_request_id);

        $clrk = $record->clrk;
        if (!empty($record->clrk) && ctype_digit($record->clrk)) {
            $clrk = uralensisGetUsername($record->clrk, 'fullname');
        }

        $dermatological_surgeon = $record->dermatological_surgeon;
        if (!empty($record->dermatological_surgeon) && ctype_digit($record->dermatological_surgeon)) {
            $dermatological_surgeon = uralensisGetUsername($record->dermatological_surgeon, 'fullname');
        }

        $html = "";
        $serial = $record->serial_number;
        $html .= "<table width='100%'>";
        $html .= "<tr>";
        $html .= "<td><b>Case : " . $record_count . "</b></td>";
        $html .= "<td><b>Case Serial: " . $serial . "</b></td>";
        if (!empty($record->specimen_publish_status) && $record->specimen_publish_status == 1) {
            $html .= "<td align='right'><b>Status : Published</b></td>";
        } else {
            $html .= "<td align='right'><b>Status : Not Published</b></td>";
        }

        $html .= "</tr>";
        $html .= "</table>";
        $html .= "<hr />";
        $html .= "<div></div>";
        $html .= "<div></div>";
        $html .= "<table width='100%'>";
        $html .= "<tr>";
        if (!empty($record->mdt_case_assignee_username)) {
            $html .= "<td><b>MDT Assignee :</b> " . $record->mdt_case_assignee_username . "</td>";
        }
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Serial Number : </b>" . $record->serial_number . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>PCI Number : </b>" . $record->pci_number . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Patient Name : </b>" . $record->f_name . " " . $record->sur_name . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>EMIS Number : </b>" . $record->emis_number . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>LAB Ref : </b>" . $record->lab_number . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>NHS Ref : </b>" . $record->nhs_number . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Date of Birth : </b>" . $record->dob . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Clinician : </b>" . $clrk . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Dermatological Surgeon : </b>" . $dermatological_surgeon . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Clinic Date : </b>" . $record->date_taken . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Date Received By Lab : </b>" . $record->date_received_bylab . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>Date Published : </b>" . $record->publish_datetime . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        if (!empty($record->cl_detail)) {
            $html .= "<td><b>Clinical Detail : </b>" . $record->cl_detail . "</td>";
        } else {
            $specimen_count = 1;
            foreach ($specimen_data as $specimen) {
                $specimen_result_clinical = str_replace("\n", '<br />', $specimen->specimen_clinical_history);
                $html .= "<td><b>Clinical Detail (Specimen ".$specimen_count."): </b>" . $specimen_result_clinical . "</td>";
                $specimen_count++;
            }
        }
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><b>MDT Date : </b>" . $record->mdt_case . "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "<div></div>";
        $html .= "<div></div>";
        $html .= "<table width='100%'>";

        if (!empty($specimen_data)) {
            foreach ($specimen_data as $specimen) {
                $html .= "<tr>";
                $html .= "<td><b>Macroscopic Description</b></td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $macro = explode("\n", $specimen->specimen_macroscopic_description);
                foreach ($macro as $line) {
                    $org_text = htmlspecialchars_decode($line, ENT_QUOTES);
                    $html .= "<td>" . $org_text . "</td>";
                }
                $html .= "</tr>";
                $html .= "<div></div>";
                $html .= "<tr>";
                $html .= "<td><b>Microscopic Description</b></td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $micro = explode("\n", $specimen->specimen_microscopic_description);
                foreach ($micro as $line) {
                    $org_text = htmlspecialchars_decode($line, ENT_QUOTES);
                    $html .= "<td>" . $org_text . "</td>";
                }
                $html .= "</tr>";
            }
        }
        $html .= "</table>";
        $html .= "<div></div>";
        $html .= "<div></div>";
        $html .= "<table width='100%'>";
        $html .= "<tr>";
        if ($record->mdt_case_status === 'for_mdt') {
            $html .= "<td><b>This case should be listed for the Local Skin MDT.</b></td>";
        }
        $html .= "</tr>";
        $html .= "<div></div>";
        $html .= "<tr>";
        if ($record->mdt_case_add_to_report_status == 1) {
            $html .= "<td><b>MDT Note : </b>" . $record->mdt_case_msg . "</td>";
        }
        $html .= "</tr>";
        $html .= "</table>";
        $record_count++;

        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
    }
}
ob_end_clean();
$pdf->Output('MDT Report', 'I');
