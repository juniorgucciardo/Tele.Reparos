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
    </style>

    <div class="preloader">
        <div class="card-info conteudo-preloader">
            <img width="150px" height="150px" src="/img/brand.png" alt="">
        </div>
    </div>

    {{-- SCRIPT CALENDARIO --}}

    <script src="/js/calendar.js"></script> 





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
                      $query = $service_demands->where('status_id', 1);
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
            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

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
            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

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
            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Serviços em andamento agora</span>
              <span class="info-box-number">
                @php
                    $query = $service_demands->where('status_id', 3)->where('data_ordem', $firstdate);
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
            <div class="card card-info">
                <div class="card-header">
                  <span style="text-color: #fff; font-weight:600">Atividades em andamento hoje, {{date('d/m', strtotime($firstdate));}} <button type="button" class="mx-1 btn btn-outline-light shadow-md" data-toggle="modal" data-target="#osDetails" data-whatever="@getbootstrap">Ver tudo</button></span>
                </div>
                <div class="card-body servicesNow">
                    {{-- laço dos cards --}}
                  @foreach ($attends->whereBetween('data_inicial', ['2021-09-30 08:00:00', '2021-09-30 18:00:00']) as $attend)
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
                                                <span class="badge badge-info">{{$name[0]}}</span>
                                              @endforeach
                                              
                                          </div>
                                      </div>
                                  </div>
                                  <div class="ml-auto flex-column">
                                      
                                      <span>{{$attend->orders->status->status_title}}</span>
                                      <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#statusModal{{$attend->orders->id}}" data-whatever="@getbootstrap"><i class="fas fa-stopwatch"></i></button>
                                      @include('admin.pages.modal.status-modal')
                                      <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#osDetails{{$attend->orders->id}}" data-whatever="@getbootstrap"><i class="fas fa-info-circle"></i></button>
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
            
            <div class="card-info shadow-xs bg-light">
                <div class="card-header">
                    Calendário

                    <button type="button" class="mx-1 btn btn-outline-light shadow-md" data-toggle="modal" data-target="#osDetails" data-whatever="@getbootstrap"><i class="fas fa-plus-square"></i> Cadastrar</button>

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
            $d1 = Carbon\Carbon::now()->format('Y-m-d');
            $d2 = date('y-m-d', strtotime($firstdate. ' + 7 days')); //gerar data somando 7 dias da data atual
            @endphp
            <span style="text-color: #fff; font-weight:600">Agendados para esta semana, de {{date('d/m', strtotime($d1))}}, até {{date('d/m', strtotime($d2))}}</span>
        </div>
        <div class="card-body">
         <div class="row">
              @foreach ($service_demands->sortBy('data_ordem')->where('status_id', 2)->whereBetween('data_ordem', [$d1, $d2]) as $order)
                  <div class="col-md-3 col-sm-6 col-6">
                      {{-- card start --}}
                      <div class="card card-outline card-success shadow p-3 mb-5 bg-white rounded">
                          <div class="card-header">
                              <div class="row">
                                  <span class="d-flex flex justify-content-between">
                                      {{$order->service->service_title}} - 
                                  </span>
                                  <span>
                                    {{$order->type->type_title}}
                                  </span>
                                  
                              </div>
                          </div>
                          <div class="card-body">
                              
                                      <div class="row">
                                        <span>
                                            <i class="far fa-user-circle"></i> {{$order->nome_cliente}}
                                        </span>
                                      </div>
                                      <div class="row">
                                          @php
                                          $data = date('d/m', strtotime($order->data_ordem));
                                          $hora = date('h:m:s', strtotime($order->hora_ordem));
                                          @endphp
                                          <span>Data: {{$data}}</span>
                                          <span>  -  Hora: {{$hora}}</span>

                                      </div>
                                      <div class="row">
                                        @foreach ($order->user as $user)
                                        @php
                                            $name = explode(' ', $user->name);
                                        @endphp
                                        <span>{{$name[0]}}
                                            @php
                                                if($loop->last){
                                                    echo ' ';

                                                } else {
                                                    echo ' - ';
                                                }
                                            @endphp
                                        </span>
                                        @endforeach
                                      </div>
                             
                          </div>
                          
                              <button type="button" class="btn btn-outline-success">detalhes</button>
                              <button type="button" class="btn btn-outline-success my-2">Alterar</button>
                              <button type="button" class="btn btn-outline-success">Imprimir</button>
                          
                      </div>
                  </div>
              @endforeach
         </div>
        </div>
    </div>
    <div class="card-info">
        <div class="card card-info">
            <div class="card-header">
                <span style="text-color: #fff; font-weight:600">Serviços solicitados</span>
            </div>
            <div class="card-body">
             <div class="row">
                  @foreach ($service_demands->sortByDesc('data_ordem')->where('status_id', 1) as $order)

                      <div class="col-md-6 col-sm-6 col-12">
                          <div class="card card-outline card-info shadow p-3 mb-5 bg-white rounded">
                              <div class="card-header">
                                  <div class="row text-center">
                                      <span class="mr-auto">
                                        <i class="fas fa-tools"></i> {{$order->service->service_title}}
                                      </span>
                                    </div>
                                    <div class="row text-center">
                                      <span class="mr-auto">Prestador: 
                                        @foreach ($order->user as $user)
                                        @php
                                            $name = explode(' ', $user->name);
                                        @endphp
                                        <span>{{$name[0]}}
                                            @php
                                                if($loop->last){
                                                    echo ' ';

                                                } else {
                                                    echo ' - ';
                                                }
                                            @endphp
                                        </span>
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
                                    @include('admin.pages.send-modal')

                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
             </div>
            </div>
    </div>



@stop
