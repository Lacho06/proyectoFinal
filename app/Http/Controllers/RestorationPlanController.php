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
use Barryvdh\DomPDF\Facade\Pdf;

class RestorationPlanController extends Controller
{
    public function index(){
        $plans = RestorationPlan::all();
        return view('restorationPlan.index', compact('plans'));
    }

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

    public function generatePlan($id){
        $plan = RestorationPlan::find($id);
        $totalBudget = $plan->annual_budget;
        $count = 0;
        do{
            $cwAdded = CulturalWork::select('id', 'budget')
            ->where('budget', '<', $totalBudget)
            ->where('restore_permission', '=', 'universidad')
            ->whereIn('state_of_disrepair', ['deteriorado', 'regular'])
            ->whereNotIn('id', function ($query) use ($plan) {
                $query->select('cultural_work_id')->from('cultural_work_restoration_plan')->where('cultural_work_restoration_plan.restoration_plan_id', $plan->id);
            })
            ->orderBy('state_of_disrepair', 'asc')
            ->orderBy('budget', 'asc')->first();
            if($cwAdded){
                $plan->culturalWorks()->attach($cwAdded->id, [
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::tomorrow()
                ]);
            }
            $count++;
        }while($totalBudget > $cwAdded->budget && $count < 3);
        $culturalWorks = CulturalWork::whereNotIn('id', function ($query) use ($plan) {
            $query->select('cultural_work_id')->from('cultural_work_restoration_plan')->where('cultural_work_restoration_plan.restoration_plan_id', $plan->id);
        })->get();
        return view('restorationPlan.addCulturalWork', compact('plan', 'culturalWorks'));
    }

    public function generateReport(){
        $report = RestorationPlan::generateReport();
        return view('restorationPlan.report', compact('report'));
    }

    public function downloadReport(){
        $report = RestorationPlan::generateReport();
        $pdf = Pdf::loadView('restorationPlan.downloadReport', compact('report'));
        return $pdf->download('plan-report.pdf');
    }

    public function show($id){
        $plan = RestorationPlan::find($id);
        return view('restorationPlan.show', compact('plan'));
    }

    public function edit($id){
        $plan = RestorationPlan::find($id);
        $culturalWorks = CulturalWork::whereNotIn('id', function ($query) use ($plan) {
            $query->select('cultural_work_id')->from('cultural_work_restoration_plan')->where('cultural_work_restoration_plan.restoration_plan_id', $plan->id);
        })->get();
        return view('restorationPlan.edit', compact('plan', 'culturalWorks'));
    }

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

    public function update(PlanRequest $request, $id){
        $plan = RestorationPlan::find($id);
        if($request->year != $plan->year){
            $message = "Error, ya existe un plan con ese año";
            Session::flash('message', $message);
            return redirect()->route('restorationPlan.index');
        }
        $plan->updatePlan($request);
        $message = "Plan de restauración actualizado";
        Session::flash('message', $message);
        return redirect()->route('restorationPlan.show', $plan->id);
    }

    public function destroy(RestorationPlan $plan){
        $plan->delete();
        return back();
    }
}
