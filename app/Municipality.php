<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'tbl_municipality_masterfile';

    public function customer()
    {
        return $this->belongsTo('App\CustomerRequest', 'mun_code', 'mun_code');
    }
}
