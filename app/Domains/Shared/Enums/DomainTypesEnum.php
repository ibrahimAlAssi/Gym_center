<?php

declare(strict_types=1);

namespace App\Domains\Shared\Enums;

use BenSampo\Enum\Enum;

final class DomainTypesEnum extends Enum
{
    public const ENTITIES = 'entities';

    public const CLUBS = 'club';

    public const PLANS = 'plans';

    public const TASKS = 'tasks';
}
