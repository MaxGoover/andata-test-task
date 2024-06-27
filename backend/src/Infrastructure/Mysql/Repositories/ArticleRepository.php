<?php

declare(strict_types=1);

namespace App\Infrastructure\Mysql\Repositories;

use App\Entities\Article\Article;
use App\Entities\Article\ArticleRepositoryInterface;
use PDO;

final class ArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    /** Создает статью. */
    public function create(Article $article): string|false
    {
        $sql = "INSERT articles
                    (author_username, author_email, title, content, created_at) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $article->author_username->getValue(),
            $article->author_email->getValue(),
            $article->title->getValue(),
            $article->content->getValue(),
            $article->created_at,
        ]);

        return $this->pdo->lastInsertId();
    }

    /** Удаляет статью. */
    public function delete(int $articleId): bool
    {
        $sql = "UPDATE articles
                SET deleted_at = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([date('Y-m-d H:i:s'), $articleId]);
    }

    /** Получает статью по её id. */
    public function getById(int $id): array
    {
        $sql = "SELECT * FROM articles 
                WHERE id = ? AND deleted_at IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Получает список статей. */
    public function index(): array
    {
        $sql = "SELECT articles.*, COUNT(comments.id) AS count_comments
                FROM articles
                LEFT JOIN comments ON articles.id = comments.article_id
                WHERE articles.deleted_at IS NULL
                GROUP BY articles.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Редактирует статью. */
    public function update(Article $article, int $articleId): bool
    {
        $sql = "UPDATE articles
                SET author_username = ?, author_email = ?, title = ?, content = ?, updated_at = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $article->author_username->getValue(),
            $article->author_email->getValue(),
            $article->title->getValue(),
            $article->content->getValue(),
            $article->updated_at,
            $articleId,
        ]);
    }
}
