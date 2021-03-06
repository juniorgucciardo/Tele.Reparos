<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\service_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = service_order::where('id', 21)->with('checklists')->first();
        $checklist = Checklist::with('items')->get();
        dd($order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('service_id')){
            $checklist = Checklist::create([
                'title' => $request->title,
                'service_id' => $request->service_id,
                'type_id' => $request->type_id,
                'user_id' => Auth::user()->id
            ]);

        } else if($request->has('order_id')){
            $checklist = Checklist::create([
                'title' => $request->title,
                'order_id' => $request->order_id,
                'type_id' => $request->type_id,
                'user_id' => Auth::user()->id
            ]);
        } else if($request->has('contract_type_id')){
            $checklist = Checklist::create([
                'title' => $request->title,
                'contract_type_id' => $request->contract_type_id,
                'type_id' => $request->type_id,
                'user_id' => Auth::user()->id
            ]);
        }

        

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
    }

    public function addOnOrder(Checklist $checklist, $id, $orderId){
        //adicionar checklist na OS
        $checklist = Checklist::findOrFail($id);
        $newChecklist = $checklist->replicate();
        $newChecklist->order_id = $orderId;
        $newChecklist->save();
        foreach($checklist->items as $item){
            $newItem = $item->replicate();
            $newItem->push();
            $newItem->checklist_id = $newChecklist->id;
            $newItem->save();
        }

        Alert::success('Successo', 'Atualizado com sucesso');
        return redirect()->back();
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist, $id)
    {
        $checklist = Checklist::findOrFail($id);
        $checklist->destroy($id);

        Alert::success('Successo', 'Deletado com sucesso');
        return redirect()->back();
    }
}
