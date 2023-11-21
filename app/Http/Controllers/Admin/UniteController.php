<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UniteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $unites=Unite::all();
      return response()->json($unites);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->all() as $row) {
            Unite::create([
                'uniteName'=> $row['uniteName'],
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
