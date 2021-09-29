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
            <form action="{{ route('user.create') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <div class="row my-3">
                    <div class="col-md-6 col-12">
                      <label for="exampleInputEmail1">Nome</label>
                      <input type="text" name="name" class="form-control" id="exempleImputServiceTitle" placeholder="Titulo do Serviço">
                    </div>
  
                    <div class="col-md-6 col-12">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="text" name="email" class="form-control" id="exempleImputServiceDescription" placeholder="Descrição do Serviço">
                    </div>
                  </div>

                  <div class="row my-3">
                    <div class="col-md-4 col-12">
                      <label for="exampleInputPassword1">Senha</label>
                      <input type="text" name="password" class="form-control" id="exempleImputServiceDescription" placeholder="Descrição do Serviço">
                    </div>
                  </div>
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