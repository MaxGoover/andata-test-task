<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\UseCases\Article\ArticleIndexCommand;

final readonly class ArticleIndexAction
{
    public function __construct(
        private ArticleIndexCommand $articleIndexCommand,
    ) {
    }

    public function handle(): string|false
    {
        return json_encode([
            'articles' => $this->articleIndexCommand->handle(),
            'message'  => 'Articles indexed successfully',
        ], JSON_THROW_ON_ERROR);
    }
}
