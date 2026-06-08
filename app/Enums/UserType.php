<?php

namespace App\Enums;

enum UserType: string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case BURSAR = 'bursar';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::STAFF => 'Staff',
            self::BURSAR => 'Bursar',
        };
    }
}
