
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h5>
    <i class="fas fa-truck-moving mx-1"></i>
    {{$attend->orders->nome_cliente}} - {{$attend->orders->service->service_title}} | {{ $attend->data_inicial->translatedFormat('l \, j \d\e F ') }}
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

<div class="my-3 callout relative d-md-flex justify-content-between align-items-start">
    <div>
        <h5> @php
            if($attend->data_final->isPast()){
                echo 'Este atendimento aconteceu na';
            } else if($attend->data_inicial->isPast()) {
                echo 'Acontecendo agora, ';
            } else {
                echo 'Atendimento agendado para';
            }
        @endphp 
        {{ $attend->data_inicial->translatedFormat('l \, j \d\e F \à\s H:i A') }}</h5>
        <p class="block">demanda cadastrada dia {{ date('d/m', strtotime(explode(' ', $attend->created_at)[0])) }}</p>

    </div>
    <a href="{{ route('OS.contract', $attend->orders->id) }}"><button class="btn btn-secondary">Inforamações sobre o serviço</button></a>
</div>



<div class="card card-info shadow" id="card">
    <div class="card-header">
        <i class="mx-1 fas fa-history"></i>Atualizações</span>
    </div>
    <div class="card-body px-2">
        @if(!$activities->isEmpty())
        @foreach ($activities as $checklist)
        <div class="card">
            <div class="card-header">
                {{$checklist->title}}
            </div>
            <div class="card-body px-1">
                
                            
                                  <ul class="todo-list" data-widget="todo-list">
                                    
                                    @foreach ($checklist->items as $item)
                                    <li class="notDone d-flex justify-content-between">
                                        <div class="icheck-primary d-inline ml-2">
                                          <input type="checkbox" 
                                            @if ($item->is_concluted === 1)
                                                checked
                                            @else
                                                uncheked    
                                            @endif
                                          name="todo2" id="todoCheck2" value="{{$item->id}}">
                                          <label for="todoCheck2"></label>
                                          <span class="text">{{$item->title}}</span>
                                        @if ($item->is_concluted === 1)
                                            <small class="badge badge-info"><i class="far fa-clock mx-1"></i>{{$item->concluted_at->diffForHumans()}}</small>
                                        @endif
                                        </div>
                                        
                                        
                                        @can('view_service_demands')
                                        <div class="tools d-flex btn-group">
                                            <button class="btn-sm" data-toggle="modal" data-target="#editItemOnChecklist{{$item->id}}"><i class="fas fa-edit"></i></button>
                                            @include('admin.pages.modal.editChecklistItem')
                                            <form action="{{ route('checklistItem.destroy', $item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                        @endcan
                                    </li>
                                    @endforeach
                                    
                                  </ul>
                                </div>
                                  @can('view_service_demands')
                                  <div class="card-footer add-more m-3">
                                    <button type="button" class="btn-sm btn-outline-primary rounded" data-toggle="modal" data-target="#addItemOnChecklist{{$checklist->id}}"><i class="fas fa-plus"></i> Adicionar item</button>
                                    @include('admin.pages.modal.addItemOnChecklist')
                                  </div>
                                  @endcan
                                
                            @endforeach
                           
            </div>
        </div>
        @endif

        <div class="card card px-2">
            <div class="card-header py-2">
                Histórico de atividades
            </div>
            <div class="card-body p-0">

        
        @if ($attend->statusLogs->isEmpty())
            <div class="alert" role="alert">
                Nenhuma atualização cadastrada!
          </div>
        @endif

        @foreach ($attend->statusLogs->sortByDesc('created_at') as $log)


        {{--   CALLOUT --}}

        @php
            if($log->type == 2){
                $icon = 'fas fa-comment-dots';
            } else {
                $icon = 'fas fa-info';
            }

            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
        @endphp

        <div class="my-3 callout callout-{{$log->color}} relative">
            <h5><i class="{{$icon}}"></i> {{$log->title}}</h5>
            <p class="block">{{$log->content}}</p>
            <div class="row flex-row d-flex">
                @foreach ($log->img as $img)
                    <div class="card shadow-md os_card mx-1 relative col-sm-3 col-12" height="200px">
                        @can('delete', $log)
                            <form action="{{route('imglog.destroy', $img->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm absolute ml-auto"><i class="fas fa-trash"></i></button>
                            </form>
                        @endcan
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
                @can('postImg', $log)
                    <button class="mx-3 btn btn-outline-info m-10" data-toggle="modal" data-target="#addimage{{$log->id}}"><i class="fas fa-camera"></i></button>
                    @include('admin.pages.modal.addimage')
                @endcan
            </div>
            <div class="btn-group block" style="position: absolute; top: 0; right: 0;">
                @can('delete', $log)
                    <form action="{{route('log.destroy', $log->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                @endcan
                @can('update', $log)
                    <a href=""><button class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></button></a>
                @endcan
            </div>
        </div>


        @endforeach



        {{-- <div class="col-12">
            <div class="row d-flex items-center"> --}}
                {{-- <div class="p-2 bg-info rounded m-2">
                    <h4>{{ date('H:i A', strtotime(explode(' ', $attend->data_inicial)[1])) }}</h4>
                </div> --}}
                
            {{-- </div>
        </div> --}}

        @can('viewAny', $attend)
        <button class="btn btn-info m-10" data-toggle="modal" data-target="#create">Adicionar atualização</button>
        @include('admin.pages.logs.create')
        @endcan

    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
      $("input:checkbox").change(function() {
        var id = $(this).attr('value');
        var os_id = $(this).attr('checklist');
        if($(this).prop('checked')){
            $.ajax({
                type:'POST',
                url:"{{route('checklistItem.check')}}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { "id" : id },
            success: function (response) {
                          console.log(response);
              },
            });
        } else {
            $.ajax({
                type:'POST',
                url:"{{route('checklistItem.uncheck')}}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { "id" : id },
            success: function (response) {
                          console.log(response);
              },
            });
        };
    
        
    
        
        });
    });


        </script>

@stop