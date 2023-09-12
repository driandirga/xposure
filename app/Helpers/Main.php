<?php

namespace App\Helpers;

class Main
{
    public static function left($str, $length): string
    {
        return substr($str,0,$length);
    }

    public static function right($str, $length): string
    {
        return substr($str, -$length);
    }
}
