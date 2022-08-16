<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Entity;

class Transaction
{
    private int $id;
    private string $date;
    private string $userType;
    private string $currency;
    private string $operationType;
    private int $userId;
    private float $amount;
    private $commission;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setUserType($type)
    {
        $this->userType = $type;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setOperationType($operationType)
    {
        $this->operationType = $operationType;
    }

    public function getOperationType()
    {
        return $this->operationType;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setCommission($commission)
    {
        $this->commission = $commission;
    }

    public function getCommission()
    {
        return $this->commission;
    }
}