<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
/**
* Gets page "Help"
* @return Illuminate\View\View
*/
    public function getHelp(){
        return view('help');
    }
/**
* Gets page "About"
* @return Illuminate\View\View
*/
    public function getAbout(){
        return view('about');
    }
}
