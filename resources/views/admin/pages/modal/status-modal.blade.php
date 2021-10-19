<div class="modal fade bd-example-modal-lg" id="statusModal{{$attend->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ordem de Serviço: {{$attend->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card-body">
          <div class="modal-body">
            <span>Alterar status da OS</span><br>
            <form action="{{ route('attend.changeStatus', $attend->id)}}" method="POST">
              @method('put')
              @csrf
  
             
             
              

              {{-- select --}}
                <div class="col-12 col-md-10 col-lg-8 my-3">
                    <label for="exampleInputEmail1">Status:</label>
                <select name="status_id" class="form-control">
                    <optgroup label="selecionado">
                      <option selected class="bg-primary" value="{{$attend->status->id}}">{{$attend->status->status_title}} - selecionado</option>
                    </optgroup>
                    <optgroup label="todos os status">
                      @foreach ($status as $status)
                        <option value="{{$status->id}}">{{$status->status_title}}</option>
                      @endforeach
                    </optgroup>
                </select>
                </div>



                <div class="col-12 col-md-10 col-lg-8 my-3">
                  <label class="block" for="exampleInputEmail1">Funcionários:</label>
                  <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="selecione">

                  <optgroup label="Cadastrados">
                    @foreach ($attend->users as $user)
                    <option selected value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                    @endforeach
                  </optgroup>

                  @foreach ($users as $user)
                      <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                  @endforeach
                </select>
                </div>

                


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