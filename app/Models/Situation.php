<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function orders(){
        return $this->hasMany('App\Models\service_order', 'situation_id', 'id');
    }
}
