<?php

declare(strict_types=1);

namespace App\Domains\Tasks\Enums;

use BenSampo\Enum\Enum;

final class TaskTypeEnum extends Enum
{
    const BACK = 'back';

    const FEED = 'feed';

    const CHEST = 'chest';

    const ARMPIT = 'armpit';

    const SHOULDER = 'shoulder';
}
