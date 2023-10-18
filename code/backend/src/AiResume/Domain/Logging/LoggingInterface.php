<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Logging;

interface LoggingInterface
{
    public function error(string $message): void;

    public function info(string $message): void;
}
