<?php

declare(strict_types=1);

namespace App\Infrastructure\Rules;

final readonly class CommonRules
{
        const DATE_FORMAT = 'Y-m-d H:i:s';
        const EMAIL_MAX_LENGTH = 320;
        const USERNAME_MIN_LENGTH = 3;
        const USERNAME_MAX_LENGTH = 100;
}
