<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\ArtificialIntelligence\Providers\OpenAi;

use App\AiResume\Domain\ValueObject\CompletionValueObject;
use App\AiResume\Domain\ValueObject\EmbeddingValueObject;
use Exception;
use OpenAI;
use OpenAI\Client;

class OpenAiProvider
{
    private readonly Client $openAiClient;

    public function __construct(
    ) {
        $open_ai_key = getenv('OPENAI_API_KEY');
        $this->openAiClient = OpenAI::client($open_ai_key);
    }

    /**
     * @throws Exception
     */
    public function prompt(string $prompt): CompletionValueObject
    {
        $response = $this->openAiClient->chat()->create(
            [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 200,
            ]
        );

        $response = $response->toArray();

        if(isset($response['error'])) {

            throw new Exception($response['error']['message']);
        }

        //if the response is string return it if the response is bool throw an exception
        if(is_array($response)) {
            return AnswerDataTransformer::transform($response);
        } else {
            throw new Exception('OpenAi response is not a string');
        }

    }

    public function createEmbedding(string $text): EmbeddingValueObject
    {
        $response = $this->openAiClient->embeddings()->create([
            'model' => 'text-embedding-ada-002',
            'input' => $text,
        ]);

        return new EmbeddingValueObject(
            embedding: $response->embeddings[0]->embedding,
            promptTokens: $response->usage->promptTokens
        );
    }

}
