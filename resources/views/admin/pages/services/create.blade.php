@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nossos serviços - TeleREPAROS</h1>
@stop

@section('content')

    <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cadastre um novo serviço no sistema</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('service.create') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo do Serviço</label>
                  <input type="text" name="service_title" class="form-control" id="exempleImputServiceTitle" placeholder="Titulo do Serviço">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Descrição do Serviço</label>
                  <input type="text" name="service_description" class="form-control" id="exempleImputServiceDescription" placeholder="Descrição do Serviço">
                </div>
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a class="btn btn-secondary" href="{{ route('service'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

@stop