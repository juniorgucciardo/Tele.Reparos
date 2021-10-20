<div class="modal fade bd-example-modal-lg" id="create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card card-info">
            <div class="card-header">
              <h5 class="card-title">Nova observação sobre o atendimento</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('log.store') }}" method="POST" enctype='multipart/form-data'>
              @csrf
                <div class="form-group">
                  


                  {{-- Endereço da demanda --}}

                      <div class="card-body p-3" style="color: #000">
                        <div class="d-flex flex-column gap-3 mx-auto">
                            <div class="col-md-5 col-12">
                              Titulo:
                              <input type="text" name="title" class="form-control" id="titulo" placeholder="Titulo">
                            </div>
                            <div class="col-md-6 col-12 my-2">
                                Descrição:
                                <input type="text" name="content" class="form-control" id="descricao" placeholder="Descrição">
                            </div>
                            <div class="col-md-4 col-12">
                                Color
                                    <select name="color" class="form-control" id="color">
                                        <option value="info">
                                            <div class="bg-success">Azul</div>
                                        </option>
                                        <option value="success">
                                            <div class="bg-success">verde</div>
                                        </option>
                                        <option value="warning">
                                            <div class="bg-success">amarelo</div>
                                        </option>
                                        <option value="danger">
                                            <div class="bg-success">vermelho</div>
                                        </option>
                                    </select>
                            </div>
                            <div class="col-md-4 col-12 my-3">
                              <label for="user_img" class="btn btn-sm btn-info">Adicionar imagem</label>
                              <input type="file" name="img_log" id="user_img" accept="image/*" onchange="loadFile(event)">
                              <img width="120px" height="120px" src="https://www.madeireiraestrela.com.br/images/joomlart/demo/default.jpg" class="my-3" onchange="loadFile(event)" id="output" alt="">
                          </div>

                            <input type="hidden" name="attend_id" value="{{$attend->id}}">
                          </div>
                      </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary shadow">Cadastrar</button>
                <a class="btn btn-secondary shadow" href="{{ route('attend.show', $attend->id); }}" role="button">Voltar</a> 
              </div>
            </form>
        </div>
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