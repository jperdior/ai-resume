<?php

declare(strict_types=1);

namespace App\AiResume\Domain\ValueObject;

class EmbeddingValueObject
{
    public function __construct(
        public readonly array $embedding,
        public readonly int   $promptTokens
    ) {
    }

}
