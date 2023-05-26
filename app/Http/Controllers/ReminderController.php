<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReminderController extends Controller
{
    //

    public function reminders()
    {
        
        return view('reminders');
    }
}
