<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Logging;

use App\AiResume\Domain\Logging\LoggingInterface;
use Psr\Log\LoggerInterface;

class LoggingService implements LoggingInterface
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function error(string $message): void
    {
        $this->logger->error($message);
    }

    public function info(string $message): void
    {
        $this->logger->info($message);
    }

}
