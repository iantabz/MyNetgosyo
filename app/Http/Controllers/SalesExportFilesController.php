<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport2;
use App\Exports\SalesExport3;
use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\ItemMasterfile;
use App\SalesExportFiles;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SalesExportFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function unserved_flowrack()
    {
        // DB::transaction(function () {

        $tranno = [];

        SalesExportFiles::where('file_type', '=', 'FLOWRACK')
            ->where('flag', '=', 2)
            ->where('tag', '=', 'Returned')
            ->where('downloaded', '=', 'no')
            ->update(['downloaded' => 'yes', 'flag' => 3]);

        SalesExportFiles::join('tb_unserved_items', 'tb_unserved_items.tran_no', '=', 'sales_export_files.sef_no')
            ->whereRaw("tb_unserved_items.itm_code = sales_export_files.product_code AND tb_unserved_items.uom = sales_export_files.product_uom AND tb_unserved_items.itm_stat = 'Returned' ")
            ->update(['tb_unserved_items.flag' => 1]);

        $gethead = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->get();

        foreach ($gethead as $datahead) {

            $tot_qty = 0;
            $total_amt2 = 0;

            $tranline = [];

            $getExport = SalesExportFiles::where('file_type', '=', 'FLOWRACK')
                ->where('tag', '=', 'Returned')
                ->where('flag', '=', 3)
                ->where('downloaded', '=', 'yes')
                ->where('sef_no', '=', $datahead->tran_no)
                ->where('sales_export_files.date_req', 'LIKE',  Carbon::parse($datahead->date_req)->toDateString() . '%')
                ->get();

            if ($getExport->count() > 0) {

                foreach ($getExport as $export) {

                    $getUnserve = DB::table('tb_unserved_items')
                        ->where('tran_no', '=', $export->sef_no)
                        ->where('itm_code', '=', $export->product_code)
                        ->where('uom', '=', $export->product_uom)
                        ->where('itm_stat', '=', 'Returned')
                        ->get();

                    if ($getUnserve->count() > 0) {

                        $tot_amt = 0;

                        foreach ($getUnserve as $unserve) {

                            $tot_qty = $tot_qty + $export->qty_for_delivery;

                            $calc = $unserve->amt * $unserve->qty;
                            $tot_amt = $tot_amt + $calc;

                            $total_amt2 = $total_amt2 + $tot_amt;

                            $tranline[] = array(
                                'sef_no'   => $export->sef_no,
                                'itemcode'  => $export->product_code,
                                'date_generate' => date('m/d/Y', strtotime($export->date_generate)),
                                'acct_name' => $export->acct_name,
                                'acct_code' => $export->acct_code,
                                'product_name'  => $export->product_name,
                                'product_uom'   => $export->product_uom,
                                'qty_for_delivery' => $export->qty_for_delivery,
                                'amt'   => number_format($unserve->amt, 2, '.', ','),
                                'total_amt'  => number_format($tot_amt, 2, '.', ',')
                            );
                        }
                    }
                }

                $tranno[] = array(
                    'store_name'    =>  $datahead->store_name,
                    'so_no'     =>  $datahead->tran_no,
                    'date_now'  =>  Carbon::now()->toDateString(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'tot_qty'       =>  $tot_qty,
                    'total_amt2'    => number_format($total_amt2, 2, '.', ','),
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'customer_order'    => $tranline
                );
            }
        }
        return $tranno;
        // });
    }

    public function unserved_bulk()
    {
        // DB::transaction(function () {

        $tranno = [];

        SalesExportFiles::where('file_type', '=', 'BULK')
            ->where('tag', '=', 'Returned')
            ->where('flag', '=', 2)
            ->where('downloaded', '=', 'no')
            ->update(['downloaded' => 'yes', 'flag' => 3]);

        SalesExportFiles::join('tb_unserved_items', 'tb_unserved_items.tran_no', '=', 'sales_export_files.sef_no')
            ->whereRaw("tb_unserved_items.itm_code = sales_export_files.product_code AND tb_unserved_items.uom = sales_export_files.product_uom AND tb_unserved_items.itm_stat = 'Returned' ")
            ->update(['tb_unserved_items.flag' => 1]);

        $gethead = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->get();

        foreach ($gethead as $datahead) {
            $tot_qty = 0;
            $total_amt2 = 0;
            $tranline = [];

            $getExport = SalesExportFiles::where('file_type', '=', 'BULK')
                ->where('tag', '=', 'Returned')
                ->where('flag', '=', 3)
                ->where('downloaded', '=', 'yes')
                ->where('sef_no', '=', $datahead->tran_no)
                ->where('sales_export_files.date_req', 'LIKE',  Carbon::parse($datahead->date_req)->toDateString() . '%')
                ->get();

            if ($getExport->count() > 0) {
                foreach ($getExport as $export) {
                    $getUnserve = DB::table('tb_unserved_items')
                        ->where('tran_no', '=', $export->sef_no)
                        ->where('itm_code', '=', $export->product_code)
                        ->where('uom', '=', $export->product_uom)
                        ->where('itm_stat', '=', 'Returned')
                        ->get();

                    if ($getUnserve->count() > 0) {

                        $tot_amt = 0;

                        foreach ($getUnserve as $unserve) {

                            $tot_qty = $tot_qty + $export->qty_for_delivery;

                            $calc = $unserve->amt * $unserve->qty;
                            $tot_amt = $tot_amt + $calc;

                            $total_amt2 = $total_amt2 + $tot_amt;

                            $tranline[] = array(
                                'sef_no'   => $export->sef_no,
                                'itemcode'  => $export->product_code,
                                'date_generate' => date('m/d/Y', strtotime($export->date_generate)),
                                'acct_name' => $export->acct_name,
                                'acct_code' => $export->acct_code,
                                'product_name'  => $export->product_name,
                                'product_uom'   => $export->product_uom,
                                'qty_for_delivery' => $export->qty_for_delivery,
                                'amt'   => number_format($unserve->amt, 2, '.', ','),
                                'total_amt'  => number_format($tot_amt, 2, '.', ',')
                            );
                        }
                    }
                }

                $tranno[] = array(
                    'store_name'    =>  $datahead->store_name,
                    'so_no'     =>  $datahead->tran_no,
                    'date_now'  =>  Carbon::now()->toDateString(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'tot_qty'       =>  $tot_qty,
                    'total_amt2'    => number_format($total_amt2, 2, '.', ','),
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'customer_order'    => $tranline
                );
            }
        }
        return $tranno;
        // });
    }

    public function unserved_bcom()
    {
        // DB::transaction(function () {

        $tranno = [];

        SalesExportFiles::where('file_type', '=', 'BCOM')
            ->where('tag', '=', 'Returned')
            ->where('flag', '=', 2)
            ->where('downloaded', '=', 'no')
            ->update(['downloaded' => 'yes', 'flag' => 3]);

        SalesExportFiles::join('tb_unserved_items', 'tb_unserved_items.tran_no', '=', 'sales_export_files.sef_no')
            ->whereRaw("tb_unserved_items.itm_code = sales_export_files.product_code AND tb_unserved_items.uom = sales_export_files.product_uom AND tb_unserved_items.itm_stat = 'Returned' ")
            ->update(['tb_unserved_items.flag' => 1]);

        $gethead = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->get();

        foreach ($gethead as $datahead) {

            $tot_qty = 0;
            $total_amt2 = 0;
            $tranline = [];

            $getExport = SalesExportFiles::where('file_type', '=', 'BCOM')
                ->where('tag', '=', 'Returned')
                ->where('flag', '=', 3)
                ->where('downloaded', '=', 'yes')
                ->where('sef_no', '=', $datahead->tran_no)
                ->where('sales_export_files.date_req', 'LIKE',  Carbon::parse($datahead->date_req)->toDateString() . '%')
                ->get();

            if ($getExport->count() > 0) {

                foreach ($getExport as $export) {

                    $getUnserve = DB::table('tb_unserved_items')
                        ->where('tran_no', '=', $export->sef_no)
                        ->where('itm_code', '=', $export->product_code)
                        ->where('uom', '=', $export->product_uom)
                        ->where('itm_stat', '=', 'Returned')
                        ->get();

                    if ($getUnserve->count() > 0) {

                        $tot_amt = 0;

                        foreach ($getUnserve as $unserve) {

                            $tot_qty = $tot_qty + $export->qty_for_delivery;

                            $calc = $unserve->amt * $unserve->qty;
                            $tot_amt = $tot_amt + $calc;

                            $total_amt2 = $total_amt2 + $tot_amt;

                            $tranline[] = array(
                                'sef_no'   => $export->sef_no,
                                'itemcode'  => $export->product_code,
                                'date_generate' => date('m/d/Y', strtotime($export->date_generate)),
                                'acct_name' => $export->acct_name,
                                'acct_code' => $export->acct_code,
                                'product_name'  => $export->product_name,
                                'product_uom'   => $export->product_uom,
                                'qty_for_delivery' => $export->qty_for_delivery,
                                'amt'   => number_format($unserve->amt, 2, '.', ','),
                                'total_amt'  => number_format($tot_amt, 2, '.', ',')
                            );
                        }
                    }
                }

                $tranno[] = array(
                    'store_name'    =>  $datahead->store_name,
                    'so_no'     =>  $datahead->tran_no,
                    'date_now'  =>  Carbon::now()->toDateString(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'tot_qty'       =>  $tot_qty,
                    'total_amt2'    => number_format($total_amt2, 2, '.', ','),
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'customer_order'    => $tranline
                );
            }
        }
        return $tranno;
        // });
    }

    public function export_unserved_bcom()
    {
        $date = Carbon::now()->toDateString();

        $filename = "BCOM_RETURN_" . $date . ".pdf";

        $data = $this->unserved_bcom();
        $pdf = PDF::loadView('reports.unserved_bcom', ['datas' => $data]);
        return $pdf->download($filename . '.pdf');
    }
    
    // kaloy 2022-04-07
    // public function export_aris()
    // {
    //     set_time_limit(0);

    //     $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
    //     $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();

    //     $filename = "distribution_aris_" . $dateFrom . "_" . $dateTo . ".txt";

    //     $data = $this->getAris();

    //     $content = "";

    //     foreach ($data as $datas) {
    //         $content .= $datas->sales_invoice;
    //         $content .= "|";
    //         $content .= date('Y-m-d', strtotime($datas->posting_date));
    //         $content .= "|";
    //         $content .= $datas->customer_code;
    //         $content .= "|";
    //         $content .= $datas->sales_invoice_total_amount;
    //         $content .= "|";
    //         $content .= $datas->pmeth_type;
    //         $content .= "|";
    //         $content .= $datas->cheque_no;
    //         $content .= "|";
    //         $content .= $datas->cheque_date=='' ? '' : date('Y-m-d', strtotime($datas->cheque_date));
    //         $content .= "|";
    //         $content .= $datas->account_no;
    //         $content .= "|";
    //         $content .= $datas->payor_name;
    //         $content .= "|";
    //         $content .= $datas->bank_name;
    //         $content .= "|";
    //         $content .= $datas->salesman_code;
    //         $content .= "|";
    //         $content .= $datas->reference_no;
    //         $content .= "\r\n";

    //         // kaloy 2022-04-01
    //         // NOTE: status = 'Exported'/'Downloaded'
    //         DB::table('consolidated_transactions')->where('sales_invoice', $datas->sales_invoice)
    //             ->update([
    //                 'status' => 'Exported',
    //                 'updated_at' => Carbon::now()->toDateTimeString()
    //             ]);
    //     }
    //     // kaloy 2022-03-30 ======================================================

    //     $response = new StreamedResponse();
    //     $response->setCallBack(function () use ($content) {
    //         echo $content;
    //     });
    //     $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
    //     $response->headers->set('Content-Disposition', $disposition);
    //     $response->headers->set('Content-Type', 'text/plain');

    //     return $response;
    // }
    public function export_aris()
    {
        set_time_limit(0);

        // $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
        // $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();

        // $filename = "distribution_aris_" . $dateFrom . "_" . $dateTo . ".txt";

        $filename = "MNG_ARIS_". Carbon::now()->toDateString(). ".txt";

        $data = $this->getAris('', true);

        $content = "";

        foreach ($data as $datas) {
            $content .= $datas->sales_invoice;
            $content .= "|";
            $content .= date('Y-m-d', strtotime($datas->posting_date));
            $content .= "|";
            $content .= $datas->customer_code;
            $content .= "|";
            $content .= $datas->sales_invoice_total_amount;
            $content .= "|";
            $content .= $datas->pmeth_type;
            $content .= "|";
            $content .= $datas->cheque_no;
            $content .= "|";
            $content .= $datas->cheque_date=='' ? '' : date('Y-m-d', strtotime($datas->cheque_date));
            $content .= "|";
            $content .= $datas->account_no;
            $content .= "|";
            $content .= $datas->payor_name;
            $content .= "|";
            $content .= $datas->bank_name;
            $content .= "|";
            $content .= $datas->salesman_code;
            $content .= "|";
            $content .= $datas->reference_no;
            $content .= "\r\n";

            // kaloy 2022-04-01
            // NOTE: status = 'Exported'/'Downloaded'
            DB::table('consolidated_transactions')->where('sales_invoice', $datas->sales_invoice)
                ->update([
                    'status' => 'Exported',
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
        }
        // kaloy 2022-03-30 ======================================================

        $response = new StreamedResponse();
        $response->setCallBack(function () use ($content) {
            echo $content;
        });
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
    

    public function export_unserved_bulk()
    {
        $date = Carbon::now()->toDateString();

        $filename = "BULK_RETURN_" . $date . ".pdf";

        $data = $this->unserved_bulk();
        $pdf = PDF::loadView('reports.unserved_bulk', ['datas' => $data]);
        return $pdf->download($filename . '.pdf');
    }

    public function transaction_unserved_flowrack()
    {
        $date = Carbon::now()->toDateString();

        $filename = "FLOWRACK_RETURN_" . $date . ".pdf";

        $data = $this->unserved_flowrack();
        $pdf = PDF::loadView('reports.unserved_flowrack', ['datas' => $data]);
        return $pdf->download($filename . '.pdf');
    }
    
    // export for bcom
    public function export()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $filename = "BCOM_" . $date . ".csv";
        return Excel::download(new SalesExport, $filename);
    }

    // export for bulk
    public function export2()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $filename = "BULK_" . $date . ".csv";
        return Excel::download(new SalesExport2, $filename);
    }
    
    // data for various (flowrack)
    public function export3()
    {
        // kaloy 2022-03-09
        set_time_limit(0);
        try {
            DB::beginTransaction();
            $tranno = [];
            $date = Carbon::now()->toDateString();
            $date1 = Carbon::now()->toDateTimeString();
            // $date = Carbon::parse(base64_decode(request()->date))->toDateString();
            $date_process = Carbon::parse($date1);
    
            // cut_off time
            $get_cut_off = DB::table('order_cut_off_time')->select('cut_off_time')->first();
            $cut_off = $get_cut_off->cut_off_time;
            $cut_off = new Carbon("$date $cut_off");
            // $cut_off = "$date $cut_off";
            // dd($cut_off);
    
            $gethead = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'customer_master_files.account_name', 
                    'salesman_lists.first_name', 'salesman_lists.last_name'
                )
                ->join('customer_master_files', 
                    'customer_master_files.account_code', '=', 'tb_tran_head.account_code'
                )
                ->join('salesman_lists', 'salesman_lists.user_code', '=', 'tb_tran_head.sm_code')
                ->where('tb_tran_head.tran_stat', 'Pending')
                ->get();
            foreach ($gethead as $datahead) {
                $total_count = 0;
                $tot_qty = 0;
                $tranline = [];
                $order_by = $datahead->order_by;
    
                $getFlowrack = SalesExportFiles::select(
                        'sef_no', 'acct_code', 'acct_name', 'usercode', 'user_fname', 
                        'product_code', 'product_name', 'product_uom', 
                        'qty_ordered', 'date_generate','date_req'
                    )
                    ->where(function($q) use ($cut_off, $order_by){
                        if($order_by=='Backend') {
                            return $q->where('date_req','<=', $cut_off)
                                ->orWhere('date_req', '>=', $cut_off);
                        } else {
                            return $q->where('date_req','<=', $cut_off);
                        }
                    })
                    ->where('file_type', '=', 'FLOWRACK')
                    ->where('flag', '=', 1)
                    ->where('sef_no', '=', $datahead->tran_no)
                    ->orderBy('product_name', 'ASC')
                    ->get();
    
                $total_count = $getFlowrack->count();
    
                if ($getFlowrack->count() > 0) {
                    foreach ($getFlowrack as $dataline) {
                        $tot_qty = $tot_qty + $dataline->qty_ordered;
    
                        $tranline[] = array(
                            'sef_no'   => $dataline->sef_no,
                            'itemcode'  => $dataline->product_code,
                            'date_generate' => date('m/d/Y', strtotime($dataline->date_generate)),
                            'acct_name' => $dataline->acct_name,
                            'acct_code' => $dataline->acct_code,
                            'product_name'  => $dataline->product_name,
                            'product_uom'   => $dataline->product_uom,
                            'qty_ordered'   => $dataline->qty_ordered
                        );
                    }
    
                    $tranno[] = array(
                        'store_name'    =>  $datahead->store_name,
                        'so_no'     =>  $datahead->tran_no,
                        'date_now'  =>  Carbon::now()->toDateTimeString(),
                        'acct_code'     =>  $datahead->account_code,
                        'acct_name'     =>  $datahead->account_name,
                        'salesman_code' =>  $datahead->sm_code,
                        'salesman_name' =>  $datahead->first_name . " " . $datahead->last_name,
                        'tot_qty'       =>  $tot_qty,
                        'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                        'customer_order'    => $tranline,
                        'total_count'   =>  $total_count
                    );
                }
            }
    
    
            SalesExportFiles::join('tb_tran_head', 
                    'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no'
                )
                ->where('sales_export_files.downloaded', '=', 'no')
                ->where('sales_export_files.flag', '=', 1)
                ->where('sales_export_files.file_type', '=', 'FLOWRACK')
                // ->where('tb_tran_head.tran_stat', 'Pending')
                ->where("sales_export_files.date_req", '>=', $cut_off)
                ->where('tb_tran_head.order_by', '=', 'Backend')
                // ->get();
                // dd($query);
                ->update([
                    'export_date' => $date_process,
                    'date_app' => $date_process, 
                    'tran_stat' => 'On-Process', 
                    'isExported' => 1, 
                    'sales_export_files.downloaded' => 'yes', 
                    'sales_export_files.flag' => 0
                ]);
    
            SalesExportFiles::join('tb_tran_head', 
                    'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no'
                )
                ->where('sales_export_files.downloaded', '=', 'no')
                ->where('sales_export_files.flag', '=', 1)
                ->where('sales_export_files.file_type', '=', 'FLOWRACK')
                ->where("sales_export_files.date_req", '<=', $cut_off)
                ->orderBy('sales_export_files.sef_id', 'DESC')
                // ->union($query)
                // ->get();
                // dd($query2);
                ->update([
                    'export_date' => $date_process,
                    'date_app' => $date_process, 
                    'tran_stat' => 'On-Process', 
                    'isExported' => 1, 
                    'sales_export_files.downloaded' => 'yes', 
                    'sales_export_files.flag' => 0
                ]);
            
            DB::commit();
            return $tranno;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    // Export for various (flowrack)
    public function transaction()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();

        // $filename = "FLOWRACK_" . $date;
        $filename = "OPLAN DELICA-VARIOUS_" . $date;

        $data = $this->export3();
        $pdf = PDF::loadView('reports.flowrack', ['datas' => $data]);
        return $pdf->download($filename . '.pdf');
    }

    public function print()
    {
        $data = $this->export3();

        return view('reports.flowrack', ['datas' => $data]);
    }

    public function getUnserved()
    {
        // DB::beginTransaction();

        $date_now = Carbon::now();

        $res = DB::table('tb_unserved_items')
            ->where('itm_stat', '=', 'Returned')
            ->where('flag', '=', 0)
            ->get();

        if ($res->count() > 0) {

            foreach ($res as $data) {

                $check = SalesExportFiles::where([
                    ['sef_no', '=', $data->tran_no],
                    ['product_code', '=', $data->itm_code],
                    ['product_uom', '=', $data->uom]
                ])->get();

                // dump($check->first());

                if ($check->count() > 0) {

                    foreach ($check as $data1) {

                        //Check Item Type

                        $type1 = DB::table('tbl_item_bulk')
                            ->where([['item_code', '=', $data->itm_code], ['uom', '=', $data->uom]])
                            ->first();

                        if ($type1 != null) {

                            $ftype = 'BULK';
                        } else {
                            $type2 = DB::table('tbl_item_bcom')
                                ->where([['item_code', '=', $data->itm_code], ['uom', '=', $data->uom]])
                                ->first();

                            if ($type2 != null) {

                                $ftype = 'BCOM';
                            } else {
                                $type3 = DB::table('tbl_item_flowrack')
                                    ->where([['item_code', '=', $data->itm_code], ['uom', '=', $data->uom]])
                                    ->first();

                                if ($type3 != null) {

                                    $ftype = 'FLOWRACK';
                                } else {
                                    // $ftype = '-';
                                    $data = ItemMasterfile::where('itemcode', '=', $data->itm_code)
                                        ->where('uom', '=', $data->uom)
                                        ->get();

                                    foreach ($data as $datas) {


                                        if ($datas['product_family'] == 'BASIC COMMODITIES' && $datas['conversion_qty'] != '1') {
                                            $ftype = 'BCOM';
                                        } else if ($datas['product_family'] != 'BASIC COMMODITIES' && $datas['conversion_qty'] != '1') {
                                            $ftype = 'BULK';
                                        } else if ($datas['product_family'] == '' && $datas['conversion_qty'] != '1') {
                                            $ftype = 'BULK';
                                        } else if ($datas['conversion_qty'] == '1') {
                                            $ftype = 'FLOWRACK';
                                        }
                                    }
                                }
                            }
                        }

                        $sef_no = $data1->sef_no;
                        $cust_name = $data1->cust_name;
                        $acct_code = $data1->acct_code;
                        $acct_name = $data1->acct_name;
                        $branch_code = $data1->branch_code;
                        $branch_name = $data1->branch_name;
                        $username = $data1->username;
                        $usercode = $data1->usercode;
                        $user_fname = $data1->user_fname;
                        $product_code = $data1->product_code;
                        $product_name = $data1->product_name;
                        $product_uom = $data1->product_uom;
                        $tag = $data->itm_stat;
                        $qty_for_delivery = $data->qty;
                        $qty_ordered = $data1->qty_ordered;
                        $file_type  = $ftype;
                        $date_req = $data1->date_req;

                        $check_exist = SalesExportFiles::where('sef_no', '=', $sef_no)
                            ->where('cust_name', '=', $cust_name)
                            ->where('acct_code', '=', $acct_code)
                            ->where('acct_name', '=', $acct_name)
                            ->where('branch_code', '=', $branch_code)
                            ->where('branch_name', '=', $branch_name)
                            ->where('username', '=', $username)
                            ->where('usercode', '=', $usercode)
                            ->where('user_fname', '=', $user_fname)
                            ->where('product_code', '=', $product_code)
                            ->where('product_name', '=', $product_name)
                            ->where('product_uom', '=', $product_uom)
                            ->where('qty_for_delivery', '=', $qty_for_delivery)
                            ->where('qty_ordered', '=', $qty_ordered)
                            ->where('file_type', '=', $file_type)
                            ->where('tag', '=', $tag)
                            ->where('flag', '=', 2)
                            ->exists();

                        if ($check_exist === false) {

                            SalesExportFiles::insert(
                                [
                                    'sef_no' => $sef_no,
                                    'cust_name' => $cust_name,
                                    'po' => '1',
                                    'acct_code' => $acct_code,
                                    'acct_name' => $acct_name,
                                    'branch_code' => $branch_code,
                                    'branch_name' => $branch_name,
                                    'username' => $username,
                                    'usercode' => $usercode,
                                    'user_fname' => $user_fname,
                                    'timestamp' => $date_now,
                                    'product_code' => $product_code,
                                    'product_name' => $product_name,
                                    'product_uom' => $product_uom,
                                    'qty_for_delivery' => $qty_for_delivery,
                                    'qty_ordered' => $qty_ordered,
                                    'date_generate' => $date_now,
                                    'downloaded' => 'no',
                                    'file_type' => $file_type,
                                    'tag'   => $tag,
                                    'date_req'  => $date_req,
                                    'flag' => '2',
                                    'created_at' => $date_now,
                                    'updated_at' => $date_now
                                ]
                            );
                        }
                    }
                }
            }
        }

        // DB::commit();


        return SalesExportFiles::where('downloaded', '=', 'no')
            ->where('flag', '=', 2)
            ->orderBy('sef_id', 'DESC')
            ->get();
    }
    
    // kaloy 2022-04-07
    // public function getAris($stat='')
    // {
    //     set_time_limit(0);
        
    //     $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
    //     $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();

    //     $status = request()->status ?? $stat;

    //     // temporary solution to allow full GROUP BY
    //     config()->set('database.connections.mysql.strict', false);
    //     DB::reconnect();

    //     $res = DB::table('consolidated_transactions')
    //     ->select(
    //         'consolidated_transactions.reference_no', 
    //         'consolidated_transactions.created_at', 
    //         'consolidated_transactions.date_uploaded', 
    //         'consolidated_transactions.posting_date', 
    //         'consolidated_transactions.customer_code', 
    //         'consolidated_transactions.sales_invoice', 
    //         'consolidated_transactions.salesman_code', 
    //         'consolidated_transactions.status', 
    //         //
    //         'tb_tran_head.pmeth_type', 
    //         //
    //         'tb_cheque_data.cheque_no', 
    //         'tb_cheque_data.cheque_date', 
    //         'tb_cheque_data.account_no', 
    //         'tb_cheque_data.payor_name', 
    //         'tb_cheque_data.bank_name', 
    //         //
    //     )
    //     ->addSelect(DB::raw('SUM(consolidated_transactions.total_amt) AS sales_invoice_total_amount'))
    //     ->addSelect(DB::raw('SUM(tb_unserved_items.tot_amt) AS returned_total_amount'))

    //     ->join('tb_tran_head', function($join){
    //         $join->on('consolidated_transactions.reference_no','=','tb_tran_head.tran_no');
    //     })
    //     ->leftJoin('tb_cheque_data', function($join){
    //         $join->on('consolidated_transactions.reference_no','=','tb_cheque_data.tran_no');
    //     })
    //     ->leftJoin('tb_unserved_items', function($join){
    //         $join->on('consolidated_transactions.reference_no','=','tb_unserved_items.tran_no')
    //             ->on('consolidated_transactions.itemcode','=','tb_unserved_items.itm_code')
    //             ->on('consolidated_transactions.uom','=','tb_unserved_items.uom');
    //         $join->where('tb_unserved_items.itm_stat','=','Returned');
    //     })
    //     ->where('tb_tran_head.tran_stat','Delivered')
        
    //     ->where('consolidated_transactions.status',$status);
        
    //     if($status != 'Exported') {
    //         $res->whereDate('consolidated_transactions.posting_date', '>=', $dateFrom)
    //             ->whereDate('consolidated_transactions.posting_date', '<=', $dateTo);
    //     }

    //     $res->groupBy('consolidated_transactions.sales_invoice');

    //     $res = $res->get();

    //     // temporary solution to allow full GROUP BY - set strict mode back to true
    //     config()->set('database.connections.mysql.strict', true);
    //     DB::reconnect();

    //     return $res;
    // }
    public function getAris($stat='', $forDownload=false)
    {
        set_time_limit(0);
        
        // $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
        // $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();

        $status = request()->status ?? $stat;
        $searchKey = request()->searchKey ?? '';

        // temporary solution to allow full GROUP BY
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect();

        $res = DB::table('consolidated_transactions')
        ->select(
            'consolidated_transactions.reference_no', 
            'consolidated_transactions.created_at', 
            'consolidated_transactions.date_uploaded', 
            'consolidated_transactions.posting_date', 
            'consolidated_transactions.customer_code', 
            'consolidated_transactions.sales_invoice', 
            'consolidated_transactions.salesman_code', 
            'consolidated_transactions.status', 
            //
            'tb_tran_head.pmeth_type', 
            //
            'tb_cheque_data.cheque_no', 
            'tb_cheque_data.cheque_date', 
            'tb_cheque_data.account_no', 
            'tb_cheque_data.payor_name', 
            'tb_cheque_data.bank_name', 
            //
        )
        ->addSelect(DB::raw('SUM(consolidated_transactions.total_amt) AS sales_invoice_total_amount'))
        ->addSelect(DB::raw('SUM(tb_unserved_items.tot_amt) AS returned_total_amount'))

        ->join('tb_tran_head', function($join){
            $join->on('consolidated_transactions.reference_no','=','tb_tran_head.tran_no');
        })
        ->leftJoin('tb_cheque_data', function($join){
            $join->on('consolidated_transactions.reference_no','=','tb_cheque_data.tran_no');
        })
        ->leftJoin('tb_unserved_items', function($join){
            $join->on('consolidated_transactions.reference_no','=','tb_unserved_items.tran_no')
                ->on('consolidated_transactions.itemcode','=','tb_unserved_items.itm_code')
                ->on('consolidated_transactions.uom','=','tb_unserved_items.uom');
            $join->where('tb_unserved_items.itm_stat','=','Returned');
        })
        ->where('tb_tran_head.tran_stat','Delivered')
        ->where('consolidated_transactions.status',$status);

        // kaloy 2022-04-07
        // apply search filter if not for download
        if($forDownload==false) {
            $res->where(function($query) use (&$searchKey) {
                $query->where('sales_invoice','like', '%'. $searchKey . '%')
                ->orWhere('reference_no','like', '%'. $searchKey . '%')
                ->orWhere('posting_date','like', '%'. $searchKey . '%')
                ->orWhere('customer_code','like', '%'. $searchKey . '%');
            });
        }
        
        // if($status != 'Exported') {
        //     $res->whereDate('consolidated_transactions.posting_date', '>=', $dateFrom)
        //         ->whereDate('consolidated_transactions.posting_date', '<=', $dateTo);
        // }
        
        // group by sales_invoice
        $res->groupBy('consolidated_transactions.sales_invoice');
        
        if($forDownload) {
            $res = $res->get();
        } else {
            $res = $res->paginate(10);
        }

        // temporary solution to allow full GROUP BY - set strict mode back to true
        config()->set('database.connections.mysql.strict', true);
        DB::reconnect();

        return $res;
    }


    /**
     * Get data for sales export (BCOM, BULK, VARIOUS)
     */
    public function getBcom()
    {
        // kaloy 2022-03-09
        set_time_limit(0);
        
        // dump(?);
        $ftype = '';
        // $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
        // $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();
        // $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date = Carbon::now()->toDateString();
        $datenow = Carbon::now()->toDateTimeString();
        $timenow = Carbon::now()->toTimeString();

        $check2 = DB::table('tb_tran_head')
            ->whereDate('date_req', $date)
            ->where('tran_stat', '=', 'Cancelled')
            ->get();

        foreach ($check2 as $check2_data) {
            SalesExportFiles::where('sef_no', $check2_data->tran_no)->delete();
        }


        // ->join('item_masterfiles',"item_masterfiles.itemcode","=","tb_tran_line.itm_code")
        $sef = DB::table("tb_tran_head")
            ->join("tb_tran_line", "tb_tran_line.tran_no", "=", "tb_tran_head.tran_no")
            ->join('item_masterfiles', function($join){
                $join->on('tb_tran_line.itm_code','=','item_masterfiles.itemcode');
                $join->on('tb_tran_line.uom','=','item_masterfiles.uom');
                // $join->on('tb_tran_line.item_desc','=','item_masterfiles.product_name');
            })
            ->join("customer_master_files", "customer_master_files.account_code", '=', "tb_tran_head.account_code")
            ->join("salesman_lists", "salesman_lists.user_code", '=', "tb_tran_head.sm_code")
            ->select('tb_tran_head.tran_no', 'tb_tran_head.date_req', 'tb_tran_head.account_code', 
                'tb_tran_head.date_app', 'tb_tran_head.sm_code', "tb_tran_line.itm_code", 
                "tb_tran_line.item_desc", "req_qty", "tb_tran_line.uom", 
                "customer_master_files.account_name", "customer_master_files.branch_code", 
                "customer_master_files.branch_name", "salesman_lists.username", 
                "salesman_lists.first_name", "salesman_lists.last_name",
                "item_masterfiles.product_name"
                
            )
            // "item_masterfiles.itemcode","item_masterfiles.uom","item_masterfiles.status"
            //->whereDate('tb_tran_head.date_req', '=', $date)
            ->where('tb_tran_head.tran_stat', '=', 'Pending')
            ->where('item_masterfiles.status', '=', 1)
            ->get();


        foreach ($sef as $sef_data) {
            $t_no = $sef_data->tran_no;
            $date_req = $sef_data->date_req;
            $account_code = $sef_data->account_code;
            $date_app = $sef_data->date_app;
            $sm_code = $sef_data->sm_code;

            $account_name = $sef_data->account_name;
            $branch_code = $sef_data->branch_code;
            $branch_name = $sef_data->branch_name;
            $username = $sef_data->username;
            $first_name = $sef_data->first_name;
            $last_name = $sef_data->last_name;
            $fullname = $first_name . " " . $last_name;

            $itm_code = $sef_data->itm_code;
            // $item_desc = $sef_data->item_desc;
            $item_desc = $sef_data->product_name;
            $req_qty = $sef_data->req_qty;
            $uom = $sef_data->uom;

            // $isItemActive = DB::table('item_masterfiles')->where('itemcode', $itm_code)
            //     ->where('uom', $uom)->where('status', 1)->exists();
            // dd($isItemActive);

            $check = SalesExportFiles::where([['sef_no', '=', $t_no], ['product_code', '=', $itm_code], ['product_uom', '=', $uom]])
                // ->whereDate('date_req', $date)
                ->first();

            if ($check === null) {

                //Check Item Type

                $type1 = DB::table('tbl_item_bulk')
                    ->where([['item_code', '=', $itm_code], ['uom', '=', $uom]])
                    ->first();

                if ($type1 != null) {

                    $ftype = 'BULK';
                } else {
                    $type2 = DB::table('tbl_item_bcom')
                        ->where([['item_code', '=', $itm_code], ['uom', '=', $uom]])
                        ->first();

                    if ($type2 != null) {

                        $ftype = 'BCOM';
                    } else {
                        $type3 = DB::table('tbl_item_flowrack')
                            ->where([['item_code', '=', $itm_code], ['uom', '=', $uom]])
                            ->first();

                        if ($type3 != null) {

                            $ftype = 'FLOWRACK';
                        } else {
                            // $ftype = '-';
                            $data = ItemMasterfile::where('itemcode', '=', $itm_code)
                                ->where('uom', '=', $uom)
                                // ->where('status', 1)
                                ->get();

                            foreach ($data as $datas) {
                                if ($datas['product_family'] == 'BASIC COMMODITIES' && $datas['conversion_qty'] != '1') {
                                    $ftype = 'BCOM';
                                } else if ($datas['product_family'] != 'BASIC COMMODITIES' && $datas['conversion_qty'] != '1') {
                                    $ftype = 'BULK';
                                } else if ($datas['product_family'] == '' && $datas['conversion_qty'] != '1') {
                                    $ftype = 'BULK';
                                } else if ($datas['conversion_qty'] == '1') {
                                    $ftype = 'FLOWRACK';
                                }
                            }
                        }
                    }
                }

                // if($isItemActive) {
                    if (empty($date_app)) {
                        $date_app1 = '-';
                        SalesExportFiles::insert(
                                [
                                    'sef_no' => $t_no,
                                    'cust_name' => $account_name,
                                    'po' => '1',
                                    'acct_code' => $account_code,
                                    'acct_name' => $account_name,
                                    'branch_code' => $branch_code,
                                    'branch_name' => $branch_name,
                                    'username' => $username,
                                    'usercode' => $sm_code,
                                    'user_fname' => $fullname,
                                    'timestamp' => $datenow,
                                    'product_code' => $itm_code,
                                    'product_name' => $item_desc,
                                    'product_uom' => $uom,
                                    'qty_for_delivery' => $req_qty,
                                    'qty_ordered' => $req_qty,
                                    'date_generate' => $date,
                                    'downloaded' => 'no',
                                    'file_type' => $ftype,
                                    'tag' => 'Exported',
                                    'date_req'  => $date_req,
                                    'flag' => '1',
                                    'created_at' => $date,
                                    'updated_at' => $date
                                ]
                        );
                    } else {
                        SalesExportFiles::insert(
                            [
                                'sef_no' => $t_no,
                                'cust_name' => $account_name,
                                'po' => '1',
                                'acct_code' => $account_code,
                                'acct_name' => $account_name,
                                'branch_code' => $branch_code,
                                'branch_name' => $branch_name,
                                'username' => $username,
                                'usercode' => $sm_code,
                                'user_fname' => $fullname,
                                'timestamp' => $datenow,
                                'product_code' => $itm_code,
                                'product_name' => $item_desc,
                                'product_uom' => $uom,
                                'qty_for_delivery' => $req_qty,
                                'qty_ordered' => $req_qty,
                                'date_generate' => $date,
                                'downloaded' => 'no',
                                'file_type' => $ftype,
                                'tag' => 'Exported',
                                'date_req'  => $date_req,
                                'flag' => '1',
                                'created_at' => $date,
                                'updated_at' => $date
                            ]
                        );
                    }
                // }
            }
        }
        
        // $get_cut_off = DB::table('order_cut_off_time')->select('cut_off_time')->first();
        // kaloy 2022-07-19
        $get_cut_off = DB::table('tbl_cut_off')
        ->select('cut_off_time')
        ->leftJoin('salesman_lists','salesman_lists.division','tbl_cut_off.division')
        ->first();
        $cut_off = $get_cut_off->cut_off_time;

        $query = SalesExportFiles::select('sales_export_files.*')
            ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            // kaloy 2022-06-28
            ->where('sales_export_files.downloaded', '=', 'no')
            ->where('sales_export_files.flag', '=', 1)
            ->where('sales_export_files.date_req', '>=', "$date $cut_off")
            ->where('tb_tran_head.order_by', '=', 'Backend');

        return SalesExportFiles::select('sales_export_files.*')
            ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'sales_export_files.sef_no')
            ->where('sales_export_files.downloaded', '=', 'no')
            ->where('sales_export_files.flag', '=', 1)
            ->where('sales_export_files.date_req', '<=', "$date $cut_off")
            ->orderBy('sales_export_files.sef_id', 'DESC')
            ->union($query)
            // kaloy 2021-10-14
            ->paginate(20000);
    }


    public function setCutoffTime(Request $request)
    {

        $check = DB::table('order_cut_off_time')->count();
        if ($check == 0) {
            DB::table('order_cut_off_time')->insert([
                'cut_off_time' => $request->time_cut_off
            ]);

            return response()->json(['message' => 'Cut-off time has been added.']);
        } else {
            DB::table('order_cut_off_time')
                ->where('cut_off_id', 1)
                ->update(['cut_off_time' => $request->time_cut_off]);

            return response()->json(['message' => 'Cut-off time has been updated.']);
        }
    }

    public function getTimeSetup()
    {
        $data = DB::table('order_cut_off_time')->first();

        return response()->json($data);
    }

    public function getBulk()
    {
        return SalesExportFiles::where('file_type', '=', 'BULK')->paginate(10);
    }

    public function searchBcom()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $search = request()->name;
        // return SalesExportFiles::where()->paginate(10);

        return SalesExportFiles::where(function ($query) {
            $search = request()->name;
            $query->where('sef_no', 'LIKE', "%$search%")
                ->orwhere('acct_name', 'LIKE', "%$search%")
                ->orWhere('acct_code', 'LIKE', "%$search%")
                ->orWhere('product_code', 'LIKE', "%$search%")
                ->orWhere('product_name', 'LIKE', "%$search%")
                ->orWhere('product_uom', 'LIKE', "%$search%")
                ->orWhere('file_type', 'LIKE', "%$search%");
        })
            ->whereDate('date_generate', $date)
            ->paginate(10);
    }

    public function searchBulk()
    {
        $search = request()->name;
        // return SalesExportFiles::where()->paginate(10);
        return SalesExportFiles::where([['file_type', '=', 'BULK'], ['acct_name', 'LIKE', "%$search%"]])->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesExportFiles  $salesExportFiles
     * @return \Illuminate\Http\Response
     */
    public function show(SalesExportFiles $salesExportFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesExportFiles  $salesExportFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesExportFiles $salesExportFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesExportFiles  $salesExportFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesExportFiles $salesExportFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesExportFiles  $salesExportFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesExportFiles $salesExportFiles)
    {
        //
    }
}
