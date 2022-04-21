<?php

namespace App\Http\Controllers;


use App\Exports\ItemMasterfileExport;
use App\Imports\ItemMasterfileImport;
use App\Imports\ItemMasterfileImportDataUpload;
use App\ItemImagesPath;
use App\ItemMasterfile;
use \PDF;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\FuncCall;

// use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

class ItemMasterfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        ini_set('max_execution_time', 0);
    }

    public function index()
    {
        return ItemMasterfile::latest()->paginate(10);
    }

    public function item_masterfile_export()
    {
        return Excel::download(new ItemMasterfileExport, 'export_data.csv');
    }

    public function item_csv_masterfile_import(Request $request)
    {

        $request->validate([
            'import_file2' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);

        $path = $request->file('import_file2')->getRealPath();

        $path1 = $request->file('import_file2')->store('temp');

        $path = storage_path('app') . '/' . $path1;

        Excel::import(new ItemMasterfileImportDataUpload, $path);


        // return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function item_masterfile_import(Request $request)
    {
        set_time_limit(0);
        
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);


        $path = $request->file('import_file')->getRealPath();

        $path1 = $request->file('import_file')->store('temp');

        $path = storage_path('app') . '/' . $path1;
        Excel::import(new ItemMasterfileImport, $path);
        
        //TODO: 2022-04-11 Temp only
        $date = Carbon::now()->toDateTimeString();
        $default_path = 'item-images/no_image_item.jpg';
        //TODO: 2022-04-11 From ItemMasterfileImport.php
        ItemMasterfile::where('barcode', '=', NULL)
            ->update(['barcode' => '']);
        ItemMasterfile::where('product_family', '=', NULL)
            ->update(['product_family' => '']);
        ItemMasterfile::where('isPromo', '=', NULL)
            ->update(['isPromo' => 1]);
        ItemMasterfile::where('image', '=', NULL)
            ->update(['image' => $default_path]);
        ItemMasterfile::where('order_count', '=', NULL)
            ->update(['order_count' => 0]);
        ItemMasterfile::where('date_uploaded', '=', NULL)
            ->update(['date_uploaded' => $date]);
        ItemMasterfile::where('status', '=', NULL)
            ->update(['status' => 1]);

        // Excel::import(new ItemMasterfileImport, $path);
        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function getCategoryItem()
    {
        $category = request()->name;
        if ($category === null) {
            return ItemMasterfile::paginate(10);
        } else if ($category === 'ALL PRODUCTS') {
            return ItemMasterfile::paginate(10);
        } else {
            return ItemMasterfile::where([['product_family', '=', $category], ['product_family', '!=', '']])->paginate(10);
        }
    }

    public function searchCategoryItem()
    {
        $search = request()->name;
        return ItemMasterfile::where('product_name', 'LIKE', "%$search%")->paginate(10);
    }

    public function getReturnedItems()
    {
        $data_res = [];
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        $result =  DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            // ->whereDate('date_req', '=', $date)
            ->whereBetween('date_req', [$date, $date2])
            ->where('tran_stat', 'Returned')
            ->orderBy('id')
            ->paginate(10);
        return $result;
    }
    
    public function getReturnedItemsnaUnserved()
    {
        $data_res = [];
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();
        $result =  DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            // ->whereDate('date_req', '=', $date)
            ->whereBetween('date_req', [$date, $date2])
            ->where('tran_stat', 'Unserved')
            ->orderBy('id')
            ->paginate(10);
        return $result;
    }


    public function getUnservedItems()
    {
        $data_res = [];
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $result =  DB::table('tb_unserved_items')
            ->select('tb_unserved_items.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->whereBetween('date_req', [$date, $date2])
            ->where('itm_stat', 'Unserved')
            ->orderBy('id')
            ->paginate(10);
        return $result;
    }

    public function print()
    {

        // $date = Carbon::parse(base64_decode(request()->date))->toDateString();

        // $res1 = DB::table('tb_tran_line')
        //     ->select('tb_tran_line.*', 'tb_tran_head.sm_code AS sm_code', 'tb_tran_head.tran_no AS tran_no', 'tb_tran_head.date_req AS date_req', 'tb_tran_head.account_code AS account_code', 'tb_tran_head.date_app AS date_app', 'tb_tran_head.date_del AS date_del', 'tb_tran_head.p_meth AS p_meth', 'tb_tran_line.tot_amt AS tot_amt', 'item_masterfiles.image AS image', 'item_masterfiles.status AS status', 'item_masterfiles.principal AS principal', 'item_masterfiles.product_family AS product_family', 'item_masterfiles.list_price_wouttax', 'item_masterfiles.list_price_wtax')
        //     ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'tb_tran_line.tran_no')
        //     ->join('item_masterfiles', 'item_masterfiles.itemcode', '=', 'tb_tran_line.itm_code')
        //     ->whereRaw('tb_tran_line.del_qty != 0 AND tb_tran_line.req_qty != tb_tran_line.del_qty AND item_masterfiles.uom = tb_tran_line.uom')
        //     ->whereDate('tb_tran_head.date_req', $date)
        //     ->get();

        // if (!empty($res1)) {

        //     foreach ($res1 as $row1) {

        //         $res2 = DB::table('customer_master_files')
        //             ->where('account_code', $row1->account_code)
        //             ->first();

        //         $res3 = DB::table('salesman_lists')
        //             ->where('user_code', $row1->sm_code)
        //             ->first();

        //         $data_res[] = array(
        //             'doc_no'                            =>  $row1->doc_no,
        //             'item_desc'                         =>  $row1->item_desc,
        //             'tran_no'                           =>  $row1->tran_no,
        //             'date_req'                          =>  $row1->date_req,
        //             'date_app'                          =>  $row1->date_app,
        //             'date_del'                          =>  $row1->date_del,
        //             'p_meth'                            =>  $row1->p_meth,
        //             'account_name'                      =>  $res2->account_name,
        //             'account_description'               =>  $res2->account_description,
        //             'address2'                          =>  $res2->address2,
        //             'address3'                          =>  $res2->address3,
        //             'address1'                          =>  $res2->address1,
        //             'first_name'                        =>  $res3->first_name,
        //             'last_name'                         =>  $res3->last_name,
        //             'principal'                         =>  $row1->principal,
        //             'product_family'                    =>  $row1->product_family,
        //             'list_price_wouttax'                =>  $row1->list_price_wouttax,
        //             'list_price_wtax'                   =>  $row1->list_price_wtax,
        //             'uom'                               =>  $row1->uom,
        //             'itm_code'                          =>  $row1->itm_code,
        //             'req_qty'                           =>  $row1->req_qty,
        //             'del_qty'                           =>  $row1->del_qty,
        //             'amt'                               =>  $row1->amt,
        //             'tot_amt'                           =>  $row1->tot_amt,
        //             'image'                             =>  $row1->image,
        //             'status'                            =>  $row1->status
        //         );
        //     }
        // }

        $data = $this->data_res();

        return view('reports.transaction', ['sample_data' => $data]);
    }

    public function data_res()
    {
        // dd(request()->all());
        $data = [];
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        // dd($date, $date2);

        // $gethead = DB::table('tb_tran_head')
        //     ->select('tb_tran_head.*', 'customer_master_files.account_name')
        //     ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
        //     ->whereBetween('date_req', [$date, $date2])
        //     ->orderBy('id')
        //     ->get();

        $gethead = DB::table('tb_tran_head')
            ->selectRaw('DISTINCT(tb_tran_head.tran_no), tb_tran_head.id as id, tb_tran_head.date_req, tb_tran_head.store_name, tb_tran_head.account_code, customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->join('tb_unserved_items', 'tb_unserved_items.tran_no', '=', 'tb_tran_head.tran_no')
            ->where('tb_unserved_items.itm_stat', '=', 'Returned')
            ->whereBetween('date_req', [$date, $date2])
            ->orderBy('id')
            ->get();

        // dd($gethead);
        foreach ($gethead as $datahead) {
            $data_res = [];

            // dd($datahead->tran_no);
            $res1 = DB::table('tb_tran_line')
                ->selectRaw(
                    'tb_tran_line.doc_no,tb_tran_line.tran_no, tb_tran_head.tot_amt as head_tot_amt,tb_tran_line.itm_code,tb_tran_line.item_desc,tb_tran_line.req_qty,tb_tran_line.del_qty,tb_tran_line.uom,tb_tran_line.amt,tb_tran_line.discount,tb_tran_line.tot_amt as line_tot_amt,tb_tran_line.discounted_amount,tb_tran_line.itm_cat,tb_tran_line.itm_stat,tb_tran_head.date_req,tb_tran_line.flag,tb_tran_head.tran_stat,tbl_item_image.item_path,tbl_category_masterfile.id,tb_tran_line.req_qty - tb_tran_line.del_qty AS unserved,tb_unserved_items.qty AS retQty,tb_unserved_items.itm_stat AS unsRet'
                )
                ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'tb_tran_line.tran_no')
                ->join(
                    'tbl_item_image',
                    function ($join) {
                        $join->on(
                            'tbl_item_image.item_code',
                            '=',
                            'tb_tran_line.itm_code',
                        );
                        $join->on(
                            'tbl_item_image.item_uom',
                            '=',
                            'tb_tran_line.uom'
                        );
                    }
                )
                ->join('tbl_category_masterfile', 'tbl_category_masterfile.category_name', '=', 'tb_tran_line.itm_cat')
                ->join(
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

                        $join->where(
                            'tb_unserved_items.itm_stat',
                            '=',
                            "Returned"
                        );
                    }

                )
                ->where('tb_tran_line.tran_no', '=', $datahead->tran_no)
                ->orderBy('tbl_category_masterfile.id', 'ASC')
                ->get();

            // dd($res1);

            if (!empty($res1)) {

                foreach ($res1 as $row1) {
                    $del_qty = $row1->req_qty - ($row1->unserved + $row1->retQty);

                    if ($del_qty == '0') {
                        $total_del_amt = 0;
                    } else {
                        $total_del_amt = $del_qty * $row1->amt;
                    }
                    $total_ret_amt = $row1->retQty * $row1->amt;

                    if ($total_del_amt == '0') {
                        $total = 0;
                    } else {
                        $total = $total_del_amt - $total_ret_amt;
                    }


                    $float = (float)$row1->discount / 100; //string to float
                    $total_amt_discount = $total_del_amt * $float;
                    if ($total == '0') {
                        $totaltotal = 0;
                    } else {
                        $totaltotal =  $total_del_amt - $total_amt_discount;
                    }
                    // dd($float);
                    $data_res[] = array(
                        'doc_no'                            =>  $row1->doc_no,
                        'tran_no'                           =>  $row1->tran_no,
                        'head_tot_amt'                      =>  $row1->head_tot_amt,
                        'itm_code'                          =>  $row1->itm_code,
                        'item_desc'                         =>  $row1->item_desc,
                        'req_qty'                           =>  $row1->req_qty,
                        'del_qty'                           =>  $del_qty,
                        'uom'                               =>  $row1->uom,
                        'amt'                               =>  $row1->amt,
                        'discount'                          =>  $row1->discount,
                        'line_tot_amt'                      =>  $row1->line_tot_amt,
                        'discounted_amount'                 =>  $row1->discounted_amount,
                        'itm_cat'                           =>  $row1->itm_cat,
                        'itm_stat'                          =>  $row1->itm_stat,
                        'date_req'                          =>  $row1->date_req,
                        'flag'                              =>  $row1->flag,
                        'tran_stat'                         =>  $row1->tran_stat,
                        'item_path'                         =>  $row1->item_path,
                        'unserved'                          =>  $row1->unserved,
                        'retQty'                            =>  $row1->retQty,
                        'unsRet'                            =>  $row1->unsRet,
                        'total_del_amt'                     =>  $total_del_amt,
                        'total_ret_amt'                     =>  $total_ret_amt,
                        'total_gross'                       =>  $total,
                        'total_amt_discount'                => $total_amt_discount,
                        'totaltotal'                        => $totaltotal
                    );
                }

                $data[] = array(
                    'tran_no'       => $datahead->tran_no,
                    'store_name'    =>  $datahead->store_name,
                    'so_no'         =>  $datahead->tran_no,
                    'date_now'      =>  Carbon::now(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'datas'         => $data_res
                );
            }
        }

        return $data;
    }

    public function transaction()
    {
        $data = $this->data_res();
        // dd($data);
        $pdf = PDF::loadView('reports.transaction', ['datas' => $data]);
        return $pdf->download('transaction.pdf');
    }

    public function printUnserved()
    {
        $data = $this->data_res2();
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->toDateString();
        // dd($data);
        $pdf = PDF::loadView('reports.unserved', ['datas' => $data]);
        return $pdf->download('Unserved Items (' . $date . ' to ' . $date2 . ').pdf');
    }

    public function data_res2()
    {
        $data_res2 = [];
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $data = [];
        $data_res = [];
        // dd($date, $date2);
        // $trans = explode(',', request()->tran);
        // foreach ($trans as $tran) {
        $gethead = DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->join('tb_unserved_items', 'tb_unserved_items.tran_no', '=', 'tb_tran_head.tran_no')
            ->where('tb_unserved_items.itm_stat', '=', 'Returned')
            ->whereBetween('date_req', [$date, $date2])
            ->orderBy('id')
            ->get();

        // $gethead = DB::table('tb_tran_head')
        // ->selectRaw('DISTINCT(tb_tran_head.tran_no), tb_tran_head.id as id, tb_tran_head.date_req, tb_tran_head.store_name, tb_tran_head.account_code, customer_master_files.account_name')
        // ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
        // ->join('tb_unserved_items', 'tb_unserved_items.tran_no', '=', 'tb_tran_head.tran_no')
        // ->where('tb_unserved_items.itm_stat', '=', 'Returned')
        // ->whereBetween('date_req', [$date, $date2])
        // ->orderBy('id')
        // ->get();
        // dd($gethead);
        foreach ($gethead as $datahead) {

            $res1 = DB::table('tb_tran_line')
                ->selectRaw(
                    'tb_tran_line.doc_no,tb_tran_line.tran_no, tb_tran_head.tot_amt as head_tot_amt,tb_tran_line.itm_code,tb_tran_line.item_desc,tb_tran_line.req_qty,tb_tran_line.del_qty,tb_tran_line.uom,tb_tran_line.amt,tb_tran_line.discount,tb_tran_line.tot_amt as line_tot_amt,tb_tran_line.discounted_amount,tb_tran_line.itm_cat,tb_tran_line.itm_stat,tb_tran_head.date_req,tb_tran_line.flag,tb_tran_head.tran_stat,tbl_item_image.item_path,tbl_category_masterfile.id,tb_tran_line.req_qty - tb_tran_line.del_qty AS unserved,tb_unserved_items.qty AS retQty,tb_unserved_items.itm_stat AS unsRet'
                )
                ->join('tb_tran_head', 'tb_tran_head.tran_no', '=', 'tb_tran_line.tran_no')
                ->join(
                    'tbl_item_image',
                    function ($join) {
                        $join->on(
                            'tbl_item_image.item_code',
                            '=',
                            'tb_tran_line.itm_code',
                        );
                        $join->on(
                            'tbl_item_image.item_uom',
                            '=',
                            'tb_tran_line.uom'
                        );
                    }
                )
                ->join('tbl_category_masterfile', 'tbl_category_masterfile.category_name', '=', 'tb_tran_line.itm_cat')
                ->join(
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

                        $join->where(
                            'tb_unserved_items.itm_stat',
                            '=',
                            "Returned"
                        );
                    }

                )
                ->where('tb_tran_line.tran_no', '=', $datahead->tran_no)
                ->orderBy('tbl_category_masterfile.id', 'ASC')
                ->get();

            // dd($res1);

            if (!empty($res1)) {

                foreach ($res1 as $row1) {
                    $del_qty = $row1->req_qty - ($row1->unserved + $row1->retQty);

                    if ($del_qty == '0') {
                        $total_del_amt = 0;
                    } else {
                        $total_del_amt = $del_qty * $row1->amt;
                    }
                    $total_ret_amt = $row1->retQty * $row1->amt;
                    $total_uns_amt = $row1->unserved * $row1->amt;

                    if ($total_del_amt == '0') {
                        $total = 0;
                    } else {
                        $total = $total_del_amt - $total_ret_amt;
                    }


                    $float = (float)$row1->discount / 100; //string to float
                    $total_amt_discount = $total_del_amt * $float;
                    if ($total == '0') {
                        $totaltotal = 0;
                    } else {
                        $totaltotal =  $total_del_amt - $total_amt_discount;
                    }
                    // dd($res1);
                    $data_res[] = array(
                        'doc_no'                            =>  $row1->doc_no,
                        'tran_no'                           =>  $row1->tran_no,
                        'head_tot_amt'                      =>  $row1->head_tot_amt,
                        'itm_code'                          =>  $row1->itm_code,
                        'item_desc'                         =>  $row1->item_desc,
                        'req_qty'                           =>  $row1->req_qty,
                        'del_qty'                           =>  $del_qty,
                        'uom'                               =>  $row1->uom,
                        'amt'                               =>  $row1->amt,
                        'discount'                          =>  $row1->discount,
                        'line_tot_amt'                      =>  $row1->line_tot_amt,
                        'discounted_amount'                 =>  $row1->discounted_amount,
                        'itm_cat'                           =>  $row1->itm_cat,
                        'itm_stat'                          =>  $row1->itm_stat,
                        'date_req'                          =>  $row1->date_req,
                        'flag'                              =>  $row1->flag,
                        'tran_stat'                         =>  $row1->tran_stat,
                        'item_path'                         =>  $row1->item_path,
                        'unserved'                          =>  $row1->unserved,
                        'retQty'                            =>  $row1->retQty,
                        'unsRet'                            =>  $row1->unsRet,
                        'total_del_amt'                     =>  $total_del_amt,
                        'total_ret_amt'                     =>  $total_ret_amt,
                        'total_uns_amt'                     => $total_uns_amt,
                        'total_gross'                       =>  $total,
                        'total_amt_discount'                => $total_amt_discount,
                        'totaltotal'                        => $totaltotal
                    );
                }

                $data[] = array(
                    'tran_no'       => $datahead->tran_no,
                    'store_name'    =>  $datahead->store_name,
                    'so_no'         =>  $datahead->tran_no,
                    'date_now'      =>  Carbon::now(),
                    'acct_code'     =>  $datahead->account_code,
                    'acct_name'     =>  $datahead->account_name,
                    'date_req'      =>  date('m/d/Y', strtotime($datahead->date_req)),
                    'datas'         => $data_res
                );
            }
        }
        // }

        return $data;
    }
    
    public function getListNoItems()
    {
        return DB::table('nomatch_itemcode')->paginate(10);
    }
    
    public function dropItem(Request $request)
    {
        $res = DB::table('nomatch_itemcode')->where([['id', '=', $request->id]])->exists();
        if ($res === true) {
            $choose_item = DB::table('nomatch_itemcode')->where([['id', '=', $request->id]]);
            $choose_item->delete();
            return 'Success';
        } else {

            return 'Error';
        }
    }

    public function searchNoItem()
    {

        return DB::table('nomatch_itemcode')->where(function ($query) {
            $search = request()->name;
            $query->where('itemcode', 'LIKE', "%$search%")
                ->orWhere('item_path', 'LIKE', "%$search%");
        })
            ->paginate(10);
    }

    public function searchReturnedItems()
    {
        $search = request()->name;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $result =  DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->where('customer_master_files.account_name', 'LIKE', "%$search%")
            ->whereBetween('date_req', [$date, $date2])
            ->orderBy('id')
            ->paginate(10);
        return $result;
    }

    public function searchUnservedItems()
    {
        // dd(request()->all());
        $search = request()->name;
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $date2 = Carbon::parse(base64_decode(request()->date2))->endOfDay()->toDateTimeString();

        $result =  DB::table('tb_tran_head')
            ->select('tb_tran_head.*', 'customer_master_files.account_name')
            ->join('customer_master_files', 'customer_master_files.account_code', '=', 'tb_tran_head.account_code')
            ->where('customer_master_files.account_name', 'LIKE', "%$search%")
            ->whereBetween('date_req', [$date, $date2])
            ->orderBy('id')
            ->paginate(10);
        return $result;
    }

    public function getListItems()
    {
        return ItemMasterfile::where([['image', '!=', 'item-images/no_image_item.jpg']])->paginate(10);
        // return ItemMasterfile::paginate(10);

    }

    public function getListItems1()
    {
        return ItemMasterfile::where([['image', '=', 'item-images/no_image_item.jpg']])->paginate(10);
    }

    public function getListItems2()
    {
        return ItemMasterfile::paginate(10);
    }

    public function searchItemu()
    {

        return ItemMasterfile::where(function ($query) {
            $search = request()->name;
            $query->where('product_name', 'LIKE', "%$search%")
                ->orWhere('itemcode', 'LIKE', "%$search%")
                ->orWhere('uom', 'LIKE', "%$search%");
        })
            ->paginate(10);
    }

    public function searchItem()
    {

        return ItemMasterfile::where('image', '!=', 'item-images/no_image_item.jpg')
            ->where(function ($query) {
                $search = request()->name;
                $query->where('product_name', 'LIKE', "%$search%")
                    ->orWhere('itemcode', 'LIKE', "%$search%")
                    ->orWhere('uom', 'LIKE', "%$search%");
            })
            ->paginate(10);
    }

    public function searchItem1()
    {

        return ItemMasterfile::where('image', '=', 'item-images/no_image_item.jpg')
            ->where(function ($query) {
                $search = request()->name;
                $query->where('product_name', 'LIKE', "%$search%")
                    ->orWhere('itemcode', 'LIKE', "%$search%")
                    ->orWhere('uom', 'LIKE', "%$search%");
            })
            ->paginate(10);
    }

     public function store_image(Request $request)
    {
        // Storage::copy(storage_path('app/public/item-images/100465_CASE.JPG'), public_path('assets/photos/100465_CASE.JPG'));
        // dd(1);

        // dd($request);
        
        // kaloy 2021-10-27
        $img_uploaded_count = 0;

        DB::transaction(function () use ($request, &$img_uploaded_count) {
            // DB::beginTransaction();

            $images = $request->images;

            $date = Carbon::now()->toDateString();

            $paths = [];

            foreach ($images as $image) {
                $filename = $image->getClientOriginalName();

                $filePath = $image->path();

                $fileX = new File($filePath);
                $bits = explode(".", $filename);
                $itemcode = $bits[0]; //itemcode
                $extension = $bits[1]; //jpg / png

                //dump($itemcode . "." . $extension);

                $with = strripos($itemcode, "_"); //find "_"

                if ($with === true) {

                    $bits1 = explode("_", $itemcode);
                    $itemcode1 = $bits1[0];

                    $checkuoms1 = ItemMasterfile::select('itemcode', 'uom', 'conversion_qty')
                        ->where([['itemcode', '=', trim($itemcode1)]])->get();

                    if ($checkuoms1 === true) {

                        $checkuoms = ItemMasterfile::select('itemcode', 'uom', 'conversion_qty')
                            ->where([['itemcode', '=', trim($itemcode1)]])->get();

                        foreach ($checkuoms as $key => $uoms) {

                            $check = ItemImagesPath::where([['item_code', '=', $uoms['itemcode']], ['item_uom', '=', $uoms['uom']]])->exists();

                            if ($check === true) {

                                // $filename1 = $itemcode1 . "_" . $uoms['uom'] . "." . $extension;

                                $filename1 = $itemcode1 . "." . $extension;

                                // $path_file1 = "item-images/" . $itemcode1 . "_" . $uoms['uom'] . "." . $extension;

                                $path_file1 = "item-images/" . $itemcode1 . "." . $extension;

                                // $path_file2 = $itemcode1 . "_" . $uoms['uom'] . "." . $extension;

                                $path_file2 = $itemcode1 . "." . $extension;

                                // $image->storeAs('item-images', $filename1, 'public');

                                // $path = Storage::putFileAs('photos', $fileX, $filename1);

                                // $paths[] = $path;



                                move_uploaded_file($filePath, "../distribution.alturush.com/" . $path_file1);


                                if ($uoms['conversion_qty'] === '1') {

                                    ItemMasterfile::where([['itemcode', '=', trim($itemcode1)], ['conversion_qty', '=', '1']])
                                        ->update(['image' => $path_file1]);

                                    // ItemImagesPath::insert(
                                    //     [
                                    //         'item_code'     =>  trim($itemcode1),
                                    //         'item_uom'      =>  $uoms['uom'],
                                    //         'item_path'     =>  $path_file2,
                                    //         'created_at'    =>  $date,
                                    //         'updated_at'    =>  $date
                                    //     ]
                                    // );

                                    ItemImagesPath::where([['item_code', '=', trim($itemcode1)], ['item_uom', '=', $uoms['uom']]])
                                        ->update(['item_path' => $path_file2]);
                                } else {

                                    // ItemMasterfile::where([['itemcode', '=', trim($itemcode1)], ['conversion_qty', '!=', '1']])
                                    //     ->update(['image' => $box1]);

                                    ItemMasterfile::where([['itemcode', '=', trim($itemcode1)], ['conversion_qty', '!=', '1']])
                                        ->update(['image' => $path_file1]);

                                    // ItemImagesPath::insert(
                                    //     [
                                    //         'item_code'     =>  trim($itemcode1),
                                    //         'item_uom'      =>  $uoms['uom'],
                                    //         'item_path'     =>  $box,
                                    //         'created_at'    =>  $date,
                                    //         'updated_at'    =>  $date
                                    //     ]
                                    // );

                                    // ItemImagesPath::insert(
                                    //     [
                                    //         'item_code'     =>  trim($itemcode1),
                                    //         'item_uom'      =>  $uoms['uom'],
                                    //         'item_path'     =>  $path_file2,
                                    //         'created_at'    =>  $date,
                                    //         'updated_at'    =>  $date
                                    //     ]
                                    // );

                                    ItemImagesPath::where([['item_code', '=', trim($itemcode1)], ['item_uom', '=', $uoms['uom']]])
                                        ->update(['item_path' => $path_file2]);
                                }
                            }
                        }
                        
                        // kaloy 2021-10-27
                        $img_uploaded_count++;
                        
                    } else {
                        $check = DB::table('nomatch_itemcode')->where('itemcode', '=', $itemcode1)->exists();
                        if ($check === false) {
                            DB::table('nomatch_itemcode')->insert(
                                [
                                    'itemcode'     =>  $itemcode1,
                                    'item_path'     => $filename,
                                    'created_at'    =>  $date,
                                    'updated_at'    =>  $date
                                ]
                            );
                        }
                    }
                } else {

                    $checkuoms1 = ItemMasterfile::select('itemcode', 'uom', 'conversion_qty')
                        ->where([['itemcode', '=', trim($itemcode)]])->exists();

                    if ($checkuoms1 === true) {

                        $checkuoms = ItemMasterfile::select('itemcode', 'uom', 'conversion_qty')
                            ->where([['itemcode', '=', trim($itemcode)]])->get();

                        foreach ($checkuoms as $key => $uoms) {

                            $check = ItemImagesPath::where([['item_code', '=', $uoms['itemcode']], ['item_uom', '=', $uoms['uom']]])->exists();

                            if ($check === true) {
                                // $filename1 = $itemcode . "_" . $uoms['uom'] . "." . $extension;

                                $filename1 = $itemcode . "." . $extension;

                                // $path_file1 = "item-images/" . $itemcode . "_" . $uoms['uom'] . "." . $extension;

                                $path_file1 = "item-images/" . $itemcode . "." . $extension;

                                // $path_file2 = $itemcode . "_" . $uoms['uom'] . "." . $extension;

                                $path_file2 = $itemcode . "." . $extension;

                                // $image->storeAs('item-images', $filename1, 'public');

                                // $path = Storage::putFileAs('photos', $fileX, $filename1);

                                // $paths[] = $path;



                                move_uploaded_file($filePath, "../distribution.alturush.com/" . $path_file1);

                                if ($uoms['conversion_qty'] === '1') {

                                    ItemMasterfile::where([['itemcode', '=', trim($itemcode)], ['conversion_qty', '=', '1']])
                                        ->update(['image' => $path_file1]);

                                    // ItemImagesPath::insert(
                                    //     [
                                    //         'item_code'     =>  trim($itemcode),
                                    //         'item_uom'      =>  $uoms['uom'],
                                    //         'item_path'     =>  $path_file2,
                                    //         'created_at'    =>  $date,
                                    //         'updated_at'    =>  $date
                                    //     ]
                                    // );

                                    ItemImagesPath::where([['item_code', '=', trim($itemcode)], ['item_uom', '=', $uoms['uom']]])
                                        ->update(['item_path' => $path_file2]);
                                } else {

                                    // ItemMasterfile::where([['itemcode', '=', trim($itemcode)], ['conversion_qty', '!=', '1']])
                                    //     ->update(['image' => $box1]);

                                    ItemMasterfile::where([['itemcode', '=', trim($itemcode)], ['conversion_qty', '!=', '1']])
                                        ->update(['image' => $path_file1]);

                                    // ItemImagesPath::insert(
                                    //     [
                                    //         'item_code'     =>  trim($itemcode),
                                    //         'item_uom'      =>  $uoms['uom'],
                                    //         'item_path'     =>  $box,
                                    //         'created_at'    =>  $date,
                                    //         'updated_at'    =>  $date
                                    //     ]
                                    // );

                                    // ItemImagesPath::insert(
                                    //     [
                                    //         'item_code'     =>  trim($itemcode),
                                    //         'item_uom'      =>  $uoms['uom'],
                                    //         'item_path'     =>  $path_file2,
                                    //         'created_at'    =>  $date,
                                    //         'updated_at'    =>  $date
                                    //     ]
                                    // );

                                    ItemImagesPath::where([['item_code', '=', trim($itemcode)], ['item_uom', '=', $uoms['uom']]])
                                        ->update(['item_path' => $path_file2]);
                                }
                            }
                        }
                        
                        // kaloy 2021-10-27
                        $img_uploaded_count++;
                        
                    } else {
                        $check = DB::table('nomatch_itemcode')->where('itemcode', '=', $itemcode)->exists();
                        if ($check === false) {
                            DB::table('nomatch_itemcode')->insert(
                                [
                                    'itemcode'     =>  $itemcode,
                                    'item_path'     => $filename,
                                    'created_at'    =>  $date,
                                    'updated_at'    =>  $date
                                ]
                            );
                        }
                    }
                }
            }

            // $image      = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            // $image_name = addslashes($_FILES['image']['name']);
            // $array  = explode(".", $image_name);

            // $filename   = date('Y-m-d H-i-s-A') . "." . end($array);
            // $imagePath   = "images/tenant_users/" . $filename;

            // move_uploaded_file($_FILES['image']['tmp_name'], "../apanel.alturush.com/" . $imagePath);


            // foreach ($paths as $xpath) {
            //     $xfileName = explode('/', $xpath)[1];
            //     $file = new File(Storage::path($xpath));
            //     $file->move(public_path('../distribution.alturush.com/item-images/'), $xfileName);
            // }
        });

        // kaloy 2021-10-27
        return response()->json(['message' => 'Item has been updated.', 'img_uploaded_count' => $img_uploaded_count], 200);
    }

    public function activate(Request $request)
    {
        $res = ItemMasterfile::where([['item_masterfiles_id', '=', $request->id], ['status', '=', $request->status]])->exists();
        if ($res === true) {
            return 'Error';
        } else {
            $res2 = ItemMasterfile::where('item_masterfiles_id', '=', $request->id)->update([
                'status' => $request->status,
            ]);
            if ($res2) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function getListUpdatedItem()
    {
        return ItemMasterfile::all();

        // $item_masterfile = ItemMasterfile::all();

        // foreach ($item_masterfile as $item) {
        //     //$id             = base64_encode($this->encrypt->encode($item['item_masterfiles_id']));

        //     $arr['data'][] = array(
        //         'product_name'            => $item['product_name'],
        //         'product_shrt_name'       => $item['product_shrt_name'],
        //         'description'             => $item['description'],
        //         'company_code'            => $item['company_code'],
        //         'option'                  => '<button>Submit</button>',
        //         'itemcode'                => $item['itemcode'],
        //         'barcode'                 => $item['barcode'],
        //         'brand'                   => $item['brand'],
        //         'principal'               => $item['principal'],
        //         'product_family'          => $item['product_family'],
        //         'keywords'                => $item['keywords'],
        //         'uom'                     => $item['uom'],
        //         'list_price_wouttax'      => $item['list_price_wouttax'],
        //         'list_price_wtax'         => $item['list_price_wtax'],
        //         'conversion_qty'          => $item['conversion_qty'],
        //         'conversion_uom'          => $item['conversion_uom'],
        //         'image'                   => 'image'
        //     );

        //     echo json_encode($arr);
        // }
    }

    public function getListUnUpdatedItem()
    {
        return ItemMasterfile::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Item::create([
        //     'product_name' => $data['product_name'],
        //     'product_shrt_name' => $data['product_shrt_name'],
        //     'description' => $data['description'],
        //     'company_code' => $data['company_code'],
        //     'itemcode' => $data['itemcode'],
        //     'barcode' => $data['barcode'],
        //     'brand' => $data['brand'],
        //     'principal' => $data['principal'],
        //     'product_family' => $data['product_family'],
        //     'keywords' => $data['keywords'],
        //     'uom' => $data['uom'],
        //     'list_price_wouttax' => $data['list_price_wout_tax'],
        //     'list_price_wtax' => $data['list_price_wtax'],
        //     'conversion_qty' => $data['conversion_qty'],
        //     'conversion_uom' => $data['conversion_uom'],
        //     'isPromo' => $data['ispromo'],
        //     'image' => $data['image'],
        // ]);
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
     * @param  \App\ItemMasterfile  $itemMasterfile
     * @return \Illuminate\Http\Response
     */
    public function show(ItemMasterfile $itemMasterfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemMasterfile  $itemMasterfile
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemMasterfile $itemMasterfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemMasterfile  $itemMasterfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemMasterfile $itemMasterfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemMasterfile  $itemMasterfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemMasterfile $itemMasterfile)
    {
        //
    }
}
