@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h5>
    <i class="fas fa-calendar"></i>
    Calendário
  </h5>
@stop

@section('content')
<script src="/js/calendarFiltered.js"></script>


            
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
      <form action="{{ route('attend.calendar') }}" method="GET">
        @csrf
          <div class="row">
              <div class="col-md-1">
                  <input type="text" id="id" class="form-control" placeholder="Id">
                </div>
            <div class="col-md-3">
              <select class="form-control" aria-placeholder="Tipo">
                  <option selected disabled>Tipo de OS:</option>
                  <option>Avulsos</option>
                  <option>Contratos</option>
                  <option>Pós Obra</option>
                  <option>Condomínio</option>
                  <option>Seguradora</option>
                </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" aria-placeholder="Serviço">
                  <option selected disabled>Serviço:</option>
                  <option>Jardinagem</option>
                  <option>Piscina</option>
                  <option>Elétrica/hidraulica</option>
                  <option>Condomínio</option>
                  <option>Seguradora</option>
                </select>
            </div>
            <div class="col-md-3">
              <select multiple class="selectpicker form-control" title="Funcionário:" data-live-search="true">
                  <option>Jardinagem</option>
                  <option>Piscina</option>
                  <option>Elétrica/hidraulica</option>
                  <option>Condomínio</option>
                  <option>Seguradora</option>
                </select>
            </div>
            <div class="col-md-3">
              <input type="date" class="form-control" placeholder="Data">
            </div>
            <button type="submit" class="btn btn-primary my-2">Pesquisar</button>
          </form>
          </div>
  </div>
  <!-- /.card-body -->
</div>
            <div id="calendar" width="100%"></div>
        


@stop