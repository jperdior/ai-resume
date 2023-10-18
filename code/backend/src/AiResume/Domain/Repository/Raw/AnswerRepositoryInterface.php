<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Repository\Raw;

use App\AiResume\Domain\Entity\Question;

interface AnswerRepositoryInterface
{
    public function getAllAnswers(): array;
}
