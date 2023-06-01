<?php

namespace App\Http\Controllers;

use App\Models\CulturalWork;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $culturalWorks = CulturalWork::orderBy('updated_at', 'desc')->get();
        return view('index', compact('culturalWorks'));
    }

    public function search(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        $culturalWorks = CulturalWork::where('title', 'LIKE', '%'.$request->search.'%')->orderBy('updated_at', 'desc')->get();
        return view('index', compact('culturalWorks'));
    }

    public function show(CulturalWork $culturalWork){
        return view('show', compact('culturalWork'));
    }
}
