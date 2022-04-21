<?php

namespace App\Imports;

use App\ItemHistoryLog;
use App\ItemImagesPath;
use App\ItemMasterfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ItemMasterfileImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // set_time_limit(0);
        
        $date = Carbon::now()->toDateTimeString();
        $default_path = 'item-images/no_image_item.jpg';
        $default_path1 = 'no_image_item.jpg';

        $pname = ItemMasterfile::where([['product_name', '=', trim($row['Product Name'])], ['itemcode', '=', trim($row['Item Code'])], ['uom', '=', trim($row['Unit of Measure'])]])->exists();

        if ($pname === false) {

            ItemMasterfile::insert(
                [
                    'product_name'              =>  trim($row['Product Name']),
                    'product_shrt_name'         =>  trim($row['Product Short Name']),
                    'description'               =>  trim($row['Description']),
                    'company_code'              =>  trim($row['Company Code']),
                    'itemcode'                  =>  trim($row['Item Code']),
                    'barcode'                   =>  trim($row['Barcode']),
                    'brand'                     =>  trim($row['Brand']),
                    'principal'                 =>  trim($row['Principal']),
                    'product_family'            =>  trim($row['Product Family']),
                    'keywords'                  =>  trim($row['Keywords']),
                    'uom'                       =>  trim($row['Unit of Measure']),
                    'list_price_wouttax'        =>  trim($row['List Price without Tax']),
                    'list_price_wtax'           =>  trim($row['List Price with Tax']),
                    'conversion_qty'            =>  trim($row['Conversion Qty']),
                    'conversion_uom'            =>  trim($row['Conversion UOM']),
                    'isPromo'                   =>  0,
                    'image'                     =>  $default_path,
                    'order_count'               =>  0,
                    'date_uploaded'             =>  $date,
                    'status'                    =>  1,
                    'rate'                      =>  0.00,
                    // kaloy 2022-04-04
                    'sold'                      =>  0,
                ]
            );

            $check_image_path_item_uom = ItemImagesPath::where([['item_code', '=', trim($row['Item Code'])], ['item_uom', '=', trim($row['Unit of Measure'])]])
                ->exists();

            if ($check_image_path_item_uom == false) {

                ItemImagesPath::insert(
                    [
                        'item_code'     =>  trim($row['Item Code']),
                        'item_uom'      =>  trim($row['Unit of Measure']),
                        'item_path'     =>  $default_path1,
                        'created_at'    =>  $date,
                        'updated_at'    =>  $date
                    ]
                );
            }
        } else {

            //TODO: 2022-04-11 Lines below was transferred to ItemMasterfileController.php
            // ...

            $s_data = ItemMasterfile::where([['product_name', '=', trim($row['Product Name'])], ['itemcode', '=', trim($row['Item Code'])], ['uom', '=', trim($row['Unit of Measure'])]])->get();
            if (!empty($s_data)) {

                foreach ($s_data as $rows) {
                    
                    // kaloy 2022-04-04
                    ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                    ->update([
                        'status' => 1
                    ]);



                    if ($rows['list_price_wtax'] != trim($row['List Price with Tax'])) {



                        ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                            ->update(['list_price_wtax' => trim($row['List Price with Tax'])]);


                        ItemHistoryLog::create([
                            'item_masterfile_id' => $rows['item_masterfiles_id'],
                            'product_name' => $rows['product_name'],
                            'itemcode'  => $rows['itemcode'],
                            'uom'   =>  $rows['uom'],
                            'price1' => $rows['list_price_wtax'],
                            'price2' => trim($row['List Price with Tax']),
                            'uom1' => $rows['uom'],
                            'uom2' => '',
                            'product_family1' => $rows['product_family'],
                            'product_family2' => '',
                            'principal1' => $rows['principal'],
                            'principal2' => '',
                            'brand1' => $rows['brand'],
                            'brand2' => '',
                            'keywords1' => $rows['keywords'],
                            'keywords2' => '',
                            'description1' => $rows['description'],
                            'description2' => '',
                            'date_from' => $rows['date_uploaded'],
                            'date_to' => $date,
                            'date_uploaded' => $date,
                            'flag' => 0,

                        ]);
                    } else {
                    }
                    if ($rows['product_family'] != trim($row['Product Family'])) {

                        ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                            ->update(['product_family' => trim($row['Product Family'])]);

                        ItemHistoryLog::create([
                            'item_masterfile_id' => $rows['item_masterfiles_id'],
                            'product_name' => $rows['product_name'],
                            'itemcode'  => $rows['itemcode'],
                            'uom'   =>  $rows['uom'],
                            'price1' => $rows['list_price_wtax'],
                            'price2' => '',
                            'uom1' => $rows['uom'],
                            'uom2' => '',
                            'product_family1' => $rows['product_family'],
                            'product_family2' => trim($row['Product Family']),
                            'principal1' => $rows['principal'],
                            'principal2' => '',
                            'brand1' => $rows['brand'],
                            'brand2' => '',
                            'keywords1' => $rows['keywords'],
                            'keywords2' => '',
                            'description1' => $rows['description'],
                            'description2' => '',
                            'date_from' => $rows['date_uploaded'],
                            'date_to' => $date,
                            'date_uploaded' => $date,
                            'flag' => 0,

                        ]);
                    } else {
                    }
                    if ($rows['principal'] != trim($row['Principal'])) {


                        ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                            ->update(['principal' => trim($row['Principal'])]);

                        ItemHistoryLog::create([
                            'item_masterfile_id' => $rows['item_masterfiles_id'],
                            'product_name' => $rows['product_name'],
                            'itemcode'  => $rows['itemcode'],
                            'uom'   =>  $rows['uom'],
                            'price1' => $rows['list_price_wtax'],
                            'price2' => '',
                            'uom1' => $rows['uom'],
                            'uom2' => '',
                            'product_family1' => $rows['product_family'],
                            'product_family2' => '',
                            'principal1' => $rows['principal'],
                            'principal2' => trim($row['Principal']),
                            'brand1' => $rows['brand'],
                            'brand2' => '',
                            'keywords1' => $rows['keywords'],
                            'keywords2' => '',
                            'description1' => $rows['description'],
                            'description2' => '',
                            'date_from' => $rows['date_uploaded'],
                            'date_to' => $date,
                            'date_uploaded' => $date,
                            'flag' => 0,

                        ]);
                    } else {
                    }
                    if ($rows['brand'] != trim($row['Brand'])) {

                        ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                            ->update(['brand' => trim($row['Brand'])]);

                        ItemHistoryLog::create([
                            'item_masterfile_id' => $rows['item_masterfiles_id'],
                            'product_name' => $rows['product_name'],
                            'itemcode'  => $rows['itemcode'],
                            'uom'   =>  $rows['uom'],
                            'price1' => $rows['list_price_wtax'],
                            'price2' => '',
                            'uom1' => $rows['uom'],
                            'uom2' => '',
                            'product_family1' => $rows['product_family'],
                            'product_family2' => '',
                            'principal1' => $rows['principal'],
                            'principal2' => '',
                            'brand1' => $rows['brand'],
                            'brand2' => trim($row['Brand']),
                            'keywords1' => $rows['keywords'],
                            'keywords2' => '',
                            'description1' => $rows['description'],
                            'description2' => '',
                            'date_from' => $rows['date_uploaded'],
                            'date_to' => $date,
                            'date_uploaded' => $date,
                            'flag' => 0,

                        ]);
                    } else {
                    }
                    if ($rows['keywords'] != trim($row['Keywords'])) {


                        ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                            ->update(['keywords' => trim($row['Keywords'])]);

                        ItemHistoryLog::create([
                            'item_masterfile_id' => $rows['item_masterfiles_id'],
                            'product_name' => $rows['product_name'],
                            'itemcode'  => $rows['itemcode'],
                            'uom'   =>  $rows['uom'],
                            'price1' => $rows['list_price_wtax'],
                            'price2' => '',
                            'uom1' => $rows['uom'],
                            'uom2' => '',
                            'product_family1' => $rows['product_family'],
                            'product_family2' => '',
                            'principal1' => $rows['principal'],
                            'principal2' => '',
                            'brand1' => $rows['brand'],
                            'brand2' => '',
                            'keywords1' => $rows['keywords'],
                            'keywords2' => trim($row['Keywords']),
                            'description1' => $rows['description'],
                            'description2' => '',
                            'date_from' => $rows['date_uploaded'],
                            'date_to' => $date,
                            'date_uploaded' => $date,
                            'flag' => 0,

                        ]);
                    } else {
                    }
                    if ($rows['description'] != trim($row['Description'])) {


                        ItemMasterfile::where('item_masterfiles_id', '=', $rows['item_masterfiles_id'])
                            ->update(['description' => trim($row['Description'])]);

                        ItemHistoryLog::create([
                            'item_masterfile_id' => $rows['item_masterfiles_id'],
                            'product_name' => $rows['product_name'],
                            'itemcode'  => $rows['itemcode'],
                            'uom'   =>  $rows['uom'],
                            'price1' => $rows['list_price_wtax'],
                            'price2' => '',
                            'uom1' => $rows['uom'],
                            'uom2' => '',
                            'product_family1' => $rows['product_family'],
                            'product_family2' => '',
                            'principal1' => $rows['principal'],
                            'principal2' => '',
                            'brand1' => $rows['brand'],
                            'brand2' => '',
                            'keywords1' => $rows['keywords'],
                            'keywords2' => '',
                            'description1' => $rows['description'],
                            'description2' => trim($row['Description']),
                            'date_from' => $rows['date_uploaded'],
                            'date_to' => $date,
                            'date_uploaded' => $date,
                            'flag' => 0,

                        ]);
                    } else {
                    }
                }
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
