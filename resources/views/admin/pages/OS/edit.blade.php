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

    <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">Edite um registro</h4>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('OS.update', $service_order->id) }}" method="POST">
              @csrf
              @method('PUT')


              <div class="card-body">
                <div class="form-group">
                  
                  {{-- Informações do cliente --}}
                  <div class="card">
                    <div class="card-header">
                      <i class="fas fa-user-friends mx-3"></i>
                      Informações o cliente
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <label for="exampleInputEmail1">Nome do cliente</label>
                      <input type="text" name="nome_cliente" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->nome_cliente }}">
                        </div>
                        <div class="col-md-6 col-12">
                          <label for="exampleInputEmail1">Contato:</label>
                      <input type="text" name="contato_cliente" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->contato_cliente }}">
                        </div>
                      </div>
                    </div>
                  </div>


                  {{-- Endereço da demanda --}}
                  <div class="card">
                    <div class="card-header">
                      <i class="fas fa-map-marked-alt mx-2"></i>
                      Endereço da demanda
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Rua:</label>
                      <input type="text" name="rua_cliente" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->rua_cliente }}">
                        </div>
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">Numero:</label>
                      <input type="text" name="numero_cliente" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->numero_cliente }}">
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Bairro:</label>
                      <input type="text" name="bairro_cliente" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->bairro_cliente }}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 col-12">
                          <label for="exampleInputEmail1">Cidade:</label>
                      <input type="text" name="cidade_cliente" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->cidade_cliente }}">
                        </div>
                      </div>
                    </div>
                  </div>



                  {{-- Informações sobre o serviço --}}
                  <div class="card">
                    <div class="card-header">
                      <i class="fas fa-tools mx-3"></i>
                      Serviço
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-5 col-12">
                          <label for="exampleInputEmail1">Serviço:</label>
                      <select name="id_service" class="form-control">
                        <option selected value="{{$service_order->service->id}}">{{$service_order->service->service_title}}</option>
                        @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->service_title}}</option>
                        @endforeach
                      </select>
                        </div>
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">DATA:</label>
                      <input type="datetime" name="data_ordem" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->data_ordem }}">
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">HORA:</label>
                      <input type="datetime" name="hora_ordem" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->hora_ordem }}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-7 col-12">
                          <label for="exampleInputEmail1">Descrição:</label>
                      <textarea type="text" name="descricao_servico" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->descricao_servico }}"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>


            
                  {{-- Informações adicionais --}}

                  <div class="card">
                    <div class="card-header">
                      <i class="fas fa-info-circle mx-3"></i>
                      Informações adicionais
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">FUNCIONÁRIO:</label>
                        <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="
                        selecione
                        ">

                          <optgroup label="Cadastrados">
                            @foreach ($service_order->user as $user)
                            <option selected value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                            @endforeach
                          </optgroup>

                          @foreach ($users as $user)
                              <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                          @endforeach
                          <option value="">remover</option> 
                        </select>
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Tipo de serviço:</label>
                    <select name="type" class="form-control">
                      <option selected value="{{$service_order->type->id}}">
                        @php
                            if(isset($service_order->type->type_title)){
                              echo $service_order->type->type_title;
                            } else {
                              echo 'Escolha um tipo';
                            }
                        @endphp
                      </option>
                      @foreach ($types as $type)
                          <option value="{{$type->id}}">{{$type->type_title}}</option>
                      @endforeach
                    </select>
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Status:</label>
                    <select name="status" class="form-control">
                        <option selected value="{{$service_order->status->id}}">

                        @php
                            if(isset($service_order->status->status_title)){
                              echo $service_order->status->status_title;
                            } else {
                              echo 'Escolha um Status';
                            }
                        @endphp

                      </option>
                       @foreach ($status as $status)
                        <option value="{{$status->id}}">{{$status->status_title}}</option>
                      @endforeach
                    </select>
                        </div>

                        
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header">
                      <i class="fas fa-undo mx-3"></i>
                      Recorrência
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <div class="form-check">
                            <input name="is_recurrent" type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">É recorrente?</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Recorrencia:</label>
                        <input type="text" name="recurrence" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Quantidade:</label>
                        <input type="text" name="amount" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                      </div>
                    </div>
                  </div>


                  
                
                
              </div>


              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Editar</button>
                <a class="btn btn-secondary" href="{{ route('OS'); }}" role="button">Cancelar</a> 
              </div>
            </form>
    </div>

@stop