<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service\Commission;

trait Deposit {
    private function deposit($transaction) {
        return $transaction->getAmount() * $this->config[$transaction->getOperationType()][$transaction->getUserType()] / 100;
    }
}