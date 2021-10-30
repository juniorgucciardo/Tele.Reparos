@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
<h4>
  <i class="fas fa-file-contract mx-1"></i>
  editar contrato {{$service_order->id}}
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
              <h5 class="card-title">Edite um registro</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('OS.update', $service_order->id) }}" method="POST">
              @csrf
              @method('PUT')


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
                  <div class="card card-outline card-navy shadow">
                    <div class="card-header">
                      <i class="fas fa-map-marked-alt mx-1"></i>
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
                  <div class="card card-outline card-navy shadow">
                    <div class="card-header">
                      <i class="fas fa-tools mx-1"></i>
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
                          <label for="exampleInputEmail1">Data:</label>
                      <input type="datetime" name="data_ordem" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->data_ordem }}">
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Hora:</label>
                      <input type="datetime" name="hora_ordem" class="form-control" id="exempleImputServiceTitle" value="{{ $service_order->hora_ordem }}">
                        </div>
                      </div>
                      <div class="row  my-1">
                        <div class="col-md-2 col-12">
                          <label for="exampleInputEmail1">Duração em horas</label>
                          <input required type="number" name="duration" class="form-control" id="exempleImputServiceTitle" value="{{$service_order->duration}}">
                        </div>
                        <div class="col-md-10 col-12">
                          <label for="exampleInputEmail1">Descrição:</label>
                          <textarea type="text" name="descricao_servico" class="form-control" id="exempleImputServiceTitle" value="{{$service_order->descricao_servico}}"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>


            
                  {{-- INFORMAÇÕES ADICINAIS --}}


                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-info-circle mx-1"></i>
                      Informações adicionais
                    </div>
                    <div class="card-body">
                      <div class="row  my-1">
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
                          <select required name="type" id="campo" class="form-control" onchange="funcao(this.value)">
                            <option selected disable value="">Escolha um tipo</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->type_title}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Situação:</label>
                          <select required name="situation" class="form-control">
                            <optgroup title="selecionado">
                              <option selected value="{{$service_order->situation->id}}">
                                {{$service_order->situation->title}}
                              </option>
                            </optgroup>
                             @foreach ($situations as $situation)
                              <option value="{{$situation->id}}">{{$situation->title}}</option>
                            @endforeach
                          </select>
                        </div>


                        
                      </div>
                    </div>
                  </div>


                  

                  {{-- Contrato --}}

                  <div class="card card-outline card-gray shadow" id="recorrencia" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-undo mx-1"></i>
                      Recorrência
                    </div>
                    <div class="card-body">
                      <div class="row my-1 d-flex items-center">
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Recorrência:</label>
                          <select required name="recurrence" class="form-control">
                            <optgroup>
                              <option selected value="{{$service_order->recurrence}}">{{$service_order->recurrence}}</option>
                            </optgroup>
                            <option value="1">Diário</option>
                            <option value="7">Semanal</option>
                            <option value="15">Quinzenal</option>
                            <option value="30">Mensal</option>
                            <option value="60">Bimestral</option>
                          </select>
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Duração deste contrato (meses):</label>
                          <input type="text" name="months" class="form-control" id="exempleImputServiceTitle" value="{{$service_order->months}}">
                        </div>
                      </div>
                    </div>
                  </div>



                  {{-- Seguradora --}}

                  <div class="card card-outline card-gray shadow" id="seguradora" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-shield-alt"></i>
                      
                      Seguradora
                    </div>
                    <div class="card-body">
                      <div class="row  my-1 d-flex items-center">
                        
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Nome da seguradora:</label>
                        <input type="text" name="seguradora" class="form-control" id="exempleImputServiceTitle" placeholder="Seguradora">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Código de atendimento</label>
                        <input type="text" name="amount" class="form-control" id="exempleImputServiceTitle" placeholder="Quantidade de atendimentos">
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

    <script>
      var recorrencia = document.getElementById("recorrencia");
      recorrencia.hidden = true;
      var seguradora = document.getElementById("seguradora");
      seguradora.hidden = true;
      
      function funcao(value){
        if(value == 2){
          recorrencia.hidden = false;
        }else if(value == 4){
          recorrencia.hidden = true;
          seguradora.hidden = false;
        }else if(value == 1){
          recorrencia.hidden = true;
          seguradora.hidden = true;
        }
      }
    </script>


@stop