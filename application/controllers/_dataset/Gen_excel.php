<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gen_excel extends CI_Controller {

    public function __construct() {

        parent::__construct();
        error_reporting(0);
        $this->load->model('Ion_auth_model');
        $this->load->helper(array('form', 'url', 'file', 'cookie', 'activity_helper', 'ec_helper', '_custom_helper/custom_functions_helper'));
        track_user_activity(); //Track user activity function which logs user track actions.
        $this->load->library('excel');
    }

    public function index() {
        if ($this->uri->segment(4) > 0 && $this->uri->segment(4) != '') {

            $html_response = '';
            $get_bcc_record = get_bcc_dataset_record($this->uri->segment(4), '');

            if (!empty($get_bcc_record)) {
                for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {
                    $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                    $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);
                    $data_arr = '';
                    foreach ($data_set as $key => $val) {


                        $data_arr = array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther', 'specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic', 'Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal', 'ptnm', 'ptnm_N', 'ptnm_M', 'bcc_comments');

                        if (in_array($key, $data_arr)) {


                            if ($key == 'n_invasion') {
                                $key = 'Perineural invasion† :**';
                                if($val=='Present') { $e_pI = 'Y'; $e_pI_state = 'Yes';}
                                elseif($val=='Not identified') { $e_pI = 'N'; $e_pI_state = 'No'; }
                                elseif($val=='Uncertain') { $e_pI = 'U'; $e_pI_state = 'Uncertain '; }
                                elseif($val=='Cannot be assessed') { $e_pI = 'X'; $e_pI_state = 'Cannot be assessed'; }
                            }
                          
                            if ($key == 'Maximum_Dimention') {
                                $key = '(Dimension)';
                                if($val=='?20 mm') { $e_mD = 'N'; $e_mD_state = 'No (Less than or equal to 20mm)'; }
                                elseif($val=='>20 – ≤40 mm') { $e_mD = 'Y'; $e_mD_state = 'Yes (Greater than 20mm)';  }
                                elseif($val=='Uncertain') { $e_mD = 'U'; $e_mD_state = 'Uncertain';  }
                                elseif($val=='Cannot be assessed') { $e_mD = 'X'; $e_mD_state = 'Cannot be assessed';  } else {
                                    $e_mD = '9'; $e_mD_state = 'Not Known'; 
                                }
                            }
                        }
                    }
                }
            }



            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);

            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Cancer Outcomes and Services Dataset - Skin Pathology');
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Cancer Outcomes and Services Dataset - Skin Pathology');
            $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'COSD Pathology v4.0.2 Final');
            $objPHPExcel->getActiveSheet()->SetCellValue('A3', '');

            $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Data item No.');
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Data Item Section');
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Data Item Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Data Item Description');
            $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Format');
            $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'National Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'National code definition');
            $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Data Dictionary Element');
            $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Other collections');
            $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Schema Specification*');

            $objPHPExcel->getActiveSheet()->SetCellValue('B5', 'SKIN - PATHOLOGY - BCC');
            $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'To carry pathology details for Basal Cell Carcinoma');
            $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'May be one occurrence per Pathology Report (0..1)');

            $objPHPExcel->getActiveSheet()->SetCellValue('A8', 'pSK12120');
            $objPHPExcel->getActiveSheet()->SetCellValue('A9', 'pSK12530');
            $objPHPExcel->getActiveSheet()->SetCellValue('A10', 'pSK12537');

            $objPHPExcel->getActiveSheet()->SetCellValue('B8', 'SKIN - PATHOLOGY - BCC');
            $objPHPExcel->getActiveSheet()->SetCellValue('B9', 'SKIN - PATHOLOGY - BCC');
            $objPHPExcel->getActiveSheet()->SetCellValue('B10', 'SKIN - PATHOLOGY - BCC');

            $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'SKIN CANCER LESION INDICATOR');
            $objPHPExcel->getActiveSheet()->SetCellValue('C9', 'PERINEURAL INVASION');
            $objPHPExcel->getActiveSheet()->SetCellValue('C10', 'LESION DIAMETER GREATER THAN 20MM INDICATOR');

            $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'This is the specimen number or letter used to identify the specimen within a report. Where more than one primary skin cancer is reported on the same pathology report,  record the lesion number or letter as specified on the pathology report. ');
            $objPHPExcel->getActiveSheet()->SetCellValue('D9', 'Is there perineural invasion (invasion into perineurium of nerve bundles- PNI)');
            $objPHPExcel->getActiveSheet()->SetCellValue('D10', 'Is the diameter of the lesion greater than 20mm?');

            $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'max an3');
            $objPHPExcel->getActiveSheet()->SetCellValue('E9', 'an1');
            $objPHPExcel->getActiveSheet()->SetCellValue('E10', 'an1');

            $objPHPExcel->getActiveSheet()->SetCellValue('H8', 'SKIN CANCER LESION SPECIMEN IDENTIFIER');
            $objPHPExcel->getActiveSheet()->SetCellValue('H9', 'PERINEURAL INVASION INDICATOR (SKIN)');
            $objPHPExcel->getActiveSheet()->SetCellValue('H10', 'LESION DIAMETER GREATER THAN 20MM INDICATION CODE');

            $objPHPExcel->getActiveSheet()->SetCellValue('I8', '');
            $objPHPExcel->getActiveSheet()->SetCellValue('I9', 'RCPATH');
            $objPHPExcel->getActiveSheet()->SetCellValue('I10', 'RCPATH');

            $objPHPExcel->getActiveSheet()->SetCellValue('J8', '');
            $objPHPExcel->getActiveSheet()->SetCellValue('J9', 'Required 0.. 1');
            $objPHPExcel->getActiveSheet()->SetCellValue('J10', 'Required 0.. 1');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('F9', $e_pI);
            $objPHPExcel->getActiveSheet()->SetCellValue('F10', $e_mD);
            
            $objPHPExcel->getActiveSheet()->SetCellValue('G9', $e_pI_state);
            $objPHPExcel->getActiveSheet()->SetCellValue('G10', $e_mD_state);

            $filename = "BCC Dataset - " . time() . ".csv";
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
            $objWriter->save('php://output');
        }
    }

}
