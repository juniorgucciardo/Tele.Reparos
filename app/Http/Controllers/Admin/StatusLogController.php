<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusLog;
use App\Models\ImgLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class StatusLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.logs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //cadastrar apenas comentario

        try {
            $log = StatusLog::create([
                'title' => $request->title,
                'content' => $request->content,
                'color' => $request->color,
                'type' => 2,
                'user_id' => Auth::user()->id,
                'attend_id' => $request->attend_id,
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }


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

                
                try {
                    $img_log = ImgLog::create([
                        'img_log' => $fileNameToStore,
                        'statuslog_id' => $log->id
                    ]);
                } catch (\Throwable $th) {
                    dd($th);
                }

            } catch (\Throwable $th) {
                Session::flash('problema no upload da imagem');
                return redirect()->back();
            }
        } else {
            Session::flash('nenhuma imagem encontrada');
            return redirect()->back();
        }


        Session::flash('cadastrado com sucesso');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusLog  $statusLog
     * @return \Illuminate\Http\Response
     */
    public function show(StatusLog $statusLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusLog  $statusLog
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusLog $statusLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusLog  $statusLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusLog $statusLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusLog  $statusLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusLog $statusLog, $id)
    {
       try {
            $log = StatusLog::findOrFail($id);
            $log->destroy($id);

            return redirect()->back();
       } catch (\Throwable $th) {
           //throw $th;
       }

    }

    public function addImage(StatusLog $statusLog, $id){
        try {
            $log = $statusLog::findOrFail($id);
            try {
                $img_log = ImgLog::create([
                    'img_log' => $fileNameToStore,
                    'statuslog_id' => $log->id
                ]);
            } catch (\Throwable $th) {
                dd($th);
            }

        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
