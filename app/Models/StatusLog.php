<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'title',
        'type',
        'user_id',
        'color',
        'attend_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function attend(){
        return $this->belongsTo('App\Models\Attend', 'attend_id');
    }

    public function img(){
        return $this->hasMany('App\Models\ImgLog', 'statuslog_id');
    }

}
