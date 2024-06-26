<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Article\ArticleShowCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class ArticleShowAction
{
    public function __construct(
        private ArticleShowCommand $articleShowCommand,
        private CommentGetByArticleIdCommand $commentGetByArticleIdCommand,
        private CommentGetCountByArticleIdCommand $commentGetCountByArticleIdCommand,
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            $articleId = self::getArticleId($request);

            return new JsonResponse([
                'article'       => $this->articleShowCommand->handle($articleId),
                'comments'      => $this->commentGetByArticleIdCommand->handle($articleId),
                'countComments' => $this->commentGetCountByArticleIdCommand->handle($articleId),
                'message'       => 'Article showed successfully',
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => $e->getMessage(),
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
