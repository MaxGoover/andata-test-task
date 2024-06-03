<?php

declare(strict_types=1);

namespace App\Entities\Article;

use PDO;

final class ArticleRepository
{
    public static function create(Article $article)
    {
        $dsn = 'mysql:host=mysql;dbname=andata_blog;charset=utf8';
        $pdo = new PDO($dsn, 'root', 'password');

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

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            Article::AUTHOR_USERNAME => $article->__get(Article::AUTHOR_USERNAME),
            Article::AUTHOR_EMAIL => $article->__get(Article::AUTHOR_EMAIL),
            Article::TITLE => $article->__get(Article::TITLE),
            Article::CONTENT => $article->__get(Article::CONTENT),
            Article::CREATED_AT => $article->__get(Article::CREATED_AT),
        ]);
    }

    public static function index()
    {
        $dsn = 'mysql:host=mysql;dbname=andata_blog;charset=utf8';
        $pdo = new PDO($dsn, 'root', 'password');
        $sql = "SELECT * FROM " . Article::TABLE_NAME;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id)
    {
        $dsn = 'mysql:host=mysql;dbname=andata_blog;charset=utf8';
        $pdo = new PDO($dsn, 'root', 'password');
        $sql = "SELECT * FROM " . Article::TABLE_NAME . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
