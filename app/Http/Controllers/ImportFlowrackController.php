<?php

namespace App\Http\Controllers;

use App\ImportFlowrack;
use Illuminate\Http\Request;
use App\Imports\ImportItemFlowrack;
use Maatwebsite\Excel\Facades\Excel;

class ImportFlowrackController extends Controller
{
    public function importItemsFlowrack(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt'
        ]);


        $path = $request->file('import_file')->getRealPath();

        Excel::import(new ImportItemFlowrack, $path);
        return response()->json(['message' => 'uploaded successfully'], 200);
    }

    public function getItemsFlowrack()
    {
        return ImportFlowrack::paginate(10);
    }

    public function searchItemsFlowrack()
    {
        $search = request()->name;
        return ImportFlowrack::where('item_code', 'LIKE', "%$search%")->paginate(10);
    }
}
