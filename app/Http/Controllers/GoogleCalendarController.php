<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarController extends Controller
{
    public function authenticate()
    {
        $client = new Google_Client();
        //adding credentials
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);

        if (!isset($_GET['code'])) {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        } else {
            $client->authenticate($_GET['code']);
            $accessToken = $client->getAccessToken();
            session(['access_token' => $accessToken]);

            return redirect()->route('events');
        }
    }

    public function events()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
        $client->setAccessToken(session('access_token'));

        $service = new Google_Service_Calendar($client);

        $calendarId = 'primary';
        $results = $service->events->listEvents($calendarId);

        $events = $results->getItems();

        return view('events', compact('events'));
    }
}
