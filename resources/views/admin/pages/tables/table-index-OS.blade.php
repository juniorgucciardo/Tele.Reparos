<table id="table" class="table table-striped tableDashboard">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Atividade</th>
            <th>Tipo</th>
            <th>Cidade</th>
            <th>Situação</th>
            <th>Recorrencia</th>
            <th>Atendimentos do contrato</th>
             @can('view_service_demands')
                <th> Funções </th>
            @endcan
        </tr>
    </thead>
    @php
   @endphp
    <tbody>
       @foreach ($service_orders as $order)
       @php
        switch ($order->situation_id) {
            case '1': //solicitado
                $statusColor = 'warning';
                break;
            case '2': //avaliação
                $statusColor = 'info';
                break;
            case '3': //execução
                $statusColor = 'success';
                break;
            case '4': //cancelado
                $statusColor = 'danger';
                break;
            default:
                $statusColor = 'secondary';
                break;
            }
    @endphp
        <tr>
            <td class="cliente"><a href="{{ route('OS.contract', $order->id) }}">{{ $order->nome_cliente }}</a></td>
            <td>{{ $order->service->service_title}}</td>
            <td>{{$order->type->type_title}}</td>                           
            <td>{{ $order->cidade_cliente }}</td>
            <td><div class="badge badge-{{$statusColor}} p-2">{{ $order->situation->title }}</div></td>
            <td>{{ $order->recurrence}} dias</td>
            <td>{{$order->attends_count}}</td>
            @can('view_service_demands')
            <td>
                <div class="btn-group">
                    <a href="{{ route('OS.contract', $order->id) }}">
                        <button class="btn-sm btn-warning">
                            <i class="fas fa-eye"></i>
                        </button>
                    </a>
                        <a href="{{url("admin/OS/editar/$order->id")}}">
                            <button class="mx-1 btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>
                        <form action="{{ route('OS.destroy', $order->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn-sm btn-danger" type="submit">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                </div>
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

            "order": []

        } );
    } );
</script>

