<?php

declare(strict_types=1);

namespace PhpApp;

final class GreetingService
{
    public function greetingFor(string $name): string
    {
        $cleanName = trim($name);

        if ($cleanName === '') {
            return 'Hello, Azure Pipelines student!';
        }

        return sprintf('Hello, %s!', $cleanName);
    }
}
