<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SourceOrderCountController implements FromView
{
    private $data;
    private $dateFrom;
    private $dateTo;

    public function __construct($data, $dateFrom, $dateTo) {
        $this->data = $data;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view(
            'reports.orders_summary', 
            ['data' => $this->data, 'dateFrom' => $this->dateFrom, 'dateTo' => $this->dateTo]
        );
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'B' => 30,
    //         'C' => 30
    //     ];
    // }
}
