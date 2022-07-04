<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum EventBonusEnums: int
{
    use InvokableCases;

    case REGISTRATION = 50;

    case ACTIVATION = 100;

    case APPOINTMENT = 200;
}
