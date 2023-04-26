<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function culturalWork(){
        return $this->belongsTo(CulturalWork::class);
    }


    public static function avgScoreCulturalWork(CulturalWork $culturalWork){
        return DB::select('Select AVG(amount) as amount FROM scores WHERE cultural_work_id = '.$culturalWork->id);
    }
}
