<?php

namespace App\Http\Controllers;

use Microsoft\Graph\Core\Core\Http\GraphClientFactory;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use GraphServiceClient;
use App\Models\User;
use Microsoft\Graph\Connect\Constants;
use GuzzleHttp;
use Exception;
use TokenCache;

class EmailGatewayController extends Controller
{


    public function GetAccessToken()
    {

        $tenantId = 'b7c1d9a8-4dd4-4e3a-b0b6-44fb57a4fc6d';
        $clientId = 'c6b4ba29-e2ac-4959-97cf-7c7706924075';
        $clientSecret = '9_28Q~RWNdIAqfD1qe8xr8kDQPRMnBhpN~8BZbqL';


        $guzzle = new \GuzzleHttp\Client();
        $url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/token?api-version=1.0';
        $token = json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'resource' => 'https://graph.microsoft.com/',
                'grant_type' => 'client_credentials',
            ],
        ])->getBody()->getContents());
       return $accessToken = $token->access_token;
    }


    public function getCalendarData(){


        $graph = new Graph();
        $graph->setBaseUrl("https://graph.microsoft.com/")
               ->setApiVersion("v1.0")
               ->setAccessToken($this->getAccessToken());
// dd($graph);
        $user = $graph->createRequest("GET","/users/mxolisi.poni@ictchoice.com/mailFolders/drafts")
                    ->addHeaders(array("Content-Type" => "application/json"))
                    ->setReturnType(\Microsoft\Graph\Model\User::class)
                    ->setTimeout("1000")
                    ->execute();

         dd($user);
    }

  public function sendEmail($toEmail,$subject ,$body)
  {
    $accessToken = $this->getAccessToken();
    $email = [
        'message' => [
            'subject' => $subject,
            'body' => [
                'contentType' => 'Html',
                'content' => $body,
            ],
            'toRecipients' => [
                [
                    'emailAddress' => [
                        'address' => $toEmail,
                    ]
                ]
            ]
        ],
        'saveToSentItems' => "true",
    ];

    $me = '8d7f6a56-ffa0-45d6-819b-47cd390d77ba';

    $graph = new Graph();

    $headers = [
        'Content-Type' => 'application/json'
    ];

    $graph->setBaseUrl("https://graph.microsoft.com/")
    ->setApiVersion("v1.0")
    ->setAccessToken($this->getAccessToken());
// dd($graph);
$user = $graph->createRequest("POST","/users/support@ictchoice.com/sendMail")

        ->addHeaders($headers)
        ->attachBody($email)
        ->execute();

    if($user)
    {
        return 'Sent';
    }else{
        return 'Something is wrong';
    }

  }

}


