<?php

namespace App\Imports;

use App\ImportBulk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::
    default('none');

class ImportItemBulk implements ToModel, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        return new ImportBulk([
            'item_code' => $row['ITEM CODE'],
            'item_description' => $row['ITEM DESCRIPTION'],
            'uom' => $row['UOM'],
        ]);
    }
}
