<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_chat_head';

    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'ref_no', 'ref_no')->latest('tbl_chat_line.id');
    }
}
