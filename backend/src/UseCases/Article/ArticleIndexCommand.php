<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\ArticleRepositoryInterface;

final readonly class ArticleIndexCommand
{
    public function __construct(
        private ArticleRepositoryInterface $articles,
    ) {
    }

    public function handle()
    {
        return $this->articles->index();
    }
}
