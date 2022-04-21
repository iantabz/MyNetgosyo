<?php

namespace App\Imports;

use App\CustomerMasterFile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

HeadingRowFormatter::
    default('none');

class CustomerImport implements ToModel, WithValidation, WithHeadingRow, WithCustomCsvSettings
{
    use Importable;

    public function model(array $row)
    {
        $result = CustomerMasterFile::where([['account_code', '=', trim($row['Account Code'])],])->exists();
        if ($result === false) {
            // dd(trim($row['Location Name']));
            return new CustomerMasterFile([
                'location_group_code'               => trim($row['Location Group Code']),
                'location_code'                     => trim($row['Location Code']),
                'location_name'                     => trim($row['Location Name']),
                'address1'                          => trim($row['Address 1']),
                'address2'                          => trim($row['Address 2']),
                'address3'                          => trim($row['Address 3']),
                'address4'                          => trim($row['Address 4']),
                'address5'                          => trim($row['Address 5']),
                'postal_address'                    => trim($row['Postal Address']),
                'longitude'                         => trim($row['Longitude']),
                'latitude'                          => trim($row['Latitude']),
                'account_group_code'                => trim($row['Account Group Code']),
                'account_group_name'                => trim($row['Account Group Name']),
                'account_code'                      => trim($row['Account Code']),
                'account_code2'                     => trim($row['Account Code 2']),
                'account_code3'                     => trim($row['Account Code 3']),
                'account_name'                      => trim($row['Account Name']),
                'account_description'               => trim($row['Account Description']),
                'account_credit_limit'              => trim($row['Account Credit Limit']),
                'account_classification_id'         => trim($row['Account Classification ID']),
                'pricing_scheme_code'               => trim($row['Pricing Scheme Code']),
                'payment_type'                      => trim($row['Payment Type']),
                'number_of_days_credit'             => trim($row['Number Of Days Credit']),
                'branch_code'                       => trim($row['Branch Code']),
                'branch_name'                       => trim($row['Branch Name']),
                'branch_description'                => trim($row['Branch Description']),
                'branch_source_warehouse_code'      => trim($row['Branch Source Warehouse Code']),
                'branch_order_delivery_lead_time'   => trim($row['Branch Order Delivery Lead Time']),
                'status'                            => 1,
                'salesman_code'                     => request()->salesman_code
            ]);
        } else {
            $val = (int)str_replace(",", "", $row['Account Credit Limit']);
            $credit = number_format($val, 2, '.', ',');

            if (trim($row['Account Credit Limit'] == 0.00)) {
                CustomerMasterFile::where('account_code', '=', trim($row['Account Code']))->update(['account_credit_limit' => $credit]);
            } else {
            }
        }
    }

    public function rules(): array
    {
        return [
            // 'Location Group Code' => ['required'],
            // 'Location Code' => ['required', 'unique:customer_master_files,location_code'],
            // 'Location Name' => ['required'],
            // 'Address 1' => ['required'],
            // 'Address 2' => ['required'],
            // 'Address 3' => ['required'],
            // 'Address 4' => ['required'],
            // 'Address 5' => ['required'],

            // // 'Postal Address' => ['required'],

            // 'Longitude' => ['required'],
            // 'Latitude' => ['required'],
            // 'Account Group Code' => ['required'],
            // 'Account Group Name' => ['required'],
            // 'Account Code' => ['required', 'unique:customer_master_files,account_code'],
            // 'Account Code 2' => ['required'],
            // 'Account Code 3' => ['required'],
            // 'Account Name' => ['required'],
            // 'Account Description' => ['required'],
            // 'Account Credit Limit' => ['required'],
            // 'Account Classification ID' => ['required'],

            // 'Pricing Scheme Code' => ['required'],

            // // 'Payment Type' => ['required', 'unique:customer_master_files,branch_code'],
            // 'Number Of Days Credit' => ['required'],
            // 'Branch Code' => ['required', 'unique:customer_master_files,branch_code'],
            // 'Branch Name' => ['required'],
            // 'Branch Description' => ['required'],

        ];
    }
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1'
        ];
    }
}
