
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h5>
    <i class="fas fa-truck-moving mx-1"></i>
    Atendimento n {{$attend->id}}
  </h5>
@stop

@section('content')


<style>
     .prof_pic{
        max-height: 35px;
        max-width: 35px;
        object-fit: cover
    }
</style>

<div class="card card-info shadow">
    <div class="card-header">
        <span color="#fff"><i class="mx-1 fas fa-history"></i>Histórico de atualizações</span>
        <button class="btn-sm btn-outline-light mx-1" data-toggle="modal" data-target="#create">Adicionar observação</button>
        @include('admin.pages.logs.create')
    </div>
    <div class="card-body">

        @foreach ($attend->statusLogs->sortByDesc('created_at') as $log)


        {{--   CALLOUT --}}

        <div class="my-3 callout callout-{{$log->color}} shadow relative">
            <h5><i class="fas fa-info"></i> {{$log->title}}</h5>
            <p class="block">{{$log->content}}</p>
            <div class="row d-flex items-center">
                <a href="{{route('user.view', $log->user->id)}}"><img width="35" height="35" class="mx-2 prof_pic border-md rounded-circle my-2" src="/storage/usr_img/{{$log->user->user_img}}" alt="person"></a>
                <div>
                    <span class="description block text-sm"><a href="{{route('user.view', $log->user->id)}}">{{$log->user->name}}</a></span>
                    <span class="description block text-sm">Atualizado em - {{ date('H:i A', strtotime(explode(' ', $log->created_at)[1])) }} dia {{ date('d/m', strtotime(explode(' ', $log->created_at)[0])) }}</span>
                </div>
            </div>
            <div class="btn-group block" style="position: absolute; top: 0; right: 0;">
                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
                <a href=""><button class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></button></a>
            </div>
        </div>


        @endforeach



        <div class="my-2 callout callout-info shadow relative">
            <h5><i class="fas fa-info"></i> Atendimento cadastrado dia {{ date('d/m', strtotime(explode(' ', $attend->data_inicial)[0])) }}</h5>
            <p class="block">demanda agendada para {{ date('l d/m', strtotime(explode(' ', $attend->data_inicial)[0])) }} às {{ date('H:i A', strtotime(explode(' ', $attend->data_inicial)[1])) }}</p>
            
        </div>


    </div>
</div>


@stop