<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\service_order;
use App\Models\Service;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attend;
use App\Models\Checklist;
use App\Models\ChecklistType;
use App\Models\Type;
use App\Models\Situation;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use App\Exports\GeneralReport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;


class OsController extends Controller
{
    

    private $repositoryService;
    private $repositoryUser;
    private $repositoryType;
    private $repositoryStatus;
    private $repositoryOS;
    private $repositorySituation;
    private $repositoryChecklist;

    public function __construct(Service $service, service_order $service_order){
        $this->repositoryService = new Service();
        $this->repositoryOS = new service_order();
        $this->repositoryUser = new User();
        $this->repositoryStatus = new Status();
        $this->repositoryType = new Type();
        $this->repositorySituation = new Situation();
        $this->repositoryAttends = new Attend();
        $this->repositoryChecklist = new Checklist();
    }


    public function index(Request $request)
    {
        $user = auth()->user();
        if(auth()->user()->hasPermissionTo('view_service_demands')){

            return view('admin.pages.OS.index', [
                
                'service_orders' => $this->repositoryOS->search($request),
                'contracts' => $this->repositoryOS->ordersContracts()->count(),
                'ordersSolicited' => $this->repositoryOS->solicited()->get(),
                'insuranceCount' => $this->repositoryOS->ordersInsurance()->count(),
                'condominiumCount' => $this->repositoryOS->ordersCondominium()->count(),
                'looseCount' => $this->repositoryOS->ordersLoose()->count(),
                'users' => $this->repositoryUser->all(),
                'services' => $this->repositoryService->all(),
                'situations' => $this->repositorySituation->all(),
            ]);
        }

        //$service_orders = $this->repositoryOS->where('user_id', auth()->user()->id)->with('user')->get();
        $service_orders = $user->service_order;
        return view('admin.pages.OS.index', [
            'service_orders' => $service_orders
        ]);
    }

    
    public function create()
    {
        if(auth()->user()->can('view_service_demands')){
            $users = $this->repositoryUser->all();
            $services = $this->repositoryService->all();
            $situation = $this->repositorySituation->all();
            $types = $this->repositoryType->all();
            return view('admin.pages.OS.create', [
                'users' => $users,
                'services' => $services,
                'types' => $types,
                'situations' => $situation
            ]);
        } else {
            return redirect('admin/OS');
        }

    }

