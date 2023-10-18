<?php

declare(strict_types=1);

namespace App\AiResume\Application\DataTransformer;

use App\AiResume\Domain\Entity\Question;
use App\AiResume\Presentation\Swagger\QuestionSwagger;

class QuestionDataTransformer
{
    public function writeQuestionSwagger(
        Question $question,
        QuestionSwagger $questionSwagger
    ): void {
        $questionSwagger->id = $question->getId();
        $questionSwagger->question = $question->getQuestion();
        $questionSwagger->answer = $question->getAnswer();
    }
}
