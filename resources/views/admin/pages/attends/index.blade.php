
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-truck-moving mx-1"></i>
    Atendimentos
  </h4>
@stop

@section('content')


<style>
    .table{
        font-size: 0.86rem;
        table-layout: fixed;
        width:100%;
    }
    th{
        font-weight: 400;
    }
</style>

    <div class="card card-info">
        <div class="card-header">
            Informações
            @can('view_service_demands')
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn-sm btn-light"  ><i class="fas fa-info-circle mx-1"></i>Relatório geral</button></a>
            <a href="{{ route('attend.create') }}"><button type="button" class="mx-1 btn-sm btn-light"><i class="far fa-plus-square mx-1"></i>Novo atendimento de um contrato</button></a>
            @endcan
        </div>
        <div class="card-body">

                
                        <div class="table-responsive">
                            <table id="table" width="100%" class="table display nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>cliente</th>
                                        <th>Atividade</th>
                                        <th>Tipo</th>
                                        <th>Funcionário</th>
                                        <th>Status</th>
                                         @can('view_service_demands')
                                            <th>Funções</th>
                                        @endcan
                                    </tr>
                                </thead>
                                @php
                               @endphp
                                <tbody>
                                   @foreach ($attends as $attend)
                                    <tr>
                                        <td>{{ $attend->id}}</td>
                                        <td>
                                            @php
                                                $data = explode(' ', $attend->data_inicial)[0];
                                                $data = date('d/m/Y', strtotime($data));
                                            @endphp
                                            {{$data}}
                                        </td>
                                        <td>
                                            @php
                                                $hora = explode(' ', $attend->data_inicial)[1];
                                                $hora = date('H:i', strtotime($hora));
                                            @endphp
                                            {{$hora}}
                                        </td>
                                        <td><a href="{{ route('OS.contract', $attend->orders->id) }}">{{ $attend->orders->nome_cliente }}</a></td>
                                        <td>{{ $attend->orders->service->service_title }}</td>
                                        <td>{{$attend->orders->type->type_title}}</td>
                                        <td>
                                            @foreach ($attend->users as $user)
                                                @php
                                                    $name = explode(' ', $user->name)[0];
                                                @endphp
                                            <a href="{{ route('user.view', $user->id) }}"><span class="badge badge-primary">{{$name}}</span></a>
                                            @endforeach
                                        </td>
                                        <td>{{$attend->status->status_title}}</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('attend.show',$attend->id) }}">
                                                    <button class="btn-sm btn-warning">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </a>
                                                @can('view_service_demands')
                                                    <a href="{{url("admin/atendimentos/editar/$attend->id")}}">
                                                        <button class=" btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('attend.destroy', $attend->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn-sm btn-danger" type="submit">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                            </td>
                                        
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>

                        
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    Próximos atendimentos
                </div>
                <div class="card-body">
        
                        
                                <table id="table" width="100%" class="table display nowrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th>cliente</th>
                                            <th>Atividade</th>
                                            <th>Tipo</th>
                                            <th>Funcionário</th>
                                            <th>Status</th>
                                             @can('view_service_demands')
                                                <th>Funções</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    @php
                                   @endphp
                                    <tbody>
                                       @foreach ($attendsNext as $a)
                                        <tr>
                                            <td>{{ $a->id}}</td>
                                            <td>
                                                @php
                                                    $data = explode(' ', $a->data_inicial)[0];
                                                    $data = date('d/m/Y', strtotime($data));
                                                @endphp
                                                {{$data}}
                                            </td>
                                            <td>
                                                @php
                                                    $hora = explode(' ', $a->data_inicial)[1];
                                                    $hora = date('H:i', strtotime($hora));
                                                @endphp
                                                {{$hora}}
                                            </td>
                                            <td><a href="{{ route('OS.contract', $a->orders->id) }}">{{ $a->orders->nome_cliente }}</a></td>
                                            <td>{{ $a->orders->service->service_title }}</td>
                                            <td>{{$a->orders->type->type_title}}</td>
                                            <td>
                                                @foreach ($a->users as $user)
                                                    @php
                                                        $name = explode(' ', $user->name)[0];
                                                    @endphp
                                                <a href="{{ route('user.view', $user->id) }}"><span class="badge badge-primary">{{$name}}</span></a>
                                                @endforeach
                                            </td>
                                            <td>{{$a->status->status_title}}</td>
                                            
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('attend.show',$a->id) }}">
                                                        <button class="btn-sm btn-warning">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    @can('view_service_demands')
                                                        <a href="{{url("admin/atendimentos/editar/$a->id")}}">
                                                            <button class=" btn-sm btn-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <form action="{{ route('attend.destroy', $a->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn-sm btn-danger" type="submit">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                                </td>
                                            
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
        
                                
                        </div>
                    </div>

        </div>
    </div>
@stop