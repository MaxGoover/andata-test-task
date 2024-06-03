<?php

declare(strict_types=1);

namespace App\Entities\Article;

final class Article
{
    const TABLE_NAME = 'articles';

    const AUTHOR_USERNAME = 'author_username';
    const AUTHOR_EMAIL = 'author_email';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public string $author_username;
    public string $author_email;
    public string $title;
    public string $content;
    public string $created_at;
    public ?string $updated_at = null;
    public ?string $deleted_at = null;

    public function __get(string $key): mixed
    {
        return $this->{$key};
    }

    public function __set(string $key, mixed $value): void
    {
        $this->{$key} = $value;
    }
}
