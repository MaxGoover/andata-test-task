<?php

declare(strict_types=1);

namespace App\Entities\Article;

final class ArticleRepository
{
    public static function create(Article $article)
    {
        $connection = mysqli_connect('mysql', 'root', 'password', 'andata_blog');

        return $connection->query(
            "INSERT INTO " . Article::TABLE_NAME .
                " (" . $article->getProperties() . ") 
                VALUES (" . $article->getValues() . ")"
        );
    }

    public static function index()
    {
        $connection = mysqli_connect('mysql', 'root', 'password', 'andata_blog');

        return $connection->query(
            "SELECT * FROM " . Article::TABLE_NAME
        );
    }
}
