<?php

namespace App\Http\Controllers;

use App\Models\CulturalWork;

class HomeController extends Controller
{
    public function index(){
        $culturalWorks = CulturalWork::orderBy('updated_at', 'desc')->get();
        return view('index', compact('culturalWorks'));
    }

    public function show(CulturalWork $culturalWork){
        // $culturalWork = CulturalWork::find($id);
        return view('show', compact('culturalWork'));
    }
}
