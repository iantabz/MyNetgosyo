<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CutoffController extends Controller
{
    public function __construct() {
        // $this->middleware('web');
    }

    public function getCutoffs() {
        $res = DB::table('tbl_cut_off')->get();
        return response()->json($res);
    }

    public function getCutoff() {
        $cut_off_code = request()->cut_off_code ?? '';
        $res = DB::table('tbl_cut_off')
            ->where('cut_off_code', $cut_off_code)
            ->first();
        return response()->json($res);
    }

    public function updateCutoff() {
        $cut_off_code = request()->cut_off_code ?? '';
        $cut_off_time = request()->cut_off_time ?? '';
        $res = DB::table('tbl_cut_off')
            ->where('cut_off_code', $cut_off_code)
            ->update([
                'cut_off_time' => new Carbon($cut_off_time)
            ]);
        return response()->json($res);
    }
}
