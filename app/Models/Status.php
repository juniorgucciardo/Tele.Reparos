<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'status_title'
    ];

    public function service_order(){
        return $this->hasMany('App\Models\service_order', 'status_id', 'id');
    }

}
