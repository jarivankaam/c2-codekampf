<?php

namespace App\Helpers;

class PermissionHelper
{

    /**
     * @param int $permissionNumber
     * @return int[]
     */
    public static function getPermissions(int $permissionNumber): array {
        $newPerms = [];
        foreach (Permission::getAllPermission() as $permission) {
            if (($permissionNumber & $permission) == $permission)
                array_push($newPerms, $permission);
        }
        return $newPerms;
    }
}
