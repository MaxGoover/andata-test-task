<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Comment;

use App\Entities\Comment\AuthorEmail;
use App\Entities\Comment\AuthorUsername;
use App\Entities\Comment\Comment;
use App\Entities\Comment\Content;
use App\Entities\Comment\Title;
use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Comment\CommentCreateCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class CommentCreateAction
{
    public function __construct(
        private CommentCreateCommand $commentCreateCommand,
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            /*
            * @var $data['article_id'] int
            * @var $data['author_username'] string
            * @var $data['author_email'] string
            * @var $data['title'] string
            * @var $data['content'] string
            */
            $data = json_decode($request->getBody()->getContents(), true);
            $comment = new Comment(
                intval($data['article_id']),
                new AuthorUsername($data['author_username']),
                new AuthorEmail($data['author_email']),
                new Title($data['title']),
                new Content($data['content']),
                date('Y-m-d H:i:s')
            );

            return new JsonResponse([
                'comment' => $this->commentCreateCommand->handle($comment),
                'message' => 'Comment created successfully',
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => $e->getMessage(),
            ], 400);
        }
    }
}
