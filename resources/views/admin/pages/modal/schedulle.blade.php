
<div class="modal fade bd-example-modal-lg" id="schedulle-modal{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$a->orders->service->service_title}} | {{$a->orders->nome_cliente}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          <div class="modal-body">
            <form action="{{route('attend.scheduling', $a->id)}}" method="POST">
              @method('put')
              @csrf
  
        
                   <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="recipient-name" class="col-form-label">Data:</label>
                      <input type="date" name="data_inicial" class="form-control" id="recipient-name" value="{{date('Y-m-d', strtotime($a->data_inicial))}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label for="message-text" class="col-form-label">Hora:</label>
                      <input type="time" name="hora_inicial" class="form-control" id="recipient-name" value="{{date('H:i:s', strtotime($a->data_inicial))}}">
                    </div>
                   </div>
        
                   <div class="row">
                    <div class="col-md-6 col-12">
                      <label for="exampleInputEmail1">FUNCIONÁRIO:</label><br>
                      <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="
                      selecione
                      ">

                        <optgroup label="Cadastrados">
                          @foreach ($a->users as $user)
                          <option selected value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                          @endforeach
                        </optgroup>

                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                        @endforeach
                      </select>
                    </div>
      
                    
                    <div class="col-md-6 col-12">
                      <label for="exampleInputEmail1">Status:</label>
                      <select name="status_id" class="form-control">
                        <option selected value="2">-- Agendar -- </option>
                       @foreach ($status as $status)
                        <option value="{{$status->id}}">{{$status->status_title}}</option>
                      @endforeach
                    </select>
                    </div>
                </div>

                @php
                            $start = new DateTime($a->data_inicial);
                            $end = $start->diff(new DateTime($a->data_final));
                            $hours = $end->h;
                          @endphp  

               <div class="row my-1">
                <div class="col-md-6 col-12">
                    <label for="exampleInputEmail1">Duração em horas</label>
                    <input required type="number" name="duration" class="form-control" id="exempleImputServiceTitle" value="{{$hours}}">
                  </div>
               </div>
               </div>
             
             
              

              

                


        <div class="row">
            <div class="modal-footer content-left">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Alterar informações</button>
              </div>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>
</div>