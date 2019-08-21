<?php

namespace App\Http\Controllers;

use App\Models\Intersection;
use App\Models\RegulatorBox;
use App\Models\TrafficLight;
use App\Models\TrafficPole;
use App\Models\TrafficTensor;
use App\Models\VerticalSignal;
use Auth;
use Session;

class UserController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }

        $total_vsignals = VerticalSignal::count();
        $total_intersections = Intersection::count();
        $total_rboxes = RegulatorBox::count();
        $total_poles = TrafficPole::count();
        $total_tensors = TrafficTensor::count();
        $total_lights = TrafficLight::count();

        Session::now('success', 'Bienvenido ' . Auth::user()->full_name());
        //return view('pages.user.home');
        return view('pages.user.home', compact('total_vsignals', 'total_intersections', 'total_rboxes', 'total_poles', 'total_tensors', 'total_lights'));
    }
}
