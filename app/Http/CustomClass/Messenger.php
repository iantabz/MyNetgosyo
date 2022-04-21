<?php

namespace App\Http\CustomClass;

use App\Contact;
use App\Http\SMS\SMSNotification;
use App\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Messenger
{
    public static function retrieveContacts()
    {
        // return Contact::select('tbl_chat_head.*', 'customer_master_files.account_name', 'tb_tran_head.order_by', 'customer_master_files.cus_mobile_number')
        //     ->join('customer_master_files', 'customer_master_files.account_code', 'tbl_chat_head.account_code')
        //     ->join('tb_tran_head', 'tb_tran_head.tran_no', 'tbl_chat_head.ref_no')

        //     // ->where([['sender_id', auth()->id()]])
        //     ->where('tb_tran_head.tran_stat', 'On-Process')
        //     ->orderBy('id', 'desc')
        //     ->get();

        return Contact::with(['lastMessage'])
            ->join('customer_master_files', 'customer_master_files.account_code', 'tbl_chat_head.account_code')
            ->leftjoin('tb_tran_head', 'tb_tran_head.tran_no', 'tbl_chat_head.ref_no')
            ->select('tbl_chat_head.*', 'customer_master_files.account_name', 'tb_tran_head.order_by', 'customer_master_files.cus_mobile_number')->get();
            // ->where('tb_tran_head.tran_stat', 'On-Process')->get();
    }

    public static function makeTheFirstMove($request)
    {
        $date = Carbon::now();
        // $mobile = '+63' . $request->cus_mobile_number;
        // $mobile =  '09190796051';
        // $sm_mobile = $request->sm_mobile;
        if ($request->order_by == 'Backend' || $request->order_by == 'Customer') $mobile = '+63' . $request->cus_mobile_number;
        if ($request->order_by == 'Salesman') $mobile = $request->sm_mobile;

        // $ref = Contact::orderBy('id', 'desc')->first()->ref_no;

        // $bits = explode('-', $ref);
        // $number = (int)$bits[1];
        // $number++;
        // $reference = $bits[0] . '-' . $number;

        $check_exists = Contact::where('account_code', '=', $request->account_code)
            ->where([['ref_no', '=', $request->tran_no], ['sender_id', auth()->user()->id]])
            ->exists();
        $api = 'PR-ALTUR166130_RHH2A';
        $passwd = '9)h!tc%#y$';

        if ($check_exists === true) {
            return 'Exists';
        } else {
            DB::transaction(function () use ($request, $mobile, $api, $passwd, $date) {
                Contact::create([
                    'sender_id' =>   auth()->user()->id,
                    'sender_backend'    =>  auth()->user()->name,
                    'account_code'  =>  $request->account_code,
                    'ref_no'    =>  $request->tran_no,
                    'chat_datetime' =>  $date,
                    'status'    =>  'active'
                ]);

                $text = "Hi, this is from My NETgosyo ! Unfortunately, the following item(s) that you ordered are now out-of-stock. We apologize for any inconvenience this update may cause and would like to suggest another item in place of the original order. I will be happy to add your new order. \n\n ~IanTabz...";
                SMSNotification::itexmo($mobile, $text, $api, $passwd);

                Message::create([
                    'account_code'  =>  $request->account_code,
                    'ref_no'    =>  $request->tran_no,
                    'msg_body'  =>  'Hi, this is from My NETgosyo ! Unfortunately, the following item(s) that you ordered are now out-of-stock. We apologize for any inconvenience this update may cause and would like to suggest another item in place of the original order. I will be happy to add your new order.',
                    'sender'    =>  'backend',
                    'msg_datetime'  =>  $date,
                    'status_backend'    =>  'seen',
                    'status_salesman'   =>  'unseen',
                    'status_customer'   =>  'unseen'
                ]);
            });

            return 'Success';
        }
    }

    public static function retrieveContactConversation($contactCode, $contactRef)
    {
        $messages = Message::select('tbl_chat_line.msg_datetime as sent_at', 'tbl_chat_line.msg_body as body', 'tbl_chat_line.account_code as to_id', 'tbl_chat_line.sender')
            ->where([
                ['account_code', $contactCode],
                ['ref_no', $contactRef]
            ]);

        return $messages->offset($messages->count() - 10)->oldest('tbl_chat_line.id')->limit(10)->get();
    }

    public static function send(object $request)
    {
        $date = Carbon::now();

        Message::create([
            'account_code'  =>  $request->contactCode,
            'ref_no'    =>  $request->contactRef,
            'msg_body'  =>  $request->message,
            'sender'    =>  'backend',
            'msg_datetime'  =>  $date,
            'status_backend'    =>  'seen',
            'status_salesman'   =>  'unseen',
            'status_customer'   =>  'unseen'
        ]);

        return 'Success';
    }

    public static function changeChatStatus($id, $status)
    {
        $result = Contact::where([['id', '=', $id], ['status', '=', $status]])->exists();
        if ($result === TRUE) {
            return 'Error';
        } else {
            if ($status == 'active') {
                $result = Contact::where('id', '=', $id)->update([
                    'status' => $status,
                    'disabled_by' => null
                ]);
            } else {
                $result = Contact::where('id', '=', $id)->update([
                    'status' => $status,
                    'disabled_by' => auth()->user()->name
                ]);
            }
            return 'Success';
        }
    }
}
