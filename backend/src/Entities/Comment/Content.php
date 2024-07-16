<?php

declare(strict_types=1);

namespace App\Entities\Comment;

use App\Infrastructure\Rules\CommentRules;
use App\Infrastructure\Rules\CommonRules;
use Webmozart\Assert\Assert;

final readonly class Content
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::minLength($value, CommentRules::CONTENT_MIN_LENGTH);
        Assert::maxLength($value, CommentRules::CONTENT_MAX_LENGTH);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
