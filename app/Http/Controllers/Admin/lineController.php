<?php

namespace App\Http\Controllers\Admin;

use App\Models\Line;
use App\Models\Unite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class lineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lines=Line::all();
        return response()->json($lines);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function getLine($unite_id){
        $line = Line::where('unite_id', $unite_id)->get();
        return response()->json($line);
    }
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->all() as $row) {
            Line::create([
                'unite_id'=> $row['unite_id'],
                'Line'=> $row['Line'],
                'remarks'=> $row['remarks'],
            ]);
        }
        return response()->json('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
