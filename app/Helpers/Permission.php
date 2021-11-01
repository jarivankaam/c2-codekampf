<?php

namespace App\Helpers;

abstract class Permission
{
    public static $Admin = 1 << 0;
    public static $Edit = 1 << 1;
    public static $Delete = 1 << 2;
    public static $Add = 1 << 3;

    /**
     * @return Permission[]
     */
    public static function getAllPermission(): array {
        return [
            self::$Admin,
            self::$Edit,
            self::$Delete,
            self::$Add
        ];
    }
}
