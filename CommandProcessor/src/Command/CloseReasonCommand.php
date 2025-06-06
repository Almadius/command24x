<?php

namespace CommandProcessor\Command;

use CommandProcessor\Contract\CommandInterface;
use CommandProcessor\Contract\DealContextInterface;
use CommandProcessor\Exception\CommandNotSupportedException;

class CloseReasonCommand implements CommandInterface
{
    public function supports(string $command): bool
    {
        return str_starts_with($command, '/причина_закрытия');
    }

    public function handle(string $command, DealContextInterface $deal): string
    {
        $parts = explode(' ', $command, 2);

        if (count($parts) !== 2 || empty(trim($parts[1]))) {
            throw new CommandNotSupportedException("Команда '/причина_закрытия' требует значение.");
        }

        $reason = trim($parts[1]);
        $deal->setProperty(222, $reason);

        return "Причина закрытия обновлена.";
    }
}
