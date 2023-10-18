<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Service;

use App\AiResume\Domain\ArtificialIntelligence\ArtificialIntelligenceInterface;
use App\AiResume\Domain\ValueObject\EmbeddingValueObject;
use App\AiResume\Domain\ValueObject\SimilarEmbeddingValueObject;

class EmbeddingService
{
    public function __construct(
        private readonly ArtificialIntelligenceInterface $artificialIntelligence
    ) {
    }

    public function embed(string $text): EmbeddingValueObject
    {
        return $this->artificialIntelligence->generateEmbedding($text);
    }

    public function getMostSimilar(array $embeddings, EmbeddingValueObject $question): SimilarEmbeddingValueObject
    {
        $results = [];
        for ($i = 0; $i < count($embeddings); $i++) {
            $similarity = $this->cosineSimilarity($embeddings[$i]['embedding'], $question->embedding);
            $results[] = [
                'similarity' => $similarity,
                'index' => $i,
                'paragraph' => $embeddings[$i]["paragraph"],
            ];
        }
        usort($results, function ($a, $b) {
            return $a['similarity'] <=> $b['similarity'];
        });

        $mostSimilar = end($results);
        return new SimilarEmbeddingValueObject(
            similarity: $mostSimilar['similarity'],
            text: $mostSimilar['paragraph']
        );
    }

    private function cosineSimilarity($u, $v): float
    {
        $dotProduct = 0;
        $uLength = 0;
        $vLength = 0;
        for ($i = 0; $i < count($u); $i++) {
            $dotProduct += $u[$i] * $v[$i];
            $uLength += $u[$i] * $u[$i];
            $vLength += $v[$i] * $v[$i];
        }
        $uLength = sqrt($uLength);
        $vLength = sqrt($vLength);
        return $dotProduct / ($uLength * $vLength);
    }

}
