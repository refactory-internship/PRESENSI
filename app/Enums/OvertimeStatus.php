<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OvertimeStatus extends Enum
{
    const NEEDS_APPROVAL =   1;
    const APPROVED =   2;
    const REJECTED = 3;
}
