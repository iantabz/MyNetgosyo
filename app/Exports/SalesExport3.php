<?php

namespace App\Exports;

use Carbon\Carbon;
use App\SalesExportFiles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PHPExcel_Worksheet_PageSetup;

class SalesExport3 implements FromCollection, WithHeadings, \Maatwebsite\Excel\Concerns\WithEvents
{

    public function registerEvents(): array
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        // $rowEnd = 1;
        return [

            AfterSheet::class => function (AfterSheet $event) use ($date) {
                $event->sheet->getDelegate()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getPageSetup()->setFitToPage(true);
                $event->sheet->getDelegate()->getPageSetup()->setFitToWidth(0.5);
                $event->sheet->getDelegate()->getPageSetup()->setFitToHeight(0);
                // $event->sheet->getDelegate()->getPageSetup()->setScale(100);
                // $event->sheet->getDelegate()->getPageMargins()->setTop(1);
                // $event->sheet->getDelegate()->getPageMargins()->setLeft(1);
                // $event->sheet->getDelegate()->getPageMargins()->setRight(1);
                // $event->sheet->getDelegate()->getPageMargins()->setBottom(1);

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(34);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(23);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(45);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(8);

                // last column as letter value (e.g., D)
                $last_column = Coordinate::stringFromColumnIndex(9);

                // calculate last row + 1 (total results + header rows + column headings row + new row)
                $last_row = $this->startCell() + 2 + 1 + 1;

                // set up a style array for cell formatting
                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],
                    'font' => [
                        'size' => 14,
                        'bold' => true
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => 'FFFFFF']
                        ],
                    ]
                ];
                $style_text_center1 = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],
                    'font' => [
                        'size' => 10,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => 'FFFFFF']
                        ],
                        'right' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => 'FFFFFF']
                        ],
                        'left' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => 'FFFFFF']
                        ],

                    ]
                ];

                // at row 1, insert 2 rows
                $event->sheet->insertNewRowBefore(1, 2);

                // merge cells for full-width
                // $event->sheet->mergeCells(sprintf('D1:E1'));
                // $event->sheet->mergeCells(sprintf('C1:I1'));
                // $event->sheet->mergeCells(sprintf('A%d:%s%d', $last_row, $last_column, $last_row));

                // assign cell values
                $event->sheet->setCellValue('E1', 'LDI - FLOWRACK');
                $event->sheet->setCellValue('E2', 'As Of Date : ' . $date);

                // $event->sheet->setCellValue(sprintf('A%d', $last_row), 'Flowrack [System Generated: ...]');

                // assign cell styles
                $event->sheet->getStyle('A1:I1')->applyFromArray($style_text_center);
                $event->sheet->getStyle('A2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('B2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('C2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('D2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('E2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('F2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('G2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('H2')->applyFromArray($style_text_center1);
                $event->sheet->getStyle('I2')->applyFromArray($style_text_center1);
                // $event->sheet->getStyle('A2:I2')->setBorder('none', 'none', 'thin', 'none');
                // $event->sheet->getStyle(sprintf('A%d', $last_row))->applyFromArray($style_text_center);


                $cellHeader = 'A3:I3';

                $event->sheet->getDelegate()->getStyle($cellHeader)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($cellHeader)->getFont()->setSize(11);
                $event->sheet->getStyle($cellHeader)->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true
                    ]
                ]);

                // $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

                // foreach ($columns as $column) {
                //     $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                // }

                for ($i = 3; $i <= $this->startCell() + 3; $i++) {

                    $cellRange = 'A' . $i . ':I' . $i;


                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                    $event->sheet->getStyle($cellRange)->applyFromArray([
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                        'borders' => [
                            'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ]);
                }
            },


        ];
    }

    public function headings(): array
    {
        return [

            'S-FORM NO.',
            'C-CODE',
            'CUSTOMER',
            'S-CODE',
            'SALESMAN',
            'P-CODE',
            'PRODUCT',
            'UOM',
            'QTY',

        ];
    }


    public function collection()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();

        SalesExportFiles::where('file_type', '=', 'FLOWRACK')
            ->whereDate('date_generate', $date)
            ->update(['downloaded' => 'yes', 'flag' => 0]);

        SalesExportFiles::join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            ->whereDate('sales_export_files.date_generate', $date)
            ->update(['isExported' => 1]);

        return SalesExportFiles::select('sef_no', 'acct_code', 'acct_name', 'usercode', 'user_fname', 'product_code', 'product_name', 'product_uom', 'qty_ordered')
            ->where('file_type', '=', 'FLOWRACK')
            ->where('flag', '=', 0)
            ->whereDate('date_generate', $date)->get();
    }

    public function startCell(): int
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();

        return SalesExportFiles::select('sef_no', 'acct_code', 'acct_name', 'usercode', 'user_fname', 'product_code', 'product_name', 'product_uom', 'qty_for_delivery', 'qty_ordered')
            ->where('file_type', '=', 'FLOWRACK')
            ->where('flag', '=', 0)
            ->whereDate('date_generate', $date)->count();
    }

    // public function count(): int
    // {
    //     $row = $this->startCell()+1;
    //     if ($i<=$row) {
    //         $i++;
    //     }

    //     return $i;

    // }
}
