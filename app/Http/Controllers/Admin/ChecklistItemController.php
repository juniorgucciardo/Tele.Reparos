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

        
                $item->update([ 
                    'is_concluted' => 1,
                    'concluted_at' => Carbon::now(),
                    'concluted_by' => Auth::user()->id
                ]);
               

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
