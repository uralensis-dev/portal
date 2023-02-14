<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
/**
 * @var $id
 * @var $query
 * @var $time
 * @var $nhs_number
 * @var $lab_number
 * @var $serial_number
 * @var $emis_number
 * @var $hos_number
 * @var $sur_name
 * @var $first_name
 * @var $user_information
 * @var $dob
 * @var $gender
 * @var $clrk
 * @var $date_taken
 * @var $urgent
 * @var $hsc
 * @var $cl_detail
 * @var $specimen_macroscopic_code
 * @var $specimen_macroscopic_description
 * @var $specimen_microscopic_code
 * @var $specimen_microscopic_description
 * @var $specimen_snomed_code
 * @var $specimen_snomed_description
 * @var $specimen_diagnosis_code
 * @var $specimen_diagnosis_description
 * @var $specimen_comment_code
 * @var $specimen_comment_description
 * @var $specimen_information_code
 * @var $specimen_information_description
 * @var $specimen_type
 * @var $specimen_slides
 * @var $specimen_block_type
 * @var $specimen_site
 * @var $specimen_block
 * @var $specimen_right
 * @var $specimen_left
 * @var $specimen_na
 * @var $specimen_urgent
 * @var $specimen_hsc_205
 * @var $clinicianNames
 * 
 */
$request_id = 0;
foreach ($query1 as $row1) :

    global $serial_number;
    global $pci_number;
    global $first_name;
    global $sur_name;
    global $emis_number;
    global $lab_number;
    global $nhs_number;
    global $dob;
    global $age;
    global $gender;
    global $clrk;
    global $dermatological_surgeon;
    global $date_taken;
    global $converted_time;
    global $last_modify_publish;
    global $date_rec_bylab;
    global $date_rec_by_doctor;
    global $lab_release_date;
    global $h_group_id;
    global $p_date;
    global $p_date_time;

    $id = $row1->id;
    $time = $row1->publish_datetime;
    $clinicianNames = $copy_to;

    $converted_time = '';
    $request_id = $row1->uralensis_request_id;
    if ($time != '') {
        $converted_time = date('d-m-Y', strtotime($time));
    }
    $last_modify_publish = '';
    if (!empty($row1->publish_datetime_modified)) {
        $last_modify_publish = date('d-m-Y', $row1->publish_datetime_modified);
        $last_modify_publish = '<tr><td>Latest Published Date : </td><td>' . $last_modify_publish . '</td></tr>';
    }
    if (!empty($row1->date_sent_touralensis)) {
        $lab_release_date = date('d-m-Y', strtotime($row1->date_sent_touralensis));
        $lab_release_date = '<tr><td>Lab Released Date : </td><td>' . $lab_release_date . '</td></tr>';
    }
    if (!empty($row1->date_rec_by_doctor)) {
        $date_rec_by_doctor = date('d-m-Y', strtotime($row1->date_rec_by_doctor));
        $date_rec_by_doctor = '<tr><td>Date Received by Dr : </td><td>' . $date_rec_by_doctor . '</td></tr>';
    }

    //Get the age if first, surname, and date of birth is empty.
    $age = '<tr><td>Age : </td><td></td></tr>';
    $gender = '<tr><td>Gender : </td><td></td></tr>';
    if (!empty($row1->age)) {
        $age = '<tr><td>Age : </td><td>' . $row1->age . '</td></tr>';
    }

    if (!empty($row1->gender)) {
        $gender = '<tr><td>Gender : </td><td>' . $row1->gender . '</td></tr>';
    }

    $serial_number = $row1->serial_number;
    $pci_number = $row1->pci_number;
    $emis_number = $row1->emis_number;
    $nhs_number = $row1->nhs_number;
    $lab_number = $row1->lab_number;
    $hos_number = $row1->hos_number;
    $sur_name = $row1->sur_name;
    $first_name = $row1->f_name;
	$dob = $row1->dob;
	$r_date = $row1->request_datetime;
	$p_date = !empty($row1->publish_datetime) ? date('d-m-Y', strtotime($row1->publish_datetime)) : 'N/A';
	$p_date_time = !empty($row1->publish_datetime) ? date('d-m-Y h:i', strtotime($row1->publish_datetime)) : 'N/A';

    $dermatological_surgeon = $row1->dermatological_surgeon;
    if (!empty($row1->dermatological_surgeon) && ctype_digit($row1->dermatological_surgeon)) {
        $dermatological_surgeon = uralensisGetUsername($row1->dermatological_surgeon, 'fullname');
    }
    $var = $row1->dob;
    $dob = '';
    if (!empty($var)) {
        $date = str_replace('/', '-', $var);
        $change_dob = date('d-m-Y', strtotime($date));
        $dob = !empty($change_dob) ? $change_dob : '';
    }
    
    $clrk = $row1->clrk;
    if (!empty($row1->clrk) && ctype_digit($row1->clrk)) {
        $clrk = uralensisGetUsername($row1->clrk, 'fullname');
    }
    $date_taken = !empty($row1->date_taken) ? date('d-m-Y', strtotime($row1->date_taken)) : '';
    $urgent = $row1->urgent;
    $hsc = $row1->hsc;
    $cl_detail = $row1->cl_detail;
    $date_rec_bylab = !empty($row1->date_received_bylab) ? date('d-m-Y', strtotime($row1->date_received_bylab)) : 'N/A';
    $Result_clinical = str_replace("\n", '<br />', $cl_detail);
    $comment_section = $row1->comment_section;
    $comment_section_date = $row1->comment_section_date;
    $h_group_id = $row1->hospital_group_id;
