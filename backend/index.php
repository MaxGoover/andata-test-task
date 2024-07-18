<?php

declare(strict_types=1);

use App\Infrastructure\Routes;
use Dotenv\Dotenv;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__ . '/vendor/autoload.php';

// load env variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// define locale
$lang = 'ru_RU';
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang = mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    $lang = preg_replace('/\-/', '_', $lang);
}
setlocale(LC_ALL, $lang);
$domain = 'messages';
textdomain($domain);
bindtextdomain($domain, "src/Infrastructure/Locale");
bind_textdomain_codeset($domain, 'UTF-8');

/** @var ContainerInterface $container */
$container = require_once __DIR__ . '/config/container.php';

/** @var RequestInterface $request */
$request = ServerRequest::fromGlobals();

/** @var Routes $routes */
$routes = new Routes($container);

/** @var ResponseInterface $response */
$response = $routes->action($request);

// response
header('Content-Type: application/json');
http_response_code($response->getStatusCode());
echo $response->getBody()->getContents();
