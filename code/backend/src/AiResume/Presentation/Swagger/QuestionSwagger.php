<?php

declare(strict_types=1);

namespace App\AiResume\Presentation\Swagger;

use ApiPlatform\Action\NotFoundAction;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\AiResume\Presentation\Controller\AnswerQuestionController;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Question',
    operations: [
        new Get(
            uriTemplate: '/question/{id}',
            status: 200,
            controller: NotFoundAction::class,
            openapiContext: [
                'summary' => 'Retrieves a question',
                'description' => 'Retrieves a question',
            ],
            normalizationContext: [
                'groups' => ['read'],
            ],
            read: false
        ),
        new Post(
            uriTemplate: '/question',
            status: 201,
            controller: AnswerQuestionController::class,
            openapiContext: [
                'summary' => 'Ask a question about the resume',
                'description' => 'Ask a question about the resume',
            ],
            normalizationContext: [
                'groups' => ['read'],
            ],
            denormalizationContext: [
                'groups' => ['question'],
            ],
            validationContext: [
                'groups' => ['question'],
            ],
            read: false,
            serialize: true,
        ),
    ]
)]
class QuestionSwagger
{
    #[ApiProperty(
        description: 'Identifier',
        identifier: true,
        example: 1,
    )]
    public ?string $id = null;

    #[ApiProperty(
        description: 'Question text',
        example: 'How many years of experience as developer do you have?',
    )]
    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    #[Assert\Length(
        max: 512,
        maxMessage: 'Question cannot be longer than {{ limit }} characters',
    )]
    #[Assert\NotNull(groups: ['question'])]
    #[Assert\NotBlank(
        message: 'Question cannot be blank',
        groups: ['question']
    )]
    #[Groups(
        ['question',]
    )]
    public string $question;

    #[Groups(
        ['read']
    )]
    public ?string $answer = null;


}
