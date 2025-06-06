<?php

namespace CommandProcessor\Command;

use CommandProcessor\Contract\CommandInterface;
use CommandProcessor\Contract\DealContextInterface;

class ReasonCommand implements CommandInterface
{
    public function supports(string $command): bool
    {
        return trim($command) === '/причина';
    }

    public function handle(string $command, DealContextInterface $deal): string
    {
        $reason = $deal->getProperty(222);
        $deal->addMessage("Причина закрытия: {$reason}");

        return "Сообщение добавлено.";
    }
}
