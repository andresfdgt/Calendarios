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
        // Nuestras credenciales de la API de Google.
        // Our Google API credentials.
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        
        // La URL a la que redirigir después del proceso de OAuth.
        // The URL to redirect to after the OAuth process.
        'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
        
        // La URL que escucha las notificaciones de webhook de Google.
        // The URL that listens to Google webhook notifications.
        'webhook_uri' => env('GOOGLE_WEBHOOK_URI'),
        
        // Informar al usuario de lo que vamos a utilizar desde su cuenta de Google.
        // Let the user know what we will be using from his Google account.
        'scopes' => [
            // Obtener acceso al correo electrónico del usuario.
            // Getting access to the user's email.
            \Google_Service_Oauth2::USERINFO_EMAIL,
            
            // Gestión de los calendarios y eventos del usuario.
            // Managing the user's calendars and events.
            \Google_Service_Calendar::CALENDAR,
        ],
        
        // Habilita la actualización automática de tokens.
        // Enables automatic token refresh.
        'approval_prompt' => 'force',
        'access_type' => 'offline',
        
        // Habilita alcances incrementales (útil si en el futuro necesitamos acceder a otro tipo de datos).
        // Enables incremental scopes (useful if in the future we need access to another type of data).
        'include_granted_scopes' => true,
    ],

];
