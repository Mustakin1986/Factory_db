<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index(){
        $brands =Brand::Latest()->get();
       return $brands;

    }
    public function store(Request $request)
    {

        if($request->file('photo')){
            $name = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('/brand/'), $name);
         }

            $brand = new Brand();
            $brand ->name=$request->name;
            $brand->description =$request->description;
            $brand->photo = $name;
            $brand->save();
            return response()->json(['message' => 'success'],200);

    }
}
