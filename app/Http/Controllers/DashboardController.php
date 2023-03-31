<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use DB;
use DateTime;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\feeds;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Services\sendSMS;
use App\Mail\AccountUpdated;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('dashboard')->with([
            'vehicles' => $vehicles,
            'drivers' => $drivers,
        ]);
    }
    public static function update_feed($task, $event,  $person, $date)
    {
        feeds::create(
            [
                'task'=> $task,
                'event'=> $event,
                'person'=> $person,
                'date'=> $date,
            ]
        );
        return true;
    }
    public function profile()
    {
     $user = User::all();
     return view('profile')->with('user',$user);
    }

}
