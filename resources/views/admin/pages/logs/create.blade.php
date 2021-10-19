<div class="modal fade bd-example-modal-lg" id="create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card card-info">
            <div class="card-header">
              <h5 class="card-title">Nova observação sobre o atendimento</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('log.store') }}" method="POST">
              @csrf
                <div class="form-group">
                  


                  {{-- Endereço da demanda --}}

                      <div class="card-body p-3">
                        <div class="row mx-auto">
                            <div class="col-md-3 col-12">
                              <label for="exampleInputEmail1">Titulo:</label>
                              <input type="text" name="title" class="form-control" id="exempleImputServiceTitle" placeholder="Titulo">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="exampleInputEmail1">Descrição:</label>
                                <input type="text" name="description" class="form-control" id="exempleImputServiceTitle" placeholder="Descrição">
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="exampleFormControlSelect1">Color</label>
                                    <select name="color" class="form-control" id="exampleFormControlSelect1">
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