<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImgLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ImgLogController extends Controller
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
        if($request->hasFile('img_log')){
            try {
                $filenameWithExt = $request->file('img_log')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('img_log')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('img_log')->storeAs('public/log_img', $fileNameToStore);

                
                
                $img_log = ImgLog::create([
                    'img_log' => $fileNameToStore,
                    'statuslog_id' => $request->id
                ]);

                return redirect()->back();
                

            } catch (\Throwable $th) {
                Session::flash('problema no upload da imagem');
                return redirect()->back();
            }
        } else {
            Session::flash('nenhuma imagem encontrada');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImgLog  $imgLog
     * @return \Illuminate\Http\Response
     */
    public function show(ImgLog $imgLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImgLog  $imgLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ImgLog $imgLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImgLog  $imgLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImgLog $imgLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImgLog  $imgLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImgLog $imgLog, $id)
    {
        $img = $imgLog::findOrFail($id);
        $img->destroy($id);
        return redirect()->back();
    }
}
