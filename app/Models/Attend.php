<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;

    protected $table = 'attends';

    protected $fillable = [
        'id',
        'data_inicial',
        'data_final',
        'order_id',
        'status_id'
    ];

    public function orders(){
        return $this->belongsTo('App\Models\service_order', 'order_id');
    }


    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'attend_user');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }

    public function statusLogs(){
        return $this->hasMany('App\Models\StatusLog', 'attend_id');
    }
}
