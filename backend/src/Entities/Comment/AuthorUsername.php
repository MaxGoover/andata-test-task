<?php

declare(strict_types=1);

namespace App\Entities\Comment;

use App\Infrastructure\Rules\CommentRules;
use App\Infrastructure\Rules\CommonRules;
use Webmozart\Assert\Assert;

final readonly class AuthorUsername
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::minLength($value, CommonRules::USERNAME_MIN_LENGTH);
        Assert::maxLength($value, CommonRules::USERNAME_MAX_LENGTH);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
