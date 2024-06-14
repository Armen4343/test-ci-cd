<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
	'google' => [
        'client_id' => '507184983158-k5ta4c3rns9llgn4ir6q5tutksrigj66.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://it.zeepup.com/auth/google/callback',
    ],
	'facebook' => [
        'client_id' => '1264327934190298',
        'client_secret' => 'f31a5ed41f9ba054d74317eb47366f48',
        'redirect' => 'https://it.zeepup.com/auth/facebook/callback',
    ],
];
