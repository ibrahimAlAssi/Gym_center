<?php

declare(strict_types=1);

namespace App\Domains\Plans\Enums;

use BenSampo\Enum\Enum;

final class PlanTypeEnum extends Enum
{
    const VIP = 'vip';

    const NORMAL = 'normal';
}
