<?php defined('BASEPATH') OR exit('No direct script access allowed');
//echo 'Here'; exit;
//$file_name = 'TAT Last Month (All Doctors)'_' . date('dMY') . '.csv';
$file_name = "TAT Last Month (All Doctors)_".date('dMY').".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $file_name);

$output = fopen('php://output', 'w');

fputcsv($output, array(
        'Doctor Name',
        'Total Cases',
        'TAT < 10 days (Cases)',
        'TAT < 10 days (%)',
        'Target TAT < 10 days (Cases)'
    )
);

foreach($all_docs_l_month_data as $key=>$value){
    fputcsv($output, array(
            'Doctor Name' => $value->doctor_name,
            'Total Cases' => $value->num_of_cases,
            'TAT < 10 days (Cases)' => $value->tat_less_ten,
            'TAT < 10 days (%)' => $value->tat_less_ten_percent,
            'Target TAT < 10 days (Cases)' => $value->target_less_ten
        )
    );
}