<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Article\ArticleIndexCommand;
use Exception;
use Psr\Http\Message\ResponseInterface;

final readonly class ArticleIndexAction
{
    public function __construct(
        private ArticleIndexCommand $articleIndexCommand,
    ) {
    }

    public function handle(): ResponseInterface
    {
        try {
            return new JsonResponse([
                'articles' => $this->articleIndexCommand->handle(),
                'message'  => 'Articles indexed successfully',
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => $e->getMessage(),
            ], 400);
        }
    }
}
