<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class SimpleQueryBus
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messengerBusQuery)
    {
        $this->messageBus = $messengerBusQuery;
    }

    public function handle(QueryMessage $query)
    {
        $envelope = $this->messageBus->dispatch(message: $query);

        /** @var HandledStamp $stamp */
        $stamp = $envelope->last(stampFqcn: HandledStamp::class);

        return $stamp->getResult();
    }
}
