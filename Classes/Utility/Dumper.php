<?php


namespace Aleksundshantu\Femanagerextended\Utility;

/**
 * Class Dumper
 * to debug variables on screen
 * @package Aleksundshantu\Femanagerextended\Utility
 */
class Dumper
{
    public static function dumper($var)
    {
        echo "<pre style='font-size:16px;'>";
        var_dump($var);
        echo "</pre>";
        die;
    }
}