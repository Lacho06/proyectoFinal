<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\CulturalWork;
use App\Models\RestorationPlan;
use Illuminate\Support\Facades\Session;
use App\Notifications\PlanCreated;
use Illuminate\Support\Facades\Notification;

class RestorationPlanController extends Controller
{
    public function index(){
        $plans = RestorationPlan::all();
        return view('restorationPlan.index', compact('plans'));
    }
    // TODO: solo enviar a la vista las obras asociadas al plan
    public function create(){
        $culturalWorks = CulturalWork::paginate(3);
        return view('restorationPlan.create', compact('culturalWorks'));
    }
    // TODO: agregar la logica de agregar obra a plan
    public function store(PlanRequest $request){
        $plan = RestorationPlan::savePlan($request);
        // TODO: arreglar la notificacion
        Notification::send($plan, new PlanCreated(['year' => $plan->year]));
        $message = "Plan de Restauración creado";
        Session::flash('message', $message);

        return redirect()->route('restorationPlan.show', $plan->id);
    }

    public function show($id){
        $plan = RestorationPlan::find($id);
        return view('restorationPlan.show', compact('plan'));
    }

    public function edit($id){
        $plan = RestorationPlan::find($id);
        return view('restorationPlan.edit', compact('plan'));
    }

    public function update(PlanRequest $request, RestorationPlan $plan){
        return $plan;
    }

    public function destroy(RestorationPlan $plan){
        $plan->delete();
        return back();
    }
}
