<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AttendanceStatus extends Enum
{
    const PRESENT = 1;
    const ABSENT = 2;
    const LEAVE = 3;
}
