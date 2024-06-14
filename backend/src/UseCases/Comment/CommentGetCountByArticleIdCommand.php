<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\CommentRepositoryInterface;

final readonly class CommentGetCountByArticleIdCommand
{
    public function __construct(
        private CommentRepositoryInterface $comments,
    ) {
    }

    public function handle(int $id)
    {
        return $this->comments->getCountByArticleId($id);
    }
}
