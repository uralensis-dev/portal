<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

ob_start();
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// $sheet->setCellValue('A1', $user_name);
$sheet->setCellValue('A1', 'Doctor Name');
$sheet->setCellValue('B1', 'Total Cases');
$sheet->setCellValue('C1', 'TAT < 10 days (Cases)');
$sheet->setCellValue('D1', 'TAT < 10 days (%)');
$sheet->setCellValue('E1', 'Target TAT < 10 days (Cases)');
$rows = 2;
foreach($all_docs_l_month_data as $key=>$value){
    $sheet->setCellValue('A' . $rows, $value->doctor_name);
    $sheet->setCellValue('B' . $rows, $value->num_of_cases);
    $sheet->setCellValue('C' . $rows, $value->tat_less_ten);
    $sheet->setCellValue('D' . $rows, $value->tat_less_ten_percent);
    $sheet->setCellValue('E' . $rows, $value->target_less_ten);
    $rows++;
}

$writer = new Xlsx($spreadsheet);

$file_name = 'TAT Last Month (All Doctors)_' . date('dMY');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'. $file_name .'.xlsx"');
header('Cache-Control: max-age=0');
ob_end_clean();
$writer->save('php://output'); // download file


