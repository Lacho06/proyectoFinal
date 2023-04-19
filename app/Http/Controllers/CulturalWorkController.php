<?php

namespace App\Http\Controllers;

use App\Http\Requests\CulturalWorkRequest;
use App\Models\Author;
use App\Models\CulturalWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CulturalWorkController extends Controller
{
    public function index(){
        $culturalWorks = CulturalWork::all();

        return view('culturalWork.index', compact('culturalWorks'));
    }

    public function create(){
        $authors = Author::all();
        return view('culturalWork.create', compact('authors'));
    }
    // TODO: Falta el PRESUPUESTO en la pantalla create
    public function store(CulturalWorkRequest $request){
        if($request->hasFile('image')){
            $url = Storage::put('images', $request->image);
        }else{
            $url = null;
        }
        $culturalWork = CulturalWork::saveCulturalWork($request, $url);

        $message = "Obra Creada";
        Session::flash('message', $message);

        return redirect()->route('culturalWork.show', $culturalWork);
    }

    public function show(CulturalWork $culturalWork){
        return view('culturalWork.show', compact('culturalWork'));
    }

    public function edit(CulturalWork $culturalWork){

    }

    public function update(Request $request, CulturalWork $culturalWork){

    }

    public function destroy(CulturalWork $culturalWork){

    }
}
