<?php

namespace App\Imports;

use App\ConsolidatedTransaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class ConsolidatedTransactionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $date = Carbon::now()->toDateString();

        return new ConsolidatedTransaction([
            'transaction_type'              =>  $row[0],
            'sales_invoice'                 =>  $row[1],
            'customer_code'                 =>  $row[2],
            'posting_date'                  =>  $row[3],
            'itemcode'                      =>  $row[4],
            'qty'                           =>  $row[5],
            'unit_price'                    =>  $row[6],
            'total_amt'                     =>  $row[7],
            'price_w_vat'                   =>  $row[8],
            'salesman_code'                 =>  $row[9],
            'uom'                           =>  $row[10],
            'reference_no'                  =>  $row[11],
            'status'                        =>  'consolidated',
            'date_uploaded'                 =>  $date,
            'flag'                          =>  0,
        ]);
    }
}