endforeach;
foreach ($query4 as $row4) {
    $additional_work = $row4->description;
    $Result_additional = str_replace("\n", '<br />', $additional_work);
    $additional_work_time = $row4->additional_work_time;
}
foreach ($query2 as $row2) :
    $specimen_type = $row2->specimen_type;
    $specimen_site = $row2->specimen_site;
    $specimen_right = $row2->specimen_right;
    $specimen_left = $row2->specimen_left;
    $specimen_na = $row2->specimen_na;
    $user_first_name = $row2->first_name;
    $user_last_name = $row2->last_name;
    $user_email = $row2->email;
    $user_phone = $row2->phone;
    $gmc_code = $row2->gmc_code;
endforeach;

foreach ($query5 as $row5) :
    global $hospital_information;
   // $hospital_information = $row5->information;
    $hospital_information = "<b style='font-size:20px'>Histopathology Report</b>";
endforeach;

if(isset($template)){
    global $templateVal;
    $templateVal = $template;
}
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
        global $h_group_id;
        global $dob;
        global $age;
        global $gender;
        global $clrk;
        global $dermatological_surgeon;
        global $date_taken;
        global $converted_time;
        global $last_modify_publish;
        global $date_rec_bylab;
        global $date_rec_by_doctor;
        global $lab_release_date;
        global $h_group_id;
        global $templateVal;
        global $p_date;
        global $p_date_time;

        $logoVal = (isset($templateVal['logo_path'])) ? base_url().$templateVal['logo_path'] : ''; //https://www.pci.pathhub.uk/application/helpers/tcpdf/live_login_logo.jpg
        $headerText = (isset($templateVal['header'])) ? $templateVal['header'] : '';

        //pre($templateVal);
        $derm_surgeon = '';
        if (!empty($dermatological_surgeon)) {
            //$derm_surgeon = '<tr><td>Dermatological Surgeon : </td><td>' . $dermatological_surgeon . '</td></tr>';
        }
        
		//$ura_logo = base_url('application/helpers/tcpdf/live_login_logo.jpg');
		
		
		
        if (!empty($h_group_id)) {
            $res = get_institute_logo($h_group_id);
            if (!empty($res)) {
                $ura_logo = base_url($res);
            }
        }
		
		//$logoVal = "https://pci.pathhub.uk/uploads/logo/live_login.png";


        $header_text = <<<EOD
 	
		<table id="pdf_download" style="font-size: 13px; width:100%; margin: 0 auto; font-family: 'Poppins', sans-serif !important;">		
            <tr>
                <td style="font-size:36px;" >								
                    <table>
                        <tr><td style="font-size:36px; color:blue" align="left"><img src="$logoVal" alt="logo" style='width: 20px; height: 20px'></td></tr>
                        <tr rowspan="3"><td></td></tr>						 
						<tr rowspan="3"><td style="font-size:14px;" align="left">$headerText</td></tr>
                    </table>
                </td>							
                <td>
                    <table>							
                        <tr>
                            <td>
                                <table>							
                                    <tr><td><br></td><td><br></td></tr>
                                    <tr><td>Serial number:</td><td><b>$serial_number</b></td></tr>
                                    <tr><td>PCI number:</td><td><b>$pci_number</b></td></tr>
                                    <tr><td>Patient:</td><td><b>$first_name $sur_name</b></td></tr>
                                    <tr><td>EMIS:</td><td><br></td></tr>                                    
                                    <tr><td>NHS Ref:</td><td>$nhs_number</td></tr>
                                    <tr><td>Date of Birth:</td><td>$dob</td></tr>																					
                                    $age
                                    $gender														
                                    <tr><td>Date Receive By Lab:</td><td>$date_rec_bylab</td></tr>                                   
                                    <tr><td>Publish Date:</td><td>$p_date</td></tr>
                                    $lab_release_date
                                    <tr><td>Received By Dr:</td><td>$date_rec_bylab</td></tr>
                                </table>
                            </td>
                        </tr>	
                    </table>
                </td>
            </tr>
			
        </table>   
		<table><tr><td>&nbsp;</td></tr><tr><td><div style="border-bottom:1px solid black;"></div></td></tr></table>            
