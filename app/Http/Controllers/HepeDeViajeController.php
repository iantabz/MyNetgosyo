<?php

namespace App\Http\Controllers;

use App\HepeDeViaje;
use App\TblHepeSalesman;
use App\TblHepeSalesmanLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HepeDeViajeController extends Controller
{
    public function create_hepe(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'department' => 'required',
                'division' => 'required',
                'title' => 'required',
                'product_line' => 'required',
                'address' => 'required',
                'postal_code' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'mobile' => 'required',
                'user_code' => 'required'
            ]);
            $res = HepeDeViaje::where('id', $request->id)->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'division' => $request->division,
                'area' => $request->area,
                'district' => $request->district,
                'title' => $request->title,
                'product_line' => $request->product_line,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'user_code' => $request->user_code,
                'assigned_warehouse' => 'null'
            ]);
            if ($res) {
                return 'Update Successful';
            } else {
                return 'Error updating!';
            }
        } else {
            $this->validate($request, [
                'username' => 'required|string|unique:tbl_hepe_de_viaje',
                'password' => 'required|string|min:6',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'department' => 'required|string',
                'division' => 'required|string',
                'area' => 'required|string',
                'district' => 'required|string',
                'title' => 'required|string',
                'product_line' => 'required|string',
                'address' => 'required|string',
                'postal_code' => 'required|string',
                'email' => 'required|string|unique:tbl_hepe_de_viaje',
                // 'telephone' => 'required|string',
                'mobile' => 'required',
                'user_code' => 'required|string'
            ]);

            $res = HepeDeViaje::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'division' => $request->division,
                'area' => $request->area,
                'district' => $request->district,
                'title' => $request->title,
                'product_line' => $request->product_line,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'mobile' => $request->mobile,
                'user_code' => $request->user_code,
                'assigned_warehouse' => 'null',
                'status' => '1'
            ]);

            if ($res) {
                return 'Success';
            } else {
                return 'Error!';
            }
        }
    }
    public function get_hepe()
    {
        return HepeDeViaje::select(
            'tbl_hepe_de_viaje.id',
            'username',
            'password',
            'first_name',
            'last_name',
            'department',
            'division',
            'area',
            'district',
            'title',
            'product_line',
            'address',
            'postal_code',
            'email',
            'telephone',
            'mobile',
            'user_code',
            'assigned_warehouse',
            'status',
            'tbl_municipality_masterfile.mun_name as mun_name',
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_hepe_de_viaje.address')
            ->orderBy('id', 'ASC')
            ->paginate(8);
    }

    public function search_hepe()
    {
        $search = request()->name;
        return HepeDeViaje::select(
            'tbl_hepe_de_viaje.id',
            'username',
            'password',
            'first_name',
            'last_name',
            'department',
            'division',
            'area',
            'district',
            'title',
            'product_line',
            'address',
            'postal_code',
            'email',
            'telephone',
            'mobile',
            'user_code',
            'assigned_warehouse',
            'status',
            'tbl_municipality_masterfile.mun_name as mun_name'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_hepe_de_viaje.address')
            ->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%")->orWhere('user_code', 'LIKE', "%$search%")
            ->paginate(10);
    }

    public function getAssignHepeSalesmanList(Request $request)
    {
        $x = DB::table('tbl_hepe_salesman')
            ->join('salesman_lists', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_lists.user_code')
            ->where('tbl_hepe_salesman.hepe_code', $request->usercode)->pluck('salesman_code');

        return DB::table('tbl_hepe_salesman')
            ->join('salesman_lists', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_lists.user_code')
            ->where('tbl_hepe_salesman.hepe_code', '!=', $request->usercode)
            // ->orWhere('tbl_hepe_salesman.hepe_code', null)
            ->whereNotIn('salesman_code', $x)
            ->paginate(10);
    }

    public function searchAssignSalesmanCustomerList(Request $request)

    {
        $search = request()->name;
        return DB::table('tbl_hepe_salesman')
            ->join('salesman_lists', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_lists.user_code')
            ->where([['tbl_hepe_salesman.hepe_code', '!=', $request->usercode], ['salesman_lists.first_name', 'LIKE', "%$search%"]])
            ->orWhere([['tbl_hepe_salesman.hepe_code', '!=', $request->usercode], ['salesman_lists.last_name', 'LIKE', "%$search%"]])
            ->orWhere([['tbl_hepe_salesman.hepe_code', null], ['salesman_lists.first_name', 'LIKE', "%$search%"]])
            ->orWhere([['tbl_hepe_salesman.hepe_code', null], ['salesman_lists.last_name', 'LIKE', "%$search%"]])
            ->paginate(10);
    }

    public function getHepeSalesmanList(Request $request)
    {
        return DB::table('tbl_hepe_salesman')
            ->join('salesman_lists', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_lists.user_code')
            ->where('tbl_hepe_salesman.hepe_code', $request->usercode)->paginate(10);
    }

    public function searchHepeSalesmanList(Request $request)
    {
        $search = request()->name;
        return DB::table('tbl_hepe_salesman')
            ->join('salesman_lists', 'tbl_hepe_salesman.salesman_code', '=', 'salesman_lists.user_code')
            ->where([['tbl_hepe_salesman.hepe_code', $request->usercode], ['salesman_lists.first_name', 'LIKE', "%$search%"]])
            ->orWhere([['tbl_hepe_salesman.hepe_code', $request->usercode], ['salesman_lists.last_name', 'LIKE', "%$search%"]])
            ->paginate(10);
    }

    public function tagSalesmanToHepe(Request $request)
    {
        $validate = TblHepeSalesman::where(['salesman_code' => $request->user_code, 'hepe_code' => $request->usercode])->exists();

        if ($validate > 0) {
            return 'Already exists!';
        } else {
            // $result = TblHepeSalesman::where(['salesman_code' => $request->user_code])->update(['hepe_code' => $request->usercode, 'status' => $request->status]);
            $result = TblHepeSalesman::insert([
                'salesman_code' => $request->user_code,
                'hepe_code' => $request->usercode,
                'status' => $request->status,
                'created_at' => now()
            ]);

            TblHepeSalesmanLogs::create(
                [
                    'salesman_code' => $request->user_code,
                    'hepe_code' => $request->usercode
                ]
            );
            if ($result) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function activate_hepe(Request $request)
    {
        $res = HepeDeViaje::where(['id' => $request->id, 'status' => $request->status])->exists();
        if ($res > 0) {
            return 'Error';
        } else {
            $res2 = HepeDeViaje::where('id', $request->id)->update(['status' => $request->status]);
            if ($res2) {
                return 'Success';
            } else {
                return 'Error2';
            }
        }
    }

    public function getSalesmanLogs()
    {
        // dd(request()->all());
        return TblHepeSalesmanLogs::where('salesman_code', '=', request()->usercode)->paginate(10);
    }
}
