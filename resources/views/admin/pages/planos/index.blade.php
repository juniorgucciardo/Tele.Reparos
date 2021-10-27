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


                @foreach ($service_demands->sortByDesc('data_ordem') as $attend)
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
                                      <a href="{{ route('attend.show', $attend->id) }}"><span title="Visualizar informações deste serviço"><i class=" fas fa-eye"></i></span></a>
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
                                                <a  @can('view_service_demands')
                                                        href="{{route('user.view', $user->id)}}"
                                                    @endcan
                                                ><span class="badge badge-{{$statusColor}}" @can('view_service_demands')
                                                title="Visualizar prestador"
                                                @endcan>{{$name[0]}}</span></a>
                                              @endforeach
                                              
                                          </div>
                                      </div>
                                  </div>
                                  <div class="ml-auto flex-column">
                                      
                                      <span class="bg-gradient-{{$statusColor}} rounded px-1">{{mb_strimwidth($attend->status->status_title, 0, 16, "...")}}</span>
                                      <div class="btn-group">
                                        <button type="button" class="btn-sm btn-outline-{{$statusColor}} rounded" data-toggle="modal" data-target="#statusModal{{$attend->id}}" title="Alterar prestador e status" data-whatever="@getbootstrap"><i class="fas fa-stopwatch"></i></button>
                                        @include('admin.pages.modal.status-modal')
                                        @can('view_service_demands')
                                            <a class="btn-sm btn-outline-{{$statusColor}} rounded"  href="{{route('attend.edit', $attend->id)}}" title="Editar Registro"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        <a class="btn-sm btn-outline-{{$statusColor}} rounded"  href="{{ route('OS.contract', $attend->orders->id) }}" title="Informações desse atendimento"><i class="fas fa-info"></i></a>
                                      </div>
                                      


                                  </div>
                              </div>
                          </div>
                      </div>
                  
            @endforeach


            </div>
        </div>
    </div>
          


@stop