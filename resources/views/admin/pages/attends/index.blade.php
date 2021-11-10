
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h5><i class="fas fa-calendar"></i> Calendario de atendimentos</h5>
@stop

@section('content')

<div class="card card-secondary">
    <div class="card-header">
        
          <h3 class="card-title"> Filtros</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body" style="display: block;">
        <form action="{{ route('attend')}}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-1">
                    <input name="id" type="text" id="id" class="form-control" placeholder="Id">
                  </div>
              <div class="col-md-3">
                <select name="tipo" class="form-control" aria-placeholder="Tipo">
                    <option selected disabled>Tipo de OS:</option>
                    <option value="1">Avulsos</option>
                    <option value="2">Contratos</option>
                    <option value="3">Pós Obra</option>
                    <option value="4">Condomínio</option>
                    <option value="5">Seguradora</option>
                  </select>
              </div>
              <div class="col-md-2">
                <select name="servico" class="form-control" aria-placeholder="Serviço">
                    <option selected disabled>Serviço:</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->service_title }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-md-3">
                <select name="situacao" class="form-control" aria-placeholder="Situação">
                    <option selected disabled>Situação:</option>
                    @foreach ($situations as $situation)
                        <option value="{{$situation->id}}">{{$situation->title}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-md-3">
                <input type="date" name="data" class="form-control" placeholder="Data">
              </div>
            </div>
            <button type="submit" class="btn btn-primary my-2">Pesquisar</button>
        </form>
    </div>
    <!-- /.card-body -->
  </div>


    <div class="card card-info">
        <div class="card-header">
            <i class="fas fa-history"></i> Histórico de Atendimentos
        </div>
        <div class="card-body">

                
                        <div class="table-responsive">
                            <table id="table" width="100%" class="table display nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Data</th>
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
                                            - 
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
                {!! $attends->links() !!}
            </div>

        </div>
    </div>
@stop