{{-- CARD DAS DEMANDAS DE HOJE --}}

@php
switch ($attend->status->id) {
    case '1': //solicitado
        $statusColor = 'secondary';
        break;
    case '2': //agendado
        $statusColor = 'info';
        break;
    case '3': //execução
        $statusColor = 'primary';
        break;
    case '4': //concluido
        $statusColor = 'success';
        break;
    case '5': //atrasado
        $statusColor = 'warning';
        break;
    case '6': //cancelado
        $statusColor = 'danger';
        break;
    default:
        $statusColor = 'primary';
        break;
    }
@endphp
<div class="card card-outline card-{{$statusColor}} shadow rounded">
  <div class="card-header py-2">
      <div class="d-flex d-flex-row justify-content-between">
          <div class="">
            <span>{{$attend->orders->service->service_title}}</span>
            @php
                $hora = explode(' ', $attend->data_inicial)[1];
            @endphp
        <span class="mx-3">{{date('H:i', strtotime($hora))}}</span>
          </div>
          <div>
              <div class="dropdown">
                <button class="btn-sm btn-{{$statusColor}} dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ações
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ route('attend.show', $attend->id) }}"><span title="Visualizar informações deste serviço"><i class=" fas fa-eye mx-1"></i> Execução deste atendimento</span></a>
                  <a class="dropdown-item" href="{{ route('get.os', $attend->id) }}"><i class="fas fa-file-download mx-1"></i> Imprimir OS</a>
                  <a class="dropdown-item" href="{{ route('OS.contract', $attend->orders->id) }}"><i class="fas fa-edit mx-1"></i> Alterar informações do cliente</a>
                  <a class="dropdown-item" href="{{ route('attend.edit', $attend->id) }}"><i class="fas fa-edit mx-1"></i> Editar informações do atendimento</a>
                </div>
              </div>
          </div>
      </div>
  </div>
  <div class="card-body py-3">
      <div class="d-flex flex-column w-100 justify-content-between">
          <div class="flex-row">
              <div>
                  Cliente: <b><span>{{mb_strimwidth($attend->orders->nome_cliente, 0, 24, "...")}}</span></b>
              </div>
              <div>
                  @if(!$attend->users->isEmpty())
                    <div class="flex-row">
                        <i class="fas fa-users-cog"></i>
                        @foreach ($attend->users as $user)
                        @php
                            $name = explode(' ', $user->name);
                        @endphp
                        <a href="{{route('user.view', $user->id)}}"><span class="badge badge-{{$statusColor}}" title="Visualizar prestador">{{$name[0]}}</span></a>
                        @endforeach
                        
                    </div>
                  @endif
              </div>
          </div>
          <div class="d-flex my-1 justify-content-between items-center">
              
                <div class="btn-group my-2">
                    <a class="btn-sm btn-{{$statusColor}} rounded"  href="{{ route('OS.contract', $attend->orders->id) }}" title="Informações desse atendimento"><i class="fas fa-info"></i> Ver Serviço</a>
                    <button class="btn-sm btn-outline-{{$statusColor}}" data-toggle="modal" data-target="#schedulle-modal{{$attend->id}}">
                        <i class="fas fa-calendar-week"></i> Agendar
                    </button>
                    @include('admin.pages.modal.schedulle', ['a' => $attend, $users])  
                </div>
                <span class="badge bg-{{$statusColor}}">{{mb_strimwidth($attend->status->status_title, 0, 16, "...")}}</span>

              


          </div>
      </div>
  </div>
</div>