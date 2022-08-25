<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cssd.set');
    }

    public function getSets()
    {
        $sets = Set::orderBy('id', 'asc')->get();
        return response()->json($sets);
        
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
        //
        $set = new set;
        $set->name = $request->name;
        $saved = $set->save();
        if (!$saved) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Cannot insert Data'
                ]
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully',
                'set' => $set,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        //
        $set->name = $request->name;
        $set->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully',
                'set' => $set,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        //
        $set->delete();
    }
}
