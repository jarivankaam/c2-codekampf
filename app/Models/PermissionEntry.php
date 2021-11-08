<?php

namespace App\Models;

use App\Helpers\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionEntry extends Model
{
    use HasFactory;

    /**
     * @return bool
     */
    function hasEditPermission(): bool {
        return $this->check(Permission::$Edit);
    }

    /**
     * @return bool
     */
    function hasAddPermission(): bool {
        return $this->check(Permission::$Add);
    }

    /**
     * @return bool
     */
    function isAdministrator(): bool {
        return $this->check(Permission::$Admin);
    }

    /**
     * @return bool
     */
    function hasDeletePermission(): bool {
        return $this->check(Permission::$Delete);
    }

    function check(int $permission): bool {
        return ($this->permissions & $permission) == $permission;
    }
}
