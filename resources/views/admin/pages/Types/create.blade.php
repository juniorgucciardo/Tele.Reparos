@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Inclua um novo status</h4>
@stop

@section('content')

    <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cadastre um novo status no sistema</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('type.create') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo do tipo</label>
                  <input type="text" name="type_title" class="form-control" id="exempleImputServiceTitle" placeholder="Titulo do Serviço">
                </div>
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a class="btn btn-secondary" href="{{ route('type'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

@stop