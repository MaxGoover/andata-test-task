<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;

abstract class TestCase extends BaseTestCase
{
    public ContainerInterface $container;

    public function setUp(): void
    {
        parent::setUp();
        $this->container = require_once __DIR__ . '/../config/container.php';
    }
}
