<?php

declare(strict_types=1);

use App\Adapters\Http\Actions\Articles\ArticlesIndexAction;
use GuzzleHttp\Psr7\ServerRequest;

// use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$request = new ServerRequest(
    $uri,
    $method,
    getallheaders(),
    file_get_contents('php://input'),
);

// routes
if (stripos($uri, '/api/articles') === 0 && $method === 'GET') {
    ArticlesIndexAction::handle($request);
} elseif (stripos($uri, '/api/articles/create') === 0 && $method === 'POST') {
    include __DIR__ . '/src/Adapters/Http/ActionsArticles/ArticlesCreateAction.php';
}
