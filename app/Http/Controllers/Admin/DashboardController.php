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
use Illuminate\Support\Facades\Auth;



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
        if(auth()->user()->hasPermissionTo('view_service_demands')){
                        
            return view('admin.pages.dashboard', [           // Retorna uma página especial da admiinstração do sistema, com todas as OS e outras informações
                'username' => explode(' ', auth()->user()->name)[0],
                'users' => $this->repositoryUser->all(),
                'status' => $this->repositoryStatus->all(),
                'attendsNow' => $this->repositoryAttend->attendsByAtualDay()->get(),
                'ordersSolicited' => service_order::ordersDemandads()->get(),
                'attendsNext' => $this->repositoryAttend->nextAttends()->get(),
                'OrdersDemandads' => service_order::ordersDemandads()->count(),
                'atendimentosConcluidos' => $this->repositoryAttend->doneAttends()->count(),
                'atendimentosAtrasados' => $this->repositoryAttend->lateAttends()->count(),
                'andamentoAgora' => $this->repositoryAttend->attendsByAtualDay()->count()
            ]);
        };
        
        return view('admin.pages.planos.index', [
            'username' => explode(' ', auth()->user()->name)[0],
            'service_demands' => Attend::attendsByUser(auth()->user()->id)->get(),
            'status' => this->repositoryStatus->all()
        ]);

    }
}
