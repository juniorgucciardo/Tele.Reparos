
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
        object-fit: cover;
    }

    input[type='file'] {
        display: none;
    }

    .os_img{
        width: 100px;
        height: 200px;
        object-fit: cover
    }
</style>

<div class="card card-info shadow">
    <div class="card-header">
        <span color="#fff"><i class="mx-1 fas fa-history"></i>Histórico de atualizações</span>
    </div>
    <div class="card-body">
        <button class="btn btn-info m-10" data-toggle="modal" data-target="#create">Adicionar atualização</button>
        @include('admin.pages.logs.create')


        @foreach ($attend->statusLogs->sortByDesc('created_at') as $log)


        {{--   CALLOUT --}}

        @php
            if($log->type == 2){
                $icon = 'fas fa-comment-dots';
            } else {
                $icon = 'fas fa-info';
            }
        @endphp

        <div class="my-3 callout callout-{{$log->color}} shadow relative">
            <h5><i class="{{$icon}}"></i> {{$log->title}}</h5>
            <p class="block">{{$log->content}}</p>
            <div class="row flex-row d-flex">
                @foreach ($log->img as $img)
                    <div class="card shadow-md os_card mx-1 relative col-sm-3 col-12" height="200px">
                        <form action="{{route('imglog.destroy', $img->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm absolute ml-auto"><i class="fas fa-trash"></i></button>
                        </form>
                        <img class="os_pic" src="/storage/log_img/{{$img->img_log}}" alt="person">
                    </div>
                @endforeach
            </div>
            <div class="row d-flex items-center">
                <a href="{{route('user.view', $log->user->id)}}"><img width="35" height="35" class="mx-2 prof_pic border-md rounded-circle my-2" src="/storage/usr_img/{{$log->user->user_img}}" alt="person"></a>
                <div>
                    <span class="description block text-sm"><a href="{{route('user.view', $log->user->id)}}">{{$log->user->name}}</a></span>
                    <span class="description block text-sm">Atualizado em - {{ date('H:i A', strtotime(explode(' ', $log->created_at)[1])) }} dia {{ date('d/m', strtotime(explode(' ', $log->created_at)[0])) }}</span>
                </div>
                <button class="mx-3 btn btn-outline-info m-10" data-toggle="modal" data-target="#addimage{{$log->id}}"><i class="fas fa-camera"></i></button>
                @include('admin.pages.modal.addimage')
            </div>
            <div class="btn-group block" style="position: absolute; top: 0; right: 0;">
                <form action="{{route('log.destroy', $log->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
                <a href=""><button class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></button></a>
            </div>
        </div>


        @endforeach



        {{-- <div class="col-12">
            <div class="row d-flex items-center"> --}}
                {{-- <div class="p-2 bg-info rounded m-2">
                    <h4>{{ date('H:i A', strtotime(explode(' ', $attend->data_inicial)[1])) }}</h4>
                </div> --}}
                <div class="my-3 callout callout-info shadow relative">
                    <h5><i class="fas fa-info"></i> Atendimento cadastrado dia {{ date('d/m', strtotime(explode(' ', $attend->data_inicial)[0])) }}</h5>
                    <p class="block">demanda agendada para {{ date('l d/m', strtotime(explode(' ', $attend->data_inicial)[0])) }} às {{ date('H:i A', strtotime(explode(' ', $attend->data_inicial)[1])) }}</p>
                    
                </div>
            {{-- </div>
        </div> --}}


    </div>
</div>

@stop