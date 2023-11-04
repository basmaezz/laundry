<?php

return [
    'Url' => env('OPPWA_PAYMENT', 'https://test.oppwa.com/v1/checkouts'),
    'Authorization' => env('OPPWA_AUTH', 'OGFjN2E0Yzg4YjY3MGQyNTAxOGI2NzNiNGIwMTAwNjB8NlNhTkg5UHA1NGI2QVlzbg=='),
    'EntityID' => [
        'VISA' => env('OPPWA_ENTITY_ID_VISA','8ac7a4c88b670d25018b673bbc1e0064'),
        'MADA' => env('OPPWA_ENTITY_ID_MADA','8ac7a4c88b670d25018b673d9371006c'),
    ],
    'Currency' => env('OPPWA_CURRENCY', 'SAR'),
    'PaymentType' => env('OPPWA_PAYMENT_TYPE', 'DB'),
    'testMode' => env('OPPWA_TEST_MODE', 'EXTERNAL'),
];
