<?php

declare(strict_types=1);

namespace App\Entities\Comment;

final class Comment
{
    const TABLE_NAME = 'comments';

    const ARTICLE_ID = 'article_id';
    const AUTHOR_USERNAME = 'author_username';
    const AUTHOR_EMAIL = 'author_email';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

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
