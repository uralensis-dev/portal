<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$group_id = $finance_data['hospital_group_id'];
$date_from = $finance_data['date_from'];
$date_to = $finance_data['date_to'];
$group_name = $finance_data['hospital_group_name'];

$file_name = 'Finance_Report_' . $group_name . '_' . date('dMY') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $file_name);

$output = fopen('php://output', 'w');
fputcsv($output, array(
    $group_name,
        )
);
fputcsv($output, array(
    'UL-Ref',
    'Lab Ref',
    'Patient Name',
    'Clinic Date',
    'Specimen(s)',
    'Blocks',
    'Block Code',
    'Fee',
    'Levels',
    'Immunos',
    'IMF',
    'Storage',
    'Sub Total'
        )
);

$finance_request = $this->Admin_model->finance_report_request($group_id, $date_to, $date_from);

$calc_price = 0;
foreach ($finance_request as $row) {
    $total_specimens = 0;
    $total_price = 0;

    $specimens = $this->Admin_model->display_specimens_report($row['uralensis_request_id'], $row['hospital_group_id']);
    fputcsv($output, array(
        'UL-Ref' => $row['serial_number'],
        'Lab Ref' => $row['lab_number'],
        'Patient Name' => $row['f_name'] . ' ' . $row['sur_name'],
        'Clinic Date' => date('Y-m-d', strtotime($row['date_taken'])),
        'Specimen(s)' => count($specimens)
            )
    );

    if (!empty($specimens)) {
        foreach ($specimens as $key => $value) {
            $calc_price = $calc_price + $value->ura_cost_code_price;
            $total_price = $total_price + $value->ura_cost_code_price;
            fputcsv($output, array(
                '',
                '',
                '',
                '',
                '',
                'Blocks' => $value->ura_cost_code_desc,
                'Block Code' => $value->ura_cost_code_prefix,
                'Fee' => $value->ura_cost_code_price,
                
                    )
            );
        }
    }
    
    $sub_total = $total_price + $row['Total'] + $row['ura_cost_code_storage_price'];
    $calc_price = $calc_price + $row['Total'] + $row['ura_cost_code_storage_price'];
    fputcsv($output, array(
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        'Levels' => $row['Level_TOTAL'],
        'Immunos' => $row['Immunos_TOTAL'],
        'IMF' => $row['Imf_TOTAL'],
        'Storage' => $row['ura_cost_code_storage_price'],
        'Sub Total' => $sub_total
            )
    );
}
fputcsv($output, array(
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    ''
        )
);
fputcsv($output, array(
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    'Total'
        )
);
fputcsv($output, array(
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    'Total' => $calc_price
        )
);
