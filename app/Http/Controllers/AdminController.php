<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\CulturalWork;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(auth()->user()->role == 'administrador'){
            return redirect()->route('user.index');
        }else if(auth()->user()->role == 'vicerector' || auth()->user()->role == 'asistente'){
            return redirect()->route('culturalWork.index');
        }
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
