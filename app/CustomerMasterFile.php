<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerMasterFile extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'customer_id';

    public function accountGroupCode()
    {
        return $this->belongsTo('App\AccountGroupCode', 'account_group_code', 'group_code');
    }
}
