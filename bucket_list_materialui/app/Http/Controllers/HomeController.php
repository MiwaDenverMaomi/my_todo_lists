<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket_list;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bucket_lists=Bucket_list::with(['likes'])->get();
        \Log::info('home index');
        \Log::debug($bucket_lists);
        return view('home');
    }
}
