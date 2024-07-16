<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;

abstract class TestCaseFeature extends BaseTestCase
{
    private Client $client;
    private array $headers;
    private Request $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new Client();
        $this->headers = [
            'Accept-Language' => 'ru_RU',
            'Content-Type' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ];
    }

    protected function sendAjax(string $method, string $uri, array $data = [])
    {
        $this->request = new Request($method, $uri, $this->headers, json_encode($data));
        return $this->client->sendAsync($this->request)->wait();
    }
}
