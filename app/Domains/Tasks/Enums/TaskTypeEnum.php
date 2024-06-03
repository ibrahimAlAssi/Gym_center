<?php

declare(strict_types=1);

namespace App\Domains\Tasks\Enums;

use BenSampo\Enum\Enum;

final class TaskTypeEnum extends Enum
{
    const BACK = 'ظهر';

    const FEED = 'قدم';

    const CHEST = 'صدر';

    const ARMPIT = 'باط';

    const SHOULDER = 'كتف';
}
