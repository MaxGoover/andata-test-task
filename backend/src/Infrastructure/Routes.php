<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class Routes
{
    public array $api;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $routes = json_decode(file_get_contents(__DIR__ . '/../../routes.json'), true);
        $this->api = $routes['api'];
        $this->container = $container;
    }

    public function action(RequestInterface $request): ResponseInterface
    {
        /** @var string $method */
        $method = $request->getMethod();

        /** @var string $uri */
        $uri = self::normalizeUri($request->getUri()->getPath());

        $action = array_search(['method' => $method, 'uri' => $uri], $this->api);
        return $this->container->get($action)->handle($request);
    }

    private static function normalizeUri(string $uri): string {
        $uriParts = preg_split('/\//', $uri);
        array_shift($uriParts);

        $uriArray = array_map(function (string $item) {
            if (is_numeric($item)) {
                return '/{id}';
            }
            return '/' . $item;
        }, $uriParts);

        return implode($uriArray);
    }
}
