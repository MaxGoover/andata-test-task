<?php

declare(strict_types=1);

namespace Tests\Fixtures;

final class ArticleFixture
{
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
        $this->title = 'Бэкэнд - тестовое содержание тестовой статьи';
        $this->content = 'Бэкэнд - тестовый заголовок тестовой статьи';
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function update()
    {
        $this->author_username = 'UpdatedBackendMaxGoover';
        $this->author_email = 'updated_backend_maxgoover@gmail.com';
        $this->title = 'Измененное Бэкэнд - содержание тестовой статьи';
        $this->content = 'Измененный Бэкэнд - заголовок тестовой статьи';
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
