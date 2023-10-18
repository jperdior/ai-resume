<?php

declare(strict_types=1);

namespace App\AiResume\Application\Command;

use App\AiResume\Application\DataTransformer\QuestionDataTransformer;
use App\AiResume\Domain\UseCase\AnswerQuestionUseCase;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AnswerQuestionMessageHandler
{
    public function __construct(
        private readonly AnswerQuestionUseCase $answerQuestionUseCase,
        private readonly QuestionDataTransformer $questionDataTransformer
    ) {
    }

    public function __invoke(AnswerQuestionMessage $message): void
    {
        $question = $this->answerQuestionUseCase->execute(
            question: $message->getQuestionSwagger()->question
        );
        $this->questionDataTransformer->writeQuestionSwagger(
            question: $question,
            questionSwagger: $message->getQuestionSwagger()
        );
    }

}
