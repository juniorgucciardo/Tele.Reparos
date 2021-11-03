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
        <tr>
            <td><a href="{{ route('OS.contract', $a->orders->id) }}">{{ $a->orders->nome_cliente }}</a></td>
            <td>
                @php
                    $data = explode(' ', $a->data_inicial)[0];
                    $data = date('d/m/Y', strtotime($data));
                @endphp
                {{$data}}
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
            <td class="status-badge"><div class="badge badge-secondary p-2">{{ $a->status->status_title}}</div></td>
            
            <td>
                <div class="btn-group">
                    <button class="p-2 rounded shadow btn-sm btn-primary bolder" data-toggle="modal" data-target="#schedulle-modal{{$a->id}}">
                        <i class="fas fa-calendar-week mx-2"></i>Agendamento
                    </button>
                    @include('admin.pages.modal.schedulle')
                    
                </div>
                </td>
            
        </tr>
       @endforeach
    </tbody>
</table>

