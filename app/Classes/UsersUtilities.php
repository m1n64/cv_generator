<?php


namespace App\Classes;


class UsersUtilities
{
    static function checkPrivilegesForToken($user)
    {
        $privileges = ["main:user"];

        if ($user->permission_id === Constants::MODER_PRIVILEGE) $privileges[] = "main:moder";
        if ($user->permission_id === Constants::ADMIN_PRIVILEGE) {
            $privileges[] = "main:moder"; //refactor this pls
            $privileges[] = "main:admin";
        }

        return $privileges;
    }
}
