<?php

declare(strict_types=1);

namespace App\AiResume\Domain\ValueObject;

class CompletionValueObject
{
    public function __construct(
        public readonly int $computingTokens,
        public readonly int $completionTokens,
        public readonly int $totalTokens,
        public readonly string $completion
    ) {
    }


}
