<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories =Category::Latest()->get();
      return $categories;
    }

    public function store(Request $request)
    {

            // Category::create([
            //     'name' => request('name'),
            //     'code' => request('code'),
            //     'description' => request('description'),
            // ]);

            $category=new Category();
            $category->name =$request->name;
            $category->code =$request->code;
            $category->description =$request->description;
            $category->save();
            return response()->json(['message' => 'success']);

    }

}
