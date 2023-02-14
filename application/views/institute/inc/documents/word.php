<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "/third_party/vendor/autoload.php";
// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

ob_start();
if (!empty($mdt_records)) {
    $record_count = 1;

    $section = $phpWord->createSection(
        array(
            'marginLeft' => 500,
            'marginRight' => 500,
            'marginTop' => 700,
            'marginBottom' => 500
        )
    );

    $phpWord->setDefaultParagraphStyle(
        array(
        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
        'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
        'spacing' => 120,
        'lineHeight' => 1,
        )
    );

    foreach ($mdt_records as $record) {
        $specimen_data = $this->Doctor_model->doctor_record_detail_specimen($record->uralensis_request_id);
        
        // if (!empty($record->specimen_publish_status) && $record->specimen_publish_status == 1) {
        //     $section->addText('Status: Published', array('bold' => true, 'size' => 12));
        // } else {
        //     $section->addText('Status: Not Published', array('bold' => true, 'size' => 12));
        // }

        // if (!empty($record->mdt_case_assignee_username)) {
        //     $section->addText('MDT Assignee: ' . $record->mdt_case_assignee_username, array('bold' => true, 'size' => 12));
        // }

        $section->addText('Case ' . $record_count, array('bold' => true, 'size' => 14));
        $section->addText('Serial Number: ' . ' ' . $record->serial_number);
        $section->addText('PCI No: ' . ' ' . $record->pci_number);
        $section->addText('Patient Name: ' . ' ' . $record->f_name . ' ' . $record->sur_name, array('bold' => true));
        $section->addText('EMIS Number:' . ' ' . $record->emis_number);
        $section->addText('LAB Ref:' . ' ' . $record->lab_number);
        $section->addText('NHS Ref:' . ' ' . $record->nhs_number);
        $section->addText('Date of Birth:' . ' ' . $record->dob);
        $section->addText('Clinician:' . ' ' . $record->clrk);
        $section->addText('Dermatological Surgeon:' . ' ' . $record->dermatological_surgeon);
        $section->addText('Clinic Date:' . ' ' . $record->date_taken);
        $section->addText('Date Received By Lab:' . ' ' . $record->date_received_bylab);
        $section->addText('Date Published:' . ' ' . $record->publish_datetime);
        $section->addText('MDT Date:' . ' ' . $record->mdt_case, array('bold' => true));
        
        if (!empty($record->cl_detail)) {
            $section->addText('Clinical Detail:' . ' ' . $record->cl_detail, array('bold' => true));
        } else {
            $specimen_count = 1;
            foreach ($specimen_data as $specimen) {
                $section->addText('Clinical Detail (Specimen '.$specimen_count.'):' . ' ' . strip_tags($specimen->specimen_clinical_history), array('bold' => true));
                $specimen_count++;
            }
        }

        if (!empty($specimen_data)) {
            $count = 1;
            foreach ($specimen_data as $specimen) {
                $section->addText('Macroscopic Description (Specimen '.$count.'):', array('bold' => true));
                $macro = explode("\n", $specimen->specimen_macroscopic_description);
                foreach ($macro as $line) {
                    $org_text = htmlspecialchars_decode($line, ENT_QUOTES);
                    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $org_text, false, false);
                }
                $section->addText('Microscopic Description (Specimen '.$count.'):', array('bold' => true));
                $micro = explode("\n", $specimen->specimen_microscopic_description);
                foreach ($micro as $line) {
                    $org_text = htmlspecialchars_decode($line, ENT_QUOTES);
                    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $org_text, false, false);
                }
                $count++;
            }
        }

        // if ($record->mdt_case_status === 'for_mdt') {
        //     $section->addText('This case should be listed for the Local Skin MDT.', array('bold'));
        // }
        
        if ($record->mdt_case_add_to_report_status == 1) {
            $section->addText('MDT Note :' . ' ' . $record->mdt_case_msg, array('bold' => true));
        }
        $section->addTextBreak(1);
        $record_count++;
    }
}
echo ob_get_clean();

$filename = 'MDT_Reports_' . date('dMY') . '.docx'; //save our document as this file name

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

$objWriter->save('php://output');