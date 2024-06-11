<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\UseCases\Article\ArticleShowCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Http\Message\RequestInterface;

final readonly class ArticleShowAction
{
    public function __construct(
        private ArticleShowCommand $articleShowCommand,
        private CommentGetByArticleIdCommand $commentGetByArticleIdCommand,
        private CommentGetCountByArticleIdCommand $commentGetCountByArticleIdCommand,
    ) {
    }

    public function handle(RequestInterface $request): string|false
    {
        $articleId = self::getArticleId($request);

        return json_encode([
            'article'       => $this->articleShowCommand->handle($articleId),
            'comments'      => $this->commentGetByArticleIdCommand->handle($articleId),
            'countComments' => $this->commentGetCountByArticleIdCommand->handle($articleId),
            'message'       => 'Article showed successfully',
        ], JSON_THROW_ON_ERROR);
    }

    private static function getArticleId(RequestInterface $request): int
    {
        return intval(explode('/', $request->getUri()->getPath())[3]);
    }
}
