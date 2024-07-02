<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\Comment;
use App\Entities\Comment\CommentRepositoryInterface;

final readonly class CommentUpdateCommand
{
    public function __construct(
        private CommentRepositoryInterface $comments,
    ) {
    }

    public function handle(Comment $comment, int $id)
    {
        return $this->comments->update($comment, $id);
    }
}
