<?php

declare(strict_types=1);

namespace App\Entities\Comment;

final class Comment
{
    public int $article_id;
    public string $author_name;
    public string $author_email;
    public string $title;
    public string $content;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at = null;

    // public function __construct(
    //     int $article_id,
    //     string $author_name,
    //     string $author_email,
    //     string $title,
    //     string $content,
    //     string $created_at,
    //     string $updated_at,
    // ) {
    //     $this->article_id = $article_id;
    //     $this->author_name = $author_name;
    //     $this->author_email = $author_email;
    //     $this->title = $title;
    //     $this->content = $content;
    //     $this->created_at = $created_at;
    //     $this->updated_at = $updated_at;
    // }
}
