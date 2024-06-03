<?php

declare(strict_types=1);

namespace App\Entities\Comment;

use PDO;

final class CommentRepository
{
    public static function create(Comment $comment)
    {
        $dsn = 'mysql:host=mysql;dbname=andata_blog;charset=utf8';
        $pdo = new PDO($dsn, 'root', 'password');

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

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            Comment::ARTICLE_ID => $comment->__get(Comment::ARTICLE_ID),
            Comment::AUTHOR_USERNAME => $comment->__get(Comment::AUTHOR_USERNAME),
            Comment::AUTHOR_EMAIL => $comment->__get(Comment::AUTHOR_EMAIL),
            Comment::TITLE => $comment->__get(Comment::TITLE),
            Comment::CONTENT => $comment->__get(Comment::CONTENT),
            Comment::CREATED_AT => $comment->__get(Comment::CREATED_AT),
        ]);
    }

    public static function getByArticleId(int $articleId): array
    {
        $dsn = 'mysql:host=mysql;dbname=andata_blog;charset=utf8';
        $pdo = new PDO($dsn, 'root', 'password');
        $sql = "SELECT * FROM " . Comment::TABLE_NAME . " WHERE " . Comment::ARTICLE_ID . " = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$articleId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCountByArticleId(int $articleId): int
    {
        $dsn = 'mysql:host=mysql;dbname=andata_blog;charset=utf8';
        $pdo = new PDO($dsn, 'root', 'password');
        $sql = "SELECT COUNT(*) FROM " . Comment::TABLE_NAME . " WHERE " . Comment::ARTICLE_ID . " = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$articleId]);

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
}
