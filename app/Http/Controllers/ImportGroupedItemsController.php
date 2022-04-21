<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ImportGroupedItemsController extends Controller
{
    // kaloy 2022-04-05
    public function groupedItemsUpload(Request $request) {
        set_time_limit(0);

        $res['success'] = '';
        $res['message'] = '';
        
        try {
            //code...
            $rowCount = 1;
            $tableName = '';
            $dateToday = Carbon::now();
            $request->validate([
                'file' => 'required|file|mimes:xls,xlsx,csv,txt'
            ]);

            // dd($request->file('file'));
            $file = $request->file('file');
            $fileName = time(). '-'. $file->getClientOriginalName();
            $storagePath = 'temp';
            Storage::putFileAs($storagePath, $file, $fileName);
            $content = Storage::get($storagePath . "/". $fileName);

            $contentRows = explode(PHP_EOL, mb_convert_encoding($content, "UTF-8", "UTF-8"));
            foreach($contentRows as $row) {
                if($rowCount > 1) {
                    $cols = preg_split('/,(?=(?:(?:[^"]*"){2})*[^"]*$)/', $row);
                    if(count($cols) == 4) {
                        $itemcode =     str_replace(' ','',trim($cols[0]));
                        $description =  str_replace(' ','',trim($cols[1]));
                        $uom =          str_replace(' ','',trim($cols[2]));
                        $group =        str_replace(' ','',trim($cols[3]));
    
                        $tableName = "tbl_item_". $group;
                        $itemExists = DB::table($tableName)->where('item_code', $itemcode)
                            ->where('uom', $uom)->exists();
                        if($itemExists) {
                            DB::table($tableName)->where('item_code', $itemcode)
                            ->where('uom', $uom)->update([
                                'item_description' => $description,
                                'updated_at' => $dateToday
                            ]);
                        } else {
                            DB::table($tableName)->insert([
                                'item_code' => $itemcode,
                                'item_description' => $description,
                                'uom' => $uom,
                                'created_at' => $dateToday,
                                'updated_at' => $dateToday,
                            ]);
                        }
                    }
                }
    
                $rowCount++;
            }

            $res['success'] = true;
            $res['message'] = 'Success';
            return response()->json($res);
        } catch (\Throwable $th) {
            //throw $th;
            $res['success'] = false;
            $res['message'] = $th->getMessage();
            return response()->json($res);
        }

    }
}
