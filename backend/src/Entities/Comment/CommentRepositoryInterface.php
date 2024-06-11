<?php

declare(strict_types=1);

namespace App\Entities\Comment;

interface CommentRepositoryInterface
{
    public function create(Comment $comment): array;

    public function getByArticleId(int $articleId): array;

    public function getCountByArticleId(int $articleId): int;
}
