<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Http\Message\RequestInterface;

final readonly class ArticleGetCommentsAction
{
    public function __construct(
        private CommentGetByArticleIdCommand $commentGetByArticleIdCommand,
        private CommentGetCountByArticleIdCommand $commentGetCountByArticleIdCommand
    ) {
    }

    public function handle(RequestInterface $request): string|false
    {
        $articleId = self::getArticleId($request);

        return json_encode([
            'comments'      => $this->commentGetByArticleIdCommand->handle($articleId),
            'countComments' => $this->commentGetCountByArticleIdCommand->handle($articleId),
            'message'       => 'Article comments gotten successfully',
        ], JSON_THROW_ON_ERROR);
    }

    private static function getArticleId(RequestInterface $request): int
    {
        return intval(explode('/', $request->getUri()->getPath())[3]);
    }
}
