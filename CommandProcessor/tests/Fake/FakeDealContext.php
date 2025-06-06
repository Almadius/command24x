<?php

namespace Tests\Fake;

use CommandProcessor\Contract\DealContextInterface;

class FakeDealContext implements DealContextInterface
{
    private array $properties = [];
    private array $messages = [];
    private string $contact = '+70000000000';

    public function setProperty(int $propertyId, string $value): void
    {
        $this->properties[$propertyId] = $value;
    }

    public function getProperty(int $propertyId): string
    {
        return $this->properties[$propertyId] ?? '';
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }

    // Методы для тестирования
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
