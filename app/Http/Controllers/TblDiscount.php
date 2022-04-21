<?php

namespace App\Http\Controllers;

use App\ItemMasterfile;
use App\TblItemDiscounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblDiscount extends Controller
{
    public function getItems()
    {

        // $category = base64_decode(request()->category);

        if (request()->category == null) {
            return ItemMasterfile::select('item_masterfiles.*', 'tbl_item_discounts.discount')
                ->leftJoin(
                    'tbl_item_discounts',
                    'tbl_item_discounts.item_id',
                    '=',
                    'item_masterfiles.item_masterfiles_id'
                )
                ->orderBy('id')
                ->paginate(10);
        } else {
            return ItemMasterfile::select('item_masterfiles.*', 'tbl_item_discounts.discount')
                ->join(
                    'tbl_item_discounts',
                    'tbl_item_discounts.item_id',
                    '=',
                    'item_masterfiles.item_masterfiles_id'
                )
                // ->orderBy('id', 'DESC')
                ->orderBy('id')
                ->paginate(10);
        }
    }

    public function searchItems()
    {
        // return ItemMasterfile::where(function ($query) {
        //     $search = request()->name;
        //     $query->where('product_name', 'LIKE', "%$search%")
        //         ->orWhere('itemcode', 'LIKE', "%$search%")
        //         ->orWhere('uom', 'LIKE', "%$search%");
        // })
        //     ->paginate(10);
        $search = request()->name;
        if (!request()->cat) {
            return ItemMasterfile::select('item_masterfiles.*', 'tbl_item_discounts.discount')
                ->leftJoin(
                    'tbl_item_discounts',
                    'tbl_item_discounts.item_id',
                    '=',
                    'item_masterfiles.item_masterfiles_id'
                )
                ->where(function ($query) use ($search) {
                    $query->where('product_name', 'LIKE', "%$search%")
                        ->orWhere('itemcode', 'LIKE', "%$search%")
                        ->orWhere('uom', 'LIKE', "%$search%");
                })
                ->orderBy('id')
                ->paginate(10);
        } else {
            return ItemMasterfile::select('item_masterfiles.*', 'tbl_item_discounts.discount')
                ->join(
                    'tbl_item_discounts',
                    'tbl_item_discounts.item_id',
                    '=',
                    'item_masterfiles.item_masterfiles_id'
                )
                ->where(function ($query) use ($search) {
                    $query->where('product_name', 'LIKE', "%$search%")
                        ->orWhere('itemcode', 'LIKE', "%$search%")
                        ->orWhere('uom', 'LIKE', "%$search%");
                })
                ->orderBy('id')
                ->paginate(10);
        }
    }

    public function postDiscount()
    {
        $value = request()->val;
        $id = request()->id;
        // $result = TblItemDiscounts::find(request()->id)->update(['account_credit_limit' => $value]);
        $result =  TblItemDiscounts::where(['item_id' => $id])->exists();
        if ($result) {
            $res = TblItemDiscounts::where(['item_id' => $id])->update(['discount' => $value]);
            if ($res) {
                return 'Update success!';
            } else {
                return 'Errror';
            }
        } else {
            $res = TblItemDiscounts::create(['item_id' => $id, 'discount' => $value]);
            if ($res) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }
}
