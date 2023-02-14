<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

ob_start();
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', $user_name);
$sheet->setCellValue('A2', 'Doctor Name');
$sheet->setCellValue('B2', 'Total Cases');
$sheet->setCellValue('C2', 'TAT < 10 days (Cases)');
$sheet->setCellValue('D2', 'TAT < 10 days (%)');
$sheet->setCellValue('E2', 'Target TAT < 10 days (Cases)');
$rows = 3;
foreach($twelve_month_tat as $key=>$value){
    $sheet->setCellValue('A' . $rows, $value->publish_month);
    $sheet->setCellValue('B' . $rows, $value->num_of_cases);
    $sheet->setCellValue('C' . $rows, $value->tat_less_ten);
    $sheet->setCellValue('D' . $rows, $value->tat_less_ten_percent);
    $sheet->setCellValue('E' . $rows, $value->target_less_ten);
    $rows++;
}

$writer = new Xlsx($spreadsheet);

$file_name = 'TAT_Last_12_Months_' . $user_name. '_' . date('dMY');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'. $file_name .'.xlsx"');
header('Cache-Control: max-age=0');
ob_end_clean();
$writer->save('php://output'); // download file


