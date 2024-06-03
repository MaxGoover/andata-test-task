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

// use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

$request = new Request(
    $_SERVER['REQUEST_METHOD'] ?? 'GET',
    ServerRequest::getUriFromGlobals(),
    getallheaders(),
    new CachingStream(new LazyOpenStream('php://input', 'r+')),
);

$uri = $request->getUri()->getPath();
$method = $request->getMethod();

header('Content-Type: application/json');

// routes
if (preg_match('/^\/api\/articles\/\d+\/get-comments$/', $uri) && $method === 'GET') {
    echo ArticleGetCommentsAction::handle($request);
} elseif (preg_match('/^\/api\/articles\/\d+$/', $uri) && $method === 'GET') {
    echo ArticleShowAction::handle($request);
} elseif (preg_match('/^\/api\/articles\/create$/', $uri) && $method === 'POST') {
    echo ArticleCreateAction::handle($request);
} elseif (preg_match('/^\/api\/articles$/', $uri) && $method === 'GET') {
    echo ArticleIndexAction::handle();
} elseif (preg_match('/^\/api\/comments\/create$/', $uri) && $method === 'POST') {
    echo CommentCreateAction::handle($request);
}
