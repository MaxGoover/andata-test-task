<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\CommentRepositoryInterface;

final readonly class CommentGetByArticleIdCommand
{
    public function __construct(
        private CommentRepositoryInterface $comments,
    ) {
    }

    public function handle(int $articleId): array
    {
        return $this->comments->getByArticleId($articleId);
    }
}
