<?php

namespace App\RolesUsers;
use Faker;

class Roles
{
    const ROLE_USER = 0;
    const ROLE_RESTORER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_DELIVERER = 3;

    public static function getRoles(): array
    {
        return [
            self::ROLE_USER,
            self::ROLE_RESTORER,
            self::ROLE_ADMIN,
            self::ROLE_DELIVERER
        ];
    }

    public static function getAleaRoles(): string
    {
        $faker = Faker\Factory::create();

        // for ($i = 0; $i <= sizeof(self::ROLES); $i++) {
        //     return sizeof(self::ROLES);
        // }

        return "";
    }

    const ROLES = ["ROLE_USER", "ROLE_RESTORER", "ROLE_ADMIN", "ROLE_DELIVERER"];
}

