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
        Session::forget('message');
        return view('author.index', compact('authors'));
    }

    public function create(){
        return view('author.create');
    }

    public function show(Author $author){
        return view('author.show', compact('author'));
    }

    public function store(AuthorRequest $request){
        $author = Author::saveAuthor($request);
        Session::forget('message');
        $message = "Autor Creado";
        Session::flash('message', $message);

        return redirect()->route('author.show', $author);
    }

    public function edit(Author $author){
        return view('author.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author){
        $author->updateAuthor($request);
        Session::forget('message');
        $message = "Autor Actualizado";
        Session::flash('message', $message);

        return redirect()->route('author.show', $author);
    }

    public function destroy(Author $author){
        $author->delete();
        return back();
    }
}
