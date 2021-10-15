<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'author_id',
        'rated_id',
    ];

    public function ownerReview(){
        return $this->belongsTo('App\Models\User', 'author_id', 'id');
    }

    public function ratedReview(){
        return $this->belongsTo('App\Models\User', 'rated_id', 'id');
    }
}
