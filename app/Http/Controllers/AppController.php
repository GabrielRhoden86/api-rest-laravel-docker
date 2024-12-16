<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AppController extends Controller
{

    public function Auth(){
        return Inertia::render('Login');
    }
}
