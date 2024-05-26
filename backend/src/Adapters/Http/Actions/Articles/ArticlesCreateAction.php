<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Articles;

use App\Adapters\Http\JsonResponse;
use App\Entities\Article\Article;
use App\UseCases\Article\ArticleCreateCommand;
use Psr\Http\Message\ServerRequestInterface;

final class ArticlesCreateAction
{
    public static function handle(ServerRequestInterface $request)
    {
        /**
         * @var $data['author_name'] string
         * @var $data['author_email'] string
         * @var $data['title'] string
         * @var $data['content'] string
         */
        $data = $request->getParsedBody();
        $article = new Article();
        $article->author_name = $data['author_name'];
        $article->author_email = $data['author_email'];
        $article->title = $data['title'];
        $article->content = $data['content'];
        ArticleCreateCommand::handle($article);

        return new JsonResponse(['message' => 'Article saved successfully']);
    }
}
