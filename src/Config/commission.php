<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Config;

class Commission {
    const CONFIG = [
        'deposit' => [
            'business' => 0.03,
            'private' => 0.03,
        ],
        'withdraw' => [
            'private' => 0.3,
            'business' => 0.5,
        ],
        'exempt_fee' => 1000,
        'exempt_number' => 3,
        'exempt_day' => 7,
        'exempt_currency' => 'eur',
        'exchange' => [
            'eur' => 1,
            'usd' => 1.129031,
            'jpy' => 130.869977,
        ],
    ];
}