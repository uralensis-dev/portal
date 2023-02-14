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
 * @var $ap_coroner_reference
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
 * @var $death_datetime
 * @var $examination_datetime
 * @var $gmc_code
 */
foreach ($query1 as $row1) :

    global $serial_number;
    global $ap_pm_number;
    global $first_name;
    global $sur_name;
    global $ap_coroner_reference;
    global $lab_number;
    global $nhs_number;
    global $dob;
    global $age;
    global $gender;
    global $death_datetime;
    global $examination_datetime;
    global $clrk;
    global $dermatological_surgeon;
    global $date_taken;
    global $converted_time;
    global $last_modify_publish;
    global $date_rec_bylab;
    global $date_rec_by_doctor;
    global $lab_release_date;
    global $h_group_id;
    global $gmc_code;

    $id = $row1->id;
    $time = $row1->publish_datetime;

    $converted_time = '';
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

    $age = '<tr><td>Age : </td><td></td></tr>';
    $gender = '<tr><td>Gender : </td><td></td></tr>';
    $clinician = '<tr><td>Clinician : </td><td></td></tr>';
    $clinic_date = '<tr><td>Clinic Date : </td><td></td></tr>';
    $rec_lab_date = '<tr><td>Date Received By Lab : </td><td></td></tr>';
    $published_date = '<tr><td>Date Published : </td><td></td></tr>';
    $death_datetime = '<tr><td>Date of Death : </td><td></td></tr>';
    $examination_datetime = '<tr><td>Date of Autopsy : </td><td></td></tr>';
    if(!empty($row1->age)){
        $age = '<tr><td>Age : </td><td>' . $row1->age . '</td></tr>';
    }

    if(!empty($row1->gender)){
        $gender = '<tr><td>Gender : </td><td>' . $row1->gender . '</td></tr>';
    }
    if(!empty($row1->clrk)){
        $clinician = '<tr><td>Clinician : </td><td>' . uralensisGetUsername($row1->clrk, 'fullname') . '</td></tr>';
    }
    if(!empty($row1->date_taken)){
        $clinic_date = '<tr><td>Clinic Date : </td><td>' . date('d-m-Y', strtotime($row1->date_taken)) . '</td></tr>';
    }
    if(!empty($row1->date_received_bylab)){
        $rec_lab_date = '<tr><td>Date Received By Lab : </td><td>' . date('d-m-Y', strtotime($row1->date_received_bylab)) . '</td></tr>';
    }
    if(!empty($row1->publish_datetime)){
        $published_date = '<tr><td>Date Published : </td><td>' . date('d-m-Y', strtotime($row1->publish_datetime)) . '</td></tr>';
    }

    if(!empty($row1->ap_death_datetime)){
        $death_datetime = '<tr><td>Date of Death : </td><td>' . date('d-m-Y H:i', strtotime($row1->ap_death_datetime)) . '</td></tr>';
    }
    if(!empty($row1->ap_examination_datetime)){
        $examination_datetime = '<tr><td>Date of Autopsy : </td><td>' . date('d-m-Y H:i', strtotime($row1->ap_examination_datetime)) . '</td></tr>';
    }
    $serial_number = $row1->serial_number;
    $ap_pm_number = $row1->ap_pm_number;
    $ap_coroner_reference = $row1->ap_coroner_reference;
    $nhs_number = $row1->nhs_number;
    $lab_number = $row1->lab_number;
    $hos_number = $row1->hos_number;
    $sur_name = strtoupper($row1->sur_name);
    $first_name = strtoupper($row1->f_name);

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
    $date_rec_bylab = !empty($row1->date_received_bylab) ? date('d-m-Y', strtotime($row1->date_received_bylab)) : '';
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
    $user_first_name = strtoupper($row2->first_name);
    $user_last_name = strtoupper($row2->last_name);
    $user_email = $row2->email;
    $user_phone = $row2->phone;
    $gmc_code = $row2->gmc_code;
endforeach;

foreach ($query5 as $row5) :
    global $hospital_information;
    $hospital_information = $row5->information;
