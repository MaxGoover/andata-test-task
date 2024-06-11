<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\Comment;
use App\Entities\Comment\CommentRepositoryInterface;

final class CommentCreateCommand
{
    public function __construct(
        private CommentRepositoryInterface $comments,
    ) {
    }

    public function handle(Comment $comment)
    {
        return $this->comments->create($comment);
    }
}
