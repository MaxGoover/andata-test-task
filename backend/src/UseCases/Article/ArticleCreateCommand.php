<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\Article;
use App\Entities\Article\ArticleRepositoryInterface;

final readonly class ArticleCreateCommand
{
    public function __construct(
        private ArticleRepositoryInterface $articles,
    ) {
    }

    public function handle(Article $article): string|false
    {
        return $this->articles->create($article);
    }
}
