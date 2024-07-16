<?php

declare(strict_types=1);

namespace Tests\Fixtures;

final class CommentFixture
{
    public ?int $article_id;
    public string $author_username;
    public string $author_email;
    public string $title;
    public string $content;
    public string $created_at;
    public string $updated_at;

    public function create()
    {
        $this->author_username = 'BackendMaxGoover';
        $this->author_email = 'backend_maxgoover@gmail.com';
        $this->content = 'Бэкэнд - тестовое содержание тестового комментария';
        $this->title = 'Бэкэнд - тестовый заголовок тестового комментария';
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function update()
    {
        $this->author_username = 'UpdatedBackendMaxGoover';
        $this->author_email = 'updated_backend_maxgoover@gmail.com';
        $this->title = 'Измененный Бэкэнд - заголовок тестового комментария';
        $this->content = 'Измененное Бэкэнд - содержание тестового комментария';
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
