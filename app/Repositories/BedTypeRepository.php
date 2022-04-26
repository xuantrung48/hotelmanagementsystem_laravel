<?php

namespace App\Repositories;

use App\DBTransaction\Store;
use App\Models\BedType;
use App\Repositories\Interfaces\BedTypeInterface;

/**
 * Class BedTypeRepository
 */
class BedTypeRepository implements BedTypeInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BedType::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $process = new Store(BedType::class, $request->all());
        return $process->executeProcess();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BedType::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $bedType = BedType::find($id);
        $bedType->update($request);
        return $bedType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bedType = BedType::find($id);
        $bedType->delete();
        return $bedType;
    }
}