EOD;
        $this->SetY(0);
        //$this->SetFont('times', 10);
        $this->writeHTMLCell(0, 0, 5, 5, $header_text, 0, 0, 0, false, false);
    }

    public function Footer() 
	{
        global $hospital_information;
        global $templateVal;
        global $user_first_name;
        global $user_last_name;
        global $gmc_code;
        global $user_email;
        global $user_phone;

        $footer_text = $hospital_information;
        if($templateVal){
            $footerText = (isset($templateVal['footer'])) ? $templateVal['footer'] : '';
            $footerText = str_replace("<DOCNAME>", "Dr. $user_first_name $user_last_name ", $footerText);
            $footerText = str_replace("<DOCGMC>", "$gmc_code ", $footerText);
            $footerText = str_replace("<DOCEMAIL>", "$user_email ", $footerText);
            $footerText = str_replace("<DOCCONTACT>", "$user_phone ", $footerText);
        }

       /* $this->SetY(-30);
        $this->SetFont('times', 16);

        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 0, 25, $footer_text, 0, 0, 0, true, true);*/
		
		 $this->SetFont('helvetica', 15);
       // $this->Cell(0, 15, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
	    //$this->Cell(0, 25, $footer_text_val, 0, true, 'C', 0, '', 0, true, 'T', 'B');
        //$this->writeHTMLCell(0, 0, 0, 25, $footer_text_val, 0, 0, 0, true, true);
		$this->writeHTML($footerText,true, false, true, false, '');
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Poundbury Cancer Institite');
$pdf->SetTitle('Poundbury Cancer Institite').' - ' . $serial_number;
$pdf->SetSubject('Histopathology Report');
$pdf->SetHeaderData($ura_logo, PDF_HEADER_LOGO_WIDTH, 'Histopathology Report', 'Histopathology Report');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED,12);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(10, 75, 10);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 18);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//$pdf->SetFont('times', 12);
$pdf->AddPage();
$pdf->SetY(80);

