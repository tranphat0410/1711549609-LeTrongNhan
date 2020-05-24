<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billstatus extends Model
{
    protected $table = "bill_status";
    public function status(){
        return $this->hasMany('App\Bill','status_id','id');
    }
}
