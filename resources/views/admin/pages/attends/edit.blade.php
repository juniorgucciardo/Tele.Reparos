@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
  <i class="fas fa-truck-moving mx-1"></i>
  editar Atendimento {{$attend->id}}
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
              <h5 class="card-title">Edite um registro</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('attend.update', $attend->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  
                  {{-- Informações do cliente --}}
                  <div class="card shadow">
                    <div class="card-header">
                      <i class="fas fa-file-contract mx-1"></i>
                      Informações do contrato
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <label for="exampleInputEmail1">Selecione o contrato</label>
                          <select name="order_id" class="form-control">
                              <optgroup label="cadastrado">
                                    <option value="{{$attend->order_id}}">{{$attend->orders->nome_cliente}} - {{$attend->orders->service->service_title}}</option>
                              </optgroup>
                              <optgroup label="todos">
                                @foreach ($contracts as $contract)
                                <option value="{{$contract->id}}">{{$contract->nome_cliente}} - {{$contract->service->service_title}}</option>
                                 @endforeach
                              </optgroup>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>


                  {{-- Endereço da demanda --}}
                  <div class="card shadow">
                    <div class="card-header">
                        <i class="fas fa-clock mx-1"></i>
                      Informações sobre a demanda
                    </div>
                    <div class="card-body">
                      <div class="row">
                          @php
                            $start = new DateTime($attend->data_inicial);
                            $end = $start->diff(new DateTime($attend->data_final));
                            $hours = $end->h;
                          @endphp       
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Data:</label>
                          <input type="date" name="data" class="form-control" id="exempleImputServiceTitle" value="{{explode(' ', $attend->data_inicial)[0]}}">
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="exampleInputEmail1">Hora:</label>
                            <input type="time" name="hora" class="form-control" id="exempleImputServiceTitle" value="{{explode(' ', $attend->data_inicial)[1]}}">
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="exampleInputEmail1">Duração em horas:</label>
                            <input type="number" value="4" name="quantidade" class="form-control" id="exempleImputServiceTitle" value="{{$hours}}">
                          </div>
                      </div>
                    </div>
                  </div>



                  


                  <div class="card shadow">
                    <div class="card-header">
                      <i class="fas fa-undo mx-1"></i>
                      Funcionários
                    </div>
                    <div class="card-body">
                      <div class="row">

                        <div class="col-md-8 col-12">
                          <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker" data-live-search="true" title="
                        selecione
                        ">

                          <optgroup label="Cadastrados">
                            @foreach ($attend->users as $user)
                            <option selected value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                            @endforeach
                          </optgroup>

                          @foreach ($users as $user)
                              <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                          @endforeach
                        </select>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  <div class="card shadow">
                    <div class="card-header">
                      <div class="card-title">
                        Status
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Status:</label>
                    <select name="status_id" class="form-control">
                        <option selected value="{{$attend->status->id}}">

                        @php
                            if(isset($attend->status->status_title)){
                              echo $attend->status->status_title;
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


                  
                
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary shadow">Cadastrar</button>
                <a class="btn btn-secondary shadow" href="{{ route('attend'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

@stop