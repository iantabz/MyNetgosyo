<?php

namespace App\Http\Controllers;

use App\ImportBulk;
use App\Imports\ImportItemBulk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportBulkController extends Controller
{
    public function importitemsbulk(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);


        $path = $request->file('import_file')->getRealPath();

        Excel::import(new ImportItemBulk, $path);
        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function getItemsBulk()
    {
        return ImportBulk::paginate(10);
    }

    public function searchItemsBulk()
    {
        $search = request()->name;
        return ImportBulk::where('item_code', 'LIKE', "%$search%")->paginate(10);
    }
}
