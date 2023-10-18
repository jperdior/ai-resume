<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Repository\NoSql;

use App\AiResume\Domain\Entity\Question;

interface QuestionRepositoryInterface
{
    public function save(Question $question): void;
}
