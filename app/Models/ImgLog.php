<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgLog extends Model
{
    use HasFactory;
    
    protected $table = 'img_logs';

    protected $fillable = [
        'statuslog_id',
        'img_log'
    ];

    public function log(){
        return $this->belongsTo('App\Models\StatusLog', 'statuslog_id');
    }
}
