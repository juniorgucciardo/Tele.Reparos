<div class="modal fade" id="addimage{{$log->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content card card-info">
        <div class="modal-header card-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Imagem</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('imglog.store')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label for="imglog" class="btn btn-sm btn-info">Selecione</label>
                <input type="file" name="img_log" id="imglog" accept="image/*" onchange="loadImage(event)">
                <img width="120px" height="120px" src="https://www.madeireiraestrela.com.br/images/joomlart/demo/default.jpg" class="my-2"  id="result" alt="">
            </div>
        </div>
        <input type="hidden" name="id" value="{{$log->id}}" >

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <script>
    var loadImage = function(event) {
    var output = document.getElementById('result');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  </script>