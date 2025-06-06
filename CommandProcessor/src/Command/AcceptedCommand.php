<?php

namespace CommandProcessor\Command;

use CommandProcessor\Contract\CommandInterface;
use CommandProcessor\Contract\DealContextInterface;
use CommandProcessor\Exception\CommandNotSupportedException;

class AcceptedCommand implements CommandInterface
{
    public function supports(string $command): bool
    {
        return str_starts_with($command, '/принято ');
    }

    public function handle(string $command, DealContextInterface $deal): string
    {
        $parts = explode(' ', trim($command), 3);

        if (count($parts) !== 3) {
            throw new CommandNotSupportedException("Некорректный формат команды '/принято'");
        }

        [$_, $value1, $value2] = $parts;

        $deal->setProperty(14, $value1);
        $deal->setProperty(15, $value2);

        return "Свойства сделки обновлены.";
    }
}