    public function store(Request $request)
    {   


        if(auth()->user()->can('view_service_demands')){

            // REQUEST

            $service_order = service_order::create([
                'nome_cliente' => $request->nome_cliente,
                'rua_cliente' => $request->rua_cliente,
                'numero_cliente' => $request->numero_cliente,
                'bairro_cliente' => $request->bairro_cliente,
                'cidade_cliente' => $request->cidade_cliente,
                'contato_cliente' => $request->contato_cliente,
                'descricao_servico' => $request->descricao_servico,
                'id_service' => $request->id_service,
                'data_ordem' => $request->data_ordem,
                'hora_ordem' => $request->hora_ordem,
                'type_id' => $request->type ? $request->type : 1,
                'situation_id' => $request->situation ? $request->situation : 3,
                'recurrence' => $request->recurrence ? $request->recurrence : 1,
                'months' => $request->months ? $request->months : 0,
                'insurance' => $request->insurance,
                'insurance_cod' => $request->insurance_cod,
                'duration' => $request->duration ? $request->duration : 4
            ]);

            //RECORRENCIA

            

            $data_inicial = $service_order->data_ordem;
            $hora_inicial = $service_order->hora_ordem;

            $add_days = '+'.$service_order->recurrence.' days';
            $add_attend_duration = '+'.$request->duration.' hours';
            $add_contract_duration = $request->months != 0 ? '+'.$request->months .' months' : $add_attend_duration;

            $attend_start = date('Y-m-d H:i:s', strtotime($data_inicial.$hora_inicial));
            $attend_end = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
            $contract_end = date('Y-m-d H:i:s', strtotime($attend_start. ($add_contract_duration === 0 ? $request->duration : $add_contract_duration)));
            


            while($attend_start <= $contract_end){
                $a = Attend::create([
                    'order_id' => $service_order->id,
                    'data_inicial' => $attend_start,
                    'data_final' => $attend_end,
                    'status_id' => 1
                ]);

                $attend_start = date('Y-m-d H:i:s', strtotime($attend_start. $add_days));
                $attend_end = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
                
            }

             //CHECKLISTS

        //identificar o serviço escolhido e copiar  checklist com id da OS
        $checklistsd = $this->repositoryChecklist->checklistsByService($request->id_service)->where('order_id', NULL)->get();
        //verificar se veio algo desta consulta

        if(!$checklistsd->isEmpty()){
            //dd('nao vazio');
            //foreach para percorrer todos os elementos de checklistd
            foreach($checklistsd as $checklist){
                    $newChecklist = $checklist->replicate();
                    $newChecklist->order_id = $service_order->id; //OS ID
                    $newChecklist->save();
                    //salvar os items no checklist copiado
                    dump($newChecklist);
                    foreach($checklist->items as $item){
                        $newItem = $item->replicate();
                        $newItem->push();
                        $newItem->checklist_id = $newChecklist->id;
                        $newItem->save();
                        dump($newItem);
                    }
            }

            
        } else {
            var_dump('vazio');    
        } 



            





            return redirect('admin/OS');
        } else {
            return redirect('admin/OS');
        }
    }

    
    public function edit(service_order $service_order, $id)
    {
        if(auth()->user()->can('view_service_demands')){

            return view('admin.pages.OS.edit', [
                'services' => $this->repositoryService->all(),
                'service_order' => service_order::with('situation')->find($id),
                'users' => $this->repositoryUser->all(),
                'types' => $this->repositoryType->all(),
                'situations' => $this->repositorySituation->all()
            ]);
        } else {
            return redirect('admin/OS');
        }
    }


