<?php

declare(strict_types=1);

namespace App\AiResume\Application\Command;

use App\AiResume\Infrastructure\Messenger\CommandMessage;
use App\AiResume\Presentation\Swagger\QuestionSwagger;

class AnswerQuestionMessage implements CommandMessage
{
    public function __construct(
        private QuestionSwagger $questionSwagger
    ) {
    }

    public function getQuestionSwagger(): QuestionSwagger
    {
        return $this->questionSwagger;
    }

}
