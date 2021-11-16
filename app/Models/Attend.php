<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attend extends Model
{
    use HasFactory;

    protected $table = 'attends';

    protected $fillable = [
        'id',
        'data_inicial',
        'data_final',
        'order_id',
        'status_id'
    ];

    protected $dates = [
        'data_inicial',
        'data_final',
        'created_at',
        'updated_at'
    ];

    public function orders(){
        return $this->belongsTo('App\Models\service_order', 'order_id');
    }


    public function checklists(){
        return $this->hasMany('App\Models\Checklist', 'checklist_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'attend_user');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }

    public function statusLogs(){
        return $this->hasMany('App\Models\StatusLog', 'attend_id');
    }

    public function search($request){
        $attends = $this
        ->attendsForExecute()
        ->attendsPast()
        ->where(function($query) use($request){
            if($request->id){
                $query->where('id', $request->id);
            }
            if($request->tipo){
                $query->whereHas('orders', function($q) use($request){
                    $q->where('type_id', $request->tipo);
                });
            }
            if($request->servico){
                $query->whereHas('orders', function($q) use($request){
                    $q->where('id_service', $request->servico);
                });
            }
            if($request->situacao){
                $query->whereHas('orders', function($q) use($request){
                    $q->where('situation_id', $request->situacao);
                });
            }
            if($request->data){
                $query->whereDate('data_inicial', $request->data);
            }
        })
        ->with('orders');

        return $attends;
    }

    //////////// CUSTOM QUERIES /////////////

    public function attendInExecution($id){
        return $this->attendsForExecute()
                    ->where('order_id', $id)
                    ->where('status', 3);
    }

    public function attendsByAtualDay(){
        return $this->attendsForExecute()
                    ->whereDate('data_inicial', Carbon::now()->format('Y-m-d'))
                    ->with('users', 'orders.service', 'orders.type', 'status');
    }

    public function attendsByAtualDayByUser($id){
        return $this->whereHas('users', function($query) use($id){
              $query->where('user_id', $id); })
                    ->attendsForExecute()
                    ->whereDate('data_inicial', Carbon::now()->format('Y-m-d'));
    }

    public function attendsConclutedById(){
        return $this->attendsForExecute()
                    ->attendsPast();
    }

    public function attendsHistory(){
        return $this->attendsForExecute()
                    ->attendsPast()
                    ->with('users', 'orders.service', 'orders.type', 'status');
    }

    public function nextAttends(){
        return $this->attendsForExecute()
                    ->attendsFuture()
                    ->whereBetween('data_inicial', [Carbon::now()->format('Y-m-d'), date('Y-m-d', strtotime(Carbon::now()->format('Y-m-d'). '+7 days'))])
                    ->with('users', 'orders.service', 'orders.type', 'status');
    }

    
    
    public function doneAttends(){
        return $this->attendsForExecute()
                    ->attendsPast()
                    ->where('status_id', 3)
                    ->with('users', 'orders.service', 'orders.type', 'status');
    }

    public function calendar(){
        return $this->attendsForExecute()
                    ->with('orders.service', 'orders.type');
    }

    public function calendarByUser($id){
        return $this->attendsForExecute()
                    ->attendsById($id)
                    ->with('orders.service', 'orders.type')
                    ->get();
    }

    public function lateAttends(){
        return $this->attendsForExecute()
                    ->attendsPast()
                    ->where('status_id', ['1, 2']);
    }


    //////////////////// ESCOPOS ////////////////////////

    public function scopeAttendsForExecute($query){
        return $query->whereHas('orders', function($q){
                   $q->where('situation_id', 3);});
    }

    //RETORNAR TODOS OS ATENDIMENTOS PASSADOS
    public function scopeAttendsPast($query){ 
        return $query->where('data_inicial', '<', Carbon::now()->format('Y-m-d 00:00:00'));
    }

    public function scopeAttendsById($query, $id){
        return $this->whereHas('users', function($q) use($id){
            $q->where('user_id', $id);
        });
    }

    //RETORNA TODOS OS ATENDIMENTOS FUTUROS
    public function scopeAttendsFuture($query){
        return $query->where('data_inicial', '>', Carbon::now()->format('Y-m-d 23:59:59'));
    }


    //exibir apenas um atendimento
    public function scopeAttendShow($query, $id){
        return $query->where('id', $id)
                     ->with('statusLogs.user', 'statusLogs.img')
                     ->with('users')
                     ->with('orders')
                     ->with('orders.service');
    }

    
}