if (!empty($cl_detail)) 
{
    $html = '<table>
    <tr>
        <td width="20%"><b>Clinical Detail: </b></td>
        <td width="80%">' . $Result_clinical . '</td>
    </tr>
    <br />
</table>
';
} else {
    $specimen_count = 1;
    foreach ($query2 as $specimen_data) {
        $specimen_result_clinical = str_replace("\n", '<br />', $specimen_data->specimen_clinical_history);

        $html .= '<table>
        <tr><td width="20%"><strong>Copy to : </strong><br></td></tr>
        <tr><td width="80%">'.$clinicianNames.'<br></td></tr>
    <tr>
        <td width="20%"><b>Clinical Detail: </b></td>
        <td width="80%">' . $specimen_result_clinical . '</td>
    </tr>
    <br />
</table>
';
        $specimen_count++;
		break;
    }
}

$count = 1;
foreach ($query2 as $row2) :
    $Result_macro = str_replace("\n", '<br />', $row2->specimen_macroscopic_description);
    $Result_micro = str_replace("\n", '<br />', $row2->specimen_microscopic_description);
    $diagnosis = !empty($row2->specimen_diagnosis_description) ? $row2->specimen_diagnosis_description : '';
    $Result_diagnosis = str_replace("\n", '<br />', $diagnosis);
    $html .= '<div style="border-bottom:1px solid black;"></div><br />
    <table>
	<tr>
            <td style="font-size:17px;">&nbsp;</td>
            
        </tr>
        <tr>
            <td style="font-size:17px;"><b>Specimen ' . $count . '</b></td>
            
        </tr>
      
        <tr>
            <td width="20%"><b>Specimen:</b></td>
           
            <td width="80%">' . ucfirst($row2->specimen_type) . '&nbsp;' . $row2->specimen_right . '&nbsp;' . $row2->specimen_left . '&nbsp;' . $row2->specimen_na . '&nbsp;' . $row2->specimen_site . '
            </td>
        </tr>
        <br />
        <tr>
            <td width="20%"><b>Macroscopic: </b></td>
           
            <td width="80%">' . $Result_macro . '</td>
        </tr>
        <br />
        <tr>
            <td width="20%"><b>Microscopic: </b></td>
      
            <td width="80%">' . $Result_micro . '</td>
        </tr>
        <br />
    </table>';

    if (!empty($diagnosis)) {
        $html .='<table>
            <br /><br />
        <tr>
            <td width="20%"><b>Diagnosis :</b></td>
          
            <td width="80%">' . $diagnosis . '</td>
        </tr>
    </table>';
    }

    if (empty($comment_section)) {
        if (!empty($row2->specimen_comment_section)) {
            $format_specimen_comments = str_replace("\n", '<br />', $row2->specimen_comment_section);
            $specimen_comments_time = '';
            if ($row2->specimen_comment_section_timestamp != '') {
                $specimen_comments_time = date('M j Y', $row2->specimen_comment_section_timestamp);
            }
            $html .='
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
    <tr>
        <td><b>Additional Comments (Specimen ' . $count . ')  &nbsp; | &nbsp; Comment Date: ' . $specimen_comments_time . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $format_specimen_comments . '</td>
    </tr>
</table>

';
        }
    }
    
    $count++;
endforeach;

$supp_count = 1;
foreach ($query4 as $row4) {
    $additional_work = $row4->description;
    $Result_additional = str_replace("\n", '<br />', $additional_work);
    $additional_work_time = $row4->additional_work_time;
    if (isset($Result_additional) && $Result_additional != '') :

        $html .= '
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
<tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><b>Supplementary Report ' . $supp_count . ' &nbsp; | &nbsp; Requested Time : ' . date('M j Y g:i A', strtotime($additional_work_time)) . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $Result_additional . '</td>
    </tr>
</table>
';
    endif;
    $supp_count++;
}

