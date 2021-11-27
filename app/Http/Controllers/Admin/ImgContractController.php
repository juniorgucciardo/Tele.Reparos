<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\img_contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class ImgContractController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->hasFile('img_contract')){
            // Get filename with the extension
            $filenameWithExt = $request->file('img_contract')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('img_contract')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('img_contract')->storeAs('public/contract_img', $fileNameToStore);


            $img_contract = img_contract::create([
                'description' => $request->description,
                'img_contract' => $fileNameToStore,
                'contract_id' => $request->id
            ]);
        } else {
            Alert::error('Erro', 'Nenhum arquivo cadastrado');
        }

        Alert::success('Sucesso', 'Cadastrado com sucesso');
        return redirect()->route('OS.contract', $request->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\img_contract  $img_contract
     * @return \Illuminate\Http\Response
     */
    public function show(img_contract $img_contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\img_contract  $img_contract
     * @return \Illuminate\Http\Response
     */
    public function edit(img_contract $img_contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\img_contract  $img_contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, img_contract $img_contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\img_contract  $img_contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(img_contract $img_contract, $id)
    {
        $img_contract = img_contract::findOrFail($id);
        $img_contract->destroy($id);
        Storage::delete($img_contract->img_contract);
        Alert::success('Sucesso', 'Apagado com sucesso');
        return redirect()->back();

    }
}
