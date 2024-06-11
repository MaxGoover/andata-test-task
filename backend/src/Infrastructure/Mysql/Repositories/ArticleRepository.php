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

    public function create(Article $article): array
    {
        $sql = "INSERT " . Article::TABLE_NAME . "(" .
            Article::AUTHOR_USERNAME . ', ' .
            Article::AUTHOR_EMAIL . ', ' .
            Article::TITLE . ', ' .
            Article::CONTENT . ', ' .
            Article::CREATED_AT .
            ") VALUES (:" .
            Article::AUTHOR_USERNAME . ', :' .
            Article::AUTHOR_EMAIL . ', :' .
            Article::TITLE . ', :' .
            Article::CONTENT . ', :' .
            Article::CREATED_AT .
            ")";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            Article::AUTHOR_USERNAME => $article->__get(Article::AUTHOR_USERNAME),
            Article::AUTHOR_EMAIL => $article->__get(Article::AUTHOR_EMAIL),
            Article::TITLE => $article->__get(Article::TITLE),
            Article::CONTENT => $article->__get(Article::CONTENT),
            Article::CREATED_AT => $article->__get(Article::CREATED_AT),
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array
    {
        $sql = "SELECT * FROM " . Article::TABLE_NAME . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function index(): array
    {
        $sql = "SELECT articles.*, COUNT(comments.id) AS count_comments
            FROM articles
            LEFT JOIN comments ON articles.id = comments.article_id
            GROUP BY articles.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
