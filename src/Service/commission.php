<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service;

use Sarva\CommissionManagement\Config\Commission as CommissionConfig;
use Sarva\CommissionManagement\Config\Transaction as TransactionConfig;
use Sarva\CommissionManagement\Entity\Transaction as TransactionEntity;
use Sarva\CommissionManagement\Service\Commission\Deposit;
use Sarva\CommissionManagement\Service\Commission\Withdraw;

/**
 * Class Commission
 *
 * @package Sarva\CommissionManagement\Service
 */
class Commission
{
    use Deposit;
    use Withdraw;

    /**
     * @var array Transactions
     */
    private array $transactions;

    /**
     * @var array Configuration
     */
    private array $config;

    public function __construct($transactions)
    {
        $this->config = $this->fetchConfiguration();

        $this->transactions = $transactions;
    }
    
    /**
     * Fetches commission configuration
     *
     * @return void
     */
    private function fetchConfiguration()
    {
        return CommissionConfig::CONFIG;
    }
   
    /**
     * Calculates commission based on type of transaction
     *
     * @return void
     */
    public function calculate()
    {
        $commissions = [];
        foreach ($this->transactions as $transaction) {
            if ($transaction->getOperationType() === TransactionConfig::DEPOSIT) {
                $commissions[] = $this->format($this->deposit($transaction));
            } elseif ($transaction->getOperationType() === TransactionConfig::WITHDRAW) {
                $commissions[] = $this->format($this->withdraw($this->transactions, $transaction));
            }
        }
        
        return $commissions;
    }
    
    /**
     * Formats the commission fee for the output
     *
     * @param  mixed $result
     * @return void
     */
    private function format($result)
    {
        return round($result, 2);
    }
}
