<?php

declare(strict_types=1);

namespace App\AiResume\Domain\UseCase;

use App\AiResume\Domain\ArtificialIntelligence\ArtificialIntelligenceInterface;
use App\AiResume\Domain\ArtificialIntelligence\Prompts\ResumeQuestionPromptGenerator;
use App\AiResume\Domain\Entity\Question;
use App\AiResume\Domain\Factory\QuestionFactory;
use App\AiResume\Domain\Repository\NoSql\QuestionRepositoryInterface;
use App\AiResume\Domain\Repository\Raw\AnswerRepositoryInterface;
use App\AiResume\Domain\Service\EmbeddingService;

class AnswerQuestionUseCase
{
    public function __construct(
        private readonly ArtificialIntelligenceInterface $artificialIntelligence,
        private readonly ResumeQuestionPromptGenerator $resumeQuestionPromptGenerator,
        private readonly QuestionFactory $questionFactory,
        private readonly QuestionRepositoryInterface $questionRepository,
        private readonly EmbeddingService $embeddingService,
        private readonly AnswerRepositoryInterface $answerRepository
    ) {
    }

    public function execute(
        string $question
    ): Question {
        $questionEmbedding = $this->embeddingService->embed(text: $question);
        $answers = $this->answerRepository->getAllAnswers();
        $answer = $this->embeddingService->getMostSimilar(
            embeddings: $answers,
            question: $questionEmbedding
        );
        $prompt = $this->resumeQuestionPromptGenerator->getRewriteAnswerPrompt(
            answer: $answer->text,
            question: $question
        );
        $completion = $this->artificialIntelligence->prompt(prompt: $prompt);
        $questionEntity = $this->questionFactory->createQuestion(
            question: $question,
            answer: $completion->completion,
            computingTokens: $completion->computingTokens + $questionEmbedding->promptTokens,
            completionTokens: $completion->completionTokens,
            totalTokens: $completion->totalTokens + $questionEmbedding->promptTokens
        );
        $this->questionRepository->save(question: $questionEntity);
        return $questionEntity;

    }

}
