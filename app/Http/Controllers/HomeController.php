<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $restaurants = Restaurant::paginate(10);
        return view('home', compact('restaurants'));
    }

    public function get($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        return view('single', compact('restaurant'));
    }
}
