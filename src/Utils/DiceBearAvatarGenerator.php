<?php

namespace App\Utils;

abstract class DiceBearAvatarGenerator
{
    public static function getAvatar(string $name)
    {
        return 'https://api.dicebear.com/8.x/avataaars/svg?seed=' . urlencode($name);
    }
}