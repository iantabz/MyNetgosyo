<?php

namespace App\Http\Controllers;

use App\TblUsertype;
use Illuminate\Http\Request;

class TblUsertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TblUsertype::all();
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
        // dd($request->all());
        if($request->id !=''){
            $request->validate([
                'usertype'=> 'required|string|unique:tbl_usertypes',
            ]);
            $res = TblUsertype::where('id', $request->id)->update([
                'usertype' => $request->usertype
            ]);
            if($res)
            {
                return 'Success';
            }
            else{
                return 'Error!';
            }
        }
        else{        
            $request->validate([
                'usertype'=> 'required|string|unique:tbl_usertypes',
            ]);
            $res = TblUsertype::create([
            'usertype' => $request->usertype
            ]);
            if($res)
            {
                return 'Success';
            }
            else
            {
                return 'Error!';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TblUsertype  $tblUsertype
     * @return \Illuminate\Http\Response
     */
    public function show(TblUsertype $tblUsertype)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TblUsertype  $tblUsertype
     * @return \Illuminate\Http\Response
     */
    public function edit(TblUsertype $tblUsertype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TblUsertype  $tblUsertype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TblUsertype $tblUsertype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TblUsertype  $tblUsertype
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblUsertype $tblUsertype)
    {
        //
    }
}
