<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TbTranHead extends Model
{
    protected $table = 'tb_tran_head';

    public function getOrderDetails()
    {
        return $this->hasMany(TbTranLine::class, 'tran_no', 'tran_no')->where('itm_stat', 'Delivered')->orderBy('doc_no', 'DESC');
    }

    public function getCustomerDetails()
    {
        return $this->belongsTo(CustomerMasterFile::class, 'account_code', 'account_code');
    }

    public function getSalesmanDetails()
    {
        return $this->belongsTo(SalesmanList::class, 'sm_code', 'user_code');
    }

    public function getJepeDetails()
    {
        return $this->belongsTo(TblHepeDeViaje::class, 'hepe_code', 'user_code');
    }
    
     public function active_chat()
    {
        $user = Auth::id();
        return $this->belongsTo(TblChatHead::class, 'tran_no', 'ref_no');
    }
}
