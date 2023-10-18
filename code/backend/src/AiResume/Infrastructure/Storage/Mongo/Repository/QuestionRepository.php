<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Storage\Mongo\Repository;

use App\AiResume\Domain\Entity\Question;
use App\AiResume\Domain\Repository\NoSql\QuestionRepositoryInterface;
use App\AiResume\Infrastructure\Storage\Mongo\AbstractMongoDdRepository;
use MongoDB\Collection;
use Symfony\Component\Serializer\SerializerInterface;

class QuestionRepository extends AbstractMongoDdRepository implements QuestionRepositoryInterface
{
    private Collection $collection;

    public function __construct(
        private readonly SerializerInterface $serializer
    ) {
        parent::__construct();
        $this->collection = $this->mongoDbDatabase->selectCollection('questions');
    }

    public function save(Question $question): void
    {
        $this->collection->replaceOne(
            [
            '_id' => $question->getId(),
        ],
            $this->serializer->normalize($question),
            [
                'upsert' => true,
            ]
        );
    }


}
