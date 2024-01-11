<?php

namespace App\Http\Resources;

class UserRole
{
    private  static $adminStatus = false;
    public static function isAdmin(): bool
    {
        return self::$adminStatus;
    }

    public static function setAdminStatus(bool $adminStatus): void
    {
        self::$adminStatus = $adminStatus;
    }
}
