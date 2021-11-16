<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $table = 'checklist_items';

    protected $fillable = [
        'title',
        'is_concluted',
        'checklist_id',
        'concluted_at',
        'concluted_by',
        'type_id',
    ];

    protected $dates = [
        'concluted_at'
    ];

    public function checklist(){
        return $this->belongsTo('App\Models\Checklist', 'checklist_id');
    }

    public function conclutedBy(){
        return $this->belongsTo('App\Models\User', 'concluted_by');
    }

    public function type(){
        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }
}
