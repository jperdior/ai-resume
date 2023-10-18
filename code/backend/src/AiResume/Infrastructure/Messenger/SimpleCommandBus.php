<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SimpleCommandBus
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messengerBusCommand)
    {
        $this->messageBus = $messengerBusCommand;
    }

    public function dispatch(CommandMessage $command): void
    {
        $this->messageBus->dispatch(message: $command);
    }
}
