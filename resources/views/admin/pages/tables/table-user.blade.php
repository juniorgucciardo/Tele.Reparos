<style>
    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        .tableResponsive tr{
        display: flex;
        flex-direction: column;
        margin: 1rem 0;
    }

    .tableResponsive thead{
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

<table id="table" class="table tableResponsive table-striped">
    <thead>
        <tr>
            <th>cliente</th>
            <th>Data e hora</th>
            <th>Atividade</th>
            <th>Tipo</th>
            <th>Status</th>
        </tr>
    </thead>
    @php
   @endphp
    <tbody>
        @foreach ($attends as $attend)
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
            <td class="cliente">{{ $attend->orders->nome_cliente }}</td>
            <td>
                @php
                    $data = explode(' ', $attend->data_inicial)[0];
                    $data = date('d/m', strtotime($data));
                @endphp
                {{$data}}
                -
                @php
                    $hora = explode(' ', $attend->data_inicial)[1];
                    $hora = date('H:i', strtotime($hora));
                @endphp
                {{$hora}}
            </td>
            <td>{{ $attend->orders->service->service_title }}</td>
            <td>{{$attend->orders->type->type_title}}</td>
            
            <td><div class="badge badge-{{$statusColor}} p-2">{{$attend->status->status_title}}</div></td>
        </tr>
       @endforeach
    </tbody>
</table>
