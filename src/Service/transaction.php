<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service;

use DateTime;
use Sarva\CommissionManagement\Entity\Transaction as TransactionEntity;

class Transaction
{
    /**
     * Runs the main application
     *
     * @return void
     */
    public function run()
    {
        $args = Command::getArgs();
        if (isset($args[1])) {
            $fileName = $args[1];
            $csv = Csv::read(($fileName));
            $this->parse($csv);
        }
    }
    
    /**
     * Parses a csv file array into the Transaction Entity
     *
     * @param  mixed $csv The csv file array
     *
     * @return array Array of transaction entities
     */
    public function parse(array $data)
    {
        $transactions = [];
        foreach ($data as $key => $row) {
            $transaction = new TransactionEntity;
            $transaction->setId(++$key);
            $transaction->setDate($row[0]);
            $transaction->setUserId((int) $row[1]);
            $transaction->setUserType($row[2]);
            $transaction->setOperationType($row[3]);
            $transaction->setAmount((float) $row[4]);
            $transaction->setCurrency(strtolower($row[5]));

            $transactions[] = $transaction;
        }

        $commissions = $this->calculateCommission($transactions);

        print_r($commissions);
    }

    /**
     * Calculates commissionsn
     *
     * @param  array $transactions Array of transactions
     *
     * @return array Array of commission entities
     */
    private function calculateCommission($transactions)
    {
        $commission = new Commission($transactions);
        return $commission->calculate();
    }
}
