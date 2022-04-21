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

        $res = DB::table('tb_tran_line')->where('tran_no', '=', $tran_no)->orderBy('doc_no', 'DESC')->get();

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

        $res = DB::table('tb_tran_line')->where('doc_no', '=', $doc_no)->get();

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
                    ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
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
                ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->orderBy('tb_tran_head.id', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }

        return response()->json($searchT);
    }

    public function searchTransaction4()
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

    public function searchTransaction7()
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
                    ->whereIn('tb_tran_head.tran_stat', ['Pending'])
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
                    ->whereIn('tb_tran_head.tran_stat', ['Pending'])
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
                ->whereIn('tb_tran_head.tran_stat', ['Pending'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->orderBy('tb_tran_head.id', 'DESC')
                ->paginate(10);

            // $getTotal = $this->getTotalAmount();
        }

        return response()->json($searchT);
    }

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

    public function getTotalAmount()
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
                        ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                        ->get();

                    foreach ($calc as $row) {
                        if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                            $this->totalAmt += $row->tot_amt;
                        }
                        if ($row->tran_stat === 'Approved') {
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
                        ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                        ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                        ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                        ->get();

                    foreach ($calc as $row) {
                        if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                            $this->totalAmt += $row->tot_amt;
                        }
                        if ($row->tran_stat === 'Approved') {
                            $this->totalAmt += $row->tot_del_amt;
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
                    ->get();

                foreach ($calc as $row) {
                    if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                        $this->totalAmt += $row->tot_amt;
                    }
                    if ($row->tran_stat === 'Approved') {
                        $this->totalAmt += $row->tot_del_amt;
                    }
                }
            }
        } else {

            $calc = DB::table('tb_tran_head')
                ->whereIn('tb_tran_head.tran_stat', ['Pending', 'On-Process', 'Approved'])
                ->whereDate('tb_tran_head.date_req', '>=', $dateFrom->toDateString())
                ->WhereDate('tb_tran_head.date_req', '<=', $dateTo->toDateString())
                ->get();

            foreach ($calc as $row) {
                if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                    $this->totalAmt += $row->tot_amt;
                }
                if ($row->tran_stat === 'Approved') {
                    $this->totalAmt += $row->tot_del_amt;
                }
            }
        }

        return $this->totalAmt;
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

    public function getTotalAmountAll()
    {
        $calc = DB::table('tb_tran_head')->get();
        foreach ($calc as $row) {
            if ($row->tran_stat === 'Pending' || $row->tran_stat === 'On-Process') {
                $this->totalAmtAll += $row->tot_amt;
            }
            if ($row->tran_stat === 'Approved' || $row->tran_stat === 'Delivered' || $row->tran_stat === 'Returned') {
                $this->totalAmtAll += $row->tot_del_amt;
            }
        }

        return $this->totalAmtAll;
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

    public function getTotalAmountAdvanced()
    {
        $calc = DB::table('tb_tran_head')->where('tran_stat', 'Pending')->get();
        foreach ($calc as $row) {

            $this->totalAmtCancelled += $row->tot_amt;
        }

        return $this->totalAmtCancelled;
    }

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
}
