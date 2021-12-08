@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Serviços</h4>
@stop

@section('content')

<style>
    .id{
        display: none;
    }
    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        .tableResponsive tr{
        display: flex;
        flex-direction: column;
    }

    .tableResponsive thead{
        display: none;
    }
    .status-badge{
        text-align: left;
    }
    .cliente{
        font-weight: 600;
        font-size: 1.1rem
    }
    .id{
        display: inline
    }
    }

    

    .checklist{
        width: 100%;
    }

    
</style>
    <div class="card card-info
    ">
        <div class="card-header py-2">
            <a class="btn-sm btn-outline-secondary" href="{{ route('service.create'); }}" role="button"><i class="fas fa-plus-circle mx-1"></i>Cadastrar novo serviço</a> 
        </div>
        <div class="card-body px-1">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>
                                    <h4><span class="badge badge-secondary p-2 rounded">{{ $service->service_title }}</span></h4>
                                </td>
                                <td>
                                    {{ $service->service_description }}
                                </td>
                                <td class="btn-group">
                                    <a href="{{url("admin/servicos/editar/$service->id")}}">
                                        <button class="btn btn-primary">Editar</button>
                                    </a>
                                
                                    <form action="{{ route('service.destroy', $service->id)}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="d-flex flex-wrap align-items-baseline">
                                    @foreach ($service->checklists as $checklist)
                                        <div class="col-md-5 col-6 card m-3 checklist p-0">
                                            <div class="card-header bg-light py-2">
                                                <div class="d-flex d-flex-row justify-content-between align-items-start">
                                                    <h6 class="card-title">
                                                        {{$checklist->title}}
                                                    </h6>
                                                      <button class="btn-sm btn-danger" data-toggle="modal" data-target="#deleteChecklist{{$checklist->id}}"><i class="fas fa-trash-alt"></i></button>
                                                      @include('admin.pages.modal.deleteChecklist')
                                                </div>
                                            </div>
                                            <div class="card-body px-0">
                                            <ul class="todo-list" data-widget="todo-list">
                                                
                                                @foreach ($checklist->items as $item)
                                                <li class="notDone">
                                                    <div class="icheck-primary d-inline ml-2">
                                                    <input type="checkbox" 
                                                        @if ($item->is_concluted === 1)
                                                            checked
                                                        @else
                                                            uncheked    
                                                        @endif
                                                    name="todo2" id="todoCheck2" value="{{$item->id}}">
                                                    <label for="todoCheck2"></label>
                                                    </div>
                                                    <span class="text">{{$item->title}}</span>
                                                    @if ($item->is_concluted === 1)
                                                        <small class="badge badge-info"><i class="far fa-clock mx-1"></i>{{$item->concluted_at->diffForHumans()}}</small>
                                                    @endif
                                                    
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
                                        @can('view_service_demands')
                                        <div class="add-more m-2">
                                            <button type="button" class="btn-sm btn-outline-primary rounded" data-toggle="modal" data-target="#addItemOnChecklist{{$checklist->id}}"><i class="fas fa-plus"></i> Adicionar item</button>
                                            @include('admin.pages.modal.addItemOnChecklist')
                                        </div>
                                        @endcan
                                        </div>
                                    </div>
                                @endforeach
                                @can('view_service_demands')
                                        <div class="checklists m-3">
                                            <button type="button" class="h-100 btn btn-outline-primary rounded" data-toggle="modal" data-target="#addChecklistService{{$service->id}}"> Adicionar Checklist</button>
                                            @include('admin.pages.modal.addChecklistService')
                                        </div>
                                    @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop