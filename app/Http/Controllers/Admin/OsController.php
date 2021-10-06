<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\service_order;
use App\Models\Service;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attend;
use App\Models\Type;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repositoryService;
    private $repositoryUser;
    private $repositoryType;
    private $repositoryStatus;
    private $repositoryOS;

    public function __construct(Service $service, service_order $service_order){
        $this->repositoryService = new Service();
        $this->repositoryOS = new service_order();
        $this->repositoryUser = new User();
        $this->repositoryStatus = new Status();
        $this->repositoryType = new Type();
    }


    public function index()
    {
        $user = auth()->user();
        if(auth()->user()->hasPermissionTo('view_service_demands')){
            $service_orders = $this->repositoryOS->with('user')->with('attends.status')->withCount('attends')->with('type')->get();
            return view('admin.pages.OS.index', [
                'service_orders' => $service_orders
            ]);
        }

        //$service_orders = $this->repositoryOS->where('user_id', auth()->user()->id)->with('user')->get();
        $service_orders = $user->service_order;
        return view('admin.pages.OS.index', compact('service_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('view_service_demands')){
            $users = $this->repositoryUser->all();
            $services = $this->repositoryService->all();
            $status = $this->repositoryStatus->all();
            $types = $this->repositoryType->all();
            return view('admin.pages.OS.create', [
                'users' => $users,
                'services' => $services,
                'types' => $types,
                'status' => $status
            ]);
        } else {
            return redirect('admin/OS');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(auth()->user()->can('view_service_demands')){
            if($request->type){
                $type = $request->type;
            } else {
                $type = 1;
            }

            if($request->status){
                $status = $request->status;
            } else {
                $status = 1;
            }


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
                'type_id' => $type,
                'recurrence' => $request->recurrence,
                'amount' => $request->amount
            ]);

            

            $data = $request->data_ordem;
            $hora = $request->hora_ordem;

            $add_days = '+'.$request->recurrence.' days';
            $hora_start = date('Y-m-d H:i:s', strtotime($data.$hora));
            $hora_end = date('Y-m-d H:i:s', strtotime($hora_start. '+4 hours'));
            
            for ($i=0; $i < $request->amount; $i++){
                $a = Attend::create([
                    'order_id' => $service_order->id,
                    'data_inicial' => $hora_start,
                    'data_final' => $hora_end
                ]);
                
                $hora_start = date('Y-m-d H:i:s', strtotime($hora_start. $add_days));
                $hora_end = date('Y-m-d H:i:s', strtotime($hora_start. '+4 hours'));

                $a->users()->attach($request->user_id);
            }


            return redirect('admin/OS');
        } else {
            return redirect('admin/OS');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\service_order  $os
     * @return \Illuminate\Http\Response
     */
    public function show(service_order $service_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\service_order  $os
     * @return \Illuminate\Http\Response
     */
    public function edit(service_order $service_order, $id)
    {
        if(auth()->user()->can('view_service_demands')){
            $users = $this->repositoryUser->all();
            $services = $this->repositoryService->all();
            $status = $this->repositoryStatus->all();
            $types = $this->repositoryType->all();
            $attends = $this->repositoryType->all();
            $service_order = service_order::find($id);
            return view('admin.pages.OS.edit', [
                'services' => $services,
                'service_order' => $service_order,
                'users' => $users,
                'types' => $types,
                'status' => $status
            ]);
        } else {
            return redirect('admin/OS');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\service_order  $os
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, service_order $service_order, $id)
    {

        if(auth()->user()->can('view_service_demands')){

            $service_order = service_order::findOrFail($id);


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
                'status_id' => $request->status
            ]);

            

            $service_order->user()->sync($request->user_id);


            return redirect('admin/OS');
        } else {
            return redirect('admin/OS');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\service_order  $os
     * @return \Illuminate\Http\Response
     */
    public function destroy(service_order $service_order, $id)
    {
        if(auth()->user()->can('view_service_demands')){
            $service_order = service_order::findOrFail($id);
            $service_order->user()->detach();
            $service_order->destroy($id);
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
            'data_ordem' => $request->data_ordem,
            'hora_ordem' => $request->hora_ordem,
            'status_id' => $request->status_id
        ]);
            return redirect('admin');
        } else {
            return redirect('admin');
        }

    }

    public function export() 
    {
        if(auth()->user()->can('view_service_demands')){
            return Excel::download(new GeneralReport, 'RelatorioGeral.xlsx');
            
        }

    }

    public function attedsByContract($id){
        $contract = service_order::with('service')->with('user')->findOrFail($id);
        $attends = Attend::where('order_id', $id)->with('users')->with('orders.service')->with('status')->with('orders.type')->get();
        return view('admin.pages.OS.details', [
            'attends' => $attends,
            'contract' => $contract
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


        public function getData(){
            if(auth()->user()->can('view_service_demands')){
                
                $service_orders = $this->repositoryOS->all();
                $collection = collect();

                foreach($service_orders as $order){
                    switch ($order->type_id) {
                        case 1:
                            $color = '#407294';
                            break;
                        case 2:
                            $color = 'red';
                            break;
                        case 3:
                            $color = 'yellow';
                            break;
                        case 4:
                            $color = '#ffa500';
                            break;
                        default:
                            $color = '#7fe5f0';
                            break;
                    }
                    $start_date = $order->data_ordem;   
                    $collection->push([
                    'title' => $order->nome_cliente,
                    'color' => $color,
                    'start' => $start_date
                
                    ]);
                }

                return response()->json($collection);
            }
        }
}
