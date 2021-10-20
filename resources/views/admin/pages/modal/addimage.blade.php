<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Imagem</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('add')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label for="user_img" class="btn btn-sm btn-info">Selecione</label>
                <input type="file" name="img_contract" id="user_img" accept="image/*" onchange="loadFile(event)">
                <img width="120px" height="120px" src="https://www.madeireiraestrela.com.br/images/joomlart/demo/default.jpg" class="my-3" onchange="loadFile(event)" id="output" alt="">
            </div>
        </div>
        <input type="hidden" name="id" value="{{$contract->id}}" >

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  </script>