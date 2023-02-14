<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
$group_id = $csv_data['group_id'];
$group_name = $this->ion_auth->group($group_id)->row()->description; 
$file_name = 'Furtherwork_Report_' . $group_name . '_' . date('dMY') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $file_name);

$output = fopen('php://output', 'w');
fputcsv($output, array(
    $group_name,
        )
);
fputcsv($output, array(
    'UL-Ref',
    'Patient Initial',
    'Lab Ref',
    'Patient Name',
    'Clinic Date',
    'NHS Number',
    'Furtherwork Description',
    'Furtherwork Date',
    'Status'
        )
);

$fw_csv = $this->Admin_model->generate_fw_reprot_model($group_id);

foreach($fw_csv as $fw_rec){
    fputcsv($output, array(
        'UL-Ref' => $fw_rec['serial_number'],
        'Patient Initial' => $fw_rec['patient_initial'],
        'Lab Ref' => $fw_rec['lab_number'],
        'Patient Name' => $fw_rec['f_name'] . ' ' . $fw_rec['sur_name'],
        'Clinic Date' => $fw_rec['date_taken'],
        'NHS Number' => $fw_rec['nhs_number'],
        'Furtherwork Description' => $fw_rec['furtherword_description'],
        'Furtherwork Date' => $fw_rec['furtherwork_date'],
        'Status' => $fw_rec['fw_status']
        
            )
    );
}
