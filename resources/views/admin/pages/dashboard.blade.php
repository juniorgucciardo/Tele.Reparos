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
            height: 700px;
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

                  @foreach ($attendsNow->whereBetween('data_inicial', [$d1, $d2]) as $attend)
                  
                    {{-- CARD DAS DEMANDAS DE HOJE --}}

                    @php
                        switch ($attend->status->id) {
                            case '1': //solicitado
                                $statusColor = 'secondary';
                                break;
                            case '2': //agendado
                                $statusColor = 'info';
                                break;
                            case '3': //execução
                                $statusColor = 'primary';
                                break;
                            case '4': //concluido
                                $statusColor = 'success';
                                break;
                            case '5': //atrasado
                                $statusColor = 'warning';
                                break;
                            case '6': //cancelado
                                $statusColor = 'danger';
                                break;
                            default:
                                $statusColor = 'primary';
                                break;
                            }
                    @endphp
                      <div class="card card-outline card-{{$statusColor}} shadow rounded">
                          <div class="card-header">
                              <div class="d-flex d-flex-row justify-content-between">
                                  <span>{{$attend->orders->service->service_title}}</span>
                                  <div>
                                      @php
                                          $hora = explode(' ', $attend->data_inicial)[1];
                                      @endphp
                                      <span class="mx-3">{{date('H:i', strtotime($hora))}}</span>
                                      <a href="{{ route('OS.contract', $attend->orders->id) }}"><span><i class=" fas fa-eye"></i></span></a>
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
                                                <a href="{{route('user.view', $user->id)}}"><span class="badge badge-{{$statusColor}}">{{$name[0]}}</span></a>
                                              @endforeach
                                              
                                          </div>
                                      </div>
                                  </div>
                                  <div class="ml-auto flex-column">
                                      
                                      <span class="bg-gradient-{{$statusColor}} rounded px-1">{{mb_strimwidth($attend->status->status_title, 0, 16, "...")}}</span>
                                      <button type="button" class="btn-sm btn-outline-{{$statusColor}} rounded" data-toggle="modal" data-target="#statusModal{{$attend->id}}" data-whatever="@getbootstrap"><i class="fas fa-stopwatch"></i></button>
                                      @include('admin.pages.modal.status-modal')
                                      <button type="button" class="btn-sm btn-outline-{{$statusColor}} rounded" data-toggle="modal" data-target="#osDetails{{$attend->orders->id}}" data-whatever="@getbootstrap"><i class="fas fa-info-circle"></i></button>
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
                    <a href="{{route('OS.create')}}"><button type="button" class="mx-1 btn-sm btn-outline-light shadow-md"><i class="fas fa-truck-moving mx-1"></i>Novo Atendimento</button></a>
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
              @foreach ($attendsNow->sortBy('data_inicial')->whereBetween('data_inicial', [$d1, $d2]) as $attend)
                  <div class="col-md-3 col-sm-6 col-6">
                      {{-- card start --}}
                      @php
                        switch ($attend->orders->service->id) {
                            case '1': //jardinagem
                                $color = 'teal';
                                break;
                            case '2': //eletrica hidraulica
                                $color = 'info';
                                break;
                            case '3': //residencial
                                $color = 'orange';
                                break;
                            case '4': //empresarial
                                $color = 'indigo';
                                break;
                            case '5': //pós obra
                                $color = 'lightblue';
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
                                    $hora = date('h:i', strtotime($attend->orders->hora_ordem));
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
                                <a href="{{route('OS.contract', $attend->orders->id)}}"><button type="button" class="btn-sm btn-outline-{{$color}}">Ver</button></a>
                                <a href="{{route('attend.edit', $attend->id)}}"><button type="button" class="btn-sm btn-outline-{{$color}} my-2">Alterar</button></a>
                                <button type="button" class="btn-sm btn-outline-{{$color}}">Excluir</button>
                          </div>
                          
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
             <div class="row servicosAgendados">
                  @foreach ($ordersSolicited->sortByDesc('data_ordem') as $solicited)

                      <div class="col-md-4 col-12">
                          
                          <div class="card card-outline card-info shadow p-3 mb-5 bg-white rounded">
                              <div class="card-header">
                                  <div class="row text-center">
                                      <span>
                                        <i class="fas fa-tools mx-2"></i> {{$solicited->service->service_title}}
                                      </span>
                                    </div>
                              </div>
                                <div class="card-body">
                                    <div class="row">
                                        <span>
                                            <i class="far fa-user-circle"></i> 
                                            {{$solicited->nome_cliente}}
                                        </span>
                                    </div>
                                <div class="row">
                                    @php
                                        $data = date('d/m', strtotime($solicited->data_ordem));
                                        $hora = date('h:i', strtotime($solicited->hora_ordem));
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
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal{{$solicited->id}}" data-whatever="@getbootstrap"><i class="far fa-paper-plane"></i> Encaminhar ao prestador</button>

                                  </div>
                              </div>
                          </div>


                      </div>
                  @endforeach
             </div>
        </div>
    </div>
    </div>

@stop
