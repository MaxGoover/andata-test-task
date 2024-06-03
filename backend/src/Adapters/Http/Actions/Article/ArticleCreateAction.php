<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Entities\Article\Article;
use App\UseCases\Article\ArticleCreateCommand;
use Psr\Http\Message\RequestInterface;

final class ArticleCreateAction
{
    public static function handle(RequestInterface $request)
    {
        /*
         * @var $data['author_username'] string
         * @var $data['author_email'] string
         * @var $data['title'] string
         * @var $data['content'] string
         */
        $data = json_decode($request->getBody()->getContents(), true);
        $article = new Article();
        $article->author_username = $data['author_username'];
        $article->author_email = $data['author_email'];
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->created_at = date('Y-m-d H:i:s');
        ArticleCreateCommand::handle($article);

        return json_encode([
            'message' => 'Article created successfully',
        ], JSON_THROW_ON_ERROR);
    }
}
