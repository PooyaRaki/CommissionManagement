<?php

declare(strict_types=1);

require '../vendor/autoload.php';

use Sarva\CommissionManagement\Service;
$transaction = new Service\Transaction;
$transaction->run();