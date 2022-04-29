<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PriceChangesController extends Controller
{
    //

    public function __construct() {
        $this->middleware('auth');
    }

    public function uploadPriceChanges(Request $request) {
        try {
            $delimiter = ',';
            $fileName = time() . '.' . $request->file->getClientOriginalName();
            $fileStoragePath = "temp/price_changes/". Carbon::today()->format('Y-m-d');
            Storage::putFileAs($fileStoragePath, $request->file, $fileName);

            if (Storage::exists("$fileStoragePath/$fileName")) {
                $content = Storage::get("$fileStoragePath/$fileName");

                $rows = explode(PHP_EOL, mb_convert_encoding($content, "UTF-8", "UTF-8"));
                foreach ($rows as $row) {
                    // $cols = explode($delimiter, $row);
                    $cols = preg_split('/,(?=(?:(?:[^"]*"){2})*[^"]*$)/', $row);
                    if(count($cols) == 6) {
                        $item_code = trim(str_replace('"','', $cols[0]));
                        $u1 = trim(str_replace('"','', $cols[1]));
                        $uom = trim(str_replace('"','', $cols[2]));
                        $price_change_date = trim(str_replace('"','', $cols[3]));
                        $price = trim(str_replace(',','',str_replace('"','', $cols[4])));
                        $price_wtax = trim(str_replace(',','',str_replace('"','', $cols[5])));
                    }
                    $temp_price_change_date = Carbon::parse($price_change_date)->format('Y-m-d');

                    if(
                        DB::table('item_masterfiles')
                            ->where('itemcode', $item_code)
                            ->where('uom', $uom)
                            ->where(function($query) use (&$temp_price_change_date){
                                $query->where('updated_at', null)
                                    ->orWhere('updated_at', '')
                                    ->orWhere('updated_at', '<', $temp_price_change_date);
                            })
                            ->exists()
                    ) {
                        // dd('found');
                        DB::table('item_masterfiles')
                            ->where('itemcode', $item_code)
                            ->where('uom', $uom)
                            ->update([
                                'updated_at' => Carbon::today(),
                                'list_price_wouttax' => floatval($price),
                                'list_price_wtax' => floatval($price_wtax),
                            ]);
                    }
                }
                
                $res['success'] = true;
                $res['message'] = 'Successful';
                return response()->json($res);
            }
        } catch (\Throwable $th) {
            $res['success']=false;
            $res['message']=$th->getMessage();
            return response()->json($res, 500);
        }
    }
}
