<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblFeedback extends Model
{
    protected $table = 'tbl_feedback';

    public function customer_details()
    {
        return $this->belongsTo('App\CustomerMasterFile', 'account_code', 'account_code');
    }
}
