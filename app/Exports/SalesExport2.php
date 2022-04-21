<?php

namespace App\Exports;

use App\SalesExportFiles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Writer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SalesExport2 implements FromCollection, WithHeadings, \Maatwebsite\Excel\Concerns\WithEvents
{

    public function registerEvents(): array
    {
        return [

            BeforeWriting::class => function (BeforeWriting $event) {
                $spreadsheet = $event->getWriter()->getDelegate();
                $spreadsheet->getSecurity()->setLockWindows(true);
                $spreadsheet->getSecurity()->setLockStructure(true);
                $spreadsheet->getSecurity()->setLockRevision(true);
                $spreadsheet->getSecurity()->setWorkbookPassword('123');
                $spreadsheet->getSecurity()->setRevisionsPassword('123');
            },
            \Maatwebsite\Excel\Events\AfterSheet::class => function (AfterSheet $event) {
                $protection = $event->getSheet()->getDelegate()->getProtection();

                $protection->setPassword('PhpSpreadsheet');
                $protection->setSheet(true);
                $protection->setSort(true);
                $protection->setInsertRows(true);
                $protection->setFormatCells(true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'DOWNLOADED',
            'SALES FORM #',
            'CUSTOMER NAME',
            'P.O.',
            'ACCOUNT CODE',
            'ACCOUNT NAME',
            'BRANCH CODE',
            'BRANCH NAME',
            'USERNAME',
            'USER CODE',
            'USER FULL NAME',
            'TIMESTAMP',
            'PRODUCT CODE',
            'PRODUCT NAME',
            'PRODUCT UOM',
            'QUANTITY (FOR DELIVERY WITHIN DATE SELECTED)',
            'QUANTITY (ORDERED WITHIN DATE SELECTED)',
        ];
    }

    public function collection()
    {
        $date = Carbon::now()->toDateString();
        $date1 = Carbon::now()->toDateTimeString();
        // $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date_process = Carbon::parse($date1);


        $get_cut_off = DB::table('order_cut_off_time')->select('cut_off_time')->first();
        $cut_off = $get_cut_off->cut_off_time;

        $query = SalesExportFiles::join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            ->where('sales_export_files.downloaded', '=', 'no')
            ->where('sales_export_files.flag', '=', 1)
            ->where('sales_export_files.file_type', '=', 'BULK')
            ->where('sales_export_files.date_req', '>=', "$date $cut_off")
            ->where('tb_tran_head.order_by', '=', 'Backend');

        $query1 = SalesExportFiles::select('downloaded', 'sef_no', 'cust_name', 'po', 'acct_code', 'acct_name', 'branch_code', 'branch_name', 'username', 'usercode', 'user_fname', 'timestamp', 'product_code', 'product_name', 'product_uom', 'qty_for_delivery', 'qty_ordered')
            ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            ->where('sales_export_files.downloaded', '=', 'no')
            ->where('sales_export_files.flag', '=', 1)
            ->where('sales_export_files.file_type', '=', 'BULK')
            ->where('sales_export_files.date_req', '>=', "$date $cut_off")
            ->where('tb_tran_head.order_by', '=', 'Backend');

        $sales_bulk = SalesExportFiles::select('downloaded', 'sef_no', 'cust_name', 'po', 'acct_code', 'acct_name', 'branch_code', 'branch_name', 'username', 'usercode', 'user_fname', 'timestamp', 'product_code', 'product_name', 'product_uom', 'qty_for_delivery', 'qty_ordered')
            ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            ->where('sales_export_files.downloaded', '=', 'no')
            ->where('sales_export_files.flag', '=', 1)
            ->where('sales_export_files.file_type', '=', 'BULK')
            ->where('sales_export_files.date_req', '<=', "$date $cut_off")
            ->orderBy('sales_export_files.sef_id', 'DESC')
            ->union($query1)
            ->get();

        SalesExportFiles::join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            ->where('sales_export_files.downloaded', '=', 'no')
            ->where('sales_export_files.flag', '=', 1)
            ->where('sales_export_files.file_type', '=', 'BULK')
            ->where('sales_export_files.date_req', '<=', "$date $cut_off")
            ->orderBy('sales_export_files.sef_id', 'DESC')
            ->union($query)
            ->update(['export_date' => $date_process,'date_app' => $date_process, 'tran_stat' => 'On-Process', 'isExported' => 1, 'sales_export_files.downloaded' => 'yes', 'sales_export_files.flag' => 0]);

        return $sales_bulk;
    }
}
