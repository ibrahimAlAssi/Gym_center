<?php

declare(strict_types=1);

namespace App\Domains\Club\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class WorkDayEnum extends Enum
{
    const MONDAY = 'Monday';

    const TUESDAY = 'Tuesday';

    const WEDNESDAY = 'Wednesday';

    const THURSDAY = 'Thursday';

    const FRIDAY = 'Friday';

    const SATURDAY = 'Saturday';

    const SUNDAY = 'Sunday';
}
