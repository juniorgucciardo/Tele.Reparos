<div class="card card-secondary col-md-3 col-sm-6 col-12">
    <div class="card-header">
        {{$solicited->nome_cliente}} - {{$solicited->service->service_title}}
    </div>
    <div class="card-body">
        <p>{{$solicited->data_ordem, $solicited->hora_ordem}}</p>
        <p>{{$solicited->rua_cliente}}, {{$solicited->numero_cliente}}</p>
        <p>{{$solicited->type->type_title}}</p>
    </div>
</div>