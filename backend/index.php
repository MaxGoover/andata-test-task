<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Article\ArticleCreateAction;
use App\Adapters\Http\Actions\Article\ArticleGetCommentsAction;
use App\Adapters\Http\Actions\Article\ArticleIndexAction;
use App\Adapters\Http\Actions\Article\ArticleShowAction;
use App\Adapters\Http\Actions\Comment\CommentCreateAction;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\LazyOpenStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\ServerRequest;

use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/vendor/autoload.php';

// load env variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** @var ContainerInterface $container */
$container = require __DIR__ . '/config/container.php';

/** @var Request $request */
$request = new Request(
    $_SERVER['REQUEST_METHOD'] ?? 'GET',
    ServerRequest::getUriFromGlobals(),
    getallheaders(),
    new CachingStream(new LazyOpenStream('php://input', 'r+')),
);

/** @var string $uri */
$uri = $request->getUri()->getPath();

/** @var string $method */
$method = $request->getMethod();

// headers response
header('Content-Type: application/json');

// routes
if (preg_match('/^\/api\/articles\/\d+\/get-comments$/', $uri) && $method === 'GET') {
    echo $container->get(ArticleGetCommentsAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles\/\d+$/', $uri) && $method === 'GET') {
    echo $container->get(ArticleShowAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles\/create$/', $uri) && $method === 'POST') {
    echo $container->get(ArticleCreateAction::class)->handle($request);
} elseif (preg_match('/^\/api\/articles$/', $uri) && $method === 'GET') {
    echo $container->get(ArticleIndexAction::class)->handle();
} elseif (preg_match('/^\/api\/comments\/create$/', $uri) && $method === 'POST') {
    echo $container->get(CommentCreateAction::class)->handle($request);
}
