<?php

declare(strict_types=1);

namespace Tests\Feature\Adapters\Http\Actions\Article;

use Psr\Http\Message\ResponseInterface;
use Tests\Feature\TestCaseFeature;
use Tests\Fixtures\ArticleFixture;

class ArticlePositiveTest extends TestCaseFeature
{
    private int $articleId;
    private ArticleFixture $fixtureArticle;

    public function setUp(): void
    {
        parent::setUp();
        $this->fixtureArticle = new ArticleFixture();

        $this->testCreateSuccess();
    }

    public function tearDown(): void
    {
        $this->testDeleteSuccess();
    }

    private function testCreateSuccess()
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

    private function testDeleteSuccess()
    {
        /** @var ResponseInterface $response */
        $response = $this->sendAjax('DELETE', "/api/articles/$this->articleId");
        $this->assertSame(200, $response->getStatusCode());

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($responseData['isDeleted']);
        $this->assertSame('Статья удалена успешно', $responseData['message']);
    }

    public function testGetCommentsSuccess()
    {
        /** @var ResponseInterface $response */
        $response = $this->sendAjax('GET', "/api/articles/$this->articleId/get-comments");
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertIsArray($responseData['comments']);
        $this->assertIsInt($responseData['countComments']);
        $this->assertSame('Комментарии статьи получены успешно', $responseData['message']);
    }

    public function testIndexSuccess()
    {
        /** @var ResponseInterface $response */
        $response = $this->sendAjax('GET', '/api/articles');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertIsArray($responseData['articles']);
        $this->assertSame('Статьи получены успешно', $responseData['message']);
    }

    public function testShowSuccess()
    {
        /** @var ResponseInterface $response */
        $response = $this->sendAjax('GET', "/api/articles/$this->articleId");
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertIsArray($responseData['article']);
        $this->assertIsArray($responseData['comments']);
        $this->assertIsInt($responseData['countComments']);
        $this->assertSame('Статья получена успешно', $responseData['message']);
    }

    public function testUpdateSuccess()
    {
        $this->fixtureArticle->update();

        /** @var ResponseInterface $response */
        $response = $this->sendAjax('PUT', "/api/articles/$this->articleId", (array)$this->fixtureArticle);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeader('Content-Type')[0]);

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($responseData['isUpdated']);
        $this->assertSame('Статья отредактирована успешно', $responseData['message']);
    }
}
