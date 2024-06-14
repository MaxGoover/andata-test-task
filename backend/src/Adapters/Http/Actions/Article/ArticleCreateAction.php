<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Entities\Article\Article;
use App\Entities\Article\AuthorEmail;
use App\Entities\Article\AuthorUsername;
use App\Entities\Article\Content;
use App\Entities\Article\Title;
use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Article\ArticleCreateCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class ArticleCreateAction
{
    public function __construct(
        private ArticleCreateCommand $articleCreateCommand,
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        /*
         * @var $data['author_username'] string
         * @var $data['author_email'] string
         * @var $data['title'] string
         * @var $data['content'] string
         */
        $data = json_decode($request->getBody()->getContents(), true);
        $article = new Article(
            new AuthorUsername($data['author_username']),
            new AuthorEmail($data['author_email']),
            new Title($data['title']),
            new Content($data['content']),
            date('Y-m-d H:i:s'),
        );

        try {
            return new JsonResponse([
                'article' => $this->articleCreateCommand->handle($article),
                'message' => 'Article created successfully',
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => $e->getMessage(),
            ], 400);
        }
    }
}
