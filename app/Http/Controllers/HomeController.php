<?php

namespace App\Http\Controllers;

use App\CustomerRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {

        $new_requests = CustomerRequest::select(
            'tbl_customer_request.id',
            'store_name',
            'dti_no',
            'owner_name',
            'mobile_number',
            'street_add',
            'landmark',
            'tbl_customer_request.bar_code as bar_code',
            'tbl_customer_request.mun_code as mun_code',
            'tbl_municipality_masterfile.mun_name as mun_name',
            'tbl_barangay_masterfile.bar_name as bar_name',
            'tbl_municipality_masterfile.mun_code as mun_code2',
            'tbl_barangay_masterfile.bar_code as bar_code2',
            'district',
            'province',
            'coordinates',
            'store_photo',
            'status',
            'date_req',
            'remarks',
            'approved_by',
            'users.name as name',
            'date_app'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->join('users', 'users.name', '=', 'users.name')
            ->where('status', '=', 'Pending')
            ->count();

        return view('main_page.index', compact('new_requests'));

        // return view('main_page.index');
    }

    public function getAllUsers()
    {
    }

    public function getAllUsersAcct()
    {
        $res1 = DB::table('users')->get();
        foreach ($res1 as $row1) {
            $users1[] = array(
                'name'              =>  $row1->name,
                'type'              =>  $row1->type,
                'status'            =>  1,
                'username'            =>  $row1->username,
                'email'            =>  $row1->email,
            );
        }
        return response()->json($users1);
    }

    public function searchUserAcct()
    {
        $search = request()->name;
        // return ItemMasterfile::where('product_name', 'LIKE', "%$search%")->paginate(10);
    }

    public function searchUser()
    {
        $search = request()->name;
        // return ItemMasterfile::where('product_name', 'LIKE', "%$search%")->paginate(10);
    }

    public function getAdmins()
    {
        $res1 = DB::table('users')->get();
        foreach ($res1 as $row1) {
            $users1[] = array(
                'name'              =>  $row1->name,
                'type'              =>  $row1->type,
                'status'            =>  1
            );
        }
        return response()->json($users1);
    }

    public function searchAdmin()
    {
        $search = request()->name;
    }

    public function getHepedeViaje()
    {
        $res2 = DB::table('tbl_hepe_de_viaje')->get();
        foreach ($res2 as $row2) {
            $users2[] = array(
                'name'              =>  $row2->first_name . ' ' . $row2->last_name,
                'type'              =>  $row2->title,
                'status'            =>  $row2->status
            );
        }
        return response()->json($users2);
    }

    public function searchHepedeViaje()
    {
        $search = request()->name;
    }

    public function getSalesmans()
    {
        $res4 = DB::table('salesman_lists')->get();
        foreach ($res4 as $row4) {
            $users4[] = array(
                'name'              =>  $row4->first_name . ' ' . $row4->last_name,
                'type'              =>  'Salesman',
                'status'            =>  $row4->status
            );
        }
        return response()->json($users4);
    }

    public function searchSalesman()
    {
        $search = request()->name;
    }

    public function getCustomers()
    {
        return DB::table('customer_master_files')->paginate(5);
        // foreach ($res3 as $row3) {
        //     $users3[] = array(
        //         'name'              =>  $row3->account_name,
        //         'type'              =>  'Customer',
        //         'status'            =>  $row3->status
        //     );
        // }
    }

    public function searchCustomer()
    {
        $search = request()->name;
        return DB::table('customer_master_files')->where('account_name', 'LIKE', "%$search%")->paginate(5);
    }

    public function getMonth()
    {
        $month[] = array(
            'January'       =>  '01',
            'February'      =>  '02',
            'March'         =>  '03',
            'April'         =>  '04',
            'May'           =>  '05',
            'June'          =>  '06',
            'July'          =>  '07',
            'August'        =>  '08',
            'September'     =>  '09',
            'October'       =>  '10',
            'November'      =>  '11',
            'December'      =>  '12'
        );

        return response()->json($month);
    }

    public function getYear()
    {
        $year[] = array(
            '2019'      =>  '2019',
            '2020'      =>  '2020',
            '2021'      =>  '2021'
        );

        return response()->json($year);
    }

    public function store(Request $request)
    {
        $res = '';

        if ($request->name === '') {
            $res = 'blank';
        } else if ($request->username === '') {
            $res = 'blank';
        } else if ($request->password === '') {
            $res = 'blank';
        } else if ($request->cpassword === '') {
            $res = 'blank';
        } else if ($request->type === '') {
            $res = 'blank';
        } else if ($request->password != $request->cpassword) {
            $res = 'not match';
        } else {
            $check = User::where('name', '=', $request->name)
                ->where('email', '=', $request->email)
                ->where('username', '=', $request->username)
                ->where('password', '=', $request->password)
                ->where('type', '=', $request->type)
                ->get();

            if ($check->count() === 0) {

                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'type' => $request->type
                ]);
            } else {
                $res = 'exists';
            }
        }

        if ($res === 'blank') {
            return 'Error';
        } else if ($res === 'not match') {
            return 'Unmatched';
        } else if ($res === 'exists') {
            return 'Exists';
        } else {
            return 'Success';
        }
    }

    public function getAuthUser()
    {
        return Auth::user();
    }


    // kaloy 2022-05-27
    public function changePassword(Request $request) {
        $this->validate($request, [
            'username' => ['required','exists:users,username'],
            'old_password' => function($attribute,$value,$fail) use($request) {
                $old_password_hashed = DB::table('users')
                    ->where('username', $request->username)
                    ->first()->password;
                if(! Hash::check($value, $old_password_hashed)) {
                    $fail('Incorrect password');
                }
            },
            'new_password' => ['required','min:5','confirmed'],
        ]);

        try {
            DB::table('users')->where('username',$request->username)
                ->update([
                    'password' => Hash::make($request->new_password)
                ]);
            
            $res['success']=true;
            $res['message']='Password updated';
            return response()->json($res);
        } catch (\Throwable $th) {
            $res['success']=false;
            $res['message']=$th->getMessage();
            return response()->json($res, 500);
        }
    }
}
