<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    // TODO: boton pa dar atras en las pantallas
    public function index(){
        $authors = Author::all();

        return view('author.index', compact('authors'));
    }

    public function create(){
        return view('author.create');
    }

    public function show(Author $author){
        return view('author.show', compact('author'));
    }

    public function store(AuthorRequest $request){
        if($request->hasFile('image')){
            $url = Storage::put('images', $request->image);
        }else{
            $url = null;
        }

        $author = Author::saveAuthor($request, $url);

        $message = "Autor Creado";
        Session::flash('message', $message);

        return redirect()->route('author.show', $author);
    }

    public function edit(Author $author){
        return view('author.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author){
        if($request->hasFile('image')){
            if($author->image){
                Storage::delete($author->image);
            }
            $url = Storage::put('images', $request->image);
        }else{
            $url = $author->image;
        }

        $author->updateAuthor($request, $url);


        $message = "Autor Actualizado";
        Session::flash('message', $message);

        return redirect()->route('author.show', $author);
    }

    public function destroy(Author $author){
        if($author->image){
            Storage::delete($author->image);
        }
        $author->delete();
        return back();
    }
}
