<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Comment;

use App\Infrastructure\Response\JsonResponse;
use App\UseCases\Comment\CommentDeleteCommand;
use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class CommentDeleteAction
{
    public function __construct(
        private CommentDeleteCommand $commentDeleteCommand,
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            $commentId = self::getCommentId($request);

            return new JsonResponse([
                'isDeleted' => $this->commentDeleteCommand->handle($commentId),
                'message' => _('message_success_comment_delete'),
            ]);
        } catch (Exception $e) {
            return new JsonResponse([
                'message'  => _('message_error_comment_delete'),
            ], 400);
        }
    }

    /**
     * Возвращает id текущей (выбранной) статьи.
     */
    private static function getCommentId(RequestInterface $request): int
    {
        return intval(explode('/', $request->getUri()->getPath())[3]);
    }
}
