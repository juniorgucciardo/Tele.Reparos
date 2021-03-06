<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attend;
use App\Models\User;
use App\Models\Status;
use App\Models\Checklist;
use App\Models\Situation;
use App\Models\Service;
use App\Models\StatusLog;
use App\Models\service_order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Carbon;
use PDF;


class AttendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repositoryOrder;
    private $repositoryUser;
    private $repositoryStatus;
    private $repositoryStatusLog;
    private $repositoryChecklist;
    private $pdf;

    public function __construct()
    {
        $this->repositoryOrder = new service_order(); 
        $this->repositoryUser = new User();
        $this->repositoryStatus = new Status();
        $this->repositoryStatusLog = new StatusLog();
        $this->repositoryAttend = new Attend();
        $this->repositoryChecklist = new Checklist();
        $this->pdf = new PDF();
    }

    public function index(Request $request)
    {
        $attends = $this->repositoryAttend->search($request)->paginate(100);
        return view('admin.pages.attends.index', ['attends' => $attends,
                                                  'services' => Service::all(),
                                                  'users' => User::all(),
                                                  'situations' => Situation::all()
        ]);

    }




    public function calendar(Request $request)
    {

        $query = Attend::query();

        if(Auth::user()->can('view_service_demands')){ //isAdmin

            if($request->servico){
                $attends = $this->repositoryAttend->attendsForExecute()->whereHas('orders', function($q) use($request){
                    $q->where('id_service', $request->service);
                })->get();
            }  
                $attends = $this->repositoryAttend->calendar()->get();
            

        } else {                                      //n ?? admin

            $attends = Attend::attendsById(Auth::user()->id)->with('users', 'orders', 'orders.service')->whereNotNull('order_id')->get();
        }
        
             
                $collection = collect();

                foreach($attends as $a){
                    switch ($a->orders->service->id) {
                        case 1: //jardinagem
                            $color = '#09b000';
                            break;
                        case 2: //eletrico - hidraulico
                            $color = '#b09900';
                            break;
                        case 3: //residencial
                            $color = '#ff0101';
                            break;
                        case 4: //empresarial
                            $color = '#fde100';
                            break;
                        case 5: //p??s obra
                            $color = '#627b80';
                            break;
                        case 6: //placa solar
                            $color = '#fe9999';
                            break;
                        case 7: //pintura
                            $color = '#003e47';
                            break;    
                        case 8: //Ro??ada de terreno
                            $color = '#8fff82';
                            break;
                        default:
                            $color = '#0062cc';
                            break;
                    }
                    $start_date = date($a->data_inicial);
                    $end_date = date($a->data_final);

                    $collection->push([
                    'id' => $a->orders->id,
                    'title' => $a->orders->nome_cliente,
                    'start' => $start_date,
                    'end' => $end_date,
                    'color' => $color
                    ]);
                }
                return response()->json($collection);
    }


    public function calendarView(){
        $attends = Attend::attendsById(1)->with('users', 'orders', 'orders.service')->whereNotNull('order_id')->get();
                $collection = collect();
                foreach($attends as $a){
                    $start_date = date($a->data_inicial);
                    $end_date = date($a->data_final);
                    $collection->push([
                    'id' => $a->orders->id,
                    'title' => $a->orders->nome_cliente,
                    'start' => $start_date,
                    'end' => $end_date,
                    ]);
                }

                return view('admin.pages.attends.calendar');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $actualOrder = $this->repositoryOrder::where('id', $id)->with('service')->first();
        $order = $this->repositoryOrder::with('service')->get();
        $users = $this->repositoryUser::all();
        $status = $this->repositoryStatus::all();
        return view('admin.pages.attends.create', [
            'contract' => $actualOrder,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $order = $this->repositoryOrder::findOrFail($id);
        $data = $request->data;
        $hora = $request->hora;

        $add_hours = '+'.$request->quantidade.' hours';
        $start = date('Y-m-d H:i:s', strtotime($data.$hora));
        $end = date('Y-m-d H:i:s', strtotime($start. $add_hours));

        
        $attend = Attend::create([
            'order_id' => $id,
            'data_inicial' => $start,
            'data_final' => $end,
            'status_id' => $request->status_id
        ]);

        $attend->users()->sync($request->user_id);

        return redirect()->route('OS.contract', $id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function show(Attend $attend, $id)
    {
        $attendShow = Attend::attendShow($id)->first();
        $activities = $this->repositoryChecklist->checklistByAttend($attendShow->id)->get();
           
        if(Auth::user()->can('viewAny', $attendShow)){
            return view('admin.pages.attends.show', [
            'attend' => $attendShow,
            'activities' => $activities,
        ]);

        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function edit(Attend $attend, $id)
    {
        $attend = Attend::with('orders.service')->with('status')->findOrFail($id);
        $order = $this->repositoryOrder::with('service')->get();
        $users = $this->repositoryUser::all();
        $status = $this->repositoryStatus::all();
        return view('admin.pages.attends.edit', [
            'attend' => $attend,
            'users' => $users,
            'contracts' => $order,
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attend $attend, $id)
    {
        $attend = Attend::findOrFail($id);

        $data = $request->data;
        $hora = $request->hora;

        $add_hours = '+'.$request->quantidade.' hours';
        $start = date('Y-m-d H:i:s', strtotime($data.$hora));
        $end = date('Y-m-d H:i:s', strtotime($start. $add_hours));

        $attend->update([
            'order_id' => $request->order_id,
            'data_inicial' => $start,
            'data_final' => $end,
            'status_id' => $request->status_id
        ]);

        $attend->users()->sync($request->user_id);
        Alert::success('Successo', 'Atualizado com sucesso');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attend $attend, $id)
    {
        $attend = Attend::findOrFail($id);
        $attend->destroy($id);

        Alert::success('Successo', 'Deletado com sucesso');
        return redirect()->back();
    }

    public function changeStatus(Request $request, Attend $attend, $id){
        $attend = Attend::findOrFail($id);

        $attend->update([
            'status_id' => $request->status_id
        ]);

        if($request->status_id == 3){
            $color = 'warning';
        } else if($request->status_id == 4){
            $color = 'success';
        } else if($request->status_id == 5){
            $color = 'danger';
        }else if($request->status_id == 6){
            $color = 'danger';
        } else {
            $color = 'info';
        }

        $status = Status::findOrFail($request->status_id);
        
        $string = 'status alterado para '.$status->status_title;

        $statusLog = $this->repositoryStatusLog->create([
            'content' => $string,
            'color' => $color,
            'title' => 'altera????o de status',
            'type' => 1, //altera????o de status
            'user_id' => Auth::user()->id,
            'attend_id' => $attend->id
        ]);



        $attend->users()->sync($request->user_id);

        Alert::success('Successo', 'Atualizado com sucesso');
        return redirect()->back();
    }

    public function scheduling(Request $request, $id){
        $data_inicial = date('Y-m-d H:i:s', strtotime($request->data_inicial.$request->hora_inicial));
        $final = date('Y-m-d H:i:s', strtotime($data_inicial. '+'.$request->duration.' hours'));
        $attend = Attend::findOrFail($id);
        
        $attend->update([
            'data_inicial' => $data_inicial,
            'data_final' => $final,
            'status_id' => $request->status_id ? $request->status_id : 2
        ]);

        $attend->users()->sync($request->user_id);

        //verificar se a attend ja tem checklist
        if($attend->checklists->isEmpty()){
            $checklists = $attend->orders->checklists->where('type_id', 1)->where('attend_id', NULL); //retorna checklist com id da ordem e id do attend nulo
            if(!$checklists->isEmpty()){ //is N??O empty
                foreach($checklists as $checklist){
                    $newChecklist = $checklist->replicate();
                    $newChecklist->attend_id = $attend->id;
                    $newChecklist->save();
                    //salvar os items no checklist copiado
                    foreach($checklist->items as $item){
                        $newItem = $item->replicate();
                        $newItem->push();
                        $newItem->checklist_id = $newChecklist->id;
                        $newItem->save();
                    }
            
                }
            }
        }
        
        Alert::success('Successo', 'Atualizado com sucesso');
        return redirect()->back();
    }

    public function getOS($id)
    {
        $attend = Attend::where('id', $id)->with('orders.img_contract')->first();
        if($attend->status_id >= 2){
            
            $activities = $this->repositoryChecklist->checklistByAttend($attend->id)->get();
        
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadView('admin.pages.exports.ordem-de-servico', [
                'attend' => $attend,
                'activities' => $activities,
            ]);
            
            $name = \Str::slug($attend->orders->nome_cliente.'-'.$attend->orders->data_ordem);

            return $pdf->stream($name.'.pdf');
        } else {
            return 'voce nao pode acessar uma OS de uma demanda que ainda nao esta agendada';
        }
    }

    
}
