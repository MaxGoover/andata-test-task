<?php

declare(strict_types=1);

namespace Tests\Feature\Adapters\Http\Actions\Article;

use App\Infrastructure\Helpers;
use App\Infrastructure\Rules\ArticleRules;
use App\Infrastructure\Rules\CommonRules;
use GuzzleHttp\Exception\ClientException;
use Tests\Feature\TestCaseFeature;
use Tests\Fixtures\ArticleFixture;

class ArticleNegativeTest extends TestCaseFeature
{
    private ArticleFixture $fixtureArticle;

    public function setUp(): void
    {
        parent::setUp();
        $this->fixtureArticle = new ArticleFixture();

        $this->resetFixtureArticleCreate();
    }

    public function tearDown(): void
    {
        $this->testCreateFailed();
    }

    public function testCreateTitleRequiredFailed()
    {
        $this->fixtureArticle->title = '';
    }

    public function testCreateTitleMinLengthFailed()
    {
        $this->fixtureArticle->title = Helpers::generateString(ArticleRules::TITLE_MIN_LENGTH - 1);
    }

    public function testCreateTitleMaxLengthFailed()
    {
        $this->fixtureArticle->title = Helpers::generateString(ArticleRules::TITLE_MAX_LENGTH + 1);
    }

    public function testCreateContentRequiredFailed()
    {
        $this->fixtureArticle->content = '';
    }

    public function testCreateContentMinLengthFailed()
    {
        $this->fixtureArticle->content = Helpers::generateString(ArticleRules::CONTENT_MIN_LENGTH - 1);
    }

    public function testCreateContentMaxLengthFailed()
    {
        $this->fixtureArticle->content = Helpers::generateString(ArticleRules::CONTENT_MAX_LENGTH + 1);
    }

    public function testCreateAuthorUsernameRequiredFailed()
    {
        $this->fixtureArticle->author_username = '';
    }

    public function testCreateAuthorUsernameMinLengthFailed()
    {
        $this->fixtureArticle->author_username = Helpers::generateString(CommonRules::USERNAME_MIN_LENGTH - 1);
    }

    public function testCreateAuthorUsernameMaxLengthFailed()
    {
        $this->fixtureArticle->author_username = Helpers::generateString(CommonRules::USERNAME_MAX_LENGTH + 1);
    }

    public function testCreateAuthorEmailRequiredFailed()
    {
        $this->fixtureArticle->author_email = '';
    }

    public function testCreateAuthorEmailFormatFailed()
    {
        $this->fixtureArticle->author_email = '@mail.com';
    }

    public function testCreateAuthorEmailMaxLengthFailed()
    {
        $this->fixtureArticle->author_email = Helpers::generateString(CommonRules::USERNAME_MAX_LENGTH + 1);
    }

    private function testCreateFailed()
    {
        try {
            $this->sendAjax('POST', 'http://localhost/api/articles', (array)$this->fixtureArticle);
            $this->fail();
        } catch (ClientException $e) {
            $this->assertSame(400, $e->getResponse()->getStatusCode());
            $this->assertSame('application/json', $e->getResponse()->getHeader('Content-Type')[0]);

            /** @var array $responseData */
            $responseData = json_decode($e->getResponse()->getBody()->getContents(), true);
            $this->assertSame('Не удалось сохранить статью', $responseData['message']);
        }
    }

    private function resetFixtureArticleCreate()
    {
        $this->fixtureArticle->create();
    }
}
