<?php

namespace App\Http\Controllers;

use App\Http\Requests\CulturalWorkRequest;
use App\Models\Author;
use App\Models\CulturalWork;
use App\Models\Score;
use App\Models\User;
use App\Notifications\CulturalWorkRestored;
use Barryvdh\DomPDF\Facade\Pdf;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CulturalWorkController extends Controller
{
    public function index(){
        $culturalWorks = CulturalWork::all();
        Session::forget('message');
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
        Session::forget('message');
        $message = "Obra creada";
        Session::flash('message', $message);

        return redirect()->route('culturalWork.show', $culturalWork);
    }

    public function generateReport(){
        $report = CulturalWork::generateReport();
        return view('culturalWork.report', compact('report'));
    }

    public function downloadReport(){
        $report = CulturalWork::generateReport();
        $pdf = Pdf::loadView('culturalWork.downloadReport', compact('report'));
        return $pdf->download('culturalWork-report.pdf');
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
        // valido si la obra tiene imagen
        if($culturalWork->image){
            // valido si en la peticion hay imagen
            if($request->hasFile('image')){
                if($culturalWork->image){
                    Storage::delete($culturalWork->image);
                }
                $url = Storage::put('images', $request->image);
            }else{
                $url = $culturalWork->image;
            }
        }else{
            // si la obra no tiene imagen y en la peticion hay imagen
            if($request->hasFile('image')){
                $url = Storage::put('images', $request->image);
            }else{
                $url = null;
            }
        }
        $culturalWork->updateCulturalWork($request, $url);
        Session::forget('message');
        $message = "Obra actualizada";
        Session::flash('message', $message);

        if($request->state_of_disrepair == "Restaurada" && $culturalWork->state_of_disrepair !== $request->state_of_disrepair){
            $users = User::where('role', 'vicerector')->get();
            Notification::send($users, new CulturalWorkRestored(['name' => $culturalWork->name]));
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
