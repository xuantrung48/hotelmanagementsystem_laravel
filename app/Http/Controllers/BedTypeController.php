<?php

namespace App\Http\Controllers;

use App\Models\BedType;
use App\Repositories\Interfaces\BedTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BedTypeController extends Controller
{
    /**
     * Constructor to assign interface to variable
     * @param interface
     */
    public function __construct(BedTypeInterface $bedType)
    {
        $this->bedType = $bedType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => 'OK', 'data' => $this->bedType->index()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:bed_types,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 'NG',
                'message'   =>  $validator->errors()->all()
            ], 422);
        }

        $saveResult = $this->bedType->store($request);

        if ($saveResult['status'] == 'OK') {
            return response()->json([
                'status'    => 'OK',
                'message'   => 'Bed Type created successfully'
            ], 201);
        } else {
            return response()->json([
                'status'    => 'NG',
                'message'   => 'Bed Type not created'
            ], 500);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
