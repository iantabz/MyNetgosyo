<?php

namespace App\Imports;

use App\TblCustomerSalesman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::
    default('none');

class CustomerImport2 implements ToModel,  WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new TblCustomerSalesman([
            'cus_customer_code' => $row['Account Code'],
            'salesman_code' => request()->salesman_code,
            'status' => '1'
        ]);
    }
}
