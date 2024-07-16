<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\ArticleRepositoryInterface;

final readonly class ArticleDeleteCommand
{
    public function __construct(
        private ArticleRepositoryInterface $articles,
    ) {
    }

    public function handle(int $id): bool
    {
        return $this->articles->delete($id);
    }
}
