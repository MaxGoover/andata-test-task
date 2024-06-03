<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\UseCases\Article\ArticleIndexCommand;

final class ArticleIndexAction
{
    public static function handle()
    {
        return json_encode([
            'articles' => ArticleIndexCommand::handle(),
            'message'  => 'Articles indexed successfully',
        ], JSON_THROW_ON_ERROR);
    }
}
