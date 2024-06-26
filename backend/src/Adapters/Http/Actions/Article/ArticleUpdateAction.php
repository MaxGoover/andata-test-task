<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Article;

use App\Entities\Article\Article;
use App\Entities\Article\AuthorEmail;
use App\Entities\Article\AuthorUsername;
use App\Entities\Article\Content;
use App\Entities\Article\Title;
use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Article\ArticleUpdateCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class ArticleUpdateAction
{
    public function __construct(
        private ArticleUpdateCommand $articleUpdateCommand,
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            /*
            * @var $data['author_username'] string
            * @var $data['author_email'] string
            * @var $data['title'] string
            * @var $data['content'] string
            */
            $data = json_decode($request->getBody()->getContents(), true);
            $articleId = self::getArticleId($request);
            $article = new Article(
                new AuthorUsername($data['author_username']),
                new AuthorEmail($data['author_email']),
                new Title($data['title']),
                new Content($data['content']),
                null,
                date('Y-m-d H:i:s'),
            );

            return new JsonResponse([
                'article' => $this->articleUpdateCommand->handle($article, $articleId),
                'message' => 'Article created successfully',
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
