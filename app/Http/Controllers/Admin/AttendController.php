<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attend;
use App\Models\User;
use App\Models\Status;
use App\Models\StatusLog;
use App\Models\service_order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Carbon;


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

    public function __construct()
    {
        $this->repositoryOrder = new service_order(); 
        $this->repositoryUser = new User();
        $this->repositoryStatus = new Status();
        $this->repositoryStatusLog = new StatusLog();
        $this->repositoryAttend = new Attend();
    }

    public function index()
    {
        
        $attends = $this->repositoryAttend->attendsHistory()->get();
        return view('admin.pages.attends.index', [
            'attends' => $attends
        ]);

    }




    public function calendar()
    {


        $attends = $this->repositoryAttend->calendar();
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
                        case 5: //pós obra
                            $color = '#627b80';
                            break;
                        case 6: //placa solar
                            $color = '#fe9999';
                            break;
                        case 7: //pintura
                            $color = '#003e47';
                            break;    
                        case 8: //Roçada de terreno
                            $color = '#8fff82';
                            break;
                        default:
                            $color = '#0062cc';
                            break;
                    }
                    $start_date = date($a->data_inicial);
                    $end_date = date($a->data_final);

                    
                    $collection->push([
                    'title' => $a->orders->nome_cliente,
                    'start' => $start_date,
                    'end' => $end_date,
                    'color' => $color,
                    ]);
                }
                

                return response()->json($collection);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = $this->repositoryOrder::with('service')->get();
        $users = $this->repositoryUser::all();
        $status = $this->repositoryStatus::all();
        return view('admin.pages.attends.create', [
            'users' => $users,
            'contracts' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;
        $hora = $request->hora;

        $add_hours = '+'.$request->quantidade.' hours';
        $start = date('Y-m-d H:i:s', strtotime($data.$hora));
        $end = date('Y-m-d H:i:s', strtotime($start. $add_hours));

        
        $attend = Attend::create([
            'order_id' => $request->order_id,
            'data_inicial' => $start,
            'data_final' => $end,
            'status_id' => $request->status_id
        ]);

        $attend->users()->sync($request->user_id);

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
        return view('admin.pages.attends.show', [
            'attend' => $attendShow
        ]);
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
        return redirect('admin/');
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
            'title' => 'alteração de status',
            'type' => 1, //alteração de status
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


        Alert::success('Successo', 'Atualizado com sucesso');
        return redirect()->back();
    }

    
}
