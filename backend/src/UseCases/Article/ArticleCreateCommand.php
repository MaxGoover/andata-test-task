<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\Article;
use App\Entities\Article\ArticleRepository;

final class ArticleCreateCommand
{
    public static function handle(Article $article)
    {
        return ArticleRepository::create($article);
    }
}
