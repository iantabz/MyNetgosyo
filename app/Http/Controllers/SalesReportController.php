<?php

namespace App\Http\Controllers;

use \PDF;
use App\CustomerMasterFile;
use App\SalesmanList;
use App\TblHepeDeViaje;
use App\TbTranHead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function getSalesman()
    {
        $get = SalesmanList::select(
            'salesman_lists.id as id',
            'salesman_lists.first_name',
            'salesman_lists.last_name',
            'salesman_lists.user_code as salesman_code'
        )
            ->where('status', 1)
            ->orderBy('user_code')
            ->get();

        return $get;
    }

    public function getCustomer()
    {
        // dd(request()->all());
        $code = request()->code;
        if ($code == 'All') {
            return DB::table('tb_tran_head')
                ->selectRaw('DISTINCT(customer_master_files.account_name), customer_master_files.account_code, tbl_customer_salesman.salesman_code, salesman_lists.first_name, salesman_lists.last_name')
                ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
                ->join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
                ->join('salesman_lists', 'salesman_lists.user_code', '=', 'tbl_customer_salesman.salesman_code')
                ->where([
                    ['tb_tran_head.tran_stat', '=', 'Delivered'],
                ])
                ->get();

            // return $gethead;
        } else {

            // $gethead = DB::table('tb_tran_head')
            //     ->selectRaw('DISTINCT(customer_master_files.account_name), customer_master_files.account_code, tbl_customer_salesman.salesman_code, salesman_lists.first_name, salesman_lists.last_name')
            //     ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            //     ->join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
            //     ->join('salesman_lists', 'salesman_lists.user_code', '=', 'tbl_customer_salesman.salesman_code')
            //     ->where([
            //         ['tb_tran_head.tran_stat', '=', 'Delivered'],
            //         ['tbl_customer_salesman.salesman_code', '=', $code]
            //     ])
            //     ->get();

            // return $gethead;
            $gethead = DB::table('tb_tran_head')
                ->selectRaw('DISTINCT(customer_master_files.account_name), customer_master_files.account_code, salesman_lists.first_name, salesman_lists.last_name')
                ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
                // ->join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
                ->join('salesman_lists', 'salesman_lists.user_code', '=', 'tb_tran_head.sm_code')
                ->where([
                    ['tb_tran_head.tran_stat', '=', 'Delivered'],
                    ['sm_code', '=', $code]
                ])
                ->get();

            return $gethead;
        }

        //         SELECT DISTINCT
        //     (
        //         customer_master_files.account_name
        //     ),
        //     customer_master_files.account_code,
        //     tbl_customer_salesman.salesman_code
        // FROM
        //     tb_tran_head
        // JOIN tbl_customer_salesman ON tbl_customer_salesman.cus_customer_code = tb_tran_head.account_code
        // JOIN customer_master_files ON customer_master_files.account_code = tb_tran_head.account_code
        // WHERE
        //     tran_stat = 'Delivered' AND tbl_customer_salesman.salesman_code = 'WDG-S01'
    }

    public function selectAll()
    {
        // dd(request()->all());
        $code = request()->code;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();


        if ($code == 'All') {
            return  DB::table('tb_tran_head')
                // ->join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
                ->where([
                    ['tb_tran_head.tran_stat', '=', 'Delivered']
                ])
                ->whereBetween('date_req', [$date, $date2])
                ->orderBy('date_req')
                ->paginate(10);
        } else {
            $result =  DB::table('tb_tran_head')
                // ->join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
                ->where([
                    // ['tbl_customer_salesman.salesman_code', '=', $code],
                    ['sm_code', '=', $code],
                    ['tb_tran_head.tran_stat', '=', 'Delivered']
                ])
                ->whereBetween('date_req', [$date, $date2])
                ->orderBy('date_req')
                ->paginate(10);

            return $result;
        }
    }

    public function getTransaction()
    {
        // dd(request()->all());
        $code = request()->code;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        // dd($code, $date, $date2); 
        $result =  DB::table('tb_tran_head')
            ->where([['account_code', '=', $code], ['tran_stat', '=', 'Delivered']])
            ->whereBetween('date_del', [$date, $date2])
            ->paginate(10);
        // dd($result);
        return $result;
    }

    public function ptype()
    {
        $code = request()->code;
        $ptype = request()->ptype;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        // dd($code, $date, $date2); 
        $result =  DB::table('tb_tran_head')
            ->where([['account_code', '=', $code], ['tran_stat', '=', 'Delivered'], ['pmeth_type', '=', $ptype]])
            ->whereBetween('date_del', [$date, $date2])
            ->paginate(10);
        // dd($result);
        return $result;
    }

    public function printReport()
    {
        $data = $this->data_res();
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->toDateString();

        $pdf = PDF::loadView('reports.sales_report', ['datas' => $data]);
        return $pdf->setPaper('legal', 'landscape')->download('SalesReport-Detailed (' . $date . ' - ' . $date2 . ').pdf');
    }

    public function printReport2()
    {
        // dd(request()->all());
        $data = $this->data_res2();
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->toDateString();

        $pdf2 = PDF::loadView('reports.sales_report2', ['datas' => $data]);
        return $pdf2->setPaper('legal', 'landscape')->download('SalesReport-Summary (' . $date . ' - ' . $date . ').pdf');
    }

    public function data_res()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        $formatdate = date("M jS, Y", strtotime($date));
        $data = [];
        $trans = request()->data;
        $array = explode(',', $trans);
        $salesman = request()->salesman;
        // dump($array);

        $salesman = DB::table('salesman_lists')->where('user_code', '=', $salesman)->get();
        // dd($salesman);

        foreach ($array as $key => $id) {
            $result = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'customer_master_files.account_name')
                ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
                ->where([
                    ['tb_tran_head.tran_no', '=', $id],
                ])
                // ->whereBetween('date_req', [$date, $date2])
                ->orderBy('id')
                ->get();

            $data_res = [];

            // dump($result);
            foreach ($result as $datahead) {
                // dump($datahead);
                $res = DB::table('tb_tran_line')
                    ->selectRaw('tb_tran_line.*,tb_tran_head.tran_stat,tb_tran_line.req_qty - tb_tran_line.del_qty AS unserved,tb_unserved_items.qty AS retQty,tb_unserved_items.itm_stat AS unsRet')
                    ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'tb_tran_line.tran_no')
                    ->leftJoin(
                        'tb_unserved_items',
                        function ($join) {

                            $join->on(
                                'tb_unserved_items.tran_no',
                                '=',
                                'tb_tran_line.tran_no'
                            );

                            $join->on(
                                'tb_unserved_items.itm_code',
                                '=',
                                'tb_tran_line.itm_code'
                            );
                        }
                    )
                    ->where('tb_tran_line.tran_no', '=', $id)
                    ->get();
                // dump($res);

                foreach ($res as $row) {
                    $del_qty = $row->del_qty;
                    $total_ret_amt = $row->retQty * $row->amt;
                    $total_uns_amt = $row->unserved * $row->amt;


                    if ($del_qty == 0) {
                        $total_del_amt = 0;

                        $total = $total_del_amt;
                    } else {
                        $total_del_amt = $del_qty * $row->amt;
                        $total = $total_del_amt;
                    }





                    // dump([$del_qty, $total_del_amt, $total_uns_amt, $total]);


                    $float = (float)$row->discount / 100; //string to float
                    $total_amt_discount = $total_del_amt * $float;
                    if ($total == '0') {
                        $totaltotal = 0;
                    } else {
                        $totaltotal =  $total_del_amt - $total_amt_discount;
                    }
                    $data_res[] = array(
                        "doc_no"                            =>  $row->doc_no,
                        "tran_no"                           => $row->tran_no,
                        "nav_invoice_no"                    => $row->nav_invoice_no,
                        "itm_code"                          => $row->itm_code,
                        "item_desc"                         => $row->item_desc,
                        "req_qty"                           => $row->req_qty,
                        "del_qty"                           => $row->del_qty,
                        "uom"                               => $row->uom,
                        "amt"                               => $row->amt,
                        "discount"                          => $row->discount,
                        // 'line_tot_amt'                      =>  $row->line_tot_amt,
                        "tot_amt"                           => $row->tot_amt,
                        "discounted_amount"                 => $row->discounted_amount,
                        "itm_cat"                           => $row->itm_cat,
                        "itm_stat"                          => $row->itm_stat,
                        "flag"                              => $row->flag,
                        "account_code"                      => $row->account_code,
                        "date_req"                          => $row->date_req,
                        "lrate"                             => $row->lrate,
                        "rated"                             => $row->rated,
                        'unserved'                          =>  $row->unserved,
                        'retQty'                            =>  $row->retQty,
                        'total_del_amt'                     =>  $total_del_amt,
                        'total_ret_amt'                     =>  $total_ret_amt,
                        'total_uns_amt'                     => $total_uns_amt,
                        'total_gross'                       =>  $total,
                        'total_amt_discount'                => $total_amt_discount,
                        'totaltotal'                        => $totaltotal
                    );
                    // dd($data_res);
                }

                $data[] = array(
                    'tran_no'       => $datahead->tran_no,
                    'store_name'    =>  $datahead->store_name,
                    'so_no'         =>  $datahead->tran_no,
                    'date_now'      =>  Carbon::now(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'payment_meth'  => $datahead->p_meth,
                    'payment_meth_type' => $datahead->pmeth_type,
                    'tot_del_amt'   => $datahead->tot_del_amt,
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'date_del'      => date('m/d/Y', strtotime($datahead->date_del)),
                    'datas'         => $data_res,
                    'date_from'     => $formatdate,
                    'date_to'       => $date2
                );
            }
        }
        return $data;
    }

    public function data_res2()
    {
        // dd(request()->all());
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        $formatdate = date("M jS, Y", strtotime($date));
        $formatdate2 = date("M jS, Y", strtotime($date2));
        $data = [];
        $trans = request()->data;
        $array = explode(',', $trans);
        $salesman_code = request()->salesman;
        $dateNow = Carbon::now()->toFormattedDateString();
        $timeNow = Carbon::now()->format('h:i:s A');
        // dump($array);

        $salesman = DB::table('salesman_lists')->where('user_code', '=', $salesman_code)->get();
        // dd($salesman->first()->first_name, $salesman->first()->last_name);

        foreach ($array as $key => $id) {
            $result = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'customer_master_files.account_name')
                ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
                ->where([
                    ['tb_tran_head.tran_no', '=', $id],
                ])
                // ->whereBetween('date_req', [$date, $date2])
                ->orderBy('id')
                ->get();

            $data_res = [];
            $header = [];

            // dump($result);
            foreach ($result as $datahead) {
                // dump($datahead);
                $res = DB::table('tb_tran_line')
                    ->selectRaw('tb_tran_line.*,tb_tran_head.tran_stat,tb_tran_line.req_qty - tb_tran_line.del_qty AS unserved,tb_unserved_items.qty AS retQty,tb_unserved_items.itm_stat AS unsRet')
                    ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'tb_tran_line.tran_no')
                    ->leftJoin(
                        'tb_unserved_items',
                        function ($join) {

                            $join->on(
                                'tb_unserved_items.tran_no',
                                '=',
                                'tb_tran_line.tran_no'
                            );

                            $join->on(
                                'tb_unserved_items.itm_code',
                                '=',
                                'tb_tran_line.itm_code'
                            );
                        }
                    )
                    ->where('tb_tran_line.tran_no', '=', $id)
                    ->get();
                // dump($res);

                foreach ($res as $row) {
                    $del_qty = $row->req_qty -  $row->retQty;

                    if ($del_qty == '0') {
                        $total_del_amt = 0;
                    } else {
                        $total_del_amt = $del_qty * $row->amt;
                    }
                    $total_ret_amt = $row->retQty * $row->amt;
                    $total_uns_amt = $row->unserved * $row->amt;

                    if ($total_del_amt == '0') {
                        $total = 0;
                    } else {
                        $total = $total_del_amt - $total_uns_amt;
                    }

                    // dump([$del_qty, $total_del_amt, $total_uns_amt, $total]);


                    $float = (float)$row->discount / 100; //string to float
                    $total_amt_discount = $total_del_amt * $float;
                    if ($total == '0') {
                        $totaltotal = 0;
                    } else {
                        $totaltotal =  $total_del_amt - $total_amt_discount;
                    }
                    $data_res[] = array(
                        "doc_no"                            =>  $row->doc_no,
                        "tran_no"                           => $row->tran_no,
                        "nav_invoice_no"                    => $row->nav_invoice_no,
                        "itm_code"                          => $row->itm_code,
                        "item_desc"                         => $row->item_desc,
                        "req_qty"                           => $row->req_qty,
                        "del_qty"                           => $row->del_qty,
                        "uom"                               => $row->uom,
                        "amt"                               => $row->amt,
                        "discount"                          => $row->discount,
                        // 'line_tot_amt'                      =>  $row->line_tot_amt,
                        "tot_amt"                           => $row->tot_amt,
                        "discounted_amount"                 => $row->discounted_amount,
                        "itm_cat"                           => $row->itm_cat,
                        "itm_stat"                          => $row->itm_stat,
                        "flag"                              => $row->flag,
                        "account_code"                      => $row->account_code,
                        "date_req"                          => $row->date_req,
                        "lrate"                             => $row->lrate,
                        "rated"                             => $row->rated,
                        'unserved'                          =>  $row->unserved,
                        'retQty'                            =>  $row->retQty,
                        'total_del_amt'                     =>  $total_del_amt,
                        'total_ret_amt'                     =>  $total_ret_amt,
                        'total_uns_amt'                     => $total_uns_amt,
                        'total_gross'                       =>  $total,
                        'total_amt_discount'                => $total_amt_discount,
                        'totaltotal'                        => $totaltotal
                    );
                    // dd($data_res);
                }

                $data[] = array(
                    'tran_no'       => $datahead->tran_no,
                    'store_name'    =>  $datahead->store_name,
                    'so_no'         =>  $datahead->tran_no,
                    'date_now'      =>  Carbon::now(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'payment_meth'  => $datahead->p_meth,
                    'payment_meth_type' => $datahead->pmeth_type,
                    'tot_del_amt'   => $datahead->tot_del_amt,
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'date_del'      => date('m/d/Y', strtotime($datahead->date_del)),
                    'datas'         => $data_res,
                    'date_from'     => $formatdate,
                    'date_to'       => $date2
                );
            }
            $header[] = array(
                'first_name'    => $salesman->first()->first_name,
                'last_name'     =>  $salesman->first()->last_name,
                'date_from'     => $formatdate,
                'date_to'       => $formatdate2,
                'date_now'      => $dateNow,
                'time_now'       => $timeNow,
                'trans_data'    => $data
            );
            // dd($header);
        }
        return $header;
    }

    public function getJepe()
    {
        $get = TblHepeDeViaje::select(
            'id',
            'first_name',
            'last_name',
            'user_code as hepe_code',
        )
            ->orderBy('hepe_code')
            ->get();

        return $get;
    }

    public function getJepeSales()
    {
        $code = request()->code;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        return  TbTranHead::selectRaw('CONCAT(first_name ," ", last_name) AS name, sm_code, SUM(tot_del_amt) as tot_del_amt')
            ->join('salesman_lists', 'salesman_lists.user_code', 'tb_tran_head.sm_code')
            ->where([['hepe_code', '=', $code], ['tran_stat', '=', 'Delivered']])
            ->whereBetween('date_del', [$date, $date2])
            ->groupByRaw('tot_del_amt, sm_code, name')
            ->paginate(10);


        // $result =  DB::table('tb_tran_head')
        // ->join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
        // ->where([
        //     ['tbl_customer_salesman.salesman_code', '=', $code],
        //     ['tb_tran_head.tran_stat', '=', 'Delivered']
        // ])
        // ->whereBetween('date_del', [$date, $date2])
        // ->orderBy('date_del')
        // ->paginate(10);
    }

    public function printSummary()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        $finaldate2 = Carbon::parse(base64_decode(request()->date2))->toDateString();
        $code = request()->jepe;

        $data = $this->data_printSummary($date, $date2, $finaldate2, $code);
        set_time_limit(0);

        $pdf = PDF::loadView('reports.sales_report_jepe', compact('data'));
        return $pdf->setPaper('legal', 'landscape')->download('Sales Report per Jepe de Viaje (' . $date . ' - ' . $finaldate2 . ').pdf');
    }

    public function data_printSummary($date, $date2, $finaldate2, $code)
    {
        $getJepe = TblHepeDeViaje::where('user_code', '=', $code)->get();
        $dateNow = Carbon::now()->toFormattedDateString();
        $timeNow = Carbon::now()->format('h:i:s A');

        $query = TbTranHead::selectRaw('CONCAT(first_name ," ", last_name) AS name, SUM(tot_del_amt) as tot_del_amt')
            ->join('salesman_lists', 'salesman_lists.user_code', 'tb_tran_head.sm_code')
            ->whereBetween('tb_tran_head.date_req', [$date, $date2])
            ->where([
                ['tran_stat', 'Delivered'],
                ['hepe_code', $code]
            ])
            ->groupByRaw('tot_del_amt, name')
            ->get();


        foreach ($query as $row) {

            $data[] = array(
                'name'       => $row->name,
                'tot_del_amt'    =>  $row->tot_del_amt
            );
        }

        $header = array(
            'first_name'    => $getJepe->first()->first_name,
            'last_name'     =>  $getJepe->first()->last_name,
            'date_from'     => $date,
            'date_to'       => $finaldate2,
            'date_now'      => $dateNow,
            'time_now'      => $timeNow,
            'data'          => $data
        );

        // dd($header);
        return $header;
    }

    public function getOrderHistory()
    {
        $option = request()->option;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $query = TbTranHead::with('getSalesmanDetails', 'getCustomerDetails', 'getJepeDetails');
        if ($option == 'Date Requested') $query = $query->whereBetween('date_req', [$date, $date2]);
        if ($option == 'Export Date')    $query = $query->whereBetween('export_date', [$date, $date2]);
        if ($option == 'Date Transit')    $query = $query->whereBetween('date_transit', [$date, $date2]);
        if ($option == 'Date Delivered') $query = $query->whereBetween('date_del', [$date, $date2]);


        $query = $query->paginate(100);
        return $query;
    }

    public function printOrderHistory()
    {
        $option = request()->option;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $data = $this->OrderHistoryData($date, $date2, $option);
        set_time_limit(0);

        $pdf = PDF::loadView('reports.order_history_report', compact('data'));
        return $pdf->setPaper('a4', 'landscape')->download('Order History (' . $date . ' - ' . $date2 . ').pdf');
    }

    public function OrderHistoryData($date, $date2, $option)
    {
        $option = request()->option;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        $dateNow = Carbon::now()->toFormattedDateString();
        $timeNow = Carbon::now()->format('h:i:s A');
        $d = Carbon::parse(base64_decode(request()->date))->toFormattedDateString();
        $d2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toFormattedDateString();

        $query = TbTranHead::with('getSalesmanDetails', 'getCustomerDetails', 'getJepeDetails');
        if ($option == 'Date Requested') $query = $query->whereBetween('date_req', [$date, $date2]);
        if ($option == 'Export Date')    $query = $query->whereBetween('export_date', [$date, $date2]);
        if ($option == 'Date Transit')    $query = $query->whereBetween('date_transit', [$date, $date2]);
        if ($option == 'Date Delivered') $query = $query->whereBetween('date_del', [$date, $date2]);


        $query = $query->get();

        foreach ($query as $row) {
            $var = '';
            $date_req = '';
            $date_export = '';
            $date_del = '';
            $date_transit = '';
            $amount = $row->tot_amt;

            if ($row['getJepeDetails']) $var = $row['getJepeDetails']->first_name . ' ' . $row['getJepeDetails']->last_name;
            if ($row->date_req) $date_req = Carbon::parse($row->date_req)->format('m/d/y');
            if ($row->export_date) $date_export = Carbon::parse($row->export_date)->format('m/d/y');
            if ($row->date_del) $date_del = Carbon::parse($row->date_del)->format('m/d/y');
            if ($row->date_transit) $date_transit = Carbon::parse($row->date_transit)->format('m/d/y');
            if ($row->tot_del_amt) $amount = $row->tot_del_amt;

            $data[] = array(
                'location'       => $row['getCustomerDetails']->address3,
                'tran_no'    =>  $row->tran_no,
                'customer' => $row['getCustomerDetails']->account_name,
                'date_req' => $date_req,
                'export_date' =>  $date_export,
                'date_delivered' =>  $date_del,
                'date_transit' =>  $date_transit,
                'salesman' => $row['getSalesmanDetails']->first_name . ' ' . $row['getSalesmanDetails']->last_name,
                'jepe' =>  $var,
                'amount' => $amount
            );
        }


        $header = array(
            'date_from'     => $d,
            'date_to'       => $d2,
            'date_now'      => $dateNow,
            'time_now'      => $timeNow,
            'data'          => $data
        );

        // dd($header);
        return $header;
    }
}
