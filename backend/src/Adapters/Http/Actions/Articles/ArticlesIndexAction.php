<?php

declare(strict_types=1);

namespace App\Http\Actions\Articles;

use App\Adapters\Http\JsonResponse;
use App\UseCases\Article\ArticleIndexCommand;
use Psr\Http\Message\ServerRequestInterface;

final class ArticlesIndexAction
{
    public function handle(ServerRequestInterface $request)
    {
        ArticleIndexCommand::handle();

        return new JsonResponse('Articles indexed successfully');
    }
}
