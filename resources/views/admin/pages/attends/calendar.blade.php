@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h5>
    <i class="fas fa-calendar"></i>
    Calendário
  </h5>
@stop

@section('content')
<script src="/js/calendarFiltered.js"></script>


            
    
            <div id="calendar" width="100%"></div>
        


@stop