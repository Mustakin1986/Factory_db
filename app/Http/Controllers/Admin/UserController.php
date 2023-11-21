<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
     $users =User::Latest()->get();
     return $users;

    }
    public function store(){
      request()->validate([
       'name'=>'required',
       'tel'=>'required',
       'email'=>'required',
       'password'=>'required',

      ]);

     User::create([
        'name'=>request('name'),
        'tel'=>request('tel'),
        'email'=>request('email'),
        'password'=>bcrypt(request('password')),
     ]);
     return response()->json(['messages' => 'success']);
    }

    public function edit(User $user){
      return $user;
    }

    public function update(User $user){
        request()->validate([
            'name'=>'required',
            'tel'=>'required',
            'email'=>'required',
            'password'=>'required',

           ]);

           $user->update($validated);
           return response()->json(['success'=>true]);
        }

        public function ChangeRole(User $user){
            $user->update([
                'role' => request('role'),
            ]);
        }
    public function destroy(User $user){
        $user->delete();
        return response()->json(['success'=>true],200);
    }

}
