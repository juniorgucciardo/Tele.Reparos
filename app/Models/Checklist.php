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
        'user_id',
        'service_id',
        'contract_type_id'
    ];

    protected $with = ['items', 'type'];

    // RELACIONAMENTOS  //

    public function items()
    {
        return $this->hasMany('App\Models\ChecklistItem', 'checklist_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\service_order', 'order_id');
    }

    public function attend()
    {
        return $this->belongsTo('App\Models\Attend', 'attend_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ChecklistType', 'type_id', 'id');
    }

    public function checklistByOS($id){
        return $this->where('order_id', $id);
    }

    public function checklistByAttend($id){
        return $this->where('attend_id', $id);
    }

    public function checklistsByService($id){
        return $this->where('service_id', $id);
    }

    public function scopeChecklistDefault($query)
    {
        return $query->where('order_id', NULL);
    }

    public function checklistModel()
    {
        return $this->where('order_id', NULL)
                    ->where('attend_id', NULL);
    }

    public function scopeActivities($query)
    {
        return $query->where('type_id', 1);
    }

    public function scopeProducts($query)
    {
        return $query->where('type_id', 2);
    }


    public function scopeIpis($query)
    {
        return $query->where('type_id', 3);
    }

    public function scopeGeneral($query)
    {
        return $query->where('type_id', '>', 1);
    }

}
