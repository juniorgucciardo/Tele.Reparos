
<table>
    <thead>
    <tr>
        <th>Nome do cliente</th>
        <th>Data</th>
        <th>Funcionário responsável</th>
        <th>Turno</th>
        <th>Atividade</th>
        <th>Tipo de serviço</th>
        <th>Observação</th>
    </tr>
    </thead>
    <tbody>
@foreach ($users as $user)
    @foreach($user->service_order as $order)
        <tr>
            <td>{{ $order->nome_cliente }}</td>
            <td>{{ $order->data_ordem }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $order->hora_ordem }}</td>
            <td> {{$order->service->service_title}} </td>
            <td>{{ $order->type->type_title }}</td>
            <td>{{ $order->descricao_servico }}</td>
        </tr>
    @endforeach
@endforeach
    </tbody>
</table>
