<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Articles;

use App\Adapters\Http\JsonResponse;
use App\UseCases\Article\ArticleIndexCommand;
final class ArticlesIndexAction
{
    public static function handle()
    {
        return new JsonResponse([
            'data' => ArticleIndexCommand::handle(),
            'message' => 'Articles indexed successfully',
        ]);
    }
}
