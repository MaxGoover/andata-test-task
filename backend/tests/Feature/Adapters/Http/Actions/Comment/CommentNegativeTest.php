<?php

declare(strict_types=1);

namespace Tests\Feature\Adapters\Http\Actions\Comment;

use App\Infrastructure\Helpers;
use App\Infrastructure\Rules\CommentRules;
use App\Infrastructure\Rules\CommonRules;
use GuzzleHttp\Exception\ClientException;
use Tests\Feature\TestCaseFeature;
use Tests\Fixtures\ArticleFixture;
use Tests\Fixtures\CommentFixture;

class CommentNegativeTest extends TestCaseFeature
{
    private int $articleId;
    private ArticleFixture $fixtureArticle;
    private CommentFixture $fixtureComment;

    public function setUp(): void
    {
        parent::setUp();
        $this->fixtureArticle = new ArticleFixture();
        $this->fixtureComment = new CommentFixture();

        $this->testCreateArticleSuccess();
        $this->resetFixtureCommentCreate();
        $this->setFixtureCommentArticleId($this->articleId);
    }

    public function tearDown(): void
    {
        $this->testCreateCommentFailed();
        $this->testDeleteArticleSuccess();
    }

    private function testCreateArticleSuccess()
    {
        $this->fixtureArticle->create();

        /** @var ResponseInterface $response */
        $response = $this->sendAjax('POST', 'http://localhost/api/articles', (array)$this->fixtureArticle);
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
        $response = $this->sendAjax('DELETE', "http://localhost/api/articles/$this->articleId");
        $this->assertSame(200, $response->getStatusCode());

        /** @var array $responseData */
        $responseData = json_decode($response->getBody()->getContents(), true);
        $this->assertTrue($responseData['isDeleted']);
        $this->assertSame('Статья удалена успешно', $responseData['message']);
    }

    public function testCreateTitleRequiredFailed()
    {
        $this->fixtureComment->title = '';
    }

    public function testCreateTitleMinLengthFailed()
    {
        $this->fixtureComment->title = Helpers::generateString(CommentRules::TITLE_MIN_LENGTH - 1);
    }

    public function testCreateTitleMaxLengthFailed()
    {
        $this->fixtureComment->title = Helpers::generateString(CommentRules::TITLE_MAX_LENGTH + 1);
    }

    public function testCreateContentRequiredFailed()
    {
        $this->fixtureComment->content = '';
    }

    public function testCreateContentMinLengthFailed()
    {
        $this->fixtureComment->content = Helpers::generateString(CommentRules::CONTENT_MIN_LENGTH - 1);
    }

    public function testCreateContentMaxLengthFailed()
    {
        $this->fixtureComment->content = Helpers::generateString(CommentRules::CONTENT_MAX_LENGTH + 1);
    }

    public function testCreateAuthorUsernameRequiredFailed()
    {
        $this->fixtureComment->author_username = '';
    }

    public function testCreateAuthorUsernameMinLengthFailed()
    {
        $this->fixtureComment->author_username = Helpers::generateString(CommonRules::USERNAME_MIN_LENGTH - 1);
    }

    public function testCreateAuthorUsernameMaxLengthFailed()
    {
        $this->fixtureComment->author_username = Helpers::generateString(CommonRules::USERNAME_MAX_LENGTH + 1);
    }

    public function testCreateAuthorEmailRequiredFailed()
    {
        $this->fixtureComment->author_email = '';
    }

    public function testCreateAuthorEmailFormatFailed()
    {
        $this->fixtureComment->author_email = '@mail.com';
    }

    public function testCreateAuthorEmailMaxLengthFailed()
    {
        $this->fixtureComment->author_email = Helpers::generateString(CommonRules::USERNAME_MAX_LENGTH + 1);
    }

    private function testCreateCommentFailed()
    {
        try {
            $this->sendAjax('POST', 'http://localhost/api/comments', (array)$this->fixtureComment);
            $this->fail();
        } catch (ClientException $e) {
            $this->assertSame(400, $e->getResponse()->getStatusCode());
            $this->assertSame('application/json', $e->getResponse()->getHeader('Content-Type')[0]);

            /** @var array $responseData */
            $responseData = json_decode($e->getResponse()->getBody()->getContents(), true);
            $this->assertSame('Не удалось сохранить комментарий', $responseData['message']);
        }
    }

    private function resetFixtureCommentCreate()
    {
        $this->fixtureComment->create();
    }

    private function setFixtureCommentArticleId(int $articleId)
    {
        $this->fixtureComment->article_id = $articleId;
    }
}
