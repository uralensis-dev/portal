<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * @Return Array
 * @var $snomed_p_array
 */
function snomed_p_code($data = '', $type = 'array') {

    $snomed_p_array = array(
        "1140 Biopsy Nos",
        "1109 Excision / Re-excision",
        "1102 Enucleation Nos",
        "1110 Amputation",
        "1125 Exenteration",
        "1130 Debridement Nos",
        "1145 Bone Marrow Aspiration and Biopsy (T-06000)",
        "1154 Curretage Nos",
        "1155 Dilatation and Curretage",
        "1170 Prosthetic Implantation",
        "1342 Endobronchial Washing (T-26000)",
        "1420 Transplantation Nos",
        "2044 Specimen Frozen",
        "3070 Microscopic Examination of Referred Slides",
        "3081 Frozen Section",
        "3086 Immunofluorescent Study",
        "3105 Cytopathology Review of Slides by Pathologist",
        "3238 Gross Organ Or Tissue Photography Nos",
        "3239 Microphotography Nos",
        "3250 Electron Microscopy Study",
        "3080 Mohs",
        "3251 Sentinel Node",
        "1025 Biopsy Incisional",
    );
    return $snomed_p_array;
}
