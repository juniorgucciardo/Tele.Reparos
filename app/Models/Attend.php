<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;

    protected $table = 'attends';

    public function orders(){
        return $this->belongsTo('App\Models', 'order_id');
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'attend_user', 'attend_id', 'user_id');
    }
}
