<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\CommentRepository;

final class CommentGetByArticleIdCommand
{
    public static function handle(int $articleId): array
    {
        return CommentRepository::getByArticleId($articleId);
    }
}
