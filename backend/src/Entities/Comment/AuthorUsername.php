<?php

declare(strict_types=1);

namespace App\Entities\Comment;

use Webmozart\Assert\Assert;

final readonly class AuthorUsername
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::minLength($value, 3);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
