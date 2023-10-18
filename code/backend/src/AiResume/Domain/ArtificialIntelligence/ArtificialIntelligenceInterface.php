<?php

declare(strict_types=1);

namespace App\AiResume\Domain\ArtificialIntelligence;

use App\AiResume\Domain\ValueObject\CompletionValueObject;
use App\AiResume\Domain\ValueObject\EmbeddingValueObject;

interface ArtificialIntelligenceInterface
{
    public function prompt(string $prompt): CompletionValueObject;

    public function generateEmbedding(string $text): EmbeddingValueObject;

    public function getAnswer(array $question): string;

}
