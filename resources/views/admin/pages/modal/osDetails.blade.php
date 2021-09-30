<div class="modal fade bd-example-modal-lg" id="osDetails{{$attend->orders->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content card card-primary">


        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Ordem de Serviço: {{$attend->orders->id}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card-body">
          <div class="modal-body">
            <span>Aqui estão Algumas informações referentes a ordem de serviço: </span><hr>
            <div class="row">
              <span>nome do cliente: </span>{{$attend->orders->nome_cliente}}
            </div>
            <div class="row d-flex justify-content-between">
              <span>Endereço: {{$attend->orders->rua_cliente}}</span>
              <span>Numero: {{$attend->orders->numero_cliente}}</span>
              <span>Numero: {{$attend->orders->bairro_cliente}}</span>
            </div>

      </div>
    </div>
  </div>
</div>
</div>