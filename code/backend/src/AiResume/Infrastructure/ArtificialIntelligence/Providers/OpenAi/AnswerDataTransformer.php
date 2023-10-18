<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\ArtificialIntelligence\Providers\OpenAi;

use App\AiResume\Domain\ValueObject\CompletionValueObject;

class AnswerDataTransformer
{
    public static function dummyCompletion(): CompletionValueObject
    {
        return  new CompletionValueObject(
            1000,
            111,
            1111,
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        );

    }

    public static function transform(array $data): CompletionValueObject
    {
        return  new CompletionValueObject(
            $data['usage']['prompt_tokens'],
            $data['usage']['completion_tokens'],
            $data['usage']['total_tokens'],
            $data['choices'][0]['message']['content']
        );

    }

}
