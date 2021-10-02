<div class="modal fade" id="exampleModal{{$attend->orders->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enviar para o prestador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card card-info card-outline">
          <div class="modal-body">
            <span>Antes de enviar para o prestador você precisa definir algumas informações: </span><br>
            <form action="{{ route('accept.OS', $attend->orders->id)}}" method="POST">
              @method('PUT')
              @csrf
  
             <div class="row">
              <div class="form-group col-12 col-md-6">
                <label for="recipient-name" class="col-form-label">Data:</label>
                <input type="date" name="data_ordem" class="form-control" id="recipient-name" value="{{$attend->orders->data_ordem}}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="message-text" class="col-form-label">Hora:</label>
                <input type="time" name="hora_ordem" class="form-control" id="recipient-name" value="{{$attend->orders->hora_ordem}}">
              </div>
             </div>
  
             <div class="row">
              <div class="col-md-6 col-12">
                <label for="exampleInputEmail1">FUNCIONÁRIO:</label>
                  <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="selecione um prestador">
                    <optgroup>
                    @foreach ($users as $user)
                      <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                    @endforeach
                    </optgroup>
                  </select>
              </div>

              {{-- select --}}
              {{-- <div class="col-md-6 col-12">
                <label for="exampleInputEmail1">Status:</label>
                <select name="status_id" class="form-control">
                    <option selected class="bg-primary" value="{{$status[1]->id}}">{{$status[1]->status_title}}</option>
                    @foreach ($status as $status)
                        <option value="{{$status->id}}">{{$status->status_title}}</option>
                      @endforeach
                  
                </select>
              </div>
             </div>
  
          </div>
        </div> --}}
        

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agendar serviço</button>
        </div>
      </form>

      </div>
    </div>
  </div>