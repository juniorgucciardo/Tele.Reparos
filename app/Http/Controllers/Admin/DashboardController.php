<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Status;
use App\Models\User;
use App\Models\Attend;
use Illuminate\Http\Request;
use App\Models\service_order;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class DashBoardController extends Controller
{

    private $repositoryService;
    private $repositoryOS;
    private $repositoryStatus;
    private $repositoryUser;
    private $repositoryAttend;

    public function __construct(){
        $this->repositoryService = new Service();
        $this->repositoryOS = new service_order();
        $this->repositoryStatus = new Status();
        $this->repositoryUser = new User();
        $this->repositoryAttend = new Attend();
    }

    public function index(){
        $user = auth()->user();
        $username = $user->name; //username que vai ser usado durante a exibição do dashboard
        $username = explode(' ', $username);
        $d12 = Carbon::now()->format('Y-m-d H:i:s');
        $d1 = date('Y-m-d H:i:s', strtotime($d12. ' - 2 days'));
        $d2 = date('Y-m-d H:i:s', strtotime($d1. ' + 7 days'));

        if(auth()->user()->hasPermissionTo('view_service_demands')){ // Verifica a permissão do usuário logado

            $ordersNow =  Attend::whereHas('orders', function($q){ //ordens em execução
                $q->where('situation_id', 3);
            })->whereBetween('data_inicial', [$d1, $d2])->with('users', 'orders.service', 'orders.type')->get();
            
            $ordersSolicited = Attend::whereHas('orders', function($q){ //ordens solicitadas
                $q->where('situation_id', 1);
            })->whereBetween('data_inicial', [$d1, $d2])->with('orders.service', 'orders.type')->get();
            
            $ordersCanceled = Attend::whereHas('orders', function($q){ //ordens canceladas
                $q->where('situation_id', 4);
            })->whereBetween('data_inicial', [$d1, $d2])->with('users', 'orders.service', 'orders.type')->get();

            // relacionamento avançado (NIVEL)
//            dd($this->repositoryOS->whereHas('user', function($query){
//                $query->where('user_id', '=', 1);
//            })->where('status_id', 3)->with('user')->get());          // Se for administrador, vai receber todas as consultas

            $users = $this->repositoryUser->all();
            $status = $this->repositoryStatus->all();

            return view('admin.pages.dashboard', [           // Retorna uma página especial da admiinstração do sistema, com todas as OS e outras informações
                'username' => $username[0],
                'users' => $users,
                'status' => $status,
                'attendsNow' => $ordersNow,
                'ordersSolicited' => $ordersSolicited
            ]);
        };

        //$service_demands = $this->repositoryOS->where('user_id', auth()->user()->id)->whereDate('data_ordem', Carbon::now()->format('y-m-d'))->with('user')->get();
        $service_demands = $user->service_order;
        
        return view('admin.pages.planos.index', [
            'username' => $username[0],
            'service_demands' => $service_demands
        ]);

    }
}

// Querys para buscar por data
// $OS = DB::table('service_orders')->whereDate('data_ordem', Carbon\Carbon::now()->format('y-m-d'))->get();
// $OS = DB::table('service_orders')->whereDate('data_ordem', '2021-09-10')->get();

