<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Storage\Service;

interface UniqueIdentifierGeneratorInterface
{
    public function generateUlid(): string;
}
