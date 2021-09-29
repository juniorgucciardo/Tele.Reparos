@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nossos serviços - TeleREPAROS</h1>
@stop

@section('content')
    <div class="card card-info
    ">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('service.create'); }}" role="button">Cadastrar</a> 
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Descrição</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>
                                {{ $service->service_title }}
                            </td>
                            <td>
                                {{ $service->service_description }}
                            </td>
                            <td>
                                <a href="{{url("admin/servicos/editar/$service->id")}}">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('service.destroy', $service->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop