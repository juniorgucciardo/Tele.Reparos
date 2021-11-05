
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

    <div class="card card-navy">
        <div class="card-header">
            Informações
            @can('view_service_demands')
            <a href="{{ route('user.create') }}"><button type="button" class="mx-1 btn-sm btn-outline-light"  ><i class="fas fa-info-circle mx-1"></i>Novo registro</button></a>
            @endcan
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="">
                        <div class="card shadow card-navy card-outline">
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
                        <div class="card shadow card-navy card-outline">
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
                                    <div class="">
                                        <strong>Bairro:</strong><br>
                                        <span>{{$contract->bairro_cliente}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Cidade :</strong><br>
                                        <span>{{$contract->cidade_cliente}}</span>
                                    </div>
                                    <div class="my-3">
                                        <div class="mapouter"><div class="gmap_canvas"><iframe width="369" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q={{$contract->rua_cliente}},{{$contract->numero_cliente}},{{$contract->cidade_cliente}}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:400px;width:369px;}</style><a href="https://www.embedgooglemap.net">google maps code generator</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:369px;}</style></div></div>                            

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-12">

                    <div class="card shadow card-navy card-outline">
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
                                        <span>{{$contract->amount}}</span>
                                    </div>
                                </div>
                            </div>
                            <strong>Imagem:</strong><br>
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
                                <div class="add-more my-2">
                                   @can('view_service_demands')
                                        <button type="button" class="btn btn-outline-info rounded" data-toggle="modal" data-target="#addModal" data-whatever="@getbootstrap">Adicionar imagem</button>
                                        @include('admin.pages.modal.include_img')
                                   @endcan

                                </div>
        
                            </div>
                            
                        </div>
                    </div>

                    <div class="card shadow card-navy card-outline">
                        <div class="card-header">
                            <i class="fas fa-feather"></i>
                            Outras informações
                        </div>
                        <div class="card-body">
                            <strong>Cadastrado em:</strong><br>
                            <span>{{$contract->created_at}}</span>
                        </div>
                    </div>

                    


                </div>


            </div>




            <div class="card shadow card-navy card-outline">
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

    
@stop