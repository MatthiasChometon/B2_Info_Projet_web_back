<?php

namespace App\Commandes;

class State
{
    const IN_PROGRESS = 0;
    const IN_COMING = 1;
    const DELIVERED = 2;

    public static function getStatus(): array
    {
        return [
            self::IN_PROGRESS,
            self::IN_COMING,
            self::DELIVERED
        ];
    }
}