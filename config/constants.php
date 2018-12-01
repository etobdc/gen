<?php

return [
    'options' => [
        'items_per_page' => 10,
        'moip_url' => env('MOIP_URL', 'https://sandbox.moip.com.br/v2/'),
        'API_TOKEN' => env('API_TOKEN', ''),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME', ''),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS', ''),
        'MAIL_DESTINY_ADDRESS' => env('MAIL_DESTINY_ADDRESS', ''),
    ]
];

?>