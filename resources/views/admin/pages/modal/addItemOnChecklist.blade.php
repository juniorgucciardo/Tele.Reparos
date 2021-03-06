<div class="modal fade" id="addItemOnChecklist{{$checklist->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar novo item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('checklistItem.create')}}" method="POST">
            @csrf
            <label for="exampleInputEmail1">Item:</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1"  placeholder="Novo item">
            <input type="hidden" name="checklist_id" value="{{$checklist->id}}">
            <input type="hidden" name="type_id" value="{{$checklist->type_id}}">

            <div class="buttons d-flex my-3">
              <button type="submit" class="btn btn-primary mx-1">Enviar</button>
              <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>