<?php

namespace App\Http\Controllers;

use App\ImportBCOM;
use Illuminate\Http\Request;
use App\Imports\ImportItemBCOM;
use Maatwebsite\Excel\Facades\Excel;

class ImportBCOMController extends Controller
{
    public function importItemsBCOM(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);


        $path = $request->file('import_file')->getRealPath();

        Excel::import(new ImportItemBCOM, $path);
        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function getItemsBCOM()
    {
        return ImportBCOM::paginate(10);
    }

    public function searchItemsBCOM()
    {
        $search = request()->name;
        return ImportBCOM::where('item_code', 'LIKE', "%$search%")->paginate(10);
    }
}
