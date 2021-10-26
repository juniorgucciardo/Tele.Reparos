<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'img_post',
        'user_id',
        'category',
    ];

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
