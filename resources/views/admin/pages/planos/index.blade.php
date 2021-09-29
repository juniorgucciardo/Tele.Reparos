@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@php
    $hora = Carbon\Carbon::now()->format('H')
@endphp
    <h4> 
        @if ($hora >= 06 && $hora <= 12)
            Bom dia,
        @endif
        @if ($hora >= 13 && $hora <= 18)
            Boa tarde,
        @endif
        @if ($hora >= 19 && $hora <= 24)
            Boa noite,
        @endif
        @if ($hora >= 00 && $hora <= 05)
            Boa madrugada,
        @endif
        {{($username)}}
    </h4>
@stop


@section('content')
    <style>
        .preloader{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .conteudo-preloader{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    
        
    </style>
    <div class="preloader">
        <div class="card-info conteudo-preloader">
            <h1>Tele</h1>
            <h1>REPAROS</h1>
        </div>
     </div>
     
    <div class="card card-info">
        <div class="card-header">
            <span class="title">
                Ordens de serviço do dia
            </span>
        </div>
        <div class="card-body">
            <div class="col-md-10 col-sm-0 col-12 mx-auto"> 


                @foreach ($service_demands->sortByDesc('data_ordem') as $order)
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <div class="row">
                            <span class="info-box-text">Cliente: {{ $order->nome_cliente }}</span>
                            <span> </span>
                            <span class="info-box-text ml-auto">Responsáveis: 
                                @php
                                    if(isset($order->user)){
                                    foreach ($order->user as $user){
                                        echo $user->name;
                                        echo '. ';
                                    }
                               }
                                @endphp
                            </span>
                          </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-1 col-sm-1 col-2"> 
                                <h1><i class="fas fa-seedling"></i></h1>
                            </div>
                            <div class="col-md-11 col-sm-11 col-10"> 
                                <div class="row">
                                    <span class="info-box-number">
                                        @php
                                        $data = date('d/m', strtotime($order->data_ordem));
                                        $hora = date('h:m', strtotime($order->hora_ordem));
                                        @endphp
                                        <span>Data: </span>{{$data}}
                                        <span> - Hora: </span>{{$hora}}
                                    </span>
                                </div>
                                <div class="row">
                                    <span>
                                        Endereço do cliente
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <button type="button" class="btn btn-outline-success">Mais detalhes</button>
                        </div>
                    </div>
                </div>
                  
            @endforeach


            </div>
        </div>
    </div>
          


@stop