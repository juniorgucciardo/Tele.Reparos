@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
  <i class="fas fa-truck-moving mx-1"></i>
  novo Atendimento
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
              <h5 class="card-title">Novo atendimento de um contrato</h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('attend.create') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  
                  {{-- Informações do cliente --}}
                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-file-contract mx-1"></i>
                      Informações do contrato
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <label for="exampleInputEmail1">Selecione o contrato</label>
                          <select name="order_id" class="form-control">
                            @foreach ($contracts as $contract)
                                <option value="{{$contract->id}}">{{$contract->nome_cliente}} - {{$contract->service->service_title}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>


                  {{-- Endereço da demanda --}}
                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                        <i class="fas fa-clock mx-1"></i>
                      Informações sobre a demanda
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Data:</label>
                          <input type="date" name="data" class="form-control" id="exempleImputServiceTitle" placeholder="data">
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="exampleInputEmail1">Hora:</label>
                            <input type="time" name="hora" class="form-control" id="exempleImputServiceTitle" placeholder="hora">
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="exampleInputEmail1">Duração em horas:</label>
                            <input type="number" value="4" name="quantidade" class="form-control" id="exempleImputServiceTitle" placeholder="duração em horas">
                          </div>
                      </div>
                    </div>
                  </div>



                  


                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-undo mx-1"></i>
                      Funcionários
                    </div>
                    <div class="card-body">
                      <div class="row">
        
                        <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker col-12 border" data-live-search="true" title="
                            selecione
                            ">
    
                              @foreach ($users as $user)
                                  <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                              @endforeach
                              <option value="">remover</option> 
                            </select>
                        
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