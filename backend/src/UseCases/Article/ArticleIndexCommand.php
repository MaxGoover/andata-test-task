<?php

declare(strict_types=1);

namespace App\UseCases\Article;

use App\Entities\Article\ArticleRepository;

final class ArticleIndexCommand
{
    public static function handle()
    {
        return ArticleRepository::index();
    }
}
