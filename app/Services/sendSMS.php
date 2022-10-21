<?php

namespace App\Services;
use Exception;
use Twilio\Rest\Client;
/**
 * Class sendSMS
 * @package App\Services
 */
class sendSMS
{
    public function sendSMS($phone,$mesg){


        // try {

        //     $account_sid = 'AC0d7ad51f6c9dc6ac66b5e3dad1697e48';
        //     $auth_token = '9bc38fa74f2a683553e8aaad206a168a';
        //     $twilio_number = '+18449751883';

        //     $client = new Client($account_sid, $auth_token);
        //     $client->messages->create($phone, [
        //         'from' => $twilio_number,
        //         'body' => $mesg]);

        //     return true;
        // } catch (Exception $e) {
        //     return false;
        // }
        return true;
    }

}