endforeach;
$hospital_information = '<table>
    <tr>
         <td  width="25%" style="font-size:13px;text-align:right;">
			<table>
                        <tr><td><b>From:</b></td></tr>
                        <tr><td><b>University Hospitals Plymouth</b></td></tr>
                        <tr><td>Derriford Hospital </td></tr>
			<tr><td>Derriford Rd</td></tr>
	                <tr><td>Plymouth</td></tr>
	                <tr><td>PL6 8DH</td></tr>
            </table>
         </td>
		 <td width="3.7%"></td>
		 <td width="30%" style="font-size:13.5px;text-align:left;">
             <table>
						<tr><td><b>To:</b></td></tr>
						<tr><td><b>H M Coroners Office</b></td></tr> 
						<tr><td>1, Derriford Business Park, Derriford Park, Plymouth</td></tr>  
						<tr><td>PL6 5QZ </td></tr>
						<tr><td>Account Holder:  </td></tr>
             </table>
         </td>
    </tr>
</table>';
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

/**
 * MYPDF extends TCPDF
 *
 * @author     Uralensis <info@oxbridgemedica.com>
 * @version    1.0.0
 */

class MYPDF extends TCPDF
{

    public function Header()
    {

        global $serial_number;
        global $ap_pm_number;
        global $first_name;
        global $sur_name;
        global $ap_coroner_reference;
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
        global $death_datetime;
        global $examination_datetime;
        $derm_surgeon = '';
        if (!empty($dermatological_surgeon)) {
            $derm_surgeon = '<tr><td>Dermatological Surgeon : </td><td>' . $dermatological_surgeon . '</td></tr>';
        }

        if (!empty($h_group_id)) {
            switch($h_group_id) {
                case 9:
                    $ura_logo = base_url('/application/helpers/tcpdf/plymouth-hospitals.jpeg');
                    break;
                case 18:
                    $ura_logo = base_url('/application/helpers/tcpdf/torbay-and-south-devon.jpeg');
                    break;
                case 54:
                    $ura_logo = base_url('/application/helpers/tcpdf/royal-cornwall-hospitals.jpeg');
                    break;
                case 55:
                    $ura_logo = base_url('/application/helpers/tcpdf/royal-devon-and-exeter.jpeg');
                    break;
                default:
                    $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
            }
        } else {
            $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');
        }
        $header_text = <<<EOD
                
<table width="100%">
    <tr>
        <td width="25%" align="left">
            <img width="180px" src="$ura_logo" />
        </td>
        <td width="32%" align="center" style="font-size:20px;"><b>Autopsy Report</b></td>
        <td width="50%" align="right">
            <table style="font-size:12.5px;text-align:left;">
                <tr><td width="45%">Serial Number : </td><td><b>$serial_number</b></td></tr>
                <tr><td>PM Number : </td><td><b>$ap_pm_number</b></td></tr>
                <tr><td>Patient Name : </td><td><b>$first_name $sur_name</b></td></tr>
                <tr><td>Coroner's Reference : </td><td><b>$ap_coroner_reference</b></td></tr>
<!--                <tr><td>LAB Ref : </td><td>$lab_number</td></tr>-->
                <tr><td>NHS Ref : </td><td>$nhs_number</td></tr>
                <tr><td>Date of Birth : </td><td>$dob</td></tr>
                $age
                $gender
                $death_datetime
                $examination_datetime
                
            </table>
        </td>
    </tr>
<p style="font-size: 18px; font-weight: bold; text-align: center;">THIS REPORT IS CONFIDENTIAL.  IT SHOULD NOT BE DISCLOSED TO A THIRD PARTY WITHOUT THE CORONER’S CONSENT. </p>
EOD;
        $this->SetY(0);
        $this->SetFont('times', 10);
        $this->writeHTMLCell(0, 0, 5, 5, $header_text, 0, 0, 0, false, false);
    }

// Removed from Header
//$clinician
//$derm_surgeon
//$clinic_date
//$rec_lab_date
//$published_date
//$last_modify_publish
//$lab_release_date
//$date_rec_by_doctor

