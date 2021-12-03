@extends('adminlte::page')


@section('title', 'Novo Serviço')

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

                  <div class="row d-flex justify-content-between">

                    <div class="col-md-5 col-12 card card-outline card-navy ">
                      <div class="card-header py-2">
                        <i class="fas fa-user-friends mx-1"></i>
                        Informações o cliente
                      </div>
                      <div class="card-body py-2">
                          <div class="col-md-12 col-12">
                            <label for="exampleInputEmail1">Nome do cliente</label>
                            <input required type="text" name="nome_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Nome do cliente">
                          </div>
                          <div class="col-md-8 col-12 my-1">
                            <label for="exampleInputEmail1">Contato:</label>
                            <input type="tel" name="contato_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Contato do cliente">
                          </div>
                      </div>
                    </div>
                    {{-- Endereço da demanda --}}
                    <div class="col-md-7 col-12 card card-outline card-gray ">
                      <div class="card-header py-2">
                        <i class="fas fa-map-marked-alt mx-1"></i>
                        Endereço da demanda
                      </div>
                      <div class="card-body py-2">
                        <div class="row  my-1">
                          <div class="col-md-5 col-12">
                            <label for="exampleInputEmail1">Rua:</label>
                            <input required type="text" name="rua_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                          </div>
                          <div class="col-md-3 col-12">
                            <label for="exampleInputEmail1">Numero:</label>
                            <input required type="number" name="numero_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                          </div>
                          <div class="col-md-4 col-12">
                            <label for="exampleInputEmail1">Bairro:</label>
                            <input required type="text" name="bairro_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                          </div>
                        </div>
                        <div class="row  my-1">
                          <div class="col-md-8 col-12">
                            <label for="exampleInputEmail1">Cidade:</label>
                            <input required type="text" name="cidade_cliente" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                          </div>
                        </div>
                      </div>
                    </div>


                  </div> {{-- end row --}}



                  {{-- Informações sobre o serviço --}}
                  <div class="card card-outline card-gray shadow">
                    <div class="card-header py-2">
                      <i class="fas fa-tools mx-1"></i>
                      Serviço
                    </div>
                    <div class="card-body py-2">
                      <div class="row  my-1">

                        <div class="col-md-5 col-12" data-toggle="tooltip" data-placement="top" title="Caso você selecione contrato, será gerado uma recorrencia de atendimentos, caso contrário só sera gerado apenas um atendimento">
                          <label for="exampleInputEmail1">Tipo de serviço:</label>
                          <select required name="type" id="campo" class="form-control" onchange="funcao(this.value)">
                            <option selected disable value="0">Escolha um tipo</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->type_title}}</option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">Serviço:</label>
                          <select required name="id_service" class="form-control" onchange="funcao2(this.value)">
                              <option selected disable value="">Escolha o serviço</option>
                            @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->service_title}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-md-4 col-12" data-toggle="tooltip" data-placement="top" title="A situação é responsável por determinar se o contrato ja esta apto para iniciar a ser executado ou se haverá algum processo anterior">
                          <label for="exampleInputEmail1">Situação:</label>
                          <select required name="situation" class="form-control">
                            <option selected value="3">Confirmado</option>
                             @foreach ($situations as $situation)
                              <option value="{{$situation->id}}">{{$situation->title}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                        <div class="row  my-1 d-flex align-items-center">
                        <div class="col-md-8 col-12">
                          <label for="exampleInputEmail1">Descrição:</label>
                          <textarea type="text" name="descricao_servico" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente"></textarea>
                        </div>
                        <div class="col-md-4">
                          {{-- AQUI VAI UM LOOP, COM OS CHECKLISTS DO SERVIÇO E TIPO DE SERVIÇO ADICIONADO --}}
                          <label for="checkbox">Incluir Checklists (caso tenham)</label>
                          <div id="checkbox" class="form-check">
                            <input class="form-check-input" type="checkbox" name="include_activities" value="1">
                            <label class="form-check-label" for="flexCheckDefault">
                              Incluir Checklist de atividades
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="include_products" value="1">
                            <label class="form-check-label" for="flexCheckChecked">
                              Incluir Checklist de materias e produtos
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="include_ipis" value="1">
                            <label class="form-check-label" for="flexCheckChecked">
                              Incluir Checklist de EPI's
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


            
                  {{-- AGENDAMENTO --}}

                  <div class="card card-outline card-gray shadow">
                    <div class="card-header">
                      <i class="fas fa-info-circle mx-1"></i>
                      Agendamento
                    </div>
                    <div class="card-body">
                      <div class="row  my-1">
                        <div class="col-md-4 col-12 d-flex flex-column text-left" id="funcionarios" data-toggle="tooltip" data-placement="top" title="Isso incluirá os funcionários em todos atendimentos gerados">
                          <label for="funcionarios">Funcionário(s):</label>
                            <select multiple name="user_id[]" aria-label="multiple select example" class="selectpicker w-100" data-live-search="true" title="
                            selecione
                            ">
    
                              @foreach ($users as $user)
                                  <option value="{{$user->id}}">{{explode(' ', $user->name)[0]}}</option> 
                              @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 col-12">
                          <label for="exampleInputEmail1">Data:</label>
                          <input required type="date" name="data_ordem" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                        <div class="col-md-2 col-12">
                          <label for="exampleInputEmail1">Hora:</label>
                          <input required type="time" name="hora_ordem" class="form-control" id="exempleImputServiceTitle" placeholder="Rua do cliente">
                        </div>
                      
                    
                      <div class="col-md-3 col-12">
                        <label for="exampleInputEmail1">Duração</label>
                        <input required type="number" name="duration" class="form-control" id="exempleImputServiceTitle" value="4" min="1" max="8" placeholder="4 horas">
                      </div>



                        
                      </div>
                    </div>
                  </div>


                  

                  {{-- Recorrencia --}}

                  <div class="card card-outline card-gray shadow" id="recorrencia" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-undo mx-1"></i>
                      Recorrência
                    </div>
                    <div class="card-body">
                      <div class="row my-1 d-flex items-center">
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Recorrência:</label>
                          <select required name="recurrence_type" class="form-control" onchange="funcaorecurrence(this.value)">
                            <option selected disabled>Selecione uma recorrência</option>
                            <option value="daily">Diário</option>
                            <option value="weekly">Semanal</option>
                            <option value="monthly">Mensal</option>
                          </select>
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Meses</label>
                          <input type="number" name="months" class="form-control" id="exempleImputServiceTitle" placeholder="Meses" value="12">
                        </div>
                      </div>
                      <div class="row my-2">
                        <div class="col-md-3 col-12" id="daysweek">
                          <label for="exampleInputEmail1">Dias da semana</label>
                            <select multiple name="recurrenceWeekdays[]" data-actions-box="true" class="selectpicker" data-live-search="true" title="Selecione o dia da semana">
                              <option value="MO">Segunda-feira</option>
                              <option value="TU">Terça-feira</option>
                              <option value="WE">Quarta-feira</option>
                              <option value="TH">Quinta-feira</option>
                              <option value="FR">Sexta-feira</option>
                              <option value="SA">Sábado</option> 
                            </select>
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
                        <input type="text" name="insurance" class="form-control" id="exempleImputServiceTitle" placeholder="Seguradora">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Código de atendimento</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Quantidade de atendimentos">
                        </div>
                      </div>
                    </div>
                  </div>


                  
                  {{-- Piscineiro

                  <div class="card card-outline card-gray shadow" id="piscineiro" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-swimming-pool"></i>
                      
                      Limpeza de piscina
                    </div>
                    <div class="card-body">
                      <div class="row  my-1 d-flex items-center">
                        
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Tamanho aproximado da piscina</label>
                        <input type="text" name="insurance" class="form-control" id="exempleImputServiceTitle" placeholder="m²">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Produtos</label>
                          <select required name="recurrence" class="form-control">
                            <option selected disabled>Este atendimento inclui produtos?</option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                          </select> 
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Manutenção adicinal</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Manutenção">
                        </div>

                      </div>
                    </div>
                  </div> --}}


                  {{-- Jardinagem --}}

                  {{-- <div class="card card-outline card-gray shadow" id="jardinagem" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-seedling"></i>
                      
                      Jardinagem
                    </div>
                    <div class="card-body">
                      <div class="row  my-1 d-flex items-center">
                        
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Tamanho</label>
                          <select required name="recurrence" class="form-control">
                            <option selected disabled>Selecione um tamanho</option>
                            <option value="1">Pequena monta</option>
                            <option value="2">Média monta</option>
                            <option value="3">Grande monta</option>
                          </select>                        
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Poda de arvores</label>
                          <select required name="recurrence" class="form-control" onchange="funcaoJardinagem(this.value)">
                            <option selected disabled>Este serviço inclui poda de arvores?</option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                          </select> 
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Recolhimento de resíduos</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Recolhimento de galhos e residuos">
                        </div>

                      </div>

                    </div>
                  </div> --}}

{{-- 

                  Pós obra

                  <div class="card card-outline card-gray shadow" id="pos-obra" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-hard-hat"></i>
                      
                      Pós Obra
                    </div>
                    <div class="card-body">
                      <div class="row  my-1 d-flex items-center">
                        
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Quan</label>
                        <input type="text" name="insurance" class="form-control" id="exempleImputServiceTitle" placeholder="m²">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Poda</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Alguma poda incluida?">
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Recolhimento de resíduos</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Recolhimento de galhos e residuos">
                        </div>

                      </div>
                    </div>
                  </div> --}}


                  {{-- Pós obra

                  <div class="card card-outline card-gray shadow" id="limpeza-pesada" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-hard-hat"></i>
                      Limpeza de vidro, calçadas, ou telhado
                    </div>
                    <div class="card-body">
                      <div class="row  my-1 d-flex items-center">
                        
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Serviço em altura</label>
                        <input type="text" name="insurance" class="form-control" id="exempleImputServiceTitle" placeholder="m²">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Vidros</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Quantidade e tamanho dos vidros">
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Limpe</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Recolhimento de galhos e residuos">
                        </div>

                      </div>
                    </div>
                  </div> --}}


                  {{-- Condomínio

                  <div class="card card-outline card-gray shadow" id="condominio" type="hidden">
                    <div class="card-header shadow-sm">
                      <i class="fas fa-building"></i>
                      Condomínio
                    </div>
                    <div class="card-body">
                      <div class="row  my-1 d-flex items-center">
                        
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Serviço em altura</label>
                        <input type="text" name="insurance" class="form-control" id="exempleImputServiceTitle" placeholder="m²">
                        
                        </div>
                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Vidros</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Quantidade e tamanho dos vidros">
                        </div>

                        <div class="col-md-4 col-12">
                          <label for="exampleInputEmail1">Limpe</label>
                        <input type="text" name="insurance_cod" class="form-control" id="exempleImputServiceTitle" placeholder="Recolhimento de galhos e residuos">
                        </div>

                      </div>
                    </div>
                  </div>


                  
                
                
              </div> --}}
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary shadow">Cadastrar</button>
                <a class="btn btn-secondary shadow" href="{{ route('OS'); }}" role="button">Voltar</a> 
              </div>
            </form>
    </div>

    <script>

      

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

      var recorrencia = document.getElementById("recorrencia");
      recorrencia.hidden = true;
      var seguradora = document.getElementById("seguradora");
      seguradora.hidden = true;
      // var piscineiro = document.getElementById("piscineiro");
      // piscineiro.hidden = true;
      // var jardinagem = document.getElementById("jardinagem");
      // jardinagem.hidden = true;
      // var posobra = document.getElementById("pos-obra");
      // posobra.hidden = true;
      // var limpezapesada = document.getElementById("limpeza-pesada");
      // limpezapesada.hidden = true;

      var daysweek = document.getElementById("daysweek");
      daysweek.hidden = true;

      // var condominio = document.getElementById("condominio");
      // condominio.hidden = true;

      // var poda = document.getElementById("poda");
      // poda.hidden = true;

      function funcaorecurrence(value){
        if(value === 'weekly'){
          daysweek.hidden = false;
        } else {
          daysweek.hidden = true;
        }
      }

      
      function funcao(value){
        if(value == 2){
          recorrencia.hidden = false;
        } else {
          recorrencia.hidden = true;
        }
        
        if(value == 4){
          seguradora.hidden = false;
        }else {
          seguradora.hidden = true;
        }
        if(value == 1){
          recorrencia.hidden = true;
          seguradora.hidden = true;
          condominio.hidden = true;
          posobra.hidden = true;
        } 
        if(value == 5){
          recorrencia.hidden = false;
          condominio.hidden = false;
        }else if(value == 3){
          posobra.hidden = false;
        } else {
          posobra.hidden = true;
        }
      }

      // function funcao2(value){
      //   if(value == 1){
      //     jardinagem.hidden = false;
      //   } else {
      //     jardinagem.hidden = true;
      //   }
        
      //   if (value == 5){
      //     piscineiro.hidden = false;
      //   } else {
      //     piscineiro.hidden = true;
      //   }
      //   if (value == 10){
      //     limpezapesada.hidden = false;
      //   } else {
      //     limpezapesada.hidden = true;
      //   } 
      //   if (value == 6){
      //     posobra.hidden = false;
      //   } else {
      //     posobra.hidden = true;
      //   }
      // }

      // function funcaoJardinagem(value){
      //   if(value == 1){
      //     console.log('poda');
      //     poda.hidden = true;
      //   } else if(value == 2){
      //     poda.hidden = true;
      //   }
      // }
    </script>

@stop