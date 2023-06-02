<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        Session::forget('message');
        return view('user.index', compact('users'));
    }

    public function create(){
        return view('user.create');
    }

    public function store(UserRequest $request){
        if($request->hasFile('image')){
            $url = Storage::put('images', $request->image);
        }else{
            $url = null;
        }

        $user = User::saveUser($request, $url);
        Session::forget('message');
        $message = "Usuario Creado";
        Session::flash('message', $message);

        return redirect()->route('user.show', $user);
    }

    public function show(User $user){
        return view('user.show', compact('user'));
    }

    public function edit(User $user){
        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user){
        if($request->hasFile('image')){
            if($user->image){
                Storage::delete($user->image);
            }
            $url = Storage::put('images', $request->image);
        }else{
            $url = $user->image;
        }

        $user->updateUser($request, $url);
        Session::forget('message');
        $message = "Usuario Actualizado";
        Session::flash('message', $message);

        return redirect()->route('user.show', $user);
    }

    public function destroy(User $user){
        if($user->image){
            Storage::delete($user->image);
        }
        $user->delete();

        return back();
    }

}
