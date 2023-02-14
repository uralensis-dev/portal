<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$file_name = 'TAT_Last_12_Months_' . $user_name. '_' . date('dMY') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $file_name);

$output = fopen('php://output', 'w');
fputcsv($output, array(
        $user_name,
    )
);
fputcsv($output, array(
        'Month Publish',
        'Case No.',
        'TAT < 10 days (Cases)',
        'TAT < 10 days (%)',
        'Target TAT < 10 days (Cases)'
    )
);

foreach($twelve_month_tat as $key=>$value){
    fputcsv($output, array(
            'Month Publish' => $value->publish_month,
            'Case No.' => $value->num_of_cases,
            'TAT < 10 days (Cases)' => $value->tat_less_ten,
            'TAT < 10 days (%)' => $value->tat_less_ten_percent,
            'Target TAT < 10 days (Cases)' => $value->target_less_ten
        )
    );
}