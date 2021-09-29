<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_title'
    ];

    protected $table = 'type';


    public function service_order(){
        return $this->hasMany('App\Models\service_order', 'type_id', 'id');
    }
}
