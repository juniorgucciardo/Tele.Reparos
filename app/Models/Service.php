<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'service_title',
        'service_description'
    ];

    public function service_order(){

        //um serviço oferecido possui varias ordens de serviço
        return $this->hasMany('App\Models\service_order', 'id_service', 'id');
    }

}
