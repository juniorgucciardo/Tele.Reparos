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
            <th class="none"data-priority="1">cliente</th>
            <th class="none"data-priority="1">Data</th>
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
       @foreach ($attendsNext as $a)
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
            <td class="cliente"><a href="{{ route('OS.contract', $a->orders->id) }}">{{ $a->orders->nome_cliente }}</a></td>
            <td>
                @php
                    $data = date('d/m/Y', strtotime(explode(' ', $a->data_inicial)[0]));
                    $hora = date('H:i', strtotime(explode(' ', $a->data_inicial)[1]));
                @endphp
                {{$data}}  {{$hora}}
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
                    <button class="p-2 rounded shadow btn-sm btn-primary bolder" data-toggle="modal" data-target="#schedulle-modal{{$a->id}}">
                        <i class="fas fa-calendar-week mx-2"></i>Agendamento
                    </button>
                    @include('admin.pages.modal.schedulle', [$a, $users])

        
                    
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

        "order": [ 1, "asc" ],

        responsive: true,

    } );

    } );
</script>




