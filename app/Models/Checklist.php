<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';

    protected $fillable = [
        'title',
        'order_id',
        'attend_id',
        'type_id',
        'user_id'
    ];

    // RELACIONAMENTOS  //

    public function items()
    {
        return $this->hasMany('App\Models\Checklist', 'checklist_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\service_order', 'order_id', 'id');
    }

    public function attend()
    {
        return $this->belongsTo('App\Models\Attend', 'attend_id', 'id');
    }

    

}
