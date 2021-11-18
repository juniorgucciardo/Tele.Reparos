<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChecklistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $item = ChecklistItem::create([
            'title' => $request->title,
            'checklist_id' => $request->checklist_id,
            'type_id' => $request->type_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistItem $checklistItem)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistItem $checklistItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChecklistItem $checklistItem, $id)
    {
        $item = ChecklistItem::findOrFail($id);
        $item->update([
            'title' => $request->title
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChecklistItem  $checklistItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistItem $checklistItem, $id)
    {
        $item = ChecklistItem::findOrFail($id);
        $item->destroy($id);
        return redirect()->back();
    }

    public function check(Request $request)
    {
        $item = ChecklistItem::find($request->id);
        $checklist = $item->checklist;
        $checklist->load('items');
        $checklistItens = $checklist->items->pluck('is_concluted');

        if($checklist->type_id == 1){
            if(($checklistItens->contains(1))){ 
                //tem pelo menos um item marcado
                $item->update([ 
                    'is_concluted' => 1,
                    'concluted_at' => Carbon::now(),
                    'concluted_by' => Auth::user()->id
                ]);
                return json_encode('ja possui itens marcados'); //debug
            } else {          
                //nao tem itens marcados
                //caso nao exista nenhum atendimento cadastrado, 
                //criar novo checklists passando os itens deste
                $item->update([ 
                    'is_concluted' => 1,
                    'concluted_at' => Carbon::now(),
                    'concluted_by' => Auth::user()->id
                ]);
                if(isset($checklist->attend_id)){ 
                    //caso exista attend
                    return json_encode('checklist ja possui atendimento cadastrado');
                } else {
                    $item->update([ 
                        'is_concluted' => 1,
                        'concluted_at' => Carbon::now(),
                        'concluted_by' => Auth::user()->id
                    ]);
                    //caso nao exista attend
                    $newChecklist = $checklist->replicate();
                    $newChecklist->save();
                    //salvar os items no checklist copiado
                    foreach($checklist->items as $item){
                        $newItem = $item->replicate();
                        $newItem->push();
                        $newItem->checklist_id = $newChecklist->id;
                        $newItem->save();
                        var_dump($newItem->checklist_id);
                    }
                    return json_encode([
                        'duplicado' => 'true',
                        'item' => $newChecklist
                    ]);
                }
                $item->update([
                    'is_concluted' => 1,
                    'concluted_at' => Carbon::now(),
                    'concluted_by' => Auth::user()->id
                ]);
                return json_encode('primeiro item marcado');
            }
        } else {
            $item->update([ 
                'is_concluted' => 1,
                'concluted_at' => Carbon::now(),
                'concluted_by' => Auth::user()->id
            ]);
        }

    }

    public function unCheck(Request $request)
    {
        $item = ChecklistItem::find($request->id);
        $item->update([
            'is_concluted' => 0,
            'concluted_at' => null,
            'concluted_by' => null,
        ]);
        return json_encode($item);
    }
}
