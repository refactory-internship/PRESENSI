<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CalendarStatus extends Enum
{
    const WEEK_DAY = 1;
    const WEEK_END = 2;
    const HOLIDAY = 3;
}
