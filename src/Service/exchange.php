<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service;

use Sarva\CommissionManagement\Config\Exchange as ExchangeConfig;

/**
 * Exchange methods
 *
 * @package Sarva\CommissionManagement\Service
 */
class Exchange
{
    private static function fetchConfiguration()
    {
        return ExchangeConfig::CONFIG;
    }

    /**
     * Convert a currency From Euro to another currency
     *
     * @param  float  $amount    The amount to convert
     * @param  string $from      The currency to convert from
     * @param  string $to        The currency to convert to
     *
     * @return float The converted amount
     */
    public static function fromEuro($amount, $currency): float
    {
        $config = self::fetchConfiguration();
        return $amount * $config[$currency];
    }

    /**
     * Convert a currency From another currency to Euro
     *
     * @param  float  $amount    The amount to convert
     * @param  string $from      The currency to convert from
     * @param  string $to        The currency to convert to
     *
     * @return float The converted amount
     */
    public static function toEuro($amount, $currency): float
    {
        $config = self::fetchConfiguration();

        return $amount / $config[$currency];
    }
}