<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\CommentRepository;

final class CommentGetCountByArticleIdCommand
{
    public static function handle(int $id)
    {
        return CommentRepository::getCountByArticleId($id);
    }
}
