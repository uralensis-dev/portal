<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('datasets')) {

    /**
     * Datasets Array List
     *
     * @return void
     */
    function getDatasets() {
        return array(
            0 => array(
                'datasets_id' => 1,
                'datasets_name' => 'Dataset1',
                'categories' => array(
                    0 => array(
                        'cat_id' => 1,
                        'cat_name' => 'Clinical Data',
                        'questions' => array(
                            0 => array(
                                'dataset_id' => 1,
                                'cat_id' => 1,
                                'ques_id' => 1,
                                'type' => 'textfield',
                                'title' => 'Clinical Site',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array()
                            ),
                            1 => array(
                                'dataset_id' => 1,
                                'cat_id' => 1,
                                'ques_id' => 2,
                                'type' => 'singlechoice',
                                'title' => 'Specimen Type',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Excisional biopsy',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Incisional (diagnostic) biopsy',
                                        'type' => 'radio'
                                    ),
                                    2 => array(
                                        'title' => 'Punch biopsy',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Shave',
                                        'type' => 'radio'
                                    ),
                                    4 => array(
                                        'title' => 'Curettings (Therapeutic)',
                                        'type' => 'radio'
                                    ),
                                    5 => array(
                                        'title' => 'Curettings (Diagnostic)',
                                        'type' => 'radio'
                                    ),
                                    6 => array(
                                        'title' => 'Curettings (not specified)',
                                        'type' => 'radio'
                                    ),
                                    7 => array(
                                        'title' => 'Other',
                                        'type' => 'textfield'
                                    )
                                )
                            ),
                        ),
                    ),
                    1 => array(
                        'cat_id' => 2,
                        'cat_name' => 'Macroscopic Description',
                        'questions' => array(
                            0 => array(
                                'dataset_id' => 1,
                                'cat_id' => 2,
                                'ques_id' => 1,
                                'type' => 'fillinblank',
                                'title' => 'Size of Specimen',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Length',
                                        'type' => 'fillinblank'
                                    ),
                                    1 => array(
                                        'title' => 'Breadth',
                                        'type' => 'fillinblank'
                                    ),
                                    2 => array(
                                        'title' => 'Depth',
                                        'type' => 'fillinblank'
                                    ),
                                ),
                            ),
                            1 => array(
                                'dataset_id' => 1,
                                'cat_id' => 2,
                                'ques_id' => 2,
                                'type' => 'singlechoice',
                                'title' => 'Maximum diameter of lesion',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Diameter',
                                        'type' => 'fillinblank'
                                    ),
                                    1 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    2 => array(
                                        'title' => 'No lesion seen',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                        ),
                    ),
                    2 => array(
                        'cat_id' => 3,
                        'cat_name' => 'Histological Data',
                        'questions' => array(
                            0 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 1,
                                'type' => 'singlechoice',
                                'title' => 'Low-risk Subtype',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Superficial',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Nodular',
                                        'type' => 'radio'
                                    ),
                                    2 => array(
                                        'title' => 'Fibroepithelial',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            1 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 2,
                                'type' => 'singlechoice',
                                'title' => 'Or high-risk if present',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Infiltrative (infiltrating/sclerosing/micronodular)',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Basosquamous Carcinoma',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            2 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 3,
                                'type' => 'singlechoice',
                                'title' => 'Level of invasion',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Dermis',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Extradermal',
                                        'type' => 'radio',
                                        'depend' => array(4),
                                    ),
                                ),
                            ),
                            3 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 4,
                                'type' => 'singlechoice',
                                'title' => 'Specify Tissue',
                                'required' => 'yes',
                                'dependency' => 'true',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Fat',
                                        'type' => 'checkbox'
                                    ),
                                    1 => array(
                                        'title' => 'Muscle',
                                        'type' => 'checkbox'
                                    ),
                                    2 => array(
                                        'title' => 'Fascia',
                                        'type' => 'checkbox'
                                    ),
                                    3 => array(
                                        'title' => 'Perichondrium',
                                        'type' => 'checkbox'
                                    ),
                                    4 => array(
                                        'title' => 'Cartilage',
                                        'type' => 'checkbox'
                                    ),
                                    5 => array(
                                        'title' => 'Paratendon/tendon',
                                        'type' => 'checkbox'
                                    ),
                                    6 => array(
                                        'title' => 'Periosteum',
                                        'type' => 'checkbox'
                                    ),
                                    7 => array(
                                        'title' => 'Bone',
                                        'type' => 'checkbox',
                                        'depend' => array(5, 6),
                                    ),
                                ),
                            ),
                            4 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 5,
                                'type' => 'singlechoice',
                                'title' => 'Invasion of maxilla, mandible, orbit or temporal bone',
                                'required' => 'yes',
                                'dependency' => 'true',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'No',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Yes (pT3)',
                                        'type' => 'radio'
                                    ),
                                    2 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Cannot be assessed',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            5 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 6,
                                'type' => 'singlechoice',
                                'title' => 'Invasion of skeleton (axial or appendicular)',
                                'required' => 'yes',
                                'dependency' => 'true',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'No',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Yes (pT4)',
                                        'type' => 'radio'
                                    ),
                                    2 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Cannot be assessed',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            6 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 7,
                                'type' => 'singlechoice',
                                'title' => 'Perineural Invasion',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Not identified',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Present',
                                        'type' => 'radio',
                                        'depend' => array(8),
                                    ),
                                    2 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Cannot be assessed',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            7 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 8,
                                'type' => 'singlechoice',
                                'title' => 'Perineural invasion of skull base',
                                'required' => 'yes',
                                'dependency' => 'true',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'No',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Yes (pT4)',
                                        'type' => 'radio',
                                    ),
                                    2 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Cannot be assessed',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            8 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 9,
                                'type' => 'singlechoice',
                                'title' => 'Lymphovascular invasion (basosquamous carcinoma only):',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => 'Not identified',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => 'Present',
                                        'type' => 'radio',
                                    ),
                                    2 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Cannot be assessed',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                            9 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 10,
                                'type' => 'singlechoicev2',
                                'title' => 'Margins',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'options' => array(
                                    0 => array(
                                        'title' => 'Peripheral',
                                        'answers' => array(
                                            0 => array(
                                                'title' => 'Involved',
                                                'type' => 'radio'
                                            ),
                                            1 => array(
                                                'title' => 'Not Involved',
                                                'type' => 'radio',
                                                'ans_options' => array(
                                                    0 => '<1 mm',
                                                    1 => '1-5 mm',
                                                    2 => '>5 mm',
                                                )
                                            ),
                                            2 => array(
                                                'title' => 'Uncertain',
                                                'type' => 'radio'
                                            ),
                                            3 => array(
                                                'title' => 'Not Applicable',
                                                'type' => 'radio'
                                            ),
                                        ),
                                    ),
                                    1 => array(
                                        'title' => 'Deep',
                                        'answers' => array(
                                            0 => array(
                                                'title' => 'Involved',
                                                'type' => 'radio'
                                            ),
                                            1 => array(
                                                'title' => 'Not Involved',
                                                'type' => 'radio',
                                                'ans_options' => array(
                                                    0 => '<1 mm',
                                                    1 => '1-5 mm',
                                                    2 => '>5 mm',
                                                )
                                            ),
                                            2 => array(
                                                'title' => 'Uncertain',
                                                'type' => 'radio'
                                            ),
                                            3 => array(
                                                'title' => 'Not Applicable',
                                                'type' => 'radio'
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            10 => array(
                                'dataset_id' => 1,
                                'cat_id' => 3,
                                'ques_id' => 11,
                                'type' => 'singlechoice',
                                'title' => 'Maximum diameter (macroscopic and/or microscopic):',
                                'required' => 'yes',
                                'dependency' => 'false',
                                'answers' => array(
                                    0 => array(
                                        'title' => '<10 mm',
                                        'type' => 'radio'
                                    ),
                                    1 => array(
                                        'title' => '10–20 mm',
                                        'type' => 'radio',
                                    ),
                                    2 => array(
                                        'title' => '>20 mm',
                                        'type' => 'radio'
                                    ),
                                    3 => array(
                                        'title' => 'Uncertain',
                                        'type' => 'radio'
                                    ),
                                    4 => array(
                                        'title' => 'Cannot be assessed ',
                                        'type' => 'radio'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            1 => array(
                'datasets_id' => 2,
                'datasets_name' => 'Dataset2',
                'categories' => array(),
            ),
            2 => array(
                'datasets_id' => 3,
                'datasets_name' => 'Dataset3',
                'categories' => array(),
            ),
        );
    }

}

if (!function_exists('_datasets')) {

    /**
     * Datasets Array List
     *
     * @return void
     */
    function get_Datasets() {
        $CI = &get_instance();
        return $CI->db->query("SELECT * FROM tbl_datasets;")->result();
    }

}


if (!function_exists('getDatasetsArrayIndexData')) {

    /**
     * Get Array Index Data
     *
     * @param [type] $array
     * @param [type] $attr
     * @param [type] $value
     * @return void
     */
    function getDatasetsArrayIndexData($array, $attr, $value) {
        for ($i = 0; $i < sizeof($array); $i += 1) {
            if ($array[$i][$attr] == $value) {
                return $array[$i];
            }
        }
        return -1;
    }

}
