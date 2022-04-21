<?php

namespace App\Imports;

use App\SalesExportFiles;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SalesExportFiles([
            'downloaded'            =>  $row['downloaded'],
            'sef_no'              =>  $row['sef_no'],
            'cust_name'         =>  $row['cust_name'],
            'po'               =>  $row['po'],
            'acct_code'         =>  $row['acct_code'],
            'acct_name'              =>  $row['acct_name'],
            'branch_name'                  =>  $row['branch_name'],
            'username'                   =>  $row['username'],
            'usercode'                     =>  $row['usercode'],
            'user_fname'                 =>  $row['user_fname'],
            'timestamp'            =>  $row['timestamp'],
            'product_code'                  =>  $row['product_code'],
            'product_name'                       =>  $row['product_name'],
            'product_uom'               =>  $row['product_uom'],
            'qty_for_delivery'           =>  $row['qty_for_delivery'],
            'qty_for_ordered'            =>  $row['qty_for_ordered'],

        ]);
    }
}
