<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblCustomerSalesman extends Model
{

    protected $guarded = [];
    protected $table = "tbl_customer_salesman";

    // public function customer()
    // {
    //     return $this->belongsTo('App\CustomerMasterFile', 'cus_customer_code', 'account_code');
    // }
}
