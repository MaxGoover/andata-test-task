<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class Routes
{
    public array $list;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $routes = json_decode(file_get_contents(__DIR__ . '/../../routes.json'), true);
        $this->list = self::normalizeRoute($routes);
        $this->container = $container;
    }

    /**
     * Вызывает экшн, который соответствует данному запросу.
     */
    public function action(RequestInterface $request): ResponseInterface
    {
        /** @var string $method */
        $method = $request->getMethod();

        /** @var string $uri */
        $uri = self::normalizeUri($request->getUri()->getPath());

        /** @var Route $route */
        $route = $this->getRouteByMethodAndUri($method, $uri);

        return $this->container->get($route->namespace)->handle($request);
    }

    /**
     * Получает роут маршрута.
     */
    private function getRouteByMethodAndUri(string $method, string $uri): Route
    {
        try {
            /** @var Route $route */
            foreach ($this->list as $route) {
                if ($route->method === $method && $route->uri === $uri) {
                    return $route;
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Форматирует роуты из JSON-файла в массив роутов Route[].
     */
    private static function normalizeRoute(array $routes): array
    {
        return array_map(function ($route) {
            return new Route($route['method'], $route['namespace'], $route['uri']);
        }, $routes);
    }

    /**
     * Форматирует uri в маршрут роута.
     * Например: '/api/articles/13' -> '/api/articles/{id}'
     */
    private static function normalizeUri(string $uri): string
    {
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
