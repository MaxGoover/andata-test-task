<?php

declare(strict_types=1);

namespace App\Infrastructure\Rules;

final readonly class ArticleRules
{
    const CONTENT_MIN_LENGTH = 10;
    const CONTENT_MAX_LENGTH = 10000;
    const TITLE_MIN_LENGTH = 3;
    const TITLE_MAX_LENGTH = 200;
}
