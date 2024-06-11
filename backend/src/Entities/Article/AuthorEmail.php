<?php

declare(strict_types=1);

namespace App\Entities\Article;

use Webmozart\Assert\Assert;

final readonly class AuthorEmail
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::email($value);
        Assert::maxLength($value, 320);
        $this->value = mb_strtolower($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
