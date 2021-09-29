@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h4>Ordens de Serviço</h4>
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
              <h4 class="card-title">Cadastre uma nova ordem de serviço no sistema</h4>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('OS.create') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <div class="row my-3">
                    <div class="col-md-6 col-12">
                      <label for="exampleInputEmail1">Nome do cliente</label>
                      <input type="text" name="nome_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Nome do cliente">
                    </div>
                    <div class="col-md-6 col-12">
                      <label for="exampleInputEmail1">Contato:</label>
                      <input type="text" name="contato_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Contato do cliente">
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-4 col-12">
                      <label for="exampleInputEmail1">Rua:</label>
                      <input type="text" name="rua_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                    <div class="col-md-3 col-12">
                      <label for="exampleInputEmail1">Numero:</label>
                      <input type="text" name="numero_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                    <div class="col-md-4 col-12">
                      <label for="exampleInputEmail1">Bairro:</label>
                      <input type="text" name="bairro_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-8 col-12">
                      <label for="exampleInputEmail1">Cidade:</label>
                      <input type="text" name="cidade_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-5 col-12">
                      <label for="exampleInputEmail1">Serviço:</label>
                      <select name="id_service" class="form-control">
                        @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->service_title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-7 col-12">
                      <label for="exampleInputEmail1">Descrição:</label>
                      <input type="text" name="descricao_servico" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-3 col-12">
                      <label for="exampleInputEmail1">DATA:</label>
                      <input type="date" name="data_ordem" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                    <div class="col-md-3 col-12">
                      <label for="exampleInputEmail1">FUNCIONÁRIO:</label>
                        <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="
                        selecione
                        ">

                          @foreach ($users as $user)
                              <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                          @endforeach
                          <option value="">remover</option> 
                        </select>
                    </div>
                    <div class="col-md-5 col-12">
                      <label for="exampleInputEmail1">HORA:</label>
                      <input type="time" name="hora_ordem" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-4 col-12">
                      <label for="exampleInputEmail1">Status:</label>
                      <select name="status" class="form-control">
                        <option selected disable value="">Escolha um status</option>
                         @foreach ($status as $status)
                          <option value="{{$status->id}}">{{$status->status_title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 col-12">
                      <label for="exampleInputEmail1">Tipo de serviço:</label>
                      <select name="type" class="form-control">
                        <option selected disable value="">Escolha um tipo</option>
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->type_title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a class="btn btn-secondary" href="{{ route('OS'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

@stop