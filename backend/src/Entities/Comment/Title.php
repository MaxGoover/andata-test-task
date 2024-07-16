<?php

declare(strict_types=1);

namespace App\Entities\Comment;

use App\Infrastructure\Rules\CommentRules;
use Webmozart\Assert\Assert;

final readonly class Title
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::minLength($value, CommentRules::TITLE_MIN_LENGTH);
        Assert::maxLength($value, CommentRules::TITLE_MAX_LENGTH);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
