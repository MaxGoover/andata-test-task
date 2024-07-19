<?php

declare(strict_types=1);

namespace Tests\Feature\Adapters\Http\Actions\Comment;

use Psr\Http\Message\ResponseInterface;
use Tests\Feature\TestCaseFeature;
use Tests\Fixtures\ArticleFixture;
use Tests\Fixtures\CommentFixture;

class CommentPositiveTest extends TestCaseFeature
{
    private int $articleId;
    private int $commentId;
    private ArticleFixture $fixtureArticle;
    private CommentFixture $fixtureComment;

    public function setUp(): void
    {
        parent::setUp();
        $this->fixtureArticle = new ArticleFixture();
        $this->fixtureComment = new CommentFixture();

        $this->testCreateArticleSuccess();
        $this->testCreateSuccess();
    }

    public function tearDown(): void
    {
        $this->testDeleteArticleSuccess();
    }

    private function testCreateArticleSuccess()
    {
        $this->fixtureArticle->create();

        /** @var ResponseInterface $response */
        $response = $this->sendAjax('POST', '/api/articles', (array)$this->fixtureArticle);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertIsString($responseData['articleId']);
        $this->assertSame('Статья добавлена успешно', $responseData['message']);
        $this->articleId = (int)$responseData['articleId'];
    }

    private function testDeleteArticleSuccess()
    {
        /** @var ResponseInterface $response */
        $response = $this->sendAjax('DELETE', "/api/articles/$this->articleId");
        $this->assertSame(200, $response->getStatusCode());

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($responseData['isDeleted']);
        $this->assertSame('Статья удалена успешно', $responseData['message']);
    }

    public function testCreateSuccess()
    {
        $this->fixtureComment->create();
        $this->fixtureComment->article_id = $this->articleId;

        /** @var ResponseInterface $response */
        $response = $this->sendAjax('POST', "/api/comments", (array)$this->fixtureComment);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertIsString($responseData['commentId']);
        $this->assertSame('Комментарий сохранен успешно', $responseData['message']);
        $this->commentId = (int)$responseData['commentId'];
    }

    public function testUpdateSuccess()
    {
        $this->fixtureComment->update();
        $this->fixtureComment->article_id = $this->articleId;

        /** @var ResponseInterface $response */
        $response = $this->sendAjax('PUT', "/api/comments/$this->commentId", (array)$this->fixtureComment);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($responseData['isUpdated']);
        $this->assertSame('Комментарий отредактирован успешно', $responseData['message']);
    }

    public function testDeleteSuccess()
    {
        /** @var ResponseInterface $response */
        $response = $this->sendAjax('DELETE', "/api/comments/$this->commentId");
        $this->assertSame(200, $response->getStatusCode());

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($responseData['isDeleted']);
        $this->assertSame('Комментарий удален успешно', $responseData['message']);
    }
}
