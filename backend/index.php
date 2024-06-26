<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Article\ArticleCreateAction;
use App\Adapters\Http\Actions\Article\ArticleDeleteAction;
use App\Adapters\Http\Actions\Article\ArticleGetCommentsAction;
use App\Adapters\Http\Actions\Article\ArticleIndexAction;
use App\Adapters\Http\Actions\Article\ArticleShowAction;
use App\Adapters\Http\Actions\Article\ArticleUpdateAction;
use App\Adapters\Http\Actions\Comment\CommentCreateAction;
use Dotenv\Dotenv;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__ . '/vendor/autoload.php';

// load env variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** @var ContainerInterface $container */
$container = require_once __DIR__ . '/config/container.php';

/** @var RequestInterface $request */
$request = ServerRequest::fromGlobals();

/** @var string $uri */
$uri = $request->getUri()->getPath();

/** @var string $method */
$method = $request->getMethod();

/** @var ResponseInterface $response */
$response = null;

// routes
if (preg_match('/^\/api\/articles\/\d+\/get-comments$/', $uri) && $method === 'GET') {
    $response = $container->get(ArticleGetCommentsAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles\/\d+$/', $uri) && $method === 'GET') {
    $response = $container->get(ArticleShowAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles\/\d+$/', $uri) && $method === 'DELETE') {
    $response = $container->get(ArticleDeleteAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles\/\d+$/', $uri) && $method === 'PUT') {
    $response = $container->get(ArticleUpdateAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles$/', $uri) && $method === 'GET') {
    $response = $container->get(ArticleIndexAction::class)->handle();
} elseif (preg_match('/^\/api\/articles$/', $uri) && $method === 'POST') {
    $response = $container->get(ArticleCreateAction::class)->handle($request);
} elseif (preg_match('/^\/api\/comments$/', $uri) && $method === 'POST') {
    $response = $container->get(CommentCreateAction::class)->handle($request);
}

// response
header('Content-Type: application/json');
http_response_code($response->getStatusCode());
echo $response->getBody()->getContents();
