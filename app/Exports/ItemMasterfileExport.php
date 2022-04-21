<?php

namespace App\Exports;

use App\ItemMasterfile;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemMasterfileExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ItemMasterfile::all();
    }
}
