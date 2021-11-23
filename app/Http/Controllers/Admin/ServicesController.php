<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Checklist;
use App\Models\ChecklistType;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository;
    private $repositoryChecklist;
    private $repositoryChecklistType;

    public function __construct(Service $service){
        $this->repository = $service;
        $this->repositoryChecklist = new Checklist;
        $this->repositoryChecklistType = new ChecklistType;

    }

    public function index()
    {
        $services = $this->repository->with(["checklists" => function($q){
            $q->where('order_id', NULL);   
        }])->get();
        return view('admin.pages.services.index', [
            'services' => $services,
            'checklistTypes' => $this->repositoryChecklistType->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Service::create([
            'service_title' => $request->service_title,
            'service_description' => $request->service_description
        ]);

        return redirect('admin/servicos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, $id)
    {
        $service = Service::findOrFail($id);
        return view('admin.pages.services.edit', ['servico' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service, $id)
    {
        $service = Service::findOrFail($id);
        $service->update([
            'service_title' => $request->service_title,
            'service_description' => $request->service_description
        ]);

        return redirect('admin/servicos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, $id)
    {
        $service = Service::findOrFail($id);
        $service->destroy($id);
        return redirect('admin/servicos');
    }
}
