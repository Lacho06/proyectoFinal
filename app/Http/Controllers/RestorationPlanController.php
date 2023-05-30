<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\CulturalWork;
use App\Models\RestorationPlan;
use Illuminate\Support\Facades\Session;
use App\Notifications\PlanCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class RestorationPlanController extends Controller
{
    public function index(){
        $plans = RestorationPlan::all();
        return view('restorationPlan.index', compact('plans'));
    }
    // TODO: solo enviar a la vista las obras asociadas al plan
    public function create(){
        return view('restorationPlan.create');
    }
    public function store(PlanRequest $request){
        $plan = RestorationPlan::savePlan($request);
        // TODO: arreglar la notificacion
        Notification::send($plan, new PlanCreated(['year' => $plan->year]));
        $message = "Plan de restauración creado";
        Session::flash('message', $message);
        $culturalWorks = CulturalWork::whereNotIn('id', function ($query) use ($plan) {
            $query->select('cultural_work_id')->from('cultural_work_restoration_plan')->where('cultural_work_restoration_plan.restoration_plan_id', $plan->id);
        })->get();
        return view('restorationPlan.addCulturalWork', compact('plan', 'culturalWorks'));
    }

    public function show($id){
        $plan = RestorationPlan::find($id);
        return view('restorationPlan.show', compact('plan'));
    }

    public function edit($id){
        $plan = RestorationPlan::find($id);
        $culturalWorks = CulturalWork::where('restoration_plan_id', $plan->id)->first();
        return view('restorationPlan.edit', compact('plan', 'culturalWorks'));
    }

    // TODO pendiente terminar este metodo
    public function associateCulturalWork(Request $request){
        $request->validate([
            'restorationPlan_id' => 'required|exists:restoration_plans,id',
            'culturalWork_id' => 'required|exists:cultural_works,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $culturalWork = CulturalWork::find($request->culturalWork_id);
        $plan = RestorationPlan::find($request->restorationPlan_id);

        if($start_date->isBefore($end_date)){
            $plan->culturalWorks()->attach($culturalWork->id, [
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
            $message = "Obra agregada al plan correctamente";
        }else{
            // mensaje de error
            $message = "Fecha de fin incorrecta";
        }
        Session::flash('message', $message);
        $culturalWorks = CulturalWork::whereNotIn('id', function ($query) use ($plan) {
            $query->select('cultural_work_id')->from('cultural_work_restoration_plan')->where('cultural_work_restoration_plan.restoration_plan_id', $plan->id);
        })->get();
        return view('restorationPlan.addCulturalWork', compact('plan', 'culturalWorks'));
    }

    public function unassociateCulturalWork(Request $request){
        $request->validate([
            'culturalWork_id' => 'required|exists:cultural_works,id',
            'restorationPlan_id' => 'required|exists:restoration_plans,id'
        ]);
        $culturalWork = CulturalWork::find($request->culturalWork_id);
        $plan = RestorationPlan::find($request->restorationPlan_id);

        $plan->culturalWorks()->detach($culturalWork->id);
        $culturalWorks = CulturalWork::whereNotIn('id', function ($query) use ($plan) {
            $query->select('cultural_work_id')->from('cultural_work_restoration_plan')->where('cultural_work_restoration_plan.restoration_plan_id', $plan->id);
        })->get();
        return view('restorationPlan.addCulturalWork', compact('plan', 'culturalWorks'));
    }

    public function update(PlanRequest $request, RestorationPlan $plan){
        return $plan;
    }

    public function destroy(RestorationPlan $plan){
        $plan->delete();
        return back();
    }
}
