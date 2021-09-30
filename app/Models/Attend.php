<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;

    protected $table = 'attends';

    public function orders(){
        return $this->belongsTo('App\Models\service_order', 'order_id');
    }


    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'attend_user');
    }
}
