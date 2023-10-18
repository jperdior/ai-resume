<?php

declare(strict_types=1);

namespace App\AiResume\Domain\Entity;

class Question
{
    private string $id;

    private string $question;

    private string $answer;

    private int $computingTokens;

    private int $completionTokens;

    private int $totalTokens;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getComputingTokens(): int
    {
        return $this->computingTokens;
    }

    public function getCompletionTokens(): int
    {
        return $this->completionTokens;
    }

    public function getTotalTokens(): int
    {
        return $this->totalTokens;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function setComputingTokens(int $computingTokens): void
    {
        $this->computingTokens = $computingTokens;
    }

    public function setCompletionTokens(int $completionTokens): void
    {
        $this->completionTokens = $completionTokens;
    }

    public function setTotalTokens(int $totalTokens): void
    {
        $this->totalTokens = $totalTokens;
    }

}
