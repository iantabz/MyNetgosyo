<?php

namespace App\Http\Controllers;

use App\CustomerRequest;
use App\Exports\CustomerRequestExport;
use App\Http\SMS\SMSNotification;
use App\TblBarangayClearanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerRequestController extends Controller
{
    public function getCustomerRequests()
    {
        return CustomerRequest::select(
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
            'date_app',
            'path'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('users', 'users.id', '=', 'tbl_customer_request.approved_by')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id')
            ->where('status', '=', 'Pending')
            ->paginate(10);
    }

    public function approvedBy(Request $request)
    {
        $selectedId = $request->selectedId;

        return CustomerRequest::with(['appBy'])->where('status', 'Approved')->whereIn('id', $selectedId)->get();
    }

    public function searchCustomerRequests()
    {
        $search = request()->store_name;

        $query = CustomerRequest::select(
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
            'date_app',
            'path'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id')
            ->leftJoin('users', 'users.id', '=', 'tbl_customer_request.approved_by');



        $date = request()->date;
        if ($date) {
            $query->where([['status', '=', 'Pending'], ['store_name', 'LIKE', "%$search%"]])
                ->whereDate('date_req', $date)
                ->orWhere([['status', '=', 'Pending'], ['owner_name', 'LIKE', "%$search%"]])
                ->whereDate('date_req', $date);
        } else {
            $query->where([['status', '=', 'Pending'], ['store_name', 'LIKE', "%$search%"]])
                ->orWhere([['status', '=', 'Pending'], ['owner_name', 'LIKE', "%$search%"]]);
        }

        return $query->paginate(10);

        // return CustomerRequest::whereDate('date_req', $date)
        //     ->where([['status', '=', 'Pending'], ['store_name', 'LIKE', "%$search%"]])
        //     ->whereDate('date_req', $date)
        //     ->orWhere([['status', '=', 'Pending'], ['owner_name', 'LIKE', "%$search%"]])
        //     ->paginate(10);
    }
    // public function itexmo($number, $message, $apicode, $passwd)
    // {
    //     $ch = curl_init();
    //     $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    //     curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt(
    //         $ch,
    //         CURLOPT_POSTFIELDS,
    //         http_build_query($itexmo)
    //     );
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     return curl_exec($ch);
    //     curl_close($ch);
    // }

    // public function itexmo($number, $message, $apicode, $passwd)
    // {
    //     $ch = curl_init();
    //     $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);

    //     dd($itexmo);
    //     curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt(
    //         $ch,
    //         CURLOPT_POSTFIELDS,
    //         http_build_query($itexmo)
    //     );
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     return curl_exec($ch);
    //     curl_close($ch);
    // }

    public function approveCustomer(Request $request)
    {
        // DB::transaction(function () use ($request) {

        DB::beginTransaction();

        $number = '09397410437';
        $msg = 'Your request for the Alturas Distribution App has been approved ';
        $api = 'PR-ALTUR166130_RHH2A';
        $passwd = '9)h!tc%#y$';

        foreach ($request->ids as $key => $id) {
            // dump($request->file);
            $customer_request = CustomerRequest::find($id);
            $dti_no = $customer_request->dti_no;
            $store_name = $customer_request->store_name;
            $owner = $customer_request->owner_name;
            $mobile = '+63' . $customer_request->mobile_number;
            $temp_plain = $customer_request->temp_plain;
            // $text = $store_name . ', Owner ' . $owner . '. ' . $msg . now();
            $text = "Hi $owner, \nThank you for your interest in using the Distribution APP!\nUse the following credentials to log in and start booking your orders.\nFor your security, we strongly recommend to change your password during your first login session.\n\nUsername: " . $mobile . "\nPassword: $temp_plain \n\nSincerely, \nDistribution Team";
            // dd($text);
            $result = SMSNotification::itexmo($mobile, $text, $api, $passwd);

            if ($result == "") {
                echo "iTexMo: No response from server!!!
                        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
                        Please CONTACT US for help. ";
            } else if ($result == 0) {
                echo "Message Sent!";
            } else {
                echo "Error Num " . $result . " was encountered!";
            }

            CustomerRequest::where('id', $id)->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
                'approved_by' => Auth::id(),
                'date_app' => now(),
            ]);

            if ($request->file('image-' . $id)) {
                $imageFile = $request->file('image-' . $id);

                $imageFileExtension = $imageFile->getClientOriginalExtension();

                $path = $imageFile->storeAs('brgy_clearance_imgs', $dti_no . '_' . $id . '.' . $imageFileExtension, 'public');

                TblBarangayClearanceLog::create([
                    'customer_id' => $id,
                    'path' => $path
                ]);
            }
        }
        DB::commit();
        // });

        return response()->json(['message' => 'Customer/s has been approved.']);
    }

    public function getApprovedCustomers()
    {
        return CustomerRequest::select(
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
            // 'tbl_municipality_masterfile.mun_code as mun_code2',
            // 'tbl_barangay_masterfile.bar_code as bar_code2',
            'district',
            'province',
            'coordinates',
            'store_photo',
            'status',
            'date_req',
            'remarks',
            'approved_by',
            'users.name as name',
            'date_app',
            'path',
            'tbl_barangay_clearance_logs.created_at'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('users', 'users.id', '=', 'tbl_customer_request.approved_by')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id')
            ->where('status', '=', 'Approved')
            ->paginate(10);
    }

    public function searchApprovedCustomers()
    {
        $search = request()->store_name;

        $query = CustomerRequest::select(
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
            // 'tbl_municipality_masterfile.mun_code as mun_code2',
            // 'tbl_barangay_masterfile.bar_code as bar_code2',
            'district',
            'province',
            'coordinates',
            'store_photo',
            'status',
            'date_req',
            'remarks',
            'approved_by',
            'users.name as name',
            'date_app',
            'path',
            'tbl_barangay_clearance_logs.created_at'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('users', 'users.id', '=', 'tbl_customer_request.approved_by')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id');

        $date = request()->date;

        if ($date) {
            $query->where([['status', '=', 'approved'], ['store_name', 'LIKE', "%$search%"]])
                ->whereDate('date_req', $date)
                ->orWhere([['status', '=', 'approved'], ['owner_name', 'LIKE', "%$search%"]])
                ->whereDate('date_req', $date);
        } else {
            $query->where([['status', '=', 'approved'], ['store_name', 'LIKE', "%$search%"]])
                ->orWhere([['status', '=', 'approved'], ['owner_name', 'LIKE', "%$search%"]]);
        }

        return $query->paginate(10);

        // return CustomerRequest::where([['status', '=', 'approved'], ['store_name', 'LIKE', "%$search%"]])
        // ->orWhere([['status', '=', 'approved'], ['owner_name', 'LIKE', "%$search%"]])->paginate(10);
    }

    public function rejectCustomer(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->ids as $key => $id) {
                CustomerRequest::where('id', $id)->update([
                    'status' => $request->status,
                    'remarks' => $request->remarks,
                    'approved_by' => Auth::id(),
                    'date_app' => now(),
                ]);
            }
        });

        return response()->json(['message' => 'Customer/s has been rejected.']);
    }

    public function getRejectedCustomers()
    {
        return CustomerRequest::select(
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
            // 'tbl_municipality_masterfile.mun_code as mun_code2',
            // 'tbl_barangay_masterfile.bar_code as bar_code2',
            'district',
            'province',
            'coordinates',
            'store_photo',
            'status',
            'date_req',
            'remarks',
            'approved_by',
            'users.name as name',
            'date_app',
            'path'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('users', 'users.id', '=', 'tbl_customer_request.approved_by')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id')
            ->where('status', '=', 'Rejected')
            ->paginate(10);
    }

    public function searchRejectedCustomers()
    {
        $search = request()->store_name;
        return CustomerRequest::where([['status', '=', 'rejected'], ['store_name', 'LIKE', "%$search%"]])->orWhere([['status', '=', 'rejected'], ['owner_name', 'LIKE', "%$search%"]])->paginate(10);
    }

    public function exportCustomerRequest()
    {
        return Excel::download(new CustomerRequestExport, 'customerrequests.xlsx');
    }

    public function searchCustomerRequestsbyDate()
    {
        $date = request()->date;
        return CustomerRequest::select(
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
            'date_app',
            'path'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id')
            ->where([['status', '=', 'Pending'], ['date_req', 'LIKE', "%$date%"]])
            ->paginate(10);
    }

    public function searchApprovedCustomersbyDate()
    {
        $date = request()->date;
        return CustomerRequest::select(
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
            'date_app',
            'path'
        )
            ->join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->leftJoin('users', 'users.id', '=', 'tbl_customer_request.approved_by')
            ->leftJoin('tbl_barangay_clearance_logs', 'tbl_barangay_clearance_logs.customer_id', 'tbl_customer_request.id')
            ->where([['status', '=', 'Approved'], ['date_req', 'LIKE', "%$date%"]])
            ->paginate(10);
    }
}
