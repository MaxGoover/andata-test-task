<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Article\ArticleDeleteCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class ArticleDeleteAction
{
    public function __construct(
        private ArticleDeleteCommand $articleDeleteCommand,
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            $articleId = self::getArticleId($request);

            return new JsonResponse([
                'isDeleted' => $this->articleDeleteCommand->handle($articleId),
                'message' => _('message_success_article_delete'),
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => _('message_error_article_delete'),
            ], 400);
        }
    }

    /**
     * Возвращает id текущей (выбранной) статьи.
     */
    private static function getArticleId(RequestInterface $request): int
    {
        return intval(explode('/', $request->getUri()->getPath())[3]);
    }
}
