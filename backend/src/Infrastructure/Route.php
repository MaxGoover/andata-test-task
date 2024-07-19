<?php

declare(strict_types=1);

namespace App\Infrastructure;

final readonly class Route
{
    public function __construct(
        public string $method,
        public string $namespace,
        public string $uri,
    ) {
    }
}
