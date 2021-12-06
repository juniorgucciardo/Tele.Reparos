<style>
    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        .tableDashboard tr{
        display: flex;
        flex-direction: column;
    }

    .tableDashboard thead{
        display: none;
    }
    .status-badge{
        text-align: left;
    }
    .cliente{
        font-weight: 600;
        font-size: 1.2rem
    }
    }

    
</style>


<table id="table" class="table tableDashboard nowrap stripe">
    <thead>
        <tr>
            <th class="none">cliente</th>
            <th class="none"data-priority="1">Data</th>
            <th class="none"data-priority="1">Hora</th>
            <th class="all"data-priority="0">Atividade</th>
            <th class="all"data-priority="0">Funcionários</th>
            <th class="all"data-priority="0">Status</th>
             @can('view_service_demands')
                <th>Funções</th>
            @endcan
        </tr>
    </thead>
    @php
   @endphp
    <tbody>
       @foreach ($attendsNext->sortBy('data_inicial') as $a)
       @php
                        switch ($a->status->id) {
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
        <tr>
            <td class="cliente"><a href="{{ route('OS.contract', $a->orders->id) }}">{{mb_strimwidth($a->orders->nome_cliente, 0, 25, "...")}}</a></td>
            <td>
               
                {{$a->data_inicial->format('d m y')}}
            </td>
            <td>
                {{$a->data_inicial->format('h:i')}}
            </td>
            <td>{{ $a->orders->service->service_title }}</td>
            <td>
                @foreach ($a->users as $user)
                    @php
                        $name = explode(' ', $user->name)[0];
                    @endphp
                <a href="{{ route('user.view', $user->id) }}"><span class="badge badge-primary">{{$name}}</span></a>
                @endforeach
            </td>
            <td class="status-badge"><div class="badge badge-{{$statusColor}} p-2">{{ $a->status->status_title}}</div></td>
            
            <td>
                <div class="btn-group">
                    <button class="shadow btn btn-primary" data-toggle="modal" data-target="#schedulle-modal{{$a->id}}">
                        <i class="fas fa-calendar-week mx-2"></i>Agendar
                    </button>
                    @include('admin.pages.modal.schedulle', [$a, $users])
                    <div class="dropdown">
                        <button class="btn btn-{{$statusColor}} dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ações
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{ route('attend.show', $a->id) }}"><span title="Visualizar informações deste serviço"><i class=" fas fa-eye mx-1"></i> Execução deste atendimento</span></a>
                          @if ($a->status_id >= 2)
                              <a class="dropdown-item" href="{{ route('get.os', $a->id) }}"><i class="fas fa-file-download mx-1"></i> Imprimir OS</a>
                          @endif
                          <a class="dropdown-item" href="{{ route('OS.contract', $a->orders->id) }}"><i class="fas fa-edit mx-1"></i> Alterar informações do cliente</a>
                          <a class="dropdown-item" href="{{ route('attend.edit', $a->id) }}"><i class="fas fa-edit mx-1"></i> Editar informações do atendimento</a>
                        </div>
                      </div>

        
                    
                </div>
                </td>
            
        </tr>
       @endforeach
    </tbody>
</table>

<script>
    $(document).ready( function () {
    $('#table').DataTable( {

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json' //PT-BR
        },

        "order": [],

        responsive: true,

    } );

    } );
</script>




