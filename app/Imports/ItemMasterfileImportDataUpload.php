<?php

namespace App\Imports;

use App\ItemImagesPath;
use App\ItemMasterfile;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ItemMasterfileImportDataUpload implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // DB::beginTransaction();

        $date = Carbon::now()->toDateTimeString();
        // $box = 'box.png';
        // $box1 = 'items/box.png';
        $flag = 0;


        $checkuom1 = ItemMasterfile::select('itemcode', 'uom', 'conversion_qty')
            ->where([['itemcode', '=', trim($row['Item Code'])]])->exists();

        if ($checkuom1 === false) {

            $item = trim($row['Item Code']);

            $check = DB::table('nomatch_itemcode')->where('itemcode', '=', $item)->exists();
            if ($check === false) {
                DB::table('nomatch_itemcode')->insert(
                    [
                        'itemcode'     =>  trim($row['Item Code']),
                        'item_path'     =>  trim($row['Item Path']),
                        'created_at'    =>  $date,
                        'updated_at'    =>  $date
                    ]
                );
            }
        } else {
            $checkuom = ItemMasterfile::select('itemcode', 'uom', 'conversion_qty')
                ->where([['itemcode', '=', trim($row['Item Code'])]])->get();

            foreach ($checkuom as $key => $uoms) {

                $check = ItemImagesPath::where([['item_code', '=', $uoms['itemcode']], ['item_uom', '=', $uoms['uom']]])->exists();

                if ($check === true) {

                    $bits = explode(".", $row['Item Path']);
                    // $path = $bits[0] . "_" . $uoms['uom'] . "." . $bits[1];
                    $path = $bits[0] . "." . $bits[1];

                    // $path1 = "item-images/" . $bits[0] . "_" . $uoms['uom'] . "." . $bits[1];

                    $path1 = "item-images/" . $bits[0] . "." . $bits[1];

                    ItemMasterfile::where([['itemcode', '=', $uoms['itemcode']], ['uom', '=', $uoms['uom']]])
                        ->update(['image' => $path1]);

                    ItemImagesPath::where([['item_code', '=', $uoms['itemcode']], ['item_uom', '=', $uoms['uom']]])
                        ->update(['item_path' => $path]);

                    // ItemImagesPath::insert(
                    //     [
                    //         'item_code'     =>  trim($row['Item Code']),
                    //         'item_uom'      =>  $uoms['uom'],
                    //         'item_path'     =>  $path,
                    //         'created_at'    =>  $date,
                    //         'updated_at'    =>  $date
                    //     ]
                    // );

                    // if ($uoms['conversion_qty'] === '1') {

                    //     $bits = explode(".", $row['Item Path']);
                    //     // $path = $bits[0] . "_" . $uoms['uom'] . "." . $bits[1];
                    //     $path = $bits[0] . "." . $bits[1];

                    //     // $path1 = "item-images/" . $bits[0] . "_" . $uoms['uom'] . "." . $bits[1];

                    //     $path1 = "item-images/" . $bits[0] . "." . $bits[1];

                    //     ItemMasterfile::where([['itemcode', '=', $uoms['itemcode']], ['uom', '=', $uoms['uom']]])
                    //         ->update(['image' => $path1]);

                    //     ItemImagesPath::insert(
                    //         [
                    //             'item_code'     =>  trim($row['Item Code']),
                    //             'item_uom'      =>  $uoms['uom'],
                    //             'item_path'     =>  $path,
                    //             'created_at'    =>  $date,
                    //             'updated_at'    =>  $date
                    //         ]
                    //     );
                    // } else {
                    //     ItemMasterfile::where([['itemcode', '=', $uoms['itemcode']], ['uom', '=', $uoms['uom']]])
                    //         ->update(['image' => $box1]);

                    //     ItemImagesPath::insert(
                    //         [
                    //             'item_code'     =>  trim($row['Item Code']),
                    //             'item_uom'      =>  $uoms['uom'],
                    //             'item_path'     =>  $box,
                    //             'created_at'    =>  $date,
                    //             'updated_at'    =>  $date
                    //         ]
                    //     );
                    // }
                }
            }
        }


        // DB::rollBack();
    }

    public function headingRow(): int
    {
        return 1;
    }
}
