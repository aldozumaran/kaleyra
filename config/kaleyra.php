<?php

return [
    'url' => env('KALEYRA_URL','https://api.eu.kaleyra.io/'),
    'sid' => env('KALEYRA_SID',''),
    'key' => env('KALEYRA_KEY',''),
    'sms' => [
        'type' => env('KALEYRA_SMS_TYPE','DEFAULT'),
        'sender' => env('KALEYRA_SMS_SENDER',''),
    ]
];
