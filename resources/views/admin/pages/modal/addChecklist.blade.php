<div class="modal fade" id="addChecklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar novo item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('checklist.new')}}" method="POST">
            @csrf
            <label for="exampleInputEmail1">Nome do checklist:</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1"  placeholder="Novo item">
            <label for="exampleFormControlSelect1">Tipo de checklist</label>
            <select class="form-control" name="type_id" id="exampleFormControlSelect1">
                @foreach ($checklistTypes as $checklistType)
                <option value="{{$checklistType->id}}">{{$checklistType->title}}</option>
                @endforeach
            </select>
            @isset($contract->id)
              <input type="hidden" name="order_id" value="{{$contract->id}}">
            @endisset
            @isset($service->id)
            <input type="hidden" name="service_id" value="{{$service->id}}">              
            @endisset
            @isset($type->id)
            <input type="hidden" name="contract_type_id" value="{{$type->id}}">              
            @endisset

            <div class="buttons d-flex my-3">
              <button type="submit" class="btn btn-primary mx-1">Enviar</button>
              <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>