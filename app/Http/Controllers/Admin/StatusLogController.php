<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusLog;
use Illuminate\Http\Request;

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
        dd($request);
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
    public function destroy(StatusLog $statusLog)
    {
        //
    }
}
