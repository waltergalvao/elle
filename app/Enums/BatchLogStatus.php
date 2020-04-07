<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BatchLogStatus extends Enum
{
    const IMPORTED = 0;
    const ERROR = 1;
    const DUPLICATE = 2;
}
