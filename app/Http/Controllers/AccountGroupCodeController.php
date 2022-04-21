<?php

namespace App\Http\Controllers;

use App\AccountGroupCode;
use Illuminate\Http\Request;

class AccountGroupCodeController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->account_groupcode_id != '') {
            $res = AccountGroupCode::where('account_groupcode_id', $request->account_groupcode_id)->update([
                'group_code' => $request->group_code,
                'group_name' => $request->group_name,
                'account_classification_id' => $request->account_classification_id
            ]);
            if ($res) {
                return 'Update';
            } else {
                return 'Error!';
            }
        } else {
            $request->validate([
                'group_code' => 'required|string|unique:account_group_codes',
                'group_name' => 'required|String|unique:account_group_codes',
                'account_classification_id' => 'required|String|unique:account_group_codes'
            ]);
            $res = AccountGroupCode::create([
                'group_code' => $request->group_code,
                'group_name' => $request->group_name,
                'account_classification_id' => $request->account_classification_id
            ]);
            if ($res) {
                return 'Success';
            } else {
                return 'Error!';
            }
        }
    }
    public function getGroupCodes()
    {
        return AccountGroupCode::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountGroupCode  $accountGroupCode
     * @return \Illuminate\Http\Response
     */
    public function show(AccountGroupCode $accountGroupCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountGroupCode  $accountGroupCode
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountGroupCode $accountGroupCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountGroupCode  $accountGroupCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountGroupCode $accountGroupCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountGroupCode  $accountGroupCode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountGroupCode::find($id)->delete();
        return 'Success';
    }
}
