<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Tests;

use PHPUnit\Framework\TestCase;
use Sarva\CommissionManagement\Service\Csv;
use Sarva\CommissionManagement\Service\Transaction;

final class Commission extends TestCase
{
    public function testEquality(): void
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        $test = [ 0.6, 3, 0, 0.06, 1.5, 0, 1.29, 0.27, 0.3, 3, 0, 0, 8607.39 ];

        $transaction = new Transaction;
        $csv = Csv::read('./finance.csv');
        $output = $transaction->parse($csv);

        $this->assertEquals($output, $test);
    }
}