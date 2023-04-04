<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CulturalWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year_of_stablishment',
        'restore_permission',
        'location',
        'review',
        'state_of_disrepair',
        'budget'
    ];

    public static function saveCulturalWork($data, $url){
        if($data->author_id != null){
            $author_id = $data->author_id;
        }else{
            $author_id = null;
        }

        if($data->restoration_plan_id != null){
            $plan_id = $data->restoration_plan_id;
        }else{
            $plan_id = null;
        }

        $culturalWork = CulturalWork::create([
            'title' => $data->title,
            'year_of_stablishment' => $data->year_of_stablishment,
            'location' => $data->location,
            'restore_permission' => $data->restore_permission,
            'state_of_disrepair' => $data->state_of_disrepair,
            'review' => $data->review,
            'image' => $url,
            'author_id' => $author_id,
            'restoration_plan_id' => $plan_id
        ]);

        return $culturalWork;
    }


}
