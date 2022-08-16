<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service;


/**
 * Csv parser
 *
 * @package Sarva\CommissionManagement\Service
 */
class Csv
{  
    /**
     * Reads a Csv file
     *
     * @param  string $fileName The file name
     *
     * @return array the file object
     */
    public static function read(string $fileName): array
    {
        return array_map('str_getcsv', file($fileName));
    }
}