    public function Footer()
    {
        global $hospital_information;
        $footer_text = $hospital_information;
        $this->SetY(-30);
        $this->SetFont('times', 16);

        $this->Cell(0, 25, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'B');
        $this->writeHTMLCell(0, 0, 0, 25, $footer_text, 0, 0, 0, true, true);
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
$pdf->SetMargins(5, PDF_MARGIN_TOP + 55, 5);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('times', 12);

$pdf->AddPage();
$pdf->SetY(80);

$html = '
	<div class="container" style="max-width: 700px;margin: 0 auto; overflow: hidden;">
		<p style="font-size: 18px; text-align: center;">POST-MORTEM EXAMINATION</p>
		<p style="font-size: 18px; font-weight: bold;">Name of deceased: <span style="font-weight: normal;">'.$first_name.' '.$sur_name.'</span>  </p>

		<table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #000; margin-bottom: 30px; width: 100%; text-align: left;">
			<thead>
				<tr>
					<th style="padding: 5px 15px; font-weight: bold;">Identified by</th>
					<th style="padding: 5px 15px; font-weight: bold;">Place of examination</th>
					<th style="padding: 5px 15px; font-weight: bold;">Date & time of examination</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding: 5px 15px;">'.$name_identified_by.'</td>
					<td style="padding: 5px 15px;">'.$query1[0]->ap_examination_place.'</td>
					<td style="padding: 5px 15px;">'.date('d-m-Y H:i:s', strtotime($query1[0]->ap_examination_datetime)).'</td>
				</tr>
			</tbody>
		</table>
		<p><strong style="border-bottom: 1px solid #000; margin-bottom: 20px">History</strong></p>
		<p style="margin: 5px 0;"><strong>Circumstances of death:</strong></p>
		<p style="margin: 5px 0 30px;">'.$query1[0]->ap_death_circumstance.'</p>

		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000;">EXTERNAL EXAMINATION</div>
		<p style="text-align: justify;">'.$query1[0]->ap_external_exam_desc.'</p>


		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">INTERNAL EXAMINATION</div>
		<div style="font-size: 20px; font-weight: bold; margin-top: 15px;">Head and nervous system: </div>
		<p style="margin: 5px 0; text-align: justify;">Heart <strong>'.round($query1[0]->ap_heart_weight_gm).'(g)</strong>: Appeared normal externally. The pericardium was '.$query1[0]->ap_pericardium.'. The coronary arteries were all of small calibre with minimal atheroma ((left anterior descending artery, right coronary artery, and circumflex arteries).  The heart showed right dominance. The valves were normal. The myocardium showed a very recent small focal posterior myocardial infarction. </p>
		<p style="margin: 5px 0;">Aorta and Great Veins: '.$query1[0]->ap_aorta_great_veins.'.</p>
		

		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">Respiratory system:  </div>
		<p style="margin:5px 0;">
			Larynx and Trachea: '.$query1[0]->ap_lyranx_trachea.'
		</p>
		<p style="margin:5px 0;">
			Bronchi: '.$query1[0]->ap_bronchi.'
		</p>
		<p style="margin:5px 0;">
			Lungs (left '.round($query1[0]->ap_lt_lung_weight_gm).' g, right '.round($query1[0]->ap_rt_lung_weight_gm).' g): '.$query1[0]->ap_lungs.'
		</p>
		<p style="margin:5px 0;">
			Pleura: '.$query1[0]->ap_pleura.'
		</p>

		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">Alimentary system:   </div>
		<p style="margin:5px 0;">
			Mouth, tongue, pharynx, oesophagus: '.$query1[0]->ap_mouth_t_phyr_oesophagus.'
		</p>
		<p style="margin:5px 0;">
			Stomach: '.$query1[0]->ap_stomach.'
		</p>
		<p style="margin:5px 0;">
			Small and large intestines: '.$query1[0]->ap_sm_lg_intestine.' 
		</p>
		<p style="margin:5px 0;">
			Liver '.round($query1[0]->ap_liver_weight_gm).' (g): '.$query1[0]->ap_liver.' 
		</p>
		<p style="margin:5px 0;">
			Gall bladder: '.$query1[0]->ap_gall_bladder.' 
		</p>
		<p style="margin:5px 0;">
			Pancreas: '.$query1[0]->ap_pancreas.' 
		</p>
		<p style="margin: 5px 0">Peritoneum: '.$query1[0]->ap_peritoneum.' </p>

		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">Genito-urinary system: </div>
		<p style="margin:5px 0;">Kidneys <strong>(right '.$query1[0]->ap_rt_kidney_weight_gm.' g, left '.$query1[0]->ap_lt_kidney_weight_gm.' g)</strong>: '.$query1[0]->ap_kidneys.'  </p>
		<p style="margin:5px 0;">Ureters, bladder: '.$query1[0]->ap_uretus_bladder.'</p>
		<p style="margin:5px 0;">Uterus, cervix, ovaries: '.$query1[0]->ap_uterus_cerv_overies.'  </p>
		<p style="margin:5px 0;">Prostate: '.$query1[0]->ap_prostate.' </p>
		<p style="margin:5px 0;">External genitalia: '.$query1[0]->ap_external_genitalia.' </p>


		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">Reticulo-endothelial system:</div>
		<p style="margin:5px 0;">Spleen '.round($query1[0]->ap_spleen_weight_gm).' (g): '.$query1[0]->ap_spleen.' </p>
		<p style="margin:5px 0;">Lymph nodes: '.$query1[0]->ap_lymph_nodes.'</p>
		<p style="margin:5px 0;">Thymus: '.$query1[0]->ap_thymus.'</p>


		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">Endocrine system:</div>
		<p style="margin:5px 0;">Thyroid, adrenals: '.$query1[0]->ap_thyroid_adrenals.'  </p>
		<p style="margin:5px 0;">Pituitary gland: '.$query1[0]->ap_pituitary_gland.'</p>


		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">Musculoskeletal system:</div>
		<p style="margin:5px 0;">'.$query1[0]->ap_musculoskeletal.'</p>


		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">PATHOLOGICAL FINDINGS: </div>';
        $path_finding_obj = json_decode($query1[0]->ap_pathological_finding);
        if(!empty($path_finding_obj)){
            foreach ($path_finding_obj as $key=>$val){
                $html.='<p style="margin:5px 0;">'.$val.'</p>';
            }
        }else{
            $html.='<p style="margin:5px 0;"></p>';
        }
		$html.='<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">HISTOPATHOLOGICAL FINDINGS: </div> ';
        $h_path_finding_obj = json_decode($query1[0]->ap_histopathological_finding);
        if(!empty($h_path_finding_obj)){
            foreach ($h_path_finding_obj as $key=>$val){
                $html.='<p style="margin:5px 0;">'.$val.'</p>';
            }
        }else{
            $html.='<p style="margin:5px 0;"></p>';
        }
        $html.='
        <div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">TOXICOLOGY REPORT:</div>
		<p style="margin:5px 0;">'.$query1[0]->ap_toxicology_report.'</p>

		
		<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">CAUSE OF DEATH:</div>
		';
        $c_of_death_obj = json_decode($query1[0]->ap_cause_of_death, true);
        $key="";
        $val="";
        $itrr=1;
        if(!empty($c_of_death_obj)){
            $label = "";
            foreach ($c_of_death_obj as $key=>$val){
                if($itrr==1){
                    $label="1a";
                }elseif ($itrr==2){ $label="1b";}
                elseif ($itrr==3){ $label="1c";}
                else{$label=2;}
                $html.='<p style="margin:5px 0;"><strong>'.$label.': </strong> '.$val.'</p>';
                $itrr=$itrr+1;
                    }
        }else{
            $html.='<p style="margin:5px 0;"><strong>: </strong></p>';
             }
		$html.='<div style="font-size: 20px; font-weight: bold; border-top: 1px solid #000; margin-top: 30px;">COMMENTS</div>
		<p style="margin:5px 0; text-align: justify;"> '.$query1[0]->ap_comments.'</p>
		<p style="margin:5px 0; border-top: 1px solid #000;">Signature, title and Qualification:             </p>
		<p style="margin:5px 0;">signature here</p>
		

		<p style="margin:5px 0;">Consultant Histopathologist</p> <p style="margin:5px 0;">';
    $relevant_doctors_obj = json_decode($query1[0]->ap_relevant_doctors, true);
        if(!empty($relevant_doctors_obj)){
            $doctors_list = "";
            foreach ($relevant_doctors_obj as $rel_docs){
                 $userinfo = getLoggedInUserProfile(intval($rel_docs));
                 $doctors_list .= $userinfo[0]->first_name.' '.$userinfo[0]->last_name.', ';
                $doctors_lists = rtrim($doctors_list, ", ");
            }
            $html.= $doctors_lists;
        }
		$html.='</p> <p style="margin:5px 0;">MBChB, FRCPath                       					 </p>
		<p style="margin:5px 0;">GMC No. '.$gmc_code.'</p>

		<p style="margin:15px 0;">Name in BLOCK LETTERS:  <span style="margin-left: 30px;">' . $user_first_name . ' ' . $user_last_name . '.</span></p>
	</div>
';

$pdf->writeHTML($html, true, false, true, false, '');
$file_name = $serial_number . '_Report_' . $first_name . '_' . $sur_name . '_' . date('dMY') . '.pdf';
ob_end_clean();
$pdf->Output($file_name, 'I');
