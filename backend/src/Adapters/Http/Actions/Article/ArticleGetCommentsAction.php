<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\UseCases\Comment\CommentGetByArticleIdCommand;
use App\UseCases\Comment\CommentGetCountByArticleIdCommand;
use Psr\Http\Message\RequestInterface;

final class ArticleGetCommentsAction
{
    public static function handle(RequestInterface $request)
    {
        $uri = $request->getUri()->getPath();
        /*
         * @var $articleId int
         */
        $articleId = intval(explode('/', $uri)[3]);

        return json_encode([
            'comments'      => CommentGetByArticleIdCommand::handle($articleId),
            'countComments' => CommentGetCountByArticleIdCommand::handle($articleId),
            'message'       => 'Article comments gotten successfully',
        ], JSON_THROW_ON_ERROR);
    }
}
