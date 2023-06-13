<?php

namespace App\Console\Commands;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;
use App\Models\Maintenance;
use Illuminate\Console\Command;

class MaintanceReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Reminders Notification for Maintenance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {     
        $user = User::where('role', 'Admin')->first();
        $mail = new EmailGatewayController();
        $maintenance = Maintenance::all();
        
            foreach($maintenance as $item){
                $now = Carbon::now(); 
                $maintenance_date = Carbon::parse($item->maintenance_date);
                if($maintenance_date->diffInDays($now) == 10){
                    $mail->sendEmail($user->email,'ICT Choice | Vehicle Manangement System - Maintenance Reminder',EmailBodyController::maintenance_reminder($user,$item));
                }
            }    
            \Log::info('Successfully sent daily Maintenance reminder to administrator.');
    }
}
