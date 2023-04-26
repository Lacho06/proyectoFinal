<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RestorationPlan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['year', 'annual_budget', 'approval'];


    public static function savePlan($data){
        if($data->approval){
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
}
