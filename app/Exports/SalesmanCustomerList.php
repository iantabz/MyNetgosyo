<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SalesmanCustomerList implements FromView, ShouldAutoSize, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('reports.salesman_customerlist', ['data' => session()->get('data')]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 30
        ];
    }
}
