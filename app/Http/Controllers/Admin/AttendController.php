<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attend;
use App\Models\User;
use App\Models\service_order;
use Illuminate\Http\Request;

class AttendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repositoryOrder;
    private $repositoryUser;

    public function __construct()
    {
        $this->repositoryOrder = new service_order(); 
        $this->repositoryUser = new User();
    }

    public function index()
    {

        $attends = Attend::whereBetween('data_inicial', ['2021-09-30 08:00:00', '2021-10-15 18:00:00'])->with('users')->with('orders.service')->with('orders.status')->with('orders.type')->get();
        return view('admin.pages.attends.index', [
            'attends' => $attends
        ]);

    }




    public function calendar()
    {


        $attends = Attend::with('users')->with('orders.service')->with('orders.status')->get();
                $collection = collect();
        

                foreach($attends as $a){
                    switch ($a->orders->service->id) {
                        case 1:
                            $color = '#0062cc';
                            break;
                        case 2:
                            $color = '#dc3545';
                            break;
                        case 3:
                            $color = '#28a745';
                            break;
                        case 4:
                            $color = '#17a2b8';
                            break;
                        default:
                            $color = '#ffc107';
                            break;
                    }
                    $start_date = date($a->data_inicial);
                    $end_date = date($a->data_final);

                    
                    $collection->push([
                    'title' => $a->orders->nome_cliente,
                    'color' => $color,
                    'start' => $start_date,
                    'end' => $end_date
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
            'data_final' => $end
        ]);

        $attend->users()->attach($request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function show(Attend $attend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function edit(Attend $attend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attend $attend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attend $attend)
    {
        //
    }
}
