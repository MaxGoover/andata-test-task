<?php

declare(strict_types=1);

namespace App\Infrastructure\Mysql\Repositories;

use App\Entities\Comment\Comment;
use App\Entities\Comment\CommentRepositoryInterface;
use PDO;

final class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(Comment $comment): array
    {
        $sql = "INSERT " . Comment::TABLE_NAME . "(" .
            Comment::ARTICLE_ID . ', ' .
            Comment::AUTHOR_USERNAME . ', ' .
            Comment::AUTHOR_EMAIL . ', ' .
            Comment::TITLE . ', ' .
            Comment::CONTENT . ', ' .
            Comment::CREATED_AT .
            ") VALUES (:" .
            Comment::ARTICLE_ID . ', :' .
            Comment::AUTHOR_USERNAME . ', :' .
            Comment::AUTHOR_EMAIL . ', :' .
            Comment::TITLE . ', :' .
            Comment::CONTENT . ', :' .
            Comment::CREATED_AT .
            ")";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            Comment::ARTICLE_ID => $comment->__get(Comment::ARTICLE_ID),
            Comment::AUTHOR_USERNAME => $comment->__get(Comment::AUTHOR_USERNAME),
            Comment::AUTHOR_EMAIL => $comment->__get(Comment::AUTHOR_EMAIL),
            Comment::TITLE => $comment->__get(Comment::TITLE),
            Comment::CONTENT => $comment->__get(Comment::CONTENT),
            Comment::CREATED_AT => $comment->__get(Comment::CREATED_AT),
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByArticleId(int $articleId): array
    {
        $sql = "SELECT * FROM " . Comment::TABLE_NAME . " WHERE " . Comment::ARTICLE_ID . " = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$articleId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountByArticleId(int $articleId): int
    {
        $sql = "SELECT COUNT(*) FROM " . Comment::TABLE_NAME . " WHERE " . Comment::ARTICLE_ID . " = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$articleId]);

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
}
