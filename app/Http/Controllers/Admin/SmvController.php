<?php

namespace App\Http\Controllers\Admin;

use App\Models\SmvLibrary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smv =SmvLibrary::Latest()->get();
        return $smv;
    }

    public function getItem($style_no){
        $item = SmvLibrary::where('style_no', $style_no)->get();
            return response()->json($item);
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
        if($request->file('photo')){
            $name = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('/smv/'), $name);
         }
            $smv = new SmvLibrary();
            $smv ->style_no=$request->style_no;
            $smv ->po_no=$request->po_no;
            $smv ->item=$request->item;
            $smv ->item_description=$request->item_description;
            $smv ->costing_smv=$request->costing_smv;
            $smv->bulk_smv =$request->bulk_smv;
            $smv->smv_ref = str_replace(' ','_',strtolower($request->style_no.$request->item));
            $smv->photo = $name;
            $smv->save();
            return response()->json(['message' => 'success'],200);

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
