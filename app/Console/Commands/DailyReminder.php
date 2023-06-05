<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;
use App\Models\User;
use App\Models\Reminder;
use Carbon\Carbon;
class DailyReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending reminder by email daily to the administrator';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('role', 'Admin')->first();
        $mail = new EmailGatewayController();
        $reminders = Reminder::all();
        
            foreach($reminders as $reminder){
                $now = Carbon::now(); 
                $reminder_date = Carbon::parse($reminder->due_date);
                if($reminder_date->diffInDays($now) == 10){
                    $mail->sendEmail($user->email,'ICT Choice | Vehicle Manangement System - Reminder',EmailBodyController::daily_reminder($user,$reminder));
                }
            }    
            \Log::info('Successfully sent daily reminder to administrator.');
    }
}
