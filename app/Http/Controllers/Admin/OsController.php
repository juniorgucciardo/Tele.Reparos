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
use When\When;
use DateTime;
use DB;


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
                'nome_cliente'        => $request->nome_cliente,
                'rua_cliente'         => $request->rua_cliente,
                'numero_cliente'      => $request->numero_cliente,
                'bairro_cliente'      => $request->bairro_cliente,
                'cidade_cliente'      => $request->cidade_cliente,
                'contato_cliente'     => $request->contato_cliente,
                'descricao_servico'   => $request->descricao_servico,
                'id_service'          => $request->id_service,
                'data_ordem'          => $request->data_ordem,
                'hora_ordem'          => $request->hora_ordem,
                'recurrence_type'     => $request->recurrence_type,
                'type_id'             => $request->type               ? $request->type               : 1,
                'situation_id'        => $request->situation          ? $request->situation          : 3,
                'recurrence'          => $request->recurrence         ? $request->recurrence         : 1,
                'months'              => $request->months             ? $request->months             : 0,
                'products_included'   => $request->produtos_incluidos ? $request->produtos_incluidos : 0,
                'work_at_height'      => $request->trabalho_altura    ? $request->trabalho_altura    : 0,
                'omit_duration'       => $request->omitir_duracao     ? $request->omitir_duracao     : 0,
                'own_transport'       => $request->transporte_empresa ? $request->transporte_empresa : 0,
                'is_insurance'        => $request->type == 4          ? 1                            : 0,
                'insurance'           => $request->insurance,
                'insurance_cod'       => $request->insurance_cod,
                'duration'            => $request->duration           ? $request->duration           : 4
            ]);

            
            

            //Checklists

            if($request->include_activities){
                $checklists = $this->repositoryChecklist->checklistsByService($request->id_service)->activities()->checklistDefault()->get();

                foreach($checklists as $checklist){
                    $newChecklist = $checklist->replicate();
                    $newChecklist->order_id = $service_order->id;
                    $newChecklist->save();
                    foreach($checklist->items as $item){
                        $newItem = $item->replicate();
                        $newItem->push();
                        $newItem->checklist_id = $newChecklist->id;
                        $newItem->save();
                    }
                }
            }
            if($request->include_products){
                $productsLists = $this->repositoryChecklist->checklistsByService($request->id_service)->products()->checklistDefault()->get();

                foreach($productsLists as $productsList){
                    $newProductsList = $productsList->replicate();
                    $newProductsList->order_id = $service_order->id;
                    $newProductsList->save();
                    foreach($productsList->items as $item){
                        $newItem = $item->replicate();
                        $newItem->push();
                        $newItem->checklist_id = $newProductsList->id;
                        $newItem->save();
                    }
                }
            }
            if($request->include_ipis){
                $ipisLists = $this->repositoryChecklist->checklistsByService($request->id_service)->ipis()->checklistDefault()->get();

                foreach($ipisLists as $ipisList){
                    $newIpisList = $ipisList->replicate();
                    $newIpisList->order_id = $service_order->id;
                    $newIpisList->save();
                    foreach($ipisList->items as $item){
                        $newItem = $item->replicate();
                        $newItem->push();
                        $newItem->checklist_id = $newIpisList->id;
                        $newItem->save();
                    }
                }
            } 

    
    

            //RECORRENCIA

            if($request->type == 2){
                $startDate = Carbon::parse($request->data_ordem.$request->hora_ordem);
                $count = $request->months;
                $recurrence_type = $request->recurrence_type;
                //Utilizing When Library for generate dates recurring
                $r = new When();
                $r->startDate($startDate);
                if($recurrence_type === 'daily')
                {
                    $r->freq($recurrence_type)
                    ->byday(['MO', 'TU', 'WE', 'TH', 'FR', 'SA'])
                    ->byhour($startDate->format('H'))
                    ->byminute($startDate->format('i'))
                    ->until($startDate->addMonths($count));
                }
                if($recurrence_type === 'weekly')
                {
                    $r->freq($recurrence_type)
                    ->byday($request->recurrenceWeekdays)
                    ->byhour($startDate->format('H'))
                    ->until($startDate->addMonths($count))
                    ->byminute($startDate->format('i'));
                }
                if($recurrence_type === 'monthly')
                {
                    $r->freq('monthly')
                        ->byhour($startDate->format('H'))
                        ->byminute($startDate->format('i'))
                        ->bymonthday($request->daymonth)
                        ->until($startDate->addMonths($count));
                }
    
                $r->generateOccurrences();
            

                foreach($r->occurrences as $occurrence)
                {
                    $a = new Attend();
                    $a->order_id = $service_order->id;
                    $a->data_inicial = $occurrence;
                    $a->data_final = $occurrence->addHours($request->duration);
                    $a->status_id = 1;   
                    $a->save();
                    
                    //funcionário
                    if($request->user_id){
                        $a->users()->sync($request->user_id);
                    }

                }


            } else {
                $a = new Attend();
                    $a->order_id = $service_order->id;
                    $a->data_inicial = $request->data_ordem;
                    $a->data_final = Carbon::parse($request->data_ordem)->addHours($request->duration);
                    $a->status_id = 1;   
                    $a->save();
                    
                    //funcionário
                    if($request->user_id){
                        $a->users()->sync($request->user_id);
                    }
            }



            return redirect()->route('OS.contract', $service_order->id);

        } else {
            return redirect()->back();
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
     
            $service_order->update([
                'nome_cliente'        => $request->nome_cliente,
                'rua_cliente'         => $request->rua_cliente,
                'numero_cliente'      => $request->numero_cliente,
                'bairro_cliente'      => $request->bairro_cliente,
                'cidade_cliente'      => $request->cidade_cliente,
                'contato_cliente'     => $request->contato_cliente,
                'descricao_servico'   => $request->descricao_servico,
                'id_service'          => $request->id_service,
                'data_ordem'          => $request->data_ordem,
                'hora_ordem'          => $request->hora_ordem,
                'recurrence_type'     => $request->recurrence_type,
                'type_id'             => $request->type               ? $request->type               : 1,
                'situation_id'        => $request->situation          ? $request->situation          : 3,
                'recurrence'          => $request->recurrence         ? $request->recurrence         : 1,
                'months'              => $request->months             ? $request->months             : 0,
                'products_included'   => $request->produtos_incluidos ? $request->produtos_incluidos : 0,
                'work_at_height'      => $request->trabalho_altura    ? $request->trabalho_altura    : 0,
                'omit_duration'       => $request->omitir_duracao     ? $request->omitir_duracao     : 0,
                'own_transport'       => $request->transporte_empresa ? $request->transporte_empresa : 0,
                'is_insurance'        => $request->type == 4          ? 1                            : 0,
                'insurance'           => $request->insurance,
                'insurance_cod'       => $request->insurance_cod,
                'duration'            => $request->duration           ? $request->duration           : 4
            ]);

            return redirect()->back();
                   
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

        $contract = service_order::with('service', 'user', 'img_contract', 'checklists')->findOrFail($id);
        $checklistModels = $contract->checklists->where('attend_id', NULL);
        
        $futureAttends = Attend::attendsFuture()->where('order_id', $id)->with('users')->with('orders.service')->with('status')->with('orders.type')->get();
        $attendInExec = Attend::attendsForExecute()->attendsFuture()->select('id')->where('order_id', $id)->whereIn('status_id', [2, 3])->orderBy('status_id', 'desc')->first();

        if( ($attendInExec === null) OR ($attendInExec->checklists->isEmpty()) ){ //não existe atendimento no momento OU o atedimento em execução nao possui checklists?
            //nao existe atendimento no mommento
            //OU atendimento em execução n tem checklists
            $activities = $checklistModels->where('type_id', 1);
        } else {
            //existe atendimento -> pega o checklist do atendimento para exibir
            $activities = $attendInExec->checklists;
        }



        $checklists = $this->repositoryChecklist->checklistByOS($id)->general()->get();

        return view('admin.pages.OS.details', [
            'attends' => $futureAttends,
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
