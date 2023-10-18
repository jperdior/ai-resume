<?php

declare(strict_types=1);

namespace App\AiResume\Domain\ValueObject;

class SimilarEmbeddingValueObject
{
    public function __construct(
        public readonly float $similarity,
        public readonly string $text,
    ) {
    }

}
