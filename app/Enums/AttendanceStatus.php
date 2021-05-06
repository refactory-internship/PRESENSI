<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AttendanceStatus extends Enum
{
    const ATTENDANCE = 1;
    const OVERTIME = 2;
    const ABSENT = 3;
    const LEAVE = 4;
}
