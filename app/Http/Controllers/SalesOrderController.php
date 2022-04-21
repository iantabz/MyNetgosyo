<?php

namespace App\Http\Controllers;

use App\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getCategories()
    {
        $categories = DB::table('tbl_category_masterfile')->get();

        return response()->json($categories);
    }

    public function getCustomerInfo(Request $request)
    {
        // dd($request->all());
        $user_info = DB::table('customer_master_files')->where('account_code', '=', $request->account_code)->get();
        return response()->json($user_info);
    }

    public function getCustomers()
    {
        $accountName = request()->accountname;
        $customers = DB::table('customer_master_files')
            ->where('account_name', 'LIKE', "%$accountName%")
            ->orWhere('account_code', 'LIKE', "%$accountName%")
            ->get();

        return response()->json($customers);
    }

    public function getAddTransaction()
    {
        return DB::table('tb_tran_head')
            ->where([['order_by', '=', 'Backend']])
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function searchAddTrans()
    {
        $search = request()->name;
        return DB::table('tb_tran_head')->where('store_name', 'LIKE', "%$search%")->paginate(10);
    }

    public function cancelOrder(Request $request)
    {
        $result_h = DB::table('tb_tran_head')
            ->where('tran_no', '=', $request->tran_no)
            ->exists();

        if ($result_h === TRUE) {

            $result_l = DB::table('tb_tran_line')
                ->where('tran_no', '=', $request->tran_no)
                ->exists();

            if ($result_l === TRUE) {

                DB::table('tb_tran_head')
                    ->where('tran_no', '=', $request->tran_no)
                    ->update([
                        'tran_stat' => 'Cancelled'
                    ]);

                DB::table('tb_tran_line')
                    ->where('tran_no', '=', $request->tran_no)
                    ->update([
                        'itm_stat' => 'Cancelled'
                    ]);

                return 'Success';
            }
        }
    }

    public function index()
    {
        return SalesOrder::latest()->paginate(10);
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

        // dd($request->all());

        $count = 1;
        $date_now = Carbon::now();
        $date = date('mdy', strtotime($date_now));
        $price = floatval($request->list_price_wtax);
        $qty = $request->account_qty;
        $total_amt = $price * $qty;

        $check_transcode = $request->check_transcode;


        if ($request->trans_code === null) {

            if ($check_transcode === null) {
                if ($request->account_smcode[0] === null) {
                    return 'Error';
                }

                $account_code = $request->account_code;
                $tran_no = $date . '' . $count . '-' . $account_code;

                $check_exists = DB::table('tb_tran_head')->select('tran_no')->whereDate('date_req', $date_now)->where('tran_no', $tran_no)->exists();
                if ($check_exists === FALSE) {
                    // dd($tran_no, 'waley');

                    DB::table('tb_tran_head')->insert(
                        [
                            'tran_no' => $tran_no,
                            'nav_invoice_no' => NULL,
                            'date_req'  =>  $date_now,
                            'date_app'  =>  NULL,
                            'date_transit'  =>  NULL,
                            'date_del'  =>  NULL,
                            'account_code'  =>  $account_code,
                            'store_name'    =>  $request->account_name,
                            'p_meth'    =>  'Cash on Delivery',
                            'itm_count' =>  $qty,
                            'itm_del_count' => 0,
                            'tot_amt'   =>  $total_amt,
                            'tot_del_amt'   =>  0,
                            'pmeth_type'    =>  NULL,
                            'tran_stat' =>  'Pending',
                            'sm_code'   =>  $request->account_smcode,
                            'hepe_code' =>  '',
                            'order_by'  =>  'Backend',
                            'flag'  =>  1,
                            'signature' =>  '',
                            'auth_signature'    =>  '',
                            'isExported'    =>  0,
                            'rate_status'   =>  NULL,
                            'sm_upload' =>  'TRUE',
                            'hepe_upload'   =>  'FALSE'
                        ]
                    );

                    DB::table('tb_tran_line')->insert(
                        [
                            'tran_no'   =>  $tran_no,
                            'nav_invoice_no'    =>  '',
                            'itm_code'  =>  $request->itemcode,
                            'item_desc' =>  $request->product_name,
                            'req_qty'   =>  $qty,
                            'del_qty'   =>  0,
                            'uom'   =>  $request->uom,
                            'amt'   =>  $request->list_price_wtax,
                            'discount'  =>  0,
                            'tot_amt'   =>  $total_amt,
                            'discounted_amount' =>  0,
                            'itm_cat'   =>  $request->product_family,
                            'itm_stat'  =>  '',
                            'flag'  =>  0,
                            'account_code'  =>  $account_code,
                            'date_req'  =>  $date_now,
                            'date_del'  =>  NULL,
                            'lrate' =>  0,
                            'rated' =>  NULL
                        ]
                    );

                    return $tran_no;
                } else {
                    // dd($tran_no, 'naa');

                    $code = '';
                    $result = DB::table('tb_tran_head')->select('tran_no')->whereDate('date_req', $date_now)->where('tran_no', 'LIKE', "%$account_code%")->orderBy('id', 'DESC')->first();

                    $code = $result->tran_no;

                    $bits = explode('-', $code);
                    $x = substr($bits[0], -1);
                    $count += $x;

                    $tran_no = $date . '' . $count . '-' . $account_code;

                    DB::table('tb_tran_head')->insert(
                        [
                            'tran_no' => $tran_no,
                            'nav_invoice_no' => NULL,
                            'date_req'  =>  $date_now,
                            'date_app'  =>  NULL,
                            'date_transit'  =>  NULL,
                            'date_del'  =>  NULL,
                            'account_code'  =>  $account_code,
                            'store_name'    =>  $request->account_name,
                            'p_meth'    =>  'Cash on Delivery',
                            'itm_count' =>  $qty,
                            'itm_del_count' => 0,
                            'tot_amt'   =>  $total_amt,
                            'tot_del_amt'   =>  0,
                            'pmeth_type'    =>  NULL,
                            'tran_stat' =>  'Pending',
                            'sm_code'   =>  $request->account_smcode,
                            'hepe_code' =>  '',
                            'order_by'  =>  'Backend',
                            'flag'  =>  1,
                            'signature' =>  '',
                            'auth_signature'    =>  '',
                            'isExported'    =>  0,
                            'rate_status'   =>  NULL,
                            'sm_upload' =>  'TRUE',
                            'hepe_upload'   =>  'FALSE'
                        ]
                    );

                    DB::table('tb_tran_line')->insert(
                        [
                            'tran_no'   =>  $tran_no,
                            'nav_invoice_no'    =>  '',
                            'itm_code'  =>  $request->itemcode,
                            'item_desc' =>  $request->product_name,
                            'req_qty'   =>  $qty,
                            'del_qty'   =>  0,
                            'uom'   =>  $request->uom,
                            'amt'   =>  $request->list_price_wtax,
                            'discount'  =>  0,
                            'tot_amt'   =>  $total_amt,
                            'discounted_amount' =>  0,
                            'itm_cat'   =>  $request->product_family,
                            'itm_stat'  =>  '',
                            'flag'  =>  0,
                            'account_code'  =>  $account_code,
                            'date_req'  =>  $date_now,
                            'date_del'  =>  NULL,
                            'lrate' =>  0,
                            'rated' =>  NULL
                        ]
                    );
                }
            } else {
                $account_code = $request->account_code;
                $tran_no = $date . '' . $count . '-' . $account_code;

                $new_qty = 0;
                $new_total_amt = 0;
                $old_qty = 0;
                $old_total_amt = 0;

                $result = DB::table('tb_tran_line')
                    ->where('tran_no', '=', $request->check_transcode)
                    ->where('itm_code', '=', $request->itemcode)
                    ->where('uom', '=', $request->uom)
                    ->exists();

                if ($result === TRUE) {

                    DB::table('tb_tran_line')
                        ->where('tran_no', '=', $request->check_transcode)
                        ->where('itm_code', '=', $request->itemcode)
                        ->where('uom', '=', $request->uom)
                        ->update([
                            'req_qty' => $qty,
                            'tot_amt' => $total_amt
                        ]);

                    $result1 = DB::table('tb_tran_head')
                        ->where('tran_no', '=', $request->check_transcode)
                        ->exists();

                    if ($result1 === TRUE) {

                        $get_all_line = DB::table('tb_tran_line')
                            ->where('tran_no', '=', $request->check_transcode)
                            ->get();

                        foreach ($get_all_line as $row_l) {
                            $l_qty = $row_l->req_qty;
                            $l_totamt = $row_l->tot_amt;

                            $new_qty += $l_qty;
                            $new_total_amt += $l_totamt;
                        }

                        DB::table('tb_tran_head')
                            ->where('tran_no', '=', $request->check_transcode)
                            ->update([
                                'itm_count' => $new_qty,
                                'tot_amt' => $new_total_amt
                            ]);
                    }
                } else {

                    DB::table('tb_tran_line')->insert(
                        [
                            'tran_no'   =>  $request->check_transcode,
                            'nav_invoice_no'    =>  '',
                            'itm_code'  =>  $request->itemcode,
                            'item_desc' =>  $request->product_name,
                            'req_qty'   =>  $qty,
                            'del_qty'   =>  0,
                            'uom'   =>  $request->uom,
                            'amt'   =>  $request->list_price_wtax,
                            'discount'  =>  0,
                            'tot_amt'   =>  $total_amt,
                            'discounted_amount' =>  0,
                            'itm_cat'   =>  $request->product_family,
                            'itm_stat'  =>  '',
                            'flag'  =>  0,
                            'account_code'  =>  $request->account_code,
                            'date_req'  =>  $date_now,
                            'date_del'  =>  NULL,
                            'lrate' =>  0,
                            'rated' =>  NULL
                        ]
                    );

                    $result1 = DB::table('tb_tran_head')
                        ->where('tran_no', '=', $request->check_transcode)
                        ->exists();

                    if ($result1 === TRUE) {

                        $get_all_line = DB::table('tb_tran_line')
                            ->where('tran_no', '=', $request->check_transcode)
                            ->get();

                        foreach ($get_all_line as $row_l) {
                            $l_qty = $row_l->req_qty;
                            $l_totamt = $row_l->tot_amt;

                            $new_qty += $l_qty;
                            $new_total_amt += $l_totamt;
                        }

                        DB::table('tb_tran_head')
                            ->where('tran_no', '=', $request->check_transcode)
                            ->update([
                                'itm_count' => $new_qty,
                                'tot_amt' => $new_total_amt
                            ]);
                    }
                }
            }
        } else {

            $account_code = $request->account_code;
            $tran_no = $date . '' . $count . '-' . $account_code;

            $new_qty = 0;
            $new_total_amt = 0;
            $old_qty = 0;
            $old_total_amt = 0;

            $result = DB::table('tb_tran_line')
                ->where('tran_no', '=', $request->trans_code)
                ->where('itm_code', '=', $request->itemcode)
                ->where('uom', '=', $request->uom)
                ->exists();

            if ($result === TRUE) {

                DB::table('tb_tran_line')
                    ->where('tran_no', '=', $request->trans_code)
                    ->where('itm_code', '=', $request->itemcode)
                    ->where('uom', '=', $request->uom)
                    ->update([
                        'req_qty' => $qty,
                        'tot_amt' => $total_amt
                    ]);

                $result1 = DB::table('tb_tran_head')
                    ->where('tran_no', '=', $request->trans_code)
                    ->exists();

                if ($result1 === TRUE) {

                    $get_all_line = DB::table('tb_tran_line')
                        ->where('tran_no', '=', $request->trans_code)
                        ->get();

                    foreach ($get_all_line as $row_l) {
                        $l_qty = $row_l->req_qty;
                        $l_totamt = $row_l->tot_amt;

                        $new_qty += $l_qty;
                        $new_total_amt += $l_totamt;
                    }

                    DB::table('tb_tran_head')
                        ->where('tran_no', '=', $request->trans_code)
                        ->update([
                            'itm_count' => $new_qty,
                            'tot_amt' => $new_total_amt
                        ]);
                }
            } else {

                DB::table('tb_tran_line')->insert(
                    [
                        'tran_no'   =>  $request->trans_code,
                        'nav_invoice_no'    =>  '',
                        'itm_code'  =>  $request->itemcode,
                        'item_desc' =>  $request->product_name,
                        'req_qty'   =>  $qty,
                        'del_qty'   =>  0,
                        'uom'   =>  $request->uom,
                        'amt'   =>  $request->list_price_wtax,
                        'discount'  =>  0,
                        'tot_amt'   =>  $total_amt,
                        'discounted_amount' =>  0,
                        'itm_cat'   =>  $request->product_family,
                        'itm_stat'  =>  '',
                        'flag'  =>  0,
                        'account_code'  =>  $request->account_code,
                        'date_req'  =>  $date_now,
                        'date_del'  =>  NULL,
                        'lrate' =>  0,
                        'rated' =>  NULL
                    ]
                );

                $result1 = DB::table('tb_tran_head')
                    ->where('tran_no', '=', $request->trans_code)
                    ->exists();

                if ($result1 === TRUE) {

                    $get_all_line = DB::table('tb_tran_line')
                        ->where('tran_no', '=', $request->trans_code)
                        ->get();

                    foreach ($get_all_line as $row_l) {
                        $l_qty = $row_l->req_qty;
                        $l_totamt = $row_l->tot_amt;

                        $new_qty += $l_qty;
                        $new_total_amt += $l_totamt;
                    }

                    DB::table('tb_tran_head')
                        ->where('tran_no', '=', $request->trans_code)
                        ->update([
                            'itm_count' => $new_qty,
                            'tot_amt' => $new_total_amt
                        ]);
                }
            }
        }

        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}
