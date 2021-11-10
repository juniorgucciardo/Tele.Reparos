
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-file-contract mx-1"></i>
    Serviços
  </h4>
@stop

@section('content')
<style>


    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        .tableDashboard tr{
        display: flex;
        flex-direction: column;
    }

    .tableDashboard thead{
        display: none;
    }
    .status-badge{
        text-align: left;
    }
    .cliente{
        font-weight: 600;
        font-size: 1.2rem
    }
    }

    
</style>

<div class="row">

    {{-- solicitações --}}
<div class="col-md-3 col-sm-6 col-12">
<div class="info-box">
<span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
<div class="info-box-content">
<span class="info-box-text">Contratos de serviços</span>
<span class="info-box-number">
{{$contracts}}
</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->


<div class="col-md-3 col-sm-6 col-12">
<div class="info-box">
<span class="info-box-icon bg-primary"><i class="fas fa-shield-alt"></i></span>

<div class="info-box-content">
<span class="info-box-text">Serviços de seguradoras</span>
<span class="info-box-number">{{$insuranceCount}}</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->


<div class="col-md-3 col-sm-6 col-12">
<div class="info-box">
<span class="info-box-icon bg-info"><i class="fas fa-building"></i></span>

<div class="info-box-content">
<span class="info-box-text">Condomínios atendidos</span>
<span class="info-box-number">{{$condominiumCount}}</span>
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
<span class="info-box-text">Serviços avulsos</span>
<span class="info-box-number">{{$looseCount}}</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
</div>



<div class="card card-info">
    <div class="card-header">
        Solicitações de serviços
    </div>
    <div class="card-body">
        <div class="row d-flex">
            @foreach ($ordersSolicited as $solicited)
                @include('components.solicitation-card', $solicited)
            @endforeach
        </div>
    </div>
</div>




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
        <form action="{{ route('OS')}}" method="GET">
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
              <div class="col-md-1">
                <input name="cliente" type="text" id="id" class="form-control" placeholder="cliente">
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
            Contratos
        </div>
        <div class="card-body">
                <table id="table" class="table table-striped tableDashboard">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Atividade</th>
                            <th>Tipo</th>
                            <th>Cidade</th>
                            <th>Situação</th>
                            <th>Recorrencia</th>
                            <th>Atendimentos do contrato</th>
                             @can('view_service_demands')
                                <th> Funções </th>
                            @endcan
                        </tr>
                    </thead>
                    @php
                   @endphp
                    <tbody>
                       @foreach ($service_orders as $order)
                       @php
                        switch ($order->situation_id) {
                            case '1': //solicitado
                                $statusColor = 'warning';
                                break;
                            case '2': //avaliação
                                $statusColor = 'info';
                                break;
                            case '3': //execução
                                $statusColor = 'success';
                                break;
                            case '4': //cancelado
                                $statusColor = 'danger';
                                break;
                            default:
                                $statusColor = 'secondary';
                                break;
                            }
                    @endphp
                        <tr>
                            <td class="cliente"><a href="{{ route('OS.contract', $order->id) }}">{{ $order->nome_cliente }}</a></td>
                            <td>{{ $order->service->service_title}}</td>
                            <td>{{$order->type->type_title}}</td>                           
                            <td>{{ $order->cidade_cliente }}</td>
                            <td><div class="badge badge-{{$statusColor}} p-2">{{ $order->situation->title }}</div></td>
                            <td>{{ $order->recurrence}} dias</td>
                            <td>{{$order->attends_count}}</td>
                            @can('view_service_demands')
                            <td>
                                <div class="btn-group">
                                    <a href="{{url("admin/detalhes-contrato/$order->id")}}">
                                        <button class="btn-sm btn-warning">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                        <a href="{{url("admin/OS/editar/$order->id")}}">
                                            <button class="mx-1 btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('OS.destroy', $order->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger" type="submit">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                </div>
                                </td>
                            @endcan
                        </tr>
                       @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@stop