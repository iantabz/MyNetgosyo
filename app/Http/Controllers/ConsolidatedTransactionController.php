<?php

namespace App\Http\Controllers;

use App\ConsolidatedTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsolidatedTransactionController extends Controller
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

    public function searchConsolidated()
    {
        $date = Carbon::parse(base64_decode(request()->date))->toDateString();
        $search = request()->name;
        // return ItemHistoryLog::where('product_name', 'LIKE', "%$search%")->paginate(10);
        return ConsolidatedTransaction::where('customer_code', 'LIKE', "%$search%")
            ->whereDate('posting_date', $date)
            ->paginate(10);
    }


    // kaloy 2022-04-07
    public function getConsolidated(Request $request)
    {
        set_time_limit(0);

        $data_res = [];
        $searchKey = $request->searchKey ?? '';
        $postingDate = $request->postingDate ?? '';
        $postingDate = substr($postingDate,0,10);
        $uploadDate = $request->uploadDate ?? '';
        $uploadDate = substr($uploadDate,0,10);
        
        
        $manuallyAddedOnly = $request->is_manual ?? 'false';
        $is_manual = $manuallyAddedOnly == 'false' ? 0 : 1;

        $res1 = ConsolidatedTransaction::select(
            'consolidated_transactions.*',
            'tb_tran_head.tran_no'
        )
            ->leftJoin(
                'tb_tran_head',
                'consolidated_transactions.reference_no',
                '=',
                'tb_tran_head.tran_no'
            )

            ->where('consolidated_transactions.posting_date', 'like', '%' . $postingDate . '%')
            ->where('consolidated_transactions.date_uploaded', 'like', '%' . $uploadDate . '%')

            ->where(function ($query) use (&$searchKey) {
                $keys = explode(' ',$searchKey);

                foreach ($keys as $key) {
                    $query->where(function($q) use($key) {
                        $q->where('consolidated_transactions.sales_invoice', 'like', '%' . $key . '%')
                            ->orWhere('consolidated_transactions.reference_no', 'like', '%' . $key . '%')
                            ->orWhere('consolidated_transactions.itemcode', 'like', '%' . $key . '%')
                            ->orWhere('consolidated_transactions.customer_code', 'like', '%' . $key . '%')
                            
                        ;
                    });
                }

            })

            // ? ========================================================================
            ->when($is_manual == 0, function ($q) {
                return $q->where(function ($q) {
                    $q->where('consolidated_transactions.is_manual', 0)
                        ->orWhere(function ($q) {
                            $q->where('consolidated_transactions.is_manual', 1)
                                ->where('consolidated_transactions.is_manual_appended', 1);
                        });
                });
            })
            ->when($is_manual == 1, function ($q) {
                return $q->where('consolidated_transactions.is_manual', 1)
                    ->where('consolidated_transactions.is_manual_appended', 0);
            })
            // ? ========================================================================

            ->orderBy('consolidated_transactions.consolidated_id', 'DESC')
            ->paginate(10);
        // ->paginate(5000);

        // dd($res1);

        $transformed = $res1->getCollection();

        if (!empty($transformed)) {

            foreach ($transformed as $row1) {
                $res2 = DB::table('customer_master_files')
                    ->where('account_code', $row1->customer_code)
                    ->first();

                $res3 = DB::table('salesman_lists')
                    ->where('user_code', $row1->salesman_code)
                    ->first();

                // ? =================================================================
                /**
                 * ? Don't delete this block for now...
                 */
                // $checkOnTranLine = DB::table('tb_tran_line')
                //     ->where('tran_no', $row1->reference_no)
                //     ->where('itm_code', $row1->itemcode)
                //     ->where('uom', $row1->uom)
                //     ->exists();
                // if($checkOnTranLine == false) {
                //     DB::table('consolidated_transactions')
                //         ->where('reference_no', $row1->reference_no)
                //         ->where('itemcode', $row1->itemcode)
                //         ->where('uom', $row1->uom)
                //         ->update([
                //             'is_manual' => 1
                //         ]);
                // }
                // ? =================================================================

                $item_no_uom = DB::table('item_masterfiles')
                    ->where('itemcode', $row1->itemcode)
                    // ->where('uom', $row1->uom)
                    ->first();
                $checkOnMasterfile = $item_no_uom != null ? true : false;

                $item = DB::table('item_masterfiles')
                    ->where('itemcode', $row1->itemcode)
                    ->where('uom', $row1->uom)
                    ->first();
                $checkOnMasterfile_with_UOM = $item != null ? true : false;

                // if($checkOnTranLine == false) {
                $data_res[] = array(
                    'consolidated_id'               =>  $row1->consolidated_id,
                    // 'product_name'                  =>  $row1->product_name,
                    'product_name'                  =>  $item_no_uom->product_name ?? 'NA',
                    'transaction_type'              =>  $row1->transaction_type,
                    // 'description'                   =>  $row1->description,
                    'description'                   =>  $item_no_uom->description ?? 'NA',
                    'sales_invoice'                 =>  $row1->sales_invoice,
                    'reference_no'                  =>  $row1->reference_no,
                    'posting_date'                  =>  $row1->posting_date,
                    'account_name'                  =>  $res2->account_name ?? 'NA',
                    'customer_code'                 =>  $row1->customer_code,
                    'first_name'                    =>  $res3->first_name ?? 'NA',
                    'last_name'                     =>  $res3->last_name ?? 'NA',
                    'salesman_code'                 =>  $row1->salesman_code,
                    'itemcode'                      =>  $row1->itemcode,
                    'qty'                           =>  $row1->qty,
                    'total_amt'                     =>  $row1->total_amt,
                    // 'product_family'                =>  $row1->product_family,
                    'product_family'                =>  $item_no_uom->product_family ?? 'NA',
                    'keywords'                      =>  $row1->keywords,
                    'uom'                           =>  $row1->uom,
                    'unit_price'                    =>  $row1->unit_price,
                    // 'unit_price'                    =>  $item->list_price_wouttax ?? 'NA',
                    'price_w_vat'                   =>  $row1->price_w_vat,
                    // 'price_w_vat'                   =>  $item->list_price_wtax ?? 'NA',
                    // 'image'                         =>  $row1->image,
                    'image'                         =>  $item_no_uom->image ?? 'NA',
                    // 'sstatus'                       =>  $row1->sstatus,
                    'sstatus'                       =>  $item->status ?? 'NA',
                    'tran_no'                       => $row1->tran_no,
                    // 'present_on_tranline'           => $checkOnTranLine,
                    'present_on_masterfile'             => $checkOnMasterfile,
                    'present_on_masterfile_with_uom'    => $checkOnMasterfile_with_UOM,
                    'date_uploaded'                 => $row1->date_uploaded,
                    'is_manual'                     => $row1->is_manual,
                );
                // }
            }
        }

        $transformedPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $data_res,
            $res1->total(),
            $res1->perPage(),
            $res1->currentPage(),
            [
                'path' => $request->url(),
                'query' => [
                    'page' => $res1->currentPage()
                ]
            ]
        );

        return response()->json($transformedPaginated);
    }

    // kaloy 2022-04-07
    public function consolidated_masterfile_import(Request $request)
    {
        // DB::beginTransaction();
        $date_request = null;

        DB::transaction(function () use ($request, $date_request) {
            $date = Carbon::parse(base64_decode(request()->date))->toDateString();

            // $request->validate([
            //     'import_file1' => 'required|file|mimes:xls,xlsx,csv,txt'
            // ]);

            $files = $request->file('import_file1');

            // loop through uploaded files
            foreach($files as $file) {
                $path = $file->getRealPath();
                // $path = $request->file('import_file1')->getRealPath();
                // kaloy 2022-04-11
                $data = utf8_encode(file_get_contents($path));
    
                // dump($data);
                $data_lines = explode("\r\n", $data);
                $total_lines = count($data_lines);
    
                // kaloy 2022-04-07
                $transactionNumbers = [];
    
                // Iterate through the lines *************************************************
                for ($i = 0; $i < $total_lines; $i++) {
                    if ($data_lines[$i] != NULL) {
                        $powdered = explode("|", $data_lines[$i]);
                        $t_type = trim($powdered[0]);
                        if (strcasecmp($t_type,'invoice')==0 && $t_type[0] != '#') {
                            $inv_no = trim($powdered[1]);

                            $cust_code = trim($powdered[2]);
                            $posting_date = date('Y-m-d', strtotime(trim($powdered[3])));
                            $itemcode = trim($powdered[4]);
                            $qty = trim($powdered[5]);
                            $price = trim($powdered[6]);
                            $total_amt = trim($powdered[7]);
                            $price_w_vat = trim($powdered[8]);
                            $salesman = trim($powdered[9]);
                            $uom = trim($powdered[10]);
                            $ref_no = trim($powdered[11]);
    
                            $transactionNumbers[] = $ref_no;
    
                            $date_request = Carbon::parse($posting_date);
    
                            // kaloy 2021-10-27
                            $currTime = date('H:i:s');
                            $datetime_request = Carbon::parse("$posting_date $currTime");
    
                            // kaloy 2022-05-02
                            $isItemManuallyAdded = DB::table('tb_tran_line')
                                ->where('tran_no', $ref_no)
                                ->where('itm_code', $itemcode)
                                ->where('uom', $uom)
                                ->exists() == false;
    
                            $check1 = DB::table('customer_master_files')
                                ->where('account_code', '=', $cust_code)
                                ->get();
                            // dump($check1);
                            foreach ($check1 as $data1) {
                                $cust_id = $data1->customer_id;
    
                                $check2 = DB::table('tbl_discounts')
                                    ->where('cus_id', '=', $cust_id)
                                    ->get();
    
                                if ($check2->count() > 0) {
                                    foreach ($check2 as $data2) {
                                        $discount = $data2->discount;
                                        $principal_id = $data2->principal_id;
    
                                        $check3 = DB::table('tbl_principals')
                                            ->where('id', '=', $principal_id)
                                            ->get();
    
                                        if ($check3->count() > 0) {
    
                                            foreach ($check3 as $data3) {
                                                $principal_name = $data3->principal_name;
    
                                                $check4 = DB::table('item_masterfiles')
                                                    ->where('principal', '=', $principal_name)
                                                    ->where('itemcode', '=', $itemcode)
                                                    ->where('uom', '=', $uom)
                                                    ->exists();
    
                                                // If it exists in item_masterfiles
                                                if ($check4 === true) {
    
                                                    $check = ConsolidatedTransaction::where(
                                                        'transaction_type',
                                                        '=',
                                                        $t_type
                                                    )
                                                        ->where('sales_invoice', '=', $inv_no)
                                                        ->where('customer_code', '=', $cust_code)
                                                        ->where('posting_date', '=', $posting_date)
                                                        ->where('itemcode', '=', $itemcode)
                                                        ->where('qty', '=', $qty)
                                                        ->where('unit_price', '=', $price)
                                                        ->where('total_amt', '=', $total_amt)
                                                        ->where('price_w_vat', '=', $price_w_vat)
                                                        ->where('salesman_code', '=', $salesman)
                                                        ->where('uom', '=', $uom)
                                                        ->where('reference_no', '=', $ref_no)
                                                        ->exists();
    
                                                    // If it does not exist in consolidated_transactions
                                                    if ($check === false) {
                                                        $consolidate = new ConsolidatedTransaction;
    
                                                        $consolidate->transaction_type = $t_type;
                                                        $consolidate->sales_invoice = $inv_no;
                                                        $consolidate->customer_code = $cust_code;
                                                        $consolidate->posting_date = $posting_date;
                                                        $consolidate->itemcode = $itemcode;
                                                        $consolidate->qty = $qty;
                                                        $consolidate->unit_price = $price;
                                                        $consolidate->total_amt = $total_amt;
                                                        $consolidate->price_w_vat = $price_w_vat;
                                                        $consolidate->salesman_code = $salesman;
                                                        $consolidate->uom = $uom;
                                                        $consolidate->reference_no = $ref_no;
                                                        $consolidate->status = '';
                                                        $consolidate->date_uploaded = $date;
                                                        $consolidate->flag = 0;
                                                        $consolidate->is_manual = $isItemManuallyAdded;
                                                        $consolidate->save();
    
                                                        // $date_request = Carbon:0707221-PAN-00648:parse($posting_date)->toDateString();
                                                        //calculation
                                                        $disct = $discount / 100;
                                                        $discounted_line_amt = $disct * $total_amt;
    
    
                                                        DB::table('tb_tran_head')
                                                            ->where('tran_no', '=', $ref_no)
                                                            // tran_head_date_req
                                                            // ->whereDate('date_req', $date_request)
                                                            // ->update(['tran_stat' => 'Approved', 'date_app' => $date_request, 'date_transit' => $date_request]);
                                                            ->update([
                                                                'tran_stat' => 'Approved',
                                                                'date_app' => $datetime_request,
                                                                'date_transit' => $date_request
                                                            ]);
    
                                                        DB::table('tb_tran_line')
                                                            ->where('tran_no', '=', $ref_no)
                                                            ->where('itm_code', '=', $itemcode)
                                                            ->where('uom', '=', $uom)
                                                            ->update([
                                                                'nav_invoice_no' => $inv_no,
                                                                'del_qty' => $qty,
                                                                'amt' => $price,
                                                                'discount' => $discount,
                                                                'discounted_amount' => $discounted_line_amt,
                                                                'itm_stat' => 'Served',
                                                                'tot_amt' => $total_amt,
                                                                'flag' => 1
                                                            ]);
    
                                                        $check_unserved = DB::table('tb_unserved_items')
                                                            ->where('tran_no', '=', $ref_no)
                                                            ->where('itm_code', '=', $itemcode)
                                                            ->where('uom', '=', $uom)
                                                            ->where('itm_stat', '=', 'Unserved')
                                                            ->delete();
                                                    }
    
                                                    // If it  DOESN'T exists in item_masterfiles
                                                } else {
                                                    $check = ConsolidatedTransaction::where(
                                                        'transaction_type',
                                                        '=',
                                                        $t_type
                                                    )
                                                        ->where('sales_invoice', '=', $inv_no)
                                                        ->where('customer_code', '=', $cust_code)
                                                        ->where('posting_date', '=', $posting_date)
                                                        ->where('itemcode', '=', $itemcode)
                                                        ->where('qty', '=', $qty)
                                                        ->where('unit_price', '=', $price)
                                                        ->where('total_amt', '=', $total_amt)
                                                        ->where('price_w_vat', '=', $price_w_vat)
                                                        ->where('salesman_code', '=', $salesman)
                                                        ->where('uom', '=', $uom)
                                                        ->where('reference_no', '=', $ref_no)
                                                        ->exists();
    
                                                    if ($check === false) {
                                                        $consolidate = new ConsolidatedTransaction;
    
                                                        $consolidate->transaction_type = $t_type;
                                                        $consolidate->sales_invoice = $inv_no;
                                                        $consolidate->customer_code = $cust_code;
                                                        $consolidate->posting_date = $posting_date;
                                                        $consolidate->itemcode = $itemcode;
                                                        $consolidate->qty = $qty;
                                                        $consolidate->unit_price = $price;
                                                        $consolidate->total_amt = $total_amt;
                                                        $consolidate->price_w_vat = $price_w_vat;
                                                        $consolidate->salesman_code = $salesman;
                                                        $consolidate->uom = $uom;
                                                        $consolidate->reference_no = $ref_no;
                                                        $consolidate->status = '';
                                                        $consolidate->date_uploaded = $date;
                                                        $consolidate->flag = 0;
                                                        $consolidate->is_manual = $isItemManuallyAdded;
                                                        $consolidate->save();
    
                                                        // $date_request = Carbon::parse($posting_date)->toDateString();
    
                                                        //calculation
    
                                                        DB::table('tb_tran_head')
                                                            ->where('tran_no', '=', $ref_no)
                                                            // tran_head_date_req
                                                            // ->whereDate('date_req', $date_request)
                                                            // ->update(['tran_stat' => 'Approved', 'date_app' => $date_request, 'date_transit' => $date_request]);
                                                            ->update([
                                                                'tran_stat' => 'Approved',
                                                                'date_app' => $datetime_request,
                                                                'date_transit' => $date_request
                                                            ]);
    
                                                        DB::table('tb_tran_line')
                                                            ->where('tran_no', '=', $ref_no)
                                                            ->where('itm_code', '=', $itemcode)
                                                            ->where('uom', '=', $uom)
                                                            ->update([
                                                                'nav_invoice_no' => $inv_no,
                                                                'del_qty' => $qty,
                                                                'amt' => $price,
                                                                'itm_stat' => 'Served',
                                                                'tot_amt' => $total_amt,
                                                                'flag' => 0
                                                            ]);
    
                                                        $check_unserved = DB::table('tb_unserved_items')
                                                            ->where('tran_no', '=', $ref_no)
                                                            ->where('itm_code', '=', $itemcode)
                                                            ->where('uom', '=', $uom)
                                                            ->where('itm_stat', '=', 'Unserved')
                                                            ->delete();
                                                    }
                                                }
                                            }
                                        } else {
    
                                            $check = ConsolidatedTransaction::where(
                                                'transaction_type',
                                                '=',
                                                $t_type
                                            )
                                                ->where('sales_invoice', '=', $inv_no)
                                                ->where('customer_code', '=', $cust_code)
                                                ->where('posting_date', '=', $posting_date)
                                                ->where('itemcode', '=', $itemcode)
                                                ->where('qty', '=', $qty)
                                                ->where('unit_price', '=', $price)
                                                ->where('total_amt', '=', $total_amt)
                                                ->where('price_w_vat', '=', $price_w_vat)
                                                ->where('salesman_code', '=', $salesman)
                                                ->where('uom', '=', $uom)
                                                ->where('reference_no', '=', $ref_no)
                                                ->exists();
    
                                            if ($check === false) {
                                                $consolidate = new ConsolidatedTransaction;
    
                                                $consolidate->transaction_type = $t_type;
                                                $consolidate->sales_invoice = $inv_no;
                                                $consolidate->customer_code = $cust_code;
                                                $consolidate->posting_date = $posting_date;
                                                $consolidate->itemcode = $itemcode;
                                                $consolidate->qty = $qty;
                                                $consolidate->unit_price = $price;
                                                $consolidate->total_amt = $total_amt;
                                                $consolidate->price_w_vat = $price_w_vat;
                                                $consolidate->salesman_code = $salesman;
                                                $consolidate->uom = $uom;
                                                $consolidate->reference_no = $ref_no;
                                                $consolidate->status = '';
                                                $consolidate->date_uploaded = $date;
                                                $consolidate->flag = 0;
                                                $consolidate->is_manual = $isItemManuallyAdded;
                                                $consolidate->save();
    
                                                // $date_request = Carbon::parse($posting_date)->toDateString();
    
                                                //calculation
    
    
                                                DB::table('tb_tran_head')
                                                    ->where('tran_no', '=', $ref_no)
                                                    // tran_head_date_req
                                                    // ->whereDate('date_req', $date_request)
                                                    // ->update(['tran_stat' => 'Approved', 'date_app' => $date_request, 'date_transit' => $date_request]);
                                                    ->update([
                                                        'tran_stat' => 'Approved',
                                                        'date_app' => $datetime_request,
                                                        'date_transit' => $date_request
                                                    ]);
    
                                                DB::table('tb_tran_line')
                                                    ->where('tran_no', '=', $ref_no)
                                                    ->where('itm_code', '=', $itemcode)
                                                    ->where('uom', '=', $uom)
                                                    ->update([
                                                        'nav_invoice_no' => $inv_no,
                                                        'del_qty' => $qty,
                                                        'amt' => $price,
                                                        'itm_stat' => 'Served',
                                                        'tot_amt' => $total_amt,
                                                        'flag' => 0
                                                    ]);
    
                                                $check_unserved = DB::table('tb_unserved_items')
                                                    ->where('tran_no', '=', $ref_no)
                                                    ->where('itm_code', '=', $itemcode)
                                                    ->where('uom', '=', $uom)
                                                    ->where('itm_stat', '=', 'Unserved')
                                                    ->delete();
                                            }
                                        }
                                    }
                                } else {
    
                                    $check = ConsolidatedTransaction::where(
                                        'transaction_type',
                                        '=',
                                        $t_type
                                    )
                                        ->where('sales_invoice', '=', $inv_no)
                                        ->where('customer_code', '=', $cust_code)
                                        ->where('posting_date', '=', $posting_date)
                                        ->where('itemcode', '=', $itemcode)
                                        ->where('qty', '=', $qty)
                                        ->where('unit_price', '=', $price)
                                        ->where('total_amt', '=', $total_amt)
                                        ->where('price_w_vat', '=', $price_w_vat)
                                        ->where('salesman_code', '=', $salesman)
                                        ->where('uom', '=', $uom)
                                        ->where('reference_no', '=', $ref_no)
                                        ->exists();
    
                                    if ($check === false) {
                                        $consolidate = new ConsolidatedTransaction;
    
                                        $consolidate->transaction_type = $t_type;
                                        $consolidate->sales_invoice = $inv_no;
                                        $consolidate->customer_code = $cust_code;
                                        $consolidate->posting_date = $posting_date;
                                        $consolidate->itemcode = $itemcode;
                                        $consolidate->qty = $qty;
                                        $consolidate->unit_price = $price;
                                        $consolidate->total_amt = $total_amt;
                                        $consolidate->price_w_vat = $price_w_vat;
                                        $consolidate->salesman_code = $salesman;
                                        $consolidate->uom = $uom;
                                        $consolidate->reference_no = $ref_no;
                                        $consolidate->status = '';
                                        $consolidate->date_uploaded = $date;
                                        $consolidate->flag = 0;
                                        $consolidate->is_manual = $isItemManuallyAdded;
                                        $consolidate->save();
    
                                        // $date_request = Carbon::parse($posting_date)->toDateString();
    
                                        //calculation
    
                                        // dd('annyeong!');
    
                                        // 2021-09-28
                                        // "PISTING YAWA HAHAHA"
                                        // -kaloy
    
                                        DB::table('tb_tran_head')
                                            ->where('tran_no', '=', $ref_no)
                                            // tran_head_date_req
                                            // ->whereDate('date_req', $date_request)
                                            // ->update(['tran_stat' => 'Approved', 'date_app' => $date_request, 'date_transit' => $date_request]);
                                            ->update([
                                                'tran_stat' => 'Approved',
                                                'date_app' => $datetime_request,
                                                'date_transit' => $date_request
                                            ]);
    
                                        DB::table('tb_tran_line')
                                            ->where('tran_no', '=', $ref_no)
                                            ->where('itm_code', '=', $itemcode)
                                            ->where('uom', '=', $uom)
                                            ->update([
                                                'nav_invoice_no' => $inv_no,
                                                'del_qty' => $qty,
                                                'amt' => $price,
                                                'itm_stat' => 'Served',
                                                'tot_amt' => $total_amt,
                                                'flag' => 0
                                            ]);
    
                                        $check_unserved = DB::table('tb_unserved_items')
                                            ->where('tran_no', '=', $ref_no)
                                            ->where('itm_code', '=', $itemcode)
                                            ->where('uom', '=', $uom)
                                            ->where('itm_stat', '=', 'Unserved')
                                            ->delete();
                                    }
                                }
    
                                $check5 = DB::table('item_masterfiles')
                                    ->where('itemcode', '=', $itemcode)
                                    ->where('uom', '=', $uom)
                                    // ->where('status', 1)
                                    ->get();
    
                                foreach ($check5 as $data5) {
                                    $check6 = DB::table('tbl_item_discounts')
                                        ->where('item_id', '=', $data5->item_masterfiles_id)
                                        ->get();
    
                                    if ($check6->count() > 0) {
                                        foreach ($check6 as $data6) {
                                            $discountm = $data6->discount;
    
                                            // computation
                                            $total_disct = $discountm * $qty;
                                            $total_amount = $price * $qty;
    
                                            $calc1 = ($total_disct / $total_amount);
                                            $calc = $calc1 * 100;
    
                                            DB::table('tb_tran_head')
                                                ->where('tran_no', '=', $ref_no)
                                                // tran_head_date_req
                                                // ->whereDate('date_req', $date_request)
                                                // ->update(['tran_stat' => 'Approved', 'date_app' => $date_request, 'date_transit' => $date_request]);
                                                ->update([
                                                    'tran_stat' => 'Approved',
                                                    'date_app' => $datetime_request,
                                                    'date_transit' => $date_request
                                                ]);
    
                                            DB::table('tb_tran_line')
                                                ->where('tran_no', '=', $ref_no)
                                                ->where('itm_code', '=', $itemcode)
                                                ->where('uom', '=', $uom)
                                                ->update([
                                                    'nav_invoice_no' => $inv_no,
                                                    'del_qty' => $qty,
                                                    'amt' => $price,
                                                    'tot_amt' => $total_amt,
                                                    'itm_stat' => 'Served',
                                                    'discount' => $calc,
                                                    'discounted_amount' => $total_disct,
                                                    'flag' => 1
                                                ]);
    
                                            $check_unserved = DB::table('tb_unserved_items')
                                                ->where('tran_no', '=', $ref_no)
                                                ->where('itm_code', '=', $itemcode)
                                                ->where('uom', '=', $uom)
                                                ->where('itm_stat', '=', 'Unserved')
                                                ->delete();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                // /Iterate through the lines *************************************************
    
                // _lr
                $transactionNumbers = array_unique($transactionNumbers);
    
                // foreach ($get_tran as $data_tran) {
                foreach ($transactionNumbers as $transactionNumber) {
    
                    $total = 0;
                    $tot_amt = 0;
                    $tot_disct_amt = 0;
    
                    $res = DB::table('tb_tran_line')
                        ->where('tran_no', '=', $transactionNumber)
                        ->where('itm_stat', '!=', '')
                        ->get();
    
                    foreach ($res as $data_res) {
                        $tot_amt += (float) $data_res->tot_amt;
                        $tot_disct_amt += (float) $data_res->discounted_amount;
                    }
    
                    $total = $tot_amt - $tot_disct_amt;
    
                    // dump($tot_amt);
    
                    DB::table('tb_tran_head')
                        ->where('tran_no', '=', $transactionNumber)
                        ->where('tran_stat', '=', 'Approved')
                        // tran_head_date_req
                        // ->whereDate('date_req', $date_request)
                        ->update(['tot_del_amt' => $total]);
    
                    $ress = DB::table('tb_tran_line')
                        ->where('tran_no', '=', $transactionNumber)
                        ->where('tb_tran_line.req_qty', '<>', 'tb_tran_line.del_qty')
                        // ->where('del_qty', '<>', 0)
                        ->get();
    
                    $date_now = Carbon::now();
    
                    if ($ress->count() > 0) {
                        // dd($ress);
    
                        foreach ($ress as $data_ress) {
                            $qty1 = $data_ress->req_qty;
                            $qty2 = $data_ress->del_qty;
                            $amt1 = $data_ress->amt;
                            $tot_qty = $qty1 - $qty2;
    
                            $totall_amt = $tot_qty * $amt1;
    
                            // $total2 = $total - $totall_amt;
    
                            // DB::table('tb_tran_head')
                            //     ->where('tran_no', '=', $data_tran->tran_no)
                            //     ->whereDate('date_req', $date_request)
                            //     ->update(['tot_del_amt' => $total2]);
    
                            if ($data_ress->req_qty > $data_ress->del_qty) {
                                
                                // if del_qty is greater than zero, set status as 'lacking'
                                if($data_ress->del_qty > 0) {
                                    DB::table('tb_tran_line')
                                        ->where('tran_no', '=', $transactionNumber)
                                        ->where('itm_code', '=', $data_ress->itm_code)
                                        ->where('uom', '=', $data_ress->uom)
                                        ->update(['itm_stat' => 'Lacking']);
                                }
    
                                $check_unserved = DB::table('tb_unserved_items')
                                    ->where('tran_no', '=', $data_ress->tran_no)
                                    // ->whereDate('date', '=', $date_now)
                                    ->where('itm_code', '=', $data_ress->itm_code)
                                    // ->where('item_desc', '=', $data_ress->itm_code)
                                    ->where('qty', '=', $tot_qty)
                                    ->where('uom', '=', $data_ress->uom)
                                    // ->where('amt', '=', $data_ress->amt)
                                    // ->where('tot_amt', '=', $totall_amt)
                                    // ->where('itm_cat', '=', $data_ress->itm_cat)
                                    ->where('itm_stat', '=', 'Unserved')
                                    // ->where('flag', '=', 0)
                                    ->exists();
    
                                if ($check_unserved === false) {
                                    DB::table('tb_unserved_items')->insert(
                                        [
                                            'tran_no' => $data_ress->tran_no,
                                            'date' => $date_now,
                                            'itm_code' => $data_ress->itm_code,
                                            'item_desc' => $data_ress->item_desc,
                                            'qty' => $tot_qty,
                                            'uom' => $data_ress->uom,
                                            'amt' => $data_ress->amt,
                                            'tot_amt' => $totall_amt,
                                            'itm_cat' => $data_ress->itm_cat,
                                            'itm_stat' => 'Unserved',
                                            'flag' => 0,
                                        ]
                                    );
                                }
                            } else if ($data_ress->req_qty < $data_ress->del_qty) {
                                // kaloy 2022-03-31
                                // kaloy 2022-07-04
                                // EXCESS QTY *****************************************
                                // DB::table('tb_tran_line')
                                //     ->where('tran_no', '=', $transactionNumber)
                                //     ->where('itm_code', '=', $data_ress->itm_code)
                                //     ->where('uom', '=', $data_ress->uom)
                                //     ->update(['itm_stat' => 'Excess']);
                                
                                // $check_unserved = DB::table('tb_unserved_items')
                                //     ->where('tran_no', '=', $data_ress->tran_no)
                                //     ->where('date', '=', $date_now)
                                //     ->where('itm_code', '=', $data_ress->itm_code)
                                //     ->where('item_desc', '=', $data_ress->itm_code)
                                //     ->where('qty', '=', $tot_qty)
                                //     ->where('uom', '=', $data_ress->uom)
                                //     ->where('amt', '=', $data_ress->amt)
                                //     ->where('tot_amt', '=', $totall_amt)
                                //     ->where('itm_cat', '=', $data_ress->itm_cat)
                                //     ->where('itm_stat', '=', 'Unserved')
                                //     ->where('flag', '=', 0)
                                //     ->exists();
    
                                // if ($check_unserved === false) {
                                //     DB::table('tb_unserved_items')->insert(
                                //         [
                                //             'tran_no' => $data_ress->tran_no,
                                //             'date' => $date_now,
                                //             'itm_code' => $data_ress->itm_code,
                                //             'item_desc' => $data_ress->item_desc,
                                //             'qty' => $tot_qty,
                                //             'uom' => $data_ress->uom,
                                //             'amt' => $data_ress->amt,
                                //             'tot_amt' => $totall_amt,
                                //             'itm_cat' => $data_ress->itm_cat,
                                //             'itm_stat' => 'Unserved',
                                //             'flag' => 0
                                //         ]
                                //     );
                                // }
                                // /EXCESS QTY *****************************************
                                DB::table('tb_tran_line')
                                    ->where('tran_no', '=', $transactionNumber)
                                    ->where('itm_code', '=', $data_ress->itm_code)
                                    ->where('uom', '=', $data_ress->uom)
                                    ->update([
                                        // 'itm_stat' => 'Excess'
                                        'req_qty' => $data_ress->del_qty
                                    ]);
                                    
                                $qtyToAdd = abs($tot_qty);
                                $amtToAdd = abs($totall_amt);
                                DB::table('tb_tran_head')
                                    ->where('tran_no', '=', $transactionNumber)
                                    ->update([
                                        // 'itm_stat' => 'Excess'
                                        'itm_count' => DB::raw("itm_count + $qtyToAdd"),
                                        'tot_amt' => DB::raw("tot_amt + $amtToAdd")
                                    ]);
                            }
                        }
                    }
                }
            }
            // /loop through uploaded files

        });

        // DB::rollBack();


        return response()->json(['message' => 'Uploaded successfully'], 200);
    }


    public function addIsManualItems(Request $request)
    {
        set_time_limit(0);

        $mankey = $request->manager_key;

        if ($mankey == '123') {
            $res = ConsolidatedTransaction::select(
                'consolidated_transactions.*',
                'tb_tran_head.tran_no'
            )
                ->join(
                    'tb_tran_head',
                    'consolidated_transactions.reference_no',
                    '=',
                    'tb_tran_head.tran_no'
                )
                ->where('consolidated_transactions.is_manual', 1)
                ->where('consolidated_transactions.is_manual_appended', 0)
                ->get();

            // dd($res);

            foreach ($res as $item) {
                // dd($item);
                $affected = 0;
                $tempItem = DB::table('item_masterfiles')
                    ->select('description', 'product_family')
                    ->where('itemcode', $item->itemcode)
                    // ->where('uom', $item->uom)
                    ->first();

                // dd($tempItem);

                if ($tempItem != null) {
                    DB::table('tb_tran_line')->insert([
                        'tran_no' => $item->reference_no,
                        'nav_invoice_no' => $item->sales_invoice,
                        'itm_code' => $item->itemcode,
                        'item_desc' => $tempItem->description,
                        'req_qty' => $item->qty,
                        'del_qty' => $item->qty,
                        'uom' => $item->uom,
                        'amt' => $item->unit_price,
                        'discount' => 0.000000000000000000000000000000,
                        'tot_amt' => $item->total_amt,
                        'discounted_amount' => 0.00,
                        'itm_cat' => $tempItem->product_family,
                        'itm_stat' => 'Served',
                        'flag' => 0,
                        'account_code' => $item->customer_code,
                        'date_req' => DB::table('tb_tran_head')
                            ->select('date_req')
                            ->where('tran_no', $item->reference_no)
                            ->first()->date_req,
                        'date_del' => null,
                        'lrate' => 0.00,
                        'rated' => null,
                        'manually_included' => 1,
                    ]);

                    DB::table('tb_tran_head')->where('tran_no', $item->reference_no)
                        ->update([
                            // 'itm_count' => DB::raw('itm_count + '. $item->qty),
                            // 'tot_amt' => DB::raw('tot_amt + '. $item->total_amt),
                            'tot_del_amt' => DB::raw('tot_del_amt + ' . $item->total_amt),
                        ]);

                    DB::table('consolidated_transactions')->where('reference_no', $item->reference_no)
                        ->where('itemcode', $item->itemcode)
                        ->where('uom', $item->uom)
                        ->update(['is_manual_appended' => 1]);

                    $affected += 1;
                }
            }

            $response['success'] = true;
            $response['message'] = 'Done';

            // if($affected > 0) {
            //     $response['success'] = true;
            //     $response['message'] = $affected. ' item/s appended on it\'s respective transaction';
            // } else {
            //     $response['message'] = 'None added';
            // }
            return response()->json($response);
        } else {
            $response['success'] = false;
            $response['message'] = 'Invalid key';
            return response()->json($response);
        }
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
     * @param  \App\ConsolidatedTransaction  $consolidatedTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidatedTransaction $consolidatedTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConsolidatedTransaction  $consolidatedTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsolidatedTransaction $consolidatedTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConsolidatedTransaction  $consolidatedTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidatedTransaction $consolidatedTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConsolidatedTransaction  $consolidatedTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidatedTransaction $consolidatedTransaction)
    {
        //
    }

    // S.I. TEST DATA GENERATION
    // kaloy 2021-11-10
    public function generateSITest(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        $filePath = $request->file('file')->getRealPath();
        $data = file_get_contents($filePath);

        $data_rows = explode("\n", $data);
        $row_count = count($data_rows);

        $formatted_data = '';

        for ($i = 1; $i < $row_count; $i++) {
            if ($data_rows[$i] != NULL) {
                $row_cols = explode(",", $data_rows[$i]);
                $row_cols = str_replace('"', '', $row_cols);

                $is_downloaded = trim($row_cols[0]);
                $trans_no = trim($row_cols[1]);
                $customer_name = trim($row_cols[2]);
                $PO = trim($row_cols[3]);
                $account_code = trim($row_cols[4]);
                $account_name = trim($row_cols[5]);
                $branch_code = trim($row_cols[6]);
                $branch_name = trim($row_cols[7]);
                $user_name = trim($row_cols[8]);
                $user_code = trim($row_cols[9]);
                $user_full_name = trim($row_cols[10]);
                $timestamp = trim($row_cols[11]);
                $product_code = trim($row_cols[12]);
                $product_name = trim($row_cols[13]);
                $product_uom = trim($row_cols[14]);
                $qty_todeliver = trim($row_cols[15]);
                $qty_ordered = trim($row_cols[16]);

                $sample_invoice_num = str_replace('-', '', $trans_no);
                $product_price = DB::table('item_masterfiles')->select('list_price_wtax')
                    ->where('itemcode', $product_code)
                    ->where('uom', $product_uom)
                    ->first('list_price_wtax');
                $product_price = $product_price->list_price_wtax;
                $order_item_total = $qty_todeliver * $product_price;

                try {
                    $timestamp = Carbon::parse($timestamp)->format('m/d/Y');
                } catch (\Throwable $th) {
                }

                $formatted_data .= "Invoice|$sample_invoice_num|$account_code|$timestamp|$product_code|$qty_todeliver|$product_price|$order_item_total|Yes|$user_code|$product_uom|$trans_no" . "\n";
            }
        }

        return $formatted_data;
    }
}
