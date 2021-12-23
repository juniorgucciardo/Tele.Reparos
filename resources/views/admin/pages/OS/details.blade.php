
@extends('adminlte::page')

@section('title', 'Detalhes do serviço')

@section('content_header')
<h5>
    <i class="fas fa-file-contract mx-1"></i>
    {{$contract->nome_cliente}} - {{$contract->service->service_title}}  
  </h5>


@stop

@section('content')


<style>


    .os_card{
        max-width: 200px;
    }

    .image_area{
        flex-wrap: wrap;
    }

    .os_img{
        width: 100%;
        object-fit: cover
    }


    input[type='file'] {
  display: none
}

</style>

    <div class="card card-info">
        <div class="card-header">
            Informações
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="">
                        <div class="card shadow card-info card-outline">
                            <div class="card-header">
                                <i class="fas fa-house-user"></i>
                                Informações do cliente
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="">
                                        <strong>Nome:</strong><br>
                                        <span>{{$contract->nome_cliente}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Contato:</strong><br>
                                        <span>{{$contract->contato_cliente}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="">
                        <div class="card shadow card-info card-outline">
                            <div class="card-header">
                                <i class="fas fa-map-marker-alt"></i>
                                Endereço
                            </div>
                            <div class="card-body">
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="">
                                        <strong>Rua: </strong>
                                        <span>{{$contract->rua_cliente}}, {{$contract->numero_cliente}}</span>
                                    </div>
                                </div>
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="block">
                                        <strong>Bairro: </strong>
                                        <span>{{mb_strimwidth($contract->bairro_cliente, 0, 15, '...')}}</span>
                                    </div>
                                    <div class="block">
                                        <strong>Cidade: </strong>
                                        <span>{{mb_strimwidth($contract->cidade_cliente, 0, 20, '...')}}</span>
                                    </div>
                                    <div class="my-3 sm-col-8">
                                        <div class="mapouter"><div class="gmap_canvas"><iframe width="400" height="380" id="gmap_canvas" src="https://maps.google.com/maps?q={{$contract->rua_cliente}},{{$contract->numero_cliente}},{{$contract->cidade_cliente}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:350px;width:400px;}</style><a href="https://www.embedgooglemap.net">google maps code generator</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:369px;}</style></div></div>                            

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow card-info card-outline">
                        <div class="card-header">
                            <i class="fas fa-feather"></i>
                            Outras informações
                        </div>
                        <div class="card-body">
                            <strong>Cadastrado em:</strong><br>
                            <span>{{ $contract->created_at->translatedFormat('l \, j \d\e F \à\s H:i A') }}</span>
                            <a href="{{route('attend.create', $contract->id)}}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Atendimento</a>
                            <a href="{{route('OS.edit', $contract->id)}}" class="btn btn-outline-primary"><i class="fas fa-pen"></i> Editar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-12">

                    <div class="card shadow card-info card-outline">
                        <div class="card-header">
                            <i class="fas fa-wrench"></i>
                            Informações sobre o serviço
                        </div>
                        <div class="card-body">
                            @if($contract->work_at_height)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-mountain"></i> ATENÇÃO!</strong> Serviço em altura, IPI's obrigatórios.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            @endif
                            @if($contract->is_insurance)
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-shield-alt"></i> ATENÇÃO!</strong> Serviço de seguradora
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            @endif
                            <div class="row d-flex justify-content-between">
                                <div class="col-6">
                                    <div class="inline">
                                        <strong>Serviço: </strong>
                                        <span>{{$contract->service->service_title}}</span>
                                    </div>
                                    <div class="my-3">
                                        <strong>Situação: </strong>
                                        <span>{{$contract->situation->title}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Recorrência: </strong>
                                        <span>{{$contract->getRecurrence()}}</span>
                                    </div>
                                    <div class="my-3">
                                        <strong>Descrição: </strong>
                                        <span>{{$contract->descricao_servico}}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <div class="">
                                        <strong>Tipo de serviço: </strong>
                                        <span>{{$contract->type->type_title}}</span>
                                    </div>
                                    <div class="my-3">
                                        <strong>produtos e equipamentos: </strong>
                                        @if($contract->products_included)
                                            <span>Inclusos</span>
                                        @else
                                            <span>Não inclusos</span>
                                        @endif
                                    </div>
                                    <div class="my-3">
                                        <strong>Quantidade de atendimentos: </strong>
                                        <span>{{$contract->attends->count()}}</span>
                                    </div>
                                </div>
                            </div>
                            @if(!$contract->img_contract->isEmpty())
                                <strong>Imagem:</strong><br>
                            @endif
                            <div class="row items-center justify-content-between">
                                <div class="my-2 row d-flex images_area">
                                    @foreach ($contract->img_contract as $img)
                                    <div class="card os_card mx-1 relative col-sm-12" style="width: 18rem;">
                                        <form action="{{ route('imageContract.destroy', $img->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm absolute ml-auto"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <img class="os_pic" src="/storage/contract_img/{{$img->img_contract}}" width="200px" height="100px" alt="person">
                                        <div class="card-body">
                                            <details>
                                                <summary> <p class="card-text">{{mb_strimwidth($img->description, 0, 16, "...")}}</p></summary>
                                                <p>{{$img->description}}</p>
                                            </details>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>        
                            </div>
                            <div class="add-more m-2">
                                @can('view_service_demands')
                                     <button type="button" class="btn btn-outline-info rounded" data-toggle="modal" data-target="#addModal" data-whatever="@getbootstrap">Adicionar imagem</button>
                                     @include('admin.pages.modal.include_img')
                                @endcan

                             </div>                            
                        </div>
                    </div>

                    <div class="card card-info card-outline px-0">
                        <div class="card-header py-2">
                            <div class="row d-flex align-items-center justify-content-between py-0">
                                <div class="row d-flex justify-content-between">
                                    <i class="fas fa-clipboard-list mx-1"></i> 
                                    <h6>Checklists</h6>
                                </div>
                                @isset($executing->id)
                                        <div class="row d-flex justify-content-between">
                                            <a href=" {{route('attend.show', $executing->id)}} " class="px-4 btn-sm btn-warning">Atendimento em execução: {{$executing->data_inicial->TranslatedFormat('d/m/y')}}</a>
                                        </div>
                                @endisset
                            </div>
                        </div>
                        <div class="card-body px-0 py-2">


                            {{-- ATIVIDADES --}}
                    @if($activities !== null)
                    @foreach ($activities as $checklist)
                    <div class="card">
                        <div class="card-header py-2" style="background-color: #FFFF99">
                            <div class="d-flex d-flex-row justify-content-between align-items-start">
                                <h6 class="card-title">
                                    {{$checklist->title}}                   @isset($executing->id) 
                                                                                - atendimento de {{$executing->data_inicial->translatedFormat('l')}}
                                                                            @endisset
                                </h6>
                                  <button class="btn-sm btn-danger" data-toggle="modal" data-target="#deleteChecklist{{$checklist->id}}"><i class="fas fa-trash-alt"></i></button>
                                  @include('admin.pages.modal.deleteChecklist') @include('admin.pages.modal.deleteChecklist')
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
                        </div>
                          @can('view_service_demands')
                          <div class="card-footer">
                            <button type="button" class="btn-sm btn-outline-primary rounded" data-toggle="modal" data-target="#addItemOnChecklist{{$checklist->id}}"><i class="fas fa-plus"></i> Adicionar item</button>
                            @include('admin.pages.modal.addItemOnChecklist')
                          </div>
                          @endcan
                        
                      </div>
                    @endforeach
                    @endif

                    {{-- CHECKLISTS --}}
                    @if($checklists !== null)
                    @foreach ($checklists as $checklist)
                    <div class="card">
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
                          <div class="add-more m-3">
                            <button type="button" class="btn-sm btn-outline-primary rounded" data-toggle="modal" data-target="#addItemOnChecklist{{$checklist->id}}"><i class="fas fa-plus"></i> Adicionar item</button>
                            @include('admin.pages.modal.addItemOnChecklist')
                          </div>
                          @endcan
                        </div>
                      </div>
                    @endforeach
                    @endif

                    @if($checklists === [])
                        Nenhuma checklist cadastrada
                    @endif
                        </div>

                            @can('view_service_demands')
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary rounded" data-toggle="modal" data-target="#addChecklist"> Adicionar novo checklist</button>
                            @include('admin.pages.modal.addChecklist')
                            <button type="button" class="btn btn-outline-primary rounded" data-toggle="modal" data-target="#addExistisChecklist"> Adicionar checklist de {{$contract->service->service_title}}</button>
                            @include('admin.pages.modal.addExistisChecklist')
                        </div>
                        @endcan
                    </div>
    
                </div>


            </div>




            <div class="card card-info card-outline">
                <div class="card-header">
                    Atendimentos deste contrato
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                       @include('admin.pages.tables.table-OS', $attends)
                    </div>
                </div>
            </div>


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