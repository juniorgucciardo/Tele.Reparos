@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Status</h4>
@stop

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('status.create'); }}" role="button">Cadastrar</a> 
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($status as $stt)
                        <tr>
                            <td>
                                {{ $stt->status_title }}
                            </td>
                            <td>
                                <a href="{{url("admin/status/editar/$stt->id")}}">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('status.destroy', $stt->id)}}" method="post">
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