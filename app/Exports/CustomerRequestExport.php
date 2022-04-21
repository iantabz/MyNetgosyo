<?php

namespace App\Exports;

use App\CustomerRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerRequestExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Store Name',
            'DTI No',
            'Owner Name',
            'Mobile No',
            'Street Address',
            'Landmark',
            'Barangay',
            'Municipal',
            'District',
            'Province'
        ];
    }

    public function collection()
    {
        return CustomerRequest::join('tbl_municipality_masterfile', 'tbl_municipality_masterfile.mun_code', '=', 'tbl_customer_request.mun_code')
            ->join('tbl_barangay_masterfile', 'tbl_barangay_masterfile.bar_code', '=', 'tbl_customer_request.bar_code')
            ->join('users', 'users.name', '=', 'users.name')
            ->whereIn('tbl_customer_request.id', request()->id)
            ->get([
                'store_name',
                'dti_no',
                'owner_name',
                'mobile_number',
                'street_add',
                'landmark',
                'tbl_municipality_masterfile.mun_name as mun_name',
                'tbl_barangay_masterfile.bar_name as bar_name',
                'district',
                'province',
                // 'coordinates',
                // 'store_photo',
                // 'status',
                // 'date_req',
                // 'remarks',
                // 'approved_by',
                // 'users.name as name',
                // 'date_app',
            ]);
    }
}
