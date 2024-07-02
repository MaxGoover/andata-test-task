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

    /**
     * Создает комментарий к статье.
     */
    public function create(Comment $comment): string|false
    {
        $sql = "INSERT comments
                    (article_id, author_username, author_email, title, content, created_at)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $comment->article_id,
            $comment->author_username->getValue(),
            $comment->author_email->getValue(),
            $comment->title->getValue(),
            $comment->content->getValue(),
            $comment->created_at,
        ]);

        return $this->pdo->lastInsertId();
    }

    /** 
     * Удаляет комментарий.
     */
    public function delete(int $id): bool
    {
        $sql = "UPDATE comments
                SET deleted_at = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([date('Y-m-d H:i:s'), $id]);
    }

    /**
     * Получает список комментариев по id статьи.
     */
    public function getByArticleId(int $articleId): array
    {
        $sql = "SELECT * FROM comments 
                WHERE article_id = ? AND deleted_at IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$articleId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 
     * Получает количество комментариев по id статьи.
     */
    public function getCountByArticleId(int $articleId): int
    {
        $sql = "SELECT COUNT(*) FROM comments 
                WHERE article_id = ? AND deleted_at IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$articleId]);

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    /**
     *  Редактирует комментарий. 
     */
    public function update(Comment $comment, int $id): bool
    {
        $sql = "UPDATE comments
                SET author_username = ?, author_email = ?, title = ?, content = ?, updated_at = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $comment->author_username->getValue(),
            $comment->author_email->getValue(),
            $comment->title->getValue(),
            $comment->content->getValue(),
            $comment->updated_at,
            $id,
        ]);
    }
}
