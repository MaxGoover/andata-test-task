<?php

declare(strict_types=1);

namespace App\Entities\Comment;

final class Comment
{
    public function __construct(
        public int $article_id,
        public AuthorUsername $author_username,
        public AuthorEmail $author_email,
        public Title $title,
        public Content $content,
        public string $created_at,
        public ?string $updated_at = null,
        public ?string $deleted_at = null,
    ) {
    }
}
