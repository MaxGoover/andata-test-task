<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\CommentRepositoryInterface;

final readonly class CommentDeleteCommand
{
    public function __construct(
        private CommentRepositoryInterface $comments,
    ) {
    }

    public function handle(int $id): bool
    {
        return $this->comments->delete($id);
    }
}
