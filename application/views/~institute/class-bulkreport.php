<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');
    class MYPDF extends TCPDF {

        public function Header() {

            global $serial_number;
            global $pci_number;
            global $first_name;
            global $sur_name;
            global $emis_number;
            global $lab_number;
            global $nhs_number;
            global $dob;
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

            if (!empty($h_group_id) && $h_group_id == 18) {
                $ura_logo = base_url('/application/helpers/tcpdf/shs_partner.jpg');
            } else {
                $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
            }
            $header_text = <<<EOD
                
<table width="100%">
    <tr>
        <td width="25%" align="left">
            <img width="180px" src="$ura_logo" />
        </td>
        <td width="32%" align="center" style="font-size:20px;"><b>Histopathology Report</b></td>
        <td width="50%" align="right">
            <table style="font-size:13.6px;text-align:left;">
                <tr><td width="45%">Serial Number : </td><td><b>$serial_number</b></td></tr>
                <tr><td>PCI Number : </td><td><b>$pci_number</b></td></tr>
                <tr><td>Patient Name : </td><td><b>$first_name $sur_name</b></td></tr>
		<tr><td>EMIS Number : </td><td><b>$emis_number</b></td></tr>
		<tr><td>LAB Ref : </td><td>$lab_number</td></tr>
		<tr><td>NHS Ref : </td><td>$nhs_number</td></tr>
                <tr><td>Date of Birth : </td><td>$dob</td></tr>
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

        public function Footer() {
            global $hospital_information;
            $footer_text = $hospital_information;
            $this->SetY(-30);
            $this->SetFont('times', 16);

            $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
            $this->writeHTMLCell(0, 0, 0, 25, $footer_text, 0, 0, 0, true, true);
        }

    }

    
