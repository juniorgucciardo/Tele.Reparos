<?php

namespace App\Models;

use Database\Factories\service_orderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'nome_cliente',
        'rua_cliente',
        'numero_cliente',
        'bairro_cliente',
        'cidade_cliente',
        'contato_cliente',
        'descricao_servico',
        'id_service',
        'data_ordem',
        'hora_ordem',
        'status_id',
        'type_id',
        'recurrence',
        'months',
        'situation_id',
        'insurance',
        'insurance_cod',
        'duration'
    ];

    public function checklists(){
        return $this->hasMany('App\Models\Checklist', 'order_id', 'id');
    }

    public function service(){

        //ordem de serviço pertence a uma categoria de serviço
        return $this->belongsTo('App\Models\Service', 'id_service', 'id');
    }

    public function situation(){
        return $this->belongsTo('App\Models\Situation', 'situation_id', 'id');
    }

    public function attends(){

        //ordem de serviço possui varios atendimentos
        return $this->hasMany('App\Models\Attend', 'order_id');   
    }

    public function img_contract(){
        return $this->hasMany('App\Models\img_contract', 'contract_id', 'id');
    }


    public function user(){

        return $this->belongsToMany('App\Models\User', 'order_user', 'order_id', 'user_id');
    }

    public function type(){

        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }

    public function listOrders(){
        return $this->where('situation_id', 3)
                     ->with('user', 'type', 'service');
    }

    public function solicited(){
        return $this->ordersDemandads()
                    ->with('user', 'type', 'service');
    }

    public function search($request){
        $contracts = $this
        ->where(function($query) use($request){
            if($request->id){
                $query->where('id', $request->id);
            }
            if($request->tipo){
                $query->where('type_id', $request->tipo);
            }
            if($request->servico){
                $query->where('id_service', $request->servico);
            }
            if($request->cliente){
                $query->where('nome_cliente', 'like', '%'.$request->cliente.'%');
            }
            if($request->data_cadastro){
                $query->whereDate('created_at', $request->data_cadastro);
            }
            if($request->situacao){
                $query->where('situation_id', $request->situacao);
            }
        })
        ->with('user', 'type', 'service')
        ->get();


        return $contracts;
    }

    public function inExecutionNow($order){
        return $this->where('id', $order)
                    ->where('situation_id', 3)
                    ->get();

    }





    //////////////// ESCOPOS ////////////////
    
    public function scopeOrdersDemandads($query){
        return $query->where('situation_id', 1);
    }

    public function scopeOrdersCanceled($query){
        return $query->where('situation_id', 4);
    }

    public function scopeOrdersContracts($query){
        return $query->where('type_id', 2)
                     ->where('situation_id', 3);
    }

    public function scopeOrdersCondominium($query){
        return $query->where('type_id', 5)
                     ->where('situation_id', 3);
    }

    public function scopeOrdersInsurance($query){
        return $query->where('type_id', 4)
                     ->where('situation_id', 3);
    }

    public function scopeOrdersLoose($query){
        return $query->where('type_id', 1)
                     ->where('situation_id', 3);
    }

    public function scopeOrdersByService($query, $service_id){
        return $query->where('service_id', $service_id)->get();
    }


}
