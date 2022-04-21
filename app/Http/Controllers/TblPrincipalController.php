<?php

namespace App\Http\Controllers;

use App\TblDiscount;
use App\TblPrincipal;
use Illuminate\Http\Request;

class TblPrincipalController extends Controller
{
    public function get_supplier()
    {
        return TblPrincipal::paginate(10);
    }
    public function create_supplier(Request $request)
    {
        // DB::beginTransaction();

        if ($request->contract_under_via_receipt == null) {
            $receipt = ' ';
        } else {
            $receipt = $request->contract_under_via_receipt;
        }
        if ($request->contract_under_via_doc == null) {
            $doc = ' ';
        } else {
            $doc = $request->contract_under_via_doc;
        }

        if ($request->id != '') {
            $this->validate($request, [
                'principal_name' => 'required',
                // 'via_doc' => 'required',
                // 'via_receipt' => 'required',
                'distributor' => 'required'
            ]);

            $result = TblPrincipal::where('id', $request->id)->update([
                'principal_name' => $request->principal_name,
                'contract_under_via_doc' => $doc,
                'contract_under_via_receipt' => $receipt,
                'distributor' => $request->distributor
            ]);

            if ($result) {
                return 'Update Successful';
            } else {
                return 'Error';
            }
        } else {
            $this->validate($request, [
                'principal_name' => 'required|unique:tbl_principals',
                // 'via_doc' => 'required',
                // 'via_receipt' => 'required',
                'distributor' => 'required'
            ]);

            $result = TblPrincipal::create([
                'principal_name' => $request->principal_name,
                'contract_under_via_doc' => $doc,
                'contract_under_via_receipt' => $receipt,
                'distributor' => $request->distributor
            ]);
            if ($result) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
        // DB::rollBack();
    }

    public function get_supplier2()
    {
        $customer_id = request()->cus_id;
        return TblPrincipal::selectRaw('DISTINCT(principal_id), tbl_discounts.cus_id, tbl_principals.id, principal_name, contract_under_via_doc, contract_under_via_receipt, tbl_discounts.discount')
            ->leftJoin('tbl_discounts', 'tbl_discounts.principal_id', '=', 'tbl_principals.id')
            // ->leftJoin('tbl_discounts', 'tbl_discounts.cus_id', '=', 'customer_master_files.customer_id')
            // ->leftJoin('tbl_discounts', 'tbl_discounts.cus_id', '=', 'customer_master_files.customer_id')
            // ->leftJoin('customer_master_files', 'customer_master_files.customer_id', '=', 'tbl_discounts', 'tbl_discounts.cus_id')
            ->get()->groupBy('principal_name');
    }

    public function searchSupplier()
    {
        $search = request()->name;
        // $query =  TblPrincipal::where('principal_name', 'LIKE', "%$search%")->paginate(10);
        $dis = request()->distributor;
        if ($dis) {
            return TblPrincipal::select(
                'tbl_principals.id',
                'principal_name',
                'contract_under_via_doc',
                'contract_under_via_receipt',
                'distributor',
                'status',
                'tbl_principals.created_at',
                'tbl_principals.updated_at',
                // 'discount'
            )
                // ->leftJoin('tbl_discounts', 'tbl_discounts.principal', '=', 'tbl_principals.id')
                ->where([['distributor', 'LIKE', "%$dis%"], ['principal_name', 'LIKE', "%$search%"]])
                ->paginate(10);
        } else {
            return TblPrincipal::select(
                'tbl_principals.id',
                'principal_name',
                'contract_under_via_doc',
                'contract_under_via_receipt',
                'distributor',
                'status',
                'tbl_principals.created_at',
                'tbl_principals.updated_at',
                // 'discount'
            )
                // ->leftJoin('tbl_discounts', 'tbl_discounts.principal', '=', 'tbl_principals.id')
                ->where('principal_name', 'LIKE', "%$search%")
                ->paginate(10);
        }
    }

    public function toggleSupplier(Request $request)
    {
        $res = TblPrincipal::where(['id' => $request->id, 'status' => $request->status])->exists();
        if ($res > 0) {
            return 'Error';
        } else {
            $res2 = TblPrincipal::where('id', $request->id)->update([
                'status' => $request->status,
            ]);
            if ($res2) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function searchDis()
    {
        $dis = request()->distributor;
        return TblPrincipal::where('distributor', 'LIKE', "%$dis%")->paginate(10);
    }

    public function postDiscount()
    {
        // dd(request()->all());
        $value = request()->val;
        $res = TblDiscount::where(['cus_id' => request()->cus_id, 'principal' => request()->id])->exists();
        if ($res > 0) {
            $result2 = TblDiscount::where(['cus_id' => request()->cus_id, 'principal' => request()->id])->update(['discount' => $value]);
            if ($result2) {
                return 'Update success';
            } else {
                return 'Error2';
            }
        } else {
            $result = TblDiscount::create(['cus_id' => request()->cus_id, 'principal' => request()->id, 'discount' => $value]);
            if ($result) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }
}
