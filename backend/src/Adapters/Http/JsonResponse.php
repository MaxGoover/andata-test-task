<?php

declare(strict_types=1);

namespace App\Adapters\Http;

use GuzzleHttp\Psr7\Response;

final class JsonResponse extends Response
{
    public function __construct($data, int $status = 200)
    {
        parent::__construct(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode($data, JSON_THROW_ON_ERROR),
        );
    }
}
