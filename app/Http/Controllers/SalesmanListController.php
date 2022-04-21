<?php

namespace App\Http\Controllers;

use \PDF;
use App\CustomerMasterFile;
use App\HepeDeViaje;
use App\SalesmanList;
use App\TblCustomerSalesman;
use App\TblHepeSalesman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SalesmanListController extends Controller
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

    public function forPrint()
    {
        $data = $this->data();
        // dd($data);
        set_time_limit(300);
        $pdf = PDF::loadView('reports.salesman_masterfile', ['datas' => $data]);
        return $pdf->download('Salesman Masterfile.pdf');
    }

    public function data()
    {
        $result = SalesmanList::all();

        $data = [];
        foreach ($result as $row) {
            $data[] = array(
                'username'      => $row->username,
                'password'      => $row->password,
                'first_name'    => $row->first_name,
                'last_name'     => $row->last_name,
                'department'    => $row->department,
                'division'      => $row->division,
                'area'          => $row->area,
                'district'      => $row->district,
                'title'         => $row->title,
                'product_line'  => $row->product_line,
                'address'       => $row->address,
                'postal_code'   => $row->postal_code,
                'email'         => $row->email,
                'telephone'     => $row->telephone,
                'mobile'        => $row->mobile,
                'user_code'     => $row->user_code,
                'status'        => $row->status
            );
        }
        return $data;
    }

    public function create(Request $request)
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
                // 'email' => 'required',
                'telephone' => 'required',
                'mobile' => 'required',
                'user_code' => 'required'
            ]);
            $res = SalesmanList::where('id', $request->id)->update([
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
                'user_code' => $request->user_code
            ]);
            if ($res) {
                return 'Update Successful';
            } else {
                return 'Error updating!';
            }
        } else {
            $this->validate($request, [
                'username' => 'required|string|unique:salesman_lists',
                'password' => 'required|string|min:6',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'department' => 'required|string',
                'division' => 'required|string',
                // 'area' => 'required|string',
                'district' => 'required|string',
                'title' => 'required|string',
                'product_line' => 'required|string',
                'address' => 'required|string',
                'postal_code' => 'required|string',
                // 'email' => 'required|string|unique:salesman_lists',
                // 'telephone' => 'required|string',
                'mobile' => 'required',
                'user_code' => 'required|string'
            ]);

            $res = SalesmanList::create([
                'username' => $request->username,
                'password' => md5($request->password),
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
                'password_date' => Carbon::now(),
                'status' => '1'
            ]);

            $res2 = TblHepeSalesman::create([
                'salesman_code' => $request->user_code,
                'hepe_code' => 'null'
            ]);

            if ($res && $res2) {
                return 'Success';
            } else {
                return 'Error!';
            }
        }
    }

    public function activate(Request $request)
    {
        // dd($request->all());
        $res = SalesmanList::where(['id' => $request->id, 'status' => $request->status])->exists();
        if ($res > 0) {
            return 'Error';
        } else {
            $res2 = SalesmanList::where('id', $request->id)->update(['status' => $request->status]);
            if ($res2) {
                return 'Success';
            } else {
                return 'Error2';
            }
        }
    }

    public function getSalesmanCustomerList(Request $request)
    {
        // dd($request->all());
        // return DB::table('tbl_customer_salesman')
        //     ->join('customer_master_files', 'tbl_customer_salesman.cus_customer_code', '=', 'customer_master_files.account_code')
        //     ->where(['tbl_customer_salesman.salesman_code' => $request->usercode, 'tbl_customer_salesman.status' => 1])
        //     ->paginate(10);

        return CustomerMasterFile::where('salesman_code', $request->usercode)->orderBy('address3')->paginate(10);
    }

    public function getAssignSalesmanCustomerList()
    {
        // return CustomerMasterFile::selectRaw('customer_master_files.*')
        //     ->whereNotIn('account_code', SalesmanList::leftJoin('tbl_customer_salesman', 'tbl_customer_salesman.salesman_code', 'salesman_lists.user_code')
        //         ->where('tbl_customer_salesman.salesman_code', request()->usercode)
        //         ->pluck('cus_customer_code'))->paginate(10);

        return CustomerMasterFile::where('salesman_code', '!=', request()->usercode)->paginate(10);
    }

    public function searchAssignSalesmanCustomerList()
    {
        $search = request()->name;
        $address = request()->address;

        // $query = CustomerMasterFile::selectRaw('customer_master_files.*')
        //     ->whereNotIn('account_code', SalesmanList::leftJoin('tbl_customer_salesman', 'tbl_customer_salesman.salesman_code', 'salesman_lists.user_code')
        //         ->where('tbl_customer_salesman.salesman_code', request()->usercode)
        //         ->pluck('cus_customer_code'));

        // if ($search !== 'null') $query = $query->where('customer_master_files.account_name', 'LIKE', "%$search%");
        // if ($address !== 'null') $query = $query->where('customer_master_files.address3', 'LIKE', "%$address%");

        // $query = $query->paginate(10);
        // return $query;

        $query =  CustomerMasterFile::where([
            ['salesman_code', '!=', request()->usercode],
            ['status',  1]
        ]);

        if ($search !== 'null') $query = $query->where('account_name', 'LIKE', "%$search%");
        if ($address !== 'null') $query = $query->where('address3', 'LIKE', "%$address%");

        $query = $query->paginate(10);
        return $query;
    }

    public function getSalesman()
    {
        return SalesmanList::all();
    }

    public function tagCustomertoSalesman(Request $request)
    {
        // dd(request()->all());
        // foreach ($request->account_code as $key => $id) {
        //     $validate = TblCustomerSalesman::where(['cus_customer_code' => $id, 'salesman_code' => $request->user_code])->exists();

        //     if ($validate > 0) {
        //         // return response()->json(['message' => 'Customer already exists']);
        //         $result = TblCustomerSalesman::where(['cus_customer_code' => $id, 'salesman_code' => $request->user_code])->update([
        //             'status' => $request->status
        //         ]);
        //     } else {
        //         $result = TblCustomerSalesman::insert([
        //             'cus_customer_code' => $id,
        //             'salesman_code' => $request->user_code,
        //             'status' => $request->status,
        //             'created_at' => now()
        //         ]);
        //     }
        // }
        // if ($result) {
        //     return response()->json(['message' => 'Success']);
        // }

        // return response()->json(['message' => 'Error']);

        foreach ($request->account_code as $key => $id) {

            $result = CustomerMasterFile::where('account_code', $id)->update([
                'salesman_code' => $request->user_code,
                'status' => $request->status
            ]);
        }

        if ($result) {
            return response()->json(['message' => 'Success']);
        }

        return response()->json(['message' => 'Error']);
    }

    public function searchSalesmanCustomerList(Request $request)
    {
        $search = request()->name;
        // return DB::table('tbl_customer_salesman')->join('customer_master_files', 'tbl_customer_salesman.cus_customer_code', '=', 'customer_master_files.account_code')
        //     ->where([
        //         ['tbl_customer_salesman.salesman_code', $request->usercode],
        //         ['customer_master_files.account_name', 'LIKE', "%$search%"],
        //         ['tbl_customer_salesman.status', 1]
        //     ])->paginate(10);

        return CustomerMasterFile::where([
            ['salesman_code', $request->usercode],
            ['account_name', 'LIKE', "%$search%"],
            ['status', 1]
        ])->paginate(10);
    }

    public function getMaxCode(Request $request)
    {
        $user_code = $request->user_code;

        $max = SalesmanList::where('user_code', 'like', "$user_code%")->max('user_code');

        if (!$max) {
            $max = "$user_code-S01";
        } else {
            $value = explode('-', $max);

            $division = $value[0];

            $code = $value[1];

            $code = str_split($code);

            // $const = "$code[0]$code[1]";
            $const = "$code[0]";

            // $code = array_slice($code, 2);

            // $code = (int) implode('', $code) + 1;

            $code = $code[1] + 1;

            $max = "$division-$const$code";
        }

        return response()->json(['user_code' => $max]);
    }

    public function changePword(Request $request)
    {
        // $test = Hash::check($request->old_password, $request->password);
        $this->validate($request, [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'new_password2' => 'required|min:6'
        ]);

        if (Hash::check($request->old_password, $request->password)) {
            if (($request->new_password2 === $request->new_password)) {
                $result = SalesmanList::where('id', $request->id)->update(['password' => Hash::make($request->new_password)]);
                if ($result) {
                    return ['status' => 'Update Successful!', 'value' => Hash::make($request->new_password)];
                } else {
                    return 'Error';
                }
            }
            return 'New password does not match!';
        }

        return 'Password does not match!';
    }

    public function getMunicipality()
    {
        $results = DB::select('select * from tbl_municipality_masterfile ');
        return $results;
    }

    public function untagCustomertoSalesman()
    {
        // dd(request()->all());
        // $result = TblCustomerSalesman::where([
        //     'cus_customer_code' => request()->account_code,
        //     'salesman_code' => request()->code
        // ])->delete();

        $result =  CustomerMasterFile::where([
            'account_code' => request()->account_code,
            'salesman_code' => request()->code
        ])->update(['salesman_code' => '']);

        if ($result) {
            return 'Success';
        }
        return 'Error';
    }

    public function getAddress()
    {
        $address = request()->address;
        return CustomerMasterFile::selectRaw('DISTINCT(address3)')->where('address3', 'LIKE', "%$address%")->get();
    }
}
