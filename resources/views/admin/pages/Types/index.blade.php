@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Tipos de OS</h4>
@stop

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('type.create'); }}" role="button">Cadastrar</a> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Checklist</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td>
                                    {{ $type->type_title }} - {{$type->id}}
                                <td>
                                        @can('view_service_demands')
                                            <div class="checklists">
                                                <button type="button" class="btn btn-outline-primary rounded" data-toggle="modal" data-target="#addChecklist"> Adionar novo checklist</button>
                                                @include('admin.pages.modal.addChecklist')
                                            </div>
                                        @endcan
                                        @foreach ($type->checklists as $checklist)
                        <div class="card my-2 checklist">
                            <div class="card-header py-2">
                              <h6 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                {{$checklist->title}}
                              </h6>
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
                              <div class="add-more m-3">
                                <button type="button" class="btn-sm btn-outline-primary rounded" data-toggle="modal" data-target="#addItemOnChecklist{{$checklist->id}}"><i class="fas fa-plus"></i> Adicionar item</button>
                                @include('admin.pages.modal.addItemOnChecklist')
                              </div>
                              @endcan
                            </div>
                          </div>
                        @endforeach
                                
                                </td>
                                <td>
                                    <a href="{{url("admin/tipos/editar/$type->id")}}">
                                        <button class="btn btn-primary">Editar</button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('type.destroy', $type->id)}}" method="post">
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
    </div>
@stop