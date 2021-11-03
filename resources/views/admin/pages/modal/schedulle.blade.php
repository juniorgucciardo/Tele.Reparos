<div class="modal fade bd-example-modal-lg" id="schedulle-modal{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$a->orders->nome_cliente}} | {{$a->data_inicial}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card-body">
          <div class="modal-body">
            <span>Alterar status da OS</span><br>
            <form action="" method="POST">
              @method('put')
              @csrf
  
             
             
              

              {{var_dump($data)}}

                


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Alterar informações</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>
</div>