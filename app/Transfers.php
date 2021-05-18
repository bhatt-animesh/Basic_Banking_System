<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfers extends Model
{
    protected $table='transfer';
    protected $fillable=['from_user_id','to_user_id','amount_recived', 'created_at'];

    public function customer(){
        return $this->hasOne('App\customer','id','from_user_id');
    }
}
