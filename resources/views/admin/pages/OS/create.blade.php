@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
  <i class="fas fa-file-contract mx-1"></i>
  Contratos e serviços
</h4>
@stop

@section('content')

<script>
  var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>

<style>
  .multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>

    <div class="card card-navy">
            <div class="card-header">
              <h5 class="card-title">Cadastre um novo registro</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('OS.create') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  
                  {{-- Informações do cliente --}}
                  <div class="card card-outline card-navy shadow">
                    <div class="card-header">
                      <i class="fas fa-user-friends mx-1"></i>
                      Informações o cliente
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <label for="exampleInputEmail1">Nome do cliente</label>
                          <input required type="text" name="nome_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Nome do cliente">
                        </div>
                        <div class="col-md-6 col-12">
                          <label for="exampleInputEmail1">Contato:</label>
                          <input required type="text" name="contato_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Contato do cliente">
                        </div>
                      </div>
                    </div>
                  </div>


                  {{-- Endereço da demanda --}}
                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-map-marked-alt mx-1"></i>
                      Endereço da demanda
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Rua:</label>
                          <input required type="text" name="rua_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">Numero:</label>
                          <input required type="text" name="numero_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Bairro:</label>
                          <input required type="text" name="bairro_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 col-12">
                          <label for="exampleInputEmail1">Cidade:</label>
                          <input required type="text" name="cidade_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                      </div>
                    </div>
                  </div>



                  {{-- Informações sobre o serviço --}}
                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-tools mx-1"></i>
                      Serviço
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-5 col-12">
                          <label for="exampleInputEmail1">Serviço:</label>
                          <select required name="id_service" class="form-control">
                            @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->service_title}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">DATA:</label>
                          <input required type="date" name="data_ordem" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">HORA:</label>
                          <input required type="time" name="hora_ordem" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-7 col-12">
                          <label for="exampleInputEmail1">Descrição:</label>
                          <textarea required type="text" name="descricao_servico" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>


            
                  {{-- Informações adicionais --}}

                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-info-circle mx-1"></i>
                      Informações adicionais
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">FUNCIONÁRIO:</label>
                            <select required multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="
                            selecione
                            ">
    
                              @foreach ($users as $user)
                                  <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                              @endforeach
                              <option value="">remover</option> 
                            </select>
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Tipo de serviço:</label>
                          <select required name="type" class="form-control">
                            <option selected disable value="">Escolha um tipo</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->type_title}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Status:</label>
                          <select required name="status" class="form-control">
                            <option selected disable value="">Escolha um status</option>
                             @foreach ($status as $status)
                              <option value="{{$status->id}}">{{$status->status_title}}</option>
                            @endforeach
                          </select>
                        </div>

                        
                      </div>
                    </div>
                  </div>


                  <div class="card card-outline card-gray shadow">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-undo mx-1"></i>
                      Recorrência
                    </div>
                    <div class="card-body">
                      <div class="row d-flex items-center">
                        <div class="col-md-4 col-12">
                          <div class="form-check">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <input name="is_recurrent" value="1" type="checkbox" class="custom-control-input" id="customSwitch3">
                              <label class="custom-control-label" for="customSwitch3">Este serviço é recorrente??</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Recorrência:</label>
                        <input type="text" name="recurrence" class="form-control" id="exempleImputServiceTitle" placeholder="4 dias">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Atendimentos deste contrato:</label>
                        <input type="text" name="amount" class="form-control" id="exempleImputServiceTitle" placeholder="Quantidade de atendimentos">
                        </div>
                      </div>
                    </div>
                  </div>


                  
                
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary shadow">Cadastrar</button>
                <a class="btn btn-secondary shadow" href="{{ route('OS'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

@stop