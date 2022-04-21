<?php

namespace App\Http\Controllers\Fixes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestoreLostTrans extends Controller
{
    public function index(Request $request) {
        set_time_limit(3600);

        // $test = DB::table('tb_tran_line')
        //     ->select('tot_amt')
        //     ->sum('tot_amt');
        // dd($test);

        $dateFrom = $request->input('from');
        $dateTo = $request->input('to');

        if($dateFrom == NULL && $dateTo == NULL) {
            die('Please specify date from and to...');
        }

        $res = DB::table('tb_tran_exported')
        // $res = DB::table('sales_export_files')
            ->whereDate('date_req','>=', $dateFrom)
            ->whereDate('date_req','<=', $dateTo)
            // ->where('sef_no','<>','1206211-TAG-01882') // JULIUS BAUTISTA
            ->orderBy('sef_no')
            ->get();
            // ->paginate(30);
        
        // dd($res);

        $lineCount = 0;
        $totalAmount = 0.00;

        $prev_tran_no = '';
        foreach($res as $line) {
            // ============================= tran_line ===================
            $item = null;
   
            $item = DB::table('item_masterfiles')
                ->where('itemcode', $line->product_code)
                ->where('uom', $line->product_uom)
                ->get(['description','product_family','list_price_wtax'])
                ->first();

            if(
                $item != null &&
                DB::table('tb_tran_line')->where('tran_no', $line->sef_no)
                    ->where('itm_code', $line->product_code)
                    ->where('uom', $line->product_uom)
                    ->where('req_qty', $line->qty_ordered)
                    ->exists() == false
            ) {
                $tran_line = [
                    'tran_no' => $line->sef_no,
                    'nav_invoice_no' => '',
                    'itm_code' => $line->product_code,
                    'item_desc' => $item->description,
                    'req_qty' => $line->qty_ordered,
                    'del_qty' => 0,
                    'uom' => $line->product_uom,
                    'amt' => $item->list_price_wtax,
                    'discount' => 0.000000000000000000000000000000,
                    'tot_amt' => ($line->qty_ordered * $item->list_price_wtax),
                    'discounted_amount' => 0.00,
                    'itm_cat' => $item->product_family,
                    'itm_stat' => '',
                    'flag' => 0,
                    'account_code' => $line->acct_code,
                    'date_req' => $line->date_req,
                    'date_del' => NULL,
                    'lrate' => 0.00,
                    'rated' => NULL,
                ];

                $tran_head = [
                    'tran_no' => $line->sef_no,
                    'nav_invoice_no' => NULL,
                    'date_req' => $line->date_req,
                    'date_app' => NULL,
                    'date_transit' => NULL,
                    'date_del' => NULL,
                    'account_code' => $line->acct_code,
                    'store_name' => $line->branch_name,
                    'p_meth' => 'Cash on Delivery',
                    'itm_count' => $line->qty_ordered,
                    'itm_del_count' => NULL,
                    'tot_amt' => $tran_line['tot_amt'],
                    'tot_del_amt' => 0.00,
                    'pmeth_type' => NULL,
                    'tran_stat' => 'Pending',
                    'sm_code' => $line->username,
                    'hepe_code' => '',
                    'order_by' => 'Customer',
                    'flag' => 1,
                    'signature' => '',
                    'auth_signature' => '',
                    'isExported' => 0,
                    'export_date' => NULL,
                    'rate_status' => NULL,
                    'sm_upload' => TRUE,
                    'hepe_upload' => FALSE,
                ];

                
                // Insert or update tran_head =======================================
                // if($line->sef_no != $prev_tran_no) {
                if(
                    DB::table('tb_tran_head')->where('tran_no', $line->sef_no)
                        ->exists() == false
                ) {
                    // add tran_head entry...
                    DB::table('tb_tran_head')->insert($tran_head);
                } else {
                    // update tran_head
                    DB::table('tb_tran_head')
                        ->where('tran_no', $line->sef_no)
                        ->update([
                            'itm_count' => DB::raw("itm_count + $line->qty_ordered"),
                            'tot_amt' => DB::raw("tot_amt + $tran_line[tot_amt]"),
                        ]);
                }

                // Insert or update tran_head =======================================
                DB::table('tb_tran_line')->insert($tran_line);

                $totalAmount += floatval($tran_line['tot_amt']);
                $lineCount+=1;
            }
            // ============================= /tran_line ===================


            $prev_tran_no = $line->sef_no;
            
        }

        // return response("Done! (Line Count: $lineCount)");
        return response("Done! (Lines: $lineCount | Amount: $totalAmount)");
    }
}
