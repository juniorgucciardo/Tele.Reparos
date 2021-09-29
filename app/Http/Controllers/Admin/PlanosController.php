<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\service_order;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class PlanosController extends Controller
{
    // VAI FICAR PLANOS MESMO, MAS ESSE É PO CONTROLADOR DO VIEW
    //ESSE É O CONTROLADOR DO DASHBOARD, TELA INICIAL

    private $repositoryService;
    private $repositoryOS;
    private $repositoryStatus;
    private $repositoryUser;

    public function __construct(){
        $this->repositoryService = new Service();
        $this->repositoryOS = new service_order();
        $this->repositoryStatus = new Status();
        $this->repositoryUser = new User();
    }

    public function index(){
        $user = auth()->user();
        $username = $user->name; //username que vai ser usado durante a exibição do dashboard
        $username = explode(' ', $username);

        if(auth()->user()->hasPermissionTo('view_service_demands')){ // Verifica a permissão do usuário logado
            $service_demands = $this->repositoryOS->with('user')->with('status')->with('service')->get(); 

            // relacionamento avançado (NIVEL)
//            dd($this->repositoryOS->whereHas('user', function($query){
//                $query->where('user_id', '=', 1);
//            })->where('status_id', 3)->with('user')->get());          // Se for administrador, vai receber todas as consultas

            $users = $this->repositoryUser->all();
            $status = $this->repositoryStatus->all();





            return view('admin.pages.dashboard', [           // Retorna uma página especial da admiinstração do sistema, com todas as OS e outras informações
                'service_demands' => $service_demands,
                'username' => $username[0],
                'users' => $users,
                'status' => $status
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

