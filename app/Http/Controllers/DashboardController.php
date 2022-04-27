<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function averageTransactionsPerDay() {
        $res = DB::select(
            "SELECT AVG(d.t) as average from (select count(tran_no) as t FROM tb_tran_head GROUP BY DATE(date_req)) as d"
        );
        
        return response()->json($res[0] ?? null);
    }
}