    public function update(Request $request, service_order $service_order, $id)
    {

        if(auth()->user()->can('view_service_demands')){

            $service_order = service_order::findOrFail($id);

            if($service_order->data_ordem === $request->data_ordem){ //data inicio igual

                if($service_order->months === intval($request->months)){  //meses iguais

                    if(($service_order->recurrence === intval($request->recurrence)) AND ($service_order->duration === intval($request->duration))){

                    } else { 
                        
                        $service_order->update([
                            'nome_cliente'      => $request->nome_cliente,
                            'rua_cliente'       => $request->rua_cliente,
                            'numero_cliente'    => $request->numero_cliente,
                            'bairro_cliente'    => $request->bairro_cliente,
                            'cidade_cliente'    => $request->cidade_cliente,
                            'contato_cliente'   => $request->contato_cliente,
                            'descricao_servico' => $request->descricao_servico,
                            'id_service'        => $request->id_service,
                            'data_ordem'        => $request->data_ordem,
                            'hora_ordem'        => $request->hora_ordem,
                            'type_id'           => $request->type,
                            'recurrence'        => $request->recurrence,
                            'months'            => $request->months,
                            'situation_id'      => $request->situation,
                            'insurance'         => $request->insurance,
                            'insurance'         => $request->insurance_cod,
                            'duration'          => $request->duration
                        ]);
                        $service_order->attends()->attendsFuture()->where('status_id', 1)->delete(); //delete atendimentos que nao foram iniciados e nem agendados
                        $data_inicial          = $service_order->data_ordem;
                        $hora_inicial          = $service_order->hora_ordem; 
                        $add_days              = '+'.$service_order->recurrence.' days';
                        $add_attend_duration   = '+'.$request->duration.' hours';
                        $add_contract_duration = '+'.$request->months .' months';
                        $attend_start          = date('Y-m-d H:i:s', strtotime($data_inicial.$hora_inicial));
                        $attend_end            = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
                        $contract_end          = date('Y-m-d H:i:s', strtotime($attend_start. $add_contract_duration));
          
                        while($attend_start <= $contract_end){
                            $a = Attend::create([
                                'order_id'     => $service_order->id,
                                'data_inicial' => $attend_start,
                                'data_final'   => $attend_end,
                                'status_id'    => 1
                            ]);
                            $attend_start = date('Y-m-d H:i:s', strtotime($attend_start. $add_days));
                            $attend_end   = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
                        }
                    }

                } else { //meses diferentes

                    if($request->months > $service_order->months){
                        $diference = intval($request->months) - $service_order->months;
                        $lastAttend = $service_order->attends()->orderBy('data_inicial', 'desc')->pluck('data_inicial')->first();
                        $service_order->update([
                            'nome_cliente' => $request->nome_cliente,
                            'rua_cliente' => $request->rua_cliente,
                            'numero_cliente' => $request->numero_cliente,
                            'bairro_cliente' => $request->bairro_cliente,
                            'cidade_cliente' => $request->cidade_cliente,
                            'contato_cliente' => $request->contato_cliente,
                            'descricao_servico' => $request->descricao_servico,
                            'id_service' => $request->id_service,
                            'data_ordem' => $request->data_ordem,
                            'hora_ordem' => $request->hora_ordem,
                            'type_id' => $request->type,
                            'recurrence' => $request->recurrence,
                            'months' => $request->months,
                            'situation_id' => $request->situation,
                            'insurance' => $request->insurance,
                            'insurance' => $request->insurance_cod,
                            'duration' => $request->duration
                        ]);
                        $add_days              =  '+'.$request->recurrence.' days';
                        $add_attend_duration   =  '+'.$request->duration.' hours';
                        $add_contract_duration =  '+'.$diference.' months';
                        $attend_start          =  date('Y-m-d H:i:s', strtotime($lastAttend));
                        $attend_end            =  date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
                        $contract_end          =  date('Y-m-d H:i:s', strtotime($attend_start. $add_contract_duration));
            
                        while($attend_start <= $contract_end){
                            $attend_start = date('Y-m-d H:i:s', strtotime($attend_start. $add_days)); //O laço começa no dia do ultimo atendimento cadastrado
                            $attend_end = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration)); /// por isso tem que incrementar + os dias da recorrencia antes
                            $a = Attend::create([
                                'order_id' => $service_order->id,
                                'data_inicial' => $attend_start,
                                'data_final' => $attend_end,
                                'status_id' => 1
                            ]); 
                        }
                    
                    } else {
                        $diference = intval($request->months) - $service_order->months;
                        $service_order->update([
                        'nome_cliente' => $request->nome_cliente,
                        'rua_cliente' => $request->rua_cliente,
                        'numero_cliente' => $request->numero_cliente,
                        'bairro_cliente' => $request->bairro_cliente,
                        'cidade_cliente' => $request->cidade_cliente,
                        'contato_cliente' => $request->contato_cliente,
                        'descricao_servico' => $request->descricao_servico,
                        'id_service' => $request->id_service,
                        'data_ordem' => $request->data_ordem,
                        'hora_ordem' => $request->hora_ordem,
                        'type_id' => $request->type,
                        'recurrence' => $request->recurrence,
                        'months' => $request->months,
                        'situation_id' => $request->situation,
                        'insurance' => $request->insurance,
                        'insurance' => $request->insurance_cod,
                        'duration' => $request->duration
                    ]);
                    $oldAttendLast = $service_order->attends()->orderBy('data_inicial', 'desc')->pluck('data_inicial')->first();
                    $newAttendLast = date('Y-m-d H:i:s', strtotime($oldAttendLast. ''.$diference.' months')); //diminuir meses
                    $service_order->attends()->where('status_id', 1)->whereBetween('data_inicial', [$newAttendLast, $oldAttendLast])->delete();                                                                       //menor
                    }
                }
                
            } else {   //data inicial diferente

                $service_order->update([
                    'nome_cliente' => $request->nome_cliente,
                    'rua_cliente' => $request->rua_cliente,
                    'numero_cliente' => $request->numero_cliente,
                    'bairro_cliente' => $request->bairro_cliente,
                    'cidade_cliente' => $request->cidade_cliente,
                    'contato_cliente' => $request->contato_cliente,
                    'descricao_servico' => $request->descricao_servico,
                    'id_service' => $request->id_service,
                    'data_ordem' => $request->data_ordem,
                    'hora_ordem' => $request->hora_ordem,
                    'type_id' => $request->type,
                    'recurrence' => $request->recurrence,
                    'months' => $request->months,
                    'situation_id' => $request->situation,
                    'insurance' => $request->insurance,
                    'insurance' => $request->insurance_cod,
                    'duration' => $request->duration
                ]);
                $service_order->attends()->where('status_id', 1)->delete(); //delete atendimentos que nao foram iniciados e nem agendados
                $data_inicial = $service_order->data_ordem;
                $hora_inicial = $service_order->hora_ordem; 
                $add_days = '+'.$service_order->recurrence.' days';
                $add_attend_duration = '+'.$request->duration.' hours';
                $add_contract_duration = '+'.$request->months .' months';
                $attend_start = date('Y-m-d H:i:s', strtotime($data_inicial.$hora_inicial));
                $attend_end = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
                $contract_end = date('Y-m-d H:i:s', strtotime($attend_start. $add_contract_duration));
  
                while($attend_start <= $contract_end){
                    $a = Attend::create([
                        'order_id' => $service_order->id,
                        'data_inicial' => $attend_start,
                        'data_final' => $attend_end,
                        'status_id' => 1
                    ]);
                    $attend_start = date('Y-m-d H:i:s', strtotime($attend_start. $add_days));
                    $attend_end = date('Y-m-d H:i:s', strtotime($attend_start. $add_attend_duration));
                }
            }

