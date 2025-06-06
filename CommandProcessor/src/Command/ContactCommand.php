<?php

namespace CommandProcessor\Command;

use CommandProcessor\Contract\CommandInterface;
use CommandProcessor\Contract\DealContextInterface;

class ContactCommand implements CommandInterface
{
    public function supports(string $command): bool
    {
        return trim($command) === '/контакт';
    }

    public function handle(string $command, DealContextInterface $deal): string
    {
        $contact = $deal->getContact();
        $deal->addMessage("Контакт клиента: {$contact}");

        return "Сообщение добавлено.";
    }
}
