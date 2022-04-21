<?php

namespace App\Http\Controllers;

use App\TblViewingUser;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ViewingUsersController extends Controller
{
    public function getviewingUsers()
    {
        // dd(request()->all());
        return TblViewingUser::paginate(10);
    }

    public function toggleStatus()
    {
        $res = TblViewingUser::where(['id' => request()->id, 'status' => request()->status])->exists();
        if ($res > 0) {
            return 'Error';
        } else {
            $res2 = TblViewingUser::where('id', request()->id)->update([
                'status' => request()->status,
            ]);
            if ($res2) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function newViewingUser(Request $request)
    {
        // dd(request()->all());
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
                'user_code' => 'required',
                'assigned_warehouse' => 'required'
            ]);
            $res = TblViewingUser::where('id', $request->id)->update([
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
                'area' => 'required|string',
                'district' => 'required|string',
                'title' => 'required|string',
                'product_line' => 'required|string',
                'address' => 'required|string',
                'postal_code' => 'required|string',
                'email' => 'required|string|unique:salesman_lists',
                // 'telephone' => 'required|string',
                'mobile' => 'required',
                'user_code' => 'required|string',
                'assigned_warehouse' => 'required|string'
            ]);
            // DB::beginTransaction();
            $res = TblViewingUser::create([
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
                'assigned_warehouse' => $request->assigned_warehouse,
                'status' => '1'
            ]);

            if ($res) {
                return 'New User Added';
            } else {
                return 'Error!';
            }
            // DB::commit();
        }
    }

    public function getMaxCode(Request $request)
    {
        $user_code = $request->user_code;
        if ($user_code) {

            $max = TblViewingUser::where('user_code', 'like', "$user_code%")->max('user_code');
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
                $code = (int) $code[1] + 1;
                // dd($code);

                $max = "$division-$const$code";
            }
            return response()->json(['user_code' => $max]);
        }
    }
}
