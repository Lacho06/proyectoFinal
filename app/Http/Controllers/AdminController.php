<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\CulturalWork;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $users = User::take('5')->orderBy('updated_at', 'desc')->get();
        $culturalWorks = CulturalWork::take('5')->orderBy('updated_at', 'desc')->get();
        $authors = Author::take('5')->orderBy('updated_at', 'desc')->get();
        return view('admin.index', compact('users', 'culturalWorks', 'authors'));
    }
}
