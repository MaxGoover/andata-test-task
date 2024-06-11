<?php

declare(strict_types=1);

namespace App\Entities\Article;

interface ArticleRepositoryInterface
{
    public function create(Article $article): string|false;

    public function getById(int $id): array;

    public function index(): array;
}
