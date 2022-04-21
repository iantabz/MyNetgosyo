<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetupCutoffTimeController extends Controller
{
    public function setCutoffTime(Request $request)
    {

        $check = DB::table('order_cut_off_time')->count();
        if ($check == 0) {
            DB::table('order_cut_off_time')->insert([
                'cut_off_time' => $request->time_cut_off
            ]);

            return response()->json(['message' => 'Cut-off time has been added.']);
        } else {
            DB::table('order_cut_off_time')
                ->where('cut_off_id', 1)
                ->update(['cut_off_time' => $request->time_cut_off]);

            return response()->json(['message' => 'Cut-off time has been updated.']);
        }
    }

    public function getTimeSetup()
    {
        $data = DB::table('order_cut_off_time')->first();

        return response()->json($data);
    }
}
