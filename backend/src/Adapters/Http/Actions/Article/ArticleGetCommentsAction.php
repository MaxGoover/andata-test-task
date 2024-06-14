<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class ArticleGetCommentsAction
{
    public function __construct(
        private CommentGetByArticleIdCommand $commentGetByArticleIdCommand,
        private CommentGetCountByArticleIdCommand $commentGetCountByArticleIdCommand
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        $articleId = self::getArticleId($request);

        try {
            return new JsonResponse([
                'comments'      => $this->commentGetByArticleIdCommand->handle($articleId),
                'countComments' => $this->commentGetCountByArticleIdCommand->handle($articleId),
                'message'       => 'Article comments gotten successfully',
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
