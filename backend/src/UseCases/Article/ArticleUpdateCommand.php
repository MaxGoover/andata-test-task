<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\Article;
use App\Entities\Article\ArticleRepositoryInterface;

final readonly class ArticleUpdateCommand
{
    public function __construct(
        private ArticleRepositoryInterface $articles,
    ) {
    }

    public function handle(Article $article, int $articleId): bool
    {
        return $this->articles->update($article, $articleId);
    }
}
