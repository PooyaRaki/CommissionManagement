<?php

declare(strict_types=1);

include_once __DIR__ . '/../vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("Your\\Test\\Namespace\\Here\\", __DIR__, true);
$classLoader->register();