<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\ArtificialIntelligence;

use App\AiResume\Domain\ArtificialIntelligence\ArtificialIntelligenceInterface;
use App\AiResume\Domain\ValueObject\CompletionValueObject;
use App\AiResume\Domain\ValueObject\EmbeddingValueObject;
use App\AiResume\Infrastructure\ArtificialIntelligence\Providers\OpenAi\OpenAiProvider;
use App\AiResume\Domain\Logging\LoggingInterface;
use Exception;

class ArtificialIntelligence implements ArtificialIntelligenceInterface
{
    public function __construct(
        private readonly LoggingInterface $logging
    ) {
    }

    /**
     * @throws Exception
     */
    public function prompt(string $prompt): CompletionValueObject
    {
        try {
            $openAiProvider = new OpenAiProvider();
            return $openAiProvider->prompt(prompt: $prompt);
        } catch (Exception $e) {
            $this->logging->error(message: "Ai error: " . $e->getMessage());
            throw new Exception(message: 'Error in prompt');
        }
    }

    /**
     * @throws Exception
     */
    public function generateEmbedding(string $text): EmbeddingValueObject
    {
        $openAiProvider = new OpenAiProvider();
        try {
            return $openAiProvider->createEmbedding(text: $text);
        } catch (Exception $e) {
            $this->logging->error(message: "Ai error: " . $e->getMessage());
            throw new Exception(message: 'Error in createEmbedding');
        }

    }

    public function getAnswer(array $question): string
    {
        $embeddings = $this->getEmbeddings();
        $mostSimilar = $this->getMostSimilar($embeddings, $question);
        return $mostSimilar['paragraph'];
    }


}