if (isset($comment_section) && $comment_section != '') {
    $format_comments = str_replace("\n", '<br />', $comment_section);
    $comment_date = '';
    if($comment_section_date != ''){
        $comment_date = date('M j Y', strtotime($comment_section_date));
    }
    
    $html .='
<br /><br />
<div style="border-bottom:1px solid black;"></div>
<table>
<tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><b>Additional Comments  &nbsp; | &nbsp; Comment Date : ' . $comment_date . ' </b></td>
    </tr>
    <br />
    <tr>
        <td>' . $format_comments . '</td>
    </tr>
</table>

';
}

if ($query1[0]->mdt_case_status === 'not_for_mdt' && $query1[0]->mdt_case === 'add_to_report') {
    $html .='
<div style="border-bottom:1px solid black;"></div>
<table>
<tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td style="font-size:14px;"><b>This case is NOT required for the Local Skin MDT</b></td>
    </tr>
</table>
';
}
if ($query1[0]->mdt_case_status === 'for_mdt' && !empty($query1[0]->mdt_case)) {
    $html .='
<div style="border-bottom:1px solid black;"></div>
<table>
<tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td style="font-size:14px;"><b>This case should be listed for the Local Skin MDT</b></td>
    </tr>
</table>
';
}

if ($query1[0]->mdt_case_status === 'for_mdt') {
    if (!empty($query1[0]->mdt_specimen_status)) {
        $specimen_data = unserialize($query1[0]->mdt_specimen_status);
        $html .='
<table>
<tr>
<tr>
        <td>&nbsp;</td>
    </tr>
        <td style="font-size:14px; width:120px;"><b>MDT Specimens.</b></td>
';
        foreach ($specimen_data as $specimen_mdt) {
            $html .='
        <td style="font-size:14px; width:100px;"><b>' . $specimen_mdt . '</b></td>
    ';
        }
        $html .='</tr></table>
';
    }
}

if($templateVal){
    $footerText = (isset($templateVal['footer'])) ? $templateVal['footer'] : '';
    $footerText = str_replace("<DOCNAME>", "Dr. $user_first_name $user_last_name ", $footerText);
    $footerText = str_replace("<DOCGMC>", "$gmc_code ", $footerText);
    $footerText = str_replace("<DOCEMAIL>", "$user_email ", $footerText);
    $footerText = str_replace("<DOCCONTACT>", "$user_phone ", $footerText);
}

/*$html .='
<br /><br />
<div style="border-bottom:1px solid black;"></div>


<table>
    <tr><td style="font-size:14px;"><b>'. $footerText .'</b></td></tr>
</table>

';*/
$pdf->writeHTML($html, true, false, true, false, '');
$file_name = $serial_number . '_Report_' . $first_name . '_' . $sur_name . '_' . date('dMY') . '.pdf';
ob_end_clean();
if ($query1[0]->actionType == '') {
    $pdf->Output($file_name, 'I');
}

if($action == 'published'){
    $StoreLocation = $_SERVER['DOCUMENT_ROOT'].'/uploads/reports_pdf/';
    if (!file_exists($StoreLocation)) {
        mkdir($StoreLocation, 0777, true);
    }
    if(!file_exists($StoreLocation.$request_id."_".date('Y').'.pdf')){
        $file_name1 =  $StoreLocation.$request_id."_".date('Y').'.pdf';
        $pdf->Output($file_name1, 'F');    
    }
}
if($query1[0]->actionType == 'regenerate'){
    $StoreLocation = $_SERVER['DOCUMENT_ROOT'].'/uploads/reports_pdf/';
    if (!file_exists($StoreLocation)) {
        mkdir($StoreLocation, 0777, true);
    }
    $file_name1 =  $StoreLocation.$request_id."_".date('Y').'.pdf';
    $pdf->Output($file_name1, 'F');
}