            return redirect('admin/OS');
        } else {
            return redirect('admin/OS');
        }
        
    }


    public function destroy(service_order $service_order, $id)
    {
        if(auth()->user()->can('view_service_demands')){
            $service_order = service_order::findOrFail($id);
            $service_order->attends()->attendsFuture()->delete();
            $service_order->user()->detach();
            $service_order->update([
                'situation_id' => 4
            ]);
            return redirect('admin/OS');
        } else {
            return redirect('admin/OS');
        }
    }

    public function accept(Request $request, service_order $service_order, $id)
    {

        if(auth()->user()->can('view_service_demands')){


             $service_order = service_order::findOrFail($id);

            $service_order->user()->sync($request->user_id);
             $service_order->update([
            'situation_id' => 1,
             'data_ordem' => $request->data_ordem,
             'hora_ordem' => $request->hora_ordem,
        //     'status_id' => $request->status_id
         ]);
             return redirect('admin');
        } else {
            return redirect('admin');
        }

    }

    public function export() 
    {
        if(auth()->user()->can('view_service_demands')){
            return Excel::download(new GeneralReport, 'RelatorioGeral.pdf');
            
        }

    }

    public function attedsByContract($id){

        $contract = service_order::with('service', 'user', 'img_contract')->findOrFail($id);
        $attends = Attend::attendsFuture()->where('order_id', $id)->with('users')->with('orders.service')->with('status')->with('orders.type')->get();
        $attendInExec = Attend::attendsForExecute()->attendsFuture()->select('id')->where('order_id', $id)->whereIn('status_id', [2, 3])->orderBy('status_id', 'desc')->first();
        if($attendInExec === null){
            //nao existe atendimento no mommento
            $activities = $this->repositoryChecklist->where('service_id', $contract->id_service)->where('type_id', 1)->checklistDefault()->get();
        } else {
            //existe atendimento -> prcurar checklist do atendimento com 
            $activities = $this->repositoryChecklist->checklistByAttend($attendInExec->id)->get();
        }


        $checklists = $this->repositoryChecklist->checklistByOS($id)->general()->get();

        return view('admin.pages.OS.details', [
            'attends' => $attends,
            'contract' => $contract,
            'executing' => $attendInExec,
            'activities' => $activities,
            'checklists' => $checklists,
            'checklistTypes' => ChecklistType::all(),
            'users' => User::all(),
            'status' => Status::all(),
        ]);
    }

    public function changeStatus(Request $request, service_order $service_order, $id){
        if(auth()->user()->can('view_service_demands')){
            $service_order = service_order::findOrFail($id);
            $service_order->update([
                'status_id' => $request->status_id
            ]);
            return redirect('admin');
        } else {
            return redirect('admin');
        }

    }

}
