<?php

declare(strict_types=1);

namespace App\Entities\Article;

final class Article
{
    const TABLE_NAME = 'articles';

    public string $author_name;
    public string $author_email;
    public string $title;
    public string $content;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at = null;

    // public function __construct(
    //     string $author_name,
    //     string $author_email,
    //     string $title,
    //     string $content,
    //     string $created_at,
    //     string $updated_at,
    // ) {
    //     $this->author_name = $author_name;
    //     $this->author_email = $author_email;
    //     $this->title = $title;
    //     $this->content = $content;
    //     $this->created_at = $created_at;
    //     $this->updated_at = $updated_at;
    // }

    public function getProperties(): string {
        return implode(', ', array_keys(get_object_vars($this)));
    }

    public function getValues(): string {
        return implode(', ', array_values(get_object_vars($this)));
    }
}
