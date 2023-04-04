<?php

namespace App\Http\Controllers;

use App\Models\RestorationPlan;
use Illuminate\Http\Request;

class RestorationPlanController extends Controller
{
    // TODO: terminar el CRUD
    public function index(){
        $plans = RestorationPlan::all();

        return view('restorationPlan.index', compact('plans'));
    }
}
