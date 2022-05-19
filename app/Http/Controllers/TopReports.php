<?php

namespace App\Http\Controllers;

use \PDF;
use App\TbTranHead;
use App\TbTranLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopReports extends Controller
{
    public function topProducts()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        return TbTranLine::selectRaw('item_desc, itm_cat, itm_code, uom, amt, SUM(del_qty) AS del_qty, SUM(tot_amt) AS tot_amt')
            ->whereBetween('date_req', [$date, $date2])
            ->where([
                ['itm_stat', 'On-Process'],
                ['del_qty', '>', 0]
            ])
            ->groupByRaw('item_desc, itm_cat, itm_code, uom, amt')
            ->paginate(10);
    }

    public function printTopProducts()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $data = $this->data($date, $date2);

        set_time_limit(0);

        $pdf = PDF::loadView('reports.top_products_report', compact('data'));
        // dd('Top Products ' . $date . '-' . $date2 . '.pdf');
        return $pdf->download('Top Products ' . $date . '-' . $date2 . '.pdf');
    }

    public function data($date, $date2)
    {
        $query = TbTranLine::selectRaw('item_desc, itm_cat, itm_code, uom, amt, SUM(del_qty) AS del_qty, SUM(tot_amt) AS tot_amt')
            ->whereBetween('date_req', [$date, $date2])
            ->where([
                ['itm_stat', 'On-Process'],
                ['del_qty', '>', 0]
            ])
            ->groupByRaw('item_desc, itm_cat, itm_code, uom, amt')
            ->get();

        // dd($query);
        $data = [];
        foreach ($query as $row) {
            $data[] = array(
                'item_desc'      => $row->item_desc,
                'itm_cat'      => $row->itm_cat,
                'itm_code'    => $row->itm_code,
                'uom'     => $row->uom,
                'amt'    => $row->amt,
                'del_qty'      => $row->del_qty,
                'tot_amt'      => $row->tot_amt
            );
        }
        $header = array(
            'date-from' => $date,
            'date-to' => $date2,
            'trans_data' => $data
        );
        return $header;
    }

    public function topCustomers()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        // SUM(itm_count) AS del_qty
        return TbTranHead::selectRaw('store_name, address3, COUNT(store_name) AS del_qty, SUM(tot_amt) AS tot_del_amt')
            ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
            ->whereBetween('tb_tran_head.date_req', [$date, $date2])
            ->where([
                ['tran_stat', 'On-Process']
            ])
            ->groupByRaw('store_name, address3')
            ->paginate(10);
    }

    public function printTopCustomer()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $data = $this->data2($date, $date2);

        set_time_limit(0);

        $pdf = PDF::loadView('reports.top_customer_report', compact('data'));
        return $pdf->download('Top Customers ' . $date . '-' . $date2 . '.pdf');
    }

    public function data2($date, $date2)
    {
        // SUM(itm_count) AS del_qty
        $query = TbTranHead::selectRaw('store_name, address3, COUNT(store_name) AS del_qty, SUM(tot_amt) AS tot_del_amt')
            ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
            ->whereBetween('tb_tran_head.date_req', [$date, $date2])
            ->where([
                ['tran_stat', 'On-Process']
            ])
            ->groupByRaw('store_name, address3')
            ->get();

        // dd($query);
        $data = [];
        foreach ($query as $row) {
            $data[] = array(
                'store_name'      => $row->store_name,
                'address3'      => $row->address3,
                'del_qty'    => $row->del_qty,
                'tot_del_amt'     => $row->tot_del_amt,
            );
        }
        $header = array(
            'date-from' => $date,
            'date-to' => $date2,
            'trans_data' => $data
        );
        return $header;
    }

    public function topSalesman()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        // return  TbTranHead::join('tbl_customer_salesman', 'tbl_customer_salesman.cus_customer_code', '=', 'tb_tran_head.account_code')
        //     ->where([
        //         ['tb_tran_head.tran_stat', '=', 'Delivered']
        //     ])
        //     ->whereBetween('date_del', [$date, $date2])
        //     ->orderBy('date_del')
        //     ->paginate(10);

        return TbTranHead::selectRaw('CONCAT(first_name ," ", last_name) AS name, user_code, SUM(tot_amt) as tot_del_amt')
            ->join('salesman_lists', 'salesman_lists.user_code', 'tb_tran_head.sm_code')
            ->whereBetween('tb_tran_head.date_req', [$date, $date2])
            ->where([
                ['tran_stat', 'On-Process'],
            ])
            ->groupByRaw('name, user_code')
            ->paginate(10);
    }

    public function printTopSalesman()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $data = $this->data3($date, $date2);

        set_time_limit(0);

        $pdf = PDF::loadView('reports.top_salesman_report', compact('data'));
        return $pdf->download('Top Salesman ' . $date . '-' . $date2 . '.pdf');
    }

    public function data3($date, $date2)
    {
        $query = TbTranHead::selectRaw('CONCAT(first_name ," ", last_name) AS name, SUM(tot_amt) as tot_del_amt')
            ->join('salesman_lists', 'salesman_lists.user_code', 'tb_tran_head.sm_code')
            ->whereBetween('tb_tran_head.date_req', [$date, $date2])
            ->where([
                ['tran_stat', 'On-Process'],
            ])
            ->groupByRaw('name, user_code')
            ->get();

        // dd($query);
        $data = [];
        foreach ($query as $row) {
            $data[] = array(
                'name'      => $row->name,
                'tot_del_amt'     => $row->tot_del_amt,
            );
        }
        $header = array(
            'date-from' => $date,
            'date-to' => $date2,
            'trans_data' => $data
        );
        return $header;
    }

    public function topJepe()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        return TbTranHead::selectRaw('CONCAT(first_name ," ", last_name) AS name, user_code, SUM(tot_del_amt) as tot_del_amt')
            ->join('tbl_hepe_de_viaje', 'tbl_hepe_de_viaje.user_code', 'tb_tran_head.hepe_code')
            ->whereBetween('tb_tran_head.date_req', [$date, $date2])
            ->where([
                ['tran_stat', 'Delivered'],
            ])
            ->groupByRaw('name, user_code')
            ->paginate(10);
    }

    public function totalOrderCount()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        return TbTranHead::selectRaw('store_name, COUNT(store_name) as total_order')
            ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
            ->whereBetween('tb_tran_head.date_app', [$date, $date2])
            ->where([
                ['tran_stat', 'On-Process']
            ])
            ->groupByRaw('store_name, address3')
            ->paginate(50);
    }

    public function printTotalOrderCount()
    {
        $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $data = $this->dataForTotalOrderCount($date, $date2);

        set_time_limit(0);

        $pdf = PDF::loadView('reports.customer_order_count_report', compact('data'));
        return $pdf->setPaper('a4', 'landscape')->download('Customer Order Count ' . $date . '-' . $date2 . '.pdf');
    }

    public function dataForTotalOrderCount($date, $date2)
    {
        $dateNow = Carbon::now()->toFormattedDateString();
        $timeNow = Carbon::now()->format('h:i:s A');
        $d = Carbon::parse(base64_decode(request()->date))->toFormattedDateString();
        $d2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toFormattedDateString();

        $query = TbTranHead::selectRaw('store_name, COUNT(store_name) as total_order')
            ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
            ->whereBetween('tb_tran_head.date_app', [$date, $date2])
            ->where([
                ['tran_stat', 'On-Process']
            ])
            ->groupByRaw('store_name, address3')
            ->get();

        // dd($query);
        $data = [];
        foreach ($query as $row) {
            $data[] = array(
                'customer_name'      => $row->store_name,
                'total_order'     => $row->total_order,
            );
        }
        $header = array(
            'date_from' => $d,
            'date_to' => $d2,
            'date_now'      => $dateNow,
            'time_now'      => $timeNow,
            'data' => $data
        );
        return $header;
    }

    // ==========================================================================
    // public function sourceOrderCount()
    // {
    //     // return TbTranHead::selectRaw('order_by, COUNT(order_by) as total_order')
    //     //     ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
    //     //     ->whereBetween('tb_tran_head.date_app', [$date, $date2])
    //     //     ->where([
    //     //         ['tran_stat', 'On-Process']
    //     //     ])
    //     //     ->groupByRaw('order_by')
    //     //     ->paginate(50);
            
    //     $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
    //     $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

    //     $test =  TbTranHead::selectRaw('tb_tran_head.account_code, store_name, address3')
    //         ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
    //         ->whereBetween('tb_tran_head.date_req', [$date, $date2])
    //         ->where([
    //             ['tran_stat', 'On-Process']
    //         ])->groupByRaw('tb_tran_head.account_code, store_name, address3')->get();
    //     // dd($test);
        
    //         foreach($test as $test2){
    //             // dd($test2);
            
    //             $b = $test2->map(function ($c) use($date, $date2){
    //             $source = ['Salesman', 'Customer'];
               
    //                 foreach($source as $sc){
    //                     // dd($c->account_code);
    //                     // dump($sc);
    //                     // $xname = array_values($sc)[0];
    //                     // dump($xname);
                        
    //                      $x = TbTranHead::
    //                          whereBetween('date_req', [$date, $date2])
    //                         ->where([
    //                         ['account_code', $c->account_code],
    //                         ['order_by', $sc],
    //                         ['tran_stat', 'On-Process']
    //                         ])->get();
                        
                        
    //                     // dump($x);
    //                     return $c;
    //                 }
    //             // $x = TbTranHead::selectRaw('order_by, COUNT(order_by) as total_order, SUM(tot_amt) AS tot_del_amt')
    //             //     ->whereBetween('tb_tran_head.date_app', [$date, $date2])
    //             //     ->where([
    //             //         ['account_code', $c->account_code],
    //             //         ['order_by', 'Salesman'],
    //             //         ['tran_stat', 'On-Process']
    //             //         ])->groupByRaw('order_by')->get();
                
    //             // dump($x->get());
               
    //             // return $x;
    //             });
    //         }
    //         dd($test);
        
    //     return $test;
    // }

    // public function printsourceOrderCount()
    // {
    //     $date = Carbon::parse(base64_decode(request()->date))->startOfDay()->toDateTimeString();
    //     $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

    //     $data = $this->dataForsourceOrderCount($date, $date2);

    //     set_time_limit(0);

    //     $pdf = PDF::loadView('reports.source_order_count', compact('data'));
    //     return $pdf->setPaper('a4', 'landscape')->download('Source Order Count ' . $date . '-' . $date2 . '.pdf');
    // }

    // public function dataForsourceOrderCount($date, $date2)
    // {
    //     $dateNow = Carbon::now()->toFormattedDateString();
    //     $timeNow = Carbon::now()->format('h:i:s A');
    //     $d = Carbon::parse(base64_decode(request()->date))->toFormattedDateString();
    //     $d2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toFormattedDateString();

    //     $query = TbTranHead::selectRaw('order_by, COUNT(order_by) as total_order')
    //         ->join('customer_master_files', 'customer_master_files.account_code', 'tb_tran_head.account_code')
    //         ->whereBetween('tb_tran_head.date_app', [$date, $date2])
    //         ->where([
    //             ['tran_stat', 'On-Process']
    //         ])
    //         ->groupByRaw('order_by')
    //         ->get();

    //     // dd($query);
    //     $data = [];
    //     foreach ($query as $row) {
    //         $data[] = array(
    //             'order_by'      => $row->order_by,
    //             'total_order'     => $row->total_order,
    //         );
    //     }
    //     $header = array(
    //         'date_from' => $d,
    //         'date_to' => $d2,
    //         'date_now'      => $dateNow,
    //         'time_now'      => $timeNow,
    //         'data' => $data
    //     );
    //     return $header;
    // }
    // ==========================================================================
    
    // ============================== 2022-03-10 ================================================
    public function sourceOrderCount() {
        $dateFrom = request()->dateFrom;
        $dateTo = request()->dateTo;
        $storeName = request()->storeName;
        $data = $this->dataForsourceOrderCount($dateFrom, $dateTo, $storeName);
        return response()->json($data);
    }
    
    public function printsourceOrderCount() {
        $dateFrom = request()->dateFrom;
        $dateTo = request()->dateTo;
        $storeName = request()->storeName;
        $data = $this->dataForsourceOrderCount($dateFrom, $dateTo, $storeName);

        $dateFrom = substr($dateFrom,0,10);
        $dateTo = substr($dateTo,0,10);
        $pdf = PDF::loadView('reports.orders_summary', 
            ['data' => $data['data'], 'dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
        return $pdf->download("Customer Orders Summary_$dateFrom to $dateTo.pdf");
    }

    public function dataForsourceOrderCount($dateFrom, $dateTo, $storeName) {
        set_time_limit(0);

        if($dateFrom == null || $dateTo == null) die('Please specify both date "from" and "to"');

        $res = DB::table('tb_tran_head')
            ->select('account_code','store_name')
            // ->whereBetween('date_req', [$dateFrom, $dateTo])
            ->where('store_name','like', '%'. $storeName. '%')
            ->whereDate('date_req','>=', $dateFrom)
            ->whereDate('date_req','<=', $dateTo)
            ->orderBy('store_name')
            ->distinct()
            ->get();
            // ->paginate(10);

        $salesman_order_count_total = 0;
        $salesman_amount_total = 0;
        $customer_order_count_total = 0;
        $customer_amount_total = 0;
        $backend_order_count_total = 0;
        $backend_amount_total = 0;

        $res->map(
            function($row) 
            use (&$salesman_order_count_total, &$salesman_amount_total, 
                &$customer_order_count_total, &$customer_amount_total,
                &$backend_order_count_total, &$backend_amount_total,
                &$dateFrom, &$dateTo) 
        {
            $row->salesman_order_count = 
                DB::table('tb_tran_head')
                    ->where('account_code',$row->account_code)
                    ->where('order_by','Salesman')
                    ->whereDate('date_req','>=', $dateFrom)
                    ->whereDate('date_req','<=', $dateTo)
                    ->count('order_by');
            $salesman_order_count_total += $row->salesman_order_count;

            $row->salesman_amount = 
                DB::table('tb_tran_head')
                ->where('account_code',$row->account_code)
                ->where('order_by','Salesman')
                ->whereDate('date_req','>=', $dateFrom)
                ->whereDate('date_req','<=', $dateTo)
                ->sum('tot_amt');
            $salesman_amount_total += $row->salesman_amount;

            $row->customer_order_count = 
                DB::table('tb_tran_head')
                    ->where('account_code',$row->account_code)
                    ->where('order_by','Customer')
                    ->whereDate('date_req','>=', $dateFrom)
                    ->whereDate('date_req','<=', $dateTo)
                    ->count('order_by');
            $customer_order_count_total += $row->customer_order_count;

            $row->customer_amount = 
                DB::table('tb_tran_head')
                ->where('account_code',$row->account_code)
                ->where('order_by','Customer')
                ->whereDate('date_req','>=', $dateFrom)
                ->whereDate('date_req','<=', $dateTo)
                ->sum('tot_amt');
            $customer_amount_total += $row->customer_amount;

            $row->backend_order_count = 
                DB::table('tb_tran_head')
                    ->where('account_code',$row->account_code)
                    ->where('order_by','Backend')
                    ->whereDate('date_req','>=', $dateFrom)
                    ->whereDate('date_req','<=', $dateTo)
                    ->count('order_by');
            $backend_order_count_total += $row->backend_order_count;

            $row->backend_amount = 
                DB::table('tb_tran_head')
                ->where('account_code',$row->account_code)
                ->where('order_by','Backend')
                ->whereDate('date_req','>=', $dateFrom)
                ->whereDate('date_req','<=', $dateTo)
                ->sum('tot_amt');
            $backend_amount_total += $row->backend_amount;
        });
        $data['data'] = $res;
        $data['salesman_order_count_total'] = $salesman_order_count_total;
        $data['salesman_amount_total'] = $salesman_amount_total;
        $data['customer_order_count_total'] = $customer_order_count_total;
        $data['customer_amount_total'] = $customer_amount_total;
        $data['backend_order_count_total'] = $backend_order_count_total;
        $data['backend_amount_total'] = $backend_amount_total;
        return $data;
    }
    // ============================== /2022-03-10 ================================================
}
