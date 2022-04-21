<?php

namespace App\Http\Controllers;

use App\TblSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblSupplierController extends Controller
{
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

            $result = TblSupplier::where('id', $request->id)->update([
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
                'principal_name' => 'required|unique:tbl_suppliers',
                // 'via_doc' => 'required',
                // 'via_receipt' => 'required',
                'distributor' => 'required'
            ]);

            $result = TblSupplier::create([
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

    public function get_supplier()
    {
        return TblSupplier::paginate(10);
    }

    public function searchSupplier()
    {
        $search = request()->name;
        // $query =  TblSupplier::where('principal_name', 'LIKE', "%$search%")->paginate(10);
        $dis = request()->distributor;
        if ($dis) {
            return TblSupplier::where([['distributor', 'LIKE', "%$dis%"], ['principal_name', 'LIKE', "%$search%"]])->paginate(10);
        } else {
            return TblSupplier::where('principal_name', 'LIKE', "%$search%")->paginate(10);
        }
    }

    public function toggleSupplier(Request $request)
    {
        $res = TblSupplier::where(['id' => $request->id, 'status' => $request->status])->exists();
        if ($res > 0) {
            return 'Error';
        } else {
            $res2 = TblSupplier::where('id', $request->id)->update([
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
        return TblSupplier::where('distributor', 'LIKE', "%$dis%")->paginate(10);
    }
}
