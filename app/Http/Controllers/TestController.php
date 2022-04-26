<?php

namespace App\Http\Controllers;

use App\DBTransaction\Destroy;
use App\DBTransaction\Store;
use App\DBTransaction\Update;
use App\Models\Facility;
use Illuminate\Http\Request;

class TestController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $process = new Store(Facility::class, $request->all());
        $saveResult = $process->executeProcess();
        dd($saveResult);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $process = new Update(Facility::class, $id, $request->all());
        $saveResult = $process->executeProcess();
        dd($saveResult);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = new Destroy(Facility::class, $id);
        $saveResult = $process->executeProcess();
        dd($saveResult);
    }
}
