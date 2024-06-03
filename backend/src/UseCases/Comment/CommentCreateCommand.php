<?php

declare(strict_types=1);

namespace App\UseCases\Comment;

use App\Entities\Comment\Comment;
use App\Entities\Comment\CommentRepository;

final class CommentCreateCommand
{
    public static function handle(Comment $comment)
    {
        return CommentRepository::create($comment);
    }
}
