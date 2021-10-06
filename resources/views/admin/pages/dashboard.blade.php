@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
@php
    $hora = Carbon\Carbon::now()->format('H');
    $firstdate = Carbon\Carbon::now()->format('Y-m-d');
    $seconddate = date('y-m-d', strtotime($firstdate. ' + 2 days'));
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





    {{-- PRELOADER --}}
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
        
        .servicesNow{
            height: 600px;
            overflow: scroll;
        }

        .servicosAgendados{
            display: flex;
            flex-wrap: unset;
            max-height: 375px;
            overflow-x: scroll;
        }


    </style>

    <div class="preloader">
        <div class="card-info conteudo-preloader">
            <img width="150px" height="150px" src="/img/brand.png" alt="">
        </div>
    </div>

    {{-- SCRIPT CALENDARIO --}}

    <script src="/js/calendar.js"></script> 
    @include('admin.pages.modal.eventDetails')





     {{-- RESUMO --}}

     <div class="absolute">

     </div>
     
     <div class="row">

                    {{-- solicitações --}}
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Solicitações de Atendimento</span>
              <span class="info-box-number">
                  @php
                      $query = $service_demands;
                    echo count($query);
                  @endphp
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="far fa-flag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Atendimentos finalizados</span>
              <span class="info-box-number">95 *ultimos quinze dias</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Novos contratos assinados</span>
              <span class="info-box-number">12 *ultimos quinze dias</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="far fa-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Serviços em andamento agora</span>
              <span class="info-box-number">
                @php
                    $query = $service_demands->where('data_ordem', $firstdate);
                    echo count($query);
                @endphp
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">

        {{-- ATIVIDADES EM ANDAMENTO AGORA --}}

        <div class="col-md-4 col-sm-12 col-12">
            <div class="card card-info shadow-sm">
                <div class="card-header">
                  <span style="text-color: #fff; font-weight:600">Atividades em andamento hoje, {{date('d/m', strtotime($firstdate));}} 
                    <a href="/admin/atendimentos"><button type="button" class="mx-1 btn-sm btn-outline-light shadow-md" data-toggle="modal" data-target="#osDetails" data-whatever="@getbootstrap"><span><i class=" fas fa-eye mx-1"></i></span>Ver tudo</button></span></a>
                </div>
                <div class="card-body servicesNow">
                    {{-- laço dos cards --}}
                    @php
                        $d1 = date('Y-m-d H:i:s', strtotime(Carbon\Carbon::now()->format('Y-m-d'). '01:00:00'));
                        $d2 = date('Y-m-d H:i:s', strtotime(Carbon\Carbon::now()->format('Y-m-d'). '18:00:00'));
                    @endphp

                  @foreach ($attends->whereBetween('data_inicial', [$d1, $d2]) as $attend)
                  
                    {{-- CARD DAS DEMANDAS DE HOJE --}}
                      <div class="card card-outline card-info shadow rounded">
                          <div class="card-header">
                              <div class="d-flex d-flex-row justify-content-between">
                                  <span>{{$attend->orders->service->service_title}}</span>
                                  <div>
                                      <span class="mx-3">{{explode(' ', $attend->data_inicial)[1]}}</span>
                                      <span><i class=" fas fa-eye"></i></span>
                                  </div>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="d-flex d-flex-row justify-content-between">
                                  <div class="mr-auto flex-column w-100">
                                      <div>
                                          Cliente: <span>{{mb_strimwidth($attend->orders->nome_cliente, 0, 16, "...")}}</span>
                                      </div>
                                      <div>
                                          <div class="flex-row">  
                                              @foreach ($attend->users as $user)
                                                @php
                                                    $name = explode(' ', $user->name);
                                                @endphp
                                                <a href="{{route('user.view', $user->id)}}"><span class="badge badge-info">{{$name[0]}}</span></a>
                                              @endforeach
                                              
                                          </div>
                                      </div>
                                  </div>
                                  <div class="ml-auto flex-column">
                                      
                                      <span></span>
                                      <button type="button" class="btn-sm btn-outline-info rounded" data-toggle="modal" data-target="#statusModal{{$attend->orders->id}}" data-whatever="@getbootstrap"><i class="fas fa-stopwatch"></i></button>
                                    
                                      <button type="button" class="btn-sm btn-outline-info rounded" data-toggle="modal" data-target="#osDetails{{$attend->orders->id}}" data-whatever="@getbootstrap"><i class="fas fa-info-circle"></i></button>
                                      @include('admin.pages.modal.osDetails')


                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach

                </div>
            </div>
        </div>


        {{-- CALENDARIO --}}


        <div class="col-md-8 col-sm-12 col-12">
            
            <div class="card-info shadow-sm bg-light">
                <div class="card-header">
                    Calendário 

                    <a href="/admin/atendimentos/novo"><button type="button" class="mx-1 btn-sm btn-outline-light shadow-md"><i class="fas fa-truck-moving mx-1"></i>Novo atendimento</button></a>
                    <a href="/admin/OS/novo"><button type="button" class="mx-1 btn-sm btn-outline-light shadow-md"><i class="fas fa-file-contract mx-1"></i>Novo contrato</button></a>

                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        {{--  --}}
    
      </div>

      <div class="card card-info">
        <div class="card-header">
            @php
            $d1 = Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $d2 = date('Y-m-d H:i:s', strtotime($firstdate. ' + 8 days')); //gerar data somando 7 dias da data atual
            @endphp
            <span style="text-color: #fff; font-weight:600">Agendados para esta semana, de {{date('d/m', strtotime($d1))}}, até {{date('d/m', strtotime($d2))}}</span>
        </div>
        <div class="card-body">
         <div class="row servicosAgendados">
              @foreach ($attends->sortBy('data_inicial')->whereBetween('data_inicial', [$d1, $d2]) as $attend)
                  <div class="col-md-3 col-sm-6 col-6">
                      {{-- card start --}}
                      @php
                        switch ($attend->orders->service->id) {
                            case '1': //jardinagem
                                $color = 'success';
                                break;
                            case '2': //eletrica hidraulica
                                $color = 'info';
                                break;
                            case '3': //residencial
                                $color = 'danger';
                                break;
                            case '4': //empresarial
                                $color = 'danger';
                                break;
                            case '5': //pós obra
                                $color = 'secundary';
                                break;
                            case '6': //pós obra
                                $color = 'navy';
                                break;
                            default:
                                echo 'primary';
                                break;
                            }

                        @endphp
                      <div class="card shadow ">
                          <div class="card-header text-center bg-{{$color}}">
                            {{$attend->orders->service->service_title}}         
                          </div>
                          <div class="card-body p-4">
                              
                            <div class="row">
                                <span>
                                    <i class="far fa-user-circle mx-1"></i> {{$attend->orders->nome_cliente}}
                                </span>
                            </div>
                            <div class="row"> 
                                @php
                                    $data = date('d/m', strtotime($attend->data_inicial));
                                    $hora = date('h:m:s', strtotime($attend->orders->hora_ordem));
                                    @endphp
                                    <span>Data: {{$data}}</span>
                                    <span>Hora: {{$hora}}</span>

                            </div>
                            <div class="row">
                                @foreach ($attend->users as $user)
                                    @php
                                        $name = explode(' ', $user->name);
                                    @endphp
                                    <a href="{{route('user.view', $user->id)}}"><span class="badge badge-{{$color}} mr-1 my-1">{{$name[0]}}</span></a>
                                @endforeach
                            </div>
                             
                          </div>
                          <div class="card-footer text-left">
                                <a href="{{url("admin/atendimentos/$attend->id")}}"><button type="button" class="btn-sm btn-outline-{{$color}}">Ver</button></a>
                                <button type="button" class="btn-sm btn-outline-{{$color}} my-2">Alterar</button>
                                <button type="button" class="btn-sm btn-outline-{{$color}}">Excluir</button>
                          </div>
                          
                      </div>
                  </div>
              @endforeach
         </div>
        </div>
    </div>
    <div class="card-info">
        <div class="card card-info servicosAgendados">
            <div class="card-header">
                <span style="text-color: #fff; font-weight:600">Serviços solicitados</span>
            </div>
            <div class="card-body">
             <div class="row">
                  @foreach ($service_demands->sortByDesc('data_ordem') as $order)

                      <div class="col-md-6 col-sm-6 col-12">
                          
                          <div class="card card-outline card-info shadow p-3 mb-5 bg-white rounded">
                              <div class="card-header">
                                  <div class="row text-center">
                                      <span>
                                        <i class="fas fa-tools mx-2"></i> {{$order->service->service_title}}
                                      </span>
                                    </div>
                                    <div class="row text-center">
                                      <span class="mr-auto">Prestador: 
                                        @foreach ($order->user as $user)
                                        @php
                                            $name = explode(' ', $user->name);
                                        @endphp
                                        <a href="{{route('user.view', $user->id)}}"><span>{{$name[0]}}
                                            @php
                                                if($loop->last){
                                                    echo ' ';

                                                } else {
                                                    echo ' - ';
                                                }
                                            @endphp
                                        </span></a>
                                        @endforeach
                                      </span>
                                  </div>
                              </div>
                                <div class="card-body">
                                    <div class="row">
                                        <span>
                                            <i class="far fa-user-circle"></i> 
                                            {{$order->nome_cliente}}
                                        </span>
                                    </div>
                                <div class="row">
                                    @php
                                        $data = date('d/m', strtotime($order->data_ordem));
                                        $hora = date('h:m:s', strtotime($order->hora_ordem));
                                    @endphp
                                    <span>Data:  {{$data}} - </span><br/>
                                    <span> Hora:  {{$hora}} </span>
                                </div>
                              </div>
                              <div class="card-footer">
                                  <div class="row">
                                    <button type="button" class="btn btn-info">Mais detalhes</button>
                                  </div>
                                  <div class="row my-2">
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal{{$order->id}}" data-whatever="@getbootstrap"><i class="far fa-paper-plane"></i> Encaminhar ao prestador</button>
                                    @include('admin.pages.modal.send-modal')

                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
             </div>
            </div>
    </div>
@stop
