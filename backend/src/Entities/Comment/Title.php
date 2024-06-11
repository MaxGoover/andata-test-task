<?php

declare(strict_types=1);

namespace App\Entities\Comment;

use Webmozart\Assert\Assert;

final readonly class Title
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::minLength($value, 3);
        Assert::maxLength($value, 100);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
