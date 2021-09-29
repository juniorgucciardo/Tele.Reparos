@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Edite um status</h4>
@stop

@section('content')

    <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edite um tipo</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('type.edit', $type->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo do tipo</label>
                  <input type="text" name="type_title" class="form-control" id="exempleImputServiceTitle" value="{{ $type->type_title }}">
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