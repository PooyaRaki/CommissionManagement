<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service\Commission;

use Sarva\CommissionManagement\Entity\Transaction as TransactionEntity;
use Sarva\CommissionManagement\Service\Exchange;

/**
 * Withdrawal methods
 *
 * @package Sarva\CommissionManagement\Service\Commission
 */
trait Withdraw {

    /**
     * Calculates the commission for a withdrawal
     *
     * @param  TransactionEntity $transaction The transaction entity
     *
     * @return float The commission
     */
    private function withdraw($transactions, TransactionEntity $transaction)
    {
        if ($transaction->getUserType() === 'business') {
            return $this->withdrawBusiness($transaction);
        } else if ($transaction->getUserType() === 'private') {
            return $this->withdrawPrivate($transactions, $transaction);
        }
    }

    /**
     * Calculates the commission for a business user
     *
     * @param  TransactionEntity $transaction The transaction entity
     *
     * @return float The percentage
     */
    private function withdrawBusiness($transaction)
    {
        return $transaction->getAmount() * $this->config['withdraw'][$transaction->getUserType()] / 100;
    }

    /**
     * Calculates the commission for a private user
     *
     * @param  array             $transactions  Array of transactions
     * @param  TransactionEntity $transaction   The transaction entity
     *
     * @return float The percentage
     */
    private function withdrawPrivate($transactions, $transaction)
    {
        $id = $transaction->getId();
        $amountEuro = Exchange::toEuro($transaction->getAmount(), $transaction->getCurrency());
        $userWeeklyTransactions = $this->getWeeklyTransactions(
            $transactions,
            $transaction->getUserId(),
            $transaction->getDate(),
        );

        $weeklyCount = 0;
        $weeklyAmount = 0;
        $transactionId = null;
        foreach ($userWeeklyTransactions as $transaction) {
            $weeklyCount++;
            if ($weeklyCount <= $this->config['exempt_number']) {
                $weeklyAmount += Exchange::toEuro($transaction->getAmount(), $transaction->getCurrency());
            }

            if ($weeklyAmount >= $this->config['exempt_fee']) {
                $transactionId = $transaction->getId();
                break;
            }
        }

        if (!empty($transactionId)) {
            if ($id == $transactionId) {
                $amountEuro = $weeklyAmount - $this->config['exempt_fee'];
            } else if ($id < $transactionId) {
                $amountEuro = 0;
            }

        } else {
            $amountEuro = 0;
        }

        $commission = $amountEuro * $this->config['withdraw'][$transaction->getUserType()] / 100;

        return Exchange::fromEuro($commission, $transaction->getCurrency());
    }

    /**
     * Gets weekly transactions of a specific user
     *
     * @param  array             $transactions  Array of transactions
     * @param  int               $userId        The user id
     * @param  string            $date          The date
     *
     * @return array The transactions
     */
    public function getWeeklyTransactions($transactions, int $userId, string $date): array
    {
        $sortedTransaction = [];

        $currentDate = new \DateTime($date);
        $currentWeek = $currentDate->format('W');

        foreach ($transactions as $transaction) {
            $transactionDate = new \DateTime($transaction->getDate());
            $transactionWeek = $transactionDate->format('W');
           
            if ($transaction->getUserId() == $userId) {
                if ($currentWeek == $transactionWeek && abs((int)$currentDate->diff($transactionDate)->format('%R%a')) <= $this->config['exempt_day']) {
                    $sortedTransaction[] = $transaction;
                }
            }
        }

        return $sortedTransaction;
    }
}