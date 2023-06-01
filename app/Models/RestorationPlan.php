<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RestorationPlan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['year', 'annual_budget', 'approval'];

    // relaciones

    public function culturalWorks(){
        return $this->belongsToMany(CulturalWork::class)->withPivot('start_date', 'end_date');
    }

    // metodos

    public static function savePlan($data){
        if($data->approval || $data->approval == true){
            $approval = 1;
        }else{
            $approval = 0;
        }

        $plan = RestorationPlan::create([
            'year' => $data->year,
            'annual_budget' => $data->annual_budget,
            'approval' => $approval,
        ]);

        return $plan;
    }

    public function updatePlan($data){
        if($data->year){
            $this->update([
                'year' => $data->year
            ]);
        }
        if($data->annual_budget){
            $this->update([
                'annual_budget' => $data->annual_budget
            ]);
        }
        if($data->approval){
            $this->update([
                'approval' => $data->approval
            ]);
        }
    }

    public static function generateReport(){
        $report = [];
        $plans = RestorationPlan::with('culturalWorks')->where('approval', '=', true)->orderBy('year', 'desc')->get();
        foreach($plans as $plan){
            $sumBudget = 0;
            foreach($plan->culturalWorks as $culturalWork){
                $sumBudget += $culturalWork->budget;
            }
            array_push($report, [
                'plan' => $plan,
                'sum_budget' => $sumBudget,
                'budget_remaining' => $plan->annual_budget - $sumBudget
            ]);
        }
        return $report;
    }
}
