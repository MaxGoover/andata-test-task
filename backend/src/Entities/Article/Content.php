<?php

declare(strict_types=1);

namespace App\Entities\Article;

use App\Infrastructure\Rules\ArticleRules;
use Webmozart\Assert\Assert;

final readonly class Content
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::minLength($value, ArticleRules::CONTENT_MIN_LENGTH);
        Assert::maxLength($value, ArticleRules::CONTENT_MAX_LENGTH);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
