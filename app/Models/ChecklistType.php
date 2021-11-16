<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistType extends Model
{
    use HasFactory;

    protected $table = 'checklist_types';

    protected $fillable = [
        'title'
    ];

    public function checklist(){
        return $this->hasMany('App\Models\Checklist', 'type_id', 'id');
    }

    public function items(){
        return $this->hasMany('App\Models\ChecklistItem', 'type_id', 'id');
    }


}
