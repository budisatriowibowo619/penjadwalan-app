<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Schedule;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            "name"  =>  "test",
            "page"  =>  "Home",
            "data"  =>  Schedule::all()
        ]);
    }

    public function show()
    {

    }
}
