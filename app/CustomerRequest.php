<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerRequest extends Model
{
    protected $guarded = [];

    protected $table = 'tbl_customer_request';

    public $timestamps = false;

    public function municipality()
    {
        return $this->hasOne('App\Municipality', 'mun_code', 'mun_code');
    }

    public function appBy()
    {
        return $this->belongsTo('App\User', 'approved_by', 'id');
    }
}
