<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\UseCases\Article\ArticleShowCommand;
use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Http\Message\RequestInterface;

final class ArticleShowAction
{
    public static function handle(RequestInterface $request)
    {
        /*
         * @var $articleId int
         */
        $articleId = intval(basename($request->getUri()->getPath()));

        return json_encode([
            'article'       => ArticleShowCommand::handle($articleId),
            'countComments' => CommentGetCountByArticleIdCommand::handle($articleId),
            'comments'      => CommentGetByArticleIdCommand::handle($articleId),
            'message'       => 'Article showed successfully',
        ], JSON_THROW_ON_ERROR);
    }
}
