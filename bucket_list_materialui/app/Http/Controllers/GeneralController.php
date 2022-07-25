<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getHelp(){
        return view('help');
    }

    public function getAbout(){
        return view('about');
    }
}
