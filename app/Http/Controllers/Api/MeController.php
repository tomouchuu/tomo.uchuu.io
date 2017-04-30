<?php

namespace Tomo\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tomo\Http\Controllers\Controller;

use Twitter;
use Instagram;

class MeController extends Controller
{
    public function me() {
        return response()->json([
            'name' => 'Thomas Moore',
            'location' => 'Chelmsford, Essex, England',
            'birthday' => '14-09-1993',
            'work' => [
                [
                    'company' => 'reed.co.uk',
                    'date' => 'September 2016 - Current',
                    'description' => 'I\'m a junior full-stack developer working on the jobseeker site. At work we use Razor & Knockout with LESS for our front end and a C# backend.'
                ],
                [
                    'company' => 'Ahead4',
                    'date' => 'May 2012 - September 2016',
                    'description' => 'I handled a lot of the front end tasks such as slicing sites and some back end tasks using PHP and MySQL to integrate designs into our custom CMS, Wordpress or a bespoke control panel depending on the client.'
                ]
            ],
            'contact' => [
                'email' => "tomo@uchuu.io",
                'blog' => "https://tomo.uchuu.io/blog",
                'github' => "https://github.com/tomouchuu",
                'instagram' => "https://instagram.com/tomouchuu",
                'trello' => "https://trello.com/b/FcW2Q1jL",
                'twitter' => "https://www.twitter.com/tomouchuu",
                'mastodon' => "https://niu.moe/@tomo",
            ]
        ]);
    }

    public function twitter() {
        return Twitter::getUsers(['screen_name' => 'tomouchuu', 'format' => 'json']);
    }

    public function instagram() {
        $data = Instagram::get('v1/users/self/media/recent', ['access_token' => env('INSTAGRAM_API_ACCESS_TOKEN', '')]);
        return response()->json($data['data']);
    }

    public function github() {
        $client = new \Github\Client();
        $response = $client->getHttpClient()->get('users/tomouchuu/events/public');
        $events     = \Github\HttpClient\Message\ResponseMediator::getContent($response);
        return response()->json($events);
    }
}