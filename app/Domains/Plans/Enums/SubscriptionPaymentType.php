<?php

declare(strict_types=1);

namespace App\Domains\Plans\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SubscriptionPaymentType extends Enum
{
    const POINTS = 'points';
}
