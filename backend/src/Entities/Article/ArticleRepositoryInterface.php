<?php

declare(strict_types=1);

namespace App\Entities\Article;

interface ArticleRepositoryInterface
{
    public function create(Article $article): array;

    public function index(): array;

    public function getById(int $id): array;
}
