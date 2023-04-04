<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestorationPlan extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'annual_budget', 'approval'];
}
