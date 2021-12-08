<!-- Modal -->
<div class="modal fade" id="addExistisChecklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Adicionar checklist</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @foreach ($contract->service->checklists->where('order_id', NULL)->sortBy('type_id') as $checklist)
            <div id="accordion">
                <div class="card">
                  <div class="card-header py-1 px-2 bg-light text-light" id="headingOne">
                    <div class="d-flex d-flex-row justify-content-between align-items-start">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$checklist->id}}" aria-expanded="false" aria-controls="collapse{{$checklist->id}}">
                            {{ $checklist->title }} - {{ $checklist->type->title }}
                          </button>
                          <div class="btn-group">
                            <a class="btn btn-warning" href="{{ route('checklist.addOnOrder', [
                               'id' => $checklist->id,
                               'orderId' => $contract->id
                            ]) }}"><i class="fas fa-plus-circle"></i></a>
                            <button class="btn-sm btn-danger" data-toggle="modal" data-target="#deleteChecklist{{$checklist->id}}"><i class="fas fa-trash-alt"></i></button>
                            @include('admin.pages.modal.deleteChecklist')
                          </div>
                    </div>
                  </div>
              
                  <div id="collapse{{$checklist->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        Itens:
                        @foreach ($checklist->items as $item)
                            <span class="badge badge-secondary">{{$item->title}}</span>
                        @endforeach
                    </div>
                  </div>
                </div>
            </div>
            @endforeach
        </div>

        


        <div class="modal-footer d-flex justify-content-start">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>