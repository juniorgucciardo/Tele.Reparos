<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class img_contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'img_contract',
        'contract_id'
    ];

    public function situation(){
        return $this->belongsTo('App\Models\service_order', 'contract_id', 'id');
    }
}
