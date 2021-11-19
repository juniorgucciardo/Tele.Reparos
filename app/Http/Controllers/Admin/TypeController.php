<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Checklist;
use App\Models\ChecklistType;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $typeRepository;
    private $checklistRepository;
    private $checklistTypeRepository;

    public function __construct(){
        $this->typeRepository = new Type();
        $this->checklistRepository = new Checklist();
        $this->checklistTypeRepository = new ChecklistType();
    }

    public function index()
    {
        if(auth()->user()->hasPermissionTo('view_service_demands')){
            
            $types = $this->typeRepository->with('checklists')->get();
            return view('admin.pages.Types.index', [
                'types' => $types,
                'checklistTypes' => $this->checklistTypeRepository->all()
            ]);

        } else {

            return view('admin.pages.Types.index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.Types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('view_service_demands')){
            $type = $this->typeRepository::create([
                'type_title' => $request->type_title
            ]);
            return redirect('admin/tipos');
        } else {
            return redirect('admin/tipos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->can('view_service_demands')){
            $type = $this->typeRepository->findOrFail($id);
            return view('admin.pages.Types.edit', [
                'type' => $type
            ]);
        }
        return view('admin.pages.Types.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->can('view_service_demands')){
            $type = $this->typeRepository->findOrFail($id);
            $type->update([
                'type_title' => $request->type_title
            ]);
            return redirect('admin/tipos');
        } else {
            return redirect('admin/tipos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->can('view_service_demands')){
            $type = $this->typeRepository->findOrFail($id);
            $type->destroy($id);
            return redirect('admin/tipos');
        } else {
            return redirect('admin/tipos');
        }
    }
}
