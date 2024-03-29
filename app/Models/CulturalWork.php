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
        'budget',
        'image',
        'author_id'
    ];

    // relaciones

    public function plans(){
        return $this->belongsToMany(RestorationPlan::class)->withPivot('start_date', 'end_date');
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function score(){
        return $this->hasMany(Score::class);
    }

    // metodos

    public static function saveCulturalWork($data, $url){
        $culturalWork = CulturalWork::create([
            'title' => $data->title,
            'year_of_stablishment' => $data->year_of_stablishment,
            'location' => $data->location,
            'restore_permission' => $data->restore_permission,
            'state_of_disrepair' => $data->state_of_disrepair,
            'review' => $data->review,
            'budget' => $data->budget,
            'image' => $url,
            'author_id' => $data->author_id,
            'restoration_plan_id' => $data->restoration_plan_id
        ]);

        return $culturalWork;
    }

    public function updateCulturalWork($data, $url){
        $this->update([
            'title' => $data->title,
            'year_of_stablishment' => $data->year_of_stablishment,
            'location' => $data->location,
            'restore_permission' => $data->restore_permission,
            'state_of_disrepair' => $data->state_of_disrepair,
            'review' => $data->review,
            'budget' => $data->budget,
            'image' => $url,
            'author_id' => $data->author_id,
            'restoration_plan_id' => $data->restoration_plan_id
        ]);
    }

    public static function generateReport(){
        return CulturalWork::where('restore_permission', '=', 'universidad')->whereIn('state_of_disrepair', ['regular', 'deteriorado'])->orderBy('state_of_disrepair', 'asc')->orderBy('budget', 'desc')->orderBy('id', 'desc')->get();
    }
}
