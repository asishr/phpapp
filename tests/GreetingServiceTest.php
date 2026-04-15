<?php

declare(strict_types=1);

namespace PhpApp\Tests;

use PhpApp\GreetingService;
use PHPUnit\Framework\TestCase;

final class GreetingServiceTest extends TestCase
{
    public function testGreetingWithName(): void
    {
        $service = new GreetingService();

        self::assertSame('Hello, Student!', $service->greetingFor('Student'));
    }

    public function testGreetingWithEmptyName(): void
    {
        $service = new GreetingService();

        self::assertSame('Hello, Azure Pipelines student!', $service->greetingFor('  '));
    }
}
