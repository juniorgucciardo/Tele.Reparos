<div class="modal fade" id="editItemOnChecklist{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar este item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('checklistItem.update', $item->id)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="exampleInputEmail1">Item:</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1"  value="{{$item->title}}">

            <div class="buttons d-flex my-3">
              <button type="submit" class="btn btn-primary mx-1">Enviar</button>
              <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>