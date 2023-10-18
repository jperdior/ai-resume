<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Storage\Raw;

use App\AiResume\Domain\Repository\Raw\AnswerRepositoryInterface;

class AnswerRepository implements AnswerRepositoryInterface
{
    public function getAllAnswers(): array
    {
        $jsonData = file_get_contents('/app/src/AiResume/Infrastructure/Storage/Data/resume.json');
        return json_decode($jsonData, true);
    }

}
