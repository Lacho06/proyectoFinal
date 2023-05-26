<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\CulturalWork;
use App\Models\RestorationPlan;
use Illuminate\Support\Facades\Session;
use App\Notifications\PlanCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RestorationPlanController extends Controller
{
    public function index(){
        $plans = RestorationPlan::all();
        return view('restorationPlan.index', compact('plans'));
    }
    // TODO: solo enviar a la vista las obras asociadas al plan
    public function create(){
        $culturalWorks = CulturalWork::all();
        $culturalWorksAssociated = [];
        return view('restorationPlan.create', compact('culturalWorks', 'culturalWorksAssociated'));
    }
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
    // TODO pendiente terminar este metodo
    public function associateCulturalWork(Request $request){
        $request->validate([
            'culturalWork_id' => 'required|exists:culturalWorks,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'restore_permission' => 'required',
        ]);

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if($start_date->isBefore($end_date)){
            $culturalWork = CulturalWork::find($request->culturalWork_id);
        }

        return redirect()->route('restorationPlan.create');
    }

    public function edit($id){
        $plan = RestorationPlan::find($id);
        $culturalWorks = CulturalWork::where('restoration_plan_id', $plan->id)->first();
        return view('restorationPlan.edit', compact('plan', 'culturalWorks'));
    }

    public function update(PlanRequest $request, RestorationPlan $plan){
        return $plan;
    }

    public function destroy(RestorationPlan $plan){
        $plan->delete();
        return back();
    }
}
