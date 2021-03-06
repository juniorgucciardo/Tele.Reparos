<style>
    .id{
        display: none;
    }
    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        .tableResponsive tr{
        display: flex;
        flex-direction: column;
    }

    .tableResponsive thead{
        display: none;
    }
    .status-badge{
        text-align: left;
    }
    .cliente{
        font-weight: 600;
        font-size: 1.1rem
    }
    .id{
        display: inline
    }
    }

    
</style>

<table id="table" class="table tableResponsive table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Data</th>
            <th>hora</th>
            <th>Duração do atendimento</th>
            <th>Funcionário</th>
            <th>Status</th>
             @can('view_service_demands')
                <th> Funções </th>
            @endcan
        </tr>
    </thead>
    @php
   @endphp
    <tbody>
       @foreach ($attends->sortByDesc('data_inicial') as $attend)
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
        <tr>
            <td><div class="id">id: </div>{{ $attend->id}}</td>
            <td class="cliente">
                @php
                $data = explode(' ', $attend->data_inicial)[0];
                $data = date('d/m/Y', strtotime($data));
            @endphp
            {{$data}}
            </td>
            <td>
                @php
                $hora = explode(' ', $attend->data_inicial)[1];
                echo date('H:i', strtotime($hora));
                $hora = \Carbon\Carbon::parse($hora);
                $final = explode(' ', $attend->data_final)[1];
                $final = \Carbon\Carbon::parse($final);
                $totalDuration = $final->diffInHours($hora);
            @endphp
        
            </td>
            <td>
                @php
                if($attend->status_id > 3){
                    echo 'atendimento durou '.$totalDuration.' hora';
                } else {
                    echo 'duração estimada de '.$totalDuration.' horas';
                }
                @endphp
            </td>
            <td>
                @foreach ($attend->users as $user)
                    @php
                        $name = explode(' ', $user->name)[0];
                    @endphp
                <a href="{{ route('user.view', $user->id) }}"><span class="badge badge-primary">{{$name}}</span></a>
                @endforeach
            </td>
            <td><div class="badge badge-{{$statusColor}} p-2">{{$attend->status->status_title}}</div></td>
            @can('view_service_demands')
            <td class="btn-group">
                <a href="{{ route('attend.show' ,$attend->id) }}">
                    <button class=" btn-sm btn-warning">
                        <i class="fas fa-eye"></i>
                    </button>
                </a>
                <button class="btn-sm btn-primary" data-toggle="modal" data-target="#schedulle-modal{{$attend->id}}">
                    <i class="fas fa-calendar-week"></i>
                </button>
                @include('admin.pages.modal.schedulle', ['a' => $attend, $users])
                <form action="{{ route('attend.destroy', $attend->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn-sm btn-danger" type="submit">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
            @endcan
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

            "order": [ 0, "asc" ],

            responsive: true,

        } );
    } );
</script>

