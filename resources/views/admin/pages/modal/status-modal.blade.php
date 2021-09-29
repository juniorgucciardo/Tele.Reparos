<div class="modal fade bd-example-modal-lg" id="statusModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content card card-primary">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ordem de Serviço: {{$order->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card-body mx-auto">
          <div class="modal-body">
            <span>Antes de enviar para o prestador você precisa definir algumas informações: </span><br>
            <form action="{{ route('OS.changeStatus', $order->id)}}" method="POST">
              @method('put')
              @csrf
  
             
             
              

              {{-- select --}}
                <div class="col-12 col-md-10 col-lg-8 mx-auto my-3">
                    <label for="exampleInputEmail1">Status:</label>
                <select name="status_id" class="form-control">
                    <option selected class="bg-primary" value="{{$order->status->id}}">{{$order->status->status_title}} - selecionado</option>
                    @foreach ($status as $status)
                        <option value="{{$status->id}}">{{$status->status_title}}</option>
                      @endforeach
                  
                </select>
                </div>
        

        <div class="modal-footer text-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Alterar informações</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>
</div>