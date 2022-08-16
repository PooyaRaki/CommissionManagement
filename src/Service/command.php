<?php

declare(strict_types=1);

namespace Sarva\CommissionManagement\Service;

/**
 * Command Line Management
 */
class Command
{
    /**
     * Gets arguments from command line
     *
     * @return array
     */
    public static function getArgs(): array
    {
        if (defined('STDIN')) {
            $type = $_SERVER['argv'];
        } else {
            $type = $_GET['type'];
        }

        // Here we remove the first index so that the filename is not included in the array
        if (isset($type[0])) {
            unset($type[0]);
        }

        return $type;
    }
}
