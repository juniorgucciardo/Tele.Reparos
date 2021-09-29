@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Edite um status</h4>
@stop

@section('content')

    <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cadastre um novo status no sistema</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('status.edit', $status->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo do Status</label>
                  <input type="text" name="status_title" class="form-control" id="exempleImputServiceTitle" value="{{ $status->status_title }}">
                </div>
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a class="btn btn-secondary" href="{{ route('status'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

@stop