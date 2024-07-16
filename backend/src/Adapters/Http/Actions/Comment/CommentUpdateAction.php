<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Comment;

use App\Entities\Comment\Comment;
use App\Entities\Comment\AuthorEmail;
use App\Entities\Comment\AuthorUsername;
use App\Entities\Comment\Content;
use App\Entities\Comment\Title;
use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Comment\CommentUpdateCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class CommentUpdateAction
{
    public function __construct(
        private CommentUpdateCommand $commentUpdateCommand,
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
            $commentId = self::getCommentId($request);
            $comment = new Comment(
                $data['article_id'],
                new AuthorUsername($data['author_username']),
                new AuthorEmail($data['author_email']),
                new Title($data['title']),
                new Content($data['content']),
                null,
                date('Y-m-d H:i:s'),
            );

            return new JsonResponse([
                'isUpdated' => $this->commentUpdateCommand->handle($comment, $commentId),
                'message' => _('message_success_comment_update'),
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => _('message_error_comment_update'),
            ], 400);
        }
    }

    /**
     * Возвращает id текущего комментария.
     */
    private static function getCommentId(RequestInterface $request): int
    {
        return intval(explode('/', $request->getUri()->getPath())[3]);
    }
}
