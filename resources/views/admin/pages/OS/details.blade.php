
@extends('adminlte::page')

@section('title', 'Dashboard')

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
                                        <strong>Rua:</strong><br>
                                        <span>{{$contract->rua_cliente}}, {{$contract->numero_cliente}}</span>
                                    </div>
                                </div>
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="block">
                                        <strong>Bairro:</strong><br>
                                        <span>{{$contract->bairro_cliente}}</span>
                                    </div>
                                    <div class="block">
                                        <strong>Cidade :</strong><br>
                                        <span>{{$contract->cidade_cliente}}</span>
                                    </div>
                                    <div class="my-3 sm-col-8">
                                        <div class="mapouter"><div class="gmap_canvas"><iframe width="369" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q={{$contract->rua_cliente}},{{$contract->numero_cliente}},{{$contract->cidade_cliente}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:400px;width:369px;}</style><a href="https://www.embedgooglemap.net">google maps code generator</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:369px;}</style></div></div>                            

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
                            @isset($executing->id)
                                <p>Atendimento em execução agora: {{$executing->id}}</p>
                            @endisset
                        </div>
                        @can('view_service_demands')
                        <div class="card-footer">
                            <a href="{{route('attend.create', $contract->id)}}" class="btn btn-info">Adionar novo atendimento</a>
                        </div>
                        @endcan
                    </div>
                </div>

                <div class="col-md-8 col-12">

                    <div class="card shadow card-info card-outline">
                        <div class="card-header">
                            <i class="fas fa-wrench"></i>
                            Informações sobre o serviço
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-6">
                                    <div class="">
                                        <strong>Serviço:</strong><br>
                                        <span>{{$contract->service->service_title}}</span>
                                    </div>
                                    <div class="my-2">
                                        <strong>Descrição do serviço:</strong><br>
                                        <span>{{$contract->descricao_servico}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Serviço:</strong><br>
                                        <span>{{$contract->service->service_title}}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <div class="my-2">
                                        <strong>Tipo de serviço:</strong><br>
                                        <span>{{$contract->type->type_title}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Recorrência:</strong><br>
                                        <span>{{$contract->recurrence}} dias</span>
                                    </div>
                                    <div class="my-2">
                                        <strong>Quantidade de atendimentos:</strong><br>
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
                            <div class="add-more my-2">
                                @can('view_service_demands')
                                     <button type="button" class="btn btn-outline-info rounded" data-toggle="modal" data-target="#addModal" data-whatever="@getbootstrap">Adicionar imagem</button>
                                     @include('admin.pages.modal.include_img')
                                @endcan

                             </div>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                          <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Checklist de atividades
                          </h3>
          
                          {{-- <div class="card-tools">
                            <ul class="pagination pagination-sm">
                              <li class="page-item"><a href="#" class="page-link">«</a></li>
                              <li class="page-item"><a href="#" class="page-link">1</a></li>
                              <li class="page-item"><a href="#" class="page-link">2</a></li>
                              <li class="page-item"><a href="#" class="page-link">3</a></li>
                              <li class="page-item"><a href="#" class="page-link">»</a></li>
                            </ul>
                          </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <ul class="todo-list" data-widget="todo-list">
                            
                            @foreach ($contract->checklists[0]->items as $item)
                            <li class="notDone">
                                <div class="icheck-primary d-inline ml-2">
                                  <input type="checkbox" 
                                    @if ($item->is_concluted === 1)
                                        checked
                                    @else
                                        uncheked    
                                    @endif
                                  name="todo2" id="todoCheck2" checklist="{{$contract->checklists[0]}}" value="{{$item->id}}">
                                  <label for="todoCheck2"></label>
                                </div>
                                <span class="text">{{$item->title}}</span>
                                @if ($item->is_concluted === 1)
                                    <small class="badge badge-info"><i class="far fa-clock mx-1"></i>{{$item->concluted_at->diffForHumans()}}</small>
                                @endif
                                
                                <div class="tools">
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash"></i>
                                </div>
                            </li>
                            @endforeach
                            
                          </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
                        </div>
                      </div>
                    <div class="card shadow card-info card-outline">
                        <div class="card-header">
                            <i class="fas fa-toolbox"></i>
                            checklist de materiais e equipamentos
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item rounded-0">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheck1" type="checkbox">
                                        <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck1">Vassoura</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheck2" type="checkbox">
                                        <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck2">Alcool</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheck3" type="checkbox">
                                        <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck3">Viper</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheck4" type="checkbox">
                                        <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck4">Saco de lixo</label>
                                    </div>
                                </li>
                                <li class="list-group-item rounded-0">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheck5" type="checkbox">
                                        <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck5">Balde</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
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
        var checked = 'checked'
    } else {
        var checked = 'not checked'
    };

    $.ajax({
            type:'POST',
            url:"{{route('checklists.teste')}}",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: { "attend_id" : id,
                    "os_id" : os_id
        },
        success: function (response) {
                      console.log(response);
          },
        });

    
    });
});
    </script>


    
@stop