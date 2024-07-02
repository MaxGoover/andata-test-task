<?php

declare(strict_types=1);

namespace App\Entities\Comment;

interface CommentRepositoryInterface
{
    public function create(Comment $comment): string|false;

    public function delete(int $id): bool;

    public function getByArticleId(int $articleId): array;

    public function getCountByArticleId(int $articleId): int;

    public function update(Comment $comment, int $id): bool;
}
