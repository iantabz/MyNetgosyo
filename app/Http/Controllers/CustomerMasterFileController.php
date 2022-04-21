<?php

namespace App\Http\Controllers;

use \PDF;
use App\AccountGroupCode;
use App\CustomerMasterFile;

use App\Imports\CustomerImport2;
use App\Imports\CustomerImport;
use App\SalesmanList;
use App\TblDiscount;
use App\TblPrincipal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerMasterFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }
    public function forPrint()
    {

        $files = array('readme.txt', 'test.html', 'image.gif');
        $zipname = 'file.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file);
        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);


        // $x = $this->data()->limit(500)->get()->chunk(100);


        // $pdfs = [];
        // foreach ($x as $c) {
        //     foreach ($c as $r) {
        //         $c[] = array(
        //             'account_name'                          => $r->account_name,
        //             'account_group_name'                    => $r->account_group_name,
        //             'account_classification_id'             => $r->account_classification_id,
        //             'account_description'                   => $r->account_description,
        //             'account_group_code'                    => $r->account_group_code,
        //             'account_code'                          => $r->account_code,
        //             'account_code2'                         => $r->account_code2,
        //             'account_code3'                         => $r->account_code3,
        //             'location_group_code'                   => $r->location_group_code,
        //             'location_name'                         => $r->location_name,
        //             'location_code'                         => $r->location_code,
        //             'address1'                              => $r->address1,
        //             'address2'                              => $r->address2,
        //             'address3'                              => $r->address3,
        //             'address4'                              => $r->address4,
        //             'address5'                              => $r->address5,
        //             'postal_address'                        => $r->postal_address,
        //             'longitude'                             => $r->longitude,
        //             'latitude'                              => $r->latitude,
        //             'account_credit_limit'                  => $r->account_credit_limit,
        //             'pricing_scheme_code'                   => $r->pricing_scheme_code,
        //             'payment_type'                          => $r->payment_type,
        //             'number_of_days_credit'                 => $r->number_of_days_credit,
        //             'branch_code'                           => $r->branch_code,
        //             'branch_name'                           => $r->branch_name,
        //             'branch_description'                    => $r->branch_description,
        //             'branch_source_warehouse_code'          => $r->branch_source_warehouse_code,
        //             'branch_order_delivery_lead_time'       => $r->branch_order_delivery_lead_time,
        //             'status'                                => $r->status
        //         );
        //         $pdfs[] = PDF::loadView('reports.customer_masterfile', ['datas' => $c]);
        //     }
        // }
        // foreach ($pdfs as $key => $pdf) {
        //     $pdf->download("Salesman Masterfile-$key.pdf");
        // }



        // return $pdfs;

        // dd($data);
        // $c = [];
        // foreach ($data as $row) {
        //     foreach ($row as $row2) {
        //         $c[] = array(
        //             'account_name'                          => $row2->account_name,
        //             'account_group_name'                    => $row2->account_group_name,
        //             'account_classification_id'             => $row2->account_classification_id,
        //             'account_description'                   => $row2->account_description,
        //             'account_group_code'                    => $row2->account_group_code,
        //             'account_code'                          => $row2->account_code,
        //             'account_code2'                         => $row2->account_code2,
        //             'account_code3'                         => $row2->account_code3,
        //             'location_group_code'                   => $row2->location_group_code,
        //             'location_name'                         => $row2->location_name,
        //             'location_code'                         => $row2->location_code,
        //             'address1'                              => $row2->address1,
        //             'address2'                              => $row2->address2,
        //             'address3'                              => $row2->address3,
        //             'address4'                              => $row2->address4,
        //             'address5'                              => $row2->address5,
        //             'postal_address'                        => $row2->postal_address,
        //             'longitude'                             => $row2->longitude,
        //             'latitude'                              => $row2->latitude,
        //             'account_credit_limit'                  => $row2->account_credit_limit,
        //             'pricing_scheme_code'                   => $row2->pricing_scheme_code,
        //             'payment_type'                          => $row2->payment_type,
        //             'number_of_days_credit'                 => $row2->number_of_days_credit,
        //             'branch_code'                           => $row2->branch_code,
        //             'branch_name'                           => $row2->branch_name,
        //             'branch_description'                    => $row2->branch_description,
        //             'branch_source_warehouse_code'          => $row2->branch_source_warehouse_code,
        //             'branch_order_delivery_lead_time'       => $row2->branch_order_delivery_lead_time,
        //             'status'                                => $row2->status
        //         );
        //     }
        // }

        // dd($c);

        // ini_set('max_execution_time', 2000);
        // $p = [];
        // foreach ($c as $x) {
        //     $p[] = PDF::loadView('reports.customer_masterfile', ['datas' => $c]);
        // }
        // return $p->download('CustomerMasterfile.pdf');
    }

    public function data()
    {
        $result = CustomerMasterFile::select(
            'account_name',
            'account_group_name',
            'account_classification_id',
            'account_description',
            'account_group_code',
            'account_code',
            'account_code2',
            'account_code3',
            'location_group_code',
            'location_name',
            'location_code',
            'address1',
            'address2',
            'address3',
            'address4',
            'address5',
            'postal_address',
            'longitude',
            'latitude',
            'account_credit_limit',
            'pricing_scheme_code',
            'payment_type',
            'number_of_days_credit',
            'branch_code',
            'branch_name',
            'branch_description',
            'branch_source_warehouse_code',
            'branch_order_delivery_lead_time',
            'status'
        );


        return $result;
    }

    public function importCust(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);

        if ($request->salesman_code != 0) {
            return 'Choose Salesman Code!';
        } else {
            $path = $request->file('import_file')->getRealPath();
            $path1 = $request->file('import_file')->store('temp');
            $path = storage_path('app') . '/' . $path1;

            Excel::import(new CustomerImport, $path);
            Excel::import(new CustomerImport2, $path);

            return response()->json(['message' => 'uploaded successfully'], 200);
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

    public function get()
    {
        $options =  AccountGroupCode::all();
        return $options;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('post', [
            'account_name' => 'required|string',
            // 'account_code' => 'required|String|unique:customer_master_files',
            'address2' => 'required|String',
            'address3' => 'required|String',
            // 'selected' => 'required',
            'payment_type' => 'required'
        ]);
        if ($request->account_code2 != '') {
            $acc_code2 = $request->account_code2;
        } else {
            $acc_code2 = 'null';
        }
        if ($request->account_code3 != '') {
            $acc_code3 = $request->account_code3;
        } else {
            $acc_code3 = 'null';
        }
        if ($request->address3 != '') {
            $address3 = $request->address3;
        } else {
            $address3 = 'null';
        }
        if ($request->address4 != '') {
            $address4 = $request->address4;
        } else {
            $address4 = 'null';
        }
        if ($request->address5 != '') {
            $address5 = $request->address5;
        } else {
            $address5 =  'null';
        }

        $res = CustomerMasterFile::create([
            'account_name' => $request->account_name,
            'account_group_name' => $request->acc_grp_name,
            'account_classification_id' => $request->acc_classification,
            'account_description' => $request->acc_description,
            'account_group_code' => $request->account_group_code,
            'account_code' => $request->account_code,
            'account_code2' => $acc_code2,
            'account_code3' => $acc_code3,
            'location_group_code' => $request->location_group_code,
            'location_name' => $request->account_name,
            'location_code' => $request->account_code,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $address3,
            'address4' => $address4,
            'address5' => $address5,
            'postal_address' => $request->postal_address,
            'longitude' => 'null',
            'latitude' => 'null',
            'account_credit_limit' => 'null',
            'pricing_scheme_code' => 'null',
            'payment_type' => $request->payment_type,
            'number_of_days_credit' => 'null',
            'branch_code' => $request->account_code,
            'branch_name' => $request->account_name,
            'branch_description' => $request->branch_description,
            'branch_source_warehouse_code' => 'null',
            'branch_order_delivery_lead_time' => 'null',
            'status' => 1
        ]);
        if ($res) {
            return 'Success';
        } else {
            return 'Error!';
        }
    }

    public function getCustomers()
    {
        return CustomerMasterFile::all();
    }

    public function getCustomers2()
    {
        return CustomerMasterFile::paginate(10);
    }

    public function getCustomer($customer_id)
    {
        return CustomerMasterFile::with(['accountGroupCode'])->find(base64_decode($customer_id));
    }

    public function updateCustomer(Request $request)
    {
        $this->validate($request, [
            'account_name' => 'required',
            'account_code' => 'required',
            'address2' => 'required',
            'address3' => 'required',
            // 'selected' => 'required',
            'payment_type' => 'required'
        ]);

        $credit  = (float)str_replace(',', '', str_replace('₱ ', '', $request->account_credit_limit));
        $mobile = str_replace(',', '', str_replace('+63',  '', $request->cus_mobile_number));
        if ($request->customer_id  != '') {
            $vld = CustomerMasterFile::where([
                'customer_id' => $request->customer_id,
                'account_name' => $request->account_name,
                'account_group_name' => $request->account_group_name,
                'account_classification_id' => $request->account_classification_id,
                'account_description' => $request->account_description,
                'account_group_code' => $request->account_group_code,
                'account_code' => $request->account_code,
                'account_code2' => $request->account_code2,
                'account_code3' => $request->account_code3,
                'location_group_code' => $request->location_group_code,
                'location_name' => $request->account_name,
                'location_code' => $request->account_code,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'address4' => $request->address4,
                'address5' => $request->address5,
                'postal_address' => $request->postal_address,
                'longitude' => 'null',
                'latitude' => 'null',
                'account_credit_limit' => $credit,
                'pricing_scheme_code' => 'null',
                'payment_type' => $request->payment_type,
                'number_of_days_credit' => 'null',
                'branch_code' => $request->account_code,
                'branch_name' => $request->account_name,
                'branch_description' => $request->branch_description,
                'branch_source_warehouse_code' => $request->branch_source_warehouse_code,
                'branch_order_delivery_lead_time' => $request->branch_order_delivery_lead_time,
                'cus_mobile_number' => $mobile
            ])->exists();
            if ($vld > 0) {
                return "1";
            } else {
                $res = CustomerMasterFile::where('customer_id', $request->customer_id)->update([
                    'account_name' => $request->account_name,
                    'account_group_name' => $request->account_group_name,
                    'account_classification_id' => $request->account_classification_id,
                    'account_description' => $request->account_description,
                    'account_group_code' => $request->account_group_code,
                    'account_code' => $request->account_code,
                    'account_code2' => $request->account_code2,
                    'account_code3' => $request->account_code3,
                    'location_group_code' => $request->location_group_code,
                    'location_name' => $request->account_name,
                    'location_code' => $request->account_code,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'address3' => $request->address3,
                    'address4' => $request->address4,
                    'address5' => $request->address5,
                    'postal_address' => $request->postal_address,
                    'longitude' => 'null',
                    'latitude' => 'null',
                    'account_credit_limit' => $credit,
                    'pricing_scheme_code' => 'null',
                    'payment_type' => $request->payment_type,
                    'number_of_days_credit' => 'null',
                    'branch_code' => $request->account_code,
                    'branch_name' => $request->account_name,
                    'branch_description' => $request->branch_description,
                    'branch_source_warehouse_code' => $request->branch_source_warehouse_code,
                    'branch_order_delivery_lead_time' => $request->branch_order_delivery_lead_time,
                    'cus_mobile_number' => $mobile
                ]);
            }
            if ($res) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function activate(Request $request)
    {
        // dd($request->all());
        $res = CustomerMasterFile::where(['customer_id' => $request->customer_id, 'status' => $request->status])->exists();
        if ($res > 0) {
            return 'Error';
        } else {
            $res2 = CustomerMasterFile::where('customer_id', $request->customer_id)->update([
                'status' => $request->status,
            ]);
            if ($res2) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function show()
    {
        $options =  SalesmanList::all()->where('status', 1);
        return $options;
    }

    public function postCredit()
    {
        $value = request()->val;
        $result = CustomerMasterFile::find(request()->id)->update(['account_credit_limit' => $value]);

        if ($result) {
            return 'Update success';
        } else {
            return 'Error';
        }
    }

    public function get_account_details(Request $request)
    {
        return AccountGroupCode::where($request->all())->get()->first();
    }

    public function searchCustomer()
    {
        $search = request()->name;
        // dd(substr($search , 0, 3));
        
        if (substr($search, 0, 1) === '0') {
             $search = substr($search, 1);
        }
        if(substr($search, 0, 3) == '639'){
            $search = substr($search, 2);
        }
        
        return CustomerMasterFile::where('account_name', 'LIKE', "%$search%")
        ->orwhere('location_code', 'LIKE', "%$search%")
        ->orwhere('cus_mobile_number', 'LIKE', "%$search%") 
        ->paginate(10);
    }

    public function getSalesmanDetails(Request $request)
    {
        return SalesmanList::where($request->all())->get()->first();
    }

    public function get_principal()
    {
        // dd(request()->all());
        // return TblPrincipal::selectRaw('DISTINCT(principal_id), 
        // tbl_principals.id,
        // principal_name,
        // contract_under_via_doc,
        // contract_under_via_receipt,
        // distributor,status,
        // tbl_principals.created_at,
        // tbl_principals.updated_at,
        // discount')
        //     ->leftJoin('tbl_discounts', 'tbl_discounts.principal_id', '=', 'tbl_principals.id')
        //     ->where('tbl_discounts.cus_id', '=', request()->cus_id)
        //     // ->leftJoin('tbl_discounts', 'tbl_discounts.cus_id', '=', 'customer_master_files.customer_id')
        //     ->paginate(10);
        return TblPrincipal::selectRaw('DISTINCT(principal_id), 
        cus_id,
        tbl_principals.id,
        principal_name,
        contract_under_via_doc,
        contract_under_via_receipt,
        distributor,status,
        tbl_principals.created_at,
        tbl_principals.updated_at,
        discount')->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('tbl_discounts')
                ->whereRaw('tbl_principals.id = tbl_discounts.principal_id')
                ->where('tbl_discounts.cus_id', '=', request()->cus_id);
        })
            ->leftJoin('tbl_discounts', 'tbl_discounts.principal_id', '=', 'tbl_principals.id')
            ->where('tbl_discounts.cus_id', '=', request()->cus_id)
            ->paginate(10);
    }

    public function searchSupplier()
    {
        $search = request()->name;
        // dd(request()->all());
        return TblPrincipal::whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('tbl_discounts')
                ->whereRaw('tbl_principals.id = tbl_discounts.principal_id')
                ->where('tbl_discounts.cus_id', '=', request()->cus_id);
        })
            ->where('principal_name', 'LIKE', "%$search%")
            ->paginate(10);

        // return TblPrincipal::selectRaw('DISTINCT(principal_id), 
        // cus_id,
        // tbl_principals.id,
        // principal_name,
        // contract_under_via_doc,
        // contract_under_via_receipt,
        // distributor,status,
        // tbl_principals.created_at,
        // tbl_principals.updated_at,
        // discount')->whereExists(function ($query) {
        //     $query->select(DB::raw(1))
        //         ->from('tbl_discounts')
        //         ->whereRaw('tbl_principals.id = tbl_discounts.principal_id')
        //         ->where('tbl_discounts.cus_id', '=', request()->cus_id);
        // })
        //     ->leftJoin('tbl_discounts', 'tbl_discounts.principal_id', '=', 'tbl_principals.id')
        //     ->where(['principal_name', 'LIKE', "%$search%", 'tbl_discounts.cus_id' => request()->cus_id])

        //     ->paginate(10);
    }

    public function postDiscount()
    {
        // dd(request()->all());
        $value = request()->val;
        $res = TblDiscount::where(['cus_id' => request()->cus_id, 'principal_id' => request()->id])->exists();
        if ($res > 0) {
            $result2 = TblDiscount::where(['cus_id' => request()->cus_id, 'principal_id' => request()->id])->update(['discount' => $value]);
            if ($result2) {
                return 'Update success';
            } else {
                return 'Error2';
            }
        } else {
            $result = TblDiscount::create(['cus_id' => request()->cus_id, 'principal_id' => request()->id, 'discount' => $value]);
            if ($result) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function getPList()
    {
        // dd(request()->all());  ->paginate(10);

        return TblPrincipal::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('tbl_discounts')
                ->whereRaw('tbl_principals.id = tbl_discounts.principal_id')
                ->where('tbl_discounts.cus_id', '=', request()->cus_id);
        })
            ->paginate(10);

        //             SELECT *
        // FROM   tbl_principals P1
        // WHERE NOT EXISTS (SELECT 1
        //                FROM   tbl_discounts C2
        //                WHERE  P1.id = C2.principal_id
        //                       AND C2.cus_id = 1521
        //                HAVING Count(*) = 1); 
    }

    public function searchPList()
    {
        $search = request()->name;
        // dd(request()->all());
        return TblPrincipal::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('tbl_discounts')
                ->whereRaw('tbl_principals.id = tbl_discounts.principal_id')
                ->where('tbl_discounts.cus_id', '=', request()->cus_id);
        })
            ->where('principal_name', 'LIKE', "%$search%")
            ->paginate(10);
    }

    public function tagPList()
    {
        // dd(request()->principal);
        $validate = TblDiscount::where(['cus_id' => request()->cus_id, 'principal_id' => request()->principal])->exists();
        if ($validate > 0) {
            return 'Already exists!';
        } else {
            $result = TblDiscount::create(
                [
                    'cus_id' => request()->cus_id,
                    'principal_id' => request()->principal
                ]
            );
            if ($result) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }

    public function untagPrincipal()
    {
        // dd(request()->all());
        $validate = TblDiscount::where(['cus_id' => request()->cus_id, 'principal_id' => request()->principal_id])->exists();
        if ($validate < 0) {
            return 'Already exists!';
        } else {
            $result =  TblDiscount::where(['cus_id' => request()->cus_id, 'principal_id' => request()->principal_id])->delete();
            if ($result) {
                return 'Success';
            } else {
                return 'Error';
            }
        }
    }
    
     public function setDefaultPassword()
    {
        $id = request()->id;
        $result = CustomerMasterFile::where('customer_id', $id)->update([
            'cus_password' => '80b61f57ba72f9409d3293982041fcf5',
            'isBlock' => 1,
             'password_date' => Carbon::now()
             ]);
        if ($result)  return response()->json(['message' => 'User created successfully!'], 200);
    }
}
