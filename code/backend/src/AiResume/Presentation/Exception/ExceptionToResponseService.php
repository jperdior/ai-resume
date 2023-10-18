<?php

declare(strict_types=1);

namespace App\AiResume\Presentation\Exception;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class ExceptionToResponseService
{
    public function exceptionToJsonResponse(Exception $exception): JsonResponse
    {
        if($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }
        if($exception->getCode() !== 0) {
            return new JsonResponse(
                data: [
                    'message' => $exception->getMessage()
                ],
                status: $exception->getCode()
            );
        }

        return new JsonResponse(
            data: [
                'message' => $exception->getMessage()
            ],
            status: 400
        );

    }

}
