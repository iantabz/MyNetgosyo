<?php

namespace App\Http\Controllers;

use App\ItemHistoryLog;
use App\ItemMasterfile;
use Illuminate\Http\Request;
use DB;

class ItemHistoryLogController extends Controller
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
        return ItemHistoryLog::latest()->paginate(10);
    }

    public function getListItemsLog()
    {
        return ItemHistoryLog::orderBy('log_id', 'desc')->paginate(10);
        // return ItemHistoryLog::paginate(10);
    }

    public function searchItemLog()
    {

        $search = request()->name;
        // return ItemHistoryLog::where('product_name', 'LIKE', "%$search%")->paginate(10);
        return ItemHistoryLog::where('product_name', 'LIKE', "%$search%")->paginate(10);
    }

    public function detailsLog()
    {
        $id = request()->id;

        $res = ItemMasterfile::select(
            'item_masterfiles.item_masterfiles_id AS item_masterfiles_id',
            'item_masterfiles.product_name AS product_name',
            'item_masterfiles.product_shrt_name AS product_shrt_name',
            'item_masterfiles.description AS description',
            'item_masterfiles.company_code AS company_code',
            'item_masterfiles.itemcode AS itemcode',
            'item_masterfiles.barcode AS barcode',
            'item_masterfiles.brand AS brand',
            'item_masterfiles.principal AS principal',
            'item_masterfiles.product_family AS product_family',
            'item_masterfiles.keywords AS keywords',
            'item_masterfiles.uom AS uom',
            'item_masterfiles.list_price_wouttax AS list_price_wouttax',
            'item_masterfiles.list_price_wtax AS list_price_wtax',
            'item_masterfiles.conversion_qty AS conversion_qty',
            'item_masterfiles.conversion_uom AS conversion_uom',
            'item_masterfiles.image AS image',
            'item_masterfiles.status AS status',
            'item_masterfiles.order_count AS order_count',
            'item_masterfiles.date_uploaded AS date_uploaded',
            'item_history_logs.product_name AS product_name',
            'item_history_logs.itemcode AS itemcode',
            'item_history_logs.uom AS uom',
            'item_history_logs.price1 AS price1',
            'item_history_logs.price2 AS price2',
            'item_history_logs.uom1 AS uom1',
            'item_history_logs.uom2 AS uom2',
            'item_history_logs.product_family1 AS product_family1',
            'item_history_logs.product_family2 AS product_family2',
            'item_history_logs.principal1 AS principal1',
            'item_history_logs.principal2 AS principal2',
            'item_history_logs.brand1 AS brand1',
            'item_history_logs.brand2 AS brand2',
            'item_history_logs.keywords1 AS keywords1',
            'item_history_logs.keywords2 AS keywords2',
            'item_history_logs.description1 AS description1',
            'item_history_logs.description2 AS description2',
            'item_history_logs.date_from AS date_from',
            'item_history_logs.date_to AS date_to'
        )
            ->join('item_history_logs', 'item_masterfiles.item_masterfiles_id', '=', 'item_history_logs.item_masterfile_id')
            ->whereRaw('item_masterfiles.itemcode = item_history_logs.itemcode AND item_masterfiles.uom = item_history_logs.uom')
            ->where('item_history_logs.log_id', $id)
            ->get();

        return response()->json($res);
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
        $res =  ItemHistoryLog::create([
            'item_masterfile_id' => $request->item_masterfile_id,
            'price1' => $request->price1,
            'price2' => $request->price2,
            'price3' => $request->price3,
            'price4' => $request->price4,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'date_uploaded' => $request->date_uploaded
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemHistoryLog  $itemHistoryLog
     * @return \Illuminate\Http\Response
     */
    public function show(ItemHistoryLog $itemHistoryLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemHistoryLog  $itemHistoryLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemHistoryLog $itemHistoryLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemHistoryLog  $itemHistoryLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemHistoryLog $itemHistoryLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemHistoryLog  $itemHistoryLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemHistoryLog $itemHistoryLog)
    {
        //
    }
}
