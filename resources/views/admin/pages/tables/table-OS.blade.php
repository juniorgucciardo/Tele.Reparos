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
            <th>Data e hora</th>
            <th>Atividade</th>
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
             - 
                @php
                $hora = explode(' ', $attend->data_inicial)[1];
                $hora = date('H:i', strtotime($hora));
            @endphp
            {{$hora}}
            </td>
            <td>{{ $attend->orders->service->service_title }}</td>
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
            <td>
                <div class="row d-flex nowrap">
                        <a href="{{ route('attend.show' ,$attend->id) }}">
                            <button class=" btn-sm btn-warning">
                                <i class="fas fa-eye"></i>
                            </button>
                        </a>
                        <a href="{{ route('attend.edit' ,$attend->id) }}">
                            <button class=" btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>
                        <form action="{{ route('attend.destroy', $attend->id)}}" method="post">
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