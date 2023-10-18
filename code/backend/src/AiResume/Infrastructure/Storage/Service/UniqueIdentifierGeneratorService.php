<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Storage\Service;

use App\AiResume\Domain\Storage\Service\UniqueIdentifierGeneratorInterface;
use Symfony\Component\Uid\Ulid;

class UniqueIdentifierGeneratorService implements UniqueIdentifierGeneratorInterface
{
    public function generateUlid(): string
    {
        return Ulid::generate();
    }
}
