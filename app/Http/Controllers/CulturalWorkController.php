<?php

namespace App\Http\Controllers;

use App\Http\Requests\CulturalWorkRequest;
use App\Models\Author;
use App\Models\CulturalWork;
use App\Models\Score;
use App\Notifications\CulturalWorkRestored;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
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
        $score = Score::avgScoreCulturalWork($culturalWork);
        $datesBefore = CulturalWork::where('id', $culturalWork->id)->where('updated_at', '<', $culturalWork->updated_at)->get();
        return view('culturalWork.show', compact(['culturalWork', 'score', 'datesBefore']));
    }

    public function edit(CulturalWork $culturalWork){
        $authors = Author::all();
        return view('culturalWork.edit', compact('authors', 'culturalWork'));
    }

    public function update(CulturalWorkRequest $request, CulturalWork $culturalWork){

        if($request->hasFile('image')){
            if($culturalWork->image){
                Storage::delete($culturalWork->image);
            }
            $url = Storage::put('images', $request->image);
        }else{
            $url = null;
        }
        $culturalWork->updateCulturalWork($request, $url);

        $message = "Obra Actualizada";
        Session::flash('message', $message);


        if($request->state_of_disrepair == "Restaurada"){
            Notification::send($culturalWork, new CulturalWorkRestored(['name' => $culturalWork->name]));
        }

        return redirect()->route('culturalWork.show', $culturalWork);
    }

    public function destroy(CulturalWork $culturalWork){
        if($culturalWork->image){
            Storage::delete($culturalWork->image);
        }

        $culturalWork->delete();

        return back();
    }
}
