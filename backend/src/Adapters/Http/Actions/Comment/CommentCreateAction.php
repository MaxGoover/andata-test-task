<?php

declare(strict_types=1);

namespace App\Adapters\Http\Actions\Comment;

use App\Entities\Comment\Comment;
use App\UseCases\Comment\CommentCreateCommand;
use Psr\Http\Message\RequestInterface;

final class CommentCreateAction
{
    public function __construct(
        private CommentCreateCommand $commentCreateCommand,
    ) {
    }

    public function handle(RequestInterface $request): string|false
    {
        /*
         * @var $data['article_id'] int
         * @var $data['author_username'] string
         * @var $data['author_email'] string
         * @var $data['title'] string
         * @var $data['content'] string
         */
        $data = json_decode($request->getBody()->getContents(), true);
        $comment = new Comment();
        $comment->article_id = intval($data['article_id']);
        $comment->author_username = $data['author_username'];
        $comment->author_email = $data['author_email'];
        $comment->title = $data['title'];
        $comment->content = $data['content'];
        $comment->created_at = date('Y-m-d H:i:s');

        return json_encode([
            'comment' => $this->commentCreateCommand->handle($comment),
            'message' => 'Comment created successfully',
        ], JSON_THROW_ON_ERROR);
    }
}
