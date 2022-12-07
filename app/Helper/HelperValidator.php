<?php


namespace App\Helper;


class HelperValidator
{
    static $AVAILABLE_ROLE = [
        'admin',
        'member'
    ];

    public static function validate_available_role($role)
    {
        if (!in_array($role, self::$AVAILABLE_ROLE)) {
            return false;
        }
        return true;
    }
}
