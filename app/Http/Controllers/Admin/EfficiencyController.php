<?php

namespace App\Http\Controllers\Admin;

use App\Models\Efficiency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EfficiencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $efficiency=Efficiency::all();
        return response()->json($efficiency);
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
            Efficiency::create([
                'unite_id'     => isset($row['unite_id']) ? $row['unite_id'] : null,
                'Line_No'      => isset($row['Line_No']) ? $row['Line_No'] : null,
                'Ttl_OP'       => isset($row['Ttl_OP']) ? $row['Ttl_OP'] : null,
                'Ttl_HP'       => isset($row['Ttl_HP']) ? $row['Ttl_HP'] : null,
                'Working_Hrs'  => isset($row['Working_Hrs']) ? $row['Working_Hrs'] : null,
                'style_no'     => isset($row['style_no']) ? $row['style_no'] : null,
                'Po_No'        => isset($row['Po_No']) ? $row['Po_No'] : null,
                'Item'         => isset($row['Item']) ? $row['Item'] : null,
                'smv'         => isset($row['smv']) ? $row['smv'] : null,
                'Today_Target' => isset($row['Today_Target']) ? $row['Today_Target'] : null,
                'Today_Output' => isset($row['Today_Output']) ? $row['Today_Output'] : null,
                'remarks'      => isset($row['remarks']) ? $row['remarks'] : null,
                'efficiency_ref' => isset($row['style_no']) && isset($row['Item']) ? $row['style_no']. $row['Item'] : null,


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
