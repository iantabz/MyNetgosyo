<?php

namespace App\Http\Controllers;

use App\TbTranHead;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getTransaction()
    {

        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
        $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();

        $transaction = DB::table('tb_tran_head')
            ->whereDate('date_req', '>=', $dateFrom)
            ->whereDate('date_req', '<=', $dateTo)
            ->paginate(10);

        dd($transaction);

        return response()->json($transaction);
    }

    public function getTransaction1()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where('tran_stat', 'Pending')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->whereDate('date_req', '>=', $dateFrom->toDateString())
                ->whereDate('date_req', '<=', $dateTo->toDateString())
                ->where('tran_stat', 'Pending')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return response()->json($transaction);
    }

    public function getTransaction2()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));

        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            $transaction = TbTranHead::with('active_chat')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name', 'customer_master_files.cus_mobile_number', 'salesman_lists.mobile AS sm_mobile')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
                ->where('tran_stat', 'On-Process')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $transaction = TbTranHead::with('active_chat')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name', 'customer_master_files.cus_mobile_number', 'salesman_lists.mobile AS sm_mobile')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
                ->whereDate('date_req', '>=', $dateFrom->toDateString())
                ->whereDate('date_req', '<=', $dateTo->toDateString())
                ->where('tran_stat', 'On-Process')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return response()->json($transaction);
    }

    public function getTransaction3()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where('tran_stat', 'Approved')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->whereDate('date_req', '>=', $dateFrom->toDateString())
                ->whereDate('date_req', '<=', $dateTo->toDateString())
                ->where('tran_stat', 'Approved')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return response()->json($transaction);
    }

    public function getTransaction4()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where('tran_stat', 'Delivered')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->whereDate('date_req', '>=', $dateFrom->toDateString())
                ->whereDate('date_req', '<=', $dateTo->toDateString())
                ->where('tran_stat', 'Delivered')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return response()->json($transaction);
    }

    public function getTransaction5()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where('tran_stat', 'Returned')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->whereDate('date_req', '>=', $dateFrom->toDateString())
                ->whereDate('date_req', '<=', $dateTo->toDateString())
                ->where('tran_stat', 'Returned')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return response()->json($transaction);
    }
    public function getTransaction6()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where('tran_stat', 'Cancelled')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $transaction = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->whereDate('date_req', '>=', $dateFrom->toDateString())
                ->whereDate('date_req', '<=', $dateTo->toDateString())
                ->where('tran_stat', 'Cancelled')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return response()->json($transaction);
    }

    public function getOrderDetails()
    {
        $tran_no = request()->id;

        // $res = DB::table('tb_tran_line')->where('tran_no', '=', $tran_no)->orderBy('doc_no', 'DESC')->get();
        $res = DB::table('tb_tran_line')
            ->leftJoin('tb_tran_head',
                'tb_tran_head.tran_no',
                'tb_tran_line.tran_no'
            )
            ->select('tb_tran_line.*', 'tb_tran_head.tran_stat', 'tb_tran_head.order_by')
            ->where('tb_tran_line.tran_no', '=', $tran_no)
            ->orderBy('doc_no', 'DESC')->get();

        return response()->json($res);
    }

    public function getTeleOrderDetails()
    {
        $tran_no = request()->id;

        $res = DB::table('tb_tran_head')
            ->join('tb_tran_line', 'tb_tran_line.tran_no', '=', 'tb_tran_head.tran_no')
            ->where('tb_tran_head.tran_no', '=', $tran_no)
            ->orderBy('tb_tran_line.doc_no', 'DESC')->get();

        return response()->json($res);
    }

    public function getOrder1()
    {
        $doc_no = request()->id;

        $res = DB::table('tb_tran_line')
            ->join(
                'tb_tran_head',
                'tb_tran_line.tran_no',
                'tb_tran_head.tran_no',
            )
            ->select(
                'tb_tran_line.*',
                'tb_tran_head.order_by',
                'tb_tran_head.tran_stat'
            )
            ->where('tb_tran_line.doc_no', '=', $doc_no)
            ->get();

        return response()->json($res);
    }

    public function getOrder()
    {
        $tran_no = request()->tran_no;

        $res = DB::table('tb_tran_line')->where('tran_no', '=', $tran_no)->paginate(10);

        return response()->json($res);
    }

    public function searchOrder()
    {
        $search = request()->name;

        $searchO = DB::table('tb_tran_line')->where('item_desc', 'LIKE', "%$search%")->paginate(10);

        return response()->json($searchO);
    }

    // kaloy 2021-09-23 (mod)
    // for Ongoing Transaction
    // ongoing_transaction
    public function searchTransaction()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;

        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            if ($dateActive === 'false') {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])

                    // kaloy 2021-09-23 ==============================================
                    ->where(function($query){
                        $dateToday = date('Y-m-d', strtotime('today'));
                        $cutOffTime = DB::table('order_cut_off_time')
                            ->select('cut_off_time')
                            ->where('status', 1)
                            ->first();
                        $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                        ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                        ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                        ->orWhere('order_by','Backend');
                    })
                    
                    // kaloy 2022-03-09
                    ->orderBy('tb_tran_head.date_req', 'DESC')
                    ->paginate(10);
            } else {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                    
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())

                    // kaloy 2021-09-23 ==============================================
                    ->where(function($query){
                        $dateToday = date('Y-m-d', strtotime('today'));
                        $cutOffTime = DB::table('order_cut_off_time')
                            ->select('cut_off_time')
                            ->where('status', 1)
                            ->first();
                        $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                        ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                        ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                        ->orWhere('order_by','Backend');
                    })

                    ->orderBy('tb_tran_head.date_req', 'DESC')
                    ->paginate(10);
            }
        } else {
            $searchT = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where(function ($query) {
                    $search = request()->name;
                    $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                })
                ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())

                // kaloy 2021-09-23 ==============================================
                ->where(function($query){
                    $dateToday = date('Y-m-d', strtotime('today'));
                    $cutOffTime = DB::table('order_cut_off_time')
                        ->select('cut_off_time')
                        ->where('status', 1)
                        ->first();
                    $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                    ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                    ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                    ->orWhere('order_by','Backend');
                })

                ->orderBy('tb_tran_head.date_req', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }
        
        // kaloy 2022-24-01
        $searchT->each(function ($item, $key) {
            $tran_no = $item->tran_no;
            $item->lineTotal = DB::table('tb_tran_line')
                ->where('tran_no', $tran_no)
                ->sum('tot_amt');
        });

        return response()->json($searchT);
    }

        // for Ongoing Transaction - OLD
        // public function searchTransaction()
        // {
        //     $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        //     $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        //     $dateActive = request()->dateActive;
    
            
            
        //     if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
        //         if ($dateActive === 'false') {
        //             $searchT = DB::table('tb_tran_head')
        //                 ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
        //                 ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
        //                 ->where(function ($query) {
        //                     $search = request()->name;
        //                     $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
        //                 })
        //                 ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
        //                 ->where(function($query){
        //                     $dateToday = date('Y-m-d', strtotime('today'));
        //                     $cutOffTime = DB::table('order_cut_off_time')
        //                         ->select('cut_off_time')
        //                         ->where('status', 1)
        //                         ->first();
        //                     $query->whereRaw("DATE(date_req) <> DATE('$dateToday')")
        //                         ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
        //                         ->orWhere('order_by','Backend');
        //                 })
        //                 ->orderBy('tb_tran_head.id', 'DESC')
        //                 ->paginate(10);
        //         } else {
        //             $searchT = DB::table('tb_tran_head')
        //                 ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
        //                 ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
        //                 ->where(function ($query) {
        //                     $search = request()->name;
        //                     $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
        //                 })
        //                 ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
        //                 ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
        //                 ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
        //                 ->orderBy('tb_tran_head.id', 'DESC')
        //                 ->paginate(10);
        //         }
        //     } else {
        //         $searchT = DB::table('tb_tran_head')
        //             ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
        //             ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
        //             ->where(function ($query) {
        //                 $search = request()->name;
        //                 $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
        //             })
        //             ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
        //             ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
        //             ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
        //             ->orderBy('tb_tran_head.id', 'DESC')
        //             ->paginate(10);
    
        //         // $getTotal = $this->getTotalAmount();
        //     }
    
        //     return response()->json($searchT);
        // }

    public function searchTransaction4()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;

        $searchT = null;

        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            if ($dateActive === 'false') {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            } else {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            }
        } else {
            $searchT = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where(function ($query) {
                    $search = request()->name;
                    $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                })
                ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->orderBy('tb_tran_head.id', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }
        return response()->json($searchT);
    }

    
    // Returned
    public function searchTransaction5()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;


        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            if ($dateActive === 'false') {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            } else {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            }
        } else {
            $searchT = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where(function ($query) {
                    $search = request()->name;
                    $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                })
                ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->orderBy('tb_tran_head.id', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }

        return response()->json($searchT);
    }

    public function searchTransaction6()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;


        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            if ($dateActive === 'false') {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            } else {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            }
        } else {
            $searchT = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where(function ($query) {
                    $search = request()->name;
                    $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                })
                ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->orderBy('tb_tran_head.id', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }

        return response()->json($searchT);
    }

    // kaloy 09-22-21
    // advanced_order
    public function searchTransaction7()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;

        // kaloy 09-22-21
        $dateToday = date('Y-m-d', strtotime('today'));
        $cutOffTime = DB::table('order_cut_off_time')
            ->select('cut_off_time')
            ->where('status', 1)
            ->first();

        $searchT = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
            ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
            ->where(function ($query) {
                $search = request()->name;
                $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
            });

        if (($dateFrom->isToday() === true && $dateTo->isToday() === true && $dateActive !== 'false') || !($dateFrom->isToday() === true && $dateTo->isToday() === true))
        {
            $searchT = $searchT->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->whereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString());
        }

        $searchT = $searchT->whereIn('tb_tran_head.tran_stat', ['Pending'])
        ->where('order_by','<>','Backend')
        ->whereRaw("DATE(date_req) = DATE('$dateToday')")
        ->whereRaw("TIME(date_req) > TIME('$cutOffTime->cut_off_time')")
        ->orderBy('tb_tran_head.id', 'DESC')
        ->paginate(10);

        return response()->json($searchT);
    }

    // =============

        // advanced_order_old
        // public function searchTransaction7()
        // {
        //     $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        //     $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        //     $dateActive = request()->dateActive;
    
        //     // kaloy 09-22-21
        //     $dateToday = date('Y-m-d', strtotime('today'));
        //     $cutOffTime = DB::table('order_cut_off_time')
        //         ->select('cut_off_time')
        //         ->where('status', 1)
        //         ->first();
        //     // query builder instance variable
        //     $searchT = null;
    
    
        //     if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
        //         if ($dateActive === 'false') {
        //             $searchT = DB::table('tb_tran_head')
        //                 ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
        //                 ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
        //                 ->where(function ($query) {
        //                     $search = request()->name;
        //                     $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
        //                 })
        //                 ->whereIn('tb_tran_head.tran_stat', ['Pending'])
        //                 // kaloy 09-22-21
        //                 ->where('order_by','<>','Backend')
        //                 ->whereRaw("DATE(date_req) = DATE('$dateToday')")
        //                 ->whereRaw("TIME(date_req) > TIME('$cutOffTime->cut_off_time')")
        //                 // /kaloy 09-22-21
        //                 ->orderBy('tb_tran_head.id', 'DESC')
        //                 ->paginate(10);
        //         } else {
        //             $searchT = DB::table('tb_tran_head')
        //                 ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
        //                 ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
        //                 ->where(function ($query) {
        //                     $search = request()->name;
        //                     $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
        //                         ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
        //                 })
        //                 ->whereIn('tb_tran_head.tran_stat', ['Pending'])
        //                 ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
        //                 ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
        //                 // kaloy 09-22-21
        //                 ->where('order_by','<>','Backend')
        //                 ->whereRaw("DATE(date_req) = DATE('$dateToday')")
        //                 ->whereRaw("TIME(date_req) > TIME('$cutOffTime->cut_off_time')")
        //                 // /kaloy 09-22-21
        //                 ->orderBy('tb_tran_head.id', 'DESC')
        //                 ->paginate(10);
        //         }
        //     } else {
        //         $searchT = DB::table('tb_tran_head')
        //             ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
        //             ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
        //             ->where(function ($query) {
        //                 $search = request()->name;
        //                 $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
        //                     ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
        //             })
        //             ->whereIn('tb_tran_head.tran_stat', ['Pending'])
        //             ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
        //             ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
        //             // kaloy 09-22-21
        //             ->where('order_by','<>','Backend')
        //             ->whereRaw("DATE(date_req) = DATE('$dateToday')")
        //             ->whereRaw("TIME(date_req) > TIME('$cutOffTime->cut_off_time')")
        //             // /kaloy 09-22-21
        //             ->orderBy('tb_tran_head.id', 'DESC')
        //             ->paginate(10);
    
        //         // $getTotal = $this->getTotalAmount();
        //     }
    
        //     return response()->json($searchT);
        // }

    private $totalAmt = 0;
    private $totalAmtDel = 0;
    private $totalAmtRet = 0;
    private $totalAmtCanc = 0;
    private $totalAmtAdv = 0;
    private $totalAmtAll = 0;
    private $totalAmtSubmitted = 0;
    private $totalAmtOnProcess = 0;
    private $totalAmtApproved = 0;
    private $totalAmtDelivered = 0;
    private $totalAmtReturned = 0;
    private $totalAmtCancelled = 0;

    //TODO: getTotalAmount
    // ongoing_trans total_amount
    public function getTotalAmount()
    {
        $totalAmountApproved = 0.00;
        $totalAmountOngoing = 0.00;

        // dd(request()->all());
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));

        $dateActive = request()->dateActive;

        if (request()->name != 'null') {
            if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {

                if ($dateActive === 'false') {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                        // kaloy 2022-04-08 ==============================================
                        ->where(function($query){
                            $dateToday = date('Y-m-d', strtotime('today'));
                            $cutOffTime = DB::table('order_cut_off_time')
                                ->select('cut_off_time')
                                ->where('status', 1)
                                ->first();
                            $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                            ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                            ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                            ->orWhere('order_by','Backend');
                        })

                        ->get();

                    foreach ($calc as $row) {
                        //TODO: Calculate base on tot_amt only (1)
                        // if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                        //     $this->totalAmt += $row->tot_amt;
                        // }
                        // if ($row->tran_stat === 'Approved') {
                        //     $this->totalAmt += $row->tot_del_amt;
                        // }
                        
                        // kaloy 2022-04-11
                        if ($row->tran_stat == 'Pending' 
                            || $row->tran_stat == 'On-Process' 
                            || $row->tran_stat == 'Approved') {
                            $totalAmountOngoing += $row->tot_amt;
                        }
                        if ($row->tran_stat == 'Approved') {
                            $totalAmountApproved += $row->tot_del_amt;
                        }
                    }
                } else {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                        ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                        ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                        // kaloy 2022-04-08 ==============================================
                        ->where(function($query){
                            $dateToday = date('Y-m-d', strtotime('today'));
                            $cutOffTime = DB::table('order_cut_off_time')
                                ->select('cut_off_time')
                                ->where('status', 1)
                                ->first();
                            $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                            ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                            ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                            ->orWhere('order_by','Backend');
                        })

                        ->get();

                    foreach ($calc as $row) {
                        //TODO: Calculate base on tot_amt only (2)
                        // if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                        //     $this->totalAmt += $row->tot_amt;
                        // }
                        // if ($row->tran_stat === 'Approved') {
                        //     $this->totalAmt += $row->tot_del_amt;
                        // }
                        
                        // kaloy 2022-04-11
                        if ($row->tran_stat == 'Pending' 
                            || $row->tran_stat == 'On-Process' 
                            || $row->tran_stat == 'Approved') {
                            $totalAmountOngoing += $row->tot_amt;
                        }
                        if ($row->tran_stat == 'Approved') {
                            $totalAmountApproved += $row->tot_del_amt;
                        }
                    }
                }
            } else {
                $calc = DB::table('tb_tran_head')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    // kaloy 2022-04-08 ==============================================
                    ->where(function($query){
                        $dateToday = date('Y-m-d', strtotime('today'));
                        $cutOffTime = DB::table('order_cut_off_time')
                            ->select('cut_off_time')
                            ->where('status', 1)
                            ->first();
                        $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                        ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                        ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                        ->orWhere('order_by','Backend');
                    })

                    ->get();

                foreach ($calc as $row) {
                    //TODO: Calculate base on tot_amt only (3)
                    // if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                    //     $this->totalAmt += $row->tot_amt;
                    // }
                    // if ($row->tran_stat === 'Approved') {
                    //     $this->totalAmt += $row->tot_del_amt;
                    // }
                    
                    // kaloy 2022-04-11
                    if ($row->tran_stat == 'Pending' 
                        || $row->tran_stat == 'On-Process' 
                        || $row->tran_stat == 'Approved') {
                        $totalAmountOngoing += $row->tot_amt;
                    }
                    if ($row->tran_stat == 'Approved') {
                        $totalAmountApproved += $row->tot_del_amt;
                    }
                }
            }
        } else {
            $calc = DB::table('tb_tran_head')
                ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                // kaloy 2022-04-08 ==============================================
                ->where(function($query){
                    $dateToday = date('Y-m-d', strtotime('today'));
                    $cutOffTime = DB::table('order_cut_off_time')
                        ->select('cut_off_time')
                        ->where('status', 1)
                        ->first();
                    $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
                    ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
                    ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
                    ->orWhere('order_by','Backend');
                })

                ->get();

            foreach ($calc as $row) {
                //TODO: Calculate base on tot_amt only (4)
                // if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                //     $this->totalAmt += $row->tot_amt;
                // }
                // if ($row->tran_stat === 'Approved') {
                //     $this->totalAmt += $row->tot_del_amt;
                // }
                
                // kaloy 2022-04-11
                if ($row->tran_stat == 'Pending' 
                    || $row->tran_stat == 'On-Process' 
                    || $row->tran_stat == 'Approved') {
                    $totalAmountOngoing += $row->tot_amt;
                }
                if ($row->tran_stat == 'Approved') {
                    $totalAmountApproved += $row->tot_del_amt;
                }
            }
        }

        return response()->json([
            'total_amount_ongoing' => $totalAmountOngoing,
            'total_amount_approved' => $totalAmountApproved,
        ]);
    }

    public function getTotalAmountDel()
    {
        // dd(request()->all());
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));

        $dateActive = request()->dateActive;

        if (request()->name != 'null') {

            if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {

                if ($dateActive === 'false') {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                        ->get();

                    foreach ($calc as $row) {


                        $this->totalAmt += $row->tot_del_amt;
                    }
                } else {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                        ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                        ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                        ->get();

                    foreach ($calc as $row) {

                        $this->totalAmt += $row->tot_del_amt;
                    }
                }
            } else {

                $calc = DB::table('tb_tran_head')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->get();

                foreach ($calc as $row) {

                    $this->totalAmt += $row->tot_del_amt;
                }
            }
        } else {

            $calc = DB::table('tb_tran_head')
                ->whereIn('tb_tran_head.tran_stat', ['Delivered'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->get();

            foreach ($calc as $row) {

                $this->totalAmt += $row->tot_del_amt;
            }
        }

        return $this->totalAmt;
    }

    public function getTotalAmountRet()
    {
        // dd(request()->all());
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));

        $dateActive = request()->dateActive;

        if (request()->name != 'null') {

            if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {

                if ($dateActive === 'false') {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                        ->get();

                    foreach ($calc as $row) {


                        $this->totalAmt += $row->tot_del_amt;
                    }
                } else {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                        ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                        ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                        ->get();

                    foreach ($calc as $row) {

                        $this->totalAmt += $row->tot_del_amt;
                    }
                }
            } else {

                $calc = DB::table('tb_tran_head')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->get();

                foreach ($calc as $row) {

                    $this->totalAmt += $row->tot_del_amt;
                }
            }
        } else {

            $calc = DB::table('tb_tran_head')
                ->whereIn('tb_tran_head.tran_stat', ['Returned'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->get();

            foreach ($calc as $row) {

                $this->totalAmt += $row->tot_del_amt;
            }
        }

        return $this->totalAmt;
    }

    public function getTotalAmountCanc()
    {
        // dd(request()->all());
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));

        $dateActive = request()->dateActive;

        if (request()->name != 'null') {

            if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {

                if ($dateActive === 'false') {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                        ->get();

                    foreach ($calc as $row) {


                        $this->totalAmt += $row->tot_del_amt;
                    }
                } else {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                        ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                        ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                        ->get();

                    foreach ($calc as $row) {

                        $this->totalAmt += $row->tot_del_amt;
                    }
                }
            } else {

                $calc = DB::table('tb_tran_head')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->get();

                foreach ($calc as $row) {

                    $this->totalAmt += $row->tot_del_amt;
                }
            }
        } else {

            $calc = DB::table('tb_tran_head')
                ->whereIn('tb_tran_head.tran_stat', ['Cancelled'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->get();

            foreach ($calc as $row) {

                $this->totalAmt += $row->tot_del_amt;
            }
        }

        return $this->totalAmt;
    }

    public function getTotalAmountAdv()
    {
        // dd(request()->all());
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));

        $dateActive = request()->dateActive;

        if (request()->name != 'null') {

            if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {

                if ($dateActive === 'false') {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Pending'])
                        ->get();

                    foreach ($calc as $row) {


                        $this->totalAmt += $row->tot_del_amt;
                    }
                } else {
                    $calc = DB::table('tb_tran_head')
                        ->where(function ($query) {
                            $search = request()->name;
                            $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                                ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                        })
                        ->whereIn('tb_tran_head.tran_stat', ['Pending'])
                        ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                        ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                        ->get();

                    foreach ($calc as $row) {

                        $this->totalAmt += $row->tot_del_amt;
                    }
                }
            } else {

                $calc = DB::table('tb_tran_head')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['Pending'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->get();

                foreach ($calc as $row) {

                    $this->totalAmt += $row->tot_del_amt;
                }
            }
        } else {

            $calc = DB::table('tb_tran_head')
                ->whereIn('tb_tran_head.tran_stat', ['Pending'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->get();

            foreach ($calc as $row) {

                $this->totalAmt += $row->tot_del_amt;
            }
        }

        return $this->totalAmt;
    }

    //TODO: getTotalAmountAll
    public function getTotalAmountAll()
    {
        // kaloy 2022-04-11
        $totalAmountAllOngoing = 0.00;
        $totalAmountAllApproved = 0.00;

        $calc = DB::table('tb_tran_head')
        // kaloy 2022-04-11
        ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
        ->where(function($query){
            $dateToday = date('Y-m-d', strtotime('today'));
            $cutOffTime = DB::table('order_cut_off_time')
                ->select('cut_off_time')
                ->where('status', 1)
                ->first();
            $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
            ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
            ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
            ->orWhere('order_by','Backend');
        })
        ->get();

        // kaloy 2022-04-11
        // foreach ($calc as $row) {
        //     if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
        //         $this->totalAmtAll += $row->tot_amt;
        //     }
        //     if ($row->tran_stat === 'Approved' || $row->tran_stat === 'Delivered' || $row->tran_stat === 'Returned') {
        //         $this->totalAmtAll += $row->tot_del_amt;
        //     }
        // }
        foreach ($calc as $row) {
            // kaloy 2022-04-11
            if ($row->tran_stat == 'Pending' 
                || $row->tran_stat == 'On-Process' 
                || $row->tran_stat == 'Approved') {
                $totalAmountAllOngoing += $row->tot_amt;
            }
            if ($row->tran_stat == 'Approved') {
                $totalAmountAllApproved += $row->tot_del_amt;
            }
        }

        // return $this->totalAmtAll;
        return response()->json([
            'total_amount_all_ongoing' => $totalAmountAllOngoing,
            'total_amount_all_approved' => $totalAmountAllApproved,
        ]);
    }

    public function getTotalAmountSubmitted()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'Pending')->get();
        foreach ($calc as $row) {

            $this->totalAmtSubmitted += $row->tot_amt;
        }

        return $this->totalAmtSubmitted;
    }

    public function getTotalAmountOnProcess()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'On-Process')->get();
        foreach ($calc as $row) {

            $this->totalAmtOnProcess += $row->tot_amt;
        }

        return $this->totalAmtOnProcess;
    }

    public function getTotalAmountApproved()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'Approved')->get();
        foreach ($calc as $row) {

            $this->totalAmtApproved += $row->tot_del_amt;
        }

        return $this->totalAmtApproved;
    }

    public function getTotalAmountDelivered()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'Delivered')->get();
        foreach ($calc as $row) {

            $this->totalAmtDelivered += $row->tot_del_amt;
        }

        return $this->totalAmtDelivered;
    }

    public function getTotalAmountReturned()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'Returned')->get();
        foreach ($calc as $row) {

            $this->totalAmtReturned += $row->tot_del_amt;
        }

        return $this->totalAmtReturned;
    }

    public function getTotalAmountCancelled()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'Cancelled')->get();
        foreach ($calc as $row) {

            $this->totalAmtCancelled += $row->tot_amt;
        }

        return $this->totalAmtCancelled;
    }

    // kaloy 2021-09-28
    public function getTotalAmountAdvanced()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;

        // kaloy 09-22-21
        $dateToday = date('Y-m-d', strtotime('today'));
        $cutOffTime = DB::table('order_cut_off_time')
            ->select('cut_off_time')
            ->where('status', 1)
            ->first();
            
        $searchT = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
            ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
            ->where(function ($query) {
                // $search = '';
                if (request()->name != 'null') {
                    $search = request()->name;
                    $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                    ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                }
            });

        if (($dateFrom->isToday() === true && $dateTo->isToday() === true && $dateActive !== 'false') || !($dateFrom->isToday() === true && $dateTo->isToday() === true))
        {
            $searchT = $searchT->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->whereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString());
        }

        $searchT = $searchT->whereIn('tb_tran_head.tran_stat', ['Pending'])
        ->where('order_by','<>','Backend')
        ->whereRaw("DATE(date_req) = DATE('$dateToday')")
        ->whereRaw("TIME(date_req) > TIME('$cutOffTime->cut_off_time')")
        // ->orderBy('tb_tran_head.id', 'DESC')
        ->get('tot_amt');
        
        // total amount
        $totalAmount = 0;

        foreach ($searchT as $row) {
            $totalAmount += $row->tot_amt;
        }

        return $totalAmount;
    } // /getTotalAmountAdvanced()

    // public function getTotalAmountAdvanced_old_2021-09-28()
    // {
    //     $calc = DB::table('tb_tran_head')->where('tran_stat', 'Pending')->get();
    //     foreach ($calc as $row) {

    //         $this->totalAmtCancelled += $row->tot_amt;
    //     }

    //     return $this->totalAmtCancelled;
    // }

    public function searchTransaction2()
    {
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom));
        $dateTo = Carbon::parse(base64_decode(request()->dateTo));
        $dateActive = request()->dateActive;


        if ($dateFrom->isToday() === true && $dateTo->isToday() === true) {
            if ($dateActive === 'false') {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['On-Process'])
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            } else {
                $searchT = DB::table('tb_tran_head')
                    ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                    ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                    ->where(function ($query) {
                        $search = request()->name;
                        $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                            ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                    })
                    ->whereIn('tb_tran_head.tran_stat', ['On-Process'])
                    ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                    ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                    ->orderBy('tb_tran_head.id', 'DESC')
                    ->paginate(10);
            }
        } else {
            $searchT = DB::table('tb_tran_head')
                ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
                ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
                ->where(function ($query) {
                    $search = request()->name;
                    $query->where('tb_tran_head.store_name', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_no', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.order_by', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tot_amt', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.tran_stat', 'LIKE', "%$search%")
                        ->orWhere('tb_tran_head.p_meth', 'LIKE', "%$search%");
                })
                ->whereIn('tb_tran_head.tran_stat', ['On-Process'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->orderBy('tb_tran_head.id', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }

        return response()->json($searchT);
    }

    public function searchTransaction1()
    {
        // dd(1);
        $dateFrom = Carbon::parse(base64_decode(request()->dateFrom))->toDateString();
        $dateTo = Carbon::parse(base64_decode(request()->dateTo))->toDateString();
        // dd(compact('dateFrom', 'dateTo'));
        // return ItemHistoryLog::where('product_name', 'LIKE', "%$search%")->paginate(10);
        // return ItemHistoryLog::where('product_name', 'LIKE', "%$search%")->paginate(10);
        $search = request()->name;
        $searchT = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'salesman_lists.first_name', 'salesman_lists.last_name')
            ->join('salesman_lists', 'tb_tran_head.sm_code', '=', 'salesman_lists.user_code')
            // ->where(function ($query) {
            //     $search = request()->name;
            //     $query->where('store_name', 'LIKE', "%$search%")
            //         ->orWhere('tran_no', 'LIKE', "%$search%")
            //         ->orWhere('order_by', 'LIKE', "%$search%")
            //         ->orWhere('tot_amt', 'LIKE', "%$search%")
            //         ->orWhere('tran_stat', 'LIKE', "%$search%")
            //         ->orWhere('p_meth', 'LIKE', "%$search%");
            // })
            ->where('store_name', 'LIKE', "%$search%")
            // ->orWhere('tran_no', 'LIKE', "%$search%")
            // ->orWhere('order_by', 'LIKE', "%$search%")
            // ->orWhere('tot_amt', 'LIKE', "%$search%")
            // ->orWhere('tran_stat', 'LIKE', "%$search%")
            // ->orWhere('p_meth', 'LIKE', "%$search%")
            ->whereDate('date_req', '>=', $dateFrom)
            ->whereDate('date_req', '<=', $dateTo)
            ->where('tran_stat', 'Pending')
            ->paginate(10);

        return response()->json($searchT);
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    
    
    // kaloy 2021-10-05
    /**
     * Returns count of ongoing transactions(PENDING, ON-PROCESS, APPROVED)
     *
     * @param  Boolean  $pendingOnly
     * @return Integer $count
     */
    public function getOngoingTransactionsCount($pendingOnly = true)
    {
        $res = DB::table('tb_tran_head');

        if($pendingOnly) {
            $res->where('tran_stat','Pending');
        } else {
            $res->where(function($query){
                $query->where('tran_stat','Pending')
                    ->orWhere('tran_stat','Approved')
                    ->orWhere('tran_stat','On-Process');
            });
        }

        $res->where(function($query){
            $dateToday = date('Y-m-d', strtotime('today'));
            $cutOffTime = DB::table('order_cut_off_time')
                ->select('cut_off_time')
                ->where('status', 1)
                ->first();
            $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
            ->whereRaw("TIME(date_req) < TIME('$cutOffTime->cut_off_time')")
            ->orWhereRaw("DATE(date_req) < DATE('$dateToday')")
            ->orWhere('order_by','Backend');
        });

        return response($res->count());
    }

    /**
     * Returns count of advanced orders
     *
     * @param null
     * @return Integer $count
     */
    public function advancedOrdersCount()
    {
        $res = DB::table('tb_tran_head')
        ->where('tran_stat','Pending')
        ->where(function($query){
            $dateToday = date('Y-m-d', strtotime('today'));
            $cutOffTime = DB::table('order_cut_off_time')
                ->select('cut_off_time')
                ->where('status', 1)
                ->first();
            $query->whereRaw("DATE(date_req) = DATE('$dateToday')")
            ->whereRaw("TIME(date_req) >= TIME('$cutOffTime->cut_off_time')")
            ->whereRaw("DATE(date_req) = DATE('$dateToday')")
            ->where('order_by','<>','Backend');
        });

        return response($res->count());
    }

    /**
     * Quantity adjustment for backend-transactions
     */
    public function qtyAdjustment(Request $request){
        try {
            DB::beginTransaction();
            if($request->mankey == '123') {
                DB::table('tb_tran_line')->where('tran_no', $request->tran_no)
                ->where('itm_code', $request->item_code)
                ->where('uom', $request->uom)
                ->update([
                    'req_qty' => $request->new_qty,
                    'tot_amt' => $request->new_qty * $request->amount
                ])
                ;

                $itm_count = DB::table('tb_tran_line')->where('tran_no', $request->tran_no)
                    ->where('itm_code', $request->item_code)
                    ->where('uom', $request->uom)
                    ->sum('req_qty');
                $tot_amt = DB::table('tb_tran_line')->where('tran_no', $request->tran_no)
                    ->where('itm_code', $request->item_code)
                    ->where('uom', $request->uom)
                    ->sum('tot_amt');
                DB::table('tb_tran_head')->where('tran_no', $request->tran_no)
                    ->update([
                        'itm_count'=>$itm_count,
                        'tot_amt'=>$tot_amt,
                    ]);
                DB::table('sales_export_files')->where('sef_no', $request->tran_no)->delete();

                DB::commit();
                $res['success'] = true;
                $res['message'] = 'Success';
            } else {
                $res['success'] = false;
                $res['message'] = 'Incorrect manager\'s key!';
            }
            return response()->json($res);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            $res['success'] = false;
            $res['message'] = $th->getMessage();
            return response()->json($res, 500);
        }
        
    }

    // TODO: Test UTILS
    /**
     * Revert transaction status into pending
     * kaloy 2021-11-10
     */
    public function revertTransaction(Request $request)
    {
        $transaction_number = $request->transaction_number;

        if($transaction_number !== null || $transaction_number !== '') {
            // kaloy 2022-04-08
            // delete consolidation entry if the transaction is reverted
            $res_consolidated_transactions = DB::table('consolidated_transactions')
                ->where('reference_no', $transaction_number)
                ->delete();
                
            $res_tb_tran_head = DB::table('tb_tran_head')
                ->where('tran_no', $transaction_number)
                ->update([
                    'date_app' => NULL,
                    'export_date' => NULL,
                    'tran_stat' => 'Pending',
                    'isExported' => 0,
                    'tot_del_amt' => 0
                ]);

            $res_tb_tran_line = DB::table('tb_tran_line')
                ->where('tran_no', $transaction_number)
                ->update([
                    'del_qty' => 0,
                    'itm_stat' => '',
                    'nav_invoice_no' => '',
                ]);
            
            $res_sales_export_files = DB::table('sales_export_files')
                ->where('sef_no', $transaction_number)
                ->delete();
            
            $res_consolidated_transactions = DB::table('consolidated_transactions')
                ->where('reference_no', $transaction_number)
                ->delete();

            $res_tb_unserved_items = DB::table('tb_unserved_items')
                ->where('tran_no', $transaction_number)
                ->delete();
        }
    }
    
    /**
     * Delete transaction permanently
     * kaloy 2021-11-11
     */
    public function deleteTransaction(Request $request)
    {
        $transaction_number = $request->transaction_number;

        if($transaction_number !== null || $transaction_number !== '') {
            
            $res_consolidated_transactions = DB::table('consolidated_transactions')
                ->where('reference_no', $transaction_number)
                ->delete();

            $res_sales_export_files = DB::table('sales_export_files')
                ->where('sef_no', $transaction_number)
                ->delete();

            $res_tb_tran_head = DB::table('tb_tran_head')
                ->where('tran_no', $transaction_number)
                ->delete();

            $res_tb_tran_line = DB::table('tb_tran_line')
                ->where('tran_no', $transaction_number)
                ->delete();

            $res_tb_unserved_items = DB::table('tb_unserved_items')
                ->where('tran_no', $transaction_number)
                ->delete();

            $res_tb_returned_tran = DB::table('tb_returned_tran')
                ->where('tran_no', $transaction_number)
                ->delete();
        }
    }

}
