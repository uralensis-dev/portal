<?php

defined('BASEPATH') or exit('No direct script access allowed');

// Include the main TCPDF library (search for installation path).
require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

class Gen_pdf extends CI_Controller {

    public function __construct() {

        parent::__construct();
        error_reporting(0);
        $this->load->model('Ion_auth_model');
        $this->load->helper(array('form', 'url', 'file', 'cookie', 'activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
    }

    public function index() {
        if ($this->uri->segment(4) > 0 && $this->uri->segment(4) != '') {

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $html_response = '';
            $get_bcc_record = get_bcc_dataset_record($this->uri->segment(4), '');
            $_PDF_html = '';
            $_PDF_head = '
               <table border="1" cellpadding="2" cellspacing="" align="center">
                    <tr style="color:black;font-size:18px;font-weight:bold"><td colspan="5">Patient Information</td></tr>
                    <tr>
                        <td><b>Name: </b> ' . urldecode($this->uri->segment(6)) . ' </td>
                        <td><b>DOB: </b> ' . urldecode($this->uri->segment(9)) . ' </td>
                        <td><b>NHS: </b> ' . urldecode($this->uri->segment(10)) . ' </td>
                        <td><b>Gender: </b> ' . urldecode($this->uri->segment(11)) . ' </td>
                        <td><b>Lab No.: </b> ' . urldecode($this->uri->segment(12)) . ' </td>
                    </tr>
                </table>';
            if (!empty($get_bcc_record)) {
                for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
                    $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                    $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);

                    $_PDF_html .= $_PDF_head . '<table border="1" cellpadding="2" cellspacing="1" align="center">';
                    $_PDF_html .= '<tr rowspan="2" style="color:black;font-size:18px;font-weight:bold"><td colspan="2">Specimen ' . $get_bcc_record[$clinical_arr]['patient_specimen'] . '</td></tr>';
                    $data_arr = '';
                    foreach ($data_set as $key => $val) {

                        if ($this->uri->segment(13) != '') {

                            if ($this->uri->segment(13) == 'clinical') {
                                $data_arr = array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther');
                            }
                            if ($this->uri->segment(13) == 'macro') {
                                $data_arr = array('specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic');
                            }
                            if ($this->uri->segment(13) == 'micro') {
                                $data_arr = array('Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal');
                            }
                        } else {
                            $data_arr = array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther', 'specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic', 'Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal', 'ptnm', 'ptnm_N', 'ptnm_M', 'bcc_comments');
                        }

                        if (in_array($key, $data_arr)) {

                            if ($key == 'clinicaldimention') {
                                $key = 'Maximum clinical dimension/diameter';
                                $val = $val . ' mm';
                            }
                            if ($key == 'Specimen_type') {
                                $key = 'Specimen type';
                            }
                            if ($key == 'CDOther') {
                                $key = 'Other';
                            }
                            if ($key == 'specimendimention1') {
                                $key = 'Dimension of specimen (Length)';
                                $val = $val . ' mm';
                            }
                            if ($key == 'specimendimention2') {
                                $key = '(Breath)';
                                $val = $val . ' mm';
                            }
                            if ($key == 'specimendimention3') {
                                $key = '(Depth)';
                                $val = $val . ' mm';
                            }
                            if ($key == 'MDMacroscopic_description') {
                                $key = 'Maximum dimension';
                                $val = $val . ' mm';
                            }
                            if ($key == 'Macroscopic') {
                                $key = 'Diameter of lesion';
                            }
                            if ($key == 'Histological_low') {
                                $key = 'Low risk subtype';
                            }
                            if ($key == 'n_invasion') {
                                $key = 'Perineural invasion† :**';
                            }
                            if ($key == 'n_invasion_present') {
                                $key = 'If present: Meets criteria to upstage pT1/pT2 to pT3?**';
                            }
                            if ($key == 'n_invasion_yes_m') {
                                $key = 'If yes: Named nerve';
                            }
                            if ($key == 'n_Peripheral') {
                                $key = 'Margins†: (Peripheral)';
                            }
                            if ($key == 'n_Deep') {
                                $key = 'Margins†: (Deep)';
                            }
                            if ($key == 'Maximum_Indicate') {
                                $key = 'Maximum dimension/diameter of lesion (Indicate which used)';
                            }
                            if ($key == 'Maximum_Dimention') {
                                $key = '(Dimension)';
                            }
                            if ($key == 'Histological_high') {
                                $key = 'High risk if present';
                            }
                            if ($key == 'n_Histological_Specify_tissue') {
                                $key = 'Specify tissue';
                            }
                            if ($key == 'n_bone_minor') {
                                $key = 'Minor bone erosion';
                            }
                            if ($key == 'n_bone_gross') {
                                $key = 'Gross cortical/marrow invasion';
                            }
                            if ($key == 'n_bone_foraminal') {
                                $key = 'Axial/skull base/foraminal invasion';
                            }
                            if ($key == 'ptnm') {
                                $key = 'pTNM pT';
                            }
                            if ($key == 'ptnm_N') {
                                $key = 'pTNM pN';
                            }
                            if ($key == 'ptnm_M') {
                                $key = 'Distant metastasis M';
                            }
                            if ($key == 'bcc_comments') {
                                $key = 'COMMENTS';
                            }


                            if ($this->uri->segment(13) != '') {

                                if ($this->uri->segment(13) == 'clinical') {
                                    $key == 'Maximum clinical dimension/diameter' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Clinical Data</td></tr>' : '';
                                }
                                if ($this->uri->segment(13) == 'macro') {
                                    $key == 'Dimension of specimen (Length)' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Macroscopic Description</td></tr>' : '';
                                }
                                if ($this->uri->segment(13) == 'micro') {
                                    $key == 'Low risk subtype' || $key == 'High risk if present' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Microscopic Description / Histological Data</td></tr>' : '';
                                }
                            } else {
                                $key == 'Maximum clinical dimension/diameter' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Clinical Data</td></tr>' : '';
                                $key == 'Dimension of specimen (Length)' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Macroscopic Description</td></tr>' : '';
                                $key == 'Low risk subtype' || $key == 'High risk if present' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Microscopic Description / Histological Data</td></tr>' : '';
                                $key == 'Maximum dimension/diameter of lesion (Indicate which used)' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Maximum dimension/diameter of lesion</td></tr>' : '';
                                $key == 'pTNM pT' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">pTNM & COMMENTS</td></tr>' : '';
                            }



                            $_PDF_html .= "<tr> <td> $key </td> <td> $val </td> </tr>";
                        }
                    }

                    $_PDF_html .= '</table><tcpdf pagebreak="true"/>';
                }
            }

            $_PDF_html .= <<<EOD
                </table>
EOD;

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Uralensis');
            $pdf->SetTitle('Patient Record');
            $pdf->SetSubject('BCC Dataset');
            $pdf->SetKeywords('');

// set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, Uralensis . ' - Patient Record', 'Basal Cell Carcinoma Dataset');

// set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

// ---------------------------------------------------------
// set font
            $pdf->SetFont('helvetica', 'B', 20);

// add a page
            $pdf->AddPage();

            //$pdf->Write(0, 'Basal Cell Carcinoma Dataset', '', 0, 'L', true, 0, false, false, 0);

            $pdf->SetFont('helvetica', '', 8);

            $tbl = $_PDF_html;

            $pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
//Close and output PDF document
            $pdf->Output(time() . '_bcc_dataset.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
        }
    }

}
