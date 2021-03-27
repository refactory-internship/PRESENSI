<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AttendanceApprovalStatus extends Enum
{
    const NEEDS_APPROVAL = 1;
    const CLOCK_OUT_ALLOWED = 2;
    const APPROVED = 3;
    const REJECTED = 4;
}
