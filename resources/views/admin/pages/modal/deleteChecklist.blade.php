<div class="modal fade" id="deleteChecklist{{$checklist->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLongTitle">Deletar Checklist</h5>
          <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('checklist.destroy', $checklist->id)}}" method="POST">
            @csrf
            @method('DELETE')

            <div class="block display-2 w-100 text-center py-1">
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <h4>Deseja realmente deletar este Checklist?</h4>
            <h5><span class="badge badge-dark">{{$checklist->title}}</span></h5>
            <span>Isto apagará todos os itens desta lista também</span>

            {{-- EXEMPLO DE CÓDIGO --}}
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
              <button type="submit" class="btn btn-danger mx-1">Deletar</button>
              <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Cancelar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>