@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
@php
    $hora = Carbon\Carbon::now()->format('H');
    $firstdate = Carbon\Carbon::now()->format('Y-m-d');
    $seconddate = date('y-m-d', strtotime($firstdate. ' + 2 days'));
@endphp

    <h4> 
        @if ($hora >= 06 && $hora <= 12)
            Bom dia,
        @endif
        @if ($hora >= 13 && $hora <= 18)
            Boa tarde,
        @endif
        @if ($hora >= 19 && $hora <= 24)
            Boa noite,
        @endif
        @if ($hora >= 00 && $hora <= 05)
            Boa madrugada,
        @endif
        {{($username)}}
    </h4>
@stop

@section('content')



    {{-- PRELOADER --}}
    <style>
        .preloader{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .conteudo-preloader{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .servicesNow{
            height: 760px;
            overflow: scroll;
        }

        .servicosAgendados{
            display: flex;
            flex-wrap: unset;
            max-height: 375px;
            overflow-x: scroll;
        }




    </style>

    <div class="preloader">
        <div class="card-info conteudo-preloader">
            <img width="150px" height="150px" src="/img/brand.png" alt="">
        </div>
    </div>

    {{-- SCRIPT CALENDARIO --}}

    <script src="/js/calendar.js"></script> 








     {{-- RESUMO --}}

     <div class="absolute">

     </div>
     
     <div class="row">

                    {{-- solicitações --}}
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Solicitações de Atendimento</span>
              <span class="info-box-number">
                {{$OrdersDemandads}}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-secondary"><i class="far fa-flag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Atendimentos finalizados</span>
              <span class="info-box-number">{{$atendimentosConcluidos}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fas fa-clock"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Atendimentos Atrasados</span>
              <span class="info-box-number">{{$atendimentosAtrasados}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-clipboard-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Serviços em andamento agora</span>
              <span class="info-box-number">{{$andamentoAgora}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">

        {{-- ATIVIDADES EM ANDAMENTO AGORA --}}

        <div class="col-md-4 col-sm-12 col-12">
            <div class="card card-info shadow-sm">
                <div class="card-header">
                  <span style="text-color: #fff; font-weight:600">Atividades em andamento hoje, {{date('d/m', strtotime($firstdate));}} 
                </div>
                <div class="card-body servicesNow">
                    {{-- laço dos cards --}}
                    @php
                        $d1 = date('Y-m-d H:i:s', strtotime(Carbon\Carbon::now()->format('Y-m-d'). '01:00:00'));
                        $d2 = date('Y-m-d H:i:s', strtotime(Carbon\Carbon::now()->format('Y-m-d'). '18:00:00'));
                    @endphp

                    <a href="{{route('attend')}}"><button type="button" class="mb-3 btn btn-info shadow-md" data-toggle="modal" data-target="#osDetails" data-whatever="@getbootstrap"><span><i class=" fas fa-eye mx-1"></i></span>Ver tudo</button></span></a>


                  @foreach ($attendsNow->sortBy('data_inicial') as $attend)
                    @include('components.attend-card');
                  @endforeach

                </div>
            </div>
        </div>


        {{-- CALENDARIO --}}


        <div class="col-md-8 col-sm-12 col-12">
            
            <div class="card-info shadow-sm bg-light">
                <div class="card-header">
                    Calendário 
                    
                </div>
                <div class="card-body">
                    <a href="{{route('OS.create')}}"><button type="button" class="mb-3 btn btn-info shadow-md"><i class="fas fa-truck-moving mx-1"></i>Novo Atendimento</button></a>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    
      </div>

      {{-- ATENDIMENTOS DA PROXIMA SEMANA --}}


      <div class="card card-success my-2">
        <div class="card-header">
            @php
            $d1 = Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $d2 = date('Y-m-d H:i:s', strtotime($firstdate. ' + 8 days')); //gerar data somando 7 dias da data atual
            @endphp
            <span style="text-color: #fff; font-weight:600">Próximos serviços</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- tabela de atendimentos da proxima semana --}}
                @include('admin.pages.tables.table-dashboard')
            </div>
        </div>
    </div>


    {{-- SOLICITAÇÕES SITE --}}

    <div class="card card-info">
        <div class="card-header">
            Solicitações do site
        </div>
        <div class="card-body">
            <div class="row d-flex">
                @foreach ($ordersSolicited as $solicited)
                    @include('components.solicitation-card', $solicited)
                @endforeach
            </div>
        </div>
    </div>


    

@stop
