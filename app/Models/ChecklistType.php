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
        return $this->hasMany('App\Models\Checklist', 'contract_type_id', 'id');
    }



}
