<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\ArticleRepository;

final class ArticleShowCommand
{
    public static function handle(int $id)
    {
        return ArticleRepository::getById($id);
    }
}
