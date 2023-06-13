<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class EmailBodyController extends Controller
{
    public static function sendotp($name,$surname,$mesg){
        $body = ' <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                             Good day '. $name .' '.$surname.',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                            '.$mesg.'
                                        </p>

                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                           VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
        return $body;
    }
    public static function accountupdated($name,$surname){
        $body = '
            <tr>
                <td align="center" style="padding:0;">
                        <tr>
                            <td style="padding:36px 30px 42px 30px;">
                                    <tr>
                                        <td style="padding:0 0 36px 0;color:#153643;">
                                            <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                                Good day '.$name.' '.$surname.',
                                            <p
                                                style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                                Your account details for Vehicle Management System have been updated.
                                            </p>
                                            <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                                Thank
                                                you, </p>
                                            <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                                VMS </p>
                                        </td>
                                    </tr>

                            </td>
                        </tr>
                </td>
            </tr>';
        return $body;
    }
    public static function driveradd($user){
        $body = '
            <tr>
                <td align="center" style="padding:0;">
                        <tr>
                            <td style="padding:36px 30px 42px 30px;">
                                    <tr>
                                        <td style="padding:0 0 36px 0;color:#153643;">
                                            <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                                Good day '.$user['name'].' '.$user['surname'].',
                                            <p
                                                style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                               You have been successfully added as a driver on Vehicle Management System.
                                            </p>
                                            <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                                Thank
                                                you, </p>
                                            <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                                VMS </p>
                                        </td>
                                    </tr>
                            </td>
                        </tr>
                </td>
            </tr>';
        return $body;
    }
    public static function driverremoved($user){
        $body = '
            <tr>
                <td align="center" style="padding:0;">
                        <tr>
                            <td style="padding:36px 30px 42px 30px;">
                                    <tr>
                                        <td style="padding:0 0 36px 0;color:#153643;">
                                            <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                                Good day '.$user['name'].' '.$user['surname'].',
                                            <p
                                                style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                               You have been removed as a driver on Vehicle Management System.
                                            </p>
                                            <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                                Thank
                                                you, </p>
                                            <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                                VMS </p>
                                        </td>
                                    </tr>
                            </td>
                        </tr>
                </td>
            </tr>';
        return $body;
    }
    public static function vehiclebookingupdate($user){
        $body = '
        <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '.$user['full_name'].',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                              This serve has to inform you that your vehicle booking is <strong>'.$user['status'].'</strong><br>
                                              <ul>
                                                    <li><strong> Vehicle : </strong>'.$user['Registration_no'].'</li>
                                                    <li><strong> Trip duration : </strong>'.$user['trip_start_date'].' to '.$user['return_date'].' </li>
                                                    <li><strong> Destination : </strong>'.$user['destination'].'</li>
                                                    <li><strong> Trip Details : </strong>'.$user['trip_datails'].'</li>
                                                    <li><strong> Comment : </strong>'.$user['comment'].'</li>
                                              </ul>
                                        </p>
                                        <br>
                                        </p>
                                        <p style="text-align: center;">
                                          <a   href="http://127.0.0.1:8000/dashboard" tagert="_blank"  style=" margin: 10px 0px;
                                          border-radius: 4px;
                                          text-decoration: none;
                                          color: #fff !important;
                                          height: 46px;
                                          padding: 10px 20px;
                                          font-size: 16px;
                                          font-weight: 600;
                                          background-color: #021d68 !important;">Access system</a>
                                      </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
    return $body;
    }
    public static function  maintenance_reminder($user,$reminder){
        $body = '
        <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '.$user['name'].' '.$user['surname'].',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                              This serve has to inform you that maintenance reminder that is due or expire in 10 days time. Please check the vehicle management system on maintenance tab for more information.<br>
                                              <ul>
                                                <li><strong> Reminder Type : </strong>'.$reminder['maintenance_date'].'</li>
                                                <li><strong> Service Provider : </strong>'.$reminder['service_provider'].'</li>
                                                <li><strong> Current Millage : </strong>'.$reminder['current_millage'].'</li>
                                                <li><strong> Next Service Millage : </strong>'.$reminder['next_service_millage'].'</li>
                                              </ul>
                                        </p>
                                        <br>
                                        </p>
                                        <p style="text-align: center;">
                                          <a   href="http://127.0.0.1:8000/dashboard" tagert="_blank"  style=" margin: 10px 0px;
                                          border-radius: 4px;
                                          text-decoration: none;
                                          color: #fff !important;
                                          height: 46px;
                                          padding: 10px 20px;
                                          font-size: 16px;
                                          font-weight: 600;
                                          background-color: #021d68 !important;">Access system</a>
                                      </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
    return $body;
    }
    public static function  daily_reminder($user,$reminder){
        $body = '
        <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '.$user['name'].' '.$user['surname'].',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                              This serve has to inform you that reminder that is due or expire in 10 days time. Please check the vehicle management system on reminder tab for more information.<br>
                                              <ul>
                                                <li><strong> Reminder Type : </strong>'.$reminder['reminder_type'].'</li>
                                                <li><strong> Vehicle : </strong>'.$reminder['vehicle_plate'].'</li>
                                                <li><strong> Due Date : </strong>'.$reminder['due_date'].'</li>
                                              </ul>
                                        </p>
                                        <br>
                                        </p>
                                        <p style="text-align: center;">
                                          <a   href="http://127.0.0.1:8000/dashboard" tagert="_blank"  style=" margin: 10px 0px;
                                          border-radius: 4px;
                                          text-decoration: none;
                                          color: #fff !important;
                                          height: 46px;
                                          padding: 10px 20px;
                                          font-size: 16px;
                                          font-weight: 600;
                                          background-color: #021d68 !important;">Access system</a>
                                      </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
    return $body;
    }
    public static function vehiclebooking($user,$admin){
        $body = '
        <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '.$admin['name'].' '.$admin['surname'].',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                            The is a new vehicle booking on the system by '.$user['name'].' '.$user['surname'].'. 
                                            Please check the system for more information. <br><br>
                                        </p>
                                        </p>
                                        <p style="text-align: center;">
                                          <a   href="http://127.0.0.1:8000/dashboard" tagert="_blank"  style=" margin: 10px 0px;
                                          border-radius: 4px;
                                          text-decoration: none;
                                          color: #fff !important;
                                          height: 46px;
                                          padding: 10px 20px;
                                          font-size: 16px;
                                          font-weight: 600;
                                          background-color: #021d68 !important;">Access system</a>
                                      </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
    return $body;
    }
    public static function driverAssignedToVehicle($user){
        $body = '
        <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '.$user['assignee'].',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                           You have been assigned  to a vehicle on Vehicle Management System for vehicle with registration '.$user['Registration_no'].'.
                                           Please note that you have a responsibility to ensure that the vehicle is kept in good condition and all matters related to the vehicle.
                                        </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
    return $body;
    }
    public static function RemovedriverAssignedToVehicle($user){
        $body = '
        <tr>
            <td align="center" style="padding:0;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '.$user['assignee'].',
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                           You have been removed to vehicle on Vehicle Management System for vehicle with registration '.$user['Registration_no'].'.
                                        </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>
                        </td>
                    </tr>
            </td>
        </tr>';
    return $body;
    }
    public static function forgotpassword($id, $token){
        $body ='
        <tr>
            <td align="center" style="padding:0;">
                        <td style="padding:36px 30px 42px 30px;">

                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day, you have requested for password reset link
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                            <Strong>Password Rules are as following:</Strong> <br>
                                            <div style="padding:20px;">
                                                <small id="passwordHelp" class="form-text text-muted">
                                                <em><span style= "color:red;">
                                                -	At least be 8 characters long.<br>
                                                -	At least have one lower case letter.<br>
                                                -	At least have one upper case letter.<br>
                                                -	At least have one number.<br>
                                                -	At least have one special character.<br>
                                                </span>
                                                </em>
                                                </small>
                                                </div>
                                        </p>
                                        <p style="text-align: center;">
                                        <a   href="http://127.0.0.1:8000/resetPassword/'.$id.'/'.$token.'" tagert="_blank"  style=" margin: 10px 0px;
                                            border-radius: 4px;
                                            text-decoration: none;
                                            color: #fff !important;
                                            height: 46px;
                                            padding: 10px 20px;
                                            font-size: 16px;
                                            font-weight: 600;
                                            background-color: #021d68 !important;">Reset Password</a>
                                        </p>
                                        <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Thank
                                            you, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            VMS </p>
                                    </td>
                                </tr>

                        </td>
                    </tr>

            </td>
        </tr>
   ';
        return $body;
    }
   
    public static function useraccount($name,$surname,$id,$token)
    {
       $body = '
       <tr>
           <td align="center" style="padding:0;">
                   <tr>
                       <td style="padding:36px 30px 42px 30px;">
                               <tr>
                                   <td style="padding:0 0 36px 0;color:#153643;">
                                       <p style="font-weight:bold;margin:30px 0 20px 0;font-family:Arial,sans-serif;">
                                            Good day '. $name .' '. $surname.',
                                       <p
                                           style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                           Your account for <strong>Vehicle Management System</strong> has been created.<br>
                                           Click the button bellow to set password : <br> </br>
                                       </p>
                                       <p style="text-align: center;">
                                         <a   href="http://127.0.0.1:8000//passwordCreate/'.$id.'/'.$token.'" tagert="_blank"  style=" margin: 10px 0px;
                                         border-radius: 4px;
                                         text-decoration: none;
                                         color: #fff !important;
                                         height: 46px;
                                         padding: 10px 20px;
                                         font-size: 16px;
                                         font-weight: 600;
                                         background-color: #021d68 !important;">Set Password</a>
                                     </p>
                                       <p style="margin:20px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                           Thank
                                           you, </p>
                                       <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                          VMS </p>
                                   </td>
                               </tr>

                       </td>
                   </tr>

           </td>
       </tr>
  ';
       return $body;
    }
}
