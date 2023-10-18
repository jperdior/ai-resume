<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Factory;

use App\AiResume\Domain\Entity\Question;
use App\AiResume\Domain\Storage\Service\UniqueIdentifierGeneratorInterface;

class QuestionFactory
{
    public function __construct(
        private readonly UniqueIdentifierGeneratorInterface $uniqueIdentifierGenerator
    ) {
    }

    public function createQuestion(
        string $question,
        string $answer,
        int $computingTokens,
        int $completionTokens,
        int $totalTokens
    ): Question {
        $questionEntity = new Question();
        $questionEntity->setId($this->uniqueIdentifierGenerator->generateUlid());
        $questionEntity->setQuestion($question);
        $questionEntity->setAnswer($answer);
        $questionEntity->setComputingTokens($computingTokens);
        $questionEntity->setCompletionTokens($completionTokens);
        $questionEntity->setTotalTokens($totalTokens);
        return $questionEntity;
    }

}
