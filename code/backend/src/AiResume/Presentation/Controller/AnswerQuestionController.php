<?php

declare(strict_types=1);

namespace App\AiResume\Presentation\Controller;

use App\AiResume\Application\Command\AnswerQuestionMessage;
use App\AiResume\Infrastructure\Messenger\SimpleCommandBus;
use App\AiResume\Presentation\Swagger\QuestionSwagger;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\AiResume\Presentation\Exception\ExceptionToResponseService;
use Exception;

#[AsController]
class AnswerQuestionController
{
    public function __invoke(
        QuestionSwagger $questionSwagger,
        SimpleCommandBus $commandBus,
        ExceptionToResponseService $exceptionToResponseService
    ): QuestionSwagger | JsonResponse {
        try {
            $commandBus->dispatch(command: new AnswerQuestionMessage(questionSwagger: $questionSwagger));
            return $questionSwagger;
        } catch(Exception $e) {
            return $exceptionToResponseService->exceptionToJsonResponse(exception: $e);
        }
    }

}
